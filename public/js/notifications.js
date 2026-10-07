document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | Admin Notifications
    |--------------------------------------------------------------------------
    |
    | This file updates the notification counters without
    | reloading the page.
    |
    */


    /*
    |--------------------------------------------------------------------------
    | Notification Button
    |--------------------------------------------------------------------------
    */

    const notificationsButton = document.getElementById(
        'admin-notifications-button'
    );


    /*
    |--------------------------------------------------------------------------
    | Stop If Notification System Is Not Available
    |--------------------------------------------------------------------------
    */

    if (!notificationsButton) {
        return;
    }


    /*
    |--------------------------------------------------------------------------
    | Notification URL
    |--------------------------------------------------------------------------
    */

    const notificationsUrl =
        notificationsButton.dataset.notificationsUrl;


    if (!notificationsUrl) {

        console.error(
            'Admin notifications URL is missing.'
        );

        return;
    }


    /*
    |--------------------------------------------------------------------------
    | Counter Elements
    |--------------------------------------------------------------------------
    */

    const totalNotificationsCount =
        document.getElementById(
            'total-notifications-count'
        );


    const pendingCommentsCount =
        document.getElementById(
            'pending-comments-count'
        );


    const newMessagesCount =
        document.getElementById(
            'new-messages-count'
        );


    const newUsersCount =
        document.getElementById(
            'new-users-count'
        );


    /*
    |--------------------------------------------------------------------------
    | Update Counter
    |--------------------------------------------------------------------------
    */

    function updateCounter(element, value) {

        if (!element) {
            return;
        }


        const count = Number(value) || 0;


        /*
        |--------------------------------------------------------------------------
        | Update Number
        |--------------------------------------------------------------------------
        */

        element.textContent = count;


        /*
        |--------------------------------------------------------------------------
        | Show / Hide Counter
        |--------------------------------------------------------------------------
        */

        if (count > 0) {

            element.classList.remove(
                'd-none'
            );

        } else {

            element.classList.add(
                'd-none'
            );

        }
    }


    /*
    |--------------------------------------------------------------------------
    | Fetch Notification Counts
    |--------------------------------------------------------------------------
    */

    async function updateNotificationCounts() {

        try {

            const response = await fetch(
                notificationsUrl,
                {
                    method: 'GET',

                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },

                    credentials: 'same-origin',

                    cache: 'no-store'
                }
            );


            /*
            |--------------------------------------------------------------------------
            | Check Response
            |--------------------------------------------------------------------------
            */

            if (!response.ok) {

                throw new Error(
                    `HTTP error: ${response.status}`
                );
            }


            /*
            |--------------------------------------------------------------------------
            | Convert Response To JSON
            |--------------------------------------------------------------------------
            */

            const data =
                await response.json();


            /*
            |--------------------------------------------------------------------------
            | Update Total
            |--------------------------------------------------------------------------
            */

            updateCounter(
                totalNotificationsCount,
                data.totalNotifications
            );


            /*
            |--------------------------------------------------------------------------
            | Update Comments
            |--------------------------------------------------------------------------
            */

            updateCounter(
                pendingCommentsCount,
                data.pendingComments
            );


            /*
            |--------------------------------------------------------------------------
            | Update Messages
            |--------------------------------------------------------------------------
            */

            updateCounter(
                newMessagesCount,
                data.newMessages
            );


            /*
            |--------------------------------------------------------------------------
            | Update Users
            |--------------------------------------------------------------------------
            */

            updateCounter(
                newUsersCount,
                data.newUsers
            );


        } catch (error) {

            console.error(
                'Failed to update admin notification counts:',
                error
            );

        }
    }


    /*
    |--------------------------------------------------------------------------
    | First Check
    |--------------------------------------------------------------------------
    |
    | Run immediately when the page loads.
    |
    */

    updateNotificationCounts();


    /*
    |--------------------------------------------------------------------------
    | Automatic Refresh
    |--------------------------------------------------------------------------
    |
    | Check every 5 seconds.
    |
    */

    setInterval(
        updateNotificationCounts,
        5000
    );

});
