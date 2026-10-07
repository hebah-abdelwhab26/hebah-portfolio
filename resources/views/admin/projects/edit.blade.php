@extends('admin.layouts.app')

@section('title', __('digital_studio_admin.projects.edit.title'))

@section('content')

<div class="page-wrapper fade-up">

    <!--==================================
                PAGE HEADER
    ==================================-->

    <div class="dashboard-header">

        <div class="dashboard-header-left">

            <div class="dashboard-breadcrumb">

                <i class="fa-solid fa-folder-open"></i>

                <span>
                    {{ __('digital_studio_admin.projects.edit.breadcrumb.projects') }}
                </span>

                <i class="fa-solid fa-angle-right"></i>

                <span>
                    {{ __('digital_studio_admin.projects.edit.breadcrumb.edit') }}
                </span>

            </div>

            <h1>
                {{ __('digital_studio_admin.projects.edit.page_header.title') }}
            </h1>

            <p>
                {{ __('digital_studio_admin.projects.edit.page_header.description') }}
            </p>

        </div>

        <div class="dashboard-header-right">

            <a href="{{ route('admin.projects.index') }}"
               class="btn btn-light rounded-pill px-4">

                <i class="fa-solid fa-arrow-left me-2"></i>

                {{ __('digital_studio_admin.projects.edit.page_header.back') }}

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

    @if(session('error'))

        <div class="alert alert-danger rounded-4 shadow-sm mb-4">

            <i class="fa-solid fa-circle-xmark me-2"></i>

            {{ session('error') }}

        </div>

    @endif

    @if($errors->any())

        <div class="alert alert-danger rounded-4 shadow-sm mb-4">

            <h6 class="fw-bold mb-3">

                <i class="fa-solid fa-triangle-exclamation me-2"></i>

                {{ __('digital_studio_admin.projects.edit.alerts.validation') }}

            </h6>

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <!--==================================
            MAIN UPDATE FORM
    ==================================-->

    <form action="{{ route('admin.projects.update', $project) }}"
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

                        <i class="fa-solid fa-circle-info"></i>

                    </div>

                </div>

                <div>

                    <h4 class="card-title mb-1">

                        {{ __('digital_studio_admin.projects.edit.basic_information.title') }}

                    </h4>

                    <small>

                        {{ __('digital_studio_admin.projects.edit.basic_information.description') }}

                    </small>

                </div>

            </div>

            <div class="row">

                <!-- Project Title -->

                <div class="col-lg-6 mb-4">

                    <label class="form-label fw-semibold">

                        {{ __('digital_studio_admin.projects.edit.fields.project_title') }}

                    </label>

                    <input
                        type="text"
                        name="title"
                        class="form-control"
                        value="{{ old('title', $project->title) }}">

                </div>

                <!-- Category -->

                <div class="col-lg-6 mb-4">

                    <label class="form-label fw-semibold">

                        {{ __('digital_studio_admin.projects.edit.fields.category') }}

                    </label>

                    <select
                        id="project_category"
                        name="project_category_id"
                        class="form-select">

                        @foreach($categories as $category)

                            <option
                                value="{{ $category->id }}"
                                @selected(old('project_category_id', $project->project_category_id) == $category->id)>

                                {{ $category->name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <!-- Slug -->

                <div class="col-lg-6 mb-4">

                    <label class="form-label fw-semibold">

                        {{ __('digital_studio_admin.projects.edit.fields.slug') }}

                    </label>

                    <input
                        type="text"
                        id="slug"
                        name="slug"
                        class="form-control"
                        value="{{ old('slug', $project->slug) }}">

                </div>

                <!-- Subtitle -->

                <div class="col-lg-6 mb-4">

                    <label class="form-label fw-semibold">

                        {{ __('digital_studio_admin.projects.edit.fields.subtitle') }}

                    </label>

                    <input
                        type="text"
                        name="subtitle"
                        class="form-control"
                        value="{{ old('subtitle', $project->subtitle) }}">

                </div>

                <!-- Short Description -->

                <div class="col-12 mb-4">

                    <label class="form-label fw-semibold">

                        {{ __('digital_studio_admin.projects.edit.fields.short_description') }}

                    </label>

                    <textarea
                        name="short_description"
                        rows="3"
                        class="form-control">{{ old('short_description', $project->short_description) }}</textarea>

                </div>

                <!-- Full Description -->

                <div class="col-12">

                    <label class="form-label fw-semibold">

                        {{ __('digital_studio_admin.projects.edit.fields.full_description') }}

                    </label>

                    <textarea
                        name="description"
                        rows="8"
                        class="form-control">{{ old('description', $project->description) }}</textarea>

                </div>

            </div>

        </div>

        <!--==================================
                PROJECT LINKS
        ==================================-->

        <div class="admin-card mb-4">

            <div class="d-flex align-items-center mb-4">

                <div class="me-3">

                    <div class="dashboard-icon">

                        <i class="fa-solid fa-link"></i>

                    </div>

                </div>

                <div>

                    <h4 class="card-title mb-1">

                        {{ __('digital_studio_admin.projects.edit.project_links.title') }}

                    </h4>

                    <small>

                        {{ __('digital_studio_admin.projects.edit.project_links.description') }}

                    </small>

                </div>

            </div>

            <div class="row">

                <!-- Live Demo -->

                <div class="col-lg-4 mb-4">

                    <label class="form-label fw-semibold">

                        {{ __('digital_studio_admin.projects.edit.project_links.live_demo') }}

                    </label>

                    <div class="input-group">

                        <span class="input-group-text">

                            <i class="fa-solid fa-globe"></i>

                        </span>

                        <input
                            type="url"
                            name="live_demo"
                            class="form-control"
                            placeholder="{{ __('digital_studio_admin.projects.edit.project_links.live_demo_placeholder') }}"
                            value="{{ old('live_demo', $project->live_demo) }}">

                    </div>

                </div>

                <!-- Github -->

                <div class="col-lg-4 mb-4">

                    <label class="form-label fw-semibold">

                        {{ __('digital_studio_admin.projects.edit.project_links.github') }}

                    </label>

                    <div class="input-group">

                        <span class="input-group-text">

                            <i class="fa-brands fa-github"></i>

                        </span>

                        <input
                            type="url"
                            name="github"
                            class="form-control"
                            placeholder="{{ __('digital_studio_admin.projects.edit.project_links.github_placeholder') }}"
                            value="{{ old('github', $project->github) }}">

                    </div>

                </div>

                <!-- Figma -->

                <div class="col-lg-4 mb-4">

                    <label class="form-label fw-semibold">

                        {{ __('digital_studio_admin.projects.edit.project_links.figma') }}

                    </label>

                    <div class="input-group">

                        <span class="input-group-text">

                            <i class="fa-brands fa-figma"></i>

                        </span>

                        <input
                            type="url"
                            name="figma"
                            class="form-control"
                            placeholder="{{ __('digital_studio_admin.projects.edit.project_links.figma_placeholder') }}"
                            value="{{ old('figma', $project->figma) }}">

                    </div>

                </div>

            </div>

        </div>

        <!--==================================
                PROJECT DETAILS
        ==================================-->

        <div class="admin-card mb-4">

            <div class="d-flex align-items-center mb-4">

                <div class="me-3">

                    <div class="dashboard-icon">

                        <i class="fa-solid fa-calendar-days"></i>

                    </div>

                </div>

                <div>

                    <h4 class="card-title mb-1">

                        {{ __('digital_studio_admin.projects.edit.project_details.title') }}

                    </h4>

                    <small>

                        {{ __('digital_studio_admin.projects.edit.project_details.description') }}

                    </small>

                </div>

            </div>

            <div class="row">

                <!-- Client -->

                <div class="col-lg-4 mb-4">

                    <label class="form-label fw-semibold">

                        {{ __('digital_studio_admin.projects.edit.project_details.client') }}

                    </label>

                    <div class="input-group">

                        <span class="input-group-text">

                            <i class="fa-solid fa-user"></i>

                        </span>

                        <input
                            type="text"
                            name="client"
                            class="form-control"
                            value="{{ old('client', $project->client) }}">

                    </div>

                </div>

                <!-- Project Date -->

                <div class="col-lg-4 mb-4">

                    <label class="form-label fw-semibold">

                        {{ __('digital_studio_admin.projects.edit.project_details.project_date') }}

                    </label>

                    <div class="input-group">

                        <span class="input-group-text">

                            <i class="fa-solid fa-calendar"></i>

                        </span>

                        <input
                            type="date"
                            name="project_date"
                            class="form-control"
                            value="{{ old('project_date', optional($project->project_date)->format('Y-m-d')) }}">

                    </div>

                </div>

                <!-- Duration -->

                <div class="col-lg-4 mb-4">

                    <label class="form-label fw-semibold">

                        {{ __('digital_studio_admin.projects.edit.project_details.duration') }}

                    </label>

                    <div class="input-group">

                        <span class="input-group-text">

                            <i class="fa-regular fa-clock"></i>

                        </span>

                        <input
                            type="text"
                            name="duration"
                            class="form-control"
                            placeholder="{{ __('digital_studio_admin.projects.edit.project_details.duration_placeholder') }}"
                            value="{{ old('duration', $project->duration) }}">

                    </div>

                </div>

            </div>

        </div>

        <!--==================================
                PROJECT IMAGES
        ==================================-->

        <div class="admin-card mb-4">

            <div class="d-flex align-items-center mb-4">

                <div class="me-3">

                    <div class="dashboard-icon">

                        <i class="fa-solid fa-image"></i>

                    </div>

                </div>

                <div>

                    <h4 class="card-title mb-1">

                        {{ __('digital_studio_admin.projects.edit.project_images.title') }}

                    </h4>

                    <small>

                        {{ __('digital_studio_admin.projects.edit.project_images.description') }}

                    </small>

                </div>

            </div>

            <div class="row">

                <!--==================================
                        COVER IMAGE
                ==================================-->

                <div class="col-lg-6">

                    <div class="admin-card h-100">

                        <h6 class="fw-bold mb-3">

                            {{ __('digital_studio_admin.projects.edit.project_images.cover.title') }}

                        </h6>

                        <input
                            type="hidden"
                            name="remove_cover_image"
                            id="remove_cover_image"
                            value="0">

                        <label
                            class="upload-box"
                            for="cover_image_input"
                            style="cursor:pointer;">

                            <input
                                type="file"
                                name="cover_image"
                                id="cover_image_input"
                                class="d-none"
                                accept="image/*">

                            <div id="cover_image_preview_wrapper">

                                @if($project->cover_image)

                                    <img
                                        src="{{ $project->cover_image_url }}"
                                        id="cover_image_preview"
                                        class="img-fluid rounded-4 mb-3"
                                        style="width:100%;height:260px;object-fit:cover;">

                                @else

                                    <div
                                        class="upload-placeholder"
                                        id="cover_image_placeholder">

                                        <i class="fa-solid fa-cloud-arrow-up"></i>

                                        <p class="mb-0">

                                            {{ __('digital_studio_admin.projects.edit.project_images.upload.cover') }}

                                        </p>

                                    </div>

                                @endif

                            </div>

                        </label>

                        <div
                            class="d-flex justify-content-center mt-2"
                            id="cover_image_actions"
                            @if(!$project->cover_image)
                                style="display:none !important;"
                            @endif>

                            <button
                                type="button"
                                id="remove_cover_image_btn"
                                class="btn btn-danger btn-sm rounded-pill px-4">

                                <i class="fa-solid fa-trash me-2"></i>

                                {{ __('digital_studio_admin.projects.edit.project_images.delete.cover') }}

                            </button>

                        </div>

                        <div
                            id="cover_image_filename"
                            class="text-center text-muted small mt-2">
                        </div>

                    </div>

                </div>

                <!--==================================
                        THUMBNAIL
                ==================================-->

                <div class="col-lg-6">

                    <div class="admin-card h-100">

                        <h6 class="fw-bold mb-3">

                            {{ __('digital_studio_admin.projects.edit.project_images.thumbnail.title') }}

                        </h6>

                        <input
                            type="hidden"
                            name="remove_thumbnail"
                            id="remove_thumbnail"
                            value="0">

                        <label
                            class="upload-box"
                            for="thumbnail_input"
                            style="cursor:pointer;">

                            <input
                                type="file"
                                name="thumbnail"
                                id="thumbnail_input"
                                class="d-none"
                                accept="image/*">

                            <div id="thumbnail_preview_wrapper">

                                @if($project->thumbnail)

                                    <img
                                        src="{{ $project->thumbnail_url }}"
                                        id="thumbnail_preview"
                                        class="img-fluid rounded-4 mb-3"
                                        style="width:100%;height:260px;object-fit:cover;">

                                @else

                                    <div
                                        class="upload-placeholder"
                                        id="thumbnail_placeholder">

                                        <i class="fa-solid fa-cloud-arrow-up"></i>

                                        <p class="mb-0">

                                            {{ __('digital_studio_admin.projects.edit.project_images.upload.thumbnail') }}

                                        </p>

                                    </div>

                                @endif

                            </div>

                        </label>

                        <div
                            class="d-flex justify-content-center mt-2"
                            id="thumbnail_actions"
                            @if(!$project->thumbnail)
                                style="display:none !important;"
                            @endif>

                            <button
                                type="button"
                                id="remove_thumbnail_btn"
                                class="btn btn-danger btn-sm rounded-pill px-4">

                                <i class="fa-solid fa-trash me-2"></i>

                                {{ __('digital_studio_admin.projects.edit.project_images.delete.thumbnail') }}

                            </button>

                        </div>

                        <div
                            id="thumbnail_filename"
                            class="text-center text-muted small mt-2">
                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!--==================================
                TECHNOLOGIES
        ==================================-->

        <div class="admin-card mb-4">

            <div class="d-flex align-items-center mb-4">

                <div class="me-3">

                    <div class="dashboard-icon">

                        <i class="fa-solid fa-code"></i>

                    </div>

                </div>

                <div>

                    <h4 class="card-title mb-1">

                        {{ __('digital_studio_admin.projects.edit.technologies.title') }}

                    </h4>

                    <small>

                        {{ __('digital_studio_admin.projects.edit.technologies.description') }}

                    </small>

                </div>

            </div>

            <div class="row">

                @forelse($technologies as $technology)

                    <div class="col-xl-3 col-lg-4 col-md-6 mb-4">

                        <label class="technology-card">

                            <input
                                type="checkbox"
                                name="technologies[]"
                                value="{{ $technology->id }}"
                                class="d-none"

                                @checked(
                                    in_array(
                                        $technology->id,
                                        old(
                                            'technologies',
                                            $project->technologies
                                                ->pluck('id')
                                                ->toArray()
                                        )
                                    )
                                )>

                            <div class="technology-card-body">

                                <div
                                    class="technology-icon"

                                    @if($technology->color)

                                        style="background:{{ $technology->color }}20;
                                               color:{{ $technology->color }}"

                                    @endif>

                                    @if($technology->icon)

                                        <i class="{{ $technology->icon }}"></i>

                                    @else

                                        <i class="fa-solid fa-laptop-code"></i>

                                    @endif

                                </div>

                                <h6>

                                    {{ $technology->name }}

                                </h6>

                                @if($technology->category)

                                    <small class="text-muted">

                                        {{ $technology->category->name }}

                                    </small>

                                @endif

                            </div>

                        </label>

                    </div>

                @empty

                    <div class="col-12">

                        <div class="empty-state">

                            <i class="fa-solid fa-code"></i>

                            <h5>

                                {{ __('digital_studio_admin.projects.edit.technologies.empty.title') }}

                            </h5>

                            <p>

                                {{ __('digital_studio_admin.projects.edit.technologies.empty.description') }}

                            </p>

                        </div>

                    </div>

                @endforelse

            </div>

        </div>

        <!--==================================
                PROJECT GALLERY
        ==================================-->

        <div class="admin-card mb-4">

            <div class="d-flex align-items-center mb-4">

                <div class="me-3">

                    <div class="dashboard-icon">

                        <i class="fa-solid fa-images"></i>

                    </div>

                </div>

                <div>

                    <h4 class="card-title mb-1">

                        {{ __('digital_studio_admin.projects.edit.gallery.title') }}

                    </h4>

                    <small>

                        {{ __('digital_studio_admin.projects.edit.gallery.description') }}

                    </small>

                </div>

            </div>

            <!-- Upload -->

            <div class="mb-5">

                <label class="form-label fw-semibold">

                    {{ __('digital_studio_admin.projects.edit.gallery.add_images') }}

                </label>

                <input
                    type="file"
                    name="gallery[]"
                    multiple
                    class="form-control">

            </div>

            <!-- Existing Images -->

            <div class="row" id="gallery-wrapper">

                @forelse($project->images as $image)

                    <div class="col-xl-3 col-lg-4 col-md-6 mb-4 gallery-item">

                        <div class="admin-card p-2 h-100">

                            <img
                                src="{{ asset('images/projects/gallery/'.$image->image) }}"
                                class="img-fluid rounded-4"
                                style="width:100%;height:200px;object-fit:cover;">

                            <div class="text-center mt-3">

                                <button
                                    type="button"
                                    class="btn btn-danger btn-sm rounded-pill px-4 delete-gallery-image"
                                    data-url="{{ route('admin.projects.gallery.delete',[
                                        'project'=>$project->slug,
                                        'image'=>$image->id
                                    ]) }}">

                                    <i class="fa-solid fa-trash me-2"></i>

                                    {{ __('digital_studio_admin.projects.edit.gallery.delete') }}

                                </button>

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="col-12">

                        <div class="empty-state">

                            <i class="fa-regular fa-images"></i>

                            <h5>

                                {{ __('digital_studio_admin.projects.edit.gallery.empty.title') }}

                            </h5>

                            <p>

                                {{ __('digital_studio_admin.projects.edit.gallery.empty.description') }}

                            </p>

                        </div>

                    </div>

                @endforelse

            </div>

        </div>

        <!--==================================
                PROJECT SETTINGS
        ==================================-->

        <div class="admin-card mb-4">

            <div class="d-flex align-items-center mb-4">

                <div class="me-3">

                    <div class="dashboard-icon">

                        <i class="fa-solid fa-sliders"></i>

                    </div>

                </div>

                <div>

                    <h4 class="card-title mb-1">

                        {{ __('digital_studio_admin.projects.edit.settings.title') }}

                    </h4>

                </div>

            </div>

            <div class="row">

                <div class="col-lg-4 mb-4">

                    <div class="setting-card">

                        <div>

                            <h6>
                                {{ __('digital_studio_admin.projects.edit.settings.featured.title') }}
                            </h6>

                            <small>
                                {{ __('digital_studio_admin.projects.edit.settings.featured.description') }}
                            </small>

                        </div>

                        <div class="form-check form-switch">

                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="featured"
                                value="1"
                                @checked(old('featured',$project->featured))>

                        </div>

                    </div>

                </div>

                <div class="col-lg-4 mb-4">

                    <div class="setting-card">

                        <div>

                            <h6>
                                {{ __('digital_studio_admin.projects.edit.settings.active.title') }}
                            </h6>

                            <small>
                                {{ __('digital_studio_admin.projects.edit.settings.active.description') }}
                            </small>

                        </div>

                        <div class="form-check form-switch">

                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="is_active"
                                value="1"
                                @checked(old('is_active',$project->is_active))>

                        </div>

                    </div>

                </div>

                <div class="col-lg-4">

                    <label class="form-label fw-semibold">

                        {{ __('digital_studio_admin.projects.edit.settings.status.label') }}

                    </label>

                    <select
                        name="status"
                        class="form-select">

                        <option
                            value="draft"
                            @selected(old('status',$project->status)=='draft')>

                            {{ __('digital_studio_admin.projects.edit.settings.status.draft') }}

                        </option>

                        <option
                            value="published"
                            @selected(old('status',$project->status)=='published')>

                            {{ __('digital_studio_admin.projects.edit.settings.status.published') }}

                        </option>

                    </select>

                </div>

            </div>

        </div>

        <!--==================================
                SAVE BUTTONS
        ==================================-->

        <div class="admin-card">

            <div class="d-flex justify-content-end gap-3">

                <a
                    href="{{ route('admin.projects.index') }}"
                    class="btn btn-light rounded-pill px-4">

                    {{ __('digital_studio_admin.projects.edit.actions.cancel') }}

                </a>

                <button
                    type="submit"
                    class="btn btn-primary rounded-pill px-5">

                    <i class="fa-solid fa-floppy-disk me-2"></i>

                    {{ __('digital_studio_admin.projects.edit.actions.save_changes') }}

                </button>

            </div>

        </div>

    </form>

