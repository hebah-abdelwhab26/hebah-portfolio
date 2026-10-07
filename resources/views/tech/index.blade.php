@extends('tech.layouts.app')
@section('content')

<div class="digital-page" id="home">

    @include('tech.sections.navbar')
@include('tech.sections.news-ticker')
    @include('tech.sections.hero')

    @include('tech.sections.about')

    @include('tech.sections.technologies')

    @include('tech.sections.portfolio')


    @include('tech.sections.uiux')

    @include('tech.sections.process')

    @include('tech.sections.why')

     @include('tech.sections.testimonials')

    @include('tech.sections.contact')

    @include('tech.sections.footer')
</div>

@endsection
