@extends('education.layouts.app')

@section('title', __('education_admin.payments.page_title'))

@section('content')

<div class="education-admin-payments">

    <div class="education-admin-payments-container">

        {{-- ==========================================================
            PAGE HEADER
        =========================================================== --}}

        <header class="education-admin-payments-header">

            <div class="education-admin-payments-header-content">

                <span class="education-admin-payments-eyebrow">
                    <i class="fa-solid fa-wallet"></i>
                    {{ __('education_admin.payments.header_label') }}
                </span>

                <h1>
                    {{ __('education_admin.payments.title') }}
                </h1>

                <p>
                    {{ __('education_admin.payments.description') }}
                </p>

            </div>

            <div class="education-admin-payments-header-action">

                <a
                    href="{{ route('education.admin.bookings.index') }}"
                    class="education-admin-payments-back"
                >
                    <i class="fa-solid fa-calendar-check"></i>

                    <span>
                        {{ __('education_admin.payments.actions.bookings') }}
                    </span>
                </a>

            </div>

        </header>


        {{-- ==========================================================
            FLASH MESSAGES
        =========================================================== --}}

        @if(session('success'))

            <div class="education-admin-payments-alert success">

                <div class="education-admin-payments-alert-icon">
                    <i class="fa-solid fa-circle-check"></i>
                </div>

                <div>
                    {{ session('success') }}
                </div>

            </div>

        @endif


        @if(session('error'))

            <div class="education-admin-payments-alert danger">

                <div class="education-admin-payments-alert-icon">
                    <i class="fa-solid fa-circle-exclamation"></i>
                </div>

                <div>
                    {{ session('error') }}
                </div>

            </div>

        @endif


        {{-- ==========================================================
            STATISTICS
        =========================================================== --}}

        <section class="education-admin-payments-stats">

            <div class="education-admin-payments-stat-card">

                <div class="education-admin-payments-stat-icon total">
                    <i class="fa-solid fa-wallet"></i>
                </div>

                <div class="education-admin-payments-stat-content">

                    <span>
                        {{ __('education_admin.payments.statistics.total') }}
                    </span>

                    <strong>
                        {{ $statistics['total'] ?? 0 }}
                    </strong>

                </div>

            </div>


            <div class="education-admin-payments-stat-card">

                <div class="education-admin-payments-stat-icon submitted">
                    <i class="fa-solid fa-file-arrow-up"></i>
                </div>

                <div class="education-admin-payments-stat-content">

                    <span>
                        {{ __('education_admin.payments.statistics.submitted') }}
                    </span>

                    <strong>
                        {{ $statistics['submitted'] ?? 0 }}
                    </strong>

                </div>

            </div>


            <div class="education-admin-payments-stat-card">

                <div class="education-admin-payments-stat-icon review">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>

                <div class="education-admin-payments-stat-content">

                    <span>
                        {{ __('education_admin.payments.statistics.under_review') }}
                    </span>

                    <strong>
                        {{ $statistics['under_review'] ?? 0 }}
                    </strong>

                </div>

            </div>


            <div class="education-admin-payments-stat-card">

                <div class="education-admin-payments-stat-icon approved">
                    <i class="fa-solid fa-circle-check"></i>
                </div>

                <div class="education-admin-payments-stat-content">

                    <span>
                        {{ __('education_admin.payments.statistics.approved') }}
                    </span>

                    <strong>
                        {{ $statistics['approved'] ?? 0 }}
                    </strong>

                </div>

            </div>


            <div class="education-admin-payments-stat-card">

                <div class="education-admin-payments-stat-icon rejected">
                    <i class="fa-solid fa-circle-xmark"></i>
                </div>

                <div class="education-admin-payments-stat-content">

                    <span>
                        {{ __('education_admin.payments.statistics.rejected') }}
                    </span>

                    <strong>
                        {{ $statistics['rejected'] ?? 0 }}
                    </strong>

                </div>

            </div>

        </section>


        {{-- ==========================================================
            FILTERS
        =========================================================== --}}

        <section class="education-admin-payments-filter-card">

            <form
                method="GET"
                action="{{ route('education.admin.payments.index') }}"
                class="education-admin-payments-filters"
            >

                {{-- SEARCH --}}

                <div class="education-admin-payments-filter search">

                    <label for="payment-search">
                        {{ __('education_admin.payments.filters.search') }}
                    </label>

                    <div class="education-admin-payments-input">

                        <i class="fa-solid fa-magnifying-glass"></i>

                        <input
                            type="text"
                            id="payment-search"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="{{ __('education_admin.payments.filters.search_placeholder') }}"
                        >

                    </div>

                </div>


                {{-- STATUS --}}

                <div class="education-admin-payments-filter">

                    <label for="payment-status">
                        {{ __('education_admin.payments.filters.status') }}
                    </label>

                    <select
                        id="payment-status"
                        name="status"
                    >

                        <option value="">
                            {{ __('education_admin.payments.filters.all_statuses') }}
                        </option>

                        <option
                            value="unpaid"
                            @selected(request('status') === 'unpaid')
                        >
                            {{ __('education_admin.payments.status.unpaid') }}
                        </option>

                        <option
                            value="submitted"
                            @selected(request('status') === 'submitted')
                        >
                            {{ __('education_admin.payments.status.submitted') }}
                        </option>

                        <option
                            value="under_review"
                            @selected(request('status') === 'under_review')
                        >
                            {{ __('education_admin.payments.status.under_review') }}
                        </option>

                        <option
                            value="approved"
                            @selected(request('status') === 'approved')
                        >
                            {{ __('education_admin.payments.status.approved') }}
                        </option>

                        <option
                            value="rejected"
                            @selected(request('status') === 'rejected')
                        >
                            {{ __('education_admin.payments.status.rejected') }}
                        </option>

                    </select>

                </div>


                {{-- PAYMENT METHOD --}}

                <div class="education-admin-payments-filter">

                    <label for="payment-method">
                        {{ __('education_admin.payments.filters.payment_method') }}
                    </label>

                    <select
                        id="payment-method"
                        name="payment_method"
                    >

                        <option value="">
                            {{ __('education_admin.payments.filters.all_methods') }}
                        </option>

                        <option
                            value="bank_transfer"
                            @selected(request('payment_method') === 'bank_transfer')
                        >
                            {{ __('education_admin.payments.payment_methods.bank_transfer') }}
                        </option>

                        <option
                            value="cash"
                            @selected(request('payment_method') === 'cash')
                        >
                            {{ __('education_admin.payments.payment_methods.cash') }}
                        </option>

                        <option
                            value="other"
                            @selected(request('payment_method') === 'other')
                        >
                            {{ __('education_admin.payments.payment_methods.other') }}
                        </option>

                    </select>

                </div>


                {{-- DATE --}}

                <div class="education-admin-payments-filter">

                    <label for="payment-date">
                        {{ __('education_admin.payments.filters.date') }}
                    </label>

                    <input
                        type="date"
                        id="payment-date"
                        name="date"
                        value="{{ request('date') }}"
                    >

                </div>


                {{-- ACTIONS --}}

                <div class="education-admin-payments-filter-actions">

                    <button
                        type="submit"
                        class="education-admin-payments-filter-button"
                    >

                        <i class="fa-solid fa-filter"></i>

                        <span>
                            {{ __('education_admin.payments.actions.filter') }}
                        </span>

                    </button>


                    @if(
                        request()->filled('search') ||
                        request()->filled('status') ||
                        request()->filled('payment_method') ||
                        request()->filled('date')
                    )

                        <a
                            href="{{ route('education.admin.payments.index') }}"
                            class="education-admin-payments-reset-button"
                        >

                            <i class="fa-solid fa-rotate-left"></i>

                            <span>
                                {{ __('education_admin.payments.actions.reset') }}
                            </span>

                        </a>

                    @endif

                </div>

            </form>

        </section>


        {{-- ==========================================================
            PAYMENTS
        =========================================================== --}}

        <section class="education-admin-payments-table-card">

            {{-- TABLE HEADER --}}

            <div class="education-admin-payments-table-header">

                <div>

                    <span>
                        {{ __('education_admin.payments.table.financial_record') }}
                    </span>

                    <h2>
                        {{ __('education_admin.payments.table.payment_operations') }}
                    </h2>

                </div>

                <div class="education-admin-payments-results">

                    <strong>
                        {{ $payments->total() }}
                    </strong>

                    <span>
                        {{ __('education_admin.payments.table.operation_count') }}
                    </span>

                </div>

            </div>


            @if($payments->count())

                {{-- ==================================================
                    DESKTOP TABLE
                =================================================== --}}

                <div class="education-admin-payments-table-wrapper">

                    <table class="education-admin-payments-table">

                        <thead>

                            <tr>

                                <th>
                                    {{ __('education_admin.payments.table.booking_lesson') }}
                                </th>

                                <th>
                                    {{ __('education_admin.payments.table.student') }}
                                </th>

                                <th>
                                    {{ __('education_admin.payments.table.price') }}
                                </th>

                                <th>
                                    {{ __('education_admin.payments.table.payment_method') }}
                                </th>

                                <th>
                                    {{ __('education_admin.payments.table.status') }}
                                </th>

                                <th>
                                    {{ __('education_admin.payments.table.submitted_at') }}
                                </th>

                                <th>
                                    {{ __('education_admin.payments.table.action') }}
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                        @foreach($payments as $payment)

                            @php

                                $booking = $payment->booking;

                                $student = $booking?->student;

                                $status = $payment->status;


                                /*
                                |--------------------------------------------------------------------------
                                | PRICE
                                |--------------------------------------------------------------------------
                                |
                                | السعر الصحيح موجود في:
                                |
                                | education_bookings.price
                                |
                                | وليس lesson_price.
                                |
                                */

                                $bookingPrice =
                                    $booking?->price;

                                $paymentAmount =
                                    $bookingPrice !== null
                                        ? $bookingPrice
                                        : ($payment->amount ?? 0);


                                /*
                                |--------------------------------------------------------------------------
                                | CURRENCY
                                |--------------------------------------------------------------------------
                                */

                                $paymentCurrency =
                                    $booking?->currency
                                    ?? $payment->currency
                                    ?? 'SAR';


                                /*
                                |--------------------------------------------------------------------------
                                | BOOKING TITLE
                                |--------------------------------------------------------------------------
                                */

                                $bookingTitle =
                                    $booking?->title
                                    ?? __('education_admin.payments.fallbacks.educational_booking');


                                /*
                                |--------------------------------------------------------------------------
                                | DESCRIPTION
                                |--------------------------------------------------------------------------
                                */

                                $bookingDescription =
                                    $booking?->description;


                                /*
                                |--------------------------------------------------------------------------
                                | STUDENT
                                |--------------------------------------------------------------------------
                                */

                                $studentName =
                                    $student?->name
                                    ?? __('education_admin.payments.fallbacks.student_unavailable');

                                $studentEmail =
                                    $student?->email;


                                $initial =
                                    mb_substr(
                                        $studentName,
                                        0,
                                        1
                                    );


                                /*
                                |--------------------------------------------------------------------------
                                | SESSIONS
                                |--------------------------------------------------------------------------
                                */

                                $totalSessions =
                                    (int) (
                                        $booking?->total_sessions
                                        ?? 0
                                    );


                                $completedSessions =
                                    (int) (
                                        $booking?->completed_sessions
                                        ?? 0
                                    );


                                /*
                                |--------------------------------------------------------------------------
                                | PAYMENT METHOD LABEL
                                |--------------------------------------------------------------------------
                                */

                                $paymentMethodLabel = match(
                                    $payment->payment_method
                                ) {

                                    'bank_transfer' =>
                                        __('education_admin.payments.payment_methods.bank_transfer'),

                                    'cash' =>
                                        __('education_admin.payments.payment_methods.cash'),

                                    'other' =>
                                        __('education_admin.payments.payment_methods.other'),

                                    default =>
                                        $payment->payment_method
                                        ?? '—',

                                };

                            @endphp


                            <tr>

                                {{-- ==================================================
                                    BOOKING / LESSON
                                =================================================== --}}

                                <td>

                                    <div class="education-admin-payments-booking">

                                        <span class="education-admin-payments-booking-id">

                                            #{{ $booking?->id ?? '—' }}

                                        </span>

                                        <strong>

                                            {{ $bookingTitle }}

                                        </strong>


                                        @if($bookingDescription)

                                            <span class="education-admin-payments-booking-description">

                                                {{ \Illuminate\Support\Str::limit(
                                                    $bookingDescription,
                                                    80
                                                ) }}

                                            </span>

                                        @endif


                                        @if($totalSessions > 0)

                                            <span class="education-admin-payments-sessions">

                                                <i class="fa-solid fa-layer-group"></i>

                                                {{ $totalSessions }}
                                                {{ $totalSessions === 1
                                                    ? __('education_admin.payments.sessions.single')
                                                    : __('education_admin.payments.sessions.multiple') }}

                                                @if($completedSessions > 0)

                                                    ·

                                                    {{ $completedSessions }}
                                                    {{ __('education_admin.payments.sessions.completed') }}

                                                @endif

                                            </span>

                                        @endif

                                    </div>

                                </td>


                                {{-- ==================================================
                                    STUDENT
                                =================================================== --}}

                                <td>

                                    <div class="education-admin-payments-student">

                                        <div class="education-admin-payments-avatar">

                                            {{ mb_strtoupper($initial) }}

                                        </div>

                                        <div>

                                            <strong>
                                                {{ $studentName }}
                                            </strong>

                                            @if($studentEmail)

                                                <span>
                                                    {{ $studentEmail }}
                                                </span>

                                            @endif

                                        </div>

                                    </div>

                                </td>


                                {{-- ==================================================
                                    PRICE
                                =================================================== --}}

                                <td>

                                    <div class="education-admin-payments-amount">

                                        <strong>

                                            {{ number_format(
                                                (float) $paymentAmount,
                                                2
                                            ) }}

                                        </strong>

                                        <span>

                                            {{ $paymentCurrency }}

                                        </span>

                                    </div>


                                    @if(
                                        $booking &&
                                        $payment->amount !== null &&
                                        (float) $payment->amount !== (float) $booking->price
                                    )

                                        <small class="education-admin-payments-payment-amount">

                                            {{ __('education_admin.payments.amount.registered_payment') }}

                                            {{ number_format(
                                                (float) $payment->amount,
                                                2
                                            ) }}

                                            {{ $payment->currency ?? $paymentCurrency }}

                                        </small>

                                    @endif

                                </td>


                                {{-- ==================================================
                                    PAYMENT METHOD
                                =================================================== --}}

                                <td>

                                    @if($payment->payment_method === 'bank_transfer')

                                        <span class="education-admin-payments-method">

                                            <i class="fa-solid fa-building-columns"></i>

                                            {{ __('education_admin.payments.payment_methods.bank_transfer') }}

                                        </span>

                                    @elseif($payment->payment_method === 'cash')

                                        <span class="education-admin-payments-method">

                                            <i class="fa-solid fa-money-bill"></i>

                                            {{ __('education_admin.payments.payment_methods.cash') }}

                                        </span>

                                    @elseif($payment->payment_method)

                                        <span class="education-admin-payments-method">

                                            <i class="fa-solid fa-wallet"></i>

                                            {{ $paymentMethodLabel }}

                                        </span>

                                    @else

                                        <span class="education-admin-payments-muted">
                                            —
                                        </span>

                                    @endif

                                </td>


                                {{-- ==================================================
                                    STATUS
                                =================================================== --}}

                                <td>

                                    @if($status === 'approved')

                                        <span class="education-admin-payments-status approved">

                                            <i class="fa-solid fa-circle-check"></i>

                                            {{ __('education_admin.payments.status.approved') }}

                                        </span>

                                    @elseif($status === 'submitted')

                                        <span class="education-admin-payments-status submitted">

                                            <i class="fa-solid fa-file-arrow-up"></i>

                                            {{ __('education_admin.payments.status.submitted') }}

                                        </span>

                                    @elseif($status === 'under_review')

                                        <span class="education-admin-payments-status review">

                                            <i class="fa-solid fa-magnifying-glass"></i>

                                            {{ __('education_admin.payments.status.under_review') }}

                                        </span>

                                    @elseif($status === 'rejected')

                                        <span class="education-admin-payments-status rejected">

                                            <i class="fa-solid fa-circle-xmark"></i>

                                            {{ __('education_admin.payments.status.rejected') }}

                                        </span>

                                    @else

                                        <span class="education-admin-payments-status unpaid">

                                            <i class="fa-regular fa-clock"></i>

                                            {{ __('education_admin.payments.status.unpaid') }}

                                        </span>

                                    @endif

                                </td>


                                {{-- ==================================================
                                    DATE
                                =================================================== --}}

                                <td>

                                    <div class="education-admin-payments-date">

                                        @if($payment->submitted_at)

                                            <strong>

                                                {{ $payment->submitted_at->translatedFormat('d F Y') }}

                                            </strong>

                                            <span>

                                                {{ $payment->submitted_at->format('H:i') }}

                                            </span>

                                        @elseif($payment->created_at)

                                            <strong>

                                                {{ $payment->created_at->translatedFormat('d F Y') }}

                                            </strong>

                                            <span>

                                                {{ $payment->created_at->format('H:i') }}

                                            </span>

                                        @else

                                            <span class="education-admin-payments-muted">
                                                {{ __('education_admin.payments.fallbacks.not_submitted') }}
                                            </span>

                                        @endif

                                    </div>

                                </td>


                                {{-- ==================================================
                                    ACTION
                                =================================================== --}}

                                <td>

                                    <a
                                        href="{{ route(
                                            'education.admin.payments.show',
                                            $payment
                                        ) }}"
                                        class="education-admin-payments-view"
                                    >

                                        <span>
                                            {{ __('education_admin.payments.actions.details') }}
                                        </span>

                                        <i class="fa-solid fa-arrow-left"></i>

                                    </a>

                                </td>

                            </tr>

                        @endforeach

                        </tbody>

                    </table>

                </div>


                {{-- ==================================================
                    MOBILE CARDS
                =================================================== --}}

                <div class="education-admin-payments-mobile-list">

                    @foreach($payments as $payment)

                        @php

                            $booking = $payment->booking;

                            $student = $booking?->student;


                            /*
                            |--------------------------------------------------------------------------
                            | PRICE
                            |--------------------------------------------------------------------------
                            */

                            $paymentAmount =
                                $booking?->price !== null
                                    ? $booking->price
                                    : ($payment->amount ?? 0);


                            $paymentCurrency =
                                $booking?->currency
                                ?? $payment->currency
                                ?? 'SAR';


                            $bookingTitle =
                                $booking?->title
                                ?? __('education_admin.payments.fallbacks.educational_booking');


                            $bookingDescription =
                                $booking?->description;


                            $studentName =
                                $student?->name
                                ?? __('education_admin.payments.fallbacks.student_unavailable');


                            $studentEmail =
                                $student?->email;


                            $initial =
                                mb_substr(
                                    $studentName,
                                    0,
                                    1
                                );


                            $totalSessions =
                                (int) (
                                    $booking?->total_sessions
                                    ?? 0
                                );


                            $completedSessions =
                                (int) (
                                    $booking?->completed_sessions
                                    ?? 0
                                );

                        @endphp


                        <article class="education-admin-payment-mobile-card">


                            {{-- TOP --}}

                            <div class="education-admin-payment-mobile-top">

                                <div>

                                    <span>
                                        #{{ $booking?->id ?? '—' }}
                                    </span>

                                    <h3>
                                        {{ $bookingTitle }}
                                    </h3>

                                    @if($bookingDescription)

                                        <p>
                                            {{ \Illuminate\Support\Str::limit(
                                                $bookingDescription,
                                                90
                                            ) }}
                                        </p>

                                    @endif

                                </div>


                                @if($payment->status === 'approved')

                                    <span class="education-admin-payments-status approved">

                                        <i class="fa-solid fa-circle-check"></i>

                                        {{ __('education_admin.payments.status.approved') }}

                                    </span>

                                @elseif($payment->status === 'submitted')

                                    <span class="education-admin-payments-status submitted">

                                        <i class="fa-solid fa-file-arrow-up"></i>

                                        {{ __('education_admin.payments.status.submitted') }}

                                    </span>

                                @elseif($payment->status === 'under_review')

                                    <span class="education-admin-payments-status review">

                                        <i class="fa-solid fa-magnifying-glass"></i>

                                        {{ __('education_admin.payments.status.under_review') }}

                                    </span>

                                @elseif($payment->status === 'rejected')

                                    <span class="education-admin-payments-status rejected">

                                        <i class="fa-solid fa-circle-xmark"></i>

                                        {{ __('education_admin.payments.status.rejected') }}

                                    </span>

                                @else

                                    <span class="education-admin-payments-status unpaid">

                                        <i class="fa-regular fa-clock"></i>

                                        {{ __('education_admin.payments.status.unpaid') }}

                                    </span>

                                @endif

                            </div>


                            {{-- STUDENT --}}

                            <div class="education-admin-payment-mobile-student">

                                <div class="education-admin-payments-avatar">

                                    {{ mb_strtoupper($initial) }}

                                </div>

                                <div>

                                    <strong>
                                        {{ $studentName }}
                                    </strong>

                                    @if($studentEmail)

                                        <span>
                                            {{ $studentEmail }}
                                        </span>

                                    @endif

                                </div>

                            </div>


                            {{-- PAYMENT INFO --}}

                            <div class="education-admin-payment-mobile-info">


                                {{-- PRICE --}}

                                <div>

                                    <span>
                                        {{ __('education_admin.payments.mobile.booking_price') }}
                                    </span>

                                    <strong class="price">

                                        {{ number_format(
                                            (float) $paymentAmount,
                                            2
                                        ) }}

                                        {{ $paymentCurrency }}

                                    </strong>

                                </div>


                                {{-- METHOD --}}

                                <div>

                                    <span>
                                        {{ __('education_admin.payments.mobile.method') }}
                                    </span>

                                    <strong>

                                        @if($payment->payment_method === 'bank_transfer')

                                            {{ __('education_admin.payments.payment_methods.bank_transfer') }}

                                        @elseif($payment->payment_method === 'cash')

                                            {{ __('education_admin.payments.payment_methods.cash') }}

                                        @else

                                            {{ $payment->payment_method ?? '—' }}

                                        @endif

                                    </strong>

                                </div>


                                {{-- SESSIONS --}}

                                @if($totalSessions > 0)

                                    <div>

                                        <span>
                                            {{ __('education_admin.payments.mobile.sessions') }}
                                        </span>

                                        <strong>

                                            {{ $totalSessions }}

                                            @if($completedSessions > 0)

                                                <small>
                                                    ({{ $completedSessions }}
                                                    {{ __('education_admin.payments.sessions.completed') }})
                                                </small>

                                            @endif

                                        </strong>

                                    </div>

                                @endif


                                {{-- DATE --}}

                                <div>

                                    <span>
                                        {{ __('education_admin.payments.mobile.submitted_at') }}
                                    </span>

                                    <strong>

                                        @if($payment->submitted_at)

                                            {{ $payment->submitted_at->translatedFormat('d F Y') }}

                                        @elseif($payment->created_at)

                                            {{ $payment->created_at->translatedFormat('d F Y') }}

                                        @else

                                            —

                                        @endif

                                    </strong>

                                </div>

                            </div>


                            {{-- REFERENCE --}}

                            @if($payment->payment_reference)

                                <div class="education-admin-payment-mobile-reference">

                                    <span>
                                        {{ __('education_admin.payments.mobile.payment_reference') }}
                                    </span>

                                    <strong>
                                        {{ $payment->payment_reference }}
                                    </strong>

                                </div>

                            @endif


                            {{-- ACTION --}}

                            <a
                                href="{{ route(
                                    'education.admin.payments.show',
                                    $payment
                                ) }}"
                                class="education-admin-payment-mobile-action"
                            >

                                <span>
                                    {{ __('education_admin.payments.actions.view_payment_details') }}
                                </span>

                                <i class="fa-solid fa-arrow-left"></i>

                            </a>

                        </article>

                    @endforeach

                </div>


            @else

                {{-- ==================================================
                    EMPTY STATE
                =================================================== --}}

                <div class="education-admin-payments-empty">

                    <div class="education-admin-payments-empty-icon">

                        <i class="fa-solid fa-wallet"></i>

                    </div>

                    <h3>
                        {{ __('education_admin.payments.empty.title') }}
                    </h3>

                    <p>
                        {{ __('education_admin.payments.empty.description') }}
                    </p>


                    @if(
                        request()->filled('search') ||
                        request()->filled('status') ||
                        request()->filled('payment_method') ||
                        request()->filled('date')
                    )

                        <a
                            href="{{ route('education.admin.payments.index') }}"
                            class="education-admin-payments-empty-button"
                        >

                            <i class="fa-solid fa-rotate-left"></i>

                            <span>
                                {{ __('education_admin.payments.empty.show_all') }}
                            </span>

                        </a>

                    @endif

                </div>

            @endif


            {{-- ==================================================
                PAGINATION
            =================================================== --}}

            @if($payments->hasPages())

                <div class="education-admin-payments-pagination">

                    {{ $payments->withQueryString()->links() }}

                </div>

            @endif

        </section>

    </div>

