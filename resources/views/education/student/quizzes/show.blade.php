@extends('education.layouts.app')

@section(
    'title',
    $quiz->title . ' | ' . __('education.student_quiz_page.page_title_suffix')
)

@section('meta_description')
    {{ $quiz->description ?? __('education.student_quiz_page.meta.fallback_description') }}
@endsection


@push('styles')

<style>

/*
|--------------------------------------------------------------------------
| STUDENT QUIZ PAGE
|--------------------------------------------------------------------------
*/

.student-quiz-page {
    padding: 50px 0 80px;
}

.student-quiz-container {
    width: min(1100px, calc(100% - 40px));
    margin: 0 auto;
}


/*
|--------------------------------------------------------------------------
| BACK
|--------------------------------------------------------------------------
*/

.quiz-back {
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

.quiz-back:hover {
    color: #b99552;
    transform: translateX(4px);
}


/*
|--------------------------------------------------------------------------
| HERO
|--------------------------------------------------------------------------
*/

.quiz-hero {
    position: relative;

    overflow: hidden;

    padding: 40px;

    border-radius: 28px;

    background:
        linear-gradient(
            135deg,
            #fffdf8 0%,
            #f8f1df 100%
        );

    border: 1px solid rgba(185, 149, 82, .18);

    box-shadow:
        0 20px 55px rgba(70, 58, 35, .08);
}

.quiz-hero::before {
    content: '';

    position: absolute;

    top: -100px;
    left: -100px;

    width: 250px;
    height: 250px;

    border-radius: 50%;

    background: rgba(185, 149, 82, .08);
}

.quiz-hero-content {
    position: relative;
    z-index: 2;
}

.quiz-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;

    padding: 8px 15px;

    border-radius: 50px;

    background: rgba(111, 128, 104, .10);

    color: #63735d;

    font-family: 'Cairo', sans-serif;
    font-size: 13px;
    font-weight: 700;
}

.quiz-title {
    margin: 18px 0 12px;

    color: #3e3a31;

    font-family: 'Amiri', serif;
    font-size: clamp(32px, 5vw, 52px);

    line-height: 1.35;
}

.quiz-description {
    max-width: 850px;

    margin: 0;

    color: #716b5d;

    font-family: 'Cairo', sans-serif;
    font-size: 15px;

    line-height: 2;
}


/*
|--------------------------------------------------------------------------
| META
|--------------------------------------------------------------------------
*/

.quiz-meta {
    display: grid;

    grid-template-columns:
        repeat(3, minmax(0, 1fr));

    gap: 12px;

    margin-top: 28px;
}

.quiz-meta-item {
    padding: 15px;

    border-radius: 14px;

    background: rgba(255, 255, 255, .65);

    border: 1px solid rgba(120, 105, 78, .10);

    text-align: center;
}

.quiz-meta-value {
    display: block;

    color: #514a3e;

    font-family: 'Cairo', sans-serif;
    font-size: 17px;
    font-weight: 700;
}

.quiz-meta-label {
    display: block;

    margin-top: 3px;

    color: #8b8375;

    font-family: 'Cairo', sans-serif;
    font-size: 11px;
}


/*
|--------------------------------------------------------------------------
| ALERT
|--------------------------------------------------------------------------
*/

.quiz-alert {
    display: flex;
    align-items: center;
    gap: 10px;

    margin-bottom: 20px;

    padding: 15px 18px;

    border-radius: 14px;

    background: rgba(77, 120, 83, .10);

    color: #4d7853;

    font-family: 'Cairo', sans-serif;
    font-size: 14px;
}


/*
|--------------------------------------------------------------------------
| QUESTIONS
|--------------------------------------------------------------------------
*/

.quiz-section {
    margin-top: 35px;
}

.quiz-section-header {
    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 20px;

    margin-bottom: 18px;
}

.quiz-section-title {
    display: flex;
    align-items: center;
    gap: 10px;

    margin: 0;

    color: #413c32;

    font-family: 'Amiri', serif;
    font-size: 31px;
}

.quiz-section-title i {
    color: #b99552;

    font-size: 21px;
}

.quiz-question-count {
    padding: 7px 13px;

    border-radius: 50px;

    background: #f5efe1;

    color: #8b6d39;

    font-family: 'Cairo', sans-serif;
    font-size: 12px;
    font-weight: 700;
}


/*
|--------------------------------------------------------------------------
| QUESTION CARD
|--------------------------------------------------------------------------
*/

