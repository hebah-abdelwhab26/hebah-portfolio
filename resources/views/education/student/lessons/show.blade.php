@extends('education.layouts.app')

@section('title', $lesson->title ?? __('education.student_lesson_show_page.page_title'))

@section('meta_description')
{{ $lesson->description ?? __('education.student_lesson_show_page.meta_description') }}
@endsection

@push('styles')

<style>

/*
|--------------------------------------------------------------------------
| STUDENT LESSON SHOW PAGE
|--------------------------------------------------------------------------
*/

.lesson-show-page {
    min-height: 100vh;

    background:
        radial-gradient(
            circle at top right,
            rgba(185, 149, 82, .08),
            transparent 35%
        ),
        #f7f2e8;

    padding: 45px 0 80px;

    direction: rtl;
}


.lesson-container {
    width: min(1180px, calc(100% - 40px));

    margin: 0 auto;
}


/*
|--------------------------------------------------------------------------
| BACK
|--------------------------------------------------------------------------
*/

.lesson-back {
    display: inline-flex;
    align-items: center;

    gap: 9px;

    margin-bottom: 25px;

    color: #6f8068;

    text-decoration: none;

    font-family: 'Cairo', sans-serif;

    font-size: 14px;

    font-weight: 700;

    transition: .25s ease;
}


.lesson-back:hover {
    color: #b99552;

    transform: translateX(4px);
}


/*
|--------------------------------------------------------------------------
| ALERTS
|--------------------------------------------------------------------------
*/

.lesson-alert {
    display: flex;
    align-items: center;

    gap: 10px;

    padding: 14px 17px;

    border-radius: 13px;

    margin-bottom: 20px;

    font-family: 'Cairo', sans-serif;

    font-size: 13px;

    font-weight: 600;
}


.lesson-alert.success {
    background: rgba(101, 116, 74, .10);

    color: #59663f;
}


.lesson-alert.error {
    background: rgba(170, 70, 60, .09);

    color: #9b4e47;
}


.lesson-alert.info {
    background: rgba(185, 149, 82, .10);

    color: #8b6d31;
}


/*
|--------------------------------------------------------------------------
| HERO
|--------------------------------------------------------------------------
*/

.lesson-hero {
    position: relative;

    overflow: hidden;

    margin-bottom: 30px;

    padding: 45px;

    border-radius: 28px;

    background:
        linear-gradient(
            135deg,
            #fffdf8 0%,
            #f5eee1 100%
        );

    border: 1px solid rgba(185, 149, 82, .18);

    box-shadow:
        0 20px 60px rgba(78, 69, 48, .08);
}


.lesson-hero::before {
    content: '';

    position: absolute;

    width: 260px;
    height: 260px;

    top: -130px;
    left: -100px;

    border-radius: 50%;

    background: rgba(185, 149, 82, .08);

    pointer-events: none;
}


.lesson-hero::after {
    content: '';

    position: absolute;

    width: 180px;
    height: 180px;

    bottom: -100px;
    right: -60px;

    border-radius: 50%;

    background: rgba(111, 128, 104, .07);

    pointer-events: none;
}


.lesson-hero-content {
    position: relative;

    z-index: 2;
}


/*
|--------------------------------------------------------------------------
| BADGE
|--------------------------------------------------------------------------
*/

.lesson-badge {
    display: inline-flex;
    align-items: center;

    gap: 8px;

    padding: 8px 15px;

    border-radius: 50px;

    background: rgba(111, 128, 104, .10);

    color: #63735d;

    font-family: 'Cairo', sans-serif;

    font-size: 12px;

    font-weight: 800;
}


.lesson-badge i {
    color: #b99552;
}


/*
|--------------------------------------------------------------------------
| TITLE
|--------------------------------------------------------------------------
*/

.lesson-title {
    margin: 18px 0 12px;

    color: #3f3a30;

    font-family: 'Amiri', serif;

    font-size: clamp(34px, 5vw, 50px);

    font-weight: 700;

    line-height: 1.35;
}


.lesson-description {
    max-width: 850px;

    margin: 0;

    color: #77705f;

    font-family: 'Cairo', sans-serif;

    font-size: 15px;

    line-height: 2;
}


/*
|--------------------------------------------------------------------------
| META
|--------------------------------------------------------------------------
*/