</div>


{{-- ================================================================
    STYLES
================================================================ --}}

@push('styles')

<style>

.education-admin-payments {

    --education-green: #173f35;
    --education-green-dark: #0f3028;
    --education-green-soft: #e9f1ed;

    --education-gold: #c79a2b;
    --education-gold-dark: #a97d18;
    --education-gold-soft: #fbf3d9;

    --education-cream: #f7f3e8;
    --education-white: #ffffff;

    --education-text: #17342c;
    --education-text-soft: #60736c;
    --education-border: #e4dfd1;

    min-height: 100%;

    padding: 42px 0 80px;

    direction: rtl;

    color: var(--education-text);

    font-family:
        "Cairo",
        "Tahoma",
        "Arial",
        sans-serif;

    background:
        linear-gradient(
            180deg,
            #faf8f1 0%,
            #f5f0e3 100%
        );
}


.education-admin-payments *,
.education-admin-payments *::before,
.education-admin-payments *::after {
    box-sizing: border-box;
}


.education-admin-payments a {
    color: inherit;
}


.education-admin-payments button,
.education-admin-payments input,
.education-admin-payments select {
    font-family: inherit;
}


/* ================================================================
   CONTAINER
================================================================ */

.education-admin-payments-container {

    width:
        min(
            1380px,
            calc(100% - 40px)
        );

    margin: 0 auto;
}


