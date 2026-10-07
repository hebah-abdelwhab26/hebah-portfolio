@extends('tech.layouts.app')

@section('title', $project->title)

@section('content')

<div class="digital-page">

    @include('tech.sections.navbar')

    <!--==================================
            HERO
    ===================================-->

    <section class="figma-hero">

        <div class="container">

            <div class="figma-hero-grid">

                <!--==================================
                        PROJECT IMAGE
                ===================================-->

                <div class="figma-preview">

                    <div class="preview-card">

                        <img
                            src="{{ $project->cover_image_url }}"
                            alt="{{ $project->title }}"
                            class="preview-image"

                            data-title="{{ $project->title }}"

                            data-category="{{ $project->category?->name }}"

                            data-type="Cover">

                    </div>

                </div>

                <!--==================================
                        PROJECT CONTENT
                ===================================-->

                <div class="figma-content">

                    <span class="section-badge">

                        {{ $project->category?->name }}

                    </span>

                    <h1>

                        {{ $project->title }}

                    </h1>

                    @if($project->subtitle)

                        <h2>

                            {{ $project->subtitle }}

                        </h2>

                    @endif

                    <p>

                        {{ $project->short_description }}

                    </p>

                    <!--==================================
                            ACTION BUTTONS
                    ===================================-->

                    <div class="figma-actions">

                        @if($project->figma)

                            <a
                                href="{{ $project->figma }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="primary-btn">

                                <i class="fa-brands fa-figma"></i>

                                {{ __('digital_studio.project.actions.view_design') }}

                            </a>

                        @endif

                        @if($project->live_demo)

                            <a
                                href="{{ $project->live_demo }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="secondary-btn">

                                <i class="fa-solid fa-arrow-up-right-from-square"></i>

                                {{ __('digital_studio.project.actions.live_demo') }}

                            </a>

                        @endif

                        @if($project->github)

                            <a
                                href="{{ $project->github }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="secondary-btn">

                                <i class="fa-brands fa-github"></i>

                                {{ __('digital_studio.project.actions.github') }}

                            </a>

                        @endif

                    </div>

                    <!--==================================
                            PROJECT META
                    ===================================-->

                    <div class="figma-meta">

                        @if($project->client)

                            <div class="meta-item">

                                <span>

                                    {{ __('digital_studio.project.meta.client') }}

                                </span>

                                <strong>

                                    {{ $project->client }}

                                </strong>

                            </div>

                        @endif

                        @if($project->project_date)

                            <div class="meta-item">

                                <span>

                                    {{ __('digital_studio.project.meta.date') }}

                                </span>

                                <strong>

                                    {{ $project->project_date->format('M Y') }}

                                </strong>

                            </div>

                        @endif

                        @if($project->duration)

                            <div class="meta-item">

                                <span>

                                    {{ __('digital_studio.project.meta.duration') }}

                                </span>

                                <strong>

                                    {{ $project->duration }}

                                </strong>

                            </div>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </section>


    <!--==================================
        PROJECT DETAILS
    ===================================-->

    <section class="figma-details">

        <div class="container">

            <div class="figma-details-grid">

                <!--==================================
                        ABOUT PROJECT
                ===================================-->

                <div class="project-about">

                    <div class="section-heading">

                        <span class="section-badge">

                            {{ __('digital_studio.project.overview.badge') }}

                        </span>

                        <h2>

                            {{ __('digital_studio.project.overview.title') }}

                        </h2>

                    </div>

                    <div class="about-content">

                        {!! nl2br(e($project->description)) !!}

                    </div>

                </div>


                <!--==================================
                        SIDEBAR
                ===================================-->

                <aside class="project-sidebar">

                    <!--==============================
                            TECHNOLOGIES
                    ==============================-->

                    <div class="sidebar-card">

                        <h3>

                            <i class="fa-solid fa-code"></i>

                            {{ __('digital_studio.project.technologies.title') }}

                        </h3>

                        <div class="technology-list">

                            @forelse($project->technologies as $technology)

                                <span class="technology-chip">

                                    @if($technology->icon)

                                        <i class="{{ $technology->icon }}"></i>

                                    @endif

                                    {{ $technology->name }}

                                </span>

                            @empty

                                <span class="technology-empty">

                                    {{ __('digital_studio.project.technologies.empty') }}

                                </span>

                            @endforelse

                        </div>

                    </div>


                    <!--==============================
                            PROJECT INFORMATION
                    ==============================-->

                    <div class="sidebar-card">

                        <h3>

                            <i class="fa-solid fa-circle-info"></i>

                            {{ __('digital_studio.project.information.title') }}

                        </h3>

                        <ul class="project-info-list">

                            <li>

                                <span>

                                    {{ __('digital_studio.project.information.category') }}

                                </span>

                                <strong>

                                    {{ $project->category?->name }}

                                </strong>

                            </li>

                            @if($project->client)

                                <li>

                                    <span>

                                        {{ __('digital_studio.project.information.client') }}

                                    </span>

                                    <strong>

                                        {{ $project->client }}

                                    </strong>

                                </li>

                            @endif

                            @if($project->project_date)

                                <li>

                                    <span>

                                        {{ __('digital_studio.project.information.project_date') }}

                                    </span>

                                    <strong>

                                        {{ $project->project_date->format('d M Y') }}

                                    </strong>

                                </li>

                            @endif

                            @if($project->duration)

                                <li>

                                    <span>

                                        {{ __('digital_studio.project.information.duration') }}

                                    </span>

                                    <strong>

                                        {{ $project->duration }}

                                    </strong>

                                </li>

                            @endif

                            <li>

                                <span>

                                    {{ __('digital_studio.project.information.status') }}

                                </span>

                                <strong>

                                    {{ ucfirst($project->status) }}

                                </strong>

                            </li>

                        </ul>

                    </div>


                    <!--==============================
                            QUICK LINKS
                    ==============================-->

                    @if(
                        $project->figma ||
                        $project->live_demo ||
                        $project->github
                    )

                    <div class="sidebar-card">

                        <h3>

                            <i class="fa-solid fa-link"></i>

                            {{ __('digital_studio.project.links.title') }}

                        </h3>

                        <div class="figma-actions">

                            @if($project->figma)

                                <a
                                    href="{{ $project->figma }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="primary-btn">

                                    <i class="fa-brands fa-figma"></i>

                                    {{ __('digital_studio.project.links.figma') }}

                                </a>

                            @endif

                            @if($project->live_demo)

                                <a
                                    href="{{ $project->live_demo }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="secondary-btn">

                                    <i class="fa-solid fa-globe"></i>

                                    {{ __('digital_studio.project.links.live') }}

                                </a>

                            @endif

                            @if($project->github)

                                <a
                                    href="{{ $project->github }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="secondary-btn">

                                    <i class="fa-brands fa-github"></i>

                                    {{ __('digital_studio.project.links.github') }}

                                </a>

                            @endif

                        </div>

                    </div>

                    @endif

                </aside>

            </div>

        </div>

    </section>


    <!--==================================
            PROJECT GALLERY
    ===================================-->

    @if($project->images->count())

    <section class="project-gallery">

        <div class="container">

            <div class="section-heading center">

                <span class="section-badge">

                    {{ __('digital_studio.project.gallery.badge') }}

                </span>

                <h2>

                    {{ __('digital_studio.project.gallery.title') }}

                </h2>

                <p>

                    {{ __('digital_studio.project.gallery.description') }}

                </p>

            </div>

            <div class="gallery-grid">

                @foreach($project->images as $index => $image)

                    <article class="gallery-card">

                        <div class="gallery-image-wrapper">

                            <img
                                src="{{ asset('images/projects/gallery/'.$image->image) }}"
                                alt="{{ $image->alt ?: $image->title ?: $project->title }}"
                                class="gallery-image">

                            <div class="gallery-overlay">

                                <a
                                    href="{{ asset('images/projects/gallery/'.$image->image) }}"
                                    class="project-btn portfolio-lightbox"
                                    data-gallery="figma-gallery"
                                    title="{{ $image->title ?: $project->title }}">

                                    <i class="fa-solid fa-magnifying-glass-plus"></i>

                                </a>

                            </div>

                        </div>

                    </article>

                @endforeach

            </div>

        </div>

    </section>

    @endif


    <!--==================================
            RELATED PROJECTS
    ===================================-->

    @if($relatedProjects->count())

    <section class="related-projects">

        <div class="container">

            <div class="section-heading center">

                <span class="section-badge">

                    {{ __('digital_studio.project.related.badge') }}

                </span>

                <h2>

                    {{ __('digital_studio.project.related.title') }}

                </h2>

                <p>

                    {{ __('digital_studio.project.related.description') }}

                </p>

            </div>

            <div class="related-grid">

                @foreach($relatedProjects as $related)

                    <article
                        class="related-card"
                        data-url="{{ route('figma.show',$related->slug) }}">

                        <!--==============================
                                IMAGE
                        ==============================-->

                        <div class="related-image">

                            <img
                                src="{{ $related->cover_image_url }}"
                                alt="{{ $related->title }}">

                            <div class="related-overlay">

                                <button
                                    type="button"
                                    class="related-btn related-project-btn"

                                    data-url="{{ route('figma.show',$related->slug) }}">

                                    <i class="fa-solid fa-arrow-right"></i>

                                </button>

                            </div>

                        </div>

                        <!--==============================
                                CONTENT
                        ==============================-->

                        <div class="related-content">

                            <span class="related-category">

                                {{ $related->category?->name }}

                            </span>

                            <h3>

                                {{ $related->title }}

                            </h3>

                            <p>

                                {{ \Illuminate\Support\Str::limit(
                                    $related->short_description,
                                    90
                                ) }}

                            </p>

                            <button
                                type="button"
                                class="view-project related-project-btn"

                                data-url="{{ route('figma.show',$related->slug) }}">

                                {{ __('digital_studio.project.related.view_project') }}

                                <i class="fa-solid fa-arrow-right"></i>

                            </button>

                        </div>

                    </article>

                @endforeach

            </div>

        </div>

    </section>

    @endif


    @include('tech.sections.contact')

    @include('tech.sections.footer')

</div>


@endsection
