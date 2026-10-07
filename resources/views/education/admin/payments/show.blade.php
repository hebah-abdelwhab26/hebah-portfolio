@extends('education.layouts.app')

@section('title', __('education_admin.payment_show.page_title'))

@section('content')

<div
    class="education-admin-payment-show"
    dir="{{ session('education_locale', 'ar') === 'en' ? 'ltr' : 'rtl' }}"
>

    <div class="education-admin-payment-container">

        {{-- =========================================================
            TOP BAR
        ========================================================== --}}

        <div class="education-admin-payment-topbar">

            <a
                href="{{ route('education.admin.payments.index') }}"
                class="education-admin-payment-back"
            >
                <i class="fa-solid fa-arrow-right"></i>

                <span>
                    {{ __('education_admin.payment_show.actions.back') }}
                </span>
            </a>


            <div class="education-admin-payment-reference">

                <span>
                    {{ __('education_admin.payment_show.reference.label') }}
                </span>

                <strong>
                    #{{ $payment->id }}
                </strong>

            </div>

        </div>


        {{-- =========================================================
            PAGE HEADER
        ========================================================== --}}

        <header class="education-admin-payment-header">

            <div>

                <span class="education-admin-payment-eyebrow">
                    {{ __('education_admin.payment_show.header_label') }}
                </span>

                <h1>
                    {{ __('education_admin.payment_show.title') }}
                </h1>

                <p>
                    {{ __('education_admin.payment_show.description') }}
                </p>

            </div>


            {{-- MAIN STATUS --}}

            <div class="education-admin-payment-main-status">

                @if($payment->status === 'approved')

                    <span class="education-admin-payment-status approved">

                        <i class="fa-solid fa-circle-check"></i>

                        {{ __('education_admin.payment_show.status.approved') }}

                    </span>

                @elseif($payment->status === 'submitted')

                    <span class="education-admin-payment-status submitted">

                        <i class="fa-solid fa-file-circle-check"></i>

                        {{ __('education_admin.payment_show.status.submitted') }}

                    </span>

                @elseif($payment->status === 'under_review')

                    <span class="education-admin-payment-status review">

                        <i class="fa-solid fa-magnifying-glass"></i>

                        {{ __('education_admin.payment_show.status.under_review') }}

                    </span>

                @elseif($payment->status === 'rejected')

                    <span class="education-admin-payment-status rejected">

                        <i class="fa-solid fa-circle-xmark"></i>

                        {{ __('education_admin.payment_show.status.rejected') }}

                    </span>

                @else

                    <span class="education-admin-payment-status unpaid">

                        <i class="fa-regular fa-clock"></i>

                        {{ __('education_admin.payment_show.status.unpaid') }}

                    </span>

                @endif

            </div>

        </header>


        {{-- =========================================================
            MAIN GRID
        ========================================================== --}}

        <div class="education-admin-payment-grid">


            {{-- =====================================================
                MAIN CONTENT
            ====================================================== --}}

            <main>


                {{-- =================================================
                    PAYMENT SUMMARY
                ================================================== --}}

                <section class="education-admin-payment-card">

                    <div class="education-admin-payment-card-header">

                        <div>

                            <span>
                                {{ __('education_admin.payment_show.payment_info.label') }}
                            </span>

                            <h2>
                                {{ __('education_admin.payment_show.payment_info.title') }}
                            </h2>

                        </div>

                        <div class="education-admin-payment-card-icon">

                            <i class="fa-solid fa-money-bill-transfer"></i>

                        </div>

                    </div>


                    <div class="education-admin-payment-info-grid">


                        {{-- PAYMENT AMOUNT --}}

                        <div class="education-admin-payment-info payment-amount">

                            <span>
                                {{ __('education_admin.payment_show.payment_info.amount') }}
                            </span>

                            <strong class="amount">

                                {{ number_format((float) $payment->amount, 2) }}

                                <small>
                                    {{ $payment->currency ?: 'SAR' }}
                                </small>

                            </strong>

                        </div>


                        {{-- BOOKING PRICE --}}

                        <div class="education-admin-payment-info booking-price">

                            <span>
                                {{ __('education_admin.payment_show.payment_info.booking_price') }}
                            </span>

                            <strong class="amount">

                                @if($payment->booking)

                                    {{ number_format((float) $payment->booking->price, 2) }}

                                    <small>
                                        {{ $payment->booking->currency ?: 'SAR' }}
                                    </small>

                                @else

                                    —

                                @endif

                            </strong>

                        </div>


                        {{-- PAYMENT METHOD --}}

                        <div class="education-admin-payment-info">

                            <span>
                                {{ __('education_admin.payment_show.payment_info.payment_method') }}
                            </span>

                            <strong>

                                @switch($payment->payment_method)

                                    @case('bank_transfer')
                                        {{ __('education_admin.payment_show.payment_methods.bank_transfer') }}
                                        @break

                                    @case('cash')
                                        {{ __('education_admin.payment_show.payment_methods.cash') }}
                                        @break

                                    @case('card')
                                        {{ __('education_admin.payment_show.payment_methods.card') }}
                                        @break

                                    @case('online')
                                        {{ __('education_admin.payment_show.payment_methods.online') }}
                                        @break

                                    @default
                                        {{ $payment->payment_method ?: '—' }}

                                @endswitch

                            </strong>

                        </div>


                        {{-- REFERENCE --}}

                        <div class="education-admin-payment-info">

                            <span>
                                {{ __('education_admin.payment_show.payment_info.reference') }}
                            </span>

                            <strong>
                                {{ $payment->payment_reference ?: '—' }}
                            </strong>

                        </div>


                        {{-- SUBMITTED --}}

                        <div class="education-admin-payment-info">

                            <span>
                                {{ __('education_admin.payment_show.payment_info.submitted_at') }}
                            </span>

                            <strong>

                                @if($payment->submitted_at)

                                    {{ $payment->submitted_at->translatedFormat('d F Y - H:i') }}

                                @else

                                    —

                                @endif

                            </strong>

                        </div>


                        {{-- PAID AT --}}

                        <div class="education-admin-payment-info">

                            <span>
                                {{ __('education_admin.payment_show.payment_info.paid_at') }}
                            </span>

                            <strong>

                                @if($payment->paid_at)

                                    {{ $payment->paid_at->translatedFormat('d F Y - H:i') }}

                                @else

                                    —

                                @endif

                            </strong>

                        </div>


                        {{-- CREATED --}}

                        <div class="education-admin-payment-info">

                            <span>
                                {{ __('education_admin.payment_show.payment_info.created_at') }}
                            </span>

                            <strong>

                                @if($payment->created_at)

                                    {{ $payment->created_at->translatedFormat('d F Y - H:i') }}

                                @else

                                    —

                                @endif

                            </strong>

                        </div>


                        {{-- UPDATED --}}

                        <div class="education-admin-payment-info">

                            <span>
                                {{ __('education_admin.payment_show.payment_info.updated_at') }}
                            </span>

                            <strong>

                                @if($payment->updated_at)

                                    {{ $payment->updated_at->translatedFormat('d F Y - H:i') }}

                                @else

                                    —

                                @endif

                            </strong>

                        </div>

                    </div>

                </section>


                {{-- =================================================
                    RECEIPT
                ================================================== --}}

                <section class="education-admin-payment-card">

                    <div class="education-admin-payment-card-header">

                        <div>

                            <span>
                                {{ __('education_admin.payment_show.receipt.label') }}
                            </span>

                            <h2>
                                {{ __('education_admin.payment_show.receipt.title') }}
                            </h2>

                        </div>

                        <div class="education-admin-payment-card-icon">

                            <i class="fa-solid fa-receipt"></i>

                        </div>

                    </div>


                    @if($payment->receipt_file)

                        @php

                            /*
                            |--------------------------------------------------------------------------
                            | RECEIPT URL
                            |--------------------------------------------------------------------------
                            |
                            | الملفات موجودة داخل:
                            |
                            | public/images/education/payments
                            |
                            | لذلك نستخدم asset مباشرة.
                            |
                            */

                            $receiptUrl = $payment->receipt_url
                                ?? asset($payment->receipt_file);


                            $mimeType = strtolower(
                                trim(
                                    $payment->receipt_mime_type ?? ''
                                )
                            );


                            $extension = strtolower(
                                pathinfo(
                                    $payment->receipt_file,
                                    PATHINFO_EXTENSION
                                )
                            );


                            $isImage =
                                str_starts_with($mimeType, 'image/')
                                ||
                                in_array(
                                    $extension,
                                    [
                                        'jpg',
                                        'jpeg',
                                        'png',
                                        'gif',
                                        'webp',
                                        'bmp',
                                        'svg'
                                    ]
                                );


                            $isPdf =
                                $mimeType === 'application/pdf'
                                ||
                                $extension === 'pdf';

                        @endphp


                        <div class="education-admin-payment-receipt">


                            {{-- RECEIPT PREVIEW --}}

                            <div class="education-admin-payment-receipt-preview">

                                @if($isImage)

                                    <a
                                        href="{{ $receiptUrl }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="education-admin-payment-receipt-image-link"
                                    >

                                        <img
                                            src="{{ $receiptUrl }}"
                                            alt="{{ __('education_admin.payment_show.receipt.alt') }}"
                                            class="education-admin-payment-receipt-image"
                                        >


                                        <span class="education-admin-payment-receipt-overlay">

                                            <i class="fa-solid fa-up-right-and-down-left-from-center"></i>

                                            {{ __('education_admin.payment_show.receipt.open_full_image') }}

                                        </span>

                                    </a>


                                @elseif($isPdf)

                                    <div class="education-admin-payment-pdf">

                                        <i class="fa-solid fa-file-pdf"></i>

                                        <strong>
                                            {{ __('education_admin.payment_show.receipt.pdf_file') }}
                                        </strong>

                                        <span>
                                            {{ $payment->receipt_original_name ?: __('education_admin.payment_show.receipt.default_pdf_name') }}
                                        </span>


                                        <a
                                            href="{{ $receiptUrl }}"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="education-admin-payment-view-file"
                                        >

                                            <i class="fa-solid fa-arrow-up-right-from-square"></i>

                                            {{ __('education_admin.payment_show.receipt.open_file') }}

                                        </a>

                                    </div>


                                @else

                                    <div class="education-admin-payment-file">

                                        <i class="fa-solid fa-file"></i>

                                        <strong>
                                            {{ __('education_admin.payment_show.receipt.file') }}
                                        </strong>

                                        <span>
                                            {{ $payment->receipt_original_name ?: __('education_admin.payment_show.receipt.attached_file') }}
                                        </span>


                                        <a
                                            href="{{ $receiptUrl }}"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="education-admin-payment-view-file"
                                        >

                                            <i class="fa-solid fa-arrow-up-right-from-square"></i>

                                            {{ __('education_admin.payment_show.receipt.open_file') }}

                                        </a>

                                    </div>

                                @endif

                            </div>


                            {{-- FILE INFORMATION --}}

                            <div class="education-admin-payment-file-details">


                                <div>

                                    <span>
                                        {{ __('education_admin.payment_show.receipt.file_name') }}
                                    </span>

                                    <strong>
                                        {{ $payment->receipt_original_name ?: '—' }}
                                    </strong>

                                </div>


                                <div>

                                    <span>
                                        {{ __('education_admin.payment_show.receipt.file_type') }}
                                    </span>

                                    <strong>
                                        {{ $payment->receipt_mime_type ?: ($extension ? strtoupper($extension) : '—') }}
                                    </strong>

                                </div>


                                <div>

                                    <span>
                                        {{ __('education_admin.payment_show.receipt.file_size') }}
                                    </span>

                                    <strong>
                                        {{ $payment->formatted_receipt_size ?: '—' }}
                                    </strong>

                                </div>

                            </div>

                        </div>


                    @else

                        <div class="education-admin-payment-empty">

                            <div>

                                <i class="fa-regular fa-file-circle-xmark"></i>

                            </div>

                            <strong>
                                {{ __('education_admin.payment_show.receipt.no_receipt') }}
                            </strong>

                            <span>
                                {{ __('education_admin.payment_show.receipt.no_receipt_description') }}
                            </span>

                        </div>

                    @endif

                </section>


                {{-- =================================================
                    STUDENT NOTE
                ================================================== --}}

                @if($payment->student_note)

                    <section class="education-admin-payment-card">

                        <div class="education-admin-payment-card-header">

                            <div>

                                <span>
                                    {{ __('education_admin.payment_show.student_note.label') }}
                                </span>

                                <h2>
                                    {{ __('education_admin.payment_show.student_note.title') }}
                                </h2>

                            </div>

                            <div class="education-admin-payment-card-icon">

                                <i class="fa-regular fa-message"></i>

                            </div>

                        </div>


                        <div class="education-admin-payment-note">

                            <i class="fa-solid fa-quote-right"></i>

                            <p>
                                {{ $payment->student_note }}
                            </p>

                        </div>

                    </section>

                @endif


                {{-- =================================================
                    ADMIN REVIEW
                ================================================== --}}

                @if(
                    $payment->reviewed_at ||
                    $payment->admin_note ||
                    $payment->rejection_reason
                )

                    <section class="education-admin-payment-card">

                        <div class="education-admin-payment-card-header">

                            <div>

                                <span>
                                    {{ __('education_admin.payment_show.admin_review.label') }}
                                </span>

                                <h2>
                                    {{ __('education_admin.payment_show.admin_review.title') }}
                                </h2>

                            </div>

                            <div class="education-admin-payment-card-icon">

                                <i class="fa-solid fa-user-shield"></i>

                            </div>

                        </div>


                        <div class="education-admin-payment-review">


                            @if($payment->reviewer)

                                <div class="education-admin-payment-review-item">

                                    <span>
                                        {{ __('education_admin.payment_show.admin_review.reviewed_by') }}
                                    </span>

                                    <strong>
                                        {{ $payment->reviewer->name ?? __('education_admin.payment_show.admin_review.admin') }}
                                    </strong>

                                </div>

                            @endif


                            @if($payment->reviewed_at)

                                <div class="education-admin-payment-review-item">

                                    <span>
                                        {{ __('education_admin.payment_show.admin_review.reviewed_at') }}
                                    </span>

                                    <strong>
                                        {{ $payment->reviewed_at->translatedFormat('d F Y - H:i') }}
                                    </strong>

                                </div>

                            @endif


                            @if($payment->admin_note)

                                <div class="education-admin-payment-review-message">

                                    <span>
                                        {{ __('education_admin.payment_show.admin_review.admin_note') }}
                                    </span>

                                    <p>
                                        {{ $payment->admin_note }}
                                    </p>

                                </div>

                            @endif


                            @if($payment->rejection_reason)

                                <div class="education-admin-payment-rejection">

                                    <div>

                                        <i class="fa-solid fa-circle-exclamation"></i>

                                        <strong>
                                            {{ __('education_admin.payment_show.admin_review.rejection_reason') }}
                                        </strong>

                                    </div>

                                    <p>
                                        {{ $payment->rejection_reason }}
                                    </p>

                                </div>

                            @endif

                        </div>

                    </section>

                @endif

            </main>


            {{-- =====================================================
                SIDEBAR
            ====================================================== --}}

            <aside>


                {{-- =================================================
                    BOOKING / LESSON
                ================================================== --}}

                <section class="education-admin-payment-card">

                    <div class="education-admin-payment-card-header">

                        <div>

                            <span>
                                {{ __('education_admin.payment_show.booking.label') }}
                            </span>

                            <h2>
                                {{ __('education_admin.payment_show.booking.title') }}
                            </h2>

                        </div>

                        <div class="education-admin-payment-card-icon">

                            <i class="fa-regular fa-calendar-check"></i>

                        </div>

                    </div>


                    @if($payment->booking)

                        <div class="education-admin-payment-booking">


                            {{-- LESSON TITLE --}}

                            <div class="education-admin-payment-booking-title">

                                <span>
                                    {{ __('education_admin.payment_show.booking.lesson') }}
                                </span>

                                <strong>
                                    {{ $payment->booking->title ?: __('education_admin.payment_show.booking.default_lesson') }}
                                </strong>

                            </div>


                            {{-- PRICE --}}

                            <div class="education-admin-payment-booking-price">

                                <span>
                                    {{ __('education_admin.payment_show.booking.price') }}
                                </span>

                                <strong>

                                    {{ number_format((float) $payment->booking->price, 2) }}

                                    <small>
                                        {{ $payment->booking->currency ?: 'SAR' }}
                                    </small>

                                </strong>

                            </div>


                            {{-- TOTAL SESSIONS --}}

                            <div class="education-admin-payment-booking-row">

                                <span>
                                    {{ __('education_admin.payment_show.booking.total_sessions') }}
                                </span>

                                <strong>

                                    {{ $payment->booking->total_sessions ?? 1 }}

                                    {{
                                        ((int) ($payment->booking->total_sessions ?? 1) === 1)
                                            ? __('education_admin.payment_show.booking.session')
                                            : __('education_admin.payment_show.booking.sessions')
                                    }}

                                </strong>

                            </div>


                            {{-- COMPLETED SESSIONS --}}

                            <div class="education-admin-payment-booking-row">

                                <span>
                                    {{ __('education_admin.payment_show.booking.completed_sessions') }}
                                </span>

                                <strong>
                                    {{ $payment->booking->completed_sessions ?? 0 }}
                                </strong>

                            </div>


                            {{-- REMAINING SESSIONS --}}

                            <div class="education-admin-payment-booking-row">

                                <span>
                                    {{ __('education_admin.payment_show.booking.remaining_sessions') }}
                                </span>

                                <strong>
                                    {{ $payment->booking->remaining_sessions }}
                                </strong>

                            </div>


                            {{-- CATEGORY --}}

                            <div class="education-admin-payment-booking-row">

                                <span>
                                    {{ __('education_admin.payment_show.booking.category') }}
                                </span>

                                <strong>

                                    @switch($payment->booking->category)

                                        @case('quran')
                                            {{ __('education_admin.payment_show.booking.categories.quran') }}
                                            @break

                                        @case('tajweed')
                                            {{ __('education_admin.payment_show.booking.categories.tajweed') }}
                                            @break

                                        @case('arabic')
                                            {{ __('education_admin.payment_show.booking.categories.arabic') }}
                                            @break

                                        @default
                                            {{ $payment->booking->category ?: '—' }}

                                    @endswitch

                                </strong>

                            </div>


                            {{-- DATE --}}

                            <div class="education-admin-payment-booking-row">

                                <span>
                                    {{ __('education_admin.payment_show.booking.date') }}
                                </span>

                                <strong>

                                    @if($payment->booking->booking_date)

                                        {{ $payment->booking->booking_date->translatedFormat('d F Y') }}

                                    @else

                                        —

                                    @endif

                                </strong>

                            </div>


                            {{-- TIME --}}

                            <div class="education-admin-payment-booking-row">

                                <span>
                                    {{ __('education_admin.payment_show.booking.time') }}
                                </span>

                                <strong>

                                    @if(
                                        $payment->booking->start_time &&
                                        $payment->booking->end_time
                                    )

                                        {{ \Carbon\Carbon::parse($payment->booking->start_time)->format('H:i') }}

                                        -

                                        {{ \Carbon\Carbon::parse($payment->booking->end_time)->format('H:i') }}

                                    @else

                                        —

                                    @endif

                                </strong>

                            </div>


                            {{-- BOOKING STATUS --}}

                            <div class="education-admin-payment-booking-row">

                                <span>
                                    {{ __('education_admin.payment_show.booking.booking_status') }}
                                </span>

                                <strong>

                                    @switch($payment->booking->status)

                                        @case('confirmed')
                                            {{ __('education_admin.payment_show.booking.statuses.confirmed') }}
                                            @break

                                        @case('pending')
                                            {{ __('education_admin.payment_show.booking.statuses.pending') }}
                                            @break

                                        @case('completed')
                                            {{ __('education_admin.payment_show.booking.statuses.completed') }}
                                            @break

                                        @case('cancelled')
                                            {{ __('education_admin.payment_show.booking.statuses.cancelled') }}
                                            @break

                                        @case('rejected')
                                            {{ __('education_admin.payment_show.booking.statuses.rejected') }}
                                            @break

                                        @default
                                            {{ $payment->booking->status ?: '—' }}

                                    @endswitch

                                </strong>

                            </div>


                            {{-- PAYMENT STATUS FROM BOOKING --}}

                            <div class="education-admin-payment-booking-row">

                                <span>
                                    {{ __('education_admin.payment_show.booking.payment_status') }}
                                </span>

                                <strong>

                                    @switch($payment->booking->payment_status)

                                        @case('paid')
                                            {{ __('education_admin.payment_show.booking.payment_statuses.paid') }}
                                            @break

                                        @case('pending')
                                            {{ __('education_admin.payment_show.booking.payment_statuses.pending') }}
                                            @break

                                        @case('unpaid')
                                            {{ __('education_admin.payment_show.booking.payment_statuses.unpaid') }}
                                            @break

                                        @case('failed')
                                            {{ __('education_admin.payment_show.booking.payment_statuses.failed') }}
                                            @break

                                        @default
                                            {{ $payment->booking->payment_status ?: '—' }}

                                    @endswitch

                                </strong>

                            </div>


                            {{-- DESCRIPTION --}}

                            @if($payment->booking->description)

                                <div class="education-admin-payment-booking-description">

                                    <span>
                                        {{ __('education_admin.payment_show.booking.description') }}
                                    </span>

                                    <p>
                                        {{ $payment->booking->description }}
                                    </p>

                                </div>

                            @endif


                            {{-- SHOW BOOKING --}}

                            <a
                                href="{{ route('education.admin.bookings.show', $payment->booking) }}"
                                class="education-admin-payment-booking-link"
                            >

                                <span>
                                    {{ __('education_admin.payment_show.booking.view_booking') }}
                                </span>

                                <i class="fa-solid fa-arrow-left"></i>

                            </a>

                        </div>


                    @else

                        <div class="education-admin-payment-empty small">

                            <i class="fa-regular fa-calendar-xmark"></i>

                            <span>
                                {{ __('education_admin.payment_show.booking.not_found') }}
                            </span>

                        </div>

                    @endif

                </section>


                {{-- =================================================
                    STUDENT
                ================================================== --}}

                <section class="education-admin-payment-card">

                    <div class="education-admin-payment-card-header">

                        <div>

                            <span>
                                {{ __('education_admin.payment_show.student.label') }}
                            </span>

                            <h2>
                                {{ __('education_admin.payment_show.student.title') }}
                            </h2>

                        </div>

                        <div class="education-admin-payment-card-icon">

                            <i class="fa-solid fa-user"></i>

                        </div>

                    </div>


                    @if($payment->booking?->student)

                        @php

                            $student = $payment->booking->student;

                            $studentName = $student->name ?? __('education_admin.payment_show.student.default_name');

                        @endphp


                        <div class="education-admin-payment-student">

                            <div class="education-admin-payment-avatar">

                                {{ mb_strtoupper(
                                    mb_substr(
                                        $studentName,
                                        0,
                                        1
                                    )
                                ) }}

                            </div>


                            <div>

                                <strong>
                                    {{ $studentName }}
                                </strong>


                                @if($student->email)

                                    <span>
                                        {{ $student->email }}
                                    </span>

                                @endif


                                @if($student->phone)

                                    <span>
                                        {{ $student->phone }}
                                    </span>

                                @endif

                            </div>

                        </div>

                    @else

                        <div class="education-admin-payment-empty small">

                            <i class="fa-regular fa-user"></i>

                            <span>
                                {{ __('education_admin.payment_show.student.no_data') }}
                            </span>

                        </div>

                    @endif

                </section>


                {{-- =================================================
                    STATUS SUMMARY
                ================================================== --}}

                <section class="education-admin-payment-card education-admin-payment-status-card">

                    <div class="education-admin-payment-card-header">

                        <div>

                            <span>
                                {{ __('education_admin.payment_show.status_summary.label') }}
                            </span>

                            <h2>
                                {{ __('education_admin.payment_show.status_summary.title') }}
                            </h2>

                        </div>

                        <div class="education-admin-payment-card-icon">

                            <i class="fa-solid fa-chart-simple"></i>

                        </div>

                    </div>


                    <div class="education-admin-payment-status-summary">


                        <div
                            class="education-admin-payment-status-summary-icon
                            @if($payment->status === 'approved')
                                approved
                            @elseif($payment->status === 'rejected')
                                rejected
                            @elseif(in_array($payment->status, ['submitted', 'under_review']))
                                pending
                            @else
                                unpaid
                            @endif"
                        >

                            @if($payment->status === 'approved')

                                <i class="fa-solid fa-check"></i>

                            @elseif($payment->status === 'rejected')

                                <i class="fa-solid fa-xmark"></i>

                            @elseif(in_array($payment->status, ['submitted', 'under_review']))

                                <i class="fa-solid fa-clock"></i>

                            @else

                                <i class="fa-solid fa-minus"></i>

                            @endif

                        </div>


                        <div>

                            <strong>

                                @if($payment->status === 'approved')

                                    {{ __('education_admin.payment_show.status_summary.approved.title') }}

                                @elseif($payment->status === 'submitted')

                                    {{ __('education_admin.payment_show.status_summary.submitted.title') }}

                                @elseif($payment->status === 'under_review')

                                    {{ __('education_admin.payment_show.status_summary.under_review.title') }}

                                @elseif($payment->status === 'rejected')

                                    {{ __('education_admin.payment_show.status_summary.rejected.title') }}

                                @else

                                    {{ __('education_admin.payment_show.status_summary.unpaid.title') }}

                                @endif

                            </strong>


                            <span>

                                @if($payment->status === 'approved')

                                    {{ __('education_admin.payment_show.status_summary.approved.description') }}

                                @elseif($payment->status === 'submitted')

                                    {{ __('education_admin.payment_show.status_summary.submitted.description') }}

                                @elseif($payment->status === 'under_review')

                                    {{ __('education_admin.payment_show.status_summary.under_review.description') }}

                                @elseif($payment->status === 'rejected')

                                    {{ __('education_admin.payment_show.status_summary.rejected.description') }}

                                @else

                                    {{ __('education_admin.payment_show.status_summary.unpaid.description') }}

                                @endif

                            </span>

                        </div>

                    </div>

                </section>


                {{-- =================================================
                    ACTIONS
                ================================================== --}}

                <section class="education-admin-payment-actions-card">

                    <div class="education-admin-payment-actions-header">

                        <span>
                            {{ __('education_admin.payment_show.actions_section.label') }}
                        </span>

                        <h2>
                            {{ __('education_admin.payment_show.actions_section.title') }}
                        </h2>

                    </div>


                    {{-- APPROVE --}}

                    @if(
                        in_array(
                            $payment->status,
                            ['submitted', 'under_review']
                        )
                    )

                        <form
                            method="POST"
                            action="{{ route('education.admin.payments.approve', $payment) }}"
                            onsubmit="return confirm(@json(__('education_admin.payment_show.confirmations.approve')));"
                        >

                            @csrf

                            @method('PATCH')

                            <button
                                type="submit"
                                class="education-admin-payment-action approve"
                            >

                                <i class="fa-solid fa-circle-check"></i>

                                <span>
                                    {{ __('education_admin.payment_show.actions_section.approve') }}
                                </span>

                            </button>

                        </form>

                    @endif


                    {{-- REVIEW --}}

                    @if($payment->status === 'submitted')

                        <form
                            method="POST"
                            action="{{ route('education.admin.payments.review', $payment) }}"
                        >

                            @csrf

                            @method('PATCH')

                            <button
                                type="submit"
                                class="education-admin-payment-action review"
                            >

                                <i class="fa-solid fa-magnifying-glass"></i>

                                <span>
                                    {{ __('education_admin.payment_show.actions_section.review') }}
                                </span>

                            </button>

                        </form>

                    @endif


                    {{-- REJECT --}}

                    @if(
                        in_array(
                            $payment->status,
                            ['submitted', 'under_review']
                        )
                    )

                        <button
                            type="button"
                            class="education-admin-payment-action reject"
                            data-open-reject
                        >

                            <i class="fa-solid fa-circle-xmark"></i>

                            <span>
                                {{ __('education_admin.payment_show.actions_section.reject') }}
                            </span>

                        </button>

                    @endif


                    {{-- RESET --}}

                    @if(
                        in_array(
                            $payment->status,
                            ['approved', 'rejected']
                        )
                    )

                        <form
                            method="POST"
                            action="{{ route('education.admin.payments.reset', $payment) }}"
                            onsubmit="return confirm(@json(__('education_admin.payment_show.confirmations.reset')));"
                        >

                            @csrf

                            @method('PATCH')

                            <button
                                type="submit"
                                class="education-admin-payment-action reset"
                            >

                                <i class="fa-solid fa-rotate-left"></i>

                                <span>
                                    {{ __('education_admin.payment_show.actions_section.reset') }}
                                </span>

                            </button>

                        </form>

                    @endif


                    {{-- NO ACTION --}}

                    @if(
                        !in_array(
                            $payment->status,
                            [
                                'submitted',
                                'under_review',
                                'approved',
                                'rejected'
                            ]
                        )
                    )

                        <div class="education-admin-payment-no-action">

                            <i class="fa-regular fa-circle-check"></i>

                            <span>
                                {{ __('education_admin.payment_show.actions_section.no_action') }}
                            </span>

                        </div>

                    @endif

                </section>

            </aside>

        </div>


        {{-- =========================================================
            REJECTION MODAL
        ========================================================== --}}

        <div
            class="education-admin-payment-modal"
            data-reject-modal
            aria-hidden="true"
        >

            <div
                class="education-admin-payment-modal-backdrop"
                data-close-reject
            ></div>


            <div
                class="education-admin-payment-modal-dialog"
                role="dialog"
                aria-modal="true"
                aria-labelledby="payment-rejection-title"
            >


                <button
                    type="button"
                    class="education-admin-payment-modal-close"
                    data-close-reject
                    aria-label="{{ __('education_admin.payment_show.modal.close') }}"
                >

                    <i class="fa-solid fa-xmark"></i>

                </button>


                <div class="education-admin-payment-modal-icon">

                    <i class="fa-solid fa-circle-exclamation"></i>

                </div>


                <span class="education-admin-payment-modal-eyebrow">
                    {{ __('education_admin.payment_show.modal.eyebrow') }}
                </span>


                <h2 id="payment-rejection-title">
                    {{ __('education_admin.payment_show.modal.title') }}
                </h2>


                <p>
                    {{ __('education_admin.payment_show.modal.description') }}
                </p>


                <form
                    method="POST"
                    action="{{ route('education.admin.payments.reject', $payment) }}"
                >

                    @csrf

                    @method('PATCH')


                    <label
                        for="rejection_reason"
                        class="education-admin-payment-modal-label"
                    >

                        {{ __('education_admin.payment_show.modal.reason_label') }}

                    </label>


                    <textarea
                        id="rejection_reason"
                        name="rejection_reason"
                        rows="5"
                        required
                        minlength="3"
                        placeholder="{{ __('education_admin.payment_show.modal.reason_placeholder') }}"
                        class="education-admin-payment-modal-textarea"
                    >{{ old('rejection_reason') }}</textarea>


                    <div class="education-admin-payment-modal-actions">


                        <button
                            type="button"
                            class="education-admin-payment-modal-cancel"
                            data-close-reject
                        >

                            {{ __('education_admin.payment_show.modal.cancel') }}

                        </button>


                        <button
                            type="submit"
                            class="education-admin-payment-modal-submit"
                        >

                            <i class="fa-solid fa-circle-xmark"></i>

                            {{ __('education_admin.payment_show.modal.confirm_reject') }}

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>



