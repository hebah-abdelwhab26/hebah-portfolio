
   <section class="digital-hero">

    <div class="hero-container">

    <!-- =======================================================
                            LEFT SIDE
    ======================================================== -->

    <div class="hero-left">

        <!-- Badge -->

        <span class="hero-badge" style="color: #f2b824">

            {{ __('digital_studio.hero.badge') }}

        </span>

        <!-- Subtitle -->

        <div class="hero-subtitle">

            <span class="hero-line"></span>

            <p>{{ __('digital_studio.hero.subtitle') }}</p>

        </div>

        <!-- Heading -->

        <h1>

            {{ __('digital_studio.hero.heading') }}

            <span>{{ __('digital_studio.hero.heading_highlight') }}</span>

        </h1>

        <!-- Description -->

        <p class="hero-description">

            {{ __('digital_studio.hero.description') }}

        </p>

        <!-- Skills -->

        <div class="hero-skills">

            <span>Laravel</span>

            <span>React</span>

            <span>PHP</span>

            <span>MySQL</span>

            <span>UI / UX</span>

        </div>

        <!-- Buttons -->

        <div class="hero-buttons">

            <a href="#portfolio" class="primary-btn">

                {{ __('digital_studio.hero.view_portfolio') }}

                <i class="fa-solid fa-arrow-right"></i>

            </a>

            <a href="#contact" class="secondary-btn">

                <i class="fa-regular fa-envelope"></i>

                {{ __('digital_studio.hero.contact_me') }}

            </a>

        </div>

        <!-- Statistics -->

        <div class="hero-stats">

            <div class="stat">

                <i class="fa-solid fa-layer-group"></i>

                <h2>20+</h2>

                <span>{{ __('digital_studio.hero.projects') }}</span>

            </div>

            <div class="stat">

                <i class="fa-solid fa-mobile-screen-button"></i>

                <h2>100%</h2>

                <span>{{ __('digital_studio.hero.responsive') }}</span>

            </div>

            <div class="stat">

                <i class="fa-solid fa-headset"></i>

                <h2>24/7</h2>

                <span>{{ __('digital_studio.hero.support') }}</span>

            </div>

        </div>

    </div>

    <!-- =======================================================
                            RIGHT SIDE
    ======================================================== -->

    <div class="hero-right">

        <div class="studio-wrapper">

            <!-- Floating Icons -->

            <div class="floating laravel">

                <i class="fab fa-laravel"></i>

            </div>

            <div class="floating react">

                <i class="fab fa-react"></i>

            </div>

            <div class="floating figma">

                <i class="fab fa-figma"></i>

            </div>

            <div class="floating php">

                <i class="fab fa-php"></i>

            </div>

            <div class="floating github">

                <i class="fab fa-github"></i>

            </div>

            <div class="floating js">

                <i class="fab fa-js"></i>

            </div>

            <!-- ===================================================
                            STUDIO CARD
            ==================================================== -->

            <div class="studio-card">

                <!-- Window Header -->

                <div class="window-header">

                    <span></span>
                    <span></span>
                    <span></span>

                </div>

                <!-- Window Body -->

                <div class="window-body">

                    <div class="project-browser">

                        <!-- Browser -->

                        <div class="browser-bar">

                            <div class="browser-left">

                                <span class="browser-dot red"></span>

                                <span class="browser-dot yellow"></span>

                                <span class="browser-dot green"></span>

                            </div>

                            <div class="browser-address">

                                <i class="fa-solid fa-lock"></i>

                                <span id="browserTitle">

                                    carrental.hebahgift.com

                                </span>

                            </div>

                        </div>

                        <!-- Loading -->

                        <div class="browser-loading">

                            <div class="loading-bar"></div>

                        </div>

                        <!-- ==========================================
                                PROJECT SLIDER
                        =========================================== -->

                        <div class="project-screen">

                            <!-- Car Rental -->

                            <div class="project-slide active">

                                @include('tech.projects.car-rental')

                            </div>

                            <!-- Portfolio -->

                            <div class="project-slide">

                                @include('tech.projects.portfolio')

                            </div>

                            <!-- Ecommerce -->

                            <div class="project-slide">

                                @include('tech.projects.ecommerce')

                            </div>

                            <!-- Quran Academy -->

                            <div class="project-slide">

                                @include('tech.projects.academy')

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- End Studio Card -->

        </div>

    </div>

</div>

</section>
