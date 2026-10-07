@extends('education.admin.layouts.app')

@section('page_title', __('education_admin.students_create.page_title'))

@section('title', __('education_admin.students_create.page_title'))

@section('content')

<div class="education-admin-student-create-page">

{{-- ==================================================
    PAGE HEADER
================================================== --}}

<div class="education-admin-student-create-header">

    <div class="education-admin-student-create-heading">

        <a
            href="{{ route('education.admin.students.index') }}"
            class="education-admin-student-back"
        >
            <i class="fa-solid fa-arrow-right"></i>

            <span>
                {{ __('education_admin.students_create.header.back') }}
            </span>
        </a>

        <span class="education-admin-page-header-label">
            {{ __('education_admin.students_create.header.eyebrow') }}
        </span>

        <h2>
            {{ __('education_admin.students_create.header.title') }}
        </h2>

        <p>
            {{ __('education_admin.students_create.header.description') }}
        </p>

    </div>

</div>


{{-- ==================================================
    VALIDATION ERRORS
================================================== --}}

@if($errors->any())

    <div class="education-admin-alert education-admin-alert-error">

        <i class="fa-solid fa-circle-exclamation"></i>

        <div>

            <strong>
                {{ __('education_admin.students_create.validation.title') }}
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


{{-- ==================================================
    CREATE FORM
================================================== --}}

<form
    action="{{ route('education.admin.students.store') }}"
    method="POST"
    class="education-admin-student-create-form"
