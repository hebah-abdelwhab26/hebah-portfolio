@extends('education.admin.layouts.app')

@section('title', __('education_admin.students.page_title'))

@section('content')

<div class="education-students-page">

    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}
    <div class="education-page-header">

        <div class="education-page-header-content">

            <div class="education-page-eyebrow">
                <span class="education-page-eyebrow-icon">
                    <i class="fa-solid fa-users"></i>
                </span>

                {{ __('education_admin.students.header.eyebrow') }}
            </div>

            <h1 class="education-page-title">
                {{ __('education_admin.students.header.title') }}
            </h1>

            <p class="education-page-description">
                {{ __('education_admin.students.header.description') }}
            </p>

        </div>

        <div class="education-page-header-actions">

            <a href="{{ route('education.admin.students.create') }}"
               class="education-primary-btn">

                <i class="fa-solid fa-user-plus"></i>

                <span>
                    {{ __('education_admin.students.actions.add_student') }}
                </span>

            </a>

        </div>

    </div>


    {{-- =========================================================
        STATISTICS
    ========================================================== --}}
    <div class="education-students-stats">

        {{-- Total --}}
        <div class="education-stat-card">

            <div class="education-stat-icon">
                <i class="fa-solid fa-users"></i>
            </div>

            <div class="education-stat-content">

                <span class="education-stat-label">
                    {{ __('education_admin.students.statistics.total.label') }}
                </span>

                <strong class="education-stat-value">
                    {{ $students->total() }}
                </strong>

                <span class="education-stat-description">
                    {{ __('education_admin.students.statistics.total.description') }}
                </span>

            </div>

        </div>


        {{-- Active --}}
        <div class="education-stat-card">

            <div class="education-stat-icon">
                <i class="fa-solid fa-user-check"></i>
            </div>

            <div class="education-stat-content">

                <span class="education-stat-label">
                    {{ __('education_admin.students.statistics.active.label') }}
                </span>

                <strong class="education-stat-value">
                    {{ $activeStudents ?? 0 }}
                </strong>

                <span class="education-stat-description">
                    {{ __('education_admin.students.statistics.active.description') }}
                </span>

            </div>

        </div>


        {{-- Pending --}}
        <div class="education-stat-card">

            <div class="education-stat-icon">
                <i class="fa-solid fa-hourglass-half"></i>
            </div>

            <div class="education-stat-content">

                <span class="education-stat-label">
                    {{ __('education_admin.students.statistics.pending.label') }}
                </span>

                <strong class="education-stat-value">
                    {{ $pendingStudents ?? 0 }}
                </strong>

                <span class="education-stat-description">
                    {{ __('education_admin.students.statistics.pending.description') }}
                </span>

            </div>

        </div>


        {{-- Approved --}}
        <div class="education-stat-card">

            <div class="education-stat-icon">
                <i class="fa-solid fa-circle-check"></i>
            </div>

            <div class="education-stat-content">

                <span class="education-stat-label">
                    {{ __('education_admin.students.statistics.approved.label') }}
                </span>

                <strong class="education-stat-value">
                    {{ $approvedStudents ?? 0 }}
                </strong>

                <span class="education-stat-description">
                    {{ __('education_admin.students.statistics.approved.description') }}
                </span>

            </div>

        </div>


        {{-- Goals --}}
        <div class="education-stat-card">

            <div class="education-stat-icon">
                <i class="fa-solid fa-bullseye"></i>
            </div>

            <div class="education-stat-content">

                <span class="education-stat-label">
                    {{ __('education_admin.students.statistics.goals.label') }}
                </span>

                <strong class="education-stat-value">
                    {{ $studentsWithGoals ?? 0 }}
                </strong>

                <span class="education-stat-description">
                    {{ __('education_admin.students.statistics.goals.description') }}
                </span>

            </div>

        </div>


        {{-- Inactive --}}
        <div class="education-stat-card">

            <div class="education-stat-icon">
                <i class="fa-solid fa-user-slash"></i>
            </div>

            <div class="education-stat-content">

                <span class="education-stat-label">
                    {{ __('education_admin.students.statistics.inactive.label') }}
                </span>

                <strong class="education-stat-value">
                    {{ $inactiveStudents ?? 0 }}
                </strong>

                <span class="education-stat-description">
                    {{ __('education_admin.students.statistics.inactive.description') }}
                </span>

            </div>

        </div>

    </div>


    {{-- =========================================================
        FILTERS
    ========================================================== --}}
    <div class="education-filter-card">

        <div class="education-filter-header">

            <div>

                <div class="education-filter-eyebrow">
                    <i class="fa-solid fa-sliders"></i>
                    {{ __('education_admin.students.filters.tools') }}
                </div>

                <h2>
                    {{ __('education_admin.students.filters.title') }}
                </h2>

            </div>

            <a href="{{ route('education.admin.students.index') }}"
               class="education-filter-reset">

                <i class="fa-solid fa-rotate-left"></i>

                {{ __('education_admin.students.filters.reset') }}

            </a>

        </div>


        <form method="GET"
              action="{{ route('education.admin.students.index') }}"
              class="education-students-filters">

            {{-- Search --}}
            <div class="education-filter-field education-filter-field-search">

                <label for="search">
                    {{ __('education_admin.students.filters.search.label') }}
                </label>

                <div class="education-input-wrapper">

                    <i class="fa-solid fa-magnifying-glass"></i>

                    <input
                        type="text"
                        id="search"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="{{ __('education_admin.students.filters.search.placeholder') }}"
                    >

                </div>

            </div>


            {{-- Account Status --}}
            <div class="education-filter-field">

                <label for="status">
                    {{ __('education_admin.students.filters.account_status.label') }}
                </label>

                <select id="status"
                        name="status">

                    <option value="">
                        {{ __('education_admin.students.filters.account_status.all') }}
                    </option>

                    <option value="active"
                        @selected(request('status') === 'active')>
                        {{ __('education_admin.students.filters.account_status.active') }}
                    </option>

                    <option value="inactive"
                        @selected(request('status') === 'inactive')>
                        {{ __('education_admin.students.filters.account_status.inactive') }}
                    </option>

                </select>

            </div>


            {{-- Approval Status --}}
            <div class="education-filter-field">

                <label for="approval_status">
                    {{ __('education_admin.students.filters.approval_status.label') }}
                </label>

                <select id="approval_status"
                        name="approval_status">

                    <option value="">
                        {{ __('education_admin.students.filters.approval_status.all') }}
                    </option>

                    <option value="pending"
                        @selected(request('approval_status') === 'pending')>
                        {{ __('education_admin.students.filters.approval_status.pending') }}
                    </option>

                    <option value="approved"
                        @selected(request('approval_status') === 'approved')>
                        {{ __('education_admin.students.filters.approval_status.approved') }}
                    </option>

                    <option value="rejected"
                        @selected(request('approval_status') === 'rejected')>
                        {{ __('education_admin.students.filters.approval_status.rejected') }}
                    </option>

                </select>

            </div>


            {{-- Education Level --}}
            <div class="education-filter-field">

                <label for="education_level">
                    {{ __('education_admin.students.filters.education_level.label') }}
                </label>

                <select id="education_level"
                        name="education_level">

                    <option value="">
                        {{ __('education_admin.students.filters.education_level.all') }}
                    </option>

                    @foreach($educationLevels ?? [] as $level)

                        <option value="{{ $level }}"
                            @selected((string) request('education_level') === (string) $level)>
                            {{ $level }}
                        </option>

                    @endforeach

                </select>

            </div>


            {{-- Sort --}}
            <div class="education-filter-field">

                <label for="sort">
                    {{ __('education_admin.students.filters.sort.label') }}
                </label>

                <select id="sort"
                        name="sort">

                    <option value="latest"
                        @selected(request('sort', 'latest') === 'latest')>
                        {{ __('education_admin.students.filters.sort.latest') }}
                    </option>

                    <option value="oldest"
                        @selected(request('sort') === 'oldest')>
                        {{ __('education_admin.students.filters.sort.oldest') }}
                    </option>

                    <option value="name_asc"
                        @selected(request('sort') === 'name_asc')>
                        {{ __('education_admin.students.filters.sort.name_asc') }}
                    </option>

                    <option value="name_desc"
                        @selected(request('sort') === 'name_desc')>
                        {{ __('education_admin.students.filters.sort.name_desc') }}
                    </option>

                </select>

            </div>


            {{-- Apply --}}
            <div class="education-filter-field education-filter-submit">

                <button type="submit"
                        class="education-primary-btn">

                    <i class="fa-solid fa-filter"></i>

                    <span>
                        {{ __('education_admin.students.filters.apply') }}
                    </span>

                </button>

            </div>

        </form>

    </div>


    {{-- =========================================================
        STUDENTS TABLE
    ========================================================== --}}
    <div class="education-table-card">

        <div class="education-table-header">

            <div>

                <div class="education-table-eyebrow">
                    <i class="fa-solid fa-list"></i>

                    {{ __('education_admin.students.table.eyebrow') }}
                </div>

                <h2>
                    {{ __('education_admin.students.table.title') }}
                </h2>

            </div>

            <div class="education-table-count">

                {{ __('education_admin.students.table.count', [
                    'count' => $students->total()
                ]) }}

            </div>

        </div>


        @if($students->count())

            <div class="education-table-wrapper">

                <table class="education-students-table">

                    <thead>

                        <tr>

                            <th>
                                {{ __('education_admin.students.table.student') }}
                            </th>

                            <th>
                                {{ __('education_admin.students.table.email') }}
                            </th>

                            <th>
                                {{ __('education_admin.students.table.phone') }}
                            </th>

                            <th>
                                {{ __('education_admin.students.table.level') }}
                            </th>

                            <th>
                                {{ __('education_admin.students.table.approval_status') }}
                            </th>

                            <th>
                                {{ __('education_admin.students.table.account_status') }}
                            </th>

                            <th>
                                {{ __('education_admin.students.table.registered_at') }}
                            </th>

                            <th>
                                {{ __('education_admin.students.table.actions') }}
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($students as $student)

                            @php

                                /*
                                |--------------------------------------------------------------------------
                                | Approval Status
                                |--------------------------------------------------------------------------
                                */

                                $approvalStatus = $student->approval_status
                                    ?? $student->status
                                    ?? 'pending';

                                $approvalLabel = match ($approvalStatus) {

                                    'approved' => __('education_admin.students.statuses.approval.approved'),

                                    'rejected' => __('education_admin.students.statuses.approval.rejected'),

                                    default => __('education_admin.students.statuses.approval.pending'),

                                };


                                /*
                                |--------------------------------------------------------------------------
                                | Account Status
                                |--------------------------------------------------------------------------
                                */

                                $accountIsActive = $student->is_active ?? $student->active ?? true;

                                $accountLabel = $accountIsActive
                                    ? __('education_admin.students.statuses.account.active')
                                    : __('education_admin.students.statuses.account.inactive');

                            @endphp


                            <tr>

                                {{-- Student --}}
                                <td>

                                    <div class="education-student-cell">

                                        <div class="education-student-avatar">

                                            @if(!empty($student->avatar))

                                                <img
                                                    src="{{ asset('storage/' . $student->avatar) }}"
                                                    alt="{{ $student->name }}"
                                                >

                                            @else

                                                {{ mb_substr(
                                                    __('education_admin.students.table.student_role'),
                                                    0,
                                                    1
                                                ) }}

                                            @endif

                                        </div>


                                        <div class="education-student-info">

                                            <strong>
                                                {{ $student->name ?: __('education_admin.students.table.no_name') }}
                                            </strong>

                                            <span>
                                                {{ __('education_admin.students.table.student_role') }}
                                            </span>

                                        </div>

                                    </div>

                                </td>


                                {{-- Email --}}
                                <td>

                                    <span class="education-table-text">

                                        {{ $student->email ?: __('education_admin.students.table.empty_value') }}

                                    </span>

                                </td>


                                {{-- Phone --}}
                                <td>

                                    <span class="education-table-text">

                                        {{ $student->phone ?: __('education_admin.students.table.empty_value') }}

                                    </span>

                                </td>


                                {{-- Education Level --}}
                                <td>

                                    <span class="education-level-badge">

                                        {{ $student->educationLevel->name
                                            ?? $student->education_level
                                            ?? __('education_admin.students.table.empty_value') }}

                                    </span>

                                </td>


                                {{-- Approval Status --}}
                                <td>

                                    <span class="education-status-badge education-status-{{ $approvalStatus }}">

                                        @if($approvalStatus === 'approved')

                                            <i class="fa-solid fa-circle-check"></i>

                                        @elseif($approvalStatus === 'rejected')

                                            <i class="fa-solid fa-circle-xmark"></i>

                                        @else

                                            <i class="fa-solid fa-clock"></i>

                                        @endif

                                        {{ $approvalLabel }}

                                    </span>

                                </td>


                                {{-- Account Status --}}
                                <td>

                                    <span class="education-status-badge {{ $accountIsActive ? 'education-status-active' : 'education-status-inactive' }}">

                                        @if($accountIsActive)

                                            <i class="fa-solid fa-circle-check"></i>

                                        @else

                                            <i class="fa-solid fa-circle-xmark"></i>

                                        @endif

                                        {{ $accountLabel }}

                                    </span>

                                </td>


                                {{-- Registered At --}}
                                <td>

                                    <span class="education-table-date">

                                        {{ $student->created_at?->format('Y/m/d') ?? __('education_admin.students.table.empty_value') }}

                                    </span>

                                </td>


                                {{-- Actions --}}
                                <td>

                                    <div class="education-table-actions">

                                        {{-- View --}}
                                        @if(Route::has('education.admin.students.show'))

                                            <a
                                                href="{{ route('education.admin.students.show', $student) }}"
                                                class="education-action-btn education-action-view"
                                                title="{{ __('education_admin.students.actions.view') }}"
                                            >

                                                <i class="fa-solid fa-eye"></i>

                                            </a>

                                        @endif


                                        {{-- Edit --}}
                                        @if(Route::has('education.admin.students.edit'))

                                            <a
                                                href="{{ route('education.admin.students.edit', $student) }}"
                                                class="education-action-btn education-action-edit"
                                                title="{{ __('education_admin.students.actions.edit') }}"
                                            >

                                                <i class="fa-solid fa-pen"></i>

                                            </a>

                                        @endif


                                        {{-- Activate / Deactivate --}}
                                        @if(Route::has('education.admin.students.toggle-status'))

                                            <form
                                                method="POST"
                                                action="{{ route('education.admin.students.toggle-status', $student) }}"
                                                class="education-inline-form"
                                            >

                                                @csrf
                                                @method('PATCH')

                                                <button
                                                    type="submit"
                                                    class="education-action-btn {{ $accountIsActive ? 'education-action-warning' : 'education-action-success' }}"
                                                    title="{{ $accountIsActive
                                                        ? __('education_admin.students.actions.deactivate')
                                                        : __('education_admin.students.actions.activate') }}"
                                                >

                                                    @if($accountIsActive)

                                                        <i class="fa-solid fa-user-slash"></i>

                                                    @else

                                                        <i class="fa-solid fa-user-check"></i>

                                                    @endif

                                                </button>

                                            </form>

                                        @endif


                                        {{-- Delete --}}
                                        @if(Route::has('education.admin.students.destroy'))

                                            <form
                                                method="POST"
                                                action="{{ route('education.admin.students.destroy', $student) }}"
                                                class="education-inline-form"
                                                onsubmit="return confirm('{{ __('education_admin.students.confirm.delete') }}');"
                                            >

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="education-action-btn education-action-delete"
                                                    title="{{ __('education_admin.students.actions.delete') }}"
                                                >

                                                    <i class="fa-solid fa-trash"></i>

                                                </button>

                                            </form>

                                        @endif

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>


            {{-- =====================================================
                PAGINATION
            ====================================================== --}}
            @if($students->hasPages())

                <div class="education-pagination-wrapper">

                    <div class="education-pagination-info">

                        {{ __('education_admin.students.pagination.showing') }}

                        <strong>
                            {{ $students->firstItem() }}
                        </strong>

                        {{ __('education_admin.students.pagination.to') }}

                        <strong>
                            {{ $students->lastItem() }}
                        </strong>

                        {{ __('education_admin.students.pagination.of') }}

                        <strong>
                            {{ $students->total() }}
                        </strong>

                        {{ __('education_admin.students.pagination.student') }}

                    </div>


                    <div class="education-pagination">

                        {{ $students->withQueryString()->links() }}

                    </div>

                </div>

            @endif


        @else

            {{-- =====================================================
                EMPTY STATE
            ====================================================== --}}
            <div class="education-empty-state">

                <div class="education-empty-icon">

                    <i class="fa-solid fa-users-slash"></i>

                </div>

                <h3>
                    {{ __('education_admin.students.empty.title') }}
                </h3>

                <p>
                    {{ __('education_admin.students.empty.description') }}
                </p>

                <a
                    href="{{ route('education.admin.students.index') }}"
                    class="education-secondary-btn"
                >

                    <i class="fa-solid fa-users"></i>

                    {{ __('education_admin.students.empty.show_all') }}

                </a>

            </div>

        @endif

    </div>

