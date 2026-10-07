@extends('education.admin.layouts.app')

@section('title', __('education_admin.lessons.content.page_title'))

@section('content')

<div class="education-admin-lesson-content-page">

    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}

    <div class="education-admin-lesson-content-header">

        <div class="education-admin-lesson-content-heading">

            <span class="education-admin-page-header-label">

                <i class="fa-solid fa-layer-group"></i>

                {{ __('education_admin.lessons.content.header_label') }}

            </span>


            <div class="education-admin-lesson-content-title-row">

                <div class="education-admin-lesson-content-title-icon">

                    <i class="fa-solid fa-book-open"></i>

                </div>

                <div>

                    <h2>
                        {{ $lesson->title }}
                    </h2>

                    <span class="education-admin-lesson-content-subtitle">

                        <i class="fa-solid fa-file-lines"></i>

                        {{ __('education_admin.lessons.content.subtitle') }}

                    </span>

                </div>

            </div>


            <p>
                {{ __('education_admin.lessons.content.description') }}
            </p>

        </div>


        {{-- =====================================================
            HEADER ACTIONS
        ====================================================== --}}

        <div class="education-admin-lesson-content-header-actions">

            {{-- ADD CONTENT --}}

            <a
                href="{{ route('education.admin.lessons.content.create', $lesson) }}"
                class="education-admin-lesson-content-add-button"
            >

                <i class="fa-solid fa-plus"></i>

                {{ __('education_admin.lessons.content.actions.add') }}

            </a>


            {{-- BACK TO LESSON --}}

            <a
                href="{{ route('education.admin.lessons.show', $lesson) }}"
                class="education-admin-lesson-content-back-button"
            >

                <i class="fa-solid fa-arrow-right"></i>

                {{ __('education_admin.lessons.content.actions.back') }}

            </a>

        </div>

    </div>


    {{-- =========================================================
        FLASH MESSAGES
    ========================================================== --}}

    @if(session('success'))

        <div class="education-admin-lesson-content-alert success">

            <div class="education-admin-lesson-content-alert-icon">

                <i class="fa-solid fa-circle-check"></i>

            </div>

            <div>

                <strong>
                    {{ __('education_admin.lessons.content.alerts.success_title') }}
                </strong>

                <span>
                    {{ session('success') }}
                </span>

            </div>

        </div>

    @endif


    @if(session('error'))

        <div class="education-admin-lesson-content-alert error">

            <div class="education-admin-lesson-content-alert-icon">

                <i class="fa-solid fa-circle-exclamation"></i>

            </div>

            <div>

                <strong>
                    {{ __('education_admin.lessons.content.alerts.error_title') }}
                </strong>

                <span>
                    {{ session('error') }}
                </span>

            </div>

        </div>

    @endif


    {{-- =========================================================
        VALIDATION ERRORS
    ========================================================== --}}

    @if($errors->any())

        <div class="education-admin-lesson-content-alert error">

            <div class="education-admin-lesson-content-alert-icon">

                <i class="fa-solid fa-circle-exclamation"></i>

            </div>

            <div>

                <strong>
                    {{ __('education_admin.lessons.content.alerts.validation_title') }}
                </strong>

                <ul>

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        </div>

    @endif


    {{-- =========================================================
        LESSON INFO BAR
    ========================================================== --}}

    <div class="education-admin-lesson-content-lesson-bar">

        <div class="education-admin-lesson-content-lesson-info">

            <div class="education-admin-lesson-content-lesson-icon">

                <i class="fa-solid fa-book"></i>

            </div>

            <div>

                <span>
                    {{ __('education_admin.lessons.content.lesson.current') }}
                </span>

                <strong>
                    {{ $lesson->title }}
                </strong>

            </div>

        </div>


        <div class="education-admin-lesson-content-lesson-meta">

            @if($lesson->category)

                <span>

                    <i class="fa-solid fa-layer-group"></i>

                    {{ $lesson->category }}

                </span>

            @endif


            <span>

                <i class="fa-solid fa-list-ol"></i>

                {{ $statistics['total'] }}

                {{ __('education_admin.lessons.content.item') }}

            </span>

        </div>

    </div>


    {{-- =========================================================
        STATISTICS
    ========================================================== --}}

    <div class="education-admin-lesson-content-stats-grid">


        {{-- TOTAL --}}

        <div class="education-admin-lesson-content-stat-card">

            <div class="education-admin-lesson-content-stat-icon green">

                <i class="fa-solid fa-layer-group"></i>

            </div>

            <div>

                <span>
                    {{ __('education_admin.lessons.content.statistics.total') }}
                </span>

                <strong>
                    {{ $statistics['total'] }}
                </strong>

            </div>

        </div>


        {{-- TEXT --}}

        <div class="education-admin-lesson-content-stat-card">

            <div class="education-admin-lesson-content-stat-icon blue">

                <i class="fa-solid fa-align-right"></i>

            </div>

            <div>

                <span>
                    {{ __('education_admin.lessons.content.statistics.text') }}
                </span>

                <strong>
                    {{ $statistics['text'] }}
                </strong>

            </div>

        </div>


        {{-- IMAGE --}}

        <div class="education-admin-lesson-content-stat-card">

            <div class="education-admin-lesson-content-stat-icon gold">

                <i class="fa-regular fa-image"></i>

            </div>

            <div>

                <span>
                    {{ __('education_admin.lessons.content.statistics.image') }}
                </span>

                <strong>
                    {{ $statistics['image'] }}
                </strong>

            </div>

        </div>


        {{-- VIDEO --}}

        <div class="education-admin-lesson-content-stat-card">

            <div class="education-admin-lesson-content-stat-icon red">

                <i class="fa-solid fa-video"></i>

            </div>

            <div>

                <span>
                    {{ __('education_admin.lessons.content.statistics.video') }}
                </span>

                <strong>
                    {{ $statistics['video'] ?? 0 }}
                </strong>

            </div>

        </div>


        {{-- LINK --}}

        <div class="education-admin-lesson-content-stat-card">

            <div class="education-admin-lesson-content-stat-icon purple">

                <i class="fa-solid fa-link"></i>

            </div>

            <div>

                <span>
                    {{ __('education_admin.lessons.content.statistics.link') }}
                </span>

                <strong>
                    {{ $statistics['link'] }}
                </strong>

            </div>

        </div>


        {{-- FILE --}}

        <div class="education-admin-lesson-content-stat-card">

            <div class="education-admin-lesson-content-stat-icon red">

                <i class="fa-solid fa-file"></i>

            </div>

            <div>

                <span>
                    {{ __('education_admin.lessons.content.statistics.file') }}
                </span>

                <strong>
                    {{ $statistics['file'] }}
                </strong>

            </div>

        </div>

    </div>


    {{-- =========================================================
        CONTENT CARD
    ========================================================== --}}

    <div class="education-admin-lesson-content-main-card">


        {{-- =====================================================
            CARD HEADER
        ====================================================== --}}

        <div class="education-admin-lesson-content-card-header">

            <div class="education-admin-lesson-content-card-heading">

                <div class="education-admin-lesson-content-card-icon">

                    <i class="fa-solid fa-list"></i>

                </div>

                <div>

                    <span>
                        {{ __('education_admin.lessons.content.elements.label') }}
                    </span>

                    <h3>
                        {{ __('education_admin.lessons.content.elements.title') }}
                    </h3>

                </div>

            </div>


            @if($contents->count())

                <div class="education-admin-lesson-content-card-count">

                    {{ $contents->count() }}

                    {{ __('education_admin.lessons.content.item') }}

                </div>

            @endif

        </div>


        {{-- =====================================================
            CONTENT LIST
        ====================================================== --}}

        @if($contents->count())


            <div
                class="education-admin-lesson-content-list"
                id="lesson-content-list"
            >


                @foreach($contents as $content)


                    {{-- =================================================
                        CONTENT ITEM
                    ================================================== --}}

                    <div
                        class="education-admin-lesson-content-item
                        {{ !$content->is_active ? 'inactive' : '' }}"
                        data-id="{{ $content->id }}"
                    >


                        {{-- =============================================
                            DRAG HANDLE
                        ============================================== --}}

                        <div class="education-admin-lesson-content-drag-handle">

                            <i class="fa-solid fa-grip-vertical"></i>

                        </div>


                        {{-- =============================================
                            TYPE ICON
                        ============================================== --}}

                        <div
                            class="education-admin-lesson-content-item-icon
                            {{ $content->type }}"
                        >

                            @if($content->type === 'text')

                                <i class="fa-solid fa-align-right"></i>

                            @elseif($content->type === 'image')

                                <i class="fa-regular fa-image"></i>

                            @elseif($content->type === 'video')

                                <i class="fa-solid fa-video"></i>

                            @elseif($content->type === 'link')

                                <i class="fa-solid fa-link"></i>

                            @elseif($content->type === 'file')

                                <i class="fa-solid fa-file"></i>

                            @else

                                <i class="fa-solid fa-file-lines"></i>

                            @endif

                        </div>


                        {{-- =============================================
                            MAIN INFO
                        ============================================== --}}

                        <div class="education-admin-lesson-content-item-main">

                            <div class="education-admin-lesson-content-item-top">

                                <div>

                                    <div class="education-admin-lesson-content-item-title">

                                        {{ $content->title ?: __('education_admin.lessons.content.item_no_title') }}

                                    </div>


                                    {{-- TYPE BADGE --}}

                                    <span
                                        class="education-admin-lesson-content-type-badge
                                        {{ $content->type }}"
                                    >

                                        @if($content->type === 'text')

                                            <i class="fa-solid fa-align-right"></i>

                                            {{ __('education_admin.lessons.content.types.text') }}

                                        @elseif($content->type === 'image')

                                            <i class="fa-regular fa-image"></i>

                                            {{ __('education_admin.lessons.content.types.image') }}

                                        @elseif($content->type === 'video')

                                            <i class="fa-solid fa-video"></i>

                                            {{ __('education_admin.lessons.content.types.video') }}

                                        @elseif($content->type === 'link')

                                            <i class="fa-solid fa-link"></i>

                                            {{ __('education_admin.lessons.content.types.link') }}

                                        @elseif($content->type === 'file')

                                            <i class="fa-solid fa-file"></i>

                                            {{ __('education_admin.lessons.content.types.file') }}

                                        @else

                                            <i class="fa-solid fa-file-lines"></i>

                                            {{ __('education_admin.lessons.content.types.content') }}

                                        @endif

                                    </span>

                                </div>


                                {{-- STATUS --}}

                                @if($content->is_active)

                                    <span class="education-admin-lesson-content-status active">

                                        <i class="fa-solid fa-circle-check"></i>

                                        {{ __('education_admin.lessons.content.status.active') }}

                                    </span>

                                @else

                                    <span class="education-admin-lesson-content-status inactive">

                                        <i class="fa-solid fa-circle-pause"></i>

                                        {{ __('education_admin.lessons.content.status.inactive') }}

                                    </span>

                                @endif

                            </div>


                            {{-- =============================================
                                DESCRIPTION
                            ============================================== --}}

                            @if($content->description)

                                <p class="education-admin-lesson-content-item-description">

                                    {{ Str::limit($content->description, 150) }}

                                </p>

                            @endif


                            {{-- =============================================
                                CONTENT PREVIEW
                            ============================================== --}}

                            @if($content->type === 'text' && $content->content)

                                <div class="education-admin-lesson-content-text-preview">

                                    {{ Str::limit(
                                        strip_tags($content->content),
                                        180
                                    ) }}

                                </div>


                            @elseif($content->type === 'image' && $content->file_path)

                                <div class="education-admin-lesson-content-image-preview">

                                    <img
                                        src="{{ asset($content->file_path) }}"
                                        alt="{{ $content->title ?: __('education_admin.lessons.content.image_alt') }}"
                                    >

                                </div>


                            {{-- =================================================
                                VIDEO PREVIEW
                                الفيديو يعتمد على URL خارجي وليس ملفًا مرفوعًا
                            ================================================== --}}

                            @elseif($content->type === 'video' && $content->url)

                                <div class="education-admin-lesson-content-video-preview">

                                    <video
                                        controls
                                        preload="metadata"
                                        playsinline
                                        controlsList="nodownload"
                                    >

                                        <source
                                            src="{{ $content->url }}"
                                            type="video/mp4"
                                        >

                                        {{ __('education_admin.lessons.content.video_not_supported') }}

                                    </video>

                                </div>


                            @elseif($content->type === 'link' && $content->url)

                                <div class="education-admin-lesson-content-link-preview">

                                    <i class="fa-solid fa-arrow-up-right-from-square"></i>

                                    <span class="ltr">

                                        {{ Str::limit(
                                            $content->url,
                                            90
                                        ) }}

                                    </span>

                                </div>


                            @elseif($content->type === 'file' && $content->file_path)

                                <div class="education-admin-lesson-content-file-preview">

                                    <i class="fa-solid fa-file-lines"></i>

                                    <span>

                                        {{ $content->file_name ?: __('education_admin.lessons.content.lesson_file') }}

                                    </span>

                                </div>

                            @endif


                            {{-- =============================================
                                META
                            ============================================== --}}

                            <div class="education-admin-lesson-content-item-meta">

                                <span>

                                    <i class="fa-solid fa-arrow-down-1-9"></i>

                                    {{ __('education_admin.lessons.content.meta.order') }}:

                                    #{{ $content->sort_order }}

                                </span>


                                @if($content->created_at)

                                    <span>

                                        <i class="fa-regular fa-calendar"></i>

                                        {{ $content->created_at->format('Y/m/d') }}

                                    </span>

                                @endif


                                {{-- FILE SIZE
                                     الفيديو الخارجي لا يعتمد على file_size
                                --}}

                                @if(
                                    $content->file_size &&
                                    $content->type !== 'video'
                                )

                                    <span>

                                        <i class="fa-solid fa-hard-drive"></i>

                                        {{ number_format(
                                            $content->file_size / 1024,
                                            1
                                        ) }}

                                        KB

                                    </span>

                                @endif

                            </div>

                        </div>


                        {{-- =============================================
                            ACTIONS
                        ============================================== --}}

                        <div class="education-admin-lesson-content-item-actions">


                            {{-- SHOW --}}

                            <a
                                href="{{ route(
                                    'education.admin.lessons.content.show',
                                    [
                                        'lesson' => $lesson,
                                        'content' => $content
                                    ]
                                ) }}"
                                class="education-admin-lesson-content-action view"
                                title="{{ __('education_admin.lessons.content.actions.view') }}"
                            >

                                <i class="fa-solid fa-eye"></i>

                            </a>


                            {{-- EDIT --}}

                            <a
                                href="{{ route(
                                    'education.admin.lessons.content.edit',
                                    [
                                        'lesson' => $lesson,
                                        'content' => $content
                                    ]
                                ) }}"
                                class="education-admin-lesson-content-action edit"
                                title="{{ __('education_admin.lessons.content.actions.edit') }}"
                            >

                                <i class="fa-solid fa-pen"></i>

                            </a>


                            {{-- TOGGLE --}}

                            <form
                                action="{{ route(
                                    'education.admin.lessons.content.toggle-status',
                                    [
                                        'lesson' => $lesson,
                                        'content' => $content
                                    ]
                                ) }}"
                                method="POST"
                                class="education-admin-lesson-content-inline-form"
                            >

                                @csrf

                                @method('PATCH')

                                <button
                                    type="submit"
                                    class="education-admin-lesson-content-action
                                    {{ $content->is_active ? 'disable' : 'enable' }}"
                                    title="{{ $content->is_active
                                        ? __('education_admin.lessons.content.actions.disable')
                                        : __('education_admin.lessons.content.actions.activate') }}"
                                >

                                    @if($content->is_active)

                                        <i class="fa-solid fa-pause"></i>

                                    @else

                                        <i class="fa-solid fa-play"></i>

                                    @endif

                                </button>

                            </form>


                            {{-- DELETE --}}

                            <form
                                action="{{ route(
                                    'education.admin.lessons.content.destroy',
                                    [
                                        'lesson' => $lesson,
                                        'content' => $content
                                    ]
                                ) }}"
                                method="POST"
                                class="education-admin-lesson-content-inline-form"
                                onsubmit="return confirm('{{ __('education_admin.lessons.content.actions.confirm_delete') }}');"
                            >

                                @csrf

                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="education-admin-lesson-content-action delete"
                                    title="{{ __('education_admin.lessons.content.actions.delete') }}"
                                >

                                    <i class="fa-solid fa-trash"></i>

                                </button>

                            </form>

                        </div>

                    </div>

                @endforeach

            </div>


            {{-- =====================================================
                REORDER FOOTER
            ====================================================== --}}

            <div class="education-admin-lesson-content-reorder-footer">

                <div class="education-admin-lesson-content-reorder-info">

                    <i class="fa-solid fa-up-down-left-right"></i>

                    <div>

                        <strong>
                            {{ __('education_admin.lessons.content.reorder.title') }}
                        </strong>

                        <span>
                            {{ __('education_admin.lessons.content.reorder.description') }}
                        </span>

                    </div>

                </div>


                <button
                    type="button"
                    id="save-content-order"
                    class="education-admin-lesson-content-save-order-button"
                >

                    <i class="fa-solid fa-floppy-disk"></i>

                    {{ __('education_admin.lessons.content.reorder.save') }}

                </button>

            </div>


        @else


            {{-- =====================================================
                EMPTY STATE
            ====================================================== --}}

            <div class="education-admin-lesson-content-empty">

                <div class="education-admin-lesson-content-empty-icon">

                    <i class="fa-regular fa-folder-open"></i>

                </div>


                <strong>
                    {{ __('education_admin.lessons.content.empty.title') }}
                </strong>


                <p>
                    {{ __('education_admin.lessons.content.empty.description') }}
                </p>


                <a
                    href="{{ route(
                        'education.admin.lessons.content.create',
                        $lesson
                    ) }}"
                    class="education-admin-lesson-content-empty-button"
                >

                    <i class="fa-solid fa-plus"></i>

                    {{ __('education_admin.lessons.content.empty.add_first') }}

                </a>

            </div>

        @endif

    </div>


    {{-- =========================================================
        FOOTER NOTE
    ========================================================== --}}

    <div class="education-admin-lesson-content-note">

        <div class="education-admin-lesson-content-note-icon">

            <i class="fa-solid fa-lightbulb"></i>

        </div>

        <div>

            <strong>
                {{ __('education_admin.lessons.content.note.title') }}
            </strong>

            <p>
                {{ __('education_admin.lessons.content.note.description') }}
            </p>

        </div>

    </div>

