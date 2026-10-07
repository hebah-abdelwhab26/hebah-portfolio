@extends('education.admin.layouts.app')

@section('page_title', __('education_admin.students_show.page_title'))

@section('title', __('education_admin.students_show.page_title'))

@section('content')

<div class="education-admin-student-show-page">

{{-- ==================================================
    PAGE HEADER
================================================== --}}

<div class="education-admin-student-show-header">

    <div class="education-admin-student-show-heading">

        <a
            href="{{ route('education.admin.students.index') }}"
            class="education-admin-student-back"
        >
            <i class="fa-solid fa-arrow-right"></i>

            <span>
                {{ __('education_admin.students_show.header.back') }}
            </span>
        </a>

        <span class="education-admin-page-header-label">
            {{ __('education_admin.students_show.header.eyebrow') }}
        </span>

        <h2>
            {{ __('education_admin.students_show.header.title') }}
        </h2>

        <p>
            {{ __('education_admin.students_show.header.description') }}
        </p>

    </div>


    {{-- ACTIONS --}}

    <div class="education-admin-student-show-actions">

        @if(Route::has('education.admin.students.edit'))

            <a
                href="{{ route('education.admin.students.edit', $student) }}"
                class="education-admin-student-show-edit"
            >
                <i class="fa-solid fa-pen"></i>

                <span>
                    {{ __('education_admin.students_show.actions.edit') }}
                </span>
            </a>

        @endif

    </div>

</div>


{{-- ==================================================
    ALERTS
================================================== --}}

@if(session('success'))

    <div class="education-admin-alert education-admin-alert-success">

        <i class="fa-solid fa-circle-check"></i>

        <span>
            {{ session('success') }}
        </span>

    </div>

@endif


@if(session('error'))

    <div class="education-admin-alert education-admin-alert-error">

        <i class="fa-solid fa-circle-exclamation"></i>

        <span>
            {{ session('error') }}
        </span>

    </div>

@endif


{{-- ==================================================
    TEMPORARY PASSWORD
================================================== --}}

@if(session('temporary_password'))

    <div class="education-admin-alert education-admin-alert-success">

        <i class="fa-solid fa-key"></i>

        <div>

            <strong>
                {{ __('education_admin.students_show.temporary_password.title') }}
            </strong>

            <span>
                {{ __('education_admin.students_show.temporary_password.message') }}
            </span>

            <strong dir="ltr">
                {{ session('temporary_password') }}
            </strong>

            <small>
                {{ __('education_admin.students_show.temporary_password.note') }}
            </small>

        </div>

    </div>

@endif


{{-- ==================================================
    MAIN GRID
================================================== --}}

