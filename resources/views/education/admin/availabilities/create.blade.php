@extends('education.admin.layouts.app')

@section('title', __('education_admin.availabilities_create.page_title'))

@push('styles')
    <link
        rel="stylesheet"
        href="{{ asset('css/education/admin/availabilities.css') }}"
    >
@endpush

@section('content')

<div class="education-availability-page">

    {{-- ==========================================================
        PAGE HEADER
    =========================================================== --}}

    <div class="education-availability-page-header">

        <div class="education-availability-page-heading">

            <div class="education-availability-page-icon">
                <i class="fa-solid fa-calendar-plus"></i>
            </div>

            <div>

                <span class="education-availability-page-eyebrow">
                    {{ __('education_admin.availabilities_create.eyebrow') }}
                </span>

                <h1>
                    {{ __('education_admin.availabilities_create.title') }}
                </h1>

                <p>
                    {{ __('education_admin.availabilities_create.description') }}
                </p>

            </div>

        </div>


        <a
            href="{{ route('education.admin.availabilities.index') }}"
            class="education-availability-secondary-btn"
        >

            <i class="fa-solid fa-arrow-right"></i>

            <span>
                {{ __('education_admin.availabilities_create.back_to_availabilities') }}
            </span>

        </a>

    </div>


    {{-- ==========================================================
        VALIDATION ERRORS
    =========================================================== --}}

    @if($errors->any())

        <div class="education-availability-alert error">

            <div class="education-availability-alert-icon">

                <i class="fa-solid fa-circle-exclamation"></i>

            </div>

            <div class="education-availability-alert-content">

                <strong>
                    {{ __('education_admin.availabilities_create.review_data') }}
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
        FORM CARD
    =========================================================== --}}

    <div class="education-availability-form-card">

        {{-- FORM HEADER --}}

        <div class="education-availability-form-header">

            <div>

                <h2>
                    {{ __('education_admin.availabilities_create.form_title') }}
                </h2>

                <p>
                    {{ __('education_admin.availabilities_create.form_description') }}
                </p>

            </div>

            <div class="education-availability-form-header-icon">

                <i class="fa-regular fa-clock"></i>

            </div>

        </div>


        {{-- ======================================================
            FORM
        ======================================================= --}}

        <form
            method="POST"
            action="{{ route('education.admin.availabilities.store') }}"
            class="education-availability-form"
        >

            @csrf


            {{-- ==================================================
                DAY
            =================================================== --}}

            <div class="education-availability-form-group">

                <label for="day_of_week">

                    {{ __('education_admin.availabilities_create.day') }}

                    <span>
                        *
                    </span>

                </label>

                <div class="education-availability-input-wrapper">

                    <i class="fa-regular fa-calendar-days"></i>

                    <select
                        id="day_of_week"
                        name="day_of_week"
                        class="education-availability-input"
                        required
                    >

                        <option value="">
                            {{ __('education_admin.availabilities_create.select_day') }}
                        </option>

                        <option
                            value="0"
                            {{ old('day_of_week') === '0' ? 'selected' : '' }}
                        >
                            {{ __('education_admin.availabilities_create.days.0') }}
                        </option>

                        <option
                            value="1"
                            {{ old('day_of_week') === '1' ? 'selected' : '' }}
                        >
                            {{ __('education_admin.availabilities_create.days.1') }}
                        </option>

                        <option
                            value="2"
                            {{ old('day_of_week') === '2' ? 'selected' : '' }}
                        >
                            {{ __('education_admin.availabilities_create.days.2') }}
                        </option>

                        <option
                            value="3"
                            {{ old('day_of_week') === '3' ? 'selected' : '' }}
                        >
                            {{ __('education_admin.availabilities_create.days.3') }}
                        </option>

                        <option
                            value="4"
                            {{ old('day_of_week') === '4' ? 'selected' : '' }}
                        >
                            {{ __('education_admin.availabilities_create.days.4') }}
                        </option>

                        <option
                            value="5"
                            {{ old('day_of_week') === '5' ? 'selected' : '' }}
                        >
                            {{ __('education_admin.availabilities_create.days.5') }}
                        </option>

                        <option
                            value="6"
                            {{ old('day_of_week') === '6' ? 'selected' : '' }}
                        >
                            {{ __('education_admin.availabilities_create.days.6') }}
                        </option>

                    </select>

                </div>

                @error('day_of_week')

                    <small class="education-availability-field-error">
                        {{ $message }}
                    </small>

                @enderror

            </div>


            {{-- ==================================================
                TIME ROW
            =================================================== --}}

            <div class="education-availability-form-row">


                {{-- START TIME --}}

                <div class="education-availability-form-group">

                    <label for="start_time">

                        {{ __('education_admin.availabilities_create.start_time') }}

                        <span>
                            *
                        </span>

                    </label>

                    <div class="education-availability-input-wrapper">

                        <i class="fa-regular fa-clock"></i>

                        <input
                            type="time"
                            id="start_time"
                            name="start_time"
                            value="{{ old('start_time') }}"
                            class="education-availability-input"
                            required
                        >

                    </div>

                    @error('start_time')

                        <small class="education-availability-field-error">
                            {{ $message }}
                        </small>

                    @enderror

                </div>


                {{-- END TIME --}}

                <div class="education-availability-form-group">

                    <label for="end_time">

                        {{ __('education_admin.availabilities_create.end_time') }}

                        <span>
                            *
                        </span>

                    </label>

                    <div class="education-availability-input-wrapper">

                        <i class="fa-regular fa-clock"></i>

                        <input
                            type="time"
                            id="end_time"
                            name="end_time"
                            value="{{ old('end_time') }}"
                            class="education-availability-input"
                            required
                        >

                    </div>

                    @error('end_time')

                        <small class="education-availability-field-error">
                            {{ $message }}
                        </small>

                    @enderror

                </div>

            </div>


            {{-- ==================================================
                LABEL
            =================================================== --}}

            <div class="education-availability-form-group">

                <label for="label">

                    {{ __('education_admin.availabilities_create.label') }}

                    <span class="optional">
                        {{ __('education_admin.availabilities_create.optional') }}
                    </span>

                </label>

                <div class="education-availability-input-wrapper">

                    <i class="fa-solid fa-tag"></i>

                    <input
                        type="text"
                        id="label"
                        name="label"
                        value="{{ old('label') }}"
                        class="education-availability-input"
                        placeholder="{{ __('education_admin.availabilities_create.label_placeholder') }}"
                        maxlength="255"
                    >

                </div>

                @error('label')

                    <small class="education-availability-field-error">
                        {{ $message }}
                    </small>

                @enderror

            </div>


            {{-- ==================================================
                SORT ORDER
            =================================================== --}}

            <div class="education-availability-form-group">

                <label for="sort_order">

                    {{ __('education_admin.availabilities_create.sort_order') }}

                    <span class="optional">
                        {{ __('education_admin.availabilities_create.optional') }}
                    </span>

                </label>

                <div class="education-availability-input-wrapper">

                    <i class="fa-solid fa-arrow-down-1-9"></i>

                    <input
                        type="number"
                        id="sort_order"
                        name="sort_order"
                        value="{{ old('sort_order', 0) }}"
                        class="education-availability-input"
                        min="0"
                        step="1"
                    >

                </div>

                <small class="education-availability-field-hint">
                    {{ __('education_admin.availabilities_create.sort_order_hint') }}
                </small>

                @error('sort_order')

                    <small class="education-availability-field-error">
                        {{ $message }}
                    </small>

                @enderror

            </div>


            {{-- ==================================================
                ACTIVE STATUS
            =================================================== --}}

            <div class="education-availability-status-box">

                <div class="education-availability-status-box-icon">

                    <i class="fa-solid fa-circle-check"></i>

                </div>

                <div class="education-availability-status-box-content">

                    <strong>
                        {{ __('education_admin.availabilities_create.status_title') }}
                    </strong>

                    <span>
                        {{ __('education_admin.availabilities_create.status_description') }}
                    </span>

                </div>

                <label class="education-availability-switch">

                    <input
                        type="checkbox"
                        name="is_active"
                        value="1"
                        {{ old('is_active', true) ? 'checked' : '' }}
                    >

                    <span class="education-availability-switch-slider"></span>

                    <span class="education-availability-switch-label">
                        {{ __('education_admin.availabilities_create.available') }}
                    </span>

                </label>

            </div>


            {{-- ==================================================
                FORM ACTIONS
            =================================================== --}}

            <div class="education-availability-form-actions">

                <a
                    href="{{ route('education.admin.availabilities.index') }}"
                    class="education-availability-cancel-btn"
                >

                    <i class="fa-solid fa-xmark"></i>

                    {{ __('education_admin.availabilities_create.cancel') }}

                </a>


                <button
                    type="submit"
                    class="education-availability-submit-btn"
                >

                    <i class="fa-solid fa-floppy-disk"></i>

                    {{ __('education_admin.availabilities_create.save') }}

                </button>

            </div>

        </form>

    </div>


    {{-- ==========================================================
        INFORMATION CARD
    =========================================================== --}}

    <div class="education-availability-info-card">

        <div class="education-availability-info-icon">

            <i class="fa-solid fa-circle-info"></i>

        </div>

        <div>

            <strong>
                {{ __('education_admin.availabilities_create.note_title') }}
            </strong>

            <p>
                {{ __('education_admin.availabilities_create.note_description') }}
            </p>

        </div>

    </div>

</div>

@endsection
