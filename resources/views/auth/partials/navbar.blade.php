{{-- =========================================================
                    AUTHENTICATION NAVBAR
========================================================= --}}

<header class="auth-topbar">

    <div class="auth-topbar-inner">

        {{-- =================================================
                            BRAND
        ================================================== --}}

        <a
            href="{{ route('portal') }}"
            class="auth-brand"
            aria-label="Hebah Web"
        >

            <img
                src="{{ asset('images/الشعار.png') }}"
                alt="{{ __('digital_studio.auth.login.logo_alt') }}"
            >

            <span class="auth-brand-text">

                <span class="auth-brand-name">
                    Hebah Web
                </span>

                <span class="auth-brand-subtitle">
                    Laravel • React Developer
                </span>

            </span>

        </a>


        {{-- =================================================
                        LANGUAGE SWITCHER
        ================================================== --}}

        @php

            $currentLocale = app()->getLocale();

            $nextLocale = $currentLocale === 'ar'
                ? 'en'
                : 'ar';

            $languageLabel = $currentLocale === 'ar'
                ? 'English'
                : 'العربية';

            /*
            |--------------------------------------------------------------------------
            | الاحتفاظ بالرابط الحالي مع تغيير اللغة فقط
            |--------------------------------------------------------------------------
            */

            $languageUrl = request()->fullUrlWithQuery([
                'lang' => $nextLocale,
            ]);

        @endphp


        <a
            href="{{ $languageUrl }}"
            class="auth-language-switcher"
            aria-label="{{ $languageLabel }}"
            title="{{ $languageLabel }}"
        >

            <i class="fa-solid fa-language"></i>

            <span>
                {{ $currentLocale === 'ar' ? 'EN' : 'AR' }}
            </span>

        </a>

    </div>

</header>