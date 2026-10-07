
{{-- =========================================================
    EDUCATION ADMIN HEADER
    Header + Mobile Sections + Language + Notifications + Profile
    Dark / Olive / Gold
========================================================= --}}

@php

    /*
    |--------------------------------------------------------------------------
    | EDUCATION ADMIN
    |--------------------------------------------------------------------------
    */

    $educationAdmin = auth()
        ->guard('education_admin')
        ->user();


    /*
    |--------------------------------------------------------------------------
    | EDUCATION LOCALE
    |--------------------------------------------------------------------------
    */

    $educationLocale = session(
        'education_locale',
        'ar'
    );

    $educationNextLocale =
        $educationLocale === 'ar'
            ? 'en'
            : 'ar';


    /*
    |--------------------------------------------------------------------------
    | INITIAL UNREAD NOTIFICATIONS COUNT
    |--------------------------------------------------------------------------
    */

    $initialUnreadNotifications =
        isset($educationAdminUnreadNotifications)
            ? (int) $educationAdminUnreadNotifications
            : 0;

@endphp


<header class="education-admin-header">


    {{-- =====================================================
        LEFT SIDE
    ====================================================== --}}

    <div class="education-admin-header-left">

        <div class="education-admin-header-title">

            <span class="education-admin-header-label">
                {{ __('education_admin.header.education_panel') }}
            </span>

            <h1>
                @yield(
                    'page_title',
                    __('education_admin.header.dashboard')
                )
            </h1>

        </div>

    </div>


    {{-- =====================================================
        RIGHT SIDE
    ====================================================== --}}

    <div class="education-admin-header-right">


        {{-- =================================================
            MOBILE SECTIONS BUTTON
            يظهر فقط في الشاشات الصغيرة
        ================================================== --}}

        <div
            class="education-admin-mobile-sections-wrapper"
            id="educationAdminMobileSectionsWrapper"
        >

            <button
                type="button"
                class="education-admin-header-mobile-sections"
                id="educationAdminMobileSectionsButton"
                title="{{ __('education_admin.sidebar.education_panel') }}"
                aria-label="{{ __('education_admin.sidebar.education_panel') }}"
                aria-expanded="false"
                aria-haspopup="true"
            >

                <i class="fa-solid fa-bars-staggered"></i>

            </button>


            {{-- =================================================
                MOBILE SECTIONS DROPDOWN
            ================================================== --}}

            <div
                class="education-admin-mobile-sections-dropdown"
                id="educationAdminMobileSectionsDropdown"
                aria-hidden="true"
            >

                <div class="education-admin-mobile-sections-header">

                    <div>

                        <strong>
                            {{ __('education_admin.sidebar.education_panel') }}
                        </strong>

                        <small>
                            {{ __('education_admin.sidebar.main') }}
                        </small>

                    </div>

                    <button
                        type="button"
                        class="education-admin-mobile-sections-close"
                        id="educationAdminMobileSectionsClose"
                        aria-label="{{ __('education_admin.sidebar.close_menu') }}"
                    >

                        <i class="fa-solid fa-xmark"></i>

                    </button>

                </div>


                <div
                    class="education-admin-mobile-sections-content"
                    id="educationAdminMobileSectionsContent"
                >

                    {{--

                        سيتم نسخ Navigation الموجود في الـ Sidebar
                        تلقائيًا بواسطة JavaScript.

                        بهذه الطريقة:
                        - نفس الأقسام
                        - نفس الروابط
                        - نفس الأيقونات
                        - نفس اللغة
                        - نفس active state

                    --}}

                    <div class="education-admin-mobile-sections-loading">

                        <i class="fa-solid fa-spinner fa-spin"></i>

                    </div>

                </div>

            </div>

        </div>


        {{-- =================================================
            VISIT WEBSITE
        ================================================== --}}

        <a
            href="{{ route('education.index') }}"
            target="_blank"
            rel="noopener noreferrer"
            class="education-admin-header-website"
            title="{{ __('education_admin.header.visit_website') }}"
        >

            <i class="fa-solid fa-arrow-up-right-from-square"></i>

            <span>
                {{ __('education_admin.header.visit_website') }}
            </span>

        </a>


        {{-- =================================================
            LANGUAGE SWITCHER
        ================================================== --}}

        <a
            href="{{ route('education.language', ['locale' => $educationNextLocale]) }}"
            class="education-admin-header-language"
            title="{{ __('education_admin.header.language') }}"
            aria-label="{{ __('education_admin.header.language') }}"
        >

            <i class="fa-solid fa-language"></i>

        </a>


        {{-- =================================================
            NOTIFICATIONS
        ================================================== --}}

        <div
            class="education-admin-notifications-wrapper"
            id="educationAdminNotificationsWrapper"
        >

            <button
                type="button"
                class="education-admin-header-notifications"
                id="educationAdminNotificationsButton"
                title="{{ __('education_admin.header.notifications') }}"
                aria-label="{{ __('education_admin.header.notifications') }}"
                aria-expanded="false"
                aria-haspopup="true"
            >

                <i class="fa-regular fa-bell"></i>

                <span
                    class="education-admin-notification-count"
                    id="educationAdminNotificationCount"
                    @if($initialUnreadNotifications <= 0)
                        style="display: none;"
                    @endif
                >

                    {{
                        $initialUnreadNotifications > 99
                            ? '99+'
                            : $initialUnreadNotifications
                    }}

                </span>

            </button>


            {{-- =================================================
                NOTIFICATIONS DROPDOWN
            ================================================== --}}

            <div
                class="education-admin-notifications-dropdown"
                id="educationAdminNotificationsDropdown"
                aria-hidden="true"
            >

                <div class="education-admin-notifications-dropdown-header">

                    <div>

                        <strong>
                            {{ __('education_admin.header.notifications') }}
                        </strong>

                        <small>
                            {{ __('education_admin.header.latest_notifications') }}
                        </small>

                    </div>


                    <button
                        type="button"
                        class="education-admin-notifications-read-all"
                        id="educationAdminNotificationsReadAll"
                    >

                        {{ __('education_admin.header.mark_all_read') }}

                    </button>

                </div>


                <div
                    class="education-admin-notifications-list"
                    id="educationAdminNotificationsList"
                >

                    <div class="education-admin-notifications-loading">

                        <i class="fa-solid fa-spinner fa-spin"></i>

                        <span>
                            {{ __('education_admin.header.loading_notifications') }}
                        </span>

                    </div>

                </div>


                <a
                    href="{{ route('education.admin.notifications.index') }}"
                    class="education-admin-notifications-footer"
                >

                    <span>
                        {{ __('education_admin.header.view_all_notifications') }}
                    </span>

                    <i class="fa-solid fa-chevron-left"></i>

                </a>

            </div>

        </div>


        {{-- =================================================
            DIVIDER
        ================================================== --}}

        <span class="education-admin-header-divider"></span>


        {{-- =================================================
            ADMIN PROFILE
        ================================================== --}}

        @if($educationAdmin)

            <div
                class="education-admin-header-profile-wrapper"
                id="educationAdminProfileWrapper"
            >

                <button
                    type="button"
                    class="education-admin-header-profile"
                    id="educationAdminProfileButton"
                    aria-expanded="false"
                    aria-haspopup="true"
                >

                    <div class="education-admin-header-avatar">

                        @if($educationAdmin->avatar)

                            <img
                                src="{{ asset($educationAdmin->avatar) }}"
                                alt="{{ $educationAdmin->name }}"
                            >

                        @else

                            <span>

                                {{
                                    mb_strtoupper(
                                        mb_substr(
                                            $educationAdmin->name ?? 'H',
                                            0,
                                            1
                                        )
                                    )
                                }}

                            </span>

                        @endif


                        <i class="fa-solid fa-circle"></i>

                    </div>


                    <div class="education-admin-header-profile-info">

                        <strong>
                            {{
                                $educationAdmin->name
                                    ?? __('education_admin.header.education_admin')
                            }}
                        </strong>

                        <span>
                            {{ $educationAdmin->email }}
                        </span>

                    </div>


                    <i
                        class="
                            fa-solid
                            fa-chevron-down
                            education-admin-profile-arrow
                        "
                    ></i>

                </button>


                {{-- =================================================
                    PROFILE DROPDOWN
                ================================================== --}}

                <div
                    class="education-admin-profile-dropdown"
                    id="educationAdminProfileDropdown"
                    aria-hidden="true"
                >

                    <div class="education-admin-profile-dropdown-header">

                        <div class="education-admin-profile-dropdown-avatar">

                            @if($educationAdmin->avatar)

                                <img
                                    src="{{ asset($educationAdmin->avatar) }}"
                                    alt="{{ $educationAdmin->name }}"
                                >

                            @else

                                <span>

                                    {{
                                        mb_strtoupper(
                                            mb_substr(
                                                $educationAdmin->name ?? 'H',
                                                0,
                                                1
                                            )
                                        )
                                    }}

                                </span>

                            @endif

                        </div>


                        <div class="education-admin-profile-dropdown-user">

                            <strong>
                                {{
                                    $educationAdmin->name
                                        ?? __('education_admin.header.education_admin')
                                }}
                            </strong>

                            <span>
                                {{ $educationAdmin->email }}
                            </span>

                            <small>

                                <i class="fa-solid fa-shield-halved"></i>

                                {{ __('education_admin.header.education_admin') }}

                            </small>

                        </div>

                    </div>


                    <div class="education-admin-profile-dropdown-divider"></div>


                    <a
                        href="{{ route('education.admin.profile.edit') }}"
                        class="education-admin-profile-dropdown-item"
                    >

                        <span class="education-admin-profile-dropdown-icon">

                            <i class="fa-regular fa-user"></i>

                        </span>

                        <span class="education-admin-profile-dropdown-text">

                            <strong>
                                {{ __('education_admin.header.profile') }}
                            </strong>

                            <small>
                                {{ __('education_admin.header.profile_description') }}
                            </small>

                        </span>

                        <i
                            class="
                                fa-solid
                                fa-chevron-left
                                education-admin-profile-dropdown-arrow
                            "
                        ></i>

                    </a>


                    <a
                        href="{{ route('education.admin.notifications.index') }}"
                        class="education-admin-profile-dropdown-item"
                    >

                        <span class="education-admin-profile-dropdown-icon">

                            <i class="fa-regular fa-bell"></i>

                        </span>

                        <span class="education-admin-profile-dropdown-text">

                            <strong>
                                {{ __('education_admin.header.notifications') }}
                            </strong>

                            <small>
                                {{ __('education_admin.header.notifications_description') }}
                            </small>

                        </span>


                        <span
                            class="education-admin-profile-dropdown-badge"
                            id="educationAdminProfileNotificationBadge"
                            @if($initialUnreadNotifications <= 0)
                                style="display: none;"
                            @endif
                        >

                            {{
                                $initialUnreadNotifications > 99
                                    ? '99+'
                                    : $initialUnreadNotifications
                            }}

                        </span>

                    </a>


                    <a
                        href="{{ route('education.index') }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="education-admin-profile-dropdown-item"
                    >

                        <span class="education-admin-profile-dropdown-icon">

                            <i class="fa-solid fa-globe"></i>

                        </span>

                        <span class="education-admin-profile-dropdown-text">

                            <strong>
                                {{ __('education_admin.header.visit_website') }}
                            </strong>

                            <small>
                                {{ __('education_admin.header.website_description') }}
                            </small>

                        </span>

                        <i
                            class="
                                fa-solid
                                fa-arrow-up-right-from-square
                                education-admin-profile-dropdown-arrow
                            "
                        ></i>

                    </a>


                    <div class="education-admin-profile-dropdown-divider"></div>


                    <form
                        action="{{ route('education.admin.logout') }}"
                        method="POST"
                        class="education-admin-profile-logout-form"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="
                                education-admin-profile-dropdown-item
                                education-admin-profile-logout
                            "
                        >

                            <span class="education-admin-profile-dropdown-icon">

                                <i class="fa-solid fa-right-from-bracket"></i>

                            </span>

                            <span class="education-admin-profile-dropdown-text">

                                <strong>
                                    {{ __('education_admin.header.logout') }}
                                </strong>

                                <small>
                                    {{ __('education_admin.header.logout_description') }}
                                </small>

                            </span>

                        </button>

                    </form>

                </div>

            </div>

        @endif

    </div>

