@extends('education.admin.layouts.app')

@section('title', __('education_admin.lesson_assignments.show.page_title'))

@section('content')

<div class="education-assignment-show-page" dir="rtl">

{{-- =========================================================
    HEADER
========================================================== --}}
<div class="education-assignment-show-header">

    <div>

        <div class="education-assignment-show-breadcrumb">

            <a href="{{ route('education.admin.lesson-assignments.index') }}">
                {{ __('education_admin.lesson_assignments.show.breadcrumb_assignments') }}
            </a>

            <i class="fa-solid fa-chevron-left"></i>

            <span>
                {{ __('education_admin.lesson_assignments.show.assignment_details') }}
                #{{ $assignment->id }}
            </span>

        </div>

        <h1>
            {{ $assignment->studentLesson?->title ?? __('education_admin.lesson_assignments.show.lesson') }}
        </h1>

        <p>
            {{ __('education_admin.lesson_assignments.show.description') }}
        </p>

    </div>


    <a
        href="{{ route('education.admin.lesson-assignments.index') }}"
        class="education-assignment-back-btn"
    >
        <i class="fa-solid fa-arrow-right"></i>
        {{ __('education_admin.lesson_assignments.show.back') }}
    </a>

</div>


{{-- =========================================================
    ASSIGNMENT STATUS
========================================================== --}}
<div class="education-assignment-status-banner">

    <div class="education-assignment-status-banner-icon">

        @if($assignment->status === 'completed')

            <i class="fa-solid fa-circle-check"></i>

        @elseif($assignment->status === 'in_progress')

            <i class="fa-solid fa-book-open-reader"></i>

        @else

            <i class="fa-solid fa-clock"></i>

        @endif

    </div>


    <div>

        <span>
            {{ __('education_admin.lesson_assignments.show.status.label') }}
        </span>

        <strong>

            @if($assignment->status === 'assigned')
                {{ __('education_admin.lesson_assignments.show.status.assigned') }}
            @elseif($assignment->status === 'in_progress')
                {{ __('education_admin.lesson_assignments.show.status.in_progress') }}
            @elseif($assignment->status === 'completed')
                {{ __('education_admin.lesson_assignments.show.status.completed') }}
            @elseif($assignment->status === 'cancelled')
                {{ __('education_admin.lesson_assignments.show.status.cancelled') }}
            @else
                {{ $assignment->status }}
            @endif

        </strong>

    </div>

</div>


