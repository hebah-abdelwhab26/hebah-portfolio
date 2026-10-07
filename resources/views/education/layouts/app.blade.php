
<!DOCTYPE html>

<html
    lang="{{ app()->getLocale() }}"
    dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}"
>

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <title>
        @yield('title', __('education.layout.default_title'))
    </title>

    <meta
        name="description"
        content="@yield(
            'meta_description',
            __('education.layout.default_description')
        )"
    >


    {{-- ==================================================
        GOOGLE FONTS
    ================================================== --}}

    <link
        rel="preconnect"
        href="https://fonts.googleapis.com"
    >

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Cairo:wght@300;400;500;600;700&display=swap"
        rel="stylesheet"
    >


    {{-- ==================================================
        FONT AWESOME
    ================================================== --}}

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    >


    {{-- ==================================================
        EDUCATION NAVBAR
    ================================================== --}}
<link
    rel="stylesheet"
    href="{{ asset('css/education/education-navbar.css') }}?v={{ filemtime(public_path('css/education/education-navbar.css')) }}"
>

    {{-- ==================================================
        EDUCATION HERO
    ================================================== --}}

    <link
        rel="stylesheet"
        href="{{ asset('css/education/education-hero.css') }}"
    >


    {{-- ==================================================
        EDUCATION ABOUT
    ================================================== --}}

    <link
        rel="stylesheet"
        href="{{ asset('css/education/education-about.css') }}"
    >


    {{-- ==================================================
        EDUCATION SCHEDULE
    ================================================== --}}

    <link
        rel="stylesheet"
        href="{{ asset('css/education/education-schedule.css') }}"
    >


    {{-- ==================================================
        OWL CAROUSEL
    ================================================== --}}

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
    >

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
    >


    {{-- ==================================================
        EDUCATION SERVICES
    ================================================== --}}

    <link
        rel="stylesheet"
        href="{{ asset('css/education/services.css') }}"
    >


    {{-- ==================================================
        EDUCATION RESOURCES
    ================================================== --}}

    <link
        rel="stylesheet"
        href="{{ asset('css/education/education-resources.css') }}"
    >



    {{-- ==================================================
        EDUCATION FOOTER
    ================================================== --}}

    <link
        rel="stylesheet"
        href="{{ asset('css/education/education-footer.css') }}"
    >


    {{-- ==================================================
        EDUCATION AUTH
    ================================================== --}}

    <link
        rel="stylesheet"
        href="{{ asset('css/education/education-auth.css') }}"
    >


    {{-- ==================================================
        EDUCATION DASHBOARD
    ================================================== --}}

    <link
        rel="stylesheet"
        href="{{ asset('css/education/education-dashboard.css') }}"
    >


    {{-- ==================================================
        STUDENT BOOKING SHOW
    ================================================== --}}

    <link
        rel="stylesheet"
        href="{{ asset('css/education/student-booking-show.css') }}"
    >

<link
    rel="stylesheet"
    href="{{ asset('css/education/education-contact.css') }}?v={{ filemtime(public_path('css/education/education-contact.css')) }}"
>
    {{-- =========================================================
        INTERACTIVE EDUCATION BACKGROUND
    ========================================================= --}}

    <style>

        /* =========================================================
           PAGE BASE
        ========================================================= */

        html,
        body {

            margin: 0;

            padding: 0;

            min-height: 100%;

        }
/* =========================================================
   GLOBAL BOX SIZING
========================================================= */

html {
    width: 100%;
    max-width: 100%;
    overflow-x: hidden;
}

body {
    width: 100%;
    max-width: 100%;
    overflow-x: hidden;
}