</header>


{{-- =========================================================
    EDUCATION ADMIN HEADER CSS
========================================================= --}}

<style>

/* =========================================================
   GLOBAL
========================================================= */

html,
body {

    max-width: 100%;
    overflow-x: hidden;

}


.education-admin-header,
.education-admin-header *,
.education-admin-notifications-dropdown,
.education-admin-profile-dropdown,
.education-admin-mobile-sections-dropdown {

    box-sizing: border-box;

}


/* =========================================================
   HEADER
========================================================= */

.education-admin-header {

    direction: rtl;

    min-height: 82px;

    width: 100%;
    max-width: 100%;

    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 20px;

    padding: 0 30px;

    position: relative;
    z-index: 1200;

    overflow: visible;

    background:
        linear-gradient(
            135deg,
            #252820 0%,
            #20231d 48%,
            #1c1f1a 100%
        );

    border-bottom:
        1px solid rgba(212, 174, 97, 0.16);

    box-shadow:
        0 8px 30px rgba(0, 0, 0, 0.22);

}


/* =========================================================
   TOP GOLD LIGHT
========================================================= */

.education-admin-header::before {

    content: "";

    position: absolute;

    top: 0;
    left: 7%;

    width: 230px;
    max-width: 30%;

    height: 1px;

    background:
        linear-gradient(
            90deg,
            transparent,
            rgba(212, 174, 97, 0.65),
            transparent
        );

    opacity: 0.65;

}


/* =========================================================
   LEFT
========================================================= */

.education-admin-header-left {

    min-width: 0;
    max-width: 100%;

    display: flex;
    align-items: center;

}


/* =========================================================
   TITLE
========================================================= */

.education-admin-header-title {

    min-width: 0;
    max-width: 100%;

    position: relative;

    padding-right: 14px;

}


.education-admin-header-title::before {

    content: "";

    position: absolute;

    right: 0;
    top: 4px;

    width: 3px;
    height: calc(100% - 8px);

    border-radius: 10px;

    background:
        linear-gradient(
            180deg,
            #dfc174,
            #9f7b3d
        );

}


.education-admin-header-label {

    display: block;

    margin-bottom: 4px;

    color: #9da092;

    font-size: 10px;
    font-weight: 600;

    letter-spacing: 0.15px;

}


.education-admin-header-title h1 {

    margin: 0;

    max-width: 100%;

    color: #f3efe6;

    font-size: 21px;
    line-height: 1.25;
    font-weight: 750;

    white-space: nowrap;

    overflow: hidden;

    text-overflow: ellipsis;

}


