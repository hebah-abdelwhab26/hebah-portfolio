
@extends('education.layouts.app')

@section('title', __('education.comments.page_title'))

@section('content')

<style>
    /* =========================================================
       EDUCATION PUBLIC COMMENTS
       Cream / Olive Green / Gold
    ========================================================= */

    .education-comments-page {
        direction: {{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }};
        color: #30372a;
        padding: 40px 20px 70px;
    }

    .education-comments-container {
        width: 100%;
        max-width: 1100px;
        margin: 0 auto;
    }

    /* =========================================================
       HEADER
    ========================================================= */

    .education-comments-header {
        text-align: center;
        margin-bottom: 35px;
    }

    .education-comments-header-icon {
        width: 64px;
        height: 64px;
        margin: 0 auto 15px;
        border-radius: 50%;
        background: #eee8d8;
        color: #7b8650;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 25px;
    }

    .education-comments-header h1 {
        margin: 0 0 10px;
        color: #30372a;
        font-size: 30px;
        font-weight: 800;
    }

    .education-comments-header p {
        margin: 0;
        color: #777b6d;
        font-size: 15px;
    }

    /* =========================================================
       ALERT
    ========================================================= */

    .education-comments-alert {
        margin-bottom: 25px;
        padding: 15px 18px;
        border-radius: 14px;
        background: #edf2e5;
        border: 1px solid #d6dfc4;
        color: #526038;
        font-size: 14px;
    }

    /* =========================================================
       GRID
    ========================================================= */

    .education-comments-grid {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 360px;
        gap: 25px;
        align-items: start;
    }

    /* =========================================================
       COMMENTS
    ========================================================= */

    .education-comments-list-card,
    .education-comments-form-card {
        background: #fffdf8;
        border: 1px solid #e7e1d2;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(48, 55, 42, 0.06);
    }

    .education-comments-list-card {
        padding: 25px;
    }

    .education-comments-form-card {
        padding: 25px;
        position: sticky;
        top: 25px;
    }

    .education-comments-card-title {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
    }

    .education-comments-card-title i {
        color: #a88a3d;
    }

    .education-comments-card-title h2 {
        margin: 0;
        font-size: 20px;
        font-weight: 800;
        color: #30372a;
    }

    /* =========================================================
       COMMENT ITEM
    ========================================================= */

    .education-comment-item {
        padding: 20px 0;
        border-bottom: 1px solid #ece7da;
    }

    .education-comment-item:first-child {
        padding-top: 0;
    }

    .education-comment-item:last-child {
        border-bottom: 0;
        padding-bottom: 0;
    }

    .education-comment-author {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 12px;
    }

    .education-comment-avatar {
        width: 44px;
        height: 44px;
        flex: 0 0 44px;
        border-radius: 50%;
        background: #e8eadc;
        color: #65713f;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 18px;
    }

    .education-comment-author-name {
        font-weight: 800;
        color: #30372a;
    }

    .education-comment-date {
        margin-top: 3px;
        color: #96998f;
        font-size: 12px;
    }

    .education-comment-text {
        margin: 0;
        color: #5e6258;
        font-size: 14px;
        line-height: 1.9;
        white-space: pre-line;
    }

    /* =========================================================
       EMPTY
    ========================================================= */

    .education-comments-empty {
        padding: 45px 20px;
        text-align: center;
        color: #8b8e84;
    }

    .education-comments-empty i {
        font-size: 40px;
        margin-bottom: 12px;
        color: #b5aa8c;
    }

    .education-comments-empty p {
        margin: 0;
        font-size: 14px;
    }

    /* =========================================================
       FORM
    ========================================================= */

    .education-comments-form-group {
        margin-bottom: 16px;
    }

    .education-comments-form-group label {
        display: block;
        margin-bottom: 7px;
        color: #444a3c;
        font-size: 13px;
        font-weight: 700;
    }

    .education-comments-form-group label span {
        color: #a88a3d;
    }

    .education-comments-input,
    .education-comments-textarea {
        width: 100%;
        border: 1px solid #ddd7c8;
        border-radius: 12px;
        background: #fff;
        color: #30372a;
        padding: 12px 13px;
        font-family: inherit;
        font-size: 14px;
        outline: none;
        transition: .2s ease;
        box-sizing: border-box;
    }

    .education-comments-input:focus,
    .education-comments-textarea:focus {
        border-color: #a88a3d;
        box-shadow: 0 0 0 3px rgba(168, 138, 61, 0.10);
    }

    .education-comments-textarea {
        min-height: 145px;
        resize: vertical;
        line-height: 1.8;
    }

    .education-comments-submit {
        width: 100%;
        border: 0;
        border-radius: 12px;
        padding: 13px 18px;
        background: #6f7b48;
        color: #fff;
        font-family: inherit;
        font-size: 14px;
        font-weight: 800;
        cursor: pointer;
        transition: .2s ease;
    }

    .education-comments-submit:hover {
        background: #5d683b;
        transform: translateY(-1px);
    }

    .education-comments-note {
        margin: 12px 0 0;
        color: #8b8e84;
        font-size: 12px;
        line-height: 1.7;
    }

    /* =========================================================
       ERRORS
    ========================================================= */

    .education-comments-errors {
        margin-bottom: 18px;
        padding: 13px 15px;
        border-radius: 12px;
        background: #fbefed;
        border: 1px solid #ecd0cb;
        color: #9b4f43;
        font-size: 13px;
    }

    .education-comments-errors ul {
        margin: 0;
        padding-right: 18px;
    }

    /* =========================================================
       PAGINATION
    ========================================================= */

    .education-comments-pagination {
        margin-top: 25px;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 850px) {

        .education-comments-grid {
            grid-template-columns: 1fr;
        }

        .education-comments-form-card {
            position: static;
        }
    }

    @media (max-width: 600px) {

        .education-comments-page {
            padding: 30px 14px 50px;
        }

        .education-comments-header h1 {
            font-size: 25px;
        }

        .education-comments-list-card,
        .education-comments-form-card {
            padding: 20px;
            border-radius: 16px;
        }
    }
