@extends('education.admin.layouts.app')

@section('title', __('education_admin.student_lesson_show.page_title'))

@section('content')

<div class="education-page">

    {{-- ============================================================
        HEADER
    ============================================================ --}}

    <div class="page-header">

        <div class="page-header-left">

            <div class="breadcrumb">

                <a href="{{ route('education.admin.dashboard') }}">
                    <i class="fa-solid fa-house"></i>
                    {{ __('education_admin.student_lesson_show.header.dashboard') }}
                </a>

                <span>/</span>

                <a href="{{ route('education.admin.student-lessons.index') }}">
                    {{ __('education_admin.student_lesson_show.header.student_lessons') }}
                </a>

                <span>/</span>

                <span>{{ __('education_admin.student_lesson_show.header.current') }}</span>

            </div>

            <h1>
                {{ __('education_admin.student_lesson_show.header.title') }}
            </h1>

            <p>
                {{ __('education_admin.student_lesson_show.header.description') }}
            </p>

        </div>


        <div class="page-header-actions">

            {{-- العودة إلى الدروس --}}

            <a
                href="{{ route('education.admin.student-lessons.index') }}"
                class="btn btn-secondary"
            >
                <i class="fa-solid fa-arrow-right"></i>
                {{ __('education_admin.student_lesson_show.actions.back') }}
            </a>


            {{-- إدارة المحتوى --}}

            @if(Route::has('education.admin.student-lessons.content.index'))

                <a
                    href="{{ route(
                        'education.admin.student-lessons.content.index',
                        $studentLesson
                    ) }}"
                    class="btn btn-gold"
                >
                    <i class="fa-solid fa-layer-group"></i>
                    {{ __('education_admin.student_lesson_show.actions.manage_content') }}
                </a>

            @endif


            {{-- تعديل الدرس --}}

            <a
                href="{{ route(
                    'education.admin.student-lessons.edit',
                    $studentLesson
                ) }}"
                class="btn btn-primary"
            >
                <i class="fa-solid fa-pen"></i>
                {{ __('education_admin.student_lesson_show.actions.edit') }}
            </a>

        </div>

    </div>


    {{-- ============================================================
        ALERTS
    ============================================================ --}}

    @if(session('success'))

        <div class="alert alert-success">

            <i class="fa-solid fa-circle-check"></i>

            <span>
                {{ session('success') }}
            </span>

        </div>

    @endif


    @if(session('info'))

        <div class="alert alert-info">

            <i class="fa-solid fa-circle-info"></i>

            <span>
                {{ session('info') }}
            </span>

        </div>

    @endif


    {{-- ============================================================
        STATUS
        يتم تعريف الحالة هنا لأن أزرار الإجراءات في أسفل الصفحة
        تعتمد عليها.
    ============================================================ --}}

    @php

        $status =
            $studentLesson->status
            ?? $studentLesson->assignment?->status
            ?? 'assigned';

        $statusClasses = [
            'pending' => 'status-warning',
            'assigned' => 'status-info',
            'in_progress' => 'status-info',
            'completed' => 'status-success',
            'cancelled' => 'status-danger',
            'canceled' => 'status-danger',
        ];

        $statusIcons = [
            'pending' => 'fa-clock',
            'assigned' => 'fa-clipboard-check',
            'in_progress' => 'fa-spinner',
            'completed' => 'fa-circle-check',
            'cancelled' => 'fa-circle-xmark',
            'canceled' => 'fa-circle-xmark',
        ];

        $statusLabels = [
            'pending' => __('education_admin.student_lesson_show.status.pending'),
            'assigned' => __('education_admin.student_lesson_show.status.assigned'),
            'in_progress' => __('education_admin.student_lesson_show.status.in_progress'),
            'completed' => __('education_admin.student_lesson_show.status.completed'),
            'cancelled' => __('education_admin.student_lesson_show.status.cancelled'),
            'canceled' => __('education_admin.student_lesson_show.status.cancelled'),
        ];

    @endphp


    {{-- ============================================================
        MAIN GRID
    ============================================================ --}}

    <div class="lesson-details-grid">


        {{-- ========================================================
            معلومات الطالب
        ======================================================== --}}

        <div class="education-card">

            <div class="card-header">

                <div class="card-header-icon">
                    <i class="fa-solid fa-user-graduate"></i>
                </div>

                <div>

                    <h2>
                        {{ __('education_admin.student_lesson_show.student.title') }}
                    </h2>

                    <p>
                        {{ __('education_admin.student_lesson_show.student.description') }}
                    </p>

                </div>

            </div>


            <div class="card-body">

                @if($studentLesson->student)

                    <div class="student-profile">

                        <div class="student-avatar">
                            <i class="fa-solid fa-user-graduate"></i>
                        </div>

                        <div>

                            <div class="student-name">
                                {{ $studentLesson->student->name }}
                            </div>

                            @if($studentLesson->student->email)

                                <div class="student-email">
                                    {{ $studentLesson->student->email }}
                                </div>

                            @endif

                        </div>

                    </div>


                    <div class="info-list">

                        <div class="info-row">

                            <span class="info-label">
                                <i class="fa-solid fa-user"></i>
                                {{ __('education_admin.student_lesson_show.student.name') }}
                            </span>

                            <span class="info-value">
                                {{ $studentLesson->student->name }}
                            </span>

                        </div>


                        <div class="info-row">

                            <span class="info-label">
                                <i class="fa-solid fa-envelope"></i>
                                {{ __('education_admin.student_lesson_show.student.email') }}
                            </span>

                            <span class="info-value">
                                {{ $studentLesson->student->email ?? '—' }}
                            </span>

                        </div>


                        @if($studentLesson->student->phone)

                            <div class="info-row">

                                <span class="info-label">
                                    <i class="fa-solid fa-phone"></i>
                                    {{ __('education_admin.student_lesson_show.student.phone') }}
                                </span>

                                <span class="info-value">
                                    {{ $studentLesson->student->phone }}
                                </span>

                            </div>

                        @endif

                    </div>

                @else

                    <div class="empty-state">

                        <i class="fa-solid fa-user-slash"></i>

                        <span>
                            {{ __('education_admin.student_lesson_show.student.unknown') }}
                        </span>

                    </div>

                @endif

            </div>

        </div>


        {{-- ========================================================
            معلومات الدرس العام
        ======================================================== --}}

        <div class="education-card">

            <div class="card-header">

                <div class="card-header-icon">
                    <i class="fa-solid fa-book-open"></i>
                </div>

                <div>

                    <h2>
                        {{ __('education_admin.student_lesson_show.lesson.title') }}
                    </h2>

                    <p>
                        {{ __('education_admin.student_lesson_show.lesson.description') }}
                    </p>

                </div>

            </div>


            <div class="card-body">

                @php

                    $lesson =
                        $studentLesson->sourceLesson
                        ?? $studentLesson->assignment?->lesson;

                @endphp


                @if($lesson)

                    <div class="lesson-title-box">

                        <div class="lesson-icon">
                            <i class="fa-solid fa-book-open"></i>
                        </div>

                        <div>

                            <h3>
                                {{ $lesson->title }}
                            </h3>

                            @if($lesson->slug)

                                <span>
                                    {{ $lesson->slug }}
                                </span>

                            @endif

                        </div>

                    </div>


                    <div class="info-list">

                        <div class="info-row">

                            <span class="info-label">
                                <i class="fa-solid fa-hashtag"></i>
                                {{ __('education_admin.student_lesson_show.lesson.number') }}
                            </span>

                            <span class="info-value">
                                #{{ $lesson->id }}
                            </span>

                        </div>


                        @if($lesson->slug)

                            <div class="info-row">

                                <span class="info-label">
                                    <i class="fa-solid fa-link"></i>
                                    {{ __('education_admin.student_lesson_show.lesson.slug') }}
                                </span>

                                <span class="info-value">
                                    {{ $lesson->slug }}
                                </span>

                            </div>

                        @endif

                    </div>


                    @if($lesson->description)

                        <div class="description-box">

                            <div class="description-title">

                                <i class="fa-solid fa-align-left"></i>

                                {{ __('education_admin.student_lesson_show.lesson.description_label') }}

                            </div>

                            <p>
                                {{ $lesson->description }}
                            </p>

                        </div>

                    @endif

                @else

                    <div class="empty-state">

                        <i class="fa-solid fa-book-open"></i>

                        <span>
                            {{ __('education_admin.student_lesson_show.lesson.not_found') }}
                        </span>

                    </div>

                @endif

            </div>

        </div>


        {{-- ========================================================
            درس الطالب
        ======================================================== --}}

        <div class="education-card">

            <div class="card-header">

                <div class="card-header-icon">
                    <i class="fa-solid fa-graduation-cap"></i>
                </div>

                <div>

                    <h2>
                        {{ __('education_admin.student_lesson_show.student_lesson.title') }}
                    </h2>

                    <p>
                        {{ __('education_admin.student_lesson_show.student_lesson.description') }}
                    </p>

                </div>

            </div>


            <div class="card-body">

                <div class="info-list">

                    <div class="info-row">

                        <span class="info-label">
                            <i class="fa-solid fa-heading"></i>
                            {{ __('education_admin.student_lesson_show.student_lesson.lesson_title') }}
                        </span>

                        <span class="info-value">
                            {{ $studentLesson->title ?? '—' }}
                        </span>

                    </div>


                    <div class="info-row">

                        <span class="info-label">
                            <i class="fa-solid fa-hashtag"></i>
                            {{ __('education_admin.student_lesson_show.student_lesson.number') }}
                        </span>

                        <span class="info-value">
                            #{{ $studentLesson->id }}
                        </span>

                    </div>


                    @if($studentLesson->session_number)

                        <div class="info-row">

                            <span class="info-label">
                                <i class="fa-solid fa-list-ol"></i>
                                {{ __('education_admin.student_lesson_show.student_lesson.session_number') }}
                            </span>

                            <span class="info-value">
                                {{ $studentLesson->session_number }}
                            </span>

                        </div>

                    @endif


                    <div class="info-row">

                        <span class="info-label">
                            <i class="fa-solid fa-toggle-on"></i>
                            {{ __('education_admin.student_lesson_show.student_lesson.status') }}
                        </span>

                        <span class="info-value">

                            @if($studentLesson->is_active)

                                <span class="mini-status active">
                                    {{ __('education_admin.student_lesson_show.student_lesson.active') }}
                                </span>

                            @else

                                <span class="mini-status inactive">
                                    {{ __('education_admin.student_lesson_show.student_lesson.inactive') }}
                                </span>

                            @endif

                        </span>

                    </div>

                </div>


                @if($studentLesson->description)

                    <div class="description-box">

                        <div class="description-title">

                            <i class="fa-solid fa-align-left"></i>

                            {{ __('education_admin.student_lesson_show.student_lesson.description_label') }}

                        </div>

                        <p>
                            {{ $studentLesson->description }}
                        </p>

                    </div>

                @endif

            </div>

        </div>


        {{-- ========================================================
            معلومات الإسناد
        ======================================================== --}}

        <div class="education-card">

            <div class="card-header">

                <div class="card-header-icon">
                    <i class="fa-solid fa-clipboard-list"></i>
                </div>

                <div>

                    <h2>
                        {{ __('education_admin.student_lesson_show.assignment.title') }}
                    </h2>

                    <p>
                        {{ __('education_admin.student_lesson_show.assignment.description') }}
                    </p>

                </div>

            </div>


            <div class="card-body">

                @if($studentLesson->assignment)

                    <div class="info-list">

                        <div class="info-row">

                            <span class="info-label">
                                <i class="fa-solid fa-hashtag"></i>
                                {{ __('education_admin.student_lesson_show.assignment.number') }}
                            </span>

                            <span class="info-value">
                                #{{ $studentLesson->assignment->id }}
                            </span>

                        </div>


                        @if($studentLesson->assignment->status)

                            @php

                                $assignmentStatus =
                                    $studentLesson->assignment->status;

                                $assignmentStatusLabels = [
                                    'assigned' => __('education_admin.student_lesson_show.assignment.statuses.assigned'),
                                    'in_progress' => __('education_admin.student_lesson_show.assignment.statuses.in_progress'),
                                    'completed' => __('education_admin.student_lesson_show.assignment.statuses.completed'),
                                    'cancelled' => __('education_admin.student_lesson_show.assignment.statuses.cancelled'),
                                    'canceled' => __('education_admin.student_lesson_show.assignment.statuses.canceled'),
                                ];

                            @endphp

                            <div class="info-row">

                                <span class="info-label">
                                    <i class="fa-solid fa-chart-line"></i>
                                    {{ __('education_admin.student_lesson_show.assignment.status') }}
                                </span>

                                <span class="info-value">
                                    {{ $assignmentStatusLabels[$assignmentStatus] ?? $assignmentStatus }}
                                </span>

                            </div>

                        @endif


                        @if($studentLesson->assignment->assigned_at)

                            <div class="info-row">

                                <span class="info-label">
                                    <i class="fa-regular fa-calendar"></i>
                                    {{ __('education_admin.student_lesson_show.assignment.date') }}
                                </span>

                                <span class="info-value">
                                    {{ $studentLesson->assignment->assigned_at->format('d/m/Y - h:i A') }}
                                </span>

                            </div>

                        @endif

                    </div>

                @else

                    <div class="empty-state">

                        <i class="fa-solid fa-clipboard-question"></i>

                        <span>
                            {{ __('education_admin.student_lesson_show.assignment.not_found') }}
                        </span>

                    </div>

                @endif

            </div>

        </div>


        {{-- ========================================================
            معلومات الحجز
        ======================================================== --}}

        <div class="education-card">

            <div class="card-header">

                <div class="card-header-icon">
                    <i class="fa-solid fa-calendar-check"></i>
                </div>

                <div>

                    <h2>
                        {{ __('education_admin.student_lesson_show.booking.title') }}
                    </h2>

                    <p>
                        {{ __('education_admin.student_lesson_show.booking.description') }}
                    </p>

                </div>

            </div>


            <div class="card-body">

                @if($studentLesson->booking)

                    <div class="info-list">

                        <div class="info-row">

                            <span class="info-label">
                                <i class="fa-solid fa-hashtag"></i>
                                {{ __('education_admin.student_lesson_show.booking.number') }}
                            </span>

                            <span class="info-value">
                                #{{ $studentLesson->booking->id }}
                            </span>

                        </div>


                        @if($studentLesson->booking->status)

                            @php

                                $bookingStatus =
                                    $studentLesson->booking->status;

                                $bookingStatusLabels = [
                                    'pending' => __('education_admin.student_lesson_show.booking.statuses.pending'),
                                    'confirmed' => __('education_admin.student_lesson_show.booking.statuses.confirmed'),
                                    'completed' => __('education_admin.student_lesson_show.booking.statuses.completed'),
                                    'cancelled' => __('education_admin.student_lesson_show.booking.statuses.cancelled'),
                                    'canceled' => __('education_admin.student_lesson_show.booking.statuses.canceled'),
                                ];

                            @endphp

                            <div class="info-row">

                                <span class="info-label">
                                    <i class="fa-solid fa-circle-info"></i>
                                    {{ __('education_admin.student_lesson_show.booking.status') }}
                                </span>

                                <span class="info-value">
                                    {{ $bookingStatusLabels[$bookingStatus] ?? $bookingStatus }}
                                </span>

                            </div>

                        @endif


                        @if($studentLesson->booking->scheduled_at)

                            <div class="info-row">

                                <span class="info-label">
                                    <i class="fa-solid fa-calendar-days"></i>
                                    {{ __('education_admin.student_lesson_show.booking.scheduled_at') }}
                                </span>

                                <span class="info-value">
                                    {{ \Carbon\Carbon::parse($studentLesson->booking->scheduled_at)->format('d/m/Y - h:i A') }}
                                </span>

                            </div>

                        @endif

                    </div>

                @else

                    <div class="empty-state">

                        <i class="fa-regular fa-calendar-xmark"></i>

                        <span>
                            {{ __('education_admin.student_lesson_show.booking.not_found') }}
                        </span>

                    </div>

                @endif

            </div>

        </div>


        {{-- ========================================================
            الحالة
            تم حذف "التقدم" بالكامل.
        ======================================================== --}}

        <div class="education-card">

            <div class="card-header">

                <div class="card-header-icon">
                    <i class="fa-solid fa-circle-info"></i>
                </div>

                <div>

                    <h2>
                        {{ __('education_admin.student_lesson_show.status.title') }}
                    </h2>

                    <p>
                        {{ __('education_admin.student_lesson_show.status.description') }}
                    </p>

                </div>

            </div>


            <div class="card-body">

                <div class="status-display">

                    <span class="status-badge {{ $statusClasses[$status] ?? 'status-neutral' }}">

                        <i class="fa-solid {{ $statusIcons[$status] ?? 'fa-circle' }}"></i>

                        {{ $statusLabels[$status] ?? $status }}

                    </span>

                </div>

            </div>

        </div>


        {{-- ========================================================
            تواريخ الدرس
        ======================================================== --}}

        <div class="education-card">

            <div class="card-header">

                <div class="card-header-icon">
                    <i class="fa-regular fa-calendar-days"></i>
                </div>

                <div>

                    <h2>
                        {{ __('education_admin.student_lesson_show.dates.title') }}
                    </h2>

                    <p>
                        {{ __('education_admin.student_lesson_show.dates.description') }}
                    </p>

                </div>

            </div>


            <div class="card-body">

                <div class="info-list">

                    @if($studentLesson->assigned_at)

                        <div class="info-row">

                            <span class="info-label">
                                <i class="fa-solid fa-clipboard-check"></i>
                                {{ __('education_admin.student_lesson_show.dates.assigned_at') }}
                            </span>

                            <span class="info-value">
                                {{ \Carbon\Carbon::parse($studentLesson->assigned_at)->format('d/m/Y - h:i A') }}
                            </span>

                        </div>

                    @elseif($studentLesson->assignment?->assigned_at)

                        <div class="info-row">

                            <span class="info-label">
                                <i class="fa-solid fa-clipboard-check"></i>
                                {{ __('education_admin.student_lesson_show.dates.assigned_at') }}
                            </span>

                            <span class="info-value">
                                {{ $studentLesson->assignment->assigned_at->format('d/m/Y - h:i A') }}
                            </span>

                        </div>

                    @endif


                    @if($studentLesson->started_at)

                        <div class="info-row">

                            <span class="info-label">
                                <i class="fa-solid fa-play"></i>
                                {{ __('education_admin.student_lesson_show.dates.started_at') }}
                            </span>

                            <span class="info-value">
                                {{ \Carbon\Carbon::parse($studentLesson->started_at)->format('d/m/Y - h:i A') }}
                            </span>

                        </div>

                    @elseif($studentLesson->assignment?->started_at)

                        <div class="info-row">

                            <span class="info-label">
                                <i class="fa-solid fa-play"></i>
                                {{ __('education_admin.student_lesson_show.dates.started_at') }}
                            </span>

                            <span class="info-value">
                                {{ $studentLesson->assignment->started_at->format('d/m/Y - h:i A') }}
                            </span>

                        </div>

                    @endif


                    @if($studentLesson->completed_at)

                        <div class="info-row">

                            <span class="info-label">
                                <i class="fa-solid fa-circle-check"></i>
                                {{ __('education_admin.student_lesson_show.dates.completed_at') }}
                            </span>

                            <span class="info-value">
                                {{ \Carbon\Carbon::parse($studentLesson->completed_at)->format('d/m/Y - h:i A') }}
                            </span>

                        </div>

                    @elseif($studentLesson->assignment?->completed_at)

                        <div class="info-row">

                            <span class="info-label">
                                <i class="fa-solid fa-circle-check"></i>
                                {{ __('education_admin.student_lesson_show.dates.completed_at') }}
                            </span>

                            <span class="info-value">
                                {{ $studentLesson->assignment->completed_at->format('d/m/Y - h:i A') }}
                            </span>

                        </div>

                    @endif


                    @if(
                        !$studentLesson->assigned_at &&
                        !$studentLesson->assignment?->assigned_at &&
                        !$studentLesson->started_at &&
                        !$studentLesson->assignment?->started_at &&
                        !$studentLesson->completed_at &&
                        !$studentLesson->assignment?->completed_at
                    )

                        <div class="empty-state-small">

                            <i class="fa-regular fa-calendar-xmark"></i>

                            <span>
                                {{ __('education_admin.student_lesson_show.dates.empty') }}
                            </span>

                        </div>

                    @endif

                </div>

            </div>

        </div>


        {{-- ========================================================
            الملاحظات
        ======================================================== --}}

        @if($studentLesson->notes || $studentLesson->assignment?->notes)

            <div class="education-card full-width-card">

                <div class="card-header">

                    <div class="card-header-icon">
                        <i class="fa-solid fa-note-sticky"></i>
                    </div>

                    <div>

                        <h2>
                            {{ __('education_admin.student_lesson_show.notes.title') }}
                        </h2>

                        <p>
                            {{ __('education_admin.student_lesson_show.notes.description') }}
                        </p>

                    </div>

                </div>


                <div class="card-body">

                    <div class="notes-box">

                        {!! nl2br(e(
                            $studentLesson->notes
                            ?? $studentLesson->assignment?->notes
                        )) !!}

                    </div>

                </div>

            </div>

        @endif


        {{-- ========================================================
            المحتوى
        ======================================================== --}}

        <div class="education-card full-width-card">

            <div class="card-header">

                <div class="card-header-icon">
                    <i class="fa-solid fa-layer-group"></i>
                </div>

                <div>

                    <h2>
                        {{ __('education_admin.student_lesson_show.content.title') }}
                    </h2>

                    <p>
                        {{ __('education_admin.student_lesson_show.content.description') }}
                    </p>

                </div>

            </div>


            <div class="card-body">

                @if($studentLesson->contents && $studentLesson->contents->count())

                    <div class="contents-list">

                        @foreach($studentLesson->contents as $index => $content)

                            <div class="content-item">

                                <div class="content-number">
                                    {{ $index + 1 }}
                                </div>

                                <div class="content-main">

                                    <div class="content-title">
                                        {{ $content->title ?? __('education_admin.student_lesson_show.content.default_title') }}
                                    </div>

                                    @if($content->type)

                                        @php

                                            $contentTypeLabels = [
                                                'text' => __('education_admin.student_lesson_show.content.types.text'),
                                                'video' => __('education_admin.student_lesson_show.content.types.video'),
                                                'audio' => __('education_admin.student_lesson_show.content.types.audio'),
                                                'image' => __('education_admin.student_lesson_show.content.types.image'),
                                                'file' => __('education_admin.student_lesson_show.content.types.file'),
                                                'quiz' => __('education_admin.student_lesson_show.content.types.quiz'),
                                                'link' => __('education_admin.student_lesson_show.content.types.link'),
                                            ];

                                            $contentType =
                                                $contentTypeLabels[$content->type]
                                                ?? $content->type;

                                        @endphp

                                        <div class="content-type">

                                            <i class="fa-solid fa-file-lines"></i>

                                            {{ $contentType }}

                                        </div>

                                    @endif

                                </div>

                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="empty-state">

                        <i class="fa-solid fa-layer-group"></i>

                        <span>
                            {{ __('education_admin.student_lesson_show.content.not_found') }}
                        </span>

                    </div>

                @endif

            </div>

        </div>

    </div>


    {{-- ============================================================
        ACTIONS
    ============================================================ --}}

    <div class="education-card actions-card">

        <div class="card-header">

            <div class="card-header-icon">
                <i class="fa-solid fa-sliders"></i>
            </div>

            <div>

                <h2>
                    {{ __('education_admin.student_lesson_show.management.title') }}
                </h2>

                <p>
                    {{ __('education_admin.student_lesson_show.management.description') }}
                </p>

            </div>

        </div>


        <div class="card-body">

            <div class="action-buttons">


                {{-- بدء الدرس --}}

                @if(in_array($status, ['pending', 'assigned']))

                    <form
                        action="{{ route(
                            'education.admin.student-lessons.start',
                            $studentLesson
                        ) }}"
                        method="POST"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="btn btn-primary"
                        >
                            <i class="fa-solid fa-play"></i>
                            {{ __('education_admin.student_lesson_show.actions.start') }}
                        </button>

                    </form>

                @endif


                {{-- إكمال الدرس --}}

                @if($status === 'in_progress')

                    <form
                        action="{{ route(
                            'education.admin.student-lessons.complete',
                            $studentLesson
                        ) }}"
                        method="POST"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="btn btn-success"
                        >
                            <i class="fa-solid fa-circle-check"></i>
                            {{ __('education_admin.student_lesson_show.actions.complete') }}
                        </button>

                    </form>

                @endif


                {{-- إلغاء الدرس --}}

                @if(!in_array($status, ['completed', 'cancelled', 'canceled']))

                    <form
                        action="{{ route(
                            'education.admin.student-lessons.cancel',
                            $studentLesson
                        ) }}"
                        method="POST"
                        onsubmit="return confirm('{{ __('education_admin.student_lesson_show.management.confirm_cancel') }}');"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="btn btn-danger"
                        >
                            <i class="fa-solid fa-ban"></i>
                            {{ __('education_admin.student_lesson_show.actions.cancel') }}
                        </button>

                    </form>

                @endif


                {{-- حذف الدرس --}}

                <form
                    action="{{ route(
                        'education.admin.student-lessons.destroy',
                        $studentLesson
                    ) }}"
                    method="POST"
                    onsubmit="return confirm('{{ __('education_admin.student_lesson_show.management.confirm_delete') }}');"
                >

                    @csrf

                    @method('DELETE')

                    <button
                        type="submit"
                        class="btn btn-outline-danger"
                    >
                        <i class="fa-solid fa-trash"></i>
                        {{ __('education_admin.student_lesson_show.actions.delete') }}
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>


