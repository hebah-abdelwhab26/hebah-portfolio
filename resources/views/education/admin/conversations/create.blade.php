@extends('education.admin.layouts.app')

@section('title', __('education_admin.conversations_create.page_title'))

@section('content')

<style>
    /* =========================================================
       EDUCATION ADMIN CONVERSATION CREATE
       Cream / Olive Green / Gold
    ========================================================= */

    .education-admin-conversation-create-page {
        direction: rtl;
        color: #30372a;
        padding-bottom: 50px;
    }

    /* =========================================================
       HEADER
    ========================================================= */

    .education-admin-conversation-create-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 28px;
    }

    .education-admin-conversation-create-heading {
        min-width: 0;
    }

    .education-admin-page-header-label {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #9a7b2f;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .education-admin-conversation-create-heading h1 {
        margin: 0;
        font-size: 28px;
        font-weight: 800;
        color: #30372a;
    }

    .education-admin-conversation-create-heading p {
        margin: 8px 0 0;
        color: #7d7d73;
        font-size: 14px;
        line-height: 1.8;
    }

    /* =========================================================
       BACK BUTTON
    ========================================================= */

    .education-conversation-back-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        min-height: 40px;
        padding: 0 15px;
        border-radius: 10px;
        color: #596346;
        background: #f2efe4;
        border: 1px solid #dfd8c6;
        text-decoration: none;
        font-size: 12px;
        font-weight: 700;
        transition: all 0.2s ease;
        white-space: nowrap;
    }

    .education-conversation-back-button:hover {
        color: #fff;
        background: #596346;
        border-color: #596346;
        transform: translateY(-1px);
    }

    /* =========================================================
       ALERT
    ========================================================= */

    .education-conversation-alert {
        margin-bottom: 20px;
        padding: 14px 17px;
        border-radius: 12px;
        font-size: 14px;
        line-height: 1.7;
    }

    .education-conversation-alert-error {
        color: #8a4444;
        background: #fff1f1;
        border: 1px solid #ebcaca;
    }

    /* =========================================================
       FORM CARD
    ========================================================= */

    .education-conversation-create-card {
        max-width: 850px;
        background: #fffdf8;
        border: 1px solid #e7dfcb;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 8px 28px rgba(48, 55, 42, 0.07);
    }

    .education-conversation-create-card-header {
        padding: 20px 23px;
        background: #faf7ee;
        border-bottom: 1px solid #e9e1cf;
    }

    .education-conversation-create-card-header h2 {
        margin: 0;
        color: #30372a;
        font-size: 17px;
        font-weight: 800;
    }

    .education-conversation-create-card-header p {
        margin: 7px 0 0;
        color: #858276;
        font-size: 12px;
        line-height: 1.7;
    }

    /* =========================================================
       FORM
    ========================================================= */

    .education-conversation-create-form {
        padding: 25px;
    }

    .education-conversation-form-group {
        margin-bottom: 22px;
    }

    .education-conversation-form-group:last-child {
        margin-bottom: 0;
    }

    .education-conversation-form-label {
        display: block;
        margin-bottom: 9px;
        color: #414638;
        font-size: 13px;
        font-weight: 800;
    }

    .education-conversation-required {
        color: #a85f4e;
        margin-right: 3px;
    }

    .education-conversation-form-control {
        width: 100%;
        box-sizing: border-box;
        min-height: 46px;
        padding: 11px 14px;
        border: 1px solid #ddd6c4;
        border-radius: 10px;
        outline: none;
        background: #fffefa;
        color: #3f4437;
        font-family: inherit;
        font-size: 13px;
        transition:
            border-color 0.2s ease,
            box-shadow 0.2s ease,
            background 0.2s ease;
    }

    .education-conversation-form-control:focus {
        border-color: #9a7b2f;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(154, 123, 47, 0.10);
    }

    .education-conversation-form-control::placeholder {
        color: #aaa69b;
    }

    select.education-conversation-form-control {
        cursor: pointer;
    }

    textarea.education-conversation-form-control {
        min-height: 180px;
        resize: vertical;
        line-height: 1.9;
    }

    .education-conversation-form-help {
        margin-top: 7px;
        color: #969286;
        font-size: 11px;
        line-height: 1.7;
    }

    /* =========================================================
       STUDENT SELECT
    ========================================================= */

    .education-conversation-student-select-wrapper {
        position: relative;
    }

    .education-conversation-student-select-icon {
        position: absolute;
        top: 50%;
        right: 14px;
        transform: translateY(-50%);
        color: #9a7b2f;
        pointer-events: none;
        z-index: 1;
    }

    .education-conversation-student-select {
        padding-right: 42px;
    }

    /* =========================================================
       MESSAGE BOX
    ========================================================= */

    .education-conversation-message-box {
        padding: 17px;
        border-radius: 13px;
        background: #faf7ee;
        border: 1px solid #e8dfcb;
    }

    .education-conversation-message-box-header {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 12px;
        color: #596346;
        font-size: 12px;
        font-weight: 800;
    }

    .education-conversation-message-box-header i {
        color: #9a7b2f;
    }

    /* =========================================================
       FORM ACTIONS
    ========================================================= */

    .education-conversation-form-actions {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        gap: 10px;
        padding-top: 7px;
    }

    .education-conversation-submit-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        min-height: 44px;
        padding: 0 19px;
        border: 1px solid #596346;
        border-radius: 10px;
        color: #fff;
        background: #596346;
        font-family: inherit;
        font-size: 13px;
        font-weight: 800;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .education-conversation-submit-button:hover {
        background: #485139;
        border-color: #485139;
        transform: translateY(-1px);
        box-shadow: 0 5px 14px rgba(89, 99, 70, 0.18);
    }

    .education-conversation-cancel-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 44px;
        padding: 0 17px;
        border-radius: 10px;
        color: #777568;
        background: #fff;
        border: 1px solid #ddd6c4;
        text-decoration: none;
        font-size: 12px;
        font-weight: 700;
        transition: all 0.2s ease;
    }

    .education-conversation-cancel-button:hover {
        color: #596346;
        border-color: #cfc6af;
        background: #faf7ee;
    }

    /* =========================================================
       VALIDATION
    ========================================================= */

    .education-conversation-error {
        margin-top: 7px;
        color: #a14f4f;
        font-size: 11px;
        line-height: 1.7;
    }

    .education-conversation-form-control.is-invalid {
        border-color: #d49a9a;
        background: #fffafa;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 700px) {

        .education-admin-conversation-create-header {
            flex-direction: column;
        }

        .education-conversation-back-button {
            width: 100%;
            box-sizing: border-box;
        }

        .education-admin-conversation-create-heading h1 {
            font-size: 24px;
        }

        .education-conversation-create-form {
            padding: 18px;
        }

        .education-conversation-form-actions {
            flex-direction: column;
            align-items: stretch;
        }

        .education-conversation-submit-button,
        .education-conversation-cancel-button {
            width: 100%;
            box-sizing: border-box;
        }
    }
