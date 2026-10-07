@extends('education.admin.layouts.app')

@section('title', __('education_admin.student_lesson_content.page_title'))

@section('content')

<style>
    .student-content-page {
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

    .student-content-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 28px;
    }

    .student-content-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        color: var(--gold);
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .student-content-title {
        margin: 0;
        color: var(--green-dark);
        font-size: 30px;
        font-weight: 700;
    }

    .student-content-description {
        margin: 8px 0 0;
        color: var(--muted);
        font-size: 14px;
        line-height: 1.8;
    }

    .student-content-actions {
        display: flex;
        gap: 9px;
        flex-wrap: wrap;
    }

    .student-content-btn {
        min-height: 43px;
        padding: 0 15px;
        border-radius: 11px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        border: 1px solid transparent;
        transition: .2s ease;
    }

    .student-content-btn:hover {
        transform: translateY(-1px);
    }

    .student-content-btn-primary {
        background: var(--green);
        color: #fff;
    }

    .student-content-btn-primary:hover {
        background: var(--green-dark);
        color: #fff;
    }

    .student-content-btn-secondary {
        background: var(--cream);
        color: var(--green-dark);
        border-color: var(--border);
    }

    .student-content-btn-secondary:hover {
        background: #efe6d6;
        color: var(--green-dark);
    }

    .student-content-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 8px 24px rgba(49,92,69,.05);
    }

    .student-content-card-header {
        padding: 18px 20px;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
    }

    .student-content-card-title {
        display: flex;
        align-items: center;
        gap: 10px;
        color: var(--green-dark);
        font-size: 16px;
        font-weight: 700;
    }

    .student-content-card-title i {
        color: var(--gold);
    }

    .student-content-count {
        color: var(--muted);
        font-size: 12px;
        white-space: nowrap;
    }

    .student-content-source {
        background: var(--green-soft);
        border: 1px solid #d8e7dd;
        border-radius: 14px;
        margin: 20px;
        padding: 15px 17px;
    }

    .student-content-source-label {
        color: var(--muted);
        font-size: 11px;
        margin-bottom: 5px;
    }

    .student-content-source-title {
        color: var(--green-dark);
        font-size: 14px;
        font-weight: 700;
    }

    .student-content-list {
        padding: 0 20px 20px;
    }

    .student-content-item {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 15px;
        border: 1px solid var(--border);
        border-radius: 14px;
        margin-bottom: 10px;
        background: var(--cream-light);
        transition: .2s ease;
    }

    .student-content-item:last-child {
        margin-bottom: 0;
    }

    .student-content-item:hover {
        border-color: var(--gold-light);
        box-shadow: 0 5px 15px rgba(49,92,69,.05);
    }

    .student-content-sort {
        width: 32px;
        height: 32px;
        border-radius: 9px;
        background: var(--cream);
        color: var(--gold);
        display: flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 auto;
        font-weight: 700;
        font-size: 12px;
    }

    .student-content-type {
        width: 40px;
        height: 40px;
        border-radius: 11px;
        background: var(--green-soft);
        color: var(--green);
        display: flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 auto;
    }

    .student-content-info {
        flex: 1;
        min-width: 0;
    }

    .student-content-item-title {
        color: var(--green-dark);
        font-weight: 700;
        font-size: 13px;
    }

    .student-content-item-description {
        margin-top: 4px;
        color: var(--muted);
        font-size: 11px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .student-content-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 9px;
        border-radius: 999px;
        font-size: 10px;
        font-weight: 700;
        white-space: nowrap;
    }

    .student-content-badge.active {
        background: var(--green-soft);
        color: var(--green);
    }

    .student-content-badge.inactive {
        background: #f8ecec;
        color: var(--danger);
    }

    .student-content-item-actions {
        display: flex;
        gap: 6px;
        flex: 0 0 auto;
    }

    .student-content-item-actions form {
        margin: 0;
    }

    .student-content-action {
        width: 33px;
        height: 33px;
        border-radius: 9px;
        border: 1px solid var(--border);
        background: #fff;
        color: var(--green);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        cursor: pointer;
        transition: .2s ease;
    }

    .student-content-action:hover {
        background: var(--green);
        color: #fff;
        border-color: var(--green);
    }

    .student-content-action.edit:hover {
        background: var(--gold);
        border-color: var(--gold);
    }

    .student-content-action.delete:hover {
        background: var(--danger);
        border-color: var(--danger);
    }

    .student-content-empty {
        text-align: center;
        padding: 65px 25px;
    }

    .student-content-empty-icon {
        width: 65px;
        height: 65px;
        border-radius: 18px;
        background: var(--cream);
        color: var(--gold);
        margin: 0 auto 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }

    .student-content-empty h3 {
        margin: 0;
        color: var(--green-dark);
        font-size: 17px;
    }

    .student-content-empty p {
        max-width: 430px;
        margin: 8px auto 0;
        color: var(--muted);
        font-size: 13px;
        line-height: 1.8;
    }

    .student-content-empty-action {
        margin-top: 20px;
    }

    @media(max-width: 800px) {

        .student-content-header {
            flex-direction: column;
        }

        .student-content-actions {
            width: 100%;
        }

        .student-content-actions .student-content-btn {
            flex: 1;
        }

        .student-content-item {
            flex-wrap: wrap;
        }

        .student-content-info {
            min-width: calc(100% - 100px);
        }

        .student-content-badge {
            margin-left: 46px;
        }

        .student-content-item-actions {
            width: 100%;
            justify-content: flex-end;
            padding-top: 4px;
        }
    }

    @media(max-width: 500px) {

        .student-content-title {
            font-size: 25px;
        }

        .student-content-card-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .student-content-source {
            margin: 15px;
        }

        .student-content-list {
            padding: 0 15px 15px;
        }

        .student-content-item {
            gap: 10px;
        }

        .student-content-badge {
            margin-left: 0;
        }
    }
