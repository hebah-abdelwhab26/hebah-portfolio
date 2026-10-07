/*==================================================
    EDUCATION NAVBAR
==================================================*/

document.addEventListener("DOMContentLoaded", () => {

    const navbarWrapper =
        document.querySelector(".education-navbar-wrapper");

    const navbarToggle =
        document.getElementById("educationNavbarToggle");

    const mobileMenu =
        document.getElementById("educationMobileMenu");


    /*==================================================
        NAVBAR SCROLL
    ==================================================*/

    let lastScrollY = window.scrollY;

    const scrollThreshold = 8;


    function handleNavbarScroll() {

        if (!navbarWrapper) {
            return;
        }

        const currentScrollY = window.scrollY;


        /*----------------------------------------------
            SCROLLED STATE
        ----------------------------------------------*/

        if (currentScrollY > 20) {

            navbarWrapper.classList.add("scrolled");

        } else {

            navbarWrapper.classList.remove("scrolled");

        }


        /*----------------------------------------------
            IGNORE SMALL MOVEMENTS
        ----------------------------------------------*/

        if (
            Math.abs(currentScrollY - lastScrollY) <
            scrollThreshold
        ) {
            return;
        }

        lastScrollY = currentScrollY;
    }


    handleNavbarScroll();


    window.addEventListener(
        "scroll",
        handleNavbarScroll,
        {
            passive: true
        }
    );


    /*==================================================
        MOBILE MENU
    ==================================================*/

    function openMobileMenu() {

        if (!mobileMenu || !navbarToggle) {
            return;
        }

        mobileMenu.classList.add("show");

        navbarToggle.classList.add("active");

        navbarToggle.setAttribute(
            "aria-expanded",
            "true"
        );
    }


    function closeMobileMenu() {

        if (!mobileMenu || !navbarToggle) {
            return;
        }

        mobileMenu.classList.remove("show");

        navbarToggle.classList.remove("active");

        navbarToggle.setAttribute(
            "aria-expanded",
            "false"
        );
    }


    function toggleMobileMenu(event) {

        if (event) {
            event.preventDefault();
            event.stopPropagation();
        }

        if (!mobileMenu || !navbarToggle) {
            return;
        }


        const isOpen =
            mobileMenu.classList.contains("show");


        if (isOpen) {

            closeMobileMenu();

        } else {

            openMobileMenu();

        }
    }


    /*==================================================
        MOBILE TOGGLE
    ==================================================*/

    if (navbarToggle) {

        navbarToggle.addEventListener(
            "click",
            toggleMobileMenu
        );

    }


    /*==================================================
        MOBILE LINKS
    ==================================================*/

    document
        .querySelectorAll(".education-mobile-link")
        .forEach((link) => {

            link.addEventListener(
                "click",
                () => {

                    closeMobileMenu();

                }
            );

        });


    /*==================================================
        CLICK OUTSIDE
    ==================================================*/

    document.addEventListener(
        "click",
        (event) => {

            if (!navbarWrapper) {
                return;
            }

            if (
                mobileMenu &&
                mobileMenu.classList.contains("show") &&
                !navbarWrapper.contains(event.target)
            ) {

                closeMobileMenu();

            }

        }
    );


    /*==================================================
        ESC KEY
    ==================================================*/

    document.addEventListener(
        "keydown",
        (event) => {

            if (event.key === "Escape") {

                closeMobileMenu();

            }

        }
    );


    /*==================================================
        WINDOW RESIZE
        إغلاق القائمة عند العودة للشاشة الكبيرة
    ==================================================*/

    window.addEventListener(
        "resize",
        () => {

            if (window.innerWidth > 900) {

                closeMobileMenu();

            }

        }
    );

});