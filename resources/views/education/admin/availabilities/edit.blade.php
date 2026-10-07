@extends('education.admin.layouts.app')

@section('title', __('education_admin.availability_edit.page_title'))

@push('styles')
<style>
    .availability-edit-page {
        direction: rtl;
    }

    .availability-page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 25px;
        flex-wrap: wrap;
    }

    .availability-page-title {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .availability-page-title-icon {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(184, 146, 63, 0.12);
        color: #b8923f;
        font-size: 22px;
    }

    .availability-page-title h1 {
        margin: 0 0 5px;
        font-family: 'Cairo', sans-serif;
        font-size: 24px;
        font-weight: 700;
        color: #24352b;
    }

    .availability-page-title p {
        margin: 0;
        color: #7b827d;
        font-family: 'Cairo', sans-serif;
        font-size: 13px;
    }

    .availability-header-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .availability-btn {
        min-height: 42px;
        padding: 0 18px;
        border-radius: 10px;
        border: 1px solid transparent;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        text-decoration: none;
        font-family: 'Cairo', sans-serif;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: .2s ease;
    }

    .availability-btn-secondary {
        background: #fff;
        border-color: #dedbd3;
        color: #536158;
    }

    .availability-btn-secondary:hover {
        background: #f7f5ef;
        color: #24352b;
    }

    .availability-btn-primary {
        background: #b8923f;
        color: #fff;
    }

    .availability-btn-primary:hover {
        background: #a47f35;
        color: #fff;
        transform: translateY(-1px);
    }

    .availability-form-card {
        background: #fffdf9;
        border: 1px solid #ebe6dc;
        border-radius: 18px;
        box-shadow: 0 8px 30px rgba(36, 53, 43, .06);
        overflow: hidden;
    }

    .availability-card-header {
        padding: 20px 24px;
        border-bottom: 1px solid #eee9df;
        background: #fffdf9;
    }

    .availability-card-header h2 {
        margin: 0;
        color: #24352b;
        font-family: 'Cairo', sans-serif;
        font-size: 17px;
        font-weight: 700;
    }

    .availability-card-header p {
        margin: 6px 0 0;
        color: #858b86;
        font-family: 'Cairo', sans-serif;
        font-size: 12px;
    }

    .availability-form-body {
        padding: 26px;
    }

    .availability-form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 22px;
    }

    .availability-field {
        display: flex;
        flex-direction: column;
    }

    .availability-field-full {
        grid-column: 1 / -1;
    }

    .availability-label {
        margin-bottom: 8px;
        color: #34453b;
        font-family: 'Cairo', sans-serif;
        font-size: 13px;
        font-weight: 600;
    }

    .availability-required {
        color: #a94c4c;
    }

    .availability-input,
    .availability-select {
        width: 100%;
        min-height: 46px;
        padding: 0 14px;
        border: 1px solid #ddd9cf;
        border-radius: 10px;
        outline: none;
        background: #fff;
        color: #293a31;
        font-family: 'Cairo', sans-serif;
        font-size: 13px;
        transition: .2s ease;
        box-sizing: border-box;
    }

    .availability-input:focus,
    .availability-select:focus {
        border-color: #b8923f;
        box-shadow: 0 0 0 3px rgba(184, 146, 63, .10);
    }

    .availability-input::placeholder {
        color: #a5aaa5;
    }

    .availability-time-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }

    .availability-time-wrapper {
        position: relative;
    }

    .availability-time-wrapper i {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #b8923f;
        pointer-events: none;
    }

    .availability-time-wrapper .availability-input {
        padding-right: 42px;
    }

    .availability-help {
        margin-top: 6px;
        color: #8a908b;
        font-family: 'Cairo', sans-serif;
        font-size: 11px;
        line-height: 1.7;
    }

    .availability-error {
        margin-top: 6px;
        color: #a33a3a;
        font-family: 'Cairo', sans-serif;
        font-size: 11px;
    }

    .availability-switch-box {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        padding: 17px 18px;
        background: #f8f6f0;
        border: 1px solid #e9e4d9;
        border-radius: 12px;
    }

    .availability-switch-text strong {
        display: block;
        color: #34453b;
        font-family: 'Cairo', sans-serif;
        font-size: 13px;
        margin-bottom: 4px;
    }

    .availability-switch-text span {
        color: #858b86;
        font-family: 'Cairo', sans-serif;
        font-size: 11px;
    }

    .availability-switch {
        position: relative;
        width: 48px;
        height: 26px;
        flex: 0 0 auto;
    }

    .availability-switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .availability-slider {
        position: absolute;
        inset: 0;
        cursor: pointer;
        background: #c8ccc8;
        border-radius: 30px;
        transition: .25s ease;
    }

    .availability-slider::before {
        content: "";
        position: absolute;
        width: 20px;
        height: 20px;
        right: 3px;
        top: 3px;
        background: #fff;
        border-radius: 50%;
        transition: .25s ease;
        box-shadow: 0 2px 5px rgba(0,0,0,.15);
    }

    .availability-switch input:checked + .availability-slider {
        background: #b8923f;
    }

    .availability-switch input:checked + .availability-slider::before {
        transform: translateX(-22px);
    }

    .availability-form-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        padding: 20px 26px;
        background: #faf8f3;
        border-top: 1px solid #eee9df;
    }

    .availability-footer-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .availability-btn-danger {
        background: #fff;
        border-color: #e6c9c9;
        color: #a33a3a;
    }

    .availability-btn-danger:hover {
        background: #fff5f5;
        color: #913434;
    }

    .availability-current-status {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        color: #6d756f;
        font-family: 'Cairo', sans-serif;
        font-size: 12px;
    }

    .availability-current-status i {
        color: #4b8a5a;
    }

    .availability-current-status.inactive i {
        color: #a33a3a;
    }

    @media (max-width: 800px) {
        .availability-form-grid {
            grid-template-columns: 1fr;
        }

        .availability-field-full {
            grid-column: auto;
        }
    }

    @media (max-width: 600px) {
        .availability-form-body {
            padding: 18px;
        }

        .availability-page-header {
            align-items: stretch;
        }

        .availability-header-actions {
            width: 100%;
        }

        .availability-header-actions .availability-btn {
            flex: 1;
        }

        .availability-time-row {
            grid-template-columns: 1fr;
        }

        .availability-form-footer {
            padding: 17px;
            align-items: stretch;
            flex-direction: column;
        }

        .availability-footer-actions {
            width: 100%;
        }

        .availability-footer-actions .availability-btn {
            flex: 1;
        }
    }