.quiz-question-card {
    position: relative;

    margin-bottom: 18px;

    padding: 25px;

    border-radius: 20px;

    background: #fff;

    border: 1px solid rgba(120, 105, 78, .11);

    box-shadow:
        0 8px 28px rgba(70, 58, 35, .045);

    transition: .25s ease;
}

.quiz-question-card:hover {
    border-color: rgba(185, 149, 82, .25);

    box-shadow:
        0 12px 32px rgba(70, 58, 35, .065);
}


/*
|--------------------------------------------------------------------------
| QUESTION HEADER
|--------------------------------------------------------------------------
*/

.question-header {
    display: flex;
    align-items: flex-start;

    gap: 15px;
}

.question-number {
    flex: 0 0 42px;

    width: 42px;
    height: 42px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 13px;

    background: #f6efdf;

    color: #b99552;

    font-family: 'Cairo', sans-serif;
    font-size: 14px;
    font-weight: 700;
}

.question-content {
    flex: 1;
}

.question-text {
    margin: 0;

    color: #403b32;

    font-family: 'Cairo', sans-serif;
    font-size: 16px;
    font-weight: 700;

    line-height: 1.9;
}

.question-points {
    display: inline-flex;

    margin-top: 6px;

    color: #8b8375;

    font-family: 'Cairo', sans-serif;
    font-size: 11px;
}


/*
|--------------------------------------------------------------------------
| OPTIONS
|--------------------------------------------------------------------------
*/

.question-options {
    display: grid;

    gap: 10px;

    margin-top: 20px;

    padding-right: 57px;
}

.quiz-option {
    position: relative;

    display: flex;
    align-items: center;

    cursor: pointer;

    padding: 14px 16px;

    border-radius: 14px;

    background: #fbf9f3;

    border: 1px solid rgba(120, 105, 78, .11);

    transition: .2s ease;
}

.quiz-option:hover {
    border-color: rgba(185, 149, 82, .35);

    background: #fffdf8;
}

.quiz-option input {
    position: absolute;

    opacity: 0;

    pointer-events: none;
}

.quiz-option-radio {
    flex: 0 0 20px;

    width: 20px;
    height: 20px;

    margin-left: 11px;

    border-radius: 50%;

    border: 2px solid #b8b09f;

    transition: .2s ease;
}

.quiz-option-text {
    color: #625c50;

    font-family: 'Cairo', sans-serif;
    font-size: 14px;

    line-height: 1.8;
}

.quiz-option:has(input:checked) {
    background: rgba(111, 128, 104, .08);

    border-color: #6f8068;
}

.quiz-option:has(input:checked) .quiz-option-radio {
    border-color: #6f8068;

    background:
        radial-gradient(
            circle,
            #6f8068 0 45%,
            transparent 48%
        );
}

.quiz-option:has(input:checked) .quiz-option-text {
    color: #53634d;

    font-weight: 700;
}


/*
|--------------------------------------------------------------------------
| SUBMIT
|--------------------------------------------------------------------------
*/

.quiz-submit-area {
    margin-top: 30px;

    padding: 25px;

    border-radius: 20px;

    background:
        linear-gradient(
            135deg,
            #fffdf8,
            #f8f1df
        );

    border: 1px solid rgba(185, 149, 82, .16);

    text-align: center;
}

.quiz-submit-title {
    margin: 0 0 7px;

    color: #514a3e;

    font-family: 'Amiri', serif;
    font-size: 25px;
}

.quiz-submit-text {
    margin: 0 0 20px;

    color: #777064;

    font-family: 'Cairo', sans-serif;
    font-size: 13px;
}

.quiz-submit-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    gap: 9px;

    min-width: 220px;
    min-height: 50px;

    padding: 0 25px;

    border: 0;
    border-radius: 13px;

    background: #6f8068;

    color: #fff;

    cursor: pointer;

    font-family: 'Cairo', sans-serif;
    font-size: 14px;
    font-weight: 700;

    transition: .25s ease;
}

.quiz-submit-button:hover {
    background: #5e7058;

    transform: translateY(-2px);
}

.quiz-submit-button:disabled {
    opacity: .7;

    cursor: not-allowed;

    transform: none;
}


/*
|--------------------------------------------------------------------------
| TIMER
|--------------------------------------------------------------------------
*/

