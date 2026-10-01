<div class="container-fluid mt-3 carnate-jobcards-report">
    <style>
        .carnate-jobcards-report {
            --carnate-red: #e53935;
            --carnate-red-soft: #fff5f5;
            --carnate-text: #111827;
            --carnate-muted: #64748b;
            --carnate-border: #e2e8f0;
            --carnate-bg: #f7f8fa;
            --carnate-success: #16a34a;
            --carnate-success-soft: #f0fdf4;
            --carnate-warning: #d97706;
            --carnate-warning-soft: #fffbeb;
            --carnate-blue: #2563eb;
            --carnate-blue-soft: #eff6ff;
        }

        .carnate-jobcards-report .report-card {
            background: #fff;
            border: 1px solid var(--carnate-border);
            border-radius: 16px;
            box-shadow: 0 4px 18px rgba(15, 23, 42, .04);
        }

        .carnate-jobcards-report .report-header {
            padding: 20px 22px;
            border-bottom: 1px solid var(--carnate-border);
        }

        .carnate-jobcards-report .report-title {
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--carnate-text);
        }

        .carnate-jobcards-report .report-title-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--carnate-red-soft);
            color: var(--carnate-red);
            font-size: 18px;
        }

        .carnate-jobcards-report .report-title h5 {
            margin: 0;
            font-size: 20px;
            font-weight: 700;
            letter-spacing: -.25px;
        }

        .carnate-jobcards-report .report-title p {
            margin: 3px 0 0;
            color: var(--carnate-muted);
            font-size: 13px;
        }

        .carnate-jobcards-report .filter-area {
            padding: 18px 22px;
            background: #fbfcfd;
            border-bottom: 1px solid var(--carnate-border);
        }

        .carnate-jobcards-report .filter-label {
            display: block;
            margin-bottom: 6px;
            color: #475569;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
        }

        .carnate-jobcards-report .form-control,
        .carnate-jobcards-report .form-select {
            min-height: 40px;
            border: 1px solid var(--carnate-border);
            border-radius: 9px;
            color: var(--carnate-text);
            background-color: #fff;
            font-size: 13px;
            box-shadow: none;
        }

        .carnate-jobcards-report .form-control:focus,
        .carnate-jobcards-report .form-select:focus {
            border-color: rgba(229, 57, 53, .45);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .08);
        }

        .carnate-jobcards-report .search-box {
            position: relative;
        }

        .carnate-jobcards-report .search-box i {
            position: absolute;
            left: 13px;
            top: 13px;
            color: #94a3b8;
            font-size: 14px;
            z-index: 2;
        }

        .carnate-jobcards-report .search-box input {
            padding-left: 36px;
        }

        .carnate-jobcards-report .filter-actions {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .carnate-jobcards-report .btn-export {
            min-height: 40px;
            border-radius: 9px;
            padding: 0 13px;
            font-size: 12px;
            font-weight: 600;
            border: 1px solid var(--carnate-border);
            background: #fff;
            color: #475569;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            transition: all .2s ease;
        }

        .carnate-jobcards-report .btn-export:hover {
            border-color: #cbd5e1;
            background: #f8fafc;
            color: var(--carnate-text);
        }

        .carnate-jobcards-report .btn-export.pdf:hover {
            border-color: rgba(229, 57, 53, .25);
            background: var(--carnate-red-soft);
            color: var(--carnate-red);
        }

        .carnate-jobcards-report .btn-export.excel:hover {
            border-color: rgba(22, 163, 74, .25);
            background: var(--carnate-success-soft);
            color: var(--carnate-success);
        }

        .carnate-jobcards-report .stats-area {
            padding: 20px 22px;
        }

        .carnate-jobcards-report .stat-card {
            height: 100%;
            background: #fff;
            border: 1px solid var(--carnate-border);
            border-radius: 14px;
            padding: 17px;
            position: relative;
            overflow: hidden;
        }

        .carnate-jobcards-report .stat-card::after {
            content: "";
            position: absolute;
            width: 70px;
            height: 70px;
            border-radius: 50%;
            right: -28px;
            bottom: -32px;
            background: rgba(148, 163, 184, .06);
        }

        .carnate-jobcards-report .stat-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 12px;
        }

        .carnate-jobcards-report .stat-label {
            margin: 0 0 7px;
            color: var(--carnate-muted);
            font-size: 12px;
            font-weight: 600;
        }

        .carnate-jobcards-report .stat-value {
            color: var(--carnate-text);
            font-size: 24px;
            font-weight: 750;
            line-height: 1.1;
        }

        .carnate-jobcards-report .stat-icon {
            width: 42px;
            height: 42px;
            flex: 0 0 42px;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f1f5f9;
            color: #475569;
        }

        .carnate-jobcards-report .stat-meta {
            margin-top: 9px;
            color: var(--carnate-muted);
            font-size: 11px;
        }

        .carnate-jobcards-report .stat-meta strong {
            color: #334155;
            font-weight: 700;
        }

        .carnate-jobcards-report .stat-card.red .stat-icon {
            background: var(--carnate-red-soft);
            color: var(--carnate-red);
        }

        .carnate-jobcards-report .stat-card.green .stat-icon {
            background: var(--carnate-success-soft);
            color: var(--carnate-success);
        }

        .carnate-jobcards-report .stat-card.blue .stat-icon {
            background: var(--carnate-blue-soft);
            color: var(--carnate-blue);
        }

        .carnate-jobcards-report .stat-card.gold .stat-icon {
            background: var(--carnate-warning-soft);
            color: var(--carnate-warning);
        }

        .carnate-jobcards-report .table-wrap {
            border-top: 1px solid var(--carnate-border);
        }

        .carnate-jobcards-report .table-responsive {
            overflow-x: auto;
        }

        .carnate-jobcards-report table {
            min-width: 1250px;
            margin-bottom: 0;
        }

        .carnate-jobcards-report .table thead th {
            padding: 13px 15px;
            background: #f8fafc;
            border-bottom: 1px solid var(--carnate-border);
            color: #64748b;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .035em;
            white-space: nowrap;
        }

        .carnate-jobcards-report .table tbody td {
            padding: 14px 15px;
            border-bottom: 1px solid #edf1f5;
            color: #334155;
            font-size: 13px;
            vertical-align: middle;
            white-space: nowrap;
        }

        .carnate-jobcards-report .table tbody tr:last-child td {
            border-bottom: 0;
        }

        .carnate-jobcards-report .table tbody tr {
            transition: background .15s ease;
        }

        .carnate-jobcards-report .table tbody tr:hover {
            background: #fafafa;
        }

        .carnate-jobcards-report .job-number {
            color: var(--carnate-text);
            font-weight: 700;
        }

        .carnate-jobcards-report .customer-name {
            color: var(--carnate-text);
            font-weight: 600;
        }

        .carnate-jobcards-report .vehicle-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 8px;
            border-radius: 7px;
            background: #f1f5f9;
            color: #334155;
            font-size: 11px;
            font-weight: 700;
        }

        .carnate-jobcards-report .amount {
            color: var(--carnate-text);
            font-weight: 700;
        }

        .carnate-jobcards-report .paid {
            color: var(--carnate-success);
            font-weight: 600;
        }

        .carnate-jobcards-report .balance {
            color: var(--carnate-red);
            font-weight: 700;
        }

        .carnate-jobcards-report .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 9px;
            border-radius: 7px;
            font-size: 11px;
            font-weight: 700;
        }

        .carnate-jobcards-report .status-badge::before {
            content: "";
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: currentColor;
        }

        .carnate-jobcards-report .status-open {
            background: var(--carnate-red-soft);
            color: var(--carnate-red);
        }

        .carnate-jobcards-report .status-confirmed {
            background: var(--carnate-blue-soft);
            color: var(--carnate-blue);
        }

        .carnate-jobcards-report .status-completed {
            background: var(--carnate-success-soft);
            color: var(--carnate-success);
        }

        .carnate-jobcards-report .status-closed {
            background: #f1f5f9;
            color: #475569;
        }

        .carnate-jobcards-report .view-btn {
            width: 34px;
            height: 34px;
            border: 1px solid var(--carnate-border);
            border-radius: 9px;
            background: #fff;
            color: #64748b;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all .2s ease;
        }

        .carnate-jobcards-report .view-btn:hover {
            color: var(--carnate-red);
            background: var(--carnate-red-soft);
            border-color: rgba(229, 57, 53, .2);
        }

        .carnate-jobcards-report .pagination-area {
            padding: 15px 20px;
            border-top: 1px solid var(--carnate-border);
        }

        .carnate-jobcards-report .pagination-area small {
            color: var(--carnate-muted);
            font-size: 12px;
        }

        .carnate-jobcards-report .empty-state {
            padding: 60px 20px !important;
            text-align: center;
            color: var(--carnate-muted);
        }

        .carnate-jobcards-report .empty-icon {
            width: 52px;
            height: 52px;
            margin: 0 auto 12px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f1f5f9;
            color: #94a3b8;
            font-size: 20px;
        }

        /* Modal */
        .carnate-jobcards-report .jobcard-modal-backdrop {
            position: fixed;
            inset: 0;
            z-index: 1050;
            background: rgba(15, 23, 42, .48);
            backdrop-filter: blur(3px);
            overflow-y: auto;
        }

        .carnate-jobcards-report .jobcard-modal {
            width: calc(100% - 30px);
            max-width: 1180px;
            margin: 35px auto;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 25px 70px rgba(15, 23, 42, .20);
            overflow: hidden;
        }

        .carnate-jobcards-report .modal-header-modern {
            padding: 18px 22px;
            border-bottom: 1px solid var(--carnate-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            background: #fff;
        }

        .carnate-jobcards-report .modal-title-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .carnate-jobcards-report .modal-title-icon {
            width: 40px;
            height: 40px;
            border-radius: 11px;
            background: var(--carnate-red-soft);
            color: var(--carnate-red);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .carnate-jobcards-report .modal-title {
            margin: 0;
            color: var(--carnate-text);
            font-size: 17px;
            font-weight: 700;
        }

        .carnate-jobcards-report .modal-subtitle {
            margin: 3px 0 0;
            color: var(--carnate-muted);
            font-size: 12px;
        }

        .carnate-jobcards-report .modal-close {
            width: 34px;
            height: 34px;
            border: 1px solid var(--carnate-border);
            border-radius: 9px;
            background: #fff;
            color: #64748b;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .carnate-jobcards-report .modal-close:hover {
            background: #f8fafc;
            color: var(--carnate-text);
        }

        .carnate-jobcards-report .modal-body-modern {
            padding: 22px;
            background: #f8fafc;
        }

        .carnate-jobcards-report .detail-card {
            height: 100%;
            background: #fff;
            border: 1px solid var(--carnate-border);
            border-radius: 13px;
            padding: 17px;
        }

        .carnate-jobcards-report .detail-heading {
            display: flex;
            align-items: center;
            gap: 9px;
            padding-bottom: 12px;
            margin-bottom: 14px;
            border-bottom: 1px solid var(--carnate-border);
            color: var(--carnate-text);
            font-size: 13px;
            font-weight: 700;
        }

        .carnate-jobcards-report .detail-heading i {
            color: var(--carnate-red);
        }

        .carnate-jobcards-report .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 15px;
            margin-bottom: 11px;
            font-size: 12px;
        }

        .carnate-jobcards-report .detail-row:last-child {
            margin-bottom: 0;
        }

        .carnate-jobcards-report .detail-label {
            color: var(--carnate-muted);
        }

        .carnate-jobcards-report .detail-value {
            color: var(--carnate-text);
            font-weight: 600;
            text-align: right;
        }

        .carnate-jobcards-report .detail-value.left {
            text-align: left;
        }

        .carnate-jobcards-report .detail-note {
            color: var(--carnate-muted);
            line-height: 1.6;
            font-size: 12px;
        }

        .carnate-jobcards-report .billing-total {
            padding-top: 11px;
            margin-top: 11px;
            border-top: 1px solid var(--carnate-border);
        }

        .carnate-jobcards-report .billing-final {
            color: var(--carnate-text);
            font-size: 16px;
            font-weight: 750;
        }

        .carnate-jobcards-report .billing-paid {
            color: var(--carnate-success);
            font-weight: 700;
        }

        .carnate-jobcards-report .billing-balance {
            color: var(--carnate-red);
            font-weight: 700;
        }

        .carnate-jobcards-report .detail-table {
            min-width: 650px;
        }

        .carnate-jobcards-report .detail-table th {
            background: #f8fafc;
            color: #64748b;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: .04em;
            font-weight: 700;
            padding: 10px;
            border-bottom: 1px solid var(--carnate-border);
        }

        .carnate-jobcards-report .detail-table td {
            padding: 11px 10px;
            color: #334155;
            font-size: 12px;
            border-bottom: 1px solid #edf1f5;
        }

        .carnate-jobcards-report .detail-table tr:last-child td {
            border-bottom: 0;
        }

        .carnate-jobcards-report .modal-footer-modern {
            padding: 15px 22px;
            border-top: 1px solid var(--carnate-border);
            display: flex;
            justify-content: flex-end;
            background: #fff;
        }

        .carnate-jobcards-report .close-modern {
            min-height: 38px;
            padding: 0 17px;
            border: 1px solid var(--carnate-border);
            border-radius: 9px;
            background: #fff;
            color: #475569;
            font-size: 12px;
            font-weight: 600;
        }

        .carnate-jobcards-report .close-modern:hover {
            background: #f8fafc;
            color: var(--carnate-text);
        }

        @media (max-width: 1199px) {
            .carnate-jobcards-report .report-header {
                align-items: flex-start !important;
            }

            .carnate-jobcards-report .filter-area {
                padding-top: 15px;
            }
        }

        @media (max-width: 767px) {
            .carnate-jobcards-report {
                margin-top: 10px !important;
            }

            .carnate-jobcards-report .report-header {
                padding: 16px;
            }

            .carnate-jobcards-report .report-title h5 {
                font-size: 17px;
            }

            .carnate-jobcards-report .filter-area,
            .carnate-jobcards-report .stats-area {
                padding: 15px;
            }

            .carnate-jobcards-report .filter-actions {
                width: 100%;
            }

            .carnate-jobcards-report .btn-export {
                flex: 1;
                justify-content: center;
            }

            .carnate-jobcards-report .pagination-area {
                flex-direction: column;
                align-items: flex-start !important;
                gap: 10px;
            }

            .carnate-jobcards-report .jobcard-modal {
                width: calc(100% - 16px);
                margin: 15px auto;
            }

            .carnate-jobcards-report .modal-body-modern {
                padding: 14px;
            }

            .carnate-jobcards-report .modal-header-modern {
                padding: 15px;
            }
        }
    </style>

    {{-- Header --}}
    <div class="report-card">
        <div class="report-header d-flex flex-wrap align-items-center justify-content-between gap-3">
            <div class="report-title">
                <div class="report-title-icon">
                    <i class="fas fa-tasks"></i>
                </div>

                <div>
                    <h5>Job Cards Report</h5>
                    <p>Monitor job cards, billing, payments and service status</p>
                </div>
            </div>
        </div>

        {{-- Filters --}}
        <div class="filter-area">
            <div class="row g-3 align-items-end">
                <div class="col-12 col-lg-3">
                    <label class="filter-label">Search</label>
                    <div class="search-box">
                        <i class="bx bx-search"></i>
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Search number, customer..."
                            wire:model.live="search"
                        >
                    </div>
                </div>

                <div class="col-6 col-md-4 col-lg-2">
                    <label class="filter-label">Status</label>
                    <select class="form-select" wire:model.live="statusFilter">
                        <option value="">All Statuses</option>
                        <option value="0">Open</option>
                        <option value="1">Confirmed</option>
                        <option value="2">Completed</option>
                        <option value="3">Closed</option>
                    </select>
                </div>

                <div class="col-6 col-md-4 col-lg-2">
                    <label class="filter-label">Date Range</label>
                    <select class="form-select" wire:model.live="filterType">
                        <option value="">All Time</option>
                        <option value="daily">Today</option>
                        <option value="weekly">This Week</option>
                        <option value="monthly">This Month</option>
                    </select>
                </div>

                <div class="col-6 col-md-4 col-lg-1">
                    <label class="filter-label">From</label>
                    <input
                        type="date"
                        class="form-control"
                        wire:model.live="fromDate"
                    >
                </div>

                <div class="col-6 col-md-4 col-lg-1">
                    <label class="filter-label">To</label>
                    <input
                        type="date"
                        class="form-control"
                        wire:model.live="toDate"
                    >
                </div>

                <div class="col-12 col-lg-3">
                    <label class="filter-label">Export</label>

                    <div class="filter-actions">
                        <button
                            type="button"
                            class="btn-export pdf"
                            wire:click="downloadPDF"
                        >
                            <i class="bx bxs-file-pdf"></i>
                            <span>Export PDF</span>
                        </button>

                        <button
                            type="button"
                            class="btn-export excel"
                            wire:click="downloadExcel"
                        >
                            <i class="bx bxs-spreadsheet"></i>
                            <span>Export Excel</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Statistics --}}
        <div class="stats-area">
            <div class="row g-3">

                {{-- Total --}}
                <div class="col-6 col-xl-3">
                    <div class="stat-card blue">
                        <div class="stat-top">
                            <div>
                                <p class="stat-label">Total Job Cards</p>
                                <div class="stat-value">
                                    {{ $totals['total'] ?? 0 }}
                                </div>
                                <div class="stat-meta">
                                    All matching job cards
                                </div>
                            </div>

                            <div class="stat-icon">
                                <i class="fas fa-file-invoice"></i>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Open / Confirmed --}}
                <div class="col-6 col-xl-3">
                    <div class="stat-card red">
                        <div class="stat-top">
                            <div>
                                <p class="stat-label">Open & Confirmed</p>
                                <div class="stat-value">
                                    {{ ($totals['open'] ?? 0) + ($totals['confirmed'] ?? 0) }}
                                </div>

                                <div class="stat-meta">
                                    Open:
                                    <strong>{{ $totals['open'] ?? 0 }}</strong>
                                    &nbsp;·&nbsp;
                                    Confirmed:
                                    <strong>{{ $totals['confirmed'] ?? 0 }}</strong>
                                </div>
                            </div>

                            <div class="stat-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Completed / Closed --}}
                <div class="col-6 col-xl-3">
                    <div class="stat-card green">
                        <div class="stat-top">
                            <div>
                                <p class="stat-label">Completed & Closed</p>
                                <div class="stat-value">
                                    {{ ($totals['completed'] ?? 0) + ($totals['closed'] ?? 0) }}
                                </div>

                                <div class="stat-meta">
                                    Completed:
                                    <strong>{{ $totals['completed'] ?? 0 }}</strong>
                                    &nbsp;·&nbsp;
                                    Closed:
                                    <strong>{{ $totals['closed'] ?? 0 }}</strong>
                                </div>
                            </div>

                            <div class="stat-icon">
                                <i class="fas fa-check-double"></i>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Billing --}}
                <div class="col-6 col-xl-3">
                    <div class="stat-card gold">
                        <div class="stat-top">
                            <div>
                                <p class="stat-label">Total Value / Balance</p>
                                <div class="stat-value">
                                    ₹{{ number_format($totals['total_amount'] ?? 0, 2) }}
                                </div>

                                <div class="stat-meta">
                                    Balance:
                                    <strong>
                                        ₹{{ number_format($totals['total_balance'] ?? 0, 2) }}
                                    </strong>
                                </div>
                            </div>

                            <div class="stat-icon">
                                <i class="fas fa-wallet"></i>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- Table --}}
        <div class="table-wrap">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Job Card</th>
                            <th>Customer</th>
                            <th>Vehicle No</th>
                            <th>Vehicle</th>
                            <th>Workshop</th>
                            <th>Date</th>
                            <th class="text-end">Final Bill</th>
                            <th class="text-end">Paid</th>
                            <th class="text-end">Balance</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($jobcards as $j)
                            <tr>
                                <td class="text-muted">
                                    {{ $loop->iteration + ($jobcards->currentPage() - 1) * $jobcards->perPage() }}
                                </td>

                                <td>
                                    <span class="job-number">
                                        {{ $j->jobcard_number }}
                                    </span>
                                </td>

                                <td>
                                    <span class="customer-name">
                                        {{ $j->customer_name ?? 'N/A' }}
                                    </span>
                                </td>

                                <td>
                                    <span class="vehicle-badge">
                                        <i class="bx bx-car"></i>
                                        {{ $j->vehical_number ?? 'N/A' }}
                                    </span>
                                </td>

                                <td>
                                    {{ $j->vehical ?? 'N/A' }}
                                </td>

                                <td>
                                    {{ $j->workshop->company_name ??
                                        ($j->workshop
                                            ? $j->workshop->name . ' ' . $j->workshop->lastname
                                            : 'N/A') }}
                                </td>

                                <td>
                                    {{ $j->entry_date
                                        ? \Carbon\Carbon::parse($j->entry_date)->format('d M Y')
                                        : 'N/A' }}
                                </td>

                                <td class="text-end amount">
                                    ₹{{ number_format((float)($j->final_amount ?? $j->amount ?? 0), 2) }}
                                </td>

                                <td class="text-end paid">
                                    ₹{{ number_format((float)($j->advance ?? 0), 2) }}
                                </td>

                                <td class="text-end balance">
                                    ₹{{ number_format((float)($j->balance_amount ?? 0), 2) }}
                                </td>

                                <td>
                                    @switch($j->status)
                                        @case(1)
                                            <span class="status-badge status-confirmed">
                                                Confirmed
                                            </span>
                                            @break

                                        @case(2)
                                            <span class="status-badge status-completed">
                                                Completed
                                            </span>
                                            @break

                                        @case(3)
                                            <span class="status-badge status-closed">
                                                Closed
                                            </span>
                                            @break

                                        @default
                                            <span class="status-badge status-open">
                                                Open
                                            </span>
                                    @endswitch
                                </td>

                                <td class="text-center">
                                    <button
                                        type="button"
                                        class="view-btn"
                                        wire:click="viewJobCard({{ $j->id }})"
                                        title="View Details"
                                    >
                                        <i class="bx bx-show"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12" class="empty-state">
                                    <div class="empty-icon">
                                        <i class="bx bx-file"></i>
                                    </div>
                                    <div class="fw-semibold text-dark mb-1">
                                        No Job Cards Found
                                    </div>
                                    <div>
                                        No job cards match the selected filters.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="pagination-area d-flex justify-content-between align-items-center flex-wrap gap-2">
                <small>
                    Showing {{ $jobcards->firstItem() ?? 0 }}–{{ $jobcards->lastItem() ?? 0 }}
                    of {{ $jobcards->total() }}
                </small>

                {!! $jobcards->links() !!}
            </div>
        </div>
    </div>

    {{-- Details Modal --}}
    @if($detail)
        <div class="jobcard-modal-backdrop">
            <div class="jobcard-modal">

                {{-- Modal Header --}}
                <div class="modal-header-modern">
                    <div class="modal-title-wrap">
                        <div class="modal-title-icon">
                            <i class="fas fa-file-invoice"></i>
                        </div>

                        <div>
                            <h5 class="modal-title">
                                Job Card Details
                            </h5>

                            <div class="modal-subtitle">
                                #{{ $detail->jobcard_number ?? '' }}
                            </div>
                        </div>
                    </div>

                    <button
                        type="button"
                        class="modal-close"
                        wire:click="$set('viewJobCardId', null)"
                        aria-label="Close"
                    >
                        <i class="bx bx-x fs-5"></i>
                    </button>
                </div>

                {{-- Modal Body --}}
                <div class="modal-body-modern">
                    <div class="row g-3">

                        {{-- General Information --}}
                        <div class="col-12 col-md-4">
                            <div class="detail-card">

                                <div class="detail-heading">
                                    <i class="fas fa-info-circle"></i>
                                    General Information
                                </div>

                                <div class="detail-row">
                                    <span class="detail-label">Job Card #</span>
                                    <span class="detail-value">
                                        {{ $detail->jobcard_number }}
                                    </span>
                                </div>

                                <div class="detail-row">
                                    <span class="detail-label">Date Created</span>
                                    <span class="detail-value">
                                        {{ $detail->entry_date
                                            ? \Carbon\Carbon::parse($detail->entry_date)->format('d M Y, h:i A')
                                            : 'N/A' }}
                                    </span>
                                </div>

                                <div class="detail-row">
                                    <span class="detail-label">Workshop</span>
                                    <span class="detail-value">
                                        {{ $detail->workshop->company_name ??
                                            ($detail->workshop
                                                ? $detail->workshop->name . ' ' . $detail->workshop->lastname
                                                : 'N/A') }}
                                    </span>
                                </div>

                                <div class="detail-row">
                                    <span class="detail-label">Status</span>
                                    <span class="detail-value">
                                        @switch($detail->status)
                                            @case(1)
                                                <span class="status-badge status-confirmed">Confirmed</span>
                                                @break

                                            @case(2)
                                                <span class="status-badge status-completed">Completed</span>
                                                @break

                                            @case(3)
                                                <span class="status-badge status-closed">Closed</span>
                                                @break

                                            @default
                                                <span class="status-badge status-open">Open</span>
                                        @endswitch
                                    </span>
                                </div>

                                <div class="mt-3 pt-3 border-top">
                                    <div class="detail-label mb-1">
                                        Notes
                                    </div>

                                    <div class="detail-note">
                                        {{ $detail->notes ?? 'No special notes.' }}
                                    </div>
                                </div>

                            </div>
                        </div>

                        {{-- Customer & Vehicle --}}
                        <div class="col-12 col-md-4">
                            <div class="detail-card">

                                <div class="detail-heading">
                                    <i class="fas fa-car"></i>
                                    Customer & Vehicle
                                </div>

                                <div class="detail-row">
                                    <span class="detail-label">Customer</span>
                                    <span class="detail-value">
                                        {{ $detail->customer_name ??
                                            ($detail->customer
                                                ? $detail->customer->name . ' ' . $detail->customer->lastname
                                                : 'N/A') }}
                                    </span>
                                </div>

                                <div class="detail-row">
                                    <span class="detail-label">Mobile</span>
                                    <span class="detail-value">
                                        {{ $detail->customer->mobile_no ?? 'N/A' }}
                                    </span>
                                </div>

                                <div class="detail-row">
                                    <span class="detail-label">Vehicle Model</span>
                                    <span class="detail-value">
                                        {{ $detail->vehical ?? 'N/A' }}
                                    </span>
                                </div>

                                <div class="detail-row">
                                    <span class="detail-label">Plate Number</span>
                                    <span class="detail-value">
                                        <span class="vehicle-badge">
                                            {{ $detail->vehical_number ?? 'N/A' }}
                                        </span>
                                    </span>
                                </div>

                                <div class="detail-row">
                                    <span class="detail-label">KM Running</span>
                                    <span class="detail-value">
                                        {{ number_format((float)($detail->km_runing ?? 0)) }} km
                                    </span>
                                </div>

                                <div class="detail-row">
                                    <span class="detail-label">Fuel Level</span>
                                    <span class="detail-value">
                                        {{ $detail->fual_level ?? 'N/A' }}
                                    </span>
                                </div>

                            </div>
                        </div>

                        {{-- Billing --}}
                        <div class="col-12 col-md-4">
                            <div class="detail-card">

                                <div class="detail-heading">
                                    <i class="fas fa-calculator"></i>
                                    Billing Summary
                                </div>

                                <div class="detail-row">
                                    <span class="detail-label">Base Amount</span>
                                    <span class="detail-value">
                                        ₹{{ number_format((float)($detail->amount ?? 0), 2) }}
                                    </span>
                                </div>

                                <div class="detail-row">
                                    <span class="detail-label">Discount</span>
                                    <span class="detail-value" style="color:#e53935;">
                                        -₹{{ number_format((float)($detail->discount ?? 0), 2) }}
                                    </span>
                                </div>

                                <div class="billing-total">
                                    <div class="detail-row">
                                        <span class="detail-label">Final Total</span>
                                        <span class="billing-final">
                                            ₹{{ number_format((float)($detail->final_amount ?? $detail->amount ?? 0), 2) }}
                                        </span>
                                    </div>
                                </div>

                                <div class="detail-row">
                                    <span class="detail-label">Advance Paid</span>
                                    <span class="billing-paid">
                                        ₹{{ number_format((float)($detail->advance ?? 0), 2) }}
                                    </span>
                                </div>

                                <div class="billing-total">
                                    <div class="detail-row">
                                        <span class="detail-label">Outstanding</span>
                                        <span class="billing-balance">
                                            ₹{{ number_format((float)($detail->balance_amount ?? 0), 2) }}
                                        </span>
                                    </div>
                                </div>

                                <div class="detail-row">
                                    <span class="detail-label">Payment Type</span>
                                    <span class="detail-value">
                                        {{ $detail->payment_type ?? 'N/A' }}
                                    </span>
                                </div>

                            </div>
                        </div>

                        {{-- Spare Parts --}}
                        <div class="col-12 col-lg-6">
                            <div class="detail-card">

                                <div class="detail-heading">
                                    <i class="fas fa-cogs"></i>
                                    Spare Parts Used
                                </div>

                                <div class="table-responsive">
                                    <table class="table detail-table align-middle mb-0">
                                        <thead>
                                            <tr>
                                                <th>Part Name</th>
                                                <th class="text-center">Qty</th>
                                                <th class="text-end">Price</th>
                                                <th class="text-end">Tax %</th>
                                                <th class="text-end">Total</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @forelse($detail->jobCardSpareParts as $part)
                                                @php
                                                    $partQty = (float)($part->qty ?? 1);
                                                    $partPrice = (float)($part->price ?? 0);
                                                @endphp

                                                <tr>
                                                    <td>
                                                        <div class="fw-semibold text-dark">
                                                            {{ $part->productStock->sparePart->name ?? 'Spare Part' }}
                                                        </div>

                                                        <small class="text-muted">
                                                            {{ $part->productStock->sparePart->sku ?? 'N/A' }}
                                                        </small>
                                                    </td>

                                                    <td class="text-center">
                                                        {{ $partQty }}
                                                    </td>

                                                    <td class="text-end">
                                                        ₹{{ number_format($partPrice, 2) }}
                                                    </td>

                                                    <td class="text-end">
                                                        {{ $part->tax_percentage ?? 0 }}%
                                                    </td>

                                                    <td class="text-end fw-semibold">
                                                        ₹{{ number_format($partQty * $partPrice, 2) }}
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center py-4 text-muted">
                                                        No spare parts recorded.
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>

                        {{-- Labours --}}
                        <div class="col-12 col-lg-6">
                            <div class="detail-card">

                                <div class="detail-heading">
                                    <i class="fas fa-wrench"></i>
                                    Labours & Extra Charges
                                </div>

                                <div class="table-responsive">
                                    <table class="table detail-table align-middle mb-0">
                                        <thead>
                                            <tr>
                                                <th>Label / Charge Type</th>
                                                <th class="text-center">Qty</th>
                                                <th class="text-end">Rate</th>
                                                <th class="text-end">Total</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @forelse($detail->labours as $labour)
                                                @php
                                                    $labourQty = (float)($labour->qty ?? 1);
                                                    $labourRate = (float)($labour->amount ?? $labour->charges ?? 0);
                                                @endphp

                                                <tr>
                                                    <td>
                                                        <div class="fw-semibold text-dark">
                                                            {{ $labour->label }}
                                                        </div>

                                                        <small class="text-muted">
                                                            {{ ucfirst($labour->charge_type ?? 'labour') }}
                                                        </small>
                                                    </td>

                                                    <td class="text-center">
                                                        {{ $labourQty }}
                                                    </td>

                                                    <td class="text-end">
                                                        ₹{{ number_format($labourRate, 2) }}
                                                    </td>

                                                    <td class="text-end fw-semibold">
                                                        ₹{{ number_format($labourQty * $labourRate, 2) }}
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center py-4 text-muted">
                                                        No labour or extra charges recorded.
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

                {{-- Modal Footer --}}
                <div class="modal-footer-modern">
                    <button
                        type="button"
                        class="close-modern"
                        wire:click="$set('viewJobCardId', null)"
                    >
                        Close
                    </button>
                </div>

            </div>
        </div>
    @endif
</div>