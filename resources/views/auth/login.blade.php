@extends('layouts.auth')

@section('title', __('digital_studio.auth.login.title'))

@section('content')

<div class="auth-page">

    {{-- =====================================================
                        AUTH NAVBAR
    ====================================================== --}}


    {{-- =====================================================
                        AUTH CONTAINER
    ====================================================== --}}

    <div class="auth-container">

        <div class="auth-card">


            {{-- =================================================
                            HEADER
            ================================================== --}}

            <div class="auth-header">

                <h1>
                    {{ __('digital_studio.auth.login.welcome_back') }}
                </h1>

                <p>
                    {{ __('digital_studio.auth.login.subtitle') }}
                </p>

            </div>


            {{-- =================================================
                        SESSION STATUS
            ================================================== --}}

            @if (session('status'))

                <div class="auth-success">
                    {{ session('status') }}
                </div>

            @endif


            {{-- =================================================
                        GENERAL ERRORS
            ================================================== --}}

            @if ($errors->any())

                <div class="auth-alert">
                    {{ __('digital_studio.auth.login.check_information') }}
                </div>

            @endif


            {{-- =================================================
                        LOGIN FORM
            ================================================== --}}

            <form
                method="POST"
                action="{{ route('login') }}"
                class="auth-form"
            >

                @csrf


                {{-- =============================================
                            EMAIL
                ============================================== --}}

                <div class="auth-field">

                    <label for="email">
                        {{ __('digital_studio.auth.login.email') }}
                    </label>

                    <div class="auth-input-wrapper">

                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="auth-input @error('email') is-invalid @enderror"
                            required
                            autofocus
                            autocomplete="username"
                            placeholder="{{ __('digital_studio.auth.login.email_placeholder') }}"
                        >

                        <i class="fa-regular fa-envelope auth-input-icon"></i>

                    </div>

                    @error('email')

                        <div class="auth-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- =============================================
                            PASSWORD
                ============================================== --}}

                <div class="auth-field">

                    <label for="password">
                        {{ __('digital_studio.auth.login.password') }}
                    </label>

                    <div class="auth-input-wrapper auth-password-wrapper">

                        <input
                            id="password"
                            type="password"
                            name="password"
                            class="auth-input @error('password') is-invalid @enderror"
                            required
                            autocomplete="current-password"
                            placeholder="{{ __('digital_studio.auth.login.password_placeholder') }}"
                        >

                        <i class="fa-solid fa-lock auth-input-icon"></i>

                        <button
                            type="button"
                            class="auth-password-toggle"
                            id="passwordToggle"
                            aria-label="{{ __('digital_studio.auth.login.show_password') }}"
                        >

                            <i class="fa-regular fa-eye"></i>

                        </button>

                    </div>

                    @error('password')

                        <div class="auth-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- =============================================
                        REMEMBER / FORGOT PASSWORD
                ============================================== --}}

                <div class="auth-options">

                    <div class="auth-remember">

                        <input
                            id="remember"
                            type="checkbox"
                            name="remember"
                            value="1"
                        >

                        <label for="remember">
                            {{ __('digital_studio.auth.login.remember_me') }}
                        </label>

                    </div>


                    @if (Route::has('password.request'))

                        <a
                            href="{{ route('password.request') }}"
                            class="auth-link"
                        >

                            {{ __('digital_studio.auth.login.forgot_password') }}

                        </a>

                    @endif

                </div>


                {{-- =============================================
                            SUBMIT BUTTON
                ============================================== --}}

                <button
                    type="submit"
                    class="auth-submit"
                    id="loginButton"
                >

                    <span>
                        {{ __('digital_studio.auth.login.sign_in') }}
                    </span>

                    <i class="fa-solid fa-arrow-right"></i>

                </button>

            </form>


            {{-- =================================================
                        GOOGLE LOGIN DIVIDER
            ================================================== --}}

            <div class="auth-divider">

                <span>
                    {{ __('digital_studio.auth.login.or_continue_with') }}
                </span>

            </div>


            {{-- =================================================
                            GOOGLE LOGIN
            ================================================== --}}

            <a
                href="{{ route('google.redirect') }}"
                class="auth-google-button"
            >

                <span class="auth-google-icon">
                    <i class="fa-brands fa-google"></i>
                </span>

                <span class="auth-google-text">
                    {{ __('digital_studio.auth.login.continue_with_google') }}
                </span>

            </a>


            {{-- =================================================
                            REGISTER DIVIDER
            ================================================== --}}

            <div class="auth-divider">

                <span>
                    {{ __('digital_studio.auth.login.new_to_hebah') }}
                </span>

            </div>


            {{-- =================================================
                            REGISTER
            ================================================== --}}

            @if (Route::has('register'))

                <div class="auth-footer">

                    <p>

                        {{ __('digital_studio.auth.login.no_account') }}

                        <a href="{{ route('register') }}">
                            {{ __('digital_studio.auth.login.create_account') }}
                        </a>

                    </p>

                </div>

            @endif


        </div>

    </div>

</div>

@endsection
