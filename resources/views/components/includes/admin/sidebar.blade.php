<?php
    $id = Auth::guard('admin')->user()->id;
    $admin = App\Models\Admin::where('id', $id)->first();
?>

<style>
    /* =========================================================
       CARNATE ADMIN SIDEBAR
       ========================================================= */

    :root {
        --carnate-sidebar-width: 270px;

        --carnate-white: #ffffff;
        --carnate-bg: #f7f8fa;

        --carnate-text: #111827;
        --carnate-text-secondary: #64748b;
        --carnate-text-muted: #94a3b8;

        --carnate-border: #e2e8f0;
        --carnate-hover: #f8fafc;

        --carnate-red: #e53935;
        --carnate-red-light: #fff5f5;

        --carnate-icon-bg: #f1f5f9;
    }


    /* =========================================================
       SIDEBAR CONTAINER
       ========================================================= */

    .sidebar-wrapper.carnate-sidebar {
        width: var(--carnate-sidebar-width) !important;
        background: var(--carnate-white) !important;
        background-color: var(--carnate-white) !important;

        border-right: 1px solid var(--carnate-border) !important;

        box-shadow: 4px 0 20px rgba(15, 23, 42, 0.035) !important;

        color: var(--carnate-text) !important;

        z-index: 1050;

        /* Keep the navigation anchored to the viewport.  Offsetting it below the
           topbar was leaving an empty strip above the logo on smaller screens. */
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        height: 100vh;
        height: 100dvh;
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }

    /* Header stays fixed at the top of the sidebar. */
    .carnate-sidebar-header {
        flex-shrink: 0;
        margin-top: 0;
    }

    /* The menu is the only scrollable part of the sidebar. */
    .carnate-menu-wrapper {
        /* Explicit bounds are used instead of flex sizing because the vendor
           sidebar styles can otherwise leave this element without a scrollable
           height on some viewports. */
        position: absolute;
        top: 72px;
        right: 0;
        bottom: 0;
        left: 0;
        overflow-y: scroll !important;
        overflow-x: hidden !important;
        -webkit-overflow-scrolling: touch;
        overscroll-behavior: contain;
        scrollbar-width: thin;
        scrollbar-color: #cbd5e1 transparent;
    }


    /* =========================================================
       LOGO AREA
       ========================================================= */

    .carnate-sidebar-header {
        height: 72px;

        display: flex;
        align-items: center;

        padding: 0 18px;

        background: #ffffff !important;

        border-bottom: 1px solid var(--carnate-border) !important;
    }

    .carnate-logo-wrapper {
        display: flex;
        align-items: center;

        min-width: 0;
        flex: 1;
    }

    .carnate-sidebar-logo {
        display: block;

        max-width: 165px;
        width: auto;
        height: auto;

        object-fit: contain;
    }


    /* =========================================================
       TOGGLE BUTTON
       ========================================================= */

    .carnate-toggle {
        width: 34px;
        height: 34px;

        display: flex;
        align-items: center;
        justify-content: center;

        margin-left: auto;

        border-radius: 9px;

        color: var(--carnate-red) !important;

        background: transparent !important;

        cursor: pointer;

        transition:
            background-color 0.2s ease,
            color 0.2s ease;
    }

    .carnate-toggle:hover {
        background: var(--carnate-red-light) !important;
        color: var(--carnate-red) !important;
    }

    .carnate-toggle i {
        font-size: 20px;
        color: inherit !important;
    }


    /* =========================================================
       MENU WRAPPER
       ========================================================= */

    .carnate-menu {
        padding: 14px 12px 20px !important;

        margin: 0 !important;

        background: #ffffff !important;
    }


    /* =========================================================
       SECTION TITLES
       ========================================================= */

    .carnate-menu .carnate-section-title {
        display: block !important;

        padding: 12px 10px 7px !important;
        margin: 0 !important;

        font-size: 10px !important;
        line-height: 1.2 !important;

        font-weight: 700 !important;

        letter-spacing: 0.10em !important;
        text-transform: uppercase !important;

        color: #94a3b8 !important;

        background: transparent !important;
    }


    /* =========================================================
       MAIN MENU ITEMS
       ========================================================= */

    .carnate-menu > li {
        margin: 2px 0 !important;

        list-style: none !important;

        background: transparent !important;
    }


    .carnate-menu > li > a {
        min-height: 44px;

        display: flex !important;
        align-items: center !important;

        gap: 11px;

        padding: 10px 12px !important;

        border-radius: 9px !important;

        border: 1px solid transparent !important;

        background: transparent !important;

        color: #64748b !important;

        font-size: 14px !important;
        font-weight: 500 !important;

        line-height: 1.3 !important;

        text-decoration: none !important;

        transition:
            background-color 0.18s ease,
            color 0.18s ease,
            border-color 0.18s ease;
    }


    /* =========================================================
       MENU ICONS
       ========================================================= */

    .carnate-menu > li > a > i:first-child,
    .carnate-menu > li > a > .parent-icon {
        width: 20px !important;
        min-width: 20px !important;

        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;

        margin: 0 !important;

        font-size: 18px !important;

        color: #64748b !important;

        transition:
            color 0.18s ease,
            transform 0.18s ease;
    }


    /* =========================================================
       HOVER
       ========================================================= */

    .carnate-menu > li > a:hover {
        background: #f8fafc !important;

        color: #111827 !important;

        border-color: transparent !important;
    }

    .carnate-menu > li > a:hover > i:first-child,
    .carnate-menu > li > a:hover > .parent-icon {
        color: #111827 !important;
    }


    /* =========================================================
       ACTIVE MENU
       ========================================================= */

    .carnate-menu > li.active > a,
    .carnate-menu > li.mm-active > a {
        background: #fff5f5 !important;

        color: #e53935 !important;

        border-color: rgba(229, 57, 53, 0.08) !important;

        font-weight: 600 !important;
    }

    .carnate-menu > li.active > a > i:first-child,
    .carnate-menu > li.active > a > .parent-icon,
    .carnate-menu > li.mm-active > a > i:first-child,
    .carnate-menu > li.mm-active > a > .parent-icon {
        color: #e53935 !important;
    }


    /* =========================================================
       DROPDOWN ARROW
       ========================================================= */

    .carnate-menu > li > a.has-arrow::after {
        margin-left: auto !important;

        color: #94a3b8 !important;

        transition:
            transform 0.2s ease,
            color 0.2s ease;
    }

    .carnate-menu > li > a.has-arrow:hover::after {
        color: #64748b !important;
    }

    .carnate-menu > li.mm-active > a.has-arrow::after {
        color: #e53935 !important;
    }


    /* =========================================================
       SUB MENU
       ========================================================= */

    .carnate-menu .submenu {
        margin: 4px 0 7px 18px !important;

        padding: 2px 0 2px 12px !important;

        border-left: 1px solid #e2e8f0 !important;

        background: transparent !important;
    }


    .carnate-menu .submenu li {
        margin: 1px 0 !important;

        list-style: none !important;
    }


    .carnate-menu .submenu li a {
        display: flex !important;
        align-items: center !important;

        min-height: 36px;

        padding: 8px 10px !important;

        border-radius: 7px !important;

        background: transparent !important;

        color: #64748b !important;

        font-size: 13px !important;
        font-weight: 500 !important;

        text-decoration: none !important;

        transition:
            background-color 0.18s ease,
            color 0.18s ease;
    }

    .carnate-menu .submenu li a:hover {
        background: #f8fafc !important;

        color: #111827 !important;
    }

    .carnate-menu .submenu li.active > a,
    .carnate-menu .submenu li.mm-active > a {
        background: #fff5f5 !important;

        color: #e53935 !important;

        font-weight: 600 !important;
    }


    /* =========================================================
       REMOVE OLD BLUE THEME STYLES
       ========================================================= */

    .carnate-sidebar,
    .carnate-sidebar *,
    .carnate-menu,
    .carnate-menu li,
    .carnate-menu li a {
        --bs-primary: #e53935 !important;
    }

    .carnate-sidebar .metismenu,
    .carnate-sidebar .metismenu li,
    .carnate-sidebar .metismenu li a {
        background-color: transparent !important;
    }

    .carnate-sidebar .metismenu li a:hover,
    .carnate-sidebar .metismenu li.mm-active > a {
        background-color: inherit;
    }


    /* =========================================================
       LOGOUT
       ========================================================= */

    .carnate-menu .carnate-logout {
        margin-top: 5px !important;
    }

    .carnate-menu .carnate-logout a {
        color: #64748b !important;
    }

    .carnate-menu .carnate-logout a:hover {
        background: #fff5f5 !important;

        color: #e53935 !important;
    }

    .carnate-menu .carnate-logout a:hover i {
        color: #e53935 !important;
    }


    /* =========================================================
       SCROLLBAR (fallback for menu wrapper)
       ========================================================= */

    .carnate-menu-wrapper::-webkit-scrollbar {
        width: 5px;
    }

    .carnate-menu-wrapper::-webkit-scrollbar-track {
        background: transparent;
    }

    .carnate-menu-wrapper::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }


    /* =========================================================
       SMOOTH COLLAPSE / EXPAND TRANSITIONS & TOGGLE BEHAVIOR
       ========================================================= */

    html .sidebar-wrapper.customsidebar.carnate-sidebar {
        transition: width 0.25s cubic-bezier(0.4, 0, 0.2, 1), left 0.25s cubic-bezier(0.4, 0, 0.2, 1) !important;
    }

    .page-wrapper {
        margin-left: var(--carnate-sidebar-width);
        transition: margin-left 0.25s cubic-bezier(0.4, 0, 0.2, 1) !important;
    }

    .topbar,
    .page-footer {
        transition: left 0.25s cubic-bezier(0.4, 0, 0.2, 1) !important;
    }

    /* COLLAPSED STATE (Desktop) */
    @media (min-width: 1025px) {
        html .wrapper.toggled:not(.sidebar-hovered) .sidebar-wrapper.customsidebar.carnate-sidebar {
            width: 70px !important;
        }

        html .wrapper.toggled:not(.sidebar-hovered) .page-wrapper {
            margin-left: 70px !important;
        }

        html .wrapper.toggled:not(.sidebar-hovered) .topbar,
        html .wrapper.toggled:not(.sidebar-hovered) .page-footer {
            left: 70px !important;
        }

        html .wrapper.toggled:not(.sidebar-hovered) .carnate-sidebar-header {
            padding: 0 10px !important;
            justify-content: center !important;
        }

        html .wrapper.toggled:not(.sidebar-hovered) .carnate-logo-wrapper {
            display: none !important;
        }

        html .wrapper.toggled:not(.sidebar-hovered) .carnate-toggle {
            margin: 0 !important;
        }

        html .wrapper.toggled:not(.sidebar-hovered) .carnate-menu {
            padding: 14px 6px 20px !important;
        }

        html .wrapper.toggled:not(.sidebar-hovered) .carnate-menu .menu-title {
            display: none !important;
        }

        html .wrapper.toggled:not(.sidebar-hovered) .carnate-menu .has-arrow::after {
            display: none !important;
        }

        html .wrapper.toggled:not(.sidebar-hovered) .carnate-menu .submenu {
            display: none !important;
        }

        html .wrapper.toggled:not(.sidebar-hovered) .carnate-menu > li > a {
            justify-content: center !important;
            padding: 10px 0 !important;
            gap: 0 !important;
        }

        html .wrapper.toggled:not(.sidebar-hovered) .carnate-menu > li > a > i:first-child,
        html .wrapper.toggled:not(.sidebar-hovered) .carnate-menu > li > a > .parent-icon {
            margin: 0 auto !important;
            font-size: 20px !important;
        }

        html .wrapper.toggled:not(.sidebar-hovered) .carnate-menu .carnate-section-title {
            height: 1px !important;
            padding: 0 !important;
            margin: 8px 6px !important;
            border-top: 1px solid #e2e8f0 !important;
            overflow: hidden !important;
            font-size: 0 !important;
            color: transparent !important;
        }
    }

    /* MOBILE RESPONSIVE SLIDE OUT */
    @media (max-width: 1024px) {
        html .sidebar-wrapper.customsidebar.carnate-sidebar {
            left: -270px !important;
        }

        html .page-wrapper {
            margin-left: 0 !important;
        }

        html .page-footer {
            left: 0 !important;
        }

        html .topbar {
            left: 0 !important;
        }

        html .wrapper.toggled .sidebar-wrapper.customsidebar.carnate-sidebar {
            left: 0 !important;
            box-shadow: 4px 0 25px rgba(0,0,0,0.18) !important;
        }
    }

    @media (max-width: 767px) {
        .carnate-sidebar-header {
            height: 64px;
        }

        .carnate-menu-wrapper {
            top: 64px;
        }

        .carnate-sidebar-logo {
            max-width: 145px;
        }

        .carnate-menu {
            padding: 12px 10px 18px !important;
        }
    }


    /* =========================================================
       ACCESSIBILITY
       ========================================================= */

    .carnate-menu a:focus-visible {
        outline: 2px solid rgba(229, 57, 53, 0.35) !important;

        outline-offset: 2px;
    }

    @media (prefers-reduced-motion: reduce) {
        .carnate-menu *,
        .carnate-toggle {
            transition: none !important;
        }
    }