</style>

<div class="education-admin-conversation-create-page">

{{-- =========================================================
     PAGE HEADER
========================================================== --}}

<div class="education-admin-conversation-create-header">

    <div class="education-admin-conversation-create-heading">

        <div class="education-admin-page-header-label">
            <i class="fa-solid fa-comments"></i>
            {{ __('education_admin.conversations_create.education_management') }}
        </div>

        <h1>
            {{ __('education_admin.conversations_create.title') }}
        </h1>

        <p>
            {{ __('education_admin.conversations_create.description') }}
        </p>

    </div>


    <a
        href="{{ route('education.admin.conversations.index') }}"
        class="education-conversation-back-button"
    >
        <i class="fa-solid fa-arrow-right"></i>
        {{ __('education_admin.conversations_create.back_to_conversations') }}
    </a>

</div>


{{-- =========================================================
     VALIDATION ERRORS
========================================================== --}}

@if ($errors->any())

    <div class="education-conversation-alert education-conversation-alert-error">

        <i class="fa-solid fa-circle-exclamation"></i>

        {{ __('education_admin.conversations_create.review_data') }}

        <ul style="margin: 8px 0 0; padding-right: 20px;">

            @foreach ($errors->all() as $error)

                <li>
                    {{ $error }}
                </li>

            @endforeach

        </ul>

    </div>