/* ================================================================
   HEADER
================================================================ */

.education-admin-payments-header {

    display: flex;

    align-items: flex-end;

    justify-content: space-between;

    gap: 25px;

    margin-bottom: 30px;
}


.education-admin-payments-eyebrow {

    display: inline-flex;

    align-items: center;

    gap: 8px;

    margin-bottom: 10px;

    color: var(--education-gold-dark);

    font-size: 13px;

    font-weight: 800;
}


.education-admin-payments-header h1 {

    margin: 0 0 10px;

    color: var(--education-green-dark);

    font-size: clamp(32px, 4vw, 46px);

    line-height: 1.2;

    font-weight: 900;
}


.education-admin-payments-header p {

    max-width: 700px;

    margin: 0;

    color: var(--education-text-soft);

    line-height: 1.9;

    font-size: 14px;
}


.education-admin-payments-back {

    display: inline-flex;

    align-items: center;

    gap: 9px;

    min-height: 46px;

    padding: 0 17px;

    border-radius: 13px;

    text-decoration: none;

    color: var(--education-green) !important;

    background: var(--education-white);

    border: 1px solid var(--education-border);

    box-shadow:
        0 7px 20px
        rgba(23, 63, 53, .06);

    font-size: 13px;

    font-weight: 800;

    transition:
        transform .2s ease,
        border-color .2s ease,
        box-shadow .2s ease;
}


