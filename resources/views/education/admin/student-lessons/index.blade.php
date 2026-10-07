@extends('education.admin.layouts.app')

@section('title', __('education_admin.student_lessons.page_title'))

@section('content')

<style>
    /* =========================================================
       STUDENT LESSONS PAGE
       Education Admin Design System
       Cream / Gold / Green
    ========================================================= */

    .student-lessons-page {
        --edu-cream: #f7f1e5;
        --edu-cream-light: #fffdf8;
        --edu-gold: #b08d3c;
        --edu-gold-light: #d4b86a;
        --edu-green: #315c45;
        --edu-green-dark: #234634;
        --edu-green-soft: #eaf2ed;
        --edu-text: #26352d;
        --edu-muted: #7b817c;
        --edu-border: #e7dfd0;
        --edu-white: #ffffff;
        --edu-danger: #a94b4b;
        --edu-warning: #a47726;
        --edu-info: #54758c;

        color: var(--edu-text);
    }

    /* =========================================================
       HEADER
    ========================================================= */

    .student-lessons-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 24px;
        margin-bottom: 28px;
    }

    .student-lessons-header-left {
        min-width: 0;
    }

    .student-lessons-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        color: var(--edu-gold);
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .student-lessons-breadcrumb i {
        font-size: 14px;
    }

    .student-lessons-title {
        margin: 0;
        color: var(--edu-green-dark);
        font-size: 30px;
        line-height: 1.25;
        font-weight: 700;
    }

    .student-lessons-description {
        margin: 8px 0 0;
        color: var(--edu-muted);
        font-size: 14px;
        line-height: 1.8;
    }

    .student-lessons-header-actions {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    /* =========================================================
       STATISTICS
    ========================================================= */

    .student-lessons-statistics {
        display: grid;
        grid-template-columns: repeat(5, minmax(0, 1fr));
        gap: 16px;
        margin-bottom: 24px;
    }

    .student-lesson-stat-card {
        position: relative;
        overflow: hidden;
        background: var(--edu-white);
        border: 1px solid var(--edu-border);
        border-radius: 16px;
        padding: 18px;
        box-shadow: 0 8px 24px rgba(49, 92, 69, 0.06);
        transition:
            transform 0.2s ease,
            box-shadow 0.2s ease;
    }

    .student-lesson-stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 28px rgba(49, 92, 69, 0.10);
    }

    .student-lesson-stat-card::after {
        content: '';
        position: absolute;
        width: 70px;
        height: 70px;
        border-radius: 50%;
        background: var(--edu-green-soft);
        right: -24px;
        top: -24px;
        opacity: 0.8;
    }

    .student-lesson-stat-top {
        position: relative;
        z-index: 2;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }

    .student-lesson-stat-icon {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--edu-cream);
        color: var(--edu-gold);
        font-size: 17px;
    }

    .student-lesson-stat-value {
        margin-top: 15px;
        font-size: 27px;
        line-height: 1;
        font-weight: 700;
        color: var(--edu-green-dark);
    }

    .student-lesson-stat-label {
        margin-top: 7px;
        color: var(--edu-muted);
        font-size: 13px;
        font-weight: 500;
    }

    .student-lesson-stat-card.assigned .student-lesson-stat-icon {
        background: #f5eddc;
        color: var(--edu-gold);
    }

    .student-lesson-stat-card.progress .student-lesson-stat-icon {
        background: #edf2f5;
        color: var(--edu-info);
    }

    .student-lesson-stat-card.completed .student-lesson-stat-icon {
        background: var(--edu-green-soft);
        color: var(--edu-green);
    }

    .student-lesson-stat-card.cancelled .student-lesson-stat-icon {
        background: #f8ecec;
        color: var(--edu-danger);
    }

    /* =========================================================
       FILTER CARD
    ========================================================= */

    .student-lessons-filter-card {
        background: var(--edu-white);
        border: 1px solid var(--edu-border);
        border-radius: 18px;
        padding: 20px;
        margin-bottom: 22px;
        box-shadow: 0 8px 24px rgba(49, 92, 69, 0.05);
    }

    .student-lessons-filter-form {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 220px auto;
        gap: 14px;
        align-items: end;
    }

    .student-lessons-field {
        display: flex;
        flex-direction: column;
        gap: 7px;
    }

    .student-lessons-field label {
        color: var(--edu-green-dark);
        font-size: 13px;
        font-weight: 600;
    }

    .student-lessons-input,
    .student-lessons-select {
        width: 100%;
        height: 45px;
        border: 1px solid var(--edu-border);
        border-radius: 11px;
        background: var(--edu-cream-light);
        color: var(--edu-text);
        padding: 0 13px;
        outline: none;
        font-size: 13px;
        transition:
            border-color 0.2s ease,
            box-shadow 0.2s ease;
    }

    .student-lessons-input:focus,
    .student-lessons-select:focus {
        border-color: var(--edu-gold);
        box-shadow: 0 0 0 3px rgba(176, 141, 60, 0.10);
    }

    .student-lessons-input::placeholder {
        color: #a4a8a5;
    }

    .student-lessons-filter-actions {
        display: flex;
        align-items: center;
        gap: 9px;
    }

    /* =========================================================
       BUTTONS
    ========================================================= */

    .student-lessons-btn {
        min-height: 45px;
        border-radius: 11px;
        border: 1px solid transparent;
        padding: 0 16px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition:
            transform 0.2s ease,
            box-shadow 0.2s ease,
            background 0.2s ease;
        white-space: nowrap;
    }

    .student-lessons-btn:hover {
        transform: translateY(-1px);
    }

    .student-lessons-btn-primary {
        background: var(--edu-green);
        color: #fff;
        box-shadow: 0 6px 16px rgba(49, 92, 69, 0.15);
    }

    .student-lessons-btn-primary:hover {
        background: var(--edu-green-dark);
        color: #fff;
    }

    .student-lessons-btn-secondary {
        background: var(--edu-cream);
        color: var(--edu-green-dark);
        border-color: var(--edu-border);
    }

    .student-lessons-btn-secondary:hover {
        background: #efe6d5;
        color: var(--edu-green-dark);
    }

    /* =========================================================
       TABLE CARD
    ========================================================= */

    .student-lessons-table-card {
        background: var(--edu-white);
        border: 1px solid var(--edu-border);
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 8px 24px rgba(49, 92, 69, 0.05);
    }

    .student-lessons-table-header {
        padding: 18px 20px;
        border-bottom: 1px solid var(--edu-border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
    }

    .student-lessons-table-header-title {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .student-lessons-table-header-title i {
        color: var(--edu-gold);
    }

    .student-lessons-table-header-title h2 {
        margin: 0;
        color: var(--edu-green-dark);
        font-size: 16px;
        font-weight: 700;
    }

    .student-lessons-count {
        color: var(--edu-muted);
        font-size: 12px;
    }

    .student-lessons-table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    .student-lessons-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 850px;
    }

    .student-lessons-table thead th {
        background: #fbf8f1;
        color: var(--edu-green-dark);
        font-size: 12px;
        font-weight: 700;
        text-align: right;
        padding: 14px 16px;
        border-bottom: 1px solid var(--edu-border);
        white-space: nowrap;
    }

    .student-lessons-table tbody td {
        padding: 15px 16px;
        border-bottom: 1px solid #f0eadf;
        color: var(--edu-text);
        font-size: 13px;
        vertical-align: middle;
    }

    .student-lessons-table tbody tr:last-child td {
        border-bottom: 0;
    }

    .student-lessons-table tbody tr {
        transition: background 0.2s ease;
    }

    .student-lessons-table tbody tr:hover {
        background: #fdfbf6;
    }

    /* =========================================================
       STUDENT
    ========================================================= */

    .student-lesson-student {
        display: flex;
        align-items: center;
        gap: 11px;
        min-width: 190px;
    }

    .student-lesson-avatar {
        width: 39px;
        height: 39px;
        border-radius: 50%;
        background: var(--edu-green-soft);
        color: var(--edu-green);
        display: flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 auto;
        font-weight: 700;
        font-size: 13px;
    }

    .student-lesson-student-info {
        min-width: 0;
    }

    .student-lesson-student-name {
        color: var(--edu-green-dark);
        font-weight: 700;
        font-size: 13px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 180px;
    }

    .student-lesson-student-email {
        margin-top: 3px;
        color: var(--edu-muted);
        font-size: 11px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 180px;
    }

    /* =========================================================
       LESSON
    ========================================================= */

    .student-lesson-title {
        color: var(--edu-green-dark);
        font-weight: 700;
        max-width: 230px;
    }

    .student-lesson-source {
        color: var(--edu-muted);
        font-size: 11px;
        margin-top: 4px;
    }

    /* =========================================================
       STATUS
    ========================================================= */

    .student-lesson-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 10px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 700;
        white-space: nowrap;
    }

    .student-lesson-status::before {
        content: '';
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor;
    }

    .student-lesson-status.assigned {
        background: #f5eddc;
        color: var(--edu-warning);
    }

    .student-lesson-status.in-progress {
        background: #edf2f5;
        color: var(--edu-info);
    }

    .student-lesson-status.completed {
        background: var(--edu-green-soft);
        color: var(--edu-green);
    }

    .student-lesson-status.cancelled {
        background: #f8ecec;
        color: var(--edu-danger);
    }

    /* =========================================================
       DATE
    ========================================================= */

    .student-lesson-date {
        color: var(--edu-text);
        font-size: 12px;
        white-space: nowrap;
    }

    .student-lesson-date-time {
        color: var(--edu-muted);
        font-size: 10px;
        margin-top: 3px;
    }

    /* =========================================================
       ACTION
    ========================================================= */

    .student-lesson-actions {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        gap: 7px;
    }

    .student-lesson-action {
        width: 34px;
        height: 34px;
        border-radius: 9px;
        border: 1px solid var(--edu-border);
        background: var(--edu-cream-light);
        color: var(--edu-green);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition:
            background 0.2s ease,
            color 0.2s ease,
            transform 0.2s ease;
    }

    .student-lesson-action:hover {
        background: var(--edu-green);
        color: #fff;
        transform: translateY(-1px);
    }

    .student-lesson-action.edit:hover {
        background: var(--edu-gold);
    }

    /* =========================================================
       EMPTY STATE
    ========================================================= */

    .student-lessons-empty {
        padding: 60px 25px;
        text-align: center;
    }

    .student-lessons-empty-icon {
        width: 64px;
        height: 64px;
        margin: 0 auto 15px;
        border-radius: 18px;
        background: var(--edu-cream);
        color: var(--edu-gold);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }

    .student-lessons-empty h3 {
        margin: 0;
        color: var(--edu-green-dark);
        font-size: 17px;
    }

    .student-lessons-empty p {
        margin: 8px auto 0;
        max-width: 420px;
        color: var(--edu-muted);
        font-size: 13px;
        line-height: 1.8;
    }

    .student-lessons-empty-action {
        margin-top: 18px;
    }

    /* =========================================================
       PAGINATION
    ========================================================= */

    .student-lessons-pagination {
        padding: 18px 20px;
        border-top: 1px solid var(--edu-border);
    }

    .student-lessons-pagination nav {
        display: flex;
        justify-content: center;
    }

    .student-lessons-pagination svg {
        width: 17px;
        height: 17px;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 1200px) {

        .student-lessons-statistics {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }

    }

    @media (max-width: 900px) {

        .student-lessons-header {
            flex-direction: column;
        }

        .student-lessons-header-actions {
            width: 100%;
        }

        .student-lessons-filter-form {
            grid-template-columns: 1fr;
        }

        .student-lessons-filter-actions {
            justify-content: flex-start;
        }

    }

    @media (max-width: 650px) {

        .student-lessons-statistics {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .student-lessons-title {
            font-size: 24px;
        }

        .student-lessons-filter-card {
            padding: 15px;
        }

        .student-lessons-table-header {
            padding: 15px;
        }

    }

    @media (max-width: 430px) {

        .student-lessons-statistics {
            grid-template-columns: 1fr;
        }

        .student-lessons-header-actions {
            width: 100%;
        }

        .student-lessons-header-actions .student-lessons-btn {
            width: 100%;
        }

        .student-lessons-filter-actions {
            flex-direction: column;
            align-items: stretch;
        }

        .student-lessons-btn {
            width: 100%;
        }

    }
</style>


<div class="student-lessons-page">

    {{-- =====================================================
         PAGE HEADER
    ====================================================== --}}

    <div class="student-lessons-header">

        <div class="student-lessons-header-left">

            <div class="student-lessons-breadcrumb">

                <i class="fa-solid fa-graduation-cap"></i>

                <span>
                    {{ __('education_admin.student_lessons.header.education') }}
                </span>

                <i class="fa-solid fa-chevron-left"></i>

                <span>
                    {{ __('education_admin.student_lessons.header.title') }}
                </span>

            </div>

            <h1 class="student-lessons-title">
                {{ __('education_admin.student_lessons.header.title') }}
            </h1>

            <p class="student-lessons-description">
                {{ __('education_admin.student_lessons.header.description') }}
            </p>

        </div>


        {{-- =================================================
             CREATE / ASSIGN LESSON
        ================================================== --}}

        <div class="student-lessons-header-actions">

            <a
                href="{{ route('education.admin.student-lessons.create') }}"
                class="student-lessons-btn student-lessons-btn-primary"
            >
                <i class="fa-solid fa-plus"></i>
                <span>
                    {{ __('education_admin.student_lessons.actions.assign_lesson') }}
                </span>
            </a>

        </div>

    </div>


    {{-- =====================================================
         STATISTICS
    ====================================================== --}}

    <div class="student-lessons-statistics">

        {{-- TOTAL --}}

        <div class="student-lesson-stat-card">

            <div class="student-lesson-stat-top">

                <div class="student-lesson-stat-icon">
                    <i class="fa-solid fa-layer-group"></i>
                </div>

            </div>

            <div class="student-lesson-stat-value">
                {{ number_format($statistics['total'] ?? 0) }}
            </div>

            <div class="student-lesson-stat-label">
                {{ __('education_admin.student_lessons.statistics.total') }}
            </div>

        </div>


        {{-- ASSIGNED --}}

        <div class="student-lesson-stat-card assigned">

            <div class="student-lesson-stat-top">

                <div class="student-lesson-stat-icon">
                    <i class="fa-solid fa-paper-plane"></i>
                </div>

            </div>

            <div class="student-lesson-stat-value">
                {{ number_format($statistics['assigned'] ?? 0) }}
            </div>

            <div class="student-lesson-stat-label">
                {{ __('education_admin.student_lessons.statistics.assigned') }}
            </div>

        </div>


        {{-- IN PROGRESS --}}

        <div class="student-lesson-stat-card progress">

            <div class="student-lesson-stat-top">

                <div class="student-lesson-stat-icon">
                    <i class="fa-solid fa-spinner"></i>
                </div>

            </div>

            <div class="student-lesson-stat-value">
                {{ number_format($statistics['in_progress'] ?? 0) }}
            </div>

            <div class="student-lesson-stat-label">
                {{ __('education_admin.student_lessons.statistics.in_progress') }}
            </div>

        </div>


        {{-- COMPLETED --}}

        <div class="student-lesson-stat-card completed">

            <div class="student-lesson-stat-top">

                <div class="student-lesson-stat-icon">
                    <i class="fa-solid fa-circle-check"></i>
                </div>

            </div>

            <div class="student-lesson-stat-value">
                {{ number_format($statistics['completed'] ?? 0) }}
            </div>

            <div class="student-lesson-stat-label">
                {{ __('education_admin.student_lessons.statistics.completed') }}
            </div>

        </div>


        {{-- CANCELLED --}}

        <div class="student-lesson-stat-card cancelled">

            <div class="student-lesson-stat-top">

                <div class="student-lesson-stat-icon">
                    <i class="fa-solid fa-ban"></i>
                </div>

            </div>

            <div class="student-lesson-stat-value">
                {{ number_format($statistics['cancelled'] ?? 0) }}
            </div>

            <div class="student-lesson-stat-label">
                {{ __('education_admin.student_lessons.statistics.cancelled') }}
            </div>

        </div>

    </div>


    {{-- =====================================================
         FILTERS
    ====================================================== --}}

    <div class="student-lessons-filter-card">

        <form
            method="GET"
            action="{{ route('education.admin.student-lessons.index') }}"
            class="student-lessons-filter-form"
        >

            {{-- SEARCH --}}

            <div class="student-lessons-field">

                <label for="student-lessons-search">
                    {{ __('education_admin.student_lessons.filters.search') }}
                </label>

                <input
                    id="student-lessons-search"
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    class="student-lessons-input"
                    placeholder="{{ __('education_admin.student_lessons.filters.search_placeholder') }}"
                >

            </div>


            {{-- STATUS --}}

            <div class="student-lessons-field">

                <label for="student-lessons-status">
                    {{ __('education_admin.student_lessons.filters.status') }}
                </label>

                <select
                    id="student-lessons-status"
                    name="status"
                    class="student-lessons-select"
                >

                    <option value="">
                        {{ __('education_admin.student_lessons.filters.all_statuses') }}
                    </option>

                    <option
                        value="assigned"
                        @selected(request('status') === 'assigned')
                    >
                        {{ __('education_admin.student_lessons.filters.assigned') }}
                    </option>

                    <option
                        value="in_progress"
                        @selected(request('status') === 'in_progress')
                    >
                        {{ __('education_admin.student_lessons.filters.in_progress') }}
                    </option>

                    <option
                        value="completed"
                        @selected(request('status') === 'completed')
                    >
                        {{ __('education_admin.student_lessons.filters.completed') }}
                    </option>

                    <option
                        value="cancelled"
                        @selected(request('status') === 'cancelled')
                    >
                        {{ __('education_admin.student_lessons.filters.cancelled') }}
                    </option>

                </select>

            </div>


            {{-- ACTIONS --}}

            <div class="student-lessons-filter-actions">

                <button
                    type="submit"
                    class="student-lessons-btn student-lessons-btn-primary"
                >
                    <i class="fa-solid fa-filter"></i>
                    <span>
                        {{ __('education_admin.student_lessons.actions.filter') }}
                    </span>
                </button>

                @if(request()->filled('search') || request()->filled('status'))

                    <a
                        href="{{ route('education.admin.student-lessons.index') }}"
                        class="student-lessons-btn student-lessons-btn-secondary"
                    >
                        <i class="fa-solid fa-rotate-left"></i>
                        <span>
                            {{ __('education_admin.student_lessons.actions.reset') }}
                        </span>
                    </a>

                @endif

            </div>

        </form>

    </div>


    {{-- =====================================================
         TABLE
    ====================================================== --}}

    <div class="student-lessons-table-card">

        <div class="student-lessons-table-header">

            <div class="student-lessons-table-header-title">

                <i class="fa-solid fa-book-open"></i>

                <h2>
                    {{ __('education_admin.student_lessons.table.title') }}
                </h2>

            </div>

            <div class="student-lessons-count">

                {{ $studentLessons->total() }}

                {{ $studentLessons->total() === 1
                    ? __('education_admin.student_lessons.table.lesson_count_singular')
                    : __('education_admin.student_lessons.table.lesson_count_plural')
                }}

            </div>

        </div>


        @if($studentLessons->count())

            <div class="student-lessons-table-wrapper">

                <table class="student-lessons-table">

                    <thead>

                        <tr>

                            <th>
                                {{ __('education_admin.student_lessons.table.student') }}
                            </th>

                            <th>
                                {{ __('education_admin.student_lessons.table.lesson') }}
                            </th>

                            <th>
                                {{ __('education_admin.student_lessons.table.status') }}
                            </th>

                            <th>
                                {{ __('education_admin.student_lessons.table.assigned_date') }}
                            </th>

                            <th>
                                {{ __('education_admin.student_lessons.table.session') }}
                            </th>

                            <th>
                                {{ __('education_admin.student_lessons.table.actions') }}
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($studentLessons as $studentLesson)

                            @php

                                /*
                                |--------------------------------------------------------------------------
                                | STUDENT
                                |--------------------------------------------------------------------------
                                */

                                $student =
                                    $studentLesson->student;

                                $studentName =
                                    $student?->name
                                    ?? __('education_admin.student_lessons.table.unknown_student');

                                $studentEmail =
                                    $student?->email
                                    ?? '';

                                $initial =
                                    mb_strtoupper(
                                        mb_substr(
                                            $studentName,
                                            0,
                                            1
                                        )
                                    );


                                /*
                                |--------------------------------------------------------------------------
                                | STATUS
                                |--------------------------------------------------------------------------
                                */

                                $status =
                                    $studentLesson->status
                                    ?? 'assigned';

                                $statusClass =
                                    match($status) {

                                        'in_progress'
                                            => 'in-progress',

                                        'completed'
                                            => 'completed',

                                        'cancelled',
                                        'canceled'
                                            => 'cancelled',

                                        default
                                            => 'assigned',

                                    };


                                $statusLabel =
                                    match($status) {

                                        'in_progress'
                                            => __('education_admin.student_lessons.status.in_progress'),

                                        'completed'
                                            => __('education_admin.student_lessons.status.completed'),

                                        'cancelled',
                                        'canceled'
                                            => __('education_admin.student_lessons.status.cancelled'),

                                        default
                                            => __('education_admin.student_lessons.status.assigned'),

                                    };

                            @endphp


                            <tr>

                                {{-- =================================================
                                     STUDENT
                                ================================================== --}}

                                <td>

                                    <div class="student-lesson-student">

                                        <div class="student-lesson-avatar">
                                            {{ $initial }}
                                        </div>

                                        <div class="student-lesson-student-info">

                                            <div class="student-lesson-student-name">
                                                {{ $studentName }}
                                            </div>

                                            @if($studentEmail)

                                                <div class="student-lesson-student-email">
                                                    {{ $studentEmail }}
                                                </div>

                                            @endif

                                        </div>

                                    </div>

                                </td>


                                {{-- =================================================
                                     LESSON
                                ================================================== --}}

                                <td>

                                    <div class="student-lesson-title">

                                        {{ $studentLesson->title
                                            ?? __('education_admin.student_lessons.table.no_title')
                                        }}

                                    </div>

                                    @if($studentLesson->sourceLesson)

                                        <div class="student-lesson-source">

                                            {{ __('education_admin.student_lessons.table.original_lesson') }}

                                            {{ $studentLesson->sourceLesson->title }}

                                        </div>

                                    @endif

                                </td>


                                {{-- =================================================
                                     STATUS
                                ================================================== --}}

                                <td>

                                    <span
                                        class="student-lesson-status {{ $statusClass }}"
                                    >
                                        {{ $statusLabel }}
                                    </span>

                                </td>


                                {{-- =================================================
                                     ASSIGNED DATE
                                ================================================== --}}

                                <td>

                                    @if($studentLesson->assigned_at)

                                        <div class="student-lesson-date">

                                            {{ $studentLesson->assigned_at->format('Y/m/d') }}

                                        </div>

                                        <div class="student-lesson-date-time">

                                            {{ $studentLesson->assigned_at->format('h:i A') }}

                                        </div>

                                    @else

                                        <span class="student-lesson-date">
                                            {{ __('education_admin.student_lessons.table.empty_date') }}
                                        </span>

                                    @endif

                                </td>


                                {{-- =================================================
                                     SESSION
                                ================================================== --}}

                                <td>

                                    @if($studentLesson->session_number)

                                        <span>
                                            {{ __('education_admin.student_lessons.table.session_number', [
                                                'number' => $studentLesson->session_number
                                            ]) }}
                                        </span>

                                    @else

                                        <span class="student-lesson-date">
                                            {{ __('education_admin.student_lessons.table.empty_date') }}
                                        </span>

                                    @endif

                                </td>


                                {{-- =================================================
                                     ACTIONS
                                ================================================== --}}

                                <td>

                                    <div class="student-lesson-actions">

                                        {{-- VIEW --}}

                                        <a
                                            href="{{ route(
                                                'education.admin.student-lessons.show',
                                                $studentLesson
                                            ) }}"
                                            class="student-lesson-action"
                                            title="{{ __('education_admin.student_lessons.actions.view') }}"
                                        >
                                            <i class="fa-solid fa-eye"></i>
                                        </a>


                                        {{-- EDIT --}}

                                        <a
                                            href="{{ route(
                                                'education.admin.student-lessons.edit',
                                                $studentLesson
                                            ) }}"
                                            class="student-lesson-action edit"
                                            title="{{ __('education_admin.student_lessons.actions.edit') }}"
                                        >
                                            <i class="fa-solid fa-pen"></i>
                                        </a>

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>


            {{-- =====================================================
                 PAGINATION
            ====================================================== --}}

            @if($studentLessons->hasPages())

                <div class="student-lessons-pagination">

                    {{ $studentLessons->links() }}

                </div>

            @endif

        @else

            {{-- =====================================================
                 EMPTY STATE
            ====================================================== --}}

            <div class="student-lessons-empty">

                <div class="student-lessons-empty-icon">

                    <i class="fa-solid fa-book-open"></i>

                </div>

                <h3>
                    {{ __('education_admin.student_lessons.empty.title') }}
                </h3>

                <p>
                    {{ __('education_admin.student_lessons.empty.description') }}
                </p>

                <div class="student-lessons-empty-action">

                    <a
                        href="{{ route('education.admin.student-lessons.create') }}"
                        class="student-lessons-btn student-lessons-btn-primary"
                    >
                        <i class="fa-solid fa-plus"></i>
                        <span>
                            {{ __('education_admin.student_lessons.actions.assign_first') }}
                        </span>
                    </a>

                </div>

            </div>

        @endif

    </div>

</div>

@endsection
