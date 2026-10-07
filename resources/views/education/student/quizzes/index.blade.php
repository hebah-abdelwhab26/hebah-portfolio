@extends('education.layouts.app')

@section('title', __('education.student_quizzes_page.page_title'))

@include('education.student.partials.navigation')

@section('content')

<div class="education-student-quizzes-page">

    {{-- =========================================================
        HEADER
    ========================================================== --}}

    <header class="education-student-quizzes-header">

        <div>

            <span class="education-student-quizzes-eyebrow">
                {{ __('education.student_quizzes_page.header.eyebrow') }}
            </span>

            <h1>
                {{ __('education.student_quizzes_page.header.title') }}
            </h1>

            <p>
                {{ __('education.student_quizzes_page.header.description') }}
            </p>

        </div>


        <div class="education-student-quizzes-header-icon">

            <i class="fa-solid fa-clipboard-question"></i>

        </div>

    </header>


    {{-- =========================================================
        QUIZZES
    ========================================================== --}}

    @if($quizzes->count())

        <section class="education-student-quizzes-grid">

            @foreach($quizzes as $quiz)

                @php

                    $quizAttempts =
                        $attempts->get(
                            $quiz->id,
                            collect()
                        );

                    $completedAttempts =
                        $quizAttempts->where(
                            'status',
                            'completed'
                        );

                    $activeAttempt =
                        $quizAttempts->firstWhere(
                            'status',
                            'in_progress'
                        );

                    $lastAttempt =
                        $completedAttempts->first();

                    $maxAttempts =
                        $quiz->max_attempts;

                    $attemptsUsed =
                        $completedAttempts->count();

                    $canAttempt = true;

                    if (
                        !is_null($maxAttempts) &&
                        $maxAttempts > 0 &&
                        $attemptsUsed >= $maxAttempts
                    ) {
                        $canAttempt = false;
                    }

                @endphp


                <article class="education-student-quiz-card">


                    {{-- =================================================
                        ICON
                    ================================================== --}}

                    <div class="education-student-quiz-card-top">

                        <div class="education-student-quiz-icon">

                            <i class="fa-solid fa-clipboard-question"></i>

                        </div>


                        @if($activeAttempt)

                            <span class="education-student-quiz-status active">

                                <i class="fa-solid fa-play"></i>

                                {{ __('education.student_quizzes_page.status.in_progress') }}

                            </span>

                        @elseif($lastAttempt)

                            @if($lastAttempt->passed)

                                <span class="education-student-quiz-status passed">

                                    <i class="fa-solid fa-circle-check"></i>

                                    {{ __('education.student_quizzes_page.status.passed') }}

                                </span>

                            @else

                                <span class="education-student-quiz-status failed">

                                    <i class="fa-solid fa-circle-xmark"></i>

                                    {{ __('education.student_quizzes_page.status.failed') }}

                                </span>

                            @endif

                        @else

                            <span class="education-student-quiz-status new">

                                {{ __('education.student_quizzes_page.status.new') }}

                            </span>

                        @endif

                    </div>


                    {{-- =================================================
                        CONTENT
                    ================================================== --}}

                    <div class="education-student-quiz-card-content">

                        <h2>
                            {{ $quiz->title }}
                        </h2>


                        @if($quiz->description)

                            <p>
                                {{ $quiz->description }}
                            </p>

                        @else

                            <p>
                                {{ __('education.student_quizzes_page.fallback.description') }}
                            </p>

                        @endif


                        {{-- =================================================
                            META
                        ================================================== --}}

                        <div class="education-student-quiz-meta">

                            <span>

                                <i class="fa-solid fa-list-check"></i>

                                {{ $quiz->questions_count }}

                                {{ $quiz->questions_count == 1
                                    ? __('education.student_quizzes_page.meta.question')
                                    : __('education.student_quizzes_page.meta.questions')
                                }}

                            </span>


                            @if($maxAttempts)

                                <span>

                                    <i class="fa-solid fa-rotate"></i>

                                    {{ $attemptsUsed }}
                                    /
                                    {{ $maxAttempts }}

                                    {{ __('education.student_quizzes_page.meta.attempts') }}

                                </span>

                            @endif


                            @if($quiz->pass_percentage)

                                <span>

                                    <i class="fa-solid fa-chart-simple"></i>

                                    {{ __('education.student_quizzes_page.meta.pass') }}

                                    {{ $quiz->pass_percentage }}%

                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- =================================================
                        FOOTER
                    ================================================== --}}

                    <div class="education-student-quiz-card-footer">


                        @if($activeAttempt)

                            <a
                                href="{{ route(
                                    'education.student.quizzes.show',
                                    $quiz
                                ) }}"
                                class="education-student-quiz-button primary"
                            >

                                {{ __('education.student_quizzes_page.actions.continue') }}

                                <i class="fa-solid fa-arrow-left"></i>

                            </a>


                        @elseif($canAttempt)

                            <a
                                href="{{ route(
                                    'education.student.quizzes.show',
                                    $quiz
                                ) }}"
                                class="education-student-quiz-button primary"
                            >

                                {{ __('education.student_quizzes_page.actions.start') }}

                                <i class="fa-solid fa-arrow-left"></i>

                            </a>


                        @else

                            <span
                                class="education-student-quiz-button disabled"
                            >

                                {{ __('education.student_quizzes_page.actions.attempts_exhausted') }}

                                <i class="fa-solid fa-lock"></i>

                            </span>

                        @endif


                        @if($lastAttempt)

                            <a
                                href="{{ route(
                                    'education.student.quizzes.result',
                                    $lastAttempt
                                ) }}"
                                class="education-student-quiz-result-link"
                            >

                                {{ __('education.student_quizzes_page.actions.last_result') }}

                                <i class="fa-solid fa-chart-line"></i>

                            </a>

                        @endif


                    </div>

                </article>

            @endforeach

        </section>


    @else

        {{-- =========================================================
            EMPTY
        ========================================================== --}}

        <section class="education-student-quizzes-empty">

            <div class="education-student-quizzes-empty-icon">

                <i class="fa-solid fa-clipboard-question"></i>

            </div>

            <h2>
                {{ __('education.student_quizzes_page.empty.title') }}
            </h2>

            <p>
                {{ __('education.student_quizzes_page.empty.description') }}
            </p>

            <a
                href="{{ route('education.student.lessons.index') }}"
                class="education-student-quizzes-empty-button"
            >

                {{ __('education.student_quizzes_page.actions.view_lessons') }}

                <i class="fa-solid fa-arrow-left"></i>

            </a>

        </section>

    @endif

