@extends('education.admin.layouts.app')

@section('title', __('education_admin.news_edit.page_title'))

@section('content')

<style>
    /* =========================================================
       EDUCATION ADMIN NEWS EDIT
       Cream / Olive Green / Gold
    ========================================================= */

    .education-admin-news-edit-page {
        direction: {{ session('education_locale', 'ar') === 'en' ? 'ltr' : 'rtl' }};
        color: #30372a;
        padding-bottom: 60px;
    }

    /* =========================================================
       HEADER
    ========================================================= */

    .education-admin-news-edit-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 25px;
        padding: 24px 26px;
        background: linear-gradient(
            135deg,
            #fffaf0 0%,
            #f7f0df 100%
        );
        border: 1px solid rgba(181, 145, 62, 0.22);
        border-radius: 22px;
        box-shadow: 0 12px 35px rgba(48, 55, 42, 0.07);
    }

    .education-admin-news-edit-heading {
        display: flex;
        align-items: center;
        gap: 15px;
        min-width: 0;
    }

    .education-admin-news-edit-icon {
        width: 54px;
        height: 54px;
        flex: 0 0 54px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 16px;
        background: #596446;
        color: #f7df9b;
        font-size: 21px;
        box-shadow: 0 8px 20px rgba(89, 100, 70, 0.18);
    }

    .education-admin-news-edit-heading-label {
        display: block;
        margin-bottom: 5px;
        color: #a37b25;
        font-size: 12px;
        font-weight: 700;
    }

    .education-admin-news-edit-heading h1 {
        margin: 0;
        color: #30372a;
        font-size: 25px;
        font-weight: 800;
    }

    .education-admin-news-edit-heading p {
        margin: 7px 0 0;
        color: #77796f;
        font-size: 13px;
        line-height: 1.7;
    }

    .education-admin-news-edit-header-actions {
        display: flex;
        align-items: center;
        gap: 9px;
        flex-shrink: 0;
    }

    .education-admin-news-edit-back-btn,
    .education-admin-news-edit-view-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px 16px;
        border-radius: 12px;
        text-decoration: none;
        font-size: 12px;
        font-weight: 700;
        transition: 0.2s ease;
    }

    .education-admin-news-edit-back-btn {
        background: #fffdf8;
        border: 1px solid #ded3bc;
        color: #606755;
    }

    .education-admin-news-edit-back-btn:hover {
        background: #f4eddf;
        border-color: #cdbb95;
        color: #4d5542;
    }

    .education-admin-news-edit-view-btn {
        background: #edf1e8;
        border: 1px solid #d6dfcf;
        color: #556244;
    }

    .education-admin-news-edit-view-btn:hover {
        background: #e2e9dc;
        color: #465336;
    }

    /* =========================================================
       CURRENT NEWS PREVIEW
    ========================================================= */

    .education-admin-news-edit-preview {
        margin-bottom: 22px;
        padding: 19px 22px;
        background: #f8f3e7;
        border: 1px solid #e7dcc6;
        border-radius: 17px;
    }

    .education-admin-news-edit-preview-label {
        display: flex;
        align-items: center;
        gap: 7px;
        margin-bottom: 9px;
        color: #a37b25;
        font-size: 11px;
        font-weight: 800;
    }

    .education-admin-news-edit-preview-title {
        margin: 0;
        color: #30372a;
        font-size: 17px;
        font-weight: 800;
        line-height: 1.6;
    }

    .education-admin-news-edit-preview-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 8px 17px;
        margin-top: 9px;
        color: #85867d;
        font-size: 11px;
    }

    .education-admin-news-edit-preview-meta span {
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .education-admin-news-edit-preview-meta i {
        color: #b5913e;
    }

    /* =========================================================
       ALERT
    ========================================================= */

    .education-admin-news-edit-alert {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 22px;
        padding: 14px 17px;
        border-radius: 14px;
        background: #edf4e9;
        border: 1px solid #c9d9bf;
        color: #435536;
        font-size: 13px;
        font-weight: 600;
    }

    .education-admin-news-edit-alert i {
        color: #657b4e;
        font-size: 16px;
    }

    /* =========================================================
       FORM CARD
    ========================================================= */

    .education-admin-news-edit-form-card {
        background: #fffdf8;
        border: 1px solid rgba(181, 145, 62, 0.18);
        border-radius: 22px;
        box-shadow: 0 10px 30px rgba(48, 55, 42, 0.055);
        overflow: hidden;
    }

    .education-admin-news-edit-form-header {
        padding: 20px 25px;
        background: #faf5e9;
        border-bottom: 1px solid #eee3cd;
    }

    .education-admin-news-edit-form-header h2 {
        margin: 0;
        color: #30372a;
        font-size: 17px;
        font-weight: 800;
    }

    .education-admin-news-edit-form-header p {
        margin: 6px 0 0;
        color: #85867d;
        font-size: 12px;
        line-height: 1.7;
    }

    .education-admin-news-edit-form {
        padding: 27px 25px 25px;
    }

    /* =========================================================
       GRID
    ========================================================= */

    .education-admin-news-edit-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 21px;
    }

    .education-admin-news-edit-group {
        min-width: 0;
    }

    .education-admin-news-edit-group.full {
        grid-column: 1 / -1;
    }

    /* =========================================================
       LABELS
    ========================================================= */

    .education-admin-news-edit-label {
        display: flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 8px;
        color: #454b3c;
        font-size: 13px;
        font-weight: 800;
    }

    .education-admin-news-edit-required {
        color: #a15f4e;
    }

    .education-admin-news-edit-help {
        margin: 7px 0 0;
        color: #96978e;
        font-size: 11px;
        line-height: 1.7;
    }

    /* =========================================================
       INPUTS
    ========================================================= */

    .education-admin-news-edit-input,
    .education-admin-news-edit-select,
    .education-admin-news-edit-textarea {
        width: 100%;
        box-sizing: border-box;
        border: 1px solid #ddd5c5;
        border-radius: 12px;
        background: #fffefb;
        color: #30372a;
        font-family: inherit;
        font-size: 13px;
        outline: none;
        transition: 0.2s ease;
    }

    .education-admin-news-edit-input,
    .education-admin-news-edit-select {
        height: 47px;
        padding: 0 14px;
    }

    .education-admin-news-edit-textarea {
        min-height: 175px;
        padding: 13px 14px;
        line-height: 1.9;
        resize: vertical;
    }

    .education-admin-news-edit-input:focus,
    .education-admin-news-edit-select:focus,
    .education-admin-news-edit-textarea:focus {
        border-color: #a88a4b;
        box-shadow: 0 0 0 3px rgba(168, 138, 75, 0.10);
        background: #fffefa;
    }

    .education-admin-news-edit-input::placeholder,
    .education-admin-news-edit-textarea::placeholder {
        color: #aaa99f;
    }

    .education-admin-news-edit-input.is-invalid,
    .education-admin-news-edit-select.is-invalid,
    .education-admin-news-edit-textarea.is-invalid {
        border-color: #c78370;
        box-shadow: 0 0 0 3px rgba(199, 131, 112, 0.08);
    }

    /* =========================================================
       ERROR
    ========================================================= */

    .education-admin-news-edit-error {
        display: flex;
        align-items: center;
        gap: 6px;
        margin-top: 7px;
        color: #9a5d4d;
        font-size: 11px;
        font-weight: 600;
    }

    /* =========================================================
       INPUT ICON
    ========================================================= */

    .education-admin-news-edit-input-wrapper {
        position: relative;
    }

    .education-admin-news-edit-input-wrapper > i {
        position: absolute;
        top: 50%;
        right: 14px;
        transform: translateY(-50%);
        color: #aa8744;
        pointer-events: none;
        font-size: 13px;
    }

    .education-admin-news-edit-input-wrapper .education-admin-news-edit-input {
        padding-right: 40px;
    }

    /* =========================================================
       OPTIONS
    ========================================================= */

    .education-admin-news-edit-options {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 14px;
    }

    .education-admin-news-edit-option {
        display: flex;
        align-items: flex-start;
        gap: 11px;
        padding: 15px;
        border: 1px solid #e0d7c5;
        border-radius: 14px;
        background: #fffdf8;
        cursor: pointer;
        transition: 0.2s ease;
    }

    .education-admin-news-edit-option:hover {
        border-color: #c9b47f;
        background: #fcf8ee;
    }

    .education-admin-news-edit-option input {
        width: 18px;
        height: 18px;
        margin: 2px 0 0;
        accent-color: #596446;
        flex-shrink: 0;
    }

    .education-admin-news-edit-option-content strong {
        display: block;
        margin-bottom: 4px;
        color: #444b3b;
        font-size: 12px;
        font-weight: 800;
    }

    .education-admin-news-edit-option-content span {
        display: block;
        color: #8a8b82;
        font-size: 11px;
        line-height: 1.7;
    }

    /* =========================================================
       FOOTER
    ========================================================= */

    .education-admin-news-edit-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        margin-top: 28px;
        padding-top: 21px;
        border-top: 1px solid #eee6d7;
    }

    .education-admin-news-edit-footer-note {
        display: flex;
        align-items: center;
        gap: 7px;
        color: #898a81;
        font-size: 11px;
        line-height: 1.7;
    }

    .education-admin-news-edit-footer-note i {
        color: #b5913e;
    }

    .education-admin-news-edit-actions {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .education-admin-news-edit-save,
    .education-admin-news-edit-cancel {
        min-height: 44px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 10px 19px;
        border-radius: 11px;
        font-family: inherit;
        font-size: 12px;
        font-weight: 800;
        cursor: pointer;
        text-decoration: none;
        transition: 0.2s ease;
    }

    .education-admin-news-edit-save {
        border: 1px solid #596446;
        background: #596446;
        color: #fffdf7;
        box-shadow: 0 7px 17px rgba(89, 100, 70, 0.17);
    }

    .education-admin-news-edit-save:hover {
        background: #475235;
        border-color: #475235;
        transform: translateY(-1px);
    }

    .education-admin-news-edit-cancel {
        border: 1px solid #ded5c5;
        background: #fffdf8;
        color: #696d60;
    }

    .education-admin-news-edit-cancel:hover {
        background: #f5efe2;
        color: #4f5547;
    }

    /* =========================================================
       DELETE SECTION
    ========================================================= */

    .education-admin-news-edit-danger {
        margin-top: 22px;
        padding: 20px 22px;
        background: #fbf2ee;
        border: 1px solid #ead8d0;
        border-radius: 18px;
    }

    .education-admin-news-edit-danger-heading {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 7px;
        color: #875748;
        font-size: 13px;
        font-weight: 800;
    }

    .education-admin-news-edit-danger-heading i {
        color: #a76554;
    }

    .education-admin-news-edit-danger p {
        margin: 0 0 14px;
        color: #96786d;
        font-size: 11px;
        line-height: 1.8;
    }

    .education-admin-news-edit-delete {
        min-height: 39px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        padding: 8px 14px;
        border: 1px solid #dfc3b9;
        border-radius: 10px;
        background: #f7e7e2;
        color: #8f594b;
        font-family: inherit;
        font-size: 11px;
        font-weight: 800;
        cursor: pointer;
        transition: 0.2s ease;
    }

    .education-admin-news-edit-delete:hover {
        background: #efd9d2;
        color: #77483d;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 800px) {

        .education-admin-news-edit-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .education-admin-news-edit-header-actions {
            width: 100%;
        }

        .education-admin-news-edit-back-btn,
        .education-admin-news-edit-view-btn {
            flex: 1;
        }

        .education-admin-news-edit-grid {
            grid-template-columns: 1fr;
        }

        .education-admin-news-edit-group.full {
            grid-column: auto;
        }

        .education-admin-news-edit-options {
            grid-template-columns: 1fr;
        }

        .education-admin-news-edit-footer {
            align-items: stretch;
            flex-direction: column;
        }

        .education-admin-news-edit-actions {
            width: 100%;
        }

        .education-admin-news-edit-save,
        .education-admin-news-edit-cancel {
            flex: 1;
        }
    }

    @media (max-width: 520px) {

        .education-admin-news-edit-header {
            padding: 20px;
            border-radius: 18px;
        }

        .education-admin-news-edit-icon {
            width: 47px;
            height: 47px;
            flex-basis: 47px;
        }

        .education-admin-news-edit-heading h1 {
            font-size: 21px;
        }

        .education-admin-news-edit-form {
            padding: 22px 18px;
        }

        .education-admin-news-edit-form-header {
            padding: 18px;
        }

        .education-admin-news-edit-header-actions {
            flex-direction: column;
        }

        .education-admin-news-edit-back-btn,
        .education-admin-news-edit-view-btn {
            width: 100%;
            flex: none;
        }

        .education-admin-news-edit-actions {
            flex-direction: column-reverse;
        }

        .education-admin-news-edit-save,
        .education-admin-news-edit-cancel {
            width: 100%;
        }
    }
</style>

<div class="education-admin-news-edit-page">

{{-- =====================================================
    PAGE HEADER
====================================================== --}}

<div class="education-admin-news-edit-header">

    <div class="education-admin-news-edit-heading">

        <div class="education-admin-news-edit-icon">
            <i class="fa-solid fa-pen-to-square"></i>
        </div>

        <div>

            <span class="education-admin-news-edit-heading-label">
                {{ __('education_admin.news_edit.header_label') }}
            </span>

            <h1>
                {{ __('education_admin.news_edit.title') }}
            </h1>

            <p>
                {{ __('education_admin.news_edit.description') }}
            </p>

        </div>

    </div>


    <div class="education-admin-news-edit-header-actions">

        <a
            href="{{ route('education.admin.news.show', $news) }}"
            class="education-admin-news-edit-view-btn"
        >
            <i class="fa-solid fa-eye"></i>
            {{ __('education_admin.news_edit.actions.view') }}
        </a>

        <a
            href="{{ route('education.admin.news.index') }}"
            class="education-admin-news-edit-back-btn"
        >
            <i class="fa-solid fa-arrow-right"></i>
            {{ __('education_admin.news_edit.actions.back') }}
        </a>

    </div>

</div>


{{-- =====================================================
    SUCCESS MESSAGE
====================================================== --}}

@if(session('success'))

    <div class="education-admin-news-edit-alert">

        <i class="fa-solid fa-circle-check"></i>

        <span>
            {{ session('success') }}
        </span>

    </div>

@endif


{{-- =====================================================
    CURRENT NEWS
====================================================== --}}

<div class="education-admin-news-edit-preview">

    <div class="education-admin-news-edit-preview-label">

        <i class="fa-solid fa-circle-info"></i>

        {{ __('education_admin.news_edit.current.label') }}

    </div>

    <h2 class="education-admin-news-edit-preview-title">
        {{ $news->title }}
    </h2>

    <div class="education-admin-news-edit-preview-meta">

        <span>
            <i class="fa-solid fa-hashtag"></i>
            {{ $news->sort_order }}
        </span>

        <span>

            @if($news->is_active)
                <i class="fa-solid fa-circle"></i>
                {{ __('education_admin.news_edit.status.active') }}
            @else
                <i class="fa-solid fa-circle"></i>
                {{ __('education_admin.news_edit.status.inactive') }}
            @endif

        </span>

        @if($news->created_at)

            <span>
                <i class="fa-regular fa-calendar"></i>
                {{ $news->created_at->format('Y-m-d H:i') }}
            </span>

        @endif

    </div>

</div>


{{-- =====================================================
    FORM
====================================================== --}}

<div class="education-admin-news-edit-form-card">

    <div class="education-admin-news-edit-form-header">

        <h2>
            {{ __('education_admin.news_edit.form.title') }}
        </h2>

        <p>
            {{ __('education_admin.news_edit.form.description') }}
        </p>

    </div>


    <form
        action="{{ route('education.admin.news.update', $news) }}"
        method="POST"
        class="education-admin-news-edit-form"
    >

        @csrf
        @method('PUT')


        <div class="education-admin-news-edit-grid">

            {{-- =================================================
                TITLE
            ================================================== --}}

            <div class="education-admin-news-edit-group full">

                <label
                    for="title"
                    class="education-admin-news-edit-label"
                >
                    {{ __('education_admin.news_edit.fields.title') }}

                    <span class="education-admin-news-edit-required">
                        {{ __('education_admin.news_edit.required') }}
                    </span>
                </label>

                <div class="education-admin-news-edit-input-wrapper">

                    <i class="fa-solid fa-heading"></i>

                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title', $news->title) }}"
                        class="education-admin-news-edit-input @error('title') is-invalid @enderror"
                        placeholder="{{ __('education_admin.news_edit.fields.title_placeholder') }}"
                        maxlength="255"
                        required
                    >

                </div>

                @error('title')

                    <div class="education-admin-news-edit-error">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        {{ $message }}
                    </div>

                @enderror

            </div>


            {{-- =================================================
                TYPE
            ================================================== --}}

            <div class="education-admin-news-edit-group">

                <label
                    for="type"
                    class="education-admin-news-edit-label"
                >
                    {{ __('education_admin.news_edit.fields.type') }}

                    <span class="education-admin-news-edit-required">
                        {{ __('education_admin.news_edit.required') }}
                    </span>
                </label>

                <select
                    id="type"
                    name="type"
                    class="education-admin-news-edit-select @error('type') is-invalid @enderror"
                    required
                >

                    <option value="">
                        {{ __('education_admin.news_edit.fields.type_placeholder') }}
                    </option>

                    <option
                        value="announcement"
                        @selected(old('type', $news->type) === 'announcement')
                    >
                        {{ __('education_admin.news_edit.types.announcement') }}
                    </option>

                    <option
                        value="lesson"
                        @selected(old('type', $news->type) === 'lesson')
                    >
                        {{ __('education_admin.news_edit.types.lesson') }}
                    </option>

                    <option
                        value="update"
                        @selected(old('type', $news->type) === 'update')
                    >
                        {{ __('education_admin.news_edit.types.update') }}
                    </option>

                    <option
                        value="notice"
                        @selected(old('type', $news->type) === 'notice')
                    >
                        {{ __('education_admin.news_edit.types.notice') }}
                    </option>

                    <option
                        value="general"
                        @selected(old('type', $news->type) === 'general')
                    >
                        {{ __('education_admin.news_edit.types.general') }}
                    </option>

                </select>

                @error('type')

                    <div class="education-admin-news-edit-error">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        {{ $message }}
                    </div>

                @enderror

            </div>


            {{-- =================================================
                SORT ORDER
            ================================================== --}}

            <div class="education-admin-news-edit-group">

                <label
                    for="sort_order"
                    class="education-admin-news-edit-label"
                >
                    {{ __('education_admin.news_edit.fields.sort_order') }}
                </label>

                <input
                    type="number"
                    id="sort_order"
                    name="sort_order"
                    value="{{ old('sort_order', $news->sort_order ?? 0) }}"
                    class="education-admin-news-edit-input @error('sort_order') is-invalid @enderror"
                    min="0"
                    step="1"
                >

                <p class="education-admin-news-edit-help">
                    {{ __('education_admin.news_edit.help.sort_order') }}
                </p>

                @error('sort_order')

                    <div class="education-admin-news-edit-error">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        {{ $message }}
                    </div>

                @enderror

            </div>


            {{-- =================================================
                CONTENT
            ================================================== --}}

            <div class="education-admin-news-edit-group full">

                <label
                    for="content"
                    class="education-admin-news-edit-label"
                >
                    {{ __('education_admin.news_edit.fields.content') }}

                    <span class="education-admin-news-edit-required">
                        {{ __('education_admin.news_edit.required') }}
                    </span>
                </label>

                <textarea
                    id="content"
                    name="content"
                    class="education-admin-news-edit-textarea @error('content') is-invalid @enderror"
                    placeholder="{{ __('education_admin.news_edit.fields.content_placeholder') }}"
                    required
                >{{ old('content', $news->content) }}</textarea>

                <p class="education-admin-news-edit-help">
                    {{ __('education_admin.news_edit.help.content') }}
                </p>

                @error('content')

                    <div class="education-admin-news-edit-error">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        {{ $message }}
                    </div>

                @enderror

            </div>


            {{-- =================================================
                LINK
            ================================================== --}}

            <div class="education-admin-news-edit-group full">

                <label
                    for="link"
                    class="education-admin-news-edit-label"
                >
                    {{ __('education_admin.news_edit.fields.link') }}
                </label>

                <div class="education-admin-news-edit-input-wrapper">

                    <i class="fa-solid fa-link"></i>

                    <input
                        type="url"
                        id="link"
                        name="link"
                        value="{{ old('link', $news->link) }}"
                        class="education-admin-news-edit-input @error('link') is-invalid @enderror"
                        placeholder="{{ __('education_admin.news_edit.fields.link_placeholder') }}"
                        maxlength="2048"
                    >

                </div>

                <p class="education-admin-news-edit-help">
                    {{ __('education_admin.news_edit.help.link') }}
                </p>

                @error('link')

                    <div class="education-admin-news-edit-error">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        {{ $message }}
                    </div>

                @enderror

            </div>


            {{-- =================================================
                START DATE
            ================================================== --}}

            <div class="education-admin-news-edit-group">

                <label
                    for="starts_at"
                    class="education-admin-news-edit-label"
                >
                    {{ __('education_admin.news_edit.fields.starts_at') }}
                </label>

                <input
                    type="datetime-local"
                    id="starts_at"
                    name="starts_at"
                    value="{{ old(
                        'starts_at',
                        $news->starts_at
                            ? $news->starts_at->format('Y-m-d\TH:i')
                            : ''
                    ) }}"
                    class="education-admin-news-edit-input @error('starts_at') is-invalid @enderror"
                >

                <p class="education-admin-news-edit-help">
                    {{ __('education_admin.news_edit.help.starts_at') }}
                </p>

                @error('starts_at')

                    <div class="education-admin-news-edit-error">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        {{ $message }}
                    </div>

                @enderror

            </div>


            {{-- =================================================
                END DATE
            ================================================== --}}

            <div class="education-admin-news-edit-group">

                <label
                    for="ends_at"
                    class="education-admin-news-edit-label"
                >
                    {{ __('education_admin.news_edit.fields.ends_at') }}
                </label>

                <input
                    type="datetime-local"
                    id="ends_at"
                    name="ends_at"
                    value="{{ old(
                        'ends_at',
                        $news->ends_at
                            ? $news->ends_at->format('Y-m-d\TH:i')
                            : ''
                    ) }}"
                    class="education-admin-news-edit-input @error('ends_at') is-invalid @enderror"
                >

                <p class="education-admin-news-edit-help">
                    {{ __('education_admin.news_edit.help.ends_at') }}
                </p>

                @error('ends_at')

                    <div class="education-admin-news-edit-error">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        {{ $message }}
                    </div>

                @enderror

            </div>


            {{-- =================================================
                OPTIONS
            ================================================== --}}

            <div class="education-admin-news-edit-group full">

                <label class="education-admin-news-edit-label">
                    {{ __('education_admin.news_edit.publishing.title') }}
                </label>

                <div class="education-admin-news-edit-options">

                    <label class="education-admin-news-edit-option">

                        <input
                            type="checkbox"
                            name="is_active"
                            value="1"
                            @checked(old('is_active', $news->is_active))
                        >

                        <div class="education-admin-news-edit-option-content">

                            <strong>
                                {{ __('education_admin.news_edit.publishing.publish.title') }}
                            </strong>

                            <span>
                                {{ __('education_admin.news_edit.publishing.publish.description') }}
                            </span>

                        </div>

                    </label>


                    <label class="education-admin-news-edit-option">

                        <input
                            type="checkbox"
                            name="open_in_new_tab"
                            value="1"
                            @checked(old('open_in_new_tab', $news->open_in_new_tab ?? true))
                        >

                        <div class="education-admin-news-edit-option-content">

                            <strong>
                                {{ __('education_admin.news_edit.publishing.new_tab.title') }}
                            </strong>

                            <span>
                                {{ __('education_admin.news_edit.publishing.new_tab.description') }}
                            </span>

                        </div>

                    </label>

                </div>

            </div>

        </div>


        {{-- =================================================
            FORM FOOTER
        ================================================== --}}

        <div class="education-admin-news-edit-footer">

            <div class="education-admin-news-edit-footer-note">

                <i class="fa-solid fa-circle-info"></i>

                <span>
                    {{ __('education_admin.news_edit.footer.note') }}
                </span>

            </div>


            <div class="education-admin-news-edit-actions">

                <a
                    href="{{ route('education.admin.news.index') }}"
                    class="education-admin-news-edit-cancel"
                >
                    {{ __('education_admin.news_edit.actions.cancel') }}
                </a>

                <button
                    type="submit"
                    class="education-admin-news-edit-save"
                >
                    <i class="fa-solid fa-floppy-disk"></i>
                    {{ __('education_admin.news_edit.actions.save') }}
                </button>

            </div>

        </div>

    </form>

</div>


{{-- =====================================================
    DELETE
====================================================== --}}

<div class="education-admin-news-edit-danger">

    <div class="education-admin-news-edit-danger-heading">

        <i class="fa-solid fa-triangle-exclamation"></i>

        {{ __('education_admin.news_edit.delete.title') }}

    </div>

    <p>
        {{ __('education_admin.news_edit.delete.description') }}
    </p>


    <form
        action="{{ route('education.admin.news.destroy', $news) }}"
        method="POST"
        onsubmit="return confirm(@json(__('education_admin.news_edit.delete.confirm')));"
    >

        @csrf
        @method('DELETE')

        <button
            type="submit"
            class="education-admin-news-edit-delete"
        >
            <i class="fa-solid fa-trash"></i>
            {{ __('education_admin.news_edit.delete.button') }}
        </button>

    </form>

</div>

</div>

@endsection
