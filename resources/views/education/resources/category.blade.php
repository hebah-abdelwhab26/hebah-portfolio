
@extends('education.layouts.app')

@section('title', $categoryData['title'] ?? __('education.resources_page.page_title'))

@section('content')

<section class="education-category-page">

    <div class="education-category-container">

        {{-- ==================================================
            BREADCRUMB
        ================================================== --}}

        <div class="education-category-breadcrumb">

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
                {{ $categoryData['name'] }}
            </span>

        </div>


        {{-- ==================================================
            CATEGORY HERO
        ================================================== --}}

        <header class="education-category-hero">

            <div class="education-category-hero-icon">

                <i class="{{ $categoryData['icon'] }}"></i>

            </div>


            <div class="education-category-hero-content">

                <span class="education-section-badge">
                    {{ $categoryData['name'] }}
                </span>

                <h1>
                    {{ $categoryData['title'] }}
                </h1>

                <p>
                    {{ $categoryData['description'] }}
                </p>

            </div>


            <div class="education-category-hero-count">

                <strong>
                    {{ $lessons->count() }}
                </strong>

                <span>
                    {{ trans_choice(
                        'education.resources_page.category.lesson_count',
                        $lessons->count(),
                        ['count' => $lessons->count()]
                    ) }}
                </span>

            </div>

        </header>



        {{-- ==================================================
            CATEGORY TOOLBAR
        ================================================== --}}

        <div class="education-category-toolbar">

            <div class="education-category-toolbar-info">

                <span class="education-category-toolbar-icon">
                    <i class="fa-solid fa-book-open"></i>
                </span>

                <div>

                    <strong>
                        {{ __('education.resources_page.category.available_lessons') }}
                    </strong>

                    <small>
                        {{ __('education.resources_page.category.choose_lesson') }}
                    </small>

                </div>

            </div>


            <a
                href="{{ route('education.resources.index') }}"
                class="education-category-back">

                <i class="fa-solid fa-arrow-right"></i>

                {{ __('education.resources_page.category.all_resources') }}

            </a>

        </div>



        {{-- ==================================================
            LESSONS
        ================================================== --}}

        @if($lessons->count())

            <div class="education-category-lessons">

                @foreach($lessons as $lesson)

                    <article class="education-category-lesson-card">

                        {{-- ==============================
                            CARD TOP
                        =============================== --}}

                        <div class="education-category-lesson-top">

                            <div class="education-category-lesson-icon">

                                @php

                                    $lessonIcon = match(
                                        $category
                                    ) {

                                        'quran'
                                            => 'fa-solid fa-book-quran',

                                        'tajweed'
                                            => 'fa-solid fa-microphone-lines',

                                        'arabic'
                                            => 'fa-solid fa-language',

                                        'videos'
                                            => 'fa-solid fa-circle-play',

                                        'materials'
                                            => 'fa-solid fa-file-lines',

                                        default
                                            => 'fa-solid fa-book-open',

                                    };

                                @endphp

                                <i class="{{ $lessonIcon }}"></i>

                            </div>


                            <span class="education-category-lesson-status">

                                <i class="fa-solid fa-circle"></i>

                                {{ __('education.resources_page.lesson.available') }}

                            </span>

                        </div>



                        {{-- ==============================
                            CONTENT
                        =============================== --}}

                        <div class="education-category-lesson-content">

                            <span class="education-category-lesson-category">
                                {{ $categoryData['name'] }}
                            </span>


                            <h2>
                                {{ $lesson->title }}
                            </h2>


                            @if($lesson->description)

                                <p>
                                    {{ $lesson->description }}
                                </p>

                            @else

                                <p>
                                    {{ __('education.resources_page.lesson.fallback_description', [
                                        'category' => $categoryData['name'],
                                    ]) }}
                                </p>

                            @endif

                        </div>



                        {{-- ==============================
                            META
                        =============================== --}}

                        <div class="education-category-lesson-meta">

                            @if($lesson->duration)

                                <div>

                                    <i class="fa-regular fa-clock"></i>

                                    <span>
                                        {{ trans_choice(
                                            'education.resources_page.lesson.meta.minutes',
                                            (int) $lesson->duration,
                                            ['count' => $lesson->duration]
                                        ) }}
                                    </span>

                                </div>

                            @endif


                            <div>

                                <i class="fa-solid fa-layer-group"></i>

                                <span>
                                    {{ trans_choice(
                                        'education.resources_page.lesson.meta.contents',
                                        $lesson->contents->count(),
                                        ['count' => $lesson->contents->count()]
                                    ) }}
                                </span>

                            </div>


                            @if($lesson->price !== null)

                                <div>

                                    <i class="fa-solid fa-tag"></i>

                                    <span>

                                        @if((float) $lesson->price > 0)

                                            {{ number_format((float) $lesson->price, 2) }}
                                            {{ $lesson->currency ?? 'SAR' }}

                                        @else

                                            {{ __('education.resources_page.lesson.price.free') }}

                                        @endif

                                    </span>

                                </div>

                            @endif

                        </div>



                        {{-- ==============================
                            CONTENT TYPES
                        =============================== --}}

                        @if($lesson->contents->count())

                            <div class="education-category-content-types">

                                @php

                                    $types = $lesson->contents
                                        ->pluck('type')
                                        ->unique()
                                        ->values();

                                @endphp


                                @foreach($types as $type)

                                    @php

                                        $typeData = match($type) {

                                            'text' => [
                                                'label' => __('education.resources_page.lesson.content_types.text'),
                                                'icon' => 'fa-solid fa-align-right',
                                            ],

                                            'image' => [
                                                'label' => __('education.resources_page.lesson.content_types.image'),
                                                'icon' => 'fa-solid fa-image',
                                            ],

                                            'video' => [
                                                'label' => __('education.resources_page.lesson.content_types.video'),
                                                'icon' => 'fa-solid fa-video',
                                            ],

                                            'link' => [
                                                'label' => __('education.resources_page.lesson.content_types.link'),
                                                'icon' => 'fa-solid fa-link',
                                            ],

                                            'file' => [
                                                'label' => __('education.resources_page.lesson.content_types.file'),
                                                'icon' => 'fa-solid fa-file',
                                            ],

                                            default => [
                                                'label' => __('education.resources_page.lesson.content_types.other'),
                                                'icon' => 'fa-solid fa-layer-group',
                                            ],

                                        };

                                    @endphp


                                    <span>

                                        <i class="{{ $typeData['icon'] }}"></i>

                                        {{ $typeData['label'] }}

                                    </span>

                                @endforeach

                            </div>

                        @endif



                        {{-- ==============================
                            FOOTER
                        =============================== --}}

                        <div class="education-category-lesson-footer">

                            <a
                                href="{{ route(
                                    'education.resources.lesson',
                                    $lesson
                                ) }}"
                                class="education-category-lesson-link">

                                <span>
                                    {{ __('education.resources_page.lesson.view') }}
                                </span>

                                <i class="fa-solid fa-arrow-left"></i>

                            </a>

                        </div>

                    </article>

                @endforeach

            </div>

        @else

            {{-- ==================================================
                EMPTY STATE
            ================================================== --}}

            <div class="education-category-empty">

                <div class="education-category-empty-icon">

                    <i class="fa-solid fa-book-open"></i>

                </div>


                <h2>
                    {{ __('education.resources_page.empty.category_title') }}
                </h2>


                <p>
                    {{ __('education.resources_page.empty.category_description') }}
                </p>


                <a
                    href="{{ route('education.resources.index') }}"
                    class="education-category-empty-link">

                    <i class="fa-solid fa-arrow-right"></i>

                    {{ __('education.resources_page.empty.back_to_resources') }}

                </a>

            </div>

        @endif



        {{-- ==================================================
            BOTTOM NAVIGATION
        ================================================== --}}

        <div class="education-category-bottom">

            <a
                href="{{ route('education.resources.index') }}"
                class="education-category-bottom-link">

                <i class="fa-solid fa-arrow-right"></i>

                {{ __('education.resources_page.category.all_resources') }}

            </a>


            <span>
                {{ $categoryData['description'] }}
            </span>

        </div>

    </div>

