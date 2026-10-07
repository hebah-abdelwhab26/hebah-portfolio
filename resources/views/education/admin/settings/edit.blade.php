@extends('education.admin.layouts.app')

@section('title', __('education_admin.settings.page_title'))

@section('content')

<div class="container-fluid py-4">

    {{-- ========================================================= --}}
    {{-- PAGE HEADER --}}
    {{-- ========================================================= --}}

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="h3 mb-1">
                {{ __('education_admin.settings.title') }}
            </h1>

            <p class="text-muted mb-0">
                {{ __('education_admin.settings.description') }}
            </p>
        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- SUCCESS MESSAGE --}}
    {{-- ========================================================= --}}

    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show" role="alert">

            <i class="fa-solid fa-circle-check me-2"></i>

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="{{ __('education_admin.settings.actions.close') }}">
            </button>

        </div>

    @endif


    {{-- ========================================================= --}}
    {{-- VALIDATION ERRORS --}}
    {{-- ========================================================= --}}

    @if($errors->any())

        <div class="alert alert-danger">

            <div class="fw-bold mb-2">
                {{ __('education_admin.settings.alerts.validation_title') }}
            </div>

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- ========================================================= --}}
    {{-- PAYMENT SETTINGS CARD --}}
    {{-- ========================================================= --}}

    <div class="card education-settings-card">

        <div class="card-header">

            <div class="d-flex align-items-center gap-2">

                <div class="settings-icon">
                    <i class="fa-solid fa-credit-card"></i>
                </div>

                <div>

                    <h5 class="mb-0">
                        {{ __('education_admin.settings.payment.section_title') }}
                    </h5>

                    <small>
                        {{ __('education_admin.settings.payment.section_description') }}
                    </small>

                </div>

            </div>

        </div>


        <div class="card-body">

            <form
                action="{{ route('education.admin.settings.update') }}"
                method="POST"
            >

                @csrf

                @method('PUT')


                {{-- ================================================= --}}
                {{-- PAYMENT STATUS --}}
                {{-- ================================================= --}}

                <div class="settings-section">

                    <div class="section-title">

                        <i class="fa-solid fa-toggle-on"></i>

                        {{ __('education_admin.settings.payment.status_section') }}

                    </div>


                    <div class="payment-status-box">

                        <div>

                            <div class="fw-bold">
                                {{ __('education_admin.settings.payment.receiving_payments') }}
                            </div>

                            <div class="text-muted small">
                                {{ __('education_admin.settings.payment.receiving_payments_description') }}
                            </div>

                        </div>


                        <div class="form-check form-switch">

                            <input
                                class="form-check-input"
                                type="checkbox"
                                role="switch"
                                id="payment_enabled"
                                name="payment_enabled"
                                value="1"
                                {{ old('payment_enabled', $settings->payment_enabled) ? 'checked' : '' }}
                            >

                            <label
                                class="form-check-label"
                                for="payment_enabled"
                            >
                                {{ __('education_admin.settings.payment.enable') }}
                            </label>

                        </div>

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- BANK INFORMATION --}}
                {{-- ================================================= --}}

                <div class="settings-section">

                    <div class="section-title">

                        <i class="fa-solid fa-building-columns"></i>

                        {{ __('education_admin.settings.payment.bank_section') }}

                    </div>


                    <div class="row g-4">


                        {{-- BANK NAME --}}
                        <div class="col-md-6">

                            <label
                                for="bank_name"
                                class="form-label"
                            >
                                {{ __('education_admin.settings.payment.bank_name') }}
                            </label>

                            <input
                                type="text"
                                id="bank_name"
                                name="bank_name"
                                class="form-control"
                                value="{{ old('bank_name', $settings->bank_name) }}"
                                placeholder="{{ __('education_admin.settings.payment.bank_name_placeholder') }}"
                            >

                        </div>


                        {{-- ACCOUNT NAME --}}
                        <div class="col-md-6">

                            <label
                                for="account_name"
                                class="form-label"
                            >
                                {{ __('education_admin.settings.payment.account_name') }}
                            </label>

                            <input
                                type="text"
                                id="account_name"
                                name="account_name"
                                class="form-control"
                                value="{{ old('account_name', $settings->account_name) }}"
                                placeholder="{{ __('education_admin.settings.payment.account_name_placeholder') }}"
                            >

                        </div>


                        {{-- ACCOUNT NUMBER --}}
                        <div class="col-md-6">

                            <label
                                for="account_number"
                                class="form-label"
                            >
                                {{ __('education_admin.settings.payment.account_number') }}
                            </label>

                            <input
                                type="text"
                                id="account_number"
                                name="account_number"
                                class="form-control"
                                value="{{ old('account_number', $settings->account_number) }}"
                                placeholder="{{ __('education_admin.settings.payment.account_number_placeholder') }}"
                                dir="ltr"
                            >

                        </div>


                        {{-- IBAN --}}
                        <div class="col-md-6">

                            <label
                                for="iban"
                                class="form-label"
                            >
                                {{ __('education_admin.settings.payment.iban') }}
                            </label>

                            <input
                                type="text"
                                id="iban"
                                name="iban"
                                class="form-control"
                                value="{{ old('iban', $settings->iban) }}"
                                placeholder="{{ __('education_admin.settings.payment.iban_placeholder') }}"
                                dir="ltr"
                            >

                        </div>

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- PAYMENT INSTRUCTIONS --}}
                {{-- ================================================= --}}

                <div class="settings-section">

                    <div class="section-title">

                        <i class="fa-solid fa-circle-info"></i>

                        {{ __('education_admin.settings.payment.instructions_section') }}

                    </div>


                    <div>

                        <label
                            for="payment_instructions"
                            class="form-label"
                        >
                            {{ __('education_admin.settings.payment.instructions_label') }}
                        </label>

                        <textarea
                            id="payment_instructions"
                            name="payment_instructions"
                            class="form-control"
                            rows="6"
                            placeholder="{{ __('education_admin.settings.payment.instructions_placeholder') }}"
                        >{{ old('payment_instructions', $settings->payment_instructions) }}</textarea>

                        <div class="form-text">
                            {{ __('education_admin.settings.payment.instructions_help') }}
                        </div>

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- ACTIONS --}}
                {{-- ================================================= --}}

                <div class="settings-actions">

                    <button
                        type="submit"
                        class="btn btn-save"
                    >

                        <i class="fa-solid fa-floppy-disk me-2"></i>

                        {{ __('education_admin.settings.actions.save') }}

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- ============================================================= --}}
{{-- PAGE STYLE --}}
{{-- ============================================================= --}}

