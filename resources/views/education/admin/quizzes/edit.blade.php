@extends('education.admin.layouts.app')

@section('title', __('education_admin.quiz_edit.page_title'))

@section('content')

<div class="education-admin-content-create-page">

    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}

    <div class="education-admin-content-create-header">

        <div class="education-admin-content-create-heading">

            <span class="education-admin-page-header-label">

                <i class="fa-solid fa-pen-to-square"></i>

                {{ __('education_admin.quiz_edit.header_label') }}

            </span>


            <div class="education-admin-content-title-row">

                <div class="education-admin-content-title-icon">

                    <i class="fa-solid fa-clipboard-question"></i>

                </div>


                <div>

                    <h2>
                        {{ __('education_admin.quiz_edit.page_title') }}
                    </h2>


                    <span class="education-admin-content-lesson-name">

                        <i class="fa-solid fa-clipboard-list"></i>

                        {{ $quiz->title }}

                    </span>

                </div>

            </div>


            <p>
                {{ __('education_admin.quiz_edit.description') }}
            </p>

        </div>


        {{-- HEADER ACTIONS --}}

        <div class="education-admin-content-header-actions">

            <a
                href="{{ route(
                    'education.admin.quizzes.show',
                    $quiz
                ) }}"
                class="education-admin-content-back-button"
            >

                <i class="fa-solid fa-arrow-right"></i>

                {{ __('education_admin.quiz_edit.actions.back') }}

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
                    {{ __('education_admin.quiz_edit.alerts.validation_title') }}
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
            'education.admin.quizzes.update',
            $quiz
        ) }}"
        method="POST"
    >

        @csrf

        @method('PUT')


        <div class="education-admin-content-form-grid">


            {{-- =====================================================
                MAIN COLUMN
            ====================================================== --}}

            <div class="education-admin-content-form-main">


                {{-- =================================================
                    BASIC INFORMATION
                ================================================== --}}

                <div class="education-admin-content-form-card">

                    <div class="education-admin-content-form-card-header">

                        <div class="education-admin-content-form-card-icon">

                            <i class="fa-solid fa-circle-info"></i>

                        </div>


                        <div>

                            <span>
                                {{ __('education_admin.quiz_edit.basic.title') }}
                            </span>

                            <h3>
                                {{ __('education_admin.quiz_edit.basic.heading') }}
                            </h3>

                        </div>

                    </div>


                    <div class="education-admin-content-form-body">


                        {{-- TITLE --}}

                        <div class="education-admin-content-field">

                            <label for="title">

                                {{ __('education_admin.quiz_edit.fields.title') }}

                                <span class="required">
                                    {{ __('education_admin.quiz_edit.required') }}
                                </span>

                            </label>


                            <input
                                type="text"
                                id="title"
                                name="title"
                                value="{{ old(
                                    'title',
                                    $quiz->title
                                ) }}"
                                class="education-admin-content-input"
                                placeholder="{{ __('education_admin.quiz_edit.fields.title_placeholder') }}"
                                required
                            >


                            @error('title')

                                <small class="education-admin-content-error">
                                    {{ $message }}
                                </small>

                            @enderror

                        </div>



                        {{-- DESCRIPTION --}}

                        <div class="education-admin-content-field">

                            <label for="description">

                                {{ __('education_admin.quiz_edit.fields.description') }}

                                <span class="optional">
                                    {{ __('education_admin.quiz_edit.optional') }}
                                </span>

                            </label>


                            <textarea
                                id="description"
                                name="description"
                                rows="5"
                                class="education-admin-content-input education-admin-content-textarea"
                                placeholder="{{ __('education_admin.quiz_edit.fields.description_placeholder') }}"
                            >{{ old(
                                'description',
                                $quiz->description
                            ) }}</textarea>


                            @error('description')

                                <small class="education-admin-content-error">
                                    {{ $message }}
                                </small>

                            @enderror

                        </div>

                    </div>

                </div>



                {{-- =================================================
                    LESSON TYPE
                ================================================== --}}

                <div class="education-admin-content-form-card">

                    <div class="education-admin-content-form-card-header">

                        <div class="education-admin-content-form-card-icon gold">

                            <i class="fa-solid fa-link"></i>

                        </div>


                        <div>

                            <span>
                                {{ __('education_admin.quiz_edit.lesson_type.section_label') }}
                            </span>

                            <h3>
                                {{ __('education_admin.quiz_edit.lesson_type.heading') }}
                            </h3>

                        </div>

                    </div>


                    <div class="education-admin-content-form-body">


                        {{-- LESSON TYPE --}}

                        <div class="education-admin-content-field">

                            <label for="lesson_type">

                                {{ __('education_admin.quiz_edit.lesson_type.label') }}

                                <span class="required">
                                    {{ __('education_admin.quiz_edit.required') }}
                                </span>

                            </label>


                            @php

                                $currentLessonType =
                                    old(
                                        'lesson_type',
                                        $quiz->lesson_type
                                    );

                            @endphp


                            <div
                                class="education-admin-quiz-type-selector"
                                id="educationQuizLessonType"
                            >


                                {{-- GENERAL --}}

                                <label
                                    class="education-admin-quiz-type-option"
                                    for="lesson_type_general"
                                >

                                    <input
                                        type="radio"
                                        id="lesson_type_general"
                                        name="lesson_type"
                                        value="general"
                                        {{ $currentLessonType === 'general'
                                            ? 'checked'
                                            : '' }}
                                    >


                                    <div class="education-admin-quiz-type-card">

                                        <div class="education-admin-quiz-type-icon">

                                            <i class="fa-solid fa-book-open"></i>

                                        </div>


                                        <div>

                                            <strong>
                                                {{ __('education_admin.quiz_edit.lesson_type.general.title') }}
                                            </strong>

                                            <span>
                                                {{ __('education_admin.quiz_edit.lesson_type.general.description') }}
                                            </span>

                                        </div>

                                    </div>

                                </label>



                                {{-- STUDENT --}}

                                <label
                                    class="education-admin-quiz-type-option"
                                    for="lesson_type_student"
                                >

                                    <input
                                        type="radio"
                                        id="lesson_type_student"
                                        name="lesson_type"
                                        value="student"
                                        {{ $currentLessonType === 'student'
                                            ? 'checked'
                                            : '' }}
                                    >


                                    <div class="education-admin-quiz-type-card">

                                        <div class="education-admin-quiz-type-icon student">

                                            <i class="fa-solid fa-user-graduate"></i>

                                        </div>


                                        <div>

                                            <strong>
                                                {{ __('education_admin.quiz_edit.lesson_type.student.title') }}
                                            </strong>

                                            <span>
                                                {{ __('education_admin.quiz_edit.lesson_type.student.description') }}
                                            </span>

                                        </div>

                                    </div>

                                </label>

                            </div>


                            @error('lesson_type')

                                <small class="education-admin-content-error">
                                    {{ $message }}
                                </small>

                            @enderror

                        </div>



                        {{-- =================================================
                            GENERAL LESSON
                        ================================================== --}}

                        <div
                            class="education-admin-content-field quiz-lesson-selector"
                            id="generalLessonWrapper"
                        >

                            <label for="education_lesson_id">

                                {{ __('education_admin.quiz_edit.lesson_type.general_lesson.label') }}

                                <span class="required">
                                    {{ __('education_admin.quiz_edit.required') }}
                                </span>

                            </label>


                            <div class="education-admin-content-input-icon-wrapper">

                                <i class="fa-solid fa-book-open"></i>


                                <select
                                    id="education_lesson_id"
                                    name="education_lesson_id"
                                    class="education-admin-content-input"
                                >

                                    <option value="">
                                        {{ __('education_admin.quiz_edit.lesson_type.general_lesson.placeholder') }}
                                    </option>


                                    @foreach($lessons as $lesson)

                                        <option
                                            value="{{ $lesson->id }}"
                                            {{ old(
                                                'education_lesson_id',
                                                $quiz->education_lesson_id
                                            ) == $lesson->id
                                                ? 'selected'
                                                : '' }}
                                        >

                                            {{ $lesson->title }}

                                        </option>

                                    @endforeach

                                </select>

                            </div>


                            <small class="education-admin-content-field-hint">

                                {{ __('education_admin.quiz_edit.lesson_type.general_lesson.hint') }}

                            </small>


                            @error('education_lesson_id')

                                <small class="education-admin-content-error">
                                    {{ $message }}
                                </small>

                            @enderror

                        </div>



                        {{-- =================================================
                            STUDENT LESSON
                        ================================================== --}}

                        <div
                            class="education-admin-content-field quiz-lesson-selector"
                            id="studentLessonWrapper"
                        >

                            <label for="education_student_lesson_id">

                                {{ __('education_admin.quiz_edit.lesson_type.student_lesson.label') }}

                                <span class="required">
                                    {{ __('education_admin.quiz_edit.required') }}
                                </span>

                            </label>


                            <div class="education-admin-content-input-icon-wrapper">

                                <i class="fa-solid fa-user-graduate"></i>


                                <select
                                    id="education_student_lesson_id"
                                    name="education_student_lesson_id"
                                    class="education-admin-content-input"
                                >

                                    <option value="">
                                        {{ __('education_admin.quiz_edit.lesson_type.student_lesson.placeholder') }}
                                    </option>


                                    @foreach($studentLessons as $studentLesson)

                                        <option
                                            value="{{ $studentLesson->id }}"
                                            {{ old(
                                                'education_student_lesson_id',
                                                $quiz->education_student_lesson_id
                                            ) == $studentLesson->id
                                                ? 'selected'
                                                : '' }}
                                        >

                                            {{ $studentLesson->title }}

                                            @if($studentLesson->student)

                                                —
                                                {{ $studentLesson->student->name }}

                                            @endif

                                        </option>

                                    @endforeach

                                </select>

                            </div>


                            <small class="education-admin-content-field-hint">

                                {{ __('education_admin.quiz_edit.lesson_type.student_lesson.hint') }}

                            </small>


                            @error('education_student_lesson_id')

                                <small class="education-admin-content-error">
                                    {{ $message }}
                                </small>

                            @enderror

                        </div>


                        {{-- INFO --}}

                        <div class="education-admin-form-info-box">

                            <i class="fa-solid fa-circle-info"></i>

                            <p id="quizLessonTypeInfo">

                                @if($currentLessonType === 'student')

                                    {{ __('education_admin.quiz_edit.lesson_type.info.student') }}

                                @else

                                    {{ __('education_admin.quiz_edit.lesson_type.info.general') }}

                                @endif

                            </p>

                        </div>

                    </div>

                </div>



                {{-- =================================================
                    QUIZ SETTINGS
                ================================================== --}}

                <div class="education-admin-content-form-card">

                    <div class="education-admin-content-form-card-header">

                        <div class="education-admin-content-form-card-icon green">

                            <i class="fa-solid fa-sliders"></i>

                        </div>


                        <div>

                            <span>
                                {{ __('education_admin.quiz_edit.settings.section_label') }}
                            </span>

                            <h3>
                                {{ __('education_admin.quiz_edit.settings.heading') }}
                            </h3>

                        </div>

                    </div>


                    <div class="education-admin-content-form-body">

                        <div class="education-admin-content-settings-grid">


                            {{-- PASS PERCENTAGE --}}

                            <div class="education-admin-content-field">

                                <label for="pass_percentage">

                                    {{ __('education_admin.quiz_edit.settings.pass_percentage') }}

                                    <span class="required">
                                        {{ __('education_admin.quiz_edit.required') }}
                                    </span>

                                </label>


                                <div class="education-admin-content-input-icon-wrapper">

                                    <i class="fa-solid fa-percent"></i>

                                    <input
                                        type="number"
                                        id="pass_percentage"
                                        name="pass_percentage"
                                        value="{{ old(
                                            'pass_percentage',
                                            $quiz->pass_percentage
                                        ) }}"
                                        min="1"
                                        max="100"
                                        class="education-admin-content-input"
                                        required
                                    >

                                </div>


                                @error('pass_percentage')

                                    <small class="education-admin-content-error">
                                        {{ $message }}
                                    </small>

                                @enderror

                            </div>



                            {{-- MAX ATTEMPTS --}}

                            <div class="education-admin-content-field">

                                <label for="max_attempts">

                                    {{ __('education_admin.quiz_edit.settings.max_attempts') }}

                                    <span class="optional">
                                        {{ __('education_admin.quiz_edit.optional') }}
                                    </span>

                                </label>


                                <div class="education-admin-content-input-icon-wrapper">

                                    <i class="fa-solid fa-repeat"></i>

                                    <input
                                        type="number"
                                        id="max_attempts"
                                        name="max_attempts"
                                        value="{{ old(
                                            'max_attempts',
                                            $quiz->max_attempts
                                        ) }}"
                                        min="1"
                                        class="education-admin-content-input"
                                        placeholder="{{ __('education_admin.quiz_edit.settings.max_attempts_placeholder') }}"
                                    >

                                </div>


                                <small class="education-admin-content-field-hint">

                                    {{ __('education_admin.quiz_edit.settings.max_attempts_hint') }}

                                </small>


                                @error('max_attempts')

                                    <small class="education-admin-content-error">
                                        {{ $message }}
                                    </small>

                                @enderror

                            </div>



                            {{-- TIME LIMIT --}}

                            <div class="education-admin-content-field">

                                <label for="time_limit">

                                    {{ __('education_admin.quiz_edit.settings.time_limit') }}

                                    <span class="optional">
                                        {{ __('education_admin.quiz_edit.optional') }}
                                    </span>

                                </label>


                                <div class="education-admin-content-input-icon-wrapper">

                                    <i class="fa-solid fa-clock"></i>

                                    <input
                                        type="number"
                                        id="time_limit"
                                        name="time_limit"
                                        value="{{ old(
                                            'time_limit',
                                            $quiz->time_limit
                                        ) }}"
                                        min="1"
                                        class="education-admin-content-input"
                                        placeholder="{{ __('education_admin.quiz_edit.settings.time_limit_placeholder') }}"
                                    >

                                </div>


                                <small class="education-admin-content-field-hint">

                                    {{ __('education_admin.quiz_edit.settings.time_limit_hint') }}

                                </small>


                                @error('time_limit')

                                    <small class="education-admin-content-error">
                                        {{ $message }}
                                    </small>

                                @enderror

                            </div>



                            {{-- SORT ORDER --}}

                            <div class="education-admin-content-field">

                                <label for="sort_order">

                                    {{ __('education_admin.quiz_edit.settings.sort_order') }}

                                    <span class="optional">
                                        {{ __('education_admin.quiz_edit.optional') }}
                                    </span>

                                </label>


                                <div class="education-admin-content-input-icon-wrapper">

                                    <i class="fa-solid fa-arrow-down-1-9"></i>

                                    <input
                                        type="number"
                                        id="sort_order"
                                        name="sort_order"
                                        value="{{ old(
                                            'sort_order',
                                            $quiz->sort_order ?? 0
                                        ) }}"
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

                        {{ __('education_admin.quiz_edit.actions.save') }}

                    </button>


                    <a
                        href="{{ route(
                            'education.admin.quizzes.show',
                            $quiz
                        ) }}"
                        class="education-admin-content-cancel-button"
                    >

                        <i class="fa-solid fa-xmark"></i>

                        {{ __('education_admin.quiz_edit.actions.cancel') }}

                    </a>

                </div>

            </div>



            {{-- =====================================================
                SIDEBAR
            ====================================================== --}}

            <aside class="education-admin-content-form-sidebar">


                {{-- =================================================
                    CURRENT QUIZ
                ================================================== --}}

                <div class="education-admin-content-form-card">

                    <div class="education-admin-content-form-card-header">

                        <div class="education-admin-content-form-card-icon gold">

                            <i class="fa-solid fa-clipboard-question"></i>

                        </div>


                        <div>

                            <span>
                                {{ __('education_admin.quiz_edit.sidebar.quiz_label') }}
                            </span>

                            <h3>
                                {{ __('education_admin.quiz_edit.sidebar.current_info') }}
                            </h3>

                        </div>

                    </div>


                    <div class="education-admin-quiz-summary">

                        <div class="education-admin-quiz-summary-icon">

                            <i class="fa-solid fa-clipboard-list"></i>

                        </div>


                        <strong>
                            {{ $quiz->title }}
                        </strong>


                        @if($quiz->isGeneral() && $quiz->lesson)

                            <span>

                                <i class="fa-solid fa-book-open"></i>

                                {{ $quiz->lesson->title }}

                            </span>

                            <small>
                                <i class="fa-solid fa-globe"></i>
                                {{ __('education_admin.quiz_edit.sidebar.general_quiz') }}
                            </small>

                        @elseif($quiz->isForStudent() && $quiz->studentLesson)

                            <span>

                                <i class="fa-solid fa-user-graduate"></i>

                                {{ $quiz->studentLesson->title }}

                            </span>

                            @if($quiz->studentLesson->student)

                                <small>

                                    <i class="fa-solid fa-user"></i>

                                    {{ $quiz->studentLesson->student->name }}

                                </small>

                            @endif

                        @endif

                    </div>

                </div>



                {{-- =================================================
                    STATUS
                ================================================== --}}

                <div class="education-admin-content-form-card">

                    <div class="education-admin-content-form-card-header">

                        <div class="education-admin-content-form-card-icon green">

                            <i class="fa-solid fa-toggle-on"></i>

                        </div>


                        <div>

                            <span>
                                {{ __('education_admin.quiz_edit.status.section_label') }}
                            </span>

                            <h3>
                                {{ __('education_admin.quiz_edit.status.heading') }}
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
                                    $quiz->is_active
                                ) ? 'checked' : '' }}
                            >


                            <span class="education-admin-content-toggle-slider"></span>


                            <span class="education-admin-content-toggle-text">

                                <strong>
                                    {{ __('education_admin.quiz_edit.status.active_title') }}
                                </strong>

                                <small>
                                    {{ __('education_admin.quiz_edit.status.active_description') }}
                                </small>

                            </span>

                        </label>

                    </div>

                </div>



                {{-- =================================================
                    CURRENT STATISTICS
                ================================================== --}}

                <div class="education-admin-content-form-card">

                    <div class="education-admin-content-form-card-header">

                        <div class="education-admin-content-form-card-icon">

                            <i class="fa-solid fa-chart-simple"></i>

                        </div>


                        <div>

                            <span>
                                {{ __('education_admin.quiz_edit.statistics.section_label') }}
                            </span>

                            <h3>
                                {{ __('education_admin.quiz_edit.statistics.heading') }}
                            </h3>

                        </div>

                    </div>


                    <div class="education-admin-quiz-info-list">


                        <div class="education-admin-quiz-info-item">

                            <div>

                                <i class="fa-solid fa-list-check"></i>

                                <span>
                                    {{ __('education_admin.quiz_edit.statistics.questions') }}
                                </span>

                            </div>


                            <strong>
                                {{ $quiz->questions()->count() }}
                            </strong>

                        </div>



                        <div class="education-admin-quiz-info-item">

                            <div>

                                <i class="fa-solid fa-star"></i>

                                <span>
                                    {{ __('education_admin.quiz_edit.statistics.total_points') }}
                                </span>

                            </div>


                            <strong>
                                {{ $quiz->questions()->sum('points') }}
                            </strong>

                        </div>



                        <div class="education-admin-quiz-info-item">

                            <div>

                                <i class="fa-solid fa-percent"></i>

                                <span>
                                    {{ __('education_admin.quiz_edit.statistics.pass_percentage') }}
                                </span>

                            </div>


                            <strong>
                                {{ $quiz->pass_percentage }}%
                            </strong>

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
                            {{ __('education_admin.quiz_edit.note.title') }}
                        </strong>

                        <p>
                            {{ __('education_admin.quiz_edit.note.description') }}
                        </p>

                    </div>

                </div>

            </aside>

        </div>

    </form>