{{-- ================================================================
    STYLES
================================================================ --}}

<style>

.education-admin-payment-show {

    --education-gold: #c9a227;
    --education-gold-dark: #a88312;

    --education-green: #315c4a;
    --education-green-dark: #244737;

    --education-cream: #f7f3e9;
    --education-white: #ffffff;

    --education-text: #26352f;
    --education-muted: #718078;

    --education-border: #e6e0d2;

    --education-success: #2f7957;
    --education-danger: #b64b4b;
    --education-warning: #b7831f;

    min-height: 100%;

    padding: 30px 24px 60px;

    color: var(--education-text);

    background: #f8f6f0;

    box-sizing: border-box;
}


.education-admin-payment-show *,
.education-admin-payment-show *::before,
.education-admin-payment-show *::after {

    box-sizing: border-box;

}


.education-admin-payment-container {

    width: min(1400px, 100%);

    margin: 0 auto;

}


/* =========================================================
   TOP BAR
========================================================= */

.education-admin-payment-topbar {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 20px;

    margin-bottom: 30px;

}


.education-admin-payment-back {

    display: inline-flex;

    align-items: center;

    gap: 10px;

    padding: 11px 17px;

    border: 1px solid var(--education-border);

    border-radius: 12px;

    background: var(--education-white);

    color: var(--education-text);

    text-decoration: none;

    font-size: 14px;

    font-weight: 700;

    transition:
        color .25s ease,
        border-color .25s ease,
        transform .25s ease,
        box-shadow .25s ease;

}


