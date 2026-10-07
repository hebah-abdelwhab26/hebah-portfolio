@extends('tech.layouts.app')

@section('content')
<div class="portal-background">

    @include('portal.background.tech-grid')

</div>

<div class="portal-home">

    @include('portal.front.hero')

    @include('portal.front.selector')

</div>

@endsection
