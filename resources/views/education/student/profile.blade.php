@extends('education.layouts.app')

@section('title', __('education.profile_page.page_title'))

@section('meta_description')
{{ __('education.profile_page.meta_description') }}
@endsection

@section('header')
    @include('education.partials.navbar')
@endsection

@section('content')

<style>
    /*
    |--------------------------------------------------------------------------
    | EDUCATION PROFILE PAGE
    |--------------------------------------------------------------------------
    */

    .education-profile-page {
        position: relative;
        min-height: calc(100vh - 90px);
        padding: 140px 20px 70px;
        direction: rtl;
        overflow: hidden;
    }


    /*
    |--------------------------------------------------------------------------
    | BACKGROUND GLOW
    |--------------------------------------------------------------------------
    */

    .education-profile-page::before,
    .education-profile-page::after {
        content: "";
        position: absolute;
        border-radius: 50%;
        pointer-events: none;
        z-index: 0;
        filter: blur(10px);
    }

    .education-profile-page::before {
        width: 360px;
        height: 360px;
        top: 90px;
        right: -160px;
        background: rgba(201, 169, 92, 0.10);
    }

    .education-profile-page::after {
        width: 300px;
        height: 300px;
        bottom: 30px;
        left: -140px;
        background: rgba(86, 105, 72, 0.10);
    }


    /*
    |--------------------------------------------------------------------------
    | CONTAINER
    |--------------------------------------------------------------------------
    */

    .education-profile-container {
        position: relative;
        z-index: 2;
        width: min(1100px, 100%);
        margin: 0 auto;
    }


    /*
    |--------------------------------------------------------------------------
    | PAGE HEADER
    |--------------------------------------------------------------------------
    */

    .education-profile-heading {
        text-align: center;
        margin-bottom: 35px;
    }

    .education-profile-heading-icon {
        width: 72px;
        height: 72px;
        margin: 0 auto 18px;
        border-radius: 22px;

        display: flex;
        align-items: center;
        justify-content: center;

        background:
            linear-gradient(
                145deg,
                rgba(205, 177, 104, 0.24),
                rgba(93, 112, 77, 0.18)
            );

        border: 1px solid rgba(196, 164, 87, 0.35);

        box-shadow:
            0 15px 35px rgba(0, 0, 0, 0.08),
            inset 0 1px 0 rgba(255, 255, 255, 0.25);
    }

    .education-profile-heading-icon i {
        font-size: 30px;
        color: #b8954d;
    }

    .education-profile-heading h1 {
        margin: 0 0 10px;

        font-family: "Cairo", sans-serif;
        font-size: clamp(28px, 4vw, 40px);
        font-weight: 800;

        color: #35362e;
    }

    .education-profile-heading p {
        margin: 0;

        font-family: "Cairo", sans-serif;
        font-size: 15px;
        line-height: 1.9;

        color: rgba(53, 54, 46, 0.68);
    }


    /*
    |--------------------------------------------------------------------------
    | PROFILE CARD
    |--------------------------------------------------------------------------
    */

    .education-profile-card {
        position: relative;

        background:
            linear-gradient(
                145deg,
                rgba(255, 252, 244, 0.94),
                rgba(248, 243, 229, 0.91)
            );

        border: 1px solid rgba(190, 163, 91, 0.25);
        border-radius: 30px;

        box-shadow:
            0 25px 70px rgba(48, 49, 39, 0.12),
            inset 0 1px 0 rgba(255, 255, 255, 0.65);

        overflow: hidden;

        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
    }


    /*
    |--------------------------------------------------------------------------
    | PROFILE TOP
    |--------------------------------------------------------------------------
    */

    .education-profile-top {
        position: relative;

        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 30px;

        padding: 35px 40px;

        background:
            linear-gradient(
                135deg,
                rgba(77, 91, 63, 0.96),
                rgba(52, 62, 45, 0.96)
            );

        color: #fff;

        overflow: hidden;
    }

    .education-profile-top::before {
        content: "";
        position: absolute;

        width: 280px;
        height: 280px;

        top: -180px;
        left: -80px;

        border-radius: 50%;

        background: rgba(205, 177, 104, 0.13);
    }

    .education-profile-top::after {
        content: "";
        position: absolute;

        width: 180px;
        height: 180px;

        bottom: -130px;
        right: 20%;

        border-radius: 50%;

        background: rgba(255, 255, 255, 0.035);
    }


    /*
    |--------------------------------------------------------------------------
    | PROFILE IDENTITY
    |--------------------------------------------------------------------------
    */

    .education-profile-identity {
        position: relative;
        z-index: 2;

        display: flex;
        align-items: center;
        gap: 22px;
    }

    .education-profile-avatar {
        flex: 0 0 auto;

        width: 88px;
        height: 88px;

        border-radius: 26px;

        display: flex;
        align-items: center;
        justify-content: center;

        background:
            linear-gradient(
                145deg,
                rgba(218, 189, 113, 0.98),
                rgba(169, 134, 61, 0.98)
            );

        color: #fff;

        font-size: 34px;

        box-shadow:
            0 12px 30px rgba(0, 0, 0, 0.18),
            inset 0 1px 0 rgba(255, 255, 255, 0.35);
    }

    .education-profile-name {
        margin: 0 0 6px;

        font-family: "Cairo", sans-serif;
        font-size: clamp(22px, 3vw, 30px);
        font-weight: 800;

        color: #fff;
    }

    .education-profile-email {
        margin: 0;

        direction: ltr;
        text-align: right;

        font-family: "Cairo", sans-serif;
        font-size: 14px;

        color: rgba(255, 255, 255, 0.72);
    }


    /*
    |--------------------------------------------------------------------------
    | STATUS
    |--------------------------------------------------------------------------
    */

    .education-profile-status {
        position: relative;
        z-index: 2;

        display: inline-flex;
        align-items: center;
        gap: 9px;

        padding: 10px 17px;

        border-radius: 999px;

        font-family: "Cairo", sans-serif;
        font-size: 13px;
        font-weight: 700;

        white-space: nowrap;
    }

    .education-profile-status i {
        font-size: 10px;
    }

    .education-profile-status.pending {
        background: rgba(220, 177, 76, 0.17);
        border: 1px solid rgba(235, 202, 119, 0.32);
        color: #f1d58b;
    }

    .education-profile-status.approved {
        background: rgba(119, 163, 106, 0.16);
        border: 1px solid rgba(148, 190, 133, 0.28);
        color: #b9dcae;
    }

    .education-profile-status.rejected {
        background: rgba(190, 92, 82, 0.16);
        border: 1px solid rgba(220, 119, 109, 0.25);
        color: #efb0aa;
    }

    .education-profile-status.unknown {
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.14);
        color: rgba(255, 255, 255, 0.78);
    }


    /*
    |--------------------------------------------------------------------------
    | PROFILE BODY
    |--------------------------------------------------------------------------
    */

    .education-profile-body {
        padding: 40px;
    }


    /*
    |--------------------------------------------------------------------------
    | SECTION TITLE
    |--------------------------------------------------------------------------
    */

    .education-profile-section-title {
        display: flex;
        align-items: center;
        gap: 12px;

        margin: 0 0 24px;

        font-family: "Cairo", sans-serif;
        font-size: 19px;
        font-weight: 800;

        color: #3c4035;
    }

    .education-profile-section-title i {
        width: 38px;
        height: 38px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 12px;

        background: rgba(190, 157, 79, 0.11);
        color: #b28b3f;

        font-size: 15px;
    }


    /*
    |--------------------------------------------------------------------------
    | INFORMATION GRID
    |--------------------------------------------------------------------------
    */

    .education-profile-info-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 17px;

        margin-bottom: 40px;
    }

    .education-profile-info-item {
        min-height: 92px;

        padding: 20px;

        display: flex;
        align-items: center;

        gap: 16px;

        border-radius: 18px;

        background: rgba(255, 255, 255, 0.55);

        border: 1px solid rgba(80, 87, 68, 0.09);

        transition:
            transform 0.25s ease,
            box-shadow 0.25s ease,
            border-color 0.25s ease;
    }

    .education-profile-info-item:hover {
        transform: translateY(-3px);

        border-color: rgba(190, 157, 79, 0.22);

        box-shadow:
            0 12px 28px rgba(48, 49, 39, 0.07);
    }

    .education-profile-info-icon {
        flex: 0 0 auto;

        width: 48px;
        height: 48px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 15px;

        background:
            linear-gradient(
                145deg,
                rgba(191, 161, 89, 0.14),
                rgba(91, 111, 75, 0.09)
            );

        color: #a9853d;

        font-size: 18px;
    }

    .education-profile-info-content {
        min-width: 0;
    }

    .education-profile-info-label {
        display: block;

        margin-bottom: 5px;

        font-family: "Cairo", sans-serif;
        font-size: 12px;
        font-weight: 600;

        color: rgba(60, 64, 53, 0.56);
    }

    .education-profile-info-value {
        display: block;

        font-family: "Cairo", sans-serif;
        font-size: 15px;
        font-weight: 700;

        color: #3c4035;

        overflow-wrap: anywhere;
    }

    .education-profile-info-value.ltr {
        direction: ltr;
        text-align: right;
    }

    .education-profile-empty {
        color: rgba(60, 64, 53, 0.42);
        font-weight: 500;
    }


    /*
    |--------------------------------------------------------------------------
    | STATUS INFORMATION
    |--------------------------------------------------------------------------
    */

    .education-profile-status-box {
        display: flex;
        align-items: flex-start;
        gap: 17px;

        padding: 22px;

        margin-bottom: 30px;

        border-radius: 20px;

        background: rgba(255, 255, 255, 0.46);
        border: 1px solid rgba(80, 87, 68, 0.09);
    }

    .education-profile-status-box-icon {
        flex: 0 0 auto;

        width: 48px;
        height: 48px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 15px;

        background: rgba(190, 157, 79, 0.12);
        color: #a9853d;
    }

    .education-profile-status-box-content h3 {
        margin: 0 0 5px;

        font-family: "Cairo", sans-serif;
        font-size: 15px;
        font-weight: 800;

        color: #3c4035;
    }

    .education-profile-status-box-content p {
        margin: 0;

        font-family: "Cairo", sans-serif;
        font-size: 13px;
        line-height: 1.9;

        color: rgba(60, 64, 53, 0.65);
    }


    /*
    |--------------------------------------------------------------------------
    | ACTIONS
    |--------------------------------------------------------------------------
    */

    .education-profile-actions {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 12px;

        padding-top: 5px;
    }

    .education-profile-action {
        min-width: 180px;

        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;

        padding: 13px 22px;

        border-radius: 14px;

        text-decoration: none;

        font-family: "Cairo", sans-serif;
        font-size: 14px;
        font-weight: 700;

        transition:
            transform 0.25s ease,
            box-shadow 0.25s ease,
            background 0.25s ease;
    }

    .education-profile-action:hover {
        transform: translateY(-2px);
    }

    .education-profile-action.primary {
        background:
            linear-gradient(
                135deg,
                #b9964d,
                #9f7d39
            );

        color: #fff;

        box-shadow:
            0 10px 25px rgba(159, 125, 57, 0.20);
    }

    .education-profile-action.primary:hover {
        box-shadow:
            0 14px 30px rgba(159, 125, 57, 0.28);
    }

    .education-profile-action.secondary {
        background: rgba(77, 91, 63, 0.09);
        border: 1px solid rgba(77, 91, 63, 0.14);

        color: #4d5b3f;
    }

    .education-profile-action.secondary:hover {
        background: rgba(77, 91, 63, 0.14);
    }


    /*
    |--------------------------------------------------------------------------
    | RESPONSIVE
    |--------------------------------------------------------------------------
    */

    @media (max-width: 768px) {

        .education-profile-page {
            padding: 120px 15px 50px;
        }

        .education-profile-heading {
            margin-bottom: 25px;
        }

        .education-profile-heading-icon {
            width: 62px;
            height: 62px;
            border-radius: 19px;
        }

        .education-profile-heading-icon i {
            font-size: 25px;
        }

        .education-profile-top {
            flex-direction: column;
            align-items: stretch;

            padding: 28px 22px;

            text-align: center;
        }

        .education-profile-identity {
            flex-direction: column;
        }

        .education-profile-email {
            text-align: center;
        }

        .education-profile-status {
            align-self: center;
        }

        .education-profile-body {
            padding: 28px 20px;
        }

        .education-profile-info-grid {
            grid-template-columns: 1fr;
            gap: 13px;
        }

        .education-profile-info-item {
            min-height: 82px;
            padding: 16px;
        }

        .education-profile-actions {
            flex-direction: column;
        }

        .education-profile-action {
            width: 100%;
        }
    }


    @media (max-width: 480px) {

        .education-profile-page {
            padding-left: 10px;
            padding-right: 10px;
        }

        .education-profile-card {
            border-radius: 22px;
        }

        .education-profile-top {
            padding: 25px 17px;
        }

        .education-profile-avatar {
            width: 76px;
            height: 76px;
            border-radius: 22px;
            font-size: 29px;
        }

        .education-profile-body {
            padding: 24px 15px;
        }

        .education-profile-info-item {
            gap: 12px;
        }

        .education-profile-info-icon {
            width: 43px;
            height: 43px;
            border-radius: 13px;
        }
    }
