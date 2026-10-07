
@extends('admin.layouts.app')

@section('title', __('digital_studio_admin.conversations.index.title'))

@section('content')

<!--==================================
        PAGE HEADER
==================================-->

<div class="dashboard-header">

    <div class="dashboard-header-left">

        <div class="dashboard-breadcrumb">

            <i class="fa-solid fa-comments"></i>

            <span>
                {{ __('digital_studio_admin.conversations.index.breadcrumb') }}
            </span>

        </div>

        <h1>
            {{ __('digital_studio_admin.conversations.index.page_header.title') }}
        </h1>

        <p>
            {{ __('digital_studio_admin.conversations.index.page_header.description') }}
        </p>

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

        <i class="fa-solid fa-circle-exclamation me-2"></i>

        {{ session('error') }}

    </div>

@endif


@if($errors->any())

    <div class="alert alert-danger rounded-4 shadow-sm mb-4">

        <h6 class="fw-bold mb-3">

            <i class="fa-solid fa-circle-exclamation me-2"></i>

            {{ __('digital_studio_admin.conversations.index.alerts.validation') }}

        </h6>

        <ul class="mb-0">

            @foreach($errors->all() as $error)

                <li>
                    {{ $error }}
                </li>

            @endforeach

        </ul>

    </div>

@endif


<!--==================================
        STATISTICS
==================================-->

<div class="row g-4 mb-4">


    <!-- Total -->

    <div class="col-xl-3 col-md-6">

        <div class="admin-card h-100">

            <div class="d-flex align-items-center">

                <div class="dashboard-icon me-3">

                    <i class="fa-solid fa-comments"></i>

                </div>

                <div>

                    <small>
                        {{ __('digital_studio_admin.conversations.index.statistics.total') }}
                    </small>

                    <h3 class="mb-0 fw-bold">
                        {{ $totalMessages }}
                    </h3>

                </div>

            </div>

        </div>

    </div>


    <!-- Open -->

    <div class="col-xl-3 col-md-6">

        <div class="admin-card h-100">

            <div class="d-flex align-items-center">

                <div class="dashboard-icon me-3">

                    <i class="fa-solid fa-comment-dots"></i>

                </div>

                <div>

                    <small style="color: white">
                        {{ __('digital_studio_admin.conversations.index.statistics.open') }}
                    </small>

                    <h3 class="mb-0 fw-bold">
                        {{ $openConversations }}
                    </h3>

                </div>

            </div>

        </div>

    </div>


    <!-- Closed -->

    <div class="col-xl-3 col-md-6">

        <div class="admin-card h-100">

            <div class="d-flex align-items-center">

                <div class="dashboard-icon me-3">

                    <i class="fa-solid fa-circle-check"></i>

                </div>

                <div>

                    <small>
                        {{ __('digital_studio_admin.conversations.index.statistics.closed') }}
                    </small>

                    <h3 class="mb-0 fw-bold">
                        {{ $closedConversations }}
                    </h3>

                </div>

            </div>

        </div>

    </div>


    <!-- Unread -->

    <div class="col-xl-3 col-md-6">

        <div class="admin-card h-100">

            <div class="d-flex align-items-center">

                <div class="dashboard-icon me-3">

                    <i class="fa-solid fa-envelope"></i>

                </div>

                <div>

                    <small>
                        {{ __('digital_studio_admin.conversations.index.statistics.unread') }}
                    </small>

                    <h3 class="mb-0 fw-bold">
                        {{ $unreadMessages }}
                    </h3>

                </div>

            </div>

        </div>

    </div>

</div>


<!--==================================
        FILTERS
==================================-->

