<div class="carnate-notifications-page">

    <style>
        .carnate-notifications-page {
            --carnate-bg: #f7f8fa;
            --carnate-card: #ffffff;
            --carnate-text: #111827;
            --carnate-muted: #64748b;
            --carnate-border: #e2e8f0;
            --carnate-red: #e53935;
            --carnate-red-dark: #c92f2c;
            --carnate-red-soft: #fff5f5;
            --carnate-green: #16a34a;
            --carnate-green-soft: #f0fdf4;
            --carnate-blue-soft: #eff6ff;

            background: var(--carnate-bg);
            min-height: 100%;
            padding: 18px;
            color: var(--carnate-text);
        }

        .carnate-notifications-page .notifications-card {
            background: var(--carnate-card);
            border: 1px solid var(--carnate-border);
            border-radius: 16px;
            box-shadow: 0 4px 18px rgba(15, 23, 42, .04);
            overflow: hidden;
        }

        .carnate-notifications-page .notifications-header {
            padding: 20px 22px;
            border-bottom: 1px solid var(--carnate-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
        }

        .carnate-notifications-page .title-wrap {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .carnate-notifications-page .title-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: var(--carnate-red-soft);
            color: var(--carnate-red);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 21px;
            flex-shrink: 0;
        }

        .carnate-notifications-page .page-title {
            margin: 0;
            color: var(--carnate-text);
            font-size: 20px;
            font-weight: 700;
            line-height: 1.25;
        }

        .carnate-notifications-page .page-subtitle {
            margin: 4px 0 0;
            color: var(--carnate-muted);
            font-size: 13px;
        }

        .carnate-notifications-page .mark-all-btn {
            min-height: 40px;
            padding: 0 15px;
            border: 1px solid rgba(229, 57, 53, .2);
            border-radius: 9px;
            background: var(--carnate-red-soft);
            color: var(--carnate-red);
            font-size: 13px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            transition: .2s ease;
        }

        .carnate-notifications-page .mark-all-btn:hover {
            background: var(--carnate-red);
            border-color: var(--carnate-red);
            color: #fff;
        }

        .carnate-notifications-page .notifications-body {
            padding: 20px 22px 22px;
        }

        .carnate-notifications-page .notification-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .carnate-notifications-page .notification-item {
            position: relative;
            padding: 16px;
            border: 1px solid var(--carnate-border);
            border-radius: 13px;
            background: #fff;
            transition: .2s ease;
        }

        .carnate-notifications-page .notification-item:hover {
            border-color: #d7dee8;
            box-shadow: 0 5px 18px rgba(15, 23, 42, .05);
            transform: translateY(-1px);
        }

        .carnate-notifications-page .notification-item.unread {
            background: #fffafa;
            border-color: rgba(229, 57, 53, .16);
        }

        .carnate-notifications-page .notification-item.unread::before {
            content: "";
            position: absolute;
            left: 0;
            top: 13px;
            bottom: 13px;
            width: 3px;
            border-radius: 0 4px 4px 0;
            background: var(--carnate-red);
        }

        .carnate-notifications-page .notification-content {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 20px;
        }

        .carnate-notifications-page .notification-main {
            display: flex;
            align-items: flex-start;
            gap: 13px;
            min-width: 0;
        }

        .carnate-notifications-page .notification-icon {
            width: 42px;
            height: 42px;
            min-width: 42px;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .carnate-notifications-page .notification-icon.unread {
            background: var(--carnate-red-soft);
            color: var(--carnate-red);
        }

        .carnate-notifications-page .notification-icon.read {
            background: #f1f5f9;
            color: #94a3b8;
        }

        .carnate-notifications-page .notification-info {
            min-width: 0;
        }

        .carnate-notifications-page .notification-title {
            margin: 0 0 5px;
            color: var(--carnate-text);
            font-size: 14px;
            font-weight: 700;
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 7px;
        }

        .carnate-notifications-page .new-badge {
            padding: 3px 7px;
            border-radius: 20px;
            background: var(--carnate-red-soft);
            color: var(--carnate-red);
            font-size: 9px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
        }

        .carnate-notifications-page .notification-message {
            margin: 0 0 9px;
            color: #64748b;
            font-size: 13px;
            line-height: 1.55;
        }

        .carnate-notifications-page .notification-meta {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 14px;
        }

        .carnate-notifications-page .notification-time {
            color: #94a3b8;
            font-size: 11px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .carnate-notifications-page .order-link {
            color: var(--carnate-red);
            font-size: 11px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .carnate-notifications-page .order-link:hover {
            color: var(--carnate-red-dark);
        }

        .carnate-notifications-page .notification-action {
            flex-shrink: 0;
            display: flex;
            align-items: center;
        }

        .carnate-notifications-page .mark-read-btn {
            min-height: 34px;
            padding: 0 12px;
            border: 1px solid rgba(229, 57, 53, .15);
            border-radius: 8px;
            background: var(--carnate-red);
            color: #fff;
            font-size: 11px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            transition: .2s ease;
        }

        .carnate-notifications-page .mark-read-btn:hover {
            background: var(--carnate-red-dark);
            color: #fff;
        }

        .carnate-notifications-page .read-badge {
            min-height: 34px;
            padding: 0 12px;
            border: 1px solid var(--carnate-border);
            border-radius: 8px;
            background: #f8fafc;
            color: #64748b;
            font-size: 11px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        .carnate-notifications-page .read-badge i {
            color: var(--carnate-green);
            font-size: 15px;
        }

        .carnate-notifications-page .pagination-wrapper {
            margin-top: 18px;
            padding-top: 16px;
            border-top: 1px solid var(--carnate-border);
        }

        .carnate-notifications-page .pagination-wrapper nav {
            margin: 0;
        }

        .carnate-notifications-page .empty-state {
            padding: 65px 20px;
            text-align: center;
        }

        .carnate-notifications-page .empty-icon {
            width: 64px;
            height: 64px;
            margin: 0 auto 15px;
            border-radius: 16px;
            background: #f1f5f9;
            color: #94a3b8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 29px;
        }

        .carnate-notifications-page .empty-title {
            margin: 0 0 5px;
            color: #475569;
            font-size: 15px;
            font-weight: 700;
        }

        .carnate-notifications-page .empty-text {
            margin: 0;
            color: #94a3b8;
            font-size: 12px;
        }

        @media (max-width: 767px) {
            .carnate-notifications-page {
                padding: 12px;
            }

            .carnate-notifications-page .notifications-header,
            .carnate-notifications-page .notifications-body {
                padding: 16px;
            }

            .carnate-notifications-page .notification-content {
                flex-direction: column;
                gap: 13px;
            }

            .carnate-notifications-page .notification-action {
                padding-left: 55px;
            }

            .carnate-notifications-page .mark-all-btn {
                width: 100%;
            }
        }
    </style>

    <div class="notifications-card">

        {{-- Header --}}
        <div class="notifications-header">

            <div class="title-wrap">
                <div class="title-icon">
                    <i class="fa-solid fa-bell"></i>
                </div>

                <div>
                    <h4 class="page-title">Workshop Notifications</h4>
                    <p class="page-subtitle">
                        Keep track of your order updates, handovers, and payments.
                    </p>
                </div>
            </div>

            @if($notifications->where('is_read', false)->count() > 0)
                <button
                    type="button"
                    wire:click="markAllAsRead"
                    class="mark-all-btn"
                >
                    <i class="bx bx-check-double"></i>
                    Mark All as Read
                </button>
            @endif

        </div>

        {{-- Notifications --}}
        <div class="notifications-body">

            @if($notifications->count() > 0)

                <div class="notification-list">

                    @foreach($notifications as $notification)

                        <div class="notification-item {{ !$notification->is_read ? 'unread' : '' }}">

                            <div class="notification-content">

                                <div class="notification-main">

                                    <div class="notification-icon {{ !$notification->is_read ? 'unread' : 'read' }}">
                                        <i class="fa-solid fa-bell"></i>
                                    </div>

                                    <div class="notification-info">

                                        <h6 class="notification-title">
                                            {{ $notification->title }}

                                            @if(!$notification->is_read)
                                                <span class="new-badge">
                                                    New
                                                </span>
                                            @endif
                                        </h6>

                                        <p class="notification-message">
                                            {{ $notification->message }}
                                        </p>

                                        <div class="notification-meta">

                                            <span class="notification-time">
                                                <i class="bx bx-time-five"></i>
                                                {{ $notification->created_at->diffForHumans() }}
                                            </span>

                                            @if($notification->order_id)
                                                <a
                                                    href="{{ route('admin.order-list') }}"
                                                    class="order-link"
                                                >
                                                    <i class="bx bx-show"></i>
                                                    View Order
                                                </a>
                                            @endif

                                        </div>

                                    </div>

                                </div>

                                <div class="notification-action">

                                    @if(!$notification->is_read)

                                        <button
                                            type="button"
                                            wire:click="markAsRead({{ $notification->id }})"
                                            class="mark-read-btn"
                                            title="Mark as read"
                                        >
                                            <i class="bx bx-check"></i>
                                            Mark as Read
                                        </button>

                                    @else

                                        <span class="read-badge">
                                            <i class="bx bx-check-double"></i>
                                            Read
                                        </span>

                                    @endif

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

                <div class="pagination-wrapper">
                    {{ $notifications->links() }}
                </div>

            @else

                <div class="empty-state">

                    <div class="empty-icon">
                        <i class="fa-solid fa-bell-slash"></i>
                    </div>

                    <h5 class="empty-title">
                        No Notifications Found
                    </h5>

                    <p class="empty-text">
                        We'll alert you when something active happens.
                    </p>

                </div>

            @endif

        </div>

    </div>

</div>