@extends('admin.layouts.app')

@section('title', __('digital_studio_admin.technology_categories.index.title'))

@section('content')

<div class="page-header">

    <div class="page-header-content">

        <div class="page-header-left">

            <div class="page-icon">

                <i class="fa-solid fa-microchip"></i>

            </div>

            <div>

                <h1>

                    {{ __('digital_studio_admin.technology_categories.index.page_header.title') }}

                </h1>

                <p>

                    {{ __('digital_studio_admin.technology_categories.index.page_header.description') }}

                </p>

            </div>

        </div>

        <div class="page-header-right">

            <a
                href="{{ route('admin.technology-categories.create') }}"
                class="btn-admin-primary">

                <i class="fa-solid fa-plus"></i>

                {{ __('digital_studio_admin.technology_categories.index.page_header.new_category') }}

            </a>

        </div>

    </div>

</div>

<!--==================================
            FILTER BAR
===================================-->

<form
    method="GET"
    action="{{ route('admin.technology-categories.index') }}"
    class="filter-bar">

    <div class="filter-search">

        <i class="fa-solid fa-magnifying-glass"></i>

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="{{ __('digital_studio_admin.technology_categories.index.filters.search_placeholder') }}">

    </div>

    <div class="filter-select">

        <select name="active">

            <option value="">

                {{ __('digital_studio_admin.technology_categories.index.filters.all_status') }}

            </option>

            <option
                value="1"
                @selected(request('active') == '1')>

                {{ __('digital_studio_admin.technology_categories.index.statuses.active') }}

            </option>

            <option
                value="0"
                @selected(request('active') == '0')>

                {{ __('digital_studio_admin.technology_categories.index.statuses.disabled') }}

            </option>

        </select>

    </div>

    <button
        class="btn-admin">

        <i class="fa-solid fa-filter"></i>

        {{ __('digital_studio_admin.technology_categories.index.filters.filter') }}

    </button>

</form>

<!--==================================
            TABLE
===================================-->

<div class="projects-table-wrapper">

    <table class="projects-table">

        <thead>

            <tr style="background:#2563EB;color:#fff;">

                <th style="border-radius:10px 0 0 10px;">

                    {{ __('digital_studio_admin.technology_categories.index.table.category') }}

                </th>

                <th>

                    {{ __('digital_studio_admin.technology_categories.index.table.color') }}

                </th>

                <th>

                    {{ __('digital_studio_admin.technology_categories.index.table.technologies') }}

                </th>

                <th>

                    {{ __('digital_studio_admin.technology_categories.index.table.status') }}

                </th>

                <th
                    class="text-end text-center"
                    style="border-radius: 0 10px 10px 0;">

                    {{ __('digital_studio_admin.technology_categories.index.table.actions') }}

                </th>

            </tr>

        </thead>

        <tbody>

            @forelse($categories as $category)

            <tr>

                <!--==================================
                            CATEGORY
                ==================================-->

                <td class="px-2">

                    <div class="project-info">

                        <div
                            class="rounded-circle d-flex justify-content-center align-items-center"
                            style="
                                width:72px;
                                height:72px;
                                background:{{ $category->color ?? '#2563EB' }};
                                color:#fff;
                                flex-shrink:0;
                                font-size:24px;
                            ">

                            <i class="{{ $category->icon ?: 'fa-solid fa-microchip' }}"></i>

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

                    <div class="d-flex align-items-center gap-3">

                        <span
                            style="
                                width:18px;
                                height:18px;
                                border-radius:50%;
                                background:{{ $category->color }};
                                border:2px solid rgba(255,255,255,.12);
                                display:inline-block;
                            ">

                        </span>

                        <span style="color:#CBD5E1;">

                            {{ $category->color }}

                        </span>

                    </div>

                </td>

                <!--==================================
                            TECHNOLOGIES
                ==================================-->

                <td class="px-2">

                    <span class="table-badge tech">

                        <i class="fa-solid fa-microchip"></i>

                        {{ $category->technologies_count }}

                        {{ __('digital_studio_admin.technology_categories.index.table.technology_count') }}

                    </span>

                </td>

                <!--==================================
                            STATUS
                ==================================-->

                <td class="px-2">

                    @if($category->is_active)

                        <span class="table-badge success">

                            <i class="fa-solid fa-circle"></i>

                            {{ __('digital_studio_admin.technology_categories.index.statuses.active') }}

                        </span>

                    @else

                        <span class="table-badge warning">

                            <i class="fa-solid fa-circle"></i>

                            {{ __('digital_studio_admin.technology_categories.index.statuses.disabled') }}

                        </span>

                    @endif

                </td>

                <!--==================================
                            ACTIONS
                ==================================-->

                <td class="px-2">

                    <div class="table-actions">

                        <a
                            href="{{ route('admin.technology-categories.edit',$category) }}"
                            class="action-btn edit"
                            title="{{ __('digital_studio_admin.technology_categories.index.actions.edit') }}">

                            <i class="fa-solid fa-pen"></i>

                        </a>

                        <form
                            action="{{ route('admin.technology-categories.destroy',$category) }}"
                            method="POST"
                            class="delete-form">

                            @csrf

                            @method('DELETE')

                            <button
                                type="submit"
                                class="action-btn delete"
                                title="{{ __('digital_studio_admin.technology_categories.index.actions.delete') }}">

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

                        <i class="fa-solid fa-microchip"></i>

                        <h4>

                            {{ __('digital_studio_admin.technology_categories.index.empty.title') }}

                        </h4>

                        <p>

                            {{ __('digital_studio_admin.technology_categories.index.empty.description') }}

                        </p>

                    </div>

                </td>

            </tr>

            @endforelse

        </tbody>

    </table>

</div>

@if(method_exists($categories,'links'))

<div class="mt-4">

    {{ $categories->links() }}

</div>

@endif

@endsection

@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.delete-form').forEach(function (form) {

        form.addEventListener('submit', function (e) {

            e.preventDefault();

            Swal.fire({

                title: @json(__('digital_studio_admin.technology_categories.index.delete_confirm.title')),

                text: @json(__('digital_studio_admin.technology_categories.index.delete_confirm.text')),

                icon: 'warning',

                background: '#111827',

                color: '#F9FAFB',

                showCancelButton: true,

                confirmButtonColor: '#EF4444',

                cancelButtonColor: '#374151',

                confirmButtonText: @json(__('digital_studio_admin.technology_categories.index.delete_confirm.confirm')),

                cancelButtonText: @json(__('digital_studio_admin.technology_categories.index.delete_confirm.cancel'))

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
