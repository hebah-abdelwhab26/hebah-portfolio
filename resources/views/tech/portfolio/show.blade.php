@extends('tech.layouts.app')
@section('content')

<div class="digital-page">

    {{-- Navbar --}}
    @include('tech.sections.navbar')

    {{-- Hero --}}
    @include('tech.portfolio.components.hero')

    {{-- Project Information --}}
    @include('tech.portfolio.components.info')

    {{-- Gallery --}}
    @include('tech.portfolio.components.gallery')

    {{-- Technologies --}}
    @include('tech.portfolio.components.technologies')

    {{-- Links --}}
    @include('tech.portfolio.components.links')

    {{-- Related Projects --}}
    @include('tech.portfolio.components.related')

    {{-- Contact --}}
    @include('tech.sections.contact')

    {{-- Footer --}}
    @include('tech.sections.footer')

</div>

@endsection
