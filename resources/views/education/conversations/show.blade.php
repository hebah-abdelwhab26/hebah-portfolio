@extends('education.layouts.app')

@section('title', __('education.conversation_show_page.page_title'))

@section('content')

<style>
    .education-conversation-show-page {
        padding: 30px 0 50px;
        color: #30372a;
    }

    .education-conversation-container {
        width: min(1000px, calc(100% - 30px));
        margin: 0 auto;
    }

    .education-conversation-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        padding: 20px 24px;
        margin-bottom: 18px;
        background: #f7f1e3;
        border: 1px solid rgba(176, 145, 68, .25);
        border-radius: 18px;
    }

    .education-conversation-header-main {
        display: flex;
        align-items: center;
        gap: 14px;
        min-width: 0;
    }

    .education-conversation-header-icon {
        width: 48px;
        height: 48px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 13px;
        background: #30372a;
        color: #d4af5a;
        font-size: 19px;
    }

    .education-conversation-header-info {
        min-width: 0;
    }

    .education-conversation-header-info h1 {
        margin: 0 0 6px;
        font-size: 20px;
        font-weight: 800;
        color: #30372a;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .education-conversation-header-info p {
        margin: 0;
        color: #7d796a;
        font-size: 12px;
    }

    .education-conversation-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin-top: 7px;
        padding: 4px 9px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
    }

    .education-conversation-status.open {
        background: #e8f2e3;
        color: #4d7040;
    }

    .education-conversation-status.closed {
        background: #ebe8e0;
        color: #77715f;
    }

    .education-conversation-back {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 10px 14px;
        border-radius: 11px;
        background: #fffdf8;
        border: 1px solid #ded6c4;
        color: #4b5140;
        text-decoration: none;
        font-size: 13px;
        font-weight: 700;
        white-space: nowrap;
        transition: .2s ease;
    }

    .education-conversation-back:hover {
        background: #30372a;
        color: #fff;
        border-color: #30372a;
    }

    .education-conversation-alert {
        margin-bottom: 15px;
        padding: 13px 16px;
        border-radius: 12px;
        font-size: 13px;
    }

    .education-conversation-alert.success {
        background: #edf5e8;
        border: 1px solid #cadcc0;
        color: #405b38;
    }

    .education-conversation-alert.error {
        background: #f8e9e6;
        border: 1px solid #e4c4bd;
        color: #8a493f;
    }

    .education-chat-card {
        overflow: hidden;
        background: #fffdf8;
        border: 1px solid #e5ddca;
        border-radius: 18px;
        box-shadow: 0 8px 25px rgba(48, 55, 42, .06);
    }

    .education-chat-messages {
        height: 540px;
        overflow-y: auto;
        padding: 25px;
        background:
            linear-gradient(
                rgba(247, 241, 227, .35),
                rgba(255, 253, 248, .7)
            );
    }

    .education-chat-empty {
        height: 100%;
        min-height: 350px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: #8a8677;
    }

    .education-chat-empty-inner {
        max-width: 350px;
    }

    .education-chat-empty-icon {
        width: 65px;
        height: 65px;
        margin: 0 auto 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 19px;
        background: #f3ecdc;
        color: #88702e;
        font-size: 25px;
    }

    .education-chat-empty h3 {
        margin: 0 0 7px;
        color: #454b3c;
        font-size: 17px;
    }

    .education-chat-empty p {
        margin: 0;
        font-size: 13px;
        line-height: 1.8;
    }

    .education-chat-message {
        display: flex;
        margin-bottom: 18px;
    }

    .education-chat-message:last-child {
        margin-bottom: 0;
    }

    .education-chat-message.student {
        justify-content: flex-start;
    }

    .education-chat-message.admin {
        justify-content: flex-end;
    }

    .education-chat-bubble-wrapper {
        max-width: min(75%, 650px);
    }

    .education-chat-bubble {
        padding: 12px 15px;
        border-radius: 16px;
        font-size: 14px;
        line-height: 1.8;
        word-break: break-word;
        white-space: pre-wrap;
    }

    .education-chat-message.student .education-chat-bubble {
        background: #30372a;
        color: #fff;
        border-bottom-left-radius: 5px;
    }

    .education-chat-message.admin .education-chat-bubble {
        background: #f0e9d9;
        color: #3e4536;
        border: 1px solid #e0d5bd;
        border-bottom-right-radius: 5px;
    }

    .education-chat-message-meta {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-top: 5px;
        padding: 0 3px;
        color: #9a9585;
        font-size: 10px;
    }

    .education-chat-message.student .education-chat-message-meta {
        justify-content: flex-start;
    }

    .education-chat-message.admin .education-chat-message-meta {
        justify-content: flex-end;
    }

    .education-chat-form {
        padding: 17px;
        background: #f8f3e8;
        border-top: 1px solid #e6decc;
    }

    .education-chat-form-inner {
        display: flex;
        align-items: flex-end;
        gap: 10px;
    }

    .education-chat-textarea {
        flex: 1;
        min-height: 48px;
        max-height: 130px;
        resize: vertical;
        padding: 12px 14px;
        border: 1px solid #d8cfbb;
        border-radius: 13px;
        background: #fffdf8;
        color: #30372a;
        font-family: inherit;
        font-size: 13px;
        line-height: 1.7;
        outline: none;
        transition: .2s ease;
    }

    .education-chat-textarea:focus {
        border-color: #aa8a3f;
        box-shadow: 0 0 0 3px rgba(170, 138, 63, .10);
    }

    .education-chat-send {
        width: 48px;
        height: 48px;
        flex-shrink: 0;
        border: 0;
        border-radius: 13px;
        background: #30372a;
        color: #d4af5a;
        cursor: pointer;
        font-size: 16px;
        transition: .2s ease;
    }

    .education-chat-send:hover {
        background: #465139;
        transform: translateY(-1px);
    }

    .education-chat-send:disabled {
        opacity: .6;
        cursor: not-allowed;
        transform: none;
    }

    .education-chat-closed {
        padding: 18px;
        text-align: center;
        background: #f3f0e8;
        border-top: 1px solid #e2dccd;
        color: #777362;
        font-size: 13px;
    }

    .education-chat-closed i {
        margin-inline-end: 5px;
    }

    .education-conversation-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        margin-top: 15px;
    }

    .education-conversation-close-form button,
    .education-conversation-reopen-form button {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 9px 13px;
        border-radius: 10px;
        border: 1px solid #d8cfbd;
        background: #fffdf8;
        color: #686455;
        font-family: inherit;
        font-size: 12px;
        cursor: pointer;
        transition: .2s ease;
    }

    .education-conversation-close-form button:hover {
        background: #f4e6df;
        border-color: #d8bcb1;
        color: #814c42;
    }

    .education-conversation-reopen-form button:hover {
        background: #e8f1e3;
        border-color: #bfd2b7;
        color: #4d6b43;
    }

    @media (max-width: 700px) {

        .education-conversation-show-page {
            padding-top: 18px;
        }

        .education-conversation-header {
            align-items: flex-start;
            padding: 17px;
        }

        .education-conversation-header-main {
            min-width: 0;
        }

        .education-conversation-header-info h1 {
            font-size: 17px;
        }

        .education-conversation-back {
            padding: 9px 11px;
        }

        .education-chat-messages {
            height: 470px;
            padding: 17px 12px;
        }

        .education-chat-bubble-wrapper {
            max-width: 88%;
        }

        .education-chat-bubble {
            font-size: 13px;
            padding: 10px 12px;
        }

        .education-chat-form {
            padding: 12px;
        }

        .education-conversation-actions {
            align-items: stretch;
            flex-direction: column;
        }
    }
