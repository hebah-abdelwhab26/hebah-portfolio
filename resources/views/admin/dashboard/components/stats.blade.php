<div class="stats-grid">


    {{-- Projects --}}
    <div class="stat-card">

        <div class="stat-content">

            <div class="stat-title">

                {{ __('digital_studio_admin.dashboard.stats.total_projects') }}

            </div>

            <div class="stat-number">

                {{ number_format($stats['projects']) }}

            </div>

            <div class="stat-change positive">

                <i class="fa-solid fa-arrow-trend-up"></i>

                {{ __('digital_studio_admin.dashboard.stats.portfolio_projects') }}

            </div>

        </div>

        <div class="stat-icon blue">

            <i class="fa-solid fa-folder-open"></i>

        </div>

    </div>



    {{-- Featured --}}
    <div class="stat-card">

        <div class="stat-content">

            <div class="stat-title">

                {{ __('digital_studio_admin.dashboard.stats.featured_projects') }}

            </div>

            <div class="stat-number">

                {{ number_format($stats['featured']) }}

            </div>

            <div class="stat-change positive">

                <i class="fa-solid fa-star"></i>

                {{ __('digital_studio_admin.dashboard.stats.highlighted') }}

            </div>

        </div>

        <div class="stat-icon orange">

            <i class="fa-solid fa-star"></i>

        </div>

    </div>



    {{-- Technologies --}}
    <div class="stat-card">

        <div class="stat-content">

            <div class="stat-title">

                {{ __('digital_studio_admin.dashboard.stats.technologies') }}

            </div>

            <div class="stat-number">

                {{ number_format($stats['technologies']) }}

            </div>

            <div class="stat-change positive">

                <i class="fa-solid fa-microchip"></i>

                {{ __('digital_studio_admin.dashboard.stats.tech_stack') }}

            </div>

        </div>

        <div class="stat-icon green">

            <i class="fa-solid fa-microchip"></i>

        </div>

    </div>



    {{-- Categories --}}
    <div class="stat-card">

        <div class="stat-content">

            <div class="stat-title">

                {{ __('digital_studio_admin.dashboard.stats.categories') }}

            </div>

            <div class="stat-number">

                {{ number_format($stats['categories']) }}

            </div>

            <div class="stat-change positive">

                <i class="fa-solid fa-layer-group"></i>

                {{ __('digital_studio_admin.dashboard.stats.project_groups') }}

            </div>

        </div>

        <div class="stat-icon red">

            <i class="fa-solid fa-layer-group"></i>

        </div>

    </div>


</div>
