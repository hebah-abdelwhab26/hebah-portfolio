@extends('layouts.auth')

@section('title', __('digital_studio.auth.verify_email.title'))

@section('content')

<div class="auth-card">


<div class="auth-header">

    <h1>
        {{ __('digital_studio.auth.verify_email.heading') }}
    </h1>

    <p>
        {{ __('digital_studio.auth.verify_email.description') }}
    </p>

</div>

@if (session('status') == 'verification-link-sent')

    <div class="auth-success">
        {{ __('digital_studio.auth.verify_email.verification_sent') }}
    </div>

@endif

<div class="auth-actions">

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf

        <button type="submit" class="auth-button">
            {{ __('digital_studio.auth.verify_email.resend') }}
        </button>

    </form>

    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <button type="submit" class="auth-link">
            {{ __('digital_studio.auth.verify_email.logout') }}
        </button>

    </form>

</div>

</div>

@endsection
