<?php

namespace App\Http\Controllers\Education;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EducationLanguageController extends Controller
{
    /**
     * اللغات المدعومة.
     */
    private const SUPPORTED_LOCALES = [
        'ar',
        'en',
    ];

    /**
     * تغيير لغة منصة التعليم.
     */
    public function switch(
        Request $request,
        string $locale
    ): RedirectResponse {
        /*
        |--------------------------------------------------------------------------
        | Validate locale
        |--------------------------------------------------------------------------
        */

        if (!in_array($locale, self::SUPPORTED_LOCALES, true)) {
            $locale = 'ar';
        }


        /*
        |--------------------------------------------------------------------------
        | Save locale in session
        |--------------------------------------------------------------------------
        */

        $request->session()->put(
            'education_locale',
            $locale
        );


        /*
        |--------------------------------------------------------------------------
        | Save locale for logged-in education student
        |--------------------------------------------------------------------------
        */

        if (Auth::guard('education')->check()) {
            $student = Auth::guard('education')->user();

            $student->locale = $locale;
            $student->save();
        }


        /*
        |--------------------------------------------------------------------------
        | Apply locale immediately
        |--------------------------------------------------------------------------
        */

        app()->setLocale($locale);


        /*
        |--------------------------------------------------------------------------
        | Return to previous page
        |--------------------------------------------------------------------------
        */

        return redirect()->back();
    }
}