.lesson-meta {
    display: flex;
    flex-wrap: wrap;

    gap: 10px;

    margin-top: 28px;
}


.lesson-meta-item {
    display: inline-flex;
    align-items: center;

    gap: 8px;

    padding: 10px 14px;

    border-radius: 12px;

    background: rgba(255, 255, 255, .75);

    border: 1px solid rgba(185, 149, 82, .14);

    color: #6e6859;

    font-family: 'Cairo', sans-serif;

    font-size: 12px;

    font-weight: 600;
}


.lesson-meta-item i {
    color: #b99552;
}


/*
|--------------------------------------------------------------------------
| LAYOUT
|--------------------------------------------------------------------------
*/

.lesson-layout {
    display: grid;

    grid-template-columns:
        minmax(0, 1fr)
        320px;

    gap: 28px;

    align-items: start;
}


.lesson-main {
    min-width: 0;
}


/*
|--------------------------------------------------------------------------
| SECTION
|--------------------------------------------------------------------------
*/

.lesson-section {
    margin-bottom: 24px;

    padding: 30px;

    border-radius: 22px;

    background: #fffdf9;

    border: 1px solid rgba(185, 149, 82, .14);

    box-shadow:
        0 12px 35px rgba(78, 69, 48, .05);
}


.lesson-section-header {
    display: flex;
    align-items: center;

    gap: 12px;

    margin-bottom: 25px;

    padding-bottom: 18px;

    border-bottom: 1px solid rgba(185, 149, 82, .10);
}


.lesson-section-icon {
    width: 42px;
    height: 42px;

    display: flex;
    align-items: center;
    justify-content: center;

    flex-shrink: 0;

    border-radius: 12px;

    background: rgba(111, 128, 104, .10);

    color: #6f8068;
}


.lesson-section-title {
    margin: 0;

    color: #403b31;

    font-family: 'Amiri', serif;

    font-size: 25px;

    font-weight: 700;
}


/*
|--------------------------------------------------------------------------
| CONTENT ITEM
|--------------------------------------------------------------------------
*/

.lesson-content-item {
    padding: 22px 0;

    border-bottom: 1px solid rgba(185, 149, 82, .11);
}


.lesson-content-item:first-child {
    padding-top: 0;
}


.lesson-content-item:last-child {
    padding-bottom: 0;

    border-bottom: 0;
}


.lesson-content-title {
    margin: 0 0 10px;

    color: #4b463b;

    font-family: 'Cairo', sans-serif;

    font-size: 17px;

    font-weight: 800;
}


.lesson-content-description {
    margin: 0 0 14px;

    color: #8a8375;

    font-family: 'Cairo', sans-serif;

    font-size: 12px;

    line-height: 1.9;
}


/*
|--------------------------------------------------------------------------
| TEXT CONTENT
|--------------------------------------------------------------------------
*/

.lesson-content-text {
    color: #625d50;

    font-family: 'Cairo', sans-serif;

    font-size: 15px;

    line-height: 2.15;

    white-space: pre-line;
}


/*
|--------------------------------------------------------------------------
| LINK CONTENT
|--------------------------------------------------------------------------
*/

.lesson-content-link-wrapper {
    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 15px;

    padding: 16px;

    border-radius: 15px;

    background: #f8f3e9;

    border: 1px solid rgba(185, 149, 82, .12);
}


.lesson-content-link-info {
    min-width: 0;
}


.lesson-content-link-url {
    display: block;

    margin-top: 3px;

    color: #8b8375;

    font-family: 'Cairo', sans-serif;

    font-size: 11px;

    overflow: hidden;

    text-overflow: ellipsis;

    white-space: nowrap;

    direction: ltr;

    text-align: right;
}


.lesson-content-link {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    flex-shrink: 0;

    gap: 8px;

    min-height: 42px;

    padding: 0 16px;

    border-radius: 11px;

    background: #6f8068;

    color: #fff;

    text-decoration: none;

    font-family: 'Cairo', sans-serif;

    font-size: 12px;

    font-weight: 700;

    transition: .25s ease;
}


.lesson-content-link:hover {
    background: #5e7058;

    transform: translateY(-2px);
}


/*
|--------------------------------------------------------------------------
| IMAGE CONTENT
|--------------------------------------------------------------------------
*/