/* =========================================================
   RIGHT
========================================================= */

.education-admin-header-right {

    min-width: 0;
    max-width: 100%;

    display: flex;
    align-items: center;

    gap: 7px;

}


/* =========================================================
   MOBILE SECTIONS
   مخفية افتراضيًا
========================================================= */

.education-admin-mobile-sections-wrapper {

    display: none;

    position: relative;

    flex-shrink: 0;

}


/* =========================================================
   MOBILE SECTIONS BUTTON
========================================================= */

.education-admin-header-mobile-sections {

    width: 42px;
    height: 42px;

    display: flex;
    align-items: center;
    justify-content: center;

    border:
        1px solid rgba(255, 255, 255, 0.065);

    border-radius: 12px;

    background:
        rgba(255, 255, 255, 0.028);

    color: #c8c9c0;

    cursor: pointer;

    box-shadow:
        inset 0 1px 0 rgba(255, 255, 255, 0.025);

    transition:
        transform 0.22s ease,
        background 0.22s ease,
        border-color 0.22s ease,
        color 0.22s ease;

}


.education-admin-header-mobile-sections i {

    color: #c9a95e;

    font-size: 16px;

}


.education-admin-header-mobile-sections:hover,
.education-admin-mobile-sections-wrapper.is-open
.education-admin-header-mobile-sections {

    color: #e2c679;

    background:
        rgba(212, 174, 97, 0.08);

    border-color:
        rgba(212, 174, 97, 0.28);

    transform:
        translateY(-1px);

}


/* =========================================================
   MOBILE SECTIONS DROPDOWN
========================================================= */

.education-admin-mobile-sections-dropdown {

    position: fixed;

    top: 70px;

    right: 9px;
    left: 9px;

    width: auto;

    max-height: calc(100vh - 82px);

    overflow: hidden;

    border:
        1px solid rgba(212, 174, 97, 0.17);

    border-radius: 16px;

    background:
        linear-gradient(
            145deg,
            rgba(43, 46, 37, 0.995),
            rgba(29, 32, 26, 0.995)
        );

    box-shadow:
        0 25px 65px rgba(0, 0, 0, 0.42),
        0 8px 24px rgba(0, 0, 0, 0.16),
        inset 0 1px 0 rgba(255, 255, 255, 0.025);

    opacity: 0;

    visibility: hidden;

    transform:
        translateY(-9px)
        scale(0.985);

    transform-origin: top center;

    transition:
        opacity 0.20s ease,
        visibility 0.20s ease,
        transform 0.20s ease;

    z-index: 1600;

}


.education-admin-mobile-sections-wrapper.is-open
.education-admin-mobile-sections-dropdown {

    opacity: 1;

    visibility: visible;

    transform:
        translateY(0)
        scale(1);

}


/* =========================================================
   MOBILE SECTIONS HEADER
========================================================= */

.education-admin-mobile-sections-header {

    min-height: 62px;

    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 12px;

    padding: 10px 14px;

    border-bottom:
        1px solid rgba(255, 255, 255, 0.065);

}


.education-admin-mobile-sections-header > div {

    min-width: 0;

    display: flex;
    flex-direction: column;

}


.education-admin-mobile-sections-header strong {

    color: #f2eee6;

    font-size: 13px;
    font-weight: 800;

}


.education-admin-mobile-sections-header small {

    margin-top: 3px;

    color: #777c72;

    font-size: 9px;

}


.education-admin-mobile-sections-close {

    width: 34px;
    height: 34px;

    flex-shrink: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    border:
        1px solid rgba(255, 255, 255, 0.06);

    border-radius: 9px;

    background:
        rgba(255, 255, 255, 0.035);

    color: #aaa99f;

    cursor: pointer;

    transition:
        background 0.20s ease,
        color 0.20s ease,
        border-color 0.20s ease;

}


.education-admin-mobile-sections-close:hover {

    color: #dfc273;

    background:
        rgba(212, 174, 97, 0.08);

    border-color:
        rgba(212, 174, 97, 0.20);

}


/* =========================================================
   MOBILE SECTIONS CONTENT
========================================================= */

.education-admin-mobile-sections-content {

    max-height: calc(100vh - 145px);

    overflow-y: auto;
    overflow-x: hidden;

    padding: 8px;

    scrollbar-width: thin;

}


/* =========================================================
   LOADING
========================================================= */

.education-admin-mobile-sections-loading {

    min-height: 120px;

    display: flex;
    align-items: center;
    justify-content: center;

    color: #c9a653;

}


/* =========================================================
   CLONED SIDEBAR NAV
========================================================= */

.education-admin-mobile-sections-content
.education-admin-navigation {

    display: block;

    width: 100%;

}


.education-admin-mobile-sections-content
.education-admin-nav-section {

    margin-bottom: 8px;

}


.education-admin-mobile-sections-content
.education-admin-nav-section:last-child {

    margin-bottom: 0;

}


.education-admin-mobile-sections-content
.education-admin-nav-title {

    display: block;

    padding:
        8px
        10px
        5px;

    color: #858980;

    font-size: 8px;

    font-weight: 700;

}


.education-admin-mobile-sections-content
.education-admin-nav-link {

    width: 100%;

    min-height: 44px;

    display: flex;

    align-items: center;

    gap: 10px;

    padding:
        6px 9px;

    border:
        1px solid transparent;

    border-radius: 10px;

    color: #c9cbc3;

    background: transparent;

    text-decoration: none;

    transition:
        background 0.18s ease,
        color 0.18s ease,
        border-color 0.18s ease;

}


.education-admin-mobile-sections-content
.education-admin-nav-link:hover {

    color: #e0c06f;

    background:
        rgba(212, 174, 97, 0.075);

    border-color:
        rgba(212, 174, 97, 0.08);

}


.education-admin-mobile-sections-content
.education-admin-nav-link.active {

    color: #e2c577;

    background:
        rgba(212, 174, 97, 0.095);

    border-color:
        rgba(212, 174, 97, 0.12);

}


.education-admin-mobile-sections-content
.education-admin-nav-icon {

    width: 32px;
    height: 32px;

    flex-shrink: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 8px;

    background:
        rgba(255, 255, 255, 0.035);

    color: #aaa99f;

}


.education-admin-mobile-sections-content
.education-admin-nav-link.active
.education-admin-nav-icon {

    color: #d4ae61;

    background:
        rgba(212, 174, 97, 0.10);

}


.education-admin-mobile-sections-content
.education-admin-nav-label {

    flex: 1;

    min-width: 0;

    font-size: 10px;

    line-height: 1.4;

}


.education-admin-mobile-sections-content
.education-admin-nav-badge {

    margin-right: auto;

    flex-shrink: 0;

    color: #666b61;

    font-size: 8px;

}


.education-admin-mobile-sections-content
.education-admin-nav-link:hover
.education-admin-nav-badge {

    color: #d4ae61;

}


/* =========================================================
   SHARED ACTION STYLE
========================================================= */

.education-admin-header-website,
.education-admin-header-language,
.education-admin-header-notifications {

    border:
        1px solid rgba(255, 255, 255, 0.065);

    background:
        rgba(255, 255, 255, 0.028);

    box-shadow:
        inset 0 1px 0 rgba(255, 255, 255, 0.025);

}


/* =========================================================
   WEBSITE
========================================================= */

