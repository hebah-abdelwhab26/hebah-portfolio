<aside
    class="education-admin-sidebar"
    id="educationAdminSidebar"
>

{{-- ==================================================
SIDEBAR HEADER
================================================== --}}

<div class="education-admin-sidebar-header">


<a
    href="{{ route('education.admin.dashboard') }}"
    class="education-admin-brand"
>

    <div class="education-admin-brand-icon">
        <i class="fa-solid fa-book-quran"></i>
    </div>

    <div class="education-admin-brand-text">

        <strong>
            Hebah
        </strong>

        <span>
            {{ __('education_admin.sidebar.education_panel') }}
        </span>

    </div>

</a>


{{-- MOBILE CLOSE --}}

<button
    type="button"
    class="education-admin-sidebar-close"
    id="educationAdminSidebarClose"
    aria-label="{{ __('education_admin.sidebar.close_menu') }}"
>

    <i class="fa-solid fa-xmark"></i>

</button>


</div>

{{-- ==================================================
SIDEBAR ADMIN
================================================== --}}

@php

$educationAdmin =
auth()
->guard('education_admin')
->user();

@endphp

@if($educationAdmin)

<div class="education-admin-sidebar-user">

{{-- ==================================================
    AVATAR
================================================== --}}

<div class="education-admin-sidebar-avatar">

    @if($educationAdmin->avatar)

        <img
            src="{{ asset($educationAdmin->avatar) }}"
            alt="{{ $educationAdmin->name }}"
        >

    @else

        <span>

            {{ mb_strtoupper(
                mb_substr(
                    $educationAdmin->name ?? 'H',
                    0,
                    1
                )
            ) }}

        </span>

    @endif


    <i
        class="fa-solid fa-circle education-admin-online"
    ></i>

</div>


{{-- ==================================================
    ADMIN INFORMATION
================================================== --}}

<div class="education-admin-sidebar-user-info">

    <strong>
        {{ $educationAdmin->name ?? __('education_admin.sidebar.education_manager') }}
    </strong>

    <span>
        {{ $educationAdmin->email ?? '' }}
    </span>

</div>

</div>

@endif

{{-- ==================================================
NAVIGATION
================================================== --}}

<nav class="education-admin-navigation">

{{-- ==================================================
MAIN
================================================== --}}

<div class="education-admin-nav-section">

<span class="education-admin-nav-title">
    {{ __('education_admin.sidebar.main') }}
</span>


{{-- DASHBOARD --}}

<a
    href="{{ route('education.admin.dashboard') }}"
    class="education-admin-nav-link
        {{ request()->routeIs('education.admin.dashboard') ? 'active' : '' }}"
>

    <span class="education-admin-nav-icon">

        <i class="fa-solid fa-chart-pie"></i>

    </span>

    <span class="education-admin-nav-label">
        {{ __('education_admin.sidebar.dashboard') }}
    </span>

</a>
</div>

{{-- ==================================================
EDUCATION MANAGEMENT
================================================== --}}

<div class="education-admin-nav-section">

<span class="education-admin-nav-title">
    {{ __('education_admin.sidebar.education_management') }}
</span>


{{-- ==================================================
    BOOKINGS
================================================== --}}

@if(Route::has('education.admin.bookings.index'))

    <a
        href="{{ route('education.admin.bookings.index') }}"
        class="education-admin-nav-link
            {{ request()->routeIs('education.admin.bookings.*') ? 'active' : '' }}"
    >

        <span class="education-admin-nav-icon">

            <i class="fa-regular fa-calendar-check"></i>

        </span>

        <span class="education-admin-nav-label">
            {{ __('education_admin.sidebar.bookings') }}
        </span>

        <span class="education-admin-nav-badge">

            <i class="fa-solid fa-chevron-left"></i>

        </span>

    </a>

@endif


{{-- ==================================================
    BOOKING TYPES
================================================== --}}

