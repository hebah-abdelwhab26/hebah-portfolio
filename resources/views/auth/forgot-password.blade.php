@extends('layouts.auth')

@section('title', __('digital_studio.auth.forgot_password.title'))

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
                    alt="{{ __('digital_studio.auth.forgot_password.logo_alt') }}">

            </div>

        </div>


        <h1>

            {{ __('digital_studio.auth.forgot_password.heading') }}

        </h1>


        <p>

            {{ __('digital_studio.auth.forgot_password.description') }}

        </p>

    </div>



    <!--==================================================
        SESSION STATUS
    ==================================================-->

    <x-auth-session-status
        class="auth-session-status"
        :status="session('status')"
    />


    @if (session('status'))

        <div class="auth-success-message">

            <div class="auth-success-icon">

                <i class="fa-solid fa-circle-check"></i>

            </div>

            <div class="auth-success-content">

                <strong>

                    {{ __('digital_studio.auth.forgot_password.email_sent') }}

                </strong>

                <span>

                    {{ session('status') }}

                </span>

            </div>

        </div>

    @endif


    <!--==================================================
        FORM
    ==================================================-->

    <form
        method="POST"
        action="{{ route('password.email') }}"
        class="auth-form">

        @csrf


        <!--==================================================
            EMAIL
        ==================================================-->

        <div class="auth-field">

            <label for="email">

                {{ __('digital_studio.auth.forgot_password.email') }}

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
                    autocomplete="email"
                    placeholder="{{ __('digital_studio.auth.forgot_password.email_placeholder') }}">


                <i class="fa-regular fa-envelope auth-input-icon"></i>

            </div>


            @error('email')

                <div class="auth-error">

                    {{ $message }}

                </div>

            @enderror

        </div>



        <!--==================================================
            ACTIONS
        ==================================================-->

        <div class="auth-actions">

            <button
                type="submit"
                class="auth-submit">

                <span>

                    {{ __('digital_studio.auth.forgot_password.send_reset_link') }}

                </span>

                <i class="fa-solid fa-paper-plane"></i>

            </button>

        </div>


    </form>



    <!--==================================================
        BACK TO LOGIN
    ==================================================-->

    <div class="auth-footer">

        <span style="color: white">

            {{ __('digital_studio.auth.forgot_password.remember_password') }}

        </span>

        <a href="{{ route('login') }}">

            {{ __('digital_studio.auth.forgot_password.back_to_login') }}

        </a>

    </div>

</div>


</div>

@endsection
