{{-- =========================================================
EDUCATION STUDENT NAVIGATION
Student Area Only
========================================================= --}}

@auth('education')

@php

    $studentNavigationCurrentRoute =
        request()->route()?->getName();

    /*
    |--------------------------------------------------------------------------
    | STUDENT NOTIFICATIONS
    |--------------------------------------------------------------------------
    */

    $educationStudentNotifications = collect();

    $educationStudentUnreadNotificationsCount = 0;

    try {

        $educationStudent =
            auth('education')->user();

        if ($educationStudent) {

            $notificationsQuery =
                EducationUserNotification::query()
                    ->where(
                        'education_user_id',
                        $educationStudent->id
                    );


            /*
            |--------------------------------------------------------------------------
            | TOTAL UNREAD COUNT
            |--------------------------------------------------------------------------
            */

            $educationStudentUnreadNotificationsCount =
                (clone $notificationsQuery)
                    ->whereNull('read_at')
                    ->count();


            /*
            |--------------------------------------------------------------------------
            | LATEST NOTIFICATIONS
            |--------------------------------------------------------------------------
            */

            $educationStudentNotifications =
                (clone $notificationsQuery)
                    ->latest()
                    ->limit(10)
                    ->get();

        }

    } catch (\Throwable $e) {

        $educationStudentNotifications =
            collect();

        $educationStudentUnreadNotificationsCount =
            0;

    }

@endphp


