<div class="admin-card latest-projects-card">

    <div class="projects-header">

        <div>

            <h3>

                {{ __('digital_studio_admin.dashboard.latest_projects.title') }}

            </h3>

            <p>

                {{ __('digital_studio_admin.dashboard.latest_projects.description') }}

            </p>

        </div>


        <a href="{{ route('admin.projects.index') }}"
           class="btn-admin btn-outline">

            <i class="fa-solid fa-folder-open"></i>

            {{ __('digital_studio_admin.dashboard.latest_projects.view_all') }}

        </a>

    </div>


    @if($latestProjects->count())

        <div class="latest-projects-grid">

            @foreach($latestProjects as $project)

                <div class="project-card">


                    {{-- Image --}}
                    <div class="project-image">

                        <img
                            src="{{ $project->thumbnail_url }}"
                            alt="{{ $project->title }}">

                        <div class="project-category">

                            {{ $project->category->name
                                ?? __('digital_studio_admin.dashboard.latest_projects.no_category') }}

                        </div>

                    </div>


                    {{-- Body --}}
                    <div class="project-body">

                        <div class="project-title">

                            {{ $project->title }}

                        </div>

                        <div class="project-description">

                            {{ Str::limit($project->short_description, 100) }}

                        </div>

                    </div>


                    {{-- Footer --}}
                    <div class="project-footer">

                        <div class="project-date">

                            <i class="fa-solid fa-calendar-days"></i>

                            {{
                                optional($project->project_date)->format('M d, Y')
                                ?? $project->created_at->format('M d, Y')
                            }}

                        </div>


                        <div class="project-actions">

                            {{-- View --}}
                            <a href="{{ route('projects.show', $project->slug) }}"
                               target="_blank"
                               class="action-btn view"
                               aria-label="{{ __('digital_studio_admin.dashboard.latest_projects.view_project') }}">

                                <i class="fa-solid fa-eye"></i>

                            </a>


                            {{-- Edit --}}
                            <a href="{{ route('admin.projects.edit', $project) }}"
                               class="action-btn edit"
                               aria-label="{{ __('digital_studio_admin.dashboard.latest_projects.edit_project') }}">

                                <i class="fa-solid fa-pen"></i>

                            </a>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>


    @else

        <div class="projects-empty">

            <i class="fa-solid fa-folder-open"></i>

            <h4>

                {{ __('digital_studio_admin.dashboard.latest_projects.empty_title') }}

            </h4>

            <p>

                {{ __('digital_studio_admin.dashboard.latest_projects.empty_description') }}

            </p>


            <a href="{{ route('admin.projects.create') }}"
               class="btn-admin mt-4">

                <i class="fa-solid fa-folder-plus"></i>

                {{ __('digital_studio_admin.dashboard.latest_projects.create_project') }}

            </a>

        </div>

    @endif

</div>
