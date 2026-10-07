
@extends('education.layouts.app')

@section('title', __('education.booking_page.page_title'))

@section('content')

<div class="education-booking-page">

<div class="education-booking-container">

    {{-- ==========================================================
        PAGE HEADER
    =========================================================== --}}

    <header class="education-booking-header">

        <span class="education-booking-badge">
            {{ __('education.booking_page.header.badge') }}
        </span>

        <h1>
            {{ __('education.booking_page.header.title') }}
            <span>{{ __('education.booking_page.header.title_highlight') }}</span>
        </h1>

        <p>
            {{ __('education.booking_page.header.description') }}
        </p>

    </header>


    {{-- ==========================================================
        VALIDATION ERRORS
    =========================================================== --}}

    @if($errors->any())

        <div class="education-booking-alert education-booking-alert-error">

            <i class="fa-solid fa-circle-exclamation"></i>

            <div>

                <strong>
                    {{ __('education.booking_page.errors.title') }}
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


    {{-- ==========================================================
        STEP 1 - BOOKING TYPE
    =========================================================== --}}

    <section class="education-booking-card">

        <div class="education-booking-card-header">

            <div>

                <span>
                    {{ __('education.booking_page.steps.first') }}
                </span>

                <h2>
                    {{ __('education.booking_page.booking_type.title') }}
                </h2>

            </div>

            <div class="education-booking-card-icon">

                <i class="fa-solid fa-layer-group"></i>

            </div>

        </div>


        @if($bookingTypes->count())

            <div class="education-booking-types">

                @foreach($bookingTypes as $type)

                    <button
                        type="button"
                        class="education-booking-type"
                        data-booking-type-id="{{ $type->id }}"
                        data-booking-type-name="{{ $type->name }}"
                        data-booking-type-description="{{ $type->description }}"
                        data-booking-type-sessions="{{ $type->sessions_count ?? 1 }}"
                        data-booking-type-price="{{ $type->price }}"
                        data-booking-type-currency="{{ $type->currency ?? 'SAR' }}"
                    >

                        <span class="education-booking-type-check">
                            <i class="fa-solid fa-check"></i>
                        </span>

                        <span class="education-booking-type-icon">
                            <i class="fa-solid fa-graduation-cap"></i>
                        </span>

                        <span class="education-booking-type-content">

                            <strong>
                                {{ $type->name }}
                            </strong>

                            @if($type->description)

                                <small>
                                    {{ $type->description }}
                                </small>

                            @endif

                            @if(!empty($type->sessions_count))

                                <span>
                                    {{ __('education.booking_page.booking_type.sessions', [
                                        'count' => $type->sessions_count
                                    ]) }}
                                </span>

                            @endif

                        </span>

                        <span class="education-booking-type-price">

                            {{ $type->currency ?? 'SAR' }}

                            {{ number_format($type->price ?? 0, 2) }}

                        </span>

                        <i class="fa-solid fa-chevron-left education-booking-type-arrow"></i>

                    </button>

                @endforeach

            </div>

        @else

            <div class="education-booking-empty">

                <div class="education-booking-empty-icon">
                    <i class="fa-solid fa-layer-group"></i>
                </div>

                <h3>
                    {{ __('education.booking_page.booking_type.empty_title') }}
                </h3>

                <p>
                    {{ __('education.booking_page.booking_type.empty_description') }}
                </p>

            </div>

        @endif

    </section>


    {{-- ==========================================================
        STEP 2 - DATE
    =========================================================== --}}

    @if($bookingTypes->count())

        <section class="education-booking-card">

            <div class="education-booking-card-header">

                <div>

                    <span>
                        {{ __('education.booking_page.steps.second') }}
                    </span>

                    <h2>
                        {{ __('education.booking_page.date.title') }}
                    </h2>

                </div>

                <div class="education-booking-card-icon">

                    <i class="fa-regular fa-calendar-days"></i>

                </div>

            </div>


            <form
                method="GET"
                action="{{ route('education.booking.create') }}"
                id="education-date-form"
            >

                {{-- Keep selected booking type --}}

                <input
                    type="hidden"
                    name="booking_type"
                    id="education-booking-type-input"
                    value="{{ request('booking_type') }}"
                >


                <input
                    type="date"
                    name="date"
                    id="education-booking-date"
                    value="{{ $selectedDate }}"
                    min="{{ now()->format('Y-m-d') }}"
                    class="education-hidden-date-input"
                >


                <button
                    type="button"
                    id="education-date-picker"
                    class="education-date-picker {{ $selectedDate ? 'has-date' : '' }}"
                >

                    <span class="education-date-picker-icon">

                        <i class="fa-regular fa-calendar-days"></i>

                    </span>


                    <span class="education-date-picker-content">

                        <span class="education-date-picker-label">
                            {{ __('education.booking_page.date.label') }}
                        </span>


                        <strong id="education-selected-date">

                            @if($selectedDate)

                                {{ \Carbon\Carbon::parse($selectedDate)
                                    ->locale(app()->getLocale())
                                    ->translatedFormat('l') }}

                            @else

                                {{ __('education.booking_page.date.choose_date') }}

                            @endif

                        </strong>


                        <small id="education-selected-date-full">

                            @if($selectedDate)

                                {{ \Carbon\Carbon::parse($selectedDate)
                                    ->locale(app()->getLocale())
                                    ->translatedFormat('d F Y') }}

                            @else

                                {{ __('education.booking_page.date.choose_day') }}

                            @endif

                        </small>

                    </span>


                    <span class="education-date-picker-action">

                        <span>
                            {{ __('education.booking_page.date.choose_action') }}
                        </span>

                        <i class="fa-solid fa-chevron-left"></i>

                    </span>

                </button>

            </form>

        </section>

    @endif


    {{-- ==========================================================
        STEP 3 - AVAILABLE TIMES
    =========================================================== --}}

    @if($selectedDate)

        <section class="education-booking-card">

            <div class="education-booking-card-header">

                <div>

                    <span>
                        {{ __('education.booking_page.steps.third') }}
                    </span>

                    <h2>
                        {{ __('education.booking_page.times.title') }}
                    </h2>

                </div>

                <div class="education-booking-card-icon">

                    <i class="fa-regular fa-clock"></i>

                </div>

            </div>


            @if($availabilities->count())

                <div class="education-booking-times">

                    @foreach($availabilities as $availability)

                        <button
                            type="button"
                            class="education-booking-time"
                            data-start="{{ substr($availability->start_time, 0, 5) }}"
                            data-end="{{ substr($availability->end_time, 0, 5) }}"
                        >

                            <span class="education-booking-time-icon">

                                <i class="fa-regular fa-clock"></i>

                            </span>


                            <span class="education-booking-time-text">

                                {{ substr($availability->start_time, 0, 5) }}

                                <small>
                                    -
                                    {{ substr($availability->end_time, 0, 5) }}
                                </small>

                            </span>


                            <span class="education-booking-time-check">

                                <i class="fa-solid fa-check"></i>

                            </span>

                        </button>

                    @endforeach

                </div>

            @else

                <div class="education-booking-empty">

                    <div class="education-booking-empty-icon">

                        <i class="fa-regular fa-calendar-xmark"></i>

                    </div>

                    <h3>
                        {{ __('education.booking_page.times.empty_title') }}
                    </h3>

                    <p>
                        {{ __('education.booking_page.times.empty_description') }}
                    </p>

                </div>

            @endif

        </section>

    @endif


    {{-- ==========================================================
        STEP 4 - BOOKING CONFIRMATION
    =========================================================== --}}

    @if($selectedDate && $availabilities->count() && $bookingTypes->count())

        <section
            class="education-booking-card education-booking-form-card"
            id="education-booking-form-card"
        >

            <div class="education-booking-card-header">

                <div>

                    <span>
                        {{ __('education.booking_page.steps.fourth') }}
                    </span>

                    <h2>
                        {{ __('education.booking_page.confirmation.title') }}
                    </h2>

                </div>

                <div class="education-booking-card-icon">

                    <i class="fa-solid fa-check-double"></i>

                </div>

            </div>


            <form
                method="POST"
                action="{{ route('education.booking.store') }}"
                class="education-booking-form"
                id="education-booking-form"
            >

                @csrf


                {{-- ==================================================
                    HIDDEN VALUES
                =================================================== --}}

                <input
                    type="hidden"
                    name="education_booking_type_id"
                    id="selected-booking-type-id"
                    value="{{ request('booking_type') }}"
                >

                <input
                    type="hidden"
                    name="booking_date"
                    id="selected-booking-date"
                    value="{{ $selectedDate }}"
                >

                <input
                    type="hidden"
                    name="start_time"
                    id="selected-start-time"
                    value=""
                >

                <input
                    type="hidden"
                    name="end_time"
                    id="selected-end-time"
                    value=""
                >


                {{-- ==================================================
                    SUMMARY
                =================================================== --}}

                <div class="education-booking-summary">


                    {{-- BOOKING TYPE --}}

                    <div class="education-booking-summary-item">

                        <span class="education-booking-summary-icon">

                            <i class="fa-solid fa-layer-group"></i>

                        </span>

                        <div>

                            <span>
                                {{ __('education.booking_page.confirmation.summary.booking_type') }}
                            </span>

                            <strong id="selected-booking-type-text">
                                {{ __('education.booking_page.confirmation.summary.booking_type_empty') }}
                            </strong>

                            <small id="selected-booking-type-details">
                                -
                            </small>

                        </div>

                    </div>


                    {{-- DATE --}}

                    <div class="education-booking-summary-item">

                        <span class="education-booking-summary-icon">

                            <i class="fa-regular fa-calendar-check"></i>

                        </span>

                        <div>

                            <span>
                                {{ __('education.booking_page.confirmation.summary.date') }}
                            </span>

                            <strong id="selected-booking-date-text">

                                {{ \Carbon\Carbon::parse($selectedDate)
                                    ->locale(app()->getLocale())
                                    ->translatedFormat('l d F Y') }}

                            </strong>

                        </div>

                    </div>


                    {{-- TIME --}}

                    <div class="education-booking-summary-item">

                        <span class="education-booking-summary-icon">

                            <i class="fa-regular fa-clock"></i>

                        </span>

                        <div>

                            <span>
                                {{ __('education.booking_page.confirmation.summary.time') }}
                            </span>

                            <strong id="selected-time-text">
                                {{ __('education.booking_page.confirmation.summary.time_empty') }}
                            </strong>

                        </div>

                    </div>

                </div>


                {{-- ==================================================
                    NOTE
                =================================================== --}}

                <div class="education-form-group">

                    <label for="student_note">
                        {{ __('education.booking_page.confirmation.note.label') }}
                    </label>

                    <textarea
                        name="student_note"
                        id="student_note"
                        rows="4"
                        placeholder="{{ __('education.booking_page.confirmation.note.placeholder') }}"
                    >{{ old('student_note') }}</textarea>

                </div>


                {{-- ==================================================
                    SUBMIT
                =================================================== --}}

                <button
                    type="submit"
                    class="education-booking-submit"
                    id="education-booking-submit"
                >

                    <span>
                        {{ __('education.booking_page.confirmation.submit') }}
                    </span>

                    <i class="fa-solid fa-arrow-left"></i>

                </button>

            </form>

        </section>

    @endif

</div>

</div>


{{-- ================================================================
PAGE CSS
================================================================ --}}

@push('styles')

<link
    rel="stylesheet"
    href="{{ asset('css/education/education-booking.css') }}"
>

@endpush


{{-- ================================================================
PAGE JS
================================================================ --}}

@push('scripts')

<script
    src="{{ asset('js/education/education-booking.js') }}"
    defer
></script>

@endpush

@endsection