</style>

<div class="education-comments-page">

    <div class="education-comments-container">

        {{-- =====================================================
            HEADER
        ====================================================== --}}

        <div class="education-comments-header">

            <div class="education-comments-header-icon">
                <i class="fa-regular fa-comments"></i>
            </div>

            <h1>
                {{ __('education.comments.page_title') }}
            </h1>

            <p>
                {{ __('education.comments.page_description') }}
            </p>

        </div>


        {{-- =====================================================
            SUCCESS
        ====================================================== --}}

        @if(session('success'))

            <div class="education-comments-alert">
                <i class="fa-solid fa-circle-check"></i>

                {{ session('success') }}
            </div>

        @endif


        {{-- =====================================================
            GRID
        ====================================================== --}}

        <div class="education-comments-grid">

            {{-- =================================================
                COMMENTS LIST
            ================================================== --}}

            <div class="education-comments-list-card">

                <div class="education-comments-card-title">

                    <i class="fa-regular fa-message"></i>

                    <h2>
                        {{ __('education.comments.list_title') }}
                    </h2>

                </div>


                @forelse($comments as $comment)

                    <div class="education-comment-item">

                        <div class="education-comment-author">

                            <div class="education-comment-avatar">

                                {{ mb_substr($comment->name, 0, 1) }}

                            </div>

                            <div>

                                <div class="education-comment-author-name">

                                    {{ $comment->name }}

                                </div>

                                <div class="education-comment-date">

                                    {{ $comment->created_at?->translatedFormat('d F Y') }}

                                </div>

                            </div>

                        </div>


                        <p class="education-comment-text">

                            {{ $comment->comment }}

                        </p>

                    </div>

                @empty

                    <div class="education-comments-empty">

                        <i class="fa-regular fa-comments"></i>

                        <p>
                            {{ __('education.comments.empty.message') }}
                        </p>

                    </div>

                @endforelse


                @if($comments->hasPages())

                    <div class="education-comments-pagination">

                        {{ $comments->links() }}

                    </div>

                @endif

            </div>


            {{-- =================================================
                FORM
            ================================================== --}}

            <div class="education-comments-form-card">

                <div class="education-comments-card-title">

                    <i class="fa-solid fa-pen"></i>

                    <h2>
                        {{ __('education.comments.form.title') }}
                    </h2>

                </div>


                @if($errors->any())

                    <div class="education-comments-errors">

                        <ul>

                            @foreach($errors->all() as $error)

                                <li>
                                    {{ $error }}
                                </li>

                            @endforeach

                        </ul>

                    </div>

                @endif


                <form
                    method="POST"
                    action="{{ route('education.comments.store') }}"
                >

                    @csrf


                    {{-- NAME --}}

                    <div class="education-comments-form-group">

                        <label for="comment-name">

                            {{ __('education.comments.form.name.label') }}

                            <span>*</span>

                        </label>

                        <input
                            type="text"
                            id="comment-name"
                            name="name"
                            class="education-comments-input"
                            value="{{ old('name') }}"
                            maxlength="100"
                            required
                            autocomplete="name"
                            placeholder="{{ __('education.comments.form.name.placeholder') }}"
                        >

                    </div>


                    {{-- EMAIL --}}

                    <div class="education-comments-form-group">

                        <label for="comment-email">

                            {{ __('education.comments.form.email.label') }}

                            <span>
                                {{ __('education.comments.form.optional') }}
                            </span>

                        </label>

                        <input
                            type="email"
                            id="comment-email"
                            name="email"
                            class="education-comments-input"
                            value="{{ old('email') }}"
                            maxlength="255"
                            autocomplete="email"
                            placeholder="{{ __('education.comments.form.email.placeholder') }}"
                        >

                    </div>


                    {{-- COMMENT --}}

                    <div class="education-comments-form-group">

                        <label for="comment-content">

                            {{ __('education.comments.form.comment.label') }}

                            <span>*</span>

                        </label>

                        <textarea
                            id="comment-content"
                            name="comment"
                            class="education-comments-textarea"
                            maxlength="2000"
                            required
                            placeholder="{{ __('education.comments.form.comment.placeholder') }}"
                        >{{ old('comment') }}</textarea>

                    </div>


                    <button
                        type="submit"
                        class="education-comments-submit"
                    >

                        <i class="fa-solid fa-paper-plane"></i>

                        {{ __('education.comments.form.submit') }}

                    </button>


                    <p class="education-comments-note">

                        {{ __('education.comments.form.note') }}

                    </p>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection

