<?php

namespace App\Http\Controllers\Education;

use App\Http\Controllers\Controller;
use App\Models\EducationBooking;
use App\Models\EducationLessonAssignment;
use App\Models\EducationStudentLesson;
use App\Models\EducationUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EducationLessonAssignmentController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    | عرض الدروس الخاصة بالطلاب
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $query = EducationLessonAssignment::query()
            ->with([
                'student',
                'booking',
                'studentLesson',
            ])
            ->latest('assigned_at');


        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = $request
                ->string('search')
                ->toString();

            $query->where(function ($query) use ($search) {

                $query->whereHas(
                    'student',
                    function ($studentQuery) use ($search) {

                        $studentQuery
                            ->where(
                                'name',
                                'like',
                                "%{$search}%"
                            )
                            ->orWhere(
                                'email',
                                'like',
                                "%{$search}%"
                            );
                    }
                );

                $query->orWhereHas(
                    'studentLesson',
                    function ($lessonQuery) use ($search) {

                        $lessonQuery->where(
                            'title',
                            'like',
                            "%{$search}%"
                        );
                    }
                );

            });
        }


        /*
        |--------------------------------------------------------------------------
        | STATUS FILTER
        |--------------------------------------------------------------------------
        */

        if ($request->filled('status')) {

            $status = $request
                ->string('status')
                ->toString();

            if (
                in_array(
                    $status,
                    [
                        'assigned',
                        'in_progress',
                        'completed',
                    ],
                    true
                )
            ) {

                $query->where(
                    'status',
                    $status
                );
            }
        }


        /*
        |--------------------------------------------------------------------------
        | PAGINATION
        |--------------------------------------------------------------------------
        */

        $assignments = $query
            ->paginate(15)
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | STATISTICS
        |--------------------------------------------------------------------------
        */

        $statistics = [

            'total' =>
                EducationLessonAssignment::count(),

            'assigned' =>
                EducationLessonAssignment::where(
                    'status',
                    'assigned'
                )->count(),

            'in_progress' =>
                EducationLessonAssignment::where(
                    'status',
                    'in_progress'
                )->count(),

            'completed' =>
                EducationLessonAssignment::where(
                    'status',
                    'completed'
                )->count(),

        ];


        return view(
            'education.admin.lesson-assignments.index',
            compact(
                'assignments',
                'statistics'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    | صفحة إنشاء درس خاص بالطالب
    |--------------------------------------------------------------------------
    |
    | مهم:
    |
    | لا نستخدم هنا EducationLesson.
    |
    | الدروس الموجودة في education_lessons هي دروس عامة للموقع
    | ولا علاقة لها بالطالب.
    |
    | هنا نختار الطالب + الحجز المدفوع + نكتب عنوان الدرس الخاص
    | بالطالب.
    |
    */

    public function create()
    {
        /*
        |--------------------------------------------------------------------------
        | STUDENTS
        |--------------------------------------------------------------------------
        */

        $students = EducationUser::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | PAID BOOKINGS
        |--------------------------------------------------------------------------
        |
        | لا نعرض هنا إلا الحجوزات التي تم تأكيد دفعها.
        |
        | لأن الدروس لا يتم إسنادها قبل الدفع.
        |
        */

        $bookings = EducationBooking::query()
            ->with([
                'bookingType',
            ])
            ->where(
                'payment_status',
                'paid'
            )
            ->whereIn(
                'status',
                [
                    'pending',
                    'confirmed',
                    'completed',
                ]
            )
            ->orderByDesc('id')
            ->get();


        return view(
            'education.admin.lesson-assignments.create',
            compact(
                'students',
                'bookings'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    | إنشاء درس خاص بالطالب وربطه بالحجز
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'education_user_id' => [
                'required',
                'integer',
                'exists:education_users,id',
            ],

            'education_booking_id' => [
                'required',
                'integer',
                'exists:education_bookings,id',
            ],

            /*
            |------------------------------------------------------------------
            | عناوين الدروس الخاصة بالطالب
            |------------------------------------------------------------------
            |
            | مثال:
            |
            | lesson_titles[]
            |
            | سورة الفاتحة
            | أحكام النون الساكنة
            | مراجعة الدرس السابق
            |
            */

            'lesson_titles' => [
                'required',
                'array',
                'min:1',
            ],

            'lesson_titles.*' => [
                'required',
                'string',
                'max:255',
            ],

            'status' => [
                'nullable',
                'in:assigned,in_progress,completed',
            ],

            'assigned_at' => [
                'nullable',
                'date',
            ],

            'notes' => [
                'nullable',
                'string',
                'max:5000',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],

        ], [

            'education_user_id.required' =>
                'يرجى اختيار الطالب.',

            'education_user_id.exists' =>
                'الطالب المحدد غير موجود.',

            'education_booking_id.required' =>
                'يرجى اختيار الحجز أو الباقة.',

            'education_booking_id.exists' =>
                'الحجز المحدد غير موجود.',

            'lesson_titles.required' =>
                'يرجى إضافة عنوان درس واحد على الأقل.',

            'lesson_titles.array' =>
                'قائمة الدروس غير صحيحة.',

            'lesson_titles.min' =>
                'يرجى إضافة عنوان درس واحد على الأقل.',

            'lesson_titles.*.required' =>
                'عنوان الدرس مطلوب.',

            'lesson_titles.*.max' =>
                'عنوان الدرس طويل جدًا.',
        ]);


        /*
        |--------------------------------------------------------------------------
        | STUDENT
        |--------------------------------------------------------------------------
        */

        $student = EducationUser::query()
            ->where(
                'id',
                $validated['education_user_id']
            )
            ->where(
                'is_active',
                true
            )
            ->first();

        if (!$student) {

            return back()
                ->withInput()
                ->withErrors([

                    'education_user_id' =>
                        'الطالب المحدد غير موجود أو غير نشط.',

                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | BOOKING
        |--------------------------------------------------------------------------
        |
        | يجب أن يكون الحجز تابعًا لنفس الطالب.
        |
        */

        $booking = EducationBooking::query()
            ->with('bookingType')
            ->where(
                'id',
                $validated['education_booking_id']
            )
            ->where(
                'education_user_id',
                $student->id
            )
            ->first();

        if (!$booking) {

            return back()
                ->withInput()
                ->withErrors([

                    'education_booking_id' =>
                        'الحجز المحدد غير موجود أو لا ينتمي إلى هذا الطالب.',

                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | PAYMENT CHECK
        |--------------------------------------------------------------------------
        |
        | لا يمكن إنشاء درس خاص للطالب قبل تأكيد الدفع.
        |
        */

        if (
            $booking->payment_status !== 'paid'
        ) {

            return back()
                ->withInput()
                ->withErrors([

                    'education_booking_id' =>
                        'لا يمكن إسناد الدروس قبل تأكيد دفع الحجز.',

                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | CLEAN TITLES
        |--------------------------------------------------------------------------
        */

        $lessonTitles = collect(
            $validated['lesson_titles']
        )
            ->map(function ($title) {

                return trim($title);

            })
            ->filter(function ($title) {

                return $title !== '';

            })
            ->values()
            ->all();


        if (empty($lessonTitles)) {

            return back()
                ->withInput()
                ->withErrors([

                    'lesson_titles' =>
                        'يرجى إضافة عنوان درس واحد على الأقل.',

                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | EXISTING LESSONS
        |--------------------------------------------------------------------------
        |
        | نحسب الدروس التي سبق حجزها/إسنادها لهذا الحجز.
        |
        | هذا مهم جدًا للباقة.
        |
        | مثال:
        |
        | الباقة = 8 جلسات
        |
        | تم إسناد 3 دروس بالفعل
        |
        | لا يمكن إضافة 6 دروس جديدة.
        |
        | المتاح = 5 فقط.
        |
        */

        $existingLessonsCount =
            EducationStudentLesson::query()
                ->where(
                    'education_booking_id',
                    $booking->id
                )
                ->where(
                    'status',
                    '!=',
                    'cancelled'
                )
                ->count();


        /*
        |--------------------------------------------------------------------------
        | TOTAL SESSIONS
        |--------------------------------------------------------------------------
        */

        $totalSessions =
            max(
                1,
                (int) $booking->total_sessions
            );


        /*
        |--------------------------------------------------------------------------
        | COMPLETED SESSIONS
        |--------------------------------------------------------------------------
        */

        $completedSessions =
            max(
                0,
                (int) $booking->completed_sessions
            );


        /*
        |--------------------------------------------------------------------------
        | RESERVED SESSIONS
        |--------------------------------------------------------------------------
        |
        | الجلسات الموجودة بالفعل ضمن هذا الحجز.
        |
        */

        $reservedSessions =
            max(
                0,
                $existingLessonsCount
            );


        /*
        |--------------------------------------------------------------------------
        | REMAINING SESSIONS
        |--------------------------------------------------------------------------
        */

        $remainingSessions =
            max(
                0,
                $totalSessions
                - $completedSessions
                - $reservedSessions
            );


        /*
        |--------------------------------------------------------------------------
        | REQUESTED LESSONS
        |--------------------------------------------------------------------------
        */

        $requestedLessonsCount =
            count($lessonTitles);


        /*
        |--------------------------------------------------------------------------
        | PREVENT EXCEEDING BOOKING
        |--------------------------------------------------------------------------
        */

        if (
            $requestedLessonsCount
            >
            $remainingSessions
        ) {

            return back()
                ->withInput()
                ->withErrors([

                    'lesson_titles' =>
                        "لا يمكن إضافة {$requestedLessonsCount} دروس. المتاح في هذا الحجز {$remainingSessions} جلسة فقط.",

                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | STATUS
        |--------------------------------------------------------------------------
        */

        $status =
            $validated['status']
            ?? 'assigned';


        /*
        |--------------------------------------------------------------------------
        | ASSIGNED AT
        |--------------------------------------------------------------------------
        */

        $assignedAt =
            !empty($validated['assigned_at'])
                ? $validated['assigned_at']
                : now();


        /*
        |--------------------------------------------------------------------------
        | ACTIVE
        |--------------------------------------------------------------------------
        */

        $isActive =
            $request->boolean(
                'is_active',
                true
            );


        /*
        |--------------------------------------------------------------------------
        | CREATE
        |--------------------------------------------------------------------------
        */

        $assignments = DB::transaction(
            function () use (
                $lessonTitles,
                $booking,
                $status,
                $assignedAt,
                $isActive,
                $validated
            ) {

                $createdAssignments = collect();


                /*
                |--------------------------------------------------------------------------
                | NEXT SESSION NUMBER
                |--------------------------------------------------------------------------
                |
                | مثال:
                |
                | تم إنشاء:
                | 1
                | 2
                | 3
                |
                | الدرس الجديد يبدأ من:
                | 4
                |
                */

                $nextSessionNumber =
                    EducationStudentLesson::query()
                        ->where(
                            'education_booking_id',
                            $booking->id
                        )
                        ->max('session_number');


                $nextSessionNumber =
                    $nextSessionNumber
                    ? ((int) $nextSessionNumber + 1)
                    : 1;


                /*
                |--------------------------------------------------------------------------
                | CREATE EACH LESSON
                |--------------------------------------------------------------------------
                */

                foreach (
                    $lessonTitles as $index => $title
                ) {

                    /*
                    |--------------------------------------------------------------------------
                    | ASSIGNMENT
                    |--------------------------------------------------------------------------
                    |
                    | education_lesson_id = NULL
                    |
                    | لأنه لا يوجد ارتباط بالدرس العام.
                    |
                    */

                    $assignment =
                        EducationLessonAssignment::create([

                            'education_user_id' =>
                                $booking->education_user_id,

                            'education_lesson_id' =>
                                null,

                            'education_booking_id' =>
                                $booking->id,

                            'status' =>
                                $status,

                            'assigned_at' =>
                                $assignedAt,

                            'started_at' =>
                                null,

                            'completed_at' =>
                                null,

                            'notes' =>
                                $validated['notes']
                                ?? null,

                            'is_active' =>
                                $isActive,

                        ]);


                    /*
                    |--------------------------------------------------------------------------
                    | STUDENT LESSON
                    |--------------------------------------------------------------------------
                    |
                    | هذا هو الدرس الحقيقي الذي سيظهر للطالب.
                    |
                    | ويمكننا لاحقًا إضافة المحتوى إليه
                    | دون الحاجة إلى أي EducationLesson عام.
                    |
                    */

                    $studentLesson =
                        EducationStudentLesson::create([

                            'education_user_id' =>
                                $booking->education_user_id,

                            'education_lesson_assignment_id' =>
                                $assignment->id,

                            'education_booking_id' =>
                                $booking->id,

                            'source_lesson_id' =>
                                null,

                            'session_number' =>
                                $nextSessionNumber + $index,

                            'title' =>
                                $title,

                            'description' =>
                                null,

                            'status' =>
                                $status,

                            'assigned_at' =>
                                $assignedAt,

                            'started_at' =>
                                null,

                            'completed_at' =>
                                null,

                            'notes' =>
                                $validated['notes']
                                ?? null,

                            'is_active' =>
                                $isActive,

                        ]);


                    $createdAssignments->push(
                        $assignment
                    );
                }


                return $createdAssignments;
            }
        );


        /*
        |--------------------------------------------------------------------------
        | VERIFY
        |--------------------------------------------------------------------------
        */

        if (
            $assignments->isEmpty()
        ) {

            return back()
                ->withInput()
                ->withErrors([

                    'lesson_titles' =>
                        'تعذر إنشاء الدروس. حاول مرة أخرى.',

                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | SUCCESS
        |--------------------------------------------------------------------------
        */

        $count =
            $assignments->count();


        /*
        |--------------------------------------------------------------------------
        | ONE LESSON
        |--------------------------------------------------------------------------
        */

        if ($count === 1) {

            $assignment =
                $assignments->first();

            return redirect()
                ->route(
                    'education.admin.lesson-assignments.show',
                    $assignment
                )
                ->with(
                    'success',
                    'تم إسناد الدرس للطالب وربطه بالحجز بنجاح.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | MULTIPLE LESSONS
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'education.admin.lesson-assignments.index'
            )
            ->with(
                'success',
                "تم إسناد {$count} دروس للطالب وربطها بالحجز بنجاح."
            );
    }


    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    | عرض تفاصيل الدرس الخاص بالطالب
    |--------------------------------------------------------------------------
    */

    public function show(
        EducationLessonAssignment $assignment
    ) {

        $assignment->load([

            'student',

            'booking.bookingType',

            'studentLesson.contents',

            'studentLesson.evaluation',

        ]);


        return view(
            'education.admin.lesson-assignments.show',
            compact('assignment')
        );
    }
}
