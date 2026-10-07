@extends('education.admin.layouts.app')

@section('title', __('education_admin.lessons.content_create.page_title'))

@section('content')

<style>
/* =========================================================
   EDUCATION CONTENT CREATE
   Cream / Olive Green / Gold
========================================================= */

.education-content-create-page {
    direction: rtl;
    color: #30372a;
    padding-bottom: 50px;
}

/* =========================================================
   HEADER
========================================================= */

.education-content-create-header {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 25px;
    margin-bottom: 28px;
}

.education-content-create-heading {
    flex: 1;
}

.education-content-create-label {
    display: inline-flex;
    align-items: center;
    gap: 9px;
    color: #8c6a2d;
    font-size: 14px;
    font-weight: 700;
    margin-bottom: 10px;
}

.education-content-create-label i {
    color: #c69b45;
}

.education-content-create-title {
    display: flex;
    align-items: center;
    gap: 15px;
}

.education-content-create-title-icon {
    width: 54px;
    height: 54px;
    flex-shrink: 0;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #d4ad61, #b98a38);
    color: #fffdf7;
    font-size: 21px;
    box-shadow: 0 10px 25px rgba(181, 139, 61, .18);
}

.education-content-create-title h1 {
    margin: 0;
    color: #30372a;
    font-size: 29px;
    font-weight: 800;
}

.education-content-create-title p {
    margin: 7px 0 0;
    color: #7c8175;
    font-size: 14px;
    line-height: 1.8;
}

.education-content-create-heading > p {
    margin: 10px 0 0;
    color: #7c8175;
    font-size: 14px;
    line-height: 1.8;
}

/* =========================================================
   BACK
========================================================= */

.education-content-create-back {
    flex-shrink: 0;
    display: inline-flex;
    align-items: center;
    gap: 9px;
    min-height: 46px;
    padding: 0 18px;
    border: 1px solid #ded8c9;
    border-radius: 13px;
    background: #fffdf8;
    color: #59604e;
    text-decoration: none;
    font-size: 14px;
    font-weight: 700;
    transition: .25s ease;
}

.education-content-create-back:hover {
    color: #3f4a2f;
    border-color: #c9b98d;
    background: #f8f3e7;
    transform: translateY(-2px);
}

/* =========================================================
   LESSON INFO
========================================================= */

.education-content-create-lesson-info {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    padding: 18px 21px;
    margin-bottom: 24px;
    border: 1px solid #e3dccb;
    border-radius: 18px;
    background: #f9f5eb;
}

.education-content-create-lesson-main {
    min-width: 0;
    display: flex;
    align-items: center;
    gap: 14px;
}

.education-content-create-lesson-icon {
    width: 46px;
    height: 46px;
    flex-shrink: 0;
    border-radius: 13px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #465236;
    color: #e1bc6d;
    font-size: 18px;
}

.education-content-create-lesson-main span {
    display: block;
    color: #8b8f83;
    font-size: 12px;
    margin-bottom: 3px;
}

.education-content-create-lesson-main strong {
    display: block;
    color: #343b2d;
    font-size: 16px;
    font-weight: 800;
    overflow-wrap: anywhere;
}

.education-content-create-lesson-category {
    flex-shrink: 0;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 7px 12px;
    border-radius: 20px;
    background: #fffdf8;
    border: 1px solid #e4dccb;
    color: #74602e;
    font-size: 12px;
    font-weight: 700;
}

/* =========================================================
   ERRORS
========================================================= */

.education-content-create-errors {
    margin-bottom: 22px;
    padding: 15px 18px;
    border: 1px solid #e6bdb4;
    border-radius: 14px;
    background: #fff4f1;
    color: #8d493d;
}

.education-content-create-errors strong {
    display: block;
    margin-bottom: 8px;
    font-size: 13px;
}

.education-content-create-errors ul {
    margin: 0;
    padding-right: 20px;
}

.education-content-create-errors li {
    margin-bottom: 4px;
    font-size: 12px;
}

.education-content-create-errors li:last-child {
    margin-bottom: 0;
}

/* =========================================================
   OLD INPUT NOTICE
========================================================= */

.education-content-create-old-notice {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    margin-bottom: 20px;
    padding: 13px 15px;
    border: 1px solid #e5d5ad;
    border-radius: 13px;
    background: #fff9e9;
    color: #705d2f;
    font-size: 12px;
    line-height: 1.8;
}

.education-content-create-old-notice i {
    margin-top: 3px;
    color: #b28737;
}

/* =========================================================
   MAIN GRID
========================================================= */

.education-content-create-grid {
    display: grid;
    grid-template-columns: minmax(0, 1fr) 320px;
    gap: 25px;
    align-items: start;
}

/* =========================================================
   MAIN CARD
========================================================= */

.education-content-create-card {
    background: #fffdf8;
    border: 1px solid #e2dccd;
    border-radius: 21px;
    box-shadow: 0 12px 35px rgba(49, 59, 39, .06);
    overflow: hidden;
}

.education-content-create-card-header {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 21px 23px;
    border-bottom: 1px solid #ece7da;
}

.education-content-create-card-icon {
    width: 43px;
    height: 43px;
    flex-shrink: 0;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #eef0e8;
    color: #4a5839;
}

.education-content-create-card-header span {
    display: block;
    color: #96998f;
    font-size: 12px;
    margin-bottom: 3px;
}

.education-content-create-card-header h2 {
    margin: 0;
    color: #343b2e;
    font-size: 17px;
    font-weight: 800;
}

/* =========================================================
   FORM
========================================================= */

.education-content-create-form-body {
    padding: 25px;
}

.education-content-create-field {
    margin-bottom: 20px;
}

.education-content-create-field:last-child {
    margin-bottom: 0;
}

.education-content-create-field label {
    display: block;
    margin-bottom: 8px;
    color: #4b5242;
    font-size: 13px;
    font-weight: 800;
}

.education-content-create-required {
    color: #b45e48;
}

.education-content-create-input,
.education-content-create-select,
.education-content-create-textarea {
    width: 100%;
    box-sizing: border-box;
    border: 1px solid #ddd7c9;
    border-radius: 12px;
    background: #fffefa;
    color: #30372b;
    font-family: inherit;
    font-size: 14px;
    outline: none;
    transition: .2s ease;
}

.education-content-create-input,
.education-content-create-select {
    min-height: 48px;
    padding: 0 14px;
}

.education-content-create-textarea {
    min-height: 130px;
    padding: 13px 14px;
    line-height: 1.9;
    resize: vertical;
}

