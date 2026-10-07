@extends('education.layouts.app')

@section(
    'title',
    __('education.student_quiz_result_page.page_title') .
    ' | ' .
    ($attempt->quiz->title ?? 'Education')
)

@section('meta_description')
    {{ __('education.student_quiz_result_page.meta_description', [
        'quiz' => $attempt->quiz->title ?? __('education.student_quiz_result_page.page_title')
    ]) }}
@endsection


@push('styles')

<style>

/*
|--------------------------------------------------------------------------
| STUDENT QUIZ RESULT
|--------------------------------------------------------------------------
*/

.student-quiz-result-page {
    padding: 50px 0 90px;
}


.student-quiz-result-container {
    width: min(1050px, calc(100% - 40px));
    margin: 0 auto;
}


/*
|--------------------------------------------------------------------------
| BACK
|--------------------------------------------------------------------------
*/

.result-back {
    display: inline-flex;
    align-items: center;
    gap: 8px;

    margin-bottom: 25px;

    color: #6f8068;

    text-decoration: none;

    font-family: 'Cairo', sans-serif;
    font-size: 14px;
    font-weight: 600;

    transition: .25s ease;
}


.result-back:hover {
    color: #b99552;

    transform: translateX(4px);
}


/*
|--------------------------------------------------------------------------
| HERO RESULT
|--------------------------------------------------------------------------
*/

.result-hero {
    position: relative;

    overflow: hidden;

    padding: 45px 35px;

    border-radius: 30px;

    background:
        linear-gradient(
            135deg,
            #fffdf8 0%,
            #f8f1df 100%
        );

    border: 1px solid rgba(185, 149, 82, .18);

    box-shadow:
        0 20px 55px rgba(70, 58, 35, .08);

    text-align: center;
}


.result-hero::before {
    content: '';

    position: absolute;

    top: -120px;
    right: -100px;

    width: 280px;
    height: 280px;

    border-radius: 50%;

    background: rgba(185, 149, 82, .08);
}


.result-hero::after {
    content: '';

    position: absolute;

    bottom: -140px;
    left: -100px;

    width: 280px;
    height: 280px;

    border-radius: 50%;

    background: rgba(111, 128, 104, .07);
}


.result-hero-content {
    position: relative;

    z-index: 2;
}


/*
|--------------------------------------------------------------------------
| STATUS ICON
|--------------------------------------------------------------------------
*/

.result-status-icon {
    width: 88px;
    height: 88px;

    margin: 0 auto 20px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 50%;

    font-size: 34px;
}


.result-status-icon.passed {
    background: rgba(77, 120, 83, .12);

    color: #4d7853;

    box-shadow:
        0 10px 30px rgba(77, 120, 83, .10);
}


.result-status-icon.failed {
    background: rgba(164, 79, 70, .10);

    color: #a44f46;

    box-shadow:
        0 10px 30px rgba(164, 79, 70, .08);
}


/*
|--------------------------------------------------------------------------
| STATUS BADGE
|--------------------------------------------------------------------------
*/

.result-status-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;

    padding: 8px 16px;

    border-radius: 50px;

    font-family: 'Cairo', sans-serif;
    font-size: 13px;
    font-weight: 700;
}


.result-status-badge.passed {
    background: rgba(77, 120, 83, .10);

    color: #4d7853;
}


.result-status-badge.failed {
    background: rgba(164, 79, 70, .10);

    color: #a44f46;
}


/*
|--------------------------------------------------------------------------
| TITLE
|--------------------------------------------------------------------------
*/

.result-title {
    margin: 18px 0 8px;

    color: #3e3a31;

    font-family: 'Amiri', serif;
    font-size: clamp(30px, 5vw, 48px);

    line-height: 1.4;
}


.result-quiz-name {
    margin: 0;

    color: #746d60;

    font-family: 'Cairo', sans-serif;
    font-size: 14px;

    line-height: 1.9;
}


/*
|--------------------------------------------------------------------------
| SCORE CIRCLE
|--------------------------------------------------------------------------
*/

.result-score-wrapper {
    margin: 30px auto 0;

    display: flex;
    justify-content: center;
}


