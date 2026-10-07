@extends('education.layouts.app')

@section('title', __('education.student_lessons_page.page_title'))

@section('meta_description')
{{ __('education.student_lessons_page.meta_description') }}
@endsection

@push('styles')

<style>

/*
|--------------------------------------------------------------------------
| STUDENT LESSONS PAGE
|--------------------------------------------------------------------------
*/

.student-lessons-page {
    padding: 55px 0 90px;
}

.student-lessons-container {
    width: min(1180px, calc(100% - 40px));
    margin: 0 auto;
}


/*
|--------------------------------------------------------------------------
| HEADER
|--------------------------------------------------------------------------
*/

.student-lessons-header {
    position: relative;
    overflow: hidden;

    margin-bottom: 35px;
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
        0 20px 55px rgba(70, 58, 35, .07);
}

.student-lessons-header::before {
    content: '';

    position: absolute;

    width: 260px;
    height: 260px;

    top: -140px;
    left: -100px;

    border-radius: 50%;

    background: rgba(185, 149, 82, .08);
}

.student-lessons-header::after {
    content: '';

    position: absolute;

    width: 180px;
    height: 180px;

    bottom: -110px;
    right: -70px;

    border-radius: 50%;

    background: rgba(111, 128, 104, .08);
}

.student-lessons-header-content {
    position: relative;
    z-index: 2;
}

.student-lessons-eyebrow {
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

.student-lessons-title {
    margin: 18px 0 10px;

    color: #3e3a31;

    font-family: 'Amiri', serif;

    font-size: clamp(34px, 5vw, 52px);

    line-height: 1.3;
}

.student-lessons-description {
    max-width: 780px;

    margin: 0;

    color: #716b5d;

    font-family: 'Cairo', sans-serif;

    font-size: 15px;

    line-height: 2;
}


/*
|--------------------------------------------------------------------------
| TOP STATS
|--------------------------------------------------------------------------
*/

.student-lessons-stats {
    display: grid;

    grid-template-columns:
        repeat(3, minmax(0, 1fr));

    gap: 14px;

    margin-top: 28px;
}

.student-lessons-stat {
    display: flex;
    align-items: center;

    gap: 13px;

    padding: 15px 17px;

    border-radius: 16px;

    background: rgba(255,255,255,.68);

    border: 1px solid rgba(120,105,78,.10);
}

.student-lessons-stat-icon {
    flex: 0 0 42px;

    width: 42px;
    height: 42px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 13px;

    background: #f5efe1;

    color: #b99552;

    font-size: 16px;
}

.student-lessons-stat-content {
    min-width: 0;
}

.student-lessons-stat-value {
    display: block;

    color: #514a3e;

    font-family: 'Cairo', sans-serif;

    font-size: 18px;

    font-weight: 700;
}

.student-lessons-stat-label {
    display: block;

    margin-top: 2px;

    color: #8b8375;

    font-family: 'Cairo', sans-serif;

    font-size: 11px;
}


/*
|--------------------------------------------------------------------------
| BACK / NAVIGATION
|--------------------------------------------------------------------------
*/

.student-lessons-navigation {
    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 15px;

    margin-bottom: 25px;
}

.student-lessons-back {
    display: inline-flex;
    align-items: center;

    gap: 8px;

    color: #6f8068;

    text-decoration: none;

    font-family: 'Cairo', sans-serif;

    font-size: 14px;
    font-weight: 600;

    transition: .25s ease;
}

.student-lessons-back:hover {
    color: #b99552;

    transform: translateX(4px);
}

.student-lessons-book-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    gap: 8px;

    min-height: 42px;

    padding: 0 17px;

    border-radius: 12px;

    background: #6f8068;

    color: #fff;

    text-decoration: none;

    font-family: 'Cairo', sans-serif;

    font-size: 12px;
    font-weight: 700;

    transition: .25s ease;
}

.student-lessons-book-button:hover {
    background: #5e7058;

    transform: translateY(-2px);
}


/*
|--------------------------------------------------------------------------
| SECTION
|--------------------------------------------------------------------------
*/

.student-lessons-section {
    margin-top: 35px;
}

