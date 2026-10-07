@extends('education.admin.layouts.app')

@section('title', __('education_admin.contact_messages_show.page_title'))

@section('content')

<style>

    .contact-show-page {
        direction: rtl;
        width: 100%;
        padding: 24px;
        background: #f5f6f2;
        min-height: calc(100vh - 70px);

        color: #29332c;
    }

    /* =========================================================
       HEADER
    ========================================================= */

    .cs-header {
        background: #ffffff;

        border: 1px solid #e4e8e1;
        border-radius: 18px;

        padding: 18px 22px;

        margin-bottom: 18px;

        box-shadow: 0 4px 18px rgba(40,52,43,.045);
    }

    .cs-header-main {
        display: flex;
        align-items: center;
        gap: 13px;
    }

    .cs-header-icon {
        width: 50px;
        height: 50px;

        border-radius: 14px;

        display: flex;
        align-items: center;
        justify-content: center;

        background: #edf3ee;
        color: #496b52;

        font-size: 20px;
    }

    .cs-title {
        margin: 0;

        color: #29342d;

        font-size: 21px;
        font-weight: 800;
    }

    .cs-description {
        margin: 3px 0 0;

        color: #89918b;

        font-size: 11px;
    }

    .cs-header-actions {
        display: flex;
        align-items: center;
        gap: 7px;
    }

    .cs-back-btn,
    .cs-delete-btn {
        border-radius: 9px;

        padding: 8px 12px;

        font-size: 11px;
        font-weight: 700;
    }


    /* =========================================================
       MAIN GRID
    ========================================================= */

    .cs-layout {
        display: grid;

        grid-template-columns:
            minmax(260px, 320px)
            minmax(0, 1fr);

        gap: 18px;

        align-items: start;
    }


    /* =========================================================
       CARD
    ========================================================= */

    .cs-card {
        background: #ffffff;

        border: 1px solid #e4e8e1;
        border-radius: 18px;

        overflow: hidden;

        box-shadow: 0 4px 20px rgba(40,52,43,.045);
    }

    .cs-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 10px;

        padding: 15px 18px;

        border-bottom: 1px solid #edf0eb;
    }

    .cs-card-title {
        margin: 0;

        color: #303a34;

        font-size: 14px;
        font-weight: 800;
    }

    .cs-card-title i {
        color: #496b52;
        margin-left: 6px;
    }

    .cs-card-body {
        padding: 18px;
    }


    /* =========================================================
       SENDER
    ========================================================= */

    .cs-profile {
        text-align: center;

        padding-bottom: 17px;

        border-bottom: 1px solid #edf0eb;
    }

    .cs-avatar {
        width: 72px;
        height: 72px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        border-radius: 20px;

        background: #edf3ee;
        color: #496b52;

        font-size: 25px;

        margin-bottom: 10px;
    }

    .cs-name {
        color: #29342d;

        font-size: 16px;
        font-weight: 800;
    }

    .cs-role {
        color: #9aa19c;

        font-size: 10px;

        margin-top: 2px;
    }


    /* =========================================================
       INFO
    ========================================================= */

    .cs-info {
        margin-top: 12px;
    }

    .cs-info-item {
        display: flex;

        align-items: flex-start;

        gap: 10px;

        padding: 11px 0;

        border-bottom: 1px solid #f0f2ef;
    }

    .cs-info-item:last-child {
        border-bottom: 0;
    }

    .cs-info-icon {
        width: 32px;
        height: 32px;

        border-radius: 9px;

        display: flex;
        align-items: center;
        justify-content: center;

        flex-shrink: 0;

        background: #f3f5f2;
        color: #496b52;

        font-size: 11px;
    }

    .cs-info-label {
        color: #9aa19c;

        font-size: 9px;

        margin-bottom: 3px;
    }

    .cs-info-value {
        color: #404a43;

        font-size: 11px;
        font-weight: 600;

        overflow-wrap: anywhere;
    }

    .cs-info-value a {
        color: #496b52;
        text-decoration: none;
    }

    .cs-info-value a:hover {
        text-decoration: underline;
    }


    /* =========================================================
       STATUS
    ========================================================= */

    .cs-status {
        display: inline-flex;
        align-items: center;
        gap: 5px;

        border-radius: 7px;

        padding: 5px 8px;

        font-size: 9px;
        font-weight: 800;
    }

    .cs-status-new {
        background: #fff2d3;
        color: #9c7429;
    }

    .cs-status-read {
        background: #e8f4f7;
        color: #337e92;
    }

    .cs-status-replied {
        background: #e7f3e9;
        color: #3f7d4d;
    }


    /* =========================================================
       ACTIONS
    ========================================================= */

    .cs-actions {
        margin-top: 18px;
    }

    .cs-action-btn {
        width: 100%;

        border-radius: 9px;

        padding: 9px 12px;

        font-size: 11px;
        font-weight: 700;

        margin-bottom: 7px;
    }

    .cs-action-reply {
        background: #496b52;
        border: 1px solid #496b52;
        color: #fff;
    }

    .cs-action-reply:hover {
        background: #36533d;
        border-color: #36533d;
        color: #fff;
    }

    .cs-action-email {
        background: #fff;
        border: 1px solid #dfe4de;
        color: #59645d;
    }

    .cs-action-email:hover {
        background: #f3f6f3;
        color: #496b52;
    }

    .cs-action-reopen {
        background: #fff;
        border: 1px solid #d9e4dc;
        color: #496b52;
    }

    .cs-action-reopen:hover {
        background: #edf3ee;
    }


    /* =========================================================
       MESSAGE CONTENT
    ========================================================= */

    .cs-message-header {
        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 10px;
    }

    .cs-subject-block {
        padding-bottom: 18px;

        border-bottom: 1px solid #edf0eb;
    }

    .cs-label {
        color: #969e98;

        font-size: 10px;

        margin-bottom: 7px;
    }

    .cs-subject {
        color: #29342d;

        font-size: 20px;
        font-weight: 800;

        line-height: 1.6;

        overflow-wrap: anywhere;
    }

    .cs-message-wrapper {
        margin-top: 20px;
    }

    .cs-message {
        background: #f8f9f7;

        border: 1px solid #e8ebe6;

        border-radius: 14px;

        padding: 20px;

        min-height: 300px;

        color: #465149;

        font-size: 13px;

        line-height: 2.1;

        white-space: pre-wrap;

        overflow-wrap: anywhere;
    }

    .cs-reply-area {
        margin-top: 18px;
    }

    .cs-email-reply {
        display: inline-flex;
        align-items: center;
        gap: 6px;

        border-radius: 9px;

        background: #496b52;
        border: 1px solid #496b52;

        color: #fff;

        padding: 9px 14px;

        font-size: 11px;
        font-weight: 700;

        text-decoration: none;
    }

    .cs-email-reply:hover {
        background: #36533d;
        border-color: #36533d;
        color: #fff;
    }


    /* =========================================================
       META
    ========================================================= */

    .cs-meta {
        margin-top: 15px;

        padding-top: 12px;

        border-top: 1px solid #edf0eb;

        color: #8c948e;

        font-size: 9px;
    }

    .cs-meta div {
        margin-bottom: 5px;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 900px) {

        .cs-layout {
            grid-template-columns: 1fr;
        }

    }

    @media (max-width: 650px) {

        .contact-show-page {
            padding: 14px;
        }

        .cs-header {
            padding: 15px;
        }

        .cs-header-actions {
            width: 100%;
        }

        .cs-header-actions .btn,
        .cs-header-actions form {
            flex: 1;
        }

        .cs-title {
            font-size: 18px;
        }

        .cs-subject {
            font-size: 17px;
        }

    }

