<div class="welcome-card">

    <div class="welcome-content">

        {{-- Left --}}
        <div class="welcome-left">

            <div class="welcome-badge">

                <i class="fa-solid fa-sparkles"></i>

                {{ __('digital_studio_admin.welcome_card.admin_dashboard') }}

            </div>

            <h2>

                {{ __('digital_studio_admin.welcome_card.welcome_back') }},

                <span>
                    {{ auth()->user()->name }}
                </span>

                👋

            </h2>

            <p>

                {{ __('digital_studio_admin.welcome_card.description') }}

            </p>

            <div class="welcome-buttons">

                <a href="{{ route('admin.projects.create') }}"
                   class="btn-admin-primary">

                    <i class="fa-solid fa-folder-plus"></i>

                    {{ __('digital_studio_admin.welcome_card.new_project') }}

                </a>

                <a href="{{ route('projects.index') }}"
                   target="_blank"
                   class="btn-admin-secondary">

                    <i class="fa-solid fa-arrow-up-right-from-square"></i>

                    {{ __('digital_studio_admin.welcome_card.view_website') }}

                </a>

            </div>

        </div>


        {{-- Right --}}
        <div class="welcome-right">

            <div class="mini-stat">

                <span>

                    {{ __('digital_studio_admin.welcome_card.projects') }}

                </span>

                <strong>

                    {{ $stats['projects'] }}

                </strong>

            </div>


            <div class="mini-stat">

                <span>

                    {{ __('digital_studio_admin.welcome_card.technologies') }}

                </span>

                <strong>

                    {{ $stats['technologies'] }}

                </strong>

            </div>


            <div class="mini-stat">

                <span>

                    {{ __('digital_studio_admin.welcome_card.categories') }}

                </span>

                <strong>

                    {{ $stats['categories'] }}

                </strong>

            </div>


            <div class="mini-stat">

                <span>

                    {{ __('digital_studio_admin.welcome_card.featured') }}

                </span>

                <strong>

                    {{ $stats['featured'] }}

                </strong>

            </div>

        </div>

    </div>

</div>
