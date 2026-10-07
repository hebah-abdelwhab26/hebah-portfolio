@extends('education.layouts.app')

@section('title', __('education.resources_page.page_title'))

@section('content')

<style>

/*==================================================
    EDUCATION RESOURCES PAGE
==================================================*/

.education-resources-page {

    position: relative;

    padding: 120px 0 100px;

    overflow: hidden;
}


/*==================================================
    CONTAINER
==================================================*/

.education-resources-page-container {

    width: min(1180px, calc(100% - 40px));

    margin: 0 auto;
}


/*==================================================
    HERO
==================================================*/

.education-resources-page-hero {

    position: relative;

    padding: 55px 50px;

    margin-bottom: 55px;

    border-radius: 32px;

    background:
        linear-gradient(
            135deg,
            #303229,
            #3a3b31
        );

    overflow: hidden;

    box-shadow:
        0 25px 60px rgba(40, 42, 35, .16);
}


.education-resources-page-hero::before {

    content: "";

    position: absolute;

    width: 300px;
    height: 300px;

    top: -150px;
    right: -100px;

    border-radius: 50%;

    background:
        radial-gradient(
            circle,
            rgba(212, 177, 108, .18),
            transparent 70%
        );

    pointer-events: none;
}


.education-resources-page-hero::after {

    content: "";

    position: absolute;

    width: 220px;
    height: 220px;

    bottom: -130px;
    left: -70px;

    border-radius: 50%;

    border: 1px solid rgba(212, 177, 108, .12);

    pointer-events: none;
}


.education-resources-page-hero-content {

    position: relative;

    z-index: 2;

    max-width: 760px;
}


/*==================================================
    HERO BADGE
==================================================*/

.education-resources-page-badge {

    display: inline-flex;

    align-items: center;
    justify-content: center;

    gap: 8px;

    padding: 8px 18px;

    margin-bottom: 18px;

    border: 1px solid rgba(212, 177, 108, .35);

    border-radius: 50px;

    color: #d4b16c;

    font-size: 13px;

    font-weight: 700;
}


.education-resources-page-badge i {

    font-size: 12px;
}


/*==================================================
    HERO TITLE
==================================================*/

.education-resources-page-hero h1 {

    margin: 0 0 18px;

    color: #fff;

    font-size: clamp(34px, 5vw, 52px);

    font-weight: 800;

    line-height: 1.25;
}


.education-resources-page-hero h1 span {

    color: #d4b16c;
}


/*==================================================
    HERO DESCRIPTION
==================================================*/

.education-resources-page-hero p {

    max-width: 680px;

    margin: 0;

    color: rgba(255, 255, 255, .68);

    font-size: 16px;

    line-height: 2;
}


/*==================================================
    HERO STATS
==================================================*/

.education-resources-page-stats {

    position: relative;

    z-index: 2;

    display: grid;

    grid-template-columns:
        repeat(3, minmax(0, 1fr));

    gap: 16px;

    margin-top: 35px;

    max-width: 720px;
}


.education-resources-page-stat {

    padding: 17px 20px;

    border:
        1px solid
        rgba(255, 255, 255, .08);

    border-radius: 18px;

    background:
        rgba(255, 255, 255, .045);

    backdrop-filter: blur(10px);
}


.education-resources-page-stat strong {

    display: block;

    margin-bottom: 4px;

    color: #d4b16c;

    font-size: 24px;

    font-weight: 800;
}


.education-resources-page-stat span {

    color: rgba(255, 255, 255, .55);

    font-size: 12px;
}


/*==================================================
    SECTION HEADER
==================================================*/

.education-resources-section-header {

    display: flex;

    align-items: flex-end;

    justify-content: space-between;

    gap: 25px;

    margin-bottom: 25px;
}


.education-resources-section-header-text {

    max-width: 650px;
}


