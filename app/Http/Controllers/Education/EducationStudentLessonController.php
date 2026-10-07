<?php

namespace App\Http\Controllers\Education;

use App\Http\Controllers\Controller;
use App\Models\EducationBooking;
use App\Models\EducationLesson;
use App\Models\EducationLessonAssignment;
use App\Models\EducationStudentLesson;
use App\Models\EducationUser;
use App\Models\EducationUserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class EducationStudentLessonController extends Controller
{
    /**
     * =========================================================
     * INDEX
     * =========================================================
     */
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | BASE QUERY
        |--------------------------------------------------------------------------
        */

        $query = EducationStudentLesson::query()
            ->with([
                'student',
                'sourceLesson',
                'booking',
                'assignment',
            ]);

        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = trim(
                $request->input('search')
            );

            $query->where(function ($q) use ($search) {

                $q->where(
                    'title',
                    'like',
                    "%{$search}%"
                )

                ->orWhereHas(
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
                )

                ->orWhereHas(
                    'sourceLesson',
                    function ($lessonQuery) use ($search) {

                        $lessonQuery->where(
                            'title',
                            'like',
                            "%{$search}%"
                        );
                    }
                )

                ->orWhereHas(
                    'booking',
                    function ($bookingQuery) use ($search) {

                        $bookingQuery
                            ->where(
                                'title',
                                'like',
                                "%{$search}%"
                            )
                            ->orWhere(
                                'payment_reference',
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

            $status = $request->input('status');

            if (in_array($status, [
                'assigned',
                'in_progress',
                'completed',
                'cancelled',
            ], true)) {

                $query->where(
                    'status',
                    $status
                );
            }
        }

        /*
        |--------------------------------------------------------------------------
        | ORDER
        |--------------------------------------------------------------------------
        */

        $studentLessons = $query
            ->latest('id')
            ->paginate(15)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | STATISTICS
        |--------------------------------------------------------------------------
        */

        $statistics = [

            'total' =>
                EducationStudentLesson::count(),

            'assigned' =>
                EducationStudentLesson::where(
                    'status',
                    'assigned'
                )->count(),

            'in_progress' =>
                EducationStudentLesson::where(
                    'status',
                    'in_progress'
                )->count(),

            'completed' =>
                EducationStudentLesson::where(
                    'status',
                    'completed'
                )->count(),

            'cancelled' =>
                EducationStudentLesson::where(
                    'status',
                    'cancelled'
                )->count(),

        ];

        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'education.admin.student-lessons.index',
            compact(
                'studentLessons',
                'statistics'
            )
        );
    }


    /**
     * =========================================================
     * CREATE
     * =========================================================
     */
    public function create()
    {
        /*
        |--------------------------------------------------------------------------
        | STUDENTS
        |--------------------------------------------------------------------------
        */

        $students = EducationUser::query()
            ->orderBy('name')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | ACTIVE LESSONS
        |--------------------------------------------------------------------------
        */

        $lessons = EducationLesson::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | BOOKINGS
        |--------------------------------------------------------------------------
        */

        $bookings = EducationBooking::query()
            ->with([
                'student',
                'bookingType',
                'studentLessons',
            ])
            ->latest('id')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | ASSIGNMENTS WITHOUT STUDENT LESSON
        |--------------------------------------------------------------------------
        */

        $assignments = EducationLessonAssignment::query()
            ->with([
                'student',
                'lesson',
                'booking',
                'studentLesson',
            ])
            ->whereDoesntHave('studentLesson')
            ->latest('id')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'education.admin.student-lessons.create',
            compact(
                'students',
                'lessons',
                'bookings',
                'assignments'
            )
        );
    }


    /**
     * =========================================================
     * STORE
     * =========================================================
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
                'exists:education_users,id',
            ],

            'education_lesson_assignment_id' => [
                'nullable',
                'exists:education_lesson_assignments,id',
            ],

            'education_booking_id' => [
                'required',
                'exists:education_bookings,id',
            ],

            'source_lesson_id' => [
                'nullable',
                'exists:education_lessons,id',
            ],

            'session_number' => [
                'nullable',
                'integer',
                'min:1',
            ],

            'title' => [
                'nullable',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'status' => [
                'nullable',
                'in:assigned,in_progress,completed,cancelled',
            ],

            'assigned_at' => [
                'nullable',
                'date',
            ],

            'started_at' => [
                'nullable',
                'date',
            ],

            'completed_at' => [
                'nullable',
                'date',
            ],

            'notes' => [
                'nullable',
                'string',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],

        ]);

        try {

            /*
            |--------------------------------------------------------------------------
            | ASSIGNMENT
            |--------------------------------------------------------------------------
            */

            $assignment = null;

            if (!empty($validated['education_lesson_assignment_id'])) {

                $assignment = EducationLessonAssignment::query()
                    ->with([
                        'student',
                        'lesson',
                        'booking',
                        'studentLesson',
                    ])
                    ->findOrFail(
                        $validated['education_lesson_assignment_id']
                    );

                /*
                |--------------------------------------------------------------
                | ASSIGNMENT OWNERSHIP
                |--------------------------------------------------------------
                */

                if (
                    (int) $assignment->education_user_id
                    !==
                    (int) $validated['education_user_id']
                ) {

                    return back()
                        ->withInput()
                        ->withErrors([
                            'education_lesson_assignment_id' =>
                                'هذا التكليف لا ينتمي إلى الطالب المحدد.',
                        ]);
                }

                /*
                |--------------------------------------------------------------
                | DUPLICATE STUDENT LESSON
                |--------------------------------------------------------------
                */

                if ($assignment->studentLesson) {

                    return back()
                        ->withInput()
                        ->withErrors([
                            'education_lesson_assignment_id' =>
                                'تم إنشاء درس للطالب من هذا التكليف مسبقًا.',
                        ]);
                }
            }

            /*
            |--------------------------------------------------------------------------
            | BOOKING
            |--------------------------------------------------------------------------
            */

            $booking = EducationBooking::query()
                ->with([
                    'student',
                    'bookingType',
                    'studentLessons',
                ])
                ->findOrFail(
                    $validated['education_booking_id']
                );

            /*
            |--------------------------------------------------------------------------
            | BOOKING OWNERSHIP
            |--------------------------------------------------------------------------
            */

            if (
                (int) $booking->education_user_id
                !==
                (int) $validated['education_user_id']
            ) {

                return back()
                    ->withInput()
                    ->withErrors([
                        'education_booking_id' =>
                            'الحجز لا ينتمي إلى الطالب المحدد.',
                    ]);
            }

            /*
            |--------------------------------------------------------------------------
            | PAYMENT CHECK
            |--------------------------------------------------------------------------
            */

            if (!$this->isBookingPaid($booking)) {

                return back()
                    ->withInput()
                    ->withErrors([
                        'education_booking_id' =>
                            'لا يمكن إنشاء جلسة لهذا الحجز قبل تأكيد الدفع.',
                    ]);
            }

            /*
            |--------------------------------------------------------------------------
            | BOOKING STATUS CHECK
            |--------------------------------------------------------------------------
            */

            if (!$this->isBookingConfirmed($booking)) {

                return back()
                    ->withInput()
                    ->withErrors([
                        'education_booking_id' =>
                            'لا يمكن إنشاء جلسة لهذا الحجز قبل تأكيد الحجز.',
                    ]);
            }

            /*
            |--------------------------------------------------------------------------
            | TOTAL SESSIONS
            |--------------------------------------------------------------------------
            */

            $totalSessions = null;

            if ($booking->bookingType) {

                $totalSessions =
                    $booking->bookingType->total_sessions
                    ?? null;
            }

            /*
            |--------------------------------------------------------------------------
            | REMAINING SESSIONS
            |--------------------------------------------------------------------------
            */

            if (
                $totalSessions !== null
                &&
                (int) $booking->studentLessons->count()
                >=
                (int) $totalSessions
            ) {

                return back()
                    ->withInput()
                    ->withErrors([
                        'education_booking_id' =>
                            'تم الوصول إلى العدد الإجمالي للجلسات المسموح بها لهذا الحجز.',
                    ]);
            }

            /*
            |--------------------------------------------------------------------------
            | CREATE STUDENT LESSON
            |--------------------------------------------------------------------------
            */

            $studentLesson = DB::transaction(
                function () use (
                    $validated,
                    $assignment,
                    $booking
                ) {

                    /*
                    |----------------------------------------------------------
                    | SOURCE LESSON
                    |----------------------------------------------------------
                    */

                    $sourceLessonId =
                        $validated['source_lesson_id']
                        ?? (
                            $assignment?->education_lesson_id
                        );

                    /*
                    |----------------------------------------------------------
                    | SESSION NUMBER
                    |----------------------------------------------------------
                    */

                    $sessionNumber =
                        $validated['session_number']
                        ??
                        (
                            EducationStudentLesson::query()
                                ->where(
                                    'education_booking_id',
                                    $booking->id
                                )
                                ->max('session_number')
                            + 1
                        );

                    /*
                    |----------------------------------------------------------
                    | TITLE
                    |----------------------------------------------------------
                    */

                    $title =
                        $validated['title']
                        ??
                        $assignment?->lesson?->title
                        ??
                        'جلسة تعليمية';

                    /*
                    |----------------------------------------------------------
                    | DESCRIPTION
                    |----------------------------------------------------------
                    */

                    $description =
                        $validated['description']
                        ??
                        $assignment?->lesson?->description;

                    /*
                    |----------------------------------------------------------
                    | CREATE
                    |----------------------------------------------------------
                    */

                    return EducationStudentLesson::create([

                        'education_user_id' =>
                            $validated['education_user_id'],

                        'education_lesson_assignment_id' =>
                            $validated[
                                'education_lesson_assignment_id'
                            ]
                            ?? null,

                        'education_booking_id' =>
                            $validated['education_booking_id'],

                        'source_lesson_id' =>
                            $sourceLessonId,

                        'session_number' =>
                            $sessionNumber,

                        'title' =>
                            $title,

                        'description' =>
                            $description,

                        'status' =>
                            $validated['status']
                            ?? 'assigned',

                        'assigned_at' =>
                            $validated['assigned_at']
                            ?? now(),

                        'started_at' =>
                            $validated['started_at']
                            ?? null,

                        'completed_at' =>
                            $validated['completed_at']
                            ?? null,

                        'notes' =>
                            $validated['notes']
                            ?? null,

                        'is_active' =>
                            $validated['is_active']
                            ?? true,

                    ]);
                }
            );

            /*
            |--------------------------------------------------------------------------
            | NOTIFY STUDENT
            |--------------------------------------------------------------------------
            */

            $this->notifyStudent(
                $studentLesson,
                'student_lesson_assigned',
                'تمت إضافة درس جديد لك',
                'تمت إضافة جلسة جديدة إلى دروسك التعليمية.',
                'fa-book-open',
                '#235d70'
            );

            /*
            |--------------------------------------------------------------------------
            | REDIRECT
            |--------------------------------------------------------------------------
            */

            return redirect()
                ->route(
                    'education.admin.student-lessons.show',
                    $studentLesson
                )
                ->with(
                    'success',
                    'تم إنشاء درس الطالب بنجاح وتم إرسال إشعار للطالب.'
                );

        } catch (Throwable $e) {

            Log::error(
                'Education student lesson store error.',
                [
                    'message' =>
                        $e->getMessage(),

                    'trace' =>
                        $e->getTraceAsString(),
                ]
            );

            return back()
                ->withInput()
                ->withErrors([
                    'lesson' =>
                        'حدث خطأ أثناء إنشاء درس الطالب. يرجى المحاولة مرة أخرى.',
                ]);
        }
    }


    /**
     * =========================================================
     * CREATE FROM ASSIGNMENT
     * =========================================================
     */
    public function createFromAssignment(
        EducationLessonAssignment $assignment
    ) {
        try {

            /*
            |--------------------------------------------------------------------------
            | LOAD RELATIONSHIPS
            |--------------------------------------------------------------------------
            */

            $assignment->load([
                'student',
                'lesson',
                'booking',
                'studentLesson',
            ]);

            /*
            |--------------------------------------------------------------------------
            | DUPLICATE CHECK
            |--------------------------------------------------------------------------
            */

            if ($assignment->studentLesson) {

                return redirect()
                    ->route(
                        'education.admin.student-lessons.show',
                        $assignment->studentLesson
                    )
                    ->with(
                        'info',
                        'تم إنشاء درس الطالب من هذا التكليف مسبقًا.'
                    );
            }

            /*
            |--------------------------------------------------------------------------
            | STUDENT CHECK
            |--------------------------------------------------------------------------
            */

            if (!$assignment->student) {

                return back()
                    ->withErrors([
                        'assignment' =>
                            'الطالب المرتبط بهذا التكليف غير موجود.',
                    ]);
            }

            /*
            |--------------------------------------------------------------------------
            | BOOKING CHECK
            |--------------------------------------------------------------------------
            */

            if (!$assignment->booking) {

                return back()
                    ->withErrors([
                        'assignment' =>
                            'لا يوجد حجز مرتبط بهذا التكليف.',
                    ]);
            }

            $booking = $assignment->booking;

            /*
            |--------------------------------------------------------------------------
            | PAYMENT CHECK
            |--------------------------------------------------------------------------
            */

            if (!$this->isBookingPaid($booking)) {

                return back()
                    ->withErrors([
                        'assignment' =>
                            'لا يمكن إنشاء جلسة قبل تأكيد الدفع.',
                    ]);
            }

            /*
            |--------------------------------------------------------------------------
            | BOOKING STATUS CHECK
            |--------------------------------------------------------------------------
            */

            if (!$this->isBookingConfirmed($booking)) {

                return back()
                    ->withErrors([
                        'assignment' =>
                            'لا يمكن إنشاء جلسة قبل تأكيد الحجز.',
                    ]);
            }

            /*
            |--------------------------------------------------------------------------
            | TOTAL SESSIONS
            |--------------------------------------------------------------------------
            */

            $booking->load([
                'studentLessons',
                'bookingType',
            ]);

            $totalSessions = null;

            if ($booking->bookingType) {

                $totalSessions =
                    $booking->bookingType->total_sessions
                    ?? null;
            }

            /*
            |--------------------------------------------------------------------------
            | REMAINING SESSIONS
            |--------------------------------------------------------------------------
            */

            if (
                $totalSessions !== null
                &&
                (int) $booking->studentLessons->count()
                >=
                (int) $totalSessions
            ) {

                return back()
                    ->withErrors([
                        'assignment' =>
                            'تم الوصول إلى العدد الإجمالي للجلسات المسموح بها لهذا الحجز.',
                    ]);
            }

            /*
            |--------------------------------------------------------------------------
            | CREATE STUDENT LESSON
            |--------------------------------------------------------------------------
            */

            $studentLesson = DB::transaction(
                function () use ($assignment, $booking) {

                    /*
                    |----------------------------------------------------------
                    | NEXT SESSION NUMBER
                    |----------------------------------------------------------
                    */

                    $sessionNumber =
                        EducationStudentLesson::query()
                            ->where(
                                'education_booking_id',
                                $booking->id
                            )
                            ->max('session_number')
                        + 1;

                    /*
                    |----------------------------------------------------------
                    | CREATE
                    |----------------------------------------------------------
                    */

                    return EducationStudentLesson::create([

                        'education_user_id' =>
                            $assignment->education_user_id,

                        'education_lesson_assignment_id' =>
                            $assignment->id,

                        'education_booking_id' =>
                            $booking->id,

                        'source_lesson_id' =>
                            $assignment->education_lesson_id,

                        'session_number' =>
                            $sessionNumber,

                        'title' =>
                            $assignment->lesson?->title
                            ?? 'جلسة تعليمية',

                        'description' =>
                            $assignment->lesson?->description,

                        'status' =>
                            'assigned',

                        'assigned_at' =>
                            $assignment->assigned_at
                            ?? now(),

                        'started_at' =>
                            null,

                        'completed_at' =>
                            null,

                        'notes' =>
                            $assignment->notes
                            ?? null,

                        'is_active' =>
                            true,

                    ]);
                }
            );

            /*
            |--------------------------------------------------------------------------
            | NOTIFY STUDENT
            |--------------------------------------------------------------------------
            */

            $this->notifyStudent(
                $studentLesson,
                'student_lesson_assigned',
                'تمت إضافة جلسة جديدة لك',
                'تمت إضافة جلسة جديدة إلى دروسك التعليمية.',
                'fa-book-open',
                '#235d70'
            );

            /*
            |--------------------------------------------------------------------------
            | REDIRECT
            |--------------------------------------------------------------------------
            */

            return redirect()
                ->route(
                    'education.admin.student-lessons.show',
                    $studentLesson
                )
                ->with(
                    'success',
                    'تم إنشاء درس الطالب من التكليف بنجاح وتم إرسال إشعار للطالب.'
                );

        } catch (Throwable $e) {

            Log::error(
                'Education student lesson create from assignment error.',
                [
                    'assignment_id' =>
                        $assignment->id ?? null,

                    'message' =>
                        $e->getMessage(),

                    'trace' =>
                        $e->getTraceAsString(),
                ]
            );

            return back()
                ->withErrors([
                    'assignment' =>
                        'حدث خطأ أثناء إنشاء درس الطالب من التكليف.',
                ]);
        }
    }


    /**
     * =========================================================
     * SHOW
     * =========================================================
     */
    public function show(
        EducationStudentLesson $studentLesson
    ) {

        $studentLesson->load([
            'student',
            'assignment.lesson',
            'booking',
            'sourceLesson',
            'contents',
            'evaluation',
        ]);

        return view(
            'education.admin.student-lessons.show',
            compact(
                'studentLesson'
            )
        );
    }


    /**
     * =========================================================
     * EDIT
     * =========================================================
     */
    public function edit(
        EducationStudentLesson $studentLesson
    ) {

        /*
        |--------------------------------------------------------------------------
        | LOAD RELATIONSHIPS
        |--------------------------------------------------------------------------
        */

        $studentLesson->load([
            'student',
            'assignment.lesson',
            'booking',
            'sourceLesson',
        ]);

        /*
        |--------------------------------------------------------------------------
        | STUDENTS
        |--------------------------------------------------------------------------
        */

        $students = EducationUser::query()
            ->orderBy('name')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | LESSONS
        |--------------------------------------------------------------------------
        */

        $lessons = EducationLesson::query()
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | BOOKINGS
        |--------------------------------------------------------------------------
        */

        $bookings = EducationBooking::query()
            ->with([
                'student',
                'bookingType',
            ])
            ->latest('id')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | ASSIGNMENTS
        |--------------------------------------------------------------------------
        */

        $assignments = EducationLessonAssignment::query()
            ->with([
                'student',
                'lesson',
                'booking',
            ])
            ->latest('id')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'education.admin.student-lessons.edit',
            compact(
                'studentLesson',
                'students',
                'lessons',
                'bookings',
                'assignments'
            )
        );
    }


    /**
     * =========================================================
     * UPDATE
     * =========================================================
     */
    public function update(
        Request $request,
        EducationStudentLesson $studentLesson
    ) {

        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'education_user_id' => [
                'required',
                'exists:education_users,id',
            ],

            'education_lesson_assignment_id' => [
                'nullable',
                'exists:education_lesson_assignments,id',
            ],

            'education_booking_id' => [
                'required',
                'exists:education_bookings,id',
            ],

            'source_lesson_id' => [
                'nullable',
                'exists:education_lessons,id',
            ],

            'session_number' => [
                'required',
                'integer',
                'min:1',
            ],

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'status' => [
                'required',
                'in:assigned,in_progress,completed,cancelled',
            ],

            'assigned_at' => [
                'nullable',
                'date',
            ],

            'started_at' => [
                'nullable',
                'date',
            ],

            'completed_at' => [
                'nullable',
                'date',
            ],

            'notes' => [
                'nullable',
                'string',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],

        ]);

        try {

            /*
            |--------------------------------------------------------------------------
            | BOOKING
            |--------------------------------------------------------------------------
            */

            $booking = EducationBooking::query()
                ->with([
                    'student',
                    'bookingType',
                ])
                ->findOrFail(
                    $validated['education_booking_id']
                );

            /*
            |--------------------------------------------------------------------------
            | BOOKING OWNERSHIP
            |--------------------------------------------------------------------------
            */

            if (
                (int) $booking->education_user_id
                !==
                (int) $validated['education_user_id']
            ) {

                return back()
                    ->withInput()
                    ->withErrors([
                        'education_booking_id' =>
                            'الحجز لا ينتمي إلى الطالب المحدد.',
                    ]);
            }

            /*
            |--------------------------------------------------------------------------
            | ASSIGNMENT
            |--------------------------------------------------------------------------
            */

            $assignment = null;

            if (!empty($validated['education_lesson_assignment_id'])) {

                $assignment = EducationLessonAssignment::query()
                    ->findOrFail(
                        $validated['education_lesson_assignment_id']
                    );

                if (
                    (int) $assignment->education_user_id
                    !==
                    (int) $validated['education_user_id']
                ) {

                    return back()
                        ->withInput()
                        ->withErrors([
                            'education_lesson_assignment_id' =>
                                'هذا التكليف لا ينتمي إلى الطالب المحدد.',
                        ]);
                }
            }

            /*
            |--------------------------------------------------------------------------
            | PAYMENT CHECK
            |--------------------------------------------------------------------------
            */

            if (!$this->isBookingPaid($booking)) {

                return back()
                    ->withInput()
                    ->withErrors([
                        'education_booking_id' =>
                            'لا يمكن تحديث الجلسة قبل تأكيد الدفع.',
                    ]);
            }

            /*
            |--------------------------------------------------------------------------
            | BOOKING STATUS
            |--------------------------------------------------------------------------
            */

            if (!$this->isBookingConfirmed($booking)) {

                return back()
                    ->withInput()
                    ->withErrors([
                        'education_booking_id' =>
                            'لا يمكن تحديث الجلسة قبل تأكيد الحجز.',
                    ]);
            }

            /*
            |--------------------------------------------------------------------------
            | OLD VALUES
            |--------------------------------------------------------------------------
            */

            $oldStatus = $studentLesson->status;

            /*
            |--------------------------------------------------------------------------
            | UPDATE
            |--------------------------------------------------------------------------
            */

            DB::transaction(function () use (
                $studentLesson,
                $validated
            ) {

                $studentLesson->update([

                    'education_user_id' =>
                        $validated['education_user_id'],

                    'education_lesson_assignment_id' =>
                        $validated[
                            'education_lesson_assignment_id'
                        ]
                        ?? null,

                    'education_booking_id' =>
                        $validated['education_booking_id'],

                    'source_lesson_id' =>
                        $validated['source_lesson_id']
                        ?? null,

                    'session_number' =>
                        $validated['session_number'],

                    'title' =>
                        $validated['title'],

                    'description' =>
                        $validated['description']
                        ?? null,

                    'status' =>
                        $validated['status'],

                    'assigned_at' =>
                        $validated['assigned_at']
                        ?? $studentLesson->assigned_at,

                    'started_at' =>
                        $validated['started_at']
                        ?? null,

                    'completed_at' =>
                        $validated['completed_at']
                        ?? null,

                    'notes' =>
                        $validated['notes']
                        ?? null,

                    'is_active' =>
                        $validated['is_active']
                        ?? true,

                ]);
            });

            /*
            |--------------------------------------------------------------------------
            | STATUS CHANGE NOTIFICATION
            |--------------------------------------------------------------------------
            */

            if (
                $oldStatus !== $studentLesson->status
            ) {

                $this->notifyStudentStatusChange(
                    $studentLesson,
                    $oldStatus
                );
            }

            /*
            |--------------------------------------------------------------------------
            | REDIRECT
            |--------------------------------------------------------------------------
            */

            return redirect()
                ->route(
                    'education.admin.student-lessons.show',
                    $studentLesson
                )
                ->with(
                    'success',
                    'تم تحديث درس الطالب بنجاح.'
                );

        } catch (Throwable $e) {

            Log::error(
                'Education student lesson update error.',
                [
                    'student_lesson_id' =>
                        $studentLesson->id,

                    'message' =>
                        $e->getMessage(),

                    'trace' =>
                        $e->getTraceAsString(),
                ]
            );

            return back()
                ->withInput()
                ->withErrors([
                    'lesson' =>
                        'حدث خطأ أثناء تحديث درس الطالب.',
                ]);
        }
    }


    /**
     * =========================================================
     * START
     * =========================================================
     */
    public function start(
        EducationStudentLesson $studentLesson
    ) {

        /*
        |--------------------------------------------------------------------------
        | ALREADY COMPLETED
        |--------------------------------------------------------------------------
        */

        if (
            $studentLesson->status === 'completed'
        ) {

            return redirect()
                ->route(
                    'education.admin.student-lessons.show',
                    $studentLesson
                )
                ->with(
                    'info',
                    'هذا الدرس مكتمل بالفعل.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | CANCELLED
        |--------------------------------------------------------------------------
        */

        if (
            $studentLesson->status === 'cancelled'
        ) {

            return redirect()
                ->route(
                    'education.admin.student-lessons.show',
                    $studentLesson
                )
                ->withErrors([
                    'lesson' =>
                        'لا يمكن بدء درس ملغى.',
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE
        |--------------------------------------------------------------------------
        */

        $studentLesson->update([

            'status' =>
                'in_progress',

            'started_at' =>
                $studentLesson->started_at
                ?? now(),

            'completed_at' =>
                null,

        ]);

        /*
        |--------------------------------------------------------------------------
        | NOTIFY STUDENT
        |--------------------------------------------------------------------------
        */

        $this->notifyStudent(
            $studentLesson,
            'student_lesson_started',
            'بدأت جلستك التعليمية',
            'تم بدء الجلسة رقم ' .
                $studentLesson->session_number .
                ' من دروسك التعليمية.',
            'fa-play-circle',
            '#2563eb'
        );

        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'education.admin.student-lessons.show',
                $studentLesson
            )
            ->with(
                'success',
                'تم بدء الدرس بنجاح.'
            );
    }


    /**
     * =========================================================
     * COMPLETE
     * =========================================================
     */
    public function complete(
        EducationStudentLesson $studentLesson
    ) {

        /*
        |--------------------------------------------------------------------------
        | ALREADY COMPLETED
        |--------------------------------------------------------------------------
        */

        if (
            $studentLesson->status === 'completed'
        ) {

            return redirect()
                ->route(
                    'education.admin.student-lessons.show',
                    $studentLesson
                )
                ->with(
                    'info',
                    'هذا الدرس مكتمل بالفعل.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | CANCELLED
        |--------------------------------------------------------------------------
        */

        if (
            $studentLesson->status === 'cancelled'
        ) {

            return redirect()
                ->route(
                    'education.admin.student-lessons.show',
                    $studentLesson
                )
                ->withErrors([
                    'lesson' =>
                        'لا يمكن إكمال درس ملغى.',
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE
        |--------------------------------------------------------------------------
        */

        $studentLesson->update([

            'status' =>
                'completed',

            'started_at' =>
                $studentLesson->started_at
                ?? now(),

            'completed_at' =>
                now(),

        ]);

        /*
        |--------------------------------------------------------------------------
        | NOTIFY STUDENT
        |--------------------------------------------------------------------------
        */

        $this->notifyStudent(
            $studentLesson,
            'student_lesson_completed',
            'تم إكمال جلستك التعليمية',
            'تم إكمال الجلسة رقم ' .
                $studentLesson->session_number .
                ' بنجاح.',
            'fa-circle-check',
            '#15803d'
        );

        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'education.admin.student-lessons.show',
                $studentLesson
            )
            ->with(
                'success',
                'تم إكمال الدرس بنجاح.'
            );
    }


    /**
     * =========================================================
     * CANCEL
     * =========================================================
     */
    public function cancel(
        EducationStudentLesson $studentLesson
    ) {

        /*
        |--------------------------------------------------------------------------
        | COMPLETED
        |--------------------------------------------------------------------------
        */

        if (
            $studentLesson->status === 'completed'
        ) {

            return redirect()
                ->route(
                    'education.admin.student-lessons.show',
                    $studentLesson
                )
                ->withErrors([
                    'lesson' =>
                        'لا يمكن إلغاء درس مكتمل.',
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | ALREADY CANCELLED
        |--------------------------------------------------------------------------
        */

        if (
            $studentLesson->status === 'cancelled'
        ) {

            return redirect()
                ->route(
                    'education.admin.student-lessons.show',
                    $studentLesson
                )
                ->with(
                    'info',
                    'هذا الدرس ملغى بالفعل.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE
        |--------------------------------------------------------------------------
        */

        $studentLesson->update([

            'status' =>
                'cancelled',

            'completed_at' =>
                null,

        ]);

        /*
        |--------------------------------------------------------------------------
        | NOTIFY STUDENT
        |--------------------------------------------------------------------------
        */

        $this->notifyStudent(
            $studentLesson,
            'student_lesson_cancelled',
            'تم إلغاء جلسة تعليمية',
            'تم إلغاء الجلسة رقم ' .
                $studentLesson->session_number .
                ' من دروسك التعليمية.',
            'fa-calendar-xmark',
            '#b45309'
        );

        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'education.admin.student-lessons.show',
                $studentLesson
            )
            ->with(
                'success',
                'تم إلغاء الدرس بنجاح وتم إرسال إشعار للطالب.'
            );
    }


    /**
     * =========================================================
     * DESTROY
     * =========================================================
     */
    public function destroy(
        EducationStudentLesson $studentLesson
    ) {

        try {

            DB::transaction(function () use ($studentLesson) {

                /*
                |--------------------------------------------------------------------------
                | DELETE CONTENTS
                |--------------------------------------------------------------------------
                */

                $studentLesson
                    ->contents()
                    ->delete();

                /*
                |--------------------------------------------------------------------------
                | DELETE EVALUATION
                |--------------------------------------------------------------------------
                */

                $studentLesson
                    ->evaluation()
                    ->delete();

                /*
                |--------------------------------------------------------------------------
                | DELETE STUDENT LESSON
                |--------------------------------------------------------------------------
                */

                $studentLesson->delete();
            });

            return redirect()
                ->route(
                    'education.admin.student-lessons.index'
                )
                ->with(
                    'success',
                    'تم حذف درس الطالب بنجاح.'
                );

        } catch (Throwable $e) {

            Log::error(
                'Education student lesson delete error.',
                [
                    'student_lesson_id' =>
                        $studentLesson->id,

                    'message' =>
                        $e->getMessage(),

                    'trace' =>
                        $e->getTraceAsString(),
                ]
            );

            return back()
                ->withErrors([
                    'lesson' =>
                        'حدث خطأ أثناء حذف درس الطالب.',
                ]);
        }
    }


    /**
     * =========================================================
     * NOTIFY STUDENT
     * =========================================================
     *
     * إنشاء إشعار للطالب باستخدام نظام الإشعارات الحالي.
     */
    private function notifyStudent(
        EducationStudentLesson $studentLesson,
        string $type,
        string $title,
        string $message,
        string $icon = 'fa-book-open',
        string $color = '#235d70'
    ): void {

        try {

            EducationUserNotification::create([

                'education_user_id' =>
                    $studentLesson->education_user_id,

                'type' =>
                    $type,

                'title' =>
                    $title,

                'message' =>
                    $message,

                'icon' =>
                    $icon,

                'color' =>
                    $color,

                'url' =>
                    route(
                        'education.student.lessons.show',
                        $studentLesson
                    ),

                'read_at' =>
                    null,

                'data' => [

                    'student_lesson_id' =>
                        $studentLesson->id,

                    'booking_id' =>
                        $studentLesson->education_booking_id,

                    'assignment_id' =>
                        $studentLesson->education_lesson_assignment_id,

                    'session_number' =>
                        $studentLesson->session_number,

                ],

            ]);

        } catch (Throwable $e) {

            /*
            |--------------------------------------------------------------------------
            | IMPORTANT
            |--------------------------------------------------------------------------
            |
            | فشل إنشاء الإشعار لا يجب أن يؤدي إلى فشل عملية
            | إنشاء/تحديث درس الطالب نفسه.
            |
            */

            Log::error(
                'Education student notification creation error.',
                [
                    'student_lesson_id' =>
                        $studentLesson->id,

                    'student_id' =>
                        $studentLesson->education_user_id,

                    'type' =>
                        $type,

                    'message' =>
                        $e->getMessage(),
                ]
            );
        }
    }


    /**
     * =========================================================
     * NOTIFY STUDENT STATUS CHANGE
     * =========================================================
     */
    private function notifyStudentStatusChange(
        EducationStudentLesson $studentLesson,
        ?string $oldStatus
    ): void {

        /*
        |--------------------------------------------------------------------------
        | NEW STATUS
        |--------------------------------------------------------------------------
        */

        $newStatus =
            $studentLesson->status;

        /*
        |--------------------------------------------------------------------------
        | ASSIGNED
        |--------------------------------------------------------------------------
        */

        if (
            $newStatus === 'assigned'
            &&
            $oldStatus !== 'assigned'
        ) {

            $this->notifyStudent(
                $studentLesson,
                'student_lesson_assigned',
                'تمت إضافة جلسة جديدة لك',
                'تمت إضافة جلسة جديدة إلى دروسك التعليمية.',
                'fa-book-open',
                '#235d70'
            );

            return;
        }

        /*
        |--------------------------------------------------------------------------
        | IN PROGRESS
        |--------------------------------------------------------------------------
        */

        if (
            $newStatus === 'in_progress'
            &&
            $oldStatus !== 'in_progress'
        ) {

            $this->notifyStudent(
                $studentLesson,
                'student_lesson_started',
                'بدأت جلستك التعليمية',
                'تم بدء الجلسة رقم ' .
                    $studentLesson->session_number .
                    ' من دروسك التعليمية.',
                'fa-play-circle',
                '#2563eb'
            );

            return;
        }

        /*
        |--------------------------------------------------------------------------
        | COMPLETED
        |--------------------------------------------------------------------------
        */

        if (
            $newStatus === 'completed'
            &&
            $oldStatus !== 'completed'
        ) {

            $this->notifyStudent(
                $studentLesson,
                'student_lesson_completed',
                'تم إكمال جلستك التعليمية',
                'تم إكمال الجلسة رقم ' .
                    $studentLesson->session_number .
                    ' بنجاح.',
                'fa-circle-check',
                '#15803d'
            );

            return;
        }

        /*
        |--------------------------------------------------------------------------
        | CANCELLED
        |--------------------------------------------------------------------------
        */

        if (
            $newStatus === 'cancelled'
            &&
            $oldStatus !== 'cancelled'
        ) {

            $this->notifyStudent(
                $studentLesson,
                'student_lesson_cancelled',
                'تم إلغاء جلسة تعليمية',
                'تم إلغاء الجلسة رقم ' .
                    $studentLesson->session_number .
                    ' من دروسك التعليمية.',
                'fa-calendar-xmark',
                '#b45309'
            );
        }
    }


    /**
     * =========================================================
     * CHECK BOOKING PAYMENT
     * =========================================================
     */
    private function isBookingPaid(
        EducationBooking $booking
    ): bool {

        $paymentStatus =
            strtolower(
                (string) (
                    $booking->payment_status
                    ?? ''
                )
            );

        return in_array(
            $paymentStatus,
            [
                'paid',
                'completed',
                'approved',
                'success',
                'successful',
            ],
            true
        );
    }


    /**
     * =========================================================
     * CHECK BOOKING STATUS
     * =========================================================
     */
    private function isBookingConfirmed(
        EducationBooking $booking
    ): bool {

        $status =
            strtolower(
                (string) (
                    $booking->status
                    ?? ''
                )
            );

        return in_array(
            $status,
            [
                'confirmed',
                'approved',
                'active',
            ],
            true
        );
    }
}
