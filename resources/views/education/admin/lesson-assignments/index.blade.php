@extends('education.admin.layouts.app')

@section('title', __('education_admin.lesson_assignments.page_title'))

@section('content')

<div class="education-lesson-assignments-page" dir="rtl">


{{-- ==========================================================
    HEADER
=========================================================== --}}

<div class="education-lesson-assignments-header">

    <div>

        <div class="education-lesson-assignments-breadcrumb">

            <i class="fa-solid fa-link"></i>

            <span>
                {{ __('education_admin.lesson_assignments.breadcrumb_management') }}
            </span>

            <i class="fa-solid fa-chevron-left"></i>

            <span>
                {{ __('education_admin.lesson_assignments.breadcrumb_assignments') }}
            </span>

        </div>

        <h1>
            {{ __('education_admin.lesson_assignments.title') }}
        </h1>

        <p>
            {{ __('education_admin.lesson_assignments.description') }}
        </p>

    </div>


    <a
        href="{{ route('education.admin.lesson-assignments.create') }}"
        class="lesson-assignments-create-btn"
    >

        <i class="fa-solid fa-plus"></i>

        {{ __('education_admin.lesson_assignments.assign_lesson') }}

    </a>

</div>


{{-- ==========================================================
    ALERTS
=========================================================== --}}

@if(session('success'))

    <div class="lesson-assignments-alert lesson-assignments-alert-success">

        <i class="fa-solid fa-circle-check"></i>

        <span>
            {{ session('success') }}
        </span>

    </div>

@endif


@if(session('error'))

    <div class="lesson-assignments-alert lesson-assignments-alert-error">

        <i class="fa-solid fa-circle-exclamation"></i>

        <span>
            {{ session('error') }}
        </span>

    </div>

@endif


@if(session('info'))

    <div class="lesson-assignments-alert lesson-assignments-alert-info">

        <i class="fa-solid fa-circle-info"></i>

        <span>
            {{ session('info') }}
        </span>

    </div>

@endif


@if($errors->any())

    <div class="lesson-assignments-alert lesson-assignments-alert-error">

        <i class="fa-solid fa-circle-exclamation"></i>

        <div>

            @foreach($errors->all() as $error)

                <div>
                    {{ $error }}
                </div>

            @endforeach

        </div>

    </div>

@endif


{{-- ==========================================================
    STATISTICS
=========================================================== --}}

<div class="lesson-assignments-statistics">

    <div class="lesson-assignments-stat-card">

        <div class="lesson-assignments-stat-icon">

            <i class="fa-solid fa-layer-group"></i>

        </div>

        <div>

            <span class="lesson-assignments-stat-label">
                {{ __('education_admin.lesson_assignments.statistics.total') }}
            </span>

            <strong>
                {{ number_format($statistics['total'] ?? 0) }}
            </strong>

        </div>

    </div>


    <div class="lesson-assignments-stat-card">

        <div class="lesson-assignments-stat-icon assigned">

            <i class="fa-solid fa-clock"></i>

        </div>

        <div>

            <span class="lesson-assignments-stat-label">
                {{ __('education_admin.lesson_assignments.statistics.assigned') }}
            </span>

            <strong>
                {{ number_format($statistics['assigned'] ?? 0) }}
            </strong>

        </div>

    </div>


    <div class="lesson-assignments-stat-card">

        <div class="lesson-assignments-stat-icon progress">

            <i class="fa-solid fa-spinner"></i>

        </div>

        <div>

            <span class="lesson-assignments-stat-label">
                {{ __('education_admin.lesson_assignments.statistics.in_progress') }}
            </span>

            <strong>
                {{ number_format($statistics['in_progress'] ?? 0) }}
            </strong>

        </div>

    </div>


    <div class="lesson-assignments-stat-card">

        <div class="lesson-assignments-stat-icon completed">

            <i class="fa-solid fa-circle-check"></i>

        </div>

        <div>

            <span class="lesson-assignments-stat-label">
                {{ __('education_admin.lesson_assignments.statistics.completed') }}
            </span>

            <strong>
                {{ number_format($statistics['completed'] ?? 0) }}
            </strong>

        </div>

    </div>

