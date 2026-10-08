
<section class="digital-services" id="services">

    <div class="digital-services-container">

        {{-- ==========================================
             HEADER
        =========================================== --}}
        <div class="digital-services-header">

            <span class="digital-services-badge">

                <span class="digital-services-badge-line"></span>

                {{ __('digital_studio.services.badge') }}

                <span class="digital-services-badge-line"></span>

            </span>


            <h2 class="digital-services-title">

                {{ __('digital_studio.services.title_start') }}

                <span>
                    {{ __('digital_studio.services.title_highlight') }}
                </span>

            </h2>


            <p class="digital-services-description">

                {{ __('digital_studio.services.description') }}

            </p>

        </div>


        {{-- ==========================================
             SERVICES GRID
        =========================================== --}}
        <div class="digital-services-grid">


            {{-- ==========================================
                 BUSINESS WEBSITES
            =========================================== --}}
            <article class="digital-service-card service-blue">

                <div class="digital-service-icon">

                    <i class="fa-solid fa-building"></i>

                </div>


                <div class="digital-service-content">

                    <h3>
                        {{ __('digital_studio.services.business_websites.title') }}
                    </h3>

                    <p>
                        {{ __('digital_studio.services.business_websites.description') }}
                    </p>


                    <a href="#contact" class="digital-service-link">

                        <span>
                            {{ __('digital_studio.services.learn_more') }}
                        </span>

                        <i class="fa-solid fa-arrow-right"></i>

                    </a>

                </div>

            </article>



            {{-- ==========================================
                 E-COMMERCE
            =========================================== --}}
            <article class="digital-service-card service-pink">

                <div class="digital-service-icon">

                    <i class="fa-solid fa-cart-shopping"></i>

                </div>


                <div class="digital-service-content">

                    <h3>
                        {{ __('digital_studio.services.ecommerce.title') }}
                    </h3>

                    <p>
                        {{ __('digital_studio.services.ecommerce.description') }}
                    </p>


                    <a href="#contact" class="digital-service-link">

                        <span>
                            {{ __('digital_studio.services.learn_more') }}
                        </span>

                        <i class="fa-solid fa-arrow-right"></i>

                    </a>

                </div>

            </article>



            {{-- ==========================================
                 DASHBOARDS
            =========================================== --}}
            <article class="digital-service-card service-green">

                <div class="digital-service-icon">

                    <i class="fa-solid fa-chart-column"></i>

                </div>


                <div class="digital-service-content">

                    <h3>
                        {{ __('digital_studio.services.dashboards.title') }}
                    </h3>

                    <p>
                        {{ __('digital_studio.services.dashboards.description') }}
                    </p>


                    <a href="#contact" class="digital-service-link">

                        <span>
                            {{ __('digital_studio.services.learn_more') }}
                        </span>

                        <i class="fa-solid fa-arrow-right"></i>

                    </a>

                </div>

            </article>



            {{-- ==========================================
                 WEB APPLICATIONS
            =========================================== --}}
            <article class="digital-service-card service-cyan">

                <div class="digital-service-icon">

                    <i class="fa-solid fa-code"></i>

                </div>


                <div class="digital-service-content">

                    <h3>
                        {{ __('digital_studio.services.web_applications.title') }}
                    </h3>

                    <p>
                        {{ __('digital_studio.services.web_applications.description') }}
                    </p>


                    <a href="#contact" class="digital-service-link">

                        <span>
                            {{ __('digital_studio.services.learn_more') }}
                        </span>

                        <i class="fa-solid fa-arrow-right"></i>

                    </a>

                </div>

            </article>



            {{-- ==========================================
                 RESTAURANT SYSTEMS
            =========================================== --}}
            <article class="digital-service-card service-orange">

                <div class="digital-service-icon">

                    <i class="fa-solid fa-utensils"></i>

                </div>


                <div class="digital-service-content">

                    <h3>
                        {{ __('digital_studio.services.restaurant_systems.title') }}
                    </h3>

                    <p>
                        {{ __('digital_studio.services.restaurant_systems.description') }}
                    </p>


                    <a href="#contact" class="digital-service-link">

                        <span>
                            {{ __('digital_studio.services.learn_more') }}
                        </span>

                        <i class="fa-solid fa-arrow-right"></i>

                    </a>

                </div>

            </article>



            {{-- ==========================================
                 CUSTOM SOLUTIONS
            =========================================== --}}
            <article class="digital-service-card service-purple">

                <div class="digital-service-icon">

                    <i class="fa-solid fa-gears"></i>

                </div>


                <div class="digital-service-content">

                    <h3>
                        {{ __('digital_studio.services.custom_solutions.title') }}
                    </h3>

                    <p>
                        {{ __('digital_studio.services.custom_solutions.description') }}
                    </p>


                    <a href="#contact" class="digital-service-link">

                        <span>
                            {{ __('digital_studio.services.learn_more') }}
                        </span>

                        <i class="fa-solid fa-arrow-right"></i>

                    </a>

                </div>

            </article>


        </div>

    </div>

