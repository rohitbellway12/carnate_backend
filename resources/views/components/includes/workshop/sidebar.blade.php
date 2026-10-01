<?php
$id = Auth::guard('workshop')->user()->id;

$user = App\Models\WorkShopVendor::where('id', $id)->first();

// echo "<pre>";print_r($user);die;
$logo = App\Models\WorkShopVendor::where('id', Auth::guard('workshop')->user()->id)->first();
$uploadedLogo = null;
if (!empty($logo->Image) && !empty($logo->Image->file)) {
    $fullPath = public_path($logo->Image->file);
    if (file_exists($fullPath)) {
        $uploadedLogo = 'data:image/png;base64,' . base64_encode(file_get_contents($fullPath));
    }
}
// dd($logo->Image->file);
?>
<style>
    :root { --carnate-sidebar-width: 270px; --carnate-text: #111827; --carnate-muted: #64748b; --carnate-border: #e2e8f0; --carnate-red: #e53935; }
    /* Override the legacy `.customsidebar` blue theme loaded by carnet.css. */
    html .sidebar-wrapper.customsidebar.carnate-sidebar { position: fixed; inset: 0 auto 0 0; z-index: 1050; display: flex; flex-direction: column; width: var(--carnate-sidebar-width) !important; height: 100dvh; overflow: hidden; background: #fff !important; background-color: #fff !important; border-right: 1px solid var(--carnate-border); box-shadow: 4px 0 20px rgba(15,23,42,.035); }
    .page-wrapper { margin-top: 72px; margin-left: var(--carnate-sidebar-width); }
    .page-footer { left: var(--carnate-sidebar-width); }
    .carnate-sidebar-header { display: flex; align-items: center; flex: 0 0 72px; height: 72px; padding: 0 18px; background: #fff; border-bottom: 1px solid var(--carnate-border); }
    .carnate-logo-wrapper { display: flex; flex: 1; min-width: 0; align-items: center; }
    .carnate-sidebar-logo { display: block; max-width: 165px; max-height: 44px; width: auto; object-fit: contain; }
    .carnate-toggle { display: flex; align-items: center; justify-content: center; width: 34px; height: 34px; margin-left: auto; border-radius: 9px; color: var(--carnate-red); cursor: pointer; } .carnate-toggle:hover { background: #fff5f5; }
    .carnate-menu-wrapper { position: absolute; inset: 72px 0 0; overflow-y: auto; overflow-x: hidden; scrollbar-width: thin; scrollbar-color: #cbd5e1 transparent; }
    html .sidebar-wrapper.customsidebar.carnate-sidebar .metismenu.carnate-menu { margin: 0 !important; margin-top: 0 !important; padding: 14px 12px 20px !important; background: #fff !important; background-color: #fff !important; }
    .carnate-menu > li { margin: 2px 0; list-style: none; }
    .carnate-menu > li > a, .carnate-menu .dropdown > a { display: flex !important; align-items: center; min-height: 44px; gap: 11px; padding: 10px 12px !important; border-radius: 9px; color: var(--carnate-muted) !important; font-size: 14px; font-weight: 500; text-decoration: none; transition: background .2s, color .2s; }
    .carnate-menu > li > a:hover, .carnate-menu > li.mm-active > a, .carnate-menu .dropdown > a:hover { background: #fff5f5 !important; color: var(--carnate-red) !important; }
    .carnate-menu .parent-icon { display: grid; width: 28px; height: 28px; flex: 0 0 28px; place-items: center; border-radius: 8px; background: #f1f5f9; color: #64748b; } .carnate-menu a:hover .parent-icon, .carnate-menu .mm-active > a .parent-icon { background: #fee2e2; color: var(--carnate-red); }
    .carnate-menu .parent-icon i { font-size: 16px; }
    .carnate-menu .menu-title { min-width: 0; flex: 1; color: inherit; }
    .carnate-menu .dropdown-right-icon { margin-left: auto; font-size: 11px; transition: transform .2s; }
    .carnate-menu .dropdown-content { display: none; margin: 2px 0 6px 39px; padding: 4px 0; border-left: 1px solid #e2e8f0; }
    .carnate-menu .dropdown:hover .dropdown-content, .carnate-menu .dropdown:focus-within .dropdown-content { display: block; }
    .carnate-menu .dropdown:hover .dropdown-right-icon, .carnate-menu .dropdown:focus-within .dropdown-right-icon { transform: rotate(90deg); }
    .carnate-menu .dropdown-content a { display: block; padding: 8px 12px !important; margin: 0 !important; color: #64748b !important; font-size: 13px; text-decoration: none; } .carnate-menu .dropdown-content a:hover { color: var(--carnate-red) !important; background: #fff5f5 !important; }
    /* The legacy toggle script still applies `.toggled`. Keep its page offset
       in sync with this redesigned sidebar instead of leaving a 270px panel
       over a page that has been shifted by only 70px. */
    @media (min-width: 1025px) {
        html .wrapper.toggled:not(.sidebar-hovered) .sidebar-wrapper.customsidebar.carnate-sidebar { width: 70px !important; }
        html .wrapper.toggled:not(.sidebar-hovered) .page-wrapper { margin-left: 70px !important; }
        html .wrapper.toggled:not(.sidebar-hovered) .topbar.topbarcarnet,
        html .wrapper.toggled:not(.sidebar-hovered) .page-footer { left: 70px !important; }
        html .wrapper.toggled:not(.sidebar-hovered) .carnate-sidebar-header { padding: 0 10px; justify-content: center; }
        html .wrapper.toggled:not(.sidebar-hovered) .carnate-logo-wrapper { display: none; }
        html .wrapper.toggled:not(.sidebar-hovered) .carnate-toggle { margin: 0; }
    }
    @media (max-width: 1024px) { .sidebar-wrapper.carnate-sidebar { left: -270px; } .page-wrapper { margin-left: 0; } .page-footer { left: 0; } .toggled .sidebar-wrapper.carnate-sidebar { left: 0; } }

    /* Admin sidebar parity: these intentionally mirror the supplied admin rules. */
    html .sidebar-wrapper.customsidebar.carnate-sidebar .metismenu.carnate-menu,
    html .sidebar-wrapper.customsidebar.carnate-sidebar .metismenu.carnate-menu > li,
    html .sidebar-wrapper.customsidebar.carnate-sidebar .metismenu.carnate-menu li {
        background: #fff !important;
        background-color: #fff !important;
    }
    html .sidebar-wrapper.customsidebar.carnate-sidebar .carnate-menu > li > a,
    html .sidebar-wrapper.customsidebar.carnate-sidebar .carnate-menu .dropdown > a {
        border: 1px solid transparent !important;
        background: transparent !important;
        color: #64748b !important;
        font-weight: 500 !important;
        line-height: 1.3 !important;
    }
    html .sidebar-wrapper.customsidebar.carnate-sidebar .carnate-menu > li > a:hover,
    html .sidebar-wrapper.customsidebar.carnate-sidebar .carnate-menu .dropdown > a:hover {
        background: #f8fafc !important;
        color: #111827 !important;
    }
    html .sidebar-wrapper.customsidebar.carnate-sidebar .carnate-menu > li.mm-active > a {
        background: #fff5f5 !important;
        color: #e53935 !important;
        border-color: rgba(229, 57, 53, .08) !important;
        font-weight: 600 !important;
    }
    html .sidebar-wrapper.customsidebar.carnate-sidebar .carnate-menu .parent-icon {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        width: 20px !important;
        min-width: 20px !important;
        height: auto !important;
        margin: 0 !important;
        border-radius: 0 !important;
        background: transparent !important;
        color: #64748b !important;
    }
    html .sidebar-wrapper.customsidebar.carnate-sidebar .carnate-menu > li > a:hover .parent-icon,
    html .sidebar-wrapper.customsidebar.carnate-sidebar .carnate-menu .dropdown > a:hover .parent-icon { color: #111827 !important; }
    html .sidebar-wrapper.customsidebar.carnate-sidebar .carnate-menu > li.mm-active > a .parent-icon { color: #e53935 !important; }
    html .sidebar-wrapper.customsidebar.carnate-sidebar .carnate-menu .dropdown-content {
        margin: 4px 0 7px 18px !important;
        padding: 2px 0 2px 12px !important;
        border-left: 1px solid #e2e8f0 !important;
        background: transparent !important;
        box-shadow: none !important;
    }
    html .sidebar-wrapper.customsidebar.carnate-sidebar .carnate-menu .dropdown-content a {
        min-height: 36px;
        padding: 8px 10px !important;
        border-radius: 7px !important;
        background: transparent !important;
        color: #64748b !important;
        font-size: 13px !important;
        font-weight: 500 !important;
    }
    html .sidebar-wrapper.customsidebar.carnate-sidebar .carnate-menu .dropdown-content a:hover { background: #f8fafc !important; color: #111827 !important; }
<    .carnate-menu .carnate-section-title {
        display: block !important;
        padding: 14px 12px 6px !important;
        margin: 8px 0 2px !important;
        font-size: 11px !important;
        line-height: 1.2 !important;
        font-weight: 700 !important;
        letter-spacing: 0.08em !important;
        text-transform: uppercase !important;
        color: #94a3b8 !important;
        background: transparent !important;
        list-style: none !important;
        border-top: 1px solid #f1f5f9;
        pointer-events: none;
        user-select: none;
    }
    .carnate-menu .carnate-section-title.first-section {
        border-top: 0 !important;
        margin-top: 0 !important;
        padding-top: 2px !important;
    }
    @media (min-width: 1025px) {
        html .wrapper.toggled:not(.sidebar-hovered) .carnate-section-title {
            height: 1px !important;
            padding: 0 !important;
            margin: 6px 12px !important;
            border-top: 1px solid #f1f5f9 !important;
            overflow: hidden !important;
            font-size: 0 !important;
            color: transparent !important;
        }
    }
</style>
<div class="sidebar-wrapper customsidebar carnate-sidebar">
    <div class="carnate-sidebar-header">
        <div class="carnate-logo-wrapper">
            <a href="{{ route('workshop.dashboard') }}">
                <!--<img src="{{ $uploadedLogo ?? asset('assets/images/sidebarlogo.png') }}" class="logo-icon carnate-sidebar-logo" alt="Workshop logo">-->
                                <img src="{{ asset('assets/images/sidebarlogo.png') }}" class="logo-icon carnate-sidebar-logo" alt="Carnate">

            </a>
        </div>
        <div class="toggle-icon carnate-toggle"><i class="bx bx-arrow-to-left"></i></div>
    </div>
    <div class="carnate-menu-wrapper">
        <ul class="metismenu carnate-menu" id="menu">

            {{-- ==================== MAIN ==================== --}}
            @if (@$user->hasPermissionTo('dashboard-show'))
                <li class="carnate-section-title first-section">Main</li>
                <li>
                    <a href="{{ route('workshop.dashboard') }}">
                        <div class="parent-icon"><i class="bx bx-home-circle"></i></div>
                        <div class="menu-title">Dashboard</div>
                    </a>
                </li>
            @endif

            {{-- ==================== WORKSHOP ==================== --}}
            @if (@$user->hasPermissionTo('Jobcard-show') || @$user->hasPermissionTo('counter-sale-show') || @$user->hasPermissionTo('Appointment-show'))
                <li class="carnate-section-title">Workshop</li>

                @if (@$user->hasPermissionTo('Jobcard-show'))
                    <li>
                        <a href="{{ route('workshop.jobcard') }}">
                            <div class="parent-icon"><i class="fas fa-tasks fs-5"></i></div>
                            <div class="menu-title">Job-Card</div>
                        </a>
                    </li>
                @endif

                @if (@$user->hasPermissionTo('counter-sale-show'))
                    <li>
                        <a href="{{ route('workshop.counter_sale') }}">
                            <div class="parent-icon"><i class="fas fa-cubes fs-5"></i></div>
                            <div class="menu-title">Counter Sale</div>
                        </a>
                    </li>
                @endif

                @if (@$user->hasPermissionTo('Appointment-show'))
                    <li>
                        <a href="{{ route('workshop.appointments') }}">
                            <div class="parent-icon"><i class="bx bxs-calendar fs-5"></i></div>
                            <div class="menu-title">Appointments</div>
                        </a>
                    </li>
                @endif
            @endif

            {{-- ==================== STORE & ORDERS ==================== --}}
            @if (@$user->hasPermissionTo('online-store-show') || @$user->hasPermissionTo('order-show') || @$user->hasPermissionTo('paid-order-show'))
                <li class="carnate-section-title">Store & Orders</li>

                @if (@$user->hasPermissionTo('online-store-show'))
                    <li>
                        <a href="{{ route('workshop.vehicle_search') }}">
                            <div class="parent-icon"><i class="bx bx-user"></i></div>
                            <div class="menu-title">Online store</div>
                        </a>
                    </li>
                @endif

                @if (@$user->hasPermissionTo('order-show'))
                    <li>
                        <a href="{{ route('workshop.orders') }}">
                            <div class="parent-icon"><i class="fas fa-shopping-cart fs-5"></i></div>
                            <div class="menu-title">Order</div>
                        </a>
                    </li>
                @endif

                @if (@$user->hasPermissionTo('paid-order-show'))
                    <li>
                        <a href="{{ route('workshop.paid-orders') }}">
                            <div class="parent-icon"><i class="fas fa-shopping-cart fs-5"></i></div>
                            <div class="menu-title">Paid-Order</div>
                        </a>
                    </li>
                @endif
            @endif

            {{-- ==================== MANAGEMENT ==================== --}}
            @if (@$user->hasPermissionTo('expenses-show') || @$user->hasPermissionTo('customer-show') || @$user->hasPermissionTo('staff-show') || true)
                <li class="carnate-section-title">Management</li>

                @if (@$user->hasPermissionTo('expenses-show'))
                    <li>
                        <div class="dropdown w-100">
                            <a href="#">
                                <div class="parent-icon"><i class="fas fa-file-invoice fs-5"></i></div>
                                <div class="menu-title w-100">Expenses Master</div>
                                <span class="fa fa-chevron-right dropdown-right-icon icon"></span>
                            </a>
                            <div class="dropdown-content">
                                <a href="{{ route('workshop.expenses') }}" class="ms-3" style="background-color: unset;">Expenses</a>
                                <a href="{{ route('workshop.expense.category') }}" class="ms-3" style="background-color: unset;">Expense Category</a>
                                <a href="{{ route('workshop.expense.supplier') }}" class="ms-3" style="background-color: unset;">Expense Supplier</a>
                            </div>
                        </div>
                    </li>
                @endif

                <li>
                    <div class="dropdown w-100">
                        <a href="javascript:void(0)">
                            <div class="parent-icon"><i class="fas fa-boxes fs-5"></i></div>
                            <div class="menu-title w-100">Inventory</div>
                            <span class="fa fa-chevron-right dropdown-right-icon icon"></span>
                        </a>
                        <div class="dropdown-content">
                            @if (@$user->hasPermissionTo('purchasestock-show'))
                                <a href="{{ route('workshop.productstock') }}" class="ms-3" style="background-color: unset;">Stock</a>
                            @endif
                            <a href="{{ route('workshop.suppliers') }}" class="ms-3" style="background-color: unset;">Supplier</a>
                            <a href="{{ route('workshop.labourchare') }}" class="ms-3" style="background-color: unset;">Labour Charge</a>
                        </div>
                    </div>
                </li>

                @if (@$user->hasPermissionTo('customer-show'))
                    <li>
                        <a href="{{ route('workshop.customer') }}">
                            <div class="parent-icon"><i class="fas fa-handshake fs-5"></i></div>
                            <div class="menu-title">Customers</div>
                        </a>
                    </li>
                @endif

                @if (@$user->hasPermissionTo('staff-show'))
                    <li>
                        <a href="{{ route('workshop.staff') }}">
                            <div class="parent-icon"><i class="fas fa-users-cog fs-5"></i></div>
                            <div class="menu-title">Staff</div>
                        </a>
                    </li>
                @endif
            @endif

            {{-- ==================== REPORTS ==================== --}}
            @if (@$user->hasPermissionTo('report-show'))
                <li class="carnate-section-title">Reports</li>
                <li>
                    <div class="dropdown w-100">
                        <a href="javascript:void(0)">
                            <div class="parent-icon"><i class="fas fa-chart-line fs-5"></i></div>
                            <div class="menu-title w-100">Report</div>
                            <span class="fa fa-chevron-right dropdown-right-icon icon"></span>
                        </a>
                        <div class="dropdown-content">
                            <a href="{{ route('workshop.report.salary') }}" class="ms-3" style="background-color: unset;">Salary Report</a>
                            <a href="{{ route('workshop.report.customers') }}" class="ms-3" style="background-color: unset;">Customers Report</a>
                            <a href="{{ route('workshop.report.customer-balance') }}" class="ms-3" style="background-color: unset;">Customer Balance Report</a>
                            <a href="{{ route('workshop.report.jobcards') }}" class="ms-3" style="background-color: unset;">Job Cards Report</a>
                            <a href="{{ route('workshop.report.staff') }}" class="ms-3" style="background-color: unset;">Staff Report</a>
                            <a href="{{ route('workshop.report.expenses') }}" class="ms-3" style="background-color: unset;">Expenses Report</a>
                            <a href="{{ route('workshop.report.inventory') }}" class="ms-3" style="background-color: unset;">Inventory Report</a>
                        </div>
                    </div>
                </li>
            @endif

            {{-- ==================== SETTINGS & SYSTEM ==================== --}}
            <li class="carnate-section-title">Settings & System</li>

            @if (@$user->hasPermissionTo('role-show'))
                <li>
                    <a href="{{ route('workshop.managerole') }}">
                        <div class="parent-icon"><i class="bx bx-shield"></i></div>
                        <div class="menu-title">Role</div>
                    </a>
                </li>
            @endif

            <li class="d-none">
                <a href="{{ route('workshop.managepermission') }}">
                    <div class="parent-icon"><i class="bx bx-user"></i></div>
                    <div class="menu-title">Permission</div>
                </a>
            </li>

            @if (@$user->hasPermissionTo('reset_password-show'))
                <li>
                    <a href="{{ route('workshop.resetpassword') }}">
                        <div class="parent-icon"><i class="bx bx-refresh"></i></div>
                        <div class="menu-title">Reset Password</div>
                    </a>
                </li>
            @endif

            @if (@$user->hasPermissionTo('support-show'))
                <li style="list-style:none; margin:8px 0;">
                    <div class="dropdown w-100" style="position:relative;">
                        <a href="javascript:void(0)"
                            style="
                                display:flex;
                                align-items:center;
                                justify-content:space-between;
                                padding:12px 18px;
                                text-decoration:none;
                                background:linear-gradient(135deg,#2c3e50,#4ca1af);
                                border-radius:14px;
                                color:#fff;
                                box-shadow:0 5px 15px rgba(0,0,0,0.15);
                                transition:0.3s;
                            ">
                            <div style="display:flex;align-items:center;">
                                <div class="parent-icon"
                                    style="
                                        width:38px;
                                        height:38px;
                                        border-radius:50%;
                                        background:rgba(255,255,255,0.15);
                                        display:flex;
                                        align-items:center;
                                        justify-content:center;
                                        margin-right:12px;
                                    ">
                                    <i class="fa-solid fa-circle-info"></i>
                                </div>
                                <div class="menu-title" style="font-size:16px;font-weight:600;letter-spacing:0.5px;">
                                    Support
                                </div>
                            </div>
                            <span class="fa fa-chevron-down" style="font-size:13px;color:#fff;"></span>
                        </a>

                        <div class="dropdown-content"
                            style="
                                background:#fff;
                                margin-top:8px;
                                border-radius:12px;
                                overflow:hidden;
                                box-shadow:0 8px 20px rgba(0,0,0,0.12);
                            ">
                            <a href="tel:+918147938343"
                                style="
                                    display:flex;
                                    align-items:center;
                                    gap:10px;
                                    padding:12px 18px;
                                    color:#333;
                                    text-decoration:none;
                                    border-bottom:1px solid #f1f1f1;
                                ">
                                <i class="fa-solid fa-phone" style="color:#4ca1af;"></i>
                                +91 8147 938 343
                            </a>

                            <a href="mailto:carnateindia@gmail.com"
                                style="
                                    display:flex;
                                    align-items:center;
                                    gap:10px;
                                    padding:12px 18px;
                                    color:#333;
                                    text-decoration:none;
                                ">
                                <i class="fa-solid fa-envelope" style="color:#4ca1af;"></i>
                                carnateindia@gmail.com
                            </a>
                        </div>
                    </div>
                </li>
            @endif

            <li>
                <a href="{{ route('unified.logout') }}">
                    <div class="parent-icon"><i class="bx bx-log-out-circle"></i></div>
                    <div class="menu-title">Logout</div>
                </a>
            </li>

        </ul>
    </div>
</div>
