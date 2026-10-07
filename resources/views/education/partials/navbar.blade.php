
<!--==================================================
    EDUCATION NAVBAR
==================================================-->

<header class="education-navbar-wrapper">

<nav class="education-navbar">

    <div class="education-navbar-container">


        <!--==================================================
            LOGO
        ==================================================-->

        <a
            href="{{ route('education.index') }}#home"
            class="education-navbar-logo"
        >

            <div class="education-logo-mark">

                <i class="fa-solid fa-book-quran"></i>

            </div>

            <div class="education-logo-content">

                <span class="education-logo-name">
                    {{ __('education.brand.name') }}
                </span>

                <span class="education-logo-subtitle">
                    {{ __('education.brand.quran_arabic') }}
                </span>

            </div>

        </a>



        <!--==================================================
            DESKTOP NAVIGATION
        ==================================================-->

        <ul class="education-navbar-menu">


            <!-- HOME -->

            <li>

                <a
                    href="{{ route('education.index') }}#home"
                    class="education-nav-link
                        {{ request()->routeIs('education.index') && !request()->get('section') ? 'active' : '' }}"
                >
                    {{ __('education.navbar.home') }}
                </a>

            </li>



            <!-- ABOUT -->

            <li>

                <a
                    href="{{ route('education.index') }}#about"
                    class="education-nav-link"
                >
                    {{ __('education.navbar.about') }}
                </a>

            </li>



            <!-- LESSONS -->

            <li>

                <a
                    href="{{ route('education.index') }}#services"
                    class="education-nav-link"
                >
                    {{ __('education.navbar.lessons') }}
                </a>

            </li>



            <!-- RESOURCES -->

            <li>

                <a
                    href="{{ route('education.index') }}#resources"
                    class="education-nav-link"
                >
                    {{ __('education.navbar.resources') }}
                </a>

            </li>



            <!-- COMMENTS -->

            @if(Route::has('education.comments.index'))

                <li>

                    <a
                        href="{{ route('education.comments.index') }}"
                        class="education-nav-link
                            {{ request()->routeIs('education.comments.*') ? 'active' : '' }}"
                    >
                        {{ __('education.navbar.comments') }}
                    </a>

                </li>

            @endif



            <!-- CONTACT -->

            <li>

                <a
                    href="{{ route('education.index') }}#contact"
                    class="education-nav-link"
                >
                    {{ __('education.navbar.contact') }}
                </a>

            </li>



            <!-- PROGRAMMING WEBSITE -->

            <li>

                <a
                    href="{{ route('tech.index') }}"
                    class="education-nav-link education-nav-programming"
                >

                    <i class="fa-solid fa-code"></i>

                    <span>
                        {{ __('education.navbar.programming_site') }}
                    </span>

                </a>

            </li>

        </ul>



        <!--==================================================
            NAVBAR ACTIONS
        ==================================================-->

        <div class="education-navbar-actions">


            <!--==================================================
                LANGUAGE SWITCHER
            ==================================================-->

            @php

                $currentLocale = request()->get(
                    'lang',
                    app()->getLocale()
                );

                if (!in_array($currentLocale, ['ar', 'en'], true)) {
                    $currentLocale = 'ar';
                }

                $nextLocale = $currentLocale === 'ar'
                    ? 'en'
                    : 'ar';

                $languageCode = $currentLocale === 'ar'
                    ? 'EN'
                    : 'AR';

                $languageLabel = $currentLocale === 'ar'
                    ? __('education.navbar.switch_to_english')
                    : __('education.navbar.switch_to_arabic');

            @endphp


            <a
                href="{{ request()->fullUrlWithQuery(['lang' => $nextLocale]) }}"
                class="education-navbar-language"
                title="{{ $languageLabel }}"
                aria-label="{{ $languageLabel }}"
            >

                <i class="fa-solid fa-language"></i>

                <span class="education-navbar-language-code">
                    {{ $languageCode }}
                </span>

            </a>



            <!--==================================================
                AUTHENTICATED STUDENT
            ==================================================-->

            @if(Auth::guard('education')->check())


                <!-- PROFILE -->

                <a
                    href="{{ route('education.profile.index') }}"
                    class="education-navbar-user
                        {{ request()->routeIs('education.profile.*') ? 'active' : '' }}"
                >

                    <span class="education-navbar-user-icon">

                        <i class="fa-solid fa-user"></i>

                    </span>

                    <span class="education-navbar-user-text">

                        {{ __('education.navbar.account') }}

                    </span>

                </a>



                <!-- LOGOUT -->

                <form
                    method="POST"
                    action="{{ route('education.logout') }}"
                    class="education-navbar-logout-form"
                >

                    @csrf

                    <button
                        type="submit"
                        class="education-navbar-logout"
                        title="{{ __('education.navbar.logout') }}"
                    >

                        <i class="fa-solid fa-right-from-bracket"></i>

                        <span>
                            {{ __('education.navbar.logout') }}
                        </span>

                    </button>

                </form>


            @else


                <!--==================================================
                    GUEST
                ==================================================-->

                <!-- LOGIN -->

                <a
                    href="{{ route('education.login') }}"
                    class="education-navbar-login education-navbar-login-desktop"
                    aria-label="{{ __('education.navbar.login') }}"
                    title="{{ __('education.navbar.login') }}"
                >

                    <i class="fa-solid fa-right-to-bracket"></i>

                    <span class="education-navbar-login-text">
                        {{ __('education.navbar.login') }}
                    </span>

                </a>



                <!-- REGISTER -->

                <a
                    href="{{ route('education.register') }}"
                    class="education-navbar-action"
                >

                    <span>
                        {{ __('education.navbar.start_learning') }}
                    </span>

                    <i class="fa-solid fa-arrow-left"></i>

                </a>

            @endif



            <!--==================================================
                MOBILE TOGGLE
            ==================================================-->

            <button
                type="button"
                class="education-navbar-toggle"
                id="educationNavbarToggle"
                aria-label="{{ __('education.navbar.open_menu') }}"
                aria-expanded="false"
            >

                <span></span>
                <span></span>
                <span></span>

            </button>

        </div>

    </div>



    <!--==================================================
        MOBILE MENU
    ==================================================-->

    <div
        class="education-mobile-menu"
        id="educationMobileMenu"
    >


        <!-- HOME -->

        <a
            href="{{ route('education.index') }}#home"
            class="education-mobile-link
                {{ request()->routeIs('education.index') ? 'active' : '' }}"
        >

            <i class="fa-solid fa-house"></i>

            <span>
                {{ __('education.navbar.home') }}
            </span>

        </a>



        <!-- ABOUT -->

        <a
            href="{{ route('education.index') }}#about"
            class="education-mobile-link"
        >

            <i class="fa-solid fa-user"></i>

            <span>
                {{ __('education.navbar.about') }}
            </span>

        </a>



        <!-- LESSONS -->

        <a
            href="{{ route('education.index') }}#services"
            class="education-mobile-link"
        >

            <i class="fa-solid fa-book-open"></i>

            <span>
                {{ __('education.navbar.lessons') }}
            </span>

        </a>



        <!-- RESOURCES -->

        <a
            href="{{ route('education.index') }}#resources"
            class="education-mobile-link"
        >

            <i class="fa-solid fa-folder-open"></i>

            <span>
                {{ __('education.navbar.resources') }}
            </span>

        </a>



        <!-- COMMENTS -->

        @if(Route::has('education.comments.index'))

            <a
                href="{{ route('education.comments.index') }}"
                class="education-mobile-link
                    {{ request()->routeIs('education.comments.*') ? 'active' : '' }}"
            >

                <i class="fa-regular fa-comment-dots"></i>

                <span>
                    {{ __('education.navbar.comments') }}
                </span>

            </a>

        @endif



        <!-- CONTACT -->

        <a
            href="{{ route('education.index') }}#contact"
            class="education-mobile-link"
        >

            <i class="fa-solid fa-envelope"></i>

            <span>
                {{ __('education.navbar.contact') }}
            </span>

        </a>



        <!-- PROGRAMMING WEBSITE -->

        <a
            href="{{ route('tech.index') }}"
            class="education-mobile-link education-mobile-programming"
        >

            <i class="fa-solid fa-code"></i>

            <span>
                {{ __('education.navbar.programming_site') }}
            </span>

            <i class="fa-solid fa-arrow-up-right-from-square"></i>

        </a>



        <!--==================================================
            MOBILE LANGUAGE SWITCHER
        ==================================================-->

        @php

            $currentLocale = request()->get(
                'lang',
                app()->getLocale()
            );

            if (!in_array($currentLocale, ['ar', 'en'], true)) {
                $currentLocale = 'ar';
            }

            $nextLocale = $currentLocale === 'ar'
                ? 'en'
                : 'ar';

            $mobileLanguageName = $currentLocale === 'ar'
                ? __('education.navbar.english')
                : __('education.navbar.arabic');

            $mobileLanguageCode = $currentLocale === 'ar'
                ? 'EN'
                : 'AR';

            $mobileLanguageLabel = $currentLocale === 'ar'
                ? __('education.navbar.switch_to_english')
                : __('education.navbar.switch_to_arabic');

        @endphp


        <a
            href="{{ request()->fullUrlWithQuery(['lang' => $nextLocale]) }}"
            class="education-mobile-link education-mobile-language"
            title="{{ $mobileLanguageLabel }}"
            aria-label="{{ $mobileLanguageLabel }}"
        >

            <span class="education-mobile-language-icon">

                <i class="fa-solid fa-language"></i>

            </span>

            <span class="education-mobile-language-name">

                {{ $mobileLanguageName }}

            </span>

            <strong class="education-mobile-language-code">

                {{ $mobileLanguageCode }}

            </strong>

        </a>



        <div class="education-mobile-divider"></div>



        <!--==================================================
            AUTHENTICATED MOBILE
        ==================================================-->

        @if(Auth::guard('education')->check())


            <!-- PROFILE -->

            <a
                href="{{ route('education.profile.index') }}"
                class="education-mobile-cta
                    {{ request()->routeIs('education.profile.*') ? 'active' : '' }}"
            >

                <span>
                    {{ __('education.navbar.account') }}
                </span>

                <i class="fa-solid fa-user"></i>

            </a>



            <!-- LOGOUT -->

            <form
                method="POST"
                action="{{ route('education.logout') }}"
                class="education-mobile-logout-form"
            >

                @csrf

                <button
                    type="submit"
                    class="education-mobile-logout"
                    title="{{ __('education.navbar.logout') }}"
                >

                    <span>
                        {{ __('education.navbar.logout') }}
                    </span>

                    <i class="fa-solid fa-right-from-bracket"></i>

                </button>

            </form>


        @else


            <!--==================================================
                GUEST MOBILE
            ==================================================-->

            <!-- LOGIN -->

            <a
                href="{{ route('education.login') }}"
                class="education-mobile-login"
            >

                <i class="fa-solid fa-right-to-bracket"></i>

                <span>
                    {{ __('education.navbar.login') }}
                </span>

            </a>



            <!-- REGISTER -->

            <a
                href="{{ route('education.register') }}"
                class="education-mobile-cta"
            >

                <span>
                    {{ __('education.navbar.create_account') }}
                </span>

                <i class="fa-solid fa-user-plus"></i>

            </a>

        @endif

    </div>

</nav>

</header>
