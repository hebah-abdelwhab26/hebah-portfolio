<?php

namespace App\Http\Controllers\Education;

use App\Http\Controllers\Controller;
use App\Models\EducationSetting;
use Illuminate\Http\Request;

class EducationAdminSettingController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | PAYMENT SETTINGS
    |--------------------------------------------------------------------------
    |
    | عرض صفحة إعدادات الدفع.
    |
    */

    public function edit()
    {
        /*
        |--------------------------------------------------------------------------
        | GET / CREATE SINGLE SETTINGS RECORD
        |--------------------------------------------------------------------------
        |
        | نظام التعليم يعتمد على سجل واحد فقط من EducationSetting.
        | إذا لم يكن السجل موجودًا، نقوم بإنشائه بالقيم الافتراضية.
        |
        */

        $settings = EducationSetting::query()->first();

        if (!$settings) {
            $settings = EducationSetting::create([
                'payment_enabled' => true,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'education.admin.settings.edit',
            compact('settings')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE PAYMENT SETTINGS
    |--------------------------------------------------------------------------
    |
    | تحديث بيانات الحساب البنكي وإعدادات الدفع.
    |
    */

    public function updatePaymentSettings(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'bank_name' => [
                'nullable',
                'string',
                'max:255',
            ],

            'account_name' => [
                'nullable',
                'string',
                'max:255',
            ],

            'account_number' => [
                'nullable',
                'string',
                'max:100',
            ],

            'iban' => [
                'nullable',
                'string',
                'max:100',
            ],

            'payment_enabled' => [
                'nullable',
                'boolean',
            ],

            'payment_instructions' => [
                'nullable',
                'string',
                'max:5000',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | GET / CREATE SINGLE SETTINGS RECORD
        |--------------------------------------------------------------------------
        */

        $settings = EducationSetting::query()->first();

        if (!$settings) {

            $settings = new EducationSetting();
        }


        /*
        |--------------------------------------------------------------------------
        | UPDATE
        |--------------------------------------------------------------------------
        */

        $settings->fill([

            'bank_name' =>
                $validated['bank_name'] ?? null,

            'account_name' =>
                $validated['account_name'] ?? null,

            'account_number' =>
                $validated['account_number'] ?? null,

            'iban' =>
                $validated['iban'] ?? null,

            'payment_enabled' =>
                $request->boolean('payment_enabled'),

            'payment_instructions' =>
                $validated['payment_instructions'] ?? null,

        ]);


        /*
        |--------------------------------------------------------------------------
        | SAVE
        |--------------------------------------------------------------------------
        */

        $settings->save();


        /*
        |--------------------------------------------------------------------------
        | RESPONSE
        |--------------------------------------------------------------------------
        */

        return back()->with(
            'success',
            'تم تحديث إعدادات الدفع وبيانات الحساب البنكي بنجاح.'
        );
    }
}
