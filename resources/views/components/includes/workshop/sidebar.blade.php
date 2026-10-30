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
    :root { 
        --carnate-sidebar-width: 260px; 
        --carnate-text: #111827; 
        --carnate-muted: #64748b; 
        --carnate-border: #e2e8f0; 
        --carnate-red: #e53935; 
    }
    
    /* Override legacy blue theme & establish clean 260px container */
    html .sidebar-wrapper.customsidebar.carnate-sidebar { 
        position: fixed; 
        top: 0;
        bottom: 0;
        left: 0;
        z-index: 1050; 
        display: flex; 
        flex-direction: column; 
        width: var(--carnate-sidebar-width) !important; 
        height: 100dvh; 
        overflow: hidden; 
        background: #fff !important; 
        background-color: #fff !important; 
        border-right: 1px solid var(--carnate-border); 
        box-shadow: none; 
    }
    .page-wrapper { margin-top: 72px; margin-left: var(--carnate-sidebar-width); }
    .page-footer { left: var(--carnate-sidebar-width); }
    .carnate-sidebar-header { 
        display: flex; 
        align-items: center; 
        flex: 0 0 72px; 
        height: 72px; 
        padding: 0 25px; 
        background: #fff; 
        border-bottom: 1px solid var(--carnate-border); 
    }
    .carnate-logo-wrapper { display: flex; flex: 1; min-width: 0; align-items: center; }
    .carnate-sidebar-logo { display: block; max-width: 145px; max-height: 48px; width: auto; object-fit: contain; }
    .carnate-toggle { 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        width: 36px; 
        height: 36px; 
        margin-left: auto; 
        border-radius: 8px; 
        color: var(--carnate-red); 
        cursor: pointer; 
        transition: all .2s ease;
    } 
    .carnate-toggle:hover { background: #fff5f5; }
    
    .carnate-menu-wrapper { 
        position: absolute; 
        inset: 72px 0 0; 
        overflow-y: auto; 
        overflow-x: hidden; 
        scrollbar-width: thin; 
        scrollbar-color: #cbd5e1 transparent; 
    }
    .carnate-menu-wrapper::-webkit-scrollbar { width: 6px; }
    .carnate-menu-wrapper::-webkit-scrollbar-track { background: transparent; }
    .carnate-menu-wrapper::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }

    /* Clean full-width menu matching sparepart */
    html .sidebar-wrapper.customsidebar.carnate-sidebar .metismenu.carnate-menu { 
        margin: 0 !important; 
        padding: 10px 0 60px 0 !important; 
        background: #fff !important; 
        background-color: #fff !important; 
        list-style: none !important;
    }
    .carnate-menu > li { 
        margin: 0 !important; 
        padding: 0 !important;
        list-style: none !important; 
    }

    /* Section titles: uppercase, bold, generous spacing */
    .carnate-menu .carnate-section-title {
        display: block !important;
        width: 100% !important;
        padding: 22px 25px 9px !important;
        margin: 0 !important;
        font-size: 12px !important;
        font-weight: 700 !important;
        line-height: 1.4 !important;
        letter-spacing: 1px !important;
        text-transform: uppercase !important;
        color: #94a3b8 !important;
        background: transparent !important;
        border: 0 !important;
        list-style: none !important;
        pointer-events: none;
        user-select: none;
    }
    .carnate-menu .carnate-section-title.first-section {
        padding-top: 14px !important;
    }

    /* Main Menu Links & Dropdown toggles */
    .carnate-menu > li > a, 
    .carnate-menu .dropdown > a { 
        position: relative !important;
        display: flex !important; 
        align-items: center !important; 
        width: 100% !important;
        min-height: 52px !important; 
        height: auto !important;
        margin: 0 !important;
        padding: 10px 25px !important; 
        border-radius: 0 !important; 
        border: 0 !important; 
        color: #64748b !important; 
        font-size: 15px !important; 
        font-weight: 500 !important; 
        background: transparent !important;
        text-decoration: none !important; 
        transition: background-color .2s ease, color .2s ease !important; 
        cursor: pointer !important; 
    }
    
    .carnate-menu > li > a:hover, 
    .carnate-menu .dropdown > a:hover { 
        background: #fff5f5 !important; 
        color: #e53935 !important; 
    }

    /* Single active menu link (like Dashboard, Customers, etc.) */
    .carnate-menu > li.active > a, 
    .carnate-menu > li.mm-active > a { 
        background: #fff5f5 !important; 
        color: #e53935 !important; 
        font-weight: 600 !important; 
    }
    .carnate-menu > li.active > a .parent-icon, 
    .carnate-menu > li.mm-active > a .parent-icon { 
        color: #e53935 !important; 
    }

    /* Parent Icons: clean, no grey square box */
    .carnate-menu .parent-icon { 
        width: 34px !important; 
        min-width: 34px !important; 
        height: 30px !important; 
        display: flex !important;
        align-items: center !important; 
        justify-content: flex-start !important; 
        border-radius: 0 !important; 
        background: transparent !important; 
        color: #64748b !important; 
        font-size: 20px !important; 
        line-height: 1 !important;
        transition: color .2s ease !important; 
    }
    .carnate-menu a:hover .parent-icon { 
        background: transparent !important;
        color: #e53935 !important; 
    }

    .carnate-menu .menu-title { 
        display: block !important;
        margin-left: 18px !important;
        padding: 0 !important;
        color: inherit !important;
        font-size: 15px !important;
        font-weight: 500 !important;
        line-height: 1.4 !important;
        white-space: nowrap !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
    }

    /* Dropdown chevron arrow */
    .carnate-menu .dropdown-right-icon { 
        position: absolute !important;
        right: 25px !important;
        top: 50% !important;
        transform: translateY(-50%) !important;
        font-size: 11px !important; 
        color: #94a3b8 !important;
        transition: color .2s ease, transform .2s ease !important; 
    }
    .carnate-menu .dropdown > a:hover .dropdown-right-icon {
        color: #e53935 !important;
    }

    /* Dropdown container */
    .sidebar-wrapper.customsidebar .carnate-menu .dropdown-content { 
        display: none; 
        position: relative !important;
        width: 100% !important;
        margin: 0 !important; 
        padding: 0 !important; 
        border: 0 !important; 
        border-left: 0 !important; 
        background: #ffffff !important; 
        box-shadow: none !important;
        overflow: visible !important;
    }
    
    /* Open state */
    .sidebar-wrapper.customsidebar .carnate-menu .dropdown.is-open > .dropdown-content { 
        display: block !important; 
    }
    .sidebar-wrapper.customsidebar .carnate-menu .dropdown.is-open > a .dropdown-right-icon { 
        transform: translateY(-50%) rotate(90deg) !important; 
        color: #e53935 !important; 
    }

    /* Active parent when route is inside it (text/icon highlight, no border bubble) */
    .sidebar-wrapper.customsidebar .carnate-menu .dropdown:not(.support-dropdown).active > a {
        color: #e53935 !important;
        font-weight: 600 !important;
    }
    .sidebar-wrapper.customsidebar .carnate-menu .dropdown:not(.support-dropdown).active > a .parent-icon {
        color: #e53935 !important;
    }

    /* Submenu links: full-width indented matching sparepart */
    .sidebar-wrapper.customsidebar .carnate-menu .dropdown-content a {
        position: relative !important;
        display: flex !important;
        align-items: center !important;
        width: 100% !important;
        min-height: 43px !important;
        margin: 0 !important;
        padding: 8px 25px 8px 77px !important;
        color: #64748b !important;
        background: transparent !important;
        border: 0 !important;
        border-radius: 0 !important;
        font-size: 14px !important;
        font-weight: 400 !important;
        line-height: 1.4 !important;
        text-decoration: none !important;
        transition: background-color .2s ease, color .2s ease !important;
    }
    .sidebar-wrapper.customsidebar .carnate-menu .dropdown-content a:hover {
        background: #fff5f5 !important;
        color: #e53935 !important;
    }
    .sidebar-wrapper.customsidebar .carnate-menu .dropdown-content a.active {
        background: #fff5f5 !important;
        color: #e53935 !important;
        font-weight: 600 !important;
    }

    /* Submenu circular bullet dot */
    .sidebar-wrapper.customsidebar .carnate-menu .dropdown-content a::before {
        content: '';
        position: absolute;
        left: 59px;
        top: 50%;
        width: 5px;
        height: 5px;
        transform: translateY(-50%);
        background: #cbd5e1;
        border-radius: 50%;
        transition: background .2s ease;
    }
    .sidebar-wrapper.customsidebar .carnate-menu .dropdown-content a:hover::before,
    .sidebar-wrapper.customsidebar .carnate-menu .dropdown-content a.active::before {
        background: #e53935 !important;
    }

    @media (min-width: 1025px) {
        html .wrapper.toggled:not(.sidebar-hovered) .sidebar-wrapper.customsidebar.carnate-sidebar { width: 70px !important; }
        html .wrapper.toggled:not(.sidebar-hovered) .page-wrapper { margin-left: 70px !important; }
        html .wrapper.toggled:not(.sidebar-hovered) .topbar.topbarcarnet,
        html .wrapper.toggled:not(.sidebar-hovered) .page-footer { left: 70px !important; }
        html .wrapper.toggled:not(.sidebar-hovered) .carnate-sidebar-header { padding: 0 10px; justify-content: center; }
        html .wrapper.toggled:not(.sidebar-hovered) .carnate-logo-wrapper { display: none; }
        html .wrapper.toggled:not(.sidebar-hovered) .carnate-toggle { margin: 0; }
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
    @media (max-width: 1024px) {
        html .sidebar-wrapper.customsidebar.carnate-sidebar {
            left: -280px !important;
            top: 0 !important;
            bottom: 0 !important;
            width: 270px !important;
            max-width: 85vw !important;
            transition: left 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            z-index: 1060 !important;
            box-shadow: none !important;
        }
        html .page-wrapper {
            margin-left: 0 !important;
        }
        html .page-footer {
            left: 0 !important;
        }
        html .topbar.topbarcarnet {
            left: 0 !important;
        }
        html .wrapper.toggled .sidebar-wrapper.customsidebar.carnate-sidebar,
        .wrapper.toggled .sidebar-wrapper.customsidebar.carnate-sidebar,
        .wrapper.toggled .sidebar-wrapper {
            left: 0 !important;
            box-shadow: 6px 0 30px rgba(0, 0, 0, 0.25) !important;
        }
        .carnate-toggle i {
            font-size: 20px;
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
                <li class="{{ request()->routeIs('workshop.dashboard*') ? 'mm-active active' : '' }}">
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
                    <li class="{{ request()->routeIs('workshop.jobcard*') ? 'mm-active active' : '' }}">
                        <a href="{{ route('workshop.jobcard') }}">
                            <div class="parent-icon"><i class="fas fa-tasks fs-5"></i></div>
                            <div class="menu-title">Job-Card</div>
                        </a>
                    </li>
                @endif

                @if (@$user->hasPermissionTo('counter-sale-show'))
                    <li class="{{ (request()->routeIs('workshop.counter_sale*') || request()->routeIs('workshop.addcountersale*') || request()->routeIs('workshop.editcountersalee*')) ? 'mm-active active' : '' }}">
                        <a href="{{ route('workshop.counter_sale') }}">
                            <div class="parent-icon"><i class="fas fa-cubes fs-5"></i></div>
                            <div class="menu-title">Counter Sale</div>
                        </a>
                    </li>
                @endif

                @if (@$user->hasPermissionTo('Appointment-show'))
                    <li class="{{ request()->routeIs('workshop.appointments*') ? 'mm-active active' : '' }}">
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
                    <li class="{{ request()->routeIs('workshop.vehicle_search*') ? 'mm-active active' : '' }}">
                        <a href="{{ route('workshop.vehicle_search') }}">
                            <div class="parent-icon"><i class="bx bx-user"></i></div>
                            <div class="menu-title">Online store</div>
                        </a>
                    </li>
                @endif

                @if (@$user->hasPermissionTo('order-show'))
                    <li class="{{ request()->routeIs('workshop.orders*') ? 'mm-active active' : '' }}">
                        <a href="{{ route('workshop.orders') }}">
                            <div class="parent-icon"><i class="fas fa-shopping-cart fs-5"></i></div>
                            <div class="menu-title">Order</div>
                        </a>
                    </li>
                @endif

                @if (@$user->hasPermissionTo('paid-order-show'))
                    <li class="{{ request()->routeIs('workshop.paid-orders*') ? 'mm-active active' : '' }}">
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

                @php
                    $isExpensesActive = request()->routeIs('workshop.expenses*') || request()->routeIs('workshop.expense.*');
                @endphp
                @if (@$user->hasPermissionTo('expenses-show'))
                    <li>
                        <div class="dropdown w-100 {{ $isExpensesActive ? 'is-open active' : '' }}">
                            <a href="javascript:void(0)">
                                <div class="parent-icon"><i class="fas fa-file-invoice fs-5"></i></div>
                                <div class="menu-title w-100">Expenses Master</div>
                                <span class="fa fa-chevron-right dropdown-right-icon icon"></span>
                            </a>
                            <div class="dropdown-content">
                                <a href="{{ route('workshop.expenses') }}" class="{{ request()->routeIs('workshop.expenses*') ? 'active' : '' }}">Expenses</a>
                                <a href="{{ route('workshop.expense.category') }}" class="{{ request()->routeIs('workshop.expense.category*') ? 'active' : '' }}">Expense Category</a>
                                <a href="{{ route('workshop.expense.supplier') }}" class="{{ request()->routeIs('workshop.expense.supplier*') ? 'active' : '' }}">Expense Supplier</a>
                            </div>
                        </div>
                    </li>
                @endif

                @php
                    $isInventoryActive = request()->routeIs('workshop.productstock*') || request()->routeIs('workshop.suppliers*') || request()->routeIs('workshop.labourchare*');
                @endphp
                <li>
                    <div class="dropdown w-100 {{ $isInventoryActive ? 'is-open active' : '' }}">
                        <a href="javascript:void(0)">
                            <div class="parent-icon"><i class="fas fa-boxes fs-5"></i></div>
                            <div class="menu-title w-100">Inventory</div>
                            <span class="fa fa-chevron-right dropdown-right-icon icon"></span>
                        </a>
                        <div class="dropdown-content">
                            @if (@$user->hasPermissionTo('purchasestock-show'))
                                <a href="{{ route('workshop.productstock') }}" class="{{ request()->routeIs('workshop.productstock*') ? 'active' : '' }}">Stock</a>
                            @endif
                            <a href="{{ route('workshop.suppliers') }}" class="{{ request()->routeIs('workshop.suppliers*') ? 'active' : '' }}">Supplier</a>
                            <a href="{{ route('workshop.labourchare') }}" class="{{ request()->routeIs('workshop.labourchare*') ? 'active' : '' }}">Labour Charge</a>
                        </div>
                    </div>
                </li>

                @if (@$user->hasPermissionTo('customer-show'))
                    <li class="{{ request()->routeIs('workshop.customer*') ? 'mm-active active' : '' }}">
                        <a href="{{ route('workshop.customer') }}">
                            <div class="parent-icon"><i class="fas fa-handshake fs-5"></i></div>
                            <div class="menu-title">Customers</div>
                        </a>
                    </li>
                @endif

                @if (@$user->hasPermissionTo('staff-show'))
                    <li class="{{ request()->routeIs('workshop.staff*') ? 'mm-active active' : '' }}">
                        <a href="{{ route('workshop.staff') }}">
                            <div class="parent-icon"><i class="fas fa-users-cog fs-5"></i></div>
                            <div class="menu-title">Staff</div>
                        </a>
                    </li>
                @endif
            @endif

            {{-- ==================== REPORTS ==================== --}}
            @if (@$user->hasPermissionTo('report-show'))
                @php
                    $isReportsActive = request()->routeIs('workshop.report.*') || request()->is('workshop/report*');
                @endphp
                <li class="carnate-section-title">Reports</li>
                <li>
                    <div class="dropdown w-100 {{ $isReportsActive ? 'is-open active' : '' }}">
                        <a href="javascript:void(0)">
                            <div class="parent-icon"><i class="fas fa-chart-line fs-5"></i></div>
                            <div class="menu-title w-100">Report</div>
                            <span class="fa fa-chevron-right dropdown-right-icon icon"></span>
                        </a>
                        <div class="dropdown-content">
                            <a href="{{ route('workshop.report.profit-loss') }}" class="{{ request()->routeIs('workshop.report.profit-loss') ? 'active' : '' }}">Profit & Loss Report</a>
                            <a href="{{ route('workshop.report.salary') }}" class="{{ request()->routeIs('workshop.report.salary') ? 'active' : '' }}">Salary Report</a>
                            <a href="{{ route('workshop.report.customers') }}" class="{{ request()->routeIs('workshop.report.customers') ? 'active' : '' }}">Customers Report</a>
                            <a href="{{ route('workshop.report.customer-balance') }}" class="{{ request()->routeIs('workshop.report.customer-balance') ? 'active' : '' }}">Customer Balance Report</a>
                            <a href="{{ route('workshop.report.jobcards') }}" class="{{ request()->routeIs('workshop.report.jobcards') ? 'active' : '' }}">Job Cards Report</a>
                            <a href="{{ route('workshop.report.staff') }}" class="{{ request()->routeIs('workshop.report.staff') ? 'active' : '' }}">Staff Report</a>
                            <a href="{{ route('workshop.report.expenses') }}" class="{{ request()->routeIs('workshop.report.expenses') ? 'active' : '' }}">Expenses Report</a>
                            <a href="{{ route('workshop.report.inventory') }}" class="{{ request()->routeIs('workshop.report.inventory') ? 'active' : '' }}">Inventory Report</a>
                        </div>
                    </div>
                </li>
            @endif

            {{-- ==================== SETTINGS & SYSTEM ==================== --}}
            <li class="carnate-section-title">Settings & System</li>

            @if (@$user->hasPermissionTo('role-show'))
                <li class="{{ request()->routeIs('workshop.managerole*') ? 'mm-active active' : '' }}">
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
                <li class="{{ request()->routeIs('workshop.resetpassword*') ? 'mm-active active' : '' }}">
                    <a href="{{ route('workshop.resetpassword') }}">
                        <div class="parent-icon"><i class="bx bx-refresh"></i></div>
                        <div class="menu-title">Reset Password</div>
                    </a>
                </li>
            @endif

            @if (@$user->hasPermissionTo('support-show'))
                <li style="list-style:none; margin:8px 0;">
                    <div class="dropdown w-100 support-dropdown" style="position:relative;">
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

<script>
    function initWorkshopSidebarDropdowns() {
        // Toggle submenus on CLICK only (no hover)
        document.querySelectorAll('.carnate-menu .dropdown > a, .sidebar-wrapper.customsidebar .dropdown > a').forEach(function (toggleLink) {
            if (toggleLink.dataset.dropdownInit) return;
            toggleLink.dataset.dropdownInit = 'true';

            toggleLink.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                var parentDropdown = this.closest('.dropdown');
                if (parentDropdown) {
                    var willOpen = !parentDropdown.classList.contains('is-open');
                    parentDropdown.classList.toggle('is-open', willOpen);
                }
            });
        });

        // Ensure active dropdowns remain open and visually highlighted
        var currentUrl = window.location.href.split(/[?#]/)[0];
        document.querySelectorAll('.carnate-menu .dropdown-content a, .sidebar-wrapper.customsidebar .dropdown-content a').forEach(function (subLink) {
            var linkUrl = (subLink.href || '').split(/[?#]/)[0];
            if (linkUrl && currentUrl === linkUrl) {
                subLink.classList.add('active');
                var parentDropdown = subLink.closest('.dropdown');
                if (parentDropdown) {
                    parentDropdown.classList.add('is-open', 'active');
                }
            }
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initWorkshopSidebarDropdowns);
    } else {
        initWorkshopSidebarDropdowns();
    }

    document.addEventListener('livewire:navigated', function () {
        setTimeout(initWorkshopSidebarDropdowns, 150);
    });
</script>
