<?php

namespace App\Http\Controllers\Education;

use App\Http\Controllers\Controller;
use App\Models\EducationStudentLesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EducationStudentLessonFrontController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    | عرض الدروس الخاصة بالطالب
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
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
        | BASE QUERY
        |--------------------------------------------------------------------------
        */

        $query = EducationStudentLesson::query()
            ->where(
                'education_user_id',
                $student->id
            )
            ->where(
                'is_active',
                true
            )
            ->with([
                'sourceLesson',
                'assignment.lesson',
                'booking',
                'evaluation',
                'quizzes.questions',
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
                ->orWhere(
                    'description',
                    'like',
                    "%{$search}%"
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

        $query
            ->orderBy(
                'session_number',
                'asc'
            )
            ->orderBy(
                'assigned_at',
                'desc'
            )
            ->orderBy(
                'id',
                'desc'
            );

        /*
        |--------------------------------------------------------------------------
        | LESSONS
        |--------------------------------------------------------------------------
        */

        $lessons = $query->get();

        /*
        |--------------------------------------------------------------------------
        | STATISTICS
        |--------------------------------------------------------------------------
        */

        $studentLessonsQuery = EducationStudentLesson::query()
            ->where(
                'education_user_id',
                $student->id
            )
            ->where(
                'is_active',
                true
            );

        $totalLessons = (clone $studentLessonsQuery)
            ->count();

        $completedLessonsCount = (clone $studentLessonsQuery)
            ->where(
                'status',
                'completed'
            )
            ->count();

        $inProgressLessonsCount = (clone $studentLessonsQuery)
            ->where(
                'status',
                'in_progress'
            )
            ->count();

        /*
        |--------------------------------------------------------------------------
        | QUIZZES COUNT
        |--------------------------------------------------------------------------
        */

        $quizzesCount = $lessons
            ->sum(function ($studentLesson) {
                return $studentLesson
                    ->quizzes
                    ?->count() ?? 0;
            });

        /*
        |--------------------------------------------------------------------------
        | STATISTICS ARRAY
        |--------------------------------------------------------------------------
        */

        $statistics = [
            'total' =>
                $totalLessons,

            'completed' =>
                $completedLessonsCount,

            'in_progress' =>
                $inProgressLessonsCount,
        ];

        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'education.student.lessons.index',
            compact(
                'student',
                'lessons',
                'statistics',
                'completedLessonsCount',
                'inProgressLessonsCount',
                'quizzesCount'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    | عرض درس الطالب
    |--------------------------------------------------------------------------
    */

    public function show(
        EducationStudentLesson $studentLesson
    ) {
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
        | SECURITY
        |--------------------------------------------------------------------------
        */

        if (
            (int) $studentLesson->education_user_id
            !==
            (int) $student->id
        ) {
            abort(
                403,
                'غير مصرح لك بالوصول إلى هذا الدرس.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | ACTIVE CHECK
        |--------------------------------------------------------------------------
        */

        if (!$studentLesson->is_active) {
            abort(
                404,
                'هذا الدرس غير متاح حاليًا.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | LOAD RELATIONSHIPS
        |--------------------------------------------------------------------------
        */

        $studentLesson->load([
            'contents',
            'sourceLesson',
            'booking',
            'assignment.lesson',
            'evaluation',
            'quizzes.questions.options',
        ]);

        /*
        |--------------------------------------------------------------------------
        | SOURCE LESSON
        |--------------------------------------------------------------------------
        */

        $sourceLesson = $studentLesson->sourceLesson;

        /*
        |--------------------------------------------------------------------------
        | CONTENTS
        |--------------------------------------------------------------------------
        */

        $contents = $studentLesson->contents
            ?? collect();

        /*
        |--------------------------------------------------------------------------
        | QUIZZES
        |--------------------------------------------------------------------------
        */

        $activeQuizzes = $studentLesson
            ->quizzes
            ->filter(function ($quiz) {
                return (bool) $quiz->is_active;
            })
            ->values();

        /*
        |--------------------------------------------------------------------------
        | QUIZ STATISTICS
        |--------------------------------------------------------------------------
        */

        $quizStatistics = [
            'total' =>
                $activeQuizzes->count(),

            'questions' =>
                $activeQuizzes->sum(function ($quiz) {
                    return $quiz->questions
                        ?->count() ?? 0;
                }),
        ];

        /*
        |--------------------------------------------------------------------------
        | LESSON
        |--------------------------------------------------------------------------
        */

        $lesson = $studentLesson;

        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'education.student.lessons.show',
            compact(
                'student',
                'lesson',
                'studentLesson',
                'sourceLesson',
                'contents',
                'activeQuizzes',
                'quizStatistics'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | START
    |--------------------------------------------------------------------------
    | الطالب يبدأ الجلسة
    |--------------------------------------------------------------------------
    */

    public function start(
        EducationStudentLesson $studentLesson
    ) {
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
        | SECURITY
        |--------------------------------------------------------------------------
        */

        if (
            (int) $studentLesson->education_user_id
            !==
            (int) $student->id
        ) {
            abort(
                403,
                'غير مصرح لك بالوصول إلى هذا الدرس.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | ACTIVE CHECK
        |--------------------------------------------------------------------------
        */

        if (!$studentLesson->is_active) {
            abort(
                404,
                'هذا الدرس غير متاح حاليًا.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | STATUS CHECK
        |--------------------------------------------------------------------------
        */

        if ($studentLesson->status === 'completed') {
            return redirect()
                ->route(
                    'education.student.lessons.show',
                    $studentLesson
                )
                ->with(
                    'info',
                    'هذا الدرس مكتمل بالفعل.'
                );
        }

        if ($studentLesson->status === 'cancelled') {
            return redirect()
                ->route(
                    'education.student.lessons.show',
                    $studentLesson
                )
                ->withErrors([
                    'lesson' =>
                        'لا يمكن بدء جلسة ملغاة.',
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | START LESSON
        |--------------------------------------------------------------------------
        */

        $studentLesson->update([
            'status' => 'in_progress',

            'started_at' =>
                $studentLesson->started_at
                ?? now(),

            'completed_at' => null,
        ]);

        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'education.student.lessons.show',
                $studentLesson
            )
            ->with(
                'success',
                'تم بدء الجلسة بنجاح.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | COMPLETE
    |--------------------------------------------------------------------------
    | الطالب يكمل الجلسة
    |--------------------------------------------------------------------------
    */

    public function complete(
        EducationStudentLesson $studentLesson
    ) {
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
        | SECURITY
        |--------------------------------------------------------------------------
        */

        if (
            (int) $studentLesson->education_user_id
            !==
            (int) $student->id
        ) {
            abort(
                403,
                'غير مصرح لك بالوصول إلى هذا الدرس.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | ACTIVE CHECK
        |--------------------------------------------------------------------------
        */

        if (!$studentLesson->is_active) {
            abort(
                404,
                'هذا الدرس غير متاح حاليًا.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | STATUS CHECK
        |--------------------------------------------------------------------------
        */

        if ($studentLesson->status === 'completed') {
            return redirect()
                ->route(
                    'education.student.lessons.show',
                    $studentLesson
                )
                ->with(
                    'info',
                    'هذا الدرس مكتمل بالفعل.'
                );
        }

        if ($studentLesson->status === 'cancelled') {
            return redirect()
                ->route(
                    'education.student.lessons.show',
                    $studentLesson
                )
                ->withErrors([
                    'lesson' =>
                        'لا يمكن إكمال جلسة ملغاة.',
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | COMPLETE LESSON
        |--------------------------------------------------------------------------
        */

        $studentLesson->update([
            'status' => 'completed',

            'started_at' =>
                $studentLesson->started_at
                ?? now(),

            'completed_at' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------

        */

        return redirect()
            ->route(
                'education.student.lessons.show',
                $studentLesson
            )
            ->with(
                'success',
                'تم إكمال الجلسة بنجاح.'
            );
    }
}
