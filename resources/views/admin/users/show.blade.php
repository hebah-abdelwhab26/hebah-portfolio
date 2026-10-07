@extends('admin.layouts.app')


@section('title', __('digital_studio_admin.users.show.title'))


@section('content')

<div class="container-fluid">


    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h1 class="h3 mb-1">
                {{ __('digital_studio_admin.users.show.page_header.title') }}
            </h1>

            <p class="text-muted mb-0">
                {{ __('digital_studio_admin.users.show.page_header.description') }}
            </p>

        </div>


        <div>

            <a href="{{ route('admin.users.index') }}"
               class="btn btn-secondary">

                <i class="bi bi-arrow-left"></i>

                {{ __('digital_studio_admin.users.show.page_header.back') }}

            </a>


            <a href="{{ route('admin.users.edit', $user) }}"
               class="btn btn-primary">

                <i class="bi bi-pencil"></i>

                {{ __('digital_studio_admin.users.show.page_header.edit') }}

            </a>

        </div>

    </div>



    {{-- User Card --}}
    <div class="card shadow-sm">


        <div class="card-body">


            <div class="row align-items-center">


                {{-- Avatar --}}
                <div class="col-md-3 text-center">


                    <img src="{{ $user->avatar_url }}"
                         alt="{{ $user->name }}"
                         class="rounded-circle mb-3"
                         width="150"
                         height="150">


                    <h5 class="mb-1">
                        {{ $user->name }}
                    </h5>


                    <span class="badge bg-primary">

                        {{ __('digital_studio_admin.users.edit.roles.' . $user->role) }}

                    </span>


                </div>



                {{-- Information --}}
                <div class="col-md-9">


                    <div class="row">


                        <div class="col-md-6 mb-3">

                            <strong>
                                {{ __('digital_studio_admin.users.show.fields.username') }}
                            </strong>

                            <p class="text-muted mb-0">
                                {{ $user->username }}
                            </p>

                        </div>



                        <div class="col-md-6 mb-3">

                            <strong>
                                {{ __('digital_studio_admin.users.show.fields.email') }}
                            </strong>

                            <p class="text-muted mb-0">
                                {{ $user->email }}
                            </p>

                        </div>




                        <div class="col-md-6 mb-3">

                            <strong>
                                {{ __('digital_studio_admin.users.show.fields.phone') }}
                            </strong>

                            <p class="text-muted mb-0">

                                {{ $user->phone ?? __('digital_studio_admin.users.show.not_available') }}

                            </p>

                        </div>




                        <div class="col-md-6 mb-3">

                            <strong>
                                {{ __('digital_studio_admin.users.show.fields.status') }}
                            </strong>


                            <p class="mb-0">

                                @if($user->status === 'active')

                                    <span class="badge bg-success">

                                        {{ __('digital_studio_admin.users.edit.statuses.active') }}

                                    </span>

                                @elseif($user->status === 'inactive')

                                    <span class="badge bg-warning">

                                        {{ __('digital_studio_admin.users.edit.statuses.inactive') }}

                                    </span>

                                @else

                                    <span class="badge bg-danger">

                                        {{ __('digital_studio_admin.users.edit.statuses.blocked') }}

                                    </span>

                                @endif


                            </p>


                        </div>




                        <div class="col-md-6 mb-3">

                            <strong>
                                {{ __('digital_studio_admin.users.show.fields.email_verification') }}
                            </strong>


                            <p class="mb-0">

                                @if($user->email_verified_at)

                                    <span class="badge bg-success">

                                        {{ __('digital_studio_admin.users.show.verification.verified') }}

                                    </span>

                                @else

                                    <span class="badge bg-secondary">

                                        {{ __('digital_studio_admin.users.show.verification.not_verified') }}

                                    </span>

                                @endif


                            </p>


                        </div>




                        <div class="col-md-6 mb-3">

                            <strong>
                                {{ __('digital_studio_admin.users.show.fields.joined') }}
                            </strong>

                            <p class="text-muted mb-0">

                                {{ $user->created_at->format('d M Y') }}

                            </p>


                        </div>


                    </div>



                    {{-- Bio --}}

                    @if($user->bio)

                    <hr>


                    <div>

                        <strong>
                            {{ __('digital_studio_admin.users.show.fields.bio') }}
                        </strong>


                        <p class="text-muted mt-2">

                            {{ $user->bio }}

                        </p>


                    </div>

                    @endif


                </div>


            </div>


        </div>


    </div>


</div>


@endsection