{{-- ================================================================
    PAGE STYLE
================================================================ --}}

<style>

.education-page {
    width: 100%;
}


/* ============================================================
   HEADER
============================================================ */

.page-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    gap: 24px;
    margin-bottom: 24px;
}

.page-header-left {
    min-width: 0;
}

.breadcrumb {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 9px;
    margin-bottom: 10px;
    font-size: 13px;
    color: #8a8173;
}

.breadcrumb a {
    color: #8a6a24;
    text-decoration: none;
    transition: .2s;
}

.breadcrumb a:hover {
    color: #b18a35;
}

.breadcrumb i {
    margin-left: 4px;
    margin-right: 0;
}

.page-header h1 {
    margin: 0 0 7px;
    font-size: 30px;
    font-weight: 700;
    color: #315c4b;
}

.page-header p {
    margin: 0;
    color: #8a8173;
    font-size: 14px;
}

.page-header-actions {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
}


/* ============================================================
   ALERTS
============================================================ */

.alert {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 13px 16px;
    margin-bottom: 22px;
    border-radius: 12px;
    font-size: 13px;
    font-weight: 600;
}

.alert-success {
    background: #e7f3e9;
    border: 1px solid #c9e3ce;
    color: #316845;
}

.alert-info {
    background: #e7f0ed;
    border: 1px solid #cbded7;
    color: #315c4b;
}


