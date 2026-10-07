@extends('education.layouts.app')

@section('title', __('education.conversation_create_page.page_title'))

@section('content')

<style>
    /* =========================================================
       CONVERSATION CREATE
       Cream / Olive Green / Gold
    ========================================================= */

    .conversation-create-page {
        max-width: 900px;
        margin: 0 auto;
        padding: 40px 20px 70px;
        color: #30372a;
    }

    /* =========================================================
       HEADER
    ========================================================= */

    .conversation-create-header {
        margin-bottom: 30px;
    }

    .conversation-create-header-label {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #9a7b2f;
        font-size: 14px;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .conversation-create-header h1 {
        margin: 0 0 10px;
        font-size: 30px;
        font-weight: 800;
        color: #30372a;
    }

    .conversation-create-header p {
        margin: 0;
        color: #777;
        font-size: 15px;
        line-height: 1.8;
    }

    /* =========================================================
       CARD
    ========================================================= */

    .conversation-create-card {
        background: #fffdf8;
        border: 1px solid #e7dfc9;
        border-radius: 20px;
        box-shadow: 0 10px 35px rgba(48, 55, 42, 0.08);
        overflow: hidden;
    }

    .conversation-create-card-header {
        padding: 24px 28px;
        border-bottom: 1px solid #eee6d4;
        background: #faf7ee;
    }

    .conversation-create-card-header h2 {
        margin: 0;
        font-size: 19px;
        font-weight: 800;
        color: #30372a;
    }

    .conversation-create-card-header p {
        margin: 7px 0 0;
        color: #777;
        font-size: 14px;
    }

    /* =========================================================
       FORM
    ========================================================= */

    .conversation-create-form {
        padding: 30px 28px;
    }

    .conversation-form-group {
        margin-bottom: 24px;
    }

    .conversation-form-group:last-of-type {
        margin-bottom: 0;
    }

    .conversation-form-label {
        display: block;
        margin-bottom: 9px;
        font-size: 15px;
        font-weight: 700;
        color: #30372a;
    }

    .conversation-form-required {
        color: #a07d29;
        margin-inline-start: 3px;
    }

    .conversation-form-input,
    .conversation-form-textarea {
        width: 100%;
        box-sizing: border-box;
        border: 1px solid #dcd4c1;
        background: #fff;
        color: #30372a;
        border-radius: 12px;
        padding: 13px 15px;
        font-family: inherit;
        font-size: 15px;
        outline: none;
        transition:
            border-color 0.2s ease,
            box-shadow 0.2s ease,
            background 0.2s ease;
    }

    .conversation-form-input {
        height: 50px;
    }

    .conversation-form-textarea {
        min-height: 190px;
        resize: vertical;
        line-height: 1.9;
    }

    .conversation-form-input:focus,
    .conversation-form-textarea:focus {
        border-color: #9a7b2f;
        background: #fffefb;
        box-shadow: 0 0 0 4px rgba(154, 123, 47, 0.10);
    }

    .conversation-form-input::placeholder,
    .conversation-form-textarea::placeholder {
        color: #aaa;
    }

    /* =========================================================
       ERROR
    ========================================================= */

    .conversation-form-error {
        margin-top: 7px;
        color: #b44a4a;
        font-size: 13px;
        line-height: 1.6;
    }

    .conversation-form-input.has-error,
    .conversation-form-textarea.has-error {
        border-color: #c96b6b;
    }

    .conversation-create-errors {
        margin-bottom: 25px;
        padding: 16px 18px;
        border-radius: 12px;
        border: 1px solid #e7bcbc;
        background: #fff3f3;
        color: #8d3f3f;
    }

    .conversation-create-errors strong {
        display: block;
        margin-bottom: 8px;
        font-size: 14px;
    }

    .conversation-create-errors ul {
        margin: 0;
        padding-inline-start: 20px;
    }

    .conversation-create-errors li {
        margin-bottom: 4px;
        font-size: 13px;
    }

    .conversation-create-errors li:last-child {
        margin-bottom: 0;
    }

    /* =========================================================
       HINT
    ========================================================= */

    .conversation-form-hint {
        margin-top: 7px;
        color: #8a887e;
        font-size: 12px;
        line-height: 1.7;
    }

    /* =========================================================
       ACTIONS
    ========================================================= */

    .conversation-create-actions {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        margin-top: 30px;
        padding-top: 25px;
        border-top: 1px solid #eee6d4;
    }

    .conversation-back-button,
    .conversation-submit-button {
        min-height: 48px;
        border-radius: 12px;
        padding: 0 22px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        font-family: inherit;
        font-size: 14px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
        transition:
            transform 0.2s ease,
            box-shadow 0.2s ease,
            background 0.2s ease;
    }

    .conversation-back-button {
        color: #59604c;
        background: #f4f0e5;
        border: 1px solid #e1d9c7;
    }

    .conversation-back-button:hover {
        background: #ece6d8;
        transform: translateY(-1px);
    }

    .conversation-submit-button {
        border: 0;
        color: #fff;
        background: #596346;
        box-shadow: 0 7px 18px rgba(89, 99, 70, 0.20);
    }

    .conversation-submit-button:hover {
        background: #4b553b;
        transform: translateY(-1px);
        box-shadow: 0 9px 22px rgba(89, 99, 70, 0.25);
    }

    .conversation-submit-button i {
        font-size: 14px;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 700px) {

        .conversation-create-page {
            padding: 25px 14px 50px;
        }

        .conversation-create-header h1 {
            font-size: 25px;
        }

        .conversation-create-card-header,
        .conversation-create-form {
            padding: 22px 18px;
        }

        .conversation-create-actions {
            flex-direction: column-reverse;
            align-items: stretch;
        }

        .conversation-back-button,
        .conversation-submit-button {
            width: 100%;
        }
    }
</style>

<div
    class="conversation-create-page"
    dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}"
