
{{-- =========================================================
    EDUCATION COMMENTS SECTION
    Public Approved Comments Carousel
========================================================= --}}

<section
    class="education-comments-section"
    id="comments"
>

    <div class="education-comments-container">

        {{-- =====================================================
            SECTION HEADER
        ====================================================== --}}

        <div class="education-comments-header">

            <div class="education-comments-heading">

                <span class="education-comments-eyebrow">

                    <i class="fa-regular fa-comments"></i>

                    {{ __('education.comments.header.eyebrow') }}

                </span>

                <h2 class="education-comments-title">

                    {{ __('education.comments.header.title') }}

                </h2>

                <p class="education-comments-description">

                    {{ __('education.comments.header.description') }}

                </p>

            </div>


            {{-- =================================================
                NAVIGATION BUTTONS
            ================================================== --}}

            @if($comments->count() > 1)

                <div class="education-comments-controls">

                    <button
                        type="button"
                        class="education-comments-control"
                        id="educationCommentsPrev"
                        aria-label="{{ __('education.comments.navigation.previous') }}"
                    >

                        <i class="fa-solid fa-arrow-right"></i>

                    </button>


                    <button
                        type="button"
                        class="education-comments-control"
                        id="educationCommentsNext"
                        aria-label="{{ __('education.comments.navigation.next') }}"
                    >

                        <i class="fa-solid fa-arrow-left"></i>

                    </button>

                </div>

            @endif

        </div>


        {{-- =====================================================
            COMMENTS CAROUSEL
        ====================================================== --}}

        @if($comments->count() > 0)

            <div
                class="education-comments-carousel"
                id="educationCommentsCarousel"
            >

                <div
                    class="education-comments-track"
                    id="educationCommentsTrack"
                >

                    @foreach($comments as $comment)

                        <article class="education-comment-card">

                            {{-- =================================================
                                CARD TOP
                            ================================================== --}}

                            <div class="education-comment-card-top">

                                <div class="education-comment-avatar">

                                    {{ mb_strtoupper(
                                        mb_substr(
                                            $comment->name ?? 'ز',
                                            0,
                                            1
                                        )
                                    ) }}

                                </div>


                                <div class="education-comment-author">

                                    <strong>

                                        {{ $comment->name }}

                                    </strong>

                                    <span>

                                        <i class="fa-solid fa-circle-check"></i>

                                        {{ __('education.comments.card.approved') }}

                                    </span>

                                </div>


                                <div class="education-comment-quote">

                                    <i class="fa-solid fa-quote-left"></i>

                                </div>

                            </div>


                            {{-- =================================================
                                COMMENT TEXT
                            ================================================== --}}

                            <div class="education-comment-content">

                                <p>

                                    {{ $comment->comment }}

                                </p>

                            </div>


                            {{-- =================================================
                                CARD FOOTER
                            ================================================== --}}

                            <div class="education-comment-card-footer">

                                <div class="education-comment-stars">

                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>

                                </div>

                                <span>

                                    {{ $comment->created_at?->format('Y/m/d') }}

                                </span>

                            </div>

                        </article>

                    @endforeach

                </div>

            </div>


            {{-- =================================================
                INDICATORS
            ================================================== --}}

            @if($comments->count() > 1)

                <div
                    class="education-comments-indicators"
                    id="educationCommentsIndicators"
                >

                    @foreach($comments as $index => $comment)

                        <button
                            type="button"
                            class="education-comments-indicator {{ $index === 0 ? 'active' : '' }}"
                            data-slide="{{ $index }}"
                            aria-label="{{ __('education.comments.indicators.comment', ['number' => $index + 1]) }}"
                        ></button>

                    @endforeach

                </div>

            @endif


        @else

            {{-- =================================================
                EMPTY STATE
            ================================================== --}}

            <div class="education-comments-empty">

                <div class="education-comments-empty-icon">

                    <i class="fa-regular fa-comments"></i>

                </div>

                <h3>

                    {{ __('education.comments.empty.title') }}

                </h3>

                <p>

                    {{ __('education.comments.empty.description') }}

                </p>

                @if(Route::has('education.comments.index'))

                    <a
                        href="{{ route('education.comments.index') }}"
                        class="education-comments-empty-button"
                    >

                        <span>

                            {{ __('education.comments.empty.action') }}

                        </span>

                        <i class="fa-solid fa-arrow-left"></i>

                    </a>

                @endif

            </div>

        @endif


        {{-- =====================================================
            ADD COMMENT BUTTON
        ====================================================== --}}

        @if($comments->count() > 0 && Route::has('education.comments.index'))

            <div class="education-comments-action">

                <a
                    href="{{ route('education.comments.index') }}"
                    class="education-comments-button"
                >

                    <span>

                        <i class="fa-regular fa-comment-dots"></i>

                        {{ __('education.comments.action.share_opinion') }}

                    </span>

                    <i class="fa-solid fa-arrow-left"></i>

                </a>

            </div>

        @endif

    </div>