.student-lessons-section-header {
    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 20px;

    margin-bottom: 18px;
}

.student-lessons-section-title {
    display: flex;
    align-items: center;

    gap: 10px;

    margin: 0;

    color: #413c32;

    font-family: 'Amiri', serif;

    font-size: 31px;
}

.student-lessons-section-title i {
    color: #b99552;

    font-size: 21px;
}

.student-lessons-section-count {
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
| LESSON GRID
|--------------------------------------------------------------------------
*/

.student-lessons-grid {
    display: grid;

    grid-template-columns:
        repeat(2, minmax(0, 1fr));

    gap: 18px;
}


/*
|--------------------------------------------------------------------------
| LESSON CARD
|--------------------------------------------------------------------------
*/

.student-lesson-card {
    position: relative;

    overflow: hidden;

    padding: 25px;

    border-radius: 22px;

    background: #fff;

    border: 1px solid rgba(120,105,78,.11);

    box-shadow:
        0 8px 28px rgba(70,58,35,.045);

    transition: .28s ease;
}

.student-lesson-card:hover {
    transform: translateY(-4px);

    border-color: rgba(185,149,82,.25);

    box-shadow:
        0 15px 38px rgba(70,58,35,.075);
}

.student-lesson-card::before {
    content: '';

    position: absolute;

    width: 110px;
    height: 110px;

    top: -55px;
    left: -35px;

    border-radius: 50%;

    background: rgba(185,149,82,.055);
}

.student-lesson-card-top {
    position: relative;

    display: flex;
    align-items: flex-start;
    justify-content: space-between;

    gap: 15px;
}

.student-lesson-category-icon {
    flex: 0 0 50px;

    width: 50px;
    height: 50px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 15px;

    background: #f6efdf;

    color: #b99552;

    font-size: 19px;
}

.student-lesson-status {
    display: inline-flex;
    align-items: center;

    gap: 6px;

    padding: 7px 11px;

    border-radius: 50px;

    background: rgba(77,120,83,.10);

    color: #4d7853;

    font-family: 'Cairo', sans-serif;

    font-size: 11px;

    font-weight: 700;
}

.student-lesson-status.upcoming {
    background: rgba(185,149,82,.10);

    color: #8b6d39;
}

.student-lesson-content {
    margin-top: 18px;
}

.student-lesson-category {
    display: block;

    margin-bottom: 5px;

    color: #8b8375;

    font-family: 'Cairo', sans-serif;

    font-size: 11px;
}

.student-lesson-title {
    margin: 0;

    color: #403b32;

    font-family: 'Amiri', serif;

    font-size: 25px;

    line-height: 1.45;
}

.student-lesson-description {
    display: -webkit-box;

    overflow: hidden;

    margin: 9px 0 0;

    color: #777064;

    font-family: 'Cairo', sans-serif;

    font-size: 13px;

    line-height: 1.9;

    -webkit-line-clamp: 2;

    -webkit-box-orient: vertical;
}


/*
|--------------------------------------------------------------------------
| BOOKING INFORMATION
|--------------------------------------------------------------------------
*/

.student-lesson-booking {
    display: grid;

    grid-template-columns:
        repeat(2, minmax(0, 1fr));

    gap: 10px;

    margin-top: 20px;
}

.student-lesson-booking-item {
    padding: 11px 12px;

    border-radius: 13px;

    background: #fbf9f3;

    border: 1px solid rgba(120,105,78,.08);
}

.student-lesson-booking-label {
    display: block;

    color: #9a9284;

    font-family: 'Cairo', sans-serif;

    font-size: 10px;
}

.student-lesson-booking-value {
    display: flex;
    align-items: center;

    gap: 6px;

    margin-top: 4px;

    color: #625c50;

    font-family: 'Cairo', sans-serif;

    font-size: 12px;

    font-weight: 700;
}

.student-lesson-booking-value i {
    color: #b99552;
}


/*
|--------------------------------------------------------------------------
| QUIZ SUMMARY
|--------------------------------------------------------------------------
*/

.student-lesson-quiz {
    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 15px;

    margin-top: 18px;

    padding: 13px 15px;

    border-radius: 15px;

    background:
        linear-gradient(
            135deg,
            #fffdf8,
            #f8f1df
        );

    border: 1px solid rgba(185,149,82,.14);
}

.student-lesson-quiz-info {
    display: flex;
    align-items: center;

    gap: 10px;

    min-width: 0;
}

.student-lesson-quiz-icon {
    flex: 0 0 35px;

    width: 35px;
    height: 35px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 10px;

    background: #f5efe1;

    color: #b99552;
}

.student-lesson-quiz-text {
    min-width: 0;
}

.student-lesson-quiz-text span {
    display: block;

    color: #9a9284;

    font-family: 'Cairo', sans-serif;

    font-size: 10px;
}

.student-lesson-quiz-text strong {
    display: block;

    margin-top: 2px;

    color: #514a3e;

    font-family: 'Cairo', sans-serif;

    font-size: 12px;
}

.student-lesson-quiz-link {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    flex: 0 0 auto;

    min-height: 35px;

    padding: 0 12px;

    border-radius: 10px;

    background: #6f8068;

    color: #fff;

    text-decoration: none;

    font-family: 'Cairo', sans-serif;

    font-size: 11px;

    font-weight: 700;

    transition: .25s ease;
}

.student-lesson-quiz-link:hover {
    background: #5e7058;
}


/*
|--------------------------------------------------------------------------
| CARD FOOTER
|--------------------------------------------------------------------------
*/

.student-lesson-card-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 15px;

    margin-top: 20px;

    padding-top: 17px;

    border-top: 1px solid rgba(120,105,78,.09);
}

