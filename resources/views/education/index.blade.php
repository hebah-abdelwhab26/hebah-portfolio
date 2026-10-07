@extends('education.layouts.app')


@section('title', 'Quran & Arabic Education')


@section('meta_description')

Personal Quran and Arabic language education with Hebah.

@endsection


{{-- ==================================================
    HEADER
================================================== --}}

@section('header')

    @include('education.partials.navbar')

@endsection


{{-- ==================================================
    MAIN CONTENT
================================================== --}}

@section('content')

    {{-- @include('education.partials.news-ticker') --}}

    @include('education.sections.hero')

    @include('education.sections.about')

    @include('education.sections.services')

    @include('education.sections.schedule')

    @include('education.sections.resources')

    {{-- ==================================================
        COMMENTS
    ================================================== --}}

    @include('education.sections.comments')

    @include('education.sections.contact')

@endsection