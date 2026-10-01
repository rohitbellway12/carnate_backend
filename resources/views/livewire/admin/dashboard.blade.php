<div class="carnate-dashboard">

    {{-- =====================================================
        PAGE HEADER
    ====================================================== --}}
    <div class="carnate-page-header">

        <div>
            <div class="carnate-breadcrumb">

                <span class="breadcrumb-current">
                    Admin
                </span>

                <span class="breadcrumb-divider">
                    /
                </span>

                <span class="breadcrumb-muted">
                    Dashboard
                </span>

            </div>

            <h1 class="carnate-page-title">
                Dashboard
            </h1>

            <p class="carnate-page-subtitle">
                Here's what's happening across your workshop platform.
            </p>
        </div>

        <div class="dashboard-date">

            <div class="dashboard-date-icon">
                <i class='bx bx-calendar'></i>
            </div>

            <div>
                <span class="date-label">
                    TODAY
                </span>

                <strong>
                    {{ now()->format('d M Y') }}
                </strong>
            </div>

        </div>

    </div>


    {{-- =====================================================
        MAIN STATISTICS
    ====================================================== --}}
    <div class="carnate-stats-grid">


        {{-- SUB ADMINS --}}
        <div class="carnate-stat-card">

            <div class="stat-card-top">

                <div class="stat-label">
                    TOTAL SUB ADMINS
                </div>

                <div class="stat-icon stat-icon-neutral">
                    <i class='bx bxs-user-account'></i>
                </div>

            </div>

            <div class="stat-value">
                {{ $subadmin }}
            </div>

            <div class="stat-footer">

                <span class="stat-status-dot"></span>

                <span>
                    Active sub-admin accounts
                </span>

            </div>

        </div>


        {{-- WORKSHOPS --}}
        <div class="carnate-stat-card">

            <div class="stat-card-top">

                <div class="stat-label">
                    WORKSHOPS
                </div>

                <div class="stat-icon stat-icon-blue">
                    <i class='bx bxs-wrench'></i>
                </div>

            </div>

            <div class="stat-value">
                {{ $workshop }}
            </div>

            <div class="stat-footer">

                <span class="stat-status-dot blue"></span>

                <span>
                    Registered workshops
                </span>

            </div>

        </div>


        {{-- SPARE PART VENDORS --}}
        <div class="carnate-stat-card">

            <div class="stat-card-top">

                <div class="stat-label">
                    SPARE PART VENDORS
                </div>

                <div class="stat-icon stat-icon-orange">
                    <i class='bx bx-package'></i>
                </div>

            </div>

            <div class="stat-value">
                {{ $sparepart }}
            </div>

            <div class="stat-footer">

                <span class="stat-status-dot orange"></span>

                <span>
                    Spare part suppliers
                </span>

            </div>

        </div>


        {{-- TOTAL PAYMENTS --}}
        <div class="carnate-stat-card">

            <div class="stat-card-top">

                <div class="stat-label">
                    TOTAL PAYMENTS
                </div>

                <div class="stat-icon stat-icon-green">
                    <i class='bx bx-wallet'></i>
                </div>

            </div>

            <div class="stat-value">
                {{ $totalPayments }}
            </div>

            <div class="stat-footer">

                <span class="stat-status-dot green"></span>

                <span>
                    Payment transactions
                </span>

            </div>

        </div>


        {{-- TOTAL PAYMENT AMOUNT --}}
        <div class="carnate-stat-card stat-card-primary">

            <div class="stat-card-top">

                <div class="stat-label">
                    TOTAL PAYMENT AMOUNT
                </div>

                <div class="stat-icon stat-icon-red">
                    <i class='bx bx-rupee'></i>
                </div>

            </div>

            <div class="stat-value">
                ₹{{ number_format($totalPaymentAmount, 2) }}
            </div>

            <div class="stat-footer">

                <span class="stat-status-dot red"></span>

                <span>
                    All-time collected
                </span>

            </div>

        </div>

    </div>


    {{-- =====================================================
        MAIN DASHBOARD ROW
    ====================================================== --}}
    <div class="dashboard-main-grid">


        {{-- =================================================
            ORDER OVERVIEW
        ================================================== --}}
        <div class="dashboard-panel order-overview-panel">

            <div class="panel-header">

                <div>

                    <span class="panel-eyebrow">
                        OPERATIONS
                    </span>

                    <h2>
                        Order Management
                    </h2>

                    <p>
                        Monitor your current order activity.
                    </p>

                </div>

                <div class="panel-header-icon">
                    <i class='bx bx-shopping-bag'></i>
                </div>

            </div>


            <div class="order-metrics">


                {{-- Pending --}}
                <div class="order-metric">

                    <div class="metric-top">

                        <span class="metric-icon pending">
                            <i class='bx bx-time-five'></i>
                        </span>

                        <span class="metric-status">
                            Pending
                        </span>

                    </div>

                    <strong>
                        {{ $orderStats['pending'] }}
                    </strong>

                    <span>
                        Pending Orders
                    </span>

                    <div class="metric-line pending-line"></div>

                </div>


                {{-- Confirmed --}}
                <div class="order-metric">

                    <div class="metric-top">

                        <span class="metric-icon confirmed">
                            <i class='bx bx-check'></i>
                        </span>

                        <span class="metric-status">
                            Confirmed
                        </span>

                    </div>

                    <strong>
                        {{ $orderStats['confirmed'] }}
                    </strong>

                    <span>
                        Confirmed Orders
                    </span>

                    <div class="metric-line confirmed-line"></div>

                </div>


                {{-- Total --}}
                <div class="order-metric">

                    <div class="metric-top">

                        <span class="metric-icon total">
                            <i class='bx bx-bar-chart-alt-2'></i>
                        </span>

                        <span class="metric-status">
                            Overall
                        </span>

                    </div>

                    <strong>
                        {{ $orderStats['total'] }}
                    </strong>

                    <span>
                        Total Orders
                    </span>

                    <div class="metric-line total-line"></div>

                </div>

            </div>


            <div class="panel-action">

                <a
                    href="{{ route('admin.order-list') }}"
                    class="carnate-outline-button">

                    <span>
                        View all orders
                    </span>

                    <i class='bx bx-right-arrow-alt'></i>

                </a>

            </div>

        </div>


        {{-- =================================================
            SYSTEM STATISTICS
        ================================================== --}}
        <div class="dashboard-panel system-panel">

            <div class="panel-header compact">

                <div>

                    <span class="panel-eyebrow">
                        OVERVIEW
                    </span>

                    <h2>
                        System Statistics
                    </h2>

                </div>

                <div class="panel-header-icon">
                    <i class='bx bx-pie-chart-alt-2'></i>
                </div>

            </div>


            <div class="system-stat-list">


                <div class="system-stat-row">

                    <div class="system-stat-name">

                        <span class="system-icon customer">
                            <i class='bx bx-user'></i>
                        </span>

                        <span>
                            Total Customers
                        </span>

                    </div>

                    <strong>
                        {{ $totalCustomers }}
                    </strong>

                </div>


                <div class="system-stat-row">

                    <div class="system-stat-name">

                        <span class="system-icon vehicle">
                            <i class='bx bx-car'></i>
                        </span>

                        <span>
                            Total Vehicles
                        </span>

                    </div>

                    <strong>
                        {{ $totalVehicles }}
                    </strong>

                </div>


                <div class="system-stat-row">

                    <div class="system-stat-name">

                        <span class="system-icon users">
                            <i class='bx bx-group'></i>
                        </span>

                        <span>
                            Total Users
                        </span>

                    </div>

                    <strong>
                        {{ $totalUsers }}
                    </strong>

                </div>


                <div class="system-stat-row">

                    <div class="system-stat-name">

                        <span class="system-icon orders">
                            <i class='bx bx-shopping-bag'></i>
                        </span>

                        <span>
                            Total Orders
                        </span>

                    </div>

                    <strong>
                        {{ $totalOrders }}
                    </strong>

                </div>


                <div class="system-stat-row">

                    <div class="system-stat-name">

                        <span class="system-icon jobs">
                            <i class='bx bx-wrench'></i>
                        </span>

                        <span>
                            Total Job Cards
                        </span>

                    </div>

                    <strong>
                        {{ $totalJobCards }}
                    </strong>

                </div>

            </div>

        </div>

    </div>


    {{-- =====================================================
        RECENT DATA
    ====================================================== --}}
    <div class="recent-data-grid">


        {{-- =================================================
            RECENT JOB CARDS
        ================================================== --}}
        <div class="dashboard-panel table-panel">

            <div class="panel-header">

                <div>

                    <span class="panel-eyebrow">
                        WORKSHOP
                    </span>

                    <h2>
                        Recent Job Cards
                    </h2>

                    <p>
                        Latest workshop service activity.
                    </p>

                </div>

                <div class="panel-header-icon red">
                    <i class='bx bxs-wrench'></i>
                </div>

            </div>


            <div class="carnate-table-wrapper">

                <table class="carnate-table">

                    <thead>

                        <tr>

                            <th>
                                JOB CARD
                            </th>

                            <th>
                                CUSTOMER
                            </th>

                            <th>
                                VEHICLE
                            </th>

                            <th>
                                STATUS
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($recentJobCards as $jobcard)

                        <tr>

                            <td>

                                <span class="job-card-number">
                                    {{ $jobcard->jobcard_number }}
                                </span>

                            </td>

                            <td>

                                <div class="table-person">

                                    <span class="person-avatar">
                                        {{ strtoupper(substr($jobcard->customer?->name ?? 'N', 0, 1)) }}
                                    </span>

                                    <span>
                                        {{ $jobcard->customer?->name ?? 'N/A' }}
                                    </span>

                                </div>

                            </td>

                            <td>
                                {{ $jobcard->vehicle?->modelname ?? 'N/A' }}
                            </td>

                            <td>

                                @if($jobcard->status == 0)

                                    <span class="carnate-status status-pending">
                                        <span></span>
                                        Pending
                                    </span>

                                @elseif($jobcard->status == 1)

                                    <span class="carnate-status status-progress">
                                        <span></span>
                                        In Progress
                                    </span>

                                @elseif($jobcard->status == 2)

                                    <span class="carnate-status status-completed">
                                        <span></span>
                                        Completed
                                    </span>

                                @else

                                    <span class="carnate-status status-unknown">
                                        <span></span>
                                        Unknown
                                    </span>

                                @endif

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td
                                colspan="4"
                                class="empty-table">

                                <div class="empty-state">

                                    <i class='bx bx-folder-open'></i>

                                    <span>
                                        No job cards found
                                    </span>

                                </div>

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        {{-- =================================================
            RECENT ORDERS
        ================================================== --}}
        <div class="dashboard-panel table-panel">

            <div class="panel-header">

                <div>

                    <span class="panel-eyebrow">
                        ORDERS
                    </span>

                    <h2>
                        Recent Orders
                    </h2>

                    <p>
                        Latest spare parts transactions.
                    </p>

                </div>

                <div class="panel-header-icon green">
                    <i class='bx bxs-shopping-bag'></i>
                </div>

            </div>


            <div class="carnate-table-wrapper">

                <table class="carnate-table">

                    <thead>

                        <tr>

                            <th>
                                ORDER
                            </th>

                            <th>
                                CUSTOMER
                            </th>

                            <th>
                                AMOUNT
                            </th>

                            <th>
                                STATUS
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @php
                            $orders = \App\Models\Order::with(['workShopVendor', 'sparePartVendor'])
                                ->orderBy('id', 'DESC')
                                ->limit(5)
                                ->get();
                        @endphp


                        @forelse($orders as $order)

                        <tr>

                            <td>

                                <span class="order-number">
                                    #{{ $order->id }}
                                </span>

                            </td>

                            <td>

                                <div class="table-person">

                                    <span class="person-avatar order-avatar">
                                        {{ strtoupper(substr($order->workShopVendor?->name ?? $order->sparePartVendor?->name ?? 'N', 0, 1)) }}
                                    </span>

                                    <span>
                                        {{ $order->workShopVendor?->name ?? $order->sparePartVendor?->name ?? 'N/A' }}
                                    </span>

                                </div>

                            </td>

                            <td>

                                <strong class="table-amount">
                                    ₹{{ number_format($order->orderItem->sum('price') * $order->orderItem->sum('quantity'), 2) }}
                                </strong>

                            </td>

                            <td>

                                @if($order->is_confim == 0)

                                    <span class="carnate-status status-pending">
                                        <span></span>
                                        Pending
                                    </span>

                                @else

                                    <span class="carnate-status status-completed">
                                        <span></span>
                                        Confirmed
                                    </span>

                                @endif

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td
                                colspan="4"
                                class="empty-table">

                                <div class="empty-state">

                                    <i class='bx bx-shopping-bag'></i>

                                    <span>
                                        No orders found
                                    </span>

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


