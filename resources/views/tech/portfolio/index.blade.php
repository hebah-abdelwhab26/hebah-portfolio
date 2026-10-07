@extends('tech.layouts.app')

@section('content')

<div class="digital-page">

{{--==================================
        NAVBAR
==================================--}}
@include('tech.sections.navbar')


{{--==================================
        HERO
==================================--}}

<section class="portfolio-hero">

    <div class="container">

        <div class="portfolio-hero-grid">

            <!--==============================
                    LEFT SIDE
            ==============================-->

            <div class="portfolio-hero-content">

                <span class="section-badge">

                    {{ __('digital_studio.portfolio.hero.badge') }}

                </span>

                <h1>

                    {{ __('digital_studio.portfolio.hero.title') }}

                    <span>
                        {{ __('digital_studio.portfolio.hero.title_highlight') }}
                    </span>

                </h1>

                <p>

                    {{ __('digital_studio.portfolio.hero.description') }}

                </p>

                <div class="hero-buttons">

                    <a
                        href="#portfolio-grid"
                        class="primary-btn">

                        <i class="fa-solid fa-layer-group me-2"></i>

                        {{ __('digital_studio.portfolio.hero.buttons.projects') }}

                    </a>

                    <a
                        href="{{ url('/tech#contact') }}"
                        class="secondary-btn">

                        <i class="fa-solid fa-paper-plane me-2"></i>

                        {{ __('digital_studio.portfolio.hero.buttons.contact') }}

                    </a>

                </div>

            </div>


            <!--==============================
                    RIGHT SIDE
            ==============================-->

            <div class="portfolio-stats">

                <div class="stat-card">

                    <h2>

                        {{ $projects->total() }}

                    </h2>

                    <span>

                        {{ __('digital_studio.portfolio.hero.stats.projects') }}

                    </span>

                </div>

                <div class="stat-card">

                    <h2>

                        {{ \App\Models\Technology::count() }}

                    </h2>

                    <span>

                        {{ __('digital_studio.portfolio.hero.stats.technologies') }}

                    </span>

                </div>

                <div class="stat-card">

                    <h2>

                        {{ \App\Models\ProjectCategory::count() }}

                    </h2>

                    <span>

                        {{ __('digital_studio.portfolio.hero.stats.categories') }}

                    </span>

                </div>

            </div>

        </div>

    </div>

</section>


{{--==================================
        PORTFOLIO
==================================--}}

<section class="portfolio-section">

    <div class="container">

        <!--==============================
                SECTION HEADER
        ==============================-->

        <div class="portfolio-header">

            <span class="section-badge">

                {{ __('digital_studio.portfolio.work.badge') }}

            </span>

            <h2>

                {{ __('digital_studio.portfolio.work.title') }}

                <span>
                    {{ __('digital_studio.portfolio.work.title_highlight') }}
                </span>

            </h2>

            <p>

                {{ __('digital_studio.portfolio.work.description') }}

            </p>

        </div>


        <!--==============================
                PROJECT GRID
        ==============================-->

        <div
            class="portfolio-grid"
            id="portfolio-grid">

            @forelse($projects as $project)

                <article class="project-card">

                    <!--==============================
                            IMAGE
                    ==============================-->

                    <div class="project-image">

                        @if($project->thumbnail)

                            <img
                                src="{{ $project->thumbnail_url }}"
                                alt="{{ $project->title }}">

                        @else

                            <img
                                src="{{ asset('images/no-image.png') }}"
                                alt="{{ $project->title }}">

                        @endif


                        @if($project->category)

                            <span class="project-category">

                                {{ $project->category->name }}

                            </span>

                        @endif


                        <div class="project-overlay">

                            <div class="overlay-buttons">

                                <a
                                    href="{{ route('projects.show',$project) }}"
                                    class="project-btn primary">

                                    <i class="fa-solid fa-eye"></i>


                                </a>


                                @if($project->live_demo)

                                    <a
                                        href="{{ $project->live_demo }}"
                                        target="_blank"
                                        class="project-btn"
                                        title="{{ __('digital_studio.portfolio.work.links.live_demo') }}">

                                        <i class="fa-solid fa-arrow-up-right-from-square"></i>

                                    </a>

                                @endif


                                @if($project->github)

                                    <a
                                        href="{{ $project->github }}"
                                        target="_blank"
                                        class="project-btn"
                                        title="{{ __('digital_studio.portfolio.work.links.github') }}">

                                        <i class="fa-brands fa-github"></i>

                                    </a>

                                @endif


                                @if($project->figma)

                                    <a
                                        href="{{ $project->figma }}"
                                        target="_blank"
                                        class="project-btn"
                                        title="{{ __('digital_studio.portfolio.work.links.figma') }}">

                                        <i class="fa-brands fa-figma"></i>

                                    </a>

                                @endif

                            </div>

                        </div>

                    </div>


                    <!--==============================
                            CONTENT
                    ==============================-->

                    <div class="project-content">

                        <h3>

                            {{ $project->title }}

                        </h3>

                        <p>

                            {{ \Illuminate\Support\Str::limit($project->short_description,140) }}

                        </p>


                        @if($project->technologies->count())

                            <div class="project-tags">

                                @foreach($project->technologies->take(4) as $technology)

                                    <span>

                                        {{ $technology->name }}

                                    </span>

                                @endforeach

                            </div>

                        @endif


                        <div class="project-footer">

                            <a
                                href="{{ route('projects.show',$project) }}"
                                class="view-project">

                                {{ __('digital_studio.portfolio.work.view_details') }}

                                <i class="fa-solid fa-arrow-right-long"></i>

                            </a>

                        </div>

                    </div>

                </article>

            @empty

                <div class="empty-projects">

                    <i class="fa-regular fa-folder-open"></i>

                    <h3>

                        {{ __('digital_studio.portfolio.work.empty.title') }}

                    </h3>

                    <p>

                        {{ __('digital_studio.portfolio.work.empty.description') }}

                    </p>

                </div>

            @endforelse

        </div>

    </div>

</section>


{{--==================================
        PAGINATION
==================================--}}

@if($projects->hasPages())

    <section class="portfolio-pagination">

        <div class="container">

            <div class="pagination-wrapper">

                {{ $projects->onEachSide(1)->links() }}

            </div>

        </div>

    </section>

@endif


{{--==================================
        CALL TO ACTION
==================================--}}

<section class="portfolio-cta">

    <div class="container">

        <div class="cta-card">

            <div class="cta-content">

                <span class="section-badge">

                    {{ __('digital_studio.portfolio.cta.badge') }}

                </span>

                <h2>

                    {{ __('digital_studio.portfolio.cta.title') }}

                    <span>
                        {{ __('digital_studio.portfolio.cta.title_highlight') }}
                    </span>

                </h2>

                <p>

                    {{ __('digital_studio.portfolio.cta.description') }}

                </p>

            </div>


            <div class="cta-buttons">

                <a
                    href="{{ url('/tech#contact') }}"
                    class="primary-btn">

                    <i class="fa-solid fa-paper-plane me-2"></i>

                    {{ __('digital_studio.portfolio.cta.buttons.start_project') }}

                </a>

                <a
                    href="{{ route('tech.index') }}"
                    class="secondary-btn">

                    <i class="fa-solid fa-house me-2"></i>

                    {{ __('digital_studio.portfolio.cta.buttons.back_home') }}

                </a>

            </div>

        </div>

    </div>

</section>


{{--==================================
        CONTACT
==================================--}}

@include('tech.sections.contact')


{{--==================================
        FOOTER
==================================--}}

@include('tech.sections.footer')


</div>

@endsection