.quiz-timer {
    position: sticky;

    top: 20px;

    z-index: 20;

    display: flex;
    align-items: center;
    justify-content: center;

    gap: 9px;

    width: fit-content;

    margin: 0 auto 25px;

    padding: 11px 18px;

    border-radius: 50px;

    background: #fff;

    border: 1px solid rgba(185, 149, 82, .22);

    box-shadow:
        0 8px 25px rgba(70, 58, 35, .08);

    color: #6f8068;

    font-family: 'Cairo', sans-serif;
    font-size: 13px;
    font-weight: 700;
}

.quiz-timer.warning {
    color: #a44f46;

    border-color: rgba(170, 80, 70, .25);
}


/*
|--------------------------------------------------------------------------
| RESPONSIVE
|--------------------------------------------------------------------------
*/

@media (max-width: 700px) {

    .student-quiz-page {
        padding-top: 30px;
    }

    .student-quiz-container {
        width: min(100% - 25px, 1100px);
    }

    .quiz-hero {
        padding: 28px 20px;
    }

    .quiz-meta {
        grid-template-columns: 1fr;
    }

    .quiz-question-card {
        padding: 20px 17px;
    }

    .question-options {
        padding-right: 0;
    }

    .question-header {
        gap: 10px;
    }

    .question-number {
        flex-basis: 38px;

        width: 38px;
        height: 38px;
    }

    .quiz-submit-area {
        padding: 22px 17px;
    }

    .quiz-submit-button {
        width: 100%;
    }

}

</style>

@endpush


@section('content')

@php

    /*
    |--------------------------------------------------------------------------
    | STUDENT LESSON
    |--------------------------------------------------------------------------
    */

    $studentLesson = null;

    /*
    |--------------------------------------------------------------------------
    | DIRECT STUDENT LESSON
    |--------------------------------------------------------------------------
    */

    if (!empty($quiz->education_student_lesson_id)) {

        $studentLesson = \App\Models\EducationStudentLesson::query()
            ->where('id', $quiz->education_student_lesson_id)
            ->where(
                'education_user_id',
                auth('education')->id()
            )
            ->where('is_active', true)
            ->first();

    }


    /*
    |--------------------------------------------------------------------------
    | SOURCE LESSON
    |--------------------------------------------------------------------------
    */

    if (!$studentLesson) {

        $sourceLessonId =
            $quiz->education_lesson_id
            ?? $quiz->lesson_id
            ?? optional($quiz->lesson)->id;

        if ($sourceLessonId) {

            $studentLesson =
                \App\Models\EducationStudentLesson::query()
                    ->where(
                        'education_user_id',
                        auth('education')->id()
                    )
                    ->where(
                        'source_lesson_id',
                        $sourceLessonId
                    )
                    ->where('is_active', true)
                    ->latest('id')
                    ->first();

        }

    }

@endphp