<div class="education-student-navigation-wrapper">

    <nav
        class="education-student-navigation"
        aria-label="{{ __('education.student_navigation.aria_label') }}"
    >


        {{-- =====================================================
            BRAND
        ====================================================== --}}

        <a
            href="{{ Route::has('education.dashboard')
                ? route('education.dashboard')
                : url('/education/dashboard') }}"
            class="education-student-navigation-brand"
        >

            <div class="education-student-navigation-brand-icon">

                <i class="fa-solid fa-graduation-cap"></i>

            </div>


            <div class="education-student-navigation-brand-text">

                <strong>
                    {{ __('education.student_navigation.brand') }}
                </strong>

                <span>
                    {{ __('education.student_navigation.welcome', ['name' => auth('education')->user()?->name]) }}
                </span>

            </div>

        </a>


        {{-- =====================================================
            DESKTOP MENU
        ====================================================== --}}

        <div class="education-student-navigation-menu">


            {{-- DASHBOARD --}}

            <a
                href="{{ Route::has('education.dashboard')
                    ? route('education.dashboard')
                    : url('/education/dashboard') }}"
                class="education-student-navigation-link
                    {{ in_array(
                        $studentNavigationCurrentRoute,
                        [
                            'education.dashboard',
                            'education.student.dashboard'
                        ],
                        true
                    ) ? 'active' : '' }}"
            >

                <i class="fa-solid fa-house"></i>

                <span>
                    {{ __('education.student_navigation.dashboard') }}
                </span>

            </a>


            {{-- LESSONS --}}

            <a
                href="{{ Route::has('education.student.lessons.index')
                    ? route('education.student.lessons.index')
                    : url('/education/lessons') }}"
                class="education-student-navigation-link
                    {{ in_array(
                        $studentNavigationCurrentRoute,
                        [
                            'education.student.lessons.index',
                            'education.student.lessons.show'
                        ],
                        true
                    ) ? 'active' : '' }}"
            >

                <i class="fa-solid fa-book-open"></i>

                <span>
                    {{ __('education.student_navigation.lessons') }}
                </span>

            </a>


            {{-- =================================================
                QUIZZES
            ================================================== --}}

            @if (Route::has('education.student.quizzes.index'))

                <a
                    href="{{ route(
                        'education.student.quizzes.index'
                    ) }}"
                    class="education-student-navigation-link
                        {{ request()->routeIs(
                            'education.student.quizzes.*'
                        ) ? 'active' : '' }}"
                >

                    <i class="fa-solid fa-clipboard-question"></i>

                    <span>
                        {{ __('education.student_navigation.quizzes') }}
                    </span>

                </a>

            @elseif (Route::has('education.quizzes.index'))

                <a
                    href="{{ route(
                        'education.quizzes.index'
                    ) }}"
                    class="education-student-navigation-link
                        {{ request()->routeIs(
                            'education.quizzes.*'
                        ) ? 'active' : '' }}"
                >

                    <i class="fa-solid fa-clipboard-question"></i>

                    <span>
                        {{ __('education.student_navigation.quizzes') }}
                    </span>

                </a>

            @endif


            {{-- =================================================
                CONVERSATIONS
            ================================================== --}}

            @if (Route::has('education.conversations.index'))

                <a
                    href="{{ route(
                        'education.conversations.index'
                    ) }}"
                    class="education-student-navigation-link
                        {{ request()->routeIs(
                            'education.conversations.*'
                        ) ? 'active' : '' }}"
                >

                    <i class="fa-regular fa-comments"></i>

                    <span>
                        {{ __('education.student_navigation.messages') }}
                    </span>

                </a>

            @endif


        </div>


        {{-- =====================================================
            MOBILE MENU BUTTON
        ====================================================== --}}

        <button
            type="button"
            class="education-student-navigation-mobile-button"
            id="educationStudentNavigationMobileButton"
            aria-label="{{ __('education.student_navigation.mobile_menu_open') }}"
            aria-expanded="false"
        >

            <i class="fa-solid fa-bars"></i>

        </button>


        {{-- =====================================================
            NOTIFICATIONS
        ====================================================== --}}

        <div
            class="education-student-navigation-notifications"
        >

            <button
                type="button"
                class="education-student-notification-button
                    {{ $educationStudentUnreadNotificationsCount > 0
                        ? 'has-unread'
                        : '' }}"
                id="educationStudentNotificationButton"
                aria-label="{{ __('education.student_navigation.notifications') }}"
                aria-expanded="false"
                aria-haspopup="true"
            >

                <i class="fa-regular fa-bell"></i>


                {{-- =================================================
                    UNREAD BADGE
                ================================================== --}}

                <span
                    class="education-student-notification-badge"
                    id="educationStudentNotificationBadge"
                    style="{{ $educationStudentUnreadNotificationsCount > 0
                        ? ''
                        : 'display: none;' }}"
                >

                    {{ $educationStudentUnreadNotificationsCount > 99
                        ? '99+'
                        : $educationStudentUnreadNotificationsCount }}

                </span>

            </button>


            {{-- =================================================
                NOTIFICATION DROPDOWN
            ================================================== --}}

            <div
                class="education-student-notifications-dropdown"
                id="educationStudentNotificationsDropdown"
                aria-hidden="true"
            >


                {{-- HEADER --}}

                <div
                    class="education-student-notifications-header"
                >

                    <div>

                        <strong>
                            {{ __('education.student_navigation.notifications') }}
                        </strong>

                        <span>
                            {{ __('education.student_navigation.your_notifications') }}
                        </span>

                    </div>


                    {{-- =================================================
                        MARK ALL FORM
                    ================================================== --}}

                    @if (
                        Route::has(
                            'education.notifications.read_all'
                        )
                    )

                        <form
                            method="POST"
                            action="{{ route(
                                'education.notifications.read_all'
                            ) }}"
                            class="education-student-mark-all-form"
                            id="educationStudentMarkAllForm"
                            style="{{ $educationStudentUnreadNotificationsCount > 0
                                ? ''
                                : 'display: none;' }}"
                        >

                            @csrf

                            @method('PATCH')

                            <button
                                type="submit"
                                class="education-student-mark-all-button"
                            >

                                <i class="fa-solid fa-check-double"></i>

                                {{ __('education.student_navigation.mark_all_read') }}

                            </button>

                        </form>

                    @endif

                </div>


                {{-- =================================================
                    NOTIFICATIONS LIST
                ================================================== --}}

                <div
                    class="education-student-notifications-list"
                    id="educationStudentNotificationsList"
                >

                    @forelse (
                        $educationStudentNotifications
                        as $notification
                    )

                        @php

                            $notificationTitle =
                                $notification->title
                                ?? __('education.student_navigation.new_notification');


                            $notificationMessage =
                                $notification->message
                                ?? '';


                            $notificationIcon =
                                $notification->icon
                                ?? 'fa-bell';


                            $notificationUrl =
                                $notification->url
                                ?? null;


                            $notificationIsUnread =
                                is_null(
                                    $notification->read_at
                                );


                            $isFontAwesomeIcon =
                                is_string(
                                    $notificationIcon
                                )
                                &&
                                str_starts_with(
                                    $notificationIcon,
                                    'fa-'
                                );

                        @endphp


                        <div
                            class="education-student-notification-item
                                {{ $notificationIsUnread
                                    ? 'unread'
                                    : 'read' }}"
                            data-notification-id="{{ $notification->id }}"
                        >

                            <div
                                class="education-student-notification-icon"
                            >

                                @if ($isFontAwesomeIcon)

                                    <i
                                        class="fa-solid {{ $notificationIcon }}"
                                    ></i>

                                @else

                                    <span
                                        style="font-size:16px;"
                                    >
                                        {{ $notificationIcon }}
                                    </span>

                                @endif

                            </div>


                            <div
                                class="education-student-notification-content"
                            >

                                <div
                                    class="education-student-notification-title-row"
                                >

                                    <strong>
                                        {{ $notificationTitle }}
                                    </strong>

                                    @if ($notificationIsUnread)

                                        <span
                                            class="education-student-notification-new"
                                        >
                                            جديد
                                        </span>

                                    @endif

                                </div>


                                @if ($notificationMessage !== '')

                                    <p>
                                        {{ $notificationMessage }}
                                    </p>

                                @endif


                                <div
                                    class="education-student-notification-meta"
                                >

                                    <span>

                                        <i
                                            class="fa-regular fa-clock"
                                        ></i>

                                        {{ optional(
                                            $notification->created_at
                                        )->diffForHumans() }}

                                    </span>


                                    @if (
                                        $notificationIsUnread &&
                                        Route::has(
                                            'education.notifications.read'
                                        )
                                    )

                                        <form
                                            method="POST"
                                            action="{{ route(
                                                'education.notifications.read',
                                                $notification->id
                                            ) }}"
                                            class="education-student-notification-read-form"
                                        >

                                            @csrf

                                            @method('PATCH')

                                            <button
                                                type="submit"
                                                class="education-student-notification-read-button"
                                                title="{{ __('education.student_navigation.mark_as_read') }}"
                                                aria-label="{{ __('education.student_navigation.mark_as_read') }}"
                                            >

                                                <i
                                                    class="fa-solid fa-check"
                                                ></i>

                                            </button>

                                        </form>

                                    @endif

                                </div>


                                {{-- OPTIONAL NOTIFICATION LINK --}}

                                @if ($notificationUrl)

                                    <a
                                        href="{{ $notificationUrl }}"
                                        class="education-student-notification-link"
                                    >

                                        عرض التفاصيل

                                        <i
                                            class="fa-solid fa-arrow-left"
                                        ></i>

                                    </a>

                                @endif

                            </div>

                        </div>

                    @empty

                        <div
                            class="education-student-notifications-empty"
                            id="educationStudentNotificationsEmpty"
                        >

                            <div
                                class="education-student-notifications-empty-icon"
                            >

                                <i class="fa-regular fa-bell"></i>

                            </div>


                            <strong>
                                {{ __('education.student_navigation.empty.title') }}
                            </strong>


                            <p>
                                {{ __('education.student_navigation.empty.description') }}
                                واختباراتك ومواعيدك.
                            </p>

                        </div>

                    @endforelse

                </div>


                {{-- =================================================
                    VIEW ALL NOTIFICATIONS
                ================================================== --}}

                @if (
                    Route::has(
                        'education.notifications.index'
                    )
                )

                    <div
                        class="education-student-notifications-footer"
                    >

                        <a
                            href="{{ route(
                                'education.notifications.index'
                            ) }}"
                        >

                            {{ __('education.student_navigation.view_all') }}

                            <i
                                class="fa-solid fa-arrow-left"
                            ></i>

                        </a>

                    </div>

                @endif

            </div>

        </div>

    </nav>


    {{-- =========================================================
        MOBILE NAVIGATION MENU
    ========================================================== --}}

    <div
        class="education-student-navigation-mobile-menu"
        id="educationStudentNavigationMobileMenu"
    >


        {{-- DASHBOARD --}}

        <a
            href="{{ Route::has('education.dashboard')
                ? route('education.dashboard')
                : url('/education/dashboard') }}"
            class="education-student-navigation-link
                {{ in_array(
                    $studentNavigationCurrentRoute,
                    [
                        'education.dashboard',
                        'education.student.dashboard'
                    ],
                    true
                ) ? 'active' : '' }}"
        >

            <i class="fa-solid fa-house"></i>

            <span>
                {{ __('education.student_navigation.dashboard') }}
            </span>

        </a>


        {{-- LESSONS --}}

        <a
            href="{{ Route::has('education.student.lessons.index')
                ? route('education.student.lessons.index')
                : url('/education/lessons') }}"
            class="education-student-navigation-link
                {{ request()->routeIs(
                    'education.student.lessons.*'
                ) ? 'active' : '' }}"
        >

            <i class="fa-solid fa-book-open"></i>

            <span>
                {{ __('education.student_navigation.lessons') }}
            </span>

        </a>


        {{-- QUIZZES --}}

        @if (Route::has('education.student.quizzes.index'))

            <a
                href="{{ route(
                    'education.student.quizzes.index'
                ) }}"
                class="education-student-navigation-link
                    {{ request()->routeIs(
                        'education.student.quizzes.*'
                    ) ? 'active' : '' }}"
            >

                <i class="fa-solid fa-clipboard-question"></i>

                <span>
                    {{ __('education.student_navigation.quizzes') }}
                </span>

            </a>

        @elseif (Route::has('education.quizzes.index'))

            <a
                href="{{ route(
                    'education.quizzes.index'
                ) }}"
                class="education-student-navigation-link
                    {{ request()->routeIs(
                        'education.quizzes.*'
                    ) ? 'active' : '' }}"
            >

                <i class="fa-solid fa-clipboard-question"></i>

                <span>
                    {{ __('education.student_navigation.quizzes') }}
                </span>

            </a>

        @endif


        {{-- CONVERSATIONS --}}

        @if (Route::has('education.conversations.create'))

            <a
                href="{{ route(
                    'education.conversations.create'
                ) }}"
                class="education-student-navigation-link
                    {{ request()->routeIs(
                        'education.conversations.*'
                    ) ? 'active' : '' }}"
            >

                <i class="fa-regular fa-comments"></i>

                <span>
                    {{ __('education.student_navigation.messages') }}
                </span>

            </a>

        @endif


        {{-- MOBILE NOTIFICATIONS --}}

        @if (Route::has('education.notifications.index'))

            <a
                href="{{ route(
                    'education.notifications.index'
                ) }}"
                class="education-student-navigation-link
                    {{ request()->routeIs(
                        'education.notifications.*'
                    ) ? 'active' : '' }}"
            >

                <i class="fa-regular fa-bell"></i>

                <span>
                    الإشعارات
                </span>

                <span
                    class="education-student-mobile-notification-count"
                    id="educationStudentMobileNotificationCount"
                    style="{{ $educationStudentUnreadNotificationsCount > 0
                        ? ''
                        : 'display: none;' }}"
                >

                    {{ $educationStudentUnreadNotificationsCount > 99
                        ? '99+'
                        : $educationStudentUnreadNotificationsCount }}

                </span>

            </a>

        @endif


    </div>

