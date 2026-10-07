@extends('layouts.auth')

@section('title', __('digital_studio.auth.register.title'))

@section('content')

<div class="auth-page">


<!--==================================
        AUTH CONTAINER
==================================-->

<div class="auth-container auth-register-container">

    <div class="auth-card auth-register-card">


        <!--==================================
                LOGO
        ==================================-->

        <div class="auth-logo">

            <a href="{{ route('portal') }}">

                <div class="auth-logo-icon">

                    <i class="fa-solid fa-code"></i>

                </div>

                <div class="auth-logo-text">

                    <span class="auth-logo-name">

                        Hebah Web

                    </span>

                    <span class="auth-logo-subtitle">

                        Laravel • React Developer

                    </span>

                </div>

            </a>

        </div>


        <!--==================================
                HEADER
        ==================================-->

        <div class="auth-header">

            <h1>

                {{ __('digital_studio.auth.register.create_your_account') }}

            </h1>

            <p>

                {{ __('digital_studio.auth.register.subtitle') }}

            </p>

        </div>


        <!--==================================
                VALIDATION ERRORS
        ==================================-->

        @if($errors->any())

            <div class="auth-alert">

                <i class="fa-solid fa-circle-exclamation"></i>

                <div>

                    @foreach($errors->all() as $error)

                        <div>
                            {{ $error }}
                        </div>

                    @endforeach

                </div>

            </div>

        @endif


        <!--==================================
                REGISTER FORM
        ==================================-->

        <form
            method="POST"
            action="{{ route('register') }}"
            class="auth-form">

            @csrf


            <!--==================================
                    NAME
            ==================================-->

            <div class="auth-field">

                <label for="name">

                    {{ __('digital_studio.auth.register.full_name') }}

                </label>

                <div class="auth-input-wrapper">

                    <i class="fa-regular fa-user auth-input-icon"></i>

                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        autofocus
                        autocomplete="name"
                        placeholder="{{ __('digital_studio.auth.register.full_name_placeholder') }}"
                        class="auth-input @error('name') is-invalid @enderror">

                </div>

                @error('name')

                    <div class="auth-error">

                        {{ $message }}

                    </div>

                @enderror

            </div>


            <!--==================================
                    USERNAME
            ==================================-->

            <div class="auth-field">

                <label for="username">

                    {{ __('digital_studio.auth.register.username') }}

                </label>

                <div class="auth-input-wrapper">

                    <i class="fa-solid fa-at auth-input-icon"></i>

                    <input
                        id="username"
                        type="text"
                        name="username"
                        value="{{ old('username') }}"
                        autocomplete="username"
                        placeholder="{{ __('digital_studio.auth.register.username_placeholder') }}"
                        class="auth-input @error('username') is-invalid @enderror">

                </div>

                @error('username')

                    <div class="auth-error">

                        {{ $message }}

                    </div>

                @enderror

            </div>


            <!--==================================
                    EMAIL
            ==================================-->

            <div class="auth-field">

                <label for="email">

                    {{ __('digital_studio.auth.register.email') }}

                </label>

                <div class="auth-input-wrapper">

                    <i class="fa-regular fa-envelope auth-input-icon"></i>

                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autocomplete="email"
                        placeholder="{{ __('digital_studio.auth.register.email_placeholder') }}"
                        class="auth-input @error('email') is-invalid @enderror">

                </div>

                @error('email')

                    <div class="auth-error">

                        {{ $message }}

                    </div>

                @enderror

            </div>


            <!--==================================
                    PHONE
            ==================================-->

            <div class="auth-field">

                <label for="phone">

                    {{ __('digital_studio.auth.register.phone') }}

                    <span style="opacity:.55;">

                        ({{ __('digital_studio.auth.register.optional') }})

                    </span>

                </label>

                <div class="auth-input-wrapper">

                    <i class="fa-solid fa-phone auth-input-icon"></i>

                    <input
                        id="phone"
                        type="text"
                        name="phone"
                        value="{{ old('phone') }}"
                        autocomplete="tel"
                        placeholder="{{ __('digital_studio.auth.register.phone_placeholder') }}"
                        class="auth-input @error('phone') is-invalid @enderror">

                </div>

                @error('phone')

                    <div class="auth-error">

                        {{ $message }}

                    </div>

                @enderror

            </div>


            <!--==================================
                    PASSWORD
            ==================================-->

            <div class="auth-field">

                <label for="password">

                    {{ __('digital_studio.auth.register.password') }}

                </label>

                <div class="auth-input-wrapper auth-password-wrapper">

                    <i class="fa-solid fa-lock auth-input-icon"></i>

                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="new-password"
                        placeholder="{{ __('digital_studio.auth.register.password_placeholder') }}"
                        class="auth-input @error('password') is-invalid @enderror">

                    <button
                        type="button"
                        class="auth-password-toggle"
                        data-target="password"
                        aria-label="{{ __('digital_studio.auth.register.show_password') }}">

                        <i class="fa-regular fa-eye"></i>

                    </button>

                </div>

                @error('password')

                    <div class="auth-error">

                        {{ $message }}

                    </div>

                @enderror

            </div>


            <!--==================================
                    CONFIRM PASSWORD
            ==================================-->

            <div class="auth-field">

                <label for="password_confirmation">

                    {{ __('digital_studio.auth.register.confirm_password') }}

                </label>

                <div class="auth-input-wrapper auth-password-wrapper">

                    <i class="fa-solid fa-shield-halved auth-input-icon"></i>

                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                        placeholder="{{ __('digital_studio.auth.register.confirm_password_placeholder') }}"
                        class="auth-input">

                    <button
                        type="button"
                        class="auth-password-toggle"
                        data-target="password_confirmation"
                        aria-label="{{ __('digital_studio.auth.register.show_password') }}">

                        <i class="fa-regular fa-eye"></i>

                    </button>

                </div>

            </div>


            <!--==================================
                    TERMS
            ==================================-->

            <div class="auth-options">

                <label class="auth-checkbox">

                    <input
                        type="checkbox"
                        name="terms"
                        value="1"
                        required
                        {{ old('terms') ? 'checked' : '' }}>

                    <span style="color: white">

                        {{ __('digital_studio.auth.register.terms') }}

                    </span>

                </label>

            </div>


            <!--==================================
                    SUBMIT
            ==================================-->

            <button
                type="submit"
                class="auth-submit">

                <span>

                    {{ __('digital_studio.auth.register.create_account') }}

                </span>

                <i class="fa-solid fa-arrow-right"></i>

            </button>

        </form>


        <!--==================================
                GOOGLE REGISTER DIVIDER
        ==================================-->

        <div class="auth-divider">

            <span>

                {{ __('digital_studio.auth.register.or_continue_with') }}

            </span>

        </div>


        <!--==================================
                GOOGLE REGISTER
        ==================================-->

        <a
            href="{{ route('google.redirect') }}"
            class="auth-google-button">

            <span class="auth-google-icon">

                <i class="fa-brands fa-google"></i>

            </span>

            <span class="auth-google-text">

                {{ __('digital_studio.auth.register.continue_with_google') }}

            </span>

        </a>


        <!--==================================
                LOGIN
        ==================================-->

        <div class="auth-divider">

            <span>

                {{ __('digital_studio.auth.register.already_have_account') }}

            </span>

        </div>


        <div class="auth-footer">

            <p>

                <a href="{{ route('login') }}">

                    {{ __('digital_studio.auth.register.sign_in') }}

                </a>

            </p>

        </div>


        <!--==================================
                BACK TO WEBSITE
        ==================================-->

        <div style="text-align:center; margin-top:18px;">

            <a
                href="{{ route('portal') }}"
                class="auth-link">

                <i class="fa-solid fa-arrow-left"></i>

                {{ __('digital_studio.auth.register.back_to_website') }}

            </a>

        </div>

    </div>

</div>

</div>

@endsection
