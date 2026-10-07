@extends('education.admin.layouts.app')

@section('page_title', __('education_admin.student_edit.page_title'))

@section('title', __('education_admin.student_edit.page_title'))

@section('content')

<div class="education-admin-student-edit-page">


{{-- ==================================================
    PAGE HEADER
================================================== --}}

<div class="education-admin-student-edit-header">

    <div class="education-admin-student-edit-heading">

        <a
            href="{{ route('education.admin.students.show', $student) }}"
            class="education-admin-student-back"
        >
            <i class="fa-solid fa-arrow-right"></i>

            <span>
                {{ __('education_admin.student_edit.header.back_to_student') }}
            </span>
        </a>

        <span class="education-admin-page-header-label">
            {{ __('education_admin.student_edit.header.eyebrow') }}
        </span>

        <h2>
            {{ __('education_admin.student_edit.header.title') }}
        </h2>

        <p>
            {{ __('education_admin.student_edit.header.description') }}
        </p>

    </div>


    {{-- STUDENT ID --}}

    <div class="education-admin-student-edit-id">

        <span>
            {{ __('education_admin.student_edit.student_id.label') }}
        </span>

        <strong>
            #{{ $student->id }}
        </strong>

    </div>

</div>


{{-- ==================================================
    ALERTS
================================================== --}}

@if(session('success'))

    <div class="education-admin-alert education-admin-alert-success">

        <i class="fa-solid fa-circle-check"></i>

        <span>
            {{ session('success') }}
        </span>

    </div>

@endif


@if(session('error'))

    <div class="education-admin-alert education-admin-alert-error">

        <i class="fa-solid fa-circle-exclamation"></i>

        <span>
            {{ session('error') }}
        </span>

    </div>

@endif


{{-- ==================================================
    VALIDATION ERRORS
================================================== --}}

@if($errors->any())

    <div class="education-admin-alert education-admin-alert-error">

        <i class="fa-solid fa-circle-exclamation"></i>

        <div>

            <strong>
                {{ __('education_admin.student_edit.validation.title') }}
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
    EDIT FORM
================================================== --}}

<form
    action="{{ route('education.admin.students.update', $student) }}"
    method="POST"
    class="education-admin-student-edit-form"
