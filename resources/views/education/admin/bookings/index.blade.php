
@extends('education.admin.layouts.app')

@section('title', __('education_admin.bookings.page_title'))

@section('page_title', __('education_admin.bookings.page_title'))

@section('content')

<div class="education-admin-bookings-page">

{{-- ==================================================
    PAGE HEADER
================================================== --}}

<div class="education-admin-page-header">

    <div>

        <span class="education-admin-page-header-label">
            {{ __('education_admin.bookings.eyebrow') }}
        </span>

        <h2 style="color: black">
            {{ __('education_admin.bookings.title') }}
        </h2>

        <p>
            {{ __('education_admin.bookings.description') }}
        </p>

    </div>

</div>


{{-- ==================================================
    FLASH MESSAGES
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
    STATISTICS
================================================== --}}

<section class="education-admin-booking-stats">

    {{-- TOTAL --}}

    <article class="education-admin-booking-stat-card">

        <div class="education-admin-booking-stat-icon">

            <i class="fa-solid fa-calendar-days"></i>

        </div>

        <div>

            <span>
                {{ __('education_admin.bookings.total_bookings') }}
            </span>

            <strong>
                {{ $statistics['total'] ?? 0 }}
            </strong>

        </div>

    </article>


    {{-- PENDING --}}

    <article class="education-admin-booking-stat-card pending">

        <div class="education-admin-booking-stat-icon">

            <i class="fa-regular fa-clock"></i>

        </div>

        <div>

            <span>
                {{ __('education_admin.bookings.pending') }}
            </span>

            <strong>
                {{ $statistics['pending'] ?? 0 }}
            </strong>

        </div>

    </article>


    {{-- CONFIRMED --}}

    <article class="education-admin-booking-stat-card confirmed">

        <div class="education-admin-booking-stat-icon">

            <i class="fa-solid fa-circle-check"></i>

        </div>

        <div>

            <span>
                {{ __('education_admin.bookings.confirmed') }}
            </span>

            <strong>
                {{ $statistics['confirmed'] ?? 0 }}
            </strong>

        </div>

    </article>


    {{-- COMPLETED --}}

    <article class="education-admin-booking-stat-card completed">

        <div class="education-admin-booking-stat-icon">

            <i class="fa-solid fa-check-double"></i>

        </div>

        <div>

            <span>
                {{ __('education_admin.bookings.completed') }}
            </span>

            <strong>
                {{ $statistics['completed'] ?? 0 }}
            </strong>

        </div>

    </article>


    {{-- CANCELLED --}}

    <article class="education-admin-booking-stat-card cancelled">

        <div class="education-admin-booking-stat-icon">

            <i class="fa-solid fa-ban"></i>

        </div>

        <div>

            <span>
                {{ __('education_admin.bookings.cancelled') }}
            </span>

            <strong>
                {{ $statistics['cancelled'] ?? 0 }}
            </strong>

        </div>

    </article>

</section>


{{-- ==================================================
    FILTERS
================================================== --}}

