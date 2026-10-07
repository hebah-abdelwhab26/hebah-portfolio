@extends('admin.layouts.app')

@section('title', __('digital_studio_admin.technologies.edit.title'))

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

                        {{ __('digital_studio_admin.technologies.edit.page_header.title') }}

                    </h1>

                    <p>

                        {{ __('digital_studio_admin.technologies.edit.page_header.description') }}

                    </p>

                </div>

            </div>

            <div class="page-header-right">

                <a
                    href="{{ route('admin.technologies.index') }}"
                    class="btn-admin">

                    <i class="fa-solid fa-arrow-left"></i>

                    {{ __('digital_studio_admin.technologies.edit.page_header.back') }}

                </a>

            </div>

        </div>

    </div>

    <!--==================================
                FORM
    ==================================-->

    <form
        action="{{ route('admin.technologies.update',$technology) }}"
        method="POST">

        @csrf
        @method('PUT')

        <div class="project-grid">

            <!--==================================
                    LEFT COLUMN
            ==================================-->

            <div class="left-column">

                <div class="admin-card">

                    <div class="admin-card-header">

                        <h4>

                            <i class="fa-solid fa-microchip"></i>

                            {{ __('digital_studio_admin.technologies.edit.technology_information.title') }}

                        </h4>

                    </div>

                    <div class="admin-card-body">

                        <!--==================================
                                    CATEGORY
                        ==================================-->

                        <div class="mb-4">

                            <label class="form-label">

                                {{ __('digital_studio_admin.technologies.edit.fields.category') }}

                                <span class="required">*</span>

                            </label>

                            <select
                                name="technology_category_id"
                                class="form-select @error('technology_category_id') is-invalid @enderror">

                                @foreach($categories as $category)

                                    <option
                                        value="{{ $category->id }}"
                                        @selected(old('technology_category_id',$technology->technology_category_id) == $category->id)>

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
                                    NAME
                        ==================================-->

                        <div class="mb-4">

                            <label class="form-label">

                                {{ __('digital_studio_admin.technologies.edit.fields.technology_name') }}

                                <span class="required">*</span>

                            </label>

                            <input
                                type="text"
                                name="name"
                                value="{{ old('name',$technology->name) }}"
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="{{ __('digital_studio_admin.technologies.edit.fields.technology_name_placeholder') }}">

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

                                {{ __('digital_studio_admin.technologies.edit.fields.slug') }}

                            </label>

                            <input
                                id="slug"
                                type="text"
                                name="slug"
                                value="{{ old('slug',$technology->slug) }}"
                                class="form-control"
                                placeholder="{{ __('digital_studio_admin.technologies.edit.fields.slug_placeholder') }}">

                        </div>

                        <!--==================================
                                    DESCRIPTION
                        ==================================-->

                        <div class="mb-4 mb-0">

                            <label class="form-label">

                                {{ __('digital_studio_admin.technologies.edit.fields.description') }}

                            </label>

                            <textarea
                                name="description"
                                id="description"
                                class="form-control"
                                placeholder="{{ __('digital_studio_admin.technologies.edit.fields.description_placeholder') }}">{{ old('description',$technology->description) }}</textarea>

                        </div>

                    </div>

                </div>

                <!--==================================
                            ICON
                ==================================-->

                <div class="mb-4">

                    <label class="form-label">

                        {{ __('digital_studio_admin.technologies.edit.appearance.icon') }}

                    </label>

                    <div class="input-group">

                        <span class="input-group-text">

                            <i
                                id="icon-preview"
                                class="{{ old('icon',$technology->icon ?: 'fa-solid fa-code') }}">
                            </i>

                        </span>

                        <input
                            id="icon"
                            type="text"
                            name="icon"
                            value="{{ old('icon',$technology->icon) }}"
                            class="form-control @error('icon') is-invalid @enderror"
                            placeholder="{{ __('digital_studio_admin.technologies.edit.appearance.icon_placeholder') }}">

                    </div>

                    @error('icon')

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

                        {{ __('digital_studio_admin.technologies.edit.appearance.color') }}

                    </label>

                    <div class="d-flex align-items-center gap-3">

                        <input
                            id="color"
                            type="color"
                            name="color"
                            value="{{ old('color',$technology->color ?? '#2563EB') }}"
                            class="form-control form-control-color"
                            style="width:80px;height:55px;">

                        <span
                            id="color-preview"
                            style="
                                width:38px;
                                height:38px;
                                border-radius:50%;
                                background:{{ old('color',$technology->color ?? '#2563EB') }};
                                border:2px solid rgba(255,255,255,.15);
                            ">

                        </span>

                    </div>

                </div>

                <!--==================================
                            WEBSITE
                ==================================-->

                <div class="mb-0">

                    <label class="form-label">

                        {{ __('digital_studio_admin.technologies.edit.fields.official_website') }}

                    </label>

                    <input
                        type="url"
                        name="website"
                        value="{{ old('website',$technology->website) }}"
                        class="form-control @error('website') is-invalid @enderror"
                        placeholder="{{ __('digital_studio_admin.technologies.edit.fields.website_placeholder') }}">

                    @error('website')

                        <div class="invalid-feedback">

                            {{ $message }}

                        </div>

                    @enderror

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

                            {{ __('digital_studio_admin.technologies.edit.publish_settings.title') }}

                        </h4>

                    </div>

                    <div class="admin-card-body">

                        <!--==================================
                                SORT ORDER
                        ==================================-->

                        <div class="setting-item">

                            <div>

                                <h6>

                                    {{ __('digital_studio_admin.technologies.edit.publish_settings.sort_order') }}

                                </h6>

                                <small>

                                    {{ __('digital_studio_admin.technologies.edit.publish_settings.sort_order_description') }}

                                </small>

                            </div>

                        </div>

                        <div class="mb-4">

                            <input
                                type="number"
                                name="sort_order"
                                value="{{ old('sort_order',$technology->sort_order) }}"
                                class="form-control">

                        </div>

                        <!--==================================
                                ACTIVE
                        ==================================-->

                        <div class="setting-item">

                            <div>

                                <h6>

                                    {{ __('digital_studio_admin.technologies.edit.publish_settings.status.title') }}

                                </h6>

                                <small>

                                    {{ __('digital_studio_admin.technologies.edit.publish_settings.status.description') }}

                                </small>

                            </div>

                            <label class="switch">

                                <input
                                    type="checkbox"
                                    name="is_active"
                                    value="1"
                                    @checked(old('is_active',$technology->is_active))>

                                <span class="slider"></span>

                            </label>

                        </div>

                        <hr class="admin-divider">

                        <button
                            type="submit"
                            class="btn-admin-primary w-100">

                            <i class="fa-solid fa-floppy-disk"></i>

                            {{ __('digital_studio_admin.technologies.edit.actions.update') }}

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </form>