</div>

{{-- =========================================================
    STYLES
========================================================= --}}

<style>

.education-student-quizzes-page {

    direction: rtl;

    max-width: 1200px;

    margin: 0 auto;

    padding: 40px 24px 80px;

    color: #30372a;

}


/* =========================================================
   HEADER
========================================================= */

.education-student-quizzes-header {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 30px;

    margin-bottom: 35px;

}


.education-student-quizzes-eyebrow {

    display: inline-block;

    margin-bottom: 8px;

    color: #8c7028;

    font-size: 13px;

    font-weight: 700;

}


.education-student-quizzes-header h1 {

    margin: 0 0 10px;

    color: #30372a;

    font-family: 'Amiri', serif;

    font-size: 42px;

    line-height: 1.2;

}


.education-student-quizzes-header p {

    margin: 0;

    color: #73786d;

    font-size: 15px;

}


.education-student-quizzes-header-icon {

    width: 75px;

    height: 75px;

    flex-shrink: 0;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 22px;

    background: rgba(140, 112, 40, .09);

    color: #8c7028;

    font-size: 30px;

}


/* =========================================================
   GRID
========================================================= */

.education-student-quizzes-grid {

    display: grid;

    grid-template-columns:
        repeat(2, minmax(0, 1fr));

    gap: 22px;

}


/* =========================================================
   CARD
========================================================= */

.education-student-quiz-card {

    display: flex;

    flex-direction: column;

    min-height: 320px;

    padding: 25px;

    border: 1px solid rgba(82, 96, 68, .12);

    border-radius: 22px;

    background: #fff;

    box-shadow:
        0 12px 35px rgba(48, 55, 42, .07);

    transition:
        transform .25s ease,
        box-shadow .25s ease;

}


.education-student-quiz-card:hover {

    transform: translateY(-4px);

    box-shadow:
        0 18px 45px rgba(48, 55, 42, .11);

}


/* =========================================================
   CARD TOP
========================================================= */

.education-student-quiz-card-top {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 15px;

    margin-bottom: 22px;

}


.education-student-quiz-icon {

    width: 55px;

    height: 55px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 17px;

    background: #f4f0e5;

    color: #8c7028;

    font-size: 22px;

}


