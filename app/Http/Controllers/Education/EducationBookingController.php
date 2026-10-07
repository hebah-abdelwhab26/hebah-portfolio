<?php

namespace App\Http\Controllers\Education;

use App\Http\Controllers\Controller;
use App\Models\EducationAdmin;
use App\Models\EducationAdminNotification;
use App\Models\EducationAvailability;
use App\Models\EducationBooking;
use App\Models\EducationBookingType;
use App\Models\EducationSetting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EducationBookingController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function create(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | AUTHENTICATED STUDENT
        |--------------------------------------------------------------------------
        */

        $student = Auth::guard('education')->user();

        /*
        |--------------------------------------------------------------------------
        | SELECTED VALUES
        |--------------------------------------------------------------------------
        */

        $selectedDate = $request->input('date');

        $selectedType = $request->input('booking_type');

        /*
        |--------------------------------------------------------------------------
        | AVAILABLE TIMES
        |--------------------------------------------------------------------------
        */

        $availabilities = collect();

        /*
        |--------------------------------------------------------------------------
        | BOOKING TYPES
        |--------------------------------------------------------------------------
        */

        $bookingTypes = EducationBookingType::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | LOAD AVAILABLE TIMES FOR SELECTED DATE
        |--------------------------------------------------------------------------
        */

        if ($selectedDate) {

            try {

                $date = Carbon::parse($selectedDate);

                /*
                |--------------------------------------------------------------------------
                | PREVENT PAST DATES
                |--------------------------------------------------------------------------
                */

                if ($date->isBefore(today())) {

                    $selectedDate = null;

                } else {

                    /*
                    |--------------------------------------------------------------------------
                    | DAY OF WEEK
                    |--------------------------------------------------------------------------
                    |
                    | 0 = Sunday
                    | 1 = Monday
                    | 2 = Tuesday
                    | 3 = Wednesday
                    | 4 = Thursday
                    | 5 = Friday
                    | 6 = Saturday
                    |
                    */

                    $dayOfWeek = $date->dayOfWeek;

                    /*
                    |--------------------------------------------------------------------------
                    | GET ACTIVE AVAILABILITIES
                    |--------------------------------------------------------------------------
                    */

                    $availabilities = EducationAvailability::query()
                        ->where('day_of_week', $dayOfWeek)
                        ->where('is_active', true)
                        ->orderBy('sort_order')
                        ->orderBy('start_time')
                        ->get();
                }

            } catch (\Throwable $e) {

                $selectedDate = null;

                $availabilities = collect();
            }
        }

        /*
        |--------------------------------------------------------------------------
        | RETURN BOOKING PAGE
        |--------------------------------------------------------------------------
        */

        return view(
            'education.student.bookings.create',
            [
                'student' => $student,
                'selectedDate' => $selectedDate,
                'selectedType' => $selectedType,
                'bookingTypes' => $bookingTypes,
                'availabilities' => $availabilities,
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | AUTHENTICATED STUDENT
        |--------------------------------------------------------------------------
        */

        $student = Auth::guard('education')->user();

        if (!$student) {

            return redirect()
                ->route('education.login')
                ->withErrors([
                    'email' => 'يرجى تسجيل الدخول أولًا.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            /*
            |--------------------------------------------------------------------------
            | BOOKING TYPE
            |--------------------------------------------------------------------------
            */

            'education_booking_type_id' => [
                'required',
                'integer',
                'exists:education_booking_types,id',
            ],

            /*
            |--------------------------------------------------------------------------
            | BOOKING DATE
            |--------------------------------------------------------------------------
            */

            'booking_date' => [
                'required',
                'date',
                'after_or_equal:today',
            ],

            /*
            |--------------------------------------------------------------------------
            | START TIME
            |--------------------------------------------------------------------------
            */

            'start_time' => [
                'required',
                'date_format:H:i',
            ],

            /*
            |--------------------------------------------------------------------------
            | END TIME
            |--------------------------------------------------------------------------
            */

            'end_time' => [
                'required',
                'date_format:H:i',
            ],

            /*
            |--------------------------------------------------------------------------
            | STUDENT NOTE
            |--------------------------------------------------------------------------
            */

            'student_note' => [
                'nullable',
                'string',
                'max:2000',
            ],

        ], [

            'education_booking_type_id.required' =>
                'يرجى اختيار نوع الحجز.',

            'education_booking_type_id.integer' =>
                'نوع الحجز المحدد غير صحيح.',

            'education_booking_type_id.exists' =>
                'نوع الحجز المحدد غير موجود.',

            'booking_date.required' =>
                'يرجى اختيار تاريخ الحجز.',

            'booking_date.date' =>
                'التاريخ المحدد غير صحيح.',

            'booking_date.after_or_equal' =>
                'لا يمكن اختيار تاريخ سابق لليوم.',

            'start_time.required' =>
                'يرجى اختيار وقت بداية الدرس.',

            'start_time.date_format' =>
                'تنسيق وقت البداية غير صحيح.',

            'end_time.required' =>
                'يرجى اختيار وقت نهاية الدرس.',

            'end_time.date_format' =>
                'تنسيق وقت النهاية غير صحيح.',

            'student_note.string' =>
                'ملاحظة الطالب يجب أن تكون نصًا.',

            'student_note.max' =>
                'ملاحظة الطالب طويلة جدًا.',
        ]);


        /*
        |--------------------------------------------------------------------------
        | GET ACTIVE BOOKING TYPE
        |--------------------------------------------------------------------------
        */

        $bookingType = EducationBookingType::query()
            ->whereKey($validated['education_booking_type_id'])
            ->where('is_active', true)
            ->first();

        if (!$bookingType) {

            return back()
                ->withInput()
                ->withErrors([
                    'education_booking_type_id' =>
                        'نوع الحجز المحدد غير متاح حاليًا.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | NORMALIZE DATE
        |--------------------------------------------------------------------------
        */

        $bookingDate = Carbon::parse(
            $validated['booking_date']
        )->format('Y-m-d');


        /*
        |--------------------------------------------------------------------------
        | NORMALIZE START TIME
        |--------------------------------------------------------------------------
        */

        $startTime = Carbon::createFromFormat(
            'H:i',
            $validated['start_time']
        )->format('H:i:s');


        /*
        |--------------------------------------------------------------------------
        | NORMALIZE END TIME
        |--------------------------------------------------------------------------
        */

        $endTime = Carbon::createFromFormat(
            'H:i',
            $validated['end_time']
        )->format('H:i:s');


        /*
        |--------------------------------------------------------------------------
        | CHECK TIME ORDER
        |--------------------------------------------------------------------------
        */

        if ($startTime >= $endTime) {

            return back()
                ->withInput()
                ->withErrors([
                    'start_time' =>
                        'وقت بداية الدرس يجب أن يكون قبل وقت النهاية.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | CHECK ADMIN AVAILABILITY
        |--------------------------------------------------------------------------
        |
        | الموعد يجب أن يكون داخل أحد الأوقات
        | التي أضافها الأدمن وفعّلها.
        |
        */

        $dateObject = Carbon::parse($bookingDate);

        $dayOfWeek = $dateObject->dayOfWeek;


        $availabilityExists = EducationAvailability::query()
            ->where('day_of_week', $dayOfWeek)
            ->where('is_active', true)
            ->where('start_time', '<=', $startTime)
            ->where('end_time', '>=', $endTime)
            ->exists();


        if (!$availabilityExists) {

            return back()
                ->withInput()
                ->withErrors([
                    'start_time' =>
                        'الموعد المحدد خارج أوقات التدريس المتاحة.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | CHECK STUDENT DOUBLE BOOKING
        |--------------------------------------------------------------------------
        |
        | الطالب لا يستطيع إنشاء حجزين
        | في نفس التاريخ والوقت.
        |
        */

        $studentAlreadyBooked = EducationBooking::query()
            ->where('education_user_id', $student->id)
            ->where('booking_date', $bookingDate)
            ->where('start_time', $startTime)
            ->where('end_time', $endTime)
            ->whereIn('status', [
                'pending',
                'confirmed',
            ])
            ->exists();


        if ($studentAlreadyBooked) {

            return back()
                ->withInput()
                ->withErrors([
                    'start_time' =>
                        'لديك بالفعل حجز في هذا الموعد.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | CHECK GLOBAL TIME CONFLICT
        |--------------------------------------------------------------------------
        |
        | يمنع حجز نفس الموعد من طالب آخر.
        |
        */

        $alreadyBooked = EducationBooking::query()
            ->where('booking_date', $bookingDate)
            ->where('start_time', $startTime)
            ->where('end_time', $endTime)
            ->whereIn('status', [
                'pending',
                'confirmed',
            ])
            ->exists();


        if ($alreadyBooked) {

            return back()
                ->withInput()
                ->withErrors([
                    'start_time' =>
                        'عذرًا، هذا الموعد لم يعد متاحًا. يرجى اختيار موعد آخر.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | CREATE BOOKING
        |--------------------------------------------------------------------------
        */

        $booking = DB::transaction(function () use (
            $student,
            $bookingType,
            $bookingDate,
            $startTime,
            $endTime,
            $validated
        ) {

            /*
            |--------------------------------------------------------------------------
            | TOTAL SESSIONS
            |--------------------------------------------------------------------------
            |
            | الحقل الصحيح في EducationBookingType هو:
            |
            | total_sessions
            |
            */

            $totalSessions = max(
                1,
                (int) ($bookingType->total_sessions ?? 1)
            );


            /*
            |--------------------------------------------------------------------------
            | CREATE BOOKING
            |--------------------------------------------------------------------------
            */

            return EducationBooking::create([

                /*
                |--------------------------------------------------------------------------
                | STUDENT
                |--------------------------------------------------------------------------
                */

                'education_user_id' =>
                    $student->id,


                /*
                |--------------------------------------------------------------------------
                | BOOKING TYPE
                |--------------------------------------------------------------------------
                */

                'education_booking_type_id' =>
                    $bookingType->id,


                /*
                |--------------------------------------------------------------------------
                | BOOKING SNAPSHOT
                |--------------------------------------------------------------------------
                */

                'title' =>
                    $bookingType->name,

                'description' =>
                    $bookingType->description,


                /*
                |--------------------------------------------------------------------------
                | SESSIONS
                |--------------------------------------------------------------------------
                */

                'total_sessions' =>
                    $totalSessions,

                'completed_sessions' =>
                    0,


                /*
                |--------------------------------------------------------------------------
                | PRICE SNAPSHOT
                |--------------------------------------------------------------------------
                */

                'price' =>
                    $bookingType->price,

                'currency' =>
                    $bookingType->currency ?? 'SAR',


                /*
                |--------------------------------------------------------------------------
                | BOOKING DATE & TIME
                |--------------------------------------------------------------------------
                */

                'booking_date' =>
                    $bookingDate,

                'start_time' =>
                    $startTime,

                'end_time' =>
                    $endTime,


                /*
                |--------------------------------------------------------------------------
                | PAYMENT
                |--------------------------------------------------------------------------
                */

                'payment_status' =>
                    'unpaid',


                /*
                |--------------------------------------------------------------------------
                | BOOKING STATUS
                |--------------------------------------------------------------------------
                */

                'status' =>
                    'pending',


                /*
                |--------------------------------------------------------------------------
                | STUDENT NOTE
                |--------------------------------------------------------------------------
                */

                'student_note' =>
                    $validated['student_note'] ?? null,

                'admin_note' =>
                    null,


                /*
                |--------------------------------------------------------------------------
                | REMINDER
                |--------------------------------------------------------------------------
                */

                'reminder_sent' =>
                    false,
            ]);
        });


        /*
        |--------------------------------------------------------------------------
        | ADMIN NOTIFICATION
        |--------------------------------------------------------------------------
        |
        | إشعار جميع حسابات الإدارة النشطة بوجود حجز جديد.
        |
        | مهم:
        | يجب هنا جلب الحسابات من EducationAdmin،
        | وليس من EducationAdminNotification.
        |
        */

        EducationAdmin::query()
            ->where('is_active', true)
            ->get()
            ->each(function ($admin) use (
                $booking,
                $student,
                $bookingType
            ) {

                EducationAdminNotification::create([

                    'education_admin_id' =>
                        $admin->id,

                    'type' =>
                        'new_booking',

                    'title' =>
                        'حجز جديد',

                    'message' =>
                        'قام الطالب ' .
                        $student->name .
                        ' بإرسال طلب حجز جديد: ' .
                        $bookingType->name,

                    'icon' =>
                        'calendar-plus',

                    'color' =>
                        'gold',

                    'url' =>
                        route(
                            'education.admin.bookings.show',
                            $booking
                        ),

                    'read_at' =>
                        null,

                    'data' => [

                        'booking_id' =>
                            $booking->id,

                        'student_id' =>
                            $student->id,

                        'student_name' =>
                            $student->name,

                        'booking_type_id' =>
                            $bookingType->id,

                        'booking_type_name' =>
                            $bookingType->name,

                        'booking_date' =>
                            $booking->booking_date,

                        'start_time' =>
                            $booking->start_time,

                        'end_time' =>
                            $booking->end_time,

                    ],
                ]);
            });


        /*
        |--------------------------------------------------------------------------
        | SUCCESS
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('education.dashboard')
            ->with(
                'booking_success',
                'تم إرسال طلب الحجز بنجاح. سيتم مراجعة الحجز وتأكيده من الإدارة.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */

    public function show(EducationBooking $booking)
    {
        /*
        |--------------------------------------------------------------------------
        | AUTHENTICATED STUDENT
        |--------------------------------------------------------------------------
        */

        $student = Auth::guard('education')->user();

        if (!$student) {

            return redirect()
                ->route('education.login')
                ->withErrors([
                    'email' =>
                        'يرجى تسجيل الدخول أولًا.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | AUTHORIZE BOOKING
        |--------------------------------------------------------------------------
        |
        | الطالب يستطيع مشاهدة حجوزه فقط.
        |
        */

        abort_unless(
            (int) $booking->education_user_id ===
            (int) $student->id,
            403
        );


        /*
        |--------------------------------------------------------------------------
        | LOAD RELATIONS
        |--------------------------------------------------------------------------
        */

        $booking->load([

            /*
            |--------------------------------------------------------------------------
            | STUDENT
            |--------------------------------------------------------------------------
            */

            'student',


            /*
            |--------------------------------------------------------------------------
            | BOOKING TYPE
            |--------------------------------------------------------------------------
            */

            'bookingType',


            /*
            |--------------------------------------------------------------------------
            | PAYMENT
            |--------------------------------------------------------------------------
            */

            'payment',


            /*
            |--------------------------------------------------------------------------
            | LESSON ASSIGNMENTS
            |--------------------------------------------------------------------------
            */

            'lessonAssignments.lesson',

            'lessonAssignments.studentLesson',


            /*
            |--------------------------------------------------------------------------
            | STUDENT LESSONS
            |--------------------------------------------------------------------------
            */

            'studentLessons' => function ($query) {

                $query
                    ->where('is_active', true)
                    ->orderBy('session_number')
                    ->orderBy('id');
            },


            /*
            |--------------------------------------------------------------------------
            | SOURCE LESSON
            |--------------------------------------------------------------------------
            */

            'studentLessons.sourceLesson',


            /*
            |--------------------------------------------------------------------------
            | CONTENTS
            |--------------------------------------------------------------------------
            */

            'studentLessons.contents',


            /*
            |--------------------------------------------------------------------------
            | EVALUATION
            |--------------------------------------------------------------------------
            */

            'studentLessons.evaluation',

        ]);


        /*
        |--------------------------------------------------------------------------
        | EDUCATION SETTINGS
        |--------------------------------------------------------------------------
        */

        $educationSettings = EducationSetting::query()
            ->first();


        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'education.student.bookings.show',
            compact(
                'booking',
                'educationSettings'
            )
        );
    }
}

