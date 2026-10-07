@extends('education.admin.layouts.app')

@section('title', __('education_admin.booking_types.page_title'))

@section('content')

<style>
    /* =========================================================
       BOOKING TYPES PAGE
       ========================================================= */

    .booking-types-page {
        direction: rtl;
        color: #26352d;
        padding: 10px 0 35px;
    }

    /* =========================================================
       HEADER
       ========================================================= */

    .booking-types-header {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 25px;
        margin-bottom: 28px;
        padding: 28px 30px;
        border: 1px solid rgba(185, 145, 55, .18);
        border-radius: 24px;
        background:
            linear-gradient(
                135deg,
                rgba(255, 253, 247, .98),
                rgba(247, 241, 222, .92)
            );
        box-shadow:
            0 14px 40px rgba(54, 48, 28, .07);
        overflow: hidden;
    }

    .booking-types-header::before {
        content: "";
        position: absolute;
        top: -80px;
        left: -70px;
        width: 190px;
        height: 190px;
        border-radius: 50%;
        background: rgba(190, 150, 60, .08);
        pointer-events: none;
    }

    .booking-types-header::after {
        content: "";
        position: absolute;
        bottom: -100px;
        right: -70px;
        width: 220px;
        height: 220px;
        border-radius: 50%;
        background: rgba(45, 91, 65, .055);
        pointer-events: none;
    }

    .booking-types-title {
        position: relative;
        z-index: 1;
        margin: 0 0 8px;
        font-size: 29px;
        font-weight: 800;
        color: #294534;
        letter-spacing: -.4px;
    }

    .booking-types-subtitle {
        position: relative;
        z-index: 1;
        margin: 0;
        color: #7c806f;
        font-size: 14px;
        line-height: 1.8;
    }

    /* =========================================================
       ADD BUTTON
       ========================================================= */

    .booking-types-add {
        position: relative;
        z-index: 2;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        min-height: 46px;
        padding: 0 19px;
        border-radius: 13px;
        background: linear-gradient(
            135deg,
            #b99543,
            #9f7b32
        );
        color: #fffdf7 !important;
        text-decoration: none !important;
        font-size: 14px;
        font-weight: 700;
        white-space: nowrap;
        box-shadow: 0 8px 20px rgba(159, 123, 50, .20);
        transition:
            transform .2s ease,
            box-shadow .2s ease,
            filter .2s ease;
    }

    .booking-types-add:hover {
        transform: translateY(-2px);
        filter: brightness(1.04);
        box-shadow: 0 12px 26px rgba(159, 123, 50, .27);
    }

    .booking-types-add i {
        font-size: 13px;
    }

    /* =========================================================
       ALERTS
       ========================================================= */

    .booking-types-alert {
        display: flex;
        align-items: flex-start;
        gap: 11px;
        margin-bottom: 20px;
        padding: 14px 17px;
        border-radius: 15px;
        font-size: 14px;
        line-height: 1.8;
    }

    .booking-types-alert.success {
        color: #28573e;
        background: #eef8f1;
        border: 1px solid #cce7d4;
    }

    .booking-types-alert.error {
        color: #8b3c35;
        background: #fff2f0;
        border: 1px solid #f0d0cb;
        flex-direction: column;
        gap: 5px;
    }

    .booking-types-alert.success > i {
        margin-top: 4px;
    }

    .booking-types-alert.error div {
        display: flex;
        align-items: flex-start;
        gap: 9px;
    }

    .booking-types-alert.error i {
        margin-top: 5px;
    }

    /* =========================================================
       MAIN CARD
       ========================================================= */

    .booking-types-card {
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(185, 145, 55, .14);
        border-radius: 24px;
        background: #fffefa;
        box-shadow:
            0 12px 38px rgba(54, 48, 28, .06);
    }

    .booking-types-card::before {
        content: "";
        display: block;
        height: 3px;
        background: linear-gradient(
            90deg,
            #2f6145,
            #b99543,
            #2f6145
        );
        opacity: .75;
    }

    /* =========================================================
       TABLE WRAPPER
       ========================================================= */

    .booking-types-table-wrapper {
        width: 100%;
        overflow-x: auto;
        scrollbar-width: thin;
        scrollbar-color: #c8b57c #f6f1e4;
    }

    .booking-types-table-wrapper::-webkit-scrollbar {
        height: 7px;
    }

    .booking-types-table-wrapper::-webkit-scrollbar-track {
        background: #f6f1e4;
    }

    .booking-types-table-wrapper::-webkit-scrollbar-thumb {
        background: #c8b57c;
        border-radius: 20px;
    }

    /* =========================================================
       TABLE
       ========================================================= */

    .booking-types-table {
        width: 100%;
        min-width: 1050px;
        border-collapse: separate;
        border-spacing: 0;
    }

    .booking-types-table thead th {
        padding: 17px 16px;
        background: #f7f1df;
        border-bottom: 1px solid rgba(185, 145, 55, .18);
        color: #596052;
        font-size: 12px;
        font-weight: 800;
        white-space: nowrap;
        text-align: right;
    }

    .booking-types-table thead th:first-child {
        padding-right: 24px;
    }

    .booking-types-table tbody td {
        padding: 18px 16px;
        border-bottom: 1px solid #eee9dc;
        color: #4e574f;
        font-size: 13px;
        vertical-align: middle;
        background: #fffefa;
        transition: background .18s ease;
    }

    .booking-types-table tbody tr:last-child td {
        border-bottom: 0;
    }

    .booking-types-table tbody tr:hover td {
        background: #fcfaf3;
    }

    .booking-types-table tbody td:first-child {
        padding-right: 24px;
        color: #a18a52;
        font-weight: 800;
    }

    /* =========================================================
       NAME
       ========================================================= */

    .booking-type-name {
        color: #2d4939;
        font-size: 14px;
        font-weight: 800;
        margin-bottom: 5px;
        line-height: 1.6;
    }

    .booking-type-description {
        max-width: 280px;
        color: #96988c;
        font-size: 11px;
        line-height: 1.7;
    }

    /* =========================================================
       BADGES
       ========================================================= */

    .booking-type-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 80px;
        padding: 6px 11px;
        border-radius: 30px;
        font-size: 11px;
        font-weight: 800;
        white-space: nowrap;
    }

    .booking-type-badge.package {
        color: #765a19;
        background: #f8efd3;
        border: 1px solid #ead9a9;
    }

    .booking-type-badge.single {
        color: #365e48;
        background: #edf5ee;
        border: 1px solid #d0e3d5;
    }

    .booking-type-badge.active {
        color: #2d6546;
        background: #eaf7ee;
        border: 1px solid #c9e6d2;
    }

    .booking-type-badge.inactive {
        color: #8b5b55;
        background: #f9eeee;
        border: 1px solid #edd5d1;
    }

    /* =========================================================
       PRICE
       ========================================================= */

    .booking-type-price {
        color: #98762e;
        font-size: 15px;
        font-weight: 800;
    }

    .booking-type-currency {
        margin-right: 4px;
        color: #888b7d;
        font-size: 10px;
        font-weight: 600;
    }

    /* =========================================================
       ACTIONS
       ========================================================= */

    .booking-types-actions {
        display: flex;
        align-items: center;
        gap: 7px;
    }

    .booking-types-actions form {
        display: contents;
    }

    .booking-type-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 34px;
        height: 34px;
        padding: 0;
        border-radius: 10px;
        border: 1px solid transparent;
        background: transparent;
        cursor: pointer;
        text-decoration: none !important;
        transition:
            transform .18s ease,
            background .18s ease,
            border-color .18s ease;
    }

    .booking-type-action:hover {
        transform: translateY(-2px);
    }

    .booking-type-action.view {
        color: #35624a;
        background: #eef6f0;
        border-color: #d9e9dc;
    }

    .booking-type-action.view:hover {
        background: #e1f0e5;
    }

    .booking-type-action.edit {
        color: #92712e;
        background: #faf4e4;
        border-color: #ecdfbd;
    }

    .booking-type-action.edit:hover {
        background: #f5eacd;
    }

    .booking-type-action.delete {
        color: #9b5048;
        background: #fcf0ee;
        border-color: #efd9d5;
    }

    .booking-type-action.delete:hover {
        background: #f7e2df;
    }

    .booking-type-action i {
        font-size: 12px;
    }

    /* =========================================================
       PAGINATION
       ========================================================= */

    .booking-types-pagination {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 22px 20px;
        border-top: 1px solid #eee9dc;
        background: #fffdf8;
    }

    .booking-types-pagination nav {
        margin: 0;
    }

    .booking-types-pagination svg {
        width: 18px;
        height: 18px;
    }

    /* =========================================================
       EMPTY STATE
       ========================================================= */

    .booking-types-empty {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 390px;
        padding: 45px 25px;
        text-align: center;
    }

    .booking-types-empty-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 82px;
        height: 82px;
        margin-bottom: 22px;
        border-radius: 24px;
        color: #a7833a;
        background: #f8f1df;
        border: 1px solid #ecdfbd;
        box-shadow: 0 10px 25px rgba(159, 123, 50, .08);
    }

    .booking-types-empty-icon i {
        font-size: 31px;
    }

    .booking-types-empty h3 {
        margin: 0 0 8px;
        color: #304b3b;
        font-size: 20px;
        font-weight: 800;
    }

    .booking-types-empty p {
        margin: 0 0 24px;
        color: #929589;
        font-size: 13px;
    }

    /* =========================================================
       RESPONSIVE
       ========================================================= */

    @media (max-width: 800px) {

        .booking-types-page {
            padding-top: 0;
        }

        .booking-types-header {
            align-items: flex-start;
            flex-direction: column;
            padding: 23px 20px;
            border-radius: 20px;
        }

        .booking-types-title {
            font-size: 24px;
        }

        .booking-types-subtitle {
            font-size: 13px;
        }

        .booking-types-add {
            width: 100%;
        }

        .booking-types-card {
            border-radius: 20px;
        }

        .booking-types-table {
            min-width: 950px;
        }

        .booking-types-empty {
            min-height: 340px;
        }
    }

    @media (max-width: 480px) {

        .booking-types-header {
            padding: 20px 16px;
        }

        .booking-types-title {
            font-size: 22px;
        }

        .booking-types-alert {
            font-size: 13px;
        }

        .booking-types-empty {
            padding: 35px 18px;
        }

        .booking-types-empty-icon {
            width: 72px;
            height: 72px;
        }
    }
