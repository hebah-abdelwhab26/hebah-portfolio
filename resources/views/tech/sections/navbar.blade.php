@php


/*
|--------------------------------------------------------------------------
| USER NOTIFICATIONS
|--------------------------------------------------------------------------
*/

$userNotifications = $userNotifications ?? collect();

$userNotificationsCount = $userNotifications->count();

@endphp

<!--=====================================================
    NAVBAR
=====================================================-->

<div class="navbar-wrapper">

<nav class="navbar-glass">

<!--=================================================
    LOGO
=================================================-->

<a
    href="{{ route('portal') }}"
    class="navbar-logo"
>

    <div class="logo-box">

        <img
            src="{{ asset('images/tech/hebah web.jpg') }}"
            alt="Hebah Abdelwahab"
        >

    </div>

    <div class="logo-text">

        <span class="logo-name">
            Hebah web
        </span>

        <span class="logo-subtitle">
            {{ __('digital_studio.navbar.logo_subtitle') }}
        </span>

    </div>

</a>



<!--=================================================
    DESKTOP NAVIGATION
=================================================-->

<ul class="navbar-menu">


    <!-- HOME -->

    <li>

        <a
            href="{{ route('tech.index') }}#home"
            class="nav-link active"
        >

            {{ __('digital_studio.navbar.home') }}

        </a>

    </li>



    <!-- ABOUT -->

    <li>

        <a
            href="{{ route('tech.index') }}#about"
            class="nav-link"
        >

            {{ __('digital_studio.navbar.about') }}

        </a>

    </li>



    <!-- PORTFOLIO -->

    <li>

        <a
            href="{{ route('tech.index') }}#portfolio"
            class="nav-link"
        >

            {{ __('digital_studio.navbar.portfolio') }}

        </a>

    </li>



    <!-- COMMENTS -->

    <li>

        <a
            href="{{ route('comments.create') }}"
            class="nav-link"
        >

            {{ __('digital_studio.navbar.comments') }}

        </a>

    </li>



    <!--=================================================
        MORE DROPDOWN
    =================================================-->

    <li class="navbar-more">

        <button
            type="button"
            class="nav-link navbar-more-toggle"
            aria-expanded="false"
        >

            <span>
                {{ __('digital_studio.navbar.more') }}
            </span>

            <i class="fa-solid fa-chevron-down"></i>

        </button>


        <div class="navbar-more-menu">


            <!-- TECHNOLOGIES -->

            <a
                href="{{ route('tech.index') }}#technologies"
            >

                <i class="fa-solid fa-microchip"></i>

                <span>
                    {{ __('digital_studio.navbar.technologies') }}
                </span>

            </a>



            <!-- PROCESS -->

            <a
                href="{{ route('tech.index') }}#process"
            >

                <i class="fa-solid fa-diagram-project"></i>

                <span>
                    {{ __('digital_studio.navbar.process') }}
                </span>

            </a>



            <!-- TESTIMONIALS -->

            <a
                href="{{ route('tech.index') }}#testimonials"
            >

                <i class="fa-solid fa-star"></i>

                <span>
                    {{ __('digital_studio.navbar.testimonials') }}
                </span>

            </a>


        </div>

    </li>



    <!-- CONTACT -->

    <li>

        <a
            href="{{ route('tech.index') }}#contact"
            class="nav-link"
        >

            {{ __('digital_studio.navbar.contact') }}

        </a>

    </li>


</ul>



<!--=================================================
    RIGHT SIDE
=================================================-->

