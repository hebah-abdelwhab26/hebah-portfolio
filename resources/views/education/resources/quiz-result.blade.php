@extends('education.layouts.app')

@section('title', __('education.resources_page.quiz_result_page.page_title') . ' | ' . $quiz->title)

@section('content')

<section class="education-quiz-result-page">

    <div class="education-quiz-result-container">


        {{-- ==================================================
            BREADCRUMB
        ================================================== --}}

        <div class="education-quiz-result-breadcrumb">

            <a href="{{ route('education.index') }}">

                <i class="fa-solid fa-house"></i>

                {{ __('education.resources_page.quiz_result_page.breadcrumb.home') }}

            </a>


            <i class="fa-solid fa-chevron-left"></i>


            <a href="{{ route('education.resources.index') }}">

                {{ __('education.resources_page.quiz_result_page.breadcrumb.resources') }}

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

            <span>

                {{ __('education.resources_page.quiz_result_page.breadcrumb.result') }}

            </span>

        </div>



        {{-- ==================================================
            RESULT HERO
        ================================================== --}}

        <div class="education-quiz-result-card">


            <div class="education-quiz-result-icon">

                @if($result['passed'])

                    <i class="fa-solid fa-circle-check"></i>

                @else

                    <i class="fa-solid fa-rotate-left"></i>

                @endif

            </div>


            <span class="education-quiz-result-label">

                {{ __('education.resources_page.quiz_result_page.hero.label') }}

            </span>


            <h1>

                {{ $quiz->title }}

            </h1>


            @if($result['passed'])

                <div class="education-quiz-result-status passed">

                    <i class="fa-solid fa-check"></i>

                    {{ __('education.resources_page.quiz_result_page.status.passed') }}

                </div>

            @else

                <div class="education-quiz-result-status failed">

                    <i class="fa-solid fa-circle-exclamation"></i>

                    {{ __('education.resources_page.quiz_result_page.status.failed') }}

                </div>

            @endif



            {{-- SCORE --}}

            <div class="education-quiz-result-score">

                <strong>
                    {{ $result['percentage'] }}%
                </strong>

                <span>

                    {{ __('education.resources_page.quiz_result_page.score.label') }}

                </span>

            </div>



            {{-- DETAILS --}}

            <div class="education-quiz-result-details">

                <div>

                    <span>

                        {{ __('education.resources_page.quiz_result_page.details.score') }}

                    </span>

                    <strong>

                        {{ $result['score'] }}
                        /
                        {{ $result['total_points'] }}

                    </strong>

                </div>


                <div>

                    <span>

                        {{ __('education.resources_page.quiz_result_page.details.pass_percentage') }}

                    </span>

                    <strong>

                        {{ $result['pass_percentage'] }}%

                    </strong>

                </div>


                <div>

                    <span>

                        {{ __('education.resources_page.quiz_result_page.details.status') }}

                    </span>

                    <strong class="{{ $result['passed'] ? 'success' : 'failed' }}">

                        {{ $result['passed']
                            ? __('education.resources_page.quiz_result_page.details.passed')
                            : __('education.resources_page.quiz_result_page.details.not_passed')
                        }}

                    </strong>

                </div>

            </div>

        </div>



        {{-- ==================================================
            ACTIONS
        ================================================== --}}

        <div class="education-quiz-result-actions">

            <a
                href="{{ route(
                    'education.resources.quiz',
                    $quiz
                ) }}"
                class="education-quiz-result-retry">

                <i class="fa-solid fa-rotate-right"></i>

                {{ __('education.resources_page.quiz_result_page.actions.retry') }}

            </a>


            @if($quiz->lesson)

                <a
                    href="{{ route(
                        'education.resources.lesson',
                        $quiz->lesson
                    ) }}"
                    class="education-quiz-result-lesson">

                    <i class="fa-solid fa-book-open"></i>

                    {{ __('education.resources_page.quiz_result_page.actions.back_to_lesson') }}

                </a>

            @endif


            <a
                href="{{ route('education.resources.index') }}"
                class="education-quiz-result-resources">

                {{ __('education.resources_page.quiz_result_page.actions.resources') }}

                <i class="fa-solid fa-arrow-left"></i>

            </a>

        </div>



        {{-- ==================================================
            MESSAGE
        ================================================== --}}

        <div class="education-quiz-result-message">

            <i class="fa-solid fa-lightbulb"></i>

            <div>

                <strong>

                    {{ __('education.resources_page.quiz_result_page.message.title') }}

                </strong>

                <span>

                    {{ __('education.resources_page.quiz_result_page.message.description') }}

                </span>

            </div>

        </div>

    </div>

</section>

@endsection


@push('styles')

<style>

.education-quiz-result-page {

    padding: 60px 0 110px;

}


.education-quiz-result-container {

    width: min(
        900px,
        calc(100% - 40px)
    );

    margin: 0 auto;

}


/*==================================================
    BREADCRUMB
==================================================*/

.education-quiz-result-breadcrumb {

    display: flex;

    align-items: center;

    flex-wrap: wrap;

    gap: 10px;

    margin-bottom: 30px;

    color: #888980;

    font-size: 12px;

}


.education-quiz-result-breadcrumb a {

    display: inline-flex;

    align-items: center;

    gap: 7px;

    color: #777970;

    text-decoration: none;

}