.education-content-create-input:focus,
.education-content-create-select:focus,
.education-content-create-textarea:focus {
    border-color: #a9894b;
    background: #fff;
    box-shadow: 0 0 0 4px rgba(169, 137, 75, .10);
}

.education-content-create-input:disabled,
.education-content-create-select:disabled,
.education-content-create-textarea:disabled {
    cursor: not-allowed;
    opacity: .7;
}

.education-content-create-help {
    display: block;
    margin-top: 7px;
    color: #999b92;
    font-size: 11px;
    line-height: 1.7;
}

/* =========================================================
   VIDEO URL NOTICE
========================================================= */

.education-content-video-help {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    margin-top: 10px;
    padding: 12px 14px;
    border: 1px solid #e2d6b8;
    border-radius: 12px;
    background: #fff9e9;
    color: #74602f;
    font-size: 11px;
    line-height: 1.8;
}

.education-content-video-help i {
    flex-shrink: 0;
    margin-top: 3px;
    color: #b58a38;
}

.education-content-video-help strong {
    color: #5e512d;
}

/* =========================================================
   GENERAL LESSON SETTINGS
========================================================= */

.education-content-general-settings {
    padding: 20px;
    margin-bottom: 25px;
    border: 1px solid #e3dccb;
    border-radius: 17px;
    background: #faf7ef;
}

.education-content-general-settings-title {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 18px;
}

.education-content-general-settings-title i {
    color: #ad8236;
}

.education-content-general-settings-title strong {
    color: #414a37;
    font-size: 14px;
}

.education-content-two-columns {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 17px;
}

/* =========================================================
   GENERAL INFO BOX
========================================================= */

.education-content-general-info {
    min-height: 48px;
    display: flex;
    align-items: center;
    gap: 9px;
    padding: 0 13px;
    border: 1px solid #e0dacd;
    border-radius: 12px;
    background: #fffdf8;
    color: #666b61;
    font-size: 12px;
    font-weight: 700;
    line-height: 1.7;
}

.education-content-general-info i {
    flex-shrink: 0;
    color: #a47a2c;
}

/* =========================================================
   CONTENT ITEMS
========================================================= */

.education-content-items-wrapper {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.education-content-item {
    position: relative;
    border: 1px solid #dfd8c8;
    border-radius: 19px;
    background: #fffefa;
    overflow: hidden;
    box-shadow: 0 8px 25px rgba(49, 59, 39, .04);
}

.education-content-item-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
    padding: 16px 18px;
    background: #f7f3e9;
    border-bottom: 1px solid #e9e3d7;
}

.education-content-item-number {
    display: flex;
    align-items: center;
    gap: 11px;
}

.education-content-item-number-badge {
    width: 35px;
    height: 35px;
    flex-shrink: 0;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #465236;
    color: #dfba68;
    font-size: 13px;
    font-weight: 800;
}

.education-content-item-number strong {
    color: #414837;
    font-size: 14px;
}

.education-content-item-remove {
    border: 0;
    width: 36px;
    height: 36px;
    flex-shrink: 0;
    border-radius: 10px;
    background: #fff1ed;
    color: #a85344;
    cursor: pointer;
    transition: .2s ease;
}

.education-content-item-remove:hover {
    background: #f8dcd5;
    transform: translateY(-1px);
}

.education-content-item-body {
    padding: 21px;
}

/* =========================================================
   TYPE SELECTOR
========================================================= */

.education-content-type-options {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 9px;
}

.education-content-type-option {
    position: relative;
}

.education-content-type-option input {
    position: absolute;
    opacity: 0;
    pointer-events: none;
}

.education-content-type-option label {
    min-height: 80px;
    margin: 0;
    padding: 10px 7px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 6px;
    border: 1px solid #ded8c9;
    border-radius: 13px;
    background: #fffefa;
    color: #666c61;
    cursor: pointer;
    text-align: center;
    transition: .2s ease;
}

.education-content-type-option label:hover {
    border-color: #bda56f;
    background: #faf6ec;
    transform: translateY(-2px);
}

.education-content-type-option label i {
    font-size: 19px;
    color: #899079;
}

.education-content-type-option label span {
    font-size: 11px;
    font-weight: 800;
}

.education-content-type-option input:checked + label {
    border-color: #a88642;
    background: #f7efdf;
    color: #3f4a2f;
    box-shadow: 0 7px 18px rgba(166, 133, 64, .10);
}

.education-content-type-option input:checked + label i {
    color: #ae8235;
}

/* =========================================================
   DYNAMIC TYPE SECTIONS
========================================================= */

.education-content-dynamic {
    margin-top: 20px;
}

.content-type-section {
    display: none;
}

.content-type-section.active {
    display: block;
}

/* =========================================================
   VIDEO
========================================================= */

.education-content-video-box {
    padding: 18px;
    border: 1px solid #e1dacb;
    border-radius: 15px;
    background: #faf7ef;
}

.education-content-video-platforms {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-bottom: 13px;
}

.education-content-video-platform {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 7px 11px;
    border-radius: 20px;
    background: #fffdf8;
    border: 1px solid #e2dac8;
    color: #5f654f;
    font-size: 11px;
    font-weight: 800;
}

.education-content-video-platform.youtube i {
    color: #d62828;
}

.education-content-video-platform.drive i {
    color: #4285f4;
}

.education-content-video-preview {
    display: none;
    position: relative;
    margin-top: 15px;
    overflow: hidden;
    border-radius: 14px;
    background: #1f241c;
    aspect-ratio: 16 / 9;
}

.education-content-video-preview.active {
    display: block;
}

.education-content-video-preview iframe {
    width: 100%;
    height: 100%;
    display: block;
    border: 0;
}

/* =========================================================
   UPLOAD
========================================================= */

.education-content-upload-box {
    position: relative;
    min-height: 155px;
    padding: 20px;
    border: 1.5px dashed #cfc5ae;
    border-radius: 15px;
    background: #faf7ef;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    transition: .2s ease;
}

.education-content-upload-box:hover {
    border-color: #aa8744;
    background: #f8f1e2;
}

.education-content-upload-box.has-file {
    border-color: #8b9a6c;
    background: #f4f7ed;
}

.education-content-upload-box input {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
}

.education-content-upload-content i {
    display: block;
    margin-bottom: 9px;
    font-size: 30px;
    color: #b38b43;
}

.education-content-upload-content strong {
    display: block;
    margin-bottom: 5px;
    color: #4a513f;
    font-size: 13px;
    overflow-wrap: anywhere;
}

.education-content-upload-content span {
    color: #96978e;
    font-size: 11px;
    line-height: 1.7;
}

/* =========================================================
   ITEM SETTINGS
========================================================= */