<section class="education-admin-bookings-filters">

    <form
        method="GET"
        action="{{ route('education.admin.bookings.index') }}"
        class="education-admin-bookings-filter-form"
    >

        {{-- SEARCH --}}

        <div class="education-admin-filter-group education-admin-filter-search">

            <label>
                {{ __('education_admin.bookings.search') }}
            </label>

            <div class="education-admin-filter-input">

                <i class="fa-solid fa-magnifying-glass"></i>

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="{{ __('education_admin.bookings.search_placeholder') }}"
                >

            </div>

        </div>


        {{-- BOOKING STATUS --}}

        <div class="education-admin-filter-group">

            <label>
                {{ __('education_admin.bookings.booking_status') }}
            </label>

            <div class="education-admin-filter-input">

                <i class="fa-solid fa-filter"></i>

                <select name="status">

                    <option value="">
                        {{ __('education_admin.bookings.all_statuses') }}
                    </option>

                    <option
                        value="pending"
                        @selected(request('status') === 'pending')
                    >
                        {{ __('education_admin.bookings.pending') }}
                    </option>

                    <option
                        value="confirmed"
                        @selected(request('status') === 'confirmed')
                    >
                        {{ __('education_admin.bookings.confirmed') }}
                    </option>

                    <option
                        value="completed"
                        @selected(request('status') === 'completed')
                    >
                        {{ __('education_admin.bookings.completed') }}
                    </option>

                    <option
                        value="cancelled"
                        @selected(request('status') === 'cancelled')
                    >
                        {{ __('education_admin.bookings.cancelled') }}
                    </option>

                    <option
                        value="no_show"
                        @selected(request('status') === 'no_show')
                    >
                        {{ __('education_admin.bookings.no_show') }}
                    </option>

                </select>

            </div>

        </div>


        {{-- PAYMENT STATUS --}}

        <div class="education-admin-filter-group">

            <label>
                {{ __('education_admin.bookings.payment_status') }}
            </label>

            <div class="education-admin-filter-input">

                <i class="fa-solid fa-wallet"></i>

                <select name="payment_status">

                    <option value="">
                        {{ __('education_admin.bookings.all_statuses') }}
                    </option>

                    <option
                        value="unpaid"
                        @selected(request('payment_status') === 'unpaid')
                    >
                        {{ __('education_admin.bookings.unpaid') }}
                    </option>

                    <option
                        value="pending"
                        @selected(request('payment_status') === 'pending')
                    >
                        {{ __('education_admin.bookings.under_review') }}
                    </option>

                    <option
                        value="paid"
                        @selected(request('payment_status') === 'paid')
                    >
                        {{ __('education_admin.bookings.paid') }}
                    </option>

                    <option
                        value="failed"
                        @selected(request('payment_status') === 'failed')
                    >
                        {{ __('education_admin.bookings.payment_failed') }}
                    </option>

                    <option
                        value="refunded"
                        @selected(request('payment_status') === 'refunded')
                    >
                        {{ __('education_admin.bookings.refunded') }}
                    </option>

                </select>

            </div>

        </div>


        {{-- DATE --}}

        <div class="education-admin-filter-group">

            <label>
                {{ __('education_admin.bookings.date') }}
            </label>

            <div class="education-admin-filter-input">

                <i class="fa-regular fa-calendar"></i>

                <input
                    type="date"
                    name="date"
                    value="{{ request('date') }}"
                >

            </div>

        </div>


        {{-- ACTIONS --}}

        <div class="education-admin-filter-actions">

            <button
                type="submit"
                class="education-admin-filter-submit"
            >

                <i class="fa-solid fa-magnifying-glass"></i>

                {{ __('education_admin.bookings.search_button') }}

            </button>


            @if(
                request()->filled('search') ||
                request()->filled('status') ||
                request()->filled('payment_status') ||
                request()->filled('date')
            )

                <a
                    href="{{ route('education.admin.bookings.index') }}"
                    class="education-admin-filter-reset"
                >

                    <i class="fa-solid fa-rotate-left"></i>

                    {{ __('education_admin.bookings.reset') }}

                </a>

            @endif

        </div>

    </form>

</section>


{{-- ==================================================
    BOOKINGS TABLE
================================================== --}}

