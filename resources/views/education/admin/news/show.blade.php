@extends('education.admin.layouts.app')

@section('title', __('education_admin.news_show.page_title'))

@section('content')

<style>
    /* =========================================================
       EDUCATION ADMIN NEWS SHOW
       Cream / Olive Green / Gold
    ========================================================= */

    .education-admin-news-show-page {
        direction: {{ session('education_locale', 'ar') === 'en' ? 'ltr' : 'rtl' }};
        color: #30372a;
        padding-bottom: 60px;
    }

    /* =========================================================
       HEADER
    ========================================================= */

    .education-admin-news-show-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 24px;
        padding: 24px 26px;
        background: linear-gradient(
            135deg,
            #fffaf0 0%,
            #f7f0df 100%
        );
        border: 1px solid rgba(181, 145, 62, 0.22);
        border-radius: 22px;
        box-shadow: 0 12px 35px rgba(48, 55, 42, 0.07);
    }

    .education-admin-news-show-heading {
        display: flex;
        align-items: center;
        gap: 15px;
        min-width: 0;
    }

    .education-admin-news-show-icon {
        width: 54px;
        height: 54px;
        flex: 0 0 54px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 16px;
        background: #596446;
        color: #f7df9b;
        font-size: 21px;
        box-shadow: 0 8px 20px rgba(89, 100, 70, 0.18);
    }

    .education-admin-news-show-heading-label {
        display: block;
        margin-bottom: 5px;
        color: #a37b25;
        font-size: 12px;
        font-weight: 700;
    }

    .education-admin-news-show-heading h1 {
        margin: 0;
        color: #30372a;
        font-size: 25px;
        font-weight: 800;
        line-height: 1.5;
    }

    .education-admin-news-show-heading p {
        margin: 7px 0 0;
        color: #77796f;
        font-size: 13px;
        line-height: 1.7;
    }

    .education-admin-news-show-actions {
        display: flex;
        align-items: center;
        gap: 9px;
        flex-shrink: 0;
    }

    .education-admin-news-show-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        min-height: 43px;
        padding: 10px 16px;
        border-radius: 12px;
        text-decoration: none;
        font-size: 12px;
        font-weight: 800;
        transition: 0.2s ease;
    }

    .education-admin-news-show-action.edit {
        background: #596446;
        border: 1px solid #596446;
        color: #fffdf7;
        box-shadow: 0 7px 17px rgba(89, 100, 70, 0.15);
    }

    .education-admin-news-show-action.edit:hover {
        background: #475235;
        border-color: #475235;
        transform: translateY(-1px);
    }

    .education-admin-news-show-action.back {
        background: #fffdf8;
        border: 1px solid #ded3bc;
        color: #606755;
    }

    .education-admin-news-show-action.back:hover {
        background: #f4eddf;
        color: #4d5542;
    }

    /* =========================================================
       STATUS BAR
    ========================================================= */

    .education-admin-news-show-status-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 22px;
        padding: 16px 20px;
        border-radius: 16px;
        background: #fffdf8;
        border: 1px solid #e6ddcb;
        box-shadow: 0 8px 24px rgba(48, 55, 42, 0.04);
    }

    .education-admin-news-show-status-info {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #62675a;
        font-size: 12px;
        font-weight: 700;
    }

    .education-admin-news-show-status-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: #9b9d92;
        box-shadow: 0 0 0 4px rgba(155, 157, 146, 0.12);
    }

    .education-admin-news-show-status-dot.active {
        background: #718557;
        box-shadow: 0 0 0 4px rgba(113, 133, 87, 0.13);
    }

    .education-admin-news-show-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 11px;
        border-radius: 9px;
        background: #f3efe5;
        color: #73766b;
        font-size: 11px;
        font-weight: 800;
    }

    .education-admin-news-show-status.active {
        background: #e9f0e3;
        color: #597047;
    }

    /* =========================================================
       MAIN GRID
    ========================================================= */

    .education-admin-news-show-grid {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 310px;
        gap: 22px;
        align-items: start;
    }

    /* =========================================================
       CONTENT CARD
    ========================================================= */

    .education-admin-news-show-content-card,
    .education-admin-news-show-info-card {
        background: #fffdf8;
        border: 1px solid rgba(181, 145, 62, 0.17);
        border-radius: 21px;
        box-shadow: 0 10px 30px rgba(48, 55, 42, 0.055);
        overflow: hidden;
    }

    .education-admin-news-show-content-header,
    .education-admin-news-show-info-header {
        padding: 18px 21px;
        background: #faf5e9;
        border-bottom: 1px solid #eee3cd;
    }

    .education-admin-news-show-content-header h2,
    .education-admin-news-show-info-header h2 {
        margin: 0;
        color: #3c4435;
        font-size: 15px;
        font-weight: 800;
    }

    .education-admin-news-show-content-body {
        padding: 27px;
    }

    .education-admin-news-show-type {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        margin-bottom: 15px;
        padding: 7px 11px;
        border-radius: 9px;
        background: #edf1e8;
        color: #596646;
        font-size: 11px;
        font-weight: 800;
    }

    .education-admin-news-show-title {
        margin: 0 0 22px;
        color: #30372a;
        font-size: 26px;
        font-weight: 850;
        line-height: 1.65;
    }

    .education-admin-news-show-divider {
        height: 1px;
        margin-bottom: 22px;
        background: #eee6d8;
    }

    .education-admin-news-show-text {
        color: #565b50;
        font-size: 14px;
        line-height: 2.15;
        white-space: pre-line;
        overflow-wrap: anywhere;
    }

    .education-admin-news-show-link-box {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-top: 28px;
        padding: 15px 17px;
        background: #f8f3e7;
        border: 1px solid #e6dbc5;
        border-radius: 14px;
    }

    .education-admin-news-show-link-icon {
        width: 39px;
        height: 39px;
        flex: 0 0 39px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 11px;
        background: #596446;
        color: #f7df9b;
    }

    .education-admin-news-show-link-content {
        min-width: 0;
        flex: 1;
    }

    .education-admin-news-show-link-label {
        display: block;
        margin-bottom: 4px;
        color: #8e6e32;
        font-size: 10px;
        font-weight: 800;
    }

    .education-admin-news-show-link {
        display: block;
        color: #596446;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        overflow-wrap: anywhere;
    }

    .education-admin-news-show-link:hover {
        color: #3f4a31;
        text-decoration: underline;
    }

    /* =========================================================
       INFO CARD
    ========================================================= */

    .education-admin-news-show-info-body {
        padding: 19px;
    }

    .education-admin-news-show-info-item {
        padding: 13px 0;
        border-bottom: 1px solid #eee7da;
    }

    .education-admin-news-show-info-item:first-child {
        padding-top: 0;
    }

    .education-admin-news-show-info-item:last-child {
        padding-bottom: 0;
        border-bottom: 0;
    }

    .education-admin-news-show-info-label {
        display: flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 6px;
        color: #96978e;
        font-size: 10px;
        font-weight: 700;
    }

    .education-admin-news-show-info-label i {
        color: #b5913e;
    }

    .education-admin-news-show-info-value {
        color: #4b5143;
        font-size: 12px;
        font-weight: 800;
        line-height: 1.7;
        overflow-wrap: anywhere;
    }

    .education-admin-news-show-info-value.muted {
        color: #96978e;
        font-weight: 600;
    }

    /* =========================================================
       TYPE BADGES
    ========================================================= */

    .education-admin-news-show-type-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 9px;
        border-radius: 8px;
        background: #f3efe5;
        color: #6c6f63;
        font-size: 10px;
        font-weight: 800;
    }

    .education-admin-news-show-type-badge.lesson {
        background: #eaf0e5;
        color: #597047;
    }

    .education-admin-news-show-type-badge.announcement {
        background: #f7efdc;
        color: #96752f;
    }

    .education-admin-news-show-type-badge.update {
        background: #e9eef2;
        color: #5c7180;
    }

    .education-admin-news-show-type-badge.notice {
        background: #f8e9e2;
        color: #9a604f;
    }

    /* =========================================================
       DATES
    ========================================================= */

    .education-admin-news-show-date {
        direction: ltr;
        text-align: right;
        font-family: inherit;
    }

    /* =========================================================
       PREVIEW
    ========================================================= */

    .education-admin-news-show-preview {
        margin-top: 22px;
        background: #fffdf8;
        border: 1px solid rgba(181, 145, 62, 0.17);
        border-radius: 21px;
        box-shadow: 0 10px 30px rgba(48, 55, 42, 0.055);
        overflow: hidden;
    }

    .education-admin-news-show-preview-header {
        padding: 18px 21px;
        background: #faf5e9;
        border-bottom: 1px solid #eee3cd;
    }

    .education-admin-news-show-preview-header h2 {
        margin: 0;
        color: #3c4435;
        font-size: 15px;
        font-weight: 800;
    }

    .education-admin-news-show-preview-header p {
        margin: 5px 0 0;
        color: #8b8d83;
        font-size: 11px;
    }

    .education-admin-news-show-ticker-preview {
        position: relative;
        margin: 20px;
        overflow: hidden;
        border-radius: 13px;
        background: #596446;
        color: #fffdf7;
        box-shadow: 0 8px 20px rgba(89, 100, 70, 0.15);
    }

    .education-admin-news-show-ticker-label {
        position: relative;
        z-index: 2;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        min-height: 48px;
        padding: 0 17px;
        background: #4b563a;
        color: #f7df9b;
        font-size: 11px;
        font-weight: 800;
        box-shadow: 5px 0 13px rgba(0, 0, 0, 0.08);
    }

    .education-admin-news-show-ticker-text {
        display: inline-flex;
        align-items: center;
        min-height: 48px;
        padding: 0 18px;
        color: #fffdf7;
        font-size: 12px;
        font-weight: 700;
    }

    /* =========================================================
       BOTTOM ACTIONS
    ========================================================= */

    .education-admin-news-show-bottom-actions {
        display: flex;
        justify-content: flex-start;
        gap: 10px;
        margin-top: 22px;
    }

    .education-admin-news-show-bottom-edit,
    .education-admin-news-show-bottom-delete {
        min-height: 42px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 9px 15px;
        border-radius: 11px;
        font-family: inherit;
        font-size: 11px;
        font-weight: 800;
        cursor: pointer;
        text-decoration: none;
        transition: 0.2s ease;
    }

    .education-admin-news-show-bottom-edit {
        background: #596446;
        border: 1px solid #596446;
        color: #fffdf7;
    }

    .education-admin-news-show-bottom-edit:hover {
        background: #475235;
    }

    .education-admin-news-show-bottom-delete {
        background: #f7e7e2;
        border: 1px solid #dfc3b9;
        color: #8f594b;
    }

    .education-admin-news-show-bottom-delete:hover {
        background: #efd9d2;
        color: #77483d;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 900px) {

        .education-admin-news-show-grid {
            grid-template-columns: 1fr;
        }

    }

    @media (max-width: 700px) {

        .education-admin-news-show-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .education-admin-news-show-actions {
            width: 100%;
        }

        .education-admin-news-show-action {
            flex: 1;
        }

        .education-admin-news-show-status-bar {
            align-items: flex-start;
            flex-direction: column;
        }

        .education-admin-news-show-title {
            font-size: 22px;
        }

    }

    @media (max-width: 500px) {

        .education-admin-news-show-header {
            padding: 20px;
            border-radius: 18px;
        }

        .education-admin-news-show-heading h1 {
            font-size: 21px;
        }

        .education-admin-news-show-actions {
            flex-direction: column;
        }

        .education-admin-news-show-action {
            width: 100%;
            flex: none;
        }

        .education-admin-news-show-content-body {
            padding: 21px 18px;
        }

        .education-admin-news-show-title {
            font-size: 20px;
        }

        .education-admin-news-show-ticker-label,
        .education-admin-news-show-ticker-text {
            min-height: 44px;
        }

    }
