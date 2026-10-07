@extends('education.admin.layouts.app')

@section('title', __('education_admin.booking_type_edit.page_title'))

@push('styles')

<style>

    /* =========================================================
       BOOKING TYPE EDIT
    ========================================================= */

    .booking-type-page {
        width: 100%;
        max-width: 1250px;
        margin: 0 auto;
    }


    /* =========================================================
       PAGE HEADER
    ========================================================= */

    .booking-type-page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 25px;
        padding: 25px 30px;

        background:
            linear-gradient(
                135deg,
                #fffdf7 0%,
                #f8f1df 100%
            );

        border: 1px solid #e8dcc0;
        border-radius: 18px;

        box-shadow:
            0 8px 25px rgba(79, 96, 66, 0.08);
    }


    .booking-type-header-info {
        display: flex;
        align-items: center;
        gap: 16px;
    }


    .booking-type-header-icon {
        width: 58px;
        height: 58px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 16px;

        background: #d4af37;
        color: #fff;

        font-size: 22px;

        box-shadow:
            0 8px 18px rgba(212, 175, 55, 0.22);
    }


    .booking-type-header-info h1 {
        margin: 0 0 6px;

        font-family: 'Cairo', sans-serif;

        color: #3f4f36;

        font-size: 24px;
        font-weight: 700;
    }


    .booking-type-header-info p {
        margin: 0;

        color: #7d7b70;

        font-family: 'Cairo', sans-serif;

        font-size: 14px;
    }


    .booking-type-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;

        padding: 11px 18px;

        border-radius: 10px;

        background: #4f6042;
        color: #fff;

        text-decoration: none;

        font-family: 'Cairo', sans-serif;
        font-size: 14px;
        font-weight: 600;

        transition: .2s ease;
    }


    .booking-type-back:hover {
        background: #3f4f36;
        color: #fff;

        transform: translateY(-1px);
    }


    /* =========================================================
       ALERTS
    ========================================================= */

    .booking-type-alert {
        padding: 14px 18px;
        margin-bottom: 20px;

        border-radius: 12px;

        font-family: 'Cairo', sans-serif;

        font-size: 14px;
    }


    .booking-type-alert.success {
        background: #edf7ee;
        border: 1px solid #b9d8bc;
        color: #38633d;
    }


    .booking-type-alert.error {
        background: #fff0ee;
        border: 1px solid #e4b5af;
        color: #8b3e36;
    }


    /* =========================================================
       FORM CARD
    ========================================================= */

    .booking-type-form-card {
        background: #fffdf8;

        border: 1px solid #e8dcc0;
        border-radius: 18px;

        box-shadow:
            0 8px 30px rgba(79, 96, 66, 0.07);

        overflow: hidden;
    }


    .booking-type-card-header {
        padding: 20px 28px;

        background: #f8f1df;

        border-bottom: 1px solid #e8dcc0;
    }


    .booking-type-card-header h2 {
        margin: 0;

        color: #4f6042;

        font-family: 'Cairo', sans-serif;

        font-size: 18px;
        font-weight: 700;
    }


    .booking-type-card-header p {
        margin: 5px 0 0;

        color: #888576;

        font-family: 'Cairo', sans-serif;

        font-size: 13px;
    }


    .booking-type-form {
        padding: 30px;
    }


    /* =========================================================
       GRID
    ========================================================= */

    .booking-type-grid {
        display: grid;

        grid-template-columns:
            repeat(2, minmax(0, 1fr));

        gap: 22px;
    }


    .booking-type-field.full {
        grid-column: 1 / -1;
    }


    /* =========================================================
       LABEL
    ========================================================= */

    .booking-type-field label {
        display: block;

        margin-bottom: 8px;

        color: #4f6042;

        font-family: 'Cairo', sans-serif;

        font-size: 14px;
        font-weight: 700;
    }


    .booking-type-field label span {
        color: #b58d19;
    }


    /* =========================================================
       INPUTS
    ========================================================= */

    .booking-type-input,
    .booking-type-textarea,
    .booking-type-select {
        width: 100%;

        box-sizing: border-box;

        padding: 12px 14px;

        border: 1px solid #ddd2b8;
        border-radius: 10px;

        background: #fff;

        color: #3f4039;

        font-family: 'Cairo', sans-serif;

        font-size: 14px;

        outline: none;

        transition: .2s ease;
    }


    .booking-type-input:focus,
    .booking-type-textarea:focus,
    .booking-type-select:focus {
        border-color: #c7a33b;

        box-shadow:
            0 0 0 3px rgba(212, 175, 55, 0.12);
    }


    .booking-type-textarea {
        min-height: 130px;

        resize: vertical;

        line-height: 1.9;
    }


    .booking-type-help {
        margin-top: 6px;

        color: #918e81;

        font-family: 'Cairo', sans-serif;

        font-size: 12px;
    }


    /* =========================================================
       ERROR
    ========================================================= */

    .booking-type-error {
        margin-top: 6px;

        color: #a5443b;

        font-family: 'Cairo', sans-serif;

        font-size: 12px;
    }


    /* =========================================================
       ACTIVE SWITCH
    ========================================================= */

    .booking-type-switch-box {
        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 20px;

        padding: 16px 18px;

        border: 1px solid #e0d5bb;
        border-radius: 12px;

        background: #faf7ee;
    }


    .booking-type-switch-text strong {
        display: block;

        color: #4f6042;

        font-family: 'Cairo', sans-serif;

        font-size: 14px;
    }


    .booking-type-switch-text small {
        display: block;

        margin-top: 4px;

        color: #8c897c;

        font-family: 'Cairo', sans-serif;

        font-size: 12px;
    }


    .booking-type-switch {
        position: relative;

        width: 50px;
        height: 28px;

        flex-shrink: 0;
    }


    .booking-type-switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }


    .booking-type-slider {
        position: absolute;

        inset: 0;

        cursor: pointer;

        background: #c9c5b9;

        border-radius: 30px;

        transition: .25s ease;
    }


    .booking-type-slider::before {
        content: "";

        position: absolute;

        width: 22px;
        height: 22px;

        right: 3px;
        top: 3px;

        background: #fff;

        border-radius: 50%;

        transition: .25s ease;

        box-shadow:
            0 2px 5px rgba(0,0,0,.15);
    }


    .booking-type-switch input:checked + .booking-type-slider {
        background: #4f6042;
    }


    .booking-type-switch input:checked + .booking-type-slider::before {
        transform: translateX(-22px);
    }


    /* =========================================================
       FORM ACTIONS
    ========================================================= */

    .booking-type-actions {
        display: flex;
        align-items: center;
        justify-content: flex-start;

        gap: 12px;

        margin-top: 30px;
        padding-top: 24px;

        border-top: 1px solid #eee5d1;
    }


    .booking-type-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        gap: 8px;

        padding: 12px 22px;

        border: none;
        border-radius: 10px;

        font-family: 'Cairo', sans-serif;

        font-size: 14px;
        font-weight: 700;

        cursor: pointer;

        text-decoration: none;

        transition: .2s ease;
    }


    .booking-type-btn-primary {
        background: #4f6042;
        color: #fff;
    }


    .booking-type-btn-primary:hover {
        background: #3f4f36;
        color: #fff;

        transform: translateY(-1px);
    }


    .booking-type-btn-secondary {
        background: #eee8d8;
        color: #5d604f;
    }


    .booking-type-btn-secondary:hover {
        background: #e3dac2;
        color: #4f6042;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 800px) {

        .booking-type-page-header {
            flex-direction: column;
            align-items: stretch;
        }

        .booking-type-back {
            justify-content: center;
        }

        .booking-type-grid {
            grid-template-columns: 1fr;
        }

        .booking-type-field.full {
            grid-column: auto;
        }

        .booking-type-form {
            padding: 20px;
        }

    }


    @media (max-width: 500px) {

        .booking-type-page-header {
            padding: 20px;
        }

        .booking-type-header-info h1 {
            font-size: 20px;
        }

        .booking-type-actions {
            flex-direction: column;
            align-items: stretch;
        }

        .booking-type-btn {
            width: 100%;
        }

    }

