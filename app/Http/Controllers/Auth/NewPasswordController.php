<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Rules\StrongPassword;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    /**
     * ==========================================
     * Display Password Reset View
     * ==========================================
     */
    public function create(Request $request): View
    {
        return view('auth.reset-password', [
            'request' => $request,
        ]);
    }


    /**
     * ==========================================
     * Handle Password Reset
     * ==========================================
     *
     * This method uses the same StrongPassword
     * rule used during registration and when
     * changing the password from the profile.
     *
     * This keeps the password policy consistent
     * throughout the entire application.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        /*
        |--------------------------------------------------------------------------
        | Validate Request
        |--------------------------------------------------------------------------
        */

        $request->validate([

            'token' => [
                'required',
            ],

            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
            ],

            'password' => [
                'required',
                'confirmed',
                new StrongPassword(),
            ],

        ], [

            'email.required' =>
                'Please enter your email address.',

            'email.email' =>
                'Please enter a valid email address.',

            'password.required' =>
                'Please enter a new password.',

            'password.confirmed' =>
                'Password confirmation does not match.',

        ]);


        /*
        |--------------------------------------------------------------------------
        | Attempt Password Reset
        |--------------------------------------------------------------------------
        */

        $status = Password::reset(

            $request->only(
                'email',
                'password',
                'password_confirmation',
                'token'
            ),

            function (User $user) use ($request) {

                /*
                |--------------------------------------------------------------------------
                | Update Password
                |--------------------------------------------------------------------------
                */

                $user->forceFill([

                    'password' => Hash::make(
                        $request->password
                    ),

                    /*
                    |------------------------------------------------------------------
                    | Invalidate existing remember sessions
                    |------------------------------------------------------------------
                    */

                    'remember_token' => Str::random(60),

                ])->save();


                /*
                |--------------------------------------------------------------------------
                | Password Reset Event
                |--------------------------------------------------------------------------
                */

                event(new PasswordReset($user));
            }
        );


        /*
        |--------------------------------------------------------------------------
        | Password Reset Result
        |--------------------------------------------------------------------------
        */

        if ($status === Password::PASSWORD_RESET) {

            return redirect()
                ->route('login')
                ->with(
                    'status',
                    'Your password has been reset successfully. You can now log in with your new password.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Reset Failed
        |--------------------------------------------------------------------------
        */

        return back()
            ->withInput(
                $request->only('email')
            )
            ->withErrors([
                'email' => __($status),
            ]);
    }
}
