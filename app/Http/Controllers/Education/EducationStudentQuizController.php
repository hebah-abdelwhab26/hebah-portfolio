<?php

namespace App\Http\Controllers\Education;

use App\Http\Controllers\Controller;
use App\Models\EducationQuiz;
use App\Models\EducationQuizAnswer;
use App\Models\EducationQuizAttempt;
use App\Models\EducationStudentLesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EducationStudentQuizController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | FIND STUDENT LESSON
    |--------------------------------------------------------------------------
    | تحديد درس الطالب المرتبط بالاختبار
    |--------------------------------------------------------------------------
    */

    private function findStudentLesson(EducationQuiz $quiz, $student)
    {
        /*
        |--------------------------------------------------------------------------
        | OPTION 1
        |--------------------------------------------------------------------------
        | إذا كان الاختبار يحتوي على education_student_lesson_id
        */

        if (!empty($quiz->education_student_lesson_id)) {

            $studentLesson = EducationStudentLesson::query()
                ->where(
                    'id',
                    $quiz->education_student_lesson_id
                )
                ->where(
                    'education_user_id',
                    $student->id
                )
                ->where(
                    'is_active',
                    true
                )
                ->first();

            if ($studentLesson) {
                return $studentLesson;
            }
        }


        /*
        |--------------------------------------------------------------------------
        | OPTION 2
        |--------------------------------------------------------------------------
        | استخدام العلاقة studentLesson إذا كانت معرفة في Model
        */

        try {

            $studentLesson = $quiz->studentLesson;

            if (
                $studentLesson &&
                (int) $studentLesson->education_user_id ===
                    (int) $student->id &&
                $studentLesson->is_active
            ) {
                return $studentLesson;
            }

        } catch (\Throwable $e) {

            /*
            |--------------------------------------------------------------------------
            | لا نفعل شيئًا
            |--------------------------------------------------------------------------
            | إذا لم تكن العلاقة موجودة أو حدث خطأ،
            | ننتقل للطريقة التالية.
            |--------------------------------------------------------------------------
            */
        }


        /*
        |--------------------------------------------------------------------------
        | OPTION 3
        |--------------------------------------------------------------------------
        | البحث باستخدام education_lesson_id
        |
        | EducationQuiz
        |      ↓
        | education_lesson_id
        |      ↓
        | EducationStudentLesson.source_lesson_id
        |--------------------------------------------------------------------------
        */

        $sourceLessonId = null;


        /*
        |--------------------------------------------------------------------------
        | education_lesson_id
        |--------------------------------------------------------------------------
        */

        if (!empty($quiz->education_lesson_id)) {

            $sourceLessonId =
                $quiz->education_lesson_id;
        }


        /*
        |--------------------------------------------------------------------------
        | lesson_id
        |--------------------------------------------------------------------------
        */

        if (
            !$sourceLessonId &&
            !empty($quiz->lesson_id)
        ) {

            $sourceLessonId =
                $quiz->lesson_id;
        }


        /*
        |--------------------------------------------------------------------------
        | lesson relationship
        |--------------------------------------------------------------------------
        */

        if (!$sourceLessonId) {

            try {

                if ($quiz->lesson) {

                    $sourceLessonId =
                        $quiz->lesson->id;
                }

            } catch (\Throwable $e) {

                // لا شيء
            }
        }


        /*
        |--------------------------------------------------------------------------
        | FIND STUDENT LESSON
        |--------------------------------------------------------------------------
        */

        if ($sourceLessonId) {

            return EducationStudentLesson::query()
                ->where(
                    'education_user_id',
                    $student->id
                )
                ->where(
                    'source_lesson_id',
                    $sourceLessonId
                )
                ->where(
                    'is_active',
                    true
                )
                ->latest('id')
                ->first();
        }


        /*
        |--------------------------------------------------------------------------
        | NOTHING FOUND
        |--------------------------------------------------------------------------
        */

        return null;
    }


    /*
|--------------------------------------------------------------------------
| INDEX
|--------------------------------------------------------------------------
| قائمة الاختبارات المتاحة للطالب
|--------------------------------------------------------------------------
*/

