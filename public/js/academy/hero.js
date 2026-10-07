/*==================================================
                    HERO ANIMATIONS
==================================================*/

document.addEventListener("DOMContentLoaded", () => {

    const hero = document.querySelector(".academy-hero");

    if (!hero) return;

    const animatedElements = [

        ".hero-badge",

        ".hero-title",

        ".hero-description",

        ".hero-buttons",

        ".hero-features",

        ".hero-visual"

    ];

    animatedElements.forEach((selector, index) => {

        const element = document.querySelector(selector);

        if (!element) return;

        element.style.opacity = "0";

        element.style.transform = "translateY(40px)";

        element.style.transition =

            "all .8s ease";

        setTimeout(() => {

            element.style.opacity = "1";

            element.style.transform =

                "translateY(0)";

        }, 200 * index);

    });

});
/*==================================================
                PARALLAX EFFECT
==================================================*/

window.addEventListener("mousemove",(e)=>{

    const hero=document.querySelector(".hero-visual");

    if(!hero) return;

    const x=(window.innerWidth/2-e.clientX)/35;

    const y=(window.innerHeight/2-e.clientY)/35;

    hero.style.transform=

        `translate(${x}px,${y}px)`;

});
/*==================================================
                FLOATING GLOW
==================================================*/

const glow=document.querySelector(".hero-glow");

if(glow){

    let angle=0;

    setInterval(()=>{

        angle+=0.4;

        glow.style.transform=

            `rotate(${angle}deg) scale(1.03)`;

    },40);

}
/*==================================================
                BUTTON RIPPLE
==================================================*/

document

.querySelectorAll(".hero-buttons .btn")

.forEach(button=>{

    button.addEventListener("mouseenter",()=>{

        button.style.transition=".35s";

        button.style.transform="translateY(-5px)";

    });

    button.addEventListener("mouseleave",()=>{

        button.style.transform="translateY(0)";

    });

});
/*==================================================
            LIVE STATUS ANIMATION
==================================================*/

const liveDot=document.querySelector(".live-dot");

if(liveDot){

    setInterval(()=>{

        liveDot.classList.toggle("active");

    },900);

}

