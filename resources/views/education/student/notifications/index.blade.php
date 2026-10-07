@extends('education.layouts.app')

@section('title', 'الإشعارات')

@section('content')

<div class="education-student-notifications-page">

    <div class="education-student-notifications-container">

        {{-- =========================================================
            PAGE HEADER
        ========================================================== --}}

        <div class="education-student-notifications-page-header">

            <div class="education-student-notifications-heading">

                <div class="education-student-notifications-heading-icon">

                    <i class="fa-regular fa-bell"></i>

                </div>

                <div>

                    <span>
                        مساحتي التعليمية
                    </span>

                    <h1>
                        الإشعارات
                    </h1>

                    <p>
                        جميع التنبيهات المتعلقة بدروسك واختباراتك وحجوزاتك.
                    </p>

                </div>

            </div>


            {{-- MARK ALL --}}

            @if ($notifications->total() > 0)

                <button
                    type="button"
                    class="education-student-notifications-read-all"
                    id="educationStudentNotificationsReadAll"
                >

                    <i class="fa-solid fa-check-double"></i>

                    <span>
                        تحديد الكل كمقروء
                    </span>

                </button>

            @endif

        </div>


        {{-- =========================================================
            NOTIFICATIONS LIST
        ========================================================== --}}

        <div
            class="education-student-notifications-list"
            id="educationStudentNotificationsList"
        >

            @forelse ($notifications as $notification)

                @php

                    $isRead = $notification->read_at !== null;

                    $notificationUrl = $notification->url;

                    $notificationIcon =
                        $notification->icon
                        ?: 'fa-regular fa-bell';

                    $notificationColor =
                        $notification->color
                        ?: '#235d70';

                @endphp


                <div
                    class="education-student-notification-card
                        {{ $isRead ? 'is-read' : 'is-unread' }}"
                    data-notification-id="{{ $notification->id }}"
                >

                    {{-- =================================================
                        ICON
                    ================================================== --}}

                    <div
                        class="education-student-notification-card-icon"
                        style="--notification-color: {{ $notificationColor }};"
                    >

                        @if (
                            str_contains(
                                (string) $notificationIcon,
                                'fa-'
                            )
                        )

                            <i class="{{ $notificationIcon }}"></i>

                        @else

                            <span>
                                {{ $notificationIcon }}
                            </span>

                        @endif

                    </div>


                    {{-- =================================================
                        CONTENT
                    ================================================== --}}

                    <div class="education-student-notification-card-content">

                        <div class="education-student-notification-card-top">

                            <h2>
                                {{ $notification->title }}
                            </h2>

                            @if (!$isRead)

                                <span class="education-student-notification-unread-dot">
                                </span>

                            @endif

                        </div>


                        @if ($notification->message)

                            <p>
                                {{ $notification->message }}
                            </p>

                        @endif


                        <div class="education-student-notification-card-meta">

                            <span>

                                <i class="fa-regular fa-clock"></i>

                                {{ $notification->created_at?->diffForHumans() }}

                            </span>


                            @if (!$isRead)

                                <span class="education-student-notification-status">

                                    <i class="fa-solid fa-circle"></i>

                                    غير مقروء

                                </span>

                            @else

                                <span class="education-student-notification-status read">

                                    <i class="fa-solid fa-check"></i>

                                    مقروء

                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- =================================================
                        ACTIONS
                    ================================================== --}}

                    <div class="education-student-notification-card-action">

                        <div class="education-student-notification-actions">

                            {{-- OPEN --}}

                            @if ($notificationUrl)

                                <a
                                    href="{{ $notificationUrl }}"
                                    class="education-student-notification-open"
                                    data-notification-id="{{ $notification->id }}"
                                    data-notification-url="{{ $notificationUrl }}"
                                    title="فتح الإشعار"
                                >

                                    <span>
                                        فتح
                                    </span>

                                    <i class="fa-solid fa-arrow-left"></i>

                                </a>

                            {{-- MARK AS READ --}}

                            @elseif (!$isRead)

                                <button
                                    type="button"
                                    class="education-student-notification-mark-read"
                                    data-notification-id="{{ $notification->id }}"
                                    title="تحديد كمقروء"
                                >

                                    <i class="fa-solid fa-check"></i>

                                </button>

                            @endif


                            {{-- DELETE --}}

                            <button
                                type="button"
                                class="education-student-notification-delete"
                                data-notification-id="{{ $notification->id }}"
                                title="حذف الإشعار"
                                aria-label="حذف الإشعار"
                            >

                                <i class="fa-regular fa-trash-can"></i>

                            </button>

                        </div>

                    </div>

                </div>

            @empty

                <div class="education-student-notifications-empty-page">

                    <div class="education-student-notifications-empty-page-icon">

                        <i class="fa-regular fa-bell"></i>

                    </div>

                    <h2>
                        لا توجد إشعارات
                    </h2>

                    <p>
                        ستظهر هنا التنبيهات المتعلقة بدروسك
                        واختباراتك ومواعيدك وحجوزاتك.
                    </p>

                    <a
                        href="{{ route('education.dashboard') }}"
                        class="education-student-notifications-back"
                    >

                        <i class="fa-solid fa-house"></i>

                        العودة إلى لوحة التحكم

                    </a>

                </div>

            @endforelse

        </div>


        {{-- =========================================================
            PAGINATION
        ========================================================== --}}

        @if ($notifications->hasPages())

            <div class="education-student-notifications-pagination">

                {{ $notifications->links() }}

            </div>

        @endif

    </div>

