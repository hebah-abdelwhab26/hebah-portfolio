@extends('admin.layouts.app')

@section('title', __('digital_studio_admin.news.form.create_title'))

@section('content')

<div class="fade-up">

    <!-- ==========================================
                    PAGE HEADER
    ========================================== -->

    <div class="page-header">

        <div class="page-header-content">

            <div class="page-header-left">

                <div class="page-icon">
                    <i class="fa-solid fa-newspaper"></i>
                </div>

                <div>

                    <h1>
                        {{ __('digital_studio_admin.news.form.create_title') }}
                    </h1>

                    <p>
                        {{ __('digital_studio_admin.news.form.page_header.create_description') }}
                    </p>

                </div>

            </div>


            <div class="page-header-right">

                <a
                    href="{{ route('admin.news.index') }}"
                    class="btn-admin"
                >

                    <i class="fa-solid fa-arrow-left"></i>

                    {{ __('digital_studio_admin.news.form.actions.cancel') }}

                </a>

            </div>

        </div>

    </div>


    <!-- ==========================================
                    VALIDATION ERRORS
    ========================================== -->

    @if($errors->any())

        <div class="news-alert news-alert-danger">

            <div class="news-alert-icon">
                <i class="fa-solid fa-circle-exclamation"></i>
            </div>

            <div class="news-alert-content">

                <strong>
                    {{ __('digital_studio_admin.news.form.validation_title', [], app()->getLocale()) ?: 'Please check the following fields.' }}
                </strong>

                <ul>

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        </div>

    @endif


    <!-- ==========================================
                    FORM
    ========================================== -->

    <form
        action="{{ route('admin.news.store') }}"
        method="POST"
        class="news-form"
    >

        @csrf


        <div class="news-form-layout">


            <!-- ======================================
                    MAIN CONTENT
            ======================================= -->

            <div class="news-main-column">


                <!-- Main Card -->

                <div class="news-card">

                    <div class="news-card-header">

                        <div class="news-card-heading">

                            <div class="news-card-icon">
                                <i class="fa-solid fa-pen"></i>
                            </div>

                            <div>

                                <h2>
                                    {{ __('digital_studio_admin.news.form.fields.title') }}
                                </h2>

                                <p>
                                    {{ __('digital_studio_admin.news.form.help.content') }}
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="news-card-body">


                        <!-- Title -->

                        <div class="news-field">

                            <label for="title">

                                {{ __('digital_studio_admin.news.form.fields.title') }}

                                <span>*</span>

                            </label>

                            <input
                                type="text"
                                id="title"
                                name="title"
                                value="{{ old('title') }}"
                                placeholder="{{ __('digital_studio_admin.news.form.placeholders.title') }}"
                                required
                            >

                        </div>


                        <!-- Content -->

                        <div class="news-field">

                            <label for="content">

                                {{ __('digital_studio_admin.news.form.fields.content') }}

                            </label>

                            <textarea
                                id="content"
                                name="content"
                                rows="8"
                                placeholder="{{ __('digital_studio_admin.news.form.placeholders.content') }}"
                            >{{ old('content') }}</textarea>

                            <small>
                                {{ __('digital_studio_admin.news.form.help.content') }}
                            </small>

                        </div>


                        <!-- Link -->

                        <div class="news-fields-grid">

                            <div class="news-field">

                                <label for="link">

                                    {{ __('digital_studio_admin.news.form.fields.link') }}

                                </label>

                                <input
                                    type="text"
                                    id="link"
                                    name="link"
                                    value="{{ old('link') }}"
                                    placeholder="{{ __('digital_studio_admin.news.form.placeholders.link') }}"
                                >

                                <small>
                                    {{ __('digital_studio_admin.news.form.help.link') }}
                                </small>

                            </div>


                            <div class="news-field">

                                <label for="link_text">

                                    {{ __('digital_studio_admin.news.form.fields.link_text') }}

                                </label>

                                <input
                                    type="text"
                                    id="link_text"
                                    name="link_text"
                                    value="{{ old('link_text') }}"
                                    placeholder="{{ __('digital_studio_admin.news.form.placeholders.link_text') }}"
                                >

                            </div>

                        </div>


                    </div>

                </div>


                <!-- Dates Card -->

                <div class="news-card">

                    <div class="news-card-header">

                        <div class="news-card-heading">

                            <div class="news-card-icon">
                                <i class="fa-regular fa-calendar"></i>
                            </div>

                            <div>

                                <h2>
                                    {{ __('digital_studio_admin.news.form.fields.starts_at') }}
                                </h2>

                                <p>
                                    {{ __('digital_studio_admin.news.form.help.dates') }}
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="news-card-body">

                        <div class="news-fields-grid">

                            <div class="news-field">

                                <label for="starts_at">

                                    {{ __('digital_studio_admin.news.form.fields.starts_at') }}

                                </label>

                                <input
                                    type="datetime-local"
                                    id="starts_at"
                                    name="starts_at"
                                    value="{{ old('starts_at') }}"
                                >

                            </div>


                            <div class="news-field">

                                <label for="ends_at">

                                    {{ __('digital_studio_admin.news.form.fields.ends_at') }}

                                </label>

                                <input
                                    type="datetime-local"
                                    id="ends_at"
                                    name="ends_at"
                                    value="{{ old('ends_at') }}"
                                >

                            </div>

                        </div>

                    </div>

                </div>


            </div>


            <!-- ======================================
                    SIDEBAR
            ======================================= -->

            <div class="news-side-column">


                <!-- Settings Card -->

                <div class="news-card">

                    <div class="news-card-header">

                        <div class="news-card-heading">

                            <div class="news-card-icon">
                                <i class="fa-solid fa-sliders"></i>
                            </div>

                            <div>

                                <h2>
                                    {{ __('digital_studio_admin.news.form.fields.type') }}
                                </h2>

                                <p>
                                    {{ __('digital_studio_admin.news.form.fields.is_active') }}
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="news-card-body">


                        <!-- Type -->

                        <div class="news-field">

                            <label for="type">

                                {{ __('digital_studio_admin.news.form.fields.type') }}

                                <span>*</span>

                            </label>

                            <select
                                id="type"
                                name="type"
                                required
                            >

                                <option value="announcement"
                                    @selected(old('type') === 'announcement')>

                                    {{ __('digital_studio_admin.news.index.types.announcement') }}

                                </option>

                                <option value="project"
                                    @selected(old('type') === 'project')>

                                    {{ __('digital_studio_admin.news.index.types.project') }}

                                </option>

                                <option value="update"
                                    @selected(old('type') === 'update')>

                                    {{ __('digital_studio_admin.news.index.types.update') }}

                                </option>

                                <option value="notice"
                                    @selected(old('type') === 'notice')>

                                    {{ __('digital_studio_admin.news.index.types.notice') }}

                                </option>

                                <option value="general"
                                    @selected(old('type', 'general') === 'general')>

                                    {{ __('digital_studio_admin.news.index.types.general') }}

                                </option>

                            </select>

                        </div>


                        <!-- Icon -->

                        <div class="news-field">

                            <label for="icon">

                                {{ __('digital_studio_admin.news.form.fields.icon') }}

                            </label>

                            <input
                                type="text"
                                id="icon"
                                name="icon"
                                value="{{ old('icon') }}"
                                placeholder="{{ __('digital_studio_admin.news.form.placeholders.icon') }}"
                            >

                            <small>
                                {{ __('digital_studio_admin.news.form.help.icon') }}
                            </small>

                        </div>


                        <!-- Sort -->

                        <div class="news-field">

                            <label for="sort_order">

                                {{ __('digital_studio_admin.news.form.fields.sort_order') }}

                            </label>

                            <input
                                type="number"
                                id="sort_order"
                                name="sort_order"
                                min="0"
                                value="{{ old('sort_order', 0) }}"
                                placeholder="0"
                            >

                        </div>


                        <!-- Status -->

                        <div class="news-status-row">

                            <div>

                                <strong>
                                    {{ __('digital_studio_admin.news.form.fields.is_active') }}
                                </strong>

                                <span>
                                    {{ __('digital_studio_admin.news.index.status.active') }}
                                </span>

                            </div>


                            <label class="news-switch">

                                <input
                                    type="checkbox"
                                    name="is_active"
                                    value="1"
                                    @checked(old('is_active', true))
                                >

                                <span></span>

                            </label>

                        </div>


                    </div>

                </div>


                <!-- Submit Card -->

                <div class="news-submit-card">

                    <div class="news-submit-icon">
                        <i class="fa-solid fa-paper-plane"></i>
                    </div>

                    <div class="news-submit-content">

                        <strong>
                            {{ __('digital_studio_admin.news.form.actions.save') }}
                        </strong>

                        <span>
                            {{ __('digital_studio_admin.news.form.page_header.create_description') }}
                        </span>

                    </div>

                    <button
                        type="submit"
                        class="btn-admin-primary news-submit-button"
                    >

                        <i class="fa-solid fa-check"></i>

                        {{ __('digital_studio_admin.news.form.actions.save') }}

                    </button>

                </div>


            </div>

        </div>

    </form>