{{-- =========================================================
    GRID
========================================================== --}}
<div class="education-assignment-show-grid">


    {{-- =====================================================
        MAIN
    ====================================================== --}}
    <div class="education-assignment-show-main">


        {{-- =================================================
            STUDENT
        ================================================== --}}
        <div class="education-assignment-detail-card">

            <div class="education-assignment-detail-card-header">

                <div class="education-assignment-detail-icon">

                    <i class="fa-solid fa-user-graduate"></i>

                </div>

                <div>

                    <h2>
                        {{ __('education_admin.lesson_assignments.show.student.title') }}
                    </h2>

                    <p>
                        {{ __('education_admin.lesson_assignments.show.student.description') }}
                    </p>

                </div>

            </div>


            <div class="education-assignment-student-profile">

                <div class="education-assignment-student-avatar">

                    <i class="fa-solid fa-user"></i>

                </div>


                <div>

                    <h3>
                        {{ $assignment->student?->name ?? __('education_admin.lesson_assignments.show.student.unknown') }}
                    </h3>

                    @if($assignment->student?->email)

                        <span>
                            {{ $assignment->student->email }}
                        </span>

                    @endif

                </div>

            </div>

        </div>



        {{-- =================================================
            STUDENT LESSON
        ================================================== --}}
        @if($assignment->studentLesson)

            <div class="education-assignment-detail-card">

                <div class="education-assignment-detail-card-header">

                    <div class="education-assignment-detail-icon gold">

                        <i class="fa-solid fa-user-pen"></i>

                    </div>

                    <div>

                        <h2>
                            {{ __('education_admin.lesson_assignments.show.student_lesson.title') }}
                        </h2>

                        <p>
                            {{ __('education_admin.lesson_assignments.show.student_lesson.description') }}
                        </p>

                    </div>

                </div>


                <div class="education-student-lesson-box">

                    <div class="education-student-lesson-top">

                        <div>

                            <span class="education-student-lesson-label">
                                {{ __('education_admin.lesson_assignments.show.student_lesson.lesson_title') }}
                            </span>

                            <h3>
                                {{ $assignment->studentLesson->title ?? __('education_admin.lesson_assignments.show.lesson') }}
                            </h3>

                        </div>


                        @if($assignment->studentLesson->session_number)

                            <div class="education-session-number">

                                <span>
                                    {{ __('education_admin.lesson_assignments.show.student_lesson.lesson') }}
                                </span>

                                <strong>
                                    #{{ $assignment->studentLesson->session_number }}
                                </strong>

                            </div>

                        @endif

                    </div>


                    @if($assignment->studentLesson->description)

                        <div class="education-student-lesson-description">

                            {{ $assignment->studentLesson->description }}

                        </div>

                    @endif


                    <div class="education-student-lesson-meta">

                        <div>

                            <span>
                                {{ __('education_admin.lesson_assignments.show.student_lesson.status') }}
                            </span>

                            <strong>

                                @if($assignment->studentLesson->status === 'assigned')
                                    {{ __('education_admin.lesson_assignments.show.student_lesson.assigned') }}
                                @elseif($assignment->studentLesson->status === 'in_progress')
                                    {{ __('education_admin.lesson_assignments.show.student_lesson.in_progress') }}
                                @elseif($assignment->studentLesson->status === 'completed')
                                    {{ __('education_admin.lesson_assignments.show.student_lesson.completed') }}
                                @elseif($assignment->studentLesson->status === 'cancelled')
                                    {{ __('education_admin.lesson_assignments.show.student_lesson.cancelled') }}
                                @else
                                    {{ $assignment->studentLesson->status }}
                                @endif

                            </strong>

                        </div>


                        <div>

                            <span>
                                {{ __('education_admin.lesson_assignments.show.student_lesson.content_count') }}
                            </span>

                            <strong>
                                {{ $assignment->studentLesson->contents->count() }}
                            </strong>

                        </div>


                        <div>

                            <span>
                                {{ __('education_admin.lesson_assignments.show.student_lesson.evaluation') }}
                            </span>

                            <strong>
                                {{ $assignment->studentLesson->evaluation
                                    ? __('education_admin.lesson_assignments.show.student_lesson.evaluated')
                                    : __('education_admin.lesson_assignments.show.student_lesson.not_evaluated') }}
                            </strong>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =================================================
                STUDENT CONTENTS
            ================================================== --}}
            <div
                id="student-lesson-content"
                class="education-assignment-detail-card education-anchor-target"
            >

                <div class="education-assignment-detail-card-header">

                    <div class="education-assignment-detail-icon green">

                        <i class="fa-solid fa-folder-open"></i>

                    </div>

                    <div>

                        <h2>
                            {{ __('education_admin.lesson_assignments.show.content.title') }}
                        </h2>

                        <p>
                            {{ __('education_admin.lesson_assignments.show.content.description') }}
                        </p>

                    </div>

                </div>


                @if($assignment->studentLesson->contents->count())

                    <div class="education-student-contents">

                        @foreach($assignment->studentLesson->contents as $content)

                            <div class="education-student-content-item">

                                <div class="education-student-content-icon">

                                    @if($content->isText())

                                        <i class="fa-solid fa-align-right"></i>

                                    @elseif($content->isImage())

                                        <i class="fa-solid fa-image"></i>

                                    @elseif($content->isLink())

                                        <i class="fa-solid fa-link"></i>

                                    @elseif($content->isFile())

                                        <i class="fa-solid fa-file"></i>

                                    @else

                                        <i class="fa-solid fa-file-lines"></i>

                                    @endif

                                </div>


                                <div class="education-student-content-body">

                                    <div class="education-student-content-top">

                                        <div>

                                            <h3>
                                                {{ $content->title ?? __('education_admin.lesson_assignments.show.content.untitled') }}
                                            </h3>

                                            @if($content->type)

                                                <span>
                                                    {{ strtoupper($content->type) }}
                                                </span>

                                            @endif

                                        </div>

                                    </div>


                                    @if($content->description)

                                        <p class="education-student-content-description">
                                            {{ $content->description }}
                                        </p>

                                    @endif


                                    @if($content->isText() && $content->content)

                                        <div class="education-student-content-text">
                                            {!! nl2br(e($content->content)) !!}
                                        </div>

                                    @endif


                                    @if($content->isLink() && $content->url)

                                        <a
                                            href="{{ $content->url }}"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="education-student-content-link"
                                        >
                                            <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                            {{ __('education_admin.lesson_assignments.show.content.open_link') }}
                                        </a>

                                    @endif


                                    @if(($content->isFile() || $content->isImage()) && $content->file_path)

                                        <a
                                            href="{{ $content->file_url }}"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="education-student-content-link"
                                        >
                                            <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                            {{ __('education_admin.lesson_assignments.show.content.open_file') }}
                                        </a>

                                    @endif

                                </div>

                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="education-empty-state">

                        <i class="fa-regular fa-folder-open"></i>

                        <strong>
                            {{ __('education_admin.lesson_assignments.show.content.empty_title') }}
                        </strong>

                        <span>
                            {{ __('education_admin.lesson_assignments.show.content.empty_description') }}
                        </span>

                    </div>

                @endif

            </div>


            {{-- =================================================
                EVALUATION
            ================================================== --}}
            <div
                id="student-lesson-evaluation"
                class="education-assignment-detail-card education-anchor-target"
            >

                <div class="education-assignment-detail-card-header">

                    <div class="education-assignment-detail-icon gold">

                        <i class="fa-solid fa-star"></i>

                    </div>

                    <div>

                        <h2>
                            {{ __('education_admin.lesson_assignments.show.evaluation.title') }}
                        </h2>

                        <p>
                            {{ __('education_admin.lesson_assignments.show.evaluation.description') }}
                        </p>

                    </div>

                </div>


                @if($assignment->studentLesson->evaluation)

                    @php
                        $evaluation = $assignment->studentLesson->evaluation;
                    @endphp


                    <div class="education-evaluation-grid">

                        @if($evaluation->attendance_status)

                            <div class="education-evaluation-item">

                                <span>
                                    {{ __('education_admin.lesson_assignments.show.evaluation.attendance') }}
                                </span>

                                <strong>
                                    {{ $evaluation->attendance_status }}
                                </strong>

                            </div>

                        @endif


                        @if($evaluation->understanding_score !== null)

                            <div class="education-evaluation-item">

                                <span>
                                    {{ __('education_admin.lesson_assignments.show.evaluation.understanding') }}
                                </span>

                                <strong>
                                    {{ $evaluation->understanding_score }}
                                </strong>

                            </div>

                        @endif


                        @if($evaluation->performance_score !== null)

                            <div class="education-evaluation-item">

                                <span>
                                    {{ __('education_admin.lesson_assignments.show.evaluation.performance') }}
                                </span>

                                <strong>
                                    {{ $evaluation->performance_score }}
                                </strong>

                            </div>

                        @endif


                        @if($evaluation->memorization_score !== null)

                            <div class="education-evaluation-item">

                                <span>
                                    {{ __('education_admin.lesson_assignments.show.evaluation.memorization') }}
                                </span>

                                <strong>
                                    {{ $evaluation->memorization_score }}
                                </strong>

                            </div>

                        @endif


                        @if($evaluation->tajweed_score !== null)

                            <div class="education-evaluation-item">

                                <span>
                                    {{ __('education_admin.lesson_assignments.show.evaluation.tajweed') }}
                                </span>

                                <strong>
                                    {{ $evaluation->tajweed_score }}
                                </strong>

                            </div>

                        @endif


                        @if($evaluation->score !== null)

                            <div class="education-evaluation-item primary">

                                <span>
                                    {{ __('education_admin.lesson_assignments.show.evaluation.score') }}
                                </span>

                                <strong>
                                    {{ $evaluation->score }}

                                    @if($evaluation->max_score !== null)

                                        /
                                        {{ $evaluation->max_score }}

                                    @endif

                                </strong>

                            </div>

                        @endif

                    </div>


                    @if($evaluation->teacher_notes)

                        <div class="education-evaluation-notes">

                            <span>
                                {{ __('education_admin.lesson_assignments.show.evaluation.teacher_notes') }}
                            </span>

                            <p>
                                {{ $evaluation->teacher_notes }}
                            </p>

                        </div>

                    @endif


                    @if($evaluation->student_feedback)

                        <div class="education-evaluation-notes">

                            <span>
                                {{ __('education_admin.lesson_assignments.show.evaluation.student_feedback') }}
                            </span>

                            <p>
                                {{ $evaluation->student_feedback }}
                            </p>

                        </div>

                    @endif


                @else

                    <div class="education-empty-state">

                        <i class="fa-regular fa-star"></i>

                        <strong>
                            {{ __('education_admin.lesson_assignments.show.evaluation.empty_title') }}
                        </strong>

                        <span>
                            {{ __('education_admin.lesson_assignments.show.evaluation.empty_description') }}
                        </span>

                    </div>

                @endif

            </div>


        @else

            {{-- =================================================
                MISSING STUDENT LESSON
            ================================================== --}}
            <div class="education-assignment-detail-card">

                <div class="education-missing-student-lesson">

                    <div class="education-missing-student-lesson-icon">

                        <i class="fa-solid fa-triangle-exclamation"></i>

                    </div>

                    <div>

                        <h2>
                            {{ __('education_admin.lesson_assignments.show.missing_student_lesson.title') }}
                        </h2>

                        <p>
                            {{ __('education_admin.lesson_assignments.show.missing_student_lesson.description') }}
                        </p>

                    </div>

                </div>

            </div>

        @endif


        {{-- =================================================
            ASSIGNMENT NOTES
        ================================================== --}}
        @if($assignment->notes)

            <div class="education-assignment-detail-card">

                <div class="education-assignment-detail-card-header">

                    <div class="education-assignment-detail-icon gold">

                        <i class="fa-solid fa-note-sticky"></i>

                    </div>

                    <div>

                        <h2>
                            {{ __('education_admin.lesson_assignments.show.notes.title') }}
                        </h2>

                        <p>
                            {{ __('education_admin.lesson_assignments.show.notes.description') }}
                        </p>

                    </div>

                </div>


                <div class="education-assignment-notes">

                    {{ $assignment->notes }}

                </div>

            </div>

        @endif


    </div>



    {{-- =====================================================
        SIDEBAR
    ====================================================== --}}
    <aside class="education-assignment-show-sidebar">


        {{-- =================================================
            STUDENT LESSON STATUS
        ================================================== --}}
        @if($assignment->studentLesson)

            <div class="education-assignment-detail-card">

                <div class="education-assignment-sidebar-title">

                    <i class="fa-solid fa-user-pen"></i>

                    {{ __('education_admin.lesson_assignments.show.student_lesson.title') }}

                </div>


                <div class="education-student-status">

                    @if($assignment->studentLesson->status === 'completed')

                        <div class="education-status-circle completed">

                            <i class="fa-solid fa-check"></i>

                        </div>

                        <strong>
                            {{ __('education_admin.lesson_assignments.show.student_lesson.completed') }}
                        </strong>

                    @elseif($assignment->studentLesson->status === 'in_progress')

                        <div class="education-status-circle progress">

                            <i class="fa-solid fa-book-open"></i>

                        </div>

                        <strong>
                            {{ __('education_admin.lesson_assignments.show.student_lesson.in_progress') }}
                        </strong>

                    @elseif($assignment->studentLesson->status === 'cancelled')

                        <div class="education-status-circle cancelled">

                            <i class="fa-solid fa-xmark"></i>

                        </div>

                        <strong>
                            {{ __('education_admin.lesson_assignments.show.student_lesson.cancelled') }}
                        </strong>

                    @else

                        <div class="education-status-circle assigned">

                            <i class="fa-solid fa-clock"></i>

                        </div>

                        <strong>
                            {{ __('education_admin.lesson_assignments.show.student_lesson.assigned') }}
                        </strong>

                    @endif

                </div>

            </div>

        @endif



        {{-- =================================================
            ASSIGNMENT DATES
        ================================================== --}}
        <div class="education-assignment-detail-card">

            <div class="education-assignment-sidebar-title">

                <i class="fa-solid fa-calendar-days"></i>

                {{ __('education_admin.lesson_assignments.show.dates.assignment_title') }}

            </div>


            <div class="education-assignment-timeline">

                <div class="education-assignment-timeline-item">

                    <span>
                        {{ __('education_admin.lesson_assignments.show.dates.assigned_at') }}
                    </span>

                    <strong>
                        {{ $assignment->assigned_at?->format('Y-m-d H:i') ?? '—' }}
                    </strong>

                </div>


                <div class="education-assignment-timeline-item">

                    <span>
                        {{ __('education_admin.lesson_assignments.show.dates.started_at') }}
                    </span>

                    <strong>
                        {{ $assignment->started_at?->format('Y-m-d H:i') ?? __('education_admin.lesson_assignments.show.dates.not_started') }}
                    </strong>

                </div>


                <div class="education-assignment-timeline-item">

                    <span>
                        {{ __('education_admin.lesson_assignments.show.dates.completed_at') }}
                    </span>

                    <strong>
                        {{ $assignment->completed_at?->format('Y-m-d H:i') ?? __('education_admin.lesson_assignments.show.dates.not_completed') }}
                    </strong>

                </div>

            </div>

        </div>



        {{-- =================================================
            STUDENT LESSON DATES
        ================================================== --}}
        @if($assignment->studentLesson)

            <div class="education-assignment-detail-card">

                <div class="education-assignment-sidebar-title">

                    <i class="fa-solid fa-clock-rotate-left"></i>

                    {{ __('education_admin.lesson_assignments.show.student_lesson_dates.title') }}

                </div>


                <div class="education-assignment-timeline">

                    <div class="education-assignment-timeline-item">

                        <span>
                            {{ __('education_admin.lesson_assignments.show.student_lesson_dates.created_at') }}
                        </span>

                        <strong>
                            {{ $assignment->studentLesson->assigned_at?->format('Y-m-d H:i') ?? '—' }}
                        </strong>

                    </div>


                    <div class="education-assignment-timeline-item">

                        <span>
                            {{ __('education_admin.lesson_assignments.show.student_lesson_dates.started_at') }}
                        </span>

                        <strong>
                            {{ $assignment->studentLesson->started_at?->format('Y-m-d H:i') ?? __('education_admin.lesson_assignments.show.student_lesson_dates.not_started') }}
                        </strong>

                    </div>


                    <div class="education-assignment-timeline-item">

                        <span>
                            {{ __('education_admin.lesson_assignments.show.student_lesson_dates.completed_at') }}
                        </span>

                        <strong>
                            {{ $assignment->studentLesson->completed_at?->format('Y-m-d H:i') ?? __('education_admin.lesson_assignments.show.student_lesson_dates.not_completed') }}
                        </strong>

                    </div>

                </div>

            </div>

        @endif



        {{-- =================================================
            QUICK ACTIONS
        ================================================== --}}
        <div class="education-assignment-detail-card">

            <div class="education-assignment-sidebar-title">

                <i class="fa-solid fa-bolt"></i>

                {{ __('education_admin.lesson_assignments.show.quick_actions.title') }}

            </div>


            <div class="education-assignment-quick-actions">


                @if($assignment->studentLesson)

                    <a
                        href="#student-lesson-content"
                        class="education-assignment-quick-action"
                    >
                        <i class="fa-solid fa-folder-open"></i>
                        {{ __('education_admin.lesson_assignments.show.quick_actions.content') }}
                    </a>


                    <a
                        href="#student-lesson-evaluation"
                        class="education-assignment-quick-action"
                    >
                        <i class="fa-solid fa-star"></i>
                        {{ __('education_admin.lesson_assignments.show.quick_actions.evaluation') }}
                    </a>

                @endif


                <a
                    href="{{ route('education.admin.lesson-assignments.create') }}"
                    class="education-assignment-quick-action"
                >
                    <i class="fa-solid fa-plus"></i>
                    {{ __('education_admin.lesson_assignments.show.quick_actions.assign_another') }}
                </a>


                <a
                    href="{{ route('education.admin.lesson-assignments.index') }}"
                    class="education-assignment-quick-action"
                >
                    <i class="fa-solid fa-list"></i>
                    {{ __('education_admin.lesson_assignments.show.quick_actions.all_assignments') }}
                </a>

            </div>

        </div>


    </aside>