@section('style')

<style>

/* =========================================================
   CARNATE DASHBOARD
   Premium SaaS Dashboard UI
========================================================= */

:root {

    --carnate-black: #0b1117;
    --carnate-dark: #111820;

    --carnate-red: #e53935;
    --carnate-red-dark: #c92f2c;
    --carnate-red-soft: rgba(229, 57, 53, 0.08);

    --carnate-bg: #f7f8fa;

    --carnate-white: #ffffff;

    --carnate-text: #111827;
    --carnate-text-secondary: #64748b;
    --carnate-text-muted: #94a3b8;

    --carnate-border: #e2e8f0;

    --carnate-blue: #3b82f6;
    --carnate-green: #16a34a;
    --carnate-orange: #f59e0b;

    --dashboard-radius: 16px;
}


/* =========================================================
   DASHBOARD WRAPPER
========================================================= */

.carnate-dashboard {

    min-height: 100vh;

    padding:
        36px 36px 55px;

    background:
        #f7f8fa;

    color: var(--carnate-text);

    font-family:
        'Inter',
        'Poppins',
        -apple-system,
        BlinkMacSystemFont,
        "Segoe UI",
        sans-serif;
}


/* =========================================================
   PAGE HEADER
========================================================= */

.carnate-page-header {

    display: flex;

    align-items: flex-end;

    justify-content: space-between;

    gap: 30px;

    margin-bottom: 32px;
}