</div>


<style>

/* ==================================================
                    NEWS FORM
================================================== */

.news-form {
    width: 100%;
}

.news-form-layout {
    display: grid;
    grid-template-columns: minmax(0, 1.55fr) minmax(300px, .75fr);
    gap: 24px;
    align-items: start;
}

.news-main-column,
.news-side-column {
    display: flex;
    flex-direction: column;
    gap: 24px;
}


/* ==================================================
                    NEWS CARD
================================================== */

.news-card {
    position: relative;
    overflow: hidden;
    background: #ffffff;
    border: 1px solid rgba(15, 23, 42, .07);
    border-radius: 20px;
    box-shadow: 0 10px 35px rgba(15, 23, 42, .045);
}

.news-card::before {
    content: "";
    position: absolute;
    inset-inline-start: 0;
    top: 0;
    width: 3px;
    height: 100%;
    background: linear-gradient(
        180deg,
        #2563eb,
        #d4a017
    );
    opacity: .85;
}

.news-card-header {
    padding: 21px 24px;
    border-bottom: 1px solid rgba(15, 23, 42, .06);
}

.news-card-heading {
    display: flex;
    align-items: center;
    gap: 13px;
}

.news-card-icon {
    width: 43px;
    height: 43px;
    min-width: 43px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 13px;

    background:
        linear-gradient(
            135deg,
            rgba(37, 99, 235, .11),
            rgba(212, 160, 23, .10)
        );

    color: #2563eb;

    font-size: 16px;
}