/* ============================================================
   GRID
============================================================ */

.lesson-details-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 22px;
}


/* ============================================================
   CARDS
============================================================ */

.education-card {
    background: #fffdf8;
    border: 1px solid #eadfca;
    border-radius: 18px;
    box-shadow: 0 8px 25px rgba(80, 65, 35, .06);
    overflow: hidden;
}

.full-width-card {
    grid-column: 1 / -1;
}

.card-header {
    display: flex;
    align-items: center;
    gap: 13px;
    padding: 19px 21px;
    border-bottom: 1px solid #eee4d2;
    background: #fbf7ed;
}

.card-header-icon {
    width: 42px;
    height: 42px;
    flex: 0 0 42px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 12px;
    background: #e8f0e8;
    color: #315c4b;
    font-size: 17px;
}

.card-header h2 {
    margin: 0 0 3px;
    color: #315c4b;
    font-size: 17px;
    font-weight: 700;
}

.card-header p {
    margin: 0;
    color: #918878;
    font-size: 12px;
}

.card-body {
    padding: 21px;
}


/* ============================================================
   STUDENT PROFILE
============================================================ */

.student-profile {
    display: flex;
    align-items: center;
    gap: 13px;
    padding-bottom: 18px;
    margin-bottom: 8px;
    border-bottom: 1px solid #eee7da;
}

