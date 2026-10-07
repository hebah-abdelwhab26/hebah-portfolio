@extends('education.admin.layouts.app')

@section('title', __('education_admin.dashboard.title'))

@section('content')

@php

 /*                                                                         |
| -------------------------------------------------------------------------- |
| STATUS CONFIGURATION                                                       |
| -------------------------------------------------------------------------- |
| */                                                                        

$statusClasses = [
'pending'   => 'warning',
'confirmed' => 'success',
'completed' => 'info',
'cancelled' => 'danger',
'no_show'   => 'muted',
];

$statusLabels = [
'pending'   => __('education_admin.dashboard.status.pending'),
'confirmed' => __('education_admin.dashboard.status.confirmed'),
'completed' => __('education_admin.dashboard.status.completed'),
'cancelled' => __('education_admin.dashboard.status.cancelled'),
'no_show'   => __('education_admin.dashboard.status.no_show'),
];

@endphp

<div class="education-admin-dashboard">

{{-- ==========================================================
PAGE HEADER
=========================================================== --}}

<section class="education-admin-dashboard-header">

<div class="education-admin-dashboard-heading">

    <span class="education-admin-page-badge">

        <i class="fa-solid fa-chart-line"></i>

        {{ __('education_admin.dashboard.admin_panel') }}

    </span>


    <h1>
        {{ __('education_admin.dashboard.welcome') }}
    </h1>


    <p>
        {{ __('education_admin.dashboard.description') }}
    </p>

</div>


<div class="education-admin-dashboard-date">

    <div class="education-admin-dashboard-date-icon">

        <i class="fa-regular fa-calendar"></i>

    </div>


    <div>

        <span>
            {{ __('education_admin.dashboard.today') }}
        </span>

        <strong>
            {{ now()->translatedFormat('l، d F Y') }}
        </strong>

    </div>

</div>

</section>

{{-- ==========================================================
STATISTICS
=========================================================== --}}

<section class="education-admin-stats-grid">

{{-- ======================================================
    STUDENTS
======================================================= --}}

<div class="education-admin-stat-card">

    <div class="education-admin-stat-top">

        <div class="education-admin-stat-icon students">

            <i class="fa-solid fa-users"></i>

        </div>


        <span class="education-admin-stat-label">
            {{ __('education_admin.dashboard.students') }}
        </span>

    </div>


    <div class="education-admin-stat-bottom">

        <strong>
            {{ $studentsCount }}
        </strong>

        <span>
            {{ __('education_admin.dashboard.total_students') }}
        </span>

    </div>

</div>



{{-- ======================================================
    BOOKINGS
======================================================= --}}

<div class="education-admin-stat-card">

    <div class="education-admin-stat-top">

        <div class="education-admin-stat-icon bookings">

            <i class="fa-solid fa-calendar-check"></i>

        </div>


        <span class="education-admin-stat-label">
            {{ __('education_admin.dashboard.bookings') }}
        </span>

    </div>


    <div class="education-admin-stat-bottom">

        <strong>
            {{ $bookingsCount }}
        </strong>

        <span>
            {{ __('education_admin.dashboard.total_bookings') }}
        </span>

    </div>

</div>



{{-- ======================================================
    PENDING BOOKINGS
======================================================= --}}

<div class="education-admin-stat-card">

    <div class="education-admin-stat-top">

        <div class="education-admin-stat-icon pending">

            <i class="fa-regular fa-clock"></i>

        </div>


        <span class="education-admin-stat-label">
            {{ __('education_admin.dashboard.review') }}
        </span>

    </div>


    <div class="education-admin-stat-bottom">

        <strong>
            {{ $pendingBookingsCount }}
        </strong>

        <span>
            {{ __('education_admin.dashboard.pending_bookings') }}
        </span>

    </div>

</div>



{{-- ======================================================
    STUDENT LESSONS
======================================================= --}}

<div class="education-admin-stat-card">

    <div class="education-admin-stat-top">

        <div class="education-admin-stat-icon lessons">

            <i class="fa-solid fa-book-open"></i>

        </div>


        <span class="education-admin-stat-label">
            {{ __('education_admin.dashboard.student_lessons') }}
        </span>

    </div>


    <div class="education-admin-stat-bottom">

        <strong>
            {{ $activeLessonsCount }}
        </strong>

        <span>
            {{ __('education_admin.dashboard.active_lessons') }}
        </span>

    </div>

</div>


</section>

