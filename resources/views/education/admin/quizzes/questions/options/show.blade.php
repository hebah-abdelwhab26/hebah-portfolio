@extends('education.admin.layouts.app')

@section('title', __('education_admin.quiz_option_show.page_title'))

@section('content')

<div class="education-admin-content-create-page">

    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}

    <div class="education-admin-content-create-header">

        <div class="education-admin-content-create-heading">

            <span class="education-admin-page-header-label">

                <i class="fa-solid fa-list-check"></i>

                {{ __('education_admin.quiz_option_show.header_label') }}

            </span>


            <div class="education-admin-content-title-row">

                <div class="education-admin-content-title-icon">

                    <i class="fa-solid fa-eye"></i>

                </div>


                <div>

                    <h2>
                        {{ __('education_admin.quiz_option_show.title') }}
                    </h2>


                    <span class="education-admin-content-lesson-name">

                        <i class="fa-solid fa-clipboard-question"></i>

                        {{ $quiz->title }}

                    </span>

                </div>

            </div>


            <p>
                {{ __('education_admin.quiz_option_show.description') }}
            </p>

        </div>


        {{-- HEADER ACTIONS --}}

        <div class="education-admin-content-header-actions">

            <a
                href="{{ route(
                    'education.admin.quizzes.questions.options.index',
                    [$quiz, $question]
                ) }}"
                class="education-admin-content-back-button"
            >

                <i class="fa-solid fa-arrow-right"></i>

                {{ __('education_admin.quiz_option_show.actions.back') }}

            </a>


            <a
                href="{{ route(
                    'education.admin.quizzes.questions.options.edit',
                    [$quiz, $question, $option]
                ) }}"
                class="education-admin-content-submit-button"
            >

                <i class="fa-solid fa-pen"></i>

                {{ __('education_admin.quiz_option_show.actions.edit') }}

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
                    {{ __('education_admin.quiz_option_show.alerts.success_title') }}
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
                QUESTION CARD
            ================================================== --}}

            <div class="education-admin-content-form-card">

                <div class="education-admin-content-form-card-header">

                    <div class="education-admin-content-form-card-icon">

                        <i class="fa-solid fa-circle-question"></i>

                    </div>


                    <div>

                        <span>
                            {{ __('education_admin.quiz_option_show.question.section_label') }}
                        </span>

                        <h3>
                            {{ __('education_admin.quiz_option_show.question.heading') }}
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


                            @if($question->explanation)

                                <span>

                                    <i class="fa-solid fa-circle-info"></i>

                                    {{ __('education_admin.quiz_option_show.question.has_explanation') }}

                                </span>

                            @endif

                        </div>

                    </div>

                </div>

            </div>



            {{-- =================================================
                OPTION DETAILS
            ================================================== --}}

            <div class="education-admin-content-form-card">

                <div class="education-admin-content-form-card-header">

                    <div class="education-admin-content-form-card-icon gold">

                        <i class="fa-solid fa-list-check"></i>

                    </div>


                    <div>

                        <span>
                            {{ __('education_admin.quiz_option_show.option.section_label') }}
                        </span>

                        <h3>
                            {{ __('education_admin.quiz_option_show.option.heading') }}
                        </h3>

                    </div>

                </div>


                <div class="education-admin-content-form-body">


                    {{-- OPTION NUMBER --}}

                    <div class="education-admin-option-detail-number">

                        <span>
                            {{ __('education_admin.quiz_option_show.option.number') }}
                        </span>

                        <strong>
                            {{ $option->sort_order }}
                        </strong>

                    </div>



                    {{-- OPTION TEXT --}}

                    <div class="education-admin-option-detail-content">

                        <span class="education-admin-option-detail-label">

                            <i class="fa-solid fa-align-right"></i>

                            {{ __('education_admin.quiz_option_show.option.text_label') }}

                        </span>


                        <div class="education-admin-option-detail-text">

                            {{ $option->option }}

                        </div>

                    </div>



                    {{-- STATUS GRID --}}

                    <div class="education-admin-option-detail-grid">


                        {{-- CORRECT --}}

                        <div class="education-admin-option-detail-box">

                            <div class="education-admin-option-detail-box-icon">

                                @if($option->is_correct)

                                    <i class="fa-solid fa-circle-check"></i>

                                @else

                                    <i class="fa-solid fa-circle-xmark"></i>

                                @endif

                            </div>


                            <div>

                                <span>
                                    {{ __('education_admin.quiz_option_show.option.correct_status') }}
                                </span>


                                @if($option->is_correct)

                                    <strong class="correct">
                                        {{ __('education_admin.quiz_option_show.option.correct') }}
                                    </strong>

                                @else

                                    <strong>
                                        {{ __('education_admin.quiz_option_show.option.incorrect') }}
                                    </strong>

                                @endif

                            </div>

                        </div>



                        {{-- ACTIVE --}}

                        <div class="education-admin-option-detail-box">

                            <div class="education-admin-option-detail-box-icon">

                                @if($option->is_active)

                                    <i class="fa-solid fa-toggle-on"></i>

                                @else

                                    <i class="fa-solid fa-toggle-off"></i>

                                @endif

                            </div>


                            <div>

                                <span>
                                    {{ __('education_admin.quiz_option_show.option.status') }}
                                </span>


                                @if($option->is_active)

                                    <strong class="active">
                                        {{ __('education_admin.quiz_option_show.option.active') }}
                                    </strong>

                                @else

                                    <strong class="inactive">
                                        {{ __('education_admin.quiz_option_show.option.inactive') }}
                                    </strong>

                                @endif

                            </div>

                        </div>



                        {{-- SORT --}}

                        <div class="education-admin-option-detail-box">

                            <div class="education-admin-option-detail-box-icon">

                                <i class="fa-solid fa-arrow-down-1-9"></i>

                            </div>


                            <div>

                                <span>
                                    {{ __('education_admin.quiz_option_show.option.order') }}
                                </span>


                                <strong>
                                    {{ $option->sort_order }}
                                </strong>

                            </div>

                        </div>

                    </div>

                </div>

            </div>



            {{-- =================================================
                ANSWER STATUS
            ================================================== --}}

            <div class="education-admin-content-form-card">

                <div class="education-admin-content-form-card-header">

                    <div class="education-admin-content-form-card-icon green">

                        <i class="fa-solid fa-check-double"></i>

                    </div>


                    <div>

                        <span>
                            {{ __('education_admin.quiz_option_show.answer_status.section_label') }}
                        </span>

                        <h3>
                            {{ __('education_admin.quiz_option_show.answer_status.heading') }}
                        </h3>

                    </div>

                </div>


                <div class="education-admin-content-form-body">

                    @if($option->is_correct)

                        <div class="education-admin-content-status-display">

                            <span class="education-admin-content-status active">

                                <i class="fa-solid fa-circle-check"></i>

                                {{ __('education_admin.quiz_option_show.answer_status.correct') }}

                            </span>

                        </div>

                    @else

                        <div class="education-admin-content-status-display">

                            <span class="education-admin-content-status inactive">

                                <i class="fa-solid fa-circle-xmark"></i>

                                {{ __('education_admin.quiz_option_show.answer_status.incorrect') }}

                            </span>

                        </div>

                    @endif

                </div>

            </div>



            {{-- =================================================
                DELETE
            ================================================== --}}

            <div class="education-admin-content-form-card">

                <div class="education-admin-content-form-card-header">

                    <div class="education-admin-content-form-card-icon">

                        <i class="fa-solid fa-gears"></i>

                    </div>


                    <div>

                        <span>
                            {{ __('education_admin.quiz_option_show.management.section_label') }}
                        </span>

                        <h3>
                            {{ __('education_admin.quiz_option_show.management.heading') }}
                        </h3>

                    </div>

                </div>


                <div class="education-admin-content-form-actions">

                    <a
                        href="{{ route(
                            'education.admin.quizzes.questions.options.edit',
                            [$quiz, $question, $option]
                        ) }}"
                        class="education-admin-content-submit-button"
                    >

                        <i class="fa-solid fa-pen"></i>

                        {{ __('education_admin.quiz_option_show.actions.edit') }}

                    </a>


                    <form
                        action="{{ route(
                            'education.admin.quizzes.questions.options.destroy',
                            [$quiz, $question, $option]
                        ) }}"
                        method="POST"
                        onsubmit="return confirm(@json(__('education_admin.quiz_option_show.delete.confirm')));"
                    >

                        @csrf

                        @method('DELETE')


                        <button
                            type="submit"
                            class="education-admin-content-delete-button"
                        >

                            <i class="fa-solid fa-trash"></i>

                            {{ __('education_admin.quiz_option_show.actions.delete') }}

                        </button>

                    </form>

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

                        <i class="fa-solid fa-layer-group"></i>

                    </div>


                    <div>

                        <span>
                            {{ __('education_admin.quiz_option_show.question_type.section_label') }}
                        </span>

                        <h3>
                            {{ __('education_admin.quiz_option_show.question_type.heading') }}
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
                                {{ __('education_admin.quiz_option_show.question_type.multiple_choice.title') }}
                            </strong>


                            <span>
                                {{ __('education_admin.quiz_option_show.question_type.multiple_choice.description') }}
                            </span>

                            @break


                        @case('true_false')

                            <div class="education-admin-question-type-summary-icon green">

                                <i class="fa-solid fa-check-double"></i>

                            </div>


                            <strong>
                                {{ __('education_admin.quiz_option_show.question_type.true_false.title') }}
                            </strong>


                            <span>
                                {{ __('education_admin.quiz_option_show.question_type.true_false.description') }}
                            </span>

                            @break


                        @case('text')

                            <div class="education-admin-question-type-summary-icon gold">

                                <i class="fa-solid fa-align-right"></i>

                            </div>


                            <strong>
                                {{ __('education_admin.quiz_option_show.question_type.text.title') }}
                            </strong>


                            <span>
                                {{ __('education_admin.quiz_option_show.question_type.text.description') }}
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
                            {{ __('education_admin.quiz_option_show.question_info.section_label') }}
                        </span>

                        <h3>
                            {{ __('education_admin.quiz_option_show.question_info.heading') }}
                        </h3>

                    </div>

                </div>


                <div class="education-admin-quiz-info-list">


                    {{-- POINTS --}}

                    <div class="education-admin-quiz-info-item">

                        <div>

                            <i class="fa-solid fa-star"></i>

                            <span>
                                {{ __('education_admin.quiz_option_show.question_info.points') }}
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
                                {{ __('education_admin.quiz_option_show.question_info.sort_order') }}
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
                                {{ __('education_admin.quiz_option_show.question_info.options_count') }}
                            </span>

                        </div>


                        <strong>
                            {{ $question->options()->count() }}
                        </strong>

                    </div>

                </div>

            </div>



            {{-- =================================================
                QUESTION STATUS
            ================================================== --}}

            <div class="education-admin-content-form-card">

                <div class="education-admin-content-form-card-header">

                    <div class="education-admin-content-form-card-icon">

                        <i class="fa-solid fa-toggle-on"></i>

                    </div>


                    <div>

                        <span>
                            {{ __('education_admin.quiz_option_show.question_status.section_label') }}
                        </span>

                        <h3>
                            {{ __('education_admin.quiz_option_show.question_status.heading') }}
                        </h3>

                    </div>

                </div>


                <div class="education-admin-content-form-body">

                    @if($question->is_active)

                        <div class="education-admin-content-status-display">

                            <span class="education-admin-content-status active">

                                <i class="fa-solid fa-circle-check"></i>

                                {{ __('education_admin.quiz_option_show.question_status.active') }}

                            </span>

                        </div>

                    @else

                        <div class="education-admin-content-status-display">

                            <span class="education-admin-content-status inactive">

                                <i class="fa-solid fa-circle-xmark"></i>

                                {{ __('education_admin.quiz_option_show.question_status.inactive') }}

                            </span>

                        </div>

                    @endif

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
                        {{ __('education_admin.quiz_option_show.note.title') }}
                    </strong>


                    <p>

                        @if($question->type === 'true_false')

                            {{ __('education_admin.quiz_option_show.note.true_false') }}

                        @elseif($question->type === 'multiple_choice')

                            {{ __('education_admin.quiz_option_show.note.multiple_choice') }}

                        @else

                            {{ __('education_admin.quiz_option_show.note.text') }}

                        @endif

                    </p>

                </div>

            </div>

        </aside>

    </div>

</div>

@endsection
