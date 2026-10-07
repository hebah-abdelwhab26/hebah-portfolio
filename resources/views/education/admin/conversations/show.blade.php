@extends('education.admin.layouts.app')

@section('title', __('education_admin.conversations_show.page_title'))

@section('content')

<style>
    /* =========================================================
       EDUCATION ADMIN CONVERSATION SHOW
       Cream / Olive Green / Gold
    ========================================================= */

    .education-admin-conversation-show {
        direction: rtl;
        color: #30372a;
        padding-bottom: 50px;
    }

    /* =========================================================
       HEADER
    ========================================================= */

    .education-conversation-show-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 25px;
    }

    .education-conversation-show-heading {
        min-width: 0;
    }

    .education-conversation-show-back {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        margin-bottom: 12px;
        color: #858276;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
    }

    .education-conversation-show-back:hover {
        color: #9a7b2f;
    }

    .education-conversation-show-label {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #9a7b2f;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 7px;
    }

    .education-conversation-show-heading h1 {
        margin: 0;
        color: #30372a;
        font-size: 27px;
        font-weight: 800;
        line-height: 1.5;
    }

    .education-conversation-show-id {
        display: block;
        margin-top: 5px;
        color: #aaa598;
        font-size: 11px;
        direction: ltr;
        text-align: right;
    }

    /* =========================================================
       HEADER ACTIONS
    ========================================================= */

    .education-conversation-show-actions {
        display: flex;
        align-items: center;
        gap: 9px;
        flex-wrap: wrap;
    }

    .education-conversation-action-button {
        min-height: 40px;
        padding: 0 14px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        font-family: inherit;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .education-conversation-action-close {
        color: #805d57;
        background: #f8efed;
        border: 1px solid #e8d4d0;
    }

    .education-conversation-action-close:hover {
        background: #f1e3df;
    }

    .education-conversation-action-reopen {
        color: #4d643f;
        background: #edf5e9;
        border: 1px solid #d3e3ca;
    }

    .education-conversation-action-reopen:hover {
        background: #e1eedc;
    }

    /* =========================================================
       ALERTS
    ========================================================= */

    .education-conversation-alert {
        margin-bottom: 20px;
        padding: 14px 17px;
        border-radius: 12px;
        font-size: 14px;
        line-height: 1.7;
    }

    .education-conversation-alert-success {
        color: #3f603d;
        background: #eef6eb;
        border: 1px solid #cfe2c8;
    }

    .education-conversation-alert-error {
        color: #8a4444;
        background: #fff1f1;
        border: 1px solid #ebcaca;
    }

    /* =========================================================
       LAYOUT
    ========================================================= */

    .education-conversation-show-layout {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 290px;
        gap: 20px;
        align-items: start;
    }

    /* =========================================================
       CARDS
    ========================================================= */

    .education-conversation-messages-card,
    .education-conversation-info-card,
    .education-conversation-reply-card {
        background: #fffdf8;
        border: 1px solid #e6deca;
        border-radius: 18px;
        box-shadow: 0 8px 28px rgba(48, 55, 42, 0.06);
    }

    .education-conversation-messages-card {
        overflow: hidden;
    }

    .education-conversation-card-title {
        padding: 19px 22px;
        background: #faf7ee;
        border-bottom: 1px solid #e9e1cf;
    }

    .education-conversation-card-title h2 {
        margin: 0;
        font-size: 16px;
        font-weight: 800;
        color: #30372a;
    }

    /* =========================================================
       MESSAGES
    ========================================================= */

    .education-conversation-messages {
        padding: 25px;
        max-height: 650px;
        overflow-y: auto;
    }

    .education-conversation-message {
        display: flex;
        margin-bottom: 18px;
    }

    .education-conversation-message:last-child {
        margin-bottom: 0;
    }

    .education-conversation-message-admin {
        justify-content: flex-start;
    }

    .education-conversation-message-student {
        justify-content: flex-end;
    }

    .education-conversation-message-bubble-wrapper {
        max-width: 78%;
    }

    .education-conversation-message-bubble {
        padding: 13px 16px;
        border-radius: 15px;
        line-height: 1.85;
        font-size: 13px;
        word-break: break-word;
    }

    .education-conversation-message-admin
    .education-conversation-message-bubble {
        background: #596346;
        color: #fff;
        border-bottom-left-radius: 5px;
    }

    .education-conversation-message-student
    .education-conversation-message-bubble {
        background: #f1eee5;
        color: #414637;
        border: 1px solid #e1dac8;
        border-bottom-right-radius: 5px;
    }

    .education-conversation-message-meta {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-top: 6px;
        color: #9b978b;
        font-size: 10px;
    }

    .education-conversation-message-admin
    .education-conversation-message-meta {
        justify-content: flex-start;
    }

    .education-conversation-message-student
    .education-conversation-message-meta {
        justify-content: flex-end;
    }

    .education-conversation-message-sender {
        font-weight: 800;
    }

    /* =========================================================
       ATTACHMENT
    ========================================================= */

    .education-conversation-attachment {
        margin-top: 10px;
        padding-top: 10px;
        border-top: 1px solid rgba(255,255,255,0.18);
    }

    .education-conversation-message-student
    .education-conversation-attachment {
        border-top-color: #ddd5c2;
    }

    .education-conversation-attachment-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 11px;
        border-radius: 9px;
        color: inherit;
        background: rgba(255,255,255,0.08);
        text-decoration: none;
        font-size: 11px;
    }

    .education-conversation-message-student
    .education-conversation-attachment-link {
        background: #e8e3d7;
    }

    .education-conversation-attachment-link:hover {
        opacity: 0.8;
    }

    .education-conversation-attachment-name {
        max-width: 220px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    /* =========================================================
       EMPTY MESSAGES
    ========================================================= */

    .education-conversation-messages-empty {
        padding: 60px 20px;
        text-align: center;
        color: #989488;
    }

    .education-conversation-messages-empty i {
        display: block;
        margin-bottom: 12px;
        font-size: 30px;
        color: #b0a67f;
    }

    /* =========================================================
       REPLY
    ========================================================= */

    .education-conversation-reply-card {
        margin-top: 20px;
        overflow: hidden;
    }

    .education-conversation-reply-form {
        padding: 22px;
    }

    .education-conversation-reply-textarea {
        display: block;
        width: 100%;
        min-height: 130px;
        box-sizing: border-box;
        resize: vertical;
        padding: 13px 15px;
        border: 1px solid #dcd4c1;
        border-radius: 12px;
        background: #fff;
        color: #30372a;
        font-family: inherit;
        font-size: 13px;
        line-height: 1.9;
        outline: none;
        transition: all 0.2s ease;
    }

    .education-conversation-reply-textarea:focus {
        border-color: #9a7b2f;
        box-shadow: 0 0 0 4px rgba(154, 123, 47, 0.10);
    }

    .education-conversation-reply-file {
        margin-top: 13px;
        width: 100%;
        box-sizing: border-box;
        padding: 10px;
        border: 1px dashed #d7ceba;
        border-radius: 10px;
        background: #faf8f1;
        color: #777568;
        font-family: inherit;
        font-size: 12px;
    }

    .education-conversation-reply-actions {
        display: flex;
        justify-content: flex-start;
        margin-top: 15px;
    }

    .education-conversation-send-button {
        min-height: 43px;
        padding: 0 18px;
        border: 0;
        border-radius: 10px;
        color: #fff;
        background: #596346;
        font-family: inherit;
        font-size: 13px;
        font-weight: 800;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s ease;
    }

    .education-conversation-send-button:hover {
        background: #4d573d;
        transform: translateY(-1px);
    }

    /* =========================================================
       CLOSED NOTICE
    ========================================================= */

    .education-conversation-closed-notice {
        padding: 22px;
        text-align: center;
        color: #806d68;
        background: #faf3f0;
        border-top: 1px solid #eadbd6;
        font-size: 13px;
        line-height: 1.8;
    }

    .education-conversation-closed-notice i {
        margin-left: 5px;
    }

    /* =========================================================
       INFO CARD
    ========================================================= */

    .education-conversation-info-card {
        overflow: hidden;
    }

    .education-conversation-info-body {
        padding: 20px;
    }

    .education-conversation-info-student {
        display: flex;
        align-items: center;
        gap: 12px;
        padding-bottom: 18px;
        margin-bottom: 18px;
        border-bottom: 1px solid #eee8da;
    }

    .education-conversation-info-avatar {
        width: 45px;
        height: 45px;
        flex: 0 0 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #e9ece0;
        color: #596346;
        font-size: 17px;
    }

    .education-conversation-info-student-name {
        display: block;
        color: #30372a;
        font-weight: 800;
        font-size: 14px;
    }

    .education-conversation-info-student-email {
        display: block;
        margin-top: 3px;
        color: #969286;
        font-size: 11px;
        direction: ltr;
        text-align: right;
        word-break: break-all;
    }

    .education-conversation-info-row {
        margin-bottom: 16px;
    }

    .education-conversation-info-row:last-child {
        margin-bottom: 0;
    }

    .education-conversation-info-label {
        display: block;
        margin-bottom: 5px;
        color: #999487;
        font-size: 11px;
    }

    .education-conversation-info-value {
        display: block;
        color: #414637;
        font-size: 12px;
        line-height: 1.7;
    }

    .education-conversation-info-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 9px;
        border-radius: 999px;
        font-size: 10px;
        font-weight: 800;
    }

    .education-conversation-info-status-open {
        color: #4d643f;
        background: #edf5e9;
    }

    .education-conversation-info-status-closed {
        color: #805d57;
        background: #f8efed;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 900px) {

        .education-conversation-show-layout {
            grid-template-columns: 1fr;
        }

        .education-conversation-info-card {
            order: -1;
        }
    }

    @media (max-width: 700px) {

        .education-conversation-show-header {
            flex-direction: column;
        }

        .education-conversation-show-heading h1 {
            font-size: 23px;
        }

        .education-conversation-show-actions {
            width: 100%;
        }

        .education-conversation-action-button {
            flex: 1;
        }

        .education-conversation-messages {
            padding: 18px;
        }

        .education-conversation-message-bubble-wrapper {
            max-width: 90%;
        }
    }
