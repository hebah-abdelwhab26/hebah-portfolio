/*==================================================
                ELEMENTS
==================================================*/

const navbar = document.querySelector(".academy-navbar");

const mobileToggle = document.getElementById("mobileToggle");

const mobileMenu = document.getElementById("mobileMenu");

const mobileLinks = document.querySelectorAll(".mobile-menu a");

const navLinks = document.querySelectorAll(

    ".navbar-nav a, .mobile-menu a"

);

/*==================================================
                MOBILE MENU
==================================================*/

if(mobileToggle){

    mobileToggle.addEventListener("click",()=>{

        mobileToggle.classList.toggle("active");

        mobileMenu.classList.toggle("active");

    });

}

/*==================================================
            CLOSE MENU
==================================================*/

mobileLinks.forEach(link=>{

    link.addEventListener("click",()=>{

        mobileToggle.classList.remove("active");

        mobileMenu.classList.remove("active");

    });

});
/*==================================================
                SHRINK NAVBAR
==================================================*/

window.addEventListener("scroll",()=>{

    if(window.scrollY>60){

        navbar.classList.add("navbar-scrolled");

    }

    else{

        navbar.classList.remove("navbar-scrolled");

    }

});
/*==================================================
                ACTIVE SECTION
==================================================*/

const sections = document.querySelectorAll("section[id]");

function updateActiveLink(){

    const scrollY = window.scrollY + 180;

    sections.forEach(section=>{

        const sectionTop = section.offsetTop;

        const sectionHeight = section.offsetHeight;

        const sectionId = section.getAttribute("id");

        if(

            scrollY >= sectionTop &&
            scrollY < sectionTop + sectionHeight

        ){

            navLinks.forEach(link=>{

                link.classList.remove("active");

                if(

                    link.getAttribute("href") === "#" + sectionId

                ){

                    link.classList.add("active");

                }

            });

        }

    });

}

window.addEventListener("scroll",updateActiveLink);

updateActiveLink();
/*==================================================
            CLICK OUTSIDE
==================================================*/

document.addEventListener("click",(e)=>{

    if(

        !navbar.contains(e.target) &&

        mobileMenu.classList.contains("active")

    ){

        mobileMenu.classList.remove("active");

        mobileToggle.classList.remove("active");

    }

});
/*==================================================
                ESC KEY
==================================================*/

document.addEventListener("keydown",(e)=>{

    if(

        e.key==="Escape"

    ){

        mobileMenu.classList.remove("active");

        mobileToggle.classList.remove("active");

    }

});
/*==================================================
            SHOW / HIDE NAVBAR
==================================================*/

let lastScroll = 0;

window.addEventListener("scroll",()=>{

    const currentScroll = window.pageYOffset;

    if(currentScroll <= 20){

        navbar.classList.remove("navbar-hidden");

        lastScroll = currentScroll;

        return;

    }

    if(

        currentScroll > lastScroll &&

        currentScroll > 120

    ){

        navbar.classList.add("navbar-hidden");

    }

    else{

        navbar.classList.remove("navbar-hidden");

    }

    lastScroll = currentScroll;

});
