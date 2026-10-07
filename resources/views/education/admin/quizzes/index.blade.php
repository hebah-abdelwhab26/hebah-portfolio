@extends('education.admin.layouts.app')

@section('title', __('education_admin.quizzes.page_title'))

@section('content')

<div class="education-admin-quizzes-page">

    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}

    <div class="education-admin-quizzes-header">

        <div class="education-admin-quizzes-heading">

            <span class="education-admin-page-header-label">

                <i class="fa-solid fa-graduation-cap"></i>

                {{ __('education_admin.quizzes.header_label') }}

            </span>


            <div class="education-admin-quizzes-title-row">

                <div class="education-admin-quizzes-title-icon">

                    <i class="fa-solid fa-clipboard-question"></i>

                </div>


                <div>

                    <h2>
                        {{ __('education_admin.quizzes.title') }}
                    </h2>

                    <span class="education-admin-quizzes-subtitle">

                        <i class="fa-solid fa-chart-simple"></i>

                        {{ __('education_admin.quizzes.subtitle') }}

                    </span>

                </div>

            </div>


            <p>
                {{ __('education_admin.quizzes.description') }}
            </p>

        </div>


        {{-- HEADER ACTIONS --}}

        <div class="education-admin-quizzes-header-actions">

            <a
                href="{{ route('education.admin.quizzes.create') }}"
                class="education-admin-quizzes-primary-button"
            >

                <i class="fa-solid fa-plus"></i>

                <span>
                    {{ __('education_admin.quizzes.actions.new') }}
                </span>

            </a>

        </div>

    </div>



    {{-- =========================================================
        SUCCESS MESSAGE
    ========================================================== --}}

    @if(session('success'))

        <div class="education-admin-quizzes-alert success">

            <div class="education-admin-quizzes-alert-icon">

                <i class="fa-solid fa-circle-check"></i>

            </div>


            <div>

                <strong>
                    {{ __('education_admin.quizzes.alerts.success_title') }}
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

        <div class="education-admin-quizzes-alert error">

            <div class="education-admin-quizzes-alert-icon">

                <i class="fa-solid fa-triangle-exclamation"></i>

            </div>


            <div>

                <strong>
                    {{ __('education_admin.quizzes.alerts.error_title') }}
                </strong>

                <p>
                    {{ session('error') }}
                </p>

            </div>

        </div>

    @endif



    {{-- =========================================================
        OVERVIEW CARDS
    ========================================================== --}}

    <div class="education-admin-quizzes-overview">

        {{-- TOTAL --}}

        <div class="education-admin-quizzes-overview-card">

            <div class="education-admin-quizzes-overview-top">

                <div class="education-admin-quizzes-overview-icon">

                    <i class="fa-solid fa-clipboard-list"></i>

                </div>

                <span class="education-admin-quizzes-overview-label">
                    {{ __('education_admin.quizzes.overview.total') }}
                </span>

            </div>


            <strong class="education-admin-quizzes-overview-number">

                {{ $quizzes->total() }}

            </strong>


            <span class="education-admin-quizzes-overview-description">

                {{ __('education_admin.quizzes.overview.total_description') }}

            </span>

        </div>



        {{-- ACTIVE --}}

        <div class="education-admin-quizzes-overview-card green">

            <div class="education-admin-quizzes-overview-top">

                <div class="education-admin-quizzes-overview-icon">

                    <i class="fa-solid fa-circle-check"></i>

                </div>

                <span class="education-admin-quizzes-overview-label">
                    {{ __('education_admin.quizzes.overview.active') }}
                </span>

            </div>


            <strong class="education-admin-quizzes-overview-number">

                {{ $activeQuizzesCount ?? 0 }}

            </strong>


            <span class="education-admin-quizzes-overview-description">

                {{ __('education_admin.quizzes.overview.active_description') }}

            </span>

        </div>



        {{-- QUESTIONS --}}

        <div class="education-admin-quizzes-overview-card gold">

            <div class="education-admin-quizzes-overview-top">

                <div class="education-admin-quizzes-overview-icon">

                    <i class="fa-solid fa-circle-question"></i>

                </div>

                <span class="education-admin-quizzes-overview-label">
                    {{ __('education_admin.quizzes.overview.questions') }}
                </span>

            </div>


            <strong class="education-admin-quizzes-overview-number">

                {{ $questionsCount ?? 0 }}

            </strong>


            <span class="education-admin-quizzes-overview-description">

                {{ __('education_admin.quizzes.overview.questions_description') }}

            </span>

        </div>



        {{-- CURRENT PAGE --}}

        <div class="education-admin-quizzes-overview-card">

            <div class="education-admin-quizzes-overview-top">

                <div class="education-admin-quizzes-overview-icon">

                    <i class="fa-solid fa-layer-group"></i>

                </div>

                <span class="education-admin-quizzes-overview-label">
                    {{ __('education_admin.quizzes.overview.current_page') }}
                </span>

            </div>


            <strong class="education-admin-quizzes-overview-number">

                {{ $quizzes->currentPage() }}

            </strong>


            <span class="education-admin-quizzes-overview-description">

                {{ __('education_admin.quizzes.overview.of') }}
                {{ $quizzes->lastPage() }}

            </span>

        </div>

    </div>



    {{-- =========================================================
        FILTER PANEL
    ========================================================== --}}

    <div class="education-admin-quizzes-filter-card">

        <div class="education-admin-quizzes-filter-header">

            <div class="education-admin-quizzes-filter-title">

                <div class="education-admin-quizzes-filter-icon">

                    <i class="fa-solid fa-sliders"></i>

                </div>


                <div>

                    <strong>
                        {{ __('education_admin.quizzes.filters.title') }}
                    </strong>

                    <span>
                        {{ __('education_admin.quizzes.filters.description') }}
                    </span>

                </div>

            </div>

        </div>


        <form
            action="{{ route('education.admin.quizzes.index') }}"
            method="GET"
            class="education-admin-quizzes-filter-form"
        >

            {{-- SEARCH --}}

            <div class="education-admin-quizzes-search">

                <i class="fa-solid fa-magnifying-glass"></i>

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="{{ __('education_admin.quizzes.filters.search_placeholder') }}"
                >

            </div>



            {{-- QUIZ TYPE --}}

            <div class="education-admin-quizzes-filter-select-wrapper">

                <i class="fa-solid fa-layer-group"></i>

                <select name="type">

                    <option value="">
                        {{ __('education_admin.quizzes.filters.all_types') }}
                    </option>

                    <option
                        value="general"
                        {{ request('type') === 'general' ? 'selected' : '' }}
                    >
                        {{ __('education_admin.quizzes.filters.general_quizzes') }}
                    </option>

                    <option
                        value="student"
                        {{ request('type') === 'student' ? 'selected' : '' }}
                    >
                        {{ __('education_admin.quizzes.filters.student_quizzes') }}
                    </option>

                </select>

            </div>



            {{-- LESSON --}}

            <div class="education-admin-quizzes-filter-select-wrapper">

                <i class="fa-solid fa-book-open"></i>

                <select name="lesson">

                    <option value="">
                        {{ __('education_admin.quizzes.filters.all_lessons') }}
                    </option>

                    @foreach($lessons as $lesson)

                        <option
                            value="{{ $lesson->id }}"
                            {{ request('lesson') == $lesson->id ? 'selected' : '' }}
                        >

                            {{ $lesson->title }}

                        </option>

                    @endforeach

                </select>

            </div>



            {{-- STATUS --}}

            <div class="education-admin-quizzes-filter-select-wrapper">

                <i class="fa-solid fa-toggle-on"></i>

                <select name="status">

                    <option value="">
                        {{ __('education_admin.quizzes.filters.all_statuses') }}
                    </option>

                    <option
                        value="active"
                        {{ request('status') === 'active' ? 'selected' : '' }}
                    >
                        {{ __('education_admin.quizzes.status.active') }}
                    </option>

                    <option
                        value="inactive"
                        {{ request('status') === 'inactive' ? 'selected' : '' }}
                    >
                        {{ __('education_admin.quizzes.status.inactive') }}
                    </option>

                </select>

            </div>



            {{-- SUBMIT --}}

            <button
                type="submit"
                class="education-admin-quizzes-filter-button"
            >

                <i class="fa-solid fa-filter"></i>

                {{ __('education_admin.quizzes.filters.apply') }}

            </button>



            {{-- RESET --}}

            @if(request()->hasAny([
                'search',
                'type',
                'lesson',
                'status'
            ]))

                <a
                    href="{{ route('education.admin.quizzes.index') }}"
                    class="education-admin-quizzes-reset-button"
                >

                    <i class="fa-solid fa-rotate-left"></i>

                    {{ __('education_admin.quizzes.filters.reset') }}

                </a>

            @endif

        </form>

    </div>



    {{-- =========================================================
        RESULTS HEADER
    ========================================================== --}}

    <div class="education-admin-quizzes-results-header">

        <div>

            <span>
                {{ __('education_admin.quizzes.results.header_label') }}
            </span>

            <h3>
                {{ __('education_admin.quizzes.results.title') }}
            </h3>

        </div>


        <div class="education-admin-quizzes-results-count">

            <i class="fa-solid fa-list"></i>

            <strong>
                {{ $quizzes->total() }}
            </strong>

            <span>
                {{ __('education_admin.quizzes.results.quiz_count') }}
            </span>

        </div>

    </div>



    {{-- =========================================================
        QUIZZES
    ========================================================== --}}

    @if($quizzes->count())

        <div class="education-admin-quizzes-list">

            @foreach($quizzes as $quiz)

                @php

                    $questionCount = isset($quiz->questions_count)
                        ? $quiz->questions_count
                        : (
                            $quiz->relationLoaded('questions')
                                ? $quiz->questions->count()
                                : 0
                        );

                @endphp


                <article class="education-admin-quiz-card">

                    {{-- =================================================
                        CARD MAIN
                    ================================================== --}}

                    <div class="education-admin-quiz-card-main">

                        <div class="education-admin-quiz-card-icon">

                            <i class="fa-solid fa-clipboard-question"></i>

                        </div>


                        <div class="education-admin-quiz-card-content">

                            {{-- TOP --}}

                            <div class="education-admin-quiz-card-top">

                                <h3>
                                    {{ $quiz->title }}
                                </h3>


                                {{-- STATUS --}}

                                @if($quiz->is_active)

                                    <span class="education-admin-quiz-status active">

                                        <i class="fa-solid fa-circle"></i>

                                        {{ __('education_admin.quizzes.status.active') }}

                                    </span>

                                @else

                                    <span class="education-admin-quiz-status inactive">

                                        <i class="fa-solid fa-circle"></i>

                                        {{ __('education_admin.quizzes.status.inactive') }}

                                    </span>

                                @endif

                            </div>



                            {{-- DESCRIPTION --}}

                            @if($quiz->description)

                                <p class="education-admin-quiz-description">

                                    {{ \Illuminate\Support\Str::limit(
                                        $quiz->description,
                                        120
                                    ) }}

                                </p>

                            @else

                                <p class="education-admin-quiz-description muted">

                                    {{ __('education_admin.quizzes.card.no_description') }}

                                </p>

                            @endif



                            {{-- =================================================
                                QUIZ TYPE
                            ================================================== --}}

                            <div class="education-admin-quiz-type-row">

                                @if($quiz->isGeneral())

                                    <span class="education-admin-quiz-type general">

                                        <i class="fa-solid fa-globe"></i>

                                        {{ __('education_admin.quizzes.types.general_lesson') }}

                                    </span>

                                @elseif($quiz->isForStudent())

                                    <span class="education-admin-quiz-type student">

                                        <i class="fa-solid fa-user-graduate"></i>

                                        {{ __('education_admin.quizzes.types.student') }}

                                    </span>

                                @else

                                    <span class="education-admin-quiz-type unknown">

                                        <i class="fa-solid fa-triangle-exclamation"></i>

                                        {{ __('education_admin.quizzes.types.unlinked') }}

                                    </span>

                                @endif

                            </div>



                            {{-- =================================================
                                GENERAL LESSON
                            ================================================== --}}

                            @if($quiz->isGeneral() && $quiz->lesson)

                                <div class="education-admin-quiz-related-box general">

                                    <div class="education-admin-quiz-related-icon">

                                        <i class="fa-solid fa-book-open"></i>

                                    </div>


                                    <div>

                                        <small>
                                            {{ __('education_admin.quizzes.related.general_lesson') }}
                                        </small>

                                        <strong>
                                            {{ $quiz->lesson->title }}
                                        </strong>

                                    </div>

                                </div>

                            @endif



                            {{-- =================================================
                                STUDENT LESSON
                            ================================================== --}}

                            @if($quiz->isForStudent() && $quiz->studentLesson)

                                <div class="education-admin-quiz-related-box student">

                                    <div class="education-admin-quiz-related-icon">

                                        <i class="fa-solid fa-user-graduate"></i>

                                    </div>


                                    <div>

                                        <small>
                                            {{ __('education_admin.quizzes.related.student_lesson') }}
                                        </small>

                                        <strong>
                                            {{ $quiz->studentLesson->title }}
                                        </strong>


                                        @if($quiz->studentLesson->student)

                                            <span>

                                                <i class="fa-solid fa-user"></i>

                                                {{ $quiz->studentLesson->student->name }}

                                            </span>

                                        @endif


                                        @if($quiz->studentLesson->session_number)

                                            <span>

                                                <i class="fa-solid fa-hashtag"></i>

                                                {{ __('education_admin.quizzes.related.session') }}
                                                {{ $quiz->studentLesson->session_number }}

                                            </span>

                                        @endif

                                    </div>

                                </div>

                            @endif



                            {{-- =================================================
                                META
                            ================================================== --}}

                            <div class="education-admin-quiz-meta">

                                {{-- QUESTIONS --}}

                                <span>

                                    <i class="fa-solid fa-circle-question"></i>

                                    {{ $questionCount }}

                                    {{ __('education_admin.quizzes.meta.question') }}

                                </span>



                                {{-- PASS --}}

                                <span>

                                    <i class="fa-solid fa-percent"></i>

                                    {{ __('education_admin.quizzes.meta.pass') }}

                                    {{ $quiz->pass_percentage }}%

                                </span>



                                {{-- ATTEMPTS --}}

                                <span>

                                    <i class="fa-solid fa-repeat"></i>

                                    @if($quiz->max_attempts)

                                        {{ $quiz->max_attempts }}

                                        {{ __('education_admin.quizzes.meta.attempts') }}

                                    @else

                                        {{ __('education_admin.quizzes.meta.unlimited') }}

                                    @endif

                                </span>



                                {{-- TIME --}}

                                <span>

                                    <i class="fa-regular fa-clock"></i>

                                    @if($quiz->time_limit)

                                        {{ $quiz->time_limit }}

                                        {{ __('education_admin.quizzes.meta.minutes') }}

                                    @else

                                        {{ __('education_admin.quizzes.meta.no_time_limit') }}

                                    @endif

                                </span>

                            </div>

                        </div>

                    </div>



                    {{-- =================================================
                        CARD SIDE
                    ================================================== --}}

                    <div class="education-admin-quiz-card-side">


                        {{-- QUESTIONS COUNT --}}

                        <div class="education-admin-quiz-questions-count">

                            <strong>
                                {{ $questionCount }}
                            </strong>

                            <span>
                                {{ __('education_admin.quizzes.meta.question') }}
                            </span>

                        </div>



                        {{-- ACTIONS --}}

                        <div class="education-admin-quiz-actions">


                            {{-- SHOW --}}

                            <a
                                href="{{ route(
                                    'education.admin.quizzes.show',
                                    $quiz
                                ) }}"
                                class="education-admin-quiz-action view"
                                title="{{ __('education_admin.quizzes.actions.view') }}"
                            >

                                <i class="fa-regular fa-eye"></i>

                            </a>



                            {{-- QUESTIONS --}}

                            <a
                                href="{{ route(
                                    'education.admin.quizzes.questions.index',
                                    $quiz
                                ) }}"
                                class="education-admin-quiz-action questions"
                                title="{{ __('education_admin.quizzes.actions.questions') }}"
                            >

                                <i class="fa-solid fa-circle-question"></i>

                            </a>



                            {{-- EDIT --}}

                            <a
                                href="{{ route(
                                    'education.admin.quizzes.edit',
                                    $quiz
                                ) }}"
                                class="education-admin-quiz-action edit"
                                title="{{ __('education_admin.quizzes.actions.edit') }}"
                            >

                                <i class="fa-solid fa-pen"></i>

                            </a>



                            {{-- DELETE --}}

                            <form
                                action="{{ route(
                                    'education.admin.quizzes.destroy',
                                    $quiz
                                ) }}"
                                method="POST"
                                onsubmit="return confirm(@json(__('education_admin.quizzes.actions.confirm_delete')));"
                            >

                                @csrf

                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="education-admin-quiz-action delete"
                                    title="{{ __('education_admin.quizzes.actions.delete') }}"
                                >

                                    <i class="fa-solid fa-trash"></i>

                                </button>

                            </form>

                        </div>

                    </div>

                </article>

            @endforeach

        </div>



        {{-- =========================================================
            PAGINATION
        ========================================================== --}}

        @if($quizzes->hasPages())

            <div class="education-admin-quizzes-pagination">

                {{ $quizzes->withQueryString()->links() }}

            </div>

        @endif

    @else

        {{-- =========================================================
            EMPTY STATE
        ========================================================== --}}

        <div class="education-admin-quizzes-empty">

            <div class="education-admin-quizzes-empty-icon">

                <i class="fa-solid fa-clipboard-question"></i>

            </div>


            <h3>
                {{ __('education_admin.quizzes.empty.title') }}
            </h3>


            <p>
                {{ __('education_admin.quizzes.empty.description') }}
            </p>


            <a
                href="{{ route('education.admin.quizzes.create') }}"
                class="education-admin-quizzes-primary-button"
            >

                <i class="fa-solid fa-plus"></i>

                {{ __('education_admin.quizzes.empty.create_first') }}

            </a>

        </div>

    @endif

</div>

@endsection
