<?php

namespace App\Notifications;

use App\Models\Conversation;
use App\Models\ConversationMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewConversationMessage extends Notification
{
    use Queueable;

    /**
     * الرسالة الجديدة
     */
    public ConversationMessage $message;

    /**
     * المحادثة
     */
    public Conversation $conversation;

    /**
     * إنشاء Notification جديد
     */
    public function __construct(
        ConversationMessage $message
    ) {
        $this->message = $message;

        $this->conversation = $message->conversation;
    }

    /**
     * Notification Channels
     */
    public function via(object $notifiable): array
    {
        return [
            'database',
        ];
    }

    /**
     * Notification Data
     */
    public function toArray(object $notifiable): array
    {
        $isAdmin = $this->message->sender_type === 'admin';

        return [

            /*
            |--------------------------------------------------------------------------
            | Type
            |--------------------------------------------------------------------------
            */

            'type' => 'conversation_message',

            /*
            |--------------------------------------------------------------------------
            | Title
            |--------------------------------------------------------------------------
            */

            'title' => $isAdmin
                ? 'New Reply'
                : 'New Message',

            /*
            |--------------------------------------------------------------------------
            | Icon
            |--------------------------------------------------------------------------
            */

            'icon' => 'fa-envelope',

            /*
            |--------------------------------------------------------------------------
            | Conversation
            |--------------------------------------------------------------------------
            */

            'conversation_id' =>
                $this->conversation->id,

            'conversation_subject' =>
                $this->conversation->subject,

            /*
            |--------------------------------------------------------------------------
            | Message
            |--------------------------------------------------------------------------
            */

            'message_id' =>
                $this->message->id,

            'sender_type' =>
                $this->message->sender_type,

            'sender_name' =>
                $this->message->sender_name,

            'message' =>
                $this->message->message,

            /*
            |--------------------------------------------------------------------------
            | URL
            |--------------------------------------------------------------------------
            */

            'url' =>
                $this->conversationUrl($notifiable),
        ];
    }

    /**
     * رابط المحادثة حسب المستقبل
     */
    protected function conversationUrl(
        object $notifiable
    ): string {

        /*
        |--------------------------------------------------------------------------
        | Admin
        |--------------------------------------------------------------------------
        */

        if (
            method_exists(
                $notifiable,
                'isAdmin'
            )
            &&
            $notifiable->isAdmin()
        ) {

            return route(
                'admin.conversations.show',
                $this->conversation
            );
        }


        /*
        |--------------------------------------------------------------------------
        | User
        |--------------------------------------------------------------------------
        */

        return route(
            'conversations.show',
            $this->conversation
        );
    }
}