.education-content-item-settings {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
    margin-top: 20px;
    padding-top: 20px;
    border-top: 1px solid #eee9de;
}

.education-content-checkbox {
    min-height: 46px;
    padding: 0 12px;
    display: flex;
    align-items: center;
    gap: 9px;
    border: 1px solid #e0dacd;
    border-radius: 11px;
    background: #faf8f2;
}

.education-content-checkbox input {
    width: 17px;
    height: 17px;
    accent-color: #53613e;
}

.education-content-checkbox span {
    color: #505749;
    font-size: 12px;
    font-weight: 700;
}

/* =========================================================
   ADD BUTTON
========================================================= */

.education-content-add-item {
    width: 100%;
    min-height: 54px;
    margin-top: 20px;
    border: 1.5px dashed #b9a675;
    border-radius: 14px;
    background: #fbf7ec;
    color: #75602d;
    font-family: inherit;
    font-size: 13px;
    font-weight: 800;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 9px;
    transition: .2s ease;
}

.education-content-add-item:hover {
    background: #f5eddd;
    border-color: #a48648;
    color: #4a5638;
    transform: translateY(-1px);
}

/* =========================================================
   FOOTER
========================================================= */

.education-content-create-form-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
    padding: 20px 25px;
    border-top: 1px solid #ece7da;
    background: #faf7ef;
}

.education-content-create-submit,
.education-content-create-cancel {
    min-height: 48px;
    border-radius: 12px;
    padding: 0 22px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 9px;
    font-family: inherit;
    font-size: 13px;
    font-weight: 800;
    transition: .2s ease;
}

.education-content-create-submit {
    border: 0;
    background: linear-gradient(135deg, #53613e, #3f4a2f);
    color: #fffdf7;
    cursor: pointer;
    box-shadow: 0 8px 18px rgba(63, 74, 47, .16);
}

.education-content-create-submit:hover {
    transform: translateY(-2px);
}

.education-content-create-submit:disabled {
    opacity: .7;
    cursor: wait;
    transform: none;
}

.education-content-create-cancel {
    border: 1px solid #ddd7ca;
    background: #fffdf8;
    color: #666b61;
    text-decoration: none;
}

.education-content-create-cancel:hover {
    background: #f5f1e7;
    color: #3f4a2f;
}

/* =========================================================
   SIDEBAR
========================================================= */

.education-content-create-sidebar {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.education-content-help-card {
    padding: 22px;
    border-radius: 19px;
    background: #465236;
    color: #fffdf7;
    box-shadow: 0 15px 35px rgba(54, 65, 40, .14);
}

.education-content-help-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 17px;
}

.education-content-help-icon {
    width: 43px;
    height: 43px;
    flex-shrink: 0;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #d3a953;
    color: #fff;
}

.education-content-help-header h3 {
    margin: 0;
    color: #fffdf7;
    font-size: 16px;
}

.education-content-help-card p {
    margin: 0;
    color: rgba(255,255,255,.76);
    font-size: 12px;
    line-height: 1.9;
}

.education-content-type-guide {
    padding: 20px;
    border: 1px solid #e2dccd;
    border-radius: 19px;
    background: #fffdf8;
}

.education-content-type-guide-title {
    display: flex;
    align-items: center;
    gap: 10px;
    padding-bottom: 14px;
    margin-bottom: 14px;
    border-bottom: 1px solid #eee8db;
}

.education-content-type-guide-title i {
    color: #b28a42;
}

.education-content-type-guide-title strong {
    color: #3f4736;
    font-size: 14px;
}

.education-content-type-guide-item {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    margin-bottom: 14px;
}

.education-content-type-guide-item:last-child {
    margin-bottom: 0;
}

.education-content-type-guide-item > i {
    margin-top: 3px;
    color: #9d7b3a;
    font-size: 12px;
}

.education-content-type-guide-item strong {
    display: block;
    color: #4b5243;
    font-size: 12px;
    margin-bottom: 3px;
}

.education-content-type-guide-item span {
    display: block;
    color: #92958c;
    font-size: 11px;
    line-height: 1.7;
}

/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 1100px) {

    .education-content-create-grid {
        grid-template-columns: 1fr;
    }

    .education-content-create-sidebar {
        display: grid;
        grid-template-columns: 1fr 1fr;
    }
}

