@extends('education.layouts.app')

@section('title', __('education.forgot_password_page.page_title'))

@section('content')

<div
    class="education-auth-page education-login-page"
    dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}"
>

    {{-- ==================================================
        DECORATIONS
    ================================================== --}}

    <div class="education-auth-decoration education-auth-decoration-one"></div>
    <div class="education-auth-decoration education-auth-decoration-two"></div>


    <div class="education-auth-container education-login-container">


        {{-- ==================================================
            INTRO SIDE
        ================================================== --}}

        <div class="education-auth-intro">

            <div class="education-auth-intro-pattern"></div>


            <div class="education-auth-emblem">

                <i class="fa-solid fa-key"></i>

            </div>


            <span class="education-auth-badge">

                {{ __('education.forgot_password_page.intro.badge') }}

            </span>


            <h1>

                {{ __('education.forgot_password_page.intro.title') }}

                <span>
                    {{ __('education.forgot_password_page.intro.title_highlight') }}
                </span>

            </h1>


            <p>

                {{ __('education.forgot_password_page.intro.description') }}

            </p>


            <div class="education-auth-features">


                <div class="education-auth-feature">

                    <div class="education-auth-feature-icon">

                        <i class="fa-regular fa-envelope"></i>

                    </div>

                    <div>

                        <strong>
                            {{ __('education.forgot_password_page.intro.features.email.title') }}
                        </strong>

                        <span>
                            {{ __('education.forgot_password_page.intro.features.email.description') }}
                        </span>

                    </div>

                </div>


                <div class="education-auth-feature">

                    <div class="education-auth-feature-icon">

                        <i class="fa-solid fa-paper-plane"></i>

                    </div>

                    <div>

                        <strong>
                            {{ __('education.forgot_password_page.intro.features.verify.title') }}
                        </strong>

                        <span>
                            {{ __('education.forgot_password_page.intro.features.verify.description') }}
                        </span>

                    </div>

                </div>


                <div class="education-auth-feature">

                    <div class="education-auth-feature-icon">

                        <i class="fa-solid fa-lock"></i>

                    </div>

                    <div>

                        <strong>
                            {{ __('education.forgot_password_page.intro.features.new_password.title') }}
                        </strong>

                        <span>
                            {{ __('education.forgot_password_page.intro.features.new_password.description') }}
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
            FORGOT PASSWORD CARD
        ================================================== --}}

        <div class="education-auth-card">


         {{-- ==================================================
    TOP BAR
================================================== --}}

<div class="education-auth-topbar">

    {{-- Back to Login --}}

    <a
        href="{{ route('education.login') }}"
        class="education-auth-back">

        <i class="fa-solid fa-arrow-right"></i>

        {{ __('education.forgot_password_page.card.back_to_login') }}

    </a>


    {{-- Language Switcher --}}

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

            {{-- Header --}}

            <div class="education-auth-header">

                <span class="education-auth-small-label">

                    {{ __('education.forgot_password_page.card.small_label') }}

                </span>

                <h2>

                    {{ __('education.forgot_password_page.card.title') }}

                </h2>

                <p>

                    {{ __('education.forgot_password_page.card.description') }}

                </p>

            </div>



            {{-- ==================================================
                SUCCESS MESSAGE
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
                ERRORS
            ================================================== --}}

            @if($errors->any())

                <div class="education-auth-alert">

                    <i class="fa-solid fa-circle-exclamation"></i>

                    <span>

                        {{ $errors->first() }}

                    </span>

                </div>

            @endif



            {{-- ==================================================
                FORM
            ================================================== --}}

            <form
                method="POST"
                action="{{ route('education.password.email') }}"
                class="education-auth-form">

                @csrf


                {{-- Email --}}

                <div class="education-auth-field">

                    <label for="education-forgot-email">

                        {{ __('education.forgot_password_page.fields.email.label') }}

                    </label>


                    <div class="education-auth-input-wrapper">

                        <i
                            class="fa-regular fa-envelope education-auth-input-icon">
                        </i>


                        <input
                            id="education-forgot-email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="education-auth-input @error('email') is-invalid @enderror"
                            required
                            autofocus
                            autocomplete="email"
                            placeholder="{{ __('education.forgot_password_page.fields.email.placeholder') }}">

                    </div>


                    @error('email')

                        <div class="education-auth-error">

                            <i class="fa-solid fa-circle-exclamation"></i>

                            {{ $message }}

                        </div>

                    @enderror

                </div>



                {{-- Submit --}}

                <button
                    type="submit"
                    class="education-auth-submit">

                    <span>
                        {{ __('education.forgot_password_page.actions.send_reset_link') }}
                    </span>

                    <i class="fa-solid fa-paper-plane"></i>

                </button>

            </form>



            {{-- ==================================================
                BACK TO LOGIN
            ================================================== --}}

            <div class="education-auth-register">

                <span>
                    {{ __('education.forgot_password_page.login.question') }}
                </span>


                <a
                    href="{{ route('education.login') }}">

                    {{ __('education.forgot_password_page.login.action') }}

                    <i class="fa-solid fa-arrow-left"></i>

                </a>

            </div>



            {{-- ==================================================
                SECURITY
            ================================================== --}}

            <div class="education-auth-security">

                <i class="fa-solid fa-shield-halved"></i>

                <span>
                    {{ __('education.forgot_password_page.security.message') }}
                </span>

            </div>

        </div>

    </div>

</div>

@endsection
