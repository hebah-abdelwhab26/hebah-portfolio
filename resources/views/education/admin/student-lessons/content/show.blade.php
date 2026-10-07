@extends('education.admin.layouts.app')

@section('title', __('education_admin.student_lesson_content_show.page_title'))

@section('content')

<style>
    .student-content-show-page {
        --cream: #f7f1e5;
        --cream-light: #fffdf8;
        --gold: #b08d3c;
        --gold-light: #d4b86a;
        --green: #315c45;
        --green-dark: #234634;
        --green-soft: #eaf2ed;
        --text: #26352d;
        --muted: #7b817c;
        --border: #e7dfd0;
        --danger: #a94b4b;
        --white: #fff;
        color: var(--text);
    }

    /* ============================================================
       HEADER
    ============================================================ */

    .student-content-show-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 28px;
    }

    .student-content-show-breadcrumb {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
        color: var(--gold);
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .student-content-show-breadcrumb i {
        font-size: 11px;
    }

    .student-content-show-title {
        margin: 0;
        color: var(--green-dark);
        font-size: 30px;
        font-weight: 700;
        line-height: 1.3;
    }

    .student-content-show-description {
        margin: 8px 0 0;
        color: var(--muted);
        font-size: 14px;
        line-height: 1.8;
    }

    .student-content-show-actions {
        display: flex;
        gap: 9px;
        flex-wrap: wrap;
    }

    .student-content-show-btn {
        min-height: 43px;
        padding: 0 15px;
        border-radius: 11px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        border: 1px solid transparent;
        transition: .2s ease;
        cursor: pointer;
    }

    .student-content-show-btn:hover {
        transform: translateY(-1px);
    }

    .student-content-show-btn-primary {
        background: var(--green);
        color: #fff;
    }

    .student-content-show-btn-primary:hover {
        background: var(--green-dark);
        color: #fff;
    }

    .student-content-show-btn-secondary {
        background: var(--cream);
        color: var(--green-dark);
        border-color: var(--border);
    }

    .student-content-show-btn-secondary:hover {
        background: #efe6d6;
        color: var(--green-dark);
    }

    .student-content-show-btn-danger {
        background: #fff;
        color: var(--danger);
        border-color: #ead2d2;
    }

    .student-content-show-btn-danger:hover {
        background: var(--danger);
        color: #fff;
        border-color: var(--danger);
    }


    /* ============================================================
       MAIN CARD
    ============================================================ */

    .student-content-show-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 8px 24px rgba(49, 92, 69, .05);
    }

    .student-content-show-card-header {
        padding: 20px;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 20px;
    }

    .student-content-show-heading {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        min-width: 0;
    }

    .student-content-show-type-icon {
        width: 48px;
        height: 48px;
        border-radius: 13px;
        background: var(--green-soft);
        color: var(--green);
        display: flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 auto;
        font-size: 18px;
    }

    .student-content-show-heading-info {
        min-width: 0;
    }

    .student-content-show-heading-title {
        margin: 0;
        color: var(--green-dark);
        font-size: 19px;
        font-weight: 700;
        line-height: 1.5;
        word-break: break-word;
    }

    .student-content-show-type-label {
        margin-top: 4px;
        color: var(--muted);
        font-size: 12px;
    }


    /* ============================================================
       STATUS
    ============================================================ */

    .student-content-show-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 11px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 700;
        white-space: nowrap;
        flex: 0 0 auto;
    }

    .student-content-show-status.active {
        background: var(--green-soft);
        color: var(--green);
    }

    .student-content-show-status.inactive {
        background: #f8ecec;
        color: var(--danger);
    }


    /* ============================================================
       BODY
    ============================================================ */

    .student-content-show-body {
        padding: 25px;
    }

    .student-content-show-section {
        margin-bottom: 24px;
    }

    .student-content-show-section:last-child {
        margin-bottom: 0;
    }

    .student-content-show-section-title {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 10px;
        color: var(--green-dark);
        font-size: 14px;
        font-weight: 700;
    }

    .student-content-show-section-title i {
        color: var(--gold);
    }


    /* ============================================================
       DESCRIPTION
    ============================================================ */

    .student-content-show-description-box {
        padding: 15px 17px;
        border: 1px solid var(--border);
        background: var(--cream-light);
        border-radius: 13px;
        color: var(--text);
        font-size: 13px;
        line-height: 1.9;
        white-space: pre-line;
    }


    /* ============================================================
       TEXT CONTENT
    ============================================================ */

    .student-content-show-text-box {
        padding: 20px;
        border: 1px solid var(--border);
        background: var(--cream-light);
        border-radius: 14px;
        color: var(--text);
        font-size: 14px;
        line-height: 2;
        white-space: pre-wrap;
        word-break: break-word;
    }


    /* ============================================================
       IMAGE
    ============================================================ */

    .student-content-show-image-wrapper {
        border: 1px solid var(--border);
        background: var(--cream-light);
        border-radius: 14px;
        padding: 12px;
        text-align: center;
        overflow: hidden;
    }

    .student-content-show-image {
        display: block;
        max-width: 100%;
        max-height: 650px;
        width: auto;
        height: auto;
        margin: 0 auto;
        border-radius: 10px;
        object-fit: contain;
    }


    /* ============================================================
       LINK
    ============================================================ */

    .student-content-show-link-box {
        padding: 17px;
        border: 1px solid var(--border);
        background: var(--cream-light);
        border-radius: 14px;
    }

    .student-content-show-link {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        color: var(--green);
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        word-break: break-all;
    }

    .student-content-show-link:hover {
        color: var(--gold);
    }


    /* ============================================================
       FILE
    ============================================================ */

    .student-content-show-file-box {
        padding: 18px;
        border: 1px solid var(--border);
        background: var(--cream-light);
        border-radius: 14px;
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .student-content-show-file-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background: var(--cream);
        color: var(--gold);
        display: flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 auto;
        font-size: 19px;
    }

    .student-content-show-file-info {
        flex: 1;
        min-width: 0;
    }

    .student-content-show-file-name {
        color: var(--green-dark);
        font-size: 13px;
        font-weight: 700;
        word-break: break-word;
    }

    .student-content-show-file-meta {
        margin-top: 4px;
        color: var(--muted);
        font-size: 11px;
    }

    .student-content-show-file-button {
        min-height: 37px;
        padding: 0 12px;
        border-radius: 9px;
        background: var(--green);
        color: #fff;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        font-size: 11px;
        font-weight: 700;
        flex: 0 0 auto;
        transition: .2s ease;
    }

    .student-content-show-file-button:hover {
        background: var(--green-dark);
        color: #fff;
    }


    /* ============================================================
       SOURCE CONTENT
    ============================================================ */

    .student-content-show-source {
        background: var(--green-soft);
        border: 1px solid #d8e7dd;
        border-radius: 14px;
        padding: 16px 18px;
    }

    .student-content-show-source-label {
        color: var(--muted);
        font-size: 11px;
        margin-bottom: 5px;
    }

    .student-content-show-source-title {
        color: var(--green-dark);
        font-size: 14px;
        font-weight: 700;
    }

    .student-content-show-source-note {
        margin-top: 5px;
        color: var(--muted);
        font-size: 11px;
        line-height: 1.7;
    }


    /* ============================================================
       META GRID
    ============================================================ */

    .student-content-show-meta-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 12px;
    }

    .student-content-show-meta-item {
        padding: 14px 15px;
        background: var(--cream-light);
        border: 1px solid var(--border);
        border-radius: 12px;
    }

    .student-content-show-meta-label {
        color: var(--muted);
        font-size: 10px;
        margin-bottom: 5px;
    }

    .student-content-show-meta-value {
        color: var(--green-dark);
        font-size: 12px;
        font-weight: 700;
        word-break: break-word;
    }


    /* ============================================================
       EMPTY CONTENT
    ============================================================ */

    .student-content-show-empty {
        padding: 35px 20px;
        text-align: center;
        border: 1px dashed var(--border);
        background: var(--cream-light);
        border-radius: 14px;
    }

    .student-content-show-empty-icon {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        background: var(--cream);
        color: var(--gold);
        margin: 0 auto 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    .student-content-show-empty-title {
        color: var(--green-dark);
        font-size: 14px;
        font-weight: 700;
    }

    .student-content-show-empty-text {
        margin-top: 5px;
        color: var(--muted);
        font-size: 12px;
    }


    /* ============================================================
       FOOTER
    ============================================================ */

    .student-content-show-footer {
        padding: 18px 20px;
        border-top: 1px solid var(--border);
        background: #fffdfa;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
    }

    .student-content-show-footer-left,
    .student-content-show-footer-right {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }


    /* ============================================================
       RESPONSIVE
    ============================================================ */

    @media(max-width: 800px) {

        .student-content-show-header {
            flex-direction: column;
        }

        .student-content-show-actions {
            width: 100%;
        }

        .student-content-show-actions
        .student-content-show-btn {
            flex: 1;
        }

        .student-content-show-card-header {
            flex-direction: column;
        }

        .student-content-show-status {
            align-self: flex-start;
        }

        .student-content-show-meta-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .student-content-show-footer {
            flex-direction: column;
            align-items: stretch;
        }

        .student-content-show-footer-left,
        .student-content-show-footer-right {
            width: 100%;
        }

        .student-content-show-footer-right
        .student-content-show-btn {
            flex: 1;
        }
    }


    @media(max-width: 550px) {

        .student-content-show-title {
            font-size: 25px;
        }

        .student-content-show-body {
            padding: 17px;
        }

        .student-content-show-card-header {
            padding: 16px;
        }

        .student-content-show-heading {
            gap: 10px;
        }

        .student-content-show-type-icon {
            width: 42px;
            height: 42px;
            border-radius: 11px;
            font-size: 16px;
        }

        .student-content-show-heading-title {
            font-size: 16px;
        }

        .student-content-show-meta-grid {
            grid-template-columns: 1fr;
        }

        .student-content-show-file-box {
            flex-wrap: wrap;
        }

        .student-content-show-file-button {
            width: 100%;
            justify-content: center;
        }
    }
</style>


@php

    /*
    |--------------------------------------------------------------------------
    | أيقونة نوع المحتوى
    |--------------------------------------------------------------------------
    */

    $typeIcon = match($content->type) {

        'text' =>
            'fa-align-left',

        'image' =>
            'fa-image',

        'link' =>
            'fa-link',

        'file' =>
            'fa-file',

        default =>
            'fa-file-lines',

    };


    /*
    |--------------------------------------------------------------------------
    | اسم نوع المحتوى
    |--------------------------------------------------------------------------
    */

    $typeLabel = match($content->type) {

        'text' =>
            __('education_admin.student_lesson_content_show.types.text'),

        'image' =>
            __('education_admin.student_lesson_content_show.types.image'),

        'link' =>
            __('education_admin.student_lesson_content_show.types.link'),

        'file' =>
            __('education_admin.student_lesson_content_show.types.file'),

        default =>
            __('education_admin.student_lesson_content_show.types.default'),

    };


    /*
    |--------------------------------------------------------------------------
    | رابط الملف
    |--------------------------------------------------------------------------
    */

    $fileUrl = null;

    if ($content->file_path) {

        $fileUrl = asset($content->file_path);

    }


    /*
    |--------------------------------------------------------------------------
    | حجم الملف
    |--------------------------------------------------------------------------
    */

    $formattedFileSize = null;

    if ($content->file_size) {

        $bytes = (int) $content->file_size;

        if ($bytes >= 1048576) {

            $formattedFileSize =
                number_format(
                    $bytes / 1048576,
                    2
                ) . ' ' .
                __('education_admin.student_lesson_content_show.file.units.megabyte');

        } elseif ($bytes >= 1024) {

            $formattedFileSize =
                number_format(
                    $bytes / 1024,
                    2
                ) . ' ' .
                __('education_admin.student_lesson_content_show.file.units.kilobyte');

        } else {

            $formattedFileSize =
                $bytes . ' ' .
                __('education_admin.student_lesson_content_show.file.units.byte');

        }

    }

@endphp


<div
    class="student-content-show-page"
    dir="rtl"
>

    {{-- ============================================================
        HEADER
    ============================================================ --}}

    <div class="student-content-show-header">

        <div>

            <div class="student-content-show-breadcrumb">

                <i class="fa-solid fa-graduation-cap"></i>

                <span>
                    {{ __('education_admin.student_lesson_content_show.header.student_lessons') }}
                </span>

                <i class="fa-solid fa-chevron-left"></i>

                <span>
                    {{ $studentLesson->title ?? __('education_admin.student_lesson_content_show.header.student_lesson_default') }}
                </span>

                <i class="fa-solid fa-chevron-left"></i>

                <span>
                    {{ __('education_admin.student_lesson_content_show.header.content') }}
                </span>

            </div>


            <h1 class="student-content-show-title">
                {{ __('education_admin.student_lesson_content_show.header.title') }}
            </h1>


            <p class="student-content-show-description">
                {{ __('education_admin.student_lesson_content_show.header.description') }}
            </p>

        </div>


        <div class="student-content-show-actions">

            <a
                href="{{ route(
                    'education.admin.student-lessons.content.index',
                    $studentLesson
                ) }}"
                class="student-content-show-btn student-content-show-btn-secondary"
            >

                <i class="fa-solid fa-arrow-right"></i>

                {{ __('education_admin.student_lesson_content_show.actions.back_to_content') }}

            </a>


            <a
                href="{{ route(
                    'education.admin.student-lessons.content.edit',
                    [$studentLesson, $content]
                ) }}"
                class="student-content-show-btn student-content-show-btn-primary"
            >

                <i class="fa-solid fa-pen"></i>

                {{ __('education_admin.student_lesson_content_show.actions.edit_content') }}

            </a>

        </div>

    </div>


    {{-- ============================================================
        CONTENT CARD
    ============================================================ --}}

    <div class="student-content-show-card">

        {{-- ========================================================
            CARD HEADER
        ========================================================= --}}

        <div class="student-content-show-card-header">

            <div class="student-content-show-heading">

                <div class="student-content-show-type-icon">

                    <i class="fa-solid {{ $typeIcon }}"></i>

                </div>


                <div class="student-content-show-heading-info">

                    <h2 class="student-content-show-heading-title">

                        {{ $content->title ?: __('education_admin.student_lesson_content_show.content.untitled') }}

                    </h2>


                    <div class="student-content-show-type-label">

                        {{ __('education_admin.student_lesson_content_show.content.type_label') }}

                        {{ $typeLabel }}

                    </div>

                </div>

            </div>


            <span
                class="student-content-show-status {{ $content->is_active ? 'active' : 'inactive' }}"
            >

                <i class="fa-solid
                    {{ $content->is_active
                        ? 'fa-circle-check'
                        : 'fa-circle-xmark'
                    }}
                "></i>

                {{ $content->is_active
                    ? __('education_admin.student_lesson_content_show.status.active')
                    : __('education_admin.student_lesson_content_show.status.inactive')
                }}

            </span>

        </div>


        {{-- ========================================================
            BODY
        ========================================================= --}}

        <div class="student-content-show-body">


            {{-- ====================================================
                DESCRIPTION
            ===================================================== --}}

            @if($content->description)

                <div class="student-content-show-section">

                    <div class="student-content-show-section-title">

                        <i class="fa-solid fa-align-left"></i>

                        <span>
                            {{ __('education_admin.student_lesson_content_show.sections.description') }}
                        </span>

                    </div>


                    <div class="student-content-show-description-box">

                        {{ $content->description }}

                    </div>

                </div>

            @endif


            {{-- ====================================================
                TEXT CONTENT
            ===================================================== --}}

            @if($content->type === 'text')

                <div class="student-content-show-section">

                    <div class="student-content-show-section-title">

                        <i class="fa-solid fa-file-lines"></i>

                        <span>
                            {{ __('education_admin.student_lesson_content_show.sections.text_content') }}
                        </span>

                    </div>


                    @if($content->content)

                        <div class="student-content-show-text-box">

                            {{ $content->content }}

                        </div>

                    @else

                        <div class="student-content-show-empty">

                            <div class="student-content-show-empty-icon">

                                <i class="fa-solid fa-file-lines"></i>

                            </div>

                            <div class="student-content-show-empty-title">
                                {{ __('education_admin.student_lesson_content_show.empty.no_text_title') }}
                            </div>

                            <div class="student-content-show-empty-text">
                                {{ __('education_admin.student_lesson_content_show.empty.no_text_description') }}
                            </div>

                        </div>

                    @endif

                </div>

            @endif


            {{-- ====================================================
                IMAGE CONTENT
            ===================================================== --}}

            @if($content->type === 'image')

                <div class="student-content-show-section">

                    <div class="student-content-show-section-title">

                        <i class="fa-solid fa-image"></i>

                        <span>
                            {{ __('education_admin.student_lesson_content_show.sections.image') }}
                        </span>

                    </div>


                    @if($fileUrl)

                        <div class="student-content-show-image-wrapper">

                            <img
                                src="{{ $fileUrl }}"
                                alt="{{ $content->title ?: __('education_admin.student_lesson_content_show.image.default_alt') }}"
                                class="student-content-show-image"
                            >

                        </div>

                    @else

                        <div class="student-content-show-empty">

                            <div class="student-content-show-empty-icon">

                                <i class="fa-solid fa-image"></i>

                            </div>

                            <div class="student-content-show-empty-title">
                                {{ __('education_admin.student_lesson_content_show.empty.no_image_title') }}
                            </div>

                            <div class="student-content-show-empty-text">
                                {{ __('education_admin.student_lesson_content_show.empty.no_image_description') }}
                            </div>

                        </div>

                    @endif

                </div>

            @endif


            {{-- ====================================================
                LINK CONTENT
            ===================================================== --}}

            @if($content->type === 'link')

                <div class="student-content-show-section">

                    <div class="student-content-show-section-title">

                        <i class="fa-solid fa-link"></i>

                        <span>
                            {{ __('education_admin.student_lesson_content_show.sections.link') }}
                        </span>

                    </div>


                    @if($content->url)

                        <div class="student-content-show-link-box">

                            <a
                                href="{{ $content->url }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="student-content-show-link"
                            >

                                <i class="fa-solid fa-arrow-up-left-from-circle"></i>

                                <span>
                                    {{ $content->url }}
                                </span>

                            </a>

                        </div>

                    @else

                        <div class="student-content-show-empty">

                            <div class="student-content-show-empty-icon">

                                <i class="fa-solid fa-link"></i>

                            </div>

                            <div class="student-content-show-empty-title">
                                {{ __('education_admin.student_lesson_content_show.empty.no_link_title') }}
                            </div>

                            <div class="student-content-show-empty-text">
                                {{ __('education_admin.student_lesson_content_show.empty.no_link_description') }}
                            </div>

                        </div>

                    @endif

                </div>

            @endif


            {{-- ====================================================
                FILE CONTENT
            ===================================================== --}}

            @if($content->type === 'file')

                <div class="student-content-show-section">

                    <div class="student-content-show-section-title">

                        <i class="fa-solid fa-file"></i>

                        <span>
                            {{ __('education_admin.student_lesson_content_show.sections.attached_file') }}
                        </span>

                    </div>


                    @if($fileUrl)

                        <div class="student-content-show-file-box">

                            <div class="student-content-show-file-icon">

                                <i class="fa-solid fa-file"></i>

                            </div>


                            <div class="student-content-show-file-info">

                                <div class="student-content-show-file-name">

                                    {{ $content->file_name ?: __('education_admin.student_lesson_content_show.file.default_name') }}

                                </div>


                                <div class="student-content-show-file-meta">

                                    @if($content->mime_type)
                                        {{ $content->mime_type }}
                                    @endif

                                    @if($content->mime_type && $formattedFileSize)
                                        ·
                                    @endif

                                    @if($formattedFileSize)
                                        {{ $formattedFileSize }}
                                    @endif

                                </div>

                            </div>


                            <a
                                href="{{ $fileUrl }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="student-content-show-file-button"
                            >

                                <i class="fa-solid fa-download"></i>

                                {{ __('education_admin.student_lesson_content_show.file.open') }}

                            </a>

                        </div>

                    @else

                        <div class="student-content-show-empty">

                            <div class="student-content-show-empty-icon">

                                <i class="fa-solid fa-file-circle-xmark"></i>

                            </div>

                            <div class="student-content-show-empty-title">
                                {{ __('education_admin.student_lesson_content_show.empty.no_file_title') }}
                            </div>

                            <div class="student-content-show-empty-text">
                                {{ __('education_admin.student_lesson_content_show.empty.no_file_description') }}
                            </div>

                        </div>

                    @endif

                </div>

            @endif


            {{-- ====================================================
                SOURCE CONTENT
            ===================================================== --}}

            @if($content->sourceContent)

                <div class="student-content-show-section">

                    <div class="student-content-show-section-title">

                        <i class="fa-solid fa-link"></i>

                        <span>
                            {{ __('education_admin.student_lesson_content_show.sections.original_content') }}
                        </span>

                    </div>


                    <div class="student-content-show-source">

                        <div class="student-content-show-source-label">
                            {{ __('education_admin.student_lesson_content_show.source.label') }}
                        </div>


                        <div class="student-content-show-source-title">

                            {{ $content->sourceContent->title ?: __('education_admin.student_lesson_content_show.source.untitled') }}

                        </div>


                        <div class="student-content-show-source-note">

                            {{ __('education_admin.student_lesson_content_show.source.note') }}

                        </div>

                    </div>

                </div>

            @endif


            {{-- ====================================================
                CONTENT INFORMATION
            ===================================================== --}}

            <div class="student-content-show-section">

                <div class="student-content-show-section-title">

                    <i class="fa-solid fa-circle-info"></i>

                    <span>
                        {{ __('education_admin.student_lesson_content_show.sections.content_information') }}
                    </span>

                </div>


                <div class="student-content-show-meta-grid">


                    {{-- TYPE --}}

                    <div class="student-content-show-meta-item">

                        <div class="student-content-show-meta-label">
                            {{ __('education_admin.student_lesson_content_show.meta.type') }}
                        </div>

                        <div class="student-content-show-meta-value">
                            {{ $typeLabel }}
                        </div>

                    </div>


                    {{-- SORT ORDER --}}

                    <div class="student-content-show-meta-item">

                        <div class="student-content-show-meta-label">
                            {{ __('education_admin.student_lesson_content_show.meta.sort_order') }}
                        </div>

                        <div class="student-content-show-meta-value">
                            {{ $content->sort_order ?? 0 }}
                        </div>

                    </div>


                    {{-- STATUS --}}

                    <div class="student-content-show-meta-item">

                        <div class="student-content-show-meta-label">
                            {{ __('education_admin.student_lesson_content_show.meta.status') }}
                        </div>

                        <div class="student-content-show-meta-value">

                            {{ $content->is_active
                                ? __('education_admin.student_lesson_content_show.status.active')
                                : __('education_admin.student_lesson_content_show.status.inactive')
                            }}

                        </div>

                    </div>


                    {{-- FILE NAME --}}

                    @if($content->file_name)

                        <div class="student-content-show-meta-item">

                            <div class="student-content-show-meta-label">
                                {{ __('education_admin.student_lesson_content_show.meta.file_name') }}
                            </div>

                            <div class="student-content-show-meta-value">
                                {{ $content->file_name }}
                            </div>

                        </div>

                    @endif


                    {{-- MIME TYPE --}}

                    @if($content->mime_type)

                        <div class="student-content-show-meta-item">

                            <div class="student-content-show-meta-label">
                                {{ __('education_admin.student_lesson_content_show.meta.mime_type') }}
                            </div>

                            <div class="student-content-show-meta-value">
                                {{ $content->mime_type }}
                            </div>

                        </div>

                    @endif


                    {{-- FILE SIZE --}}

                    @if($formattedFileSize)

                        <div class="student-content-show-meta-item">

                            <div class="student-content-show-meta-label">
                                {{ __('education_admin.student_lesson_content_show.meta.file_size') }}
                            </div>

                            <div class="student-content-show-meta-value">
                                {{ $formattedFileSize }}
                            </div>

                        </div>

                    @endif

                </div>

            </div>

        </div>


        {{-- ========================================================
            FOOTER ACTIONS
        ========================================================= --}}

        <div class="student-content-show-footer">

            <div class="student-content-show-footer-left">

                <a
                    href="{{ route(
                        'education.admin.student-lessons.content.index',
                        $studentLesson
                    ) }}"
                    class="student-content-show-btn student-content-show-btn-secondary"
                >

                    <i class="fa-solid fa-arrow-right"></i>

                    {{ __('education_admin.student_lesson_content_show.actions.back_to_content') }}

                </a>

            </div>


            <div class="student-content-show-footer-right">

                <a
                    href="{{ route(
                        'education.admin.student-lessons.content.edit',
                        [$studentLesson, $content]
                    ) }}"
                    class="student-content-show-btn student-content-show-btn-primary"
                >

                    <i class="fa-solid fa-pen"></i>

                    {{ __('education_admin.student_lesson_content_show.actions.edit') }}

                </a>


                <form
                    method="POST"
                    action="{{ route(
                        'education.admin.student-lessons.content.destroy',
                        [$studentLesson, $content]
                    ) }}"
                    onsubmit="return confirm(@json(__('education_admin.student_lesson_content_show.delete.confirm')));"
                    style="margin:0;"
                >

                    @csrf

                    @method('DELETE')


                    <button
                        type="submit"
                        class="student-content-show-btn student-content-show-btn-danger"
                    >

                        <i class="fa-solid fa-trash"></i>

                        {{ __('education_admin.student_lesson_content_show.actions.delete') }}

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection
