@extends('education.layouts.app')

@section('title', $quiz->title)

@section('content')

<section class="education-quiz-page">

<div class="education-quiz-container">

    {{-- ==================================================
        BREADCRUMB
    ================================================== --}}

    <div class="education-quiz-breadcrumb">

        <a href="{{ route('education.index') }}">

            <i class="fa-solid fa-house"></i>

            {{ __('education.resources_page.quiz_page.breadcrumb.home') }}

        </a>

        <i class="fa-solid fa-chevron-left"></i>

        <a href="{{ route('education.resources.index') }}">

            {{ __('education.resources_page.quiz_page.breadcrumb.resources') }}

        </a>

        @if($quiz->lesson)

            <i class="fa-solid fa-chevron-left"></i>

            <a href="{{ route(
                'education.resources.lesson',
                $quiz->lesson
            ) }}">

                {{ $quiz->lesson->title }}

            </a>

        @endif

        <i class="fa-solid fa-chevron-left"></i>

        <span class="current">

            {{ $quiz->title }}

        </span>

    </div>



    {{-- ==================================================
        QUIZ HERO
    ================================================== --}}

    <header class="education-quiz-hero">

        <div class="education-quiz-hero-content">

            <span class="education-quiz-badge">

                <i class="fa-solid fa-clipboard-question"></i>

                {{ __('education.resources_page.quiz_page.hero.badge') }}

            </span>


            <h1>
                {{ $quiz->title }}
            </h1>


            @if($quiz->description)

                <p>
                    {{ $quiz->description }}
                </p>

            @else

                <p>
                    {{ __('education.resources_page.quiz_page.hero.fallback_description') }}
                </p>

            @endif

        </div>


        <div class="education-quiz-hero-icon">

            <i class="fa-solid fa-clipboard-check"></i>

        </div>

    </header>



    {{-- ==================================================
        QUIZ META
    ================================================== --}}

    <div class="education-quiz-meta">

        <div class="education-quiz-meta-item">

            <span class="education-quiz-meta-icon">

                <i class="fa-solid fa-circle-question"></i>

            </span>

            <div>

                <small>
                    {{ __('education.resources_page.quiz_page.meta.questions_count') }}
                </small>

                <strong>
                    {{ $quiz->questions->count() }}
                </strong>

            </div>

        </div>


        @if($quiz->pass_percentage !== null)

            <div class="education-quiz-meta-item">

                <span class="education-quiz-meta-icon">

                    <i class="fa-solid fa-percent"></i>

                </span>

                <div>

                    <small>
                        {{ __('education.resources_page.quiz_page.meta.pass_percentage') }}
                    </small>

                    <strong>
                        {{ $quiz->pass_percentage }}%
                    </strong>

                </div>

            </div>

        @endif


        @if($quiz->time_limit)

            <div class="education-quiz-meta-item">

                <span class="education-quiz-meta-icon">

                    <i class="fa-regular fa-clock"></i>

                </span>

                <div>

                    <small>
                        {{ __('education.resources_page.quiz_page.meta.time_limit') }}
                    </small>

                    <strong>
                        {{ $quiz->time_limit }}
                        {{ __('education.resources_page.quiz_page.meta.minute') }}
                    </strong>

                </div>

            </div>

        @endif


        @if($quiz->max_attempts)

            <div class="education-quiz-meta-item">

                <span class="education-quiz-meta-icon">

                    <i class="fa-solid fa-rotate"></i>

                </span>

                <div>

                    <small>
                        {{ __('education.resources_page.quiz_page.meta.attempts') }}
                    </small>

                    <strong>
                        {{ $quiz->max_attempts }}
                    </strong>

                </div>

            </div>

        @endif

    </div>



    {{-- ==================================================
        QUIZ CONTENT
    ================================================== --}}

    @if($quiz->questions->count())

        <div class="education-quiz-layout">


            {{-- ==================================================
                MAIN
            ================================================== --}}

            <main class="education-quiz-main">

                <div class="education-quiz-section-heading">

                    <div>

                        <span class="education-section-badge">

                            {{ __('education.resources_page.quiz_page.questions.badge') }}

                        </span>

                        <h2>

                            {{ __('education.resources_page.quiz_page.questions.title') }}

                        </h2>

                    </div>


                    <span class="education-quiz-question-count">

                        {{ $quiz->questions->count() }}

                        {{ __('education.resources_page.quiz_page.questions.question_count') }}

                    </span>

                </div>



                {{-- ==================================================
                    QUESTIONS + SUBMIT FORM
                ================================================== --}}

                <form
                    method="POST"
                    action="{{ route(
                        'education.resources.quiz.submit',
                        $quiz
                    ) }}"
                    class="education-quiz-form">

                    @csrf


                    <div class="education-quiz-questions">

                        @foreach($quiz->questions as $index => $question)

                            <article
                                class="education-quiz-question-card">

                                {{-- QUESTION HEADER --}}

                                <div class="education-quiz-question-header">

                                    <div class="education-quiz-question-number">

                                        {{ str_pad(
                                            $index + 1,
                                            2,
                                            '0',
                                            STR_PAD_LEFT
                                        ) }}

                                    </div>


                                    <div class="education-quiz-question-title">

                                        <span>

                                            <i class="fa-solid fa-circle-question"></i>

                                            {{ __('education.resources_page.quiz_page.questions.question') }}
                                            {{ $index + 1 }}

                                        </span>


                                        <h3>

                                            {{ $question->question }}

                                        </h3>

                                    </div>

                                </div>



                                {{-- QUESTION DESCRIPTION --}}

                                @if($question->explanation)

                                    <div class="education-quiz-question-description">

                                        <i class="fa-solid fa-circle-info"></i>

                                        <span>

                                            {{ $question->explanation }}

                                        </span>

                                    </div>

                                @endif



                                {{-- OPTIONS --}}

                                @if($question->options->count())

                                    <div class="education-quiz-options">

                                        @foreach($question->options as $option)

                                            <label
                                                class="education-quiz-option">

                                                <input
                                                    type="radio"
                                                    name="answers[{{ $question->id }}]"
                                                    value="{{ $option->id }}"
                                                    required
                                                >

                                                <span class="education-quiz-option-radio">

                                                    <i class="fa-solid fa-check"></i>

                                                </span>


                                                <span class="education-quiz-option-text">

                                                    {{ $option->option }}

                                                </span>

                                            </label>

                                        @endforeach

                                    </div>

                                @else

                                    <div class="education-quiz-missing-option">

                                        <i class="fa-solid fa-triangle-exclamation"></i>

                                        <span>

                                            {{ __('education.resources_page.quiz_page.questions.missing_options') }}

                                        </span>

                                    </div>

                                @endif



                                {{-- QUESTION FOOTER --}}

                                <div class="education-quiz-question-footer">

                                    <span>

                                        <i class="fa-solid fa-star"></i>

                                        {{ $question->points ?? 1 }}

                                        {{ ($question->points ?? 1) == 1
                                            ? __('education.resources_page.quiz_page.questions.points')
                                            : __('education.resources_page.quiz_page.questions.points_plural')
                                        }}

                                    </span>

                                </div>

                            </article>

                        @endforeach

                    </div>



                    {{-- ==================================================
                        SUBMIT
                    ================================================== --}}

                    <div class="education-quiz-submit">

                        <div class="education-quiz-submit-info">

                            <div class="education-quiz-submit-icon">

                                <i class="fa-solid fa-paper-plane"></i>

                            </div>

                            <div>

                                <strong>

                                    {{ __('education.resources_page.quiz_page.submit.question') }}

                                </strong>

                                <span>

                                    {{ __('education.resources_page.quiz_page.submit.review') }}

                                </span>

                            </div>

                        </div>


                        <button
                            type="submit"
                            class="education-quiz-submit-button">

                            {{ __('education.resources_page.quiz_page.submit.button') }}

                            <i class="fa-solid fa-arrow-left"></i>

                        </button>

                    </div>

                </form>

            </main>



            {{-- ==================================================
                SIDEBAR
            ================================================== --}}

            <aside class="education-quiz-sidebar">


                {{-- SUMMARY --}}

                <div class="education-quiz-sidebar-card">

                    <div class="education-quiz-sidebar-heading">

                        <span class="education-quiz-sidebar-icon">

                            <i class="fa-solid fa-clipboard-question"></i>

                        </span>

                        <div>

                            <strong>

                                {{ __('education.resources_page.quiz_page.sidebar.info_title') }}

                            </strong>

                            <small>

                                {{ __('education.resources_page.quiz_page.sidebar.info_subtitle') }}

                            </small>

                        </div>

                    </div>


                    <div class="education-quiz-sidebar-list">

                        <div>

                            <span>

                                {{ __('education.resources_page.quiz_page.sidebar.questions') }}

                            </span>

                            <strong>
                                {{ $quiz->questions->count() }}
                            </strong>

                        </div>


                        @if($quiz->pass_percentage !== null)

                            <div>

                                <span>

                                    {{ __('education.resources_page.quiz_page.sidebar.pass') }}

                                </span>

                                <strong>
                                    {{ $quiz->pass_percentage }}%
                                </strong>

                            </div>

                        @endif


                        @if($quiz->time_limit)

                            <div>

                                <span>

                                    {{ __('education.resources_page.quiz_page.sidebar.time') }}

                                </span>

                                <strong>

                                    {{ $quiz->time_limit }}
                                    {{ __('education.resources_page.quiz_page.meta.minute') }}

                                </strong>

                            </div>

                        @endif


                        @if($quiz->max_attempts)

                            <div>

                                <span>

                                    {{ __('education.resources_page.quiz_page.sidebar.attempts') }}

                                </span>

                                <strong>
                                    {{ $quiz->max_attempts }}
                                </strong>

                            </div>

                        @endif


                        <div>

                            <span>

                                {{ __('education.resources_page.quiz_page.sidebar.status') }}

                            </span>

                            <strong class="active">

                                {{ __('education.resources_page.quiz_page.sidebar.available') }}

                            </strong>

                        </div>

                    </div>

                </div>



                {{-- LESSON --}}

                @if($quiz->lesson)

                    <div class="education-quiz-sidebar-card">

                        <div class="education-quiz-sidebar-heading">

                            <span class="education-quiz-sidebar-icon">

                                <i class="fa-solid fa-book-open"></i>

                            </span>

                            <div>

                                <strong>

                                    {{ __('education.resources_page.quiz_page.sidebar.lesson_title') }}

                                </strong>

                                <small>

                                    {{ __('education.resources_page.quiz_page.sidebar.lesson_subtitle') }}

                                </small>

                            </div>

                        </div>


                        <div class="education-quiz-sidebar-lesson">

                            <span>

                                <i class="fa-solid fa-book"></i>

                                {{ $quiz->lesson->title }}

                            </span>


                            <a
                                href="{{ route(
                                    'education.resources.lesson',
                                    $quiz->lesson
                                ) }}">

                                {{ __('education.resources_page.quiz_page.sidebar.view_lesson') }}

                                <i class="fa-solid fa-arrow-left"></i>

                            </a>

                        </div>

                    </div>

                @endif



                {{-- INSTRUCTIONS --}}

                <div class="education-quiz-sidebar-card">

                    <div class="education-quiz-sidebar-heading">

                        <span class="education-quiz-sidebar-icon">

                            <i class="fa-solid fa-circle-info"></i>

                        </span>

                        <div>

                            <strong>

                                {{ __('education.resources_page.quiz_page.sidebar.instructions_title') }}

                            </strong>

                            <small>

                                {{ __('education.resources_page.quiz_page.sidebar.instructions_subtitle') }}

                            </small>

                        </div>

                    </div>


                    <ul class="education-quiz-instructions">

                        <li>

                            <i class="fa-solid fa-check"></i>

                            {{ __('education.resources_page.quiz_page.sidebar.instructions.read_question') }}

                        </li>


                        <li>

                            <i class="fa-solid fa-check"></i>

                            {{ __('education.resources_page.quiz_page.sidebar.instructions.choose_answer') }}

                        </li>


                        @if($quiz->time_limit)

                            <li>

                                <i class="fa-solid fa-check"></i>

                                {{ __('education.resources_page.quiz_page.sidebar.instructions.watch_time') }}

                            </li>

                        @endif


                        <li>

                            <i class="fa-solid fa-check"></i>

                            {{ __('education.resources_page.quiz_page.sidebar.instructions.review_answers') }}

                        </li>

                    </ul>

                </div>



                {{-- BACK --}}

                @if($quiz->lesson)

                    <a
                        href="{{ route(
                            'education.resources.lesson',
                            $quiz->lesson
                        ) }}"
                        class="education-quiz-sidebar-back">

                        <i class="fa-solid fa-arrow-right"></i>

                        {{ __('education.resources_page.quiz_page.sidebar.back_to_lesson') }}

                    </a>

                @endif


                <a
                    href="{{ route('education.resources.index') }}"
                    class="education-quiz-sidebar-all">

                    {{ __('education.resources_page.quiz_page.sidebar.all_resources') }}

                    <i class="fa-solid fa-arrow-left"></i>

                </a>

            </aside>

        </div>

    @else

        {{-- ==================================================
            EMPTY QUIZ
        ================================================== --}}

        <div class="education-quiz-empty">

            <div class="education-quiz-empty-icon">

                <i class="fa-solid fa-clipboard-question"></i>

            </div>


            <h2>

                {{ __('education.resources_page.quiz_page.empty.title') }}

            </h2>


            <p>

                {{ __('education.resources_page.quiz_page.empty.description') }}

            </p>


            @if($quiz->lesson)

                <a
                    href="{{ route(
                        'education.resources.lesson',
                        $quiz->lesson
                    ) }}"
                    class="education-quiz-empty-link">

                    <i class="fa-solid fa-arrow-right"></i>

                    {{ __('education.resources_page.quiz_page.empty.back_to_lesson') }}

                </a>

            @else

                <a
                    href="{{ route('education.resources.index') }}"
                    class="education-quiz-empty-link">

                    <i class="fa-solid fa-arrow-right"></i>

                    {{ __('education.resources_page.quiz_page.empty.all_resources') }}

                </a>

            @endif

        </div>

    @endif



    {{-- ==================================================
        BOTTOM
    ================================================== --}}

    <div class="education-quiz-bottom">

        @if($quiz->lesson)

            <a
                href="{{ route(
                    'education.resources.lesson',
                    $quiz->lesson
                ) }}">

                <i class="fa-solid fa-arrow-right"></i>

                {{ __('education.resources_page.quiz_page.bottom.back_to_lesson') }}

            </a>

        @else

            <a
                href="{{ route('education.resources.index') }}">

                <i class="fa-solid fa-arrow-right"></i>

                {{ __('education.resources_page.quiz_page.bottom.all_resources') }}

            </a>

        @endif


        <span>

            {{ __('education.resources_page.quiz_page.bottom.description') }}

        </span>

    </div>

</div>


</section>

@endsection

@push('styles')

<style>

/*==================================================
    EDUCATION QUIZ PAGE
==================================================*/

.education-quiz-page {

    position: relative;

    padding: 55px 0 110px;

    overflow: hidden;

}


.education-quiz-container {

    width: min(
        1180px,
        calc(100% - 40px)
    );

    margin: 0 auto;

}



/*==================================================
    BREADCRUMB
==================================================*/

.education-quiz-breadcrumb {

    display: flex;

    align-items: center;

    flex-wrap: wrap;

    gap: 10px;

    margin-bottom: 32px;

    color: #888980;

    font-size: 12px;

}


.education-quiz-breadcrumb a {

    display: inline-flex;

    align-items: center;

    gap: 7px;

    color: #777970;

    text-decoration: none;

    transition: color .25s ease;

}


.education-quiz-breadcrumb a:hover {

    color: #a47e42;

}


.education-quiz-breadcrumb > i {

    color: #b99a5b;

    font-size: 9px;

}


.education-quiz-breadcrumb .current {

    color: #a3834b;

    font-weight: 800;

}



/*==================================================
    HERO
==================================================*/

.education-quiz-hero {

    position: relative;

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 35px;

    padding: 44px;

    margin-bottom: 22px;

    border-radius: 30px;

    background:
        linear-gradient(
            135deg,
            #303229,
            #3a3b31
        );

    box-shadow:
        0 22px 55px
        rgba(40,42,35,.15);

    overflow: hidden;

}


