@extends('education.admin.layouts.app')

@section('title', __('education_admin.student_lesson_create.page_title'))

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
                    {{ __('education_admin.student_lesson_create.header.education') }}
                </a>

                <span>/</span>

                <a href="{{ route('education.admin.student-lessons.index') }}">
                    {{ __('education_admin.student_lesson_create.header.student_lessons') }}
                </a>

                <span>/</span>

                <span>{{ __('education_admin.student_lesson_create.header.create') }}</span>

            </div>

            <h1>
                {{ __('education_admin.student_lesson_create.header.title') }}
            </h1>

            <p>
                {{ __('education_admin.student_lesson_create.header.description') }}
            </p>

        </div>


        <div class="page-header-actions">

            <a
                href="{{ route('education.admin.student-lessons.index') }}"
                class="btn btn-secondary"
            >
                <i class="fa-solid fa-arrow-right"></i>
                {{ __('education_admin.student_lesson_create.actions.back') }}
            </a>

        </div>

    </div>


    {{-- ============================================================
        ERRORS
    ============================================================ --}}

    @if($errors->any())

        <div class="alert alert-danger">

            <div class="alert-icon">
                <i class="fa-solid fa-circle-exclamation"></i>
            </div>

            <div>

                <strong>
                    {{ __('education_admin.student_lesson_create.validation.title') }}
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
        action="{{ route('education.admin.student-lessons.store') }}"
        method="POST"
        id="studentLessonForm"
    >

        @csrf


        <div class="create-grid">


            {{-- ====================================================
                STUDENT / BOOKING
            ==================================================== --}}

            <div class="education-card">

                <div class="card-header">

                    <div class="card-header-icon">
                        <i class="fa-solid fa-user-graduate"></i>
                    </div>

                    <div>

                        <h2>
                            {{ __('education_admin.student_lesson_create.student_booking.title') }}
                        </h2>

                        <p>
                            {{ __('education_admin.student_lesson_create.student_booking.description') }}
                        </p>

                    </div>

                </div>


                <div class="card-body">


                    {{-- =================================================
                        STUDENT
                    ================================================= --}}

                    <div class="form-group">

                        <label for="education_user_id">

                            <i class="fa-solid fa-user"></i>

                            {{ __('education_admin.student_lesson_create.student_booking.student.label') }}

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
                                {{ __('education_admin.student_lesson_create.student_booking.student.placeholder') }}
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

                            <div class="field-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- =================================================
                        BOOKING
                    ================================================= --}}

                    <div class="form-group">

                        <label for="education_booking_id">

                            <i class="fa-solid fa-calendar-check"></i>

                            {{ __('education_admin.student_lesson_create.student_booking.booking.label') }}

                            <span class="required">
                                *
                            </span>

                        </label>


                        <select
                            name="education_booking_id"
                            id="education_booking_id"
                            class="form-control @error('education_booking_id') is-invalid @enderror"
                            required
                            disabled
                        >

                            <option value="">
                                {{ __('education_admin.student_lesson_create.student_booking.booking.placeholder_initial') }}
                            </option>


                            @foreach($bookings as $booking)

                                @php

                                    $totalSessions =
                                        (int) ($booking->total_sessions ?? 1);

                                    $createdSessions =
                                        $booking->studentLessons->count();

                                    $remainingSessions =
                                        max(
                                            0,
                                            $totalSessions - $createdSessions
                                        );

                                    $paymentStatus =
                                        strtolower(
                                            trim(
                                                (string) (
                                                    $booking->payment_status
                                                    ?? ''
                                                )
                                            )
                                        );

                                    $bookingStatus =
                                        strtolower(
                                            trim(
                                                (string) (
                                                    $booking->status
                                                    ?? ''
                                                )
                                            )
                                        );

                                    $isPaid =
                                        in_array(
                                            $paymentStatus,
                                            [
                                                'paid',
                                                'completed',
                                                'approved',
                                                'success',
                                                'successful',
                                            ],
                                            true
                                        );

                                    $isConfirmed =
                                        in_array(
                                            $bookingStatus,
                                            [
                                                'confirmed',
                                                'approved',
                                                'active',
                                            ],
                                            true
                                        );

                                    $canCreateLesson =
                                        $isPaid
                                        &&
                                        $isConfirmed
                                        &&
                                        $remainingSessions > 0;

                                @endphp


                                <option
                                    value="{{ $booking->id }}"
                                    data-student="{{ $booking->education_user_id }}"
                                    data-title="{{ $booking->title }}"
                                    data-total="{{ $totalSessions }}"
                                    data-created="{{ $createdSessions }}"
                                    data-remaining="{{ $remainingSessions }}"
                                    data-payment="{{ $paymentStatus }}"
                                    data-status="{{ $bookingStatus }}"
                                    data-paid="{{ $isPaid ? '1' : '0' }}"
                                    data-confirmed="{{ $isConfirmed ? '1' : '0' }}"
                                    data-available="{{ $canCreateLesson ? '1' : '0' }}"
                                >

                                    {{ $booking->title }}

                                    —

                                    {{ $booking->booking_date?->format('Y-m-d') }}

                                    —

                                    @if($canCreateLesson)

                                        {{ $remainingSessions }}
                                        {{ $remainingSessions == 1
                                            ? __('education_admin.student_lesson_create.student_booking.booking.remaining')
                                            : __('education_admin.student_lesson_create.student_booking.booking.remaining_plural')
                                        }}

                                    @elseif(!$isPaid)

                                        {{ __('education_admin.student_lesson_create.student_booking.booking.unpaid') }}

                                    @elseif(!$isConfirmed)

                                        {{ __('education_admin.student_lesson_create.student_booking.booking.unconfirmed') }}

                                    @else

                                        {{ __('education_admin.student_lesson_create.student_booking.booking.no_remaining') }}

                                    @endif

                                </option>

                            @endforeach

                        </select>


                        @error('education_booking_id')

                            <div class="field-error">
                                {{ $message }}
                            </div>

                        @enderror


                        <div
                            id="bookingEmptyMessage"
                            class="booking-empty-message"
                        >

                            <i class="fa-solid fa-circle-info"></i>

                            {{ __('education_admin.student_lesson_create.student_booking.booking.empty_initial') }}

                        </div>

                    </div>


                    {{-- =================================================
                        BOOKING DETAILS
                    ================================================= --}}

                    <div
                        id="bookingDetails"
                        class="booking-details"
                        style="display:none;"
                    >

                        <div class="booking-details-header">

                            <div class="booking-details-icon">
                                <i class="fa-solid fa-receipt"></i>
                            </div>

                            <div>

                                <strong id="bookingDetailsTitle">
                                    —
                                </strong>

                                <span>
                                    {{ __('education_admin.student_lesson_create.booking_details.title') }}
                                </span>

                            </div>

                        </div>


                        <div class="booking-stats">

                            <div class="booking-stat">

                                <span>
                                    {{ __('education_admin.student_lesson_create.booking_details.total_sessions') }}
                                </span>

                                <strong id="bookingTotal">
                                    0
                                </strong>

                            </div>


                            <div class="booking-stat">

                                <span>
                                    {{ __('education_admin.student_lesson_create.booking_details.created_sessions') }}
                                </span>

                                <strong id="bookingCreated">
                                    0
                                </strong>

                            </div>


                            <div class="booking-stat remaining">

                                <span>
                                    {{ __('education_admin.student_lesson_create.booking_details.remaining') }}
                                </span>

                                <strong id="bookingRemaining">
                                    0
                                </strong>

                            </div>

                        </div>


                        <div class="booking-meta">

                            <div>

                                <i class="fa-solid fa-money-check-dollar"></i>

                                <span>
                                    {{ __('education_admin.student_lesson_create.booking_details.payment') }}
                                </span>

                                <strong id="bookingPayment">
                                    —
                                </strong>

                            </div>


                            <div>

                                <i class="fa-solid fa-circle-check"></i>

                                <span>
                                    {{ __('education_admin.student_lesson_create.booking_details.booking_status') }}
                                </span>

                                <strong id="bookingStatus">
                                    —
                                </strong>

                            </div>

                        </div>

                    </div>


                    {{-- =================================================
                        SESSION NUMBER
                    ================================================= --}}

                    <div class="form-group">

                        <label for="session_number">

                            <i class="fa-solid fa-list-ol"></i>

                            {{ __('education_admin.student_lesson_create.session.label') }}

                        </label>


                        <input
                            type="number"
                            name="session_number"
                            id="session_number"
                            class="form-control @error('session_number') is-invalid @enderror"
                            value="{{ old('session_number') }}"
                            min="1"
                            placeholder="{{ __('education_admin.student_lesson_create.session.placeholder') }}"
                        >


                        <div class="field-help">

                            {{ __('education_admin.student_lesson_create.session.help') }}

                        </div>


                        @error('session_number')

                            <div class="field-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- =================================================
                        GENERAL LESSON
                    ================================================= --}}

                    <div class="form-group">

                        <label for="source_lesson_id">

                            <i class="fa-solid fa-book-open"></i>

                            {{ __('education_admin.student_lesson_create.source_lesson.label') }}

                            <span class="optional">
                                {{ __('education_admin.student_lesson_create.source_lesson.optional') }}
                            </span>

                        </label>


                        <select
                            name="source_lesson_id"
                            id="source_lesson_id"
                            class="form-control @error('source_lesson_id') is-invalid @enderror"
                        >

                            <option value="">
                                {{ __('education_admin.student_lesson_create.source_lesson.without_lesson') }}
                            </option>


                            @foreach($lessons as $lesson)

                                <option
                                    value="{{ $lesson->id }}"
                                    @selected(
                                        old('source_lesson_id') == $lesson->id
                                    )
                                >

                                    {{ $lesson->title }}

                                </option>

                            @endforeach

                        </select>


                        <div class="field-help">

                            {{ __('education_admin.student_lesson_create.source_lesson.help') }}

                        </div>


                        @error('source_lesson_id')

                            <div class="field-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                </div>

            </div>


            {{-- ====================================================
                LESSON DATA
            ==================================================== --}}

            <div class="education-card">

                <div class="card-header">

                    <div class="card-header-icon">
                        <i class="fa-solid fa-book"></i>
                    </div>

                    <div>

                        <h2>
                            {{ __('education_admin.student_lesson_create.lesson_data.title') }}
                        </h2>

                        <p>
                            {{ __('education_admin.student_lesson_create.lesson_data.description') }}
                        </p>

                    </div>

                </div>


                <div class="card-body">


                    {{-- =================================================
                        TITLE
                    ================================================= --}}

                    <div class="form-group">

                        <label for="title">

                            <i class="fa-solid fa-heading"></i>

                            {{ __('education_admin.student_lesson_create.lesson_data.title_field.label') }}

                            <span class="required">
                                *
                            </span>

                        </label>


                        <input
                            type="text"
                            name="title"
                            id="title"
                            class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title') }}"
                            placeholder="{{ __('education_admin.student_lesson_create.lesson_data.title_field.placeholder') }}"
                            maxlength="255"
                            required
                        >


                        @error('title')

                            <div class="field-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- =================================================
                        DESCRIPTION
                    ================================================= --}}

                    <div class="form-group">

                        <label for="description">

                            <i class="fa-solid fa-align-left"></i>

                            {{ __('education_admin.student_lesson_create.lesson_data.description_field.label') }}

                        </label>


                        <textarea
                            name="description"
                            id="description"
                            class="form-control textarea @error('description') is-invalid @enderror"
                            rows="7"
                            placeholder="{{ __('education_admin.student_lesson_create.lesson_data.description_field.placeholder') }}"
                        >{{ old('description') }}</textarea>


                        @error('description')

                            <div class="field-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- =================================================
                        STATUS
                    ================================================= --}}

                    <div class="form-group">

                        <label for="status">

                            <i class="fa-solid fa-chart-line"></i>

                            {{ __('education_admin.student_lesson_create.lesson_data.status.label') }}

                            <span class="required">
                                *
                            </span>

                        </label>


                        <select
                            name="status"
                            id="status"
                            class="form-control @error('status') is-invalid @enderror"
                            required
                        >

                            <option
                                value="assigned"
                                @selected(
                                    old('status', 'assigned') === 'assigned'
                                )
                            >
                                {{ __('education_admin.student_lesson_create.lesson_data.status.assigned') }}
                            </option>


                            <option
                                value="in_progress"
                                @selected(
                                    old('status') === 'in_progress'
                                )
                            >
                                {{ __('education_admin.student_lesson_create.lesson_data.status.in_progress') }}
                            </option>


                            <option
                                value="completed"
                                @selected(
                                    old('status') === 'completed'
                                )
                            >
                                {{ __('education_admin.student_lesson_create.lesson_data.status.completed') }}
                            </option>


                            <option
                                value="cancelled"
                                @selected(
                                    old('status') === 'cancelled'
                                )
                            >
                                {{ __('education_admin.student_lesson_create.lesson_data.status.cancelled') }}
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

                            {{ __('education_admin.student_lesson_create.lesson_data.assigned_at.label') }}

                        </label>


                        <input
                            type="datetime-local"
                            name="assigned_at"
                            id="assigned_at"
                            class="form-control @error('assigned_at') is-invalid @enderror"
                            value="{{ old('assigned_at') }}"
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

                            {{ __('education_admin.student_lesson_create.lesson_data.notes.label') }}

                        </label>


                        <textarea
                            name="notes"
                            id="notes"
                            class="form-control textarea @error('notes') is-invalid @enderror"
                            rows="6"
                            maxlength="5000"
                            placeholder="{{ __('education_admin.student_lesson_create.lesson_data.notes.placeholder') }}"
                        >{{ old('notes') }}</textarea>


                        @error('notes')

                            <div class="field-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- =================================================
                        ACTIVE
                    ================================================= --}}

                    <div class="switch-row">

                        <div class="switch-content">

                            <div class="switch-icon">
                                <i class="fa-solid fa-eye"></i>
                            </div>

                            <div>

                                <strong>
                                    {{ __('education_admin.student_lesson_create.lesson_data.active.title') }}
                                </strong>

                                <p>
                                    {{ __('education_admin.student_lesson_create.lesson_data.active.description') }}
                                </p>

                            </div>

                        </div>


                        <label class="switch">

                            <input
                                type="checkbox"
                                name="is_active"
                                value="1"
                                @checked(
                                    old('is_active', true)
                                )
                            >

                            <span class="slider"></span>

                        </label>

                    </div>

                </div>

            </div>

        </div>


        {{-- ============================================================
            ACTIONS
        ============================================================ --}}

        <div class="education-card form-actions-card">

            <div class="form-actions">

                <a
                    href="{{ route('education.admin.student-lessons.index') }}"
                    class="btn btn-secondary"
                >
                    <i class="fa-solid fa-xmark"></i>
                    {{ __('education_admin.student_lesson_create.actions.cancel') }}
                </a>


                <button
                    type="submit"
                    class="btn btn-primary"
                    id="submitButton"
                    disabled
                >
                    <i class="fa-solid fa-plus"></i>
                    {{ __('education_admin.student_lesson_create.actions.create') }}
                </button>

            </div>

        </div>

    </form>

