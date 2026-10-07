@extends('tech.layouts.app')

@section('content')

<section class="error-page">

    <div class="container">

        <div class="error-box">

            <div class="error-number">

                403

            </div>

            <span class="error-badge">

                ACCESS DENIED

            </span>

            <h1>

                You don't have permission
                <span>to access this page</span>

            </h1>

            <p>

                The page you're trying to access requires administrator privileges.
                If you believe this is a mistake, please contact the administrator.

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

