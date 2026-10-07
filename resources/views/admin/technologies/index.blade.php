@extends('admin.layouts.app')

@section('title', __('digital_studio_admin.technologies.index.title'))

@section('content')

<div class="container-fluid">

    <!--==================================
                PAGE HEADER
    ==================================-->

    <div class="page-header">

        <div class="page-header-content">

            <div class="page-header-left">

                <div class="page-icon">

                    <i class="fa-solid fa-microchip"></i>

                </div>

                <div>

                    <h1>

                        {{ __('digital_studio_admin.technologies.index.page_header.title') }}

                    </h1>

                    <p>

                        {{ __('digital_studio_admin.technologies.index.page_header.description') }}

                    </p>

                </div>

            </div>

            <div class="page-header-right">

                <a
                    href="{{ route('admin.technologies.create') }}"
                    class="btn-admin-primary">

                    <i class="fa-solid fa-plus"></i>

                    <span>

                        {{ __('digital_studio_admin.technologies.index.page_header.new_technology') }}

                    </span>

                </a>

            </div>

        </div>

    </div>

    <!--==================================
                FILTER BAR
    ==================================-->

    <form
        action="{{ route('admin.technologies.index') }}"
        method="GET"
        class="filter-bar">

        <div class="filter-search">

            <i class="fa-solid fa-magnifying-glass"></i>

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="{{ __('digital_studio_admin.technologies.index.filters.search_placeholder') }}">

        </div>

        <div class="filter-select">

            <select name="category">

                <option value="">

                    {{ __('digital_studio_admin.technologies.index.filters.all_categories') }}

                </option>

                @foreach($categories as $category)

                    <option
                        value="{{ $category->id }}"
                        @selected(request('category') == $category->id)>

                        {{ $category->name }}

                    </option>

                @endforeach

            </select>

        </div>

        <div class="filter-select">

            <select name="active">

                <option value="">

                    {{ __('digital_studio_admin.technologies.index.filters.all_status') }}

                </option>

                <option
                    value="1"
                    @selected(request('active') == '1')>

                    {{ __('digital_studio_admin.technologies.index.statuses.active') }}

                </option>

                <option
                    value="0"
                    @selected(request('active') == '0')>

                    {{ __('digital_studio_admin.technologies.index.statuses.disabled') }}

                </option>

            </select>

        </div>

        <button
            class="btn-admin">

            <i class="fa-solid fa-magnifying-glass"></i>

            {{ __('digital_studio_admin.technologies.index.filters.search') }}

        </button>

    </form>

    <!--==================================
                TABLE
    ==================================-->

    <div class="projects-table-wrapper">

        <table class="projects-table text-center">

            <thead>

                <tr style="background:#2563EB;color:#fff;">

                    <th style="border-radius:10px 0 0 10px;">

                        {{ __('digital_studio_admin.technologies.index.table.icon') }}

                    </th>

                    <th>

                        {{ __('digital_studio_admin.technologies.index.table.technology') }}

                    </th>

                    <th>

                        {{ __('digital_studio_admin.technologies.index.table.category') }}

                    </th>

                    <th>

                        {{ __('digital_studio_admin.technologies.index.table.website') }}

                    </th>

                    <th>

                        {{ __('digital_studio_admin.technologies.index.table.projects') }}

                    </th>

                    <th>

                        {{ __('digital_studio_admin.technologies.index.table.status') }}

                    </th>

                    <th
                        class="text-end text-center"
                        style="border-radius: 0 10px 10px 0;">

                        {{ __('digital_studio_admin.technologies.index.table.actions') }}

                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($technologies as $technology)

                <tr>

                    <!--==================================
                                ICON
                    ==================================-->

                    <td>

                        <div
                            class="d-flex justify-content-center align-items-center rounded-circle"
                            style="
                                width:60px;
                                height:60px;
                                background:{{ $technology->color ?? '#2563EB' }};
                                color:#fff;
                                font-size:22px;
                                margin:auto;
                            ">

                            <i class="{{ $technology->icon }}"></i>

                        </div>

                    </td>

                    <!--==================================
                                TECHNOLOGY
                    ==================================-->

                    <td class="text-centar">

                        <div class="project-info">

                            <div>

                                <h6>

                                    {{ $technology->name }}

                                </h6>

                                <small>

                                    {{ $technology->slug }}

                                </small>

                            </div>

                        </div>

                    </td>

                    <!--==================================
                                CATEGORY
                    ==================================-->

                    <td>

                        <span class="table-badge category">

                            {{ $technology->category?->name
                                ?? __('digital_studio_admin.technologies.index.table.no_category') }}

                        </span>

                    </td>

                    <!--==================================
                                WEBSITE
                    ==================================-->

                    <td>

                        @if($technology->website)

                            <a
                                href="{{ $technology->website }}"
                                target="_blank"
                                class="text-decoration-none text-info fw-semibold">

                                <i class="fa-solid fa-arrow-up-right-from-square me-2"></i>

                                {{ __('digital_studio_admin.technologies.index.actions.visit') }}

                            </a>

                        @else

                            <span class="text-muted">

                                —

                            </span>

                        @endif

                    </td>

                    <!--==================================
                                PROJECTS
                    ==================================-->

                    <td>

                        <span class="table-badge tech">

                            {{ $technology->projects()->count() }}

                            {{ __('digital_studio_admin.technologies.index.table.project_count') }}

                        </span>

                    </td>

                    <!--==================================
                                STATUS
                    ==================================-->

                    <td>

                        @if($technology->is_active)

                            <span class="table-badge success">

                                <i class="fa-solid fa-circle"></i>

                                {{ __('digital_studio_admin.technologies.index.statuses.active') }}

                            </span>

                        @else

                            <span class="table-badge warning">

                                <i class="fa-solid fa-circle"></i>

                                {{ __('digital_studio_admin.technologies.index.statuses.disabled') }}

                            </span>

                        @endif

                    </td>

                    <!--==================================
                                ACTIONS
                    ==================================-->

                    <td>

                        <div class="table-actions">

                            <a
                                href="{{ route('admin.technologies.show',$technology) }}"
                                class="action-btn view"
                                title="{{ __('digital_studio_admin.technologies.index.actions.view') }}">

                                <i class="fa-solid fa-eye"></i>

                            </a>

                            <a
                                href="{{ route('admin.technologies.edit',$technology) }}"
                                class="action-btn edit"
                                title="{{ __('digital_studio_admin.technologies.index.actions.edit') }}">

                                <i class="fa-solid fa-pen"></i>

                            </a>

                            <form
                                action="{{ route('admin.technologies.destroy',$technology) }}"
                                method="POST"
                                class="delete-form">

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="action-btn delete"
                                    title="{{ __('digital_studio_admin.technologies.index.actions.delete') }}">

                                    <i class="fa-solid fa-trash"></i>

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="7">

                        <div class="table-empty">

                            <i class="fa-solid fa-microchip"></i>

                            <h4>

                                {{ __('digital_studio_admin.technologies.index.empty.title') }}

                            </h4>

                            <p>

                                {{ __('digital_studio_admin.technologies.index.empty.description') }}

                            </p>

                        </div>

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <!--==================================
                PAGINATION
    ==================================-->

</div>

@endsection

@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', () => {

    document.querySelectorAll('.delete-form').forEach(form => {

        form.addEventListener('submit', function(e){

            e.preventDefault();

            Swal.fire({

                title: @json(__('digital_studio_admin.technologies.index.delete_confirm.title')),

                text: @json(__('digital_studio_admin.technologies.index.delete_confirm.text')),

                icon: 'warning',

                showCancelButton: true,

                confirmButtonColor: '#ef4444',

                cancelButtonColor: '#64748b',

                confirmButtonText: @json(__('digital_studio_admin.technologies.index.delete_confirm.confirm')),

                cancelButtonText: @json(__('digital_studio_admin.technologies.index.delete_confirm.cancel'))

            }).then((result)=>{

                if(result.isConfirmed){

                    this.submit();

                }

            });

        });

    });

});

</script>

@endpush
