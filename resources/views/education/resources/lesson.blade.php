@extends('education.layouts.app')

@section('title', $lesson->title ?? __('education.resources_page.page_title'))

@section('content')

<section class="education-lesson-page">

<div class="education-lesson-container">

{{-- ==================================================
    BREADCRUMB
================================================== --}}

<div class="education-lesson-breadcrumb">

    <a href="{{ route('education.index') }}">
        <i class="fa-solid fa-house"></i>
        {{ __('education.resources_page.breadcrumb.home') }}
    </a>

    <i class="fa-solid fa-chevron-left"></i>

    <a href="{{ route('education.resources.index') }}">
        {{ __('education.resources_page.breadcrumb.resources') }}
    </a>

    <i class="fa-solid fa-chevron-left"></i>

    <span>
        {{ $lesson->category }}
    </span>

    <i class="fa-solid fa-chevron-left"></i>

    <span class="current">
        {{ $lesson->title }}
    </span>

</div>


{{-- ==================================================
    LESSON HERO
================================================== --}}

<header class="education-lesson-hero">

    <div class="education-lesson-hero-main">

        <div class="education-lesson-category">

            <i class="fa-solid fa-book-open"></i>

            <span>
                {{ $lesson->category }}
            </span>

        </div>


        <h1>
            {{ $lesson->title }}
        </h1>


        @if($lesson->description)

            <p>
                {{ $lesson->description }}
            </p>

        @else

            <p>
                {{ __('education.resources_page.lesson_page.hero.fallback_description') }}
            </p>

        @endif

    </div>


    <div class="education-lesson-hero-side">

        <div class="education-lesson-hero-icon">

            <i class="fa-solid fa-book-open-reader"></i>

        </div>


        <span class="education-lesson-active">

            <i class="fa-solid fa-circle"></i>

            {{ __('education.resources_page.lesson_page.hero.available') }}

        </span>

    </div>

</header>


{{-- ==================================================
    LESSON META
================================================== --}}

<div class="education-lesson-meta">

    @if($lesson->duration)

        <div class="education-lesson-meta-item">

            <span class="education-lesson-meta-icon">
                <i class="fa-regular fa-clock"></i>
            </span>

            <div>

                <small>
                    {{ __('education.resources_page.lesson_page.meta.duration') }}
                </small>

                <strong>

                    {{ $lesson->duration }}

                    {{ __('education.resources_page.lesson_page.meta.minute') }}

                </strong>

            </div>

        </div>

    @endif


    <div class="education-lesson-meta-item">

        <span class="education-lesson-meta-icon">
            <i class="fa-solid fa-layer-group"></i>
        </span>

        <div>

            <small>
                {{ __('education.resources_page.lesson_page.meta.content') }}
            </small>

            <strong>

                {{ $lesson->contents->count() }}

                {{ __('education.resources_page.lesson_page.meta.item') }}

            </strong>

        </div>

    </div>


    @if($lesson->price !== null)

        <div class="education-lesson-meta-item">

            <span class="education-lesson-meta-icon">
                <i class="fa-solid fa-tag"></i>
            </span>

            <div>

                <small>
                    {{ __('education.resources_page.lesson_page.meta.price') }}
                </small>

                <strong>

                    @if((float) $lesson->price > 0)

                        {{ number_format((float) $lesson->price, 2) }}

                        {{ $lesson->currency ?? 'SAR' }}

                    @else

                        {{ __('education.resources_page.lesson_page.meta.free') }}

                    @endif

                </strong>

            </div>

        </div>

    @endif


    <div class="education-lesson-meta-item">

        <span class="education-lesson-meta-icon">
            <i class="fa-solid fa-circle-check"></i>
        </span>

        <div>

            <small>
                {{ __('education.resources_page.lesson_page.meta.status') }}
            </small>

            <strong class="active">
                {{ __('education.resources_page.lesson_page.hero.available') }}
            </strong>

        </div>

    </div>

</div>


{{-- ==================================================
    LAYOUT
================================================== --}}