<div class="navbar-actions">


    <!--=================================================
        LANGUAGE
    =================================================-->

    <div class="language-dropdown">


        <!-- LANGUAGE BUTTON -->

        <button
            class="language-btn"
            id="languageToggle"
            type="button"
            aria-expanded="false"
            aria-haspopup="true"
        >

            <i
                class="fa-solid fa-globe"
                aria-hidden="true"
            ></i>

            <span>

                {{ app()->getLocale() === 'ar'
                    ? __('digital_studio.navbar.language.arabic')
                    : __('digital_studio.navbar.language.english')
                }}

            </span>

            <i
                class="fa-solid fa-chevron-down"
                aria-hidden="true"
            ></i>

        </button>



        <!-- LANGUAGE MENU -->

        <div
            class="language-menu"
            id="languageMenu"
            role="menu"
        >


            <!-- ENGLISH -->

            <a
                href="?lang=en"
                class="{{ app()->getLocale() === 'en' ? 'active' : '' }}"
                role="menuitem"
                hreflang="en"
                lang="en"
            >

                <i
                    class="fa-solid fa-language"
                    aria-hidden="true"
                ></i>

                <span>

                    {{ __('digital_studio.navbar.language.english') }}

                </span>


                @if(app()->getLocale() === 'en')

                    <i
                        class="fa-solid fa-check"
                        aria-hidden="true"
                    ></i>

                @endif

            </a>



            <!-- ARABIC -->

            <a
                href="?lang=ar"
                class="{{ app()->getLocale() === 'ar' ? 'active' : '' }}"
                role="menuitem"
                hreflang="ar"
                lang="ar"
            >

                <i
                    class="fa-solid fa-language"
                    aria-hidden="true"
                ></i>

                <span>

                    {{ __('digital_studio.navbar.language.arabic') }}

                </span>


                @if(app()->getLocale() === 'ar')

                    <i
                        class="fa-solid fa-check"
                        aria-hidden="true"
                    ></i>

                @endif

            </a>


        </div>

    </div>



    <!--=================================================
        USER NOTIFICATIONS
    =================================================-->

    @auth

        <div class="user-notifications">


            <!--=========================================
                NOTIFICATION BUTTON
            =========================================-->

            <button
                type="button"
                class="user-notifications-btn"
                id="userNotificationsToggle"
                aria-label="{{ __('digital_studio.navbar.notifications.label') }}"
                aria-expanded="false"
                title="{{ __('digital_studio.navbar.notifications.title') }}"
            >

                <i class="fa-regular fa-bell"></i>


                <!-- COUNT -->

                <span
                    class="user-notifications-count {{ $userNotificationsCount > 0 ? '' : 'd-none' }}"
                    id="userNotificationsCount"
                >

                    {{ $userNotificationsCount }}

                </span>


            </button>



            <!--=========================================
                NOTIFICATION DROPDOWN
            =========================================-->

            <div
                class="user-notifications-menu"
                id="userNotificationsMenu"
            >


                <!--=====================================
                    HEADER
                =====================================-->

                <div class="user-notifications-header">


                    <div>

                        <strong>
                            {{ __('digital_studio.navbar.notifications.heading') }}
                        </strong>

                        <span>
                            {{ __('digital_studio.navbar.notifications.latest_activity') }}
                        </span>

                    </div>


                    <span
                        class="user-notifications-total"
                        id="userNotificationsTotal"
                    >

                        {{ $userNotificationsCount }}

                    </span>


                </div>



                <!--=====================================
                    BODY
                =====================================-->

                <div
                    class="user-notifications-body"
                    id="userNotificationsBody"
                >


                    @if($userNotificationsCount > 0)


                        @foreach($userNotifications as $notification)

                            <a
                                href="{{ $notification->data['url'] ?? '#' }}"
                                class="user-notification-item"
                            >


                                <!-- ICON -->

                                <div class="user-notification-icon">

                                    <i
                                        class="fa-solid {{ $notification->data['icon'] ?? 'fa-bell' }}"
                                    ></i>

                                </div>



                                <!-- CONTENT -->

                                <div class="user-notification-content">


                                    <strong>

                                        {{ $notification->data['title'] ?? __('digital_studio.navbar.notifications.default_title') }}

                                    </strong>


                                    <span>

                                        {{ $notification->data['message'] ?? '' }}

                                    </span>


                                    @if(isset($notification->created_at))

                                        <small>

                                            {{ $notification->created_at->diffForHumans() }}

                                        </small>

                                    @endif


                                </div>



                                <!-- ARROW -->

                                <i
                                    class="fa-solid fa-chevron-right user-notification-arrow"
                                ></i>


                            </a>

                        @endforeach


                    @else


                        <!--=================================
                            EMPTY STATE
                        =================================-->

                        <div class="user-notifications-empty">


                            <div class="user-notifications-empty-icon">

                                <i class="fa-regular fa-bell-slash"></i>

                            </div>


                            <strong>
                                {{ __('digital_studio.navbar.notifications.empty_title') }}
                            </strong>


                            <span>
                                {{ __('digital_studio.navbar.notifications.empty_description') }}
                            </span>


                        </div>


                    @endif


                </div>



                <!--=====================================
                    FOOTER
                =====================================-->

                <div class="user-notifications-footer">

                    <a
                        href="{{ route('comments.create') }}"
                    >

                        {{ __('digital_studio.navbar.notifications.view_all_activity') }}

                        <i class="fa-solid fa-arrow-right"></i>

                    </a>

                </div>


            </div>


        </div>

    @endauth



    <!--=================================================
        USER MESSAGES
    =================================================-->

    @auth

        <div class="user-messages">

            <a
                href="{{ route('conversations.index') }}"
                class="user-messages-btn"
                aria-label="{{ __('digital_studio.navbar.messages.label') }}"
                title="{{ __('digital_studio.navbar.messages.title') }}"
            >

                <i class="fa-regular fa-envelope"></i>

                @if(isset($unreadMessagesCount) && $unreadMessagesCount > 0)

                    <span class="user-messages-count">

                        {{ $unreadMessagesCount }}

                    </span>

                @endif

            </a>

        </div>

    @endauth



    <!--=================================================
        AUTH
    =================================================-->

    @guest


        <!-- LOGIN -->

        <a
            href="{{ route('login') }}"
            class="navbar-login"
        >

            {{ __('digital_studio.navbar.login') }}

        </a>



        <!-- REGISTER -->

        <a
            href="{{ route('register') }}"
            class="navbar-register"
        >

            {{ __('digital_studio.navbar.register') }}

        </a>


    @endguest



    <!--=================================================
        AUTHENTICATED USER
    =================================================-->

    @auth


        <div class="navbar-user">


            <!--=========================================
                USER BUTTON
            =========================================-->

            <button
                class="user-btn"
                id="userToggle"
                type="button"
                title="{{ auth()->user()->name }}"
                aria-expanded="false"
            >


                <div class="user-avatar">

                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                </div>


                <i class="fa-solid fa-chevron-down"></i>


            </button>



            <!--=========================================
                USER MENU
            =========================================-->

            <div
                class="user-menu"
                id="userMenu"
            >


                <!-- PROFILE -->

                <a
                    href="{{ route('profile.edit') }}"
                >

                    <i class="fa-solid fa-user"></i>

                    <span>
                        {{ __('digital_studio.navbar.profile') }}
                    </span>

                </a>



                <!-- DASHBOARD -->

                @if(auth()->user()->role === 'admin')

                    <a
                        href="{{ route('admin.dashboard') }}"
                    >

                        <i class="fa-solid fa-gauge-high"></i>

                        <span>
                            {{ __('digital_studio.navbar.dashboard') }}
                        </span>

                    </a>

                @endif



                <!-- DIVIDER -->

                <div class="user-menu-divider"></div>



                <!-- LOGOUT -->

                <form
                    method="POST"
                    action="{{ route('logout') }}"
                >

                    @csrf

                    <button
                        type="submit"
                    >

                        <i class="fa-solid fa-right-from-bracket"></i>

                        <span>
                            {{ __('digital_studio.navbar.logout') }}
                        </span>

                    </button>

                </form>


            </div>


        </div>


    @endauth



    <!--=================================================
        MOBILE TOGGLE
    =================================================-->

    <button
        class="navbar-toggle"
        id="navbarToggle"
        type="button"
        aria-label="{{ __('digital_studio.navbar.mobile.toggle_menu') }}"
        aria-expanded="false"
    >

        <span></span>
        <span></span>
        <span></span>

    </button>