</div>


{{-- =========================================================
    STUDENT NAVIGATION STYLES
========================================================== --}}

<style>

    .education-student-navigation-wrapper {

        width: 100%;

        padding: 0 24px;

        box-sizing: border-box;

        position: relative;

        z-index: 5000;

    }


    .education-student-navigation {

        width: min(1180px, 100%);

        min-height: 68px;

        margin: 0 auto;

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 20px;

        padding: 8px 12px;

        box-sizing: border-box;

        background:
            rgba(255, 253, 248, .96);

        border:
            1px solid #e6ddc8;

        border-radius:
            0 0 18px 18px;

        box-shadow:
            0 8px 25px rgba(48, 55, 42, .08);

        backdrop-filter:
            blur(14px);

        -webkit-backdrop-filter:
            blur(14px);

    }


    /* =========================================================
       BRAND
    ========================================================= */

    .education-student-navigation-brand {

        display: flex;

        align-items: center;

        gap: 11px;

        flex-shrink: 0;

        text-decoration: none;

        color: #30372a;

    }


    .education-student-navigation-brand-icon {

        width: 42px;

        height: 42px;

        border-radius: 12px;

        display: flex;

        align-items: center;

        justify-content: center;

        background: #596346;

        color: #fff;

        box-shadow:
            0 6px 15px rgba(89, 99, 70, .18);

    }


    .education-student-navigation-brand-icon i {

        font-size: 17px;

    }


    .education-student-navigation-brand-text {

        display: flex;

        flex-direction: column;

        gap: 1px;

        line-height: 1.4;

    }


    .education-student-navigation-brand-text strong {

        color: #30372a;

        font-size: 14px;

        font-weight: 800;

    }


    .education-student-navigation-brand-text span {

        color: #999488;

        font-size: 10px;

        font-weight: 500;

    }


    /* =========================================================
       DESKTOP MENU
    ========================================================= */

    .education-student-navigation-menu {

        flex: 1;

        display: flex;

        align-items: center;

        justify-content: center;

        gap: 5px;

        min-width: 0;

    }


    .education-student-navigation-link {

        position: relative;

        min-height: 46px;

        padding: 0 14px;

        display: inline-flex;

        align-items: center;

        justify-content: center;

        gap: 8px;

        border-radius: 11px;

        color: #6f7166;

        background: transparent;

        text-decoration: none;

        font-size: 12px;

        font-weight: 700;

        white-space: nowrap;

        transition:
            color .2s ease,
            background .2s ease,
            transform .2s ease;

    }


    .education-student-navigation-link i {

        font-size: 14px;

        transition:
            transform .2s ease;

    }


    .education-student-navigation-link:hover {

        color: #235d70;

        background: #eef3f4;

    }


    .education-student-navigation-link:hover i {

        transform:
            translateY(-1px);

    }


    .education-student-navigation-link.active {

        color: #235d70;

        background: #e8f0f2;

    }


    .education-student-navigation-link.active::after {

        content: "";

        position: absolute;

        right: 14px;

        left: 14px;

        bottom: 4px;

        height: 2px;

        border-radius: 999px;

        background: #9a7b2f;

    }


    /* =========================================================
       NOTIFICATIONS
    ========================================================= */

    .education-student-navigation-notifications {

        position: relative;

        flex-shrink: 0;

    }


    .education-student-notification-button {

        position: relative;

        width: 45px;

        height: 45px;

        padding: 0;

        border:
            1px solid #e2dac6;

        border-radius: 12px;

        display: flex;

        align-items: center;

        justify-content: center;

        background: #faf7ee;

        color: #235d70;

        cursor: pointer;

        transition:
            background .2s ease,
            color .2s ease,
            border-color .2s ease,
            transform .2s ease;

    }


    .education-student-notification-button:hover,
    .education-student-notification-button.has-unread {

        border-color: #235d70;

    }


    .education-student-notification-button:hover {

        background: #235d70;

        color: #fff;

        transform:
            translateY(-1px);

    }


    .education-student-notification-button.has-unread
    i {

        animation:
            educationStudentBellPulse 2s ease-in-out infinite;

    }


    @keyframes educationStudentBellPulse {

        0%,
        100% {

            transform:
                rotate(0deg);

        }

        15% {

            transform:
                rotate(10deg);

        }

        30% {

            transform:
                rotate(-10deg);

        }

        45% {

            transform:
                rotate(6deg);

        }

        60% {

            transform:
                rotate(-4deg);

        }

        75% {

            transform:
                rotate(0deg);

        }

    }


    .education-student-notification-button i {

        font-size: 16px;

    }


    .education-student-notification-badge {

        position: absolute;

        top: -5px;

        left: -5px;

        min-width: 18px;

        height: 18px;

        padding: 0 4px;

        box-sizing: border-box;

        display: flex;

        align-items: center;

        justify-content: center;

        border-radius: 999px;

        background: #9a7b2f;

        color: #fff;

        border:
            2px solid #fffdf8;

        font-size: 9px;

        font-weight: 800;

        transition:
            opacity .2s ease,
            transform .2s ease;

    }


    /*
    |--------------------------------------------------------------------------
    | لا نخفي الـBadge عند فتح القائمة.
    |--------------------------------------------------------------------------
    */

    .education-student-notification-badge.hidden-by-open {

        opacity: 1;

        transform:
            scale(1);

        pointer-events: auto;

    }


    /* =========================================================
       NOTIFICATIONS DROPDOWN
    ========================================================= */

    .education-student-notifications-dropdown {

        position: absolute;

        top: calc(100% + 12px);

        left: 0;

        width: 350px;

        max-width: calc(100vw - 32px);

        background: #fffdf8;

        border:
            1px solid #e5ddca;

        border-radius: 16px;

        box-shadow:
            0 16px 45px rgba(48, 55, 42, .14);

        overflow: hidden;

        opacity: 0;

        visibility: hidden;

        pointer-events: none;

        transform:
            translateY(-8px);

        transition:
            opacity .2s ease,
            visibility .2s ease,
            transform .2s ease;

        z-index: 6000;

    }


    .education-student-notifications-dropdown.show {

        opacity: 1;

        visibility: visible;

        pointer-events: auto;

        transform:
            translateY(0);

    }


    /* =========================================================
       NOTIFICATION HEADER
    ========================================================= */

    .education-student-notifications-header {

        padding: 14px 16px;

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 10px;

        background: #faf7ee;

        border-bottom:
            1px solid #e9e1cf;

    }


    .education-student-notifications-header > div {

        display: flex;

        flex-direction: column;

        gap: 2px;

    }


    .education-student-notifications-header strong {

        color: #30372a;

        font-size: 13px;

        font-weight: 800;

    }


    .education-student-notifications-header span {

        color: #9a7b2f;

        font-size: 10px;

        font-weight: 700;

    }


    .education-student-mark-all-form {

        margin: 0;

    }


    .education-student-mark-all-button {

        border: 0;

        background: transparent;

        color: #235d70;

        font-family: inherit;

        font-size: 10px;

        font-weight: 800;

        cursor: pointer;

        display: inline-flex;

        align-items: center;

        gap: 5px;

        padding: 5px;

    }


    .education-student-mark-all-button:hover {

        color: #9a7b2f;

    }


    /* =========================================================
       NOTIFICATION LIST
    ========================================================= */

    .education-student-notifications-list {

        max-height: 390px;

        overflow-y: auto;

    }


    .education-student-notifications-list::-webkit-scrollbar {

        width: 5px;

    }


    .education-student-notifications-list::-webkit-scrollbar-thumb {

        background: #d8cfba;

        border-radius: 999px;

    }


    /* =========================================================
       NOTIFICATION ITEM
    ========================================================= */

    .education-student-notification-item {

        display: flex;

        gap: 11px;

        padding: 14px 15px;

        border-bottom:
            1px solid #eee8da;

        transition:
            background .2s ease;

    }


    .education-student-notification-item:hover {

        background: #fbf8f0;

    }


    .education-student-notification-item:last-child {

        border-bottom: 0;

    }


    .education-student-notification-item.unread {

        background: #f7f9f6;

    }


    .education-student-notification-icon {

        width: 36px;

        height: 36px;

        flex: 0 0 36px;

        border-radius: 10px;

        display: flex;

        align-items: center;

        justify-content: center;

        background: #eef3f4;

        color: #235d70;

    }


    .education-student-notification-item.unread
    .education-student-notification-icon {

        background: #e8f0f2;

    }


    .education-student-notification-icon i {

        font-size: 13px;

    }


    .education-student-notification-content {

        min-width: 0;

        flex: 1;

    }


    .education-student-notification-title-row {

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 8px;

    }


    .education-student-notification-title-row strong {

        color: #3e4238;

        font-size: 12px;

        font-weight: 800;

        line-height: 1.5;

    }


    .education-student-notification-new {

        flex-shrink: 0;

        padding: 2px 6px;

        border-radius: 999px;

        background: #9a7b2f;

        color: #fff;

        font-size: 8px;

        font-weight: 800;

    }


    .education-student-notification-content p {

        margin:
            4px 0 6px;

        color: #858477;

        font-size: 10px;

        line-height: 1.7;

    }


    .education-student-notification-meta {

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 8px;

    }


    .education-student-notification-meta > span {

        color: #aaa69b;

        font-size: 9px;

        display: inline-flex;

        align-items: center;

        gap: 4px;

    }


    .education-student-notification-read-form {

        margin: 0;

    }


    .education-student-notification-read-button {

        width: 25px;

        height: 25px;

        padding: 0;

        border:
            1px solid #ddd5c2;

        border-radius: 7px;

        background: #fffdf8;

        color: #596346;

        cursor: pointer;

        display: flex;

        align-items: center;

        justify-content: center;

        transition:
            background .2s ease,
            color .2s ease,
            border-color .2s ease;

    }


    .education-student-notification-read-button:hover {

        background: #596346;

        color: #fff;

        border-color: #596346;

    }


    .education-student-notification-link {

        margin-top: 5px;

        color: #235d70;

        text-decoration: none;

        font-size: 9px;

        font-weight: 800;

        display: inline-flex;

        align-items: center;

        gap: 5px;

    }


    .education-student-notification-link:hover {

        color: #9a7b2f;

    }


    /* =========================================================
       EMPTY STATE
    ========================================================= */

    .education-student-notifications-empty {

        padding: 30px 20px;

        text-align: center;

    }


    .education-student-notifications-empty-icon {

        width: 48px;

        height: 48px;

        margin:
            0 auto 12px;

        border-radius: 50%;

        display: flex;

        align-items: center;

        justify-content: center;

        background: #eef3f4;

        color: #235d70;

    }


    .education-student-notifications-empty-icon i {

        font-size: 17px;

    }


    .education-student-notifications-empty strong {

        display: block;

        color: #4a4e41;

        font-size: 13px;

        font-weight: 800;

    }


    .education-student-notifications-empty p {

        margin:
            5px 0 0;

        color: #989589;

        font-size: 11px;

        line-height: 1.7;

    }


    /* =========================================================
       NOTIFICATIONS FOOTER
    ========================================================= */

    .education-student-notifications-footer {

        padding: 10px 15px;

        background: #faf7ee;

        border-top:
            1px solid #e9e1cf;

        text-align: center;

    }


    .education-student-notifications-footer a {

        color: #235d70;

        text-decoration: none;

        font-size: 10px;

        font-weight: 800;

        display: inline-flex;

        align-items: center;

        gap: 6px;

    }


    .education-student-notifications-footer a:hover {

        color: #9a7b2f;

    }


    /* =========================================================
       MOBILE BUTTON
    ========================================================= */

    .education-student-navigation-mobile-button {

        display: none;

        width: 45px;

        height: 45px;

        padding: 0;

        border:
            1px solid #e2dac6;

        border-radius: 12px;

        align-items: center;

        justify-content: center;

        background: #faf7ee;

        color: #235d70;

        cursor: pointer;

    }


    /* =========================================================
       MOBILE MENU
    ========================================================= */

    .education-student-navigation-mobile-menu {

        display: none;

    }


    .education-student-mobile-notification-count {

        min-width: 18px;

        height: 18px;

        padding: 0 5px;

        box-sizing: border-box;

        border-radius: 999px;

        display: inline-flex;

        align-items: center;

        justify-content: center;

        background: #9a7b2f;

        color: #fff;

        font-size: 8px;

        font-weight: 800;

        margin-right: auto;

    }


    /* =========================================================
       TABLET
    ========================================================= */

    @media (max-width: 900px) {

        .education-student-navigation {

            gap: 10px;

        }


        .education-student-navigation-menu {

            gap: 2px;

        }


        .education-student-navigation-link {

            padding:
                0 9px;

        }


        .education-student-navigation-link span {

            display: none;

        }


        .education-student-navigation-link i {

            font-size: 16px;

        }

    }


    /* =========================================================
       MOBILE
    ========================================================= */

    @media (max-width: 650px) {

        .education-student-navigation-wrapper {

            padding:
                0 12px;

        }


        .education-student-navigation {

            min-height: 62px;

            padding: 7px;

            border-radius:
                0 0 15px 15px;

        }


        .education-student-navigation-brand-text {

            display: none;

        }


        .education-student-navigation-brand-icon {

            width: 40px;

            height: 40px;

        }


        .education-student-navigation-menu {

            display: none;

        }


        .education-student-navigation-mobile-button {

            display: flex;

        }


        .education-student-navigation-mobile-menu {

            position: absolute;

            top: calc(100% + 8px);

            right: 12px;

            left: 12px;

            padding: 8px;

            background: #fffdf8;

            border:
                1px solid #e5ddca;

            border-radius: 16px;

            box-shadow:
                0 15px 40px rgba(48, 55, 42, .13);

            display: flex;

            flex-direction: column;

            gap: 3px;

            opacity: 0;

            visibility: hidden;

            transform:
                translateY(-8px);

            transition:
                opacity .2s ease,
                visibility .2s ease,
                transform .2s ease;

            z-index: 5500;

        }


        .education-student-navigation-mobile-menu.show {

            opacity: 1;

            visibility: visible;

            transform:
                translateY(0);

        }


        .education-student-navigation-mobile-menu
        .education-student-navigation-link {

            width: 100%;

            min-height: 45px;

            justify-content: flex-start;

            padding:
                0 14px;

            box-sizing: border-box;

        }


        .education-student-navigation-mobile-menu
        .education-student-navigation-link span {

            display: inline;

        }


        .education-student-navigation-mobile-menu
        .education-student-navigation-link.active::after {

            right: 8px;

            left: auto;

            top: 9px;

            bottom: 9px;

            width: 3px;

            height: auto;

        }


        .education-student-notifications-dropdown {

            position: fixed;

            top: 70px;

            left: 12px;

            right: 12px;

            width: auto;

            max-width: none;

        }

    }


    @media (prefers-reduced-motion: reduce) {

        .education-student-navigation *,

        .education-student-navigation-mobile-menu,

        .education-student-notifications-dropdown {

            transition: none !important;

            animation: none !important;

        }

    }