<div class="education-lesson-layout">


    {{-- ==================================================
        MAIN CONTENT
    ================================================== --}}

    <main class="education-lesson-main">

        <div class="education-lesson-section-heading">

            <div>

                <span class="education-section-badge">
                    {{ __('education.resources_page.lesson_page.content.badge') }}
                </span>

                <h2>
                    {{ __('education.resources_page.lesson_page.content.title') }}
                </h2>

            </div>


            <span class="education-lesson-content-count">

                {{ $lesson->contents->count() }}

                {{ __('education.resources_page.lesson_page.content.count') }}

            </span>

        </div>


        @if($lesson->contents->count())

            <div class="education-lesson-contents">

                @foreach($lesson->contents as $index => $content)

                    <article
                        class="education-lesson-content-card education-content-type-{{ $content->type }}">


                        {{-- ==========================================
                            CONTENT HEADER
                        =========================================== --}}

                        <div class="education-lesson-content-header">

                            <div class="education-lesson-content-number">

                                {{ str_pad(
                                    $index + 1,
                                    2,
                                    '0',
                                    STR_PAD_LEFT
                                ) }}

                            </div>


                            <div class="education-lesson-content-heading">

                                @php

                                    $contentType = match($content->type) {

                                        'text' => [
                                            'label' => __('education.resources_page.lesson_page.content.types.text'),
                                            'icon' => 'fa-solid fa-align-right',
                                        ],

                                        'image' => [
                                            'label' => __('education.resources_page.lesson_page.content.types.image'),
                                            'icon' => 'fa-solid fa-image',
                                        ],

                                        'video' => [
                                            'label' => __('education.resources_page.lesson_page.content.types.video'),
                                            'icon' => 'fa-solid fa-circle-play',
                                        ],

                                        'link' => [
                                            'label' => __('education.resources_page.lesson_page.content.types.link'),
                                            'icon' => 'fa-solid fa-link',
                                        ],

                                        'file' => [
                                            'label' => __('education.resources_page.lesson_page.content.types.file'),
                                            'icon' => 'fa-solid fa-file',
                                        ],

                                        default => [
                                            'label' => __('education.resources_page.lesson_page.content.types.other'),
                                            'icon' => 'fa-solid fa-layer-group',
                                        ],

                                    };

                                @endphp


                                <span>

                                    <i class="{{ $contentType['icon'] }}"></i>

                                    {{ $contentType['label'] }}

                                </span>


                                @if($content->title)

                                    <h3>
                                        {{ $content->title }}
                                    </h3>

                                @endif

                            </div>

                        </div>


                        {{-- ==========================================
                            DESCRIPTION
                        =========================================== --}}

                        @if($content->description)

                            <div class="education-lesson-content-description">

                                {{ $content->description }}

                            </div>

                        @endif


                        {{-- ==========================================
                            TEXT CONTENT
                        =========================================== --}}

                        @if($content->isText())

                            <div class="education-lesson-text">

                                @if($content->content)

                                    {!! nl2br(e($content->content)) !!}

                                @else

                                    <p class="education-lesson-empty-content">

                                        {{ __('education.resources_page.lesson_page.content.missing.text') }}

                                    </p>

                                @endif

                            </div>

                        @endif


                        {{-- ==========================================
                            IMAGE CONTENT
                        =========================================== --}}

                        @if($content->isImage())

                            @php

                                $imageUrl = null;

                                if ($content->file_path) {

                                    $imageUrl = $content->file_url;

                                } elseif ($content->url) {

                                    $imageUrl = $content->url;

                                } elseif ($content->content) {

                                    $imageUrl = $content->content;

                                }

                            @endphp


                            @if($imageUrl)

                                <figure class="education-lesson-image">

                                    <img
                                        src="{{ $imageUrl }}"
                                        alt="{{ $content->title ?: $lesson->title }}"
                                        loading="lazy">

                                </figure>

                            @else

                                <div class="education-lesson-missing-content">

                                    <i class="fa-regular fa-image"></i>

                                    <span>

                                        {{ __('education.resources_page.lesson_page.content.missing.image') }}

                                    </span>

                                </div>

                            @endif

                        @endif


                        {{-- ==========================================
                            VIDEO CONTENT
                        =========================================== --}}

                        @if($content->type === 'video')

                            @php

                                /*
                                |--------------------------------------------------------------------------
                                | VIDEO URL
                                |--------------------------------------------------------------------------
                                | الأولوية:
                                | 1. url
                                | 2. file_url
                                | 3. content
                                |--------------------------------------------------------------------------
                                */

                                $videoUrl = null;

                                if ($content->url) {

                                    $videoUrl = trim($content->url);

                                } elseif ($content->file_path && $content->file_url) {

                                    $videoUrl = $content->file_url;

                                } elseif ($content->content) {

                                    $videoUrl = trim($content->content);

                                }


                                /*
                                |--------------------------------------------------------------------------
                                | VIDEO TYPE
                                |--------------------------------------------------------------------------
                                */

                                $videoType = 'direct';

                                $embedUrl = null;


                                if ($videoUrl) {

                                    /*
                                    |--------------------------------------------------------------------------
                                    | YOUTUBE
                                    |--------------------------------------------------------------------------
                                    */

                                    if (
                                        str_contains($videoUrl, 'youtube.com/watch')
                                        ||
                                        str_contains($videoUrl, 'youtu.be/')
                                        ||
                                        str_contains($videoUrl, 'youtube.com/shorts/')
                                        ||
                                        str_contains($videoUrl, 'youtube.com/embed/')
                                    ) {

                                        $videoType = 'youtube';

                                        $youtubeId = null;


                                        if (
                                            preg_match(
                                                '/[?&]v=([^&]+)/',
                                                $videoUrl,
                                                $matches
                                            )
                                        ) {

                                            $youtubeId = $matches[1];

                                        }


                                        elseif (
                                            preg_match(
                                                '/youtu\.be\/([^?&\/]+)/',
                                                $videoUrl,
                                                $matches
                                            )
                                        ) {

                                            $youtubeId = $matches[1];

                                        }


                                        elseif (
                                            preg_match(
                                                '/youtube\.com\/shorts\/([^?&\/]+)/',
                                                $videoUrl,
                                                $matches
                                            )
                                        ) {

                                            $youtubeId = $matches[1];

                                        }


                                        elseif (
                                            preg_match(
                                                '/youtube\.com\/embed\/([^?&\/]+)/',
                                                $videoUrl,
                                                $matches
                                            )
                                        ) {

                                            $youtubeId = $matches[1];

                                        }


                                        if ($youtubeId) {

                                            $youtubeId = preg_replace(
                                                '/[^a-zA-Z0-9_-]/',
                                                '',
                                                $youtubeId
                                            );

                                            $embedUrl =
                                                'https://www.youtube.com/embed/'
                                                . $youtubeId
                                                . '?rel=0&modestbranding=1';

                                        }

                                    }


                                    /*
                                    |--------------------------------------------------------------------------
                                    | VIMEO
                                    |--------------------------------------------------------------------------
                                    */

                                    elseif (
                                        str_contains($videoUrl, 'vimeo.com/')
                                        ||
                                        str_contains($videoUrl, 'player.vimeo.com/')
                                    ) {

                                        $videoType = 'vimeo';

                                        $vimeoId = null;


                                        if (
                                            preg_match(
                                                '/player\.vimeo\.com\/video\/(\d+)/',
                                                $videoUrl,
                                                $matches
                                            )
                                        ) {

                                            $vimeoId = $matches[1];

                                        }


                                        elseif (
                                            preg_match(
                                                '/vimeo\.com\/(?:video\/)?(\d+)/',
                                                $videoUrl,
                                                $matches
                                            )
                                        ) {

                                            $vimeoId = $matches[1];

                                        }


                                        if ($vimeoId) {

                                            $embedUrl =
                                                'https://player.vimeo.com/video/'
                                                . $vimeoId
                                                . '?title=0&byline=0&portrait=0';

                                        }

                                    }


                                    /*
                                    |--------------------------------------------------------------------------
                                    | GOOGLE DRIVE
                                    |--------------------------------------------------------------------------
                                    */

                                    elseif (
                                        str_contains($videoUrl, 'drive.google.com/')
                                    ) {

                                        $videoType = 'google_drive';

                                        $driveId = null;


                                        if (
                                            preg_match(
                                                '/drive\.google\.com\/file\/d\/([^\/?]+)/',
                                                $videoUrl,
                                                $matches
                                            )
                                        ) {

                                            $driveId = $matches[1];

                                        }


                                        elseif (
                                            preg_match(
                                                '/[?&]id=([^&]+)/',
                                                $videoUrl,
                                                $matches
                                            )
                                        ) {

                                            $driveId = $matches[1];

                                        }


                                        if ($driveId) {

                                            $embedUrl =
                                                'https://drive.google.com/file/d/'
                                                . $driveId
                                                . '/preview';

                                        }

                                    }

                                }

                            @endphp


                            @if($videoUrl)

                                <div class="education-lesson-video">

                                    @if(
                                        in_array(
                                            $videoType,
                                            [
                                                'youtube',
                                                'vimeo',
                                                'google_drive'
                                            ]
                                        )
                                        && $embedUrl
                                    )

                                        <div class="education-lesson-video-embed">

                                            <iframe
                                                src="{{ $embedUrl }}"
                                                title="{{ $content->title ?: $lesson->title }}"
                                                frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                allowfullscreen>
                                            </iframe>

                                        </div>

                                    @else

                                        <video
                                            class="education-lesson-video-player"
                                            controls
                                            preload="metadata"
                                            playsinline>

                                            <source src="{{ $videoUrl }}">

                                            {{ __('education.resources_page.lesson_page.content.video_not_supported') }}

                                        </video>

                                    @endif

                                </div>

                            @else

                                <div class="education-lesson-missing-content">

                                    <i class="fa-solid fa-video-slash"></i>

                                    <span>

                                        {{ __('education.resources_page.lesson_page.content.missing.video') }}

                                    </span>

                                </div>

                            @endif

                        @endif


                        {{-- ==========================================
                            LINK CONTENT
                        =========================================== --}}

                        @if($content->isLink())

                            @if($content->url)

                                <div class="education-lesson-link-box">

                                    <div class="education-lesson-link-icon">

                                        <i class="fa-solid fa-link"></i>

                                    </div>


                                    <div class="education-lesson-link-info">

                                        <strong>

                                            {{ __('education.resources_page.lesson_page.content.link.external') }}

                                        </strong>

                                        <span>
                                            {{ $content->url }}
                                        </span>

                                    </div>


                                    <a
                                        href="{{ $content->url }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="education-lesson-open-link">

                                        {{ __('education.resources_page.lesson_page.content.link.open') }}

                                        <i class="fa-solid fa-arrow-up-left-from-circle"></i>

                                    </a>

                                </div>

                            @else

                                <div class="education-lesson-missing-content">

                                    <i class="fa-solid fa-link-slash"></i>

                                    <span>

                                        {{ __('education.resources_page.lesson_page.content.missing.link') }}

                                    </span>

                                </div>

                            @endif

                        @endif


                        {{-- ==========================================
                            FILE CONTENT
                        =========================================== --}}

                        @if($content->isFile())

                            @if($content->file_url)

                                <div class="education-lesson-file-box">

                                    <div class="education-lesson-file-icon">

                                        <i class="fa-solid fa-file-arrow-down"></i>

                                    </div>


                                    <div class="education-lesson-file-info">

                                        <strong>

                                            {{
                                                $content->file_name
                                                ?: __('education.resources_page.lesson_page.content.file.name')
                                            }}

                                        </strong>


                                        @if($content->formatted_file_size)

                                            <span>

                                                {{ $content->formatted_file_size }}

                                            </span>

                                        @endif

                                    </div>


                                    <a
                                        href="{{ $content->file_url }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="education-lesson-download">

                                        <i class="fa-solid fa-download"></i>

                                        {{ __('education.resources_page.lesson_page.content.file.download') }}

                                    </a>

                                </div>

                            @else

                                <div class="education-lesson-missing-content">

                                    <i class="fa-regular fa-file"></i>

                                    <span>

                                        {{ __('education.resources_page.lesson_page.content.missing.file') }}

                                    </span>

                                </div>

                            @endif

                        @endif


                        {{-- ==========================================
                            CONTENT FOOTER
                        =========================================== --}}

                        <div class="education-lesson-content-footer">

                            <span>

                                <i class="fa-solid fa-check"></i>

                                {{ __('education.resources_page.lesson_page.content.footer', [
                                    'number' => $index + 1
                                ]) }}

                            </span>

                        </div>

                    </article>

                @endforeach

            </div>

        @else

            <div class="education-lesson-empty">

                <div class="education-lesson-empty-icon">

                    <i class="fa-solid fa-book-open"></i>

                </div>


                <h2>
                    {{ __('education.resources_page.lesson_page.empty.title') }}
                </h2>


                <p>
                    {{ __('education.resources_page.lesson_page.empty.description') }}
                </p>

            </div>

        @endif


        {{-- ==================================================
            GENERAL QUIZZES
        ================================================== --}}

        @if($lesson->quizzes->count())

            <section class="education-lesson-quizzes">

                <div class="education-lesson-section-heading">

                    <div>

                        <span class="education-section-badge">

                            {{ __('education.resources_page.lesson_page.quizzes.badge') }}

                        </span>

                        <h2>

                            {{ __('education.resources_page.lesson_page.quizzes.title') }}

                        </h2>

                    </div>


                    <span class="education-lesson-content-count">

                        {{ $lesson->quizzes->count() }}

                        {{ __('education.resources_page.lesson_page.quizzes.count') }}

                    </span>

                </div>


                <div class="education-lesson-quizzes-list">

                    @foreach($lesson->quizzes as $quiz)

                        <article class="education-lesson-quiz-card">

                            <div class="education-lesson-quiz-icon">

                                <i class="fa-solid fa-clipboard-question"></i>

                            </div>


                            <div class="education-lesson-quiz-info">

                                <span class="education-lesson-quiz-label">

                                    {{ __('education.resources_page.lesson_page.quizzes.label') }}

                                </span>


                                <h3>
                                    {{ $quiz->title }}
                                </h3>


                                @if($quiz->description)

                                    <p>
                                        {{ $quiz->description }}
                                    </p>

                                @endif


                                <div class="education-lesson-quiz-meta">

                                    <span>

                                        <i class="fa-solid fa-circle-question"></i>

                                        {{ $quiz->questions_count ?? $quiz->questions->count() }}

                                        {{ __('education.resources_page.lesson_page.quizzes.question') }}

                                    </span>


                                    @if($quiz->pass_percentage !== null)

                                        <span>

                                            <i class="fa-solid fa-percent"></i>

                                            {{ __('education.resources_page.lesson_page.quizzes.pass_from') }}

                                            {{ $quiz->pass_percentage }}%

                                        </span>

                                    @endif


                                    @if($quiz->time_limit)

                                        <span>

                                            <i class="fa-regular fa-clock"></i>

                                            {{ $quiz->time_limit }}

                                            {{ __('education.resources_page.lesson_page.quizzes.minute') }}

                                        </span>

                                    @endif

                                </div>

                            </div>


                            <div class="education-lesson-quiz-action">

                                <a
                                    href="{{ route('education.resources.quiz', $quiz) }}"
                                    class="education-lesson-start-quiz">

                                    {{ __('education.resources_page.lesson_page.quizzes.start') }}

                                    <i class="fa-solid fa-arrow-left"></i>

                                </a>

                            </div>

                        </article>

                    @endforeach

                </div>

            </section>

        @endif

    </main>


    {{-- ==================================================
        SIDEBAR
    ================================================== --}}

    <aside class="education-lesson-sidebar">


        {{-- ==============================================
            LESSON SUMMARY
        =============================================== --}}

        <div class="education-lesson-sidebar-card">

            <div class="education-lesson-sidebar-heading">

                <span class="education-lesson-sidebar-icon">

                    <i class="fa-solid fa-book-open"></i>

                </span>

                <div>

                    <strong>
                        {{ __('education.resources_page.lesson_page.sidebar.about') }}
                    </strong>

                    <small>
                        {{ __('education.resources_page.lesson_page.sidebar.quick_info') }}
                    </small>

                </div>

            </div>


            <div class="education-lesson-sidebar-list">

                <div>

                    <span>
                        {{ __('education.resources_page.lesson_page.sidebar.category') }}
                    </span>

                    <strong>
                        {{ $lesson->category }}
                    </strong>

                </div>


                <div>

                    <span>
                        {{ __('education.resources_page.lesson_page.sidebar.content') }}
                    </span>

                    <strong>
                        {{ $lesson->contents->count() }}
                    </strong>

                </div>


                @if($lesson->duration)

                    <div>

                        <span>
                            {{ __('education.resources_page.lesson_page.sidebar.duration') }}
                        </span>

                        <strong>

                            {{ $lesson->duration }}

                            {{ __('education.resources_page.lesson_page.meta.minute') }}

                        </strong>

                    </div>

                @endif


                @if($lesson->quizzes->count())

                    <div>

                        <span>
                            {{ __('education.resources_page.lesson_page.sidebar.quizzes') }}
                        </span>

                        <strong>
                            {{ $lesson->quizzes->count() }}
                        </strong>

                    </div>

                @endif


                <div>

                    <span>
                        {{ __('education.resources_page.lesson_page.sidebar.status') }}
                    </span>

                    <strong class="active">

                        {{ __('education.resources_page.lesson_page.sidebar.available') }}

                    </strong>

                </div>

            </div>

        </div>


        {{-- ==============================================
            CONTENT TYPES
        =============================================== --}}

        @if($lesson->contents->count())

            <div class="education-lesson-sidebar-card">

                <div class="education-lesson-sidebar-heading">

                    <span class="education-lesson-sidebar-icon">

                        <i class="fa-solid fa-layer-group"></i>

                    </span>

                    <div>

                        <strong>

                            {{ __('education.resources_page.lesson_page.sidebar.content_types') }}

                        </strong>

                        <small>

                            {{ __('education.resources_page.lesson_page.sidebar.what_you_find') }}

                        </small>

                    </div>

                </div>


                <div class="education-lesson-sidebar-types">

                    @php

                        $contentTypeCounts =
                            $lesson->contents
                                ->groupBy('type')
                                ->map
                                ->count();

                    @endphp


                    @foreach($contentTypeCounts as $type => $count)

                        @php

                            $typeData = match($type) {

                                'text' => [
                                    'label' => __('education.resources_page.lesson_page.sidebar.types.text'),
                                    'icon' => 'fa-solid fa-align-right',
                                ],

                                'image' => [
                                    'label' => __('education.resources_page.lesson_page.sidebar.types.image'),
                                    'icon' => 'fa-solid fa-image',
                                ],

                                'video' => [
                                    'label' => __('education.resources_page.lesson_page.sidebar.types.video'),
                                    'icon' => 'fa-solid fa-circle-play',
                                ],

                                'link' => [
                                    'label' => __('education.resources_page.lesson_page.sidebar.types.link'),
                                    'icon' => 'fa-solid fa-link',
                                ],

                                'file' => [
                                    'label' => __('education.resources_page.lesson_page.sidebar.types.file'),
                                    'icon' => 'fa-solid fa-file',
                                ],

                                default => [
                                    'label' => __('education.resources_page.lesson_page.sidebar.types.other'),
                                    'icon' => 'fa-solid fa-layer-group',
                                ],

                            };

                        @endphp


                        <div>

                            <span>

                                <i class="{{ $typeData['icon'] }}"></i>

                                {{ $typeData['label'] }}

                            </span>

                            <strong>
                                {{ $count }}
                            </strong>

                        </div>

                    @endforeach

                </div>

            </div>

        @endif


        {{-- ==============================================
            QUIZZES SIDEBAR
        =============================================== --}}

        @if($lesson->quizzes->count())

            <div class="education-lesson-sidebar-card">

                <div class="education-lesson-sidebar-heading">

                    <span class="education-lesson-sidebar-icon">

                        <i class="fa-solid fa-clipboard-question"></i>

                    </span>

                    <div>

                        <strong>

                            {{ __('education.resources_page.lesson_page.sidebar.quizzes_title') }}

                        </strong>

                        <small>

                            {{ __('education.resources_page.lesson_page.sidebar.quizzes_subtitle') }}

                        </small>

                    </div>

                </div>


                <div class="education-lesson-sidebar-quiz-list">

                    @foreach($lesson->quizzes as $quiz)

                        <a
                            href="{{ route('education.resources.quiz', $quiz) }}"
                            class="education-lesson-sidebar-quiz">

                            <span>

                                <i class="fa-solid fa-circle-question"></i>

                                {{ $quiz->title }}

                            </span>

                            <i class="fa-solid fa-arrow-left"></i>

                        </a>

                    @endforeach

                </div>

            </div>

        @endif


        {{-- ==============================================
            BACK TO CATEGORY
        =============================================== --}}

        <a
            href="{{ route(
                'education.resources.category',
                $lesson->category
            ) }}"
            class="education-lesson-sidebar-back">

            <i class="fa-solid fa-arrow-right"></i>

            {{ __('education.resources_page.lesson_page.sidebar.back_to_category') }}

        </a>


        {{-- ==============================================
            ALL RESOURCES
        =============================================== --}}

        <a
            href="{{ route('education.resources.index') }}"
            class="education-lesson-sidebar-all">

            {{ __('education.resources_page.lesson_page.sidebar.all_resources') }}

            <i class="fa-solid fa-arrow-left"></i>

        </a>

    </aside>