</style>

@php
$status = $conversation->status ?? 'open';


$isClosed = in_array(
    $status,
    ['closed', 'archived'],
    true
);

$title = $conversation->subject
    ?? $conversation->title
    ?? __('education.conversation_show_page.fallback.title');

@endphp

<div
    class="education-conversation-show-page"
    dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}"
>

<div class="education-conversation-container">

    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="education-conversation-header">

        <div class="education-conversation-header-main">

            <div class="education-conversation-header-icon">
                <i class="fa-solid fa-comments"></i>
            </div>

            <div class="education-conversation-header-info">

                <h1>
                    {{ $title }}
                </h1>

                <p>
                    {{ __('education.conversation_show_page.header.description') }}
                </p>

                @if($isClosed)

                    <span class="education-conversation-status closed">
                        <i class="fa-solid fa-lock"></i>
                        {{ __('education.conversation_show_page.status.closed') }}
                    </span>

                @else

                    <span class="education-conversation-status open">
                        <i class="fa-solid fa-circle"></i>
                        {{ __('education.conversation_show_page.status.open') }}
                    </span>

                @endif

            </div>

        </div>


        <a
            href="{{ route('education.conversations.index') }}"
            class="education-conversation-back"
        >
            <i class="fa-solid fa-arrow-right"></i>
            {{ __('education.conversation_show_page.actions.back') }}
        </a>

    </div>


    {{-- =====================================================
         ALERTS
    ====================================================== --}}

    @if(session('success'))

        <div class="education-conversation-alert success">
            <i class="fa-solid fa-circle-check"></i>
            {{ session('success') }}
        </div>

    @endif


    @if(session('error'))

        <div class="education-conversation-alert error">
            <i class="fa-solid fa-circle-exclamation"></i>
            {{ session('error') }}
        </div>

    @endif


    {{-- =====================================================
         CHAT
    ====================================================== --}}

    <div class="education-chat-card">

        <div
            class="education-chat-messages"
            id="educationChatMessages"
        >

            @if($messages->count())

                @foreach($messages as $message)

                    @php
                        $senderType = $message->sender_type ?? null;

                        $isStudent =
                            $senderType === 'education_user';

                        $body =
                            $message->message ?? '';

                        $messageDate =
                            $message->created_at;
                    @endphp


                    <div
                        class="education-chat-message {{ $isStudent ? 'student' : 'admin' }}"
                    >

                        <div class="education-chat-bubble-wrapper">

                            <div class="education-chat-bubble">
                                {{ $body }}
                            </div>

                            <div class="education-chat-message-meta">

                                @if($isStudent)

                                    <span>
                                        {{ __('education.conversation_show_page.sender.student') }}
                                    </span>

                                @else

                                    <span>
                                        {{ __('education.conversation_show_page.sender.admin') }}
                                    </span>

                                @endif


                                @if($messageDate)

                                    <span>
                                        {{ $messageDate->format('Y/m/d - H:i') }}
                                    </span>

                                @endif

                            </div>

                        </div>

                    </div>

                @endforeach

            @else

                <div class="education-chat-empty">

                    <div class="education-chat-empty-inner">

                        <div class="education-chat-empty-icon">
                            <i class="fa-regular fa-comments"></i>
                        </div>

                        <h3>
                            {{ __('education.conversation_show_page.empty.title') }}
                        </h3>

                        <p>
                            {{ __('education.conversation_show_page.empty.description') }}
                        </p>

                    </div>

                </div>

            @endif

        </div>


        {{-- =================================================
             SEND MESSAGE
        ================================================== --}}

        @if(!$isClosed)

            <form
                method="POST"
                action="{{ route(
                    'education.conversations.messages.store',
                    $conversation
                ) }}"
                class="education-chat-form"
            >

                @csrf

                <div class="education-chat-form-inner">

                    <textarea
                        name="message"
                        class="education-chat-textarea"
                        placeholder="{{ __('education.conversation_show_page.form.placeholder') }}"
                        required
                        maxlength="5000"
                    >{{ old('message') }}</textarea>


                    <button
                        type="submit"
                        class="education-chat-send"
                        title="{{ __('education.conversation_show_page.form.send') }}"
                        aria-label="{{ __('education.conversation_show_page.form.send') }}"
                    >
                        <i class="fa-solid fa-paper-plane"></i>
                    </button>

                </div>


                @error('message')

                    <div style="
                        margin-top:8px;
                        color:#9a5147;
                        font-size:12px;
                    ">
                        {{ $message }}
                    </div>

                @enderror

            </form>

        @else

            <div class="education-chat-closed">

                <i class="fa-solid fa-lock"></i>

                {{ __('education.conversation_show_page.closed_message') }}

            </div>

        @endif

    </div>


    {{-- =====================================================
         ACTIONS
    ====================================================== --}}

    <div class="education-conversation-actions">

        @if(!$isClosed)

            <form
                method="POST"
                action="{{ route(
                    'education.conversations.close',
                    $conversation
                ) }}"
                class="education-conversation-close-form"
                onsubmit="return confirm(@js(__('education.conversation_show_page.confirm.close')));"
            >

                @csrf

                <button type="submit">

                    <i class="fa-solid fa-lock"></i>

                    {{ __('education.conversation_show_page.actions.close') }}

                </button>

            </form>

        @else

            <form
                method="POST"
                action="{{ route(
                    'education.conversations.reopen',
                    $conversation
                ) }}"
                class="education-conversation-reopen-form"
            >

                @csrf

                <button type="submit">

                    <i class="fa-solid fa-lock-open"></i>

                    {{ __('education.conversation_show_page.actions.reopen') }}

                </button>

            </form>

        @endif

    </div>

</div>


</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const messagesContainer =
            document.getElementById('educationChatMessages');

        if (messagesContainer) {

            messagesContainer.scrollTop =
                messagesContainer.scrollHeight;

        }

    });
</script>

@endsection