</section>

@endsection



@push('styles')

<style>

/*==================================================
    EDUCATION CATEGORY PAGE
==================================================*/

.education-category-page {

    position: relative;

    padding: 55px 0 110px;

    overflow: hidden;

}


.education-category-container {

    width: min(
        1180px,
        calc(100% - 40px)
    );

    margin: 0 auto;

}



/*==================================================
    BREADCRUMB
==================================================*/

.education-category-breadcrumb {

    display: flex;

    align-items: center;

    flex-wrap: wrap;

    gap: 10px;

    margin-bottom: 34px;

    color: #8a8b83;

    font-size: 13px;

}


.education-category-breadcrumb a {

    display: inline-flex;

    align-items: center;

    gap: 7px;

    color: #777970;

    text-decoration: none;

    transition: color .25s ease;

}


.education-category-breadcrumb a:hover {

    color: #a47e42;

}


.education-category-breadcrumb > i {

    color: #b99a5b;

    font-size: 10px;

}


.education-category-breadcrumb span {

    color: #a3834b;

    font-weight: 700;

}



/*==================================================
    HERO
==================================================*/

.education-category-hero {

    position: relative;

    display: grid;

    grid-template-columns: auto 1fr auto;

    align-items: center;

    gap: 28px;

    padding: 42px;

    margin-bottom: 35px;

    border-radius: 30px;

    background:
        linear-gradient(
            135deg,
            #303229,
            #3b3c32
        );

    box-shadow:
        0 22px 55px
        rgba(40, 42, 35, .15);

    overflow: hidden;

}


