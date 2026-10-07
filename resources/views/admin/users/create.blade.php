@extends('admin.layouts.app')

@section('title', __('digital_studio_admin.users.create.title'))

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

                    {{ __('digital_studio_admin.users.create.breadcrumb.users') }}

                </span>

                <i class="fa-solid fa-angle-right"></i>

                <span>

                    {{ __('digital_studio_admin.users.create.breadcrumb.create') }}

                </span>

            </div>

            <h1>

                {{ __('digital_studio_admin.users.create.page_header.title') }}

            </h1>

            <p>

                {{ __('digital_studio_admin.users.create.page_header.description') }}

            </p>

        </div>

        <div class="dashboard-header-right">

            <a
                href="{{ route('admin.users.index') }}"
                class="btn btn-light rounded-pill px-4"
            >

                <i class="fa-solid fa-arrow-left me-2"></i>

                {{ __('digital_studio_admin.users.create.page_header.back') }}

            </a>

        </div>

    </div>


    <!--==================================
                VALIDATION
    ==================================-->

    @if($errors->any())

        <div class="alert alert-danger rounded-4 shadow-sm mb-4">

            <h6 class="fw-bold mb-3">

                <i class="fa-solid fa-circle-exclamation me-2"></i>

                {{ __('digital_studio_admin.users.create.validation.title') }}

            </h6>

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <form
        action="{{ route('admin.users.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf


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

                        {{ __('digital_studio_admin.users.create.basic_information.title') }}

                    </h4>

                    <small>

                        {{ __('digital_studio_admin.users.create.basic_information.description') }}

                    </small>

                </div>

            </div>


            <div class="row">


                <!--==================================
                        AVATAR
                ==================================-->

                <div class="col-lg-4 mb-4">

                    <label class="form-label fw-semibold">

                        {{ __('digital_studio_admin.users.create.avatar.label') }}

                    </label>

                    <label class="upload-box">

                        <input
                            type="file"
                            name="avatar"
                            class="d-none"
                        >

                        <div class="upload-placeholder">

                            <i class="fa-solid fa-cloud-arrow-up"></i>

                            <p class="mb-0">

                                {{ __('digital_studio_admin.users.create.avatar.upload') }}

                            </p>

                        </div>

                    </label>

                </div>


                <!--==================================
                        USER INFO
                ==================================-->

                <div class="col-lg-8">

                    <div class="row">


                        <!-- Name -->

                        <div class="col-md-6 mb-4">

                            <label class="form-label fw-semibold">

                                {{ __('digital_studio_admin.users.create.fields.full_name') }}

                            </label>

                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                value="{{ old('name') }}"
                                placeholder="{{ __('digital_studio_admin.users.create.placeholders.full_name') }}"
                            >

                        </div>


                        <!-- Username -->

                        <div class="col-md-6 mb-4">

                            <label class="form-label fw-semibold">

                                {{ __('digital_studio_admin.users.create.fields.username') }}

                            </label>

                            <input
                                type="text"
                                name="username"
                                class="form-control"
                                value="{{ old('username') }}"
                                placeholder="{{ __('digital_studio_admin.users.create.placeholders.username') }}"
                            >

                        </div>


                        <!-- Email -->

                        <div class="col-md-6 mb-4">

                            <label class="form-label fw-semibold">

                                {{ __('digital_studio_admin.users.create.fields.email') }}

                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                value="{{ old('email') }}"
                                placeholder="{{ __('digital_studio_admin.users.create.placeholders.email') }}"
                            >

                        </div>


                        <!-- Phone -->

                        <div class="col-md-6 mb-4">

                            <label class="form-label fw-semibold">

                                {{ __('digital_studio_admin.users.create.fields.phone') }}

                            </label>

                            <input
                                type="text"
                                name="phone"
                                class="form-control"
                                value="{{ old('phone') }}"
                                placeholder="{{ __('digital_studio_admin.users.create.placeholders.phone') }}"
                            >

                        </div>


                        <!-- Bio -->

                        <div class="col-12">

                            <label class="form-label fw-semibold">

                                {{ __('digital_studio_admin.users.create.fields.bio') }}

                            </label>

                            <textarea
                                name="bio"
                                rows="5"
                                class="form-control"
                                placeholder="{{ __('digital_studio_admin.users.create.placeholders.bio') }}"
                            >{{ old('bio') }}</textarea>

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

                        {{ __('digital_studio_admin.users.create.account_settings.title') }}

                    </h4>

                    <small>

                        {{ __('digital_studio_admin.users.create.account_settings.description') }}

                    </small>

                </div>

            </div>


            <div class="row">


                <!--==================================
                        ROLE
                ==================================-->

                <div class="col-lg-6 mb-4">

                    <label class="form-label fw-semibold">

                        {{ __('digital_studio_admin.users.create.role') }}

                    </label>

                    <select
                        name="role"
                        class="form-select"
                    >

                        <option
                            value="user"
                            @selected(old('role') == 'user')
                        >

                            {{ __('digital_studio_admin.users.create.roles.user') }}

                        </option>

                        <option
                            value="editor"
                            @selected(old('role') == 'editor')
                        >

                            {{ __('digital_studio_admin.users.create.roles.editor') }}

                        </option>

                        <option
                            value="admin"
                            @selected(old('role') == 'admin')
                        >

                            {{ __('digital_studio_admin.users.create.roles.admin') }}

                        </option>

                        <option
                            value="super_admin"
                            @selected(old('role') == 'super_admin')
                        >

                            {{ __('digital_studio_admin.users.create.roles.super_admin') }}

                        </option>

                    </select>

                </div>


                <!--==================================
                        STATUS
                ==================================-->

                <div class="col-lg-6 mb-4">

                    <label class="form-label fw-semibold">

                        {{ __('digital_studio_admin.users.create.account_status') }}

                    </label>

                    <select
                        name="status"
                        class="form-select"
                    >

                        <option
                            value="active"
                            @selected(old('status') == 'active')
                        >

                            {{ __('digital_studio_admin.users.create.statuses.active') }}

                        </option>

                        <option
                            value="inactive"
                            @selected(old('status') == 'inactive')
                        >

                            {{ __('digital_studio_admin.users.create.statuses.inactive') }}

                        </option>

                        <option
                            value="blocked"
                            @selected(old('status') == 'blocked')
                        >

                            {{ __('digital_studio_admin.users.create.statuses.blocked') }}

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

                                {{ __('digital_studio_admin.users.create.email_verified.title') }}

                            </h6>

                            <small class="text-muted">

                                {{ __('digital_studio_admin.users.create.email_verified.description') }}

                            </small>

                        </div>

                        <div class="form-check form-switch">

                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="email_verified"
                                value="1"
                                @checked(old('email_verified'))
                            >

                        </div>

                    </div>

                </div>


                <!--==================================
                        ACCOUNT ACTIVE
                ==================================-->

                <div class="col-lg-6 mb-4">

                    <div class="setting-card">

                        <div>

                            <h6 class="mb-1">

                                {{ __('digital_studio_admin.users.create.enable_login.title') }}

                            </h6>

                            <small class="text-muted">

                                {{ __('digital_studio_admin.users.create.enable_login.description') }}

                            </small>

                        </div>

                        <div class="form-check form-switch">

                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="is_active"
                                value="1"
                                @checked(old('is_active', true))
                            >

                        </div>

                    </div>

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

                        {{ __('digital_studio_admin.users.create.security.title') }}

                    </h4>

                    <small>

                        {{ __('digital_studio_admin.users.create.security.description') }}

                    </small>

                </div>

            </div>


            <div class="row">


                <!-- Password -->

                <div class="col-lg-6 mb-4">

                    <label class="form-label fw-semibold">

                        {{ __('digital_studio_admin.users.create.password') }}

                    </label>

                    <div class="input-group">

                        <span class="input-group-text">

                            <i class="fa-solid fa-key"></i>

                        </span>

                        <input
                            type="password"
                            name="password"
                            class="form-control"
                            placeholder="{{ __('digital_studio_admin.users.create.password_placeholders.password') }}"
                        >

                    </div>

                </div>


                <!-- Confirm Password -->

                <div class="col-lg-6 mb-4">

                    <label class="form-label fw-semibold">

                        {{ __('digital_studio_admin.users.create.confirm_password') }}

                    </label>

                    <div class="input-group">

                        <span class="input-group-text">

                            <i class="fa-solid fa-key"></i>

                        </span>

                        <input
                            type="password"
                            name="password_confirmation"
                            class="form-control"
                            placeholder="{{ __('digital_studio_admin.users.create.password_placeholders.confirm_password') }}"
                        >

                    </div>

                </div>


                <!-- Password Hint -->

                <div class="col-12">

                    <div class="alert alert-info rounded-4 mb-0">

                        <i class="fa-solid fa-circle-info me-2"></i>

                        {{ __('digital_studio_admin.users.create.password_hint') }}

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
                    class="btn btn-light rounded-pill px-4"
                >

                    <i class="fa-solid fa-arrow-left me-2"></i>

                    {{ __('digital_studio_admin.users.create.actions.cancel') }}

                </a>

                <button
                    type="submit"
                    class="btn btn-primary rounded-pill px-5"
                >

                    <i class="fa-solid fa-floppy-disk me-2"></i>

                    {{ __('digital_studio_admin.users.create.actions.create_user') }}

                </button>

            </div>

        </div>

    </form>

</div>

@endsection