>
{{-- =========================================================
     PAGE HEADER
========================================================== --}}

<div class="conversation-create-header">

    <div class="conversation-create-header-label">
        <i class="fa-solid fa-comments"></i>
        {{ __('education.conversation_create_page.header.label') }}
    </div>

    <h1>
        {{ __('education.conversation_create_page.header.title') }}
    </h1>

    <p>
        {{ __('education.conversation_create_page.header.description') }}
    </p>

</div>


{{-- =========================================================
     CARD
========================================================== --}}

<div class="conversation-create-card">

    <div class="conversation-create-card-header">

        <h2>
            {{ __('education.conversation_create_page.card.title') }}
        </h2>

        <p>
            {{ __('education.conversation_create_page.card.description') }}
        </p>

    </div>


    {{-- =====================================================
         FORM
    ====================================================== --}}

    <form
        action="{{ route('education.conversations.store') }}"
        method="POST"
        class="conversation-create-form"
    >

        @csrf


        {{-- =================================================
             VALIDATION ERRORS
        ================================================== --}}

        @if ($errors->any())

            <div class="conversation-create-errors">

                <strong>
                    {{ __('education.conversation_create_page.validation.title') }}
                </strong>

                <ul>

                    @foreach ($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        {{-- =================================================
             SUBJECT
        ================================================== --}}

        <div class="conversation-form-group">

            <label
                for="subject"
                class="conversation-form-label"
            >
                {{ __('education.conversation_create_page.fields.subject.label') }}

                <span class="conversation-form-required">
                    *
                </span>
            </label>

            <input
                type="text"
                id="subject"
                name="subject"
                value="{{ old('subject') }}"
                class="conversation-form-input @error('subject') has-error @enderror"
                placeholder="{{ __('education.conversation_create_page.fields.subject.placeholder') }}"
                maxlength="255"
                required
            >

            @error('subject')

                <div class="conversation-form-error">
                    {{ $message }}
                </div>

            @enderror

            <div class="conversation-form-hint">
                {{ __('education.conversation_create_page.fields.subject.hint') }}
            </div>

        </div>


        {{-- =================================================
             MESSAGE
        ================================================== --}}

        <div class="conversation-form-group">

            <label
                for="message"
                class="conversation-form-label"
            >
                {{ __('education.conversation_create_page.fields.message.label') }}

                <span class="conversation-form-required">
                    *
                </span>
            </label>

            <textarea
                id="message"
                name="message"
                class="conversation-form-textarea @error('message') has-error @enderror"
                placeholder="{{ __('education.conversation_create_page.fields.message.placeholder') }}"
                maxlength="10000"
                required
            >{{ old('message') }}</textarea>

            @error('message')

                <div class="conversation-form-error">
                    {{ $message }}
                </div>

            @enderror

            <div class="conversation-form-hint">
                {{ __('education.conversation_create_page.fields.message.hint') }}
            </div>

        </div>


        {{-- =================================================
             ACTIONS
        ================================================== --}}

        <div class="conversation-create-actions">

            <a
                href="{{ route('education.conversations.index') }}"
                class="conversation-back-button"
            >
                <i class="fa-solid fa-arrow-right"></i>

                {{ __('education.conversation_create_page.actions.back') }}
            </a>


            <button
                type="submit"
                class="conversation-submit-button"
            >
                <i class="fa-solid fa-paper-plane"></i>

                {{ __('education.conversation_create_page.actions.submit') }}
            </button>

        </div>

    </form>

</div>

</div>

@endsection