@if(Route::has('education.admin.booking-types.index'))

    <a
        href="{{ route('education.admin.booking-types.index') }}"
        class="education-admin-nav-link
            {{ request()->routeIs('education.admin.booking-types.*') ? 'active' : '' }}"
    >

        <span class="education-admin-nav-icon">

            <i class="fa-solid fa-box-open"></i>

        </span>

        <span class="education-admin-nav-label">
            {{ __('education_admin.sidebar.booking_types') }}
        </span>

        <span class="education-admin-nav-badge">

            <i class="fa-solid fa-chevron-left"></i>

        </span>

    </a>

@endif


{{-- ==================================================
    STUDENTS
================================================== --}}

@if(Route::has('education.admin.students.index'))

    <a
        href="{{ route('education.admin.students.index') }}"
        class="education-admin-nav-link
            {{ request()->routeIs('education.admin.students.*') ? 'active' : '' }}"
    >

        <span class="education-admin-nav-icon">

            <i class="fa-solid fa-user-graduate"></i>

        </span>

        <span class="education-admin-nav-label">
            {{ __('education_admin.sidebar.students') }}
        </span>

        <span class="education-admin-nav-badge">

            <i class="fa-solid fa-chevron-left"></i>

        </span>

    </a>

@endif


{{-- ==================================================
    TEACHERS
================================================== --}}

@if(Route::has('education.admin.teachers.index'))

    <a
        href="{{ route('education.admin.teachers.index') }}"
        class="education-admin-nav-link
            {{ request()->routeIs('education.admin.teachers.*') ? 'active' : '' }}"
    >

        <span class="education-admin-nav-icon">

            <i class="fa-solid fa-chalkboard-user"></i>

        </span>

        <span class="education-admin-nav-label">
            {{ __('education_admin.sidebar.teachers') }}
        </span>

        <span class="education-admin-nav-badge">

            <i class="fa-solid fa-chevron-left"></i>

        </span>

    </a>

@endif


{{-- ==================================================
    LESSONS
================================================== --}}

@if(Route::has('education.admin.lessons.index'))

    <a
        href="{{ route('education.admin.lessons.index') }}"
        class="education-admin-nav-link
            {{ request()->routeIs('education.admin.lessons.*') ? 'active' : '' }}"
    >

        <span class="education-admin-nav-icon">

            <i class="fa-solid fa-book-open"></i>

        </span>

        <span class="education-admin-nav-label">
            {{ __('education_admin.sidebar.lessons') }}
        </span>

        <span class="education-admin-nav-badge">

            <i class="fa-solid fa-chevron-left"></i>

        </span>

    </a>

@endif


{{-- ==================================================
    STUDENT LESSON ASSIGNMENTS
================================================== --}}

@if(Route::has('education.admin.lesson-assignments.index'))

    <a
        href="{{ route('education.admin.lesson-assignments.index') }}"
        class="education-admin-nav-link
            {{ request()->routeIs('education.admin.lesson-assignments.*') ? 'active' : '' }}"
    >

        <span class="education-admin-nav-icon">

            <i class="fa-solid fa-share-from-square"></i>

        </span>

        <span class="education-admin-nav-label">
            {{ __('education_admin.sidebar.lesson_assignments') }}
        </span>

        <span class="education-admin-nav-badge">

            <i class="fa-solid fa-chevron-left"></i>

        </span>

    </a>

@endif


{{-- ==================================================
    STUDENT LESSONS
================================================== --}}

@if(Route::has('education.admin.student-lessons.index'))

    <a
        href="{{ route('education.admin.student-lessons.index') }}"
        class="education-admin-nav-link
            {{ request()->routeIs('education.admin.student-lessons.*') ? 'active' : '' }}"
    >

        <span class="education-admin-nav-icon">

            <i class="fa-solid fa-book-open-reader"></i>

        </span>

        <span class="education-admin-nav-label">
            {{ __('education_admin.sidebar.student_lessons') }}
        </span>

        <span class="education-admin-nav-badge">

            <i class="fa-solid fa-chevron-left"></i>

        </span>

    </a>

@endif


{{-- ==================================================
    AVAILABILITIES
================================================== --}}

