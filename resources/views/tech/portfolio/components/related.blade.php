<section class="related-projects" style="border-radius: 25px; margin-bottom: 25px;">


<div class="container">

    <!--==================================
            SECTION TITLE
    ==================================-->

    <div class="section-title">

        <span class="section-badge">

            {{ __('digital_studio.related_projects.badge') }}

        </span>

        <h2>

            {{ __('digital_studio.related_projects.title') }}

            <span>
                {{ __('digital_studio.related_projects.title_highlight') }}
            </span>

        </h2>

        <p>

            {{ __('digital_studio.related_projects.description') }}

        </p>

    </div>

    <!--==================================
            PROJECTS GRID
    ==================================-->

    <div class="related-grid">

        @forelse($relatedProjects as $related)

            <article class="related-card">

                <!--==============================
                        IMAGE
                ==============================-->

                <div class="related-image">

                    @if($related->thumbnail)

                        <img
                            src="{{ $related->thumbnail_url }}"
                            alt="{{ $related->title }}">

                    @else

                        <img
                            src="{{ asset('images/project-placeholder.webp') }}"
                            alt="{{ $related->title }}">

                    @endif

                    @if($related->category)

                        <span class="project-category">

                            {{ $related->category->name }}

                        </span>

                    @endif

                </div>

                <!--==============================
                        CONTENT
                ==============================-->

                <div class="related-content">

                    <h3>

                        {{ $related->title }}

                    </h3>

                    <p>

                        {{ \Illuminate\Support\Str::limit($related->short_description,100) }}

                    </p>

                    <!--==============================
                            TECHNOLOGIES
                    ==============================-->

                    @if($related->technologies->count())

                        <div class="project-tags">

                            @foreach($related->technologies->take(3) as $technology)

                                <span>

                                    {{ $technology->name }}

                                </span>

                            @endforeach

                        </div>

                    @endif

                    <!--==============================
                            FOOTER
                    ==============================-->

                    <div class="related-footer">

                        @if($related->project_date)

                            <span>

                                <i class="fa-solid fa-calendar"></i>

                                {{ $related->project_date->format('Y') }}

                            </span>

                        @endif

                        <a
                            href="{{ route('projects.show',$related) }}"
                            class="view-project">

                            {{ __('digital_studio.related_projects.view_project') }}

                            <i class="fa-solid fa-arrow-right-long"></i>

                        </a>

                    </div>

                </div>

            </article>

        @empty

            <!--==============================
                    EMPTY STATE
            ==============================-->

            <div class="empty-state">

                <i class="fa-solid fa-folder-open"></i>

                <h3>

                    {{ __('digital_studio.related_projects.empty.title') }}

                </h3>

                <p>

                    {{ __('digital_studio.related_projects.empty.description') }}

                </p>

            </div>

        @endforelse

    </div>

</div>


</section>