</div>


{{-- =========================================================
    REORDER SCRIPT
========================================================= --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const list = document.getElementById('lesson-content-list');

    const saveButton =
        document.getElementById('save-content-order');


    if (!list || !saveButton) {
        return;
    }


    let draggedItem = null;


    /*
    |--------------------------------------------------------------------------
    | DRAG START
    |--------------------------------------------------------------------------
    */

    list.querySelectorAll(
        '.education-admin-lesson-content-item'
    ).forEach(function (item) {

        item.setAttribute(
            'draggable',
            'true'
        );


        item.addEventListener(
            'dragstart',
            function () {

                draggedItem = this;

                this.classList.add(
                    'dragging'
                );

            }
        );


        item.addEventListener(
            'dragend',
            function () {

                this.classList.remove(
                    'dragging'
                );

                draggedItem = null;

            }
        );


        item.addEventListener(
            'dragover',
            function (event) {

                event.preventDefault();


                if (
                    !draggedItem ||
                    draggedItem === this
                ) {
                    return;
                }


                const rect =
                    this.getBoundingClientRect();


                const offset =
                    event.clientY -
                    rect.top;


                if (
                    offset >
                    rect.height / 2
                ) {

                    this.after(
                        draggedItem
                    );

                } else {

                    this.before(
                        draggedItem
                    );

                }

            }
        );

    });


    /*
    |--------------------------------------------------------------------------
    | SAVE ORDER
    |--------------------------------------------------------------------------
    */

    saveButton.addEventListener(
        'click',
        function () {

            const items =
                list.querySelectorAll(
                    '.education-admin-lesson-content-item'
                );


            const contents =
                Array.from(items)
                    .map(function (item) {

                        return item.dataset.id;

                    });


            if (!contents.length) {
                return;
            }


            saveButton.disabled = true;


            const originalHTML =
                saveButton.innerHTML;


            saveButton.innerHTML =

                '<i class="fa-solid fa-spinner fa-spin"></i> {{ __('education_admin.lessons.content.reorder.saving') }}';


            fetch(
                "{{ route(
                    'education.admin.lessons.content.reorder',
                    $lesson
                ) }}",
                {

                    method: 'POST',

                    headers: {

                        'Content-Type':
                            'application/json',

                        'Accept':
                            'application/json',

                        'X-CSRF-TOKEN':
                            "{{ csrf_token() }}"

                    },

                    body:
                        JSON.stringify({
                            contents: contents
                        })

                }
            )
            .then(function (response) {

                return response.json();

            })
            .then(function (data) {

                if (data.success) {

                    saveButton.innerHTML =
                        '<i class="fa-solid fa-circle-check"></i> {{ __('education_admin.lessons.content.reorder.saved') }}';


                    setTimeout(function () {

                        saveButton.innerHTML =
                            originalHTML;

                        saveButton.disabled =
                            false;

                    }, 1800);

                } else {

                    throw new Error(
                        'Reorder failed'
                    );

                }

            })
            .catch(function () {

                saveButton.innerHTML =
                    '<i class="fa-solid fa-circle-exclamation"></i> {{ __('education_admin.lessons.content.reorder.error') }}';


                setTimeout(function () {

                    saveButton.innerHTML =
                        originalHTML;

                    saveButton.disabled =
                        false;

                }, 1800);

            });

        }
    );

});

</script>

@endsection