</div>


<style>

/* =========================================================
   PAGE
========================================================= */

.education-student-notifications-page {

    width: 100%;

    min-height: calc(100vh - 100px);

    padding:
        35px 20px 70px;

    box-sizing: border-box;

    direction: rtl;

    color: #30372a;

}


.education-student-notifications-container {

    width: min(1000px, 100%);

    margin: 0 auto;

}


/* =========================================================
   HEADER
========================================================= */

.education-student-notifications-page-header {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 20px;

    margin-bottom: 25px;

    padding: 22px;

    background: #fffdf8;

    border:
        1px solid #e6ddc8;

    border-radius: 20px;

    box-shadow:
        0 10px 30px rgba(48, 55, 42, .07);

}


.education-student-notifications-heading {

    display: flex;

    align-items: center;

    gap: 15px;

}


.education-student-notifications-heading-icon {

    width: 54px;

    height: 54px;

    flex-shrink: 0;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 15px;

    background: #eef3f4;

    color: #235d70;

}


.education-student-notifications-heading-icon i {

    font-size: 20px;

}


.education-student-notifications-heading span {

    display: block;

    margin-bottom: 3px;

    color: #9a7b2f;

    font-size: 10px;

    font-weight: 800;

}


.education-student-notifications-heading h1 {

    margin: 0;

    color: #30372a;

    font-size: 24px;

    font-weight: 900;

}


.education-student-notifications-heading p {

    margin: 4px 0 0;

    color: #999488;

    font-size: 11px;

    line-height: 1.7;

}


/* =========================================================
   READ ALL
========================================================= */

.education-student-notifications-read-all {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 8px;

    min-height: 42px;

    padding:
        0 15px;

    border:
        1px solid #ddd3bc;

    border-radius: 11px;

    background: #faf7ee;

    color: #235d70;

    font-family: inherit;

    font-size: 11px;

    font-weight: 800;

    cursor: pointer;

    transition:
        background .2s ease,
        color .2s ease,
        border-color .2s ease,
        transform .2s ease;

}


.education-student-notifications-read-all:hover {

    background: #235d70;

    border-color: #235d70;

    color: #fff;

    transform:
        translateY(-1px);

}


/* =========================================================
   LIST
========================================================= */

.education-student-notifications-list {

    display: flex;

    flex-direction: column;

    gap: 12px;

}


/* =========================================================
   CARD
========================================================= */

.education-student-notification-card {

    position: relative;

    display: flex;

    align-items: center;

    gap: 16px;

    padding: 17px;

    background: #fffdf8;

    border:
        1px solid #e6ddc8;

    border-radius: 17px;

    box-shadow:
        0 7px 22px rgba(48, 55, 42, .05);

    transition:
        transform .2s ease,
        box-shadow .2s ease,
        border-color .2s ease,
        background .2s ease,
        opacity .2s ease;

}


