/*==================================================
                    UTILITIES
==================================================*/

class AcademyUtils {

    /*==================================
            SELECT ELEMENT
    ==================================*/

    static $(selector) {

        return document.querySelector(selector);

    }

    /*==================================
            SELECT ALL
    ==================================*/

    static $$(selector) {

        return document.querySelectorAll(selector);

    }

    /*==================================
            ADD CLASS
    ==================================*/

    static addClass(element, className) {

        if (!element) return;

        element.classList.add(className);

    }

    /*==================================
            REMOVE CLASS
    ==================================*/

    static removeClass(element, className) {

        if (!element) return;

        element.classList.remove(className);

    }

    /*==================================
            TOGGLE CLASS
    ==================================*/

    static toggleClass(element, className) {

        if (!element) return;

        element.classList.toggle(className);

    }

    /*==================================
            SMOOTH SCROLL
    ==================================*/

    static scrollTo(target) {

        const section = document.querySelector(target);

        if (!section) return;

        section.scrollIntoView({

            behavior: "smooth",

            block: "start"

        });

    }

    /*==================================
            RANDOM
    ==================================*/

    static random(min, max) {

        return Math.floor(

            Math.random() * (max - min + 1)

        ) + min;

    }

}