</div>


{{-- ==========================================================
    FILTERS
=========================================================== --}}

<div class="lesson-assignments-filter-card">

    <form
        action="{{ route('education.admin.lesson-assignments.index') }}"
        method="GET"
        class="lesson-assignments-filter-form"
    >

        <div class="lesson-assignments-search">

            <i class="fa-solid fa-magnifying-glass"></i>

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="{{ __('education_admin.lesson_assignments.filters.search_placeholder') }}"
            >

        </div>


        <select
            name="status"
            class="lesson-assignments-status-filter"
        >

            <option value="">
                {{ __('education_admin.lesson_assignments.filters.all_statuses') }}
            </option>

            <option
                value="assigned"
                @selected(request('status') === 'assigned')
            >
                {{ __('education_admin.lesson_assignments.filters.assigned') }}
            </option>

            <option
                value="in_progress"
                @selected(request('status') === 'in_progress')
            >
                {{ __('education_admin.lesson_assignments.filters.in_progress') }}
            </option>

            <option
                value="completed"
                @selected(request('status') === 'completed')
            >
                {{ __('education_admin.lesson_assignments.filters.completed') }}
            </option>

        </select>


        <button
            type="submit"
            class="lesson-assignments-filter-btn"
        >

            <i class="fa-solid fa-filter"></i>

            {{ __('education_admin.lesson_assignments.filters.search') }}

        </button>


        @if(request()->filled('search') || request()->filled('status'))

            <a
                href="{{ route('education.admin.lesson-assignments.index') }}"
                class="lesson-assignments-reset-btn"
            >

                <i class="fa-solid fa-rotate-left"></i>

                {{ __('education_admin.lesson_assignments.filters.reset') }}

            </a>

        @endif

    </form>

</div>


{{-- ==========================================================
    TABLE
=========================================================== --}}

