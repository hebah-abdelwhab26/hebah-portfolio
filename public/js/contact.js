/*==================================================
                CONTACT FORM
==================================================*/

document.addEventListener("DOMContentLoaded", () => {

    const form = document.getElementById("contactForm");

    if (!form) return;


    form.addEventListener("submit", async function (e) {

        e.preventDefault();


        const button = form.querySelector(".contact-btn");

        if (!button) return;


        const originalHTML = button.innerHTML;


        /*
        |--------------------------------------------------------------------------
        | Disable Button
        |--------------------------------------------------------------------------
        */

        button.disabled = true;

        button.innerHTML = `
            <i class="fa-solid fa-spinner fa-spin"></i>
            <span>Sending...</span>
        `;


        /*
        |--------------------------------------------------------------------------
        | Remove Previous Form Message
        |--------------------------------------------------------------------------
        */

        const oldMessage =
            form.querySelector(".contact-form-message");

        if (oldMessage) {

            oldMessage.remove();

        }


        /*
        |--------------------------------------------------------------------------
        | Form Data
        |--------------------------------------------------------------------------
        */

        const formData = new FormData(form);


        /*
        |--------------------------------------------------------------------------
        | Send Request
        |--------------------------------------------------------------------------
        */

        try {

            const response = await fetch(form.action, {

                method: "POST",

                body: formData,

                headers: {

                    "X-CSRF-TOKEN":
                        document
                            .querySelector('meta[name="csrf-token"]')
                            ?.getAttribute("content"),

                    "X-Requested-With": "XMLHttpRequest"

                },

                redirect: "follow"

            });


            /*
            |--------------------------------------------------------------------------
            | Laravel Redirect
            |--------------------------------------------------------------------------
            |
            | ContactController returns back()->with(...)
            | so Laravel responds with a redirect to the contact page.
            |
            */

            if (
                response.redirected ||
                response.ok
            ) {

                /*
                |--------------------------------------------------------------------------
                | Success
                |--------------------------------------------------------------------------
                */

                button.innerHTML = `
                    <i class="fa-solid fa-circle-check"></i>
                    <span>Message Sent</span>
                `;


                button.style.background =
                    "linear-gradient(135deg,#10B981,#34D399)";


                /*
                |--------------------------------------------------------------------------
                | Reset Form
                |--------------------------------------------------------------------------
                */

                form.reset();


                /*
                |--------------------------------------------------------------------------
                | Success Message
                |--------------------------------------------------------------------------
                */

                const successMessage =
                    document.createElement("div");


                successMessage.className =
                    "contact-form-message success";


                successMessage.innerHTML = `
                    <i class="fa-solid fa-circle-check"></i>
                    <span>
                        Message sent successfully.
                    </span>
                `;


                form.prepend(successMessage);


                /*
                |--------------------------------------------------------------------------
                | Restore Button
                |--------------------------------------------------------------------------
                */

                setTimeout(() => {

                    button.disabled = false;

                    button.innerHTML = originalHTML;

                    button.style.background = "";

                }, 2500);


                return;

            }


            /*
            |--------------------------------------------------------------------------
            | Request Failed
            |--------------------------------------------------------------------------
            */

            throw new Error(
                "Something went wrong while sending your message."
            );


        } catch (error) {


            /*
            |--------------------------------------------------------------------------
            | Error Message
            |--------------------------------------------------------------------------
            */

            const errorMessage =
                document.createElement("div");


            errorMessage.className =
                "contact-form-message error";


            errorMessage.innerHTML = `
                <i class="fa-solid fa-circle-exclamation"></i>
                <span>
                    ${error.message ||
                    "Something went wrong while sending your message."}
                </span>
            `;


            form.prepend(errorMessage);


            /*
            |--------------------------------------------------------------------------
            | Restore Button
            |--------------------------------------------------------------------------
            */

            button.disabled = false;

            button.innerHTML = originalHTML;

            button.style.background = "";

        }

    });

});
