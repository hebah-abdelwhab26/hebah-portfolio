/*==================================================*
|                    NAVBAR JS                     |
*==================================================*/

document.addEventListener("DOMContentLoaded", () => {

    /*==================================================
                    ELEMENTS
    ==================================================*/

    const navbarWrapper =
        document.querySelector(".navbar-wrapper");

    const navbarToggle =
        document.getElementById("navbarToggle");

    const mobileMenu =
        document.getElementById("mobileMenu");

    const languageToggle =
        document.getElementById("languageToggle");

    const languageMenu =
        document.getElementById("languageMenu");

    const userToggle =
        document.getElementById("userToggle");

    const userMenu =
        document.getElementById("userMenu");

    const mobileMore =
        document.querySelector(".mobile-more");

    const mobileMoreToggle =
        document.querySelector(".mobile-more-toggle");


    /*==================================================
                    DESKTOP MORE
    ==================================================*/

    const desktopMore =
        document.querySelector(".navbar-more");

    const desktopMoreToggle =
        document.querySelector(".navbar-more-toggle");

    const desktopMoreMenu =
        desktopMore
            ? desktopMore.querySelector(".navbar-more-menu")
            : null;


    /*==================================================
                    NOTIFICATIONS
    ==================================================*/

    const userNotifications =
        document.querySelector(".user-notifications");

    const userNotificationsToggle =
        document.getElementById(
            "userNotificationsToggle"
        );

    const userNotificationsMenu =
        document.getElementById(
            "userNotificationsMenu"
        );

    const userNotificationsCount =
        document.getElementById(
            "userNotificationsCount"
        );

    const userNotificationsTotal =
        document.getElementById(
            "userNotificationsTotal"
        );

    const userNotificationsBody =
        document.getElementById(
            "userNotificationsBody"
        );

    const mobileNotificationsToggle =
        document.getElementById(
            "mobileNotificationsToggle"
        );

/*==================================================*
|              NAVBAR SCROLL BEHAVIOR              |
|                                                  |
|   TOP       → ALWAYS VISIBLE                     |
|   SCROLL UP → VISIBLE                            |
|   SCROLL DOWN → HIDDEN                           |
*==================================================*/

let lastScrollY = window.scrollY;
let ticking = false;

const NAVBAR_TOP_THRESHOLD = 30;


/*--------------------------------------------------
            UPDATE NAVBAR VISIBILITY
--------------------------------------------------*/

function updateNavbarVisibility() {

    if (!navbarWrapper) {
        return;
    }

    const currentScrollY = window.scrollY;


    /*==============================================
                TOP OF PAGE
    ==============================================*/

    if (currentScrollY <= NAVBAR_TOP_THRESHOLD) {

        navbarWrapper.classList.remove(
            "navbar-hidden"
        );

        navbarWrapper.classList.add(
            "navbar-visible"
        );

        navbarWrapper.classList.remove(
            "scrolled"
        );

        lastScrollY = currentScrollY;

        return;
    }


    /*==============================================
                SCROLLED STATE
    ==============================================*/

    navbarWrapper.classList.add(
        "scrolled"
    );


    /*==============================================
                SCROLL DOWN
    ==============================================*/

    if (currentScrollY > lastScrollY) {

        navbarWrapper.classList.remove(
            "navbar-visible"
        );

        navbarWrapper.classList.add(
            "navbar-hidden"
        );
    }


    /*==============================================
                SCROLL UP
    ==============================================*/

    if (currentScrollY < lastScrollY) {

        navbarWrapper.classList.remove(
            "navbar-hidden"
        );

        navbarWrapper.classList.add(
            "navbar-visible"
        );
    }


    /*==============================================
                UPDATE LAST POSITION
    ==============================================*/

    lastScrollY = currentScrollY;
}


/*--------------------------------------------------
            SCROLL EVENT
--------------------------------------------------*/

function handleNavbarScroll() {

    if (ticking) {
        return;
    }

    ticking = true;


    window.requestAnimationFrame(() => {

        updateNavbarVisibility();

        ticking = false;
    });
}


/*==================================================
            INITIAL NAVBAR STATE
==================================================*/

if (navbarWrapper) {

    navbarWrapper.classList.remove(
        "navbar-hidden"
    );

    navbarWrapper.classList.add(
        "navbar-visible"
    );


    lastScrollY =
        window.scrollY;


    window.addEventListener(
        "scroll",
        handleNavbarScroll,
        {
            passive: true
        }
    );
}


    /*==================================================
                    HELPER FUNCTIONS
    ==================================================*/


    /*--------------------------------------------------
                    CLOSE LANGUAGE
    --------------------------------------------------*/

    function closeLanguageMenu() {

        if (languageMenu) {

            languageMenu.classList.remove(
                "show"
            );
        }


        if (languageToggle) {

            languageToggle.classList.remove(
                "active"
            );

            languageToggle.setAttribute(
                "aria-expanded",
                "false"
            );
        }
    }


    /*--------------------------------------------------
                    CLOSE USER MENU
    --------------------------------------------------*/

    function closeUserMenu() {

        if (userMenu) {

            userMenu.classList.remove(
                "show"
            );
        }


        if (userToggle) {

            userToggle.classList.remove(
                "active"
            );

            userToggle.setAttribute(
                "aria-expanded",
                "false"
            );
        }
    }


    /*--------------------------------------------------
                    CLOSE NOTIFICATIONS
    --------------------------------------------------*/

    function closeNotifications() {

        if (userNotificationsMenu) {

            userNotificationsMenu.classList.remove(
                "show"
            );
        }


        if (userNotificationsToggle) {

            userNotificationsToggle.classList.remove(
                "active"
            );

            userNotificationsToggle.setAttribute(
                "aria-expanded",
                "false"
            );
        }
    }


    /*--------------------------------------------------
                    CLOSE DESKTOP MORE
    --------------------------------------------------*/

    function closeDesktopMore() {

        if (desktopMore) {

            desktopMore.classList.remove(
                "active"
            );
        }


        if (desktopMoreToggle) {

            desktopMoreToggle.setAttribute(
                "aria-expanded",
                "false"
            );
        }
    }


    /*--------------------------------------------------
                    CLOSE ALL DROPDOWNS
    --------------------------------------------------*/

    function closeAllDropdowns() {

        closeLanguageMenu();

        closeUserMenu();

        closeNotifications();

        closeDesktopMore();
    }


    /*==================================================
                    MOBILE MENU
    ==================================================*/

    function closeMobileMenu() {

        if (mobileMenu) {

            mobileMenu.classList.remove(
                "show"
            );
        }


        if (navbarToggle) {

            navbarToggle.classList.remove(
                "active"
            );

            navbarToggle.setAttribute(
                "aria-expanded",
                "false"
            );
        }


        if (mobileMore) {

            mobileMore.classList.remove(
                "active"
            );
        }


        if (mobileMoreToggle) {

            mobileMoreToggle.setAttribute(
                "aria-expanded",
                "false"
            );
        }
    }


    /*==================================================
                    MOBILE TOGGLE
    ==================================================*/

    if (
        navbarToggle &&
        mobileMenu
    ) {

        navbarToggle.addEventListener(
            "click",
            (event) => {

                event.preventDefault();

                event.stopPropagation();


                const isOpen =
                    mobileMenu.classList.contains(
                        "show"
                    );


                if (isOpen) {

                    closeMobileMenu();

                } else {

                    closeAllDropdowns();

                    mobileMenu.classList.add(
                        "show"
                    );

                    navbarToggle.classList.add(
                        "active"
                    );

                    navbarToggle.setAttribute(
                        "aria-expanded",
                        "true"
                    );
                }
            }
        );
    }


    /*==================================================
                    MOBILE MORE
    ==================================================*/

    if (
        mobileMore &&
        mobileMoreToggle
    ) {

        mobileMoreToggle.addEventListener(
            "click",
            (event) => {

                event.preventDefault();

                event.stopPropagation();


                const isOpen =
                    mobileMore.classList.contains(
                        "active"
                    );


                if (isOpen) {

                    mobileMore.classList.remove(
                        "active"
                    );

                    mobileMoreToggle.setAttribute(
                        "aria-expanded",
                        "false"
                    );

                } else {

                    mobileMore.classList.add(
                        "active"
                    );

                    mobileMoreToggle.setAttribute(
                        "aria-expanded",
                        "true"
                    );
                }
            }
        );
    }


    /*==================================================
                    LANGUAGE MENU
    ==================================================*/

    if (
        languageToggle &&
        languageMenu
    ) {

        languageToggle.addEventListener(
            "click",
            (event) => {

                event.preventDefault();

                event.stopPropagation();


                const isOpen =
                    languageMenu.classList.contains(
                        "show"
                    );


                closeUserMenu();

                closeNotifications();

                closeDesktopMore();


                if (isOpen) {

                    closeLanguageMenu();

                } else {

                    languageMenu.classList.add(
                        "show"
                    );

                    languageToggle.classList.add(
                        "active"
                    );

                    languageToggle.setAttribute(
                        "aria-expanded",
                        "true"
                    );
                }
            }
        );


        languageMenu.addEventListener(
            "click",
            (event) => {

                event.stopPropagation();
            }
        );
    }


    /*==================================================
                    USER MENU
    ==================================================*/

    if (
        userToggle &&
        userMenu
    ) {

        userToggle.addEventListener(
            "click",
            (event) => {

                event.preventDefault();

                event.stopPropagation();


                const isOpen =
                    userMenu.classList.contains(
                        "show"
                    );


                closeLanguageMenu();

                closeNotifications();

                closeDesktopMore();


                if (isOpen) {

                    closeUserMenu();

                } else {

                    userMenu.classList.add(
                        "show"
                    );

                    userToggle.classList.add(
                        "active"
                    );

                    userToggle.setAttribute(
                        "aria-expanded",
                        "true"
                    );
                }
            }
        );


        userMenu.addEventListener(
            "click",
            (event) => {

                event.stopPropagation();
            }
        );
    }


    /*==================================================
                    USER NOTIFICATIONS
    ==================================================*/

    if (
        userNotificationsToggle &&
        userNotificationsMenu
    ) {

        userNotificationsToggle.addEventListener(
            "click",
            (event) => {

                event.preventDefault();

                event.stopPropagation();


                const isOpen =
                    userNotificationsMenu.classList.contains(
                        "show"
                    );


                closeLanguageMenu();

                closeUserMenu();

                closeDesktopMore();


                if (isOpen) {

                    closeNotifications();

                } else {

                    userNotificationsMenu.classList.add(
                        "show"
                    );

                    userNotificationsToggle.classList.add(
                        "active"
                    );

                    userNotificationsToggle.setAttribute(
                        "aria-expanded",
                        "true"
                    );
                }
            }
        );


        userNotificationsMenu.addEventListener(
            "click",
            (event) => {

                event.stopPropagation();
            }
        );
    }


    /*==================================================
                MOBILE NOTIFICATIONS
    ==================================================*/

    if (
        mobileNotificationsToggle
    ) {

        mobileNotificationsToggle.addEventListener(
            "click",
            (event) => {

                event.preventDefault();

                event.stopPropagation();


                closeMobileMenu();


                if (
                    userNotificationsToggle &&
                    userNotificationsMenu
                ) {

                    const isOpen =
                        userNotificationsMenu.classList.contains(
                            "show"
                        );


                    closeLanguageMenu();

                    closeUserMenu();

                    closeDesktopMore();


                    if (isOpen) {

                        closeNotifications();

                    } else {

                        userNotificationsMenu.classList.add(
                            "show"
                        );

                        userNotificationsToggle.classList.add(
                            "active"
                        );

                        userNotificationsToggle.setAttribute(
                            "aria-expanded",
                            "true"
                        );
                    }
                }
            }
        );
    }


    /*==================================================
                    DESKTOP MORE
    ==================================================*/

    if (
        desktopMore &&
        desktopMoreToggle
    ) {

        desktopMoreToggle.addEventListener(
            "click",
            (event) => {

                event.preventDefault();

                event.stopPropagation();


                const isOpen =
                    desktopMore.classList.contains(
                        "active"
                    );


                closeLanguageMenu();

                closeUserMenu();

                closeNotifications();


                if (isOpen) {

                    closeDesktopMore();

                } else {

                    desktopMore.classList.add(
                        "active"
                    );

                    desktopMoreToggle.setAttribute(
                        "aria-expanded",
                        "true"
                    );
                }
            }
        );


        if (desktopMoreMenu) {

            desktopMoreMenu.addEventListener(
                "click",
                (event) => {

                    event.stopPropagation();
                }
            );
        }
    }


    /*==================================================
                    CLICK OUTSIDE
    ==================================================*/

    document.addEventListener(
        "click",
        () => {

            closeAllDropdowns();
        }
    );


    /*==================================================
                    MOBILE MAIN LINKS
    ==================================================*/

    document
        .querySelectorAll(
            ".mobile-menu > .mobile-link"
        )
        .forEach(
            (link) => {

                link.addEventListener(
                    "click",
                    () => {

                        closeMobileMenu();
                    }
                );
            }
        );


    /*==================================================
                    MOBILE MORE LINKS
    ==================================================*/

    document
        .querySelectorAll(
            ".mobile-more-menu .mobile-link"
        )
        .forEach(
            (link) => {

                link.addEventListener(
                    "click",
                    () => {

                        closeMobileMenu();
                    }
                );
            }
        );


    /*==================================================
                    DESKTOP MORE LINKS
    ==================================================*/

    document
        .querySelectorAll(
            ".navbar-more-menu a"
        )
        .forEach(
            (link) => {

                link.addEventListener(
                    "click",
                    () => {

                        closeDesktopMore();
                    }
                );
            }
        );


    /*==================================================
                    ACTIVE NAVIGATION
    ==================================================*/

    const sections =
        document.querySelectorAll(
            "section[id]"
        );

    const navLinks =
        document.querySelectorAll(
            ".navbar-menu .nav-link"
        );


    function updateActiveLink() {

        if (!sections.length) {
            return;
        }


        let current = "";


        sections.forEach(
            (section) => {

                const sectionTop =
                    section.offsetTop - 160;

                const sectionHeight =
                    section.offsetHeight;


                if (
                    window.scrollY >= sectionTop &&
                    window.scrollY <
                    sectionTop + sectionHeight
                ) {

                    current =
                        section.getAttribute(
                            "id"
                        );
                }
            }
        );


        navLinks.forEach(
            (link) => {

                link.classList.remove(
                    "active"
                );


                const href =
                    link.getAttribute(
                        "href"
                    );


                if (
                    current &&
                    href === "#" + current
                ) {

                    link.classList.add(
                        "active"
                    );
                }


                if (
                    current &&
                    href &&
                    href.includes(
                        "#" + current
                    )
                ) {

                    link.classList.add(
                        "active"
                    );
                }
            }
        );
    }


    updateActiveLink();


    window.addEventListener(
        "scroll",
        updateActiveLink,
        {
            passive: true
        }
    );


    /*==================================================
                        RESIZE
    ==================================================*/

    window.addEventListener(
        "resize",
        () => {

            if (
                window.innerWidth > 1100
            ) {

                closeMobileMenu();
            }
        }
    );


    /*==================================================
                REAL-TIME NOTIFICATIONS
    ==================================================*/


    /*--------------------------------------------------
                RENDER NOTIFICATIONS
    --------------------------------------------------*/

    function renderNotifications(
        notifications,
        count
    ) {

        /*----------------------------------------------
                    DESKTOP BADGE
        ----------------------------------------------*/

        if (userNotificationsCount) {

            userNotificationsCount.textContent =
                count;


            if (count > 0) {

                userNotificationsCount.classList.remove(
                    "d-none"
                );

            } else {

                userNotificationsCount.classList.add(
                    "d-none"
                );
            }
        }


        /*----------------------------------------------
                    TOTAL COUNT
        ----------------------------------------------*/

        if (userNotificationsTotal) {

            userNotificationsTotal.textContent =
                count;
        }


        /*----------------------------------------------
                    MOBILE BADGE
        ----------------------------------------------*/

        const mobileBadge =
            document.querySelector(
                ".mobile-notifications-badge"
            );


        if (
            mobileNotificationsToggle &&
            count > 0
        ) {

            if (mobileBadge) {

                mobileBadge.textContent =
                    count;

            } else {

                const badge =
                    document.createElement(
                        "span"
                    );

                badge.className =
                    "mobile-notifications-badge";

                badge.textContent =
                    count;

                mobileNotificationsToggle.appendChild(
                    badge
                );
            }

        } else {

            if (mobileBadge) {

                mobileBadge.remove();
            }
        }


        /*----------------------------------------------
                    NOTIFICATION BODY
        ----------------------------------------------*/

        if (!userNotificationsBody) {
            return;
        }


        /*----------------------------------------------
                    EMPTY STATE
        ----------------------------------------------*/

        if (
            !notifications ||
            notifications.length === 0
        ) {

            userNotificationsBody.innerHTML = `

                <div class="user-notifications-empty">

                    <div class="user-notifications-empty-icon">

                        <i class="fa-regular fa-bell-slash"></i>

                    </div>


                    <strong>
                        No notifications
                    </strong>


                    <span>
                        You're all caught up.
                    </span>

                </div>

            `;

            return;
        }


        /*----------------------------------------------
                    NOTIFICATION ITEMS
        ----------------------------------------------*/

        userNotificationsBody.innerHTML =
            notifications
                .map(
                    (notification) => {

                        const icon =
                            notification.icon ||
                            "fa-bell";

                        const title =
                            notification.title ||
                            "Notification";

                        const message =
                            notification.message ||
                            "";

                        const url =
                            notification.url ||
                            "#";

                        const createdAt =
                            notification.created_at ||
                            "";


                        return `

                            <a
                                href="${url}"
                                class="user-notification-item"
                            >

                                <div class="user-notification-icon">

                                    <i class="fa-solid ${icon}"></i>

                                </div>


                                <div class="user-notification-content">

                                    <strong>
                                        ${title}
                                    </strong>


                                    <span>
                                        ${message}
                                    </span>


                                    ${
                                        createdAt
                                            ? `
                                                <small>
                                                    ${createdAt}
                                                </small>
                                            `
                                            : ""
                                    }

                                </div>


                                <i
                                    class="fa-solid fa-chevron-right user-notification-arrow"
                                ></i>

                            </a>

                        `;
                    }
                )
                .join("");
    }


    /*--------------------------------------------------
                CHECK NOTIFICATIONS
    --------------------------------------------------*/

    async function checkUserNotifications() {

        if (
            !userNotificationsCount &&
            !userNotificationsBody
        ) {

            return;
        }


        try {

            const response =
                await fetch(
                    "/notifications/check",
                    {
                        method: "GET",

                        headers: {
                            "Accept":
                                "application/json",

                            "X-Requested-With":
                                "XMLHttpRequest"
                        },

                        credentials:
                            "same-origin",

                        cache:
                            "no-store"
                    }
                );


            if (!response.ok) {
                return;
            }


            const data =
                await response.json();


            renderNotifications(
                data.notifications || [],
                Number(
                    data.count || 0
                )
            );


        } catch (error) {

            console.warn(
                "Notification polling failed:",
                error
            );
        }
    }


    /*==================================================
            INITIAL NOTIFICATION CHECK
    ==================================================*/

    checkUserNotifications();


    /*==================================================
            NOTIFICATION POLLING
    ==================================================*/

    setInterval(
        checkUserNotifications,
        5000
    );

});
