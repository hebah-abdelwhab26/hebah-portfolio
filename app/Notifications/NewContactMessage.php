<?php

namespace App\Notifications;

use App\Models\ContactMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewContactMessage extends Notification
{
    use Queueable;

    /**
     * رسالة التواصل
     */
    public ContactMessage $contactMessage;

    /**
     * إنشاء Notification جديد
     */
    public function __construct(
        ContactMessage $contactMessage
    ) {
        $this->contactMessage = $contactMessage;
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
        return [

            /*
            |--------------------------------------------------------------------------
            | Type
            |--------------------------------------------------------------------------
            */

            'type' => 'contact_message',

            /*
            |--------------------------------------------------------------------------
            | Title
            |--------------------------------------------------------------------------
            */

            'title' => 'رسالة تواصل جديدة',

            /*
            |--------------------------------------------------------------------------
            | Icon
            |--------------------------------------------------------------------------
            */

            'icon' => 'fa-envelope',

            /*
            |--------------------------------------------------------------------------
            | Message
            |--------------------------------------------------------------------------
            */

            'message' =>
                'وصلت رسالة جديدة من ' .
                $this->contactMessage->name,

            /*
            |--------------------------------------------------------------------------
            | Contact Message
            |--------------------------------------------------------------------------
            */

            'contact_message_id' =>
                $this->contactMessage->id,

            'name' =>
                $this->contactMessage->name,

            'email' =>
                $this->contactMessage->email,

            'subject' =>
                $this->contactMessage->subject,

            /*
            |--------------------------------------------------------------------------
            | URL
            |--------------------------------------------------------------------------
            */

            'url' => route(
                'admin.conversations.contact.show',
                $this->contactMessage
            ),
        ];
    }
}
