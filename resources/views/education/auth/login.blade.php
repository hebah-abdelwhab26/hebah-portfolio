@extends('education.layouts.app')

@section('title', __('education.login_page.page_title'))

@section('content')

<div
    class="education-auth-page education-login-page"
    dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}"
>

    <div class="education-auth-decoration education-auth-decoration-one"></div>
    <div class="education-auth-decoration education-auth-decoration-two"></div>


    <div class="education-auth-container education-login-container">


        {{-- ==================================================
            INTRO SIDE
        ================================================== --}}

        <div class="education-auth-intro">

            <div class="education-auth-intro-pattern"></div>


            <div class="education-auth-emblem">

                <i class="fa-solid fa-book-quran"></i>

            </div>


            <span class="education-auth-badge">

                {{ __('education.login_page.intro.welcome') }}

            </span>


            <h1>

                {{ __('education.login_page.intro.title') }}

                <span>
                    {{ __('education.login_page.intro.title_highlight') }}
                </span>

            </h1>


            <p>

                {{ __('education.login_page.intro.description') }}

            </p>


            <div class="education-auth-features">


                <div class="education-auth-feature">

                    <div class="education-auth-feature-icon">

                        <i class="fa-solid fa-book-open"></i>

                    </div>

                    <div>

                        <strong>
                            {{ __('education.login_page.intro.features.lessons.title') }}
                        </strong>

                        <span>
                            {{ __('education.login_page.intro.features.lessons.description') }}
                        </span>

                    </div>

                </div>


                <div class="education-auth-feature">

                    <div class="education-auth-feature-icon">

                        <i class="fa-regular fa-calendar-days"></i>

                    </div>

                    <div>

                        <strong>
                            {{ __('education.login_page.intro.features.appointments.title') }}
                        </strong>

                        <span>
                            {{ __('education.login_page.intro.features.appointments.description') }}
                        </span>

                    </div>

                </div>


                <div class="education-auth-feature">

                    <div class="education-auth-feature-icon">

                        <i class="fa-regular fa-bell"></i>

                    </div>

                    <div>

                        <strong>
                            {{ __('education.login_page.intro.features.reminders.title') }}
                        </strong>

                        <span>
                            {{ __('education.login_page.intro.features.reminders.description') }}
                        </span>

                    </div>

                </div>


            </div>


            <div class="education-auth-quote">

                <i class="fa-solid fa-quote-right"></i>

                <p>
                    وَقُلْ رَبِّ زِدْنِي عِلْمًا
                </p>

            </div>

        </div>



        {{-- ==================================================
            LOGIN CARD
        ================================================== --}}

        <div class="education-auth-card">

<div class="education-auth-topbar">

    <a
        href="{{ route('education.index') }}"
        class="education-auth-back">

        <i class="fa-solid fa-arrow-right"></i>

        {{ __('education.login_page.card.back_to_site') }}

    </a>


    <a
        href="{{ route(
            'education.language',
            app()->getLocale() === 'ar' ? 'en' : 'ar'
        ) }}"
        class="education-auth-language"
        aria-label="{{ app()->getLocale() === 'ar' ? 'English' : 'العربية' }}">

        <i class="fa-solid fa-language"></i>

        <span>
            {{ app()->getLocale() === 'ar' ? 'English' : 'العربية' }}
        </span>

    </a>