*,
*::before,
*::after {
    box-sizing: border-box;
}

        body.education-page {

            position: relative;

            overflow-x: hidden;

            background:
                #f8f4e9;

            color: #30372a;

        }


        /* =========================================================
           INTERACTIVE BACKGROUND
           لون الخلفية متباين مع الزيتوني والذهبي
        ========================================================= */

        .education-interactive-background {

            position: fixed;

            inset: 0;

            width: 100%;

            height: 100%;

            overflow: hidden;

            pointer-events: none;

            z-index: 0;

            background:

                radial-gradient(
                    circle at 10% 15%,
                    rgba(35, 93, 112, .18),
                    transparent 30%
                ),

                radial-gradient(
                    circle at 90% 20%,
                    rgba(52, 116, 135, .16),
                    transparent 32%
                ),

                radial-gradient(
                    circle at 50% 90%,
                    rgba(31, 82, 99, .13),
                    transparent 35%
                ),

                linear-gradient(
                    135deg,
                    #f7f3e8 0%,
                    #f3f0e5 48%,
                    #eef2ef 100%
                );

        }


        /* =========================================================
           BACKGROUND ORBS
        ========================================================= */

        .education-background-orb {

            position: absolute;

            border-radius: 50%;

            filter: blur(1px);

            opacity: .7;

            will-change: transform;

        }


        .education-background-orb-1 {

            width: 380px;

            height: 380px;

            top: -120px;

            right: -90px;

            background:

                radial-gradient(
                    circle,
                    rgba(34, 99, 120, .22) 0%,
                    rgba(34, 99, 120, .09) 42%,
                    transparent 72%
                );

            animation:
                educationOrbOne 18s ease-in-out infinite alternate;

        }


        .education-background-orb-2 {

            width: 450px;

            height: 450px;

            bottom: -200px;

            left: -150px;

            background:

                radial-gradient(
                    circle,
                    rgba(45, 106, 125, .18) 0%,
                    rgba(45, 106, 125, .07) 45%,
                    transparent 72%
                );

            animation:
                educationOrbTwo 22s ease-in-out infinite alternate;

        }


        .education-background-orb-3 {

            width: 240px;

            height: 240px;

            top: 42%;

            left: 42%;

            background:

                radial-gradient(
                    circle,
                    rgba(154, 123, 47, .12) 0%,
                    rgba(154, 123, 47, .04) 35%,
                    transparent 70%
                );

            animation:
                educationOrbThree 16s ease-in-out infinite alternate;

        }


        /* =========================================================
           SOFT GRID
        ========================================================= */

        .education-background-grid {

            position: absolute;

            inset: 0;

            opacity: .22;

            background-image:

                linear-gradient(
                    rgba(35, 93, 112, .055) 1px,
                    transparent 1px
                ),

                linear-gradient(
                    90deg,
                    rgba(35, 93, 112, .055) 1px,
                    transparent 1px
                );

            background-size:
                55px 55px;

            mask-image:

                radial-gradient(
                    ellipse at center,
                    black 0%,
                    rgba(0, 0, 0, .72) 45%,
                    transparent 85%
                );

            -webkit-mask-image:

                radial-gradient(
                    ellipse at center,
                    black 0%,
                    rgba(0, 0, 0, .72) 45%,
                    transparent 85%
                );

        }


        /* =========================================================
           SMALL PARTICLES
        ========================================================= */

        .education-background-particles {

            position: absolute;

            inset: 0;

            background-image:

                radial-gradient(
                    circle,
                    rgba(35, 93, 112, .32) 1px,
                    transparent 1.5px
                );

            background-size:
                75px 75px;

            opacity: .16;

            animation:
                educationParticles 35s linear infinite;

        }


        /* =========================================================
           MOUSE GLOW
        ========================================================= */

        .education-background-glow {

            position: absolute;

            width: 300px;

            height: 300px;

            margin-left: -150px;

            margin-top: -150px;

            border-radius: 50%;

            background:

                radial-gradient(
                    circle,
                    rgba(35, 93, 112, .14) 0%,
                    rgba(35, 93, 112, .055) 35%,
                    transparent 70%
                );

            opacity: 0;

            transition:
                opacity .5s ease;

        }


        body.education-page.education-background-active
        .education-background-glow {

            opacity: 1;

        }


        /* =========================================================
           KEYFRAMES
        ========================================================= */

        @keyframes educationOrbOne {

            0% {

                transform:
                    translate3d(0, 0, 0)
                    scale(1);

            }

            50% {

                transform:
                    translate3d(-55px, 45px, 0)
                    scale(1.08);

            }

            100% {

                transform:
                    translate3d(-15px, 90px, 0)
                    scale(.96);

            }

        }


        @keyframes educationOrbTwo {

            0% {

                transform:
                    translate3d(0, 0, 0)
                    scale(1);

            }

            50% {

                transform:
                    translate3d(60px, -45px, 0)
                    scale(1.07);

            }

            100% {

                transform:
                    translate3d(15px, -80px, 0)
                    scale(.95);

            }

        }


        @keyframes educationOrbThree {

            0% {

                transform:
                    translate3d(0, 0, 0)
                    scale(.9);

                opacity: .35;

            }

            50% {

                transform:
                    translate3d(35px, -25px, 0)
                    scale(1.08);

                opacity: .55;

            }

            100% {

                transform:
                    translate3d(-30px, 30px, 0)
                    scale(.95);

                opacity: .35;

            }

        }


        @keyframes educationParticles {

            from {

                transform:
                    translate3d(0, 0, 0);

            }

            to {

                transform:
                    translate3d(75px, 75px, 0);

            }

        }


        /* =========================================================
           CONTENT ABOVE BACKGROUND
        ========================================================= */

        .education-wrapper {

            position: relative;

            z-index: 1;

            min-height: 100vh;

        }


        .education-main {

            position: relative;

            z-index: 1;

        }


        .education-header,

        .education-footer {

            position: relative;

            z-index: 2;

        }


        /* =========================================================
           REDUCED MOTION
        ========================================================= */

        @media (prefers-reduced-motion: reduce) {

            .education-background-orb,
            .education-background-particles {

                animation: none !important;

            }

            .education-background-glow {

                display: none;

            }

        }

    </style>


    {{-- ==================================================
        PAGE SPECIFIC STYLES
    ================================================== --}}

    @stack('styles')

