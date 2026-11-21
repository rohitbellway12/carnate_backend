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
            --cwr-red-dark: #d32f2f;
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

        /* Page Header Card */
        .carnate-workshops-report .cwr-page-header {
            background: var(--cwr-card);
            border: 1px solid var(--cwr-border);
            border-radius: 14px;
            padding: 18px 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            box-shadow: 0 2px 8px rgba(15, 23, 42, 0.03);
            margin-bottom: 18px;
        }

        .carnate-workshops-report .cwr-title-wrap {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .carnate-workshops-report .cwr-title-icon {
            width: 44px;
            height: 44px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 11px;
            background: var(--cwr-red-soft);
            color: var(--cwr-red);
            font-size: 19px;
            flex-shrink: 0;
        }

        .carnate-workshops-report .cwr-title {
            margin: 0;
            color: var(--cwr-text);
            font-size: 19px;
            font-weight: 700;
            line-height: 1.2;
        }

        .carnate-workshops-report .cwr-subtitle {
            margin: 4px 0 0;
            color: var(--cwr-muted);
            font-size: 13px;
        }

        /* Export Action Buttons */
        .carnate-workshops-report .cwr-export-group {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-shrink: 0;
        }

        .carnate-workshops-report .cwr-export-btn {
            min-height: 40px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 0 15px;
            border: 1px solid var(--cwr-border);
            border-radius: 9px;
            font-size: 13px;
            font-weight: 600;
            transition: all .2s ease;
            cursor: pointer;
            text-decoration: none;
        }

        .carnate-workshops-report .cwr-pdf-btn {
            color: #dc2626;
            background: #fff;
            border-color: #fecaca;
        }

        .carnate-workshops-report .cwr-pdf-btn:hover {
            background: var(--cwr-red-soft);
            border-color: #f87171;
            transform: translateY(-1px);
        }

        .carnate-workshops-report .cwr-excel-btn {
            color: #15803d;
            background: #fff;
            border-color: #bbf7d0;
        }

        .carnate-workshops-report .cwr-excel-btn:hover {
            background: var(--cwr-green-soft);
            border-color: #86efac;
            transform: translateY(-1px);
        }

        /* Summary Cards */
        .carnate-workshops-report .cwr-summary-row {
            margin-bottom: 18px;
        }

        .carnate-workshops-report .cwr-summary-card {
            height: 100%;
            padding: 16px 20px;
            border: 1px solid var(--cwr-border);
            border-radius: 14px;
            background: #fff;
            box-shadow: 0 2px 8px rgba(15, 23, 42, 0.025);
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .carnate-workshops-report .cwr-summary-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(15, 23, 42, .06);
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
            font-size: 13px;
            font-weight: 600;
        }

        .carnate-workshops-report .cwr-summary-value {
            color: var(--cwr-text);
            font-size: 26px;
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
            font-size: 19px;
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

        /* Filter Card */
        .carnate-workshops-report .cwr-filter-card {
            background: var(--cwr-card);
            border: 1px solid var(--cwr-border);
            border-radius: 14px;
            padding: 16px 20px;
            margin-bottom: 18px;
            box-shadow: 0 2px 8px rgba(15, 23, 42, 0.025);
        }

        .carnate-workshops-report .cwr-filters-grid {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-end;
            gap: 14px;
        }

        .carnate-workshops-report .cwr-filter-item {
            flex: 1 1 140px;
            min-width: 140px;
        }

        .carnate-workshops-report .cwr-filter-item.search-filter {
            flex: 2 1 240px;
            min-width: 200px;
        }

        .carnate-workshops-report .cwr-filter-item.filter-reset {
            flex: 0 0 auto;
            min-width: auto;
        }

        .carnate-workshops-report .cwr-filter-label {
            display: block;
            margin-bottom: 6px;
            color: #475569;
            font-size: 12px;
            font-weight: 600;
        }

        .carnate-workshops-report .cwr-input-group {
            position: relative;
            display: flex;
            align-items: center;
        }

        .carnate-workshops-report .cwr-input-group i {
            position: absolute;
            left: 12px;
            color: #94a3b8;
            font-size: 17px;
            pointer-events: none;
        }

        .carnate-workshops-report .cwr-input-group .form-control {
            padding-left: 36px;
        }

        .carnate-workshops-report .form-control,
        .carnate-workshops-report .form-select {
            min-height: 42px;
            border: 1px solid var(--cwr-border);
            border-radius: 9px;
            color: var(--cwr-text);
            background: #fff;
            box-shadow: none;
            font-size: 13.5px;
            padding: 0 12px;
            transition: all .2s ease;
        }

        .carnate-workshops-report .form-control:focus,
        .carnate-workshops-report .form-select:focus {
            border-color: rgba(229, 57, 53, .55);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .08);
            outline: none;
        }

        .carnate-workshops-report .cwr-reset-btn {
            min-height: 42px;
            padding: 0 14px;
            border: 1px solid var(--cwr-border);
            border-radius: 9px;
            background: #fff;
            color: #64748b;
            font-size: 13px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            cursor: pointer;
            transition: all .2s ease;
        }

        .carnate-workshops-report .cwr-reset-btn:hover {
            background: #f8fafc;
            color: var(--cwr-red);
            border-color: #fecaca;
        }

        /* Table Card */
        .carnate-workshops-report .cwr-table-card {
            background: var(--cwr-card);
            border: 1px solid var(--cwr-border);
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(15, 23, 42, 0.03);
        }

        .carnate-workshops-report .cwr-table-wrap {
            overflow-x: auto;
            width: 100%;
        }

        .carnate-workshops-report .cwr-table {
            width: 100%;
            min-width: 980px;
            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .carnate-workshops-report .cwr-table thead th {
            padding: 14px 16px;
            background: #f8fafc;
            color: #475569;
            border-bottom: 1px solid var(--cwr-border);
            font-size: 11.5px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
            white-space: nowrap;
        }

        .carnate-workshops-report .cwr-table tbody td {
            padding: 13px 16px;
            color: var(--cwr-text);
            border-bottom: 1px solid #f1f5f9;
            font-size: 13.5px;
            vertical-align: middle;
        }

        .carnate-workshops-report .cwr-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .carnate-workshops-report .cwr-table tbody tr:hover {
            background: #f8fafc;
        }

        .carnate-workshops-report .cwr-sno {
            color: var(--cwr-muted);
            font-weight: 600;
            font-size: 13px;
        }

        .carnate-workshops-report .cwr-vendor {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .carnate-workshops-report .cwr-vendor-avatar {
            width: 34px;
            height: 34px;
            flex: 0 0 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 9px;
            background: var(--cwr-red-soft);
            color: var(--cwr-red);
            font-size: 14px;
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
            font-weight: 500;
        }

        .carnate-workshops-report .cwr-status {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 11px;
            border-radius: 999px;
            font-size: 11.5px;
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
            font-size: 13px;
        }

        .carnate-workshops-report .cwr-view-btn {
            width: 34px;
            height: 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--cwr-border);
            border-radius: 8px;
            background: #fff;
            color: #64748b;
            font-size: 16px;
            cursor: pointer;
            transition: all .2s ease;
        }

        .carnate-workshops-report .cwr-view-btn:hover {
            color: var(--cwr-red);
            background: var(--cwr-red-soft);
            border-color: #fecaca;
            transform: translateY(-1px);
        }

        .carnate-workshops-report .cwr-pagination {
            padding: 15px 20px;
            border-top: 1px solid var(--cwr-border);
            background: #fff;
        }

        .carnate-workshops-report .cwr-showing {
            color: var(--cwr-muted);
            font-size: 13px;
        }

        .carnate-workshops-report .cwr-empty {
            padding: 50px 20px;
            text-align: center;
        }

        .carnate-workshops-report .cwr-empty-icon {
            width: 54px;
            height: 54px;
            margin: 0 auto 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            background: var(--cwr-soft);
            color: #94a3b8;
            font-size: 22px;
        }

        .carnate-workshops-report .cwr-empty-title {
            color: #475569;
            font-size: 14px;
            font-weight: 600;
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
            background: rgba(15, 23, 42, .55);
            backdrop-filter: blur(2px);
        }

        .carnate-workshops-report .cwr-modal-dialog {
            position: relative;
            z-index: 2;
            max-width: 860px;
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
            width: 36px;
            height: 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 9px;
            background: var(--cwr-red-soft);
            color: var(--cwr-red);
            font-size: 16px;
        }

        .carnate-workshops-report .cwr-close {
            width: 34px;
            height: 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--cwr-border);
            border-radius: 8px;
            background: #fff;
            color: #64748b;
            cursor: pointer;
            transition: all .2s ease;
        }

        .carnate-workshops-report .cwr-close:hover {
            background: var(--cwr-red-soft);
            color: var(--cwr-red);
            border-color: #fecaca;
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
            min-width: 95px;
            padding: 0 18px;
            border: 1px solid var(--cwr-border);
            border-radius: 9px;
            background: #fff;
            color: #64748b;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all .2s ease;
        }

        .carnate-workshops-report .cwr-close-btn:hover {
            background: #f8fafc;
            color: var(--cwr-text);
            border-color: #cbd5e1;
        }

        @media (max-width: 991px) {
            .carnate-workshops-report .cwr-page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 14px;
            }

            .carnate-workshops-report .cwr-export-group {
                width: 100%;
            }

            .carnate-workshops-report .cwr-export-btn {
                flex: 1;
                justify-content: center;
            }
        }

        @media (max-width: 767px) {
            .carnate-workshops-report .cwr-filters-grid {
                display: grid;
                grid-template-columns: 1fr 1fr;
            }

            .carnate-workshops-report .cwr-filter-item,
            .carnate-workshops-report .cwr-filter-item.search-filter {
                width: 100%;
                min-width: 0;
            }

            .carnate-workshops-report .cwr-filter-item.filter-reset {
                grid-column: 1 / -1;
            }

            .carnate-workshops-report .cwr-reset-btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>

    {{-- 1. PAGE HEADER --}}
    <div class="cwr-page-header">

        <div class="cwr-title-wrap">
            <span class="cwr-title-icon">
                <i class="fas fa-chart-line"></i>
            </span>

            <div>
                <h5 class="cwr-title">Workshops Report</h5>
                <p class="cwr-subtitle">Monitor workshop vendors, subscriptions and activity</p>
            </div>
        </div>

        {{-- Export Action Buttons --}}
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

    {{-- 2. SUMMARY METRICS CARDS --}}
    <div class="cwr-summary-row">
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

    {{-- 3. DEDICATED FILTER CARD --}}
    <div class="cwr-filter-card">

        <div class="cwr-filters-grid">

            <!-- Search -->
            <div class="cwr-filter-item search-filter">
                <label class="cwr-filter-label">Search</label>
                <div class="cwr-input-group">
                    <i class="bx bx-search"></i>
                    <input
                        type="text"
                        class="form-control"
                        placeholder="Search name, company, email, mobile..."
                        wire:model.live.debounce.300ms="search">
                </div>
            </div>

            <!-- Status Filter -->
            <div class="cwr-filter-item">
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

            <!-- Date Range Filter -->
            <div class="cwr-filter-item">
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
            <div class="cwr-filter-item">
                <label class="cwr-filter-label">From</label>
                <input
                    type="date"
                    class="form-control"
                    wire:model.live="fromDate">
            </div>

            <!-- To Date -->
            <div class="cwr-filter-item">
                <label class="cwr-filter-label">To</label>
                <input
                    type="date"
                    class="form-control"
                    wire:model.live="toDate">
            </div>

            <!-- Reset Filters -->
            @if(!empty($search) || !empty($statusFilter) || !empty($filterType) || !empty($fromDate) || !empty($toDate))
                <div class="cwr-filter-item filter-reset">
                    <label class="cwr-filter-label">&nbsp;</label>
                    <button
                        type="button"
                        class="cwr-reset-btn"
                        wire:click="resetFilters"
                        title="Clear Filters">
                        <i class="bx bx-x"></i> Clear
                    </button>
                </div>
            @endif

        </div>

    </div>

    {{-- 4. REPORT TABLE CARD --}}
    <div class="cwr-table-card">

        <div class="cwr-table-wrap">

            <table class="cwr-table">

                <thead>
                    <tr>
                        <th style="width: 50px;" class="text-center">#</th>
                        <th style="min-width: 170px;">Vendor Name</th>
                        <th style="min-width: 140px;">Company Name</th>
                        <th style="min-width: 160px;">Email</th>
                        <th style="min-width: 120px;">Mobile</th>
                        <th style="min-width: 100px;">City</th>
                        <th style="min-width: 110px;">Status</th>
                        <th style="min-width: 110px;">Join Date</th>
                        <th style="width: 70px;" class="text-center">Action</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($workshops as $w)

                        <tr>

                            <td class="text-center">
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
                                    {{ $w->company_name ?: 'N/A' }}
                                </span>
                            </td>

                            <td>
                                <span class="cwr-email">
                                    {{ $w->email ?: 'N/A' }}
                                </span>
                            </td>

                            <td>
                                <span class="cwr-mobile">
                                    {{ $w->mobile_no ?: 'N/A' }}
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
                                        Trial Mode
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
                                    <i class="bx bx-calendar me-1"></i>
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

    {{-- 5. DETAILS MODAL --}}
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
                                            {{ $detail->email ?: 'N/A' }}
                                        </span>
                                    </div>

                                    <div class="cwr-detail-row">
                                        <span class="cwr-detail-label">Mobile:</span>
                                        <span class="cwr-detail-value">
                                            {{ $detail->mobile_no ?: 'N/A' }}
                                        </span>
                                    </div>

                                    <div class="cwr-detail-row">
                                        <span class="cwr-detail-label">Join Date:</span>
                                        <span class="cwr-detail-value">
                                            {{ \Carbon\Carbon::parse($detail->created_at)->format('d M Y, h:i A') }}
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
                        type="button"
                        class="cwr-close-btn"
                        wire:click="$set('viewWorkshopId', null)">
                        Close
                    </button>

                </div>

            </div>

        </div>

    </div>

</div>