</div>


{{-- ==================================================
    BOTTOM NAVIGATION
================================================== --}}

<div class="education-lesson-bottom">

    <a
        href="{{ route('education.resources.index') }}">

        <i class="fa-solid fa-arrow-right"></i>

        {{ __('education.resources_page.lesson_page.bottom.all_resources') }}

    </a>


    <span>

        {{ __('education.resources_page.lesson_page.bottom.description') }}

    </span>

</div>

</div>

</section>

@endsection

@push('styles')

<style>

/*==================================================
    EDUCATION LESSON PAGE
==================================================*/

.education-lesson-page {

    position: relative;

    padding: 55px 0 110px;

    overflow: hidden;

}


.education-lesson-container {

    width: min(
        1180px,
        calc(100% - 40px)
    );

    margin: 0 auto;

}


/*==================================================
    BREADCRUMB
==================================================*/

.education-lesson-breadcrumb {

    display: flex;

    align-items: center;

    flex-wrap: wrap;

    gap: 10px;

    margin-bottom: 32px;

    color: #888980;

    font-size: 12px;

}


.education-lesson-breadcrumb a {

    display: inline-flex;

    align-items: center;

    gap: 7px;

    color: #777970;

    text-decoration: none;

    transition: color .25s ease;

}


.education-lesson-breadcrumb a:hover {

    color: #a47e42;

}