<div class="student-quiz-page">

    <div class="student-quiz-container">


        {{-- ==========================================================
            BACK
        =========================================================== --}}

        @if($studentLesson)

            <a
                href="{{ route(
                    'education.student.lessons.show',
                    ['studentLesson' => $studentLesson->id]
                ) }}"
                class="quiz-back">

                <i class="fa-solid fa-arrow-right"></i>

                {{ __('education.student_quiz_page.navigation.back_to_lesson') }}

            </a>

        @else

            <a
                href="{{ route('education.student.lessons.index') }}"
                class="quiz-back">

                <i class="fa-solid fa-arrow-right"></i>

                {{ __('education.student_quiz_page.navigation.back_to_lessons') }}

            </a>

        @endif


        {{-- ==========================================================
            SUCCESS
        =========================================================== --}}

        @if(session('success'))

            <div class="quiz-alert">

                <i class="fa-solid fa-circle-check"></i>

                <span>
                    {{ session('success') }}
                </span>

            </div>

        @endif


        {{-- ==========================================================
            TIMER
        =========================================================== --}}

        @if($quiz->time_limit)

            <div
                class="quiz-timer"
                id="quizTimer"
                data-minutes="{{ $quiz->time_limit }}">

                <i class="fa-solid fa-clock"></i>

                <span>
                    {{ __('education.student_quiz_page.timer.remaining') }}
                </span>

                <strong id="quizTimerValue">
                    {{ $quiz->time_limit }}:00
                </strong>

            </div>

        @endif


        {{-- ==========================================================
            HERO
        =========================================================== --}}

        <section class="quiz-hero">

            <div class="quiz-hero-content">

                <span class="quiz-badge">

                    <i class="fa-solid fa-clipboard-question"></i>

                    {{ __('education.student_quiz_page.hero.badge') }}

                </span>


                <h1 class="quiz-title">

                    {{ $quiz->title }}

                </h1>


                @if($quiz->description)

                    <p class="quiz-description">

                        {{ $quiz->description }}

                    </p>

                @endif


                <div class="quiz-meta">


                    <div class="quiz-meta-item">

                        <span class="quiz-meta-value">

                            {{ $quiz->questions->count() }}

                        </span>

                        <span class="quiz-meta-label">

                            {{ __('education.student_quiz_page.meta.questions_count') }}

                        </span>

                    </div>


                    <div class="quiz-meta-item">

                        <span class="quiz-meta-value">

                            {{ $quiz->pass_percentage }}%

                        </span>

                        <span class="quiz-meta-label">

                            {{ __('education.student_quiz_page.meta.pass_percentage') }}

                        </span>

                    </div>


                    <div class="quiz-meta-item">

                        <span class="quiz-meta-value">

                            @if($quiz->time_limit)

                                {{ $quiz->time_limit }}

                                {{ __('education.student_quiz_page.meta.minute') }}

                            @else

                                {{ __('education.student_quiz_page.meta.open') }}

                            @endif

                        </span>

                        <span class="quiz-meta-label">

                            {{ __('education.student_quiz_page.meta.time') }}

                        </span>

                    </div>


                </div>

            </div>

        </section>


        {{-- ==========================================================
            QUIZ FORM
        =========================================================== --}}

        <form
            id="quizForm"
            name="quizForm"
            method="POST"
            action="{{ route('education.student.quizzes.submit', ['quiz' => $quiz->id]) }}"
            accept-charset="UTF-8">

            @csrf


            {{-- ======================================================
                QUESTIONS
            ======================================================= --}}

            <section class="quiz-section">

                <div class="quiz-section-header">

                    <h2 class="quiz-section-title">

                        <i class="fa-solid fa-list-check"></i>

                        {{ __('education.student_quiz_page.questions.title') }}

                    </h2>


                    <span class="quiz-question-count">

                        {{ $quiz->questions->count() }}

                        {{ __('education.student_quiz_page.questions.question') }}

                    </span>

                </div>


                @foreach($quiz->questions as $index => $question)

                    <article class="quiz-question-card">

                        <div class="question-header">

                            <div class="question-number">

                                {{ $index + 1 }}

                            </div>


                            <div class="question-content">

                                <h3 class="question-text">

                                    {{ $question->question }}

                                </h3>


                                <span class="question-points">

                                    {{ $question->points }}

                                    {{ $question->points == 1
                                        ? __('education.student_quiz_page.questions.points')
                                        : __('education.student_quiz_page.questions.points_plural')
                                    }}

                                </span>

                            </div>

                        </div>


                        @if($question->options->count())

                            <div class="question-options">

                                @foreach($question->options as $option)

                                    <label class="quiz-option">

                                        <input
                                            type="radio"
                                            name="answers[{{ $question->id }}]"
                                            value="{{ $option->id }}">

                                        <span class="quiz-option-radio"></span>

                                        <span class="quiz-option-text">

                                            {{ $option->option }}

                                        </span>

                                    </label>

                                @endforeach

                            </div>

                        @else

                            <div style="
                                margin-top:20px;
                                padding:14px;
                                border-radius:12px;
                                background:#fbf7ed;
                                color:#8a8377;
                                font-family:'Cairo',sans-serif;
                                font-size:13px;
                            ">

                                {{ __('education.student_quiz_page.questions.no_options') }}

                            </div>

                        @endif

                    </article>

                @endforeach

            </section>


            {{-- ==========================================================
                SUBMIT
            =========================================================== --}}

            <div class="quiz-submit-area">

                <h3 class="quiz-submit-title">

                    {{ __('education.student_quiz_page.submit.title') }}

                </h3>


                <p class="quiz-submit-text">

                    {{ __('education.student_quiz_page.submit.description') }}

                </p>


                <button
                    type="submit"
                    class="quiz-submit-button"
                    id="quizSubmitButton">

                    <i class="fa-solid fa-paper-plane"></i>

                    {{ __('education.student_quiz_page.submit.button') }}

                </button>

            </div>


        </form>


    </div>

</div>

@endsection


