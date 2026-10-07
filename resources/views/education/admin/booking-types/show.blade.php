@extends('education.admin.layouts.app')

@section('title', __('education_admin.booking_type_show.page_title'))

@push('styles')

<style>

    /* =========================================================
       BOOKING TYPE SHOW
    ========================================================= */

    .booking-type-show-page {
        width: 100%;
        max-width: 1250px;
        margin: 0 auto;
    }


    /* =========================================================
       HEADER
    ========================================================= */

    .booking-type-show-header {
        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 20px;

        margin-bottom: 25px;
        padding: 28px 30px;

        background:
            linear-gradient(
                135deg,
                #fffdf7 0%,
                #f7f0dd 100%
            );

        border: 1px solid #e8dcc0;

        border-radius: 18px;

        box-shadow:
            0 8px 28px rgba(79, 96, 66, 0.08);
    }


    .booking-type-show-title {
        display: flex;
        align-items: center;

        gap: 17px;
    }


    .booking-type-show-icon {
        width: 64px;
        height: 64px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 17px;

        background: #d4af37;
        color: #fff;

        font-size: 24px;

        box-shadow:
            0 8px 20px rgba(212,175,55,.22);
    }


    .booking-type-show-title h1 {
        margin: 0 0 5px;

        color: #3f4f36;

        font-family: 'Cairo', sans-serif;

        font-size: 25px;
        font-weight: 700;
    }


    .booking-type-show-title p {
        margin: 0;

        color: #888576;

        font-family: 'Cairo', sans-serif;

        font-size: 13px;
    }


    .booking-type-show-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }


    .booking-type-show-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        gap: 8px;

        padding: 11px 17px;

        border-radius: 10px;

        text-decoration: none;

        font-family: 'Cairo', sans-serif;

        font-size: 13px;
        font-weight: 700;

        transition: .2s ease;
    }


    .booking-type-show-btn.edit {
        background: #4f6042;
        color: #fff;
    }


    .booking-type-show-btn.edit:hover {
        background: #3f4f36;
        color: #fff;
        transform: translateY(-1px);
    }


    .booking-type-show-btn.back {
        background: #eee8d8;
        color: #5a604e;
    }


    .booking-type-show-btn.back:hover {
        background: #e2d9c0;
        color: #4f6042;
    }


    /* =========================================================
       MAIN GRID
    ========================================================= */

    .booking-type-show-grid {
        display: grid;

        grid-template-columns:
            minmax(0, 1.4fr)
            minmax(280px, .6fr);

        gap: 22px;
    }


    /* =========================================================
       CARD
    ========================================================= */

    .booking-type-show-card {
        background: #fffdf8;

        border: 1px solid #e8dcc0;

        border-radius: 18px;

        overflow: hidden;

        box-shadow:
            0 8px 28px rgba(79, 96, 66, 0.07);
    }


    .booking-type-show-card-header {
        padding: 19px 24px;

        background: #f8f1df;

        border-bottom: 1px solid #e8dcc0;
    }


    .booking-type-show-card-header h2 {
        margin: 0;

        color: #4f6042;

        font-family: 'Cairo', sans-serif;

        font-size: 17px;
        font-weight: 700;
    }


    .booking-type-show-card-body {
        padding: 25px;
    }


    /* =========================================================
       DESCRIPTION
    ========================================================= */

    .booking-type-description {
        color: #5f6157;

        font-family: 'Cairo', sans-serif;

        font-size: 15px;

        line-height: 2;

        white-space: pre-line;
    }


    .booking-type-empty {
        color: #999487;

        font-family: 'Cairo', sans-serif;

        font-size: 14px;
    }


    /* =========================================================
       INFORMATION LIST
    ========================================================= */

    .booking-type-info-list {
        display: grid;

        grid-template-columns:
            repeat(2, minmax(0, 1fr));

        gap: 15px;
    }


    .booking-type-info-item {
        padding: 16px;

        background: #faf7ee;

        border: 1px solid #ebe2ce;

        border-radius: 12px;
    }


    .booking-type-info-label {
        display: flex;
        align-items: center;

        gap: 7px;

        margin-bottom: 7px;

        color: #8b897d;

        font-family: 'Cairo', sans-serif;

        font-size: 12px;
    }


    .booking-type-info-label i {
        color: #c09a2d;
    }


    .booking-type-info-value {
        color: #3f4f36;

        font-family: 'Cairo', sans-serif;

        font-size: 15px;
        font-weight: 700;

        word-break: break-word;
    }


    /* =========================================================
       STATUS
    ========================================================= */

    .booking-type-status {
        display: inline-flex;
        align-items: center;

        gap: 7px;

        padding: 6px 11px;

        border-radius: 20px;

        font-family: 'Cairo', sans-serif;

        font-size: 12px;
        font-weight: 700;
    }


    .booking-type-status.active {
        background: #e9f4e9;
        color: #3d7045;
    }


    .booking-type-status.inactive {
        background: #f6e9e6;
        color: #8d4b43;
    }


    /* =========================================================
       SIDE STAT
    ========================================================= */

    .booking-type-stat {
        text-align: center;

        padding: 30px 20px;

        background:
            linear-gradient(
                145deg,
                #4f6042,
                #647651
            );

        color: #fff;

        border-radius: 15px;

        margin-bottom: 18px;
    }


    .booking-type-stat-icon {
        width: 52px;
        height: 52px;

        display: flex;
        align-items: center;
        justify-content: center;

        margin: 0 auto 13px;

        border-radius: 50%;

        background: rgba(255,255,255,.13);

        font-size: 20px;
    }


    .booking-type-stat-number {
        display: block;

        font-family: 'Cairo', sans-serif;

        font-size: 34px;
        font-weight: 700;

        line-height: 1.2;
    }


    .booking-type-stat-label {
        display: block;

        margin-top: 7px;

        color: rgba(255,255,255,.82);

        font-family: 'Cairo', sans-serif;

        font-size: 13px;
    }


    /* =========================================================
       TYPE BADGE
    ========================================================= */

    .booking-type-kind {
        display: flex;
        align-items: center;
        justify-content: space-between;

        padding: 17px 18px;

        margin-bottom: 18px;

        background: #fffaf0;

        border: 1px solid #eadbb5;

        border-radius: 13px;
    }


    .booking-type-kind-label {
        color: #777365;

        font-family: 'Cairo', sans-serif;

        font-size: 13px;
    }


    .booking-type-kind-value {
        color: #9b7920;

        font-family: 'Cairo', sans-serif;

        font-size: 14px;
        font-weight: 700;
    }


    /* =========================================================
       DELETE
    ========================================================= */

    .booking-type-delete {
        padding: 18px;

        background: #fff6f4;

        border: 1px solid #ecd0ca;

        border-radius: 13px;
    }


    .booking-type-delete p {
        margin: 0 0 13px;

        color: #7c504a;

        font-family: 'Cairo', sans-serif;

        font-size: 12px;

        line-height: 1.8;
    }


    .booking-type-delete button {
        width: 100%;

        border: none;

        padding: 10px;

        border-radius: 9px;

        background: #9b4b42;
        color: #fff;

        font-family: 'Cairo', sans-serif;

        font-size: 13px;
        font-weight: 700;

        cursor: pointer;

        transition: .2s ease;
    }


    .booking-type-delete button:hover {
        background: #813b34;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 900px) {

        .booking-type-show-grid {
            grid-template-columns: 1fr;
        }

    }


    @media (max-width: 700px) {

        .booking-type-show-header {
            flex-direction: column;
            align-items: stretch;
        }

        .booking-type-show-actions {
            flex-direction: column;
        }

        .booking-type-show-btn {
            width: 100%;
        }

        .booking-type-info-list {
            grid-template-columns: 1fr;
        }

    }


    @media (max-width: 500px) {

        .booking-type-show-header {
            padding: 20px;
        }

        .booking-type-show-title h1 {
            font-size: 20px;
        }

        .booking-type-show-card-body {
            padding: 18px;
        }

    }