</style>


<div class="education-profile-page">

    <div class="education-profile-container">

        {{-- =========================================================
             PAGE HEADER
        ========================================================== --}}

        <div class="education-profile-heading">

            <div class="education-profile-heading-icon">
                <i class="fa-solid fa-user"></i>
            </div>

            <h1>
                {{ __('education.profile_page.heading.title') }}
            </h1>

            <p>
                {{ __('education.profile_page.heading.description') }}
            </p>

        </div>


        {{-- =========================================================
             PROFILE CARD
        ========================================================== --}}

        <div class="education-profile-card">

            {{-- =====================================================
                 PROFILE TOP
            ====================================================== --}}

            <div class="education-profile-top">

                <div class="education-profile-identity">

                    <div class="education-profile-avatar">
                        <i class="fa-solid fa-user"></i>
                    </div>

                    <div>

                        <h2 class="education-profile-name">
                            {{ $student->name }}
                        </h2>

                        <p class="education-profile-email">
                            {{ $student->email }}
                        </p>

                    </div>

                </div>


                {{-- =================================================
                     STUDENT STATUS
                ================================================== --}}

                @if($student->isStudentApproved())

                    <div class="education-profile-status approved">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>
                            {{ __('education.profile_page.status.approved') }}
                        </span>
                    </div>

                @elseif($student->isStudentPending())

                    <div class="education-profile-status pending">
                        <i class="fa-solid fa-clock"></i>
                        <span>
                            {{ __('education.profile_page.status.pending') }}
                        </span>
                    </div>

                @elseif($student->isStudentRejected())

                    <div class="education-profile-status rejected">
                        <i class="fa-solid fa-circle-xmark"></i>
                        <span>
                            {{ __('education.profile_page.status.rejected') }}
                        </span>
                    </div>

                @else

                    <div class="education-profile-status unknown">
                        <i class="fa-solid fa-circle-question"></i>
                        <span>
                            {{ __('education.profile_page.status.unknown') }}
                        </span>
                    </div>

                @endif

            </div>


            {{-- =====================================================
                 PROFILE BODY
            ====================================================== --}}

            <div class="education-profile-body">


                {{-- =================================================
                     PERSONAL INFORMATION
                ================================================== --}}

                <h2 class="education-profile-section-title">

                    <i class="fa-solid fa-address-card"></i>

                    <span>
                        {{ __('education.profile_page.personal_information.title') }}
                    </span>

                </h2>


                <div class="education-profile-info-grid">


                    {{-- NAME --}}

                    <div class="education-profile-info-item">

                        <div class="education-profile-info-icon">
                            <i class="fa-solid fa-user"></i>
                        </div>

                        <div class="education-profile-info-content">

                            <span class="education-profile-info-label">
                                {{ __('education.profile_page.fields.full_name') }}
                            </span>

                            <span class="education-profile-info-value">
                                {{ $student->name }}
                            </span>

                        </div>

                    </div>


                    {{-- EMAIL --}}

                    <div class="education-profile-info-item">

                        <div class="education-profile-info-icon">
                            <i class="fa-solid fa-envelope"></i>
                        </div>

                        <div class="education-profile-info-content">

                            <span class="education-profile-info-label">
                                {{ __('education.profile_page.fields.email') }}
                            </span>

                            <span class="education-profile-info-value ltr">
                                {{ $student->email }}
                            </span>

                        </div>

                    </div>


                    {{-- PHONE --}}

                    <div class="education-profile-info-item">

                        <div class="education-profile-info-icon">
                            <i class="fa-solid fa-phone"></i>
                        </div>

                        <div class="education-profile-info-content">

                            <span class="education-profile-info-label">
                                {{ __('education.profile_page.fields.phone') }}
                            </span>

                            @if($student->phone)

                                <span class="education-profile-info-value ltr">
                                    {{ $student->phone }}
                                </span>

                            @else

                                <span class="education-profile-info-value education-profile-empty">
                                    {{ __('education.profile_page.fields.phone_empty') }}
                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- WHATSAPP --}}

                    <div class="education-profile-info-item">

                        <div class="education-profile-info-icon">
                            <i class="fa-brands fa-whatsapp"></i>
                        </div>

                        <div class="education-profile-info-content">

                            <span class="education-profile-info-label">
                                {{ __('education.profile_page.fields.whatsapp') }}
                            </span>

                            @if($student->whatsapp_number)

                                <span class="education-profile-info-value ltr">
                                    {{ $student->whatsapp_number }}
                                </span>

                            @else

                                <span class="education-profile-info-value education-profile-empty">
                                    {{ __('education.profile_page.fields.whatsapp_empty') }}
                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- EDUCATION LEVEL --}}

                    <div class="education-profile-info-item">

                        <div class="education-profile-info-icon">
                            <i class="fa-solid fa-graduation-cap"></i>
                        </div>

                        <div class="education-profile-info-content">

                            <span class="education-profile-info-label">
                                {{ __('education.profile_page.fields.education_level') }}
                            </span>

                            @if($student->education_level)

                                <span class="education-profile-info-value">
                                    {{ $student->education_level }}
                                </span>

                            @else

                                <span class="education-profile-info-value education-profile-empty">
                                    {{ __('education.profile_page.fields.education_level_empty') }}
                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- LEARNING GOAL --}}

                    <div class="education-profile-info-item">

                        <div class="education-profile-info-icon">
                            <i class="fa-solid fa-bullseye"></i>
                        </div>

                        <div class="education-profile-info-content">

                            <span class="education-profile-info-label">
                                {{ __('education.profile_page.fields.learning_goal') }}
                            </span>

                            @if($student->learning_goal)

                                <span class="education-profile-info-value">
                                    {{ $student->learning_goal }}
                                </span>

                            @else

                                <span class="education-profile-info-value education-profile-empty">
                                    {{ __('education.profile_page.fields.learning_goal_empty') }}
                                </span>

                            @endif

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     ACCOUNT STATUS MESSAGE
                ================================================== --}}

                @if($student->isStudentPending())

                    <div class="education-profile-status-box">

                        <div class="education-profile-status-box-icon">
                            <i class="fa-solid fa-clock"></i>
                        </div>

                        <div class="education-profile-status-box-content">

                            <h3>
                                {{ __('education.profile_page.status_message.pending.title') }}
                            </h3>

                            <p>
                                {{ __('education.profile_page.status_message.pending.description') }}
                            </p>

                        </div>

                    </div>

                @elseif($student->isStudentApproved())

                    <div class="education-profile-status-box">

                        <div class="education-profile-status-box-icon">
                            <i class="fa-solid fa-circle-check"></i>
                        </div>

                        <div class="education-profile-status-box-content">

                            <h3>
                                {{ __('education.profile_page.status_message.approved.title') }}
                            </h3>

                            <p>
                                {{ __('education.profile_page.status_message.approved.description') }}
                            </p>

                        </div>

                    </div>

                @elseif($student->isStudentRejected())

                    <div class="education-profile-status-box">

                        <div class="education-profile-status-box-icon">
                            <i class="fa-solid fa-circle-xmark"></i>
                        </div>

                        <div class="education-profile-status-box-content">

                            <h3>
                                {{ __('education.profile_page.status_message.rejected.title') }}
                            </h3>

                            <p>
                                {{ __('education.profile_page.status_message.rejected.description') }}
                            </p>

                        </div>

                    </div>

                @endif


                {{-- =================================================
                     ACTIONS
                ================================================== --}}

                <div class="education-profile-actions">

                    @if($student->isStudentApproved())

                        <a
                            href="{{ route('education.dashboard') }}"
                            class="education-profile-action primary"
                        >
                            <i class="fa-solid fa-gauge-high"></i>

                            <span>
                                {{ __('education.profile_page.actions.dashboard') }}
                            </span>
                        </a>

                    @endif


                    <a
                        href="{{ route('education.index') }}"
                        class="education-profile-action secondary"
                    >
                        <i class="fa-solid fa-house"></i>

                        <span>
                            {{ __('education.profile_page.actions.education_home') }}
                        </span>
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