.education-admin-payments-back i {
    color: var(--education-gold-dark);
}


.education-admin-payments-back:hover {

    border-color:
        rgba(199, 154, 43, .45);

    transform:
        translateY(-2px);

    box-shadow:
        0 12px 25px
        rgba(23, 63, 53, .10);
}


/* ================================================================
   ALERTS
================================================================ */

.education-admin-payments-alert {

    display: flex;

    align-items: center;

    gap: 12px;

    padding: 15px 18px;

    margin-bottom: 24px;

    border-radius: 15px;

    font-size: 13px;

    font-weight: 700;
}


.education-admin-payments-alert.success {

    color: #236b49;

    background: #edf8f0;

    border: 1px solid #cce9d4;
}


.education-admin-payments-alert.danger {

    color: #9b3c3c;

    background: #fff0ee;

    border: 1px solid #f0cbc5;
}


.education-admin-payments-alert-icon {

    display: grid;

    place-items: center;

    width: 35px;

    height: 35px;

    flex: 0 0 35px;

    border-radius: 10px;
}


.education-admin-payments-alert.success
.education-admin-payments-alert-icon {

    background: #d9f0df;
}


.education-admin-payments-alert.danger
.education-admin-payments-alert-icon {

    background: #f9d9d3;
}


/* ================================================================
   STATISTICS
================================================================ */

