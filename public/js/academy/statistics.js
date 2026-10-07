/*==================================================
                STATISTICS COUNTER
==================================================*/

document.addEventListener("DOMContentLoaded", () => {

    const section = document.querySelector(".academy-statistics");

    if(!section) return;

    const counters = section.querySelectorAll(".counter");

    let started = false;

    function animateCounter(counter){

        const target = parseInt(counter.dataset.target);

        const duration = 1800;

        const start = performance.now();

        function update(now){

            const progress = Math.min(

                (now - start) / duration,

                1

            );

            const ease = 1 - Math.pow(1 - progress, 3);

            counter.textContent = Math.floor(

                ease * target

            );

            if(progress < 1){

                requestAnimationFrame(update);

            }else{

                counter.textContent = target;

            }

        }

        requestAnimationFrame(update);

    }
        function startCounters(){

        if(started) return;

        started = true;

        counters.forEach(counter => {

            animateCounter(counter);

        });

    }

    const observer = new IntersectionObserver(

        entries => {

            entries.forEach(entry => {

                if(entry.isIntersecting){

                    startCounters();

                    observer.disconnect();

                }

            });

        },

        {

            threshold:0.35

        }

    );

    observer.observe(section);

});
