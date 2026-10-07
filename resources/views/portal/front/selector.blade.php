<section class="selector">


    <div class="portal-cards">


        <!-- ==============================
                DIGITAL STUDIO
        =============================== -->


        <a href="{{ route('tech.index') }}"
           class="portal-card tech-card">


            <div class="card-border"></div>


            <div class="card-glow"></div>


            <div class="card-reflection"></div>


            <div class="card-content">


                <span class="card-badge">

                    {{ __('digital_studio.portal.cards.tech.badge') }}

                </span>


                <div class="card-illustration">


                    <div class="monitor">


                        <div class="monitor-header">

                            <span></span>

                            <span></span>

                            <span></span>

                        </div>


                        <div class="monitor-body">

                            <div class="line w80"></div>

                            <div class="line w60"></div>

                            <div class="line w90"></div>

                            <div class="line w50"></div>

                        </div>


                    </div>


                    <!-- Laravel Icon -->

                    <div class="floating laravel">

                        <i class="fab fa-laravel"></i>

                    </div>


                    <!-- Mobile Icon -->

                    <div class="floating mobile-icon">

                        <i class="fa-solid fa-mobile-screen-button"></i>

                    </div>


                </div>


                <h2>

                    {{ __('digital_studio.portal.cards.tech.title') }}

                </h2>


                <p>

                    Laravel • React • PHP • MySQL

                    <br>

                    {{ __('digital_studio.portal.cards.tech.design') }}

                </p>


                <span class="portal-btn">

                    {{ __('digital_studio.portal.cards.tech.button') }}

                </span>


            </div>


        </a>


        <!-- ==============================
                QURAN ACADEMY
        =============================== -->


        <a href="{{ route('education.index') }}"
           class="portal-card education-card">


            <div class="card-border"></div>


            <div class="card-glow gold"></div>


            <div class="card-reflection"></div>


            <div class="card-content">


                <span class="card-badge gold-badge">

                    {{ __('digital_studio.portal.cards.education.badge') }}

                </span>


                <div class="card-illustration">


                    <div class="moon"></div>


                    <!-- Quran Book -->

                    <div class="quran-book">

                        <div class="quran-page left"></div>

                        <div class="quran-page right"></div>

                    </div>


                    <span class="star s1">

                        ✦

                    </span>


                    <span class="star s2">

                        ✦

                    </span>


                    <span class="star s3">

                        ✦

                    </span>


                </div>


                <h2>

                    {{ __('digital_studio.portal.cards.education.title') }}

                </h2>


                <p>

                    {{ __('digital_studio.portal.cards.education.quran') }}

                    <br>

                    {{ __('digital_studio.portal.cards.education.arabic') }}

                </p>


                <span class="portal-btn gold-btn">

                    {{ __('digital_studio.portal.cards.education.button') }}

                </span>


            </div>


        </a>


    </div>


</section>