.education-category-hero::before {

    content: "";

    position: absolute;

    width: 280px;

    height: 280px;

    left: -100px;

    bottom: -170px;

    border-radius: 50%;

    background:
        rgba(205, 169, 94, .08);

}


.education-category-hero::after {

    content: "";

    position: absolute;

    width: 220px;

    height: 220px;

    right: -100px;

    top: -120px;

    border-radius: 50%;

    border: 1px solid
        rgba(214, 181, 110, .10);

}


.education-category-hero-icon {

    position: relative;

    z-index: 2;

    width: 86px;

    height: 86px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 25px;

    background:
        rgba(214, 181, 110, .13);

    border:
        1px solid
        rgba(214, 181, 110, .18);

    color: #d6b56e;

    font-size: 34px;

}


.education-category-hero-content {

    position: relative;

    z-index: 2;

}


.education-category-hero-content
.education-section-badge {

    display: inline-flex;

    align-items: center;

    padding: 7px 16px;

    margin-bottom: 13px;

    border:
        1px solid
        rgba(214, 181, 110, .25);

    border-radius: 50px;

    color: #d4b16c;

    font-size: 12px;

    font-weight: 800;

}


.education-category-hero h1 {

    margin: 0 0 12px;

    color: #fff;

    font-size: clamp(
        30px,
        4vw,
        46px
    );

    font-weight: 800;

    line-height: 1.3;

}


.education-category-hero p {

    max-width: 680px;

    margin: 0;

    color:
        rgba(255,255,255,.65);

    font-size: 15px;

    line-height: 1.9;

}


.education-category-hero-count {

    position: relative;

    z-index: 2;

    min-width: 105px;

    display: flex;

    flex-direction: column;

    align-items: center;

    justify-content: center;

    padding: 18px;

    border-radius: 22px;

    background:
        rgba(255,255,255,.06);

    border:
        1px solid
        rgba(255,255,255,.08);

}


.education-category-hero-count strong {

    color: #d8b66e;

    font-size: 34px;

    line-height: 1;

}


.education-category-hero-count span {

    margin-top: 8px;

    color:
        rgba(255,255,255,.55);

    font-size: 12px;

}



/*==================================================
    TOOLBAR
==================================================*/

.education-category-toolbar {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 20px;

    margin-bottom: 25px;

}


.education-category-toolbar-info {

    display: flex;

    align-items: center;

    gap: 13px;

}


.education-category-toolbar-icon {

    width: 45px;

    height: 45px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 14px;

    background:
        rgba(178,141,76,.11);

    color: #a47e42;

}