.lesson-content-image-wrapper {
    overflow: hidden;

    border-radius: 17px;

    background: #f8f3e9;

    border: 1px solid rgba(185, 149, 82, .13);
}


.lesson-content-image {
    display: block;

    width: 100%;

    max-height: 650px;

    object-fit: contain;

    background: #f8f3e9;
}


/*
|--------------------------------------------------------------------------
| FILE CONTENT
|--------------------------------------------------------------------------
*/

.lesson-file {
    display: flex;
    align-items: center;

    gap: 15px;

    padding: 17px;

    border-radius: 15px;

    background: #f8f3e9;

    border: 1px solid rgba(185, 149, 82, .12);
}


.lesson-file-icon {
    width: 46px;
    height: 46px;

    display: flex;
    align-items: center;
    justify-content: center;

    flex-shrink: 0;

    border-radius: 12px;

    background: rgba(185, 149, 82, .12);

    color: #9b7a35;

    font-size: 18px;
}


.lesson-file-info {
    flex: 1;

    min-width: 0;
}


.lesson-file-name {
    margin: 0 0 4px;

    color: #4c473c;

    font-family: 'Cairo', sans-serif;

    font-size: 13px;

    font-weight: 700;

    overflow: hidden;

    text-overflow: ellipsis;

    white-space: nowrap;
}


.lesson-file-meta {
    color: #918a7c;

    font-family: 'Cairo', sans-serif;

    font-size: 10px;
}


.lesson-file-link {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    flex-shrink: 0;

    gap: 7px;

    min-height: 38px;

    padding: 0 13px;

    border-radius: 10px;

    background: #6f8068;

    color: #fff;

    text-decoration: none;

    font-family: 'Cairo', sans-serif;

    font-size: 11px;

    font-weight: 700;

    transition: .25s ease;
}


.lesson-file-link:hover {
    background: #5e7058;
}


/*
|--------------------------------------------------------------------------
| EMPTY CONTENT
|--------------------------------------------------------------------------
*/

.lesson-empty {
    padding: 40px 20px;

    text-align: center;

    color: #888170;

    font-family: 'Cairo', sans-serif;

    font-size: 13px;
}


.lesson-empty i {
    display: block;

    margin-bottom: 12px;

    color: #b99552;

    font-size: 32px;
}


/*
|--------------------------------------------------------------------------
| QUIZ
|--------------------------------------------------------------------------
*/

.quiz-card {
    padding: 18px;

    margin-bottom: 12px;

    border-radius: 16px;

    background: #f8f3e9;

    border: 1px solid rgba(185, 149, 82, .12);
}


.quiz-card:last-child {
    margin-bottom: 0;
}


.quiz-title {
    margin: 0 0 7px;

    color: #4a453a;

    font-family: 'Cairo', sans-serif;

    font-size: 15px;

    font-weight: 800;
}


.quiz-description {
    margin: 0 0 12px;

    color: #77705f;

    font-family: 'Cairo', sans-serif;

    font-size: 12px;

    line-height: 1.8;
}


.quiz-meta {
    display: flex;
    align-items: center;

    gap: 18px;

    color: #817a6b;

    font-family: 'Cairo', sans-serif;

    font-size: 11px;
}


.quiz-meta i {
    color: #b99552;

    margin-left: 4px;
}


.quiz-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    gap: 7px;

    width: 100%;

    margin-top: 13px;

    min-height: 40px;

    padding: 0 13px;

    border-radius: 10px;

    background: #6f8068;

    color: #fff;

    text-decoration: none;

    font-family: 'Cairo', sans-serif;

    font-size: 12px;

    font-weight: 700;

    transition: .25s ease;
}


.quiz-button:hover {
    background: #5e7058;
}


/*
|--------------------------------------------------------------------------
| SIDEBAR
|--------------------------------------------------------------------------
*/

.lesson-sidebar {
    position: sticky;

    top: 25px;
}


.lesson-sidebar-card {
    margin-bottom: 20px;

    padding: 25px;

    border-radius: 22px;

    background: #fffdf9;

    border: 1px solid rgba(185, 149, 82, .14);

    box-shadow:
        0 12px 35px rgba(78, 69, 48, .05);
}


