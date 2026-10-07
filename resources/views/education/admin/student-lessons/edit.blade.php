@extends('education.admin.layouts.app')

@section('title', __('education_admin.student_lesson_edit.page_title'))

@section('content')

<div class="education-page">

    {{-- ============================================================
        HEADER
    ============================================================ --}}

    <div class="page-header">

        <div class="page-header-left">

            <div class="breadcrumb">

                <a href="{{ route('education.admin.dashboard') }}">
                    <i class="fa-solid fa-house"></i>
                    {{ __('education_admin.student_lesson_edit.header.dashboard') }}
                </a>

                <span>/</span>

                <a href="{{ route('education.admin.student-lessons.index') }}">
                    {{ __('education_admin.student_lesson_edit.header.student_lessons') }}
                </a>

                <span>/</span>

                <span>{{ __('education_admin.student_lesson_edit.header.current') }}</span>

            </div>


            <h1>
                {{ __('education_admin.student_lesson_edit.header.title') }}
            </h1>


            <p>
                {{ __('education_admin.student_lesson_edit.header.description') }}
            </p>

        </div>


        <div class="page-header-actions">

            <a
                href="{{ route('education.admin.student-lessons.show', $studentLesson) }}"
                class="btn btn-secondary"
            >
                <i class="fa-solid fa-eye"></i>

                {{ __('education_admin.student_lesson_edit.actions.view') }}
            </a>


            <a
                href="{{ route('education.admin.student-lessons.index') }}"
                class="btn btn-secondary"
            >
                <i class="fa-solid fa-arrow-right"></i>

                {{ __('education_admin.student_lesson_edit.actions.back') }}
            </a>

        </div>

    </div>


    {{-- ============================================================
        VALIDATION ERRORS
    ============================================================ --}}

    @if($errors->any())

        <div class="form-alert form-alert-danger">

            <div class="form-alert-icon">

                <i class="fa-solid fa-circle-exclamation"></i>

            </div>


            <div>

                <strong>
                    {{ __('education_admin.student_lesson_edit.validation.title') }}
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


    {{-- ============================================================
        FORM
    ============================================================ --}}

    <form
        action="{{ route('education.admin.student-lessons.update', $studentLesson) }}"
        method="POST"
    >

        @csrf
        @method('PUT')


        <div class="edit-layout">


            {{-- ====================================================
                MAIN FORM
            ==================================================== --}}

            <div class="education-card main-form-card">


                <div class="card-header">

                    <div class="card-header-icon">

                        <i class="fa-solid fa-pen-to-square"></i>

                    </div>


                    <div>

                        <h2>
                            {{ __('education_admin.student_lesson_edit.form.title') }}
                        </h2>

                        <p>
                            {{ __('education_admin.student_lesson_edit.form.description') }}
                        </p>

                    </div>

                </div>


                <div class="card-body">


                    {{-- =================================================
                        STUDENT
                    ================================================= --}}

                    <div class="form-group">

                        <label for="education_user_id">

                            <i class="fa-solid fa-user-graduate"></i>

                            {{ __('education_admin.student_lesson_edit.fields.student') }}

                            <span class="required">
                                *
                            </span>

                        </label>


                        <select
                            name="education_user_id"
                            id="education_user_id"
                            class="form-control @error('education_user_id') is-invalid @enderror"
                            required
                        >

                            <option value="">
                                {{ __('education_admin.student_lesson_edit.placeholders.student') }}
                            </option>


                            @foreach($students as $student)

                                <option
                                    value="{{ $student->id }}"
                                    @selected(
                                        (string) old(
                                            'education_user_id',
                                            $studentLesson->education_user_id
                                        ) === (string) $student->id
                                    )
                                >

                                    {{ $student->name }}

                                    @if($student->email)

                                        — {{ $student->email }}

                                    @endif

                                </option>

                            @endforeach

                        </select>


                        @error('education_user_id')

                            <div class="field-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- =================================================
                        SOURCE LESSON
                    ================================================= --}}

                    <div class="form-group">

                        <label for="source_lesson_id">

                            <i class="fa-solid fa-book-open"></i>

                            {{ __('education_admin.student_lesson_edit.fields.source_lesson') }}

                            <span class="required">
                                *
                            </span>

                        </label>


                        <select
                            name="source_lesson_id"
                            id="source_lesson_id"
                            class="form-control @error('source_lesson_id') is-invalid @enderror"
                            required
                        >

                            <option value="">
                                {{ __('education_admin.student_lesson_edit.placeholders.lesson') }}
                            </option>


                            @foreach($lessons as $lesson)

                                <option
                                    value="{{ $lesson->id }}"
                                    data-title="{{ $lesson->title }}"
                                    data-description="{{ $lesson->description ?? '' }}"
                                    @selected(
                                        (string) old(
                                            'source_lesson_id',
                                            $studentLesson->source_lesson_id
                                        ) === (string) $lesson->id
                                    )
                                >

                                    {{ $lesson->title }}

                                </option>

                            @endforeach

                        </select>


                        @error('source_lesson_id')

                            <div class="field-error">
                                {{ $message }}
                            </div>

                        @enderror


                        <div
                            id="lesson-description-preview"
                            class="lesson-preview"
                        ></div>

                    </div>


                    {{-- =================================================
                        TITLE
                    ================================================= --}}

                    <div class="form-group">

                        <label for="title">

                            <i class="fa-solid fa-heading"></i>

                            {{ __('education_admin.student_lesson_edit.fields.title') }}

                            <span class="required">
                                *
                            </span>

                        </label>


                        <input
                            type="text"
                            name="title"
                            id="title"
                            value="{{ old('title', $studentLesson->title) }}"
                            class="form-control @error('title') is-invalid @enderror"
                            maxlength="255"
                            placeholder="{{ __('education_admin.student_lesson_edit.placeholders.title') }}"
                            required
                        >


                        @error('title')

                            <div class="field-error">
                                {{ $message }}
                            </div>

                        @enderror


                        <div class="field-hint">

                            {{ __('education_admin.student_lesson_edit.hints.title') }}

                        </div>

                    </div>


                    {{-- =================================================
                        DESCRIPTION
                    ================================================= --}}

                    <div class="form-group">

                        <label for="description">

                            <i class="fa-solid fa-align-left"></i>

                            {{ __('education_admin.student_lesson_edit.fields.description') }}

                        </label>


                        <textarea
                            name="description"
                            id="description"
                            rows="6"
                            class="form-control textarea-control @error('description') is-invalid @enderror"
                            placeholder="{{ __('education_admin.student_lesson_edit.placeholders.description') }}"
                        >{{ old('description', $studentLesson->description) }}</textarea>


                        @error('description')

                            <div class="field-error">
                                {{ $message }}
                            </div>

                        @enderror


                        <div class="field-hint">

                            {{ __('education_admin.student_lesson_edit.hints.description') }}

                        </div>

                    </div>


                    {{-- =================================================
                        STATUS
                    ================================================= --}}

                    <div class="form-group">

                        <label for="status">

                            <i class="fa-solid fa-chart-line"></i>

                            {{ __('education_admin.student_lesson_edit.fields.status') }}

                            <span class="required">
                                *
                            </span>

                        </label>


                        @php

                            $currentStatus = old(
                                'status',
                                $studentLesson->status ?? 'assigned'
                            );

                        @endphp


                        <select
                            name="status"
                            id="status"
                            class="form-control @error('status') is-invalid @enderror"
                            required
                        >

                            <option
                                value="pending"
                                @selected($currentStatus === 'pending')
                            >
                                {{ __('education_admin.student_lesson_edit.statuses.pending') }}
                            </option>


                            <option
                                value="assigned"
                                @selected($currentStatus === 'assigned')
                            >
                                {{ __('education_admin.student_lesson_edit.statuses.assigned') }}
                            </option>


                            <option
                                value="in_progress"
                                @selected($currentStatus === 'in_progress')
                            >
                                {{ __('education_admin.student_lesson_edit.statuses.in_progress') }}
                            </option>


                            <option
                                value="completed"
                                @selected($currentStatus === 'completed')
                            >
                                {{ __('education_admin.student_lesson_edit.statuses.completed') }}
                            </option>


                            <option
                                value="cancelled"
                                @selected($currentStatus === 'cancelled')
                            >
                                {{ __('education_admin.student_lesson_edit.statuses.cancelled') }}
                            </option>

                        </select>


                        @error('status')

                            <div class="field-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- =================================================
                        ASSIGNED AT
                    ================================================= --}}

                    <div class="form-group">

                        <label for="assigned_at">

                            <i class="fa-regular fa-calendar"></i>

                            {{ __('education_admin.student_lesson_edit.fields.assigned_at') }}

                        </label>


                        @php

                            $assignedAtValue = old('assigned_at');

                            if ($assignedAtValue === null) {

                                $assignedAtValue = '';

                                if ($studentLesson->assigned_at) {

                                    try {

                                        $assignedAtValue = \Carbon\Carbon::parse(
                                            $studentLesson->assigned_at
                                        )->format('Y-m-d\TH:i');

                                    } catch (\Throwable $e) {

                                        $assignedAtValue = '';

                                    }

                                }

                            }

                        @endphp


                        <input
                            type="datetime-local"
                            name="assigned_at"
                            id="assigned_at"
                            value="{{ $assignedAtValue }}"
                            class="form-control @error('assigned_at') is-invalid @enderror"
                        >


                        @error('assigned_at')

                            <div class="field-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- =================================================
                        NOTES
                    ================================================= --}}

                    <div class="form-group">

                        <label for="notes">

                            <i class="fa-solid fa-note-sticky"></i>

                            {{ __('education_admin.student_lesson_edit.fields.notes') }}

                        </label>


                        <textarea
                            name="notes"
                            id="notes"
                            rows="6"
                            maxlength="5000"
                            class="form-control textarea-control @error('notes') is-invalid @enderror"
                            placeholder="{{ __('education_admin.student_lesson_edit.placeholders.notes') }}"
                        >{{ old('notes', $studentLesson->notes) }}</textarea>


                        @error('notes')

                            <div class="field-error">
                                {{ $message }}
                            </div>

                        @enderror


                        <div class="field-hint">

                            {{ __('education_admin.student_lesson_edit.hints.notes') }}

                        </div>

                    </div>


                    {{-- =================================================
                        ACTIVE
                    ================================================= --}}

                    <div class="active-option">

                        <label class="switch-label">

                            <input
                                type="checkbox"
                                name="is_active"
                                value="1"
                                @checked(
                                    old(
                                        'is_active',
                                        $studentLesson->is_active
                                    )
                                )
                            >


                            <span class="switch"></span>


                            <span class="switch-content">

                                <strong>
                                    {{ __('education_admin.student_lesson_edit.active.title') }}
                                </strong>

                                <small>
                                    {{ __('education_admin.student_lesson_edit.active.description') }}
                                </small>

                            </span>

                        </label>

                    </div>

                </div>

            </div>


            {{-- ====================================================
                SIDEBAR
            ==================================================== --}}

            <div class="edit-sidebar">


                {{-- =================================================
                    CURRENT INFORMATION
                ================================================= --}}

                <div class="education-card">

                    <div class="card-header">

                        <div class="card-header-icon">

                            <i class="fa-solid fa-circle-info"></i>

                        </div>


                        <div>

                            <h2>
                                {{ __('education_admin.student_lesson_edit.current_info.title') }}
                            </h2>

                            <p>
                                {{ __('education_admin.student_lesson_edit.current_info.description') }}
                            </p>

                        </div>

                    </div>


                    <div class="card-body">

                        <div class="sidebar-info-list">


                            <div class="sidebar-info-item">

                                <span>
                                    {{ __('education_admin.student_lesson_edit.current_info.student_lesson_number') }}
                                </span>

                                <strong>
                                    #{{ $studentLesson->id }}
                                </strong>

                            </div>


                            <div class="sidebar-info-item">

                                <span>
                                    {{ __('education_admin.student_lesson_edit.current_info.source_lesson') }}
                                </span>

                                <strong>

                                    @if($studentLesson->sourceLesson)

                                        {{ $studentLesson->sourceLesson->title }}

                                    @else

                                        —

                                    @endif

                                </strong>

                            </div>


                            <div class="sidebar-info-item">

                                <span>
                                    {{ __('education_admin.student_lesson_edit.current_info.created_at') }}
                                </span>

                                <strong>

                                    @if($studentLesson->created_at)

                                        {{ $studentLesson->created_at->format('Y/m/d') }}

                                    @else

                                        —

                                    @endif

                                </strong>

                            </div>


                            <div class="sidebar-info-item">

                                <span>
                                    {{ __('education_admin.student_lesson_edit.current_info.updated_at') }}
                                </span>

                                <strong>

                                    @if($studentLesson->updated_at)

                                        {{ $studentLesson->updated_at->format('Y/m/d') }}

                                    @else

                                        —

                                    @endif

                                </strong>

                            </div>


                            <div class="sidebar-info-item">

                                <span>
                                    {{ __('education_admin.student_lesson_edit.current_info.started_at') }}
                                </span>

                                <strong>

                                    @if($studentLesson->started_at)

                                        {{ \Carbon\Carbon::parse(
                                            $studentLesson->started_at
                                        )->format('Y/m/d - h:i A') }}

                                    @else

                                        —

                                    @endif

                                </strong>

                            </div>


                            <div class="sidebar-info-item">

                                <span>
                                    {{ __('education_admin.student_lesson_edit.current_info.completed_at') }}
                                </span>

                                <strong>

                                    @if($studentLesson->completed_at)

                                        {{ \Carbon\Carbon::parse(
                                            $studentLesson->completed_at
                                        )->format('Y/m/d - h:i A') }}

                                    @else

                                        —

                                    @endif

                                </strong>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                    ASSIGNMENT
                ================================================= --}}

                <div class="education-card">

                    <div class="card-header">

                        <div class="card-header-icon">

                            <i class="fa-solid fa-clipboard-list"></i>

                        </div>


                        <div>

                            <h2>
                                {{ __('education_admin.student_lesson_edit.assignment.title') }}
                            </h2>

                            <p>
                                {{ __('education_admin.student_lesson_edit.assignment.description') }}
                            </p>

                        </div>

                    </div>


                    <div class="card-body">


                        @if($studentLesson->assignment)

                            <div class="assignment-box">

                                <div class="assignment-icon">

                                    <i class="fa-solid fa-link"></i>

                                </div>


                                <div>

                                    <strong>

                                        {{ __('education_admin.student_lesson_edit.assignment.number') }}
                                        #{{ $studentLesson->assignment->id }}

                                    </strong>


                                    <span>

                                        {{ __('education_admin.student_lesson_edit.assignment.connected') }}

                                    </span>

                                </div>

                            </div>

                        @else

                            <div class="no-assignment">

                                <i class="fa-solid fa-circle-info"></i>

                                <span>

                                    {{ __('education_admin.student_lesson_edit.assignment.not_found') }}

                                </span>

                            </div>

                        @endif

                    </div>

                </div>


                {{-- =================================================
                    SOURCE LESSON NOTICE
                ================================================= --}}

                <div class="source-lesson-box">

                    <div class="source-lesson-icon">

                        <i class="fa-solid fa-book-open"></i>

                    </div>


                    <div>

                        <strong>
                            {{ __('education_admin.student_lesson_edit.source_notice.title') }}
                        </strong>

                        <p>

                            {{ __('education_admin.student_lesson_edit.source_notice.description') }}

                        </p>

                    </div>

                </div>


                {{-- =================================================
                    WARNING
                ================================================= --}}

                <div class="warning-box">

                    <div class="warning-icon">

                        <i class="fa-solid fa-triangle-exclamation"></i>

                    </div>


                    <div>

                        <strong>
                            {{ __('education_admin.student_lesson_edit.warning.title') }}
                        </strong>

                        <p>

                            {{ __('education_admin.student_lesson_edit.warning.description') }}

                        </p>

                    </div>

                </div>

            </div>

        </div>


        {{-- ============================================================
            FORM ACTIONS
        ============================================================ --}}

        <div class="education-card form-actions-card">

            <div class="form-actions">

                <a
                    href="{{ route('education.admin.student-lessons.show', $studentLesson) }}"
                    class="btn btn-secondary"
                >

                    <i class="fa-solid fa-xmark"></i>

                    {{ __('education_admin.student_lesson_edit.actions.cancel') }}

                </a>


                <button
                    type="submit"
                    class="btn btn-primary"
                >

                    <i class="fa-solid fa-floppy-disk"></i>

                    {{ __('education_admin.student_lesson_edit.actions.save') }}

                </button>

            </div>

        </div>

    </form>