.result-score-circle {
    position: relative;

    width: 175px;
    height: 175px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 50%;

    background:
        conic-gradient(
            #6f8068 var(--percentage),
            #e9e2d3 var(--percentage)
        );

    box-shadow:
        0 15px 35px rgba(70, 58, 35, .10);
}


.result-score-circle::before {
    content: '';

    position: absolute;

    inset: 10px;

    border-radius: 50%;

    background: #fffdf8;
}


.result-score-content {
    position: relative;

    z-index: 2;

    text-align: center;
}


.result-score-percentage {
    display: block;

    color: #514a3e;

    font-family: 'Cairo', sans-serif;
    font-size: 34px;
    font-weight: 800;

    line-height: 1.2;
}


.result-score-label {
    display: block;

    margin-top: 3px;

    color: #8b8375;

    font-family: 'Cairo', sans-serif;
    font-size: 11px;
}


/*
|--------------------------------------------------------------------------
| RESULT META
|--------------------------------------------------------------------------
*/

.result-meta {
    display: grid;

    grid-template-columns:
        repeat(4, minmax(0, 1fr));

    gap: 12px;

    margin-top: 35px;
}


.result-meta-item {
    padding: 16px 12px;

    border-radius: 15px;

    background: rgba(255, 255, 255, .68);

    border: 1px solid rgba(120, 105, 78, .10);

    text-align: center;
}


.result-meta-value {
    display: block;

    color: #514a3e;

    font-family: 'Cairo', sans-serif;
    font-size: 17px;
    font-weight: 700;
}


.result-meta-label {
    display: block;

    margin-top: 4px;

    color: #8b8375;

    font-family: 'Cairo', sans-serif;
    font-size: 11px;
}


/*
|--------------------------------------------------------------------------
| SECTION
|--------------------------------------------------------------------------
*/

.result-section {
    margin-top: 35px;
}


.result-section-header {
    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 20px;

    margin-bottom: 18px;
}


.result-section-title {
    display: flex;
    align-items: center;
    gap: 10px;

    margin: 0;

    color: #413c32;

    font-family: 'Amiri', serif;
    font-size: 30px;
}


.result-section-title i {
    color: #b99552;

    font-size: 21px;
}


/*
|--------------------------------------------------------------------------
| ANSWER CARD
|--------------------------------------------------------------------------
*/

.result-answer-card {
    position: relative;

    margin-bottom: 15px;

    padding: 22px 24px;

    border-radius: 18px;

    background: #fff;

    border: 1px solid rgba(120, 105, 78, .11);

    box-shadow:
        0 7px 25px rgba(70, 58, 35, .04);

    transition: .25s ease;
}


.result-answer-card:hover {
    border-color: rgba(185, 149, 82, .22);

    box-shadow:
        0 10px 30px rgba(70, 58, 35, .06);
}


.result-answer-card.correct {
    border-right: 4px solid #6f8068;
}


.result-answer-card.wrong {
    border-right: 4px solid #a44f46;
}


/*
|--------------------------------------------------------------------------
| ANSWER HEADER
|--------------------------------------------------------------------------
*/

.answer-header {
    display: flex;
    align-items: flex-start;

    gap: 13px;
}


.answer-number {
    flex: 0 0 38px;

    width: 38px;
    height: 38px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 11px;

    background: #f6efdf;

    color: #b99552;

    font-family: 'Cairo', sans-serif;
    font-size: 13px;
    font-weight: 700;
}


.answer-question {
    flex: 1;

    margin: 0;

    color: #403b32;

    font-family: 'Cairo', sans-serif;
    font-size: 15px;
    font-weight: 700;

    line-height: 1.9;
}


.answer-status {
    flex: 0 0 auto;

    display: inline-flex;
    align-items: center;
    gap: 6px;

    padding: 6px 10px;

    border-radius: 50px;

    font-family: 'Cairo', sans-serif;
    font-size: 11px;
    font-weight: 700;
}


.answer-status.correct {
    background: rgba(77, 120, 83, .10);

    color: #4d7853;
}


.answer-status.wrong {
    background: rgba(164, 79, 70, .09);

    color: #a44f46;
}


/*
|--------------------------------------------------------------------------
| ANSWER BODY
|--------------------------------------------------------------------------
*/

