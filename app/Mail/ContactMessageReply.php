<?php

namespace App\Mail;

use App\Models\ContactMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMessageReply extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * رسالة الزائر الأصلية.
     */
    public ContactMessage $contactMessage;

    /**
     * نص الرد.
     */
    public string $reply;

    /**
     * إنشاء كائن الرسالة.
     */
    public function __construct(
        ContactMessage $contactMessage,
        string $reply
    ) {
        $this->contactMessage = $contactMessage;
        $this->reply = $reply;
    }

    /**
     * عنوان البريد وإعداداته.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'رد على رسالتك - Hebah Abdelwahab',
        );
    }

    /**
     * محتوى البريد.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-message-reply',
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