</section>



{{-- =========================================================
     DIGITAL STUDIO — SERVICES DESIGN
     التصميم داخل نفس ملف Blade
========================================================= --}}

<style>

    /* =========================================================
       DIGITAL SERVICES
    ========================================================= */

    .digital-services {
        position: relative;
        padding: 120px 0;
        overflow: hidden;
    }


    .digital-services::before {
        content: "";

        position: absolute;

        width: 420px;
        height: 420px;

        top: 10%;
        left: -220px;

        background: rgba(37, 99, 235, 0.08);

        filter: blur(100px);

        border-radius: 50%;

        pointer-events: none;
    }


    .digital-services::after {
        content: "";

        position: absolute;

        width: 380px;
        height: 380px;

        bottom: 0;
        right: -180px;

        background: rgba(212, 160, 23, 0.07);

        filter: blur(100px);

        border-radius: 50%;

        pointer-events: none;
    }



    /* =========================================================
       CONTAINER
    ========================================================= */

    .digital-services-container {

        width: min(1180px, calc(100% - 40px));

        margin: 0 auto;

        position: relative;

        z-index: 2;
    }



    /* =========================================================
       HEADER
    ========================================================= */

    .digital-services-header {

        text-align: center;

        max-width: 760px;

        margin: 0 auto 55px;
    }


    .digital-services-badge {

        display: inline-flex;

        align-items: center;

        gap: 12px;

        margin-bottom: 16px;

        font-size: 12px;

        font-weight: 700;

        letter-spacing: 3px;

        text-transform: uppercase;

        color: #d4a017;
    }


    .digital-services-badge-line {

        width: 32px;

        height: 1px;

        background: linear-gradient(
            90deg,
            transparent,
            #d4a017
        );
    }


    [dir="rtl"] .digital-services-badge-line {

        background: linear-gradient(
            270deg,
            transparent,
            #d4a017
        );
    }



    .digital-services-title {

        margin: 0;

        font-size: clamp(34px, 4vw, 54px);

        line-height: 1.15;

        font-weight: 800;

        color: #f8fafc;
    }


    .digital-services-title span {

        color: #2563eb;
    }



    .digital-services-description {

        max-width: 650px;

        margin: 18px auto 0;

        font-size: 16px;

        line-height: 1.9;

        color: rgba(226, 232, 240, 0.68);
    }



    /* =========================================================
       GRID
    ========================================================= */

    .digital-services-grid {

        display: grid;

        grid-template-columns:
            repeat(3, minmax(0, 1fr));

        gap: 22px;
    }



    /* =========================================================
       CARD
    ========================================================= */

    .digital-service-card {

        position: relative;

        display: flex;

        align-items: flex-start;

        gap: 20px;

        min-height: 205px;

        padding: 28px;

        border: 1px solid
            rgba(148, 163, 184, 0.14);

        border-radius: 18px;

        background:
            linear-gradient(
                145deg,
                rgba(255, 255, 255, 0.055),
                rgba(255, 255, 255, 0.018)
            );

        backdrop-filter: blur(14px);

        -webkit-backdrop-filter: blur(14px);

        box-shadow:
            inset 0 1px 0
                rgba(255, 255, 255, 0.035),

            0 20px 50px
                rgba(0, 0, 0, 0.12);

        transition:
            transform 0.35s ease,
            border-color 0.35s ease,
            box-shadow 0.35s ease;

        overflow: hidden;
    }


    .digital-service-card::before {

        content: "";

        position: absolute;

        width: 140px;
        height: 140px;

        top: -80px;
        right: -70px;

        border-radius: 50%;

        opacity: 0.14;

        filter: blur(30px);

        transition:
            opacity 0.35s ease;
    }


    .digital-service-card:hover {

        transform: translateY(-7px);

        border-color:
            rgba(148, 163, 184, 0.30);

        box-shadow:
            0 25px 60px
                rgba(0, 0, 0, 0.22);
    }


    .digital-service-card:hover::before {

        opacity: 0.28;
    }



    /* =========================================================
       ICON
    ========================================================= */

    .digital-service-icon {

        flex: 0 0 58px;

        width: 58px;
        height: 58px;

        display: flex;

        align-items: center;
        justify-content: center;

        border-radius: 16px;

        font-size: 22px;

        border:
            1px solid
            rgba(255, 255, 255, 0.12);

        transition:
            transform 0.35s ease,
            box-shadow 0.35s ease;
    }


    .digital-service-card:hover
    .digital-service-icon {

        transform:
            translateY(-3px)
            scale(1.04);
    }



    /* =========================================================
       CONTENT
    ========================================================= */

    .digital-service-content {

        flex: 1;

        min-width: 0;
    }


    .digital-service-content h3 {

        margin: 2px 0 10px;

        font-size: 19px;

        line-height: 1.4;

        font-weight: 700;

        color: #f8fafc;
    }


    .digital-service-content p {

        margin: 0;

        font-size: 14px;

        line-height: 1.8;

        color:
            rgba(203, 213, 225, 0.68);
    }


    .digital-service-link {

        display: inline-flex;

        align-items: center;

        gap: 8px;

        margin-top: 18px;

        font-size: 13px;

        font-weight: 600;

        text-decoration: none;

        transition:
            gap 0.3s ease,
            opacity 0.3s ease;
    }


    .digital-service-link:hover {

        gap: 12px;
    }


    .digital-service-link i {

        font-size: 11px;

        transition:
            transform 0.3s ease;
    }


    [dir="rtl"] .digital-service-link i {

        transform: rotate(180deg);
    }


    [dir="rtl"] .digital-service-link:hover i {

        transform:
            rotate(180deg)
            translateX(-3px);
    }



    /* =========================================================
       BLUE
    ========================================================= */

    .service-blue::before {

        background: #2563eb;
    }


    .service-blue
    .digital-service-icon {

        color: #60a5fa;

        background:
            rgba(37, 99, 235, 0.13);

        box-shadow:
            0 0 25px
            rgba(37, 99, 235, 0.10);
    }


    .service-blue
    .digital-service-link {

        color: #60a5fa;
    }



    /* =========================================================
       PINK
    ========================================================= */

    .service-pink::before {

        background: #ec4899;
    }


    .service-pink
    .digital-service-icon {

        color: #f472b6;

        background:
            rgba(236, 72, 153, 0.12);

        box-shadow:
            0 0 25px
            rgba(236, 72, 153, 0.10);
    }


    .service-pink
    .digital-service-link {

        color: #f472b6;
    }



    /* =========================================================
       GREEN
    ========================================================= */

    .service-green::before {

        background: #10b981;
    }


    .service-green
    .digital-service-icon {

        color: #34d399;

        background:
            rgba(16, 185, 129, 0.12);

        box-shadow:
            0 0 25px
            rgba(16, 185, 129, 0.10);
    }


    .service-green
    .digital-service-link {

        color: #34d399;
    }



    /* =========================================================
       CYAN
    ========================================================= */

    .service-cyan::before {

        background: #0ea5e9;
    }


    .service-cyan
    .digital-service-icon {

        color: #38bdf8;

        background:
            rgba(14, 165, 233, 0.12);

        box-shadow:
            0 0 25px
            rgba(14, 165, 233, 0.10);
    }


    .service-cyan
    .digital-service-link {

        color: #38bdf8;
    }



    /* =========================================================
       ORANGE
    ========================================================= */

    .service-orange::before {

        background: #f97316;
    }


    .service-orange
    .digital-service-icon {

        color: #fb923c;

        background:
            rgba(249, 115, 22, 0.12);

        box-shadow:
            0 0 25px
            rgba(249, 115, 22, 0.10);
    }


    .service-orange
    .digital-service-link {

        color: #fb923c;
    }



    /* =========================================================
       PURPLE
    ========================================================= */

    .service-purple::before {

        background: #8b5cf6;
    }


    .service-purple
    .digital-service-icon {

        color: #a78bfa;

        background:
            rgba(139, 92, 246, 0.12);

        box-shadow:
            0 0 25px
            rgba(139, 92, 246, 0.10);
    }


    .service-purple
    .digital-service-link {

        color: #a78bfa;
    }



    /* =========================================================
       RESPONSIVE — TABLET
    ========================================================= */

    @media (max-width: 1000px) {

        .digital-services-grid {

            grid-template-columns:
                repeat(2, minmax(0, 1fr));
        }

    }



    /* =========================================================
       RESPONSIVE — MOBILE
    ========================================================= */

    @media (max-width: 650px) {

        .digital-services {

            padding: 85px 0;
        }


        .digital-services-container {

            width:
                min(100% - 28px, 520px);
        }


        .digital-services-header {

            margin-bottom: 38px;
        }


        .digital-services-title {

            font-size: 34px;
        }


        .digital-services-description {

            font-size: 14px;
        }


        .digital-services-grid {

            grid-template-columns: 1fr;

            gap: 16px;
        }


        .digital-service-card {

            min-height: auto;

            padding: 22px;
        }

    }



    /* =========================================================
       RESPONSIVE — SMALL MOBILE
    ========================================================= */

    @media (max-width: 420px) {

        .digital-service-card {

            gap: 15px;

            padding: 19px;
        }


        .digital-service-icon {

            flex-basis: 50px;

            width: 50px;

            height: 50px;

            border-radius: 14px;

            font-size: 19px;
        }


        .digital-service-content h3 {

            font-size: 17px;
        }


        .digital-service-content p {

            font-size: 13px;
        }

    }

</style>

