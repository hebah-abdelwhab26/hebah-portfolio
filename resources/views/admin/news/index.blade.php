@extends('admin.layouts.app')

@section('title', __('digital_studio_admin.news.index.title'))

@section('content')

<div class="fade-up">

    {{-- ==========================================
        PAGE HEADER
    ========================================== --}}
    <div class="page-header">

        <div class="page-header-content">

            <div class="page-header-left">

                <div class="page-icon">
                    <i class="fa-solid fa-newspaper"></i>
                </div>

                <div>
                    <h1>
                        {{ __('digital_studio_admin.news.index.page_header.title') }}
                    </h1>

                    <p>
                        {{ __('digital_studio_admin.news.index.page_header.description') }}
                    </p>
                </div>

            </div>

            <div class="page-header-right">

                <a href="{{ route('admin.news.create') }}"
                   class="btn-admin-primary">

                    <i class="fa-solid fa-plus"></i>

                    <span>
                        {{ __('digital_studio_admin.news.index.page_header.new_news') }}
                    </span>

                </a>

            </div>

        </div>

    </div>


    {{-- ==========================================
        SUCCESS MESSAGE
    ========================================== --}}
    @if(session('success'))

        <div class="admin-alert admin-alert-success">

            <i class="fa-solid fa-circle-check"></i>

            <span>
                {{ session('success') }}
            </span>

        </div>

    @endif


    {{-- ==========================================
        FILTER BAR
    ========================================== --}}
    <div class="filter-bar">

        <form method="GET"
              action="{{ route('admin.news.index') }}"
              class="filter-form">

            {{-- Search --}}
            <div class="filter-field">

                <div class="filter-input-wrapper">

                    <i class="fa-solid fa-magnifying-glass"></i>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="{{ __('digital_studio_admin.news.index.filters.search_placeholder') }}"
                    >

                </div>

            </div>


            {{-- Type --}}
            <div class="filter-field">

                <select name="type">

                    <option value="">
                        {{ __('digital_studio_admin.news.index.filters.all_types') }}
                    </option>

                    <option value="announcement"
                        @selected(request('type') === 'announcement')>
                        {{ __('digital_studio_admin.news.index.types.announcement') }}
                    </option>

                    <option value="project"
                        @selected(request('type') === 'project')>
                        {{ __('digital_studio_admin.news.index.types.project') }}
                    </option>

                    <option value="update"
                        @selected(request('type') === 'update')>
                        {{ __('digital_studio_admin.news.index.types.update') }}
                    </option>

                    <option value="notice"
                        @selected(request('type') === 'notice')>
                        {{ __('digital_studio_admin.news.index.types.notice') }}
                    </option>

                    <option value="general"
                        @selected(request('type') === 'general')>
                        {{ __('digital_studio_admin.news.index.types.general') }}
                    </option>

                </select>

            </div>


            {{-- Status --}}
            <div class="filter-field">

                <select name="active">

                    <option value="">
                        {{ __('digital_studio_admin.news.index.filters.all_status') }}
                    </option>

                    <option value="1"
                        @selected(request('active') === '1')>
                        {{ __('digital_studio_admin.news.index.status.active') }}
                    </option>

                    <option value="0"
                        @selected(request('active') === '0')>
                        {{ __('digital_studio_admin.news.index.status.inactive') }}
                    </option>

                </select>

            </div>


            {{-- Filter --}}
            <button type="submit"
                    class="btn-admin-primary">

                <i class="fa-solid fa-filter"></i>

                {{ __('digital_studio_admin.news.index.filters.filter') }}

            </button>


            {{-- Reset --}}
            @if(request()->hasAny(['search', 'type', 'active']))

                <a href="{{ route('admin.news.index') }}"
                   class="btn-admin">

                    <i class="fa-solid fa-rotate-left"></i>

                    {{ __('digital_studio_admin.news.index.filters.reset') }}

                </a>

            @endif

        </form>

    </div>


    {{-- ==========================================
        NEWS TABLE
    ========================================== --}}
    <div class="projects-table-wrapper">

        @if($news->count())

            <div class="projects-table-scroll">

                <table class="projects-table">

                    <thead>

                        <tr>

                            <th>
                                {{ __('digital_studio_admin.news.index.table.title') }}
                            </th>

                            <th>
                                {{ __('digital_studio_admin.news.index.table.type') }}
                            </th>

                            <th>
                                {{ __('digital_studio_admin.news.index.table.status') }}
                            </th>

                            <th>
                                {{ __('digital_studio_admin.news.index.table.sort_order') }}
                            </th>

                            <th>
                                {{ __('digital_studio_admin.news.index.table.starts_at') }}
                            </th>

                            <th>
                                {{ __('digital_studio_admin.news.index.table.ends_at') }}
                            </th>

                            <th>
                                {{ __('digital_studio_admin.news.index.table.actions') }}
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($news as $item)

                            <tr>

                                {{-- Title --}}
                                <td>

                                    <div class="news-title-cell">

                                        @if($item->icon)

                                            <div class="news-icon">

                                                <i class="{{ $item->icon }}"></i>

                                            </div>

                                        @else

                                            <div class="news-icon">

                                                <i class="fa-solid fa-newspaper"></i>

                                            </div>

                                        @endif

                                        <div>

                                            <strong>
                                                {{ $item->title }}
                                            </strong>

                                            @if($item->content)

                                                <small>
                                                    {{ \Illuminate\Support\Str::limit($item->content, 70) }}
                                                </small>

                                            @endif

                                        </div>

                                    </div>

                                </td>


                                {{-- Type --}}
                                <td>

                                    @php

                                        $typeClass = match($item->type) {
                                            'announcement' => 'badge-announcement',
                                            'project' => 'badge-project',
                                            'update' => 'badge-update',
                                            'notice' => 'badge-notice',
                                            default => 'badge-general',
                                        };

                                    @endphp

                                    <span class="table-badge {{ $typeClass }}">

                                        {{ __('digital_studio_admin.news.index.types.' . $item->type) }}

                                    </span>

                                </td>


                                {{-- Status --}}
                                <td>

                                    @if($item->is_active)

                                        <span class="table-badge badge-active">

                                            <i class="fa-solid fa-circle-check"></i>

                                            {{ __('digital_studio_admin.news.index.status.active') }}

                                        </span>

                                    @else

                                        <span class="table-badge badge-inactive">

                                            <i class="fa-solid fa-circle-xmark"></i>

                                            {{ __('digital_studio_admin.news.index.status.inactive') }}

                                        </span>

                                    @endif

                                </td>


                                {{-- Sort --}}
                                <td>

                                    <span class="sort-number">
                                        {{ $item->sort_order }}
                                    </span>

                                </td>


                                {{-- Starts --}}
                                <td>

                                    @if($item->starts_at)

                                        <span class="date-cell">
                                            {{ $item->starts_at->format('Y-m-d H:i') }}
                                        </span>

                                    @else

                                        <span class="muted-cell">
                                            —
                                        </span>

                                    @endif

                                </td>


                                {{-- Ends --}}
                                <td>

                                    @if($item->ends_at)

                                        <span class="date-cell">
                                            {{ $item->ends_at->format('Y-m-d H:i') }}
                                        </span>

                                    @else

                                        <span class="muted-cell">
                                            —
                                        </span>

                                    @endif

                                </td>


                                {{-- Actions --}}
                                <td>

                                    <div class="table-actions">

                                        <a
                                            href="{{ route('admin.news.edit', $item) }}"
                                            class="action-btn action-edit"
                                            title="{{ __('digital_studio_admin.news.index.actions.edit') }}"
                                        >

                                            <i class="fa-solid fa-pen"></i>

                                        </a>


                                        <form
                                            action="{{ route('admin.news.destroy', $item) }}"
                                            method="POST"
                                            class="delete-news-form"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="action-btn action-delete"
                                                title="{{ __('digital_studio_admin.news.index.actions.delete') }}"
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


            {{-- Pagination --}}
            @if($news->hasPages())

                <div class="admin-pagination">

                    {{ $news->links() }}

                </div>

            @endif

        @else

            <div class="table-empty">

                <div class="empty-icon">

                    <i class="fa-solid fa-newspaper"></i>

                </div>

                <h3>
                    {{ __('digital_studio_admin.news.index.empty.title') }}
                </h3>

                <p>
                    {{ __('digital_studio_admin.news.index.empty.description') }}
                </p>

                <a
                    href="{{ route('admin.news.create') }}"
                    class="btn-admin-primary"
                >

                    <i class="fa-solid fa-plus"></i>

                    {{ __('digital_studio_admin.news.index.empty.create') }}

                </a>

            </div>

        @endif

    </div>

