
{{-- =========================================================
     EDUCATION ABOUT SECTION
========================================================= --}}

<section
    class="education-about"
    id="about">

    <div class="education-about-container">


        {{-- =================================================
             VISUAL SIDE
        ================================================= --}}

        <div class="education-about-visual">

            <div class="about-visual-decoration about-decoration-one"></div>

            <div class="about-visual-decoration about-decoration-two"></div>


            {{-- Main Illustration Card --}}

            <div class="about-book-card">

                <div class="about-book-glow"></div>


                <div class="about-book">

                    <div class="about-book-cover">

                        <span class="about-book-badge">
                            {{ __('education.about.visual.quran_badge') }}
                        </span>

                        <div class="about-book-title">
                            {{ __('education.about.visual.book_title') }}
                        </div>

                        <div class="about-book-ornament">
                            {{ __('education.about.visual.book_ornament') }}
                        </div>

                        <div class="about-book-subtitle">
                            {{ __('education.about.visual.book_subtitle') }}
                        </div>

                    </div>

                    <div class="about-book-pages"></div>

                </div>


                {{-- Floating Arabic Card --}}

                <div class="about-floating-card about-arabic-card">

                    <div class="about-floating-icon">

                        <i class="fa-solid fa-feather-pointed"></i>

                    </div>

                    <div>

                        <strong>
                            {{ __('education.about.visual.arabic_title') }}
                        </strong>

                        <span>
                            {{ __('education.about.visual.arabic_description') }}
                        </span>

                    </div>

                </div>


                {{-- Floating Quran Card --}}

                <div class="about-floating-card about-quran-card">

                    <div class="about-floating-icon">

                        <i class="fa-solid fa-book-quran"></i>

                    </div>

                    <div>

                        <strong>
                            {{ __('education.about.visual.quran_title') }}
                        </strong>

                        <span>
                            {{ __('education.about.visual.quran_description') }}
                        </span>

                    </div>

                </div>

            </div>

        </div>



        {{-- =================================================
             CONTENT SIDE
        ================================================= --}}

        <div class="education-about-content">


            {{-- Section Label --}}

            <div class="education-section-label">

                <span class="education-section-label-line"></span>

                <span>
                    {{ __('education.about.label') }}
                </span>

            </div>



            {{-- Heading --}}

            <h2 class="education-about-title">

                {{ __('education.about.title_line_1') }}

                <span>
                    {{ __('education.about.title_line_2') }}
                </span>

            </h2>



            {{-- Description --}}

            <div class="education-about-description">

                <p>

                    {{ __('education.about.description.first') }}

                </p>


                <p>

                    {{ __('education.about.description.second') }}

                </p>

            </div>



            {{-- =================================================
                 EDUCATION AREAS
            ================================================= --}}

            <div class="education-about-cards">


                {{-- Quran Card --}}

                <div class="education-about-mini-card">

                    <div class="education-about-mini-icon">

                        <i class="fa-solid fa-book-quran"></i>

                    </div>

                    <div class="education-about-mini-content">

                        <h3>
                            {{ __('education.about.areas.quran.title') }}
                        </h3>

                        <p>
                            {{ __('education.about.areas.quran.description') }}
                        </p>

                    </div>

                </div>



                {{-- Arabic Card --}}

                <div class="education-about-mini-card">

                    <div class="education-about-mini-icon">

                        <i class="fa-solid fa-language"></i>

                    </div>

                    <div class="education-about-mini-content">

                        <h3>
                            {{ __('education.about.areas.arabic.title') }}
                        </h3>

                        <p>
                            {{ __('education.about.areas.arabic.description') }}
                        </p>

                    </div>

                </div>


            </div>



            {{-- =================================================
                 PERSONAL VALUES
            ================================================= --}}

            <div class="education-about-values">


                <div class="education-about-value">

                    <i class="fa-solid fa-heart"></i>

                    <span>
                        {{ __('education.about.values.love') }}
                    </span>

                </div>


                <div class="education-about-value">

                    <i class="fa-solid fa-seedling"></i>

                    <span>
                        {{ __('education.about.values.gradual') }}
                    </span>

                </div>


                <div class="education-about-value">

                    <i class="fa-solid fa-book-open"></i>

                    <span>
                        {{ __('education.about.values.useful_knowledge') }}
                    </span>

                </div>


            </div>



            {{-- =================================================
                 CTA
            ================================================= --}}

            <div class="education-about-actions">

                <a
                    href="#lessons"
                    class="education-about-button">

                    <span>
                        {{ __('education.about.action') }}
                    </span>

                    <i class="fa-solid fa-arrow-left"></i>

                </a>

            </div>


        </div>

    </div>

</section>

