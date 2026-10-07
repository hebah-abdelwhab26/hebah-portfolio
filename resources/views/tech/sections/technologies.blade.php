<section class="services-section" id="technologies">

<div class="container">

    <!--==================================
            SECTION HEADER
    ==================================-->

    <div class="section-header">

        <span class="section-badge" style="color: #f2b824">

            {{ __('digital_studio.technologies.badge') }}

        </span>

        <h2>

            {{ __('digital_studio.technologies.heading') }}

            <span>{{ __('digital_studio.technologies.heading_highlight') }}</span>

        </h2>

        <p>

            {{ __('digital_studio.technologies.description') }}

        </p>

    </div>

    <!--==================================
            TECHNOLOGIES SLIDER
    ==================================-->

    <div class="swiper technologiesSwiper">

        <div class="swiper-wrapper">

            @forelse($technologyCategories as $category)

                @php

                    $technologies = $category->technologies
                        ->where('is_active', true)
                        ->sortBy('sort_order');

                @endphp

                @if($technologies->count())

                    <div class="swiper-slide">

                        <article class="tech-card">

                            <!--==============================
                                    CARD HEADER
                            ==============================-->

                            <div class="tech-header">

                                <div class="tech-icon">

                                    @if($category->icon)

                                        <i class="{{ $category->icon }}"></i>

                                    @else

                                        <i class="fa-solid fa-layer-group"></i>

                                    @endif

                                </div>

                                <div class="tech-info">

                                    <h3>

                                        {{ $category->name }}

                                    </h3>

                                    <span>

                                        {{ $technologies->count() }}
                                        {{ __('digital_studio.technologies.technologies_count') }}

                                    </span>

                                </div>

                            </div>

                            <!--==============================
                                    TECHNOLOGIES LIST
                            ==============================-->

                            <div class="tech-list">

                                @foreach($technologies as $technology)

                                    <div class="tech-item">

                                        <!--==============================
                                                TECHNOLOGY ICON
                                        ==============================-->

                                       <div
    class="item-icon"
    style="
        border-radius: 10px;
        @if($technology->color)
            background: {{ $technology->color }};
            box-shadow:0 10px 25px {{ $technology->color }}33;
        @endif
    "
>

                                            @if($technology->icon)

                                                <i class="{{ $technology->icon }}"></i>

                                            @else

                                                <i class="fa-solid fa-code"></i>

                                            @endif

                                        </div>

                                        <!--==============================
                                                TECHNOLOGY NAME
                                        ==============================-->

                                        <span>

                                            {{ $technology->name }}

                                        </span>

                                    </div>

                                @endforeach

                            </div>

                        </article>

                    </div>

                @endif

            @empty

                <div class="swiper-slide">

                    <article class="tech-card">

                        <div class="tech-empty">

                            <i class="fa-solid fa-code"></i>

                            <h4>

                                {{ __('digital_studio.technologies.empty_title') }}

                            </h4>

                            <p>

                                {{ __('digital_studio.technologies.empty_description') }}

                            </p>

                        </div>

                    </article>

                </div>

            @endforelse

        </div>

        <!--==================================
                SWIPER NAVIGATION
        ==================================-->

        <div class="swiper-button-prev tech-prev">

            <i class="fa-solid fa-chevron-left"></i>

        </div>

        <div class="swiper-button-next tech-next">

            <i class="fa-solid fa-chevron-right"></i>

        </div>

        <!--==================================
                SWIPER PAGINATION
        ==================================-->

        <div class="swiper-pagination tech-pagination"></div>

    </div>

</div>


</section>

