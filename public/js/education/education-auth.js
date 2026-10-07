document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | PASSWORD VISIBILITY
    |--------------------------------------------------------------------------
    */

    const toggleButtons = document.querySelectorAll(
        '[data-password-toggle]'
    );


    toggleButtons.forEach(function (button) {

        button.addEventListener('click', function () {

            const inputId =
                button.getAttribute(
                    'data-password-toggle'
                );


            const input =
                document.getElementById(inputId);


            if (!input) {
                return;
            }


            const icon =
                button.querySelector('i');


            if (input.type === 'password') {

                input.type = 'text';


                button.setAttribute(
                    'aria-label',
                    'إخفاء كلمة المرور'
                );


                button.setAttribute(
                    'aria-pressed',
                    'true'
                );


                if (icon) {

                    icon.classList.remove(
                        'fa-eye'
                    );

                    icon.classList.add(
                        'fa-eye-slash'
                    );

                }

            } else {

                input.type = 'password';


                button.setAttribute(
                    'aria-label',
                    'إظهار كلمة المرور'
                );


                button.setAttribute(
                    'aria-pressed',
                    'false'
                );


                if (icon) {

                    icon.classList.remove(
                        'fa-eye-slash'
                    );

                    icon.classList.add(
                        'fa-eye'
                    );

                }

            }

        });

    });


    /*
    |--------------------------------------------------------------------------
    | SUBMIT FEEDBACK
    |--------------------------------------------------------------------------
    */

    const forms =
        document.querySelectorAll(
            '.education-auth-form'
        );


    forms.forEach(function (form) {

        form.addEventListener(
            'submit',
            function () {

                const submitButton =
                    form.querySelector(
                        '.education-auth-submit'
                    );


                if (!submitButton) {
                    return;
                }


                submitButton.classList.add(
                    'is-loading'
                );


                submitButton.disabled = true;

            }
        );

    });

});
