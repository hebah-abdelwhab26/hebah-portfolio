<section class="project-links" style="border-radius: 25px; margin-bottom: 25px;">

<div class="container">

    <!--==================================
            SECTION TITLE
    ==================================-->

    <div class="section-title">

        <span class="section-badge">

            {{ __('digital_studio.project_links.badge') }}

        </span>

        <h2>

            {{ __('digital_studio.project_links.title') }}

            <span>
                {{ __('digital_studio.project_links.title_highlight') }}
            </span>

        </h2>

        <p>

            {{ __('digital_studio.project_links.description') }}

        </p>

    </div>

    @if(
        $project->live_demo ||
        $project->github ||
        $project->figma
    )

        <div class="links-grid">

            <!--==================================
                    LIVE DEMO
            ==================================-->

            @if($project->live_demo)

                <a
                    href="{{ $project->live_demo }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="link-card">

                    <div class="link-icon">

                        <i class="fa-solid fa-globe"></i>

                    </div>

                    <h3>

                        {{ __('digital_studio.project_links.live_demo.title') }}

                    </h3>

                    <p>

                        {{ __('digital_studio.project_links.live_demo.description') }}

                    </p>

                    <span class="link-action">

                        {{ __('digital_studio.project_links.live_demo.action') }}

                        <i class="fa-solid fa-arrow-up-right-from-square"></i>

                    </span>

                </a>

            @endif


            <!--==================================
                    GITHUB
            ==================================-->

            @if($project->github)

                <a
                    href="{{ $project->github }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="link-card">

                    <div class="link-icon">

                        <i class="fa-brands fa-github"></i>

                    </div>

                    <h3>

                        {{ __('digital_studio.project_links.github.title') }}

                    </h3>

                    <p>

                        {{ __('digital_studio.project_links.github.description') }}

                    </p>

                    <span class="link-action">

                        {{ __('digital_studio.project_links.github.action') }}

                        <i class="fa-solid fa-arrow-up-right-from-square"></i>

                    </span>

                </a>

            @endif


            <!--==================================
                    FIGMA
            ==================================-->

            @if($project->figma)

                <a
                    href="{{ $project->figma }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="link-card">

                    <div class="link-icon">

                        <i class="fa-brands fa-figma"></i>

                    </div>

                    <h3>

                        {{ __('digital_studio.project_links.figma.title') }}

                    </h3>

                    <p>

                        {{ __('digital_studio.project_links.figma.description') }}

                    </p>

                    <span class="link-action">

                        {{ __('digital_studio.project_links.figma.action') }}

                        <i class="fa-solid fa-arrow-up-right-from-square"></i>

                    </span>

                </a>

            @endif

        </div>

    @else

        <!--==================================
                EMPTY STATE
        ==================================-->

        <div class="empty-state">

            <i class="fa-solid fa-link"></i>

            <h3>

                {{ __('digital_studio.project_links.empty.title') }}

            </h3>

            <p>

                {{ __('digital_studio.project_links.empty.description') }}

            </p>

        </div>

    @endif

</div>


</section>