.education-admin-payments-stats {

    display: grid;

    grid-template-columns:
        repeat(5, 1fr);

    gap: 16px;

    margin-bottom: 24px;
}


.education-admin-payments-stat-card {

    display: flex;

    align-items: center;

    gap: 14px;

    min-width: 0;

    padding: 20px;

    border-radius: 19px;

    background: var(--education-white);

    border: 1px solid var(--education-border);

    box-shadow:
        0 7px 22px
        rgba(23, 63, 53, .055);

    transition:
        transform .2s ease,
        box-shadow .2s ease;
}


.education-admin-payments-stat-card:hover {

    transform:
        translateY(-3px);

    box-shadow:
        0 13px 30px
        rgba(23, 63, 53, .09);
}


.education-admin-payments-stat-icon {

    width: 49px;

    height: 49px;

    flex: 0 0 49px;

    display: grid;

    place-items: center;

    border-radius: 14px;

    font-size: 18px;
}


.education-admin-payments-stat-icon.total {

    color: var(--education-green);

    background: var(--education-green-soft);
}


.education-admin-payments-stat-icon.submitted {

    color: #9a7413;

    background: var(--education-gold-soft);
}


.education-admin-payments-stat-icon.review {

    color: #557365;

    background: #edf2ee;
}


.education-admin-payments-stat-icon.approved {

    color: #28734e;

    background: #e9f5ed;
}


