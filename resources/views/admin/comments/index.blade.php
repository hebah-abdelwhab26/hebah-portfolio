@extends('admin.layouts.app')

@section('title', __('digital_studio_admin.comments.index.title'))

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
                        {{ __('digital_studio_admin.comments.index.page_header.title') }}
                    </h1>

                    <p>
                        {{ __('digital_studio_admin.comments.index.page_header.description') }}
                    </p>

                </div>

            </div>

            <div class="page-header-right">

                <a
                    href="{{ route('admin.comments.create') }}"
                    class="btn-admin-primary">

                    <i class="fa-solid fa-plus"></i>

                    {{ __('digital_studio_admin.comments.index.page_header.add_comment') }}

                </a>

            </div>

        </div>

    </div>


    <!--==================================
                STATISTICS
    ==================================-->

    <div class="row mb-4">

        <!-- TOTAL -->

        <div class="col-lg-3 col-md-6 mb-3">

            <div class="stat-card">

                <div class="stat-icon bg-primary">

                    <i class="fa-solid fa-comments"></i>

                </div>

                <div class="stat-content">

                    <h3>
                        {{ $totalComments }}
                    </h3>

                    <span>
                        {{ __('digital_studio_admin.comments.index.statistics.total') }}
                    </span>

                </div>

            </div>

        </div>


        <!-- PENDING -->

        <div class="col-lg-3 col-md-6 mb-3">

            <div class="stat-card">

                <div class="stat-icon bg-warning">

                    <i class="fa-solid fa-clock"></i>

                </div>

                <div class="stat-content">

                    <h3>
                        {{ $pendingComments }}
                    </h3>

                    <span>
                        {{ __('digital_studio_admin.comments.index.statistics.pending') }}
                    </span>

                </div>

            </div>

        </div>


        <!-- APPROVED -->

        <div class="col-lg-3 col-md-6 mb-3">

            <div class="stat-card">

                <div class="stat-icon bg-success">

                    <i class="fa-solid fa-circle-check"></i>

                </div>

                <div class="stat-content">

                    <h3>
                        {{ $approvedComments }}
                    </h3>

                    <span>
                        {{ __('digital_studio_admin.comments.index.statistics.approved') }}
                    </span>

                </div>

            </div>

        </div>


        <!-- REJECTED -->

        <div class="col-lg-3 col-md-6 mb-3">

            <div class="stat-card">

                <div class="stat-icon bg-danger">

                    <i class="fa-solid fa-circle-xmark"></i>

                </div>

                <div class="stat-content">

                    <h3>
                        {{ $rejectedComments }}
                    </h3>

                    <span>
                        {{ __('digital_studio_admin.comments.index.statistics.rejected') }}
                    </span>

                </div>

            </div>

        </div>

    </div>


    <!--==================================
                FILTER BAR
    ==================================-->

    <form
        method="GET"
        action="{{ route('admin.comments.index') }}"
        class="filter-bar">

        <!-- SEARCH -->

        <div class="filter-search">

            <i class="fa-solid fa-magnifying-glass"></i>

            <input
                type="text"
                name="search"
                placeholder="{{ __('digital_studio_admin.comments.index.filters.search_placeholder') }}"
                value="{{ request('search') }}">

        </div>


        <!-- STATUS -->

        <div class="filter-select">

            <select name="status">

                <option value="">

                    {{ __('digital_studio_admin.comments.index.filters.all_statuses') }}

                </option>

                <option
                    value="pending"
                    @selected(request('status') == 'pending')>

                    {{ __('digital_studio_admin.comments.index.statuses.pending') }}

                </option>

                <option
                    value="approved"
                    @selected(request('status') == 'approved')>

                    {{ __('digital_studio_admin.comments.index.statuses.approved') }}

                </option>

                <option
                    value="rejected"
                    @selected(request('status') == 'rejected')>

                    {{ __('digital_studio_admin.comments.index.statuses.rejected') }}

                </option>

            </select>

        </div>


        <!-- FILTER -->

        <button
            type="submit"
            class="btn-admin">

            <i class="fa-solid fa-filter"></i>

            {{ __('digital_studio_admin.comments.index.filters.filter') }}

        </button>


        <!-- RESET -->

        <a
            href="{{ route('admin.comments.index') }}"
            class="btn-admin">

            <i class="fa-solid fa-rotate-left"></i>

            {{ __('digital_studio_admin.comments.index.filters.reset') }}

        </a>

    </form>


    <!--==================================
                COMMENTS TABLE
    ==================================-->

    <div class="projects-table-wrapper">

        <table class="projects-table">

            <thead>

                <tr>

                    <th>
                        {{ __('digital_studio_admin.comments.index.table.client') }}
                    </th>

                    <th>
                        {{ __('digital_studio_admin.comments.index.table.comment') }}
                    </th>

                    <th>
                        {{ __('digital_studio_admin.comments.index.table.related_to') }}
                    </th>

                    <th>
                        {{ __('digital_studio_admin.comments.index.table.status') }}
                    </th>

                    <th>
                        {{ __('digital_studio_admin.comments.index.table.date') }}
                    </th>

                    <th width="170">
                        {{ __('digital_studio_admin.comments.index.table.actions') }}
                    </th>

                </tr>

            </thead>


            <tbody>

            @forelse($comments as $comment)

                <tr>

                    <!--==================================
                            CLIENT
                    ==================================-->

                    <td>

                        <div class="project-info">

                            <div class="table-avatar">

                                {{ strtoupper(
                                    substr($comment->name, 0, 1)
                                ) }}

                            </div>

                            <div>

                                <h6>

                                    {{ $comment->name }}

                                </h6>

                                <small>

                                    {{ $comment->email ?? __('digital_studio_admin.comments.index.user.no_email') }}

                                </small>

                            </div>

                        </div>

                    </td>


                    <!--==================================
                            COMMENT
                    ==================================-->

                    <td>

                        <div class="comment-table-text">

                            {{ Str::limit($comment->message, 80) }}

                        </div>

                    </td>


                    <!--==================================
                            RELATED PROJECT
                    ==================================-->

                    <td>

                        @if($comment->commentable)

                            <span class="table-badge tech">

                                <i class="fa-solid fa-folder"></i>

                                {{ class_basename(
                                    $comment->commentable_type
                                ) }}

                            </span>

                            <br>

                            <small class="text-muted">

                                {{ $comment->commentable->title ?? __('digital_studio_admin.comments.index.related.item') }}

                            </small>

                        @else

                            <span class="text-muted">

                                {{ __('digital_studio_admin.comments.index.related.general_comment') }}

                            </span>

                        @endif

                    </td>


                    <!--==================================
                            STATUS
                    ==================================-->

                    <td>

                        <form
                            action="{{ route(
                                'admin.comments.changeStatus',
                                $comment
                            ) }}"
                            method="POST">

                            @csrf

                            @method('PATCH')

                            <select
                                name="status"
                                class="comment-status-select
                                @if($comment->status == 'approved')
                                    status-approved
                                @elseif($comment->status == 'pending')
                                    status-pending
                                @else
                                    status-rejected
                                @endif"
                                onchange="this.form.submit()">

                                <option
                                    value="pending"
                                    @selected(
                                        $comment->status == 'pending'
                                    )>

                                    🟡 {{ __('digital_studio_admin.comments.index.statuses.pending') }}

                                </option>

                                <option
                                    value="approved"
                                    @selected(
                                        $comment->status == 'approved'
                                    )>

                                    🟢 {{ __('digital_studio_admin.comments.index.statuses.approved') }}

                                </option>

                                <option
                                    value="rejected"
                                    @selected(
                                        $comment->status == 'rejected'
                                    )>

                                    🔴 {{ __('digital_studio_admin.comments.index.statuses.rejected') }}

                                </option>

                            </select>

                        </form>

                    </td>


                    <!--==================================
                            DATE
                    ==================================-->

                    <td>

                        <span>

                            {{ $comment->created_at->format('d M Y') }}

                        </span>

                        <br>

                        <small class="text-muted">

                            {{ $comment->created_at->diffForHumans() }}

                        </small>

                    </td>


                    <!--==================================
                            ACTIONS
                    ==================================-->

                    <td>

                        <div class="table-actions">

                            <!-- VIEW -->

                            <a
                                href="{{ route(
                                    'admin.comments.show',
                                    $comment
                                ) }}"
                                class="action-btn view"
                                title="{{ __('digital_studio_admin.comments.index.actions.view') }}">

                                <i class="fa-solid fa-eye"></i>

                            </a>


                            <!-- EDIT -->

                            <a
                                href="{{ route(
                                    'admin.comments.edit',
                                    $comment
                                ) }}"
                                class="action-btn edit"
                                title="{{ __('digital_studio_admin.comments.index.actions.edit') }}">

                                <i class="fa-solid fa-pen"></i>

                            </a>


                            <!-- DELETE -->

                            <form
                                action="{{ route(
                                    'admin.comments.destroy',
                                    $comment
                                ) }}"
                                method="POST">

                                @csrf

                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="action-btn delete"
                                    title="{{ __('digital_studio_admin.comments.index.actions.delete') }}"
                                    onclick="return confirm(
                                        '{{ __('digital_studio_admin.comments.index.actions.delete_confirm') }}'
                                    )">

                                    <i class="fa-solid fa-trash"></i>

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>


            @empty

                <!--==================================
                        EMPTY STATE
                ==================================-->

                <tr>

                    <td colspan="6">

                        <div class="table-empty">

                            <i class="fa-solid fa-comments"></i>

                            <h4>

                                {{ __('digital_studio_admin.comments.index.empty.title') }}

                            </h4>

                            <p>

                                {{ __('digital_studio_admin.comments.index.empty.description') }}

                            </p>

                            <a
                                href="{{ route(
                                    'admin.comments.create'
                                ) }}"
                                class="btn-admin-primary mt-3">

                                <i class="fa-solid fa-plus"></i>

                                {{ __('digital_studio_admin.comments.index.empty.add_first') }}

                            </a>

                        </div>

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>


    <!--==================================
                PAGINATION
    ==================================-->

    @if($comments->hasPages())

        <div class="mt-4">

            {{ $comments->links() }}

        </div>

    @endif

</div>

@endsection