.carnate-breadcrumb {

    display: flex;

    align-items: center;

    gap: 10px;

    margin-bottom: 10px;

    font-size: 13px;

    font-weight: 500;
}

.breadcrumb-current {
    color: var(--carnate-text);
}

.breadcrumb-divider {
    color: #cbd5e1;
}

.breadcrumb-muted {
    color: var(--carnate-text-muted);
}

.carnate-page-title {

    margin: 0;

    font-size: 34px;

    line-height: 1.2;

    font-weight: 750;

    letter-spacing: -0.035em;

    color: var(--carnate-text);
}

.carnate-page-subtitle {

    margin:
        8px 0 0;

    color: var(--carnate-text-secondary);

    font-size: 15px;

    line-height: 1.6;
}


/* =========================================================
   DATE
========================================================= */

.dashboard-date {

    display: flex;

    align-items: center;

    gap: 12px;

    padding:
        11px 16px;

    border:
        1px solid var(--carnate-border);

    border-radius: 12px;

    background: var(--carnate-white);
}

.dashboard-date-icon {

    width: 38px;
    height: 38px;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 10px;

    background: var(--carnate-red-soft);

    color: var(--carnate-red);

    font-size: 19px;
}

.dashboard-date .date-label {

    display: block;

    margin-bottom: 3px;

    color: var(--carnate-text-muted);

    font-size: 10px;

    font-weight: 700;

    letter-spacing: 0.12em;
}