@media (max-width: 900px) {

    .education-content-type-options {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (max-width: 800px) {

    .education-content-create-header {
        flex-direction: column;
        align-items: stretch;
    }

    .education-content-create-title {
        align-items: flex-start;
    }

    .education-content-type-options {
        grid-template-columns: 1fr 1fr;
    }

    .education-content-two-columns,
    .education-content-item-settings,
    .education-content-create-sidebar {
        grid-template-columns: 1fr;
    }

    .education-content-create-lesson-info {
        align-items: flex-start;
        flex-direction: column;
    }

    .education-content-create-form-footer {
        flex-direction: column-reverse;
        align-items: stretch;
    }

    .education-content-create-submit,
    .education-content-create-cancel {
        width: 100%;
    }
}

@media (max-width: 520px) {

    .education-content-create-title h1 {
        font-size: 23px;
    }

    .education-content-create-form-body {
        padding: 18px;
    }

    .education-content-item-body {
        padding: 16px;
    }

    .education-content-create-title-icon {
        width: 46px;
        height: 46px;
    }

    .education-content-type-options {
        gap: 7px;
    }

    .education-content-type-option label {
        min-height: 72px;
    }
}
</style>

@php
    $oldContents = old('contents', []);
@endphp

<div class="education-content-create-page">

    {{-- =========================================================
        HEADER
    ========================================================== --}}

    <div class="education-content-create-header">

        <div class="education-content-create-heading">

            <div class="education-content-create-label">

                <i class="fa-solid fa-layer-group"></i>

                {{ __('education_admin.lessons.content_create.header_label') }}

            </div>

            <div class="education-content-create-title">

                <div class="education-content-create-title-icon">

                    <i class="fa-solid fa-layer-group"></i>

                </div>

                <div>

                    <h1>
                        {{ __('education_admin.lessons.content_create.title') }}
                    </h1>

                    <p>
                        {{ __('education_admin.lessons.content_create.description') }}
                    </p>

                </div>

            </div>

        </div>

        <a
            href="{{ route('education.admin.lessons.content.index', $lesson) }}"
            class="education-content-create-back"
        >

            <i class="fa-solid fa-arrow-right"></i>

            {{ __('education_admin.lessons.content_create.actions.back') }}

        </a>

    </div>


    {{-- =========================================================
        LESSON INFO
    ========================================================== --}}

    <div class="education-content-create-lesson-info">

        <div class="education-content-create-lesson-main">

            <div class="education-content-create-lesson-icon">

                <i class="fa-solid fa-book-open"></i>

            </div>

            <div>

                <span>
                    {{ __('education_admin.lessons.content_create.lesson.current') }}
                </span>

                <strong>
                    {{ $lesson->title }}
                </strong>

            </div>

        </div>

        @if($lesson->category)

            <div class="education-content-create-lesson-category">

                <i class="fa-solid fa-layer-group"></i>

                {{ $lesson->category }}

            </div>

        @endif

    </div>


    {{-- =========================================================
        ERRORS
    ========================================================== --}}

    @if($errors->any())

        <div class="education-content-create-errors">

            <strong>
                {{ __('education_admin.lessons.content_create.alerts.validation_title') }}
            </strong>

            <ul>

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    @if(count($oldContents))

        <div class="education-content-create-old-notice">

            <i class="fa-solid fa-circle-info"></i>

            <span>
                {{ __('education_admin.lessons.content_create.old_notice') }}
            </span>

        </div>

    @endif


    {{-- =========================================================
        GRID
    ========================================================== --}}

    <div class="education-content-create-grid">

        {{-- =====================================================
            MAIN FORM
        ====================================================== --}}

        <div class="education-content-create-card">

            <div class="education-content-create-card-header">

                <div class="education-content-create-card-icon">

                    <i class="fa-solid fa-layer-group"></i>

                </div>

                <div>

                    <span>
                        {{ __('education_admin.lessons.content_create.form.label') }}
                    </span>

                    <h2>
                        {{ __('education_admin.lessons.content_create.form.title') }}
                    </h2>

                </div>

            </div>


            <form
                action="{{ route('education.admin.lessons.content.store', $lesson) }}"
                method="POST"
                enctype="multipart/form-data"
                id="educationContentCreateForm"
            >

                @csrf


                <div class="education-content-create-form-body">


                    {{-- =================================================
                        GENERAL SETTINGS
                    ================================================== --}}

                    <div class="education-content-general-settings">

                        <div class="education-content-general-settings-title">

                            <i class="fa-solid fa-sliders"></i>

                            <strong>
                                {{ __('education_admin.lessons.content_create.settings.title') }}
                            </strong>

                        </div>


                        <div class="education-content-two-columns">


                            <div class="education-content-create-field">

                                <label for="lesson_sort_order">

                                    {{ __('education_admin.lessons.content_create.settings.sort_order') }}

                                </label>

                                <input
                                    type="number"
                                    id="lesson_sort_order"
                                    name="default_sort_order"
                                    class="education-content-create-input"
                                    min="0"
                                    value="{{ old('default_sort_order') }}"
                                    placeholder="{{ __('education_admin.lessons.content_create.settings.sort_order_placeholder') }}"
                                >

                                <span class="education-content-create-help">

                                    {{ __('education_admin.lessons.content_create.settings.sort_order_help') }}

                                </span>

                            </div>


                            <div class="education-content-create-field">

                                <label>

                                    {{ __('education_admin.lessons.content_create.settings.note_label') }}

                                </label>

                                <div class="education-content-general-info">

                                    <i class="fa-solid fa-circle-info"></i>

                                    <span>
                                        {{ __('education_admin.lessons.content_create.settings.note_description') }}
                                    </span>

                                </div>

                            </div>


                        </div>

                    </div>


                    {{-- =================================================
                        CONTENT ITEMS
                    ================================================== --}}

                    <div
                        id="educationContentItems"
                        class="education-content-items-wrapper"
                    ></div>


                    {{-- =================================================
                        ADD ITEM
                    ================================================== --}}

                    <button
                        type="button"
                        id="addContentItem"
                        class="education-content-add-item"
                    >

                        <i class="fa-solid fa-plus"></i>

                        {{ __('education_admin.lessons.content_create.actions.add_item') }}

                    </button>


                </div>


                {{-- =================================================
                    FOOTER
                ================================================== --}}

                <div class="education-content-create-form-footer">

                    <a
                        href="{{ route('education.admin.lessons.content.index', $lesson) }}"
                        class="education-content-create-cancel"
                    >

                        <i class="fa-solid fa-xmark"></i>

                        {{ __('education_admin.lessons.content_create.actions.cancel') }}

                    </a>


                    <button
                        type="submit"
                        id="educationContentSubmit"
                        class="education-content-create-submit"
                    >

                        <i class="fa-solid fa-check"></i>

                        {{ __('education_admin.lessons.content_create.actions.save') }}

                    </button>

                </div>

            </form>

        </div>


        {{-- =====================================================
            SIDEBAR
        ====================================================== --}}

        <aside class="education-content-create-sidebar">


            <div class="education-content-help-card">

                <div class="education-content-help-header">

                    <div class="education-content-help-icon">

                        <i class="fa-solid fa-lightbulb"></i>

                    </div>

                    <h3>
                        {{ __('education_admin.lessons.content_create.help.title') }}
                    </h3>

                </div>

                <p>
                    {{ __('education_admin.lessons.content_create.help.description') }}
                </p>

            </div>


            <div class="education-content-type-guide">

                <div class="education-content-type-guide-title">

                    <i class="fa-solid fa-circle-question"></i>

                    <strong>
                        {{ __('education_admin.lessons.content_create.types.title') }}
                    </strong>

                </div>


                <div class="education-content-type-guide-item">

                    <i class="fa-solid fa-align-right"></i>

                    <div>

                        <strong>
                            {{ __('education_admin.lessons.content_create.types.text.title') }}
                        </strong>

                        <span>
                            {{ __('education_admin.lessons.content_create.types.text.description') }}
                        </span>

                    </div>

                </div>


                <div class="education-content-type-guide-item">

                    <i class="fa-regular fa-image"></i>

                    <div>

                        <strong>
                            {{ __('education_admin.lessons.content_create.types.image.title') }}
                        </strong>

                        <span>
                            {{ __('education_admin.lessons.content_create.types.image.description') }}
                        </span>

                    </div>

                </div>


                <div class="education-content-type-guide-item">

                    <i class="fa-solid fa-video"></i>

                    <div>

                        <strong>
                            {{ __('education_admin.lessons.content_create.types.video.title') }}
                        </strong>

                        <span>
                            {{ __('education_admin.lessons.content_create.types.video.description') }}
                        </span>

                    </div>

                </div>


                <div class="education-content-type-guide-item">

                    <i class="fa-solid fa-link"></i>

                    <div>

                        <strong>
                            {{ __('education_admin.lessons.content_create.types.link.title') }}
                        </strong>

                        <span>
                            {{ __('education_admin.lessons.content_create.types.link.description') }}
                        </span>

                    </div>

                </div>


                <div class="education-content-type-guide-item">

                    <i class="fa-regular fa-file-lines"></i>

                    <div>

                        <strong>
                            {{ __('education_admin.lessons.content_create.types.file.title') }}
                        </strong>

                        <span>
                            {{ __('education_admin.lessons.content_create.types.file.description') }}
                        </span>

                    </div>

                </div>

            </div>

        </aside>

    </div>

</div>


{{-- =========================================================
    ITEM TEMPLATE
========================================================= --}}

<template id="educationContentItemTemplate">

<div
    class="education-content-item"
    data-index="__INDEX__"
>

    <div class="education-content-item-header">

        <div class="education-content-item-number">

            <div class="education-content-item-number-badge">

                <span class="content-item-number">
                    1
                </span>

            </div>

            <strong>
                {{ __('education_admin.lessons.content_create.item.title') }}
            </strong>

        </div>


        <button
            type="button"
            class="education-content-item-remove"
            title="{{ __('education_admin.lessons.content_create.item.remove') }}"
        >

            <i class="fa-solid fa-trash"></i>

        </button>

    </div>


    <div class="education-content-item-body">


        {{-- =====================================================
            TYPE
        ====================================================== --}}

        <div class="education-content-create-field">

            <label>

                {{ __('education_admin.lessons.content_create.fields.type') }}

                <span class="education-content-create-required">
                    *
                </span>

            </label>


            <div class="education-content-type-options">


                {{-- TEXT --}}

                <div class="education-content-type-option">

                    <input
                        type="radio"
                        id="content_type___INDEX___text"
                        name="contents[__INDEX__][type]"
                        value="text"
                        checked
                    >

                    <label for="content_type___INDEX___text">

                        <i class="fa-solid fa-align-right"></i>

                        <span>
                            {{ __('education_admin.lessons.content_create.types.text.label') }}
                        </span>

                    </label>

                </div>


                {{-- IMAGE --}}

                <div class="education-content-type-option">

                    <input
                        type="radio"
                        id="content_type___INDEX___image"
                        name="contents[__INDEX__][type]"
                        value="image"
                    >

                    <label for="content_type___INDEX___image">

                        <i class="fa-regular fa-image"></i>

                        <span>
                            {{ __('education_admin.lessons.content_create.types.image.label') }}
                        </span>

                    </label>

                </div>


                {{-- VIDEO --}}

                <div class="education-content-type-option">

                    <input
                        type="radio"
                        id="content_type___INDEX___video"
                        name="contents[__INDEX__][type]"
                        value="video"
                    >

                    <label for="content_type___INDEX___video">

                        <i class="fa-solid fa-video"></i>

                        <span>
                            {{ __('education_admin.lessons.content_create.types.video.label') }}
                        </span>

                    </label>

                </div>


                {{-- LINK --}}

                <div class="education-content-type-option">

                    <input
                        type="radio"
                        id="content_type___INDEX___link"
                        name="contents[__INDEX__][type]"
                        value="link"
                    >

                    <label for="content_type___INDEX___link">

                        <i class="fa-solid fa-link"></i>

                        <span>
                            {{ __('education_admin.lessons.content_create.types.link.label') }}
                        </span>

                    </label>

                </div>


                {{-- FILE --}}

                <div class="education-content-type-option">

                    <input
                        type="radio"
                        id="content_type___INDEX___file"
                        name="contents[__INDEX__][type]"
                        value="file"
                    >

                    <label for="content_type___INDEX___file">

                        <i class="fa-regular fa-file-lines"></i>

                        <span>
                            {{ __('education_admin.lessons.content_create.types.file.label') }}
                        </span>

                    </label>

                </div>

            </div>

        </div>


        {{-- =====================================================
            BASIC INFORMATION
        ====================================================== --}}

        <div class="education-content-two-columns">


            <div class="education-content-create-field">

                <label>

                    {{ __('education_admin.lessons.content_create.fields.title') }}

                </label>

                <input
                    type="text"
                    name="contents[__INDEX__][title]"
                    class="education-content-create-input content-title-input"
                    placeholder="{{ __('education_admin.lessons.content_create.fields.title_placeholder') }}"
                >

            </div>


            <div class="education-content-create-field">

                <label>

                    {{ __('education_admin.lessons.content_create.fields.sort_order') }}

                </label>

                <input
                    type="number"
                    name="contents[__INDEX__][sort_order]"
                    class="education-content-create-input content-sort-order"
                    min="0"
                    placeholder="{{ __('education_admin.lessons.content_create.fields.sort_order_placeholder') }}"
                >

            </div>

        </div>


        {{-- =====================================================
            DESCRIPTION
        ====================================================== --}}

        <div class="education-content-create-field">

            <label>

                {{ __('education_admin.lessons.content_create.fields.description') }}

            </label>

            <textarea
                name="contents[__INDEX__][description]"
                class="education-content-create-textarea content-description-input"
                style="min-height:100px;"
                placeholder="{{ __('education_admin.lessons.content_create.fields.description_placeholder') }}"
            ></textarea>

        </div>


        {{-- =====================================================
            DYNAMIC CONTENT
        ====================================================== --}}

        <div class="education-content-dynamic">


            {{-- =================================================
                TEXT
            ================================================== --}}

            <div
                class="content-type-section text-section active"
            >

                <div class="education-content-create-field">

                    <label>

                        {{ __('education_admin.lessons.content_create.fields.text_content') }}

                        <span class="education-content-create-required">
                            *
                        </span>

                    </label>

                    <textarea
                        name="contents[__INDEX__][content]"
                        class="education-content-create-textarea content-text-input"
                        placeholder="{{ __('education_admin.lessons.content_create.fields.text_content_placeholder') }}"
                    ></textarea>

                </div>

            </div>


            {{-- =================================================
                VIDEO
            ================================================== --}}

            <div
                class="content-type-section video-section"
            >

                <div class="education-content-video-box">

                    <div class="education-content-video-platforms">

                        <span class="education-content-video-platform youtube">

                            <i class="fa-brands fa-youtube"></i>

                            YouTube

                        </span>

                        <span class="education-content-video-platform drive">

                            <i class="fa-brands fa-google-drive"></i>

                            Google Drive

                        </span>

                    </div>


                    <div class="education-content-create-field">

                        <label>

                            {{ __('education_admin.lessons.content_create.fields.video_url') }}

                            <span class="education-content-create-required">
                                *
                            </span>

                        </label>

                        <input
                            type="url"
                            name="contents[__INDEX__][url]"
                            class="education-content-create-input content-video-url-input"
                            dir="ltr"
                            placeholder="{{ __('education_admin.lessons.content_create.fields.video_url_placeholder') }}"
                            disabled
                        >

                        <div class="education-content-video-help">

                            <i class="fa-solid fa-circle-info"></i>

                            <div>

                                <strong>
                                    {{ __('education_admin.lessons.content_create.video.notice_title') }}
                                </strong>

                                {{ __('education_admin.lessons.content_create.video.notice_description') }}

                            </div>

                        </div>


                        <div class="education-content-video-preview">

                            <iframe
                                class="content-video-preview-frame"
                                src=""
                                title="{{ __('education_admin.lessons.content_create.video.preview_title') }}"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen
                            ></iframe>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =================================================
                LINK
            ================================================== --}}

            <div
                class="content-type-section link-section"
            >

                <div class="education-content-create-field">

                    <label>

                        {{ __('education_admin.lessons.content_create.fields.link') }}

                        <span class="education-content-create-required">
                            *
                        </span>

                    </label>

                    <input
                        type="url"
                        name="contents[__INDEX__][url]"
                        class="education-content-create-input content-url-input"
                        dir="ltr"
                        placeholder="{{ __('education_admin.lessons.content_create.fields.link_placeholder') }}"
                        disabled
                    >

                </div>

            </div>


            {{-- =================================================
                IMAGE
            ================================================== --}}

            <div
                class="content-type-section image-section"
            >

                <div class="education-content-create-field">

                    <label>

                        {{ __('education_admin.lessons.content_create.fields.image') }}

                        <span class="education-content-create-required">
                            *
                        </span>

                    </label>


                    <div class="education-content-upload-box">

                        <input
                            type="file"
                            name="contents[__INDEX__][upload]"
                            class="content-image-upload"
                            accept=".jpg,.jpeg,.png,.webp,.gif"
                            disabled
                        >


                        <div class="education-content-upload-content">

                            <i class="fa-regular fa-image"></i>

                            <strong>
                                {{ __('education_admin.lessons.content_create.upload.image_title') }}
                            </strong>

                            <span>
                                {{ __('education_admin.lessons.content_create.upload.image_description') }}
                            </span>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =================================================
                FILE
            ================================================== --}}

            <div
                class="content-type-section file-section"
            >

                <div class="education-content-create-field">

                    <label>

                        {{ __('education_admin.lessons.content_create.fields.file') }}

                        <span class="education-content-create-required">
                            *
                        </span>

                    </label>


                    <div class="education-content-upload-box">

                        <input
                            type="file"
                            name="contents[__INDEX__][upload]"
                            class="content-file-upload"
                            accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.zip"
                            disabled
                        >


                        <div class="education-content-upload-content">

                            <i class="fa-regular fa-file-lines"></i>

                            <strong>
                                {{ __('education_admin.lessons.content_create.upload.file_title') }}
                            </strong>

                            <span>
                                {{ __('education_admin.lessons.content_create.upload.file_description') }}
                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
            ITEM SETTINGS
        ====================================================== --}}

        <div class="education-content-item-settings">


            <label class="education-content-checkbox">

                <input
                    type="checkbox"
                    name="contents[__INDEX__][is_active]"
                    value="1"
                    checked
                >

                <span>
                    {{ __('education_admin.lessons.content_create.fields.publish') }}
                </span>

            </label>


            <div class="education-content-checkbox">

                <i
                    class="fa-solid fa-circle-check"
                    style="color:#a47a2c;"
                ></i>

                <span>
                    {{ __('education_admin.lessons.content_create.fields.status_help') }}
                </span>

            </div>

        </div>

    </div>

