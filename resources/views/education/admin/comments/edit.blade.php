@extends('education.admin.layouts.app')

@section('title', __('education_admin.comments.edit_page_title'))

@section('content')

<style>
    .education-admin-comment-edit-page {
        direction: rtl;
        color: #30372a;
        padding-bottom: 50px;
    }

    .education-admin-comment-edit-card {
        max-width: 800px;
        margin: 0 auto;
        background: #fffdf8;
        border: 1px solid #e7e1d2;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(48, 55, 42, .05);
    }

    .education-admin-comment-edit-header {
        margin-bottom: 25px;
    }

    .education-admin-comment-edit-header h1 {
        margin: 0 0 7px;
        font-size: 25px;
        font-weight: 800;
    }

    .education-admin-comment-edit-header p {
        margin: 0;
        color: #85897d;
        font-size: 13px;
    }

    .education-admin-comment-edit-group {
        margin-bottom: 18px;
    }

    .education-admin-comment-edit-group label {
        display: block;
        margin-bottom: 7px;
        color: #4f5547;
        font-size: 13px;
        font-weight: 800;
    }

    .education-admin-comment-edit-input,
    .education-admin-comment-edit-select,
    .education-admin-comment-edit-textarea {
        width: 100%;
        box-sizing: border-box;
        border: 1px solid #ddd7c8;
        border-radius: 12px;
        background: #fff;
        color: #30372a;
        padding: 12px 13px;
        font-family: inherit;
        font-size: 14px;
        outline: none;
    }

    .education-admin-comment-edit-textarea {
        min-height: 180px;
        resize: vertical;
        line-height: 1.8;
    }

    .education-admin-comment-edit-input:focus,
    .education-admin-comment-edit-select:focus,
    .education-admin-comment-edit-textarea:focus {
        border-color: #a88a3d;
    }

    .education-admin-comment-edit-actions {
        display: flex;
        gap: 10px;
        margin-top: 25px;
    }

    .education-admin-comment-edit-submit,
    .education-admin-comment-edit-back {
        border: 0;
        border-radius: 11px;
        padding: 12px 20px;
        font-family: inherit;
        font-weight: 800;
        text-decoration: none;
        cursor: pointer;
    }

    .education-admin-comment-edit-submit {
        background: #6f7b48;
        color: #fff;
    }

    .education-admin-comment-edit-back {
        background: #eee8d8;
        color: #665c45;
    }

    .education-admin-comment-edit-errors {
        margin-bottom: 20px;
        padding: 13px 15px;
        border-radius: 12px;
        background: #fbefed;
        border: 1px solid #ecd0cb;
        color: #9b4f43;
    }

    .education-admin-comment-edit-errors ul {
        margin: 0;
        padding-right: 18px;
    }

    @media (max-width: 600px) {

        .education-admin-comment-edit-card {
            padding: 20px;
        }

        .education-admin-comment-edit-actions {
            flex-direction: column;
        }
    }
</style>

<div class="education-admin-comment-edit-page">

<div class="education-admin-comment-edit-card">

    <div class="education-admin-comment-edit-header">

        <h1>
            {{ __('education_admin.comments.edit_page_title') }}
        </h1>

        <p>
            {{ __('education_admin.comments.edit_page_description') }}
        </p>

    </div>


    @if($errors->any())

        <div class="education-admin-comment-edit-errors">

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
        action="{{ route('education.admin.comments.update', $comment) }}"
    >

        @csrf
        @method('PUT')


        {{-- NAME --}}

        <div class="education-admin-comment-edit-group">

            <label for="name">
                {{ __('education_admin.comments.name') }}
            </label>

            <input
                type="text"
                id="name"
                name="name"
                class="education-admin-comment-edit-input"
                value="{{ old('name', $comment->name) }}"
                maxlength="100"
                required
            >

        </div>


        {{-- EMAIL --}}

        <div class="education-admin-comment-edit-group">

            <label for="email">
                {{ __('education_admin.comments.email') }}
            </label>

            <input
                type="email"
                id="email"
                name="email"
                class="education-admin-comment-edit-input"
                value="{{ old('email', $comment->email) }}"
                maxlength="255"
            >

        </div>


        {{-- COMMENT --}}

        <div class="education-admin-comment-edit-group">

            <label for="comment">
                {{ __('education_admin.comments.comment') }}
            </label>

            <textarea
                id="comment"
                name="comment"
                class="education-admin-comment-edit-textarea"
                maxlength="2000"
                required
            >{{ old('comment', $comment->comment) }}</textarea>

        </div>


        {{-- STATUS --}}

        <div class="education-admin-comment-edit-group">

            <label for="status">
                {{ __('education_admin.comments.comment_status') }}
            </label>

            <select
                id="status"
                name="status"
                class="education-admin-comment-edit-select"
                required
            >

                <option
                    value="pending"
                    @selected(old('status', $comment->status) === 'pending')
                >
                    {{ __('education_admin.comments.pending_review') }}
                </option>

                <option
                    value="approved"
                    @selected(old('status', $comment->status) === 'approved')
                >
                    {{ __('education_admin.comments.published') }}
                </option>

                <option
                    value="rejected"
                    @selected(old('status', $comment->status) === 'rejected')
                >
                    {{ __('education_admin.comments.rejected') }}
                </option>

            </select>

        </div>


        <div class="education-admin-comment-edit-actions">

            <button
                type="submit"
                class="education-admin-comment-edit-submit"
            >

                <i class="fa-solid fa-check"></i>

                {{ __('education_admin.comments.save_changes') }}

            </button>


            <a
                href="{{ route('education.admin.comments.index') }}"
                class="education-admin-comment-edit-back"
            >

                <i class="fa-solid fa-arrow-right"></i>

                {{ __('education_admin.comments.back_to_comments') }}

            </a>

        </div>

    </form>

</div>

</div>

@endsection
