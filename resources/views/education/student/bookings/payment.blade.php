@extends('education.layouts.app')

@section('title', __('education.payment_page.page_title'))

@section('content')

<div class="education-payment-page" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

    <div class="education-payment-container">

        {{-- =========================================================
            PAGE HEADER
        ========================================================== --}}

        <header class="education-payment-header">

            <div class="education-payment-header-content">

                <span class="education-payment-eyebrow">
                    <i class="fa-solid fa-credit-card"></i>
                    {{ __('education.payment_page.header.eyebrow') }}
                </span>

                <h1>
                    {{ __('education.payment_page.header.title') }}
                </h1>

                <p>
                    {{ __('education.payment_page.header.description') }}
                </p>

            </div>

            <div class="education-payment-header-icon">
                <i class="fa-solid fa-wallet"></i>
            </div>

        </header>


        {{-- =========================================================
            ALERTS
        ========================================================== --}}

        @if(session('success'))

            <div class="education-payment-alert education-payment-alert-success">

                <div class="education-payment-alert-icon">
                    <i class="fa-solid fa-circle-check"></i>
                </div>

                <div>

                    <strong>
                        {{ __('education.payment_page.alerts.success_title') }}
                    </strong>

                    <p>
                        {{ session('success') }}
                    </p>

                </div>

            </div>

        @endif


        @if(session('error'))

            <div class="education-payment-alert education-payment-alert-danger">

                <div class="education-payment-alert-icon">
                    <i class="fa-solid fa-circle-exclamation"></i>
                </div>

                <div>

                    <strong>
                        {{ __('education.payment_page.alerts.error_title') }}
                    </strong>

                    <p>
                        {{ session('error') }}
                    </p>

                </div>

            </div>

        @endif


        @if($errors->any())

            <div class="education-payment-alert education-payment-alert-danger">

                <div class="education-payment-alert-icon">
                    <i class="fa-solid fa-circle-exclamation"></i>
                </div>

                <div>

                    <strong>
                        {{ __('education.payment_page.alerts.validation_title') }}
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
            PAYMENT GRID
        ========================================================== --}}

        <div class="education-payment-grid">


            {{-- =====================================================
                BOOKING SUMMARY
            ====================================================== --}}

            <section class="education-payment-card education-payment-summary-card">

                <div class="education-payment-card-header">

                    <div class="education-payment-card-icon">
                        <i class="fa-solid fa-calendar-check"></i>
                    </div>

                    <div>

                        <span class="education-payment-card-label">
                            {{ __('education.payment_page.booking.label') }}
                        </span>

                        <h2>
                            {{ __('education.payment_page.booking.title') }}
                        </h2>

                    </div>

                </div>


                {{-- =================================================
                    AMOUNT HERO
                ================================================== --}}

                <div class="education-payment-amount-box">

                    <div class="education-payment-amount-icon">
                        <i class="fa-solid fa-money-bill-wave"></i>
                    </div>

                    <div>

                        <span>
                            {{ __('education.payment_page.amount.required') }}
                        </span>

                        <strong>

                            {{ number_format((float) ($booking->price ?? 0), 2) }}

                            <small>
                                {{ $booking->currency ?? 'SAR' }}
                            </small>

                        </strong>

                    </div>

                </div>


                {{-- =================================================
                    SUMMARY LIST
                ================================================== --}}

                <div class="education-payment-summary-list">


                    {{-- LESSON --}}

                    <div class="education-payment-summary-row">

                        <div class="education-payment-summary-label">

                            <i class="fa-solid fa-book-open"></i>

                            <span>
                                {{ __('education.payment_page.summary.lesson') }}
                            </span>

                        </div>

                        <strong>
                            {{ $booking->title }}
                        </strong>

                    </div>


                    {{-- CATEGORY --}}

                    @if($booking->category)

                        <div class="education-payment-summary-row">

                            <div class="education-payment-summary-label">

                                <i class="fa-solid fa-layer-group"></i>

                                <span>
                                    {{ __('education.payment_page.summary.category') }}
                                </span>

                            </div>

                            <strong>

                                @if($booking->category === 'quran')

                                    {{ __('education.payment_page.categories.quran') }}

                                @elseif($booking->category === 'tajweed')

                                    {{ __('education.payment_page.categories.tajweed') }}

                                @elseif($booking->category === 'arabic')

                                    {{ __('education.payment_page.categories.arabic') }}

                                @else

                                    {{ $booking->category }}

                                @endif

                            </strong>

                        </div>

                    @endif


                    {{-- DATE --}}

                    <div class="education-payment-summary-row">

                        <div class="education-payment-summary-label">

                            <i class="fa-regular fa-calendar"></i>

                            <span>
                                {{ __('education.payment_page.summary.date') }}
                            </span>

                        </div>

                        <strong>

                            {{ $booking->lesson_date?->locale(app()->getLocale())->translatedFormat('d F Y') }}

                        </strong>

                    </div>


                    {{-- TIME --}}

                    <div class="education-payment-summary-row">

                        <div class="education-payment-summary-label">

                            <i class="fa-regular fa-clock"></i>

                            <span>
                                {{ __('education.payment_page.summary.time') }}
                            </span>

                        </div>

                        <strong>

                            @if($booking->start_time && $booking->end_time)

                                {{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }}

                                -

                                {{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }}

                            @else

                                {{ __('education.payment_page.fallback.not_specified') }}

                            @endif

                        </strong>

                    </div>


                    {{-- BOOKING ID --}}

                    <div class="education-payment-summary-row">

                        <div class="education-payment-summary-label">

                            <i class="fa-solid fa-hashtag"></i>

                            <span>
                                {{ __('education.payment_page.summary.booking_number') }}
                            </span>

                        </div>

                        <strong>
                            #{{ $booking->id }}
                        </strong>

                    </div>

                </div>


                {{-- =================================================
                    PAYMENT STATUS
                ================================================== --}}

                <div class="education-payment-current-status">

                    <div>

                        <span>
                            {{ __('education.payment_page.payment_status.current') }}
                        </span>

                        <strong>

                            @if($payment?->status === 'approved')

                                {{ __('education.payment_page.payment_status.approved') }}

                            @elseif($payment?->status === 'submitted')

                                {{ __('education.payment_page.payment_status.submitted') }}

                            @elseif($payment?->status === 'under_review')

                                {{ __('education.payment_page.payment_status.under_review') }}

                            @elseif($payment?->status === 'rejected')

                                {{ __('education.payment_page.payment_status.rejected') }}

                            @elseif($booking->payment_status === 'paid')

                                {{ __('education.payment_page.payment_status.paid') }}

                            @elseif($booking->payment_status === 'pending')

                                {{ __('education.payment_page.payment_status.pending') }}

                            @else

                                {{ __('education.payment_page.payment_status.unpaid') }}

                            @endif

                        </strong>

                    </div>

                    <div class="education-payment-status-dot"></div>

                </div>


                {{-- =================================================
                    BACK
                ================================================== --}}

                <a
                    href="{{ route('education.booking.show', $booking) }}"
                    class="education-payment-back-link"
                >

                    <i class="fa-solid fa-arrow-right"></i>

                    {{ __('education.payment_page.actions.back_to_booking') }}

                </a>

            </section>



            {{-- =====================================================
                PAYMENT FORM
            ====================================================== --}}

            <section class="education-payment-card education-payment-form-card">

                <div class="education-payment-card-header">

                    <div class="education-payment-card-icon gold">
                        <i class="fa-solid fa-money-check-dollar"></i>
                    </div>

                    <div>

                        <span class="education-payment-card-label">
                            {{ __('education.payment_page.payment_proof.label') }}
                        </span>

                        <h2>
                            {{ __('education.payment_page.payment_proof.title') }}
                        </h2>

                    </div>

                </div>


                {{-- =================================================
                    EXISTING PAYMENT STATUS
                ================================================== --}}

                @if($payment)

                    @if($payment->status === 'submitted')

                        <div class="education-payment-status-message submitted">

                            <div class="education-payment-status-message-icon">
                                <i class="fa-solid fa-hourglass-half"></i>
                            </div>

                            <div>

                                <strong>
                                    {{ __('education.payment_page.messages.submitted.title') }}
                                </strong>

                                <p>
                                    {{ __('education.payment_page.messages.submitted.description') }}
                                </p>

                            </div>

                        </div>

                    @elseif($payment->status === 'under_review')

                        <div class="education-payment-status-message review">

                            <div class="education-payment-status-message-icon">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </div>

                            <div>

                                <strong>
                                    {{ __('education.payment_page.messages.review.title') }}
                                </strong>

                                <p>
                                    {{ __('education.payment_page.messages.review.description') }}
                                </p>

                            </div>

                        </div>

                    @elseif($payment->status === 'approved')

                        <div class="education-payment-status-message approved">

                            <div class="education-payment-status-message-icon">
                                <i class="fa-solid fa-circle-check"></i>
                            </div>

                            <div>

                                <strong>
                                    {{ __('education.payment_page.messages.approved.title') }}
                                </strong>

                                <p>
                                    {{ __('education.payment_page.messages.approved.description') }}
                                </p>

                            </div>

                        </div>

                    @elseif($payment->status === 'rejected')

                        <div class="education-payment-status-message rejected">

                            <div class="education-payment-status-message-icon">
                                <i class="fa-solid fa-circle-xmark"></i>
                            </div>

                            <div>

                                <strong>
                                    {{ __('education.payment_page.messages.rejected.title') }}
                                </strong>

                                <p>
                                    {{ $payment->rejection_reason ?: __('education.payment_page.messages.rejected.fallback') }}
                                </p>

                            </div>

                        </div>

                    @endif

                @endif


                {{-- =================================================
                    FORM
                ================================================== --}}

                @if(!$payment || in_array($payment->status, ['unpaid', 'rejected']))

                    <form
                        action="{{ route('education.booking.payment.store', $booking) }}"
                        method="POST"
                        enctype="multipart/form-data"
                        class="education-payment-form"
                    >

                        @csrf


                        {{-- =========================================
                            PAYMENT METHOD
                        ========================================== --}}

                        <div class="education-payment-form-group">

                            <label for="payment_method">

                                {{ __('education.payment_page.form.payment_method.label') }}

                                <span>
                                    *
                                </span>

                            </label>

                            <div class="education-payment-input-wrapper">

                                <i class="fa-solid fa-wallet"></i>

                                <select
                                    id="payment_method"
                                    name="payment_method"
                                    required
                                >

                                    <option value="">
                                        {{ __('education.payment_page.form.payment_method.placeholder') }}
                                    </option>

                                    <option
                                        value="bank_transfer"
                                        @selected(
                                            old(
                                                'payment_method',
                                                $payment->payment_method ?? ''
                                            ) === 'bank_transfer'
                                        )
                                    >
                                        {{ __('education.payment_page.form.payment_method.bank_transfer') }}
                                    </option>

                                    <option
                                        value="cash"
                                        @selected(
                                            old(
                                                'payment_method',
                                                $payment->payment_method ?? ''
                                            ) === 'cash'
                                        )
                                    >
                                        {{ __('education.payment_page.form.payment_method.cash') }}
                                    </option>

                                    <option
                                        value="other"
                                        @selected(
                                            old(
                                                'payment_method',
                                                $payment->payment_method ?? ''
                                            ) === 'other'
                                        )
                                    >
                                        {{ __('education.payment_page.form.payment_method.other') }}
                                    </option>

                                </select>

                            </div>

                        </div>


                        {{-- =========================================
                            PAYMENT REFERENCE
                        ========================================== --}}

                        <div class="education-payment-form-group">

                            <label for="payment_reference">

                                {{ __('education.payment_page.form.reference.label') }}

                                <small>
                                    {{ __('education.payment_page.form.optional') }}
                                </small>

                            </label>

                            <div class="education-payment-input-wrapper">

                                <i class="fa-solid fa-hashtag"></i>

                                <input
                                    type="text"
                                    id="payment_reference"
                                    name="payment_reference"
                                    value="{{ old('payment_reference', $payment->payment_reference ?? '') }}"
                                    placeholder="{{ __('education.payment_page.form.reference.placeholder') }}"
                                >

                            </div>

                        </div>


                        {{-- =========================================
                            RECEIPT
                        ========================================== --}}

                        <div class="education-payment-form-group">

                            <label for="receipt_file">

                                {{ __('education.payment_page.form.receipt.label') }}

                                <span>
                                    *
                                </span>

                            </label>

                            <div class="education-payment-upload">

                                <input
                                    type="file"
                                    id="receipt_file"
                                    name="receipt_file"
                                    accept=".jpg,.jpeg,.png,.webp,.pdf"
                                    required
                                >

                                <label
                                    for="receipt_file"
                                    class="education-payment-upload-label"
                                >

                                    <div class="education-payment-upload-icon">

                                        <i class="fa-solid fa-cloud-arrow-up"></i>

                                    </div>

                                    <strong>
                                        {{ __('education.payment_page.form.receipt.upload') }}
                                    </strong>

                                    <span class="education-payment-upload-text">
                                        {{ __('education.payment_page.form.receipt.formats') }}
                                    </span>

                                    <span class="education-payment-upload-size">
                                        {{ __('education.payment_page.form.receipt.max_size') }}
                                    </span>

                                </label>

                            </div>

                            <div
                                class="education-payment-file-name"
                                id="payment-file-name"
                            >

                                <i class="fa-solid fa-file"></i>

                                <span>
                                    {{ __('education.payment_page.form.receipt.no_file') }}
                                </span>

                            </div>

                        </div>


                        {{-- =========================================
                            STUDENT NOTE
                        ========================================== --}}

                        <div class="education-payment-form-group">

                            <label for="student_note">

                                {{ __('education.payment_page.form.note.label') }}

                                <small>
                                    {{ __('education.payment_page.form.optional') }}
                                </small>

                            </label>

                            <textarea
                                id="student_note"
                                name="student_note"
                                rows="4"
                                placeholder="{{ __('education.payment_page.form.note.placeholder') }}"
                            >{{ old('student_note', $payment->student_note ?? '') }}</textarea>

                        </div>


                        {{-- =========================================
                            INFORMATION BOX
                        ========================================== --}}

                        <div class="education-payment-info-box">

                            <div class="education-payment-info-icon">

                                <i class="fa-solid fa-circle-info"></i>

                            </div>

                            <div>

                                <strong>
                                    {{ __('education.payment_page.important_note.title') }}
                                </strong>

                                <p>
                                    {{ __('education.payment_page.important_note.description') }}
                                </p>

                            </div>

                        </div>


                        {{-- =========================================
                            ACTIONS
                        ========================================== --}}

                        <div class="education-payment-actions">

                            <button
                                type="submit"
                                class="education-payment-submit"
                            >

                                <i class="fa-solid fa-paper-plane"></i>

                                {{ __('education.payment_page.actions.submit') }}

                            </button>

                            <a
                                href="{{ route('education.booking.show', $booking) }}"
                                class="education-payment-cancel"
                            >
                                {{ __('education.payment_page.actions.cancel') }}
                            </a>

                        </div>

                    </form>

                @endif

            </section>

        </div>

    </div>

