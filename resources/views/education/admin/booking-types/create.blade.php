@extends('education.admin.layouts.app')

@section('title', __('education_admin.booking_types_create.page_title'))

@section('content')

<div class="education-page">

    {{-- ==========================================================
        PAGE HEADER
    =========================================================== --}}

    <div class="page-header">

        <div class="page-header-content">

            <div class="page-header-icon">
                <i class="fa-solid fa-calendar-plus"></i>
            </div>

            <div>
                <h1>
                    {{ __('education_admin.booking_types_create.header.title') }}
                </h1>

                <p>
                    {{ __('education_admin.booking_types_create.header.description') }}
                </p>
            </div>

        </div>


        <div class="page-header-actions">

            <a
                href="{{ route('education.admin.booking-types.index') }}"
                class="btn btn-secondary"
            >
                <i class="fa-solid fa-arrow-right"></i>
                {{ __('education_admin.booking_types_create.header.back') }}
            </a>

        </div>

    </div>


    {{-- ==========================================================
        VALIDATION ERRORS
    =========================================================== --}}

    @if ($errors->any())

        <div class="alert alert-danger">

            <div class="alert-icon">
                <i class="fa-solid fa-circle-exclamation"></i>
            </div>

            <div class="alert-content">

                <strong>
                    {{ __('education_admin.booking_types_create.validation.review') }}
                </strong>

                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

            </div>

        </div>

    @endif


    {{-- ==========================================================
        FORM
    =========================================================== --}}

    <form
        action="{{ route('education.admin.booking-types.store') }}"
        method="POST"
        class="booking-type-form"
    >

        @csrf


        {{-- ======================================================
            BASIC INFORMATION
        ======================================================= --}}

        <div class="form-card">

            <div class="form-card-header">

                <div class="form-card-icon">
                    <i class="fa-solid fa-circle-info"></i>
                </div>

                <div>
                    <h2>
                        {{ __('education_admin.booking_types_create.basic_information.title') }}
                    </h2>

                    <p>
                        {{ __('education_admin.booking_types_create.basic_information.description') }}
                    </p>
                </div>

            </div>


            <div class="form-card-body">

                <div class="form-grid">


                    {{-- NAME --}}

                    <div class="form-group">

                        <label for="name">
                            {{ __('education_admin.booking_types_create.fields.name') }}
                            <span class="required">
                                {{ __('education_admin.booking_types_create.required') }}
                            </span>
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            class="form-control @error('name') is-invalid @enderror"
                            placeholder="{{ __('education_admin.booking_types_create.placeholders.name') }}"
                            required
                        >

                        @error('name')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- SLUG --}}

                    <div class="form-group">

                        <label for="slug">
                            {{ __('education_admin.booking_types_create.fields.slug') }}

                            <span class="optional">
                                {{ __('education_admin.booking_types_create.optional') }}
                            </span>
                        </label>

                        <input
                            type="text"
                            id="slug"
                            name="slug"
                            value="{{ old('slug') }}"
                            class="form-control @error('slug') is-invalid @enderror"
                            placeholder="{{ __('education_admin.booking_types_create.placeholders.slug') }}"
                            dir="ltr"
                        >

                        <small class="form-help">
                            {{ __('education_admin.booking_types_create.help.slug') }}
                        </small>

                        @error('slug')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- ICON --}}

                    <div class="form-group">

                        <label for="icon">
                            {{ __('education_admin.booking_types_create.fields.icon') }}

                            <span class="optional">
                                {{ __('education_admin.booking_types_create.optional') }}
                            </span>
                        </label>

                        <input
                            type="text"
                            id="icon"
                            name="icon"
                            value="{{ old('icon') }}"
                            class="form-control @error('icon') is-invalid @enderror"
                            placeholder="{{ __('education_admin.booking_types_create.placeholders.icon') }}"
                            dir="ltr"
                        >

                        <small class="form-help">
                            {{ __('education_admin.booking_types_create.help.icon') }}
                        </small>

                        @error('icon')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- CURRENCY --}}

                    <div class="form-group">

                        <label for="currency">
                            {{ __('education_admin.booking_types_create.fields.currency') }}

                            <span class="required">
                                {{ __('education_admin.booking_types_create.required') }}
                            </span>
                        </label>

                        <input
                            type="text"
                            id="currency"
                            name="currency"
                            value="{{ old('currency', 'SAR') }}"
                            maxlength="3"
                            class="form-control @error('currency') is-invalid @enderror"
                            placeholder="{{ __('education_admin.booking_types_create.placeholders.currency') }}"
                            dir="ltr"
                            required
                        >

                        <small class="form-help">
                            {{ __('education_admin.booking_types_create.help.currency') }}
                        </small>

                        @error('currency')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                </div>


                {{-- DESCRIPTION --}}

                <div class="form-group full-width">

                    <label for="description">
                        {{ __('education_admin.booking_types_create.fields.description') }}

                        <span class="optional">
                            {{ __('education_admin.booking_types_create.optional') }}
                        </span>
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="5"
                        class="form-control @error('description') is-invalid @enderror"
                        placeholder="{{ __('education_admin.booking_types_create.placeholders.description') }}"
                    >{{ old('description') }}</textarea>

                    @error('description')
                        <div class="field-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

            </div>

        </div>


        {{-- ======================================================
            PRICE & SESSIONS
        ======================================================= --}}

        <div class="form-card">

            <div class="form-card-header">

                <div class="form-card-icon">
                    <i class="fa-solid fa-coins"></i>
                </div>

                <div>
                    <h2>
                        {{ __('education_admin.booking_types_create.price_sessions.title') }}
                    </h2>

                    <p>
                        {{ __('education_admin.booking_types_create.price_sessions.description') }}
                    </p>

                </div>

            </div>


            <div class="form-card-body">

                <div class="form-grid">


                    {{-- PRICE --}}

                    <div class="form-group">

                        <label for="price">
                            {{ __('education_admin.booking_types_create.fields.price') }}

                            <span class="required">
                                {{ __('education_admin.booking_types_create.required') }}
                            </span>
                        </label>

                        <div class="input-with-suffix">

                            <input
                                type="number"
                                id="price"
                                name="price"
                                value="{{ old('price', '0') }}"
                                min="0"
                                step="0.01"
                                class="form-control @error('price') is-invalid @enderror"
                                placeholder="{{ __('education_admin.booking_types_create.placeholders.price') }}"
                                required
                            >

                            <span class="input-suffix">
                                {{ __('education_admin.booking_types_create.price_sessions.currency_unit') }}
                            </span>

                        </div>

                        @error('price')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- TOTAL SESSIONS --}}

                    <div class="form-group">

                        <label for="total_sessions">
                            {{ __('education_admin.booking_types_create.fields.total_sessions') }}

                            <span class="required">
                                {{ __('education_admin.booking_types_create.required') }}
                            </span>
                        </label>

                        <input
                            type="number"
                            id="total_sessions"
                            name="total_sessions"
                            value="{{ old('total_sessions', '1') }}"
                            min="1"
                            step="1"
                            class="form-control @error('total_sessions') is-invalid @enderror"
                            required
                        >

                        <small class="form-help">
                            {{ __('education_admin.booking_types_create.help.total_sessions') }}
                        </small>

                        @error('total_sessions')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- SESSION DURATION --}}

                    <div class="form-group">

                        <label for="session_duration">
                            {{ __('education_admin.booking_types_create.fields.session_duration') }}

                            <span class="optional">
                                {{ __('education_admin.booking_types_create.optional') }}
                            </span>
                        </label>

                        <div class="input-with-suffix">

                            <input
                                type="number"
                                id="session_duration"
                                name="session_duration"
                                value="{{ old('session_duration') }}"
                                min="1"
                                step="1"
                                class="form-control @error('session_duration') is-invalid @enderror"
                                placeholder="{{ __('education_admin.booking_types_create.placeholders.session_duration') }}"
                            >

                            <span class="input-suffix">
                                {{ __('education_admin.booking_types_create.price_sessions.minutes_unit') }}
                            </span>

                        </div>

                        @error('session_duration')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- SORT ORDER --}}

                    <div class="form-group">

                        <label for="sort_order">
                            {{ __('education_admin.booking_types_create.fields.sort_order') }}

                            <span class="optional">
                                {{ __('education_admin.booking_types_create.optional') }}
                            </span>
                        </label>

                        <input
                            type="number"
                            id="sort_order"
                            name="sort_order"
                            value="{{ old('sort_order', '0') }}"
                            min="0"
                            step="1"
                            class="form-control @error('sort_order') is-invalid @enderror"
                        >

                        <small class="form-help">
                            {{ __('education_admin.booking_types_create.help.sort_order') }}
                        </small>

                        @error('sort_order')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                </div>

            </div>

        </div>


        {{-- ======================================================
            STATUS
        ======================================================= --}}

        <div class="form-card">

            <div class="form-card-header">

                <div class="form-card-icon">
                    <i class="fa-solid fa-toggle-on"></i>
                </div>

                <div>
                    <h2>
                        {{ __('education_admin.booking_types_create.status.title') }}
                    </h2>

                    <p>
                        {{ __('education_admin.booking_types_create.status.description') }}
                    </p>
                </div>

            </div>


            <div class="form-card-body">

                <label class="status-switch">

                    <input
                        type="checkbox"
                        name="is_active"
                        value="1"
                        {{ old('is_active', true) ? 'checked' : '' }}
                    >

                    <span class="switch-slider"></span>

                    <span class="switch-text">

                        <strong>
                            {{ __('education_admin.booking_types_create.status.active') }}
                        </strong>

                        <small>
                            {{ __('education_admin.booking_types_create.status.active_description') }}
                        </small>

                    </span>

                </label>

            </div>

        </div>


        {{-- ======================================================
            FORM ACTIONS
        ======================================================= --}}

        <div class="form-actions">

            <a
                href="{{ route('education.admin.booking-types.index') }}"
                class="btn btn-secondary"
            >
                <i class="fa-solid fa-xmark"></i>
                {{ __('education_admin.booking_types_create.actions.cancel') }}
            </a>

            <button
                type="submit"
                class="btn btn-primary"
            >
                <i class="fa-solid fa-floppy-disk"></i>
                {{ __('education_admin.booking_types_create.actions.save') }}
            </button>

        </div>

    </form>

