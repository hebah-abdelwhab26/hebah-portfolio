document.addEventListener("DOMContentLoaded", () => {

    new Swiper(".technologiesSwiper", {

        loop: true,

        speed: 900,

        centeredSlides: true,

        slidesPerView: "auto",

        spaceBetween: 30,

        grabCursor: true,

        watchSlidesProgress: true,

        autoplay: {

            delay: 3500,

            disableOnInteraction: false,

            pauseOnMouseEnter: true,

        },

        navigation: {

            nextEl: ".tech-next",

            prevEl: ".tech-prev",

        },

        pagination: {

            el: ".tech-pagination",

            clickable: true,

        },

        breakpoints: {

            0: {

                slidesPerView: 1.15,

                centeredSlides: true,

                spaceBetween: 20,

            },

            768: {

                slidesPerView: 1.5,

                centeredSlides: true,

                spaceBetween: 25,

            },

            992: {

                slidesPerView: 2.2,

                centeredSlides: true,

                spaceBetween: 30,

            },

            1200: {

                slidesPerView: 3,

                centeredSlides: true,

                spaceBetween: 35,

            }

        }

    });

});
