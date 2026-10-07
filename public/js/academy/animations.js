/*==================================================
                ANIMATIONS CLASS
==================================================*/

class AcademyAnimations {

    constructor() {

        this.observer = null;

        this.options = {

            threshold: 0.15,

            rootMargin: "0px 0px -80px 0px"

        };

    }

    /*==================================
                INIT
    ==================================*/

    init() {

        this.createObserver();

        this.observeElements();

    }

    /*==================================
            CREATE OBSERVER
    ==================================*/

    createObserver() {

        this.observer = new IntersectionObserver(

            this.handleIntersect.bind(this),

            this.options

        );

    }

    /*==================================
            OBSERVE ELEMENTS
    ==================================*/

    observeElements() {

        const elements = document.querySelectorAll(

            ".fade-up, .fade-left, .fade-right, .zoom-in"

        );

        elements.forEach(element => {

            this.observer.observe(element);

        });

    }

    /*==================================
            HANDLE INTERSECTION
    ==================================*/

    handleIntersect(entries) {

        entries.forEach(entry => {

            if (!entry.isIntersecting) return;

            entry.target.classList.add("show");

            this.observer.unobserve(entry.target);

        });

    }

};