</div>



{{-- =========================================================
    TYPE SWITCHING
========================================================== --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const generalRadio =
        document.getElementById('lesson_type_general');

    const studentRadio =
        document.getElementById('lesson_type_student');

    const generalWrapper =
        document.getElementById('generalLessonWrapper');

    const studentWrapper =
        document.getElementById('studentLessonWrapper');

    const generalSelect =
        document.getElementById('education_lesson_id');

    const studentSelect =
        document.getElementById('education_student_lesson_id');

    const info =
        document.getElementById('quizLessonTypeInfo');


    function updateLessonType() {

        const type =
            document.querySelector(
                'input[name="lesson_type"]:checked'
            )?.value;


        if (type === 'student') {

            generalWrapper.style.display = 'none';

            studentWrapper.style.display = 'block';

            generalSelect.removeAttribute('required');

            studentSelect.setAttribute(
                'required',
                'required'
            );


            /*
            |----------------------------------------------------------
            | Clear general lesson
            |----------------------------------------------------------
            */

            generalSelect.value = '';


            info.innerHTML = `
                {{ __('education_admin.quiz_edit.lesson_type.info.student') }}
            `;

        } else {

            generalWrapper.style.display = 'block';

            studentWrapper.style.display = 'none';

            studentSelect.removeAttribute('required');

            generalSelect.setAttribute(
                'required',
                'required'
            );


            /*
            |----------------------------------------------------------
            | Clear student lesson
            |----------------------------------------------------------
            */

            studentSelect.value = '';


            info.innerHTML = `
                {{ __('education_admin.quiz_edit.lesson_type.info.general') }}
            `;
        }

    }


    if (generalRadio) {

        generalRadio.addEventListener(
            'change',
            updateLessonType
        );

    }


    if (studentRadio) {

        studentRadio.addEventListener(
            'change',
            updateLessonType
        );

    }


    /*
    |------------------------------------------------------------------
    | INITIAL STATE
    |------------------------------------------------------------------
    */

    updateLessonType();

});

</script>

@endsection
