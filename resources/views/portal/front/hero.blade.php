<style>

/*==================================================
    LANGUAGE SWITCHER
==================================================*/

.portal-language-wrapper{

    width:100%;

    display:flex;

    justify-content:flex-end;

    margin-bottom:20px;

    padding:0 5px;

}


.portal-language-switcher{

    width:52px;

    height:52px;

    display:flex;

    align-items:center;

    justify-content:center;

    gap:4px;

    border:1px solid rgba(255,255,255,.22);

    border-radius:50%;

    background:rgba(8,17,31,.72);

    color:#ffffff;

    text-decoration:none;

    backdrop-filter:blur(14px);

    -webkit-backdrop-filter:blur(14px);

    box-shadow:

        0 8px 25px rgba(0,0,0,.30),

        0 0 20px rgba(37,99,235,.12),

        inset 0 0 12px rgba(255,255,255,.04);

    cursor:pointer;

    transition:

        transform .3s ease,

        background .3s ease,

        border-color .3s ease,

        box-shadow .3s ease;

}


.portal-language-switcher i{

    display:block;

    margin:0;

    padding:0;

    font-size:17px;

    line-height:1;

    color:#ffffff;

    transition:

        color .3s ease,

        transform .3s ease;

}


.portal-language-switcher span{

    display:block;

    margin:0;

    padding:0;

    font-family:'Cairo',sans-serif;

    font-size:10px;

    font-weight:700;

    line-height:1;

    color:#ffffff;

    letter-spacing:.3px;

    transition:color .3s ease;

}


/*==================================================
    HOVER
==================================================*/

.portal-language-switcher:hover{

    transform:translateY(-2px) scale(1.06);

    background:rgba(37,99,235,.18);

    border-color:rgba(212,160,23,.65);

    box-shadow:

        0 12px 30px rgba(0,0,0,.40),

        0 0 25px rgba(37,99,235,.25);

}


.portal-language-switcher:hover i{

    color:#D4A017;

    transform:rotate(-8deg) scale(1.08);

}


.portal-language-switcher:hover span{

    color:#D4A017;

}


/*==================================================
    FOCUS
==================================================*/

.portal-language-switcher:focus{

    outline:none;

}


.portal-language-switcher:focus-visible{

    outline:2px solid rgba(212,160,23,.85);

    outline-offset:4px;

}


/*==================================================
    RTL
==================================================*/

html[dir="rtl"] .portal-language-wrapper{

    justify-content:flex-start;

}


/*==================================================
    MOBILE
==================================================*/

@media (max-width:600px){

    .portal-language-wrapper{

        margin-bottom:15px;

        padding:0;

    }


    .portal-language-switcher{

        width:44px;

        height:44px;

    }


    .portal-language-switcher i{

        font-size:14px;

    }


    .portal-language-switcher span{

        font-size:9px;

    }

}

</style>


<section class="hero">


    {{-- =====================================================
         LANGUAGE SWITCHER
    ====================================================== --}}

    @php

        $currentLocale = app()->getLocale();

        $nextLocale = $currentLocale === 'ar'
            ? 'en'
            : 'ar';

        $languageLabel = $currentLocale === 'ar'
            ? 'English'
            : 'العربية';

    @endphp


    <div class="portal-language-wrapper">

        <a
            href="{{ url('/?lang=' . $nextLocale) }}"
            class="portal-language-switcher"
            aria-label="{{ $languageLabel }}"
            title="{{ $languageLabel }}"
        >

            <i class="fa-solid fa-language"></i>

            <span>
                {{ $currentLocale === 'ar' ? 'EN' : 'AR' }}
            </span>

        </a>

    </div>


    {{-- =====================================================
         LOGO / HERO IMAGE
    ====================================================== --}}

    <div class="logo-wrapper">

        <img
            src="{{ asset('images/og-image.jpg') }}"
            alt="Hebah Abdelwahab"
        >

    </div>


    {{-- =====================================================
         HERO TITLE
    ====================================================== --}}

    <h2>

        {{ __('digital_studio.portal.hero.title') }}

    </h2>


    {{-- =====================================================
         DIVIDER
    ====================================================== --}}

    <div class="hero-divider">

        <span></span>

        <i class="fa-solid fa-star"></i>

        <span></span>

    </div>


    {{-- =====================================================
         HERO SUBTITLE
    ====================================================== --}}

    <h3>

        {{ __('digital_studio.portal.hero.subtitle') }}

    </h3>


    {{-- =====================================================
         SCROLL DOWN
    ====================================================== --}}

    <div class="scroll-down">

        <i class="fa-solid fa-angles-down"></i>

    </div>


</section>