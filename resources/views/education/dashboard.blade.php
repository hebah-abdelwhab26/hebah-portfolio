@extends('education.layouts.app')

@section('title', __('education.dashboard_page.page_title'))

@section('content')

@include('education.student.partials.navigation')

<div class="education-dashboard">

{{-- ==================================================
    DASHBOARD HEADER
================================================== --}}

<header class="education-dashboard-header">

    <div class="education-dashboard-header-content">

        <span class="education-dashboard-eyebrow">
            {{ __('education.dashboard_page.header.eyebrow') }}
        </span>

        <h1>
            {{ __('education.dashboard_page.header.welcome') }}
            <span>
                {{ $student->name }}
            </span>
        </h1>

        <p>
            {{ __('education.dashboard_page.header.description') }}
        </p>

    </div>

    <div class="education-dashboard-header-actions">

        <a
            href="{{ route('education.index') }}"
            class="education-dashboard-home"
        >
            <i class="fa-solid fa-house"></i>
            {{ __('education.dashboard_page.header.main_website') }}
        </a>

        <form
            method="POST"
            action="{{ route('education.logout') }}"
        >

            @csrf

            <button
                type="submit"
                class="education-dashboard-logout"
            >
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                {{ __('education.dashboard_page.header.logout') }}
            </button>

        </form>

    </div>

</header>


