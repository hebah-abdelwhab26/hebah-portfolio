<section class="project-overview">

    <div class="container">

        <div class="overview-wrapper">

            <!--==================================
                    PROJECT DESCRIPTION
            ==================================-->

            <div class="overview-card">

                <span class="section-badge">
                    {{ __('digital_studio.project.overview.badge') }}
                </span>

                <h2>
                    {{ __('digital_studio.project.overview.title_before') }}

                    <span>
                        {{ __('digital_studio.project.overview.title_highlight') }}
                    </span>
                </h2>

                @if($project->description)

                    <div class="overview-text">

                        {!! nl2br(e($project->description)) !!}

                    </div>

                @else

                    <div class="overview-text">

                        <p>
                            {{ __('digital_studio.project.overview.no_description') }}
                        </p>

                    </div>

                @endif

            </div>


            <!--==================================
                    DETAILS CARD
            ==================================-->

            <div class="details-card">

                <div class="details-header">

                    <div class="details-icon">

                        <i class="fa-solid fa-folder-open"></i>

                    </div>

                    <div>

                        <h3>
                            {{ __('digital_studio.project.information.title') }}
                        </h3>

                        <p>
                            {{ __('digital_studio.project.information.general') }}
                        </p>

                    </div>

                </div>


                <div class="details-list">

                    {{-- Category --}}
                    <div class="detail-item">

                        <span>

                            <i class="fa-solid fa-folder-tree"></i>

                            {{ __('digital_studio.project.information.category') }}

                        </span>

                        <strong>

                            {{ $project->category?->name ?? __('digital_studio.project.information.general_category') }}

                        </strong>

                    </div>


                    {{-- Client --}}
                    <div class="detail-item">

                        <span>

                            <i class="fa-solid fa-user"></i>

                            {{ __('digital_studio.project.information.client') }}

                        </span>

                        <strong>

                            {{ $project->client ?: __('digital_studio.project.information.personal_project') }}

                        </strong>

                    </div>


                    {{-- Date --}}
                    <div class="detail-item">

                        <span>

                            <i class="fa-solid fa-calendar"></i>

                            {{ __('digital_studio.project.information.project_date') }}

                        </span>

                        <strong>

                            {{ $project->project_date
                                ? $project->project_date->format('F Y')
                                : __('digital_studio.project.information.not_available')
                            }}

                        </strong>

                    </div>


                    {{-- Duration --}}
                    <div class="detail-item">

                        <span>

                            <i class="fa-regular fa-clock"></i>

                            {{ __('digital_studio.project.information.duration') }}

                        </span>

                        <strong>

                            {{ $project->duration ?: __('digital_studio.project.information.not_available') }}

                        </strong>

                    </div>


                    {{-- Status --}}
                    <div class="detail-item">

                        <span>

                            <i class="fa-solid fa-circle-check"></i>

                            {{ __('digital_studio.project.information.status') }}

                        </span>

                        <strong class="status-badge">

                            {{ ucfirst($project->status) }}

                        </strong>

                    </div>


                    {{-- Featured --}}
                    <div class="detail-item">

                        <span>

                            <i class="fa-solid fa-star"></i>

                            {{ __('digital_studio.project.information.featured') }}

                        </span>

                        <strong>

                            {{ $project->featured
                                ? __('digital_studio.project.information.yes')
                                : __('digital_studio.project.information.no')
                            }}

                        </strong>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>
