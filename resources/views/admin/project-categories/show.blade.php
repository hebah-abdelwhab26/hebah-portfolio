@extends('admin.layouts.app')

@section('title', __('digital_studio_admin.project_categories.show.title'))

@section('content')

<style>

/*==================================================
        PROJECT CATEGORY SHOW
==================================================*/

.project-category-show {
    width: 100%;
}


/*==================================================
        CATEGORY HERO
==================================================*/

.category-show-card {

    background:
        linear-gradient(
            135deg,
            rgba(37, 99, 235, .14),
            rgba(15, 23, 42, .95)
        );

    border: 1px solid rgba(255,255,255,.08);

    border-radius: 18px;

    padding: 28px;

    margin-bottom: 25px;

    position: relative;

    overflow: hidden;

}

.category-show-card::before {

    content: "";

    position: absolute;

    width: 260px;

    height: 260px;

    top: -150px;

    right: -100px;

    border-radius: 50%;

    background: rgba(37,99,235,.15);

    filter: blur(20px);

}

.category-show-header {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 25px;

    position: relative;

    z-index: 2;

}


.category-show-info {

    display: flex;

    align-items: center;

    gap: 20px;

}


/*==================================================
        CATEGORY ICON
==================================================*/

.category-show-icon {

    width: 90px;

    height: 90px;

    border-radius: 22px;

    display: flex;

    align-items: center;

    justify-content: center;

    flex-shrink: 0;

    border: 2px solid rgba(255,255,255,.08);

    box-shadow:
        0 10px 30px rgba(0,0,0,.20);

}

.category-show-icon i {

    color: #fff;

    font-size: 34px;

}


/*==================================================
        CATEGORY TEXT
==================================================*/

.category-show-text h1 {

    margin: 0 0 7px;

    color: #fff;

    font-size: 28px;

    font-weight: 800;

}

.category-show-text p {

    margin: 0 0 8px;

    color: #CBD5E1;

    font-size: 14px;

}

.category-show-text small {

    color: #94A3B8;

    font-size: 12px;

}


/*==================================================
        ACTIONS
==================================================*/

.category-show-actions {

    display: flex;

    align-items: center;

    gap: 10px;

    flex-shrink: 0;

}


/*==================================================
        STAT BOX
==================================================*/

.category-stat-box {

    min-width: 150px;

    padding: 18px 20px;

    background: rgba(15,23,42,.55);

    border: 1px solid rgba(255,255,255,.08);

    border-radius: 15px;

    text-align: center;

}

.category-stat-box span {

    display: block;

    color: #94A3B8;

    font-size: 12px;

    margin-bottom: 5px;

}

.category-stat-box strong {

    display: block;

    color: #fff;

    font-size: 28px;

    font-weight: 800;

}


/*==================================================
        INFORMATION GRID
==================================================*/

.category-details-grid {

    display: grid;

    grid-template-columns:
        repeat(2, minmax(0, 1fr));

    gap: 20px;

    margin-bottom: 25px;

}


/*==================================================
        DETAILS CARD
==================================================*/

.category-details-card {

    background: #0F172A;

    border: 1px solid rgba(255,255,255,.07);

    border-radius: 16px;

    padding: 22px;

}


.category-card-title {

    display: flex;

    align-items: center;

    gap: 10px;

    margin-bottom: 20px;

    padding-bottom: 15px;

    border-bottom:
        1px solid rgba(255,255,255,.07);

}


.category-card-title i {

    color: #2563EB;

    font-size: 16px;

}


.category-card-title h3 {

    margin: 0;

    color: #fff;

    font-size: 16px;

    font-weight: 700;

}


/*==================================================
        DETAILS LIST
==================================================*/

.category-details-list {

    display: grid;

    grid-template-columns:
        repeat(2, minmax(0, 1fr));

    gap: 18px;

}


.category-detail-item {

    padding: 14px;

    background: rgba(255,255,255,.025);

    border:
        1px solid rgba(255,255,255,.05);

    border-radius: 12px;

}


.category-detail-item.full {

    grid-column: 1 / -1;

}


.category-detail-label {

    display: block;

    color: #64748B;

    font-size: 11px;

    font-weight: 700;

    margin-bottom: 7px;

}


.category-detail-value {

    color: #E2E8F0;

    font-size: 13px;

    font-weight: 600;

    line-height: 1.7;

}


.category-detail-value code {

    color: #60A5FA;

    background: rgba(37,99,235,.10);

    padding: 4px 8px;

    border-radius: 6px;

    font-size: 11px;

}


/*==================================================
        COLOR
==================================================*/

.category-color-preview {

    display: flex;

    align-items: center;

    gap: 10px;

}