</style>

<div class="contact-show-page">

{{-- =====================================================
     HEADER
====================================================== --}}

<div class="cs-header">

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">

        <div class="cs-header-main">

            <div class="cs-header-icon">

                <i class="fas fa-envelope-open-text"></i>

            </div>

            <div>

                <h1 class="cs-title">
                    {{ __('education_admin.contact_messages_show.title') }}
                </h1>

                <p class="cs-description">
                    {{ __('education_admin.contact_messages_show.description') }}
                </p>

            </div>

        </div>


        <div class="cs-header-actions">

            <a href="{{ route('education.admin.contact-messages.index') }}"
               class="btn btn-outline-secondary cs-back-btn">

                <i class="fas fa-arrow-right me-1"></i>

                {{ __('education_admin.contact_messages_show.back') }}

            </a>


            <form action="{{ route('education.admin.contact-messages.destroy', $contactMessage) }}"
                  method="POST"
                  onsubmit="return confirm(@json(__('education_admin.contact_messages_show.delete_confirmation')));">

                @csrf

                @method('DELETE')

                <button type="submit"
                        class="btn btn-danger cs-delete-btn">

                    <i class="fas fa-trash me-1"></i>

                    {{ __('education_admin.contact_messages_show.delete') }}

                </button>

            </form>

        </div>

    </div>