.education-quiz-hero::before {

    content: "";

    position: absolute;

    width: 360px;

    height: 360px;

    left: -170px;

    bottom: -230px;

    border-radius: 50%;

    background:
        rgba(211,175,101,.07);

}


.education-quiz-hero::after {

    content: "";

    position: absolute;

    width: 280px;

    height: 280px;

    right: -140px;

    top: -190px;

    border-radius: 50%;

    border:
        1px solid
        rgba(214,181,110,.10);

}


.education-quiz-hero-content {

    position: relative;

    z-index: 2;

    max-width: 820px;

}


.education-quiz-badge {

    display: inline-flex;

    align-items: center;

    gap: 8px;

    padding: 8px 15px;

    margin-bottom: 17px;

    border:
        1px solid
        rgba(214,181,110,.23);

    border-radius: 50px;

    background:
        rgba(214,181,110,.07);

    color: #d4b16c;

    font-size: 12px;

    font-weight: 800;

}


.education-quiz-hero h1 {

    margin: 0 0 15px;

    color: #fff;

    font-size: clamp(
        31px,
        4vw,
        48px
    );

    font-weight: 800;

    line-height: 1.35;

}


.education-quiz-hero p {

    max-width: 760px;

    margin: 0;

    color:
        rgba(255,255,255,.66);

    font-size: 15px;

    line-height: 2;

}