<style>

    .education-settings-card {
        border: 0;
        border-radius: 18px;
        overflow: hidden;
        background: #fffdf8;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.07);
    }


    .education-settings-card .card-header {
        background: #f7f0df;
        border-bottom: 1px solid #e5d6b5;
        padding: 22px 25px;
        color: #315c43;
    }


    .education-settings-card .card-header small {
        color: #806f50;
    }


    .settings-icon {
        width: 46px;
        height: 46px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #c7a45a;
        color: #ffffff;
        font-size: 18px;
    }


    .education-settings-card .card-body {
        padding: 30px;
    }


    .settings-section {
        padding-bottom: 28px;
        margin-bottom: 28px;
        border-bottom: 1px solid #eadfc9;
    }


    .settings-section:last-of-type {
        border-bottom: 0;
        margin-bottom: 0;
    }


    .section-title {
        display: flex;
        align-items: center;
        gap: 9px;
        color: #315c43;
        font-weight: 700;
        font-size: 17px;
        margin-bottom: 20px;
    }


    .section-title i {
        color: #b28a3c;
    }


    .form-label {
        color: #4a4a3d;
        font-weight: 600;
        margin-bottom: 8px;
    }


    .form-control {
        border: 1px solid #ddd2bb;
        border-radius: 10px;
        min-height: 46px;
        background: #fffefa;
    }


    .form-control:focus {
        border-color: #b28a3c;
        box-shadow: 0 0 0 0.2rem rgba(178, 138, 60, 0.12);
    }


    textarea.form-control {
        min-height: 140px;
        resize: vertical;
    }


    .payment-status-box {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        padding: 18px 20px;
        border-radius: 12px;
        background: #f8f4e9;
        border: 1px solid #e5d6b5;
    }


    .form-check-input {
        width: 2.7em;
        height: 1.4em;
        cursor: pointer;
    }


    .form-check-input:checked {
        background-color: #315c43;
        border-color: #315c43;
    }


    .form-check-label {
        margin-right: 8px;
        color: #315c43;
        font-weight: 600;
        cursor: pointer;
    }


    .settings-actions {
        display: flex;
        justify-content: flex-end;
        padding-top: 10px;
    }


    .btn-save {
        border: 0;
        border-radius: 10px;
        padding: 12px 25px;
        background: #315c43;
        color: #ffffff;
        font-weight: 700;
        transition: all 0.2s ease;
    }


    .btn-save:hover {
        background: #244833;
        color: #ffffff;
        transform: translateY(-1px);
    }


    @media (max-width: 768px) {

        .education-settings-card .card-body {
            padding: 20px;
        }

        .payment-status-box {
            align-items: flex-start;
            flex-direction: column;
        }

        .settings-actions {
            justify-content: stretch;
        }

        .btn-save {
            width: 100%;
        }

    }

</style>

@endsection