.education-admin-header-website {

    height: 42px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    gap: 8px;

    padding: 0 13px;

    border-radius: 11px;

    color: #c8c9c0;

    text-decoration: none;

    font-size: 10px;
    font-weight: 600;

    white-space: nowrap;

    transition:
        transform 0.22s ease,
        background 0.22s ease,
        border-color 0.22s ease,
        color 0.22s ease,
        box-shadow 0.22s ease;

}


.education-admin-header-website i {

    color: #b99a57;

    font-size: 12px;

}


.education-admin-header-website:hover {

    color: #e1c477;

    background:
        rgba(212, 174, 97, 0.075);

    border-color:
        rgba(212, 174, 97, 0.27);

    box-shadow:
        0 5px 18px rgba(0, 0, 0, 0.16);

    transform:
        translateY(-1px);

}


/* =========================================================
   LANGUAGE
========================================================= */

.education-admin-header-language {

    width: 42px;
    height: 42px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    flex-shrink: 0;

    border-radius: 11px;

    color: #c8c9c0;

    text-decoration: none;

    transition:
        transform 0.22s ease,
        background 0.22s ease,
        border-color 0.22s ease,
        color 0.22s ease;

}


.education-admin-header-language i {

    color: #c9a95e;

    font-size: 17px;

}


.education-admin-header-language:hover {

    color: #e2c679;

    background:
        rgba(212, 174, 97, 0.08);

    border-color:
        rgba(212, 174, 97, 0.28);

    transform:
        translateY(-1px);

}


/* =========================================================
   NOTIFICATIONS WRAPPER
========================================================= */

.education-admin-notifications-wrapper {

    position: relative;

    flex-shrink: 0;

}


/* =========================================================
   NOTIFICATION BUTTON
========================================================= */

.education-admin-header-notifications {

    position: relative;

    width: 42px;
    height: 42px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 11px;

    color: #c8c9c0;

    cursor: pointer;

    transition:
        transform 0.22s ease,
        background 0.22s ease,
        border-color 0.22s ease,
        color 0.22s ease;

}


.education-admin-header-notifications > i {

    font-size: 16px;

}


.education-admin-header-notifications:hover,
.education-admin-notifications-wrapper.is-open
.education-admin-header-notifications {

    color: #dfc273;

    background:
        rgba(212, 174, 97, 0.085);

    border-color:
        rgba(212, 174, 97, 0.28);

    transform:
        translateY(-1px);

}


/* =========================================================
   NOTIFICATION COUNT
========================================================= */

.education-admin-notification-count {

    position: absolute;

    top: -3px;
    left: -3px;

    min-width: 18px;
    height: 18px;

    padding: 0 4px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 20px;

    background:
        linear-gradient(
            145deg,
            #c85b58,
            #a93e3b
        );

    border:
        2px solid #252820;

    color: #fff;

    font-size: 7px;
    font-weight: 800;

    line-height: 1;

}


/* =========================================================
   NOTIFICATIONS DROPDOWN
   تم تصغيرها على الشاشات الكبيرة
========================================================= */

.education-admin-notifications-dropdown {

    position: absolute;

    top: calc(100% + 11px);

    right: 0;

    width: 315px;

    max-width: calc(100vw - 24px);

    overflow: hidden;

    border:
        1px solid rgba(212, 174, 97, 0.17);

    border-radius: 14px;

    background:
        linear-gradient(
            145deg,
            rgba(43, 46, 37, 0.995),
            rgba(29, 32, 26, 0.995)
        );

    box-shadow:
        0 20px 50px rgba(0, 0, 0, 0.40),
        0 7px 20px rgba(0, 0, 0, 0.15),
        inset 0 1px 0 rgba(255, 255, 255, 0.025);

    opacity: 0;

    visibility: hidden;

    transform:
        translateY(-8px)
        scale(0.985);

    transform-origin: top right;

    transition:
        opacity 0.20s ease,
        visibility 0.20s ease,
        transform 0.20s ease;

    z-index: 1400;

}


.education-admin-notifications-wrapper.is-open
.education-admin-notifications-dropdown {

    opacity: 1;

    visibility: visible;

    transform:
        translateY(0)
        scale(1);

}


/* =========================================================
   NOTIFICATION DROPDOWN HEADER
========================================================= */

.education-admin-notifications-dropdown-header {

    min-height: 58px;

    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 10px;

    padding: 9px 12px;

    border-bottom:
        1px solid rgba(255, 255, 255, 0.065);

}


.education-admin-notifications-dropdown-header > div {

    display: flex;
    flex-direction: column;

    min-width: 0;

}


.education-admin-notifications-dropdown-header strong {

    color: #f2eee6;

    font-size: 12px;
    font-weight: 800;

}


.education-admin-notifications-dropdown-header small {

    margin-top: 3px;

    color: #777c72;

    font-size: 8px;

}


/* =========================================================
   READ ALL
========================================================= */

.education-admin-notifications-read-all {

    flex-shrink: 0;

    border:
        1px solid rgba(212, 174, 97, 0.10);

    padding: 6px 8px;

    border-radius: 7px;

    background:
        rgba(212, 174, 97, 0.055);

    color: #c9a653;

    font-family: inherit;

    font-size: 8px;
    font-weight: 700;

    cursor: pointer;

}


/* =========================================================
   LIST
========================================================= */

.education-admin-notifications-list {

    max-height: 285px;

    overflow-y: auto;
    overflow-x: hidden;

    scrollbar-width: thin;

}


/* =========================================================
   NOTIFICATION ITEM
========================================================= */

.education-admin-notification-item {

    width: 100%;

    display: flex;
    align-items: flex-start;

    gap: 9px;

    padding: 9px 11px;

    border: 0;

    border-bottom:
        1px solid rgba(255, 255, 255, 0.042);

    background: transparent;

    color: inherit;

    text-decoration: none;

    text-align: right;

    cursor: pointer;

}


.education-admin-notification-item:hover {

    background:
        rgba(212, 174, 97, 0.065);

}


.education-admin-notification-item.is-unread {

    background:
        linear-gradient(
            90deg,
            rgba(212, 174, 97, 0.025),
            rgba(212, 174, 97, 0.065)
        );

}


/* =========================================================
   ITEM ICON
========================================================= */

.education-admin-notification-icon {

    width: 33px;
    height: 33px;

    flex-shrink: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    border:
        1px solid rgba(212, 174, 97, 0.08);

    border-radius: 9px;

    background:
        rgba(212, 174, 97, 0.075);

    color: #d4ae61;

    font-size: 12px;

}


/* =========================================================
   ITEM CONTENT
========================================================= */

.education-admin-notification-content {

    flex: 1;

    min-width: 0;

    display: flex;
    flex-direction: column;

}


.education-admin-notification-content strong {

    color: #eeeae1;

    font-size: 10px;
    font-weight: 800;

    line-height: 1.45;

}


.education-admin-notification-content p {

    margin: 2px 0 0;

    color: #999d92;

    font-size: 9px;

    line-height: 1.55;

}


.education-admin-notification-content time {

    margin-top: 3px;

    color: #666b61;

    font-size: 7px;

}


/* =========================================================
   UNREAD DOT
========================================================= */

.education-admin-notification-unread-dot {

    width: 6px;
    height: 6px;

    flex-shrink: 0;

    margin-top: 5px;

    border-radius: 50%;

    background: #d4ae61;

    box-shadow:
        0 0 0 3px rgba(212, 174, 97, 0.08);

}


/* =========================================================
   EMPTY / LOADING
========================================================= */

