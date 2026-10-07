@extends('education.admin.layouts.app')

@section('title', __('education_admin.comments.page_title'))

@section('content')

<style>
    /* =========================================================
       EDUCATION ADMIN COMMENTS
       Cream / Olive Green / Gold
    ========================================================= */

    .education-admin-comments-page {
        direction: rtl;
        color: #30372a;
        padding-bottom: 50px;
    }

    /* =========================================================
       HEADER
    ========================================================= */

    .education-admin-comments-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 25px;
    }

    .education-admin-comments-heading {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .education-admin-comments-heading-icon {
        width: 50px;
        height: 50px;
        border-radius: 14px;
        background: #eee8d8;
        color: #7b8650;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 21px;
    }

    .education-admin-comments-heading h1 {
        margin: 0;
        font-size: 25px;
        font-weight: 800;
    }

    .education-admin-comments-heading p {
        margin: 5px 0 0;
        color: #85897d;
        font-size: 13px;
    }

    /* =========================================================
       ALERT
    ========================================================= */

    .education-admin-comments-alert {
        margin-bottom: 20px;
        padding: 14px 17px;
        border-radius: 13px;
        background: #edf2e5;
        border: 1px solid #d6dfc4;
        color: #526038;
        font-size: 13px;
    }

    /* =========================================================
       STATS
    ========================================================= */

    .education-admin-comments-stats {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 15px;
        margin-bottom: 20px;
    }

    .education-admin-comments-stat {
        background: #fffdf8;
        border: 1px solid #e7e1d2;
        border-radius: 16px;
        padding: 18px;
        box-shadow: 0 7px 22px rgba(48, 55, 42, .04);
    }

    .education-admin-comments-stat-label {
        color: #85897d;
        font-size: 12px;
        margin-bottom: 8px;
    }

    .education-admin-comments-stat-value {
        font-size: 25px;
        font-weight: 800;
        color: #30372a;
    }

    /* =========================================================
       FILTERS
    ========================================================= */

    .education-admin-comments-filter-card {
        background: #fffdf8;
        border: 1px solid #e7e1d2;
        border-radius: 18px;
        padding: 18px;
        margin-bottom: 20px;
    }

    .education-admin-comments-filter-form {
        display: grid;
        grid-template-columns: 1fr 220px auto;
        gap: 12px;
        align-items: end;
    }

    .education-admin-comments-filter-group label {
        display: block;
        margin-bottom: 7px;
        font-size: 12px;
        font-weight: 700;
        color: #555b4c;
    }

    .education-admin-comments-input,
    .education-admin-comments-select {
        width: 100%;
        box-sizing: border-box;
        border: 1px solid #ddd7c8;
        border-radius: 11px;
        background: #fff;
        color: #30372a;
        padding: 11px 12px;
        font-family: inherit;
        font-size: 13px;
        outline: none;
    }

    .education-admin-comments-input:focus,
    .education-admin-comments-select:focus {
        border-color: #a88a3d;
    }

    .education-admin-comments-filter-button {
        border: 0;
        border-radius: 11px;
        padding: 11px 20px;
        background: #6f7b48;
        color: #fff;
        font-family: inherit;
        font-weight: 700;
        cursor: pointer;
    }

    /* =========================================================
       TABLE
    ========================================================= */

    .education-admin-comments-table-card {
        background: #fffdf8;
        border: 1px solid #e7e1d2;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(48, 55, 42, .04);
    }

    .education-admin-comments-table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    .education-admin-comments-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 900px;
    }

    .education-admin-comments-table th {
        padding: 15px;
        text-align: right;
        background: #f5f1e7;
        color: #626758;
        font-size: 12px;
        font-weight: 800;
        white-space: nowrap;
    }

    .education-admin-comments-table td {
        padding: 16px 15px;
        border-top: 1px solid #eee9de;
        vertical-align: top;
        font-size: 13px;
    }

    .education-admin-comments-name {
        font-weight: 800;
        color: #30372a;
    }

    .education-admin-comments-email {
        margin-top: 4px;
        color: #909389;
        font-size: 11px;
    }

    .education-admin-comments-text {
        max-width: 380px;
        color: #60655a;
        line-height: 1.8;
        white-space: pre-line;
    }

    .education-admin-comments-date {
        color: #85897d;
        font-size: 12px;
        white-space: nowrap;
    }

    /* =========================================================
       STATUS
    ========================================================= */

    .education-admin-comments-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 10px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 800;
        white-space: nowrap;
    }

    .education-admin-comments-status.pending {
        background: #f7efdc;
        color: #98752b;
    }

    .education-admin-comments-status.approved {
        background: #e8efdf;
        color: #60753e;
    }

    .education-admin-comments-status.rejected {
        background: #f7e8e5;
        color: #a0574b;
    }

    /* =========================================================
       ACTIONS
    ========================================================= */

    .education-admin-comments-actions {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 7px;
    }

    .education-admin-comments-action {
        border: 0;
        border-radius: 9px;
        padding: 7px 10px;
        font-family: inherit;
        font-size: 11px;
        font-weight: 700;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .education-admin-comments-action.approve {
        background: #e8efdf;
        color: #60753e;
    }

    .education-admin-comments-action.reject {
        background: #f7efdc;
        color: #98752b;
    }

    .education-admin-comments-action.edit {
        background: #eee8d8;
        color: #776337;
    }

    .education-admin-comments-action.delete {
        background: #f7e8e5;
        color: #a0574b;
    }

    .education-admin-comments-empty {
        padding: 50px 20px;
        text-align: center;
        color: #85897d;
    }

    .education-admin-comments-empty i {
        display: block;
        font-size: 40px;
        margin-bottom: 12px;
        color: #b5aa8c;
    }

    /* =========================================================
       PAGINATION
    ========================================================= */

    .education-admin-comments-pagination {
        padding: 18px;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 900px) {

        .education-admin-comments-stats {
            grid-template-columns: repeat(2, 1fr);
        }

        .education-admin-comments-filter-form {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 600px) {

        .education-admin-comments-header {
            align-items: flex-start;
        }

        .education-admin-comments-stats {
            grid-template-columns: 1fr;
        }

        .education-admin-comments-heading h1 {
            font-size: 21px;
        }
    }
</style>

<div class="education-admin-comments-page">


{{-- =========================================================
    HEADER
========================================================== --}}

<div class="education-admin-comments-header">

    <div class="education-admin-comments-heading">

        <div class="education-admin-comments-heading-icon">
            <i class="fa-regular fa-comments"></i>
        </div>

        <div>

            <h1>
                {{ __('education_admin.comments.title') }}
            </h1>

            <p>
                {{ __('education_admin.comments.description') }}
            </p>

        </div>

    </div>

</div>


{{-- =========================================================
    SUCCESS
========================================================== --}}

@if(session('success'))

    <div class="education-admin-comments-alert">

        <i class="fa-solid fa-circle-check"></i>

        {{ session('success') }}

    </div>

@endif


{{-- =========================================================
    STATISTICS
========================================================== --}}

<div class="education-admin-comments-stats">

    <div class="education-admin-comments-stat">

        <div class="education-admin-comments-stat-label">
            {{ __('education_admin.comments.total_comments') }}
        </div>

        <div class="education-admin-comments-stat-value">
            {{ $totalCount }}
        </div>

    </div>


    <div class="education-admin-comments-stat">

        <div class="education-admin-comments-stat-label">
            {{ __('education_admin.comments.pending_review') }}
        </div>

        <div class="education-admin-comments-stat-value">
            {{ $pendingCount }}
        </div>

    </div>


    <div class="education-admin-comments-stat">

        <div class="education-admin-comments-stat-label">
            {{ __('education_admin.comments.published') }}
        </div>

        <div class="education-admin-comments-stat-value">
            {{ $approvedCount }}
        </div>

    </div>


    <div class="education-admin-comments-stat">

        <div class="education-admin-comments-stat-label">
            {{ __('education_admin.comments.rejected') }}
        </div>

        <div class="education-admin-comments-stat-value">
            {{ $rejectedCount }}
        </div>

    </div>

</div>


{{-- =========================================================
    FILTER
========================================================== --}}

<div class="education-admin-comments-filter-card">

    <form
        method="GET"
        action="{{ route('education.admin.comments.index') }}"
        class="education-admin-comments-filter-form"
    >

        <div class="education-admin-comments-filter-group">

            <label for="comment-search">
                {{ __('education_admin.comments.search') }}
            </label>

            <input
                type="text"
                id="comment-search"
                name="search"
                class="education-admin-comments-input"
                value="{{ request('search') }}"
                placeholder="{{ __('education_admin.comments.search_placeholder') }}"
            >

        </div>


        <div class="education-admin-comments-filter-group">

            <label for="comment-status">
                {{ __('education_admin.comments.status') }}
            </label>

            <select
                id="comment-status"
                name="status"
                class="education-admin-comments-select"
            >

                <option value="">
                    {{ __('education_admin.comments.all_statuses') }}
                </option>

                <option
                    value="pending"
                    @selected(request('status') === 'pending')
                >
                    {{ __('education_admin.comments.pending_review') }}
                </option>

                <option
                    value="approved"
                    @selected(request('status') === 'approved')
                >
                    {{ __('education_admin.comments.published') }}
                </option>

                <option
                    value="rejected"
                    @selected(request('status') === 'rejected')
                >
                    {{ __('education_admin.comments.rejected') }}
                </option>

            </select>

        </div>


        <button
            type="submit"
            class="education-admin-comments-filter-button"
        >

            <i class="fa-solid fa-filter"></i>

            {{ __('education_admin.comments.filter') }}

        </button>

    </form>

</div>


{{-- =========================================================
    TABLE
========================================================== --}}

<div class="education-admin-comments-table-card">

    <div class="education-admin-comments-table-wrapper">

        @forelse($comments as $comment)

            @if($loop->first)

                <table class="education-admin-comments-table">

                    <thead>

                        <tr>

                            <th>
                                {{ __('education_admin.comments.comment_author') }}
                            </th>

                            <th>
                                {{ __('education_admin.comments.comment') }}
                            </th>

                            <th>
                                {{ __('education_admin.comments.status') }}
                            </th>

                            <th>
                                {{ __('education_admin.comments.date') }}
                            </th>

                            <th>
                                {{ __('education_admin.comments.actions') }}
                            </th>

                        </tr>

                    </thead>

                    <tbody>

            @endif


                        <tr>

                            {{-- AUTHOR --}}

                            <td>

                                <div class="education-admin-comments-name">

                                    {{ $comment->name }}

                                </div>

                                @if($comment->email)

                                    <div class="education-admin-comments-email">

                                        {{ $comment->email }}

                                    </div>

                                @endif

                            </td>


                            {{-- COMMENT --}}

                            <td>

                                <div class="education-admin-comments-text">

                                    {{ $comment->comment }}

                                </div>

                            </td>


                            {{-- STATUS --}}

                            <td>

                                @if($comment->status === 'pending')

                                    <span class="education-admin-comments-status pending">

                                        <i class="fa-solid fa-clock"></i>

                                        {{ __('education_admin.comments.pending_review') }}

                                    </span>

                                @elseif($comment->status === 'approved')

                                    <span class="education-admin-comments-status approved">

                                        <i class="fa-solid fa-check"></i>

                                        {{ __('education_admin.comments.published') }}

                                    </span>

                                @else

                                    <span class="education-admin-comments-status rejected">

                                        <i class="fa-solid fa-xmark"></i>

                                        {{ __('education_admin.comments.rejected') }}

                                    </span>

                                @endif

                            </td>


                            {{-- DATE --}}

                            <td>

                                <div class="education-admin-comments-date">

                                    {{ $comment->created_at?->locale(session('education_locale', 'ar'))->translatedFormat('d F Y') }}

                                    <br>

                                    {{ $comment->created_at?->format('h:i A') }}

                                </div>

                            </td>


                            {{-- ACTIONS --}}

                            <td>

                                <div class="education-admin-comments-actions">

                                    @if($comment->status !== 'approved')

                                        <form
                                            method="POST"
                                            action="{{ route('education.admin.comments.approve', $comment) }}"
                                        >

                                            @csrf
                                            @method('PATCH')

                                            <button
                                                type="submit"
                                                class="education-admin-comments-action approve"
                                            >

                                                <i class="fa-solid fa-check"></i>

                                                {{ __('education_admin.comments.publish') }}

                                            </button>

                                        </form>

                                    @endif


                                    @if($comment->status !== 'rejected')

                                        <form
                                            method="POST"
                                            action="{{ route('education.admin.comments.reject', $comment) }}"
                                        >

                                            @csrf
                                            @method('PATCH')

                                            <button
                                                type="submit"
                                                class="education-admin-comments-action reject"
                                            >

                                                <i class="fa-solid fa-xmark"></i>

                                                {{ __('education_admin.comments.reject') }}

                                            </button>

                                        </form>

                                    @endif


                                    <a
                                        href="{{ route('education.admin.comments.edit', $comment) }}"
                                        class="education-admin-comments-action edit"
                                        title="{{ __('education_admin.comments.edit') }}"
                                    >

                                        <i class="fa-solid fa-pen"></i>

                                    </a>


                                    <form
                                        method="POST"
                                        action="{{ route('education.admin.comments.destroy', $comment) }}"
                                        onsubmit="return confirm(@json(__('education_admin.comments.delete_confirmation')));"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="education-admin-comments-action delete"
                                            title="{{ __('education_admin.comments.delete') }}"
                                        >

                                            <i class="fa-solid fa-trash"></i>
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>


            @if($loop->last)

                    </tbody>

                </table>

            @endif

        @empty

            <div class="education-admin-comments-empty">

                <i class="fa-regular fa-comments"></i>

                {{ __('education_admin.comments.empty') }}

            </div>

        @endforelse

    </div>


    @if($comments->hasPages())

        <div class="education-admin-comments-pagination">

            {{ $comments->links() }}

        </div>

    @endif

</div>
</div>

@endsection
