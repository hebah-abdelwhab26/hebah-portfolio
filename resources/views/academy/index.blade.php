@extends('layouts.academy')

@section('title', 'Hebah Academy')

@section('content')
@include('academy.sections.navbar')

    @include('academy.sections.hero')

    @include('academy.sections.about')

     @include('academy.sections.programs')

      @include('academy.sections.learning')

       @include('academy.sections.statistics')

       @include('academy.sections.testimonials')

        @include('academy.sections.contact')

        @include('academy.sections.footer')

@endsection