</div>


{{-- ================================================================
    PAGE STYLE
================================================================ --}}

<style>

.education-page {
    width: 100%;
    direction: rtl;
}


/* ============================================================
   HEADER
============================================================ */

.page-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    gap: 24px;
    margin-bottom: 28px;
}

.page-header-left {
    min-width: 0;
}

.breadcrumb {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 9px;
    margin-bottom: 10px;
    font-size: 13px;
    color: #8a8173;
}

.breadcrumb a {
    color: #8a6a24;
    text-decoration: none;
    transition: .2s;
}

.breadcrumb a:hover {
    color: #b18a35;
}

.breadcrumb i {
    margin-left: 4px;
}

.page-header h1 {
    margin: 0 0 7px;
    font-size: 30px;
    font-weight: 700;
    color: #315c4b;
}

.page-header p {
    margin: 0;
    color: #8a8173;
    font-size: 14px;
}

.page-header-actions {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
}


/* ============================================================
   LAYOUT
============================================================ */

.edit-layout {
    display: grid;
    grid-template-columns: minmax(0, 1fr) 340px;
    gap: 22px;
    align-items: start;
}


/* ============================================================
   CARDS
============================================================ */

.education-card {
    background: #fffdf8;
    border: 1px solid #eadfca;
    border-radius: 18px;
    box-shadow: 0 8px 25px rgba(80, 65, 35, .06);
    overflow: hidden;
}

