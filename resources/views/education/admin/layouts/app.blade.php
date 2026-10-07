@php
$educationLocale = session('education_locale', 'ar');
$educationDirection = $educationLocale === 'en' ? 'ltr' : 'rtl';
@endphp

<!DOCTYPE html>

<html lang="{{ $educationLocale }}" dir="{{ $educationDirection }}">

<head>

```
<meta charset="UTF-8">

<meta
    name="viewport"
    content="width=device-width, initial-scale=1.0">

<meta
    name="csrf-token"
    content="{{ csrf_token() }}">

<title>
    @yield('title', __('education_admin.common.dashboard'))
</title>


{{-- ==================================================
    GOOGLE FONTS
================================================== --}}

<link
    rel="preconnect"
    href="https://fonts.googleapis.com">

<link
    rel="preconnect"
    href="https://fonts.gstatic.com"
    crossorigin>

<link
    href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700&family=Amiri:wght@400;700&display=swap"
    rel="stylesheet">


{{-- ==================================================
    FONT AWESOME
================================================== --}}

<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">


{{-- ==================================================
    EDUCATION ADMIN GLOBAL CSS
================================================== --}}

<link
    rel="stylesheet"
    href="{{ asset('css/education/admin/education-admin.css') }}">


{{-- ==================================================
    EDUCATION ADMIN SIDEBAR
================================================== --}}

<link
    rel="stylesheet"
    href="{{ asset('css/education/admin/education-admin-sidebar.css') }}">


{{-- ==================================================
    EDUCATION ADMIN HEADER
================================================== --}}

<link
    rel="stylesheet"
    href="{{ asset('css/education/admin/education-admin-header.css') }}">


{{-- ==================================================
    EDUCATION ADMIN DASHBOARD
================================================== --}}

<link
    rel="stylesheet"
    href="{{ asset('css/education/admin/admin-dashboard.css') }}">

<link
    rel="stylesheet"
    href="{{ asset('css/education/admin/bookings.css') }}">

<link
    rel="stylesheet"
    href="{{ asset('css/education/admin/students.css') }}">

<link
    rel="stylesheet"
    href="{{ asset('css/education/admin/lessons.css') }}">

<link
    rel="stylesheet"
    href="{{ asset('css/education/admin/lesson-content.css') }}">

<link
    rel="stylesheet"
    href="{{ asset('css/education/admin/education-quizzes.css') }}">

<link
    rel="stylesheet"
    href="{{ asset('css/education/admin/quizzes.css') }}">

<link
    rel="stylesheet"
    href="{{ asset('css/education/admin/quiz-questions.css') }}">


{{-- ==================================================
    PAGE SPECIFIC STYLES
================================================== --}}

@stack('styles')

</head>

<body class="education-admin-body">

{{-- ==================================================
    ADMIN WRAPPER
================================================== --}}

<div class="education-admin-wrapper">


    {{-- ==================================================
        SIDEBAR
    ================================================== --}}

    @include('education.admin.layouts.sidebar')


    {{-- ==================================================
        MAIN AREA
    ================================================== --}}

    <div class="education-admin-main">


        {{-- ==================================================
            HEADER
        ================================================== --}}

        @include('education.admin.layouts.header')


        {{-- ==================================================
            PAGE CONTENT
        ================================================== --}}

        <main class="education-admin-content">

            @yield('content')

        </main>


    </div>

</div>


{{-- ==================================================
    GLOBAL JAVASCRIPT
================================================== --}}

<script
    src="{{ asset('js/education/admin/education-admin.js') }}">
</script>


@stack('scripts')


</body>

</html>