</div>


{{-- ================================================================
    JAVASCRIPT
================================================================ --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const studentSelect =
        document.getElementById('education_user_id');

    const bookingSelect =
        document.getElementById('education_booking_id');

    const bookingEmptyMessage =
        document.getElementById('bookingEmptyMessage');

    const bookingDetails =
        document.getElementById('bookingDetails');

    const bookingDetailsTitle =
        document.getElementById('bookingDetailsTitle');

    const bookingTotal =
        document.getElementById('bookingTotal');

    const bookingCreated =
        document.getElementById('bookingCreated');

    const bookingRemaining =
        document.getElementById('bookingRemaining');

    const bookingPayment =
        document.getElementById('bookingPayment');

    const bookingStatus =
        document.getElementById('bookingStatus');

    const sessionNumber =
        document.getElementById('session_number');

    const submitButton =
        document.getElementById('submitButton');


    /*
    |--------------------------------------------------------------------------
    | ORIGINAL BOOKINGS
    |--------------------------------------------------------------------------
    */

    const originalOptions =
        Array.from(
            bookingSelect.querySelectorAll(
                'option[data-student]'
            )
        );


    /*
    |--------------------------------------------------------------------------
    | OLD VALUES
    |--------------------------------------------------------------------------
    */

    const oldBooking =
        @json(old('education_booking_id'));


    const oldStudent =
        @json(old('education_user_id'));


    /*
    |--------------------------------------------------------------------------
    | FORMAT PAYMENT
    |--------------------------------------------------------------------------
    */

    function formatPaymentStatus(status) {

        if (!status) {
            return @json(__('education_admin.student_lesson_create.booking_details.payment_status.undefined'));
        }

        const values = {

            paid: @json(__('education_admin.student_lesson_create.booking_details.payment_status.paid')),

            completed: @json(__('education_admin.student_lesson_create.booking_details.payment_status.paid')),

            approved: @json(__('education_admin.student_lesson_create.booking_details.payment_status.approved')),

            success: @json(__('education_admin.student_lesson_create.booking_details.payment_status.paid')),

            successful: @json(__('education_admin.student_lesson_create.booking_details.payment_status.paid')),

            pending: @json(__('education_admin.student_lesson_create.booking_details.payment_status.pending')),

            unpaid: @json(__('education_admin.student_lesson_create.booking_details.payment_status.unpaid')),

            failed: @json(__('education_admin.student_lesson_create.booking_details.payment_status.failed')),

            cancelled: @json(__('education_admin.student_lesson_create.booking_details.payment_status.cancelled')),

        };

        return values[status] ?? status;
    }


    /*
    |--------------------------------------------------------------------------
    | FORMAT BOOKING STATUS
    |--------------------------------------------------------------------------
    */

    function formatBookingStatus(status) {

        if (!status) {
            return @json(__('education_admin.student_lesson_create.booking_details.status.undefined'));
        }

        const values = {

            pending: @json(__('education_admin.student_lesson_create.booking_details.status.pending')),

            confirmed: @json(__('education_admin.student_lesson_create.booking_details.status.confirmed')),

            approved: @json(__('education_admin.student_lesson_create.booking_details.status.approved')),

            active: @json(__('education_admin.student_lesson_create.booking_details.status.active')),

            completed: @json(__('education_admin.student_lesson_create.booking_details.status.completed')),

            cancelled: @json(__('education_admin.student_lesson_create.booking_details.status.cancelled')),

            rejected: @json(__('education_admin.student_lesson_create.booking_details.status.rejected')),

        };

        return values[status] ?? status;
    }


    /*
    |--------------------------------------------------------------------------
    | RESET BOOKING DETAILS
    |--------------------------------------------------------------------------
    */

    function resetBookingDetails() {

        bookingDetails.style.display = 'none';

        bookingDetailsTitle.textContent = '—';

        bookingTotal.textContent = '0';

        bookingCreated.textContent = '0';

        bookingRemaining.textContent = '0';

        bookingPayment.textContent = '—';

        bookingStatus.textContent = '—';

        submitButton.disabled = true;
    }


    /*
    |--------------------------------------------------------------------------
    | SHOW BOOKING DETAILS
    |--------------------------------------------------------------------------
    */

    function showBookingDetails(option) {

        if (!option || !option.value) {

            resetBookingDetails();

            return;
        }


        const isAvailable =
            option.dataset.available === '1';


        if (!isAvailable) {

            resetBookingDetails();

            return;
        }


        const title =
            option.dataset.title ||
            @json(__('education_admin.student_lesson_create.student_booking.booking.label'));


        const total =
            option.dataset.total || '0';


        const created =
            option.dataset.created || '0';


        const remaining =
            option.dataset.remaining || '0';


        const payment =
            option.dataset.payment || '';


        const status =
            option.dataset.status || '';


        bookingDetailsTitle.textContent =
            title;


        bookingTotal.textContent =
            total;


        bookingCreated.textContent =
            created;


        bookingRemaining.textContent =
            remaining;


        bookingPayment.textContent =
            formatPaymentStatus(payment);


        bookingStatus.textContent =
            formatBookingStatus(status);


        bookingDetails.style.display =
            'block';


        submitButton.disabled =
            false;


        /*
        |--------------------------------------------------------------------------
        | AUTO SESSION NUMBER
        |--------------------------------------------------------------------------
        */

        if (
            !sessionNumber.value
        ) {

            sessionNumber.value =
                parseInt(created, 10) + 1;
        }
    }


    /*
    |--------------------------------------------------------------------------
    | FILTER BOOKINGS
    |--------------------------------------------------------------------------
    */

    function filterBookings() {

        const studentId =
            studentSelect.value;


        bookingSelect.innerHTML = '';


        resetBookingDetails();


        /*
        |--------------------------------------------------------------------------
        | NO STUDENT
        |--------------------------------------------------------------------------
        */

        if (!studentId) {

            const option =
                document.createElement('option');

            option.value = '';

            option.textContent =
                @json(__('education_admin.student_lesson_create.student_booking.booking.placeholder_initial'));

            bookingSelect.appendChild(option);

            bookingSelect.disabled =
                true;

            bookingEmptyMessage.style.display =
                'block';

            bookingEmptyMessage.innerHTML = `

                <i class="fa-solid fa-circle-info"></i>

                ${@json(__('education_admin.student_lesson_create.student_booking.booking.empty_initial'))}

            `;

            return;
        }


        /*
        |--------------------------------------------------------------------------
        | PLACEHOLDER
        |--------------------------------------------------------------------------
        */

        const placeholder =
            document.createElement('option');

        placeholder.value = '';

        placeholder.textContent =
            @json(__('education_admin.student_lesson_create.student_booking.booking.placeholder'));

        bookingSelect.appendChild(
            placeholder
        );


        /*
        |--------------------------------------------------------------------------
        | STUDENT BOOKINGS
        |--------------------------------------------------------------------------
        */

        const studentBookings =
            originalOptions.filter(
                function (option) {

                    return String(
                        option.dataset.student
                    ) === String(studentId)
                    &&
                    option.dataset.available === '1';

                }
            );


        /*
        |--------------------------------------------------------------------------
        | NO VALID BOOKINGS
        |--------------------------------------------------------------------------
        */

        if (
            studentBookings.length === 0
        ) {

            bookingSelect.disabled =
                true;

            bookingEmptyMessage.style.display =
                'block';

            bookingEmptyMessage.innerHTML = `

                <i class="fa-solid fa-calendar-xmark"></i>

                ${@json(__('education_admin.student_lesson_create.student_booking.booking.empty_no_bookings'))}

            `;

            return;
        }


        /*
        |--------------------------------------------------------------------------
        | ADD VALID BOOKINGS
        |--------------------------------------------------------------------------
        */

        studentBookings.forEach(
            function (sourceOption) {

                const option =
                    document.createElement('option');


                option.value =
                    sourceOption.value;


                option.textContent =
                    sourceOption.textContent;


                option.dataset.student =
                    sourceOption.dataset.student;


                option.dataset.title =
                    sourceOption.dataset.title;


                option.dataset.total =
                    sourceOption.dataset.total;


                option.dataset.created =
                    sourceOption.dataset.created;


                option.dataset.remaining =
                    sourceOption.dataset.remaining;


                option.dataset.payment =
                    sourceOption.dataset.payment;


                option.dataset.status =
                    sourceOption.dataset.status;


                option.dataset.paid =
                    sourceOption.dataset.paid;


                option.dataset.confirmed =
                    sourceOption.dataset.confirmed;


                option.dataset.available =
                    sourceOption.dataset.available;


                bookingSelect.appendChild(
                    option
                );

            }
        );


        bookingSelect.disabled =
            false;


        bookingEmptyMessage.style.display =
            'none';


        /*
        |--------------------------------------------------------------------------
        | RESTORE OLD BOOKING
        |--------------------------------------------------------------------------
        */

        if (oldBooking) {

            const oldOption =
                Array.from(
                    bookingSelect.options
                ).find(
                    option =>
                        option.value == oldBooking
                );


            if (oldOption) {

                bookingSelect.value =
                    oldBooking;

                showBookingDetails(
                    oldOption
                );
            }
        }

    }


    /*
    |--------------------------------------------------------------------------
    | STUDENT CHANGE
    |--------------------------------------------------------------------------
    */

    studentSelect.addEventListener(
        'change',
        function () {

            sessionNumber.value = '';

            filterBookings();
        }
    );


    /*
    |--------------------------------------------------------------------------
    | BOOKING CHANGE
    |--------------------------------------------------------------------------
    */

    bookingSelect.addEventListener(
        'change',
        function () {

            const selectedOption =
                bookingSelect.options[
                    bookingSelect.selectedIndex
                ];


            if (
                !selectedOption
                ||
                !selectedOption.value
            ) {

                resetBookingDetails();

                return;
            }


            showBookingDetails(
                selectedOption
            );
        }
    );


    /*
    |--------------------------------------------------------------------------
    | FORM SUBMIT PROTECTION
    |--------------------------------------------------------------------------
    */

    document
        .getElementById('studentLessonForm')
        .addEventListener(
            'submit',
            function (event) {

                const selectedOption =
                    bookingSelect.options[
                        bookingSelect.selectedIndex
                    ];


                if (
                    !selectedOption
                    ||
                    !selectedOption.value
                    ||
                    selectedOption.dataset.available !== '1'
                ) {

                    event.preventDefault();

                    alert(
                        @json(__('education_admin.student_lesson_create.submit.invalid_booking'))
                    );

                    return false;
                }


                submitButton.disabled =
                    true;

                submitButton.innerHTML = `

                    <i class="fa-solid fa-spinner fa-spin"></i>

                    ${@json(__('education_admin.student_lesson_create.submit.creating'))}

                `;
            }
        );


    /*
    |--------------------------------------------------------------------------
    | INITIALIZE
    |--------------------------------------------------------------------------
    */

    if (oldStudent) {

        studentSelect.value =
            oldStudent;
    }


    filterBookings();

});

