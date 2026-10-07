<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EducationAdminAuth
{
    /**
     * Handle an incoming request.
     */
    public function handle(
        Request $request,
        Closure $next
    ): Response {

        /*
        |--------------------------------------------------------------------------
        | CHECK EDUCATION ADMIN AUTHENTICATION
        |--------------------------------------------------------------------------
        */

        if (!auth()->guard('education_admin')->check()) {

            return redirect()
                ->route('education.admin.login');
        }


        /*
        |--------------------------------------------------------------------------
        | CHECK ACCOUNT STATUS
        |--------------------------------------------------------------------------
        */

        $admin = auth()
            ->guard('education_admin')
            ->user();


        if (!$admin->is_active) {

            auth()
                ->guard('education_admin')
                ->logout();

            return redirect()
                ->route('education.admin.login')
                ->withErrors([
                    'email' => 'حساب الإدارة غير نشط.',
                ]);
        }


        return $next($request);
    }
}
