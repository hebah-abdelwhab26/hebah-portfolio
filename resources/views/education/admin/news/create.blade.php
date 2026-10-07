@extends('education.admin.layouts.app')

@section('title', __('education_admin.news_create.page_title'))

@section('content')

<style>
    /* =========================================================
       EDUCATION ADMIN — NEWS CREATE
       ========================================================= */

    .education-admin-news-create-page {
        direction: {{ session('education_locale', 'ar') === 'en' ? 'ltr' : 'rtl' }};
        padding: 30px;
        min-height: calc(100vh - 80px);
        background:
            radial-gradient(circle at 90% 10%, rgba(154, 123, 47, 0.08), transparent 28%),
            radial-gradient(circle at 10% 90%, rgba(35, 93, 112, 0.07), transparent 30%),
            #f8f4e9;
    }

    .education-admin-news-create-container {
        max-width: 1100px;
        margin: 0 auto;
    }

    /* =========================================================
       HEADER
       ========================================================= */

    .education-admin-news-create-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 30px;
    }

    .education-admin-news-create-heading {
        flex: 1;
    }

    .education-admin-news-create-label {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 10px;
        padding: 7px 14px;
        border-radius: 30px;
        background: rgba(154, 123, 47, 0.10);
        color: #8a6d28;
        font-size: 13px;
        font-weight: 700;
    }

    .education-admin-news-create-label i {
        font-size: 12px;
    }

    .education-admin-news-create-header h1 {
        margin: 0 0 8px;
        color: #173f4d;
        font-family: "Amiri", serif;
        font-size: 34px;
        line-height: 1.3;
    }

    .education-admin-news-create-header p {
        margin: 0;
        color: #6b7280;
        font-size: 15px;
        line-height: 1.8;
    }

    .education-admin-news-create-back {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        padding: 12px 18px;
        border: 1px solid rgba(35, 93, 112, 0.14);
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.75);
        color: #235d70;
        font-size: 14px;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.25s ease;
        white-space: nowrap;
    }

    .education-admin-news-create-back:hover {
        background: #235d70;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(35, 93, 112, 0.15);
    }

    /* =========================================================
       ALERT
       ========================================================= */

    .education-admin-news-create-alert {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        margin-bottom: 22px;
        padding: 15px 18px;
        border: 1px solid rgba(185, 28, 28, 0.14);
        border-radius: 14px;
        background: rgba(254, 226, 226, 0.75);
        color: #991b1b;
    }

    .education-admin-news-create-alert i {
        margin-top: 3px;
        font-size: 17px;
    }

    .education-admin-news-create-alert strong {
        display: block;
        margin-bottom: 4px;
        font-size: 14px;
    }

    .education-admin-news-create-alert ul {
        margin: 0;
        padding-right: 18px;
        padding-left: 0;
        font-size: 13px;
        line-height: 1.8;
    }

    /* =========================================================
       FORM CARD
       ========================================================= */

    .education-admin-news-create-card {
        overflow: hidden;
        border: 1px solid rgba(35, 93, 112, 0.09);
        border-radius: 22px;
        background: rgba(255, 255, 255, 0.90);
        box-shadow: 0 15px 45px rgba(20, 47, 56, 0.08);
        backdrop-filter: blur(10px);
    }

    .education-admin-news-create-card-header {
        padding: 25px 28px;
        border-bottom: 1px solid rgba(35, 93, 112, 0.08);
        background: linear-gradient(
            135deg,
            rgba(35, 93, 112, 0.04),
            rgba(154, 123, 47, 0.04)
        );
    }

    .education-admin-news-create-card-header h2 {
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 0 0 7px;
        color: #173f4d;
        font-size: 20px;
        font-weight: 800;
    }

    .education-admin-news-create-card-header h2 i {
        color: #9a7b2f;
    }

    .education-admin-news-create-card-header p {
        margin: 0;
        color: #7b8490;
        font-size: 13px;
        line-height: 1.8;
    }

    .education-admin-news-create-form {
        padding: 30px;
    }

    /* =========================================================
       FORM GRID
       ========================================================= */

    .education-admin-news-create-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 22px;
    }

    .education-admin-news-create-field-full {
        grid-column: 1 / -1;
    }

    .education-admin-news-create-field label {
        display: block;
        margin-bottom: 9px;
        color: #294854;
        font-size: 14px;
        font-weight: 800;
    }

    .education-admin-news-create-required {
        color: #b45309;
    }

    .education-admin-news-create-field input,
    .education-admin-news-create-field select,
    .education-admin-news-create-field textarea {
        width: 100%;
        box-sizing: border-box;
        border: 1px solid #dfe5e7;
        border-radius: 12px;
        background: #fff;
        color: #263f48;
        font-family: inherit;
        font-size: 14px;
        outline: none;
        transition: all 0.25s ease;
    }

    .education-admin-news-create-field input,
    .education-admin-news-create-field select {
        min-height: 48px;
        padding: 0 14px;
    }

    .education-admin-news-create-field textarea {
        min-height: 145px;
        padding: 13px 14px;
        resize: vertical;
        line-height: 1.8;
    }

    .education-admin-news-create-field input:focus,
    .education-admin-news-create-field select:focus,
    .education-admin-news-create-field textarea:focus {
        border-color: rgba(35, 93, 112, 0.55);
        box-shadow: 0 0 0 4px rgba(35, 93, 112, 0.08);
    }

    .education-admin-news-create-field input::placeholder,
    .education-admin-news-create-field textarea::placeholder {
        color: #a5adb2;
    }

    .education-admin-news-create-help {
        margin-top: 7px;
        color: #8a949a;
        font-size: 12px;
        line-height: 1.7;
    }

    .education-admin-news-create-error {
        margin-top: 7px;
        color: #b91c1c;
        font-size: 12px;
        font-weight: 600;
    }

    /* =========================================================
       PUBLISHING SETTINGS
       ========================================================= */

    .education-admin-news-create-publishing {
        margin-top: 28px;
        padding: 22px;
        border: 1px solid rgba(154, 123, 47, 0.13);
        border-radius: 16px;
        background: rgba(154, 123, 47, 0.035);
    }

    .education-admin-news-create-publishing-title {
        display: flex;
        align-items: center;
        gap: 9px;
        margin-bottom: 18px;
        color: #294854;
        font-size: 16px;
        font-weight: 800;
    }

    .education-admin-news-create-publishing-title i {
        color: #9a7b2f;
    }

    .education-admin-news-create-options {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
    }

    .education-admin-news-create-option {
        position: relative;
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 16px;
        border: 1px solid rgba(35, 93, 112, 0.10);
        border-radius: 13px;
        background: rgba(255, 255, 255, 0.75);
        transition: all 0.25s ease;
        cursor: pointer;
    }

    .education-admin-news-create-option:hover {
        border-color: rgba(35, 93, 112, 0.22);
        transform: translateY(-1px);
    }

    .education-admin-news-create-option input {
        width: 18px;
        height: 18px;
        margin: 2px 0 0;
        accent-color: #235d70;
        flex-shrink: 0;
    }

    .education-admin-news-create-option-content {
        flex: 1;
    }

    .education-admin-news-create-option-title {
        margin-bottom: 4px;
        color: #294854;
        font-size: 13px;
        font-weight: 800;
    }

    .education-admin-news-create-option-description {
        color: #7c878d;
        font-size: 12px;
        line-height: 1.7;
    }

    /* =========================================================
       FOOTER
       ========================================================= */

    .education-admin-news-create-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-top: 30px;
        padding-top: 25px;
        border-top: 1px solid rgba(35, 93, 112, 0.08);
    }

    .education-admin-news-create-footer-note {
        display: flex;
        align-items: flex-start;
        gap: 9px;
        color: #7d878c;
        font-size: 12px;
        line-height: 1.7;
    }

    .education-admin-news-create-footer-note i {
        margin-top: 3px;
        color: #9a7b2f;
    }

    .education-admin-news-create-actions {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-shrink: 0;
    }

    .education-admin-news-create-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        min-height: 46px;
        padding: 0 20px;
        border-radius: 11px;
        font-family: inherit;
        font-size: 14px;
        font-weight: 800;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.25s ease;
    }

    .education-admin-news-create-btn-cancel {
        border: 1px solid #dfe5e7;
        background: #fff;
        color: #65727a;
    }

    .education-admin-news-create-btn-cancel:hover {
        border-color: #cbd5d9;
        background: #f8fafb;
    }

    .education-admin-news-create-btn-submit {
        border: 1px solid #235d70;
        background: #235d70;
        color: #fff;
        box-shadow: 0 8px 20px rgba(35, 93, 112, 0.18);
    }

    .education-admin-news-create-btn-submit:hover {
        background: #1d5060;
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(35, 93, 112, 0.23);
    }

    /* =========================================================
       RESPONSIVE
       ========================================================= */

    @media (max-width: 850px) {

        .education-admin-news-create-page {
            padding: 22px 16px;
        }

        .education-admin-news-create-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .education-admin-news-create-back {
            width: 100%;
            justify-content: center;
            box-sizing: border-box;
        }

        .education-admin-news-create-grid {
            grid-template-columns: 1fr;
        }

        .education-admin-news-create-field-full {
            grid-column: auto;
        }

        .education-admin-news-create-options {
            grid-template-columns: 1fr;
        }

        .education-admin-news-create-footer {
            align-items: stretch;
            flex-direction: column;
        }

        .education-admin-news-create-actions {
            width: 100%;
        }

        .education-admin-news-create-btn {
            flex: 1;
        }
    }

    @media (max-width: 560px) {

        .education-admin-news-create-header h1 {
            font-size: 28px;
        }

        .education-admin-news-create-card-header,
        .education-admin-news-create-form {
            padding: 20px;
        }

        .education-admin-news-create-actions {
            flex-direction: column;
        }

        .education-admin-news-create-btn {
            width: 100%;
        }
    }