<div class="admin-card mb-4">

    <form
        action="{{ route('admin.conversations.index') }}"
        method="GET">

        <div class="row g-3 align-items-end">


            <!-- Search -->

            <div class="col-lg-6">

                <label class="form-label fw-semibold">

                    {{ __('digital_studio_admin.conversations.index.filters.search') }}

                </label>

                <div class="input-group">

                    <span class="input-group-text">

                        <i class="fa-solid fa-magnifying-glass"></i>

                    </span>

                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        value="{{ request('search') }}"
                        placeholder="{{ __('digital_studio_admin.conversations.index.filters.search_placeholder') }}">

                </div>

            </div>


            <!-- Status -->

            <div class="col-lg-3">

                <label class="form-label fw-semibold">

                    {{ __('digital_studio_admin.conversations.index.filters.status') }}

                </label>

                <select
                    name="status"
                    class="form-select">

                    <option value="">

                        {{ __('digital_studio_admin.conversations.index.filters.all_statuses') }}

                    </option>


                    <!-- Conversation statuses -->

                    <option
                        value="open"
                        @selected(request('status') === 'open')>

                        {{ __('digital_studio_admin.conversations.index.statuses.open') }}

                    </option>


                    <option
                        value="closed"
                        @selected(request('status') === 'closed')>

                        {{ __('digital_studio_admin.conversations.index.statuses.closed') }}

                    </option>


                    <option
                        value="archived"
                        @selected(request('status') === 'archived')>

                        {{ __('digital_studio_admin.conversations.index.statuses.archived') }}

                    </option>


                    <!-- Contact message statuses -->

                    <option
                        value="new"
                        @selected(request('status') === 'new')>

                        {{ app()->getLocale() === 'ar'
                            ? 'رسائل جديدة'
                            : 'New Messages'
                        }}

                    </option>


                    <option
                        value="read"
                        @selected(request('status') === 'read')>

                        {{ app()->getLocale() === 'ar'
                            ? 'مقروءة'
                            : 'Read'
                        }}

                    </option>


                    <option
                        value="replied"
                        @selected(request('status') === 'replied')>

                        {{ app()->getLocale() === 'ar'
                            ? 'تمت الإجابة'
                            : 'Replied'
                        }}

                    </option>

                </select>

            </div>


            <!-- Actions -->

            <div class="col-lg-3">

                <div class="d-flex gap-2">

                    <button
                        type="submit"
                        class="btn btn-primary rounded-pill px-4 flex-grow-1">

                        <i class="fa-solid fa-filter me-2"></i>

                        {{ __('digital_studio_admin.conversations.index.filters.filter') }}

                    </button>


                    <a
                        href="{{ route('admin.conversations.index') }}"
                        class="btn btn-light rounded-pill px-3"
                        title="{{ __('digital_studio_admin.conversations.index.filters.reset') }}">

                        <i class="fa-solid fa-rotate-left"></i>

                    </a>

                </div>

            </div>

        </div>

    </form>

</div>


<!--==================================
        MESSAGES TABLE
==================================-->