</head>


<body class="education-page">


    {{-- =========================================================
        INTERACTIVE BACKGROUND
    ========================================================= --}}

    <div
        class="education-interactive-background"
        aria-hidden="true"
    >

        <div
            class="education-background-grid"
        ></div>


        <div
            class="education-background-particles"
        ></div>


        <div
            class="education-background-orb education-background-orb-1"
        ></div>


        <div
            class="education-background-orb education-background-orb-2"
        ></div>


        <div
            class="education-background-orb education-background-orb-3"
        ></div>


        <div
            class="education-background-glow"
            id="educationBackgroundGlow"
        ></div>

    </div>


    {{-- ==================================================
        PAGE WRAPPER
    ================================================== --}}

    <div class="education-wrapper">


        {{-- ==================================================
            HEADER
        ================================================== --}}

        <header class="education-header">

            @yield('header')

        </header>


        {{-- ==================================================
            MAIN CONTENT
        ================================================== --}}

        <main class="education-main">

            @yield('content')

        </main>


        {{-- ==================================================
            FOOTER
        ================================================== --}}

        <footer class="education-footer">

            @yield('footer')

        </footer>


    </div>


    {{-- ==================================================
        FOOTER PARTIAL
    ================================================== --}}

    @include('education.layouts.footer')


    {{-- ==================================================
        JQUERY
    ================================================== --}}

    <script
        src="https://code.jquery.com/jquery-3.7.1.min.js"
    ></script>


    {{-- ==================================================
        OWL CAROUSEL
    ================================================== --}}

    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
    ></script>


    {{-- ==================================================
        EDUCATION NAVBAR
    ================================================== --}}

    <script
        src="{{ asset('js/education/education-navbar.js') }}"
    ></script>


    {{-- ==================================================
        EDUCATION SERVICES
    ================================================== --}}

    <script
        src="{{ asset('js/education/service.js') }}"
    ></script>

    <script
        src="{{ asset('js/education/services.js') }}"
    ></script>


    {{-- ==================================================
        EDUCATION SCHEDULE
    ================================================== --}}

    <script
        src="{{ asset('js/education/education-schedule.js') }}"
    ></script>


    {{-- ==================================================
        EDUCATION RESOURCES
    ================================================== --}}

    <script
        src="{{ asset('js/education/education-resources.js') }}"
    ></script>


    {{-- ==================================================
        EDUCATION CONTACT
    ================================================== --}}

    <script
        src="{{ asset('js/education/education-contact.js') }}"
    ></script>


    {{-- ==================================================
        EDUCATION AUTH
    ================================================== --}}

    <script
        src="{{ asset('js/education/education-auth.js') }}"
    ></script>


    {{-- =========================================================
        INTERACTIVE BACKGROUND SCRIPT
    ========================================================= --}}

    <script>

        document.addEventListener(
            'DOMContentLoaded',
            function () {

                const backgroundGlow =
                    document.getElementById(
                        'educationBackgroundGlow'
                    );


                if (!backgroundGlow) {

                    return;

                }


                let mouseX = 50;

                let mouseY = 50;

                let currentX = 50;

                let currentY = 50;


                document.addEventListener(
                    'mousemove',
                    function (event) {

                        mouseX =
                            (event.clientX /
                                window.innerWidth) *
                            100;

                        mouseY =
                            (event.clientY /
                                window.innerHeight) *
                            100;

                        document.body.classList.add(
                            'education-background-active'
                        );

                    },
                    {
                        passive: true
                    }
                );


                function animateBackgroundGlow() {

                    currentX +=
                        (mouseX - currentX) * .045;

                    currentY +=
                        (mouseY - currentY) * .045;


                    backgroundGlow.style.left =
                        currentX + '%';

                    backgroundGlow.style.top =
                        currentY + '%';


                    window.requestAnimationFrame(
                        animateBackgroundGlow
                    );

                }


                animateBackgroundGlow();

            }
        );

    </script>


    {{-- ==================================================
        PAGE SPECIFIC SCRIPTS
    ================================================== --}}

    @stack('scripts')


    {{-- =========================================================
        BACK TO TOP BUTTON
    ========================================================= --}}

    <button
        type="button"
        class="education-back-to-top"
        id="educationBackToTop"
        aria-label="{{ __('education.layout.back_to_top') }}"
        title="{{ __('education.layout.back_to_top_title') }}"
    >

        <i class="fa-solid fa-arrow-up"></i>

    </button>


    {{-- =========================================================
        BACK TO TOP STYLES
    ========================================================= --}}

