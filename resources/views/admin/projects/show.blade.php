@extends('admin.layouts.app')

@section('title', __('digital_studio_admin.projects.show.title'))

@section('content')

<style>

    .project-show-page{
        width:100%;
    }

    .project-show-card{
        margin-bottom:25px;
    }

    .project-show-top{
        display:flex;
        align-items:center;
        gap:25px;
        padding:28px;
        background:#0F172A;
        border:1px solid rgba(255,255,255,.06);
        border-radius:18px;
    }

    .project-show-image{
        width:150px;
        height:110px;
        flex-shrink:0;
        border-radius:18px;
        overflow:hidden;
        background:#1E293B;
        border:1px solid rgba(255,255,255,.08);
    }

    .project-show-image img{
        width:100%;
        height:100%;
        object-fit:cover;
        display:block;
    }

    .project-show-image-placeholder{
        width:100%;
        height:100%;
        display:flex;
        align-items:center;
        justify-content:center;
        color:#64748B;
        font-size:40px;
    }

    .project-show-info{
        flex:1;
        min-width:0;
    }

    .project-show-info h2{
        margin:0 0 8px;
        color:#F8FAFC;
        font-size:26px;
        font-weight:700;
    }

    .project-show-info p{
        margin:0;
        color:#94A3B8;
        font-size:14px;
        line-height:1.8;
    }

    .project-show-meta{
        display:flex;
        align-items:center;
        gap:10px;
        flex-wrap:wrap;
        margin-top:15px;
    }

    .project-section-title{
        display:flex;
        align-items:center;
        gap:12px;
        padding:22px 25px;
        border-bottom:1px solid rgba(255,255,255,.06);
    }

    .project-section-title i{
        color:#2563EB;
        font-size:19px;
    }

    .project-section-title h3{
        margin:0;
        color:#F8FAFC;
        font-size:18px;
        font-weight:700;
    }

    .project-details-table{
        width:100%;
    }

    .project-details-row{
        display:grid;
        grid-template-columns:220px 1fr;
        border-bottom:1px solid rgba(255,255,255,.05);
    }

    .project-details-row:last-child{
        border-bottom:none;
    }

    .project-details-label{
        padding:17px 25px;
        color:#94A3B8;
        font-size:14px;
        font-weight:600;
    }

    .project-details-value{
        padding:17px 25px;
        color:#CBD5E1;
        font-size:14px;
    }

    .project-description{
        line-height:1.9;
        white-space:pre-line;
    }

    .project-tech-list{
        display:flex;
        flex-wrap:wrap;
        gap:8px;
    }

    .project-links{
        display:flex;
        flex-wrap:wrap;
        gap:10px;
    }

    .project-link{
        display:inline-flex;
        align-items:center;
        gap:8px;
        padding:9px 14px;
        border-radius:10px;
        color:#CBD5E1;
        background:#1E293B;
        border:1px solid rgba(255,255,255,.06);
        text-decoration:none;
        transition:.2s ease;
    }

    .project-link:hover{
        color:#fff;
        background:#2563EB;
    }

    .project-gallery{
        display:grid;
        grid-template-columns:repeat(4,1fr);
        gap:15px;
        padding:25px;
    }

    .project-gallery-item{
        height:170px;
        border-radius:15px;
        overflow:hidden;
        background:#1E293B;
        border:1px solid rgba(255,255,255,.06);
    }

    .project-gallery-item img{
        width:100%;
        height:100%;
        object-fit:cover;
        display:block;
    }

    @media(max-width:992px){

        .project-gallery{
            grid-template-columns:repeat(3,1fr);
        }

    }

    @media(max-width:768px){

        .project-show-top{
            flex-direction:column;
            align-items:flex-start;
        }

        .project-show-image{
            width:100%;
            height:190px;
        }

        .project-details-row{
            grid-template-columns:1fr;
        }

        .project-details-label{
            padding-bottom:5px;
        }

        .project-details-value{
            padding-top:5px;
        }

        .project-gallery{
            grid-template-columns:repeat(2,1fr);
        }

    }

    @media(max-width:480px){

        .project-gallery{
            grid-template-columns:1fr;
        }

    }

</style>