.education-resources-section-header .section-label {

    display: inline-block;

    margin-bottom: 8px;

    color: #a3834b;

    font-size: 12px;

    font-weight: 800;
}


.education-resources-section-header h2 {

    margin: 0 0 8px;

    color: #303229;

    font-size: 28px;

    font-weight: 800;
}


.education-resources-section-header p {

    margin: 0;

    color: #777970;

    font-size: 14px;

    line-height: 1.8;
}


/*==================================================
    CATEGORY NAVIGATION
==================================================*/

.education-resources-categories {

    display: flex;

    flex-wrap: wrap;

    gap: 10px;

    margin-bottom: 65px;
}


.education-resources-category-link {

    display: inline-flex;

    align-items: center;

    gap: 9px;

    padding: 11px 17px;

    border:
        1px solid
        rgba(45, 47, 39, .10);

    border-radius: 50px;

    background: rgba(255, 255, 255, .75);

    color: #55574f;

    font-size: 13px;

    font-weight: 700;

    text-decoration: none;

    transition:
        transform .25s ease,
        background .25s ease,
        color .25s ease,
        border-color .25s ease;
}


.education-resources-category-link i {

    color: #ad8848;

    font-size: 13px;
}


.education-resources-category-link small {

    color: #8b8c84;

    font-size: 10px;

    font-weight: 800;
}


.education-resources-category-link:hover {

    transform: translateY(-2px);

    border-color:
        rgba(178, 141, 76, .35);

    background: #303229;

    color: #fff;
}


.education-resources-category-link:hover i {

    color: #d4b16c;
}


.education-resources-category-link:hover small {

    color: #d4b16c;
}


/*==================================================
    CATEGORY BLOCK
==================================================*/

.education-resource-category-section {

    margin-bottom: 70px;
}


/*==================================================
    CATEGORY HEADING
==================================================*/

.education-resource-category-heading {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 20px;

    margin-bottom: 25px;
}


.education-resource-category-heading-main {

    display: flex;

    align-items: center;

    gap: 15px;
}


.education-resource-category-heading-icon {

    width: 52px;
    height: 52px;

    flex: 0 0 52px;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 17px;

    background:
        rgba(178, 141, 76, .12);

    color: #ad8848;

    font-size: 20px;
}


.education-resource-category-heading h2 {

    margin: 0 0 5px;

    color: #303229;

    font-size: 24px;

    font-weight: 800;
}


.education-resource-category-heading p {

    margin: 0;

    color: #85867e;

    font-size: 13px;
}


.education-resource-category-heading-link {

    display: inline-flex;

    align-items: center;

    gap: 8px;

    color: #9d783d;

    font-size: 13px;

    font-weight: 800;

    text-decoration: none;

    white-space: nowrap;

    transition:
        gap .25s ease,
        color .25s ease;
}


.education-resource-category-heading-link:hover {

    gap: 12px;

    color: #c29c5a;
}


/*==================================================
    CATEGORY SUMMARY
==================================================*/

.education-resources-category-summary {

    position: relative;

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 30px;

    padding: 30px 32px;

    border:
        1px solid
        rgba(45, 47, 39, .08);

    border-radius: 24px;

    background:
        rgba(255, 255, 255, .84);

    box-shadow:
        0 12px 35px
        rgba(40, 42, 35, .06);

    overflow: hidden;

    transition:
        transform .3s ease,
        box-shadow .3s ease,
        border-color .3s ease;
}


.education-resources-category-summary::before {

    content: "";

    position: absolute;

    top: 0;
    left: 0;
    right: 0;

    height: 3px;

    background:
        linear-gradient(
            90deg,
            transparent,
            #b28d4c,
            transparent
        );

    opacity: 0;

    transition: opacity .3s ease;
}


.education-resources-category-summary:hover {

    transform: translateY(-5px);

    border-color:
        rgba(178, 141, 76, .30);

    box-shadow:
        0 20px 45px
        rgba(40, 42, 35, .10);
}


