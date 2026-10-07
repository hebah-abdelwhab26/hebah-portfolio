import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


/*==================================================
| AUTH - PASSWORD TOGGLE
==================================================*/

document.addEventListener('DOMContentLoaded', () => {

    const passwordToggles =
        document.querySelectorAll('.auth-password-toggle');


    passwordToggles.forEach((toggle) => {

        toggle.addEventListener('click', () => {

            const wrapper =
                toggle.closest('.auth-password-wrapper');


            if (!wrapper) {
                return;
            }


            const passwordInput =
                wrapper.querySelector(
                    'input[type="password"], input[type="text"]'
                );


            const icon =
                toggle.querySelector('i');


            if (!passwordInput) {
                return;
            }


            const isPassword =
                passwordInput.type === 'password';


            /*------------------------------------------
                SHOW PASSWORD
            ------------------------------------------*/

            if (isPassword) {

                passwordInput.type = 'text';


                if (icon) {

                    icon.classList.remove(
                        'fa-eye'
                    );

                    icon.classList.add(
                        'fa-eye-slash'
                    );
                }


                toggle.setAttribute(
                    'aria-label',
                    'Hide password'
                );


                toggle.setAttribute(
                    'title',
                    'Hide password'
                );

            }


            /*------------------------------------------
                HIDE PASSWORD
            ------------------------------------------*/

            else {

                passwordInput.type = 'password';


                if (icon) {

                    icon.classList.remove(
                        'fa-eye-slash'
                    );

                    icon.classList.add(
                        'fa-eye'
                    );
                }


                toggle.setAttribute(
                    'aria-label',
                    'Show password'
                );


                toggle.setAttribute(
                    'title',
                    'Show password'
                );
            }

        });

    });

});