.education-quiz-hero-icon {

    position: relative;

    z-index: 2;

    width: 94px;

    height: 94px;

    flex: 0 0 94px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 28px;

    background:
        rgba(214,181,110,.12);

    border:
        1px solid
        rgba(214,181,110,.18);

    color: #d7b66f;

    font-size: 36px;

}



/*==================================================
    META
==================================================*/

.education-quiz-meta {

    display: grid;

    grid-template-columns:
        repeat(4, minmax(0, 1fr));

    gap: 13px;

    margin-bottom: 48px;

}


.education-quiz-meta-item {

    display: flex;

    align-items: center;

    gap: 12px;

    padding: 17px;

    background:
        rgba(255,255,255,.80);

    border:
        1px solid
        rgba(45,47,39,.07);

    border-radius: 17px;

}


.education-quiz-meta-icon {

    width: 43px;

    height: 43px;

    flex: 0 0 43px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 13px;

    background:
        rgba(178,141,76,.10);

    color: #a47e42;

}


.education-quiz-meta-item small {

    display: block;

    margin-bottom: 4px;

    color: #8b8c84;

    font-size: 10px;

}


.education-quiz-meta-item strong {

    display: block;

    color: #303229;

    font-size: 13px;

    font-weight: 800;

}



/*==================================================
    LAYOUT
==================================================*/

