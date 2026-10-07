<?php

namespace App\Http\Controllers\Education\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class EducationAdminProfileController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    | عرض الصفحة الشخصية لمدير التعليم
    |--------------------------------------------------------------------------
    */

    public function edit()
    {
        $educationAdmin = Auth::guard('education_admin')->user();

        return view(
            'education.admin.profile.edit',
            compact('educationAdmin')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    | تحديث البيانات الشخصية
    |--------------------------------------------------------------------------
    */

    public function update(Request $request)
    {
        $educationAdmin = Auth::guard('education_admin')->user();

        $validated = $request->validate([

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('education_admins', 'email')
                    ->ignore($educationAdmin->id),
            ],

        ], [

            'name.required' =>
                'يرجى إدخال الاسم.',

            'name.max' =>
                'الاسم طويل جدًا.',

            'email.required' =>
                'يرجى إدخال البريد الإلكتروني.',

            'email.email' =>
                'يرجى إدخال بريد إلكتروني صحيح.',

            'email.unique' =>
                'هذا البريد الإلكتروني مستخدم بالفعل.',

        ]);


        $educationAdmin->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);


        return redirect()
            ->route('education.admin.profile.edit')
            ->with(
                'success',
                'تم تحديث بياناتك الشخصية بنجاح.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE PASSWORD
    |--------------------------------------------------------------------------
    | تغيير كلمة المرور
    |--------------------------------------------------------------------------
    */

    public function updatePassword(Request $request)
    {
        $educationAdmin = Auth::guard('education_admin')->user();

        $validated = $request->validate([

            'current_password' => [
                'required',
                'string',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],

        ], [

            'current_password.required' =>
                'يرجى إدخال كلمة المرور الحالية.',

            'password.required' =>
                'يرجى إدخال كلمة المرور الجديدة.',

            'password.min' =>
                'كلمة المرور الجديدة يجب ألا تقل عن 8 أحرف.',

            'password.confirmed' =>
                'تأكيد كلمة المرور غير متطابق.',

        ]);


        /*
        |--------------------------------------------------------------------------
        | CHECK CURRENT PASSWORD
        |--------------------------------------------------------------------------
        */

        if (
            ! Hash::check(
                $validated['current_password'],
                $educationAdmin->password
            )
        ) {

            return back()
                ->withErrors([
                    'current_password' =>
                        'كلمة المرور الحالية غير صحيحة.',
                ])
                ->withInput();
        }


        /*
        |--------------------------------------------------------------------------
        | UPDATE PASSWORD
        |--------------------------------------------------------------------------
        */

        $educationAdmin->update([
            'password' => $validated['password'],
        ]);


        /*
        |--------------------------------------------------------------------------
        | SECURITY
        |--------------------------------------------------------------------------
        |
        | بعد تغيير كلمة المرور نبقي المدير مسجل الدخول.
        |
        */

        Auth::guard('education_admin')->login(
            $educationAdmin
        );


        return redirect()
            ->route('education.admin.profile.edit')
            ->with(
                'password_success',
                'تم تغيير كلمة المرور بنجاح.'
            );
    }
}