.education-category-toolbar-info
strong {

    display: block;

    color: #303229;

    font-size: 16px;

    font-weight: 800;

}


.education-category-toolbar-info
small {

    display: block;

    margin-top: 3px;

    color: #8a8b83;

    font-size: 12px;

}


.education-category-back {

    display: inline-flex;

    align-items: center;

    gap: 8px;

    padding: 10px 16px;

    border:
        1px solid
        rgba(45,47,39,.10);

    border-radius: 12px;

    color: #5f6059;

    background: #fff;

    text-decoration: none;

    font-size: 13px;

    font-weight: 800;

    transition:
        background .25s ease,
        color .25s ease,
        transform .25s ease;

}


.education-category-back:hover {

    transform: translateY(-2px);

    background: #303229;

    color: #d4b16c;

}



/*==================================================
    LESSON GRID
==================================================*/

.education-category-lessons {

    display: grid;

    grid-template-columns:
        repeat(3, minmax(0, 1fr));

    gap: 22px;

}



/*==================================================
    LESSON CARD
==================================================*/

.education-category-lesson-card {

    display: flex;

    flex-direction: column;

    min-height: 390px;

    padding: 27px;

    background:
        rgba(255,255,255,.86);

    border:
        1px solid
        rgba(45,47,39,.08);

    border-radius: 25px;

    box-shadow:
        0 12px 35px
        rgba(40,42,35,.07);

    transition:
        transform .35s ease,
        box-shadow .35s ease,
        border-color .35s ease;

}


.education-category-lesson-card:hover {

    transform: translateY(-7px);

    border-color:
        rgba(178,141,76,.30);

    box-shadow:
        0 22px 50px
        rgba(40,42,35,.12);

}



/*==================================================
    CARD TOP
==================================================*/

.education-category-lesson-top {

    display: flex;

    align-items: center;

    justify-content: space-between;

    margin-bottom: 25px;

}


.education-category-lesson-icon {

    width: 58px;

    height: 58px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 18px;

    background:
        rgba(178,141,76,.12);

    color: #ad8848;

    font-size: 23px;

}


.education-category-lesson-status {

    display: inline-flex;

    align-items: center;

    gap: 6px;

    padding: 7px 11px;

    border-radius: 50px;

    background:
        rgba(75,126,79,.08);

    color: #668b69;

    font-size: 11px;

    font-weight: 800;

}


.education-category-lesson-status i {

    font-size: 6px;

}



/*==================================================
    CONTENT
==================================================*/

.education-category-lesson-content {

    flex: 1;

}


.education-category-lesson-category {

    display: inline-block;

    margin-bottom: 8px;

    color: #a3834b;

    font-size: 12px;

    font-weight: 800;

}


.education-category-lesson-content h2 {

    margin: 0 0 12px;

    color: #303229;

    font-size: 21px;

    font-weight: 800;

    line-height: 1.5;

}


.education-category-lesson-content p {

    margin: 0;

    color: #777970;

    font-size: 14px;

    line-height: 1.9;

}



/*==================================================
    META
==================================================*/

.education-category-lesson-meta {

    display: flex;

    flex-wrap: wrap;

    gap: 8px;

    margin-top: 22px;

    padding-top: 17px;

    border-top:
        1px solid
        rgba(45,47,39,.07);

}


.education-category-lesson-meta div {

    display: inline-flex;

    align-items: center;

    gap: 6px;

    padding: 7px 10px;

    border-radius: 10px;

    background:
        rgba(45,47,39,.035);

    color: #777970;

    font-size: 11px;

}


.education-category-lesson-meta i {

    color: #a3834b;

}



/*==================================================
    CONTENT TYPES
==================================================*/

.education-category-content-types {

    display: flex;

    flex-wrap: wrap;

    gap: 7px;

    margin-top: 14px;

}


.education-category-content-types span {

    display: inline-flex;

    align-items: center;

    gap: 6px;

    padding: 6px 9px;

    border:
        1px solid
        rgba(178,141,76,.13);

    border-radius: 9px;

    color: #9a7943;

    background:
        rgba(178,141,76,.05);

    font-size: 10px;

    font-weight: 700;

}



