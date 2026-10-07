<?php

namespace App\Mail;

use App\Models\ContactMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMessageReceived extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * الرسالة المستلمة.
     */
    public ContactMessage $contactMessage;

    /**
     * إنشاء كائن الرسالة.
     */
    public function __construct(ContactMessage $contactMessage)
    {
        $this->contactMessage = $contactMessage;
    }

    /**
     * عنوان البريد وإعداداته.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'رسالة اتصال جديدة من ' . $this->contactMessage->name,
        );
    }

    /**
     * محتوى البريد.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-message-received',
        );
    }

    /**
     * المرفقات.
     */
    public function attachments(): array
    {
        return [];
    }
}