.education-admin-notifications-empty,
.education-admin-notifications-loading {

    min-height: 110px;

    display: flex;

    align-items: center;
    justify-content: center;

    flex-direction: column;

    gap: 7px;

    padding: 18px;

    color: #777c72;

    text-align: center;

}


.education-admin-notifications-empty i {

    font-size: 20px;

}


.education-admin-notifications-empty span,
.education-admin-notifications-loading {

    font-size: 9px;

}


/* =========================================================
   FOOTER
========================================================= */

.education-admin-notifications-footer {

    min-height: 42px;

    display: flex;
    align-items: center;
    justify-content: center;

    gap: 7px;

    border-top:
        1px solid rgba(255, 255, 255, 0.065);

    color: #c9a653;

    background:
        rgba(255, 255, 255, 0.016);

    text-decoration: none;

    font-size: 9px;
    font-weight: 700;

}


/* =========================================================
   DIVIDER
========================================================= */

.education-admin-header-divider {

    width: 1px;
    height: 28px;

    flex-shrink: 0;

    margin: 0 3px;

    background:
        linear-gradient(
            180deg,
            transparent,
            rgba(255, 255, 255, 0.12),
            transparent
        );

}


/* =========================================================
   PROFILE WRAPPER
========================================================= */

.education-admin-header-profile-wrapper {

    position: relative;

    flex-shrink: 0;

}


/* =========================================================
   PROFILE BUTTON
========================================================= */

.education-admin-header-profile {

    min-height: 50px;

    max-width: 100%;

    display: flex;
    align-items: center;

    gap: 9px;

    padding: 4px 7px 4px 5px;

    border:
        1px solid transparent;

    border-radius: 14px;

    background: transparent;

    color: inherit;

    cursor: pointer;

}


.education-admin-header-profile:hover,
.education-admin-header-profile-wrapper.is-open
.education-admin-header-profile {

    background:
        rgba(255, 255, 255, 0.045);

    border-color:
        rgba(212, 174, 97, 0.15);

}


/* =========================================================
   AVATAR
========================================================= */

.education-admin-header-avatar {

    position: relative;

    width: 42px;
    height: 42px;

    flex-shrink: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    overflow: visible;

    border:
        1px solid rgba(229, 202, 131, 0.45);

    border-radius: 50%;

    background:
        linear-gradient(
            145deg,
            #dfc174,
            #a98242
        );

}


.education-admin-header-avatar img {

    width: 100%;
    height: 100%;

    object-fit: cover;

    border-radius: 50%;

}


.education-admin-header-avatar span {

    color: #292b24;

    font-size: 16px;
    font-weight: 800;

}


.education-admin-header-avatar > i {

    position: absolute;

    bottom: -1px;
    left: -2px;

    width: 10px;
    height: 10px;

    display: flex;
    align-items: center;
    justify-content: center;

    border:
        2px solid #252820;

    border-radius: 50%;

    color: #76b77c;

    background: #76b77c;

    font-size: 0;

}


/* =========================================================
   PROFILE INFO
========================================================= */

.education-admin-header-profile-info {

    min-width: 0;

    max-width: 165px;

    display: flex;
    flex-direction: column;

    align-items: flex-start;

}


.education-admin-header-profile-info strong {

    max-width: 165px;

    overflow: hidden;

    color: #f1eee6;

    font-size: 11px;
    font-weight: 700;

    line-height: 1.4;

    text-overflow: ellipsis;
    white-space: nowrap;

}


.education-admin-header-profile-info span {

    max-width: 165px;

    margin-top: 2px;

    overflow: hidden;

    color: #85897f;

    font-size: 8px;

    text-overflow: ellipsis;
    white-space: nowrap;

    direction: ltr;

}


/* =========================================================
   PROFILE ARROW
========================================================= */

.education-admin-profile-arrow {

    margin-right: 2px;

    color: #777b72;

    font-size: 8px;

}


.education-admin-header-profile-wrapper.is-open
.education-admin-profile-arrow {

    color: #d4ae61;

    transform:
        rotate(180deg);

}


/* =========================================================
   PROFILE DROPDOWN
========================================================= */

.education-admin-profile-dropdown {

    position: absolute;

    top: calc(100% + 11px);

    right: 0;

    width: 300px;

    max-width: calc(100vw - 24px);

    padding: 7px;

    border-radius: 15px;

    opacity: 0;

    visibility: hidden;

    transform:
        translateY(-8px)
        scale(0.985);

    transform-origin: top right;

    transition:
        opacity 0.20s ease,
        visibility 0.20s ease,
        transform 0.20s ease;

    z-index: 1300;

}


.education-admin-header-profile-wrapper.is-open
.education-admin-profile-dropdown {

    opacity: 1;

    visibility: visible;

    transform:
        translateY(0)
        scale(1);

}


/* =========================================================
   PROFILE DROPDOWN CONTENT
========================================================= */

.education-admin-profile-dropdown::before {

    content: "";

    position: absolute;

    top: -5px;
    right: 28px;

    width: 10px;
    height: 10px;

    background: #2b2e25;

    border-top:
        1px solid rgba(212, 174, 97, 0.17);

    border-right:
        1px solid rgba(212, 174, 97, 0.17);

    transform:
        rotate(-45deg);

}


.education-admin-profile-dropdown-header {

    display: flex;
    align-items: center;

    gap: 12px;

    padding: 11px 10px 13px;

}


.education-admin-profile-dropdown-avatar {

    width: 48px;
    height: 48px;

    flex-shrink: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    overflow: hidden;

    border:
        1px solid rgba(229, 202, 131, 0.35);

    border-radius: 13px;

    background:
        linear-gradient(
            145deg,
            #dfc174,
            #9e793c
        );

}


.education-admin-profile-dropdown-avatar img {

    width: 100%;
    height: 100%;

    object-fit: cover;

}


.education-admin-profile-dropdown-avatar span {

    color: #292b23;

    font-size: 19px;
    font-weight: 800;

}


.education-admin-profile-dropdown-user {

    min-width: 0;

    display: flex;
    flex-direction: column;

}


.education-admin-profile-dropdown-user strong {

    color: #f1eee6;

    font-size: 12px;
    font-weight: 750;

}


.education-admin-profile-dropdown-user span {

    margin-top: 2px;

    overflow: hidden;

    color: #858980;

    font-size: 8px;

    text-overflow: ellipsis;
    white-space: nowrap;

    direction: ltr;
    text-align: right;

}


.education-admin-profile-dropdown-user small {

    display: flex;
    align-items: center;

    gap: 5px;

    margin-top: 5px;

    color: #c9a653;

    font-size: 8px;

}


.education-admin-profile-dropdown-divider {

    height: 1px;

    margin: 4px;

    background:
        rgba(255, 255, 255, 0.065);

}


.education-admin-profile-dropdown-item {

    width: 100%;

    min-height: 53px;

    display: flex;
    align-items: center;

    gap: 10px;

    padding: 7px 8px;

    border: 0;

    border-radius: 11px;

    background: transparent;

    color: #dddcd4;

    text-decoration: none;

    text-align: right;

    cursor: pointer;

}


.education-admin-profile-dropdown-item:hover {

    background:
        rgba(212, 174, 97, 0.075);

    color: #e0c06f;

}


.education-admin-profile-dropdown-icon {

    width: 35px;
    height: 35px;

    flex-shrink: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 9px;

    background:
        rgba(255, 255, 255, 0.04);

    color: #b9bbb1;

}


.education-admin-profile-dropdown-text {

    flex: 1;

    min-width: 0;

    display: flex;
    flex-direction: column;

}


