@extends('education.admin.layouts.app')

@section('title', __('education_admin.quiz_questions.page_title'))

@section('content')

<div class="education-admin-content-page">

    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}

    <div class="education-admin-content-header">

        <div class="education-admin-content-heading">

            <span class="education-admin-page-header-label">

                <i class="fa-solid fa-circle-question"></i>

                {{ __('education_admin.quiz_questions.header_label') }}

            </span>


            <div class="education-admin-content-title-row">

                <div class="education-admin-content-title-icon">

                    <i class="fa-solid fa-clipboard-question"></i>

                </div>


                <div>

                    <h2>
                        {{ __('education_admin.quiz_questions.title') }}
                    </h2>


                    <span class="education-admin-content-lesson-name">

                        <i class="fa-solid fa-clipboard-list"></i>

                        {{ $quiz->title }}

                    </span>

                </div>

            </div>


            <p>
                {{ __('education_admin.quiz_questions.description') }}
            </p>

        </div>


        {{-- HEADER ACTIONS --}}

        <div class="education-admin-content-header-actions">

            {{-- ADD QUESTION --}}

            <a
                href="{{ route(
                    'education.admin.quizzes.questions.create',
                    $quiz
                ) }}"
                class="education-admin-content-primary-button"
            >

                <i class="fa-solid fa-plus"></i>

                {{ __('education_admin.quiz_questions.actions.add_question') }}

            </a>


            {{-- BACK TO QUIZ --}}

            <a
                href="{{ route(
                    'education.admin.quizzes.show',
                    $quiz
                ) }}"
                class="education-admin-content-back-button"
            >

                <i class="fa-solid fa-arrow-right"></i>

                {{ __('education_admin.quiz_questions.actions.quiz') }}

            </a>

        </div>

    </div>



    {{-- =========================================================
        SUCCESS MESSAGE
    ========================================================== --}}

    @if(session('success'))

        <div class="education-admin-content-alert success">

            <div class="education-admin-content-alert-icon">

                <i class="fa-solid fa-circle-check"></i>

            </div>


            <div>

                <strong>
                    {{ __('education_admin.quiz_questions.alerts.success_title') }}
                </strong>

                <p>
                    {{ session('success') }}
                </p>

            </div>

        </div>

    @endif



    {{-- =========================================================
        ERROR MESSAGE
    ========================================================== --}}

    @if(session('error'))

        <div class="education-admin-content-alert error">

            <div class="education-admin-content-alert-icon">

                <i class="fa-solid fa-triangle-exclamation"></i>

            </div>


            <div>

                <strong>
                    {{ __('education_admin.quiz_questions.alerts.error_title') }}
                </strong>

                <p>
                    {{ session('error') }}
                </p>

            </div>

        </div>

    @endif



    {{-- =========================================================
        QUIZ SUMMARY
    ========================================================== --}}

    <div class="education-admin-quiz-overview-grid">


        {{-- QUESTIONS --}}

        <div class="education-admin-quiz-overview-card">

            <div class="education-admin-quiz-overview-icon">

                <i class="fa-solid fa-circle-question"></i>

            </div>


            <div>

                <span>
                    {{ __('education_admin.quiz_questions.summary.questions') }}
                </span>

                <strong>
                    {{ $questions->total() }}
                </strong>

            </div>

        </div>



        {{-- PASS --}}

        <div class="education-admin-quiz-overview-card gold">

            <div class="education-admin-quiz-overview-icon">

                <i class="fa-solid fa-percent"></i>

            </div>


            <div>

                <span>
                    {{ __('education_admin.quiz_questions.summary.pass_percentage') }}
                </span>

                <strong>
                    {{ $quiz->pass_percentage }}%
                </strong>

            </div>

        </div>



        {{-- ATTEMPTS --}}

        <div class="education-admin-quiz-overview-card green">

            <div class="education-admin-quiz-overview-icon">

                <i class="fa-solid fa-repeat"></i>

            </div>


            <div>

                <span>
                    {{ __('education_admin.quiz_questions.summary.attempts') }}
                </span>

                <strong>

                    {{ $quiz->max_attempts ?: '∞' }}

                </strong>

            </div>

        </div>



        {{-- TIME --}}

        <div class="education-admin-quiz-overview-card">

            <div class="education-admin-quiz-overview-icon">

                <i class="fa-regular fa-clock"></i>

            </div>


            <div>

                <span>
                    {{ __('education_admin.quiz_questions.summary.time') }}
                </span>

                <strong>

                    @if($quiz->time_limit)

                        {{ $quiz->time_limit }}

                        <small>
                            {{ __('education_admin.quiz_questions.summary.minutes') }}
                        </small>

                    @else

                        ∞

                    @endif

                </strong>

            </div>

        </div>

    </div>



    {{-- =========================================================
        QUESTIONS LIST
    ========================================================== --}}

    <div class="education-admin-content-table-card">


        {{-- TABLE HEADER --}}

        <div class="education-admin-content-table-header">

            <div>

                <span>
                    {{ __('education_admin.quiz_questions.list.section_label') }}
                </span>

                <h3>
                    {{ __('education_admin.quiz_questions.list.title') }}
                </h3>

            </div>


            <div class="education-admin-content-table-header-count">

                <i class="fa-solid fa-list-ol"></i>

                {{ $questions->total() }}

                {{ __('education_admin.quiz_questions.list.question_count') }}

            </div>

        </div>



        {{-- QUESTIONS --}}

        <div class="education-admin-questions-list">

            @if($questions->count())

                @foreach($questions as $question)

                    @php

                        /*
                        |--------------------------------------------------------------------------
                        | OPTIONS
                        |--------------------------------------------------------------------------
                        | نضمن أن الخيارات الموجودة في العلاقة يتم التعامل معها
                        | كمجموعة Collection حتى لو لم تكن محملة مسبقًا.
                        */

                        $options = $question->options instanceof \Illuminate\Database\Eloquent\Collection
                            ? $question->options
                            : collect($question->options ?? []);

                        $sortedOptions = $options
                            ->sortBy([
                                ['sort_order', 'asc'],
                                ['id', 'asc'],
                            ]);

                        $optionsCount = $sortedOptions->count();

                        $correctOptionsCount = $sortedOptions
                            ->where('is_correct', true)
                            ->count();

                        $activeOptionsCount = $sortedOptions
                            ->where('is_active', true)
                            ->count();

                    @endphp


                    <div class="education-admin-question-item">


                        {{-- =================================================
                            QUESTION NUMBER
                        ================================================== --}}

                        <div class="education-admin-question-number">

                            {{ $question->sort_order ?: $loop->iteration }}

                        </div>



                        {{-- =================================================
                            QUESTION CONTENT
                        ================================================== --}}

                        <div class="education-admin-question-content">


                            {{-- QUESTION TOP --}}

                            <div class="education-admin-question-top">

                                <div>

                                    <span class="education-admin-question-label">

                                        {{ __('education_admin.quiz_questions.question.label') }}

                                    </span>


                                    <h3>

                                        {{ $question->question }}

                                    </h3>

                                </div>


                                {{-- STATUS --}}

                                @if($question->is_active)

                                    <span class="education-admin-status-badge active">

                                        <i class="fa-solid fa-circle-check"></i>

                                        {{ __('education_admin.quiz_questions.status.active') }}

                                    </span>

                                @else

                                    <span class="education-admin-status-badge inactive">

                                        <i class="fa-solid fa-circle-xmark"></i>

                                        {{ __('education_admin.quiz_questions.status.inactive') }}

                                    </span>

                                @endif

                            </div>



                            {{-- =================================================
                                QUESTION META
                            ================================================== --}}

                            <div class="education-admin-question-meta">


                                {{-- TYPE --}}

                                <span>

                                    @if($question->type === 'multiple_choice')

                                        <i class="fa-solid fa-list-ul"></i>

                                        {{ __('education_admin.quiz_questions.types.multiple_choice') }}

                                    @elseif($question->type === 'true_false')

                                        <i class="fa-solid fa-check-double"></i>

                                        {{ __('education_admin.quiz_questions.types.true_false') }}

                                    @else

                                        <i class="fa-solid fa-align-right"></i>

                                        {{ __('education_admin.quiz_questions.types.text') }}

                                    @endif

                                </span>



                                {{-- POINTS --}}

                                <span>

                                    <i class="fa-solid fa-star"></i>

                                    {{ $question->points }}

                                    {{ $question->points == 1
                                        ? __('education_admin.quiz_questions.points.single')
                                        : __('education_admin.quiz_questions.points.multiple')
                                    }}

                                </span>



                                {{-- OPTIONS COUNT --}}

                                @if(
                                    $question->type === 'multiple_choice' ||
                                    $question->type === 'true_false'
                                )

                                    <span>

                                        <i class="fa-solid fa-list-check"></i>

                                        {{ $optionsCount }}

                                        {{ $optionsCount == 1
                                            ? __('education_admin.quiz_questions.options.single')
                                            : __('education_admin.quiz_questions.options.multiple')
                                        }}

                                    </span>


                                    {{-- CORRECT OPTIONS --}}

                                    <span>

                                        <i class="fa-solid fa-circle-check"></i>

                                        {{ $correctOptionsCount }}

                                        {{ $correctOptionsCount == 1
                                            ? __('education_admin.quiz_questions.correct_answers.single')
                                            : __('education_admin.quiz_questions.correct_answers.multiple')
                                        }}

                                    </span>

                                @endif

                            </div>



                            {{-- =================================================
                                OPTIONS SECTION
                            ================================================== --}}

                            @if(
                                $question->type === 'multiple_choice' ||
                                $question->type === 'true_false'
                            )

                                @if($optionsCount)

                                    <div class="education-admin-question-options">

                                        @foreach(
                                            $sortedOptions->take(4)
                                            as $option
                                        )

                                            <div
                                                class="
                                                    education-admin-question-option
                                                    {{ $option->is_correct ? 'correct' : '' }}
                                                    {{ !$option->is_active ? 'inactive' : '' }}
                                                "
                                            >

                                                {{-- OPTION ICON --}}

                                                <span class="education-admin-question-option-icon">

                                                    @if($option->is_correct)

                                                        <i class="fa-solid fa-check"></i>

                                                    @else

                                                        <i class="fa-solid fa-circle"></i>

                                                    @endif

                                                </span>


                                                {{-- OPTION TEXT --}}

                                                <span class="education-admin-question-option-text">

                                                    {{ $option->option }}

                                                </span>


                                                {{-- OPTION STATUS --}}

                                                @if(!$option->is_active)

                                                    <span class="education-admin-question-option-status">

                                                        {{ __('education_admin.quiz_questions.status.inactive') }}

                                                    </span>

                                                @endif

                                            </div>

                                        @endforeach


                                        {{-- MORE OPTIONS --}}

                                        @if($optionsCount > 4)

                                            <span class="education-admin-question-more-options">

                                                +{{ $optionsCount - 4 }}

                                                {{ __('education_admin.quiz_questions.options.more') }}

                                            </span>

                                        @endif

                                    </div>


                                    {{-- OPTIONS SUMMARY --}}

                                    <div class="education-admin-question-options-summary">

                                        <span>

                                            <i class="fa-solid fa-list"></i>

                                            {{ $optionsCount }}

                                            {{ __('education_admin.quiz_questions.options_summary.total') }}

                                        </span>


                                        <span>

                                            <i class="fa-solid fa-circle-check"></i>

                                            {{ $activeOptionsCount }}

                                            {{ __('education_admin.quiz_questions.options_summary.active') }}

                                        </span>


                                        <span>

                                            <i class="fa-solid fa-check-double"></i>

                                            {{ $correctOptionsCount }}

                                            {{ __('education_admin.quiz_questions.options_summary.correct') }}

                                        </span>

                                    </div>

                                @else

                                    {{-- NO OPTIONS --}}

                                    <div class="education-admin-question-no-options">

                                        <div class="education-admin-question-no-options-icon">

                                            <i class="fa-solid fa-triangle-exclamation"></i>

                                        </div>


                                        <div>

                                            <strong>
                                                {{ __('education_admin.quiz_questions.no_options.title') }}
                                            </strong>

                                            <span>
                                                {{ __('education_admin.quiz_questions.no_options.description') }}
                                            </span>

                                        </div>


                                        <a
                                            href="{{ route(
                                                'education.admin.quizzes.questions.options.create',
                                                [
                                                    $quiz,
                                                    $question
                                                ]
                                            ) }}"
                                            class="education-admin-question-add-option-button"
                                        >

                                            <i class="fa-solid fa-plus"></i>

                                            {{ __('education_admin.quiz_questions.actions.add_option') }}

                                        </a>

                                    </div>

                                @endif

                            @endif



                            {{-- =================================================
                                TEXT ANSWER
                            ================================================== --}}

                            @if($question->type === 'text')

                                <div class="education-admin-question-text-answer">

                                    <i class="fa-solid fa-keyboard"></i>

                                    <span>

                                        {{ __('education_admin.quiz_questions.text_answer.description') }}

                                    </span>

                                </div>

                            @endif



                            {{-- =================================================
                                EXPLANATION
                            ================================================== --}}

                            @if($question->explanation)

                                <div class="education-admin-question-explanation">

                                    <i class="fa-solid fa-lightbulb"></i>

                                    <span>

                                        {{ \Illuminate\Support\Str::limit(
                                            $question->explanation,
                                            180
                                        ) }}

                                    </span>

                                </div>

                            @endif

                        </div>



                        {{-- =================================================
                            ACTIONS
                        ================================================== --}}

                        <div class="education-admin-question-actions">


                            {{-- SHOW --}}

                            <a
                                href="{{ route(
                                    'education.admin.quizzes.questions.show',
                                    [
                                        $quiz,
                                        $question
                                    ]
                                ) }}"
                                class="education-admin-table-action view"
                                title="{{ __('education_admin.quiz_questions.actions.view_question') }}"
                            >

                                <i class="fa-regular fa-eye"></i>

                            </a>



                            {{-- OPTIONS --}}

                            @if(
                                $question->type === 'multiple_choice' ||
                                $question->type === 'true_false'
                            )

                                <a
                                    href="{{ route(
                                        'education.admin.quizzes.questions.options.index',
                                        [
                                            $quiz,
                                            $question
                                        ]
                                    ) }}"
                                    class="education-admin-table-action questions"
                                    title="{{ __('education_admin.quiz_questions.actions.manage_options') }}"
                                >

                                    <i class="fa-solid fa-list-check"></i>

                                </a>


                                {{-- ADD OPTION --}}

                                <a
                                    href="{{ route(
                                        'education.admin.quizzes.questions.options.create',
                                        [
                                            $quiz,
                                            $question
                                        ]
                                    ) }}"
                                    class="education-admin-table-action add"
                                    title="{{ __('education_admin.quiz_questions.actions.add_option') }}"
                                >

                                    <i class="fa-solid fa-plus"></i>

                                </a>

                            @endif



                            {{-- EDIT --}}

                            <a
                                href="{{ route(
                                    'education.admin.quizzes.questions.edit',
                                    [
                                        $quiz,
                                        $question
                                    ]
                                ) }}"
                                class="education-admin-table-action edit"
                                title="{{ __('education_admin.quiz_questions.actions.edit_question') }}"
                            >

                                <i class="fa-solid fa-pen"></i>

                            </a>



                            {{-- DELETE --}}

                            <form
                                action="{{ route(
                                    'education.admin.quizzes.questions.destroy',
                                    [
                                        $quiz,
                                        $question
                                    ]
                                ) }}"
                                method="POST"
                                onsubmit="return confirm(@json(__('education_admin.quiz_questions.actions.confirm_delete')));"
                            >

                                @csrf

                                @method('DELETE')


                                <button
                                    type="submit"
                                    class="education-admin-table-action delete"
                                    title="{{ __('education_admin.quiz_questions.actions.delete_question') }}"
                                >

                                    <i class="fa-solid fa-trash"></i>

                                </button>

                            </form>

                        </div>

                    </div>

                @endforeach

            @else

                {{-- =====================================================
                    EMPTY STATE
                ====================================================== --}}

                <div class="education-admin-content-empty">

                    <div class="education-admin-content-empty-icon">

                        <i class="fa-solid fa-circle-question"></i>

                    </div>


                    <h3>
                        {{ __('education_admin.quiz_questions.empty.title') }}
                    </h3>


                    <p>
                        {{ __('education_admin.quiz_questions.empty.description') }}
                    </p>


                    <a
                        href="{{ route(
                            'education.admin.quizzes.questions.create',
                            $quiz
                        ) }}"
                        class="education-admin-content-primary-button"
                    >

                        <i class="fa-solid fa-plus"></i>

                        {{ __('education_admin.quiz_questions.empty.add_first') }}

                    </a>

                </div>

            @endif

        </div>



        {{-- =========================================================
            PAGINATION
        ========================================================== --}}

        @if($questions->hasPages())

            <div class="education-admin-content-pagination">

                {{ $questions->links() }}

            </div>

        @endif

    </div>

</div>

@endsection
