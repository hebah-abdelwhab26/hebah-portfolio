{{-- =========================================================
        DIGITAL STUDIO NEWS TICKER
        Complete Blade File
========================================================= --}}

@if(isset($news) && $news->isNotEmpty())
<style>

/* =========================================================
                DIGITAL STUDIO NEWS TICKER
========================================================= */

.digital-news-ticker {

    position: relative;

    width: 100%;

    margin-top: 85px;
   

    padding: 0;

    z-index: 20;

    overflow: hidden;

    border-radius: 20px;

}


/* =========================================================
                MAIN CONTAINER
========================================================= */

.digital-news-ticker-container {

    position: relative;

    display: flex;

    align-items: stretch;

    width: 100%;

    min-height: 58px;

    overflow: hidden;

    background:
        linear-gradient(
            90deg,
            rgba(8, 17, 31, 0.98),
            rgba(10, 24, 43, 0.96),
            rgba(8, 17, 31, 0.98)
        );

    border-top: 1px solid rgba(212, 160, 23, 0.20);

    border-bottom: 1px solid rgba(37, 99, 235, 0.25);

    box-shadow:
        0 8px 30px rgba(0, 0, 0, 0.14),
        inset 0 1px 0 rgba(255, 255, 255, 0.025);

}


/* =========================================================
                LEFT / RIGHT LABEL
========================================================= */

.digital-news-ticker-label {

    position: relative;

    z-index: 5;

    flex: 0 0 auto;

    display: flex;

    align-items: center;

    justify-content: center;

    gap: 10px;

    min-width: 145px;

    padding: 0 24px;

    background:
        linear-gradient(
            135deg,
            #2563EB,
            #1d4ed8
        );

    color: #ffffff;

    font-size: 14px;

    font-weight: 700;

    white-space: nowrap;

    box-shadow:
        8px 0 25px rgba(0, 0, 0, 0.18);

}


/* =========================================================
                LABEL ICON
========================================================= */

.digital-news-ticker-icon {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    width: 29px;

    height: 29px;

    flex-shrink: 0;

    border-radius: 50%;

    background: rgba(255, 255, 255, 0.14);

    color: #ffffff;

    font-size: 12px;

}


/* =========================================================
                CONTENT
========================================================= */

.digital-news-ticker-content {

    position: relative;

    flex: 1;

    min-width: 0;

    overflow: hidden;

    display: flex;

    align-items: center;

}


/* =========================================================
                LEFT / RIGHT FADE
========================================================= */

.digital-news-ticker-content::before,
.digital-news-ticker-content::after {

    content: "";

    position: absolute;

    top: 0;

    bottom: 0;

    width: 70px;

    z-index: 3;

    pointer-events: none;

}


.digital-news-ticker-content::before {

    left: 0;

    background:
        linear-gradient(
            to right,
            rgba(8, 17, 31, 0.98),
            transparent
        );

}


.digital-news-ticker-content::after {

    right: 0;

    background:
        linear-gradient(
            to left,
            rgba(8, 17, 31, 0.98),
            transparent
        );

}


/* =========================================================
                TRACK
========================================================= */

.digital-news-ticker-track {

    display: flex;

    align-items: center;

    width: max-content;

    min-width: max-content;

    animation:
        digitalNewsTickerLTR
        38s
        linear
        infinite;

    will-change: transform;

}


/* =========================================================
                NEWS ITEM
========================================================= */

.digital-news-item {

    display: flex;

    align-items: center;

    gap: 14px;

    min-height: 58px;

    padding: 0 28px;

    color: rgba(255, 255, 255, 0.92);

    font-size: 13px;

    white-space: nowrap;

}


/* =========================================================
                NEWS TYPE
========================================================= */

.digital-news-type {

    display: inline-flex;

    align-items: center;

    gap: 7px;

    color: #D4A017;

    font-size: 12px;

    font-weight: 700;

}


.digital-news-type i {

    font-size: 11px;

}


/* =========================================================
                NEWS TITLE
========================================================= */

.digital-news-title {

    color: #ffffff;

    font-size: 13px;

    font-weight: 600;

}


/* =========================================================
                NEWS DESCRIPTION
========================================================= */

