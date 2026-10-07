<footer class="education-footer">

    <div class="education-footer-container">


        {{-- ==========================================
            MAIN FOOTER
        =========================================== --}}

        <div class="education-footer-main">


            {{-- ======================================
                BRAND
            ======================================= --}}

            <div class="education-footer-brand">

                <a
                    href="{{ route('education.index') }}"
                    class="education-footer-logo"
                >

                    <div class="education-footer-logo-mark">

                        <i class="fa-solid fa-book-quran"></i>

                    </div>


                    <div class="education-footer-logo-text">

                        <strong>
                            {{ __('education.footer.brand.name') }}
                        </strong>

                        <span>
                            {{ __('education.footer.brand.subtitle') }}
                        </span>

                    </div>

                </a>


                <p>
                    {{ __('education.footer.brand.description') }}
                </p>


                {{-- ======================================
                    SOCIAL
                ======================================= --}}

                <div class="education-footer-social">


                    {{-- WhatsApp --}}

                    <a
                        href="https://wa.me/966533812139"
                        target="_blank"
                        rel="noopener noreferrer"
                        aria-label="{{ __('education.footer.social.whatsapp') }}"
                    >

                        <i class="fa-brands fa-whatsapp"></i>

                    </a>


                    {{-- YouTube --}}

                    <a
                        href="#"
                        aria-label="{{ __('education.footer.social.youtube') }}"
                    >

                        <i class="fa-brands fa-youtube"></i>

                    </a>


                    {{-- Telegram --}}

                    <a
                        href="#"
                        aria-label="{{ __('education.footer.social.telegram') }}"
                    >

                        <i class="fa-brands fa-telegram"></i>

                    </a>


                    {{-- Instagram --}}

                    <a
                        href="#"
                        aria-label="{{ __('education.footer.social.instagram') }}"
                    >

                        <i class="fa-brands fa-instagram"></i>

                    </a>


                </div>

            </div>



            {{-- ======================================
                QUICK LINKS
            ======================================= --}}

            <div class="education-footer-column">

                <h3>
                    {{ __('education.footer.quick_links.title') }}
                </h3>


                <a href="{{ route('education.index') }}#home">

                    {{ __('education.footer.quick_links.home') }}

                </a>


                <a href="{{ route('education.index') }}#about">

                    {{ __('education.footer.quick_links.about') }}

                </a>


                <a href="{{ route('education.index') }}#services">

                    {{ __('education.footer.quick_links.services') }}

                </a>


                <a href="{{ route('education.index') }}#appointments">

                    {{ __('education.footer.quick_links.appointments') }}

                </a>


                <a href="{{ route('education.index') }}#contact">

                    {{ __('education.footer.quick_links.contact') }}

                </a>

            </div>



            {{-- ======================================
                EDUCATION
            ======================================= --}}

            <div class="education-footer-column">

                <h3>
                    {{ __('education.footer.education.title') }}
                </h3>


                <a href="#">

                    {{ __('education.footer.education.quran') }}

                </a>


                <a href="#">

                    {{ __('education.footer.education.tajweed') }}

                </a>


                <a href="#">

                    {{ __('education.footer.education.memorization') }}

                </a>


                <a href="#">

                    {{ __('education.footer.education.arabic') }}

                </a>


                <a href="#">

                    {{ __('education.footer.education.resources') }}

                </a>

            </div>



            {{-- ======================================
                CONTACT
            ======================================= --}}

            <div class="education-footer-column education-footer-contact">

                <h3>
                    {{ __('education.footer.contact.title') }}
                </h3>


                {{-- ==================================
                    EMAIL
                =================================== --}}

                <a
                    href="mailto:hebah@hebahgift.com"
                >

                    <i class="fa-regular fa-envelope"></i>

                    <span>
                        hebah@hebahgift.com
                    </span>

                </a>


                {{-- ==================================
                    WHATSAPP
                =================================== --}}

                <a
                    href="https://wa.me/966533812139"
                    target="_blank"
                    rel="noopener noreferrer"
                    aria-label="{{ __('education.footer.social.whatsapp') }}"
                >

                    <i class="fa-brands fa-whatsapp"></i>

                    <span>
                        {{ __('education.footer.contact.whatsapp') }}
                    </span>

                </a>


                {{-- ==================================
                    AVAILABILITY
                =================================== --}}

                <a
                    href="{{ route('education.index') }}#appointments"
                >

                    <i class="fa-regular fa-calendar"></i>

                    <span>
                        {{ __('education.footer.contact.availability') }}
                    </span>

                </a>

            </div>

        </div>



        {{-- ==========================================
            DIVIDER
        =========================================== --}}

        <div class="education-footer-divider"></div>



        {{-- ==========================================
            BOTTOM
        =========================================== --}}

        <div class="education-footer-bottom">


            <p>

                © {{ date('Y') }} Hebah.

                {{ __('education.footer.bottom.copyright') }}

            </p>



            <div class="education-footer-bottom-links">


                <a href="#">

                    {{ __('education.footer.bottom.privacy') }}

                </a>


                <span>
                    •
                </span>


                <a href="#">

                    {{ __('education.footer.bottom.terms') }}

                </a>


                <span>
                    •
                </span>


                {{-- ==================================
                    ADMIN LOGIN
                =================================== --}}

                <a
                    href="{{ route('education.admin.login') }}"
                    class="education-footer-admin-link"
                >

                    <i class="fa-solid fa-lock"></i>

                    {{ __('education.footer.bottom.admin') }}

                </a>

            </div>



            {{-- ======================================
                BACK TO MAIN PORTAL
            ======================================= --}}

            <a
                href="{{ route('portal') }}"
                class="education-footer-portal"
            >

                <i class="fa-solid fa-arrow-right"></i>

                {{ __('education.footer.bottom.back_to_main') }}

            </a>

        </div>

    </div>

</footer>
