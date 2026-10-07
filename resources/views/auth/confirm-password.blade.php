@extends('layouts.auth')

@section('title', __('digital_studio.auth.confirm_password.title'))

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
                    alt="{{ __('digital_studio.auth.confirm_password.logo_alt') }}">

            </div>

        </div>


        <h1>

            {{ __('digital_studio.auth.confirm_password.heading') }}

        </h1>


        <p>

            {{ __('digital_studio.auth.confirm_password.description') }}

        </p>

    </div>


    <!--==================================================
        FORM
    ==================================================-->

    <form
        method="POST"
        action="{{ route('password.confirm') }}"
        class="auth-form">

        @csrf


        <!--==================================================
            PASSWORD
        ==================================================-->

        <div class="auth-field">

            <label for="password">

                {{ __('digital_studio.auth.confirm_password.password') }}

            </label>


            <div class="auth-input-wrapper auth-password-wrapper">

                <input
                    id="password"
                    type="password"
                    name="password"
                    class="auth-input @error('password') is-invalid @enderror"
                    required
                    autocomplete="current-password"
                    placeholder="{{ __('digital_studio.auth.confirm_password.password_placeholder') }}">


                <i class="fa-solid fa-lock auth-input-icon"></i>


                <button
                    type="button"
                    class="auth-password-toggle"
                    data-target="password"
                    aria-label="{{ __('digital_studio.auth.confirm_password.show_password') }}">

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
            ACTION
        ==================================================-->

        <div class="auth-actions">

            <button
                type="submit"
                class="auth-submit">

                <span>

                    {{ __('digital_studio.auth.confirm_password.confirm') }}

                </span>

                <i class="fa-solid fa-check"></i>

            </button>

        </div>


    </form>

</div>


</div>

@endsection