.student-avatar {
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 14px;
    background: #e8f0e8;
    color: #315c4b;
    font-size: 20px;
}

.student-name {
    color: #315c4b;
    font-size: 16px;
    font-weight: 700;
}

.student-email {
    margin-top: 3px;
    color: #8a8173;
    font-size: 12px;
}


/* ============================================================
   INFORMATION
============================================================ */

.info-list {
    display: flex;
    flex-direction: column;
}

.info-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    padding: 13px 0;
    border-bottom: 1px solid #eee7da;
}

.info-row:first-child {
    padding-top: 0;
}

.info-row:last-child {
    border-bottom: 0;
    padding-bottom: 0;
}

.info-label {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #81786a;
    font-size: 13px;
    font-weight: 600;
}

.info-label i {
    width: 17px;
    color: #a9822e;
    text-align: center;
}

.info-value {
    color: #3c403d;
    font-size: 14px;
    font-weight: 600;
    text-align: right;
    word-break: break-word;
}


/* ============================================================
   LESSON TITLE
============================================================ */

.lesson-title-box {
    display: flex;
    align-items: center;
    gap: 13px;
    padding-bottom: 18px;
    margin-bottom: 8px;
    border-bottom: 1px solid #eee7da;
}

.lesson-icon {
    width: 48px;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 13px;
    background: #f5ead1;
    color: #a9822e;
    font-size: 19px;
}

