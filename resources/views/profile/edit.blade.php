@extends('layouts.auth')

@section('title', __('digital_studio.profile.title'))

@section('content')

<div class="auth-page">

<!--==================================
            BACK TO WEBSITE
===================================-->

<div class="auth-back-home">

    <a href="{{ route('portal') }}">

        <i class="fa-solid fa-arrow-left"></i>

        {{ __('digital_studio.profile.back_to_website') }}

    </a>

</div>


<!--==================================
            AUTH CONTAINER
===================================-->

<div class="auth-container">

    <div class="auth-card profile-card">


        <!--==================================
                    LOGO
        ==================================-->

        <div class="auth-logo">

            <a href="{{ route('portal') }}">

                <div class="auth-logo-icon">

                    <i class="fa-solid fa-user"></i>

                </div>

                <div class="auth-logo-text">

                    <span class="auth-logo-name">
                        Hebah web
                    </span>

                    <span class="auth-logo-subtitle">
                        {{ __('digital_studio.profile.logo_subtitle') }}
                    </span>

                </div>

            </a>

        </div>


        <!--==================================
                    HEADER
        ==================================-->

        <div class="auth-header">

            <h1>
                {{ __('digital_studio.profile.heading') }}
            </h1>

            <p>
                {{ __('digital_studio.profile.description') }}
            </p>

        </div>


        <!--==================================
                SUCCESS MESSAGE
        ==================================-->

        @if(session('status'))

            <div class="auth-success">

                <i class="fa-solid fa-circle-check me-2"></i>

                {{ session('status') }}

            </div>

        @endif


        <!--==================================
                VALIDATION ERRORS
        ==================================-->

        @if($errors->any())

            <div class="auth-alert">

                <strong>
                    {{ __('digital_studio.profile.check_information') }}
                </strong>

                <ul class="mb-0 mt-2">

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        <!--==================================
                PROFILE INFORMATION
        ==================================-->

        <form
            method="POST"
            action="{{ route('profile.update') }}"
            class="auth-form">

            @csrf

            @method('PATCH')


            <!--==================================
                    NAME
            ==================================-->

            <div class="auth-field">

                <label for="name">
                    {{ __('digital_studio.profile.name') }}
                </label>

                <div class="auth-input-wrapper">

                    <input
                        id="name"
                        type="text"
                        name="name"
                        class="auth-input @error('name') is-invalid @enderror"
                        value="{{ old('name', $user->name) }}"
                        required
                        autocomplete="name">

                    <i class="fa-solid fa-user auth-input-icon"></i>

                </div>

                @error('name')

                    <div class="auth-error">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            <!--==================================
                    USERNAME
            ==================================-->

            <div class="auth-field">

                <label for="username">
                    {{ __('digital_studio.profile.username') }}
                </label>

                <div class="auth-input-wrapper">

                    <input
                        id="username"
                        type="text"
                        name="username"
                        class="auth-input @error('username') is-invalid @enderror"
                        value="{{ old('username', $user->username) }}"
                        required
                        autocomplete="username">

                    <i class="fa-solid fa-at auth-input-icon"></i>

                </div>

                @error('username')

                    <div class="auth-error">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            <!--==================================
                    EMAIL
            ==================================-->

            <div class="auth-field">

                <label for="email">
                    {{ __('digital_studio.profile.email') }}
                </label>

                <div class="auth-input-wrapper">

                    <input
                        id="email"
                        type="email"
                        name="email"
                        class="auth-input @error('email') is-invalid @enderror"
                        value="{{ old('email', $user->email) }}"
                        required
                        autocomplete="email">

                    <i class="fa-regular fa-envelope auth-input-icon"></i>

                </div>

                @error('email')

                    <div class="auth-error">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            <!--==================================
                    PHONE
            ==================================-->

            <div class="auth-field">

                <label for="phone">

                    {{ __('digital_studio.profile.phone') }}

                    <span style="opacity:.6;">
                        ({{ __('digital_studio.profile.optional') }})
                    </span>

                </label>

                <div class="auth-input-wrapper">

                    <input
                        id="phone"
                        type="text"
                        name="phone"
                        class="auth-input @error('phone') is-invalid @enderror"
                        value="{{ old('phone', $user->phone) }}"
                        autocomplete="tel">

                    <i class="fa-solid fa-phone auth-input-icon"></i>

                </div>

                @error('phone')

                    <div class="auth-error">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            <!--==================================
                    BIO
            ==================================-->

            <div class="auth-field">

                <label for="bio">

                    {{ __('digital_studio.profile.bio') }}

                    <span style="opacity:.6;">
                        ({{ __('digital_studio.profile.optional') }})
                    </span>

                </label>

                <div class="auth-input-wrapper">

                    <textarea
                        id="bio"
                        name="bio"
                        class="auth-input auth-textarea @error('bio') is-invalid @enderror"
                        rows="4"
                        style="height:auto; min-height:110px; padding-top:15px; resize:vertical;"
                        placeholder="{{ __('digital_studio.profile.bio_placeholder') }}">{{ old('bio', $user->bio) }}</textarea>

                    <i
                        class="fa-solid fa-align-left auth-input-icon"
                        style="top:22px; transform:none;">
                    </i>

                </div>

                @error('bio')

                    <div class="auth-error">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            <!--==================================
                    ACCOUNT ROLE
            ==================================-->

            <div class="auth-field">

                <label>
                    {{ __('digital_studio.profile.account_type') }}
                </label>

                <div class="profile-role-box">

                    <div class="profile-role-icon">

                        @if($user->role === 'admin')

                            <i class="fa-solid fa-shield-halved" style="color: white"></i>

                        @else

                            <i class="fa-solid fa-user" style="color: white"></i>

                        @endif

                    </div>

                    <div>

                        <strong style="color: white">

                            @if($user->role === 'admin')
                                {{ __('digital_studio.profile.admin') }}
                            @else
                                {{ __('digital_studio.profile.user') }}
                            @endif

                        </strong>

                        <span style="color: white">
                            {{ __('digital_studio.profile.role_cannot_be_changed') }}
                        </span>

                    </div>

                </div>

            </div>


            <!--==================================
                    SAVE PROFILE
            ==================================-->

            <button
                type="submit"
                class="auth-submit">

                <i class="fa-solid fa-floppy-disk"></i>

                {{ __('digital_studio.profile.save_changes') }}

            </button>

        </form>


        <!--==================================
            CHANGE PASSWORD DIVIDER
        ==================================-->

        <div class="profile-section-divider"></div>


        <!--==================================
            CHANGE PASSWORD SECTION
        ==================================-->

        <div class="profile-password-section">


            <!--==================================
                    PASSWORD HEADER
            ==================================-->

            <div class="auth-header profile-section-header">

                <h2 style="color: white">
                    {{ __('digital_studio.profile.change_password') }}
                </h2>

                <p>
                    {{ __('digital_studio.profile.password_description') }}
                </p>

            </div>


            <!--==================================
                    PASSWORD FORM
            ==================================-->

            <form
                method="POST"
                action="{{ route('profile.password.update') }}"
                class="auth-form">

                @csrf

                @method('PATCH')


                <!--==================================
                    CURRENT PASSWORD
                ==================================-->

                <div class="auth-field">

                    <label for="current_password">
                        {{ __('digital_studio.profile.current_password') }}
                    </label>

                    <div class="auth-input-wrapper auth-password-wrapper">

                        <input
                            id="current_password"
                            type="password"
                            name="current_password"
                            class="auth-input @error('current_password') is-invalid @enderror"
                            required
                            autocomplete="current-password">

                        <i class="fa-solid fa-lock auth-input-icon"></i>

                        <button
                            type="button"
                            class="auth-password-toggle"
                            onclick="togglePassword('current_password', this)"
                            aria-label="{{ __('digital_studio.profile.show_hide_current_password') }}">

                            <i class="fa-regular fa-eye"></i>

                        </button>

                    </div>

                    @error('current_password')

                        <div class="auth-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                <!--==================================
                    NEW PASSWORD
                ==================================-->

                <div class="auth-field">

                    <label for="password">
                        {{ __('digital_studio.profile.new_password') }}
                    </label>

                    <div class="auth-input-wrapper auth-password-wrapper">

                        <input
                            id="password"
                            type="password"
                            name="password"
                            class="auth-input @error('password') is-invalid @enderror"
                            required
                            autocomplete="new-password">

                        <i class="fa-solid fa-key auth-input-icon"></i>

                        <button
                            type="button"
                            class="auth-password-toggle"
                            onclick="togglePassword('password', this)"
                            aria-label="{{ __('digital_studio.profile.show_hide_new_password') }}">

                            <i class="fa-regular fa-eye"></i>

                        </button>

                    </div>

                    @error('password')

                        <div class="auth-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                <!--==================================
                    CONFIRM PASSWORD
                ==================================-->

                <div class="auth-field">

                    <label for="password_confirmation">
                        {{ __('digital_studio.profile.confirm_new_password') }}
                    </label>

                    <div class="auth-input-wrapper auth-password-wrapper">

                        <input
                            id="password_confirmation"
                            type="password"
                            name="password_confirmation"
                            class="auth-input"
                            required
                            autocomplete="new-password">

                        <i class="fa-solid fa-shield-halved auth-input-icon"></i>

                        <button
                            type="button"
                            class="auth-password-toggle"
                            onclick="togglePassword('password_confirmation', this)"
                            aria-label="{{ __('digital_studio.profile.show_hide_password_confirmation') }}">

                            <i class="fa-regular fa-eye"></i>

                        </button>

                    </div>

                </div>


                <!--==================================
                    UPDATE PASSWORD
                ==================================-->

                <button
                    type="submit"
                    class="auth-submit">

                    <i class="fa-solid fa-key"></i>

                    {{ __('digital_studio.profile.update_password') }}

                </button>

            </form>

        </div>


        <!--==================================
                PROFILE FOOTER
        ==================================-->

        <div class="auth-footer">

            <p>

                <a href="{{ route('portal') }}">

                    <i class="fa-solid fa-arrow-left me-1"></i>

                    {{ __('digital_studio.profile.back_to_website') }}

                </a>

            </p>

        </div>


    </div>

</div>

</div>

<!--==================================
            PASSWORD TOGGLE
===================================-->

<script>

function togglePassword(inputId, button) {

    const input = document.getElementById(inputId);

    const icon = button.querySelector('i');

    if (!input || !icon) {
        return;
    }


    if (input.type === 'password') {

        input.type = 'text';

        icon.classList.remove('fa-eye');

        icon.classList.add('fa-eye-slash');

    } else {

        input.type = 'password';

        icon.classList.remove('fa-eye-slash');

        icon.classList.add('fa-eye');

    }

}

</script>

@endsection