</style>


<div class="student-content-page">

    {{-- ============================================================
        الرأس
    ============================================================ --}}

    <div class="student-content-header">

        <div>

            <div class="student-content-breadcrumb">

                <i class="fa-solid fa-graduation-cap"></i>

                <span>
                    {{ __('education_admin.student_lesson_content.header.student_lessons') }}
                </span>

                <i class="fa-solid fa-chevron-left"></i>

                <span>
                    {{ __('education_admin.student_lesson_content.header.content') }}
                </span>

            </div>

            <h1 class="student-content-title">
                {{ __('education_admin.student_lesson_content.header.title') }}
            </h1>

            <p class="student-content-description">
                {{ __('education_admin.student_lesson_content.header.description') }}
            </p>

        </div>


        <div class="student-content-actions">

            <a
                href="{{ route(
                    'education.admin.student-lessons.show',
                    $studentLesson
                ) }}"
                class="student-content-btn student-content-btn-secondary"
            >
                <i class="fa-solid fa-arrow-right"></i>
                {{ __('education_admin.student_lesson_content.actions.back_to_lesson') }}
            </a>


            <a
                href="{{ route(
                    'education.admin.student-lessons.content.create',
                    $studentLesson
                ) }}"
                class="student-content-btn student-content-btn-primary"
            >
                <i class="fa-solid fa-plus"></i>
                {{ __('education_admin.student_lesson_content.actions.add_content') }}
            </a>

        </div>

    </div>


    {{-- ============================================================
        بطاقة المحتوى
    ============================================================ --}}

    <div class="student-content-card">

        <div class="student-content-card-header">

            <div class="student-content-card-title">

                <i class="fa-solid fa-book-open"></i>

                <span>
                    {{ $studentLesson->title ?? __('education_admin.student_lesson_content.content.default_title') }}
                </span>

            </div>

            <span class="student-content-count">

                {{ $contents->count() }}

                {{ $contents->count() === 1
                    ? __('education_admin.student_lesson_content.content.count_one')
                    : __('education_admin.student_lesson_content.content.count_many')
                }}

            </span>

        </div>


        {{-- ========================================================
            الدرس المصدر
        ========================================================= --}}

        @if($studentLesson->sourceLesson)

            <div class="student-content-source">

                <div class="student-content-source-label">
                    {{ __('education_admin.student_lesson_content.content.source_label') }}
                </div>

                <div class="student-content-source-title">
                    {{ $studentLesson->sourceLesson->title }}
                </div>

            </div>

        @endif


        {{-- ========================================================
            قائمة المحتوى
        ========================================================= --}}

        @if($contents->count())

            <div class="student-content-list">

                @foreach($contents as $content)

                    @php

                        $typeIcon = match($content->type) {

                            'text' => 'fa-align-left',

                            'image' => 'fa-image',

                            'link' => 'fa-link',

                            'file' => 'fa-file',

                            default => 'fa-file-lines',

                        };

                    @endphp


                    <div class="student-content-item">

                        {{-- رقم الترتيب --}}
                        <div class="student-content-sort">
                            {{ $loop->iteration }}
                        </div>


                        {{-- نوع المحتوى --}}
                        <div class="student-content-type">

                            <i class="fa-solid {{ $typeIcon }}"></i>

                        </div>


                        {{-- معلومات المحتوى --}}
                        <div class="student-content-info">

                            <div class="student-content-item-title">

                                {{ $content->title ?: __('education_admin.student_lesson_content.content.untitled') }}

                            </div>


                            @if($content->description)

                                <div class="student-content-item-description">

                                    {{ $content->description }}

                                </div>

                            @endif

                        </div>


                        {{-- الحالة --}}
                        <span
                            class="student-content-badge {{ $content->is_active ? 'active' : 'inactive' }}"
                        >

                            <i class="fa-solid
                                {{ $content->is_active
                                    ? 'fa-circle-check'
                                    : 'fa-circle-xmark'
                                }}
                            "></i>

                            {{ $content->is_active
                                ? __('education_admin.student_lesson_content.status.active')
                                : __('education_admin.student_lesson_content.status.inactive')
                            }}

                        </span>


                        {{-- الإجراءات --}}
                        <div class="student-content-item-actions">

                            {{-- عرض --}}
                            <a
                                href="{{ route(
                                    'education.admin.student-lessons.content.show',
                                    [$studentLesson, $content]
                                ) }}"
                                class="student-content-action"
                                title="{{ __('education_admin.student_lesson_content.actions_item.view') }}"
                                aria-label="{{ __('education_admin.student_lesson_content.actions_item.view') }}"
                            >
                                <i class="fa-solid fa-eye"></i>
                            </a>


                            {{-- تعديل --}}
                            <a
                                href="{{ route(
                                    'education.admin.student-lessons.content.edit',
                                    [$studentLesson, $content]
                                ) }}"
                                class="student-content-action edit"
                                title="{{ __('education_admin.student_lesson_content.actions_item.edit') }}"
                                aria-label="{{ __('education_admin.student_lesson_content.actions_item.edit') }}"
                            >
                                <i class="fa-solid fa-pen"></i>
                            </a>


                            {{-- حذف --}}
                            <form
                                method="POST"
                                action="{{ route(
                                    'education.admin.student-lessons.content.destroy',
                                    [$studentLesson, $content]
                                ) }}"
                                onsubmit="return confirm(@json(__('education_admin.student_lesson_content.delete.confirm')));"
                            >

                                @csrf

                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="student-content-action delete"
                                    title="{{ __('education_admin.student_lesson_content.actions_item.delete') }}"
                                    aria-label="{{ __('education_admin.student_lesson_content.actions_item.delete') }}"
                                >
                                    <i class="fa-solid fa-trash"></i>
                                </button>

                            </form>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            {{-- ====================================================
                حالة عدم وجود محتوى
            ===================================================== --}}

            <div class="student-content-empty">

                <div class="student-content-empty-icon">

                    <i class="fa-solid fa-file-circle-plus"></i>

                </div>

                <h3>
                    {{ __('education_admin.student_lesson_content.empty.title') }}
                </h3>

                <p>
                    {{ __('education_admin.student_lesson_content.empty.description') }}
                </p>


                <div class="student-content-empty-action">

                    <a
                        href="{{ route(
                            'education.admin.student-lessons.content.create',
                            $studentLesson
                        ) }}"
                        class="student-content-btn student-content-btn-primary"
                    >

                        <i class="fa-solid fa-plus"></i>

                        {{ __('education_admin.student_lesson_content.actions.add_first_content') }}

                    </a>

                </div>

            </div>

        @endif

    </div>

</div>

@endsection
