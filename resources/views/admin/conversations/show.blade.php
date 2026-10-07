@extends('admin.layouts.app')

@section(
    'title',
    isset($contactMessage)
        ? (
            app()->getLocale() === 'ar'
                ? 'رسالة زائر'
                : 'Visitor Message'
        )
        : __('digital_studio_admin.conversations.show.title')
)

@section('content')

<!--==================================
        PAGE HEADER
==================================-->

<div class="dashboard-header">

    <div class="dashboard-header-left">

        <div class="dashboard-breadcrumb">

            <i class="fa-solid fa-comments"></i>

            <span>
                {{ __('digital_studio_admin.conversations.show.breadcrumb.conversations') }}
            </span>

            <i class="fa-solid fa-angle-right"></i>

            <span>
                {{ isset($contactMessage)
                    ? (
                        app()->getLocale() === 'ar'
                            ? 'رسالة زائر'
                            : 'Visitor Message'
                    )
                    : __('digital_studio_admin.conversations.show.breadcrumb.conversation')
                }}
            </span>

        </div>

        <h1 class="text-white">

            @if(isset($contactMessage))

                {{ $contactMessage->subject }}

            @else

                {{ $conversation->subject }}

            @endif

        </h1>

        <p class="text-white">

            @if(isset($contactMessage))

                {{ app()->getLocale() === 'ar'
                    ? 'عرض تفاصيل الرسالة والرد على الزائر عبر البريد الإلكتروني.'
                    : 'View the message details and reply to the visitor by email.'
                }}

            @else

                {{ __('digital_studio_admin.conversations.show.page_header.description') }}

            @endif

        </p>

    </div>

    <div class="dashboard-header-right">

        <a
            href="{{ route('admin.conversations.index') }}"
            class="btn btn-light rounded-pill px-4">

            <i class="fa-solid fa-arrow-left me-2"></i>

            {{ __('digital_studio_admin.conversations.show.page_header.back') }}

        </a>

    </div>

</div>


<!--==================================
        ALERTS
==================================-->

@if(session('success'))

    <div class="alert alert-success rounded-4 shadow-sm mb-4">

        <i class="fa-solid fa-circle-check me-2"></i>

        {{ session('success') }}

    </div>

@endif


@if(session('error'))

    <div class="alert alert-danger rounded-4 shadow-sm mb-4">

        <i class="fa-solid fa-circle-exclamation me-2"></i>

        {{ session('error') }}

    </div>

@endif


@if($errors->any())

    <div class="alert alert-danger rounded-4 shadow-sm mb-4">

        <h6 class="fw-bold mb-3">

            <i class="fa-solid fa-circle-exclamation me-2"></i>

            {{ __('digital_studio_admin.conversations.show.alerts.validation') }}

        </h6>

        <ul class="mb-0">

            @foreach($errors->all() as $error)

                <li>
                    {{ $error }}
                </li>

            @endforeach

        </ul>

    </div>

@endif


@if(isset($contactMessage))

<!--==================================================
        VISITOR CONTACT MESSAGE
==================================================-->

