<aside class="sidebar">

    <!--==================================
                SIDEBAR HEADER
    ==================================-->

    <div class="sidebar-header">

        <a
            href="{{ route('admin.dashboard') }}"
            class="sidebar-brand"
        >

            <div class="brand-content m-3">

                <h3>

                    {{ __('digital_studio_admin.sidebar.brand.name') }}

                </h3>

                <span>

                    {{ __('digital_studio_admin.sidebar.brand.admin_panel') }}

                </span>

            </div>

        </a>

    </div>


    <!--==================================
                USER CARD
    ==================================-->

    <div class="sidebar-user">

        <div
            class="sidebar-avatar rounded-circle overflow-hidden m-2"
            style="width: 50px; height: 50px;"
        >

            @if(auth()->user()->avatar)

                <img
                    src="{{ auth()->user()->avatar_url }}"
                    alt="{{ auth()->user()->name }}"
                    class="w-100 h-100"
                    style="object-fit: cover;"
                >

            @else

                <span class="d-flex w-100 h-100 align-items-center justify-content-center">

                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                </span>

            @endif

        </div>

        <div class="sidebar-user-info">

            <strong>

                {{ auth()->user()->name }}

            </strong>

            <small>

                {{ ucfirst(auth()->user()->role) }}

            </small>

        </div>

    </div>


    <!--==================================
                NAVIGATION
    ==================================-->

    <nav class="sidebar-menu">


        <!--==================================
                    MAIN MENU
        ==================================-->

        <span class="sidebar-title">

            {{ __('digital_studio_admin.sidebar.main_menu') }}

        </span>


        <!-- Dashboard -->

        <a
            href="{{ route('admin.dashboard') }}"
            class="sidebar-link
                {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
        >

            <i class="fa-solid fa-house"></i>

            <span>

                {{ __('digital_studio_admin.sidebar.dashboard') }}

            </span>

        </a>


        <!--==================================
                    CONTENT
        ==================================-->

        <span class="sidebar-title">

            {{ __('digital_studio_admin.sidebar.content') }}

        </span>


        <!-- Projects -->

        <a
            href="{{ route('admin.projects.index') }}"
            class="sidebar-link
                {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}"
        >

            <i class="fa-solid fa-folder-open"></i>

            <span>

                {{ __('digital_studio_admin.sidebar.projects') }}

            </span>

        </a>


        <!-- Project Categories -->

        <a
            href="{{ route('admin.project-categories.index') }}"
            class="sidebar-link
                {{ request()->routeIs('admin.project-categories.*') ? 'active' : '' }}"
        >

            <i class="fa-solid fa-layer-group"></i>

            <span>

                {{ __('digital_studio_admin.sidebar.project_categories') }}

            </span>

        </a>


        <!-- Technologies -->

        <a
            href="{{ route('admin.technologies.index') }}"
            class="sidebar-link
                {{ request()->routeIs('admin.technologies.*') ? 'active' : '' }}"
        >

            <i class="fa-solid fa-microchip"></i>

            <span>

                {{ __('digital_studio_admin.sidebar.technologies') }}

            </span>

        </a>


        <!-- Technology Categories -->

        <a
            href="{{ route('admin.technology-categories.index') }}"
            class="sidebar-link
                {{ request()->routeIs('admin.technology-categories.*') ? 'active' : '' }}"
        >

            <i class="fa-solid fa-sitemap"></i>

            <span>

                {{ __('digital_studio_admin.sidebar.technology_categories') }}

            </span>

        </a>


        <!-- News & Announcements -->

        <a
            href="{{ route('admin.news.index') }}"
            class="sidebar-link
                {{ request()->routeIs('admin.news.*') ? 'active' : '' }}"
        >

            <i class="fa-solid fa-newspaper"></i>

            <span>

                {{ __('digital_studio_admin.sidebar.news') }}

            </span>

        </a>


        <!--==================================
                COMMUNICATION
        ==================================-->

        <span class="sidebar-title">

            {{ __('digital_studio_admin.sidebar.communication') }}

        </span>


        <!-- Comments -->

        <a
            href="{{ route('admin.comments.index') }}"
            class="sidebar-link
                {{ request()->routeIs('admin.comments.*') ? 'active' : '' }}"
        >

            <i class="fa-regular fa-comments"></i>

            <span>

                {{ __('digital_studio_admin.sidebar.comments') }}

            </span>

            @if(isset($pendingComments) && $pendingComments > 0)

                <span class="sidebar-count">

                    {{ $pendingComments }}

                </span>

            @endif

        </a>


        <!-- Messages -->

        <a
            href="{{ route('admin.conversations.index') }}"
            class="sidebar-link
                {{ request()->routeIs('admin.conversations.*') ? 'active' : '' }}"
        >

            <i class="fa-solid fa-envelope"></i>

            <span>

                {{ __('digital_studio_admin.sidebar.messages') }}

            </span>

            @if(isset($newMessages) && $newMessages > 0)

                <span class="sidebar-count">

                    {{ $newMessages }}

                </span>

            @endif

        </a>


        <!--==================================
                    MANAGEMENT
        ==================================-->

        <span class="sidebar-title">

            {{ __('digital_studio_admin.sidebar.management') }}

        </span>


        <!-- Users -->

        <a
            href="{{ route('admin.users.index') }}"
            class="sidebar-link
                {{ request()->routeIs('admin.users.*') ? 'active' : '' }}"
        >

            <i class="fa-solid fa-users"></i>

            <span>

                {{ __('digital_studio_admin.sidebar.users') }}

            </span>

            @if(isset($newUsers) && $newUsers > 0)

                <span class="sidebar-count">

                    {{ $newUsers }}

                </span>

            @endif

        </a>


    </nav>


    <!--==================================
                SIDEBAR FOOTER
    ==================================-->

    <div class="sidebar-footer">

        <form
            method="POST"
            action="{{ route('logout') }}"
        >

            @csrf

            <button
                type="submit"
                class="sidebar-logout"
            >

                <i class="fa-solid fa-right-from-bracket"></i>

                <span>

                    {{ __('digital_studio_admin.sidebar.logout') }}

                </span>

            </button>

        </form>

    </div>

</aside>
