<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EducationStudent
{
    /**
     * التحقق من أن المستخدم معتمد كطالب.
     */
    public function handle(
        Request $request,
        Closure $next
    ): Response {

        /*
        |--------------------------------------------------------------------------
        | التأكد من تسجيل الدخول
        |--------------------------------------------------------------------------
        */

        if (!Auth::guard('education')->check()) {

            return redirect()
                ->route('education.login')
                ->with(
                    'status',
                    'يرجى تسجيل الدخول للوصول إلى حسابك.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | المستخدم الحالي
        |--------------------------------------------------------------------------
        */

        $user = Auth::guard('education')->user();


        /*
        |--------------------------------------------------------------------------
        | التحقق من اعتماد الطالب
        |--------------------------------------------------------------------------
        |
        | pending  = بانتظار الموافقة
        | approved = معتمد كطالب
        | rejected = مرفوض
        |
        */

        if ($user->student_status !== 'approved') {

            return redirect()
                ->route('education.index')
                ->with(
                    'status',
                    'حسابك بانتظار اعتمادك كطالب من الإدارة.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | الطالب معتمد
        |--------------------------------------------------------------------------
        */

        return $next($request);
    }
}