.education-student-notification-card:hover {

    transform:
        translateY(-2px);

    box-shadow:
        0 12px 30px rgba(48, 55, 42, .09);

}


/* =========================================================
   UNREAD
========================================================= */

.education-student-notification-card.is-unread {

    background: #fffdf8;

    border-color: #d9ceb0;

}


.education-student-notification-card.is-unread::before {

    content: "";

    position: absolute;

    top: 14px;

    right: 0;

    width: 3px;

    height: 42px;

    border-radius:
        3px 0 0 3px;

    background: #9a7b2f;

}


/* =========================================================
   READ
========================================================= */

.education-student-notification-card.is-read {

    opacity: .82;

}


/* =========================================================
   DELETING
========================================================= */

.education-student-notification-card.is-deleting {

    opacity: .35;

    transform:
        scale(.98);

    pointer-events: none;

}


/* =========================================================
   ICON
========================================================= */

.education-student-notification-card-icon {

    width: 50px;

    height: 50px;

    flex-shrink: 0;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 14px;

    background:
        color-mix(
            in srgb,
            var(--notification-color) 10%,
            #fffdf8
        );

    color:
        var(--notification-color);

}


.education-student-notification-card-icon i {

    font-size: 18px;

}


.education-student-notification-card-icon span {

    font-size: 20px;

    line-height: 1;

}


/* =========================================================
   CONTENT
========================================================= */

.education-student-notification-card-content {

    flex: 1;

    min-width: 0;

}


.education-student-notification-card-top {

    display: flex;

    align-items: center;

    gap: 8px;

}


.education-student-notification-card-top h2 {

    margin: 0;

    color: #30372a;

    font-size: 14px;

    font-weight: 900;

}


.education-student-notification-card-content p {

    margin: 5px 0 8px;

    color: #77786e;

    font-size: 12px;

    line-height: 1.8;

}


.education-student-notification-unread-dot {

    width: 7px;

    height: 7px;

    flex-shrink: 0;

    border-radius: 50%;

    background: #9a7b2f;

}


/* =========================================================
   META
========================================================= */

.education-student-notification-card-meta {

    display: flex;

    align-items: center;

    flex-wrap: wrap;

    gap: 12px;

    color: #aaa59a;

    font-size: 10px;

}


.education-student-notification-card-meta span {

    display: inline-flex;

    align-items: center;

    gap: 5px;

}


.education-student-notification-status {

    color: #9a7b2f;

    font-weight: 800;

}


.education-student-notification-status.read {

    color: #7c8277;

}


.education-student-notification-status i {

    font-size: 6px;

}


/* =========================================================
   ACTION
========================================================= */

.education-student-notification-card-action {

    flex-shrink: 0;

}


.education-student-notification-actions {

    display: flex;

    align-items: center;

    gap: 7px;

}


/* =========================================================
   OPEN
========================================================= */

.education-student-notification-open {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 7px;

    min-width: 65px;

    height: 36px;

    padding:
        0 10px;

    box-sizing: border-box;

    border:
        1px solid #e0d7c2;

    border-radius: 10px;

    background: #faf7ee;

    color: #235d70;

    text-decoration: none;

    font-size: 10px;

    font-weight: 800;

    transition:
        background .2s ease,
        color .2s ease,
        border-color .2s ease;

}


.education-student-notification-open:hover {

    background: #235d70;

    border-color: #235d70;

    color: #fff;

}


/* =========================================================
   MARK AS READ
========================================================= */

.education-student-notification-mark-read {

    width: 36px;

    height: 36px;

    padding: 0;

    border:
        1px solid #e0d7c2;

    border-radius: 10px;

    background: #faf7ee;

    color: #235d70;

    cursor: pointer;

    transition:
        background .2s ease,
        color .2s ease,
        border-color .2s ease,
        transform .2s ease;

}


.education-student-notification-mark-read:hover {

    background: #235d70;

    border-color: #235d70;

    color: #fff;

    transform:
        translateY(-1px);

}


/* =========================================================
   DELETE
========================================================= */

