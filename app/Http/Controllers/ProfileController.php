<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use App\Rules\StrongPassword;

class ProfileController extends Controller
{
    /**
     * ==========================================
     * Display the user's profile page.
     * ==========================================
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }


    /**
     * ==========================================
     * Update the user's profile information.
     * ==========================================
     */
    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();


        /*
        |----------------------------------------------------------------------
        | Validate Profile Data
        |----------------------------------------------------------------------
        */

        $validated = $request->validate([

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'username' => [
                'required',
                'string',
                'max:255',
                'alpha_dash',

                Rule::unique('users', 'username')
                    ->ignore($user->id),
            ],

            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',

                Rule::unique('users', 'email')
                    ->ignore($user->id),
            ],

            'phone' => [
                'nullable',
                'string',
                'max:30',
            ],

            'bio' => [
                'nullable',
                'string',
                'max:1000',
            ],

        ], [

            'name.required' =>
                'Please enter your full name.',

            'username.required' =>
                'Please choose a username.',

            'username.alpha_dash' =>
                'Username may only contain letters, numbers, dashes and underscores.',

            'username.unique' =>
                'This username is already in use.',

            'email.required' =>
                'Please enter your email address.',

            'email.email' =>
                'Please enter a valid email address.',

            'email.unique' =>
                'This email address is already registered.',

        ]);


        /*
        |----------------------------------------------------------------------
        | Update User Information
        |----------------------------------------------------------------------
        */

        $user->fill([

            'name' => $validated['name'],

            'username' => $validated['username'],

            'email' => $validated['email'],

            'phone' => $validated['phone'] ?? null,

            'bio' => $validated['bio'] ?? null,

        ]);


        /*
        |----------------------------------------------------------------------
        | Save
        |----------------------------------------------------------------------
        */

        $user->save();


        /*
        |----------------------------------------------------------------------
        | Redirect
        |----------------------------------------------------------------------
        */

        return redirect()
            ->route('profile.edit')
            ->with(
                'status',
                'Your profile has been updated successfully.'
            );
    }


    /**
     * ==========================================
     * Update the user's password.
     * ==========================================
     */
    public function updatePassword(Request $request): RedirectResponse
    {
        $user = $request->user();


        /*
        |----------------------------------------------------------------------
        | Validate Password
        |----------------------------------------------------------------------
        |
        | StrongPassword is the same custom rule used during registration.
        |
        */

        $validated = $request->validate([

            'current_password' => [
                'required',
                'current_password',
            ],

            'password' => [
                'required',
                'confirmed',
                new StrongPassword(),
            ],

        ], [

            'current_password.required' =>
                'Please enter your current password.',

            'current_password.current_password' =>
                'The current password is incorrect.',

            'password.required' =>
                'Please enter a new password.',

            'password.confirmed' =>
                'Password confirmation does not match.',

        ]);


        /*
        |----------------------------------------------------------------------
        | Update Password
        |----------------------------------------------------------------------
        */

        $user->update([

            'password' => Hash::make(
                $validated['password']
            ),

        ]);


        /*
        |----------------------------------------------------------------------
        | Redirect
        |----------------------------------------------------------------------
        */

        return redirect()
            ->route('profile.edit')
            ->with(
                'status',
                'Your password has been changed successfully.'
            );
    }
}