</style>


<div class="booking-types-page">

    {{-- =========================================================
         HEADER
         ========================================================= --}}

    <div class="booking-types-header">

        <div>
            <h1 class="booking-types-title">
                {{ __('education_admin.booking_types.title') }}
            </h1>

            <p class="booking-types-subtitle">
                {{ __('education_admin.booking_types.description') }}
            </p>
        </div>

        <a
            href="{{ route('education.admin.booking-types.create') }}"
            class="booking-types-add"
        >
            <i class="fa-solid fa-plus"></i>
            {{ __('education_admin.booking_types.add_booking_type') }}
        </a>

    </div>


    {{-- =========================================================
         SUCCESS
         ========================================================= --}}

    @if(session('success'))

        <div class="booking-types-alert success">
            <i class="fa-solid fa-circle-check"></i>

            <span>
                {{ session('success') }}
            </span>
        </div>

    @endif


    {{-- =========================================================
         ERROR
         ========================================================= --}}

    @if(session('error'))

        <div class="booking-types-alert error">

            <div>
                <i class="fa-solid fa-circle-exclamation"></i>

                <span>
                    {{ session('error') }}
                </span>
            </div>

        </div>

    @endif


    {{-- =========================================================
         VALIDATION ERRORS
         ========================================================= --}}

    @if($errors->any())

        <div class="booking-types-alert error">

            @foreach($errors->all() as $error)

                <div>
                    <i class="fa-solid fa-circle-exclamation"></i>

                    <span>
                        {{ $error }}
                    </span>
                </div>

            @endforeach

        </div>

    @endif


    {{-- =========================================================
         MAIN CARD
         ========================================================= --}}

    <div class="booking-types-card">

        @if($bookingTypes->count())

            <div class="booking-types-table-wrapper">

                <table class="booking-types-table">

                    <thead>

                        <tr>

                            <th>
                                {{ __('education_admin.booking_types.table.id') }}
                            </th>

                            <th>
                                {{ __('education_admin.booking_types.table.name') }}
                            </th>

                            <th>
                                {{ __('education_admin.booking_types.table.category') }}
                            </th>

                            <th>
                                {{ __('education_admin.booking_types.table.price') }}
                            </th>

                            <th>
                                {{ __('education_admin.booking_types.table.sessions') }}
                            </th>

                            <th>
                                {{ __('education_admin.booking_types.table.duration') }}
                            </th>

                            <th>
                                {{ __('education_admin.booking_types.table.status') }}
                            </th>

                            <th>
                                {{ __('education_admin.booking_types.table.sort_order') }}
                            </th>

                            <th>
                                {{ __('education_admin.booking_types.table.actions') }}
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($bookingTypes as $bookingType)

                            <tr>

                                {{-- ID --}}
                                <td>
                                    {{ $bookingType->id }}
                                </td>


                                {{-- Name --}}
                                <td>

                                    <div class="booking-type-name">
                                        {{ $bookingType->name }}
                                    </div>

                                    @if($bookingType->description)

                                        <div class="booking-type-description">
                                            {{ \Illuminate\Support\Str::limit(
                                                $bookingType->description,
                                                70
                                            ) }}
                                        </div>

                                    @endif

                                </td>


                                {{-- Type --}}
                                <td>

                                    @if($bookingType->isPackage())

                                        <span class="booking-type-badge package">
                                            <i
                                                class="fa-solid fa-layer-group"
                                                style="margin-left:5px;"
                                            ></i>

                                            {{ __('education_admin.booking_types.category.package') }}
                                        </span>

                                    @else

                                        <span class="booking-type-badge single">
                                            <i
                                                class="fa-solid fa-book-open"
                                                style="margin-left:5px;"
                                            ></i>

                                            {{ __('education_admin.booking_types.category.single') }}
                                        </span>

                                    @endif

                                </td>


                                {{-- Price --}}
                                <td>

                                    <span class="booking-type-price">
                                        {{ number_format(
                                            (float) $bookingType->price,
                                            2
                                        ) }}
                                    </span>

                                    <span class="booking-type-currency">
                                        {{ $bookingType->currency }}
                                    </span>

                                </td>


                                {{-- Sessions --}}
                                <td>
                                    <strong>
                                        {{ $bookingType->total_sessions }}
                                    </strong>
                                </td>


                                {{-- Duration --}}
                                <td>

                                    @if($bookingType->session_duration)

                                        {{ __('education_admin.booking_types.duration_minutes', [
                                            'minutes' => $bookingType->session_duration
                                        ]) }}

                                    @else

                                        <span style="color:#aaa;">
                                            —
                                        </span>

                                    @endif

                                </td>


                                {{-- Status --}}
                                <td>

                                    @if($bookingType->is_active)

                                        <span class="booking-type-badge active">
                                            <i
                                                class="fa-solid fa-circle-check"
                                                style="margin-left:5px;"
                                            ></i>

                                            {{ __('education_admin.booking_types.status.active') }}
                                        </span>

                                    @else

                                        <span class="booking-type-badge inactive">
                                            <i
                                                class="fa-solid fa-circle-xmark"
                                                style="margin-left:5px;"
                                            ></i>

                                            {{ __('education_admin.booking_types.status.inactive') }}
                                        </span>

                                    @endif

                                </td>


                                {{-- Sort --}}
                                <td>
                                    {{ $bookingType->sort_order }}
                                </td>


                                {{-- Actions --}}
                                <td>

                                    <div class="booking-types-actions">

                                        {{-- Show --}}
                                        <a
                                            href="{{ route(
                                                'education.admin.booking-types.show',
                                                $bookingType
                                            ) }}"
                                            class="booking-type-action view"
                                            title="{{ __('education_admin.booking_types.actions.view_details') }}"
                                            aria-label="{{ __('education_admin.booking_types.actions.view_details') }}"
                                        >
                                            <i class="fa-solid fa-eye"></i>
                                        </a>


                                        {{-- Edit --}}
                                        <a
                                            href="{{ route(
                                                'education.admin.booking-types.edit',
                                                $bookingType
                                            ) }}"
                                            class="booking-type-action edit"
                                            title="{{ __('education_admin.booking_types.actions.edit') }}"
                                            aria-label="{{ __('education_admin.booking_types.actions.edit') }}"
                                        >
                                            <i class="fa-solid fa-pen"></i>
                                        </a>


                                        {{-- Delete --}}
                                        <form
                                            action="{{ route(
                                                'education.admin.booking-types.destroy',
                                                $bookingType
                                            ) }}"
                                            method="POST"
                                            onsubmit="return confirm('{{ __('education_admin.booking_types.delete_confirmation') }}');"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="booking-type-action delete"
                                                title="{{ __('education_admin.booking_types.actions.delete') }}"
                                                aria-label="{{ __('education_admin.booking_types.actions.delete') }}"
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


            {{-- =====================================================
                 PAGINATION
                 ===================================================== --}}

            @if($bookingTypes->hasPages())

                <div class="booking-types-pagination">

                    {{ $bookingTypes->links() }}

                </div>

            @endif

        @else

            {{-- =====================================================
                 EMPTY STATE
                 ===================================================== --}}

            <div class="booking-types-empty">

                <div class="booking-types-empty-icon">
                    <i class="fa-solid fa-calendar-xmark"></i>
                </div>

                <h3>
                    {{ __('education_admin.booking_types.empty.title') }}
                </h3>

                <p>
                    {{ __('education_admin.booking_types.empty.description') }}
                </p>

                <a
                    href="{{ route('education.admin.booking-types.create') }}"
                    class="booking-types-add"
                >
                    <i class="fa-solid fa-plus"></i>
                    {{ __('education_admin.booking_types.empty.add_first') }}
                </a>

            </div>

        @endif

    </div>

</div>

@endsection
