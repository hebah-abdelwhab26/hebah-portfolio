<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SetEducationLocale
{
    /**
     * اللغات المسموح بها في منصة التعليم.
     */
    private const SUPPORTED_LOCALES = [
        'ar',
        'en',
    ];

    /**
     * اللغة الافتراضية.
     */
    private const DEFAULT_LOCALE = 'ar';

    public function handle(
        Request $request,
        Closure $next
    ): Response {
        /*
        |--------------------------------------------------------------------------
        | التأكد أن الطلب يخص منصة التعليم فقط
        |--------------------------------------------------------------------------
        |
        | باقي الموقع لن يتأثر بنظام اللغات الخاص بالتعليم.
        |
        */

        $routeName = $request->route()?->getName();

        if (
            !$routeName ||
            !str_starts_with($routeName, 'education.')
        ) {
            return $next($request);
        }


        /*
        |--------------------------------------------------------------------------
        | 1. قراءة اللغة المطلوبة من الرابط
        |--------------------------------------------------------------------------
        |
        | مثال:
        | /education?lang=en
        |
        | إذا أرسل المستخدم لغة صحيحة، نعتمدها مباشرة.
        |
        */

        $requestedLocale = $request->query('lang');

        if (
            is_string($requestedLocale) &&
            in_array($requestedLocale, self::SUPPORTED_LOCALES, true)
        ) {
            $locale = $requestedLocale;

            /*
            |--------------------------------------------------------------------------
            | حفظ اللغة الجديدة في Session
            |--------------------------------------------------------------------------
            */

            session([
                'education_locale' => $locale,
            ]);
        } else {
            /*
            |--------------------------------------------------------------------------
            | 2. اللغة المحفوظة في Session
            |--------------------------------------------------------------------------
            */

            $locale = session('education_locale');


            /*
            |--------------------------------------------------------------------------
            | 3. إذا لم توجد في Session نقرأ لغة الطالب
            |--------------------------------------------------------------------------
            */

            if (!$locale && Auth::guard('education')->check()) {

                $student = Auth::guard('education')->user();

                $locale = $student?->locale;
            }


            /*
            |--------------------------------------------------------------------------
            | 4. التحقق من أن اللغة مسموحة
            |--------------------------------------------------------------------------
            */

            if (!in_array($locale, self::SUPPORTED_LOCALES, true)) {
                $locale = self::DEFAULT_LOCALE;
            }


            /*
            |--------------------------------------------------------------------------
            | 5. حفظ اللغة في Session
            |--------------------------------------------------------------------------
            */

            session([
                'education_locale' => $locale,
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | 6. تطبيق اللغة الحالية على Laravel
        |--------------------------------------------------------------------------
        */

        app()->setLocale($locale);


        return $next($request);
    }
}
