/*==================================================
            ABOUT BOOK FLIP SCRIPT
==================================================*/


const aboutPages = document.querySelectorAll(".about-page");


if (aboutPages.length > 0) {


    let isAnimating = false;



    aboutPages.forEach((page, index) => {



        let flipped = false;



        // Initial stacking

        page.style.zIndex =
            aboutPages.length - index;





        /*========================
                CLICK FLIP
        ========================*/


        page.addEventListener("click", () => {



            if (isAnimating) return;



            isAnimating = true;





            /* FLIP FORWARD */


            if (!flipped) {



                page.style.transform =
                    "rotateY(-180deg)";



                flipped = true;





                const resetForwardZ = () => {



                    page.style.zIndex = index;



                    isAnimating = false;



                    page.removeEventListener(
                        "transitionend",
                        resetForwardZ
                    );


                };





                page.addEventListener(
                    "transitionend",
                    resetForwardZ
                );



            }






            /* FLIP BACKWARD */


            else {



                page.style.transform =
                    "rotateY(0deg)";



                flipped = false;





                page.style.zIndex =
                    aboutPages.length + index;





                const resetBackwardZ = () => {



                    page.style.zIndex =
                        aboutPages.length - index;



                    isAnimating = false;



                    page.removeEventListener(
                        "transitionend",
                        resetBackwardZ
                    );


                };





                page.addEventListener(
                    "transitionend",
                    resetBackwardZ
                );



            }




        });




    });



}