.category-color-circle {

    width: 25px;

    height: 25px;

    border-radius: 50%;

    border: 2px solid rgba(255,255,255,.15);

}


/*==================================================
        STATUS
==================================================*/

.category-status {

    display: inline-flex;

    align-items: center;

    gap: 7px;

    padding: 7px 12px;

    border-radius: 999px;

    font-size: 11px;

    font-weight: 700;

}


.category-status.active {

    color: #86EFAC;

    background: rgba(34,197,94,.10);

}


.category-status.disabled {

    color: #FCD34D;

    background: rgba(245,158,11,.10);

}


/*==================================================
        PROJECTS SECTION
==================================================*/

.category-projects-card {

    background: #0F172A;

    border: 1px solid rgba(255,255,255,.07);

    border-radius: 16px;

    overflow: hidden;

}


.category-projects-header {

    display: flex;

    align-items: center;

    justify-content: space-between;

    padding: 20px 22px;

    border-bottom:
        1px solid rgba(255,255,255,.07);

}


.category-projects-header-left {

    display: flex;

    align-items: center;

    gap: 10px;

}


.category-projects-header-left i {

    color: #2563EB;

}


.category-projects-header h3 {

    margin: 0;

    color: #fff;

    font-size: 17px;

    font-weight: 700;

}


.category-projects-count {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    min-width: 32px;

    height: 26px;

    padding: 0 9px;

    border-radius: 8px;

    color: #93C5FD;

    background: rgba(37,99,235,.12);

    font-size: 11px;

    font-weight: 700;

}


/*==================================================
        PROJECT IMAGE
==================================================*/

.category-project-info {

    display: flex;

    align-items: center;

    gap: 13px;

}


.category-project-image {

    width: 55px;

    height: 45px;

    border-radius: 9px;

    object-fit: cover;

    flex-shrink: 0;

}


.category-project-placeholder {

    width: 55px;

    height: 45px;

    border-radius: 9px;

    display: flex;

    align-items: center;

    justify-content: center;

    flex-shrink: 0;

    color: #64748B;

    background: #1E293B;

}


.category-project-info h6 {

    margin: 0 0 4px;

    color: #F8FAFC;

    font-size: 13px;

    font-weight: 700;

}


.category-project-info small {

    color: #64748B;

    font-size: 10px;

}


/*==================================================
        EMPTY PROJECTS
==================================================*/

.category-empty {

    padding: 55px 20px;

    text-align: center;

}


.category-empty-icon {

    width: 65px;

    height: 65px;

    margin: 0 auto 15px;

    border-radius: 18px;

    display: flex;

    align-items: center;

    justify-content: center;

    color: #64748B;

    background: #1E293B;

    font-size: 24px;

}


.category-empty h4 {

    margin: 0 0 7px;

    color: #E2E8F0;

    font-size: 16px;

    font-weight: 700;

}


.category-empty p {

    margin: 0 auto 20px;

    max-width: 500px;

    color: #64748B;

    font-size: 12px;

    line-height: 1.8;

}


/*==================================================
        RESPONSIVE
==================================================*/

@media (max-width: 992px) {

    .category-show-header {

        flex-direction: column;

        align-items: stretch;

    }

    .category-show-actions {

        justify-content: flex-start;

    }

    .category-stat-box {

        width: 100%;

    }

    .category-details-grid {

        grid-template-columns: 1fr;

    }

}


@media (max-width: 768px) {

    .category-show-card {

        padding: 20px;

    }

    .category-show-info {

        align-items: flex-start;

    }

    .category-show-icon {

        width: 70px;

        height: 70px;

    }

    .category-show-icon i {

        font-size: 27px;

    }

    .category-show-text h1 {

        font-size: 22px;

    }

    .category-details-list {

        grid-template-columns: 1fr;

    }

    .category-detail-item.full {

        grid-column: auto;

    }

    .category-show-actions {

        flex-direction: column;

        width: 100%;

    }

    .category-show-actions .btn-admin-primary,
    .category-show-actions .btn-admin {

        width: 100%;

        justify-content: center;

    }

}


@media (max-width: 576px) {

    .category-show-info {

        flex-direction: column;

    }

}

</style>


