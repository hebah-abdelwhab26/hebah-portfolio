<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Hebah Academy')</title>

    <!--==================================================
                        GOOGLE FONTS
    ==================================================-->

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&family=Amiri:wght@400;700&display=swap" rel="stylesheet">

    <!--==================================================
                        FONT AWESOME
    ==================================================-->

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <!--==================================================
                    DESIGN SYSTEM
    ==================================================-->

    <link rel="stylesheet" href="{{ asset('css/shared/variables.css') }}">

    <link rel="stylesheet" href="{{ asset('css/shared/base.css') }}">

    <link rel="stylesheet" href="{{ asset('css/shared/layout.css') }}">

    <link rel="stylesheet" href="{{ asset('css/shared/typography.css') }}">

    <link rel="stylesheet" href="{{ asset('css/shared/components.css') }}">

    <link rel="stylesheet" href="{{ asset('css/shared/buttons.css') }}">

    <link rel="stylesheet" href="{{ asset('css/shared/glass.css') }}">

    <link rel="stylesheet" href="{{ asset('css/shared/utilities.css') }}">

    <link rel="stylesheet" href="{{ asset('css/shared/animations.css') }}">

    <link rel="stylesheet" href="{{ asset('css/shared/responsive.css') }}">

    <!--==================================================
                    ACADEMY SECTIONS
    ==================================================-->

    <link rel="stylesheet" href="{{ asset('css/academy/navbar.css') }}">

    <link rel="stylesheet" href="{{ asset('css/academy/hero.css') }}">

    <link rel="stylesheet" href="{{ asset('css/academy/about.css') }}">

    <link rel="stylesheet" href="{{ asset('css/academy/programs.css') }}">

    <link rel="stylesheet" href="{{ asset('css/academy/learning.css') }}">

    <link rel="stylesheet" href="{{ asset('css/academy/statistics.css') }}">

    <link rel="stylesheet" href="{{ asset('css/academy/testimonials.css') }}">

    <link rel="stylesheet" href="{{ asset('css/academy/contact.css') }}">

    <link rel="stylesheet" href="{{ asset('css/academy/footer.css') }}">

</head>

<body>

    {{--==============================
            NAVBAR
    ==============================--}}

    @include('academy.partials.navbar')

    <main>

        @yield('content')

    </main>

    {{--==============================
            FOOTER
    ==============================--}}

    @include('academy.partials.footer')

    <!--==================================================
                    JAVASCRIPT
    ==================================================-->

    <script defer src="{{ asset('js/academy/utils.js') }}"></script>

    <script defer src="{{ asset('js/academy/navbar.js') }}"></script>

    <script defer src="{{ asset('js/academy/hero.js') }}"></script>

    <script defer src="{{ asset('js/academy/programs.js') }}"></script>

    <script defer src="{{ asset('js/academy/statistics.js') }}"></script>

    <script defer src="{{ asset('js/academy/animations.js') }}"></script>

    <script defer src="{{ asset('js/academy/main.js') }}"></script>

</body>

</html>
