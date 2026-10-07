@extends('admin.layouts.app')

@section('title', __('digital_studio_admin.project_categories.index.title'))

@section('content')

<div class="container-fluid">

    <!--==================================
                PAGE HEADER
    ==================================-->

    <div class="page-header">

        <div class="page-header-content">

            <div class="page-header-left">

                <div class="page-icon">

                    <i class="fa-solid fa-layer-group"></i>

                </div>

                <div>

                    <h1>

                        {{ __('digital_studio_admin.project_categories.index.page_header.title') }}

                    </h1>

                    <p>

                        {{ __('digital_studio_admin.project_categories.index.page_header.description') }}

                    </p>

                </div>

            </div>

            <div class="page-header-right">

                <a
                    href="{{ route('admin.project-categories.create') }}"
                    class="btn-admin-primary">

                    <i class="fa-solid fa-plus"></i>

                    {{ __('digital_studio_admin.project_categories.index.page_header.new_category') }}

                </a>

            </div>

        </div>

    </div>

    <!--==================================
                FILTER BAR
    ==================================-->

    <form
        action="{{ route('admin.project-categories.index') }}"
        method="GET">

        <div class="filter-bar">

            <!-- Search -->

            <div class="filter-search">

                <i class="fa-solid fa-magnifying-glass"></i>

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="{{ __('digital_studio_admin.project_categories.index.filters.search_placeholder') }}">

            </div>

            <!-- Status -->

            <div class="filter-select">

                <select name="active">

                    <option value="">

                        {{ __('digital_studio_admin.project_categories.index.filters.all_status') }}

                    </option>

                    <option
                        value="1"
                        @selected(request('active')=='1')>

                        {{ __('digital_studio_admin.project_categories.index.statuses.active') }}

                    </option>

                    <option
                        value="0"
                        @selected(request('active')=='0')>

                        {{ __('digital_studio_admin.project_categories.index.statuses.disabled') }}

                    </option>

                </select>

            </div>

            <button
                type="submit"
                class="btn-admin">

                <i class="fa-solid fa-filter"></i>

                {{ __('digital_studio_admin.project_categories.index.filters.filter') }}

            </button>

        </div>

    </form>

    <!--==================================
                TABLE WRAPPER
    ==================================-->

    <div class="projects-table-wrapper">

        <table class="projects-table">

            <thead>

                <tr style="background:#2563EB;color:#fff;">

                    <th style="border-radius:10px 0 0 10px;">

                        {{ __('digital_studio_admin.project_categories.index.table.category') }}

                    </th>

                    <th>

                        {{ __('digital_studio_admin.project_categories.index.table.color') }}

                    </th>

                    <th>

                        {{ __('digital_studio_admin.project_categories.index.table.projects') }}

                    </th>

                    <th>

                        {{ __('digital_studio_admin.project_categories.index.table.status') }}

                    </th>

                    <th
                        class="text-end text-center"
                        style="border-radius: 0 10px 10px 0;">

                        {{ __('digital_studio_admin.project_categories.index.table.actions') }}

                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($categories as $category)

                <tr>

                    <!--==================================
                            CATEGORY INFO
                    ==================================-->

                    <td class="px-2">

                        <div class="project-info">

                            <div
                                style="
                                    width:70px;
                                    height:70px;
                                    border-radius:18px;
                                    background:{{ $category->color ?? '#2563EB' }};
                                    display:flex;
                                    align-items:center;
                                    justify-content:center;
                                    flex-shrink:0;
                                    border:2px solid rgba(255,255,255,.08);
                                ">

                                <i
                                    class="{{ $category->icon }}"
                                    style="
                                        color:#fff;
                                        font-size:28px;
                                    ">

                                </i>

                            </div>

                            <div>

                                <h6>

                                    {{ $category->name }}

                                </h6>

                                <small>

                                    {{ $category->slug }}

                                </small>

                            </div>

                        </div>

                    </td>

                    <!--==================================
                            COLOR
                    ==================================-->

                    <td class="px-2">

                        <div
                            class="d-flex align-items-center gap-3">

                            <span
                                style="
                                    width:18px;
                                    height:18px;
                                    border-radius:50%;
                                    background:{{ $category->color }};
                                    display:inline-block;
                                    border:2px solid rgba(255,255,255,.12);
                                ">
                            </span>

                            <span style="color:#CBD5E1;">

                                {{ $category->color }}

                            </span>

                        </div>

                    </td>

                    <!--==================================
                            PROJECT COUNT
                    ==================================-->

                    <td class="px-2">

                        <span class="table-badge tech">

                            <i class="fa-solid fa-folder-open"></i>

                            {{ $category->projects_count }}

                            {{ __('digital_studio_admin.project_categories.index.table.project_count') }}

                        </span>

                    </td>

                    <!--==================================
                            STATUS
                    ==================================-->

                    <td class="px-2">

                        @if($category->is_active)

                            <span class="table-badge success">

                                <i class="fa-solid fa-circle"></i>

                                {{ __('digital_studio_admin.project_categories.index.statuses.active') }}

                            </span>

                        @else

                            <span class="table-badge warning">

                                <i class="fa-solid fa-circle"></i>

                                {{ __('digital_studio_admin.project_categories.index.statuses.disabled') }}

                            </span>

                        @endif

                    </td>

                    <!--==================================
                            ACTIONS
                    ==================================-->

                    <td class="px-2">

                        <div class="table-actions">

                            <a
                                href="{{ route('admin.project-categories.show',$category) }}"
                                class="action-btn view"
                                title="{{ __('digital_studio_admin.project_categories.index.actions.view') }}">

                                <i class="fa-solid fa-eye"></i>

                            </a>

                            <a
                                href="{{ route('admin.project-categories.edit',$category) }}"
                                class="action-btn edit"
                                title="{{ __('digital_studio_admin.project_categories.index.actions.edit') }}">

                                <i class="fa-solid fa-pen"></i>

                            </a>

                            <form
                                action="{{ route('admin.project-categories.destroy',$category) }}"
                                method="POST"
                                class="delete-form">

                                @csrf

                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="action-btn delete"
                                    title="{{ __('digital_studio_admin.project_categories.index.actions.delete') }}">

                                    <i class="fa-solid fa-trash"></i>

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="5">

                        <div class="table-empty">

                            <i class="fa-solid fa-folder-tree"></i>

                            <h4>

                                {{ __('digital_studio_admin.project_categories.index.empty.title') }}

                            </h4>

                            <p>

                                {{ __('digital_studio_admin.project_categories.index.empty.description') }}

                            </p>

                            <a
                                href="{{ route('admin.project-categories.create') }}"
                                class="btn-admin-primary">

                                <i class="fa-solid fa-plus"></i>

                                {{ __('digital_studio_admin.project_categories.index.empty.create_category') }}

                            </a>

                        </div>

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

<!--==================================
        PAGINATION
==================================-->

@if($categories->hasPages())

<div class="p-4 border-top">

    <div class="d-flex justify-content-center">

        {{ $categories->links() }}

    </div>

</div>

@endif

</div>

</div>

@endsection

@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.delete-form').forEach(function (form) {

        form.addEventListener('submit', function (e) {

            e.preventDefault();

            Swal.fire({

                title: '{{ __('digital_studio_admin.project_categories.index.delete_confirm.title') }}',

                text: '{{ __('digital_studio_admin.project_categories.index.delete_confirm.text') }}',

                icon: 'warning',

                background: '#0F172A',

                color: '#F8FAFC',

                confirmButtonColor: '#EF4444',

                cancelButtonColor: '#334155',

                confirmButtonText: '{{ __('digital_studio_admin.project_categories.index.delete_confirm.confirm') }}',

                cancelButtonText: '{{ __('digital_studio_admin.project_categories.index.delete_confirm.cancel') }}',

                reverseButtons: true

            }).then((result) => {

                if (result.isConfirmed) {

                    form.submit();

                }

            });

        });

    });

});

</script>

@endpush