.student-lesson-details {
    display: inline-flex;
    align-items: center;

    gap: 7px;

    color: #6f8068;

    text-decoration: none;

    font-family: 'Cairo', sans-serif;

    font-size: 12px;

    font-weight: 700;

    transition: .25s ease;
}

.student-lesson-details:hover {
    color: #b99552;
}

.student-lesson-details i {
    font-size: 11px;
}

.student-lesson-meta {
    color: #9a9284;

    font-family: 'Cairo', sans-serif;

    font-size: 10px;
}


/*
|--------------------------------------------------------------------------
| EMPTY STATE
|--------------------------------------------------------------------------
*/

.student-lessons-empty {
    padding: 55px 25px;

    border-radius: 22px;

    background: #fff;

    border: 1px dashed rgba(120,105,78,.18);

    text-align: center;
}

.student-lessons-empty-icon {
    width: 65px;
    height: 65px;

    display: flex;
    align-items: center;
    justify-content: center;

    margin: 0 auto 15px;

    border-radius: 20px;

    background: #f6efdf;

    color: #b99552;

    font-size: 24px;
}

.student-lessons-empty h3 {
    margin: 0;

    color: #514a3e;

    font-family: 'Amiri', serif;

    font-size: 27px;
}

.student-lessons-empty p {
    max-width: 500px;

    margin: 8px auto 20px;

    color: #81796b;

    font-family: 'Cairo', sans-serif;

    font-size: 13px;

    line-height: 1.9;
}

.student-lessons-empty-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    gap: 8px;

    min-height: 45px;

    padding: 0 20px;

    border-radius: 12px;

    background: #6f8068;

    color: #fff;

    text-decoration: none;

    font-family: 'Cairo', sans-serif;

    font-size: 12px;

    font-weight: 700;
}


/*
|--------------------------------------------------------------------------
| RESPONSIVE
|--------------------------------------------------------------------------
*/

@media (max-width: 850px) {

    .student-lessons-grid {
        grid-template-columns: 1fr;
    }

}

@media (max-width: 650px) {

    .student-lessons-page {
        padding-top: 30px;
    }

    .student-lessons-container {
        width: min(100% - 25px, 1180px);
    }

    .student-lessons-header {
        padding: 28px 20px;
    }

    .student-lessons-stats {
        grid-template-columns: 1fr;
    }

    .student-lessons-navigation {
        align-items: flex-start;
        flex-direction: column;
    }

    .student-lessons-book-button {
        width: 100%;
    }

    .student-lessons-section-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .student-lesson-card {
        padding: 20px 17px;
    }

    .student-lesson-booking {
        grid-template-columns: 1fr;
    }

    .student-lesson-quiz {
        align-items: flex-start;
        flex-direction: column;
    }

    .student-lesson-quiz-link {
        width: 100%;
    }

    .student-lesson-card-footer {
        align-items: flex-start;
        flex-direction: column;
    }

}