<div class="admin-card">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h4 class="card-title mb-1">

                {{ __('digital_studio_admin.conversations.index.table.title') }}

            </h4>

            <small class="card-title">

                {{ __('digital_studio_admin.conversations.index.table.description') }}

            </small>

        </div>


        <span class="badge bg-light text-dark rounded-pill px-3 py-2">

            {{ $conversations->total() }}

            {{ app()->getLocale() === 'ar'
                ? 'رسالة'
                : 'messages'
            }}

        </span>

    </div>


    @if($conversations->count())

        <div class="table-responsive">

            <table class="table align-middle mb-0 table-dark">

                <thead>

                    <tr>

                        <th>
                            {{ __('digital_studio_admin.conversations.index.table.user') }}
                        </th>

                        <th>
                            {{ __('digital_studio_admin.conversations.index.table.subject') }}
                        </th>

                        <th>
                            {{ __('digital_studio_admin.conversations.index.table.last_message') }}
                        </th>

                        <th>
                            {{ __('digital_studio_admin.conversations.index.table.status') }}
                        </th>

                        <th>
                            {{ __('digital_studio_admin.conversations.index.table.last_activity') }}
                        </th>

                        <th class="text-end">
                            {{ __('digital_studio_admin.conversations.index.table.action') }}
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @foreach($conversations as $item)


                        <!--==================================
                                USER CONVERSATION
                        ==================================-->

                        @if($item->message_type === 'conversation')

                            <tr>


                                <!-- USER -->

                                <td>

                                    <div class="d-flex align-items-center">

                                        @if($item->user)

                                            <img
                                                src="{{ $item->user->avatar_url }}"
                                                alt="{{ $item->user->name }}"
                                                class="rounded-circle me-3"
                                                style="
                                                    width:45px;
                                                    height:45px;
                                                    object-fit:cover;
                                                ">

                                            <div>

                                                <div class="fw-semibold">

                                                    {{ $item->user->name }}

                                                </div>

                                                <small class="text-muted">

                                                    {{ $item->user->email }}

                                                </small>

                                            </div>

                                        @else

                                            <div
                                                class="rounded-circle bg-light d-flex align-items-center justify-content-center me-3"
                                                style="
                                                    width:45px;
                                                    height:45px;
                                                ">

                                                <i class="fa-solid fa-user text-muted"></i>

                                            </div>

                                            <div>

                                                <div class="fw-semibold text-white">

                                                    {{ __('digital_studio_admin.conversations.index.user.unknown') }}

                                                </div>

                                                <small class="text-muted">

                                                    {{ __('digital_studio_admin.conversations.index.user.unavailable') }}

                                                </small>

                                            </div>

                                        @endif

                                    </div>

                                </td>


                                <!-- SUBJECT -->

                                <td>

                                    <div class="fw-semibold text-white">

                                        {{ $item->subject }}

                                    </div>

                                </td>


                                <!-- LAST MESSAGE -->

                                <td>

                                    @if($item->latestMessage)

                                        <div
                                            style="
                                                max-width:280px;
                                                white-space:nowrap;
                                                overflow:hidden;
                                                text-overflow:ellipsis;
                                            ">

                                            <span
                                                class="
                                                    {{
                                                        $item->latestMessage->sender_type === 'user'
                                                            ? 'fw-semibold'
                                                            : 'text-muted'
                                                    }}
                                                ">

                                                @if(
                                                    $item->latestMessage->sender_type === 'user'
                                                )

                                                    {{ __('digital_studio_admin.conversations.index.message.received') }}

                                                @else

                                                    {{ __('digital_studio_admin.conversations.index.message.replied') }}

                                                @endif

                                            </span>

                                            {{ $item->latestMessage->message }}

                                        </div>

                                    @else

                                        <span class="text-muted">

                                            {{ __('digital_studio_admin.conversations.index.message.none') }}

                                        </span>

                                    @endif

                                </td>


                                <!-- STATUS -->

                                <td>

                                    @if($item->status === 'open')

                                        <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2">

                                            <i
                                                class="fa-solid fa-circle me-1 text-white"
                                                style="font-size:7px;">
                                            </i>

                                            {{ __('digital_studio_admin.conversations.index.statuses.open') }}

                                        </span>

                                    @elseif($item->status === 'closed')

                                        <span class="badge bg-secondary-subtle text-secondary rounded-pill px-3 py-2">

                                            <i
                                                class="fa-solid fa-circle me-1"
                                                style="font-size:7px;">
                                            </i>

                                            {{ __('digital_studio_admin.conversations.index.statuses.closed') }}

                                        </span>

                                    @elseif($item->status === 'archived')

                                        <span class="badge bg-warning-subtle text-warning rounded-pill px-3 py-2">

                                            <i class="fa-solid fa-box-archive me-1"></i>

                                            {{ __('digital_studio_admin.conversations.index.statuses.archived') }}

                                        </span>

                                    @endif

                                </td>


                                <!-- LAST ACTIVITY -->

                                <td>

                                    @if($item->last_message_at)

                                        <div class="fw-semibold">

                                            {{ $item->last_message_at->diffForHumans() }}

                                        </div>

                                        <small class="text-muted">

                                            {{ $item->last_message_at->format('d M Y - h:i A') }}

                                        </small>

                                    @else

                                        <span class="text-muted">

                                            {{ __('digital_studio_admin.conversations.index.activity.none') }}

                                        </span>

                                    @endif

                                </td>


                                <!-- ACTIONS -->

                                <td class="text-end">

                                    <div class="d-flex justify-content-end gap-2">


                                        <!-- OPEN -->

                                        <a
                                            href="{{ route(
                                                'admin.conversations.show',
                                                $item
                                            ) }}"
                                            class="btn btn-sm btn-primary rounded-pill px-3">

                                            <i class="fa-solid fa-eye me-1"></i>

                                            {{ __('digital_studio_admin.conversations.index.actions.open') }}

                                        </a>


                                        <!-- CLOSE -->

                                        @if($item->status === 'open')

                                            <form
                                                action="{{ route(
                                                    'admin.conversations.close',
                                                    $item
                                                ) }}"
                                                method="POST">

                                                @csrf

                                                <button
                                                    type="submit"
                                                    class="btn btn-sm btn-light rounded-pill"
                                                    title="{{ __('digital_studio_admin.conversations.index.actions.close') }}">

                                                    <i class="fa-solid fa-lock"></i>

                                                </button>

                                            </form>


                                        @elseif($item->status === 'closed')

                                            <form
                                                action="{{ route(
                                                    'admin.conversations.reopen',
                                                    $item
                                                ) }}"
                                                method="POST">

                                                @csrf

                                                <button
                                                    type="submit"
                                                    class="btn btn-sm btn-light rounded-pill"
                                                    title="{{ __('digital_studio_admin.conversations.index.actions.reopen') }}">

                                                    <i class="fa-solid fa-lock-open"></i>

                                                </button>

                                            </form>

                                        @endif


                                        <!-- DELETE -->

                                        <form
                                            action="{{ route(
                                                'admin.conversations.destroy',
                                                $item
                                            ) }}"
                                            method="POST"
                                            onsubmit="return confirm('{{ __('digital_studio_admin.conversations.index.actions.delete_confirm') }}');">

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-light text-danger rounded-pill"
                                                title="{{ __('digital_studio_admin.conversations.index.actions.delete') }}">

                                                <i class="fa-solid fa-trash"></i>

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>


                        <!--==================================
                                VISITOR CONTACT MESSAGE
                        ==================================-->

                        @elseif($item->message_type === 'contact')

                            <tr
                                class="{{ $item->status === 'new' ? 'fw-semibold' : '' }}"
                                style="
                                    border-left:
                                        {{ $item->status === 'new'
                                            ? '3px solid #d4a017'
                                            : '3px solid transparent'
                                        }};
                                ">


                                <!-- VISITOR -->

                                <td>

                                    <div class="d-flex align-items-center">

                                        <div
                                            class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                            style="
                                                width:45px;
                                                height:45px;
                                                background: rgba(212,160,23,.12);
                                            ">

                                            <i
                                                class="fa-solid fa-user-pen"
                                                style="color:#d4a017;">
                                            </i>

                                        </div>


                                        <div>

                                            <div class="fw-semibold text-white">

                                                {{ $item->name }}

                                            </div>

                                            <small class="text-muted">

                                                {{ $item->email }}

                                            </small>

                                            <div class="mt-1">

                                                <span
                                                    class="badge rounded-pill"
                                                    style="
                                                        background:rgba(212,160,23,.12);
                                                        color:#d4a017;
                                                        font-size:10px;
                                                    ">

                                                    <i class="fa-solid fa-envelope me-1"></i>

                                                    {{ app()->getLocale() === 'ar'
                                                        ? 'زائر'
                                                        : 'Visitor'
                                                    }}

                                                </span>

                                            </div>

                                        </div>

                                    </div>

                                </td>


                                <!-- SUBJECT -->

                                <td>

                                    <div class="fw-semibold text-white">

                                        {{ $item->subject }}

                                    </div>

                                </td>


                                <!-- MESSAGE -->

                                <td>

                                    <div
                                        style="
                                            max-width:280px;
                                            white-space:nowrap;
                                            overflow:hidden;
                                            text-overflow:ellipsis;
                                        "
                                        title="{{ $item->message }}">

                                        <span
                                            class="{{
                                                $item->status === 'new'
                                                    ? 'fw-semibold'
                                                    : 'text-muted'
                                            }}">

                                            {{ $item->message }}

                                        </span>

                                    </div>

                                </td>


                                <!-- STATUS -->

                                <td>

                                    @if($item->status === 'new')

                                        <span
                                            class="badge rounded-pill px-3 py-2"
                                            style="
                                                background:rgba(212,160,23,.15);
                                                color:#d4a017;
                                            ">

                                            <i
                                                class="fa-solid fa-circle me-1"
                                                style="font-size:7px;">
                                            </i>

                                            {{ app()->getLocale() === 'ar'
                                                ? 'جديدة'
                                                : 'New'
                                            }}

                                        </span>


                                    @elseif($item->status === 'read')

                                        <span
                                            class="badge bg-secondary-subtle text-secondary rounded-pill px-3 py-2">

                                            <i class="fa-solid fa-envelope-open me-1"></i>

                                            {{ app()->getLocale() === 'ar'
                                                ? 'مقروءة'
                                                : 'Read'
                                            }}

                                        </span>


                                    @elseif($item->status === 'replied')

                                        <span
                                            class="badge bg-success-subtle text-success rounded-pill px-3 py-2">

                                            <i class="fa-solid fa-reply me-1"></i>

                                            {{ app()->getLocale() === 'ar'
                                                ? 'تمت الإجابة'
                                                : 'Replied'
                                            }}

                                        </span>

                                    @endif

                                </td>


                                <!-- LAST ACTIVITY -->

                                <td>

                                    @if($item->created_at)

                                        <div class="fw-semibold">

                                            {{ $item->created_at->diffForHumans() }}

                                        </div>

                                        <small class="text-muted">

                                            {{ $item->created_at->format('d M Y - h:i A') }}

                                        </small>

                                    @endif

                                </td>


                                <!-- ACTIONS -->

                                <td class="text-end">

                                    <div class="d-flex justify-content-end gap-2">


                                        <!-- OPEN -->

                                        <a
                                            href="{{ route(
                                                'admin.conversations.contact.show',
                                                $item
                                            ) }}"
                                            class="btn btn-sm btn-primary rounded-pill px-3">

                                            <i class="fa-solid fa-eye me-1"></i>

                                            {{ __('digital_studio_admin.conversations.index.actions.open') }}

                                        </a>


                                        <!-- MARK AS READ -->

                                        @if($item->status === 'new')

                                            <form
                                                action="{{ route(
                                                    'admin.conversations.contact.read',
                                                    $item
                                                ) }}"
                                                method="POST">

                                                @csrf

                                                <button
                                                    type="submit"
                                                    class="btn btn-sm btn-light rounded-pill"
                                                    title="{{ app()->getLocale() === 'ar'
                                                        ? 'تحديد كمقروءة'
                                                        : 'Mark as read'
                                                    }}">

                                                    <i class="fa-solid fa-envelope-open"></i>

                                                </button>

                                            </form>

                                        @endif


                                        <!-- MARK AS REPLIED -->

                                        @if($item->status !== 'replied')

                                            <form
                                                action="{{ route(
                                                    'admin.conversations.contact.replied',
                                                    $item
                                                ) }}"
                                                method="POST">

                                                @csrf

                                                <button
                                                    type="submit"
                                                    class="btn btn-sm btn-light rounded-pill"
                                                    title="{{ app()->getLocale() === 'ar'
                                                        ? 'تمت الإجابة'
                                                        : 'Mark as replied'
                                                    }}">

                                                    <i class="fa-solid fa-reply"></i>

                                                </button>

                                            </form>

                                        @endif


                                        <!-- DELETE -->

                                        <form
                                            action="{{ route(
                                                'admin.conversations.contact.destroy',
                                                $item
                                            ) }}"
                                            method="POST"
                                            onsubmit="return confirm('{{ app()->getLocale() === 'ar'
                                                ? 'هل أنت متأكد من حذف هذه الرسالة؟'
                                                : 'Are you sure you want to delete this message?'
                                            }}');">

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-light text-danger rounded-pill"
                                                title="{{ __('digital_studio_admin.conversations.index.actions.delete') }}">

                                                <i class="fa-solid fa-trash"></i>

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @endif

                    @endforeach

                </tbody>

            </table>

        </div>


        <!--==================================
                PAGINATION
        ==================================-->

        <div class="mt-4">

            {{ $conversations->links() }}

        </div>

    @else

        <!--==================================
                EMPTY STATE
        ==================================-->

        <div class="text-center py-5">

            <div
                class="dashboard-icon mx-auto mb-4"
                style="
                    width:70px;
                    height:70px;
                    display:flex;
                    align-items:center;
                    justify-content:center;
                ">

                <i class="fa-solid fa-comments fa-2x"></i>

            </div>

            <h5 class="fw-bold mb-2">

                {{ __('digital_studio_admin.conversations.index.empty.title') }}

            </h5>

            <p class="text-white mb-0">

                {{ __('digital_studio_admin.conversations.index.empty.description') }}

            </p>

        </div>

    @endif

</div>

@endsection


<style>

/* ==========================================
   CONVERSATIONS / MESSAGES
========================================== */

.row.g-4.mb-4 {
    color: #fff !important;
}


/* ==========================================
   TABLE
========================================== */

.admin-card .table-dark {
    --bs-table-bg: transparent;
    --bs-table-color: #fff;
}


/* ==========================================
   VISITOR MESSAGE HOVER
========================================== */

.admin-card table tbody tr {
    transition:
        background-color .2s ease,
        transform .2s ease;
}

.admin-card table tbody tr:hover {
    background: rgba(255,255,255,.025);
}


/* ==========================================
   VISITOR BADGE
========================================== */

.admin-card .badge {
    white-space: nowrap;
}


/* ==========================================
   MOBILE ACTIONS
========================================== */

@media (max-width: 768px) {

    .admin-card table {
        min-width: 950px;
    }

}

</style>

