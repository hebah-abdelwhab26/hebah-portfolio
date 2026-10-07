@extends('tech.layouts.app')

@section('content')

<section class="error-page">

    <div class="container">

        <div class="error-box">

       <div class="error-number">
    500
</div>

<span class="error-badge">
    SERVER ERROR
</span>

<h1>

    Something went
    <span>Wrong</span>

</h1>

<p>

    An unexpected error occurred.
    Please try again later.

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