</div>


{{-- =============================================================
    PAGE CSS
    ============================================================= --}}
<style>

    /* =========================================================
       PAGE
    ========================================================== */

    .education-students-page {
        width: 100%;
    }


    /* =========================================================
       HEADER
    ========================================================== */

    .education-page-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 30px;
        margin-bottom: 30px;
    }

    .education-page-header-content {
        min-width: 0;
    }

    .education-page-eyebrow,
    .education-filter-eyebrow,
    .education-table-eyebrow {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #9a7b2f;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 9px;
    }

    .education-page-eyebrow-icon {
        width: 28px;
        height: 28px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        background: rgba(154, 123, 47, 0.10);
    }

    .education-page-title {
        margin: 0;
        color: #173b45;
        font-size: 32px;
        line-height: 1.25;
        font-weight: 800;
    }

    .education-page-description {
        margin: 9px 0 0;
        color: #7a878b;
        font-size: 14px;
        line-height: 1.8;
    }

    .education-page-header-actions {
        flex-shrink: 0;
    }


    /* =========================================================
       BUTTONS
    ========================================================== */

    .education-primary-btn,
    .education-secondary-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        min-height: 45px;
        padding: 0 18px;
        border-radius: 12px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 700;
        transition: all .2s ease;
        cursor: pointer;
        border: 0;
    }

    .education-primary-btn {
        color: #fff;
        background: #235d70;
        box-shadow: 0 8px 20px rgba(35, 93, 112, .16);
    }

    .education-primary-btn:hover {
        transform: translateY(-1px);
        background: #1d4e5e;
        color: #fff;
    }

    .education-secondary-btn {
        color: #235d70;
        background: rgba(35, 93, 112, .08);
    }

    .education-secondary-btn:hover {
        background: rgba(35, 93, 112, .14);
        color: #235d70;
    }


    /* =========================================================
       STATISTICS
    ========================================================== */

    .education-students-stats {
        display: grid;
        grid-template-columns: repeat(6, minmax(0, 1fr));
        gap: 15px;
        margin-bottom: 24px;
    }

    .education-stat-card {
        min-width: 0;
        padding: 18px;
        border: 1px solid rgba(35, 93, 112, .08);
        border-radius: 17px;
        background: #fff;
        box-shadow: 0 7px 25px rgba(23, 59, 69, .05);
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }

    .education-stat-icon {
        width: 42px;
        height: 42px;
        flex: 0 0 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        color: #9a7b2f;
        background: rgba(154, 123, 47, .10);
        font-size: 16px;
    }

    .education-stat-content {
        min-width: 0;
    }

    .education-stat-label {
        display: block;
        color: #52656b;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .education-stat-value {
        display: block;
        margin-top: 4px;
        color: #173b45;
        font-size: 23px;
        line-height: 1.2;
    }

    .education-stat-description {
        display: block;
        margin-top: 4px;
        color: #97a1a5;
        font-size: 10px;
        line-height: 1.5;
    }


    /* =========================================================
       FILTER CARD
    ========================================================== */

    .education-filter-card,
    .education-table-card {
        border: 1px solid rgba(35, 93, 112, .08);
        border-radius: 19px;
        background: #fff;
        box-shadow: 0 8px 28px rgba(23, 59, 69, .05);
    }

    .education-filter-card {
        padding: 22px;
        margin-bottom: 24px;
    }

    .education-filter-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 20px;
    }

    .education-filter-header h2,
    .education-table-header h2 {
        margin: 0;
        color: #173b45;
        font-size: 19px;
        font-weight: 800;
    }

    .education-filter-reset {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        color: #8a7777;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        transition: color .2s ease;
    }

    .education-filter-reset:hover {
        color: #235d70;
    }

    .education-students-filters {
        display: grid;
        grid-template-columns: 2fr repeat(4, 1fr) auto;
        gap: 14px;
        align-items: end;
    }

    .education-filter-field {
        min-width: 0;
    }

    .education-filter-field label {
        display: block;
        margin-bottom: 7px;
        color: #52656b;
        font-size: 12px;
        font-weight: 700;
    }

    .education-input-wrapper {
        position: relative;
    }

    .education-input-wrapper > i {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        right: 13px;
        color: #9aa5a8;
        font-size: 12px;
        pointer-events: none;
    }

    html[dir="ltr"] .education-input-wrapper > i {
        right: auto;
        left: 13px;
    }

    .education-input-wrapper input,
    .education-filter-field select {
        width: 100%;
        height: 43px;
        border: 1px solid #e3e7e7;
        border-radius: 11px;
        background: #fbfcfc;
        color: #354e55;
        outline: none;
        font-family: inherit;
        font-size: 12px;
        transition: border-color .2s ease, box-shadow .2s ease;
    }

    .education-input-wrapper input {
        padding: 0 38px 0 12px;
    }

    html[dir="ltr"] .education-input-wrapper input {
        padding: 0 12px 0 38px;
    }

    .education-filter-field select {
        padding: 0 12px;
        cursor: pointer;
    }

    .education-input-wrapper input:focus,
    .education-filter-field select:focus {
        border-color: rgba(35, 93, 112, .45);
        box-shadow: 0 0 0 3px rgba(35, 93, 112, .07);
    }

    .education-filter-submit .education-primary-btn {
        width: 100%;
        white-space: nowrap;
    }


    /* =========================================================
       TABLE
    ========================================================== */

    .education-table-card {
        overflow: hidden;
    }

    .education-table-header {
        min-height: 85px;
        padding: 20px 22px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        border-bottom: 1px solid #edf0f0;
    }

    .education-table-count {
        padding: 8px 12px;
        border-radius: 9px;
        color: #235d70;
        background: rgba(35, 93, 112, .07);
        font-size: 11px;
        font-weight: 800;
        white-space: nowrap;
    }

    .education-table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    .education-students-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 1050px;
    }

    .education-students-table thead th {
        padding: 14px 16px;
        color: #7a898e;
        background: #fafbfb;
        border-bottom: 1px solid #edf0f0;
        font-size: 11px;
        font-weight: 800;
        text-align: right;
        white-space: nowrap;
    }

    html[dir="ltr"] .education-students-table thead th {
        text-align: left;
    }

    .education-students-table tbody td {
        padding: 15px 16px;
        border-bottom: 1px solid #f0f2f2;
        color: #4e6167;
        font-size: 12px;
        vertical-align: middle;
    }

    .education-students-table tbody tr:last-child td {
        border-bottom: 0;
    }

    .education-students-table tbody tr {
        transition: background .2s ease;
    }

    .education-students-table tbody tr:hover {
        background: #fcfdfd;
    }


    /* =========================================================
       STUDENT CELL
    ========================================================== */

    .education-student-cell {
        display: flex;
        align-items: center;
        gap: 11px;
        min-width: 190px;
    }

    .education-student-avatar {
        width: 42px;
        height: 42px;
        flex: 0 0 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        border-radius: 50%;
        color: #235d70;
        background: rgba(35, 93, 112, .09);
        font-size: 13px;
        font-weight: 800;
    }

    .education-student-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .education-student-info {
        min-width: 0;
    }

    .education-student-info strong {
        display: block;
        color: #304d55;
        font-size: 12px;
        font-weight: 800;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 160px;
    }

    .education-student-info span {
        display: block;
        margin-top: 3px;
        color: #9aa5a8;
        font-size: 10px;
    }

    .education-table-text {
        color: #617278;
        white-space: nowrap;
    }

    .education-table-date {
        color: #7d8b8f;
        font-size: 11px;
        white-space: nowrap;
    }


    /* =========================================================
       LEVEL
    ========================================================== */

    .education-level-badge {
        display: inline-flex;
        align-items: center;
        min-height: 27px;
        padding: 0 9px;
        border-radius: 8px;
        color: #52656b;
        background: #f3f5f5;
        font-size: 10px;
        font-weight: 700;
        white-space: nowrap;
    }


    /* =========================================================
       STATUS
    ========================================================== */

    .education-status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        min-height: 28px;
        padding: 0 9px;
        border-radius: 8px;
        font-size: 10px;
        font-weight: 800;
        white-space: nowrap;
    }

    .education-status-approved,
    .education-status-active {
        color: #397154;
        background: rgba(57, 113, 84, .09);
    }

    .education-status-pending {
        color: #9a7b2f;
        background: rgba(154, 123, 47, .10);
    }

    .education-status-rejected,
    .education-status-inactive {
        color: #9b5b5b;
        background: rgba(155, 91, 91, .09);
    }


    /* =========================================================
       ACTIONS
    ========================================================== */

    .education-table-actions {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .education-inline-form {
        display: inline-flex;
        margin: 0;
    }

    .education-action-btn {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 0;
        border-radius: 8px;
        text-decoration: none;
        cursor: pointer;
        transition: all .2s ease;
        font-size: 11px;
    }

    .education-action-view {
        color: #235d70;
        background: rgba(35, 93, 112, .08);
    }

    .education-action-view:hover {
        background: rgba(35, 93, 112, .15);
    }

    .education-action-edit {
        color: #80651f;
        background: rgba(154, 123, 47, .09);
    }

    .education-action-edit:hover {
        background: rgba(154, 123, 47, .16);
    }

    .education-action-warning {
        color: #986d2b;
        background: rgba(152, 109, 43, .09);
    }

    .education-action-warning:hover {
        background: rgba(152, 109, 43, .16);
    }

    .education-action-success {
        color: #397154;
        background: rgba(57, 113, 84, .09);
    }

    .education-action-success:hover {
        background: rgba(57, 113, 84, .16);
    }

    .education-action-delete {
        color: #a05454;
        background: rgba(160, 84, 84, .08);
    }

    .education-action-delete:hover {
        background: rgba(160, 84, 84, .15);
    }


    /* =========================================================
       EMPTY STATE
    ========================================================== */

    .education-empty-state {
        padding: 70px 25px;
        text-align: center;
    }

    .education-empty-icon {
        width: 68px;
        height: 68px;
        margin: 0 auto 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 18px;
        color: #9a7b2f;
        background: rgba(154, 123, 47, .09);
        font-size: 23px;
    }

    .education-empty-state h3 {
        margin: 0;
        color: #304d55;
        font-size: 18px;
        font-weight: 800;
    }

    .education-empty-state p {
        max-width: 500px;
        margin: 8px auto 20px;
        color: #8a979b;
        font-size: 12px;
        line-height: 1.8;
    }


    /* =========================================================
       PAGINATION
    ========================================================== */

    .education-pagination-wrapper {
        padding: 18px 22px;
        border-top: 1px solid #edf0f0;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }

    .education-pagination-info {
        color: #89969a;
        font-size: 11px;
        white-space: nowrap;
    }

    .education-pagination-info strong {
        color: #52656b;
        font-weight: 800;
    }

    .education-pagination {
        display: flex;
        align-items: center;
    }

    .education-pagination nav {
        display: flex;
        align-items: center;
    }

    .education-pagination svg {
        width: 16px;
        height: 16px;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================== */

    @media (max-width: 1400px) {

        .education-students-stats {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }

        .education-students-filters {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }

        .education-filter-field-search {
            grid-column: span 3;
        }

    }


    @media (max-width: 900px) {

        .education-page-header {
            align-items: stretch;
            flex-direction: column;
        }

        .education-page-header-actions .education-primary-btn {
            width: 100%;
        }

        .education-students-stats {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .education-students-filters {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .education-filter-field-search {
            grid-column: span 2;
        }

        .education-filter-submit {
            grid-column: span 2;
        }

        .education-pagination-wrapper {
            align-items: flex-start;
            flex-direction: column;
        }

    }


    @media (max-width: 600px) {

        .education-page-title {
            font-size: 26px;
        }

        .education-students-stats {
            grid-template-columns: 1fr;
        }

        .education-students-filters {
            grid-template-columns: 1fr;
        }

        .education-filter-field-search,
        .education-filter-submit {
            grid-column: span 1;
        }

        .education-filter-header,
        .education-table-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .education-filter-card {
            padding: 17px;
        }

        .education-table-header {
            padding: 18px;
        }

    }

</style>

@endsection
