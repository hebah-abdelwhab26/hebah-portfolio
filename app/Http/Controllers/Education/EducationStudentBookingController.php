<?php

namespace App\Http\Controllers\Education;

use App\Http\Controllers\Controller;
use App\Models\EducationBooking;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class EducationStudentBookingController extends Controller
{
    /**
     * عرض تفاصيل حجز الطالب.
     */
    public function show(EducationBooking $booking)
    {
        $student = Auth::guard('education')->user();

        if (!$student) {
            return redirect()
                ->route('education.login')
                ->withErrors([
                    'email' => 'يرجى تسجيل الدخول أولًا.',
                ]);
        }

        abort_unless(
            (int) $booking->education_user_id === (int) $student->id,
            403
        );

        $booking->load([
            'student',
            'bookingType',
            'payment',

            'studentLessons' => function ($query) {
                $query
                    ->where('is_active', true)
                    ->orderBy('session_number')
                    ->orderBy('id');
            },

            'studentLessons.sourceLesson',
            'studentLessons.contents',
            'studentLessons.evaluation',

            'lessonAssignments.lesson',
            'lessonAssignments.studentLesson',
        ]);

        $educationSettings = \App\Models\EducationSetting::query()->first();

        return view(
            'education.student.bookings.show',
            compact('booking', 'educationSettings')
        );
    }

    /**
     * إلغاء الحجز من قبل الطالب.
     */
    public function cancel(EducationBooking $booking): RedirectResponse
    {
        $student = Auth::guard('education')->user();

        /*
        |--------------------------------------------------------------------------
        | التحقق من تسجيل الدخول
        |--------------------------------------------------------------------------
        */

        if (!$student) {
            return redirect()
                ->route('education.login')
                ->withErrors([
                    'email' => 'يرجى تسجيل الدخول أولًا.',
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | التأكد من أن الحجز يخص الطالب الحالي
        |--------------------------------------------------------------------------
        */

        abort_unless(
            (int) $booking->education_user_id === (int) $student->id,
            403
        );

        /*
        |--------------------------------------------------------------------------
        | إذا كان الحجز ملغى بالفعل
        |--------------------------------------------------------------------------
        |
        | لا نعتبر هذه الحالة خطأ.
        | قد يصل طلب الإلغاء مرة أخرى بعد أن تم إلغاء الحجز بالفعل.
        |
        */

        if ($booking->status === 'cancelled') {
            return redirect()
                ->route('education.booking.show', $booking)
                ->with(
                    'success',
                    'هذا الحجز ملغى بالفعل.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | الحالات التي لا يمكن للطالب إلغاؤها
        |--------------------------------------------------------------------------
        */

        if (in_array($booking->status, [
            'completed',
            'no_show',
            'rejected',
        ], true)) {
            return redirect()
                ->route('education.booking.show', $booking)
                ->with(
                    'error',
                    'لا يمكن إلغاء هذا الحجز في حالته الحالية.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | السماح بالإلغاء فقط للحجوزات المعلقة أو المؤكدة
        |--------------------------------------------------------------------------
        */

        if (!in_array($booking->status, [
            'pending',
            'confirmed',
        ], true)) {
            return redirect()
                ->route('education.booking.show', $booking)
                ->with(
                    'error',
                    'لا يمكن إلغاء هذا الحجز في حالته الحالية.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | التأكد من وجود تاريخ للحجز
        |--------------------------------------------------------------------------
        */

        if (!$booking->booking_date) {
            return redirect()
                ->route('education.booking.show', $booking)
                ->with(
                    'error',
                    'لا يمكن إلغاء الحجز لعدم وجود موعد محدد له.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | التأكد من أن موعد الحجز لم ينتهِ
        |--------------------------------------------------------------------------
        */

        if ($booking->booking_date->isPast()) {
            return redirect()
                ->route('education.booking.show', $booking)
                ->with(
                    'error',
                    'لا يمكن إلغاء حجز انتهى موعده.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | إلغاء الحجز
        |--------------------------------------------------------------------------
        */

        $booking->update([
            'status' => 'cancelled',
        ]);

        /*
        |--------------------------------------------------------------------------
        | العودة إلى صفحة تفاصيل الحجز
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('education.booking.show', $booking)
            ->with(
                'success',
                'تم إلغاء الحجز بنجاح.'
            );
    }
}