.education-admin-profile-dropdown-text strong {

    color: inherit;

    font-size: 11px;
    font-weight: 700;

}


.education-admin-profile-dropdown-text small {

    margin-top: 2px;

    color: #777c72;

    font-size: 8px;

    line-height: 1.5;

}


.education-admin-profile-dropdown-arrow {

    margin-right: auto;

    color: #666b61;

    font-size: 8px;

}


.education-admin-profile-dropdown-badge {

    min-width: 20px;
    height: 20px;

    padding: 0 5px;

    display: flex;
    align-items: center;
    justify-content: center;

    flex-shrink: 0;

    border-radius: 20px;

    background:
        rgba(185, 74, 72, 0.14);

    color: #df8885;

    font-size: 8px;
    font-weight: 800;

}


.education-admin-profile-logout-form {

    margin: 0;

}


.education-admin-profile-logout {

    color: #d88a87;

}


.education-admin-profile-logout:hover {

    background:
        rgba(185, 74, 72, 0.095);

    color: #ed9b97;

}


/* =========================================================
   FOCUS
========================================================= */

.education-admin-header a:focus-visible,
.education-admin-header button:focus-visible {

    outline:
        2px solid rgba(212, 174, 97, 0.65);

    outline-offset: 2px;

}


/* =========================================================
   RESPONSIVE 1050
========================================================= */

@media (max-width: 1050px) {

    .education-admin-header {

        padding: 0 22px;

    }


    .education-admin-header-profile-info span,
    .education-admin-header-profile-info strong {

        max-width: 140px;

    }

}


/* =========================================================
   RESPONSIVE 900
========================================================= */

@media (max-width: 900px) {

    .education-admin-header {

        min-height: 74px;

        padding: 0 18px;

        gap: 10px;

    }


    /*
     * إظهار قائمة الأقسام على الهاتف / التابلت
     */

    .education-admin-mobile-sections-wrapper {

        display: block;

    }


    .education-admin-header-website span {

        display: none;

    }


    .education-admin-header-website {

        width: 42px;

        padding: 0;

    }


    .education-admin-header-profile-info {

        display: none;

    }

}


/* =========================================================
   RESPONSIVE 600
========================================================= */

@media (max-width: 600px) {

    .education-admin-header {

        min-height: 68px;

        width: 100%;
        max-width: 100%;

        padding: 0 11px;

        gap: 6px;

    }


    .education-admin-header-left {

        flex: 1;

        min-width: 0;

        max-width: calc(100% - 190px);

    }


    .education-admin-header-title {

        max-width: 100%;

        padding-right: 10px;

    }


    .education-admin-header-title h1 {

        max-width: 155px;

        overflow: hidden;

        font-size: 16px;

        text-overflow: ellipsis;

    }


    .education-admin-header-label {

        margin-bottom: 2px;

        font-size: 8px;

    }


    .education-admin-header-right {

        flex-shrink: 0;

        gap: 4px;

    }


    .education-admin-header-mobile-sections,
    .education-admin-header-website,
    .education-admin-header-language,
    .education-admin-header-notifications {

        width: 38px;
        height: 38px;

        border-radius: 10px;

    }


    .education-admin-header-mobile-sections i,
    .education-admin-header-website i,
    .education-admin-header-language i,
    .education-admin-header-notifications > i {

        font-size: 15px;

    }


    .education-admin-header-divider {

        display: none;

    }


    .education-admin-header-profile {

        min-height: 44px;

        padding: 2px;

        border-radius: 12px;

    }


    .education-admin-header-avatar {

        width: 38px;
        height: 38px;

    }


    .education-admin-header-avatar span {

        font-size: 15px;

    }


    .education-admin-header-avatar > i {

        width: 10px;
        height: 10px;

    }


    /* =====================================================
       NOTIFICATIONS MOBILE
    ====================================================== */

    .education-admin-notifications-dropdown {

        position: fixed;

        top: 70px;

        right: 9px;
        left: 9px;

        width: auto;

        max-width: none;

        border-radius: 15px;

        transform-origin: top center;

    }


    .education-admin-notifications-list {

        max-height:
            calc(100vh - 180px);

    }


    /* =====================================================
       PROFILE MOBILE
    ====================================================== */

    .education-admin-profile-dropdown {

        position: fixed;

        top: 70px;

        right: 9px;
        left: 9px;

        width: auto;

        max-width: none;

        border-radius: 15px;

        transform-origin: top center;

    }


    .education-admin-profile-dropdown::before {

        display: none;

    }

}


/* =========================================================
   VERY SMALL SCREENS
========================================================= */

@media (max-width: 390px) {

    .education-admin-header {

        padding: 0 8px;

    }


    .education-admin-header-left {

        max-width: calc(100% - 174px);

    }


    .education-admin-header-title h1 {

        max-width: 105px;

        font-size: 14px;

    }


    .education-admin-header-mobile-sections,
    .education-admin-header-website,
    .education-admin-header-language,
    .education-admin-header-notifications {

        width: 35px;
        height: 35px;

    }


    .education-admin-header-profile {

        padding: 1px;

    }


    .education-admin-header-avatar {

        width: 35px;
        height: 35px;

    }


    .education-admin-mobile-sections-content
    .education-admin-nav-link {

        min-height: 42px;

    }


    .education-admin-mobile-sections-content
    .education-admin-nav-label {

        font-size: 9px;

    }

}


/* =========================================================
   REDUCED MOTION
========================================================= */

@media (prefers-reduced-motion: reduce) {

    .education-admin-profile-dropdown,
    .education-admin-profile-arrow,
    .education-admin-header-profile,
    .education-admin-profile-dropdown-item,
    .education-admin-notifications-dropdown,
    .education-admin-notifications-footer,
    .education-admin-header-notifications,
    .education-admin-header-language,
    .education-admin-header-website,
    .education-admin-mobile-sections-dropdown,
    .education-admin-header-mobile-sections {

        transition: none !important;

    }

}

</style>


{{-- =========================================================
    EDUCATION ADMIN HEADER JAVASCRIPT
========================================================= --}}

<script>

