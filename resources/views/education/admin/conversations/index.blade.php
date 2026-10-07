@extends('education.admin.layouts.app')

@section('title', __('education_admin.conversations.page_title'))

@section('content')

<style>
    /* =========================================================
       EDUCATION ADMIN CONVERSATIONS
       Cream / Olive Green / Gold
    ========================================================= */

    .education-admin-conversations-page {
        direction: rtl;
        color: #30372a;
        padding-bottom: 50px;
    }

    /* =========================================================
       HEADER
    ========================================================= */

    .education-admin-conversations-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 28px;
    }

    .education-admin-conversations-heading {
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

    .education-admin-conversations-heading h1 {
        margin: 0;
        font-size: 28px;
        font-weight: 800;
        color: #30372a;
    }

    .education-admin-conversations-heading p {
        margin: 8px 0 0;
        color: #7d7d73;
        font-size: 14px;
        line-height: 1.8;
    }

    /* =========================================================
       HEADER ACTIONS
    ========================================================= */

    .education-admin-conversations-header-actions {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-shrink: 0;
    }

    .education-conversation-create-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        min-height: 44px;
        padding: 0 17px;
        border-radius: 11px;
        color: #fff;
        background: #596346;
        border: 1px solid #596346;
        text-decoration: none;
        font-size: 13px;
        font-weight: 800;
        transition: all 0.2s ease;
        white-space: nowrap;
        box-shadow: 0 5px 15px rgba(89, 99, 70, 0.16);
    }

    .education-conversation-create-button:hover {
        color: #fff;
        background: #4d573d;
        border-color: #4d573d;
        transform: translateY(-1px);
        box-shadow: 0 7px 18px rgba(89, 99, 70, 0.22);
    }

    .education-conversation-create-button i {
        font-size: 14px;
    }

    /* =========================================================
       STAT
    ========================================================= */

    .education-conversations-stat {
        min-width: 150px;
        padding: 16px 20px;
        border-radius: 15px;
        background: #faf7ee;
        border: 1px solid #e6ddc8;
        text-align: center;
    }

    .education-conversations-stat-number {
        display: block;
        font-size: 25px;
        font-weight: 800;
        color: #596346;
    }

    .education-conversations-stat-label {
        display: block;
        margin-top: 3px;
        color: #858276;
        font-size: 12px;
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
       TABLE CARD
    ========================================================= */

    .education-conversations-card {
        background: #fffdf8;
        border: 1px solid #e7dfcb;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 8px 28px rgba(48, 55, 42, 0.07);
    }

    .education-conversations-card-header {
        padding: 20px 23px;
        background: #faf7ee;
        border-bottom: 1px solid #e9e1cf;
    }

    .education-conversations-card-header h2 {
        margin: 0;
        color: #30372a;
        font-size: 17px;
        font-weight: 800;
    }

    .education-conversations-table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    .education-conversations-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 930px;
    }

    .education-conversations-table th {
        padding: 15px 18px;
        background: #fffaf0;
        color: #777568;
        font-size: 12px;
        font-weight: 800;
        text-align: right;
        white-space: nowrap;
        border-bottom: 1px solid #ebe3d2;
    }

    .education-conversations-table td {
        padding: 17px 18px;
        color: #44483c;
        font-size: 13px;
        vertical-align: middle;
        border-bottom: 1px solid #eee9dd;
    }

    .education-conversations-table tbody tr {
        transition: background 0.2s ease;
    }

    .education-conversations-table tbody tr:hover {
        background: #fcfaf4;
    }

    .education-conversations-table tbody tr:last-child td {
        border-bottom: 0;
    }

    /* =========================================================
       CONVERSATION
    ========================================================= */

    .education-conversation-subject {
        display: block;
        max-width: 280px;
        color: #30372a;
        font-weight: 800;
        text-decoration: none;
        line-height: 1.6;
    }

    .education-conversation-subject:hover {
        color: #9a7b2f;
    }

    .education-conversation-id {
        display: block;
        margin-top: 3px;
        color: #aaa394;
        font-size: 11px;
        direction: ltr;
        text-align: right;
    }

    /* =========================================================
       STUDENT
    ========================================================= */

    .education-conversation-student {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .education-conversation-student-avatar {
        width: 36px;
        height: 36px;
        flex: 0 0 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #e9ecdf;
        color: #596346;
        font-size: 14px;
    }

    .education-conversation-student-info {
        min-width: 0;
    }

    .education-conversation-student-name {
        display: block;
        color: #3d4335;
        font-weight: 700;
    }

    .education-conversation-student-email {
        display: block;
        margin-top: 2px;
        color: #989589;
        font-size: 11px;
        direction: ltr;
        text-align: right;
    }

    /* =========================================================
       MESSAGE
    ========================================================= */

    .education-conversation-last-message {
        max-width: 270px;
        color: #777568;
        line-height: 1.7;
    }

    .education-conversation-last-message-empty {
        color: #aaa69b;
        font-style: italic;
    }

    /* =========================================================
       STATUS
    ========================================================= */

    .education-conversation-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 11px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 800;
        white-space: nowrap;
    }

    .education-conversation-status-open {
        color: #49633e;
        background: #edf5e9;
        border: 1px solid #d4e4cc;
    }

    .education-conversation-status-closed {
        color: #8a6660;
        background: #f7eeee;
        border: 1px solid #ead5d1;
    }

    .education-conversation-status-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor;
    }

    /* =========================================================
       DATE
    ========================================================= */

    .education-conversation-date {
        color: #858276;
        font-size: 12px;
        white-space: nowrap;
    }

    /* =========================================================
       ACTIONS
    ========================================================= */

    .education-conversation-actions {
        display: flex;
        align-items: center;
        gap: 7px;
        flex-wrap: wrap;
    }

    .education-conversation-view-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        min-height: 36px;
        padding: 0 13px;
        border-radius: 9px;
        color: #596346;
        background: #f2efe4;
        border: 1px solid #dfd8c6;
        text-decoration: none;
        font-size: 12px;
        font-weight: 700;
        transition: all 0.2s ease;
        white-space: nowrap;
    }

    .education-conversation-view-button:hover {
        color: #fff;
        background: #596346;
        border-color: #596346;
        transform: translateY(-1px);
    }

    .education-conversation-delete-form {
        margin: 0;
        padding: 0;
    }

    .education-conversation-delete-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        min-height: 36px;
        padding: 0 13px;
        border-radius: 9px;
        color: #9a4f4f;
        background: #fff4f2;
        border: 1px solid #ebd1cc;
        font-family: inherit;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s ease;
        white-space: nowrap;
    }

    .education-conversation-delete-button:hover {
        color: #fff;
        background: #a85656;
        border-color: #a85656;
        transform: translateY(-1px);
        box-shadow: 0 5px 14px rgba(168, 86, 86, 0.16);
    }

    /* =========================================================
       EMPTY
    ========================================================= */

    .education-conversations-empty {
        padding: 65px 25px;
        text-align: center;
    }

    .education-conversations-empty-icon {
        width: 70px;
        height: 70px;
        margin: 0 auto 18px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f2efe5;
        color: #9a7b2f;
        font-size: 27px;
    }

    .education-conversations-empty h3 {
        margin: 0 0 8px;
        color: #404638;
        font-size: 18px;
        font-weight: 800;
    }

    .education-conversations-empty p {
        margin: 0;
        color: #969286;
        font-size: 13px;
    }

    /* =========================================================
       EMPTY ACTION
    ========================================================= */

    .education-conversations-empty-action {
        margin-top: 22px;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 850px) {

        .education-admin-conversations-header {
            flex-direction: column;
        }

        .education-admin-conversations-header-actions {
            width: 100%;
            flex-wrap: wrap;
        }

        .education-conversations-stat {
            width: 100%;
            box-sizing: border-box;
        }

        .education-conversation-create-button {
            flex: 1;
        }
    }

    @media (max-width: 700px) {

        .education-admin-conversations-heading h1 {
            font-size: 24px;
        }

        .education-admin-conversations-header-actions {
            flex-direction: column;
            align-items: stretch;
        }

        .education-conversation-create-button {
            width: 100%;
            box-sizing: border-box;
        }

        .education-conversations-stat {
            width: 100%;
        }

        .education-conversation-actions {
            flex-direction: column;
            align-items: stretch;
        }

        .education-conversation-view-button,
        .education-conversation-delete-button {
            width: 100%;
            box-sizing: border-box;
        }
    }