</style>


<div class="sidebar-wrapper customsidebar carnate-sidebar">

    <!-- =====================================================
         LOGO
         ===================================================== -->

    <div class="carnate-sidebar-header">

        <div class="carnate-logo-wrapper">

            <a href="{{ route('admin.dashboard') }}">

                <img
                    src="{{ asset('assets/images/sidebarlogo.png') }}"
                    class="logo-icon carnate-sidebar-logo"
                    alt="Carnate"
                >

            </a>

        </div>

        <div class="toggle-icon ms-auto carnate-toggle">
            <i class="bx bx-arrow-to-left"></i>
        </div>

    </div>


    <!-- =====================================================
         MENU
         ===================================================== -->

    <div class="carnate-menu-wrapper">
        <ul class="metismenu carnate-menu" id="menu">


        <!-- =================================================
             MAIN
             ================================================= -->

        <li class="carnate-section-title">
            MAIN
        </li>


        <!-- Dashboard -->

        <li>
            <a href="{{ route('admin.dashboard') }}">

                <div class="parent-icon">
                    <i class="bx bx-home-alt"></i>
                </div>

                <div class="menu-title">
                    Dashboard
                </div>

            </a>
        </li>


        <!-- Sub Admin -->

        @if (@$admin->hasPermissionTo('sub-admin-show'))

            <li>

                <a href="{{ route('admin.sub.admin') }}">

                    <div class="parent-icon">
                        <i class="bx bx-user-pin"></i>
                    </div>

                    <div class="menu-title">
                        Sub Admin
                    </div>

                </a>

            </li>

        @endif



        <!-- =================================================
             FINANCE
             ================================================= -->

        <li class="carnate-section-title">
            FINANCE
        </li>


        <!-- Expenses -->

        @if (@$admin->hasPermissionTo('expense-category-show'))

            <li>

                <a href="javascript:void(0);" class="has-arrow">

                    <div class="parent-icon">
                        <i class="bx bx-money"></i>
                    </div>

                    <div class="menu-title">
                        Expenses
                    </div>

                </a>


                <ul class="submenu">

                    <li>
                        <a href="{{ route('admin.expense.category') }}">
                            Expense Category
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.expenses') }}">
                            Expenses
                        </a>
                    </li>

                </ul>

            </li>

        @endif



        <!-- =================================================
             WORKSHOP
             ================================================= -->

        <li class="carnate-section-title">
            WORKSHOP
        </li>


        <!-- Spare Part -->

        @if (
            @$admin->hasPermissionTo('spare-part-vendor-show') ||
            @$admin->hasPermissionTo('spare-part-label-show') ||
            @$admin->hasPermissionTo('spare-part-category-show') ||
            @$admin->hasPermissionTo('spare-part-unit-show')
        )

            <li>

                <a href="javascript:void(0);" class="has-arrow">

                    <div class="parent-icon">
                        <i class="bx bx-wrench"></i>
                    </div>

                    <div class="menu-title">
                        Spare Part
                    </div>

                </a>


                <ul class="submenu">

                    @if (@$admin->hasPermissionTo('spare-part-vendor-show'))

                        <li>
                            <a href="{{ route('admin.spare.part.vendor') }}">
                                Spare Part Vendor
                            </a>
                        </li>

                    @endif


                    @if (@$admin->hasPermissionTo('spare-part-label-show'))

                        <li>
                            <a href="{{ route('admin.spare.part.label') }}">
                                Spare Part Label
                            </a>
                        </li>

                    @endif


                    @if (@$admin->hasPermissionTo('spare-part-category-show'))

                        <li>
                            <a href="{{ route('admin.spare.part.category') }}">
                                Spare Part Category
                            </a>
                        </li>

                    @endif


                    @if (@$admin->hasPermissionTo('spare-part-unit-show'))

                        <li>
                            <a href="{{ route('admin.spare.part.unit') }}">
                                Spare Part Unit
                            </a>
                        </li>

                    @endif

                </ul>

            </li>

        @endif



        <!-- Customer -->

        @if (@$admin->hasPermissionTo('customer-show'))

            <li>

                <a href="{{ route('admin.customer') }}">

                    <div class="parent-icon">
                        <i class="bx bx-user"></i>
                    </div>

                    <div class="menu-title">
                        Customer
                    </div>

                </a>

            </li>

        @endif



        <!-- Job Cards -->

        @if (@$admin->hasPermissionTo('jobcard-show'))

            <li>

                <a href="{{ route('admin.job.card') }}">

                    <div class="parent-icon">
                        <i class="bx bx-list-check"></i>
                    </div>

                    <div class="menu-title">
                        Job-Cards
                    </div>

                </a>

            </li>

        @endif



        <!-- Workshop Vendor -->

        @if (@$admin->hasPermissionTo('work-shop-vendor-show'))

            <li>

                <a href="{{ route('admin.work.shop.vendor') }}">

                    <div class="parent-icon">
                        <i class="bx bx-user"></i>
                    </div>

                    <div class="menu-title">
                        Work Shop Vendor
                    </div>

                </a>

            </li>

        @endif



        <!-- Subscription Plan -->

        @if (@$admin->hasPermissionTo('plan-show'))

            <li>

                <a href="{{ route('admin.plan') }}">

                    <div class="parent-icon">
                        <i class="bx bx-package"></i>
                    </div>

                    <div class="menu-title">
                        Subscription Plan
                    </div>

                </a>

            </li>

        @endif



        <!-- =================================================
             ORDERS
             ================================================= -->

        <li class="carnate-section-title">
            ORDERS
        </li>


        <!-- Order -->

        <li>

            <a href="{{ route('admin.order-list') }}">

                <div class="parent-icon">
                    <i class="bx bx-cart"></i>
                </div>

                <div class="menu-title">
                    Order
                </div>

            </a>

        </li>



        <!-- =================================================
             VEHICLES
             ================================================= -->

        <li class="carnate-section-title">
            VEHICLES
        </li>


        @if (
            @$admin->hasPermissionTo('vehicle-show') ||
            @$admin->hasPermissionTo('makers-type-show') ||
            @$admin->hasPermissionTo('maker-show') ||
            @$admin->hasPermissionTo('modification-show')
        )

            <li>

                <a href="javascript:void(0);" class="has-arrow">

                    <div class="parent-icon">
                        <i class="bx bx-car"></i>
                    </div>

                    <div class="menu-title">
                        Vehicles
                    </div>

                </a>


                <ul class="submenu">


                    @if (@$admin->hasPermissionTo('vehicle-show'))

                        <li>
                            <a href="{{ route('admin.vehicle') }}">
                                Vehicles
                            </a>
                        </li>

                    @endif


                    @if (@$admin->hasPermissionTo('makers-type-show'))

                        <li>
                            <a href="{{ route('admin.makers_type') }}">
                                Makers Type
                            </a>
                        </li>

                    @endif


                    @if (@$admin->hasPermissionTo('maker-show'))

                        <li>
                            <a href="{{ route('admin.maker') }}">
                                Maker
                            </a>
                        </li>

                    @endif


                    {{-- Keep existing functionality unchanged --}}

                    {{--
                    @if (@$admin->hasPermissionTo('models-show'))

                        <li>
                            <a href="{{ route('admin.models') }}">
                                Models
                            </a>
                        </li>

                    @endif
                    --}}


                    {{--
                    @if (@$admin->hasPermissionTo('model-year-show'))

                        <li>
                            <a href="{{ route('admin.model_year') }}">
                                Model Year
                            </a>
                        </li>

                    @endif
                    --}}


                    @if (@$admin->hasPermissionTo('modification-show'))

                        <li>
                            <a href="{{ route('admin.modification') }}">
                                Modification
                            </a>
                        </li>

                    @endif

                </ul>

            </li>

        @endif



        <!-- =================================================
             PAYMENTS
             ================================================= -->

        <li class="carnate-section-title">
            PAYMENTS
        </li>


        <!-- Payment -->

        @if (@$admin->hasPermissionTo('payment-show'))

            <li>

                <a href="{{ route('admin.payment') }}">

                    <div class="parent-icon">
                        <i class="bx bx-credit-card"></i>
                    </div>

                    <div class="menu-title">
                        Payment
                    </div>

                </a>

            </li>

        @endif


        <!-- Withdraw -->

        @if (@$admin->hasPermissionTo('withdraw-show'))

            <li>

                <a href="{{ route('admin.withdraw') }}">

                    <div class="parent-icon">
                        <i class="bx bx-wallet"></i>
                    </div>

                    <div class="menu-title">
                        Withdraw
                    </div>

                </a>

            </li>

        @endif



        <!-- =================================================
             ADMINISTRATION
             ================================================= -->

        <li class="carnate-section-title">
            ADMINISTRATION
        </li>


        <!-- Role -->

        @if (@$admin->hasPermissionTo('admin-role-show'))

            <li>

                <a href="{{ route('admin.manageadminrole') }}">

                    <div class="parent-icon">
                        <i class="bx bx-shield"></i>
                    </div>

                    <div class="menu-title">
                        Role
                    </div>

                </a>

            </li>

        @endif



        <!-- =================================================
             ANALYTICS
             ================================================= -->

        <li class="carnate-section-title">
            ANALYTICS
        </li>


        <!-- Reports -->

        <li>

            <a href="javascript:void(0);" class="has-arrow">

                <div class="parent-icon">
                    <i class="bx bx-bar-chart-alt-2"></i>
                </div>

                <div class="menu-title">
                    Report
                </div>

            </a>


            <ul class="submenu">

                <li>
                    <a href="{{ route('admin.report.workshops') }}">
                        Workshops
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.report.customers') }}">
                        Customers
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.report.jobcards') }}">
                        Job Cards
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.report.orders') }}">
                        Orders
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.report.payments') }}">
                        Payments
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.report.expenses') }}">
                        Expenses
                    </a>
                </li>

            </ul>

        </li>



        <!-- =================================================
             RESET PASSWORD
             ================================================= -->

        <li>

            <a href="{{ route('admin.resetpassword') }}">

                <div class="parent-icon">
                    <i class="bx bx-refresh"></i>
                </div>

                <div class="menu-title">
                    Reset Password
                </div>

            </a>

        </li>



        <!-- =================================================
             LOGOUT
             ================================================= -->

        <li class="carnate-logout">

            <a href="{{ route('admin.logout') }}">

                <div class="parent-icon">
                    <i class="bx bx-log-out"></i>
                </div>

                <div class="menu-title">
                    Logout
                </div>

            </a>

        </li>

    </ul>
    </div>

</div>
