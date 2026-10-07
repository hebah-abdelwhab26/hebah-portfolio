/*==================================================
    EDUCATION RESOURCES SLIDER
==================================================*/

document.addEventListener("DOMContentLoaded", () => {

    const track =
        document.querySelector(
            ".education-resources-track"
        );

    const prevButton =
        document.querySelector(
            ".education-resource-prev"
        );

    const nextButton =
        document.querySelector(
            ".education-resource-next"
        );


    if (
        !track ||
        !prevButton ||
        !nextButton
    ) {
        return;
    }


    /*==================================================
        GET CARD
    ==================================================*/

    const getCard = () => {

        return track.querySelector(
            ".education-resource-card"
        );

    };


    /*==================================================
        SLIDE NEXT
    ==================================================*/

    nextButton.addEventListener(
        "click",
        () => {

            const card = getCard();

            if (!card) {
                return;
            }


            const gap = 20;

            const amount =
                card.offsetWidth + gap;


            track.scrollBy({
                left: -amount,
                behavior: "smooth"
            });

        }
    );


    /*==================================================
        SLIDE PREVIOUS
    ==================================================*/

    prevButton.addEventListener(
        "click",
        () => {

            const card = getCard();

            if (!card) {
                return;
            }


            const gap = 20;

            const amount =
                card.offsetWidth + gap;


            track.scrollBy({
                left: amount,
                behavior: "smooth"
            });

        }
    );


    /*==================================================
        DRAG WITH MOUSE
    ==================================================*/

    let isDown = false;
    let startX = 0;
    let scrollLeft = 0;


    track.addEventListener(
        "mousedown",
        (event) => {

            isDown = true;

            track.classList.add(
                "is-dragging"
            );

            startX = event.pageX -
                track.offsetLeft;

            scrollLeft =
                track.scrollLeft;

        }
    );


    track.addEventListener(
        "mouseleave",
        () => {

            isDown = false;

            track.classList.remove(
                "is-dragging"
            );

        }
    );


    track.addEventListener(
        "mouseup",
        () => {

            isDown = false;

            track.classList.remove(
                "is-dragging"
            );

        }
    );


    track.addEventListener(
        "mousemove",
        (event) => {

            if (!isDown) {
                return;
            }


            event.preventDefault();


            const x =
                event.pageX -
                track.offsetLeft;


            const walk =
                (x - startX) * 1.2;


            track.scrollLeft =
                scrollLeft - walk;

        }
    );

});
