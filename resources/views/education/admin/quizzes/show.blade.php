@extends('education.admin.layouts.app')

@section('title', __('education_admin.quiz_show.page_title'))

@section('content')

@php

$questions = $quiz->questions ?? collect();

$questionCount = $questions->count();

$totalPoints = $questions->sum(function ($question) {
    return (int) ($question->points ?? 0);
});

$passPercentage = $quiz->pass_percentage !== null
    ? (int) $quiz->pass_percentage
    : null;

$maxAttempts = $quiz->max_attempts !== null
    ? (int) $quiz->max_attempts
    : null;

$timeLimit = $quiz->time_limit !== null
    ? (int) $quiz->time_limit
    : null;

@endphp

<div class="education-admin-content-page">

{{-- =========================================================
    PAGE HEADER
========================================================== --}}

<div class="education-admin-content-header">

    <div class="education-admin-content-heading">

        <span class="education-admin-page-header-label">

            <i class="fa-solid fa-graduation-cap"></i>

            {{ __('education_admin.quiz_show.header_label') }}

        </span>


        <div class="education-admin-content-title-row">

            <div class="education-admin-content-title-icon">

                <i class="fa-solid fa-file-circle-question"></i>

            </div>


            <div>

                <h2>
                    {{ $quiz->title }}
                </h2>


                <span class="education-admin-content-lesson-name">

                    <i class="fa-solid fa-book-open"></i>

                    @if($quiz->lesson)

                        {{ $quiz->lesson->title }}

                    @else

                        {{ __('education_admin.quiz_show.educational_quiz') }}

                    @endif

                </span>

            </div>

        </div>


        <p>
            {{ __('education_admin.quiz_show.description') }}
        </p>

    </div>


    {{-- =====================================================
        HEADER ACTIONS
    ====================================================== --}}

    <div class="education-admin-content-header-actions">

        <a
            href="{{ route('education.admin.quizzes.index') }}"
            class="education-admin-content-cancel-button"
            style="color:#204d40"
        >

            <i
                class="fa-solid fa-arrow-right"
                style="color:#204d40"
            ></i>

            {{ __('education_admin.quiz_show.actions.back') }}

        </a>


        <a
            href="{{ route('education.admin.quizzes.edit', $quiz) }}"
            class="education-admin-content-submit-button"
        >

            <i class="fa-solid fa-pen"></i>

            {{ __('education_admin.quiz_show.actions.edit') }}

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
                {{ __('education_admin.quiz_show.alerts.success_title') }}
            </strong>

            <p>
                {{ session('success') }}
            </p>

        </div>

    </div>

@endif



{{-- =========================================================
    MAIN GRID
========================================================== --}}

