@extends('education.admin.layouts.app')

@section('title', __('education_admin.quiz_attempts.page_title'))

@section('content')

<div class="education-admin-content-page">

    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}

    <div class="education-admin-content-header">

        <div class="education-admin-content-heading">

            <span class="education-admin-page-header-label">

                <i class="fa-solid fa-chart-line"></i>

                {{ __('education_admin.quiz_attempts.header_label') }}

            </span>


            <div class="education-admin-content-title-row">

                <div class="education-admin-content-title-icon">

                    <i class="fa-solid fa-file-circle-check"></i>

                </div>


                <div>

                    <h2>
                        {{ __('education_admin.quiz_attempts.title') }}
                    </h2>

                    <span class="education-admin-content-lesson-name">

                        <i class="fa-solid fa-users"></i>

                        {{ __('education_admin.quiz_attempts.subtitle') }}

                    </span>

                </div>

            </div>


            <p>
                {{ __('education_admin.quiz_attempts.description') }}
            </p>

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
                    {{ __('education_admin.quiz_attempts.alerts.success_title') }}
                </strong>

                <p>
                    {{ session('success') }}
                </p>

            </div>

        </div>

    @endif



    {{-- =========================================================
        STATISTICS
    ========================================================== --}}

    <div class="education-admin-stats-grid">


        {{-- TOTAL --}}

        <div class="education-admin-stat-card">

            <div class="education-admin-stat-icon">

                <i class="fa-solid fa-layer-group"></i>

            </div>


            <div class="education-admin-stat-content">

                <span>
                    {{ __('education_admin.quiz_attempts.statistics.total') }}
                </span>

                <strong>
                    {{ $attempts->total() }}
                </strong>

            </div>

        </div>



        {{-- PASSED --}}

        <div class="education-admin-stat-card">

            <div class="education-admin-stat-icon green">

                <i class="fa-solid fa-circle-check"></i>

            </div>


            <div class="education-admin-stat-content">

                <span>
                    {{ __('education_admin.quiz_attempts.statistics.passed') }}
                </span>

                <strong>

                    {{ \App\Models\EducationQuizAttempt::where('passed', true)->count() }}

                </strong>

            </div>

        </div>



        {{-- FAILED --}}

        <div class="education-admin-stat-card">

            <div class="education-admin-stat-icon gold">

                <i class="fa-solid fa-circle-xmark"></i>

            </div>


            <div class="education-admin-stat-content">

                <span>
                    {{ __('education_admin.quiz_attempts.statistics.failed') }}
                </span>

                <strong>

                    {{ \App\Models\EducationQuizAttempt::where('passed', false)->count() }}

                </strong>

            </div>

        </div>



        {{-- COMPLETED --}}

        <div class="education-admin-stat-card">

            <div class="education-admin-stat-icon">

                <i class="fa-solid fa-flag-checkered"></i>

            </div>


            <div class="education-admin-stat-content">

                <span>
                    {{ __('education_admin.quiz_attempts.statistics.completed') }}
                </span>

                <strong>

                    {{ \App\Models\EducationQuizAttempt::where('status', 'completed')->count() }}

                </strong>

            </div>

        </div>

    </div>



    {{-- =========================================================
        FILTERS
    ========================================================== --}}

    <div class="education-admin-content-form-card">

        <div class="education-admin-content-form-card-header">

            <div class="education-admin-content-form-card-icon">

                <i class="fa-solid fa-filter"></i>

            </div>


            <div>

                <span>
                    {{ __('education_admin.quiz_attempts.filters.header_label') }}
                </span>

                <h3>
                    {{ __('education_admin.quiz_attempts.filters.title') }}
                </h3>

            </div>

        </div>


        <div class="education-admin-content-form-body">

            <form
                action="{{ route('education.admin.quiz-attempts.index') }}"
                method="GET"
                class="education-admin-attempts-filter-form"
            >

                {{-- SEARCH --}}

                <div class="education-admin-attempts-search">

                    <div class="education-admin-content-input-icon-wrapper">

                        <i class="fa-solid fa-magnifying-glass"></i>

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            class="education-admin-content-input"
                            placeholder="{{ __('education_admin.quiz_attempts.filters.search_placeholder') }}"
                        >

                    </div>

                </div>



                {{-- STATUS --}}

                <div class="education-admin-attempts-filter">

                    <select
                        name="status"
                        class="education-admin-content-input"
                    >

                        <option value="">
                            {{ __('education_admin.quiz_attempts.filters.all_statuses') }}
                        </option>

                        <option
                            value="completed"
                            {{ request('status') === 'completed' ? 'selected' : '' }}
                        >
                            {{ __('education_admin.quiz_attempts.status.completed') }}
                        </option>

                        <option
                            value="in_progress"
                            {{ request('status') === 'in_progress' ? 'selected' : '' }}
                        >
                            {{ __('education_admin.quiz_attempts.status.in_progress') }}
                        </option>

                        <option
                            value="cancelled"
                            {{ request('status') === 'cancelled' ? 'selected' : '' }}
                        >
                            {{ __('education_admin.quiz_attempts.status.cancelled') }}
                        </option>

                    </select>

                </div>



                {{-- PASSED --}}

                <div class="education-admin-attempts-filter">

                    <select
                        name="passed"
                        class="education-admin-content-input"
                    >

                        <option value="">
                            {{ __('education_admin.quiz_attempts.filters.all_results') }}
                        </option>

                        <option
                            value="1"
                            {{ request('passed') === '1' ? 'selected' : '' }}
                        >
                            {{ __('education_admin.quiz_attempts.results.passed') }}
                        </option>

                        <option
                            value="0"
                            {{ request('passed') === '0' ? 'selected' : '' }}
                        >
                            {{ __('education_admin.quiz_attempts.results.failed') }}
                        </option>

                    </select>

                </div>



                {{-- BUTTON --}}

                <button
                    type="submit"
                    class="education-admin-content-submit-button"
                >

                    <i class="fa-solid fa-filter"></i>

                    {{ __('education_admin.quiz_attempts.filters.apply') }}

                </button>



                {{-- RESET --}}

                @if(request()->hasAny(['search', 'status', 'passed']))

                    <a
                        href="{{ route('education.admin.quiz-attempts.index') }}"
                        class="education-admin-content-cancel-button"
                    >

                        <i class="fa-solid fa-rotate-left"></i>

                        {{ __('education_admin.quiz_attempts.filters.reset') }}

                    </a>

                @endif

            </form>

        </div>

    </div>



    {{-- =========================================================
        ATTEMPTS TABLE
    ========================================================== --}}

    <div class="education-admin-content-form-card">

        <div class="education-admin-content-form-card-header">

            <div class="education-admin-content-form-card-icon gold">

                <i class="fa-solid fa-list-check"></i>

            </div>


            <div>

                <span>
                    {{ __('education_admin.quiz_attempts.table.header_label') }}
                </span>

                <h3>
                    {{ __('education_admin.quiz_attempts.table.title') }}
                </h3>

            </div>

        </div>


        <div class="education-admin-content-table-wrapper">

            @if($attempts->count())

                <table class="education-admin-content-table">

                    <thead>

                        <tr>

                            <th>
                                {{ __('education_admin.quiz_attempts.table.student') }}
                            </th>

                            <th>
                                {{ __('education_admin.quiz_attempts.table.quiz') }}
                            </th>

                            <th>
                                {{ __('education_admin.quiz_attempts.table.attempt') }}
                            </th>

                            <th>
                                {{ __('education_admin.quiz_attempts.table.score') }}
                            </th>

                            <th>
                                {{ __('education_admin.quiz_attempts.table.percentage') }}
                            </th>

                            <th>
                                {{ __('education_admin.quiz_attempts.table.status') }}
                            </th>

                            <th>
                                {{ __('education_admin.quiz_attempts.table.started_at') }}
                            </th>

                            <th>
                                {{ __('education_admin.quiz_attempts.table.actions') }}
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($attempts as $attempt)

                            <tr>


                                {{-- STUDENT --}}

                                <td>

                                    <div class="education-admin-attempt-student">

                                        <div class="education-admin-attempt-student-avatar">

                                            <i class="fa-solid fa-user"></i>

                                        </div>


                                        <div>

                                            <strong>

                                                {{ $attempt->student?->name ?? __('education_admin.quiz_attempts.fallback.unknown_student') }}

                                            </strong>


                                            @if($attempt->student?->email)

                                                <span>

                                                    {{ $attempt->student->email }}

                                                </span>

                                            @endif

                                        </div>

                                    </div>

                                </td>



                                {{-- QUIZ --}}

                                <td>

                                    <div class="education-admin-attempt-quiz">

                                        <i class="fa-solid fa-clipboard-question"></i>


                                        <div>

                                            <strong>

                                                {{ $attempt->quiz?->title ?? __('education_admin.quiz_attempts.fallback.deleted_quiz') }}

                                            </strong>


                                            @if($attempt->quiz?->lesson)

                                                <span>

                                                    {{ $attempt->quiz->lesson->title }}

                                                </span>

                                            @endif

                                        </div>

                                    </div>

                                </td>



                                {{-- ATTEMPT NUMBER --}}

                                <td>

                                    <span class="education-admin-attempt-number">

                                        <i class="fa-solid fa-hashtag"></i>

                                        {{ $attempt->attempt_number }}

                                    </span>

                                </td>



                                {{-- SCORE --}}

                                <td>

                                    <div class="education-admin-attempt-score">

                                        <strong>

                                            {{ $attempt->score }}

                                        </strong>

                                        <span>

                                            / {{ $attempt->total_points }}

                                        </span>

                                    </div>

                                </td>



                                {{-- PERCENTAGE --}}

                                <td>

                                    <div class="education-admin-attempt-percentage">

                                        <strong>

                                            {{ number_format((float) $attempt->percentage, 2) }}%

                                        </strong>

                                    </div>

                                </td>



                                {{-- STATUS --}}

                                <td>

                                    @if($attempt->status === 'completed')

                                        <span class="education-admin-status-badge success">

                                            <i class="fa-solid fa-circle-check"></i>

                                            {{ __('education_admin.quiz_attempts.status.completed') }}

                                        </span>

                                    @elseif($attempt->status === 'in_progress')

                                        <span class="education-admin-status-badge warning">

                                            <i class="fa-solid fa-spinner"></i>

                                            {{ __('education_admin.quiz_attempts.status.in_progress') }}

                                        </span>

                                    @elseif($attempt->status === 'cancelled')

                                        <span class="education-admin-status-badge danger">

                                            <i class="fa-solid fa-ban"></i>

                                            {{ __('education_admin.quiz_attempts.status.cancelled') }}

                                        </span>

                                    @else

                                        <span class="education-admin-status-badge">

                                            {{ $attempt->status }}

                                        </span>

                                    @endif

                                </td>



                                {{-- DATE --}}

                                <td>

                                    <div class="education-admin-attempt-date">

                                        @if($attempt->started_at)

                                            <strong>

                                                {{ $attempt->started_at->format('Y/m/d') }}

                                            </strong>

                                            <span>

                                                {{ $attempt->started_at->format('h:i A') }}

                                            </span>

                                        @else

                                            <span>
                                                —
                                            </span>

                                        @endif

                                    </div>

                                </td>



                                {{-- ACTIONS --}}

                                <td>

                                    <div class="education-admin-table-actions">

                                        <a
                                            href="{{ route(
                                                'education.admin.quiz-attempts.show',
                                                $attempt
                                            ) }}"
                                            class="education-admin-table-action-button view"
                                            title="{{ __('education_admin.quiz_attempts.actions.view_result') }}"
                                        >

                                            <i class="fa-solid fa-eye"></i>

                                        </a>

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>


            @else


                {{-- EMPTY STATE --}}

                <div class="education-admin-content-empty-state">

                    <div class="education-admin-content-empty-icon">

                        <i class="fa-solid fa-file-circle-xmark"></i>

                    </div>


                    <h3>
                        {{ __('education_admin.quiz_attempts.empty.title') }}
                    </h3>


                    <p>

                        {{ __('education_admin.quiz_attempts.empty.description') }}

                    </p>

                    @if(request()->hasAny(['search', 'status', 'passed']))

                        <a
                            href="{{ route('education.admin.quiz-attempts.index') }}"
                            class="education-admin-content-submit-button"
                        >

                            <i class="fa-solid fa-rotate-left"></i>

                            {{ __('education_admin.quiz_attempts.empty.show_all') }}

                        </a>

                    @endif

                </div>

            @endif

        </div>



        {{-- =====================================================
            PAGINATION
        ====================================================== --}}

        @if($attempts->hasPages())

            <div class="education-admin-content-pagination">

                {{ $attempts->links() }}

            </div>

        @endif

    </div>

</div>

@endsection
