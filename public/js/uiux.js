/*==================================================
                UI / UX SECTION
==================================================*/

document.addEventListener("DOMContentLoaded", () => {

    /*==========================================
                FILTER SYSTEM
    ==========================================*/

    const filterButtons =
        document.querySelectorAll(".filter-btn");

    const cards =
        document.querySelectorAll(
            ".design-card, .phone-card"
        );

    filterButtons.forEach(button => {

        button.addEventListener("click", () => {

            /*==================================
                    ACTIVE BUTTON
            ==================================*/

            filterButtons.forEach(btn => {

                btn.classList.remove("active");

            });

            button.classList.add("active");

            /*==================================
                    FILTER VALUE
            ==================================*/

            const filter =
                button.dataset.filter;

            cards.forEach(card => {

                const category =
                    card.dataset.category || "";

                if (
                    filter === "all" ||
                    category.includes(filter)
                ) {

                    card.style.display = "";

                    requestAnimationFrame(() => {

                        card.style.opacity = "1";

                        card.style.transform =
                            "translateY(0) scale(1)";

                    });

                } else {

                    card.style.opacity = "0";

                    card.style.transform =
                        "translateY(20px) scale(.96)";

                    setTimeout(() => {

                        card.style.display = "none";

                    },250);

                }

            });

        });

    });

    /*==========================================
            OPEN PROJECT PAGE
    ==========================================*/

    document
        .querySelectorAll(
            ".design-card, .phone-card"
        )
        .forEach(card => {

            card.addEventListener("click", e => {

                /*
                ==================================
                    Ignore Lightbox Click
                ==================================
                */

                if (
                    e.target.closest(".portfolio-lightbox")
                ) {

                    return;

                }

                const url = card.dataset.url;

                if (url) {

                    window.location.href = url;

                }

            });

        });
            /*==========================================
            RESET CARDS ON PAGE SHOW
    ==========================================*/

    window.addEventListener("pageshow", () => {

        cards.forEach(card => {

            card.style.display = "";

            card.style.opacity = "1";

            card.style.transform =
                "translateY(0) scale(1)";

        });

    });

    /*==========================================
            SMOOTH HOVER EFFECT
    ==========================================*/

    cards.forEach(card => {

        card.addEventListener("mouseenter", () => {

            card.style.willChange =
                "transform";

        });

        card.addEventListener("mouseleave", () => {

            card.style.willChange =
                "auto";

        });

    });

    /*==========================================
            END
    ==========================================*/

});
