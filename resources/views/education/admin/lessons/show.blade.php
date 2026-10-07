@extends('education.admin.layouts.app')

@section('title', __('education_admin.lessons.show.page_title'))

@section('content')

<div class="education-admin-lesson-show-page">

    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}

    <div class="education-admin-lesson-show-header">

        <div class="education-admin-lesson-show-heading">

            <span class="education-admin-page-header-label">

                <i class="fa-solid fa-book-open"></i>

                {{ __('education_admin.lessons.show.header_label') }}

            </span>


            <div class="education-admin-lesson-show-title-row">

                <div class="education-admin-lesson-show-title-icon">

                    <i class="fa-solid fa-book"></i>

                </div>

                <div>

                    <h2>
                        {{ $lesson->title }}
                    </h2>

                    @if($lesson->category)

                        <span class="education-admin-lesson-category">

                            <i class="fa-solid fa-layer-group"></i>

                            {{ $lesson->category }}

                        </span>

                    @endif

                </div>

            </div>


            <p>
                {{ __('education_admin.lessons.show.description') }}
            </p>

        </div>


        {{-- =====================================================
            HEADER ACTIONS
        ====================================================== --}}

        <div class="education-admin-lesson-show-header-actions">


            {{-- LESSON CONTENT --}}

            <a
                href="{{ route('education.admin.lessons.content.index', $lesson) }}"
                class="education-admin-lesson-content-button"
            >

                <i class="fa-solid fa-layer-group"></i>

                {{ __('education_admin.lessons.show.actions.content') }}

            </a>


            {{-- EDIT --}}

            <a
                href="{{ route('education.admin.lessons.edit', $lesson) }}"
                class="education-admin-lesson-edit-button"
            >

                <i class="fa-solid fa-pen"></i>

                {{ __('education_admin.lessons.show.actions.edit') }}

            </a>


            {{-- BACK --}}

            <a
                href="{{ route('education.admin.lessons.index') }}"
                class="education-admin-lesson-back-button"
            >

                <i class="fa-solid fa-arrow-right"></i>

                {{ __('education_admin.lessons.show.actions.back') }}

            </a>

        </div>

    </div>


    {{-- =========================================================
        FLASH MESSAGES
    ========================================================== --}}

    @if(session('success'))

        <div class="education-admin-lesson-show-alert success">

            <div class="education-admin-lesson-show-alert-icon">

                <i class="fa-solid fa-circle-check"></i>

            </div>

            <div>

                <strong>
                    {{ __('education_admin.lessons.show.alerts.success_title') }}
                </strong>

                <span>
                    {{ session('success') }}
                </span>

            </div>

        </div>

    @endif


    @if(session('error'))

        <div class="education-admin-lesson-show-alert error">

            <div class="education-admin-lesson-show-alert-icon">

                <i class="fa-solid fa-circle-exclamation"></i>

            </div>

            <div>

                <strong>
                    {{ __('education_admin.lessons.show.alerts.error_title') }}
                </strong>

                <span>
                    {{ session('error') }}
                </span>

            </div>

        </div>

    @endif


    {{-- =========================================================
        STATUS BANNER
    ========================================================== --}}

    <div
        class="education-admin-lesson-status-banner
        {{ $lesson->is_active ? 'active' : 'inactive' }}"
    >

        <div class="education-admin-lesson-status-main">

            <div class="education-admin-lesson-status-icon">

                @if($lesson->is_active)

                    <i class="fa-solid fa-circle-check"></i>

                @else

                    <i class="fa-solid fa-circle-pause"></i>

                @endif

            </div>


            <div>

                <strong>

                    {{ $lesson->is_active
                        ? __('education_admin.lessons.show.status.active')
                        : __('education_admin.lessons.show.status.inactive')
                    }}

                </strong>

                <span>

                    {{ $lesson->is_active
                        ? __('education_admin.lessons.show.status.active_description')
                        : __('education_admin.lessons.show.status.inactive_description')
                    }}

                </span>

            </div>

        </div>


        {{-- TOGGLE STATUS --}}

        <form
            action="{{ route('education.admin.lessons.toggle-status', $lesson) }}"
            method="POST"
        >

            @csrf

            @method('PATCH')

            <button
                type="submit"
                class="education-admin-lesson-status-action
                {{ $lesson->is_active ? 'disable' : 'enable' }}"
            >

                @if($lesson->is_active)

                    <i class="fa-solid fa-pause"></i>

                    {{ __('education_admin.lessons.show.actions.deactivate') }}

                @else

                    <i class="fa-solid fa-play"></i>

                    {{ __('education_admin.lessons.show.actions.activate') }}

                @endif

            </button>

        </form>

    </div>


    {{-- =========================================================
        STATISTICS
    ========================================================== --}}

    <div class="education-admin-lesson-stats-grid">


        {{-- DURATION --}}

        <div class="education-admin-lesson-stat-card">

            <div class="education-admin-lesson-stat-icon green">

                <i class="fa-regular fa-clock"></i>

            </div>

            <div>

                <span>
                    {{ __('education_admin.lessons.show.statistics.duration') }}
                </span>

                <strong>

                    {{ $lesson->duration }}

                    <small>
                        {{ __('education_admin.lessons.show.statistics.minute') }}
                    </small>

                </strong>

            </div>

        </div>


        {{-- PRICE --}}

        <div class="education-admin-lesson-stat-card">

            <div class="education-admin-lesson-stat-icon gold">

                <i class="fa-solid fa-coins"></i>

            </div>

            <div>

                <span>
                    {{ __('education_admin.lessons.show.statistics.price') }}
                </span>

                <strong>

                    {{ number_format($lesson->price, 2) }}

                    <small>
                        {{ $lesson->currency }}
                    </small>

                </strong>

            </div>

        </div>


        {{-- CONTENT --}}

        <div class="education-admin-lesson-stat-card">

            <div class="education-admin-lesson-stat-icon blue">

                <i class="fa-solid fa-layer-group"></i>

            </div>

            <div>

                <span>
                    {{ __('education_admin.lessons.show.statistics.content') }}
                </span>

                <strong>
                    {{ __('education_admin.lessons.show.statistics.manage') }}
                </strong>

            </div>

        </div>


        {{-- SORT ORDER --}}

        <div class="education-admin-lesson-stat-card">

            <div class="education-admin-lesson-stat-icon purple">

                <i class="fa-solid fa-arrow-down-1-9"></i>

            </div>

            <div>

                <span>
                    {{ __('education_admin.lessons.show.statistics.sort_order') }}
                </span>

                <strong>
                    #{{ $lesson->sort_order ?? 0 }}
                </strong>

            </div>

        </div>

    </div>


    {{-- =========================================================
        MAIN CONTENT
    ========================================================== --}}

    <div class="education-admin-lesson-show-grid">


        {{-- =====================================================
            LEFT / MAIN COLUMN
        ====================================================== --}}

        <div class="education-admin-lesson-show-main">


            {{-- =================================================
                DESCRIPTION
            ================================================== --}}

            <div class="education-admin-lesson-show-card">

                <div class="education-admin-lesson-show-card-header">

                    <div class="education-admin-lesson-show-card-icon">

                        <i class="fa-solid fa-align-right"></i>

                    </div>

                    <div>

                        <span>
                            {{ __('education_admin.lessons.show.description_section.label') }}
                        </span>

                        <h3>
                            {{ __('education_admin.lessons.show.description_section.title') }}
                        </h3>

                    </div>

                </div>


                <div class="education-admin-lesson-description">

                    @if($lesson->description)

                        <p>
                            {{ $lesson->description }}
                        </p>

                    @else

                        <div class="education-admin-lesson-empty-description">

                            <i class="fa-regular fa-file-lines"></i>

                            <span>
                                {{ __('education_admin.lessons.show.description_section.empty') }}
                            </span>

                        </div>

                    @endif

                </div>

            </div>


            {{-- =================================================
                LESSON CONTENT QUICK CARD
            ================================================== --}}

            <div class="education-admin-lesson-show-card">

                <div class="education-admin-lesson-show-card-header">

                    <div class="education-admin-lesson-show-card-icon">

                        <i class="fa-solid fa-layer-group"></i>

                    </div>

                    <div>

                        <span>
                            {{ __('education_admin.lessons.show.content_section.label') }}
                        </span>

                        <h3>
                            {{ __('education_admin.lessons.show.content_section.title') }}
                        </h3>

                    </div>

                </div>


                <div class="education-admin-lesson-content-preview">

                    <div class="education-admin-lesson-content-preview-icon">

                        <i class="fa-solid fa-folder-open"></i>

                    </div>


                    <div class="education-admin-lesson-content-preview-text">

                        <strong>
                            {{ __('education_admin.lessons.show.content_section.manage_title') }}
                        </strong>

                        <p>
                            {{ __('education_admin.lessons.show.content_section.manage_description') }}
                        </p>

                    </div>


                    <a
                        href="{{ route('education.admin.lessons.content.index', $lesson) }}"
                        class="education-admin-lesson-content-preview-button"
                    >

                        <span>
                            {{ __('education_admin.lessons.show.content_section.open') }}
                        </span>

                        <i class="fa-solid fa-arrow-left"></i>

                    </a>

                </div>

            </div>


            {{-- =================================================
                PUBLIC PAGE PREVIEW
            ================================================== --}}

            <div class="education-admin-lesson-show-card">

                <div class="education-admin-lesson-show-card-header">

                    <div class="education-admin-lesson-show-card-icon gold">

                        <i class="fa-solid fa-globe"></i>

                    </div>

                    <div>

                        <span>
                            {{ __('education_admin.lessons.show.public_section.label') }}
                        </span>

                        <h3>
                            {{ __('education_admin.lessons.show.public_section.title') }}
                        </h3>

                    </div>

                </div>


                <div class="education-admin-lesson-content-preview">

                    <div class="education-admin-lesson-content-preview-icon">

                        @if($lesson->is_active)

                            <i class="fa-solid fa-eye"></i>

                        @else

                            <i class="fa-solid fa-eye-slash"></i>

                        @endif

                    </div>


                    <div class="education-admin-lesson-content-preview-text">

                        <strong>

                            {{ $lesson->is_active
                                ? __('education_admin.lessons.show.public_section.active_title')
                                : __('education_admin.lessons.show.public_section.inactive_title')
                            }}

                        </strong>

                        <p>

                            {{ $lesson->is_active
                                ? __('education_admin.lessons.show.public_section.active_description')
                                : __('education_admin.lessons.show.public_section.inactive_description')
                            }}

                        </p>

                    </div>


                    {{--

                        لا يوجد حاليًا Route للواجهة الأمامية
                        باسم education.front.lessons.show.

                        لذلك لا نضع رابطًا غير موجود حتى لا
                        تظهر RouteNotFoundException.

                    --}}

                    <div
                        class="education-admin-lesson-content-preview-button"
                        style="cursor: default;"
                    >

                        <span>

                            {{ $lesson->is_active
                                ? __('education_admin.lessons.show.public_section.available_soon')
                                : __('education_admin.lessons.show.public_section.hidden')
                            }}

                        </span>

                        <i
                            class="fa-solid
                            {{ $lesson->is_active
                                ? 'fa-clock'
                                : 'fa-eye-slash'
                            }}"
                        ></i>

                    </div>

                </div>

            </div>


        </div>


        {{-- =====================================================
            SIDEBAR
        ====================================================== --}}

        <aside class="education-admin-lesson-show-sidebar">


            {{-- =================================================
                LESSON INFORMATION
            ================================================== --}}

            <div class="education-admin-lesson-show-card">

                <div class="education-admin-lesson-show-card-header">

                    <div class="education-admin-lesson-show-card-icon">

                        <i class="fa-solid fa-circle-info"></i>

                    </div>

                    <div>

                        <span>
                            {{ __('education_admin.lessons.show.information.label') }}
                        </span>

                        <h3>
                            {{ __('education_admin.lessons.show.information.title') }}
                        </h3>

                    </div>

                </div>


                <div class="education-admin-lesson-info-list">


                    {{-- CATEGORY --}}

                    <div class="education-admin-lesson-info-item">

                        <span>

                            <i class="fa-solid fa-layer-group"></i>

                            {{ __('education_admin.lessons.show.information.category') }}

                        </span>

                        <strong>

                            {{ $lesson->category ?: __('education_admin.lessons.show.information.not_specified') }}

                        </strong>

                    </div>


                    {{-- DURATION --}}

                    <div class="education-admin-lesson-info-item">

                        <span>

                            <i class="fa-regular fa-clock"></i>

                            {{ __('education_admin.lessons.show.information.duration') }}

                        </span>

                        <strong>

                            {{ $lesson->duration }}

                            {{ __('education_admin.lessons.show.statistics.minute') }}

                        </strong>

                    </div>


                    {{-- PRICE --}}

                    <div class="education-admin-lesson-info-item">

                        <span>

                            <i class="fa-solid fa-money-bill-wave"></i>

                            {{ __('education_admin.lessons.show.information.price') }}

                        </span>

                        <strong>

                            {{ number_format($lesson->price, 2) }}

                            {{ $lesson->currency }}

                        </strong>

                    </div>


                    {{-- CURRENCY --}}

                    <div class="education-admin-lesson-info-item">

                        <span>

                            <i class="fa-solid fa-coins"></i>

                            {{ __('education_admin.lessons.show.information.currency') }}

                        </span>

                        <strong>

                            {{ $lesson->currency }}

                        </strong>

                    </div>


                    {{-- SLUG --}}

                    <div class="education-admin-lesson-info-item">

                        <span>

                            <i class="fa-solid fa-link"></i>

                            {{ __('education_admin.lessons.show.information.slug') }}

                        </span>

                        <strong class="ltr">

                            {{ $lesson->slug }}

                        </strong>

                    </div>


                    {{-- CREATED --}}

                    <div class="education-admin-lesson-info-item">

                        <span>

                            <i class="fa-regular fa-calendar-plus"></i>

                            {{ __('education_admin.lessons.show.information.created_at') }}

                        </span>

                        <strong>

                            {{ optional($lesson->created_at)->format('Y/m/d') }}

                        </strong>

                    </div>


                    {{-- UPDATED --}}

                    <div class="education-admin-lesson-info-item">

                        <span>

                            <i class="fa-regular fa-calendar-check"></i>

                            {{ __('education_admin.lessons.show.information.updated_at') }}

                        </span>

                        <strong>

                            {{ optional($lesson->updated_at)->format('Y/m/d') }}

                        </strong>

                    </div>

                </div>

            </div>


            {{-- =================================================
                QUICK ACTIONS
            ================================================== --}}

            <div class="education-admin-lesson-show-card">

                <div class="education-admin-lesson-show-card-header">

                    <div class="education-admin-lesson-show-card-icon gold">

                        <i class="fa-solid fa-bolt"></i>

                    </div>

                    <div>

                        <span>
                            {{ __('education_admin.lessons.show.quick_actions.label') }}
                        </span>

                        <h3>
                            {{ __('education_admin.lessons.show.quick_actions.title') }}
                        </h3>

                    </div>

                </div>


                <div class="education-admin-lesson-quick-actions">


                    {{-- LESSON CONTENT --}}

                    <a
                        href="{{ route('education.admin.lessons.content.index', $lesson) }}"
                        class="education-admin-lesson-quick-action content"
                    >

                        <span class="icon blue">

                            <i class="fa-solid fa-layer-group"></i>

                        </span>

                        <span class="text">

                            <strong>
                                {{ __('education_admin.lessons.show.actions.content') }}
                            </strong>

                            <small>
                                {{ __('education_admin.lessons.show.quick_actions.content_description') }}
                            </small>

                        </span>

                        <i class="fa-solid fa-chevron-left arrow"></i>

                    </a>


                    {{-- EDIT --}}

                    <a
                        href="{{ route('education.admin.lessons.edit', $lesson) }}"
                        class="education-admin-lesson-quick-action"
                    >

                        <span class="icon green">

                            <i class="fa-solid fa-pen"></i>

                        </span>

                        <span class="text">

                            <strong>
                                {{ __('education_admin.lessons.show.actions.edit') }}
                            </strong>

                            <small>
                                {{ __('education_admin.lessons.show.quick_actions.edit_description') }}
                            </small>

                        </span>

                        <i class="fa-solid fa-chevron-left arrow"></i>

                    </a>


                    {{-- TOGGLE STATUS --}}

                    <form
                        action="{{ route('education.admin.lessons.toggle-status', $lesson) }}"
                        method="POST"
                    >

                        @csrf

                        @method('PATCH')

                        <button
                            type="submit"
                            class="education-admin-lesson-quick-action"
                        >

                            <span
                                class="icon
                                {{ $lesson->is_active ? 'red' : 'green' }}"
                            >

                                <i
                                    class="fa-solid
                                    {{ $lesson->is_active
                                        ? 'fa-pause'
                                        : 'fa-play'
                                    }}"
                                ></i>

                            </span>

                            <span class="text">

                                <strong>

                                    {{ $lesson->is_active
                                        ? __('education_admin.lessons.show.actions.deactivate')
                                        : __('education_admin.lessons.show.actions.activate')
                                    }}

                                </strong>

                                <small>

                                    {{ $lesson->is_active
                                        ? __('education_admin.lessons.show.quick_actions.deactivate_description')
                                        : __('education_admin.lessons.show.quick_actions.activate_description')
                                    }}

                                </small>

                            </span>

                            <i class="fa-solid fa-chevron-left arrow"></i>

                        </button>

                    </form>


                    {{-- DELETE --}}

                    <form
                        action="{{ route('education.admin.lessons.destroy', $lesson) }}"
                        method="POST"
                        onsubmit="return confirm(@json(__('education_admin.lessons.show.actions.confirm_delete')));"
                    >

                        @csrf

                        @method('DELETE')

                        <button
                            type="submit"
                            class="education-admin-lesson-quick-action danger"
                        >

                            <span class="icon red">

                                <i class="fa-solid fa-trash"></i>

                            </span>

                            <span class="text">

                                <strong>
                                    {{ __('education_admin.lessons.show.actions.delete') }}
                                </strong>

                                <small>
                                    {{ __('education_admin.lessons.show.quick_actions.delete_description') }}
                                </small>

                            </span>

                            <i class="fa-solid fa-chevron-left arrow"></i>

                        </button>

                    </form>

                </div>

            </div>


            {{-- =================================================
                PUBLIC VISIBILITY NOTE
            ================================================== --}}

            <div class="education-admin-lesson-show-note">

                <div class="education-admin-lesson-show-note-icon">

                    <i class="fa-solid fa-lightbulb"></i>

                </div>

                <div>

                    <strong>
                        {{ __('education_admin.lessons.show.note.title') }}
                    </strong>

                    <p>
                        {{ __('education_admin.lessons.show.note.description') }}
                    </p>

                </div>

            </div>

        </aside>

    </div>

</div>

@endsection
