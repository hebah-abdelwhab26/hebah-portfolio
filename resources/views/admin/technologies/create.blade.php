@extends('admin.layouts.app')

@section('title', __('digital_studio_admin.technologies.create.title'))

@section('content')

<div class="container-fluid">

    <!--==================================
                PAGE HEADER
    ==================================-->

    <div class="page-header">

        <div class="page-header-content">

            <div class="page-header-left">

                <div class="page-icon">

                    <i class="fa-solid fa-microchip"></i>

                </div>

                <div>

                    <h1>

                        {{ __('digital_studio_admin.technologies.create.page_header.title') }}

                    </h1>

                    <p>

                        {{ __('digital_studio_admin.technologies.create.page_header.description') }}

                    </p>

                </div>

            </div>

            <div class="page-header-right">

                <a
                    href="{{ route('admin.technologies.index') }}"
                    class="btn-admin">

                    <i class="fa-solid fa-arrow-left"></i>

                    {{ __('digital_studio_admin.technologies.create.page_header.back') }}

                </a>

            </div>

        </div>

    </div>

    <!--==================================
                FORM
    ==================================-->

    <form
        action="{{ route('admin.technologies.store') }}"
        method="POST">

        @csrf

        <div class="project-grid">

            <!--==================================
                    LEFT COLUMN
            ==================================-->

            <div class="left-column">

                <!--==================================
                        TECHNOLOGY INFORMATION
                ==================================-->

                <div class="admin-card">

                    <div class="admin-card-header">

                        <h4>

                            <i class="fa-solid fa-microchip"></i>

                            {{ __('digital_studio_admin.technologies.create.technology_information.title') }}

                        </h4>

                    </div>

                    <div class="admin-card-body">

                        <!--==================================
                                CATEGORY
                        ==================================-->

                        <div class="mb-4">

                            <label class="form-label">

                                {{ __('digital_studio_admin.technologies.create.fields.category') }}

                                <span class="required">*</span>

                            </label>

                            <select
                                name="technology_category_id"
                                class="form-select @error('technology_category_id') is-invalid @enderror">

                                <option value="">

                                    {{ __('digital_studio_admin.technologies.create.fields.select_category') }}

                                </option>

                                @foreach($categories as $category)

                                    <option
                                        value="{{ $category->id }}"
                                        @selected(old('technology_category_id') == $category->id)>

                                        {{ $category->name }}

                                    </option>

                                @endforeach

                            </select>

                            @error('technology_category_id')

                                <div class="invalid-feedback">

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>

                        <!--==================================
                                TECHNOLOGY NAME
                        ==================================-->

                        <div class="mb-4">

                            <label class="form-label">

                                {{ __('digital_studio_admin.technologies.create.fields.technology_name') }}

                                <span class="required">*</span>

                            </label>

                            <input
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="{{ __('digital_studio_admin.technologies.create.fields.technology_name_placeholder') }}">

                            @error('name')

                                <div class="invalid-feedback">

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>

                        <!--==================================
                                SLUG
                        ==================================-->

                        <div class="mb-4">

                            <label class="form-label">

                                {{ __('digital_studio_admin.technologies.create.fields.slug') }}

                            </label>

                            <input
                                id="slug"
                                type="text"
                                name="slug"
                                value="{{ old('slug') }}"
                                class="form-control"
                                placeholder="{{ __('digital_studio_admin.technologies.create.fields.slug_placeholder') }}">

                        </div>

                        <!--==================================
                                DESCRIPTION
                        ==================================-->

                        <div class="mb-0">

                            <label class="form-label">

                                {{ __('digital_studio_admin.technologies.create.fields.description') }}

                            </label>

                            <textarea
                                id="description"
                                name="description"
                                class="form-control"
                                placeholder="{{ __('digital_studio_admin.technologies.create.fields.description_placeholder') }}">{{ old('description') }}</textarea>

                        </div>

                        <!--==================================
                                APPEARANCE
                        ==================================-->

                        <div class="admin-card mt-4">

                            <div class="admin-card-header">

                                <h4>

                                    <i class="fa-solid fa-icons"></i>

                                    {{ __('digital_studio_admin.technologies.create.appearance.title') }}

                                </h4>

                            </div>

                            <div class="admin-card-body">

                                <!-- Icon -->

                                <div class="mb-4">

                                    <label class="form-label">

                                        {{ __('digital_studio_admin.technologies.create.appearance.icon') }}

                                        <span class="required">*</span>

                                    </label>

                                    <div class="input-group">

                                        <span class="input-group-text">

                                            <i
                                                id="icon-preview"
                                                class="{{ old('icon','fa-solid fa-code') }}">
                                            </i>

                                        </span>

                                        <input
                                            id="icon"
                                            type="text"
                                            name="icon"
                                            value="{{ old('icon') }}"
                                            class="form-control @error('icon') is-invalid @enderror"
                                            placeholder="{{ __('digital_studio_admin.technologies.create.appearance.icon_placeholder') }}">

                                    </div>

                                    <small class="text-muted mt-2 d-block">

                                        {{ __('digital_studio_admin.technologies.create.appearance.example') }}

                                        fa-brands fa-laravel

                                    </small>

                                    @error('icon')

                                        <div class="invalid-feedback">

                                            {{ $message }}

                                        </div>

                                    @enderror

                                </div>

                                <!-- Color -->

                                <div>

                                    <label class="form-label">

                                        {{ __('digital_studio_admin.technologies.create.appearance.color') }}

                                    </label>

                                    <div class="d-flex align-items-center gap-3">

                                        <input
                                            id="color"
                                            type="color"
                                            name="color"
                                            value="{{ old('color','#2563EB') }}"
                                            class="form-control form-control-color">

                                        <div
                                            id="color-preview"
                                            style="
                                                width:42px;
                                                height:42px;
                                                border-radius:50%;
                                                background:{{ old('color','#2563EB') }};
                                                border:2px solid rgba(255,255,255,.15);
                                            ">
                                        </div>

                                    </div>

                                    @error('color')

                                        <div class="invalid-feedback">

                                            {{ $message }}

                                        </div>

                                    @enderror

                                </div>

                            </div>

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

                            <i class="fa-solid fa-sliders"></i>

                            {{ __('digital_studio_admin.technologies.create.publish_settings.title') }}

                        </h4>

                    </div>

                    <div class="admin-card-body">

                        <!--==================================
                                SORT ORDER
                        ==================================-->

                        <div class="mb-4">

                            <label class="form-label">

                                {{ __('digital_studio_admin.technologies.create.publish_settings.sort_order') }}

                            </label>

                            <input
                                type="number"
                                name="sort_order"
                                value="{{ old('sort_order',0) }}"
                                class="form-control">

                        </div>

                        <hr class="admin-divider">

                        <!--==================================
                                STATUS
                        ==================================-->

                        <div class="setting-item">

                            <div>

                                <h6>

                                    {{ __('digital_studio_admin.technologies.create.publish_settings.active.title') }}

                                </h6>

                                <small>

                                    {{ __('digital_studio_admin.technologies.create.publish_settings.active.description') }}

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

                        <div class="mt-4">

                            <button
                                type="submit"
                                class="btn-admin-primary w-100">

                                <i class="fa-solid fa-floppy-disk"></i>

                                {{ __('digital_studio_admin.technologies.create.actions.save') }}

                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </form>

</div>

@endsection

@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function(){

    /*==================================
            AUTO SLUG
    ==================================*/

    const name = document.querySelector('[name="name"]');
    const slug = document.getElementById('slug');

    name.addEventListener('keyup', function(){

        if(slug.value === ''){

            slug.value = name.value
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9]+/g,'-')
                .replace(/^-+|-+$/g,'');

        }

    });

    /*==================================
            ICON PREVIEW
    ==================================*/

    const iconInput = document.getElementById('icon');
    const iconPreview = document.getElementById('icon-preview');

    function updateIcon(){

        if(iconInput.value.trim() !== ''){

            iconPreview.className = iconInput.value;

        }

    }

    updateIcon();

    iconInput.addEventListener('keyup', updateIcon);

    /*==================================
            COLOR PREVIEW
    ==================================*/

    const color = document.getElementById('color');
    const colorPreview = document.getElementById('color-preview');

    function updateColor(){

        colorPreview.style.background = color.value;

    }

    updateColor();

    color.addEventListener('input', updateColor);

});

</script>

@endpush
