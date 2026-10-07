@extends('education.admin.layouts.app')

@section('title', __('education_admin.student_lesson_content_edit.page_title'))

@section('content')

<style>
    /* =========================================================
       EDIT LESSON CONTENT
       Education Admin Design System
       Cream / Gold / Green
    ========================================================= */

    .lesson-content-edit-page {
        --edu-cream: #f7f1e5;
        --edu-cream-light: #fffdf8;
        --edu-gold: #b08d3c;
        --edu-gold-light: #d4b86a;
        --edu-green: #315c45;
        --edu-green-dark: #234634;
        --edu-green-soft: #eaf2ed;
        --edu-text: #26352d;
        --edu-muted: #7b817c;
        --edu-border: #e7dfd0;
        --edu-white: #ffffff;
        --edu-danger: #a94b4b;
        --edu-danger-soft: #f8ecec;
        --edu-info: #54758c;
        --edu-info-soft: #edf2f5;

        color: var(--edu-text);
        width: 100%;
    }

    /* =========================================================
       HEADER
    ========================================================= */

    .lesson-content-edit-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 28px;
    }

    .lesson-content-edit-breadcrumb {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
        color: var(--edu-gold);
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 9px;
    }

    .lesson-content-edit-breadcrumb i {
        font-size: 10px;
    }

    .lesson-content-edit-title {
        margin: 0;
        color: var(--edu-green-dark);
        font-size: 29px;
        line-height: 1.3;
        font-weight: 700;
    }

    .lesson-content-edit-description {
        margin: 8px 0 0;
        color: var(--edu-muted);
        font-size: 14px;
        line-height: 1.8;
    }

    /* =========================================================
       BUTTONS
    ========================================================= */

    .lesson-content-edit-actions {
        display: flex;
        align-items: center;
        gap: 9px;
        flex-wrap: wrap;
    }

    .lesson-content-edit-btn {
        min-height: 43px;
        padding: 0 15px;
        border-radius: 10px;
        border: 1px solid transparent;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition:
            transform .2s ease,
            background .2s ease,
            box-shadow .2s ease;
    }

    .lesson-content-edit-btn:hover {
        transform: translateY(-1px);
    }

    .lesson-content-edit-btn-back {
        background: var(--edu-cream);
        border-color: var(--edu-border);
        color: var(--edu-green-dark);
    }

    .lesson-content-edit-btn-back:hover {
        background: #efe6d5;
        color: var(--edu-green-dark);
    }

    .lesson-content-edit-btn-save {
        background: var(--edu-green);
        color: #fff;
        border-color: var(--edu-green);
        box-shadow: 0 6px 16px rgba(49, 92, 69, .14);
    }

    .lesson-content-edit-btn-save:hover {
        background: var(--edu-green-dark);
        border-color: var(--edu-green-dark);
        color: #fff;
    }

    .lesson-content-edit-btn-save:disabled {
        opacity: .7;
        cursor: wait;
        transform: none;
    }

    .lesson-content-add-btn {
        min-height: 43px;
        padding: 0 15px;
        border: 1px solid #d7c28d;
        border-radius: 10px;
        background: var(--edu-cream);
        color: var(--edu-gold);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        transition: .2s ease;
    }

    .lesson-content-add-btn:hover {
        background: #f1e7d2;
        transform: translateY(-1px);
    }

    /* =========================================================
       MAIN GRID
    ========================================================= */

    .lesson-content-edit-layout {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 300px;
        gap: 22px;
        align-items: start;
    }

    /* =========================================================
       CARD
    ========================================================= */

    .lesson-content-edit-card {
        background: var(--edu-white);
        border: 1px solid var(--edu-border);
        border-radius: 18px;
        box-shadow: 0 8px 24px rgba(49, 92, 69, .05);
        overflow: hidden;
    }

    .lesson-content-edit-card-header {
        padding: 19px 21px;
        border-bottom: 1px solid var(--edu-border);
        display: flex;
        align-items: center;
        gap: 11px;
    }

    .lesson-content-edit-card-icon {
        width: 38px;
        height: 38px;
        flex: 0 0 auto;
        border-radius: 10px;
        background: var(--edu-cream);
        color: var(--edu-gold);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .lesson-content-edit-card-header h2 {
        margin: 0;
        color: var(--edu-green-dark);
        font-size: 16px;
        font-weight: 700;
    }

    .lesson-content-edit-card-header p {
        margin: 3px 0 0;
        color: var(--edu-muted);
        font-size: 11px;
    }

    .lesson-content-edit-card-body {
        padding: 22px;
    }

    /* =========================================================
       FORM
    ========================================================= */

    .lesson-content-edit-form {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .lesson-content-edit-field {
        display: flex;
        flex-direction: column;
        gap: 7px;
    }

    .lesson-content-edit-field label {
        color: var(--edu-green-dark);
        font-size: 13px;
        font-weight: 700;
    }

    .lesson-content-edit-field label span {
        color: var(--edu-danger);
        margin-right: 3px;
    }

    .lesson-content-edit-input,
    .lesson-content-edit-select,
    .lesson-content-edit-textarea {
        width: 100%;
        border: 1px solid var(--edu-border);
        border-radius: 11px;
        background: var(--edu-cream-light);
        color: var(--edu-text);
        outline: none;
        font-size: 13px;
        transition:
            border-color .2s ease,
            box-shadow .2s ease;
        box-sizing: border-box;
        font-family: inherit;
    }

    .lesson-content-edit-input,
    .lesson-content-edit-select {
        height: 45px;
        padding: 0 13px;
    }

    .lesson-content-edit-textarea {
        min-height: 150px;
        padding: 13px;
        resize: vertical;
        line-height: 1.8;
    }

    .lesson-content-edit-input:focus,
    .lesson-content-edit-select:focus,
    .lesson-content-edit-textarea:focus {
        border-color: var(--edu-gold);
        box-shadow: 0 0 0 3px rgba(176, 141, 60, .10);
    }

    .lesson-content-edit-input::placeholder,
    .lesson-content-edit-textarea::placeholder {
        color: #a4a8a5;
    }

    .lesson-content-edit-error {
        color: var(--edu-danger);
        font-size: 11px;
        line-height: 1.6;
    }

    /* =========================================================
       TWO COLUMNS
    ========================================================= */

    .lesson-content-edit-row {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
    }

    /* =========================================================
       TYPE INFO
    ========================================================= */

    .lesson-content-type-info {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        padding: 12px 13px;
        border-radius: 11px;
        background: var(--edu-info-soft);
        color: var(--edu-info);
        font-size: 11px;
        line-height: 1.7;
    }

    .lesson-content-type-info i {
        margin-top: 2px;
        flex: 0 0 auto;
    }

    /* =========================================================
       CHECKBOX
    ========================================================= */

    .lesson-content-edit-checkbox {
        display: flex;
        align-items: center;
        gap: 10px;
        min-height: 45px;
        padding: 0 13px;
        border: 1px solid var(--edu-border);
        border-radius: 11px;
        background: var(--edu-cream-light);
    }

    .lesson-content-edit-checkbox input {
        width: 17px;
        height: 17px;
        accent-color: var(--edu-green);
        cursor: pointer;
        flex: 0 0 auto;
    }

    .lesson-content-edit-checkbox label {
        margin: 0;
        cursor: pointer;
        font-size: 13px;
        color: var(--edu-text);
        font-weight: 600;
    }

    /* =========================================================
       FILE / IMAGE
    ========================================================= */

    .lesson-content-current-file {
        margin-top: 9px;
        padding: 12px;
        border-radius: 11px;
        background: var(--edu-green-soft);
        border: 1px solid #d8e7dd;
        display: flex;
        align-items: center;
        gap: 11px;
    }

    .lesson-content-current-file-icon {
        width: 38px;
        height: 38px;
        flex: 0 0 auto;
        border-radius: 9px;
        background: #fff;
        color: var(--edu-green);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .lesson-content-current-file-info {
        min-width: 0;
    }

    .lesson-content-current-file-name {
        color: var(--edu-green-dark);
        font-size: 12px;
        font-weight: 700;
        word-break: break-word;
    }

    .lesson-content-current-file-size {
        margin-top: 3px;
        color: var(--edu-muted);
        font-size: 10px;
    }

    .lesson-content-current-image-preview {
        margin-top: 10px;
        max-width: 220px;
        max-height: 150px;
        border-radius: 10px;
        border: 1px solid var(--edu-border);
        object-fit: cover;
        display: block;
    }

    .lesson-content-new-image-preview {
        display: none;
        margin-top: 10px;
        max-width: 260px;
        max-height: 180px;
        border-radius: 11px;
        border: 1px solid var(--edu-border);
        object-fit: cover;
    }

    /* =========================================================
       ADDITIONAL CONTENT
    ========================================================= */

    .lesson-content-additional-wrapper {
        margin-top: 5px;
        padding-top: 20px;
        border-top: 1px solid var(--edu-border);
    }

    .lesson-content-additional-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 15px;
    }

    .lesson-content-additional-title {
        margin: 0;
        color: var(--edu-green-dark);
        font-size: 16px;
        font-weight: 700;
    }

    .lesson-content-additional-description {
        margin: 4px 0 0;
        color: var(--edu-muted);
        font-size: 11px;
        line-height: 1.7;
    }

    .additional-content-list {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .additional-content-item {
        border: 1px solid var(--edu-border);
        border-radius: 15px;
        background: #fffdf9;
        overflow: hidden;
    }

    .additional-content-item-header {
        padding: 13px 15px;
        background: var(--edu-cream);
        border-bottom: 1px solid var(--edu-border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }

    .additional-content-item-number {
        color: var(--edu-green-dark);
        font-size: 13px;
        font-weight: 700;
    }

    .additional-content-remove {
        width: 34px;
        height: 34px;
        border: 1px solid #e8caca;
        border-radius: 9px;
        background: var(--edu-danger-soft);
        color: var(--edu-danger);
        cursor: pointer;
        transition: .2s ease;
    }

    .additional-content-remove:hover {
        background: #f3dddd;
    }

    .additional-content-item-body {
        padding: 17px;
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .additional-content-empty {
        padding: 20px;
        text-align: center;
        border: 1px dashed var(--edu-border);
        border-radius: 12px;
        color: var(--edu-muted);
        font-size: 12px;
    }

    /* =========================================================
       SIDEBAR
    ========================================================= */

    .lesson-content-edit-sidebar {
        display: flex;
        flex-direction: column;
        gap: 18px;
    }

    .lesson-content-edit-side-card {
        background: var(--edu-white);
        border: 1px solid var(--edu-border);
        border-radius: 17px;
        padding: 18px;
        box-shadow: 0 8px 24px rgba(49, 92, 69, .05);
    }

    .lesson-content-edit-side-title {
        display: flex;
        align-items: center;
        gap: 9px;
        color: var(--edu-green-dark);
        font-size: 14px;
        font-weight: 700;
        margin-bottom: 14px;
    }

    .lesson-content-edit-side-title i {
        color: var(--edu-gold);
    }

    /* =========================================================
       LESSON INFO
    ========================================================= */

    .lesson-content-lesson-info {
        display: flex;
        flex-direction: column;
        gap: 11px;
    }

    .lesson-content-lesson-info-item {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 12px;
        padding-bottom: 10px;
        border-bottom: 1px solid #f0eadf;
    }

    .lesson-content-lesson-info-item:last-child {
        padding-bottom: 0;
        border-bottom: 0;
    }

    .lesson-content-lesson-info-label {
        color: var(--edu-muted);
        font-size: 11px;
    }

    .lesson-content-lesson-info-value {
        color: var(--edu-green-dark);
        font-size: 12px;
        font-weight: 700;
        text-align: right;
        word-break: break-word;
    }

    /* =========================================================
       SOURCE CONTENT
    ========================================================= */

    .lesson-content-source-box {
        padding: 12px;
        border-radius: 11px;
        background: var(--edu-cream);
    }

    .lesson-content-source-label {
        color: var(--edu-muted);
        font-size: 10px;
        margin-bottom: 5px;
    }

    .lesson-content-source-title {
        color: var(--edu-green-dark);
        font-size: 12px;
        font-weight: 700;
        line-height: 1.6;
    }

    /* =========================================================
       DANGER
    ========================================================= */

    .lesson-content-danger-card {
        border-color: #edd7d7;
    }

    .lesson-content-danger-card .lesson-content-edit-side-title {
        color: var(--edu-danger);
    }

    .lesson-content-danger-text {
        color: var(--edu-muted);
        font-size: 11px;
        line-height: 1.7;
        margin: 0 0 13px;
    }

    .lesson-content-delete-btn {
        width: 100%;
        min-height: 40px;
        border: 1px solid #e8caca;
        border-radius: 10px;
        background: var(--edu-danger-soft);
        color: var(--edu-danger);
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
        transition: background .2s ease;
    }

    .lesson-content-delete-btn:hover {
        background: #f3dddd;
    }

    /* =========================================================
       FORM FOOTER
    ========================================================= */

    .lesson-content-edit-footer {
        margin-top: 5px;
        padding-top: 20px;
        border-top: 1px solid var(--edu-border);
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 10px;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 1050px) {

        .lesson-content-edit-layout {
            grid-template-columns: 1fr;
        }

        .lesson-content-edit-sidebar {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 800px) {

        .lesson-content-edit-header {
            flex-direction: column;
        }

        .lesson-content-edit-actions {
            width: 100%;
        }

        .lesson-content-edit-btn,
        .lesson-content-add-btn {
            flex: 1;
        }

        .lesson-content-edit-row {
            grid-template-columns: 1fr;
        }

        .lesson-content-additional-header {
            flex-direction: column;
            align-items: stretch;
        }
    }

    @media (max-width: 600px) {

        .lesson-content-edit-sidebar {
            grid-template-columns: 1fr;
        }

        .lesson-content-edit-card-body {
            padding: 16px;
        }

        .lesson-content-edit-title {
            font-size: 24px;
        }

        .lesson-content-edit-footer {
            flex-direction: column;
            align-items: stretch;
        }

        .lesson-content-edit-footer .lesson-content-edit-btn {
            width: 100%;
        }
    }
</style>


<div class="lesson-content-edit-page">

    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="lesson-content-edit-header">

        <div>

            <div class="lesson-content-edit-breadcrumb">

                <i class="fa-solid fa-graduation-cap"></i>

                <span>
                    {{ __('education_admin.student_lesson_content_edit.header.education') }}
                </span>

                <i class="fa-solid fa-chevron-left"></i>

                <span>
                    {{ __('education_admin.student_lesson_content_edit.header.student_lessons') }}
                </span>

                <i class="fa-solid fa-chevron-left"></i>

                <span>
                    {{ __('education_admin.student_lesson_content_edit.header.content') }}
                </span>

                <i class="fa-solid fa-chevron-left"></i>

                <span>
                    {{ __('education_admin.student_lesson_content_edit.header.edit') }}
                </span>

            </div>

            <h1 class="lesson-content-edit-title">
                {{ __('education_admin.student_lesson_content_edit.header.title') }}
            </h1>

            <p class="lesson-content-edit-description">
                {{ __('education_admin.student_lesson_content_edit.header.description') }}
            </p>

        </div>


        <div class="lesson-content-edit-actions">

            <a
                href="{{ route(
                    'education.admin.student-lessons.content.index',
                    $studentLesson
                ) }}"
                class="lesson-content-edit-btn lesson-content-edit-btn-back"
            >
                <i class="fa-solid fa-arrow-right"></i>

                <span>
                    {{ __('education_admin.student_lesson_content_edit.actions.back_to_content') }}
                </span>

            </a>

        </div>

    </div>


    <div class="lesson-content-edit-layout">

        {{-- =================================================
             MAIN FORM
        ================================================== --}}

        <div class="lesson-content-edit-card">

            <div class="lesson-content-edit-card-header">

                <div class="lesson-content-edit-card-icon">
                    <i class="fa-solid fa-pen"></i>
                </div>

                <div>

                    <h2>
                        {{ __('education_admin.student_lesson_content_edit.form.information.title') }}
                    </h2>

                    <p>
                        {{ __('education_admin.student_lesson_content_edit.form.information.description') }}
                    </p>

                </div>

            </div>


            <div class="lesson-content-edit-card-body">

                <form
                    id="lesson-content-edit-form"
                    method="POST"
                    action="{{ route(
                        'education.admin.student-lessons.content.update',
                        [
                            'studentLesson' => $studentLesson,
                            'content' => $content,
                        ]
                    ) }}"
                    enctype="multipart/form-data"
                    class="lesson-content-edit-form"
                >

                    @csrf

                    @method('PUT')


                    {{-- =================================================
                         TITLE
                    ================================================== --}}

                    <div class="lesson-content-edit-field">

                        <label for="title">
                            {{ __('education_admin.student_lesson_content_edit.form.title.label') }}
                            <span>*</span>
                        </label>

                        <input
                            id="title"
                            type="text"
                            name="title"
                            value="{{ old('title', $content->title) }}"
                            class="lesson-content-edit-input"
                            placeholder="{{ __('education_admin.student_lesson_content_edit.form.title.placeholder') }}"
                            required
                        >

                        @error('title')
                            <div class="lesson-content-edit-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- =================================================
                         TYPE / ORDER
                    ================================================== --}}

                    <div class="lesson-content-edit-row">

                        <div class="lesson-content-edit-field">

                            <label for="type">
                                {{ __('education_admin.student_lesson_content_edit.form.type.label') }}
                                <span>*</span>
                            </label>

                            <select
                                id="type"
                                name="type"
                                class="lesson-content-edit-select"
                                required
                            >

                                <option
                                    value="text"
                                    @selected(old('type', $content->type) === 'text')
                                >
                                    {{ __('education_admin.student_lesson_content_edit.form.type.text') }}
                                </option>

                                <option
                                    value="image"
                                    @selected(old('type', $content->type) === 'image')
                                >
                                    {{ __('education_admin.student_lesson_content_edit.form.type.image') }}
                                </option>

                                <option
                                    value="link"
                                    @selected(old('type', $content->type) === 'link')
                                >
                                    {{ __('education_admin.student_lesson_content_edit.form.type.link') }}
                                </option>

                                <option
                                    value="file"
                                    @selected(old('type', $content->type) === 'file')
                                >
                                    {{ __('education_admin.student_lesson_content_edit.form.type.file') }}
                                </option>

                            </select>

                            @error('type')
                                <div class="lesson-content-edit-error">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <div class="lesson-content-edit-field">

                            <label for="sort_order">
                                {{ __('education_admin.student_lesson_content_edit.form.sort_order.label') }}
                            </label>

                            <input
                                id="sort_order"
                                type="number"
                                name="sort_order"
                                value="{{ old('sort_order', $content->sort_order ?? 0) }}"
                                class="lesson-content-edit-input"
                                min="0"
                                placeholder="{{ __('education_admin.student_lesson_content_edit.form.sort_order.placeholder') }}"
                            >

                            @error('sort_order')
                                <div class="lesson-content-edit-error">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>


                    {{-- =================================================
                         TYPE INFORMATION
                    ================================================== --}}

                    <div class="lesson-content-type-info">

                        <i class="fa-solid fa-circle-info"></i>

                        <div>

                            <strong>
                                {{ __('education_admin.student_lesson_content_edit.form.type_info.label') }}
                            </strong>

                            {{ __('education_admin.student_lesson_content_edit.form.type_info.description') }}

                        </div>

                    </div>


                    {{-- =================================================
                         DESCRIPTION
                    ================================================== --}}

                    <div class="lesson-content-edit-field">

                        <label for="description">
                            {{ __('education_admin.student_lesson_content_edit.form.description.label') }}
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            class="lesson-content-edit-textarea"
                            placeholder="{{ __('education_admin.student_lesson_content_edit.form.description.placeholder') }}"
                        >{{ old('description', $content->description) }}</textarea>

                        @error('description')
                            <div class="lesson-content-edit-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- =================================================
                         CONTENT
                    ================================================== --}}

                    <div
                        class="lesson-content-edit-field"
                        id="content-field"
                    >

                        <label for="content">
                            {{ __('education_admin.student_lesson_content_edit.form.content.label') }}
                        </label>

                        <textarea
                            id="content"
                            name="content"
                            class="lesson-content-edit-textarea"
                            style="min-height:220px;"
                            placeholder="{{ __('education_admin.student_lesson_content_edit.form.content.placeholder') }}"
                        >{{ old('content', $content->content) }}</textarea>

                        @error('content')
                            <div class="lesson-content-edit-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- =================================================
                         URL
                    ================================================== --}}

                    <div
                        class="lesson-content-edit-field"
                        id="url-field"
                    >

                        <label for="url">
                            {{ __('education_admin.student_lesson_content_edit.form.url.label') }}
                        </label>

                        <input
                            id="url"
                            type="url"
                            name="url"
                            value="{{ old('url', $content->url) }}"
                            class="lesson-content-edit-input"
                            placeholder="{{ __('education_admin.student_lesson_content_edit.form.url.placeholder') }}"
                        >

                        @error('url')
                            <div class="lesson-content-edit-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- =================================================
                         FILE
                    ================================================== --}}

                    <div
                        class="lesson-content-edit-field"
                        id="file-field"
                    >

                        <label for="file">
                            {{ __('education_admin.student_lesson_content_edit.form.file.label') }}
                        </label>

                        <input
                            id="file"
                            type="file"
                            name="file"
                            class="lesson-content-edit-input"
                            style="padding-top:10px;"
                        >

                        @if($content->file_path)

                            <div class="lesson-content-current-file">

                                <div class="lesson-content-current-file-icon">
                                    <i class="fa-solid fa-file"></i>
                                </div>

                                <div class="lesson-content-current-file-info">

                                    <div class="lesson-content-current-file-name">
                                        {{ $content->file_name ?? basename($content->file_path) }}
                                    </div>

                                    @if($content->file_size)

                                        <div class="lesson-content-current-file-size">
                                            {{ number_format($content->file_size / 1024, 1) }}
                                            {{ __('education_admin.student_lesson_content_edit.form.file.kilobyte') }}
                                        </div>

                                    @endif

                                </div>

                            </div>

                        @endif

                        @error('file')
                            <div class="lesson-content-edit-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- =================================================
                         IMAGE
                    ================================================== --}}

                    <div
                        class="lesson-content-edit-field"
                        id="image-field"
                    >

                        <label for="image">
                            {{ __('education_admin.student_lesson_content_edit.form.image.label') }}
                        </label>

                        <input
                            id="image"
                            type="file"
                            name="image"
                            accept="image/*"
                            class="lesson-content-edit-input"
                            style="padding-top:10px;"
                        >


                        @if(
                            $content->type === 'image' &&
                            $content->file_path
                        )

                            <div class="lesson-content-current-file">

                                <div class="lesson-content-current-file-icon">
                                    <i class="fa-solid fa-image"></i>
                                </div>

                                <div class="lesson-content-current-file-info">

                                    <div class="lesson-content-current-file-name">
                                        {{ __('education_admin.student_lesson_content_edit.form.image.current') }}
                                        {{ $content->file_name ?? basename($content->file_path) }}
                                    </div>

                                </div>

                            </div>

                            @php
                                $imagePath = ltrim($content->file_path, '/');
                            @endphp

                            @if(
                                $imagePath &&
                                file_exists(public_path($imagePath))
                            )

                                <img
                                    src="{{ asset($imagePath) }}"
                                    alt="{{ $content->title }}"
                                    class="lesson-content-current-image-preview"
                                >

                            @endif

                        @endif


                        <img
                            id="new-image-preview"
                            src=""
                            alt="{{ __('education_admin.student_lesson_content_edit.form.image.preview_alt') }}"
                            class="lesson-content-new-image-preview"
                        >


                        @error('image')
                            <div class="lesson-content-edit-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- =================================================
                         ACTIVE
                    ================================================== --}}

                    <div class="lesson-content-edit-field">

                        <label>
                            {{ __('education_admin.student_lesson_content_edit.form.status.label') }}
                        </label>

                        <div class="lesson-content-edit-checkbox">

                            <input
                                id="is_active"
                                type="checkbox"
                                name="is_active"
                                value="1"
                                @checked(
                                    old(
                                        'is_active',
                                        $content->is_active
                                    )
                                )
                            >

                            <label for="is_active">
                                {{ __('education_admin.student_lesson_content_edit.form.status.active_description') }}
                            </label>

                        </div>

                        @error('is_active')
                            <div class="lesson-content-edit-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- =================================================
                         ADD MULTIPLE NEW CONTENT
                    ================================================== --}}

                    <div class="lesson-content-additional-wrapper">

                        <div class="lesson-content-additional-header">

                            <div>

                                <h3 class="lesson-content-additional-title">
                                    {{ __('education_admin.student_lesson_content_edit.additional_content.title') }}
                                </h3>

                                <p class="lesson-content-additional-description">
                                    {{ __('education_admin.student_lesson_content_edit.additional_content.description') }}
                                </p>

                            </div>


                            <button
                                type="button"
                                class="lesson-content-add-btn"
                                id="add-content-btn"
                            >
                                <i class="fa-solid fa-plus"></i>

                                <span>
                                    {{ __('education_admin.student_lesson_content_edit.additional_content.add_item') }}
                                </span>
                            </button>

                        </div>


                        <div
                            id="additional-content-list"
                            class="additional-content-list"
                        >

                            @if(old('new_items'))

                                @foreach(old('new_items') as $index => $item)

                                    <div
                                        class="additional-content-item"
                                        data-index="{{ $index }}"
                                    >

                                        <div class="additional-content-item-header">

                                            <div class="additional-content-item-number">
                                                {{ __('education_admin.student_lesson_content_edit.additional_content.new_item') }}
                                                #{{ $loop->iteration }}
                                            </div>

                                            <button
                                                type="button"
                                                class="additional-content-remove"
                                                title="{{ __('education_admin.student_lesson_content_edit.additional_content.remove') }}"
                                                aria-label="{{ __('education_admin.student_lesson_content_edit.additional_content.remove') }}"
                                            >
                                                <i class="fa-solid fa-trash"></i>
                                            </button>

                                        </div>


                                        <div class="additional-content-item-body">

                                            {{-- TYPE / ORDER --}}

                                            <div class="lesson-content-edit-row">

                                                <div class="lesson-content-edit-field">

                                                    <label>
                                                        {{ __('education_admin.student_lesson_content_edit.additional_content.type') }}
                                                    </label>

                                                    <select
                                                        name="new_items[{{ $index }}][type]"
                                                        class="lesson-content-edit-select additional-type"
                                                    >

                                                        <option
                                                            value="text"
                                                            @selected(($item['type'] ?? 'text') === 'text')
                                                        >
                                                            {{ __('education_admin.student_lesson_content_edit.form.type.text') }}
                                                        </option>

                                                        <option
                                                            value="image"
                                                            @selected(($item['type'] ?? '') === 'image')
                                                        >
                                                            {{ __('education_admin.student_lesson_content_edit.form.type.image') }}
                                                        </option>

                                                        <option
                                                            value="link"
                                                            @selected(($item['type'] ?? '') === 'link')
                                                        >
                                                            {{ __('education_admin.student_lesson_content_edit.form.type.link') }}
                                                        </option>

                                                        <option
                                                            value="file"
                                                            @selected(($item['type'] ?? '') === 'file')
                                                        >
                                                            {{ __('education_admin.student_lesson_content_edit.form.type.file') }}
                                                        </option>

                                                    </select>

                                                </div>


                                                <div class="lesson-content-edit-field">

                                                    <label>
                                                        {{ __('education_admin.student_lesson_content_edit.form.sort_order.label') }}
                                                    </label>

                                                    <input
                                                        type="number"
                                                        name="new_items[{{ $index }}][sort_order]"
                                                        value="{{ $item['sort_order'] ?? '' }}"
                                                        class="lesson-content-edit-input"
                                                        min="0"
                                                        placeholder="{{ __('education_admin.student_lesson_content_edit.form.sort_order.placeholder') }}"
                                                    >

                                                </div>

                                            </div>


                                            {{-- TITLE --}}

                                            <div class="lesson-content-edit-field">

                                                <label>
                                                    {{ __('education_admin.student_lesson_content_edit.additional_content.title_label') }}
                                                </label>

                                                <input
                                                    type="text"
                                                    name="new_items[{{ $index }}][title]"
                                                    value="{{ $item['title'] ?? '' }}"
                                                    class="lesson-content-edit-input"
                                                    placeholder="{{ __('education_admin.student_lesson_content_edit.additional_content.title_placeholder') }}"
                                                >

                                            </div>


                                            {{-- DESCRIPTION --}}

                                            <div class="lesson-content-edit-field">

                                                <label>
                                                    {{ __('education_admin.student_lesson_content_edit.additional_content.description_label') }}
                                                </label>

                                                <textarea
                                                    name="new_items[{{ $index }}][description]"
                                                    class="lesson-content-edit-textarea"
                                                    placeholder="{{ __('education_admin.student_lesson_content_edit.additional_content.description_placeholder') }}"
                                                >{{ $item['description'] ?? '' }}</textarea>

                                            </div>


                                            {{-- CONTENT --}}

                                            <div
                                                class="lesson-content-edit-field additional-text-field"
                                            >

                                                <label>
                                                    {{ __('education_admin.student_lesson_content_edit.additional_content.content_label') }}
                                                </label>

                                                <textarea
                                                    name="new_items[{{ $index }}][content]"
                                                    class="lesson-content-edit-textarea"
                                                    placeholder="{{ __('education_admin.student_lesson_content_edit.additional_content.content_placeholder') }}"
                                                >{{ $item['content'] ?? '' }}</textarea>

                                            </div>


                                            {{-- URL --}}

                                            <div
                                                class="lesson-content-edit-field additional-url-field"
                                            >

                                                <label>
                                                    {{ __('education_admin.student_lesson_content_edit.additional_content.url_label') }}
                                                </label>

                                                <input
                                                    type="url"
                                                    name="new_items[{{ $index }}][url]"
                                                    value="{{ $item['url'] ?? '' }}"
                                                    class="lesson-content-edit-input"
                                                    placeholder="https://example.com/..."
                                                >

                                            </div>


                                            {{-- FILE / IMAGE --}}

                                            <div
                                                class="lesson-content-edit-field additional-file-field"
                                            >

                                                <label>
                                                    {{ __('education_admin.student_lesson_content_edit.additional_content.file_label') }}
                                                </label>

                                                <input
                                                    type="file"
                                                    name="new_items[{{ $index }}][file]"
                                                    class="lesson-content-edit-input additional-file-input"
                                                    style="padding-top:10px;"
                                                >

                                            </div>

                                        </div>

                                    </div>

                                @endforeach

                            @endif

                        </div>


                        <div
                            id="additional-content-empty"
                            class="additional-content-empty"
                            @if(old('new_items')) style="display:none;" @endif
                        >
                            {{ __('education_admin.student_lesson_content_edit.additional_content.empty') }}
                        </div>

                    </div>


                    {{-- =================================================
                         FOOTER
                    ================================================== --}}

                    <div class="lesson-content-edit-footer">

                        <a
                            href="{{ route(
                                'education.admin.student-lessons.content.index',
                                $studentLesson
                            ) }}"
                            class="lesson-content-edit-btn lesson-content-edit-btn-back"
                        >
                            <i class="fa-solid fa-xmark"></i>

                            <span>
                                {{ __('education_admin.student_lesson_content_edit.actions.cancel') }}
                            </span>

                        </a>


                        <button
                            type="submit"
                            class="lesson-content-edit-btn lesson-content-edit-btn-save"
                            id="save-content-btn"
                        >
                            <i class="fa-solid fa-floppy-disk"></i>

                            <span>
                                {{ __('education_admin.student_lesson_content_edit.actions.save_changes') }}
                            </span>

                        </button>

                    </div>

                </form>

            </div>

        </div>


        {{-- =================================================
             SIDEBAR
        ================================================== --}}

        <aside class="lesson-content-edit-sidebar">

            @php
                $lesson = $studentLesson->sourceLesson;
            @endphp


            {{-- =================================================
                 LESSON INFORMATION
            ================================================== --}}

            <div class="lesson-content-edit-side-card">

                <div class="lesson-content-edit-side-title">

                    <i class="fa-solid fa-book-open"></i>

                    <span>
                        {{ __('education_admin.student_lesson_content_edit.sidebar.lesson_information') }}
                    </span>

                </div>


                <div class="lesson-content-lesson-info">

                    <div class="lesson-content-lesson-info-item">

                        <div class="lesson-content-lesson-info-label">
                            {{ __('education_admin.student_lesson_content_edit.sidebar.lesson') }}
                        </div>

                        <div class="lesson-content-lesson-info-value">
                            {{ $lesson?->title ?? __('education_admin.student_lesson_content_edit.sidebar.student_lesson') }}
                        </div>

                    </div>


                    @if($lesson?->slug)

                        <div class="lesson-content-lesson-info-item">

                            <div class="lesson-content-lesson-info-label">
                                {{ __('education_admin.student_lesson_content_edit.sidebar.identifier') }}
                            </div>

                            <div class="lesson-content-lesson-info-value">
                                {{ $lesson->slug }}
                            </div>

                        </div>

                    @endif


                    @if($studentLesson->student)

                        <div class="lesson-content-lesson-info-item">

                            <div class="lesson-content-lesson-info-label">
                                {{ __('education_admin.student_lesson_content_edit.sidebar.student') }}
                            </div>

                            <div class="lesson-content-lesson-info-value">
                                {{ $studentLesson->student->name }}
                            </div>

                        </div>

                    @endif


                    <div class="lesson-content-lesson-info-item">

                        <div class="lesson-content-lesson-info-label">
                            {{ __('education_admin.student_lesson_content_edit.sidebar.content_number') }}
                        </div>

                        <div class="lesson-content-lesson-info-value">
                            #{{ $content->id }}
                        </div>

                    </div>


                    <div class="lesson-content-lesson-info-item">

                        <div class="lesson-content-lesson-info-label">
                            {{ __('education_admin.student_lesson_content_edit.sidebar.type') }}
                        </div>

                        <div class="lesson-content-lesson-info-value">

                            @switch($content->type)

                                @case('text')
                                    {{ __('education_admin.student_lesson_content_edit.form.type.text') }}
                                    @break

                                @case('image')
                                    {{ __('education_admin.student_lesson_content_edit.form.type.image') }}
                                    @break

                                @case('link')
                                    {{ __('education_admin.student_lesson_content_edit.form.type.link') }}
                                    @break

                                @case('file')
                                    {{ __('education_admin.student_lesson_content_edit.form.type.file') }}
                                    @break

                                @default
                                    {{ ucfirst($content->type) }}

                            @endswitch

                        </div>

                    </div>


                    <div class="lesson-content-lesson-info-item">

                        <div class="lesson-content-lesson-info-label">
                            {{ __('education_admin.student_lesson_content_edit.sidebar.order') }}
                        </div>

                        <div class="lesson-content-lesson-info-value">
                            {{ $content->sort_order ?? 0 }}
                        </div>

                    </div>

                </div>

            </div>


            {{-- =================================================
                 SOURCE CONTENT
            ================================================== --}}

            @if($content->sourceContent)

                <div class="lesson-content-edit-side-card">

                    <div class="lesson-content-edit-side-title">

                        <i class="fa-solid fa-link"></i>

                        <span>
                            {{ __('education_admin.student_lesson_content_edit.sidebar.source_content') }}
                        </span>

                    </div>


                    <div class="lesson-content-source-box">

                        <div class="lesson-content-source-label">
                            {{ __('education_admin.student_lesson_content_edit.sidebar.source') }}
                        </div>

                        <div class="lesson-content-source-title">
                            {{ $content->sourceContent->title ?? __('education_admin.student_lesson_content_edit.sidebar.original_content') }}
                        </div>

                    </div>

                </div>

            @endif


            {{-- =================================================
                 EDITING TIPS
            ================================================== --}}

            <div class="lesson-content-edit-side-card">

                <div class="lesson-content-edit-side-title">

                    <i class="fa-solid fa-circle-info"></i>

                    <span>
                        {{ __('education_admin.student_lesson_content_edit.sidebar.editing_tips') }}
                    </span>

                </div>


                <div style="
                    color:var(--edu-muted);
                    font-size:11px;
                    line-height:1.8;
                ">

                    <p style="margin:0 0 8px;">
                        {{ __('education_admin.student_lesson_content_edit.sidebar.tip_edit') }}
                    </p>

                    <p style="margin:0 0 8px;">
                        {{ __('education_admin.student_lesson_content_edit.sidebar.tip_replace') }}
                    </p>

                    <p style="margin:0 0 8px;">
                        {{ __('education_admin.student_lesson_content_edit.sidebar.tip_add') }}
                    </p>

                    <p style="margin:0;">
                        {{ __('education_admin.student_lesson_content_edit.sidebar.tip_storage') }}

                        <strong>
                            public/images/education/student-lessons
                        </strong>
                    </p>

                </div>

            </div>


            {{-- =================================================
                 DANGER ZONE
            ================================================== --}}

            <div class="lesson-content-edit-side-card lesson-content-danger-card">

                <div class="lesson-content-edit-side-title">

                    <i class="fa-solid fa-triangle-exclamation"></i>

                    <span>
                        {{ __('education_admin.student_lesson_content_edit.sidebar.danger_zone') }}
                    </span>

                </div>


                <p class="lesson-content-danger-text">
                    {{ __('education_admin.student_lesson_content_edit.sidebar.danger_description') }}
                </p>


                <form
                    method="POST"
                    action="{{ route(
                        'education.admin.student-lessons.content.destroy',
                        [
                            'studentLesson' => $studentLesson,
                            'content' => $content,
                        ]
                    ) }}"
                    onsubmit="return confirm(
                        @json(__('education_admin.student_lesson_content_edit.delete.confirm'))
                    );"
                >

                    @csrf

                    @method('DELETE')

                    <button
                        type="submit"
                        class="lesson-content-delete-btn"
                    >
                        <i class="fa-solid fa-trash"></i>

                        {{ __('education_admin.student_lesson_content_edit.sidebar.delete_content') }}

                    </button>

                </form>

            </div>

        </aside>

    </div>

