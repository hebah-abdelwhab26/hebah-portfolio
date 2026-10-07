@extends('education.layouts.app')

@section('title', __('education.conversations_page.page_title'))

@section('content')
@include('education.student.partials.navigation')

<style>
    /* =========================================================
       EDUCATION CONVERSATIONS
       Cream / Olive Green / Gold
       ========================================================= */

    .education-conversations-page {
        direction: rtl;
        padding: 30px 0 60px;
        color: #30372a;
    }

    .education-conversations-container {
        width: min(1100px, calc(100% - 30px));
        margin: 0 auto;
    }

    /* =========================================================
       HEADER
       ========================================================= */

    .education-conversations-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 25px;
        padding: 24px 26px;
        background: #f7f1e3;
        border: 1px solid rgba(176, 145, 68, .25);
        border-radius: 18px;
        box-shadow: 0 8px 25px rgba(48, 55, 42, .06);
    }

    .education-conversations-heading {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .education-conversations-heading-icon {
        width: 52px;
        height: 52px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        border-radius: 14px;
        background: #30372a;
        color: #d4af5a;
        font-size: 21px;
    }

    .education-conversations-heading h1 {
        margin: 0 0 5px;
        font-size: 24px;
        font-weight: 800;
        color: #30372a;
    }

    .education-conversations-heading p {
        margin: 0;
        color: #777563;
        font-size: 14px;
    }

    .education-conversations-new-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        min-height: 45px;
        padding: 0 18px;
        border-radius: 12px;
        background: #30372a;
        color: #fff;
        text-decoration: none;
        font-size: 14px;
        font-weight: 700;
        transition: .2s ease;
        white-space: nowrap;
    }

    .education-conversations-new-btn:hover {
        background: #465139;
        color: #fff;
        transform: translateY(-1px);
    }

    /* =========================================================
       ALERT
       ========================================================= */

    .education-conversations-alert {
        margin-bottom: 20px;
        padding: 14px 17px;
        border-radius: 12px;
        background: #edf5e8;
        border: 1px solid #cbdcbd;
        color: #405438;
        font-size: 14px;
    }

    /* =========================================================
       LIST
       ========================================================= */

    .education-conversations-list {
        display: flex;
        flex-direction: column;
        gap: 13px;
    }

    .education-conversation-card {
        display: flex;
        align-items: center;
        gap: 18px;
        padding: 20px;
        background: #fffdf8;
        border: 1px solid #e7dfcc;
        border-radius: 16px;
        color: inherit;
        box-shadow: 0 5px 18px rgba(48, 55, 42, .04);
        transition: .2s ease;
    }

    .education-conversation-card:hover {
        transform: translateY(-2px);
        border-color: rgba(176, 145, 68, .55);
        box-shadow: 0 10px 28px rgba(48, 55, 42, .08);
    }

    /* =========================================================
       CONVERSATION CONTENT LINK
       ========================================================= */

    .education-conversation-link {
        display: flex;
        align-items: center;
        gap: 18px;
        flex: 1;
        min-width: 0;
        color: inherit;
        text-decoration: none;
    }

    .education-conversation-link:hover {
        color: inherit;
        text-decoration: none;
    }

    .education-conversation-icon {
        width: 50px;
        height: 50px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 14px;
        background: #f1ead8;
        color: #88702e;
        font-size: 20px;
    }

    .education-conversation-main {
        flex: 1;
        min-width: 0;
    }

    .education-conversation-title-row {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
        margin-bottom: 7px;
    }

    .education-conversation-title {
        margin: 0;
        font-size: 16px;
        font-weight: 800;
        color: #30372a;
    }

    .education-conversation-status {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 4px 9px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
    }

    .education-conversation-status.open {
        background: #e9f3e5;
        color: #4d7040;
    }

    .education-conversation-status.closed {
        background: #eeeae1;
        color: #77715f;
    }

    .education-conversation-preview {
        margin: 0;
        color: #777563;
        font-size: 13px;
        line-height: 1.7;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .education-conversation-meta {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-top: 8px;
        color: #9a9584;
        font-size: 11px;
    }

    .education-conversation-meta span {
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .education-conversation-arrow {
        width: 38px;
        height: 38px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        background: #f7f1e3;
        color: #88702e;
        transition: .2s ease;
    }

    .education-conversation-card:hover .education-conversation-arrow {
        background: #30372a;
        color: #d4af5a;
    }

    /* =========================================================
       DELETE BUTTON
       ========================================================= */

    .education-conversation-delete-form {
        flex-shrink: 0;
        margin: 0;
    }

    .education-conversation-delete-btn {
        width: 40px;
        height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #ead8d4;
        border-radius: 10px;
        background: #fff7f5;
        color: #a65d50;
        cursor: pointer;
        font-size: 14px;
        transition: .2s ease;
    }

    .education-conversation-delete-btn:hover {
        background: #a65d50;
        border-color: #a65d50;
        color: #fff;
        transform: translateY(-1px);
    }

    .education-conversation-delete-btn:focus {
        outline: 3px solid rgba(166, 93, 80, .15);
        outline-offset: 2px;
    }

    /* =========================================================
       EMPTY
       ========================================================= */

    .education-conversations-empty {
        padding: 60px 25px;
        text-align: center;
        background: #fffdf8;
        border: 1px dashed #d9cfb8;
        border-radius: 18px;
    }

    .education-conversations-empty-icon {
        width: 70px;
        height: 70px;
        margin: 0 auto 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 20px;
        background: #f4eddd;
        color: #88702e;
        font-size: 27px;
    }

    .education-conversations-empty h3 {
        margin: 0 0 8px;
        font-size: 18px;
        font-weight: 800;
        color: #30372a;
    }

    .education-conversations-empty p {
        margin: 0 0 22px;
        color: #817d6d;
        font-size: 13px;
    }

    /* =========================================================
       PAGINATION
       ========================================================= */

    .education-conversations-pagination {
        margin-top: 25px;
    }

    /* =========================================================
       RESPONSIVE
       ========================================================= */

    @media (max-width: 700px) {

        .education-conversations-page {
            padding-top: 20px;
        }

        .education-conversations-header {
            align-items: flex-start;
            flex-direction: column;
            padding: 20px;
        }

        .education-conversations-new-btn {
            width: 100%;
        }

        .education-conversation-card {
            padding: 14px;
            gap: 10px;
        }

        .education-conversation-link {
            gap: 12px;
        }

        .education-conversation-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            font-size: 17px;
        }

        .education-conversation-arrow {
            width: 34px;
            height: 34px;
        }

        .education-conversation-delete-btn {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            font-size: 12px;
        }

        .education-conversation-meta {
            flex-wrap: wrap;
            gap: 7px 12px;
        }
    }
</style>

<div class="education-conversations-page">

<div class="education-conversations-container">

    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="education-conversations-header">

        <div class="education-conversations-heading">

            <div class="education-conversations-heading-icon">
                <i class="fa-solid fa-comments"></i>
            </div>

            <div>
                <h1>{{ __('education.conversations_page.header.title') }}</h1>

                <p>
                    {{ __('education.conversations_page.header.description') }}
                </p>
            </div>

        </div>


        <a
            href="{{ route('education.conversations.create') }}"
            class="education-conversations-new-btn"
        >
            <i class="fa-solid fa-plus"></i>
            {{ __('education.conversations_page.header.new') }}
        </a>

    </div>


    {{-- =====================================================
         SUCCESS MESSAGE
    ====================================================== --}}

    @if(session('success'))

        <div class="education-conversations-alert">
            <i class="fa-solid fa-circle-check"></i>
            {{ session('success') }}
        </div>

    @endif


    {{-- =====================================================
         CONVERSATIONS
    ====================================================== --}}

    @if(isset($conversations) && $conversations->count())

        <div class="education-conversations-list">

            @foreach($conversations as $conversation)

                @php
                    $status = $conversation->status ?? 'open';

                    $isClosed = in_array(
                        $status,
                        ['closed', 'archived']
                    );

                    $title = $conversation->subject
                        ?? $conversation->title
                        ?? __('education.conversations_page.empty.title');

                    $lastMessage = $conversation->messages
                        ->sortByDesc('created_at')
                        ->first();

                    $preview = $lastMessage
                        ? ($lastMessage->body
                            ?? $lastMessage->message
                            ?? $lastMessage->content
                            ?? '')
                        : __('education.conversations_page.messages.empty');

                    $updatedAt = $conversation->updated_at;
                @endphp


                <div class="education-conversation-card">

                    {{-- =================================================
                         CONVERSATION LINK
                    ================================================== --}}

                    <a
                        href="{{ route(
                            'education.conversations.show',
                            $conversation
                        ) }}"
                        class="education-conversation-link"
                    >

                        <div class="education-conversation-icon">
                            <i class="fa-regular fa-comments"></i>
                        </div>


                        <div class="education-conversation-main">

                            <div class="education-conversation-title-row">

                                <h2 class="education-conversation-title">
                                    {{ $title }}
                                </h2>


                                @if($isClosed)

                                    <span class="education-conversation-status closed">
                                        <i class="fa-solid fa-lock"></i>
                                        {{ __('education.conversations_page.status.closed') }}
                                    </span>

                                @else

                                    <span class="education-conversation-status open">
                                        <i class="fa-solid fa-circle"></i>
                                        {{ __('education.conversations_page.status.open') }}
                                    </span>

                                @endif

                            </div>


                            <p class="education-conversation-preview">
                                {{ $preview }}
                            </p>


                            <div class="education-conversation-meta">

                                @if($updatedAt)

                                    <span>
                                        <i class="fa-regular fa-clock"></i>

                                        {{ $updatedAt->diffForHumans() }}
                                    </span>

                                @endif


                                @if(isset($conversation->messages_count))

                                    <span>
                                        <i class="fa-regular fa-message"></i>

                                        {{ $conversation->messages_count }}

                                        {{ $conversation->messages_count == 1
                                            ? __('education.conversations_page.messages.message')
                                            : __('education.conversations_page.messages.messages')
                                        }}
                                    </span>

                                @endif

                            </div>

                        </div>


                        <div class="education-conversation-arrow">
                            <i class="fa-solid fa-chevron-left"></i>
                        </div>

                    </a>


                    {{-- =================================================
                         DELETE CONVERSATION
                    ================================================== --}}

                    <form
                        action="{{ route(
                            'education.conversations.destroy',
                            $conversation
                        ) }}"
                        method="POST"
                        class="education-conversation-delete-form"
                        onsubmit="return confirm(@js(__('education.conversations_page.actions.delete_confirm')));"
                    >

                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="education-conversation-delete-btn"
                            title="{{ __('education.conversations_page.actions.delete') }}"
                            aria-label="{{ __('education.conversations_page.actions.delete') }}"
                        >
                            <i class="fa-solid fa-trash-can"></i>
                        </button>

                    </form>

                </div>

            @endforeach

        </div>


        {{-- =================================================
             PAGINATION
        ================================================== --}}

        @if(method_exists($conversations, 'links'))

            <div class="education-conversations-pagination">
                {{ $conversations->links() }}
            </div>

        @endif


    @else

        {{-- =================================================
             EMPTY STATE
        ================================================== --}}

        <div class="education-conversations-empty">

            <div class="education-conversations-empty-icon">
                <i class="fa-regular fa-comments"></i>
            </div>

            <h3>
                {{ __('education.conversations_page.empty.title') }}
            </h3>

            <p>
                {{ __('education.conversations_page.empty.description') }}
            </p>

            <a
                href="{{ route('education.conversations.create') }}"
                class="education-conversations-new-btn"
            >
                <i class="fa-solid fa-plus"></i>
                {{ __('education.conversations_page.empty.start') }}
            </a>

        </div>

    @endif

</div>

</div>

@endsection
