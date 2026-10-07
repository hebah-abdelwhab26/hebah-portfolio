@extends('education.admin.layouts.app')

@section('page_title', __('education_admin.lessons.page_title'))

@section('title', __('education_admin.lessons.title'))

@section('content')

<div class="education-admin-lessons-page">

    {{-- ==================================================
        PAGE HEADER
    ================================================== --}}

    <div class="education-admin-lessons-header">

        <div class="education-admin-lessons-heading">

            <span class="education-admin-page-header-label">
                {{ __('education_admin.lessons.header_label') }}
            </span>

            <h2>
                {{ __('education_admin.lessons.title') }}
            </h2>

            <p>
                {{ __('education_admin.lessons.description') }}
            </p>

        </div>


        <div class="education-admin-lessons-header-actions">

            <a
                href="{{ route('education.admin.lessons.create') }}"
                class="education-admin-lessons-add-button"
            >

                <i class="fa-solid fa-plus"></i>

                <span>
                    {{ __('education_admin.lessons.add_new') }}
                </span>

            </a>

        </div>

    </div>


    {{-- ==================================================
        SUCCESS MESSAGE
    ================================================== --}}

    @if(session('success'))

        <div class="education-admin-alert education-admin-alert-success">

            <i class="fa-solid fa-circle-check"></i>

            <div>
                {{ session('success') }}
            </div>

        </div>

    @endif


    {{-- ==================================================
        ERROR MESSAGE
    ================================================== --}}

    @if(session('error'))

        <div class="education-admin-alert education-admin-alert-error">

            <i class="fa-solid fa-circle-exclamation"></i>

            <div>
                {{ session('error') }}
            </div>

        </div>

    @endif


    {{-- ==================================================
        VALIDATION ERRORS
    ================================================== --}}

    @if($errors->any())

        <div class="education-admin-alert education-admin-alert-error">

            <i class="fa-solid fa-circle-exclamation"></i>

            <div>

                @foreach($errors->all() as $error)

                    <div>
                        {{ $error }}
                    </div>

                @endforeach

            </div>

        </div>

    @endif


    {{-- ==================================================
        STATISTICS
    ================================================== --}}

    <div class="education-admin-lessons-statistics">


        {{-- TOTAL --}}

        <div class="education-admin-lessons-stat-card">

            <div class="education-admin-lessons-stat-icon">

                <i class="fa-solid fa-book-open"></i>

            </div>

            <div class="education-admin-lessons-stat-content">

                <span>
                    {{ __('education_admin.lessons.statistics.all_lessons') }}
                </span>

                <strong>
                    {{ $totalLessons ?? $lessons->total() }}
                </strong>

                <small>
                    {{ __('education_admin.lessons.statistics.all_lessons_help') }}
                </small>

            </div>

        </div>


        {{-- ACTIVE --}}

        <div class="education-admin-lessons-stat-card active">

            <div class="education-admin-lessons-stat-icon">

                <i class="fa-solid fa-circle-check"></i>

            </div>

            <div class="education-admin-lessons-stat-content">

                <span>
                    {{ __('education_admin.lessons.statistics.active') }}
                </span>

                <strong>
                    {{ $activeLessons ?? 0 }}
                </strong>

                <small>
                    {{ __('education_admin.lessons.statistics.active_help') }}
                </small>

            </div>

        </div>


        {{-- INACTIVE --}}

        <div class="education-admin-lessons-stat-card inactive">

            <div class="education-admin-lessons-stat-icon">

                <i class="fa-solid fa-circle-pause"></i>

            </div>

            <div class="education-admin-lessons-stat-content">

                <span>
                    {{ __('education_admin.lessons.statistics.inactive') }}
                </span>

                <strong>
                    {{ $inactiveLessons ?? 0 }}
                </strong>

                <small>
                    {{ __('education_admin.lessons.statistics.inactive_help') }}
                </small>

            </div>

        </div>


        {{-- CATEGORIES --}}

        <div class="education-admin-lessons-stat-card bookings">

            <div class="education-admin-lessons-stat-icon">

                <i class="fa-solid fa-layer-group"></i>

            </div>

            <div class="education-admin-lessons-stat-content">

                <span>
                    {{ __('education_admin.lessons.statistics.categories') }}
                </span>

                <strong>
                    {{ $categories->count() }}
                </strong>

                <small>
                    {{ __('education_admin.lessons.statistics.categories_help') }}
                </small>

            </div>

        </div>

    </div>


    {{-- ==================================================
        FILTERS
    ================================================== --}}

    <div class="education-admin-lessons-filters-card">

        <form
            action="{{ route('education.admin.lessons.index') }}"
            method="GET"
            class="education-admin-lessons-filters-form"
        >

            {{-- SEARCH --}}

            <div class="education-admin-lessons-search">

                <i class="fa-solid fa-magnifying-glass"></i>

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="{{ __('education_admin.lessons.filters.search_placeholder') }}"
                >

            </div>


            {{-- CATEGORY --}}

            <div class="education-admin-lessons-filter">

                <label for="lesson-category">
                    {{ __('education_admin.lessons.filters.category') }}
                </label>

                <select
                    id="lesson-category"
                    name="category"
                >

                    <option value="">
                        {{ __('education_admin.lessons.filters.all_categories') }}
                    </option>

                    @foreach($categories ?? [] as $category)

                        <option
                            value="{{ $category }}"
                            @selected(request('category') == $category)
                        >
                            {{ $category }}
                        </option>

                    @endforeach

                </select>

            </div>


            {{-- STATUS --}}

            <div class="education-admin-lessons-filter">

                <label for="lesson-status">
                    {{ __('education_admin.lessons.filters.status') }}
                </label>

                <select
                    id="lesson-status"
                    name="status"
                >

                    <option value="">
                        {{ __('education_admin.lessons.filters.all_statuses') }}
                    </option>

                    <option
                        value="active"
                        @selected(request('status') === 'active')
                    >
                        {{ __('education_admin.lessons.filters.active') }}
                    </option>

                    <option
                        value="inactive"
                        @selected(request('status') === 'inactive')
                    >
                        {{ __('education_admin.lessons.filters.inactive') }}
                    </option>

                </select>

            </div>


            {{-- SORT --}}

            <div class="education-admin-lessons-filter">

                <label for="lesson-sort">
                    {{ __('education_admin.lessons.filters.sort') }}
                </label>

                <select
                    id="lesson-sort"
                    name="sort"
                >

                    <option value="">
                        {{ __('education_admin.lessons.filters.newest') }}
                    </option>

                    <option
                        value="oldest"
                        @selected(request('sort') === 'oldest')
                    >
                        {{ __('education_admin.lessons.filters.oldest') }}
                    </option>

                    <option
                        value="title_asc"
                        @selected(request('sort') === 'title_asc')
                    >
                        {{ __('education_admin.lessons.filters.title_asc') }}
                    </option>

                    <option
                        value="title_desc"
                        @selected(request('sort') === 'title_desc')
                    >
                        {{ __('education_admin.lessons.filters.title_desc') }}
                    </option>

                    <option
                        value="price_low"
                        @selected(request('sort') === 'price_low')
                    >
                        {{ __('education_admin.lessons.filters.price_low') }}
                    </option>

                    <option
                        value="price_high"
                        @selected(request('sort') === 'price_high')
                    >
                        {{ __('education_admin.lessons.filters.price_high') }}
                    </option>

                    <option
                        value="duration_short"
                        @selected(request('sort') === 'duration_short')
                    >
                        {{ __('education_admin.lessons.filters.duration_short') }}
                    </option>

                    <option
                        value="duration_long"
                        @selected(request('sort') === 'duration_long')
                    >
                        {{ __('education_admin.lessons.filters.duration_long') }}
                    </option>

                    <option
                        value="sort_order"
                        @selected(request('sort') === 'sort_order')
                    >
                        {{ __('education_admin.lessons.filters.sort_order') }}
                    </option>

                </select>

            </div>


            {{-- ACTIONS --}}

            <div class="education-admin-lessons-filter-actions">

                <button
                    type="submit"
                    class="education-admin-lessons-filter-submit"
                >

                    <i class="fa-solid fa-filter"></i>

                    {{ __('education_admin.lessons.filters.apply') }}

                </button>


                @if(request()->hasAny([
                    'search',
                    'category',
                    'status',
                    'sort'
                ]))

                    <a
                        href="{{ route('education.admin.lessons.index') }}"
                        class="education-admin-lessons-filter-reset"
                    >

                        <i class="fa-solid fa-rotate-left"></i>

                        {{ __('education_admin.lessons.filters.reset') }}

                    </a>

                @endif

            </div>

        </form>

    </div>


    {{-- ==================================================
        LESSONS TABLE
    ================================================== --}}

    <div class="education-admin-lessons-table-card">


        {{-- TABLE HEADER --}}

        <div class="education-admin-lessons-table-header">

            <div>

                <span>
                    {{ __('education_admin.lessons.table.list') }}
                </span>

                <h3>
                    {{ __('education_admin.lessons.table.available') }}
                </h3>

            </div>


            <div class="education-admin-lessons-table-count">

                <i class="fa-solid fa-layer-group"></i>

                <span>
                    {{ $lessons->total() }}
                    {{ __('education_admin.lessons.table.lesson_count') }}
                </span>

            </div>

        </div>


        {{-- TABLE --}}

        @if($lessons->count())

            <div class="education-admin-lessons-table-wrapper">

                <table class="education-admin-lessons-table">

                    <thead>

                        <tr>

                            <th>
                                {{ __('education_admin.lessons.table.lesson') }}
                            </th>

                            <th>
                                {{ __('education_admin.lessons.table.category') }}
                            </th>

                            <th>
                                {{ __('education_admin.lessons.table.duration') }}
                            </th>

                            <th>
                                {{ __('education_admin.lessons.table.price') }}
                            </th>

                            <th>
                                {{ __('education_admin.lessons.table.status') }}
                            </th>

                            <th>
                                {{ __('education_admin.lessons.table.sort_order') }}
                            </th>

                            <th>
                                {{ __('education_admin.lessons.table.actions') }}
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($lessons as $lesson)

                            <tr>

                                {{-- LESSON --}}

                                <td>

                                    <div class="education-admin-lesson-main">

                                        <div class="education-admin-lesson-icon">

                                            <i class="fa-solid fa-book-open"></i>

                                        </div>


                                        <div class="education-admin-lesson-info">

                                            <strong>
                                                {{ $lesson->title }}
                                            </strong>

                                            @if($lesson->description)

                                                <small>

                                                    {{ \Illuminate\Support\Str::limit(
                                                        $lesson->description,
                                                        70
                                                    ) }}

                                                </small>

                                            @endif

                                        </div>

                                    </div>

                                </td>


                                {{-- CATEGORY --}}

                                <td>

                                    @if($lesson->category)

                                        <span class="education-admin-lesson-category">

                                            <i class="fa-solid fa-tag"></i>

                                            {{ $lesson->category }}

                                        </span>

                                    @else

                                        <span class="education-admin-lesson-empty">
                                            —
                                        </span>

                                    @endif

                                </td>


                                {{-- DURATION --}}

                                <td>

                                    <div class="education-admin-lesson-duration">

                                        <i class="fa-regular fa-clock"></i>

                                        <span>
                                            {{ $lesson->duration }}
                                        </span>

                                        <small>
                                            {{ __('education_admin.lessons.duration.minute') }}
                                        </small>

                                    </div>

                                </td>


                                {{-- PRICE --}}

                                <td>

                                    <div class="education-admin-lesson-price">

                                        <strong>
                                            {{ number_format(
                                                (float) $lesson->price,
                                                2
                                            ) }}
                                        </strong>

                                        <span>
                                            {{ $lesson->currency ?? 'SAR' }}
                                        </span>

                                    </div>

                                </td>


                                {{-- STATUS --}}

                                <td>

                                    @if($lesson->is_active)

                                        <span class="education-admin-lesson-status active">

                                            <span class="education-admin-lesson-status-dot"></span>

                                            {{ __('education_admin.lessons.status.active') }}

                                        </span>

                                    @else

                                        <span class="education-admin-lesson-status inactive">

                                            <span class="education-admin-lesson-status-dot"></span>

                                            {{ __('education_admin.lessons.status.inactive') }}

                                        </span>

                                    @endif

                                </td>


                                {{-- SORT ORDER --}}

                                <td>

                                    <span class="education-admin-lesson-sort-order">

                                        {{ $lesson->sort_order }}

                                    </span>

                                </td>


                                {{-- ACTIONS --}}

                                <td>

                                    <div class="education-admin-lesson-actions">


                                        {{-- SHOW --}}

                                        <a
                                            href="{{ route(
                                                'education.admin.lessons.show',
                                                $lesson
                                            ) }}"
                                            class="education-admin-lesson-action view"
                                            title="{{ __('education_admin.lessons.actions.view') }}"
                                        >

                                            <i class="fa-solid fa-eye"></i>

                                        </a>


                                        {{-- EDIT --}}

                                        <a
                                            href="{{ route(
                                                'education.admin.lessons.edit',
                                                $lesson
                                            ) }}"
                                            class="education-admin-lesson-action edit"
                                            title="{{ __('education_admin.lessons.actions.edit') }}"
                                        >

                                            <i class="fa-solid fa-pen"></i>

                                        </a>


                                        {{-- TOGGLE STATUS --}}

                                        <form
                                            action="{{ route(
                                                'education.admin.lessons.toggle-status',
                                                $lesson
                                            ) }}"
                                            method="POST"
                                        >

                                            @csrf

                                            @method('PATCH')

                                            <button
                                                type="submit"
                                                class="education-admin-lesson-action status"
                                                title="{{ $lesson->is_active
                                                    ? __('education_admin.lessons.actions.deactivate')
                                                    : __('education_admin.lessons.actions.activate') }}"
                                            >

                                                @if($lesson->is_active)

                                                    <i class="fa-solid fa-pause"></i>

                                                @else

                                                    <i class="fa-solid fa-play"></i>

                                                @endif

                                            </button>

                                        </form>


                                        {{-- DELETE --}}

                                        <form
                                            action="{{ route(
                                                'education.admin.lessons.destroy',
                                                $lesson
                                            ) }}"
                                            method="POST"
                                            onsubmit="return confirm('{{ __('education_admin.lessons.actions.confirm_delete') }}');"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="education-admin-lesson-action delete"
                                                title="{{ __('education_admin.lessons.actions.delete') }}"
                                            >

                                                <i class="fa-solid fa-trash"></i>

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>


            {{-- ==================================================
                PAGINATION
            ================================================== --}}

            @if($lessons->hasPages())

                <div class="education-admin-lessons-pagination">

                    <div class="education-admin-lessons-pagination-info">

                        {{ __('education_admin.lessons.pagination.showing') }}

                        <strong>
                            {{ $lessons->firstItem() }}
                        </strong>

                        {{ __('education_admin.lessons.pagination.to') }}

                        <strong>
                            {{ $lessons->lastItem() }}
                        </strong>

                        {{ __('education_admin.lessons.pagination.of') }}

                        <strong>
                            {{ $lessons->total() }}
                        </strong>

                    </div>


                    <div class="education-admin-lessons-pagination-links">

                        {{ $lessons->links() }}

                    </div>

                </div>

            @endif


        @else

            {{-- ==================================================
                EMPTY STATE
            ================================================== --}}

            <div class="education-admin-lessons-empty">

                <div class="education-admin-lessons-empty-icon">

                    <i class="fa-solid fa-book-open"></i>

                </div>

                <h3>
                    {{ __('education_admin.lessons.empty.title') }}
                </h3>

                <p>

                    @if(request()->hasAny([
                        'search',
                        'category',
                        'status',
                        'sort'
                    ]))

                        {{ __('education_admin.lessons.empty.filtered') }}

                    @else

                        {{ __('education_admin.lessons.empty.no_lessons') }}

                    @endif

                </p>


                @if(request()->hasAny([
                    'search',
                    'category',
                    'status',
                    'sort'
                ]))

                    <a
                        href="{{ route('education.admin.lessons.index') }}"
                        class="education-admin-lessons-empty-button"
                    >

                        <i class="fa-solid fa-rotate-left"></i>

                        {{ __('education_admin.lessons.empty.show_all') }}

                    </a>

                @else

                    <a
                        href="{{ route('education.admin.lessons.create') }}"
                        class="education-admin-lessons-empty-button"
                    >

                        <i class="fa-solid fa-plus"></i>

                        {{ __('education_admin.lessons.empty.add_first') }}

                    </a>

                @endif

            </div>

        @endif

    </div>

</div>

@endsection
