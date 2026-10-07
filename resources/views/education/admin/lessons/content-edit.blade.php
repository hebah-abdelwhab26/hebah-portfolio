@extends('education.admin.layouts.app')

@section('title', __('education_admin.lessons.content.edit.page_title'))

@section('content')

<div class="education-admin-content-create-page">

    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}

    <div class="education-admin-content-create-header">

        <div class="education-admin-content-create-heading">

            <span class="education-admin-page-header-label">

                <i class="fa-solid fa-pen-to-square"></i>

                {{ __('education_admin.lessons.content.edit.header_label') }}

            </span>


            <div class="education-admin-content-title-row">

                <div class="education-admin-content-title-icon">

                    @switch($content->type)

                        @case('text')
                            <i class="fa-solid fa-align-right"></i>
                            @break

                        @case('image')
                            <i class="fa-solid fa-image"></i>
                            @break

                        @case('link')
                            <i class="fa-solid fa-link"></i>
                            @break

                        @case('file')
                            <i class="fa-solid fa-file"></i>
                            @break

                        @case('video')
                            <i class="fa-solid fa-video"></i>
                            @break

                        @default
                            <i class="fa-solid fa-layer-group"></i>

                    @endswitch

                </div>


                <div>

                    <h2>
                        {{ __('education_admin.lessons.content.edit.title') }}
                    </h2>


                    <span class="education-admin-content-lesson-name">

                        <i class="fa-solid fa-book-open"></i>

                        {{ $lesson->title }}

                    </span>

                </div>

            </div>


            <p>
                {{ __('education_admin.lessons.content.edit.description') }}
            </p>

        </div>


        {{-- HEADER ACTIONS --}}

        <div class="education-admin-content-header-actions">

            <a
                href="{{ route(
                    'education.admin.lessons.content.index',
                    $lesson
                ) }}"
                class="education-admin-content-back-button"
            >

                <i class="fa-solid fa-arrow-right"></i>

                {{ __('education_admin.lessons.content.edit.actions.back') }}

            </a>

        </div>

    </div>


    {{-- =========================================================
        FLASH MESSAGE
    ========================================================== --}}

    @if(session('success'))

        <div class="education-admin-content-alert success">

            <div class="education-admin-content-alert-icon">

                <i class="fa-solid fa-circle-check"></i>

            </div>

            <div>

                <strong>
                    {{ __('education_admin.lessons.content.edit.alerts.success_title') }}
                </strong>

                <span>
                    {{ session('success') }}
                </span>

            </div>

        </div>

    @endif


    {{-- =========================================================
        VALIDATION ERRORS
    ========================================================== --}}

    @if($errors->any())

        <div class="education-admin-content-alert error">

            <div class="education-admin-content-alert-icon">

                <i class="fa-solid fa-circle-exclamation"></i>

            </div>

            <div>

                <strong>
                    {{ __('education_admin.lessons.content.edit.alerts.validation_title') }}
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


    {{-- =========================================================
        FORM GRID
    ========================================================== --}}

    <div class="education-admin-content-form-grid">


        {{-- =====================================================
            MAIN COLUMN
        ====================================================== --}}

        <div class="education-admin-content-form-main">


            {{-- =================================================
                EDIT FORM
            ================================================== --}}

            <form
                id="edit-content-form"
                action="{{ route(
                    'education.admin.lessons.content.update',
                    [$lesson, $content]
                ) }}"
                method="POST"
                enctype="multipart/form-data"
                class="education-admin-content-form"
            >

                @csrf

                @method('PUT')


                {{-- =================================================
                    BASIC INFORMATION
                ================================================== --}}

                <div class="education-admin-content-form-card">

                    <div class="education-admin-content-form-card-header">

                        <div class="education-admin-content-form-card-icon">

                            <i class="fa-solid fa-circle-info"></i>

                        </div>

                        <div>

                            <span>
                                {{ __('education_admin.lessons.content.edit.basic_information.label') }}
                            </span>

                            <h3>
                                {{ __('education_admin.lessons.content.edit.basic_information.title') }}
                            </h3>

                        </div>

                    </div>


                    <div class="education-admin-content-form-body">


                        {{-- =================================================
                            TYPE
                        ================================================== --}}

                        <div class="education-admin-content-field">

                            <label for="type">

                                {{ __('education_admin.lessons.content.edit.basic_information.type') }}

                                <span class="required">
                                    {{ __('education_admin.lessons.content.edit.common.required') }}
                                </span>

                            </label>


                            <div class="education-admin-content-type-select-wrapper">

                                <select
                                    id="type"
                                    name="type"
                                    class="education-admin-content-input education-admin-content-type-select"
                                    required
                                >

                                    <option
                                        value="text"
                                        {{ old('type', $content->type) === 'text' ? 'selected' : '' }}
                                    >
                                        {{ __('education_admin.lessons.content.edit.types.text') }}
                                    </option>

                                    <option
                                        value="image"
                                        {{ old('type', $content->type) === 'image' ? 'selected' : '' }}
                                    >
                                        {{ __('education_admin.lessons.content.edit.types.image') }}
                                    </option>

                                    <option
                                        value="link"
                                        {{ old('type', $content->type) === 'link' ? 'selected' : '' }}
                                    >
                                        {{ __('education_admin.lessons.content.edit.types.link') }}
                                    </option>

                                    <option
                                        value="file"
                                        {{ old('type', $content->type) === 'file' ? 'selected' : '' }}
                                    >
                                        {{ __('education_admin.lessons.content.edit.types.file') }}
                                    </option>

                                    <option
                                        value="video"
                                        {{ old('type', $content->type) === 'video' ? 'selected' : '' }}
                                    >
                                        {{ __('education_admin.lessons.content.edit.types.video') }}
                                    </option>

                                </select>

                            </div>


                            <small class="education-admin-content-help">

                                <i class="fa-solid fa-circle-info"></i>

                                {{ __('education_admin.lessons.content.edit.type_help') }}

                            </small>

                        </div>


                        {{-- =================================================
                            TYPE QUICK SUMMARY
                        ================================================== --}}

                        <div
                            id="content-type-change-warning"
                            class="education-admin-content-type-change-warning"
                            style="display: none;"
                        >

                            <div class="education-admin-content-type-change-warning-icon">

                                <i class="fa-solid fa-triangle-exclamation"></i>

                            </div>

                            <div>

                                <strong>
                                    {{ __('education_admin.lessons.content.edit.type_change_warning.title') }}
                                </strong>

                                <span>
                                    {{ __('education_admin.lessons.content.edit.type_change_warning.description') }}
                                </span>

                            </div>

                        </div>


                        {{-- =================================================
                            TITLE
                        ================================================== --}}

                        <div class="education-admin-content-field">

                            <label for="title">

                                {{ __('education_admin.lessons.content.edit.basic_information.content_title') }}

                                <span>
                                    {{ __('education_admin.lessons.content.edit.common.optional') }}
                                </span>

                            </label>

                            <input
                                type="text"
                                id="title"
                                name="title"
                                value="{{ old(
                                    'title',
                                    $content->title
                                ) }}"
                                placeholder="{{ __('education_admin.lessons.content.edit.placeholders.title') }}"
                                class="education-admin-content-input"
                            >

                        </div>


                        {{-- =================================================
                            DESCRIPTION
                        ================================================== --}}

                        <div class="education-admin-content-field">

                            <label for="description">

                                {{ __('education_admin.lessons.content.edit.basic_information.description') }}

                                <span>
                                    {{ __('education_admin.lessons.content.edit.common.optional') }}
                                </span>

                            </label>

                            <textarea
                                id="description"
                                name="description"
                                rows="4"
                                placeholder="{{ __('education_admin.lessons.content.edit.placeholders.description') }}"
                                class="education-admin-content-textarea"
                            >{{ old(
                                'description',
                                $content->description
                            ) }}</textarea>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                    TYPE SPECIFIC CONTENT
                ================================================== --}}

                <div class="education-admin-content-form-card">

                    <div class="education-admin-content-form-card-header">

                        <div
                            id="content-type-header-icon"
                            class="education-admin-content-form-card-icon gold"
                        >

                            <i class="fa-solid fa-layer-group"></i>

                        </div>

                        <div>

                            <span>
                                {{ __('education_admin.lessons.content.edit.content_section.label') }}
                            </span>

                            <h3 id="content-type-header-title">
                                {{ __('education_admin.lessons.content.edit.content_section.content') }}
                            </h3>

                        </div>

                    </div>


                    <div class="education-admin-content-form-body">


                        {{-- =================================================
                            TEXT
                        ================================================== --}}

                        <div
                            class="education-admin-content-type-section"
                            data-content-type="text"
                        >

                            <div class="education-admin-content-field">

                                <label for="content">

                                    {{ __('education_admin.lessons.content.edit.text.content') }}

                                    <span class="required">
                                        {{ __('education_admin.lessons.content.edit.common.required') }}
                                    </span>

                                </label>

                                <textarea
                                    id="content"
                                    name="content"
                                    rows="14"
                                    class="education-admin-content-textarea large"
                                    placeholder="{{ __('education_admin.lessons.content.edit.placeholders.text') }}"
                                >{{ old(
                                    'content',
                                    $content->content
                                ) }}</textarea>

                                <small class="education-admin-content-help">

                                    <i class="fa-solid fa-circle-info"></i>

                                    {{ __('education_admin.lessons.content.edit.text.help') }}

                                </small>

                            </div>

                        </div>


                        {{-- =================================================
                            LINK
                        ================================================== --}}

                        <div
                            class="education-admin-content-type-section"
                            data-content-type="link"
                        >

                            <div class="education-admin-content-field">

                                <label for="url">

                                    {{ __('education_admin.lessons.content.edit.link.label') }}

                                    <span class="required">
                                        {{ __('education_admin.lessons.content.edit.common.required') }}
                                    </span>

                                </label>

                                <div class="education-admin-content-url-wrapper">

                                    <i class="fa-solid fa-link"></i>

                                    <input
                                        type="url"
                                        id="url"
                                        name="url"
                                        value="{{ old(
                                            'url',
                                            $content->type === 'link'
                                                ? $content->url
                                                : ''
                                        ) }}"
                                        placeholder="https://example.com"
                                        class="education-admin-content-input ltr"
                                    >

                                </div>

                                <small class="education-admin-content-help">

                                    <i class="fa-solid fa-circle-info"></i>

                                    {{ __('education_admin.lessons.content.edit.link.help') }}

                                </small>

                            </div>

                        </div>


                        {{-- =================================================
                            IMAGE
                        ================================================== --}}

                        <div
                            class="education-admin-content-type-section"
                            data-content-type="image"
                        >

                            {{-- CURRENT IMAGE --}}

                            @if(
                                $content->type === 'image' &&
                                $content->file_path
                            )

                                <div class="education-admin-content-current-file">

                                    <div class="education-admin-content-current-file-header">

                                        <span>

                                            <i class="fa-solid fa-image"></i>

                                            {{ __('education_admin.lessons.content.edit.image.current') }}

                                        </span>

                                    </div>


                                    <div class="education-admin-content-current-image">

                                        <img
                                            src="{{ asset(
                                                $content->file_path
                                            ) }}"
                                            alt="{{ $content->title ?: __('education_admin.lessons.content.edit.image.content_image') }}"
                                        >

                                    </div>


                                    <div class="education-admin-content-current-file-info">

                                        <strong>

                                            {{ $content->file_name ?: __('education_admin.lessons.content.edit.image.current') }}

                                        </strong>

                                        @if($content->file_size)

                                            <span>

                                                {{ number_format(
                                                    $content->file_size / 1024,
                                                    1
                                                ) }}

                                                KB

                                            </span>

                                        @endif

                                    </div>

                                </div>

                            @endif


                            {{-- NEW IMAGE --}}

                            <div class="education-admin-content-field">

                                <label for="upload-image">

                                    {{ __('education_admin.lessons.content.edit.image.replace') }}

                                    <span>
                                        {{ __('education_admin.lessons.content.edit.common.optional') }}
                                    </span>

                                </label>


                                <div class="education-admin-content-upload-box">

                                    <input
                                        type="file"
                                        id="upload-image"
                                        name="upload"
                                        accept=".jpg,.jpeg,.png,.webp,.gif"
                                    >


                                    <div class="education-admin-content-upload-placeholder">

                                        <div class="education-admin-content-upload-icon">

                                            <i class="fa-solid fa-cloud-arrow-up"></i>

                                        </div>

                                        <strong>
                                            {{ __('education_admin.lessons.content.edit.image.choose_new') }}
                                        </strong>

                                        <span>
                                            JPG, JPEG, PNG, WEBP {{ __('education_admin.lessons.content.edit.common.or') }} GIF
                                        </span>

                                        <small>
                                            {{ __('education_admin.lessons.content.edit.upload.max_10mb') }}
                                        </small>

                                    </div>

                                </div>


                                <small class="education-admin-content-help">

                                    <i class="fa-solid fa-circle-info"></i>

                                    {{ __('education_admin.lessons.content.edit.image.help') }}

                                </small>

                            </div>

                        </div>


                        {{-- =================================================
                            FILE
                        ================================================== --}}

                        <div
                            class="education-admin-content-type-section"
                            data-content-type="file"
                        >

                            {{-- CURRENT FILE --}}

                            @if(
                                $content->type === 'file' &&
                                $content->file_path
                            )

                                <div class="education-admin-content-current-file">

                                    <div class="education-admin-content-current-file-header">

                                        <span>

                                            <i class="fa-solid fa-file"></i>

                                            {{ __('education_admin.lessons.content.edit.file.current') }}

                                        </span>

                                    </div>


                                    <div class="education-admin-content-current-file-row">

                                        <div class="education-admin-content-current-file-icon">

                                            <i class="fa-solid fa-file-lines"></i>

                                        </div>


                                        <div>

                                            <strong>

                                                {{ $content->file_name ?: __('education_admin.lessons.content.edit.file.current') }}

                                            </strong>

                                            <span>

                                                {{ $content->mime_type ?: __('education_admin.lessons.content.edit.file.type') }}

                                                @if($content->file_size)

                                                    ·

                                                    {{ number_format(
                                                        $content->file_size / 1024,
                                                        1
                                                    ) }}

                                                    KB

                                                @endif

                                            </span>

                                        </div>


                                        <a
                                            href="{{ asset(
                                                $content->file_path
                                            ) }}"
                                            target="_blank"
                                            rel="noopener"
                                            class="education-admin-content-current-file-view"
                                        >

                                            <i class="fa-solid fa-eye"></i>

                                            {{ __('education_admin.lessons.content.edit.file.view') }}

                                        </a>

                                    </div>

                                </div>

                            @endif


                            {{-- NEW FILE --}}

                            <div class="education-admin-content-field">

                                <label for="upload-file">

                                    {{ __('education_admin.lessons.content.edit.file.replace') }}

                                    <span>
                                        {{ __('education_admin.lessons.content.edit.common.optional') }}
                                    </span>

                                </label>


                                <div class="education-admin-content-upload-box">

                                    <input
                                        type="file"
                                        id="upload-file"
                                        name="upload"
                                        accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.zip"
                                    >


                                    <div class="education-admin-content-upload-placeholder">

                                        <div class="education-admin-content-upload-icon gold">

                                            <i class="fa-solid fa-cloud-arrow-up"></i>

                                        </div>

                                        <strong>
                                            {{ __('education_admin.lessons.content.edit.file.choose_new') }}
                                        </strong>

                                        <span>
                                            PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX {{ __('education_admin.lessons.content.edit.common.or') }} ZIP
                                        </span>

                                        <small>
                                            {{ __('education_admin.lessons.content.edit.upload.max_50mb') }}
                                        </small>

                                    </div>

                                </div>


                                <small class="education-admin-content-help">

                                    <i class="fa-solid fa-circle-info"></i>

                                    {{ __('education_admin.lessons.content.edit.file.help') }}

                                </small>

                            </div>

                        </div>


                        {{-- =================================================
                            VIDEO
                        ================================================== --}}

                        <div
                            class="education-admin-content-type-section"
                            data-content-type="video"
                        >

                            {{-- CURRENT VIDEO --}}

                            @if(
                                $content->type === 'video' &&
                                $content->url
                            )

                                <div class="education-admin-content-current-file">

                                    <div class="education-admin-content-current-file-header">

                                        <span>

                                            <i class="fa-solid fa-video"></i>

                                            {{ __('education_admin.lessons.content.edit.video.current') }}

                                        </span>

                                    </div>


                                    @php

                                        $currentVideoUrl =
                                            trim($content->url);

                                        $currentVideoEmbedUrl = null;

                                        /*
                                        |--------------------------------------------------------------------------
                                        | YOUTUBE
                                        |--------------------------------------------------------------------------
                                        */

                                        if (
                                            preg_match(
                                                '/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/shorts\/|youtube\.com\/live\/)([^&?\/]+)/',
                                                $currentVideoUrl,
                                                $matches
                                            )
                                        ) {

                                            $currentVideoEmbedUrl =
                                                'https://www.youtube.com/embed/' .
                                                $matches[1];

                                        }


                                        /*
                                        |--------------------------------------------------------------------------
                                        | GOOGLE DRIVE
                                        |--------------------------------------------------------------------------
                                        */

                                        elseif (
                                            preg_match(
                                                '/drive\.google\.com\/file\/d\/([^\/]+)/',
                                                $currentVideoUrl,
                                                $matches
                                            )
                                        ) {

                                            $currentVideoEmbedUrl =
                                                'https://drive.google.com/file/d/' .
                                                $matches[1] .
                                                '/preview';

                                        }


                                        /*
                                        |--------------------------------------------------------------------------
                                        | VIMEO
                                        |--------------------------------------------------------------------------
                                        */

                                        elseif (
                                            preg_match(
                                                '/vimeo\.com\/(\d+)/',
                                                $currentVideoUrl,
                                                $matches
                                            )
                                        ) {

                                            $currentVideoEmbedUrl =
                                                'https://player.vimeo.com/video/' .
                                                $matches[1];

                                        }

                                    @endphp


                                    <div class="education-admin-content-current-video">

                                        @if($currentVideoEmbedUrl)

                                            <div
                                                style="
                                                    position:relative;
                                                    width:100%;
                                                    padding-bottom:56.25%;
                                                    height:0;
                                                    overflow:hidden;
                                                    border-radius:16px;
                                                    background:#000;
                                                "
                                            >

                                                <iframe
                                                    src="{{ $currentVideoEmbedUrl }}"
                                                    title="{{ $content->title ?: __('education_admin.lessons.content.edit.video.current') }}"
                                                    frameborder="0"
                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                    allowfullscreen
                                                    style="
                                                        position:absolute;
                                                        top:0;
                                                        left:0;
                                                        width:100%;
                                                        height:100%;
                                                        border:0;
                                                    "
                                                ></iframe>

                                            </div>

                                        @else

                                            <video
                                                controls
                                                preload="metadata"
                                                playsinline
                                                style="
                                                    width:100%;
                                                    max-height:500px;
                                                    border-radius:16px;
                                                    background:#000;
                                                "
                                            >

                                                <source
                                                    src="{{ $currentVideoUrl }}"
                                                >

                                                {{ __('education_admin.lessons.content.edit.video.not_supported') }}

                                            </video>

                                        @endif

                                    </div>


                                    <div class="education-admin-content-current-file-info">

                                        <strong>
                                            {{ __('education_admin.lessons.content.edit.video.current_link') }}
                                        </strong>

                                        <span
                                            style="
                                                direction:ltr;
                                                text-align:left;
                                                word-break:break-all;
                                            "
                                        >
                                            {{ $content->url }}
                                        </span>

                                    </div>


                                    <div
                                        style="
                                            margin-top:12px;
                                            display:flex;
                                            gap:10px;
                                            flex-wrap:wrap;
                                        "
                                    >

                                        <a
                                            href="{{ $content->url }}"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="education-admin-content-current-file-view"
                                        >

                                            <i class="fa-solid fa-arrow-up-right-from-square"></i>

                                            {{ __('education_admin.lessons.content.edit.video.open') }}

                                        </a>

                                    </div>

                                </div>

                            @endif


                            {{-- VIDEO URL --}}

                            <div class="education-admin-content-field">

                                <label for="video-url">

                                    {{ __('education_admin.lessons.content.edit.video.url') }}

                                    <span class="required">
                                        {{ __('education_admin.lessons.content.edit.common.required') }}
                                    </span>

                                </label>


                                <div class="education-admin-content-url-wrapper">

                                    <i class="fa-solid fa-video"></i>

                                    <input
                                        type="url"
                                        id="video-url"
                                        name="url"
                                        value="{{ old(
                                            'url',
                                            $content->type === 'video'
                                                ? $content->url
                                                : ''
                                        ) }}"
                                        placeholder="https://www.youtube.com/watch?v=..."
                                        class="education-admin-content-input ltr"
                                    >

                                </div>


                                <small class="education-admin-content-help">

                                    <i class="fa-solid fa-circle-info"></i>

                                    {{ __('education_admin.lessons.content.edit.video.help') }}

                                </small>

                            </div>


                            {{-- VIDEO PREVIEW --}}

                            <div
                                id="edit-video-preview"
                                style="
                                    display:none;
                                    margin-top:20px;
                                "
                            >

                                <div
                                    style="
                                        margin-bottom:10px;
                                        font-weight:700;
                                        color:#59604e;
                                    "
                                >

                                    <i class="fa-solid fa-eye"></i>

                                    {{ __('education_admin.lessons.content.edit.video.preview') }}

                                </div>


                                <div
                                    id="edit-video-preview-container"
                                    style="
                                        position:relative;
                                        width:100%;
                                        padding-bottom:56.25%;
                                        height:0;
                                        overflow:hidden;
                                        border-radius:16px;
                                        background:#000;
                                    "
                                ></div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                    DISPLAY SETTINGS
                ================================================== --}}

                <div class="education-admin-content-form-card">

                    <div class="education-admin-content-form-card-header">

                        <div class="education-admin-content-form-card-icon green">

                            <i class="fa-solid fa-sliders"></i>

                        </div>

                        <div>

                            <span>
                                {{ __('education_admin.lessons.content.edit.settings.label') }}
                            </span>

                            <h3>
                                {{ __('education_admin.lessons.content.edit.settings.title') }}
                            </h3>

                        </div>

                    </div>


                    <div class="education-admin-content-form-body">

                        <div class="education-admin-content-settings-grid">


                            {{-- SORT ORDER --}}

                            <div class="education-admin-content-field">

                                <label for="sort_order">
                                    {{ __('education_admin.lessons.content.edit.settings.sort_order') }}
                                </label>

                                <input
                                    type="number"
                                    id="sort_order"
                                    name="sort_order"
                                    min="0"
                                    value="{{ old(
                                        'sort_order',
                                        $content->sort_order
                                    ) }}"
                                    class="education-admin-content-input"
                                >

                            </div>


                            {{-- STATUS --}}

                            <div class="education-admin-content-status-box">

                                <label>
                                    {{ __('education_admin.lessons.content.edit.settings.status') }}
                                </label>

                                <label class="education-admin-content-switch">

                                    <input
                                        type="checkbox"
                                        name="is_active"
                                        value="1"
                                        {{ old(
                                            'is_active',
                                            $content->is_active
                                        ) ? 'checked' : '' }}
                                    >

                                    <span class="education-admin-content-switch-slider"></span>

                                    <span class="education-admin-content-switch-label">

                                        <strong>
                                            {{ __('education_admin.lessons.content.edit.settings.active') }}
                                        </strong>

                                        <small>
                                            {{ __('education_admin.lessons.content.edit.settings.active_help') }}
                                        </small>

                                    </span>

                                </label>

                            </div>

                        </div>

                    </div>

                </div>


            </form>

        </div>


        {{-- =====================================================
            SIDEBAR
        ====================================================== --}}

        <aside class="education-admin-content-form-sidebar">


            {{-- =================================================
                CONTENT TYPE SUMMARY
            ================================================== --}}

            <div class="education-admin-content-form-card">

                <div class="education-admin-content-form-card-header">

                    <div class="education-admin-content-form-card-icon gold">

                        <i class="fa-solid fa-layer-group"></i>

                    </div>

                    <div>

                        <span>
                            {{ __('education_admin.lessons.content.edit.type_summary.label') }}
                        </span>

                        <h3>
                            {{ __('education_admin.lessons.content.edit.type_summary.title') }}
                        </h3>

                    </div>

                </div>


                <div
                    id="content-type-summary"
                    class="education-admin-content-type-summary"
                >

                    <div
                        id="content-type-summary-icon"
                        class="education-admin-content-type-summary-icon"
                    >

                        <i class="fa-solid fa-layer-group"></i>

                    </div>


                    <strong id="content-type-summary-text">
                        {{ __('education_admin.lessons.content.edit.types.content') }}
                    </strong>

                </div>


                <div class="education-admin-content-type-note">

                    <i class="fa-solid fa-circle-info"></i>

                    <span>
                        {{ __('education_admin.lessons.content.edit.type_summary.help') }}
                    </span>

                </div>

            </div>


            {{-- =================================================
                SAVE ACTIONS
            ================================================== --}}

            <div class="education-admin-content-form-card">

                <div class="education-admin-content-form-card-header">

                    <div class="education-admin-content-form-card-icon green">

                        <i class="fa-solid fa-floppy-disk"></i>

                    </div>

                    <div>

                        <span>
                            {{ __('education_admin.lessons.content.edit.actions.save_section') }}
                        </span>

                        <h3>
                            {{ __('education_admin.lessons.content.edit.actions.title') }}
                        </h3>

                    </div>

                </div>


                <div class="education-admin-content-form-actions">

                    <button
                        type="submit"
                        form="edit-content-form"
                        class="education-admin-content-submit-button"
                    >

                        <i class="fa-solid fa-check"></i>

                        {{ __('education_admin.lessons.content.edit.actions.save') }}

                    </button>


                    <a
                        href="{{ route(
                            'education.admin.lessons.content.index',
                            $lesson
                        ) }}"
                        class="education-admin-content-cancel-button"
                    >

                        <i class="fa-solid fa-xmark"></i>

                        {{ __('education_admin.lessons.content.edit.actions.cancel') }}

                    </a>

                </div>

            </div>


            {{-- =================================================
                DELETE
            ================================================== --}}

            <div class="education-admin-content-delete-card">

                <div class="education-admin-content-delete-icon">

                    <i class="fa-solid fa-trash"></i>

                </div>


                <div>

                    <strong>
                        {{ __('education_admin.lessons.content.edit.delete.title') }}
                    </strong>

                    <p>
                        {{ __('education_admin.lessons.content.edit.delete.description') }}
                    </p>

                </div>


                <button
                    type="button"
                    id="delete-content-button"
                    class="education-admin-content-delete-button"
                    data-url="{{ route(
                        'education.admin.lessons.content.destroy',
                        [$lesson, $content]
                    ) }}"
                >

                    <i class="fa-solid fa-trash"></i>

                    {{ __('education_admin.lessons.content.edit.delete.button') }}

                </button>

            </div>


            {{-- =================================================
                NOTE
            ================================================== --}}

            <div class="education-admin-content-note">

                <div class="education-admin-content-note-icon">

                    <i class="fa-solid fa-lightbulb"></i>

                </div>

                <div>

                    <strong>
                        {{ __('education_admin.lessons.content.edit.note.title') }}
                    </strong>

                    <p>

                        {{ __('education_admin.lessons.content.edit.note.description') }}

                    </p>

                </div>

            </div>

        </aside>

    </div>