<div class="education-admin-student-show-grid">


    {{-- ==================================================
        STUDENT PROFILE
    ================================================== --}}

    <div class="education-admin-student-profile-card">

        <div class="education-admin-student-profile-top">

            {{-- AVATAR --}}

            <div class="education-admin-student-profile-avatar">

                @if(!empty($student->avatar))

                    <img
                        src="{{ asset($student->avatar) }}"
                        alt="{{ $student->name }}"
                    >

                @else

                    <span>
                        {{ mb_strtoupper(
                            mb_substr(
                                $student->name ?? 'ط',
                                0,
                                1
                            )
                        ) }}
                    </span>

                @endif

            </div>


            {{-- PROFILE MAIN --}}

            <div class="education-admin-student-profile-main">

                <span>
                    {{ __('education_admin.students_show.profile.role') }}
                </span>

                <h3>
                    {{ $student->name ?: __('education_admin.students_show.profile.no_name') }}
                </h3>

                <small>
                    #{{ $student->id }}
                </small>

            </div>


            {{-- ACCOUNT STATUS --}}

            @if($student->is_active)

                <span class="education-admin-student-profile-status active">

                    <i class="fa-solid fa-circle"></i>

                    {{ __('education_admin.students_show.statuses.account.active') }}

                </span>

            @else

                <span class="education-admin-student-profile-status inactive">

                    <i class="fa-solid fa-circle"></i>

                    {{ __('education_admin.students_show.statuses.account.inactive') }}

                </span>

            @endif

        </div>


        {{-- ==================================================
            QUICK INFO
        ================================================== --}}

        <div class="education-admin-student-profile-info">


            {{-- EMAIL --}}

            @if($student->email)

                <div class="education-admin-student-profile-info-item">

                    <div class="education-admin-student-profile-info-icon">

                        <i class="fa-regular fa-envelope"></i>

                    </div>

                    <div>

                        <span>
                            {{ __('education_admin.students_show.info.email') }}
                        </span>

                        <strong>
                            {{ $student->email }}
                        </strong>

                    </div>

                </div>

            @endif


            {{-- PHONE --}}

            @if($student->phone)

                <div class="education-admin-student-profile-info-item">

                    <div class="education-admin-student-profile-info-icon">

                        <i class="fa-solid fa-phone"></i>

                    </div>

                    <div>

                        <span>
                            {{ __('education_admin.students_show.info.phone') }}
                        </span>

                        <strong dir="ltr">
                            {{ $student->phone }}
                        </strong>

                    </div>

                </div>

            @endif


            {{-- WHATSAPP --}}

            @if(!empty($student->whatsapp_number))

                <div class="education-admin-student-profile-info-item">

                    <div class="education-admin-student-profile-info-icon whatsapp">

                        <i class="fa-brands fa-whatsapp"></i>

                    </div>

                    <div>

                        <span>
                            {{ __('education_admin.students_show.info.whatsapp') }}
                        </span>

                        <strong dir="ltr">
                            {{ $student->whatsapp_number }}
                        </strong>

                    </div>

                </div>

            @endif


            {{-- EDUCATION LEVEL --}}

            <div class="education-admin-student-profile-info-item">

                <div class="education-admin-student-profile-info-icon education">

                    <i class="fa-solid fa-graduation-cap"></i>

                </div>

                <div>

                    <span>
                        {{ __('education_admin.students_show.info.education_level') }}
                    </span>

                    <strong>
                        {{ $student->education_level ?: __('education_admin.students_show.common.not_specified') }}
                    </strong>

                </div>

            </div>


            {{-- STUDENT APPROVAL STATUS --}}

            <div class="education-admin-student-profile-info-item">

                <div class="education-admin-student-profile-info-icon">

                    @if($student->student_status === 'approved')

                        <i class="fa-solid fa-user-check"></i>

                    @elseif($student->student_status === 'pending')

                        <i class="fa-solid fa-user-clock"></i>

                    @elseif($student->student_status === 'rejected')

                        <i class="fa-solid fa-user-xmark"></i>

                    @else

                        <i class="fa-solid fa-user"></i>

                    @endif

                </div>

                <div>

                    <span>
                        {{ __('education_admin.students_show.info.approval_status') }}
                    </span>

                    @if($student->student_status === 'approved')

                        <strong>
                            {{ __('education_admin.students_show.statuses.approval.approved') }}
                        </strong>

                    @elseif($student->student_status === 'pending')

                        <strong>
                            {{ __('education_admin.students_show.statuses.approval.pending') }}
                        </strong>

                    @elseif($student->student_status === 'rejected')

                        <strong>
                            {{ __('education_admin.students_show.statuses.approval.rejected') }}
                        </strong>

                    @else

                        <strong>
                            {{ __('education_admin.students_show.statuses.approval.unknown') }}
                        </strong>

                    @endif

                </div>

            </div>


            {{-- REGISTER DATE --}}

            <div class="education-admin-student-profile-info-item">

                <div class="education-admin-student-profile-info-icon date">

                    <i class="fa-regular fa-calendar"></i>

                </div>

                <div>

                    <span>
                        {{ __('education_admin.students_show.info.registered_at') }}
                    </span>

                    <strong>
                        {{ optional($student->created_at)->format('Y/m/d') }}
                    </strong>

                </div>

            </div>

        </div>

    </div>


    {{-- ==================================================
        STATISTICS
    ================================================== --}}

    <div class="education-admin-student-show-side">


        {{-- BOOKINGS --}}

        <div class="education-admin-student-show-stat">

            <div class="education-admin-student-show-stat-icon bookings">

                <i class="fa-regular fa-calendar-check"></i>

            </div>

            <div>

                <span>
                    {{ __('education_admin.students_show.statistics.bookings') }}
                </span>

                <strong>
                    {{ $student->bookings_count ?? ($student->bookings?->count() ?? 0) }}
                </strong>

            </div>

        </div>


        {{-- LEVEL --}}

        <div class="education-admin-student-show-stat">

            <div class="education-admin-student-show-stat-icon level">

                <i class="fa-solid fa-graduation-cap"></i>

            </div>

            <div>

                <span>
                    {{ __('education_admin.students_show.statistics.level') }}
                </span>

                <strong class="text-value">
                    {{ $student->education_level ?: __('education_admin.students_show.common.not_specified') }}
                </strong>

            </div>

        </div>


        {{-- ACCOUNT STATUS --}}

        <div class="education-admin-student-show-stat">

            <div class="education-admin-student-show-stat-icon status">

                <i class="fa-solid fa-user-check"></i>

            </div>

            <div>

                <span>
                    {{ __('education_admin.students_show.statistics.account_status') }}
                </span>

                <strong class="text-value">
                    {{ $student->is_active
                        ? __('education_admin.students_show.statuses.account.active')
                        : __('education_admin.students_show.statuses.account.inactive') }}
                </strong>

            </div>

        </div>


        {{-- STUDENT APPROVAL STATUS --}}

        <div class="education-admin-student-show-stat">

            <div class="education-admin-student-show-stat-icon status">

                @if($student->student_status === 'approved')

                    <i class="fa-solid fa-circle-check"></i>

                @elseif($student->student_status === 'pending')

                    <i class="fa-solid fa-clock"></i>

                @elseif($student->student_status === 'rejected')

                    <i class="fa-solid fa-circle-xmark"></i>

                @else

                    <i class="fa-solid fa-circle-question"></i>

                @endif

            </div>

            <div>

                <span>
                    {{ __('education_admin.students_show.statistics.approval_status') }}
                </span>

                <strong class="text-value">

                    @if($student->student_status === 'approved')

                        {{ __('education_admin.students_show.statuses.approval.approved') }}

                    @elseif($student->student_status === 'pending')

                        {{ __('education_admin.students_show.statuses.approval.pending') }}

                    @elseif($student->student_status === 'rejected')

                        {{ __('education_admin.students_show.statuses.approval.rejected') }}

                    @else

                        {{ __('education_admin.students_show.statuses.approval.unknown') }}

                    @endif

                </strong>

            </div>

        </div>

    </div>

