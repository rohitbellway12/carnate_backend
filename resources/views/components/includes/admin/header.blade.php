<style>
    /* Admin header: match the white, slate and red sidebar treatment. */
    .topbar.topbarcarnet {
        left: var(--carnate-sidebar-width, 270px);
        height: 72px;
        background: #ffffff;
        border-bottom: 1px solid #e2e8f0;
        box-shadow: none;
        z-index: 1040;
    }

    .topbar.topbarcarnet .navbar {
        height: 72px;
        padding: 0 24px;
    }

    .topbarcarnet .notification-box > .nav-link {
        position: relative;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        padding: 0;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        color: #64748b;
        background: #ffffff;
    }

    .topbarcarnet .notification-box > .nav-link:hover,
    .topbarcarnet .notification-box > .nav-link:focus {
        color: #e53935;
        background: #fff5f5;
        border-color: #fecaca;
    }

    .topbarcarnet #notif-count {
        position: absolute;
        top: -5px;
        right: -5px;
        min-width: 18px;
        height: 18px;
        padding: 0 5px;
        border: 2px solid #ffffff;
        border-radius: 999px;
        background: #e53935 !important;
        color: #ffffff;
        font-size: 10px;
        font-weight: 700;
        line-height: 14px;
    }

    .topbarcarnet .user-img {
       
        
         width: 46px;
        height: 46px;
        object-fit: contain;
        padding: 2px;
        background: #ffffff;
        border: 1.5px solid #e2e8f0;
        border-radius: 12px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
    }

    .topbarcarnet .user-box .designattion {
        color: #64748b;
        font-size: 13px;
        font-weight: 600;
    }

    .topbarcarnet .notification-box .dropdown-menu {
        margin-top: 12px;
        width: min(360px, calc(100vw - 24px)) !important;
        max-height: min(420px, calc(100dvh - 96px)) !important;
        padding: 0;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        box-shadow: 0 12px 28px rgba(15, 23, 42, 0.12);
        overflow-x: hidden;
    }

    .topbarcarnet .notification-box .dropdown-header {
        padding: 16px;
        color: #475569;
        font-size: 16px;
        font-weight: 700;
    }

    .topbarcarnet #notification-list .dropdown-item {
        white-space: normal;
        overflow-wrap: anywhere;
        padding: 14px 16px;
        color: #64748b;
        background: #ffffff;
        border-color: #e2e8f0 !important;
    }

    .topbarcarnet #notification-list .dropdown-item:hover {
        background: #f8fafc;
    }

    .topbarcarnet #notification-list .d-flex {
        align-items: flex-start !important;
    }

    .topbarcarnet #notification-list strong,
    .topbarcarnet #notification-list small {
        white-space: normal !important;
        overflow-wrap: anywhere;
    }

    .topbarcarnet #notification-list strong {
        color: #111827 !important;
        font-size: 13px !important;
        font-weight: 700;
        line-height: 1.35;
    }

    .topbarcarnet #notification-list small {
        margin-top: 4px;
        color: #64748b !important;
        font-size: 12px !important;
        line-height: 1.45 !important;
    }

    .topbarcarnet #notification-list button {
        flex: 0 0 auto;
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 9px;
        background: #f0fdf4 !important;
        color: #16a34a;
    }

    .topbarcarnet .notification-box .dropdown-divider {
        margin: 0;
        border-color: #e2e8f0;
    }

    .topbarcarnet .notification-box .dropdown-item.text-center {
        padding: 13px 16px;
        color: #e53935 !important;
        font-size: 13px;
    }

    @media (max-width: 991px) {
        .topbar.topbarcarnet {
            left: 0;
        }
    }

    @media (max-width: 575px) {
        .topbarcarnet .notification-box .dropdown-menu {
            position: fixed !important;
            top: 72px !important;
            right: 12px !important;
            left: 12px !important;
            width: auto !important;
            transform: none !important;
        }
    }
</style>

<header>
    <div class="topbar d-flex align-items-center topbarcarnet">
        <nav class="navbar navbar-expand">
            <div class="mobile-toggle-menu"><i class="bx bx-menu"></i>
            </div>
            <div class="search-bar flex-grow-1">
            </div>

            <!-- Notification bell for admin users -->
            <div class="notification-box dropdown ms-3">
                <a class="nav-link dropdown-toggle" href="#" id="adminNotificationDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-bell" aria-hidden="true"></i>
                    <span class="badge bg-danger" id="notif-count">0</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="adminNotificationDropdown">
                    <li class="dropdown-header">Notifications</li>
                    <div id="notification-list"></div>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-center text-primary fw-bold" href="{{ route('admin.notifications') ?? '#' }}">View All Notifications</a></li>
                </ul>
            </div>

            <div class="user-box dropdown">
                <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#"
                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="user-img d-inline-flex align-items-center justify-content-center bg-light text-secondary" aria-hidden="true">
                        <i class="fa-solid fa-user"></i>
                    </span>
                    <div class="user-info ps-3">
                        {{-- <p class="user-name mb-0">{{ ucwords(Auth::guard('admin')->user()->name ?? '') }}</p> --}}
                        <p class="designattion mb-0">Admin</p>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="{{route('admin.profile')}}">
                            <i class="bx bx-user"></i>
                            <span>Profile</span>
                        </a>
                    </li>
                    <li><a class="dropdown-item" href="{{route('admin.logout')}}"><i
                                class="bx bx-log-out-circle"></i><span>Logout</span></a>


                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
