<section class="project-hero">

    <div class="container">

        <div class="project-hero-wrapper">

            <!--==================================
                    LEFT CONTENT
            ==================================-->

            <div class="project-hero-content">

                @if($project->category)

                    <span class="project-badge">

                        <i class="fa-solid fa-folder-open"></i>

                        {{ $project->category->name }}

                    </span>

                @endif

                <h1>

                    {{ $project->title }}

                </h1>

                @if($project->subtitle)

                    <h2>

                        {{ $project->subtitle }}

                    </h2>

                @endif

                @if($project->short_description)

                    <p class="hero-description">

                        {{ $project->short_description }}

                    </p>

                @endif

                <!--==============================
                        QUICK STATS
                ==============================-->

                <div class="hero-stats">

                    <div class="hero-stat">

                        <i class="fa-solid fa-calendar"></i>

                        <div>

                            <small>
                                {{ __('digital_studio.project.hero.date') }}
                            </small>

                            <strong>

                                @if($project->project_date)

                                    {{ \Carbon\Carbon::parse($project->project_date)->format('M Y') }}

                                @else

                                    {{ __('digital_studio.project.hero.not_available') }}

                                @endif

                            </strong>

                        </div>

                    </div>


                    <div class="hero-stat">

                        <i class="fa-solid fa-clock"></i>

                        <div>

                            <small>
                                {{ __('digital_studio.project.hero.duration') }}
                            </small>

                            <strong>

                                {{ $project->duration ?: __('digital_studio.project.hero.not_available') }}

                            </strong>

                        </div>

                    </div>


                    <div class="hero-stat">

                        <i class="fa-solid fa-circle-check"></i>

                        <div>

                            <small>
                                {{ __('digital_studio.project.hero.status') }}
                            </small>

                            <strong>

                                @if($project->status === 'published')

                                    {{ __('digital_studio.project.hero.published') }}

                                @else

                                    {{ __('digital_studio.project.hero.draft') }}

                                @endif

                            </strong>

                        </div>

                    </div>

                </div>


                <!--==============================
                        BUTTONS
                ==============================-->

                <div class="project-buttons">

                    @if(!empty($project->live_demo))

                        <a
                            href="{{ $project->live_demo }}"
                            target="_blank"
                            rel="noopener"
                            class="primary-btn">

                            <i class="fa-solid fa-globe"></i>

                            {{ __('digital_studio.project.hero.live_demo') }}

                        </a>

                    @endif


                    @if(!empty($project->github))

                        <a
                            href="{{ $project->github }}"
                            target="_blank"
                            rel="noopener"
                            class="secondary-btn">

                            <i class="fa-brands fa-github"></i>

                            {{ __('digital_studio.project.hero.github') }}

                        </a>

                    @endif


                    @if(!empty($project->figma))

                        <a
                            href="{{ $project->figma }}"
                            target="_blank"
                            rel="noopener"
                            class="secondary-btn">

                            <i class="fa-brands fa-figma"></i>

                            {{ __('digital_studio.project.hero.figma') }}

                        </a>

                    @endif

                </div>

            </div>


            <!--==================================
                    RIGHT IMAGE
            ==================================-->

            <div class="project-hero-image">

                <div class="hero-image-card">

                    @if(!empty($project->cover_image))

                        <img
                            src="{{ $project->cover_image_url }}"
                            alt="{{ $project->title }}">

                    @elseif(!empty($project->thumbnail))

                        <img
                            src="{{ $project->thumbnail_url }}"
                            alt="{{ $project->title }}">

                    @else

                        <img
                            src="{{ asset('images/project-placeholder.webp') }}"
                            alt="{{ $project->title }}">

                    @endif

                </div>

            </div>

        </div>

    </div>

</section>