.education-lesson-breadcrumb > i {

    color: #b99a5b;

    font-size: 9px;

}


.education-lesson-breadcrumb span {

    color: #9a9b93;

}


.education-lesson-breadcrumb .current {

    color: #a3834b;

    font-weight: 800;

}


/*==================================================
    LESSON HERO
==================================================*/

.education-lesson-hero {

    position: relative;

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 40px;

    padding: 44px;

    margin-bottom: 22px;

    border-radius: 30px;

    background:
        linear-gradient(
            135deg,
            #303229,
            #3a3b31
        );

    box-shadow:
        0 22px 55px
        rgba(40,42,35,.15);

    overflow: hidden;

}


.education-lesson-hero::before {

    content: "";

    position: absolute;

    width: 360px;

    height: 360px;

    left: -170px;

    bottom: -230px;

    border-radius: 50%;

    background:
        rgba(211,175,101,.07);

}


.education-lesson-hero::after {

    content: "";

    position: absolute;

    width: 280px;

    height: 280px;

    right: -140px;

    top: -190px;

    border-radius: 50%;

    border:
        1px solid
        rgba(214,181,110,.10);

}


.education-lesson-hero-main {

    position: relative;

    z-index: 2;

    max-width: 800px;

}


.education-lesson-category {

    display: inline-flex;

    align-items: center;

    gap: 8px;

    padding: 8px 15px;

    margin-bottom: 17px;

    border:
        1px solid
        rgba(214,181,110,.23);

    border-radius: 50px;

    background:
        rgba(214,181,110,.07);

    color: #d4b16c;

    font-size: 12px;

    font-weight: 800;

}