</div>


{{-- ==================================================
    STUDENT DETAILS
================================================== --}}

<div class="education-admin-student-details-card">

    <div class="education-admin-student-details-header">

        <div>

            <span>
                {{ __('education_admin.students_show.details.eyebrow') }}
            </span>

            <h3>
                {{ __('education_admin.students_show.details.title') }}
            </h3>

        </div>

        <i class="fa-solid fa-user-graduate"></i>

    </div>


    <div class="education-admin-student-details-grid">


        {{-- NAME --}}

        <div class="education-admin-student-detail-item">

            <span>
                {{ __('education_admin.students_show.details.fields.full_name') }}
            </span>

            <strong>
                {{ $student->name ?: __('education_admin.students_show.common.not_specified') }}
            </strong>

        </div>


        {{-- EMAIL --}}

        <div class="education-admin-student-detail-item">

            <span>
                {{ __('education_admin.students_show.details.fields.email') }}
            </span>

            <strong>
                {{ $student->email ?: __('education_admin.students_show.common.not_specified') }}
            </strong>

        </div>


        {{-- PHONE --}}

        <div class="education-admin-student-detail-item">

            <span>
                {{ __('education_admin.students_show.details.fields.phone') }}
            </span>

            <strong dir="ltr">
                {{ $student->phone ?: __('education_admin.students_show.common.not_specified') }}
            </strong>

        </div>


        {{-- WHATSAPP --}}

        <div class="education-admin-student-detail-item">

            <span>
                {{ __('education_admin.students_show.details.fields.whatsapp') }}
            </span>

            <strong dir="ltr">
                {{ $student->whatsapp_number ?: __('education_admin.students_show.common.not_specified') }}
            </strong>

        </div>


        {{-- WHATSAPP REMINDERS --}}

        <div class="education-admin-student-detail-item">

            <span>
                {{ __('education_admin.students_show.details.fields.whatsapp_reminders') }}
            </span>

            @if($student->whatsapp_reminders_enabled)

                <strong class="detail-status active">

                    <i class="fa-solid fa-circle"></i>

                    {{ __('education_admin.students_show.statuses.whatsapp.active') }}

                </strong>

            @else

                <strong class="detail-status inactive">

                    <i class="fa-solid fa-circle"></i>

                    {{ __('education_admin.students_show.statuses.whatsapp.inactive') }}

                </strong>

            @endif

        </div>


        {{-- EDUCATION LEVEL --}}

        <div class="education-admin-student-detail-item">

            <span>
                {{ __('education_admin.students_show.details.fields.education_level') }}
            </span>

            <strong>
                {{ $student->education_level ?: __('education_admin.students_show.common.not_specified') }}
            </strong>

        </div>


        {{-- STUDENT STATUS --}}

        <div class="education-admin-student-detail-item">

            <span>
                {{ __('education_admin.students_show.details.fields.approval_status') }}
            </span>

            @if($student->student_status === 'approved')

                <strong class="detail-status active">

                    <i class="fa-solid fa-circle-check"></i>

                    {{ __('education_admin.students_show.statuses.approval.approved') }}

                </strong>

            @elseif($student->student_status === 'pending')

                <strong class="detail-status">

                    <i class="fa-solid fa-clock"></i>

                    {{ __('education_admin.students_show.statuses.approval.pending') }}

                </strong>

            @elseif($student->student_status === 'rejected')

                <strong class="detail-status inactive">

                    <i class="fa-solid fa-circle-xmark"></i>

                    {{ __('education_admin.students_show.statuses.approval.rejected') }}

                </strong>

            @else

                <strong>
                    {{ __('education_admin.students_show.statuses.approval.unknown') }}
                </strong>

            @endif

        </div>


        {{-- CREATED --}}

        <div class="education-admin-student-detail-item">

            <span>
                {{ __('education_admin.students_show.details.fields.registered_at') }}
            </span>

            <strong>
                {{ optional($student->created_at)->format('Y/m/d') }}
            </strong>

        </div>


        {{-- UPDATED --}}

        <div class="education-admin-student-detail-item">

            <span>
                {{ __('education_admin.students_show.details.fields.updated_at') }}
            </span>

            <strong>
                {{ optional($student->updated_at)->format('Y/m/d') }}
            </strong>

        </div>


        {{-- ACCOUNT STATUS --}}

        <div class="education-admin-student-detail-item">

            <span>
                {{ __('education_admin.students_show.details.fields.account_status') }}
            </span>

            @if($student->is_active)

                <strong class="detail-status active">

                    <i class="fa-solid fa-circle"></i>

                    {{ __('education_admin.students_show.statuses.account.active') }}

                </strong>

            @else

                <strong class="detail-status inactive">

                    <i class="fa-solid fa-circle"></i>

                    {{ __('education_admin.students_show.statuses.account.inactive') }}

                </strong>

            @endif

        </div>

    </div>