</div>

@endsection


{{-- =========================================================
    CONTENT TYPE SWITCHING + VIDEO PREVIEW + DELETE JAVASCRIPT
========================================================= --}}

@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | CONTENT TYPE
    |--------------------------------------------------------------------------
    */

    const typeSelect =
        document.getElementById('type');


    const typeSections =
        document.querySelectorAll(
            '.education-admin-content-type-section'
        );


    const typeHeaderIcon =
        document.getElementById(
            'content-type-header-icon'
        );


    const typeHeaderTitle =
        document.getElementById(
            'content-type-header-title'
        );


    const typeSummaryIcon =
        document.getElementById(
            'content-type-summary-icon'
        );


    const typeSummaryText =
        document.getElementById(
            'content-type-summary-text'
        );


    const typeWarning =
        document.getElementById(
            'content-type-change-warning'
        );


    const originalType =
        @json($content->type);


    /*
    |--------------------------------------------------------------------------
    | TYPE DATA
    |--------------------------------------------------------------------------
    */

    const typeData = {

        text: {

            title: @json(__('education_admin.lessons.content.edit.types.text')),

            summary: @json(__('education_admin.lessons.content.edit.types.text_summary')),

            icon: 'fa-align-right',

        },

        image: {

            title: @json(__('education_admin.lessons.content.edit.types.image')),

            summary: @json(__('education_admin.lessons.content.edit.types.image_summary')),

            icon: 'fa-image',

        },

        link: {

            title: @json(__('education_admin.lessons.content.edit.types.link')),

            summary: @json(__('education_admin.lessons.content.edit.types.link_summary')),

            icon: 'fa-link',

        },

        file: {

            title: @json(__('education_admin.lessons.content.edit.types.file')),

            summary: @json(__('education_admin.lessons.content.edit.types.file_summary')),

            icon: 'fa-file',

        },

        video: {

            title: @json(__('education_admin.lessons.content.edit.types.video')),

            summary: @json(__('education_admin.lessons.content.edit.types.video_summary')),

            icon: 'fa-video',

        },

    };


    /*
    |--------------------------------------------------------------------------
    | UPDATE TYPE UI
    |--------------------------------------------------------------------------
    */

    function updateContentTypeUI() {

        if (!typeSelect) {
            return;
        }


        const selectedType =
            typeSelect.value;


        /*
        |--------------------------------------------------------------------------
        | SHOW / HIDE SECTIONS
        |--------------------------------------------------------------------------
        */

        typeSections.forEach(function (section) {

            const sectionType =
                section.dataset.contentType;


            if (
                sectionType === selectedType
            ) {

                section.style.display =
                    'block';

            } else {

                section.style.display =
                    'none';

            }

        });


        /*
        |--------------------------------------------------------------------------
        | TYPE DATA
        |--------------------------------------------------------------------------
        */

        const data =
            typeData[selectedType]
            || typeData.text;


        /*
        |--------------------------------------------------------------------------
        | HEADER ICON
        |--------------------------------------------------------------------------
        */

        if (typeHeaderIcon) {

            typeHeaderIcon.innerHTML = `
                <i class="fa-solid ${data.icon}"></i>
            `;

        }


        /*
        |--------------------------------------------------------------------------
        | HEADER TITLE
        |--------------------------------------------------------------------------
        */

        if (typeHeaderTitle) {

            typeHeaderTitle.textContent =
                data.title;

        }


        /*
        |--------------------------------------------------------------------------
        | SUMMARY ICON
        |--------------------------------------------------------------------------
        */

        if (typeSummaryIcon) {

            typeSummaryIcon.innerHTML = `
                <i class="fa-solid ${data.icon}"></i>
            `;

        }


        /*
        |--------------------------------------------------------------------------
        | SUMMARY TEXT
        |--------------------------------------------------------------------------
        */

        if (typeSummaryText) {

            typeSummaryText.textContent =
                data.summary;

        }


        /*
        |--------------------------------------------------------------------------
        | TYPE CHANGE WARNING
        |--------------------------------------------------------------------------
        */

        if (
            typeWarning &&
            selectedType !== originalType
        ) {

            typeWarning.style.display =
                'flex';

        } else if (typeWarning) {

            typeWarning.style.display =
                'none';

        }

    }


    /*
    |--------------------------------------------------------------------------
    | INITIALIZE
    |--------------------------------------------------------------------------
    */

    updateContentTypeUI();


    /*
    |--------------------------------------------------------------------------
    | TYPE CHANGE
    |--------------------------------------------------------------------------
    */

    if (typeSelect) {

        typeSelect.addEventListener(
            'change',
            updateContentTypeUI
        );

    }


    /*
    |--------------------------------------------------------------------------
    | VIDEO URL
    |--------------------------------------------------------------------------
    */

    const videoUrlInput =
        document.getElementById(
            'video-url'
        );


    const videoPreview =
        document.getElementById(
            'edit-video-preview'
        );


    const videoPreviewContainer =
        document.getElementById(
            'edit-video-preview-container'
        );


    /*
    |--------------------------------------------------------------------------
    | GET VIDEO EMBED URL
    |--------------------------------------------------------------------------
    */

    function getVideoEmbedUrl(url) {

        if (!url) {
            return null;
        }


        /*
        |--------------------------------------------------------------------------
        | YOUTUBE
        |--------------------------------------------------------------------------
        */

        const youtubeMatch =
            url.match(
                /(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/shorts\/|youtube\.com\/live\/)([^&?\/]+)/
            );


        if (youtubeMatch) {

            return (
                'https://www.youtube.com/embed/' +
                youtubeMatch[1]
            );

        }


        /*
        |--------------------------------------------------------------------------
        | GOOGLE DRIVE
        |--------------------------------------------------------------------------
        */

        const driveMatch =
            url.match(
                /drive\.google\.com\/file\/d\/([^\/]+)/
            );


        if (driveMatch) {

            return (
                'https://drive.google.com/file/d/' +
                driveMatch[1] +
                '/preview'
            );

        }


        /*
        |--------------------------------------------------------------------------
        | VIMEO
        |--------------------------------------------------------------------------
        */

        const vimeoMatch =
            url.match(
                /vimeo\.com\/(\d+)/
            );


        if (vimeoMatch) {

            return (
                'https://player.vimeo.com/video/' +
                vimeoMatch[1]
            );

        }


        return null;

    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE VIDEO PREVIEW
    |--------------------------------------------------------------------------
    */

    function updateVideoPreview() {

        if (
            !videoUrlInput ||
            !videoPreview ||
            !videoPreviewContainer
        ) {
            return;
        }


        const url =
            videoUrlInput.value.trim();


        if (!url) {

            videoPreview.style.display =
                'none';

            videoPreviewContainer.innerHTML =
                '';

            return;

        }


        const embedUrl =
            getVideoEmbedUrl(url);


        /*
        |--------------------------------------------------------------------------
        | EMBED VIDEO
        |--------------------------------------------------------------------------
        */

        if (embedUrl) {

            videoPreview.style.display =
                'block';


            videoPreviewContainer.innerHTML = `

                <iframe
                    src="${embedUrl}"
                    title="${@json(__('education_admin.lessons.content.edit.video.preview'))}"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen
                    style="
                        position:absolute;
                        top:0;
                        left:0;
                        width:100%;
                        height:100%;
                        border:0;
                    "
                ></iframe>

            `;

            return;

        }


        /*
        |--------------------------------------------------------------------------
        | DIRECT VIDEO URL
        |--------------------------------------------------------------------------
        */

        if (
            /\.(mp4|webm|ogg|mov)(\?.*)?$/i.test(url)
        ) {

            videoPreview.style.display =
                'block';


            videoPreviewContainer.innerHTML = `

                <video
                    controls
                    playsinline
                    preload="metadata"
                    style="
                        position:absolute;
                        top:0;
                        left:0;
                        width:100%;
                        height:100%;
                        background:#000;
                    "
                >

                    <source src="${url}">

                    ${@json(__('education_admin.lessons.content.edit.video.not_supported'))}

                </video>

            `;

            return;

        }


        /*
        |--------------------------------------------------------------------------
        | UNKNOWN VIDEO URL
        |--------------------------------------------------------------------------
        */

        videoPreview.style.display =
            'none';

        videoPreviewContainer.innerHTML =
            '';

    }


    /*
    |--------------------------------------------------------------------------
    | VIDEO URL INPUT
    |--------------------------------------------------------------------------
    */

    if (videoUrlInput) {

        videoUrlInput.addEventListener(
            'input',
            updateVideoPreview
        );

    }


    /*
    |--------------------------------------------------------------------------
    | INITIAL VIDEO PREVIEW
    |--------------------------------------------------------------------------
    */

    if (
        typeSelect &&
        typeSelect.value === 'video' &&
        videoUrlInput &&
        videoUrlInput.value
    ) {

        updateVideoPreview();

    }


    /*
    |--------------------------------------------------------------------------
    | DELETE CONTENT
    |--------------------------------------------------------------------------
    */

    const deleteButton =
        document.getElementById(
            'delete-content-button'
        );


    if (!deleteButton) {
        return;
    }


    deleteButton.addEventListener(
        'click',
        async function () {

            const confirmed =
                confirm(
                    @json(__('education_admin.lessons.content.edit.delete.confirm'))
                );


            if (!confirmed) {
                return;
            }


            const url =
                deleteButton.dataset.url;


            const csrfToken =
                document
                    .querySelector(
                        'meta[name="csrf-token"]'
                    )
                    ?.getAttribute(
                        'content'
                    );


            if (!csrfToken) {

                alert(
                    @json(__('education_admin.lessons.content.edit.errors.csrf'))
                );

                return;
            }


            /*
            |--------------------------------------------------------------------------
            | DISABLE BUTTON
            |--------------------------------------------------------------------------
            */

            deleteButton.disabled =
                true;


            deleteButton.classList.add(
                'is-loading'
            );


            /*
            |--------------------------------------------------------------------------
            | SAVE ORIGINAL HTML
            |--------------------------------------------------------------------------
            */

            const originalButtonHtml =
                deleteButton.innerHTML;


            /*
            |--------------------------------------------------------------------------
            | LOADING
            |--------------------------------------------------------------------------
            */

            deleteButton.innerHTML = `
                <i class="fa-solid fa-spinner fa-spin"></i>
                ${@json(__('education_admin.lessons.content.edit.delete.loading'))}
            `;


            try {

                const response =
                    await fetch(
                        url,
                        {
                            method: 'DELETE',

                            headers: {

                                'X-CSRF-TOKEN':
                                    csrfToken,

                                'Accept':
                                    'application/json',

                                'X-Requested-With':
                                    'XMLHttpRequest',

                            },

                        }
                    );


                /*
                |--------------------------------------------------------------------------
                | SUCCESS
                |--------------------------------------------------------------------------
                */

                if (response.ok) {

                    window.location.href =
                        "{{ route(
                            'education.admin.lessons.content.index',
                            $lesson
                        ) }}";

                    return;
                }


                /*
                |--------------------------------------------------------------------------
                | ERROR
                |--------------------------------------------------------------------------
                */

                let message =
                    @json(__('education_admin.lessons.content.edit.errors.delete'));


                try {

                    const data =
                        await response.json();


                    if (data.message) {

                        message =
                            data.message;

                    }

                } catch (error) {

                    /*
                    |--------------------------------------------------------------------------
                    | INVALID JSON
                    |--------------------------------------------------------------------------
                    */

                }


                alert(message);

            } catch (error) {

                console.error(
                    'Delete content error:',
                    error
                );


                alert(
                    @json(__('education_admin.lessons.content.edit.errors.connection'))
                );

            } finally {

                deleteButton.disabled =
                    false;


                deleteButton.classList.remove(
                    'is-loading'
                );


                deleteButton.innerHTML =
                    originalButtonHtml;

            }

        }
    );

});

</script>

@endpush