</script>


{{-- ================================================================
    STYLE
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
   GRID
============================================================ */

.create-grid {
    display: grid;
    grid-template-columns:
        minmax(0, 1.15fr)
        minmax(320px, .85fr);
    gap: 22px;
}


/* ============================================================
   CARD
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
    padding: 24px;
}


/* ============================================================
   FORM
============================================================ */

.form-group {
    margin-bottom: 21px;
}

.form-group:last-child {
    margin-bottom: 0;
}

.form-group label {
    display: flex;
    align-items: center;
    gap: 7px;
    margin-bottom: 8px;
    color: #4c514d;
    font-size: 13px;
    font-weight: 700;
}

.form-group label i {
    width: 17px;
    text-align: center;
    color: #a9822e;
}

.required {
    color: #a8564c;
    font-weight: 700;
}

.optional {
    display: inline-flex;
    align-items: center;
    padding: 3px 7px;
    border-radius: 6px;
    background: #f2eee5;
    color: #8b806d;
    font-size: 10px;
    font-weight: 600;
}

.form-control {
    width: 100%;
    min-height: 44px;
    padding: 10px 13px;
    border: 1px solid #ded5c4;
    border-radius: 11px;
    background: #fffefa;
    color: #3f443f;
    font-family: inherit;
    font-size: 13px;
    outline: none;
    transition: .2s ease;
    box-sizing: border-box;
}

.form-control:focus {
    border-color: #a9822e;
    box-shadow:
        0 0 0 3px rgba(169, 130, 46, .10);
}

.form-control::placeholder {
    color: #aaa194;
}

select.form-control {
    cursor: pointer;
}

select.form-control:disabled {
    cursor: not-allowed;
    background: #f2eee5;
    color: #9d9588;
}

.textarea {
    min-height: auto;
    resize: vertical;
    line-height: 1.7;
}

.is-invalid {
    border-color: #b85c51 !important;
}

.field-error {
    margin-top: 6px;
    color: #a8564c;
    font-size: 12px;
    line-height: 1.5;
}

.field-help {
    margin-top: 7px;
    color: #918878;
    font-size: 11px;
    line-height: 1.6;
}


/* ============================================================
   BOOKING EMPTY MESSAGE
============================================================ */

.booking-empty-message {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-top: 9px;
    padding: 10px 12px;
    border-radius: 9px;
    background: #f8f3e8;
    border: 1px solid #eee2cb;
    color: #8c806d;
    font-size: 11px;
}

.booking-empty-message i {
    color: #a9822e;
}


/* ============================================================
   BOOKING DETAILS
============================================================ */

.booking-details {
    margin-top: -3px;
    margin-bottom: 21px;
    padding: 15px;
    border: 1px solid #dfe7df;
    border-radius: 14px;
    background: #f5f8f4;
}

.booking-details-header {
    display: flex;
    align-items: center;
    gap: 11px;
    margin-bottom: 15px;
}

.booking-details-icon {
    width: 38px;
    height: 38px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    background: #e0ebe2;
    color: #315c4b;
}

.booking-details-header strong {
    display: block;
    margin-bottom: 2px;
    color: #315c4b;
    font-size: 13px;
}

.booking-details-header span {
    display: block;
    color: #8a8e87;
    font-size: 10px;
}

.booking-stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 8px;
    margin-bottom: 12px;
}

.booking-stat {
    padding: 10px;
    border-radius: 10px;
    background: #fffdf8;
    border: 1px solid #e5e1d7;
    text-align: center;
}

.booking-stat span {
    display: block;
    margin-bottom: 4px;
    color: #8c867b;
    font-size: 10px;
}

.booking-stat strong {
    display: block;
    color: #4d534d;
    font-size: 17px;
}

.booking-stat.remaining strong {
    color: #315c4b;
}

.booking-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 12px 20px;
    padding-top: 11px;
    border-top: 1px solid #e3e8e1;
}

