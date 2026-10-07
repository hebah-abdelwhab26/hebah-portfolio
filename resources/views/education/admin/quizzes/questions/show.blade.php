@extends('education.admin.layouts.app')

@section('title', __('education_admin.quiz_question_show.page_title'))

@section('content')

<div class="education-admin-content-create-page">

    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}

    <div class="education-admin-content-create-header">

        <div class="education-admin-content-create-heading">

            <span class="education-admin-page-header-label">

                <i class="fa-solid fa-eye"></i>

                {{ __('education_admin.quiz_question_show.header_label') }}

            </span>


            <div class="education-admin-content-title-row">

                <div class="education-admin-content-title-icon">

                    <i class="fa-solid fa-circle-question"></i>

                </div>


                <div>

                    <h2>
                        {{ __('education_admin.quiz_question_show.title') }}
                    </h2>


                    <span class="education-admin-content-lesson-name">

                        <i class="fa-solid fa-clipboard-question"></i>

                        {{ $quiz->title }}

                    </span>

                </div>

            </div>


            <p>
                {{ __('education_admin.quiz_question_show.description') }}
            </p>

        </div>


        {{-- HEADER ACTIONS --}}

        <div class="education-admin-content-header-actions">

            <a
                href="{{ route(
                    'education.admin.quizzes.questions.index',
                    $quiz
                ) }}"
                class="education-admin-content-back-button"
            >

                <i class="fa-solid fa-arrow-right"></i>

                {{ __('education_admin.quiz_question_show.actions.back') }}

            </a>


            <a
                href="{{ route(
                    'education.admin.quizzes.questions.edit',
                    [$quiz, $question]
                ) }}"
                class="education-admin-content-submit-button"
            >

                <i class="fa-solid fa-pen-to-square"></i>

                {{ __('education_admin.quiz_question_show.actions.edit') }}

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
                    {{ __('education_admin.quiz_question_show.alerts.success_title') }}
                </strong>

                <p>
                    {{ session('success') }}
                </p>

            </div>

        </div>

    @endif



    {{-- =========================================================
        CONTENT GRID
    ========================================================== --}}

    <div class="education-admin-content-form-grid">


        {{-- =====================================================
            MAIN COLUMN
        ====================================================== --}}

        <div class="education-admin-content-form-main">


            {{-- =================================================
                QUESTION
            ================================================== --}}

            <div class="education-admin-content-form-card">

                <div class="education-admin-content-form-card-header">

                    <div class="education-admin-content-form-card-icon">

                        <i class="fa-solid fa-circle-question"></i>

                    </div>


                    <div>

                        <span>
                            {{ __('education_admin.quiz_question_show.question.section_label') }}
                        </span>

                        <h3>
                            {{ __('education_admin.quiz_question_show.question.title') }}
                        </h3>

                    </div>

                </div>


                <div class="education-admin-content-form-body">


                    {{-- QUESTION TEXT --}}

                    <div class="education-admin-content-field">

                        <label>
                            {{ __('education_admin.quiz_question_show.question.label') }}
                        </label>


                        <div class="education-admin-content-view-box large">

                            {!! nl2br(
                                e($question->question)
                            ) !!}

                        </div>

                    </div>



                    {{-- EXPLANATION --}}

                    @if($question->explanation)

                        <div class="education-admin-content-field">

                            <label>
                                {{ __('education_admin.quiz_question_show.question.explanation') }}
                            </label>


                            <div class="education-admin-content-view-box">

                                {!! nl2br(
                                    e($question->explanation)
                                ) !!}

                            </div>

                        </div>

                    @endif

                </div>

            </div>



            {{-- =================================================
                ANSWER OPTIONS
            ================================================== --}}

            @if(
                $question->type === 'multiple_choice' ||
                $question->type === 'true_false'
            )

                <div class="education-admin-content-form-card">

                    {{-- CARD HEADER --}}

                    <div class="education-admin-content-form-card-header">

                        <div class="education-admin-content-form-card-icon gold">

                            <i class="fa-solid fa-list-check"></i>

                        </div>


                        <div>

                            <span>
                                {{ __('education_admin.quiz_question_show.options.section_label') }}
                            </span>

                            <h3>
                                {{ __('education_admin.quiz_question_show.options.title') }}
                            </h3>

                        </div>


                        {{-- ADD OPTION --}}

                        <div style="margin-right:auto;">

                            <a
                                href="{{ route(
                                    'education.admin.quizzes.questions.options.create',
                                    [$quiz, $question]
                                ) }}"
                                class="education-admin-content-small-action"
                            >

                                <i class="fa-solid fa-plus"></i>

                                {{ __('education_admin.quiz_question_show.actions.add_option') }}

                            </a>

                        </div>

                    </div>


                    {{-- OPTIONS BODY --}}

                    <div class="education-admin-content-form-body">

                        @if($question->options->count())

                            <div class="education-admin-question-options-list">

                                @foreach(
                                    $question->options
                                        ->sortBy([
                                            ['sort_order', 'asc'],
                                            ['id', 'asc']
                                        ])
                                    as $option
                                )

                                    <div
                                        class="
                                            education-admin-question-option-row
                                            {{ $option->is_correct ? 'correct' : '' }}
                                        "
                                    >


                                        {{-- =================================
                                            OPTION NUMBER
                                        ================================== --}}

                                        <div class="education-admin-question-option-number">

                                            {{ $loop->iteration }}

                                        </div>



                                        {{-- =================================
                                            OPTION ICON
                                        ================================== --}}

                                        <div class="education-admin-question-option-icon">

                                            @if($option->is_correct)

                                                <i class="fa-solid fa-check"></i>

                                            @else

                                                <i class="fa-solid fa-circle"></i>

                                            @endif

                                        </div>



                                        {{-- =================================
                                            OPTION CONTENT
                                        ================================== --}}

                                        <div class="education-admin-question-option-content">

                                            <strong>

                                                {{ $option->option }}

                                            </strong>


                                            <div class="education-admin-question-option-meta">

                                                {{-- CORRECT --}}

                                                @if($option->is_correct)

                                                    <span class="education-admin-question-option-correct">

                                                        <i class="fa-solid fa-circle-check"></i>

                                                        {{ __('education_admin.quiz_question_show.options.correct') }}

                                                    </span>

                                                @else

                                                    <span class="education-admin-question-option-wrong">

                                                        <i class="fa-solid fa-circle-xmark"></i>

                                                        {{ __('education_admin.quiz_question_show.options.incorrect') }}

                                                    </span>

                                                @endif


                                                {{-- SORT ORDER --}}

                                                <span>

                                                    <i class="fa-solid fa-arrow-down-1-9"></i>

                                                    {{ __('education_admin.quiz_question_show.options.order') }}

                                                    {{ $option->sort_order }}

                                                </span>

                                            </div>

                                        </div>



                                        {{-- =================================
                                            STATUS
                                        ================================== --}}

                                        <div class="education-admin-question-option-status">

                                            @if($option->is_active)

                                                <span class="education-admin-content-status active">

                                                    <i class="fa-solid fa-circle-check"></i>

                                                    {{ __('education_admin.quiz_question_show.status.active') }}

                                                </span>

                                            @else

                                                <span class="education-admin-content-status inactive">

                                                    <i class="fa-solid fa-circle-xmark"></i>

                                                    {{ __('education_admin.quiz_question_show.status.inactive') }}

                                                </span>

                                            @endif

                                        </div>



                                        {{-- =================================
                                            ACTIONS
                                        ================================== --}}

                                        <div class="education-admin-question-actions">

                                            {{-- VIEW OPTION --}}

                                            <a
                                                href="{{ route(
                                                    'education.admin.quizzes.questions.options.show',
                                                    [
                                                        $quiz,
                                                        $question,
                                                        $option
                                                    ]
                                                ) }}"
                                                class="education-admin-table-action view"
                                                title="{{ __('education_admin.quiz_question_show.actions.view_option') }}"
                                            >

                                                <i class="fa-solid fa-eye"></i>

                                            </a>


                                            {{-- EDIT OPTION --}}

                                            <a
                                                href="{{ route(
                                                    'education.admin.quizzes.questions.options.edit',
                                                    [
                                                        $quiz,
                                                        $question,
                                                        $option
                                                    ]
                                                ) }}"
                                                class="education-admin-table-action edit"
                                                title="{{ __('education_admin.quiz_question_show.actions.edit_option') }}"
                                            >

                                                <i class="fa-solid fa-pen"></i>

                                            </a>


                                            {{-- DELETE OPTION --}}

                                            <form
                                                action="{{ route(
                                                    'education.admin.quizzes.questions.options.destroy',
                                                    [
                                                        $quiz,
                                                        $question,
                                                        $option
                                                    ]
                                                ) }}"
                                                method="POST"
                                                onsubmit="return confirm(@json(__('education_admin.quiz_question_show.actions.confirm_delete_option')));"
                                            >

                                                @csrf

                                                @method('DELETE')


                                                <button
                                                    type="submit"
                                                    class="education-admin-table-action delete"
                                                    title="{{ __('education_admin.quiz_question_show.actions.delete_option') }}"
                                                >

                                                    <i class="fa-solid fa-trash"></i>

                                                </button>

                                            </form>

                                        </div>

                                    </div>

                                @endforeach

                            </div>


                            {{-- OPTION COUNT --}}

                            <div class="education-admin-question-options-footer">

                                <span>

                                    <i class="fa-solid fa-list-check"></i>

                                    {{ __('education_admin.quiz_question_show.options.total') }}:

                                    <strong>
                                        {{ $question->options->count() }}
                                    </strong>

                                </span>


                                @if($question->options->where('is_correct', true)->count())

                                    <span class="correct-count">

                                        <i class="fa-solid fa-circle-check"></i>

                                        {{ __('education_admin.quiz_question_show.options.correct_selected') }}

                                    </span>

                                @else

                                    <span class="warning-count">

                                        <i class="fa-solid fa-triangle-exclamation"></i>

                                        {{ __('education_admin.quiz_question_show.options.no_correct_selected') }}

                                    </span>

                                @endif

                            </div>

                        @else

                            {{-- EMPTY OPTIONS --}}

                            <div class="education-admin-content-view-empty">

                                <div class="education-admin-content-empty-icon">

                                    <i class="fa-solid fa-list-check"></i>

                                </div>


                                <strong>
                                    {{ __('education_admin.quiz_question_show.empty_options.title') }}
                                </strong>


                                <span>
                                    {{ __('education_admin.quiz_question_show.empty_options.description') }}
                                </span>


                                <a
                                    href="{{ route(
                                        'education.admin.quizzes.questions.options.create',
                                        [$quiz, $question]
                                    ) }}"
                                    class="education-admin-content-submit-button"
                                >

                                    <i class="fa-solid fa-plus"></i>

                                    {{ __('education_admin.quiz_question_show.actions.add_first_option') }}

                                </a>

                            </div>

                        @endif

                    </div>

                </div>

            @endif



            {{-- =================================================
                TEXT ANSWER
            ================================================== --}}

            @if($question->type === 'text')

                <div class="education-admin-content-form-card">

                    <div class="education-admin-content-form-card-header">

                        <div class="education-admin-content-form-card-icon gold">

                            <i class="fa-solid fa-align-right"></i>

                        </div>


                        <div>

                            <span>
                                {{ __('education_admin.quiz_question_show.text_answer.section_label') }}
                            </span>

                            <h3>
                                {{ __('education_admin.quiz_question_show.text_answer.title') }}
                            </h3>

                        </div>

                    </div>


                    <div class="education-admin-content-form-body">

                        <div class="education-admin-content-view-empty">

                            <div class="education-admin-content-empty-icon">

                                <i class="fa-solid fa-keyboard"></i>

                            </div>


                            <strong>
                                {{ __('education_admin.quiz_question_show.text_answer.title') }}
                            </strong>


                            <span>
                                {{ __('education_admin.quiz_question_show.text_answer.description') }}
                            </span>

                        </div>

                    </div>

                </div>

            @endif



            {{-- =================================================
                QUESTION SETTINGS
            ================================================== --}}

            <div class="education-admin-content-form-card">

                <div class="education-admin-content-form-card-header">

                    <div class="education-admin-content-form-card-icon green">

                        <i class="fa-solid fa-sliders"></i>

                    </div>


                    <div>

                        <span>
                            {{ __('education_admin.quiz_question_show.settings.section_label') }}
                        </span>

                        <h3>
                            {{ __('education_admin.quiz_question_show.settings.title') }}
                        </h3>

                    </div>

                </div>


                <div class="education-admin-content-form-body">

                    <div class="education-admin-content-settings-grid">


                        {{-- POINTS --}}

                        <div class="education-admin-content-field">

                            <label>
                                {{ __('education_admin.quiz_question_show.settings.points') }}
                            </label>


                            <div class="education-admin-content-view-value">

                                <i class="fa-solid fa-star"></i>

                                {{ $question->points }}

                                {{ $question->points == 1
                                    ? __('education_admin.quiz_question_show.settings.point')
                                    : __('education_admin.quiz_question_show.settings.points')
                                }}

                            </div>

                        </div>



                        {{-- SORT ORDER --}}

                        <div class="education-admin-content-field">

                            <label>
                                {{ __('education_admin.quiz_question_show.settings.sort_order') }}
                            </label>


                            <div class="education-admin-content-view-value">

                                <i class="fa-solid fa-arrow-down-1-9"></i>

                                {{ $question->sort_order }}

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        {{-- =====================================================
            SIDEBAR
        ====================================================== --}}

        <aside class="education-admin-content-form-sidebar">


            {{-- =================================================
                QUESTION TYPE
            ================================================== --}}

            <div class="education-admin-content-form-card">

                <div class="education-admin-content-form-card-header">

                    <div class="education-admin-content-form-card-icon gold">

                        <i class="fa-solid fa-list-check"></i>

                    </div>


                    <div>

                        <span>
                            {{ __('education_admin.quiz_question_show.question_type.section_label') }}
                        </span>

                        <h3>
                            {{ __('education_admin.quiz_question_show.question_type.title') }}
                        </h3>

                    </div>

                </div>


                <div class="education-admin-content-type-summary">

                    <div class="education-admin-content-type-summary-icon">

                        @switch($question->type)

                            @case('multiple_choice')

                                <i class="fa-solid fa-list-ul"></i>

                                @break

                            @case('true_false')

                                <i class="fa-solid fa-check-double"></i>

                                @break

                            @case('text')

                                <i class="fa-solid fa-align-right"></i>

                                @break

                            @default

                                <i class="fa-solid fa-question"></i>

                        @endswitch

                    </div>


                    <strong>

                        @switch($question->type)

                            @case('multiple_choice')
                                {{ __('education_admin.quiz_question_show.question_type.multiple_choice') }}
                                @break

                            @case('true_false')
                                {{ __('education_admin.quiz_question_show.question_type.true_false') }}
                                @break

                            @case('text')
                                {{ __('education_admin.quiz_question_show.question_type.text') }}
                                @break

                            @default
                                {{ __('education_admin.quiz_question_show.question_type.unknown') }}

                        @endswitch

                    </strong>

                </div>

            </div>



            {{-- =================================================
                QUIZ INFORMATION
            ================================================== --}}

            <div class="education-admin-content-form-card">

                <div class="education-admin-content-form-card-header">

                    <div class="education-admin-content-form-card-icon">

                        <i class="fa-solid fa-clipboard-list"></i>

                    </div>


                    <div>

                        <span>
                            {{ __('education_admin.quiz_question_show.quiz.section_label') }}
                        </span>

                        <h3>
                            {{ __('education_admin.quiz_question_show.quiz.title') }}
                        </h3>

                    </div>

                </div>


                <div class="education-admin-quiz-summary">

                    <div class="education-admin-quiz-summary-icon">

                        <i class="fa-solid fa-clipboard-question"></i>

                    </div>


                    <strong>
                        {{ $quiz->title }}
                    </strong>


                    @if($quiz->lesson)

                        <span>

                            <i class="fa-solid fa-book-open"></i>

                            {{ $quiz->lesson->title }}

                        </span>

                    @endif

                </div>

            </div>



            {{-- =================================================
                QUESTION STATISTICS
            ================================================== --}}

            <div class="education-admin-content-form-card">

                <div class="education-admin-content-form-card-header">

                    <div class="education-admin-content-form-card-icon gold">

                        <i class="fa-solid fa-chart-simple"></i>

                    </div>


                    <div>

                        <span>
                            {{ __('education_admin.quiz_question_show.statistics.section_label') }}
                        </span>

                        <h3>
                            {{ __('education_admin.quiz_question_show.statistics.title') }}
                        </h3>

                    </div>

                </div>


                <div class="education-admin-quiz-info-list">


                    {{-- POINTS --}}

                    <div class="education-admin-quiz-info-item">

                        <div>

                            <i class="fa-solid fa-star"></i>

                            <span>
                                {{ __('education_admin.quiz_question_show.statistics.points') }}
                            </span>

                        </div>


                        <strong>
                            {{ $question->points }}
                        </strong>

                    </div>



                    {{-- OPTIONS --}}

                    @if(
                        $question->type === 'multiple_choice' ||
                        $question->type === 'true_false'
                    )

                        <div class="education-admin-quiz-info-item">

                            <div>

                                <i class="fa-solid fa-list-check"></i>

                                <span>
                                    {{ __('education_admin.quiz_question_show.statistics.options_count') }}
                                </span>

                            </div>


                            <strong>
                                {{ $question->options->count() }}
                            </strong>

                        </div>


                        <div class="education-admin-quiz-info-item">

                            <div>

                                <i class="fa-solid fa-circle-check"></i>

                                <span>
                                    {{ __('education_admin.quiz_question_show.statistics.correct_answers') }}
                                </span>

                            </div>


                            <strong>
                                {{ $question->options->where('is_correct', true)->count() }}
                            </strong>

                        </div>

                    @endif



                    {{-- SORT ORDER --}}

                    <div class="education-admin-quiz-info-item">

                        <div>

                            <i class="fa-solid fa-arrow-down-1-9"></i>

                            <span>
                                {{ __('education_admin.quiz_question_show.statistics.sort_order') }}
                            </span>

                        </div>


                        <strong>
                            {{ $question->sort_order }}
                        </strong>

                    </div>

                </div>

            </div>



            {{-- =================================================
                QUESTION STATUS
            ================================================== --}}

            <div class="education-admin-content-form-card">

                <div class="education-admin-content-form-card-header">

                    <div class="education-admin-content-form-card-icon green">

                        <i class="fa-solid fa-toggle-on"></i>

                    </div>


                    <div>

                        <span>
                            {{ __('education_admin.quiz_question_show.status.section_label') }}
                        </span>

                        <h3>
                            {{ __('education_admin.quiz_question_show.status.title') }}
                        </h3>

                    </div>

                </div>


                <div class="education-admin-content-form-body">

                    <div class="education-admin-content-status-display">

                        @if($question->is_active)

                            <span class="education-admin-content-status active">

                                <i class="fa-solid fa-circle-check"></i>

                                {{ __('education_admin.quiz_question_show.status.active_question') }}

                            </span>

                        @else

                            <span class="education-admin-content-status inactive">

                                <i class="fa-solid fa-circle-xmark"></i>

                                {{ __('education_admin.quiz_question_show.status.inactive_question') }}

                            </span>

                        @endif

                    </div>

                </div>

            </div>



            {{-- =================================================
                OPTIONS MANAGEMENT
            ================================================== --}}

            @if(
                $question->type === 'multiple_choice' ||
                $question->type === 'true_false'
            )

                <div class="education-admin-content-form-card">

                    <div class="education-admin-content-form-card-header">

                        <div class="education-admin-content-form-card-icon gold">

                            <i class="fa-solid fa-list-check"></i>

                        </div>


                        <div>

                            <span>
                                {{ __('education_admin.quiz_question_show.options_management.section_label') }}
                            </span>

                            <h3>
                                {{ __('education_admin.quiz_question_show.options_management.title') }}
                            </h3>

                        </div>

                    </div>


                    <div class="education-admin-content-form-body">

                        <div class="education-admin-content-form-actions">


                            {{-- OPTIONS INDEX --}}

                            <a
                                href="{{ route(
                                    'education.admin.quizzes.questions.options.index',
                                    [$quiz, $question]
                                ) }}"
                                class="education-admin-content-submit-button"
                            >

                                <i class="fa-solid fa-list"></i>

                                {{ __('education_admin.quiz_question_show.actions.manage_options') }}

                            </a>


                            {{-- ADD OPTION --}}

                            <a
                                href="{{ route(
                                    'education.admin.quizzes.questions.options.create',
                                    [$quiz, $question]
                                ) }}"
                                class="education-admin-content-cancel-button"
                            >

                                <i class="fa-solid fa-plus"></i>

                                {{ __('education_admin.quiz_question_show.actions.add_option') }}

                            </a>

                        </div>

                    </div>

                </div>

            @endif



            {{-- =================================================
                ACTIONS
            ================================================== --}}

            <div class="education-admin-content-form-card">

                <div class="education-admin-content-form-card-header">

                    <div class="education-admin-content-form-card-icon green">

                        <i class="fa-solid fa-gears"></i>

                    </div>


                    <div>

                        <span>
                            {{ __('education_admin.quiz_question_show.actions_section.section_label') }}
                        </span>

                        <h3>
                            {{ __('education_admin.quiz_question_show.actions_section.title') }}
                        </h3>

                    </div>

                </div>


                <div class="education-admin-content-form-actions">


                    {{-- EDIT --}}

                    <a
                        href="{{ route(
                            'education.admin.quizzes.questions.edit',
                            [$quiz, $question]
                        ) }}"
                        class="education-admin-content-submit-button"
                    >

                        <i class="fa-solid fa-pen-to-square"></i>

                        {{ __('education_admin.quiz_question_show.actions.edit') }}

                    </a>



                    {{-- BACK --}}

                    <a
                        href="{{ route(
                            'education.admin.quizzes.questions.index',
                            $quiz
                        ) }}"
                        class="education-admin-content-cancel-button"
                    >

                        <i class="fa-solid fa-arrow-right"></i>

                        {{ __('education_admin.quiz_question_show.actions.back') }}

                    </a>

                </div>

            </div>



            {{-- =================================================
                DELETE
            ================================================== --}}

            <div class="education-admin-content-delete-card">

                <div class="education-admin-content-delete-icon">

                    <i class="fa-solid fa-trash"></i>

                </div>


                <div>

                    <strong>
                        {{ __('education_admin.quiz_question_show.delete.title') }}
                    </strong>


                    <p>
                        {{ __('education_admin.quiz_question_show.delete.description') }}
                    </p>

                </div>


                <form
                    action="{{ route(
                        'education.admin.quizzes.questions.destroy',
                        [$quiz, $question]
                    ) }}"
                    method="POST"
                    onsubmit="return confirm(@json(__('education_admin.quiz_question_show.delete.confirm')));"
                >

                    @csrf

                    @method('DELETE')


                    <button
                        type="submit"
                        class="education-admin-content-delete-button"
                    >

                        <i class="fa-solid fa-trash"></i>

                        {{ __('education_admin.quiz_question_show.delete.button') }}

                    </button>

                </form>

            </div>



            {{-- =================================================
                NOTE
            ================================================== --}}

            <div class="education-admin-content-note">

                <div class="education-admin-content-note-icon">

                    <i class="fa-solid fa-lightbulb"></i>

                </div>


                <div>

                    <strong>
                        {{ __('education_admin.quiz_question_show.note.title') }}
                    </strong>


                    <p>

                        {{ __('education_admin.quiz_question_show.note.description') }}

                    </p>

                </div>

            </div>

        </aside>

    </div>

</div>

@endsection
