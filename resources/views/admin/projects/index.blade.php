@extends('admin.layouts.app')

@section('title', __('digital_studio_admin.projects.index.title'))

@section('content')

<div class="projects-page">

    <!--==================================================
                    PAGE HEADER
    ==================================================-->

    <div class="page-header">

        <div class="page-header-content">

            <div class="page-header-left">

                <div class="page-icon">

                    <i class="fa-solid fa-folder-open"></i>

                </div>

                <div>

                    <h1>
                        {{ __('digital_studio_admin.projects.index.page_header.title') }}
                    </h1>

                    <p>
                        {{ __('digital_studio_admin.projects.index.page_header.description') }}
                    </p>

                </div>

            </div>

            <div class="page-header-right">

                <a href="{{ route('admin.projects.create') }}"
                   class="btn-admin-primary">

                    <i class="fa-solid fa-folder-plus"></i>

                    {{ __('digital_studio_admin.projects.index.page_header.create_project') }}

                </a>

            </div>

        </div>

    </div>

    <!--==================================================
                    FILTER BAR
    ==================================================-->

    <form method="GET"
          action="{{ route('admin.projects.index') }}"
          class="filter-bar">

        <div class="filter-search">

            <i class="fa-solid fa-magnifying-glass"></i>

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="{{ __('digital_studio_admin.projects.index.filters.search_placeholder') }}">

        </div>

        <div class="filter-select">

            <select name="category">

                <option value="">
                    {{ __('digital_studio_admin.projects.index.filters.all_categories') }}
                </option>

                @foreach($categories as $category)

                    <option value="{{ $category->id }}"
                        @selected(request('category') == $category->id)>

                        {{ $category->name }}

                    </option>

                @endforeach

            </select>

        </div>

        <div class="filter-select">

            <select name="status">

                <option value="">
                    {{ __('digital_studio_admin.projects.index.filters.all_status') }}
                </option>

                <option value="published"
                    @selected(request('status') == 'published')>

                    {{ __('digital_studio_admin.projects.index.statuses.published') }}

                </option>

                <option value="draft"
                    @selected(request('status') == 'draft')>

                    {{ __('digital_studio_admin.projects.index.statuses.draft') }}

                </option>

            </select>

        </div>

        <div class="filter-select">

            <select name="featured">

                <option value="">
                    {{ __('digital_studio_admin.projects.index.filters.featured') }}
                </option>

                <option value="1"
                    @selected(request('featured') == '1')>

                    {{ __('digital_studio_admin.projects.index.filters.yes') }}

                </option>

                <option value="0"
                    @selected(request('featured') == '0')>

                    {{ __('digital_studio_admin.projects.index.filters.no') }}

                </option>

            </select>

        </div>

        <button type="submit"
                class="btn-admin">

            <i class="fa-solid fa-filter"></i>

            {{ __('digital_studio_admin.projects.index.filters.filter') }}

        </button>

        <a href="{{ route('admin.projects.index') }}"
           class="btn-admin btn-outline">

            <i class="fa-solid fa-rotate-left"></i>

            {{ __('digital_studio_admin.projects.index.filters.reset') }}

        </a>

    </form>

    <!--==================================================
                    TABLE
    ==================================================-->

    <div class="projects-table-wrapper">

        <table class="projects-table">

            <thead>

                <tr style="background:#2563EB;color:#fff;">

                    <th style="border-radius:10px 0 0 10px;">

                        {{ __('digital_studio_admin.projects.index.table.project') }}

                    </th>

                    <th>

                        {{ __('digital_studio_admin.projects.index.table.category') }}

                    </th>

                    <th>

                        {{ __('digital_studio_admin.projects.index.table.technologies') }}

                    </th>

                    <th>

                        {{ __('digital_studio_admin.projects.index.table.status') }}

                    </th>

                    <th>

                        {{ __('digital_studio_admin.projects.index.table.featured') }}

                    </th>

                    <th>

                        {{ __('digital_studio_admin.projects.index.table.date') }}

                    </th>

                    <th class="text-center"
                        style="border-radius:0 10px 10px 0;">

                        {{ __('digital_studio_admin.projects.index.table.actions') }}

                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($projects as $project)

                    <tr>

                        <td>

                            <div class="project-info">

                                <img
                                    src="{{ $project->thumbnail_url }}"
                                    alt="{{ $project->title }}">

                                <div>

                                    <h6>

                                        {{ $project->title }}

                                    </h6>

                                    <small>

                                        {{ Str::limit($project->short_description,60) }}

                                    </small>

                                </div>

                            </div>

                        </td>

                        <td>

                            <span class="table-badge category">

                                {{ $project->category->name }}

                            </span>

                        </td>

                        <td>

                            <div class="tech-list">

                                @foreach($project->technologies->take(3) as $tech)

                                    <span class="table-badge tech">

                                        {{ $tech->name }}

                                    </span>

                                @endforeach

                            </div>

                        </td>

                        <td>

                            @if($project->status == 'published')

                                <span class="table-badge success">

                                    <i class="fa-solid fa-circle"></i>

                                    {{ __('digital_studio_admin.projects.index.statuses.published') }}

                                </span>

                            @else

                                <span class="table-badge warning">

                                    <i class="fa-solid fa-circle"></i>

                                    {{ __('digital_studio_admin.projects.index.statuses.draft') }}

                                </span>

                            @endif

                        </td>

                        <td>

                            @if($project->featured)

                                <span class="table-badge featured">

                                    ⭐ {{ __('digital_studio_admin.projects.index.featured.yes') }}

                                </span>

                            @else

                                —

                            @endif

                        </td>

                        <td>

                            {{ optional($project->project_date)->format('d M Y') }}

                        </td>

                        <td>

                            <div class="table-actions">

                                @if(Route::has('projects.show'))

                                    <a href="{{ route('projects.show',$project) }}"
                                       target="_blank"
                                       class="action-btn view"
                                       title="{{ __('digital_studio_admin.projects.index.actions.view') }}">

                                        <i class="fa-solid fa-eye"></i>

                                    </a>

                                @endif

                                <a href="{{ route('admin.projects.edit',$project) }}"
                                   class="action-btn edit"
                                   title="{{ __('digital_studio_admin.projects.index.actions.edit') }}">

                                    <i class="fa-solid fa-pen"></i>

                                </a>

                                <form method="POST"
                                      action="{{ route('admin.projects.destroy',$project) }}">

                                    @csrf

                                    @method('DELETE')

                                    <button type="submit"
                                            class="action-btn delete"
                                            title="{{ __('digital_studio_admin.projects.index.actions.delete') }}"
                                            onclick="return confirm('{{ __('digital_studio_admin.projects.index.actions.delete_confirm') }}')">

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

                                <i class="fa-solid fa-folder-open"></i>

                                <h4>

                                    {{ __('digital_studio_admin.projects.index.empty.title') }}

                                </h4>

                                <p>

                                    {{ __('digital_studio_admin.projects.index.empty.description') }}

                                </p>

                            </div>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <!--==================================================
                    PAGINATION
    ==================================================-->

    <div class="mt-4">

        {{ $projects->links() }}

    </div>

</div>

@endsection
