@extends('education.admin.layouts.app')

@section('title', __('education_admin.quiz_question_create.page_title'))

@section('content')

<div class="education-admin-content-create-page">

    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}

    <div class="education-admin-content-create-header">

        <div class="education-admin-content-create-heading">

            <span class="education-admin-page-header-label">

                <i class="fa-solid fa-circle-question"></i>

                {{ __('education_admin.quiz_question_create.header_label') }}

            </span>


            <div class="education-admin-content-title-row">

                <div class="education-admin-content-title-icon">

                    <i class="fa-solid fa-plus"></i>

                </div>


                <div>

                    <h2>
                        {{ __('education_admin.quiz_question_create.title') }}
                    </h2>


                    <span class="education-admin-content-lesson-name">

                        <i class="fa-solid fa-clipboard-question"></i>

                        {{ $quiz->title }}

                    </span>

                </div>

            </div>


            <p>
                {{ __('education_admin.quiz_question_create.description') }}
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

                {{ __('education_admin.quiz_question_create.actions.back') }}

            </a>

        </div>

    </div>



    {{-- =========================================================
        VALIDATION ERRORS
    ========================================================== --}}

    @if($errors->any())

        <div class="education-admin-content-alert error">

            <i class="fa-solid fa-circle-exclamation"></i>

            <div>

                <strong>
                    {{ __('education_admin.quiz_question_create.alerts.validation_title') }}
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
        FORM
    ========================================================== --}}

    <form
        action="{{ route(
            'education.admin.quizzes.questions.store',
            $quiz
        ) }}"
        method="POST"
        id="educationQuizQuestionForm"
    >

        @csrf


        <div class="education-admin-content-form-grid">


            {{-- =====================================================
                MAIN COLUMN
            ====================================================== --}}

            <div class="education-admin-content-form-main">


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
                                {{ __('education_admin.quiz_question_create.basic.section_label') }}
                            </span>

                            <h3>
                                {{ __('education_admin.quiz_question_create.basic.title') }}
                            </h3>

                        </div>

                    </div>


                    <div class="education-admin-content-form-body">


                        {{-- QUESTION --}}

                        <div class="education-admin-content-field">

                            <label for="question">

                                {{ __('education_admin.quiz_question_create.fields.question') }}

                                <span>*</span>

                            </label>


                            <textarea
                                id="question"
                                name="question"
                                rows="5"
                                required
                                placeholder="{{ __('education_admin.quiz_question_create.fields.question_placeholder') }}"
                            >{{ old('question') }}</textarea>


                            @error('question')

                                <small class="education-admin-content-error">
                                    {{ $message }}
                                </small>

                            @enderror

                        </div>



                        {{-- TYPE + POINTS --}}

                        <div class="education-admin-quiz-form-grid">


                            {{-- TYPE --}}

                            <div class="education-admin-content-field">

                                <label for="type">

                                    {{ __('education_admin.quiz_question_create.fields.type') }}

                                    <span>*</span>

                                </label>


                                <select
                                    name="type"
                                    id="type"
                                    required
                                >

                                    <option value="">
                                        {{ __('education_admin.quiz_question_create.fields.type_placeholder') }}
                                    </option>


                                    <option
                                        value="multiple_choice"
                                        {{ old('type', 'multiple_choice') === 'multiple_choice' ? 'selected' : '' }}
                                    >
                                        {{ __('education_admin.quiz_question_create.types.multiple_choice') }}
                                    </option>


                                    <option
                                        value="true_false"
                                        {{ old('type') === 'true_false' ? 'selected' : '' }}
                                    >
                                        {{ __('education_admin.quiz_question_create.types.true_false') }}
                                    </option>


                                    <option
                                        value="text"
                                        {{ old('type') === 'text' ? 'selected' : '' }}
                                    >
                                        {{ __('education_admin.quiz_question_create.types.text') }}
                                    </option>

                                </select>


                                @error('type')

                                    <small class="education-admin-content-error">
                                        {{ $message }}
                                    </small>

                                @enderror

                            </div>



                            {{-- POINTS --}}

                            <div class="education-admin-content-field">

                                <label for="points">

                                    {{ __('education_admin.quiz_question_create.fields.points') }}

                                    <span>*</span>

                                </label>


                                <input
                                    type="number"
                                    id="points"
                                    name="points"
                                    min="1"
                                    max="100"
                                    value="{{ old('points', 1) }}"
                                    required
                                >


                                @error('points')

                                    <small class="education-admin-content-error">
                                        {{ $message }}
                                    </small>

                                @enderror

                            </div>

                        </div>



                        {{-- EXPLANATION --}}

                        <div class="education-admin-content-field">

                            <label for="explanation">

                                {{ __('education_admin.quiz_question_create.fields.explanation') }}

                                <small>
                                    {{ __('education_admin.quiz_question_create.optional') }}
                                </small>

                            </label>


                            <textarea
                                id="explanation"
                                name="explanation"
                                rows="4"
                                placeholder="{{ __('education_admin.quiz_question_create.fields.explanation_placeholder') }}"
                            >{{ old('explanation') }}</textarea>


                            @error('explanation')

                                <small class="education-admin-content-error">
                                    {{ $message }}
                                </small>

                            @enderror

                        </div>

                    </div>

                </div>



                {{-- =================================================
                    OPTIONS
                ================================================== --}}

                <div
                    class="education-admin-content-form-card"
                    id="optionsCard"
                >

                    <div class="education-admin-content-form-card-header">

                        <div class="education-admin-content-form-card-icon gold">

                            <i class="fa-solid fa-list-check"></i>

                        </div>


                        <div>

                            <span>
                                {{ __('education_admin.quiz_question_create.options.section_label') }}
                            </span>

                            <h3>
                                {{ __('education_admin.quiz_question_create.options.title') }}
                            </h3>

                        </div>

                    </div>


                    <div class="education-admin-content-form-body">


                        <div class="education-admin-quiz-options-header">

                            <div>

                                <strong>
                                    {{ __('education_admin.quiz_question_create.options.heading') }}
                                </strong>

                                <p>
                                    {{ __('education_admin.quiz_question_create.options.description') }}
                                </p>

                            </div>


                            <button
                                type="button"
                                class="education-admin-quiz-add-option"
                                id="addOptionButton"
                            >

                                <i class="fa-solid fa-plus"></i>

                                {{ __('education_admin.quiz_question_create.actions.add_option') }}

                            </button>

                        </div>



                        <div
                            id="optionsContainer"
                            class="education-admin-quiz-create-options"
                        >

                            {{-- OPTIONS ARE INSERTED BY JAVASCRIPT --}}

                        </div>


                        <div
                            id="optionsEmptyMessage"
                            class="education-admin-quiz-options-empty"
                        >

                            <i class="fa-solid fa-list-ul"></i>

                            <span>
                                {{ __('education_admin.quiz_question_create.options.empty_message') }}
                            </span>

                        </div>


                        @error('options')

                            <small class="education-admin-content-error">
                                {{ $message }}
                            </small>

                        @enderror


                        @error('options.*.option')

                            <small class="education-admin-content-error">
                                {{ $message }}
                            </small>

                        @enderror

                    </div>

                </div>



                {{-- =================================================
                    DISPLAY SETTINGS
                ================================================== --}}

                <div class="education-admin-content-form-card">

                    <div class="education-admin-content-form-card-header">

                        <div class="education-admin-content-form-card-icon green">

                            <i class="fa-solid fa-sliders"></i>

                        </div>


                        <div>

                            <span>
                                {{ __('education_admin.quiz_question_create.display.section_label') }}
                            </span>

                            <h3>
                                {{ __('education_admin.quiz_question_create.display.title') }}
                            </h3>

                        </div>

                    </div>


                    <div class="education-admin-content-form-body">

                        <div class="education-admin-quiz-form-grid">


                            {{-- SORT ORDER --}}

                            <div class="education-admin-content-field">

                                <label for="sort_order">

                                    {{ __('education_admin.quiz_question_create.fields.sort_order') }}

                                </label>


                                <input
                                    type="number"
                                    id="sort_order"
                                    name="sort_order"
                                    min="0"
                                    value="{{ old('sort_order', 0) }}"
                                >


                                @error('sort_order')

                                    <small class="education-admin-content-error">
                                        {{ $message }}
                                    </small>

                                @enderror

                            </div>



                            {{-- ACTIVE --}}

                            <div class="education-admin-content-field">

                                <label>
                                    {{ __('education_admin.quiz_question_create.fields.status') }}
                                </label>


                                <label class="education-admin-quiz-toggle">

                                    <input
                                        type="checkbox"
                                        name="is_active"
                                        value="1"
                                        {{ old('is_active', true) ? 'checked' : '' }}
                                    >


                                    <span class="education-admin-quiz-toggle-track">

                                        <span></span>

                                    </span>


                                    <span class="education-admin-quiz-toggle-label">

                                        {{ __('education_admin.quiz_question_create.fields.active_question') }}

                                    </span>

                                </label>

                            </div>

                        </div>

                    </div>

                </div>



                {{-- =================================================
                    FORM ACTIONS
                ================================================== --}}

                <div class="education-admin-quiz-form-actions">

                    <button
                        type="submit"
                        class="education-admin-content-submit-button"
                    >

                        <i class="fa-solid fa-floppy-disk"></i>

                        {{ __('education_admin.quiz_question_create.actions.save') }}

                    </button>


                    <a
                        href="{{ route(
                            'education.admin.quizzes.questions.index',
                            $quiz
                        ) }}"
                        class="education-admin-content-cancel-button"
                    >

                        <i class="fa-solid fa-xmark"></i>

                        {{ __('education_admin.quiz_question_create.actions.cancel') }}

                    </a>

                </div>

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
                                {{ __('education_admin.quiz_question_create.quiz.section_label') }}
                            </span>

                            <h3>
                                {{ __('education_admin.quiz_question_create.quiz.title') }}
                            </h3>

                        </div>

                    </div>


                    <div class="education-admin-quiz-create-summary">

                        <div class="education-admin-quiz-create-summary-icon">

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

                        @endif

                    </div>

                </div>



                {{-- =================================================
                    QUESTION TYPE GUIDE
                ================================================== --}}

                <div class="education-admin-content-form-card">

                    <div class="education-admin-content-form-card-header">

                        <div class="education-admin-content-form-card-icon">

                            <i class="fa-solid fa-circle-info"></i>

                        </div>


                        <div>

                            <span>
                                {{ __('education_admin.quiz_question_create.guide.section_label') }}
                            </span>

                            <h3>
                                {{ __('education_admin.quiz_question_create.guide.title') }}
                            </h3>

                        </div>

                    </div>


                    <div class="education-admin-quiz-type-guide">


                        <div class="education-admin-quiz-type-item">

                            <div>

                                <i class="fa-solid fa-list-check"></i>

                            </div>


                            <div>

                                <strong>
                                    {{ __('education_admin.quiz_question_create.types.multiple_choice') }}
                                </strong>

                                <span>
                                    {{ __('education_admin.quiz_question_create.guide.multiple_choice') }}
                                </span>

                            </div>

                        </div>


                        <div class="education-admin-quiz-type-item">

                            <div>

                                <i class="fa-solid fa-circle-check"></i>

                            </div>


                            <div>

                                <strong>
                                    {{ __('education_admin.quiz_question_create.types.true_false') }}
                                </strong>

                                <span>
                                    {{ __('education_admin.quiz_question_create.guide.true_false') }}
                                </span>

                            </div>

                        </div>


                        <div class="education-admin-quiz-type-item">

                            <div>

                                <i class="fa-solid fa-font"></i>

                            </div>


                            <div>

                                <strong>
                                    {{ __('education_admin.quiz_question_create.types.text') }}
                                </strong>

                                <span>
                                    {{ __('education_admin.quiz_question_create.guide.text') }}
                                </span>

                            </div>

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
                            {{ __('education_admin.quiz_question_create.note.title') }}
                        </strong>


                        <p>

                            {{ __('education_admin.quiz_question_create.note.description') }}

                        </p>

                    </div>

                </div>

            </aside>

        </div>

    </form>