</style>

<div class="education-admin-news-create-page">

    <div class="education-admin-news-create-container">

        {{-- =====================================================
            HEADER
        ====================================================== --}}

        <div class="education-admin-news-create-header">

            <div class="education-admin-news-create-heading">

                <div class="education-admin-news-create-label">
                    <i class="fa-solid fa-newspaper"></i>
                    {{ __('education_admin.news_create.header_label') }}
                </div>

                <h1>
                    {{ __('education_admin.news_create.title') }}
                </h1>

                <p>
                    {{ __('education_admin.news_create.description') }}
                </p>

            </div>

            <a
                href="{{ route('education.admin.news.index') }}"
                class="education-admin-news-create-back"
            >
                <i class="fa-solid fa-arrow-right"></i>
                {{ __('education_admin.news_create.actions.back') }}
            </a>

        </div>


        {{-- =====================================================
            VALIDATION ERRORS
        ====================================================== --}}

        @if ($errors->any())

            <div class="education-admin-news-create-alert">

                <i class="fa-solid fa-circle-exclamation"></i>

                <div>

                    <strong>
                        {{ __('education_admin.news_create.alerts.validation_title') }}
                    </strong>

                    <ul>
                        @foreach ($errors->all() as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>

                </div>

            </div>

        @endif


        {{-- =====================================================
            FORM CARD
        ====================================================== --}}

        <div class="education-admin-news-create-card">

            <div class="education-admin-news-create-card-header">

                <h2>
                    <i class="fa-solid fa-pen-to-square"></i>

                    {{ __('education_admin.news_create.form.title') }}
                </h2>

                <p>
                    {{ __('education_admin.news_create.form.description') }}
                </p>

            </div>


            <form
                action="{{ route('education.admin.news.store') }}"
                method="POST"
                class="education-admin-news-create-form"
            >

                @csrf


                {{-- =================================================
                    BASIC INFORMATION
                ================================================== --}}

                <div class="education-admin-news-create-grid">

                    {{-- TITLE --}}

                    <div class="education-admin-news-create-field education-admin-news-create-field-full">

                        <label for="title">
                            {{ __('education_admin.news_create.fields.title') }}

                            <span class="education-admin-news-create-required">
                                {{ __('education_admin.news_create.required') }}
                            </span>
                        </label>

                        <input
                            type="text"
                            id="title"
                            name="title"
                            value="{{ old('title') }}"
                            placeholder="{{ __('education_admin.news_create.fields.title_placeholder') }}"
                            required
                        >

                        @error('title')
                            <div class="education-admin-news-create-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- TYPE --}}

                    <div class="education-admin-news-create-field">

                        <label for="type">
                            {{ __('education_admin.news_create.fields.type') }}

                            <span class="education-admin-news-create-required">
                                {{ __('education_admin.news_create.required') }}
                            </span>
                        </label>

                        <select
                            id="type"
                            name="type"
                            required
                        >

                            <option value="">
                                {{ __('education_admin.news_create.fields.type_placeholder') }}
                            </option>

                            <option
                                value="announcement"
                                @selected(old('type') === 'announcement')
                            >
                                {{ __('education_admin.news_create.types.announcement') }}
                            </option>

                            <option
                                value="lesson"
                                @selected(old('type') === 'lesson')
                            >
                                {{ __('education_admin.news_create.types.lesson') }}
                            </option>

                            <option
                                value="update"
                                @selected(old('type') === 'update')
                            >
                                {{ __('education_admin.news_create.types.update') }}
                            </option>

                            <option
                                value="notice"
                                @selected(old('type') === 'notice')
                            >
                                {{ __('education_admin.news_create.types.notice') }}
                            </option>

                            <option
                                value="general"
                                @selected(old('type') === 'general')
                            >
                                {{ __('education_admin.news_create.types.general') }}
                            </option>

                        </select>

                        @error('type')
                            <div class="education-admin-news-create-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- SORT ORDER --}}

                    <div class="education-admin-news-create-field">

                        <label for="sort_order">
                            {{ __('education_admin.news_create.fields.sort_order') }}
                        </label>

                        <input
                            type="number"
                            id="sort_order"
                            name="sort_order"
                            value="{{ old('sort_order', 0) }}"
                            min="0"
                            placeholder="{{ __('education_admin.news_create.fields.sort_order_placeholder') }}"
                        >

                        <div class="education-admin-news-create-help">
                            {{ __('education_admin.news_create.help.sort_order') }}
                        </div>

                        @error('sort_order')
                            <div class="education-admin-news-create-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- CONTENT --}}

                    <div class="education-admin-news-create-field education-admin-news-create-field-full">

                        <label for="content">
                            {{ __('education_admin.news_create.fields.content') }}

                            <span class="education-admin-news-create-required">
                                {{ __('education_admin.news_create.required') }}
                            </span>
                        </label>

                        <textarea
                            id="content"
                            name="content"
                            placeholder="{{ __('education_admin.news_create.fields.content_placeholder') }}"
                            required
                        >{{ old('content') }}</textarea>

                        <div class="education-admin-news-create-help">
                            {{ __('education_admin.news_create.help.content') }}
                        </div>

                        @error('content')
                            <div class="education-admin-news-create-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- LINK --}}

                    <div class="education-admin-news-create-field education-admin-news-create-field-full">

                        <label for="link">
                            {{ __('education_admin.news_create.fields.link') }}
                        </label>

                        <input
                            type="url"
                            id="link"
                            name="link"
                            value="{{ old('link') }}"
                            placeholder="{{ __('education_admin.news_create.fields.link_placeholder') }}"
                        >

                        <div class="education-admin-news-create-help">
                            {{ __('education_admin.news_create.help.link') }}
                        </div>

                        @error('link')
                            <div class="education-admin-news-create-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- START DATE --}}

                    <div class="education-admin-news-create-field">

                        <label for="starts_at">
                            {{ __('education_admin.news_create.fields.starts_at') }}
                        </label>

                        <input
                            type="datetime-local"
                            id="starts_at"
                            name="starts_at"
                            value="{{ old('starts_at') }}"
                        >

                        <div class="education-admin-news-create-help">
                            {{ __('education_admin.news_create.help.starts_at') }}
                        </div>

                        @error('starts_at')
                            <div class="education-admin-news-create-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- END DATE --}}

                    <div class="education-admin-news-create-field">

                        <label for="ends_at">
                            {{ __('education_admin.news_create.fields.ends_at') }}
                        </label>

                        <input
                            type="datetime-local"
                            id="ends_at"
                            name="ends_at"
                            value="{{ old('ends_at') }}"
                        >

                        <div class="education-admin-news-create-help">
                            {{ __('education_admin.news_create.help.ends_at') }}
                        </div>

                        @error('ends_at')
                            <div class="education-admin-news-create-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                </div>


                {{-- =================================================
                    PUBLISHING SETTINGS
                ================================================== --}}

                <div class="education-admin-news-create-publishing">

                    <div class="education-admin-news-create-publishing-title">

                        <i class="fa-solid fa-sliders"></i>

                        {{ __('education_admin.news_create.publishing.title') }}

                    </div>


                    <div class="education-admin-news-create-options">

                        {{-- ACTIVE --}}

                        <label class="education-admin-news-create-option">

                            <input
                                type="checkbox"
                                name="is_active"
                                value="1"
                                @checked(old('is_active', true))
                            >

                            <div class="education-admin-news-create-option-content">

                                <div class="education-admin-news-create-option-title">
                                    {{ __('education_admin.news_create.publishing.publish.title') }}
                                </div>

                                <div class="education-admin-news-create-option-description">
                                    {{ __('education_admin.news_create.publishing.publish.description') }}
                                </div>

                            </div>

                        </label>


                        {{-- OPEN IN NEW TAB --}}

                        <label class="education-admin-news-create-option">

                            <input
                                type="checkbox"
                                name="open_in_new_tab"
                                value="1"
                                @checked(old('open_in_new_tab', true))
                            >

                            <div class="education-admin-news-create-option-content">

                                <div class="education-admin-news-create-option-title">
                                    {{ __('education_admin.news_create.publishing.new_tab.title') }}
                                </div>

                                <div class="education-admin-news-create-option-description">
                                    {{ __('education_admin.news_create.publishing.new_tab.description') }}
                                </div>

                            </div>

                        </label>

                    </div>

                </div>


                {{-- =================================================
                    FOOTER
                ================================================== --}}

                <div class="education-admin-news-create-footer">

                    <div class="education-admin-news-create-footer-note">

                        <i class="fa-solid fa-circle-info"></i>

                        <span>
                            {{ __('education_admin.news_create.footer.note') }}
                        </span>

                    </div>


                    <div class="education-admin-news-create-actions">

                        <a
                            href="{{ route('education.admin.news.index') }}"
                            class="education-admin-news-create-btn education-admin-news-create-btn-cancel"
                        >
                            {{ __('education_admin.news_create.actions.cancel') }}
                        </a>

                        <button
                            type="submit"
                            class="education-admin-news-create-btn education-admin-news-create-btn-submit"
                        >
                            <i class="fa-solid fa-plus"></i>

                            {{ __('education_admin.news_create.actions.save') }}
                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection
