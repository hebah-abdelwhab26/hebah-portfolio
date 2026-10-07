@extends('admin.layouts.app')

@section('title', __('digital_studio_admin.project_categories.create.title'))

@section('content')

<div class="page-header">

    <div class="page-header-content">

        <div class="page-header-left">

            <div class="page-icon">

                <i class="fa-solid fa-folder-tree"></i>

            </div>

            <div>

                <h1>
                    {{ __('digital_studio_admin.project_categories.create.page_header.title') }}
                </h1>

                <p>
                    {{ __('digital_studio_admin.project_categories.create.page_header.description') }}
                </p>

            </div>

        </div>

        <div class="page-header-right">

            <a href="{{ route('admin.project-categories.index') }}"
               class="btn-admin btn-outline">

                <i class="fa-solid fa-arrow-left"></i>

                {{ __('digital_studio_admin.project_categories.create.page_header.back') }}

            </a>

        </div>

    </div>

</div>

<form action="{{ route('admin.project-categories.store') }}"
      method="POST">

    @csrf

    <div class="project-grid">

        <!--==================================
                    LEFT COLUMN
        ==================================-->

        <div class="left-column">

            <div class="admin-card">

                <div class="admin-card-header">

                    <h4>

                        <i class="fa-solid fa-folder-tree"></i>

                        {{ __('digital_studio_admin.project_categories.create.category_information.title') }}

                    </h4>

                </div>

                <div class="admin-card-body">

                    <!-- NAME -->

                    <div class="mb-4">

                        <label class="form-label">

                            {{ __('digital_studio_admin.project_categories.create.fields.category_name') }}

                            <span class="required">*</span>

                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            class="form-control @error('name') is-invalid @enderror"
                            placeholder="{{ __('digital_studio_admin.project_categories.create.fields.category_name_placeholder') }}">

                        @error('name')

                            <div class="invalid-feedback">

                                {{ $message }}

                            </div>

                        @enderror

                    </div>

                    <!-- SLUG -->

                    <div class="mb-4">

                        <label class="form-label">

                            {{ __('digital_studio_admin.project_categories.create.fields.slug') }}

                        </label>

                        <input
                            id="slug"
                            type="text"
                            name="slug"
                            value="{{ old('slug') }}"
                            class="form-control"
                            placeholder="{{ __('digital_studio_admin.project_categories.create.fields.slug_placeholder') }}">

                    </div>

                    <!-- DESCRIPTION -->

                    <div class="mb-4">

                        <label class="form-label">

                            {{ __('digital_studio_admin.project_categories.create.fields.description') }}

                        </label>

                        <textarea
                            name="description"
                            rows="8"
                            class="form-control"
                            placeholder="{{ __('digital_studio_admin.project_categories.create.fields.description_placeholder') }}">{{ old('description') }}</textarea>

                    </div>

                    <!--==================================
                            ICON
                    ==================================-->

                    <div class="mb-4">

                        <label class="form-label">

                            {{ __('digital_studio_admin.project_categories.create.fields.font_awesome_icon') }}

                        </label>

                        <div class="input-group">

                            <span class="input-group-text">

                                <i
                                    id="icon-preview"
                                    class="fa-solid fa-folder-tree">

                                </i>

                            </span>

                            <input
                                id="icon"
                                type="text"
                                name="icon"
                                value="{{ old('icon') }}"
                                class="form-control"
                                placeholder="{{ __('digital_studio_admin.project_categories.create.fields.icon_placeholder') }}">

                        </div>

                        <small class="text-muted mt-2 d-block">

                            {{ __('digital_studio_admin.project_categories.create.fields.icon_example') }}

                        </small>

                    </div>

                </div>

            </div>

        </div>

        <!--==================================
                    RIGHT COLUMN
        ==================================-->

        <div class="right-column">

            <div class="admin-card sticky-card">

                <div class="admin-card-header">

                    <h4>

                        <i class="fa-solid fa-gear"></i>

                        {{ __('digital_studio_admin.project_categories.create.publish_settings.title') }}

                    </h4>

                </div>

                <div class="admin-card-body">

                    <!--==================================
                            CATEGORY TYPE
                    ==================================-->

                    <div class="mb-4">

                        <label class="form-label">

                            {{ __('digital_studio_admin.project_categories.create.category_type.label') }}

                            <span class="required">*</span>

                        </label>

                        <select
                            name="type"
                            class="form-select @error('type') is-invalid @enderror">

                            <option value="">

                                {{ __('digital_studio_admin.project_categories.create.category_type.placeholder') }}

                            </option>

                            <option
                                value="development"
                                {{ old('type') == 'development' ? 'selected' : '' }}>

                                💻 {{ __('digital_studio_admin.project_categories.create.category_type.development') }}

                            </option>

                            <option
                                value="design"
                                {{ old('type') == 'design' ? 'selected' : '' }}>

                                🎨 {{ __('digital_studio_admin.project_categories.create.category_type.design') }}

                            </option>

                        </select>

                        @error('type')

                            <div class="invalid-feedback">

                                {{ $message }}

                            </div>

                        @enderror

                    </div>

                    <!--==================================
                            COLOR
                    ==================================-->

                    <div class="mb-4">

                        <label class="form-label">

                            {{ __('digital_studio_admin.project_categories.create.color.label') }}

                        </label>

                        <div class="d-flex align-items-center gap-3">

                            <input
                                id="color"
                                type="color"
                                name="color"
                                value="{{ old('color','#2563EB') }}"
                                class="form-control form-control-color"
                                style="width:80px;height:56px;">

                            <span
                                id="color-preview"
                                style="
                                    width:36px;
                                    height:36px;
                                    border-radius:50%;
                                    background:{{ old('color','#2563EB') }};
                                    border:2px solid rgba(255,255,255,.12);
                                ">

                            </span>

                        </div>

                    </div>

                    <!--==================================
                            SORT ORDER
                    ==================================-->

                    <div class="setting-item">

                        <div>

                            <h6>

                                {{ __('digital_studio_admin.project_categories.create.sort_order.title') }}

                            </h6>

                            <small>

                                {{ __('digital_studio_admin.project_categories.create.sort_order.description') }}

                            </small>

                        </div>

                    </div>

                    <div class="mb-4">

                        <input
                            type="number"
                            name="sort_order"
                            value="{{ old('sort_order',0) }}"
                            class="form-control">

                    </div>

                    <!--==================================
                            ACTIVE
                    ==================================-->

                    <div class="setting-item">

                        <div>

                            <h6>

                                {{ __('digital_studio_admin.project_categories.create.active.title') }}

                            </h6>

                            <small>

                                {{ __('digital_studio_admin.project_categories.create.active.description') }}

                            </small>

                        </div>

                        <label class="switch">

                            <input
                                type="checkbox"
                                name="is_active"
                                value="1"
                                checked>

                            <span class="slider"></span>

                        </label>

                    </div>

                    <hr class="admin-divider">

                    <button
                        type="submit"
                        class="btn-admin-primary w-100">

                        <i class="fa-solid fa-floppy-disk"></i>

                        {{ __('digital_studio_admin.project_categories.create.actions.save') }}

                    </button>

                </div>

            </div>

        </div>

    </div>

</form>

@endsection

@push('scripts')

<script>

document.addEventListener("DOMContentLoaded", function () {

    /*
    |--------------------------------------------------------------------------
    | Slug Generator
    |--------------------------------------------------------------------------
    */

    const name = document.querySelector("input[name='name']");
    const slug = document.getElementById("slug");

    name.addEventListener("keyup", function () {

        if (slug.value === "") {

            slug.value = name.value

                .toLowerCase()

                .trim()

                .replace(/[^a-z0-9]+/g, "-")

                .replace(/^-+|-+$/g, "");

        }

    });

    /*
    |--------------------------------------------------------------------------
    | Icon Preview
    |--------------------------------------------------------------------------
    */

    const iconInput = document.getElementById("icon");
    const iconPreview = document.getElementById("icon-preview");

    iconInput.addEventListener("keyup", function () {

        iconPreview.className =
            iconInput.value || "fa-solid fa-folder-tree";

    });

    /*
    |--------------------------------------------------------------------------
    | Color Preview
    |--------------------------------------------------------------------------
    */

    const color = document.getElementById("color");
    const preview = document.getElementById("color-preview");

    color.addEventListener("input", function () {

        preview.style.background = color.value;

    });

});

</script>

@endpush
