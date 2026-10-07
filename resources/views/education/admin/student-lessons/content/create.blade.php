@extends('education.admin.layouts.app')

@section('title', __('education_admin.student_lesson_content_create.page_title'))

@section('content')

<style>
    .student-content-form-page {
        --cream: #f7f1e5;
        --cream-light: #fffdf8;
        --gold: #b08d3c;
        --gold-light: #d4b86a;
        --green: #315c45;
        --green-dark: #234634;
        --green-soft: #eaf2ed;
        --text: #26352d;
        --muted: #7b817c;
        --border: #e7dfd0;
        --danger: #a94b4b;
        --white: #fff;
    }

    .student-content-form-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 25px;
    }

    .student-content-form-header-left {
        min-width: 0;
    }

    .student-content-form-breadcrumb {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
        color: var(--gold);
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .student-content-form-title {
        margin: 0;
        color: var(--green-dark);
        font-size: 29px;
        font-weight: 700;
    }

    .student-content-form-description {
        margin: 8px 0 0;
        color: var(--muted);
        font-size: 14px;
        line-height: 1.8;
    }

    .student-content-form-header-actions {
        display: flex;
        gap: 9px;
        flex-wrap: wrap;
    }

    .student-content-form-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 18px;
        padding: 25px;
        box-shadow: 0 8px 24px rgba(49, 92, 69, .05);
        max-width: 1000px;
    }

    .student-content-copy-box {
        margin-bottom: 22px;
        background: var(--green-soft);
        border: 1px solid #d6e5dc;
        border-radius: 14px;
        padding: 16px;
    }

    .student-content-copy-title {
        display: flex;
        align-items: center;
        gap: 8px;
        color: var(--green-dark);
        font-size: 13px;
        font-weight: 700;
    }

    .student-content-copy-title i {
        color: var(--gold);
    }

    .student-content-copy-text {
        margin-top: 6px;
        color: var(--muted);
        font-size: 12px;
        line-height: 1.7;
    }

    .student-content-copy-text strong {
        color: var(--green-dark);
    }

    .student-content-form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 19px;
    }

    .student-content-form-group {
        display: flex;
        flex-direction: column;
        gap: 7px;
    }

    .student-content-form-group.full {
        grid-column: 1 / -1;
    }

    .student-content-form-group.hidden-field {
        display: none;
    }

    .student-content-form-group label {
        display: flex;
        align-items: center;
        gap: 7px;
        color: var(--green-dark);
        font-size: 13px;
        font-weight: 700;
    }

    .student-content-form-group label i {
        width: 16px;
        color: var(--gold);
        text-align: center;
    }

    .required {
        color: var(--danger);
    }

    .student-content-form-control {
        width: 100%;
        min-height: 45px;
        border: 1px solid var(--border);
        border-radius: 11px;
        background: var(--cream-light);
        color: var(--text);
        padding: 10px 13px;
        font-family: inherit;
        font-size: 13px;
        outline: none;
        box-sizing: border-box;
        transition: .2s ease;
    }

    .student-content-form-control:focus {
        border-color: var(--gold);
        box-shadow: 0 0 0 3px rgba(176, 141, 60, .10);
        background: #fff;
    }

    .student-content-form-control::placeholder {
        color: #aaa397;
    }

    textarea.student-content-form-control {
        min-height: 130px;
        resize: vertical;
        line-height: 1.8;
    }

    textarea#content {
        min-height: 220px;
    }

    select.student-content-form-control {
        cursor: pointer;
    }

    input[type="file"].student-content-form-control {
        padding: 9px 10px;
        cursor: pointer;
    }

    input[type="number"].student-content-form-control {
        max-width: 100%;
    }

    .student-content-form-control.is-invalid {
        border-color: var(--danger);
        background: #fff8f7;
    }

    .student-content-form-help {
        color: var(--muted);
        font-size: 11px;
        line-height: 1.6;
    }

    .student-content-form-error {
        color: var(--danger);
        font-size: 11px;
        line-height: 1.5;
    }

    .student-content-type-info {
        grid-column: 1 / -1;
        display: none;
        align-items: flex-start;
        gap: 10px;
        padding: 12px 14px;
        border-radius: 11px;
        background: var(--cream);
        border: 1px solid var(--border);
        color: #6f675b;
        font-size: 11px;
        line-height: 1.7;
    }

    .student-content-type-info.active {
        display: flex;
    }

    .student-content-type-info i {
        margin-top: 2px;
        color: var(--gold);
    }

    .student-content-form-actions {
        margin-top: 25px;
        padding-top: 20px;
        border-top: 1px solid var(--border);
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }

    .student-content-form-btn {
        min-height: 44px;
        border-radius: 11px;
        padding: 0 17px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        border: 1px solid transparent;
        text-decoration: none;
        cursor: pointer;
        font-family: inherit;
        font-size: 13px;
        font-weight: 600;
        transition: .2s ease;
    }

    .student-content-form-btn:hover {
        transform: translateY(-1px);
    }

    .student-content-form-btn-primary {
        background: var(--green);
        color: #fff;
    }

    .student-content-form-btn-primary:hover {
        background: var(--green-dark);
        color: #fff;
    }

    .student-content-form-btn-secondary {
        background: var(--cream);
        color: var(--green-dark);
        border-color: var(--border);
    }

    .student-content-form-btn-secondary:hover {
        background: #eee6d7;
        color: var(--green-dark);
    }

    @media (max-width: 800px) {

        .student-content-form-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .student-content-form-header-actions {
            width: 100%;
        }

    }

    @media (max-width: 700px) {

        .student-content-form-grid {
            grid-template-columns: 1fr;
        }

        .student-content-form-group.full {
            grid-column: auto;
        }

        .student-content-type-info {
            grid-column: auto;
        }

        .student-content-form-card {
            padding: 17px;
        }

    }

    @media (max-width: 500px) {

        .student-content-form-actions {
            flex-direction: column-reverse;
            align-items: stretch;
        }

        .student-content-form-btn {
            width: 100%;
        }

    }
