
<section
    class="education-resources"
    id="resources"
>

    <div class="education-resources-container">

        {{-- ==================================================
            HEADER
        ================================================== --}}

        <div class="education-resources-header">

            <span class="education-section-badge">
                {{ __('education.resources.header.badge') }}
            </span>

            <h2>
                {{ __('education.resources.header.title_line_1') }}

                <span>
                    {{ __('education.resources.header.title_line_2') }}
                </span>
            </h2>

            <p>
                {{ __('education.resources.header.description') }}
            </p>

        </div>


        {{-- ==================================================
            RESOURCES SLIDER
        ================================================== --}}

        <div class="education-resources-slider">


            {{-- ==================================================
                PREVIOUS
            ================================================== --}}

            <button
                type="button"
                class="education-resource-arrow education-resource-prev"
                aria-label="{{ __('education.resources.navigation.previous') }}"
            >

                <i class="fa-solid fa-arrow-right"></i>

            </button>


            {{-- ==================================================
                TRACK
            ================================================== --}}

            <div class="education-resources-track">


                {{-- ==================================================
                    QURAN
                ================================================== --}}

                @php
                    $quranLessons = $lessonsByCategory['quran'] ?? collect();
                @endphp


                <article class="education-resource-card">

                    <div class="education-resource-icon">

                        <i class="fa-solid fa-book-quran"></i>

                    </div>


                    <div class="education-resource-content">

                        <span class="education-resource-category">
                            {{ __('education.resources.categories.quran.category') }}
                        </span>


                        <h3>
                            {{ __('education.resources.categories.quran.title') }}
                        </h3>


                        <p>
                            {{ __('education.resources.categories.quran.description') }}
                        </p>


                        @if($quranLessons->isNotEmpty())

                            <a
                                href="{{ route('education.resources.category', 'quran') }}"
                                class="education-resource-link"
                            >

                                {{ __('education.resources.categories.quran.available_action') }}

                                <i class="fa-solid fa-arrow-left"></i>

                            </a>

                        @else

                            <span class="education-resource-link disabled">
                                {{ __('education.resources.categories.quran.unavailable') }}
                            </span>

                        @endif

                    </div>

                </article>


                {{-- ==================================================
                    TAJWEED
                ================================================== --}}

                @php
                    $tajweedLessons = $lessonsByCategory['tajweed'] ?? collect();
                @endphp


                <article class="education-resource-card featured">

                    <div class="education-resource-icon">

                        <i class="fa-solid fa-microphone-lines"></i>

                    </div>


                    <div class="education-resource-content">

                        <span class="education-resource-category">
                            {{ __('education.resources.categories.tajweed.category') }}
                        </span>


                        <h3>
                            {{ __('education.resources.categories.tajweed.title') }}
                        </h3>


                        <p>
                            {{ __('education.resources.categories.tajweed.description') }}
                        </p>


                        @if($tajweedLessons->isNotEmpty())

                            <a
                                href="{{ route('education.resources.category', 'tajweed') }}"
                                class="education-resource-link"
                            >

                                {{ __('education.resources.categories.tajweed.available_action') }}

                                <i class="fa-solid fa-arrow-left"></i>

                            </a>

                        @else

                            <span class="education-resource-link disabled">
                                {{ __('education.resources.categories.tajweed.unavailable') }}
                            </span>

                        @endif

                    </div>

                </article>


                {{-- ==================================================
                    ARABIC
                ================================================== --}}

                @php
                    $arabicLessons = $lessonsByCategory['arabic'] ?? collect();
                @endphp


                <article class="education-resource-card">

                    <div class="education-resource-icon">

                        <i class="fa-solid fa-language"></i>

                    </div>


                    <div class="education-resource-content">

                        <span class="education-resource-category">
                            {{ __('education.resources.categories.arabic.category') }}
                        </span>


                        <h3>
                            {{ __('education.resources.categories.arabic.title') }}
                        </h3>


                        <p>
                            {{ __('education.resources.categories.arabic.description') }}
                        </p>


                        @if($arabicLessons->isNotEmpty())

                            <a
                                href="{{ route('education.resources.category', 'arabic') }}"
                                class="education-resource-link"
                            >

                                {{ __('education.resources.categories.arabic.available_action') }}

                                <i class="fa-solid fa-arrow-left"></i>

                            </a>

                        @else

                            <span class="education-resource-link disabled">
                                {{ __('education.resources.categories.arabic.unavailable') }}
                            </span>

                        @endif

                    </div>

                </article>


                {{-- ==================================================
                    VIDEOS
                ================================================== --}}

                @php
                    $videoLessons = $lessonsByCategory['videos'] ?? collect();
                @endphp


                <article class="education-resource-card">

                    <div class="education-resource-icon">

                        <i class="fa-solid fa-circle-play"></i>

                    </div>


                    <div class="education-resource-content">

                        <span class="education-resource-category">
                            {{ __('education.resources.categories.videos.category') }}
                        </span>


                        <h3>
                            {{ __('education.resources.categories.videos.title') }}
                        </h3>


                        <p>
                            {{ __('education.resources.categories.videos.description') }}
                        </p>


                        @if($videoLessons->isNotEmpty())

                            <a
                                href="{{ route('education.resources.category', 'videos') }}"
                                class="education-resource-link"
                            >

                                {{ __('education.resources.categories.videos.available_action') }}

                                <i class="fa-solid fa-arrow-left"></i>

                            </a>

                        @else

                            <span class="education-resource-link disabled">
                                {{ __('education.resources.categories.videos.unavailable') }}
                            </span>

                        @endif

                    </div>

                </article>


                {{-- ==================================================
                    MATERIALS
                ================================================== --}}

                @php
                    $materialLessons = $lessonsByCategory['materials'] ?? collect();
                @endphp


                <article class="education-resource-card">

                    <div class="education-resource-icon">

                        <i class="fa-solid fa-file-lines"></i>

                    </div>


                    <div class="education-resource-content">

                        <span class="education-resource-category">
                            {{ __('education.resources.categories.materials.category') }}
                        </span>


                        <h3>
                            {{ __('education.resources.categories.materials.title') }}
                        </h3>


                        <p>
                            {{ __('education.resources.categories.materials.description') }}
                        </p>


                        @if($materialLessons->isNotEmpty())

                            <a
                                href="{{ route('education.resources.category', 'materials') }}"
                                class="education-resource-link"
                            >

                                {{ __('education.resources.categories.materials.available_action') }}

                                <i class="fa-solid fa-arrow-left"></i>

                            </a>

                        @else

                            <span class="education-resource-link disabled">
                                {{ __('education.resources.categories.materials.unavailable') }}
                            </span>

                        @endif

                    </div>

                </article>


            </div>


            {{-- ==================================================
                NEXT
            ================================================== --}}

            <button
                type="button"
                class="education-resource-arrow education-resource-next"
                aria-label="{{ __('education.resources.navigation.next') }}"
            >

                <i class="fa-solid fa-arrow-left"></i>

            </button>

        </div>


        {{-- ==================================================
            BOTTOM LINK
        ================================================== --}}

        <div class="education-resources-footer">

            <span>
                {{ __('education.resources.footer.message') }}
            </span>


            <a
                href="{{ route('education.resources.index') }}"
            >

                {{ __('education.resources.footer.all_resources') }}

                <i class="fa-solid fa-arrow-left"></i>

            </a>

        </div>

    </div>

</section>

