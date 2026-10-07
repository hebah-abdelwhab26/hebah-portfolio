@extends('admin.layouts.app')

@section('title', __('digital_studio_admin.technologies.show.title'))

@section('content')

<style>
    .technology-show {
        width: 100%;
    }

    .technology-overview {
        margin-bottom: 25px;
    }

    .technology-overview-content {
        display: flex;
        align-items: center;
        gap: 22px;
        padding: 28px;
        background: rgba(15, 23, 42, .96);
        border: 1px solid rgba(255,255,255,.06);
        border-radius: 18px;
    }

    .technology-icon-box {
        width: 85px;
        height: 85px;
        min-width: 85px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: {{ $technology->color ?? '#2563EB' }};
        border: 2px solid rgba(255,255,255,.08);
        box-shadow: 0 10px 30px rgba(0,0,0,.18);
    }

    .technology-icon-box i {
        color: #fff;
        font-size: 38px;
    }

    .technology-overview-info {
        flex: 1;
    }

    .technology-overview-info h2 {
        margin: 0 0 7px;
        color: #F8FAFC;
        font-size: 25px;
        font-weight: 700;
    }

    .technology-overview-info p {
        margin: 0;
        color: #94A3B8;
        font-size: 14px;
    }

    .technology-overview-meta {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
        margin-top: 14px;
    }

    .technology-details {
        margin-bottom: 25px;
    }

    .technology-section-header {
        padding: 22px 25px;
        border-bottom: 1px solid rgba(255,255,255,.06);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
    }

    .technology-section-header-left {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .technology-section-header-left i {
        color: #2563EB;
        font-size: 20px;
    }

    .technology-section-header-left h3 {
        margin: 0;
        color: #F8FAFC;
        font-size: 18px;
        font-weight: 700;
    }

    .technology-details-table {
        width: 100%;
    }

    .technology-details-row {
        display: grid;
        grid-template-columns: 220px 1fr;
        border-bottom: 1px solid rgba(255,255,255,.05);
    }

    .technology-details-row:last-child {
        border-bottom: none;
    }

    .technology-details-label,
    .technology-details-value {
        padding: 17px 25px;
    }

    .technology-details-label {
        color: #94A3B8;
        font-size: 14px;
        font-weight: 600;
    }

    .technology-details-value {
        color: #CBD5E1;
        font-size: 14px;
    }

    .technology-color-value {
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }

    .technology-color-dot {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        display: inline-block;
        border: 2px solid rgba(255,255,255,.12);
    }

    .technology-description {
        line-height: 1.8;
        white-space: pre-line;
    }

    .technology-projects {
        margin-bottom: 25px;
    }

    @media (max-width: 768px) {

        .technology-overview-content {
            flex-direction: column;
            align-items: flex-start;
        }

        .technology-details-row {
            grid-template-columns: 1fr;
        }

        .technology-details-label {
            padding-bottom: 5px;
        }

        .technology-details-value {
            padding-top: 5px;
        }

        .technology-section-header {
            align-items: flex-start;
            flex-direction: column;
        }

    }
</style>

<div class="container-fluid technology-show">

    <!-- PAGE HEADER -->
    <div class="page-header">

        <div class="page-header-content">

            <div class="page-header-left">

                <div class="page-icon">
                    <i class="fa-solid fa-microchip"></i>
                </div>

                <div>

                    <h1>
                        {{ __('digital_studio_admin.technologies.show.page_header.title') }}
                    </h1>

                    <p>
                        {{ __('digital_studio_admin.technologies.show.page_header.description') }}
                    </p>

                </div>

            </div>

            <div class="page-header-right">

                <a
                    href="{{ route('admin.technologies.edit', $technology) }}"
                    class="btn-admin-primary">

                    <i class="fa-solid fa-pen"></i>

                    {{ __('digital_studio_admin.technologies.show.actions.edit') }}

                </a>

                <a
                    href="{{ route('admin.technologies.index') }}"
                    class="btn-admin">

                    <i class="fa-solid fa-arrow-left"></i>

                    {{ __('digital_studio_admin.technologies.show.actions.back') }}

                </a>

            </div>

        </div>

    </div>


    <!-- TECHNOLOGY OVERVIEW -->
    <div class="projects-table-wrapper technology-overview">

        <div class="technology-overview-content">

            <div
                class="technology-icon-box"
                style="background: {{ $technology->color ?? '#2563EB' }};">

                <i class="{{ $technology->icon ?? 'fa-solid fa-microchip' }}"></i>

            </div>

            <div class="technology-overview-info">

                <h2>
                    {{ $technology->name }}
                </h2>

                @if($technology->description)

                    <p>
                        {{ $technology->description }}
                    </p>

                @endif

                <div class="technology-overview-meta">

                    @if($technology->category)

                        <span class="table-badge tech">

                            <i class="fa-solid fa-layer-group"></i>

                            {{ $technology->category->name }}

                        </span>

                    @endif

                    @if($technology->is_active)

                        <span class="table-badge success">

                            <i class="fa-solid fa-circle"></i>

                            {{ __('digital_studio_admin.technologies.show.status.active') }}

                        </span>

                    @else

                        <span class="table-badge warning">

                            <i class="fa-solid fa-circle"></i>

                            {{ __('digital_studio_admin.technologies.show.status.disabled') }}

                        </span>

                    @endif

                </div>

            </div>

        </div>

    </div>


    <!-- TECHNOLOGY DETAILS -->
    <div class="projects-table-wrapper technology-details">

        <div class="technology-section-header">

            <div class="technology-section-header-left">

                <i class="fa-solid fa-circle-info"></i>

                <h3>
                    {{ __('digital_studio_admin.technologies.show.technology_information.title') }}
                </h3>

            </div>

        </div>


        <div class="technology-details-table">

            <div class="technology-details-row">

                <div class="technology-details-label">
                    {{ __('digital_studio_admin.technologies.show.fields.name') }}
                </div>

                <div class="technology-details-value">
                    {{ $technology->name }}
                </div>

            </div>


            <div class="technology-details-row">

                <div class="technology-details-label">
                    {{ __('digital_studio_admin.technologies.show.fields.slug') }}
                </div>

                <div class="technology-details-value">
                    {{ $technology->slug }}
                </div>

            </div>


            <div class="technology-details-row">

                <div class="technology-details-label">
                    {{ __('digital_studio_admin.technologies.show.fields.category') }}
                </div>

                <div class="technology-details-value">

                    @if($technology->category)

                        {{ $technology->category->name }}

                    @else

                        {{ __('digital_studio_admin.technologies.show.fields.no_category') }}

                    @endif

                </div>

            </div>


            <div class="technology-details-row">

                <div class="technology-details-label">
                    {{ __('digital_studio_admin.technologies.show.fields.icon') }}
                </div>

                <div class="technology-details-value">

                    <i class="{{ $technology->icon ?? 'fa-solid fa-microchip' }}"></i>

                    <span style="margin-left:8px;">
                        {{ $technology->icon ?? 'fa-solid fa-microchip' }}
                    </span>

                </div>

            </div>


            <div class="technology-details-row">

                <div class="technology-details-label">
                    {{ __('digital_studio_admin.technologies.show.fields.color') }}
                </div>

                <div class="technology-details-value">

                    <span class="technology-color-value">

                        <span
                            class="technology-color-dot"
                            style="background: {{ $technology->color ?? '#2563EB' }};">
                        </span>

                        {{ $technology->color ?? '#2563EB' }}

                    </span>

                </div>

            </div>


            <div class="technology-details-row">

                <div class="technology-details-label">
                    {{ __('digital_studio_admin.technologies.show.fields.status') }}
                </div>

                <div class="technology-details-value">

                    @if($technology->is_active)

                        <span class="table-badge success">

                            <i class="fa-solid fa-circle"></i>

                            {{ __('digital_studio_admin.technologies.show.status.active') }}

                        </span>

                    @else

                        <span class="table-badge warning">

                            <i class="fa-solid fa-circle"></i>

                            {{ __('digital_studio_admin.technologies.show.status.disabled') }}

                        </span>

                    @endif

                </div>

            </div>


            <div class="technology-details-row">

                <div class="technology-details-label">
                    {{ __('digital_studio_admin.technologies.show.fields.sort_order') }}
                </div>

                <div class="technology-details-value">
                    {{ $technology->sort_order ?? 0 }}
                </div>

            </div>


            <div class="technology-details-row">

                <div class="technology-details-label">
                    {{ __('digital_studio_admin.technologies.show.fields.description') }}
                </div>

                <div class="technology-details-value technology-description">

                    {{ $technology->description ?: __('digital_studio_admin.technologies.show.fields.no_description') }}

                </div>

            </div>


            <div class="technology-details-row">

                <div class="technology-details-label">
                    {{ __('digital_studio_admin.technologies.show.fields.created_at') }}
                </div>

                <div class="technology-details-value">
                    {{ $technology->created_at?->format('Y-m-d H:i') }}
                </div>

            </div>


            <div class="technology-details-row">

                <div class="technology-details-label">
                    {{ __('digital_studio_admin.technologies.show.fields.updated_at') }}
                </div>

                <div class="technology-details-value">
                    {{ $technology->updated_at?->format('Y-m-d H:i') }}
                </div>

            </div>

        </div>

    </div>


    <!-- RELATED PROJECTS -->
    <div class="projects-table-wrapper technology-projects">

        <div class="technology-section-header">

            <div class="technology-section-header-left">

                <i class="fa-solid fa-folder-open"></i>

                <h3>
                    {{ __('digital_studio_admin.technologies.show.projects.title') }}
                </h3>

            </div>

            <span class="table-badge tech">

                <i class="fa-solid fa-folder-open"></i>

                {{ $technology->projects->count() }}
                {{ __('digital_studio_admin.technologies.show.projects.total') }}

            </span>

        </div>


        <div class="table-responsive">

            <table class="projects-table">

                <thead>

                    <tr style="background:#2563EB;color:#fff;">

                        <th style="border-radius:10px 0 0 10px;">
                            {{ __('digital_studio_admin.technologies.show.projects.table.project') }}
                        </th>

                        <th>
                            {{ __('digital_studio_admin.technologies.show.projects.table.status') }}
                        </th>

                        <th>
                            {{ __('digital_studio_admin.technologies.show.projects.table.created_at') }}
                        </th>

                        <th
                            class="text-end text-center"
                            style="border-radius:0 10px 10px 0;">
                            {{ __('digital_studio_admin.technologies.show.projects.table.actions') }}
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($technology->projects as $project)

                        <tr>

                            <td class="px-2">

                                <div class="project-info">

                                    @if($project->cover_image)

                                        <img
                                            src="{{ asset('storage/' . $project->cover_image) }}"
                                            alt="{{ $project->title }}"
                                            style="
                                                width:70px;
                                                height:70px;
                                                object-fit:cover;
                                                border-radius:18px;
                                            ">

                                    @else

                                        <div
                                            style="
                                                width:70px;
                                                height:70px;
                                                border-radius:18px;
                                                background:#2563EB;
                                                display:flex;
                                                align-items:center;
                                                justify-content:center;
                                            ">

                                            <i
                                                class="fa-solid fa-folder-open"
                                                style="color:#fff;font-size:28px;">
                                            </i>

                                        </div>

                                    @endif

                                    <div>

                                        <h6>
                                            {{ $project->title }}
                                        </h6>

                                        <small>
                                            {{ $project->slug }}
                                        </small>

                                    </div>

                                </div>

                            </td>


                            <td class="px-2">

                                @if($project->is_active)

                                    <span class="table-badge success">

                                        <i class="fa-solid fa-circle"></i>

                                        {{ __('digital_studio_admin.technologies.show.projects.status.active') }}

                                    </span>

                                @else

                                    <span class="table-badge warning">

                                        <i class="fa-solid fa-circle"></i>

                                        {{ __('digital_studio_admin.technologies.show.projects.status.disabled') }}

                                    </span>

                                @endif

                            </td>


                            <td class="px-2">

                                <span style="color:#CBD5E1;">

                                    {{ $project->created_at?->format('Y-m-d') }}

                                </span>

                            </td>


                            <td class="px-2">

                                <div class="table-actions">

                                    <a
                                        href="{{ route('admin.projects.show', $project) }}"
                                        class="action-btn view"
                                        title="{{ __('digital_studio_admin.technologies.show.projects.actions.view') }}">

                                        <i class="fa-solid fa-eye"></i>

                                    </a>

                                    <a
                                        href="{{ route('admin.projects.edit', $project) }}"
                                        class="action-btn edit"
                                        title="{{ __('digital_studio_admin.technologies.show.projects.actions.edit') }}">

                                        <i class="fa-solid fa-pen"></i>

                                    </a>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="4">

                                <div class="table-empty">

                                    <i class="fa-solid fa-folder-open"></i>

                                    <h4>
                                        {{ __('digital_studio_admin.technologies.show.projects.empty.title') }}
                                    </h4>

                                    <p>
                                        {{ __('digital_studio_admin.technologies.show.projects.empty.description') }}
                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection
