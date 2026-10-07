<!--=====================================================
    ADMIN TOP NAVBAR
=====================================================-->

<nav class="top-navbar">


    <!--=================================================
        NAVBAR LEFT
    =================================================-->

    <div class="navbar-left">


        <!--=================================================
            SEARCH
        =================================================-->

        <form
            action="{{ route('admin.projects.index') }}"
            method="GET"
            class="navbar-search">

            <i class="fa-solid fa-magnifying-glass"></i>

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="{{ __('digital_studio_admin.navbar.search_placeholder') }}">

        </form>


    </div>



    <!--=================================================
        NAVBAR RIGHT
    =================================================-->

    <div class="navbar-right">


        <!--=================================================
            LANGUAGE SWITCHER
        =================================================-->

        <a
            href="{{ route('admin.language', app()->getLocale() === 'ar' ? 'en' : 'ar') }}"
            class="nav-icon language-switcher"
            title="{{ app()->getLocale() === 'ar'
                ? __('digital_studio_admin.navbar.switch_to_english')
                : __('digital_studio_admin.navbar.switch_to_arabic') }}"
            aria-label="{{ app()->getLocale() === 'ar'
                ? __('digital_studio_admin.navbar.switch_to_english')
                : __('digital_studio_admin.navbar.switch_to_arabic') }}">

            <i class="fa-solid fa-language"></i>

        </a>



        <!--=================================================
            NOTIFICATIONS
        =================================================-->

        <div class="admin-notifications">


            <!--=================================================
                NOTIFICATION BUTTON
            =================================================-->

            <button
                type="button"
                class="nav-icon"
                title="{{ __('digital_studio_admin.navbar.notifications') }}"
                id="admin-notifications-button"
                aria-label="{{ __('digital_studio_admin.navbar.notifications') }}"
                aria-expanded="false">

                <i class="fa-regular fa-bell"></i>


                @php

                    $totalNotifications =
                        ($pendingComments ?? 0)
                        + ($newMessages ?? 0)
                        + ($newUsers ?? 0);

                @endphp


                <span
                    class="notification-count {{ $totalNotifications > 0 ? '' : 'd-none' }}"
                    id="total-notifications-count">

                    {{ $totalNotifications }}

                </span>

            </button>



            <!--=================================================
                NOTIFICATION DROPDOWN
            =================================================-->

            <div
                class="admin-notifications-dropdown"
                id="admin-notifications-dropdown">


                <!--=================================================
                    HEADER
                =================================================-->

                <div class="notifications-header">

                    <div>

                        <h3>
                            {{ __('digital_studio_admin.navbar.notifications') }}
                        </h3>

                        <span>
                            {{ __('digital_studio_admin.navbar.recent_activity') }}
                        </span>

                    </div>


                    <span
                        class="notifications-total"
                        id="dropdown-notifications-total">

                        {{ $totalNotifications }}

                    </span>

                </div>



                <!--=================================================
                    BODY
                =================================================-->

                <div
                    class="notifications-body"
                    id="admin-notifications-body">


                    <!--=================================================
                        COMMENTS
                    =================================================-->

                    <a
                        href="{{ route('admin.comments.index') }}"
                        class="notification-item">


                        <div class="notification-item-icon comments-icon">

                            <i class="fa-regular fa-comments"></i>

                        </div>


                        <div class="notification-item-content">

                            <strong>
                                {{ __('digital_studio_admin.navbar.pending_comments') }}
                            </strong>

                            <span>

                                <span id="dropdown-pending-comments">

                                    {{ $pendingComments ?? 0 }}

                                </span>

                                {{ __('digital_studio_admin.navbar.pending_comments_count') }}

                            </span>

                        </div>


                        <i
                            class="fa-solid fa-chevron-right notification-arrow">
                        </i>

                    </a>



                    <!--=================================================
                        MESSAGES
                    =================================================-->

                    <a
                        href="{{ route('admin.conversations.index') }}"
                        class="notification-item">


                        <div class="notification-item-icon messages-icon">

                            <i class="fa-regular fa-envelope"></i>

                        </div>


                        <div class="notification-item-content">

                            <strong>
                                {{ __('digital_studio_admin.navbar.new_messages') }}
                            </strong>

                            <span>

                                <span id="dropdown-new-messages">

                                    {{ $newMessages ?? 0 }}

                                </span>

                                {{ __('digital_studio_admin.navbar.unread_messages_count') }}

                            </span>

                        </div>


                        <i
                            class="fa-solid fa-chevron-right notification-arrow">
                        </i>

                    </a>



                    <!--=================================================
                        USERS
                    =================================================-->

                    <a
                        href="{{ route('admin.users.index') }}"
                        class="notification-item">


                        <div class="notification-item-icon users-icon">

                            <i class="fa-regular fa-user"></i>

                        </div>


                        <div class="notification-item-content">

                            <strong>
                                {{ __('digital_studio_admin.navbar.new_users') }}
                            </strong>

                            <span>

                                <span id="dropdown-new-users">

                                    {{ $newUsers ?? 0 }}

                                </span>

                                {{ __('digital_studio_admin.navbar.new_users_count') }}

                            </span>

                        </div>


                        <i
                            class="fa-solid fa-chevron-right notification-arrow">
                        </i>

                    </a>


                </div>



                <!--=================================================
                    FOOTER
                =================================================-->

                <div class="notifications-footer">

                    <a
                        href="{{ route('admin.conversations.index') }}">

                        {{ __('digital_studio_admin.navbar.view_all_activity') }}

                        <i class="fa-solid fa-arrow-right"></i>

                    </a>

                </div>


            </div>


        </div>



        <!--=================================================
            COMMENTS
        =================================================-->

        <a
            href="{{ route('admin.comments.index') }}"
            class="nav-icon"
            title="{{ __('digital_studio_admin.navbar.comments') }}"
            aria-label="{{ __('digital_studio_admin.navbar.comments') }}">

            <i class="fa-regular fa-comments"></i>


            <span
                class="notification-count {{ ($pendingComments ?? 0) > 0 ? '' : 'd-none' }}"
                id="pending-comments-count">

                {{ $pendingComments ?? 0 }}

            </span>

        </a>



        <!--=================================================
            MESSAGES
        =================================================-->

        <a
            href="{{ route('admin.conversations.index') }}"
            class="nav-icon"
            title="{{ __('digital_studio_admin.navbar.messages') }}"
            aria-label="{{ __('digital_studio_admin.navbar.messages') }}">

            <i class="fa-regular fa-envelope"></i>


            <span
                class="notification-count {{ ($newMessages ?? 0) > 0 ? '' : 'd-none' }}"
                id="new-messages-count">

                {{ $newMessages ?? 0 }}

            </span>

        </a>



        <!--=================================================
            USERS
        =================================================-->

        <a
            href="{{ route('admin.users.index') }}"
            class="nav-icon"
            title="{{ __('digital_studio_admin.navbar.users') }}"
            aria-label="{{ __('digital_studio_admin.navbar.users') }}">

            <i class="fa-regular fa-user"></i>


            <span
                class="notification-count {{ ($newUsers ?? 0) > 0 ? '' : 'd-none' }}"
                id="new-users-count">

                {{ $newUsers ?? 0 }}

            </span>

        </a>



        <!--=================================================
            VIEW WEBSITE
        =================================================-->

        <a
            href="{{ route('portal') }}"
            target="_blank"
            rel="noopener noreferrer"
            class="nav-icon"
            title="{{ __('digital_studio_admin.navbar.view_website') }}"
            aria-label="{{ __('digital_studio_admin.navbar.view_website') }}">

            <i class="fa-solid fa-globe"></i>

        </a>



        <!--=================================================
            USER DROPDOWN
        =================================================-->

        <div class="user-dropdown">


            <!--=================================================
                USER DROPDOWN TOGGLE
            =================================================-->

            <button
                type="button"
                class="user-dropdown-toggle"
                aria-label="{{ __('digital_studio_admin.navbar.open_user_menu') }}"
                aria-expanded="false">


                <!-- USER AVATAR -->

                <div class="user-avatar">

                    {{ strtoupper(substr($navbar['user']->name, 0, 1)) }}

                </div>


                <!-- ARROW -->

                <i class="fa-solid fa-chevron-down"></i>

            </button>



            <!--=================================================
                USER MENU
            =================================================-->

            <div class="user-dropdown-menu">


                <!--=================================================
                    DASHBOARD
                =================================================-->

                <a
                    href="{{ route('admin.dashboard') }}">

                    <i class="fa-solid fa-chart-line"></i>

                    <span>
                        {{ __('digital_studio_admin.navbar.dashboard') }}
                    </span>

                </a>



                <!--=================================================
                    VIEW WEBSITE
                =================================================-->

                <a
                    href="{{ route('portal') }}"
                    target="_blank"
                    rel="noopener noreferrer">

                    <i class="fa-solid fa-globe"></i>

                    <span>
                        {{ __('digital_studio_admin.navbar.view_website') }}
                    </span>

                </a>



                <!--=================================================
                    DIVIDER
                =================================================-->

                <div class="dropdown-divider"></div>



                <!--=================================================
                    LOGOUT
                =================================================-->

                <form
                    action="{{ route('logout') }}"
                    method="POST">

                    @csrf

                    <button type="submit">

                        <i class="fa-solid fa-right-from-bracket"></i>

                        <span>
                            {{ __('digital_studio_admin.navbar.logout') }}
                        </span>

                    </button>

                </form>


            </div>


        </div>


    </div>