.sidebar-title {
    margin: 0 0 20px;

    color: #433e34;

    font-family: 'Amiri', serif;

    font-size: 23px;

    font-weight: 700;
}


/*
|--------------------------------------------------------------------------
| STATS
|--------------------------------------------------------------------------
*/

.lesson-stat {
    display: flex;
    align-items: center;

    justify-content: space-between;

    gap: 15px;

    padding: 13px 0;

    border-bottom: 1px solid rgba(185, 149, 82, .10);
}


.lesson-stat:last-child {
    border-bottom: 0;
}


.lesson-stat-label {
    display: flex;
    align-items: center;

    gap: 8px;

    color: #77705f;

    font-family: 'Cairo', sans-serif;

    font-size: 12px;
}


.lesson-stat-label i {
    color: #b99552;
}


.lesson-stat-value {
    color: #4e493e;

    font-family: 'Cairo', sans-serif;

    font-size: 12px;

    font-weight: 800;

    text-align: left;
}


/*
|--------------------------------------------------------------------------
| SIDEBAR QUIZ
|--------------------------------------------------------------------------
*/

.sidebar-quiz {
    padding: 14px;

    margin-bottom: 10px;

    border-radius: 13px;

    background: #f8f3e9;

    border: 1px solid rgba(185, 149, 82, .10);
}


.sidebar-quiz:last-child {
    margin-bottom: 0;
}


.sidebar-quiz-title {
    margin: 0 0 7px;

    color: #4a453a;

    font-family: 'Cairo', sans-serif;

    font-size: 12px;

    font-weight: 800;
}


.sidebar-quiz-meta {
    color: #817a6b;

    font-family: 'Cairo', sans-serif;

    font-size: 10px;
}


.sidebar-quiz-meta i {
    color: #b99552;
}


/*
|--------------------------------------------------------------------------
| RETURN BUTTON
|--------------------------------------------------------------------------
*/

.lesson-return-button {
    display: flex;
    align-items: center;
    justify-content: center;

    gap: 8px;

    width: 100%;

    min-height: 44px;

    border-radius: 11px;

    background: #6f8068;

    color: #fff;

    text-decoration: none;

    font-family: 'Cairo', sans-serif;

    font-size: 12px;

    font-weight: 700;

    transition: .25s ease;
}


.lesson-return-button:hover {
    background: #5e7058;

    transform: translateY(-2px);
}


/*
|--------------------------------------------------------------------------
| RESPONSIVE
|--------------------------------------------------------------------------
*/

@media (max-width: 900px) {

    .lesson-layout {
        grid-template-columns: 1fr;
    }


    .lesson-sidebar {
        position: static;
    }

}


@media (max-width: 600px) {

    .lesson-show-page {
        padding: 30px 0 60px;
    }


    .lesson-container {
        width: min(100% - 24px, 1180px);
    }


    .lesson-hero {
        padding: 28px 20px;

        border-radius: 22px;
    }


    .lesson-title {
        font-size: 31px;
    }


    .lesson-description {
        font-size: 13px;
    }


    .lesson-meta-item {
        width: 100%;
    }


    .lesson-section {
        padding: 22px 18px;

        border-radius: 18px;
    }


    .lesson-content-link-wrapper {
        align-items: stretch;

        flex-direction: column;
    }


    .lesson-content-link {
        width: 100%;
    }


    .lesson-file {
        align-items: flex-start;

        flex-wrap: wrap;
    }


    .lesson-file-info {
        width: calc(100% - 61px);
    }


    .lesson-file-link {
        width: 100%;
    }

}

</style>

@endpush
@section('content')

<div class="lesson-show-page">