</style>

<div class="education-admin-conversation-show">

{{-- =========================================================
     HEADER
========================================================== --}}

<div class="education-conversation-show-header">

    <div class="education-conversation-show-heading">

        <a
            href="{{ route('education.admin.conversations.index') }}"
            class="education-conversation-show-back"
        >
            <i class="fa-solid fa-arrow-right"></i>
            {{ __('education_admin.conversations_show.back_to_conversations') }}
        </a>

        <div class="education-conversation-show-label">
            <i class="fa-solid fa-comments"></i>
            {{ __('education_admin.conversations_show.educational_conversation') }}
        </div>

        <h1>
            {{ $conversation->subject ?? $conversation->title ?? __('education_admin.conversations_show.untitled_conversation') }}
        </h1>

        <span class="education-conversation-show-id">
            {{ __('education_admin.conversations_show.conversation_id', ['id' => $conversation->id]) }}
        </span>

    </div>


    {{-- =====================================================
         ACTIONS
    ====================================================== --}}

    <div class="education-conversation-show-actions">

        @if (($conversation->status ?? 'open') === 'closed')

            <form
                action="{{ route('education.admin.conversations.reopen', $conversation) }}"
                method="POST"
            >

                @csrf

                <button
                    type="submit"
                    class="education-conversation-action-button education-conversation-action-reopen"
                >
                    <i class="fa-solid fa-lock-open"></i>
                    {{ __('education_admin.conversations_show.reopen_conversation') }}
                </button>

            </form>

        @else

            <form
                action="{{ route('education.admin.conversations.close', $conversation) }}"
                method="POST"
                onsubmit="return confirm(@json(__('education_admin.conversations_show.close_confirmation')));"
            >

                @csrf

                <button
                    type="submit"
                    class="education-conversation-action-button education-conversation-action-close"
                >
                    <i class="fa-solid fa-lock"></i>
                    {{ __('education_admin.conversations_show.close_conversation') }}
                </button>

            </form>

        @endif

    </div>