.news-card-heading h2 {
    margin: 0 0 4px;

    font-size: 15px;
    font-weight: 800;

    color: #0f172a;
}

.news-card-heading p {
    margin: 0;

    font-size: 11px;
    line-height: 1.6;

    color: #64748b;
}

.news-card-body {
    padding: 24px;
}


/* ==================================================
                    FORM FIELDS
================================================== */

.news-field {
    margin-bottom: 21px;
}

.news-field:last-child {
    margin-bottom: 0;
}

.news-field label {
    display: block;

    margin-bottom: 8px;

    font-size: 12px;
    font-weight: 700;

    color: #334155;
}

.news-field label span {
    color: #dc2626;
    margin-inline-start: 2px;
}

.news-field input,
.news-field textarea,
.news-field select {
    width: 100%;

    border: 1px solid #e2e8f0;
    border-radius: 11px;

    background: #f8fafc;

    padding: 11px 13px;

    font-family: inherit;
    font-size: 13px;

    color: #0f172a;

    outline: none;

    transition:
        border-color .2s ease,
        background .2s ease,
        box-shadow .2s ease;
}

.news-field textarea {
    resize: vertical;
    min-height: 150px;
    line-height: 1.8;
}

.news-field input::placeholder,
.news-field textarea::placeholder {
    color: #94a3b8;
}

.news-field input:hover,
.news-field textarea:hover,
.news-field select:hover {
    background: #ffffff;
}

.news-field input:focus,
.news-field textarea:focus,
.news-field select:focus {
    background: #ffffff;

    border-color: #2563eb;

    box-shadow:
        0 0 0 3px rgba(37, 99, 235, .08);
}

.news-field small {
    display: block;

    margin-top: 7px;

    font-size: 10.5px;
    line-height: 1.6;

    color: #94a3b8;
}

