/*==================================================
    EDUCATION CONTACT
==================================================*/

document.addEventListener("DOMContentLoaded", () => {

    const form =
        document.querySelector(
            ".education-contact-form"
        );


    if (!form) {
        return;
    }


    const fields =
        form.querySelectorAll(
            "input, select, textarea"
        );


    fields.forEach((field) => {

        field.addEventListener(
            "blur",
            () => {

                if (
                    field.hasAttribute("required") &&
                    !field.value.trim()
                ) {

                    field.classList.add(
                        "education-field-error"
                    );

                } else {

                    field.classList.remove(
                        "education-field-error"
                    );

                }

            }
        );


        field.addEventListener(
            "input",
            () => {

                if (
                    field.value.trim()
                ) {

                    field.classList.remove(
                        "education-field-error"
                    );

                }

            }
        );

    });

});