.booking-meta > div {
    display: flex;
    align-items: center;
    gap: 5px;
    color: #878b84;
    font-size: 10px;
}

.booking-meta i {
    color: #a9822e;
}

.booking-meta strong {
    color: #4f554f;
}


/* ============================================================
   SWITCH
============================================================ */

.switch-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 18px;
    padding: 16px;
    margin-top: 5px;
    border: 1px solid #eee4d2;
    border-radius: 13px;
    background: #faf6ed;
}

.switch-content {
    display: flex;
    align-items: center;
    gap: 11px;
}

.switch-icon {
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    background: #e8f0e8;
    color: #315c4b;
}

.switch-content strong {
    display: block;
    margin-bottom: 3px;
    color: #4c514d;
    font-size: 13px;
}

.switch-content p {
    margin: 0;
    color: #918878;
    font-size: 11px;
    line-height: 1.5;
}

.switch {
    position: relative;
    width: 48px;
    height: 26px;
    flex: 0 0 48px;
}

.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    inset: 0;
    cursor: pointer;
    border-radius: 30px;
    background: #d5cec1;
    transition: .2s;
}

.slider::before {
    content: "";
    position: absolute;
    width: 20px;
    height: 20px;
    right: 3px;
    top: 3px;
    border-radius: 50%;
    background: #fff;
    box-shadow: 0 2px 5px rgba(0,0,0,.15);
    transition: .2s;
}

