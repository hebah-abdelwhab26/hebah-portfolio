@extends('admin.layouts.app')

@section('title', __('digital_studio_admin.technology_categories.edit.title'))

@section('content')

<div class="dashboard-page">

    <!-- ===========================
            Page Header
    ============================ -->

    <div class="dashboard-header">

        <div>

            <span class="dashboard-subtitle">

                {{ __('digital_studio_admin.technology_categories.edit.page_header.subtitle') }}

            </span>

            <h1 class="dashboard-title">

                {{ __('digital_studio_admin.technology_categories.edit.page_header.title') }}

            </h1>

            <p class="dashboard-description">

                {{ __('digital_studio_admin.technology_categories.edit.page_header.description') }}

            </p>

        </div>

        <a
            href="{{ route('admin.technology-categories.index') }}"
            class="dashboard-btn dashboard-btn-secondary">

            <i class="fa-solid fa-arrow-left"></i>

            <span>

                {{ __('digital_studio_admin.technology_categories.edit.page_header.back') }}

            </span>

        </a>

    </div>

    <form
        action="{{ route('admin.technology-categories.update',$technologyCategory) }}"
        method="POST">

        @csrf
        @method('PUT')

        <div class="row g-4">

            <!--==================================
                    LEFT COLUMN
            ==================================-->

            <div class="col-lg-8">

                <div class="dashboard-card">

                    <div class="dashboard-card-header">

                        <div class="dashboard-card-icon">

                            <i class="fa-solid fa-layer-group"></i>

                        </div>

                        <div>

                            <h4>

                                {{ __('digital_studio_admin.technology_categories.edit.category_information.title') }}

                            </h4>

                            <p>

                                {{ __('digital_studio_admin.technology_categories.edit.category_information.description') }}

                            </p>

                        </div>

                    </div>

                    <div class="dashboard-card-body">

                        <!--==================================
                                NAME
                        ==================================-->

                        <div class="mb-4">

                            <label class="dashboard-label">

                                {{ __('digital_studio_admin.technology_categories.edit.fields.category_name') }}

                            </label>

                            <input
                                type="text"
                                name="name"
                                value="{{ old('name',$technologyCategory->name) }}"
                                class="dashboard-input @error('name') is-invalid @enderror"
                                placeholder="{{ __('digital_studio_admin.technology_categories.edit.fields.category_name_placeholder') }}">

                            @error('name')

                                <div class="invalid-feedback d-block">

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>

                        <!--==================================
                                SLUG
                        ==================================-->

                        <div class="mb-4">

                            <label class="dashboard-label">

                                {{ __('digital_studio_admin.technology_categories.edit.fields.slug') }}

                            </label>

                            <input
                                id="slug"
                                type="text"
                                name="slug"
                                value="{{ old('slug',$technologyCategory->slug) }}"
                                class="dashboard-input"
                                placeholder="{{ __('digital_studio_admin.technology_categories.edit.fields.slug_placeholder') }}">

                        </div>

                        <!--==================================
                                DESCRIPTION
                        ==================================-->

                        <div class="mb-4">

                            <label class="dashboard-label">

                                {{ __('digital_studio_admin.technology_categories.edit.fields.description') }}

                            </label>

                            <textarea
                                name="description"
                                rows="6"
                                class="dashboard-textarea"
                                placeholder="{{ __('digital_studio_admin.technology_categories.edit.fields.description_placeholder') }}">{{ old('description',$technologyCategory->description) }}</textarea>

                        </div>

                        <!--==================================
                                ICON
                        ==================================-->

                        <div class="mb-4">

                            <label class="dashboard-label">

                                {{ __('digital_studio_admin.technology_categories.edit.fields.font_awesome_icon') }}

                            </label>

                            <div class="input-group">

                                <span class="input-group-text">

                                    <i
                                        id="icon-preview"
                                        class="{{ old('icon',$technologyCategory->icon ?: 'fa-solid fa-layer-group') }}">
                                    </i>

                                </span>

                                <input
                                    id="icon"
                                    type="text"
                                    name="icon"
                                    value="{{ old('icon',$technologyCategory->icon) }}"
                                    class="dashboard-input border-start-0"
                                    placeholder="{{ __('digital_studio_admin.technology_categories.edit.fields.icon_placeholder') }}">

                            </div>

                        </div>

                        <!--==================================
                                COLOR
                        ==================================-->

                        <div class="mb-4">

                            <label class="dashboard-label">

                                {{ __('digital_studio_admin.technology_categories.edit.fields.category_color') }}

                            </label>

                            <div class="d-flex align-items-center gap-3">

                                <input
                                    id="color"
                                    type="color"
                                    name="color"
                                    value="{{ old('color',$technologyCategory->color ?? '#4f46e5') }}"
                                    class="form-control form-control-color">

                                <span
                                    id="color-preview"
                                    style="
                                        width:45px;
                                        height:45px;
                                        border-radius:50%;
                                        border:3px solid #ffffff;
                                        box-shadow:0 0 15px rgba(0,0,0,.15);
                                        background:{{ old('color',$technologyCategory->color ?? '#4f46e5') }};
                                    ">
                                </span>

                            </div>

                        </div>

                        <!--==================================
                                SORT ORDER
                        ==================================-->

                        <div class="mb-0">

                            <label class="dashboard-label">

                                {{ __('digital_studio_admin.technology_categories.edit.fields.sort_order') }}

                            </label>

                            <input
                                type="number"
                                name="sort_order"
                                value="{{ old('sort_order',$technologyCategory->sort_order) }}"
                                class="dashboard-input"
                                min="0">

                        </div>

                    </div>

                </div>

            </div>

            <!--==================================
                    RIGHT COLUMN
            ==================================-->

            <div class="col-lg-4">

                <div class="dashboard-card">

                    <div class="dashboard-card-header">

                        <div class="dashboard-card-icon">

                            <i class="fa-solid fa-gear"></i>

                        </div>

                        <div>

                            <h4>

                                {{ __('digital_studio_admin.technology_categories.edit.settings.title') }}

                            </h4>

                            <p>

                                {{ __('digital_studio_admin.technology_categories.edit.settings.description') }}

                            </p>

                        </div>

                    </div>

                    <div class="dashboard-card-body">

                        <!--==================================
                                ACTIVE
                        ==================================-->

                        <div class="form-check form-switch mb-4">

                            <input
                                class="form-check-input"
                                type="checkbox"
                                id="is_active"
                                name="is_active"
                                value="1"
                                @checked(old('is_active',$technologyCategory->is_active))>

                            <label
                                class="form-check-label ms-2"
                                for="is_active">

                                {{ __('digital_studio_admin.technology_categories.edit.settings.active') }}

                            </label>

                        </div>

                        <!--==================================
                                UPDATE BUTTON
                        ==================================-->

                        <button
                            type="submit"
                            class="dashboard-btn dashboard-btn-primary w-100">

                            <i class="fa-solid fa-floppy-disk"></i>

                            <span>

                                {{ __('digital_studio_admin.technology_categories.edit.actions.update') }}

                            </span>

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

document.addEventListener("DOMContentLoaded",function(){

    const name=document.querySelector("input[name=name]");
    const slug=document.getElementById("slug");

    let manualEdit=false;

    slug.addEventListener("input",function(){

        manualEdit=true;

    });

    name.addEventListener("keyup",function(){

        if(!manualEdit){

            slug.value=name.value
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9]+/g,'-')
                .replace(/^-+|-+$/g,'');

        }

    });

    /*
    |--------------------------------------------------------------------------
    | Icon Preview
    |--------------------------------------------------------------------------
    */

    const iconInput = document.getElementById("icon");
    const iconPreview = document.getElementById("icon-preview");

    if(iconInput){

        iconInput.addEventListener("keyup",function(){

            if(this.value.trim() !== ""){

                iconPreview.className = this.value;

            }

        });

    }

    /*
    |--------------------------------------------------------------------------
    | Color Preview
    |--------------------------------------------------------------------------
    */

    const colorInput = document.getElementById("color");
    const colorPreview = document.getElementById("color-preview");

    if(colorInput){

        colorInput.addEventListener("input",function(){

            colorPreview.style.background = this.value;

        });

    }

});

</script>

@endpush
