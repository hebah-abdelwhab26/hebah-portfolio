@extends('tech.layouts.app')

@section('content')

@include('tech.sections.navbar')

<div class="conversations-page">


<div class="conversations-container">

    {{-- =====================================================
         PAGE HEADER
    ====================================================== --}}

    <div class="conversations-header">

        <div class="conversations-header-content">

            <span class="page-badge">
                {{ __('digital_studio.conversations.show.badge') }}
            </span>

            <h1>
                {{ $conversation->subject }}
            </h1>

            <p>
                {{ __('digital_studio.conversations.show.description') }}
            </p>

        </div>

        <a
            href="{{ route('conversations.index') }}"
            class="conversation-refresh"
            title="{{ __('digital_studio.conversations.show.back_to_conversations') }}"
            aria-label="{{ __('digital_studio.conversations.show.back_to_conversations') }}"
        >
            <i class="fa-solid fa-arrow-left"></i>
        </a>

    </div>


    {{-- =====================================================
         STATUS + META
    ====================================================== --}}

    <div class="conversations-toolbar">

        <div class="conversation-count">

            <i class="fa-regular fa-message"></i>

            <span>
                {{ $conversation->messages->count() }}

                {{ Str::plural(
                    __('digital_studio.conversations.show.message'),
                    $conversation->messages->count()
                ) }}
            </span>

            @if($conversation->created_at)

                <span
                    style="
                        color:#64748b;
                        margin-left:8px;
                    "
                >

                    <i class="fa-regular fa-clock"></i>

                    {{ $conversation->created_at->diffForHumans() }}

                </span>

            @endif

        </div>


        <div
            style="
                display:flex;
                align-items:center;
                gap:10px;
            "
        >

            @if($conversation->status === 'open')

                <span class="conversation-status open">

                    <span
                        style="
                            width:6px;
                            height:6px;
                            border-radius:50%;
                            background:#22c55e;
                            display:inline-block;
                            margin-right:5px;
                        "
                    ></span>

                    {{ __('digital_studio.conversations.status.open') }}

                </span>

            @elseif($conversation->status === 'closed')

                <span class="conversation-status closed">

                    <span
                        style="
                            width:6px;
                            height:6px;
                            border-radius:50%;
                            background:#94a3b8;
                            display:inline-block;
                            margin-right:5px;
                        "
                    ></span>

                    {{ __('digital_studio.conversations.status.closed') }}

                </span>

            @elseif($conversation->status === 'archived')

                <span class="conversation-status archived">

                    <span
                        style="
                            width:6px;
                            height:6px;
                            border-radius:50%;
                            background:#f59e0b;
                            display:inline-block;
                            margin-right:5px;
                        "
                    ></span>

                    {{ __('digital_studio.conversations.status.archived') }}

                </span>

            @endif

        </div>

    </div>


    {{-- =====================================================
         FLASH SUCCESS
    ====================================================== --}}

    @if(session('success'))

        <div class="conversation-alert success">

            <i class="fa-solid fa-circle-check"></i>

            <span>
                {{ session('success') }}
            </span>

        </div>

    @endif


    {{-- =====================================================
         FLASH ERROR
    ====================================================== --}}

    @if(session('error'))

        <div class="conversation-alert error">

            <i class="fa-solid fa-circle-exclamation"></i>

            <span>
                {{ session('error') }}
            </span>

        </div>

    @endif


    {{-- =====================================================
         VALIDATION ERRORS
    ====================================================== --}}

    @if($errors->any())

        <div class="conversation-alert error">

            <i class="fa-solid fa-circle-exclamation"></i>

            <div>

                <strong>
                    {{ __('digital_studio.conversations.create.check_following') }}
                </strong>

                <ul
                    style="
                        margin:8px 0 0;
                        padding-left:18px;
                    "
                >

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        </div>

    @endif


    {{-- =====================================================
         CONVERSATION SHOW CARD
    ====================================================== --}}

    <div
        class="conversation-show-card"
        style="background-color: #101f37"
    >


        {{-- =================================================
             SUPPORT HEADER
        ================================================== --}}

        <div
            style="
                display:flex;
                align-items:center;
                justify-content:space-between;
                gap:20px;
                padding-bottom:22px;
                margin-bottom:25px;
                border-bottom:1px solid rgba(255,255,255,0.08);
            "
        >

            <div
                style="
                    display:flex;
                    align-items:center;
                    gap:14px;
                "
            >

                {{-- Avatar --}}

                <div
                    style="
                        width:52px;
                        height:52px;
                        flex-shrink:0;
                        border-radius:17px;
                        display:flex;
                        align-items:center;
                        justify-content:center;
                        color:#ffffff;
                        background:
                            linear-gradient(
                                135deg,
                                var(--conversation-primary),
                                var(--conversation-secondary)
                            );
                        box-shadow:
                            0 10px 25px rgba(79,140,255,0.20);
                    "
                >

                    <i class="fa-solid fa-headset"></i>

                </div>


                <div>

                    <strong
                        style="
                            display:block;
                            color:#ffffff;
                            font-size:15px;
                            margin-bottom:4px;
                        "
                    >
                        {{ __('digital_studio.conversations.show.support_team') }}
                    </strong>

                    <span
                        style="
                            color:var(--conversation-muted);
                            font-size:12px;
                        "
                    >
                        {{ __('digital_studio.conversations.show.support_subtitle') }}
                    </span>

                </div>

            </div>


            {{-- Conversation Action --}}

            @if($conversation->status === 'open')

                <form
                    action="{{ route('conversations.close', $conversation) }}"
                    method="POST"
                    onsubmit="return confirm('{{ __('digital_studio.conversations.show.close_confirmation') }}');"
                >

                    @csrf

                    <button
                        type="submit"
                        class="conversation-back-btn"
                        style="cursor:pointer;"
                    >

                        <i class="fa-solid fa-lock"></i>

                        <span>
                            {{ __('digital_studio.conversations.show.close') }}
                        </span>

                    </button>

                </form>

            @elseif($conversation->status === 'closed')

                <form
                    action="{{ route('conversations.reopen', $conversation) }}"
                    method="POST"
                >

                    @csrf

                    <button
                        type="submit"
                        class="new-conversation-btn"
                        style="
                            border:0;
                            cursor:pointer;
                            min-height:42px;
                            padding:0 16px;
                        "
                    >

                        <i class="fa-solid fa-lock-open"></i>

                        <span>
                            {{ __('digital_studio.conversations.show.reopen') }}
                        </span>

                    </button>

                </form>

            @endif

        </div>


        {{-- =================================================
             MESSAGES
        ================================================== --}}

        <div class="conversation-messages">

            @forelse($conversation->messages as $message)

                @php
                    $isUser = $message->sender_type === 'user';
                    $isAdmin = $message->sender_type === 'admin';
                @endphp


                <div
                    class="conversation-message {{ $isUser ? 'user' : 'admin' }}"
                >

                    <div class="message-bubble">


                        {{-- Message Header --}}

                        <div class="message-header">

                            <span>

                                @if($isAdmin)

                                    <i class="fa-solid fa-headset"></i>

                                    {{ __('digital_studio.conversations.show.support') }}

                                @else

                                    <i class="fa-regular fa-user"></i>

                                    {{ __('digital_studio.conversations.show.you') }}

                                @endif

                            </span>


                            <span>

                                {{ $message->created_at->format('M d, Y · h:i A') }}

                            </span>

                        </div>


                        {{-- Message --}}

                        <div class="message-text">

                            {!! nl2br(e($message->message)) !!}

                        </div>


                        {{-- Read status for user's messages --}}

                        @if($isUser)

                            <div
                                style="
                                    display:flex;
                                    justify-content:flex-end;
                                    align-items:center;
                                    gap:5px;
                                    margin-top:9px;
                                    font-size:10px;
                                    opacity:.70;
                                "
                            >

                                @if($message->is_read)

                                    <i class="fa-solid fa-check-double"></i>

                                    <span>
                                        {{ __('digital_studio.conversations.show.read') }}
                                    </span>

                                @else

                                    <i class="fa-solid fa-check"></i>

                                    <span>
                                        {{ __('digital_studio.conversations.show.sent') }}
                                    </span>

                                @endif

                            </div>

                        @endif

                    </div>

                </div>

            @empty

                {{-- =================================================
                     EMPTY MESSAGES
                ================================================== --}}

                <div
                    class="conversations-empty"
                    style="
                        min-height:300px;
                        margin-bottom:0;
                    "
                >

                    <div class="empty-icon">

                        <i class="fa-regular fa-comments"></i>

                    </div>

                    <h2>
                        {{ __('digital_studio.conversations.show.no_messages_title') }}
                    </h2>

                    <p>
                        {{ __('digital_studio.conversations.show.no_messages_description') }}
                    </p>

                </div>

            @endforelse

        </div>


        {{-- =================================================
             REPLY
        ================================================== --}}

        @if($conversation->status === 'open')

            <div class="conversation-reply">

                <div class="conversation-reply-title">

                    <i class="fa-regular fa-message"></i>

                    {{ __('digital_studio.conversations.show.reply_title') }}

                </div>


                <form
                    action="{{ route('conversations.messages.send', $conversation) }}"
                    method="POST"
                >

                    @csrf


                    <div class="conversation-form-group">

                        <label
                            for="message"
                            class="conversation-form-label"
                        >
                            {{ __('digital_studio.conversations.show.your_message') }}
                        </label>

                        <textarea
                            name="message"
                            id="message"
                            class="conversation-form-textarea"
                            rows="6"
                            maxlength="10000"
                            placeholder="{{ __('digital_studio.conversations.show.message_placeholder') }}"
                            required
                        >{{ old('message') }}</textarea>


                        <div
                            style="
                                display:flex;
                                justify-content:space-between;
                                align-items:center;
                                gap:15px;
                                margin-top:8px;
                            "
                        >

                            <span
                                style="
                                    color:#64748b;
                                    font-size:12px;
                                "
                            >

                                <i class="fa-solid fa-circle-info"></i>

                                {{ __('digital_studio.conversations.show.message_info') }}

                            </span>

                            <span
                                id="conversationCharacterCounter"
                                style="
                                    color:#64748b;
                                    font-size:12px;
                                    white-space:nowrap;
                                "
                            >
                                0 / 10000
                            </span>

                        </div>

                    </div>


                    <div class="conversation-form-actions">

                        <a
                            href="{{ route('conversations.index') }}"
                            class="conversation-back-btn"
                        >

                            <i class="fa-solid fa-arrow-left"></i>

                            <span>
                                {{ __('digital_studio.conversations.show.back') }}
                            </span>

                        </a>


                        <button
                            type="submit"
                            class="new-conversation-btn"
                            id="sendMessageButton"
                            style="
                                border:0;
                                cursor:pointer;
                            "
                        >

                            <span>
                                {{ __('digital_studio.conversations.show.send_message') }}
                            </span>

                            <i class="fa-solid fa-paper-plane"></i>

                        </button>

                    </div>

                </form>

            </div>

        @else

            {{-- =================================================
                 CLOSED CONVERSATION
            ================================================== --}}

            <div
                style="
                    margin-top:25px;
                    padding:24px;
                    border-radius:20px;
                    display:flex;
                    align-items:center;
                    gap:18px;
                    background:rgba(255,255,255,0.035);
                    border:1px solid rgba(255,255,255,0.08);
                "
            >

                <div
                    style="
                        width:50px;
                        height:50px;
                        flex-shrink:0;
                        border-radius:16px;
                        display:flex;
                        align-items:center;
                        justify-content:center;
                        color:#cbd5e1;
                        background:rgba(148,163,184,0.10);
                        border:1px solid rgba(148,163,184,0.15);
                    "
                >

                    <i class="fa-solid fa-lock"></i>

                </div>


                <div style="flex:1;">

                    <strong
                        style="
                            display:block;
                            color:#ffffff;
                            margin-bottom:5px;
                        "
                    >
                        {{ __('digital_studio.conversations.show.closed_title') }}
                    </strong>

                    <p
                        style="
                            margin:0;
                            color:var(--conversation-muted);
                            font-size:13px;
                            line-height:1.7;
                        "
                    >
                        {{ __('digital_studio.conversations.show.closed_description') }}
                    </p>

                </div>


                @if($conversation->status === 'closed')

                    <form
                        action="{{ route('conversations.reopen', $conversation) }}"
                        method="POST"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="new-conversation-btn"
                            style="
                                border:0;
                                cursor:pointer;
                                white-space:nowrap;
                            "
                        >

                            <i class="fa-solid fa-lock-open"></i>

                            {{ __('digital_studio.conversations.show.reopen') }}

                        </button>

                    </form>

                @endif

            </div>

        @endif

    </div>


    {{-- =====================================================
         FOOTER
    ====================================================== --}}

    <div
        style="
            display:flex;
            justify-content:flex-start;
            margin-top:25px;
        "
    >

        <a
            href="{{ route('conversations.index') }}"
            class="conversation-back-btn"
        >

            <i class="fa-solid fa-arrow-left"></i>

            <span>
                {{ __('digital_studio.conversations.show.back_to_my_conversations') }}
            </span>

        </a>

    </div>

</div>


</div>

@include('tech.sections.footer')

@endsection

{{-- =============================================================
SCRIPTS
============================================================= --}}

@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {

    const textarea = document.getElementById('message');

    const counter = document.getElementById(
        'conversationCharacterCounter'
    );

    const form = textarea
        ? textarea.closest('form')
        : null;

    const button = document.getElementById(
        'sendMessageButton'
    );


    /*
    |--------------------------------------------------------------------------
    | Character Counter
    |--------------------------------------------------------------------------
    */

    if (textarea && counter) {

        const updateCounter = function () {

            counter.textContent =
                textarea.value.length + ' / 10000';

        };

        textarea.addEventListener(
            'input',
            updateCounter
        );

        updateCounter();

    }


    /*
    |--------------------------------------------------------------------------
    | Submit Protection
    |--------------------------------------------------------------------------
    */

    if (form && button) {

        form.addEventListener(
            'submit',
            function () {

                if (!textarea.value.trim()) {

                    textarea.focus();

                    return;

                }

                button.disabled = true;

                button.style.opacity = '0.65';

                button.style.pointerEvents = 'none';

                button.innerHTML =
                    '<i class="fa-solid fa-spinner fa-spin"></i>' +
                    '<span>{{ __("digital_studio.conversations.show.sending") }}</span>';

            }
        );

    }


    /*
    |--------------------------------------------------------------------------
    | Scroll To Latest Message
    |--------------------------------------------------------------------------
    */

    const messages =
        document.querySelector('.conversation-messages');

    if (messages) {

        messages.scrollTop =
            messages.scrollHeight;

    }

});

</script>

@endpush
