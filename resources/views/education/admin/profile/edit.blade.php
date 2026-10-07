@extends('education.admin.layouts.app')

@section('title', __('education_admin.profile.page_title'))

@section('page_title', __('education_admin.profile.page_title'))


@section('content')

<style>

    /* =========================================================
       EDUCATION ADMIN PROFILE
       ========================================================= */

    .education-admin-profile-page {
        direction: rtl;
        max-width: 1100px;
        margin: 0 auto;
        padding: 10px 0 60px;
    }


    /* =========================================================
       PAGE INTRO
       ========================================================= */

    .education-admin-profile-intro {
        margin-bottom: 28px;
    }

    .education-admin-profile-intro h2 {
        margin: 0 0 8px;
        font-size: 28px;
        font-weight: 800;
        color: #303127;
    }

    .education-admin-profile-intro p {
        margin: 0;
        color: #777766;
        font-size: 14px;
    }


    /* =========================================================
       ALERTS
       ========================================================= */

    .education-admin-profile-alert {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 15px 18px;
        margin-bottom: 20px;
        border-radius: 14px;
        font-size: 14px;
        font-weight: 600;
    }

    .education-admin-profile-alert-success {
        background: rgba(76, 105, 69, .10);
        border: 1px solid rgba(76, 105, 69, .20);
        color: #405a3a;
    }

    .education-admin-profile-alert-password {
        background: rgba(185, 145, 54, .12);
        border: 1px solid rgba(185, 145, 54, .25);
        color: #80621f;
    }


    /* =========================================================
       GRID
       ========================================================= */

    .education-admin-profile-grid {
        display: grid;
        grid-template-columns: 330px minmax(0, 1fr);
        gap: 24px;
        align-items: start;
    }


    /* =========================================================
       PROFILE CARD
       ========================================================= */

    .education-admin-profile-card {
        background: #fffdf7;
        border: 1px solid rgba(48, 49, 39, .09);
        border-radius: 22px;
        box-shadow: 0 12px 35px rgba(48, 49, 39, .07);
        overflow: hidden;
    }


    /* =========================================================
       PROFILE HERO
       ========================================================= */

    .education-admin-profile-card-header {
        position: relative;
        padding: 35px 25px 28px;
        text-align: center;
        background:
            linear-gradient(
                145deg,
                rgba(48, 49, 39, .98),
                rgba(65, 74, 48, .96)
            );
        color: #fff;
    }

    .education-admin-profile-card-header::after {
        content: "";
        position: absolute;
        width: 130px;
        height: 130px;
        border-radius: 50%;
        background: rgba(196, 160, 75, .12);
        top: -55px;
        left: -45px;
    }


    /* =========================================================
       AVATAR
       ========================================================= */

    .education-admin-profile-large-avatar {
        position: relative;
        z-index: 2;

        width: 105px;
        height: 105px;
        margin: 0 auto 18px;

        border-radius: 50%;

        display: flex;
        align-items: center;
        justify-content: center;

        overflow: hidden;

        background:
            linear-gradient(
                135deg,
                #c7a44d,
                #e0c77d
            );

        border: 5px solid rgba(255,255,255,.85);

        box-shadow:
            0 8px 25px rgba(0,0,0,.20);

        font-size: 38px;
        font-weight: 800;
        color: #303127;
    }

    .education-admin-profile-large-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }


    /* =========================================================
       PROFILE NAME
       ========================================================= */

    .education-admin-profile-card-header h3 {
        position: relative;
        z-index: 2;

        margin: 0 0 6px;

        font-size: 21px;
        font-weight: 800;
    }

    .education-admin-profile-card-header span {
        position: relative;
        z-index: 2;

        display: block;

        font-size: 13px;
        opacity: .75;

        direction: ltr;
    }


    /* =========================================================
       PROFILE STATUS
       ========================================================= */

    .education-admin-profile-status {
        margin-top: 18px;

        display: inline-flex;
        align-items: center;
        gap: 7px;

        padding: 7px 12px;

        border-radius: 30px;

        background: rgba(255,255,255,.10);

        font-size: 12px;
    }

    .education-admin-profile-status i {
        font-size: 8px;
        color: #83c875;
    }


    /* =========================================================
       INFO LIST
       ========================================================= */

    .education-admin-profile-info {
        padding: 22px;
    }

    .education-admin-profile-info-row {
        display: flex;
        align-items: center;
        gap: 13px;

        padding: 13px 0;

        border-bottom: 1px solid rgba(48,49,39,.07);
    }

    .education-admin-profile-info-row:last-child {
        border-bottom: 0;
    }

    .education-admin-profile-info-icon {
        width: 38px;
        height: 38px;

        flex: 0 0 38px;

        border-radius: 11px;

        display: flex;
        align-items: center;
        justify-content: center;

        background: rgba(185,145,54,.10);
        color: #a17d2e;
    }

    .education-admin-profile-info-text {
        min-width: 0;
    }

    .education-admin-profile-info-text small {
        display: block;
        margin-bottom: 3px;

        color: #999;
        font-size: 11px;
    }

    .education-admin-profile-info-text strong {
        display: block;

        color: #3b3c31;
        font-size: 13px;

        word-break: break-word;
    }


    /* =========================================================
       FORM CARD
       ========================================================= */

    .education-admin-profile-form-card {
        background: #fffdf7;

        border: 1px solid rgba(48,49,39,.09);
        border-radius: 22px;

        box-shadow:
            0 12px 35px rgba(48,49,39,.07);

        padding: 28px;
    }


    /* =========================================================
       FORM SECTION
       ========================================================= */

    .education-admin-profile-form-section {
        padding-bottom: 28px;
        margin-bottom: 28px;

        border-bottom: 1px solid rgba(48,49,39,.08);
    }

    .education-admin-profile-form-section:last-child {
        padding-bottom: 0;
        margin-bottom: 0;
        border-bottom: 0;
    }


    .education-admin-profile-section-title {
        display: flex;
        align-items: center;
        gap: 12px;

        margin-bottom: 22px;
    }

    .education-admin-profile-section-icon {
        width: 43px;
        height: 43px;

        border-radius: 13px;

        display: flex;
        align-items: center;
        justify-content: center;

        background: rgba(185,145,54,.11);
        color: #9c782b;

        font-size: 17px;
    }

    .education-admin-profile-section-title h3 {
        margin: 0 0 3px;

        font-size: 18px;
        font-weight: 800;

        color: #303127;
    }

    .education-admin-profile-section-title p {
        margin: 0;

        color: #888879;
        font-size: 12px;
    }


    /* =========================================================
       FORM GRID
       ========================================================= */

    .education-admin-profile-form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
    }


    .education-admin-profile-field {
        display: flex;
        flex-direction: column;
    }

    .education-admin-profile-field.full {
        grid-column: 1 / -1;
    }


    .education-admin-profile-field label {
        margin-bottom: 8px;

        color: #494a3d;

        font-size: 13px;
        font-weight: 700;
    }


    .education-admin-profile-field input {
        width: 100%;
        box-sizing: border-box;

        min-height: 48px;

        padding: 0 14px;

        border-radius: 12px;

        border: 1px solid rgba(48,49,39,.13);

        background: #ffffff;

        color: #303127;

        font-family: inherit;
        font-size: 14px;

        outline: none;

        transition:
            border-color .2s ease,
            box-shadow .2s ease,
            background .2s ease;
    }

    .education-admin-profile-field input:focus {
        border-color: rgba(161,125,46,.55);

        background: #fffefb;

        box-shadow:
            0 0 0 4px rgba(185,145,54,.09);
    }


    /* =========================================================
       ERROR
       ========================================================= */

    .education-admin-profile-error {
        margin-top: 6px;

        color: #b44a43;

        font-size: 12px;
    }


    /* =========================================================
       FORM ACTION
       ========================================================= */

    .education-admin-profile-actions {
        display: flex;
        justify-content: flex-start;

        margin-top: 20px;
    }

    .education-admin-profile-save {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;

        min-height: 46px;

        padding: 0 22px;

        border: 0;
        border-radius: 12px;

        background:
            linear-gradient(
                135deg,
                #4f6245,
                #3f5137
            );

        color: #fff;

        font-family: inherit;
        font-size: 13px;
        font-weight: 700;

        cursor: pointer;

        transition:
            transform .2s ease,
            box-shadow .2s ease;
    }

    .education-admin-profile-save:hover {
        transform: translateY(-2px);

        box-shadow:
            0 8px 20px rgba(63,81,55,.22);
    }


    /* =========================================================
       PASSWORD NOTE
       ========================================================= */

    .education-admin-profile-password-note {
        margin-top: 12px;

        padding: 11px 13px;

        border-radius: 11px;

        background: rgba(48,49,39,.045);

        color: #777768;

        font-size: 12px;
        line-height: 1.7;
    }


    /* =========================================================
       RESPONSIVE
       ========================================================= */

    @media (max-width: 850px) {

        .education-admin-profile-grid {
            grid-template-columns: 1fr;
        }

    }


    @media (max-width: 600px) {

        .education-admin-profile-page {
            padding: 0 0 40px;
        }

        .education-admin-profile-form-grid {
            grid-template-columns: 1fr;
        }

        .education-admin-profile-field.full {
            grid-column: auto;
        }

        .education-admin-profile-form-card {
            padding: 20px;
        }

        .education-admin-profile-intro h2 {
            font-size: 23px;
        }

    }

