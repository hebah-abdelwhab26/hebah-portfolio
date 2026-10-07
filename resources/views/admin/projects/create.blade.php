@extends('admin.layouts.app')

@section('title', __('digital_studio_admin.projects.create.title'))

@section('content')

<!--==================================================
                    PAGE HEADER
==================================================-->

<div class="page-header">

    <div class="page-header-content">

        <div class="page-header-left">

            <div class="page-icon">

                <i class="fa-solid fa-folder-plus"></i>

            </div>

            <div>

                <h1>
                    {{ __('digital_studio_admin.projects.create.page_header.title') }}
                </h1>

                <p>
                    {{ __('digital_studio_admin.projects.create.page_header.description') }}
                </p>

            </div>

        </div>

        <div class="page-header-right">

            <a href="{{ route('admin.projects.index') }}"
               class="btn-admin btn-outline">

                <i class="fa-solid fa-arrow-left"></i>

                {{ __('digital_studio_admin.projects.create.page_header.back') }}

            </a>

        </div>

    </div>

</div>

<!--==================================================
                    CREATE FORM
==================================================-->

<form action="{{ route('admin.projects.store') }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf

    <div class="project-grid">

        <!--==================================
                LEFT COLUMN
        ==================================-->

        <div class="left-column">

            <!--==================================
                PROJECT INFORMATION
            ==================================-->

            <div class="admin-card mb-4">

                <div class="admin-card-header">

                    <h4>

                        <i class="fa-solid fa-folder-open"></i>

                        {{ __('digital_studio_admin.projects.create.project_information.title') }}

                    </h4>

                </div>

                <div class="admin-card-body">

                    <!--==============================
                            TITLE
                    ==============================-->

                    <div class="mb-4">

                        <label class="form-label">

                            {{ __('digital_studio_admin.projects.create.fields.project_title') }}

                            <span class="required">*</span>

                        </label>

                        <input
                            type="text"
                            id="title"
                            name="title"
                            value="{{ old('title') }}"
                            class="form-control @error('title') is-invalid @enderror"
                            placeholder="{{ __('digital_studio_admin.projects.create.fields.project_title_placeholder') }}">

                        @error('title')

                            <div class="invalid-feedback">

                                {{ $message }}

                            </div>

                        @enderror

                    </div>

                    <!--==============================
                            SUBTITLE
                    ==============================-->

                    <div class="mb-4">

                        <label class="form-label">

                            {{ __('digital_studio_admin.projects.create.fields.subtitle') }}

                        </label>

                        <input
                            type="text"
                            name="subtitle"
                            value="{{ old('subtitle') }}"
                            class="form-control"
                            placeholder="{{ __('digital_studio_admin.projects.create.fields.subtitle_placeholder') }}">

                    </div>

                    <!--==============================
                            SLUG
                    ==============================-->

                    <div class="mb-4">

                        <label class="form-label">

                            {{ __('digital_studio_admin.projects.create.fields.slug') }}

                            <span class="required">*</span>

                        </label>

                        <input
                            type="text"
                            id="slug"
                            name="slug"
                            value="{{ old('slug') }}"
                            class="form-control @error('slug') is-invalid @enderror"
                            placeholder="{{ __('digital_studio_admin.projects.create.fields.slug_placeholder') }}">

                        @error('slug')

                            <div class="invalid-feedback">

                                {{ $message }}

                            </div>

                        @enderror

                    </div>

                    <!--==============================
                        SHORT DESCRIPTION
                    ==============================-->

                    <div class="mb-4">

                        <label class="form-label">

                            {{ __('digital_studio_admin.projects.create.fields.short_description') }}

                        </label>

                        <textarea
                            rows="4"
                            id="short_description"
                            name="short_description"
                            class="form-control @error('short_description') is-invalid @enderror"
                            placeholder="{{ __('digital_studio_admin.projects.create.fields.short_description_placeholder') }}">{{ old('short_description') }}</textarea>

                        <div class="character-counter">

                            <span id="shortCounter">

                                0

                            </span>

                            /250 {{ __('digital_studio_admin.projects.create.fields.characters') }}

                        </div>

                        @error('short_description')

                            <div class="invalid-feedback">

                                {{ $message }}

                            </div>

                        @enderror

                    </div>

                    <!--==============================
                        FULL DESCRIPTION
                    ==============================-->

                    <div class="mb-0">

                        <label class="form-label">

                            {{ __('digital_studio_admin.projects.create.fields.full_description') }}

                            <span class="required">*</span>

                        </label>

                        <textarea
                            id="description"
                            name="description"
                            rows="10"
                            class="form-control @error('description') is-invalid @enderror"
                            placeholder="{{ __('digital_studio_admin.projects.create.fields.full_description_placeholder') }}">{{ old('description') }}</textarea>

                        @error('description')

                            <div class="invalid-feedback">

                                {{ $message }}

                            </div>

                        @enderror

                    </div>

                </div>

            </div>

            <!--==================================
                    TECHNOLOGIES
            ==================================-->

            <div class="admin-card mb-4">

                <div class="admin-card-header">

                    <h4>

                        <i class="fa-solid fa-code"></i>

                        {{ __('digital_studio_admin.projects.create.technologies.title') }}

                    </h4>

                </div>

                <div class="admin-card-body">

                    <p class="text-muted mb-3">

                        {{ __('digital_studio_admin.projects.create.technologies.description') }}

                    </p>

                    <div id="technology-wrapper">

                    </div>

                </div>

            </div>

            <!--==================================
                    PROJECT DETAILS
            ==================================-->

            <div class="admin-card mb-4">

                <div class="admin-card-header">

                    <h4>

                        <i class="fa-solid fa-circle-info"></i>

                        {{ __('digital_studio_admin.projects.create.project_details.title') }}

                    </h4>

                </div>

                <div class="admin-card-body">

                    <div class="row">

                        <div class="col-md-6 mb-4">

                            <label class="form-label">

                                {{ __('digital_studio_admin.projects.create.project_details.client') }}

                            </label>

                            <input
                                type="text"
                                name="client"
                                value="{{ old('client') }}"
                                class="form-control"
                                placeholder="{{ __('digital_studio_admin.projects.create.project_details.client_placeholder') }}">

                        </div>

                        <div class="col-md-6 mb-4">

                            <label class="form-label">

                                {{ __('digital_studio_admin.projects.create.project_details.duration') }}

                            </label>

                            <input
                                type="text"
                                name="duration"
                                value="{{ old('duration') }}"
                                class="form-control"
                                placeholder="{{ __('digital_studio_admin.projects.create.project_details.duration_placeholder') }}">

                        </div>

                        <div class="col-md-6 mb-4">

                            <label class="form-label">

                                {{ __('digital_studio_admin.projects.create.project_details.project_date') }}

                            </label>

                            <input
                                type="date"
                                name="project_date"
                                value="{{ old('project_date') }}"
                                class="form-control">

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!--==================================
                PROJECT LINKS
        ==================================-->

        <div class="admin-card mb-4">

            <div class="admin-card-header">

                <h4>

                    <i class="fa-solid fa-link"></i>

                    {{ __('digital_studio_admin.projects.create.project_links.title') }}

                </h4>

            </div>

            <div class="admin-card-body">

                <div class="mb-4">

                    <label class="form-label">

                        {{ __('digital_studio_admin.projects.create.project_links.figma') }}

                    </label>

                    <input
                        type="url"
                        name="figma"
                        value="{{ old('figma') }}"
                        class="form-control"
                        placeholder="{{ __('digital_studio_admin.projects.create.project_links.figma_placeholder') }}">

                </div>

                <div class="mb-4">

                    <label class="form-label">

                        {{ __('digital_studio_admin.projects.create.project_links.live_demo') }}

                    </label>

                    <input
                        type="url"
                        name="live_demo"
                        value="{{ old('live_demo') }}"
                        class="form-control"
                        placeholder="{{ __('digital_studio_admin.projects.create.project_links.live_demo_placeholder') }}">

                </div>

                <div class="mb-0">

                    <label class="form-label">

                        {{ __('digital_studio_admin.projects.create.project_links.github') }}

                    </label>

                    <input
                        type="url"
                        name="github"
                        value="{{ old('github') }}"
                        class="form-control"
                        placeholder="{{ __('digital_studio_admin.projects.create.project_links.github_placeholder') }}">

                </div>

            </div>

        </div>

        <!--==================================
                RIGHT COLUMN
        ==================================-->

        <div class="right-column">

            <!--==================================
                    PUBLISH
            ==================================-->

            <div class="admin-card sticky-card mb-4">

                <div class="admin-card-header">

                    <h4>

                        <i class="fa-solid fa-paper-plane"></i>

                        {{ __('digital_studio_admin.projects.create.publish.title') }}

                    </h4>

                </div>

                <div class="admin-card-body">

                    <!-- STATUS -->

                    <div class="mb-4">

                        <label class="form-label">

                            {{ __('digital_studio_admin.projects.create.publish.status') }}

                        </label>

                        <select
                            name="status"
                            class="form-select">

                            <option value="draft"
                                @selected(old('status')=='draft')>

                                {{ __('digital_studio_admin.projects.create.statuses.draft') }}

                            </option>

                            <option value="published"
                                @selected(old('status')=='published')>

                                {{ __('digital_studio_admin.projects.create.statuses.published') }}

                            </option>

                        </select>

                    </div>

                    <!-- FEATURED -->

                    <div class="setting-item">

                        <div>

                            <h6>

                                {{ __('digital_studio_admin.projects.create.publish.featured.title') }}

                            </h6>

                            <small>

                                {{ __('digital_studio_admin.projects.create.publish.featured.description') }}

                            </small>

                        </div>

                        <label class="switch">

                            <input
                                type="checkbox"
                                name="featured"
                                value="1"
                                @checked(old('featured'))>

                            <span class="slider"></span>

                        </label>

                    </div>

                    <!-- ACTIVE -->

                    <div class="setting-item">

                        <div>

                            <h6>

                                {{ __('digital_studio_admin.projects.create.publish.active.title') }}

                            </h6>

                            <small>

                                {{ __('digital_studio_admin.projects.create.publish.active.description') }}

                            </small>

                        </div>

                        <label class="switch">

                            <input
                                type="checkbox"
                                name="is_active"
                                value="1"
                                @checked(old('is_active',true))>

                            <span class="slider"></span>

                        </label>

                    </div>

                    <!-- SORT ORDER -->

                    <div class="mt-4">

                        <label class="form-label">

                            {{ __('digital_studio_admin.projects.create.publish.sort_order') }}

                        </label>

                        <input
                            type="number"
                            name="sort_order"
                            value="{{ old('sort_order',0) }}"
                            class="form-control">

                    </div>

                    <hr class="admin-divider">

                    <button
                        type="submit"
                        class="btn-admin-primary w-100">

                        <i class="fa-solid fa-floppy-disk"></i>

                        {{ __('digital_studio_admin.projects.create.actions.save') }}

                    </button>

                </div>

            </div>

            <!--==================================
                    CATEGORY
            ==================================-->

            <div class="admin-card mb-4">

                <div class="admin-card-header">

                    <h4>

                        <i class="fa-solid fa-layer-group"></i>

                        {{ __('digital_studio_admin.projects.create.category.title') }}

                    </h4>

                </div>

                <div class="admin-card-body">

                    <select
                        id="project_category_id"
                        name="project_category_id"
                        class="form-select @error('project_category_id') is-invalid @enderror">

                        <option value="">

                            {{ __('digital_studio_admin.projects.create.category.placeholder') }}

                        </option>

                        @foreach($categories as $category)

                            <option
                                value="{{ $category->id }}"
                                data-type="{{ $category->type }}"
                                @selected(old('project_category_id') == $category->id)>

                                {{ $category->name }}

                            </option>

                        @endforeach

                    </select>

                    @error('project_category_id')

                        <div class="invalid-feedback d-block">

                            {{ $message }}

                        </div>

                    @enderror

                </div>

            </div>

            <!--==================================
                    TECHNOLOGY FILTER
            ==================================-->

            <div
                class="admin-card mb-4"
                id="technology-card"
                style="display:none;">

                <div class="admin-card-header">

                    <h4>

                        <i class="fa-solid fa-microchip"></i>

                        {{ __('digital_studio_admin.projects.create.programming_technologies.title') }}

                    </h4>

                </div>

                <div class="admin-card-body">

                    <div class="technology-grid">

                        @foreach($technologies as $technology)

                            <label
                                class="tech-checkbox technology-item"
                                data-category="{{ $technology->technology_category_id }}">

                                <input
                                    type="checkbox"
                                    name="technologies[]"
                                    value="{{ $technology->id }}"
                                    @checked(in_array($technology->id, old('technologies', [])))>

                                <span>

                                    {{ $technology->name }}

                                </span>

                            </label>

                        @endforeach

                    </div>

                </div>

            </div>

            <!--==================================
                    IMAGES
            ==================================-->

            <div class="admin-card">

                <div class="admin-card-header">

                    <h4>

                        <i class="fa-solid fa-images"></i>

                        {{ __('digital_studio_admin.projects.create.images.title') }}

                    </h4>

                </div>

                <div class="admin-card-body">

                    <!--==============================
                            THUMBNAIL
                    ==============================-->

                    <div class="upload-box mb-4">

                        <i class="fa-regular fa-image"></i>

                        <h6>

                            {{ __('digital_studio_admin.projects.create.images.thumbnail.title') }}

                        </h6>

                        <p>

                            {{ __('digital_studio_admin.projects.create.images.thumbnail.description') }}

                        </p>

                        <input
                            type="file"
                            name="thumbnail"
                            class="form-control">

                    </div>

                    @error('thumbnail')

                        <div class="invalid-feedback d-block mb-3">

                            {{ $message }}

                        </div>

                    @enderror

                    <hr class="admin-divider">

                    <!--==============================
                            COVER IMAGE
                    ==============================-->

                    <div class="upload-box my-4">

                        <i class="fa-solid fa-panorama"></i>

                        <h6>

                            {{ __('digital_studio_admin.projects.create.images.cover.title') }}

                        </h6>

                        <p>

                            {{ __('digital_studio_admin.projects.create.images.cover.description') }}

                        </p>

                        <input
                            type="file"
                            name="cover_image"
                            class="form-control">

                    </div>

                    @error('cover_image')

                        <div class="invalid-feedback d-block mb-3">

                            {{ $message }}

                        </div>

                    @enderror

                    <hr class="admin-divider">

                    <!--==============================
                            GALLERY
                    ==============================-->

                    <div class="upload-box mt-4">

                        <i class="fa-solid fa-photo-film"></i>

                        <h6>

                            {{ __('digital_studio_admin.projects.create.images.gallery.title') }}

                        </h6>

                        <p>

                            {{ __('digital_studio_admin.projects.create.images.gallery.description') }}

                        </p>

                        <input
                            type="file"
                            name="gallery[]"
                            multiple
                            class="form-control">

                    </div>

                </div>

            </div>

        </div>

    </div>

</form>

@endsection

@push('scripts')

<script>

/*==========================================
        AUTO GENERATE SLUG
==========================================*/

const titleInput = document.getElementById('title');
const slugInput  = document.getElementById('slug');

if(titleInput && slugInput){

    titleInput.addEventListener('keyup', function(){

        if(slugInput.value === ''){

            slugInput.value = this.value
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9]+/g,'-')
                .replace(/^-+|-+$/g,'');

        }

    });

}



/*==========================================
        SHORT DESCRIPTION COUNTER
==========================================*/

const shortDescription = document.getElementById('short_description');
const shortCounter     = document.getElementById('shortCounter');


if(shortDescription && shortCounter){

    function updateCounter(){

        shortCounter.textContent = shortDescription.value.length;

    }

    updateCounter();

    shortDescription.addEventListener(
        'input',
        updateCounter
    );

}



/*==========================================
        SHOW ALL TECHNOLOGIES
==========================================*/

const technologyCard = document.getElementById('technology-card');

const technologyCategories = document.querySelectorAll(
    '.technology-category'
);


if(technologyCard){

    technologyCard.style.display = 'block';

}


technologyCategories.forEach(category => {

    category.style.display = 'block';

});

</script>

@endpush
