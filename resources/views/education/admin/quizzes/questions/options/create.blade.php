@extends('education.admin.layouts.app')

@section('title', __('education_admin.quiz_option_create.page_title'))

@section('content')

<div class="education-admin-content-create-page">

    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}

    <div class="education-admin-content-create-header">

        <div class="education-admin-content-create-heading">

            <span class="education-admin-page-header-label">

                <i class="fa-solid fa-list-check"></i>

                {{ __('education_admin.quiz_option_create.header_label') }}

            </span>


            <div class="education-admin-content-title-row">

                <div class="education-admin-content-title-icon">

                    <i class="fa-solid fa-plus"></i>

                </div>


                <div>

                    <h2>
                        {{ __('education_admin.quiz_option_create.title') }}
                    </h2>


                    <span class="education-admin-content-lesson-name">

                        <i class="fa-solid fa-clipboard-question"></i>

                        {{ $quiz->title }}

                    </span>

                </div>

            </div>


            <p>
                {{ __('education_admin.quiz_option_create.description') }}
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

                {{ __('education_admin.quiz_option_create.actions.back_to_options') }}

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
                    {{ __('education_admin.quiz_option_create.alerts.validation_title') }}
                </strong>

                <ul>

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

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
                QUESTION PREVIEW
            ================================================== --}}

            <div class="education-admin-content-form-card">

                <div class="education-admin-content-form-card-header">

                    <div class="education-admin-content-form-card-icon">

                        <i class="fa-solid fa-circle-question"></i>

                    </div>


                    <div>

                        <span>
                            {{ __('education_admin.quiz_option_create.question.section_label') }}
                        </span>

                        <h3>
                            {{ __('education_admin.quiz_option_create.question.heading') }}
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


                            <span>

                                <i class="fa-solid fa-layer-group"></i>

                                @switch($question->type)

                                    @case('multiple_choice')
                                        {{ __('education_admin.quiz_option_create.question.types.multiple_choice') }}
                                        @break

                                    @case('true_false')
                                        {{ __('education_admin.quiz_option_create.question.types.true_false') }}
                                        @break

                                    @case('text')
                                        {{ __('education_admin.quiz_option_create.question.types.text') }}
                                        @break

                                @endswitch

                            </span>

                        </div>

                    </div>

                </div>

            </div>



            {{-- =================================================
                OPTION FORM
            ================================================== --}}

            <div class="education-admin-content-form-card">

                <div class="education-admin-content-form-card-header">

                    <div class="education-admin-content-form-card-icon gold">

                        <i class="fa-solid fa-list-check"></i>

                    </div>


                    <div>

                        <span>
                            {{ __('education_admin.quiz_option_create.option.section_label') }}
                        </span>

                        <h3>
                            {{ __('education_admin.quiz_option_create.option.heading') }}
                        </h3>

                    </div>

                </div>


                <div class="education-admin-content-form-body">

                    <form
                        action="{{ route(
                            'education.admin.quizzes.questions.options.store',
                            [$quiz, $question]
                        ) }}"
                        method="POST"
                    >

                        @csrf


                        {{-- =================================================
                            OPTION TEXT
                        ================================================== --}}

                        <div class="education-admin-form-group">

                            <label
                                for="option"
                                class="education-admin-form-label"
                            >

                                {{ __('education_admin.quiz_option_create.option.text') }}

                                <span class="required">
                                    *
                                </span>

                            </label>


                            <textarea
                                id="option"
                                name="option"
                                rows="5"
                                class="education-admin-form-textarea @error('option') is-invalid @enderror"
                                placeholder="{{ __('education_admin.quiz_option_create.option.text_placeholder') }}"
                                required
                            >{{ old('option') }}</textarea>


                            @error('option')

                                <span class="education-admin-form-error">
                                    {{ $message }}
                                </span>

                            @enderror

                        </div>



                        {{-- =================================================
                            SORT ORDER
                        ================================================== --}}

                        <div class="education-admin-form-group">

                            <label
                                for="sort_order"
                                class="education-admin-form-label"
                            >

                                {{ __('education_admin.quiz_option_create.option.sort_order') }}

                            </label>


                            <input
                                type="number"
                                id="sort_order"
                                name="sort_order"
                                value="{{ old('sort_order', 0) }}"
                                min="0"
                                class="education-admin-form-input @error('sort_order') is-invalid @enderror"
                            >


                            <span class="education-admin-form-help">

                                {{ __('education_admin.quiz_option_create.option.sort_order_help') }}

                            </span>


                            @error('sort_order')

                                <span class="education-admin-form-error">
                                    {{ $message }}
                                </span>

                            @enderror

                        </div>



                        {{-- =================================================
                            CORRECT ANSWER
                        ================================================== --}}

                        <div class="education-admin-form-group">

                            <label class="education-admin-form-label">

                                {{ __('education_admin.quiz_option_create.option.answer_status') }}

                            </label>


                            <div class="education-admin-form-checkbox-card">

                                <label
                                    class="education-admin-form-checkbox-label"
                                >

                                    <input
                                        type="checkbox"
                                        name="is_correct"
                                        value="1"
                                        {{ old('is_correct') ? 'checked' : '' }}
                                    >


                                    <span class="education-admin-form-checkbox-custom">

                                        <i class="fa-solid fa-check"></i>

                                    </span>


                                    <span class="education-admin-form-checkbox-content">

                                        <strong>
                                            {{ __('education_admin.quiz_option_create.option.correct') }}
                                        </strong>

                                        <small>

                                            {{ __('education_admin.quiz_option_create.option.correct_description') }}

                                        </small>

                                    </span>

                                </label>

                            </div>


                            @if($question->type === 'true_false')

                                <span class="education-admin-form-help">

                                    <i class="fa-solid fa-circle-info"></i>

                                    {{ __('education_admin.quiz_option_create.type_help.true_false') }}

                                </span>

                            @elseif($question->type === 'multiple_choice')

                                <span class="education-admin-form-help">

                                    <i class="fa-solid fa-circle-info"></i>

                                    {{ __('education_admin.quiz_option_create.type_help.multiple_choice') }}

                                </span>

                            @endif

                        </div>



                        {{-- =================================================
                            ACTIVE STATUS
                        ================================================== --}}

                        <div class="education-admin-form-group">

                            <label class="education-admin-form-label">

                                {{ __('education_admin.quiz_option_create.option.active_status') }}

                            </label>


                            <div class="education-admin-form-checkbox-card">

                                <label
                                    class="education-admin-form-checkbox-label"
                                >

                                    <input
                                        type="checkbox"
                                        name="is_active"
                                        value="1"
                                        {{ old('is_active', true) ? 'checked' : '' }}
                                    >


                                    <span class="education-admin-form-checkbox-custom">

                                        <i class="fa-solid fa-check"></i>

                                    </span>


                                    <span class="education-admin-form-checkbox-content">

                                        <strong>
                                            {{ __('education_admin.quiz_option_create.option.active') }}
                                        </strong>

                                        <small>

                                            {{ __('education_admin.quiz_option_create.option.active_description') }}

                                        </small>

                                    </span>

                                </label>

                            </div>

                        </div>



                        {{-- =================================================
                            FORM ACTIONS
                        ================================================== --}}

                        <div class="education-admin-content-form-actions">

                            <a
                                href="{{ route(
                                    'education.admin.quizzes.questions.options.index',
                                    [$quiz, $question]
                                ) }}"
                                class="education-admin-content-cancel-button"
                            >

                                <i class="fa-solid fa-xmark"></i>

                                {{ __('education_admin.quiz_option_create.actions.cancel') }}

                            </a>


                            <button
                                type="submit"
                                class="education-admin-content-submit-button"
                            >

                                <i class="fa-solid fa-plus"></i>

                                {{ __('education_admin.quiz_option_create.actions.create') }}

                            </button>

                        </div>

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
                            {{ __('education_admin.quiz_option_create.question_type.section_label') }}
                        </span>

                        <h3>
                            {{ __('education_admin.quiz_option_create.question_type.heading') }}
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
                                {{ __('education_admin.quiz_option_create.question_type.multiple_choice.title') }}
                            </strong>


                            <span>
                                {{ __('education_admin.quiz_option_create.question_type.multiple_choice.description') }}
                            </span>

                            @break


                        @case('true_false')

                            <div class="education-admin-question-type-summary-icon green">

                                <i class="fa-solid fa-check-double"></i>

                            </div>


                            <strong>
                                {{ __('education_admin.quiz_option_create.question_type.true_false.title') }}
                            </strong>


                            <span>
                                {{ __('education_admin.quiz_option_create.question_type.true_false.description') }}
                            </span>

                            @break


                        @case('text')

                            <div class="education-admin-question-type-summary-icon gold">

                                <i class="fa-solid fa-align-right"></i>

                            </div>


                            <strong>
                                {{ __('education_admin.quiz_option_create.question_type.text.title') }}
                            </strong>


                            <span>
                                {{ __('education_admin.quiz_option_create.question_type.text.description') }}
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

                        <i class="fa-solid fa-circle-question"></i>

                    </div>


                    <div>

                        <span>
                            {{ __('education_admin.quiz_option_create.question_info.section_label') }}
                        </span>

                        <h3>
                            {{ __('education_admin.quiz_option_create.question_info.heading') }}
                        </h3>

                    </div>

                </div>


                <div class="education-admin-quiz-info-list">


                    {{-- POINTS --}}

                    <div class="education-admin-quiz-info-item">

                        <div>

                            <i class="fa-solid fa-star"></i>

                            <span>
                                {{ __('education_admin.quiz_option_create.question_info.points') }}
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
                                {{ __('education_admin.quiz_option_create.question_info.sort_order') }}
                            </span>

                        </div>


                        <strong>
                            {{ $question->sort_order }}
                        </strong>

                    </div>



                    {{-- EXISTING OPTIONS --}}

                    <div class="education-admin-quiz-info-item">

                        <div>

                            <i class="fa-solid fa-list"></i>

                            <span>
                                {{ __('education_admin.quiz_option_create.question_info.existing_options') }}
                            </span>

                        </div>


                        <strong>
                            {{ $question->options()->count() }}
                        </strong>

                    </div>

                </div>

            </div>



            {{-- =================================================
                INSTRUCTION
            ================================================== --}}

            <div class="education-admin-content-note">

                <div class="education-admin-content-note-icon">

                    <i class="fa-solid fa-lightbulb"></i>

                </div>


                <div>

                    <strong>
                        {{ __('education_admin.quiz_option_create.note.title') }}
                    </strong>


                    @if($question->type === 'multiple_choice')

                        <p>
                            {{ __('education_admin.quiz_option_create.note.multiple_choice') }}
                        </p>

                    @elseif($question->type === 'true_false')

                        <p>
                            {{ __('education_admin.quiz_option_create.note.true_false') }}
                        </p>

                    @else

                        <p>
                            {{ __('education_admin.quiz_option_create.note.text') }}
                        </p>

                    @endif

                </div>

            </div>



            {{-- =================================================
                BACK TO QUESTION
            ================================================== --}}

            <div class="education-admin-content-form-card">

                <div class="education-admin-content-form-card-header">

                    <div class="education-admin-content-form-card-icon">

                        <i class="fa-solid fa-gears"></i>

                    </div>


                    <div>

                        <span>
                            {{ __('education_admin.quiz_option_create.question_info.section_label') }}
                        </span>

                        <h3>
                            {{ __('education_admin.quiz_option_create.question_info.heading') }}
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

                        {{ __('education_admin.quiz_option_create.actions.view_question') }}

                    </a>


                    <a
                        href="{{ route(
                            'education.admin.quizzes.questions.options.index',
                            [$quiz, $question]
                        ) }}"
                        class="education-admin-content-submit-button"
                    >

                        <i class="fa-solid fa-list"></i>

                        {{ __('education_admin.quiz_option_create.actions.view_options') }}

                    </a>

                </div>

            </div>

        </aside>

    </div>

</div>

@endsection