</style>

@endpush


@section('content')

<div class="booking-type-show-page">


    {{-- =====================================================
        HEADER
    ====================================================== --}}

    <div class="booking-type-show-header">

        <div class="booking-type-show-title">

            <div class="booking-type-show-icon">

                @if($bookingType->icon)

                    <i class="{{ $bookingType->icon }}"></i>

                @else

                    <i class="fa-solid fa-book-quran"></i>

                @endif

            </div>

            <div>

                <h1>
                    {{ $bookingType->name }}
                </h1>

                <p>
                    {{ __('education_admin.booking_type_show.description') }}
                </p>

            </div>

        </div>


        <div class="booking-type-show-actions">

            <a
                href="{{ route('education.admin.booking-types.edit', $bookingType) }}"
                class="booking-type-show-btn edit">

                <i class="fa-solid fa-pen"></i>

                {{ __('education_admin.booking_type_show.edit') }}

            </a>


            <a
                href="{{ route('education.admin.booking-types.index') }}"
                class="booking-type-show-btn back">

                <i class="fa-solid fa-arrow-right"></i>

                {{ __('education_admin.booking_type_show.back_to_list') }}

            </a>

        </div>

    </div>


    {{-- =====================================================
        MAIN
    ====================================================== --}}

    <div class="booking-type-show-grid">


        {{-- =================================================
            LEFT
        ================================================== --}}

        <div>


            {{-- DESCRIPTION --}}

            <div class="booking-type-show-card">

                <div class="booking-type-show-card-header">

                    <h2>
                        <i class="fa-solid fa-circle-info"></i>

                        {{ __('education_admin.booking_type_show.basic_information') }}
                    </h2>

                </div>


                <div class="booking-type-show-card-body">

                    <div class="booking-type-info-list">


                        <div class="booking-type-info-item">

                            <div class="booking-type-info-label">

                                <i class="fa-solid fa-heading"></i>

                                {{ __('education_admin.booking_type_show.booking_type_name') }}

                            </div>

                            <div class="booking-type-info-value">

                                {{ $bookingType->name }}

                            </div>

                        </div>


                        <div class="booking-type-info-item">

                            <div class="booking-type-info-label">

                                <i class="fa-solid fa-link"></i>

                                {{ __('education_admin.booking_type_show.slug') }}

                            </div>

                            <div class="booking-type-info-value">

                                {{ $bookingType->slug }}

                            </div>

                        </div>


                        <div class="booking-type-info-item">

                            <div class="booking-type-info-label">

                                <i class="fa-solid fa-money-bill-wave"></i>

                                {{ __('education_admin.booking_type_show.price') }}

                            </div>

                            <div class="booking-type-info-value">

                                {{ number_format((float) $bookingType->price, 2) }}

                                {{ $bookingType->currency }}

                            </div>

                        </div>


                        <div class="booking-type-info-item">

                            <div class="booking-type-info-label">

                                <i class="fa-solid fa-layer-group"></i>

                                {{ __('education_admin.booking_type_show.total_sessions') }}

                            </div>

                            <div class="booking-type-info-value">

                                {{ $bookingType->total_sessions }}

                            </div>

                        </div>


                        <div class="booking-type-info-item">

                            <div class="booking-type-info-label">

                                <i class="fa-solid fa-clock"></i>

                                {{ __('education_admin.booking_type_show.session_duration') }}

                            </div>

                            <div class="booking-type-info-value">

                                @if($bookingType->session_duration)

                                    {{ $bookingType->session_duration }}
                                    {{ __('education_admin.booking_type_show.minutes') }}

                                @else

                                    {{ __('education_admin.booking_type_show.not_specified') }}

                                @endif

                            </div>

                        </div>


                        <div class="booking-type-info-item">

                            <div class="booking-type-info-label">

                                <i class="fa-solid fa-sort"></i>

                                {{ __('education_admin.booking_type_show.sort_order') }}

                            </div>

                            <div class="booking-type-info-value">

                                {{ $bookingType->sort_order }}

                            </div>

                        </div>


                        <div class="booking-type-info-item">

                            <div class="booking-type-info-label">

                                <i class="fa-solid fa-power-off"></i>

                                {{ __('education_admin.booking_type_show.status') }}

                            </div>

                            <div class="booking-type-info-value">

                                @if($bookingType->is_active)

                                    <span class="booking-type-status active">

                                        <i class="fa-solid fa-circle-check"></i>

                                        {{ __('education_admin.booking_type_show.active') }}

                                    </span>

                                @else

                                    <span class="booking-type-status inactive">

                                        <i class="fa-solid fa-circle-xmark"></i>

                                        {{ __('education_admin.booking_type_show.inactive') }}

                                    </span>

                                @endif

                            </div>

                        </div>


                    </div>

                </div>

            </div>


            {{-- DESCRIPTION CARD --}}

            <div
                class="booking-type-show-card"
                style="margin-top:22px;">

                <div class="booking-type-show-card-header">

                    <h2>

                        <i class="fa-solid fa-align-right"></i>

                        {{ __('education_admin.booking_type_show.description_title') }}

                    </h2>

                </div>


                <div class="booking-type-show-card-body">

                    @if($bookingType->description)

                        <div class="booking-type-description">

                            {{ $bookingType->description }}

                        </div>

                    @else

                        <div class="booking-type-empty">

                            {{ __('education_admin.booking_type_show.no_description') }}

                        </div>

                    @endif

                </div>

            </div>


        </div>


        {{-- =================================================
            RIGHT
        ================================================== --}}

        <div>


            {{-- BOOKINGS COUNT --}}

            <div class="booking-type-stat">

                <div class="booking-type-stat-icon">

                    <i class="fa-solid fa-calendar-check"></i>

                </div>

                <span class="booking-type-stat-number">

                    {{ $bookingType->bookings_count }}

                </span>

                <span class="booking-type-stat-label">

                    {{ __('education_admin.booking_type_show.related_bookings_count') }}

                </span>

            </div>


            {{-- TYPE --}}

            <div class="booking-type-kind">

                <span class="booking-type-kind-label">

                    {{ __('education_admin.booking_type_show.booking_type') }}

                </span>

                <span class="booking-type-kind-value">

                    {{ $bookingType->type_label }}

                </span>

            </div>


            {{-- DELETE --}}

            @if($bookingType->bookings_count == 0)

                <div class="booking-type-delete">

                    <p>

                        {{ __('education_admin.booking_type_show.can_delete_description') }}

                    </p>

                    <form
                        method="POST"
                        action="{{ route('education.admin.booking-types.destroy', $bookingType) }}"
                        onsubmit="return confirm('{{ __('education_admin.booking_type_show.delete_confirmation') }}');">

                        @csrf

                        @method('DELETE')

                        <button type="submit">

                            <i class="fa-solid fa-trash"></i>

                            {{ __('education_admin.booking_type_show.delete_booking_type') }}

                        </button>

                    </form>

                </div>

            @else

                <div class="booking-type-delete">

                    <p>

                        {{ __('education_admin.booking_type_show.cannot_delete_description') }}

                    </p>

                </div>

            @endif


        </div>


    </div>

</div>

@endsection