<div class="lesson-assignments-table-card">

    <div class="lesson-assignments-table-header">

        <div>

            <h2>
                {{ __('education_admin.lesson_assignments.table.title') }}
            </h2>

            <p>
                {{ __('education_admin.lesson_assignments.table.description') }}
            </p>

        </div>


        <div class="lesson-assignments-results-count">

            {{ $assignments->total() }}

            {{ __('education_admin.lesson_assignments.table.results') }}

        </div>

    </div>


    @if($assignments->count())

        <div class="lesson-assignments-table-wrapper">

            <table class="lesson-assignments-table">

                <thead>

                    <tr>

                        <th>
                            {{ __('education_admin.lesson_assignments.table.student') }}
                        </th>

                        <th>
                            {{ __('education_admin.lesson_assignments.table.lesson') }}
                        </th>

                        <th>
                            {{ __('education_admin.lesson_assignments.table.booking') }}
                        </th>

                        <th>
                            {{ __('education_admin.lesson_assignments.table.status') }}
                        </th>

                        <th>
                            {{ __('education_admin.lesson_assignments.table.assigned_at') }}
                        </th>

                        <th>
                            {{ __('education_admin.lesson_assignments.table.student_lesson') }}
                        </th>

                        <th>
                            {{ __('education_admin.lesson_assignments.table.actions') }}
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @foreach($assignments as $assignment)

                        <tr>

                            {{-- ==================================================
                                STUDENT
                            =================================================== --}}

                            <td>

                                <div class="lesson-assignments-student">

                                    <div class="lesson-assignments-avatar">

                                        <i class="fa-solid fa-user-graduate"></i>

                                    </div>


                                    <div>

                                        <strong>
                                            {{ $assignment->student?->name ?? __('education_admin.lesson_assignments.student.unknown') }}
                                        </strong>

                                        @if($assignment->student?->email)

                                            <span>
                                                {{ $assignment->student->email }}
                                            </span>

                                        @endif

                                    </div>

                                </div>

                            </td>


                            {{-- ==================================================
                                STUDENT LESSON
                            =================================================== --}}

                            <td>

                                @if($assignment->studentLesson)

                                    <div class="lesson-assignments-lesson">

                                        <strong>
                                            {{ $assignment->studentLesson->title ?? __('education_admin.lesson_assignments.lesson.untitled') }}
                                        </strong>

                                        @if($assignment->studentLesson->description)

                                            <span>
                                                {{ \Illuminate\Support\Str::limit(
                                                    $assignment->studentLesson->description,
                                                    70
                                                ) }}
                                            </span>

                                        @endif

                                    </div>

                                @else

                                    <div class="lesson-assignments-lesson">

                                        <strong class="lesson-assignments-pending-title">
                                            {{ __('education_admin.lesson_assignments.lesson.not_created') }}
                                        </strong>

                                        <span>
                                            {{ __('education_admin.lesson_assignments.lesson.pending_creation') }}
                                        </span>

                                    </div>

                                @endif

                            </td>


                            {{-- ==================================================
                                BOOKING
                            =================================================== --}}

                            <td>

                                @if($assignment->booking)

                                    <div class="lesson-assignments-booking">

                                        <span class="booking-number">
                                            #{{ $assignment->booking->id }}
                                        </span>

                                    </div>

                                @else

                                    <span class="lesson-assignments-empty">
                                        {{ __('education_admin.lesson_assignments.booking.without_booking') }}
                                    </span>

                                @endif

                            </td>


                            {{-- ==================================================
                                STATUS
                            =================================================== --}}

                            <td>

                                @switch($assignment->status)

                                    @case('assigned')

                                        <span class="lesson-assignments-status assigned">

                                            <i class="fa-solid fa-clock"></i>

                                            {{ __('education_admin.lesson_assignments.status.assigned') }}

                                        </span>

                                        @break


                                    @case('in_progress')

                                        <span class="lesson-assignments-status progress">

                                            <i class="fa-solid fa-spinner"></i>

                                            {{ __('education_admin.lesson_assignments.status.in_progress') }}

                                        </span>

                                        @break


                                    @case('completed')

                                        <span class="lesson-assignments-status completed">

                                            <i class="fa-solid fa-circle-check"></i>

                                            {{ __('education_admin.lesson_assignments.status.completed') }}

                                        </span>

                                        @break


                                    @default

                                        <span class="lesson-assignments-status">

                                            {{ $assignment->status ?? __('education_admin.lesson_assignments.status.unknown') }}

                                        </span>

                                @endswitch

                            </td>


                            {{-- ==================================================
                                ASSIGNED AT
                            =================================================== --}}

                            <td>

                                @if($assignment->assigned_at)

                                    <div class="lesson-assignments-date">

                                        <strong>
                                            {{ $assignment->assigned_at->format('Y/m/d') }}
                                        </strong>

                                        <span>
                                            {{ $assignment->assigned_at->format('h:i A') }}
                                        </span>

                                    </div>

                                @else

                                    <span class="lesson-assignments-empty">
                                        —
                                    </span>

                                @endif

                            </td>


                            {{-- ==================================================
                                STUDENT LESSON STATUS
                            =================================================== --}}

                            <td>

                                @if($assignment->studentLesson)

                                    @switch($assignment->studentLesson->status)

                                        @case('assigned')

                                            <span class="lesson-assignments-student-lesson pending">

                                                <i class="fa-solid fa-clock"></i>

                                                {{ __('education_admin.lesson_assignments.student_lesson_status.assigned') }}

                                            </span>

                                            @break

                                        @case('in_progress')

                                            <span class="lesson-assignments-student-lesson progress">

                                                <i class="fa-solid fa-book-open"></i>

                                                {{ __('education_admin.lesson_assignments.student_lesson_status.in_progress') }}

                                            </span>

                                            @break

                                        @case('completed')

                                            <span class="lesson-assignments-student-lesson created">

                                                <i class="fa-solid fa-circle-check"></i>

                                                {{ __('education_admin.lesson_assignments.student_lesson_status.completed') }}

                                            </span>

                                            @break

                                        @case('cancelled')

                                            <span class="lesson-assignments-student-lesson cancelled">

                                                <i class="fa-solid fa-ban"></i>

                                                {{ __('education_admin.lesson_assignments.student_lesson_status.cancelled') }}

                                            </span>

                                            @break

                                        @default

                                            <span class="lesson-assignments-student-lesson">

                                                {{ $assignment->studentLesson->status ?? __('education_admin.lesson_assignments.student_lesson_status.unknown') }}

                                            </span>

                                    @endswitch

                                @else

                                    <span class="lesson-assignments-student-lesson pending">

                                        <i class="fa-regular fa-circle"></i>

                                        {{ __('education_admin.lesson_assignments.student_lesson_status.not_created') }}

                                    </span>

                                @endif

                            </td>


                            {{-- ==================================================
                                ACTIONS
                            =================================================== --}}

                            <td>

                                <div class="lesson-assignments-actions">

                                    {{-- VIEW ASSIGNMENT --}}

                                    <a
                                        href="{{ route(
                                            'education.admin.lesson-assignments.show',
                                            $assignment
                                        ) }}"
                                        class="lesson-assignments-action view"
                                        title="{{ __('education_admin.lesson_assignments.actions.view_assignment') }}"
                                    >

                                        <i class="fa-solid fa-eye"></i>

                                    </a>


                                    {{-- CREATE STUDENT LESSON --}}

                                    @if(!$assignment->studentLesson)

                                        <a
                                            href="{{ route(
                                                'education.admin.student-lessons.create-from-assignment',
                                                $assignment
                                            ) }}"
                                            class="lesson-assignments-action lesson"
                                            title="{{ __('education_admin.lesson_assignments.actions.create_student_lesson') }}"
                                        >

                                            <i class="fa-solid fa-user-pen"></i>

                                        </a>

                                    @else

                                        <a
                                            href="{{ route(
                                                'education.admin.student-lessons.show',
                                                $assignment->studentLesson
                                            ) }}"
                                            class="lesson-assignments-action lesson-created"
                                            title="{{ __('education_admin.lesson_assignments.actions.view_student_lesson') }}"
                                        >

                                            <i class="fa-solid fa-book-open-reader"></i>

                                        </a>

                                    @endif

                                </div>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>


        {{-- ==========================================================
            PAGINATION
        =========================================================== --}}

        @if($assignments->hasPages())

            <div class="lesson-assignments-pagination">

                {{ $assignments->withQueryString()->links() }}

            </div>

        @endif

    @else

        <div class="lesson-assignments-empty-state">

            <div class="lesson-assignments-empty-icon">

                <i class="fa-solid fa-layer-group"></i>

            </div>


            <h3>
                {{ __('education_admin.lesson_assignments.empty.title') }}
            </h3>


            <p>
                {{ __('education_admin.lesson_assignments.empty.description') }}
            </p>


            <a
                href="{{ route('education.admin.lesson-assignments.create') }}"
                class="lesson-assignments-empty-btn"
            >

                <i class="fa-solid fa-plus"></i>

                {{ __('education_admin.lesson_assignments.empty.assign_new') }}

            </a>

        </div>

    @endif