</div>


<script>
document.addEventListener('DOMContentLoaded', function () {

    /* =========================================================
       EXISTING CONTENT
    ========================================================= */

    const typeSelect = document.getElementById('type');

    const contentField = document.getElementById('content-field');
    const urlField = document.getElementById('url-field');
    const fileField = document.getElementById('file-field');
    const imageField = document.getElementById('image-field');

    function hideElement(element) {
        if (element) {
            element.style.display = 'none';
        }
    }

    function showElement(element) {
        if (element) {
            element.style.display = 'flex';
        }
    }

    function updateExistingFields() {

        if (!typeSelect) {
            return;
        }

        const type = typeSelect.value;

        hideElement(contentField);
        hideElement(urlField);
        hideElement(fileField);
        hideElement(imageField);

        switch (type) {

            case 'text':
                showElement(contentField);
                break;

            case 'link':
                showElement(urlField);
                showElement(contentField);
                break;

            case 'file':
                showElement(fileField);
                showElement(contentField);
                break;

            case 'image':
                showElement(imageField);
                showElement(contentField);
                break;
        }
    }

    if (typeSelect) {

        typeSelect.addEventListener(
            'change',
            updateExistingFields
        );

        updateExistingFields();
    }


    /* =========================================================
       NEW IMAGE PREVIEW
    ========================================================= */

    const imageInput =
        document.getElementById('image');

    const newImagePreview =
        document.getElementById('new-image-preview');

    if (imageInput && newImagePreview) {

        imageInput.addEventListener(
            'change',
            function () {

                const file = this.files?.[0];

                if (!file) {

                    newImagePreview.src = '';
                    newImagePreview.style.display = 'none';

                    return;
                }

                if (!file.type.startsWith('image/')) {

                    newImagePreview.src = '';
                    newImagePreview.style.display = 'none';

                    return;
                }

                const objectUrl =
                    URL.createObjectURL(file);

                newImagePreview.src = objectUrl;
                newImagePreview.style.display = 'block';

                newImagePreview.onload = function () {
                    URL.revokeObjectURL(objectUrl);
                };
            }
        );
    }


    /* =========================================================
       ADDITIONAL CONTENT
    ========================================================= */

    const addButton =
        document.getElementById('add-content-btn');

    const list =
        document.getElementById('additional-content-list');

    const emptyMessage =
        document.getElementById('additional-content-empty');


    let contentIndex = list
        ? list.querySelectorAll(
            '.additional-content-item'
        ).length
        : 0;


    /* =========================================================
       EMPTY MESSAGE
    ========================================================= */

    function updateEmptyMessage() {

        if (!list || !emptyMessage) {
            return;
        }

        const count =
            list.querySelectorAll(
                '.additional-content-item'
            ).length;

        emptyMessage.style.display =
            count === 0
                ? 'block'
                : 'none';
    }


    /* =========================================================
       ADDITIONAL FIELD VISIBILITY
    ========================================================= */

    function updateAdditionalFields(item) {

        if (!item) {
            return;
        }

        const type =
            item.querySelector(
                '.additional-type'
            )?.value;

        const textField =
            item.querySelector(
                '.additional-text-field'
            );

        const urlField =
            item.querySelector(
                '.additional-url-field'
            );

        const fileField =
            item.querySelector(
                '.additional-file-field'
            );


        hideElement(textField);
        hideElement(urlField);
        hideElement(fileField);


        switch (type) {

            case 'text':

                showElement(textField);

                break;


            case 'link':

                showElement(textField);
                showElement(urlField);

                break;


            case 'file':

                showElement(textField);
                showElement(fileField);

                break;


            case 'image':

                showElement(textField);
                showElement(fileField);

                break;
        }
    }


    /* =========================================================
       RENUMBER ADDITIONAL ITEMS
    ========================================================= */

    function renumberItems() {

        if (!list) {
            return;
        }

        const items =
            list.querySelectorAll(
                '.additional-content-item'
            );

        items.forEach(function (item, index) {

            const number =
                item.querySelector(
                    '.additional-content-item-number'
                );

            if (number) {

                number.textContent =
                    @json(__('education_admin.student_lesson_content_edit.additional_content.new_item'))
                    + ' #' + (index + 1);
            }
        });
    }


    /* =========================================================
       CREATE ADDITIONAL ITEM
    ========================================================= */

    function addContentItem() {

        if (!list) {
            return;
        }

        const index = contentIndex++;

        const item =
            document.createElement('div');

        item.className =
            'additional-content-item';

        item.dataset.index =
            index;


        item.innerHTML = `

            <div class="additional-content-item-header">

                <div class="additional-content-item-number">
                    ${@json(__('education_admin.student_lesson_content_edit.additional_content.new_item'))} #1
                </div>

                <button
                    type="button"
                    class="additional-content-remove"
                    title="${@json(__('education_admin.student_lesson_content_edit.additional_content.remove'))}"
                    aria-label="${@json(__('education_admin.student_lesson_content_edit.additional_content.remove'))}"
                >
                    <i class="fa-solid fa-trash"></i>
                </button>

            </div>


            <div class="additional-content-item-body">

                <div class="lesson-content-edit-row">

                    <div class="lesson-content-edit-field">

                        <label>
                            ${@json(__('education_admin.student_lesson_content_edit.additional_content.type'))}
                        </label>

                        <select
                            name="new_items[${index}][type]"
                            class="lesson-content-edit-select additional-type"
                        >

                            <option value="text">
                                ${@json(__('education_admin.student_lesson_content_edit.form.type.text'))}
                            </option>

                            <option value="image">
                                ${@json(__('education_admin.student_lesson_content_edit.form.type.image'))}
                            </option>

                            <option value="link">
                                ${@json(__('education_admin.student_lesson_content_edit.form.type.link'))}
                            </option>

                            <option value="file">
                                ${@json(__('education_admin.student_lesson_content_edit.form.type.file'))}
                            </option>

                        </select>

                    </div>


                    <div class="lesson-content-edit-field">

                        <label>
                            ${@json(__('education_admin.student_lesson_content_edit.form.sort_order.label'))}
                        </label>

                        <input
                            type="number"
                            name="new_items[${index}][sort_order]"
                            class="lesson-content-edit-input"
                            min="0"
                            placeholder="${@json(__('education_admin.student_lesson_content_edit.form.sort_order.placeholder'))}"
                        >

                    </div>

                </div>


                <div class="lesson-content-edit-field">

                    <label>
                        ${@json(__('education_admin.student_lesson_content_edit.additional_content.title_label'))}
                    </label>

                    <input
                        type="text"
                        name="new_items[${index}][title]"
                        class="lesson-content-edit-input"
                        placeholder="${@json(__('education_admin.student_lesson_content_edit.additional_content.title_placeholder'))}"
                    >

                </div>


                <div class="lesson-content-edit-field">

                    <label>
                        ${@json(__('education_admin.student_lesson_content_edit.additional_content.description_label'))}
                    </label>

                    <textarea
                        name="new_items[${index}][description]"
                        class="lesson-content-edit-textarea"
                        placeholder="${@json(__('education_admin.student_lesson_content_edit.additional_content.description_placeholder'))}"
                    ></textarea>

                </div>


                <div
                    class="lesson-content-edit-field additional-text-field"
                >

                    <label>
                        ${@json(__('education_admin.student_lesson_content_edit.additional_content.content_label'))}
                    </label>

                    <textarea
                        name="new_items[${index}][content]"
                        class="lesson-content-edit-textarea"
                        placeholder="${@json(__('education_admin.student_lesson_content_edit.additional_content.content_placeholder'))}"
                    ></textarea>

                </div>


                <div
                    class="lesson-content-edit-field additional-url-field"
                >

                    <label>
                        ${@json(__('education_admin.student_lesson_content_edit.additional_content.url_label'))}
                    </label>

                    <input
                        type="url"
                        name="new_items[${index}][url]"
                        class="lesson-content-edit-input"
                        placeholder="https://example.com/..."
                    >

                </div>


                <div
                    class="lesson-content-edit-field additional-file-field"
                >

                    <label>
                        ${@json(__('education_admin.student_lesson_content_edit.additional_content.file_label'))}
                    </label>

                    <input
                        type="file"
                        name="new_items[${index}][file]"
                        class="lesson-content-edit-input additional-file-input"
                        style="padding-top:10px;"
                    >

                </div>

            </div>
        `;


        list.appendChild(item);

        updateAdditionalFields(item);

        updateEmptyMessage();

        renumberItems();

        const firstInput =
            item.querySelector(
                'input[type="text"]'
            );

        if (firstInput) {
            firstInput.focus();
        }
    }


    /* =========================================================
       ADD BUTTON
    ========================================================= */

    if (addButton) {

        addButton.addEventListener(
            'click',
            addContentItem
        );
    }


    /* =========================================================
       ADDITIONAL CONTENT EVENTS
    ========================================================= */

    if (list) {

        list.addEventListener(
            'change',
            function (event) {

                if (
                    event.target.classList.contains(
                        'additional-type'
                    )
                ) {

                    const item =
                        event.target.closest(
                            '.additional-content-item'
                        );

                    updateAdditionalFields(item);
                }
            }
        );


        list.addEventListener(
            'click',
            function (event) {

                const removeButton =
                    event.target.closest(
                        '.additional-content-remove'
                    );

                if (!removeButton) {
                    return;
                }

                const item =
                    removeButton.closest(
                        '.additional-content-item'
                    );

                if (!item) {
                    return;
                }

                item.remove();

                updateEmptyMessage();

                renumberItems();
            }
        );


        list.querySelectorAll(
            '.additional-content-item'
        ).forEach(function (item) {

            updateAdditionalFields(item);
        });
    }


    /* =========================================================
       SAVE BUTTON
    ========================================================= */

    const form =
        document.getElementById(
            'lesson-content-edit-form'
        );

    const saveButton =
        document.getElementById(
            'save-content-btn'
        );

    if (form && saveButton) {

        form.addEventListener(
            'submit',
            function () {

                saveButton.disabled = true;

                const icon =
                    saveButton.querySelector('i');

                const text =
                    saveButton.querySelector('span');

                if (icon) {

                    icon.className =
                        'fa-solid fa-spinner fa-spin';
                }

                if (text) {

                    text.textContent =
                        @json(__('education_admin.student_lesson_content_edit.actions.saving'));
                }
            }
        );
    }


    /* =========================================================
       INITIAL STATE
    ========================================================= */

    updateEmptyMessage();

});
</script>

@endsection
