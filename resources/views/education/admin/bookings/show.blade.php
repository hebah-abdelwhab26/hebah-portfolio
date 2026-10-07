
@extends('education.admin.layouts.app')

@section('title', __('education_admin.bookings_show.page_title'))

@section('page_title', __('education_admin.bookings_show.page_title'))


@section('content')

<div class="education-admin-booking-show-page">


    {{-- ==================================================
        PAGE HEADER
    ================================================== --}}

    <div class="education-admin-page-header">

        <div>

            <span class="education-admin-page-header-label">
                {{ __('education_admin.bookings_show.eyebrow') }}
            </span>

            <h2>
                {{ __('education_admin.bookings_show.title') }}
            </h2>

            <p>
                {{ __('education_admin.bookings_show.description') }}
            </p>

        </div>


        <a
            href="{{ route('education.admin.bookings.index') }}"
            class="education-admin-booking-back"
        >

            <i class="fa-solid fa-arrow-right"></i>

            <span>
                {{ __('education_admin.bookings_show.back_to_bookings') }}
            </span>

        </a>

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

                @foreach($errors->all() as $error)

                    <div>
                        {{ $error }}
                    </div>

                @endforeach

            </div>

        </div>

    @endif



    {{-- ==================================================
        LOCAL DATA
    ================================================== --}}

    @php

        $statusLabels = [

            'pending'   => __('education_admin.bookings_show.status_pending'),

            'confirmed' => __('education_admin.bookings_show.status_confirmed'),

            'completed' => __('education_admin.bookings_show.status_completed'),

            'cancelled' => __('education_admin.bookings_show.status_cancelled'),

            'no_show'   => __('education_admin.bookings_show.status_no_show'),

        ];


        $statusIcons = [

            'pending'   => 'fa-clock',

            'confirmed' => 'fa-circle-check',

            'completed' => 'fa-check-double',

            'cancelled' => 'fa-circle-xmark',

            'no_show'   => 'fa-user-xmark',

        ];


        $paymentLabels = [

            'unpaid'   => __('education_admin.bookings_show.payment_unpaid'),

            'pending'  => __('education_admin.bookings_show.payment_pending'),

            'paid'     => __('education_admin.bookings_show.payment_paid'),

            'failed'   => __('education_admin.bookings_show.payment_failed'),

            'refunded' => __('education_admin.bookings_show.payment_refunded'),

        ];


        $paymentIcons = [

            'unpaid'   => 'fa-wallet',

            'pending'  => 'fa-hourglass-half',

            'paid'     => 'fa-circle-check',

            'failed'   => 'fa-circle-xmark',

            'refunded' => 'fa-rotate-left',

        ];


        $bookingDate = $booking->booking_date
            ? \Carbon\Carbon::parse($booking->booking_date)
            : null;


        $startTime = $booking->start_time
            ? \Carbon\Carbon::parse($booking->start_time)
            : null;


        $endTime = $booking->end_time
            ? \Carbon\Carbon::parse($booking->end_time)
            : null;


        $paidAt = $booking->paid_at
            ? \Carbon\Carbon::parse($booking->paid_at)
            : null;


        $payment = $booking->payment;

    @endphp



    {{-- ==================================================
        MAIN GRID
    ================================================== --}}

    <div class="education-admin-booking-show-grid">


        {{-- ==================================================
            MAIN
        ================================================== --}}

        <div class="education-admin-booking-show-main">


            {{-- ==================================================
                BOOKING OVERVIEW
            ================================================== --}}

            <section class="education-admin-booking-show-card">

                <div class="education-admin-booking-show-card-header">

                    <div>

                        <span>
                            {{ __('education_admin.bookings_show.booking') }}
                        </span>

                        <h3>
                            {{ __('education_admin.bookings_show.booking_information') }}
                        </h3>

                    </div>


                    <span class="education-admin-booking-id">
                        #{{ $booking->id }}
                    </span>

                </div>


                <div class="education-admin-booking-status-row">


                    {{-- BOOKING STATUS --}}

                    <div class="education-admin-booking-status-box">

                        <span>
                            {{ __('education_admin.bookings_show.booking_status') }}
                        </span>


                        <strong
                            class="education-admin-status {{ $booking->status }}"
                        >

                            <i class="fa-solid {{ $statusIcons[$booking->status] ?? 'fa-circle' }}"></i>

                            {{ $statusLabels[$booking->status] ?? $booking->status }}

                        </strong>

                    </div>



                    {{-- PAYMENT STATUS --}}

                    <div class="education-admin-booking-status-box">

                        <span>
                            {{ __('education_admin.bookings_show.payment_status') }}
                        </span>


                        <strong
                            class="education-admin-payment {{ $booking->payment_status }}"
                        >

                            <i class="fa-solid {{ $paymentIcons[$booking->payment_status] ?? 'fa-wallet' }}"></i>

                            {{ $paymentLabels[$booking->payment_status] ?? $booking->payment_status }}

                        </strong>

                    </div>



                    {{-- PRICE --}}

                    <div class="education-admin-booking-status-box">

                        <span>
                            {{ __('education_admin.bookings_show.booking_value') }}
                        </span>

                        <strong>

                            {{ number_format(
                                (float) $booking->price,
                                2
                            ) }}

                            {{ $booking->currency ?? 'SAR' }}

                        </strong>

                    </div>

                </div>

            </section>



            {{-- ==================================================
                STUDENT
            ================================================== --}}

            <section class="education-admin-booking-show-card">

                <div class="education-admin-booking-show-card-header">

                    <div>

                        <span>
                            {{ __('education_admin.bookings_show.student') }}
                        </span>

                        <h3>
                            {{ __('education_admin.bookings_show.student_information') }}
                        </h3>

                    </div>


                    <div class="education-admin-booking-section-icon">

                        <i class="fa-solid fa-user-graduate"></i>

                    </div>

                </div>


                <div class="education-admin-booking-student-large">


                    <div class="education-admin-booking-student-large-avatar">

                        {{ mb_strtoupper(
                            mb_substr(
                                $booking->student->name
                                    ?? __('education_admin.bookings_show.student_initial'),
                                0,
                                1
                            )
                        ) }}

                    </div>


                    <div class="education-admin-booking-student-large-info">

                        <strong>
                            {{ $booking->student->name
                                ?? __('education_admin.bookings_show.unknown_student') }}
                        </strong>

                        <span>
                            {{ $booking->student->email ?? '—' }}
                        </span>

                        @if($booking->student?->phone)

                            <span>
                                {{ $booking->student->phone }}
                            </span>

                        @endif

                    </div>


                    @if($booking->student && $booking->student->email)

                        <div class="education-admin-booking-student-large-actions">

                            <a
                                href="mailto:{{ $booking->student->email }}"
                                title="{{ __('education_admin.bookings_show.send_email') }}"
                            >

                                <i class="fa-regular fa-envelope"></i>

                            </a>

                        </div>

                    @endif

                </div>

            </section>



            {{-- ==================================================
                BOOKING TYPE / LESSON
            ================================================== --}}

            <section class="education-admin-booking-show-card">

                <div class="education-admin-booking-show-card-header">

                    <div>

                        <span>
                            {{ __('education_admin.bookings_show.booking_type') }}
                        </span>

                        <h3>
                            {{ __('education_admin.bookings_show.lesson_package_details') }}
                        </h3>

                    </div>


                    <div class="education-admin-booking-section-icon">

                        <i class="fa-solid fa-book-open"></i>

                    </div>

                </div>


                <div class="education-admin-booking-lesson-large">


                    <div class="education-admin-booking-lesson-large-icon">

                        <i class="fa-solid fa-book-quran"></i>

                    </div>


                    <div class="education-admin-booking-lesson-large-content">

                        <strong>
                            {{ $booking->title
                                ?? __('education_admin.bookings_show.educational_booking') }}
                        </strong>


                        @if($booking->bookingType)

                            <span>
                                {{ $booking->bookingType->name }}
                            </span>

                        @endif


                        @if($booking->description)

                            <p>
                                {{ $booking->description }}
                            </p>

                        @endif

                    </div>

                </div>


                {{-- SESSIONS --}}

                <div
                    class="education-admin-booking-payment-list"
                    style="margin-top: 20px;"
                >

                    <div>

                        <span>
                            {{ __('education_admin.bookings_show.total_sessions') }}
                        </span>

                        <strong>
                            {{ $booking->total_sessions ?? 1 }}
                        </strong>

                    </div>


                    <div>

                        <span>
                            {{ __('education_admin.bookings_show.completed_sessions') }}
                        </span>

                        <strong>
                            {{ $booking->completed_sessions ?? 0 }}
                        </strong>

                    </div>


                    <div>

                        <span>
                            {{ __('education_admin.bookings_show.remaining_sessions') }}
                        </span>

                        <strong>

                            {{ max(
                                0,
                                (int) ($booking->total_sessions ?? 1)
                                -
                                (int) ($booking->completed_sessions ?? 0)
                            ) }}

                        </strong>

                    </div>

                </div>

            </section>



            {{-- ==================================================
                DATE & TIME
            ================================================== --}}

            <section class="education-admin-booking-show-card">

                <div class="education-admin-booking-show-card-header">

                    <div>

                        <span>
                            {{ __('education_admin.bookings_show.appointment') }}
                        </span>

                        <h3>
                            {{ __('education_admin.bookings_show.lesson_date_time') }}
                        </h3>

                    </div>


                    <div class="education-admin-booking-section-icon">

                        <i class="fa-regular fa-calendar"></i>

                    </div>

                </div>


                <div class="education-admin-booking-datetime-grid">


                    {{-- DATE --}}

                    <div class="education-admin-booking-info-item">

                        <div class="education-admin-booking-info-icon">

                            <i class="fa-regular fa-calendar-days"></i>

                        </div>


                        <div>

                            <span>
                                {{ __('education_admin.bookings_show.date') }}
                            </span>

                            <strong>

                                @if($bookingDate)

                                    {{ $bookingDate
                                        ->locale(session('education_locale', 'ar'))
                                        ->translatedFormat('d M Y')
                                    }}

                                    <small style="display:block; opacity:.7;">
                                        {{ $bookingDate->format('Y-m-d') }}
                                    </small>

                                @else

                                    —

                                @endif

                            </strong>

                        </div>

                    </div>



                    {{-- TIME --}}

                    <div class="education-admin-booking-info-item">

                        <div class="education-admin-booking-info-icon">

                            <i class="fa-regular fa-clock"></i>

                        </div>


                        <div>

                            <span>
                                {{ __('education_admin.bookings_show.time') }}
                            </span>

                            <strong dir="ltr">

                                @if($startTime)

                                    {{ $startTime->format('H:i') }}

                                @else

                                    —

                                @endif

                                -

                                @if($endTime)

                                    {{ $endTime->format('H:i') }}

                                @else

                                    —

                                @endif

                            </strong>

                        </div>

                    </div>

                </div>

            </section>



            {{-- ==================================================
                STUDENT NOTE
            ================================================== --}}

            @if($booking->student_note)

                <section class="education-admin-booking-show-card">

                    <div class="education-admin-booking-show-card-header">

                        <div>

                            <span>
                                {{ __('education_admin.bookings_show.student_note') }}
                            </span>

                            <h3>
                                {{ __('education_admin.bookings_show.booking_notes') }}
                            </h3>

                        </div>

                    </div>


                    <div class="education-admin-booking-note">

                        <i class="fa-regular fa-note-sticky"></i>

                        <p>
                            {{ $booking->student_note }}
                        </p>

                    </div>

                </section>

            @endif



            {{-- ==================================================
                ADMIN NOTE
            ================================================== --}}

            <section class="education-admin-booking-show-card">

                <div class="education-admin-booking-show-card-header">

                    <div>

                        <span>
                            {{ __('education_admin.bookings_show.administration') }}
                        </span>

                        <h3>
                            {{ __('education_admin.bookings_show.admin_note') }}
                        </h3>

                    </div>


                    <div class="education-admin-booking-section-icon">

                        <i class="fa-solid fa-pen-to-square"></i>

                    </div>

                </div>


                <form
                    method="POST"
                    action="{{ route(
                        'education.admin.bookings.note',
                        $booking
                    ) }}"
                >

                    @csrf

                    @method('PATCH')


                    <textarea
                        name="admin_note"
                        rows="5"
                        class="education-admin-booking-admin-note"
                        placeholder="{{ __('education_admin.bookings_show.admin_note_placeholder') }}"
                    >{{ old('admin_note', $booking->admin_note) }}</textarea>


                    <button
                        type="submit"
                        class="education-admin-booking-review-button confirm"
                        style="margin-top: 12px;"
                    >

                        <i class="fa-solid fa-floppy-disk"></i>

                        {{ __('education_admin.bookings_show.save_note') }}

                    </button>

                </form>

            </section>

        </div>



        {{-- ==================================================
            SIDEBAR
        ================================================== --}}

        <div class="education-admin-booking-show-sidebar">


            {{-- ==================================================
                BOOKING STATUS CONTROL
            ================================================== --}}

            <section class="education-admin-booking-show-card">

                <div class="education-admin-booking-show-card-header">

                    <div>

                        <span>
                            {{ __('education_admin.bookings_show.booking_management') }}
                        </span>

                        <h3>
                            {{ __('education_admin.bookings_show.lesson_status') }}
                        </h3>

                    </div>


                    <div class="education-admin-booking-section-icon">

                        <i class="fa-solid fa-sliders"></i>

                    </div>

                </div>


                <div class="education-admin-booking-review-actions">


                    {{-- CONFIRM --}}

                    @if($booking->status === 'pending')

                        <form
                            method="POST"
                            action="{{ route(
                                'education.admin.bookings.confirm',
                                $booking
                            ) }}"
                        >

                            @csrf

                            @method('PATCH')

                            <button
                                type="submit"
                                class="education-admin-booking-review-button confirm"
                                onclick="return confirm('{{ __('education_admin.bookings_show.confirm_booking_question') }}')"
                            >

                                <i class="fa-solid fa-circle-check"></i>

                                {{ __('education_admin.bookings_show.confirm_booking') }}

                            </button>

                        </form>

                    @endif



                    {{-- COMPLETE --}}

                    @if(
                        $booking->status === 'confirmed' ||
                        $booking->status === 'pending'
                    )

                        <form
                            method="POST"
                            action="{{ route(
                                'education.admin.bookings.complete',
                                $booking
                            ) }}"
                        >

                            @csrf

                            @method('PATCH')

                            <button
                                type="submit"
                                class="education-admin-booking-review-button complete"
                                onclick="return confirm('{{ __('education_admin.bookings_show.complete_booking_question') }}')"
                            >

                                <i class="fa-solid fa-check-double"></i>

                                {{ __('education_admin.bookings_show.mark_completed') }}

                            </button>

                        </form>

                    @endif



                    {{-- NO SHOW --}}

                    @if(
                        $booking->status !== 'cancelled' &&
                        $booking->status !== 'completed' &&
                        $booking->status !== 'no_show'
                    )

                        <form
                            method="POST"
                            action="{{ route(
                                'education.admin.bookings.no_show',
                                $booking
                            ) }}"
                        >

                            @csrf

                            @method('PATCH')

                            <button
                                type="submit"
                                class="education-admin-booking-review-button no-show"
                                onclick="return confirm('{{ __('education_admin.bookings_show.no_show_question') }}')"
                            >

                                <i class="fa-solid fa-user-xmark"></i>

                                {{ __('education_admin.bookings_show.mark_no_show') }}

                            </button>

                        </form>

                    @endif



                    {{-- CANCEL --}}

                    @if(
                        $booking->status !== 'cancelled' &&
                        $booking->status !== 'completed'
                    )

                        <form
                            method="POST"
                            action="{{ route(
                                'education.admin.bookings.cancel',
                                $booking
                            ) }}"
                        >

                            @csrf

                            @method('PATCH')

                            <button
                                type="submit"
                                class="education-admin-booking-review-button cancel"
                                onclick="return confirm('{{ __('education_admin.bookings_show.cancel_booking_question') }}')"
                            >

                                <i class="fa-solid fa-circle-xmark"></i>

                                {{ __('education_admin.bookings_show.cancel_booking') }}

                            </button>

                        </form>

                    @endif

                </div>

            </section>



            {{-- ==================================================
                PAYMENT
            ================================================== --}}

            <section class="education-admin-booking-show-card">

                <div class="education-admin-booking-show-card-header">

                    <div>

                        <span>
                            {{ __('education_admin.bookings_show.payment') }}
                        </span>

                        <h3>
                            {{ __('education_admin.bookings_show.payment_information') }}
                        </h3>

                    </div>


                    <div class="education-admin-booking-section-icon">

                        <i class="fa-solid fa-money-bill-transfer"></i>

                    </div>

                </div>



                {{-- PRICE --}}

                <div class="education-admin-booking-price-large">

                    <strong>

                        {{ number_format(
                            (float) $booking->price,
                            2
                        ) }}

                    </strong>

                    <span>
                        {{ $booking->currency ?? 'SAR' }}
                    </span>

                </div>



                {{-- CURRENT PAYMENT --}}

                <div class="education-admin-booking-payment-list">

                    <div>

                        <span>
                            {{ __('education_admin.bookings_show.status') }}
                        </span>

                        <strong>

                            {{ $paymentLabels[$booking->payment_status]
                                ?? $booking->payment_status }}

                        </strong>

                    </div>


                    <div>

                        <span>
                            {{ __('education_admin.bookings_show.method') }}
                        </span>

                        <strong>

                            {{ $booking->payment_method
                                ?? __('education_admin.bookings_show.not_registered') }}

                        </strong>

                    </div>


                    <div>

                        <span>
                            {{ __('education_admin.bookings_show.reference_number') }}
                        </span>

                        <strong dir="ltr">

                            {{ $booking->payment_reference ?? '—' }}

                        </strong>

                    </div>


                    <div>

                        <span>
                            {{ __('education_admin.bookings_show.payment_date') }}
                        </span>

                        <strong>

                            {{ $paidAt
                                ? $paidAt->format('Y-m-d H:i')
                                : '—'
                            }}

                        </strong>

                    </div>

                </div>



                {{-- ==================================================
                    STUDENT RECEIPT
                ================================================== --}}

                @if($payment && $payment->receipt_file)

                    <div
                        class="education-admin-booking-receipt"
                        style="margin-top:20px;"
                    >

                        <div class="education-admin-booking-show-card-header">

                            <div>

                                <span>
                                    {{ __('education_admin.bookings_show.payment_proof') }}
                                </span>

                                <h3>
                                    {{ __('education_admin.bookings_show.student_receipt') }}
                                </h3>

                            </div>

                            <div class="education-admin-booking-section-icon">

                                <i class="fa-solid fa-file-invoice"></i>

                            </div>

                        </div>


                        <div
                            class="education-admin-booking-payment-list"
                            style="margin-top:12px;"
                        >

                            <div>

                                <span>
                                    {{ __('education_admin.bookings_show.file') }}
                                </span>

                                <strong>
                                    {{ $payment->receipt_original_name
                                        ?? __('education_admin.bookings_show.payment_proof') }}
                                </strong>

                            </div>


                            <div>

                                <span>
                                    {{ __('education_admin.bookings_show.status') }}
                                </span>

                                <strong>

                                    {{ match($payment->status) {

                                        'submitted'
                                            => __('education_admin.bookings_show.receipt_submitted'),

                                        'under_review'
                                            => __('education_admin.bookings_show.payment_under_review'),

                                        'approved'
                                            => __('education_admin.bookings_show.receipt_approved'),

                                        'rejected'
                                            => __('education_admin.bookings_show.receipt_rejected'),

                                        default
                                            => $payment->status ?? '—'

                                    } }}

                                </strong>

                            </div>

                        </div>


                        <a
                            href="{{ asset($payment->receipt_file) }}"
                            target="_blank"
                            rel="noopener"
                            class="education-admin-booking-review-button"
                            style="margin-top:14px; text-decoration:none;"
                        >

                            <i class="fa-solid fa-arrow-up-right-from-square"></i>

                            {{ __('education_admin.bookings_show.view_payment_proof') }}

                        </a>


                        {{-- REVIEW RECEIPT --}}

                        @if(
                            in_array(
                                $payment->status,
                                ['submitted', 'under_review'],
                                true
                            )
                        )

                            <div
                                class="education-admin-booking-review-actions"
                                style="margin-top:12px;"
                            >

                                {{-- START REVIEW --}}

                                @if($payment->status === 'submitted')

                                    <form
                                        method="POST"
                                        action="{{ route(
                                            'education.admin.payments.review',
                                            $payment
                                        ) }}"
                                    >

                                        @csrf

                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            class="education-admin-booking-review-button pending"
                                        >

                                            <i class="fa-solid fa-magnifying-glass"></i>

                                            {{ __('education_admin.bookings_show.start_review') }}

                                        </button>

                                    </form>

                                @endif


                                {{-- APPROVE --}}

                                <form
                                    method="POST"
                                    action="{{ route(
                                        'education.admin.payments.approve',
                                        $payment
                                    ) }}"
                                >

                                    @csrf

                                    @method('PATCH')

                                    <button
                                        type="submit"
                                        class="education-admin-booking-review-button confirm"
                                        onclick="return confirm('{{ __('education_admin.bookings_show.approve_payment_question') }}')"
                                    >

                                        <i class="fa-solid fa-circle-check"></i>

                                        {{ __('education_admin.bookings_show.approve_payment') }}

                                    </button>

                                </form>


                                {{-- REJECT --}}

                                <form
                                    action="{{ route(
                                        'education.admin.payments.reject',
                                        $payment
                                    ) }}"
                                    onsubmit="return rejectPayment(this);"
                                >

                                    @csrf

                                    @method('PATCH')

                                    <input
                                        type="hidden"
                                        name="rejection_reason"
                                        value=""
                                    >

                                    <button
                                        type="submit"
                                        class="education-admin-booking-review-button cancel"
                                    >

                                        <i class="fa-solid fa-circle-xmark"></i>

                                        {{ __('education_admin.bookings_show.reject_payment_proof') }}

                                    </button>

                                </form>

                            </div>

                        @endif

                    </div>

                @endif



                {{-- ==================================================
                    MANUAL PAYMENT
                ================================================== --}}

                @if($booking->payment_status !== 'paid')

                    <form
                        method="POST"
                        action="{{ route(
                            'education.admin.bookings.payment.paid',
                            $booking
                        ) }}"
                        style="margin-top:22px;"
                    >

                        @csrf

                        @method('PATCH')


                        <div class="education-admin-booking-form-group">

                            <label>
                                {{ __('education_admin.bookings_show.payment_method') }}
                            </label>

                            <input
                                type="text"
                                name="payment_method"
                                value="{{ old(
                                    'payment_method',
                                    $booking->payment_method
                                        ?? __('education_admin.bookings_show.bank_transfer')
                                ) }}"
                                placeholder="{{ __('education_admin.bookings_show.payment_method_placeholder') }}"
                                required
                            >

                        </div>


                        <div
                            class="education-admin-booking-form-group"
                            style="margin-top:12px;"
                        >

                            <label>
                                {{ __('education_admin.bookings_show.transaction_reference') }}
                            </label>

                            <input
                                type="text"
                                name="payment_reference"
                                value="{{ old(
                                    'payment_reference',
                                    $booking->payment_reference
                                ) }}"
                                placeholder="{{ __('education_admin.bookings_show.reference_placeholder') }}"
                            >

                        </div>


                        <div
                            class="education-admin-booking-form-group"
                            style="margin-top:12px;"
                        >

                            <label>
                                {{ __('education_admin.bookings_show.payment_note') }}
                            </label>

                            <textarea
                                name="admin_note"
                                rows="3"
                                placeholder="{{ __('education_admin.bookings_show.payment_note_placeholder') }}"
                            >{{ old(
                                'admin_note',
                                $payment->admin_note ?? ''
                            ) }}</textarea>

                        </div>


                        <button
                            type="submit"
                            class="education-admin-booking-review-button confirm"
                            style="margin-top:14px;"
                            onclick="return confirm('{{ __('education_admin.bookings_show.confirm_payment_received_question') }}')"
                        >

                            <i class="fa-solid fa-circle-check"></i>

                            {{ __('education_admin.bookings_show.confirm_payment_received') }}

                        </button>

                    </form>

                @endif



                {{-- PAYMENT ACTIONS --}}

                <div
                    class="education-admin-booking-review-actions"
                    style="margin-top:12px;"
                >


                    {{-- PENDING --}}

                    @if($booking->payment_status !== 'pending')

                        <form
                            method="POST"
                            action="{{ route(
                                'education.admin.bookings.payment.pending',
                                $booking
                            ) }}"
                        >

                            @csrf

                            @method('PATCH')

                            <button
                                type="submit"
                                class="education-admin-booking-review-button pending"
                            >

                                <i class="fa-solid fa-hourglass-half"></i>

                                {{ __('education_admin.bookings_show.set_payment_pending') }}

                            </button>

                        </form>

                    @endif



                    {{-- UNPAID --}}

                    @if($booking->payment_status !== 'unpaid')

                        <form
                            method="POST"
                            action="{{ route(
                                'education.admin.bookings.payment.unpaid',
                                $booking
                            ) }}"
                        >

                            @csrf

                            @method('PATCH')

                            <button
                                type="submit"
                                class="education-admin-booking-review-button unpaid"
                            >

                                <i class="fa-solid fa-wallet"></i>

                                {{ __('education_admin.bookings_show.set_payment_unpaid') }}

                            </button>

                        </form>

                    @endif



                    {{-- FAILED --}}

                    @if(
                        $booking->payment_status !== 'failed' &&
                        $booking->payment_status !== 'refunded'
                    )

                        <form
                            method="POST"
                            action="{{ route(
                                'education.admin.bookings.payment.failed',
                                $booking
                            ) }}"
                            onsubmit="return confirm('{{ __('education_admin.bookings_show.mark_payment_failed_question') }}')"
                        >

                            @csrf

                            @method('PATCH')

                            <input
                                type="hidden"
                                name="payment_reference"
                                value="{{ $booking->payment_reference }}"
                            >

                            <button
                                type="submit"
                                class="education-admin-booking-review-button cancel"
                            >

                                <i class="fa-solid fa-triangle-exclamation"></i>

                                {{ __('education_admin.bookings_show.mark_payment_failed') }}

                            </button>

                        </form>

                    @endif



                    {{-- REFUND --}}

                    @if($booking->payment_status === 'paid')

                        <form
                            method="POST"
                            action="{{ route(
                                'education.admin.bookings.payment.refund',
                                $booking
                            ) }}"
                            onsubmit="return confirm('{{ __('education_admin.bookings_show.refund_payment_question') }}')"
                        >

                            @csrf

                            @method('PATCH')

                            <button
                                type="submit"
                                class="education-admin-booking-review-button refund"
                            >

                                <i class="fa-solid fa-rotate-left"></i>

                                {{ __('education_admin.bookings_show.refund_payment') }}

                            </button>

                        </form>

                    @endif

                </div>

            </section>



            {{-- ==================================================
                PAYMENT INFORMATION
            ================================================== --}}

            <section class="education-admin-booking-show-card">

                <div class="education-admin-booking-show-card-header">

                    <div>

                        <span>
                            {{ __('education_admin.bookings_show.financial_information') }}
                        </span>

                        <h3>
                            {{ __('education_admin.bookings_show.payment_summary') }}
                        </h3>

                    </div>


                    <div class="education-admin-booking-section-icon">

                        <i class="fa-solid fa-receipt"></i>

                    </div>

                </div>


                <div class="education-admin-booking-payment-list">

                    <div>

                        <span>
                            {{ __('education_admin.bookings_show.booking_price') }}
                        </span>

                        <strong dir="ltr">

                            {{ number_format(
                                (float) $booking->price,
                                2
                            ) }}

                            {{ $booking->currency ?? 'SAR' }}

                        </strong>

                    </div>


                    <div>

                        <span>
                            {{ __('education_admin.bookings_show.payment_method') }}
                        </span>

                        <strong>
                            {{ $booking->payment_method ?? '—' }}
                        </strong>

                    </div>


                    <div>

                        <span>
                            {{ __('education_admin.bookings_show.reference') }}
                        </span>

                        <strong dir="ltr">
                            {{ $booking->payment_reference ?? '—' }}
                        </strong>

                    </div>


                    <div>

                        <span>
                            {{ __('education_admin.bookings_show.received_at') }}
                        </span>

                        <strong>

                            {{ $paidAt
                                ? $paidAt->format('Y-m-d H:i')
                                : '—'
                            }}

                        </strong>

                    </div>

                </div>

            </section>



            {{-- ==================================================
                BOOKING META
            ================================================== --}}

            <section class="education-admin-booking-show-card">

                <div class="education-admin-booking-show-card-header">

                    <div>

                        <span>
                            {{ __('education_admin.bookings_show.additional_information') }}
                        </span>

                        <h3>
                            {{ __('education_admin.bookings_show.booking_data') }}
                        </h3>

                    </div>


                    <div class="education-admin-booking-section-icon">

                        <i class="fa-solid fa-circle-info"></i>

                    </div>

                </div>


                <div class="education-admin-booking-payment-list">

                    <div>

                        <span>
                            {{ __('education_admin.bookings_show.booking_number') }}
                        </span>

                        <strong>
                            #{{ $booking->id }}
                        </strong>

                    </div>


                    <div>

                        <span>
                            {{ __('education_admin.bookings_show.created_at') }}
                        </span>

                        <strong>

                            {{ $booking->created_at
                                ? $booking->created_at->format('Y-m-d H:i')
                                : '—'
                            }}

                        </strong>

                    </div>


                    <div>

                        <span>
                            {{ __('education_admin.bookings_show.updated_at') }}
                        </span>

                        <strong>

                            {{ $booking->updated_at
                                ? $booking->updated_at->format('Y-m-d H:i')
                                : '—'
                            }}

                        </strong>

                    </div>


                    <div>

                        <span>
                            {{ __('education_admin.bookings_show.reminder') }}
                        </span>

                        <strong>

                            {{ $booking->reminder_sent
                                ? __('education_admin.bookings_show.reminder_sent')
                                : __('education_admin.bookings_show.reminder_not_sent')
                            }}

                        </strong>

                    </div>

                </div>

            </section>



            {{-- ==================================================
                BACK
            ================================================== --}}

            <a
                href="{{ route('education.admin.bookings.index') }}"
                class="education-admin-booking-sidebar-back"
            >

                <i class="fa-solid fa-arrow-right"></i>

                {{ __('education_admin.bookings_show.back_to_all_bookings') }}

            </a>

        </div>

    </div>

</div>


{{-- ==================================================
    REJECTION SCRIPT
================================================== --}}

<script>

function rejectPayment(form)
{
    const reason = prompt(
        @json(__('education_admin.bookings_show.rejection_reason_prompt'))
    );

    if (reason === null) {
        return false;
    }

    const trimmedReason = reason.trim();

    if (!trimmedReason) {

        alert(
            @json(__('education_admin.bookings_show.rejection_reason_required'))
        );

        return false;
    }

    form.querySelector(
        'input[name="rejection_reason"]'
    ).value = trimmedReason;

    return true;
}

</script>


@endsection