</div>


</div>

@push('styles')

<style>

/* ==========================================================
   PAGE
========================================================== */

.education-lesson-assignments-page {

    min-height: 100vh;
    padding: 30px;
    background: #f7f3e9;
    color: #26352d;

}


/* ==========================================================
   HEADER
========================================================== */

.education-lesson-assignments-header {

    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 25px;

}


.education-lesson-assignments-breadcrumb {

    display: flex;
    align-items: center;
    gap: 9px;
    margin-bottom: 11px;
    color: #9c7a32;
    font-size: 13px;
    font-weight: 700;

}


.education-lesson-assignments-breadcrumb i {

    font-size: 11px;

}


.education-lesson-assignments-header h1 {

    margin: 0;
    color: #214b3a;
    font-size: 31px;
    font-weight: 800;

}


.education-lesson-assignments-header p {

    margin: 8px 0 0;
    color: #718078;
    font-size: 14px;

}


/* ==========================================================
   CREATE BUTTON
========================================================== */

.lesson-assignments-create-btn {

    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    min-height: 46px;
    padding: 0 19px;
    border-radius: 11px;
    background: #214b3a;
    color: #fff !important;
    text-decoration: none;
    font-size: 13px;
    font-weight: 800;
    white-space: nowrap;
    transition: .18s ease;

}