.card-header {
    display: flex;
    align-items: center;
    gap: 13px;
    padding: 19px 21px;
    border-bottom: 1px solid #eee4d2;
    background: #fbf7ed;
}

.card-header-icon {
    width: 42px;
    height: 42px;
    flex: 0 0 42px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 12px;
    background: #e8f0e8;
    color: #315c4b;
    font-size: 17px;
}

.card-header h2 {
    margin: 0 0 3px;
    color: #315c4b;
    font-size: 17px;
    font-weight: 700;
}

.card-header p {
    margin: 0;
    color: #918878;
    font-size: 12px;
}

.card-body {
    padding: 22px;
}


/* ============================================================
   FORM
============================================================ */

.form-group {
    margin-bottom: 22px;
}

.form-group:last-child {
    margin-bottom: 0;
}

.form-group label {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 9px;
    color: #4e504c;
    font-size: 13px;
    font-weight: 700;
}

.form-group label i {
    width: 17px;
    color: #a9822e;
    text-align: center;
}

.required {
    color: #a8564c;
    font-size: 14px;
}

.form-control {
    width: 100%;
    min-height: 44px;
    padding: 10px 13px;
    border: 1px solid #dfd5c3;
    border-radius: 11px;
    background: #fffefa;
    color: #3e403d;
    font-family: inherit;
    font-size: 13px;
    outline: none;
    transition: .2s ease;
    box-sizing: border-box;
}

