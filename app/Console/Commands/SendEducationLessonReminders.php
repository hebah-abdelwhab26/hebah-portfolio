<?php

namespace App\Console\Commands;

use App\Mail\EducationLessonReminderMail;
use App\Models\EducationBooking;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEducationLessonReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * --booking موجود للاختبار اليدوي فقط.
     */
    protected $signature = 'education:send-lesson-reminders
                            {--booking= : إرسال تذكير لحجز محدد للاختبار}';

    /**
     * The console command description.
     */
    protected $description = 'إرسال تذكيرات البريد الإلكتروني للطلاب قبل موعد الدرس بـ 10 دقائق';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        /*
        |--------------------------------------------------------------------------
        | TEST SPECIFIC BOOKING
        |--------------------------------------------------------------------------
        */

        if ($this->option('booking')) {

            $booking = EducationBooking::query()
                ->with([
                    'student',
                    'bookingType',
                ])
                ->find($this->option('booking'));

            if (!$booking) {

                $this->error(
                    'الحجز المحدد غير موجود.'
                );

                return self::FAILURE;
            }

            return $this->sendReminder(
                $booking,
                true
            );
        }


        /*
        |--------------------------------------------------------------------------
        | CURRENT TIME
        |--------------------------------------------------------------------------
        */

        $now = now();


        /*
        |--------------------------------------------------------------------------
        | REMINDER WINDOW
        |--------------------------------------------------------------------------
        |
        | نستخدم نافذة من 9 إلى 11 دقيقة قبل الموعد.
        |
        | السبب:
        | Scheduler يعمل كل دقيقة، وقد يحدث تأخير بسيط
        | في تنفيذ Cron.
        |
        */

        $from = $now->copy()->addMinutes(9);

        $to = $now->copy()->addMinutes(11);


        /*
        |--------------------------------------------------------------------------
        | GET CONFIRMED BOOKINGS
        |--------------------------------------------------------------------------
        */

        $bookings = EducationBooking::query()
            ->with([
                'student',
                'bookingType',
            ])
            ->where(
                'status',
                'confirmed'
            )
            ->where(
                'reminder_sent',
                false
            )
            ->whereNotNull(
                'booking_date'
            )
            ->whereNotNull(
                'start_time'
            )
            ->get();


        /*
        |--------------------------------------------------------------------------
        | PROCESS
        |--------------------------------------------------------------------------
        */

        $sent = 0;

        foreach ($bookings as $booking) {

            $lessonStart = $this->getLessonStart(
                $booking
            );

            if (!$lessonStart) {
                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | CHECK REMINDER WINDOW
            |--------------------------------------------------------------------------
            */

            if (
                $lessonStart->betweenIncluded(
                    $from,
                    $to
                )
            ) {

                $result = $this->sendReminder(
                    $booking
                );

                if ($result === self::SUCCESS) {
                    $sent++;
                }
            }
        }


        /*
        |--------------------------------------------------------------------------
        | OUTPUT
        |--------------------------------------------------------------------------
        */

        $this->info(
            "تم إرسال {$sent} تذكير."
        );

        return self::SUCCESS;
    }


    /**
     * Get lesson start datetime.
     */
    private function getLessonStart(
        EducationBooking $booking
    ): ?Carbon {

        if (
            !$booking->booking_date ||
            !$booking->start_time
        ) {
            return null;
        }


        try {

            return Carbon::parse(
                $booking->booking_date->format('Y-m-d')
                . ' '
                . $booking->start_time->format('H:i:s')
            );

        } catch (\Throwable $e) {

            $this->error(
                "تعذر قراءة موعد الحجز رقم {$booking->id}."
            );

            return null;
        }
    }


    /**
     * Send reminder.
     */
    private function sendReminder(
        EducationBooking $booking,
        bool $test = false
    ): int {

        /*
        |--------------------------------------------------------------------------
        | STUDENT
        |--------------------------------------------------------------------------
        */

        $student = $booking->student;


        if (!$student) {

            $this->warn(
                "الحجز رقم {$booking->id} لا يحتوي على طالب."
            );

            return self::FAILURE;
        }


        /*
        |--------------------------------------------------------------------------
        | EMAIL
        |--------------------------------------------------------------------------
        */

        $email = trim(
            (string) ($student->email ?? '')
        );


        if (
            !$email ||
            !filter_var(
                $email,
                FILTER_VALIDATE_EMAIL
            )
        ) {

            $this->warn(
                "الطالب المرتبط بالحجز رقم {$booking->id} لا يملك بريدًا إلكترونيًا صالحًا."
            );

            return self::FAILURE;
        }


        /*
        |--------------------------------------------------------------------------
        | PREVENT DUPLICATE
        |--------------------------------------------------------------------------
        */

        if (
            !$test &&
            $booking->reminder_sent
        ) {

            return self::SUCCESS;
        }


        /*
        |--------------------------------------------------------------------------
        | SEND EMAIL
        |--------------------------------------------------------------------------
        */

        try {

            Mail::to($email)
                ->send(
                    new EducationLessonReminderMail(
                        $booking
                    )
                );


            /*
            |--------------------------------------------------------------------------
            | MARK AS SENT
            |--------------------------------------------------------------------------
            |
            | لا نضع true إلا بعد نجاح عملية الإرسال.
            |
            */

            if (!$test) {

                $booking->update([
                    'reminder_sent' => true,
                ]);
            }


            $this->info(
                $test
                    ? "تم إرسال بريد اختبار للحجز رقم {$booking->id} إلى {$email}."
                    : "تم إرسال التذكير للحجز رقم {$booking->id} إلى {$email}."
            );

            return self::SUCCESS;

        } catch (\Throwable $e) {

            report($e);

            $this->error(
                "فشل إرسال البريد للحجز رقم {$booking->id}: "
                . $e->getMessage()
            );

            return self::FAILURE;
        }
    }
}