.lesson-assignments-create-btn:hover {

    background: #173b2d;
    color: #fff !important;
    transform: translateY(-1px);

}


/* ==========================================================
   ALERTS
========================================================== */

.lesson-assignments-alert {

    display: flex;
    align-items: flex-start;
    gap: 10px;
    margin-bottom: 20px;
    padding: 14px 17px;
    border-radius: 12px;
    font-size: 14px;
    font-weight: 700;

}


.lesson-assignments-alert-success {

    background: #e9f5ed;
    border: 1px solid #cde7d5;
    color: #27613e;

}


.lesson-assignments-alert-error {

    background: #fbeded;
    border: 1px solid #edcccc;
    color: #8d3939;

}


.lesson-assignments-alert-info {

    background: #edf5f6;
    border: 1px solid #d2e5e7;
    color: #35646a;

}


/* ==========================================================
   STATISTICS
========================================================== */

.lesson-assignments-statistics {

    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 15px;
    margin-bottom: 22px;

}


.lesson-assignments-stat-card {

    display: flex;
    align-items: center;
    gap: 13px;
    padding: 18px;
    background: #fff;
    border: 1px solid #e8e0ce;
    border-radius: 15px;
    box-shadow: 0 7px 25px rgba(33, 75, 58, .045);

}


.lesson-assignments-stat-icon {

    width: 45px;
    height: 45px;
    flex: 0 0 45px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 13px;
    background: #f3ead2;
    color: #9c7a32;

}


.lesson-assignments-stat-icon.assigned {

    background: #f7f0dc;
    color: #a07c2d;

}


.lesson-assignments-stat-icon.progress {

    background: #eaf3ee;
    color: #357052;

}


.lesson-assignments-stat-icon.completed {

    background: #e5f3e9;
    color: #277044;

}


.lesson-assignments-stat-label {

    display: block;
    margin-bottom: 4px;
    color: #7a847e;
    font-size: 12px;

}


.lesson-assignments-stat-card strong {

    color: #214b3a;
    font-size: 22px;
    font-weight: 800;

}


/* ==========================================================
   FILTERS
========================================================== */

.lesson-assignments-filter-card {

    margin-bottom: 20px;
    padding: 16px;
    background: #fff;
    border: 1px solid #e8e0ce;
    border-radius: 15px;

}


.lesson-assignments-filter-form {

    display: flex;
    align-items: center;
    gap: 10px;

}


.lesson-assignments-search {

    position: relative;
    flex: 1;

}


.lesson-assignments-search i {

    position: absolute;
    top: 50%;
    right: 15px;
    transform: translateY(-50%);
    color: #9a9f9b;
    pointer-events: none;

}


.lesson-assignments-search input {

    width: 100%;
    height: 46px;
    padding: 0 43px 0 14px;
    box-sizing: border-box;
    border: 1px solid #ded6c5;
    border-radius: 10px;
    outline: none;
    color: #263b31;
    background: #fff;

}


.lesson-assignments-search input:focus {

    border-color: #9c7a32;
    box-shadow: 0 0 0 3px rgba(156, 122, 50, .08);

}


.lesson-assignments-status-filter {

    width: 190px;
    height: 46px;
    padding: 0 13px;
    border: 1px solid #ded6c5;
    border-radius: 10px;
    background: #fff;
    color: #35483e;
    outline: none;

}


.lesson-assignments-filter-btn,
.lesson-assignments-reset-btn {

    height: 46px;
    padding: 0 17px;
    border-radius: 10px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;

}


.lesson-assignments-filter-btn {

    border: 0;
    background: #214b3a;
    color: #fff;
    cursor: pointer;

}


.lesson-assignments-filter-btn:hover {

    background: #173b2d;

}


.lesson-assignments-reset-btn {

    background: #eee9dc;
    color: #4b5b52;

}


