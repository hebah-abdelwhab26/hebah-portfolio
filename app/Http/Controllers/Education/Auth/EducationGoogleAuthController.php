<?php

namespace App\Http\Controllers\Education\Auth;

use App\Http\Controllers\Controller;
use App\Models\EducationUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class EducationGoogleAuthController extends Controller
{
    /**
     * Google Login Redirect
     */
    public function redirect()
    {
        return Socialite::driver('google')
            ->redirectUrl(
                route('education.google.callback')
            )
            ->scopes([
                'openid',
                'profile',
                'email',
            ])
            ->redirect();
    }


    /**
     * Google Login Callback
     */
    public function callback()
    {
        $googleUser = Socialite::driver('google')
            ->redirectUrl(
                route('education.google.callback')
            )
            ->user();


        /*
        |--------------------------------------------------------------------------
        | Find Education User by Google ID
        |--------------------------------------------------------------------------
        */

        $student = EducationUser::where(
            'google_id',
            $googleUser->getId()
        )->first();


        /*
        |--------------------------------------------------------------------------
        | If Google ID is not linked yet,
        | try matching by email
        |--------------------------------------------------------------------------
        */

        if (!$student) {

            $student = EducationUser::where(
                'email',
                $googleUser->getEmail()
            )->first();


            if ($student) {

                $student->update([
                    'google_id' => $googleUser->getId(),
                ]);

            }
        }


        /*
        |--------------------------------------------------------------------------
        | Create New Education User
        |--------------------------------------------------------------------------
        */

        if (!$student) {

            $name = $googleUser->getName()
                ?: $googleUser->getNickname()
                ?: 'Google User';

            $email = $googleUser->getEmail();


            $student = EducationUser::create([

                'name' => $name,

                'email' => $email,

                'google_id' => $googleUser->getId(),

                'password' => Str::random(40),

                'student_status' => 'pending',

                'is_active' => true,

                'locale' => app()->getLocale(),

            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Check Account Status
        |--------------------------------------------------------------------------
        */

        if (!$student->is_active) {

            return redirect()
                ->route('education.login')
                ->withErrors([
                    'login' => 'حسابك غير نشط.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Login Using Education Guard
        |--------------------------------------------------------------------------
        */

        Auth::guard('education')->login(
            $student,
            true
        );


        request()->session()->regenerate();


        /*
        |--------------------------------------------------------------------------
        | Rejected Student
        |--------------------------------------------------------------------------
        */

        if ($student->isStudentRejected()) {

            return redirect()
                ->route('education.index')
                ->with(
                    'status',
                    'تم رفض طلب التسجيل كطالب. يرجى التواصل مع الإدارة إذا كنت تعتقد أن هذا حدث بالخطأ.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Pending Student
        |--------------------------------------------------------------------------
        */

        if ($student->isStudentPending()) {

            return redirect()
                ->route('education.index')
                ->with(
                    'status',
                    'تم تسجيل الدخول باستخدام Google بنجاح. حسابك الآن قيد المراجعة من الإدارة، وسيتم السماح لك بالدخول إلى لوحة الطالب بعد اعتمادك.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Approved Student
        |--------------------------------------------------------------------------
        */

        if ($student->isStudentApproved()) {

            return redirect()->intended(
                route('education.dashboard')
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Invalid Status
        |--------------------------------------------------------------------------
        */

        Auth::guard('education')->logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();


        return redirect()
            ->route('education.login')
            ->withErrors([
                'login' =>
                    'حالة الحساب غير صالحة. يرجى التواصل مع الإدارة.',
            ]);
    }
}