{{-- ==========================================================
MAIN DASHBOARD GRID
=========================================================== --}}

<section class="education-admin-dashboard-main-grid">


{{-- ======================================================
    RECENT BOOKINGS
======================================================= --}}

<div class="education-admin-panel education-admin-recent-panel">


    <div class="education-admin-panel-header">

        <div class="education-admin-panel-heading">

            <span class="education-admin-panel-eyebrow">

                <i class="fa-solid fa-calendar-days"></i>

                {{ __('education_admin.dashboard.bookings') }}

            </span>


            <h2>
                {{ __('education_admin.dashboard.recent_bookings') }}
            </h2>

        </div>


        <a
            href="{{ route('education.admin.bookings.index') }}"
            class="education-admin-panel-link">

            <span>
                {{ __('education_admin.dashboard.view_all') }}
            </span>

            <i class="fa-solid fa-arrow-left"></i>

        </a>

    </div>



    @if($recentBookings->isNotEmpty())


        <div class="education-admin-recent-bookings">


            @foreach($recentBookings as $booking)


                <div class="education-admin-booking-row">


                    {{-- ==================================================
                        STUDENT AVATAR
                    ================================================== --}}

                    <div class="education-admin-booking-avatar">

                        @if($booking->student?->avatar)

                            <img
                                src="{{ $booking->student->avatar_url ?? asset('images/default-avatar.png') }}"
                                alt="{{ $booking->student->name ?? __('education_admin.dashboard.student') }}">

                        @else

                            <span>

                                {{ mb_strtoupper(
                                    mb_substr(
                                        $booking->student?->name ?? __('education_admin.dashboard.student'),
                                        0,
                                        1
                                    )
                                ) }}

                            </span>

                        @endif

                    </div>



                    {{-- ==================================================
                        BOOKING INFORMATION
                    ================================================== --}}

                    <div class="education-admin-booking-info">

                        <strong>

                            {{ $booking->student?->name ?? __('education_admin.dashboard.student') }}

                        </strong>


                        <span>

                            {{ $booking->title
                                ?? $booking->bookingType?->name
                                ?? __('education_admin.dashboard.educational_booking')
                            }}

                        </span>

                    </div>



                    {{-- ==================================================
                        DATE & TIME
                    ================================================== --}}

                    <div class="education-admin-booking-date">

                        <strong>

                            {{ $booking->booking_date?->translatedFormat('d M Y') }}

                        </strong>


                        <span>

                            {{ substr($booking->start_time ?? '00:00', 0, 5) }}

                            -

                            {{ substr($booking->end_time ?? '00:00', 0, 5) }}

                        </span>

                    </div>



                    {{-- ==================================================
                        STATUS
                    ================================================== --}}

                    <div class="education-admin-booking-status">

                        <span
                            class="education-admin-status {{ $statusClasses[$booking->status] ?? 'muted' }}">

                            {{ $statusLabels[$booking->status] ?? $booking->status }}

                        </span>

                    </div>


                </div>


            @endforeach


        </div>


    @else


        <div class="education-admin-empty">

            <div class="education-admin-empty-icon">

                <i class="fa-regular fa-calendar-xmark"></i>

            </div>


            <h3>
                {{ __('education_admin.dashboard.no_bookings') }}
            </h3>


            <p>
                {{ __('education_admin.dashboard.new_bookings_here') }}
            </p>

        </div>


    @endif


</div>



{{-- ======================================================
    QUICK ACTIONS
======================================================= --}}

