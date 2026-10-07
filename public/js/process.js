/*==================================================
                PROCESS TIMELINE
==================================================*/

document.addEventListener("DOMContentLoaded", () => {

    /*==========================================
                ELEMENTS
    ==========================================*/

    const timelineItems =
        document.querySelectorAll(".timeline-item");

    const processSection =
        document.querySelector(".process-section");

    /*==========================================
            SCROLL ANIMATION
    ==========================================*/

    const observer = new IntersectionObserver(

        (entries)=>{

            entries.forEach(entry=>{

                if(entry.isIntersecting){

                    entry.target.classList.add("show");

                }

            });

        },

        {

            threshold:.20,

            rootMargin:"0px 0px -80px 0px"

        }

    );

    timelineItems.forEach((item,index)=>{

        item.style.transitionDelay =
            `${index * 180}ms`;

        observer.observe(item);

    });

    /*==========================================
            ACTIVE TIMELINE ITEM
    ==========================================*/

    function updateActiveItem(){

        const trigger =
            window.innerHeight * .45;

        timelineItems.forEach(item=>{

            const rect =
                item.getBoundingClientRect();

            if(
                rect.top < trigger &&
                rect.bottom > trigger
            ){

                item.classList.add("active");

            }else{

                item.classList.remove("active");

            }

        });

    }

    window.addEventListener(
        "scroll",
        updateActiveItem
    );

    updateActiveItem();
        /*==========================================
            PARALLAX BACKGROUND
    ==========================================*/

    let ticking = false;

    function updateParallax(){

        const scrollY = window.scrollY;

        if(processSection){

            processSection.style.backgroundPositionY =
                `${scrollY * 0.15}px`;

        }

        ticking = false;

    }

    window.addEventListener("scroll",()=>{

        if(!ticking){

            requestAnimationFrame(updateParallax);

            ticking = true;

        }

    });

    /*==========================================
            TIMELINE HOVER EFFECT
    ==========================================*/

    timelineItems.forEach(item=>{

        item.addEventListener("mouseenter",()=>{

            item.style.zIndex = "5";

            const dot = item.querySelector(".timeline-dot");

            if(dot){

                dot.style.boxShadow =
                    "0 0 45px rgba(37,99,235,.65)";

            }

        });

        item.addEventListener("mouseleave",()=>{

            item.style.zIndex = "";

            const dot = item.querySelector(".timeline-dot");

            if(dot){

                dot.style.boxShadow = "";

            }

        });

    });

    /*==========================================
            SMOOTH APPEAR ON LOAD
    ==========================================*/

    setTimeout(()=>{

        updateActiveItem();

    },200);

});
