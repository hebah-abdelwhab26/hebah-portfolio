/*==================================================
    EDUCATION SCHEDULE
==================================================*/

document.addEventListener(
    "DOMContentLoaded",
    () => {


        /*==================================================
            ELEMENTS
        ==================================================*/

        const dayCards =
            document.querySelectorAll(
                ".education-day-card.has-slots"
            );


        /*==================================================
            MOBILE DETECTION
        ==================================================*/

        function isMobile() {

            return window.innerWidth <= 700;

        }


        /*==================================================
            CLOSE ALL DAYS
        ==================================================*/

        function closeAllDays(
            exceptCard = null
        ) {

            dayCards.forEach(
                (card) => {

                    if (
                        card !== exceptCard
                    ) {

                        card.classList.remove(
                            "active"
                        );

                    }

                }
            );

        }


        /*==================================================
            DAY CLICK
        ==================================================*/

        dayCards.forEach(
            (card) => {

                card.addEventListener(
                    "click",
                    (event) => {


                        /*
                            روابط التواصل
                            لا تحتاج إلى فتح البطاقة
                        */

                        if (
                            event.target.closest(
                                ".education-day-book"
                            )
                        ) {

                            return;

                        }


                        /*
                            Desktop

                            الـ Hover هو المسؤول
                            عن إظهار الأوقات.
                        */

                        if (
                            !isMobile()
                        ) {

                            return;

                        }


                        event.preventDefault();

                        event.stopPropagation();


                        const isActive =
                            card.classList.contains(
                                "active"
                            );


                        closeAllDays(
                            card
                        );


                        if (
                            isActive
                        ) {

                            card.classList.remove(
                                "active"
                            );

                        } else {

                            card.classList.add(
                                "active"
                            );

                        }

                    }
                );

            }
        );


        /*==================================================
            CLICK OUTSIDE
        ==================================================*/

        document.addEventListener(
            "click",
            (event) => {

                if (
                    !event.target.closest(
                        ".education-day-card"
                    )
                ) {

                    closeAllDays();

                }

            }
        );


        /*==================================================
            RESIZE
        ==================================================*/

        window.addEventListener(
            "resize",
            () => {

                /*
                    عندما ننتقل من الهاتف
                    إلى الكمبيوتر نغلق الحالة
                    المفتوحة.
                */

                if (
                    !isMobile()
                ) {

                    closeAllDays();

                }

            }
        );


        /*==================================================
            ESCAPE KEY
        ==================================================*/

        document.addEventListener(
            "keydown",
            (event) => {

                if (
                    event.key === "Escape"
                ) {

                    closeAllDays();

                }

            }
        );

    }
);