.education-resources-category-summary:hover::before {

    opacity: 1;
}


/*==================================================
    SUMMARY LEFT
==================================================*/

.education-resources-category-summary-content {

    display: flex;

    align-items: center;

    gap: 18px;

    min-width: 0;
}


.education-resources-category-summary-icon {

    width: 62px;
    height: 62px;

    flex: 0 0 62px;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 18px;

    background:
        rgba(178, 141, 76, .12);

    color: #ad8848;

    font-size: 24px;
}


.education-resources-category-summary-text {

    min-width: 0;
}


.education-resources-category-summary-text span {

    display: block;

    margin-bottom: 5px;

    color: #a3834b;

    font-size: 11px;

    font-weight: 800;
}


.education-resources-category-summary-text h3 {

    margin: 0;

    color: #303229;

    font-size: 20px;

    font-weight: 800;

    line-height: 1.5;
}


/*==================================================
    SUMMARY COUNT
==================================================*/

.education-resources-category-count {

    display: flex;

    align-items: center;

    gap: 12px;

    flex: 0 0 auto;

    padding: 12px 17px;

    border-radius: 14px;

    background:
        #f6f5f1;

    color: #777970;
}


.education-resources-category-count i {

    color: #ad8848;

    font-size: 16px;
}


.education-resources-category-count-content {

    display: flex;

    flex-direction: column;

    gap: 2px;
}


.education-resources-category-count strong {

    color: #303229;

    font-size: 18px;

    font-weight: 800;

    line-height: 1;
}


.education-resources-category-count span {

    color: #85867e;

    font-size: 10px;

    font-weight: 700;
}


/*==================================================
    SUMMARY ACTION
==================================================*/

.education-resources-category-summary-action {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 8px;

    flex: 0 0 auto;

    padding: 12px 18px;

    border-radius: 13px;

    background: #303229;

    color: #d4b16c;

    font-size: 12px;

    font-weight: 800;

    text-decoration: none;

    white-space: nowrap;

    transition:
        transform .25s ease,
        background .25s ease,
        gap .25s ease;
}


.education-resources-category-summary-action:hover {

    transform: translateY(-2px);

    gap: 12px;

    background: #3b3c32;

    color: #d4b16c;
}


/*==================================================
    EMPTY CATEGORY
==================================================*/

.education-resources-empty {

    padding: 40px;

    text-align: center;

    border:
        1px dashed
        rgba(45, 47, 39, .13);

    border-radius: 22px;

    background:
        rgba(255, 255, 255, .55);
}


.education-resources-empty i {

    display: block;

    margin-bottom: 13px;

    color: #b28d4c;

    font-size: 30px;
}


.education-resources-empty p {

    margin: 0;

    color: #85867e;

    font-size: 13px;
}


/*==================================================
    ALL EMPTY
==================================================*/

.education-resources-page-empty {

    padding: 80px 30px;

    text-align: center;

    border-radius: 30px;

    background:
        rgba(255, 255, 255, .75);

    border:
        1px solid
        rgba(45, 47, 39, .08);

    box-shadow:
        0 15px 40px
        rgba(40, 42, 35, .06);
}


.education-resources-page-empty-icon {

    width: 75px;
    height: 75px;

    margin: 0 auto 20px;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 24px;

    background:
        rgba(178, 141, 76, .12);

    color: #ad8848;

    font-size: 30px;
}


.education-resources-page-empty h2 {

    margin: 0 0 10px;

    color: #303229;

    font-size: 24px;

    font-weight: 800;
}


.education-resources-page-empty p {

    margin: 0;

    color: #85867e;

    font-size: 14px;
}


/*==================================================
    BOTTOM CTA
==================================================*/

