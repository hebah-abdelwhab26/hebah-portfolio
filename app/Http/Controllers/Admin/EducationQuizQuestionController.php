<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EducationQuiz;
use App\Models\EducationQuizQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EducationQuizQuestionController extends Controller
{
    /**
     * Display a listing of questions for a quiz.
     */
    public function index(EducationQuiz $quiz)
    {
        $quiz->load('lesson');

        $questions = $quiz->questions()
            ->with('options')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->paginate(15);

        return view(
            'education.admin.quizzes.questions.index',
            compact('quiz', 'questions')
        );
    }


    /**
     * Show the form for creating a new question.
     */
    public function create(EducationQuiz $quiz)
    {
        return view(
            'education.admin.quizzes.questions.create',
            compact('quiz')
        );
    }


    /**
     * Store a newly created question.
     */
    public function store(
        Request $request,
        EducationQuiz $quiz
    ) {
        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'question' => [
                'required',
                'string',
            ],

            'type' => [
                'required',
                'string',
                'in:multiple_choice,true_false,text',
            ],

            'points' => [
                'required',
                'integer',
                'min:1',
            ],

            'explanation' => [
                'nullable',
                'string',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],

            /*
            |--------------------------------------------------------------------------
            | OPTIONS
            |--------------------------------------------------------------------------
            */

            'options' => [
                'nullable',
                'array',
            ],

            'options.*.option' => [
                'required',
                'string',
                'max:1000',
            ],

            'options.*.sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],

            /*
            |--------------------------------------------------------------------------
            | CORRECT OPTION
            |--------------------------------------------------------------------------
            |
            | This is the array index coming from create.blade.php.
            |
            */

            'correct_option' => [
                'nullable',
                'integer',
                'min:0',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | ADDITIONAL VALIDATION
        |--------------------------------------------------------------------------
        |
        | Multiple choice questions must have at least two options and
        | one correct answer.
        |
        */

        if ($validated['type'] === 'multiple_choice') {

            $options = $validated['options'] ?? [];

            if (count($options) < 2) {

                return back()
                    ->withInput()
                    ->withErrors([
                        'options' => 'يجب إضافة خيارين على الأقل للسؤال.',
                    ]);
            }


            if (
                !array_key_exists(
                    $validated['correct_option'] ?? -1,
                    $options
                )
            ) {

                return back()
                    ->withInput()
                    ->withErrors([
                        'correct_option' => 'يرجى تحديد الإجابة الصحيحة.',
                    ]);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | TRUE / FALSE VALIDATION
        |--------------------------------------------------------------------------
        |
        | The JavaScript automatically creates:
        |
        | 1. صح
        | 2. خطأ
        |
        */

        if ($validated['type'] === 'true_false') {

            $options = $validated['options'] ?? [];

            if (count($options) !== 2) {

                return back()
                    ->withInput()
                    ->withErrors([
                        'options' => 'يجب أن يحتوي سؤال صح أو خطأ على خيارين.',
                    ]);
            }


            if (
                !array_key_exists(
                    $validated['correct_option'] ?? -1,
                    $options
                )
            ) {

                return back()
                    ->withInput()
                    ->withErrors([
                        'correct_option' => 'يرجى تحديد الإجابة الصحيحة.',
                    ]);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | CREATE QUESTION + OPTIONS
        |--------------------------------------------------------------------------
        |
        | Everything is stored inside one transaction.
        |
        | If something fails, neither the question nor its options
        | will be partially saved.
        |
        */

        $question = DB::transaction(function () use (
            $validated,
            $request,
            $quiz
        ) {

            /*
            |--------------------------------------------------------------------------
            | CREATE QUESTION
            |--------------------------------------------------------------------------
            */

            $question = $quiz->questions()->create([

                'question' => $validated['question'],

                'type' => $validated['type'],

                'points' => $validated['points'],

                'explanation' =>
                    $validated['explanation'] ?? null,

                'sort_order' =>
                    $validated['sort_order'] ?? 0,

                'is_active' =>
                    $request->boolean('is_active'),
            ]);


            /*
            |--------------------------------------------------------------------------
            | CREATE OPTIONS
            |--------------------------------------------------------------------------
            */

            if (
                $validated['type'] === 'multiple_choice' ||
                $validated['type'] === 'true_false'
            ) {

                $options =
                    $validated['options'] ?? [];

                $correctOptionIndex =
                    $validated['correct_option'] ?? null;


                foreach ($options as $index => $optionData) {

                    /*
                    |--------------------------------------------------------------------------
                    | DETERMINE CORRECT ANSWER
                    |--------------------------------------------------------------------------
                    */

                    $isCorrect =
                        $correctOptionIndex !== null &&
                        (int) $correctOptionIndex === (int) $index;


                    /*
                    |--------------------------------------------------------------------------
                    | CREATE OPTION
                    |--------------------------------------------------------------------------
                    */

                    $question->options()->create([

                        'option' =>
                            $optionData['option'],

                        'is_correct' =>
                            $isCorrect,

                        'sort_order' =>
                            $optionData['sort_order']
                            ?? ($index + 1),

                        'is_active' =>
                            true,
                    ]);
                }
            }


            return $question;
        });


        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'education.admin.quizzes.questions.show',
                [$quiz, $question]
            )
            ->with(
                'success',
                'تم إنشاء السؤال وخيارات الإجابة بنجاح.'
            );
    }


    /**
     * Display the specified question.
     */
    public function show(
        EducationQuiz $quiz,
        EducationQuizQuestion $question
    ) {
        $this->ensureQuestionBelongsToQuiz(
            $quiz,
            $question
        );


        $question->load([
            'options' => function ($query) {

                $query
                    ->orderBy('sort_order')
                    ->orderBy('id');

            },

            'quiz.lesson',
        ]);


        return view(
            'education.admin.quizzes.questions.show',
            compact('quiz', 'question')
        );
    }


    /**
     * Show the form for editing the specified question.
     */
    public function edit(
        EducationQuiz $quiz,
        EducationQuizQuestion $question
    ) {
        $this->ensureQuestionBelongsToQuiz(
            $quiz,
            $question
        );


        $question->load([
            'options' => function ($query) {

                $query
                    ->orderBy('sort_order')
                    ->orderBy('id');

            },

            'quiz.lesson',
        ]);


        return view(
            'education.admin.quizzes.questions.edit',
            compact('quiz', 'question')
        );
    }


    /**
     * Update the specified question.
     */
    public function update(
        Request $request,
        EducationQuiz $quiz,
        EducationQuizQuestion $question
    ) {
        $this->ensureQuestionBelongsToQuiz(
            $quiz,
            $question
        );


        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'question' => [
                'required',
                'string',
            ],

            'type' => [
                'required',
                'string',
                'in:multiple_choice,true_false,text',
            ],

            'points' => [
                'required',
                'integer',
                'min:1',
            ],

            'explanation' => [
                'nullable',
                'string',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],

            /*
            |--------------------------------------------------------------------------
            | OPTIONS
            |--------------------------------------------------------------------------
            */

            'options' => [
                'nullable',
                'array',
            ],

            'options.*.id' => [
                'required',
                'integer',
            ],

            'options.*.option' => [
                'required',
                'string',
                'max:1000',
            ],

            'options.*.is_active' => [
                'nullable',
                'boolean',
            ],

            'correct_option' => [
                'nullable',
                'integer',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | UPDATE QUESTION + OPTIONS
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use (
            $request,
            $validated,
            $quiz,
            $question
        ) {

            /*
            |--------------------------------------------------------------------------
            | UPDATE QUESTION
            |--------------------------------------------------------------------------
            */

            $question->update([

                'question' =>
                    $validated['question'],

                'type' =>
                    $validated['type'],

                'points' =>
                    $validated['points'],

                'explanation' =>
                    $validated['explanation'] ?? null,

                'sort_order' =>
                    $validated['sort_order'] ?? 0,

                'is_active' =>
                    $request->boolean('is_active'),
            ]);


            /*
            |--------------------------------------------------------------------------
            | UPDATE OPTIONS
            |--------------------------------------------------------------------------
            */

            $options =
                $validated['options'] ?? [];


            if (
                $validated['type'] === 'multiple_choice' ||
                $validated['type'] === 'true_false'
            ) {

                /*
                |--------------------------------------------------------------------------
                | RESET CORRECT ANSWERS
                |--------------------------------------------------------------------------
                */

                $question->options()->update([
                    'is_correct' => false,
                ]);


                /*
                |--------------------------------------------------------------------------
                | UPDATE EXISTING OPTIONS
                |--------------------------------------------------------------------------
                */

                foreach ($options as $optionData) {

                    $option = $question
                        ->options()
                        ->where(
                            'id',
                            $optionData['id']
                        )
                        ->first();


                    if (!$option) {
                        continue;
                    }


                    $option->update([

                        'option' =>
                            $optionData['option'],

                        'is_active' =>
                            isset(
                                $optionData['is_active']
                            ),
                    ]);
                }


                /*
                |--------------------------------------------------------------------------
                | SET CORRECT OPTION
                |--------------------------------------------------------------------------
                */

                if (
                    !empty(
                        $validated['correct_option']
                    )
                ) {

                    $correctOption =
                        $question
                            ->options()
                            ->where(
                                'id',
                                $validated['correct_option']
                            )
                            ->first();


                    if ($correctOption) {

                        $correctOption->update([
                            'is_correct' => true,
                        ]);
                    }
                }
            }


            /*
            |--------------------------------------------------------------------------
            | TEXT QUESTION
            |--------------------------------------------------------------------------
            */

            if (
                $validated['type'] === 'text'
            ) {

                $question->options()->update([
                    'is_correct' => false,
                ]);
            }
        });


        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'education.admin.quizzes.questions.show',
                [$quiz, $question]
            )
            ->with(
                'success',
                'تم تحديث السؤال وخيارات الإجابة بنجاح.'
            );
    }


    /**
     * Remove the specified question.
     */
    public function destroy(
        EducationQuiz $quiz,
        EducationQuizQuestion $question
    ) {
        $this->ensureQuestionBelongsToQuiz(
            $quiz,
            $question
        );


        $question->delete();


        return redirect()
            ->route(
                'education.admin.quizzes.questions.index',
                $quiz
            )
            ->with(
                'success',
                'تم حذف السؤال بنجاح.'
            );
    }


    /**
     * Make sure the question belongs to the selected quiz.
     */
    protected function ensureQuestionBelongsToQuiz(
        EducationQuiz $quiz,
        EducationQuizQuestion $question
    ): void {
        abort_unless(
            $question->education_quiz_id === $quiz->id,
            404
        );
    }
}