.education-admin-payment-back:hover {

    color: var(--education-green);

    border-color: rgba(49, 92, 74, .25);

    transform: translateY(-2px);

    box-shadow:
        0 7px 18px rgba(55, 63, 57, .06);

}


.education-admin-payment-reference {

    display: flex;

    align-items: center;

    gap: 9px;

    color: var(--education-muted);

    font-size: 13px;

}


.education-admin-payment-reference strong {

    color: var(--education-text);

    direction: ltr;

}


/* =========================================================
   HEADER
========================================================= */

.education-admin-payment-header {

    display: flex;

    align-items: flex-end;

    justify-content: space-between;

    gap: 30px;

    margin-bottom: 28px;

}


.education-admin-payment-eyebrow {

    display: block;

    margin-bottom: 8px;

    color: var(--education-gold-dark);

    font-size: 13px;

    font-weight: 800;

}


.education-admin-payment-header h1 {

    margin: 0 0 9px;

    color: var(--education-text);

    font-size: clamp(28px, 4vw, 40px);

    line-height: 1.2;

    font-weight: 900;

}


.education-admin-payment-header p {

    margin: 0;

    color: var(--education-muted);

    font-size: 15px;

    line-height: 1.8;

}


.education-admin-payment-main-status {

    flex: 0 0 auto;

}