.education-student-notification-delete {

    width: 36px;

    height: 36px;

    padding: 0;

    display: inline-flex;

    align-items: center;

    justify-content: center;

    border:
        1px solid #e6d9d2;

    border-radius: 10px;

    background: #fff8f5;

    color: #a65b4b;

    cursor: pointer;

    transition:
        background .2s ease,
        color .2s ease,
        border-color .2s ease,
        transform .2s ease;

}


.education-student-notification-delete:hover {

    background: #a65b4b;

    border-color: #a65b4b;

    color: #fff;

    transform:
        translateY(-1px);

}


.education-student-notification-delete:disabled {

    cursor: wait;

    opacity: .55;

}


/* =========================================================
   EMPTY
========================================================= */

.education-student-notifications-empty-page {

    padding:
        65px 25px;

    text-align: center;

    background: #fffdf8;

    border:
        1px solid #e6ddc8;

    border-radius: 20px;

    box-shadow:
        0 10px 30px rgba(48, 55, 42, .06);

}


.education-student-notifications-empty-page-icon {

    width: 65px;

    height: 65px;

    margin:
        0 auto 15px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 50%;

    background: #eef3f4;

    color: #235d70;

}


.education-student-notifications-empty-page-icon i {

    font-size: 23px;

}


.education-student-notifications-empty-page h2 {

    margin: 0;

    color: #30372a;

    font-size: 18px;

    font-weight: 900;

}


.education-student-notifications-empty-page p {

    max-width: 430px;

    margin:
        7px auto 20px;

    color: #999488;

    font-size: 11px;

    line-height: 1.8;

}


.education-student-notifications-back {

    display: inline-flex;

    align-items: center;

    gap: 8px;

    min-height: 40px;

    padding:
        0 15px;

    border-radius: 10px;

    background: #235d70;

    color: #fff;

    text-decoration: none;

    font-size: 11px;

    font-weight: 800;

}


/* =========================================================
   PAGINATION
========================================================= */

.education-student-notifications-pagination {

    margin-top: 25px;

    display: flex;

    justify-content: center;

}


.education-student-notifications-pagination nav {

    direction: ltr;

}


/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 700px) {

    .education-student-notifications-page {

        padding:
            25px 12px 50px;

    }


    .education-student-notifications-page-header {

        flex-direction: column;

        align-items: stretch;

        padding: 17px;

    }


    .education-student-notifications-heading {

        gap: 11px;

    }


    .education-student-notifications-heading-icon {

        width: 46px;

        height: 46px;

        border-radius: 12px;

    }


    .education-student-notifications-heading h1 {

        font-size: 20px;

    }


    .education-student-notifications-heading p {

        font-size: 10px;

    }


    .education-student-notifications-read-all {

        width: 100%;

    }


    .education-student-notification-card {

        align-items: flex-start;

        gap: 11px;

        padding: 14px;

    }


    .education-student-notification-card-icon {

        width: 42px;

        height: 42px;

        border-radius: 11px;

    }


    .education-student-notification-card-icon i {

        font-size: 15px;

    }


    .education-student-notification-card-top h2 {

        font-size: 12px;

    }


    .education-student-notification-card-content p {

        font-size: 11px;

    }


    .education-student-notification-card-action {

        align-self: center;

    }


    .education-student-notification-actions {

        flex-direction: column;

        gap: 6px;

    }


    .education-student-notification-open span {

        display: none;

    }


    .education-student-notification-open {

        min-width: 36px;

        width: 36px;

        padding: 0;

    }

}


@media (prefers-reduced-motion: reduce) {

    .education-student-notification-card,
    .education-student-notifications-read-all,
    .education-student-notification-open,
    .education-student-notification-delete {

        transition: none !important;

    }

}

</style>