</div>

</div>

@push('styles')

<style>

/* =========================================================
   PAGE
========================================================= */

.education-assignment-show-page {
    min-height: 100vh;
    padding: 30px;
    background: #f7f3e9;
    color: #26352d;
}


/* =========================================================
   HEADER
========================================================= */

.education-assignment-show-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 22px;
}

.education-assignment-show-breadcrumb {
    display: flex;
    align-items: center;
    gap: 9px;
    color: #9c7a32;
    font-size: 13px;
    font-weight: 700;
    margin-bottom: 10px;
}

.education-assignment-show-breadcrumb a {
    color: #214b3a;
    text-decoration: none;
}

.education-assignment-show-header h1 {
    margin: 0;
    color: #214b3a;
    font-size: 30px;
    font-weight: 800;
}

.education-assignment-show-header p {
    margin: 7px 0 0;
    color: #77837d;
}

.education-assignment-back-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    min-height: 43px;
    padding: 0 16px;
    background: #fff;
    border: 1px solid #e4dccb;
    border-radius: 10px;
    color: #214b3a !important;
    text-decoration: none;
    font-weight: 700;
    transition: .2s ease;
}

.education-assignment-back-btn:hover {
    background: #e8f0eb;
    border-color: #d4e2d9;
}


/* =========================================================
   STATUS
========================================================= */