</style>
@endpush


@section('content')

<div class="availability-edit-page">

    {{-- ==================================================
        PAGE HEADER
    ================================================== --}}

    <div class="availability-page-header">

        <div class="availability-page-title">

            <div class="availability-page-title-icon">
                <i class="fa-solid fa-pen"></i>
            </div>

            <div>

                <h1>
                    {{ __('education_admin.availability_edit.title') }}
                </h1>

                <p>
                    {{ __('education_admin.availability_edit.description', ['id' => $availability->id]) }}
                </p>

            </div>

        </div>


        <div class="availability-header-actions">

            <a
                href="{{ route('education.admin.availabilities.index') }}"
                class="availability-btn availability-btn-secondary"
            >
                <i class="fa-solid fa-arrow-right"></i>
                {{ __('education_admin.availability_edit.back') }}
            </a>

            <a
                href="{{ route('education.admin.availabilities.show', $availability) }}"
                class="availability-btn availability-btn-secondary"
            >
                <i class="fa-regular fa-eye"></i>
                {{ __('education_admin.availability_edit.view') }}
            </a>

        </div>

    </div>


    {{-- ==================================================
        VALIDATION ERRORS
    ================================================== --}}

    @if($errors->any())

        <div
            style="
                margin-bottom:20px;
                padding:15px 18px;
                border-radius:12px;
                background:#fff4f4;
                border:1px solid #ebcccc;
                color:#963d3d;
                font-family:'Cairo',sans-serif;
                font-size:13px;
            "
        >

            <strong>
                {{ __('education_admin.availability_edit.review_data') }}
            </strong>

            <ul style="margin:8px 0 0; padding-right:20px;">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- ==================================================
        FORM
    ================================================== --}}

    <form
        method="POST"
        action="{{ route('education.admin.availabilities.update', $availability) }}"
        class="availability-form-card"
    >

        @csrf

        @method('PUT')


        <div class="availability-card-header">

            <h2>
                {{ __('education_admin.availability_edit.form_title') }}
            </h2>

            <p>
                {{ __('education_admin.availability_edit.form_description') }}
            </p>

        </div>


        <div class="availability-form-body">

            <div class="availability-form-grid">


                {{-- ==================================================
                    DAY
                ================================================== --}}

                <div class="availability-field">

                    <label
                        for="day_of_week"
                        class="availability-label"
                    >
                        {{ __('education_admin.availability_edit.day') }}

                        <span class="availability-required">*</span>
                    </label>

                    <select
                        name="day_of_week"
                        id="day_of_week"
                        class="availability-select"
                        required
                    >

                        <option value="">
                            {{ __('education_admin.availability_edit.select_day') }}
                        </option>

                        <option
                            value="0"
                            {{ old('day_of_week', $availability->day_of_week) == 0 ? 'selected' : '' }}
                        >
                            {{ __('education_admin.availability_edit.days.0') }}
                        </option>

                        <option
                            value="1"
                            {{ old('day_of_week', $availability->day_of_week) == 1 ? 'selected' : '' }}
                        >
                            {{ __('education_admin.availability_edit.days.1') }}
                        </option>

                        <option
                            value="2"
                            {{ old('day_of_week', $availability->day_of_week) == 2 ? 'selected' : '' }}
                        >
                            {{ __('education_admin.availability_edit.days.2') }}
                        </option>

                        <option
                            value="3"
                            {{ old('day_of_week', $availability->day_of_week) == 3 ? 'selected' : '' }}
                        >
                            {{ __('education_admin.availability_edit.days.3') }}
                        </option>

                        <option
                            value="4"
                            {{ old('day_of_week', $availability->day_of_week) == 4 ? 'selected' : '' }}
                        >
                            {{ __('education_admin.availability_edit.days.4') }}
                        </option>

                        <option
                            value="5"
                            {{ old('day_of_week', $availability->day_of_week) == 5 ? 'selected' : '' }}
                        >
                            {{ __('education_admin.availability_edit.days.5') }}
                        </option>

                        <option
                            value="6"
                            {{ old('day_of_week', $availability->day_of_week) == 6 ? 'selected' : '' }}
                        >
                            {{ __('education_admin.availability_edit.days.6') }}
                        </option>

                    </select>

                    @error('day_of_week')
                        <div class="availability-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- ==================================================
                    SORT ORDER
                ================================================== --}}

                <div class="availability-field">

                    <label
                        for="sort_order"
                        class="availability-label"
                    >
                        {{ __('education_admin.availability_edit.display_order') }}
                    </label>

                    <input
                        type="number"
                        name="sort_order"
                        id="sort_order"
                        min="0"
                        value="{{ old('sort_order', $availability->sort_order) }}"
                        class="availability-input"
                        placeholder="{{ __('education_admin.availability_edit.display_order_placeholder') }}"
                    >

                    <div class="availability-help">
                        {{ __('education_admin.availability_edit.display_order_help') }}
                    </div>

                    @error('sort_order')
                        <div class="availability-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- ==================================================
                    TIME
                ================================================== --}}

                <div class="availability-field availability-field-full">

                    <label class="availability-label">

                        {{ __('education_admin.availability_edit.appointment_time') }}

                        <span class="availability-required">*</span>

                    </label>

                    <div class="availability-time-row">

                        <div class="availability-time-wrapper">

                            <i class="fa-regular fa-clock"></i>

                            <input
                                type="time"
                                name="start_time"
                                value="{{ old('start_time', \Carbon\Carbon::parse($availability->start_time)->format('H:i')) }}"
                                class="availability-input"
                                required
                            >

                        </div>


                        <div class="availability-time-wrapper">

                            <i class="fa-regular fa-clock"></i>

                            <input
                                type="time"
                                name="end_time"
                                value="{{ old('end_time', \Carbon\Carbon::parse($availability->end_time)->format('H:i')) }}"
                                class="availability-input"
                                required
                            >

                        </div>

                    </div>

                    <div class="availability-help">
                        {{ __('education_admin.availability_edit.time_help') }}
                    </div>

                    @error('start_time')
                        <div class="availability-error">
                            {{ $message }}
                        </div>
                    @enderror

                    @error('end_time')
                        <div class="availability-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- ==================================================
                    LABEL
                ================================================== --}}

                <div class="availability-field availability-field-full">

                    <label
                        for="label"
                        class="availability-label"
                    >
                        {{ __('education_admin.availability_edit.label') }}
                    </label>

                    <input
                        type="text"
                        name="label"
                        id="label"
                        maxlength="255"
                        value="{{ old('label', $availability->label) }}"
                        class="availability-input"
                        placeholder="{{ __('education_admin.availability_edit.label_placeholder') }}"
                    >

                    <div class="availability-help">
                        {{ __('education_admin.availability_edit.label_help') }}
                    </div>

                    @error('label')
                        <div class="availability-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- ==================================================
                    STATUS
                ================================================== --}}

                <div class="availability-field availability-field-full">

                    <div class="availability-switch-box">

                        <div class="availability-switch-text">

                            <strong>
                                {{ __('education_admin.availability_edit.activate_time') }}
                            </strong>

                            <span>
                                {{ __('education_admin.availability_edit.activate_description') }}
                            </span>

                        </div>


                        <label class="availability-switch">

                            <input
                                type="checkbox"
                                name="is_active"
                                value="1"
                                {{ old('is_active', $availability->is_active) ? 'checked' : '' }}
                            >

                            <span class="availability-slider"></span>

                        </label>

                    </div>

                    @error('is_active')
                        <div class="availability-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

            </div>

        </div>


        {{-- ==================================================
            FORM FOOTER
        ================================================== --}}

        <div class="availability-form-footer">

            <div
                class="availability-current-status
                {{ $availability->is_active ? '' : 'inactive' }}"
            >

                <i class="fa-solid fa-circle"></i>

                {{ $availability->is_active
                    ? __('education_admin.availability_edit.current_active')
                    : __('education_admin.availability_edit.current_inactive')
                }}

            </div>


            <div class="availability-footer-actions">

                <a
                    href="{{ route('education.admin.availabilities.index') }}"
                    class="availability-btn availability-btn-secondary"
                >
                    {{ __('education_admin.availability_edit.cancel') }}
                </a>

                <button
                    type="submit"
                    class="availability-btn availability-btn-primary"
                >
                    <i class="fa-solid fa-floppy-disk"></i>

                    {{ __('education_admin.availability_edit.save_changes') }}

                </button>

            </div>

        </div>

    </form>

</div>

@endsection