.dashboard-date strong {

    display: block;

    color: var(--carnate-text);

    font-size: 14px;

    font-weight: 650;
}


/* =========================================================
   STATISTICS
========================================================= */

.carnate-stats-grid {

    display: grid;

    grid-template-columns:
        repeat(5, minmax(0, 1fr));

    gap: 18px;

    margin-bottom: 22px;
}

.carnate-stat-card {

    position: relative;

    padding: 22px;

    min-height: 170px;

    background: #ffffff;

    border:
        1px solid var(--carnate-border);

    border-radius:
        var(--dashboard-radius);

    overflow: hidden;

    transition:
        transform 0.2s ease,
        box-shadow 0.2s ease,
        border-color 0.2s ease;
}

.carnate-stat-card::after {

    content: "";

    position: absolute;

    width: 110px;
    height: 110px;

    right: -48px;
    bottom: -60px;

    border-radius: 50%;

    background:
        rgba(15,23,42,0.025);

    pointer-events: none;
}

.carnate-stat-card:hover {

    transform: translateY(-2px);

    border-color: #d7dee7;

    box-shadow:
        0 12px 30px rgba(15,23,42,0.06);
}

.stat-card-primary {

    border-color:
        rgba(229,57,53,0.20);

    background:
        linear-gradient(
            145deg,
            #ffffff,
            #fffafa
        );
}

