@extends('layouts.auth')

@section('title', __('digital_studio.auth.reset_password.title'))

@section('content')

<div class="auth-page">

<div class="auth-container">

    <!--==================================================
        AUTH HEADER
    ==================================================-->

    <div class="auth-header">

        <div class="auth-logo">

            <div class="auth-logo-box">

                <img
                    src="{{ asset('images/الشعار.png') }}"
                    alt="{{ __('digital_studio.auth.reset_password.logo_alt') }}">

            </div>

        </div>


        <h1>

            {{ __('digital_studio.auth.reset_password.heading') }}

        </h1>


        <p>

            {{ __('digital_studio.auth.reset_password.description') }}

        </p>

    </div>



    <!--==================================================
        FORM
    ==================================================-->

    <form
        method="POST"
        action="{{ route('password.store') }}"
        class="auth-form">

        @csrf


        <!--==================================================
            PASSWORD RESET TOKEN
        ==================================================-->

        <input
            type="hidden"
            name="token"
            value="{{ $request->route('token') }}">



        <!--==================================================
            EMAIL
        ==================================================-->

        <div class="auth-field">

            <label for="email">

                {{ __('digital_studio.auth.reset_password.email') }}

            </label>


            <div class="auth-input-wrapper">

                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email', $request->email) }}"
                    class="auth-input @error('email') is-invalid @enderror"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="{{ __('digital_studio.auth.reset_password.email_placeholder') }}">


                <i class="fa-regular fa-envelope auth-input-icon"></i>

            </div>


            @error('email')

                <div class="auth-error">

                    {{ $message }}

                </div>

            @enderror

        </div>



        <!--==================================================
            NEW PASSWORD
        ==================================================-->

        <div class="auth-field">

            <label for="password">

                {{ __('digital_studio.auth.reset_password.new_password') }}

            </label>


            <div class="auth-input-wrapper auth-password-wrapper">

                <input
                    id="password"
                    type="password"
                    name="password"
                    class="auth-input @error('password') is-invalid @enderror"
                    required
                    autocomplete="new-password"
                    placeholder="{{ __('digital_studio.auth.reset_password.new_password_placeholder') }}">


                <i class="fa-solid fa-lock auth-input-icon"></i>


                <button
                    type="button"
                    class="auth-password-toggle"
                    data-target="password"
                    aria-label="{{ __('digital_studio.auth.reset_password.show_password') }}"
                    title="{{ __('digital_studio.auth.reset_password.show_password') }}">

                    <i class="fa-regular fa-eye"></i>

                </button>

            </div>


            @error('password')

                <div class="auth-error">

                    {{ $message }}

                </div>

            @enderror

        </div>



        <!--==================================================
            CONFIRM PASSWORD
        ==================================================-->

        <div class="auth-field">

            <label for="password_confirmation">

                {{ __('digital_studio.auth.reset_password.confirm_new_password') }}

            </label>


            <div class="auth-input-wrapper auth-password-wrapper">

                <input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    class="auth-input @error('password_confirmation') is-invalid @enderror"
                    required
                    autocomplete="new-password"
                    placeholder="{{ __('digital_studio.auth.reset_password.confirm_new_password_placeholder') }}">


                <i class="fa-solid fa-lock auth-input-icon"></i>


                <button
                    type="button"
                    class="auth-password-toggle"
                    data-target="password_confirmation"
                    aria-label="{{ __('digital_studio.auth.reset_password.show_password') }}"
                    title="{{ __('digital_studio.auth.reset_password.show_password') }}">

                    <i class="fa-regular fa-eye"></i>

                </button>

            </div>


            @error('password_confirmation')

                <div class="auth-error">

                    {{ $message }}

                </div>

            @enderror

        </div>



        <!--==================================================
            RESET BUTTON
        ==================================================-->

        <div class="auth-actions">

            <button
                type="submit"
                class="auth-submit">

                <span>

                    {{ __('digital_studio.auth.reset_password.reset_password') }}

                </span>

                <i class="fa-solid fa-key"></i>

            </button>

        </div>


    </form>



    <!--==================================================
        BACK TO LOGIN
    ==================================================-->

    <div class="auth-footer">

        <span>

            {{ __('digital_studio.auth.reset_password.remember_password') }}

        </span>

        <a href="{{ route('login') }}">

            {{ __('digital_studio.auth.reset_password.back_to_login') }}

        </a>

    </div>

</div>

</div>

@endsection