</div>


            <div class="education-auth-header">

                <span class="education-auth-small-label">

                    {{ __('education.login_page.card.welcome') }}

                </span>

                <h2>

                    {{ __('education.login_page.card.title') }}

                </h2>

                <p>

                    {{ __('education.login_page.card.description') }}

                </p>

            </div>


            {{-- ==================================================
                SESSION STATUS
            ================================================== --}}

            @if(session('status'))

                <div class="education-auth-success">

                    <i class="fa-solid fa-circle-check"></i>

                    <span>
                        {{ session('status') }}
                    </span>

                </div>

            @endif


            {{-- ==================================================
                LOGIN ERROR
            ================================================== --}}

            @if($errors->any())

                <div class="education-auth-alert">

                    <i class="fa-solid fa-circle-exclamation"></i>

                    <span>
                        {{ __('education.login_page.validation.invalid_credentials') }}
                    </span>

                </div>

            @endif


            {{-- ==================================================
                LOGIN FORM
            ================================================== --}}

            <form
                method="POST"
                action="{{ route('education.login.store') }}"
                class="education-auth-form">

                @csrf


                {{-- Email / Phone --}}

                <div class="education-auth-field">

                    <label for="education-login">

                        {{ __('education.login_page.fields.login.label') }}

                    </label>


                    <div class="education-auth-input-wrapper">

                        <i
                            class="fa-solid fa-user education-auth-input-icon">
                        </i>


                        <input
                            id="education-login"
                            type="text"
                            name="login"
                            value="{{ old('login') }}"
                            class="education-auth-input @error('login') is-invalid @enderror"
                            required
                            autofocus
                            autocomplete="username"
                            placeholder="{{ __('education.login_page.fields.login.placeholder') }}">

                    </div>


                    @error('login')

                        <div class="education-auth-error">

                            <i class="fa-solid fa-circle-exclamation"></i>

                            {{ $message }}

                        </div>

                    @enderror

                </div>



                {{-- Password --}}

                <div class="education-auth-field">

                    <label for="education-login-password">

                        {{ __('education.login_page.fields.password.label') }}

                    </label>


                    <div class="education-auth-input-wrapper">

                        <i
                            class="fa-solid fa-lock education-auth-input-icon">
                        </i>


                        <input
                            id="education-login-password"
                            type="password"
                            name="password"
                            class="education-auth-input @error('password') is-invalid @enderror"
                            required
                            autocomplete="current-password"
                            placeholder="{{ __('education.login_page.fields.password.placeholder') }}">


                        <button
                            type="button"
                            class="education-auth-password-toggle"
                            data-password-toggle="education-login-password"
                            aria-label="{{ __('education.login_page.fields.password.show') }}"
                            aria-pressed="false">

                            <i class="fa-regular fa-eye"></i>

                        </button>

                    </div>


                    @error('password')

                        <div class="education-auth-error">

                            <i class="fa-solid fa-circle-exclamation"></i>

                            {{ $message }}

                        </div>

                    @enderror

                </div>



                {{-- Remember / Forgot --}}

                <div class="education-login-options">


                    <label
                        for="education-remember"
                        class="education-auth-remember">

                        <input
                            id="education-remember"
                            type="checkbox"
                            name="remember"
                            value="1">

                        <span class="education-auth-checkbox">

                            <i class="fa-solid fa-check"></i>

                        </span>

                        <span>
                            {{ __('education.login_page.options.remember_me') }}
                        </span>

                    </label>


                    <a
                        href="{{ route('education.password.request') }}"
                        class="education-login-forgot">

                        {{ __('education.login_page.options.forgot_password') }}

                    </a>

                </div>



                {{-- Submit --}}

                <button
                    type="submit"
                    class="education-auth-submit">

                    <span>
                        {{ __('education.login_page.actions.login') }}
                    </span>

                    <i class="fa-solid fa-arrow-left"></i>

                </button>

            </form>



            {{-- ==================================================
                GOOGLE LOGIN
            ================================================== --}}

            <div class="education-auth-divider">

                <span>
                    {{ __('education.login_page.google.divider') }}
                </span>

            </div>


            <a
                href="{{ route('education.google.redirect') }}"
                class="education-google-login">

                <span class="education-google-icon">

                    <i class="fa-brands fa-google"></i>

                </span>

                <span>
                    {{ __('education.login_page.google.button') }}
                </span>

            </a>



            {{-- ==================================================
                REGISTER
            ================================================== --}}

            <div class="education-auth-register">

                <span>
                    {{ __('education.login_page.register.question') }}
                </span>


                <a
                    href="{{ route('education.register') }}">

                    {{ __('education.login_page.register.action') }}

                    <i class="fa-solid fa-arrow-left"></i>

                </a>

            </div>



            {{-- ==================================================
                SECURITY
            ================================================== --}}

            <div class="education-auth-security">

                <i class="fa-solid fa-shield-halved"></i>

                <span>
                    {{ __('education.login_page.security.message') }}
                </span>

            </div>

        </div>

    </div>

</div>

@endsection