</section>



{{-- =========================================================
    COMMENTS CAROUSEL STYLES
========================================================= --}}

<style>

    /* =========================================================
       SECTION
    ========================================================= */

    .education-comments-section {

        direction: rtl;

        position: relative;

        padding: 100px 20px;

        overflow: hidden;

        background:
            linear-gradient(
                180deg,
                #f8f3e7 0%,
                #f4efdf 100%
            );

    }


    .education-comments-container {

        width: min(1180px, 100%);

        margin: 0 auto;

    }


    /* =========================================================
       HEADER
    ========================================================= */

    .education-comments-header {

        display: flex;

        align-items: flex-end;

        justify-content: space-between;

        gap: 30px;

        margin-bottom: 45px;

    }


    .education-comments-heading {

        text-align: right;

    }


    .education-comments-eyebrow {

        display: inline-flex;

        align-items: center;

        gap: 8px;

        margin-bottom: 12px;

        color: #8c7028;

        font-size: 14px;

        font-weight: 700;

    }


    .education-comments-title {

        margin: 0 0 12px;

        color: #30372a;

        font-size: clamp(30px, 4vw, 44px);

        font-weight: 800;

        line-height: 1.3;

    }


    .education-comments-description {

        margin: 0;

        color: #737765;

        font-size: 16px;

        line-height: 1.9;

    }


    /* =========================================================
       CONTROLS
    ========================================================= */

    .education-comments-controls {

        display: flex;

        gap: 10px;

        direction: ltr;

        flex-shrink: 0;

    }


    .education-comments-control {

        width: 48px;

        height: 48px;

        display: flex;

        align-items: center;

        justify-content: center;

        border: 1px solid rgba(140, 112, 40, .25);

        border-radius: 50%;

        background: rgba(255, 255, 255, .75);

        color: #526044;

        cursor: pointer;

        transition:
            transform .25s ease,
            background .25s ease,
            color .25s ease,
            border-color .25s ease;

    }


    .education-comments-control:hover {

        transform: translateY(-3px);

        background: #526044;

        border-color: #526044;

        color: #fff;

    }


    .education-comments-control:active {

        transform: translateY(0);

    }


    .education-comments-control:disabled {

        opacity: .45;

        cursor: default;

        transform: none;

    }


    /* =========================================================
       CAROUSEL VIEWPORT
    ========================================================= */

    .education-comments-carousel {

        position: relative;

        width: 100%;

        overflow: hidden;

        padding: 10px 5px 25px;

    }


    /* =========================================================
       TRACK
    ========================================================= */

    .education-comments-track {

        display: flex;

        align-items: stretch;

        gap: 24px;

        direction: ltr;

        transition:
            transform .65s cubic-bezier(.22, .61, .36, 1);

        will-change: transform;

    }


    /* =========================================================
       CARD
    ========================================================= */

    .education-comment-card {

        direction: rtl;

        flex: 0 0 calc((100% - 48px) / 3);

        min-width: 0;

        min-height: 280px;

        display: flex;

        flex-direction: column;

        padding: 28px;

        box-sizing: border-box;

        border: 1px solid rgba(140, 112, 40, .16);

        border-radius: 22px;

        background: rgba(255, 255, 255, .82);

        box-shadow:
            0 12px 35px rgba(48, 55, 42, .07);

        backdrop-filter: blur(8px);

        transition:
            transform .35s ease,
            box-shadow .35s ease;

    }


    .education-comment-card:hover {

        transform: translateY(-7px);

        box-shadow:
            0 20px 45px rgba(48, 55, 42, .12);

    }


    /* =========================================================
       CARD TOP
    ========================================================= */

    .education-comment-card-top {

        display: flex;

        align-items: center;

        gap: 14px;

        margin-bottom: 22px;

    }


    .education-comment-avatar {

        width: 52px;

        height: 52px;

        flex-shrink: 0;

        display: flex;

        align-items: center;

        justify-content: center;

        border-radius: 50%;

        background:
            linear-gradient(
                135deg,
                #526044,
                #6d7a58
            );

        color: #fff;

        font-size: 20px;

        font-weight: 800;

        box-shadow:
            0 7px 18px rgba(82, 96, 68, .2);

    }


    .education-comment-author {

        display: flex;

        flex-direction: column;

        gap: 4px;

        min-width: 0;

    }


    .education-comment-author strong {

        color: #30372a;

        font-size: 16px;

        font-weight: 800;

    }


    .education-comment-author span {

        display: flex;

        align-items: center;

        gap: 5px;

        color: #8c7028;

        font-size: 12px;

    }


    .education-comment-author span i {

        font-size: 11px;

    }


    .education-comment-quote {

        margin-right: auto;

        color: #b79a4c;

        font-size: 25px;

        opacity: .65;

    }


    /* =========================================================
       CONTENT
    ========================================================= */

    .education-comment-content {

        flex: 1;

        display: flex;

        align-items: center;

    }


    .education-comment-content p {

        width: 100%;

        margin: 0;

        color: #555b4d;

        font-size: 15px;

        line-height: 2;

        display: -webkit-box;

        -webkit-line-clamp: 5;

        -webkit-box-orient: vertical;

        overflow: hidden;

    }


    /* =========================================================
       FOOTER
    ========================================================= */

    .education-comment-card-footer {

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 15px;

        margin-top: 24px;

        padding-top: 18px;

        border-top: 1px solid rgba(48, 55, 42, .08);

    }


    .education-comment-stars {

        display: flex;

        gap: 3px;

        color: #b18a32;

        font-size: 12px;

    }


    .education-comment-card-footer > span {

        color: #929688;

        font-size: 11px;

    }


    /* =========================================================
       INDICATORS
    ========================================================= */

    .education-comments-indicators {

        display: flex;

        justify-content: center;

        align-items: center;

        gap: 7px;

        margin-top: 5px;

    }


    .education-comments-indicator {

        width: 8px;

        height: 8px;

        padding: 0;

        border: 0;

        border-radius: 50%;

        background: #c9c8bc;

        cursor: pointer;

        transition:
            width .3s ease,
            background .3s ease;

    }


    .education-comments-indicator.active {

        width: 25px;

        border-radius: 10px;

        background: #526044;

    }


    /* =========================================================
       ACTION
    ========================================================= */

    .education-comments-action {

        display: flex;

        justify-content: center;

        margin-top: 38px;

    }


    .education-comments-button {

        display: inline-flex;

        align-items: center;

        justify-content: center;

        gap: 18px;

        min-height: 52px;

        padding: 0 24px;

        border-radius: 14px;

        background: #526044;

        color: #fff;

        text-decoration: none;

        font-size: 14px;

        font-weight: 700;

        box-shadow:
            0 10px 25px rgba(82, 96, 68, .18);

        transition:
            transform .25s ease,
            box-shadow .25s ease,
            background .25s ease;

    }


    .education-comments-button:hover {

        transform: translateY(-3px);

        background: #465238;

        color: #fff;

        box-shadow:
            0 14px 30px rgba(82, 96, 68, .25);

    }


    .education-comments-button > span {

        display: inline-flex;

        align-items: center;

        gap: 9px;

    }


    /* =========================================================
       EMPTY STATE
    ========================================================= */

    .education-comments-empty {

        max-width: 600px;

        margin: 0 auto;

        padding: 55px 30px;

        text-align: center;

        border: 1px solid rgba(140, 112, 40, .14);

        border-radius: 22px;

        background: rgba(255, 255, 255, .65);

    }


    .education-comments-empty-icon {

        width: 70px;

        height: 70px;

        margin: 0 auto 20px;

        display: flex;

        align-items: center;

        justify-content: center;

        border-radius: 50%;

        background: rgba(82, 96, 68, .09);

        color: #526044;

        font-size: 27px;

    }


    .education-comments-empty h3 {

        margin: 0 0 8px;

        color: #30372a;

        font-size: 21px;

    }


    .education-comments-empty p {

        margin: 0 0 22px;

        color: #777c6f;

        line-height: 1.8;

    }


    .education-comments-empty-button {

        display: inline-flex;

        align-items: center;

        gap: 12px;

        padding: 12px 20px;

        border-radius: 12px;

        background: #526044;

        color: #fff;

        text-decoration: none;

        font-size: 14px;

        font-weight: 700;

    }


    /* =========================================================
       RESPONSIVE - TABLET
    ========================================================= */

    @media (max-width: 991px) {

        .education-comment-card {

            flex: 0 0 calc((100% - 24px) / 2);

        }

    }


    /* =========================================================
       RESPONSIVE - MOBILE
    ========================================================= */

    @media (max-width: 700px) {

        .education-comments-section {

            padding: 75px 15px;

        }


        .education-comments-header {

            align-items: flex-start;

            flex-direction: column;

            margin-bottom: 30px;

        }


        .education-comments-controls {

            align-self: flex-start;

        }


        .education-comment-card {

            flex: 0 0 100%;

            min-height: 270px;

            padding: 24px;

        }


        .education-comments-carousel {

            padding-left: 0;

            padding-right: 0;

        }

    }


    /* =========================================================
       REDUCED MOTION
    ========================================================= */

    @media (prefers-reduced-motion: reduce) {

        .education-comments-track {

            transition: none;

        }


        .education-comment-card,
        .education-comments-control,
        .education-comments-button {

            transition: none;

        }

    }

