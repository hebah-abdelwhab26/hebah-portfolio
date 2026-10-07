@extends('education.admin.layouts.app')

@section('title', __('education_admin.lesson_assignments.create.page_title'))

@section('content')

<div class="education-assignment-create-page" dir="rtl">

    {{-- ==========================================================
        HEADER
    =========================================================== --}}

    <div class="education-assignment-create-header">

        <div>

            <div class="education-assignment-create-breadcrumb">

                <a href="{{ route('education.admin.lesson-assignments.index') }}">
                    {{ __('education_admin.lesson_assignments.create.breadcrumb_assignments') }}
                </a>

                <i class="fa-solid fa-chevron-left"></i>

                <span>
                    {{ __('education_admin.lesson_assignments.create.breadcrumb_new') }}
                </span>

            </div>

            <h1>
                {{ __('education_admin.lesson_assignments.create.title') }}
            </h1>

            <p>
                {{ __('education_admin.lesson_assignments.create.description') }}
            </p>

        </div>

    </div>


    {{-- ==========================================================
        SUCCESS
    =========================================================== --}}

    @if(session('success'))

        <div class="education-assignment-alert education-assignment-alert-success">

            <i class="fa-solid fa-circle-check"></i>

            <span>
                {{ session('success') }}
            </span>

        </div>

    @endif


    {{-- ==========================================================
        ERROR
    =========================================================== --}}

    @if(session('error'))

        <div class="education-assignment-alert education-assignment-alert-error">

            <i class="fa-solid fa-circle-exclamation"></i>

            <span>
                {{ session('error') }}
            </span>

        </div>

    @endif


    {{-- ==========================================================
        VALIDATION ERRORS
    =========================================================== --}}

    @if($errors->any())

        <div class="education-assignment-validation-errors">

            <div class="education-assignment-validation-title">

                <i class="fa-solid fa-triangle-exclamation"></i>

                <span>
                    {{ __('education_admin.lesson_assignments.create.validation_title') }}
                </span>

            </div>

            <ul>

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- ==========================================================
        MAIN CARD
    =========================================================== --}}

    <div class="education-assignment-create-card">


        {{-- ======================================================
            CARD HEADER
        ======================================================= --}}

        <div class="education-assignment-create-card-header">

            <div class="education-assignment-create-icon">

                <i class="fa-solid fa-book-open-reader"></i>

            </div>

            <div>

                <h2>
                    {{ __('education_admin.lesson_assignments.create.card_title') }}
                </h2>

                <p>
                    {{ __('education_admin.lesson_assignments.create.card_description') }}
                </p>

            </div>

        </div>


        {{-- ======================================================
            FORM
        ======================================================= --}}

        <form
            action="{{ route('education.admin.lesson-assignments.store') }}"
            method="POST"
            class="education-assignment-form"
            id="educationAssignmentForm"
        >

            @csrf


            {{-- ==================================================
                STATUS
            =================================================== --}}

            <input
                type="hidden"
                name="status"
                value="assigned"
            >


            {{-- ==================================================
                STUDENT
            =================================================== --}}

            <div class="education-assignment-form-group">

                <label for="education_user_id">

                    {{ __('education_admin.lesson_assignments.create.student.label') }}

                    <span>*</span>

                </label>

                <p class="education-assignment-field-help">

                    {{ __('education_admin.lesson_assignments.create.student.help') }}

                </p>

                <select
                    name="education_user_id"
                    id="education_user_id"
                    required
                >

                    <option value="">
                        {{ __('education_admin.lesson_assignments.create.student.placeholder') }}
                    </option>

                    @foreach($students as $student)

                        <option
                            value="{{ $student->id }}"
                            @selected(
                                old('education_user_id') == $student->id
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

                    <div class="education-assignment-error">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            {{-- ==================================================
                BOOKING
            =================================================== --}}

            <div class="education-assignment-form-group">

                <label for="education_booking_id">

                    {{ __('education_admin.lesson_assignments.create.booking.label') }}

                    <span>*</span>

                </label>

                <p class="education-assignment-field-help">

                    {{ __('education_admin.lesson_assignments.create.booking.help') }}

                </p>


                <select
                    name="education_booking_id"
                    id="education_booking_id"
                    required
                >

                    <option value="">
                        {{ __('education_admin.lesson_assignments.create.booking.placeholder') }}
                    </option>


                    @foreach($bookings as $booking)

                        @php

                            $bookingType =
                                $booking->bookingType;

                            $isPackage =
                                $booking->isPackage();

                            $totalSessions =
                                (int) $booking->total_sessions;

                            $completedSessions =
                                (int) $booking->completed_sessions;

                            $existingLessons =
                                $booking->studentLessons()
                                    ->where(
                                        'status',
                                        '!=',
                                        'cancelled'
                                    )
                                    ->count();

                            $remainingSessions =
                                max(
                                    0,
                                    $totalSessions
                                    - $completedSessions
                                    - $existingLessons
                                );

                        @endphp


                        <option
                            value="{{ $booking->id }}"

                            data-student-id="{{ $booking->education_user_id }}"

                            data-total-sessions="{{ $totalSessions }}"

                            data-completed-sessions="{{ $completedSessions }}"

                            data-existing-lessons="{{ $existingLessons }}"

                            data-remaining-sessions="{{ $remainingSessions }}"

                            data-type="{{ $isPackage ? 'package' : 'single' }}"

                            data-title="{{ $booking->title ?: __('education_admin.lesson_assignments.create.booking.educational_booking') }}"

                            data-booking-type="{{ $bookingType?->name }}"

                            @selected(
                                old('education_booking_id') == $booking->id
                            )
                        >

                            #{{ $booking->id }}

                            —

                            {{ $booking->title ?: __('education_admin.lesson_assignments.create.booking.educational_booking') }}

                            @if($bookingType)

                                — {{ $bookingType->name }}

                            @endif

                            —

                            @if($isPackage)

                                {{ __('education_admin.lesson_assignments.create.booking.package') }}

                                (
                                    {{ __('education_admin.lesson_assignments.create.booking.remaining', ['count' => $remainingSessions]) }}
                                )

                            @else

                                {{ __('education_admin.lesson_assignments.create.booking.single') }}

                            @endif

                        </option>

                    @endforeach

                </select>


                @if($bookings->isEmpty())

                    <div class="education-assignment-booking-notice">

                        <i class="fa-solid fa-circle-info"></i>

                        <span>
                            {{ __('education_admin.lesson_assignments.create.booking.no_paid_bookings') }}
                        </span>

                    </div>

                @endif


                {{-- ==================================================
                    SELECTED BOOKING INFO
                =================================================== --}}

                <div
                    id="selectedBookingInfo"
                    class="education-selected-booking-info"
                    style="display:none;"
                >

                    <div class="education-selected-booking-icon">

                        <i
                            id="selectedBookingIcon"
                            class="fa-solid fa-box-open"
                        ></i>

                    </div>


                    <div class="education-selected-booking-content">

                        <strong id="selectedBookingTitle">
                            -
                        </strong>

                        <span id="selectedBookingMeta">
                            -
                        </span>

                    </div>

                </div>


                @error('education_booking_id')

                    <div class="education-assignment-error">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            {{-- ==================================================
                LESSON TITLES
            =================================================== --}}

            <div class="education-assignment-form-group">

                <label>

                    {{ __('education_admin.lesson_assignments.create.lessons.label') }}

                    <span>*</span>

                </label>

                <p class="education-assignment-field-help">

                    {{ __('education_admin.lesson_assignments.create.lessons.help') }}

                </p>


                {{-- ==================================================
                    ADD TITLE
                =================================================== --}}

                <div class="education-lesson-title-input-wrapper">

                    <input
                        type="text"
                        id="lessonTitleInput"
                        class="education-lesson-title-input"
                        maxlength="255"
                        placeholder="{{ __('education_admin.lesson_assignments.create.lessons.placeholder') }}"
                        autocomplete="off"
                    >


                    <button
                        type="button"
                        id="addLessonButton"
                        class="education-add-lesson-btn"
                    >

                        <i class="fa-solid fa-plus"></i>

                        {{ __('education_admin.lesson_assignments.create.lessons.add') }}

                    </button>

                </div>


                {{-- ==================================================
                    NOTICE
                =================================================== --}}

                <div
                    id="lessonAssignmentNotice"
                    class="education-lesson-assignment-notice"
                    style="display:none;"
                >

                    <i class="fa-solid fa-circle-info"></i>

                    <span>
                        {{ __('education_admin.lesson_assignments.create.lessons.notice_select') }}
                    </span>

                </div>


                {{-- ==================================================
                    REMAINING SESSIONS
                =================================================== --}}

                <div
                    id="remainingSessionsNotice"
                    class="education-remaining-sessions-notice"
                    style="display:none;"
                >

                    <div class="education-remaining-sessions-icon">

                        <i class="fa-solid fa-layer-group"></i>

                    </div>

                    <div>

                        <strong>
                            {{ __('education_admin.lesson_assignments.create.lessons.available') }}
                        </strong>

                        <span id="remainingSessionsText">
                            -
                        </span>

                    </div>

                </div>

            </div>


            {{-- ==================================================
                SELECTED LESSONS
            =================================================== --}}

            <div class="education-selected-lessons-section">

                <div class="education-selected-lessons-header">

                    <div>

                        <h3>
                            {{ __('education_admin.lesson_assignments.create.lessons.selected_title') }}
                        </h3>

                        <p>
                            {{ __('education_admin.lesson_assignments.create.lessons.selected_description') }}
                        </p>

                    </div>


                    <div
                        class="education-selected-lessons-count"
                        id="selectedLessonsCount"
                    >
                        {{ __('education_admin.lesson_assignments.create.lessons.count_one', ['count' => 0]) }}
                    </div>

                </div>


                <div
                    id="selected-lessons-container"
                    class="education-selected-lessons-container"
                >

                    <div
                        id="selectedLessonsEmpty"
                        class="education-selected-lessons-empty"
                    >

                        <div class="education-selected-lessons-empty-icon">

                            <i class="fa-solid fa-book-open"></i>

                        </div>

                        <h4>
                            {{ __('education_admin.lesson_assignments.create.lessons.empty_title') }}
                        </h4>

                        <p>
                            {{ __('education_admin.lesson_assignments.create.lessons.empty_description') }}
                        </p>

                    </div>

                </div>

            </div>


            {{-- ==================================================
                NOTES
            =================================================== --}}

            <div class="education-assignment-form-group">

                <label for="notes">

                    {{ __('education_admin.lesson_assignments.create.notes.label') }}

                    <small>
                        {{ __('education_admin.lesson_assignments.create.notes.optional') }}
                    </small>

                </label>

                <textarea
                    name="notes"
                    id="notes"
                    rows="5"
                    maxlength="5000"
                    placeholder="{{ __('education_admin.lesson_assignments.create.notes.placeholder') }}"
                >{{ old('notes') }}</textarea>


                @error('notes')

                    <div class="education-assignment-error">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            {{-- ==================================================
                ACTIVE
            =================================================== --}}

            <div class="education-assignment-checkbox">

                <label>

                    <input
                        type="hidden"
                        name="is_active"
                        value="0"
                    >

                    <input
                        type="checkbox"
                        name="is_active"
                        value="1"
                        {{ old('is_active', '1') ? 'checked' : '' }}
                    >

                    <span>
                        {{ __('education_admin.lesson_assignments.create.active') }}
                    </span>

                </label>

            </div>


            {{-- ==================================================
                ACTIONS
            =================================================== --}}

            <div class="education-assignment-form-actions">

                <a
                    href="{{ route('education.admin.lesson-assignments.index') }}"
                    class="education-assignment-cancel-btn"
                >

                    <i class="fa-solid fa-arrow-right"></i>

                    {{ __('education_admin.lesson_assignments.create.actions.cancel') }}

                </a>


                <button
                    type="submit"
                    class="education-assignment-save-btn"
                    id="saveAssignmentButton"
                >

                    <i class="fa-solid fa-link"></i>

                    {{ __('education_admin.lesson_assignments.create.actions.save') }}

                </button>

            </div>

        </form>

    </div>

</div>


{{-- ==============================================================
    STYLES
================================================================ --}}

@push('styles')

<style>

.education-assignment-create-page {

    min-height: 100vh;

    padding: 30px;

    background: #f7f3e9;

    color: #26352d;

}


.education-assignment-create-header {

    margin-bottom: 25px;

}


.education-assignment-create-breadcrumb {

    display: flex;

    align-items: center;

    gap: 9px;

    margin-bottom: 12px;

    color: #9c7a32;

    font-size: 13px;

    font-weight: 700;

}


.education-assignment-create-breadcrumb a {

    color: #214b3a;

    text-decoration: none;

}


.education-assignment-create-breadcrumb a:hover {

    color: #9c7a32;

}


.education-assignment-create-header h1 {

    margin: 0;

    color: #214b3a;

    font-size: 31px;

    font-weight: 800;

}


.education-assignment-create-header p {

    margin: 8px 0 0;

    color: #718078;

}


.education-assignment-alert {

    display: flex;

    align-items: center;

    gap: 10px;

    margin-bottom: 20px;

    padding: 14px 17px;

    border-radius: 12px;

    font-size: 14px;

    font-weight: 700;

}


.education-assignment-alert-success {

    background: #e9f5ed;

    border: 1px solid #cde7d5;

    color: #27613e;

}


.education-assignment-alert-error {

    background: #fbeded;

    border: 1px solid #edcccc;

    color: #8d3939;

}


.education-assignment-validation-errors {

    margin-bottom: 22px;

    padding: 15px 17px;

    border-radius: 12px;

    background: #fff5f5;

    border: 1px solid #efcece;

    color: #8d3939;

}


.education-assignment-validation-title {

    display: flex;

    align-items: center;

    gap: 8px;

    margin-bottom: 8px;

    font-weight: 800;

}


.education-assignment-validation-errors ul {

    margin: 0;

    padding-right: 25px;

}


.education-assignment-validation-errors li {

    margin-bottom: 4px;

    font-size: 13px;

}


.education-assignment-create-card {

    max-width: 950px;

    background: #fff;

    border: 1px solid #e8e0ce;

    border-radius: 18px;

    box-shadow:
        0 10px 35px rgba(33, 75, 58, .06);

    overflow: hidden;

}


.education-assignment-create-card-header {

    display: flex;

    align-items: center;

    gap: 15px;

    padding: 24px;

    border-bottom: 1px solid #eee8da;

}


.education-assignment-create-icon {

    width: 52px;

    height: 52px;

    flex-shrink: 0;

    border-radius: 15px;

    background: #f3ead2;

    color: #9c7a32;

    display: flex;

    align-items: center;

    justify-content: center;

    font-size: 21px;

}


.education-assignment-create-card-header h2 {

    margin: 0;

    color: #214b3a;

    font-size: 20px;

}


.education-assignment-create-card-header p {

    margin: 4px 0 0;

    color: #7b867f;

    font-size: 13px;

}


.education-assignment-form {

    padding: 28px;

}


.education-assignment-form-group {

    margin-bottom: 24px;

}


.education-assignment-form-group label {

    display: block;

    margin-bottom: 9px;

    color: #34473d;

    font-size: 14px;

    font-weight: 700;

}


.education-assignment-form-group label > span {

    color: #b28b3d;

}


.education-assignment-form-group label small {

    margin-right: 6px;

    color: #9a9d99;

    font-weight: 400;

}


.education-assignment-field-help {

    margin: -2px 0 10px;

    color: #7b867f;

    font-size: 12px;

}


.education-assignment-form-group select,
.education-assignment-form-group textarea,
.education-lesson-title-input {

    width: 100%;

    border: 1px solid #ded6c5;

    border-radius: 11px;

    background: #fff;

    color: #263b31;

    outline: none;

    transition: .2s ease;

    box-sizing: border-box;

}


.education-assignment-form-group select {

    height: 48px;

    padding: 0 14px;

}


.education-lesson-title-input {

    height: 48px;

    padding: 0 14px;

}


.education-assignment-form-group textarea {

    padding: 14px;

    resize: vertical;

    min-height: 120px;

}


.education-assignment-form-group select:focus,
.education-assignment-form-group textarea:focus,
.education-lesson-title-input:focus {

    border-color: #9c7a32;

    box-shadow:
        0 0 0 3px rgba(156, 122, 50, .08);

}


.education-assignment-booking-notice {

    min-height: 48px;

    margin-top: 10px;

    padding: 0 14px;

    display: flex;

    align-items: center;

    gap: 9px;

    box-sizing: border-box;

    border-radius: 11px;

    border: 1px solid #eee5d2;

    background: #faf8f2;

    color: #68766e;

    font-size: 13px;

}


.education-assignment-booking-notice i {

    color: #9c7a32;

}


.education-selected-booking-info {

    display: flex;

    align-items: center;

    gap: 12px;

    margin-top: 10px;

    padding: 13px 15px;

    border-radius: 12px;

    background: #f7f4ea;

    border: 1px solid #e8dfca;

}


.education-selected-booking-icon {

    width: 40px;

    height: 40px;

    flex-shrink: 0;

    border-radius: 11px;

    background: #214b3a;

    color: #fff;

    display: flex;

    align-items: center;

    justify-content: center;

}


.education-selected-booking-content {

    min-width: 0;

}


.education-selected-booking-content strong {

    display: block;

    color: #294337;

    font-size: 13px;

}


.education-selected-booking-content span {

    display: block;

    margin-top: 4px;

    color: #7c877f;

    font-size: 11px;

}


.education-lesson-title-input-wrapper {

    display: flex;

    align-items: stretch;

    gap: 10px;

}


.education-lesson-title-input-wrapper .education-lesson-title-input {

    flex: 1;

}


.education-add-lesson-btn {

    min-width: 145px;

    border: 0;

    border-radius: 11px;

    background: #9c7a32;

    color: #fff;

    padding: 0 18px;

    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 8px;

    font-weight: 700;

    cursor: pointer;

    transition: .2s ease;

}


.education-add-lesson-btn:hover {

    background: #806326;

}


.education-add-lesson-btn:disabled {

    opacity: .55;

    cursor: not-allowed;

}


.education-lesson-assignment-notice {

    margin-top: 10px;

    padding: 11px 13px;

    border-radius: 10px;

    background: #faf8f2;

    border: 1px solid #eee5d2;

    color: #756f61;

    font-size: 12px;

}


.education-lesson-assignment-notice i {

    margin-left: 5px;

    color: #9c7a32;

}


.education-remaining-sessions-notice {

    display: flex;

    align-items: center;

    gap: 11px;

    margin-top: 10px;

    padding: 12px 14px;

    border-radius: 11px;

    background: #f4f8f3;

    border: 1px solid #dce9dc;

}


.education-remaining-sessions-icon {

    width: 38px;

    height: 38px;

    flex-shrink: 0;

    border-radius: 10px;

    background: #e5efe5;

    color: #37634a;

    display: flex;

    align-items: center;

    justify-content: center;

}


.education-remaining-sessions-notice strong {

    display: block;

    color: #315640;

    font-size: 12px;

}


.education-remaining-sessions-notice span {

    display: block;

    margin-top: 3px;

    color: #687b6e;

    font-size: 11px;

}


.education-selected-lessons-section {

    margin-bottom: 25px;

    padding: 20px;

    border-radius: 15px;

    border: 1px solid #e8e0ce;

    background: #fcfbf7;

}


.education-selected-lessons-header {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 15px;

    margin-bottom: 16px;

}


.education-selected-lessons-header h3 {

    margin: 0;

    color: #214b3a;

    font-size: 17px;

}


.education-selected-lessons-header p {

    margin: 5px 0 0;

    color: #818a84;

    font-size: 12px;

}


.education-selected-lessons-count {

    min-width: 65px;

    height: 32px;

    padding: 0 10px;

    border-radius: 20px;

    background: #f3ead2;

    color: #8b6d2f;

    display: inline-flex;

    align-items: center;

    justify-content: center;

    font-size: 12px;

    font-weight: 800;

}


.education-selected-lessons-empty {

    padding: 35px 20px;

    text-align: center;

    border: 1px dashed #ddd4c0;

    border-radius: 13px;

}


.education-selected-lessons-empty-icon {

    width: 48px;

    height: 48px;

    margin: 0 auto 10px;

    border-radius: 14px;

    background: #f3ead2;

    color: #9c7a32;

    display: flex;

    align-items: center;

    justify-content: center;

}


.education-selected-lessons-empty h4 {

    margin: 0;

    color: #53645a;

    font-size: 14px;

}


.education-selected-lessons-empty p {

    margin: 5px 0 0;

    color: #929891;

    font-size: 12px;

}


.education-selected-lesson-item {

    display: flex;

    align-items: center;

    gap: 12px;

    min-height: 68px;

    padding: 10px 12px;

    margin-bottom: 9px;

    border: 1px solid #e7dfcc;

    border-radius: 12px;

    background: #fff;

    transition: .2s ease;

}


.education-selected-lesson-item:last-child {

    margin-bottom: 0;

}


.education-selected-lesson-item:hover {

    border-color: #d5c59e;

    box-shadow:
        0 5px 16px rgba(33, 75, 58, .05);

}


.education-selected-lesson-number {

    width: 36px;

    height: 36px;

    flex-shrink: 0;

    border-radius: 10px;

    background: #214b3a;

    color: #fff;

    display: flex;

    align-items: center;

    justify-content: center;

    font-size: 13px;

    font-weight: 800;

}


.education-selected-lesson-info {

    flex: 1;

    min-width: 0;

}


.education-selected-lesson-info strong {

    display: block;

    color: #263d32;

    font-size: 14px;

    overflow: hidden;

    text-overflow: ellipsis;

    white-space: nowrap;

}


.education-selected-lesson-info small {

    display: block;

    margin-top: 4px;

    color: #929890;

    font-size: 11px;

}


.education-remove-lesson-btn {

    width: 36px;

    height: 36px;

    flex-shrink: 0;

    border: 0;

    border-radius: 9px;

    background: #fff0f0;

    color: #a34c4c;

    display: flex;

    align-items: center;

    justify-content: center;

    cursor: pointer;

    transition: .2s ease;

}


.education-remove-lesson-btn:hover {

    background: #f8dede;

    color: #8d3030;

}


.education-assignment-error {

    margin-top: 7px;

    color: #a34444;

    font-size: 12px;

}


.education-assignment-checkbox {

    padding: 15px;

    background: #faf8f2;

    border: 1px solid #eee8da;

    border-radius: 11px;

    margin-bottom: 25px;

}


.education-assignment-checkbox label {

    display: flex;

    align-items: center;

    gap: 9px;

    color: #45554c;

    font-size: 13px;

    cursor: pointer;

}


.education-assignment-checkbox input[type="checkbox"] {

    width: 17px;

    height: 17px;

    accent-color: #214b3a;

}


.education-assignment-form-actions {

    display: flex;

    justify-content: flex-end;

    gap: 10px;

    padding-top: 5px;

}


.education-assignment-cancel-btn,
.education-assignment-save-btn {

    min-height: 46px;

    padding: 0 20px;

    border-radius: 11px;

    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 8px;

    font-weight: 700;

    text-decoration: none;

    box-sizing: border-box;

}


.education-assignment-cancel-btn {

    background: #eee9dc;

    color: #4b5b52 !important;

}


.education-assignment-cancel-btn:hover {

    background: #e4dece;

}


.education-assignment-save-btn {

    border: 0;

    background: #214b3a;

    color: #fff;

    cursor: pointer;

}


.education-assignment-save-btn:hover {

    background: #173b2d;

}


.education-assignment-save-btn:disabled {

    opacity: .65;

    cursor: not-allowed;

}


@media (max-width: 700px) {

    .education-assignment-create-page {

        padding: 18px;

    }


    .education-assignment-create-card-header {

        padding: 19px;

    }


    .education-assignment-form {

        padding: 20px;

    }


    .education-lesson-title-input-wrapper {

        flex-direction: column;

    }


    .education-add-lesson-btn {

        min-height: 46px;

    }


    .education-selected-lessons-header {

        align-items: flex-start;

        flex-direction: column;

    }


    .education-selected-lessons-count {

        align-self: flex-start;

    }


    .education-assignment-form-actions {

        flex-direction: column-reverse;

    }


    .education-assignment-cancel-btn,
    .education-assignment-save-btn {

        width: 100%;

    }

}

</style>

@endpush


{{-- ==============================================================
    JAVASCRIPT
================================================================ --}}

@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | TRANSLATIONS
    |--------------------------------------------------------------------------
    */

    const assignmentTranslations = {

        count_one:
            @json(__('education_admin.lesson_assignments.create.lessons.count_one')),

        count_many:
            @json(__('education_admin.lesson_assignments.create.lessons.count_many')),


        educational_booking:
            @json(__('education_admin.lesson_assignments.create.booking.educational_booking')),

        sessions_count:
            @json(__('education_admin.lesson_assignments.create.booking.sessions_count')),

        single_booking:
            @json(__('education_admin.lesson_assignments.create.booking.single_booking')),


        remaining_zero:
            @json(__('education_admin.lesson_assignments.create.lessons.remaining_zero')),

        remaining_after:
            @json(__('education_admin.lesson_assignments.create.lessons.remaining_after')),

        remaining_available:
            @json(__('education_admin.lesson_assignments.create.lessons.remaining_available')),


        notice_select_booking:
            @json(__('education_admin.lesson_assignments.create.lessons.notice_select_booking')),

        student_lesson_note:
            @json(__('education_admin.lesson_assignments.create.lessons.student_lesson_note')),

        remove:
            @json(__('education_admin.lesson_assignments.create.lessons.remove')),


        select_student_first:
            @json(__('education_admin.lesson_assignments.create.alerts.select_student_first')),

        select_booking_first:
            @json(__('education_admin.lesson_assignments.create.alerts.select_booking_first')),

        max_sessions:
            @json(__('education_admin.lesson_assignments.create.alerts.max_sessions')),

        duplicate_title:
            @json(__('education_admin.lesson_assignments.create.alerts.duplicate_title')),

        select_student:
            @json(__('education_admin.lesson_assignments.create.alerts.select_student')),

        select_booking:
            @json(__('education_admin.lesson_assignments.create.alerts.select_booking')),

        add_one:
            @json(__('education_admin.lesson_assignments.create.alerts.add_one')),


        saving:
            @json(__('education_admin.lesson_assignments.create.actions.saving')),

        notice_select:
            @json(__('education_admin.lesson_assignments.create.lessons.notice_select')),

    };


    /*
    |--------------------------------------------------------------------------
    | ELEMENTS
    |--------------------------------------------------------------------------
    */

    const studentSelect =
        document.getElementById(
            'education_user_id'
        );


    const bookingSelect =
        document.getElementById(
            'education_booking_id'
        );


    const lessonTitleInput =
        document.getElementById(
            'lessonTitleInput'
        );


    const addLessonButton =
        document.getElementById(
            'addLessonButton'
        );


    const selectedLessonsContainer =
        document.getElementById(
            'selected-lessons-container'
        );


    const selectedLessonsEmpty =
        document.getElementById(
            'selectedLessonsEmpty'
        );


    const selectedLessonsCount =
        document.getElementById(
            'selectedLessonsCount'
        );


    const form =
        document.getElementById(
            'educationAssignmentForm'
        );


    const saveButton =
        document.getElementById(
            'saveAssignmentButton'
        );


    const selectedBookingInfo =
        document.getElementById(
            'selectedBookingInfo'
        );


    const selectedBookingIcon =
        document.getElementById(
            'selectedBookingIcon'
        );


    const selectedBookingTitle =
        document.getElementById(
            'selectedBookingTitle'
        );


    const selectedBookingMeta =
        document.getElementById(
            'selectedBookingMeta'
        );


    const lessonAssignmentNotice =
        document.getElementById(
            'lessonAssignmentNotice'
        );


    const remainingSessionsNotice =
        document.getElementById(
            'remainingSessionsNotice'
        );


    const remainingSessionsText =
        document.getElementById(
            'remainingSessionsText'
        );


    /*
    |--------------------------------------------------------------------------
    | SELECTED LESSONS
    |--------------------------------------------------------------------------
    */

    let selectedLessons = [];


    /*
    |--------------------------------------------------------------------------
    | OLD VALUES
    |--------------------------------------------------------------------------
    */

    const oldLessonTitles = @json(
        array_values(
            array_filter(
                (array) old(
                    'lesson_titles',
                    []
                )
            )
        )
    );


    /*
    |--------------------------------------------------------------------------
    | ESCAPE HTML
    |--------------------------------------------------------------------------
    */

    function escapeHtml(value) {

        if (
            value === null ||
            value === undefined
        ) {

            return '';

        }


        return String(value)

            .replace(
                /&/g,
                '&amp;'
            )

            .replace(
                /</g,
                '&lt;'
            )

            .replace(
                />/g,
                '&gt;'
            )

            .replace(
                /"/g,
                '&quot;'
            )

            .replace(
                /'/g,
                '&#039;'
            );

    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE COUNT
    |--------------------------------------------------------------------------
    */

    function updateCount() {

        const count =
            selectedLessons.length;


        selectedLessonsCount.textContent =
            count === 1
                ? replaceTranslation(
                    assignmentTranslations.count_one,
                    count
                )
                : replaceTranslation(
                    assignmentTranslations.count_many,
                    count
                );

    }


    function replaceTranslation(
        translation,
        count
    ) {

        return translation.replace(
            ':count',
            count
        );

    }


    /*
    |--------------------------------------------------------------------------
    | GET BOOKING OPTION
    |--------------------------------------------------------------------------
    */

    function getSelectedBookingOption() {

        if (!bookingSelect) {

            return null;

        }


        const option =
            bookingSelect.options[
                bookingSelect.selectedIndex
            ];


        if (
            !option ||
            !option.value
        ) {

            return null;

        }


        return option;

    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE BOOKING INFO
    |--------------------------------------------------------------------------
    */

    function updateSelectedBookingInfo() {

        const option =
            getSelectedBookingOption();


        if (
            !option ||
            option.hidden
        ) {

            if (selectedBookingInfo) {

                selectedBookingInfo.style.display =
                    'none';

            }

            updateRemainingSessions();

            return;

        }


        const type =
            option.dataset.type;


        const total =
            parseInt(
                option.dataset.totalSessions || 0,
                10
            );


        const completed =
            parseInt(
                option.dataset.completedSessions || 0,
                10
            );


        const existing =
            parseInt(
                option.dataset.existingLessons || 0,
                10
            );


        const remaining =
            parseInt(
                option.dataset.remainingSessions || 0,
                10
            );


        const title =
            option.dataset.title ||
            assignmentTranslations.educational_booking;


        const bookingType =
            option.dataset.bookingType ||
            '';


        if (type === 'package') {

            selectedBookingIcon.className =
                'fa-solid fa-box-open';


            selectedBookingTitle.textContent =
                title;


            selectedBookingMeta.textContent =
                (
                    bookingType
                        ? bookingType + ' — '
                        : ''
                )
                +
                replaceBookingMeta(
                    assignmentTranslations.sessions_count,
                    total,
                    completed,
                    existing
                );

        } else {

            selectedBookingIcon.className =
                'fa-solid fa-book-open';


            selectedBookingTitle.textContent =
                title;


            selectedBookingMeta.textContent =
                (
                    bookingType
                        ? bookingType + ' — '
                        : ''
                )
                +
                assignmentTranslations.single_booking;

        }


        selectedBookingInfo.style.display =
            'flex';


        updateRemainingSessions();

    }


    function replaceBookingMeta(
        translation,
        total,
        completed,
        assigned
    ) {

        return translation
            .replace(':total', total)
            .replace(':completed', completed)
            .replace(':assigned', assigned);

    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE REMAINING SESSIONS
    |--------------------------------------------------------------------------
    */

    function updateRemainingSessions() {

        const option =
            getSelectedBookingOption();


        if (
            !option ||
            option.hidden
        ) {

            remainingSessionsNotice.style.display =
                'none';

            return;

        }


        const remaining =
            parseInt(
                option.dataset.remainingSessions || 0,
                10
            );


        const currentlyAdded =
            selectedLessons.length;


        const availableAfterSelection =
            Math.max(
                0,
                remaining - currentlyAdded
            );


        remainingSessionsNotice.style.display =
            'flex';


        if (remaining <= 0) {

            remainingSessionsText.textContent =
                assignmentTranslations.remaining_zero;

            addLessonButton.disabled =
                true;

            return;

        }


        if (currentlyAdded > 0) {

            remainingSessionsText.textContent =
                assignmentTranslations.remaining_after
                    .replace(':remaining', remaining)
                    .replace(':available', availableAfterSelection);

        } else {

            remainingSessionsText.textContent =
                assignmentTranslations.remaining_available
                    .replace(':remaining', remaining);

        }


        addLessonButton.disabled =
            false;

    }


    /*
    |--------------------------------------------------------------------------
    | FILTER BOOKINGS BY STUDENT
    |--------------------------------------------------------------------------
    */

    function filterBookingsByStudent() {

        if (!bookingSelect) {

            return;

        }


        const studentId =
            String(
                studentSelect.value || ''
            );


        Array.from(
            bookingSelect.options
        ).forEach(
            function (option) {

                if (!option.value) {

                    option.hidden = false;

                    return;

                }


                const optionStudentId =
                    String(
                        option.dataset.studentId || ''
                    );


                option.hidden =
                    !studentId ||
                    optionStudentId !== studentId;

            }
        );


        const selectedOption =
            bookingSelect.options[
                bookingSelect.selectedIndex
            ];


        if (
            selectedOption &&
            selectedOption.hidden
        ) {

            bookingSelect.value = '';

        }


        updateSelectedBookingInfo();

        updateLessonAvailability();

    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE LESSON AVAILABILITY
    |--------------------------------------------------------------------------
    */

    function updateLessonAvailability() {

        const hasStudent =
            studentSelect &&
            studentSelect.value;


        const hasBooking =
            bookingSelect &&
            bookingSelect.value;


        if (
            !hasStudent ||
            !hasBooking
        ) {

            lessonTitleInput.disabled =
                true;


            addLessonButton.disabled =
                true;


            lessonAssignmentNotice.style.display =
                'block';


            lessonAssignmentNotice.innerHTML = `

                <i class="fa-solid fa-circle-info"></i>

                ${assignmentTranslations.notice_select_booking}

            `;


            return;

        }


        lessonTitleInput.disabled =
            false;


        lessonAssignmentNotice.style.display =
            'none';


        updateRemainingSessions();

    }


    /*
    |--------------------------------------------------------------------------
    | ADD LESSON TITLE
    |--------------------------------------------------------------------------
    */

    function addLesson() {

        /*
        |--------------------------------------------------------------------------
        | STUDENT
        |--------------------------------------------------------------------------
        */

        if (
            !studentSelect.value
        ) {

            alert(
                assignmentTranslations.select_student_first
            );


            studentSelect.focus();

            return;

        }


        /*
        |--------------------------------------------------------------------------
        | BOOKING
        |--------------------------------------------------------------------------
        */

        if (
            !bookingSelect.value
        ) {

            alert(
                assignmentTranslations.select_booking_first
            );


            bookingSelect.focus();

            return;

        }


        /*
        |--------------------------------------------------------------------------
        | TITLE
        |--------------------------------------------------------------------------
        */

        const title =
            lessonTitleInput.value.trim();


        if (!title) {

            lessonTitleInput.focus();

            return;

        }


        /*
        |--------------------------------------------------------------------------
        | MAX SESSIONS
        |--------------------------------------------------------------------------
        */

        const option =
            getSelectedBookingOption();


        const remaining =
            option
                ? parseInt(
                    option.dataset.remainingSessions || 0,
                    10
                )
                : 0;


        if (
            selectedLessons.length >= remaining
        ) {

            alert(
                assignmentTranslations.max_sessions
            );

            return;

        }


        /*
        |--------------------------------------------------------------------------
        | DUPLICATE TITLE
        |--------------------------------------------------------------------------
        */

        const exists =
            selectedLessons.some(
                function (lesson) {

                    return lesson.title
                        .toLowerCase()
                        ===
                        title.toLowerCase();

                }
            );


        if (exists) {

            alert(
                assignmentTranslations.duplicate_title
            );


            lessonTitleInput.focus();

            return;

        }


        /*
        |--------------------------------------------------------------------------
        | ADD
        |--------------------------------------------------------------------------
        */

        selectedLessons.push({

            title: title

        });


        lessonTitleInput.value =
            '';


        renderSelectedLessons();

        lessonTitleInput.focus();

    }


    /*
    |--------------------------------------------------------------------------
    | RENDER LESSONS
    |--------------------------------------------------------------------------
    */

    function renderSelectedLessons() {

        /*
        |--------------------------------------------------------------------------
        | EMPTY
        |--------------------------------------------------------------------------
        */

        if (
            selectedLessons.length === 0
        ) {

            selectedLessonsEmpty.style.display =
                'block';


            selectedLessonsContainer
                .querySelectorAll(
                    '.education-selected-lesson-item'
                )
                .forEach(
                    function (element) {

                        element.remove();

                    }
                );


            updateCount();

            updateRemainingSessions();

            return;

        }


        /*
        |--------------------------------------------------------------------------
        | HIDE EMPTY
        |--------------------------------------------------------------------------
        */

        selectedLessonsEmpty.style.display =
            'none';


        /*
        |--------------------------------------------------------------------------
        | REMOVE OLD ITEMS
        |--------------------------------------------------------------------------
        */

        selectedLessonsContainer
            .querySelectorAll(
                '.education-selected-lesson-item'
            )
            .forEach(
                function (element) {

                    element.remove();

                }
            );


        /*
        |--------------------------------------------------------------------------
        | CREATE ITEMS
        |--------------------------------------------------------------------------
        */

        selectedLessons.forEach(
            function (lesson, index) {

                const item =
                    document.createElement(
                        'div'
                    );


                item.className =
                    'education-selected-lesson-item';


                item.innerHTML = `

                    <div class="education-selected-lesson-number">

                        ${index + 1}

                    </div>


                    <div class="education-selected-lesson-info">

                        <strong>

                            ${escapeHtml(
                                lesson.title
                            )}

                        </strong>


                        <small>

                            ${assignmentTranslations.student_lesson_note}

                        </small>

                    </div>


                    <input
                        type="hidden"
                        name="lesson_titles[]"
                        value="${escapeHtml(
                            lesson.title
                        )}"
                    >


                    <button
                        type="button"
                        class="education-remove-lesson-btn"
                        data-index="${index}"
                        title="${assignmentTranslations.remove}"
                    >

                        <i class="fa-solid fa-xmark"></i>

                    </button>

                `;


                /*
                |------------------------------------------------------------------
                | REMOVE
                |------------------------------------------------------------------
                */

                const removeButton =
                    item.querySelector(
                        '.education-remove-lesson-btn'
                    );


                removeButton.addEventListener(
                    'click',
                    function () {

                        const index =
                            parseInt(
                                this.dataset.index,
                                10
                            );


                        selectedLessons.splice(
                            index,
                            1
                        );


                        renderSelectedLessons();

                    }
                );


                selectedLessonsContainer
                    .appendChild(item);

            }
        );


        updateCount();

        updateRemainingSessions();

    }


    /*
    |--------------------------------------------------------------------------
    | STUDENT CHANGE
    |--------------------------------------------------------------------------
    */

    if (studentSelect) {

        studentSelect.addEventListener(
            'change',
            function () {

                selectedLessons = [];

                renderSelectedLessons();

                filterBookingsByStudent();

            }
        );

    }


    /*
    |--------------------------------------------------------------------------
    | BOOKING CHANGE
    |--------------------------------------------------------------------------
    */

    if (bookingSelect) {

        bookingSelect.addEventListener(
            'change',
            function () {

                selectedLessons = [];

                renderSelectedLessons();

                updateSelectedBookingInfo();

                updateLessonAvailability();

            }
        );

    }


    /*
    |--------------------------------------------------------------------------
    | ADD BUTTON
    |--------------------------------------------------------------------------
    */

    if (addLessonButton) {

        addLessonButton.addEventListener(
            'click',
            function () {

                addLesson();

            }
        );

    }


    /*
    |--------------------------------------------------------------------------
    | ENTER KEY
    |--------------------------------------------------------------------------
    */

    if (lessonTitleInput) {

        lessonTitleInput.addEventListener(
            'keydown',
            function (event) {

                if (
                    event.key === 'Enter'
                ) {

                    event.preventDefault();

                    addLesson();

                }

            }
        );

    }


    /*
    |--------------------------------------------------------------------------
    | RESTORE OLD TITLES
    |--------------------------------------------------------------------------
    */

    if (
        Array.isArray(oldLessonTitles) &&
        oldLessonTitles.length
    ) {

        oldLessonTitles.forEach(
            function (title) {

                const cleanTitle =
                    String(title).trim();


                if (!cleanTitle) {

                    return;

                }


                const exists =
                    selectedLessons.some(
                        function (lesson) {

                            return lesson.title
                                .toLowerCase()
                                ===
                                cleanTitle.toLowerCase();

                        }
                    );


                if (!exists) {

                    selectedLessons.push({

                        title: cleanTitle

                    });

                }

            }
        );


        renderSelectedLessons();

    }


    /*
    |--------------------------------------------------------------------------
    | FORM SUBMIT
    |--------------------------------------------------------------------------
    */

    if (form) {

        form.addEventListener(
            'submit',
            function (event) {

                /*
                |--------------------------------------------------------------------------
                | STUDENT
                |--------------------------------------------------------------------------
                */

                if (
                    !studentSelect.value
                ) {

                    event.preventDefault();


                    alert(
                        assignmentTranslations.select_student
                    );


                    studentSelect.focus();

                    return;

                }


                /*
                |--------------------------------------------------------------------------
                | BOOKING
                |--------------------------------------------------------------------------
                */

                if (
                    !bookingSelect.value
                ) {

                    event.preventDefault();


                    alert(
                        assignmentTranslations.select_booking
                    );


                    bookingSelect.focus();

                    return;

                }


                /*
                |--------------------------------------------------------------------------
                | LESSONS
                |--------------------------------------------------------------------------
                */

                if (
                    selectedLessons.length === 0
                ) {

                    event.preventDefault();


                    alert(
                        assignmentTranslations.add_one
                    );


                    lessonTitleInput.focus();

                    return;

                }


                /*
                |--------------------------------------------------------------------------
                | DISABLE BUTTON
                |--------------------------------------------------------------------------
                */

                saveButton.disabled =
                    true;


                saveButton.innerHTML = `

                    <i class="fa-solid fa-spinner fa-spin"></i>

                    ${assignmentTranslations.saving}

                `;

            }
        );

    }


    /*
    |--------------------------------------------------------------------------
    | INITIALIZE
    |--------------------------------------------------------------------------
    */

    filterBookingsByStudent();

    updateSelectedBookingInfo();

    updateLessonAvailability();

    updateCount();

});

</script>

@endpush

@endsection