</div>


{{-- ==========================================
    DELETE CONFIRMATION
========================================== --}}
<script>

document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.delete-news-form').forEach(function (form) {

        form.addEventListener('submit', function (event) {

            const confirmed = confirm(
                @json(__('digital_studio_admin.news.index.delete_confirm.text'))
            );

            if (!confirmed) {
                event.preventDefault();
            }

        });

    });

});

</script>


{{-- ==========================================
    PAGE STYLES
========================================== --}}
<style>

.news-title-cell {
    display: flex;
    align-items: center;
    gap: 12px;
    min-width: 260px;
}

.news-title-cell > div:last-child {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.news-title-cell strong {
    font-size: 14px;
    font-weight: 700;
}

.news-title-cell small {
    font-size: 12px;
    opacity: .65;
    line-height: 1.5;
}

.news-icon {
    width: 42px;
    height: 42px;
    min-width: 42px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(37, 99, 235, .10);
    color: #2563eb;
    font-size: 17px;
}

.table-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 10px;
    border-radius: 8px;
    font-size: 11px;
    font-weight: 700;
    white-space: nowrap;
}

.badge-announcement {
    background: rgba(212, 160, 23, .12);
    color: #a47700;
}

.badge-project {
    background: rgba(37, 99, 235, .12);
    color: #2563eb;
}