</div>


{{-- ==================================================
    LEARNING GOAL
================================================== --}}

<div class="education-admin-student-goal-card">

    <div class="education-admin-student-goal-header">

        <div class="education-admin-student-goal-icon">

            <i class="fa-solid fa-bullseye"></i>

        </div>

        <div>

            <span>
                {{ __('education_admin.students_show.learning_goal.eyebrow') }}
            </span>

            <h3>
                {{ __('education_admin.students_show.learning_goal.title') }}
            </h3>

        </div>

    </div>


    <div class="education-admin-student-goal-content">

        @if($student->learning_goal)

            <p>
                {{ $student->learning_goal }}
            </p>

        @else

            <p class="empty">
                {{ __('education_admin.students_show.learning_goal.empty') }}
            </p>

        @endif

    </div>

</div>


{{-- ==================================================
    STUDENT APPROVAL
================================================== --}}

<div class="education-admin-student-details-card">

    <div class="education-admin-student-details-header">

        <div>

            <span>
                {{ __('education_admin.students_show.approval.eyebrow') }}
            </span>

            <h3>
                {{ __('education_admin.students_show.approval.title') }}
            </h3>

        </div>

        <i class="fa-solid fa-user-shield"></i>

    </div>


    <div class="education-admin-student-details-grid">

        {{-- CURRENT STATUS --}}

        <div class="education-admin-student-detail-item">

            <span>
                {{ __('education_admin.students_show.approval.current_status') }}
            </span>

            @if($student->student_status === 'approved')

                <strong class="detail-status active">

                    <i class="fa-solid fa-circle-check"></i>

                    {{ __('education_admin.students_show.statuses.approval.approved') }}

                </strong>

            @elseif($student->student_status === 'pending')

                <strong class="detail-status">

                    <i class="fa-solid fa-clock"></i>

                    {{ __('education_admin.students_show.statuses.approval.pending') }}

                </strong>

            @elseif($student->student_status === 'rejected')

                <strong class="detail-status inactive">

                    <i class="fa-solid fa-circle-xmark"></i>

                    {{ __('education_admin.students_show.statuses.approval.rejected') }}

                </strong>

            @else

                <strong>
                    {{ __('education_admin.students_show.statuses.approval.unknown') }}
                </strong>

            @endif

        </div>


        {{-- ACCOUNT --}}

        <div class="education-admin-student-detail-item">

            <span>
                {{ __('education_admin.students_show.approval.account_status') }}
            </span>

            @if($student->is_active)

                <strong class="detail-status active">

                    <i class="fa-solid fa-circle-check"></i>

                    {{ __('education_admin.students_show.approval.account_active') }}

                </strong>

            @else

                <strong class="detail-status inactive">

                    <i class="fa-solid fa-circle-minus"></i>

                    {{ __('education_admin.students_show.approval.account_inactive') }}

                </strong>

            @endif

        </div>


        {{-- DESCRIPTION --}}

        <div class="education-admin-student-detail-item">

            <span>
                {{ __('education_admin.students_show.approval.description_label') }}
            </span>

            <strong>

                @if($student->student_status === 'approved')

                    {{ __('education_admin.students_show.approval.descriptions.approved') }}

                @elseif($student->student_status === 'pending')

                    {{ __('education_admin.students_show.approval.descriptions.pending') }}

                @elseif($student->student_status === 'rejected')

                    {{ __('education_admin.students_show.approval.descriptions.rejected') }}

                @else

                    {{ __('education_admin.students_show.approval.descriptions.unknown') }}

                @endif

            </strong>

        </div>

    </div>