.education-student-quiz-status {

    display: inline-flex;

    align-items: center;

    gap: 6px;

    padding: 7px 11px;

    border-radius: 30px;

    font-size: 12px;

    font-weight: 700;

}


.education-student-quiz-status.new {

    background: #f4f0e5;

    color: #8c7028;

}


.education-student-quiz-status.active {

    background: #eef2e9;

    color: #526044;

}


.education-student-quiz-status.passed {

    background: #edf4ed;

    color: #3f6944;

}


.education-student-quiz-status.failed {

    background: #f8eeee;

    color: #9b4a4a;

}


/* =========================================================
   CONTENT
========================================================= */

.education-student-quiz-card-content {

    flex: 1;

}


.education-student-quiz-card-content h2 {

    margin: 0 0 10px;

    color: #30372a;

    font-family: 'Amiri', serif;

    font-size: 25px;

}


.education-student-quiz-card-content p {

    min-height: 48px;

    margin: 0 0 22px;

    color: #777b72;

    font-size: 14px;

    line-height: 1.9;

}


/* =========================================================
   META
========================================================= */

.education-student-quiz-meta {

    display: flex;

    flex-wrap: wrap;

    gap: 10px;

}


.education-student-quiz-meta span {

    display: inline-flex;

    align-items: center;

    gap: 6px;

    padding: 7px 10px;

    border-radius: 10px;

    background: #f8f7f3;

    color: #68705f;

    font-size: 12px;

}


.education-student-quiz-meta i {

    color: #8c7028;

}


/* =========================================================
   FOOTER
========================================================= */

.education-student-quiz-card-footer {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 15px;

    margin-top: 25px;

    padding-top: 20px;

    border-top: 1px solid rgba(48, 55, 42, .08);

}


.education-student-quiz-button {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 9px;

    min-height: 44px;

    padding: 0 17px;

    border-radius: 12px;

    text-decoration: none;

    font-size: 13px;

    font-weight: 700;

}


.education-student-quiz-button.primary {

    background: #526044;

    color: #fff;

    transition: .25s ease;

}


.education-student-quiz-button.primary:hover {

    background: #414d36;

    transform: translateY(-2px);

}


.education-student-quiz-button.disabled {

    background: #eee;

    color: #999;

    cursor: not-allowed;

}


.education-student-quiz-result-link {

    display: inline-flex;

    align-items: center;

    gap: 7px;

    color: #8c7028;

    text-decoration: none;

    font-size: 12px;

    font-weight: 700;

}


/* =========================================================
   EMPTY
========================================================= */

.education-student-quizzes-empty {

    padding: 70px 25px;

    text-align: center;

    border: 1px solid rgba(82, 96, 68, .12);

    border-radius: 24px;

    background: #fff;

    box-shadow:
        0 12px 35px rgba(48, 55, 42, .06);

}


.education-student-quizzes-empty-icon {

    width: 80px;

    height: 80px;

    display: flex;

    align-items: center;

    justify-content: center;

    margin: 0 auto 20px;

    border-radius: 50%;

    background: #f4f0e5;

    color: #8c7028;

    font-size: 30px;

}


.education-student-quizzes-empty h2 {

    margin: 0 0 10px;

    font-family: 'Amiri', serif;

    font-size: 27px;

}


.education-student-quizzes-empty p {

    margin: 0 auto 25px;

    max-width: 500px;

    color: #777b72;

    font-size: 14px;

    line-height: 1.9;

}


.education-student-quizzes-empty-button {

    display: inline-flex;

    align-items: center;

    gap: 8px;

    padding: 12px 18px;

    border-radius: 12px;

    background: #526044;

    color: #fff;

    text-decoration: none;

    font-size: 13px;

    font-weight: 700;

}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 800px) {

    .education-student-quizzes-grid {

        grid-template-columns: 1fr;

    }

}


@media (max-width: 600px) {

    .education-student-quizzes-page {

        padding:
            25px 16px 60px;

    }


    .education-student-quizzes-header {

        align-items: flex-start;

    }


    .education-student-quizzes-header h1 {

        font-size: 34px;

    }


    .education-student-quizzes-header-icon {

        width: 60px;

        height: 60px;

        border-radius: 17px;

        font-size: 24px;

    }


    .education-student-quiz-card-footer {

        align-items: stretch;

        flex-direction: column;

    }


    .education-student-quiz-button {

        width: 100%;

    }

}

</style>

@endsection
