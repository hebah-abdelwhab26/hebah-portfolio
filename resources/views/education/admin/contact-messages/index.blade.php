@extends('education.admin.layouts.app')

@section('title', __('education_admin.contact_messages.page_title'))

@section('content')

<style>
    /* =========================================================
       CONTACT MESSAGES
       Modern Education Admin Design
    ========================================================= */

    .contact-messages-page {
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

    .cm-page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;

        background: linear-gradient(
            135deg,
            #ffffff 0%,
            #f8faf6 100%
        );

        border: 1px solid #e4e8e1;
        border-radius: 18px;

        padding: 20px 24px;
        margin-bottom: 20px;

        box-shadow: 0 4px 18px rgba(40, 52, 43, .045);
    }

    .cm-header-content {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .cm-header-icon {
        width: 52px;
        height: 52px;

        border-radius: 15px;

        display: flex;
        align-items: center;
        justify-content: center;

        background: rgba(73, 107, 82, .10);
        color: #496b52;

        font-size: 21px;
        flex-shrink: 0;
    }

    .cm-header-title {
        margin: 0;
        font-size: 22px;
        font-weight: 800;
        color: #29342d;
    }

    .cm-header-description {
        margin: 4px 0 0;
        color: #858e87;
        font-size: 12px;
    }


    /* =========================================================
       STATISTICS
    ========================================================= */

    .cm-stat-grid {
        display: grid;

        grid-template-columns:
            repeat(4, minmax(0, 1fr));

        gap: 14px;

        margin-bottom: 20px;
    }

    .cm-stat-card {
        position: relative;
        overflow: hidden;

        min-height: 105px;

        background: #ffffff;

        border: 1px solid #e4e8e1;
        border-radius: 16px;

        padding: 17px 18px;

        box-shadow: 0 4px 16px rgba(40, 52, 43, .04);

        transition:
            transform .18s ease,
            box-shadow .18s ease;
    }

    .cm-stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 22px rgba(40, 52, 43, .07);
    }

    .cm-stat-card::before {
        content: "";

        position: absolute;

        top: 0;
        right: 0;

        width: 4px;
        height: 100%;

        background: #496b52;
    }

    .cm-stat-card.new::before {
        background: #c49a4a;
    }

    .cm-stat-card.read::before {
        background: #4b91a8;
    }

    .cm-stat-card.replied::before {
        background: #4f8d5d;
    }

    .cm-stat-content {
        display: flex;
        align-items: center;
        gap: 13px;
    }

    .cm-stat-icon {
        width: 46px;
        height: 46px;

        border-radius: 13px;

        display: flex;
        align-items: center;
        justify-content: center;

        flex-shrink: 0;

        font-size: 18px;
    }

    .cm-stat-icon.total {
        background: #edf3ee;
        color: #496b52;
    }

    .cm-stat-icon.new {
        background: #fbf3df;
        color: #b08431;
    }

    .cm-stat-icon.read {
        background: #eaf5f7;
        color: #39819a;
    }

    .cm-stat-icon.replied {
        background: #eaf4ec;
        color: #4c8758;
    }

    .cm-stat-label {
        color: #89918b;
        font-size: 11px;
        margin-bottom: 5px;
    }

    .cm-stat-number {
        color: #28322c;
        font-size: 25px;
        line-height: 1;
        font-weight: 800;
    }


    /* =========================================================
       MESSAGES CARD
    ========================================================= */

    .cm-messages-card {
        background: #ffffff;

        border: 1px solid #e4e8e1;
        border-radius: 18px;

        overflow: hidden;

        box-shadow: 0 4px 20px rgba(40, 52, 43, .045);
    }

    .cm-card-header {
        min-height: 66px;

        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 15px;

        padding: 15px 20px;

        border-bottom: 1px solid #edf0eb;
        background: #ffffff;
    }

    .cm-card-title-area {
        display: flex;
        align-items: center;
        gap: 11px;
    }

    .cm-card-title-icon {
        width: 35px;
        height: 35px;

        border-radius: 10px;

        display: flex;
        align-items: center;
        justify-content: center;

        background: #edf3ee;
        color: #496b52;

        font-size: 14px;
    }

    .cm-card-title {
        margin: 0;

        font-size: 15px;
        font-weight: 800;

        color: #303a34;
    }

    .cm-card-subtitle {
        margin-top: 2px;

        font-size: 10px;
        color: #9aa19c;
    }

    .cm-total-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;

        padding: 7px 11px;

        border-radius: 9px;

        background: #edf3ee;
        color: #496b52;

        font-size: 11px;
        font-weight: 700;

        white-space: nowrap;
    }


    /* =========================================================
       TABLE
    ========================================================= */

    .cm-table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    .cm-table {
        width: 100%;
        min-width: 900px;

        border-collapse: collapse;
        margin: 0;
    }

    .cm-table thead th {
        padding: 12px 15px;

        background: #f8f9f7;

        border-bottom: 1px solid #e8ebe6;

        color: #858d87;

        font-size: 10px;
        font-weight: 800;

        white-space: nowrap;

        text-align: right;
    }

    .cm-table tbody td {
        padding: 13px 15px;

        border-bottom: 1px solid #f0f2ef;

        color: #4a544d;

        font-size: 12px;

        vertical-align: middle;
    }

    .cm-table tbody tr:last-child td {
        border-bottom: 0;
    }

    .cm-table tbody tr {
        transition: background .15s ease;
    }

    .cm-table tbody tr:hover {
        background: #fafcf9;
    }

    .cm-new-row {
        background: #fffdf7;
    }

    .cm-number {
        color: #9aa19b;
        font-size: 11px;
        font-weight: 700;
    }


    /* =========================================================
       SENDER
    ========================================================= */

    .cm-sender {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .cm-avatar {
        width: 37px;
        height: 37px;

        border-radius: 11px;

        display: flex;
        align-items: center;
        justify-content: center;

        background: #edf3ee;
        color: #496b52;

        flex-shrink: 0;

        font-size: 13px;
    }

    .cm-sender-name {
        color: #303a34;
        font-size: 12px;
        font-weight: 700;
    }

    .cm-new-label {
        margin-top: 2px;

        color: #b18432;

        font-size: 9px;
        font-weight: 700;
    }


    /* =========================================================
       EMAIL
    ========================================================= */

    .cm-email {
        color: #68726b;
        text-decoration: none;

        font-size: 11px;

        white-space: nowrap;
    }

    .cm-email:hover {
        color: #496b52;
    }


    /* =========================================================
       SUBJECT
    ========================================================= */

    .cm-subject {
        display: block;

        max-width: 220px;

        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;

        color: #3d4740;

        font-size: 12px;
        font-weight: 600;
    }


    /* =========================================================
       STATUS
    ========================================================= */

    .cm-status {
        display: inline-flex;
        align-items: center;
        gap: 5px;

        padding: 5px 8px;

        border-radius: 7px;

        font-size: 9px;
        font-weight: 800;

        white-space: nowrap;
    }

    .cm-status-new {
        background: #fff2d3;
        color: #9c7429;
    }

    .cm-status-read {
        background: #e8f4f7;
        color: #337e92;
    }

    .cm-status-replied {
        background: #e7f3e9;
        color: #3f7d4d;
    }


    /* =========================================================
       DATE
    ========================================================= */

    .cm-date {
        color: #8b938d;
        font-size: 10px;
        white-space: nowrap;
    }


    /* =========================================================
       ACTIONS
    ========================================================= */

    .cm-actions {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 5px;
    }

    .cm-action {
        width: 31px;
        height: 31px;

        padding: 0;

        border-radius: 8px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        font-size: 11px;

        transition: all .15s ease;
    }

    .cm-view {
        color: #496b52;
        background: #f0f5f1;
        border: 1px solid #dce8df;
    }

    .cm-view:hover {
        background: #496b52;
        color: #fff;
        border-color: #496b52;
    }

    .cm-delete {
        color: #b35f5f;
        background: #fdf1f1;
        border: 1px solid #f0dddd;
    }

    .cm-delete:hover {
        background: #b35f5f;
        color: #fff;
        border-color: #b35f5f;
    }


    /* =========================================================
       EMPTY
    ========================================================= */

    .cm-empty {
        padding: 65px 20px;

        text-align: center;
    }

    .cm-empty-icon {
        width: 68px;
        height: 68px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        border-radius: 20px;

        background: #f1f3f0;
        color: #a1a8a2;

        font-size: 26px;

        margin-bottom: 14px;
    }

    .cm-empty-title {
        margin: 0 0 5px;

        color: #3b453f;

        font-size: 15px;
        font-weight: 800;
    }

    .cm-empty-text {
        margin: 0;

        color: #979e99;

        font-size: 11px;
    }


    /* =========================================================
       PAGINATION
    ========================================================= */

    .cm-pagination {
        padding: 14px 20px;

        border-top: 1px solid #edf0eb;

        background: #fff;
    }

    .cm-pagination nav {
        margin: 0;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 1100px) {

        .cm-stat-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

    }

    @media (max-width: 700px) {

        .contact-messages-page {
            padding: 14px;
        }

        .cm-page-header {
            padding: 16px;
        }

        .cm-header-title {
            font-size: 18px;
        }

        .cm-header-description {
            font-size: 10px;
        }

        .cm-stat-grid {
            grid-template-columns: 1fr;
            gap: 10px;
        }

        .cm-stat-card {
            min-height: 88px;
        }

        .cm-card-header {
            padding: 13px 15px;
        }

    }
</style>

<div class="contact-messages-page">

{{-- =====================================================
     HEADER
====================================================== --}}

<div class="cm-page-header">

    <div class="cm-header-content">

        <div class="cm-header-icon">

            <i class="fas fa-envelope-open-text"></i>

        </div>

        <div>

            <h1 class="cm-header-title">
                {{ __('education_admin.contact_messages.title') }}
            </h1>

            <p class="cm-header-description">
                {{ __('education_admin.contact_messages.description') }}
            </p>

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
                aria-label="{{ __('education_admin.contact_messages.close') }}"></button>

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
                aria-label="{{ __('education_admin.contact_messages.close') }}"></button>

    </div>

@endif


{{-- =====================================================
     STATISTICS
====================================================== --}}

<div class="cm-stat-grid">

    {{-- Total --}}
    <div class="cm-stat-card">

        <div class="cm-stat-content">

            <div class="cm-stat-icon total">

                <i class="fas fa-inbox"></i>

            </div>

            <div>

                <div class="cm-stat-label">
                    {{ __('education_admin.contact_messages.total_messages') }}
                </div>

                <div class="cm-stat-number">
                    {{ $totalMessages }}
                </div>

            </div>

        </div>

    </div>


    {{-- New --}}
    <div class="cm-stat-card new">

        <div class="cm-stat-content">

            <div class="cm-stat-icon new">

                <i class="fas fa-envelope"></i>

            </div>

            <div>

                <div class="cm-stat-label">
                    {{ __('education_admin.contact_messages.new_messages') }}
                </div>

                <div class="cm-stat-number">
                    {{ $newMessages }}
                </div>

            </div>

        </div>

    </div>


    {{-- Read --}}
    <div class="cm-stat-card read">

        <div class="cm-stat-content">

            <div class="cm-stat-icon read">

                <i class="fas fa-envelope-open"></i>

            </div>

            <div>

                <div class="cm-stat-label">
                    {{ __('education_admin.contact_messages.read_messages') }}
                </div>

                <div class="cm-stat-number">
                    {{ $readMessages }}
                </div>

            </div>

        </div>

    </div>


    {{-- Replied --}}
    <div class="cm-stat-card replied">

        <div class="cm-stat-content">

            <div class="cm-stat-icon replied">

                <i class="fas fa-reply"></i>

            </div>

            <div>

                <div class="cm-stat-label">
                    {{ __('education_admin.contact_messages.replied_messages') }}
                </div>

                <div class="cm-stat-number">
                    {{ $repliedMessages }}
                </div>

            </div>

        </div>

    </div>

</div>


{{-- =====================================================
     MESSAGES
====================================================== --}}

<div class="cm-messages-card">

    <div class="cm-card-header">

        <div class="cm-card-title-area">

            <div class="cm-card-title-icon">

                <i class="fas fa-inbox"></i>

            </div>

            <div>

                <h2 class="cm-card-title">
                    {{ __('education_admin.contact_messages.inbox') }}
                </h2>

                <div class="cm-card-subtitle">
                    {{ __('education_admin.contact_messages.latest_messages') }}
                </div>

            </div>

        </div>


        <div class="cm-total-badge">

            <i class="fas fa-envelope"></i>

            {{ $messages->total() }}

            {{ __('education_admin.contact_messages.message_count') }}

        </div>

    </div>


    @if($messages->count())

        <div class="cm-table-wrapper">

            <table class="cm-table">

                <thead>

                    <tr>

                        <th style="width:55px;">
                            #
                        </th>

                        <th>
                            {{ __('education_admin.contact_messages.sender') }}
                        </th>

                        <th>
                            {{ __('education_admin.contact_messages.email') }}
                        </th>

                        <th>
                            {{ __('education_admin.contact_messages.subject') }}
                        </th>

                        <th>
                            {{ __('education_admin.contact_messages.status') }}
                        </th>

                        <th>
                            {{ __('education_admin.contact_messages.date') }}
                        </th>

                        <th style="width:90px; text-align:center;">
                            {{ __('education_admin.contact_messages.actions') }}
                        </th>

                    </tr>

                </thead>


                <tbody>

                @foreach($messages as $message)

                    <tr class="{{ $message->isNew() ? 'cm-new-row' : '' }}">

                        {{-- Number --}}
                        <td>

                            <span class="cm-number">

                                {{ $messages->firstItem() + $loop->index }}

                            </span>

                        </td>


                        {{-- Sender --}}
                        <td>

                            <div class="cm-sender">

                                <div class="cm-avatar">

                                    <i class="fas fa-user"></i>

                                </div>

                                <div>

                                    <div class="cm-sender-name">

                                        {{ $message->name }}

                                    </div>

                                    @if($message->isNew())

                                        <div class="cm-new-label">

                                            <i class="fas fa-circle"
                                               style="font-size:4px;"></i>

                                            {{ __('education_admin.contact_messages.new') }}

                                        </div>

                                    @endif

                                </div>

                            </div>

                        </td>


                        {{-- Email --}}
                        <td>

                            <a href="mailto:{{ $message->email }}"
                               class="cm-email">

                                {{ $message->email }}

                            </a>

                        </td>


                        {{-- Subject --}}
                        <td>

                            <span class="cm-subject"
                                  title="{{ $message->subject }}">

                                {{ $message->subject }}

                            </span>

                        </td>


                        {{-- Status --}}
                        <td>

                            @switch($message->status)

                                @case('new')

                                    <span class="cm-status cm-status-new">

                                        <i class="fas fa-envelope"></i>

                                        {{ __('education_admin.contact_messages.status_new') }}

                                    </span>

                                    @break


                                @case('read')

                                    <span class="cm-status cm-status-read">

                                        <i class="fas fa-envelope-open"></i>

                                        {{ __('education_admin.contact_messages.status_read') }}

                                    </span>

                                    @break


                                @case('replied')

                                    <span class="cm-status cm-status-replied">

                                        <i class="fas fa-reply"></i>

                                        {{ __('education_admin.contact_messages.status_replied') }}

                                    </span>

                                    @break


                                @default

                                    <span class="badge bg-secondary">
                                        {{ $message->status }}
                                    </span>

                            @endswitch

                        </td>


                        {{-- Date --}}
                        <td>

                            <span class="cm-date">

                                <i class="far fa-clock me-1"></i>

                                {{ $message->created_at?->locale(session('education_locale', 'ar'))->translatedFormat('Y-m-d H:i') }}

                            </span>

                        </td>


                        {{-- Actions --}}
                        <td>

                            <div class="cm-actions">

                                <a href="{{ route('education.admin.contact-messages.show', $message) }}"
                                   class="btn cm-action cm-view"
                                   title="{{ __('education_admin.contact_messages.view_message') }}">

                                    <i class="fas fa-eye"></i>

                                </a>


                                <form action="{{ route('education.admin.contact-messages.destroy', $message) }}"
                                      method="POST"
                                      onsubmit="return confirm(@json(__('education_admin.contact_messages.delete_confirmation')));">

                                    @csrf

                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn cm-action cm-delete"
                                            title="{{ __('education_admin.contact_messages.delete_message') }}">

                                        <i class="fas fa-trash"></i>

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

        <div class="cm-empty">

            <div class="cm-empty-icon">

                <i class="fas fa-inbox"></i>

            </div>

            <h3 class="cm-empty-title">
                {{ __('education_admin.contact_messages.empty_title') }}
            </h3>

            <p class="cm-empty-text">
                {{ __('education_admin.contact_messages.empty_description') }}
            </p>

        </div>

    @endif


    @if($messages->hasPages())

        <div class="cm-pagination">

            {{ $messages->links() }}

        </div>

    @endif

</div>

</div>

@endsection
