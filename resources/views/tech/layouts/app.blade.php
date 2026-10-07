
<!DOCTYPE html>
<html
    lang="{{ app()->getLocale() }}"
    dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"
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


    {{-- ==================================
            BASIC SEO
    =================================== --}}

    <title>Hebah Gift | هبة عبدالوهاب</title>

    <meta
        name="description"
        content="Hebah Gift | الحلول الرقمية وتطوير الويب، وتصميم واجهات المستخدم، والقرآن الكريم واللغة العربية."
    >

    <meta
        name="author"
        content="Hebah Abdelwahab"
    >

    <meta
        name="robots"
        content="index, follow"
    >

    <link
        rel="canonical"
        href="{{ url('/') }}"
    >


    {{-- ==================================
            FAVICON
    =================================== --}}

    <link
        rel="icon"
        type="image/png"
        href="{{ asset('images/logo.png') }}"
    >

    <link
        rel="apple-touch-icon"
        href="{{ asset('images/logo.png') }}"
    >


    {{-- ==================================
            OPEN GRAPH
            SOCIAL SHARING
    =================================== --}}

    <meta
        property="og:type"
        content="website"
    >

    <meta
        property="og:site_name"
        content="Hebah Gift"
    >

    <meta
        property="og:title"
        content="Hebah Gift | هبة عبدالوهاب"
    >

    <meta
        property="og:description"
        content="الحلول الرقمية وتطوير الويب | القرآن الكريم واللغة العربية"
    >

    <meta
        property="og:url"
        content="{{ url('/') }}"
    >

    <meta
        property="og:image"
        content="{{ asset('images/og-image.jpg') }}"
    >

    <meta
        property="og:image:width"
        content="1200"
    >

    <meta
        property="og:image:height"
        content="630"
    >

    <meta
        property="og:image:alt"
        content="Hebah Gift | هبة عبدالوهاب"
    >


    {{-- ==================================
            TWITTER / X CARD
    =================================== --}}

    <meta
        name="twitter:card"
        content="summary_large_image"
    >

    <meta
        name="twitter:title"
        content="Hebah Gift | هبة عبدالوهاب"
    >

    <meta
        name="twitter:description"
        content="الحلول الرقمية وتطوير الويب | القرآن الكريم واللغة العربية"
    >

    <meta
        name="twitter:image"
        content="{{ asset('images/og-image.jpg') }}"
    >


    {{-- ==================================
            GOOGLE FONTS
    =================================== --}}

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
        href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet"
    >


    {{-- ==================================
            FONTAWESOME
    =================================== --}}

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
    >


    {{-- ==================================
            SWIPER
            Must load before custom styles
    =================================== --}}

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    >


    {{-- ==================================
            GLIGHTBOX
    =================================== --}}

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css"
    >


    {{-- ==================================
            MAIN CSS
    =================================== --}}

    <link
        rel="stylesheet"
        href="{{ asset('css/navbar.css') }}"
    >


    <link
        rel="stylesheet"
        href="{{ asset('css/background.css') }}"
    >

    <link
        rel="stylesheet"
        href="{{ asset('css/components.css') }}"
    >

    <link
        rel="stylesheet"
        href="{{ asset('css/animations.css') }}"
    >

    <link
        rel="stylesheet"
        href="{{ asset('css/digital.css') }}"
    >

    <link
        rel="stylesheet"
        href="{{ asset('css/about.css') }}"
    >

    <link
        rel="stylesheet"
        href="{{ asset('css/technologies.css') }}"
    >

    <link
        rel="stylesheet"
        href="{{ asset('css/portfolio.css') }}"
    >

<link
    rel="stylesheet"
    href="{{ asset('css/all-Projects.css') }}"
>

    <link
        rel="stylesheet"
        href="{{ asset('css/uiux.css') }}"
    >

    <link
        rel="stylesheet"
        href="{{ asset('css/process.css') }}"
    >

    <link
        rel="stylesheet"
        href="{{ asset('css/why.css') }}"
    >

    <link
        rel="stylesheet"
        href="{{ asset('css/testimonials.css') }}"
    >

    <link
        rel="stylesheet"
        href="{{ asset('css/contact.css') }}"
    >

    <link
        rel="stylesheet"
        href="{{ asset('css/footer.css') }}"
    >

    <link
        rel="stylesheet"
        href="{{ asset('css/comments.css') }}"
    >

    <link
        rel="stylesheet"
        href="{{ asset('css/main.css') }}"
    >

    <link
        rel="stylesheet"
        href="{{ asset('css/figma-show.css') }}"
    >

    <link
        rel="stylesheet"
        href="{{ asset('css/errors.css') }}"
    >

    <link
        rel="stylesheet"
        href="{{ asset('css/conversations.css') }}"
    >
    
    
    <link
        rel="stylesheet"
        href="{{ asset('css/portal.css') }}"
    >
</head>


<body>

<!-- ==================================
        SCROLL PROGRESS
=================================== -->

<div id="progressBar"></div>


<div class="portal-wrapper">

    {{-- ==================================
            ANIMATED BACKGROUND
    =================================== --}}

    <div class="background">

        {{-- <div class="background" style="display:none"></div> --}}

        <div class="gradient-overlay"></div>

        <div class="blue-glow"></div>

        <div class="gold-glow"></div>

        <div class="light-rays"></div>

        <div
            class="stars"
            id="stars"
        ></div>

        <div
            class="constellation"
            id="constellation"
        ></div>

        <div
            class="shooting-stars"
            id="shootingStars"
        ></div>

    </div>


    <main>

        @yield('content')

    </main>

</div>


<!-- ==================================
        BACK TO TOP
=================================== -->

<button
    id="backToTop"
    class="back-to-top"
>

    <i class="fa-solid fa-arrow-up"></i>

</button>


<!-- ==================================
        JAVASCRIPT
=================================== -->

<script src="{{ asset('js/navbar.js') }}"></script>

<script src="{{ asset('js/portal.js') }}"></script>

{{-- <script src="{{ asset('js/digital.js') }}"></script> --}}

<script src="{{ asset('js/about.js') }}"></script>

{{-- <script src="{{ asset('js/portfolio-slider.js') }}"></script> --}}

<script src="{{ asset('js/uiux.js') }}"></script>

<script src="{{ asset('js/process.js') }}"></script>

<script src="{{ asset('js/contact.js') }}"></script>

<script src="{{ asset('js/technology-slider.js') }}"></script>

<script src="{{ asset('js/main.js') }}"></script>

<script src="{{ asset('js/background.js') }}"></script>


<!-- ==================================
        SWIPER JS
        Must load BEFORE page scripts
=================================== -->

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>


<!-- ==================================
        PAGE SCRIPTS
=================================== -->

@stack('scripts')


<script src="{{ asset('js/testimonials.js') }}"></script>


<!-- ==================================
        GLIGHTBOX JS
=================================== -->

<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>


<script>

    const lightbox = GLightbox({
        selector: '.portfolio-lightbox'
    });

</script>


</body>

</html>