.education-admin-payments-stat-icon.rejected {

    color: #a54a43;

    background: #faece9;
}


.education-admin-payments-stat-content {
    min-width: 0;
}


.education-admin-payments-stat-content span {

    display: block;

    margin-bottom: 5px;

    color: var(--education-text-soft);

    font-size: 12px;

    font-weight: 700;
}


.education-admin-payments-stat-content strong {

    display: block;

    color: var(--education-green-dark);

    font-size: 25px;

    line-height: 1;

    font-weight: 900;
}


/* ================================================================
   FILTER
================================================================ */

.education-admin-payments-filter-card {

    margin-bottom: 24px;

    padding: 20px;

    border-radius: 20px;

    background: var(--education-white);

    border: 1px solid var(--education-border);

    box-shadow:
        0 7px 22px
        rgba(23, 63, 53, .05);
}


.education-admin-payments-filters {

    display: grid;

    grid-template-columns:
        minmax(280px, 2fr)
        repeat(3, minmax(150px, 1fr))
        auto;

    gap: 14px;

    align-items: end;
}


.education-admin-payments-filter {
    min-width: 0;
}


.education-admin-payments-filter label {

    display: block;

    margin-bottom: 7px;

    color: var(--education-green);

    font-size: 12px;

    font-weight: 800;
}


.education-admin-payments-input {
    position: relative;
}


.education-admin-payments-input i {

    position: absolute;

    top: 50%;

    right: 14px;

    transform:
        translateY(-50%);

    color: #82928b;

    pointer-events: none;
}


.education-admin-payments-filter input,
.education-admin-payments-filter select {

    width: 100%;

    min-height: 46px;

    padding: 10px 13px;

    border: 1px solid #ddd9ce;

    border-radius: 12px;

    outline: none;

    background: #fbfaf6;

    color: var(--education-text) !important;

    font-size: 13px;

    font-weight: 600;

    transition:
        border-color .2s ease,
        box-shadow .2s ease,
        background .2s ease;
}


.education-admin-payments-filter input::placeholder {

    color: #8a9791;

    opacity: 1;
}


.education-admin-payments-filter.search input {
    padding-right: 42px;
}


.education-admin-payments-filter input:focus,
.education-admin-payments-filter select:focus {

    background: #fff;

    border-color:
        rgba(199, 154, 43, .75);

    box-shadow:
        0 0 0 3px
        rgba(199, 154, 43, .10);
}


.education-admin-payments-filter-actions {

    display: flex;

    align-items: center;

    gap: 8px;
}


.education-admin-payments-filter-button,
.education-admin-payments-reset-button {

    min-height: 46px;

    padding: 0 16px;

    border-radius: 12px;

    border: 0;

    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 8px;

    text-decoration: none;

    cursor: pointer;

    font: inherit;

    font-size: 12px;

    font-weight: 800;

    white-space: nowrap;
}


.education-admin-payments-filter-button {

    color: #fff !important;

    background:
        linear-gradient(
            135deg,
            #c79a2b,
            #aa7d18
        );

    box-shadow:
        0 7px 16px
        rgba(199, 154, 43, .22);
}


.education-admin-payments-filter-button:hover {
    transform: translateY(-1px);
}


.education-admin-payments-reset-button {

    color: var(--education-green) !important;

    background: var(--education-green-soft);
}


.education-admin-payments-reset-button:hover {
    background: #dce9e3;
}


/* ================================================================
   TABLE CARD
================================================================ */

.education-admin-payments-table-card {

    overflow: hidden;

    border-radius: 22px;

    background: var(--education-white);

    border: 1px solid var(--education-border);

    box-shadow:
        0 9px 28px
        rgba(23, 63, 53, .06);
}


.education-admin-payments-table-header {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 20px;

    padding: 25px 26px;

    border-bottom:
        1px solid var(--education-border);
}


.education-admin-payments-table-header
> div:first-child span {

    display: block;

    margin-bottom: 5px;

    color: var(--education-gold-dark);

    font-size: 11px;

    font-weight: 800;
}


.education-admin-payments-table-header h2 {

    margin: 0;

    color: var(--education-green-dark);

    font-size: 21px;

    font-weight: 900;
}


.education-admin-payments-results {

    display: inline-flex;

    align-items: center;

    gap: 5px;

    padding: 8px 13px;

    border-radius: 10px;

    color: var(--education-green);

    background: var(--education-green-soft);

    font-size: 12px;

    font-weight: 700;
}


.education-admin-payments-results strong {

    color: var(--education-gold-dark);

    font-size: 15px;
}


/* ================================================================
   TABLE
================================================================ */

.education-admin-payments-table-wrapper {

    width: 100%;

    overflow-x: auto;
}


.education-admin-payments-table {

    width: 100%;

    border-collapse: collapse;

    min-width: 1100px;
}


.education-admin-payments-table th {

    padding: 15px 18px;

    text-align: right;

    color: #60736c;

    font-size: 11px;

    font-weight: 900;

    background: #f7f4eb;

    border-bottom:
        1px solid var(--education-border);

    white-space: nowrap;
}


.education-admin-payments-table td {

    padding: 18px;

    color: var(--education-text);

    border-top:
        1px solid #eeeae0;

    vertical-align: middle;
}