</style>

<div class="student-content-form-page">

{{-- ============================================================
    رأس الصفحة
============================================================ --}}

<div class="student-content-form-header">

    <div class="student-content-form-header-left">

        <div class="student-content-form-breadcrumb">

            <i class="fa-solid fa-graduation-cap"></i>

            <span>
                {{ __('education_admin.student_lesson_content_create.header.student_lessons') }}
            </span>

            <i class="fa-solid fa-chevron-left"></i>

            <span>
                {{ __('education_admin.student_lesson_content_create.header.content') }}
            </span>

            <i class="fa-solid fa-chevron-left"></i>

            <span>
                {{ __('education_admin.student_lesson_content_create.header.add') }}
            </span>

        </div>

        <h1 class="student-content-form-title">
            {{ __('education_admin.student_lesson_content_create.header.title') }}
        </h1>

        <p class="student-content-form-description">
            {{ __('education_admin.student_lesson_content_create.header.description') }}
        </p>

    </div>


    <div class="student-content-form-header-actions">

        <a
            href="{{ route(
                'education.admin.student-lessons.content.index',
                $studentLesson
            ) }}"
            class="student-content-form-btn student-content-form-btn-secondary"
        >
            <i class="fa-solid fa-arrow-left"></i>

            {{ __('education_admin.student_lesson_content_create.actions.back_to_content') }}

        </a>

    </div>

</div>


{{-- ============================================================
    بطاقة النموذج
============================================================ --}}