document.addEventListener('DOMContentLoaded', function () {


    /* =====================================================
       ELEMENTS
    ====================================================== */

    const notificationWrapper =
        document.getElementById(
            'educationAdminNotificationsWrapper'
        );


    const notificationButton =
        document.getElementById(
            'educationAdminNotificationsButton'
        );


    const notificationDropdown =
        document.getElementById(
            'educationAdminNotificationsDropdown'
        );


    const notificationCount =
        document.getElementById(
            'educationAdminNotificationCount'
        );


    const notificationList =
        document.getElementById(
            'educationAdminNotificationsList'
        );


    const readAllButton =
        document.getElementById(
            'educationAdminNotificationsReadAll'
        );


    const profileWrapper =
        document.getElementById(
            'educationAdminProfileWrapper'
        );


    const profileButton =
        document.getElementById(
            'educationAdminProfileButton'
        );


    const profileDropdown =
        document.getElementById(
            'educationAdminProfileDropdown'
        );


    const profileNotificationBadge =
        document.getElementById(
            'educationAdminProfileNotificationBadge'
        );


    /* =====================================================
       MOBILE SECTIONS
    ====================================================== */

    const mobileSectionsWrapper =
        document.getElementById(
            'educationAdminMobileSectionsWrapper'
        );


    const mobileSectionsButton =
        document.getElementById(
            'educationAdminMobileSectionsButton'
        );


    const mobileSectionsDropdown =
        document.getElementById(
            'educationAdminMobileSectionsDropdown'
        );


    const mobileSectionsClose =
        document.getElementById(
            'educationAdminMobileSectionsClose'
        );


    const mobileSectionsContent =
        document.getElementById(
            'educationAdminMobileSectionsContent'
        );


    /*
     * نبحث عن الـ Sidebar Navigation الموجود أصلًا.
     *
     * لا نكتب الأقسام مرة أخرى.
     * ننسخ نفس الـ Navigation الموجود في السيدر.
     */

    const sidebarNavigation =
        document.querySelector(
            '.education-admin-sidebar .education-admin-navigation'
        );


    function prepareMobileSections() {

        if (
            !mobileSectionsContent ||
            !sidebarNavigation
        ) {

            return;

        }


        const clonedNavigation =
            sidebarNavigation.cloneNode(true);


        /*
         * إزالة أي ID محتمل من النسخة
         * حتى لا يكون هناك duplicate IDs.
         */

        clonedNavigation
            .querySelectorAll('[id]')
            .forEach(function (element) {

                element.removeAttribute('id');

            });


        mobileSectionsContent.innerHTML = '';

        mobileSectionsContent.appendChild(
            clonedNavigation
        );


        /*
         * عند الضغط على أي رابط:
         * يتم إغلاق القائمة تلقائيًا.
         */

        mobileSectionsContent
            .querySelectorAll('a')
            .forEach(function (link) {

                link.addEventListener(
                    'click',
                    function () {

                        closeMobileSections();

                    }
                );

            });

    }


    function openMobileSections() {

        if (!mobileSectionsWrapper) {
            return;
        }


        mobileSectionsWrapper.classList.add(
            'is-open'
        );


        mobileSectionsButton?.setAttribute(
            'aria-expanded',
            'true'
        );


        mobileSectionsDropdown?.setAttribute(
            'aria-hidden',
            'false'
        );


        closeNotifications();

        closeProfileDropdown();

    }


    function closeMobileSections() {

        if (!mobileSectionsWrapper) {
            return;
        }


        mobileSectionsWrapper.classList.remove(
            'is-open'
        );


        mobileSectionsButton?.setAttribute(
            'aria-expanded',
            'false'
        );


        mobileSectionsDropdown?.setAttribute(
            'aria-hidden',
            'true'
        );

    }


    if (mobileSectionsButton) {

        mobileSectionsButton.addEventListener(
            'click',
            function (event) {

                event.preventDefault();

                event.stopPropagation();


                if (
                    mobileSectionsWrapper.classList.contains(
                        'is-open'
                    )
                ) {

                    closeMobileSections();

                } else {

                    openMobileSections();

                }

            }
        );

    }


    if (mobileSectionsClose) {

        mobileSectionsClose.addEventListener(
            'click',
            function (event) {

                event.preventDefault();

                event.stopPropagation();

                closeMobileSections();

            }
        );

    }


    if (mobileSectionsDropdown) {

        mobileSectionsDropdown.addEventListener(
            'click',
            function (event) {

                event.stopPropagation();

            }
        );

    }


    /*
     * تجهيز القائمة بعد تحميل الصفحة.
     */

    prepareMobileSections();


    /* =====================================================
       TRANSLATIONS
    ====================================================== */

    const educationAdminTranslations = {

        noNotifications:
            @json(
                __('education_admin.header.no_notifications')
            ),

    };


    /* =====================================================
       NOTIFICATION ROUTES
    ====================================================== */

    const notificationDataUrl =
        @json(
            route(
                'education.admin.notifications.data'
            )
        );


    const notificationReadAllUrl =
        @json(
            route(
                'education.admin.notifications.read_all'
            )
        );


    const notificationReadUrlTemplate =
        @json(
            route(
                'education.admin.notifications.read',
                [
                    'notification' => '__NOTIFICATION__'
                ]
            )
        );


    /* =====================================================
       CSRF
    ====================================================== */

    const csrfTokenElement =
        document.querySelector(
            'meta[name="csrf-token"]'
        );


    const csrfToken =
        csrfTokenElement
            ? csrfTokenElement.getAttribute('content')
            : '';


    /* =====================================================
       ESCAPE HTML
    ====================================================== */

    function escapeHtml(value) {

        if (
            value === null ||
            value === undefined
        ) {

            return '';

        }


        return String(value)

            .replace(
                /&/g,
                '&amp;'
            )

            .replace(
                /</g,
                '&lt;'
            )

            .replace(
                />/g,
                '&gt;'
            )

            .replace(
                /"/g,
                '&quot;'
            )

            .replace(
                /'/g,
                '&#039;'
            );

    }


    /* =====================================================
       UPDATE BADGES
    ====================================================== */

    function updateNotificationBadges(count) {

        count = Number(count || 0);


        if (notificationCount) {

            if (count <= 0) {

                notificationCount.style.display =
                    'none';

                notificationCount.textContent =
                    '0';

            } else {

                notificationCount.style.display =
                    'flex';

                notificationCount.textContent =
                    count > 99
                        ? '99+'
                        : String(count);

            }

        }


        if (profileNotificationBadge) {

            if (count <= 0) {

                profileNotificationBadge.style.display =
                    'none';

                profileNotificationBadge.textContent =
                    '0';

            } else {

                profileNotificationBadge.style.display =
                    'flex';

                profileNotificationBadge.textContent =
                    count > 99
                        ? '99+'
                        : String(count);

            }

        }

    }


    /* =====================================================
       OPEN NOTIFICATIONS
    ====================================================== */

    function openNotifications() {

        if (!notificationWrapper) {
            return;
        }


        notificationWrapper.classList.add(
            'is-open'
        );


        notificationButton?.setAttribute(
            'aria-expanded',
            'true'
        );


        notificationDropdown?.setAttribute(
            'aria-hidden',
            'false'
        );


        closeProfileDropdown();

        closeMobileSections();

        loadNotifications();

    }


    /* =====================================================
       CLOSE NOTIFICATIONS
    ====================================================== */

    function closeNotifications() {

        if (!notificationWrapper) {
            return;
        }


        notificationWrapper.classList.remove(
            'is-open'
        );


        notificationButton?.setAttribute(
            'aria-expanded',
            'false'
        );


        notificationDropdown?.setAttribute(
            'aria-hidden',
            'true'
        );

    }


    /* =====================================================
       OPEN PROFILE
    ====================================================== */

    function openProfileDropdown() {

        if (!profileWrapper) {
            return;
        }


        profileWrapper.classList.add(
            'is-open'
        );


        profileButton?.setAttribute(
            'aria-expanded',
            'true'
        );


        profileDropdown?.setAttribute(
            'aria-hidden',
            'false'
        );


        closeNotifications();

        closeMobileSections();

    }


    /* =====================================================
       CLOSE PROFILE
    ====================================================== */

    function closeProfileDropdown() {

        if (!profileWrapper) {
            return;
        }


        profileWrapper.classList.remove(
            'is-open'
        );


        profileButton?.setAttribute(
            'aria-expanded',
            'false'
        );


        profileDropdown?.setAttribute(
            'aria-hidden',
            'true'
        );

    }


    /* =====================================================
       NOTIFICATION BUTTON
    ====================================================== */

    if (notificationButton) {

        notificationButton.addEventListener(
            'click',
            function (event) {

                event.preventDefault();

                event.stopPropagation();


                if (
                    notificationWrapper.classList.contains(
                        'is-open'
                    )
                ) {

                    closeNotifications();

                } else {

                    openNotifications();

                }

            }
        );

    }


    /* =====================================================
       NOTIFICATION DROPDOWN CLICK
    ====================================================== */

    if (notificationDropdown) {

        notificationDropdown.addEventListener(
            'click',
            function (event) {

                event.stopPropagation();

            }
        );

    }


    /* =====================================================
       PROFILE BUTTON
    ====================================================== */

    if (profileButton) {

        profileButton.addEventListener(
            'click',
            function (event) {

                event.preventDefault();

                event.stopPropagation();


                if (
                    profileWrapper.classList.contains(
                        'is-open'
                    )
                ) {

                    closeProfileDropdown();

                } else {

                    openProfileDropdown();

                }

            }
        );

    }


    /* =====================================================
       PROFILE DROPDOWN CLICK
    ====================================================== */

    if (profileDropdown) {

        profileDropdown.addEventListener(
            'click',
            function (event) {

                event.stopPropagation();

            }
        );

    }


    /* =====================================================
       DOCUMENT CLICK
    ====================================================== */

    document.addEventListener(
        'click',
        function () {

            closeNotifications();

            closeProfileDropdown();

            closeMobileSections();

        }
    );


    /* =====================================================
       ESCAPE
    ====================================================== */

    document.addEventListener(
        'keydown',
        function (event) {

            if (
                event.key !== 'Escape'
            ) {

                return;

            }


            closeNotifications();

            closeProfileDropdown();

            closeMobileSections();

        }
    );


    /* =====================================================
       RENDER NOTIFICATIONS
    ====================================================== */

    function renderNotifications(notifications) {

        if (!notificationList) {
            return;
        }


        if (
            !notifications ||
            notifications.length === 0
        ) {

            notificationList.innerHTML = `

                <div
                    class="
                        education-admin-notifications-empty
                    "
                >

                    <i
                        class="
                            fa-regular
                            fa-bell-slash
                        "
                    ></i>

                    <span>
                        ${escapeHtml(
                            educationAdminTranslations.noNotifications
                        )}
                    </span>

                </div>

            `;

            return;

        }


        notificationList.innerHTML =

            notifications
                .map(function (notification) {


                    const unreadClass =
                        notification.is_read
                            ? ''
                            : 'is-unread';


                    const icon =
                        notification.icon
                            ||
                        'fa-regular fa-bell';


                    const title =
                        escapeHtml(
                            notification.title
                        );


                    const message =
                        escapeHtml(
                            notification.message
                        );


                    const createdAt =
                        escapeHtml(
                            notification.created_at
                                || ''
                        );


                    const url =
                        notification.url
                            ? escapeHtml(
                                notification.url
                            )
                            : '#';


                    const unreadDot =
                        notification.is_read
                            ? ''
                            : `

                                <span
                                    class="
                                        education-admin-notification-unread-dot
                                    "
                                ></span>

                            `;


                    return `

                        <a
                            href="${url}"
                            class="
                                education-admin-notification-item
                                ${unreadClass}
                            "
                            data-notification-id="${notification.id}"
                        >

                            <span
                                class="
                                    education-admin-notification-icon
                                "
                            >

                                <i
                                    class="${escapeHtml(icon)}"
                                ></i>

                            </span>


                            <span
                                class="
                                    education-admin-notification-content
                                "
                            >

                                <strong>
                                    ${title}
                                </strong>


                                <p>
                                    ${message}
                                </p>


                                <time>
                                    ${createdAt}
                                </time>

                            </span>


                            ${unreadDot}

                        </a>

                    `;

                })
                .join('');


        notificationList
            .querySelectorAll(
                '[data-notification-id]'
            )
            .forEach(function (item) {

                item.addEventListener(
                    'click',
                    function (event) {

                        event.preventDefault();


                        const notificationId =
                            item.getAttribute(
                                'data-notification-id'
                            );


                        const targetUrl =
                            item.getAttribute(
                                'href'
                            );


                        markNotificationAsRead(
                            notificationId
                        )
                        .finally(function () {

                            if (
                                targetUrl &&
                                targetUrl !== '#'
                            ) {

                                window.location.href =
                                    targetUrl;

                            }

                        });

                    }
                );

            });

    }


    /* =====================================================
       LOAD NOTIFICATIONS
    ====================================================== */

    async function loadNotifications() {

        try {

            const response =
                await fetch(
                    notificationDataUrl,
                    {
                        method: 'GET',

                        headers: {

                            'Accept':
                                'application/json',

                            'X-Requested-With':
                                'XMLHttpRequest',

                        },

                        credentials:
                            'same-origin',

                        cache:
                            'no-store',

                    }
                );


            if (!response.ok) {

                throw new Error(
                    'Notification request failed.'
                );

            }


            const data =
                await response.json();


            if (!data.success) {

                return;

            }


            updateNotificationBadges(
                data.unread_count
            );


            renderNotifications(
                data.notifications
            );


        } catch (error) {

            console.error(
                'Education Admin Notifications Error:',
                error
            );

        }

    }


    /* =====================================================
       MARK ONE AS READ
    ====================================================== */

    async function markNotificationAsRead(
        notificationId
    ) {

        const url =
            notificationReadUrlTemplate.replace(
                '__NOTIFICATION__',
                notificationId
            );


        try {

            const response =
                await fetch(
                    url,
                    {
                        method: 'PATCH',

                        headers: {

                            'Accept':
                                'application/json',

                            'X-Requested-With':
                                'XMLHttpRequest',

                            'X-CSRF-TOKEN':
                                csrfToken,

                        },

                        credentials:
                            'same-origin',

                    }
                );


            if (!response.ok) {

                throw new Error(
                    'Unable to mark notification as read.'
                );

            }


            const data =
                await response.json();


            if (data.success) {

                updateNotificationBadges(
                    data.unread_count
                );

            }


            return data;


        } catch (error) {

            console.error(
                'Mark Notification As Read Error:',
                error
            );


            return {
                success: false
            };

        }

    }


    /* =====================================================
       MARK ALL AS READ
    ====================================================== */

    if (readAllButton) {

        readAllButton.addEventListener(
            'click',
            async function (event) {

                event.preventDefault();

                event.stopPropagation();


                try {

                    const response =
                        await fetch(
                            notificationReadAllUrl,
                            {
                                method: 'PATCH',

                                headers: {

                                    'Accept':
                                        'application/json',

                                    'X-Requested-With':
                                        'XMLHttpRequest',

                                    'X-CSRF-TOKEN':
                                        csrfToken,

                                },

                                credentials:
                                    'same-origin',

                            }
                        );


                    if (!response.ok) {

                        throw new Error(
                            'Unable to mark all notifications as read.'
                        );

                    }


                    const data =
                        await response.json();


                    if (data.success) {

                        updateNotificationBadges(
                            0
                        );


                        await loadNotifications();

                    }


                } catch (error) {

                    console.error(
                        'Mark All Notifications As Read Error:',
                        error
                    );

                }

            }
        );

    }


    /* =====================================================
       INITIAL LOAD
    ====================================================== */

    loadNotifications();


    /* =====================================================
       AUTO REFRESH
    ====================================================== */

    setInterval(
        function () {

            loadNotifications();

        },
        15000
    );


    /* =====================================================
       PROFILE LINKS
    ====================================================== */

    if (profileDropdown) {

        profileDropdown
            .querySelectorAll('a')
            .forEach(function (link) {

                link.addEventListener(
                    'click',
                    function () {

                        closeProfileDropdown();

                    }
                );

            });

    }


});
</script>