<section class="education-admin-bookings-card">

    <div class="education-admin-bookings-card-header">

        <div>

            <span>
                {{ __('education_admin.bookings.booking_record') }}
            </span>

            <h3>
                {{ __('education_admin.bookings.all_requests') }}
            </h3>

        </div>

        <div class="education-admin-bookings-count">

            {{ $bookings->total() }}

            <span>
                {{ __('education_admin.bookings.booking_count') }}
            </span>

        </div>

    </div>


    @if($bookings->count())

        <div class="education-admin-bookings-table-wrapper">

            <table class="education-admin-bookings-table">

                <thead>

                    <tr>

                        <th>
                            {{ __('education_admin.bookings.student') }}
                        </th>

                        <th>
                            {{ __('education_admin.bookings.booking_type') }}
                        </th>

                        <th>
                            {{ __('education_admin.bookings.date') }}
                        </th>

                        <th>
                            {{ __('education_admin.bookings.time') }}
                        </th>

                        <th>
                            {{ __('education_admin.bookings.price') }}
                        </th>

                        <th>
                            {{ __('education_admin.bookings.status') }}
                        </th>

                        <th>
                            {{ __('education_admin.bookings.payment') }}
                        </th>

                        <th>
                            {{ __('education_admin.bookings.actions') }}
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @foreach($bookings as $booking)

                        <tr>

                            {{-- ==================================================
                                STUDENT
                            ================================================== --}}

                            <td>

                                <div class="education-admin-booking-student">

                                    <div class="education-admin-booking-student-avatar">

                                        {{ mb_strtoupper(
                                            mb_substr(
                                                $booking->student->name
                                                    ?? __('education_admin.bookings.student_initial'),
                                                0,
                                                1
                                            )
                                        ) }}

                                    </div>


                                    <div>

                                        <strong>
                                            {{ $booking->student->name
                                                ?? __('education_admin.bookings.unknown_student') }}
                                        </strong>

                                        <span>
                                            {{ $booking->student->email ?? '-' }}
                                        </span>

                                    </div>

                                </div>

                            </td>


                            {{-- ==================================================
                                BOOKING TYPE
                            ================================================== --}}

                            <td>

                                <div class="education-admin-booking-lesson">

                                    <strong>

                                        {{ $booking->bookingType->name
                                            ?? $booking->title
                                            ?? __('education_admin.bookings.educational_booking')
                                        }}

                                    </strong>


                                    @if($booking->bookingType)

                                        @if($booking->bookingType->isPackage())

                                            <span>
                                                {{ __('education_admin.bookings.package') }}
                                            </span>

                                        @elseif($booking->bookingType->isSingle())

                                            <span>
                                                {{ __('education_admin.bookings.single_lesson') }}
                                            </span>

                                        @endif

                                    @endif


                                    @if(
                                        isset($booking->total_sessions) &&
                                        $booking->total_sessions > 1
                                    )

                                        <small>

                                            {{ $booking->total_sessions }}

                                            {{ __('education_admin.bookings.sessions') }}

                                        </small>

                                    @endif

                                </div>

                            </td>


                            {{-- ==================================================
                                DATE
                            ================================================== --}}

                            <td>

                                <span class="education-admin-booking-date">

                                    @if($booking->booking_date)

                                        {{ \Carbon\Carbon::parse(
                                            $booking->booking_date
                                        )
                                        ->locale(session('education_locale', 'ar'))
                                        ->translatedFormat('d M Y') }}

                                    @else

                                        -

                                    @endif

                                </span>

                            </td>


                            {{-- ==================================================
                                TIME
                            ================================================== --}}

                            <td>

                                <span class="education-admin-booking-time">

                                    @if($booking->start_time)

                                        {{ \Carbon\Carbon::parse(
                                            $booking->start_time
                                        )->format('H:i') }}

                                    @else

                                        -

                                    @endif


                                    @if($booking->end_time)

                                        <small>
                                            -
                                            {{ \Carbon\Carbon::parse(
                                                $booking->end_time
                                            )->format('H:i') }}
                                        </small>

                                    @endif

                                </span>

                            </td>


                            {{-- ==================================================
                                PRICE
                            ================================================== --}}

                            <td>

                                <strong class="education-admin-booking-price">

                                    {{ $booking->currency ?? 'SAR' }}

                                    {{ number_format(
                                        (float) ($booking->price ?? 0),
                                        2
                                    ) }}

                                </strong>

                            </td>


                            {{-- ==================================================
                                BOOKING STATUS
                            ================================================== --}}

                            <td>

                                @switch($booking->status)

                                    @case('pending')

                                        <span class="education-admin-status pending">

                                            <i class="fa-regular fa-clock"></i>

                                            {{ __('education_admin.bookings.pending') }}

                                        </span>

                                        @break


                                    @case('confirmed')

                                        <span class="education-admin-status confirmed">

                                            <i class="fa-solid fa-circle-check"></i>

                                            {{ __('education_admin.bookings.confirmed') }}

                                        </span>

                                        @break


                                    @case('completed')

                                        <span class="education-admin-status completed">

                                            <i class="fa-solid fa-check-double"></i>

                                            {{ __('education_admin.bookings.completed') }}

                                        </span>

                                        @break


                                    @case('cancelled')

                                        <span class="education-admin-status cancelled">

                                            <i class="fa-solid fa-ban"></i>

                                            {{ __('education_admin.bookings.cancelled') }}

                                        </span>

                                        @break


                                    @case('no_show')

                                        <span class="education-admin-status no-show">

                                            <i class="fa-solid fa-user-xmark"></i>

                                            {{ __('education_admin.bookings.no_show') }}

                                        </span>

                                        @break


                                    @default

                                        <span class="education-admin-status">

                                            {{ $booking->status ?? '-' }}

                                        </span>

                                @endswitch

                            </td>


                            {{-- ==================================================
                                PAYMENT
                            ================================================== --}}

                            <td>

                                @switch($booking->payment_status)

                                    @case('paid')

                                        <span class="education-admin-payment paid">

                                            <i class="fa-solid fa-circle-check"></i>

                                            {{ __('education_admin.bookings.paid') }}

                                        </span>

                                        @break


                                    @case('pending')

                                        <span class="education-admin-payment pending">

                                            <i class="fa-regular fa-clock"></i>

                                            {{ __('education_admin.bookings.under_review') }}

                                        </span>

                                        @break


                                    @case('failed')

                                        <span class="education-admin-payment failed">

                                            <i class="fa-solid fa-circle-xmark"></i>

                                            {{ __('education_admin.bookings.payment_failed_short') }}

                                        </span>

                                        @break


                                    @case('refunded')

                                        <span class="education-admin-payment refunded">

                                            <i class="fa-solid fa-rotate-left"></i>

                                            {{ __('education_admin.bookings.refunded') }}

                                        </span>

                                        @break


                                    @default

                                        <span class="education-admin-payment unpaid">

                                            <i class="fa-solid fa-wallet"></i>

                                            {{ __('education_admin.bookings.unpaid') }}

                                        </span>

                                @endswitch


                                {{-- PAYMENT PROOF STATUS --}}

                                @if($booking->payment)

                                    @if($booking->payment->status === 'submitted')

                                        <small
                                            style="
                                                display:block;
                                                margin-top:5px;
                                                font-size:11px;
                                            "
                                        >

                                            <i class="fa-solid fa-file-arrow-up"></i>

                                            {{ __('education_admin.bookings.proof_uploaded') }}

                                        </small>

                                    @elseif($booking->payment->status === 'under_review')

                                        <small
                                            style="
                                                display:block;
                                                margin-top:5px;
                                                font-size:11px;
                                            "
                                        >

                                            <i class="fa-solid fa-magnifying-glass"></i>

                                            {{ __('education_admin.bookings.under_review') }}

                                        </small>

                                    @elseif($booking->payment->status === 'rejected')

                                        <small
                                            style="
                                                display:block;
                                                margin-top:5px;
                                                font-size:11px;
                                            "
                                        >

                                            <i class="fa-solid fa-triangle-exclamation"></i>

                                            {{ __('education_admin.bookings.rejected') }}

                                        </small>

                                    @elseif($booking->payment->status === 'approved')

                                        <small
                                            style="
                                                display:block;
                                                margin-top:5px;
                                                font-size:11px;
                                            "
                                        >

                                            <i class="fa-solid fa-check"></i>

                                            {{ __('education_admin.bookings.proof_approved') }}

                                        </small>

                                    @endif

                                @endif

                            </td>


                            {{-- ==================================================
                                ACTIONS
                            ================================================== --}}

                            <td>

                                <div class="education-admin-booking-actions">

                                    {{-- DETAILS --}}

                                    <a
                                        href="{{ route(
                                            'education.admin.bookings.show',
                                            $booking
                                        ) }}"
                                        class="education-admin-booking-action details"
                                        title="{{ __('education_admin.bookings.details') }}"
                                    >

                                        <i class="fa-solid fa-eye"></i>

                                    </a>


                                    {{-- ==================================================
                                        CONFIRM
                                    ================================================== --}}

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
                                                class="education-admin-booking-action confirm"
                                                title="{{ __('education_admin.bookings.confirm_booking') }}"
                                                onclick="return confirm('{{ __('education_admin.bookings.confirm_booking_question') }}')"
                                            >

                                                <i class="fa-solid fa-check"></i>

                                            </button>

                                        </form>

                                    @endif


                                    {{-- ==================================================
                                        CANCEL
                                    ================================================== --}}

                                    @if(
                                        !in_array(
                                            $booking->status,
                                            [
                                                'completed',
                                                'cancelled'
                                            ],
                                            true
                                        )
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
                                                class="education-admin-booking-action cancel"
                                                title="{{ __('education_admin.bookings.cancel_booking') }}"
                                                onclick="return confirm('{{ __('education_admin.bookings.cancel_booking_question') }}')"
                                            >

                                                <i class="fa-solid fa-xmark"></i>

                                            </button>

                                        </form>

                                    @endif

                                </div>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>


        {{-- ==================================================
            PAGINATION
        ================================================== --}}

        @if($bookings->hasPages())

            <div class="education-admin-bookings-pagination">

                {{ $bookings->withQueryString()->links() }}

            </div>

        @endif

    @else

        {{-- ==================================================
            EMPTY STATE
        ================================================== --}}

        <div class="education-admin-bookings-empty">

            <div class="education-admin-bookings-empty-icon">

                <i class="fa-regular fa-calendar-xmark"></i>

            </div>

            <h3>
                {{ __('education_admin.bookings.empty_title') }}
            </h3>

            <p>
                {{ __('education_admin.bookings.empty_description') }}
            </p>


            @if(
                request()->filled('search') ||
                request()->filled('status') ||
                request()->filled('payment_status') ||
                request()->filled('date')
            )

                <a
                    href="{{ route('education.admin.bookings.index') }}"
                >

                    {{ __('education_admin.bookings.show_all_bookings') }}

                </a>

            @endif

        </div>

    @endif

</section>

</div>

@endsection