</div>


{{-- =========================================================
     ALERTS
========================================================== --}}

@if (session('success'))

    <div class="education-conversation-alert education-conversation-alert-success">

        <i class="fa-solid fa-circle-check"></i>

        {{ session('success') }}

    </div>

@endif


@if (session('error'))

    <div class="education-conversation-alert education-conversation-alert-error">

        <i class="fa-solid fa-circle-exclamation"></i>

        {{ session('error') }}

    </div>

@endif


{{-- =========================================================
     VALIDATION ERRORS
========================================================== --}}

@if ($errors->any())

    <div class="education-conversation-alert education-conversation-alert-error">

        <i class="fa-solid fa-circle-exclamation"></i>

        <ul style="margin: 0; padding-right: 20px;">

            @foreach ($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

@endif


{{-- =========================================================
     MAIN LAYOUT
========================================================== --}}

<div class="education-conversation-show-layout">


    {{-- =====================================================
         LEFT / MAIN
    ====================================================== --}}

    <div>


        {{-- =================================================
             MESSAGES
        ================================================== --}}

        <div class="education-conversation-messages-card">

            <div class="education-conversation-card-title">

                <h2>
                    {{ __('education_admin.conversations_show.messages') }}
                </h2>

            </div>


            @if ($messages->isNotEmpty())

                <div class="education-conversation-messages">

                    @foreach ($messages as $message)

                        @php
                            $isAdmin = $message->sender_type === 'education_admin';
                        @endphp

                        <div
                            class="education-conversation-message
                            {{ $isAdmin
                                ? 'education-conversation-message-admin'
                                : 'education-conversation-message-student'
                            }}"
                        >

                            <div class="education-conversation-message-bubble-wrapper">

                                <div class="education-conversation-message-bubble">

                                    @if ($message->message)

                                        {!! nl2br(e($message->message)) !!}

                                    @endif


                                    @if ($message->attachment)

                                        <div class="education-conversation-attachment">

                                            <a
                                                href="{{ asset('storage/' . $message->attachment) }}"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="education-conversation-attachment-link"
                                            >

                                                <i class="fa-solid fa-paperclip"></i>

                                                <span class="education-conversation-attachment-name">
                                                    {{ $message->attachment_name ?? __('education_admin.conversations_show.view_attachment') }}
                                                </span>

                                            </a>

                                        </div>

                                    @endif

                                </div>


                                <div class="education-conversation-message-meta">

                                    <span class="education-conversation-message-sender">

                                        {{ $isAdmin
                                            ? __('education_admin.conversations_show.admin')
                                            : ($conversation->educationUser?->name ?? __('education_admin.conversations_show.student'))
                                        }}

                                    </span>

                                    <span>
                                        •
                                    </span>

                                    <span>
                                        {{ $message->created_at?->locale(session('education_locale', 'ar'))->translatedFormat('Y-m-d H:i') }}
                                    </span>

                                    @if ($message->read_at)

                                        <span>
                                            •
                                        </span>

                                        <span>
                                            {{ __('education_admin.conversations_show.read') }}
                                        </span>

                                    @endif

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                <div class="education-conversation-messages-empty">

                    <i class="fa-regular fa-comments"></i>

                    {{ __('education_admin.conversations_show.no_messages') }}

                </div>

            @endif

        </div>


        {{-- =================================================
             REPLY
        ================================================== --}}

        <div class="education-conversation-reply-card">

            @if (($conversation->status ?? 'open') !== 'closed')

                <div class="education-conversation-card-title">

                    <h2>
                        {{ __('education_admin.conversations_show.send_reply') }}
                    </h2>

                </div>


                {{-- =================================================
                     CORRECT ROUTE
                ================================================== --}}

                <form
                    action="{{ route('education.admin.conversations.messages.store', $conversation) }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="education-conversation-reply-form"
                >

                    @csrf


                    <textarea
                        name="message"
                        class="education-conversation-reply-textarea"
                        placeholder="{{ __('education_admin.conversations_show.reply_placeholder') }}"
                        maxlength="5000"
                    >{{ old('message') }}</textarea>


                    <input
                        type="file"
                        name="attachment"
                        class="education-conversation-reply-file"
                    >


                    <div class="education-conversation-reply-actions">

                        <button
                            type="submit"
                            class="education-conversation-send-button"
                        >

                            <i class="fa-solid fa-paper-plane"></i>

                            {{ __('education_admin.conversations_show.send_message') }}

                        </button>

                    </div>

                </form>

            @else

                <div class="education-conversation-closed-notice">

                    <i class="fa-solid fa-lock"></i>

                    {{ __('education_admin.conversations_show.closed_notice') }}

                </div>

            @endif

        </div>

    </div>


    {{-- =====================================================
         SIDEBAR
    ====================================================== --}}

    <aside>

        <div class="education-conversation-info-card">

            <div class="education-conversation-card-title">

                <h2>
                    {{ __('education_admin.conversations_show.conversation_information') }}
                </h2>

            </div>


            <div class="education-conversation-info-body">


                {{-- STUDENT --}}

                <div class="education-conversation-info-student">

                    <div class="education-conversation-info-avatar">

                        <i class="fa-solid fa-user"></i>

                    </div>

                    <div>

                        <span class="education-conversation-info-student-name">
                            {{ $conversation->educationUser?->name ?? __('education_admin.conversations_show.unknown_student') }}
                        </span>

                        @if ($conversation->educationUser?->email)

                            <span class="education-conversation-info-student-email">
                                {{ $conversation->educationUser->email }}
                            </span>

                        @endif

                    </div>

                </div>


                {{-- STATUS --}}

                <div class="education-conversation-info-row">

                    <span class="education-conversation-info-label">
                        {{ __('education_admin.conversations_show.status') }}
                    </span>

                    @if (($conversation->status ?? 'open') === 'closed')

                        <span class="education-conversation-info-status education-conversation-info-status-closed">

                            <i class="fa-solid fa-lock"></i>

                            {{ __('education_admin.conversations_show.closed') }}

                        </span>

                    @else

                        <span class="education-conversation-info-status education-conversation-info-status-open">

                            <i class="fa-solid fa-circle"></i>

                            {{ __('education_admin.conversations_show.open') }}

                        </span>

                    @endif

                </div>


                {{-- CREATED --}}

                <div class="education-conversation-info-row">

                    <span class="education-conversation-info-label">
                        {{ __('education_admin.conversations_show.created_at') }}
                    </span>

                    <span class="education-conversation-info-value">
                        {{ $conversation->created_at?->locale(session('education_locale', 'ar'))->translatedFormat('Y-m-d H:i') }}
                    </span>

                </div>


                {{-- LAST MESSAGE --}}

                <div class="education-conversation-info-row">

                    <span class="education-conversation-info-label">
                        {{ __('education_admin.conversations_show.last_message') }}
                    </span>

                    <span class="education-conversation-info-value">

                        @if ($conversation->last_message_at)

                            {{ $conversation->last_message_at->locale(session('education_locale', 'ar'))->translatedFormat('Y-m-d H:i') }}

                        @else

                            {{ __('education_admin.conversations_show.none') }}

                        @endif

                    </span>

                </div>


                {{-- MESSAGE COUNT --}}

                <div class="education-conversation-info-row">

                    <span class="education-conversation-info-label">
                        {{ __('education_admin.conversations_show.message_count') }}
                    </span>

                    <span class="education-conversation-info-value">
                        {{ $messages->count() }}
                    </span>

                </div>

            </div>

        </div>

    </aside>

</div>

</div>

@endsection
