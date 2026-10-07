<?php

namespace App\Http\Controllers\Education;

use App\Http\Controllers\Controller;
use App\Models\EducationBooking;
use App\Models\EducationStudentLesson;
use App\Models\EducationUser;

class EducationDashboardController extends Controller
{
    /**
     * Education Admin Dashboard
     */
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | STATISTICS
        |--------------------------------------------------------------------------
        */

        // إجمالي الطلاب
        $studentsCount = EducationUser::count();


        // إجمالي الحجوزات
        $bookingsCount = EducationBooking::count();


        // الحجوزات التي تحتاج مراجعة
        $pendingBookingsCount = EducationBooking::where(
            'status',
            'pending'
        )->count();


        // إجمالي الدروس النشطة المسندة للطلاب
        $activeLessonsCount = EducationStudentLesson::where(
            'is_active',
            true
        )->count();


        /*
        |--------------------------------------------------------------------------
        | RECENT BOOKINGS
        |--------------------------------------------------------------------------
        |
        | الحجز لا يعتمد على lesson مباشرة.
        |
        | لذلك نحمل:
        |
        | student
        | studentLessons
        |
        |--------------------------------------------------------------------------
        */

        $recentBookings = EducationBooking::with([
            'student',
            'studentLessons',
        ])
            ->latest()
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | UPCOMING BOOKINGS
        |--------------------------------------------------------------------------
        */

        $upcomingBookings = EducationBooking::with([
            'student',
            'studentLessons',
        ])
            ->whereIn('status', [
                'pending',
                'confirmed',
            ])
            ->where(function ($query) {

                $query
                    ->whereDate(
                        'booking_date',
                        '>',
                        today()
                    )
                    ->orWhere(function ($query) {

                        $query
                            ->whereDate(
                                'booking_date',
                                today()
                            )
                            ->whereTime(
                                'start_time',
                                '>=',
                                now()->format('H:i:s')
                            );

                    });

            })
            ->orderBy('booking_date')
            ->orderBy('start_time')
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | ADMIN DASHBOARD
        |--------------------------------------------------------------------------
        */

        return view(
            'education.admin.dashboard',
            compact(
                'studentsCount',
                'bookingsCount',
                'pendingBookingsCount',
                'activeLessonsCount',
                'recentBookings',
                'upcomingBookings'
            )
        );
    }
}