<div class="education-admin-content-form-grid">


    {{-- =====================================================
        MAIN COLUMN
    ====================================================== --}}

    <div class="education-admin-content-form-main">


        {{-- =================================================
            QUIZ OVERVIEW
        ================================================== --}}

        <div class="education-admin-content-form-card">

            <div class="education-admin-content-form-card-header">

                <div class="education-admin-content-form-card-icon">

                    <i class="fa-solid fa-circle-info"></i>

                </div>


                <div>

                    <span>
                        {{ __('education_admin.quiz_show.overview.section_label') }}
                    </span>

                    <h3>
                        {{ __('education_admin.quiz_show.overview.title') }}
                    </h3>

                </div>

            </div>


            <div class="education-admin-content-form-body">


                {{-- TITLE --}}

                <div class="education-admin-content-field">

                    <label>
                        {{ __('education_admin.quiz_show.fields.title') }}
                    </label>


                    <div class="education-admin-content-display-box">

                        <i class="fa-solid fa-heading"></i>

                        <span>
                            {{ $quiz->title }}
                        </span>

                    </div>

                </div>



                {{-- DESCRIPTION --}}

                <div class="education-admin-content-field">

                    <label>
                        {{ __('education_admin.quiz_show.fields.description') }}
                    </label>


                    @if(filled($quiz->description))

                        <div class="education-admin-content-description-box">

                            {{ $quiz->description }}

                        </div>

                    @else

                        <div class="education-admin-content-empty-value">

                            <i class="fa-regular fa-file-lines"></i>

                            {{ __('education_admin.quiz_show.fields.no_description') }}

                        </div>

                    @endif

                </div>

            </div>

        </div>



        {{-- =================================================
            QUESTIONS
        ================================================== --}}

        <div class="education-admin-content-form-card">

            <div class="education-admin-content-form-card-header">

                <div class="education-admin-content-form-card-icon gold">

                    <i class="fa-solid fa-list-check"></i>

                </div>


                <div>

                    <span>
                        {{ __('education_admin.quiz_show.questions.section_label') }}
                    </span>

                    <h3>
                        {{ __('education_admin.quiz_show.questions.title') }}
                    </h3>

                </div>


                <div style="margin-right:auto;">

                    <a
                        href="{{ route(
                            'education.admin.quizzes.questions.create',
                            $quiz
                        ) }}"
                        class="education-admin-content-small-action"
                    >

                        <i class="fa-solid fa-plus"></i>

                        {{ __('education_admin.quiz_show.questions.add') }}

                    </a>

                </div>

            </div>


            <div class="education-admin-content-form-body">

                @if($questionCount > 0)

                    <div class="education-admin-question-list">

                        @foreach($questions as $question)

                            @php

                                $options = $question->options ?? collect();

                                $questionPoints = (int) ($question->points ?? 0);

                            @endphp


                            <div class="education-admin-question-item">


                                {{-- QUESTION NUMBER --}}

                                <div class="education-admin-question-number">

                                    {{ $loop->iteration }}

                                </div>



                                {{-- QUESTION CONTENT --}}

                                <div class="education-admin-question-content">

                                    <div class="education-admin-question-top">

                                        <strong>

                                            {{ $question->question }}

                                        </strong>


                                        @if($question->is_active)

                                            <span class="education-admin-status-badge active">

                                                <i class="fa-solid fa-circle-check"></i>

                                                {{ __('education_admin.quiz_show.status.active') }}

                                            </span>

                                        @else

                                            <span class="education-admin-status-badge inactive">

                                                <i class="fa-solid fa-circle-xmark"></i>

                                                {{ __('education_admin.quiz_show.status.inactive') }}

                                            </span>

                                        @endif

                                    </div>


                                    <div class="education-admin-question-meta">


                                        {{-- TYPE --}}

                                        <span>

                                            <i class="fa-solid fa-list-ul"></i>

                                            @switch($question->type)

                                                @case('multiple_choice')

                                                    {{ __('education_admin.quiz_show.question_types.multiple_choice') }}

                                                    @break

                                                @case('true_false')

                                                    {{ __('education_admin.quiz_show.question_types.true_false') }}

                                                    @break

                                                @case('text')

                                                    {{ __('education_admin.quiz_show.question_types.text') }}

                                                    @break

                                                @default

                                                    {{ $question->type ?: __('education_admin.quiz_show.question_types.unspecified') }}

                                            @endswitch

                                        </span>



                                        {{-- POINTS --}}

                                        <span>

                                            <i class="fa-solid fa-star"></i>

                                            {{ $questionPoints }}

                                            @if($questionPoints == 1)

                                                {{ __('education_admin.quiz_show.points.single') }}

                                            @else

                                                {{ __('education_admin.quiz_show.points.multiple') }}

                                            @endif

                                        </span>



                                        {{-- OPTIONS --}}

                                        @if($options->count())

                                            <span>

                                                <i class="fa-solid fa-list"></i>

                                                {{ $options->count() }}

                                                {{ __('education_admin.quiz_show.options') }}

                                            </span>

                                        @endif

                                    </div>

                                </div>



                                {{-- ACTIONS --}}

                                <div class="education-admin-question-actions">

                                    <a
                                        href="{{ route(
                                            'education.admin.quizzes.questions.show',
                                            [
                                                $quiz,
                                                $question
                                            ]
                                        ) }}"
                                        class="education-admin-table-action view"
                                        title="{{ __('education_admin.quiz_show.question_actions.view') }}"
                                    >

                                        <i class="fa-solid fa-eye"></i>

                                    </a>


                                    <a
                                        href="{{ route(
                                            'education.admin.quizzes.questions.edit',
                                            [
                                                $quiz,
                                                $question
                                            ]
                                        ) }}"
                                        class="education-admin-table-action edit"
                                        title="{{ __('education_admin.quiz_show.question_actions.edit') }}"
                                    >

                                        <i class="fa-solid fa-pen"></i>

                                    </a>

                                </div>

                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="education-admin-content-table-empty">

                        <div>

                            <i class="fa-solid fa-circle-question"></i>

                            <strong>
                                {{ __('education_admin.quiz_show.questions.empty_title') }}
                            </strong>

                            <span>
                                {{ __('education_admin.quiz_show.questions.empty_description') }}
                            </span>


                            <a
                                href="{{ route(
                                    'education.admin.quizzes.questions.create',
                                    $quiz
                                ) }}"
                                class="education-admin-content-submit-button"
                            >

                                <i class="fa-solid fa-plus"></i>

                                {{ __('education_admin.quiz_show.questions.add_first') }}

                            </a>

                        </div>

                    </div>

                @endif

            </div>

        </div>



        {{-- =================================================
            EXPLANATIONS
        ================================================== --}}

        @if(
            $questions->contains(function ($question) {
                return filled($question->explanation);
            })
        )

            <div class="education-admin-content-form-card">

                <div class="education-admin-content-form-card-header">

                    <div class="education-admin-content-form-card-icon green">

                        <i class="fa-solid fa-lightbulb"></i>

                    </div>


                    <div>

                        <span>
                            {{ __('education_admin.quiz_show.explanations.section_label') }}
                        </span>

                        <h3>
                            {{ __('education_admin.quiz_show.explanations.title') }}
                        </h3>

                    </div>

                </div>


                <div class="education-admin-content-form-body">

                    <div class="education-admin-explanation-list">

                        @foreach($questions as $question)

                            @if(filled($question->explanation))

                                <div class="education-admin-explanation-item">

                                    <div class="education-admin-explanation-number">

                                        {{ $loop->iteration }}

                                    </div>


                                    <div>

                                        <strong>
                                            {{ $question->question }}
                                        </strong>

                                        <p>
                                            {{ $question->explanation }}
                                        </p>

                                    </div>

                                </div>

                            @endif

                        @endforeach

                    </div>

                </div>

            </div>

        @endif

    </div>



    {{-- =====================================================
        SIDEBAR
    ====================================================== --}}

    <aside class="education-admin-content-form-sidebar">


        {{-- =================================================
            QUIZ SUMMARY
        ================================================== --}}

        <div class="education-admin-content-form-card">

            <div class="education-admin-content-form-card-header">

                <div class="education-admin-content-form-card-icon gold">

                    <i class="fa-solid fa-clipboard-question"></i>

                </div>


                <div>

                    <span>
                        {{ __('education_admin.quiz_show.summary.section_label') }}
                    </span>

                    <h3>
                        {{ __('education_admin.quiz_show.summary.title') }}
                    </h3>

                </div>

            </div>


            <div class="education-admin-quiz-summary">

                <div class="education-admin-quiz-summary-icon">

                    <i class="fa-solid fa-file-circle-question"></i>

                </div>


                <strong>
                    {{ $quiz->title }}
                </strong>


                @if($quiz->lesson)

                    <span>

                        <i class="fa-solid fa-book-open"></i>

                        {{ $quiz->lesson->title }}

                    </span>

                @else

                    <span>

                        <i class="fa-solid fa-book-open"></i>

                        {{ __('education_admin.quiz_show.educational_quiz') }}

                    </span>

                @endif

            </div>

        </div>



        {{-- =================================================
            QUIZ STATISTICS
        ================================================== --}}

        <div class="education-admin-content-form-card">

            <div class="education-admin-content-form-card-header">

                <div class="education-admin-content-form-card-icon">

                    <i class="fa-solid fa-chart-simple"></i>

                </div>


                <div>

                    <span>
                        {{ __('education_admin.quiz_show.statistics.section_label') }}
                    </span>

                    <h3>
                        {{ __('education_admin.quiz_show.statistics.title') }}
                    </h3>

                </div>

            </div>


            <div class="education-admin-quiz-info-list">


                {{-- QUESTIONS --}}

                <div class="education-admin-quiz-info-item">

                    <div>

                        <i class="fa-solid fa-circle-question"></i>

                        <span>
                            {{ __('education_admin.quiz_show.statistics.questions') }}
                        </span>

                    </div>


                    <strong>
                        {{ $questionCount }}
                    </strong>

                </div>



                {{-- TOTAL POINTS --}}

                <div class="education-admin-quiz-info-item">

                    <div>

                        <i class="fa-solid fa-star"></i>

                        <span>
                            {{ __('education_admin.quiz_show.statistics.total_points') }}
                        </span>

                    </div>


                    <strong>
                        {{ $totalPoints }}
                    </strong>

                </div>



                {{-- PASS PERCENTAGE --}}

                <div class="education-admin-quiz-info-item">

                    <div>

                        <i class="fa-solid fa-percent"></i>

                        <span>
                            {{ __('education_admin.quiz_show.statistics.pass_percentage') }}
                        </span>

                    </div>


                    <strong>

                        @if($passPercentage !== null)

                            {{ $passPercentage }}%

                        @else

                            {{ __('education_admin.quiz_show.statistics.not_specified_feminine') }}

                        @endif

                    </strong>

                </div>



                {{-- MAX ATTEMPTS --}}

                <div class="education-admin-quiz-info-item">

                    <div>

                        <i class="fa-solid fa-repeat"></i>

                        <span>
                            {{ __('education_admin.quiz_show.statistics.max_attempts') }}
                        </span>

                    </div>


                    <strong>

                        @if($maxAttempts !== null && $maxAttempts > 0)

                            {{ $maxAttempts }}

                        @else

                            {{ __('education_admin.quiz_show.statistics.not_specified_feminine') }}

                        @endif

                    </strong>

                </div>



                {{-- TIME --}}

                <div class="education-admin-quiz-info-item">

                    <div>

                        <i class="fa-solid fa-clock"></i>

                        <span>
                            {{ __('education_admin.quiz_show.statistics.time') }}
                        </span>

                    </div>


                    <strong>

                        @if($timeLimit !== null && $timeLimit > 0)

                            {{ $timeLimit }}
                            {{ __('education_admin.quiz_show.statistics.minutes') }}

                        @else

                            {{ __('education_admin.quiz_show.statistics.not_specified') }}

                        @endif

                    </strong>

                </div>

            </div>

        </div>



        {{-- =================================================
            STATUS
        ================================================== --}}

        <div class="education-admin-content-form-card">

            <div class="education-admin-content-form-card-header">

                <div class="education-admin-content-form-card-icon">

                    <i class="fa-solid fa-toggle-on"></i>

                </div>


                <div>

                    <span>
                        {{ __('education_admin.quiz_show.status_section.section_label') }}
                    </span>

                    <h3>
                        {{ __('education_admin.quiz_show.status_section.title') }}
                    </h3>

                </div>

            </div>


            <div class="education-admin-content-form-body">

                @if($quiz->is_active)

                    <div class="education-admin-content-status-box active">

                        <i class="fa-solid fa-circle-check"></i>

                        <div>

                            <strong>
                                {{ __('education_admin.quiz_show.status_section.active_title') }}
                            </strong>

                            <small>
                                {{ __('education_admin.quiz_show.status_section.active_description') }}
                            </small>

                        </div>

                    </div>

                @else

                    <div class="education-admin-content-status-box inactive">

                        <i class="fa-solid fa-circle-xmark"></i>

                        <div>

                            <strong>
                                {{ __('education_admin.quiz_show.status_section.inactive_title') }}
                            </strong>

                            <small>
                                {{ __('education_admin.quiz_show.status_section.inactive_description') }}
                            </small>

                        </div>

                    </div>

                @endif

            </div>

        </div>



        {{-- =================================================
            QUICK ACTIONS
        ================================================== --}}

        <div class="education-admin-content-form-card">

            <div class="education-admin-content-form-card-header">

                <div class="education-admin-content-form-card-icon green">

                    <i class="fa-solid fa-bolt"></i>

                </div>


                <div>

                    <span>
                        {{ __('education_admin.quiz_show.quick_actions.section_label') }}
                    </span>

                    <h3>
                        {{ __('education_admin.quiz_show.quick_actions.title') }}
                    </h3>

                </div>

            </div>


            <div class="education-admin-content-form-body">

                <div class="education-admin-quick-actions">


                    <a
                        href="{{ route(
                            'education.admin.quizzes.questions.index',
                            $quiz
                        ) }}"
                        class="education-admin-quick-action"
                    >

                        <span>

                            <i class="fa-solid fa-list-check"></i>

                            {{ __('education_admin.quiz_show.quick_actions.manage_questions') }}

                        </span>

                        <i class="fa-solid fa-chevron-left"></i>

                    </a>


                    <a
                        href="{{ route(
                            'education.admin.quizzes.questions.create',
                            $quiz
                        ) }}"
                        class="education-admin-quick-action"
                    >

                        <span>

                            <i class="fa-solid fa-circle-plus"></i>

                            {{ __('education_admin.quiz_show.quick_actions.add_question') }}

                        </span>

                        <i class="fa-solid fa-chevron-left"></i>

                    </a>


                    <a
                        href="{{ route(
                            'education.admin.quizzes.edit',
                            $quiz
                        ) }}"
                        class="education-admin-quick-action"
                    >

                        <span>

                            <i class="fa-solid fa-pen"></i>

                            {{ __('education_admin.quiz_show.quick_actions.edit_quiz') }}

                        </span>

                        <i class="fa-solid fa-chevron-left"></i>

                    </a>

                </div>

            </div>

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
                    {{ __('education_admin.quiz_show.note.title') }}
                </strong>

                <p>
                    {{ __('education_admin.quiz_show.note.description') }}
                </p>

            </div>

        </div>

    </aside>

</div>

</div>

@endsection
