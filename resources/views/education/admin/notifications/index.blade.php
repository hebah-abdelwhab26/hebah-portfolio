@extends('education.admin.layouts.app')

@section('page_title', __('education_admin.notifications.page_title'))

@section('content')

<style>

.education-admin-notifications-page {
    direction: {{ session('education_locale', 'ar') === 'en' ? 'ltr' : 'rtl' }};
    max-width: 1100px;
    margin: 0 auto;
    padding: 10px 0 50px;
}

.education-admin-notifications-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 25px;
}

.education-admin-notifications-title {
    display: flex;
    align-items: center;
    gap: 15px;
}

.education-admin-notifications-title-icon {
    width: 52px;
    height: 52px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(184, 148, 70, 0.14);
    color: #b89446;
    font-size: 21px;
}

.education-admin-notifications-title h2 {
    margin: 0 0 5px;
    font-size: 24px;
    color: #303127;
}

.education-admin-notifications-title p {
    margin: 0;
    color: #777866;
    font-size: 14px;
}

.education-admin-notifications-read-all {
    border: 1px solid rgba(184, 148, 70, 0.35);
    background: rgba(184, 148, 70, 0.08);
    color: #76602d;
    border-radius: 12px;
    padding: 10px 15px;
    cursor: pointer;
    font-family: inherit;
}

.education-admin-notifications-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.education-admin-notification-card {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 18px;
    background: #fffdf8;
    border: 1px solid rgba(48, 49, 39, 0.08);
    border-radius: 18px;
    box-shadow: 0 8px 25px rgba(48, 49, 39, 0.05);
    transition: .2s ease;
}

.education-admin-notification-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 30px rgba(48, 49, 39, 0.08);
}

.education-admin-notification-card.unread {
    border-right: 4px solid #b89446;
    background: #fffaf0;
}

.education-admin-notification-icon {
    width: 48px;
    height: 48px;
    flex: 0 0 48px;
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(48, 49, 39, 0.07);
    color: #596044;
    font-size: 19px;
}

.education-admin-notification-content {
    flex: 1;
    min-width: 0;
}

.education-admin-notification-content h3 {
    margin: 0 0 6px;
    color: #303127;
    font-size: 16px;
}

.education-admin-notification-content p {
    margin: 0 0 8px;
    color: #707160;
    line-height: 1.7;
    font-size: 14px;
}

.education-admin-notification-date {
    color: #999a8d;
    font-size: 12px;
}

.education-admin-notification-actions {
    display: flex;
    align-items: center;
    gap: 7px;
}

.education-admin-notification-action {
    width: 38px;
    height: 38px;
    border: 0;
    border-radius: 11px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    background: rgba(48, 49, 39, 0.06);
    color: #55584a;
}

.education-admin-notification-action:hover {
    background: rgba(184, 148, 70, 0.15);
    color: #8a6b27;
}

.education-admin-notification-delete:hover {
    background: rgba(180, 60, 60, 0.10);
    color: #a33d3d;
}

.education-admin-notifications-empty {
    padding: 70px 20px;
    text-align: center;
    background: #fffdf8;
    border-radius: 20px;
    border: 1px solid rgba(48, 49, 39, 0.08);
}

.education-admin-notifications-empty i {
    font-size: 45px;
    color: #b89446;
    margin-bottom: 15px;
}

.education-admin-notifications-empty h3 {
    margin: 0 0 8px;
    color: #303127;
}

.education-admin-notifications-empty p {
    margin: 0;
    color: #777866;
}

.education-admin-notifications-pagination {
    margin-top: 25px;
}

@media (max-width: 700px) {

    .education-admin-notifications-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .education-admin-notification-card {
        align-items: flex-start;
    }

    .education-admin-notification-actions {
        flex-direction: column;
    }

    .education-admin-notification-content {
        width: 100%;
    }

}

</style>


<div class="education-admin-notifications-page">

    {{-- =========================================================
        HEADER
    ========================================================= --}}

    <div class="education-admin-notifications-header">

        <div class="education-admin-notifications-title">

            <div class="education-admin-notifications-title-icon">
                <i class="fa-regular fa-bell"></i>
            </div>

            <div>
                <h2>
                    {{ __('education_admin.notifications.title') }}
                </h2>

                <p>
                    {{ __('education_admin.notifications.unread_prefix') }}
                    <strong>{{ $unreadCount }}</strong>
                    {{ __('education_admin.notifications.unread_suffix') }}
                </p>
            </div>

        </div>


        @if($unreadCount > 0)

            <form
                action="{{ route('education.admin.notifications.read-all') }}"
                method="POST"
            >

                @csrf
                @method('PATCH')

                <button
                    type="submit"
                    class="education-admin-notifications-read-all"
                >

                    <i class="fa-solid fa-check-double"></i>

                    {{ __('education_admin.notifications.read_all') }}

                </button>

            </form>

        @endif

    </div>


    {{-- =========================================================
        NOTIFICATIONS
    ========================================================= --}}

    @if($notifications->count())

        <div class="education-admin-notifications-list">

            @foreach($notifications as $notification)

                <div
                    class="education-admin-notification-card
                    {{ $notification->read_at ? '' : 'unread' }}"
                >

                    {{-- ICON --}}

                    <div
                        class="education-admin-notification-icon"
                        @if($notification->color)
                            style="color: {{ $notification->color }};"
                        @endif
                    >

                        <i class="{{ $notification->icon ?: 'fa-regular fa-bell' }}"></i>

                    </div>


                    {{-- CONTENT --}}

                    <div class="education-admin-notification-content">

                        <h3>
                            {{ $notification->title }}
                        </h3>

                        @if($notification->message)

                            <p>
                                {{ $notification->message }}
                            </p>

                        @endif

                        <span class="education-admin-notification-date">

                            {{ $notification->created_at?->diffForHumans() }}

                        </span>

                    </div>


                    {{-- ACTIONS --}}

                    <div class="education-admin-notification-actions">

                        @if(!$notification->read_at)

                            <form
                                action="{{ route(
                                    'education.admin.notifications.read',
                                    $notification
                                ) }}"
                                method="POST"
                            >

                                @csrf
                                @method('PATCH')

                                <button
                                    type="submit"
                                    class="education-admin-notification-action"
                                    title="{{ __('education_admin.notifications.actions.mark_read') }}"
                                >

                                    <i class="fa-solid fa-check"></i>

                                </button>

                            </form>

                        @endif


                        @if($notification->url)

                            <a
                                href="{{ $notification->url }}"
                                class="education-admin-notification-action"
                                title="{{ __('education_admin.notifications.actions.open') }}"
                            >

                                <i class="fa-solid fa-arrow-up-right-from-square"></i>

                            </a>

                        @endif


                        <form
                            action="{{ route(
                                'education.admin.notifications.destroy',
                                $notification
                            ) }}"
                            method="POST"
                        >

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="education-admin-notification-action education-admin-notification-delete"
                                title="{{ __('education_admin.notifications.actions.delete') }}"
                            >

                                <i class="fa-regular fa-trash-can"></i>

                            </button>

                        </form>

                    </div>

                </div>

            @endforeach

        </div>


        <div class="education-admin-notifications-pagination">

            {{ $notifications->links() }}

        </div>

    @else

        <div class="education-admin-notifications-empty">

            <i class="fa-regular fa-bell-slash"></i>

            <h3>
                {{ __('education_admin.notifications.empty.title') }}
            </h3>

            <p>
                {{ __('education_admin.notifications.empty.description') }}
            </p>

        </div>

    @endif

</div>

@endsection