/* =========================================================
   STATUS
========================================================= */

.education-admin-payment-status {

    display: inline-flex;

    align-items: center;

    gap: 8px;

    padding: 10px 15px;

    border-radius: 999px;

    font-size: 13px;

    font-weight: 800;

    white-space: nowrap;

}


.education-admin-payment-status.approved {

    color: #246246;

    background: #e7f4ec;

}


.education-admin-payment-status.submitted {

    color: #806118;

    background: #fbf2d7;

}


.education-admin-payment-status.review {

    color: #735c1d;

    background: #f7efd4;

}


.education-admin-payment-status.rejected {

    color: #934040;

    background: #fae8e8;

}


.education-admin-payment-status.unpaid {

    color: #69746e;

    background: #edf0ee;

}


/* =========================================================
   GRID
========================================================= */

.education-admin-payment-grid {

    display: grid;

    grid-template-columns:
        minmax(0, 1.55fr)
        minmax(320px, .75fr);

    gap: 24px;

    align-items: start;

}


/* =========================================================
   CARD
========================================================= */

.education-admin-payment-card {

    margin-bottom: 24px;

    padding: 26px;

    background: var(--education-white);

    border: 1px solid var(--education-border);

    border-radius: 20px;

    box-shadow:
        0 8px 25px rgba(55, 63, 57, .055);

}


