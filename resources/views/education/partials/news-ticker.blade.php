
{{-- =========================================================
EDUCATION NEWS TICKER
RTL / Continuous Animated News Bar
Supports linked and non-linked news
========================================================= --}}

@php

use App\Models\EducationNews;

$educationNews = EducationNews::query()
    ->published()
    ->orderBy('sort_order')
    ->orderByDesc('created_at')
    ->get();

/*
|--------------------------------------------------------------------------
| Education News Ticker
|--------------------------------------------------------------------------
| يدعم العربية والإنجليزية من خلال نظام الترجمة الحالي.
| محتوى الخبر نفسه (title / content) يبقى كما أدخله المشرف.
|--------------------------------------------------------------------------
*/

@endphp

@if($educationNews->isNotEmpty())

<style>

/* =========================================================
   EDUCATION NEWS TICKER
========================================================= */

.education-news-ticker {

    direction: rtl;

    width: 100%;

    position: relative;

    z-index: 900;

    margin-top: 0;

    background: #f4efe2;

    border-bottom:
        1px solid
        rgba(166, 134, 62, 0.25);

    box-shadow:
        0 4px 16px
        rgba(48, 55, 42, 0.08);

    overflow: hidden;
}


/* =========================================================
   CONTAINER
========================================================= */

.education-news-ticker-container {

    width:
        min(
            1400px,
            calc(100% - 32px)
        );

    margin: 0 auto;

    min-height: 54px;

    display: flex;

    align-items: stretch;
}


/* =========================================================
   LABEL
========================================================= */

.education-news-ticker-label {

    flex:
        0 0 auto;

    display: flex;

    align-items: center;

    justify-content: center;

    gap: 9px;

    padding:
        0 20px;

    background: #30372a;

    color: #f8f2e5;

    font-family:
        "Cairo",
        sans-serif;

    font-size: 13px;

    font-weight: 700;

    white-space: nowrap;

    position: relative;

    z-index: 5;
}


.education-news-ticker-label-icon {

    width: 29px;

    height: 29px;

    display: inline-flex;

    align-items: center;

    justify-content: center;

    border-radius: 50%;

    background: #b89a52;

    color: #ffffff;

    font-size: 12px;

    flex-shrink: 0;
}


.education-news-ticker-label-text {

    line-height: 1;
}


/* =========================================================
   VIEWPORT
========================================================= */

.education-news-ticker-viewport {

    flex:
        1 1 auto;

    min-width: 0;

    position: relative;

    overflow: hidden;

    display: flex;

    align-items: center;
}


/* =========================================================
   FADE EDGES
========================================================= */

.education-news-ticker-viewport::before,
.education-news-ticker-viewport::after {

    content: "";

    position: absolute;

    top: 0;

    bottom: 0;

    width: 60px;

    z-index: 4;

    pointer-events: none;
}


.education-news-ticker-viewport::before {

    right: 0;

    background:
        linear-gradient(
            to left,
            #f4efe2,
            rgba(244, 239, 226, 0)
        );
}


.education-news-ticker-viewport::after {

    left: 0;

    background:
        linear-gradient(
            to right,
            #f4efe2,
            rgba(244, 239, 226, 0)
        );
}


/* =========================================================
   TRACK
========================================================= */

.education-news-ticker-track {

    display: flex;

    align-items: center;

    width: max-content;

    flex-shrink: 0;

    animation:
        educationNewsTickerScroll
        30s
        linear
        infinite;

    will-change: transform;
}


/* =========================================================
   PAUSE ON HOVER
========================================================= */

.education-news-ticker:hover
.education-news-ticker-track {

    animation-play-state: paused;
}


/* =========================================================
   NEWS ITEM
========================================================= */

.education-news-ticker-item {

    display: inline-flex;

    align-items: center;

    gap: 10px;

    min-height: 54px;

    padding:
        0 30px;

    color: #30372a;

    text-decoration: none;

    white-space: nowrap;

    font-family:
        "Cairo",
        sans-serif;

    font-size: 13px;

    font-weight: 600;

    position: relative;

    transition:
        color 0.2s ease,
        background 0.2s ease;
}


.education-news-ticker-item:hover {

    color: #8f7435;

    background:
        rgba(
            184,
            154,
            82,
            0.07
        );
}


/* =========================================================
   NON LINK NEWS
========================================================= */

div.education-news-ticker-item {

    cursor: default;
}


/* =========================================================
   ICON
========================================================= */

.education-news-ticker-item-icon {

    width: 30px;

    height: 30px;

    display: inline-flex;

    align-items: center;

    justify-content: center;

    border-radius: 50%;

    background:
        rgba(
            184,
            154,
            82,
            0.14
        );

    color: #a4853f;

    font-size: 12px;

    flex-shrink: 0;
}


/* =========================================================
   TYPE
========================================================= */

.education-news-ticker-type {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    padding:
        4px 10px;

    border-radius: 999px;

    background:
        rgba(
            48,
            55,
            42,
            0.08
        );

    color: #68705c;

    font-family:
        "Cairo",
        sans-serif;

    font-size: 10px;

    font-weight: 700;

    flex-shrink: 0;
}


/* =========================================================
   TITLE
========================================================= */

.education-news-ticker-title {

    line-height: 1.7;

    font-weight: 700;

    flex-shrink: 0;
}


/* =========================================================
   CONTENT
========================================================= */

.education-news-ticker-content {

    color:
        rgba(
            48,
            55,
            42,
            0.66
        );

    font-size: 12px;

    font-weight: 500;

    line-height: 1.7;

    flex-shrink: 0;
}


/* =========================================================
   CONTENT SEPARATOR
========================================================= */

.education-news-ticker-content-separator {

    color: #b89a52;

    font-size: 12px;

    opacity: 0.7;

    flex-shrink: 0;
}


/* =========================================================
   LINK ARROW
========================================================= */

.education-news-ticker-arrow {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    margin-right: 2px;

    color: #b89a52;

    font-size: 10px;

    flex-shrink: 0;

    transition:
        transform 0.2s ease;
}


.education-news-ticker-item:hover
.education-news-ticker-arrow {

    transform:
        translateX(-4px);
}


/* =========================================================
   SEPARATOR
========================================================= */

.education-news-ticker-separator {

    width: 5px;

    height: 5px;

    margin:
        0 4px;

    border-radius: 50%;

    background: #b89a52;

    opacity: 0.65;

    flex-shrink: 0;
}


/* =========================================================
   CONTINUOUS ANIMATION
========================================================= */

@keyframes educationNewsTickerScroll {

    from {

        transform:
            translateX(0);

    }

    to {

        transform:
            translateX(-50%);

    }

}


/* =========================================================
   TABLET
========================================================= */

@media (max-width: 900px) {

    .education-news-ticker {

        margin-top: 0;

    }


    .education-news-ticker-container {

        width: 100%;

    }


    .education-news-ticker-label {

        padding:
            0 14px;

        gap: 7px;

    }


    .education-news-ticker-label-icon {

        width: 26px;

        height: 26px;

        font-size: 11px;

    }


    .education-news-ticker-label-text {

        font-size: 12px;

    }


    .education-news-ticker-item {

        min-height: 50px;

        padding:
            0 22px;

        gap: 8px;

        font-size: 12px;

    }


    .education-news-ticker-item-icon {

        width: 27px;

        height: 27px;

        font-size: 11px;

    }


    .education-news-ticker-type {

        font-size: 9px;

        padding:
            3px 8px;

    }


    .education-news-ticker-content {

        font-size: 11px;

    }


    .education-news-ticker-content-separator {

        font-size: 11px;

    }


    .education-news-ticker-track {

        animation-duration:
            26s;

    }

}


