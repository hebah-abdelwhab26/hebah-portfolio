/*==================================================
                    MAIN JS
==================================================*/

document.addEventListener("DOMContentLoaded", () => {



    /*==================================
            SCROLL PROGRESS
    ==================================*/

    const progressBar = document.getElementById("progressBar");

    window.addEventListener("scroll", () => {

        const scrollTop = window.pageYOffset;

        const docHeight =
            document.documentElement.scrollHeight - window.innerHeight;

        const progress = (scrollTop / docHeight) * 100;

        progressBar.style.width = progress + "%";

    });

    /*==================================
            BACK TO TOP
    ==================================*/

    const backToTop = document.getElementById("backToTop");

    window.addEventListener("scroll", () => {

        if (window.scrollY > 350) {

            backToTop.classList.add("show");

        } else {

            backToTop.classList.remove("show");

        }

    });

    backToTop.addEventListener("click", () => {

        window.scrollTo({

            top: 0,

            behavior: "smooth"

        });

    });
    /*==================================
        REVEAL ANIMATION
==================================*/

const sections = document.querySelectorAll(
    ".digital-page > section"
);

sections.forEach(section => {

    if (!section.classList.contains("hero-section")) {

        section.classList.add("reveal");

    }

});

const observer = new IntersectionObserver((entries) => {

    entries.forEach(entry => {

        if (entry.isIntersecting) {

            entry.target.classList.add("active");

        }

    });

},{

    threshold:0.15

});

sections.forEach(section=>{

    if(!section.classList.contains("hero-section")){

        observer.observe(section);

    }

});

/*==================================
        SMOOTH SCROLL
==================================*/

document.querySelectorAll('a[href^="#"]').forEach(anchor=>{

    anchor.addEventListener("click",function(e){

        const target=document.querySelector(this.getAttribute("href"));

        if(!target) return;

        e.preventDefault();

        target.scrollIntoView({

            behavior:"smooth",

            block:"start"

        });

    });

});
/*==================================
        ACTIVE SECTION
==================================*/

const pageSections = document.querySelectorAll("main section[id]");

const activateSection = () => {

    const scrollY = window.scrollY + 120;

    pageSections.forEach(section => {

        const top = section.offsetTop;
        const height = section.offsetHeight;
        const id = section.getAttribute("id");

        if (scrollY >= top && scrollY < top + height) {

            document
                .querySelectorAll('.nav-link[href^="#"]')
                .forEach(link => {

                    link.classList.remove("active");

                });

            const activeLink = document.querySelector(
                `.nav-link[href="#${id}"]`
            );

            if (activeLink) {

                activeLink.classList.add("active");

            }

        }

    });

};

window.addEventListener("scroll", activateSection, {

    passive: true

});

activateSection();

});
