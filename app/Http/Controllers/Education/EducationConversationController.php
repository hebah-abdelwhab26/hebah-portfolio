<?php

namespace App\Http\Controllers\Education;

use App\Http\Controllers\Controller;
use App\Models\EducationAdmin;
use App\Models\EducationAdminNotification;
use App\Models\EducationConversation;
use App\Models\EducationMessage;
use App\Models\EducationUserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EducationConversationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | CONVERSATIONS INDEX
    |--------------------------------------------------------------------------
    |
    | عرض سجل محادثات الطالب.
    |
    */

    public function index()
    {
        $student = Auth::guard('education')->user();

        abort_unless($student, 403);

        $conversations = EducationConversation::query()
            ->where(
                'education_user_id',
                $student->id
            )
            ->with([
                'latestMessage',
            ])
            ->withCount('messages')
            ->orderByDesc('last_message_at')
            ->orderByDesc('created_at')
            ->get();

        return view(
            'education.conversations.index',
            compact('conversations')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | SHOW CONVERSATION
    |--------------------------------------------------------------------------
    */

    public function show(
        EducationConversation $conversation
    ) {
        $student = Auth::guard('education')->user();

        abort_unless($student, 403);


        /*
        |--------------------------------------------------------------------------
        | SECURITY
        |--------------------------------------------------------------------------
        */

        abort_unless(
            (int) $conversation->education_user_id === (int) $student->id,
            403
        );


        /*
        |--------------------------------------------------------------------------
        | LOAD MESSAGES
        |--------------------------------------------------------------------------
        */

        $messages = $conversation->messages()
            ->orderBy('created_at')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | MARK ADMIN MESSAGES AS READ
        |--------------------------------------------------------------------------
        |
        | عندما يفتح الطالب المحادثة، نعتبر رسائل الإدارة مقروءة.
        |
        */

        $conversation->messages()
            ->where(
                'sender_type',
                'education_admin'
            )
            ->whereNull('read_at')
            ->update([
                'read_at' => now(),
            ]);


        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'education.conversations.show',
            compact(
                'conversation',
                'messages'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    |
    | مهم جدًا:
    |
    | هذه الصفحة لا تنشئ Conversation.
    |
    | إنشاء Conversation يحدث فقط عند إرسال أول رسالة.
    |
    */

    public function create()
    {
        $student = Auth::guard('education')->user();

        abort_unless($student, 403);

        return view(
            'education.conversations.create'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | STORE MESSAGE
    |--------------------------------------------------------------------------
    |
    | لدينا هنا حالتان:
    |
    | 1. الطالب يرسل رسالة داخل Conversation موجودة.
    |
    | 2. الطالب يرسل أول رسالة من صفحة "محادثة جديدة".
    |
    | في الحالة الثانية ننشئ Conversation هنا فقط.
    |
    */

    public function storeMessage(
        Request $request,
        EducationConversation $conversation
    ) {
        $student = Auth::guard('education')->user();

        abort_unless($student, 403);


        /*
        |--------------------------------------------------------------------------
        | SECURITY
        |--------------------------------------------------------------------------
        */

        abort_unless(
            (int) $conversation->education_user_id === (int) $student->id,
            403
        );


        /*
        |--------------------------------------------------------------------------
        | CLOSED CONVERSATION
        |--------------------------------------------------------------------------
        */

        if (
            in_array(
                $conversation->status,
                [
                    'closed',
                    'archived',
                ],
                true
            )
        ) {
            return back()->with(
                'error',
                'هذه المحادثة مغلقة ولا يمكن إرسال رسائل جديدة.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate(
            [
                'message' => [
                    'required',
                    'string',
                    'max:5000',
                ],
            ],
            [
                'message.required' =>
                    'يرجى كتابة الرسالة.',

                'message.string' =>
                    'صيغة الرسالة غير صحيحة.',

                'message.max' =>
                    'الرسالة طويلة جدًا.',
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | TRIM MESSAGE
        |--------------------------------------------------------------------------
        */

        $messageText = trim(
            $validated['message']
        );


        /*
        |--------------------------------------------------------------------------
        | SAFETY CHECK
        |--------------------------------------------------------------------------
        */

        if ($messageText === '') {

            return back()
                ->withErrors([
                    'message' =>
                        'يرجى كتابة رسالة قبل الإرسال.',
                ])
                ->withInput();

        }


        /*
        |--------------------------------------------------------------------------
        | CREATE MESSAGE
        |--------------------------------------------------------------------------
        */

        $message = EducationMessage::create([
            'education_conversation_id' =>
                $conversation->id,

            'sender_type' =>
                'education_user',

            'sender_id' =>
                $student->id,

            'message' =>
                $messageText,

            'attachment' =>
                null,

            'attachment_name' =>
                null,

            'attachment_type' =>
                null,

            'attachment_size' =>
                null,

            'read_at' =>
                null,
        ]);


        /*
        |--------------------------------------------------------------------------
        | UPDATE CONVERSATION
        |--------------------------------------------------------------------------
        */

        $conversation->update([
            'last_message_at' =>
                now(),

            'status' =>
                'open',
        ]);


        /*
        |--------------------------------------------------------------------------
        | CREATE ADMIN NOTIFICATIONS
        |--------------------------------------------------------------------------
        |
        | الطالب أرسل رسالة.
        |
        | كل مدير تعليم نشط يحصل على إشعار.
        |
        */

        $admins = EducationAdmin::query()
            ->where(
                'is_active',
                true
            )
            ->get();


        foreach ($admins as $admin) {

            EducationAdminNotification::create([
                'education_admin_id' =>
                    $admin->id,

                'type' =>
                    'new_message',

                'title' =>
                    'رسالة جديدة من طالب',

                'message' =>
                    $student->name .
                    ' أرسل رسالة جديدة في المحادثة.',

                'icon' =>
                    'fa-regular fa-comment-dots',

                'color' =>
                    'gold',

                'url' =>
                    route(
                        'education.admin.conversations.show',
                        $conversation
                    ),

                'read_at' =>
                    null,

                'data' => [
                    'conversation_id' =>
                        $conversation->id,

                    'message_id' =>
                        $message->id,

                    'student_id' =>
                        $student->id,

                    'student_name' =>
                        $student->name,
                ],
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'education.conversations.show',
                $conversation
            )
            ->with(
                'success',
                'تم إرسال الرسالة بنجاح.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | CLOSE CONVERSATION
    |--------------------------------------------------------------------------
    */

    public function close(
        EducationConversation $conversation
    ) {
        $student = Auth::guard('education')->user();

        abort_unless($student, 403);


        /*
        |--------------------------------------------------------------------------
        | SECURITY
        |--------------------------------------------------------------------------
        */

        abort_unless(
            (int) $conversation->education_user_id === (int) $student->id,
            403
        );


        /*
        |--------------------------------------------------------------------------
        | CLOSE
        |--------------------------------------------------------------------------
        */

        $conversation->update([
            'status' => 'closed',
        ]);


        return redirect()
            ->route(
                'education.conversations.show',
                $conversation
            )
            ->with(
                'success',
                'تم إغلاق المحادثة.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | REOPEN CONVERSATION
    |--------------------------------------------------------------------------
    */

    public function reopen(
        EducationConversation $conversation
    ) {
        $student = Auth::guard('education')->user();

        abort_unless($student, 403);


        /*
        |--------------------------------------------------------------------------
        | SECURITY
        |--------------------------------------------------------------------------
        */

        abort_unless(
            (int) $conversation->education_user_id === (int) $student->id,
            403
        );


        /*
        |--------------------------------------------------------------------------
        | REOPEN
        |--------------------------------------------------------------------------
        */

        $conversation->update([
            'status' => 'open',
        ]);


        return redirect()
            ->route(
                'education.conversations.show',
                $conversation
            )
            ->with(
                'success',
                'تم إعادة فتح المحادثة.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | DELETE CONVERSATION
    |--------------------------------------------------------------------------
    |
    | حذف المحادثة من قبل الطالب.
    |
    | الطالب يستطيع حذف محادثاته فقط.
    |
    | يتم حذف الرسائل التابعة للمحادثة أولًا،
    | ثم يتم حذف المحادثة نفسها.
    |
    */

    public function destroy(
        EducationConversation $conversation
    ) {
        $student = Auth::guard('education')->user();

        abort_unless($student, 403);


        /*
        |--------------------------------------------------------------------------
        | SECURITY
        |--------------------------------------------------------------------------
        |
        | منع الطالب من حذف محادثة لا تخصه.
        |
        */

        abort_unless(
            (int) $conversation->education_user_id === (int) $student->id,
            403
        );


        /*
        |--------------------------------------------------------------------------
        | DELETE
        |--------------------------------------------------------------------------
        |
        | Transaction تضمن تنفيذ الحذف بشكل آمن.
        |
        */

        DB::transaction(function () use ($conversation) {

            /*
            | حذف جميع الرسائل التابعة للمحادثة
            */
            $conversation->messages()->delete();


            /*
            | حذف المحادثة نفسها
            */
            $conversation->delete();
        });


        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'education.conversations.index'
            )
            ->with(
                'success',
                'تم حذف المحادثة بنجاح.'
            );
    }
}
