<?php

namespace App\Http\Controllers\Education\Admin;

use App\Http\Controllers\Controller;
use App\Models\EducationAdminNotification;
use App\Models\EducationConversation;
use App\Models\EducationMessage;
use App\Models\EducationUser;
use App\Models\EducationUserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EducationConversationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | CONVERSATIONS
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $conversations = EducationConversation::query()
            ->with([
                'educationUser',
                'latestMessage',
            ])
            ->withCount('messages')
            ->orderByDesc('last_message_at')
            ->orderByDesc('created_at')
            ->get();

        return view(
            'education.admin.conversations.index',
            compact('conversations')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | CREATE CONVERSATION
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $students = EducationUser::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view(
            'education.admin.conversations.create',
            compact('students')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | STORE CONVERSATION
    |--------------------------------------------------------------------------
    |
    | الأدمن ينشئ محادثة جديدة مع الطالب ويرسل أول رسالة.
    |
    | بعد إنشاء أول رسالة:
    | يتم إنشاء إشعار للطالب.
    |
    */

    public function store(Request $request)
    {
        $admin = Auth::guard('education_admin')->user();

        abort_unless(
            $admin,
            403
        );


        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate(
            [
                'education_user_id' => [
                    'required',
                    'integer',
                    'exists:education_users,id',
                ],

                'message' => [
                    'required',
                    'string',
                    'max:5000',
                ],
            ],
            [
                'education_user_id.required' =>
                    'يرجى اختيار الطالب.',

                'education_user_id.integer' =>
                    'الطالب المحدد غير صالح.',

                'education_user_id.exists' =>
                    'الطالب المحدد غير موجود.',

                'message.required' =>
                    'يرجى كتابة الرسالة.',

                'message.string' =>
                    'الرسالة غير صالحة.',

                'message.max' =>
                    'الرسالة طويلة جدًا.',
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | MESSAGE TEXT
        |--------------------------------------------------------------------------
        */

        $messageText = trim(
            $validated['message']
        );


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
        | CREATE CONVERSATION
        |--------------------------------------------------------------------------
        */

        $conversation = EducationConversation::create([
            'education_user_id' =>
                $validated['education_user_id'],

            'status' =>
                'open',

            'last_message_at' =>
                now(),
        ]);


        /*
        |--------------------------------------------------------------------------
        | CREATE FIRST MESSAGE
        |--------------------------------------------------------------------------
        */

        $message = EducationMessage::create([
            'education_conversation_id' =>
                $conversation->id,

            'sender_type' =>
                'education_admin',

            'sender_id' =>
                $admin->id,

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
        | NOTIFY STUDENT
        |--------------------------------------------------------------------------
        |
        | الأدمن بدأ محادثة جديدة وأرسل أول رسالة.
        |
        */

        $this->createStudentNotification(
            $conversation,
            $message,
            $admin
        );


        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'education.admin.conversations.show',
                $conversation
            )
            ->with(
                'success',
                'تم بدء المحادثة وإرسال الرسالة بنجاح.'
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
        $conversation->load([
            'educationUser',
        ]);

        $messages = $conversation->messages()
            ->orderBy('created_at')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | MARK STUDENT MESSAGES AS READ
        |--------------------------------------------------------------------------
        |
        | عندما يفتح الأدمن المحادثة:
        | تصبح رسائل الطالب غير المقروءة مقروءة.
        |
        */

        $conversation->messages()
            ->where(
                'sender_type',
                'education_user'
            )
            ->whereNull('read_at')
            ->update([
                'read_at' => now(),
            ]);


        return view(
            'education.admin.conversations.show',
            compact(
                'conversation',
                'messages'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | SEND MESSAGE
    |--------------------------------------------------------------------------
    |
    | إرسال رسالة جديدة من الأدمن إلى الطالب.
    |
    | بعد إنشاء الرسالة:
    | يتم إنشاء إشعار للطالب.
    |
    */

    public function storeMessage(
        Request $request,
        EducationConversation $conversation
    ) {
        $admin = Auth::guard('education_admin')->user();

        abort_unless(
            $admin,
            403
        );


        /*
        |--------------------------------------------------------------------------
        | CHECK CONVERSATION STATUS
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
                    'nullable',
                    'string',
                    'max:5000',
                    'required_without:attachment',
                ],

                'attachment' => [
                    'nullable',
                    'file',
                    'max:10240',
                ],
            ],
            [
                'message.string' =>
                    'نص الرسالة غير صالح.',

                'message.max' =>
                    'الرسالة طويلة جدًا.',

                'message.required_without' =>
                    'يرجى كتابة رسالة أو إرفاق ملف.',

                'attachment.file' =>
                    'المرفق غير صالح.',

                'attachment.max' =>
                    'حجم المرفق يجب ألا يتجاوز 10 ميجابايت.',
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | MESSAGE TEXT
        |--------------------------------------------------------------------------
        */

        $messageText =
            isset($validated['message'])
                ? trim($validated['message'])
                : null;


        /*
        |--------------------------------------------------------------------------
        | ATTACHMENT DATA
        |--------------------------------------------------------------------------
        */

        $attachmentPath = null;

        $attachmentName = null;

        $attachmentType = null;

        $attachmentSize = null;


        /*
        |--------------------------------------------------------------------------
        | STORE ATTACHMENT
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('attachment')) {

            $file = $request->file('attachment');


            $attachmentName =
                $file->getClientOriginalName();


            $attachmentType =
                $file->getMimeType();


            $attachmentSize =
                $file->getSize();


            $attachmentPath =
                $file->store(
                    'education/conversations',
                    'public'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | SAFETY CHECK
        |--------------------------------------------------------------------------
        */

        if (
            $messageText === null &&
            $attachmentPath === null
        ) {

            return back()
                ->withErrors([
                    'message' =>
                        'يرجى كتابة رسالة أو إرفاق ملف.',
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
                'education_admin',

            'sender_id' =>
                $admin->id,

            'message' =>
                $messageText,

            'attachment' =>
                $attachmentPath,

            'attachment_name' =>
                $attachmentName,

            'attachment_type' =>
                $attachmentType,

            'attachment_size' =>
                $attachmentSize,

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
        | NOTIFY STUDENT
        |--------------------------------------------------------------------------
        |
        | هنا الإصلاح الأساسي.
        |
        | كلما أرسل الأدمن رسالة:
        | يتم إنشاء إشعار للطالب صاحب المحادثة.
        |
        */

        $this->createStudentNotification(
            $conversation,
            $message,
            $admin
        );


        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return back()->with(
            'success',
            'تم إرسال الرسالة بنجاح.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | CREATE STUDENT NOTIFICATION
    |--------------------------------------------------------------------------
    |
    | إنشاء إشعار للطالب عند إرسال رسالة من الأدمن.
    |
    */

    protected function createStudentNotification(
        EducationConversation $conversation,
        EducationMessage $message,
        $admin
    ): void {

        /*
        |--------------------------------------------------------------------------
        | GET STUDENT
        |--------------------------------------------------------------------------
        */

        $student = EducationUser::query()
            ->find(
                $conversation->education_user_id
            );


        /*
        |--------------------------------------------------------------------------
        | SAFETY CHECK
        |--------------------------------------------------------------------------
        */

        if (!$student) {
            return;
        }


        /*
        |--------------------------------------------------------------------------
        | ADMIN NAME
        |--------------------------------------------------------------------------
        */

        $adminName =
            $admin?->name
            ?? 'الإدارة';


        /*
        |--------------------------------------------------------------------------
        | NOTIFICATION MESSAGE
        |--------------------------------------------------------------------------
        */

        $notificationMessage =
            $message->message
            ? $adminName .
              ' أرسل رسالة جديدة في المحادثة.'
            : $adminName .
              ' أرسل مرفقًا جديدًا في المحادثة.';


        /*
        |--------------------------------------------------------------------------
        | CREATE NOTIFICATION
        |--------------------------------------------------------------------------
        */

        EducationUserNotification::create([
            'education_user_id' =>
                $student->id,

            'type' =>
                'new_message',

            'title' =>
                'رسالة جديدة من الإدارة',

            'message' =>
                $notificationMessage,

            'icon' =>
                'fa-regular fa-comment-dots',

            'color' =>
                'gold',

            'url' =>
                route(
                    'education.conversations.show',
                    $conversation
                ),

            'read_at' =>
                null,

            'data' => [
                'conversation_id' =>
                    $conversation->id,

                'message_id' =>
                    $message->id,

                'admin_id' =>
                    $admin?->id,

                'admin_name' =>
                    $adminName,
            ],
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | CLOSE CONVERSATION
    |--------------------------------------------------------------------------
    */

    public function close(
        EducationConversation $conversation
    ) {
        $conversation->update([
            'status' =>
                'closed',
        ]);


        return back()->with(
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
        $conversation->update([
            'status' =>
                'open',
        ]);


        return back()->with(
            'success',
            'تم إعادة فتح المحادثة.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | DELETE CONVERSATION
    |--------------------------------------------------------------------------
    */

    public function destroy(
        EducationConversation $conversation
    ) {
        $admin = Auth::guard('education_admin')->user();

        abort_unless(
            $admin,
            403
        );


        /*
        |--------------------------------------------------------------------------
        | DELETE EVERYTHING
        |--------------------------------------------------------------------------
        */

        DB::transaction(
            function () use ($conversation) {

                $messages =
                    $conversation
                        ->messages()
                        ->get();


                /*
                |------------------------------------------------------------------
                | DELETE ATTACHMENTS
                |------------------------------------------------------------------
                */

                foreach ($messages as $message) {

                    if (
                        !empty(
                            $message->attachment
                        )
                    ) {

                        Storage::disk('public')
                            ->delete(
                                $message->attachment
                            );

                    }
                }


                /*
                |------------------------------------------------------------------
                | DELETE MESSAGES
                |------------------------------------------------------------------
                */

                $conversation
                    ->messages()
                    ->delete();


                /*
                |------------------------------------------------------------------
                | DELETE CONVERSATION
                |------------------------------------------------------------------
                */

                $conversation->delete();
            }
        );


        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'education.admin.conversations.index'
            )
            ->with(
                'success',
                'تم حذف المحادثة ورسائلها بنجاح.'
            );
    }
}
