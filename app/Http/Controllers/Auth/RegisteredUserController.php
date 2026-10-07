<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Rules\StrongPassword;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * ==========================================
     * Display Registration View
     * ==========================================
     */
    public function create(): View
    {
        return view('auth.register');
    }


    /**
     * ==========================================
     * Handle Registration
     * ==========================================
     */
    public function store(Request $request): RedirectResponse
    {
        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            /*
            |----------------------------------------------------------------------
            | Name
            |----------------------------------------------------------------------
            */

            'name' => [
                'required',
                'string',
                'max:255',
            ],


            /*
            |----------------------------------------------------------------------
            | Username
            |----------------------------------------------------------------------
            */

            'username' => [
                'required',
                'string',
                'max:255',
                'alpha_dash',
                'unique:users,username',
            ],


            /*
            |----------------------------------------------------------------------
            | Email
            |----------------------------------------------------------------------
            */

            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                'unique:users,email',
            ],


            /*
            |----------------------------------------------------------------------
            | Phone
            |----------------------------------------------------------------------
            */

            'phone' => [
                'nullable',
                'string',
                'max:50',
            ],


            /*
            |----------------------------------------------------------------------
            | Password
            |----------------------------------------------------------------------
            |
            | StrongPassword requires:
            |
            | - Minimum 8 characters
            | - Uppercase letter
            | - Lowercase letter
            | - Number
            | - Special character
            | - Password confirmation
            |
            */

            'password' => [
                'required',
                'confirmed',
                new StrongPassword(),
            ],


            /*
            |----------------------------------------------------------------------
            | Terms
            |----------------------------------------------------------------------
            */

            'terms' => [
                'accepted',
            ],

        ], [

            /*
            |----------------------------------------------------------------------
            | Custom Validation Messages
            |----------------------------------------------------------------------
            */

            'name.required' =>
                'Please enter your full name.',

            'name.max' =>
                'Your name may not exceed 255 characters.',


            'username.required' =>
                'Please choose a username.',

            'username.alpha_dash' =>
                'Username may only contain letters, numbers, dashes and underscores.',

            'username.unique' =>
                'This username is already in use.',

            'username.max' =>
                'Username may not exceed 255 characters.',


            'email.required' =>
                'Please enter your email address.',

            'email.email' =>
                'Please enter a valid email address.',

            'email.unique' =>
                'This email address is already registered.',

            'email.max' =>
                'Email address may not exceed 255 characters.',


            'phone.max' =>
                'Phone number may not exceed 50 characters.',


            'password.required' =>
                'Please enter a password.',

            'password.confirmed' =>
                'Password confirmation does not match.',


            'terms.accepted' =>
                'You must accept the Terms & Conditions and Privacy Policy.',

        ]);


        /*
        |--------------------------------------------------------------------------
        | Create User
        |--------------------------------------------------------------------------
        |
        | IMPORTANT:
        |
        | role and status are NOT taken from the request.
        |
        | Public registration always creates a normal active user.
        |
        */

        $user = User::create([

            'name' => $validated['name'],

            'username' => $validated['username'],

            'email' => $validated['email'],

            'phone' => $validated['phone'] ?? null,

            'password' => Hash::make(
                $validated['password']
            ),

            'role' => 'user',

            'status' => 'active',

        ]);


        /*
        |--------------------------------------------------------------------------
        | Registered Event
        |--------------------------------------------------------------------------
        */

        event(new Registered($user));


        /*
        |--------------------------------------------------------------------------
        | Login User
        |--------------------------------------------------------------------------
        |
        | After successful registration the user is automatically
        | authenticated and sent to the public website.
        |
        */

        Auth::login($user);


        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('portal')
            ->with(
                'success',
                'Welcome to Hebah Web! Your account has been created successfully.'
            );
    }
}