</div>

</nav>

<!--=====================================================
    MOBILE MENU
=====================================================-->

<div
    class="mobile-menu"
    id="mobileMenu"
>

<!--=================================================
    HOME
=================================================-->

<a
    href="{{ route('tech.index') }}#home"
    class="mobile-link"
>

    <i class="fa-solid fa-house"></i>

    <span>
        {{ __('digital_studio.navbar.home') }}
    </span>

</a>



<!--=================================================
    ABOUT
=================================================-->

<a
    href="{{ route('tech.index') }}#about"
    class="mobile-link"
>

    <i class="fa-solid fa-user"></i>

    <span>
        {{ __('digital_studio.navbar.about') }}
    </span>

</a>



<!--=================================================
    PORTFOLIO
=================================================-->

<a
    href="{{ route('tech.index') }}#portfolio"
    class="mobile-link"
>

    <i class="fa-solid fa-briefcase"></i>

    <span>
        {{ __('digital_studio.navbar.portfolio') }}
    </span>

</a>



<!--=================================================
    COMMENTS
=================================================-->

<a
    href="{{ route('comments.create') }}"
    class="mobile-link"
>

    <i class="fa-solid fa-comments"></i>

    <span>
        {{ __('digital_studio.navbar.comments') }}
    </span>

</a>