public function index()
{
    $student = auth('education')->user();

    /*
    |--------------------------------------------------------------------------
    | SECURITY
    |--------------------------------------------------------------------------
    */

    abort_unless(
        $student,
        403
    );


    /*
    |--------------------------------------------------------------------------
    | STUDENT LESSONS
    |--------------------------------------------------------------------------
    | جلب الدروس الخاصة بالطالب فقط
    |--------------------------------------------------------------------------
    */

    $studentLessons = EducationStudentLesson::query()
        ->where(
            'education_user_id',
            $student->id
        )
        ->where(
            'is_active',
            true
        )
        ->get();


    /*
    |--------------------------------------------------------------------------
    | QUIZZES
    |--------------------------------------------------------------------------
    */

    $quizzes = EducationQuiz::query()
        ->where(
            'is_active',
            true
        )
        ->withCount('questions')
        ->orderBy(
            'sort_order'
        )
        ->orderByDesc(
            'id'
        )
        ->get();


    /*
    |--------------------------------------------------------------------------
    | FILTER
    |--------------------------------------------------------------------------
    | لا نعرض للطالب إلا الاختبارات المرتبطة
    | بأحد دروسه.
    |--------------------------------------------------------------------------
    */

    $quizzes = $quizzes
        ->filter(function ($quiz) use ($student, $studentLessons) {

            /*
            |------------------------------------------------------------------
            | DIRECT STUDENT LESSON
            |------------------------------------------------------------------
            */

            if (
                !empty(
                    $quiz->education_student_lesson_id
                )
            ) {

                return $studentLessons->contains(
                    'id',
                    $quiz->education_student_lesson_id
                );
            }


            /*
            |------------------------------------------------------------------
            | SOURCE LESSON
            |------------------------------------------------------------------
            */

            $sourceLessonId = null;


            if (
                !empty(
                    $quiz->education_lesson_id
                )
            ) {

                $sourceLessonId =
                    $quiz->education_lesson_id;
            }


            if (
                !$sourceLessonId &&
                !empty(
                    $quiz->lesson_id
                )
            ) {

                $sourceLessonId =
                    $quiz->lesson_id;
            }


            /*
            |------------------------------------------------------------------
            | MATCH STUDENT LESSON
            |------------------------------------------------------------------
            */

            if ($sourceLessonId) {

                return $studentLessons->contains(
                    function ($studentLesson) use (
                        $sourceLessonId
                    ) {

                        return (int)
                            $studentLesson->source_lesson_id
                            ===
                            (int)
                            $sourceLessonId;
                    }
                );
            }


            return false;
        })
        ->values();


    /*
    |--------------------------------------------------------------------------
    | ATTEMPTS
    |--------------------------------------------------------------------------
    | جلب محاولات الطالب حتى نعرض حالته لكل اختبار.
    |--------------------------------------------------------------------------
    */

    $attempts = EducationQuizAttempt::query()
        ->where(
            'education_user_id',
            $student->id
        )
        ->whereIn(
            'education_quiz_id',
            $quizzes->pluck('id')
        )
        ->orderByDesc(
            'id'
        )
        ->get()
        ->groupBy(
            'education_quiz_id'
        );


    /*
    |--------------------------------------------------------------------------
    | VIEW
    |--------------------------------------------------------------------------
    */

    return view(
        'education.student.quizzes.index',
        compact(
            'quizzes',
            'attempts'
        )
    );
}

    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    | عرض الاختبار وبدء محاولة جديدة
    |--------------------------------------------------------------------------
    */

    public function show(EducationQuiz $quiz)
    {
        $student = auth('education')->user();


        /*
        |--------------------------------------------------------------------------
        | SECURITY
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $student,
            403
        );


        abort_unless(
            $quiz->is_active,
            404
        );


        /*
        |--------------------------------------------------------------------------
        | LOAD QUIZ
        |--------------------------------------------------------------------------
        */

        $quiz->load([
            'questions' => function ($query) {

                $query
                    ->where(
                        'is_active',
                        true
                    )
                    ->orderBy(
                        'sort_order'
                    )
                    ->orderBy(
                        'id'
                    );
            },

            'questions.options' => function ($query) {

                $query
                    ->where(
                        'is_active',
                        true
                    )
                    ->orderBy(
                        'sort_order'
                    )
                    ->orderBy(
                        'id'
                    );
            },
        ]);


        /*
        |--------------------------------------------------------------------------
        | STUDENT LESSON
        |--------------------------------------------------------------------------
        */

        $studentLesson =
            $this->findStudentLesson(
                $quiz,
                $student
            );


        /*
        |--------------------------------------------------------------------------
        | VERIFY STUDENT LESSON
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $studentLesson,
            404
        );


        /*
        |--------------------------------------------------------------------------
        | VERIFY OWNERSHIP
        |--------------------------------------------------------------------------
        */

        abort_unless(
            (int) $studentLesson->education_user_id ===
            (int) $student->id,
            404
        );


        /*
        |--------------------------------------------------------------------------
        | QUESTIONS
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $quiz->questions->count() > 0,
            404
        );


        /*
        |--------------------------------------------------------------------------
        | ATTEMPTS COUNT
        |--------------------------------------------------------------------------
        */

        $attemptsCount = EducationQuizAttempt::query()
            ->where(
                'education_quiz_id',
                $quiz->id
            )
            ->where(
                'education_user_id',
                $student->id
            )
            ->count();


        /*
        |--------------------------------------------------------------------------
        | MAX ATTEMPTS
        |--------------------------------------------------------------------------
        */

        $canAttempt = true;


        if (
            !is_null($quiz->max_attempts) &&
            $quiz->max_attempts > 0 &&
            $attemptsCount >= $quiz->max_attempts
        ) {

            $canAttempt = false;
        }


        /*
        |--------------------------------------------------------------------------
        | EXISTING ACTIVE ATTEMPT
        |--------------------------------------------------------------------------
        */

        $activeAttempt =
            EducationQuizAttempt::query()
                ->where(
                    'education_quiz_id',
                    $quiz->id
                )
                ->where(
                    'education_user_id',
                    $student->id
                )
                ->where(
                    'status',
                    'in_progress'
                )
                ->latest('id')
                ->first();


        /*
        |--------------------------------------------------------------------------
        | START / CONTINUE ATTEMPT
        |--------------------------------------------------------------------------
        */

        if (!$activeAttempt) {

            abort_unless(
                $canAttempt,
                403,
                'لقد استنفدت جميع المحاولات المسموح بها لهذا الاختبار.'
            );


            $attemptNumber =
                $attemptsCount + 1;


            $activeAttempt =
                EducationQuizAttempt::create([

                    'education_quiz_id' =>
                        $quiz->id,

                    'education_user_id' =>
                        $student->id,

                    'score' =>
                        0,

                    'total_points' =>
                        $quiz->questions->sum(
                            fn ($question) =>
                                (int) $question->points
                        ),

                    'percentage' =>
                        0,

                    'passed' =>
                        false,

                    'status' =>
                        'in_progress',

                    'started_at' =>
                        now(),

                    'attempt_number' =>
                        $attemptNumber,
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'education.student.quizzes.show',
            compact(
                'quiz',
                'activeAttempt',
                'studentLesson'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | SUBMIT
    |--------------------------------------------------------------------------
    | تصحيح الاختبار وتسجيل الإجابات
    |--------------------------------------------------------------------------
    */

    public function submit(
        Request $request,
        EducationQuiz $quiz
    ) {

        $student =
            auth('education')->user();


        /*
        |--------------------------------------------------------------------------
        | SECURITY
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $student,
            403
        );


        abort_unless(
            $quiz->is_active,
            404
        );


        /*
        |--------------------------------------------------------------------------
        | STUDENT LESSON
        |--------------------------------------------------------------------------
        */

        $studentLesson =
            $this->findStudentLesson(
                $quiz,
                $student
            );


        /*
        |--------------------------------------------------------------------------
        | VERIFY STUDENT LESSON
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $studentLesson,
            404
        );


        /*
        |--------------------------------------------------------------------------
        | VERIFY OWNERSHIP
        |--------------------------------------------------------------------------
        */

        abort_unless(
            (int) $studentLesson->education_user_id ===
            (int) $student->id,
            404
        );


        /*
        |--------------------------------------------------------------------------
        | ACTIVE ATTEMPT
        |--------------------------------------------------------------------------
        */

        $attempt =
            EducationQuizAttempt::query()
                ->where(
                    'education_quiz_id',
                    $quiz->id
                )
                ->where(
                    'education_user_id',
                    $student->id
                )
                ->where(
                    'status',
                    'in_progress'
                )
                ->latest('id')
                ->first();


        /*
        |--------------------------------------------------------------------------
        | VERIFY ATTEMPT
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $attempt,
            404
        );


        /*
        |--------------------------------------------------------------------------
        | LOAD QUESTIONS
        |--------------------------------------------------------------------------
        */

        $quiz->load([

            'questions' => function ($query) {

                $query
                    ->where(
                        'is_active',
                        true
                    )
                    ->orderBy(
                        'sort_order'
                    )
                    ->orderBy(
                        'id'
                    );
            },

            'questions.options' => function ($query) {

                $query
                    ->where(
                        'is_active',
                        true
                    )
                    ->orderBy(
                        'sort_order'
                    )
                    ->orderBy(
                        'id'
                    );
            },

        ]);


        /*
        |--------------------------------------------------------------------------
        | ANSWERS
        |--------------------------------------------------------------------------
        */

        $answers =
            $request->input(
                'answers',
                []
            );


        if (!is_array($answers)) {

            $answers = [];
        }


        /*
        |--------------------------------------------------------------------------
        | CALCULATE
        |--------------------------------------------------------------------------
        */

        $score = 0;


        $totalPoints =
            $quiz->questions->sum(
                fn ($question) =>
                    (int) $question->points
            );


        /*
        |--------------------------------------------------------------------------
        | TRANSACTION
        |--------------------------------------------------------------------------
        */

        DB::transaction(
            function () use (
                $quiz,
                $attempt,
                $answers,
                &$score,
                $totalPoints
            ) {

                /*
                |--------------------------------------------------------------------------
                | REMOVE OLD ANSWERS
                |--------------------------------------------------------------------------
                */

                $attempt
                    ->answers()
                    ->delete();


                /*
                |--------------------------------------------------------------------------
                | QUESTIONS
                |--------------------------------------------------------------------------
                */

                foreach (
                    $quiz->questions
                    as $question
                ) {

                    $selectedOptionId =
                        $answers[
                            $question->id
                        ] ?? null;


                    $selectedOption = null;


                    /*
                    |--------------------------------------------------------------------------
                    | FIND SELECTED OPTION
                    |--------------------------------------------------------------------------
                    */

                    if ($selectedOptionId) {

                        $selectedOption =
                            $question->options
                                ->firstWhere(
                                    'id',
                                    (int) $selectedOptionId
                                );
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | DEFAULT
                    |--------------------------------------------------------------------------
                    */

                    $isCorrect = false;

                    $pointsEarned = 0;


                    /*
                    |--------------------------------------------------------------------------
                    | CORRECT ANSWER
                    |--------------------------------------------------------------------------
                    */

                    if ($selectedOption) {

                        $isCorrect =
                            (bool)
                            $selectedOption->is_correct;


                        if ($isCorrect) {

                            $pointsEarned =
                                (int)
                                $question->points;


                            $score +=
                                $pointsEarned;
                        }
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | SAVE ANSWER
                    |--------------------------------------------------------------------------
                    */

                    EducationQuizAnswer::create([

                        'education_quiz_attempt_id' =>
                            $attempt->id,

                        'education_quiz_question_id' =>
                            $question->id,

                        'education_quiz_option_id' =>
                            $selectedOption?->id,

                        'answer_text' =>
                            null,

                        'is_correct' =>
                            $isCorrect,

                        'points_earned' =>
                            $pointsEarned,
                    ]);
                }


                /*
                |--------------------------------------------------------------------------
                | PERCENTAGE
                |--------------------------------------------------------------------------
                */

                $percentage =
                    $totalPoints > 0
                        ? round(
                            (
                                $score /
                                $totalPoints
                            ) * 100,
                            2
                        )
                        : 0;


                /*
                |--------------------------------------------------------------------------
                | PASS
                |--------------------------------------------------------------------------
                */

                $passed =
                    $percentage >=
                    (float)
                    $quiz->pass_percentage;


                /*
                |--------------------------------------------------------------------------
                | COMPLETE ATTEMPT
                |--------------------------------------------------------------------------
                */

                $attempt->update([

                    'score' =>
                        $score,

                    'total_points' =>
                        $totalPoints,

                    'percentage' =>
                        $percentage,

                    'passed' =>
                        $passed,

                    'status' =>
                        'completed',

                    'completed_at' =>
                        now(),
                ]);
            }
        );


        /*
        |--------------------------------------------------------------------------
        | RESULT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'education.student.quizzes.result',
                [
                    'attempt' =>
                        $attempt->id
                ]
            )
            ->with(
                'success',
                'تم تسليم الاختبار وتصحيحه بنجاح.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | RESULT
    |--------------------------------------------------------------------------
    | عرض نتيجة المحاولة
    |--------------------------------------------------------------------------
    */

    public function result(
        EducationQuizAttempt $attempt
    ) {

        $student =
            auth('education')->user();


        /*
        |--------------------------------------------------------------------------
        | SECURITY
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $student,
            403
        );


        /*
        |--------------------------------------------------------------------------
        | VERIFY OWNERSHIP
        |--------------------------------------------------------------------------
        */

        abort_unless(
            (int) $attempt->education_user_id ===
            (int) $student->id,
            404
        );


        /*
        |--------------------------------------------------------------------------
        | VERIFY COMPLETED
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $attempt->status === 'completed',
            404
        );


        /*
        |--------------------------------------------------------------------------
        | LOAD
        |--------------------------------------------------------------------------
        */

        $attempt->load([

            'quiz',

            'quiz.studentLesson',

            'quiz.questions',

            'answers',

            'answers.question',

            'answers.selectedOption',

        ]);


        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'education.student.quizzes.result',
            compact('attempt')
        );
    }
}
