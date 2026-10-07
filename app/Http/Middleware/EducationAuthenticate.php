<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EducationAuthenticate
{
    public function handle(
        Request $request,
        Closure $next
    ): Response {

        if (!Auth::guard('education')->check()) {

            return redirect()
                ->route('education.login')
                ->with(
                    'status',
                    'يرجى تسجيل الدخول للوصول إلى حسابك.'
                );
        }


        return $next($request);
    }
}
