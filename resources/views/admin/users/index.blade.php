@extends('admin.layouts.app')

@section('title', __('digital_studio_admin.users.title'))

@section('content')

<div class="page-wrapper fade-up">

    <!--==================================
                PAGE HEADER
    ==================================-->

    <div class="page-header">

        <div class="page-header-content">

            <div class="page-header-left">

                <div class="page-icon">

                    <i class="fa-solid fa-users"></i>

                </div>

                <div>

                    <h1>

                        {{ __('digital_studio_admin.users.page_header.title') }}

                    </h1>

                    <p>

                        {{ __('digital_studio_admin.users.page_header.description') }}

                    </p>

                </div>

            </div>

            <div class="page-header-right">

                <a
                    href="{{ route('admin.users.create') }}"
                    class="btn-admin-primary">

                    <i class="fa-solid fa-plus"></i>

                    {{ __('digital_studio_admin.users.page_header.add_user') }}

                </a>

            </div>

        </div>

    </div>


    <!--==================================
                FILTER BAR
    ==================================-->

    <form
        method="GET"
        class="filter-bar">

        <div class="filter-search">

            <i class="fa-solid fa-magnifying-glass"></i>

            <input
                type="text"
                name="search"
                placeholder="{{ __('digital_studio_admin.users.filters.search_placeholder') }}"
                value="{{ request('search') }}"
            >

        </div>


        <div class="filter-select">

            <select name="role">

                <option value="">

                    {{ __('digital_studio_admin.users.filters.all_roles') }}

                </option>

                <option
                    value="super_admin"
                    @selected(request('role') == 'super_admin')>

                    {{ __('digital_studio_admin.users.filters.super_admin') }}

                </option>

                <option
                    value="admin"
                    @selected(request('role') == 'admin')>

                    {{ __('digital_studio_admin.users.filters.admin') }}

                </option>

                <option
                    value="editor"
                    @selected(request('role') == 'editor')>

                    {{ __('digital_studio_admin.users.filters.editor') }}

                </option>

                <option
                    value="user"
                    @selected(request('role') == 'user')>

                    {{ __('digital_studio_admin.users.filters.user') }}

                </option>

            </select>

        </div>


        <div class="filter-select">

            <select name="status">

                <option value="">

                    {{ __('digital_studio_admin.users.filters.all_status') }}

                </option>

                <option
                    value="active"
                    @selected(request('status') == 'active')>

                    {{ __('digital_studio_admin.users.filters.active') }}

                </option>

                <option
                    value="inactive"
                    @selected(request('status') == 'inactive')>

                    {{ __('digital_studio_admin.users.filters.inactive') }}

                </option>

                <option
                    value="blocked"
                    @selected(request('status') == 'blocked')>

                    {{ __('digital_studio_admin.users.filters.blocked') }}

                </option>

            </select>

        </div>


        <button
            class="btn-admin"
            type="submit">

            <i class="fa-solid fa-filter"></i>

            {{ __('digital_studio_admin.users.filters.filter') }}

        </button>

    </form>


    <!--==================================
                TABLE
    ==================================-->

    <div class="projects-table-wrapper">

        <table class="projects-table">

            <thead>

                <tr>

                    <th>

                        {{ __('digital_studio_admin.users.table.user') }}

                    </th>

                    <th>

                        {{ __('digital_studio_admin.users.table.role') }}

                    </th>

                    <th>

                        {{ __('digital_studio_admin.users.table.status') }}

                    </th>

                    <th>

                        {{ __('digital_studio_admin.users.table.last_login') }}

                    </th>

                    <th>

                        {{ __('digital_studio_admin.users.table.created') }}

                    </th>

                    <th width="170">

                        {{ __('digital_studio_admin.users.table.actions') }}

                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse($users as $user)

                    <tr>

                        <!--==================================
                                USER
                        ==================================-->

                        <td>

                            <div class="project-info">

                                <img
                                    src="{{ $user->avatar_url }}"
                                    alt="{{ $user->name }}"
                                >

                                <div>

                                    <h6>

                                        {{ $user->name }}

                                    </h6>

                                    <small>

                                        {{ '@'.$user->username }}

                                        <br>

                                        {{ $user->email }}

                                    </small>

                                </div>

                            </div>

                        </td>


                        <!--==================================
                                ROLE
                        ==================================-->

                        <td>

                            @switch($user->role)

                                @case('super_admin')

                                    <span class="table-badge featured">

                                        <i class="fa-solid fa-circle"></i>

                                        {{ __('digital_studio_admin.users.filters.super_admin') }}

                                    </span>

                                @break


                                @case('admin')

                                    <span class="table-badge success">

                                        <i class="fa-solid fa-circle"></i>

                                        {{ __('digital_studio_admin.users.filters.admin') }}

                                    </span>

                                @break


                                @case('editor')

                                    <span class="table-badge warning">

                                        <i class="fa-solid fa-circle"></i>

                                        {{ __('digital_studio_admin.users.filters.editor') }}

                                    </span>

                                @break


                                @default

                                    <span class="table-badge tech">

                                        <i class="fa-solid fa-circle"></i>

                                        {{ __('digital_studio_admin.users.filters.user') }}

                                    </span>

                            @endswitch

                        </td>


                        <!--==================================
                                STATUS
                        ==================================-->

                        <td>

                            @if($user->status == 'active')

                                <span class="table-badge success">

                                    <i class="fa-solid fa-circle"></i>

                                    {{ __('digital_studio_admin.users.filters.active') }}

                                </span>

                            @elseif($user->status == 'inactive')

                                <span class="table-badge warning">

                                    <i class="fa-solid fa-circle"></i>

                                    {{ __('digital_studio_admin.users.filters.inactive') }}

                                </span>

                            @else

                                <span class="table-badge danger">

                                    <i class="fa-solid fa-circle"></i>

                                    {{ __('digital_studio_admin.users.filters.blocked') }}

                                </span>

                            @endif

                        </td>


                        <!--==================================
                                LAST LOGIN
                        ==================================-->

                        <td>

                            @if($user->last_login_at)

                                {{ $user->last_login_at->diffForHumans() }}

                            @else

                                <span class="text-muted">

                                    {{ __('digital_studio_admin.users.table.never') }}

                                </span>

                            @endif

                        </td>


                        <!--==================================
                                CREATED
                        ==================================-->

                        <td>

                            {{ $user->created_at->format('d M Y') }}

                        </td>


                        <!--==================================
                                ACTIONS
                        ==================================-->

                        <td>

                            <div class="table-actions">

                                <a
                                    href="{{ route('admin.users.show',$user) }}"
                                    class="action-btn view"
                                    title="{{ __('digital_studio_admin.users.actions.view') }}"
                                >

                                    <i class="fa-solid fa-eye"></i>

                                </a>


                                <a
                                    href="{{ route('admin.users.edit',$user) }}"
                                    class="action-btn edit"
                                    title="{{ __('digital_studio_admin.users.actions.edit') }}"
                                >

                                    <i class="fa-solid fa-pen"></i>

                                </a>


                                <form
                                    action="{{ route('admin.users.destroy',$user) }}"
                                    method="POST"
                                >

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="action-btn delete"
                                        title="{{ __('digital_studio_admin.users.actions.delete') }}"
                                        onclick="return confirm('{{ __('digital_studio_admin.users.actions.delete_confirm') }}')"
                                    >

                                        <i class="fa-solid fa-trash"></i>

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6">

                            <div class="table-empty">

                                <i class="fa-solid fa-users"></i>

                                <h4>

                                    {{ __('digital_studio_admin.users.empty.title') }}

                                </h4>

                                <p>

                                    {{ __('digital_studio_admin.users.empty.description') }}

                                </p>

                                <a
                                    href="{{ route('admin.users.create') }}"
                                    class="btn-admin-primary mt-3"
                                >

                                    <i class="fa-solid fa-plus"></i>

                                    {{ __('digital_studio_admin.users.empty.create_first_user') }}

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

    @if($users->hasPages())

        <div class="mt-4">

            {{ $users->links() }}

        </div>

    @endif

</div>

@endsection