</style>


{{-- =========================================================
    STUDENT NAVIGATION SCRIPT
========================================================== --}}

<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {


        /* =====================================================
           NOTIFICATION ELEMENTS
        ===================================================== */

        const notificationButton =
            document.getElementById(
                'educationStudentNotificationButton'
            );


        const notificationDropdown =
            document.getElementById(
                'educationStudentNotificationsDropdown'
            );


        const notificationBadge =
            document.getElementById(
                'educationStudentNotificationBadge'
            );


        const notificationList =
            document.getElementById(
                'educationStudentNotificationsList'
            );


        const markAllForm =
            document.getElementById(
                'educationStudentMarkAllForm'
            );


        const mobileNotificationCount =
            document.getElementById(
                'educationStudentMobileNotificationCount'
            );


        /*
        |--------------------------------------------------------------------------
        | Stop if notification elements are missing.
        |--------------------------------------------------------------------------
        */

        if (
            !notificationButton ||
            !notificationDropdown
        ) {

            return;

        }


        /* =====================================================
           ROUTES
        ===================================================== */

        const notificationsDataUrl =
            @json(
                route(
                    'education.notifications.data'
                )
            );


        const markAllUrl =
            @json(
                route(
                    'education.notifications.read_all'
                )
            );


        const markReadUrlTemplate =
            @json(
                route(
                    'education.notifications.read',
                    [
                        'notification' =>
                            '__NOTIFICATION_ID__'
                    ]
                )
            );


        const csrfToken =
            @json(csrf_token());


        /* =====================================================
           ESCAPE HTML
        ===================================================== */

        function escapeHtml(value) {

            if (
                value === null ||
                value === undefined
            ) {

                return '';

            }


            const div =
                document.createElement('div');


            div.textContent =
                String(value);


            return div.innerHTML;

        }


        /* =====================================================
           UPDATE BADGE
        ===================================================== */

        function updateNotificationBadge(
            count
        ) {

            count =
                Number(count) || 0;


            /*
            |--------------------------------------------------------------------------
            | Desktop badge
            |--------------------------------------------------------------------------
            */

            if (notificationBadge) {

                if (count > 0) {

                    notificationBadge.textContent =
                        count > 99
                            ? '99+'
                            : String(count);


                    notificationBadge.style.display =
                        'flex';


                    notificationButton.classList.add(
                        'has-unread'
                    );

                } else {

                    notificationBadge.textContent =
                        '0';


                    notificationBadge.style.display =
                        'none';


                    notificationButton.classList.remove(
                        'has-unread'
                    );

                }

            }


            /*
            |--------------------------------------------------------------------------
            | Mobile notification count
            |--------------------------------------------------------------------------
            */

            if (mobileNotificationCount) {

                if (count > 0) {

                    mobileNotificationCount.textContent =
                        count > 99
                            ? '99+'
                            : String(count);


                    mobileNotificationCount.style.display =
                        'inline-flex';

                } else {

                    mobileNotificationCount.textContent =
                        '0';


                    mobileNotificationCount.style.display =
                        'none';

                }

            }

        }


        /* =====================================================
           UPDATE MARK ALL BUTTON
        ===================================================== */

        function updateMarkAllButton(
            unreadCount
        ) {

            if (!markAllForm) {

                return;

            }


            if (
                Number(unreadCount) > 0
            ) {

                markAllForm.style.display =
                    'block';

            } else {

                markAllForm.style.display =
                    'none';

            }

        }


        /* =====================================================
           CREATE NOTIFICATION ITEM
        ===================================================== */

        function createNotificationElement(
            notification
        ) {

            const item =
                document.createElement('div');


            item.className =
                'education-student-notification-item';


            item.dataset.notificationId =
                notification.id;


            /*
            |--------------------------------------------------------------------------
            | Read / Unread
            |--------------------------------------------------------------------------
            */

            if (
                notification.is_read
            ) {

                item.classList.add(
                    'read'
                );

            } else {

                item.classList.add(
                    'unread'
                );

            }


            /*
            |--------------------------------------------------------------------------
            | Icon
            |--------------------------------------------------------------------------
            */

            const iconWrapper =
                document.createElement('div');


            iconWrapper.className =
                'education-student-notification-icon';


            const notificationIcon =
                notification.icon ||
                'fa-bell';


            const cleanIcon =
                String(notificationIcon)
                    .replace(
                        /[^a-zA-Z0-9_\-\s]/g,
                        ''
                    )
                    .trim();


            if (
                cleanIcon.startsWith('fa-')
            ) {

                const icon =
                    document.createElement('i');


                if (
                    cleanIcon.includes(
                        'fa-solid'
                    ) ||
                    cleanIcon.includes(
                        'fa-regular'
                    ) ||
                    cleanIcon.includes(
                        'fa-brands'
                    )
                ) {

                    icon.className =
                        cleanIcon;

                } else {

                    icon.className =
                        'fa-solid ' +
                        cleanIcon;

                }


                iconWrapper.appendChild(
                    icon
                );

            } else {

                const emoji =
                    document.createElement('span');


                emoji.style.fontSize =
                    '16px';


                emoji.textContent =
                    notificationIcon;


                iconWrapper.appendChild(
                    emoji
                );

            }


            /*
            |--------------------------------------------------------------------------
            | Content
            |--------------------------------------------------------------------------
            */

            const content =
                document.createElement('div');


            content.className =
                'education-student-notification-content';


            /*
            |--------------------------------------------------------------------------
            | Title Row
            |--------------------------------------------------------------------------
            */

            const titleRow =
                document.createElement('div');


            titleRow.className =
                'education-student-notification-title-row';


            const title =
                document.createElement('strong');


            title.textContent =
                notification.title ||
                @json(__('education.student_navigation.new_notification'));


            titleRow.appendChild(
                title
            );


            /*
            |--------------------------------------------------------------------------
            | New Badge
            |--------------------------------------------------------------------------
            */

            if (
                !notification.is_read
            ) {

                const newBadge =
                    document.createElement('span');


                newBadge.className =
                    'education-student-notification-new';


                newBadge.textContent =
                    @json(__('education.student_navigation.new'));


                titleRow.appendChild(
                    newBadge
                );

            }


            content.appendChild(
                titleRow
            );


            /*
            |--------------------------------------------------------------------------
            | Message
            |--------------------------------------------------------------------------
            */

            if (
                notification.message
            ) {

                const message =
                    document.createElement('p');


                message.textContent =
                    notification.message;


                content.appendChild(
                    message
                );

            }


            /*
            |--------------------------------------------------------------------------
            | Meta
            |--------------------------------------------------------------------------
            */

            const meta =
                document.createElement('div');


            meta.className =
                'education-student-notification-meta';


            const time =
                document.createElement('span');


            const clock =
                document.createElement('i');


            clock.className =
                'fa-regular fa-clock';


            time.appendChild(
                clock
            );


            const timeText =
                document.createTextNode(
                    ' ' +
                    (
                        notification.created_at ||
                        ''
                    )
                );


            time.appendChild(
                timeText
            );


            meta.appendChild(
                time
            );


            /*
            |--------------------------------------------------------------------------
            | Read Button
            |--------------------------------------------------------------------------
            */

            if (
                !notification.is_read
            ) {

                const readForm =
                    document.createElement('form');


                readForm.method =
                    'POST';


                readForm.className =
                    'education-student-notification-read-form';


                readForm.dataset.notificationId =
                    notification.id;


                const readButton =
                    document.createElement('button');


                readButton.type =
                    'button';


                readButton.className =
                    'education-student-notification-read-button';


                readButton.dataset.notificationId =
                    notification.id;


                readButton.title =
                    @json(__('education.student_navigation.mark_as_read'));


                readButton.setAttribute(
                    'aria-label',
                    @json(__('education.student_navigation.mark_as_read'))
                );


                const check =
                    document.createElement('i');


                check.className =
                    'fa-solid fa-check';


                readButton.appendChild(
                    check
                );


                readForm.appendChild(
                    readButton
                );


                meta.appendChild(
                    readForm
                );

            }


            content.appendChild(
                meta
            );


            /*
            |--------------------------------------------------------------------------
            | Notification Link
            |--------------------------------------------------------------------------
            */

            if (
                notification.url
            ) {

                const link =
                    document.createElement('a');


                link.href =
                    notification.url;


                link.className =
                    'education-student-notification-link';


                link.textContent =
                    @json(__('education.student_navigation.view_details')) + ' ';


                const arrow =
                    document.createElement('i');


                arrow.className =
                    'fa-solid fa-arrow-left';


                link.appendChild(
                    arrow
                );


                content.appendChild(
                    link
                );

            }


            /*
            |--------------------------------------------------------------------------
            | Assemble Item
            |--------------------------------------------------------------------------
            */

            item.appendChild(
                iconWrapper
            );


            item.appendChild(
                content
            );


            return item;

        }


        /* =====================================================
           RENDER NOTIFICATIONS
        ===================================================== */

        function renderNotifications(
            notifications
        ) {

            if (!notificationList) {

                return;

            }


            notificationList.innerHTML =
                '';


            if (
                !notifications ||
                notifications.length === 0
            ) {

                const empty =
                    document.createElement('div');


                empty.className =
                    'education-student-notifications-empty';


                const emptyIcon =
                    document.createElement('div');


                emptyIcon.className =
                    'education-student-notifications-empty-icon';


                const bell =
                    document.createElement('i');


                bell.className =
                    'fa-regular fa-bell';


                emptyIcon.appendChild(
                    bell
                );


                const strong =
                    document.createElement('strong');


                strong.textContent =
                    @json(__('education.student_navigation.empty.title'));


                const paragraph =
                    document.createElement('p');


                paragraph.textContent =
                    '{{ __('education.student_navigation.empty.description') }} واختباراتك ومواعيدك.';


                empty.appendChild(
                    emptyIcon
                );


                empty.appendChild(
                    strong
                );


                empty.appendChild(
                    paragraph
                );


                notificationList.appendChild(
                    empty
                );


                return;

            }


            notifications.forEach(
                function (notification) {

                    notificationList.appendChild(
                        createNotificationElement(
                            notification
                        )
                    );

                }
            );

        }


        /* =====================================================
           LOAD NOTIFICATIONS
        ===================================================== */

        let notificationRequestInProgress =
            false;


        async function loadNotifications() {

            if (
                notificationRequestInProgress
            ) {

                return;

            }


            notificationRequestInProgress =
                true;


            try {

                const response =
                    await fetch(
                        notificationsDataUrl,
                        {
                            method: 'GET',

                            headers: {
                                'Accept':
                                    'application/json',

                                'X-Requested-With':
                                    'XMLHttpRequest'
                            },

                            credentials:
                                'same-origin',

                            cache:
                                'no-store'
                        }
                    );


                if (
                    !response.ok
                ) {

                    return;

                }


                const data =
                    await response.json();


                if (
                    !data.success
                ) {

                    return;

                }


                /*
                |--------------------------------------------------------------------------
                | Update Badge
                |--------------------------------------------------------------------------
                */

                updateNotificationBadge(
                    data.unread_count
                );


                /*
                |--------------------------------------------------------------------------
                | Update Mark All
                |--------------------------------------------------------------------------
                */

                updateMarkAllButton(
                    data.unread_count
                );


                /*
                |--------------------------------------------------------------------------
                | Render List
                |--------------------------------------------------------------------------
                */

                renderNotifications(
                    data.notifications || []
                );


            } catch (error) {

                console.error(
                    'Education student notifications error:',
                    error
                );

            } finally {

                notificationRequestInProgress =
                    false;

            }

        }


        /* =====================================================
           MARK ONE AS READ
        ===================================================== */

        async function markNotificationAsRead(
            notificationId,
            button
        ) {

            if (
                !notificationId
            ) {

                return;

            }


            const url =
                markReadUrlTemplate.replace(
                    '__NOTIFICATION_ID__',
                    notificationId
                );


            if (button) {

                button.disabled =
                    true;

            }


            try {

                const response =
                    await fetch(
                        url,
                        {
                            method: 'PATCH',

                            headers: {

                                'Accept':
                                    'application/json',

                                'Content-Type':
                                    'application/json',

                                'X-CSRF-TOKEN':
                                    csrfToken,

                                'X-Requested-With':
                                    'XMLHttpRequest'

                            },

                            credentials:
                                'same-origin'

                        }
                    );


                if (
                    !response.ok
                ) {

                    if (button) {

                        button.disabled =
                            false;

                    }

                    return;

                }


                const data =
                    await response.json();


                if (
                    !data.success
                ) {

                    if (button) {

                        button.disabled =
                            false;

                    }

                    return;

                }


                /*
                |--------------------------------------------------------------------------
                | Update Badge
                |--------------------------------------------------------------------------
                */

                updateNotificationBadge(
                    data.unread_count
                );


                updateMarkAllButton(
                    data.unread_count
                );


                /*
                |--------------------------------------------------------------------------
                | Update Item
                |--------------------------------------------------------------------------
                */

                const item =
                    document.querySelector(
                        '[data-notification-id="' +
                        notificationId +
                        '"]'
                    );


                if (item) {

                    item.classList.remove(
                        'unread'
                    );


                    item.classList.add(
                        'read'
                    );


                    const newBadge =
                        item.querySelector(
                            '.education-student-notification-new'
                        );


                    if (newBadge) {

                        newBadge.remove();

                    }


                    const readForm =
                        item.querySelector(
                            '.education-student-notification-read-form'
                        );


                    if (readForm) {

                        readForm.remove();

                    }

                }


            } catch (error) {

                console.error(
                    'Mark notification as read error:',
                    error
                );


                if (button) {

                    button.disabled =
                        false;

                }

            }

        }


        /* =====================================================
           INDIVIDUAL READ BUTTON
        ===================================================== */

        if (
            notificationList
        ) {

            notificationList.addEventListener(
                'click',
                function (event) {

                    const button =
                        event.target.closest(
                            '.education-student-notification-read-button'
                        );


                    if (!button) {

                        return;

                    }


                    event.preventDefault();

                    event.stopPropagation();


                    const notificationId =
                        button.dataset.notificationId;


                    markNotificationAsRead(
                        notificationId,
                        button
                    );

                }
            );

        }


        /* =====================================================
           MARK ALL AS READ
        ===================================================== */

        if (
            markAllForm
        ) {

            markAllForm.addEventListener(
                'submit',
                async function (event) {

                    event.preventDefault();


                    const button =
                        markAllForm.querySelector(
                            'button[type="submit"]'
                        );


                    if (button) {

                        button.disabled =
                            true;

                    }


                    try {

                        const response =
                            await fetch(
                                markAllUrl,
                                {
                                    method: 'PATCH',

                                    headers: {

                                        'Accept':
                                            'application/json',

                                        'Content-Type':
                                            'application/json',

                                        'X-CSRF-TOKEN':
                                            csrfToken,

                                        'X-Requested-With':
                                            'XMLHttpRequest'

                                    },

                                    credentials:
                                        'same-origin'

                                }
                            );


                        if (
                            !response.ok
                        ) {

                            if (button) {

                                button.disabled =
                                    false;

                            }

                            return;

                        }


                        const data =
                            await response.json();


                        if (
                            !data.success
                        ) {

                            if (button) {

                                button.disabled =
                                    false;

                            }

                            return;

                        }


                        /*
                        |--------------------------------------------------------------------------
                        | Badge = 0
                        |--------------------------------------------------------------------------
                        */

                        updateNotificationBadge(
                            0
                        );


                        updateMarkAllButton(
                            0
                        );


                        /*
                        |--------------------------------------------------------------------------
                        | Update all visible items
                        |--------------------------------------------------------------------------
                        */

                        if (
                            notificationList
                        ) {

                            notificationList
                                .querySelectorAll(
                                    '.education-student-notification-item'
                                )
                                .forEach(
                                    function (item) {

                                        item.classList.remove(
                                            'unread'
                                        );


                                        item.classList.add(
                                            'read'
                                        );


                                        const newBadge =
                                            item.querySelector(
                                                '.education-student-notification-new'
                                            );


                                        if (
                                            newBadge
                                        ) {

                                            newBadge.remove();

                                        }


                                        const readForm =
                                            item.querySelector(
                                                '.education-student-notification-read-form'
                                            );


                                        if (
                                            readForm
                                        ) {

                                            readForm.remove();

                                        }

                                    }
                                );

                        }


                        if (button) {

                            button.disabled =
                                false;

                        }


                    } catch (error) {

                        console.error(
                            'Mark all notifications as read error:',
                            error
                        );


                        if (button) {

                            button.disabled =
                                false;

                        }

                    }

                }
            );

        }


        /* =====================================================
           OPEN / CLOSE NOTIFICATION DROPDOWN
        ===================================================== */

        notificationButton.addEventListener(
            'click',
            function (event) {

                event.preventDefault();

                event.stopPropagation();


                const isOpen =
                    notificationDropdown.classList.contains(
                        'show'
                    );


                notificationDropdown.classList.toggle(
                    'show'
                );


                notificationDropdown.setAttribute(
                    'aria-hidden',
                    isOpen
                        ? 'true'
                        : 'false'
                );


                notificationButton.setAttribute(
                    'aria-expanded',
                    isOpen
                        ? 'false'
                        : 'true'
                );


                /*
                |--------------------------------------------------------------------------
                | IMPORTANT
                |--------------------------------------------------------------------------
                |
                | فتح القائمة لا يقوم بتحديد الإشعارات كمقروءة.
                |
                | لذلك يبقى الـBadge ظاهرًا.
                |
                */

                if (!isOpen) {

                    loadNotifications();

                }

            }
        );


        /* =====================================================
           CLOSE NOTIFICATIONS OUTSIDE CLICK
        ===================================================== */

        document.addEventListener(
            'click',
            function (event) {

                if (
                    !notificationDropdown.contains(
                        event.target
                    ) &&
                    !notificationButton.contains(
                        event.target
                    )
                ) {

                    notificationDropdown.classList.remove(
                        'show'
                    );


                    notificationDropdown.setAttribute(
                        'aria-hidden',
                        'true'
                    );


                    notificationButton.setAttribute(
                        'aria-expanded',
                        'false'
                    );

                }

            }
        );


        /* =====================================================
           INITIAL NOTIFICATION LOAD
        ===================================================== */

        loadNotifications();


        /* =====================================================
           AUTOMATIC NOTIFICATION REFRESH
        ===================================================== */

        setInterval(
            function () {

                if (
                    !document.hidden
                ) {

                    loadNotifications();

                }

            },
            15000
        );


        /* =====================================================
           MOBILE MENU
        ===================================================== */

        const mobileButton =
            document.getElementById(
                'educationStudentNavigationMobileButton'
            );


        const mobileMenu =
            document.getElementById(
                'educationStudentNavigationMobileMenu'
            );


        if (
            mobileButton &&
            mobileMenu
        ) {

            mobileButton.addEventListener(
                'click',
                function (event) {

                    event.stopPropagation();


                    const isOpen =
                        mobileMenu.classList.contains(
                            'show'
                        );


                    mobileMenu.classList.toggle(
                        'show'
                    );


                    mobileButton.setAttribute(
                        'aria-expanded',
                        isOpen
                            ? 'false'
                            : 'true'
                    );


                    const icon =
                        mobileButton.querySelector(
                            'i'
                        );


                    if (icon) {

                        icon.className =
                            isOpen
                                ? 'fa-solid fa-bars'
                                : 'fa-solid fa-xmark';

                    }

                }
            );


            document.addEventListener(
                'click',
                function (event) {

                    if (
                        !mobileMenu.contains(
                            event.target
                        ) &&
                        !mobileButton.contains(
                            event.target
                        )
                    ) {

                        mobileMenu.classList.remove(
                            'show'
                        );


                        mobileButton.setAttribute(
                            'aria-expanded',
                            'false'
                        );


                        const icon =
                            mobileButton.querySelector(
                                'i'
                            );


                        if (icon) {

                            icon.className =
                                'fa-solid fa-bars';

                        }

                    }

                }
            );


            mobileMenu
                .querySelectorAll(
                    '.education-student-navigation-link'
                )
                .forEach(
                    function (link) {

                        link.addEventListener(
                            'click',
                            function () {

                                mobileMenu.classList.remove(
                                    'show'
                                );


                                mobileButton.setAttribute(
                                    'aria-expanded',
                                    'false'
                                );


                                const icon =
                                    mobileButton.querySelector(
                                        'i'
                                    );


                                if (icon) {

                                    icon.className =
                                        'fa-solid fa-bars';

                                }

                            }
                        );

                    }
                );

        }

    }
);

</script>


@endauth
