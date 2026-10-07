<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EducationGuest
{
    public function handle(
        Request $request,
        Closure $next
    ): Response {

        if (Auth::guard('education')->check()) {

            return redirect()
                ->route('education.dashboard');
        }

        return $next($request);
    }
}