<!--=================================================
    MORE
=================================================-->

<div class="mobile-more">


    <!-- MORE BUTTON -->

    <button
        type="button"
        class="mobile-link mobile-more-toggle"
        aria-expanded="false"
    >

        <i class="fa-solid fa-ellipsis"></i>

        <span>
            {{ __('digital_studio.navbar.more') }}
        </span>

        <i class="fa-solid fa-chevron-down mobile-more-arrow"></i>

    </button>



    <!-- MORE SUB MENU -->

    <div class="mobile-more-menu">


        <!-- TECHNOLOGIES -->

        <a
            href="{{ route('tech.index') }}#technologies"
            class="mobile-link"
        >

            <i class="fa-solid fa-microchip"></i>

            <span>
                {{ __('digital_studio.navbar.technologies') }}
            </span>

        </a>



        <!-- PROCESS -->

        <a
            href="{{ route('tech.index') }}#process"
            class="mobile-link"
        >

            <i class="fa-solid fa-diagram-project"></i>

            <span>
                {{ __('digital_studio.navbar.process') }}
            </span>

        </a>



        <!-- TESTIMONIALS -->

        <a
            href="{{ route('tech.index') }}#testimonials"
            class="mobile-link"
        >

            <i class="fa-solid fa-star"></i>

            <span>
                {{ __('digital_studio.navbar.testimonials') }}
            </span>

        </a>


    </div>


</div>



<!--=================================================
    CONTACT
=================================================-->

<a
    href="{{ route('tech.index') }}#contact"
    class="mobile-link"
>

    <i class="fa-solid fa-envelope"></i>

    <span>
        {{ __('digital_studio.navbar.contact') }}
    </span>

</a>



<!-- DIVIDER -->

<div class="mobile-divider"></div>



<!--=================================================
    MOBILE NOTIFICATIONS
=================================================-->

@auth

    <button
        type="button"
        class="mobile-link mobile-notifications-toggle"
        id="mobileNotificationsToggle"
        aria-expanded="false"
    >

        <i class="fa-regular fa-bell"></i>

        <span>
            {{ __('digital_studio.navbar.notifications.heading') }}
        </span>


        @if($userNotificationsCount > 0)

            <span class="mobile-notifications-badge">

                {{ $userNotificationsCount }}

            </span>

        @endif


    </button>

@endauth



<!--=================================================
    GUEST AUTH
=================================================-->

@guest


    <!-- LOGIN -->

    <a
        href="{{ route('login') }}"
        class="mobile-link"
    >

        <i class="fa-solid fa-right-to-bracket"></i>

        <span>
            {{ __('digital_studio.navbar.login') }}
        </span>

    </a>



    <!-- REGISTER -->

    <a
        href="{{ route('register') }}"
        class="mobile-link"
    >

        <i class="fa-solid fa-user-plus"></i>

        <span>
            {{ __('digital_studio.navbar.register') }}
        </span>

    </a>


@endguest



<!--=================================================
    AUTH USER
=================================================-->

@auth


    <!-- DASHBOARD -->

    @if(auth()->user()->role === 'admin')

        <a
            href="{{ route('admin.dashboard') }}"
            class="mobile-link"
        >

            <i class="fa-solid fa-gauge-high"></i>

            <span>
                {{ __('digital_studio.navbar.dashboard') }}
            </span>

        </a>

    @endif



    <!-- PROFILE -->

    <a
        href="{{ route('profile.edit') }}"
        class="mobile-link"
    >

        <i class="fa-solid fa-user"></i>

        <span>
            {{ __('digital_studio.navbar.profile') }}
        </span>

    </a>



    <!-- LOGOUT -->

    <form
        method="POST"
        action="{{ route('logout') }}"
    >

        @csrf

        <button
            type="submit"
            class="mobile-link mobile-logout"
        >

            <i class="fa-solid fa-right-from-bracket"></i>

            <span>
                {{ __('digital_studio.navbar.logout') }}
            </span>

        </button>

    </form>


@endauth

</div>

</div>