.lesson-title-box h3 {
    margin: 0;
    color: #315c4b;
    font-size: 16px;
}

.lesson-title-box span {
    display: block;
    margin-top: 4px;
    color: #918878;
    font-size: 12px;
}


/* ============================================================
   DESCRIPTION
============================================================ */

.description-box {
    margin-top: 18px;
    padding: 15px;
    border-radius: 13px;
    background: #faf6ed;
    border: 1px solid #eee4d2;
}

.description-title {
    display: flex;
    align-items: center;
    gap: 7px;
    color: #a9822e;
    font-size: 12px;
    font-weight: 700;
}

.description-box p {
    margin: 10px 0 0;
    color: #625e56;
    line-height: 1.8;
    font-size: 13px;
}


/* ============================================================
   MINI STATUS
============================================================ */

.mini-status {
    display: inline-flex;
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 700;
}

.mini-status.active {
    background: #e4f1e8;
    color: #2f704c;
}

.mini-status.inactive {
    background: #eeeae3;
    color: #777066;
}


/* ============================================================
   STATUS
============================================================ */

.status-display {
    display: flex;
    align-items: center;
    justify-content: flex-start;
}

.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 9px 16px;
    border-radius: 30px;
    font-size: 13px;
    font-weight: 700;
}

.status-warning {
    background: #fff2d5;
    color: #9a6b14;
}