</div>

@endsection


@push('styles')

<style>

    /* ==========================================================
       PAGE
    ========================================================== */

    .education-page {
        width: 100%;
    }


    /* ==========================================================
       PAGE HEADER
    ========================================================== */

    .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 28px;
    }

    .page-header-content {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .page-header-icon {
        width: 58px;
        height: 58px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(184, 145, 62, 0.12);
        color: #b8913e;
        font-size: 24px;
        flex-shrink: 0;
    }

    .page-header h1 {
        margin: 0 0 5px;
        color: #315443;
        font-family: 'Amiri', serif;
        font-size: 30px;
        font-weight: 700;
    }

    .page-header p {
        margin: 0;
        color: #777;
        font-size: 14px;
    }


    /* ==========================================================
       BUTTONS
    ========================================================== */

    .page-header-actions {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .btn {
        border: 0;
        border-radius: 11px;
        padding: 11px 18px;
        min-height: 44px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        text-decoration: none;
        font-family: 'Cairo', sans-serif;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.2s ease;
    }

    .btn-primary {
        background: #315443;
        color: #fff;
    }

    .btn-primary:hover {
        background: #263f32;
        transform: translateY(-1px);
    }

    .btn-secondary {
        background: #f3eee2;
        color: #315443;
        border: 1px solid #e2d7bd;
    }

    .btn-secondary:hover {
        background: #ebe2cf;
    }


    /* ==========================================================
       ALERT
    ========================================================== */

    .alert {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        padding: 16px 18px;
        border-radius: 13px;
        margin-bottom: 24px;
    }

    .alert-danger {
        background: #fff0ef;
        border: 1px solid #f1c7c4;
        color: #8d332d;
    }

    .alert-icon {
        font-size: 20px;
        margin-top: 2px;
    }

    .alert-content strong {
        display: block;
        margin-bottom: 6px;
    }

    .alert-content ul {
        margin: 0;
        padding-right: 20px;
    }

    .alert-content li {
        margin-bottom: 3px;
    }


    /* ==========================================================
       FORM CARD
    ========================================================== */

    .form-card {
        background: #fffdf8;
        border: 1px solid #e8dfcc;
        border-radius: 18px;
        margin-bottom: 22px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(65, 52, 28, 0.045);
    }

    .form-card-header {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 20px 24px;
        background: #faf6ed;
        border-bottom: 1px solid #ebe2d1;
    }

    .form-card-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(184, 145, 62, 0.13);
        color: #b8913e;
        font-size: 18px;
        flex-shrink: 0;
    }

    .form-card-header h2 {
        margin: 0 0 3px;
        color: #315443;
        font-size: 18px;
        font-weight: 700;
    }

    .form-card-header p {
        margin: 0;
        color: #8a8377;
        font-size: 13px;
    }

    .form-card-body {
        padding: 24px;
    }


    /* ==========================================================
       FORM GRID
    ========================================================== */

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px;
    }

    .form-group {
        min-width: 0;
    }

    .form-group.full-width {
        margin-top: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #3c443e;
        font-size: 14px;
        font-weight: 600;
    }

    .required {
        color: #b14a3e;
        margin-right: 3px;
    }

    .optional {
        color: #9a9387;
        font-size: 12px;
        font-weight: 400;
        margin-right: 4px;
    }


    /* ==========================================================
       INPUTS
    ========================================================== */

    .form-control {
        width: 100%;
        min-height: 46px;
        box-sizing: border-box;
        padding: 10px 13px;
        border: 1px solid #ddd4c3;
        border-radius: 10px;
        background: #fff;
        color: #343a36;
        font-family: 'Cairo', sans-serif;
        font-size: 14px;
        outline: none;
        transition: 0.2s ease;
    }

    .form-control:focus {
        border-color: #b8913e;
        box-shadow: 0 0 0 3px rgba(184, 145, 62, 0.10);
    }

    textarea.form-control {
        min-height: 125px;
        resize: vertical;
        line-height: 1.8;
    }

    .form-control.is-invalid {
        border-color: #c6534b;
    }

    .form-help {
        display: block;
        margin-top: 6px;
        color: #918a7f;
        font-size: 12px;
        line-height: 1.7;
    }

    .field-error {
        margin-top: 6px;
        color: #b1433b;
        font-size: 12px;
    }


    /* ==========================================================
       INPUT SUFFIX
    ========================================================== */

    .input-with-suffix {
        position: relative;
    }

    .input-with-suffix .form-control {
        padding-left: 62px;
    }

    .input-suffix {
        position: absolute;
        left: 13px;
        top: 50%;
        transform: translateY(-50%);
        color: #8d877b;
        font-size: 12px;
        pointer-events: none;
    }


    /* ==========================================================
       STATUS SWITCH
    ========================================================== */

    .status-switch {
        display: flex;
        align-items: center;
        gap: 14px;
        cursor: pointer;
        user-select: none;
    }

    .status-switch input {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }

    .switch-slider {
        position: relative;
        width: 52px;
        height: 29px;
        border-radius: 30px;
        background: #d8d3c8;
        flex-shrink: 0;
        transition: 0.2s ease;
    }

    .switch-slider::after {
        content: '';
        position: absolute;
        top: 4px;
        right: 4px;
        width: 21px;
        height: 21px;
        border-radius: 50%;
        background: #fff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
        transition: 0.2s ease;
    }

    .status-switch input:checked + .switch-slider {
        background: #315443;
    }

    .status-switch input:checked + .switch-slider::after {
        right: 27px;
    }

    .switch-text {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .switch-text strong {
        color: #315443;
        font-size: 14px;
    }

    .switch-text small {
        color: #8d877b;
        font-size: 12px;
    }


    /* ==========================================================
       FORM ACTIONS
    ========================================================== */

    .form-actions {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        gap: 12px;
        padding: 4px 0 30px;
    }


    /* ==========================================================
       RESPONSIVE
    ========================================================== */

    @media (max-width: 800px) {

        .page-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .page-header-actions {
            width: 100%;
        }

        .page-header-actions .btn {
            width: 100%;
        }

        .form-grid {
            grid-template-columns: 1fr;
        }

    }


    @media (max-width: 520px) {

        .page-header h1 {
            font-size: 24px;
        }

        .form-card-header,
        .form-card-body {
            padding: 18px;
        }

        .form-actions {
            flex-direction: column-reverse;
        }

        .form-actions .btn {
            width: 100%;
        }

    }

</style>

@endpush