.education-lesson-hero h1 {

    margin: 0 0 15px;

    color: #fff;

    font-size: clamp(
        31px,
        4vw,
        50px
    );

    font-weight: 800;

    line-height: 1.35;

}


.education-lesson-hero p {

    max-width: 760px;

    margin: 0;

    color:
        rgba(255,255,255,.66);

    font-size: 15px;

    line-height: 2;

}


.education-lesson-hero-side {

    position: relative;

    z-index: 2;

    display: flex;

    flex-direction: column;

    align-items: center;

    gap: 14px;

}


.education-lesson-hero-icon {

    width: 92px;

    height: 92px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 28px;

    background:
        rgba(214,181,110,.12);

    border:
        1px solid
        rgba(214,181,110,.18);

    color: #d7b66f;

    font-size: 36px;

}


.education-lesson-active {

    display: inline-flex;

    align-items: center;

    gap: 7px;

    color:
        rgba(255,255,255,.55);

    font-size: 11px;

    font-weight: 700;

}


.education-lesson-active i {

    color: #a9c48c;

    font-size: 7px;

}


/*==================================================
    META
==================================================*/

.education-lesson-meta {

    display: grid;

    grid-template-columns:
        repeat(4, minmax(0, 1fr));

    gap: 13px;

    margin-bottom: 48px;

}


.education-lesson-meta-item {

    display: flex;

    align-items: center;

    gap: 12px;

    padding: 17px;

    background:
        rgba(255,255,255,.80);

    border:
        1px solid
        rgba(45,47,39,.07);

    border-radius: 17px;

}


.education-lesson-meta-icon {

    width: 43px;

    height: 43px;

    flex: 0 0 43px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 13px;

    background:
        rgba(178,141,76,.10);

    color: #a47e42;

}


.education-lesson-meta-item small {

    display: block;

    margin-bottom: 4px;

    color: #8b8c84;

    font-size: 10px;

}


.education-lesson-meta-item strong {

    display: block;

    color: #303229;

    font-size: 13px;

    font-weight: 800;

}


.education-lesson-meta-item strong.active {

    color: #668b69;

}


/*==================================================
    LAYOUT
==================================================*/

.education-lesson-layout {

    display: grid;

    grid-template-columns:
        minmax(0, 1fr)
        310px;

    align-items: start;

    gap: 32px;

}