.education-assignment-status-banner {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 18px 20px;
    margin-bottom: 22px;
    background: #fff;
    border: 1px solid #e8e0ce;
    border-radius: 15px;
}

.education-assignment-status-banner-icon {
    width: 48px;
    height: 48px;
    border-radius: 13px;
    background: #f3ead2;
    color: #9c7a32;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 19px;
    flex-shrink: 0;
}

.education-assignment-status-banner span {
    display: block;
    color: #818c86;
    font-size: 12px;
    margin-bottom: 3px;
}

.education-assignment-status-banner strong {
    color: #214b3a;
    font-size: 16px;
}


/* =========================================================
   GRID
========================================================= */

.education-assignment-show-grid {
    display: grid;
    grid-template-columns: minmax(0, 1fr) 330px;
    gap: 22px;
}

.education-assignment-show-main,
.education-assignment-show-sidebar {
    display: flex;
    flex-direction: column;
    gap: 20px;
}


/* =========================================================
   CARD
========================================================= */

.education-assignment-detail-card {
    background: #fff;
    border: 1px solid #e8e0ce;
    border-radius: 17px;
    padding: 22px;
    box-shadow: 0 8px 28px rgba(33, 75, 58, .045);
}

.education-assignment-detail-card-header {
    display: flex;
    align-items: center;
    gap: 13px;
    padding-bottom: 18px;
    margin-bottom: 18px;
    border-bottom: 1px solid #eee8da;
}

