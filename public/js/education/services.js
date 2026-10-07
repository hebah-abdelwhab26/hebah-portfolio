/*==================================================
    EDUCATION SERVICES CAROUSEL
==================================================*/

document.addEventListener("DOMContentLoaded", function () {

    /*================================================
        CHECK JQUERY
    ================================================*/

    if (typeof window.jQuery === "undefined") {

        console.warn(
            "Education Services: jQuery is not loaded."
        );

        return;
    }


    /*================================================
        CHECK OWL CAROUSEL
    ================================================*/

    if (
        typeof window.jQuery.fn.owlCarousel ===
        "undefined"
    ) {

        console.warn(
            "Education Services: Owl Carousel is not loaded."
        );

        return;
    }


    /*================================================
        INITIALIZE
    ================================================*/

    const $carousel =
        window.jQuery(
            ".education-services-carousel"
        );


    if (!$carousel.length) {

        return;
    }


    $carousel.owlCarousel({

        /*--------------------------------------------
            LOOP
        --------------------------------------------*/

        loop: true,


        /*--------------------------------------------
            ITEMS
        --------------------------------------------*/

        items: 3,


        /*--------------------------------------------
            SPACE
        --------------------------------------------*/

        margin: 24,


        /*--------------------------------------------
            RTL
        --------------------------------------------*/

        rtl: true,


        /*--------------------------------------------
            DRAG
        --------------------------------------------*/

        mouseDrag: true,

        touchDrag: true,

        pullDrag: true,


        /*--------------------------------------------
            NAVIGATION
        --------------------------------------------*/

        nav: false,

        dots: true,


        /*--------------------------------------------
            AUTOPLAY
        --------------------------------------------*/

        autoplay: true,

        autoplayTimeout: 5000,

        autoplayHoverPause: true,

        autoplaySpeed: 800,


        /*--------------------------------------------
            ANIMATION
        --------------------------------------------*/

        smartSpeed: 700,


        /*--------------------------------------------
            RESPONSIVE
        --------------------------------------------*/

        responsive: {

            0: {

                items: 1,

                margin: 14

            },

            576: {

                items: 1,

                margin: 18

            },

            768: {

                items: 2,

                margin: 20

            },

            992: {

                items: 3,

                margin: 24

            },

            1200: {

                items: 3,

                margin: 26

            }

        }

    });


    /*================================================
        CUSTOM PREVIOUS BUTTON
    ================================================*/

    const previousButton =
        document.querySelector(
            ".education-services-prev"
        );


    if (previousButton) {

        previousButton.addEventListener(
            "click",
            function () {

                $carousel.trigger(
                    "prev.owl.carousel"
                );

            }
        );

    }


    /*================================================
        CUSTOM NEXT BUTTON
    ================================================*/

    const nextButton =
        document.querySelector(
            ".education-services-next"
        );


    if (nextButton) {

        nextButton.addEventListener(
            "click",
            function () {

                $carousel.trigger(
                    "next.owl.carousel"
                );

            }
        );

    }


    /*================================================
        PAUSE ON TOUCH
    ================================================*/

    $carousel.on(
        "drag.owl.carousel",
        function () {

            $carousel.trigger(
                "stop.owl.autoplay"
            );

        }
    );


    /*================================================
        RESUME AFTER DRAG
    ================================================*/

    $carousel.on(
        "translated.owl.carousel",
        function () {

            $carousel.trigger(
                "play.owl.autoplay",
                [5000]
            );

        }
    );

});