.form-control:focus {
    border-color: #a9822e;
    box-shadow: 0 0 0 3px rgba(169, 130, 46, .10);
    background: #fff;
}

.form-control::placeholder {
    color: #aaa194;
}

select.form-control {
    cursor: pointer;
}

.textarea-control {
    min-height: 130px;
    resize: vertical;
    line-height: 1.8;
}

.is-invalid {
    border-color: #c47b71 !important;
    background: #fff9f8;
}

.field-error {
    margin-top: 7px;
    color: #a8564c;
    font-size: 12px;
    font-weight: 600;
}

.field-hint {
    margin-top: 7px;
    color: #948b7d;
    font-size: 11px;
    line-height: 1.7;
}


/* ============================================================
   LESSON PREVIEW
============================================================ */

.lesson-preview {
    display: none;
    margin-top: 10px;
    padding: 12px 14px;
    border-radius: 10px;
    background: #faf6ed;
    border: 1px solid #eee4d2;
    color: #6c665c;
    font-size: 12px;
    line-height: 1.7;
}

.lesson-preview.active {
    display: block;
}

.lesson-preview strong {
    color: #315c4b;
}

.lesson-preview i {
    margin-left: 5px;
    color: #b18a35;
}


/* ============================================================
   ACTIVE SWITCH
============================================================ */

