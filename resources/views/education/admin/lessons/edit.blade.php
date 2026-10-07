@extends('education.admin.layouts.app')

@section('title', __('education_admin.lessons.edit.page_title'))

@section('content')

<div class="education-admin-lessons-edit-page">

    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}

    <div class="education-admin-lessons-edit-header">

        <div class="education-admin-lessons-edit-heading">

            <span class="education-admin-page-header-label">
                <i class="fa-solid fa-book-open"></i>
                {{ __('education_admin.lessons.edit.header_label') }}
            </span>

            <h2>
                {{ __('education_admin.lessons.edit.title') }}
            </h2>

            <p>
                {{ __('education_admin.lessons.edit.description') }}
            </p>

        </div>


        <div class="education-admin-lessons-edit-header-actions">

            <a
                href="{{ route('education.admin.lessons.show', $lesson) }}"
                class="education-admin-lessons-edit-view-button"
            >
                <i class="fa-solid fa-eye"></i>
                {{ __('education_admin.lessons.edit.actions.view') }}
            </a>

            <a
                href="{{ route('education.admin.lessons.index') }}"
                class="education-admin-lessons-back-button"
            >
                <i class="fa-solid fa-arrow-right"></i>
                {{ __('education_admin.lessons.edit.actions.back') }}
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
                    {{ __('education_admin.lessons.edit.alerts.validation_title') }}
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
        CURRENT LESSON SUMMARY
    ========================================================== --}}

    <div class="education-admin-lessons-edit-summary">

        <div class="education-admin-lessons-edit-summary-icon">

            <i class="fa-solid fa-book"></i>

        </div>

        <div class="education-admin-lessons-edit-summary-content">

            <span>
                {{ __('education_admin.lessons.edit.summary.current_lesson') }}
            </span>

            <strong>
                {{ $lesson->title }}
            </strong>

            <small>
                /{{ $lesson->slug }}
            </small>

        </div>


        <div class="education-admin-lessons-edit-summary-status">

            @if ($lesson->is_active)

                <span class="education-admin-lesson-status active">

                    <i class="fa-solid fa-circle-check"></i>

                    {{ __('education_admin.lessons.edit.summary.active') }}

                </span>

            @else

                <span class="education-admin-lesson-status inactive">

                    <i class="fa-solid fa-circle-xmark"></i>

                    {{ __('education_admin.lessons.edit.summary.inactive') }}

                </span>

            @endif

        </div>

    </div>


    {{-- =========================================================
        FORM
    ========================================================== --}}

    <form
        action="{{ route('education.admin.lessons.update', $lesson) }}"
        method="POST"
        class="education-admin-lessons-edit-form"
    >

        @csrf

        @method('PUT')


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
                        {{ __('education_admin.lessons.edit.basic_information.label') }}
                    </span>

                    <h3>
                        {{ __('education_admin.lessons.edit.basic_information.title') }}
                    </h3>

                </div>

            </div>


            <div class="education-admin-lessons-form-grid">


                {{-- TITLE --}}

                <div class="education-admin-form-group full">

                    <label for="title">

                        {{ __('education_admin.lessons.edit.basic_information.lesson_title') }}

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
                            value="{{ old('title', $lesson->title) }}"
                            placeholder="{{ __('education_admin.lessons.edit.basic_information.title_placeholder') }}"
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
                        {{ __('education_admin.lessons.edit.basic_information.category') }}
                    </label>

                    <div class="education-admin-input-wrapper">

                        <i class="fa-solid fa-layer-group"></i>

                        <input
                            type="text"
                            id="category"
                            name="category"
                            value="{{ old('category', $lesson->category) }}"
                            placeholder="{{ __('education_admin.lessons.edit.basic_information.category_placeholder') }}"
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

                        {{ __('education_admin.lessons.edit.basic_information.duration') }}

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
                            value="{{ old('duration', $lesson->duration) }}"
                            min="1"
                            required
                        >

                        <span class="education-admin-input-suffix">
                            {{ __('education_admin.lessons.edit.basic_information.minute') }}
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
                        {{ __('education_admin.lessons.edit.basic_information.description') }}
                    </label>

                    <div class="education-admin-textarea-wrapper">

                        <i class="fa-solid fa-align-right"></i>

                        <textarea
                            id="description"
                            name="description"
                            rows="5"
                            placeholder="{{ __('education_admin.lessons.edit.basic_information.description_placeholder') }}"
                        >{{ old('description', $lesson->description) }}</textarea>

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
                        {{ __('education_admin.lessons.edit.settings.label') }}
                    </span>

                    <h3>
                        {{ __('education_admin.lessons.edit.settings.title') }}
                    </h3>

                </div>

            </div>


            <div class="education-admin-lessons-form-grid">


                {{-- PRICE --}}

                <div class="education-admin-form-group">

                    <label for="price">

                        {{ __('education_admin.lessons.edit.settings.price') }}

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
                            value="{{ old('price', $lesson->price) }}"
                            min="0"
                            step="0.01"
                            required
                        >

                        <span class="education-admin-input-suffix">
                            {{ __('education_admin.lessons.edit.settings.riyal') }}
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
                        {{ __('education_admin.lessons.edit.settings.currency') }}
                    </label>

                    <div class="education-admin-input-wrapper">

                        <i class="fa-solid fa-coins"></i>

                        <select
                            id="currency"
                            name="currency"
                        >

                            <option
                                value="SAR"
                                {{ old('currency', $lesson->currency) === 'SAR' ? 'selected' : '' }}
                            >
                                {{ __('education_admin.lessons.edit.settings.currencies.sar') }}
                            </option>

                            <option
                                value="USD"
                                {{ old('currency', $lesson->currency) === 'USD' ? 'selected' : '' }}
                            >
                                {{ __('education_admin.lessons.edit.settings.currencies.usd') }}
                            </option>

                            <option
                                value="EUR"
                                {{ old('currency', $lesson->currency) === 'EUR' ? 'selected' : '' }}
                            >
                                {{ __('education_admin.lessons.edit.settings.currencies.eur') }}
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
                        {{ __('education_admin.lessons.edit.settings.sort_order') }}
                    </label>

                    <div class="education-admin-input-wrapper">

                        <i class="fa-solid fa-arrow-down-1-9"></i>

                        <input
                            type="number"
                            id="sort_order"
                            name="sort_order"
                            value="{{ old('sort_order', $lesson->sort_order ?? 0) }}"
                            min="0"
                        >

                    </div>

                    <small class="education-admin-form-help">
                        {{ __('education_admin.lessons.edit.settings.sort_order_help') }}
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
                        {{ __('education_admin.lessons.edit.settings.status') }}
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
                            {{ old('is_active', $lesson->is_active) ? 'checked' : '' }}
                        >

                        <span class="education-admin-status-switch-slider"></span>

                        <span class="education-admin-status-switch-content">

                            <strong>
                                {{ __('education_admin.lessons.edit.settings.active_lesson') }}
                            </strong>

                            <small>
                                {{ __('education_admin.lessons.edit.settings.active_lesson_help') }}
                            </small>

                        </span>

                    </label>

                </div>

            </div>

        </div>


        {{-- =====================================================
            LESSON INFORMATION
        ====================================================== --}}

        <div class="education-admin-lessons-edit-info-grid">


            {{-- CREATED AT --}}

            <div class="education-admin-lessons-edit-info-card">

                <span>
                    {{ __('education_admin.lessons.edit.information.created_at') }}
                </span>

                <strong>
                    {{ $lesson->created_at?->format('Y-m-d') ?? '—' }}
                </strong>

            </div>


            {{-- UPDATED AT --}}

            <div class="education-admin-lessons-edit-info-card">

                <span>
                    {{ __('education_admin.lessons.edit.information.updated_at') }}
                </span>

                <strong>
                    {{ $lesson->updated_at?->format('Y-m-d') ?? '—' }}
                </strong>

            </div>


            {{-- CONTENT --}}

            <div class="education-admin-lessons-edit-info-card">

                <span>
                    {{ __('education_admin.lessons.edit.information.content') }}
                </span>

                <strong>
                    {{ __('education_admin.lessons.edit.information.manage_content') }}
                </strong>

            </div>


            {{-- SLUG --}}

            <div class="education-admin-lessons-edit-info-card">

                <span>
                    {{ __('education_admin.lessons.edit.information.slug') }}
                </span>

                <strong class="slug">
                    /{{ $lesson->slug }}
                </strong>

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
                    {{ __('education_admin.lessons.edit.note.title') }}
                </strong>

                <p>
                    {{ __('education_admin.lessons.edit.note.description') }}
                </p>

            </div>

        </div>


        {{-- =====================================================
            FORM ACTIONS
        ====================================================== --}}

        <div class="education-admin-lessons-edit-actions">

            <a
                href="{{ route('education.admin.lessons.show', $lesson) }}"
                class="education-admin-lessons-edit-cancel-button"
            >
                {{ __('education_admin.lessons.edit.actions.cancel') }}
            </a>

            <button
                type="submit"
                class="education-admin-lessons-edit-save-button"
            >

                <i class="fa-solid fa-floppy-disk"></i>

                {{ __('education_admin.lessons.edit.actions.save') }}

            </button>

        </div>

    </form>

</div>

@endsection