.stat-card-top {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 15px;
}

.stat-label {

    color: var(--carnate-text-muted);

    font-size: 11px;

    font-weight: 750;

    line-height: 1.4;

    letter-spacing: 0.08em;
}

.stat-icon {

    width: 44px;
    height: 44px;

    flex: 0 0 44px;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 11px;

    font-size: 20px;
}

.stat-icon-neutral {

    color: #475569;

    background: #f1f5f9;
}

.stat-icon-blue {

    color: var(--carnate-blue);

    background:
        rgba(59,130,246,0.09);
}

.stat-icon-orange {

    color: var(--carnate-orange);

    background:
        rgba(245,158,11,0.10);
}

.stat-icon-green {

    color: var(--carnate-green);

    background:
        rgba(22,163,74,0.09);
}

.stat-icon-red {

    color: var(--carnate-red);

    background:
        var(--carnate-red-soft);
}

.stat-value {

    position: relative;

    z-index: 2;

    margin-top: 24px;

    color: var(--carnate-text);

    font-size: 32px;

    line-height: 1;

    font-weight: 750;

    letter-spacing: -0.035em;

    white-space: nowrap;

    overflow: hidden;

    text-overflow: ellipsis;
}

.stat-footer {

    display: flex;

    align-items: center;

    gap: 8px;

    margin-top: 14px;

    color: var(--carnate-text-muted);

    font-size: 12px;

    line-height: 1.4;
}

.stat-status-dot {

    width: 7px;
    height: 7px;

    flex: 0 0 7px;

    border-radius: 50%;

    background: #64748b;
}

.stat-status-dot.blue {
    background: var(--carnate-blue);
}

.stat-status-dot.orange {
    background: var(--carnate-orange);
}

.stat-status-dot.green {
    background: var(--carnate-green);
}

.stat-status-dot.red {
    background: var(--carnate-red);
}


/* =========================================================
   MAIN GRID
========================================================= */

.dashboard-main-grid {

    display: grid;

    grid-template-columns:
        minmax(0, 1.65fr)
        minmax(300px, 0.85fr);

    gap: 22px;

    margin-bottom: 22px;
}