<div class="education-admin-panel education-admin-actions-panel">


    <div class="education-admin-panel-header">

        <div class="education-admin-panel-heading">

            <span class="education-admin-panel-eyebrow">

                <i class="fa-solid fa-bolt"></i>

                {{ __('education_admin.dashboard.shortcuts') }}

            </span>


            <h2>
                {{ __('education_admin.dashboard.quick_actions') }}
            </h2>

        </div>

    </div>



    <div class="education-admin-quick-actions">


        {{-- ==================================================
            BOOKINGS
        ================================================== --}}

        <a
            href="{{ route('education.admin.bookings.index') }}"
            class="education-admin-quick-action">

            <span class="education-admin-quick-icon bookings">

                <i class="fa-solid fa-calendar-check"></i>

            </span>


            <span class="education-admin-quick-content">

                <strong>
                    {{ __('education_admin.dashboard.manage_bookings') }}
                </strong>

                <small>
                    {{ __('education_admin.dashboard.manage_bookings_description') }}
                </small>

            </span>


            <i class="fa-solid fa-arrow-left education-admin-quick-arrow"></i>

        </a>



        {{-- ==================================================
            STUDENT LESSONS
        ================================================== --}}

        <a
            href="{{ route('education.admin.student-lessons.index') }}"
            class="education-admin-quick-action">

            <span class="education-admin-quick-icon lessons">

                <i class="fa-solid fa-book-open"></i>

            </span>


            <span class="education-admin-quick-content">

                <strong>
                    {{ __('education_admin.dashboard.student_lessons') }}
                </strong>

                <small>
                    {{ __('education_admin.dashboard.manage_student_lessons_description') }}
                </small>

            </span>


            <i class="fa-solid fa-arrow-left education-admin-quick-arrow"></i>

        </a>



        {{-- ==================================================
            EDUCATION WEBSITE
        ================================================== --}}

        <a
            href="{{ route('education.index') }}"
            target="_blank"
            rel="noopener"
            class="education-admin-quick-action">

            <span class="education-admin-quick-icon website">

                <i class="fa-solid fa-globe"></i>

            </span>


            <span class="education-admin-quick-content">

                <strong>
                    {{ __('education_admin.dashboard.education_website') }}
                </strong>

                <small>
                    {{ __('education_admin.dashboard.open_website') }}
                </small>

            </span>


            <i class="fa-solid fa-arrow-left education-admin-quick-arrow"></i>

        </a>


    </div>


</div>


</section>

{{-- ==========================================================
UPCOMING BOOKINGS
=========================================================== --}}

<section class="education-admin-panel education-admin-upcoming-panel">


<div class="education-admin-panel-header">

    <div class="education-admin-panel-heading">

        <span class="education-admin-panel-eyebrow">

            <i class="fa-regular fa-clock"></i>

            {{ __('education_admin.dashboard.appointments') }}

        </span>


        <h2>
            {{ __('education_admin.dashboard.upcoming_bookings') }}
        </h2>

    </div>


    <span class="education-admin-upcoming-count">

        {{ $upcomingBookings->count() }}

        {{ __('education_admin.dashboard.appointments_count') }}

    </span>

</div>



@if($upcomingBookings->isNotEmpty())


    <div class="education-admin-upcoming-list">


        @foreach($upcomingBookings as $booking)


            <div class="education-admin-upcoming-card">


                {{-- ==================================================
                    DATE
                ================================================== --}}

                <div class="education-admin-upcoming-date">

                    <span>

                        {{ $booking->booking_date?->translatedFormat('M') }}

                    </span>


                    <strong>

                        {{ $booking->booking_date?->format('d') }}

                    </strong>


                    <small>

                        {{ $booking->booking_date?->translatedFormat('l') }}

                    </small>

                </div>



                {{-- ==================================================
                    BOOKING INFORMATION
                ================================================== --}}

                <div class="education-admin-upcoming-info">

                    <strong>

                        {{ $booking->title
                            ?? $booking->bookingType?->name
                            ?? __('education_admin.dashboard.educational_booking')
                        }}

                    </strong>


                    <span>

                        <i class="fa-regular fa-user"></i>

                        {{ $booking->student?->name ?? __('education_admin.dashboard.student') }}

                    </span>

                </div>



                {{-- ==================================================
                    TIME
                ================================================== --}}

                <div class="education-admin-upcoming-time">

                    <i class="fa-regular fa-clock"></i>


                    <span>

                        {{ substr($booking->start_time ?? '00:00', 0, 5) }}

                    </span>


                    <b>
                        —
                    </b>


                    <span>

                        {{ substr($booking->end_time ?? '00:00', 0, 5) }}

                    </span>

                </div>



                {{-- ==================================================
                    STATUS
                ================================================== --}}

                <span
                    class="education-admin-status {{ $statusClasses[$booking->status] ?? 'muted' }}">

                    {{ $statusLabels[$booking->status] ?? $booking->status }}

                </span>


            </div>


        @endforeach


    </div>


@else


    <div class="education-admin-empty">

        <div class="education-admin-empty-icon">

            <i class="fa-regular fa-calendar"></i>

        </div>


        <h3>
            {{ __('education_admin.dashboard.no_upcoming_bookings') }}
        </h3>


        <p>
            {{ __('education_admin.dashboard.upcoming_bookings_here') }}
        </p>

    </div>


@endif


</section>

</div>

@endsection