/*==================================================
    FOOTER
==================================================*/

.education-category-lesson-footer {

    margin-top: 23px;

}


.education-category-lesson-link {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 10px;

    width: 100%;

    padding: 13px 15px;

    border-radius: 13px;

    background: #303229;

    color: #d5b16b;

    text-decoration: none;

    font-size: 13px;

    font-weight: 800;

    transition:
        background .25s ease,
        transform .25s ease;

}


.education-category-lesson-link:hover {

    background: #3d3e34;

    transform: translateY(-2px);

}


.education-category-lesson-link i {

    transition: transform .25s ease;

}


.education-category-lesson-link:hover i {

    transform: translateX(-4px);

}



/*==================================================
    EMPTY
==================================================*/

.education-category-empty {

    display: flex;

    flex-direction: column;

    align-items: center;

    justify-content: center;

    min-height: 430px;

    padding: 50px 30px;

    text-align: center;

    background:
        rgba(255,255,255,.75);

    border:
        1px dashed
        rgba(45,47,39,.14);

    border-radius: 28px;

}


.education-category-empty-icon {

    width: 80px;

    height: 80px;

    display: flex;

    align-items: center;

    justify-content: center;

    margin-bottom: 22px;

    border-radius: 25px;

    background:
        rgba(178,141,76,.10);

    color: #ad8848;

    font-size: 29px;

}


.education-category-empty h2 {

    margin: 0 0 10px;

    color: #303229;

    font-size: 24px;

    font-weight: 800;

}


.education-category-empty p {

    max-width: 520px;

    margin: 0 0 25px;

    color: #777970;

    font-size: 14px;

    line-height: 1.9;

}


.education-category-empty-link {

    display: inline-flex;

    align-items: center;

    gap: 8px;

    padding: 12px 18px;

    border-radius: 12px;

    background: #303229;

    color: #d4b16c;

    text-decoration: none;

    font-size: 13px;

    font-weight: 800;

}



/*==================================================
    BOTTOM
==================================================*/

.education-category-bottom {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 20px;

    margin-top: 38px;

    padding-top: 25px;

    border-top:
        1px solid
        rgba(45,47,39,.08);

}


.education-category-bottom-link {

    display: inline-flex;

    align-items: center;

    gap: 8px;

    color: #303229;

    text-decoration: none;

    font-size: 14px;

    font-weight: 800;

    transition: color .25s ease;

}


.education-category-bottom-link:hover {

    color: #a47e42;

}


.education-category-bottom span {

    max-width: 600px;

    color: #85867e;

    font-size: 12px;

    line-height: 1.8;

}



/*==================================================
    RESPONSIVE
==================================================*/

@media (max-width: 1000px) {

    .education-category-lessons {

        grid-template-columns:
            repeat(2, minmax(0, 1fr));

    }

}


@media (max-width: 760px) {

    .education-category-hero {

        grid-template-columns: 1fr;

        text-align: center;

        padding: 32px 25px;

    }


    .education-category-hero-icon {

        margin: 0 auto;

    }


    .education-category-hero p {

        margin: 0 auto;

    }


    .education-category-hero-count {

        width: fit-content;

        min-width: 100px;

        margin: 0 auto;

    }


    .education-category-toolbar {

        align-items: flex-start;

        flex-direction: column;

    }


    .education-category-back {

        width: 100%;

        justify-content: center;

    }


    .education-category-bottom {

        flex-direction: column;

        align-items: flex-start;

    }

}


@media (max-width: 620px) {

    .education-category-page {

        padding: 35px 0 80px;

    }


    .education-category-container {

        width:
            min(
                100% - 28px,
                520px
            );

    }


    .education-category-lessons {

        grid-template-columns: 1fr;

    }


    .education-category-lesson-card {

        min-height: 360px;

        padding: 23px;

    }


    .education-category-hero {

        border-radius: 24px;

    }


    .education-category-hero h1 {

        font-size: 30px;

    }


    .education-category-breadcrumb {

        font-size: 11px;

    }

}

</style>

@endpush
