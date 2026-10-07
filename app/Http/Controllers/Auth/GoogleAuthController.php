<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    /**
     * Redirect the user to Google.
     */
  /*   public function redirect()
    {
        return Socialite::driver('google')->redirect();
    } */

public function redirect()
{
    return Socialite::driver('google')
        ->scopes([
            'openid',
            'profile',
            'email',
        ])
        ->redirect();
}
    /**
     * Handle Google's callback.
     */
    public function callback()
    {
        $googleUser = Socialite::driver('google')->user();

        /*
        |--------------------------------------------------------------------------
        | Find user by Google ID
        |--------------------------------------------------------------------------
        */

        $user = User::where(
            'google_id',
            $googleUser->getId()
        )->first();


        /*
        |--------------------------------------------------------------------------
        | Find existing user by email
        |--------------------------------------------------------------------------
        */

        if (!$user) {

            $user = User::where(
                'email',
                $googleUser->getEmail()
            )->first();


            /*
            |--------------------------------------------------------------------------
            | Connect Google to existing account
            |--------------------------------------------------------------------------
            */

            if ($user) {

                $user->update([
                    'google_id' => $googleUser->getId(),

                    'email_verified_at' =>
                        $user->email_verified_at ?? now(),
                ]);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Create new user
        |--------------------------------------------------------------------------
        */

        if (!$user) {

            $name = $googleUser->getName()
                ?: $googleUser->getNickname()
                ?: 'Google User';

            $email = $googleUser->getEmail();


            /*
            |--------------------------------------------------------------------------
            | Generate unique username
            |--------------------------------------------------------------------------
            */

            $username = Str::slug(
                Str::before($email, '@')
            );

            if (!$username) {
                $username = 'user';
            }

            $baseUsername = $username;
            $counter = 1;

            while (
                User::where(
                    'username',
                    $username
                )->exists()
            ) {
                $username = $baseUsername . $counter;
                $counter++;
            }


            $user = User::create([

                'name' => $name,

                'username' => $username,

                'email' => $email,

                'google_id' => $googleUser->getId(),

                'email_verified_at' => now(),

                'password' => Str::random(40),

                /*
                |--------------------------------------------------------------------------
                | Google users must never automatically become admins
                |--------------------------------------------------------------------------
                */

                'role' => 'user',

                'status' => 'active',

            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Check account status
        |--------------------------------------------------------------------------
        */

        if (!$user->isActive()) {

            return redirect()
                ->route('login')
                ->withErrors([
                    'email' => 'حسابك غير نشط.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Login
        |--------------------------------------------------------------------------
        */

        Auth::login($user, true);

        request()->session()->regenerate();


        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        return redirect()->intended(
            route('tech.index')
        );
    }
}