</style>


<div class="education-admin-profile-page">


    {{-- =====================================================
        INTRO
    ===================================================== --}}

    <div class="education-admin-profile-intro">

        <h2>
            {{ __('education_admin.profile.page_title') }}
        </h2>

        <p>
            {{ __('education_admin.profile.description') }}
        </p>

    </div>


    {{-- =====================================================
        SUCCESS
    ===================================================== --}}

    @if(session('success'))

        <div class="education-admin-profile-alert education-admin-profile-alert-success">

            <i class="fa-solid fa-circle-check"></i>

            <span>
                {{ session('success') }}
            </span>

        </div>

    @endif


    {{-- =====================================================
        PASSWORD SUCCESS
    ===================================================== --}}

    @if(session('password_success'))

        <div class="education-admin-profile-alert education-admin-profile-alert-password">

            <i class="fa-solid fa-shield-halved"></i>

            <span>
                {{ session('password_success') }}
            </span>

        </div>

    @endif


    {{-- =====================================================
        MAIN GRID
    ===================================================== --}}

    <div class="education-admin-profile-grid">


        {{-- =================================================
            LEFT PROFILE CARD
        ================================================= --}}

        <aside class="education-admin-profile-card">


            <div class="education-admin-profile-card-header">

                <div class="education-admin-profile-large-avatar">

                    @if($educationAdmin->avatar)

                        <img
                            src="{{ asset($educationAdmin->avatar) }}"
                            alt="{{ $educationAdmin->name }}"
                        >

                    @else

                        <span>
                            {{ mb_strtoupper(
                                mb_substr(
                                    $educationAdmin->name ?? 'H',
                                    0,
                                    1
                                )
                            ) }}
                        </span>

                    @endif

                </div>


                <h3>
                    {{ $educationAdmin->name ?? __('education_admin.profile.admin.default_name') }}
                </h3>


                <span>
                    {{ $educationAdmin->email }}
                </span>


                <div class="education-admin-profile-status">

                    <i class="fa-solid fa-circle"></i>

                    {{ __('education_admin.profile.admin.active') }}

                </div>

            </div>


            <div class="education-admin-profile-info">


                <div class="education-admin-profile-info-row">

                    <div class="education-admin-profile-info-icon">

                        <i class="fa-regular fa-user"></i>

                    </div>

                    <div class="education-admin-profile-info-text">

                        <small>
                            {{ __('education_admin.profile.fields.name') }}
                        </small>

                        <strong>
                            {{ $educationAdmin->name }}
                        </strong>

                    </div>

                </div>


                <div class="education-admin-profile-info-row">

                    <div class="education-admin-profile-info-icon">

                        <i class="fa-regular fa-envelope"></i>

                    </div>

                    <div class="education-admin-profile-info-text">

                        <small>
                            {{ __('education_admin.profile.fields.email') }}
                        </small>

                        <strong dir="ltr">
                            {{ $educationAdmin->email }}
                        </strong>

                    </div>

                </div>


                <div class="education-admin-profile-info-row">

                    <div class="education-admin-profile-info-icon">

                        <i class="fa-solid fa-shield-halved"></i>

                    </div>

                    <div class="education-admin-profile-info-text">

                        <small>
                            {{ __('education_admin.profile.fields.account_type') }}
                        </small>

                        <strong>
                            {{ __('education_admin.profile.admin.education_manager') }}
                        </strong>

                    </div>

                </div>


            </div>

        </aside>


        {{-- =================================================
            RIGHT FORMS
        ================================================= --}}

        <div class="education-admin-profile-form-card">


            {{-- =================================================
                PERSONAL INFORMATION
            ================================================= --}}

            <section class="education-admin-profile-form-section">


                <div class="education-admin-profile-section-title">

                    <div class="education-admin-profile-section-icon">

                        <i class="fa-regular fa-user"></i>

                    </div>

                    <div>

                        <h3>
                            {{ __('education_admin.profile.personal.title') }}
                        </h3>

                        <p>
                            {{ __('education_admin.profile.personal.description') }}
                        </p>

                    </div>

                </div>


                <form
                    action="{{ route('education.admin.profile.update') }}"
                    method="POST"
                >

                    @csrf

                    @method('PUT')


                    <div class="education-admin-profile-form-grid">


                        <div class="education-admin-profile-field">

                            <label for="name">
                                {{ __('education_admin.profile.fields.name') }}
                            </label>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name', $educationAdmin->name) }}"
                                autocomplete="name"
                                required
                            >

                            @error('name')

                                <span class="education-admin-profile-error">
                                    {{ $message }}
                                </span>

                            @enderror

                        </div>


                        <div class="education-admin-profile-field">

                            <label for="email">
                                {{ __('education_admin.profile.fields.email') }}
                            </label>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email', $educationAdmin->email) }}"
                                autocomplete="email"
                                required
                                dir="ltr"
                            >

                            @error('email')

                                <span class="education-admin-profile-error">
                                    {{ $message }}
                                </span>

                            @enderror

                        </div>


                    </div>


                    <div class="education-admin-profile-actions">

                        <button
                            type="submit"
                            class="education-admin-profile-save"
                        >

                            <i class="fa-solid fa-floppy-disk"></i>

                            {{ __('education_admin.profile.personal.save') }}

                        </button>

                    </div>

                </form>

            </section>


            {{-- =================================================
                PASSWORD
            ================================================= --}}

            <section class="education-admin-profile-form-section">


                <div class="education-admin-profile-section-title">

                    <div class="education-admin-profile-section-icon">

                        <i class="fa-solid fa-lock"></i>

                    </div>

                    <div>

                        <h3>
                            {{ __('education_admin.profile.password.title') }}
                        </h3>

                        <p>
                            {{ __('education_admin.profile.password.description') }}
                        </p>

                    </div>

                </div>


                <form
                    action="{{ route('education.admin.profile.password.update') }}"
                    method="POST"
                >

                    @csrf

                    @method('PUT')


                    <div class="education-admin-profile-form-grid">


                        <div class="education-admin-profile-field full">

                            <label for="current_password">
                                {{ __('education_admin.profile.password.current') }}
                            </label>

                            <input
                                type="password"
                                id="current_password"
                                name="current_password"
                                autocomplete="current-password"
                                required
                                dir="ltr"
                            >

                            @error('current_password')

                                <span class="education-admin-profile-error">
                                    {{ $message }}
                                </span>

                            @enderror

                        </div>


                        <div class="education-admin-profile-field">

                            <label for="password">
                                {{ __('education_admin.profile.password.new') }}
                            </label>

                            <input
                                type="password"
                                id="password"
                                name="password"
                                autocomplete="new-password"
                                required
                                dir="ltr"
                            >

                            @error('password')

                                <span class="education-admin-profile-error">
                                    {{ $message }}
                                </span>

                            @enderror

                        </div>


                        <div class="education-admin-profile-field">

                            <label for="password_confirmation">
                                {{ __('education_admin.profile.password.confirm') }}
                            </label>

                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                autocomplete="new-password"
                                required
                                dir="ltr"
                            >

                        </div>


                    </div>


                    <div class="education-admin-profile-password-note">

                        <i class="fa-solid fa-circle-info"></i>

                        {{ __('education_admin.profile.password.requirement') }}

                    </div>


                    <div class="education-admin-profile-actions">

                        <button
                            type="submit"
                            class="education-admin-profile-save"
                        >

                            <i class="fa-solid fa-key"></i>

                            {{ __('education_admin.profile.password.save') }}

                        </button>

                    </div>

                </form>

            </section>


        </div>

    </div>

</div>

@endsection
