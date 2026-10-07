<?php

namespace App\Http\Controllers\Education;

use App\Http\Controllers\Controller;
use App\Models\EducationBooking;
use App\Models\EducationStudentLesson;
use Illuminate\Support\Facades\Auth;

class EducationStudentDashboardController extends Controller
{
    /**
     * ============================================================
     * STUDENT DASHBOARD
     * ============================================================
     */
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | CURRENT STUDENT
        |--------------------------------------------------------------------------
        */

        $student = Auth::guard('education')->user();

        if (!$student) {

            return redirect()
                ->route('education.login')
                ->with(
                    'status',
                    'يرجى تسجيل الدخول للوصول إلى لوحة الطالب.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | ALL STUDENT BOOKINGS
        |--------------------------------------------------------------------------
        */

        $bookings = EducationBooking::query()
            ->where(
                'education_user_id',
                $student->id
            )
            ->orderBy('booking_date')
            ->orderBy('start_time')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | TOTAL BOOKINGS
        |--------------------------------------------------------------------------
        */

        $totalBookings = $bookings->count();


        /*
        |--------------------------------------------------------------------------
        | STUDENT LESSONS
        |--------------------------------------------------------------------------
        */

        $studentLessons = EducationStudentLesson::query()
            ->where(
                'education_user_id',
                $student->id
            )
            ->where('is_active', true)
            ->orderBy('session_number')
            ->orderBy('id')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | COMPLETED STUDENT LESSONS
        |--------------------------------------------------------------------------
        */

        $completedStudentLessons = $studentLessons
            ->where('status', 'completed')
            ->values();


        /*
        |--------------------------------------------------------------------------
        | UPCOMING BOOKINGS
        |--------------------------------------------------------------------------
        */

        $upcomingBookings = $bookings
            ->whereIn('status', [
                'pending',
                'confirmed',
            ])
            ->filter(function ($booking) {

                /*
                | إذا لم يوجد تاريخ للحجز
                */

                if (!$booking->booking_date) {
                    return false;
                }


                /*
                | موعد اليوم
                */

                if ($booking->booking_date->isToday()) {

                    return !$booking->start_time
                        || $booking->start_time >= now()->format('H:i:s');
                }


                /*
                | تاريخ مستقبلي
                */

                return $booking->booking_date->isFuture();
            })
            ->sortBy(function ($booking) {

                return $booking->booking_date
                    ? $booking->booking_date->format('Y-m-d')
                        . ' '
                        . ($booking->start_time ?? '00:00:00')
                    : '9999-12-31 23:59:59';
            })
            ->values();


        /*
        |--------------------------------------------------------------------------
        | NEXT BOOKING
        |--------------------------------------------------------------------------
        */

        $nextBooking = $upcomingBookings->first();


        /*
        |--------------------------------------------------------------------------
        | COMPLETED BOOKINGS
        |--------------------------------------------------------------------------
        */

        $completedBookings = $bookings
            ->where('status', 'completed')
            ->sortByDesc(function ($booking) {

                return $booking->booking_date
                    ? $booking->booking_date->format('Y-m-d')
                        . ' '
                        . ($booking->start_time ?? '00:00:00')
                    : '0000-00-00 00:00:00';
            })
            ->values();


        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'education.dashboard',
            compact(
                'student',
                'bookings',
                'upcomingBookings',
                'nextBooking',
                'completedBookings',
                'totalBookings',
                'studentLessons',
                'completedStudentLessons',
            )
        );
    }
}
