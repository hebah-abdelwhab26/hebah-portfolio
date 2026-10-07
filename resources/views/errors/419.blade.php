@extends('tech.layouts.app')

@section('content')

<section class="error-page">

    <div class="container">

        <div class="error-box">

            <div class="error-number">

                419

            </div>

            <span class="error-badge">

                SESSION EXPIRED

            </span>

            <h1>

                Your Session
                <span>Has Expired</span>

            </h1>

            <p>

                Please refresh the page and try again.

            </p>

            <div class="error-actions">

                <a href="{{ url()->previous() }}" class="primary-btn">

                    <i class="fa-solid fa-rotate-right"></i>

                    Go Back

                </a>

            </div>

        </div>

    </div>

</section>

@endsection