<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {

        /*
        |--------------------------------------------------------------------------
        | ELEMENTS
        |--------------------------------------------------------------------------
        */

        const readAllButton =
            document.getElementById(
                'educationStudentNotificationsReadAll'
            );


        const notificationsList =
            document.getElementById(
                'educationStudentNotificationsList'
            );


        /*
        |--------------------------------------------------------------------------
        | CSRF
        |--------------------------------------------------------------------------
        */

        const csrfToken =
            document.querySelector(
                'meta[name="csrf-token"]'
            )?.getAttribute('content');


        /*
        |--------------------------------------------------------------------------
        | UPDATE STUDENT NOTIFICATION BADGE
        |--------------------------------------------------------------------------
        */

        function updateStudentNotificationBadge(
            unreadCount
        ) {

            /*
            |--------------------------------------------------------------------------
            | Try the existing badge used by the student navbar.
            |--------------------------------------------------------------------------
            */

            const possibleBadges = [
                document.getElementById(
                    'educationStudentNotificationCount'
                ),

                document.querySelector(
                    '.education-student-notification-count'
                ),

                document.querySelector(
                    '.education-notification-count'
                ),

                document.querySelector(
                    '[data-education-notification-count]'
                )
            ];


            const badge =
                possibleBadges.find(
                    function (element) {
                        return element !== null;
                    }
                );


            if (!badge) {
                return;
            }


            const count =
                Number(unreadCount) || 0;


            if (count > 0) {

                badge.textContent =
                    count > 99
                        ? '99+'
                        : count;

                badge.style.display =
                    'flex';

            } else {

                badge.textContent =
                    '';

                badge.style.display =
                    'none';

            }

        }


        /*
        |--------------------------------------------------------------------------
        | MARK ONE AS READ
        |--------------------------------------------------------------------------
        */

        async function markNotificationAsRead(
            notificationId
        ) {

            try {

                const response =
                    await fetch(
                        `{{ url('/education/notifications') }}/${notificationId}/read`,
                        {
                            method: 'PATCH',

                            headers: {

                                'X-CSRF-TOKEN':
                                    csrfToken,

                                'Accept':
                                    'application/json',

                                'Content-Type':
                                    'application/json',

                            },

                        }
                    );


                const data =
                    await response.json();


                if (data.success === true) {

                    updateStudentNotificationBadge(
                        data.unread_count
                    );

                }


                return data.success === true;

            } catch (error) {

                console.error(
                    'Notification read error:',
                    error
                );

                return false;

            }

        }


        /*
        |--------------------------------------------------------------------------
        | OPEN NOTIFICATION
        |--------------------------------------------------------------------------
        */

        document
            .querySelectorAll(
                '.education-student-notification-open'
            )
            .forEach(
                function (link) {

                    link.addEventListener(
                        'click',
                        async function () {

                            const notificationId =
                                this.dataset.notificationId;


                            const card =
                                document.querySelector(
                                    `[data-notification-id="${notificationId}"]`
                                );


                            if (
                                card &&
                                card.classList.contains(
                                    'is-unread'
                                )
                            ) {

                                await markNotificationAsRead(
                                    notificationId
                                );

                            }

                        }
                    );

                }
            );


        /*
        |--------------------------------------------------------------------------
        | MARK ALL AS READ
        |--------------------------------------------------------------------------
        */

        if (readAllButton) {

            readAllButton.addEventListener(
                'click',
                async function () {

                    const originalHtml =
                        this.innerHTML;


                    this.disabled =
                        true;


                    this.innerHTML =
                        '<i class="fa-solid fa-spinner fa-spin"></i><span>جارٍ التحديث...</span>';


                    try {

                        const response =
                            await fetch(
                                '{{ route('education.notifications.read_all') }}',
                                {
                                    method: 'PATCH',

                                    headers: {

                                        'X-CSRF-TOKEN':
                                            csrfToken,

                                        'Accept':
                                            'application/json',

                                        'Content-Type':
                                            'application/json',

                                    },

                                }
                            );


                        const data =
                            await response.json();


                        if (data.success) {

                            document
                                .querySelectorAll(
                                    '.education-student-notification-card.is-unread'
                                )
                                .forEach(
                                    function (card) {

                                        card.classList.remove(
                                            'is-unread'
                                        );

                                        card.classList.add(
                                            'is-read'
                                        );


                                        const dot =
                                            card.querySelector(
                                                '.education-student-notification-unread-dot'
                                            );


                                        if (dot) {

                                            dot.remove();

                                        }


                                        const status =
                                            card.querySelector(
                                                '.education-student-notification-status'
                                            );


                                        if (status) {

                                            status.classList.add(
                                                'read'
                                            );

                                            status.innerHTML =
                                                '<i class="fa-solid fa-check"></i> مقروء';

                                        }

                                    }
                                );


                            updateStudentNotificationBadge(
                                data.unread_count ?? 0
                            );

                        }

                    } catch (error) {

                        console.error(
                            'Mark all notifications error:',
                            error
                        );

                    } finally {

                        this.disabled =
                            false;

                        this.innerHTML =
                            originalHtml;

                    }

                }
            );

        }


        /*
        |--------------------------------------------------------------------------
        | DELETE ONE NOTIFICATION
        |--------------------------------------------------------------------------
        */

        async function deleteNotification(
            notificationId,
            button
        ) {

            const card =
                document.querySelector(
                    `.education-student-notification-card[data-notification-id="${notificationId}"]`
                );


            if (!card) {
                return;
            }


            const originalHtml =
                button.innerHTML;


            button.disabled =
                true;


            button.innerHTML =
                '<i class="fa-solid fa-spinner fa-spin"></i>';


            try {

                const response =
                    await fetch(
                        `{{ url('/education/notifications') }}/${notificationId}`,
                        {
                            method: 'DELETE',

                            headers: {

                                'X-CSRF-TOKEN':
                                    csrfToken,

                                'Accept':
                                    'application/json',

                                'Content-Type':
                                    'application/json',

                            },

                        }
                    );


                const data =
                    await response.json();


                if (
                    !response.ok ||
                    !data.success
                ) {

                    throw new Error(
                        data.message ||
                        'تعذر حذف الإشعار.'
                    );

                }


                /*
                |--------------------------------------------------------------------------
                | Remove card visually
                |--------------------------------------------------------------------------
                */

                card.classList.add(
                    'is-deleting'
                );


                setTimeout(
                    function () {

                        card.remove();


                        /*
                        |--------------------------------------------------------------------------
                        | If no cards remain, show empty state.
                        |--------------------------------------------------------------------------
                        */

                        if (
                            notificationsList &&
                            !notificationsList.querySelector(
                                '.education-student-notification-card'
                            )
                        ) {

                            notificationsList.innerHTML = `

                                <div class="education-student-notifications-empty-page">

                                    <div class="education-student-notifications-empty-page-icon">

                                        <i class="fa-regular fa-bell"></i>

                                    </div>

                                    <h2>
                                        لا توجد إشعارات
                                    </h2>

                                    <p>
                                        ستظهر هنا التنبيهات المتعلقة بدروسك
                                        واختباراتك ومواعيدك وحجوزاتك.
                                    </p>

                                    <a
                                        href="{{ route('education.dashboard') }}"
                                        class="education-student-notifications-back"
                                    >

                                        <i class="fa-solid fa-house"></i>

                                        العودة إلى لوحة التحكم

                                    </a>

                                </div>

                            `;

                        }

                    },
                    220
                );


                /*
                |--------------------------------------------------------------------------
                | Update bell badge
                |--------------------------------------------------------------------------
                */

                updateStudentNotificationBadge(
                    data.unread_count ?? 0
                );


            } catch (error) {

                console.error(
                    'Delete notification error:',
                    error
                );


                button.disabled =
                    false;


                button.innerHTML =
                    originalHtml;


                alert(
                    error.message ||
                    'حدث خطأ أثناء حذف الإشعار.'
                );

            }

        }


        /*
        |--------------------------------------------------------------------------
        | DELETE BUTTONS
        |--------------------------------------------------------------------------
        */

        document
            .querySelectorAll(
                '.education-student-notification-delete'
            )
            .forEach(
                function (button) {

                    button.addEventListener(
                        'click',
                        async function () {

                            const notificationId =
                                this.dataset.notificationId;


                            if (!notificationId) {
                                return;
                            }


                            const confirmed =
                                confirm(
                                    'هل تريد حذف هذا الإشعار؟'
                                );


                            if (!confirmed) {
                                return;
                            }


                            await deleteNotification(
                                notificationId,
                                this
                            );

                        }
                    );

                }
            );

    }
);

</script>

@endsection
