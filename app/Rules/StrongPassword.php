<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class StrongPassword implements ValidationRule
{
    /**
     * Validate the password strength.
     */
    public function validate(
        string $attribute,
        mixed $value,
        Closure $fail
    ): void {
        $password = (string) $value;


        /*
        |--------------------------------------------------------------------------
        | Minimum Length
        |--------------------------------------------------------------------------
        */

        if (mb_strlen($password) < 8) {

            $fail(
                'The password must be at least 8 characters.'
            );

            return;
        }


        /*
        |--------------------------------------------------------------------------
        | Uppercase Letter
        |--------------------------------------------------------------------------
        */

        if (! preg_match('/[A-Z]/', $password)) {

            $fail(
                'The password must contain at least one uppercase letter.'
            );

            return;
        }


        /*
        |--------------------------------------------------------------------------
        | Lowercase Letter
        |--------------------------------------------------------------------------
        */

        if (! preg_match('/[a-z]/', $password)) {

            $fail(
                'The password must contain at least one lowercase letter.'
            );

            return;
        }


        /*
        |--------------------------------------------------------------------------
        | Number
        |--------------------------------------------------------------------------
        */

        if (! preg_match('/[0-9]/', $password)) {

            $fail(
                'The password must contain at least one number.'
            );

            return;
        }


        /*
        |--------------------------------------------------------------------------
        | Special Character
        |--------------------------------------------------------------------------
        */

        if (! preg_match('/[^A-Za-z0-9]/', $password)) {

            $fail(
                'The password must contain at least one special character.'
            );

            return;
        }
    }
}