.education-assignment-detail-icon {
    width: 46px;
    height: 46px;
    border-radius: 13px;
    background: #f3ead2;
    color: #9c7a32;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.education-assignment-detail-icon.green {
    background: #e8f0eb;
    color: #214b3a;
}

.education-assignment-detail-icon.gold {
    background: #f3ead2;
    color: #9c7a32;
}

.education-assignment-detail-card-header h2 {
    margin: 0;
    color: #214b3a;
    font-size: 18px;
}

.education-assignment-detail-card-header p {
    margin: 4px 0 0;
    color: #818b85;
    font-size: 12px;
}


/* =========================================================
   ANCHOR TARGET
========================================================= */

.education-anchor-target {
    scroll-margin-top: 25px;
}


/* =========================================================
   STUDENT
========================================================= */

.education-assignment-student-profile {
    display: flex;
    align-items: center;
    gap: 15px;
}

.education-assignment-student-avatar {
    width: 65px;
    height: 65px;
    border-radius: 17px;
    background: #e8f0eb;
    color: #214b3a;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    flex-shrink: 0;
}

.education-assignment-student-profile h3 {
    margin: 0 0 5px;
    color: #214b3a;
    font-size: 18px;
}

.education-assignment-student-profile span {
    color: #7d8982;
    font-size: 13px;
}