/* =========================================================
   PANEL
========================================================= */

.dashboard-panel {

    background:
        var(--carnate-white);

    border:
        1px solid var(--carnate-border);

    border-radius:
        var(--dashboard-radius);

    box-shadow:
        0 2px 7px rgba(15,23,42,0.025);

    overflow: hidden;
}

.panel-header {

    display: flex;

    align-items: flex-start;

    justify-content: space-between;

    gap: 20px;

    padding: 24px 24px 20px;
}

.panel-header.compact {
    padding-bottom: 17px;
}

.panel-eyebrow {

    display: block;

    margin-bottom: 6px;

    color: var(--carnate-red);

    font-size: 10px;

    font-weight: 750;

    letter-spacing: 0.14em;
}

.panel-header h2 {

    margin: 0;

    color: var(--carnate-text);

    font-size: 20px;

    line-height: 1.35;

    font-weight: 700;

    letter-spacing: -0.02em;
}

.panel-header p {

    margin:
        6px 0 0;

    color: var(--carnate-text-muted);

    font-size: 13px;

    line-height: 1.5;
}

.panel-header-icon {

    width: 42px;
    height: 42px;

    flex: 0 0 42px;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 11px;

    color: #475569;

    background: #f1f5f9;

    font-size: 19px;
}

.panel-header-icon.red {

    color: var(--carnate-red);

    background:
        var(--carnate-red-soft);
}

.panel-header-icon.green {

    color: var(--carnate-green);

    background:
        rgba(22,163,74,0.08);
}


/* =========================================================
   ORDER METRICS
========================================================= */

.order-metrics {

    display: grid;

    grid-template-columns:
        repeat(3, 1fr);

    gap: 14px;

    padding:
        0 24px;
}

.order-metric {

    position: relative;

    padding: 20px;

    border:
        1px solid var(--carnate-border);

    border-radius: 13px;

    overflow: hidden;

    background: #ffffff;
}

.metric-top {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 10px;
}

.metric-icon {

    width: 34px;
    height: 34px;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 9px;

    font-size: 17px;
}

.metric-icon.pending {

    color: var(--carnate-orange);

    background:
        rgba(245,158,11,0.09);
}

.metric-icon.confirmed {

    color: var(--carnate-green);

    background:
        rgba(22,163,74,0.09);
}

.metric-icon.total {

    color: var(--carnate-blue);

    background:
        rgba(59,130,246,0.09);
}

.metric-status {

    color: var(--carnate-text-muted);

    font-size: 11px;

    font-weight: 500;
}

.order-metric strong {

    display: block;

    margin-top: 18px;

    color: var(--carnate-text);

    font-size: 32px;

    line-height: 1;

    font-weight: 750;
}

.order-metric > span:not(.metric-status) {

    display: block;

    margin-top: 8px;

    color: var(--carnate-text-secondary);

    font-size: 12px;

    line-height: 1.4;
}

.metric-line {

    height: 4px;

    width: 100%;

    margin-top: 18px;

    border-radius: 10px;
}

.pending-line {
    background: var(--carnate-orange);
}

.confirmed-line {
    background: var(--carnate-green);
}

.total-line {
    background: var(--carnate-blue);
}


/* =========================================================
   ACTION
========================================================= */

.panel-action {

    padding:
        20px 24px 24px;
}

.carnate-outline-button {

    width: 100%;

    min-height: 46px;

    display: flex;

    align-items: center;

    justify-content: center;

    gap: 9px;

    border:
        1px solid var(--carnate-border);

    border-radius: 10px;

    background: #ffffff;

    color: var(--carnate-text-secondary);

    font-size: 13px;

    font-weight: 600;

    text-decoration: none;

    transition:
        background 0.2s ease,
        border-color 0.2s ease,
        color 0.2s ease;
}

