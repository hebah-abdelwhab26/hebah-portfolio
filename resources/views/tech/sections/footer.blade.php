<footer class="footer-section" id="footer">

<div class="footer-glow footer-glow-one"></div>
<div class="footer-glow footer-glow-two"></div>

<div class="container">

    {{-- ==========================================
         FOOTER TOP
    =========================================== --}}

    <div class="footer-top">


        {{-- ==========================================
             BRAND
        =========================================== --}}

        <div class="footer-brand">

            <a
                href="{{ route('tech.index') }}"
                class="footer-logo"
                aria-label="Hebah Abdelwahab">

                <img
                    src="{{ asset('images/tech/hebah web.jpg') }}"
                    alt="Hebah Abdelwahab">

            </a>

            <span class="footer-brand-label">
                {{ __('digital_studio.footer.brand_label') }}
            </span>

            <p>
                {{ __('digital_studio.footer.brand_description') }}
            </p>


            {{-- Social --}}

            <div class="footer-social">

                <a
                    href="#"
                    aria-label="GitHub">

                    <i class="fa-brands fa-github"></i>

                </a>

                <a
                    href="#"
                    aria-label="LinkedIn">

                    <i class="fa-brands fa-linkedin-in"></i>

                </a>

                <a
                    href="#"
                    aria-label="Figma">

                    <i class="fa-brands fa-figma"></i>

                </a>

                <a
                    href="#"
                    aria-label="Behance">

                    <i class="fa-brands fa-behance"></i>

                </a>

            </div>

        </div>


        {{-- ==========================================
             NAVIGATION
        =========================================== --}}

        <div class="footer-column">

            <h4>
                {{ __('digital_studio.footer.navigation.title') }}
            </h4>

            <ul>

                <li>
                    <a href="#hero">
                        <span>
                            {{ __('digital_studio.footer.navigation.home') }}
                        </span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </li>

                <li>
                    <a href="#about">
                        <span>
                            {{ __('digital_studio.footer.navigation.about') }}
                        </span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </li>

                <li>
                    <a href="#services">
                        <span>
                            {{ __('digital_studio.footer.navigation.services') }}
                        </span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </li>

                <li>
                    <a href="#portfolio">
                        <span>
                            {{ __('digital_studio.footer.navigation.portfolio') }}
                        </span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </li>

                <li>
                    <a href="#contact">
                        <span>
                            {{ __('digital_studio.footer.navigation.contact') }}
                        </span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </li>

            </ul>

        </div>


        {{-- ==========================================
             SERVICES
        =========================================== --}}

        <div class="footer-column">

            <h4>
                {{ __('digital_studio.footer.services.title') }}
            </h4>

            <ul>

                <li>
                    <a href="#services">
                        <span>
                            {{ __('digital_studio.footer.services.web_development') }}
                        </span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </li>

                <li>
                    <a href="#services">
                        <span>
                            {{ __('digital_studio.footer.services.laravel') }}
                        </span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </li>

                <li>
                    <a href="#services">
                        <span>
                            {{ __('digital_studio.footer.services.react') }}
                        </span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </li>

                <li>
                    <a href="#services">
                        <span>
                            {{ __('digital_studio.footer.services.ui_ux') }}
                        </span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </li>

                <li>
                    <a href="#services">
                        <span>
                            {{ __('digital_studio.footer.services.api') }}
                        </span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </li>

            </ul>

        </div>


        {{-- ==========================================
             CTA
        =========================================== --}}

        <div class="footer-cta">

            <span class="footer-cta-label">
                {{ __('digital_studio.footer.cta.label') }}
            </span>

            <h3>
                {{ __('digital_studio.footer.cta.title_before') }}
                <span>
                    {{ __('digital_studio.footer.cta.title_highlight') }}
                </span>
            </h3>

            <p>
                {{ __('digital_studio.footer.cta.description') }}
            </p>

            <a
                href="#contact"
                class="footer-cta-button">

                <span>
                    {{ __('digital_studio.footer.cta.button') }}
                </span>

                <i class="fa-solid fa-arrow-right"></i>

            </a>

        </div>

    </div>


    {{-- ==========================================
         FOOTER DIVIDER
    =========================================== --}}

    <div class="footer-divider"></div>


    {{-- ==========================================
         FOOTER BOTTOM
    =========================================== --}}

    <div class="footer-bottom">

        <p>

            © {{ date('Y') }}

            <strong>
                Hebah Abdelwahab
            </strong>

            <span>
                {{ __('digital_studio.footer.bottom.rights') }}
            </span>

        </p>


        <div class="footer-bottom-center">

            {{ __('digital_studio.footer.bottom.designed') }}

            <span class="footer-heart">
                <i class="fa-solid fa-heart"></i>
            </span>

            {{ __('digital_studio.footer.bottom.by') }}

        </div>

    </div>

</div>

</footer>