/* =========================================================
   STUDENT LESSON
========================================================= */

.education-student-lesson-box {
    padding: 20px;
    border-radius: 14px;
    background: #faf8f2;
    border: 1px solid #eee8da;
}

.education-student-lesson-top {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
}

.education-student-lesson-label {
    display: block;
    margin-bottom: 6px;
    color: #8b958f;
    font-size: 11px;
}

.education-student-lesson-top h3 {
    margin: 0;
    color: #214b3a;
    font-size: 21px;
}

.education-session-number {
    min-width: 75px;
    padding: 10px;
    text-align: center;
    background: #e8f0eb;
    border-radius: 11px;
    color: #214b3a;
}

.education-session-number span {
    display: block;
    font-size: 10px;
    margin-bottom: 3px;
}

.education-session-number strong {
    font-size: 18px;
}

.education-student-lesson-description {
    margin-top: 18px;
    padding-top: 17px;
    border-top: 1px solid #e8e0ce;
    color: #66746c;
    line-height: 1.9;
}

.education-student-lesson-meta {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 10px;
    margin-top: 18px;
}

.education-student-lesson-meta > div {
    padding: 12px;
    border-radius: 10px;
    background: #fff;
    border: 1px solid #eee8da;
}

.education-student-lesson-meta span {
    display: block;
    margin-bottom: 5px;
    color: #8a938e;
    font-size: 11px;
}