.education-admin-payment-card:last-child {

    margin-bottom: 0;

}


.education-admin-payment-card-header {

    display: flex;

    align-items: flex-start;

    justify-content: space-between;

    gap: 20px;

    padding-bottom: 20px;

    margin-bottom: 22px;

    border-bottom: 1px solid #eee9df;

}


.education-admin-payment-card-header span {

    display: block;

    margin-bottom: 5px;

    color: var(--education-gold-dark);

    font-size: 12px;

    font-weight: 800;

}


.education-admin-payment-card-header h2 {

    margin: 0;

    color: var(--education-text);

    font-size: 21px;

    font-weight: 900;

}


.education-admin-payment-card-icon {

    width: 46px;

    height: 46px;

    display: flex;

    align-items: center;

    justify-content: center;

    flex: 0 0 46px;

    border-radius: 14px;

    color: var(--education-green);

    background: #edf4ef;

    font-size: 18px;

}


/* =========================================================
   PAYMENT INFO
========================================================= */

.education-admin-payment-info-grid {

    display: grid;

    grid-template-columns:
        repeat(2, minmax(0, 1fr));

    gap: 15px;

}


.education-admin-payment-info {

    min-width: 0;

    padding: 17px;

    background: #fbfaf6;

    border: 1px solid #eee9df;

    border-radius: 14px;

}