</div>


{{-- ===============================================================
    STYLES
================================================================ --}}

@push('styles')

<style>

    .education-payment-page {

        --education-green: #285943;
        --education-green-dark: #1d4533;
        --education-green-soft: #e9f1eb;

        --education-gold: #b89452;
        --education-gold-dark: #96753d;
        --education-gold-soft: #f6efdf;

        --education-cream: #f7f3ea;
        --education-white: #ffffff;

        --education-text: #26352d;
        --education-muted: #718077;

        --education-border: #e4ded2;

        min-height: 100vh;

        padding: 45px 0 90px;

        background:
            linear-gradient(
                180deg,
                #fbf8f1 0%,
                #f5f0e5 100%
            );

        color: var(--education-text) !important;

    }


    .education-payment-page *,
    .education-payment-page *::before,
    .education-payment-page *::after {

        box-sizing: border-box;

    }


    .education-payment-page
    .education-payment-container {

        width:
            min(
                1180px,
                calc(100% - 40px)
            );

        margin: 0 auto;

    }


    /* ============================================================
       HEADER
    ============================================================ */

    .education-payment-header {

        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 30px;

        margin-bottom: 35px;

    }


    .education-payment-header-content {

        max-width: 720px;

    }


    .education-payment-eyebrow {

        display: inline-flex;
        align-items: center;

        gap: 8px;

        color: var(--education-gold-dark) !important;

        font-size: 13px;
        font-weight: 800;

        letter-spacing: .08em;

        margin-bottom: 12px;

    }


    .education-payment-header h1 {

        margin: 0 0 12px;

        color: var(--education-green-dark) !important;

        font-size:
            clamp(
                30px,
                4vw,
                46px
            );

        line-height: 1.2;
        font-weight: 800;

    }


    .education-payment-header p {

        margin: 0;

        color: var(--education-muted) !important;

        line-height: 1.9;

        font-size: 15px;

    }


    .education-payment-header-icon {

        width: 72px;
        height: 72px;

        flex: 0 0 72px;

        display: grid;
        place-items: center;

        border-radius: 22px;

        background:
            linear-gradient(
                135deg,
                var(--education-green),
                var(--education-green-dark)
            );

        color: #fff !important;

        box-shadow:
            0 15px 35px
            rgba(40,89,67,.18);

        font-size: 26px;

    }


    /* ============================================================
       ALERTS
    ============================================================ */

    .education-payment-alert {

        display: flex;
        align-items: flex-start;

        gap: 14px;

        padding: 17px 20px;

        border-radius: 16px;

        margin-bottom: 22px;

        border: 1px solid transparent;

    }


    .education-payment-alert-success {

        background: #edf7ef;
        border-color: #cfe7d3;

        color: #285943 !important;

    }


    .education-payment-alert-danger {

        background: #fff0ef;
        border-color: #f0ceca;

        color: #8b3f37 !important;

    }


    .education-payment-alert-icon {

        font-size: 19px;

        padding-top: 2px;

    }


    .education-payment-alert strong {

        display: block;

        margin-bottom: 3px;

        color: inherit !important;

    }


    .education-payment-alert p {

        margin: 0;

        color: inherit !important;

        opacity: .85;

    }


    .education-payment-alert ul {

        margin: 8px 0 0;

        padding-right: 20px;

        color: inherit !important;

    }


    /* ============================================================
       GRID
    ============================================================ */

    .education-payment-grid {

        display: grid;

        grid-template-columns:
            minmax(310px, .82fr)
            minmax(450px, 1.18fr);

        gap: 25px;

        align-items: start;

    }


    /* ============================================================
       CARDS
    ============================================================ */

    .education-payment-card {

        background:
            rgba(255,255,255,.96);

        border:
            1px solid
            var(--education-border);

        border-radius: 26px;

        padding: 30px;

        box-shadow:
            0 18px 50px
            rgba(66,55,36,.07);

        color:
            var(--education-text) !important;

    }


    .education-payment-card-header {

        display: flex;

        align-items: center;

        gap: 15px;

        margin-bottom: 27px;

    }


    .education-payment-card-icon {

        width: 50px;
        height: 50px;

        flex: 0 0 50px;

        display: grid;
        place-items: center;

        border-radius: 15px;

        background:
            var(--education-green-soft);

        color:
            var(--education-green) !important;

        font-size: 18px;

    }


    .education-payment-card-icon.gold {

        background:
            var(--education-gold-soft);

        color:
            var(--education-gold-dark) !important;

    }


    .education-payment-card-label {

        display: block;

        margin-bottom: 4px;

        color:
            var(--education-gold-dark) !important;

        font-size: 12px;

        font-weight: 800;

        letter-spacing: .05em;

    }


    .education-payment-card-header h2 {

        margin: 0;

        color:
            var(--education-green-dark) !important;

        font-size: 22px;

        font-weight: 800;

    }


    /* ============================================================
       AMOUNT
    ============================================================ */

    .education-payment-amount-box {

        display: flex;

        align-items: center;

        gap: 16px;

        padding: 21px;

        margin-bottom: 24px;

        border-radius: 19px;

        background:
            linear-gradient(
                135deg,
                #f7f0df,
                #fcf8ef
            );

        border:
            1px solid
            #eadcbd;

    }


    .education-payment-amount-icon {

        width: 48px;
        height: 48px;

        flex: 0 0 48px;

        display: grid;
        place-items: center;

        border-radius: 14px;

        background:
            var(--education-gold);

        color: #fff !important;

    }


    .education-payment-amount-box span {

        display: block;

        color:
            var(--education-muted) !important;

        font-size: 12px;

        margin-bottom: 3px;

    }


    .education-payment-amount-box strong {

        display: block;

        color:
            var(--education-green-dark) !important;

        font-size: 26px;

        line-height: 1.2;

    }


    .education-payment-amount-box small {

        color:
            var(--education-gold-dark) !important;

        font-size: 13px;

        font-weight: 800;

    }


    /* ============================================================
       SUMMARY
    ============================================================ */

    .education-payment-summary-list {

        border-top:
            1px solid
            var(--education-border);

    }


    .education-payment-summary-row {

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 20px;

        padding: 17px 0;

        border-bottom:
            1px solid
            var(--education-border);

    }


    .education-payment-summary-label {

        display: flex;

        align-items: center;

        gap: 9px;

        color:
            var(--education-muted) !important;

        font-size: 14px;

    }


    .education-payment-summary-label i {

        width: 22px;

        color:
            var(--education-gold) !important;

        text-align: center;

    }


    .education-payment-summary-row strong {

        max-width: 60%;

        text-align: left;

        color:
            var(--education-text) !important;

        font-size: 14px;

        font-weight: 700;

    }


    /* ============================================================
       PAYMENT STATUS
    ============================================================ */

    .education-payment-current-status {

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 15px;

        margin-top: 22px;

        padding: 15px 17px;

        border-radius: 15px;

        background:
            #f4f7f3;

        border:
            1px solid
            #dfe8df;

    }


    .education-payment-current-status span {

        display: block;

        color:
            var(--education-muted) !important;

        font-size: 12px;

        margin-bottom: 4px;

    }


    .education-payment-current-status strong {

        color:
            var(--education-green-dark) !important;

        font-size: 14px;

    }


    .education-payment-status-dot {

        width: 10px;
        height: 10px;

        border-radius: 50%;

        background:
            var(--education-gold);

        box-shadow:
            0 0 0 5px
            rgba(184,148,82,.12);

    }


    /* ============================================================
       BACK LINK
    ============================================================ */

    .education-payment-back-link {

        display: inline-flex;

        align-items: center;

        gap: 8px;

        margin-top: 22px;

        color:
            var(--education-green) !important;

        text-decoration: none;

        font-size: 13px;

        font-weight: 700;

    }


    .education-payment-back-link:hover {

        color:
            var(--education-gold-dark) !important;

    }


    /* ============================================================
       STATUS MESSAGE
    ============================================================ */

    .education-payment-status-message {

        display: flex;

        align-items: flex-start;

        gap: 13px;

        padding: 17px;

        border-radius: 16px;

        margin-bottom: 24px;

        border: 1px solid transparent;

    }


    .education-payment-status-message-icon {

        width: 40px;
        height: 40px;

        flex: 0 0 40px;

        display: grid;
        place-items: center;

        border-radius: 12px;

    }


    .education-payment-status-message strong {

        display: block;

        margin-bottom: 4px;

        font-size: 15px;

    }


    .education-payment-status-message p {

        margin: 0;

        font-size: 13px;

        line-height: 1.7;

    }


    .education-payment-status-message.submitted,
    .education-payment-status-message.review {

        background:
            #fff8e9;

        border-color:
            #ead9ad;

        color:
            #765d2c !important;

    }


    .education-payment-status-message.submitted
    .education-payment-status-message-icon,
    .education-payment-status-message.review
    .education-payment-status-message-icon {

        background:
            #f5e7bd;

        color:
            #96753d !important;

    }


    .education-payment-status-message.approved {

        background:
            #edf7ef;

        border-color:
            #cfe7d3;

        color:
            #285943 !important;

    }


    .education-payment-status-message.approved
    .education-payment-status-message-icon {

        background:
            #d8ecd9;

        color:
            #285943 !important;

    }


    .education-payment-status-message.rejected {

        background:
            #fff0ef;

        border-color:
            #f0ceca;

        color:
            #8b3f37 !important;

    }


    .education-payment-status-message.rejected
    .education-payment-status-message-icon {

        background:
            #f5d8d5;

        color:
            #9d4a42 !important;

    }


    /* ============================================================
       FORM
    ============================================================ */

    .education-payment-form {

        display: flex;

        flex-direction: column;

        gap: 21px;

    }


    .education-payment-form-group {

        display: flex;

        flex-direction: column;

        gap: 8px;

    }


    .education-payment-form-group > label {

        color:
            var(--education-text) !important;

        font-size: 14px;

        font-weight: 800;

    }


    .education-payment-form-group > label > span {

        color:
            #b4493f !important;

    }


    .education-payment-form-group > label > small {

        color:
            var(--education-muted) !important;

        font-size: 11px;

        font-weight: 500;

        margin-right: 5px;

    }


    /* ============================================================
       INPUTS
    ============================================================ */

    .education-payment-input-wrapper {

        position: relative;

    }


    .education-payment-input-wrapper > i {

        position: absolute;

        top: 50%;

        right: 16px;

        transform:
            translateY(-50%);

        color:
            var(--education-gold-dark) !important;

        pointer-events: none;

        z-index: 2;

    }


    .education-payment-input-wrapper input,
    .education-payment-input-wrapper select,
    .education-payment-form-group textarea {

        width: 100%;

        min-height: 52px;

        padding:
            0
            17px;

        border:
            1px solid
            #ddd7cb;

        border-radius: 14px;

        background:
            #fffdf8;

        color:
            var(--education-text) !important;

        font-family: inherit;

        font-size: 14px;

        outline: none;

        transition:
            border-color .2s ease,
            box-shadow .2s ease,
            background .2s ease;

    }


    .education-payment-input-wrapper input {

        padding-right: 45px;

    }


    .education-payment-input-wrapper input::placeholder,
    .education-payment-form-group textarea::placeholder {

        color:
            #9a9f99 !important;

        opacity: 1;

    }


    .education-payment-input-wrapper input:focus,
    .education-payment-input-wrapper select:focus,
    .education-payment-form-group textarea:focus {

        border-color:
            var(--education-green);

        background:
            #fff;

        box-shadow:
            0 0 0 4px
            rgba(40,89,67,.08);

    }


    .education-payment-input-wrapper select {

        padding-right: 45px;

        cursor: pointer;

    }


    .education-payment-form-group textarea {

        min-height: 120px;

        padding: 15px 17px;

        resize: vertical;

        line-height: 1.8;

    }


    /* ============================================================
       FILE UPLOAD
    ============================================================ */

    .education-payment-upload input {

        display: none;

    }


    .education-payment-upload-label {

        min-height: 190px;

        display: flex;

        flex-direction: column;

        align-items: center;

        justify-content: center;

        gap: 8px;

        padding: 25px;

        border:
            1.5px dashed
            #d1c7b6;

        border-radius: 18px;

        background:
            #fcfaf5;

        color:
            var(--education-text) !important;

        text-align: center;

        cursor: pointer;

        transition:
            .25s ease;

    }


    .education-payment-upload-label:hover {

        border-color:
            var(--education-green);

        background:
            #f4f8f4;

        transform:
            translateY(-1px);

    }


    .education-payment-upload-icon {

        width: 55px;
        height: 55px;

        display: grid;
        place-items: center;

        margin-bottom: 4px;

        border-radius: 16px;

        background:
            var(--education-green-soft);

        color:
            var(--education-green) !important;

        font-size: 22px;

    }


    .education-payment-upload-label strong {

        color:
            var(--education-green-dark) !important;

        font-size: 15px;

    }


    .education-payment-upload-text {

        color:
            var(--education-muted) !important;

        font-size: 12px;

    }


    .education-payment-upload-size {

        color:
            var(--education-gold-dark) !important;

        font-size: 11px;

        font-weight: 700;

    }


    .education-payment-file-name {

        display: flex;

        align-items: center;

        gap: 8px;

        min-height: 20px;

        margin-top: 7px;

        color:
            var(--education-muted) !important;

        font-size: 12px;

    }


    .education-payment-file-name i {

        color:
            var(--education-gold) !important;

    }


    /* ============================================================
       INFO BOX
    ============================================================ */

    .education-payment-info-box {

        display: flex;

        align-items: flex-start;

        gap: 12px;

        padding: 16px 17px;

        border-radius: 15px;

        background:
            #f5f8f4;

        border:
            1px solid
            #dce7dc;

    }


    .education-payment-info-icon {

        color:
            var(--education-green) !important;

        font-size: 17px;

        padding-top: 2px;

    }


    .education-payment-info-box strong {

        display: block;

        margin-bottom: 3px;

        color:
            var(--education-green-dark) !important;

        font-size: 13px;

    }


    .education-payment-info-box p {

        margin: 0;

        color:
            var(--education-muted) !important;

        font-size: 12px;

        line-height: 1.7;

    }


    /* ============================================================
       ACTIONS
    ============================================================ */

    .education-payment-actions {

        display: flex;

        align-items: stretch;

        gap: 12px;

        margin-top: 3px;

    }


    .education-payment-submit,
    .education-payment-cancel {

        min-height: 53px;

        display: inline-flex;

        align-items: center;

        justify-content: center;

        gap: 9px;

        border-radius: 14px;

        padding:
            0
            20px;

        font-family: inherit;

        font-size: 14px;

        font-weight: 800;

        text-decoration: none;

        cursor: pointer;

        transition:
            .2s ease;

    }


    .education-payment-submit {

        flex: 1;

        border: 0;

        background:
            linear-gradient(
                135deg,
                var(--education-green),
                var(--education-green-dark)
            );

        color: #fff !important;

        box-shadow:
            0 10px 22px
            rgba(40,89,67,.18);

    }


    .education-payment-submit:hover {

        transform:
            translateY(-2px);

        box-shadow:
            0 14px 28px
            rgba(40,89,67,.24);

    }


    .education-payment-cancel {

        min-width: 105px;

        background:
            #f2eee6;

        border:
            1px solid
            #ddd5c7;

        color:
            var(--education-text) !important;

    }


    .education-payment-cancel:hover {

        background:
            #eae4d8;

        color:
            var(--education-green-dark) !important;

    }


    /* ============================================================
       RESPONSIVE
    ============================================================ */

    @media (max-width: 900px) {

        .education-payment-grid {

            grid-template-columns: 1fr;

        }

    }


    @media (max-width: 600px) {

        .education-payment-page {

            padding:
                30px
                0
                60px;

        }


        .education-payment-page
        .education-payment-container {

            width:
                calc(100% - 24px);

        }


        .education-payment-header {

            align-items: flex-start;

        }


        .education-payment-header-icon {

            width: 55px;
            height: 55px;

            flex-basis: 55px;

            border-radius: 17px;

            font-size: 20px;

        }


        .education-payment-card {

            padding: 21px;

            border-radius: 21px;

        }


        .education-payment-summary-row {

            align-items: flex-start;

            flex-direction: column;

            gap: 6px;

        }


        .education-payment-summary-row strong {

            max-width: 100%;

            text-align: right;

        }


        .education-payment-actions {

            flex-direction: column;

        }


        .education-payment-cancel {

            width: 100%;

        }

    }


    /* ============================================================
       HARD COLOR OVERRIDES
    ============================================================ */

    .education-payment-page h1,
    .education-payment-page h2,
    .education-payment-page h3,
    .education-payment-page h4,
    .education-payment-page p,
    .education-payment-page span,
    .education-payment-page strong,
    .education-payment-page label,
    .education-payment-page small {

        text-shadow: none;

    }


    .education-payment-page input,
    .education-payment-page select,
    .education-payment-page textarea {

        -webkit-text-fill-color:
            var(--education-text) !important;

    }

</style>

@endpush


{{-- ===============================================================
    SCRIPT
================================================================ --}}

@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {

    const fileInput = document.getElementById('receipt_file');

    const fileName = document.getElementById('payment-file-name');

    const noFileText = @json(
        __('education.payment_page.form.receipt.no_file')
    );


    if (!fileInput || !fileName) {
        return;
    }


    fileInput.addEventListener('change', function () {

        const file =
            this.files && this.files.length
                ? this.files[0]
                : null;


        if (!file) {

            fileName.innerHTML =
                '<i class="fa-solid fa-file"></i>' +
                '<span>' +
                noFileText +
                '</span>';

            return;
        }


        const size =
            file.size >= 1024 * 1024
                ? (file.size / (1024 * 1024)).toFixed(2) + ' MB'
                : (file.size / 1024).toFixed(1) + ' KB';


        fileName.innerHTML =
            '<i class="fa-solid fa-file-circle-check"></i>' +
            '<span>' +
            file.name +
            ' — ' +
            size +
            '</span>';

    });

});

</script>

@endpush

@endsection
