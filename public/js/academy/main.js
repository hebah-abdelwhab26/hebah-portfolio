/*==================================================
                MAIN APPLICATION
==================================================*/

document.addEventListener("DOMContentLoaded", () => {

    if (typeof AcademyHero !== "undefined") {

        const hero = new AcademyHero();

        hero.init();

    }

    if (typeof AcademyNavbar !== "undefined") {

        const navbar = new AcademyNavbar();

        navbar.init();

    }

    if (typeof AcademyAnimations !== "undefined") {

        const animations = new AcademyAnimations();

        animations.init();

    }
    if (typeof AcademyPrograms !== "undefined") {

    const programs = new AcademyPrograms();

    programs.init();

}

});