</div>


{{-- ==================================================
    BOOKINGS
================================================== --}}

<div class="education-admin-student-bookings-card">

    <div class="education-admin-student-bookings-header">

        <div>

            <span>
                {{ __('education_admin.students_show.bookings.eyebrow') }}
            </span>

            <h3>
                {{ __('education_admin.students_show.bookings.title') }}
            </h3>

        </div>


        <div class="education-admin-student-bookings-total">

            <i class="fa-regular fa-calendar-check"></i>

            <strong>
                {{ $student->bookings_count ?? ($student->bookings?->count() ?? 0) }}
            </strong>

            <span>
                {{ __('education_admin.students_show.bookings.count_label') }}
            </span>

        </div>

    </div>


    @if($student->bookings && $student->bookings->count())

        <div class="education-admin-student-bookings-list">

            @foreach($student->bookings->take(5) as $booking)

                <div class="education-admin-student-booking-row">

                    <div class="education-admin-student-booking-icon">

                        <i class="fa-regular fa-calendar"></i>

                    </div>


                    <div class="education-admin-student-booking-info">

                        <strong>

                            @if(isset($booking->date))

                                {{ $booking->date }}

                            @elseif(isset($booking->booking_date))

                                {{ $booking->booking_date }}

                            @else

                                {{ __('education_admin.students_show.bookings.booking_number', [
                                    'id' => $booking->id
                                ]) }}

                            @endif

                        </strong>

                        <span>

                            @if(isset($booking->time))

                                {{ $booking->time }}

                            @elseif(isset($booking->booking_time))

                                {{ $booking->booking_time }}

                            @else

                                {{ __('education_admin.students_show.bookings.details') }}

                            @endif

                        </span>

                    </div>


                    {{-- BOOKING STATUS --}}

                    <div>

                        @php
                            $bookingStatus = $booking->status ?? null;
                        @endphp

                        @if($bookingStatus === 'confirmed')

                            <span class="education-admin-status success">
                                {{ __('education_admin.students_show.bookings.status.confirmed') }}
                            </span>

                        @elseif($bookingStatus === 'pending')

                            <span class="education-admin-status warning">
                                {{ __('education_admin.students_show.bookings.status.pending') }}
                            </span>

                        @elseif($bookingStatus === 'cancelled')

                            <span class="education-admin-status danger">
                                {{ __('education_admin.students_show.bookings.status.cancelled') }}
                            </span>

                        @elseif($bookingStatus === 'completed')

                            <span class="education-admin-status success">
                                {{ __('education_admin.students_show.bookings.status.completed') }}
                            </span>

                        @elseif($bookingStatus === 'no_show')

                            <span class="education-admin-status danger">
                                {{ __('education_admin.students_show.bookings.status.no_show') }}
                            </span>

                        @else

                            <span class="education-admin-status muted">
                                {{ $bookingStatus ?: __('education_admin.students_show.common.not_specified') }}
                            </span>

                        @endif

                    </div>

                </div>

            @endforeach

        </div>


        @if(Route::has('education.admin.bookings.index'))

            <div class="education-admin-student-bookings-footer">

                <a
                    href="{{ route(
                        'education.admin.bookings.index',
                        ['student' => $student->id]
                    ) }}"
                >
                    {{ __('education_admin.students_show.bookings.view_all') }}

                    <i class="fa-solid fa-arrow-left"></i>
                </a>

            </div>

        @endif

    @else

        <div class="education-admin-student-bookings-empty">

            <div>
                <i class="fa-regular fa-calendar-xmark"></i>
            </div>

            <h4>
                {{ __('education_admin.students_show.bookings.empty.title') }}
            </h4>

            <p>
                {{ __('education_admin.students_show.bookings.empty.description') }}
            </p>

        </div>

    @endif

</div>


{{-- ==================================================
    FOOTER ACTIONS
================================================== --}}

<div class="education-admin-student-show-footer">

    <a
        href="{{ route('education.admin.students.index') }}"
        class="education-admin-student-show-back-button"
    >
        <i class="fa-solid fa-arrow-right"></i>

        {{ __('education_admin.students_show.footer.back') }}
    </a>


    @if(Route::has('education.admin.students.edit'))

        <a
            href="{{ route('education.admin.students.edit', $student) }}"
            class="education-admin-student-show-edit-button"
        >
            <i class="fa-solid fa-pen"></i>

            {{ __('education_admin.students_show.footer.edit') }}
        </a>

    @endif

</div>

</div>

@endsection