</div>

@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {


    /*==================================
            COVER IMAGE
    ==================================*/

    const coverInput =
        document.getElementById('cover_image_input');

    const coverPreviewWrapper =
        document.getElementById('cover_image_preview_wrapper');

    const coverActions =
        document.getElementById('cover_image_actions');

    const coverRemoveBtn =
        document.getElementById('remove_cover_image_btn');

    const coverRemoveInput =
        document.getElementById('remove_cover_image');

    const coverFilename =
        document.getElementById('cover_image_filename');


    if (coverInput) {

        coverInput.addEventListener('change', function () {

            const file = this.files[0];

            if (!file) {
                return;
            }


            /*
             * New image selected.
             * Cancel pending deletion.
             */

            coverRemoveInput.value = '0';


            /*
             * Create preview
             */

            const reader = new FileReader();

            reader.onload = function (event) {

                coverPreviewWrapper.innerHTML = `

                    <img
                        src="${event.target.result}"
                        id="cover_image_preview"
                        class="img-fluid rounded-4 mb-3"
                        style="
                            width:100%;
                            height:260px;
                            object-fit:cover;
                        ">

                `;

                coverActions.style.display = 'flex';

                coverFilename.textContent =
                    '{{ __('digital_studio_admin.projects.edit.project_images.selected') }}: ' + file.name;

            };

            reader.readAsDataURL(file);

        });

    }


    /*
     * Delete Cover Image
     */

    if (coverRemoveBtn) {

        coverRemoveBtn.addEventListener('click', function (event) {

            event.preventDefault();

            coverRemoveInput.value = '1';

            coverInput.value = '';


            coverPreviewWrapper.innerHTML = `

                <div
                    class="upload-placeholder"
                    id="cover_image_placeholder">

                    <i class="fa-solid fa-cloud-arrow-up"></i>

                    <p class="mb-0">

                        {{ __('digital_studio_admin.projects.edit.project_images.upload.cover') }}

                    </p>

                </div>

            `;


            coverActions.style.display = 'none';

            coverFilename.textContent = '';

        });

    }



    /*==================================
            THUMBNAIL
    ==================================*/

    const thumbnailInput =
        document.getElementById('thumbnail_input');

    const thumbnailPreviewWrapper =
        document.getElementById('thumbnail_preview_wrapper');

    const thumbnailActions =
        document.getElementById('thumbnail_actions');

    const thumbnailRemoveBtn =
        document.getElementById('remove_thumbnail_btn');

    const thumbnailRemoveInput =
        document.getElementById('remove_thumbnail');

    const thumbnailFilename =
        document.getElementById('thumbnail_filename');


    if (thumbnailInput) {

        thumbnailInput.addEventListener('change', function () {

            const file = this.files[0];

            if (!file) {
                return;
            }


            /*
             * New image selected.
             * Cancel pending deletion.
             */

            thumbnailRemoveInput.value = '0';


            /*
             * Create preview
             */

            const reader = new FileReader();

            reader.onload = function (event) {

                thumbnailPreviewWrapper.innerHTML = `

                    <img
                        src="${event.target.result}"
                        id="thumbnail_preview"
                        class="img-fluid rounded-4 mb-3"
                        style="
                            width:100%;
                            height:260px;
                            object-fit:cover;
                        ">

                `;

                thumbnailActions.style.display = 'flex';

                thumbnailFilename.textContent =
                    '{{ __('digital_studio_admin.projects.edit.project_images.selected') }}: ' + file.name;

            };

            reader.readAsDataURL(file);

        });

    }


    /*
     * Delete Thumbnail
     */

    if (thumbnailRemoveBtn) {

        thumbnailRemoveBtn.addEventListener('click', function (event) {

            event.preventDefault();

            thumbnailRemoveInput.value = '1';

            thumbnailInput.value = '';


            thumbnailPreviewWrapper.innerHTML = `

                <div
                    class="upload-placeholder"
                    id="thumbnail_placeholder">

                    <i class="fa-solid fa-cloud-arrow-up"></i>

                    <p class="mb-0">

                        {{ __('digital_studio_admin.projects.edit.project_images.upload.thumbnail') }}

                    </p>

                </div>

            `;


            thumbnailActions.style.display = 'none';

            thumbnailFilename.textContent = '';

        });

    }

});

</script>

@endpush

@endsection