.education-resources-page-bottom {

    margin-top: 75px;

    padding: 40px;

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 30px;

    border-radius: 28px;

    background:
        linear-gradient(
            135deg,
            rgba(178, 141, 76, .10),
            rgba(178, 141, 76, .04)
        );

    border:
        1px solid
        rgba(178, 141, 76, .16);
}


.education-resources-page-bottom h3 {

    margin: 0 0 7px;

    color: #303229;

    font-size: 21px;

    font-weight: 800;
}


.education-resources-page-bottom p {

    margin: 0;

    color: #777970;

    font-size: 13px;

    line-height: 1.8;
}


.education-resources-page-bottom-link {

    display: inline-flex;

    align-items: center;

    gap: 9px;

    padding: 12px 18px;

    border-radius: 13px;

    background: #303229;

    color: #d4b16c;

    font-size: 12px;

    font-weight: 800;

    text-decoration: none;

    white-space: nowrap;

    transition:
        transform .25s ease,
        background .25s ease;
}


.education-resources-page-bottom-link:hover {

    transform: translateY(-2px);

    background: #3b3c32;
}


/*==================================================
    RESPONSIVE
==================================================*/

@media (max-width: 900px) {

    .education-resources-category-summary {

        flex-wrap: wrap;

    }


    .education-resources-category-summary-content {

        flex: 1 1 100%;

    }


    .education-resources-category-count {

        margin-inline-start: auto;

    }

}


@media (max-width: 700px) {

    .education-resources-page {

        padding: 90px 0 70px;
    }


    .education-resources-page-container {

        width: min(100% - 28px, 600px);
    }


    .education-resources-page-hero {

        padding: 38px 25px;

        border-radius: 25px;
    }


    .education-resources-page-stats {

        grid-template-columns: 1fr;

        max-width: 100%;
    }


    .education-resources-section-header {

        flex-direction: column;

        align-items: flex-start;
    }


    .education-resource-category-heading {

        align-items: flex-start;

        flex-direction: column;
    }


    .education-resources-category-summary {

        flex-direction: column;

        align-items: stretch;

        padding: 25px;

        gap: 20px;
    }


    .education-resources-category-summary-content {

        flex: 1 1 auto;

        width: 100%;
    }


    .education-resources-category-count {

        margin-inline-start: 0;

        width: fit-content;
    }


    .education-resources-category-summary-action {

        width: 100%;
    }


    .education-resources-page-bottom {

        flex-direction: column;

        align-items: flex-start;

        padding: 30px 25px;
    }


    .education-resources-page-bottom-link {

        width: 100%;

        justify-content: center;
    }

}


@media (max-width: 450px) {

    .education-resources-page-hero h1 {

        font-size: 32px;
    }


    .education-resources-page-hero p {

        font-size: 14px;
    }


    .education-resources-categories {

        gap: 7px;
    }


    .education-resources-category-link {

        padding: 9px 13px;

        font-size: 11px;
    }


    .education-resources-category-summary-content {

        align-items: flex-start;

        gap: 12px;
    }


    .education-resources-category-summary-icon {

        width: 52px;
        height: 52px;

        flex-basis: 52px;

        font-size: 20px;
    }


    .education-resources-category-summary-text h3 {

        font-size: 17px;
    }


    .education-resources-category-count {

        width: 100%;

        justify-content: center;
    }

}

</style>


<section
    class="education-resources-page"
    id="education-resources-page"
