<section class="project-gallery">

    <div class="container">

        <!--==================================
                SECTION TITLE
        ==================================-->

        <div class="section-title">

            <span class="section-badge">
                {{ __('digital_studio.project.gallery.badge') }}
            </span>

            <h2>

                {{ __('digital_studio.project.gallery.title_before') }}

                <span>
                    {{ __('digital_studio.project.gallery.title_highlight') }}
                </span>

            </h2>

        </div>


        @if($project->images->count())

            <div class="gallery-grid">

                @foreach($project->images as $index => $image)

                    <div class="gallery-item gallery-{{ ($index % 6) + 1 }}">

                        <img
                            src="{{ $image->gallery_image_url }}"
                            alt="{{ $image->alt ?: $project->title }}">

                        <div class="project-overlay">

                            <a
                                href="{{ $image->gallery_image_url }}"
                                class="project-btn portfolio-lightbox"
                                data-gallery="project-gallery"
                                title="{{ $image->title ?: $project->title }}">

                                <i class="fa-solid fa-magnifying-glass-plus"></i>

                            </a>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            <div class="gallery-grid">

                <div class="gallery-item gallery-1">

                    @if($project->cover_image)

                        <img
                            src="{{ $project->cover_image_url }}"
                            alt="{{ $project->title }}">

                        <div class="project-overlay">

                            <a
                                href="{{ $project->cover_image_url }}"
                                class="project-btn portfolio-lightbox"
                                data-gallery="project-gallery">

                                <i class="fa-solid fa-magnifying-glass-plus"></i>

                            </a>

                        </div>

                    @elseif($project->thumbnail)

                        <img
                            src="{{ $project->thumbnail_url }}"
                            alt="{{ $project->title }}">

                        <div class="project-overlay">

                            <a
                                href="{{ $project->thumbnail_url }}"
                                class="project-btn portfolio-lightbox"
                                data-gallery="project-gallery">

                                <i class="fa-solid fa-magnifying-glass-plus"></i>

                            </a>

                        </div>

                    @else

                        <img
                            src="{{ asset('images/project-placeholder.webp') }}"
                            alt="{{ $project->title }}">

                    @endif

                </div>

            </div>

        @endif

    </div>

</section>