<div class="container-fluid project-category-show">


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

                        {{ __('digital_studio_admin.project_categories.show.page_header.title') }}

                    </h1>

                    <p>

                        {{ __('digital_studio_admin.project_categories.show.page_header.description') }}

                    </p>

                </div>

            </div>


            <div class="page-header-right">

                <a
                    href="{{ route('admin.project-categories.edit',$projectCategory) }}"
                    class="btn-admin-primary">

                    <i class="fa-solid fa-pen"></i>

                    {{ __('digital_studio_admin.project_categories.show.actions.edit') }}

                </a>


                <a
                    href="{{ route('admin.project-categories.index') }}"
                    class="btn-admin">

                    <i class="fa-solid fa-arrow-left"></i>

                    {{ __('digital_studio_admin.project_categories.show.actions.back') }}

                </a>

            </div>

        </div>

    </div>


    <!--==================================
            CATEGORY OVERVIEW
    ==================================-->

    <div class="category-show-card">

        <div class="category-show-header">


            <div class="category-show-info">


                <div
                    class="category-show-icon"
                    style="
                        background:{{ $projectCategory->color ?? '#2563EB' }};
                    ">

                    <i class="{{ $projectCategory->icon }}"></i>

                </div>


                <div class="category-show-text">

                    <h1>

                        {{ $projectCategory->name }}

                    </h1>

                    <p>

                        {{ $projectCategory->description
                            ?: __('digital_studio_admin.project_categories.show.fields.no_description') }}

                    </p>

                    <small>

                        {{ $projectCategory->slug }}

                    </small>

                </div>


            </div>


            <div class="category-show-actions">


                <div class="category-stat-box">

                    <span>

                        {{ __('digital_studio_admin.project_categories.show.projects.total') }}

                    </span>

                    <strong>

                        {{ $projectCategory->projects->count() }}

                    </strong>

                </div>


            </div>

        </div>

    </div>


    <!--==================================
            CATEGORY DETAILS
    ==================================-->

    <div class="category-details-grid">


        <div class="category-details-card">


            <div class="category-card-title">

                <i class="fa-solid fa-circle-info"></i>

                <h3>

                    {{ __('digital_studio_admin.project_categories.show.category_information.title') }}

                </h3>

            </div>


            <div class="category-details-list">


                <!-- NAME -->

                <div class="category-detail-item">

                    <span class="category-detail-label">

                        {{ __('digital_studio_admin.project_categories.show.fields.name') }}

                    </span>

                    <div class="category-detail-value">

                        {{ $projectCategory->name }}

                    </div>

                </div>


                <!-- SLUG -->

                <div class="category-detail-item">

                    <span class="category-detail-label">

                        {{ __('digital_studio_admin.project_categories.show.fields.slug') }}

                    </span>

                    <div class="category-detail-value">

                        <code>

                            {{ $projectCategory->slug }}

                        </code>

                    </div>

                </div>


                <!-- COLOR -->

                <div class="category-detail-item">

                    <span class="category-detail-label">

                        {{ __('digital_studio_admin.project_categories.index.table.color') }}

                    </span>

                    <div class="category-detail-value category-color-preview">

                        <span
                            class="category-color-circle"
                            style="background:{{ $projectCategory->color ?? '#2563EB' }};">
                        </span>

                        {{ $projectCategory->color ?? '#2563EB' }}

                    </div>

                </div>


                <!-- STATUS -->

                <div class="category-detail-item">

                    <span class="category-detail-label">

                        {{ __('digital_studio_admin.project_categories.show.fields.status') }}

                    </span>


                    @if($projectCategory->is_active)

                        <span class="category-status active">

                            <i class="fa-solid fa-circle"></i>

                            {{ __('digital_studio_admin.project_categories.show.status.active') }}

                        </span>

                    @else

                        <span class="category-status disabled">

                            <i class="fa-solid fa-circle"></i>

                            {{ __('digital_studio_admin.project_categories.show.status.disabled') }}

                        </span>

                    @endif

                </div>


                <!-- DESCRIPTION -->

                <div class="category-detail-item full">

                    <span class="category-detail-label">

                        {{ __('digital_studio_admin.project_categories.show.fields.description') }}

                    </span>

                    <div class="category-detail-value">

                        @if($projectCategory->description)

                            {!! nl2br(e($projectCategory->description)) !!}

                        @else

                            <span style="color:#64748B;">

                                {{ __('digital_studio_admin.project_categories.show.fields.no_description') }}

                            </span>

                        @endif

                    </div>

                </div>


                <!-- SORT ORDER -->

                <div class="category-detail-item">

                    <span class="category-detail-label">

                        {{ __('digital_studio_admin.project_categories.show.fields.sort_order') }}

                    </span>

                    <div class="category-detail-value">

                        {{ $projectCategory->sort_order ?? 0 }}

                    </div>

                </div>


                <!-- CREATED -->

                <div class="category-detail-item">

                    <span class="category-detail-label">

                        {{ __('digital_studio_admin.project_categories.show.fields.created_at') }}

                    </span>

                    <div class="category-detail-value">

                        {{ $projectCategory->created_at?->format('Y-m-d H:i') }}

                    </div>

                </div>


                <!-- UPDATED -->

                <div class="category-detail-item">

                    <span class="category-detail-label">

                        {{ __('digital_studio_admin.project_categories.show.fields.updated_at') }}

                    </span>

                    <div class="category-detail-value">

                        {{ $projectCategory->updated_at?->format('Y-m-d H:i') }}

                    </div>

                </div>


            </div>

        </div>


    </div>


    <!--==================================
            RELATED PROJECTS
    ==================================-->

    <div class="category-projects-card">


        <div class="category-projects-header">


            <div class="category-projects-header-left">

                <i class="fa-solid fa-folder-open"></i>

                <h3>

                    {{ __('digital_studio_admin.project_categories.show.projects.list_title') }}

                </h3>

                <span class="category-projects-count">

                    {{ $projectCategory->projects->count() }}

                </span>

            </div>


        </div>


        @if($projectCategory->projects->count())


            <div class="projects-table-wrapper">

                <table class="projects-table">


                    <thead>

                        <tr style="background:#2563EB;color:#fff;">

                            <th style="border-radius:10px 0 0 10px;">

                                {{ __('digital_studio_admin.project_categories.show.projects.table.project') }}

                            </th>

                            <th>

                                {{ __('digital_studio_admin.project_categories.show.projects.table.status') }}

                            </th>

                            <th>

                                {{ __('digital_studio_admin.project_categories.show.projects.table.created_at') }}

                            </th>

                            <th
                                class="text-end text-center"
                                style="border-radius:0 10px 10px 0;">

                                {{ __('digital_studio_admin.project_categories.show.projects.table.actions') }}

                            </th>

                        </tr>

                    </thead>


                    <tbody>


                        @foreach($projectCategory->projects as $project)


                            <tr>


                                <!-- PROJECT -->

                                <td class="px-2">

                                    <div class="category-project-info">


                                        @if($project->cover_image)

                                            <img
                                                src="{{ asset('images/projects/covers/' . $project->cover_image) }}"
                                                alt="{{ $project->title }}"
                                                class="category-project-image">

                                        @else

                                            <div class="category-project-placeholder">

                                                <i class="fa-solid fa-image"></i>

                                            </div>

                                        @endif


                                        <div>

                                            <h6>

                                                {{ $project->title }}

                                            </h6>


                                            @if($project->slug)

                                                <small>

                                                    {{ $project->slug }}

                                                </small>

                                            @endif

                                        </div>


                                    </div>

                                </td>


                                <!-- STATUS -->

                                <td class="px-2">


                                    @if($project->is_active ?? false)

                                        <span class="table-badge success">

                                            <i class="fa-solid fa-circle"></i>

                                            {{ __('digital_studio_admin.project_categories.show.projects.status.active') }}

                                        </span>

                                    @else

                                        <span class="table-badge warning">

                                            <i class="fa-solid fa-circle"></i>

                                            {{ __('digital_studio_admin.project_categories.show.projects.status.disabled') }}

                                        </span>

                                    @endif


                                </td>


                                <!-- DATE -->

                                <td class="px-2">

                                    <span style="color:#CBD5E1;">

                                        {{ $project->created_at?->format('Y-m-d') }}

                                    </span>

                                </td>


                                <!-- ACTIONS -->

                                <td class="px-2">


                                    <div class="table-actions">


                                        <a
                                            href="{{ route('admin.projects.show',$project) }}"
                                            class="action-btn view"
                                            title="{{ __('digital_studio_admin.project_categories.show.projects.actions.view') }}">

                                            <i class="fa-solid fa-eye"></i>

                                        </a>


                                        <a
                                            href="{{ route('admin.projects.edit',$project) }}"
                                            class="action-btn edit"
                                            title="{{ __('digital_studio_admin.project_categories.show.projects.actions.edit') }}">

                                            <i class="fa-solid fa-pen"></i>

                                        </a>


                                    </div>


                                </td>


                            </tr>


                        @endforeach


                    </tbody>

                </table>

            </div>


        @else


            <div class="category-empty">


                <div class="category-empty-icon">

                    <i class="fa-solid fa-folder-tree"></i>

                </div>


                <h4>

                    {{ __('digital_studio_admin.project_categories.show.projects.empty.title') }}

                </h4>


                <p>

                    {{ __('digital_studio_admin.project_categories.show.projects.empty.description') }}

                </p>


                <a
                    href="{{ route('admin.projects.create') }}"
                    class="btn-admin-primary">

                    <i class="fa-solid fa-plus"></i>

                    {{ __('digital_studio_admin.project_categories.show.projects.empty.action') }}

                </a>


            </div>


        @endif


    </div>


</div>

@endsection