.status-info {
    background: #e7f0ed;
    color: #315c4b;
}

.status-success {
    background: #e4f1e8;
    color: #2f704c;
}

.status-danger {
    background: #f8e4e1;
    color: #a34e43;
}

.status-neutral {
    background: #eceae5;
    color: #6e695f;
}


/* ============================================================
   NOTES
============================================================ */

.notes-box {
    padding: 17px;
    border-radius: 13px;
    background: #faf6ed;
    border: 1px solid #eee4d2;
    color: #5f5b53;
    font-size: 14px;
    line-height: 1.9;
}


/* ============================================================
   CONTENTS
============================================================ */

.contents-list {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.content-item {
    display: flex;
    align-items: center;
    gap: 13px;
    padding: 13px;
    border: 1px solid #eee4d2;
    border-radius: 12px;
    background: #fffdf8;
    transition: .2s ease;
}

.content-item:hover {
    border-color: #dfcfad;
    background: #fdf9f0;
}

.content-number {
    width: 34px;
    height: 34px;
    flex: 0 0 34px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    background: #e8f0e8;
    color: #315c4b;
    font-size: 12px;
    font-weight: 700;
}

.content-main {
    min-width: 0;
}

.content-title {
    color: #3c403d;
    font-size: 13px;
    font-weight: 700;
}

.content-type {
    display: flex;
    align-items: center;
    gap: 6px;
    margin-top: 4px;
    color: #918878;
    font-size: 11px;
}


/* ============================================================
   EMPTY
============================================================ */

.empty-state {
    min-height: 120px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    gap: 9px;
    color: #938b7e;
    font-size: 13px;
    text-align: center;
}

.empty-state i {
    color: #b18a35;
    font-size: 24px;
}

.empty-state-small {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 9px;
    padding: 20px;
    color: #938b7e;
    font-size: 13px;
}

.empty-state-small i {
    color: #b18a35;
}


/* ============================================================
   BUTTONS
============================================================ */

.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    min-height: 40px;
    padding: 9px 16px;
    border: 1px solid transparent;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
    cursor: pointer;
    transition: .2s ease;
    white-space: nowrap;
}

