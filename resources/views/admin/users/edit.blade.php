@extends('admin.layouts.app')

@section('title', __('digital_studio_admin.users.edit.title'))

@section('content')

<div class="page-wrapper fade-up">

    <!--==================================
                PAGE HEADER
    ==================================-->

    <div class="dashboard-header">

        <div class="dashboard-header-left">

            <div class="dashboard-breadcrumb">

                <i class="fa-solid fa-users"></i>

                <span>

                    {{ __('digital_studio_admin.users.edit.breadcrumb.users') }}

                </span>

                <i class="fa-solid fa-angle-right"></i>

                <span>

                    {{ __('digital_studio_admin.users.edit.breadcrumb.edit') }}

                </span>

            </div>

            <h1>

                {{ __('digital_studio_admin.users.edit.page_header.title') }}

            </h1>

            <p>

                {{ __('digital_studio_admin.users.edit.page_header.description') }}

            </p>

        </div>

        <div class="dashboard-header-right">

            <a
                href="{{ route('admin.users.index') }}"
                class="btn btn-light rounded-pill px-4">

                <i class="fa-solid fa-arrow-left me-2"></i>

                {{ __('digital_studio_admin.users.edit.page_header.back') }}

            </a>

        </div>

    </div>


    <!--==================================
                ALERTS
    ==================================-->

    @if(session('success'))

        <div class="alert alert-success rounded-4 shadow-sm mb-4">

            <i class="fa-solid fa-circle-check me-2"></i>

            {{ session('success') }}

        </div>

    @endif


    @if($errors->any())

        <div class="alert alert-danger rounded-4 shadow-sm mb-4">

            <h6 class="fw-bold mb-3">

                <i class="fa-solid fa-circle-exclamation me-2"></i>

                {{ __('digital_studio_admin.users.edit.alerts.validation') }}

            </h6>

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <form
        action="{{ route('admin.users.update',$user) }}"
        method="POST"
        enctype="multipart/form-data">

        @csrf

        @method('PUT')


        <!--==================================
                BASIC INFORMATION
        ==================================-->

        <div class="admin-card mb-4">

            <div class="d-flex align-items-center mb-4">

                <div class="me-3">

                    <div class="dashboard-icon">

                        <i class="fa-solid fa-id-card"></i>

                    </div>

                </div>

                <div>

                    <h4 class="card-title mb-1">

                        {{ __('digital_studio_admin.users.edit.basic_information.title') }}

                    </h4>

                    <small>

                        {{ __('digital_studio_admin.users.edit.basic_information.description') }}

                    </small>

                </div>

            </div>


            <div class="row">


                <!--==================================
                        AVATAR
                ==================================-->

                <div class="col-lg-4 mb-4">

                    <label class="form-label fw-semibold">

                        {{ __('digital_studio_admin.users.edit.avatar.label') }}

                    </label>


                    <div class="admin-card p-3">


                        <!--==================================
                                IMAGE PREVIEW
                        ==================================-->

                        <div
                            id="avatar-preview-wrapper"
                            class="mb-3">

                            @if($user->avatar)

                                <img
                                    id="avatar-preview"
                                    src="{{ $user->avatar_url }}"
                                    class="img-fluid rounded-4"
                                    style="
                                        width:100%;
                                        height:260px;
                                        object-fit:cover;
                                    "
                                >

                            @else

                                <div
                                    id="avatar-placeholder"
                                    class="upload-placeholder"
                                    style="
                                        height:260px;
                                        display:flex;
                                        flex-direction:column;
                                        align-items:center;
                                        justify-content:center;
                                    "
                                >

                                    <i class="fa-solid fa-user"></i>

                                    <p class="mb-0">

                                        {{ __('digital_studio_admin.users.edit.avatar.no_image') }}

                                    </p>

                                </div>

                                <img
                                    id="avatar-preview"
                                    src=""
                                    class="img-fluid rounded-4 d-none"
                                    style="
                                        width:100%;
                                        height:260px;
                                        object-fit:cover;
                                    "
                                >

                            @endif

                        </div>


                        <!--==================================
                                FILE INPUT
                        ==================================-->

                        <label
                            for="avatar"
                            class="btn btn-light rounded-pill px-4 w-100 mb-2">

                            <i class="fa-solid fa-camera me-2"></i>

                            {{ __('digital_studio_admin.users.edit.avatar.choose_new') }}

                        </label>


                        <input
                            type="file"
                            name="avatar"
                            id="avatar"
                            class="d-none"
                            accept="image/*"
                        >


                        <!--==================================
                                DELETE CURRENT AVATAR
                        ==================================-->

                        @if($user->avatar)

                            <button
                                type="button"
                                id="remove-avatar-btn"
                                class="btn btn-danger rounded-pill px-4 w-100">

                                <i class="fa-solid fa-trash me-2"></i>

                                {{ __('digital_studio_admin.users.edit.avatar.delete') }}

                            </button>

                            <input
                                type="hidden"
                                name="remove_avatar"
                                id="remove_avatar"
                                value="0"
                            >

                        @else

                            <input
                                type="hidden"
                                name="remove_avatar"
                                id="remove_avatar"
                                value="0"
                            >

                        @endif


                        <!--==================================
                                SELECTED FILE NAME
                        ==================================-->

                        <div
                            id="avatar-file-name"
                            class="small text-muted text-center mt-3">

                        </div>


                    </div>

                </div>


                <!--==================================
                        USER INFORMATION
                ==================================-->

                <div class="col-lg-8">

                    <div class="row">


                        <!-- Full Name -->

                        <div class="col-md-6 mb-4">

                            <label class="form-label fw-semibold">

                                {{ __('digital_studio_admin.users.edit.fields.full_name') }}

                            </label>

                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                value="{{ old('name',$user->name) }}"
                            >

                        </div>


                        <!-- Username -->

                        <div class="col-md-6 mb-4">

                            <label class="form-label fw-semibold">

                                {{ __('digital_studio_admin.users.edit.fields.username') }}

                            </label>

                            <input
                                type="text"
                                name="username"
                                class="form-control"
                                value="{{ old('username',$user->username) }}"
                            >

                        </div>


                        <!-- Email -->

                        <div class="col-md-6 mb-4">

                            <label class="form-label fw-semibold">

                                {{ __('digital_studio_admin.users.edit.fields.email') }}

                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                value="{{ old('email',$user->email) }}"
                            >

                        </div>


                        <!-- Phone -->

                        <div class="col-md-6 mb-4">

                            <label class="form-label fw-semibold">

                                {{ __('digital_studio_admin.users.edit.fields.phone') }}

                            </label>

                            <input
                                type="text"
                                name="phone"
                                class="form-control"
                                value="{{ old('phone',$user->phone) }}"
                            >

                        </div>


                        <!-- Bio -->

                        <div class="col-12">

                            <label class="form-label fw-semibold">

                                {{ __('digital_studio_admin.users.edit.fields.bio') }}

                            </label>

                            <textarea
                                name="bio"
                                rows="5"
                                class="form-control"
                            >{{ old('bio',$user->bio) }}</textarea>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        <!--==================================
                ACCOUNT SETTINGS
        ==================================-->

        <div class="admin-card mb-4">

            <div class="d-flex align-items-center mb-4">

                <div class="me-3">

                    <div class="dashboard-icon">

                        <i class="fa-solid fa-user-gear"></i>

                    </div>

                </div>

                <div>

                    <h4 class="card-title mb-1">

                        {{ __('digital_studio_admin.users.edit.account_settings.title') }}

                    </h4>

                    <small>

                        {{ __('digital_studio_admin.users.edit.account_settings.description') }}

                    </small>

                </div>

            </div>


            <div class="row">


                <!--==================================
                        ROLE
                ==================================-->

                <div class="col-lg-6 mb-4">

                    <label class="form-label fw-semibold">

                        {{ __('digital_studio_admin.users.edit.role') }}

                    </label>

                    <select
                        name="role"
                        class="form-select">

                        <option
                            value="user"
                            @selected(old('role',$user->role) == 'user')>

                            {{ __('digital_studio_admin.users.edit.roles.user') }}

                        </option>

                        <option
                            value="editor"
                            @selected(old('role',$user->role) == 'editor')>

                            {{ __('digital_studio_admin.users.edit.roles.editor') }}

                        </option>

                        <option
                            value="admin"
                            @selected(old('role',$user->role) == 'admin')>

                            {{ __('digital_studio_admin.users.edit.roles.admin') }}

                        </option>

                        <option
                            value="super_admin"
                            @selected(old('role',$user->role) == 'super_admin')>

                            {{ __('digital_studio_admin.users.edit.roles.super_admin') }}

                        </option>

                    </select>

                </div>


                <!--==================================
                        STATUS
                ==================================-->

                <div class="col-lg-6 mb-4">

                    <label class="form-label fw-semibold">

                        {{ __('digital_studio_admin.users.edit.account_status') }}

                    </label>

                    <select
                        name="status"
                        class="form-select">

                        <option
                            value="active"
                            @selected(old('status',$user->status) == 'active')>

                            {{ __('digital_studio_admin.users.edit.statuses.active') }}

                        </option>

                        <option
                            value="inactive"
                            @selected(old('status',$user->status) == 'inactive')>

                            {{ __('digital_studio_admin.users.edit.statuses.inactive') }}

                        </option>

                        <option
                            value="blocked"
                            @selected(old('status',$user->status) == 'blocked')>

                            {{ __('digital_studio_admin.users.edit.statuses.blocked') }}

                        </option>

                    </select>

                </div>


                <!--==================================
                        EMAIL VERIFIED
                ==================================-->

                <div class="col-lg-6 mb-4">

                    <div class="setting-card">

                        <div>

                            <h6 class="mb-1">

                                {{ __('digital_studio_admin.users.edit.email_verified.title') }}

                            </h6>

                            <small class="text-muted">

                                {{ __('digital_studio_admin.users.edit.email_verified.description') }}

                            </small>

                        </div>

                        <div class="form-check form-switch">

                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="email_verified"
                                value="1"
                                @checked(
                                    old(
                                        'email_verified',
                                        !is_null($user->email_verified_at)
                                    )
                                )
                            >

                        </div>

                    </div>

                </div>


                <!--==================================
                        ENABLE LOGIN
                ==================================-->

                <div class="col-lg-6 mb-4">

                    <div class="setting-card">

                        <div>

                            <h6 class="mb-1">

                                {{ __('digital_studio_admin.users.edit.enable_login.title') }}

                            </h6>

                            <small class="text-muted">

                                {{ __('digital_studio_admin.users.edit.enable_login.description') }}

                            </small>

                        </div>

                        <div class="form-check form-switch">

                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="is_active"
                                value="1"
                                @checked(old('is_active',$user->is_active))
                            >

                        </div>

                    </div>

                </div>


                <!--==================================
                        LAST LOGIN
                ==================================-->

                <div class="col-lg-6">

                    <label class="form-label fw-semibold">

                        {{ __('digital_studio_admin.users.edit.last_login') }}

                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="{{ optional($user->last_login_at)->diffForHumans() ?? __('digital_studio_admin.users.edit.never_logged_in') }}"
                        readonly
                    >

                </div>


                <!--==================================
                        REGISTERED
                ==================================-->

                <div class="col-lg-6">

                    <label class="form-label fw-semibold">

                        {{ __('digital_studio_admin.users.edit.member_since') }}

                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="{{ $user->created_at->format('d M Y - h:i A') }}"
                        readonly
                    >

                </div>

            </div>

        </div>


        <!--==================================
                SECURITY
        ==================================-->

        <div class="admin-card mb-4">

            <div class="d-flex align-items-center mb-4">

                <div class="me-3">

                    <div class="dashboard-icon">

                        <i class="fa-solid fa-lock"></i>

                    </div>

                </div>

                <div>

                    <h4 class="card-title mb-1">

                        {{ __('digital_studio_admin.users.edit.security.title') }}

                    </h4>

                    <small>

                        {{ __('digital_studio_admin.users.edit.security.description') }}

                    </small>

                </div>

            </div>


            <div class="row">


                <!--==================================
                        NEW PASSWORD
                ==================================-->

                <div class="col-lg-6 mb-4">

                    <label class="form-label fw-semibold">

                        {{ __('digital_studio_admin.users.edit.password.new') }}

                    </label>

                    <div class="input-group">

                        <span class="input-group-text">

                            <i class="fa-solid fa-key"></i>

                        </span>

                        <input
                            type="password"
                            name="password"
                            class="form-control"
                            placeholder="{{ __('digital_studio_admin.users.edit.password_placeholders.new') }}"
                        >

                    </div>

                </div>


                <!--==================================
                        CONFIRM PASSWORD
                ==================================-->

                <div class="col-lg-6 mb-4">

                    <label class="form-label fw-semibold">

                        {{ __('digital_studio_admin.users.edit.password.confirm') }}

                    </label>

                    <div class="input-group">

                        <span class="input-group-text">

                            <i class="fa-solid fa-key"></i>

                        </span>

                        <input
                            type="password"
                            name="password_confirmation"
                            class="form-control"
                            placeholder="{{ __('digital_studio_admin.users.edit.password_placeholders.confirm') }}"
                        >

                    </div>

                </div>


                <!--==================================
                        SECURITY INFO
                ==================================-->

                <div class="col-12">

                    <div class="alert alert-warning rounded-4 mb-0">

                        <i class="fa-solid fa-shield-halved me-2"></i>

                        {{ __('digital_studio_admin.users.edit.security_info') }}

                    </div>

                </div>

            </div>

        </div>


        <!--==================================
                ACTIONS
        ==================================-->

        <div class="admin-card">

            <div class="d-flex justify-content-end gap-3 flex-wrap">

                <a
                    href="{{ route('admin.users.index') }}"
                    class="btn btn-light rounded-pill px-4">

                    <i class="fa-solid fa-arrow-left me-2"></i>

                    {{ __('digital_studio_admin.users.edit.actions.cancel') }}

                </a>

                <button
                    type="submit"
                    class="btn btn-primary rounded-pill px-5">

                    <i class="fa-solid fa-floppy-disk me-2"></i>

                    {{ __('digital_studio_admin.users.edit.actions.save_changes') }}

                </button>

            </div>

        </div>

    </form>