/*==================================================
    SECTION HEADING
==================================================*/

.education-lesson-section-heading {

    display: flex;

    align-items: flex-end;

    justify-content: space-between;

    gap: 20px;

    margin-bottom: 25px;

}


.education-lesson-section-heading
.education-section-badge {

    display: inline-flex;

    padding: 7px 15px;

    border:
        1px solid
        rgba(190,157,91,.30);

    border-radius: 50px;

    color: #a3834b;

    font-size: 11px;

    font-weight: 800;

}


.education-lesson-section-heading h2 {

    margin: 12px 0 0;

    color: #303229;

    font-size: 28px;

    font-weight: 800;

}


.education-lesson-content-count {

    padding: 8px 12px;

    border-radius: 10px;

    background:
        rgba(45,47,39,.04);

    color: #85867e;

    font-size: 11px;

    font-weight: 700;

}


/*==================================================
    CONTENT CARDS
==================================================*/

.education-lesson-contents {

    display: flex;

    flex-direction: column;

    gap: 20px;

}


.education-lesson-content-card {

    padding: 27px;

    background:
        rgba(255,255,255,.84);

    border:
        1px solid
        rgba(45,47,39,.08);

    border-radius: 24px;

    box-shadow:
        0 10px 32px
        rgba(40,42,35,.055);

}


.education-lesson-content-header {

    display: flex;

    align-items: flex-start;

    gap: 15px;

    padding-bottom: 20px;

    border-bottom:
        1px solid
        rgba(45,47,39,.07);

}


.education-lesson-content-number {

    width: 44px;

    height: 44px;

    flex: 0 0 44px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 13px;

    background:
        #303229;

    color: #d4b16c;

    font-size: 12px;

    font-weight: 800;

}


.education-lesson-content-heading span {

    display: inline-flex;

    align-items: center;

    gap: 6px;

    color: #a3834b;

    font-size: 11px;

    font-weight: 800;

}


.education-lesson-content-heading h3 {

    margin: 6px 0 0;

    color: #303229;

    font-size: 19px;

    font-weight: 800;

    line-height: 1.5;

}


/*==================================================
    DESCRIPTION
==================================================*/

.education-lesson-content-description {

    margin-top: 18px;

    padding: 13px 15px;

    border-right:
        3px solid
        #b28d4c;

    border-radius: 9px;

    background:
        rgba(178,141,76,.05);

    color: #777970;

    font-size: 13px;

    line-height: 1.9;

}


/*==================================================
    TEXT
==================================================*/

.education-lesson-text {

    margin-top: 22px;

    color: #55574f;

    font-size: 15px;

    line-height: 2.15;

}


.education-lesson-text::first-letter {

    color: #a47e42;

}


.education-lesson-empty-content {

    margin: 0;

    color: #999a93;

}


/*==================================================
    IMAGE
==================================================*/

.education-lesson-image {

    margin: 23px 0 0;

    overflow: hidden;

    border-radius: 18px;

    background: #f3f2ed;

    border:
        1px solid
        rgba(45,47,39,.07);

}


.education-lesson-image img {

    display: block;

    width: 100%;

    height: auto;

    max-height: 650px;

    object-fit: contain;

}


/*==================================================
    VIDEO
==================================================*/

.education-lesson-video {

    position: relative;

    width: 100%;

    margin-top: 23px;

    overflow: hidden;

    border-radius: 20px;

    background: #20211d;

    border:
        1px solid
        rgba(45,47,39,.10);

    box-shadow:
        0 12px 35px
        rgba(40,42,35,.10);

}


.education-lesson-video-embed {

    position: relative;

    width: 100%;

    aspect-ratio: 16 / 9;

    background: #20211d;

}


.education-lesson-video-embed iframe {

    position: absolute;

    inset: 0;

    display: block;

    width: 100%;

    height: 100%;

    border: 0;

    background: #20211d;

}


.education-lesson-video-player {

    display: block;

    width: 100%;

    height: auto;

    max-height: 650px;

    min-height: 300px;

    background: #20211d;

}


.education-lesson-video-player:focus {

    outline: none;

}


/*==================================================
    LINK
==================================================*/

.education-lesson-link-box {

    display: flex;

    align-items: center;

    gap: 15px;

    margin-top: 22px;

    padding: 17px;

    border-radius: 17px;

    background:
        rgba(178,141,76,.055);

    border:
        1px solid
        rgba(178,141,76,.13);

}


.education-lesson-link-icon {

    width: 48px;

    height: 48px;

    flex: 0 0 48px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 14px;

    background:
        rgba(178,141,76,.12);

    color: #a47e42;

}


.education-lesson-link-info {

    min-width: 0;

    flex: 1;

}


.education-lesson-link-info strong {

    display: block;

    margin-bottom: 4px;

    color: #303229;

    font-size: 13px;

}


.education-lesson-link-info span {

    display: block;

    overflow: hidden;

    color: #8a8b83;

    font-size: 11px;

    text-overflow: ellipsis;

    white-space: nowrap;

    direction: ltr;

    text-align: right;

}


.education-lesson-open-link {

    flex: 0 0 auto;

    display: inline-flex;

    align-items: center;

    gap: 7px;

    padding: 10px 13px;

    border-radius: 11px;

    background: #303229;

    color: #d4b16c;

    text-decoration: none;

    font-size: 11px;

    font-weight: 800;

}


/*==================================================
    FILE
==================================================*/

.education-lesson-file-box {

    display: flex;

    align-items: center;

    gap: 15px;

    margin-top: 22px;

    padding: 18px;

    border-radius: 17px;

    background:
        rgba(45,47,39,.035);

    border:
        1px solid
        rgba(45,47,39,.07);

}


.education-lesson-file-icon {

    width: 50px;

    height: 50px;

    flex: 0 0 50px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 15px;

    background:
        rgba(178,141,76,.11);

    color: #a47e42;

    font-size: 20px;

}


.education-lesson-file-info {

    min-width: 0;

    flex: 1;

}


.education-lesson-file-info strong {

    display: block;

    overflow: hidden;

    margin-bottom: 5px;

    color: #303229;

    font-size: 13px;

    text-overflow: ellipsis;

    white-space: nowrap;

}


