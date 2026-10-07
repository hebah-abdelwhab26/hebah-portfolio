@extends('education.admin.layouts.app')

@section('title', __('education_admin.availability_show.page_title'))

@push('styles')
<style>
    .availability-show-page {
        direction: rtl;
    }

    .availability-page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 25px;
        flex-wrap: wrap;
    }

    .availability-page-title {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .availability-page-title-icon {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(184, 146, 63, 0.12);
        color: #b8923f;
        font-size: 22px;
    }

    .availability-page-title h1 {
        margin: 0 0 5px;
        font-family: 'Cairo', sans-serif;
        font-size: 24px;
        font-weight: 700;
        color: #24352b;
    }

    .availability-page-title p {
        margin: 0;
        color: #7b827d;
        font-family: 'Cairo', sans-serif;
        font-size: 13px;
    }

    .availability-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .availability-btn {
        min-height: 42px;
        padding: 0 18px;
        border-radius: 10px;
        border: 1px solid transparent;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        text-decoration: none;
        font-family: 'Cairo', sans-serif;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.2s ease;
    }

    .availability-btn-primary {
        background: #b8923f;
        color: #fff;
    }

    .availability-btn-primary:hover {
        background: #a47f35;
        color: #fff;
        transform: translateY(-1px);
    }

    .availability-btn-secondary {
        background: #fff;
        border-color: #dedbd3;
        color: #536158;
    }

    .availability-btn-secondary:hover {
        background: #f7f5ef;
        color: #24352b;
    }

    .availability-btn-danger {
        background: #fff;
        border-color: #e6c9c9;
        color: #a33a3a;
    }

    .availability-btn-danger:hover {
        background: #fff5f5;
    }

    .availability-card {
        background: #fffdf9;
        border: 1px solid #ebe6dc;
        border-radius: 18px;
        box-shadow: 0 8px 30px rgba(36, 53, 43, 0.06);
        overflow: hidden;
        margin-bottom: 22px;
    }

    .availability-card-header {
        padding: 20px 24px;
        border-bottom: 1px solid #eee9df;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        flex-wrap: wrap;
    }

    .availability-card-header h2 {
        margin: 0;
        color: #24352b;
        font-family: 'Cairo', sans-serif;
        font-size: 17px;
        font-weight: 700;
    }

    .availability-card-body {
        padding: 24px;
    }

    .availability-main-box {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
    }

    .availability-info-item {
        background: #f8f6f0;
        border: 1px solid #ece7dc;
        border-radius: 14px;
        padding: 20px;
    }

    .availability-info-label {
        display: block;
        margin-bottom: 8px;
        color: #818780;
        font-family: 'Cairo', sans-serif;
        font-size: 12px;
        font-weight: 500;
    }

    .availability-info-value {
        display: flex;
        align-items: center;
        gap: 9px;
        color: #24352b;
        font-family: 'Cairo', sans-serif;
        font-size: 16px;
        font-weight: 700;
    }

    .availability-info-value i {
        color: #b8923f;
    }

    .availability-time-box {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 14px;
        padding: 28px;
        background: linear-gradient(
            135deg,
            #f8f1df,
            #fbf9f3
        );
        border: 1px solid #eadfca;
        border-radius: 16px;
        margin-bottom: 22px;
    }

    .availability-time {
        font-family: 'Cairo', sans-serif;
        font-size: 28px;
        font-weight: 700;
        color: #24352b;
    }

    .availability-time-separator {
        color: #b8923f;
        font-size: 20px;
    }

    .availability-status {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 7px 13px;
        border-radius: 30px;
        font-family: 'Cairo', sans-serif;
        font-size: 12px;
        font-weight: 600;
    }

    .availability-status-active {
        background: #e8f3eb;
        color: #327148;
    }

    .availability-status-inactive {
        background: #f4e8e8;
        color: #9b4141;
    }

    .availability-label-box {
        padding: 18px;
        border-radius: 14px;
        background: #f8f6f0;
        border: 1px solid #ece7dc;
    }

    .availability-label-box strong {
        display: block;
        margin-bottom: 7px;
        color: #818780;
        font-family: 'Cairo', sans-serif;
        font-size: 12px;
    }

    .availability-label-box span {
        color: #24352b;
        font-family: 'Cairo', sans-serif;
        font-size: 15px;
        font-weight: 600;
    }

    .availability-meta {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
    }

    .availability-meta-item {
        padding: 16px 18px;
        border: 1px solid #ece7dc;
        border-radius: 12px;
        background: #fff;
    }

    .availability-meta-item span {
        display: block;
        color: #8a908b;
        font-family: 'Cairo', sans-serif;
        font-size: 11px;
        margin-bottom: 5px;
    }

    .availability-meta-item strong {
        color: #34453b;
        font-family: 'Cairo', sans-serif;
        font-size: 13px;
    }

    .availability-danger-zone {
        border-color: #ecd8d8;
    }

    .availability-danger-zone .availability-card-header {
        background: #fff8f8;
        border-bottom-color: #ecd8d8;
    }

    .availability-danger-zone .availability-card-header h2 {
        color: #9b4141;
    }

    .availability-danger-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        flex-wrap: wrap;
    }

    .availability-danger-text {
        font-family: 'Cairo', sans-serif;
        color: #747a75;
        font-size: 13px;
        line-height: 1.8;
        margin: 0;
    }

    @media (max-width: 900px) {
        .availability-main-box {
            grid-template-columns: 1fr;
        }

        .availability-meta {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 600px) {
        .availability-page-header {
            align-items: stretch;
        }

        .availability-actions {
            width: 100%;
        }

        .availability-actions .availability-btn {
            flex: 1;
        }

        .availability-card-body {
            padding: 17px;
        }

        .availability-time {
            font-size: 23px;
        }

        .availability-time-box {
            padding: 22px 12px;
        }

        .availability-danger-content {
            align-items: stretch;
        }

        .availability-danger-content form,
        .availability-danger-content .availability-btn {
            width: 100%;
        }
    }
</style>
@endpush


@section('content')

<div class="availability-show-page">

    {{-- ==================================================
        PAGE HEADER
    ================================================== --}}

    <div class="availability-page-header">

        <div class="availability-page-title">

            <div class="availability-page-title-icon">
                <i class="fa-regular fa-clock"></i>
            </div>

            <div>

                <h1>
                    {{ __('education_admin.availability_show.title') }}
                </h1>

                <p>
                    {{ __('education_admin.availability_show.description') }}
                </p>

            </div>

        </div>


        <div class="availability-actions">

            <a
                href="{{ route('education.admin.availabilities.index') }}"
                class="availability-btn availability-btn-secondary"
            >
                <i class="fa-solid fa-arrow-right"></i>
                {{ __('education_admin.availability_show.back') }}
            </a>

            <a
                href="{{ route('education.admin.availabilities.edit', $availability) }}"
                class="availability-btn availability-btn-primary"
            >
                <i class="fa-solid fa-pen"></i>
                {{ __('education_admin.availability_show.edit') }}
            </a>

        </div>

    </div>


    {{-- ==================================================
        MAIN DETAILS
    ================================================== --}}

    <div class="availability-card">

        <div class="availability-card-header">

            <h2>
                {{ __('education_admin.availability_show.appointment_information') }}
            </h2>

            @if($availability->is_active)

                <span class="availability-status availability-status-active">

                    <i class="fa-solid fa-circle"></i>

                    {{ __('education_admin.availability_show.active') }}

                </span>

            @else

                <span class="availability-status availability-status-inactive">

                    <i class="fa-solid fa-circle"></i>

                    {{ __('education_admin.availability_show.inactive') }}

                </span>

            @endif

        </div>


        <div class="availability-card-body">

            {{-- TIME --}}

            <div class="availability-time-box">

                <span class="availability-time">

                    {{ \Carbon\Carbon::parse($availability->start_time)->format('h:i A') }}

                </span>

                <span class="availability-time-separator">
                    —
                </span>

                <span class="availability-time">

                    {{ \Carbon\Carbon::parse($availability->end_time)->format('h:i A') }}

                </span>

            </div>


            {{-- INFORMATION --}}

            <div class="availability-main-box">

                <div class="availability-info-item">

                    <span class="availability-info-label">
                        {{ __('education_admin.availability_show.day') }}
                    </span>

                    <div class="availability-info-value">

                        <i class="fa-regular fa-calendar"></i>

                        {{ $availability->day_name }}

                    </div>

                </div>


                <div class="availability-info-item">

                    <span class="availability-info-label">
                        {{ __('education_admin.availability_show.display_order') }}
                    </span>

                    <div class="availability-info-value">

                        <i class="fa-solid fa-arrow-down-1-9"></i>

                        {{ $availability->sort_order }}

                    </div>

                </div>


                <div class="availability-info-item">

                    <span class="availability-info-label">
                        {{ __('education_admin.availability_show.status') }}
                    </span>

                    <div class="availability-info-value">

                        <i class="fa-solid fa-toggle-on"></i>

                        {{ $availability->is_active
                            ? __('education_admin.availability_show.available_for_booking')
                            : __('education_admin.availability_show.stopped')
                        }}

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- ==================================================
        LABEL
    ================================================== --}}

    @if($availability->label)

        <div class="availability-card">

            <div class="availability-card-header">

                <h2>
                    {{ __('education_admin.availability_show.appointment_description') }}
                </h2>

            </div>

            <div class="availability-card-body">

                <div class="availability-label-box">

                    <strong>
                        {{ __('education_admin.availability_show.note') }}
                    </strong>

                    <span>
                        {{ $availability->label }}
                    </span>

                </div>

            </div>

        </div>

    @endif


    {{-- ==================================================
        META
    ================================================== --}}

    <div class="availability-card">

        <div class="availability-card-header">

            <h2>
                {{ __('education_admin.availability_show.system_information') }}
            </h2>

        </div>

        <div class="availability-card-body">

            <div class="availability-meta">

                <div class="availability-meta-item">

                    <span>
                        {{ __('education_admin.availability_show.appointment_number') }}
                    </span>

                    <strong>
                        #{{ $availability->id }}
                    </strong>

                </div>


                <div class="availability-meta-item">

                    <span>
                        {{ __('education_admin.availability_show.created_at') }}
                    </span>

                    <strong>
                        {{ $availability->created_at?->format('Y-m-d H:i') ?? __('education_admin.availability_show.no_value') }}
                    </strong>

                </div>


                <div class="availability-meta-item">

                    <span>
                        {{ __('education_admin.availability_show.updated_at') }}
                    </span>

                    <strong>
                        {{ $availability->updated_at?->format('Y-m-d H:i') ?? __('education_admin.availability_show.no_value') }}
                    </strong>

                </div>


                <div class="availability-meta-item">

                    <span>
                        {{ __('education_admin.availability_show.day_numeric') }}
                    </span>

                    <strong>
                        {{ $availability->day_of_week }}
                    </strong>

                </div>

            </div>

        </div>

    </div>


    {{-- ==================================================
        DELETE
    ================================================== --}}

    <div class="availability-card availability-danger-zone">

        <div class="availability-card-header">

            <h2>
                {{ __('education_admin.availability_show.danger_zone') }}
            </h2>

        </div>

        <div class="availability-card-body">

            <div class="availability-danger-content">

                <p class="availability-danger-text">

                    {{ __('education_admin.availability_show.delete_description') }}

                </p>


                <form
                    method="POST"
                    action="{{ route('education.admin.availabilities.destroy', $availability) }}"
                    onsubmit="return confirm(@json(__('education_admin.availability_show.delete_confirmation')));"
                >

                    @csrf

                    @method('DELETE')

                    <button
                        type="submit"
                        class="availability-btn availability-btn-danger"
                    >

                        <i class="fa-solid fa-trash"></i>

                        {{ __('education_admin.availability_show.delete_time') }}

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection
