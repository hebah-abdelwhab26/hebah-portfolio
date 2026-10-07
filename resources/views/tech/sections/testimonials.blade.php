<section class="testimonials-section" id="testimonials">


<div class="container">

    <!--==================================
            SECTION HEADER
    ==================================-->

    <div class="section-header">

        <span class="section-badge" style="color: #f2b824">

            {{ __('digital_studio.testimonials.badge') }}

        </span>

        <h2>

            {{ __('digital_studio.testimonials.title') }}

        </h2>

        <p>

            {{ __('digital_studio.testimonials.description') }}

        </p>

    </div>

    <!--==================================
            SWIPER
    ==================================-->

    <div class="swiper testimonialsSwiper">

        <div class="swiper-wrapper">

            @forelse($comments as $comment)

                <div class="swiper-slide">

                    <div class="testimonial-card">

                        <div class="quote-icon">

                            <i class="fa-solid fa-quote-right"></i>

                        </div>

                        <div class="rating">

                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>

                        </div>

                        <p class="testimonial-text">

                            {{ $comment->message }}

                        </p>

                        <div class="testimonial-footer">

                            <div class="client">

                                <div class="testimonial-avatar">

                                    {{ strtoupper(substr($comment->name, 0, 1)) }}

                                </div>

                                <div class="client-info">

                                    <h4>

                                        {{ $comment->name }}

                                    </h4>

                                    <span>

                                        {{ $comment->created_at->format('F d, Y') }}

                                    </span>

                                </div>

                            </div>

                            <div class="project-info">

                                @if($comment->commentable)

                                    <span class="project-name">

                                        🚀 {{ $comment->commentable->title }}

                                    </span>

                                    <small>

                                        @if($comment->commentable->category)

                                            {{ $comment->commentable->category->name }}

                                        @else

                                            {{ __('digital_studio.testimonials.development_project') }}

                                        @endif

                                    </small>

                                @else

                                    <span class="project-name">

                                        💬 {{ __('digital_studio.testimonials.general_testimonial') }}

                                    </span>

                                    <small>

                                        {{ __('digital_studio.testimonials.verified_feedback') }}

                                    </small>

                                @endif

                            </div>

                        </div>

                    </div>

                </div>

            @empty

                <div class="swiper-slide">

                    <div class="testimonial-card empty-testimonial">

                        <div class="quote-icon">

                            <i class="fa-solid fa-comments"></i>

                        </div>

                        <h3>

                            {{ __('digital_studio.testimonials.empty.title') }}

                        </h3>

                        <p class="testimonial-text">

                            {{ __('digital_studio.testimonials.empty.description') }}

                        </p>

                    </div>

                </div>

            @endforelse

        </div>

        <!--==================================
                SWIPER NAVIGATION
        ==================================-->

        <div class="swiper-button-prev"></div>

        <div class="swiper-button-next"></div>

        <div class="swiper-pagination"></div>

    </div>

</div>

</section>