</style>

@endpush

@section('content')

<div class="student-lessons-page">

    <div class="student-lessons-container">

        {{-- ==========================================================
            NAVIGATION
        =========================================================== --}}

        <div class="student-lessons-navigation">

            <a
                href="{{ route('education.dashboard') }}"
                class="student-lessons-back"
            >

                <i class="fa-solid fa-arrow-right"></i>

                {{ __('education.student_lessons_page.navigation.back_to_dashboard') }}

            </a>


            <a
                href="{{ route('education.booking.create') }}"
                class="student-lessons-book-button"
            >

                <i class="fa-regular fa-calendar-plus"></i>

                {{ __('education.student_lessons_page.navigation.new_booking') }}

            </a>

        </div>


        {{-- ==========================================================
            PAGE HEADER
        =========================================================== --}}

        <header class="student-lessons-header">

            <div class="student-lessons-header-content">

                <span class="student-lessons-eyebrow">

                    <i class="fa-solid fa-book-open"></i>

                    {{ __('education.student_lessons_page.header.eyebrow') }}

                </span>


                <h1 class="student-lessons-title">

                    {{ __('education.student_lessons_page.header.title') }}

                </h1>


                <p class="student-lessons-description">

                    {{ __('education.student_lessons_page.header.description') }}

                </p>


                <div class="student-lessons-stats">


                    {{-- TOTAL --}}

                    <div class="student-lessons-stat">

                        <div class="student-lessons-stat-icon">

                            <i class="fa-solid fa-book-open"></i>

                        </div>

                        <div class="student-lessons-stat-content">

                            <span class="student-lessons-stat-value">

                                {{ $lessons->count() }}

                            </span>

                            <span class="student-lessons-stat-label">

                                {{ __('education.student_lessons_page.statistics.total') }}

                            </span>

                        </div>

                    </div>


                    {{-- COMPLETED --}}

                    <div class="student-lessons-stat">

                        <div class="student-lessons-stat-icon">

                            <i class="fa-solid fa-circle-check"></i>

                        </div>

                        <div class="student-lessons-stat-content">

                            <span class="student-lessons-stat-value">

                                {{ $completedLessonsCount ?? 0 }}

                            </span>

                            <span class="student-lessons-stat-label">

                                {{ __('education.student_lessons_page.statistics.completed') }}

                            </span>

                        </div>

                    </div>


                    {{-- QUIZZES --}}

                    <div class="student-lessons-stat">

                        <div class="student-lessons-stat-icon">

                            <i class="fa-solid fa-clipboard-question"></i>

                        </div>

                        <div class="student-lessons-stat-content">

                            <span class="student-lessons-stat-value">

                                {{ $quizzesCount ?? 0 }}

                            </span>

                            <span class="student-lessons-stat-label">

                                {{ __('education.student_lessons_page.statistics.quizzes') }}

                            </span>

                        </div>

                    </div>


                </div>

            </div>

        </header>


        {{-- ==========================================================
            LESSONS
        =========================================================== --}}

        <section class="student-lessons-section">


            <div class="student-lessons-section-header">

                <h2 class="student-lessons-section-title">

                    <i class="fa-solid fa-graduation-cap"></i>

                    {{ __('education.student_lessons_page.section.title') }}

                </h2>


                <span class="student-lessons-section-count">

                    {{ $lessons->count() }}

                    {{ __('education.student_lessons_page.section.lesson_count') }}

                </span>

            </div>


            @if($lessons->count())


                <div class="student-lessons-grid">


                    @foreach($lessons as $lesson)

                        @php

                            /*
                            |--------------------------------------------------------------------------
                            | STUDENT LESSON
                            |--------------------------------------------------------------------------
                            |
                            | $lesson هنا هو EducationStudentLesson
                            | وليس EducationLesson.
                            |
                            | الدرس الأصلي موجود في:
                            |
                            | $lesson->sourceLesson
                            |
                            */

                            $sourceLesson =
                                $lesson->sourceLesson
                                ?? null;


                            /*
                            |--------------------------------------------------------------------------
                            | CATEGORY
                            |--------------------------------------------------------------------------
                            */

                            $category =
                                $sourceLesson?->category
                                ?? $lesson->category
                                ?? null;


                            /*
                            |--------------------------------------------------------------------------
                            | CATEGORY ICON
                            |--------------------------------------------------------------------------
                            */

                            if ($category === 'quran') {

                                $lessonIcon = 'fa-book-quran';

                            } elseif ($category === 'tajweed') {

                                $lessonIcon = 'fa-microphone-lines';

                            } elseif ($category === 'arabic') {

                                $lessonIcon = 'fa-language';

                            } else {

                                $lessonIcon = 'fa-book-open';

                            }


                            /*
                            |--------------------------------------------------------------------------
                            | QUIZZES
                            |--------------------------------------------------------------------------
                            |
                            | الاختبارات مرتبطة بالدرس الأصلي.
                            |
                            */

                            $lessonQuizzes =
                                $sourceLesson?->quizzes
                                ?? collect();


                            $firstQuiz =
                                $lessonQuizzes->first();


                            /*
                            |--------------------------------------------------------------------------
                            | BOOKING
                            |--------------------------------------------------------------------------
                            |
                            | نسخة الطالب قد تكون مرتبطة بالحجز من خلال:
                            |
                            | $lesson->booking
                            |
                            | أو:
                            |
                            | $lesson->educationBooking
                            |
                            */

                            $booking =
                                $lesson->booking
                                ?? $lesson->educationBooking
                                ?? null;


                            /*
                            |--------------------------------------------------------------------------
                            | COMPLETION
                            |--------------------------------------------------------------------------
                            */

                            $isCompleted =
                                $lesson->is_completed
                                ?? false;


                            /*
                            |--------------------------------------------------------------------------
                            | TITLE
                            |--------------------------------------------------------------------------
                            |
                            | نستخدم عنوان نسخة الطالب أولًا،
                            | ثم عنوان الدرس الأصلي.
                            |
                            */

                            $lessonTitle =
                                $lesson->title
                                ?? $sourceLesson?->title
                                ?? __('education.student_lessons_page.fallback.lesson');


                            /*
                            |--------------------------------------------------------------------------
                            | DESCRIPTION
                            |--------------------------------------------------------------------------
                            */

                            $lessonDescription =
                                $lesson->description
                                ?? $sourceLesson?->description
                                ?? null;

                        @endphp


                        <article class="student-lesson-card">


                            {{-- ==================================================
                                TOP
                            =================================================== --}}

                            <div class="student-lesson-card-top">


                                <div class="student-lesson-category-icon">

                                    <i class="fa-solid {{ $lessonIcon }}"></i>

                                </div>


                                @if($isCompleted)

                                    <span class="student-lesson-status">

                                        <i class="fa-solid fa-circle-check"></i>

                                        {{ __('education.student_lessons_page.status.completed') }}

                                    </span>

                                @else

                                    <span class="student-lesson-status upcoming">

                                        <i class="fa-regular fa-clock"></i>

                                        {{ __('education.student_lessons_page.status.in_progress') }}

                                    </span>

                                @endif


                            </div>


                            {{-- ==================================================
                                CONTENT
                            =================================================== --}}

                            <div class="student-lesson-content">


                                @if($category)

                                    <span class="student-lesson-category">

                                        @if($category === 'quran')

                                            {{ __('education.student_lessons_page.categories.quran') }}

                                        @elseif($category === 'tajweed')

                                            {{ __('education.student_lessons_page.categories.tajweed') }}

                                        @elseif($category === 'arabic')

                                            {{ __('education.student_lessons_page.categories.arabic') }}

                                        @else

                                            {{ $category }}

                                        @endif

                                    </span>

                                @endif


                                <h3 class="student-lesson-title">

                                    {{ $lessonTitle }}

                                </h3>


                                @if($lessonDescription)

                                    <p class="student-lesson-description">

                                        {{ $lessonDescription }}

                                    </p>

                                @endif


                            </div>


                            {{-- ==================================================
                                BOOKING INFORMATION
                            =================================================== --}}

                            @if($booking)

                                <div class="student-lesson-booking">


                                    <div class="student-lesson-booking-item">

                                        <span class="student-lesson-booking-label">

                                            {{ __('education.student_lessons_page.booking.date') }}

                                        </span>

                                        <div class="student-lesson-booking-value">

                                            <i class="fa-regular fa-calendar"></i>

                                            <span>

                                                @if($booking->booking_date)

                                                    {{ \Carbon\Carbon::parse($booking->booking_date)->locale(app()->getLocale())->translatedFormat('d F Y') }}

                                                @else

                                                    {{ __('education.student_lessons_page.fallback.not_specified') }}

                                                @endif

                                            </span>

                                        </div>

                                    </div>


                                    <div class="student-lesson-booking-item">

                                        <span class="student-lesson-booking-label">

                                            {{ __('education.student_lessons_page.booking.time') }}

                                        </span>

                                        <div class="student-lesson-booking-value">

                                            <i class="fa-regular fa-clock"></i>

                                            <span>

                                                @if($booking->start_time)

                                                    {{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }}

                                                @else

                                                    {{ __('education.student_lessons_page.fallback.not_specified') }}

                                                @endif

                                            </span>

                                        </div>

                                    </div>


                                </div>

                            @endif


                            {{-- ==================================================
                                QUIZ
                            =================================================== --}}

                            @if($firstQuiz)

                                <div class="student-lesson-quiz">


                                    <div class="student-lesson-quiz-info">

                                        <div class="student-lesson-quiz-icon">

                                            <i class="fa-solid fa-clipboard-question"></i>

                                        </div>


                                        <div class="student-lesson-quiz-text">

                                            <span>

                                                {{ __('education.student_lessons_page.quiz.label') }}

                                            </span>

                                            <strong>

                                                {{ $firstQuiz->title }}

                                            </strong>

                                        </div>

                                    </div>


                                    <a
                                        href="{{ route(
                                            'education.student.quizzes.show',
                                            $firstQuiz
                                        ) }}"
                                        class="student-lesson-quiz-link"
                                    >

                                        {{ __('education.student_lessons_page.quiz.open') }}

                                        <i class="fa-solid fa-arrow-left"></i>

                                    </a>


                                </div>

                            @endif


                            {{-- ==================================================
                                FOOTER
                            =================================================== --}}

                            <div class="student-lesson-card-footer">


                                @if($booking)

                                    <span class="student-lesson-meta">

                                        {{ __('education.student_lessons_page.booking.number') }}

                                        #{{ $booking->id }}

                                    </span>

                                @else

                                    <span class="student-lesson-meta">

                                        {{ __('education.student_lessons_page.fallback.lesson') }}

                                    </span>

                                @endif


                                <a
                                    href="{{ route(
                                        'education.student.lessons.show',
                                        $lesson
                                    ) }}"
                                    class="student-lesson-details"
                                >

                                    {{ __('education.student_lessons_page.actions.view_lesson') }}

                                    <i class="fa-solid fa-arrow-left"></i>

                                </a>


                            </div>


                        </article>


                    @endforeach


                </div>


            @else


                {{-- ======================================================
                    EMPTY
                ======================================================= --}}

                <div class="student-lessons-empty">


                    <div class="student-lessons-empty-icon">

                        <i class="fa-solid fa-book-open"></i>

                    </div>


                    <h3>

                        {{ __('education.student_lessons_page.empty.title') }}

                    </h3>


                    <p>

                        {{ __('education.student_lessons_page.empty.description') }}

                    </p>


                    <a
                        href="{{ route('education.booking.create') }}"
                        class="student-lessons-empty-button"
                    >

                        <i class="fa-regular fa-calendar-plus"></i>

                        {{ __('education.student_lessons_page.empty.book_first_lesson') }}

                    </a>


                </div>


            @endif


        </section>


    </div>

</div>

@endsection
