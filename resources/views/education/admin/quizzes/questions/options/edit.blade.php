@extends('education.admin.layouts.app')

@section('title', __('education_admin.quiz_option_edit.page_title'))

@section('content')

<div class="education-admin-content-create-page">

    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}

    <div class="education-admin-content-create-header">

        <div class="education-admin-content-create-heading">

            <span class="education-admin-page-header-label">

                <i class="fa-solid fa-list-check"></i>

                {{ __('education_admin.quiz_option_edit.header_label') }}

            </span>


            <div class="education-admin-content-title-row">

                <div class="education-admin-content-title-icon">

                    <i class="fa-solid fa-pen"></i>

                </div>


                <div>

                    <h2>
                        {{ __('education_admin.quiz_option_edit.title') }}
                    </h2>


                    <span class="education-admin-content-lesson-name">

                        <i class="fa-solid fa-clipboard-question"></i>

                        {{ $quiz->title }}

                    </span>

                </div>

            </div>


            <p>
                {{ __('education_admin.quiz_option_edit.description') }}
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

                {{ __('education_admin.quiz_option_edit.actions.back') }}

            </a>


            <a
                href="{{ route(
                    'education.admin.quizzes.questions.options.show',
                    [$quiz, $question, $option]
                ) }}"
                class="education-admin-content-submit-button"
            >

                <i class="fa-solid fa-eye"></i>

                {{ __('education_admin.quiz_option_edit.actions.view') }}

            </a>

        </div>

    </div>



    {{-- =========================================================
        VALIDATION ERRORS
    ========================================================== --}}

    @if($errors->any())

        <div class="education-admin-content-alert error">

            <div class="education-admin-content-alert-icon">

                <i class="fa-solid fa-circle-exclamation"></i>

            </div>


            <div>

                <strong>
                    {{ __('education_admin.quiz_option_edit.alerts.error_title') }}
                </strong>

                <p>
                    {{ __('education_admin.quiz_option_edit.alerts.error_description') }}
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
                            {{ __('education_admin.quiz_option_edit.question.section_label') }}
                        </span>

                        <h3>
                            {{ __('education_admin.quiz_option_edit.question.heading') }}
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

                                    {{ __('education_admin.quiz_option_edit.question.has_explanation') }}

                                </span>

                            @endif

                        </div>

                    </div>

                </div>

            </div>



            {{-- =================================================
                EDIT FORM
            ================================================== --}}

            <div class="education-admin-content-form-card">

                <div class="education-admin-content-form-card-header">

                    <div class="education-admin-content-form-card-icon gold">

                        <i class="fa-solid fa-pen-to-square"></i>

                    </div>


                    <div>

                        <span>
                            {{ __('education_admin.quiz_option_edit.option.section_label') }}
                        </span>

                        <h3>
                            {{ __('education_admin.quiz_option_edit.option.heading') }}
                        </h3>

                    </div>

                </div>


                <div class="education-admin-content-form-body">

                    <form
                        action="{{ route(
                            'education.admin.quizzes.questions.options.update',
                            [$quiz, $question, $option]
                        ) }}"
                        method="POST"
                    >

                        @csrf

                        @method('PUT')


                        {{-- =================================================
                            OPTION TEXT
                        ================================================== --}}

                        <div class="education-admin-content-form-group">

                            <label
                                for="option"
                                class="education-admin-content-form-label"
                            >

                                <i class="fa-solid fa-align-right"></i>

                                {{ __('education_admin.quiz_option_edit.option.text') }}

                                <span class="required">
                                    *
                                </span>

                            </label>


                            <textarea
                                id="option"
                                name="option"
                                rows="5"
                                maxlength="1000"
                                required
                                class="education-admin-content-form-input"
                                placeholder="{{ __('education_admin.quiz_option_edit.option.text_placeholder') }}"
                            >{{ old('option', $option->option) }}</textarea>


                            @error('option')

                                <span class="education-admin-content-form-error">

                                    <i class="fa-solid fa-circle-exclamation"></i>

                                    {{ $message }}

                                </span>

                            @enderror


                            <span class="education-admin-content-form-help">

                                {{ __('education_admin.quiz_option_edit.option.text_help') }}

                            </span>

                        </div>



                        {{-- =================================================
                            SETTINGS ROW
                        ================================================== --}}

                        <div class="education-admin-content-form-row">


                            {{-- SORT ORDER --}}

                            <div class="education-admin-content-form-group">

                                <label
                                    for="sort_order"
                                    class="education-admin-content-form-label"
                                >

                                    <i class="fa-solid fa-arrow-down-1-9"></i>

                                    {{ __('education_admin.quiz_option_edit.option.sort_order') }}

                                </label>


                                <input
                                    type="number"
                                    id="sort_order"
                                    name="sort_order"
                                    value="{{ old('sort_order', $option->sort_order) }}"
                                    min="0"
                                    class="education-admin-content-form-input"
                                    placeholder="{{ __('education_admin.quiz_option_edit.option.sort_placeholder') }}"
                                >


                                @error('sort_order')

                                    <span class="education-admin-content-form-error">

                                        <i class="fa-solid fa-circle-exclamation"></i>

                                        {{ $message }}

                                    </span>

                                @enderror


                                <span class="education-admin-content-form-help">

                                    {{ __('education_admin.quiz_option_edit.option.sort_help') }}

                                </span>

                            </div>



                            {{-- ACTIVE STATUS --}}

                            <div class="education-admin-content-form-group">

                                <label
                                    class="education-admin-content-form-label"
                                >

                                    <i class="fa-solid fa-toggle-on"></i>

                                    {{ __('education_admin.quiz_option_edit.option.status') }}

                                </label>


                                <label class="education-admin-toggle">

                                    <input
                                        type="checkbox"
                                        name="is_active"
                                        value="1"
                                        {{ old('is_active', $option->is_active) ? 'checked' : '' }}
                                    >

                                    <span class="education-admin-toggle-slider"></span>

                                    <span class="education-admin-toggle-text">

                                        {{ __('education_admin.quiz_option_edit.option.active') }}

                                    </span>

                                </label>


                                <span class="education-admin-content-form-help">

                                    {{ __('education_admin.quiz_option_edit.option.status_help') }}

                                </span>

                            </div>

                        </div>



                        {{-- =================================================
                            CORRECT ANSWER
                        ================================================== --}}

                        @if($question->type !== 'text')

                            <div class="education-admin-option-correct-box">

                                <div class="education-admin-option-correct-icon">

                                    @if($option->is_correct)

                                        <i class="fa-solid fa-circle-check"></i>

                                    @else

                                        <i class="fa-solid fa-circle-question"></i>

                                    @endif

                                </div>


                                <div class="education-admin-option-correct-content">

                                    <strong>
                                        {{ __('education_admin.quiz_option_edit.correct_answer.title') }}
                                    </strong>

                                    <span>

                                        @if($question->type === 'true_false')

                                            {{ __('education_admin.quiz_option_edit.correct_answer.true_false') }}

                                        @else

                                            {{ __('education_admin.quiz_option_edit.correct_answer.multiple_choice') }}

                                        @endif

                                    </span>

                                </div>


                                <label class="education-admin-toggle">

                                    <input
                                        type="checkbox"
                                        name="is_correct"
                                        value="1"
                                        {{ old('is_correct', $option->is_correct) ? 'checked' : '' }}
                                    >

                                    <span class="education-admin-toggle-slider"></span>

                                    <span class="education-admin-toggle-text">

                                        {{ __('education_admin.quiz_option_edit.correct_answer.correct') }}

                                    </span>

                                </label>

                            </div>

                        @endif



                        {{-- =================================================
                            SUBMIT ACTIONS
                        ================================================== --}}

                        <div class="education-admin-content-form-actions">

                            <a
                                href="{{ route(
                                    'education.admin.quizzes.questions.options.show',
                                    [$quiz, $question, $option]
                                ) }}"
                                class="education-admin-content-cancel-button"
                            >

                                <i class="fa-solid fa-xmark"></i>

                                {{ __('education_admin.quiz_option_edit.actions.cancel') }}

                            </a>


                            <button
                                type="submit"
                                class="education-admin-content-submit-button"
                            >

                                <i class="fa-solid fa-floppy-disk"></i>

                                {{ __('education_admin.quiz_option_edit.actions.save') }}

                            </button>

                        </div>

                    </form>

                </div>

            </div>



            {{-- =================================================
                DELETE OPTION
            ================================================== --}}

            <div class="education-admin-content-form-card">

                <div class="education-admin-content-form-card-header">

                    <div class="education-admin-content-form-card-icon">

                        <i class="fa-solid fa-trash"></i>

                    </div>


                    <div>

                        <span>
                            {{ __('education_admin.quiz_option_edit.danger.section_label') }}
                        </span>

                        <h3>
                            {{ __('education_admin.quiz_option_edit.danger.title') }}
                        </h3>

                    </div>

                </div>


                <div class="education-admin-content-form-body">

                    <div class="education-admin-content-note">

                        <div class="education-admin-content-note-icon">

                            <i class="fa-solid fa-triangle-exclamation"></i>

                        </div>


                        <div>

                            <strong>
                                {{ __('education_admin.quiz_option_edit.danger.heading') }}
                            </strong>


                            <p>
                                {{ __('education_admin.quiz_option_edit.danger.description') }}
                            </p>

                        </div>

                    </div>


                    <div class="education-admin-content-form-actions">

                        <form
                            action="{{ route(
                                'education.admin.quizzes.questions.options.destroy',
                                [$quiz, $question, $option]
                            ) }}"
                            method="POST"
                            onsubmit="return confirm(@json(__('education_admin.quiz_option_edit.danger.confirm')));"
                        >

                            @csrf

                            @method('DELETE')


                            <button
                                type="submit"
                                class="education-admin-content-delete-button"
                            >

                                <i class="fa-solid fa-trash"></i>

                                {{ __('education_admin.quiz_option_edit.actions.delete') }}

                            </button>

                        </form>

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

                        <i class="fa-solid fa-layer-group"></i>

                    </div>


                    <div>

                        <span>
                            {{ __('education_admin.quiz_option_edit.question_type.section_label') }}
                        </span>

                        <h3>
                            {{ __('education_admin.quiz_option_edit.question_type.heading') }}
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
                                {{ __('education_admin.quiz_option_edit.question_type.multiple_choice.title') }}
                            </strong>


                            <span>
                                {{ __('education_admin.quiz_option_edit.question_type.multiple_choice.description') }}
                            </span>

                            @break


                        @case('true_false')

                            <div class="education-admin-question-type-summary-icon green">

                                <i class="fa-solid fa-check-double"></i>

                            </div>


                            <strong>
                                {{ __('education_admin.quiz_option_edit.question_type.true_false.title') }}
                            </strong>


                            <span>
                                {{ __('education_admin.quiz_option_edit.question_type.true_false.description') }}
                            </span>

                            @break


                        @case('text')

                            <div class="education-admin-question-type-summary-icon gold">

                                <i class="fa-solid fa-align-right"></i>

                            </div>


                            <strong>
                                {{ __('education_admin.quiz_option_edit.question_type.text.title') }}
                            </strong>


                            <span>
                                {{ __('education_admin.quiz_option_edit.question_type.text.description') }}
                            </span>

                            @break

                    @endswitch

                </div>

            </div>



            {{-- =================================================
                OPTION STATUS
            ================================================== --}}

            <div class="education-admin-content-form-card">

                <div class="education-admin-content-form-card-header">

                    <div class="education-admin-content-form-card-icon green">

                        <i class="fa-solid fa-chart-simple"></i>

                    </div>


                    <div>

                        <span>
                            {{ __('education_admin.quiz_option_edit.status.section_label') }}
                        </span>

                        <h3>
                            {{ __('education_admin.quiz_option_edit.status.heading') }}
                        </h3>

                    </div>

                </div>


                <div class="education-admin-quiz-info-list">


                    {{-- ID --}}

                    <div class="education-admin-quiz-info-item">

                        <div>

                            <i class="fa-solid fa-hashtag"></i>

                            <span>
                                {{ __('education_admin.quiz_option_edit.status.number') }}
                            </span>

                        </div>


                        <strong>
                            {{ $option->id }}
                        </strong>

                    </div>



                    {{-- SORT --}}

                    <div class="education-admin-quiz-info-item">

                        <div>

                            <i class="fa-solid fa-arrow-down-1-9"></i>

                            <span>
                                {{ __('education_admin.quiz_option_edit.status.order') }}
                            </span>

                        </div>


                        <strong>
                            {{ $option->sort_order }}
                        </strong>

                    </div>



                    {{-- CORRECT --}}

                    <div class="education-admin-quiz-info-item">

                        <div>

                            <i class="fa-solid fa-circle-check"></i>

                            <span>
                                {{ __('education_admin.quiz_option_edit.status.answer') }}
                            </span>

                        </div>


                        @if($option->is_correct)

                            <strong>
                                {{ __('education_admin.quiz_option_edit.status.correct') }}
                            </strong>

                        @else

                            <strong>
                                {{ __('education_admin.quiz_option_edit.status.incorrect') }}
                            </strong>

                        @endif

                    </div>

                </div>

            </div>



            {{-- =================================================
                QUESTION INFORMATION
            ================================================== --}}

            <div class="education-admin-content-form-card">

                <div class="education-admin-content-form-card-header">

                    <div class="education-admin-content-form-card-icon">

                        <i class="fa-solid fa-circle-info"></i>

                    </div>


                    <div>

                        <span>
                            {{ __('education_admin.quiz_option_edit.question_info.section_label') }}
                        </span>

                        <h3>
                            {{ __('education_admin.quiz_option_edit.question_info.heading') }}
                        </h3>

                    </div>

                </div>


                <div class="education-admin-quiz-info-list">


                    <div class="education-admin-quiz-info-item">

                        <div>

                            <i class="fa-solid fa-star"></i>

                            <span>
                                {{ __('education_admin.quiz_option_edit.question_info.points') }}
                            </span>

                        </div>


                        <strong>
                            {{ $question->points }}
                        </strong>

                    </div>


                    <div class="education-admin-quiz-info-item">

                        <div>

                            <i class="fa-solid fa-list"></i>

                            <span>
                                {{ __('education_admin.quiz_option_edit.question_info.options_count') }}
                            </span>

                        </div>


                        <strong>
                            {{ $question->options()->count() }}
                        </strong>

                    </div>


                    <div class="education-admin-quiz-info-item">

                        <div>

                            <i class="fa-solid fa-toggle-on"></i>

                            <span>
                                {{ __('education_admin.quiz_option_edit.question_info.status') }}
                            </span>

                        </div>


                        @if($question->is_active)

                            <strong>
                                {{ __('education_admin.quiz_option_edit.question_info.active') }}
                            </strong>

                        @else

                            <strong>
                                {{ __('education_admin.quiz_option_edit.question_info.inactive') }}
                            </strong>

                        @endif

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
                        {{ __('education_admin.quiz_option_edit.note.title') }}
                    </strong>


                    <p>

                        @if($question->type === 'true_false')

                            {{ __('education_admin.quiz_option_edit.note.true_false') }}

                        @elseif($question->type === 'multiple_choice')

                            {{ __('education_admin.quiz_option_edit.note.multiple_choice') }}

                        @else

                            {{ __('education_admin.quiz_option_edit.note.text') }}

                        @endif

                    </p>

                </div>

            </div>

        </aside>

    </div>

</div>

@endsection