.education-quiz-layout {

    display: grid;

    grid-template-columns:
        minmax(0, 1fr)
        310px;

    align-items: start;

    gap: 32px;

}



/*==================================================
    SECTION HEADING
==================================================*/

.education-quiz-section-heading {

    display: flex;

    align-items: flex-end;

    justify-content: space-between;

    gap: 20px;

    margin-bottom: 25px;

}


.education-quiz-section-heading
.education-section-badge {

    display: inline-flex;

    padding: 7px 15px;

    border:
        1px solid
        rgba(190,157,91,.30);

    border-radius: 50px;

    color: #a3834b;

    font-size: 11px;

    font-weight: 800;

}


.education-quiz-section-heading h2 {

    margin: 12px 0 0;

    color: #303229;

    font-size: 28px;

    font-weight: 800;

}


.education-quiz-question-count {

    padding: 8px 12px;

    border-radius: 10px;

    background:
        rgba(45,47,39,.04);

    color: #85867e;

    font-size: 11px;

    font-weight: 700;

}



/*==================================================
    QUESTIONS
==================================================*/

.education-quiz-questions {

    display: flex;

    flex-direction: column;

    gap: 20px;

}


.education-quiz-question-card {

    padding: 27px;

    background:
        rgba(255,255,255,.84);

    border:
        1px solid
        rgba(45,47,39,.08);

    border-radius: 24px;

    box-shadow:
        0 10px 32px
        rgba(40,42,35,.055);

}


.education-quiz-question-header {

    display: flex;

    align-items: flex-start;

    gap: 15px;

    padding-bottom: 20px;

    border-bottom:
        1px solid
        rgba(45,47,39,.07);

}


.education-quiz-question-number {

    width: 44px;

    height: 44px;

    flex: 0 0 44px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 13px;

    background: #303229;

    color: #d4b16c;

    font-size: 12px;

    font-weight: 800;

}


