const cards = document.querySelectorAll(".portal-card");

cards.forEach(card=>{

    const light = card.querySelector(".mouse-light");

    const defaultY =
        card.classList.contains("tech-card")
        ? 10
        : -10;

    card.addEventListener("mousemove",(e)=>{

        const rect = card.getBoundingClientRect();

        const x = e.clientX - rect.left;

        const y = e.clientY - rect.top;

        const rotateY =
            defaultY +
            ((x - rect.width/2)/18);

        const rotateX =
            -((y - rect.height/2)/30);

        card.style.transform =

        `
        perspective(1800px)
        rotateY(${rotateY}deg)
        rotateX(${rotateX}deg)
        translateY(-10px)
        scale(1.02)
        `;

        light.style.left = x + "px";

        light.style.top = y + "px";

    });

    card.addEventListener("mouseleave",()=>{

        card.style.transform=

        `
        perspective(1800px)
        rotateY(${defaultY}deg)
        rotateX(2deg)
        translateY(0)
        scale(1)
        `;

    });

});