.education-admin-payments-table tbody tr {

    transition:
        background .2s ease;
}


.education-admin-payments-table tbody tr:hover {
    background: #fbfaf6;
}


/* ================================================================
   BOOKING
================================================================ */

.education-admin-payments-booking-id {

    display: block;

    margin-bottom: 4px;

    color: #87938e;

    font-size: 11px;

    font-weight: 700;
}


.education-admin-payments-booking strong {

    display: block;

    max-width: 220px;

    color: var(--education-green-dark);

    line-height: 1.6;

    font-size: 13px;

    font-weight: 800;
}


.education-admin-payments-booking-description {

    display: block;

    max-width: 220px;

    margin-top: 4px;

    color: #7d8b85;

    font-size: 10px;

    line-height: 1.6;
}


.education-admin-payments-sessions {

    display: inline-flex;

    align-items: center;

    gap: 5px;

    margin-top: 7px;

    padding: 4px 7px;

    border-radius: 7px;

    color: #657b70;

    background: #eef3ef;

    font-size: 9px;

    font-weight: 800;
}


.education-admin-payments-sessions i {

    color: var(--education-gold-dark);

}


/* ================================================================
   STUDENT
================================================================ */

.education-admin-payments-student {

    display: flex;

    align-items: center;

    gap: 10px;
}


.education-admin-payments-avatar {

    width: 38px;

    height: 38px;

    flex: 0 0 38px;

    display: grid;

    place-items: center;

    border-radius: 50%;

    color: var(--education-green);

    background:
        linear-gradient(
            135deg,
            #edf4ef,
            #e1ece6
        );

    border: 1px solid #d5e3dc;

    font-weight: 900;

    font-size: 13px;
}


.education-admin-payments-student strong {

    display: block;

    margin-bottom: 3px;

    color: var(--education-green-dark);

    font-size: 13px;

    font-weight: 800;

    white-space: nowrap;
}


.education-admin-payments-student span {

    display: block;

    max-width: 180px;

    color: #7b8983;

    font-size: 11px;

    overflow: hidden;

    text-overflow: ellipsis;
}


/* ================================================================
   AMOUNT
================================================================ */

.education-admin-payments-amount {

    white-space: nowrap;
}


.education-admin-payments-amount strong {

    display: inline-block;

    color: var(--education-green-dark);

    font-size: 16px;

    font-weight: 900;
}


.education-admin-payments-amount span {

    margin-right: 3px;

    color: var(--education-gold-dark);

    font-size: 11px;

    font-weight: 800;
}


.education-admin-payments-payment-amount {

    display: block;

    margin-top: 6px;

    color: #89958f;

    font-size: 9px;

    line-height: 1.5;
}


/* ================================================================
   METHOD
================================================================ */

.education-admin-payments-method {

    display: inline-flex;

    align-items: center;

    gap: 7px;

    color: var(--education-text);

    white-space: nowrap;

    font-size: 12px;

    font-weight: 700;
}


.education-admin-payments-method i {

    color: var(--education-gold-dark);

    font-size: 14px;
}


.education-admin-payments-muted {
    color: #9aa59f !important;
}


/* ================================================================
   STATUS
================================================================ */

.education-admin-payments-status {

    display: inline-flex;

    align-items: center;

    gap: 6px;

    padding: 7px 10px;

    border-radius: 9px;

    font-size: 10px;

    font-weight: 900;

    white-space: nowrap;
}


.education-admin-payments-status.approved {

    color: #267049;

    background: #e9f5ed;

    border: 1px solid #cfe8d8;
}


.education-admin-payments-status.submitted {

    color: #8d6914;

    background: #fcf4dc;

    border: 1px solid #efdfad;
}


.education-admin-payments-status.review {

    color: #526c60;

    background: #edf2ee;

    border: 1px solid #d8e2dc;
}


.education-admin-payments-status.rejected {

    color: #a04942;

    background: #fbeceb;

    border: 1px solid #f0d0cc;
}


.education-admin-payments-status.unpaid {

    color: #6f7d76;

    background: #f0f1ed;

    border: 1px solid #dfe2dc;
}


/* ================================================================
   DATE
================================================================ */

.education-admin-payments-date strong {

    display: block;

    margin-bottom: 3px;

    color: var(--education-text);

    font-size: 12px;

    font-weight: 800;
}


.education-admin-payments-date span {

    color: #84918b;

    font-size: 11px;
}


/* ================================================================
   VIEW BUTTON
================================================================ */

.education-admin-payments-view {

    display: inline-flex;

    align-items: center;

    gap: 7px;

    padding: 9px 12px;

    border-radius: 10px;

    text-decoration: none;

    color: var(--education-green) !important;

    background: var(--education-green-soft);

    border: 1px solid #d7e5de;

    font-size: 11px;

    font-weight: 900;

    white-space: nowrap;

    transition: .2s ease;
}


.education-admin-payments-view i {
    color: var(--education-gold-dark);
}


.education-admin-payments-view:hover {

    color: var(--education-green-dark) !important;

    background: #dfece6;

    border-color: #c8dcd2;

    transform:
        translateX(-2px);
}


/* ================================================================
   MOBILE
================================================================ */

.education-admin-payments-mobile-list {
    display: none;
}


/* ================================================================
   EMPTY
================================================================ */

.education-admin-payments-empty {

    padding: 75px 25px;

    text-align: center;
}


.education-admin-payments-empty-icon {

    width: 70px;

    height: 70px;

    margin:
        0 auto 18px;

    display: grid;

    place-items: center;

    border-radius: 22px;

    color: var(--education-gold-dark);

    background: var(--education-gold-soft);

    border: 1px solid #efdfb2;

    font-size: 25px;
}


.education-admin-payments-empty h3 {

    margin: 0 0 8px;

    color: var(--education-green-dark);

    font-size: 21px;

    font-weight: 900;
}


.education-admin-payments-empty p {

    max-width: 500px;

    margin: 0 auto 20px;

    color: var(--education-text-soft);

    line-height: 1.8;

    font-size: 14px;
}