@if(Route::has('education.admin.availabilities.index'))

    <a
        href="{{ route('education.admin.availabilities.index') }}"
        class="education-admin-nav-link
            {{ request()->routeIs('education.admin.availabilities.*') ? 'active' : '' }}"
    >

        <span class="education-admin-nav-icon">

            <i class="fa-regular fa-clock"></i>

        </span>

        <span class="education-admin-nav-label">
            {{ __('education_admin.sidebar.availabilities') }}
        </span>

        <span class="education-admin-nav-badge">

            <i class="fa-solid fa-chevron-left"></i>

        </span>

    </a>

@endif

</div>

{{-- ==================================================
QUIZZES & ASSESSMENTS
================================================== --}}

<div class="education-admin-nav-section">

<span class="education-admin-nav-title">
    {{ __('education_admin.sidebar.quizzes_assessments') }}
</span>


{{-- ==================================================
    QUIZZES
================================================== --}}

@if(Route::has('education.admin.quizzes.index'))

    <a
        href="{{ route('education.admin.quizzes.index') }}"
        class="education-admin-nav-link
            {{ request()->routeIs('education.admin.quizzes.*') ? 'active' : '' }}"
    >

        <span class="education-admin-nav-icon">

            <i class="fa-solid fa-clipboard-question"></i>

        </span>

        <span class="education-admin-nav-label">
            {{ __('education_admin.sidebar.quizzes') }}
        </span>

        <span class="education-admin-nav-badge">

            <i class="fa-solid fa-chevron-left"></i>

        </span>

    </a>

@endif


{{-- ==================================================
    QUIZ ATTEMPTS
================================================== --}}

@if(Route::has('education.admin.quiz-attempts.index'))

    <a
        href="{{ route('education.admin.quiz-attempts.index') }}"
        class="education-admin-nav-link
            {{ request()->routeIs('education.admin.quiz-attempts.*') ? 'active' : '' }}"
    >

        <span class="education-admin-nav-icon">

            <i class="fa-solid fa-list-check"></i>

        </span>

        <span class="education-admin-nav-label">
            {{ __('education_admin.sidebar.quiz_attempts') }}
        </span>

        <span class="education-admin-nav-badge">

            <i class="fa-solid fa-chevron-left"></i>

        </span>

    </a>

@endif

</div>

{{-- ==================================================
FINANCIAL MANAGEMENT
================================================== --}}

<div class="education-admin-nav-section">

<span class="education-admin-nav-title">
    {{ __('education_admin.sidebar.financial_management') }}
</span>


{{-- ==================================================
    PAYMENTS
================================================== --}}

@if(Route::has('education.admin.payments.index'))

    <a
        href="{{ route('education.admin.payments.index') }}"
        class="education-admin-nav-link
            {{ request()->routeIs('education.admin.payments.*') ? 'active' : '' }}"
    >

        <span class="education-admin-nav-icon">

            <i class="fa-solid fa-wallet"></i>

        </span>

        <span class="education-admin-nav-label">
            {{ __('education_admin.sidebar.payments') }}
        </span>


        @if(isset($pendingPaymentsCount) && $pendingPaymentsCount > 0)

            <span class="education-admin-nav-badge">

                {{ $pendingPaymentsCount }}

            </span>

        @else

            <span class="education-admin-nav-badge">

                <i class="fa-solid fa-chevron-left"></i>

            </span>

        @endif

    </a>

@endif


{{-- ==================================================
    FINANCIAL REPORTS
================================================== --}}

@if(Route::has('education.admin.reports.index'))

    <a
        href="{{ route('education.admin.reports.index') }}"
        class="education-admin-nav-link
            {{ request()->routeIs('education.admin.reports.*') ? 'active' : '' }}"
    >

        <span class="education-admin-nav-icon">

            <i class="fa-solid fa-chart-column"></i>

        </span>

        <span class="education-admin-nav-label">
            {{ __('education_admin.sidebar.financial_reports') }}
        </span>

        <span class="education-admin-nav-badge">

            <i class="fa-solid fa-chevron-left"></i>

        </span>

    </a>

@endif

</div>

{{-- ==================================================
COMMUNICATION
================================================== --}}

<div class="education-admin-nav-section">

<span class="education-admin-nav-title">
    {{ __('education_admin.sidebar.communication') }}
</span>


