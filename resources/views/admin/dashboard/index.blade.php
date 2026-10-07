@extends('admin.layouts.app')

@section('title', __('digital_studio_admin.dashboard.title'))

@section('content')

<div class="fade-up">

    <!--==============================
            PAGE HEADER
    ==============================-->

    <div class="dashboard-header">

        <div class="dashboard-header-left">

            <span class="dashboard-breadcrumb">

                <i class="fa-solid fa-house"></i>

                {{ __('digital_studio_admin.dashboard.breadcrumb') }}

            </span>

            <h1>

                {{ __('digital_studio_admin.dashboard.welcome') }},

                {{ auth()->user()->name }}

            </h1>

            <p>

                {{ __('digital_studio_admin.dashboard.description') }}

            </p>

        </div>

        <div class="dashboard-header-right">

            <div class="dashboard-date">

                <i class="fa-solid fa-calendar-days"></i>

                {{ now()->format('F d, Y') }}

            </div>

            <a href="{{ route('admin.projects.create') }}"
               class="btn-admin-primary">

                <i class="fa-solid fa-plus"></i>

                {{ __('digital_studio_admin.dashboard.new_project') }}

            </a>

        </div>

    </div>

    {{-- Welcome --}}

    @include('admin.dashboard.components.welcome')

    {{-- Statistics --}}

    @include('admin.dashboard.components.stats')

    <div class="row mt-4">

        <div class="col-lg-8">

            @include('admin.dashboard.components.chart')

        </div>

        <div class="col-lg-4">

            @include('admin.dashboard.components.quick-actions')

        </div>

    </div>

    <div class="row mt-4">

        <div class="col-lg-8">

            @include('admin.dashboard.components.latest-projects')

        </div>

        <div class="col-lg-4">

            @include('admin.dashboard.components.recent-activity')

        </div>

    </div>

</div>

@endsection