<div class="lesson-container">

    {{-- =========================================================
         BACK TO STUDENT LESSONS
    ========================================================== --}}

    <a
        href="{{ route('education.student.lessons.index') }}"
        class="lesson-back"
    >

        <i class="fa-solid fa-arrow-right"></i>

        <span>
            {{ __('education.student_lesson_show_page.navigation.back_to_lessons') }}
        </span>

    </a>


    {{-- =========================================================
         FLASH MESSAGES
    ========================================================== --}}

    @if(session('success'))

        <div class="lesson-alert success">

            <i class="fa-solid fa-circle-check"></i>

            <span>
                {{ session('success') }}
            </span>

        </div>

    @endif


    @if(session('error'))

        <div class="lesson-alert error">

            <i class="fa-solid fa-circle-exclamation"></i>

            <span>
                {{ session('error') }}
            </span>

        </div>

    @endif


    @if(session('info'))

        <div class="lesson-alert info">

            <i class="fa-solid fa-circle-info"></i>

            <span>
                {{ session('info') }}
            </span>

        </div>

    @endif


    {{-- =========================================================
         HERO
    ========================================================== --}}

    <section class="lesson-hero">

        <div class="lesson-hero-content">

            <span class="lesson-badge">

                <i class="fa-solid fa-book-open"></i>

                {{ __('education.student_lesson_show_page.hero.badge') }}

            </span>


            <h1 class="lesson-title">

                {{ $lesson->title }}

            </h1>


            @if(!empty($lesson->description))

                <p class="lesson-description">

                    {{ $lesson->description }}

                </p>

            @endif


            <div class="lesson-meta">

                @if(!empty($lesson->level))

                    <div class="lesson-meta-item">

                        <i class="fa-solid fa-layer-group"></i>

                        <span>
                            {{ $lesson->level }}
                        </span>

                    </div>

                @endif


                @if(!empty($lesson->duration))

                    <div class="lesson-meta-item">

                        <i class="fa-regular fa-clock"></i>

                        <span>
                            {{ $lesson->duration }}
                        </span>

                    </div>

                @endif


                <div class="lesson-meta-item">

                    <i class="fa-solid fa-file-lines"></i>

                    <span>

                        {{ $contents->count() }}

                        {{ __('education.student_lesson_show_page.meta.content') }}

                    </span>

                </div>


                <div class="lesson-meta-item">

                    <i class="fa-solid fa-clipboard-question"></i>

                    <span>

                        {{ $quizStatistics['total'] ?? $activeQuizzes->count() }}

                        {{ __('education.student_lesson_show_page.meta.quiz') }}

                    </span>

                </div>

            </div>

        </div>

    </section>


    {{-- =========================================================
         MAIN LAYOUT
    ========================================================== --}}

    <div class="lesson-layout">


        {{-- =====================================================
             MAIN CONTENT
        ====================================================== --}}

        <main class="lesson-main">


            {{-- =================================================
                 LESSON CONTENT
            ================================================== --}}

            <section class="lesson-section">

                <div class="lesson-section-header">

                    <div class="lesson-section-icon">

                        <i class="fa-solid fa-book-open"></i>

                    </div>


                    <h2 class="lesson-section-title">

                        {{ __('education.student_lesson_show_page.content.title') }}

                    </h2>

                </div>


                @forelse($contents as $content)

                    @if(isset($content->is_active) && !$content->is_active)

                        @continue

                    @endif


                    <article class="lesson-content-item">


                        @if(!empty($content->title))

                            <h3 class="lesson-content-title">

                                {{ $content->title }}

                            </h3>

                        @endif


                        @if(!empty($content->description))

                            <p class="lesson-content-description">

                                {{ $content->description }}

                            </p>

                        @endif


                        {{-- TEXT --}}

                        @if($content->type === 'text')

                            @if(!empty($content->content))

                                <div class="lesson-content-text">

                                    {!! nl2br(e($content->content)) !!}

                                </div>

                            @endif


                        {{-- LINK --}}

                        @elseif($content->type === 'link')

                            @php

                                $url = $content->url
                                    ?? $content->content
                                    ?? null;

                            @endphp


                            @if($url)

                                <div class="lesson-content-link-wrapper">

                                    <div class="lesson-content-link-info">

                                        @if(!empty($content->title))

                                            <strong class="lesson-content-title">

                                                {{ $content->title }}

                                            </strong>

                                        @else

                                            <strong class="lesson-content-title">

                                                {{ __('education.student_lesson_show_page.content.link.title') }}

                                            </strong>

                                        @endif


                                        <span class="lesson-content-link-url">

                                            {{ $url }}

                                        </span>

                                    </div>


                                    <a
                                        href="{{ $url }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="lesson-content-link"
                                    >

                                        <i class="fa-solid fa-arrow-up-right-from-square"></i>

                                        {{ __('education.student_lesson_show_page.content.link.open') }}

                                    </a>

                                </div>

                            @endif


                        {{-- IMAGE --}}

                        @elseif($content->type === 'image')

                            @php

                                $imagePath =
                                    $content->file_path
                                    ?? $content->content
                                    ?? null;

                            @endphp


                            @if($imagePath)

                                <div class="lesson-content-image-wrapper">

                                    <img
                                        src="{{ asset($imagePath) }}"
                                        alt="{{ $content->title ?? $lesson->title }}"
                                        class="lesson-content-image"
                                        loading="lazy"
                                    >

                                </div>

                            @endif


                        {{-- FILE --}}

                        @elseif($content->type === 'file')

                            @php

                                $filePath = $content->file_path;

                                $fileName =
                                    $content->file_name
                                    ?? basename($filePath ?? '');

                                $mimeType =
                                    $content->mime_type
                                    ?? '';

                            @endphp


                            @if($filePath)

                                @php

                                    $fileIcon = 'fa-file';

                                    if(str_contains($mimeType, 'pdf')) {

                                        $fileIcon = 'fa-file-pdf';

                                    } elseif(str_contains($mimeType, 'word')) {

                                        $fileIcon = 'fa-file-word';

                                    } elseif(
                                        str_contains($mimeType, 'excel')
                                        ||
                                        str_contains($mimeType, 'spreadsheet')
                                    ) {

                                        $fileIcon = 'fa-file-excel';

                                    } elseif(str_contains($mimeType, 'powerpoint')) {

                                        $fileIcon = 'fa-file-powerpoint';

                                    } elseif(str_contains($mimeType, 'zip')) {

                                        $fileIcon = 'fa-file-zipper';

                                    }

                                @endphp


                                <div class="lesson-file">

                                    <div class="lesson-file-icon">

                                        <i class="fa-solid {{ $fileIcon }}"></i>

                                    </div>


                                    <div class="lesson-file-info">

                                        <p class="lesson-file-name">

                                            {{ $fileName ?: __('education.student_lesson_show_page.content.file.name') }}

                                        </p>


                                        @if($content->file_size)

                                            <div class="lesson-file-meta">

                                                {{ number_format($content->file_size / 1024, 1) }}

                                                {{ __('education.student_lesson_show_page.content.file.kb') }}

                                            </div>

                                        @else

                                            <div class="lesson-file-meta">

                                                {{ __('education.student_lesson_show_page.content.file.educational') }}

                                            </div>

                                        @endif

                                    </div>


                                    <a
                                        href="{{ asset($filePath) }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="lesson-file-link"
                                    >

                                        <i class="fa-solid fa-arrow-up-right-from-square"></i>

                                        {{ __('education.student_lesson_show_page.content.file.open') }}

                                    </a>

                                </div>

                            @endif


                        {{-- FALLBACK --}}

                        @else

                            @if(!empty($content->content))

                                <div class="lesson-content-text">

                                    {!! nl2br(e($content->content)) !!}

                                </div>

                            @endif

                        @endif


                    </article>


                @empty

                    <div class="lesson-empty">

                        <i class="fa-regular fa-folder-open"></i>

                        <div>

                            {{ __('education.student_lesson_show_page.content.empty') }}

                        </div>

                    </div>

                @endforelse


            </section>


            {{-- =====================================================
                 QUIZZES
            ====================================================== --}}

            @if($activeQuizzes->count())

                <section class="lesson-section">

                    <div class="lesson-section-header">

                        <div class="lesson-section-icon">

                            <i class="fa-solid fa-clipboard-question"></i>

                        </div>


                        <h2 class="lesson-section-title">

                            {{ __('education.student_lesson_show_page.quizzes.title') }}

                        </h2>

                    </div>


                    @foreach($activeQuizzes as $quiz)

                        <div class="quiz-card">

                            <h3 class="quiz-title">

                                {{ $quiz->title }}

                            </h3>


                            @if(!empty($quiz->description))

                                <p class="quiz-description">

                                    {{ $quiz->description }}

                                </p>

                            @endif


                            <div class="quiz-meta">

                                <span>

                                    <i class="fa-solid fa-list-check"></i>

                                    {{ $quiz->questions->count() }}

                                    {{ __('education.student_lesson_show_page.quizzes.question') }}

                                </span>


                                @if(isset($quiz->duration) && $quiz->duration)

                                    <span>

                                        <i class="fa-regular fa-clock"></i>

                                        {{ $quiz->duration }}

                                    </span>

                                @endif

                            </div>


                            @auth('education')

                                <a
                                    href="{{ route(
                                        'education.student.quizzes.show',
                                        $quiz
                                    ) }}"
                                    class="quiz-button"
                                >

                                    <i class="fa-solid fa-play"></i>

                                    {{ __('education.student_lesson_show_page.quizzes.enter') }}

                                </a>

                            @else

                                <a
                                    href="{{ route('education.login') }}"
                                    class="quiz-button"
                                >

                                    <i class="fa-solid fa-right-to-bracket"></i>

                                    {{ __('education.student_lesson_show_page.quizzes.login') }}

                                </a>

                            @endauth

                        </div>

                    @endforeach

                </section>

            @endif


        </main>


        {{-- =====================================================
             SIDEBAR
        ====================================================== --}}

        <aside class="lesson-sidebar">


            {{-- LESSON INFORMATION --}}

            <div class="lesson-sidebar-card">

                <h3 class="sidebar-title">

                    {{ __('education.student_lesson_show_page.sidebar.information') }}

                </h3>


                <div class="lesson-stat">

                    <span class="lesson-stat-label">

                        <i class="fa-solid fa-layer-group"></i>

                        {{ __('education.student_lesson_show_page.sidebar.level') }}

                    </span>


                    <span class="lesson-stat-value">

                        {{ $lesson->level ?? __('education.student_lesson_show_page.sidebar.general') }}

                    </span>

                </div>


                @if(!empty($lesson->duration))

                    <div class="lesson-stat">

                        <span class="lesson-stat-label">

                            <i class="fa-regular fa-clock"></i>

                            {{ __('education.student_lesson_show_page.sidebar.duration') }}

                        </span>


                        <span class="lesson-stat-value">

                            {{ $lesson->duration }}

                        </span>

                    </div>

                @endif


                <div class="lesson-stat">

                    <span class="lesson-stat-label">

                        <i class="fa-solid fa-file-lines"></i>

                        {{ __('education.student_lesson_show_page.sidebar.contents') }}

                    </span>


                    <span class="lesson-stat-value">

                        {{ $contents->where('is_active', true)->count() }}

                    </span>

                </div>


                <div class="lesson-stat">

                    <span class="lesson-stat-label">

                        <i class="fa-solid fa-clipboard-question"></i>

                        {{ __('education.student_lesson_show_page.sidebar.quizzes') }}

                    </span>


                    <span class="lesson-stat-value">

                        {{ $quizStatistics['total'] ?? $activeQuizzes->count() }}

                    </span>

                </div>


                <div class="lesson-stat">

                    <span class="lesson-stat-label">

                        <i class="fa-solid fa-list-check"></i>

                        {{ __('education.student_lesson_show_page.sidebar.questions') }}

                    </span>


                    <span class="lesson-stat-value">

                        {{ $quizStatistics['questions'] ?? 0 }}

                    </span>

                </div>

            </div>


            {{-- QUIZ SUMMARY --}}

            @if($activeQuizzes->count())

                <div class="lesson-sidebar-card">

                    <h3 class="sidebar-title">

                        {{ __('education.student_lesson_show_page.quizzes.title') }}

                    </h3>


                    @foreach($activeQuizzes as $quiz)

                        <div class="sidebar-quiz">

                            <h4 class="sidebar-quiz-title">

                                {{ $quiz->title }}

                            </h4>


                            <div class="sidebar-quiz-meta">

                                <i class="fa-solid fa-circle-question"></i>

                                {{ $quiz->questions->count() }}

                                {{ __('education.student_lesson_show_page.quizzes.questions') }}

                            </div>

                        </div>

                    @endforeach

                </div>

            @endif


            {{-- RETURN --}}

            <div class="lesson-sidebar-card">

                <a
                    href="{{ route('education.student.lessons.index') }}"
                    class="lesson-return-button"
                >

                    <i class="fa-solid fa-arrow-right"></i>

                    {{ __('education.student_lesson_show_page.navigation.back_to_lessons') }}

                </a>

            </div>


        </aside>


    </div>

</div>

</div>

@endsection