>

    @csrf

    @method('PUT')


    {{-- ==================================================
        BASIC INFORMATION
    ================================================== --}}

    <div class="education-admin-student-form-card">

        <div class="education-admin-student-form-card-header">

            <div>

                <span>
                    {{ __('education_admin.student_edit.basic.section_label') }}
                </span>

                <h3>
                    {{ __('education_admin.student_edit.basic.title') }}
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

                    {{ __('education_admin.student_edit.fields.name.label') }}

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
                        value="{{ old('name', $student->name) }}"
                        placeholder="{{ __('education_admin.student_edit.fields.name.placeholder') }}"
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
                    {{ __('education_admin.student_edit.fields.email.label') }}
                </label>

                <div class="education-admin-student-input-wrapper">

                    <i class="fa-regular fa-envelope"></i>

                    <input
                        id="student-email"
                        type="email"
                        name="email"
                        value="{{ old('email', $student->email) }}"
                        placeholder="{{ __('education_admin.student_edit.fields.email.placeholder') }}"
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
                    {{ __('education_admin.student_edit.fields.phone.label') }}
                </label>

                <div class="education-admin-student-input-wrapper">

                    <i class="fa-solid fa-phone"></i>

                    <input
                        id="student-phone"
                        type="text"
                        name="phone"
                        value="{{ old('phone', $student->phone) }}"
                        placeholder="{{ __('education_admin.student_edit.fields.phone.placeholder') }}"
                        dir="ltr"
                    >

                </div>

                @error('phone')

                    <small class="education-admin-student-form-error">
                        {{ $message }}
                    </small>

                @enderror

            </div>


            {{-- WHATSAPP NUMBER --}}

            <div class="education-admin-student-form-field">

                <label for="student-whatsapp">
                    {{ __('education_admin.student_edit.fields.whatsapp.label') }}
                </label>

                <div class="education-admin-student-input-wrapper">

                    <i class="fa-brands fa-whatsapp"></i>

                    <input
                        id="student-whatsapp"
                        type="text"
                        name="whatsapp_number"
                        value="{{ old('whatsapp_number', $student->whatsapp_number) }}"
                        placeholder="{{ __('education_admin.student_edit.fields.whatsapp.placeholder') }}"
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

                <label>
                    {{ __('education_admin.student_edit.fields.whatsapp_reminders.label') }}
                </label>

                <div class="education-admin-student-status-option">

                    <label
                        for="whatsapp-reminders"
                        class="education-admin-student-status-toggle"
                    >

                        <input
                            id="whatsapp-reminders"
                            type="checkbox"
                            name="whatsapp_reminders_enabled"
                            value="1"
                            @checked(
                                old(
                                    'whatsapp_reminders_enabled',
                                    $student->whatsapp_reminders_enabled
                                )
                            )
                        >

                        <span class="education-admin-student-toggle-slider"></span>

                        <span class="education-admin-student-status-toggle-content">

                            <strong>
                                {{ __('education_admin.student_edit.fields.whatsapp_reminders.toggle') }}
                            </strong>

                            <small>
                                {{ __('education_admin.student_edit.fields.whatsapp_reminders.description') }}
                            </small>

                        </span>

                    </label>

                </div>

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
                    {{ __('education_admin.student_edit.education.section_label') }}
                </span>

                <h3>
                    {{ __('education_admin.student_edit.education.title') }}
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
                    {{ __('education_admin.student_edit.fields.education_level.label') }}
                </label>

                <div class="education-admin-student-input-wrapper">

                    <i class="fa-solid fa-graduation-cap"></i>

                    <input
                        id="education-level"
                        type="text"
                        name="education_level"
                        value="{{ old('education_level', $student->education_level) }}"
                        placeholder="{{ __('education_admin.student_edit.fields.education_level.placeholder') }}"
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
                    {{ __('education_admin.student_edit.fields.learning_goal.label') }}
                </label>

                <div class="education-admin-student-textarea-wrapper">

                    <i class="fa-solid fa-bullseye"></i>

                    <textarea
                        id="learning-goal"
                        name="learning_goal"
                        rows="6"
                        placeholder="{{ __('education_admin.student_edit.fields.learning_goal.placeholder') }}"
                    >{{ old('learning_goal', $student->learning_goal) }}</textarea>

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
        STUDENT APPROVAL STATUS
    ================================================== --}}

    <div class="education-admin-student-form-card">

        <div class="education-admin-student-form-card-header">

            <div>

                <span>
                    {{ __('education_admin.student_edit.approval.section_label') }}
                </span>

                <h3>
                    {{ __('education_admin.student_edit.approval.title') }}
                </h3>

            </div>

            <div class="education-admin-student-form-card-icon approval">

                <i class="fa-solid fa-user-shield"></i>

            </div>

        </div>


        <div class="education-admin-student-form-grid">

            <div class="education-admin-student-form-field full">

                <label for="student-status">
                    {{ __('education_admin.student_edit.approval.status_label') }}
                </label>

                <div class="education-admin-student-input-wrapper">

                    <i class="fa-solid fa-user-check"></i>

                    <select
                        id="student-status"
                        name="student_status"
                    >

                        <option
                            value="pending"
                            @selected(
                                old(
                                    'student_status',
                                    $student->student_status
                                ) === 'pending'
                            )
                        >
                            {{ __('education_admin.student_edit.approval.statuses.pending') }}
                        </option>

                        <option
                            value="approved"
                            @selected(
                                old(
                                    'student_status',
                                    $student->student_status
                                ) === 'approved'
                            )
                        >
                            {{ __('education_admin.student_edit.approval.statuses.approved') }}
                        </option>

                        <option
                            value="rejected"
                            @selected(
                                old(
                                    'student_status',
                                    $student->student_status
                                ) === 'rejected'
                            )
                        >
                            {{ __('education_admin.student_edit.approval.statuses.rejected') }}
                        </option>

                    </select>

                </div>

                @error('student_status')

                    <small class="education-admin-student-form-error">
                        {{ $message }}
                    </small>

                @enderror

            </div>

        </div>


        {{-- CURRENT STATUS DESCRIPTION --}}

        @php

            $currentStudentStatus = old(
                'student_status',
                $student->student_status
            );

        @endphp


        <div class="education-admin-student-approval-info">

            @if($currentStudentStatus === 'approved')

                <i class="fa-solid fa-circle-check"></i>

                <div>

                    <strong>
                        {{ __('education_admin.student_edit.approval.info.approved.title') }}
                    </strong>

                    <small>
                        {{ __('education_admin.student_edit.approval.info.approved.description') }}
                    </small>

                </div>

            @elseif($currentStudentStatus === 'rejected')

                <i class="fa-solid fa-circle-xmark"></i>

                <div>

                    <strong>
                        {{ __('education_admin.student_edit.approval.info.rejected.title') }}
                    </strong>

                    <small>
                        {{ __('education_admin.student_edit.approval.info.rejected.description') }}
                    </small>

                </div>

            @else

                <i class="fa-solid fa-clock"></i>

                <div>

                    <strong>
                        {{ __('education_admin.student_edit.approval.info.pending.title') }}
                    </strong>

                    <small>
                        {{ __('education_admin.student_edit.approval.info.pending.description') }}
                    </small>

                </div>

            @endif

        </div>

    </div>


    {{-- ==================================================
        ACCOUNT STATUS
    ================================================== --}}

    <div class="education-admin-student-form-card">

        <div class="education-admin-student-form-card-header">

            <div>

                <span>
                    {{ __('education_admin.student_edit.account.section_label') }}
                </span>

                <h3>
                    {{ __('education_admin.student_edit.account.title') }}
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
                    @checked(
                        old(
                            'is_active',
                            $student->is_active
                        )
                    )
                >

                <span class="education-admin-student-toggle-slider"></span>

                <span class="education-admin-student-status-toggle-content">

                    <strong>
                        {{ __('education_admin.student_edit.account.active_title') }}
                    </strong>

                    <small>
                        {{ __('education_admin.student_edit.account.active_description') }}
                    </small>

                </span>

            </label>

        </div>

    </div>


    {{-- ==================================================
        PASSWORD
    ================================================== --}}

    <div class="education-admin-student-form-card">

        <div class="education-admin-student-form-card-header">

            <div>

                <span>
                    {{ __('education_admin.student_edit.password.section_label') }}
                </span>

                <h3>
                    {{ __('education_admin.student_edit.password.title') }}
                </h3>

            </div>

            <div class="education-admin-student-form-card-icon password">

                <i class="fa-solid fa-lock"></i>

            </div>

        </div>


        <div class="education-admin-student-form-grid">


            {{-- PASSWORD --}}

            <div class="education-admin-student-form-field">

                <label for="student-password">
                    {{ __('education_admin.student_edit.password.new_password') }}
                </label>

                <div class="education-admin-student-input-wrapper">

                    <i class="fa-solid fa-lock"></i>

                    <input
                        id="student-password"
                        type="password"
                        name="password"
                        placeholder="{{ __('education_admin.student_edit.password.password_placeholder') }}"
                        autocomplete="new-password"
                    >

                </div>

                @error('password')

                    <small class="education-admin-student-form-error">
                        {{ $message }}
                    </small>

                @enderror

            </div>


            {{-- PASSWORD CONFIRMATION --}}

            <div class="education-admin-student-form-field">

                <label for="student-password-confirmation">
                    {{ __('education_admin.student_edit.password.confirm_password') }}
                </label>

                <div class="education-admin-student-input-wrapper">

                    <i class="fa-solid fa-lock"></i>

                    <input
                        id="student-password-confirmation"
                        type="password"
                        name="password_confirmation"
                        placeholder="{{ __('education_admin.student_edit.password.confirm_placeholder') }}"
                        autocomplete="new-password"
                    >

                </div>

                @error('password_confirmation')

                    <small class="education-admin-student-form-error">
                        {{ $message }}
                    </small>

                @enderror

            </div>


            {{-- PASSWORD NOTE --}}

            <div class="education-admin-student-password-note">

                <i class="fa-solid fa-circle-info"></i>

                <span>
                    {{ __('education_admin.student_edit.password.note') }}
                </span>

            </div>

        </div>

    </div>


    {{-- ==================================================
        FORM ACTIONS
    ================================================== --}}

    <div class="education-admin-student-edit-footer">

        <a
            href="{{ route('education.admin.students.show', $student) }}"
            class="education-admin-student-edit-cancel"
        >

            <i class="fa-solid fa-xmark"></i>

            {{ __('education_admin.student_edit.actions.cancel') }}

        </a>


        <button
            type="submit"
            class="education-admin-student-edit-submit"
        >

            <i class="fa-solid fa-floppy-disk"></i>

            {{ __('education_admin.student_edit.actions.save') }}

        </button>

    </div>

</form>

</div>

@endsection