<div class="student-content-form-card">


    {{-- ========================================================
        معلومات الدرس المصدر
    ========================================================= --}}

    @if($studentLesson->sourceLesson)

        <div class="student-content-copy-box">

            <div class="student-content-copy-title">

                <i class="fa-solid fa-book-open"></i>

                <span>
                    {{ __('education_admin.student_lesson_content_create.source_lesson.title') }}
                </span>

            </div>

            <div class="student-content-copy-text">

                <strong>
                    {{ $studentLesson->sourceLesson->title }}
                </strong>

                <br>

                {{ __('education_admin.student_lesson_content_create.source_lesson.description') }}

            </div>

        </div>

    @endif


    {{-- ========================================================
        النموذج
    ========================================================= --}}

    <form
        method="POST"
        action="{{ route(
            'education.admin.student-lessons.content.store',
            $studentLesson
        ) }}"
        enctype="multipart/form-data"
    >

        @csrf


        <div class="student-content-form-grid">


            {{-- =================================================
                نوع المحتوى
            ================================================= --}}

            <div class="student-content-form-group">

                <label for="type">

                    <i class="fa-solid fa-layer-group"></i>

                    {{ __('education_admin.student_lesson_content_create.form.type.label') }}

                    <span class="required">*</span>

                </label>

                <select
                    id="type"
                    name="type"
                    class="student-content-form-control @error('type') is-invalid @enderror"
                    required
                >

                    <option value="">
                        {{ __('education_admin.student_lesson_content_create.form.type.placeholder') }}
                    </option>

                    <option
                        value="text"
                        @selected(old('type') === 'text')
                    >
                        {{ __('education_admin.student_lesson_content_create.form.type.text') }}
                    </option>

                    <option
                        value="image"
                        @selected(old('type') === 'image')
                    >
                        {{ __('education_admin.student_lesson_content_create.form.type.image') }}
                    </option>

                    <option
                        value="link"
                        @selected(old('type') === 'link')
                    >
                        {{ __('education_admin.student_lesson_content_create.form.type.link') }}
                    </option>

                    <option
                        value="file"
                        @selected(old('type') === 'file')
                    >
                        {{ __('education_admin.student_lesson_content_create.form.type.file') }}
                    </option>

                </select>

                @error('type')

                    <span class="student-content-form-error">
                        {{ $message }}
                    </span>

                @enderror

            </div>


            {{-- =================================================
                العنوان
            ================================================= --}}

            <div class="student-content-form-group">

                <label for="title">

                    <i class="fa-solid fa-heading"></i>

                    {{ __('education_admin.student_lesson_content_create.form.title.label') }}

                </label>

                <input
                    id="title"
                    type="text"
                    name="title"
                    value="{{ old('title') }}"
                    class="student-content-form-control @error('title') is-invalid @enderror"
                    placeholder="{{ __('education_admin.student_lesson_content_create.form.title.placeholder') }}"
                    maxlength="255"
                >

                @error('title')

                    <span class="student-content-form-error">
                        {{ $message }}
                    </span>

                @enderror

            </div>


            {{-- =================================================
                معلومات نوع المحتوى
            ================================================= --}}

            <div
                id="content-type-info"
                class="student-content-type-info"
            >

                <i class="fa-solid fa-circle-info"></i>

                <span id="content-type-info-text"></span>

            </div>


            {{-- =================================================
                الوصف
            ================================================= --}}

            <div class="student-content-form-group full">

                <label for="description">

                    <i class="fa-solid fa-align-left"></i>

                    {{ __('education_admin.student_lesson_content_create.form.description.label') }}

                </label>

                <textarea
                    id="description"
                    name="description"
                    class="student-content-form-control @error('description') is-invalid @enderror"
                    placeholder="{{ __('education_admin.student_lesson_content_create.form.description.placeholder') }}"
                    maxlength="5000"
                >{{ old('description') }}</textarea>

                @error('description')

                    <span class="student-content-form-error">
                        {{ $message }}
                    </span>

                @enderror

            </div>


            {{-- =================================================
                المحتوى النصي
            ================================================= --}}

            <div
                id="content-group"
                class="student-content-form-group full"
            >

                <label for="content">

                    <i class="fa-solid fa-align-left"></i>

                    {{ __('education_admin.student_lesson_content_create.form.content.label') }}

                </label>

                <textarea
                    id="content"
                    name="content"
                    class="student-content-form-control @error('content') is-invalid @enderror"
                    placeholder="{{ __('education_admin.student_lesson_content_create.form.content.placeholder') }}"
                >{{ old('content') }}</textarea>

                <span class="student-content-form-help">
                    {{ __('education_admin.student_lesson_content_create.form.content.help') }}
                </span>

                @error('content')

                    <span class="student-content-form-error">
                        {{ $message }}
                    </span>

                @enderror

            </div>


            {{-- =================================================
                الرابط
            ================================================= --}}

            <div
                id="url-group"
                class="student-content-form-group full"
            >

                <label for="url">

                    <i class="fa-solid fa-link"></i>

                    {{ __('education_admin.student_lesson_content_create.form.url.label') }}

                </label>

                <input
                    id="url"
                    type="url"
                    name="url"
                    value="{{ old('url') }}"
                    class="student-content-form-control @error('url') is-invalid @enderror"
                    placeholder="{{ __('education_admin.student_lesson_content_create.form.url.placeholder') }}"
                >

                <span class="student-content-form-help">
                    {{ __('education_admin.student_lesson_content_create.form.url.help') }}
                </span>

                @error('url')

                    <span class="student-content-form-error">
                        {{ $message }}
                    </span>

                @enderror

            </div>


            {{-- =================================================
                الملف
            ================================================= --}}

            <div
                id="file-group"
                class="student-content-form-group full"
            >

                <label for="file">

                    <i class="fa-solid fa-paperclip"></i>

                    {{ __('education_admin.student_lesson_content_create.form.file.label') }}

                </label>

                <input
                    id="file"
                    type="file"
                    name="file"
                    class="student-content-form-control @error('file') is-invalid @enderror"
                >

                <span class="student-content-form-help">
                    {{ __('education_admin.student_lesson_content_create.form.file.help') }}
                </span>

                @error('file')

                    <span class="student-content-form-error">
                        {{ $message }}
                    </span>

                @enderror

            </div>


            {{-- =================================================
                ترتيب العرض
            ================================================= --}}

            <div class="student-content-form-group">

                <label for="sort_order">

                    <i class="fa-solid fa-arrow-down-1-9"></i>

                    {{ __('education_admin.student_lesson_content_create.form.sort_order.label') }}

                </label>

                <input
                    id="sort_order"
                    type="number"
                    name="sort_order"
                    value="{{ old('sort_order', 0) }}"
                    min="0"
                    class="student-content-form-control @error('sort_order') is-invalid @enderror"
                >

                @error('sort_order')

                    <span class="student-content-form-error">
                        {{ $message }}
                    </span>

                @enderror

            </div>


            {{-- =================================================
                الحالة
            ================================================= --}}

            <div class="student-content-form-group">

                <label for="is_active">

                    <i class="fa-solid fa-eye"></i>

                    {{ __('education_admin.student_lesson_content_create.form.status.label') }}

                </label>

                <select
                    id="is_active"
                    name="is_active"
                    class="student-content-form-control @error('is_active') is-invalid @enderror"
                >

                    <option
                        value="1"
                        @selected(old('is_active', '1') == '1')
                    >
                        {{ __('education_admin.student_lesson_content_create.form.status.active') }}
                    </option>

                    <option
                        value="0"
                        @selected(old('is_active') === '0')
                    >
                        {{ __('education_admin.student_lesson_content_create.form.status.inactive') }}
                    </option>

                </select>

                @error('is_active')

                    <span class="student-content-form-error">
                        {{ $message }}
                    </span>

                @enderror

            </div>

        </div>


        {{-- ========================================================
            أزرار الإجراءات
        ========================================================= --}}

        <div class="student-content-form-actions">

            <a
                href="{{ route(
                    'education.admin.student-lessons.content.index',
                    $studentLesson
                ) }}"
                class="student-content-form-btn student-content-form-btn-secondary"
            >

                <i class="fa-solid fa-xmark"></i>

                {{ __('education_admin.student_lesson_content_create.actions.cancel') }}

            </a>


            <button
                type="submit"
                class="student-content-form-btn student-content-form-btn-primary"
            >

                <i class="fa-solid fa-floppy-disk"></i>

                {{ __('education_admin.student_lesson_content_create.actions.save') }}

            </button>

        </div>

    </form>