>

    @csrf


    {{-- ==================================================
        BASIC INFORMATION
    ================================================== --}}

    <div class="education-admin-student-form-card">

        <div class="education-admin-student-form-card-header">

            <div>

                <span>
                    {{ __('education_admin.students_create.basic.eyebrow') }}
                </span>

                <h3>
                    {{ __('education_admin.students_create.basic.title') }}
                </h3>

            </div>

            <div class="education-admin-student-form-card-icon">

                <i class="fa-solid fa-user-graduate"></i>

            </div>

        </div>


        <div class="education-admin-student-form-grid">


            {{-- NAME --}}

            <div class="education-admin-student-form-field full">

                <label for="student-name">

                    {{ __('education_admin.students_create.fields.name.label') }}

                    <span>
                        *
                    </span>

                </label>

                <div class="education-admin-student-input-wrapper">

                    <i class="fa-solid fa-user"></i>

                    <input
                        id="student-name"
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="{{ __('education_admin.students_create.fields.name.placeholder') }}"
                        maxlength="255"
                        required
                    >

                </div>

                @error('name')

                    <small class="education-admin-student-form-error">
                        {{ $message }}
                    </small>

                @enderror

            </div>


            {{-- EMAIL --}}

            <div class="education-admin-student-form-field">

                <label for="student-email">
                    {{ __('education_admin.students_create.fields.email.label') }}
                </label>

                <div class="education-admin-student-input-wrapper">

                    <i class="fa-regular fa-envelope"></i>

                    <input
                        id="student-email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="{{ __('education_admin.students_create.fields.email.placeholder') }}"
                        maxlength="255"
                        dir="ltr"
                    >

                </div>

                @error('email')

                    <small class="education-admin-student-form-error">
                        {{ $message }}
                    </small>

                @enderror

            </div>


            {{-- PHONE --}}

            <div class="education-admin-student-form-field">

                <label for="student-phone">
                    {{ __('education_admin.students_create.fields.phone.label') }}
                </label>

                <div class="education-admin-student-input-wrapper">

                    <i class="fa-solid fa-phone"></i>

                    <input
                        id="student-phone"
                        type="text"
                        name="phone"
                        value="{{ old('phone') }}"
                        placeholder="{{ __('education_admin.students_create.fields.phone.placeholder') }}"
                        maxlength="30"
                        dir="ltr"
                    >

                </div>

                @error('phone')

                    <small class="education-admin-student-form-error">
                        {{ $message }}
                    </small>

                @enderror

            </div>


            {{-- WHATSAPP --}}

            <div class="education-admin-student-form-field">

                <label for="student-whatsapp">

                    {{ __('education_admin.students_create.fields.whatsapp.label') }}

                </label>

                <div class="education-admin-student-input-wrapper">

                    <i class="fa-brands fa-whatsapp"></i>

                    <input
                        id="student-whatsapp"
                        type="text"
                        name="whatsapp_number"
                        value="{{ old('whatsapp_number') }}"
                        placeholder="{{ __('education_admin.students_create.fields.whatsapp.placeholder') }}"
                        maxlength="30"
                        dir="ltr"
                    >

                </div>

                @error('whatsapp_number')

                    <small class="education-admin-student-form-error">
                        {{ $message }}
                    </small>

                @enderror

            </div>


            {{-- WHATSAPP REMINDERS --}}

            <div class="education-admin-student-form-field">

                <label class="education-admin-student-checkbox-field">

                    <input
                        type="checkbox"
                        name="whatsapp_reminders_enabled"
                        value="1"
                        @checked(old('whatsapp_reminders_enabled', false))
                    >

                    <span>
                        {{ __('education_admin.students_create.fields.whatsapp_reminders.label') }}
                    </span>

                </label>

                <small
                    style="
                        display:block;
                        margin-top:7px;
                        color:#8e8e8e;
                        font-size:12px;
                        line-height:1.7;
                    "
                >
                    {{ __('education_admin.students_create.fields.whatsapp_reminders.description') }}
                </small>

                @error('whatsapp_reminders_enabled')

                    <small class="education-admin-student-form-error">
                        {{ $message }}
                    </small>

                @enderror

            </div>

        </div>

    </div>


    {{-- ==================================================
        EDUCATIONAL INFORMATION
    ================================================== --}}

    <div class="education-admin-student-form-card">

        <div class="education-admin-student-form-card-header">

            <div>

                <span>
                    {{ __('education_admin.students_create.education.eyebrow') }}
                </span>

                <h3>
                    {{ __('education_admin.students_create.education.title') }}
                </h3>

            </div>

            <div class="education-admin-student-form-card-icon education">

                <i class="fa-solid fa-graduation-cap"></i>

            </div>

        </div>


        <div class="education-admin-student-form-grid">


            {{-- EDUCATION LEVEL --}}

            <div class="education-admin-student-form-field full">

                <label for="education-level">
                    {{ __('education_admin.students_create.fields.education_level.label') }}
                </label>

                <div class="education-admin-student-input-wrapper">

                    <i class="fa-solid fa-graduation-cap"></i>

                    <input
                        id="education-level"
                        type="text"
                        name="education_level"
                        value="{{ old('education_level') }}"
                        placeholder="{{ __('education_admin.students_create.fields.education_level.placeholder') }}"
                        maxlength="255"
                    >

                </div>

                @error('education_level')

                    <small class="education-admin-student-form-error">
                        {{ $message }}
                    </small>

                @enderror

            </div>


            {{-- LEARNING GOAL --}}

            <div class="education-admin-student-form-field full">

                <label for="learning-goal">
                    {{ __('education_admin.students_create.fields.learning_goal.label') }}
                </label>

                <div class="education-admin-student-textarea-wrapper">

                    <i class="fa-solid fa-bullseye"></i>

                    <textarea
                        id="learning-goal"
                        name="learning_goal"
                        rows="6"
                        placeholder="{{ __('education_admin.students_create.fields.learning_goal.placeholder') }}"
                    >{{ old('learning_goal') }}</textarea>

                </div>

                @error('learning_goal')

                    <small class="education-admin-student-form-error">
                        {{ $message }}
                    </small>

                @enderror

            </div>

        </div>

    </div>


    {{-- ==================================================
        ACCOUNT INFORMATION
    ================================================== --}}

    <div class="education-admin-student-form-card">

        <div class="education-admin-student-form-card-header">

            <div>

                <span>
                    {{ __('education_admin.students_create.account.eyebrow') }}
                </span>

                <h3>
                    {{ __('education_admin.students_create.account.title') }}
                </h3>

            </div>

            <div class="education-admin-student-form-card-icon">

                <i class="fa-solid fa-lock"></i>

            </div>

        </div>


        <div class="education-admin-student-form-grid">


            {{-- PASSWORD --}}

            <div class="education-admin-student-form-field">

                <label for="student-password">

                    {{ __('education_admin.students_create.fields.password.label') }}

                    <span>
                        *
                    </span>

                </label>

                <div class="education-admin-student-input-wrapper">

                    <i class="fa-solid fa-lock"></i>

                    <input
                        id="student-password"
                        type="password"
                        name="password"
                        placeholder="{{ __('education_admin.students_create.fields.password.placeholder') }}"
                        minlength="8"
                        required
                    >

                </div>

                <small
                    style="
                        display:block;
                        margin-top:7px;
                        color:#8e8e8e;
                        font-size:12px;
                        line-height:1.7;
                    "
                >
                    {{ __('education_admin.students_create.fields.password.description') }}
                </small>

                @error('password')

                    <small class="education-admin-student-form-error">
                        {{ $message }}
                    </small>

                @enderror

            </div>


            {{-- PASSWORD CONFIRMATION --}}

            <div class="education-admin-student-form-field">

                <label for="student-password-confirmation">

                    {{ __('education_admin.students_create.fields.password_confirmation.label') }}

                    <span>
                        *
                    </span>

                </label>

                <div class="education-admin-student-input-wrapper">

                    <i class="fa-solid fa-shield-halved"></i>

                    <input
                        id="student-password-confirmation"
                        type="password"
                        name="password_confirmation"
                        placeholder="{{ __('education_admin.students_create.fields.password_confirmation.placeholder') }}"
                        minlength="8"
                        required
                    >

                </div>

                @error('password_confirmation')

                    <small class="education-admin-student-form-error">
                        {{ $message }}
                    </small>

                @enderror

            </div>


            {{-- PASSWORD NOTE --}}

            <div class="education-admin-student-form-field full">

                <div
                    style="
                        display:flex;
                        align-items:flex-start;
                        gap:12px;
                        padding:14px 16px;
                        border:1px solid rgba(212,174,97,0.14);
                        border-radius:12px;
                        background:rgba(212,174,97,0.055);
                    "
                >

                    <i
                        class="fa-solid fa-circle-info"
                        style="
                            margin-top:3px;
                            color:#d4ae61;
                            font-size:14px;
                            flex-shrink:0;
                        "
                    ></i>

                    <p
                        style="
                            margin:0;
                            color:#a8a8a8;
                            font-size:12px;
                            line-height:1.8;
                        "
                    >
                        {{ __('education_admin.students_create.fields.password_note') }}
                    </p>

                </div>

            </div>

        </div>

    </div>


    {{-- ==================================================
        ACCOUNT STATUS
    ================================================== --}}

    <div class="education-admin-student-form-card">

        <div class="education-admin-student-form-card-header">

            <div>

                <span>
                    {{ __('education_admin.students_create.status.eyebrow') }}
                </span>

                <h3>
                    {{ __('education_admin.students_create.status.title') }}
                </h3>

            </div>

            <div class="education-admin-student-form-card-icon status">

                <i class="fa-solid fa-user-check"></i>

            </div>

        </div>


        <div class="education-admin-student-status-option">

            <label
                for="student-active"
                class="education-admin-student-status-toggle"
            >

                <input
                    id="student-active"
                    type="checkbox"
                    name="is_active"
                    value="1"
                    @checked(old('is_active', true))
                >

                <span class="education-admin-student-toggle-slider"></span>

                <span class="education-admin-student-status-toggle-content">

                    <strong>
                        {{ __('education_admin.students_create.status.active.label') }}
                    </strong>

                    <small>
                        {{ __('education_admin.students_create.status.active.description') }}
                    </small>

                </span>

            </label>

        </div>

    </div>


    {{-- ==================================================
        STUDENT APPROVAL INFORMATION
    ================================================== --}}

    <div class="education-admin-student-form-card">

        <div class="education-admin-student-form-card-header">

            <div>

                <span>
                    {{ __('education_admin.students_create.approval.eyebrow') }}
                </span>

                <h3>
                    {{ __('education_admin.students_create.approval.title') }}
                </h3>

            </div>

            <div class="education-admin-student-form-card-icon status">

                <i class="fa-solid fa-circle-check"></i>

            </div>

        </div>


        <div
            style="
                display:flex;
                align-items:flex-start;
                gap:14px;
                padding:16px 18px;
                border:1px solid rgba(212,174,97,0.14);
                border-radius:14px;
                background:rgba(212,174,97,0.045);
            "
        >

            <div
                style="
                    width:40px;
                    height:40px;
                    border-radius:50%;
                    display:flex;
                    align-items:center;
                    justify-content:center;
                    background:rgba(76,175,80,0.12);
                    color:#75c77a;
                    flex-shrink:0;
                "
            >

                <i class="fa-solid fa-user-check"></i>

            </div>


            <div>

                <strong
                    style="
                        display:block;
                        margin-bottom:5px;
                    "
                >
                    {{ __('education_admin.students_create.approval.auto_approved_title') }}
                </strong>

                <p
                    style="
                        margin:0;
                        color:#a8a8a8;
                        font-size:12px;
                        line-height:1.8;
                    "
                >
                    {{ __('education_admin.students_create.approval.auto_approved_description') }}

                    <strong style="color:#75c77a;">
                        {{ __('education_admin.students_create.approval.approved') }}
                    </strong>

                    {{ __('education_admin.students_create.approval.auto_approved_suffix') }}
                </p>

            </div>

        </div>

    </div>


    {{-- ==================================================
        FORM ACTIONS
    ================================================== --}}

    <div class="education-admin-student-create-footer">

        <a
            href="{{ route('education.admin.students.index') }}"
            class="education-admin-student-create-cancel"
        >

            <i class="fa-solid fa-xmark"></i>

            {{ __('education_admin.students_create.actions.cancel') }}

        </a>


        <button
            type="submit"
            class="education-admin-student-create-submit"
        >

            <i class="fa-solid fa-user-plus"></i>

            {{ __('education_admin.students_create.actions.submit') }}

        </button>

    </div>

</form>

</div>

@endsection