.education-quiz-result-breadcrumb a:hover {

    color: #a47e42;

}


.education-quiz-result-breadcrumb > i {

    color: #b99a5b;

    font-size: 9px;

}


/*==================================================
    RESULT CARD
==================================================*/

.education-quiz-result-card {

    padding: 55px 40px;

    text-align: center;

    border-radius: 30px;

    background:
        linear-gradient(
            135deg,
            #303229,
            #3a3b31
        );

    box-shadow:
        0 25px 65px
        rgba(40,42,35,.16);

}


.education-quiz-result-icon {

    width: 90px;

    height: 90px;

    display: flex;

    align-items: center;

    justify-content: center;

    margin: 0 auto 20px;

    border-radius: 27px;

    background:
        rgba(214,181,110,.12);

    border:
        1px solid
        rgba(214,181,110,.20);

    color: #d7b66f;

    font-size: 38px;

}


.education-quiz-result-label {

    display: inline-block;

    margin-bottom: 12px;

    color: #d4b16c;

    font-size: 12px;

    font-weight: 800;

}


.education-quiz-result-card h1 {

    margin: 0;

    color: #fff;

    font-size: clamp(
        28px,
        4vw,
        42px
    );

    line-height: 1.5;

}


/*==================================================
    STATUS
==================================================*/

.education-quiz-result-status {

    display: inline-flex;

    align-items: center;

    gap: 8px;

    margin-top: 22px;

    padding: 10px 17px;

    border-radius: 50px;

    font-size: 12px;

    font-weight: 800;

}


.education-quiz-result-status.passed {

    background:
        rgba(127,156,112,.13);

    color: #a7c59a;

}


.education-quiz-result-status.failed {

    background:
        rgba(190,157,91,.12);

    color: #d8b873;

}


/*==================================================
    SCORE
==================================================*/

.education-quiz-result-score {

    margin: 35px 0;

}


.education-quiz-result-score strong {

    display: block;

    color: #d7b66f;

    font-size: 72px;

    font-weight: 900;

    line-height: 1;

}


.education-quiz-result-score span {

    display: block;

    margin-top: 9px;

    color:
        rgba(255,255,255,.55);

    font-size: 11px;

}


/*==================================================
    DETAILS
==================================================*/

.education-quiz-result-details {

    display: grid;

    grid-template-columns:
        repeat(3, minmax(0, 1fr));

    gap: 12px;

}


.education-quiz-result-details > div {

    padding: 17px;

    border:
        1px solid
        rgba(255,255,255,.08);

    border-radius: 15px;

    background:
        rgba(255,255,255,.035);

}


.education-quiz-result-details span {

    display: block;

    margin-bottom: 7px;

    color:
        rgba(255,255,255,.48);

    font-size: 10px;

}


.education-quiz-result-details strong {

    color: #fff;

    font-size: 13px;

}


.education-quiz-result-details strong.success {

    color: #a7c59a;

}


.education-quiz-result-details strong.failed {

    color: #d8b873;

}


/*==================================================
    ACTIONS
==================================================*/

.education-quiz-result-actions {

    display: flex;

    align-items: center;

    justify-content: center;

    flex-wrap: wrap;

    gap: 10px;

    margin-top: 25px;

}


.education-quiz-result-actions a {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 8px;

    padding: 13px 18px;

    border-radius: 12px;

    text-decoration: none;

    font-size: 12px;

    font-weight: 800;

}


.education-quiz-result-retry {

    background: #303229;

    color: #d4b16c;

}


.education-quiz-result-lesson {

    background:
        rgba(178,141,76,.10);

    color: #a47e42;

}


.education-quiz-result-resources {

    color: #777970;

}


.education-quiz-result-actions a:hover {

    transform: translateY(-2px);

}


/*==================================================
    MESSAGE
==================================================*/

.education-quiz-result-message {

    display: flex;

    align-items: center;

    gap: 13px;

    margin-top: 25px;

    padding: 18px 20px;

    border:
        1px solid
        rgba(45,47,39,.08);

    border-radius: 18px;

    background:
        rgba(255,255,255,.75);

}


.education-quiz-result-message > i {

    width: 42px;

    height: 42px;

    flex: 0 0 42px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 12px;

    background:
        rgba(178,141,76,.10);

    color: #a47e42;

}


.education-quiz-result-message strong {

    display: block;

    color: #303229;

    font-size: 13px;

}


.education-quiz-result-message span {

    display: block;

    margin-top: 4px;

    color: #85867e;

    font-size: 11px;

}


/*==================================================
    RESPONSIVE
==================================================*/

@media (max-width: 650px) {

    .education-quiz-result-page {

        padding: 35px 0 80px;

    }


    .education-quiz-result-container {

        width:
            min(
                100% - 28px,
                520px
            );

    }


    .education-quiz-result-card {

        padding: 40px 20px;

        border-radius: 24px;

    }


    .education-quiz-result-score strong {

        font-size: 58px;

    }


    .education-quiz-result-details {

        grid-template-columns: 1fr;

    }


    .education-quiz-result-actions {

        align-items: stretch;

        flex-direction: column;

    }


    .education-quiz-result-actions a {

        width: 100%;

    }


    .education-quiz-result-message {

        align-items: flex-start;

    }

}

</style>

@endpush
