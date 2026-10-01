<div class="carnate-workshops-report">

    <style>
        .carnate-workshops-report {
            --cwr-bg: #f7f8fa;
            --cwr-card: #ffffff;
            --cwr-text: #111827;
            --cwr-muted: #64748b;
            --cwr-border: #e2e8f0;
            --cwr-soft: #f1f5f9;
            --cwr-red: #e53935;
            --cwr-red-soft: #fff5f5;
            --cwr-green: #16a34a;
            --cwr-green-soft: #f0fdf4;
            --cwr-orange: #d97706;
            --cwr-orange-soft: #fffbeb;
            --cwr-blue: #2563eb;
            --cwr-blue-soft: #eff6ff;
            background: var(--cwr-bg);
            color: var(--cwr-text);
        }

        .carnate-workshops-report .cwr-card {
            background: var(--cwr-card);
            border: 1px solid var(--cwr-border);
            border-radius: 16px;
            box-shadow: 0 4px 18px rgba(15, 23, 42, 0.04);
        }

        .carnate-workshops-report .cwr-header {
            padding: 20px 22px;
        }

        .carnate-workshops-report .cwr-title-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .carnate-workshops-report .cwr-title-icon {
            width: 42px;
            height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: var(--cwr-red-soft);
            color: var(--cwr-red);
            font-size: 18px;
        }

        .carnate-workshops-report .cwr-title {
            margin: 0;
            color: var(--cwr-text);
            font-size: 21px;
            font-weight: 700;
        }

        .carnate-workshops-report .cwr-subtitle {
            margin: 4px 0 0;
            color: var(--cwr-muted);
            font-size: 12px;
        }

        .carnate-workshops-report .cwr-filters {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-end;
            justify-content: flex-end;
            gap: 12px;
        }

        .carnate-workshops-report .cwr-filter {
            min-width: 130px;
        }

        .carnate-workshops-report .cwr-filter.search-filter {
            min-width: 190px;
        }

        .carnate-workshops-report .cwr-filter-label {
            display: block;
            margin-bottom: 6px;
            color: #475569;
            font-size: 11px;
            font-weight: 700;
        }

        .carnate-workshops-report .form-control,
        .carnate-workshops-report .form-select {
            min-height: 40px;
            border: 1px solid var(--cwr-border);
            border-radius: 9px;
            color: var(--cwr-text);
            background: #fff;
            box-shadow: none;
            font-size: 13px;
        }

        .carnate-workshops-report .form-control:focus,
        .carnate-workshops-report .form-select:focus {
            border-color: rgba(229, 57, 53, .45);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .08);
        }

        .carnate-workshops-report .cwr-export-group {
            display: flex;
            gap: 7px;
        }

        .carnate-workshops-report .cwr-export-btn {
            min-height: 40px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 0 12px;
            border: 1px solid var(--cwr-border);
            border-radius: 9px;
            font-size: 12px;
            font-weight: 700;
            transition: all .2s ease;
        }

        .carnate-workshops-report .cwr-pdf-btn {
            color: #dc2626;
            background: #fff;
        }

        .carnate-workshops-report .cwr-pdf-btn:hover {
            background: var(--cwr-red-soft);
            border-color: #fecaca;
        }

        .carnate-workshops-report .cwr-excel-btn {
            color: #15803d;
            background: #fff;
        }

        .carnate-workshops-report .cwr-excel-btn:hover {
            background: var(--cwr-green-soft);
            border-color: #bbf7d0;
        }

        /* Summary cards */
        .carnate-workshops-report .cwr-summary {
            padding: 18px 20px 0;
        }

        .carnate-workshops-report .cwr-summary-card {
            height: 100%;
            padding: 18px;
            border: 1px solid var(--cwr-border);
            border-radius: 14px;
            background: #fff;
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .carnate-workshops-report .cwr-summary-card:hover {
            transform: translateY(-1px);
            box-shadow: 0 7px 20px rgba(15, 23, 42, .06);
        }

        .carnate-workshops-report .cwr-summary-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .carnate-workshops-report .cwr-summary-label {
            margin: 0 0 5px;
            color: var(--cwr-muted);
            font-size: 12px;
            font-weight: 600;
        }

        .carnate-workshops-report .cwr-summary-value {
            color: var(--cwr-text);
            font-size: 25px;
            line-height: 1;
            font-weight: 750;
        }

        .carnate-workshops-report .cwr-summary-icon {
            width: 44px;
            height: 44px;
            flex: 0 0 44px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            font-size: 18px;
        }

        .carnate-workshops-report .cwr-summary-total .cwr-summary-icon {
            background: var(--cwr-blue-soft);
            color: var(--cwr-blue);
        }

        .carnate-workshops-report .cwr-summary-subscribed .cwr-summary-icon {
            background: var(--cwr-green-soft);
            color: var(--cwr-green);
        }

        .carnate-workshops-report .cwr-summary-trial .cwr-summary-icon {
            background: var(--cwr-orange-soft);
            color: var(--cwr-orange);
        }

        .carnate-workshops-report .cwr-summary-inactive .cwr-summary-icon {
            background: var(--cwr-red-soft);
            color: var(--cwr-red);
        }

        /* Table */
        .carnate-workshops-report .cwr-table-card {
            margin-top: 18px;
            overflow: hidden;
        }

        .carnate-workshops-report .cwr-table-wrap {
            overflow-x: auto;
        }

        .carnate-workshops-report .cwr-table {
            width: 100%;
            min-width: 1050px;
            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .carnate-workshops-report .cwr-table thead th {
            padding: 14px 16px;
            background: #f8fafc;
            color: #475569;
            border-bottom: 1px solid var(--cwr-border);
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .035em;
            white-space: nowrap;
        }

        .carnate-workshops-report .cwr-table tbody td {
            padding: 14px 16px;
            color: var(--cwr-text);
            border-bottom: 1px solid #eef2f7;
            font-size: 13px;
            vertical-align: middle;
        }

        .carnate-workshops-report .cwr-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .carnate-workshops-report .cwr-table tbody tr:hover {
            background: #fafafa;
        }

        .carnate-workshops-report .cwr-sno {
            color: var(--cwr-muted);
            font-weight: 600;
        }

        .carnate-workshops-report .cwr-vendor {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 160px;
        }

        .carnate-workshops-report .cwr-vendor-avatar {
            width: 36px;
            height: 36px;
            flex: 0 0 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: var(--cwr-red-soft);
            color: var(--cwr-red);
        }

        .carnate-workshops-report .cwr-vendor-name {
            font-weight: 650;
            color: var(--cwr-text);
        }

        .carnate-workshops-report .cwr-company {
            color: #475569;
            font-weight: 500;
        }

        .carnate-workshops-report .cwr-email {
            color: #475569;
        }

        .carnate-workshops-report .cwr-mobile {
            white-space: nowrap;
        }

        .carnate-workshops-report .cwr-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        .carnate-workshops-report .cwr-status.subscribed {
            color: #15803d;
            background: var(--cwr-green-soft);
            border: 1px solid #bbf7d0;
        }

        .carnate-workshops-report .cwr-status.trial {
            color: var(--cwr-orange);
            background: var(--cwr-orange-soft);
            border: 1px solid #fde68a;
        }

        .carnate-workshops-report .cwr-status.inactive {
            color: #dc2626;
            background: var(--cwr-red-soft);
            border: 1px solid #fecaca;
        }

        .carnate-workshops-report .cwr-date {
            color: #475569;
            white-space: nowrap;
        }

        .carnate-workshops-report .cwr-view-btn {
            width: 34px;
            height: 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--cwr-border);
            border-radius: 9px;
            background: #fff;
            color: #64748b;
            transition: all .2s ease;
        }

        .carnate-workshops-report .cwr-view-btn:hover {
            color: var(--cwr-red);
            background: var(--cwr-red-soft);
            border-color: #fecaca;
        }

        .carnate-workshops-report .cwr-pagination {
            padding: 15px 18px;
            border-top: 1px solid var(--cwr-border);
        }

        .carnate-workshops-report .cwr-showing {
            color: var(--cwr-muted);
            font-size: 12px;
        }

        .carnate-workshops-report .cwr-empty {
            padding: 45px 20px;
            text-align: center;
        }

        .carnate-workshops-report .cwr-empty-icon {
            width: 52px;
            height: 52px;
            margin: 0 auto 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            background: var(--cwr-soft);
            color: #94a3b8;
            font-size: 21px;
        }

        .carnate-workshops-report .cwr-empty-title {
            color: #475569;
            font-size: 14px;
            font-weight: 700;
        }

        /* Modal */
        .carnate-workshops-report .cwr-modal {
            position: fixed;
            inset: 0;
            z-index: 1055;
            overflow-x: hidden;
            overflow-y: auto;
        }

        .carnate-workshops-report .cwr-modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, .58);
            backdrop-filter: blur(2px);
        }

        .carnate-workshops-report .cwr-modal-dialog {
            position: relative;
            z-index: 2;
            max-width: 900px;
            margin: 45px auto;
            padding: 0 15px;
        }

        .carnate-workshops-report .cwr-modal-content {
            background: #fff;
            border: 1px solid var(--cwr-border);
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 25px 70px rgba(15, 23, 42, .22);
        }

        .carnate-workshops-report .cwr-modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 22px;
            border-bottom: 1px solid var(--cwr-border);
            background: #fff;
        }

        .carnate-workshops-report .cwr-modal-title {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 0;
            color: var(--cwr-text);
            font-size: 17px;
            font-weight: 700;
        }

        .carnate-workshops-report .cwr-modal-title-icon {
            width: 35px;
            height: 35px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 9px;
            background: var(--cwr-red-soft);
            color: var(--cwr-red);
        }

        .carnate-workshops-report .cwr-close {
            width: 35px;
            height: 35px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 0;
            border-radius: 9px;
            background: var(--cwr-soft);
            color: #64748b;
            opacity: 1;
        }

        .carnate-workshops-report .cwr-close:hover {
            background: var(--cwr-red-soft);
            color: var(--cwr-red);
        }

        .carnate-workshops-report .cwr-modal-body {
            padding: 22px;
        }

        .carnate-workshops-report .cwr-detail-card {
            height: 100%;
            padding: 17px;
            border: 1px solid var(--cwr-border);
            border-radius: 13px;
            background: #fff;
        }

        .carnate-workshops-report .cwr-detail-heading {
            display: flex;
            align-items: center;
            gap: 8px;
            padding-bottom: 11px;
            margin-bottom: 14px;
            border-bottom: 1px solid var(--cwr-border);
            color: var(--cwr-text);
            font-size: 13px;
            font-weight: 700;
        }

        .carnate-workshops-report .cwr-detail-heading i {
            color: var(--cwr-red);
        }

        .carnate-workshops-report .cwr-detail-row {
            margin-bottom: 11px;
            color: #475569;
            font-size: 13px;
            line-height: 1.5;
        }

        .carnate-workshops-report .cwr-detail-row:last-child {
            margin-bottom: 0;
        }

        .carnate-workshops-report .cwr-detail-label {
            color: var(--cwr-muted);
            font-weight: 600;
        }

        .carnate-workshops-report .cwr-detail-value {
            color: var(--cwr-text);
            font-weight: 600;
        }

        .carnate-workshops-report .cwr-modal-footer {
            display: flex;
            justify-content: flex-end;
            padding: 15px 22px;
            border-top: 1px solid var(--cwr-border);
            background: #fafafa;
        }

        .carnate-workshops-report .cwr-close-btn {
            min-height: 40px;
            padding: 0 17px;
            border: 0;
            border-radius: 9px;
            background: var(--cwr-soft);
            color: #475569;
            font-size: 13px;
            font-weight: 700;
        }

        .carnate-workshops-report .cwr-close-btn:hover {
            background: #e2e8f0;
        }

        @media (max-width: 1199px) {
            .carnate-workshops-report .cwr-header {
                gap: 20px;
            }

            .carnate-workshops-report .cwr-filters {
                width: 100%;
                justify-content: flex-start;
            }
        }

        @media (max-width: 767px) {
            .carnate-workshops-report .cwr-header {
                padding: 18px;
            }

            .carnate-workshops-report .cwr-title {
                font-size: 18px;
            }

            .carnate-workshops-report .cwr-filters {
                display: grid;
                grid-template-columns: 1fr 1fr;
                width: 100%;
            }

            .carnate-workshops-report .cwr-filter,
            .carnate-workshops-report .cwr-filter.search-filter {
                min-width: 0;
                width: 100%;
            }

            .carnate-workshops-report .cwr-export-group {
                grid-column: 1 / -1;
            }

            .carnate-workshops-report .cwr-export-btn {
                flex: 1;
                justify-content: center;
            }

            .carnate-workshops-report .cwr-summary {
                padding: 14px 14px 0;
            }

            .carnate-workshops-report .cwr-modal-dialog {
                margin: 20px auto;
            }

            .carnate-workshops-report .cwr-modal-body {
                padding: 16px;
            }

            .carnate-workshops-report .cwr-modal-header,
            .carnate-workshops-report .cwr-modal-footer {
                padding-left: 16px;
                padding-right: 16px;
            }
        }

        @media (max-width: 480px) {
            .carnate-workshops-report .cwr-filters {
                grid-template-columns: 1fr;
            }

            .carnate-workshops-report .cwr-export-group {
                grid-column: auto;
            }
        }
    </style>

    <div class="cwr-card">

        <!-- Header + Filters -->
        <div class="cwr-header d-flex flex-wrap align-items-center justify-content-between">

            <div class="cwr-title-wrap">
                <span class="cwr-title-icon">
                    <i class="fas fa-chart-line"></i>
                </span>

                <div>
                    <h5 class="cwr-title">Workshops Report</h5>
                    <p class="cwr-subtitle">Monitor workshop vendors, subscriptions and activity</p>
                </div>
            </div>

            <div class="cwr-filters">

                <!-- Search -->
                <div class="cwr-filter search-filter">
                    <label class="cwr-filter-label">Search</label>
                    <input
                        type="text"
                        class="form-control"
                        placeholder="Search name, company..."
                        wire:model.live="search">
                </div>

                <!-- Status Filter -->
                <div class="cwr-filter">
                    <label class="cwr-filter-label">Status</label>
                    <select
                        class="form-select"
                        wire:model.live="statusFilter">
                        <option value="">All Statuses</option>
                        <option value="subscribed">Subscribed</option>
                        <option value="trial">Trial</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>

                <!-- Filter Type -->
                <div class="cwr-filter">
                    <label class="cwr-filter-label">Date Range</label>
                    <select
                        class="form-select"
                        wire:model.live="filterType">
                        <option value="">All Time</option>
                        <option value="daily">Today</option>
                        <option value="weekly">This Week</option>
                        <option value="monthly">This Month</option>
                    </select>
                </div>

                <!-- From Date -->
                <div class="cwr-filter">
                    <label class="cwr-filter-label">From</label>
                    <input
                        type="date"
                        class="form-control"
                        wire:model.live="fromDate">
                </div>

                <!-- To Date -->
                <div class="cwr-filter">
                    <label class="cwr-filter-label">To</label>
                    <input
                        type="date"
                        class="form-control"
                        wire:model.live="toDate">
                </div>

                <!-- Export -->
                <div class="cwr-export-group">

                    <button
                        class="cwr-export-btn cwr-pdf-btn"
                        wire:click="downloadPDF">
                        <i class="bx bxs-file-pdf"></i>
                        Export PDF
                    </button>

                    <button
                        class="cwr-export-btn cwr-excel-btn"
                        wire:click="downloadExcel">
                        <i class="bx bxs-spreadsheet"></i>
                        Export Excel
                    </button>

                </div>

            </div>
        </div>

        <!-- Summary -->
        <div class="cwr-summary">
            <div class="row g-3">

                <!-- Total Workshops -->
                <div class="col-6 col-md-3">
                    <div class="cwr-summary-card cwr-summary-total">
                        <div class="cwr-summary-content">
                            <div>
                                <p class="cwr-summary-label">Total Workshops</p>
                                <span class="cwr-summary-value">
                                    {{ $totals['total'] ?? 0 }}
                                </span>
                            </div>

                            <span class="cwr-summary-icon">
                                <i class="fas fa-tools"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Subscribed -->
                <div class="col-6 col-md-3">
                    <div class="cwr-summary-card cwr-summary-subscribed">
                        <div class="cwr-summary-content">
                            <div>
                                <p class="cwr-summary-label">Subscribed</p>
                                <span class="cwr-summary-value">
                                    {{ $totals['subscribed'] ?? 0 }}
                                </span>
                            </div>

                            <span class="cwr-summary-icon">
                                <i class="fas fa-check-circle"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Trial -->
                <div class="col-6 col-md-3">
                    <div class="cwr-summary-card cwr-summary-trial">
                        <div class="cwr-summary-content">
                            <div>
                                <p class="cwr-summary-label">Trial Mode</p>
                                <span class="cwr-summary-value">
                                    {{ $totals['trial'] ?? 0 }}
                                </span>
                            </div>

                            <span class="cwr-summary-icon">
                                <i class="fas fa-hourglass-half"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Inactive -->
                <div class="col-6 col-md-3">
                    <div class="cwr-summary-card cwr-summary-inactive">
                        <div class="cwr-summary-content">
                            <div>
                                <p class="cwr-summary-label">Inactive</p>
                                <span class="cwr-summary-value">
                                    {{ $totals['inactive'] ?? 0 }}
                                </span>
                            </div>

                            <span class="cwr-summary-icon">
                                <i class="fas fa-times-circle"></i>
                            </span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Report Table -->
        <div class="cwr-table-card">

            <div class="cwr-table-wrap">

                <table class="cwr-table">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Vendor Name</th>
                            <th>Company Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>City</th>
                            <th>Status</th>
                            <th>Join Date</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($workshops as $w)

                            <tr>

                                <td>
                                    <span class="cwr-sno">
                                        {{ $loop->iteration + ($workshops->currentPage()-1)*$workshops->perPage() }}
                                    </span>
                                </td>

                                <td>
                                    <div class="cwr-vendor">
                                        <span class="cwr-vendor-avatar">
                                            <i class="fas fa-tools"></i>
                                        </span>

                                        <span class="cwr-vendor-name">
                                            {{ $w->name }} {{ $w->lastname }}
                                        </span>
                                    </div>
                                </td>

                                <td>
                                    <span class="cwr-company">
                                        {{ $w->company_name ?? 'N/A' }}
                                    </span>
                                </td>

                                <td>
                                    <span class="cwr-email">
                                        {{ $w->email }}
                                    </span>
                                </td>

                                <td>
                                    <span class="cwr-mobile">
                                        {{ $w->mobile_no }}
                                    </span>
                                </td>

                                <td>
                                    {{ $w->cityName ? $w->cityName->name : 'N/A' }}
                                </td>

                                <td>

                                    @if($w->is_subscribe)

                                        <span class="cwr-status subscribed">
                                            <i class="bx bx-check-circle"></i>
                                            Subscribed
                                        </span>

                                    @elseif($w->is_trial)

                                        <span class="cwr-status trial">
                                            <i class="bx bx-time-five"></i>
                                            Trial
                                        </span>

                                    @else

                                        <span class="cwr-status inactive">
                                            <i class="bx bx-x-circle"></i>
                                            Inactive
                                        </span>

                                    @endif

                                </td>

                                <td>
                                    <span class="cwr-date">
                                        {{ \Carbon\Carbon::parse($w->created_at)->format('d M Y') }}
                                    </span>
                                </td>

                                <td class="text-center">

                                    <button
                                        class="cwr-view-btn"
                                        wire:click="viewWorkshop({{ $w->id }})"
                                        title="View Details">
                                        <i class="bx bx-show"></i>
                                    </button>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="9">

                                    <div class="cwr-empty">

                                        <div class="cwr-empty-icon">
                                            <i class="fas fa-tools"></i>
                                        </div>

                                        <div class="cwr-empty-title">
                                            No workshops found matching filters.
                                        </div>

                                    </div>

                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="cwr-pagination d-flex justify-content-between align-items-center flex-wrap gap-2">

                <small class="cwr-showing">
                    Showing
                    {{ $workshops->firstItem() ?? 0 }}–{{ $workshops->lastItem() ?? 0 }}
                    of
                    {{ $workshops->total() }}
                </small>

                {!! $workshops->links() !!}

            </div>

        </div>

    </div>

    <!-- Details Modal -->
    <div
        class="cwr-modal"
        tabindex="-1"
        style="@if($detail) display:block; @else display:none; @endif">

        <div class="cwr-modal-backdrop"></div>

        <div class="cwr-modal-dialog">

            <div class="cwr-modal-content">

                <div class="cwr-modal-header">

                    <h5 class="cwr-modal-title">
                        <span class="cwr-modal-title-icon">
                            <i class="fas fa-tools"></i>
                        </span>
                        Workshop Vendor Details
                    </h5>

                    <button
                        type="button"
                        class="cwr-close"
                        wire:click="$set('viewWorkshopId', null)">
                        <i class="bx bx-x fs-5"></i>
                    </button>

                </div>

                <div class="cwr-modal-body">

                    @if($detail)

                        <div class="row g-3">

                            <!-- Profile Information -->
                            <div class="col-12 col-md-6">

                                <div class="cwr-detail-card">

                                    <div class="cwr-detail-heading">
                                        <i class="fas fa-user-circle"></i>
                                        Profile Information
                                    </div>

                                    <div class="cwr-detail-row">
                                        <span class="cwr-detail-label">Name:</span>
                                        <span class="cwr-detail-value">
                                            {{ $detail->name }} {{ $detail->lastname }}
                                        </span>
                                    </div>

                                    <div class="cwr-detail-row">
                                        <span class="cwr-detail-label">Company Name:</span>
                                        <span class="cwr-detail-value">
                                            {{ $detail->company_name ?? 'N/A' }}
                                        </span>
                                    </div>

                                    <div class="cwr-detail-row">
                                        <span class="cwr-detail-label">Email:</span>
                                        <span class="cwr-detail-value">
                                            {{ $detail->email }}
                                        </span>
                                    </div>

                                    <div class="cwr-detail-row">
                                        <span class="cwr-detail-label">Mobile:</span>
                                        <span class="cwr-detail-value">
                                            {{ $detail->mobile_no }}
                                        </span>
                                    </div>

                                    <div class="cwr-detail-row">
                                        <span class="cwr-detail-label">Join Date:</span>
                                        <span class="cwr-detail-value">
                                            {{ \Carbon\Carbon::parse($detail->created_at)->format('d M Y, H:i A') }}
                                        </span>
                                    </div>

                                </div>

                            </div>

                            <!-- Subscription Status -->
                            <div class="col-12 col-md-6">

                                <div class="cwr-detail-card">

                                    <div class="cwr-detail-heading">
                                        <i class="fas fa-credit-card"></i>
                                        Subscription Status
                                    </div>

                                    <div class="cwr-detail-row">
                                        <span class="cwr-detail-label">Subscription Status:</span>

                                        @if($detail->is_subscribe)

                                            <span class="cwr-status subscribed ms-1">
                                                <i class="bx bx-check-circle"></i>
                                                Subscribed
                                            </span>

                                        @elseif($detail->is_trial)

                                            <span class="cwr-status trial ms-1">
                                                <i class="bx bx-time-five"></i>
                                                Trial Mode
                                            </span>

                                        @else

                                            <span class="cwr-status inactive ms-1">
                                                <i class="bx bx-x-circle"></i>
                                                Inactive
                                            </span>

                                        @endif
                                    </div>

                                    <div class="cwr-detail-row">
                                        <span class="cwr-detail-label">Subscription Start:</span>
                                        <span class="cwr-detail-value">
                                            {{ $detail->subscription_start_date ? \Carbon\Carbon::parse($detail->subscription_start_date)->format('d M Y') : 'N/A' }}
                                        </span>
                                    </div>

                                    <div class="cwr-detail-row">
                                        <span class="cwr-detail-label">Subscription End:</span>
                                        <span class="cwr-detail-value">
                                            {{ $detail->subscription_end_date ? \Carbon\Carbon::parse($detail->subscription_end_date)->format('d M Y') : 'N/A' }}
                                        </span>
                                    </div>

                                    <div class="cwr-detail-row">
                                        <span class="cwr-detail-label">Trial Start Date:</span>
                                        <span class="cwr-detail-value">
                                            {{ $detail->trial_start_date ? \Carbon\Carbon::parse($detail->trial_start_date)->format('d M Y') : 'N/A' }}
                                        </span>
                                    </div>

                                    <div class="cwr-detail-row">
                                        <span class="cwr-detail-label">Trial Days:</span>
                                        <span class="cwr-detail-value">
                                            {{ $detail->trial_days ?? 0 }} Days
                                        </span>
                                    </div>

                                </div>

                            </div>

                            <!-- Address & Settings -->
                            <div class="col-12">

                                <div class="cwr-detail-card">

                                    <div class="cwr-detail-heading">
                                        <i class="fas fa-map-marker-alt"></i>
                                        Address & Settings
                                    </div>

                                    <div class="cwr-detail-row">
                                        <span class="cwr-detail-label">Address:</span>
                                        <span class="cwr-detail-value">
                                            {{ $detail->address ?? 'N/A' }}
                                        </span>
                                    </div>

                                    <div class="cwr-detail-row">
                                        <span class="cwr-detail-label">City / State / Pincode:</span>
                                        <span class="cwr-detail-value">
                                            {{ $detail->cityName ? $detail->cityName->name : 'N/A' }}
                                            /
                                            {{ $detail->pincode ?? 'N/A' }}
                                        </span>
                                    </div>

                                    <div class="cwr-detail-row">
                                        <span class="cwr-detail-label">GST Details:</span>
                                        <span class="cwr-detail-value">
                                            {{ $detail->is_gst ? 'Yes (GST Number: '.$detail->gst.')' : 'No' }}
                                        </span>
                                    </div>

                                    <div class="cwr-detail-row">
                                        <span class="cwr-detail-label">Branch Details:</span>
                                        <span class="cwr-detail-value">
                                            {{ $detail->branch_name ? $detail->branch_name . ' (' . $detail->branch_email . ')' : 'N/A' }}
                                        </span>
                                    </div>

                                </div>

                            </div>

                        </div>

                    @endif

                </div>

                <div class="cwr-modal-footer">

                    <button
                        class="cwr-close-btn"
                        wire:click="$set('viewWorkshopId', null)">
                        Close
                    </button>

                </div>

            </div>

        </div>

    </div>

</div>