</style>

<div class="education-admin-news-show-page">

{{-- =====================================================
    PAGE HEADER
====================================================== --}}

<div class="education-admin-news-show-header">

    <div class="education-admin-news-show-heading">

        <div class="education-admin-news-show-icon">
            <i class="fa-solid fa-newspaper"></i>
        </div>

        <div>

            <span class="education-admin-news-show-heading-label">
                {{ __('education_admin.news_show.header_label') }}
            </span>

            <h1>
                {{ __('education_admin.news_show.title') }}
            </h1>

            <p>
                {{ __('education_admin.news_show.description') }}
            </p>

        </div>

    </div>


    <div class="education-admin-news-show-actions">

        <a
            href="{{ route('education.admin.news.edit', $news) }}"
            class="education-admin-news-show-action edit"
        >
            <i class="fa-solid fa-pen"></i>
            {{ __('education_admin.news_show.actions.edit') }}
        </a>

        <a
            href="{{ route('education.admin.news.index') }}"
            class="education-admin-news-show-action back"
        >
            <i class="fa-solid fa-arrow-right"></i>
            {{ __('education_admin.news_show.actions.back') }}
        </a>

    </div>

</div>


{{-- =====================================================
    STATUS
====================================================== --}}

<div class="education-admin-news-show-status-bar">

    <div class="education-admin-news-show-status-info">

        <span
            class="education-admin-news-show-status-dot
            {{ $news->is_active ? 'active' : '' }}"
        ></span>

        <span>
            {{ __('education_admin.news_show.status.label') }}
        </span>

        <span
            class="education-admin-news-show-status
            {{ $news->is_active ? 'active' : '' }}"
        >

            @if($news->is_active)

                <i class="fa-solid fa-circle-check"></i>
                {{ __('education_admin.news_show.status.active') }}

            @else

                <i class="fa-solid fa-circle-pause"></i>
                {{ __('education_admin.news_show.status.inactive') }}

            @endif

        </span>

    </div>


    <div>

        <span class="education-admin-news-show-status">

            <i class="fa-solid fa-arrow-down-1-9"></i>

            {{ __('education_admin.news_show.order') }}:
            {{ $news->sort_order ?? 0 }}

        </span>

    </div>

