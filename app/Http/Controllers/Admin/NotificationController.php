<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\ContactMessage;
use App\Models\ConversationMessage;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class NotificationController extends Controller
{
    /**
     * ==========================================
     * Get Admin Notification Counters
     * ==========================================
     */
    public function counts(): JsonResponse
    {
        /*
        |--------------------------------------------------------------------------
        | Pending Comments
        |--------------------------------------------------------------------------
        */

        $pendingComments = Comment::where(
            'status',
            'pending'
        )->count();


        /*
        |--------------------------------------------------------------------------
        | New Conversation Messages
        |--------------------------------------------------------------------------
        |
        | Messages sent by users through the conversation system
        | and not yet read by admin.
        |
        */

        $newConversationMessages = ConversationMessage::where(
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
        | New Digital Studio Contact Messages
        |--------------------------------------------------------------------------
        |
        | Contact messages submitted through the Digital Studio
        | contact form only.
        |
        | Education messages are excluded by the source condition.
        |
        */

        $newContactMessages = ContactMessage::where(
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
        | Total New Messages
        |--------------------------------------------------------------------------
        */

        $newMessages =
            $newConversationMessages
            + $newContactMessages;


        /*
        |--------------------------------------------------------------------------
        | New Users
        |--------------------------------------------------------------------------
        |
        | Use the same session timestamp that AppServiceProvider
        | already uses.
        |
        */

        $usersSeenAt = session(
            'users_notification_seen_at'
        );


        if ($usersSeenAt) {

            $newUsers = User::where(
                'created_at',
                '>',
                $usersSeenAt
            )->count();

        } else {

            $newUsers = 0;

        }


        /*
        |--------------------------------------------------------------------------
        | Total Notifications
        |--------------------------------------------------------------------------
        */

        $totalNotifications =
            $pendingComments
            + $newMessages
            + $newUsers;


        /*
        |--------------------------------------------------------------------------
        | JSON Response
        |--------------------------------------------------------------------------
        */

        return response()->json([

            'pendingComments' =>
                $pendingComments,

            'newMessages' =>
                $newMessages,

            'newUsers' =>
                $newUsers,

            'totalNotifications' =>
                $totalNotifications,

        ]);
    }
}

