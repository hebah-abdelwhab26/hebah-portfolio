<?php

namespace App\Http\Controllers\Education\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EducationAdminAuthController extends Controller
{
    /**
     * Show Education Admin login page.
     */
    public function showLogin()
    {
        return view('education.admin.auth.login');
    }

    /**
     * Authenticate Education Admin.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => [
                'required',
                'email',
            ],

            'password' => [
                'required',
                'string',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | ATTEMPT LOGIN
        |--------------------------------------------------------------------------
        */

        if (
            !Auth::guard('education_admin')->attempt(
                [
                    'email' => $credentials['email'],
                    'password' => $credentials['password'],
                    'is_active' => true,
                ],
                $request->boolean('remember')
            )
        ) {
            return back()
                ->withInput($request->only('email', 'remember'))
                ->withErrors([
                    'email' => 'البريد الإلكتروني أو كلمة المرور غير صحيحة.',
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | REGENERATE SESSION
        |--------------------------------------------------------------------------
        */

        $request->session()->regenerate();

        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->intended(
                route('education.admin.dashboard')
            );
    }

    /**
     * Logout Education Admin.
     */
    public function logout(Request $request)
    {
        Auth::guard('education_admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()
            ->route('education.admin.login');
    }
}