<div class="projects-page project-show-page">

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
                        {{ __('digital_studio_admin.projects.show.page_header.title') }}
                    </h1>

                    <p>
                        {{ __('digital_studio_admin.projects.show.page_header.description') }}
                    </p>

                </div>

            </div>

            <div class="page-header-right">

                <a
                    href="{{ route('admin.projects.edit',$project) }}"
                    class="btn-admin-primary">

                    <i class="fa-solid fa-pen"></i>

                    {{ __('digital_studio_admin.projects.show.actions.edit') }}

                </a>

                <a
                    href="{{ route('admin.projects.index') }}"
                    class="btn-admin">

                    <i class="fa-solid fa-arrow-left"></i>

                    {{ __('digital_studio_admin.projects.show.actions.back') }}

                </a>

            </div>

        </div>

    </div>


    <!--==================================================
                    PROJECT OVERVIEW
    ==================================================-->

    <div class="projects-table-wrapper project-show-card">

        <div class="project-show-top">

            <div class="project-show-image">

                @if($project->thumbnail_url)

                    <img
                        src="{{ $project->thumbnail_url }}"
                        alt="{{ $project->title }}">

                @else

                    <div class="project-show-image-placeholder">

                        <i class="fa-solid fa-folder-open"></i>

                    </div>

                @endif

            </div>


            <div class="project-show-info">

                <h2>
                    {{ $project->title }}
                </h2>

                @if($project->short_description)

                    <p>
                        {{ $project->short_description }}
                    </p>

                @endif


                <div class="project-show-meta">

                    @if($project->category)

                        <span class="table-badge category">

                            <i class="fa-solid fa-layer-group"></i>

                            {{ $project->category->name }}

                        </span>

                    @endif


                    @if($project->status === 'published')

                        <span class="table-badge success">

                            <i class="fa-solid fa-circle"></i>

                            {{ __('digital_studio_admin.projects.show.statuses.published') }}

                        </span>

                    @else

                        <span class="table-badge warning">

                            <i class="fa-solid fa-circle"></i>

                            {{ __('digital_studio_admin.projects.show.statuses.draft') }}

                        </span>

                    @endif


                    @if($project->featured)

                        <span class="table-badge featured">

                            ⭐ {{ __('digital_studio_admin.projects.show.featured.yes') }}

                        </span>

                    @endif

                </div>

            </div>

        </div>

    </div>


    <!--==================================================
                    PROJECT INFORMATION
    ==================================================-->

    <div class="projects-table-wrapper project-show-card">

        <div class="project-section-title">

            <i class="fa-solid fa-circle-info"></i>

            <h3>
                {{ __('digital_studio_admin.projects.show.project_information.title') }}
            </h3>

        </div>


        <div class="project-details-table">

            <!-- NAME -->

            <div class="project-details-row">

                <div class="project-details-label">
                    {{ __('digital_studio_admin.projects.show.fields.title') }}
                </div>

                <div class="project-details-value">
                    {{ $project->title }}
                </div>

            </div>


            <!-- SLUG -->

            <div class="project-details-row">

                <div class="project-details-label">
                    {{ __('digital_studio_admin.projects.show.fields.slug') }}
                </div>

                <div class="project-details-value">
                    {{ $project->slug }}
                </div>

            </div>


            <!-- CATEGORY -->

            <div class="project-details-row">

                <div class="project-details-label">
                    {{ __('digital_studio_admin.projects.show.fields.category') }}
                </div>

                <div class="project-details-value">

                    @if($project->category)

                        <span class="table-badge category">

                            {{ $project->category->name }}

                        </span>

                    @else

                        {{ __('digital_studio_admin.projects.show.fields.no_category') }}

                    @endif

                </div>

            </div>


            <!-- STATUS -->

            <div class="project-details-row">

                <div class="project-details-label">
                    {{ __('digital_studio_admin.projects.show.fields.status') }}
                </div>

                <div class="project-details-value">

                    @if($project->status === 'published')

                        <span class="table-badge success">

                            <i class="fa-solid fa-circle"></i>

                            {{ __('digital_studio_admin.projects.show.statuses.published') }}

                        </span>

                    @else

                        <span class="table-badge warning">

                            <i class="fa-solid fa-circle"></i>

                            {{ __('digital_studio_admin.projects.show.statuses.draft') }}

                        </span>

                    @endif

                </div>

            </div>


            <!-- FEATURED -->

            <div class="project-details-row">

                <div class="project-details-label">
                    {{ __('digital_studio_admin.projects.show.fields.featured') }}
                </div>

                <div class="project-details-value">

                    @if($project->featured)

                        <span class="table-badge featured">

                            ⭐ {{ __('digital_studio_admin.projects.show.featured.yes') }}

                        </span>

                    @else

                        {{ __('digital_studio_admin.projects.show.featured.no') }}

                    @endif

                </div>

            </div>


            <!-- PROJECT DATE -->

            <div class="project-details-row">

                <div class="project-details-label">
                    {{ __('digital_studio_admin.projects.show.fields.project_date') }}
                </div>

                <div class="project-details-value">

                    {{ optional($project->project_date)->format('d M Y') ?? '—' }}

                </div>

            </div>


            <!-- SHORT DESCRIPTION -->

            <div class="project-details-row">

                <div class="project-details-label">
                    {{ __('digital_studio_admin.projects.show.fields.short_description') }}
                </div>

                <div class="project-details-value project-description">

                    {{ $project->short_description ?: __('digital_studio_admin.projects.show.fields.no_description') }}

                </div>

            </div>


            <!-- DESCRIPTION -->

            <div class="project-details-row">

                <div class="project-details-label">
                    {{ __('digital_studio_admin.projects.show.fields.description') }}
                </div>

                <div class="project-details-value project-description">

                    {{ $project->description ?: __('digital_studio_admin.projects.show.fields.no_description') }}

                </div>

            </div>


            <!-- CREATED -->

            <div class="project-details-row">

                <div class="project-details-label">
                    {{ __('digital_studio_admin.projects.show.fields.created_at') }}
                </div>

                <div class="project-details-value">

                    {{ $project->created_at?->format('Y-m-d H:i') }}

                </div>

            </div>


            <!-- UPDATED -->

            <div class="project-details-row">

                <div class="project-details-label">
                    {{ __('digital_studio_admin.projects.show.fields.updated_at') }}
                </div>

                <div class="project-details-value">

                    {{ $project->updated_at?->format('Y-m-d H:i') }}

                </div>

            </div>

        </div>

    </div>


    <!--==================================================
                    TECHNOLOGIES
    ==================================================-->

    <div class="projects-table-wrapper project-show-card">

        <div class="project-section-title">

            <i class="fa-solid fa-code"></i>

            <h3>
                {{ __('digital_studio_admin.projects.show.technologies.title') }}
            </h3>

        </div>


        <div style="padding:25px;">

            @if($project->technologies->count())

                <div class="project-tech-list">

                    @foreach($project->technologies as $technology)

                        <span class="table-badge tech">

                            {{ $technology->name }}

                        </span>

                    @endforeach

                </div>

            @else

                <div class="table-empty">

                    <i class="fa-solid fa-code"></i>

                    <h4>
                        {{ __('digital_studio_admin.projects.show.technologies.empty.title') }}
                    </h4>

                    <p>
                        {{ __('digital_studio_admin.projects.show.technologies.empty.description') }}
                    </p>

                </div>

            @endif

        </div>

    </div>


    <!--==================================================
                    PROJECT LINKS
    ==================================================-->

    @if(
        $project->live_url ||
        $project->github_url ||
        $project->demo_url
    )

        <div class="projects-table-wrapper project-show-card">

            <div class="project-section-title">

                <i class="fa-solid fa-link"></i>

                <h3>
                    {{ __('digital_studio_admin.projects.show.links.title') }}
                </h3>

            </div>


            <div style="padding:25px;">

                <div class="project-links">

                    @if($project->live_url)

                        <a
                            href="{{ $project->live_url }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="project-link">

                            <i class="fa-solid fa-globe"></i>

                            {{ __('digital_studio_admin.projects.show.links.live') }}

                        </a>

                    @endif


                    @if($project->github_url)

                        <a
                            href="{{ $project->github_url }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="project-link">

                            <i class="fa-brands fa-github"></i>

                            {{ __('digital_studio_admin.projects.show.links.github') }}

                        </a>

                    @endif


                    @if($project->demo_url)

                        <a
                            href="{{ $project->demo_url }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="project-link">

                            <i class="fa-solid fa-display"></i>

                            {{ __('digital_studio_admin.projects.show.links.demo') }}

                        </a>

                    @endif

                </div>

            </div>

        </div>

    @endif


    <!--==================================================
                    GALLERY
    ==================================================-->

    @if($project->gallery && $project->gallery->count())

        <div class="projects-table-wrapper project-show-card">

            <div class="project-section-title">

                <i class="fa-solid fa-images"></i>

                <h3>
                    {{ __('digital_studio_admin.projects.show.gallery.title') }}
                </h3>

            </div>


            <div class="project-gallery">

                @foreach($project->gallery as $image)

                    <div class="project-gallery-item">

                        <img
                            src="{{ asset('storage/' . $image->image_path) }}"
                            alt="{{ $project->title }}">

                    </div>

                @endforeach

            </div>

        </div>

    @endif


    <!--==================================================
                    ACTIONS
    ==================================================-->

    <div
        style="
            display:flex;
            justify-content:flex-end;
            gap:10px;
            margin-top:25px;
            margin-bottom:25px;
        ">

        <a
            href="{{ route('admin.projects.index') }}"
            class="btn-admin">

            <i class="fa-solid fa-arrow-left"></i>

            {{ __('digital_studio_admin.projects.show.actions.back') }}

        </a>

        <a
            href="{{ route('admin.projects.edit',$project) }}"
            class="btn-admin-primary">

            <i class="fa-solid fa-pen"></i>

            {{ __('digital_studio_admin.projects.show.actions.edit') }}

        </a>

    </div>

</div>

@endsection
