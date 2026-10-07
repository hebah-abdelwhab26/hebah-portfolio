<?php

namespace App\Mail;

use App\Models\EducationBooking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EducationLessonReminderMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public EducationBooking $booking;

    public string $mailLocale;

    public function __construct(EducationBooking $booking)
    {
        $this->booking = $booking;

        $studentLocale = $booking->student?->locale;

        $this->mailLocale = in_array($studentLocale, ['ar', 'en'], true)
            ? $studentLocale
            : 'ar';
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: trans(
                'education.email.lesson_reminder_subject',
                [],
                $this->mailLocale
            ),
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.education.lesson-reminder',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
