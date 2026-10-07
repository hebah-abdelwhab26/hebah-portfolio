<div class="admin-card quick-actions-wrapper">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h5 class="card-title mb-1">

                {{ __('digital_studio_admin.dashboard.quick_actions.title') }}

            </h5>

        </div>

    </div>


    {{-- Primary Action --}}
    <a href="{{ route('admin.projects.create') }}"
       class="primary-action text-decoration-none">

        <div class="primary-icon">

            <i class="fa-solid fa-folder-plus"></i>

        </div>

        <div class="flex-grow-1">

            <h4>

                {{ __('digital_studio_admin.dashboard.quick_actions.create_project') }}

            </h4>

        </div>

        <i class="fa-solid fa-arrow-right-long action-arrow"></i>

    </a>


    {{-- Secondary Actions --}}
    <div class="secondary-actions">

        <a href="{{ route('admin.projects.index') }}"
           class="secondary-card text-decoration-none">

            <i class="fa-solid fa-folder-open"></i>

            <span>

                {{ __('digital_studio_admin.dashboard.quick_actions.projects') }}

            </span>

        </a>


        <a href="{{ route('admin.project-categories.index') }}"
           class="secondary-card text-decoration-none">

            <i class="fa-solid fa-layer-group"></i>

            <span>

                {{ __('digital_studio_admin.dashboard.quick_actions.categories') }}

            </span>

        </a>


        <a href="{{ route('admin.technologies.index') }}"
           class="secondary-card text-decoration-none">

            <i class="fa-solid fa-microchip"></i>

            <span>

                {{ __('digital_studio_admin.dashboard.quick_actions.technologies') }}

            </span>

        </a>


        <a href="{{ route('admin.technology-categories.index') }}"
           class="secondary-card text-decoration-none">

            <i class="fa-solid fa-sitemap"></i>

            <span>

                {{ __('digital_studio_admin.dashboard.quick_actions.tech_categories') }}

            </span>

        </a>

    </div>

</div>
