<div wire:poll.10s="refreshMetrics" class="carnate-workshop-dashboard">

    <style>
        .carnate-workshop-dashboard {
            --dash-bg: #f7f8fa;
            --dash-card: #ffffff;
            --dash-text: #111827;
            --dash-muted: #64748b;
            --dash-border: #e2e8f0;
            --dash-red: #e53935;
            --dash-red-dark: #c92f2c;
            --dash-red-soft: #fff5f5;
            --dash-green: #16a34a;
            --dash-green-soft: #f0fdf4;
            --dash-blue: #2563eb;
            --dash-blue-soft: #eff6ff;
            --dash-orange: #d97706;
            --dash-orange-soft: #fffbeb;
            --dash-icon: #f1f5f9;
            --dash-shadow: 0 6px 22px rgba(15, 23, 42, .055);
        }

        /* Tabs */
        .carnate-workshop-dashboard .dashboard-tabs {
            display: flex;
            align-items: center;
            gap: 6px;
            margin: 18px 0;
            padding: 4px;
            border: 1px solid var(--dash-border) !important;
            border-bottom: 1px solid var(--dash-border) !important;
            border-radius: 11px;
            background: #fff;
            width: fit-content;
            box-shadow: 0 2px 8px rgba(15, 23, 42, .03);
        }

        .carnate-workshop-dashboard .dashboard-tab {
            border: 0 !important;
            border-radius: 8px !important;
            padding: 9px 14px !important;
            background: transparent !important;
            color: var(--dash-muted) !important;
            font-size: 12px !important;
            font-weight: 700 !important;
            line-height: 1.2;
            outline: none !important;
            box-shadow: none !important;
            transition: .2s ease;
        }

        .carnate-workshop-dashboard .dashboard-tab i {
            font-size: 15px;
            vertical-align: -2px;
        }

        .carnate-workshop-dashboard .dashboard-tab:hover {
            color: var(--dash-text) !important;
            background: #f8fafc !important;
            border: 0 !important;
            outline: none !important;
            box-shadow: none !important;
        }

        .carnate-workshop-dashboard .dashboard-tab:focus,
        .carnate-workshop-dashboard .dashboard-tab:focus-visible,
        .carnate-workshop-dashboard .dashboard-tab:active,
        .carnate-workshop-dashboard .nav-tabs .nav-link:focus,
        .carnate-workshop-dashboard .nav-tabs .nav-link:focus-visible,
        .carnate-workshop-dashboard .nav-tabs .nav-link:active {
            outline: none !important;
            border: 0 !important;
            box-shadow: none !important;
        }

        .carnate-workshop-dashboard .dashboard-tab.active {
            background: var(--dash-red) !important;
            color: #fff !important;
            box-shadow: 0 3px 10px rgba(229, 57, 53, .18) !important;
            border: 0 !important;
            outline: none !important;
        }

        .carnate-workshop-dashboard .dashboard-tab.active:focus,
        .carnate-workshop-dashboard .dashboard-tab.active:focus-visible,
        .carnate-workshop-dashboard .dashboard-tab.active:active {
            outline: none !important;
            border: 0 !important;
            box-shadow: 0 3px 10px rgba(229, 57, 53, .22) !important;
        }

        .carnate-workshop-dashboard button:focus,
        .carnate-workshop-dashboard button:focus-visible,
        .carnate-workshop-dashboard .btn:focus,
        .carnate-workshop-dashboard .btn:focus-visible {
            outline: none !important;
            box-shadow: none !important;
        }

        /* Section heading */
        .carnate-workshop-dashboard .dashboard-section-heading {
            margin: 20px 0 10px;
            color: var(--dash-text);
            font-size: 13px;
            font-weight: 700;
        }

        /* Metric cards */
        .carnate-workshop-dashboard .metric-card {
            height: 100%;
            background: var(--dash-card);
            border: 1px solid var(--dash-border);
            border-radius: 13px;
            box-shadow: var(--dash-shadow);
            overflow: hidden;
            transition: .2s ease;
        }

        .carnate-workshop-dashboard .metric-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 28px rgba(15, 23, 42, .08);
        }

        .carnate-workshop-dashboard .metric-body {
            min-height: 76px;
            padding: 14px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .carnate-workshop-dashboard .metric-label {
            margin: 0 0 4px;
            color: var(--dash-muted);
            font-size: 11px;
            font-weight: 600;
        }

        .carnate-workshop-dashboard .metric-value {
            color: var(--dash-text);
            font-size: 19px;
            line-height: 1;
            font-weight: 800;
        }

        .carnate-workshop-dashboard .metric-icon {
            width: 38px;
            height: 38px;
            min-width: 38px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .carnate-workshop-dashboard .metric-icon.red {
            background: var(--dash-red-soft);
            color: var(--dash-red);
        }

        .carnate-workshop-dashboard .metric-icon.green {
            background: var(--dash-green-soft);
            color: var(--dash-green);
        }

        .carnate-workshop-dashboard .metric-icon.blue {
            background: var(--dash-blue-soft);
            color: var(--dash-blue);
        }

        .carnate-workshop-dashboard .metric-icon.orange {
            background: var(--dash-orange-soft);
            color: var(--dash-orange);
        }

        .carnate-workshop-dashboard .metric-icon.neutral {
            background: var(--dash-icon);
            color: #475569;
        }

        /* Status cards */
        .carnate-workshop-dashboard .status-card {
            height: 100%;
            background: #fff;
            border: 1px solid var(--dash-border);
            border-radius: 13px;
            box-shadow: var(--dash-shadow);
            transition: .2s ease;
        }

        .carnate-workshop-dashboard .status-card:hover {
            transform: translateY(-2px);
            border-color: #cbd5e1;
        }

        .carnate-workshop-dashboard .status-body {
            min-height: 68px;
            padding: 12px 14px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .carnate-workshop-dashboard .status-label {
            display: block;
            margin-bottom: 4px;
            color: var(--dash-muted);
            font-size: 11px;
            font-weight: 600;
        }

        .carnate-workshop-dashboard .status-count {
            color: var(--dash-text);
            font-size: 17px;
            font-weight: 800;
        }

        .carnate-workshop-dashboard .status-icon {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            background: var(--dash-icon);
            color: #64748b;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
        }

        /* Content cards */
        .carnate-workshop-dashboard .dashboard-card {
            margin-top: 16px;
            background: #fff;
            border: 1px solid var(--dash-border);
            border-radius: 14px;
            box-shadow: var(--dash-shadow);
            overflow: hidden;
        }

        .carnate-workshop-dashboard .dashboard-card-header {
            min-height: 55px;
            padding: 13px 17px;
            border-bottom: 1px solid #eef2f7;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .carnate-workshop-dashboard .dashboard-card-title {
            margin: 0;
            color: var(--dash-text);
            font-size: 13px;
            font-weight: 700;
        }

        .carnate-workshop-dashboard .collapse-toggle {
            width: 32px;
            height: 32px;
            padding: 0 !important;
            border: 1px solid var(--dash-border) !important;
            border-radius: 8px;
            background: #fff !important;
            color: var(--dash-muted);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: none !important;
            transition: .2s ease;
        }

        .carnate-workshop-dashboard .collapse-toggle:hover {
            color: var(--dash-red);
            border-color: rgba(229, 57, 53, .25) !important;
            background: var(--dash-red-soft) !important;
        }

        .carnate-workshop-dashboard .dashboard-card-body {
            padding: 16px;
        }

        /* Tables */
        .carnate-workshop-dashboard .dashboard-table-wrap {
            overflow-x: auto;
        }

        .carnate-workshop-dashboard .dashboard-table {
            width: 100%;
            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .carnate-workshop-dashboard .dashboard-table thead th {
            padding: 11px 13px;
            background: #f8fafc;
            color: #64748b;
            border-bottom: 1px solid var(--dash-border);
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .035em;
            white-space: nowrap;
        }

        .carnate-workshop-dashboard .dashboard-table tbody td {
            padding: 12px 13px;
            color: #334155;
            border-bottom: 1px solid #eef2f7;
            font-size: 12px;
            vertical-align: middle;
            white-space: nowrap;
        }

        .carnate-workshop-dashboard .dashboard-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .carnate-workshop-dashboard .dashboard-table tbody tr {
            transition: .15s ease;
        }

        .carnate-workshop-dashboard .dashboard-table tbody tr:hover {
            background: #fafafa;
        }

        .carnate-workshop-dashboard .job-number,
        .carnate-workshop-dashboard .staff-name {
            color: var(--dash-text);
            font-weight: 700;
        }

        /* Status badges */
        .carnate-workshop-dashboard .status-badge {
            display: inline-flex;
            align-items: center;
            min-height: 25px;
            padding: 0 8px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 700;
        }

        .carnate-workshop-dashboard .status-open {
            background: #f1f5f9;
            color: #475569;
        }

        .carnate-workshop-dashboard .status-confirmed {
            background: var(--dash-blue-soft);
            color: var(--dash-blue);
        }

        .carnate-workshop-dashboard .status-completed {
            background: var(--dash-green-soft);
            color: var(--dash-green);
        }

        .carnate-workshop-dashboard .status-closed {
            background: #fef2f2;
            color: #dc2626;
        }

        /* Staff cards */
        .carnate-workshop-dashboard .staff-rank-card {
            height: 100%;
            background: #fff;
            border: 1px solid var(--dash-border);
            border-radius: 13px;
            padding: 13px;
            box-shadow: var(--dash-shadow);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            transition: .2s ease;
        }

        .carnate-workshop-dashboard .staff-rank-card:hover {
            transform: translateY(-2px);
            border-color: #cbd5e1;
        }

        .carnate-workshop-dashboard .staff-rank {
            color: var(--dash-muted);
            font-size: 10px;
            font-weight: 700;
        }

        .carnate-workshop-dashboard .staff-rank-name {
            margin: 3px 0 2px;
            color: var(--dash-text);
            font-size: 12px;
            font-weight: 700;
        }

        .carnate-workshop-dashboard .staff-rank-count {
            color: var(--dash-red);
            font-size: 16px;
            font-weight: 800;
        }

        .carnate-workshop-dashboard .staff-medal {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            background: var(--dash-red-soft);
            color: var(--dash-red);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
        }

        .carnate-workshop-dashboard .staff-view {
            width: 32px;
            height: 32px;
            border: 1px solid var(--dash-border);
            border-radius: 8px;
            background: #fff;
            color: var(--dash-muted);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            text-decoration: none;
            transition: .2s ease;
        }

        .carnate-workshop-dashboard .staff-view:hover {
            color: var(--dash-red);
            border-color: rgba(229, 57, 53, .25);
            background: var(--dash-red-soft);
        }

        /* Empty table */
        .carnate-workshop-dashboard .table-empty {
            padding: 30px 15px !important;
            text-align: center;
            color: var(--dash-muted) !important;
        }

        /* Staff modal */
        .carnate-workshop-dashboard .staff-modal .modal-content {
            border: 1px solid var(--dash-border);
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 25px 70px rgba(15, 23, 42, .18);
        }

        .carnate-workshop-dashboard .staff-modal .modal-header {
            padding: 15px 18px;
            border-bottom: 1px solid var(--dash-border);
            background: #fff;
        }

        .carnate-workshop-dashboard .staff-modal .modal-title {
            color: var(--dash-text);
            font-size: 14px;
            font-weight: 700;
        }

        .carnate-workshop-dashboard .staff-modal .modal-body {
            padding: 16px;
        }

        .carnate-workshop-dashboard .staff-modal .modal-footer {
            padding: 12px 16px;
            border-top: 1px solid var(--dash-border);
        }

        .carnate-workshop-dashboard .staff-job-item {
            border: 1px solid var(--dash-border) !important;
            border-radius: 10px !important;
            margin-bottom: 8px;
            padding: 12px 13px;
            color: var(--dash-text);
            transition: .2s ease;
        }

        .carnate-workshop-dashboard .staff-job-item:hover {
            background: #fafafa;
            border-color: #cbd5e1 !important;
        }

        .carnate-workshop-dashboard .staff-job-number {
            font-size: 12px;
            font-weight: 700;
        }

        .carnate-workshop-dashboard .staff-job-meta {
            margin-top: 3px;
            color: var(--dash-muted);
            font-size: 11px;
        }

        .carnate-workshop-dashboard .dashboard-secondary-btn {
            border: 1px solid var(--dash-border);
            border-radius: 8px;
            background: #fff;
            color: var(--dash-muted);
            font-size: 12px;
            font-weight: 600;
        }

        .carnate-workshop-dashboard .dashboard-secondary-btn:hover {
            color: var(--dash-text);
            background: #f8fafc;
        }

        /* Pagination */
        .carnate-workshop-dashboard .dashboard-pagination {
            margin-top: 14px;
        }

        /* Responsive */
        @media (max-width: 767.98px) {
            .carnate-workshop-dashboard .dashboard-tabs {
                width: 100%;
                overflow-x: auto;
                margin-top: 12px;
            }

            .carnate-workshop-dashboard .dashboard-tab {
                white-space: nowrap;
            }

            .carnate-workshop-dashboard .metric-body {
                min-height: 68px;
                padding: 11px;
            }

            .carnate-workshop-dashboard .metric-value {
                font-size: 16px;
            }

            .carnate-workshop-dashboard .dashboard-card-body {
                padding: 12px;
            }
        }
    </style>

    {{-- Tabs --}}
    <ul class="nav nav-tabs dashboard-tabs"
        id="dashboardTabs"
        role="tablist">

        <li class="nav-item" role="presentation">
            <button
                wire:click="setTab('jobs')"
                class="nav-link dashboard-tab {{ $activeTab === 'jobs' ? 'active' : '' }}"
                id="jobs-tab"
                data-bs-toggle="tab"
                data-bs-target="#jobs"
                type="button"
                role="tab">

                <i class="bx bx-briefcase me-1"></i>
                Job Cards

            </button>
        </li>

        <li class="nav-item" role="presentation">
            <button
                wire:click="setTab('stocks')"
                class="nav-link dashboard-tab {{ $activeTab === 'stocks' ? 'active' : '' }}"
                id="stock-tab"
                data-bs-toggle="tab"
                data-bs-target="#stocks"
                type="button"
                role="tab">

                <i class="bx bx-package me-1"></i>
                Inventory

            </button>
        </li>

        <li class="nav-item" role="presentation">
            <button
                wire:click="setTab('staff')"
                class="nav-link dashboard-tab {{ $activeTab === 'staff' ? 'active' : '' }}"
                id="staff-tab"
                data-bs-toggle="tab"
                data-bs-target="#staff"
                type="button"
                role="tab">

                <i class="bx bx-user me-1"></i>
                Staff Performance

            </button>
        </li>

        {{-- Original commented tab preserved --}}
        {{-- 
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="xyz-tab" data-bs-toggle="tab" data-bs-target="#xyz" type="button" role="tab">
                <i class="bx bx-user me-1"></i> xyz
            </button>
        </li>
        --}}

    </ul>

    <div class="tab-content" id="dashboardTabsContent">

        {{-- ========================================================= --}}
        {{-- JOB CARDS TAB --}}
        {{-- ========================================================= --}}

        <div class="tab-pane fade {{ $activeTab === 'jobs' ? 'show active' : '' }}"
            id="jobs"
            role="tabpanel">

            {{-- Main Job Metrics --}}
            <div class="row g-3">

                <div class="col-6 col-md-3 col-xl-2">

                    <div class="metric-card">

                        <div class="metric-body">

                            <div>
                                <p class="metric-label">Active Jobs</p>
                                <div class="metric-value">{{ $activeJobs }}</div>
                            </div>

                            <div class="metric-icon green">
                                <i class="bx bx-bolt"></i>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-6 col-md-3 col-xl-2">

                    <div class="metric-card">

                        <div class="metric-body">

                            <div>
                                <p class="metric-label">Total Jobs</p>
                                <div class="metric-value">{{ $totalJobs }}</div>
                            </div>

                            <div class="metric-icon blue">
                                <i class="bx bx-layer"></i>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

            {{-- Job Status --}}
            @php
                $statusIcons = [
                    'Open' => 'bx-folder-open',
                    'Confirmed' => 'bx-check-double',
                    'Completed' => 'bx-check-circle',
                    'Closed' => 'bx-x-circle',
                ];
            @endphp

            <div class="row g-3 mt-1">

                @foreach ($statusCounts as $s)

                    <div class="col-6 col-md-3 col-xl-2">

                        <div class="status-card">

                            <div class="status-body">

                                <div>
                                    <span class="status-label">
                                        {{ $s['label'] }}
                                    </span>

                                    <div class="status-count">
                                        {{ $s['count'] }}
                                    </div>
                                </div>

                                <div class="status-icon">
                                    <i class="bx {{ $statusIcons[$s['label']] ?? 'bx-bar-chart-alt-2' }}"></i>
                                </div>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

            {{-- Latest Jobs --}}
            <div class="dashboard-card">

                <div class="dashboard-card-header">

                    <h6 class="dashboard-card-title">
                        Latest Jobs
                    </h6>

                    <button
                        id="jobsTableToggle"
                        class="collapse-toggle {{ $jobsTableOpen ? '' : 'collapsed' }}"
                        type="button"
                        wire:click="toggleJobsTable"
                        title="Hide/Show">

                        <i class="bx bx-chevron-down icon-expand {{ $jobsTableOpen ? 'd-none' : '' }}"></i>

                        <i class="bx bx-chevron-up icon-collapse {{ $jobsTableOpen ? '' : 'd-none' }}"></i>

                    </button>

                </div>

                <div id="jobsTableCollapse"
                    class="collapse {{ $jobsTableOpen ? 'show' : '' }}">

                    <div class="dashboard-card-body">

                        <div class="dashboard-table-wrap">

                            <table class="dashboard-table">

                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Jobcard No</th>
                                        <th>Customer</th>
                                        <th>Vehicle</th>
                                        <th>Status</th>
                                        <th>Created</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @forelse ($jobs as $index => $job)

                                        <tr>

                                            <td>
                                                {{ $jobs->firstItem() + $index }}
                                            </td>

                                            <td>
                                                <span class="job-number">
                                                    {{ $job->jobcard_number ?? '-' }}
                                                </span>
                                            </td>

                                            <td>
                                                {{ $job->customer_name ?? ($job->customer->company_name ?? '-') }}
                                            </td>

                                            <td>
                                                {{ $job->vehical_number ?? ($job->vehicle->model ?? '-') }}
                                            </td>

                                            <td>

                                                @php($st = [
                                                    0 => 'Open',
                                                    1 => 'Confirmed',
                                                    2 => 'Completed',
                                                    3 => 'Closed'
                                                ])

                                                <span class="status-badge
                                                    @if($job->status == 0) status-open
                                                    @elseif($job->status == 1) status-confirmed
                                                    @elseif($job->status == 2) status-completed
                                                    @elseif($job->status == 3) status-closed
                                                    @endif">

                                                    {{ $st[$job->status] ?? $job->status }}

                                                </span>

                                            </td>

                                            <td>
                                                {{ optional($job->created_at)->format('d M Y, h:i A') }}
                                            </td>

                                        </tr>

                                    @empty

                                        <tr>
                                            <td colspan="6" class="table-empty">
                                                No jobs found
                                            </td>
                                        </tr>

                                    @endforelse

                                </tbody>

                            </table>

                        </div>

                        <div class="dashboard-pagination">
                            {{ $jobs->links() }}
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- INVENTORY TAB --}}
        {{-- ========================================================= --}}

        <div class="tab-pane fade {{ $activeTab === 'stocks' ? 'show active' : '' }}"
            id="stocks"
            role="tabpanel">

            <h6 class="dashboard-section-heading">
                Stock Overview
            </h6>

            <div class="row g-3">

                @php($catOrder = [
                    1 => 'Accessory',
                    2 => 'Parts',
                    4 => 'Lubricant',
                    3 => 'Tools'
                ])

                @foreach($catOrder as $id => $label)

                    @php($c = $stockByCategory[$id] ?? [
                        'label' => $label,
                        'count' => 0,
                        'qty' => 0
                    ])

                    <div class="col-6 col-md-3 col-xl-2">

                        <div class="metric-card">

                            <div class="metric-body">

                                <div>
                                    <p class="metric-label">
                                        {{ $c['label'] }}
                                    </p>

                                    <div class="metric-value">
                                        {{ $c['qty'] }}
                                    </div>
                                </div>

                                <div class="metric-icon blue">
                                    <i class="bx bx-package"></i>
                                </div>

                            </div>

                        </div>

                    </div>

                @endforeach

                <div class="col-6 col-md-3 col-xl-2">

                    <div class="metric-card">

                        <div class="metric-body">

                            <div>
                                <p class="metric-label">Total Items</p>

                                <div class="metric-value">
                                    {{ $stockTotal }}
                                </div>
                            </div>

                            <div class="metric-icon neutral">
                                <i class="bx bx-box"></i>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-6 col-md-3 col-xl-2">

                    <div class="metric-card">

                        <div class="metric-body">

                            <div>
                                <p class="metric-label">Total Stock Qty</p>

                                <div class="metric-value">
                                    {{ $stockTotalQty }}
                                </div>
                            </div>

                            <div class="metric-icon green">
                                <i class="bx bx-package"></i>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

            {{-- Suppliers --}}
            <h6 class="dashboard-section-heading">
                Suppliers
            </h6>

            <div class="row g-3">

                <div class="col-6 col-md-3 col-xl-2">

                    <div class="metric-card">

                        <div class="metric-body">

                            <div>
                                <p class="metric-label">Suppliers</p>

                                <div class="metric-value">
                                    {{ $supplierCount }}
                                </div>
                            </div>

                            <div class="metric-icon orange">
                                <i class="bx bx-store"></i>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

            {{-- Labour --}}
            <h6 class="dashboard-section-heading">
                Labour Charges
            </h6>

            <div class="row g-3">

                <div class="col-6 col-md-3 col-xl-2">

                    <div class="metric-card">

                        <div class="metric-body">

                            <div>
                                <p class="metric-label">Labour Items</p>

                                <div class="metric-value">
                                    {{ $labourCount }}
                                </div>
                            </div>

                            <div class="metric-icon red">
                                <i class="bx bx-wrench"></i>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-6 col-md-3 col-xl-2">

                    <div class="metric-card">

                        <div class="metric-body">

                            <div>
                                <p class="metric-label">Labour Total</p>

                                <div class="metric-value">
                                    {{ number_format($labourTotal, 2) }}
                                </div>
                            </div>

                            <div class="metric-icon green">
                                <i class="bx bx-rupee"></i>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- STAFF PERFORMANCE TAB --}}
        {{-- ========================================================= --}}

        <div class="tab-pane fade {{ $activeTab === 'staff' ? 'show active' : '' }}"
            id="staff"
            role="tabpanel">

            <div class="dashboard-card">

                <div class="dashboard-card-header">

                    <h6 class="dashboard-card-title">
                        Top Staff (Completed Job Cards)
                    </h6>

                </div>

                <div class="dashboard-card-body">

                    {{-- Top Staff Cards --}}
                    <div class="row g-3 mb-3">

                        @foreach ($topStaff as $i => $staff)

                            <div class="col-6 col-md-3 col-xl-2">

                                <div class="staff-rank-card">

                                    <div>

                                        <div class="staff-rank">
                                            #{{ $i + 1 }}
                                        </div>

                                        <div class="staff-rank-name">
                                            {{ $staff['name'] }}
                                        </div>

                                        <div class="staff-rank-count">
                                            {{ $staff['count'] }}
                                        </div>

                                    </div>

                                    <div class="staff-medal">
                                        <i class="bx bx-medal"></i>
                                    </div>

                                </div>

                            </div>

                        @endforeach

                    </div>

                    {{-- Staff Table --}}
                    <div class="dashboard-table-wrap">

                        <table class="dashboard-table">

                            <thead>
                                <tr>
                                    <th>Rank</th>
                                    <th>Staff</th>
                                    <th>Completed Jobs</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($topStaff as $i => $staff)

                                    <tr>

                                        <td>
                                            #{{ $i + 1 }}
                                        </td>

                                        <td>
                                            <span class="staff-name">
                                                {{ $staff['name'] }}
                                            </span>
                                        </td>

                                        <td>
                                            {{ $staff['count'] }}
                                        </td>

                                        <td>

                                            @if($staff['id'] > 0 && $staff['count'] > 0)

                                                <a
                                                    type="button"
                                                    title="View Completed Jobs"
                                                    class="staff-view"
                                                    wire:click="viewStaffJobs({{ $staff['id'] }})">

                                                    <i class="bx bx-show"></i>

                                                </a>

                                            @else

                                                <span class="text-muted small">
                                                    —
                                                </span>

                                            @endif

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- CUSTOMERS TAB --}}
        {{-- ========================================================= --}}

        <div class="tab-pane fade"
            id="customers"
            role="tabpanel">

            <div class="alert alert-info">
                Customers data
            </div>

        </div>

    </div>


    {{-- ============================================================= --}}
    {{-- STAFF COMPLETED JOBS MODAL --}}
    {{-- ============================================================= --}}

    <div class="modal fade staff-modal"
        id="staffJobsModal"
        tabindex="-1"
        aria-hidden="true"
        wire:ignore.self>

        <div class="modal-dialog modal-md modal-dialog-centered">

            <div class="modal-content">

                <div class="modal-header">

                    <h6 class="modal-title">
                        Completed Jobs - {{ $selectedStaffName }}
                    </h6>

                    <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close">
                    </button>

                </div>

                <div class="modal-body">

                    <div class="list-group">

                        @forelse ($staffJobs as $j)

                            <a
                                href="{{ route('workshop.jobcardedit', $j['id']) }}"
                                target="_blank"
                                class="list-group-item list-group-item-action staff-job-item d-flex justify-content-between align-items-center">

                                <div>

                                    <div class="staff-job-number">
                                        {{ $j['number'] }}
                                    </div>

                                    <div class="staff-job-meta">
                                        {{ $j['customer'] }} · {{ $j['phone'] }}
                                    </div>

                                </div>

                                <i class="bx bx-link-external"></i>

                            </a>

                        @empty

                            <div class="text-muted small text-center py-3">
                                No jobs found.
                            </div>

                        @endforelse

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button"
                        class="btn dashboard-secondary-btn"
                        data-bs-dismiss="modal">

                        Close

                    </button>

                </div>

            </div>

        </div>

    </div>

</div>