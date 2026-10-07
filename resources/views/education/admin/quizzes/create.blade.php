@extends('education.admin.layouts.app')

@section('title', 'إضافة اختبار')

@section('content')

<div class="education-admin-content-page">

    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}

    <div class="education-admin-content-header">

        <div class="education-admin-content-heading">

            <span class="education-admin-page-header-label">

                <i class="fa-solid fa-clipboard-question"></i>

                إدارة التعليم

            </span>


            <div class="education-admin-content-title-row">

                <div class="education-admin-content-title-icon">

                    <i class="fa-solid fa-file-circle-plus"></i>

                </div>


                <div>

                    <h2>
                        إضافة اختبار جديد
                    </h2>

                    <span class="education-admin-content-lesson-name">

                        <i class="fa-solid fa-clipboard-list"></i>

                        الاختبارات التعليمية

                    </span>

                </div>

            </div>


            <p>
                أنشئ اختبارًا جديدًا واربطه إما بدرس عام في الموقع أو بدرس خاص بأحد الطلاب.
            </p>

        </div>


        {{-- HEADER ACTIONS --}}

        <div class="education-admin-content-header-actions">

            <a
                href="{{ route('education.admin.quizzes.index') }}"
                class="education-admin-content-cancel-button"
            >

                <i class="fa-solid fa-arrow-right"></i>

                العودة إلى الاختبارات

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
                    يرجى مراجعة البيانات
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
        action="{{ route('education.admin.quizzes.store') }}"
        method="POST"
    >

        @csrf


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
                                المعلومات الأساسية
                            </span>

                            <h3>
                                بيانات الاختبار
                            </h3>

                        </div>

                    </div>


                    <div class="education-admin-content-form-body">


                        {{-- TITLE --}}

                        <div class="education-admin-content-field">

                            <label for="title">

                                عنوان الاختبار

                                <span class="required">
                                    *
                                </span>

                            </label>


                            <div class="education-admin-input-wrapper">

                                <i class="fa-solid fa-heading"></i>

                                <input
                                    type="text"
                                    id="title"
                                    name="title"
                                    value="{{ old('title') }}"
                                    placeholder="مثال: اختبار الوحدة الأولى"
                                    required
                                >

                            </div>


                            @error('title')

                                <small class="education-admin-field-error">

                                    {{ $message }}

                                </small>

                            @enderror

                        </div>



                        {{-- DESCRIPTION --}}

                        <div class="education-admin-content-field">

                            <label for="description">

                                وصف الاختبار

                                <span class="optional">
                                    اختياري
                                </span>

                            </label>


                            <textarea
                                id="description"
                                name="description"
                                rows="5"
                                placeholder="اكتب وصفًا مختصرًا يوضح محتوى الاختبار للطلاب..."
                            >{{ old('description') }}</textarea>


                            @error('description')

                                <small class="education-admin-field-error">

                                    {{ $message }}

                                </small>

                            @enderror

                        </div>

                    </div>

                </div>



                {{-- =================================================
                    QUIZ SETTINGS
                ================================================== --}}

                <div class="education-admin-content-form-card">

                    <div class="education-admin-content-form-card-header">

                        <div class="education-admin-content-form-card-icon gold">

                            <i class="fa-solid fa-sliders"></i>

                        </div>


                        <div>

                            <span>
                                إعدادات الاختبار
                            </span>

                            <h3>
                                التحكم في الاختبار
                            </h3>

                        </div>

                    </div>


                    <div class="education-admin-content-form-body">


                        <div class="education-admin-form-two-columns">


                            {{-- PASS PERCENTAGE --}}

                            <div class="education-admin-content-field">

                                <label for="pass_percentage">

                                    نسبة النجاح

                                    <span class="required">
                                        *
                                    </span>

                                </label>


                                <div class="education-admin-input-wrapper">

                                    <i class="fa-solid fa-percent"></i>

                                    <input
                                        type="number"
                                        id="pass_percentage"
                                        name="pass_percentage"
                                        value="{{ old('pass_percentage', 60) }}"
                                        min="1"
                                        max="100"
                                        required
                                    >

                                </div>


                                <small class="education-admin-field-help">

                                    النسبة المئوية المطلوبة لاجتياز الاختبار.

                                </small>


                                @error('pass_percentage')

                                    <small class="education-admin-field-error">

                                        {{ $message }}

                                    </small>

                                @enderror

                            </div>



                            {{-- MAX ATTEMPTS --}}

                            <div class="education-admin-content-field">

                                <label for="max_attempts">

                                    عدد المحاولات

                                    <span class="optional">
                                        اختياري
                                    </span>

                                </label>


                                <div class="education-admin-input-wrapper">

                                    <i class="fa-solid fa-repeat"></i>

                                    <input
                                        type="number"
                                        id="max_attempts"
                                        name="max_attempts"
                                        value="{{ old('max_attempts') }}"
                                        min="1"
                                        placeholder="غير محدد"
                                    >

                                </div>


                                <small class="education-admin-field-help">

                                    اتركه فارغًا للسماح بمحاولات غير محدودة.

                                </small>


                                @error('max_attempts')

                                    <small class="education-admin-field-error">

                                        {{ $message }}

                                    </small>

                                @enderror

                            </div>



                            {{-- TIME LIMIT --}}

                            <div class="education-admin-content-field">

                                <label for="time_limit">

                                    مدة الاختبار

                                    <span class="optional">
                                        اختياري
                                    </span>

                                </label>


                                <div class="education-admin-input-wrapper">

                                    <i class="fa-regular fa-clock"></i>

                                    <input
                                        type="number"
                                        id="time_limit"
                                        name="time_limit"
                                        value="{{ old('time_limit') }}"
                                        min="1"
                                        placeholder="غير محدد"
                                    >

                                    <span class="education-admin-input-suffix">
                                        دقيقة
                                    </span>

                                </div>


                                <small class="education-admin-field-help">

                                    اتركه فارغًا إذا لم يكن هناك حد زمني.

                                </small>


                                @error('time_limit')

                                    <small class="education-admin-field-error">

                                        {{ $message }}

                                    </small>

                                @enderror

                            </div>



                            {{-- SORT ORDER --}}

                            <div class="education-admin-content-field">

                                <label for="sort_order">

                                    ترتيب الاختبار

                                    <span class="optional">
                                        اختياري
                                    </span>

                                </label>


                                <div class="education-admin-input-wrapper">

                                    <i class="fa-solid fa-arrow-down-1-9"></i>

                                    <input
                                        type="number"
                                        id="sort_order"
                                        name="sort_order"
                                        value="{{ old('sort_order', 0) }}"
                                        min="0"
                                    >

                                </div>


                                <small class="education-admin-field-help">

                                    يستخدم لترتيب الاختبارات داخل الدرس.

                                </small>


                                @error('sort_order')

                                    <small class="education-admin-field-error">

                                        {{ $message }}

                                    </small>

                                @enderror

                            </div>

                        </div>

                    </div>

                </div>



                {{-- =================================================
                    SUBMIT
                ================================================== --}}

                <div class="education-admin-content-form-actions">

                    <a
                        href="{{ route('education.admin.quizzes.index') }}"
                        class="education-admin-content-cancel-button"
                    >

                        <i class="fa-solid fa-xmark"></i>

                        إلغاء

                    </a>


                    <button
                        type="submit"
                        class="education-admin-content-submit-button"
                    >

                        <i class="fa-solid fa-check"></i>

                        إنشاء الاختبار

                    </button>

                </div>

            </div>



            {{-- =====================================================
                SIDEBAR
            ====================================================== --}}

            <aside class="education-admin-content-form-sidebar">


                {{-- =================================================
                    LESSON CONNECTION
                ================================================== --}}

                <div class="education-admin-content-form-card">

                    <div class="education-admin-content-form-card-header">

                        <div class="education-admin-content-form-card-icon green">

                            <i class="fa-solid fa-link"></i>

                        </div>


                        <div>

                            <span>
                                ارتباط الاختبار
                            </span>

                            <h3>
                                اختر نوع الدرس
                            </h3>

                        </div>

                    </div>


                    <div class="education-admin-content-form-body">


                        {{-- =================================================
                            LESSON TYPE
                        ================================================== --}}

                        <div class="education-admin-content-field">

                            <label>

                                نوع الدرس

                                <span class="required">
                                    *
                                </span>

                            </label>


                            <div class="education-quiz-type-options">


                                {{-- GENERAL --}}

                                <label
                                    class="education-quiz-type-option"
                                    for="lesson_type_general"
                                >

                                    <input
                                        type="radio"
                                        id="lesson_type_general"
                                        name="lesson_type"
                                        value="general"
                                        {{ old('lesson_type', 'general') === 'general' ? 'checked' : '' }}
                                    >


                                    <span class="education-quiz-type-option-icon general">

                                        <i class="fa-solid fa-book-open"></i>

                                    </span>


                                    <span class="education-quiz-type-option-content">

                                        <strong>
                                            درس عام
                                        </strong>

                                        <small>
                                            درس منشور في الموقع
                                        </small>

                                    </span>


                                    <span class="education-quiz-type-option-check">

                                        <i class="fa-solid fa-circle-check"></i>

                                    </span>

                                </label>



                                {{-- STUDENT --}}

                                <label
                                    class="education-quiz-type-option"
                                    for="lesson_type_student"
                                >

                                    <input
                                        type="radio"
                                        id="lesson_type_student"
                                        name="lesson_type"
                                        value="student"
                                        {{ old('lesson_type') === 'student' ? 'checked' : '' }}
                                    >


                                    <span class="education-quiz-type-option-icon student">

                                        <i class="fa-solid fa-user-graduate"></i>

                                    </span>


                                    <span class="education-quiz-type-option-content">

                                        <strong>
                                            درس طالب
                                        </strong>

                                        <small>
                                            درس خاص بطالب محدد
                                        </small>

                                    </span>


                                    <span class="education-quiz-type-option-check">

                                        <i class="fa-solid fa-circle-check"></i>

                                    </span>

                                </label>

                            </div>


                            @error('lesson_type')

                                <small class="education-admin-field-error">

                                    {{ $message }}

                                </small>

                            @enderror

                        </div>



                        {{-- =================================================
                            GENERAL LESSON
                        ================================================== --}}

                        <div
                            id="general-lesson-wrapper"
                            class="education-quiz-lesson-selection"
                        >

                            <div class="education-quiz-selection-header">

                                <div class="education-quiz-selection-icon general">

                                    <i class="fa-solid fa-book-open"></i>

                                </div>


                                <div>

                                    <strong>
                                        الدرس العام
                                    </strong>

                                    <span>
                                        اختر الدرس المنشور في الموقع.
                                    </span>

                                </div>

                            </div>


                            <div class="education-admin-content-field">

                                <label for="education_lesson_id">

                                    اختر الدرس

                                    <span class="required">
                                        *
                                    </span>

                                </label>


                                <select
                                    id="education_lesson_id"
                                    name="education_lesson_id"
                                >

                                    <option value="">
                                        اختر الدرس العام
                                    </option>

                                    @forelse($lessons as $lesson)

                                        <option
                                            value="{{ $lesson->id }}"
                                            {{ old('education_lesson_id') == $lesson->id ? 'selected' : '' }}
                                        >

                                            {{ $lesson->title }}

                                        </option>

                                    @empty

                                        <option value="" disabled>
                                            لا توجد دروس عامة متاحة
                                        </option>

                                    @endforelse

                                </select>


                                @error('education_lesson_id')

                                    <small class="education-admin-field-error">

                                        {{ $message }}

                                    </small>

                                @enderror

                            </div>

                        </div>



                        {{-- =================================================
                            STUDENT LESSON
                        ================================================== --}}

                        <div
                            id="student-lesson-wrapper"
                            class="education-quiz-lesson-selection"
                            style="display:none;"
                        >

                            <div class="education-quiz-selection-header">

                                <div class="education-quiz-selection-icon student">

                                    <i class="fa-solid fa-user-graduate"></i>

                                </div>


                                <div>

                                    <strong>
                                        درس الطالب
                                    </strong>

                                    <span>
                                        اختر الدرس الخاص بالطالب.
                                    </span>

                                </div>

                            </div>


                            <div class="education-admin-content-field">

                                <label for="education_student_lesson_id">

                                    اختر درس الطالب

                                    <span class="required">
                                        *
                                    </span>

                                </label>


                                <select
                                    id="education_student_lesson_id"
                                    name="education_student_lesson_id"
                                >

                                    <option value="">
                                        اختر درس الطالب
                                    </option>

                                    @forelse($studentLessons as $studentLesson)

                                        <option
                                            value="{{ $studentLesson->id }}"
                                            {{ old('education_student_lesson_id') == $studentLesson->id ? 'selected' : '' }}
                                        >

                                            {{ $studentLesson->student?->name ?? 'طالب غير محدد' }}

                                            —
                                            الجلسة
                                            {{ $studentLesson->session_number }}

                                            —
                                            {{ $studentLesson->title }}

                                        </option>

                                    @empty

                                        <option value="" disabled>
                                            لا توجد دروس خاصة بالطلاب متاحة
                                        </option>

                                    @endforelse

                                </select>


                                @error('education_student_lesson_id')

                                    <small class="education-admin-field-error">

                                        {{ $message }}

                                    </small>

                                @enderror

                            </div>


                            <div class="education-quiz-student-info-box">

                                <i class="fa-solid fa-circle-info"></i>

                                <p>
                                    هذا الاختبار سيكون خاصًا بالطالب والدرس المحدد،
                                    ولن يظهر ضمن الاختبارات العامة للموقع.
                                </p>

                            </div>

                        </div>



                        {{-- GENERAL INFO --}}

                        <div
                            id="general-lesson-info"
                            class="education-admin-form-info-box"
                        >

                            <i class="fa-solid fa-circle-info"></i>

                            <p>

                                الاختبار المرتبط بالدرس العام سيكون اختبارًا عامًا
                                يمكن عرضه مع محتوى هذا الدرس في الموقع.

                            </p>

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
                                حالة الاختبار
                            </span>

                            <h3>
                                الظهور للطلاب
                            </h3>

                        </div>

                    </div>


                    <div class="education-admin-content-form-body">

                        <label
                            class="education-admin-switch-row"
                            for="is_active"
                        >

                            <div class="education-admin-switch-info">

                                <strong>
                                    اختبار نشط
                                </strong>

                                <span>
                                    السماح بظهور الاختبار للطلاب.
                                </span>

                            </div>


                            <div class="education-admin-switch">

                                <input
                                    type="checkbox"
                                    id="is_active"
                                    name="is_active"
                                    value="1"
                                    {{ old('is_active', true) ? 'checked' : '' }}
                                >

                                <span></span>

                            </div>

                        </label>

                    </div>

                </div>



                {{-- =================================================
                    GUIDE
                ================================================== --}}

                <div class="education-admin-content-note">

                    <div class="education-admin-content-note-icon">

                        <i class="fa-solid fa-lightbulb"></i>

                    </div>


                    <div>

                        <strong>
                            بعد إنشاء الاختبار
                        </strong>

                        <p>

                            ستتمكن من إضافة الأسئلة وتحديد نوع كل سؤال
                            وإضافة الخيارات وتحديد الإجابة الصحيحة.

                        </p>

                    </div>

                </div>

            </aside>

        </div>

    </form>