.switch input:checked + .slider {
    background: #315c4b;
}

.switch input:checked + .slider::before {
    transform: translateX(-22px);
}


/* ============================================================
   ALERT
============================================================ */

.alert {
    display: flex;
    align-items: flex-start;
    gap: 13px;
    margin-bottom: 22px;
    padding: 15px 17px;
    border-radius: 13px;
    font-size: 13px;
}

.alert-danger {
    background: #f8e4e1;
    border: 1px solid #e7c3be;
    color: #8f453d;
}

.alert-icon {
    font-size: 17px;
    padding-top: 1px;
}

.alert strong {
    display: block;
    margin-bottom: 5px;
}

.alert ul {
    margin: 0;
    padding-right: 18px;
}

.alert li {
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
    min-height: 42px;
    padding: 9px 17px;
    border: 1px solid transparent;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
    cursor: pointer;
    transition: .2s ease;
    white-space: nowrap;
}

.btn-primary {
    background: #315c4b;
    color: #fff;
}

.btn-primary:hover {
    background: #274d3e;
    color: #fff;
}

.btn-primary:disabled {
    background: #bdb8ad;
    color: #f8f6f1;
    cursor: not-allowed;
    opacity: .75;
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
   ACTIONS
============================================================ */

.form-actions-card {
    margin-top: 22px;
}

.form-actions {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    gap: 10px;
    padding: 18px 21px;
}


/* ============================================================
   RESPONSIVE
============================================================ */

@media (max-width: 900px) {

    .create-grid {
        grid-template-columns: 1fr;
    }

}


@media (max-width: 700px) {

    .page-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .page-header-actions {
        width: 100%;
    }

    .page-header-actions .btn {
        width: 100%;
    }

    .card-body {
        padding: 18px;
    }

    .booking-stats {
        grid-template-columns: 1fr;
    }

    .booking-meta {
        flex-direction: column;
        gap: 8px;
    }

    .switch-row {
        align-items: flex-start;
    }

    .form-actions {
        flex-direction: column;
        align-items: stretch;
    }

    .form-actions .btn {
        width: 100%;
    }

}

</style>

@endsection
