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
                {{ __('digital_studio.conversations.badge') }}
            </span>

            <h1>
                {{ __('digital_studio.conversations.title') }}
            </h1>

            <p>
                {{ __('digital_studio.conversations.description') }}
            </p>

        </div>


        {{-- Refresh --}}

        <a
            href="{{ route('conversations.index') }}"
            class="conversation-refresh"
            title="{{ __('digital_studio.conversations.refresh') }}"
            aria-label="{{ __('digital_studio.conversations.refresh') }}"
        >
            <i class="fa-solid fa-rotate-right"></i>
        </a>

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

                @foreach($errors->all() as $error)

                    <div>
                        {{ $error }}
                    </div>

                @endforeach

            </div>

        </div>

    @endif


    {{-- =====================================================
         TOOLBAR
    ====================================================== --}}

    <div class="conversations-toolbar">

        <div class="conversation-count">

            <i class="fa-regular fa-comments"></i>

            <span>
                {{ $conversations->total() }}

                {{ Str::plural(
                    __('digital_studio.conversations.conversation'),
                    $conversations->total()
                ) }}
            </span>

        </div>


        <a
            href="{{ route('conversations.create') }}"
            class="new-conversation-btn"
        >

            <i class="fa-solid fa-plus"></i>

            <span>
                {{ __('digital_studio.conversations.new_conversation') }}
            </span>

        </a>

    </div>


    {{-- =====================================================
         CONVERSATIONS LIST
    ====================================================== --}}

    @if($conversations->count() > 0)

        <div class="conversations-list" style="background-color: #101f37">

            @foreach($conversations as $conversation)

                @php

                    /*
                    |----------------------------------------------------------------------
                    | Latest Message
                    |----------------------------------------------------------------------
                    */

                    $latestMessage = $conversation->latestMessage;


                    /*
                    |----------------------------------------------------------------------
                    | Unread
                    |----------------------------------------------------------------------
                    |
                    | Latest message is from support
                    | and has not been read by the user.
                    |
                    */

                    $isUnread =
                        $latestMessage &&
                        $latestMessage->sender_type === 'admin' &&
                        !$latestMessage->is_read;


                    /*
                    |----------------------------------------------------------------------
                    | Status
                    |----------------------------------------------------------------------
                    */

                    $statusClass = match ($conversation->status) {

                        'open'      => 'open',
                        'closed'    => 'closed',
                        'archived'  => 'archived',

                        default     => 'closed',

                    };


                    $statusLabel = match ($conversation->status) {

                        'open'      => __('digital_studio.conversations.status.open'),

                        'closed'    => __('digital_studio.conversations.status.closed'),

                        'archived'  => __('digital_studio.conversations.status.archived'),

                        default     => ucfirst($conversation->status),

                    };

                @endphp


                {{-- =================================================
                     CONVERSATION CARD
                ================================================== --}}

                <a
                    href="{{ route('conversations.show', $conversation) }}"
                    class="conversation-card {{ $isUnread ? 'unread' : '' }}"
                >


                    {{-- =================================================
                         ICON
                    ================================================== --}}

                    <div class="conversation-icon">

                        @if($isUnread)

                            <i class="fa-solid fa-envelope"></i>

                        @else

                            <i class="fa-regular fa-comments"></i>

                        @endif

                    </div>


                    {{-- =================================================
                         CONTENT
                    ================================================== --}}

                    <div class="conversation-content">


                        {{-- =================================================
                             TOP
                        ================================================== --}}

                        <div class="conversation-top">

                            <h3>
                                {{ $conversation->subject }}
                            </h3>


                            {{-- Status --}}

                            <span
                                class="conversation-status {{ $statusClass }}"
                            >

                                {{ $statusLabel }}

                            </span>

                        </div>


                        {{-- =================================================
                             LATEST MESSAGE
                        ================================================== --}}

                        <div class="conversation-preview">

                            @if($latestMessage)

                                <span class="sender-label">

                                    @if($latestMessage->sender_type === 'admin')

                                        <i class="fa-solid fa-headset"></i>

                                        <span>
                                            {{ __('digital_studio.conversations.support') }}
                                        </span>

                                    @else

                                        <i class="fa-regular fa-user"></i>

                                        <span>
                                            {{ __('digital_studio.conversations.you') }}
                                        </span>

                                    @endif

                                </span>


                                <span class="preview-text">

                                    {{ Str::limit($latestMessage->message, 120) }}

                                </span>

                            @else

                                <span class="preview-text">
                                    {{ __('digital_studio.conversations.no_messages') }}
                                </span>

                            @endif

                        </div>


                        {{-- =================================================
                             META
                        ================================================== --}}

                        <div class="conversation-meta">


                            {{-- Last Message --}}

                            @if($conversation->last_message_at)

                                <span>

                                    <i class="fa-regular fa-clock"></i>

                                    <span>
                                        {{ $conversation->last_message_at->diffForHumans() }}
                                    </span>

                                </span>

                            @endif


                            {{-- Message Count --}}

                            @if(isset($conversation->messages_count))

                                <span>

                                    <i class="fa-regular fa-message"></i>

                                    <span>
                                        {{ $conversation->messages_count }}
                                    </span>

                                </span>

                            @endif


                            {{-- New Reply --}}

                            @if($isUnread)

                                <span>

                                    <i class="fa-solid fa-circle"></i>

                                    <span>
                                        {{ __('digital_studio.conversations.new_reply') }}
                                    </span>

                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- =================================================
                         ARROW
                    ================================================== --}}

                    <div class="conversation-arrow">

                        <i class="fa-solid fa-chevron-right"></i>

                    </div>

                </a>

            @endforeach

        </div>


        {{-- =====================================================
             PAGINATION
        ====================================================== --}}

        @if($conversations->hasPages())

            <div class="conversations-pagination">

                {{ $conversations->links() }}

            </div>

        @endif


    @else


        {{-- =====================================================
             EMPTY STATE
        ====================================================== --}}

        <div class="conversations-empty">


            {{-- Icon --}}

            <div class="empty-icon">

                <i class="fa-regular fa-comments"></i>

            </div>


            {{-- Title --}}

            <h2>
                {{ __('digital_studio.conversations.empty_title') }}
            </h2>


            {{-- Description --}}

            <p>
                {{ __('digital_studio.conversations.empty_description') }}
            </p>


            {{-- Action --}}

            <a
                href="{{ route('conversations.create') }}"
                class="new-conversation-btn"
            >

                <i class="fa-solid fa-plus"></i>

                <span>
                    {{ __('digital_studio.conversations.start_conversation') }}
                </span>

            </a>

        </div>

    @endif

</div>


</div>

@include('tech.sections.footer')

@endsection