</div>



{{-- =========================================================
    JAVASCRIPT
========================================================= --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const typeSelect = document.getElementById('type');

    const optionsCard = document.getElementById('optionsCard');

    const optionsContainer =
        document.getElementById('optionsContainer');

    const optionsEmptyMessage =
        document.getElementById('optionsEmptyMessage');

    const addOptionButton =
        document.getElementById('addOptionButton');


    let optionIndex = 0;



    /*
    |--------------------------------------------------------------------------
    | CREATE OPTION
    |--------------------------------------------------------------------------
    */

    function createOption(value = '', checked = false) {

        const option = document.createElement('div');

        option.className =
            'education-admin-quiz-create-option';


        option.dataset.index = optionIndex;


        option.innerHTML = `

            <div class="education-admin-quiz-create-option-number">

                ${optionIndex + 1}

            </div>


            <div class="education-admin-quiz-create-option-radio">

                <input
                    type="radio"
                    name="correct_option"
                    value="${optionIndex}"
                    ${checked ? 'checked' : ''}
                >

            </div>


            <div class="education-admin-quiz-create-option-input">

                <input
                    type="text"
                    name="options[${optionIndex}][option]"
                    value="${escapeHtml(value)}"
                    placeholder="{{ __('education_admin.quiz_question_create.javascript.option_placeholder') }}"
                >

                <input
                    type="hidden"
                    name="options[${optionIndex}][sort_order]"
                    value="${optionIndex + 1}"
                >

            </div>


            <button
                type="button"
                class="education-admin-quiz-remove-option"
                title="{{ __('education_admin.quiz_question_create.javascript.delete_option') }}"
            >

                <i class="fa-solid fa-trash"></i>

            </button>

        `;


        optionsContainer.appendChild(option);


        option
            .querySelector('.education-admin-quiz-remove-option')
            .addEventListener('click', function () {

                option.remove();

                refreshOptions();

            });


        option
            .querySelector('input[type="text"]')
            .addEventListener('input', function () {

                updateEmptyMessage();

            });


        optionIndex++;

        refreshOptions();

    }



    /*
    |--------------------------------------------------------------------------
    | ESCAPE HTML
    |--------------------------------------------------------------------------
    */

    function escapeHtml(value) {

        const div = document.createElement('div');

        div.textContent = value;

        return div.innerHTML;

    }



    /*
    |--------------------------------------------------------------------------
    | REFRESH OPTIONS
    |--------------------------------------------------------------------------
    */

    function refreshOptions() {

        const options =
            optionsContainer.querySelectorAll(
                '.education-admin-quiz-create-option'
            );


        options.forEach(function (option, index) {

            const number =
                option.querySelector(
                    '.education-admin-quiz-create-option-number'
                );


            if (number) {

                number.textContent =
                    index + 1;

            }

        });


        updateEmptyMessage();

    }



    /*
    |--------------------------------------------------------------------------
    | EMPTY MESSAGE
    |--------------------------------------------------------------------------
    */

    function updateEmptyMessage() {

        const count =
            optionsContainer.querySelectorAll(
                '.education-admin-quiz-create-option'
            ).length;


        optionsEmptyMessage.style.display =
            count === 0 ? 'flex' : 'none';

    }



    /*
    |--------------------------------------------------------------------------
    | QUESTION TYPE
    |--------------------------------------------------------------------------
    */

    function updateQuestionType() {

        const type = typeSelect.value;


        if (
            type === 'multiple_choice' ||
            type === 'true_false'
        ) {

            optionsCard.style.display = 'block';

            addOptionButton.style.display =
                type === 'true_false'
                    ? 'none'
                    : 'inline-flex';


        } else {

            optionsCard.style.display = 'none';

        }


        /*
        |--------------------------------------------------------------------------
        | TRUE / FALSE
        |--------------------------------------------------------------------------
        */

        if (type === 'true_false') {

            optionsContainer.innerHTML = '';

            optionIndex = 0;


            createOption(
                @json(__('education_admin.quiz_question_create.javascript.true_option')),
                true
            );

            createOption(
                @json(__('education_admin.quiz_question_create.javascript.false_option')),
                false
            );

        }


        /*
        |--------------------------------------------------------------------------
        | MULTIPLE CHOICE
        |--------------------------------------------------------------------------
        */

        if (type === 'multiple_choice') {

            if (
                optionsContainer
                    .querySelectorAll(
                        '.education-admin-quiz-create-option'
                    )
                    .length === 0
            ) {

                createOption();

                createOption();

            }

        }


        /*
        |--------------------------------------------------------------------------
        | TEXT
        |--------------------------------------------------------------------------
        */

        if (type === 'text') {

            optionsContainer.innerHTML = '';

            optionIndex = 0;

        }

    }



    /*
    |--------------------------------------------------------------------------
    | ADD OPTION
    |--------------------------------------------------------------------------
    */

    addOptionButton.addEventListener(
        'click',
        function () {

            if (typeSelect.value !== 'multiple_choice') {
                return;
            }


            createOption();

        }
    );



    /*
    |--------------------------------------------------------------------------
    | INITIAL TYPE
    |--------------------------------------------------------------------------
    */

    updateQuestionType();


    typeSelect.addEventListener(
        'change',
        updateQuestionType
    );



    /*
    |--------------------------------------------------------------------------
    | FORM VALIDATION
    |--------------------------------------------------------------------------
    */

    document
        .getElementById('educationQuizQuestionForm')
        .addEventListener('submit', function (event) {

            const type = typeSelect.value;


            if (type === 'multiple_choice') {

                const options =
                    optionsContainer.querySelectorAll(
                        '.education-admin-quiz-create-option'
                    );


                if (options.length < 2) {

                    event.preventDefault();

                    alert(
                        @json(__('education_admin.quiz_question_create.javascript.minimum_options'))
                    );

                    return;

                }


                const checked =
                    optionsContainer.querySelector(
                        'input[name="correct_option"]:checked'
                    );


                if (!checked) {

                    event.preventDefault();

                    alert(
                        @json(__('education_admin.quiz_question_create.javascript.select_correct'))
                    );

                    return;

                }

            }

        });

});

</script>

@endsection
