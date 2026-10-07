@extends('tech.layouts.app')

@section('title', __('digital_studio.comments.page_title'))

@section('content')

@include('tech.sections.navbar')


{{-- =========================================================
     PAGE HERO
========================================================= --}}

<section class="page-hero">

    <div class="container">

        <div class="page-hero-content">

            <span class="section-badge">
                {{ __('digital_studio.comments.hero.badge') }}
            </span>

            <h1>
                {{ __('digital_studio.comments.hero.title_before') }}
                <span>{{ __('digital_studio.comments.hero.title_highlight') }}</span>
            </h1>

            <p>
                {{ __('digital_studio.comments.hero.description') }}
            </p>

        </div>

    </div>

</section>


{{-- =========================================================
     COMMENTS PAGE
========================================================= --}}

<main class="comments-page">

    <div class="container">


        {{-- =====================================================
             ALERTS
        ====================================================== --}}

        @if(session('success'))

            <div class="alert alert-success rounded-4 mb-5">

                <i class="fa-solid fa-circle-check me-2"></i>

                {{ session('success') }}

            </div>

        @endif


        @if(session('error'))

            <div class="alert alert-danger rounded-4 mb-5">

                <i class="fa-solid fa-circle-exclamation me-2"></i>

                {{ session('error') }}

            </div>

        @endif


        @if($errors->any())

            <div class="alert alert-danger rounded-4 mb-5">

                <h6 class="fw-bold mb-3">
                    {{ __('digital_studio.comments.errors.title') }}
                </h6>

                <ul class="mb-0">

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        {{-- =====================================================
             COMMENT FORM
        ====================================================== --}}

        <section class="comment-section">

            <div class="row justify-content-center">

                <div class="col-xl-10 col-xxl-9">

                    <div class="glass-card comment-form-card">


                        {{-- =================================================
                             FORM HEADER
                        ================================================== --}}

                        <div class="section-heading text-center mb-5">

                            <span class="section-badge">
                                {{ __('digital_studio.comments.form.badge') }}
                            </span>

                            <h2>
                                {{ __('digital_studio.comments.form.title_before') }}
                                <span>{{ __('digital_studio.comments.form.title_highlight') }}</span>
                            </h2>

                            <p>
                                {{ __('digital_studio.comments.form.description') }}
                            </p>

                        </div>


                        {{-- =================================================
                             FORM
                        ================================================== --}}

                        <form
                            action="{{ route('comments.store') }}"
                            method="POST">

                            @csrf

                            <div class="row g-4">


                                {{-- =========================================
                                     NAME
                                ========================================== --}}

                                <div class="col-md-6">

                                    <label
                                        for="comment-name"
                                        class="form-label">

                                        {{ __('digital_studio.comments.form.name.label') }}

                                    </label>

                                    <input
                                        id="comment-name"
                                        type="text"
                                        name="name"
                                        class="form-control"
                                        value="{{ old('name', auth()->user()->name ?? '') }}"
                                        placeholder="{{ __('digital_studio.comments.form.name.placeholder') }}"
                                        required>

                                </div>


                                {{-- =========================================
                                     EMAIL
                                ========================================== --}}

                                <div class="col-md-6">

                                    <label
                                        for="comment-email"
                                        class="form-label">

                                        {{ __('digital_studio.comments.form.email.label') }}

                                    </label>

                                    <input
                                        id="comment-email"
                                        type="email"
                                        name="email"
                                        class="form-control"
                                        value="{{ old('email', auth()->user()->email ?? '') }}"
                                        placeholder="{{ __('digital_studio.comments.form.email.placeholder') }}"
                                        required>

                                </div>


                                {{-- =========================================
                                     PROJECT
                                ========================================== --}}

                                <div class="col-12">

                                    <label
                                        for="comment-project"
                                        class="form-label">

                                        {{ __('digital_studio.comments.form.project.label') }}

                                        <span class="optional-label">
                                            {{ __('digital_studio.comments.form.project.optional') }}
                                        </span>

                                    </label>

                                    <select
                                        id="comment-project"
                                        name="commentable_id"
                                        class="form-select">

                                        <option value="">
                                            {{ __('digital_studio.comments.form.project.general') }}
                                        </option>

                                        @foreach($projects as $project)

                                            <option
                                                value="{{ $project->id }}"
                                                @selected(old('commentable_id') == $project->id)>

                                                {{ $project->title }}

                                            </option>

                                        @endforeach

                                    </select>

                                    <input
                                        type="hidden"
                                        name="commentable_type"
                                        value="App\Models\Project">

                                </div>


                                {{-- =========================================
                                     MESSAGE
                                ========================================== --}}

                                <div class="col-12">

                                    <label
                                        for="comment-message"
                                        class="form-label">

                                        {{ __('digital_studio.comments.form.comment.label') }}

                                    </label>

                                    <textarea
                                        id="comment-message"
                                        name="message"
                                        rows="7"
                                        class="form-control"
                                        placeholder="{{ __('digital_studio.comments.form.comment.placeholder') }}"
                                        required>{{ old('message') }}</textarea>

                                </div>


                                {{-- =========================================
                                     NOTICE
                                ========================================== --}}

                                <div class="col-12">

                                    <div class="comment-notice">

                                        <div class="comment-notice-icon">

                                            <i class="fa-solid fa-shield-halved"></i>

                                        </div>

                                        <div>

                                            <strong>
                                                {{ __('digital_studio.comments.notice.title') }}
                                            </strong>

                                            <p>
                                                {{ __('digital_studio.comments.notice.description') }}
                                            </p>

                                        </div>

                                    </div>

                                </div>


                                {{-- =========================================
                                     SUBMIT
                                ========================================== --}}

                                <div class="col-12 text-center">

                                    <button
                                        type="submit"
                                        class="btn btn-primary btn-lg comment-submit">

                                        <i class="fa-solid fa-paper-plane"></i>

                                        <span>
                                            {{ __('digital_studio.comments.form.submit') }}
                                        </span>

                                    </button>

                                </div>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </section>


        {{-- =========================================================
             TESTIMONIALS
        ========================================================== --}}

        <section class="testimonials-section">


            {{-- =====================================================
                 SECTION HEADER
            ====================================================== --}}

            <div class="section-heading testimonials-heading">

                <span class="section-badge">
                    {{ __('digital_studio.comments.testimonials.badge') }}
                </span>

                <h2>
                    {{ __('digital_studio.comments.testimonials.title_before') }}
                    <span>{{ __('digital_studio.comments.testimonials.title_highlight') }}</span>
                </h2>

                <p>
                    {{ __('digital_studio.comments.testimonials.description') }}
                </p>

            </div>


            {{-- =====================================================
                 SWIPER
            ====================================================== --}}

            <div class="swiper testimonialsSwiper">

                <div class="swiper-wrapper">


                    {{-- =================================================
                         COMMENTS
                    ================================================== --}}

                    @forelse($comments as $comment)


                        <div class="swiper-slide">

                            <article class="testimonial-card">


                                {{-- =====================================
                                     QUOTE
                                ====================================== --}}

                                <div class="quote-icon">

                                    <i class="fa-solid fa-quote-right"></i>

                                </div>


                                {{-- =====================================
                                     RATING
                                ====================================== --}}

                                <div class="rating">

                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>

                                </div>


                                {{-- =====================================
                                     MESSAGE
                                ====================================== --}}

                                <p class="testimonial-text">

                                    {{ $comment->message }}

                                </p>


                                {{-- =====================================
                                     FOOTER
                                ====================================== --}}

                                <div class="testimonial-footer">


                                    {{-- =================================
                                         CLIENT
                                    ================================== --}}

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


                                    {{-- =================================
                                         PROJECT
                                    ================================== --}}

                                    <div class="project-info">

                                        @if($comment->commentable)


                                            <span class="project-name">

                                                <i class="fa-solid fa-rocket"></i>

                                                {{ $comment->commentable->title }}

                                            </span>


                                            <small>

                                                @if($comment->commentable->category)

                                                    {{ $comment->commentable->category->name }}

                                                @else

                                                    {{ __('digital_studio.comments.testimonials.development_project') }}

                                                @endif

                                            </small>


                                        @else


                                            <span class="project-name">

                                                <i class="fa-solid fa-comments"></i>

                                                {{ __('digital_studio.comments.testimonials.general_testimonial') }}

                                            </span>


                                            <small>

                                                {{ __('digital_studio.comments.testimonials.verified_feedback') }}

                                            </small>


                                        @endif

                                    </div>


                                </div>


                            </article>

                        </div>


                    @empty


                        {{-- =================================================
                             EMPTY TESTIMONIAL
                        ================================================== --}}

                        <div class="swiper-slide">

                            <article class="testimonial-card empty-testimonial">


                                <div class="quote-icon">

                                    <i class="fa-solid fa-comments"></i>

                                </div>


                                <div class="rating">

                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>

                                </div>


                                <h3>
                                    {{ __('digital_studio.comments.testimonials.empty.title') }}
                                </h3>


                                <p class="testimonial-text">

                                    {{ __('digital_studio.comments.testimonials.empty.description') }}

                                </p>


                                <div class="empty-testimonial-action">

                                    <a
                                        href="#comment-message"
                                        class="btn btn-primary rounded-pill">

                                        <i class="fa-solid fa-pen"></i>

                                        {{ __('digital_studio.comments.testimonials.empty.button') }}

                                    </a>

                                </div>


                            </article>

                        </div>


                    @endforelse


                </div>


                {{-- =====================================================
                     SWIPER NAVIGATION
                ====================================================== --}}

                <div class="swiper-button-prev"></div>

                <div class="swiper-button-next"></div>

                <div class="swiper-pagination"></div>


            </div>

        </section>


    </div>

</main>


@include('tech.sections.footer')

@endsection
