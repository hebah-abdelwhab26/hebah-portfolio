<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ContactMessageReply;
use App\Models\ContactMessage;
use App\Models\Conversation;
use App\Models\ConversationMessage;
use App\Notifications\NewConversationMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ConversationController extends Controller
{
    /**
     * عرض جميع المحادثات ورسائل الزوار.
     */
    public function index(Request $request): View
    {
        /*
        |--------------------------------------------------------------------------
        | AUTHENTICATED CONVERSATIONS
        |--------------------------------------------------------------------------
        */

        $conversationQuery = Conversation::query()
            ->with([
                'user',
                'latestMessage',
            ]);


        /*
        |--------------------------------------------------------------------------
        | PUBLIC CONTACT MESSAGES
        |--------------------------------------------------------------------------
        |
        | مهم:
        | Digital Studio يعرض فقط الرسائل التي مصدرها digital_studio.
        |
        */

        $contactQuery = ContactMessage::query()
            ->where('source', 'digital_studio');


        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = trim(
                $request->input('search')
            );


            /*
            |--------------------------------------------------------------------------
            | Conversation Search
            |--------------------------------------------------------------------------
            */

            $conversationQuery->where(function ($query) use ($search) {

                $query
                    ->where(
                        'subject',
                        'like',
                        "%{$search}%"
                    )
                    ->orWhereHas('user', function ($userQuery) use ($search) {

                        $userQuery
                            ->where(
                                'name',
                                'like',
                                "%{$search}%"
                            )
                            ->orWhere(
                                'email',
                                'like',
                                "%{$search}%"
                            );

                    });

            });


            /*
            |--------------------------------------------------------------------------
            | Contact Message Search
            |--------------------------------------------------------------------------
            */

            $contactQuery->where(function ($query) use ($search) {

                $query
                    ->where(
                        'name',
                        'like',
                        "%{$search}%"
                    )
                    ->orWhere(
                        'email',
                        'like',
                        "%{$search}%"
                    )
                    ->orWhere(
                        'subject',
                        'like',
                        "%{$search}%"
                    )
                    ->orWhere(
                        'message',
                        'like',
                        "%{$search}%"
                    );

            });

        }


        /*
        |--------------------------------------------------------------------------
        | STATUS FILTER
        |--------------------------------------------------------------------------
        */

        if ($request->filled('status')) {

            $status = $request->input('status');


            /*
            |--------------------------------------------------------------------------
            | Conversation Statuses
            |--------------------------------------------------------------------------
            */

            if (in_array($status, [
                'open',
                'closed',
                'archived',
            ], true)) {

                $conversationQuery->where(
                    'status',
                    $status
                );

                $contactQuery->whereRaw(
                    '1 = 0'
                );

            }


            /*
            |--------------------------------------------------------------------------
            | Contact Message Statuses
            |--------------------------------------------------------------------------
            */

            elseif (in_array($status, [
                'new',
                'read',
                'replied',
            ], true)) {

                $conversationQuery->whereRaw(
                    '1 = 0'
                );

                $contactQuery->where(
                    'status',
                    $status
                );

            }

        }


        /*
        |--------------------------------------------------------------------------
        | PREPARE CONVERSATIONS
        |--------------------------------------------------------------------------
        */

        $conversations = $conversationQuery
            ->get()
            ->map(function ($conversation) {

                $conversation->message_type =
                    'conversation';

                return $conversation;

            });


        /*
        |--------------------------------------------------------------------------
        | PREPARE CONTACT MESSAGES
        |--------------------------------------------------------------------------
        */

        $contactMessages = $contactQuery
            ->get()
            ->map(function ($contactMessage) {

                $contactMessage->message_type =
                    'contact';

                return $contactMessage;

            });


        /*
        |--------------------------------------------------------------------------
        | MERGE + SORT
        |--------------------------------------------------------------------------
        */

        $messages = $conversations
            ->concat($contactMessages)
            ->sortByDesc(function ($item) {

                if (
                    $item->message_type ===
                    'conversation'
                ) {

                    return $item->last_message_at
                        ?? $item->created_at;

                }

                return $item->created_at;

            })
            ->values();


        /*
        |--------------------------------------------------------------------------
        | MANUAL PAGINATION
        |--------------------------------------------------------------------------
        */

        $perPage = 10;

        $currentPage = max(
            1,
            (int) $request->input(
                'page',
                1
            )
        );


        $total = $messages->count();


        $currentItems = $messages
            ->slice(
                ($currentPage - 1) * $perPage,
                $perPage
            )
            ->values();


        $conversations =
            new \Illuminate\Pagination\LengthAwarePaginator(
                $currentItems,
                $total,
                $perPage,
                $currentPage,
                [
                    'path' =>
                        $request->url(),

                    'query' =>
                        $request->query(),
                ]
            );


        /*
        |--------------------------------------------------------------------------
        | STATISTICS
        |--------------------------------------------------------------------------
        */

        $totalConversations =
            Conversation::count();


        /*
        |----------------------------------------------------------------------
        | Digital Studio Contact Messages Only
        |----------------------------------------------------------------------
        */

        $totalContactMessages =
            ContactMessage::query()
                ->where(
                    'source',
                    'digital_studio'
                )
                ->count();


        $openConversations =
            Conversation::where(
                'status',
                'open'
            )->count();


        $closedConversations =
            Conversation::where(
                'status',
                'closed'
            )->count();


        $archivedConversations =
            Conversation::where(
                'status',
                'archived'
            )->count();


        /*
        |--------------------------------------------------------------------------
        | UNREAD AUTHENTICATED CONVERSATION MESSAGES
        |--------------------------------------------------------------------------
        */

        $unreadConversationMessages =
            ConversationMessage::query()
                ->where(
                    'sender_type',
                    'user'
                )
                ->where(
                    'is_read',
                    false
                )
                ->count();


        /*
        |--------------------------------------------------------------------------
        | UNREAD DIGITAL STUDIO CONTACT MESSAGES
        |--------------------------------------------------------------------------
        */

        $unreadContactMessages =
            ContactMessage::query()
                ->where(
                    'source',
                    'digital_studio'
                )
                ->where(
                    'status',
                    'new'
                )
                ->count();


        /*
        |--------------------------------------------------------------------------
        | TOTAL UNREAD
        |--------------------------------------------------------------------------
        */

        $unreadMessages =
            $unreadConversationMessages
            + $unreadContactMessages;


        /*
        |--------------------------------------------------------------------------
        | TOTAL MESSAGES
        |--------------------------------------------------------------------------
        */

        $totalMessages =
            $totalConversations
            + $totalContactMessages;


        return view(
            'admin.conversations.index',
            compact(
                'conversations',
                'totalConversations',
                'totalContactMessages',
                'totalMessages',
                'openConversations',
                'closedConversations',
                'archivedConversations',
                'unreadMessages'
            )
        );
    }


    /**
     * عرض محادثة مستخدم مسجل.
     */
    public function show(
        Conversation $conversation
    ): View {

        $conversation->load([
            'user',
            'messages',
        ]);


        /*
        |--------------------------------------------------------------------------
        | MARK USER MESSAGES AS READ
        |--------------------------------------------------------------------------
        */

        ConversationMessage::query()
            ->where(
                'conversation_id',
                $conversation->id
            )
            ->where(
                'sender_type',
                'user'
            )
            ->where(
                'is_read',
                false
            )
            ->update([
                'is_read' => true,
                'read_at' => now(),
            ]);


        return view(
            'admin.conversations.show',
            compact('conversation')
        );
    }


    /**
     * عرض رسالة زائر.
     */
    public function showContactMessage(
        ContactMessage $contactMessage
    ): View {

        /*
        |--------------------------------------------------------------------------
        | SECURITY
        |--------------------------------------------------------------------------
        |
        | Digital Studio لا يستطيع فتح رسائل Education.
        |
        */

        abort_unless(
            $contactMessage->source === 'digital_studio',
            404
        );


        /*
        |--------------------------------------------------------------------------
        | OPENING THE MESSAGE MARKS IT AS READ
        |--------------------------------------------------------------------------
        */

        $contactMessage->markAsRead();


        return view(
            'admin.conversations.show',
            compact('contactMessage')
        );
    }


    /**
     * إرسال رد داخل محادثة مستخدم مسجل.
     */
    public function sendMessage(
        Request $request,
        Conversation $conversation
    ): RedirectResponse {

        $validated = $request->validate([
            'message' => [
                'required',
                'string',
                'min:1',
                'max:5000',
            ],
        ]);


        $admin = auth()->user();


        /*
        |--------------------------------------------------------------------------
        | CREATE ADMIN MESSAGE
        |--------------------------------------------------------------------------
        */

        $message = ConversationMessage::create([
            'conversation_id' =>
                $conversation->id,

            'sender_type' =>
                'admin',

            'sender_id' =>
                $admin->id,

            'message' =>
                trim(
                    $validated['message']
                ),

            'is_read' =>
                true,

            'read_at' =>
                now(),
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
        | NOTIFY USER
        |--------------------------------------------------------------------------
        */

        if ($conversation->user) {

            $conversation->user->notify(
                new NewConversationMessage(
                    $conversation,
                    $message
                )
            );

        }


        return back()->with(
            'success',
            __('digital_studio_admin.conversations.messages.sent')
        );
    }


    /**
     * تعليم رسالة الزائر كمقروءة.
     */
    public function markContactMessageAsRead(
        ContactMessage $contactMessage
    ): RedirectResponse {

        /*
        |--------------------------------------------------------------------------
        | SECURITY
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $contactMessage->source === 'digital_studio',
            404
        );


        $contactMessage->markAsRead();


        return back()->with(
            'success',
            'تم تعليم الرسالة كمقروءة.'
        );
    }


    /**
     * تعليم رسالة الزائر بأنه تمت الإجابة عليها.
     */
    public function markContactMessageAsReplied(
        ContactMessage $contactMessage
    ): RedirectResponse {

        /*
        |--------------------------------------------------------------------------
        | SECURITY
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $contactMessage->source === 'digital_studio',
            404
        );


        $contactMessage->markAsReplied();


        return back()->with(
            'success',
            'تم تعليم الرسالة كمُجاب عليها.'
        );
    }


    /**
     * الرد الفعلي على رسالة الزائر عبر البريد الإلكتروني.
     */
    public function replyToContactMessage(
        Request $request,
        ContactMessage $contactMessage
    ): RedirectResponse {

        /*
        |--------------------------------------------------------------------------
        | SECURITY
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $contactMessage->source === 'digital_studio',
            404
        );


        /*
        |--------------------------------------------------------------------------
        | VALIDATE REPLY
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'message' => [
                'required',
                'string',
                'min:1',
                'max:5000',
            ],
        ], [
            'message.required' =>
                'يرجى كتابة الرد.',

            'message.string' =>
                'الرد غير صالح.',

            'message.min' =>
                'يرجى كتابة الرد.',

            'message.max' =>
                'الرد طويل جدًا.',
        ]);


        /*
        |--------------------------------------------------------------------------
        | CLEAN REPLY
        |--------------------------------------------------------------------------
        */

        $reply = trim(
            $validated['message']
        );


        try {

            /*
            |--------------------------------------------------------------------------
            | SEND EMAIL TO VISITOR
            |--------------------------------------------------------------------------
            */

            Mail::to(
                $contactMessage->email
            )->send(
                new ContactMessageReply(
                    $contactMessage,
                    $reply
                )
            );


            /*
            |--------------------------------------------------------------------------
            | MARK MESSAGE AS REPLIED
            |--------------------------------------------------------------------------
            */

            $contactMessage->markAsReplied();


            return back()->with(
                'success',
                'تم إرسال الرد إلى الزائر بنجاح.'
            );

        } catch (\Throwable $exception) {

            /*
            |--------------------------------------------------------------------------
            | LOG ERROR
            |--------------------------------------------------------------------------
            */

            report(
                $exception
            );


            /*
            |--------------------------------------------------------------------------
            | DO NOT MARK AS REPLIED
            |--------------------------------------------------------------------------
            */

            return back()
                ->withInput()
                ->with(
                    'error',
                    'تعذر إرسال الرد. يرجى التحقق من إعدادات البريد والمحاولة مرة أخرى.'
                );
        }
    }


    /**
     * إغلاق المحادثة.
     */
    public function close(
        Conversation $conversation
    ): RedirectResponse {

        $conversation->update([
            'status' =>
                'closed',
        ]);


        return back()->with(
            'success',
            __('digital_studio_admin.conversations.messages.closed')
        );
    }


    /**
     * إعادة فتح المحادثة.
     */
    public function reopen(
        Conversation $conversation
    ): RedirectResponse {

        $conversation->update([
            'status' =>
                'open',
        ]);


        return back()->with(
            'success',
            __('digital_studio_admin.conversations.messages.reopened')
        );
    }


    /**
     * أرشفة المحادثة.
     */
    public function archive(
        Conversation $conversation
    ): RedirectResponse {

        $conversation->update([
            'status' =>
                'archived',
        ]);


        return back()->with(
            'success',
            __('digital_studio_admin.conversations.messages.archived')
        );
    }


    /**
     * تعليم محادثة المستخدم كمقروءة.
     */
    public function markAsRead(
        Conversation $conversation
    ): RedirectResponse {

        ConversationMessage::query()
            ->where(
                'conversation_id',
                $conversation->id
            )
            ->where(
                'sender_type',
                'user'
            )
            ->where(
                'is_read',
                false
            )
            ->update([
                'is_read' =>
                    true,

                'read_at' =>
                    now(),
            ]);


        return back()->with(
            'success',
            __('digital_studio_admin.conversations.messages.read')
        );
    }


    /**
     * حذف رسالة زائر.
     */
    public function destroyContactMessage(
        ContactMessage $contactMessage
    ): RedirectResponse {

        /*
        |--------------------------------------------------------------------------
        | SECURITY
        |--------------------------------------------------------------------------
        |
        | يمنع Digital Studio من حذف رسالة Education.
        |
        */

        abort_unless(
            $contactMessage->source === 'digital_studio',
            404
        );


        $contactMessage->delete();


        return redirect()
            ->route(
                'admin.conversations.index'
            )
            ->with(
                'success',
                'تم حذف رسالة الزائر بنجاح.'
            );
    }


    /**
     * حذف محادثة مستخدم.
     */
    public function destroy(
        Conversation $conversation
    ): RedirectResponse {

        /*
        |--------------------------------------------------------------------------
        | DELETE MESSAGES FIRST
        |--------------------------------------------------------------------------
        */

        $conversation
            ->messages()
            ->delete();


        /*
        |--------------------------------------------------------------------------
        | DELETE CONVERSATION
        |--------------------------------------------------------------------------
        */

        $conversation->delete();


        return redirect()
            ->route(
                'admin.conversations.index'
            )
            ->with(
                'success',
                __('digital_studio_admin.conversations.messages.deleted')
            );
    }
}