</style>

<div class="education-admin-conversations-page">

{{-- =========================================================
     PAGE HEADER
========================================================== --}}

<div class="education-admin-conversations-header">

    <div class="education-admin-conversations-heading">

        <div class="education-admin-page-header-label">
            <i class="fa-solid fa-comments"></i>
            {{ __('education_admin.conversations.education_management') }}
        </div>

        <h1>
            {{ __('education_admin.conversations.title') }}
        </h1>

        <p>
            {{ __('education_admin.conversations.description') }}
        </p>

    </div>


    {{-- =====================================================
         HEADER ACTIONS
    ====================================================== --}}

    <div class="education-admin-conversations-header-actions">

        <a
            href="{{ route('education.admin.conversations.create') }}"
            class="education-conversation-create-button"
        >

            <i class="fa-solid fa-plus"></i>

            {{ __('education_admin.conversations.start_new') }}

        </a>


        <div class="education-conversations-stat">

            <span class="education-conversations-stat-number">
                {{ $conversations->count() }}
            </span>

            <span class="education-conversations-stat-label">
                {{ __('education_admin.conversations.total_conversations') }}
            </span>

        </div>

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
     CARD
========================================================== --}}

<div class="education-conversations-card">

    <div class="education-conversations-card-header">

        <h2>
            {{ __('education_admin.conversations.all_conversations') }}
        </h2>

    </div>


    @if ($conversations->isNotEmpty())

        <div class="education-conversations-table-wrapper">

            <table class="education-conversations-table">

                <thead>

                    <tr>

                        <th>
                            {{ __('education_admin.conversations.subject') }}
                        </th>

                        <th>
                            {{ __('education_admin.conversations.student') }}
                        </th>

                        <th>
                            {{ __('education_admin.conversations.last_message') }}
                        </th>

                        <th>
                            {{ __('education_admin.conversations.status') }}
                        </th>

                        <th>
                            {{ __('education_admin.conversations.last_update') }}
                        </th>

                        <th>
                            {{ __('education_admin.conversations.actions') }}
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @foreach ($conversations as $conversation)

                        @php

                            $student =
                                $conversation->educationUser;

                            $latestMessage =
                                $conversation->latestMessage;

                            $subject =
                                $conversation->subject
                                ?? $conversation->title
                                ?? __('education_admin.conversations.untitled_conversation');

                            $status =
                                $conversation->status
                                ?? 'open';

                        @endphp


                        <tr>

                            {{-- =================================================
                                 SUBJECT
                            ================================================== --}}

                            <td>

                                <a
                                    href="{{ route(
                                        'education.admin.conversations.show',
                                        $conversation
                                    ) }}"
                                    class="education-conversation-subject"
                                >

                                    {{ $subject }}

                                </a>


                                <span class="education-conversation-id">

                                    #{{ $conversation->id }}

                                </span>

                            </td>


                            {{-- =================================================
                                 STUDENT
                            ================================================== --}}

                            <td>

                                <div class="education-conversation-student">

                                    <div class="education-conversation-student-avatar">

                                        <i class="fa-solid fa-user"></i>

                                    </div>


                                    <div class="education-conversation-student-info">

                                        <span class="education-conversation-student-name">

                                            {{ $student?->name ?? __('education_admin.conversations.unknown_student') }}

                                        </span>


                                        @if ($student?->email)

                                            <span class="education-conversation-student-email">

                                                {{ $student->email }}

                                            </span>

                                        @endif

                                    </div>

                                </div>

                            </td>


                            {{-- =================================================
                                 LAST MESSAGE
                            ================================================== --}}

                            <td>

                                @if ($latestMessage)

                                    <div class="education-conversation-last-message">

                                        @if ($latestMessage->message)

                                            {{ \Illuminate\Support\Str::limit(
                                                $latestMessage->message,
                                                90
                                            ) }}

                                        @elseif ($latestMessage->attachment)

                                            <span>

                                                <i class="fa-solid fa-paperclip"></i>

                                                {{ __('education_admin.conversations.attachment') }}

                                            </span>

                                        @else

                                            <span>
                                                {{ __('education_admin.conversations.message') }}
                                            </span>

                                        @endif

                                    </div>

                                @else

                                    <div class="education-conversation-last-message education-conversation-last-message-empty">

                                        {{ __('education_admin.conversations.no_messages') }}

                                    </div>

                                @endif

                            </td>


                            {{-- =================================================
                                 STATUS
                            ================================================== --}}

                            <td>

                                @if ($status === 'closed')

                                    <span class="education-conversation-status education-conversation-status-closed">

                                        <span class="education-conversation-status-dot"></span>

                                        {{ __('education_admin.conversations.closed') }}

                                    </span>

                                @else

                                    <span class="education-conversation-status education-conversation-status-open">

                                        <span class="education-conversation-status-dot"></span>

                                        {{ __('education_admin.conversations.open') }}

                                    </span>

                                @endif

                            </td>


                            {{-- =================================================
                                 DATE
                            ================================================== --}}

                            <td>

                                <div class="education-conversation-date">

                                    @if ($conversation->last_message_at)

                                        {{ $conversation->last_message_at?->locale(session('education_locale', 'ar'))->translatedFormat('Y-m-d H:i') }}

                                    @else

                                        {{ $conversation->created_at?->locale(session('education_locale', 'ar'))->translatedFormat('Y-m-d H:i') }}

                                    @endif

                                </div>

                            </td>


                            {{-- =================================================
                                 ACTIONS
                            ================================================== --}}

                            <td>

                                <div class="education-conversation-actions">

                                    {{-- VIEW --}}

                                    <a
                                        href="{{ route(
                                            'education.admin.conversations.show',
                                            $conversation
                                        ) }}"
                                        class="education-conversation-view-button"
                                        title="{{ __('education_admin.conversations.view') }}"
                                        aria-label="{{ __('education_admin.conversations.view') }}"
                                    >

                                        <i class="fa-solid fa-eye"></i>

                                    </a>


                                    {{-- DELETE --}}

                                    <form
                                        action="{{ route(
                                            'education.admin.conversations.destroy',
                                            $conversation
                                        ) }}"
                                        method="POST"
                                        class="education-conversation-delete-form"
                                        onsubmit="return confirm(@json(__('education_admin.conversations.delete_confirmation')));"
                                    >

                                        @csrf

                                        @method('DELETE')


                                        <button
                                            type="submit"
                                            class="education-conversation-delete-button"
                                            title="{{ __('education_admin.conversations.delete') }}"
                                            aria-label="{{ __('education_admin.conversations.delete') }}"
                                        >

                                            <i class="fa-solid fa-trash"></i>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    @else

        <div class="education-conversations-empty">

            <div class="education-conversations-empty-icon">

                <i class="fa-regular fa-comments"></i>

            </div>


            <h3>
                {{ __('education_admin.conversations.empty_title') }}
            </h3>


            <p>
                {{ __('education_admin.conversations.empty_description') }}
            </p>


            <div class="education-conversations-empty-action">

                <a
                    href="{{ route('education.admin.conversations.create') }}"
                    class="education-conversation-create-button"
                >

                    <i class="fa-solid fa-plus"></i>

                    {{ __('education_admin.conversations.start_new') }}

                </a>

            </div>

        </div>

    @endif

</div>
</div>

@endsection