</style>



{{-- =========================================================
    COMMENTS CAROUSEL SCRIPT
========================================================= --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const track =
        document.getElementById(
            'educationCommentsTrack'
        );

    const carousel =
        document.getElementById(
            'educationCommentsCarousel'
        );

    const previousButton =
        document.getElementById(
            'educationCommentsPrev'
        );

    const nextButton =
        document.getElementById(
            'educationCommentsNext'
        );

    const indicatorsContainer =
        document.getElementById(
            'educationCommentsIndicators'
        );


    /* =========================================================
       SAFETY CHECK
    ========================================================= */

    if (!track || !carousel) {

        return;

    }


    const cards =
        Array.from(
            track.querySelectorAll(
                '.education-comment-card'
            )
        );


    if (cards.length <= 1) {

        return;

    }


    const indicators =
        indicatorsContainer
            ? Array.from(
                indicatorsContainer.querySelectorAll(
                    '.education-comments-indicator'
                )
            )
            : [];


    let currentIndex = 0;

    let autoplay = null;


    /* =========================================================
       VISIBLE CARDS
    ========================================================= */

    function getVisibleCards() {

        if (window.innerWidth <= 700) {

            return 1;

        }


        if (window.innerWidth <= 991) {

            return 2;

        }


        return 3;

    }


    /* =========================================================
       MAX INDEX
    ========================================================= */

    function getMaxIndex() {

        return Math.max(
            0,
            cards.length - getVisibleCards()
        );

    }


    /* =========================================================
       CARD STEP
    ========================================================= */

    function getCardStep() {

        const firstCard =
            cards[0];


        if (!firstCard) {

            return 0;

        }


        const cardWidth =
            firstCard.getBoundingClientRect().width;


        const trackStyle =
            window.getComputedStyle(track);


        const gap =
            parseFloat(trackStyle.columnGap)
            ||
            parseFloat(trackStyle.gap)
            ||
            0;


        return cardWidth + gap;

    }


    /* =========================================================
       UPDATE CAROUSEL
    ========================================================= */

    function updateCarousel() {

        const step =
            getCardStep();


        if (!step) {

            return;

        }


        const maxIndex =
            getMaxIndex();


        if (currentIndex > maxIndex) {

            currentIndex =
                maxIndex;

        }


        if (currentIndex < 0) {

            currentIndex = 0;

        }


        /*
        |--------------------------------------------------------------------------
        | IMPORTANT
        |--------------------------------------------------------------------------
        |
        | الاتجاه LTR يعني أن البطاقات التالية تقع إلى اليسار،
        | لذلك يجب أن تكون قيمة translate سالبة.
        |
        */

        const offset =
            currentIndex * step;


        track.style.transform =
            `translate3d(-${offset}px, 0, 0)`;


        /* =====================================================
           INDICATORS
        ====================================================== */

        indicators.forEach(
            function (indicator, index) {

                indicator.classList.toggle(
                    'active',
                    index === currentIndex
                );

            }
        );


        /* =====================================================
           BUTTON STATES
        ====================================================== */

        if (previousButton) {

            previousButton.disabled =
                currentIndex === 0;

        }


        if (nextButton) {

            nextButton.disabled =
                currentIndex >= maxIndex;

        }

    }


    /* =========================================================
       NEXT
    ========================================================= */

    function nextSlide() {

        const maxIndex =
            getMaxIndex();


        if (currentIndex >= maxIndex) {

            currentIndex = 0;

        } else {

            currentIndex++;

        }


        updateCarousel();

    }


    /* =========================================================
       PREVIOUS
    ========================================================= */

    function previousSlide() {

        const maxIndex =
            getMaxIndex();


        if (currentIndex <= 0) {

            currentIndex =
                maxIndex;

        } else {

            currentIndex--;

        }


        updateCarousel();

    }


    /* =========================================================
       NEXT BUTTON
    ========================================================= */

    if (nextButton) {

        nextButton.addEventListener(
            'click',
            function () {

                nextSlide();

                restartAutoplay();

            }
        );

    }


    /* =========================================================
       PREVIOUS BUTTON
    ========================================================= */

    if (previousButton) {

        previousButton.addEventListener(
            'click',
            function () {

                previousSlide();

                restartAutoplay();

            }
        );

    }


    /* =========================================================
       INDICATORS
    ========================================================= */

    indicators.forEach(
        function (indicator) {

            indicator.addEventListener(
                'click',
                function () {

                    const index =
                        parseInt(
                            indicator.dataset.slide,
                            10
                        );


                    if (
                        Number.isNaN(index)
                    ) {

                        return;

                    }


                    const maxIndex =
                        getMaxIndex();


                    currentIndex =
                        Math.min(
                            index,
                            maxIndex
                        );


                    updateCarousel();

                    restartAutoplay();

                }
            );

        }
    );


    /* =========================================================
       AUTOPLAY
    ========================================================= */

    function startAutoplay() {

        stopAutoplay();


        autoplay =
            setInterval(
                function () {

                    nextSlide();

                },
                4500
            );

    }


    function stopAutoplay() {

        if (autoplay) {

            clearInterval(
                autoplay
            );

            autoplay = null;

        }

    }


    function restartAutoplay() {

        startAutoplay();

    }


    /* =========================================================
       PAUSE ON HOVER
    ========================================================= */

    carousel.addEventListener(
        'mouseenter',
        stopAutoplay
    );


    carousel.addEventListener(
        'mouseleave',
        startAutoplay
    );


    /* =========================================================
       TOUCH / SWIPE
    ========================================================= */

    let touchStartX = 0;

    let touchEndX = 0;


    carousel.addEventListener(
        'touchstart',
        function (event) {

            if (
                !event.changedTouches.length
            ) {

                return;

            }


            touchStartX =
                event.changedTouches[0].screenX;


            stopAutoplay();

        },
        {
            passive: true
        }
    );


    carousel.addEventListener(
        'touchend',
        function (event) {

            if (
                !event.changedTouches.length
            ) {

                return;

            }


            touchEndX =
                event.changedTouches[0].screenX;


            const distance =
                touchEndX - touchStartX;


            if (
                Math.abs(distance) > 50
            ) {

                if (distance > 0) {

                    previousSlide();

                } else {

                    nextSlide();

                }

            }


            startAutoplay();

        },
        {
            passive: true
        }
    );


    /* =========================================================
       RESIZE
    ========================================================= */

    let resizeTimer = null;


    window.addEventListener(
        'resize',
        function () {

            clearTimeout(
                resizeTimer
            );


            resizeTimer =
                setTimeout(
                    function () {

                        updateCarousel();

                    },
                    100
                );

        }
    );


    /* =========================================================
       INITIALIZE
    ========================================================= */

    updateCarousel();

    startAutoplay();

});

</script>