.lesson-assignments-reset-btn:hover {

    background: #e5dece;
    color: #35483e;

}


/* ==========================================================
   TABLE CARD
========================================================== */

.lesson-assignments-table-card {

    background: #fff;
    border: 1px solid #e8e0ce;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 10px 35px rgba(33, 75, 58, .05);

}


.lesson-assignments-table-header {

    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 21px 23px;
    border-bottom: 1px solid #eee8da;

}


.lesson-assignments-table-header h2 {

    margin: 0;
    color: #214b3a;
    font-size: 19px;
    font-weight: 800;

}


.lesson-assignments-table-header p {

    margin: 5px 0 0;
    color: #818b85;
    font-size: 12px;

}


.lesson-assignments-results-count {

    padding: 8px 13px;
    border-radius: 9px;
    background: #f7f3e9;
    color: #876b2e;
    font-size: 12px;
    font-weight: 700;

}


/* ==========================================================
   TABLE
========================================================== */

.lesson-assignments-table-wrapper {

    overflow-x: auto;

}


.lesson-assignments-table {

    width: 100%;
    min-width: 1000px;
    border-collapse: collapse;

}


.lesson-assignments-table th {

    padding: 14px 16px;
    background: #faf8f2;
    border-bottom: 1px solid #eee8da;
    color: #647069;
    font-size: 12px;
    font-weight: 800;
    text-align: right;
    white-space: nowrap;

}


.lesson-assignments-table td {

    padding: 15px 16px;
    border-bottom: 1px solid #f0ece3;
    vertical-align: middle;

}


.lesson-assignments-table tbody tr {

    transition: background .18s ease;

}


.lesson-assignments-table tbody tr:hover {

    background: #fcfbf7;

}


.lesson-assignments-table tbody tr:last-child td {

    border-bottom: 0;

}


/* ==========================================================
   STUDENT
========================================================== */

.lesson-assignments-student {

    display: flex;
    align-items: center;
    gap: 10px;
    min-width: 175px;

}


.lesson-assignments-avatar {

    width: 39px;
    height: 39px;
    flex: 0 0 39px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 11px;
    background: #eaf1ed;
    color: #214b3a;

}


.lesson-assignments-student strong {

    display: block;
    color: #30443a;
    font-size: 13px;

}


.lesson-assignments-student span {

    display: block;
    margin-top: 3px;
    color: #8a928d;
    font-size: 10px;

}


/* ==========================================================
   STUDENT LESSON
========================================================== */

.lesson-assignments-lesson {

    min-width: 210px;

}


.lesson-assignments-lesson strong {

    display: block;
    color: #30443a;
    font-size: 13px;

}


.lesson-assignments-lesson span {

    display: block;
    max-width: 270px;
    margin-top: 4px;
    color: #9a9e9b;
    font-size: 10px;
    line-height: 1.6;

}


.lesson-assignments-pending-title {

    color: #9c7a32 !important;

}


/* ==========================================================
   BOOKING
========================================================== */

.lesson-assignments-booking {

    display: inline-flex;

}


.booking-number {

    display: inline-flex;
    padding: 6px 9px;
    border-radius: 7px;
    background: #f4eedf;
    color: #896c2e;
    font-size: 11px;
    font-weight: 800;

}


.lesson-assignments-empty {

    color: #aaa;
    font-size: 12px;

}


/* ==========================================================
   STATUS
========================================================== */

.lesson-assignments-status {

    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 7px 10px;
    border-radius: 8px;
    font-size: 11px;
    font-weight: 800;
    white-space: nowrap;

}


.lesson-assignments-status.assigned {

    background: #f7f0dc;
    color: #8d6c27;

}


.lesson-assignments-status.progress {

    background: #eaf3ee;
    color: #357052;

}


.lesson-assignments-status.completed {

    background: #e5f3e9;
    color: #277044;

}


/* ==========================================================
   DATE
========================================================== */

.lesson-assignments-date strong {

    display: block;
    color: #48574f;
    font-size: 11px;

}


.lesson-assignments-date span {

    display: block;
    margin-top: 3px;
    color: #969c98;
    font-size: 10px;

}