.education-quiz-question-title {

    min-width: 0;

}


.education-quiz-question-title > span {

    display: inline-flex;

    align-items: center;

    gap: 6px;

    color: #a3834b;

    font-size: 11px;

    font-weight: 800;

}


.education-quiz-question-title h3 {

    margin: 7px 0 0;

    color: #303229;

    font-size: 18px;

    font-weight: 800;

    line-height: 1.7;

}



/*==================================================
    DESCRIPTION
==================================================*/

.education-quiz-question-description {

    display: flex;

    align-items: flex-start;

    gap: 9px;

    margin-top: 18px;

    padding: 13px 15px;

    border-right:
        3px solid
        #b28d4c;

    border-radius: 9px;

    background:
        rgba(178,141,76,.05);

    color: #777970;

    font-size: 12px;

    line-height: 1.9;

}


.education-quiz-question-description i {

    flex: 0 0 auto;

    margin-top: 3px;

    color: #a47e42;

}



/*==================================================
    OPTIONS
==================================================*/

.education-quiz-options {

    display: flex;

    flex-direction: column;

    gap: 10px;

    margin-top: 22px;

}


.education-quiz-option {

    position: relative;

    display: flex;

    align-items: center;

    gap: 12px;

    padding: 14px 15px;

    border:
        1px solid
        rgba(45,47,39,.08);

    border-radius: 14px;

    background:
        rgba(45,47,39,.025);

    cursor: pointer;

    transition:
        background .25s ease,
        border-color .25s ease,
        transform .25s ease;

}


.education-quiz-option:hover {

    transform: translateX(-2px);

    border-color:
        rgba(178,141,76,.25);

    background:
        rgba(178,141,76,.05);

}


.education-quiz-option input {

    position: absolute;

    opacity: 0;

    pointer-events: none;

}


.education-quiz-option-radio {

    width: 22px;

    height: 22px;

    flex: 0 0 22px;

    display: flex;

    align-items: center;

    justify-content: center;

    border:
        2px solid
        #c6c7c0;

    border-radius: 50%;

    color: transparent;

    font-size: 10px;

    transition:
        background .25s ease,
        border-color .25s ease,
        color .25s ease;

}


.education-quiz-option input:checked
+ .education-quiz-option-radio {

    background: #303229;

    border-color: #303229;

    color: #d4b16c;

}


.education-quiz-option input:checked
~ .education-quiz-option-text {

    color: #303229;

    font-weight: 800;

}


.education-quiz-option-text {

    color: #666860;

    font-size: 13px;

    line-height: 1.7;

}



/*==================================================
    QUESTION FOOTER
==================================================*/

.education-quiz-question-footer {

    margin-top: 20px;

    padding-top: 13px;

    border-top:
        1px solid
        rgba(45,47,39,.06);

}


.education-quiz-question-footer span {

    display: inline-flex;

    align-items: center;

    gap: 6px;

    color: #999a93;

    font-size: 10px;

    font-weight: 700;

}


.education-quiz-question-footer i {

    color: #b28d4c;

}



/*==================================================
    SUBMIT
==================================================*/

.education-quiz-submit {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 20px;

    margin-top: 25px;

    padding: 20px;

    border-radius: 20px;

    background:
        rgba(255,255,255,.82);

    border:
        1px solid
        rgba(45,47,39,.08);

}


.education-quiz-submit-info {

    display: flex;

    align-items: center;

    gap: 12px;

}


.education-quiz-submit-icon {

    width: 45px;

    height: 45px;

    flex: 0 0 45px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 13px;

    background:
        rgba(178,141,76,.10);

    color: #a47e42;

}


.education-quiz-submit-info strong {

    display: block;

    color: #303229;

    font-size: 13px;

    font-weight: 800;

}


.education-quiz-submit-info span {

    display: block;

    margin-top: 3px;

    color: #8b8c84;

    font-size: 10px;

}


.education-quiz-submit-button {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 8px;

    padding: 13px 18px;

    border: 0;

    border-radius: 12px;

    background: #303229;

    color: #d4b16c;

    cursor: pointer;

    font-family: inherit;

    font-size: 12px;

    font-weight: 800;

    transition:
        background .25s ease,
        transform .25s ease;

}