.education-admin-payments-empty-button {

    display: inline-flex;

    align-items: center;

    gap: 8px;

    padding: 11px 16px;

    border-radius: 11px;

    color: var(--education-green) !important;

    background: var(--education-green-soft);

    border: 1px solid #d7e5de;

    text-decoration: none;

    font-size: 12px;

    font-weight: 800;
}


.education-admin-payments-empty-button:hover {
    background: #dfece6;
}


/* ================================================================
   PAGINATION
================================================================ */

.education-admin-payments-pagination {

    padding: 20px 25px;

    border-top:
        1px solid var(--education-border);
}


/* ================================================================
   MOBILE CARD
================================================================ */

.education-admin-payment-mobile-card {

    padding: 18px;

    border-radius: 16px;

    background: #fbfaf6;

    border: 1px solid var(--education-border);
}


.education-admin-payment-mobile-top {

    display: flex;

    align-items: flex-start;

    justify-content: space-between;

    gap: 15px;

    margin-bottom: 17px;
}


.education-admin-payment-mobile-top
> div
> span {

    display: block;

    margin-bottom: 4px;

    color: #8b9791;

    font-size: 11px;

    font-weight: 700;
}


.education-admin-payment-mobile-top h3 {

    margin: 0;

    color: var(--education-green-dark);

    font-size: 15px;

    font-weight: 900;
}


.education-admin-payment-mobile-top p {

    margin: 6px 0 0;

    color: #7d8b85;

    font-size: 10px;

    line-height: 1.7;
}


.education-admin-payment-mobile-student {

    display: flex;

    align-items: center;

    gap: 10px;

    padding-bottom: 15px;

    margin-bottom: 15px;

    border-bottom:
        1px solid #e8e3d8;
}


.education-admin-payment-mobile-student strong {

    display: block;

    margin-bottom: 3px;

    color: var(--education-green-dark);

    font-size: 13px;

    font-weight: 800;
}


.education-admin-payment-mobile-student span {

    color: #7f8d86;

    font-size: 11px;
}


/* ================================================================
   MOBILE INFO
================================================================ */

.education-admin-payment-mobile-info {

    display: grid;

    grid-template-columns:
        1fr 1fr;

    gap: 10px;

    margin-bottom: 15px;
}


.education-admin-payment-mobile-info > div {

    padding: 12px;

    border-radius: 11px;

    background: #f3f0e7;

    border: 1px solid #e6e1d6;
}


.education-admin-payment-mobile-info span {

    display: block;

    margin-bottom: 5px;

    color: #7e8c85;

    font-size: 11px;

    font-weight: 700;
}


.education-admin-payment-mobile-info strong {

    color: var(--education-green-dark);

    font-size: 13px;

    font-weight: 900;
}


.education-admin-payment-mobile-info strong.price {

    color: var(--education-gold-dark);

}


.education-admin-payment-mobile-info strong small {

    color: #7f8d86;

    font-size: 9px;

}


/* ================================================================
   MOBILE REFERENCE
================================================================ */

.education-admin-payment-mobile-reference {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 10px;

    margin-bottom: 15px;

    padding: 11px 13px;

    border-radius: 10px;

    background: #f0eee7;

    border: 1px solid #e4dfd3;
}


.education-admin-payment-mobile-reference span {

    color: #7f8d86;

    font-size: 10px;

    font-weight: 700;
}


.education-admin-payment-mobile-reference strong {

    max-width: 60%;

    overflow: hidden;

    text-overflow: ellipsis;

    white-space: nowrap;

    color: var(--education-green-dark);

    font-size: 11px;
}


/* ================================================================
   MOBILE ACTION
================================================================ */

.education-admin-payment-mobile-action {

    display: flex;

    align-items: center;

    justify-content: space-between;

    padding: 12px 14px;

    border-radius: 11px;

    color: var(--education-green) !important;

    background: var(--education-green-soft);

    border: 1px solid #d7e5de;

    text-decoration: none;

    font-size: 12px;

    font-weight: 900;
}


.education-admin-payment-mobile-action i {
    color: var(--education-gold-dark);
}


/* ================================================================
   RESPONSIVE
================================================================ */

@media (max-width: 1150px) {

    .education-admin-payments-stats {

        grid-template-columns:
            repeat(3, 1fr);
    }


    .education-admin-payments-filters {

        grid-template-columns:
            repeat(2, 1fr);
    }


    .education-admin-payments-filter.search {

        grid-column:
            span 2;
    }


    .education-admin-payments-filter-actions {

        grid-column:
            span 2;
    }

}


@media (max-width: 800px) {

    .education-admin-payments {

        padding-top: 30px;
    }


    .education-admin-payments-header {

        align-items: flex-start;

        flex-direction: column;
    }


    .education-admin-payments-header-action {
        width: 100%;
    }


    .education-admin-payments-back {

        justify-content: center;

        width: 100%;
    }


    .education-admin-payments-stats {

        grid-template-columns:
            repeat(2, 1fr);
    }


    .education-admin-payments-table-wrapper {
        display: none;
    }


    .education-admin-payments-mobile-list {

        display: flex;

        flex-direction: column;

        gap: 12px;

        padding: 15px;
    }

}


@media (max-width: 550px) {

    .education-admin-payments {

        padding-top: 25px;
    }


    .education-admin-payments-container {

        width:
            calc(100% - 24px);
    }


    .education-admin-payments-stats {

        grid-template-columns:
            1fr;
    }


    .education-admin-payments-filters {

        grid-template-columns:
            1fr;
    }


    .education-admin-payments-filter.search,
    .education-admin-payments-filter-actions {

        grid-column: auto;
    }


    .education-admin-payments-filter-actions {

        flex-direction: column;
    }


    .education-admin-payments-filter-button,
    .education-admin-payments-reset-button {

        width: 100%;
    }


    .education-admin-payments-table-header {

        padding: 20px;

        align-items: flex-start;

        flex-direction: column;
    }


    .education-admin-payments-results {

        align-self: stretch;

        justify-content: center;
    }


    .education-admin-payment-mobile-info {

        grid-template-columns:
            1fr;
    }

}

</style>

@endpush

@endsection