/* ==========================================================
   STUDENT LESSON STATUS
========================================================== */

.lesson-assignments-student-lesson {

    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 7px 10px;
    border-radius: 8px;
    font-size: 11px;
    font-weight: 800;
    white-space: nowrap;

}


.lesson-assignments-student-lesson.created {

    background: #e5f3e9;
    color: #277044;

}


.lesson-assignments-student-lesson.progress {

    background: #eaf3ee;
    color: #357052;

}


.lesson-assignments-student-lesson.pending {

    background: #f5f1e7;
    color: #93845f;

}


.lesson-assignments-student-lesson.cancelled {

    background: #fbeded;
    color: #934848;

}


/* ==========================================================
   ACTIONS
========================================================== */

.lesson-assignments-actions {

    display: flex;
    align-items: center;
    gap: 6px;

}


.lesson-assignments-action {

    width: 34px;
    height: 34px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 9px;
    text-decoration: none;
    transition: .18s ease;

}


.lesson-assignments-action.view {

    background: #eaf1ed;
    color: #214b3a;

}


.lesson-assignments-action.view:hover {

    background: #dce9e1;

}


.lesson-assignments-action.lesson {

    background: #f5efdf;
    color: #9c7a32;

}


.lesson-assignments-action.lesson:hover {

    background: #eee3c7;

}


.lesson-assignments-action.lesson-created {

    background: #e5f3e9;
    color: #277044;

}


.lesson-assignments-action.lesson-created:hover {

    background: #d7ebdc;

}


/* ==========================================================
   EMPTY STATE
========================================================== */

.lesson-assignments-empty-state {

    padding: 75px 25px;
    text-align: center;

}


.lesson-assignments-empty-icon {

    width: 75px;
    height: 75px;
    margin: 0 auto 17px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 22px;
    background: #f3ead2;
    color: #9c7a32;
    font-size: 29px;

}


.lesson-assignments-empty-state h3 {

    margin: 0;
    color: #214b3a;
    font-size: 19px;

}


.lesson-assignments-empty-state p {

    margin: 7px 0 20px;
    color: #858e88;
    font-size: 13px;

}


.lesson-assignments-empty-btn {

    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    min-height: 42px;
    padding: 0 16px;
    border-radius: 10px;
    background: #214b3a;
    color: #fff !important;
    text-decoration: none;
    font-size: 12px;
    font-weight: 800;

}


.lesson-assignments-empty-btn:hover {

    background: #173b2d;
    color: #fff !important;

}


/* ==========================================================
   PAGINATION
========================================================== */

.lesson-assignments-pagination {

    padding: 18px 22px;
    border-top: 1px solid #eee8da;

}


/* ==========================================================
   RESPONSIVE
========================================================== */

@media (max-width: 1100px) {

    .lesson-assignments-statistics {

        grid-template-columns: repeat(2, minmax(0, 1fr));

    }

}


@media (max-width: 850px) {

    .education-lesson-assignments-page {

        padding: 20px;

    }


    .education-lesson-assignments-header {

        align-items: flex-start;
        flex-direction: column;

    }


    .lesson-assignments-filter-form {

        flex-wrap: wrap;

    }


    .lesson-assignments-search {

        flex: 1 1 100%;

    }


    .lesson-assignments-status-filter {

        flex: 1;

    }

}


@media (max-width: 550px) {

    .education-lesson-assignments-page {

        padding: 15px;

    }


    .education-lesson-assignments-header h1 {

        font-size: 25px;

    }


    .lesson-assignments-statistics {

        grid-template-columns: 1fr;

    }


    .lesson-assignments-filter-form {

        flex-direction: column;
        align-items: stretch;

    }


    .lesson-assignments-status-filter {

        width: 100%;

    }


    .lesson-assignments-filter-btn,
    .lesson-assignments-reset-btn {

        width: 100%;

    }


    .lesson-assignments-create-btn {

        width: 100%;

    }


    .lesson-assignments-table-header {

        align-items: flex-start;
        gap: 10px;
        flex-direction: column;

    }

}

</style>

@endpush

@endsection