.education-admin-payment-info.payment-amount {

    background: #edf4ef;

    border-color: #dbe9df;

}


.education-admin-payment-info.booking-price {

    background: #faf5e6;

    border-color: #eee2bb;

}


.education-admin-payment-info span {

    display: block;

    margin-bottom: 7px;

    color: var(--education-muted);

    font-size: 12px;

}


.education-admin-payment-info strong {

    display: block;

    color: var(--education-text);

    font-size: 15px;

    overflow-wrap: anywhere;

}


.education-admin-payment-info strong.amount {

    color: var(--education-green);

    font-size: 24px;

    font-weight: 900;

    direction: ltr;

    text-align: right;

}


.education-admin-payment-info.booking-price strong.amount {

    color: var(--education-gold-dark);

}


.education-admin-payment-info strong small {

    font-size: 12px;

    font-weight: 800;

}


/* =========================================================
   RECEIPT
========================================================= */

.education-admin-payment-receipt {

    display: grid;

    gap: 20px;

}


.education-admin-payment-receipt-preview {

    min-height: 300px;

    display: flex;

    align-items: center;

    justify-content: center;

    overflow: hidden;

    background: #f7f5ef;

    border: 1px solid var(--education-border);

    border-radius: 16px;

}


.education-admin-payment-receipt-image-link {

    position: relative;

    display: flex;

    align-items: center;

    justify-content: center;

    width: 100%;

    min-height: 300px;

    text-decoration: none;

}


.education-admin-payment-receipt-image {

    display: block;

    width: 100%;

    max-height: 550px;

    object-fit: contain;

    margin: 0 auto;

}


.education-admin-payment-receipt-overlay {

    position: absolute;

    inset-inline: 0;

    bottom: 0;

    display: flex;

    align-items: center;

    justify-content: center;

    gap: 8px;

    padding: 13px;

    color: #fff;

    background: rgba(36, 71, 55, .88);

    font-size: 13px;

    font-weight: 700;

    opacity: 0;

    transition: .25s ease;

}


.education-admin-payment-receipt-image-link:hover
.education-admin-payment-receipt-overlay {

    opacity: 1;

}


.education-admin-payment-pdf,
.education-admin-payment-file {

    width: 100%;

    padding: 40px 20px;

    display: flex;

    flex-direction: column;

    align-items: center;

    justify-content: center;

    gap: 10px;

    text-align: center;

}


.education-admin-payment-pdf > i,
.education-admin-payment-file > i {

    font-size: 52px;

    color: var(--education-danger);

}


.education-admin-payment-file > i {

    color: var(--education-green);

}


.education-admin-payment-pdf strong,
.education-admin-payment-file strong {

    color: var(--education-text);

    font-size: 17px;

}


.education-admin-payment-pdf span,
.education-admin-payment-file span {

    max-width: 100%;

    color: var(--education-muted);

    font-size: 13px;

    overflow-wrap: anywhere;

}


.education-admin-payment-view-file {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 8px;

    margin-top: 8px;

    padding: 10px 15px;

    border-radius: 11px;

    color: #fff;

    background: var(--education-green);

    text-decoration: none;

    font-size: 13px;

    font-weight: 800;

    transition: .25s ease;

}


.education-admin-payment-view-file:hover {

    background: var(--education-green-dark);

    transform: translateY(-1px);

}


.education-admin-payment-file-details {

    display: grid;

    grid-template-columns:
        repeat(3, minmax(0, 1fr));

    gap: 12px;

}


.education-admin-payment-file-details > div {

    min-width: 0;

    padding: 14px;

    background: #fbfaf6;

    border: 1px solid #eee9df;

    border-radius: 12px;

}


.education-admin-payment-file-details span {

    display: block;

    margin-bottom: 6px;

    color: var(--education-muted);

    font-size: 11px;

}


.education-admin-payment-file-details strong {

    display: block;

    color: var(--education-text);

    font-size: 13px;

    overflow-wrap: anywhere;

}


/* =========================================================
   EMPTY
========================================================= */

.education-admin-payment-empty {

    min-height: 220px;

    display: flex;

    flex-direction: column;

    align-items: center;

    justify-content: center;

    gap: 9px;

    text-align: center;

    color: var(--education-muted);

}


.education-admin-payment-empty > div {

    width: 58px;

    height: 58px;

    display: flex;

    align-items: center;

    justify-content: center;

    margin-bottom: 5px;

    border-radius: 16px;

    background: #f1f2ef;

    color: #87918b;

    font-size: 24px;

}


.education-admin-payment-empty strong {

    color: var(--education-text);

    font-size: 16px;

}


.education-admin-payment-empty span {

    max-width: 360px;

    font-size: 13px;

    line-height: 1.7;

}


.education-admin-payment-empty.small {

    min-height: 120px;

}


.education-admin-payment-empty.small > i {

    font-size: 25px;

    margin-bottom: 5px;

}


/* =========================================================
   NOTES
========================================================= */

.education-admin-payment-note {

    display: flex;

    gap: 14px;

    padding: 18px;

    border-radius: 14px;

    background: #faf8f1;

    border-right: 3px solid var(--education-gold);

}


.education-admin-payment-note > i {

    flex: 0 0 auto;

    color: var(--education-gold-dark);

    font-size: 18px;

}


.education-admin-payment-note p {

    margin: 0;

    color: var(--education-text);

    line-height: 1.9;

    font-size: 14px;

    white-space: pre-line;

}


/* =========================================================
   REVIEW
========================================================= */

.education-admin-payment-review {

    display: grid;

    gap: 14px;

}


.education-admin-payment-review-item {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 15px;

    padding: 14px 16px;

    background: #fbfaf6;

    border: 1px solid #eee9df;

    border-radius: 12px;

}


.education-admin-payment-review-item span {

    color: var(--education-muted);

    font-size: 12px;

}


.education-admin-payment-review-item strong {

    color: var(--education-text);

    font-size: 14px;

}


.education-admin-payment-review-message {

    padding: 16px;

    background: #f2f6f3;

    border-radius: 13px;

}


.education-admin-payment-review-message > span {

    display: block;

    margin-bottom: 8px;

    color: var(--education-green);

    font-size: 12px;

    font-weight: 800;

}


.education-admin-payment-review-message p {

    margin: 0;

    color: var(--education-text);

    font-size: 14px;

    line-height: 1.8;

    white-space: pre-line;

}


.education-admin-payment-rejection {

    padding: 17px;

    background: #fff5f5;

    border: 1px solid #f2d5d5;

    border-radius: 13px;

}


.education-admin-payment-rejection > div {

    display: flex;

    align-items: center;

    gap: 8px;

    margin-bottom: 8px;

    color: var(--education-danger);

    font-size: 13px;

}