.active-option {
    padding: 16px;
    border: 1px solid #eadfca;
    border-radius: 13px;
    background: #faf6ed;
}

.switch-label {
    display: flex;
    align-items: center;
    gap: 12px;
    cursor: pointer;
    margin: 0;
}

.switch-label input {
    position: absolute;
    opacity: 0;
    pointer-events: none;
}

.switch {
    position: relative;
    width: 43px;
    height: 24px;
    flex: 0 0 43px;
    border-radius: 30px;
    background: #d8d1c4;
    transition: .2s ease;
}

.switch::after {
    content: "";
    position: absolute;
    top: 3px;
    right: 3px;
    width: 18px;
    height: 18px;
    border-radius: 50%;
    background: #fff;
    box-shadow: 0 2px 5px rgba(0,0,0,.15);
    transition: .2s ease;
}

.switch-label input:checked + .switch {
    background: #315c4b;
}

.switch-label input:checked + .switch::after {
    transform: translateX(-19px);
}

.switch-content {
    display: flex;
    flex-direction: column;
    gap: 3px;
}

.switch-content strong {
    color: #3e403d;
    font-size: 13px;
}

.switch-content small {
    color: #918878;
    font-size: 11px;
    line-height: 1.5;
}


/* ============================================================
   SIDEBAR
============================================================ */