</div>

</div>

{{-- ================================================================
    سكربت الصفحة
================================================================ --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const typeSelect = document.getElementById('type');

    const contentGroup = document.getElementById('content-group');
    const urlGroup = document.getElementById('url-group');
    const fileGroup = document.getElementById('file-group');

    const contentTypeInfo = document.getElementById('content-type-info');
    const contentTypeInfoText = document.getElementById('content-type-info-text');


    if (!typeSelect) {
        return;
    }


    function updateContentFields() {

        const type = typeSelect.value;


        /* ------------------------------------------------------------
           إخفاء جميع الحقول الاختيارية
        ------------------------------------------------------------ */

        contentGroup.classList.add('hidden-field');
        urlGroup.classList.add('hidden-field');
        fileGroup.classList.add('hidden-field');

        contentTypeInfo.classList.remove('active');
        contentTypeInfoText.textContent = '';


        /* ------------------------------------------------------------
           نص
        ------------------------------------------------------------ */

        if (type === 'text') {

            contentGroup.classList.remove('hidden-field');

            contentTypeInfoText.textContent =
                @json(__('education_admin.student_lesson_content_create.type_info.text'));

            contentTypeInfo.classList.add('active');

        }


        /* ------------------------------------------------------------
           رابط
        ------------------------------------------------------------ */

        else if (type === 'link') {

            urlGroup.classList.remove('hidden-field');

            contentTypeInfoText.textContent =
                @json(__('education_admin.student_lesson_content_create.type_info.link'));

            contentTypeInfo.classList.add('active');

        }


        /* ------------------------------------------------------------
           صورة
        ------------------------------------------------------------ */

        else if (type === 'image') {

            fileGroup.classList.remove('hidden-field');

            contentTypeInfoText.textContent =
                @json(__('education_admin.student_lesson_content_create.type_info.image'));

            contentTypeInfo.classList.add('active');

        }


        /* ------------------------------------------------------------
           ملف
        ------------------------------------------------------------ */

        else if (type === 'file') {

            fileGroup.classList.remove('hidden-field');

            contentTypeInfoText.textContent =
                @json(__('education_admin.student_lesson_content_create.type_info.file'));

            contentTypeInfo.classList.add('active');

        }

    }


    typeSelect.addEventListener(
        'change',
        updateContentFields
    );


    updateContentFields();

});

</script>

@endsection