/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 600px) {

    .education-news-ticker {

        margin-top: 0;

    }


    .education-news-ticker-container {

        min-height: 48px;

    }


    .education-news-ticker-label {

        padding:
            0 10px;

    }


    .education-news-ticker-label-text {

        display: none;

    }


    .education-news-ticker-label-icon {

        width: 25px;

        height: 25px;

        font-size: 10px;

    }


    .education-news-ticker-item {

        min-height: 48px;

        padding:
            0 16px;

        gap: 7px;

        font-size: 11px;

    }


    .education-news-ticker-item-icon {

        width: 25px;

        height: 25px;

        font-size: 10px;

    }


    .education-news-ticker-type {

        font-size: 8px;

        padding:
            3px 7px;

    }


    /*
    |--------------------------------------------------------------------------
    | KEEP CONTENT VISIBLE
    |--------------------------------------------------------------------------
    */

    .education-news-ticker-content {

        display: inline;

        max-width: none;

        font-size: 10px;

    }


    .education-news-ticker-content-separator {

        display: inline;

        font-size: 10px;

    }


    .education-news-ticker-arrow {

        font-size: 9px;

    }


    .education-news-ticker-track {

        animation-duration:
            22s;

    }


    .education-news-ticker-viewport::before,
    .education-news-ticker-viewport::after {

        width: 25px;

    }

}


/* =========================================================
   VERY SMALL MOBILE
========================================================= */

@media (max-width: 400px) {

    .education-news-ticker {

        margin-top: 0;

    }


    .education-news-ticker-item {

        padding:
            0 13px;

        gap: 6px;

        font-size: 10px;

    }


    .education-news-ticker-item-icon {

        width: 23px;

        height: 23px;

        font-size: 9px;

    }


    .education-news-ticker-type {

        display: none;

    }


    .education-news-ticker-content {

        font-size: 9px;

    }


    .education-news-ticker-content-separator {

        font-size: 9px;

    }


    .education-news-ticker-track {

        animation-duration:
            20s;

    }

}


/* =========================================================
   REDUCED MOTION
========================================================= */

@media (prefers-reduced-motion: reduce) {

    .education-news-ticker-track {

        animation: none;

        transform: none;

    }

}

</style>

<section
    class="education-news-ticker"
    aria-label="{{ __('education.news.aria_label') }}"
>