.edit-sidebar {
    display: flex;
    flex-direction: column;
    gap: 22px;
}

.sidebar-info-list {
    display: flex;
    flex-direction: column;
}

.sidebar-info-item {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 15px;
    padding: 12px 0;
    border-bottom: 1px solid #eee7da;
}

.sidebar-info-item:first-child {
    padding-top: 0;
}

.sidebar-info-item:last-child {
    padding-bottom: 0;
    border-bottom: 0;
}

.sidebar-info-item span {
    color: #81786a;
    font-size: 12px;
}

.sidebar-info-item strong {
    max-width: 60%;
    color: #3c403d;
    font-size: 12px;
    text-align: left;
}


/* ============================================================
   ASSIGNMENT
============================================================ */

.assignment-box {
    display: flex;
    align-items: flex-start;
    gap: 11px;
    padding: 13px;
    border-radius: 12px;
    background: #e8f0e8;
}

.assignment-icon {
    width: 34px;
    height: 34px;
    flex: 0 0 34px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 9px;
    background: #315c4b;
    color: #fff;
    font-size: 13px;
}

.assignment-box strong {
    display: block;
    margin-bottom: 3px;
    color: #315c4b;
    font-size: 12px;
}

.assignment-box span {
    display: block;
    color: #637267;
    font-size: 11px;
    line-height: 1.6;
}

.no-assignment {
    display: flex;
    align-items: flex-start;
    gap: 9px;
    padding: 13px;
    border-radius: 12px;
    background: #faf6ed;
    color: #7d7467;
    font-size: 11px;
    line-height: 1.7;
}

.no-assignment i {
    margin-top: 2px;
    color: #b18a35;
}


/* ============================================================
   SOURCE LESSON
============================================================ */

.source-lesson-box {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 16px;
    border: 1px solid #d9e5dc;
    border-radius: 15px;
    background: #f1f6f2;
}

.source-lesson-icon {
    width: 34px;
    height: 34px;
    flex: 0 0 34px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 9px;
    background: #dcebe0;
    color: #315c4b;
}

.source-lesson-box strong {
    display: block;
    margin-bottom: 4px;
    color: #315c4b;
    font-size: 12px;
}

.source-lesson-box p {
    margin: 0;
    color: #6e786f;
    font-size: 11px;
    line-height: 1.8;
}


/* ============================================================
   WARNING
============================================================ */

.warning-box {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 16px;
    border: 1px solid #ead9b7;
    border-radius: 15px;
    background: #fff8e8;
}

.warning-icon {
    width: 34px;
    height: 34px;
    flex: 0 0 34px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 9px;
    background: #f4e5bd;
    color: #9a6b14;
}

.warning-box strong {
    display: block;
    margin-bottom: 4px;
    color: #8a641b;
    font-size: 12px;
}

.warning-box p {
    margin: 0;
    color: #8a7b62;
    font-size: 11px;
    line-height: 1.8;
}


/* ============================================================
   ALERT
============================================================ */

.form-alert {
    display: flex;
    align-items: flex-start;
    gap: 13px;
    margin-bottom: 22px;
    padding: 15px 17px;
    border-radius: 13px;
    font-size: 12px;
}

.form-alert-danger {
    background: #fff0ee;
    border: 1px solid #ecc8c2;
    color: #8d4a42;
}

.form-alert-icon {
    width: 30px;
    height: 30px;
    flex: 0 0 30px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.form-alert strong {
    display: block;
    margin-bottom: 6px;
}

.form-alert ul {
    margin: 0;
    padding-right: 18px;
}

.form-alert li {
    margin-bottom: 3px;
}


/* ============================================================
   BUTTONS
============================================================ */

.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    min-height: 40px;
    padding: 9px 16px;
    border: 1px solid transparent;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
    cursor: pointer;
    transition: .2s ease;
    white-space: nowrap;
    font-family: inherit;
}