.education-student-lesson-meta strong {
    color: #214b3a;
    font-size: 13px;
}


/* =========================================================
   CONTENTS
========================================================= */

.education-student-contents {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.education-student-content-item {
    display: flex;
    gap: 14px;
    padding: 16px;
    border: 1px solid #eee8da;
    background: #faf8f2;
    border-radius: 13px;
}

.education-student-content-icon {
    width: 43px;
    height: 43px;
    border-radius: 11px;
    background: #e8f0eb;
    color: #214b3a;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.education-student-content-body {
    flex: 1;
    min-width: 0;
}

.education-student-content-top {
    display: flex;
    justify-content: space-between;
    gap: 10px;
}

.education-student-content-top h3 {
    margin: 0;
    color: #214b3a;
    font-size: 15px;
}

.education-student-content-top span {
    display: inline-block;
    margin-top: 5px;
    color: #9c7a32;
    font-size: 10px;
    font-weight: 800;
}

.education-student-content-description {
    margin: 8px 0 0;
    color: #758078;
    font-size: 12px;
    line-height: 1.7;
}

.education-student-content-text {
    margin-top: 10px;
    padding: 12px;
    border-radius: 9px;
    background: #fff;
    color: #53625a;
    font-size: 13px;
    line-height: 1.9;
}

.education-student-content-link {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    margin-top: 10px;
    padding: 8px 12px;
    border-radius: 8px;
    background: #214b3a;
    color: #fff !important;
    text-decoration: none;
    font-size: 11px;
    font-weight: 700;
    transition: .2s ease;
}

.education-student-content-link:hover {
    background: #17382b;
}


/* =========================================================
   EMPTY
========================================================= */

.education-empty-state {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 35px 20px;
    text-align: center;
    border: 1px dashed #ddd4c1;
    border-radius: 13px;
    background: #faf8f2;
}

.education-empty-state i {
    margin-bottom: 12px;
    color: #b6aa8f;
    font-size: 28px;
}

.education-empty-state strong {
    color: #53625a;
    font-size: 14px;
}

.education-empty-state span {
    margin-top: 5px;
    color: #8a938e;
    font-size: 12px;
}


/* =========================================================
   EVALUATION
========================================================= */

.education-evaluation-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 10px;
}

.education-evaluation-item {
    padding: 14px;
    border-radius: 11px;
    background: #faf8f2;
    border: 1px solid #eee8da;
}

.education-evaluation-item span {
    display: block;
    color: #8a938e;
    font-size: 11px;
    margin-bottom: 5px;
}

.education-evaluation-item strong {
    color: #214b3a;
    font-size: 17px;
}

.education-evaluation-item.primary {
    background: #e8f0eb;
    border-color: #d4e2d9;
}

