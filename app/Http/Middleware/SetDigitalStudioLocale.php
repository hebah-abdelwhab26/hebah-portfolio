<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetDigitalStudioLocale
{
    /**
     * اللغات المسموح بها في Digital Studio و Main Admin.
     */
    private const SUPPORTED_LOCALES = [
        'ar',
        'en',
    ];

    /**
     * اللغة الافتراضية.
     */
    private const DEFAULT_LOCALE = 'ar';

    /**
     * تشغيل Middleware.
     */
    public function handle(
        Request $request,
        Closure $next
    ): Response {

        /*
        |--------------------------------------------------------------------------
        | 1. قراءة اللغة من الرابط
        |--------------------------------------------------------------------------
        |
        | مثال:
        |
        | /?lang=en
        | /?lang=ar
        |
        | إذا كانت اللغة موجودة في الرابط يتم اعتمادها وحفظها.
        |
        */

        if ($request->has('lang')) {

            $requestedLocale = $request->query('lang');

            if (
                in_array(
                    $requestedLocale,
                    self::SUPPORTED_LOCALES,
                    true
                )
            ) {

                session([
                    'digital_studio_locale' => $requestedLocale,
                ]);

            }
        }


        /*
        |--------------------------------------------------------------------------
        | 2. قراءة اللغة من Session
        |--------------------------------------------------------------------------
        */

        $locale = session(
            'digital_studio_locale',
            self::DEFAULT_LOCALE
        );


        /*
        |--------------------------------------------------------------------------
        | 3. التحقق من اللغة
        |--------------------------------------------------------------------------
        */

        if (
            !in_array(
                $locale,
                self::SUPPORTED_LOCALES,
                true
            )
        ) {

            $locale = self::DEFAULT_LOCALE;

            session([
                'digital_studio_locale' => $locale,
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | 4. تطبيق اللغة على Laravel
        |--------------------------------------------------------------------------
        */

        app()->setLocale($locale);


        /*
        |--------------------------------------------------------------------------
        | 5. متابعة الطلب
        |--------------------------------------------------------------------------
        */

        return $next($request);
    }
}