</div>



{{-- =========================================================
    PAGE STYLES
========================================================== --}}

<style>

    /*
    |--------------------------------------------------------------------------
    | QUIZ TYPE OPTIONS
    |--------------------------------------------------------------------------
    */

    .education-quiz-type-options {
        display: flex;
        flex-direction: column;
        gap: 12px;
        margin-top: 10px;
    }


    .education-quiz-type-option {
        position: relative;
        display: flex;
        align-items: center;
        gap: 13px;
        padding: 15px 16px;
        border: 1px solid rgba(184, 148, 76, .18);
        border-radius: 16px;
        background: #fffdf8;
        cursor: pointer;
        transition:
            border-color .25s ease,
            background .25s ease,
            box-shadow .25s ease,
            transform .25s ease;
    }


    .education-quiz-type-option:hover {
        border-color: rgba(184, 148, 76, .45);
        transform: translateY(-1px);
        box-shadow: 0 7px 20px rgba(61, 76, 52, .07);
    }


    .education-quiz-type-option input {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }


    .education-quiz-type-option:has(input:checked) {
        border-color: rgba(184, 148, 76, .75);
        background: linear-gradient(
            135deg,
            #fffdf7,
            #f8f1df
        );
        box-shadow:
            0 8px 24px rgba(61, 76, 52, .08),
            inset 0 0 0 1px rgba(184, 148, 76, .08);
    }


    .education-quiz-type-option-icon {
        width: 43px;
        height: 43px;
        flex: 0 0 43px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 13px;
        font-size: 18px;
    }


    .education-quiz-type-option-icon.general {
        color: #6f5730;
        background: #f3e8c9;
    }


    .education-quiz-type-option-icon.student {
        color: #3f6048;
        background: #e3eee4;
    }


    .education-quiz-type-option-content {
        min-width: 0;
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 3px;
    }


    .education-quiz-type-option-content strong {
        color: #354332;
        font-size: 14px;
        font-weight: 800;
    }


    .education-quiz-type-option-content small {
        color: #8b8a80;
        font-size: 11px;
        line-height: 1.6;
    }


    .education-quiz-type-option-check {
        width: 25px;
        height: 25px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #c8c1b0;
        font-size: 17px;
        transition: color .25s ease;
    }


    .education-quiz-type-option:has(input:checked)
    .education-quiz-type-option-check {
        color: #b8944c;
    }



    /*
    |--------------------------------------------------------------------------
    | LESSON SELECTION
    |--------------------------------------------------------------------------
    */

    .education-quiz-lesson-selection {
        margin-top: 18px;
        padding: 16px;
        border: 1px solid rgba(184, 148, 76, .14);
        border-radius: 18px;
        background: #fffefa;
        animation: educationQuizFadeIn .25s ease;
    }


    .education-quiz-selection-header {
        display: flex;
        align-items: center;
        gap: 11px;
        margin-bottom: 17px;
        padding-bottom: 14px;
        border-bottom: 1px solid rgba(61, 76, 52, .08);
    }


    .education-quiz-selection-icon {
        width: 38px;
        height: 38px;
        flex: 0 0 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 11px;
    }


    .education-quiz-selection-icon.general {
        color: #71572d;
        background: #f4ead1;
    }


    .education-quiz-selection-icon.student {
        color: #3f6249;
        background: #e2eee4;
    }


    .education-quiz-selection-header > div:last-child {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }


    .education-quiz-selection-header strong {
        color: #354332;
        font-size: 13px;
        font-weight: 800;
    }


    .education-quiz-selection-header span {
        color: #99968c;
        font-size: 11px;
    }



    /*
    |--------------------------------------------------------------------------
    | STUDENT INFO
    |--------------------------------------------------------------------------
    */

    .education-quiz-student-info-box {
        display: flex;
        align-items: flex-start;
        gap: 9px;
        margin-top: 14px;
        padding: 12px 13px;
        border-radius: 13px;
        background: #f2f7f2;
        border: 1px solid rgba(63, 98, 73, .10);
    }


    .education-quiz-student-info-box > i {
        margin-top: 3px;
        color: #52765b;
        font-size: 13px;
    }


    .education-quiz-student-info-box p {
        margin: 0;
        color: #647066;
        font-size: 11px;
        line-height: 1.8;
    }



    /*
    |--------------------------------------------------------------------------
    | ANIMATION
    |--------------------------------------------------------------------------
    */

    @keyframes educationQuizFadeIn {

        from {
            opacity: 0;
            transform: translateY(-5px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }

    }



    /*
    |--------------------------------------------------------------------------
    | SELECT
    |--------------------------------------------------------------------------
    */

    .education-quiz-lesson-selection select {
        width: 100%;
        min-height: 48px;
        padding: 0 13px;
        border: 1px solid #ded9cc;
        border-radius: 12px;
        background: #fff;
        color: #3f493d;
        font-family: inherit;
        font-size: 13px;
        outline: none;
        transition:
            border-color .2s ease,
            box-shadow .2s ease;
    }


    .education-quiz-lesson-selection select:focus {
        border-color: #b8944c;
        box-shadow: 0 0 0 3px rgba(184, 148, 76, .10);
    }



    /*
    |--------------------------------------------------------------------------
    | MOBILE
    |--------------------------------------------------------------------------
    */

    @media (max-width: 700px) {

        .education-quiz-type-option {
            padding: 13px;
        }


        .education-quiz-lesson-selection {
            padding: 13px;
        }


        .education-quiz-selection-header {
            align-items: flex-start;
        }

    }

</style>



{{-- =========================================================
    PAGE SCRIPT
========================================================== --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | ELEMENTS
    |--------------------------------------------------------------------------
    */

    const generalRadio =
        document.getElementById('lesson_type_general');

    const studentRadio =
        document.getElementById('lesson_type_student');


    const generalWrapper =
        document.getElementById('general-lesson-wrapper');

    const studentWrapper =
        document.getElementById('student-lesson-wrapper');


    const generalInfo =
        document.getElementById('general-lesson-info');


    const generalSelect =
        document.getElementById('education_lesson_id');

    const studentSelect =
        document.getElementById('education_student_lesson_id');


    /*
    |--------------------------------------------------------------------------
    | UPDATE TYPE
    |--------------------------------------------------------------------------
    */

    function updateLessonType() {

        const selectedType =
            document.querySelector(
                'input[name="lesson_type"]:checked'
            )?.value;


        /*
        |----------------------------------------------------------------------
        | GENERAL
        |----------------------------------------------------------------------
        */

        if (selectedType === 'general') {

            generalWrapper.style.display = 'block';

            studentWrapper.style.display = 'none';

            generalInfo.style.display = 'flex';


            /*
            | Required
            */

            generalSelect.required = true;

            studentSelect.required = false;


            /*
            | Clear student selection
            */

            studentSelect.value = '';

        }


        /*
        |----------------------------------------------------------------------
        | STUDENT
        |----------------------------------------------------------------------
        */

        else if (selectedType === 'student') {

            generalWrapper.style.display = 'none';

            studentWrapper.style.display = 'block';

            generalInfo.style.display = 'none';


            /*
            | Required
            */

            generalSelect.required = false;

            studentSelect.required = true;


            /*
            | Clear general selection
            */

            generalSelect.value = '';

        }

    }


    /*
    |--------------------------------------------------------------------------
    | RADIO EVENTS
    |--------------------------------------------------------------------------
    */

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
    |--------------------------------------------------------------------------
    | INITIAL STATE
    |--------------------------------------------------------------------------
    |
    | مهم جدًا عند وجود validation error.
    |
    */

    updateLessonType();

});

</script>

@endsection
