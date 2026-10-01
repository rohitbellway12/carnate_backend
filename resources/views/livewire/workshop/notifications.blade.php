<div class="carnate-notification-page">

    <style>
        .carnate-notification-page {
            --notify-bg: #f7f8fa;
            --notify-card: #ffffff;
            --notify-text: #111827;
            --notify-muted: #64748b;
            --notify-border: #e2e8f0;
            --notify-red: #e53935;
            --notify-red-dark: #c92f2c;
            --notify-red-soft: #fff5f5;
            --notify-green: #16a34a;
            --notify-green-soft: #f0fdf4;
            --notify-icon: #f1f5f9;
            --notify-shadow: 0 8px 28px rgba(15, 23, 42, .06);
        }

        .carnate-notification-page .notification-card {
            background: var(--notify-card);
            border: 1px solid var(--notify-border);
            border-radius: 16px;
            box-shadow: var(--notify-shadow);
            overflow: hidden;
        }

        .carnate-notification-page .notification-body {
            padding: 22px;
        }

        /* Header */
        .carnate-notification-page .notification-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            padding-bottom: 18px;
            border-bottom: 1px solid #eef2f7;
        }

        .carnate-notification-page .notification-title-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .carnate-notification-page .notification-title-icon {
            width: 44px;
            height: 44px;
            border-radius: 11px;
            background: var(--notify-red-soft);
            color: var(--notify-red);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }

        .carnate-notification-page .notification-title {
            margin: 0;
            color: var(--notify-text);
            font-size: 19px;
            font-weight: 700;
        }

        .carnate-notification-page .notification-subtitle {
            margin: 4px 0 0;
            color: var(--notify-muted);
            font-size: 12px;
            line-height: 1.5;
        }

        .carnate-notification-page .mark-all-btn {
            min-height: 40px;
            padding: 0 15px;
            border: 1px solid rgba(229, 57, 53, .25);
            border-radius: 9px;
            background: var(--notify-red-soft);
            color: var(--notify-red);
            display: inline-flex;
            align-items: center;
            gap: 7px;
            font-size: 12px;
            font-weight: 700;
            transition: .2s ease;
        }

        .carnate-notification-page .mark-all-btn:hover {
            background: var(--notify-red);
            border-color: var(--notify-red);
            color: #fff;
            transform: translateY(-1px);
        }

        .carnate-notification-page .mark-all-btn i {
            font-size: 17px;
        }

        /* Notification list */
        .carnate-notification-page .notification-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
            padding-top: 18px;
        }

        .carnate-notification-page .notification-item {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            padding: 16px;
            background: #fff;
            border: 1px solid var(--notify-border);
            border-radius: 13px;
            transition: .2s ease;
        }

        .carnate-notification-page .notification-item:hover {
            border-color: #cbd5e1;
            box-shadow: 0 6px 20px rgba(15, 23, 42, .06);
            transform: translateY(-1px);
        }

        .carnate-notification-page .notification-item.unread {
            background: #fffafa;
            border-color: rgba(229, 57, 53, .20);
            box-shadow: inset 3px 0 0 var(--notify-red);
        }

        .carnate-notification-page .notification-content {
            min-width: 0;
            display: flex;
            align-items: flex-start;
            gap: 13px;
        }

        .carnate-notification-page .notification-icon {
            width: 42px;
            height: 42px;
            min-width: 42px;
            border-radius: 10px;
            background: var(--notify-icon);
            color: #64748b;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .carnate-notification-page .notification-item.unread .notification-icon {
            background: var(--notify-red-soft);
            color: var(--notify-red);
        }

        .carnate-notification-page .notification-details {
            min-width: 0;
        }

        .carnate-notification-page .notification-heading {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 4px;
        }

        .carnate-notification-page .notification-item-title {
            margin: 0;
            color: var(--notify-text);
            font-size: 13px;
            font-weight: 700;
            line-height: 1.4;
        }

        .carnate-notification-page .new-badge {
            padding: 3px 7px;
            border-radius: 20px;
            background: var(--notify-red-soft);
            color: var(--notify-red);
            border: 1px solid rgba(229, 57, 53, .15);
            font-size: 9px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .03em;
        }

        .carnate-notification-page .notification-message {
            margin: 0 0 8px;
            color: var(--notify-muted);
            font-size: 12px;
            line-height: 1.55;
        }

        .carnate-notification-page .notification-meta {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 13px;
        }

        .carnate-notification-page .notification-time {
            color: #94a3b8;
            font-size: 11px;
            display: inline-flex;
            align-items: center;
        }

        .carnate-notification-page .notification-time i {
            margin-right: 4px;
            font-size: 14px;
        }

        .carnate-notification-page .view-order {
            color: var(--notify-red);
            display: inline-flex;
            align-items: center;
            text-decoration: none;
            font-size: 11px;
            font-weight: 700;
            transition: .2s ease;
        }

        .carnate-notification-page .view-order:hover {
            color: var(--notify-red-dark);
        }

        .carnate-notification-page .view-order i {
            margin-right: 4px;
            font-size: 14px;
        }

        /* Read / unread action */
        .carnate-notification-page .notification-action {
            flex-shrink: 0;
        }

        .carnate-notification-page .mark-read-btn {
            min-height: 34px;
            padding: 0 12px;
            border: 1px solid rgba(229, 57, 53, .20);
            border-radius: 8px;
            background: var(--notify-red-soft);
            color: var(--notify-red);
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 11px;
            font-weight: 700;
            transition: .2s ease;
        }

        .carnate-notification-page .mark-read-btn:hover {
            background: var(--notify-red);
            border-color: var(--notify-red);
            color: #fff;
        }

        .carnate-notification-page .read-badge {
            min-height: 34px;
            padding: 0 11px;
            border: 1px solid #dcfce7;
            border-radius: 8px;
            background: var(--notify-green-soft);
            color: var(--notify-green);
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 11px;
            font-weight: 700;
        }

        /* Empty state */
        .carnate-notification-page .notification-empty {
            padding: 60px 20px 50px;
            text-align: center;
        }

        .carnate-notification-page .empty-icon {
            width: 62px;
            height: 62px;
            margin: 0 auto 14px;
            border-radius: 16px;
            background: var(--notify-icon);
            color: #94a3b8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 27px;
        }

        .carnate-notification-page .empty-title {
            margin: 0;
            color: var(--notify-text);
            font-size: 15px;
            font-weight: 700;
        }

        .carnate-notification-page .empty-text {
            margin: 5px 0 0;
            color: var(--notify-muted);
            font-size: 12px;
        }

        /* Pagination */
        .carnate-notification-page .notification-pagination {
            margin-top: 18px;
            padding-top: 16px;
            border-top: 1px solid #eef2f7;
        }

        @media (max-width: 767.98px) {

            .carnate-notification-page .notification-body {
                padding: 16px;
            }

            .carnate-notification-page .notification-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .carnate-notification-page .mark-all-btn {
                width: 100%;
                justify-content: center;
            }

            .carnate-notification-page .notification-item {
                align-items: flex-start;
                flex-direction: column;
            }

            .carnate-notification-page .notification-action {
                width: 100%;
                padding-left: 55px;
            }

            .carnate-notification-page .mark-read-btn,
            .carnate-notification-page .read-badge {
                width: 100%;
                justify-content: center;
            }
        }
    </style>

    <div class="notification-card">

        <div class="notification-body">

            {{-- Header --}}
            <div class="notification-header">

                <div class="notification-title-wrap">

                    <div class="notification-title-icon">
                        <i class="bx bx-bell"></i>
                    </div>

                    <div>
                        <h4 class="notification-title">
                            Workshop Notifications
                        </h4>

                        <p class="notification-subtitle">
                            Keep track of your order updates, handovers, and payments.
                        </p>
                    </div>

                </div>

                @if($notifications->where('is_read', false)->count() > 0)

                    <button wire:click="markAllAsRead"
                        class="mark-all-btn">

                        <i class="bx bx-check-double"></i>
                        Mark All as Read

                    </button>

                @endif

            </div>

            {{-- Notifications --}}
            @if($notifications->count() > 0)

                <div class="notification-list">

                    @foreach($notifications as $notification)

                        <div class="notification-item {{ !$notification->is_read ? 'unread' : '' }}">

                            <div class="notification-content">

                                <div class="notification-icon">
                                    <i class="bx bx-bell"></i>
                                </div>

                                <div class="notification-details">

                                    <div class="notification-heading">

                                        <h6 class="notification-item-title">
                                            {{ $notification->title }}
                                        </h6>

                                        @if(!$notification->is_read)

                                            <span class="new-badge">
                                                New
                                            </span>

                                        @endif

                                    </div>

                                    <p class="notification-message">
                                        {{ $notification->message }}
                                    </p>

                                    <div class="notification-meta">

                                        <span class="notification-time">
                                            <i class="bx bx-time-five"></i>
                                            {{ $notification->created_at->diffForHumans() }}
                                        </span>

                                        @if($notification->order_id)

                                            <a href="{{ route('workshop.orders') }}"
                                                class="view-order">

                                                <i class="bx bx-show"></i>
                                                View Order

                                            </a>

                                        @endif

                                    </div>

                                </div>

                            </div>

                            <div class="notification-action">

                                @if(!$notification->is_read)

                                    <button wire:click="markAsRead({{ $notification->id }})"
                                        class="mark-read-btn"
                                        title="Mark as read">

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

                    @endforeach

                </div>

                <div class="notification-pagination">
                    {{ $notifications->links() }}
                </div>

            @else

                <div class="notification-empty">

                    <div class="empty-icon">
                        <i class="bx bx-bell-off"></i>
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