</div>


@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {

    const avatarInput =
        document.getElementById('avatar');

    const avatarPreview =
        document.getElementById('avatar-preview');

    const avatarPlaceholder =
        document.getElementById('avatar-placeholder');

    const removeAvatarInput =
        document.getElementById('remove_avatar');

    const removeAvatarButton =
        document.getElementById('remove-avatar-btn');

    const avatarFileName =
        document.getElementById('avatar-file-name');


    /*
    |--------------------------------------------------------------------------
    | PREVIEW NEW AVATAR
    |--------------------------------------------------------------------------
    */

    if (avatarInput) {

        avatarInput.addEventListener('change', function () {

            const file = this.files[0];

            if (!file) {
                return;
            }


            /*
            | Reset remove flag
            */

            if (removeAvatarInput) {

                removeAvatarInput.value = '0';

            }


            /*
            | Show file name
            */

            if (avatarFileName) {

                avatarFileName.textContent =
                    file.name;

            }


            /*
            | Create preview
            */

            const reader =
                new FileReader();


            reader.onload = function (event) {

                if (avatarPreview) {

                    avatarPreview.src =
                        event.target.result;

                    avatarPreview.classList.remove(
                        'd-none'
                    );

                }


                if (avatarPlaceholder) {

                    avatarPlaceholder.classList.add(
                        'd-none'
                    );

                }

            };


            reader.readAsDataURL(file);

        });

    }


    /*
    |--------------------------------------------------------------------------
    | REMOVE AVATAR
    |--------------------------------------------------------------------------
    */

    if (removeAvatarButton) {

        removeAvatarButton.addEventListener(
            'click',
            function () {


                /*
                | Mark avatar for deletion
                */

                if (removeAvatarInput) {

                    removeAvatarInput.value = '1';

                }


                /*
                | Remove selected file
                */

                if (avatarInput) {

                    avatarInput.value = '';

                }


                /*
                | Hide current image
                */

                if (avatarPreview) {

                    avatarPreview.src = '';

                    avatarPreview.classList.add(
                        'd-none'
                    );

                }


                /*
                | Show placeholder
                */

                if (avatarPlaceholder) {

                    avatarPlaceholder.classList.remove(
                        'd-none'
                    );

                }


                /*
                | Clear filename
                */

                if (avatarFileName) {

                    avatarFileName.textContent =
                        '{{ __('digital_studio_admin.users.edit.avatar.removed_on_save') }}';

                }


                /*
                | Hide delete button
                */

                removeAvatarButton.classList.add(
                    'd-none'
                );

            }
        );

    }

});

</script>

@endpush

@endsection