<div class="row g-4">


    <!--==================================
            LEFT
            MESSAGE + REPLY
    ==================================-->

    <div class="col-lg-8">

        <div class="admin-card">


            <!--==================================
                    MESSAGE HEADER
            ==================================-->

            <div
                class="d-flex align-items-center justify-content-between flex-wrap gap-3 pb-4 mb-4 border-bottom">

                <div class="d-flex align-items-center">

                    <div
                        class="rounded-circle d-flex align-items-center justify-content-center me-3"
                        style="
                            width:55px;
                            height:55px;
                            background:rgba(212,160,23,.12);
                        ">

                        <i
                            class="fa-solid fa-user-pen"
                            style="
                                color:#d4a017;
                                font-size:20px;
                            ">
                        </i>

                    </div>

                    <div>

                        <h5
                            class="fw-bold mb-1"
                            style="color:white;">

                            {{ $contactMessage->name }}

                        </h5>

                        <small style="color:white;">

                            {{ $contactMessage->email }}

                        </small>

                    </div>

                </div>


                <!-- STATUS -->

                <div>

                    @if($contactMessage->status === 'new')

                        <span
                            class="badge rounded-pill px-3 py-2"
                            style="
                                background:rgba(212,160,23,.15);
                                color:#d4a017;
                            ">

                            <i
                                class="fa-solid fa-circle me-1"
                                style="font-size:7px;">
                            </i>

                            {{ app()->getLocale() === 'ar'
                                ? 'جديدة'
                                : 'New'
                            }}

                        </span>

                    @elseif($contactMessage->status === 'read')

                        <span
                            class="badge bg-secondary-subtle text-secondary rounded-pill px-3 py-2">

                            <i class="fa-solid fa-envelope-open me-1"></i>

                            {{ app()->getLocale() === 'ar'
                                ? 'مقروءة'
                                : 'Read'
                            }}

                        </span>

                    @elseif($contactMessage->status === 'replied')

                        <span
                            class="badge bg-success-subtle text-success rounded-pill px-3 py-2">

                            <i class="fa-solid fa-reply me-1"></i>

                            {{ app()->getLocale() === 'ar'
                                ? 'تمت الإجابة'
                                : 'Replied'
                            }}

                        </span>

                    @endif

                </div>

            </div>


            <!--==================================
                    SUBJECT
            ==================================-->

            <div class="mb-4">

                <small class="d-block mb-1 text-white">

                    {{ app()->getLocale() === 'ar'
                        ? 'موضوع الرسالة'
                        : 'Message Subject'
                    }}

                </small>

                <h5 class="fw-bold mb-0">

                    {{ $contactMessage->subject }}

                </h5>

            </div>


            <!--==================================
                    ORIGINAL MESSAGE
            ==================================-->

            <div class="mb-4">

                <small class="d-block mb-2 text-white">

                    {{ app()->getLocale() === 'ar'
                        ? 'نص الرسالة'
                        : 'Message'
                    }}

                </small>

                <div
                    class="p-4 rounded-4 text-white"
                    style="
                        background:#021634;
                        border-top-right-radius:6px !important;
                        white-space:pre-wrap;
                        word-break:break-word;
                        line-height:1.9;
                    ">

                    {{ $contactMessage->message }}

                </div>

            </div>


            <!--==================================
                    DATE
            ==================================-->

            <div class="border-top pt-4 mt-4">

                <div
                    class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                    <small class="text-white">

                        <i class="fa-regular fa-clock me-1"></i>

                        {{ app()->getLocale() === 'ar'
                            ? 'تاريخ الإرسال'
                            : 'Sent At'
                        }}

                    </small>

                    <strong class="text-white">

                        {{ $contactMessage->created_at->format('d M Y - h:i A') }}

                        <span class="text-muted ms-2">

                            ({{ $contactMessage->created_at->diffForHumans() }})

                        </span>

                    </strong>

                </div>

            </div>


            <!--==================================
                    REPLY TO VISITOR
            ==================================-->

            <div class="border-top pt-4 mt-4">

                <div class="d-flex align-items-center mb-4">

                    <div
                        class="dashboard-icon me-3">

                        <i class="fa-solid fa-reply"></i>

                    </div>

                    <div>

                        <h5 class="card-title mb-1">

                            {{ app()->getLocale() === 'ar'
                                ? 'الرد على الزائر'
                                : 'Reply to Visitor'
                            }}

                        </h5>

                        <small>

                            {{ app()->getLocale() === 'ar'
                                ? 'سيتم إرسال الرد مباشرة إلى البريد الإلكتروني للزائر.'
                                : 'Your reply will be sent directly to the visitor by email.'
                            }}

                        </small>

                    </div>

                </div>


                <form
                    action="{{ route(
                        'admin.conversations.contact.reply',
                        $contactMessage
                    ) }}"
                    method="POST">

                    @csrf


                    <div class="mb-3">

                        <label
                            for="visitorReply"
                            class="form-label fw-semibold">

                            {{ app()->getLocale() === 'ar'
                                ? 'نص الرد'
                                : 'Reply Message'
                            }}

                        </label>

                        <textarea
                            id="visitorReply"
                            name="message"
                            rows="7"
                            maxlength="5000"
                            class="form-control rounded-4"
                            style="
                                color:white;
                                resize:vertical;
                            "
                            placeholder="{{ app()->getLocale() === 'ar'
                                ? 'اكتب ردك على الزائر هنا...'
                                : 'Write your reply to the visitor here...'
                            }}"
                            required>{{ old('message') }}</textarea>

                    </div>


                    <div
                        class="d-flex justify-content-between align-items-center mt-3 flex-wrap gap-3">

                        <small>

                            <i
                                class="fa-solid fa-circle-info me-1"
                                style="color:white;">
                            </i>

                            {{ app()->getLocale() === 'ar'
                                ? 'سيتم إرسال الرسالة إلى:'
                                : 'The message will be sent to:'
                            }}

                            <strong>

                                {{ $contactMessage->email }}

                            </strong>

                        </small>


                        <button
                            type="submit"
                            class="btn btn-primary rounded-pill px-4">

                            <i class="fa-solid fa-paper-plane me-2"></i>

                            {{ app()->getLocale() === 'ar'
                                ? 'إرسال الرد'
                                : 'Send Reply'
                            }}

                        </button>

                    </div>

                </form>

            </div>


        </div>

    </div>


    <!--==================================
            RIGHT SIDEBAR
    ==================================-->

    <div class="col-lg-4">


        <!--==================================
                VISITOR INFORMATION
        ==================================-->

        <div class="admin-card mb-4">

            <div class="d-flex align-items-center mb-4">

                <div class="dashboard-icon me-3">

                    <i class="fa-solid fa-user"></i>

                </div>

                <div>

                    <h5 class="card-title mb-1">

                        {{ app()->getLocale() === 'ar'
                            ? 'بيانات الزائر'
                            : 'Visitor Information'
                        }}

                    </h5>

                    <small>

                        {{ app()->getLocale() === 'ar'
                            ? 'بيانات صاحب الرسالة'
                            : 'Message sender details'
                        }}

                    </small>

                </div>

            </div>


            <div class="text-center mb-4">

                <div
                    class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center"
                    style="
                        width:90px;
                        height:90px;
                        background:rgba(212,160,23,.12);
                    ">

                    <i
                        class="fa-solid fa-user"
                        style="
                            color:#d4a017;
                            font-size:32px;
                        ">
                    </i>

                </div>


                <h5 class="fw-bold mb-1">

                    {{ $contactMessage->name }}

                </h5>


                <p
                    class="mb-0"
                    style="
                        word-break:break-word;
                    ">

                    {{ $contactMessage->email }}

                </p>

            </div>


            <div class="border-top pt-3">

                <div class="mb-3">

                    <small class="d-block">

                        {{ app()->getLocale() === 'ar'
                            ? 'الاسم'
                            : 'Name'
                        }}

                    </small>

                    <strong>

                        {{ $contactMessage->name }}

                    </strong>

                </div>


                <div class="mb-3">

                    <small class="d-block">

                        {{ app()->getLocale() === 'ar'
                            ? 'البريد الإلكتروني'
                            : 'Email Address'
                        }}

                    </small>

                    <strong
                        style="word-break:break-word;">

                        {{ $contactMessage->email }}

                    </strong>

                </div>


                <div>

                    <small class="d-block">

                        {{ app()->getLocale() === 'ar'
                            ? 'تاريخ الإرسال'
                            : 'Submitted At'
                        }}

                    </small>

                    <strong>

                        {{ $contactMessage->created_at->format('d M Y') }}

                    </strong>

                </div>

            </div>

        </div>


        <!--==================================
                MESSAGE DETAILS
        ==================================-->

        <div class="admin-card mb-4">

            <div class="d-flex align-items-center mb-4">

                <div class="dashboard-icon me-3">

                    <i class="fa-solid fa-circle-info"></i>

                </div>

                <div>

                    <h5 class="card-title mb-1">

                        {{ app()->getLocale() === 'ar'
                            ? 'تفاصيل الرسالة'
                            : 'Message Details'
                        }}

                    </h5>

                    <small>

                        {{ app()->getLocale() === 'ar'
                            ? 'معلومات حالة الرسالة'
                            : 'Message status information'
                        }}

                    </small>

                </div>

            </div>


            <div class="mb-3">

                <small class="d-block mb-1">

                    {{ app()->getLocale() === 'ar'
                        ? 'الحالة'
                        : 'Status'
                    }}

                </small>

                <strong>

                    @if($contactMessage->status === 'new')

                        {{ app()->getLocale() === 'ar'
                            ? 'جديدة'
                            : 'New'
                        }}

                    @elseif($contactMessage->status === 'read')

                        {{ app()->getLocale() === 'ar'
                            ? 'مقروءة'
                            : 'Read'
                        }}

                    @else

                        {{ app()->getLocale() === 'ar'
                            ? 'تمت الإجابة'
                            : 'Replied'
                        }}

                    @endif

                </strong>

            </div>


            <div class="mb-3">

                <small class="d-block mb-1">

                    {{ app()->getLocale() === 'ar'
                        ? 'رقم الرسالة'
                        : 'Message ID'
                    }}

                </small>

                <strong>

                    #{{ $contactMessage->id }}

                </strong>

            </div>


            <div class="mb-3">

                <small class="d-block mb-1">

                    {{ app()->getLocale() === 'ar'
                        ? 'تاريخ الإنشاء'
                        : 'Created'
                    }}

                </small>

                <strong>

                    {{ $contactMessage->created_at->format('d M Y - h:i A') }}

                </strong>

            </div>


            <div class="mb-3">

                <small class="d-block mb-1">

                    {{ app()->getLocale() === 'ar'
                        ? 'تاريخ القراءة'
                        : 'Read At'
                    }}

                </small>

                <strong>

                    @if($contactMessage->read_at)

                        {{ $contactMessage->read_at->format('d M Y - h:i A') }}

                    @else

                        —

                    @endif

                </strong>

            </div>


            <div>

                <small class="d-block mb-1">

                    {{ app()->getLocale() === 'ar'
                        ? 'تاريخ الرد'
                        : 'Replied At'
                    }}

                </small>

                <strong>

                    @if($contactMessage->replied_at)

                        {{ $contactMessage->replied_at->format('d M Y - h:i A') }}

                    @else

                        —

                    @endif

                </strong>

            </div>

        </div>


        <!--==================================
                ACTIONS
        ==================================-->

        <div class="admin-card">

            <h5 class="card-title mb-4">

                {{ app()->getLocale() === 'ar'
                    ? 'إجراءات الرسالة'
                    : 'Message Actions'
                }}

            </h5>


            <div class="d-grid gap-2">


                @if($contactMessage->status === 'new')

                    <form
                        action="{{ route(
                            'admin.conversations.contact.read',
                            $contactMessage
                        ) }}"
                        method="POST">

                        @csrf

                        <button
                            type="submit"
                            class="btn btn-light rounded-pill w-100">

                            <i class="fa-solid fa-envelope-open me-2"></i>

                            {{ app()->getLocale() === 'ar'
                                ? 'تحديد كمقروءة'
                                : 'Mark as Read'
                            }}

                        </button>

                    </form>

                @endif


                @if($contactMessage->status !== 'replied')

                    <form
                        action="{{ route(
                            'admin.conversations.contact.replied',
                            $contactMessage
                        ) }}"
                        method="POST">

                        @csrf

                        <button
                            type="submit"
                            class="btn btn-primary rounded-pill w-100">

                            <i class="fa-solid fa-reply me-2"></i>

                            {{ app()->getLocale() === 'ar'
                                ? 'تحديد كتمت الإجابة'
                                : 'Mark as Replied'
                            }}

                        </button>

                    </form>

                @endif


                <form
                    action="{{ route(
                        'admin.conversations.contact.destroy',
                        $contactMessage
                    ) }}"
                    method="POST"
                    onsubmit="return confirm('{{ app()->getLocale() === 'ar'
                        ? 'هل أنت متأكد من حذف هذه الرسالة؟'
                        : 'Are you sure you want to delete this message?'
                    }}');">

                    @csrf

                    @method('DELETE')

                    <button
                        type="submit"
                        class="btn btn-outline-danger rounded-pill w-100">

                        <i class="fa-solid fa-trash me-2"></i>

                        {{ app()->getLocale() === 'ar'
                            ? 'حذف الرسالة'
                            : 'Delete Message'
                        }}

                    </button>

                </form>


            </div>

        </div>


    </div>