@endif


{{-- =========================================================
     FORM CARD
========================================================== --}}

<div class="education-conversation-create-card">

    <div class="education-conversation-create-card-header">

        <h2>
            {{ __('education_admin.conversations_create.conversation_data') }}
        </h2>

        <p>
            {{ __('education_admin.conversations_create.conversation_data_description') }}
        </p>

    </div>


    <form
        method="POST"
        action="{{ route('education.admin.conversations.store') }}"
        class="education-conversation-create-form"
    >

        @csrf


        {{-- =====================================================
             STUDENT
        ====================================================== --}}

        <div class="education-conversation-form-group">

            <label
                for="education_user_id"
                class="education-conversation-form-label"
            >
                {{ __('education_admin.conversations_create.student') }}
                <span class="education-conversation-required">*</span>
            </label>


            <div class="education-conversation-student-select-wrapper">

                <i class="fa-solid fa-user education-conversation-student-select-icon"></i>

                <select
                    id="education_user_id"
                    name="education_user_id"
                    class="education-conversation-form-control education-conversation-student-select {{ $errors->has('education_user_id') ? 'is-invalid' : '' }}"
                    required
                >

                    <option value="">
                        {{ __('education_admin.conversations_create.select_student') }}
                    </option>

                    @forelse ($students as $student)

                        <option
                            value="{{ $student->id }}"
                            {{ old('education_user_id') == $student->id ? 'selected' : '' }}
                        >
                            {{ $student->name }}
                            @if ($student->email)
                                — {{ $student->email }}
                            @endif
                        </option>

                    @empty

                        <option value="" disabled>
                            {{ __('education_admin.conversations_create.no_active_students') }}
                        </option>

                    @endforelse

                </select>

            </div>


            @if ($errors->has('education_user_id'))

                <div class="education-conversation-error">
                    {{ $errors->first('education_user_id') }}
                </div>

            @else

                <div class="education-conversation-form-help">
                    {{ __('education_admin.conversations_create.student_help') }}
                </div>

            @endif

        </div>


        {{-- =====================================================
             MESSAGE
        ====================================================== --}}

        <div class="education-conversation-form-group">

            <div class="education-conversation-message-box">

                <div class="education-conversation-message-box-header">

                    <i class="fa-solid fa-paper-plane"></i>

                    {{ __('education_admin.conversations_create.first_message') }}

                </div>


                <label
                    for="message"
                    class="education-conversation-form-label"
                >
                    {{ __('education_admin.conversations_create.message_text') }}
                    <span class="education-conversation-required">*</span>
                </label>


                <textarea
                    id="message"
                    name="message"
                    class="education-conversation-form-control {{ $errors->has('message') ? 'is-invalid' : '' }}"
                    placeholder="{{ __('education_admin.conversations_create.message_placeholder') }}"
                    maxlength="5000"
                    required
                >{{ old('message') }}</textarea>


                @if ($errors->has('message'))

                    <div class="education-conversation-error">
                        {{ $errors->first('message') }}
                    </div>

                @else

                    <div class="education-conversation-form-help">
                        {{ __('education_admin.conversations_create.message_help') }}
                    </div>

                @endif

            </div>

        </div>


        {{-- =====================================================
             ACTIONS
        ====================================================== --}}

        <div class="education-conversation-form-actions">

            <button
                type="submit"
                class="education-conversation-submit-button"
            >

                <i class="fa-solid fa-paper-plane"></i>

                {{ __('education_admin.conversations_create.start_and_send') }}

            </button>


            <a
                href="{{ route('education.admin.conversations.index') }}"
                class="education-conversation-cancel-button"
            >
                {{ __('education_admin.conversations_create.cancel') }}
            </a>

        </div>

    </form>

</div>

</div>

@endsection
