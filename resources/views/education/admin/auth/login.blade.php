<!DOCTYPE html>

<html
    lang="{{ app()->getLocale() }}"
    dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}">

    <title>
        {{ __('education_admin.admin_auth.page_title') }}
    </title>

    <link
        rel="preconnect"
        href="https://fonts.googleapis.com">

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Cairo:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <link
        rel="stylesheet"
        href="{{ asset('css/education/admin/education-admin-login.css') }}">

</head>

<body class="education-admin-login-page">

<!--==================================================
    BACKGROUND
==================================================-->

<div class="education-admin-login-background">

    <div class="education-admin-glow glow-one"></div>

    <div class="education-admin-glow glow-two"></div>

    <div class="education-admin-pattern"></div>

</div>



<!--==================================================
    LOGIN WRAPPER
==================================================-->

<main class="education-admin-login-wrapper">


    <!--==================================================
        LOGIN CARD
    ==================================================-->

    <section class="education-admin-login-card">


        <!--==================================================
            BRAND
        ==================================================-->

        <div class="education-admin-login-brand">


            <div class="education-admin-login-logo">

                <i class="fa-solid fa-book-quran"></i>

            </div>


            <div class="education-admin-login-brand-text">

                <span class="education-admin-brand-name">
                    {{ __('education_admin.admin_auth.brand_name') }}
                </span>

                <span class="education-admin-brand-subtitle">
                    {{ __('education_admin.admin_auth.brand_subtitle') }}
                </span>

            </div>

        </div>



        <!--==================================================
            HEADER
        ==================================================-->

        <div class="education-admin-login-header">

            <span class="education-admin-login-badge">

                <i class="fa-solid fa-shield-halved"></i>

                {{ __('education_admin.admin_auth.admin_panel') }}

            </span>


            <h1>
                {{ __('education_admin.admin_auth.welcome') }}
            </h1>


            <p>
                {{ __('education_admin.admin_auth.description') }}
            </p>

        </div>



        <!--==================================================
            ERRORS
        ==================================================-->

        @if ($errors->any())

            <div class="education-admin-login-errors">

                <div class="education-admin-error-icon">

                    <i class="fa-solid fa-circle-exclamation"></i>

                </div>


                <div class="education-admin-error-content">

                    @foreach ($errors->all() as $error)

                        <p>
                            {{ $error }}
                        </p>

                    @endforeach

                </div>

            </div>

        @endif



        <!--==================================================
            LOGIN FORM
        ==================================================-->

        <form
            action="{{ route('education.admin.login.store') }}"
            method="POST"
            class="education-admin-login-form">

            @csrf



            <!--==================================================
                EMAIL
            ==================================================-->

            <div class="education-admin-form-group">

                <label
                    for="email">

                    {{ __('education_admin.admin_auth.email') }}

                </label>


                <div class="education-admin-input-wrapper">

                    <i class="fa-regular fa-envelope"></i>


                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="{{ __('education_admin.admin_auth.email_placeholder') }}"
                        autocomplete="email"
                        required>

                </div>

            </div>



            <!--==================================================
                PASSWORD
            ==================================================-->

            <div class="education-admin-form-group">

                <div class="education-admin-label-row">

                    <label
                        for="password">

                        {{ __('education_admin.admin_auth.password') }}

                    </label>

                </div>


                <div class="education-admin-input-wrapper">

                    <i class="fa-solid fa-lock"></i>


                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="{{ __('education_admin.admin_auth.password_placeholder') }}"
                        autocomplete="current-password"
                        required>


                    <button
                        type="button"
                        class="education-admin-password-toggle"
                        id="educationAdminPasswordToggle"
                        aria-label="{{ __('education_admin.admin_auth.show_password') }}">

                        <i class="fa-regular fa-eye"></i>

                    </button>

                </div>

            </div>



            <!--==================================================
                OPTIONS
            ==================================================-->

            <div class="education-admin-login-options">


                <label class="education-admin-remember">

                    <input
                        type="checkbox"
                        name="remember"
                        value="1"
                        {{ old('remember') ? 'checked' : '' }}>

                    <span class="education-admin-custom-checkbox">

                        <i class="fa-solid fa-check"></i>

                    </span>

                    <span>
                        {{ __('education_admin.admin_auth.remember_me') }}
                    </span>

                </label>


            </div>



            <!--==================================================
                SUBMIT
            ==================================================-->

            <button
                type="submit"
                class="education-admin-login-submit">

                <span>
                    {{ __('education_admin.admin_auth.login') }}
                </span>

                <i class="fa-solid fa-arrow-left"></i>

            </button>


        </form>



        <!--==================================================
            FOOTER
        ==================================================-->

        <div class="education-admin-login-footer">

            <a
                href="{{ route('education.index') }}">

                <i class="fa-solid fa-arrow-right"></i>

                {{ __('education_admin.admin_auth.back_to_education') }}

            </a>

        </div>


    </section>



    <!--==================================================
        COPYRIGHT
    ==================================================-->

    <p class="education-admin-login-copyright">

        © {{ date('Y') }} {{ __('education_admin.admin_auth.brand_name') }}.
        {{ __('education_admin.admin_auth.all_rights_reserved') }}

    </p>


</main>



<!--==================================================
    PASSWORD SCRIPT
==================================================-->

<script>

    document.addEventListener(
        'DOMContentLoaded',
        function () {

            const toggle =
                document.getElementById(
                    'educationAdminPasswordToggle'
                );

            const password =
                document.getElementById(
                    'password'
                );


            if (!toggle || !password) {
                return;
            }


            toggle.addEventListener(
                'click',
                function () {

                    const isPassword =
                        password.type === 'password';


                    password.type =
                        isPassword
                            ? 'text'
                            : 'password';


                    const icon =
                        toggle.querySelector('i');


                    if (icon) {

                        icon.classList.toggle(
                            'fa-eye',
                            !isPassword
                        );

                        icon.classList.toggle(
                            'fa-eye-slash',
                            isPassword
                        );

                    }

                    toggle.setAttribute(
                        'aria-label',
                        isPassword
                            ? @json(__('education_admin.admin_auth.hide_password'))
                            : @json(__('education_admin.admin_auth.show_password'))
                    );

                }
            );

        }
    );

</script>

</body>

</html>