.btn-primary {
    background: #315c4b;
    color: #fff;
}

.btn-primary:hover {
    background: #274d3e;
    color: #fff;
}

.btn-secondary {
    background: #f5efe3;
    border-color: #e5d8bf;
    color: #6e6049;
}

.btn-secondary:hover {
    background: #eee5d5;
    color: #594c38;
}


/* ============================================================
   FORM ACTIONS
============================================================ */

.form-actions-card {
    margin-top: 22px;
}

.form-actions {
    display: flex;
    justify-content: flex-start;
    align-items: center;
    gap: 10px;
    padding: 18px 21px;
}


/* ============================================================
   RESPONSIVE
============================================================ */

@media (max-width: 1050px) {

    .edit-layout {
        grid-template-columns: 1fr;
    }

    .edit-sidebar {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

}


@media (max-width: 800px) {

    .page-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .page-header-actions {
        width: 100%;
    }

    .page-header-actions .btn {
        flex: 1;
    }

    .edit-sidebar {
        grid-template-columns: 1fr;
    }

}


@media (max-width: 600px) {

    .card-body {
        padding: 17px;
    }

    .form-actions {
        flex-direction: column;
        align-items: stretch;
    }

    .form-actions .btn {
        width: 100%;
    }

    .page-header-actions {
        flex-direction: column;
        align-items: stretch;
    }

    .page-header-actions .btn {
        width: 100%;
    }

    .sidebar-info-item {
        flex-direction: column;
        gap: 5px;
    }

    .sidebar-info-item strong {
        max-width: 100%;
        text-align: right;
    }

}

</style>


{{-- ================================================================
    PAGE SCRIPT
================================================================ --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const lessonSelect =
        document.getElementById('source_lesson_id');

    const titleInput =
        document.getElementById('title');

    const preview =
        document.getElementById('lesson-description-preview');


    if (!lessonSelect || !preview) {
        return;
    }


    /*
    |--------------------------------------------------------------------------
    | حماية النص من HTML
    |--------------------------------------------------------------------------
    */

    function escapeHtml(value) {

        const div = document.createElement('div');

        div.textContent = value;

        return div.innerHTML;
    }


    /*
    |--------------------------------------------------------------------------
    | معاينة وصف الدرس الأصلي
    |--------------------------------------------------------------------------
    */

    function updateLessonPreview() {

        const selectedOption =
            lessonSelect.options[
                lessonSelect.selectedIndex
            ];


        if (
            !selectedOption ||
            !selectedOption.value
        ) {

            preview.innerHTML = '';

            preview.classList.remove('active');

            return;
        }


        const description =
            selectedOption.dataset.description || '';


        if (!description.trim()) {

            preview.innerHTML =
                '<i class="fa-solid fa-circle-info"></i> ' +
                @json(__('education_admin.student_lesson_edit.preview.no_description'));

            preview.classList.add('active');

            return;
        }


        preview.innerHTML =
            '<strong>' +
            @json(__('education_admin.student_lesson_edit.preview.original_description')) +
            '</strong><br>' +
            escapeHtml(description);


        preview.classList.add('active');

    }


    /*
    |--------------------------------------------------------------------------
    | عند تغيير الدرس الأصلي
    |--------------------------------------------------------------------------
    */

    lessonSelect.addEventListener('change', function () {

        updateLessonPreview();


        /*
        |--------------------------------------------------------------------------
        | تعبئة عنوان الطالب تلقائيًا
        |--------------------------------------------------------------------------
        |
        | لا يتم استبدال عنوان الطالب الموجود.
        | يتم تعبئة العنوان فقط إذا كان فارغًا.
        |
        */

        const selectedOption =
            lessonSelect.options[
                lessonSelect.selectedIndex
            ];


        if (
            !selectedOption ||
            !selectedOption.value ||
            !titleInput
        ) {

            return;

        }


        if (titleInput.value.trim() === '') {

            const lessonTitle =
                selectedOption.dataset.title ||
                selectedOption.textContent.trim();


            titleInput.value = lessonTitle;

        }

    });


    /*
    |--------------------------------------------------------------------------
    | المعاينة الأولية
    |--------------------------------------------------------------------------
    */

    updateLessonPreview();

});

</script>

@endsection