@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {

    const form =
        document.getElementById('quizForm');

    const submitButton =
        document.getElementById('quizSubmitButton');

    const timer =
        document.getElementById('quizTimer');

    const timerValue =
        document.getElementById('quizTimerValue');


    /*
    |--------------------------------------------------------------------------
    | FORM SUBMIT
    |--------------------------------------------------------------------------
    |
    | مهم جدًا:
    |
    | لا نستخدم:
    |
    | form.submit()
    |
    | عند انتهاء الوقت.
    |
    | لأننا نريد أن يمر الإرسال بنفس مسار
    | HTML form الطبيعي.
    |
    |--------------------------------------------------------------------------
    */

    let submitting = false;


    if (form) {

        form.addEventListener('submit', function (event) {

            /*
            |--------------------------------------------------------------------------
            | PREVENT DUPLICATE SUBMIT
            |--------------------------------------------------------------------------
            */

            if (submitting) {

                event.preventDefault();

                return;

            }


            /*
            |--------------------------------------------------------------------------
            | CONFIRM
            |--------------------------------------------------------------------------
            */

            const confirmed = confirm(
                @json(__('education.student_quiz_page.messages.confirm_submit'))
            );


            if (!confirmed) {

                event.preventDefault();

                return;

            }


            /*
            |--------------------------------------------------------------------------
            | LOCK
            |--------------------------------------------------------------------------
            */

            submitting = true;


            if (submitButton) {

                submitButton.disabled = true;

                submitButton.innerHTML = `
                    <i class="fa-solid fa-spinner fa-spin"></i>
                    {{ __('education.student_quiz_page.messages.grading') }}
                `;

            }

        });

    }


    /*
    |--------------------------------------------------------------------------
    | TIMER
    |--------------------------------------------------------------------------
    */

    if (
        timer &&
        timerValue
    ) {

        let minutes =
            parseInt(
                timer.dataset.minutes,
                10
            );


        if (
            isNaN(minutes) ||
            minutes <= 0
        ) {

            return;

        }


        let totalSeconds =
            minutes * 60;


        let timerInterval;


        function updateTimer() {

            const remainingMinutes =
                Math.floor(
                    totalSeconds / 60
                );


            const remainingSeconds =
                totalSeconds % 60;


            timerValue.textContent =
                String(
                    remainingMinutes
                ).padStart(2, '0')
                +
                ':'
                +
                String(
                    remainingSeconds
                ).padStart(2, '0');


            /*
            |--------------------------------------------------------------------------
            | WARNING
            |--------------------------------------------------------------------------
            */

            if (totalSeconds <= 60) {

                timer.classList.add('warning');

            }


            /*
            |--------------------------------------------------------------------------
            | TIME FINISHED
            |--------------------------------------------------------------------------
            */

            if (totalSeconds <= 0) {

                clearInterval(timerInterval);


                /*
                |--------------------------------------------------------------------------
                | SUBMIT USING NATIVE FORM SUBMIT EVENT
                |--------------------------------------------------------------------------
                |
                | بدل:
                |
                | form.submit()
                |
                | نستخدم زر الإرسال نفسه.
                |
                | هذا يجعل المتصفح يرسل:
                |
                | POST
                |
                | إلى action الخاص بالفورم.
                |
                |--------------------------------------------------------------------------
                */

                if (
                    form &&
                    !submitting
                ) {

                    submitting = true;


                    if (submitButton) {

                        submitButton.disabled = true;

                        submitButton.innerHTML = `
                            <i class="fa-solid fa-spinner fa-spin"></i>
                            {{ __('education.student_quiz_page.messages.submitting') }}
                        `;

                    }


                    /*
                    |--------------------------------------------------------------------------
                    | requestSubmit
                    |--------------------------------------------------------------------------
                    */

                    if (
                        typeof form.requestSubmit === 'function'
                    ) {

                        form.requestSubmit(
                            submitButton
                        );

                    } else {

                        /*
                        |--------------------------------------------------------------------------
                        | FALLBACK FOR OLD BROWSERS
                        |--------------------------------------------------------------------------
                        */

                        const hiddenSubmit =
                            document.createElement('button');

                        hiddenSubmit.type =
                            'submit';

                        hiddenSubmit.style.display =
                            'none';

                        form.appendChild(
                            hiddenSubmit
                        );

                        hiddenSubmit.click();

                        hiddenSubmit.remove();

                    }

                }


                return;

            }


            totalSeconds--;

        }


        updateTimer();


        timerInterval =
            setInterval(
                updateTimer,
                1000
            );

    }

});

</script>

@endpush