.education-admin-payment-rejection p {

    margin: 0;

    color: #6f3b3b;

    line-height: 1.8;

    font-size: 14px;

    white-space: pre-line;

}


/* =========================================================
   BOOKING
========================================================= */

.education-admin-payment-booking {

    display: grid;

    gap: 0;

}


.education-admin-payment-booking-title {

    padding: 4px 0 17px;

    border-bottom: 1px solid #eee9df;

}


.education-admin-payment-booking-title span,
.education-admin-payment-booking-row span,
.education-admin-payment-booking-price span {

    display: block;

    margin-bottom: 6px;

    color: var(--education-muted);

    font-size: 11px;

}


.education-admin-payment-booking-title strong {

    display: block;

    color: var(--education-text);

    font-size: 18px;

    line-height: 1.6;

}


/* =========================================================
   BOOKING PRICE
========================================================= */

.education-admin-payment-booking-price {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 15px;

    padding: 16px 0;

    border-bottom: 1px solid #eee9df;

}


.education-admin-payment-booking-price span {

    margin: 0;

}


.education-admin-payment-booking-price strong {

    color: var(--education-gold-dark);

    font-size: 22px;

    font-weight: 900;

    direction: ltr;

    text-align: left;

}


.education-admin-payment-booking-price small {

    font-size: 11px;

    font-weight: 800;

    color: var(--education-muted);

}


.education-admin-payment-booking-row {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 12px;

    padding: 13px 0;

    border-bottom: 1px solid #eee9df;

}


.education-admin-payment-booking-row span {

    margin: 0;

}


.education-admin-payment-booking-row strong {

    color: var(--education-text);

    font-size: 13px;

    text-align: left;

}


.education-admin-payment-booking-description {

    padding: 15px 0;

    border-bottom: 1px solid #eee9df;

}


.education-admin-payment-booking-description > span {

    display: block;

    margin-bottom: 7px;

    color: var(--education-muted);

    font-size: 11px;

}


.education-admin-payment-booking-description p {

    margin: 0;

    color: var(--education-text);

    font-size: 13px;

    line-height: 1.8;

    white-space: pre-line;

}


.education-admin-payment-booking-link {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 10px;

    margin-top: 16px;

    padding: 12px 14px;

    border-radius: 12px;

    color: var(--education-green);

    background: #edf4ef;

    text-decoration: none;

    font-size: 13px;

    font-weight: 800;

    transition: .25s ease;

}


.education-admin-payment-booking-link:hover {

    background: #e2eee6;

    transform: translateY(-1px);

}


/* =========================================================
   STUDENT
========================================================= */

.education-admin-payment-student {

    display: flex;

    align-items: center;

    gap: 13px;

}


.education-admin-payment-avatar {

    width: 52px;

    height: 52px;

    display: flex;

    align-items: center;

    justify-content: center;

    flex: 0 0 52px;

    border-radius: 50%;

    color: #fff;

    background: var(--education-green);

    font-size: 18px;

    font-weight: 900;

}


.education-admin-payment-student > div:last-child {

    min-width: 0;

}


.education-admin-payment-student strong {

    display: block;

    margin-bottom: 4px;

    color: var(--education-text);

    font-size: 15px;

}


.education-admin-payment-student span {

    display: block;

    margin-top: 3px;

    color: var(--education-muted);

    font-size: 12px;

    overflow-wrap: anywhere;

}


/* =========================================================
   STATUS SUMMARY
========================================================= */

.education-admin-payment-status-summary {

    display: flex;

    align-items: center;

    gap: 13px;

    padding: 15px;

    border-radius: 14px;

    background: #fbfaf6;

    border: 1px solid #eee9df;

}


.education-admin-payment-status-summary-icon {

    width: 43px;

    height: 43px;

    display: flex;

    align-items: center;

    justify-content: center;

    flex: 0 0 43px;

    border-radius: 13px;

    font-size: 16px;

}


.education-admin-payment-status-summary-icon.approved {

    color: #246246;

    background: #e7f4ec;

}


.education-admin-payment-status-summary-icon.rejected {

    color: #934040;

    background: #fae8e8;

}


.education-admin-payment-status-summary-icon.pending {

    color: #806118;

    background: #fbf2d7;

}


.education-admin-payment-status-summary-icon.unpaid {

    color: #69746e;

    background: #edf0ee;

}


.education-admin-payment-status-summary > div:last-child {

    min-width: 0;

}


.education-admin-payment-status-summary strong {

    display: block;

    margin-bottom: 4px;

    color: var(--education-text);

    font-size: 13px;

}


.education-admin-payment-status-summary span {

    display: block;

    color: var(--education-muted);

    font-size: 11px;

    line-height: 1.7;

}


/* =========================================================
   ACTIONS
========================================================= */

.education-admin-payment-actions-card {

    padding: 22px;

    margin-bottom: 24px;

    background: var(--education-white);

    border: 1px solid var(--education-border);

    border-radius: 20px;

    box-shadow:
        0 8px 25px rgba(55, 63, 57, .055);

}


.education-admin-payment-actions-header {

    margin-bottom: 17px;

}


.education-admin-payment-actions-header span {

    display: block;

    margin-bottom: 4px;

    color: var(--education-gold-dark);

    font-size: 11px;

    font-weight: 800;

}


.education-admin-payment-actions-header h2 {

    margin: 0;

    color: var(--education-text);

    font-size: 19px;

    font-weight: 900;

}


.education-admin-payment-action {

    width: 100%;

    min-height: 48px;

    display: flex;

    align-items: center;

    justify-content: center;

    gap: 9px;

    margin-top: 10px;

    padding: 12px 15px;

    border: 0;

    border-radius: 12px;

    cursor: pointer;

    font-family: inherit;

    font-size: 13px;

    font-weight: 800;

    transition:
        transform .2s ease,
        box-shadow .2s ease,
        background .2s ease;

}


.education-admin-payment-action:hover {

    transform: translateY(-2px);

}


.education-admin-payment-action.approve {

    color: #fff;

    background: var(--education-green);

    box-shadow:
        0 7px 18px rgba(49, 92, 74, .18);

}


.education-admin-payment-action.approve:hover {

    background: var(--education-green-dark);

}


.education-admin-payment-action.review {

    color: #705818;

    background: #f8efd1;

}


.education-admin-payment-action.review:hover {

    background: #f2e6bf;

}


.education-admin-payment-action.reject {

    color: #9b4141;

    background: #fae9e9;

}


.education-admin-payment-action.reject:hover {

    background: #f5dddd;

}


.education-admin-payment-action.reset {

    color: #5d6b64;

    background: #edf0ee;

}


.education-admin-payment-action.reset:hover {

    background: #e4e9e6;

}


.education-admin-payment-no-action {

    display: flex;

    align-items: center;

    justify-content: center;

    gap: 8px;

    padding: 15px;

    color: var(--education-muted);

    background: #f7f7f4;

    border-radius: 12px;

    font-size: 12px;

}


/* =========================================================
   MODAL
========================================================= */

.education-admin-payment-modal {

    position: fixed;

    inset: 0;

    z-index: 9999;

    display: none;

    align-items: center;

    justify-content: center;

    padding: 20px;

}


.education-admin-payment-modal.is-open {

    display: flex;

}


.education-admin-payment-modal-backdrop {

    position: absolute;

    inset: 0;

    background: rgba(35, 47, 41, .55);

    backdrop-filter: blur(4px);

}