</nav>



<!--=====================================================
    NAVBAR JAVASCRIPT
=====================================================-->

@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {


    /*==================================================
        ELEMENTS
    ==================================================*/

    const notificationButton =
        document.getElementById(
            'admin-notifications-button'
        );

    const notificationDropdown =
        document.getElementById(
            'admin-notifications-dropdown'
        );

    const userDropdown =
        document.querySelector(
            '.user-dropdown'
        );

    const userDropdownToggle =
        document.querySelector(
            '.user-dropdown-toggle'
        );


    /*==================================================
        NOTIFICATION DROPDOWN
    ==================================================*/

    if (
        notificationButton &&
        notificationDropdown
    ) {

        notificationButton.addEventListener(
            'click',
            function (event) {

                event.stopPropagation();


                /* CLOSE USER DROPDOWN */

                if (userDropdown) {

                    userDropdown.classList.remove(
                        'active'
                    );

                }


                if (userDropdownToggle) {

                    userDropdownToggle.setAttribute(
                        'aria-expanded',
                        'false'
                    );

                }


                /* TOGGLE NOTIFICATIONS */

                const isOpen =
                    notificationDropdown.classList.contains(
                        'show'
                    );


                if (isOpen) {

                    notificationDropdown.classList.remove(
                        'show'
                    );

                    notificationButton.setAttribute(
                        'aria-expanded',
                        'false'
                    );

                } else {

                    notificationDropdown.classList.add(
                        'show'
                    );

                    notificationButton.setAttribute(
                        'aria-expanded',
                        'true'
                    );

                }

            }
        );


        /*==================================================
            PREVENT DROPDOWN CLICK FROM CLOSING ITSELF
        ==================================================*/

        notificationDropdown.addEventListener(
            'click',
            function (event) {

                event.stopPropagation();

            }
        );

    }



    /*==================================================
        USER DROPDOWN
    ==================================================*/

    if (
        userDropdown &&
        userDropdownToggle
    ) {

        userDropdownToggle.addEventListener(
            'click',
            function (event) {

                event.stopPropagation();


                /* CLOSE NOTIFICATIONS */

                if (notificationDropdown) {

                    notificationDropdown.classList.remove(
                        'show'
                    );

                }


                if (notificationButton) {

                    notificationButton.setAttribute(
                        'aria-expanded',
                        'false'
                    );

                }


                /* TOGGLE USER MENU */

                userDropdown.classList.toggle(
                    'active'
                );


                const isOpen =
                    userDropdown.classList.contains(
                        'active'
                    );


                userDropdownToggle.setAttribute(
                    'aria-expanded',
                    isOpen
                        ? 'true'
                        : 'false'
                );

            }
        );


        /*==================================================
            PREVENT USER MENU FROM CLOSING ITSELF
        ==================================================*/

        const userDropdownMenu =
            userDropdown.querySelector(
                '.user-dropdown-menu'
            );


        if (userDropdownMenu) {

            userDropdownMenu.addEventListener(
                'click',
                function (event) {

                    event.stopPropagation();

                }
            );

        }

    }



    /*==================================================
        CLOSE DROPDOWNS WHEN CLICKING OUTSIDE
    ==================================================*/

    document.addEventListener(
        'click',
        function () {


            /* CLOSE NOTIFICATIONS */

            if (notificationDropdown) {

                notificationDropdown.classList.remove(
                    'show'
                );

            }


            if (notificationButton) {

                notificationButton.setAttribute(
                    'aria-expanded',
                    'false'
                );

            }


            /* CLOSE USER MENU */

            if (userDropdown) {

                userDropdown.classList.remove(
                    'active'
                );

            }


            if (userDropdownToggle) {

                userDropdownToggle.setAttribute(
                    'aria-expanded',
                    'false'
                );

            }

        }
    );



    /*==================================================
        UPDATE NOTIFICATION UI
    ==================================================*/

    function updateNotificationUI(data) {


        /*----------------------------------------------
            VALUES
        ----------------------------------------------*/

        const pendingComments =
            Number(data.pendingComments || 0);

        const newMessages =
            Number(data.newMessages || 0);

        const newUsers =
            Number(data.newUsers || 0);

        const totalNotifications =
            Number(
                data.totalNotifications ||
                (
                    pendingComments +
                    newMessages +
                    newUsers
                )
            );



        /*----------------------------------------------
            TOP TOTAL
        ----------------------------------------------*/

        const totalCount =
            document.getElementById(
                'total-notifications-count'
            );


        if (totalCount) {

            totalCount.textContent =
                totalNotifications;


            totalCount.classList.toggle(
                'd-none',
                totalNotifications <= 0
            );

        }



        /*----------------------------------------------
            COMMENTS
        ----------------------------------------------*/

        const commentsCount =
            document.getElementById(
                'pending-comments-count'
            );


        if (commentsCount) {

            commentsCount.textContent =
                pendingComments;


            commentsCount.classList.toggle(
                'd-none',
                pendingComments <= 0
            );

        }



        /*----------------------------------------------
            MESSAGES
        ----------------------------------------------*/

        const messagesCount =
            document.getElementById(
                'new-messages-count'
            );


        if (messagesCount) {

            messagesCount.textContent =
                newMessages;


            messagesCount.classList.toggle(
                'd-none',
                newMessages <= 0
            );

        }



        /*----------------------------------------------
            USERS
        ----------------------------------------------*/

        const usersCount =
            document.getElementById(
                'new-users-count'
            );


        if (usersCount) {

            usersCount.textContent =
                newUsers;


            usersCount.classList.toggle(
                'd-none',
                newUsers <= 0
            );

        }



        /*----------------------------------------------
            DROPDOWN TOTAL
        ----------------------------------------------*/

        const dropdownTotal =
            document.getElementById(
                'dropdown-notifications-total'
            );


        if (dropdownTotal) {

            dropdownTotal.textContent =
                totalNotifications;

        }



        /*----------------------------------------------
            DROPDOWN COMMENTS
        ----------------------------------------------*/

        const dropdownComments =
            document.getElementById(
                'dropdown-pending-comments'
            );


        if (dropdownComments) {

            dropdownComments.textContent =
                pendingComments;

        }



        /*----------------------------------------------
            DROPDOWN MESSAGES
        ----------------------------------------------*/

        const dropdownMessages =
            document.getElementById(
                'dropdown-new-messages'
            );


        if (dropdownMessages) {

            dropdownMessages.textContent =
                newMessages;

        }



        /*----------------------------------------------
            DROPDOWN USERS
        ----------------------------------------------*/

        const dropdownUsers =
            document.getElementById(
                'dropdown-new-users'
            );


        if (dropdownUsers) {

            dropdownUsers.textContent =
                newUsers;

        }

    }



    /*==================================================
        LOAD NOTIFICATION COUNTS
    ==================================================*/

    function loadNotificationCounts() {


        fetch(
            "{{ route('admin.notifications.counts') }}",
            {
                method: 'GET',

                headers: {

                    'Accept':
                        'application/json',

                    'X-Requested-With':
                        'XMLHttpRequest'

                },

                credentials: 'same-origin'

            }
        )


        .then(function (response) {

            if (!response.ok) {

                throw new Error(
                    'Notification request failed.'
                );

            }

            return response.json();

        })


        .then(function (data) {

            updateNotificationUI(data);

        })


        .catch(function (error) {

            console.error(
                'Notification error:',
                error
            );

        });

    }



    /*==================================================
        INITIAL LOAD
    ==================================================*/

    loadNotificationCounts();



    /*==================================================
        AUTO REFRESH
        Every 10 seconds
    ==================================================*/

    setInterval(
        loadNotificationCounts,
        10000
    );


});

</script>

@endpush