.education-quiz-submit-button:hover {

    background: #3c3d33;

    transform: translateY(-2px);

}



/*==================================================
    SIDEBAR
==================================================*/

.education-quiz-sidebar {

    position: sticky;

    top: 30px;

    display: flex;

    flex-direction: column;

    gap: 18px;

}


.education-quiz-sidebar-card {

    padding: 21px;

    background:
        rgba(255,255,255,.84);

    border:
        1px solid
        rgba(45,47,39,.08);

    border-radius: 21px;

    box-shadow:
        0 10px 30px
        rgba(40,42,35,.055);

}


.education-quiz-sidebar-heading {

    display: flex;

    align-items: center;

    gap: 11px;

    margin-bottom: 20px;

}


.education-quiz-sidebar-icon {

    width: 42px;

    height: 42px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 13px;

    background:
        rgba(178,141,76,.10);

    color: #a47e42;

}


.education-quiz-sidebar-heading strong {

    display: block;

    color: #303229;

    font-size: 13px;

    font-weight: 800;

}


.education-quiz-sidebar-heading small {

    display: block;

    margin-top: 3px;

    color: #92938c;

    font-size: 10px;

}



/*==================================================
    SIDEBAR LIST
==================================================*/

.education-quiz-sidebar-list {

    display: flex;

    flex-direction: column;

}


.education-quiz-sidebar-list div {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 15px;

    padding: 12px 0;

    border-top:
        1px solid
        rgba(45,47,39,.06);

}


.education-quiz-sidebar-list span {

    color: #85867e;

    font-size: 11px;

}


.education-quiz-sidebar-list strong {

    color: #303229;

    font-size: 11px;

    font-weight: 800;

}


.education-quiz-sidebar-list strong.active {

    color: #668b69;

}



/*==================================================
    LESSON SIDEBAR
==================================================*/

.education-quiz-sidebar-lesson {

    display: flex;

    flex-direction: column;

    gap: 12px;

}


.education-quiz-sidebar-lesson > span {

    display: flex;

    align-items: flex-start;

    gap: 8px;

    color: #666860;

    font-size: 11px;

    line-height: 1.7;

}


.education-quiz-sidebar-lesson > span i {

    flex: 0 0 auto;

    margin-top: 3px;

    color: #a47e42;

}


.education-quiz-sidebar-lesson a {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 8px;

    padding: 10px 12px;

    border-radius: 11px;

    background:
        rgba(45,47,39,.035);

    color: #777970;

    text-decoration: none;

    font-size: 10px;

    font-weight: 800;

    transition:
        background .25s ease,
        color .25s ease;

}


.education-quiz-sidebar-lesson a:hover {

    background:
        rgba(178,141,76,.08);

    color: #a47e42;

}



/*==================================================
    INSTRUCTIONS
==================================================*/

.education-quiz-instructions {

    display: flex;

    flex-direction: column;

    gap: 11px;

    margin: 0;

    padding: 0;

    list-style: none;

}


.education-quiz-instructions li {

    display: flex;

    align-items: flex-start;

    gap: 8px;

    color: #777970;

    font-size: 11px;

    line-height: 1.7;

}


.education-quiz-instructions li i {

    flex: 0 0 auto;

    margin-top: 4px;

    color: #7f9c70;

    font-size: 9px;

}



/*==================================================
    SIDEBAR BUTTONS
==================================================*/

.education-quiz-sidebar-back {

    display: flex;

    align-items: center;

    justify-content: center;

    gap: 8px;

    padding: 13px;

    border-radius: 13px;

    background: #303229;

    color: #d4b16c;

    text-decoration: none;

    font-size: 12px;

    font-weight: 800;

    transition:
        background .25s ease,
        transform .25s ease;

}


.education-quiz-sidebar-back:hover {

    background: #3c3d33;

    transform: translateY(-2px);

}


.education-quiz-sidebar-all {

    display: flex;

    align-items: center;

    justify-content: center;

    gap: 8px;

    padding: 12px;

    color: #777970;

    text-decoration: none;

    font-size: 12px;

    font-weight: 800;

}


.education-quiz-sidebar-all:hover {

    color: #a47e42;

}



