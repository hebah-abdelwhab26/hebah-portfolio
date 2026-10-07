@extends('education.admin.layouts.app')

@section('title', __('education_admin.lessons.create.page_title'))

@section('content')

<div class="education-admin-lessons-create-page">

    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}

    <div class="education-admin-lessons-create-header">

        <div class="education-admin-lessons-create-heading">

            <span class="education-admin-page-header-label">
                <i class="fa-solid fa-book-open"></i>
                {{ __('education_admin.lessons.create.header_label') }}
            </span>

            <h2>
                {{ __('education_admin.lessons.create.title') }}
            </h2>

            <p>
                {{ __('education_admin.lessons.create.description') }}
            </p>

        </div>

        <div class="education-admin-lessons-create-header-actions">

            <a
                href="{{ route('education.admin.lessons.index') }}"
                class="education-admin-lessons-back-button"
            >
                <i class="fa-solid fa-arrow-right"></i>
                {{ __('education_admin.lessons.create.back') }}
            </a>

        </div>

    </div>


    {{-- =========================================================
        VALIDATION ERRORS
    ========================================================== --}}

    @if ($errors->any())

        <div class="education-admin-lessons-create-alert error">

            <div class="education-admin-lessons-create-alert-icon">

                <i class="fa-solid fa-circle-exclamation"></i>

            </div>

            <div>

                <strong>
                    {{ __('education_admin.lessons.create.validation_title') }}
                </strong>

                <ul>

                    @foreach ($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        </div>

    @endif


    {{-- =========================================================
        FORM
    ========================================================== --}}

    <form
        action="{{ route('education.admin.lessons.store') }}"
        method="POST"
        class="education-admin-lessons-create-form"
    >

        @csrf


        {{-- =====================================================
            BASIC INFORMATION
        ====================================================== --}}

        <div class="education-admin-lessons-form-card">

            <div class="education-admin-lessons-form-card-header">

                <div class="education-admin-lessons-form-card-icon">

                    <i class="fa-solid fa-circle-info"></i>

                </div>

                <div>

                    <span>
                        {{ __('education_admin.lessons.create.basic_information') }}
                    </span>

                    <h3>
                        {{ __('education_admin.lessons.create.lesson_data') }}
                    </h3>

                </div>

            </div>


            <div class="education-admin-lessons-form-grid">


                {{-- TITLE --}}

                <div class="education-admin-form-group full">

                    <label for="title">

                        {{ __('education_admin.lessons.create.title_label') }}

                        <span>
                            *
                        </span>

                    </label>

                    <div class="education-admin-input-wrapper">

                        <i class="fa-solid fa-book"></i>

                        <input
                            type="text"
                            id="title"
                            name="title"
                            value="{{ old('title') }}"
                            placeholder="{{ __('education_admin.lessons.create.title_placeholder') }}"
                            required
                        >

                    </div>

                    @error('title')

                        <small class="education-admin-form-error">
                            {{ $message }}
                        </small>

                    @enderror

                </div>


                {{-- CATEGORY --}}

                <div class="education-admin-form-group">

                    <label for="category">
                        {{ __('education_admin.lessons.create.category') }}
                    </label>

                    <div class="education-admin-input-wrapper">

                        <i class="fa-solid fa-layer-group"></i>

                        <input
                            type="text"
                            id="category"
                            name="category"
                            value="{{ old('category') }}"
                            placeholder="{{ __('education_admin.lessons.create.category_placeholder') }}"
                        >

                    </div>

                    @error('category')

                        <small class="education-admin-form-error">
                            {{ $message }}
                        </small>

                    @enderror

                </div>


                {{-- DURATION --}}

                <div class="education-admin-form-group">

                    <label for="duration">

                        {{ __('education_admin.lessons.create.duration') }}

                        <span>
                            *
                        </span>

                    </label>

                    <div class="education-admin-input-wrapper">

                        <i class="fa-regular fa-clock"></i>

                        <input
                            type="number"
                            id="duration"
                            name="duration"
                            value="{{ old('duration', 60) }}"
                            min="1"
                            required
                        >

                        <span class="education-admin-input-suffix">
                            {{ __('education_admin.lessons.create.minute') }}
                        </span>

                    </div>

                    @error('duration')

                        <small class="education-admin-form-error">
                            {{ $message }}
                        </small>

                    @enderror

                </div>


                {{-- DESCRIPTION --}}

                <div class="education-admin-form-group full">

                    <label for="description">
                        {{ __('education_admin.lessons.create.description_label') }}
                    </label>

                    <div class="education-admin-textarea-wrapper">

                        <i class="fa-solid fa-align-right"></i>

                        <textarea
                            id="description"
                            name="description"
                            rows="5"
                            placeholder="{{ __('education_admin.lessons.create.description_placeholder') }}"
                        >{{ old('description') }}</textarea>

                    </div>

                    @error('description')

                        <small class="education-admin-form-error">
                            {{ $message }}
                        </small>

                    @enderror

                </div>

            </div>

        </div>


        {{-- =====================================================
            PRICE & SETTINGS
        ====================================================== --}}

        <div class="education-admin-lessons-form-card">

            <div class="education-admin-lessons-form-card-header">

                <div class="education-admin-lessons-form-card-icon gold">

                    <i class="fa-solid fa-coins"></i>

                </div>

                <div>

                    <span>
                        {{ __('education_admin.lessons.create.price_settings') }}
                    </span>

                    <h3>
                        {{ __('education_admin.lessons.create.lesson_settings') }}
                    </h3>

                </div>

            </div>


            <div class="education-admin-lessons-form-grid">


                {{-- PRICE --}}

                <div class="education-admin-form-group">

                    <label for="price">

                        {{ __('education_admin.lessons.create.price') }}

                        <span>
                            *
                        </span>

                    </label>

                    <div class="education-admin-input-wrapper">

                        <i class="fa-solid fa-money-bill-wave"></i>

                        <input
                            type="number"
                            id="price"
                            name="price"
                            value="{{ old('price', 0) }}"
                            min="0"
                            step="0.01"
                            required
                        >

                        <span class="education-admin-input-suffix">
                            {{ __('education_admin.lessons.create.riyal') }}
                        </span>

                    </div>

                    @error('price')

                        <small class="education-admin-form-error">
                            {{ $message }}
                        </small>

                    @enderror

                </div>


                {{-- CURRENCY --}}

                <div class="education-admin-form-group">

                    <label for="currency">
                        {{ __('education_admin.lessons.create.currency') }}
                    </label>

                    <div class="education-admin-input-wrapper">

                        <i class="fa-solid fa-coins"></i>

                        <select
                            id="currency"
                            name="currency"
                        >

                            <option
                                value="SAR"
                                {{ old('currency', 'SAR') === 'SAR' ? 'selected' : '' }}
                            >
                                {{ __('education_admin.lessons.create.currencies.sar') }}
                            </option>

                            <option
                                value="USD"
                                {{ old('currency') === 'USD' ? 'selected' : '' }}
                            >
                                {{ __('education_admin.lessons.create.currencies.usd') }}
                            </option>

                            <option
                                value="EUR"
                                {{ old('currency') === 'EUR' ? 'selected' : '' }}
                            >
                                {{ __('education_admin.lessons.create.currencies.eur') }}
                            </option>

                        </select>

                    </div>

                    @error('currency')

                        <small class="education-admin-form-error">
                            {{ $message }}
                        </small>

                    @enderror

                </div>


                {{-- SORT ORDER --}}

                <div class="education-admin-form-group">

                    <label for="sort_order">
                        {{ __('education_admin.lessons.create.sort_order') }}
                    </label>

                    <div class="education-admin-input-wrapper">

                        <i class="fa-solid fa-arrow-down-1-9"></i>

                        <input
                            type="number"
                            id="sort_order"
                            name="sort_order"
                            value="{{ old('sort_order', 0) }}"
                            min="0"
                        >

                    </div>

                    <small class="education-admin-form-help">
                        {{ __('education_admin.lessons.create.sort_order_help') }}
                    </small>

                    @error('sort_order')

                        <small class="education-admin-form-error">
                            {{ $message }}
                        </small>

                    @enderror

                </div>


                {{-- ACTIVE STATUS --}}

                <div class="education-admin-form-group">

                    <label>
                        {{ __('education_admin.lessons.create.status') }}
                    </label>

                    <label
                        class="education-admin-status-switch"
                        for="is_active"
                    >

                        <input
                            type="checkbox"
                            id="is_active"
                            name="is_active"
                            value="1"
                            {{ old('is_active', true) ? 'checked' : '' }}
                        >

                        <span class="education-admin-status-switch-slider"></span>

                        <span class="education-admin-status-switch-content">

                            <strong>
                                {{ __('education_admin.lessons.create.active_lesson') }}
                            </strong>

                            <small>
                                {{ __('education_admin.lessons.create.active_lesson_help') }}
                            </small>

                        </span>

                    </label>

                </div>

            </div>

        </div>


        {{-- =====================================================
            INFORMATION NOTE
        ====================================================== --}}

        <div class="education-admin-lessons-create-note">

            <div class="education-admin-lessons-create-note-icon">

                <i class="fa-solid fa-lightbulb"></i>

            </div>

            <div>

                <strong>
                    {{ __('education_admin.lessons.create.note_title') }}
                </strong>

                <p>
                    {{ __('education_admin.lessons.create.note_description') }}
                </p>

            </div>

        </div>


        {{-- =====================================================
            FORM ACTIONS
        ====================================================== --}}

        <div class="education-admin-lessons-create-actions">

            <a
                href="{{ route('education.admin.lessons.index') }}"
                class="education-admin-lessons-cancel-button"
            >
                {{ __('education_admin.lessons.create.cancel') }}
            </a>

            <button
                type="submit"
                class="education-admin-lessons-save-button"
            >

                <i class="fa-solid fa-check"></i>

                {{ __('education_admin.lessons.create.save') }}

            </button>

        </div>

    </form>

</div>

@endsection