.education-lesson-file-info span {

    color: #888980;

    font-size: 11px;

}


.education-lesson-download {

    display: inline-flex;

    align-items: center;

    gap: 7px;

    padding: 10px 13px;

    border-radius: 11px;

    background: #303229;

    color: #d4b16c;

    text-decoration: none;

    font-size: 11px;

    font-weight: 800;

}


/*==================================================
    CONTENT FOOTER
==================================================*/

.education-lesson-content-footer {

    margin-top: 22px;

    padding-top: 14px;

    border-top:
        1px solid
        rgba(45,47,39,.06);

}


.education-lesson-content-footer span {

    display: inline-flex;

    align-items: center;

    gap: 7px;

    color: #999a93;

    font-size: 10px;

}


.education-lesson-content-footer i {

    color: #91a77c;

}


/*==================================================
    MISSING CONTENT
==================================================*/

.education-lesson-missing-content {

    display: flex;

    flex-direction: column;

    align-items: center;

    justify-content: center;

    gap: 10px;

    min-height: 150px;

    margin-top: 22px;

    border-radius: 15px;

    background:
        rgba(45,47,39,.035);

    color: #999a93;

    font-size: 12px;

}


.education-lesson-missing-content i {

    font-size: 25px;

    color: #b2a98f;

}


/*==================================================
    GENERAL QUIZZES
==================================================*/

.education-lesson-quizzes {

    margin-top: 55px;

}


.education-lesson-quizzes-list {

    display: flex;

    flex-direction: column;

    gap: 17px;

}


.education-lesson-quiz-card {

    display: flex;

    align-items: center;

    gap: 18px;

    padding: 22px;

    border:
        1px solid
        rgba(45,47,39,.08);

    border-radius: 21px;

    background:
        rgba(255,255,255,.84);

    box-shadow:
        0 10px 30px
        rgba(40,42,35,.05);

}


.education-lesson-quiz-icon {

    width: 58px;

    height: 58px;

    flex: 0 0 58px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 17px;

    background:
        rgba(178,141,76,.11);

    color: #a47e42;

    font-size: 22px;

}


.education-lesson-quiz-info {

    min-width: 0;

    flex: 1;

}


.education-lesson-quiz-label {

    display: inline-flex;

    align-items: center;

    margin-bottom: 5px;

    color: #a3834b;

    font-size: 10px;

    font-weight: 800;

}


.education-lesson-quiz-info h3 {

    margin: 0;

    color: #303229;

    font-size: 17px;

    font-weight: 800;

    line-height: 1.5;

}


.education-lesson-quiz-info p {

    margin: 7px 0 0;

    color: #85867e;

    font-size: 12px;

    line-height: 1.8;

}


.education-lesson-quiz-meta {

    display: flex;

    align-items: center;

    flex-wrap: wrap;

    gap: 13px;

    margin-top: 12px;

}


.education-lesson-quiz-meta span {

    display: inline-flex;

    align-items: center;

    gap: 6px;

    color: #888980;

    font-size: 10px;

    font-weight: 700;

}


.education-lesson-quiz-meta i {

    color: #a47e42;

}


.education-lesson-quiz-action {

    flex: 0 0 auto;

}


.education-lesson-start-quiz {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 8px;

    padding: 12px 17px;

    border-radius: 12px;

    background: #303229;

    color: #d4b16c;

    text-decoration: none;

    font-size: 11px;

    font-weight: 800;

    transition:
        background .25s ease,
        transform .25s ease;

}


.education-lesson-start-quiz:hover {

    background: #3c3d33;

    transform: translateY(-2px);

}


/*==================================================
    SIDEBAR
==================================================*/

.education-lesson-sidebar {

    position: sticky;

    top: 30px;

    display: flex;

    flex-direction: column;

    gap: 18px;

}


.education-lesson-sidebar-card {

    padding: 21px;

    background:
        rgba(255,255,255,.84);

    border:
        1px solid
        rgba(45,47,39,.08);

    border-radius: 21px;

    box-shadow:
        0 10px 30px
        rgba(40,42,35,.055);

}


.education-lesson-sidebar-heading {

    display: flex;

    align-items: center;

    gap: 11px;

    margin-bottom: 20px;

}


.education-lesson-sidebar-icon {

    width: 42px;

    height: 42px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 13px;

    background:
        rgba(178,141,76,.10);

    color: #a47e42;

}


.education-lesson-sidebar-heading strong {

    display: block;

    color: #303229;

    font-size: 13px;

    font-weight: 800;

}


.education-lesson-sidebar-heading small {

    display: block;

    margin-top: 3px;

    color: #92938c;

    font-size: 10px;

}


/*==================================================
    SIDEBAR LIST
==================================================*/

.education-lesson-sidebar-list {

    display: flex;

    flex-direction: column;

}


.education-lesson-sidebar-list div {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 15px;

    padding: 12px 0;

    border-top:
        1px solid
        rgba(45,47,39,.06);

}


.education-lesson-sidebar-list span {

    color: #85867e;

    font-size: 11px;

}


.education-lesson-sidebar-list strong {

    color: #303229;

    font-size: 11px;

    font-weight: 800;

}


.education-lesson-sidebar-list strong.active {

    color: #668b69;

}


/*==================================================
    SIDEBAR TYPES
==================================================*/

.education-lesson-sidebar-types {

    display: flex;

    flex-direction: column;

    gap: 8px;

}


.education-lesson-sidebar-types div {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 10px;

    padding: 10px 11px;

    border-radius: 11px;

    background:
        rgba(45,47,39,.035);

}


.education-lesson-sidebar-types span {

    display: inline-flex;

    align-items: center;

    gap: 7px;

    color: #70716a;

    font-size: 11px;

}


.education-lesson-sidebar-types span i {

    color: #a47e42;

}


.education-lesson-sidebar-types strong {

    color: #303229;

    font-size: 11px;

}


/*==================================================
    SIDEBAR QUIZZES
==================================================*/

.education-lesson-sidebar-quiz-list {

    display: flex;

    flex-direction: column;

    gap: 8px;

}


