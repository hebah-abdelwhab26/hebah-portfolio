/*==================================================
            PREMIUM BACKGROUND
==================================================*/

document.addEventListener("DOMContentLoaded", () => {

    /*==================================================
                STARS
    ==================================================*/

    const starsContainer =
        document.getElementById("stars");

    if (starsContainer) {

        const starsCount = 38;

        const colors = [

            "#ffffff",
            "#ffffff",
            "#ffffff",
            "#ffffff",
            "#ffffff",

            "#60A5FA",
            "#60A5FA",

            "#FFD166"

        ];

        /*
         * Create stars only once.
         * This prevents duplicate stars if another
         * script triggers initialization again.
         */

        if (!starsContainer.dataset.initialized) {

            starsContainer.dataset.initialized = "true";

            for (let i = 0; i < starsCount; i++) {

                const star =
                    document.createElement("span");

                star.className = "star";

                const size =
                    Math.random() * 4 + 2;

                star.style.width =
                    size + "px";

                star.style.height =
                    size + "px";

                star.style.left =
                    Math.random() * 100 + "%";

                star.style.top =
                    Math.random() * 100 + "%";

                star.style.background =
                    colors[
                        Math.floor(
                            Math.random() * colors.length
                        )
                    ];

                star.style.color =
                    star.style.background;

                star.style.opacity =
                    (
                        Math.random() * 0.5 + 0.35
                    ).toFixed(2);

                /*
                 * Keep animation duration independent
                 * for each star.
                 */

                star.style.animationDuration =
                    (
                        5 + Math.random() * 8
                    ) + "s";

                /*
                 * Negative delay makes the stars appear
                 * naturally animated immediately.
                 */

                star.style.animationDelay =
                    (
                        -Math.random() * 8
                    ) + "s";

                star.style.setProperty(
                    "--float",
                    (
                        Math.random() * 12 + 6
                    ) + "px"
                );

                starsContainer.appendChild(star);

            }

        }

    }


    /*==================================================
                CONSTELLATION
    ==================================================*/

    const constellation =
        document.getElementById("constellation");

    if (
        constellation &&
        !constellation.dataset.initialized
    ) {

        constellation.dataset.initialized = "true";

        for (let i = 0; i < 12; i++) {

            const line =
                document.createElement("span");

            line.className =
                "constellation-line";

            line.style.left =
                Math.random() * 100 + "%";

            line.style.top =
                Math.random() * 100 + "%";

            line.style.width =
                (
                    80 + Math.random() * 160
                ) + "px";

            line.style.transform =
                `translate3d(0, 0, 0) rotate(${Math.random() * 180}deg)`;

            line.style.animationDelay =
                (
                    -Math.random() * 8
                ) + "s";

            constellation.appendChild(line);

        }

    }


    /*==================================================
                SHOOTING STARS
    ==================================================*/

    const shootingContainer =
        document.getElementById("shootingStars");

    if (
        shootingContainer &&
        !shootingContainer.dataset.initialized
    ) {

        shootingContainer.dataset.initialized =
            "true";

        let shootingInterval = null;


        function createShootingStar() {

            /*
             * Do not create a new star if the page is
             * currently hidden. This avoids unnecessary
             * animation work in inactive tabs.
             */

            if (
                document.hidden ||
                !document.body.contains(shootingContainer)
            ) {

                return;

            }


            const star =
                document.createElement("span");

            star.className =
                "shooting-star";

            star.style.top =
                Math.random() * 45 + "%";

            star.style.left =
                (-20 - Math.random() * 20) + "px";

            star.style.animationDuration =
                (
                    2 + Math.random() * 1.5
                ) + "s";


            shootingContainer.appendChild(star);


            /*
             * Remove the element after its animation.
             * requestAnimationFrame is not needed here,
             * because the animation itself is CSS-driven.
             */

            const duration =
                parseFloat(
                    star.style.animationDuration
                ) * 1000;


            window.setTimeout(() => {

                if (star.parentNode) {

                    star.remove();

                }

            }, duration + 200);

        }


        /*
         * Start with one shooting star.
         */

        createShootingStar();


        /*
         * Keep only one interval.
         */

        shootingInterval =
            window.setInterval(
                createShootingStar,
                12000
            );


        /*
         * Stop the interval when the page is hidden.
         * This does not change the visual design.
         */

        document.addEventListener(
            "visibilitychange",
            () => {

                if (document.hidden) {

                    if (shootingInterval !== null) {

                        window.clearInterval(
                            shootingInterval
                        );

                        shootingInterval = null;

                    }

                } else {

                    if (shootingInterval === null) {

                        createShootingStar();

                        shootingInterval =
                            window.setInterval(
                                createShootingStar,
                                12000
                            );

                    }

                }

            }
        );

    }

});
