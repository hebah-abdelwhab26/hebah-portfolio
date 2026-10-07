document.addEventListener('DOMContentLoaded', function () {

    const sidebar =
        document.getElementById('educationAdminSidebar');

    const toggle =
        document.getElementById('educationAdminSidebarToggle');

    const close =
        document.getElementById('educationAdminSidebarClose');


    if (!sidebar) {
        return;
    }


    if (toggle) {

        toggle.addEventListener('click', function () {

            sidebar.classList.add('open');

        });

    }


    if (close) {

        close.addEventListener('click', function () {

            sidebar.classList.remove('open');

        });

    }


    /*
    |--------------------------------------------------------------------------
    | CLOSE WHEN CLICKING NAVIGATION LINK ON MOBILE
    |--------------------------------------------------------------------------
    */

    const navLinks =
        sidebar.querySelectorAll('.education-admin-nav-link');


    navLinks.forEach(function (link) {

        link.addEventListener('click', function () {

            if (window.innerWidth <= 1100) {

                sidebar.classList.remove('open');

            }

        });

    });


    /*
    |--------------------------------------------------------------------------
    | CLOSE WHEN RESIZING BACK TO DESKTOP
    |--------------------------------------------------------------------------
    */

    window.addEventListener('resize', function () {

        if (window.innerWidth > 1100) {

            sidebar.classList.remove('open');

        }

    });

});