.news-fields-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 18px;
}


/* ==================================================
                    STATUS SWITCH
================================================== */

.news-status-row {
    display: flex;

    align-items: center;
    justify-content: space-between;

    margin-top: 5px;

    padding: 14px 15px;

    border: 1px solid rgba(37, 99, 235, .08);
    border-radius: 13px;

    background:
        linear-gradient(
            135deg,
            rgba(37, 99, 235, .035),
            rgba(212, 160, 23, .035)
        );
}

.news-status-row > div {
    display: flex;
    flex-direction: column;
    gap: 3px;
}

.news-status-row strong {
    font-size: 12px;
    color: #334155;
}

.news-status-row span {
    font-size: 10px;
    color: #94a3b8;
}


/* ==================================================
                    SWITCH
================================================== */

.news-switch {
    position: relative;

    width: 44px;
    height: 24px;

    flex-shrink: 0;

    cursor: pointer;
}

.news-switch input {
    position: absolute;

    opacity: 0;

    width: 0;
    height: 0;
}

.news-switch > span {
    position: absolute;
    inset: 0;

    border-radius: 30px;

    background: #cbd5e1;

    transition: .25s ease;
}

.news-switch > span::before {
    content: "";

    position: absolute;

    width: 18px;
    height: 18px;

    top: 3px;
    inset-inline-start: 3px;

    border-radius: 50%;

    background: #ffffff;

    box-shadow: 0 2px 5px rgba(15, 23, 42, .18);

    transition: .25s ease;
}

.news-switch input:checked + span {
    background: #2563eb;
}

.news-switch input:checked + span::before {
    transform: translateX(20px);
}


/* ==================================================
                    SUBMIT CARD
================================================== */

.news-submit-card {
    display: flex;

    align-items: center;

    gap: 13px;

    padding: 17px;

    border-radius: 18px;

    background:
        linear-gradient(
            135deg,
            #08111f,
            #101d31
        );

    box-shadow:
        0 12px 30px rgba(8, 17, 31, .13);
}

.news-submit-icon {
    width: 40px;
    height: 40px;
    min-width: 40px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 11px;

    background: rgba(255,255,255,.08);

    color: #d4a017;
}

.news-submit-content {
    min-width: 0;

    display: flex;
    flex-direction: column;

    gap: 3px;
}

.news-submit-content strong {
    color: #ffffff;
    font-size: 12px;
}

.news-submit-content span {
    color: rgba(255,255,255,.55);
    font-size: 10px;
    line-height: 1.5;
}

.news-submit-button {
    margin-inline-start: auto;

    white-space: nowrap;
}


/* ==================================================
                    ALERT
================================================== */

.news-alert {
    display: flex;
    align-items: flex-start;

    gap: 12px;

    margin-bottom: 22px;

    padding: 15px 17px;

    border-radius: 14px;
}

.news-alert-danger {
    background: rgba(239, 68, 68, .07);

    border: 1px solid rgba(239, 68, 68, .12);

    color: #b91c1c;
}

.news-alert-icon {
    font-size: 16px;
    padding-top: 1px;
}

.news-alert-content {
    font-size: 12px;
    line-height: 1.7;
}

.news-alert-content strong {
    display: block;
    margin-bottom: 5px;
}

.news-alert-content ul {
    margin: 0;
    padding-inline-start: 18px;
}


/* ==================================================
                    RESPONSIVE
================================================== */

@media (max-width: 1050px) {

    .news-form-layout {
        grid-template-columns: 1fr;
    }

    .news-side-column {
        display: grid;

        grid-template-columns: 1fr 1fr;

        align-items: start;
    }

    .news-submit-card {
        grid-column: 1 / -1;
    }

}


@media (max-width: 700px) {

    .news-side-column {
        display: flex;
    }

    .news-fields-grid {
        grid-template-columns: 1fr;
        gap: 0;
    }

    .news-card-header {
        padding: 18px;
    }

    .news-card-body {
        padding: 18px;
    }

    .news-submit-card {
        align-items: flex-start;
        flex-wrap: wrap;
    }

    .news-submit-button {
        width: 100%;
        margin-inline-start: 0;

        justify-content: center;
    }

}

</style>

@endsection
