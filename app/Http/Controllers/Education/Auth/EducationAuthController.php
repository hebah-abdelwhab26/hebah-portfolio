<?php

namespace App\Http\Controllers\Education\Auth;

use App\Http\Controllers\Controller;
use App\Models\EducationUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password as PasswordRule;

class EducationAuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | SHOW LOGIN
    |--------------------------------------------------------------------------
    */

    public function showLogin()
    {
        return view('education.auth.login');
    }


    /*
    |--------------------------------------------------------------------------
    | LOGIN
    |--------------------------------------------------------------------------
    |
    | يمكن للطالب تسجيل الدخول باستخدام:
    |
    | 1. البريد الإلكتروني
    | 2. رقم الهاتف
    |
    */

    public function login(Request $request)
    {
        $validated = $request->validate([

            'login' => [
                'required',
                'string',
                'max:255',
            ],

            'password' => [
                'required',
                'string',
            ],

        ]);


        $remember = $request->boolean('remember');

        $loginValue = trim($validated['login']);


        /*
        |--------------------------------------------------------------------------
        | DETERMINE LOGIN FIELD
        |--------------------------------------------------------------------------
        |
        | إذا كانت القيمة بريدًا إلكترونيًا:
        |
        | email
        |
        | وإلا:
        |
        | phone
        |
        */

        $loginField = filter_var(
            $loginValue,
            FILTER_VALIDATE_EMAIL
        )
            ? 'email'
            : 'phone';


        /*
        |--------------------------------------------------------------------------
        | ATTEMPT LOGIN
        |--------------------------------------------------------------------------
        */

        if (
            !Auth::guard('education')->attempt(
                [
                    $loginField => $loginValue,
                    'password' => $validated['password'],
                ],
                $remember
            )
        ) {

            return back()
                ->withInput(
                    $request->only('login')
                )
                ->withErrors([
                    'login' =>
                        'البريد الإلكتروني أو رقم الهاتف أو كلمة المرور غير صحيحة.',
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
        | GET CURRENT STUDENT
        |--------------------------------------------------------------------------
        */

        /** @var EducationUser $student */
        $student = Auth::guard('education')->user();


        /*
        |--------------------------------------------------------------------------
        | REJECTED
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
        | PENDING
        |--------------------------------------------------------------------------
        */

        if ($student->isStudentPending()) {

            return redirect()
                ->route('education.index')
                ->with(
                    'status',
                    'حسابك قيد المراجعة. سيتم السماح لك بالدخول إلى لوحة الطالب بعد اعتمادك من الإدارة.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | APPROVED
        |--------------------------------------------------------------------------
        */

        if ($student->isStudentApproved()) {

            return redirect()
                ->intended(
                    route('education.dashboard')
                );
        }


        /*
        |--------------------------------------------------------------------------
        | UNKNOWN STATUS
        |--------------------------------------------------------------------------
        */

        Auth::guard('education')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('education.login')
            ->withErrors([
                'login' =>
                    'حالة الحساب غير صالحة. يرجى التواصل مع الإدارة.',
            ]);
    }


    /*
    |--------------------------------------------------------------------------
    | SHOW REGISTER
    |--------------------------------------------------------------------------
    */

    public function showRegister()
    {
        return view('education.auth.register');
    }


    /*
    |--------------------------------------------------------------------------
    | REGISTER
    |--------------------------------------------------------------------------
    */

    public function register(Request $request)
    {
        $validated = $request->validate([

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:education_users,email',
            ],

            'password' => [
                'required',
                'confirmed',
                PasswordRule::defaults(),
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | CREATE STUDENT
        |--------------------------------------------------------------------------
        |
        | student_status سيأخذ القيمة الافتراضية:
        |
        | pending
        |
        | من قاعدة البيانات.
        |
        */

        $student = EducationUser::create([

            'name' => $validated['name'],

            'email' => $validated['email'],

            'password' => $validated['password'],

            'student_status' => 'pending',

        ]);


        /*
        |--------------------------------------------------------------------------
        | LOGIN AFTER REGISTRATION
        |--------------------------------------------------------------------------
        */

        Auth::guard('education')
            ->login($student);


        $request->session()->regenerate();


        /*
        |--------------------------------------------------------------------------
        | PENDING MESSAGE
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('education.index')
            ->with(
                'status',
                'تم إنشاء حسابك بنجاح. حسابك الآن قيد المراجعة من الإدارة، وسيتم السماح لك بالدخول إلى لوحة الطالب بعد اعتمادك.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | SHOW FORGOT PASSWORD
    |--------------------------------------------------------------------------
    */

    public function showForgotPassword()
    {
        return view('education.auth.forgot-password');
    }


    /*
    |--------------------------------------------------------------------------
    | SEND RESET LINK
    |--------------------------------------------------------------------------
    */

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([

            'email' => [
                'required',
                'email',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | SEND PASSWORD RESET LINK
        |--------------------------------------------------------------------------
        */

        $status = Password::broker('education_users')
            ->sendResetLink(
                $request->only('email')
            );


        /*
        |--------------------------------------------------------------------------
        | SUCCESS
        |--------------------------------------------------------------------------
        */

        if ($status === Password::RESET_LINK_SENT) {

            return back()->with(
                'status',
                'تم إرسال رابط إعادة تعيين كلمة المرور إلى بريدك الإلكتروني.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | ERROR
        |--------------------------------------------------------------------------
        */

        return back()
            ->withInput(
                $request->only('email')
            )
            ->withErrors([
                'email' =>
                    'تعذر إرسال رابط إعادة تعيين كلمة المرور. تأكد من أن البريد الإلكتروني مسجل لدينا.',
            ]);
    }


    /*
    |--------------------------------------------------------------------------
    | SHOW RESET PASSWORD
    |--------------------------------------------------------------------------
    */

    public function showResetPassword(
        Request $request,
        string $token
    ) {
        return view(
            'education.auth.reset-password',
            [
                'token' => $token,
                'email' => $request->email,
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | RESET PASSWORD
    |--------------------------------------------------------------------------
    */

    public function resetPassword(Request $request)
    {
        $validated = $request->validate([

            'token' => [
                'required',
                'string',
            ],

            'email' => [
                'required',
                'email',
            ],

            'password' => [
                'required',
                'confirmed',
                PasswordRule::defaults(),
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | RESET PASSWORD USING LARAVEL BROKER
        |--------------------------------------------------------------------------
        */

        $status = Password::broker('education_users')
            ->reset(
                $validated,
                function (EducationUser $student, string $password) {

                    $student->forceFill([

                        'password' => Hash::make($password),

                        'remember_token' => Str::random(60),

                    ])->save();
                }
            );


        /*
        |--------------------------------------------------------------------------
        | SUCCESS
        |--------------------------------------------------------------------------
        */

        if ($status === Password::PASSWORD_RESET) {

            return redirect()
                ->route('education.login')
                ->with(
                    'status',
                    'تم تغيير كلمة المرور بنجاح. يمكنك الآن تسجيل الدخول باستخدام كلمة المرور الجديدة.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | ERROR
        |--------------------------------------------------------------------------
        */

        return back()
            ->withInput(
                $request->only('email')
            )
            ->withErrors([
                'email' =>
                    'تعذر إعادة تعيين كلمة المرور. قد يكون الرابط غير صالح أو منتهي الصلاحية.',
            ]);
    }


    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    public function logout(Request $request)
    {
        Auth::guard('education')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()
            ->route('education.login');
    }
}
