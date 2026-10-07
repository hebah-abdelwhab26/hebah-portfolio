@extends('tech.layouts.app')

@section('content')

<section class="error-page">

    <div class="container">

        <div class="error-box">


<div class="error-number">
    404
</div>

<span class="error-badge">
    PAGE NOT FOUND
</span>

<h1>

    Oops...
    <span>Page Not Found</span>

</h1>

<p>

    The page you are looking for doesn't exist or has been moved.

</p>

            <div class="error-actions">

                <a href="{{ route('portal') }}" class="primary-btn">

                    <i class="fa-solid fa-house"></i>

                    Back Home

                </a>

                @auth

                    <a href="{{ route('tech.index') }}" class="secondary-btn">

                        <i class="fa-solid fa-arrow-left"></i>

                        Return

                    </a>

                @endauth

            </div>

        </div>

    </div>

</section>

@endsection
