.btn-primary {
    background: #315c4b;
    color: #fff;
}

.btn-primary:hover {
    background: #274d3e;
    color: #fff;
}

.btn-secondary {
    background: #f5efe3;
    border-color: #e5d8bf;
    color: #6e6049;
}

.btn-secondary:hover {
    background: #eee5d5;
    color: #594c38;
}

.btn-success {
    background: #4d805d;
    color: #fff;
}

.btn-success:hover {
    background: #3e6d4d;
    color: #fff;
}

.btn-danger {
    background: #a8564c;
    color: #fff;
}

.btn-danger:hover {
    background: #8f453d;
    color: #fff;
}

.btn-outline-danger {
    background: transparent;
    border-color: #d6a49e;
    color: #a8564c;
}

.btn-outline-danger:hover {
    background: #f8e4e1;
}

.btn-gold {
    background: #b18a35;
    color: #fff;
    border-color: #b18a35;
}

.btn-gold:hover {
    background: #967329;
    border-color: #967329;
    color: #fff;
}


/* ============================================================
   ACTIONS
============================================================ */

.actions-card {
    margin-top: 22px;
}

.action-buttons {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
}

.action-buttons form {
    margin: 0;
}


/* ============================================================
   RESPONSIVE
============================================================ */

@media (max-width: 900px) {

    .lesson-details-grid {
        grid-template-columns: 1fr;
    }

    .full-width-card {
        grid-column: auto;
    }

}


@media (max-width: 700px) {

    .page-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .page-header-actions {
        width: 100%;
    }

    .page-header-actions .btn {
        flex: 1;
    }

    .info-row {
        align-items: flex-start;
        flex-direction: column;
        gap: 6px;
    }

    .info-value {
        text-align: right;
    }

    .action-buttons {
        flex-direction: column;
        align-items: stretch;
    }

    .action-buttons form,
    .action-buttons .btn {
        width: 100%;
    }

}


@media (max-width: 480px) {

    .page-header h1 {
        font-size: 24px;
    }

    .page-header-actions {
        flex-direction: column;
        align-items: stretch;
    }

    .page-header-actions .btn {
        width: 100%;
        flex: none;
    }

    .card-header {
        padding: 16px;
    }

    .card-body {
        padding: 16px;
    }

}

</style>

@endsection