.answer-body {
    margin-top: 18px;

    margin-right: 51px;
}


.answer-label {
    display: block;

    margin-bottom: 7px;

    color: #8b8375;

    font-family: 'Cairo', sans-serif;
    font-size: 11px;
    font-weight: 700;
}


.answer-value {
    display: flex;
    align-items: center;

    min-height: 45px;

    padding: 11px 14px;

    border-radius: 12px;

    background: #fbf9f3;

    border: 1px solid rgba(120, 105, 78, .09);

    color: #5d574c;

    font-family: 'Cairo', sans-serif;
    font-size: 13px;

    line-height: 1.8;
}


.answer-value.empty {
    color: #a39b8d;

    font-style: italic;
}


.answer-value.correct-value {
    background: rgba(77, 120, 83, .07);

    border-color: rgba(77, 120, 83, .14);

    color: #53634d;
}


.answer-value.wrong-value {
    background: rgba(164, 79, 70, .06);

    border-color: rgba(164, 79, 70, .12);

    color: #8f4b45;
}


/*
|--------------------------------------------------------------------------
| EXPLANATION
|--------------------------------------------------------------------------
*/

.answer-explanation {
    margin-top: 13px;

    padding: 12px 14px;

    border-radius: 12px;

    background: #fffaf0;

    border: 1px solid rgba(185, 149, 82, .13);

    color: #756b59;

    font-family: 'Cairo', sans-serif;
    font-size: 12px;

    line-height: 1.9;
}


.answer-explanation strong {
    color: #8b6d39;
}


/*
|--------------------------------------------------------------------------
| POINTS
|--------------------------------------------------------------------------
*/

.answer-points {
    display: flex;
    align-items: center;
    justify-content: flex-end;

    margin-top: 12px;

    color: #8b8375;

    font-family: 'Cairo', sans-serif;
    font-size: 11px;
}


.answer-points strong {
    margin-right: 4px;

    color: #514a3e;
}


/*
|--------------------------------------------------------------------------
| ACTIONS
|--------------------------------------------------------------------------
*/

.result-actions {
    display: flex;
    align-items: center;
    justify-content: center;

    flex-wrap: wrap;

    gap: 12px;

    margin-top: 35px;
}


.result-action {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    gap: 8px;

    min-height: 48px;

    padding: 0 22px;

    border-radius: 13px;

    text-decoration: none;

    font-family: 'Cairo', sans-serif;
    font-size: 13px;
    font-weight: 700;

    transition: .25s ease;
}


.result-action.primary {
    background: #6f8068;

    color: #fff;
}


.result-action.primary:hover {
    background: #5e7058;

    transform: translateY(-2px);
}


.result-action.secondary {
    background: #f5efe1;

    color: #806638;

    border: 1px solid rgba(185, 149, 82, .15);
}


.result-action.secondary:hover {
    background: #eee4cd;

    transform: translateY(-2px);
}


/*
|--------------------------------------------------------------------------
| MOBILE
|--------------------------------------------------------------------------
*/

@media (max-width: 800px) {

    .result-meta {
        grid-template-columns:
            repeat(2, minmax(0, 1fr));
    }


    .answer-header {
        flex-wrap: wrap;
    }


    .answer-status {
        margin-right: 51px;
    }

}


@media (max-width: 600px) {

    .student-quiz-result-page {
        padding-top: 30px;
    }


    .student-quiz-result-container {
        width: min(100% - 25px, 1050px);
    }


    .result-hero {
        padding: 35px 18px;
    }


    .result-score-circle {
        width: 150px;
        height: 150px;
    }


    .result-score-percentage {
        font-size: 30px;
    }


    .result-meta {
        grid-template-columns: 1fr 1fr;
    }


    .result-answer-card {
        padding: 19px 16px;
    }


    .answer-body {
        margin-right: 0;
    }


    .answer-status {
        margin-right: 0;

        width: 100%;

        justify-content: center;
    }


    .answer-question {
        font-size: 14px;
    }


    .result-actions {
        flex-direction: column;
    }


    .result-action {
        width: 100%;
    }

}

</style>

@endpush


@section('content')