</div>


{{-- =====================================================
    MAIN CONTENT
====================================================== --}}

<div class="education-admin-news-show-grid">

    {{-- =================================================
        NEWS CONTENT
    ================================================== --}}

    <div class="education-admin-news-show-content-card">

        <div class="education-admin-news-show-content-header">

            <h2>
                {{ __('education_admin.news_show.content.title') }}
            </h2>

        </div>


        <div class="education-admin-news-show-content-body">

            @php
                $typeLabel = __('education_admin.news_show.types.' . $news->type);

                if ($typeLabel === 'education_admin.news_show.types.' . $news->type) {
                    $typeLabel = __('education_admin.news_show.types.general');
                }
            @endphp


            <div class="education-admin-news-show-type">

                @switch($news->type)

                    @case('lesson')
                        <i class="fa-solid fa-book-open"></i>
                        @break

                    @case('announcement')
                        <i class="fa-solid fa-bullhorn"></i>
                        @break

                    @case('update')
                        <i class="fa-solid fa-arrows-rotate"></i>
                        @break

                    @case('notice')
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        @break

                    @default
                        <i class="fa-solid fa-newspaper"></i>

                @endswitch

                {{ $typeLabel }}

            </div>


            <h2 class="education-admin-news-show-title">
                {{ $news->title }}
            </h2>


            <div class="education-admin-news-show-divider"></div>


            <div class="education-admin-news-show-text">
                {{ $news->content }}
            </div>


            @if($news->link)

                <div class="education-admin-news-show-link-box">

                    <div class="education-admin-news-show-link-icon">
                        <i class="fa-solid fa-link"></i>
                    </div>

                    <div class="education-admin-news-show-link-content">

                        <span class="education-admin-news-show-link-label">
                            {{ __('education_admin.news_show.link.label') }}
                        </span>

                        <a
                            href="{{ $news->link }}"
                            target="{{ ($news->open_in_new_tab ?? true) ? '_blank' : '_self' }}"
                            rel="noopener noreferrer"
                            class="education-admin-news-show-link"
                        >
                            {{ $news->link }}
                        </a>

                    </div>

                </div>

            @endif

        </div>

    </div>


    {{-- =================================================
        NEWS INFORMATION
    ================================================== --}}

    <div class="education-admin-news-show-info-card">

        <div class="education-admin-news-show-info-header">

            <h2>
                {{ __('education_admin.news_show.info.title') }}
            </h2>

        </div>


        <div class="education-admin-news-show-info-body">

            {{-- TYPE --}}

            <div class="education-admin-news-show-info-item">

                <div class="education-admin-news-show-info-label">

                    <i class="fa-solid fa-tag"></i>

                    {{ __('education_admin.news_show.info.type') }}

                </div>

                <div class="education-admin-news-show-info-value">

                    <span
                        class="education-admin-news-show-type-badge
                        {{ $news->type }}"
                    >

                        @switch($news->type)

                            @case('lesson')
                                <i class="fa-solid fa-book-open"></i>
                                @break

                            @case('announcement')
                                <i class="fa-solid fa-bullhorn"></i>
                                @break

                            @case('update')
                                <i class="fa-solid fa-arrows-rotate"></i>
                                @break

                            @case('notice')
                                <i class="fa-solid fa-triangle-exclamation"></i>
                                @break

                            @default
                                <i class="fa-solid fa-newspaper"></i>

                        @endswitch

                        {{ $typeLabel }}

                    </span>

                </div>

            </div>


            {{-- SORT ORDER --}}

            <div class="education-admin-news-show-info-item">

                <div class="education-admin-news-show-info-label">

                    <i class="fa-solid fa-arrow-down-1-9"></i>

                    {{ __('education_admin.news_show.info.sort_order') }}

                </div>

                <div class="education-admin-news-show-info-value">

                    {{ $news->sort_order ?? 0 }}

                </div>

            </div>


            {{-- START DATE --}}

            <div class="education-admin-news-show-info-item">

                <div class="education-admin-news-show-info-label">

                    <i class="fa-regular fa-calendar-check"></i>

                    {{ __('education_admin.news_show.info.starts_at') }}

                </div>

                <div class="education-admin-news-show-info-value">

                    @if($news->starts_at)

                        <span class="education-admin-news-show-date">
                            {{ $news->starts_at->format('Y-m-d H:i') }}
                        </span>

                    @else

                        <span class="education-admin-news-show-info-value muted">
                            {{ __('education_admin.news_show.info.starts_immediately') }}
                        </span>

                    @endif

                </div>

            </div>


            {{-- END DATE --}}

            <div class="education-admin-news-show-info-item">

                <div class="education-admin-news-show-info-label">

                    <i class="fa-regular fa-calendar-xmark"></i>

                    {{ __('education_admin.news_show.info.ends_at') }}

                </div>

                <div class="education-admin-news-show-info-value">

                    @if($news->ends_at)

                        <span class="education-admin-news-show-date">
                            {{ $news->ends_at->format('Y-m-d H:i') }}
                        </span>

                    @else

                        <span class="education-admin-news-show-info-value muted">
                            {{ __('education_admin.news_show.info.no_end_date') }}
                        </span>

                    @endif

                </div>

            </div>


            {{-- CREATED AT --}}

            <div class="education-admin-news-show-info-item">

                <div class="education-admin-news-show-info-label">

                    <i class="fa-regular fa-clock"></i>

                    {{ __('education_admin.news_show.info.created_at') }}

                </div>

                <div class="education-admin-news-show-info-value">

                    @if($news->created_at)
                        {{ $news->created_at->format('Y-m-d H:i') }}
                    @else
                        —
                    @endif

                </div>

            </div>


            {{-- UPDATED AT --}}

            <div class="education-admin-news-show-info-item">

                <div class="education-admin-news-show-info-label">

                    <i class="fa-solid fa-clock-rotate-left"></i>

                    {{ __('education_admin.news_show.info.updated_at') }}

                </div>

                <div class="education-admin-news-show-info-value">

                    @if($news->updated_at)
                        {{ $news->updated_at->format('Y-m-d H:i') }}
                    @else
                        —
                    @endif

                </div>

            </div>


            {{-- NEW TAB --}}

            <div class="education-admin-news-show-info-item">

                <div class="education-admin-news-show-info-label">

                    <i class="fa-solid fa-up-right-from-square"></i>

                    {{ __('education_admin.news_show.info.open_link') }}

                </div>

                <div class="education-admin-news-show-info-value">

                    @if($news->open_in_new_tab ?? true)

                        <span class="education-admin-news-show-type-badge lesson">
                            <i class="fa-solid fa-check"></i>
                            {{ __('education_admin.news_show.info.new_window') }}
                        </span>

                    @else

                        <span class="education-admin-news-show-type-badge">
                            {{ __('education_admin.news_show.info.same_page') }}
                        </span>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =====================================================
    TICKER PREVIEW