</div>

@endsection

@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', () => {

    /*
    |--------------------------------------------------------------------------
    | Auto Slug
    |--------------------------------------------------------------------------
    */

    const name = document.querySelector('input[name="name"]');

    const slug = document.getElementById('slug');

    let manualEdit = false;

    slug.addEventListener('input', () => {

        manualEdit = true;

    });

    name.addEventListener('keyup', () => {

        if(manualEdit) return;

        slug.value = name.value
            .toLowerCase()
            .trim()
            .replace(/[^a-z0-9]+/g,'-')
            .replace(/^-+|-+$/g,'');

    });

    /*
    |--------------------------------------------------------------------------
    | Icon Preview
    |--------------------------------------------------------------------------
    */

    const iconInput = document.getElementById('icon');

    const iconPreview = document.getElementById('icon-preview');

    function updateIcon(){

        iconPreview.className = iconInput.value || 'fa-solid fa-code';

    }

    iconInput.addEventListener('keyup', updateIcon);

    updateIcon();

    /*
    |--------------------------------------------------------------------------
    | Color Preview
    |--------------------------------------------------------------------------
    */

    const color = document.getElementById('color');

    const preview = document.getElementById('color-preview');

    function updateColor(){

        preview.style.background = color.value;

    }

    color.addEventListener('input', updateColor);

    updateColor();

});

</script>

@endpush