<style>

    /*==================================================
                    EDUCATION BACK TO TOP
    ==================================================*/

    .education-back-to-top {

        position: fixed;

        left: 24px;

        bottom: 24px;

        width: 50px;

        height: 50px;

        display: flex;

        align-items: center;

        justify-content: center;

        padding: 0;

        border:
            1px solid
            rgba(178, 141, 76, .35);

        border-radius: 50%;

        background: #235d70;

        color: #d4b16c;

        box-shadow:
            0 10px 30px
            rgba(35, 93, 112, .22);

        backdrop-filter: blur(10px);

        -webkit-backdrop-filter: blur(10px);

        cursor: pointer;

        opacity: 0;

        visibility: hidden;

        transform:
            translateY(20px);

        transition:
            opacity .3s ease,
            visibility .3s ease,
            transform .3s ease,
            background .25s ease,
            color .25s ease,
            border-color .25s ease,
            box-shadow .25s ease;

        z-index: 9999;

    }


    /*==================================================
                    SHOW BUTTON
    ==================================================*/

    .education-back-to-top.show {

        opacity: 1;

        visibility: visible;

        transform:
            translateY(0);

    }


    /*==================================================
                    ARROW
    ==================================================*/

    .education-back-to-top i {

        color: #d4b16c;

        font-size: 17px;

        transition:
            transform .25s ease,
            color .25s ease;

    }


    /*==================================================
                    HOVER
    ==================================================*/

    .education-back-to-top:hover {

        background: #d4b16c;

        color: #235d70;

        border-color: #d4b16c;

        box-shadow:
            0 14px 35px
            rgba(178, 141, 76, .30);

        transform:
            translateY(-4px);

    }


    .education-back-to-top:hover i {

        color: #235d70;

        transform:
            translateY(-2px);

    }


    /*==================================================
                    ACTIVE
    ==================================================*/

    .education-back-to-top:active {

        transform:
            translateY(-1px);

    }


    /*==================================================
                    MOBILE
    ==================================================*/

    @media (max-width: 700px) {

        .education-back-to-top {

            left: 16px;

            bottom: 16px;

            width: 46px;

            height: 46px;

        }


        .education-back-to-top i {

            font-size: 15px;

        }

    }


    /*==================================================
                    REDUCED MOTION
    ==================================================*/

    @media (prefers-reduced-motion: reduce) {

        .education-back-to-top {

            transition: none;

        }

    }

</style>


    {{-- =========================================================
        BACK TO TOP SCRIPT
    ========================================================= --}}

    <script>

        document.addEventListener(
            'DOMContentLoaded',
            function () {

                const backToTop =
                    document.getElementById(
                        'educationBackToTop'
                    );


                if (!backToTop) {

                    return;

                }


                function toggleBackToTop() {

                    if (window.scrollY > 350) {

                        backToTop.classList.add(
                            'show'
                        );

                    } else {

                        backToTop.classList.remove(
                            'show'
                        );

                    }

                }


                window.addEventListener(
                    'scroll',
                    toggleBackToTop,
                    {
                        passive: true
                    }
                );


                backToTop.addEventListener(
                    'click',
                    function () {

                        window.scrollTo({

                            top: 0,

                            behavior: 'smooth'

                        });

                    }
                );


                toggleBackToTop();

            }
        );

    </script>


</body>

</html>

