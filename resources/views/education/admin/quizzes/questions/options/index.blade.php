@extends('education.admin.layouts.app')

@section('title', __('education_admin.quiz_options.page_title'))

@section('content')

<div class="education-admin-content-create-page">

    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}

    <div class="education-admin-content-create-header">

        <div class="education-admin-content-create-heading">

            <span class="education-admin-page-header-label">

                <i class="fa-solid fa-list-check"></i>

                {{ __('education_admin.quiz_options.header_label') }}

            </span>


            <div class="education-admin-content-title-row">

                <div class="education-admin-content-title-icon">

                    <i class="fa-solid fa-list-ul"></i>

                </div>


                <div>

                    <h2>
                        {{ __('education_admin.quiz_options.title') }}
                    </h2>


                    <span class="education-admin-content-lesson-name">

                        <i class="fa-solid fa-clipboard-question"></i>

                        {{ $quiz->title }}

                    </span>

                </div>

            </div>


            <p>
                {{ __('education_admin.quiz_options.description') }}
            </p>

        </div>


        {{-- =====================================================
            HEADER ACTIONS
        ====================================================== --}}

        <div class="education-admin-content-header-actions">

            {{-- BACK TO QUESTION --}}

            <a
                href="{{ route(
                    'education.admin.quizzes.questions.show',
                    [$quiz, $question]
                ) }}"
                class="education-admin-content-back-button"
            >

                <i class="fa-solid fa-arrow-right"></i>

                {{ __('education_admin.quiz_options.actions.back') }}

            </a>


            {{-- ADD OPTION --}}

            @if($question->type !== 'text')

                <a
                    href="{{ route(
                        'education.admin.quizzes.questions.options.create',
                        [$quiz, $question]
                    ) }}"
                    class="education-admin-content-submit-button"
                >

                    <i class="fa-solid fa-plus"></i>

                    {{ __('education_admin.quiz_options.actions.add') }}

                </a>

            @endif

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
                    {{ __('education_admin.quiz_options.alerts.success_title') }}
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
                    {{ __('education_admin.quiz_options.alerts.error_title') }}
                </strong>

                <p>
                    {{ session('error') }}
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
                QUESTION CARD
            ================================================== --}}

            <div class="education-admin-content-form-card">

                <div class="education-admin-content-form-card-header">

                    <div class="education-admin-content-form-card-icon">

                        <i class="fa-solid fa-circle-question"></i>

                    </div>


                    <div>

                        <span>
                            {{ __('education_admin.quiz_options.question.section_label') }}
                        </span>

                        <h3>
                            {{ __('education_admin.quiz_options.question.title') }}
                        </h3>

                    </div>

                </div>


                <div class="education-admin-content-form-body">

                    <div class="education-admin-question-preview">

                        <div class="education-admin-question-preview-number">

                            <i class="fa-solid fa-question"></i>

                        </div>


                        <div class="education-admin-question-preview-content">

                            <strong>
                                {{ $question->question }}
                            </strong>


                            <div class="education-admin-question-preview-meta">

                                @switch($question->type)

                                    @case('multiple_choice')

                                        <span>

                                            <i class="fa-solid fa-list-ul"></i>

                                            {{ __('education_admin.quiz_options.question.types.multiple_choice') }}

                                        </span>

                                        @break


                                    @case('true_false')

                                        <span>

                                            <i class="fa-solid fa-check-double"></i>

                                            {{ __('education_admin.quiz_options.question.types.true_false') }}

                                        </span>

                                        @break


                                    @case('text')

                                        <span>

                                            <i class="fa-solid fa-align-right"></i>

                                            {{ __('education_admin.quiz_options.question.types.text') }}

                                        </span>

                                        @break

                                @endswitch


                                <span>

                                    <i class="fa-solid fa-star"></i>

                                    {{ $question->points }}

                                    {{ $question->points == 1
                                        ? __('education_admin.quiz_options.question.point')
                                        : __('education_admin.quiz_options.question.points')
                                    }}

                                </span>

                            </div>


                            @if($question->explanation)

                                <span>

                                    <i class="fa-solid fa-circle-info"></i>

                                    {{ __('education_admin.quiz_options.question.has_explanation') }}

                                </span>

                            @endif

                        </div>

                    </div>

                </div>

            </div>



            {{-- =================================================
                OPTIONS CARD
            ================================================== --}}

            <div class="education-admin-content-form-card">

                <div class="education-admin-content-form-card-header">

                    <div class="education-admin-content-form-card-icon gold">

                        <i class="fa-solid fa-list-check"></i>

                    </div>


                    <div>

                        <span>
                            {{ __('education_admin.quiz_options.options.section_label') }}
                        </span>

                        <h3>
                            {{ __('education_admin.quiz_options.options.title') }}
                        </h3>

                    </div>


                    @if($question->type !== 'text')

                        <div class="education-admin-content-form-card-header-badge">

                            <i class="fa-solid fa-list"></i>

                            {{ $options->total() }}

                            {{ __('education_admin.quiz_options.options.count') }}

                        </div>

                    @endif

                </div>


                <div class="education-admin-content-form-body">


                    {{-- =================================================
                        TEXT QUESTION
                    ================================================== --}}

                    @if($question->type === 'text')

                        <div class="education-admin-content-view-empty">

                            <div class="education-admin-content-view-empty-icon">

                                <i class="fa-solid fa-align-right"></i>

                            </div>


                            <strong>
                                {{ __('education_admin.quiz_options.text_question.title') }}
                            </strong>


                            <span>
                                {{ __('education_admin.quiz_options.text_question.description') }}
                            </span>

                        </div>



                    {{-- =================================================
                        OPTIONS EXIST
                    ================================================== --}}

                    @elseif($options->count())

                        <div class="education-admin-options-list">

                            @foreach($options as $index => $option)

                                <div
                                    class="
                                        education-admin-option-item
                                        {{ $option->is_correct ? 'correct' : '' }}
                                        {{ !$option->is_active ? 'inactive' : '' }}
                                    "
                                >


                                    {{-- =================================
                                        NUMBER
                                    ================================== --}}

                                    <div class="education-admin-option-number">

                                        {{ $options->firstItem() + $index }}

                                    </div>



                                    {{-- =================================
                                        ICON
                                    ================================== --}}

                                    <div class="education-admin-option-icon">

                                        @if($option->is_correct)

                                            <i class="fa-solid fa-circle-check"></i>

                                        @else

                                            <i class="fa-solid fa-circle"></i>

                                        @endif

                                    </div>



                                    {{-- =================================
                                        CONTENT
                                    ================================== --}}

                                    <div class="education-admin-option-content">

                                        <strong>
                                            {{ $option->option }}
                                        </strong>


                                        <div class="education-admin-option-meta">


                                            {{-- CORRECT --}}

                                            @if($option->is_correct)

                                                <span class="correct">

                                                    <i class="fa-solid fa-check"></i>

                                                    {{ __('education_admin.quiz_options.option.correct') }}

                                                </span>

                                            @else

                                                <span>

                                                    <i class="fa-solid fa-xmark"></i>

                                                    {{ __('education_admin.quiz_options.option.incorrect') }}

                                                </span>

                                            @endif



                                            {{-- SORT ORDER --}}

                                            <span>

                                                <i class="fa-solid fa-arrow-down-1-9"></i>

                                                {{ __('education_admin.quiz_options.option.order') }}

                                                {{ $option->sort_order }}

                                            </span>



                                            {{-- STATUS --}}

                                            @if($option->is_active)

                                                <span class="active">

                                                    <i class="fa-solid fa-circle-check"></i>

                                                    {{ __('education_admin.quiz_options.option.active') }}

                                                </span>

                                            @else

                                                <span class="inactive">

                                                    <i class="fa-solid fa-circle-xmark"></i>

                                                    {{ __('education_admin.quiz_options.option.inactive') }}

                                                </span>

                                            @endif

                                        </div>

                                    </div>



                                    {{-- =================================
                                        ACTIONS
                                    ================================== --}}

                                    <div class="education-admin-option-actions">


                                        {{-- SHOW --}}

                                        <a
                                            href="{{ route(
                                                'education.admin.quizzes.questions.options.show',
                                                [$quiz, $question, $option]
                                            ) }}"
                                            class="education-admin-option-action view"
                                            title="{{ __('education_admin.quiz_options.actions.view_option') }}"
                                        >

                                            <i class="fa-regular fa-eye"></i>

                                        </a>



                                        {{-- EDIT --}}

                                        <a
                                            href="{{ route(
                                                'education.admin.quizzes.questions.options.edit',
                                                [$quiz, $question, $option]
                                            ) }}"
                                            class="education-admin-option-action edit"
                                            title="{{ __('education_admin.quiz_options.actions.edit_option') }}"
                                        >

                                            <i class="fa-solid fa-pen"></i>

                                        </a>



                                        {{-- DELETE --}}

                                        <form
                                            action="{{ route(
                                                'education.admin.quizzes.questions.options.destroy',
                                                [$quiz, $question, $option]
                                            ) }}"
                                            method="POST"
                                            onsubmit="return confirm(@json(__('education_admin.quiz_options.delete.confirm')));"
                                        >

                                            @csrf

                                            @method('DELETE')


                                            <button
                                                type="submit"
                                                class="education-admin-option-action delete"
                                                title="{{ __('education_admin.quiz_options.actions.delete_option') }}"
                                            >

                                                <i class="fa-solid fa-trash"></i>

                                            </button>

                                        </form>

                                    </div>

                                </div>

                            @endforeach

                        </div>



                        {{-- =================================================
                            PAGINATION
                        ================================================== --}}

                        @if($options->hasPages())

                            <div class="education-admin-content-pagination">

                                {{ $options->links() }}

                            </div>

                        @endif



                    {{-- =================================================
                        EMPTY STATE
                    ================================================== --}}

                    @else

                        <div class="education-admin-content-view-empty">

                            <div class="education-admin-content-view-empty-icon">

                                <i class="fa-solid fa-list"></i>

                            </div>


                            <strong>
                                {{ __('education_admin.quiz_options.empty.title') }}
                            </strong>


                            <span>
                                {{ __('education_admin.quiz_options.empty.description') }}
                            </span>


                            @if($question->type !== 'text')

                                <a
                                    href="{{ route(
                                        'education.admin.quizzes.questions.options.create',
                                        [$quiz, $question]
                                    ) }}"
                                    class="education-admin-content-submit-button"
                                >

                                    <i class="fa-solid fa-plus"></i>

                                    {{ __('education_admin.quiz_options.empty.add_first') }}

                                </a>

                            @endif

                        </div>

                    @endif

                </div>

            </div>



            {{-- =================================================
                QUESTION WARNING
            ================================================== --}}

            @if(
                $question->type !== 'text' &&
                $question->options->where('is_correct', true)->count() === 0
            )

                <div class="education-admin-content-alert warning">

                    <div class="education-admin-content-alert-icon">

                        <i class="fa-solid fa-triangle-exclamation"></i>

                    </div>


                    <div>

                        <strong>
                            {{ __('education_admin.quiz_options.warning.title') }}
                        </strong>


                        <p>
                            {{ __('education_admin.quiz_options.warning.description') }}
                        </p>

                    </div>

                </div>

            @endif

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

                        <i class="fa-solid fa-layer-group"></i>

                    </div>


                    <div>

                        <span>
                            {{ __('education_admin.quiz_options.type.section_label') }}
                        </span>

                        <h3>
                            {{ __('education_admin.quiz_options.type.title') }}
                        </h3>

                    </div>

                </div>


                <div class="education-admin-question-type-summary">

                    @switch($question->type)

                        @case('multiple_choice')

                            <div class="education-admin-question-type-summary-icon">

                                <i class="fa-solid fa-list-ul"></i>

                            </div>


                            <strong>
                                {{ __('education_admin.quiz_options.type.multiple_choice.title') }}
                            </strong>


                            <span>
                                {{ __('education_admin.quiz_options.type.multiple_choice.description') }}
                            </span>

                            @break


                        @case('true_false')

                            <div class="education-admin-question-type-summary-icon green">

                                <i class="fa-solid fa-check-double"></i>

                            </div>


                            <strong>
                                {{ __('education_admin.quiz_options.type.true_false.title') }}
                            </strong>


                            <span>
                                {{ __('education_admin.quiz_options.type.true_false.description') }}
                            </span>

                            @break


                        @case('text')

                            <div class="education-admin-question-type-summary-icon gold">

                                <i class="fa-solid fa-align-right"></i>

                            </div>


                            <strong>
                                {{ __('education_admin.quiz_options.type.text.title') }}
                            </strong>


                            <span>
                                {{ __('education_admin.quiz_options.type.text.description') }}
                            </span>

                            @break

                    @endswitch

                </div>

            </div>



            {{-- =================================================
                QUESTION INFORMATION
            ================================================== --}}

            <div class="education-admin-content-form-card">

                <div class="education-admin-content-form-card-header">

                    <div class="education-admin-content-form-card-icon green">

                        <i class="fa-solid fa-chart-simple"></i>

                    </div>


                    <div>

                        <span>
                            {{ __('education_admin.quiz_options.info.section_label') }}
                        </span>

                        <h3>
                            {{ __('education_admin.quiz_options.info.title') }}
                        </h3>

                    </div>

                </div>


                <div class="education-admin-quiz-info-list">


                    {{-- POINTS --}}

                    <div class="education-admin-quiz-info-item">

                        <div>

                            <i class="fa-solid fa-star"></i>

                            <span>
                                {{ __('education_admin.quiz_options.info.points') }}
                            </span>

                        </div>


                        <strong>
                            {{ $question->points }}
                        </strong>

                    </div>



                    {{-- SORT ORDER --}}

                    <div class="education-admin-quiz-info-item">

                        <div>

                            <i class="fa-solid fa-arrow-down-1-9"></i>

                            <span>
                                {{ __('education_admin.quiz_options.info.sort_order') }}
                            </span>

                        </div>


                        <strong>
                            {{ $question->sort_order }}
                        </strong>

                    </div>



                    {{-- OPTIONS COUNT --}}

                    <div class="education-admin-quiz-info-item">

                        <div>

                            <i class="fa-solid fa-list"></i>

                            <span>
                                {{ __('education_admin.quiz_options.info.options_count') }}
                            </span>

                        </div>


                        <strong>
                            {{ $question->options->count() }}
                        </strong>

                    </div>



                    {{-- CORRECT COUNT --}}

                    @if($question->type !== 'text')

                        <div class="education-admin-quiz-info-item">

                            <div>

                                <i class="fa-solid fa-circle-check"></i>

                                <span>
                                    {{ __('education_admin.quiz_options.info.correct_count') }}
                                </span>

                            </div>


                            <strong>
                                {{ $question->options->where('is_correct', true)->count() }}
                            </strong>

                        </div>

                    @endif

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
                            {{ __('education_admin.quiz_options.status.section_label') }}
                        </span>

                        <h3>
                            {{ __('education_admin.quiz_options.status.title') }}
                        </h3>

                    </div>

                </div>


                <div class="education-admin-content-form-body">

                    @if($question->is_active)

                        <div class="education-admin-content-status-display">

                            <span class="education-admin-content-status active">

                                <i class="fa-solid fa-circle-check"></i>

                                {{ __('education_admin.quiz_options.status.active') }}

                            </span>

                        </div>

                    @else

                        <div class="education-admin-content-status-display">

                            <span class="education-admin-content-status inactive">

                                <i class="fa-solid fa-circle-xmark"></i>

                                {{ __('education_admin.quiz_options.status.inactive') }}

                            </span>

                        </div>

                    @endif

                </div>

            </div>



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
                            {{ __('education_admin.quiz_options.management.section_label') }}
                        </span>

                        <h3>
                            {{ __('education_admin.quiz_options.management.title') }}
                        </h3>

                    </div>

                </div>


                <div class="education-admin-content-form-actions">

                    <a
                        href="{{ route(
                            'education.admin.quizzes.questions.show',
                            [$quiz, $question]
                        ) }}"
                        class="education-admin-content-cancel-button"
                    >

                        <i class="fa-solid fa-question"></i>

                        {{ __('education_admin.quiz_options.management.view_question') }}

                    </a>


                    @if($question->type !== 'text')

                        <a
                            href="{{ route(
                                'education.admin.quizzes.questions.options.create',
                                [$quiz, $question]
                            ) }}"
                            class="education-admin-content-submit-button"
                        >

                            <i class="fa-solid fa-plus"></i>

                            {{ __('education_admin.quiz_options.management.add_option') }}

                        </a>

                    @endif


                    <a
                        href="{{ route(
                            'education.admin.quizzes.questions.edit',
                            [$quiz, $question]
                        ) }}"
                        class="education-admin-content-cancel-button"
                    >

                        <i class="fa-solid fa-pen"></i>

                        {{ __('education_admin.quiz_options.management.edit_question') }}

                    </a>

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
                        {{ __('education_admin.quiz_options.note.title') }}
                    </strong>


                    <p>

                        {{ __('education_admin.quiz_options.note.description') }}

                    </p>

                </div>

            </div>

        </aside>

    </div>

</div>

@endsection
