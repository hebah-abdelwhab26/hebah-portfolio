@extends('education.admin.layouts.app')

@section('title', __('education_admin.question_edit.page_title'))

@section('content')

<div class="education-admin-content-create-page">

    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}

    <div class="education-admin-content-create-header">

        <div class="education-admin-content-create-heading">

            <span class="education-admin-page-header-label">

                <i class="fa-solid fa-pen-to-square"></i>

                {{ __('education_admin.question_edit.header_label') }}

            </span>


            <div class="education-admin-content-title-row">

                <div class="education-admin-content-title-icon">

                    <i class="fa-solid fa-circle-question"></i>

                </div>


                <div>

                    <h2>
                        {{ __('education_admin.question_edit.title') }}
                    </h2>


                    <span class="education-admin-content-lesson-name">

                        <i class="fa-solid fa-clipboard-question"></i>

                        {{ $quiz->title }}

                    </span>

                </div>

            </div>


            <p>
                {{ __('education_admin.question_edit.description') }}
            </p>

        </div>


        {{-- HEADER ACTIONS --}}

        <div class="education-admin-content-header-actions">

            <a
                href="{{ route(
                    'education.admin.quizzes.questions.show',
                    [$quiz, $question]
                ) }}"
                class="education-admin-content-back-button"
            >

                <i class="fa-solid fa-arrow-right"></i>

                {{ __('education_admin.question_edit.actions.back') }}

            </a>

        </div>

    </div>



    {{-- =========================================================
        VALIDATION ERRORS
    ========================================================== --}}

    @if($errors->any())

        <div class="education-admin-content-alert error">

            <div class="education-admin-content-alert-icon">

                <i class="fa-solid fa-triangle-exclamation"></i>

            </div>


            <div>

                <strong>
                    {{ __('education_admin.question_edit.alerts.validation_title') }}
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
            'education.admin.quizzes.questions.update',
            [$quiz, $question]
        ) }}"
        method="POST"
        id="question-edit-form"
    >

        @csrf

        @method('PUT')


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

                            <i class="fa-solid fa-circle-question"></i>

                        </div>


                        <div>

                            <span>
                                {{ __('education_admin.question_edit.question.section_label') }}
                            </span>

                            <h3>
                                {{ __('education_admin.question_edit.question.heading') }}
                            </h3>

                        </div>

                    </div>


                    <div class="education-admin-content-form-body">


                        {{-- QUESTION --}}

                        <div class="education-admin-content-field">

                            <label for="question">

                                {{ __('education_admin.question_edit.fields.question') }}

                                <span class="required">
                                    {{ __('education_admin.question_edit.required') }}
                                </span>

                            </label>


                            <textarea
                                id="question"
                                name="question"
                                rows="6"
                                class="education-admin-content-input education-admin-content-textarea"
                                placeholder="{{ __('education_admin.question_edit.fields.question_placeholder') }}"
                                required
                            >{{ old('question', $question->question) }}</textarea>


                            @error('question')

                                <small class="education-admin-content-error">
                                    {{ $message }}
                                </small>

                            @enderror

                        </div>



                        {{-- EXPLANATION --}}

                        <div class="education-admin-content-field">

                            <label for="explanation">

                                {{ __('education_admin.question_edit.fields.explanation') }}

                                <span class="optional">
                                    {{ __('education_admin.question_edit.optional') }}
                                </span>

                            </label>


                            <textarea
                                id="explanation"
                                name="explanation"
                                rows="5"
                                class="education-admin-content-input education-admin-content-textarea"
                                placeholder="{{ __('education_admin.question_edit.fields.explanation_placeholder') }}"
                            >{{ old('explanation', $question->explanation) }}</textarea>


                            <small class="education-admin-content-field-hint">

                                {{ __('education_admin.question_edit.fields.explanation_hint') }}

                            </small>


                            @error('explanation')

                                <small class="education-admin-content-error">
                                    {{ $message }}
                                </small>

                            @enderror

                        </div>

                    </div>

                </div>



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
                                {{ __('education_admin.question_edit.type.section_label') }}
                            </span>

                            <h3>
                                {{ __('education_admin.question_edit.type.heading') }}
                            </h3>

                        </div>

                    </div>


                    <div class="education-admin-content-form-body">

                        <div class="education-admin-question-types-grid">


                            {{-- MULTIPLE CHOICE --}}

                            <label class="education-admin-question-type-option">

                                <input
                                    type="radio"
                                    name="type"
                                    value="multiple_choice"
                                    {{ old('type', $question->type) === 'multiple_choice' ? 'checked' : '' }}
                                >


                                <div class="education-admin-question-type-card">

                                    <div class="education-admin-question-type-icon">

                                        <i class="fa-solid fa-list-ul"></i>

                                    </div>


                                    <div>

                                        <strong>
                                            {{ __('education_admin.question_edit.types.multiple_choice.title') }}
                                        </strong>

                                        <span>
                                            {{ __('education_admin.question_edit.types.multiple_choice.description') }}
                                        </span>

                                    </div>

                                </div>

                            </label>



                            {{-- TRUE FALSE --}}

                            <label class="education-admin-question-type-option">

                                <input
                                    type="radio"
                                    name="type"
                                    value="true_false"
                                    {{ old('type', $question->type) === 'true_false' ? 'checked' : '' }}
                                >


                                <div class="education-admin-question-type-card">

                                    <div class="education-admin-question-type-icon green">

                                        <i class="fa-solid fa-check-double"></i>

                                    </div>


                                    <div>

                                        <strong>
                                            {{ __('education_admin.question_edit.types.true_false.title') }}
                                        </strong>

                                        <span>
                                            {{ __('education_admin.question_edit.types.true_false.description') }}
                                        </span>

                                    </div>

                                </div>

                            </label>



                            {{-- TEXT --}}

                            <label class="education-admin-question-type-option">

                                <input
                                    type="radio"
                                    name="type"
                                    value="text"
                                    {{ old('type', $question->type) === 'text' ? 'checked' : '' }}
                                >


                                <div class="education-admin-question-type-card">

                                    <div class="education-admin-question-type-icon gold">

                                        <i class="fa-solid fa-align-right"></i>

                                    </div>


                                    <div>

                                        <strong>
                                            {{ __('education_admin.question_edit.types.text.title') }}
                                        </strong>

                                        <span>
                                            {{ __('education_admin.question_edit.types.text.description') }}
                                        </span>

                                    </div>

                                </div>

                            </label>

                        </div>


                        @error('type')

                            <small class="education-admin-content-error">
                                {{ $message }}
                            </small>

                        @enderror

                    </div>

                </div>



                {{-- =================================================
                    ANSWER OPTIONS
                ================================================== --}}

                <div
                    class="education-admin-content-form-card"
                    id="answer-options-card"
                >

                    <div class="education-admin-content-form-card-header">

                        <div class="education-admin-content-form-card-icon gold">

                            <i class="fa-solid fa-list-check"></i>

                        </div>


                        <div>

                            <span>
                                {{ __('education_admin.question_edit.options.section_label') }}
                            </span>

                            <h3>
                                {{ __('education_admin.question_edit.options.heading') }}
                            </h3>

                        </div>

                    </div>


                    <div class="education-admin-content-form-body">


                        {{-- =================================================
                            OPTIONS HEADER
                        ================================================== --}}

                        <div
                            style="
                                display:flex;
                                align-items:center;
                                justify-content:space-between;
                                gap:15px;
                                margin-bottom:20px;
                                flex-wrap:wrap;
                            "
                        >

                            <div>

                                <strong>
                                    {{ __('education_admin.question_edit.options.manage_title') }}
                                </strong>

                                <small
                                    class="education-admin-content-field-hint"
                                    style="display:block;margin-top:5px;"
                                >
                                    {{ __('education_admin.question_edit.options.manage_description') }}
                                </small>

                            </div>


                            <button
                                type="button"
                                id="add-option-button"
                                class="education-admin-content-primary-button"
                            >

                                <i class="fa-solid fa-plus"></i>

                                {{ __('education_admin.question_edit.options.add') }}

                            </button>

                        </div>



                        {{-- =================================================
                            EXISTING OPTIONS
                        ================================================== --}}

                        <div
                            class="education-admin-question-options-edit-list"
                            id="options-container"
                        >

                            @php

                                $existingOptions = $question->options
                                    ->sortBy([
                                        ['sort_order', 'asc'],
                                        ['id', 'asc']
                                    ]);

                            @endphp


                            @forelse($existingOptions as $option)

                                <div
                                    class="education-admin-question-option-edit-row"
                                    data-option-row
                                    data-existing="1"
                                >


                                    {{-- OPTION NUMBER --}}

                                    <div class="education-admin-question-option-number">

                                        {{ $loop->iteration }}

                                    </div>



                                    {{-- OPTION ID --}}

                                    <input
                                        type="hidden"
                                        name="options[{{ $option->id }}][id]"
                                        value="{{ $option->id }}"
                                    >



                                    {{-- OPTION TEXT --}}

                                    <div class="education-admin-content-field">

                                        <label>

                                            {{ __('education_admin.question_edit.options.option_text') }}

                                            <span class="required">
                                                {{ __('education_admin.question_edit.required') }}
                                            </span>

                                        </label>


                                        <input
                                            type="text"
                                            name="options[{{ $option->id }}][option]"
                                            value="{{ old(
                                                "options.{$option->id}.option",
                                                $option->option
                                            ) }}"
                                            class="education-admin-content-input"
                                            placeholder="{{ __('education_admin.question_edit.options.option_placeholder') }}"
                                        >

                                    </div>



                                    {{-- CORRECT --}}

                                    <div class="education-admin-question-option-correct-control">

                                        <label>

                                            <input
                                                type="radio"
                                                name="correct_option"
                                                value="{{ $option->id }}"
                                                {{ old(
                                                    'correct_option',
                                                    $question->options
                                                        ->where('is_correct', true)
                                                        ->first()?->id
                                                ) == $option->id ? 'checked' : '' }}
                                            >


                                            <span>

                                                <i class="fa-solid fa-check"></i>

                                                {{ __('education_admin.question_edit.options.correct_answer') }}

                                            </span>

                                        </label>

                                    </div>



                                    {{-- ACTIVE --}}

                                    <div class="education-admin-question-option-active-control">

                                        <label>

                                            <input
                                                type="checkbox"
                                                name="options[{{ $option->id }}][is_active]"
                                                value="1"
                                                {{ old(
                                                    "options.{$option->id}.is_active",
                                                    $option->is_active
                                                ) ? 'checked' : '' }}
                                            >

                                            <span>
                                                {{ __('education_admin.question_edit.options.active') }}
                                            </span>

                                        </label>

                                    </div>



                                    {{-- DELETE --}}

                                    <div
                                        style="
                                            display:flex;
                                            align-items:center;
                                            justify-content:center;
                                        "
                                    >

                                        <button
                                            type="button"
                                            class="education-admin-table-action delete remove-option-button"
                                            title="{{ __('education_admin.question_edit.options.delete') }}"
                                        >

                                            <i class="fa-solid fa-trash"></i>

                                        </button>

                                    </div>

                                </div>

                            @empty

                                <div
                                    id="no-options-message"
                                    class="education-admin-content-view-empty"
                                >

                                    <i class="fa-solid fa-list"></i>

                                    <span>
                                        {{ __('education_admin.question_edit.options.empty') }}
                                    </span>

                                </div>

                            @endforelse

                        </div>



                        {{-- =================================================
                            DELETED OPTIONS
                        ================================================== --}}

                        <div id="deleted-options-container"></div>



                        {{-- =================================================
                            OPTIONS HINT
                        ================================================== --}}

                        <small
                            class="education-admin-content-field-hint"
                            style="display:block;margin-top:18px;"
                        >

                            <i class="fa-solid fa-circle-info"></i>

                            {{ __('education_admin.question_edit.options.correct_hint') }}

                        </small>

                    </div>

                </div>



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
                                {{ __('education_admin.question_edit.settings.section_label') }}
                            </span>

                            <h3>
                                {{ __('education_admin.question_edit.settings.heading') }}
                            </h3>

                        </div>

                    </div>


                    <div class="education-admin-content-form-body">

                        <div class="education-admin-content-settings-grid">


                            {{-- POINTS --}}

                            <div class="education-admin-content-field">

                                <label for="points">

                                    {{ __('education_admin.question_edit.settings.points') }}

                                    <span class="required">
                                        {{ __('education_admin.question_edit.required') }}
                                    </span>

                                </label>


                                <div class="education-admin-content-input-icon-wrapper">

                                    <i class="fa-solid fa-star"></i>

                                    <input
                                        type="number"
                                        id="points"
                                        name="points"
                                        value="{{ old('points', $question->points) }}"
                                        min="1"
                                        class="education-admin-content-input"
                                        required
                                    >

                                </div>


                                @error('points')

                                    <small class="education-admin-content-error">
                                        {{ $message }}
                                    </small>

                                @enderror

                            </div>



                            {{-- SORT ORDER --}}

                            <div class="education-admin-content-field">

                                <label for="sort_order">

                                    {{ __('education_admin.question_edit.settings.sort_order') }}

                                    <span class="optional">
                                        {{ __('education_admin.question_edit.optional') }}
                                    </span>

                                </label>


                                <div class="education-admin-content-input-icon-wrapper">

                                    <i class="fa-solid fa-arrow-down-1-9"></i>

                                    <input
                                        type="number"
                                        id="sort_order"
                                        name="sort_order"
                                        value="{{ old('sort_order', $question->sort_order) }}"
                                        min="0"
                                        class="education-admin-content-input"
                                    >

                                </div>


                                @error('sort_order')

                                    <small class="education-admin-content-error">
                                        {{ $message }}
                                    </small>

                                @enderror

                            </div>

                        </div>

                    </div>

                </div>



                {{-- =================================================
                    ACTIONS
                ================================================== --}}

                <div class="education-admin-content-form-actions-row">

                    <button
                        type="submit"
                        class="education-admin-content-submit-button"
                    >

                        <i class="fa-solid fa-floppy-disk"></i>

                        {{ __('education_admin.question_edit.actions.save') }}

                    </button>


                    <a
                        href="{{ route(
                            'education.admin.quizzes.questions.show',
                            [$quiz, $question]
                        ) }}"
                        class="education-admin-content-cancel-button"
                    >

                        <i class="fa-solid fa-xmark"></i>

                        {{ __('education_admin.question_edit.actions.cancel') }}

                    </a>

                </div>

            </div>



            {{-- =====================================================
                SIDEBAR
            ====================================================== --}}

            <aside class="education-admin-content-form-sidebar">


                {{-- =================================================
                    QUIZ INFO
                ================================================== --}}

                <div class="education-admin-content-form-card">

                    <div class="education-admin-content-form-card-header">

                        <div class="education-admin-content-form-card-icon gold">

                            <i class="fa-solid fa-clipboard-list"></i>

                        </div>


                        <div>

                            <span>
                                {{ __('education_admin.question_edit.quiz.section_label') }}
                            </span>

                            <h3>
                                {{ __('education_admin.question_edit.quiz.title') }}
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
                    QUIZ SETTINGS
                ================================================== --}}

                <div class="education-admin-content-form-card">

                    <div class="education-admin-content-form-card-header">

                        <div class="education-admin-content-form-card-icon green">

                            <i class="fa-solid fa-chart-simple"></i>

                        </div>


                        <div>

                            <span>
                                {{ __('education_admin.question_edit.quiz_settings.section_label') }}
                            </span>

                            <h3>
                                {{ __('education_admin.question_edit.quiz_settings.title') }}
                            </h3>

                        </div>

                    </div>


                    <div class="education-admin-quiz-info-list">


                        <div class="education-admin-quiz-info-item">

                            <div>

                                <i class="fa-solid fa-percent"></i>

                                <span>
                                    {{ __('education_admin.question_edit.quiz_settings.pass_percentage') }}
                                </span>

                            </div>


                            <strong>
                                {{ $quiz->pass_percentage }}%
                            </strong>

                        </div>



                        <div class="education-admin-quiz-info-item">

                            <div>

                                <i class="fa-solid fa-repeat"></i>

                                <span>
                                    {{ __('education_admin.question_edit.quiz_settings.attempts') }}
                                </span>

                            </div>


                            <strong>

                                {{ $quiz->max_attempts ?: __('education_admin.question_edit.quiz_settings.unlimited') }}

                            </strong>

                        </div>



                        <div class="education-admin-quiz-info-item">

                            <div>

                                <i class="fa-solid fa-clock"></i>

                                <span>
                                    {{ __('education_admin.question_edit.quiz_settings.time') }}
                                </span>

                            </div>


                            <strong>

                                @if($quiz->time_limit)

                                    {{ $quiz->time_limit }}
                                    {{ __('education_admin.question_edit.quiz_settings.minutes') }}

                                @else

                                    {{ __('education_admin.question_edit.quiz_settings.unlimited') }}

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
                                {{ __('education_admin.question_edit.status.section_label') }}
                            </span>

                            <h3>
                                {{ __('education_admin.question_edit.status.title') }}
                            </h3>

                        </div>

                    </div>


                    <div class="education-admin-content-form-body">

                        <label class="education-admin-content-toggle">

                            <input
                                type="checkbox"
                                name="is_active"
                                value="1"
                                {{ old(
                                    'is_active',
                                    $question->is_active
                                ) ? 'checked' : '' }}
                            >


                            <span class="education-admin-content-toggle-slider"></span>


                            <span class="education-admin-content-toggle-text">

                                <strong>
                                    {{ __('education_admin.question_edit.status.active_title') }}
                                </strong>

                                <small>
                                    {{ __('education_admin.question_edit.status.active_description') }}
                                </small>

                            </span>

                        </label>

                    </div>

                </div>



                {{-- =================================================
                    CURRENT QUESTION
                ================================================== --}}

                <div class="education-admin-content-note">

                    <div class="education-admin-content-note-icon">

                        <i class="fa-solid fa-circle-info"></i>

                    </div>


                    <div>

                        <strong>
                            {{ __('education_admin.question_edit.current.title') }}
                        </strong>


                        <p>

                            {{ __('education_admin.question_edit.current.description_before') }}

                            <strong>
                                #{{ $question->id }}
                            </strong>

                            {{ __('education_admin.question_edit.current.description_after') }}

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

    const form = document.getElementById('question-edit-form');

    const optionsContainer = document.getElementById('options-container');

    const deletedOptionsContainer = document.getElementById(
        'deleted-options-container'
    );

    const addOptionButton = document.getElementById(
        'add-option-button'
    );

    const optionsCard = document.getElementById(
        'answer-options-card'
    );


    let newOptionIndex = 0;



    /* =========================================================
        GET CURRENT QUESTION TYPE
    ========================================================== */

    function getSelectedType() {

        const selected = document.querySelector(
            'input[name="type"]:checked'
        );

        return selected ? selected.value : null;

    }



    /* =========================================================
        UPDATE OPTION VISIBILITY
    ========================================================== */

    function updateOptionsVisibility() {

        const type = getSelectedType();

        if (
            type === 'multiple_choice' ||
            type === 'true_false'
        ) {

            optionsCard.style.display = '';

            addOptionButton.style.display = '';

        } else {

            optionsCard.style.display = 'none';

        }

    }



    /* =========================================================
        ADD NEW OPTION
    ========================================================== */

    function addNewOption() {

        const index = newOptionIndex++;

        const row = document.createElement('div');

        row.className =
            'education-admin-question-option-edit-row';

        row.setAttribute(
            'data-option-row',
            ''
        );

        row.setAttribute(
            'data-new',
            '1'
        );

        row.innerHTML = `

            <div class="education-admin-question-option-number">
                #
            </div>


            <div class="education-admin-content-field">

                <label>

                    {{ __('education_admin.question_edit.options.option_text') }}

                    <span class="required">
                        {{ __('education_admin.question_edit.required') }}
                    </span>

                </label>


                <input
                    type="text"
                    name="new_options[${index}][option]"
                    class="education-admin-content-input"
                    placeholder="{{ __('education_admin.question_edit.options.new_option_placeholder') }}"
                    required
                >

            </div>


            <div class="education-admin-question-option-correct-control">

                <label>

                    <input
                        type="radio"
                        name="correct_option"
                        value="new_${index}"
                    >

                    <span>

                        <i class="fa-solid fa-check"></i>

                        {{ __('education_admin.question_edit.options.correct_answer') }}

                    </span>

                </label>

            </div>


            <div class="education-admin-question-option-active-control">

                <label>

                    <input
                        type="checkbox"
                        name="new_options[${index}][is_active]"
                        value="1"
                        checked
                    >

                    <span>
                        {{ __('education_admin.question_edit.options.active') }}
                    </span>

                </label>

            </div>


            <div
                style="
                    display:flex;
                    align-items:center;
                    justify-content:center;
                "
            >

                <button
                    type="button"
                    class="education-admin-table-action delete remove-option-button"
                    title="{{ __('education_admin.question_edit.options.remove') }}"
                >

                    <i class="fa-solid fa-trash"></i>

                </button>

            </div>

        `;


        optionsContainer.appendChild(row);

        updateOptionNumbers();

    }



    /* =========================================================
        UPDATE OPTION NUMBERS
    ========================================================== */

    function updateOptionNumbers() {

        const rows = optionsContainer.querySelectorAll(
            '[data-option-row]'
        );

        rows.forEach(function (row, index) {

            const number =
                row.querySelector(
                    '.education-admin-question-option-number'
                );

            if (number) {

                number.textContent = index + 1;

            }

        });

    }



    /* =========================================================
        REMOVE OPTION
    ========================================================== */

    optionsContainer.addEventListener(
        'click',
        function (event) {

            const button =
                event.target.closest(
                    '.remove-option-button'
                );

            if (!button) {
                return;
            }


            const row =
                button.closest(
                    '[data-option-row]'
                );

            if (!row) {
                return;
            }


            const isExisting =
                row.dataset.existing === '1';


            if (isExisting) {

                const idInput =
                    row.querySelector(
                        'input[name$="[id]"]'
                    );


                if (idInput) {

                    const deleteInput =
                        document.createElement('input');

                    deleteInput.type = 'hidden';

                    deleteInput.name =
                        'delete_options[]';

                    deleteInput.value =
                        idInput.value;


                    deletedOptionsContainer.appendChild(
                        deleteInput
                    );

                }

            }


            row.remove();

            updateOptionNumbers();

        }
    );



    /* =========================================================
        ADD BUTTON
    ========================================================== */

    if (addOptionButton) {

        addOptionButton.addEventListener(
            'click',
            function () {

                addNewOption();

            }
        );

    }



    /* =========================================================
        QUESTION TYPE CHANGE
    ========================================================== */

    document
        .querySelectorAll('input[name="type"]')
        .forEach(function (radio) {

            radio.addEventListener(
                'change',
                function () {

                    updateOptionsVisibility();

                }
            );

        });



    /* =========================================================
        INITIALIZE
    ========================================================== */

    updateOptionsVisibility();

    updateOptionNumbers();

});

</script>

@endsection
