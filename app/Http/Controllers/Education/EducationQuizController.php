<?php

namespace App\Http\Controllers\Education;

use App\Http\Controllers\Controller;
use App\Models\EducationQuiz;
use Illuminate\Http\Request;

class EducationQuizController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    | عرض اختبار عام تابع لدرس عام.
    |--------------------------------------------------------------------------
    */

    public function show(EducationQuiz $quiz)
    {
        /*
        |--------------------------------------------------------------------------
        | ONLY ACTIVE GENERAL QUIZ
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $quiz->is_active &&
            !is_null($quiz->education_lesson_id) &&
            is_null($quiz->education_student_lesson_id),
            404
        );


        /*
        |--------------------------------------------------------------------------
        | LOAD QUESTIONS
        |--------------------------------------------------------------------------
        */

        $quiz->load([
            'lesson',

            'questions' => function ($query) {

                $query
                    ->where('is_active', true)
                    ->orderBy('sort_order')
                    ->orderBy('id');
            },

            'questions.options' => function ($query) {

                $query
                    ->where('is_active', true)
                    ->orderBy('sort_order')
                    ->orderBy('id');
            },
        ]);


        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'education.resources.quiz',
            compact('quiz')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | SUBMIT
    |--------------------------------------------------------------------------
    | إرسال وتصحيح اختبار عام.
    |--------------------------------------------------------------------------
    */

    public function submit(
        Request $request,
        EducationQuiz $quiz
    ) {

        /*
        |--------------------------------------------------------------------------
        | VERIFY GENERAL QUIZ
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $quiz->is_active &&
            !is_null($quiz->education_lesson_id) &&
            is_null($quiz->education_student_lesson_id),
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
                    ->where('is_active', true)
                    ->orderBy('sort_order')
                    ->orderBy('id');
            },

            'questions.options' => function ($query) {

                $query
                    ->where('is_active', true)
                    ->orderBy('sort_order')
                    ->orderBy('id');
            },
        ]);


        /*
        |--------------------------------------------------------------------------
        | VERIFY QUESTIONS
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $quiz->questions->count() > 0,
            404
        );


        /*
        |--------------------------------------------------------------------------
        | ANSWERS
        |--------------------------------------------------------------------------
        */

        $answers = $request->input(
            'answers',
            []
        );


        if (!is_array($answers)) {

            $answers = [];
        }


        /*
        |--------------------------------------------------------------------------
        | CALCULATE SCORE
        |--------------------------------------------------------------------------
        */

        $score = 0;

        $totalPoints = $quiz->questions->sum(
            fn ($question) =>
                (int) ($question->points ?? 1)
        );


        $questionResults = [];


        foreach ($quiz->questions as $question) {

            $selectedOptionId =
                $answers[$question->id] ?? null;


            $selectedOption = null;


            if ($selectedOptionId) {

                $selectedOption =
                    $question->options->firstWhere(
                        'id',
                        (int) $selectedOptionId
                    );
            }


            $isCorrect = false;

            $pointsEarned = 0;


            if ($selectedOption) {

                $isCorrect =
                    (bool) $selectedOption->is_correct;


                if ($isCorrect) {

                    $pointsEarned =
                        (int) ($question->points ?? 1);

                    $score += $pointsEarned;
                }
            }


            $questionResults[] = [

                'question_id' =>
                    $question->id,

                'selected_option_id' =>
                    $selectedOption?->id,

                'is_correct' =>
                    $isCorrect,

                'points_earned' =>
                    $pointsEarned,

            ];
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

        $passPercentage =
            (float) ($quiz->pass_percentage ?? 0);


        $passed =
            $percentage >= $passPercentage;


        /*
        |--------------------------------------------------------------------------
        | SAVE RESULT IN SESSION
        |--------------------------------------------------------------------------
        |
        | الاختبار العام لا يحتاج إلى EducationStudentLesson.
        |
        | كما أننا لا نعتمد هنا على education_user_id
        | لأن الاختبار العام متاح من الواجهة العامة.
        |
        */

        session([
            'education_general_quiz_result' => [

                'quiz_id' =>
                    $quiz->id,

                'score' =>
                    $score,

                'total_points' =>
                    $totalPoints,

                'percentage' =>
                    $percentage,

                'pass_percentage' =>
                    $passPercentage,

                'passed' =>
                    $passed,

                'question_results' =>
                    $questionResults,

                'submitted_at' =>
                    now()->toDateTimeString(),

            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | RESULT
        |--------------------------------------------------------------------------
        */

        return redirect()->route(
            'education.resources.quiz.result',
            $quiz
        );
    }


    /*
    |--------------------------------------------------------------------------
    | RESULT
    |--------------------------------------------------------------------------
    | عرض نتيجة الاختبار العام.
    |--------------------------------------------------------------------------
    */

    public function result(EducationQuiz $quiz)
    {
        /*
        |--------------------------------------------------------------------------
        | VERIFY GENERAL QUIZ
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $quiz->is_active &&
            !is_null($quiz->education_lesson_id) &&
            is_null($quiz->education_student_lesson_id),
            404
        );


        /*
        |--------------------------------------------------------------------------
        | GET SESSION RESULT
        |--------------------------------------------------------------------------
        */

        $result =
            session(
                'education_general_quiz_result'
            );


        /*
        |--------------------------------------------------------------------------
        | VERIFY RESULT
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $result &&
            (int) ($result['quiz_id'] ?? 0) ===
                (int) $quiz->id,
            404
        );


        /*
        |--------------------------------------------------------------------------
        | LOAD QUIZ
        |--------------------------------------------------------------------------
        */

        $quiz->load([
            'lesson',

            'questions' => function ($query) {

                $query
                    ->where('is_active', true)
                    ->orderBy('sort_order')
                    ->orderBy('id');
            },

            'questions.options' => function ($query) {

                $query
                    ->where('is_active', true)
                    ->orderBy('sort_order')
                    ->orderBy('id');
            },
        ]);


        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'education.resources.quiz-result',
            compact(
                'quiz',
                'result'
            )
        );
    }
}
