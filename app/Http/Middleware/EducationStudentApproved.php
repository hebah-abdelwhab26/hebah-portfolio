<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EducationStudentApproved
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
        | CHECK EDUCATION AUTHENTICATION
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
        | GET CURRENT EDUCATION USER
        |--------------------------------------------------------------------------
        */

        $user = Auth::guard('education')->user();


        /*
        |--------------------------------------------------------------------------
        | PENDING
        |--------------------------------------------------------------------------
        */

        if ($user->isStudentPending()) {

            return redirect()
                ->route('education.index')
                ->with(
                    'status',
                    'حسابك قيد المراجعة. سيتم السماح لك بالدخول إلى لوحة الطالب بعد اعتمادك من الإدارة.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | REJECTED
        |--------------------------------------------------------------------------
        */

        if ($user->isStudentRejected()) {

            return redirect()
                ->route('education.index')
                ->with(
                    'status',
                    'تم رفض طلب التسجيل كطالب. يرجى التواصل مع الإدارة إذا كنت تعتقد أن هذا حدث بالخطأ.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | APPROVED
        |--------------------------------------------------------------------------
        */

        if ($user->isStudentApproved()) {

            return $next($request);
        }


        /*
        |--------------------------------------------------------------------------
        | UNKNOWN STATUS
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('education.index')
            ->with(
                'status',
                'حالة حسابك غير صالحة. يرجى التواصل مع الإدارة.'
            );
    }
}