{{-- ==================================================
    CONTACT MESSAGES
================================================== --}}

@if(Route::has('education.admin.contact-messages.index'))

    <a
        href="{{ route('education.admin.contact-messages.index') }}"
        class="education-admin-nav-link
            {{ request()->routeIs('education.admin.contact-messages.*') ? 'active' : '' }}"
    >

        <span class="education-admin-nav-icon">

            <i class="fa-regular fa-envelope"></i>

        </span>

        <span class="education-admin-nav-label">
            {{ __('education_admin.sidebar.contact_messages') }}
        </span>

        <span class="education-admin-nav-badge">

            <i class="fa-solid fa-chevron-left"></i>

        </span>

    </a>

@endif


{{-- ==================================================
    CONVERSATIONS
================================================== --}}

@if(Route::has('education.admin.conversations.index'))

    <a
        href="{{ route('education.admin.conversations.index') }}"
        class="education-admin-nav-link
            {{ request()->routeIs('education.admin.conversations.*') ? 'active' : '' }}"
    >

        <span class="education-admin-nav-icon">

            <i class="fa-regular fa-comments"></i>

        </span>

        <span class="education-admin-nav-label">
            {{ __('education_admin.sidebar.conversations') }}
        </span>

    </a>

@endif


{{-- ==================================================
    COMMENTS
================================================== --}}

@if(Route::has('education.admin.comments.index'))

    <a
        href="{{ route('education.admin.comments.index') }}"
        class="education-admin-nav-link
            {{ request()->routeIs('education.admin.comments.*') ? 'active' : '' }}"
    >

        <span class="education-admin-nav-icon">

            <i class="fa-regular fa-comment-dots"></i>

        </span>

        <span class="education-admin-nav-label">
            {{ __('education_admin.sidebar.comments') }}
        </span>

    </a>

@endif


{{-- ==================================================
    NOTIFICATIONS
================================================== --}}

@if(Route::has('education.admin.notifications.index'))

    <a
        href="{{ route('education.admin.notifications.index') }}"
        class="education-admin-nav-link
            {{ request()->routeIs('education.admin.notifications.*') ? 'active' : '' }}"
    >

        <span class="education-admin-nav-icon">

            <i class="fa-regular fa-bell"></i>

        </span>

        <span class="education-admin-nav-label">
            {{ __('education_admin.sidebar.notifications') }}
        </span>

    </a>

@endif

</div>

{{-- ==================================================
CONTENT MANAGEMENT
================================================== --}}

<div class="education-admin-nav-section">

<span class="education-admin-nav-title">
    {{ __('education_admin.sidebar.content') }}
</span>


{{-- ==================================================
    NEWS
================================================== --}}

@if(Route::has('education.admin.news.index'))

    <a
        href="{{ route('education.admin.news.index') }}"
        class="education-admin-nav-link
            {{ request()->routeIs('education.admin.news.*') ? 'active' : '' }}"
    >

        <span class="education-admin-nav-icon">

            <i class="fa-solid fa-newspaper"></i>

        </span>

        <span class="education-admin-nav-label">
            {{ __('education_admin.sidebar.news') }}
        </span>

    </a>

@endif


{{-- ==================================================
    LESSON CATEGORIES
================================================== --}}

@if(Route::has('education.admin.categories.index'))

    <a
        href="{{ route('education.admin.categories.index') }}"
        class="education-admin-nav-link
            {{ request()->routeIs('education.admin.categories.*') ? 'active' : '' }}"
    >

        <span class="education-admin-nav-icon">

            <i class="fa-solid fa-layer-group"></i>

        </span>

        <span class="education-admin-nav-label">
            {{ __('education_admin.sidebar.lesson_categories') }}
        </span>

    </a>

@endif


{{-- ==================================================
    FAQ
================================================== --}}

@if(Route::has('education.admin.faq.index'))

    <a
        href="{{ route('education.admin.faq.index') }}"
        class="education-admin-nav-link
            {{ request()->routeIs('education.admin.faq.*') ? 'active' : '' }}"
    >

        <span class="education-admin-nav-icon">

            <i class="fa-regular fa-circle-question"></i>

        </span>

        <span class="education-admin-nav-label">
            {{ __('education_admin.sidebar.faq') }}
        </span>

    </a>

