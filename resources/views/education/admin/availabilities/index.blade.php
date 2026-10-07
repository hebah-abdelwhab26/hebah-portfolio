@extends('education.admin.layouts.app')

@section('title', __('education_admin.availabilities.page_title'))

@push('styles')

<style>

    /* ==========================================================
       EDUCATION ADMIN — AVAILABILITIES
       ========================================================== */

    .education-availability-page {
        --availability-primary: #235d70;
        --availability-primary-dark: #19495a;
        --availability-primary-soft: #eaf3f5;

        --availability-gold: #9a7b2f;
        --availability-gold-dark: #7f6425;
        --availability-gold-soft: #f7f1df;

        --availability-success: #2f7d5a;
        --availability-success-soft: #eaf6ef;

        --availability-danger: #b34b4b;
        --availability-danger-soft: #faeeee;

        --availability-warning: #a87925;
        --availability-warning-soft: #fbf4e4;

        --availability-text: #26353b;
        --availability-text-soft: #718087;

        --availability-border: #e5e9e7;
        --availability-border-soft: #eef1ef;

        --availability-card: #ffffff;
        --availability-background: #f7f5ee;

        width: 100%;
        box-sizing: border-box;

        padding: 30px;

        color: var(--availability-text);
    }


    /* ==========================================================
       PAGE HEADER
       ========================================================== */

    .education-availability-page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 25px;

        margin-bottom: 26px;
    }


    .education-availability-page-heading {
        display: flex;
        align-items: center;

        gap: 16px;

        min-width: 0;
    }


    .education-availability-page-icon {
        width: 60px;
        height: 60px;
        min-width: 60px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 18px;

        color: var(--availability-gold);

        background:
            linear-gradient(
                145deg,
                rgba(154, 123, 47, .15),
                rgba(35, 93, 112, .08)
            );

        border: 1px solid rgba(154, 123, 47, .18);

        box-shadow:
            0 10px 25px rgba(35, 93, 112, .07);

        font-size: 24px;
    }


    .education-availability-page-eyebrow {
        display: block;

        margin-bottom: 5px;

        color: var(--availability-gold);

        font-size: 11px;
        font-weight: 800;

        letter-spacing: .04em;
    }


    .education-availability-page-heading h1 {
        margin: 0;

        color: var(--availability-primary-dark);

        font-size: 30px;
        font-weight: 850;

        line-height: 1.25;
    }


    .education-availability-page-heading p {
        margin: 7px 0 0;

        color: var(--availability-text-soft);

        font-size: 13px;

        line-height: 1.8;
    }


    /* ==========================================================
       PRIMARY BUTTON
       ========================================================== */

    .education-availability-primary-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        gap: 9px;

        min-height: 45px;

        padding: 0 19px;

        border: 0;
        border-radius: 12px;

        color: #ffffff !important;

        background:
            linear-gradient(
                135deg,
                var(--availability-gold),
                var(--availability-gold-dark)
            );

        text-decoration: none !important;

        font-size: 12px;
        font-weight: 800;

        white-space: nowrap;

        box-shadow:
            0 8px 20px rgba(154, 123, 47, .18);

        transition:
            transform .2s ease,
            box-shadow .2s ease;
    }


    .education-availability-primary-btn:hover {
        color: #ffffff !important;

        transform: translateY(-2px);

        box-shadow:
            0 12px 27px rgba(154, 123, 47, .25);
    }


    .education-availability-primary-btn i {
        font-size: 11px;
    }


    /* ==========================================================
       ALERTS
       ========================================================== */

    .education-availability-alert {
        display: flex;
        align-items: center;

        gap: 13px;

        margin-bottom: 22px;

        padding: 14px 17px;

        border-radius: 14px;

        border: 1px solid transparent;

        box-shadow:
            0 6px 20px rgba(30, 45, 50, .04);
    }


    .education-availability-alert.success {
        background: var(--availability-success-soft);

        border-color: rgba(47, 125, 90, .15);
    }


    .education-availability-alert.error {
        background: var(--availability-danger-soft);

        border-color: rgba(179, 75, 75, .15);
    }


    .education-availability-alert-icon {
        width: 37px;
        height: 37px;
        min-width: 37px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 11px;

        font-size: 15px;
    }


    .education-availability-alert.success
    .education-availability-alert-icon {
        color: var(--availability-success);

        background: rgba(47, 125, 90, .10);
    }


    .education-availability-alert.error
    .education-availability-alert-icon {
        color: var(--availability-danger);

        background: rgba(179, 75, 75, .10);
    }


    .education-availability-alert-content {
        display: flex;
        flex-direction: column;

        gap: 2px;
    }


    .education-availability-alert-content strong {
        color: var(--availability-text);

        font-size: 12px;
        font-weight: 800;
    }


    .education-availability-alert-content span {
        color: var(--availability-text-soft);

        font-size: 11px;
    }


    /* ==========================================================
       STATISTICS
       ========================================================== */

    .education-availability-stats {
        display: grid;

        grid-template-columns:
            repeat(4, minmax(0, 1fr));

        gap: 15px;

        margin-bottom: 22px;
    }


    .education-availability-stat-card {
        position: relative;

        display: flex;
        align-items: center;

        gap: 13px;

        min-height: 92px;

        padding: 17px;

        overflow: hidden;

        background: var(--availability-card);

        border: 1px solid var(--availability-border);

        border-radius: 17px;

        box-shadow:
            0 7px 23px rgba(30, 45, 50, .045);

        transition:
            transform .2s ease,
            box-shadow .2s ease,
            border-color .2s ease;
    }


    .education-availability-stat-card::after {
        content: "";

        position: absolute;

        width: 80px;
        height: 80px;

        left: -35px;
        bottom: -40px;

        border-radius: 50%;

        background: rgba(35, 93, 112, .035);
    }


    .education-availability-stat-card:hover {
        transform: translateY(-2px);

        border-color: rgba(35, 93, 112, .15);

        box-shadow:
            0 13px 30px rgba(30, 45, 50, .075);
    }


    .education-availability-stat-icon {
        width: 45px;
        height: 45px;
        min-width: 45px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 13px;

        color: var(--availability-primary);

        background: var(--availability-primary-soft);

        font-size: 17px;
    }


    .education-availability-stat-icon.active {
        color: var(--availability-success);

        background: var(--availability-success-soft);
    }


    .education-availability-stat-icon.inactive {
        color: var(--availability-warning);

        background: var(--availability-warning-soft);
    }


    .education-availability-stat-content {
        display: flex;
        flex-direction: column;

        gap: 4px;
    }


    .education-availability-stat-content span {
        color: var(--availability-text-soft);

        font-size: 10px;
        font-weight: 700;
    }


    .education-availability-stat-content strong {
        color: var(--availability-primary-dark);

        font-size: 23px;
        font-weight: 850;

        line-height: 1;
    }


    /* ==========================================================
       MAIN CARD
       ========================================================== */

    .education-availability-card {
        overflow: hidden;

        background: var(--availability-card);

        border: 1px solid var(--availability-border);

        border-radius: 20px;

        box-shadow:
            0 10px 32px rgba(30, 45, 50, .055);
    }


    /* ==========================================================
       CARD HEADER
       ========================================================== */

    .education-availability-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 20px;

        padding: 21px 24px;

        background:
            linear-gradient(
                135deg,
                rgba(35, 93, 112, .045),
                rgba(154, 123, 47, .035)
            );

        border-bottom: 1px solid var(--availability-border-soft);
    }


    .education-availability-card-header h2 {
        margin: 0;

        color: var(--availability-primary-dark);

        font-size: 16px;
        font-weight: 850;
    }


    .education-availability-card-header p {
        margin: 5px 0 0;

        color: var(--availability-text-soft);

        font-size: 11px;

        line-height: 1.7;
    }


    .education-availability-card-header-icon {
        width: 42px;
        height: 42px;
        min-width: 42px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 12px;

        color: var(--availability-gold);

        background: var(--availability-gold-soft);

        border: 1px solid rgba(154, 123, 47, .12);

        font-size: 15px;
    }


    /* ==========================================================
       TABLE WRAPPER
       ========================================================== */

    .education-availability-table-wrapper {
        width: 100%;

        overflow-x: auto;

        scrollbar-width: thin;

        scrollbar-color:
            rgba(35, 93, 112, .22)
            transparent;
    }


    .education-availability-table-wrapper::-webkit-scrollbar {
        height: 6px;
    }


    .education-availability-table-wrapper::-webkit-scrollbar-track {
        background: transparent;
    }


    .education-availability-table-wrapper::-webkit-scrollbar-thumb {
        background: rgba(35, 93, 112, .20);

        border-radius: 20px;
    }


    /* ==========================================================
       TABLE
       ========================================================== */

    .education-availability-table {
        width: 100%;

        min-width: 920px;

        border-collapse: separate;

        border-spacing: 0;

        text-align: start;
    }


    .education-availability-table thead th {
        padding: 14px 17px;

        color: #748187;

        background: #fafbf8;

        border-bottom: 1px solid var(--availability-border);

        font-size: 10px;
        font-weight: 850;

        white-space: nowrap;
    }


    .education-availability-table tbody td {
        padding: 16px 17px;

        border-bottom: 1px solid var(--availability-border-soft);

        vertical-align: middle;

        font-size: 11px;
    }


    .education-availability-table tbody tr {
        transition: background .18s ease;
    }


    .education-availability-table tbody tr:hover {
        background: #fcfcfa;
    }


    .education-availability-table tbody tr:last-child td {
        border-bottom: 0;
    }


    /* ==========================================================
       NUMBER
       ========================================================== */

    .education-availability-row-number {
        width: 29px;
        height: 29px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        border-radius: 9px;

        color: var(--availability-primary);

        background: var(--availability-primary-soft);

        font-size: 10px;
        font-weight: 800;
    }


    /* ==========================================================
       DAY
       ========================================================== */

    .education-availability-day {
        display: flex;
        align-items: center;

        gap: 10px;

        min-width: 145px;
    }


    .education-availability-day-icon {
        width: 38px;
        height: 38px;
        min-width: 38px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 11px;

        color: var(--availability-gold);

        background: var(--availability-gold-soft);

        font-size: 14px;
    }


    .education-availability-day strong {
        display: block;

        color: var(--availability-primary-dark);

        font-size: 12px;
        font-weight: 800;

        line-height: 1.5;
    }


    .education-availability-day span {
        display: block;

        margin-top: 2px;

        color: var(--availability-text-soft);

        font-size: 9px;
    }


    /* ==========================================================
       TIME
       ========================================================== */

    .education-availability-time {
        min-width: 155px;
    }


    .education-availability-time-main {
        display: flex;
        align-items: center;

        gap: 6px;

        white-space: nowrap;
    }


    .education-availability-time-main > i {
        color: var(--availability-primary);

        font-size: 11px;
    }


    .education-availability-time-main strong {
        color: var(--availability-text);

        font-size: 11px;
        font-weight: 800;
    }


    .education-availability-time-main span {
        color: #a0aaad;
    }


    .education-availability-duration {
        display: inline-block;

        margin-top: 5px;

        padding: 3px 7px;

        color: var(--availability-text-soft);

        background: #f5f7f4;

        border-radius: 6px;

        font-size: 8px;
        font-weight: 700;
    }


    /* ==========================================================
       DESCRIPTION
       ========================================================== */

    .education-availability-label {
        display: inline-block;

        max-width: 220px;

        padding: 6px 9px;

        color: var(--availability-text);

        background: #f7f8f5;

        border: 1px solid #edf0ec;

        border-radius: 8px;

        font-size: 10px;

        line-height: 1.5;
    }


    .education-availability-empty {
        color: #a2abad;

        font-size: 10px;

        font-style: italic;
    }


    /* ==========================================================
       SORT ORDER
       ========================================================== */

    .education-availability-order {
        width: 29px;
        height: 29px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        border-radius: 8px;

        color: #657278;

        background: #f3f5f3;

        font-size: 10px;
        font-weight: 800;
    }


    /* ==========================================================
       STATUS
       ========================================================== */

    .education-availability-status {
        display: inline-flex;
        align-items: center;

        gap: 6px;

        padding: 6px 9px;

        border-radius: 8px;

        font-size: 9px;
        font-weight: 800;

        white-space: nowrap;
    }


    .education-availability-status i {
        font-size: 5px;
    }


    .education-availability-status.active {
        color: var(--availability-success);

        background: var(--availability-success-soft);
    }


    .education-availability-status.inactive {
        color: var(--availability-warning);

        background: var(--availability-warning-soft);
    }


    /* ==========================================================
       ACTIONS
       ========================================================== */

    .education-availability-actions {
        display: flex;
        align-items: center;

        gap: 6px;

        white-space: nowrap;
    }


    .education-availability-actions form {
        margin: 0;
        padding: 0;
    }


    .education-availability-action {
        width: 32px;
        height: 32px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        padding: 0;

        border: 1px solid transparent;

        border-radius: 9px;

        text-decoration: none;

        cursor: pointer;

        transition:
            transform .18s ease,
            background .18s ease,
            border-color .18s ease;
    }


    .education-availability-action:hover {
        transform: translateY(-1px);
    }


    .education-availability-action.view {
        color: var(--availability-primary);

        background: var(--availability-primary-soft);
    }


    .education-availability-action.view:hover {
        background: #dfecef;

        border-color: rgba(35, 93, 112, .15);
    }


    .education-availability-action.edit {
        color: var(--availability-gold-dark);

        background: var(--availability-gold-soft);
    }


    .education-availability-action.edit:hover {
        background: #f1e9ce;

        border-color: rgba(154, 123, 47, .15);
    }


    .education-availability-action.delete {
        color: var(--availability-danger);

        background: var(--availability-danger-soft);
    }


    .education-availability-action.delete:hover {
        background: #f7e2e2;

        border-color: rgba(179, 75, 75, .15);
    }


    .education-availability-action i {
        font-size: 10px;
    }


    /* ==========================================================
       PAGINATION
       ========================================================== */

    .education-availability-pagination {
        display: flex;
        align-items: center;
        justify-content: center;

        padding: 18px 22px;

        background: #fcfcfa;

        border-top: 1px solid var(--availability-border-soft);
    }


    .education-availability-pagination nav {
        width: 100%;
    }


    .education-availability-pagination nav > div:first-child {
        display: none;
    }


    .education-availability-pagination nav > div:last-child {
        display: flex;
        align-items: center;
        justify-content: center;
    }


    .education-availability-pagination svg {
        width: 14px;
        height: 14px;
    }


    .education-availability-pagination a,
    .education-availability-pagination span {
        min-width: 33px;
        height: 33px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        margin: 0 2px;

        border-radius: 9px;

        font-size: 10px;
        font-weight: 700;

        text-decoration: none;
    }


    .education-availability-pagination a {
        color: var(--availability-primary);

        background: #ffffff;

        border: 1px solid var(--availability-border);
    }


    .education-availability-pagination a:hover {
        color: #ffffff;

        background: var(--availability-primary);

        border-color: var(--availability-primary);
    }


    .education-availability-pagination span[aria-current="page"] {
        color: #ffffff;

        background: var(--availability-primary);

        border: 1px solid var(--availability-primary);
    }


    .education-availability-pagination span[aria-disabled="true"] {
        color: #aeb7b8;

        background: #f5f6f4;

        border: 1px solid #edf0ed;
    }


    /* ==========================================================
       EMPTY STATE
       ========================================================== */

    .education-availability-empty-state {
        display: flex;
        align-items: center;
        flex-direction: column;

        padding: 65px 25px 72px;

        text-align: center;
    }


    .education-availability-empty-icon {
        width: 76px;
        height: 76px;

        display: flex;
        align-items: center;
        justify-content: center;

        margin-bottom: 17px;

        color: var(--availability-primary);

        background:
            linear-gradient(
                145deg,
                var(--availability-primary-soft),
                #f5f7f3
            );

        border: 1px solid rgba(35, 93, 112, .10);

        border-radius: 22px;

        box-shadow:
            0 10px 25px rgba(35, 93, 112, .06);

        font-size: 28px;
    }


    .education-availability-empty-state h3 {
        margin: 0;

        color: var(--availability-primary-dark);

        font-size: 18px;
        font-weight: 850;
    }


    .education-availability-empty-state p {
        max-width: 450px;

        margin: 8px auto 22px;

        color: var(--availability-text-soft);

        font-size: 11px;

        line-height: 1.8;
    }


    /* ==========================================================
       LTR
       ========================================================== */

    html[dir="ltr"] .education-availability-page {
        direction: ltr;
    }


    html[dir="ltr"] .education-availability-table {
        text-align: left;
    }


    /* ==========================================================
       TABLET
       ========================================================== */

    @media (max-width: 1200px) {

        .education-availability-page {
            padding: 25px 22px 38px;
        }

        .education-availability-stats {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

    }


    /* ==========================================================
       MOBILE
       ========================================================== */

    @media (max-width: 760px) {

        .education-availability-page {
            padding: 20px 14px 30px;
        }


        .education-availability-page-header {
            align-items: flex-start;

            flex-direction: column;

            gap: 17px;
        }


        .education-availability-page-heading {
            width: 100%;

            align-items: flex-start;

            gap: 12px;
        }


        .education-availability-page-icon {
            width: 48px;
            height: 48px;
            min-width: 48px;

            border-radius: 14px;

            font-size: 19px;
        }


        .education-availability-page-heading h1 {
            font-size: 23px;
        }


        .education-availability-page-heading p {
            font-size: 11px;
        }


        .education-availability-page-header
        .education-availability-primary-btn {
            width: 100%;
        }


        .education-availability-stats {
            grid-template-columns: repeat(2, minmax(0, 1fr));

            gap: 10px;
        }


        .education-availability-stat-card {
            min-height: 78px;

            padding: 12px;

            border-radius: 13px;

            gap: 9px;
        }


        .education-availability-stat-icon {
            width: 37px;
            height: 37px;
            min-width: 37px;

            border-radius: 10px;

            font-size: 14px;
        }


        .education-availability-stat-content span {
            font-size: 9px;
        }


        .education-availability-stat-content strong {
            font-size: 19px;
        }


        .education-availability-card {
            border-radius: 16px;
        }


        .education-availability-card-header {
            padding: 16px;
        }


        .education-availability-card-header h2 {
            font-size: 14px;
        }


        .education-availability-card-header p {
            font-size: 10px;
        }


        .education-availability-table {
            min-width: 850px;
        }


        .education-availability-empty-state {
            padding: 48px 20px 55px;
        }


        .education-availability-empty-icon {
            width: 65px;
            height: 65px;

            border-radius: 18px;

            font-size: 24px;
        }

    }


    /* ==========================================================
       SMALL MOBILE
       ========================================================== */

    @media (max-width: 390px) {

        .education-availability-page {
            padding-inline: 11px;
        }


        .education-availability-stats {
            gap: 8px;
        }


        .education-availability-stat-card {
            padding: 10px;
        }


        .education-availability-stat-icon {
            width: 34px;
            height: 34px;
            min-width: 34px;
        }


        .education-availability-stat-content strong {
            font-size: 18px;
        }

    }

</style>

@endpush

@section('content')

<div class="education-availability-page">

{{-- ==========================================================
    PAGE HEADER
=========================================================== --}}

<div class="education-availability-page-header">

    <div class="education-availability-page-heading">

        <div class="education-availability-page-icon">
            <i class="fa-regular fa-clock"></i>
        </div>

        <div>

            <span class="education-availability-page-eyebrow">
                {{ __('education_admin.availabilities.eyebrow') }}
            </span>

            <h1>
                {{ __('education_admin.availabilities.title') }}
            </h1>

            <p>
                {{ __('education_admin.availabilities.description') }}
            </p>

        </div>

    </div>


    <a
        href="{{ route('education.admin.availabilities.create') }}"
        class="education-availability-primary-btn"
    >

        <i class="fa-solid fa-plus"></i>

        <span>
            {{ __('education_admin.availabilities.add_time') }}
        </span>

    </a>

</div>


{{-- ==========================================================
    FLASH MESSAGES
=========================================================== --}}

@if(session('success'))

    <div class="education-availability-alert success">

        <div class="education-availability-alert-icon">
            <i class="fa-solid fa-circle-check"></i>
        </div>

        <div class="education-availability-alert-content">

            <strong>
                {{ __('education_admin.common.operation_success') }}
            </strong>

            <span>
                {{ session('success') }}
            </span>

        </div>

    </div>

@endif


@if(session('error'))

    <div class="education-availability-alert error">

        <div class="education-availability-alert-icon">
            <i class="fa-solid fa-circle-exclamation"></i>
        </div>

        <div class="education-availability-alert-content">

            <strong>
                {{ __('education_admin.common.operation_failed') }}
            </strong>

            <span>
                {{ session('error') }}
            </span>

        </div>

    </div>

@endif


{{-- ==========================================================
    STATISTICS
=========================================================== --}}

@php

    $totalAvailabilities = $bookingTypesCount ?? null;

    $activeCount = $bookingTypesActiveCount ?? null;

    $currentItems = $availabilities ?? $bookingTypes ?? collect();

    $activeItems = $currentItems->where('is_active', true);

@endphp


<div class="education-availability-stats">

    <div class="education-availability-stat-card">

        <div class="education-availability-stat-icon">
            <i class="fa-regular fa-calendar"></i>
        </div>

        <div class="education-availability-stat-content">

            <span>
                {{ __('education_admin.availabilities.total_times') }}
            </span>

            <strong>
                {{ method_exists($currentItems, 'total') ? $currentItems->total() : $currentItems->count() }}
            </strong>

        </div>

    </div>


    <div class="education-availability-stat-card">

        <div class="education-availability-stat-icon active">
            <i class="fa-solid fa-circle-check"></i>
        </div>

        <div class="education-availability-stat-content">

            <span>
                {{ __('education_admin.availabilities.active_times') }}
            </span>

            <strong>
                {{ $activeItems->count() }}
            </strong>

        </div>

    </div>


    <div class="education-availability-stat-card">

        <div class="education-availability-stat-icon inactive">
            <i class="fa-solid fa-circle-pause"></i>
        </div>

        <div class="education-availability-stat-content">

            <span>
                {{ __('education_admin.availabilities.inactive_times') }}
            </span>

            <strong>
                {{
                    (
                        method_exists($currentItems, 'total')
                            ? $currentItems->total()
                            : $currentItems->count()
                    ) - $activeItems->count()
                }}
            </strong>

        </div>

    </div>


    <div class="education-availability-stat-card">

        <div class="education-availability-stat-icon">
            <i class="fa-solid fa-calendar-week"></i>
        </div>

        <div class="education-availability-stat-content">

            <span>
                {{ __('education_admin.availabilities.week_days') }}
            </span>

            <strong>
                {{ $currentItems->pluck('day_of_week')->unique()->count() }}
            </strong>

        </div>

    </div>

</div>


{{-- ==========================================================
    MAIN CARD
=========================================================== --}}

<div class="education-availability-card">

    <div class="education-availability-card-header">

        <div>

            <h2>
                {{ __('education_admin.availabilities.schedule_title') }}
            </h2>

            <p>
                {{ __('education_admin.availabilities.schedule_description') }}
            </p>

        </div>

        <div class="education-availability-card-header-icon">
            <i class="fa-solid fa-clock"></i>
        </div>

    </div>


    {{-- ======================================================
        TABLE
    ======================================================= --}}

    @if($currentItems->count())

        <div class="education-availability-table-wrapper">

            <table class="education-availability-table">

                <thead>

                    <tr>

                        <th>#</th>

                        <th>
                            {{ __('education_admin.availabilities.day') }}
                        </th>

                        <th>
                            {{ __('education_admin.availabilities.time') }}
                        </th>

                        <th>
                            {{ __('education_admin.availabilities.description_label') }}
                        </th>

                        <th>
                            {{ __('education_admin.availabilities.sort_order') }}
                        </th>

                        <th>
                            {{ __('education_admin.availabilities.status') }}
                        </th>

                        <th>
                            {{ __('education_admin.availabilities.actions') }}
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @foreach($currentItems as $availability)

                        <tr>

                            {{-- NUMBER --}}

                            <td>

                                <span class="education-availability-row-number">

                                    @if(method_exists($currentItems, 'firstItem'))

                                        {{ $currentItems->firstItem() + $loop->index }}

                                    @else

                                        {{ $loop->iteration }}

                                    @endif

                                </span>

                            </td>


                            {{-- DAY --}}

                            <td>

                                <div class="education-availability-day">

                                    <div class="education-availability-day-icon">

                                        <i class="fa-regular fa-calendar-days"></i>

                                    </div>

                                    <div>

                                        <strong>
                                            {{ $availability->day_name }}
                                        </strong>

                                        <span>
                                            {{ __('education_admin.availabilities.day_number', [
                                                'day' => $availability->day_of_week
                                            ]) }}
                                        </span>

                                    </div>

                                </div>

                            </td>


                            {{-- TIME --}}

                            <td>

                                <div class="education-availability-time">

                                    <div class="education-availability-time-main">

                                        <i class="fa-regular fa-clock"></i>

                                        <strong>
                                            {{ \Carbon\Carbon::parse($availability->start_time)->format('H:i') }}
                                        </strong>

                                        <span>—</span>

                                        <strong>
                                            {{ \Carbon\Carbon::parse($availability->end_time)->format('H:i') }}
                                        </strong>

                                    </div>


                                    @php

                                        $start = \Carbon\Carbon::parse($availability->start_time);
                                        $end = \Carbon\Carbon::parse($availability->end_time);

                                        $duration = $start->diffInMinutes($end);

                                    @endphp


                                    <span class="education-availability-duration">

                                        {{ __('education_admin.availabilities.duration_minutes', [
                                            'minutes' => $duration
                                        ]) }}

                                    </span>

                                </div>

                            </td>


                            {{-- LABEL --}}

                            <td>

                                @if($availability->label)

                                    <span class="education-availability-label">
                                        {{ $availability->label }}
                                    </span>

                                @else

                                    <span class="education-availability-empty">
                                        {{ __('education_admin.availabilities.no_description') }}
                                    </span>

                                @endif

                            </td>


                            {{-- SORT ORDER --}}

                            <td>

                                <span class="education-availability-order">
                                    {{ $availability->sort_order }}
                                </span>

                            </td>


                            {{-- STATUS --}}

                            <td>

                                @if($availability->is_active)

                                    <span class="education-availability-status active">

                                        <i class="fa-solid fa-circle"></i>

                                        {{ __('education_admin.availabilities.available') }}

                                    </span>

                                @else

                                    <span class="education-availability-status inactive">

                                        <i class="fa-solid fa-circle"></i>

                                        {{ __('education_admin.availabilities.unavailable') }}

                                    </span>

                                @endif

                            </td>


                            {{-- ACTIONS --}}

                            <td>

                                <div class="education-availability-actions">

                                    <a
                                        href="{{ route(
                                            'education.admin.availabilities.show',
                                            $availability
                                        ) }}"
                                        class="education-availability-action view"
                                        title="{{ __('education_admin.common.view') }}"
                                        aria-label="{{ __('education_admin.common.view') }}"
                                    >

                                        <i class="fa-regular fa-eye"></i>

                                    </a>


                                    <a
                                        href="{{ route(
                                            'education.admin.availabilities.edit',
                                            $availability
                                        ) }}"
                                        class="education-availability-action edit"
                                        title="{{ __('education_admin.common.edit') }}"
                                        aria-label="{{ __('education_admin.common.edit') }}"
                                    >

                                        <i class="fa-solid fa-pen"></i>

                                    </a>


                                    <form
                                        method="POST"
                                        action="{{ route(
                                            'education.admin.availabilities.destroy',
                                            $availability
                                        ) }}"
                                        onsubmit="return confirm(@json(
                                            __('education_admin.availabilities.delete_confirmation')
                                        ));"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="education-availability-action delete"
                                            title="{{ __('education_admin.common.delete') }}"
                                            aria-label="{{ __('education_admin.common.delete') }}"
                                        >

                                            <i class="fa-regular fa-trash-can"></i>

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
        =================================================== --}}

        @if(method_exists($currentItems, 'links'))

            <div class="education-availability-pagination">

                {{ $currentItems->links() }}

            </div>

        @endif

    @else

        {{-- ==================================================
            EMPTY STATE
        =================================================== --}}

        <div class="education-availability-empty-state">

            <div class="education-availability-empty-icon">
                <i class="fa-regular fa-clock"></i>
            </div>

            <h3>
                {{ __('education_admin.availabilities.empty_title') }}
            </h3>

            <p>
                {{ __('education_admin.availabilities.empty_description') }}
            </p>

            <a
                href="{{ route('education.admin.availabilities.create') }}"
                class="education-availability-primary-btn"
            >

                <i class="fa-solid fa-plus"></i>

                {{ __('education_admin.availabilities.add_first_time') }}

            </a>

        </div>

    @endif

</div>

</div>

@endsection