.digital-news-description {

    display: inline-block;

    max-width: 420px;

    overflow: hidden;

    text-overflow: ellipsis;

    color: rgba(255, 255, 255, 0.58);

    font-size: 12px;

}


/* =========================================================
                NEWS LINK
========================================================= */

.digital-news-link {

    display: inline-flex;

    align-items: center;

    gap: 7px;

    color: #60a5fa;

    text-decoration: none;

    font-size: 12px;

    font-weight: 700;

    transition:
        color 0.25s ease,
        transform 0.25s ease;

}


.digital-news-link:hover {

    color: #D4A017;

    transform: translateX(-2px);

}


.digital-news-link i {

    font-size: 11px;

}


/* =========================================================
                SEPARATOR
========================================================= */

.digital-news-separator {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    margin-inline: 8px;

    color: rgba(212, 160, 23, 0.55);

    font-size: 5px;

}


/* =========================================================
                LTR ANIMATION
========================================================= */

@keyframes digitalNewsTickerLTR {

    from {

        transform: translateX(0);

    }

    to {

        transform: translateX(-50%);

    }

}


/* =========================================================
                RTL ANIMATION
========================================================= */

html[dir="rtl"] .digital-news-ticker-track {

    animation-name: digitalNewsTickerRTL;

}


@keyframes digitalNewsTickerRTL {

    from {

        transform: translateX(0);

    }

    to {

        transform: translateX(50%);

    }

}


/* =========================================================
                PAUSE ON HOVER
========================================================= */

.digital-news-ticker-content:hover
.digital-news-ticker-track {

    animation-play-state: paused;

}


/* =========================================================
                TYPE COLORS
========================================================= */

.digital-news-item[data-type="announcement"]
.digital-news-type {

    color: #D4A017;

}


.digital-news-item[data-type="project"]
.digital-news-type {

    color: #60a5fa;

}


.digital-news-item[data-type="update"]
.digital-news-type {

    color: #34d399;

}


.digital-news-item[data-type="notice"]
.digital-news-type {

    color: #fbbf24;

}


.digital-news-item[data-type="general"]
.digital-news-type {

    color: #cbd5e1;

}


/* =========================================================
                MOBILE
========================================================= */

@media (max-width: 768px) {

    .digital-news-ticker-container {

        min-height: 52px;

    }


    .digital-news-ticker-label {

        min-width: 52px;

        width: 52px;

        padding: 0;

        gap: 0;

        flex-shrink: 0;

    }


    .digital-news-ticker-label-text {

        display: none;

    }


    .digital-news-ticker-icon {

        width: 27px;

        height: 27px;

        font-size: 11px;

    }


    .digital-news-item {

        min-height: 52px;

        gap: 10px;

        padding: 0 20px;

        white-space: nowrap;

        flex-shrink: 0;

    }


    .digital-news-type {

        font-size: 11px;

        flex-shrink: 0;

    }


    .digital-news-title {

        display: inline-block;

        width: max-content;

        min-width: max-content;

        max-width: none;

        visibility: visible;

        opacity: 1;

        color: #ffffff;

        font-size: 12px;

        font-weight: 600;

        white-space: nowrap;

        flex: 0 0 auto;

    }


    /* =====================================================
                    NEWS DESCRIPTION
       ===================================================== */

    .digital-news-description {

        display: inline-block;

        width: max-content;

        max-width: 260px;

        overflow: hidden;

        text-overflow: ellipsis;

        white-space: nowrap;

        color: rgba(255, 255, 255, 0.58);

        font-size: 11px;

        flex: 0 0 auto;

    }


    .digital-news-link {

        display: inline-flex;

        font-size: 11px;

        flex-shrink: 0;

    }


    .digital-news-ticker-content::before,
    .digital-news-ticker-content::after {

        width: 35px;

    }

}


/* =========================================================
                SMALL MOBILE
========================================================= */

@media (max-width: 480px) {

    .digital-news-item {

        padding: 0 16px;

        gap: 8px;

    }


    .digital-news-type {

        display: none;

    }


    .digital-news-separator {

        margin-inline: 3px;

    }


    .digital-news-title {

        display: inline-block;

        width: max-content;

        min-width: max-content;

        max-width: none;

        visibility: visible;

        opacity: 1;

        color: #ffffff;

        font-size: 11.5px;

        font-weight: 600;

        white-space: nowrap;

        flex: 0 0 auto;

    }


    /* =====================================================
                    NEWS DESCRIPTION
       ===================================================== */

    .digital-news-description {

        display: inline-block;

        width: max-content;

        max-width: 180px;

        overflow: hidden;

        text-overflow: ellipsis;

        white-space: nowrap;

        color: rgba(255, 255, 255, 0.58);

        font-size: 10px;

        flex: 0 0 auto;

    }


    .digital-news-link {

        font-size: 10.5px;

    }

}


/* =========================================================
                REDUCED MOTION
========================================================= */

@media (prefers-reduced-motion: reduce) {

    .digital-news-ticker-track {

        animation: none;

        transform: none;

    }

}

</style>
<section
    class="digital-news-ticker"
    aria-label="{{ __('digital_studio.news.label') }}"
>

    <div class="digital-news-ticker-container">


        {{-- =================================================
                NEWS LABEL
        ================================================== --}}

        <div class="digital-news-ticker-label">

            <span class="digital-news-ticker-icon">

                <i class="fa-solid fa-bullhorn"></i>

            </span>


            <span class="digital-news-ticker-label-text">

                {{ __('digital_studio.news.label') }}

            </span>

        </div>


        {{-- =================================================
                NEWS CONTENT
        ================================================== --}}

        <div class="digital-news-ticker-content">


            <div class="digital-news-ticker-track">


                {{-- =================================================
                        FIRST NEWS SET
                ================================================== --}}

                @foreach($news as $item)

                    <div
                        class="digital-news-item"
                        data-type="{{ $item->type }}"
                    >


                        {{-- NEWS TYPE --}}

                        <span class="digital-news-type">

                            @if($item->icon)

                                <i class="{{ $item->icon }}"></i>

                            @else

                                <i class="fa-solid fa-circle-info"></i>

                            @endif


                            {{ __('digital_studio.news.types.' . $item->type) }}

                        </span>


                        {{-- NEWS TITLE --}}

                        <span class="digital-news-title">

                            {{ $item->title }}

                        </span>


                        {{-- NEWS CONTENT --}}

                        @if($item->content)

                            <span class="digital-news-description">

                                {{ $item->content }}

                            </span>

                        @endif


                        {{-- NEWS LINK --}}

                        @if($item->link)

                            <a
                                href="{{ $item->link }}"
                                class="digital-news-link"
                            >

                                {{ $item->link_text ?: __('digital_studio.news.read_more') }}

                                <i class="fa-solid fa-arrow-left-long"></i>

                            </a>

                        @endif


                        {{-- SEPARATOR --}}

                        <span class="digital-news-separator">

                            <i class="fa-solid fa-circle"></i>

                        </span>


                    </div>

                @endforeach


                {{-- =================================================
                        DUPLICATED NEWS SET
                        Required for seamless ticker animation
                ================================================== --}}

                @foreach($news as $item)

                    <div
                        class="digital-news-item"
                        data-type="{{ $item->type }}"
                        aria-hidden="true"
                    >


                        {{-- NEWS TYPE --}}

                        <span class="digital-news-type">

                            @if($item->icon)

                                <i class="{{ $item->icon }}"></i>

                            @else

                                <i class="fa-solid fa-circle-info"></i>

                            @endif


                            {{ __('digital_studio.news.types.' . $item->type) }}

                        </span>


                        {{-- NEWS TITLE --}}

                        <span class="digital-news-title">

                            {{ $item->title }}

                        </span>


                        {{-- NEWS CONTENT --}}

                        @if($item->content)

                            <span class="digital-news-description">

                                {{ $item->content }}

                            </span>

                        @endif


                        {{-- NEWS LINK --}}

                        @if($item->link)

                            <span class="digital-news-link">

                                {{ $item->link_text ?: __('digital_studio.news.read_more') }}

                                <i class="fa-solid fa-arrow-left-long"></i>

                            </span>

                        @endif


                        {{-- SEPARATOR --}}

                        <span class="digital-news-separator">

                            <i class="fa-solid fa-circle"></i>

                        </span>


                    </div>

                @endforeach


            </div>

        </div>

    </div>

</section>

@endif