.badge-update {
    background: rgba(16, 185, 129, .12);
    color: #059669;
}

.badge-notice {
    background: rgba(239, 68, 68, .10);
    color: #dc2626;
}

.badge-general {
    background: rgba(100, 116, 139, .12);
    color: #64748b;
}

.badge-active {
    background: rgba(16, 185, 129, .12);
    color: #059669;
}

.badge-inactive {
    background: rgba(100, 116, 139, .12);
    color: #64748b;
}

.sort-number {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 30px;
    height: 30px;
    padding: 0 8px;
    border-radius: 8px;
    background: rgba(15, 23, 42, .05);
    font-size: 12px;
    font-weight: 700;
}

.date-cell {
    font-size: 12px;
    white-space: nowrap;
}

.muted-cell {
    opacity: .45;
}

.projects-table-scroll {
    overflow-x: auto;
}

.admin-alert {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 13px 16px;
    border-radius: 12px;
    margin-bottom: 20px;
}

.admin-alert-success {
    background: rgba(16, 185, 129, .10);
    color: #059669;
}

.filter-form {
    width: 100%;
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
}

.filter-field {
    flex: 1;
    min-width: 180px;
}

.filter-input-wrapper {
    position: relative;
}

.filter-input-wrapper i {
    position: absolute;
    top: 50%;
    inset-inline-start: 14px;
    transform: translateY(-50%);
    opacity: .5;
}

.filter-input-wrapper input {
    width: 100%;
    padding-inline-start: 40px;
}

.filter-form select,
.filter-form input {
    height: 44px;
    border: 1px solid rgba(15, 23, 42, .10);
    border-radius: 10px;
    background: #fff;
    padding: 0 13px;
    outline: none;
}

.filter-form select:focus,
.filter-form input:focus {
    border-color: #2563eb;
}

@media (max-width: 768px) {

    .filter-field {
        width: 100%;
        min-width: 100%;
        flex: auto;
    }

    .filter-form .btn-admin-primary,
    .filter-form .btn-admin {
        width: 100%;
        justify-content: center;
    }

    .news-title-cell {
        min-width: 220px;
    }

}

</style>

@endsection
