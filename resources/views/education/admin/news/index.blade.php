@extends('education.admin.layouts.app')

@section('title', __('education_admin.news.page_title'))

@section('content')

<style>
    /* =========================================================
       EDUCATION ADMIN NEWS
       Cream / Olive Green / Gold
    ========================================================= */

    .education-admin-news-page {
        direction: {{ session('education_locale', 'ar') === 'en' ? 'ltr' : 'rtl' }};
        color: #30372a;
        padding-bottom: 50px;
    }

    /* =========================================================
       HEADER
    ========================================================= */

    .education-admin-news-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 28px;
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

    .education-admin-news-heading {
        display: flex;
        align-items: center;
        gap: 15px;
        min-width: 0;
    }

    .education-admin-news-heading-icon {
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

    .education-admin-news-heading-text {
        min-width: 0;
    }

    .education-admin-news-heading-label {
        display: block;
        margin-bottom: 5px;
        color: #a37b25;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.4px;
    }

    .education-admin-news-heading h1 {
        margin: 0;
        color: #30372a;
        font-size: 25px;
        font-weight: 800;
    }

    .education-admin-news-heading p {
        margin: 7px 0 0;
        color: #77796f;
        font-size: 13px;
        line-height: 1.7;
    }

    .education-admin-news-create-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        flex-shrink: 0;
        padding: 13px 20px;
        border-radius: 13px;
        background: #596446;
        color: #fffdf7;
        text-decoration: none;
        font-size: 14px;
        font-weight: 700;
        box-shadow: 0 8px 18px rgba(89, 100, 70, 0.18);
        transition: 0.25s ease;
    }

    .education-admin-news-create-btn:hover {
        background: #475235;
        color: #fffdf7;
        transform: translateY(-2px);
    }

    /* =========================================================
       SUCCESS MESSAGE
    ========================================================= */

    .education-admin-news-alert {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 22px;
        padding: 14px 17px;
        border-radius: 14px;
        background: #edf4e9;
        border: 1px solid #c9d9bf;
        color: #435536;
        font-size: 13px;
        font-weight: 600;
    }

    .education-admin-news-alert i {
        color: #657b4e;
        font-size: 16px;
    }

    /* =========================================================
       EMPTY STATE
    ========================================================= */

    .education-admin-news-empty {
        padding: 60px 25px;
        text-align: center;
        background: #fffdf8;
        border: 1px solid rgba(181, 145, 62, 0.18);
        border-radius: 22px;
        box-shadow: 0 10px 30px rgba(48, 55, 42, 0.05);
    }

    .education-admin-news-empty-icon {
        width: 76px;
        height: 76px;
        margin: 0 auto 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #f5edda;
        color: #a37b25;
        font-size: 27px;
    }

    .education-admin-news-empty h3 {
        margin: 0 0 8px;
        color: #30372a;
        font-size: 20px;
        font-weight: 800;
    }

    .education-admin-news-empty p {
        max-width: 520px;
        margin: 0 auto 23px;
        color: #7a7b73;
        font-size: 13px;
        line-height: 1.8;
    }

    /* =========================================================
       NEWS LIST
    ========================================================= */

    .education-admin-news-list {
        display: grid;
        gap: 16px;
    }

    .education-admin-news-card {
        position: relative;
        overflow: hidden;
        background: #fffdf8;
        border: 1px solid rgba(181, 145, 62, 0.18);
        border-radius: 20px;
        box-shadow: 0 9px 28px rgba(48, 55, 42, 0.055);
        transition: 0.25s ease;
    }

    .education-admin-news-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 14px 34px rgba(48, 55, 42, 0.09);
    }

    .education-admin-news-card::before {
        content: "";
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        width: 4px;
        background: #b5913e;
    }

    .education-admin-news-card-inner {
        display: grid;
        grid-template-columns: 1fr auto;
        gap: 25px;
        padding: 22px 24px 22px 22px;
    }

    /* =========================================================
       NEWS CONTENT
    ========================================================= */

    .education-admin-news-main {
        min-width: 0;
    }

    .education-admin-news-top {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 9px;
        margin-bottom: 11px;
    }

    .education-admin-news-order {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 32px;
        height: 28px;
        padding: 0 9px;
        border-radius: 9px;
        background: #f4ecda;
        color: #8d6a22;
        font-size: 11px;
        font-weight: 800;
    }

    .education-admin-news-type {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 10px;
        border-radius: 9px;
        background: #edf1e8;
        color: #566244;
        font-size: 11px;
        font-weight: 700;
    }

    .education-admin-news-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 10px;
        border-radius: 9px;
        font-size: 11px;
        font-weight: 700;
    }

    .education-admin-news-status.active {
        background: #e9f3e4;
        color: #527044;
    }

    .education-admin-news-status.inactive {
        background: #f3ece8;
        color: #8b6758;
    }

    .education-admin-news-title {
        margin: 0 0 7px;
        color: #30372a;
        font-size: 18px;
        font-weight: 800;
        line-height: 1.55;
    }

    .education-admin-news-content {
        max-width: 850px;
        margin: 0 0 15px;
        color: #77796f;
        font-size: 13px;
        line-height: 1.8;
    }

    /* =========================================================
       META
    ========================================================= */

    .education-admin-news-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 9px 18px;
        color: #85867d;
        font-size: 11px;
    }

    .education-admin-news-meta-item {
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .education-admin-news-meta-item i {
        color: #b5913e;
    }

    /* =========================================================
       ACTIONS
    ========================================================= */

    .education-admin-news-actions {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        flex-direction: column;
        gap: 8px;
        min-width: 115px;
    }

    .education-admin-news-action {
        width: 115px;
        min-height: 38px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        padding: 8px 12px;
        border-radius: 10px;
        border: 1px solid transparent;
        font-size: 11px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
        transition: 0.2s ease;
        box-sizing: border-box;
    }

    .education-admin-news-action-view {
        background: #f5f0e5;
        border-color: #e6d9bd;
        color: #806329;
    }

    .education-admin-news-action-view:hover {
        background: #eee5d2;
        color: #6d541f;
    }

    .education-admin-news-action-edit {
        background: #edf1e8;
        border-color: #d6dfcf;
        color: #556244;
    }

    .education-admin-news-action-edit:hover {
        background: #e2e9dc;
        color: #465336;
    }

    .education-admin-news-action-toggle {
        background: #eef3e9;
        border-color: #d4dfcc;
        color: #557046;
    }

    .education-admin-news-action-toggle:hover {
        background: #e3ebdd;
        color: #465e3a;
    }

    .education-admin-news-action-delete {
        background: #f7ece8;
        border-color: #ead5cd;
        color: #946254;
    }

    .education-admin-news-action-delete:hover {
        background: #f1dfd9;
        color: #7d5044;
    }

    .education-admin-news-delete-form {
        width: 115px;
        margin: 0;
    }

    /* =========================================================
       PAGINATION
    ========================================================= */

    .education-admin-news-pagination {
        margin-top: 25px;
    }

    .education-admin-news-pagination nav {
        display: flex;
        justify-content: center;
    }

    .education-admin-news-pagination svg {
        width: 17px;
        height: 17px;
    }

    .education-admin-news-pagination .hidden {
        display: none;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 800px) {

        .education-admin-news-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .education-admin-news-create-btn {
            width: 100%;
        }

        .education-admin-news-card-inner {
            grid-template-columns: 1fr;
        }

        .education-admin-news-actions {
            width: 100%;
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            flex-direction: row;
        }

        .education-admin-news-action,
        .education-admin-news-delete-form {
            width: 100%;
        }

        .education-admin-news-delete-form {
            display: block;
        }
    }

    @media (max-width: 520px) {

        .education-admin-news-header {
            padding: 20px;
            border-radius: 18px;
        }

        .education-admin-news-heading-icon {
            width: 47px;
            height: 47px;
            flex-basis: 47px;
        }

        .education-admin-news-heading h1 {
            font-size: 21px;
        }

        .education-admin-news-card-inner {
            padding: 19px;
        }

        .education-admin-news-title {
            font-size: 16px;
        }

        .education-admin-news-actions {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="education-admin-news-page">

{{-- =====================================================
    PAGE HEADER
====================================================== --}}

<div class="education-admin-news-header">

    <div class="education-admin-news-heading">

        <div class="education-admin-news-heading-icon">
            <i class="fa-solid fa-newspaper"></i>
        </div>

        <div class="education-admin-news-heading-text">

            <span class="education-admin-news-heading-label">
                {{ __('education_admin.news.header_label') }}
            </span>

            <h1>
                {{ __('education_admin.news.title') }}
            </h1>

            <p>
                {{ __('education_admin.news.description') }}
            </p>

        </div>

    </div>

    <a
        href="{{ route('education.admin.news.create') }}"
        class="education-admin-news-create-btn"
    >
        <i class="fa-solid fa-plus"></i>
        {{ __('education_admin.news.add_new') }}
    </a>

</div>


{{-- =====================================================
    SUCCESS MESSAGE
====================================================== --}}

@if(session('success'))

    <div class="education-admin-news-alert">

        <i class="fa-solid fa-circle-check"></i>

        <span>
            {{ session('success') }}
        </span>

    </div>

@endif


{{-- =====================================================
    VALIDATION ERRORS
====================================================== --}}

@if($errors->any())

    <div
        class="education-admin-news-alert"
        style="
            background:#f8ece8;
            border-color:#e8d0c8;
            color:#8a5b4d;
        "
    >

        <i class="fa-solid fa-circle-exclamation"></i>

        <span>
            {{ __('education_admin.news.alerts.validation_title') }}
        </span>

    </div>

@endif


{{-- =====================================================
    NEWS
====================================================== --}}

@if($news->count())

    <div class="education-admin-news-list">

        @foreach($news as $item)

            <article class="education-admin-news-card">

                <div class="education-admin-news-card-inner">

                    {{-- =================================================
                        MAIN CONTENT
                    ================================================== --}}

                    <div class="education-admin-news-main">

                        <div class="education-admin-news-top">

                            <span class="education-admin-news-order">
                                #{{ $item->sort_order }}
                            </span>

                            <span class="education-admin-news-type">

                                @if($item->type === 'lesson')
                                    <i class="fa-solid fa-book-open"></i>
                                @elseif($item->type === 'announcement')
                                    <i class="fa-solid fa-bullhorn"></i>
                                @elseif($item->type === 'update')
                                    <i class="fa-solid fa-arrows-rotate"></i>
                                @elseif($item->type === 'notice')
                                    <i class="fa-solid fa-triangle-exclamation"></i>
                                @else
                                    <i class="fa-solid fa-circle-info"></i>
                                @endif

                                {{ __('education_admin.news.types.' . $item->type) }}

                            </span>

                            @if($item->is_active)

                                <span class="education-admin-news-status active">
                                    <i class="fa-solid fa-circle"></i>
                                    {{ __('education_admin.news.status.active') }}
                                </span>

                            @else

                                <span class="education-admin-news-status inactive">
                                    <i class="fa-solid fa-circle"></i>
                                    {{ __('education_admin.news.status.inactive') }}
                                </span>

                            @endif

                        </div>


                        <h2 class="education-admin-news-title">
                            {{ $item->title }}
                        </h2>


                        @if($item->content)

                            <p class="education-admin-news-content">
                                {{ \Illuminate\Support\Str::limit($item->content, 220) }}
                            </p>

                        @endif


                        <div class="education-admin-news-meta">

                            <span class="education-admin-news-meta-item">

                                <i class="fa-regular fa-calendar"></i>

                                {{ __('education_admin.news.meta.added_at') }}
                                {{ $item->created_at?->format('Y-m-d') }}

                            </span>


                            @if($item->starts_at)

                                <span class="education-admin-news-meta-item">

                                    <i class="fa-regular fa-clock"></i>

                                    {{ __('education_admin.news.meta.starts_at') }}
                                    {{ $item->starts_at->format('Y-m-d H:i') }}

                                </span>

                            @endif


                            @if($item->ends_at)

                                <span class="education-admin-news-meta-item">

                                    <i class="fa-regular fa-calendar-xmark"></i>

                                    {{ __('education_admin.news.meta.ends_at') }}
                                    {{ $item->ends_at->format('Y-m-d H:i') }}

                                </span>

                            @endif


                            @if($item->link)

                                <span class="education-admin-news-meta-item">

                                    <i class="fa-solid fa-link"></i>

                                    {{ __('education_admin.news.meta.has_link') }}

                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- =================================================
                        ACTIONS
                    ================================================== --}}

                    <div class="education-admin-news-actions">

                        <a
                            href="{{ route('education.admin.news.show', $item) }}"
                            class="education-admin-news-action education-admin-news-action-view"
                        >
                            <i class="fa-solid fa-eye"></i>
                            {{ __('education_admin.news.actions.view') }}
                        </a>


                        <a
                            href="{{ route('education.admin.news.edit', $item) }}"
                            class="education-admin-news-action education-admin-news-action-edit"
                        >
                            <i class="fa-solid fa-pen"></i>
                            {{ __('education_admin.news.actions.edit') }}
                        </a>


                        <form
                            method="POST"
                            action="{{ route('education.admin.news.toggle', $item) }}"
                            class="education-admin-news-delete-form"
                        >

                            @csrf

                            <button
                                type="submit"
                                class="education-admin-news-action education-admin-news-action-toggle"
                            >

                                @if($item->is_active)

                                    <i class="fa-solid fa-eye-slash"></i>
                                    {{ __('education_admin.news.actions.disable') }}

                                @else

                                    <i class="fa-solid fa-eye"></i>
                                    {{ __('education_admin.news.actions.activate') }}

                                @endif

                            </button>

                        </form>


                        <form
                            method="POST"
                            action="{{ route('education.admin.news.destroy', $item) }}"
                            class="education-admin-news-delete-form"
                            onsubmit="return confirm(@json(__('education_admin.news.actions.confirm_delete')));"
                        >

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="education-admin-news-action education-admin-news-action-delete"
                            >
                                <i class="fa-solid fa-trash"></i>
                                {{ __('education_admin.news.actions.delete') }}
                            </button>

                        </form>

                    </div>

                </div>

            </article>

        @endforeach

    </div>


    {{-- =====================================================
        PAGINATION
    ====================================================== --}}

    @if($news->hasPages())

        <div class="education-admin-news-pagination">

            {{ $news->links() }}

        </div>

    @endif


@else

    {{-- =====================================================
        EMPTY STATE
    ====================================================== --}}

    <div class="education-admin-news-empty">

        <div class="education-admin-news-empty-icon">
            <i class="fa-regular fa-newspaper"></i>
        </div>

        <h3>
            {{ __('education_admin.news.empty.title') }}
        </h3>

        <p>
            {{ __('education_admin.news.empty.description') }}
        </p>

        <a
            href="{{ route('education.admin.news.create') }}"
            class="education-admin-news-create-btn"
        >
            <i class="fa-solid fa-plus"></i>
            {{ __('education_admin.news.empty.add_first') }}
        </a>

    </div>

@endif


</div>

@endsection