</div>


@else

<!--==================================================
        AUTHENTICATED USER CONVERSATION
==================================================-->

<div class="row g-4">


    <!--==================================
            LEFT
            CONVERSATION
    ==================================-->

    <div class="col-lg-8">


        <!--==================================
                CONVERSATION CARD
        ==================================-->

        <div class="admin-card">


            <!--==================================
                    CHAT HEADER
            ==================================-->

            <div
                class="d-flex align-items-center justify-content-between flex-wrap gap-3 pb-4 mb-4 border-bottom">


                <div class="d-flex align-items-center">


                    @if($conversation->user)

                        <img
                            src="{{ $conversation->user->avatar_url }}"
                            alt="{{ $conversation->user->name }}"
                            class="rounded-circle me-3"
                            style="
                                width:55px;
                                height:55px;
                                object-fit:cover;
                            ">

                        <div>

                            <h5
                                class="fw-bold mb-1"
                                style="color: white">

                                {{ $conversation->user->name }}

                            </h5>

                            <small style="color: white">

                                {{ $conversation->user->email }}

                            </small>

                        </div>

                    @else

                        <div
                            class="rounded-circle bg-light d-flex align-items-center justify-content-center me-3"
                            style="
                                width:55px;
                                height:55px;
                            ">

                            <i class="fa-solid fa-user text-muted"></i>

                        </div>

                        <div>

                            <h5
                                class="fw-bold mb-1"
                                style="color: white">

                                {{ __('digital_studio_admin.conversations.show.user.unknown') }}

                            </h5>

                            <small
                                class="text-muted"
                                style="color: white">

                                {{ __('digital_studio_admin.conversations.show.user.unavailable') }}

                            </small>

                        </div>

                    @endif

                </div>


                <!-- Status -->

                <div>

                    @if($conversation->status === 'open')

                        <span
                            class="badge bg-success-subtle text-success rounded-pill px-3 py-2">

                            <i
                                class="fa-solid fa-circle me-1"
                                style="font-size:7px;"></i>

                            {{ __('digital_studio_admin.conversations.show.statuses.open') }}

                        </span>

                    @elseif($conversation->status === 'closed')

                        <span
                            class="badge bg-secondary-subtle text-secondary rounded-pill px-3 py-2">

                            <i
                                class="fa-solid fa-circle me-1"
                                style="font-size:7px;"></i>

                            {{ __('digital_studio_admin.conversations.show.statuses.closed') }}

                        </span>

                    @elseif($conversation->status === 'archived')

                        <span
                            class="badge bg-warning-subtle text-warning rounded-pill px-3 py-2">

                            <i class="fa-solid fa-box-archive me-1"></i>

                            {{ __('digital_studio_admin.conversations.show.statuses.archived') }}

                        </span>

                    @endif

                </div>

            </div>


            <!--==================================
                    SUBJECT
            ==================================-->

            <div class="mb-4">

                <small class="d-block mb-1 text-white">

                    {{ __('digital_studio_admin.conversations.show.fields.subject') }}

                </small>

                <h5 class="fw-bold mb-0">

                    {{ $conversation->subject }}

                </h5>

            </div>


            <!--==================================
                    MESSAGES
            ==================================-->

            <div
                class="conversation-messages"
                style="
                    max-height:600px;
                    overflow-y:auto;
                    padding:10px 5px;
                ">


                @forelse($conversation->messages as $message)


                    @if($message->sender_type === 'user')

                        <!--==================================
                                USER MESSAGE
                        ==================================-->

                        <div
                            class="d-flex align-items-start mb-4">


                            <div
                                class="flex-shrink-0 me-3">

                                @if($conversation->user)

                                    <img
                                        src="{{ $conversation->user->avatar_url }}"
                                        alt="{{ $message->sender_name }}"
                                        class="rounded-circle"
                                        style="
                                            width:42px;
                                            height:42px;
                                            object-fit:cover;
                                        ">

                                @else

                                    <div
                                        class="rounded-circle bg-light d-flex align-items-center justify-content-center"
                                        style="
                                            width:42px;
                                            height:42px;
                                        ">

                                        <i class="fa-solid fa-user text-muted"></i>

                                    </div>

                                @endif

                            </div>


                            <div
                                style="
                                    max-width:78%;
                                ">


                                <div
                                    class="d-flex align-items-center gap-2 mb-1">

                                    <strong class="text-white">

                                        {{ $message->sender_name }}

                                    </strong>

                                    <small style="color: white">

                                        {{ $message->created_at->diffForHumans() }}

                                    </small>

                                </div>


                                <div
                                    class="p-3 rounded-4 text-white"
                                    style="
                                        background:#021634;
                                        border-top-left-radius:6px !important;
                                    ">

                                    <div
                                        class="text-white"
                                        style="
                                            white-space:pre-wrap;
                                            word-break:break-word;
                                        ">

                                        {{ $message->message }}

                                    </div>

                                </div>


                                <small
                                    class="d-block mt-1 text-white">

                                    {{ $message->created_at->format('d M Y - h:i A') }}

                                </small>

                            </div>

                        </div>


                    @else


                        <!--==================================
                                ADMIN MESSAGE
                        ==================================-->

                        <div
                            class="d-flex justify-content-end mb-4">


                            <div
                                style="
                                    max-width:78%;
                                ">


                                <div
                                    class="d-flex align-items-center justify-content-end gap-2 mb-1">

                                    <small>

                                        {{ $message->created_at->diffForHumans() }}

                                    </small>

                                    <strong class="text-white">

                                        {{ $message->sender_name }}

                                    </strong>

                                </div>


                                <div
                                    class="p-3 rounded-4 text-white"
                                    style="
                                        background:var(--bs-primary, #0d6efd);
                                        color:#fff;
                                        border-top-right-radius:6px !important;
                                    ">

                                    <div
                                        class="text-white"
                                        style="
                                            white-space:pre-wrap;
                                            word-break:break-word;
                                        ">

                                        {{ $message->message }}

                                    </div>

                                </div>


                                <small
                                    class="d-block mt-1 text-end">

                                    {{ $message->created_at->format('d M Y - h:i A') }}

                                    @if($message->is_read)

                                        <i
                                            class="fa-solid fa-check-double ms-1"></i>

                                    @else

                                        <i
                                            class="fa-solid fa-check ms-1"></i>

                                    @endif

                                </small>

                            </div>


                            <div
                                class="flex-shrink-0 ms-3">

                                <div
                                    class="rounded-circle bg-primary-subtle d-flex align-items-center justify-content-center"
                                    style="
                                        width:42px;
                                        height:42px;
                                    ">

                                    <i
                                        class="fa-solid fa-user-shield text-primary"></i>

                                </div>

                            </div>

                        </div>

                    @endif


                @empty


                    <!--==================================
                            EMPTY
                    ==================================-->

                    <div class="text-center py-5">

                        <div
                            class="dashboard-icon mx-auto mb-3"
                            style="
                                width:65px;
                                height:65px;
                                display:flex;
                                align-items:center;
                                justify-content:center;
                            ">

                            <i class="fa-solid fa-comment-slash fa-2x"></i>

                        </div>

                        <h5 class="fw-bold text-white">

                            {{ __('digital_studio_admin.conversations.show.messages.empty_title') }}

                        </h5>

                        <p class="text-muted mb-0 text-white">

                            {{ __('digital_studio_admin.conversations.show.messages.empty_description') }}

                        </p>

                    </div>


                @endforelse


            </div>


            <!--==================================
                    REPLY
            ==================================-->

            @if($conversation->status === 'open')

                <div class="border-top pt-4 mt-4">

                    <form
                        action="{{ route(
                            'admin.conversations.send',
                            $conversation
                        ) }}"
                        method="POST">

                        @csrf


                        <label class="form-label fw-semibold">

                            {{ __('digital_studio_admin.conversations.show.reply.title') }}

                        </label>


                        <textarea
                            style="color: white"
                            name="message"
                            rows="5"
                            class="form-control rounded-4"
                            placeholder="{{ __('digital_studio_admin.conversations.show.reply.placeholder') }}"
                            required>{{ old('message') }}</textarea>


                        <div
                            class="d-flex justify-content-between align-items-center mt-3 flex-wrap gap-3">


                            <small>

                                <i
                                    class="fa-solid fa-circle-info me-1"
                                    style="color: white"></i>

                                {{ __('digital_studio_admin.conversations.show.reply.info') }}

                            </small>


                            <button
                                type="submit"
                                class="btn btn-primary rounded-pill px-4">

                                <i class="fa-solid fa-paper-plane me-2"></i>

                                {{ __('digital_studio_admin.conversations.show.reply.send') }}

                            </button>


                        </div>

                    </form>

                </div>

            @else

                <div class="border-top pt-4 mt-4">

                    <div class="alert alert-warning rounded-4 mb-0">

                        <i class="fa-solid fa-lock me-2"></i>

                        {{ __('digital_studio_admin.conversations.show.closed_message.before_status') }}

                        <strong>
                            {{ __('digital_studio_admin.conversations.show.statuses.' . $conversation->status) }}
                        </strong>

                        {{ __('digital_studio_admin.conversations.show.closed_message.after_status') }}

                    </div>

                </div>

            @endif


        </div>

    </div>


    <!--==================================
            RIGHT SIDEBAR
    ==================================-->

    <div class="col-lg-4">


        <!--==================================
                USER INFORMATION
        ==================================-->

        <div class="admin-card mb-4">

            <div class="d-flex align-items-center mb-4">

                <div class="dashboard-icon me-3">

                    <i class="fa-solid fa-user"></i>

                </div>

                <div>

                    <h5 class="card-title mb-1">

                        {{ __('digital_studio_admin.conversations.show.user_information.title') }}

                    </h5>

                    <small>

                        {{ __('digital_studio_admin.conversations.show.user_information.description') }}

                    </small>

                </div>

            </div>


            @if($conversation->user)

                <div class="text-center mb-4">

                    <img
                        src="{{ $conversation->user->avatar_url }}"
                        alt="{{ $conversation->user->name }}"
                        class="rounded-circle mb-3"
                        style="
                            width:90px;
                            height:90px;
                            object-fit:cover;
                        ">

                    <h5 class="fw-bold mb-1">

                        {{ $conversation->user->name }}

                    </h5>

                    <p class="mb-0">

                        {{ $conversation->user->email }}

                    </p>

                </div>


                <div class="border-top pt-3">

                    <div class="mb-3">

                        <small class="d-block">

                            {{ __('digital_studio_admin.conversations.show.user_information.username') }}

                        </small>

                        <strong>

                            {{ $conversation->user->username ?? '—' }}

                        </strong>

                    </div>


                    <div class="mb-3">

                        <small class="d-block">

                            {{ __('digital_studio_admin.conversations.show.user_information.phone') }}

                        </small>

                        <strong>

                            {{ $conversation->user->phone ?? '—' }}

                        </strong>

                    </div>


                    <div>

                        <small class="d-block">

                            {{ __('digital_studio_admin.conversations.show.user_information.member_since') }}

                        </small>

                        <strong>

                            {{ optional($conversation->user->created_at)->format('d M Y') }}

                        </strong>

                    </div>

                </div>

            @else

                <div class="text-center py-4">

                    <i
                        class="fa-solid fa-user-slash fa-2x text-muted mb-3"></i>

                    <p class="text-muted mb-0">

                        {{ __('digital_studio_admin.conversations.show.user_information.account_unavailable') }}

                    </p>

                </div>

            @endif

        </div>


        <!--==================================
                CONVERSATION DETAILS
        ==================================-->

        <div class="admin-card mb-4">

            <div class="d-flex align-items-center mb-4">

                <div class="dashboard-icon me-3">

                    <i class="fa-solid fa-circle-info"></i>

                </div>

                <div>

                    <h5 class="card-title mb-1">

                        {{ __('digital_studio_admin.conversations.show.details.title') }}

                    </h5>

                    <small>

                        {{ __('digital_studio_admin.conversations.show.details.description') }}

                    </small>

                </div>

            </div>


            <div class="mb-3">

                <small class="d-block mb-1">

                    {{ __('digital_studio_admin.conversations.show.details.status') }}

                </small>

                <strong>

                    {{ __('digital_studio_admin.conversations.show.statuses.' . $conversation->status) }}

                </strong>

            </div>


            <div class="mb-3">

                <small class="d-block mb-1">

                    {{ __('digital_studio_admin.conversations.show.details.messages') }}

                </small>

                <strong>

                    {{ $conversation->messages->count() }}

                </strong>

            </div>


            <div class="mb-3">

                <small class="d-block mb-1">

                    {{ __('digital_studio_admin.conversations.show.details.created') }}

                </small>

                <strong>

                    {{ $conversation->created_at->format('d M Y - h:i A') }}

                </strong>

            </div>


            <div>

                <small class="d-block mb-1">

                    {{ __('digital_studio_admin.conversations.show.details.last_activity') }}

                </small>

                <strong>

                    @if($conversation->last_message_at)

                        {{ $conversation->last_message_at->diffForHumans() }}

                    @else

                        —

                    @endif

                </strong>

            </div>

        </div>


        <!--==================================
                ACTIONS
        ==================================-->

        <div class="admin-card">

            <h5 class="card-title mb-4">

                {{ __('digital_studio_admin.conversations.show.actions.title') }}

            </h5>


            <div class="d-grid gap-2">


                @if($conversation->status === 'open')

                    <form
                        action="{{ route(
                            'admin.conversations.close',
                            $conversation
                        ) }}"
                        method="POST">

                        @csrf

                        <button
                            type="submit"
                            class="btn btn-light rounded-pill w-100">

                            <i class="fa-solid fa-lock me-2"></i>

                            {{ __('digital_studio_admin.conversations.show.actions.close') }}

                        </button>

                    </form>

                @elseif($conversation->status === 'closed')

                    <form
                        action="{{ route(
                            'admin.conversations.reopen',
                            $conversation
                        ) }}"
                        method="POST">

                        @csrf

                        <button
                            type="submit"
                            class="btn btn-primary rounded-pill w-100">

                            <i class="fa-solid fa-lock-open me-2"></i>

                            {{ __('digital_studio_admin.conversations.show.actions.reopen') }}

                        </button>

                    </form>

                @endif


                @if($conversation->status !== 'archived')

                    <form
                        action="{{ route(
                            'admin.conversations.archive',
                            $conversation
                        ) }}"
                        method="POST">

                        @csrf

                        <button
                            type="submit"
                            class="btn btn-light rounded-pill w-100">

                            <i class="fa-solid fa-box-archive me-2"></i>

                            {{ __('digital_studio_admin.conversations.show.actions.archive') }}

                        </button>

                    </form>

                @endif


                <form
                    action="{{ route(
                        'admin.conversations.read',
                        $conversation
                    ) }}"
                    method="POST">

                    @csrf

                    <button
                        type="submit"
                        class="btn btn-light rounded-pill w-100">

                        <i class="fa-solid fa-envelope-open me-2"></i>

                        {{ __('digital_studio_admin.conversations.show.actions.mark_read') }}

                    </button>

                </form>


                <form
                    action="{{ route(
                        'admin.conversations.destroy',
                        $conversation
                    ) }}"
                    method="POST"
                    onsubmit="return confirm('{{ __('digital_studio_admin.conversations.show.actions.delete_confirm') }}');">

                    @csrf

                    @method('DELETE')

                    <button
                        type="submit"
                        class="btn btn-outline-danger rounded-pill w-100">

                        <i class="fa-solid fa-trash me-2"></i>

                        {{ __('digital_studio_admin.conversations.show.actions.delete') }}

                    </button>

                </form>

            </div>

        </div>


    </div>

</div>


@endif


<!--==================================
        AUTO SCROLL
==================================-->

<script>

document.addEventListener('DOMContentLoaded', function () {

    const messagesBox =
        document.querySelector('.conversation-messages');

    if (messagesBox) {

        messagesBox.scrollTop =
            messagesBox.scrollHeight;

    }

});

</script>

@endsection
