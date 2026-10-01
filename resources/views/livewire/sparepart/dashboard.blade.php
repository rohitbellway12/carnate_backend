<div class="carnate-sparepart-dashboard">

    <style>
        /* =========================================================
           CARNATE SPARE PART DASHBOARD
        ========================================================= */

        .carnate-sparepart-dashboard {
            --carnate-red: #e53935;
            --carnate-red-dark: #d92f2b;
            --carnate-red-soft: #fff5f5;

            --carnate-text: #111827;
            --carnate-heading: #1e293b;
            --carnate-muted: #64748b;
            --carnate-light: #94a3b8;

            --carnate-border: #e2e8f0;
            --carnate-border-light: #edf1f5;

            --carnate-bg: #f7f8fa;
            --carnate-white: #ffffff;

            color: var(--carnate-text);
        }


        /* =========================================================
           PAGE HEADER
        ========================================================= */

        .carnate-sparepart-dashboard .dashboard-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 22px;
        }

        .carnate-sparepart-dashboard .dashboard-title-wrap {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .carnate-sparepart-dashboard .dashboard-title-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: var(--carnate-red-soft);
            color: var(--carnate-red);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
        }

        .carnate-sparepart-dashboard .dashboard-title,
        .carnate-sparepart-dashboard .breadcrumb-title {
            margin: 0;
            color: var(--carnate-heading);
            font-size: 22px;
            font-weight: 700;
            line-height: 1.25;
            letter-spacing: -0.3px;
            border: 0 !important;
            border-right: 0 !important;
        }

        .carnate-sparepart-dashboard .dashboard-subtitle,
        .carnate-sparepart-dashboard .breadcrumb-subtitle {
            margin: 3px 0 0;
            color: var(--carnate-muted);
            font-size: 13px;
        }

        .carnate-sparepart-dashboard .dashboard-breadcrumb {
            display: flex;
            align-items: center;
        }

        .carnate-sparepart-dashboard .breadcrumb {
            margin: 0;
            padding: 0;
            background: transparent;
        }


        .carnate-sparepart-dashboard .breadcrumb-item {
            color: var(--carnate-light);

            font-size: 12px;
        }


        .carnate-sparepart-dashboard .breadcrumb-item a {
            color: var(--carnate-muted);

            text-decoration: none;
        }


        .carnate-sparepart-dashboard .breadcrumb-item a:hover {
            color: var(--carnate-red);
        }


        .carnate-sparepart-dashboard .breadcrumb-item.active {
            color: var(--carnate-muted);
        }


        /* =========================================================
           GENERIC CARD
        ========================================================= */

        .carnate-sparepart-dashboard .dashboard-card {
            height: 100%;

            background: var(--carnate-white);

            border: 1px solid var(--carnate-border);

            border-radius: 14px;

            box-shadow:
                0 4px 16px rgba(15, 23, 42, 0.035);

            overflow: hidden;
        }


        /* =========================================================
           STAT CARDS
        ========================================================= */

        .carnate-sparepart-dashboard .stat-card {
            position: relative;

            height: 100%;

            min-height: 148px;

            padding: 22px;

            background: var(--carnate-white);

            border: 1px solid var(--carnate-border);

            border-radius: 14px;

            box-shadow:
                0 4px 16px rgba(15, 23, 42, 0.035);

            overflow: hidden;

            transition:
                transform .2s ease,
                box-shadow .2s ease,
                border-color .2s ease;
        }


        .carnate-sparepart-dashboard .stat-card:hover {
            transform: translateY(-2px);

            border-color: #d8dee7;

            box-shadow:
                0 10px 28px rgba(15, 23, 42, 0.07);
        }


        .carnate-sparepart-dashboard .stat-card::after {
            content: "";

            position: absolute;

            width: 100px;

            height: 100px;

            right: -45px;

            bottom: -55px;

            border-radius: 50%;

            background: rgba(229, 57, 53, 0.035);

            pointer-events: none;
        }


        .carnate-sparepart-dashboard .stat-top {
            display: flex;

            align-items: flex-start;

            justify-content: space-between;

            gap: 15px;
        }


        .carnate-sparepart-dashboard .stat-content {
            min-width: 0;
        }


        .carnate-sparepart-dashboard .stat-label {
            margin: 0 0 8px;

            color: var(--carnate-muted);

            font-size: 11px;

            font-weight: 700;

            letter-spacing: .7px;

            line-height: 1.3;

            text-transform: uppercase;
        }


        .carnate-sparepart-dashboard .stat-value {
            margin: 0;

            color: var(--carnate-heading);

            font-size: 27px;

            font-weight: 700;

            line-height: 1.2;

            letter-spacing: -0.5px;
        }


        .carnate-sparepart-dashboard .stat-description {
            margin: 8px 0 0;

            color: var(--carnate-light);

            font-size: 12px;

            line-height: 1.4;
        }


        .carnate-sparepart-dashboard .stat-icon {
            position: relative;

            z-index: 2;

            width: 46px;

            height: 46px;

            min-width: 46px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 12px;

            font-size: 21px;
        }


        .carnate-sparepart-dashboard .stat-icon.red {
            background: var(--carnate-red-soft);

            color: var(--carnate-red);
        }


        .carnate-sparepart-dashboard .stat-icon.blue {
            background: #eff6ff;

            color: #2563eb;
        }


        .carnate-sparepart-dashboard .stat-icon.amber {
            background: #fffbeb;

            color: #d97706;
        }


        .carnate-sparepart-dashboard .stat-icon.danger {
            background: #fef2f2;

            color: #dc2626;
        }


        /* =========================================================
           SECTION CARDS
        ========================================================= */

        .carnate-sparepart-dashboard .section-card {
            height: 100%;

            background: var(--carnate-white);

            border: 1px solid var(--carnate-border);

            border-radius: 14px;

            box-shadow:
                0 4px 16px rgba(15, 23, 42, 0.035);

            overflow: hidden;
        }


        .carnate-sparepart-dashboard .section-header {
            min-height: 68px;

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 15px;

            padding: 17px 20px;

            border-bottom: 1px solid var(--carnate-border-light);
        }


        .carnate-sparepart-dashboard .section-title-wrapper {
            display: flex;

            align-items: center;

            gap: 11px;
        }


        .carnate-sparepart-dashboard .section-icon {
            width: 36px;

            height: 36px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 9px;

            background: var(--carnate-red-soft);

            color: var(--carnate-red);

            font-size: 17px;
        }


        .carnate-sparepart-dashboard .section-title {
            margin: 0;

            color: var(--carnate-heading);

            font-size: 15px;

            font-weight: 700;

            line-height: 1.3;
        }


        .carnate-sparepart-dashboard .section-subtitle {
            margin: 3px 0 0;

            color: var(--carnate-light);

            font-size: 11px;
        }


        .carnate-sparepart-dashboard .section-header-icon {
            color: var(--carnate-light);

            font-size: 19px;
        }


        /* =========================================================
           ORDER STATUS
        ========================================================= */

        .carnate-sparepart-dashboard .order-body {
            padding: 20px;
        }


        .carnate-sparepart-dashboard .order-stat {
            height: 100%;

            padding: 18px;

            background: #ffffff;

            border: 1px solid var(--carnate-border);

            border-radius: 11px;

            text-align: center;

            transition:
                border-color .2s ease,
                background .2s ease;
        }


        .carnate-sparepart-dashboard .order-stat:hover {
            border-color: #d5dce6;

            background: #fcfdff;
        }


        .carnate-sparepart-dashboard .order-stat-number {
            margin: 0;

            font-size: 25px;

            font-weight: 700;

            line-height: 1.2;
        }


        .carnate-sparepart-dashboard .order-stat-number.pending {
            color: #2563eb;
        }


        .carnate-sparepart-dashboard .order-stat-number.accepted {
            color: #0284c7;
        }


        .carnate-sparepart-dashboard .order-stat-number.delivered {
            color: #16a34a;
        }


        .carnate-sparepart-dashboard .order-stat-label {
            margin: 7px 0 0;

            color: var(--carnate-muted);

            font-size: 10px;

            font-weight: 700;

            letter-spacing: .4px;

            text-transform: uppercase;
        }


        .carnate-sparepart-dashboard .order-progress {
            height: 5px;

            margin-top: 15px;

            overflow: hidden;

            border-radius: 20px;

            background: #f1f5f9;
        }


        .carnate-sparepart-dashboard .order-progress span {
            display: block;

            width: 100%;

            height: 100%;

            border-radius: inherit;
        }


        .carnate-sparepart-dashboard .order-progress .pending {
            background: #2563eb;
        }


        .carnate-sparepart-dashboard .order-progress .accepted {
            background: #0284c7;
        }


        .carnate-sparepart-dashboard .order-progress .delivered {
            background: #16a34a;
        }


        /* =========================================================
           ORDER BUTTON
        ========================================================= */

        .carnate-sparepart-dashboard .order-management-button {
            width: 100%;

            min-height: 44px;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 7px;

            margin-top: 18px;

            padding: 0 16px;

            border: 1px solid var(--carnate-red);

            border-radius: 9px;

            background: #ffffff;

            color: var(--carnate-red);

            font-size: 13px;

            font-weight: 600;

            text-decoration: none;

            transition: all .2s ease;
        }


        .carnate-sparepart-dashboard .order-management-button:hover {
            background: var(--carnate-red);

            color: #ffffff;

            box-shadow:
                0 6px 16px rgba(229, 57, 53, 0.15);
        }


        /* =========================================================
           INVENTORY INSIGHTS
        ========================================================= */

        .carnate-sparepart-dashboard .inventory-list {
            margin: 0;

            padding: 0 20px;

            list-style: none;
        }


        .carnate-sparepart-dashboard .inventory-item {
            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 15px;

            min-height: 49px;

            border-bottom: 1px solid var(--carnate-border-light);
        }


        .carnate-sparepart-dashboard .inventory-item:last-child {
            border-bottom: 0;
        }


        .carnate-sparepart-dashboard .inventory-name {
            color: #475569;

            font-size: 13px;

            font-weight: 500;
        }


        .carnate-sparepart-dashboard .inventory-badge {
            min-width: 34px;

            padding: 5px 9px;

            border-radius: 7px;

            font-size: 11px;

            font-weight: 700;

            text-align: center;
        }


        .carnate-sparepart-dashboard .inventory-badge.accessory {
            background: #f0fdf4;

            color: #15803d;
        }


        .carnate-sparepart-dashboard .inventory-badge.parts {
            background: #eff6ff;

            color: #2563eb;
        }


        .carnate-sparepart-dashboard .inventory-badge.tools {
            background: #fef2f2;

            color: #dc2626;
        }


        .carnate-sparepart-dashboard .inventory-badge.lubricant {
            background: #fffbeb;

            color: #a16207;
        }


        .carnate-sparepart-dashboard .inventory-badge.category {
            background: var(--carnate-red-soft);

            color: var(--carnate-red);
        }


        /* =========================================================
           TABLE SECTIONS
        ========================================================= */

        .carnate-sparepart-dashboard .table-section {
            height: 100%;

            background: #ffffff;

            border: 1px solid var(--carnate-border);

            border-radius: 14px;

            box-shadow:
                0 4px 16px rgba(15, 23, 42, 0.035);

            overflow: hidden;
        }


        .carnate-sparepart-dashboard .table-responsive {
            overflow-x: auto;

            -webkit-overflow-scrolling: touch;
        }


        .carnate-sparepart-dashboard .dashboard-table {
            width: 100%;

            min-width: 520px;

            margin: 0;

            border-collapse: separate;

            border-spacing: 0;
        }


        .carnate-sparepart-dashboard .dashboard-table thead th {
            padding: 12px 16px;

            background: #f8fafc;

            border: 0;

            border-bottom: 1px solid var(--carnate-border);

            color: #64748b;

            font-size: 10px;

            font-weight: 700;

            letter-spacing: .5px;

            text-transform: uppercase;

            white-space: nowrap;
        }


        .carnate-sparepart-dashboard .dashboard-table tbody td {
            padding: 13px 16px;

            border: 0;

            border-bottom: 1px solid var(--carnate-border-light);

            color: #475569;

            font-size: 12px;

            vertical-align: middle;
        }


        .carnate-sparepart-dashboard .dashboard-table tbody tr {
            transition: background .15s ease;
        }


        .carnate-sparepart-dashboard .dashboard-table tbody tr:hover {
            background: #fafbfc;
        }


        .carnate-sparepart-dashboard .dashboard-table tbody tr:last-child td {
            border-bottom: 0;
        }


        /* =========================================================
           PRODUCT NAME
        ========================================================= */

        .carnate-sparepart-dashboard .product-name {
            color: #334155;

            font-weight: 600;
        }


        .carnate-sparepart-dashboard .part-number {
            display: inline-block;

            padding: 5px 8px;

            border-radius: 6px;

            background: #f1f5f9;

            color: #64748b;

            font-size: 10px;

            font-weight: 600;
        }


        /* =========================================================
           STOCK NUMBER
        ========================================================= */

        .carnate-sparepart-dashboard .stock-critical {
            color: #dc2626;

            font-weight: 700;
        }


        /* =========================================================
           RESTOCK BUTTON
        ========================================================= */

        .carnate-sparepart-dashboard .restock-button {
            min-height: 31px;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            padding: 0 11px;

            border: 1px solid #fecaca;

            border-radius: 7px;

            background: #ffffff;

            color: #dc2626;

            font-size: 11px;

            font-weight: 600;

            text-decoration: none;

            transition: all .2s ease;
        }


        .carnate-sparepart-dashboard .restock-button:hover {
            background: #fef2f2;

            border-color: #dc2626;

            color: #b91c1c;
        }


        /* =========================================================
           SALES BADGE
        ========================================================= */

        .carnate-sparepart-dashboard .sales-badge {
            display: inline-flex;

            align-items: center;

            justify-content: center;

            min-width: 55px;

            padding: 5px 9px;

            border-radius: 7px;

            background: #f0fdf4;

            color: #15803d;

            font-size: 10px;

            font-weight: 700;
        }


        /* =========================================================
           INVENTORY PROGRESS
        ========================================================= */

        .carnate-sparepart-dashboard .inventory-progress {
            width: 100%;

            min-width: 100px;

            height: 5px;

            overflow: hidden;

            border-radius: 20px;

            background: #f1f5f9;
        }


        .carnate-sparepart-dashboard .inventory-progress span {
            display: block;

            width: 80%;

            height: 100%;

            border-radius: inherit;

            background: #16a34a;
        }


        /* =========================================================
           EMPTY STATE
        ========================================================= */

        .carnate-sparepart-dashboard .empty-state {
            padding: 45px 20px;

            text-align: center;
        }


        .carnate-sparepart-dashboard .empty-icon {
            width: 50px;

            height: 50px;

            display: flex;

            align-items: center;

            justify-content: center;

            margin: 0 auto 12px;

            border-radius: 12px;

            background: #f1f5f9;

            color: #94a3b8;

            font-size: 22px;
        }


        .carnate-sparepart-dashboard .empty-title {
            margin: 0 0 4px;

            color: #475569;

            font-size: 13px;

            font-weight: 600;
        }


        .carnate-sparepart-dashboard .empty-text {
            margin: 0;

            color: #94a3b8;

            font-size: 11px;
        }


        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 991px) {

            .carnate-sparepart-dashboard .dashboard-header {
                align-items: flex-start;

                flex-direction: column;
            }

            .carnate-sparepart-dashboard .stat-card {
                min-height: 135px;
            }
        }


        @media (max-width: 575px) {

            .carnate-sparepart-dashboard .dashboard-title,
            .carnate-sparepart-dashboard .breadcrumb-title {
                font-size: 19px;
            }

            .carnate-sparepart-dashboard .stat-card {
                padding: 18px;
            }

            .carnate-sparepart-dashboard .stat-value {
                font-size: 23px;
            }

            .carnate-sparepart-dashboard .section-header {
                padding: 15px;
            }

            .carnate-sparepart-dashboard .order-body {
                padding: 15px;
            }

            .carnate-sparepart-dashboard .order-stat {
                padding: 14px;
            }
        }
    </style>


    {{-- =========================================================
         PAGE HEADER
    ========================================================= --}}

    <div class="dashboard-header">

        <div class="dashboard-title-wrap">

            <div class="dashboard-title-icon">
                <i class="bx bx-grid-alt"></i>
            </div>

            <div>
                <h1 class="dashboard-title">
                    Spare Part Dashboard
                </h1>

                <p class="dashboard-subtitle">
                    Real-time inventory & order insights
                </p>
            </div>

        </div>

        <div class="dashboard-breadcrumb d-none d-sm-block">

            <nav aria-label="breadcrumb">

                <ol class="breadcrumb">

                    <li class="breadcrumb-item">
                        <a href="{{ route('sparepart.dashboard') }}">
                            <i class="bx bx-home-alt"></i>
                        </a>
                    </li>

                    <li class="breadcrumb-item">
                        Spare Part
                    </li>

                    <li class="breadcrumb-item active" aria-current="page">
                        Dashboard
                    </li>

                </ol>

            </nav>

        </div>

    </div>


    {{-- =========================================================
         HIGH IMPACT STATS
    ========================================================= --}}

    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 g-3 mb-4">


        {{-- =====================================================
             TOTAL REVENUE
        ====================================================== --}}

        <div class="col">

            <div class="stat-card">

                <div class="stat-top">

                    <div class="stat-content">

                        <p class="stat-label">
                            Total Revenue
                        </p>

                        <h3 class="stat-value">
                            ₹ {{ number_format($totalRevenue, 2) }}
                        </h3>

                        <p class="stat-description">
                            All-time sales value
                        </p>

                    </div>


                    <div class="stat-icon red">

                        <i class="bx bxs-wallet"></i>

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
             REAL-TIME STOCK
        ====================================================== --}}

        <div class="col">

            <div class="stat-card">

                <div class="stat-top">

                    <div class="stat-content">

                        <p class="stat-label">
                            Real-time Stock
                        </p>

                        <h3 class="stat-value">
                            {{ number_format($totalStockQuantity) }}
                        </h3>

                        <p class="stat-description">
                            Across {{ $stocks }} SKUs
                        </p>

                    </div>


                    <div class="stat-icon blue">

                        <i class="bx bxs-box"></i>

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
             PENDING ORDERS
        ====================================================== --}}

        <div class="col">

            <div class="stat-card">

                <div class="stat-top">

                    <div class="stat-content">

                        <p class="stat-label">
                            Pending Orders
                        </p>

                        <h3 class="stat-value">
                            {{ $orderStats['pending'] }}
                        </h3>

                        <p class="stat-description">
                            Awaiting action
                        </p>

                    </div>


                    <div class="stat-icon amber">

                        <i class="bx bxs-time-five"></i>

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
             CRITICAL ALERTS
        ====================================================== --}}

        <div class="col">

            <div class="stat-card">

                <div class="stat-top">

                    <div class="stat-content">

                        <p class="stat-label">
                            Critical Alerts
                        </p>

                        <h3 class="stat-value">
                            {{ count($lowStockItems) }}
                        </h3>

                        <p class="stat-description">
                            Low stock products
                        </p>

                    </div>


                    <div class="stat-icon danger">

                        <i class="bx bxs-error-circle"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         ORDER MANAGEMENT + INVENTORY INSIGHTS
    ========================================================= --}}

    <div class="row g-3 mb-4">


        {{-- =====================================================
             ORDER MANAGEMENT
        ====================================================== --}}

        <div class="col-12 col-xl-8">

            <div class="section-card">

                <div class="section-header">

                    <div class="section-title-wrapper">

                        <div class="section-icon">

                            <i class="bx bx-cart"></i>

                        </div>

                        <div>

                            <h2 class="section-title">
                                Order Management Hub
                            </h2>

                            <p class="section-subtitle">
                                Monitor current order activity
                            </p>

                        </div>

                    </div>

                </div>


                <div class="order-body">

                    <div class="row row-cols-1 row-cols-sm-3 g-3">


                        {{-- Pending --}}

                        <div class="col">

                            <div class="order-stat">

                                <h3 class="order-stat-number pending">
                                    {{ $orderStats['pending'] }}
                                </h3>

                                <p class="order-stat-label">
                                    Pending
                                </p>

                                <div class="order-progress">

                                    <span class="pending"></span>

                                </div>

                            </div>

                        </div>


                        {{-- Accepted --}}

                        <div class="col">

                            <div class="order-stat">

                                <h3 class="order-stat-number accepted">
                                    {{ $orderStats['accepted'] }}
                                </h3>

                                <p class="order-stat-label">
                                    Accepted
                                </p>

                                <div class="order-progress">

                                    <span class="accepted"></span>

                                </div>

                            </div>

                        </div>


                        {{-- Delivered --}}

                        <div class="col">

                            <div class="order-stat">

                                <h3 class="order-stat-number delivered">
                                    {{ $orderStats['delivered'] }}
                                </h3>

                                <p class="order-stat-label">
                                    Handovered / Delivered
                                </p>

                                <div class="order-progress">

                                    <span class="delivered"></span>

                                </div>

                            </div>

                        </div>

                    </div>


                    <a
                        href="{{ route('sparepart.order') }}"
                        class="order-management-button"
                    >

                        Go to Order Management

                        <i class="bx bx-right-arrow-alt"></i>

                    </a>

                </div>

            </div>

        </div>


        {{-- =====================================================
             INVENTORY INSIGHTS
        ====================================================== --}}

        <div class="col-12 col-xl-4">

            <div class="section-card">

                <div class="section-header">

                    <div class="section-title-wrapper">

                        <div class="section-icon">

                            <i class="bx bx-pie-chart-alt-2"></i>

                        </div>

                        <div>

                            <h2 class="section-title">
                                Inventory Insights
                            </h2>

                            <p class="section-subtitle">
                                Stock by category
                            </p>

                        </div>

                    </div>

                </div>


                <ul class="inventory-list">


                    {{-- Accessories --}}

                    <li class="inventory-item">

                        <span class="inventory-name">
                            Accessories
                        </span>

                        <span class="inventory-badge accessory">
                            {{ $accessory }}
                        </span>

                    </li>


                    {{-- Parts --}}

                    <li class="inventory-item">

                        <span class="inventory-name">
                            Parts
                        </span>

                        <span class="inventory-badge parts">
                            {{ $parts }}
                        </span>

                    </li>


                    {{-- Tools --}}

                    <li class="inventory-item">

                        <span class="inventory-name">
                            Tools
                        </span>

                        <span class="inventory-badge tools">
                            {{ $tools }}
                        </span>

                    </li>


                    {{-- Lubricants --}}

                    <li class="inventory-item">

                        <span class="inventory-name">
                            Lubricants
                        </span>

                        <span class="inventory-badge lubricant">
                            {{ $lubricant }}
                        </span>

                    </li>


                    {{-- Categories --}}

                    <li class="inventory-item">

                        <span class="inventory-name">
                            Categories
                        </span>

                        <span class="inventory-badge category">
                            {{ $category }}
                        </span>

                    </li>


                </ul>

            </div>

        </div>

    </div>


    {{-- =========================================================
         LOW STOCK + TOP SELLING
    ========================================================= --}}

    <div class="row g-3">


        {{-- =====================================================
             LOW STOCK ALERTS
        ====================================================== --}}

        <div class="col-12 col-lg-6">

            <div class="table-section">

                <div class="section-header">

                    <div class="section-title-wrapper">

                        <div class="section-icon">

                            <i class="bx bxs-bell-ring"></i>

                        </div>

                        <div>

                            <h2 class="section-title">
                                Low Stock Alerts
                            </h2>

                            <p class="section-subtitle">
                                Products requiring attention
                            </p>

                        </div>

                    </div>


                    <i class="bx bxs-error-circle section-header-icon"></i>

                </div>


                <div class="table-responsive">

                    <table class="dashboard-table">

                        <thead>

                            <tr>

                                <th>
                                    Part Name
                                </th>

                                <th>
                                    Part No
                                </th>

                                <th>
                                    Stock
                                </th>

                                <th>
                                    Action
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse($lowStockItems as $item)

                                <tr>

                                    <td>

                                        <span class="product-name">
                                            {{ $item->partname }}
                                        </span>

                                    </td>


                                    <td>

                                        <span class="part-number">
                                            {{ $item->part_no }}
                                        </span>

                                    </td>


                                    <td>

                                        <span class="stock-critical">
                                            {{ $item->quantity }}
                                        </span>

                                    </td>


                                    <td>

                                        <a
                                            href="{{ route('sparepart.stock.list') }}"
                                            class="restock-button"
                                        >

                                            Restock

                                        </a>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="4">

                                        <div class="empty-state">

                                            <div class="empty-icon">

                                                <i class="bx bx-check-circle"></i>

                                            </div>

                                            <h3 class="empty-title">
                                                Inventory looks healthy
                                            </h3>

                                            <p class="empty-text">
                                                No low stock items detected.
                                            </p>

                                        </div>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>


        {{-- =====================================================
             TOP SELLING PRODUCTS
        ====================================================== --}}

        <div class="col-12 col-lg-6">

            <div class="table-section">

                <div class="section-header">

                    <div class="section-title-wrapper">

                        <div class="section-icon">

                            <i class="bx bxs-badge-check"></i>

                        </div>

                        <div>

                            <h2 class="section-title">
                                Top Selling Products
                            </h2>

                            <p class="section-subtitle">
                                Products with highest sales
                            </p>

                        </div>

                    </div>


                    <i class="bx bx-trending-up section-header-icon"></i>

                </div>


                <div class="table-responsive">

                    <table class="dashboard-table">

                        <thead>

                            <tr>

                                <th>
                                    Product
                                </th>

                                <th>
                                    Sold Qty
                                </th>

                                <th>
                                    Inventory Plan
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse($topSellingProducts as $product)

                                <tr>

                                    <td>

                                        <span class="product-name">

                                            {{ @$product->SpareParts->name ?? 'N/A' }}

                                        </span>

                                    </td>


                                    <td>

                                        <span class="sales-badge">

                                            {{ $product->total_sold }}

                                        </span>

                                    </td>


                                    <td>

                                        <div class="inventory-progress">

                                            <span></span>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="3">

                                        <div class="empty-state">

                                            <div class="empty-icon">

                                                <i class="bx bx-bar-chart-alt-2"></i>

                                            </div>

                                            <h3 class="empty-title">
                                                No sales data available
                                            </h3>

                                            <p class="empty-text">
                                                Sales insights will appear here.
                                            </p>

                                        </div>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>