<main class="education-dashboard-main">


    {{-- ==================================================
        WELCOME CARD
    ================================================== --}}

    <section class="education-dashboard-welcome">

        <div class="education-dashboard-welcome-content">

            <span>
                {{ __('education.dashboard_page.welcome.eyebrow') }}
            </span>

            <h2>
                {{ __('education.dashboard_page.welcome.title') }}
                <strong>
                    {{ __('education.dashboard_page.welcome.highlight') }}
                </strong>
            </h2>

            <p>
                {{ __('education.dashboard_page.welcome.description') }}
            </p>

        </div>

        <div class="education-dashboard-welcome-icon">
            <i class="fa-solid fa-feather-pointed"></i>
        </div>

    </section>


    {{-- ==================================================
        STATISTICS
    ================================================== --}}

    <section class="education-dashboard-stats">

        {{-- UPCOMING --}}

        <article class="education-dashboard-stat-card">

            <div class="education-dashboard-stat-icon">
                <i class="fa-regular fa-calendar-days"></i>
            </div>

            <div>

                <span>
                    {{ __('education.dashboard_page.statistics.upcoming') }}
                </span>

                <strong>
                    {{ $upcomingBookings->count() }}
                </strong>

            </div>

        </article>


        {{-- COMPLETED --}}

        <article class="education-dashboard-stat-card">

            <div class="education-dashboard-stat-icon">
                <i class="fa-solid fa-circle-check"></i>
            </div>

            <div>

                <span>
                    {{ __('education.dashboard_page.statistics.completed') }}
                </span>

                <strong>
                    {{ $completedBookings->count() }}
                </strong>

            </div>

        </article>


        {{-- TOTAL --}}

        <article class="education-dashboard-stat-card">

            <div class="education-dashboard-stat-icon">
                <i class="fa-solid fa-book-open"></i>
            </div>

            <div>

                <span>
                    {{ __('education.dashboard_page.statistics.total') }}
                </span>

                <strong>
                    {{ $totalBookings }}
                </strong>

            </div>

        </article>

    </section>


    {{-- ==================================================
        DASHBOARD GRID
    ================================================== --}}

    <div class="education-dashboard-grid">


        {{-- ==================================================
            NEXT LESSON
        ================================================== --}}

        <section class="education-dashboard-card education-dashboard-next-lesson">

            <div class="education-dashboard-card-header">

                <div>

                    <span>
                        {{ __('education.dashboard_page.next_lesson.eyebrow') }}
                    </span>

                    <h2>
                        {{ __('education.dashboard_page.next_lesson.title') }}
                    </h2>

                </div>

                <div class="education-dashboard-card-header-icon">
                    <i class="fa-regular fa-clock"></i>
                </div>

            </div>


            @if($nextBooking)

                <div class="education-dashboard-next-lesson-content">


                    {{-- ICON --}}

                    <div class="education-dashboard-next-lesson-icon">

                        <i class="fa-solid fa-book-quran"></i>

                    </div>


                    {{-- INFO --}}

                    <div class="education-dashboard-next-lesson-info">

                        <span>
                            {{ $nextBooking->bookingType?->name ?? __('education.dashboard_page.fallback.educational_lesson') }}
                        </span>

                        <h3>
                            {{ $nextBooking->title }}
                        </h3>


                        <div class="education-dashboard-next-lesson-meta">

                            {{-- DATE --}}

                            <div>

                                <i class="fa-regular fa-calendar"></i>

                                @if($nextBooking->booking_date)

                                    {{ $nextBooking->booking_date->locale(app()->getLocale())->translatedFormat('l، d F Y') }}

                                @else

                                    {{ __('education.dashboard_page.fallback.not_specified') }}

                                @endif

                            </div>


                            {{-- TIME --}}

                            <div>

                                <i class="fa-regular fa-clock"></i>

                                @if($nextBooking->start_time)

                                    {{ \Carbon\Carbon::parse($nextBooking->start_time)->format('H:i') }}

                                @else

                                    —

                                @endif

                                -

                                @if($nextBooking->end_time)

                                    {{ \Carbon\Carbon::parse($nextBooking->end_time)->format('H:i') }}

                                @else

                                    —

                                @endif

                            </div>

                        </div>

                    </div>


                    {{-- STATUS + DETAILS --}}

                    <div class="education-dashboard-next-lesson-status">

                        @if($nextBooking->status === 'confirmed')

                            <span class="student-booking-status confirmed">

                                <i class="fa-solid fa-circle-check"></i>

                                {{ __('education.dashboard_page.status.confirmed') }}

                            </span>

                        @elseif($nextBooking->status === 'pending')

                            <span class="student-booking-status pending">

                                <i class="fa-regular fa-clock"></i>

                                {{ __('education.dashboard_page.status.pending') }}

                            </span>

                        @elseif($nextBooking->status === 'cancelled')

                            <span class="student-booking-status cancelled">

                                <i class="fa-solid fa-circle-xmark"></i>

                                {{ __('education.dashboard_page.status.cancelled') }}

                            </span>

                        @elseif($nextBooking->status === 'completed')

                            <span class="student-booking-status completed">

                                <i class="fa-solid fa-circle-check"></i>

                                {{ __('education.dashboard_page.status.completed') }}

                            </span>

                        @endif


                        <a
                            href="{{ route('education.booking.show', $nextBooking) }}"
                            class="education-dashboard-booking-view"
                        >

                            {{ __('education.dashboard_page.actions.view_details') }}

                            <i class="fa-solid fa-arrow-left"></i>

                        </a>

                    </div>

                </div>


            @else

                <div class="education-dashboard-empty">

                    <div class="education-dashboard-empty-icon">
                        <i class="fa-regular fa-calendar"></i>
                    </div>

                    <h3>
                        {{ __('education.dashboard_page.next_lesson.empty_title') }}
                    </h3>

                    <p>
                        {{ __('education.dashboard_page.next_lesson.empty_description') }}
                    </p>

                    <a
                        href="{{ route('education.booking.create') }}"
                        class="education-dashboard-primary-button"
                    >

                        {{ __('education.dashboard_page.actions.book_appointment') }}

                        <i class="fa-solid fa-arrow-left"></i>

                    </a>

                </div>

            @endif

        </section>


        {{-- ==================================================
            QUICK ACTIONS
        ================================================== --}}

        <section class="education-dashboard-card education-dashboard-actions-card">

            <div class="education-dashboard-card-header">

                <div>

                    <span>
                        {{ __('education.dashboard_page.quick_actions.eyebrow') }}
                    </span>

                    <h2>
                        {{ __('education.dashboard_page.quick_actions.title') }}
                    </h2>

                </div>

            </div>


            <div class="education-dashboard-actions">


                {{-- BOOK LESSON --}}

                <a
                    href="{{ route('education.booking.create') }}"
                    class="education-dashboard-action"
                >

                    <div class="education-dashboard-action-icon">
                        <i class="fa-regular fa-calendar-plus"></i>
                    </div>

                    <div>

                        <strong>
                            {{ __('education.dashboard_page.quick_actions.book_lesson.title') }}
                        </strong>

                        <span>
                            {{ __('education.dashboard_page.quick_actions.book_lesson.description') }}
                        </span>

                    </div>

                    <i class="fa-solid fa-arrow-left"></i>

                </a>


                {{-- SERVICES --}}

                <a
                    href="{{ route('education.index') }}#services"
                    class="education-dashboard-action"
                >

                    <div class="education-dashboard-action-icon">
                        <i class="fa-solid fa-book-quran"></i>
                    </div>

                    <div>

                        <strong>
                            {{ __('education.dashboard_page.quick_actions.services.title') }}
                        </strong>

                        <span>
                            {{ __('education.dashboard_page.quick_actions.services.description') }}
                        </span>

                    </div>

                    <i class="fa-solid fa-arrow-left"></i>

                </a>


                {{-- CONTACT --}}

                <a
                    href="{{ route('education.index') }}#contact"
                    class="education-dashboard-action"
                >

                    <div class="education-dashboard-action-icon">
                        <i class="fa-regular fa-message"></i>
                    </div>

                    <div>

                        <strong>
                            {{ __('education.dashboard_page.quick_actions.contact.title') }}
                        </strong>

                        <span>
                            {{ __('education.dashboard_page.quick_actions.contact.description') }}
                        </span>

                    </div>

                    <i class="fa-solid fa-arrow-left"></i>

                </a>


                {{-- ==================================================
                    EDUCATION CONVERSATION
                ================================================== --}}

                <a
                    href="{{ route('education.conversations.create') }}"
                    class="education-dashboard-action"
                >

                    <div class="education-dashboard-action-icon">
                        <i class="fa-regular fa-comments"></i>
                    </div>

                    <div>

                        <strong>
                            {{ __('education.dashboard_page.quick_actions.conversation.title') }}
                        </strong>

                        <span>
                            {{ __('education.dashboard_page.quick_actions.conversation.description') }}
                        </span>

                    </div>

                    <i class="fa-solid fa-arrow-left"></i>

                </a>


            </div>

        </section>


        {{-- ==================================================
            UPCOMING BOOKINGS
        ================================================== --}}

        <section class="education-dashboard-card education-dashboard-bookings">

            <div class="education-dashboard-card-header">

                <div>

                    <span>
                        {{ __('education.dashboard_page.bookings.eyebrow') }}
                    </span>

                    <h2>
                        {{ __('education.dashboard_page.bookings.title') }}
                    </h2>

                </div>

            </div>


            @if($upcomingBookings->count())

                <div class="education-dashboard-bookings-list">

                    @foreach($upcomingBookings->take(5) as $booking)

                        <article class="education-dashboard-booking-item">


                            {{-- DATE --}}

                            <div class="education-dashboard-booking-date">

                                @if($booking->booking_date)

                                    <strong>
                                        {{ $booking->booking_date->format('d') }}
                                    </strong>

                                    <span>
                                        {{ $booking->booking_date->locale(app()->getLocale())->translatedFormat('M') }}
                                    </span>

                                @else

                                    <strong>
                                        —
                                    </strong>

                                    <span>
                                        —
                                    </span>

                                @endif

                            </div>


                            {{-- INFO --}}

                            <div class="education-dashboard-booking-info">

                                <strong>
                                    {{ $booking->title }}
                                </strong>

                                <span>

                                    @if($booking->booking_date)

                                        {{ $booking->booking_date->locale(app()->getLocale())->translatedFormat('l') }}

                                    @else

                                        {{ __('education.dashboard_page.fallback.date_not_specified') }}

                                    @endif

                                    ·

                                    @if($booking->start_time)

                                        {{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }}

                                    @else

                                        —

                                    @endif

                                    -

                                    @if($booking->end_time)

                                        {{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }}

                                    @else

                                        —

                                    @endif

                                </span>

                            </div>


                            {{-- STATUS --}}

                            <div class="education-dashboard-booking-status">

                                @if($booking->status === 'confirmed')

                                    <span class="student-booking-status confirmed">

                                        <i class="fa-solid fa-circle-check"></i>

                                        {{ __('education.dashboard_page.status.confirmed') }}

                                    </span>

                                @elseif($booking->status === 'pending')

                                    <span class="student-booking-status pending">

                                        <i class="fa-regular fa-clock"></i>

                                        {{ __('education.dashboard_page.status.review') }}

                                    </span>

                                @elseif($booking->status === 'cancelled')

                                    <span class="student-booking-status cancelled">

                                        <i class="fa-solid fa-circle-xmark"></i>

                                        {{ __('education.dashboard_page.status.cancelled') }}

                                    </span>

                                @elseif($booking->status === 'completed')

                                    <span class="student-booking-status completed">

                                        <i class="fa-solid fa-circle-check"></i>

                                        {{ __('education.dashboard_page.status.completed') }}

                                    </span>

                                @endif


                                <a
                                    href="{{ route('education.booking.show', $booking) }}"
                                    class="education-dashboard-booking-view"
                                >

                                    {{ __('education.dashboard_page.actions.view_details') }}

                                    <i class="fa-solid fa-arrow-left"></i>

                                </a>

                            </div>

                        </article>

                    @endforeach

                </div>


            @else

                <div class="education-dashboard-empty education-dashboard-empty-small">

                    <div class="education-dashboard-empty-icon">
                        <i class="fa-solid fa-book-open-reader"></i>
                    </div>

                    <h3>
                        {{ __('education.dashboard_page.bookings.empty_title') }}
                    </h3>

                    <p>
                        {{ __('education.dashboard_page.bookings.empty_description') }}
                    </p>

                    <a
                        href="{{ route('education.booking.create') }}"
                        class="education-dashboard-primary-button"
                    >

                        {{ __('education.dashboard_page.actions.book_lesson') }}

                        <i class="fa-solid fa-arrow-left"></i>

                    </a>

                </div>

            @endif

        </section>


        {{-- ==================================================
            RECENT / COMPLETED LESSONS
        ================================================== --}}

        <section class="education-dashboard-card education-dashboard-recent">

            <div class="education-dashboard-card-header">

                <div>

                    <span>
                        {{ __('education.dashboard_page.recent.eyebrow') }}
                    </span>

                    <h2>
                        {{ __('education.dashboard_page.recent.title') }}
                    </h2>

                </div>

            </div>


            @if($completedBookings->count())

                <div class="education-dashboard-bookings-list">

                    @foreach($completedBookings->take(5) as $booking)

                        <article class="education-dashboard-booking-item">


                            {{-- COMPLETED ICON --}}

                            <div class="education-dashboard-booking-date completed">

                                <i class="fa-solid fa-check"></i>

                            </div>


                            {{-- INFO --}}

                            <div class="education-dashboard-booking-info">

                                <strong>
                                    {{ $booking->title }}
                                </strong>

                                <span>

                                    @if($booking->booking_date)

                                        {{ $booking->booking_date->locale(app()->getLocale())->translatedFormat('l، d F Y') }}

                                    @else

                                        {{ __('education.dashboard_page.fallback.date_not_specified') }}

                                    @endif

                                </span>

                            </div>


                            {{-- STATUS --}}

                            <div class="education-dashboard-booking-status">

                                <span class="student-booking-status completed">

                                    <i class="fa-solid fa-circle-check"></i>

                                    {{ __('education.dashboard_page.status.completed') }}

                                </span>


                                <a
                                    href="{{ route('education.booking.show', $booking) }}"
                                    class="education-dashboard-booking-view"
                                >

                                    {{ __('education.dashboard_page.actions.view_details') }}

                                    <i class="fa-solid fa-arrow-left"></i>

                                </a>

                            </div>

                        </article>

                    @endforeach

                </div>


            @else

                <div class="education-dashboard-empty education-dashboard-empty-small">

                    <div class="education-dashboard-empty-icon">

                        <i class="fa-solid fa-clock-rotate-left"></i>

                    </div>

                    <h3>
                        {{ __('education.dashboard_page.recent.empty_title') }}
                    </h3>

                    <p>
                        {{ __('education.dashboard_page.recent.empty_description') }}
                    </p>

                </div>

            @endif

        </section>


    </div>

</main>
</div>

@endsection
