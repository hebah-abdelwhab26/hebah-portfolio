@extends('admin.layouts.app')

@section('title', __('digital_studio_admin.comments.show.title'))

@section('content')

<div class="page-wrapper fade-up">

<!--==================================
            PAGE HEADER
==================================-->

<div class="page-header">

    <div class="page-header-content">

        <div class="page-header-left">

            <div class="page-icon">

                <i class="fa-solid fa-comments"></i>

            </div>

            <div>

                <h1>

                    {{ __('digital_studio_admin.comments.show.page_header.title') }}

                </h1>

                <p>

                    {{ __('digital_studio_admin.comments.show.page_header.description') }}

                </p>

            </div>

        </div>


        <div class="page-header-right">

            <a
                href="{{ route('admin.comments.index') }}"
                class="btn-admin">

                <i class="fa-solid fa-arrow-left"></i>

                {{ __('digital_studio_admin.comments.show.page_header.back') }}

            </a>


            <a
                href="{{ route('admin.comments.edit',$comment) }}"
                class="btn-admin-primary">

                <i class="fa-solid fa-pen"></i>

                {{ __('digital_studio_admin.comments.show.page_header.edit') }}

            </a>

        </div>

    </div>

</div>


<!--==================================
            COMMENT DETAILS
==================================-->

<div class="admin-card comment-details-card">

    <div class="row g-0">


        <!--==================================
                LEFT SIDE
        ==================================-->

        <div class="col-lg-4 comment-sidebar">

            <div class="comment-sidebar-inner">


                <!--==============================
                        AUTHOR
                ==============================-->

                <div class="comment-author-section">

                    <span class="comment-section-label">

                        {{ __('digital_studio_admin.comments.show.author.label') }}

                    </span>


                    <div class="comment-author-profile">

                        @if($comment->user && $comment->user->avatar)

                            <img
                                src="{{ $comment->user->avatar_url }}"
                                alt="{{ $comment->name }}"
                                class="comment-avatar">

                        @else

                            <div class="comment-avatar-placeholder">

                                {{ strtoupper(substr($comment->name,0,1)) }}

                            </div>

                        @endif


                        <div class="comment-author-info">

                            <h3>

                                {{ $comment->name }}

                            </h3>


                            @if($comment->email)

                                <p>

                                    <i class="fa-regular fa-envelope"></i>

                                    {{ $comment->email }}

                                </p>

                            @endif

                        </div>

                    </div>

                </div>


                <div class="comment-divider"></div>


                <!--==============================
                        STATUS
                ==============================-->

                <div class="comment-info-block">

                    <span class="comment-section-label">

                        {{ __('digital_studio_admin.comments.show.status.label') }}

                    </span>


                    <div class="comment-status">

                        @if($comment->status == 'approved')

                            <span class="table-badge success">

                                <i class="fa-solid fa-circle"></i>

                                {{ __('digital_studio_admin.comments.show.status.approved') }}

                            </span>

                        @elseif($comment->status == 'pending')

                            <span class="table-badge warning">

                                <i class="fa-solid fa-circle"></i>

                                {{ __('digital_studio_admin.comments.show.status.pending') }}

                            </span>

                        @else

                            <span class="table-badge danger">

                                <i class="fa-solid fa-circle"></i>

                                {{ __('digital_studio_admin.comments.show.status.rejected') }}

                            </span>

                        @endif

                    </div>

                </div>


                <!--==============================
                        RELATED ITEM
                ==============================-->

                <div class="comment-info-block">

                    <span class="comment-section-label">

                        {{ __('digital_studio_admin.comments.show.related.label') }}

                    </span>


                    @if($comment->commentable)

                        <div class="comment-related">

                            <div class="comment-related-icon">

                                <i class="fa-solid fa-folder-open"></i>

                            </div>


                            <div>

                                <small>

                                    {{ class_basename($comment->commentable_type) }}

                                </small>

                                <strong>

                                    {{ $comment->commentable->title ?? __('digital_studio_admin.comments.show.related.item') }}

                                </strong>

                            </div>

                        </div>

                    @else

                        <div class="comment-related">

                            <div class="comment-related-icon">

                                <i class="fa-solid fa-globe"></i>

                            </div>


                            <div>

                                <small>

                                    {{ __('digital_studio_admin.comments.show.related.comment_type') }}

                                </small>

                                <strong>

                                    {{ __('digital_studio_admin.comments.show.related.general_comment') }}

                                </strong>

                            </div>

                        </div>

                    @endif

                </div>


                <!--==============================
                        DATE
                ==============================-->

                <div class="comment-info-block">

                    <span class="comment-section-label">

                        {{ __('digital_studio_admin.comments.show.submitted.label') }}

                    </span>


                    <div class="comment-date">

                        <i class="fa-regular fa-calendar"></i>

                        <div>

                            <strong>

                                {{ $comment->created_at->format('d M Y') }}

                            </strong>

                            <small>

                                {{ $comment->created_at->format('h:i A') }}

                            </small>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        <!--==================================
                RIGHT SIDE
        ==================================-->

        <div class="col-lg-8">

            <div class="comment-content">


                <!--==============================
                        CONTENT HEADER
                ==============================-->

                <div class="comment-content-header">

                    <div>

                        <span class="comment-section-label">

                            {{ __('digital_studio_admin.comments.show.feedback.label') }}

                        </span>

                        <h2>

                            {{ __('digital_studio_admin.comments.show.feedback.title') }}

                        </h2>

                    </div>


                    <div class="comment-quote-icon">

                        <i class="fa-solid fa-quote-right"></i>

                    </div>

                </div>


                <!--==============================
                        MESSAGE
                ==============================-->

                <div class="comment-message-box">

                    <i class="fa-solid fa-quote-left"></i>


                    <p>

                        {{ $comment->message }}

                    </p>

                </div>


                <!--==============================
                        CONTENT FOOTER
                ==============================-->

                <div class="comment-content-footer">

                    <div>

                        <span>

                            {{ __('digital_studio_admin.comments.show.footer.submitted_by') }}

                        </span>

                        <strong>

                            {{ $comment->name }}

                        </strong>

                    </div>


                    <div>

                        <span>

                            {{ __('digital_studio_admin.comments.show.footer.date') }}

                        </span>

                        <strong>

                            {{ $comment->created_at->format('d M Y') }}

                        </strong>

                    </div>

                </div>

            </div>

        </div>


    </div>

</div>


<!--==================================
            BOTTOM ACTIONS
==================================-->

<div class="comment-actions">

    <a
        href="{{ route('admin.comments.index') }}"
        class="btn-admin">

        <i class="fa-solid fa-arrow-left"></i>

        {{ __('digital_studio_admin.comments.show.actions.back_to_comments') }}

    </a>


    <a
        href="{{ route('admin.comments.edit',$comment) }}"
        class="btn-admin-primary">

        <i class="fa-solid fa-pen"></i>

        {{ __('digital_studio_admin.comments.show.actions.edit') }}

    </a>

</div>

</div>

@endsection
