<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EducationLesson;
use App\Models\EducationQuiz;
use App\Models\EducationStudentLesson;
use Illuminate\Http\Request;

class EducationQuizController extends Controller
{
    /**
     * Display a listing of quizzes.
     */
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | QUIZZES QUERY
        |--------------------------------------------------------------------------
        */

        $query = EducationQuiz::query()
            ->with([
                'lesson',
                'studentLesson.student',
            ])
            ->withCount('questions');


        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = $request
                ->string('search')
                ->toString();

            $query->where(function ($q) use ($search) {

                /*
                | Quiz information
                */

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


                /*
                | General lesson
                */

                $q->orWhereHas(
                    'lesson',
                    function ($lessonQuery) use ($search) {

                        $lessonQuery->where(
                            'title',
                            'like',
                            "%{$search}%"
                        );

                    }
                );


                /*
                | Student lesson
                */

                $q->orWhereHas(
                    'studentLesson',
                    function ($studentLessonQuery) use ($search) {

                        $studentLessonQuery->where(
                            'title',
                            'like',
                            "%{$search}%"
                        );


                        /*
                        | Student name
                        */

                        $studentLessonQuery->orWhereHas(
                            'student',
                            function ($studentQuery) use ($search) {

                                $studentQuery->where(
                                    'name',
                                    'like',
                                    "%{$search}%"
                                );

                            }
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

            if ($request->status === 'active') {

                $query->where(
                    'is_active',
                    true
                );

            }

            if ($request->status === 'inactive') {

                $query->where(
                    'is_active',
                    false
                );

            }
        }


        /*
        |--------------------------------------------------------------------------
        | LESSON TYPE FILTER
        |--------------------------------------------------------------------------
        */

        if ($request->filled('lesson_type')) {

            if ($request->lesson_type === 'general') {

                $query->whereNotNull(
                    'education_lesson_id'
                );

            }

            if ($request->lesson_type === 'student') {

                $query->whereNotNull(
                    'education_student_lesson_id'
                );

            }
        }


        /*
        |--------------------------------------------------------------------------
        | GENERAL LESSON FILTER
        |--------------------------------------------------------------------------
        */

        if (
            $request->filled('lesson')
            &&
            $request->lesson_type === 'general'
        ) {

            $query->where(
                'education_lesson_id',
                $request->lesson
            );
        }


        /*
        |--------------------------------------------------------------------------
        | STUDENT LESSON FILTER
        |--------------------------------------------------------------------------
        */

        if (
            $request->filled('student_lesson')
            &&
            $request->lesson_type === 'student'
        ) {

            $query->where(
                'education_student_lesson_id',
                $request->student_lesson
            );
        }


        /*
        |--------------------------------------------------------------------------
        | ORDER
        |--------------------------------------------------------------------------
        */

        $quizzes = $query
            ->orderBy('sort_order')
            ->latest()
            ->paginate(15)
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | ACTIVE GENERAL LESSONS
        |--------------------------------------------------------------------------
        */

        $lessons = EducationLesson::query()
            ->where(
                'is_active',
                true
            )
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | ACTIVE STUDENT LESSONS
        |--------------------------------------------------------------------------
        |
        | نعرض فقط دروس الطلاب النشطة.
        |
        | student
        | يتم تحميله حتى نعرض اسم الطالب في القائمة.
        |
        */

        $studentLessons = EducationStudentLesson::query()
            ->with('student')
            ->where(
                'is_active',
                true
            )
            ->orderByDesc('assigned_at')
            ->orderBy('session_number')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | ACTIVE QUIZZES COUNT
        |--------------------------------------------------------------------------
        */

        $activeQuizzesCount = EducationQuiz::query()
            ->where(
                'is_active',
                true
            )
            ->count();


        /*
        |--------------------------------------------------------------------------
        | TOTAL QUESTIONS
        |--------------------------------------------------------------------------
        */

        $questionsCount = $quizzes->sum(
            'questions_count'
        );


        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'education.admin.quizzes.index',
            compact(
                'quizzes',
                'lessons',
                'studentLessons',
                'activeQuizzesCount',
                'questionsCount'
            )
        );
    }


    /**
     * Show the form for creating a new quiz.
     */
    public function create()
    {
        /*
        |--------------------------------------------------------------------------
        | GENERAL LESSONS
        |--------------------------------------------------------------------------
        */

        $lessons = EducationLesson::query()
            ->where(
                'is_active',
                true
            )
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | STUDENT LESSONS
        |--------------------------------------------------------------------------
        */

        $studentLessons = EducationStudentLesson::query()
            ->with('student')
            ->where(
                'is_active',
                true
            )
            ->orderByDesc('assigned_at')
            ->orderBy('session_number')
            ->get();


        return view(
            'education.admin.quizzes.create',
            compact(
                'lessons',
                'studentLessons'
            )
        );
    }


    /**
     * Store a newly created quiz.
     */
    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            /*
            | Lesson type
            */

            'lesson_type' => [
                'required',
                'in:general,student',
            ],


            /*
            | General lesson
            */

            'education_lesson_id' => [
                'nullable',
                'integer',
                'exists:education_lessons,id',
            ],


            /*
            | Student lesson
            */

            'education_student_lesson_id' => [
                'nullable',
                'integer',
                'exists:education_student_lessons,id',
            ],


            /*
            | Quiz information
            */

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],


            /*
            | Settings
            */

            'pass_percentage' => [
                'required',
                'integer',
                'min:1',
                'max:100',
            ],

            'max_attempts' => [
                'nullable',
                'integer',
                'min:1',
            ],

            'time_limit' => [
                'nullable',
                'integer',
                'min:1',
            ],


            /*
            | Status
            */

            'is_active' => [
                'nullable',
                'boolean',
            ],


            /*
            | Sorting
            */

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | LESSON TYPE VALIDATION
        |--------------------------------------------------------------------------
        |
        | لا نسمح بربط الاختبار بالنوعين في نفس الوقت.
        |
        */

        if (
            $validated['lesson_type'] === 'general'
            &&
            empty($validated['education_lesson_id'])
        ) {

            return back()
                ->withInput()
                ->withErrors([

                    'education_lesson_id' =>
                        'يرجى اختيار الدرس العام المرتبط بالاختبار.',

                ]);
        }


        if (
            $validated['lesson_type'] === 'student'
            &&
            empty($validated['education_student_lesson_id'])
        ) {

            return back()
                ->withInput()
                ->withErrors([

                    'education_student_lesson_id' =>
                        'يرجى اختيار درس الطالب المرتبط بالاختبار.',

                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | GENERAL QUIZ
        |--------------------------------------------------------------------------
        */

        if (
            $validated['lesson_type'] === 'general'
        ) {

            $educationLessonId =
                $validated['education_lesson_id'];

            $educationStudentLessonId =
                null;
        }


        /*
        |--------------------------------------------------------------------------
        | STUDENT QUIZ
        |--------------------------------------------------------------------------
        */

        else {

            $educationLessonId =
                null;

            $educationStudentLessonId =
                $validated['education_student_lesson_id'];
        }


        /*
        |--------------------------------------------------------------------------
        | CREATE QUIZ
        |--------------------------------------------------------------------------
        */

        $quiz = EducationQuiz::create([

            'education_lesson_id' =>
                $educationLessonId,

            'education_student_lesson_id' =>
                $educationStudentLessonId,

            'title' =>
                $validated['title'],

            'description' =>
                $validated['description']
                ?? null,

            'pass_percentage' =>
                $validated['pass_percentage'],

            'max_attempts' =>
                $validated['max_attempts']
                ?? null,

            'time_limit' =>
                $validated['time_limit']
                ?? null,

            'is_active' =>
                $request->boolean(
                    'is_active',
                    true
                ),

            'sort_order' =>
                $validated['sort_order']
                ?? 0,

        ]);


        /*
        |--------------------------------------------------------------------------
        | SUCCESS
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'education.admin.quizzes.show',
                $quiz
            )
            ->with(
                'success',
                'تم إنشاء الاختبار بنجاح.'
            );
    }


    /**
     * Display the specified quiz.
     */
    public function show(
        EducationQuiz $quiz
    ) {

        /*
        |--------------------------------------------------------------------------
        | LOAD QUIZ DATA
        |--------------------------------------------------------------------------
        */

        $quiz->load([

            'lesson',

            'studentLesson.student',

            'questions.options',

        ]);


        return view(
            'education.admin.quizzes.show',
            compact(
                'quiz'
            )
        );
    }


    /**
     * Show the form for editing the specified quiz.
     */
    public function edit(
        EducationQuiz $quiz
    ) {

        /*
        |--------------------------------------------------------------------------
        | GENERAL LESSONS
        |--------------------------------------------------------------------------
        */

        $lessons = EducationLesson::query()
            ->where(
                'is_active',
                true
            )
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | STUDENT LESSONS
        |--------------------------------------------------------------------------
        |
        | نحتاج أن نحضر الدرس الحالي حتى لو أصبح غير نشط،
        | حتى لا يختفي من شاشة التعديل.
        |
        */

        $studentLessons = EducationStudentLesson::query()
            ->with('student')
            ->where(function ($query) use ($quiz) {

                $query
                    ->where(
                        'is_active',
                        true
                    )
                    ->orWhere(
                        'id',
                        $quiz->education_student_lesson_id
                    );

            })
            ->orderByDesc('assigned_at')
            ->orderBy('session_number')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | LOAD CURRENT RELATIONS
        |--------------------------------------------------------------------------
        */

        $quiz->load([
            'lesson',
            'studentLesson.student',
        ]);


        return view(
            'education.admin.quizzes.edit',
            compact(
                'quiz',
                'lessons',
                'studentLessons'
            )
        );
    }


    /**
     * Update the specified quiz.
     */
    public function update(
        Request $request,
        EducationQuiz $quiz
    ) {

        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'lesson_type' => [
                'required',
                'in:general,student',
            ],

            'education_lesson_id' => [
                'nullable',
                'integer',
                'exists:education_lessons,id',
            ],

            'education_student_lesson_id' => [
                'nullable',
                'integer',
                'exists:education_student_lessons,id',
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

            'pass_percentage' => [
                'required',
                'integer',
                'min:1',
                'max:100',
            ],

            'max_attempts' => [
                'nullable',
                'integer',
                'min:1',
            ],

            'time_limit' => [
                'nullable',
                'integer',
                'min:1',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | LESSON TYPE VALIDATION
        |--------------------------------------------------------------------------
        */

        if (
            $validated['lesson_type'] === 'general'
            &&
            empty($validated['education_lesson_id'])
        ) {

            return back()
                ->withInput()
                ->withErrors([

                    'education_lesson_id' =>
                        'يرجى اختيار الدرس العام المرتبط بالاختبار.',

                ]);
        }


        if (
            $validated['lesson_type'] === 'student'
            &&
            empty($validated['education_student_lesson_id'])
        ) {

            return back()
                ->withInput()
                ->withErrors([

                    'education_student_lesson_id' =>
                        'يرجى اختيار درس الطالب المرتبط بالاختبار.',

                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | DETERMINE LESSON
        |--------------------------------------------------------------------------
        */

        if (
            $validated['lesson_type'] === 'general'
        ) {

            $educationLessonId =
                $validated['education_lesson_id'];

            $educationStudentLessonId =
                null;

        } else {

            $educationLessonId =
                null;

            $educationStudentLessonId =
                $validated['education_student_lesson_id'];
        }


        /*
        |--------------------------------------------------------------------------
        | UPDATE
        |--------------------------------------------------------------------------
        */

        $quiz->update([

            'education_lesson_id' =>
                $educationLessonId,

            'education_student_lesson_id' =>
                $educationStudentLessonId,

            'title' =>
                $validated['title'],

            'description' =>
                $validated['description']
                ?? null,

            'pass_percentage' =>
                $validated['pass_percentage'],

            'max_attempts' =>
                $validated['max_attempts']
                ?? null,

            'time_limit' =>
                $validated['time_limit']
                ?? null,

            'is_active' =>
                $request->boolean(
                    'is_active',
                    true
                ),

            'sort_order' =>
                $validated['sort_order']
                ?? 0,

        ]);


        /*
        |--------------------------------------------------------------------------
        | SUCCESS
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'education.admin.quizzes.show',
                $quiz
            )
            ->with(
                'success',
                'تم تحديث الاختبار بنجاح.'
            );
    }


    /**
     * Remove the specified quiz.
     */
    public function destroy(
        EducationQuiz $quiz
    ) {

        $quiz->delete();


        return redirect()
            ->route(
                'education.admin.quizzes.index'
            )
            ->with(
                'success',
                'تم حذف الاختبار بنجاح.'
            );
    }
}