<div class="student-quiz-result-page">

    <div class="student-quiz-result-container">


        {{-- ==========================================================
            BACK TO STUDENT LESSONS
        =========================================================== --}}

        <a
            href="{{ route('education.student.lessons.index') }}"
            class="result-back">

            <i class="fa-solid fa-arrow-right"></i>

            {{ __('education.student_quiz_result_page.navigation.back_to_lessons') }}

        </a>


        {{-- ==========================================================
            RESULT DATA
        =========================================================== --}}

        @php

            $quiz = $attempt->quiz;

            $percentage = (float) $attempt->percentage;

            $passed = (bool) $attempt->passed;

            $score = (int) $attempt->score;

            $totalPoints = (int) $attempt->total_points;

        @endphp


        {{-- ==========================================================
            RESULT HERO
        =========================================================== --}}

        <section class="result-hero">

            <div class="result-hero-content">


                {{-- ==================================================
                    STATUS ICON
                =================================================== --}}

                <div
                    class="result-status-icon {{ $passed ? 'passed' : 'failed' }}">

                    @if($passed)

                        <i class="fa-solid fa-circle-check"></i>

                    @else

                        <i class="fa-solid fa-circle-xmark"></i>

                    @endif

                </div>


                {{-- ==================================================
                    STATUS
                =================================================== --}}

                <span
                    class="result-status-badge {{ $passed ? 'passed' : 'failed' }}">

                    @if($passed)

                        <i class="fa-solid fa-check"></i>

                        {{ __('education.student_quiz_result_page.status.passed') }}

                    @else

                        <i class="fa-solid fa-xmark"></i>

                        {{ __('education.student_quiz_result_page.status.failed') }}

                    @endif

                </span>


                {{-- ==================================================
                    TITLE
                =================================================== --}}

                <h1 class="result-title">

                    {{ __('education.student_quiz_result_page.hero.title') }}

                </h1>


                <p class="result-quiz-name">

                    {{ $quiz->title }}

                </p>


                {{-- ==================================================
                    SCORE
                =================================================== --}}

                <div class="result-score-wrapper">

                    <div
                        class="result-score-circle"
                        style="--percentage: {{ min(max($percentage, 0), 100) }}%;">

                        <div class="result-score-content">

                            <span class="result-score-percentage">

                                {{ number_format($percentage, 2) }}%

                            </span>

                            <span class="result-score-label">

                                {{ __('education.student_quiz_result_page.hero.score') }}

                            </span>

                        </div>

                    </div>

                </div>


                {{-- ==================================================
                    META
                =================================================== --}}

                <div class="result-meta">


                    <div class="result-meta-item">

                        <span class="result-meta-value">

                            {{ $score }}

                            /

                            {{ $totalPoints }}

                        </span>

                        <span class="result-meta-label">

                            {{ __('education.student_quiz_result_page.meta.points') }}

                        </span>

                    </div>


                    <div class="result-meta-item">

                        <span class="result-meta-value">

                            {{ $quiz->pass_percentage }}%

                        </span>

                        <span class="result-meta-label">

                            {{ __('education.student_quiz_result_page.meta.pass_percentage') }}

                        </span>

                    </div>


                    <div class="result-meta-item">

                        <span class="result-meta-value">

                            {{ $attempt->attempt_number }}

                        </span>

                        <span class="result-meta-label">

                            {{ __('education.student_quiz_result_page.meta.attempt_number') }}

                        </span>

                    </div>


                    <div class="result-meta-item">

                        <span class="result-meta-value">

                            {{ $attempt->completed_at?->format('Y/m/d') ?? '—' }}

                        </span>

                        <span class="result-meta-label">

                            {{ __('education.student_quiz_result_page.meta.completed_at') }}

                        </span>

                    </div>


                </div>


            </div>

        </section>


        {{-- ==========================================================
            ANSWERS
        =========================================================== --}}

        <section class="result-section">


            <div class="result-section-header">

                <h2 class="result-section-title">

                    <i class="fa-solid fa-list-check"></i>

                    {{ __('education.student_quiz_result_page.answers.title') }}

                </h2>

            </div>


            @foreach($attempt->quiz->questions as $index => $question)

                @php

                    $answer = $attempt->answers
                        ->firstWhere(
                            'education_quiz_question_id',
                            $question->id
                        );

                @endphp


                <article
                    class="result-answer-card {{ $answer?->is_correct ? 'correct' : 'wrong' }}">


                    {{-- ==================================================
                        ANSWER HEADER
                    =================================================== --}}

                    <div class="answer-header">


                        <div class="answer-number">

                            {{ $index + 1 }}

                        </div>


                        <h3 class="answer-question">

                            {{ $question->question }}

                        </h3>


                        <span
                            class="answer-status {{ $answer?->is_correct ? 'correct' : 'wrong' }}">

                            @if($answer?->is_correct)

                                <i class="fa-solid fa-check"></i>

                                {{ __('education.student_quiz_result_page.answers.correct') }}

                            @else

                                <i class="fa-solid fa-xmark"></i>

                                {{ __('education.student_quiz_result_page.answers.wrong') }}

                            @endif

                        </span>


                    </div>


                    {{-- ==================================================
                        ANSWER BODY
                    =================================================== --}}

                    <div class="answer-body">


                        {{-- ==================================================
                            STUDENT ANSWER
                        =================================================== --}}

                        <span class="answer-label">

                            {{ __('education.student_quiz_result_page.answers.your_answer') }}

                        </span>


                        @if($answer && $answer->selectedOption)

                            <div
                                class="answer-value {{ $answer->is_correct ? 'correct-value' : 'wrong-value' }}">

                                {{ $answer->selectedOption->option }}

                            </div>

                        @elseif($answer && $answer->answer_text)

                            <div class="answer-value">

                                {{ $answer->answer_text }}

                            </div>

                        @else

                            <div class="answer-value empty">

                                {{ __('education.student_quiz_result_page.answers.not_answered') }}

                            </div>

                        @endif


                        {{-- ==================================================
                            CORRECT ANSWER
                        =================================================== --}}

                        @if(!$answer || !$answer->is_correct)

                            @php

                                $correctOption = $question->options
                                    ->firstWhere('is_correct', true);

                            @endphp


                            @if($correctOption)

                                <span
                                    class="answer-label"
                                    style="margin-top:15px;">

                                    {{ __('education.student_quiz_result_page.answers.correct_answer') }}

                                </span>


                                <div class="answer-value correct-value">

                                    {{ $correctOption->option }}

                                </div>

                            @endif

                        @endif


                        {{-- ==================================================
                            EXPLANATION
                        =================================================== --}}

                        @if($question->explanation)

                            <div class="answer-explanation">

                                <strong>

                                    <i class="fa-solid fa-lightbulb"></i>

                                    {{ __('education.student_quiz_result_page.answers.explanation') }}

                                </strong>

                                {{ $question->explanation }}

                            </div>

                        @endif


                        {{-- ==================================================
                            POINTS
                        =================================================== --}}

                        <div class="answer-points">

                            {{ __('education.student_quiz_result_page.answers.earned_points') }}

                            <strong>

                                {{ $answer?->points_earned ?? 0 }}

                                /

                                {{ $question->points }}

                            </strong>

                        </div>


                    </div>


                </article>

            @endforeach


        </section>


        {{-- ==========================================================
            ACTIONS
        =========================================================== --}}

        <div class="result-actions">


            {{-- ======================================================
                BACK TO STUDENT LESSONS
            ======================================================= --}}

            <a
                href="{{ route('education.student.lessons.index') }}"
                class="result-action primary">

                <i class="fa-solid fa-book-open"></i>

                {{ __('education.student_quiz_result_page.actions.back_to_lessons') }}

            </a>


            {{-- ======================================================
                RETAKE QUIZ
            ======================================================= --}}

            @if(
                is_null($quiz->max_attempts) ||
                $quiz->max_attempts <= 0 ||
                $attempt->attempt_number < $quiz->max_attempts
            )

                <a
                    href="{{ route(
                        'education.student.quizzes.show',
                        ['quiz' => $quiz->id]
                    ) }}"
                    class="result-action secondary">

                    <i class="fa-solid fa-rotate-right"></i>

                    {{ __('education.student_quiz_result_page.actions.back_to_quiz') }}

                </a>

            @endif


        </div>


    </div>

</div>

@endsection
