@extends('education.layouts.app')

@section('title', __('education.register_page.page_title'))

@section('content')

<div
    class="education-auth-page education-register-page"
    dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}"
>

    {{-- ==================================================
        DECORATIVE BACKGROUND
    ================================================== --}}

    <div class="education-auth-decoration education-auth-decoration-one"></div>
    <div class="education-auth-decoration education-auth-decoration-two"></div>


    <div class="education-auth-container education-register-container">


        {{-- ==================================================
            INTRO SIDE
        ================================================== --}}

        <div class="education-auth-intro">

            <div class="education-auth-intro-pattern"></div>


            <div class="education-auth-emblem">

                <i class="fa-solid fa-feather-pointed"></i>

            </div>


            <span class="education-auth-badge">

                {{ __('education.register_page.intro.badge') }}

            </span>


            <h1>

                {{ __('education.register_page.intro.title') }}

                <span>
                    {{ __('education.register_page.intro.title_highlight') }}
                </span>

            </h1>


            <p>

                {{ __('education.register_page.intro.description') }}

            </p>


            {{-- ==================================================
                FEATURES
            ================================================== --}}

            <div class="education-auth-features">


                <div class="education-auth-feature">

                    <div class="education-auth-feature-icon">

                        <i class="fa-solid fa-user-graduate"></i>

                    </div>

                    <div>

                        <strong>
                            {{ __('education.register_page.intro.features.account.title') }}
                        </strong>

                        <span>
                            {{ __('education.register_page.intro.features.account.description') }}
                        </span>

                    </div>

                </div>


                <div class="education-auth-feature">

                    <div class="education-auth-feature-icon">

                        <i class="fa-regular fa-calendar-days"></i>

                    </div>

                    <div>

                        <strong>
                            {{ __('education.register_page.intro.features.booking.title') }}
                        </strong>

                        <span>
                            {{ __('education.register_page.intro.features.booking.description') }}
                        </span>

                    </div>

                </div>


                <div class="education-auth-feature">

                    <div class="education-auth-feature-icon">

                        <i class="fa-regular fa-bell"></i>

                    </div>

                    <div>

                        <strong>
                            {{ __('education.register_page.intro.features.reminders.title') }}
                        </strong>

                        <span>
                            {{ __('education.register_page.intro.features.reminders.description') }}
                        </span>

                    </div>

                </div>


            </div>


            {{-- ==================================================
                QUOTE
            ================================================== --}}

            <div class="education-auth-quote">

                <i class="fa-solid fa-quote-right"></i>

                <p>
                    وَقُلْ رَبِّ زِدْنِي عِلْمًا
                </p>

            </div>

        </div>



        {{-- ==================================================
            REGISTER CARD
        ================================================== --}}

        <div class="education-auth-card">


            {{-- ==================================================
                BACK TO LOGIN
            ================================================== --}}
