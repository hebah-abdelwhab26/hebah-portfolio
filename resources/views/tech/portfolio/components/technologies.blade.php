<section class="project-technologies" style="border-radius: 25px; margin-bottom: 25px;">


<div class="container">

    <!--==================================
            SECTION TITLE
    ==================================-->

    <div class="section-title">

        <span class="section-badge">

            {{ __('digital_studio.project_technologies.badge') }}

        </span>

        <h2>

            {{ __('digital_studio.project_technologies.title') }}

            <span>
                {{ __('digital_studio.project_technologies.title_highlight') }}
            </span>

        </h2>

        <p>

            {{ __('digital_studio.project_technologies.description') }}

        </p>

    </div>

    <!--==================================
            TECHNOLOGIES
    ==================================-->

    @if($project->technologies->count())

        <div class="tech-list">

            @foreach($project->technologies as $technology)

                <div class="tech-pill">

                    <!--==============================
                            ICON
                    ==============================-->

                    <span
                        class="tech-pill-icon"
                        @if($technology->color)
                            style="background: {{ $technology->color }}"
                        @endif>

                        @if($technology->icon)

                            <i class="{{ $technology->icon }}"></i>

                        @else

                            <i class="fa-solid fa-code"></i>

                        @endif

                    </span>

                    <!--==============================
                            NAME
                    ==============================-->

                    <div class="tech-pill-content">

                        <span class="tech-pill-name">

                            {{ $technology->name }}

                        </span>

                    </div>

                </div>

            @endforeach

        </div>

    @else

        <!--==================================
                EMPTY STATE
        ==================================-->

        <div class="empty-tech">

            <i class="fa-solid fa-code"></i>

            <h3>

                {{ __('digital_studio.project_technologies.empty.title') }}

            </h3>

            <p>

                {{ __('digital_studio.project_technologies.empty.description') }}

            </p>

        </div>

    @endif

</div>


</section>