</style>

@endpush


@section('content')

<div class="booking-type-page">


    {{-- =====================================================
        HEADER
    ====================================================== --}}

    <div class="booking-type-page-header">

        <div class="booking-type-header-info">

            <div class="booking-type-header-icon">
                <i class="fa-solid fa-pen-to-square"></i>
            </div>

            <div>

                <h1>
                    {{ __('education_admin.booking_type_edit.title') }}
                </h1>

                <p>
                    {{ __('education_admin.booking_type_edit.description') }}
                    {{ $bookingType->name }}
                </p>

            </div>

        </div>


        <a
            href="{{ route('education.admin.booking-types.index') }}"
            class="booking-type-back">

            <i class="fa-solid fa-arrow-right"></i>

            {{ __('education_admin.booking_type_edit.back_to_booking_types') }}

        </a>

    </div>


    {{-- =====================================================
        SUCCESS
    ====================================================== --}}

    @if(session('success'))

        <div class="booking-type-alert success">

            <i class="fa-solid fa-circle-check"></i>

            {{ session('success') }}

        </div>

    @endif


    {{-- =====================================================
        ERROR
    ====================================================== --}}

    @if(session('error'))

        <div class="booking-type-alert error">

            <i class="fa-solid fa-circle-exclamation"></i>

            {{ session('error') }}

        </div>

    @endif


    {{-- =====================================================
        FORM
    ====================================================== --}}

    <div class="booking-type-form-card">


        <div class="booking-type-card-header">

            <h2>
                {{ __('education_admin.booking_type_edit.form_title') }}
            </h2>

            <p>
                {{ __('education_admin.booking_type_edit.form_description') }}
            </p>

        </div>


        <form
            method="POST"
            action="{{ route('education.admin.booking-types.update', $bookingType) }}"
            class="booking-type-form">

            @csrf

            @method('PUT')


            <div class="booking-type-grid">


                {{-- NAME --}}

                <div class="booking-type-field">

                    <label for="name">
                        {{ __('education_admin.booking_type_edit.booking_type_name') }}
                        <span>*</span>
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="booking-type-input"
                        value="{{ old('name', $bookingType->name) }}"
                        required>

                    @error('name')
                        <div class="booking-type-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- SLUG --}}

                <div class="booking-type-field">

                    <label for="slug">
                        {{ __('education_admin.booking_type_edit.slug') }}
                    </label>

                    <input
                        type="text"
                        id="slug"
                        name="slug"
                        class="booking-type-input"
                        value="{{ old('slug', $bookingType->slug) }}">

                    <div class="booking-type-help">
                        {{ __('education_admin.booking_type_edit.slug_help') }}
                    </div>

                    @error('slug')
                        <div class="booking-type-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- DESCRIPTION --}}

                <div class="booking-type-field full">

                    <label for="description">
                        {{ __('education_admin.booking_type_edit.description_label') }}
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        class="booking-type-textarea"
                        placeholder="{{ __('education_admin.booking_type_edit.description_placeholder') }}">{{ old('description', $bookingType->description) }}</textarea>

                    @error('description')
                        <div class="booking-type-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- ICON --}}

                <div class="booking-type-field">

                    <label for="icon">
                        {{ __('education_admin.booking_type_edit.icon') }}
                    </label>

                    <input
                        type="text"
                        id="icon"
                        name="icon"
                        class="booking-type-input"
                        value="{{ old('icon', $bookingType->icon) }}"
                        placeholder="fa-solid fa-book-quran">

                    <div class="booking-type-help">
                        {{ __('education_admin.booking_type_edit.icon_help') }}
                        <br>
                        {{ __('education_admin.booking_type_edit.icon_example') }}
                        fa-solid fa-book-quran
                    </div>

                </div>


                {{-- PRICE --}}

                <div class="booking-type-field">

                    <label for="price">
                        {{ __('education_admin.booking_type_edit.price') }}
                        <span>*</span>
                    </label>

                    <input
                        type="number"
                        id="price"
                        name="price"
                        class="booking-type-input"
                        value="{{ old('price', $bookingType->price) }}"
                        min="0"
                        step="0.01"
                        required>

                </div>


                {{-- CURRENCY --}}

                <div class="booking-type-field">

                    <label for="currency">
                        {{ __('education_admin.booking_type_edit.currency') }}
                        <span>*</span>
                    </label>

                    <input
                        type="text"
                        id="currency"
                        name="currency"
                        class="booking-type-input"
                        value="{{ old('currency', $bookingType->currency) }}"
                        maxlength="3"
                        required>

                </div>


                {{-- SESSIONS --}}

                <div class="booking-type-field">

                    <label for="total_sessions">
                        {{ __('education_admin.booking_type_edit.total_sessions') }}
                        <span>*</span>
                    </label>

                    <input
                        type="number"
                        id="total_sessions"
                        name="total_sessions"
                        class="booking-type-input"
                        value="{{ old('total_sessions', $bookingType->total_sessions) }}"
                        min="1"
                        required>

                    <div class="booking-type-help">
                        {{ __('education_admin.booking_type_edit.total_sessions_help') }}
                    </div>

                </div>


                {{-- DURATION --}}

                <div class="booking-type-field">

                    <label for="session_duration">
                        {{ __('education_admin.booking_type_edit.session_duration') }}
                    </label>

                    <input
                        type="number"
                        id="session_duration"
                        name="session_duration"
                        class="booking-type-input"
                        value="{{ old('session_duration', $bookingType->session_duration) }}"
                        min="1">

                </div>


                {{-- SORT --}}

                <div class="booking-type-field">

                    <label for="sort_order">
                        {{ __('education_admin.booking_type_edit.sort_order') }}
                    </label>

                    <input
                        type="number"
                        id="sort_order"
                        name="sort_order"
                        class="booking-type-input"
                        value="{{ old('sort_order', $bookingType->sort_order) }}"
                        min="0">

                </div>


                {{-- ACTIVE --}}

                <div class="booking-type-field">

                    <label>
                        {{ __('education_admin.booking_type_edit.status_title') }}
                    </label>

                    <div class="booking-type-switch-box">

                        <div class="booking-type-switch-text">

                            <strong>
                                {{ __('education_admin.booking_type_edit.active_type') }}
                            </strong>

                            <small>
                                {{ __('education_admin.booking_type_edit.active_type_description') }}
                            </small>

                        </div>

                        <label class="booking-type-switch">

                            <input
                                type="checkbox"
                                name="is_active"
                                value="1"
                                {{ old('is_active', $bookingType->is_active) ? 'checked' : '' }}>

                            <span class="booking-type-slider"></span>

                        </label>

                    </div>

                </div>


            </div>


            {{-- ACTIONS --}}

            <div class="booking-type-actions">

                <button
                    type="submit"
                    class="booking-type-btn booking-type-btn-primary">

                    <i class="fa-solid fa-floppy-disk"></i>

                    {{ __('education_admin.booking_type_edit.save_changes') }}

                </button>


                <a
                    href="{{ route('education.admin.booking-types.show', $bookingType) }}"
                    class="booking-type-btn booking-type-btn-secondary">

                    <i class="fa-solid fa-eye"></i>

                    {{ __('education_admin.booking_type_edit.view_type') }}

                </a>


                <a
                    href="{{ route('education.admin.booking-types.index') }}"
                    class="booking-type-btn booking-type-btn-secondary">

                    {{ __('education_admin.booking_type_edit.cancel') }}

                </a>

            </div>

        </form>

    </div>

</div>

@endsection