>

    <div class="education-resources-page-container">


        {{-- ==================================================
            PAGE HERO
        ================================================== --}}

        <header class="education-resources-page-hero">

            <div class="education-resources-page-hero-content">

                <span class="education-resources-page-badge">

                    <i class="fa-solid fa-book-open"></i>

                    {{ __('education.resources_page.hero.badge') }}

                </span>


                <h1>

                    {{ __('education.resources_page.hero.title_line_1') }}

                    <span>
                        {{ __('education.resources_page.hero.title_line_2') }}
                    </span>

                </h1>


                <p>

                    {{ __('education.resources_page.hero.description') }}

                </p>


                {{-- ==================================================
                    STATS
                ================================================== --}}

                <div class="education-resources-page-stats">

                    <div class="education-resources-page-stat">

                        <strong>

                            {{ $lessons->count() }}

                        </strong>

                        <span>

                            {{ __('education.resources_page.stats.lessons') }}

                        </span>

                    </div>


                    <div class="education-resources-page-stat">

                        <strong>

                            {{ $lessonsByCategory->count() }}

                        </strong>

                        <span>

                            {{ __('education.resources_page.stats.categories') }}

                        </span>

                    </div>


                    <div class="education-resources-page-stat">

                        <strong>

                            {{ $lessons->sum(function ($lesson) {
                                return $lesson->contents->count();
                            }) }}

                        </strong>

                        <span>

                            {{ __('education.resources_page.stats.materials') }}

                        </span>

                    </div>

                </div>

            </div>

        </header>



        {{-- ==================================================
            CATEGORIES
        ================================================== --}}

        <section>

            <div class="education-resources-section-header">

                <div class="education-resources-section-header-text">

                    <span class="section-label">

                        {{ __('education.resources_page.categories.section_label') }}

                    </span>


                    <h2>

                        {{ __('education.resources_page.categories.title') }}

                    </h2>


                    <p>

                        {{ __('education.resources_page.categories.description') }}

                    </p>

                </div>

            </div>


            <div class="education-resources-categories">

                @php

                    $categoryIcons = [

                        'quran' =>
                            'fa-solid fa-book-quran',

                        'tajweed' =>
                            'fa-solid fa-microphone-lines',

                        'arabic' =>
                            'fa-solid fa-language',

                        'videos' =>
                            'fa-solid fa-circle-play',

                        'materials' =>
                            'fa-solid fa-file-lines',

                        'other' =>
                            'fa-solid fa-book-open',

                    ];


                    $categoryNames = [

                        'quran' =>
                            __('education.resources_page.categories.names.quran'),

                        'tajweed' =>
                            __('education.resources_page.categories.names.tajweed'),

                        'arabic' =>
                            __('education.resources_page.categories.names.arabic'),

                        'videos' =>
                            __('education.resources_page.categories.names.videos'),

                        'materials' =>
                            __('education.resources_page.categories.names.materials'),

                        'other' =>
                            __('education.resources_page.categories.names.other'),

                    ];

                @endphp


                @foreach($lessonsByCategory as $category => $categoryLessons)

                    <a
                        href="{{ route(
                            'education.resources.category',
                            $category
                        ) }}"
                        class="education-resources-category-link"
                    >

                        <i
                            class="{{ $categoryIcons[$category] ?? 'fa-solid fa-book-open' }}"
                        ></i>


                        <span>

                            {{ $categoryNames[$category] ?? __('education.resources_page.categories.names.other') }}

                        </span>


                        <small>

                            ({{ $categoryLessons->count() }})

                        </small>

                    </a>

                @endforeach

            </div>

        </section>



        {{-- ==================================================
            LESSONS BY CATEGORY
        ================================================== --}}

        @forelse($lessonsByCategory as $category => $categoryLessons)

            @php

                $categoryName =
                    $categoryNames[$category]
                    ?? __('education.resources_page.categories.names.other');


                $categoryIcon =
                    $categoryIcons[$category]
                    ?? 'fa-solid fa-book-open';


                $categoryDescriptions = [

                    'quran' =>
                        __('education.resources_page.categories.descriptions.quran'),

                    'tajweed' =>
                        __('education.resources_page.categories.descriptions.tajweed'),

                    'arabic' =>
                        __('education.resources_page.categories.descriptions.arabic'),

                    'videos' =>
                        __('education.resources_page.categories.descriptions.videos'),

                    'materials' =>
                        __('education.resources_page.categories.descriptions.materials'),

                    'other' =>
                        __('education.resources_page.categories.descriptions.other'),

                ];


                $categoryDescription =
                    $categoryDescriptions[$category]
                    ?? $categoryDescriptions['other'];

            @endphp


            <section
                class="education-resource-category-section"
                id="category-{{ $category }}"
            >


                {{-- ==================================================
                    CATEGORY HEADER
                ================================================== --}}

                <div class="education-resource-category-heading">

                    <div class="education-resource-category-heading-main">

                        <div class="education-resource-category-heading-icon">

                            <i class="{{ $categoryIcon }}"></i>

                        </div>


                        <div>

                            <h2>

                                {{ $categoryName }}

                            </h2>


                            <p>

                                {{ $categoryDescription }}

                            </p>

                        </div>

                    </div>


                    <a
                        href="{{ route(
                            'education.resources.category',
                            $category
                        ) }}"
                        class="education-resource-category-heading-link"
                    >

                        {{ __('education.resources_page.categories.view_category') }}

                        <i class="fa-solid fa-arrow-left"></i>

                    </a>

                </div>



                {{-- ==================================================
                    CATEGORY SUMMARY
                ================================================== --}}

                @if($categoryLessons->count())

                    <div class="education-resources-category-summary">


                        {{-- ==========================================
                            CATEGORY INFO
                        =========================================== --}}

                        <div class="education-resources-category-summary-content">

                            <div class="education-resources-category-summary-icon">

                                <i class="{{ $categoryIcon }}"></i>

                            </div>


                            <div class="education-resources-category-summary-text">

                                <span>

                                    {{ __('education.resources_page.categories.section_label') }}

                                </span>


                                <h3>

                                    {{ $categoryName }}

                                </h3>

                            </div>

                        </div>



                        {{-- ==========================================
                            LESSON COUNT
                        =========================================== --}}

                        <div class="education-resources-category-count">

                            <i class="fa-solid fa-book-open"></i>


                            <div class="education-resources-category-count-content">

                                <strong>

                                    {{ $categoryLessons->count() }}

                                </strong>


                                <span>

                                    {{ __('education.resources_page.stats.lessons') }}

                                </span>

                            </div>

                        </div>



                        {{-- ==========================================
                            VIEW CATEGORY
                        =========================================== --}}

                        <a
                            href="{{ route(
                                'education.resources.category',
                                $category
                            ) }}"
                            class="education-resources-category-summary-action"
                        >

                            {{ __('education.resources_page.categories.view_category') }}

                            <i class="fa-solid fa-arrow-left"></i>

                        </a>

                    </div>

                @else

                    <div class="education-resources-empty">

                        <i class="fa-solid fa-book-open"></i>

                        <p>

                            {{ __('education.resources_page.empty.category') }}

                        </p>

                    </div>

                @endif

            </section>

        @empty

            {{-- ==================================================
                NO RESOURCES
            ================================================== --}}

            <div class="education-resources-page-empty">

                <div
                    class="education-resources-page-empty-icon"
                >

                    <i class="fa-solid fa-book-open"></i>

                </div>


                <h2>

                    {{ __('education.resources_page.empty.all_title') }}

                </h2>


                <p>

                    {{ __('education.resources_page.empty.all_description') }}

                </p>

            </div>

        @endforelse



        {{-- ==================================================
            BOTTOM CTA
        ================================================== --}}

        <section
            class="education-resources-page-bottom"
        >

            <div>

                <h3>

                    {{ __('education.resources_page.bottom.title') }}

                </h3>


                <p>

                    {{ __('education.resources_page.bottom.description') }}

                </p>

            </div>


            <a
                href="{{ route('education.index') }}#lessons"
                class="education-resources-page-bottom-link"
            >

                {{ __('education.resources_page.bottom.action') }}

                <i class="fa-solid fa-arrow-left"></i>

            </a>

        </section>


    </div>

</section>

@endsection