.carnate-outline-button:hover {

    border-color:
        rgba(229,57,53,0.30);

    color:
        var(--carnate-red);

    background:
        var(--carnate-red-soft);

    text-decoration: none;
}

.carnate-outline-button i {
    font-size: 19px;
}


/* =========================================================
   SYSTEM STATISTICS
========================================================= */

.system-stat-list {

    padding:
        0 24px 20px;
}

.system-stat-row {

    min-height: 55px;

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 15px;

    border-bottom:
        1px solid #edf1f5;
}

.system-stat-row:last-child {
    border-bottom: 0;
}

.system-stat-name {

    display: flex;

    align-items: center;

    gap: 11px;

    color: var(--carnate-text-secondary);

    font-size: 13px;

    font-weight: 500;
}

.system-icon {

    width: 32px;
    height: 32px;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 8px;

    font-size: 15px;
}

.system-icon.customer {

    color: var(--carnate-blue);

    background:
        rgba(59,130,246,0.08);
}

.system-icon.vehicle {

    color: #06b6d4;

    background:
        rgba(6,182,212,0.08);
}

.system-icon.users {

    color: var(--carnate-green);

    background:
        rgba(22,163,74,0.08);
}

.system-icon.orders {

    color: var(--carnate-orange);

    background:
        rgba(245,158,11,0.08);
}

.system-icon.jobs {

    color: var(--carnate-red);

    background:
        var(--carnate-red-soft);
}

.system-stat-row strong {

    min-width: 32px;

    text-align: right;

    color: var(--carnate-text);

    font-size: 15px;

    font-weight: 700;
}


/* =========================================================
   RECENT DATA
========================================================= */

.recent-data-grid {

    display: grid;

    grid-template-columns:
        repeat(2, minmax(0, 1fr));

    gap: 22px;
}


/* =========================================================
   TABLE
========================================================= */

.carnate-table-wrapper {

    width: 100%;

    overflow-x: auto;
}

.carnate-table {

    width: 100%;

    min-width: 650px;

    border-collapse: collapse;
}

.carnate-table thead {

    background:
        #f8fafc;
}

.carnate-table th {

    padding:
        14px 18px;

    text-align: left;

    border-top:
        1px solid #edf1f5;

    border-bottom:
        1px solid #edf1f5;

    color:
        #94a3b8;

    font-size: 10px;

    font-weight: 750;

    letter-spacing: 0.09em;

    white-space: nowrap;
}

.carnate-table td {

    padding:
        14px 18px;

    border-bottom:
        1px solid #edf1f5;

    color:
        #475569;

    font-size: 13px;

    line-height: 1.5;

    white-space: nowrap;
}

.carnate-table tbody tr {

    transition:
        background 0.15s ease;
}

.carnate-table tbody tr:hover {

    background:
        #fafbfc;
}

.carnate-table tbody tr:last-child td {
    border-bottom: 0;
}


/* =========================================================
   JOB / ORDER NUMBER
========================================================= */

.job-card-number,
.order-number {

    display: inline-flex;

    align-items: center;

    padding:
        6px 10px;

    border-radius: 7px;

    color: var(--carnate-blue);

    background:
        rgba(59,130,246,0.07);

    font-size: 11px;

    font-weight: 650;

    letter-spacing: 0.01em;
}

.order-number {

    color:
        var(--carnate-text);

    background:
        #f1f5f9;
}


/* =========================================================
   PERSON
========================================================= */

.table-person {

    display: flex;

    align-items: center;

    gap: 9px;

    font-size: 13px;

    font-weight: 500;
}

.person-avatar {

    width: 32px;
    height: 32px;

    display: flex;

    align-items: center;
    justify-content: center;

    flex: 0 0 32px;

    border-radius: 8px;

    color: #475569;

    background:
        #eef2f6;

    font-size: 11px;

    font-weight: 700;
}

.order-avatar {

    color:
        var(--carnate-red);

    background:
        var(--carnate-red-soft);
}