<div class="education-news-ticker-container">


    {{-- =====================================================
        FIXED LABEL
    ====================================================== --}}

    <div class="education-news-ticker-label">

        <span class="education-news-ticker-label-icon">

            <i class="fa-solid fa-bullhorn"></i>

        </span>


        <span class="education-news-ticker-label-text">

            {{ __('education.news.latest_news') }}

        </span>

    </div>



    {{-- =====================================================
        MOVING VIEWPORT
    ====================================================== --}}

    <div class="education-news-ticker-viewport">


        <div class="education-news-ticker-track">


            {{-- =================================================
                FIRST NEWS SET
            ================================================== --}}

            @foreach($educationNews as $news)

                @php

                    $icon = $news->icon ?: match ($news->type) {

                        'lesson'
                            => 'fa-solid fa-book-open',

                        'update'
                            => 'fa-solid fa-arrows-rotate',

                        'notice'
                            => 'fa-solid fa-circle-exclamation',

                        'announcement'
                            => 'fa-solid fa-bullhorn',

                        default
                            => 'fa-solid fa-circle-info',

                    };

                    $typeLabel = trans(
                        'education.news.types.' . $news->type
                    );

                    if ($typeLabel === 'education.news.types.' . $news->type) {
                        $typeLabel = $news->type_label;
                    }

                @endphp


                @if($news->link)

                    <a
                        href="{{ $news->link }}"
                        class="education-news-ticker-item"
                        @if(
                            str_starts_with($news->link, 'http://') ||
                            str_starts_with($news->link, 'https://')
                        )
                            target="_blank"
                            rel="noopener noreferrer"
                        @endif
                    >

                @else

                    <div
                        class="education-news-ticker-item"
                    >

                @endif


                    {{-- ICON --}}

                    <span
                        class="education-news-ticker-item-icon"
                    >

                        <i class="{{ $icon }}"></i>

                    </span>


                    {{-- TYPE --}}

                    <span
                        class="education-news-ticker-type"
                    >

                        {{ $typeLabel }}

                    </span>


                    {{-- TITLE --}}

                    <span
                        class="education-news-ticker-title"
                    >

                        {{ $news->title }}

                    </span>


                    {{-- CONTENT --}}

                    @if($news->content)

                        <span
                            class="education-news-ticker-content-separator"
                        >
                            —
                        </span>


                        <span
                            class="education-news-ticker-content"
                        >

                            {{ $news->content }}

                        </span>

                    @endif


                    {{-- LINK ARROW --}}

                    @if($news->link)

                        <span
                            class="education-news-ticker-arrow"
                        >

                            <i
                                class="fa-solid fa-arrow-left"
                            ></i>

                        </span>

                    @endif


                @if($news->link)

                    </a>

                @else

                    </div>

                @endif


                @if(!$loop->last)

                    <span
                        class="education-news-ticker-separator"
                        aria-hidden="true"
                    ></span>

                @endif

            @endforeach



            {{-- =================================================
                SECOND SET
                Used for seamless continuous animation
            ================================================== --}}

            <span
                class="education-news-ticker-separator"
                aria-hidden="true"
            ></span>


            @foreach($educationNews as $news)

                @php

                    $icon = $news->icon ?: match ($news->type) {

                        'lesson'
                            => 'fa-solid fa-book-open',

                        'update'
                            => 'fa-solid fa-arrows-rotate',

                        'notice'
                            => 'fa-solid fa-circle-exclamation',

                        'announcement'
                            => 'fa-solid fa-bullhorn',

                        default
                            => 'fa-solid fa-circle-info',

                    };

                    $typeLabel = trans(
                        'education.news.types.' . $news->type
                    );

                    if ($typeLabel === 'education.news.types.' . $news->type) {
                        $typeLabel = $news->type_label;
                    }

                @endphp


                @if($news->link)

                    <a
                        href="{{ $news->link }}"
                        class="education-news-ticker-item"
                        @if(
                            str_starts_with($news->link, 'http://') ||
                            str_starts_with($news->link, 'https://')
                        )
                            target="_blank"
                            rel="noopener noreferrer"
                        @endif
                    >

                @else

                    <div
                        class="education-news-ticker-item"
                    >

                @endif


                    {{-- ICON --}}

                    <span
                        class="education-news-ticker-item-icon"
                    >

                        <i class="{{ $icon }}"></i>

                    </span>


                    {{-- TYPE --}}

                    <span
                        class="education-news-ticker-type"
                    >

                        {{ $typeLabel }}

                    </span>


                    {{-- TITLE --}}

                    <span
                        class="education-news-ticker-title"
                    >

                        {{ $news->title }}

                    </span>


                    {{-- CONTENT --}}

                    @if($news->content)

                        <span
                            class="education-news-ticker-content-separator"
                        >
                            —
                        </span>


                        <span
                            class="education-news-ticker-content"
                        >

                            {{ $news->content }}

                        </span>

                    @endif


                    {{-- LINK ARROW --}}

                    @if($news->link)

                        <span
                            class="education-news-ticker-arrow"
                        >

                            <i
                                class="fa-solid fa-arrow-left"
                            ></i>

                        </span>

                    @endif


                @if($news->link)

                    </a>

                @else

                    </div>

                @endif


                @if(!$loop->last)

                    <span
                        class="education-news-ticker-separator"
                        aria-hidden="true"
                    ></span>

                @endif

            @endforeach


        </div>

    </div>

</div>

</section>

@endif