.education-lesson-sidebar-quiz {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 10px;

    padding: 11px 12px;

    border-radius: 12px;

    background:
        rgba(45,47,39,.035);

    color: #70716a;

    text-decoration: none;

    font-size: 10px;

    font-weight: 700;

    transition:
        background .25s ease,
        color .25s ease,
        transform .25s ease;

}


.education-lesson-sidebar-quiz span {

    display: inline-flex;

    align-items: center;

    gap: 7px;

    min-width: 0;

}


.education-lesson-sidebar-quiz span i {

    flex: 0 0 auto;

    color: #a47e42;

}


.education-lesson-sidebar-quiz > i {

    flex: 0 0 auto;

    color: #9b9c95;

    font-size: 9px;

}


.education-lesson-sidebar-quiz:hover {

    background:
        rgba(178,141,76,.08);

    color: #a47e42;

    transform: translateX(-2px);

}


/*==================================================
    SIDEBAR BUTTONS
==================================================*/

.education-lesson-sidebar-back {

    display: flex;

    align-items: center;

    justify-content: center;

    gap: 8px;

    padding: 13px;

    border-radius: 13px;

    background: #303229;

    color: #d4b16c;

    text-decoration: none;

    font-size: 12px;

    font-weight: 800;

    transition:
        background .25s ease,
        transform .25s ease;

}


.education-lesson-sidebar-back:hover {

    background: #3c3d33;

    transform: translateY(-2px);

}


.education-lesson-sidebar-all {

    display: flex;

    align-items: center;

    justify-content: center;

    gap: 8px;

    padding: 12px;

    color: #777970;

    text-decoration: none;

    font-size: 12px;

    font-weight: 800;

    transition: color .25s ease;

}


.education-lesson-sidebar-all:hover {

    color: #a47e42;

}


/*==================================================
    EMPTY LESSON
==================================================*/

.education-lesson-empty {

    display: flex;

    flex-direction: column;

    align-items: center;

    justify-content: center;

    min-height: 350px;

    padding: 40px;

    text-align: center;

    border:
        1px dashed
        rgba(45,47,39,.14);

    border-radius: 24px;

    background:
        rgba(255,255,255,.70);

}


.education-lesson-empty-icon {

    width: 72px;

    height: 72px;

    display: flex;

    align-items: center;

    justify-content: center;

    margin-bottom: 18px;

    border-radius: 22px;

    background:
        rgba(178,141,76,.10);

    color: #a47e42;

    font-size: 27px;

}


.education-lesson-empty h2 {

    margin: 0 0 9px;

    color: #303229;

    font-size: 22px;

    font-weight: 800;

}


.education-lesson-empty p {

    margin: 0;

    color: #85867e;

    font-size: 13px;

}


/*==================================================
    BOTTOM
==================================================*/

.education-lesson-bottom {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 20px;

    margin-top: 45px;

    padding-top: 25px;

    border-top:
        1px solid
        rgba(45,47,39,.08);

}


.education-lesson-bottom a {

    display: inline-flex;

    align-items: center;

    gap: 8px;

    color: #303229;

    text-decoration: none;

    font-size: 13px;

    font-weight: 800;

}


.education-lesson-bottom a:hover {

    color: #a47e42;

}


.education-lesson-bottom span {

    color: #85867e;

    font-size: 12px;

}


/*==================================================
    RESPONSIVE
==================================================*/

@media (max-width: 1000px) {

    .education-lesson-layout {

        grid-template-columns: 1fr;

    }


    .education-lesson-sidebar {

        position: static;

        display: grid;

        grid-template-columns:
            repeat(2, minmax(0, 1fr));

    }


    .education-lesson-sidebar-back,
    .education-lesson-sidebar-all {

        min-height: 50px;

    }

}


@media (max-width: 800px) {

    .education-lesson-meta {

        grid-template-columns:
            repeat(2, minmax(0, 1fr));

    }


    .education-lesson-hero {

        align-items: flex-start;

        flex-direction: column;

        padding: 32px;

    }


    .education-lesson-hero-side {

        width: 100%;

        flex-direction: row;

        justify-content: space-between;

    }


    .education-lesson-quiz-card {

        align-items: flex-start;

        flex-wrap: wrap;

    }


    .education-lesson-quiz-info {

        width: calc(100% - 78px);

    }


    .education-lesson-quiz-action {

        width: 100%;

    }


    .education-lesson-start-quiz {

        width: 100%;

    }


    .education-lesson-video-player {

        min-height: 240px;

    }


    .education-lesson-video-embed {

        aspect-ratio: 16 / 9;

    }

}


@media (max-width: 620px) {

    .education-lesson-page {

        padding: 35px 0 80px;

    }


    .education-lesson-container {

        width:
            min(
                100% - 28px,
                520px
            );

    }


    .education-lesson-hero {

        padding: 27px 22px;

        border-radius: 23px;

    }


    .education-lesson-hero h1 {

        font-size: 29px;

    }


    .education-lesson-hero p {

        font-size: 13px;

    }


    .education-lesson-meta {

        grid-template-columns: 1fr;

        margin-bottom: 35px;

    }


    .education-lesson-section-heading {

        align-items: flex-start;

        flex-direction: column;

    }


    .education-lesson-content-card {

        padding: 21px;

        border-radius: 20px;

    }


    .education-lesson-sidebar {

        display: flex;

    }


    .education-lesson-link-box,
    .education-lesson-file-box {

        align-items: flex-start;

        flex-wrap: wrap;

    }


    .education-lesson-link-info,
    .education-lesson-file-info {

        width: calc(100% - 65px);

    }


    .education-lesson-open-link,
    .education-lesson-download {

        width: 100%;

        justify-content: center;

    }


    .education-lesson-video {

        margin-top: 18px;

        border-radius: 15px;

    }


    .education-lesson-video-player {

        min-height: 200px;

    }


    .education-lesson-video-embed {

        aspect-ratio: 16 / 9;

    }


    .education-lesson-bottom {

        align-items: flex-start;

        flex-direction: column;

    }


    .education-lesson-quiz-card {

        padding: 18px;

    }


    .education-lesson-quiz-icon {

        width: 50px;

        height: 50px;

        flex-basis: 50px;

    }


    .education-lesson-quiz-info {

        width: calc(100% - 68px);

    }


    .education-lesson-quiz-info h3 {

        font-size: 15px;

    }

}

</style>

@endpush