/* =========================================================
   AMOUNT
========================================================= */

.table-amount {

    color:
        var(--carnate-text);

    font-size: 13px;

    font-weight: 650;
}


/* =========================================================
   STATUS
========================================================= */

.carnate-status {

    display: inline-flex;

    align-items: center;

    gap: 7px;

    padding:
        7px 10px;

    border-radius: 7px;

    font-size: 10px;

    font-weight: 650;

    line-height: 1;
}

.carnate-status > span {

    width: 6px;
    height: 6px;

    border-radius: 50%;

    background: currentColor;
}

.status-pending {

    color: #b45309;

    background:
        rgba(245,158,11,0.10);
}

.status-progress {

    color: #2563eb;

    background:
        rgba(59,130,246,0.09);
}

.status-completed {

    color: #15803d;

    background:
        rgba(22,163,74,0.09);
}

.status-unknown {

    color: #64748b;

    background:
        #f1f5f9;
}


/* =========================================================
   EMPTY
========================================================= */

.empty-table {
    padding: 35px !important;
}

.empty-state {

    display: flex;

    align-items: center;
    justify-content: center;

    gap: 9px;

    color: var(--carnate-text-muted);

    font-size: 13px;
}

.empty-state i {
    font-size: 20px;
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 1400px) {

    .carnate-stats-grid {

        grid-template-columns:
            repeat(3, minmax(0, 1fr));
    }

}


@media (max-width: 1100px) {

    .dashboard-main-grid {

        grid-template-columns:
            1fr;
    }

    .recent-data-grid {

        grid-template-columns:
            1fr;
    }

}


@media (max-width: 768px) {

    .carnate-dashboard {

        padding:
            24px 18px 40px;
    }

    .carnate-page-header {

        align-items: flex-start;

        flex-direction: column;

        margin-bottom: 26px;
    }

    .carnate-page-title {

        font-size: 30px;
    }

    .carnate-page-subtitle {

        font-size: 14px;
    }

    .dashboard-date {

        width: 100%;
    }

    .carnate-stats-grid {

        grid-template-columns:
            repeat(2, minmax(0, 1fr));

        gap: 12px;
    }

    .carnate-stat-card {

        min-height: 155px;

        padding: 18px;
    }

    .stat-value {

        font-size: 28px;
    }

    .stat-footer {

        font-size: 11px;
    }

    .order-metrics {

        grid-template-columns:
            1fr;
    }

}


@media (max-width: 560px) {

    .carnate-stats-grid {

        grid-template-columns:
            1fr;
    }

    .recent-data-grid {

        grid-template-columns:
            1fr;
    }

}


@media (max-width: 480px) {

    .carnate-dashboard {

        padding:
            20px 14px 30px;
    }

    .carnate-page-title {

        font-size: 27px;
    }

    .carnate-page-subtitle {

        font-size: 13px;
    }

    .carnate-breadcrumb {

        font-size: 12px;
    }

    .carnate-stat-card {

        min-height: auto;

        padding: 18px;
    }

    .stat-value {

        font-size: 28px;
    }

    .panel-header {

        padding:
            20px 18px 17px;
    }

    .panel-header h2 {

        font-size: 18px;
    }

    .panel-header p {

        font-size: 12px;
    }

    .order-metrics {

        padding:
            0 18px;
    }

    .panel-action {

        padding:
            18px;
    }

    .system-stat-list {

        padding:
            0 18px 16px;
    }

    .carnate-table th {

        padding:
            12px 14px;

        font-size: 9px;
    }

    .carnate-table td {

        padding:
            13px 14px;

        font-size: 12px;
    }

}


/* =========================================================
   REDUCED MOTION
========================================================= */

@media (prefers-reduced-motion: reduce) {

    *,
    *::before,
    *::after {

        transition:
            none !important;
    }

}

</style>

@endsection