<div class="education-auth-topbar">

    <a
        href="{{ route('education.login') }}"
        class="education-auth-back">

        <i class="fa-solid fa-arrow-right"></i>

        {{ __('education.register_page.card.back_to_login') }}

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


            {{-- ==================================================
                HEADER
            ================================================== --}}

            <div class="education-auth-header">

                <span class="education-auth-small-label">

                    {{ __('education.register_page.card.welcome') }}

                </span>

                <h2>

                    {{ __('education.register_page.card.title') }}

                </h2>

                <p>

                    {{ __('education.register_page.card.description') }}

                </p>

            </div>



            {{-- ==================================================
                VALIDATION
            ================================================== --}}

            @if($errors->any())

                <div class="education-auth-alert">

                    <i class="fa-solid fa-circle-exclamation"></i>

                    <div>

                        {{ __('education.register_page.validation.review') }}

                    </div>

                </div>

            @endif



            {{-- ==================================================
                REGISTER FORM
            ================================================== --}}

            <form
                method="POST"
                action="{{ route('education.register.store') }}"
                class="education-auth-form">

                @csrf



                {{-- ==================================================
                    NAME
                ================================================== --}}

                <div class="education-auth-field">

                    <label for="education-register-name">

                        {{ __('education.register_page.fields.name.label') }}

                    </label>


                    <div class="education-auth-input-wrapper">

                        <i
                            class="fa-regular fa-user education-auth-input-icon">
                        </i>


                        <input
                            id="education-register-name"
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            class="education-auth-input @error('name') is-invalid @enderror"
                            required
                            autofocus
                            autocomplete="name"
                            placeholder="{{ __('education.register_page.fields.name.placeholder') }}">

                    </div>


                    @error('name')

                        <div class="education-auth-error">

                            <i class="fa-solid fa-circle-exclamation"></i>

                            {{ $message }}

                        </div>

                    @enderror

                </div>



                {{-- ==================================================
                    EMAIL
                ================================================== --}}

                <div class="education-auth-field">

                    <label for="education-register-email">

                        {{ __('education.register_page.fields.email.label') }}

                    </label>


                    <div class="education-auth-input-wrapper">

                        <i
                            class="fa-regular fa-envelope education-auth-input-icon">
                        </i>


                        <input
                            id="education-register-email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="education-auth-input @error('email') is-invalid @enderror"
                            required
                            autocomplete="email"
                            placeholder="{{ __('education.register_page.fields.email.placeholder') }}">

                    </div>


                    @error('email')

                        <div class="education-auth-error">

                            <i class="fa-solid fa-circle-exclamation"></i>

                            {{ $message }}

                        </div>

                    @enderror

                </div>



                {{-- ==================================================
                    PASSWORD
                ================================================== --}}

                <div class="education-auth-field">

                    <label for="education-register-password">

                        {{ __('education.register_page.fields.password.label') }}

                    </label>


                    <div class="education-auth-input-wrapper">

                        <i
                            class="fa-solid fa-lock education-auth-input-icon">
                        </i>


                        <input
                            id="education-register-password"
                            type="password"
                            name="password"
                            class="education-auth-input @error('password') is-invalid @enderror"
                            required
                            autocomplete="new-password"
                            placeholder="{{ __('education.register_page.fields.password.placeholder') }}">


                        <button
                            type="button"
                            class="education-auth-password-toggle"
                            data-password-toggle="education-register-password"
                            aria-label="{{ __('education.register_page.fields.password.show') }}"
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



                {{-- ==================================================
                    PASSWORD CONFIRMATION
                ================================================== --}}

                <div class="education-auth-field">

                    <label for="education-register-password-confirmation">

                        {{ __('education.register_page.fields.password_confirmation.label') }}

                    </label>


                    <div class="education-auth-input-wrapper">

                        <i
                            class="fa-solid fa-shield-halved education-auth-input-icon">
                        </i>


                        <input
                            id="education-register-password-confirmation"
                            type="password"
                            name="password_confirmation"
                            class="education-auth-input"
                            required
                            autocomplete="new-password"
                            placeholder="{{ __('education.register_page.fields.password_confirmation.placeholder') }}">


                        <button
                            type="button"
                            class="education-auth-password-toggle"
                            data-password-toggle="education-register-password-confirmation"
                            aria-label="{{ __('education.register_page.fields.password_confirmation.show') }}"
                            aria-pressed="false">

                            <i class="fa-regular fa-eye"></i>

                        </button>

                    </div>


                    @error('password_confirmation')

                        <div class="education-auth-error">

                            <i class="fa-solid fa-circle-exclamation"></i>

                            {{ $message }}

                        </div>

                    @enderror

                </div>



                {{-- ==================================================
                    WHATSAPP NOTE
                ================================================== --}}

                <div class="education-register-whatsapp-note">

                    <div class="education-register-whatsapp-icon">

                        <i class="fa-brands fa-whatsapp"></i>

                    </div>


                    <div>

                        <strong>
                            {{ __('education.register_page.whatsapp.title') }}
                        </strong>

                        <span>

                            {{ __('education.register_page.whatsapp.description') }}

                        </span>

                    </div>

                </div>



                {{-- ==================================================
                    TERMS
                ================================================== --}}

                <label
                    for="education-terms"
                    class="education-auth-remember education-register-terms">

                    <input
                        id="education-terms"
                        type="checkbox"
                        name="terms"
                        value="1"
                        required>


                    <span class="education-auth-checkbox">

                        <i class="fa-solid fa-check"></i>

                    </span>


                    <span>

                        {{ __('education.register_page.terms.agree') }}

                        <a
                            href="#"
                            class="education-register-terms-link">

                            {{ __('education.register_page.terms.usage') }}

                        </a>

                        {{ __('education.register_page.terms.and') }}

                    </span>

                </label>



                {{-- ==================================================
                    SUBMIT
                ================================================== --}}

                <button
                    type="submit"
                    class="education-auth-submit">

                    <span>
                        {{ __('education.register_page.actions.register') }}
                    </span>

                    <i class="fa-solid fa-arrow-left"></i>

                </button>

            </form>



            {{-- ==================================================
                GOOGLE REGISTER / LOGIN
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
                LOGIN
            ================================================== --}}

            <div class="education-auth-register">

                <span>

                    {{ __('education.register_page.login.question') }}

                </span>


                <a
                    href="{{ route('education.login') }}">

                    {{ __('education.register_page.login.action') }}

                    <i class="fa-solid fa-arrow-left"></i>

                </a>

            </div>



            {{-- ==================================================
                SECURITY
            ================================================== --}}

            <div class="education-auth-security">

                <i class="fa-solid fa-shield-halved"></i>

                <span>

                    {{ __('education.register_page.security.message') }}

                </span>

            </div>

        </div>

    </div>

</div>

@endsection
