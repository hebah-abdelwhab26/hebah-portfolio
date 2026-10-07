

<section class="education-hero" id="home">

    @include('education.partials.news-ticker')


    <div class="education-hero-bg"></div>


    <div class="education-hero-container">


        <!--==================================================
            HERO CONTENT
        ==================================================-->

        <div class="education-hero-content">


            <span class="education-hero-badge">

                <i class="fa-solid fa-book-quran"></i>

                {{ __('education.hero.badge') }}

            </span>



            <h1 class="education-hero-title">

                {{ __('education.hero.title_line_1') }}

                <br>

                <span>
                    {{ __('education.hero.title_line_2') }}
                </span>

            </h1>



            <p class="education-hero-description">

                {{ __('education.hero.description') }}

            </p>



            <!--==================================================
                ACTIONS
            ==================================================-->

            <div class="education-hero-actions">


                <a
                    href="#lessons"
                    class="education-hero-btn education-hero-btn-primary"
                >

                    <span>
                        {{ __('education.hero.actions.lessons') }}
                    </span>

                    <i class="fa-solid fa-arrow-left"></i>

                </a>



                <a
                    href="#about"
                    class="education-hero-btn education-hero-btn-outline"
                >

                    <span>
                        {{ __('education.hero.actions.about') }}
                    </span>

                    <i class="fa-solid fa-user"></i>

                </a>


            </div>



            <!--==================================================
                SMALL INFO
            ==================================================-->

            <div class="education-hero-meta">


                <div class="education-hero-meta-item">


                    <div class="education-hero-meta-icon">

                        <i class="fa-solid fa-quran"></i>

                    </div>


                    <div>

                        <strong>

                            {{ __('education.hero.meta.quran.title') }}

                        </strong>


                        <span>

                            {{ __('education.hero.meta.quran.description') }}

                        </span>

                    </div>


                </div>



                <div class="education-hero-meta-divider"></div>



                <div class="education-hero-meta-item">


                    <div class="education-hero-meta-icon">

                        <i class="fa-solid fa-language"></i>

                    </div>


                    <div>

                        <strong>

                            {{ __('education.hero.meta.arabic.title') }}

                        </strong>


                        <span>

                            {{ __('education.hero.meta.arabic.description') }}

                        </span>

                    </div>


                </div>


            </div>


        </div>



        <!--==================================================
            HERO VISUAL
        ==================================================-->

        <div class="education-hero-visual">


            <!-- Decorative glow -->

            <div class="education-hero-glow"></div>



            <!-- Main visual -->

            <div class="education-hero-image-wrapper">


                <img
                    src="{{ asset('images/education/5b202f4f-e6a5-4d05-b2f3-b738f8ee24cb.png') }}"
                    alt="{{ __('education.hero.visual.image_alt') }}"
                    class="education-hero-image"
                >


            </div>



            <!-- Floating card -->

            <div class="education-hero-floating-card">


                <div class="education-floating-icon">

                    <i class="fa-solid fa-book-open"></i>

                </div>


                <div class="education-floating-content">


                    <strong>

                        {{ __('education.hero.visual.floating_title') }}

                    </strong>


                    <span>

                        {{ __('education.hero.visual.floating_description') }}

                    </span>


                </div>


            </div>



            <!-- Small decorative circle -->

            <div
                class="education-hero-decoration education-hero-decoration-one"
            ></div>


            <div
                class="education-hero-decoration education-hero-decoration-two"
            ></div>


        </div>


    </div>



    <!--==================================================
        BOTTOM DECORATION
    ==================================================-->

    <div class="education-hero-bottom-shape"></div>


</section>

