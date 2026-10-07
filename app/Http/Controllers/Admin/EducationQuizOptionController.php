<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EducationQuiz;
use App\Models\EducationQuizQuestion;
use App\Models\EducationQuizOption;
use Illuminate\Http\Request;

class EducationQuizOptionController extends Controller
{
    /**
     * Display a listing of options for a question.
     */
    public function index(
        EducationQuiz $quiz,
        EducationQuizQuestion $question
    ) {
        /*
        |--------------------------------------------------------------------------
        | VERIFY QUESTION
        |--------------------------------------------------------------------------
        */

        $this->ensureQuestionBelongsToQuiz(
            $quiz,
            $question
        );


        /*
        |--------------------------------------------------------------------------
        | LOAD RELATION
        |--------------------------------------------------------------------------
        */

        $question->load('quiz');


        /*
        |--------------------------------------------------------------------------
        | OPTIONS
        |--------------------------------------------------------------------------
        */

        $options = $question->options()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->paginate(15);


        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'education.admin.quizzes.questions.options.index',
            compact(
                'quiz',
                'question',
                'options'
            )
        );
    }


    /**
     * Show the form for creating a new option.
     */
    public function create(
        EducationQuiz $quiz,
        EducationQuizQuestion $question
    ) {
        /*
        |--------------------------------------------------------------------------
        | VERIFY QUESTION
        |--------------------------------------------------------------------------
        */

        $this->ensureQuestionBelongsToQuiz(
            $quiz,
            $question
        );


        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'education.admin.quizzes.questions.options.create',
            compact(
                'quiz',
                'question'
            )
        );
    }


    /**
     * Store a newly created option.
     */
    public function store(
        Request $request,
        EducationQuiz $quiz,
        EducationQuizQuestion $question
    ) {
        /*
        |--------------------------------------------------------------------------
        | VERIFY QUESTION
        |--------------------------------------------------------------------------
        */

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

            'option' => [
                'required',
                'string',
                'max:1000',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'is_correct' => [
                'nullable',
                'boolean',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | BOOLEAN VALUES
        |--------------------------------------------------------------------------
        */

        $isCorrect = $request->boolean(
            'is_correct'
        );

        $isActive = $request->boolean(
            'is_active'
        );


        /*
        |--------------------------------------------------------------------------
        | TRUE / FALSE
        |--------------------------------------------------------------------------
        |
        | في أسئلة صح أو خطأ يسمح بخيار صحيح واحد فقط.
        |
        */

        if (
            $isCorrect &&
            $question->type === 'true_false'
        ) {
            $question->options()
                ->update([
                    'is_correct' => false,
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | CREATE OPTION
        |--------------------------------------------------------------------------
        |
        | نستخدم علاقة السؤال مباشرة حتى يتم تعيين:
        |
        | education_quiz_question_id
        |
        | تلقائيًا.
        |
        */

        $option = $question->options()->create([

            'option' => $validated['option'],

            'is_correct' => $isCorrect,

            'sort_order' => $validated['sort_order'] ?? 0,

            'is_active' => $isActive,

        ]);


        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'education.admin.quizzes.questions.options.show',
                [
                    'quiz' => $quiz,
                    'question' => $question,
                    'option' => $option,
                ]
            )
            ->with(
                'success',
                'تم إنشاء خيار الإجابة بنجاح.'
            );
    }


    /**
     * Display the specified option.
     */
    public function show(
        EducationQuiz $quiz,
        EducationQuizQuestion $question,
        EducationQuizOption $option
    ) {
        /*
        |--------------------------------------------------------------------------
        | VERIFY QUESTION
        |--------------------------------------------------------------------------
        */

        $this->ensureQuestionBelongsToQuiz(
            $quiz,
            $question
        );


        /*
        |--------------------------------------------------------------------------
        | VERIFY OPTION
        |--------------------------------------------------------------------------
        */

        $this->ensureOptionBelongsToQuestion(
            $question,
            $option
        );


        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'education.admin.quizzes.questions.options.show',
            compact(
                'quiz',
                'question',
                'option'
            )
        );
    }


    /**
     * Show the form for editing the specified option.
     */
    public function edit(
        EducationQuiz $quiz,
        EducationQuizQuestion $question,
        EducationQuizOption $option
    ) {
        /*
        |--------------------------------------------------------------------------
        | VERIFY QUESTION
        |--------------------------------------------------------------------------
        */

        $this->ensureQuestionBelongsToQuiz(
            $quiz,
            $question
        );


        /*
        |--------------------------------------------------------------------------
        | VERIFY OPTION
        |--------------------------------------------------------------------------
        */

        $this->ensureOptionBelongsToQuestion(
            $question,
            $option
        );


        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'education.admin.quizzes.questions.options.edit',
            compact(
                'quiz',
                'question',
                'option'
            )
        );
    }


    /**
     * Update the specified option.
     */
    public function update(
        Request $request,
        EducationQuiz $quiz,
        EducationQuizQuestion $question,
        EducationQuizOption $option
    ) {
        /*
        |--------------------------------------------------------------------------
        | VERIFY QUESTION
        |--------------------------------------------------------------------------
        */

        $this->ensureQuestionBelongsToQuiz(
            $quiz,
            $question
        );


        /*
        |--------------------------------------------------------------------------
        | VERIFY OPTION
        |--------------------------------------------------------------------------
        */

        $this->ensureOptionBelongsToQuestion(
            $question,
            $option
        );


        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'option' => [
                'required',
                'string',
                'max:1000',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'is_correct' => [
                'nullable',
                'boolean',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | BOOLEAN VALUES
        |--------------------------------------------------------------------------
        */

        $isCorrect = $request->boolean(
            'is_correct'
        );

        $isActive = $request->boolean(
            'is_active'
        );


        /*
        |--------------------------------------------------------------------------
        | TRUE / FALSE
        |--------------------------------------------------------------------------
        |
        | إذا أصبح هذا الخيار صحيحًا في سؤال صح أو خطأ،
        | يتم إلغاء صحة بقية الخيارات.
        |
        */

        if (
            $isCorrect &&
            $question->type === 'true_false'
        ) {
            $question->options()
                ->whereKeyNot($option->id)
                ->update([
                    'is_correct' => false,
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | UPDATE OPTION
        |--------------------------------------------------------------------------
        */

        $option->update([

            'option' => $validated['option'],

            'is_correct' => $isCorrect,

            'sort_order' => $validated['sort_order'] ?? 0,

            'is_active' => $isActive,

        ]);


        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'education.admin.quizzes.questions.options.show',
                [
                    'quiz' => $quiz,
                    'question' => $question,
                    'option' => $option,
                ]
            )
            ->with(
                'success',
                'تم تحديث خيار الإجابة بنجاح.'
            );
    }


    /**
     * Remove the specified option.
     */
    public function destroy(
        EducationQuiz $quiz,
        EducationQuizQuestion $question,
        EducationQuizOption $option
    ) {
        /*
        |--------------------------------------------------------------------------
        | VERIFY QUESTION
        |--------------------------------------------------------------------------
        */

        $this->ensureQuestionBelongsToQuiz(
            $quiz,
            $question
        );


        /*
        |--------------------------------------------------------------------------
        | VERIFY OPTION
        |--------------------------------------------------------------------------
        */

        $this->ensureOptionBelongsToQuestion(
            $question,
            $option
        );


        /*
        |--------------------------------------------------------------------------
        | DELETE
        |--------------------------------------------------------------------------
        */

        $option->delete();


        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'education.admin.quizzes.questions.options.index',
                [
                    'quiz' => $quiz,
                    'question' => $question,
                ]
            )
            ->with(
                'success',
                'تم حذف خيار الإجابة بنجاح.'
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
            (int) $question->education_quiz_id === (int) $quiz->id,
            404
        );
    }


    /**
     * Make sure the option belongs to the selected question.
     */
    protected function ensureOptionBelongsToQuestion(
        EducationQuizQuestion $question,
        EducationQuizOption $option
    ): void {
        abort_unless(
            (int) $option->education_quiz_question_id === (int) $question->id,
            404
        );
    }
}