/*==================================================
    EMPTY
==================================================*/

.education-quiz-empty {

    display: flex;

    flex-direction: column;

    align-items: center;

    justify-content: center;

    min-height: 400px;

    padding: 45px 30px;

    text-align: center;

    background:
        rgba(255,255,255,.72);

    border:
        1px dashed
        rgba(45,47,39,.14);

    border-radius: 25px;

}


.education-quiz-empty-icon {

    width: 78px;

    height: 78px;

    display: flex;

    align-items: center;

    justify-content: center;

    margin-bottom: 20px;

    border-radius: 24px;

    background:
        rgba(178,141,76,.10);

    color: #a47e42;

    font-size: 29px;

}


.education-quiz-empty h2 {

    margin: 0 0 9px;

    color: #303229;

    font-size: 22px;

    font-weight: 800;

}


.education-quiz-empty p {

    margin: 0 0 23px;

    color: #85867e;

    font-size: 13px;

}


.education-quiz-empty-link {

    display: inline-flex;

    align-items: center;

    gap: 8px;

    padding: 12px 18px;

    border-radius: 12px;

    background: #303229;

    color: #d4b16c;

    text-decoration: none;

    font-size: 12px;

    font-weight: 800;

}



/*==================================================
    MISSING OPTIONS
==================================================*/

.education-quiz-missing-option {

    display: flex;

    align-items: center;

    gap: 9px;

    margin-top: 20px;

    padding: 13px;

    border-radius: 12px;

    background:
        rgba(178,141,76,.06);

    color: #999a93;

    font-size: 11px;

}


.education-quiz-missing-option i {

    color: #b28d4c;

}



/*==================================================
    BOTTOM
==================================================*/

.education-quiz-bottom {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 20px;

    margin-top: 45px;

    padding-top: 25px;

    border-top:
        1px solid
        rgba(45,47,39,.08);

}


.education-quiz-bottom a {

    display: inline-flex;

    align-items: center;

    gap: 8px;

    color: #303229;

    text-decoration: none;

    font-size: 13px;

    font-weight: 800;

}


.education-quiz-bottom a:hover {

    color: #a47e42;

}


.education-quiz-bottom span {

    color: #85867e;

    font-size: 12px;

}



/*==================================================
    RESPONSIVE
==================================================*/

@media (max-width: 1000px) {

    .education-quiz-layout {

        grid-template-columns: 1fr;

    }


    .education-quiz-sidebar {

        position: static;

        display: grid;

        grid-template-columns:
            repeat(2, minmax(0, 1fr));

    }


    .education-quiz-sidebar-back,
    .education-quiz-sidebar-all {

        min-height: 50px;

    }

}


@media (max-width: 800px) {

    .education-quiz-meta {

        grid-template-columns:
            repeat(2, minmax(0, 1fr));

    }


    .education-quiz-hero {

        align-items: flex-start;

        flex-direction: column;

        padding: 32px;

    }


    .education-quiz-hero-icon {

        width: 75px;

        height: 75px;

        flex-basis: 75px;

        font-size: 29px;

    }


    .education-quiz-submit {

        align-items: flex-start;

        flex-direction: column;

    }


    .education-quiz-submit-button {

        width: 100%;

    }

}


@media (max-width: 620px) {

    .education-quiz-page {

        padding: 35px 0 80px;

    }


    .education-quiz-container {

        width:
            min(
                100% - 28px,
                520px
            );

    }


    .education-quiz-hero {

        padding: 27px 22px;

        border-radius: 23px;

    }


    .education-quiz-hero h1 {

        font-size: 29px;

    }


    .education-quiz-hero p {

        font-size: 13px;

    }


    .education-quiz-meta {

        grid-template-columns: 1fr;

        margin-bottom: 35px;

    }


    .education-quiz-section-heading {

        align-items: flex-start;

        flex-direction: column;

    }


    .education-quiz-question-card {

        padding: 21px;

        border-radius: 20px;

    }


    .education-quiz-question-title h3 {

        font-size: 16px;

    }


    .education-quiz-sidebar {

        display: flex;

    }


    .education-quiz-submit {

        padding: 17px;

    }


    .education-quiz-bottom {

        align-items: flex-start;

        flex-direction: column;

    }

}

</style>

@endpush
