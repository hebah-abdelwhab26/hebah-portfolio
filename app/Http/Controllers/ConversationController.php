<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\User;
use App\Notifications\NewConversationMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ConversationController extends Controller
{
    /**
     * ==========================================
     * Display User Conversations
     * ==========================================
     */
    public function index(): View
    {
        $conversations = auth()->user()
            ->conversations()
            ->with('latestMessage')
            ->latest('last_message_at')
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view(
            'conversations.index',
            compact('conversations')
        );
    }

    /**
     * ==========================================
     * Show Conversation
     * ==========================================
     */
    public function show(
        Conversation $conversation
    ): View {
        /*
        |--------------------------------------------------------------------------
        | Security
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $conversation->user_id === auth()->id(),
            403
        );

        /*
        |--------------------------------------------------------------------------
        | Messages
        |--------------------------------------------------------------------------
        */

        $conversation->load([
            'messages' => function ($query) {
                $query->orderBy(
                    'created_at',
                    'asc'
                );
            },
        ]);

        /*
        |--------------------------------------------------------------------------
        | Mark Admin Messages As Read
        |--------------------------------------------------------------------------
        */

        $conversation->messages()
            ->where(
                'sender_type',
                'admin'
            )
            ->where(
                'is_read',
                false
            )
            ->update([
                'is_read' => true,
                'read_at' => now(),
            ]);

        /*
        |--------------------------------------------------------------------------
        | Clear Related Notifications
        |--------------------------------------------------------------------------
        |
        | عندما يفتح المستخدم المحادثة، نعتبر إشعارات هذه المحادثة
        | قد تمت قراءتها.
        |
        */

        auth()->user()
            ->unreadNotifications()
            ->where(
                'type',
                NewConversationMessage::class
            )
            ->get()
            ->filter(function ($notification) use ($conversation) {

                return isset(
                    $notification->data['conversation_id']
                )
                    && (int) $notification->data['conversation_id']
                    === (int) $conversation->id;
            })
            ->each(function ($notification) {

                $notification->markAsRead();
            });

        /*
        |--------------------------------------------------------------------------
        | View
        |--------------------------------------------------------------------------
        */

        return view(
            'conversations.show',
            compact('conversation')
        );
    }

    /**
     * ==========================================
     * Create Conversation
     * ==========================================
     */
    public function create(): View
    {
        return view(
            'conversations.create'
        );
    }

    /**
     * ==========================================
     * Store Conversation
     * ==========================================
     */
    public function store(
        Request $request
    ): RedirectResponse {
        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'subject' => [
                'required',
                'string',
                'max:255',
            ],

            'message' => [
                'required',
                'string',
                'max:10000',
            ],

        ]);

        /*
        |--------------------------------------------------------------------------
        | Current User
        |--------------------------------------------------------------------------
        */

        $user = auth()->user();

        /*
        |--------------------------------------------------------------------------
        | Create Conversation
        |--------------------------------------------------------------------------
        */

        $conversation = Conversation::create([

            'user_id' => $user->id,

            'subject' => $validated['subject'],

            'status' => 'open',

            'last_message_at' => now(),

        ]);

        /*
        |--------------------------------------------------------------------------
        | First Message
        |--------------------------------------------------------------------------
        */

        $message = $conversation->messages()->create([

            'user_id' => $user->id,

            'sender_type' => 'user',

            'sender_name' => $user->name,

            'sender_email' => $user->email,

            'message' => $validated['message'],

            'is_read' => false,

        ]);

        /*
        |--------------------------------------------------------------------------
        | Notify Admins
        |--------------------------------------------------------------------------
        |
        | إرسال إشعار إلى جميع المدراء عند إنشاء محادثة جديدة.
        |
        */

        $admins = User::query()
            ->where('role', 'admin')
            ->get();

        foreach ($admins as $admin) {

            $admin->notify(
                new NewConversationMessage(
                    $message
                )
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'conversations.show',
                $conversation
            )
            ->with(
                'success',
                'Your message has been sent successfully.'
            );
    }

    /**
     * ==========================================
     * Send Message
     * ==========================================
     */
    public function sendMessage(
        Request $request,
        Conversation $conversation
    ): RedirectResponse {
        /*
        |--------------------------------------------------------------------------
        | Security
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $conversation->user_id === auth()->id(),
            403
        );

        /*
        |--------------------------------------------------------------------------
        | Check Conversation Status
        |--------------------------------------------------------------------------
        */

        if ($conversation->status !== 'open') {

            return back()->with(
                'error',
                'This conversation is closed.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'message' => [
                'required',
                'string',
                'max:10000',
            ],

        ]);

        /*
        |--------------------------------------------------------------------------
        | Current User
        |--------------------------------------------------------------------------
        */

        $user = auth()->user();

        /*
        |--------------------------------------------------------------------------
        | Create Message
        |--------------------------------------------------------------------------
        */

        $message = $conversation->messages()->create([

            'user_id' => $user->id,

            'sender_type' => 'user',

            'sender_name' => $user->name,

            'sender_email' => $user->email,

            'message' => $validated['message'],

            'is_read' => false,

        ]);

        /*
        |--------------------------------------------------------------------------
        | Update Conversation
        |--------------------------------------------------------------------------
        */

        $conversation->update([

            'last_message_at' => now(),

        ]);

        /*
        |--------------------------------------------------------------------------
        | Notify Admins
        |--------------------------------------------------------------------------
        |
        | إرسال إشعار إلى المدراء عند إرسال المستخدم رسالة جديدة.
        |
        */

        $admins = User::query()
            ->where('role', 'admin')
            ->get();

        foreach ($admins as $admin) {

            $admin->notify(
                new NewConversationMessage(
                    $message
                )
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        return back()->with(
            'success',
            'Message sent successfully.'
        );
    }

    /**
     * ==========================================
     * Close Conversation
     * ==========================================
     */
    public function close(
        Conversation $conversation
    ): RedirectResponse {
        /*
        |--------------------------------------------------------------------------
        | Security
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $conversation->user_id === auth()->id(),
            403
        );

        /*
        |--------------------------------------------------------------------------
        | Close
        |--------------------------------------------------------------------------
        */

        $conversation->close();

        return back()->with(
            'success',
            'Conversation closed successfully.'
        );
    }

    /**
     * ==========================================
     * Reopen Conversation
     * ==========================================
     */
    public function reopen(
        Conversation $conversation
    ): RedirectResponse {
        /*
        |--------------------------------------------------------------------------
        | Security
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $conversation->user_id === auth()->id(),
            403
        );

        /*
        |--------------------------------------------------------------------------
        | Reopen
        |--------------------------------------------------------------------------
        */

        $conversation->reopen();

        return back()->with(
            'success',
            'Conversation reopened successfully.'
        );
    }
}