@endif


{{-- ==================================================
    REVIEWS
================================================== --}}

@if(Route::has('education.admin.reviews.index'))

    <a
        href="{{ route('education.admin.reviews.index') }}"
        class="education-admin-nav-link
            {{ request()->routeIs('education.admin.reviews.*') ? 'active' : '' }}"
    >

        <span class="education-admin-nav-icon">

            <i class="fa-regular fa-star"></i>

        </span>

        <span class="education-admin-nav-label">
            {{ __('education_admin.sidebar.reviews') }}
        </span>

    </a>

@endif

</div>

{{-- ==================================================
SYSTEM
================================================== --}}

<div class="education-admin-nav-section">

<span class="education-admin-nav-title">
    {{ __('education_admin.sidebar.system') }}
</span>


{{-- ==================================================
    SETTINGS
================================================== --}}

@if(Route::has('education.admin.settings.edit'))

    <a
        href="{{ route('education.admin.settings.edit') }}"
        class="education-admin-nav-link
            {{ request()->routeIs('education.admin.settings.*') ? 'active' : '' }}"
    >

        <span class="education-admin-nav-icon">

            <i class="fa-solid fa-sliders"></i>

        </span>

        <span class="education-admin-nav-label">
            {{ __('education_admin.sidebar.education_settings') }}
        </span>

    </a>

@endif


{{-- ==================================================
    ADMIN PROFILE
================================================== --}}

@if(Route::has('education.admin.profile.edit'))

    <a
        href="{{ route('education.admin.profile.edit') }}"
        class="education-admin-nav-link
            {{ request()->routeIs('education.admin.profile.*') ? 'active' : '' }}"
    >

        <span class="education-admin-nav-icon">

            <i class="fa-solid fa-user-gear"></i>

        </span>

        <span class="education-admin-nav-label">
            {{ __('education_admin.sidebar.admin_account') }}
        </span>

    </a>

@endif

</div>

</nav>

{{-- ==================================================
SIDEBAR FOOTER
================================================== --}}

<div class="education-admin-sidebar-footer">

{{-- ==================================================
LANGUAGE SWITCHER
================================================== --}}

@if(Route::has('education.language'))

@php
    $currentEducationLocale = session('education_locale', 'ar');
    $nextEducationLocale = $currentEducationLocale === 'ar' ? 'en' : 'ar';
@endphp

<a
    href="{{ route('education.language', ['locale' => $nextEducationLocale]) }}"
    class="education-admin-sidebar-footer-link education-admin-sidebar-language"
    title="{{ __('education_admin.sidebar.switch_language') }}"
    aria-label="{{ __('education_admin.sidebar.switch_language') }}"
>

    <span>

        <i class="fa-solid fa-language"></i>

        {{ __('education_admin.sidebar.language') }}

    </span>

    <span class="education-admin-sidebar-language-code">

        {{ strtoupper($nextEducationLocale) }}

    </span>

</a>

@endif


{{-- ==================================================
BACK TO WEBSITE
================================================== --}}

@if(Route::has('education.index'))

<a
    href="{{ route('education.index') }}"
    target="_blank"
    rel="noopener noreferrer"
    class="education-admin-sidebar-footer-link"
>

    <span>

        <i class="fa-solid fa-arrow-up-right-from-square"></i>

        {{ __('education_admin.sidebar.visit_website') }}

    </span>

    <i class="fa-solid fa-chevron-left"></i>

</a>

@endif

{{-- ==================================================
LOGOUT
================================================== --}}

@if(Route::has('education.admin.logout'))

<form
    method="POST"
    action="{{ route('education.admin.logout') }}"
    class="education-admin-sidebar-logout-form"
>

    @csrf

    <button
        type="submit"
        class="education-admin-sidebar-logout"
    >

        <span>

            <i class="fa-solid fa-arrow-right-from-bracket"></i>

            {{ __('education_admin.sidebar.logout') }}

        </span>

    </button>

</form>

@endif

</div>

</aside>