.education-evaluation-notes {
    margin-top: 14px;
    padding: 14px;
    border-radius: 11px;
    background: #faf8f2;
}

.education-evaluation-notes span {
    display: block;
    color: #9c7a32;
    font-size: 11px;
    font-weight: 800;
    margin-bottom: 7px;
}

.education-evaluation-notes p {
    margin: 0;
    color: #53625a;
    font-size: 13px;
    line-height: 1.8;
}


/* =========================================================
   MISSING STUDENT LESSON
========================================================= */

.education-missing-student-lesson {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 5px;
}

.education-missing-student-lesson-icon {
    width: 52px;
    height: 52px;
    border-radius: 14px;
    background: #f3ead2;
    color: #9c7a32;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    font-size: 20px;
}

.education-missing-student-lesson h2 {
    margin: 0 0 5px;
    color: #214b3a;
    font-size: 16px;
}

.education-missing-student-lesson p {
    margin: 0;
    color: #7b8780;
    font-size: 12px;
    line-height: 1.7;
}


/* =========================================================
   NOTES
========================================================= */

.education-assignment-notes {
    padding: 17px;
    border-radius: 12px;
    background: #faf8f2;
    color: #53625a;
    line-height: 1.9;
}


/* =========================================================
   SIDEBAR
========================================================= */

.education-assignment-sidebar-title {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 20px;
    color: #214b3a;
    font-size: 16px;
    font-weight: 800;
}

.education-assignment-sidebar-title i {
    color: #9c7a32;
}

.education-assignment-timeline {
    display: flex;
    flex-direction: column;
}

.education-assignment-timeline-item {
    padding: 13px 0;
    border-bottom: 1px solid #eee8da;
}

.education-assignment-timeline-item:last-child {
    border-bottom: 0;
}

.education-assignment-timeline-item span {
    display: block;
    color: #8a938e;
    font-size: 12px;
    margin-bottom: 5px;
}

.education-assignment-timeline-item strong {
    color: #405249;
    font-size: 13px;
}


/* =========================================================
   STUDENT STATUS
========================================================= */

.education-student-status {
    display: flex;
    align-items: center;
    gap: 12px;
}

.education-status-circle {
    width: 42px;
    height: 42px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.education-status-circle.assigned {
    background: #f3ead2;
    color: #9c7a32;
}

.education-status-circle.progress {
    background: #e8f0eb;
    color: #214b3a;
}

.education-status-circle.completed {
    background: #dcebe2;
    color: #214b3a;
}

.education-status-circle.cancelled {
    background: #f4e4e1;
    color: #a34d43;
}

.education-student-status strong {
    color: #214b3a;
    font-size: 14px;
}


/* =========================================================
   QUICK ACTIONS
========================================================= */

.education-assignment-quick-actions {
    display: flex;
    flex-direction: column;
    gap: 9px;
}

.education-assignment-quick-action {
    display: flex;
    align-items: center;
    gap: 10px;
    min-height: 43px;
    padding: 0 13px;
    border-radius: 10px;
    background: #faf8f2;
    color: #405249 !important;
    text-decoration: none;
    font-size: 13px;
    font-weight: 700;
    border: 1px solid #eee8da;
    transition: .2s ease;
}

.education-assignment-quick-action i {
    width: 20px;
    color: #9c7a32;
}

.education-assignment-quick-action:hover {
    background: #e8f0eb;
    border-color: #d4e2d9;
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 900px) {

    .education-assignment-show-grid {
        grid-template-columns: 1fr;
    }

    .education-evaluation-grid {
        grid-template-columns: repeat(2, 1fr);
    }

}


@media (max-width: 650px) {

    .education-assignment-show-page {
        padding: 18px;
    }

    .education-assignment-show-header {
        flex-direction: column;
        align-items: stretch;
    }

    .education-assignment-back-btn {
        justify-content: center;
    }

    .education-student-lesson-top {
        align-items: stretch;
        flex-direction: column;
    }

    .education-session-number {
        width: fit-content;
    }

    .education-student-lesson-meta {
        grid-template-columns: 1fr;
    }

    .education-evaluation-grid {
        grid-template-columns: 1fr;
    }

    .education-student-content-item {
        align-items: flex-start;
    }

}

</style>

@endpush

@endsection