====================================================== --}}

<div class="education-admin-news-show-preview">

    <div class="education-admin-news-show-preview-header">

        <h2>
            {{ __('education_admin.news_show.preview.title') }}
        </h2>

        <p>
            {{ __('education_admin.news_show.preview.description') }}
        </p>

    </div>


    <div class="education-admin-news-show-ticker-preview">

        <span class="education-admin-news-show-ticker-label">

            <i class="fa-solid fa-bullhorn"></i>

            {{ __('education_admin.news_show.preview.latest_news') }}

        </span>


        <span class="education-admin-news-show-ticker-text">

            {{ $news->title }}

        </span>

    </div>

</div>


{{-- =====================================================
    BOTTOM ACTIONS
====================================================== --}}

<div class="education-admin-news-show-bottom-actions">

    <a
        href="{{ route('education.admin.news.edit', $news) }}"
        class="education-admin-news-show-bottom-edit"
    >
        <i class="fa-solid fa-pen"></i>
        {{ __('education_admin.news_show.actions.edit_news') }}
    </a>


    <form
        action="{{ route('education.admin.news.destroy', $news) }}"
        method="POST"
        onsubmit="return confirm(@json(__('education_admin.news_show.actions.confirm_delete')));"
    >

        @csrf
        @method('DELETE')

        <button
            type="submit"
            class="education-admin-news-show-bottom-delete"
        >
            <i class="fa-solid fa-trash"></i>
            {{ __('education_admin.news_show.actions.delete_news') }}
        </button>

    </form>

</div>

</div>

@endsection
