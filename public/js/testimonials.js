document.addEventListener("DOMContentLoaded", () => {

    const testimonialsSwiper =
        document.querySelector(".testimonialsSwiper");

    /*
     * Stop if the testimonials slider does not exist.
     */
    if (!testimonialsSwiper) {
        return;
    }

    /*
     * Swiper must already be loaded.
     */
    if (typeof Swiper === "undefined") {
        return;
    }

    /*
     * IMPORTANT:
     *
     * The comments page may already initialize the
     * slider through its own @push('scripts').
     *
     * Swiper exposes the active instance through
     * element.swiper.
     *
     * Therefore we must never initialize the same
     * slider twice.
     */
    if (testimonialsSwiper.swiper) {
        return;
    }

    const swiper =
        new Swiper(testimonialsSwiper, {

            loop: true,

            speed: 800,

            centeredSlides: true,

            grabCursor: true,

            spaceBetween: 30,

            slidesPerView: 3,

            autoplay: {

                delay: 5000,

                disableOnInteraction: false,

                pauseOnMouseEnter: true,

            },

            navigation: {

                nextEl:
                    testimonialsSwiper.querySelector(
                        ".swiper-button-next"
                    ),

                prevEl:
                    testimonialsSwiper.querySelector(
                        ".swiper-button-prev"
                    ),

            },

            pagination: {

                el:
                    testimonialsSwiper.querySelector(
                        ".swiper-pagination"
                    ),

                clickable: true,

            },

            breakpoints: {

                0: {

                    slidesPerView: 1,

                    spaceBetween: 20,

                },

                768: {

                    slidesPerView: 2,

                    spaceBetween: 25,

                },

                1200: {

                    slidesPerView: 3,

                    spaceBetween: 30,

                }

            },

            effect: "slide",

        });

});
