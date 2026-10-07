<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}"
>

<head>

    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <title>
        @yield('title', 'Authentication') | Hebah Web
    </title>


    <!--==================================
                    FONTS
    ==================================-->

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
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >


    <!--==================================
                FONT AWESOME
    ==================================-->

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    >


    <!--==================================
                    AUTH CSS
    ==================================-->

  <link
    rel="stylesheet"
    href="{{ asset('css/auth.css') }}?v={{ filemtime(public_path('css/auth.css')) }}"
>
    @stack('styles')

</head>


<body>

    <main class="auth-page">

        {{-- ================================================
                    SHARED AUTH NAVBAR
        ================================================= --}}

        @include('auth.partials.navbar')


        {{-- ================================================
                    AUTH CONTENT
        ================================================= --}}

        <section class="auth-content">

            @yield('content')

        </section>

    </main>


    @stack('scripts')


    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const passwordToggles =
                document.querySelectorAll('.auth-password-toggle');

            passwordToggles.forEach(function (toggle) {

                toggle.addEventListener('click', function () {

                    const wrapper =
                        toggle.closest('.auth-password-wrapper');

                    if (!wrapper) {
                        return;
                    }

                    const input =
                        wrapper.querySelector('.auth-input');

                    if (!input) {
                        return;
                    }

                    const icon =
                        toggle.querySelector('i');

                    if (input.type === 'password') {

                        input.type = 'text';

                        if (icon) {
                            icon.classList.remove('fa-eye');
                            icon.classList.add('fa-eye-slash');
                        }

                    } else {

                        input.type = 'password';

                        if (icon) {
                            icon.classList.remove('fa-eye-slash');
                            icon.classList.add('fa-eye');
                        }

                    }

                });

            });


            const inputs =
                document.querySelectorAll('.auth-input');

            inputs.forEach(function (input) {

                input.addEventListener('input', function () {

                    input.classList.remove('is-invalid');

                });

            });

        });

    </script>

</body>

</html>