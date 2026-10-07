<!DOCTYPE html>
<html
    lang="{{ app()->getLocale() }}"
    dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}"
>

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title') | HebahGift Admin
    </title>


    <!--==================================
            Bootstrap
    ==================================-->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    <!--==================================
            FontAwesome
    ==================================-->

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    >


    <!--==================================
            Google Font
    ==================================-->

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet"
    >


    <!--==================================
            Admin Theme
    ==================================-->

    <link
        rel="stylesheet"
        href="{{ asset('css/admin/admin.css') }}"
    >


    @stack('styles')

</head>


<body>


    <!--==================================
            SIDEBAR
    ==================================-->

    @include('admin.layouts.sidebar')


    <!--==================================
            ADMIN PAGE
    ==================================-->

    <div class="admin-page">


        <!--==================================
                NAVBAR
        ==================================-->

        @include('admin.layouts.navbar')


        <!--==================================
                MAIN CONTENT
        ==================================-->

        <main class="admin-content">

            @yield('content')

        </main>


    </div>



    <!--==================================
            FLASH MESSAGES
    ==================================-->

    @if(session('success'))

        <div
            class="alert alert-success admin-flash-message"
            role="alert"
        >

            {{ session('success') }}

        </div>

    @endif


    @if(session('error'))

        <div
            class="alert alert-danger admin-flash-message"
            role="alert"
        >

            {{ session('error') }}

        </div>

    @endif



    <!--==================================
            BOOTSTRAP JS
    ==================================-->

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    >
    </script>



    <!--==================================
            ADMIN NOTIFICATIONS
            AUTO REFRESH
    ==================================-->

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            /*
            |--------------------------------------------------------------------------
            | Elements
            |--------------------------------------------------------------------------
            */

            const totalNotifications =
                document.getElementById(
                    'total-notifications-count'
                );

            const pendingComments =
                document.getElementById(
                    'pending-comments-count'
                );

            const newMessages =
                document.getElementById(
                    'new-messages-count'
                );

            const newUsers =
                document.getElementById(
                    'new-users-count'
                );


            /*
            |--------------------------------------------------------------------------
            | Notification Counts URL
            |--------------------------------------------------------------------------
            */

            const notificationsUrl =
                "{{ route('admin.notifications.counts') }}";


            /*
            |--------------------------------------------------------------------------
            | Update Badge
            |--------------------------------------------------------------------------
            */

            function updateBadge(element, value) {

                if (!element) {
                    return;
                }

                const count = Number(value) || 0;

                element.textContent = count;


                if (count > 0) {

                    element.classList.remove('d-none');

                } else {

                    element.classList.add('d-none');

                }

            }


            /*
            |--------------------------------------------------------------------------
            | Update Notification Counters
            |--------------------------------------------------------------------------
            */

            function updateNotificationCounts() {

                fetch(notificationsUrl, {

                    method: 'GET',

                    headers: {

                        'Accept': 'application/json',

                        'X-Requested-With':
                            'XMLHttpRequest'

                    },

                    credentials: 'same-origin'

                })

                .then(function (response) {

                    if (!response.ok) {

                        throw new Error(
                            'Failed to load notifications.'
                        );

                    }

                    return response.json();

                })

                .then(function (data) {

                    /*
                    |----------------------------------------------
                    | Comments
                    |----------------------------------------------
                    */

                    updateBadge(
                        pendingComments,
                        data.pendingComments
                    );


                    /*
                    |----------------------------------------------
                    | Messages
                    |----------------------------------------------
                    */

                    updateBadge(
                        newMessages,
                        data.newMessages
                    );


                    /*
                    |----------------------------------------------
                    | Users
                    |----------------------------------------------
                    */

                    updateBadge(
                        newUsers,
                        data.newUsers
                    );


                    /*
                    |----------------------------------------------
                    | Total Notifications
                    |----------------------------------------------
                    */

                    updateBadge(
                        totalNotifications,
                        data.totalNotifications
                    );

                })

                .catch(function (error) {

                    console.error(
                        'Notification update error:',
                        error
                    );

                });

            }


            /*
            |--------------------------------------------------------------------------
            | Initial Update
            |--------------------------------------------------------------------------
            */

            updateNotificationCounts();


            /*
            |--------------------------------------------------------------------------
            | Auto Refresh
            |--------------------------------------------------------------------------
            |
            | Update every 10 seconds without refreshing
            | the entire admin page.
            |
            */

            setInterval(
                updateNotificationCounts,
                10000
            );

        });

    </script>



    <!--==================================
            Page Scripts
    ==================================-->

    @stack('scripts')


</body>

</html>