.education-admin-payment-modal-dialog {

    position: relative;

    z-index: 1;

    width: min(520px, 100%);

    padding: 30px;

    background: #fff;

    border-radius: 22px;

    box-shadow:
        0 25px 80px rgba(0, 0, 0, .2);

    animation:
        educationPaymentModalIn .25s ease;

}


@keyframes educationPaymentModalIn {

    from {

        opacity: 0;

        transform:
            translateY(15px)
            scale(.98);

    }

    to {

        opacity: 1;

        transform:
            translateY(0)
            scale(1);

    }

}


.education-admin-payment-modal-close {

    position: absolute;

    top: 17px;

    inset-inline-end: 17px;

    width: 35px;

    height: 35px;

    display: flex;

    align-items: center;

    justify-content: center;

    border: 0;

    border-radius: 50%;

    color: var(--education-muted);

    background: #f2f3ef;

    cursor: pointer;

    transition: .2s ease;

}


.education-admin-payment-modal-close:hover {

    color: var(--education-danger);

    background: #fae9e9;

}


.education-admin-payment-modal-icon {

    width: 54px;

    height: 54px;

    display: flex;

    align-items: center;

    justify-content: center;

    margin-bottom: 15px;

    border-radius: 16px;

    color: var(--education-danger);

    background: #fae9e9;

    font-size: 23px;

}


.education-admin-payment-modal-eyebrow {

    display: block;

    margin-bottom: 5px;

    color: var(--education-danger);

    font-size: 12px;

    font-weight: 800;

}


.education-admin-payment-modal-dialog h2 {

    margin: 0 0 8px;

    color: var(--education-text);

    font-size: 23px;

    font-weight: 900;

}


.education-admin-payment-modal-dialog > p {

    margin: 0 0 20px;

    color: var(--education-muted);

    font-size: 13px;

    line-height: 1.8;

}


.education-admin-payment-modal-label {

    display: block;

    margin-bottom: 8px;

    color: var(--education-text);

    font-size: 13px;

    font-weight: 800;

}


.education-admin-payment-modal-textarea {

    width: 100%;

    min-height: 125px;

    resize: vertical;

    padding: 13px 14px;

    border: 1px solid var(--education-border);

    border-radius: 13px;

    outline: none;

    color: var(--education-text);

    background: #fbfaf6;

    font-family: inherit;

    font-size: 14px;

    line-height: 1.8;

    box-sizing: border-box;

    transition: .2s ease;

}


.education-admin-payment-modal-textarea:focus {

    border-color: var(--education-gold);

    background: #fff;

    box-shadow:
        0 0 0 3px rgba(201, 162, 39, .10);

}


.education-admin-payment-modal-actions {

    display: flex;

    gap: 10px;

    margin-top: 18px;

}


.education-admin-payment-modal-cancel,
.education-admin-payment-modal-submit {

    flex: 1;

    min-height: 46px;

    border: 0;

    border-radius: 12px;

    font-family: inherit;

    font-size: 13px;

    font-weight: 800;

    cursor: pointer;

    transition: .2s ease;

}


.education-admin-payment-modal-cancel {

    color: var(--education-text);

    background: #edf0ed;

}


.education-admin-payment-modal-cancel:hover {

    background: #e2e7e3;

}


.education-admin-payment-modal-submit {

    color: #fff;

    background: var(--education-danger);

}


.education-admin-payment-modal-submit:hover {

    background: #9e3f3f;

    transform: translateY(-1px);

}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 1100px) {

    .education-admin-payment-grid {

        grid-template-columns: 1fr;

    }

}


@media (max-width: 700px) {

    .education-admin-payment-show {

        padding: 20px 14px 40px;

    }


    .education-admin-payment-topbar,
    .education-admin-payment-header {

        align-items: flex-start;

        flex-direction: column;

    }


    .education-admin-payment-reference {

        width: 100%;

        justify-content: flex-start;

    }


    .education-admin-payment-header {

        gap: 16px;

    }


    .education-admin-payment-main-status {

        width: 100%;

    }


    .education-admin-payment-status {

        width: 100%;

        justify-content: center;

    }


    .education-admin-payment-card {

        padding: 19px;

        border-radius: 17px;

    }


    .education-admin-payment-info-grid {

        grid-template-columns: 1fr;

    }


    .education-admin-payment-file-details {

        grid-template-columns: 1fr;

    }


    .education-admin-payment-receipt-preview {

        min-height: 220px;

    }


    .education-admin-payment-receipt-image-link {

        min-height: 220px;

    }


    .education-admin-payment-card-header h2 {

        font-size: 18px;

    }


    .education-admin-payment-card-icon {

        width: 42px;

        height: 42px;

        flex-basis: 42px;

    }


    .education-admin-payment-review-item {

        align-items: flex-start;

        flex-direction: column;

        gap: 5px;

    }


    .education-admin-payment-booking-row {

        align-items: flex-start;

        flex-direction: column;

        gap: 5px;

    }


    .education-admin-payment-booking-row strong {

        text-align: right;

    }


    .education-admin-payment-booking-price {

        align-items: flex-start;

        flex-direction: column;

        gap: 7px;

    }


    .education-admin-payment-booking-price strong {

        text-align: right;

    }


    .education-admin-payment-modal {

        padding: 14px;

    }


    .education-admin-payment-modal-dialog {

        padding: 24px 18px;

        border-radius: 18px;

    }


    .education-admin-payment-modal-actions {

        flex-direction: column;

    }


    .education-admin-payment-modal-cancel,
    .education-admin-payment-modal-submit {

        width: 100%;

    }

}


@media (max-width: 420px) {

    .education-admin-payment-show {

        padding-inline: 10px;

    }


    .education-admin-payment-card,
    .education-admin-payment-actions-card {

        padding: 16px;

    }


    .education-admin-payment-header h1 {

        font-size: 27px;

    }


    .education-admin-payment-info {

        padding: 14px;

    }


    .education-admin-payment-info strong.amount {

        font-size: 21px;

    }

}

</style>



{{-- ================================================================
    JAVASCRIPT
================================================================ --}}

<script>

document.addEventListener('DOMContentLoaded', function () {


    const modal =
        document.querySelector(
            '[data-reject-modal]'
        );


    const openButton =
        document.querySelector(
            '[data-open-reject]'
        );


    const closeButtons =
        document.querySelectorAll(
            '[data-close-reject]'
        );


    if (!modal) {

        return;

    }


    function openModal() {

        modal.classList.add('is-open');

        modal.setAttribute(
            'aria-hidden',
            'false'
        );

        document.body.style.overflow = 'hidden';


        const textarea =
            modal.querySelector(
                'textarea'
            );


        if (textarea) {

            setTimeout(function () {

                textarea.focus();

            }, 150);

        }

    }


    function closeModal() {

        modal.classList.remove('is-open');

        modal.setAttribute(
            'aria-hidden',
            'true'
        );

        document.body.style.overflow = '';

    }


    if (openButton) {

        openButton.addEventListener(
            'click',
            openModal
        );

    }


    closeButtons.forEach(function (button) {

        button.addEventListener(
            'click',
            closeModal
        );

    });


    document.addEventListener(
        'keydown',
        function (event) {

            if (
                event.key === 'Escape' &&
                modal.classList.contains('is-open')
            ) {

                closeModal();

            }

        }
    );


    modal.addEventListener(
        'click',
        function (event) {

            if (event.target === modal) {

                closeModal();

            }

        }
    );

});

</script>

@endsection