</div>


{{-- =====================================================
     ALERTS
====================================================== --}}

@if(session('success'))

    <div class="alert alert-success alert-dismissible fade show"
         role="alert">

        <i class="fas fa-circle-check me-2"></i>

        {{ session('success') }}

        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="{{ __('education_admin.contact_messages_show.close') }}"></button>

    </div>

@endif


@if(session('error'))

    <div class="alert alert-danger alert-dismissible fade show"
         role="alert">

        <i class="fas fa-circle-exclamation me-2"></i>

        {{ session('error') }}

        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="{{ __('education_admin.contact_messages_show.close') }}"></button>

    </div>

@endif


{{-- =====================================================
     CONTENT
====================================================== --}}

<div class="cs-layout">


    {{-- =================================================
         SENDER
    ================================================== --}}

    <div>

        <div class="cs-card">

            <div class="cs-card-header">

                <h2 class="cs-card-title">

                    <i class="fas fa-user"></i>

                    {{ __('education_admin.contact_messages_show.sender_data') }}

                </h2>

            </div>


            <div class="cs-card-body">

                <div class="cs-profile">

                    <div class="cs-avatar">

                        <i class="fas fa-user"></i>

                    </div>

                    <div class="cs-name">

                        {{ $contactMessage->name }}

                    </div>

                    <div class="cs-role">

                        {{ __('education_admin.contact_messages_show.sender_role') }}

                    </div>

                </div>


                <div class="cs-info">

                    {{-- Email --}}
                    <div class="cs-info-item">

                        <div class="cs-info-icon">

                            <i class="fas fa-envelope"></i>

                        </div>

                        <div>

                            <div class="cs-info-label">
                                {{ __('education_admin.contact_messages_show.email') }}
                            </div>

                            <div class="cs-info-value">

                                <a href="mailto:{{ $contactMessage->email }}">

                                    {{ $contactMessage->email }}

                                </a>

                            </div>

                        </div>

                    </div>


                    {{-- Subject --}}
                    <div class="cs-info-item">

                        <div class="cs-info-icon">

                            <i class="fas fa-heading"></i>

                        </div>

                        <div>

                            <div class="cs-info-label">
                                {{ __('education_admin.contact_messages_show.subject') }}
                            </div>

                            <div class="cs-info-value">

                                {{ $contactMessage->subject }}

                            </div>

                        </div>

                    </div>


                    {{-- Date --}}
                    <div class="cs-info-item">

                        <div class="cs-info-icon">

                            <i class="far fa-calendar"></i>

                        </div>

                        <div>

                            <div class="cs-info-label">
                                {{ __('education_admin.contact_messages_show.sent_at') }}
                            </div>

                            <div class="cs-info-value">

                                {{ $contactMessage->created_at?->locale(session('education_locale', 'ar'))->translatedFormat('Y-m-d H:i') }}

                            </div>

                        </div>

                    </div>


                    {{-- Status --}}
                    <div class="cs-info-item">

                        <div class="cs-info-icon">

                            <i class="fas fa-circle-info"></i>

                        </div>

                        <div>

                            <div class="cs-info-label">
                                {{ __('education_admin.contact_messages_show.message_status') }}
                            </div>

                            <div class="cs-info-value">

                                @switch($contactMessage->status)

                                    @case('new')

                                        <span class="cs-status cs-status-new">

                                            <i class="fas fa-envelope"></i>

                                            {{ __('education_admin.contact_messages_show.status_new') }}

                                        </span>

                                        @break

                                    @case('read')

                                        <span class="cs-status cs-status-read">

                                            <i class="fas fa-envelope-open"></i>

                                            {{ __('education_admin.contact_messages_show.status_read') }}

                                        </span>

                                        @break

                                    @case('replied')

                                        <span class="cs-status cs-status-replied">

                                            <i class="fas fa-reply"></i>

                                            {{ __('education_admin.contact_messages_show.status_replied') }}

                                        </span>

                                        @break

                                    @default

                                        <span class="badge bg-secondary">

                                            {{ $contactMessage->status }}

                                        </span>

                                @endswitch

                            </div>

                        </div>

                    </div>

                </div>


                {{-- Meta --}}

                <div class="cs-meta">

                    @if($contactMessage->read_at)

                        <div>

                            <i class="fas fa-eye me-1"></i>

                            {{ __('education_admin.contact_messages_show.read_at') }}:
                            {{ $contactMessage->read_at?->locale(session('education_locale', 'ar'))->translatedFormat('Y-m-d H:i') }}

                        </div>

                    @endif


                    @if($contactMessage->replied_at)

                        <div>

                            <i class="fas fa-reply me-1"></i>

                            {{ __('education_admin.contact_messages_show.replied_at') }}:
                            {{ $contactMessage->replied_at?->locale(session('education_locale', 'ar'))->translatedFormat('Y-m-d H:i') }}

                        </div>

                    @endif

                </div>

            </div>

        </div>


        {{-- =================================================
             ACTIONS
        ================================================== --}}

        <div class="cs-card cs-actions">

            <div class="cs-card-header">

                <h2 class="cs-card-title">

                    <i class="fas fa-sliders"></i>

                    {{ __('education_admin.contact_messages_show.message_actions') }}

                </h2>

            </div>


            <div class="cs-card-body">

                @if($contactMessage->status !== 'replied')

                    <form action="{{ route('education.admin.contact-messages.replied', $contactMessage) }}"
                          method="POST">

                        @csrf

                        @method('PATCH')

                        <button type="submit"
                                class="btn cs-action-btn cs-action-reply">

                            <i class="fas fa-reply me-1"></i>

                            {{ __('education_admin.contact_messages_show.mark_replied') }}

                        </button>

                    </form>

                @endif


                @if($contactMessage->status === 'replied')

                    <form action="{{ route('education.admin.contact-messages.reopen', $contactMessage) }}"
                          method="POST">

                        @csrf

                        @method('PATCH')

                        <button type="submit"
                                class="btn cs-action-btn cs-action-reopen">

                            <i class="fas fa-folder-open me-1"></i>

                            {{ __('education_admin.contact_messages_show.reopen') }}

                        </button>

                    </form>

                @endif


                <a href="mailto:{{ $contactMessage->email }}"
                   class="btn cs-action-btn cs-action-email">

                    <i class="fas fa-paper-plane me-1"></i>

                    {{ __('education_admin.contact_messages_show.reply_by_email') }}

                </a>

            </div>

        </div>

    </div>


    {{-- =================================================
         MESSAGE
    ================================================== --}}

    <div class="cs-card">

        <div class="cs-card-header">

            <div class="cs-message-header">

                <h2 class="cs-card-title">

                    <i class="fas fa-comment-dots"></i>

                    {{ __('education_admin.contact_messages_show.message_content') }}

                </h2>

            </div>


            @switch($contactMessage->status)

                @case('new')

                    <span class="cs-status cs-status-new">

                        <i class="fas fa-envelope"></i>

                        {{ __('education_admin.contact_messages_show.status_new') }}

                    </span>

                    @break

                @case('read')

                    <span class="cs-status cs-status-read">

                        <i class="fas fa-envelope-open"></i>

                        {{ __('education_admin.contact_messages_show.status_read') }}

                    </span>

                    @break

                @case('replied')

                    <span class="cs-status cs-status-replied">

                        <i class="fas fa-reply"></i>

                        {{ __('education_admin.contact_messages_show.status_replied') }}

                    </span>

                    @break

            @endswitch

        </div>


        <div class="cs-card-body">

            {{-- Subject --}}
            <div class="cs-subject-block">

                <div class="cs-label">

                    <i class="fas fa-heading me-1"></i>

                    {{ __('education_admin.contact_messages_show.message_subject') }}

                </div>

                <div class="cs-subject">

                    {{ $contactMessage->subject }}

                </div>

            </div>


            {{-- Message --}}
            <div class="cs-message-wrapper">

                <div class="cs-label">

                    <i class="fas fa-align-right me-1"></i>

                    {{ __('education_admin.contact_messages_show.message_text') }}

                </div>


                <div class="cs-message">

                    {{ $contactMessage->message }}

                </div>

            </div>


            {{-- Reply --}}
            <div class="cs-reply-area">

                <a href="mailto:{{ $contactMessage->email }}"
                   class="cs-email-reply">

                    <i class="fas fa-paper-plane"></i>

                    {{ __('education_admin.contact_messages_show.reply_to') }}
                    {{ $contactMessage->name }}

                </a>

            </div>

        </div>

    </div>

</div>

</div>

@endsection
