@extends('education.layouts.app')

@section('title', __('education.auth.reset_password'))

@section('content')

<style>
    /* =========================================================
       EDUCATION AUTH - RESET PASSWORD
    ========================================================= */

    .education-auth-page {
        min-height: calc(100vh - 80px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 110px 20px 60px;
        direction: rtl;
        position: relative;
        overflow: hidden;
    }

    .education-auth-page::before,
    .education-auth-page::after {
        content: "";
        position: absolute;
        border-radius: 50%;
        pointer-events: none;
        z-index: 0;
    }

    .education-auth-page::before {
        width: 420px;
        height: 420px;
        background: rgba(198, 164, 92, 0.10);
        filter: blur(90px);
        top: 5%;
        right: -120px;
    }

    .education-auth-page::after {
        width: 360px;
        height: 360px;
        background: rgba(72, 92, 65, 0.13);
        filter: blur(90px);
        bottom: 0;
        left: -100px;
    }

    .education-auth-container {
        width: 100%;
        max-width: 520px;
        position: relative;
        z-index: 2;
    }

    .education-auth-card {
        position: relative;

        background:
            linear-gradient(
                145deg,
                rgba(255, 252, 244, 0.97),
                rgba(247, 242, 226, 0.95)
            );

        border: 1px solid rgba(181, 148, 76, 0.28);
        border-radius: 28px;

        padding: 42px 38px;

        box-shadow:
            0 25px 70px rgba(39, 44, 34, 0.18),
            0 8px 25px rgba(181, 148, 76, 0.08);

        backdrop-filter: blur(18px);
        -webkit-backdrop-filter: blur(18px);
    }

    .education-auth-icon {
        width: 82px;
        height: 82px;

        margin: 0 auto 24px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 24px;

        background:
            linear-gradient(
                145deg,
                rgba(198, 164, 92, 0.18),
                rgba(72, 92, 65, 0.12)
            );

        border: 1px solid rgba(181, 148, 76, 0.25);

        color: #8d7137;

        box-shadow:
            0 12px 30px rgba(91, 82, 55, 0.10);
    }

    .education-auth-icon svg {
        width: 40px;
        height: 40px;
        stroke-width: 1.7;
    }

    .education-auth-header {
        text-align: center;
        margin-bottom: 32px;
    }

    .education-auth-header h1 {
        margin: 0 0 10px;

        font-family: "Cairo", sans-serif;
        font-size: 28px;
        font-weight: 800;

        color: #303127;

        line-height: 1.5;
    }

    .education-auth-header p {
        margin: 0 auto;

        max-width: 410px;

        font-family: "Cairo", sans-serif;
        font-size: 14px;
        line-height: 2;

        color: #727363;
    }

    .education-auth-alert {
        margin-bottom: 22px;

        padding: 14px 16px;

        border-radius: 14px;

        font-family: "Cairo", sans-serif;
        font-size: 13px;
        line-height: 1.9;
    }

    .education-auth-alert-error {
        background: rgba(150, 70, 55, 0.08);
        border: 1px solid rgba(150, 70, 55, 0.18);
        color: #874b40;
    }

    .education-auth-alert ul {
        margin: 0;
        padding-right: 20px;
    }

    .education-auth-form-group {
        margin-bottom: 22px;
    }

    .education-auth-label {
        display: block;

        margin-bottom: 9px;

        font-family: "Cairo", sans-serif;
        font-size: 14px;
        font-weight: 700;

        color: #3d4035;
    }

    .education-auth-input-wrapper {
        position: relative;
    }

    .education-auth-input-icon {
        position: absolute;

        top: 50%;
        right: 16px;

        transform: translateY(-50%);

        width: 20px;
        height: 20px;

        color: #9b9b8d;

        pointer-events: none;
    }

    .education-auth-input {
        width: 100%;
        height: 54px;

        box-sizing: border-box;

        padding: 0 48px 0 16px;

        border-radius: 15px;

        border: 1px solid rgba(103, 105, 91, 0.20);

        background: rgba(255, 255, 255, 0.72);

        color: #303127;

        font-family: "Cairo", sans-serif;
        font-size: 14px;

        outline: none;

        transition:
            border-color 0.25s ease,
            box-shadow 0.25s ease,
            background 0.25s ease;
    }

    .education-auth-input::placeholder {
        color: #aaa99e;
    }

    .education-auth-input:focus {
        border-color: rgba(181, 148, 76, 0.65);

        background: #fffdf8;

        box-shadow:
            0 0 0 4px rgba(198, 164, 92, 0.10);
    }

    .education-auth-input.is-invalid {
        border-color: rgba(150, 70, 55, 0.55);
    }

    .education-password-toggle {
        position: absolute;

        top: 50%;
        left: 15px;

        transform: translateY(-50%);

        width: 30px;
        height: 30px;

        display: flex;
        align-items: center;
        justify-content: center;

        border: none;
        background: transparent;

        color: #929286;

        cursor: pointer;

        border-radius: 8px;

        transition:
            color 0.2s ease,
            background 0.2s ease;
    }

    .education-password-toggle:hover {
        color: #56664d;
        background: rgba(72, 92, 65, 0.07);
    }

    .education-password-toggle svg {
        width: 18px;
        height: 18px;
    }

    .education-auth-field-error {
        margin-top: 7px;

        font-family: "Cairo", sans-serif;
        font-size: 12px;

        color: #9a5147;
    }

    .education-password-hint {
        margin-top: 8px;

        font-family: "Cairo", sans-serif;
        font-size: 11px;
        line-height: 1.8;

        color: #99998d;
    }

    .education-auth-submit {
        width: 100%;
        min-height: 54px;

        border: none;
        border-radius: 15px;

        cursor: pointer;

        font-family: "Cairo", sans-serif;
        font-size: 15px;
        font-weight: 700;

        color: #fffdf5;

        background:
            linear-gradient(
                135deg,
                #56664d,
                #414d3a
            );

        box-shadow:
            0 12px 25px rgba(62, 76, 55, 0.20);

        transition:
            transform 0.25s ease,
            box-shadow 0.25s ease,
            filter 0.25s ease;
    }

    .education-auth-submit:hover {
        transform: translateY(-2px);

        box-shadow:
            0 16px 32px rgba(62, 76, 55, 0.27);

        filter: brightness(1.05);
    }

    .education-auth-submit:active {
        transform: translateY(0);
    }

    .education-auth-submit-content {
        display: inline-flex;

        align-items: center;
        justify-content: center;

        gap: 9px;
    }

    .education-auth-submit svg {
        width: 19px;
        height: 19px;
    }

    .education-auth-back {
        margin-top: 25px;

        text-align: center;
    }

    .education-auth-back a {
        display: inline-flex;

        align-items: center;
        justify-content: center;

        gap: 7px;

        font-family: "Cairo", sans-serif;
        font-size: 13px;
        font-weight: 700;

        color: #75613b;

        text-decoration: none;

        transition:
            color 0.25s ease,
            transform 0.25s ease;
    }

    .education-auth-back a:hover {
        color: #4f5d47;
        transform: translateX(2px);
    }

    .education-auth-back svg {
        width: 17px;
        height: 17px;
    }

    .education-auth-note {
        margin-top: 24px;

        padding-top: 20px;

        border-top: 1px solid rgba(103, 105, 91, 0.12);

        text-align: center;

        font-family: "Cairo", sans-serif;
        font-size: 11px;
        line-height: 1.9;

        color: #99998d;
    }

    @media (max-width: 600px) {

        .education-auth-page {
            padding: 95px 15px 40px;
        }

        .education-auth-card {
            padding: 32px 22px;
            border-radius: 23px;
        }

        .education-auth-header h1 {
            font-size: 24px;
        }

        .education-auth-header p {
            font-size: 13px;
        }

        .education-auth-icon {
            width: 72px;
            height: 72px;
            border-radius: 21px;
        }

        .education-auth-icon svg {
            width: 34px;
            height: 34px;
        }
    }
</style>

<div class="education-auth-page">

<div class="education-auth-container">

    <div class="education-auth-card">

        {{-- =====================================================
             ICON
        ====================================================== --}}

        <div class="education-auth-icon">

            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
            >

                <rect
                    x="3"
                    y="5"
                    width="18"
                    height="14"
                    rx="2"
                />

                <path d="m3 7 9 6 9-6" />

                <path d="M16 3v4" />

                <path d="M14 5h4" />

            </svg>

        </div>


        {{-- =====================================================
             HEADER
        ====================================================== --}}

        <div class="education-auth-header">

            <h1>
                {{ __('education.auth.reset_password') }}
            </h1>

            <p>
                {{ __('education.auth.reset_password_description') }}
            </p>

        </div>


        {{-- =====================================================
             VALIDATION ERRORS
        ====================================================== --}}

        @if ($errors->any())

            <div class="education-auth-alert education-auth-alert-error">

                <ul>

                    @foreach ($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        {{-- =====================================================
             RESET PASSWORD FORM
        ====================================================== --}}

        <form
            method="POST"
            action="{{ route('education.password.update') }}"
        >

            @csrf


            {{-- =================================================
                 TOKEN
            ================================================== --}}

            <input
                type="hidden"
                name="token"
                value="{{ $token }}"
            >


            {{-- =================================================
                 EMAIL
            ================================================== --}}

            <div class="education-auth-form-group">

                <label
                    for="education-reset-email"
                    class="education-auth-label"
                >
                    {{ __('education.auth.email') }}
                </label>


                <div class="education-auth-input-wrapper">

                    <svg
                        class="education-auth-input-icon"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >

                        <rect
                            x="3"
                            y="5"
                            width="18"
                            height="14"
                            rx="2"
                        />

                        <path d="m3 7 9 6 9-6" />

                    </svg>


                    <input
                        type="email"
                        id="education-reset-email"
                        name="email"
                        value="{{ old('email', $email) }}"
                        class="education-auth-input @error('email') is-invalid @enderror"
                        placeholder="{{ __('education.auth.email_placeholder') }}"
                        autocomplete="email"
                        required
                        autofocus
                    >

                </div>


                @error('email')

                    <div class="education-auth-field-error">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            {{-- =================================================
                 NEW PASSWORD
            ================================================== --}}

            <div class="education-auth-form-group">

                <label
                    for="education-reset-password"
                    class="education-auth-label"
                >
                    {{ __('education.auth.new_password') }}
                </label>


                <div class="education-auth-input-wrapper">

                    <svg
                        class="education-auth-input-icon"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >

                        <rect
                            x="3"
                            y="11"
                            width="18"
                            height="10"
                            rx="2"
                        />

                        <path d="M7 11V7a5 5 0 0 1 10 0v4" />

                    </svg>


                    <input
                        type="password"
                        id="education-reset-password"
                        name="password"
                        class="education-auth-input @error('password') is-invalid @enderror"
                        placeholder="{{ __('education.auth.new_password_placeholder') }}"
                        autocomplete="new-password"
                        required
                    >


                    <button
                        type="button"
                        class="education-password-toggle"
                        onclick="toggleEducationPassword('education-reset-password', this)"
                        aria-label="{{ __('education.auth.show_password') }}"
                    >

                        <svg
                            class="education-password-eye"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >

                            <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z" />

                            <circle
                                cx="12"
                                cy="12"
                                r="3"
                            />

                        </svg>

                    </button>

                </div>


                <div class="education-password-hint">
                    {{ __('education.auth.password_hint') }}
                </div>


                @error('password')

                    <div class="education-auth-field-error">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            {{-- =================================================
                 CONFIRM PASSWORD
            ================================================== --}}

            <div class="education-auth-form-group">

                <label
                    for="education-reset-password-confirmation"
                    class="education-auth-label"
                >
                    {{ __('education.auth.confirm_new_password') }}
                </label>


                <div class="education-auth-input-wrapper">

                    <svg
                        class="education-auth-input-icon"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >

                        <rect
                            x="3"
                            y="11"
                            width="18"
                            height="10"
                            rx="2"
                        />

                        <path d="M7 11V7a5 5 0 0 1 10 0v4" />

                    </svg>


                    <input
                        type="password"
                        id="education-reset-password-confirmation"
                        name="password_confirmation"
                        class="education-auth-input"
                        placeholder="{{ __('education.auth.confirm_password_placeholder') }}"
                        autocomplete="new-password"
                        required
                    >


                    <button
                        type="button"
                        class="education-password-toggle"
                        onclick="toggleEducationPassword('education-reset-password-confirmation', this)"
                        aria-label="{{ __('education.auth.show_password') }}"
                    >

                        <svg
                            class="education-password-eye"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >

                            <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z" />

                            <circle
                                cx="12"
                                cy="12"
                                r="3"
                            />

                        </svg>

                    </button>

                </div>

            </div>


            {{-- =================================================
                 SUBMIT
            ================================================== --}}

            <button
                type="submit"
                class="education-auth-submit"
            >

                <span class="education-auth-submit-content">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >

                        <path d="M12 3v12" />

                        <path d="m7 10 5 5 5-5" />

                        <path d="M5 21h14" />

                    </svg>

                    {{ __('education.auth.save_new_password') }}

                </span>

            </button>

        </form>


        {{-- =====================================================
             BACK TO LOGIN
        ====================================================== --}}

        <div class="education-auth-back">

            <a
                href="{{ route('education.login') }}"
            >

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >

                    <path d="M15 18 9 12l6-6" />

                </svg>

                {{ __('education.auth.back_to_login') }}

            </a>

        </div>


        {{-- =====================================================
             NOTE
        ====================================================== --}}

        <div class="education-auth-note">

            {{ __('education.auth.reset_password_note') }}

        </div>

    </div>

</div>


</div>

<script>
    function toggleEducationPassword(inputId, button) {

        const input = document.getElementById(inputId);

        if (!input) {
            return;
        }

        if (input.type === 'password') {

            input.type = 'text';

            button.setAttribute(
                'aria-label',
                @json(__('education.auth.hide_password'))
            );

        } else {

            input.type = 'password';

            button.setAttribute(
                'aria-label',
                @json(__('education.auth.show_password'))
            );
        }
    }
</script>

@endsection