</div>

</template>


{{-- =========================================================
    JAVASCRIPT
========================================================= --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const itemsContainer =
        document.getElementById('educationContentItems');

    const addButton =
        document.getElementById('addContentItem');

    const template =
        document.getElementById('educationContentItemTemplate');

    const form =
        document.getElementById('educationContentCreateForm');

    const submitButton =
        document.getElementById('educationContentSubmit');

    const defaultSortInput =
        document.getElementById('lesson_sort_order');


    if (
        !itemsContainer ||
        !addButton ||
        !template ||
        !form
    ) {
        return;
    }


    let itemIndex = 0;


    /*
    |----------------------------------------------------------------------
    | TRANSLATIONS
    |----------------------------------------------------------------------
    */

    const translations = {
        minimumItem: @json(__('education_admin.lessons.content_create.js.minimum_item')),
        fileTooLarge: @json(__('education_admin.lessons.content_create.js.file_too_large')),
        addAtLeastOne: @json(__('education_admin.lessons.content_create.js.add_at_least_one')),
        completeRequired: @json(__('education_admin.lessons.content_create.js.complete_required')),
        invalidVideo: @json(__('education_admin.lessons.content_create.js.invalid_video')),
        saving: @json(__('education_admin.lessons.content_create.js.saving'))
    };


    /*
    |----------------------------------------------------------------------
    | OLD CONTENTS
    |----------------------------------------------------------------------
    */

    const oldContents =
        @json($oldContents);


    /*
    |----------------------------------------------------------------------
    | ADD CONTENT ITEM
    |----------------------------------------------------------------------
    */

    function addContentItem(data = null) {

        const index = itemIndex++;


        let html =
            template.innerHTML.replace(
                /__INDEX__/g,
                index
            );


        const wrapper =
            document.createElement('div');


        wrapper.innerHTML =
            html.trim();


        const item =
            wrapper.firstElementChild;


        if (!item) {
            return;
        }


        itemsContainer.appendChild(item);


        initializeItem(item);


        if (data) {

            populateItem(
                item,
                data
            );

        }


        updateItemNumbers();

    }


    /*
    |----------------------------------------------------------------------
    | INITIALIZE ITEM
    |----------------------------------------------------------------------
    */

    function initializeItem(item) {

        const typeInputs =
            item.querySelectorAll(
                'input[type="radio"][name*="[type]"]'
            );


        typeInputs.forEach(function (input) {

            input.addEventListener(
                'change',
                function () {

                    updateItemType(
                        item,
                        input.value
                    );

                }
            );

        });


        const removeButton =
            item.querySelector(
                '.education-content-item-remove'
            );


        if (removeButton) {

            removeButton.addEventListener(
                'click',
                function () {

                    const items =
                        itemsContainer.querySelectorAll(
                            '.education-content-item'
                        );


                    if (items.length <= 1) {

                        alert(
                            translations.minimumItem
                        );

                        return;
                    }


                    item.remove();

                    updateItemNumbers();

                }
            );

        }


        const imageUpload =
            item.querySelector(
                '.content-image-upload'
            );


        const fileUpload =
            item.querySelector(
                '.content-file-upload'
            );


        const videoUrlInput =
            item.querySelector(
                '.content-video-url-input'
            );


        if (imageUpload) {

            imageUpload.addEventListener(
                'change',
                function () {

                    handleUploadChange(
                        imageUpload,
                        10
                    );

                }
            );

        }


        if (fileUpload) {

            fileUpload.addEventListener(
                'change',
                function () {

                    handleUploadChange(
                        fileUpload,
                        50
                    );

                }
            );

        }


        if (videoUrlInput) {

            videoUrlInput.addEventListener(
                'input',
                function () {

                    updateVideoPreview(
                        item,
                        videoUrlInput.value
                    );

                }
            );

        }


        updateItemType(
            item,
            'text'
        );

    }


    /*
    |----------------------------------------------------------------------
    | POPULATE OLD ITEM
    |----------------------------------------------------------------------
    */

    function populateItem(item, data) {

        const titleInput =
            item.querySelector(
                '.content-title-input'
            );


        const descriptionInput =
            item.querySelector(
                '.content-description-input'
            );


        const sortInput =
            item.querySelector(
                '.content-sort-order'
            );


        const textInput =
            item.querySelector(
                '.content-text-input'
            );


        const urlInput =
            item.querySelector(
                '.content-url-input'
            );


        const videoUrlInput =
            item.querySelector(
                '.content-video-url-input'
            );


        const activeInput =
            item.querySelector(
                'input[type="checkbox"][name*="[is_active]"]'
            );


        if (titleInput) {

            titleInput.value =
                data.title ?? '';

        }


        if (descriptionInput) {

            descriptionInput.value =
                data.description ?? '';

        }


        if (sortInput) {

            sortInput.value =
                data.sort_order ?? '';

        }


        if (textInput) {

            textInput.value =
                data.content ?? '';

        }


        if (urlInput) {

            urlInput.value =
                data.url ?? '';

        }


        if (videoUrlInput) {

            videoUrlInput.value =
                data.video_url ??
                data.url ??
                '';

        }


        if (
            activeInput &&
            Object.prototype.hasOwnProperty.call(
                data,
                'is_active'
            )
        ) {

            activeInput.checked =
                data.is_active == 1 ||
                data.is_active === true ||
                data.is_active === '1';

        }


        const type =
            data.type || 'text';


        const selectedType =
            item.querySelector(
                'input[type="radio"][value="' +
                type +
                '"]'
            );


        if (selectedType) {

            selectedType.checked = true;


            updateItemType(
                item,
                type
            );


            if (type === 'video' && videoUrlInput) {

                updateVideoPreview(
                    item,
                    videoUrlInput.value
                );

            }

        }

    }


    /*
    |----------------------------------------------------------------------
    | TYPE CHANGE
    |----------------------------------------------------------------------
    */

    function updateItemType(item, type) {

        const sections =
            item.querySelectorAll(
                '.content-type-section'
            );


        sections.forEach(function (section) {

            section.classList.remove(
                'active'
            );

        });


        const textInput =
            item.querySelector(
                '.content-text-input'
            );


        const urlInput =
            item.querySelector(
                '.content-url-input'
            );


        const videoUrlInput =
            item.querySelector(
                '.content-video-url-input'
            );


        const imageUpload =
            item.querySelector(
                '.content-image-upload'
            );


        const fileUpload =
            item.querySelector(
                '.content-file-upload'
            );


        if (textInput) {

            textInput.disabled =
                type !== 'text';

            textInput.required =
                type === 'text';

        }


        if (urlInput) {

            urlInput.disabled =
                type !== 'link';

            urlInput.required =
                type === 'link';

        }


        if (videoUrlInput) {

            videoUrlInput.disabled =
                type !== 'video';

            videoUrlInput.required =
                type === 'video';


            if (type !== 'video') {

                updateVideoPreview(
                    item,
                    ''
                );

            }

        }


        if (imageUpload) {

            imageUpload.disabled =
                type !== 'image';

            imageUpload.required =
                type === 'image';

        }


        if (fileUpload) {

            fileUpload.disabled =
                type !== 'file';

            fileUpload.required =
                type === 'file';

        }


        const activeSection =
            item.querySelector(
                '.' +
                type +
                '-section'
            );


        if (activeSection) {

            activeSection.classList.add(
                'active'
            );

        }

    }


    /*
    |----------------------------------------------------------------------
    | VIDEO URL
    |----------------------------------------------------------------------
    */

    function normalizeVideoUrl(url) {

        if (!url) {
            return '';
        }


        url = url.trim();


        /*
        |--------------------------------------------------------------
        | YouTube watch
        |--------------------------------------------------------------
        */

        try {

            const parsed =
                new URL(url);


            const hostname =
                parsed.hostname
                    .toLowerCase()
                    .replace('www.', '');


            if (
                hostname === 'youtube.com' ||
                hostname === 'm.youtube.com'
            ) {

                const videoId =
                    parsed.searchParams.get('v');


                if (videoId) {

                    return 'https://www.youtube.com/embed/' +
                        videoId;

                }


                if (
                    parsed.pathname.startsWith('/embed/')
                ) {

                    return url;

                }


                if (
                    parsed.pathname.startsWith('/shorts/')
                ) {

                    const id =
                        parsed.pathname
                            .split('/')[2]
                            ?.split('?')[0];


                    if (id) {

                        return 'https://www.youtube.com/embed/' +
                            id;

                    }

                }

            }


            if (hostname === 'youtu.be') {

                const id =
                    parsed.pathname
                        .replace('/', '')
                        .split('?')[0];


                if (id) {

                    return 'https://www.youtube.com/embed/' +
                        id;

                }

            }


            /*
            |----------------------------------------------------------
            | Google Drive
            |----------------------------------------------------------
            */

            if (
                hostname === 'drive.google.com'
            ) {

                const match =
                    url.match(
                        /\/file\/d\/([^/]+)/
                    );


                if (match && match[1]) {

                    return 'https://drive.google.com/file/d/' +
                        match[1] +
                        '/preview';

                }


                if (
                    parsed.pathname.includes('/open')
                ) {

                    const id =
                        parsed.searchParams.get('id');


                    if (id) {

                        return 'https://drive.google.com/file/d/' +
                            id +
                            '/preview';

                    }

                }


                if (
                    parsed.pathname.includes('/uc')
                ) {

                    const id =
                        parsed.searchParams.get('id');


                    if (id) {

                        return 'https://drive.google.com/file/d/' +
                            id +
                            '/preview';

                    }

                }

            }

        } catch (error) {

            return '';

        }


        return '';
    }


    /*
    |----------------------------------------------------------------------
    | VIDEO PREVIEW
    |----------------------------------------------------------------------
    */

    function updateVideoPreview(
        item,
        url
    ) {

        const preview =
            item.querySelector(
                '.education-content-video-preview'
            );


        const iframe =
            item.querySelector(
                '.content-video-preview-frame'
            );


        if (
            !preview ||
            !iframe
        ) {

            return;

        }


        const embedUrl =
            normalizeVideoUrl(url);


        if (!embedUrl) {

            iframe.src = '';

            preview.classList.remove(
                'active'
            );

            return;

        }


        iframe.src =
            embedUrl;


        preview.classList.add(
            'active'
        );

    }


    /*
    |----------------------------------------------------------------------
    | FILE UPLOAD
    |----------------------------------------------------------------------
    */

    function handleUploadChange(
        input,
        maxSizeMB
    ) {

        const box =
            input.closest(
                '.education-content-upload-box'
            );


        if (!box) {
            return;
        }


        const strong =
            box.querySelector(
                'strong'
            );


        if (
            !input.files ||
            !input.files.length
        ) {

            box.classList.remove(
                'has-file'
            );

            return;

        }


        const file =
            input.files[0];


        const maxBytes =
            maxSizeMB *
            1024 *
            1024;


        if (file.size > maxBytes) {

            alert(
                translations.fileTooLarge
                    .replace(':name', file.name)
                    .replace(':size', maxSizeMB)
            );


            input.value = '';


            box.classList.remove(
                'has-file'
            );


            return;

        }


        box.classList.add(
            'has-file'
        );


        if (strong) {

            strong.textContent =
                file.name;

        }

    }


    /*
    |----------------------------------------------------------------------
    | UPDATE ITEM NUMBERS
    |----------------------------------------------------------------------
    */

    function updateItemNumbers() {

        const items =
            itemsContainer.querySelectorAll(
                '.education-content-item'
            );


        let startOrder = 0;


        if (
            defaultSortInput &&
            defaultSortInput.value !== ''
        ) {

            startOrder =
                parseInt(
                    defaultSortInput.value,
                    10
                );


            if (
                Number.isNaN(startOrder) ||
                startOrder < 0
            ) {

                startOrder = 0;

            }

        }


        items.forEach(
            function (item, index) {

                const number =
                    item.querySelector(
                        '.content-item-number'
                    );


                if (number) {

                    number.textContent =
                        index + 1;

                }


                const sortInput =
                    item.querySelector(
                        '.content-sort-order'
                    );


                if (
                    sortInput &&
                    (
                        sortInput.value === '' ||
                        sortInput.dataset.autoGenerated === '1'
                    )
                ) {

                    sortInput.value =
                        startOrder + index;


                    sortInput.dataset.autoGenerated =
                        '1';

                }

            }
        );

    }


    /*
    |----------------------------------------------------------------------
    | DEFAULT SORT ORDER CHANGE
    |----------------------------------------------------------------------
    */

    if (defaultSortInput) {

        defaultSortInput.addEventListener(
            'input',
            function () {

                const items =
                    itemsContainer.querySelectorAll(
                        '.education-content-item'
                    );


                items.forEach(function (item) {

                    const sortInput =
                        item.querySelector(
                            '.content-sort-order'
                        );


                    if (sortInput) {

                        sortInput.dataset.autoGenerated =
                            '1';

                    }

                });


                updateItemNumbers();

            }
        );

    }


    /*
    |----------------------------------------------------------------------
    | FORM VALIDATION
    |----------------------------------------------------------------------
    */

    form.addEventListener(
        'submit',
        function (event) {

            const items =
                itemsContainer.querySelectorAll(
                    '.education-content-item'
                );


            if (!items.length) {

                event.preventDefault();


                alert(
                    translations.addAtLeastOne
                );


                return;

            }


            let valid = true;


            let errorMessage =
                translations.completeRequired;


            items.forEach(function (item) {

                const selected =
                    item.querySelector(
                        'input[type="radio"][name*="[type]"]:checked'
                    );


                if (!selected) {

                    valid = false;

                    return;

                }


                const type =
                    selected.value;


                if (type === 'text') {

                    const textarea =
                        item.querySelector(
                            '.content-text-input'
                        );


                    if (
                        !textarea ||
                        !textarea.value.trim()
                    ) {

                        valid = false;

                    }

                }


                if (type === 'link') {

                    const url =
                        item.querySelector(
                            '.content-url-input'
                        );


                    if (
                        !url ||
                        !url.value.trim()
                    ) {

                        valid = false;

                    }

                }


                if (type === 'video') {

                    const videoUrl =
                        item.querySelector(
                            '.content-video-url-input'
                        );


                    if (
                        !videoUrl ||
                        !videoUrl.value.trim()
                    ) {

                        valid = false;

                        return;

                    }


                    const normalized =
                        normalizeVideoUrl(
                            videoUrl.value
                        );


                    if (!normalized) {

                        valid = false;

                        errorMessage =
                            translations.invalidVideo;

                    }

                }


                if (type === 'image') {

                    const upload =
                        item.querySelector(
                            '.content-image-upload'
                        );


                    if (
                        !upload ||
                        !upload.files ||
                        !upload.files.length
                    ) {

                        valid = false;

                    }

                }


                if (type === 'file') {

                    const upload =
                        item.querySelector(
                            '.content-file-upload'
                        );


                    if (
                        !upload ||
                        !upload.files ||
                        !upload.files.length
                    ) {

                        valid = false;

                    }

                }

            });


            if (!valid) {

                event.preventDefault();


                alert(
                    errorMessage
                );


                return;

            }


            if (submitButton) {

                submitButton.disabled = true;


                submitButton.innerHTML =
                    '<i class="fa-solid fa-spinner fa-spin"></i> ' +
                    translations.saving;

            }

        }
    );


    /*
    |----------------------------------------------------------------------
    | INITIAL ITEMS
    |----------------------------------------------------------------------
    */

    if (
        Array.isArray(oldContents) &&
        oldContents.length
    ) {

        oldContents.forEach(function (content) {

            addContentItem(
                content
            );

        });

    } else {

        addContentItem();

    }


    /*
    |----------------------------------------------------------------------
    | ADD BUTTON
    |----------------------------------------------------------------------
    */

    addButton.addEventListener(
        'click',
        function () {

            addContentItem();

        }
    );

});

</script>

@endsection
