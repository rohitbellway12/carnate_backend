<div class="container-fluid mt-3 carnate-orders-report">
    <style>
        .carnate-orders-report {
            --carnate-red: #e53935;
            --carnate-red-soft: #fff5f5;
            --carnate-text: #111827;
            --carnate-muted: #64748b;
            --carnate-border: #e2e8f0;
            --carnate-success: #16a34a;
            --carnate-success-soft: #f0fdf4;
            --carnate-blue: #2563eb;
            --carnate-blue-soft: #eff6ff;
            --carnate-warning: #d97706;
            --carnate-warning-soft: #fffbeb;
        }

        .carnate-orders-report .report-card {
            background: #fff;
            border: 1px solid var(--carnate-border);
            border-radius: 16px;
            box-shadow: 0 4px 18px rgba(15, 23, 42, .04);
            overflow: hidden;
        }

        .carnate-orders-report .report-header {
            padding: 20px 22px;
            border-bottom: 1px solid var(--carnate-border);
        }

        .carnate-orders-report .report-title {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .carnate-orders-report .report-title-icon {
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

        .carnate-orders-report .report-title h5 {
            margin: 0;
            color: var(--carnate-text);
            font-size: 20px;
            font-weight: 700;
            letter-spacing: -.25px;
        }

        .carnate-orders-report .report-title p {
            margin: 3px 0 0;
            color: var(--carnate-muted);
            font-size: 13px;
        }

        .carnate-orders-report .filter-area {
            padding: 18px 22px;
            background: #fbfcfd;
            border-bottom: 1px solid var(--carnate-border);
        }

        .carnate-orders-report .filter-label {
            display: block;
            margin-bottom: 6px;
            color: #475569;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
        }

        .carnate-orders-report .form-control,
        .carnate-orders-report .form-select {
            min-height: 40px;
            border: 1px solid var(--carnate-border);
            border-radius: 9px;
            color: var(--carnate-text);
            background: #fff;
            font-size: 13px;
            box-shadow: none;
        }

        .carnate-orders-report .form-control:focus,
        .carnate-orders-report .form-select:focus {
            border-color: rgba(229, 57, 53, .45);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .08);
        }

        .carnate-orders-report .search-box {
            position: relative;
        }

        .carnate-orders-report .search-box i {
            position: absolute;
            left: 13px;
            top: 13px;
            z-index: 2;
            color: #94a3b8;
            font-size: 14px;
        }

        .carnate-orders-report .search-box input {
            padding-left: 36px;
        }

        .carnate-orders-report .filter-actions {
            display: flex;
            gap: 8px;
        }

        .carnate-orders-report .btn-export {
            min-height: 40px;
            border: 1px solid var(--carnate-border);
            border-radius: 9px;
            background: #fff;
            color: #475569;
            padding: 0 13px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            font-size: 12px;
            font-weight: 600;
            transition: all .2s ease;
        }

        .carnate-orders-report .btn-export:hover {
            background: #f8fafc;
            color: var(--carnate-text);
        }

        .carnate-orders-report .btn-export.pdf:hover {
            background: var(--carnate-red-soft);
            border-color: rgba(229, 57, 53, .22);
            color: var(--carnate-red);
        }

        .carnate-orders-report .btn-export.excel:hover {
            background: var(--carnate-success-soft);
            border-color: rgba(22, 163, 74, .22);
            color: var(--carnate-success);
        }

        .carnate-orders-report .stats-area {
            padding: 20px 22px;
        }

        .carnate-orders-report .stat-card {
            height: 100%;
            background: #fff;
            border: 1px solid var(--carnate-border);
            border-radius: 14px;
            padding: 17px;
            position: relative;
            overflow: hidden;
        }

        .carnate-orders-report .stat-card::after {
            content: "";
            position: absolute;
            width: 70px;
            height: 70px;
            right: -28px;
            bottom: -32px;
            border-radius: 50%;
            background: rgba(148, 163, 184, .06);
        }

        .carnate-orders-report .stat-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 12px;
        }

        .carnate-orders-report .stat-label {
            margin: 0 0 7px;
            color: var(--carnate-muted);
            font-size: 12px;
            font-weight: 600;
        }

        .carnate-orders-report .stat-value {
            color: var(--carnate-text);
            font-size: 24px;
            font-weight: 750;
            line-height: 1.1;
        }

        .carnate-orders-report .stat-icon {
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

        .carnate-orders-report .stat-meta {
            margin-top: 9px;
            color: var(--carnate-muted);
            font-size: 11px;
        }

        .carnate-orders-report .stat-meta strong {
            color: #334155;
            font-weight: 700;
        }

        .carnate-orders-report .stat-card.red .stat-icon {
            background: var(--carnate-red-soft);
            color: var(--carnate-red);
        }

        .carnate-orders-report .stat-card.green .stat-icon {
            background: var(--carnate-success-soft);
            color: var(--carnate-success);
        }

        .carnate-orders-report .stat-card.blue .stat-icon {
            background: var(--carnate-blue-soft);
            color: var(--carnate-blue);
        }

        .carnate-orders-report .stat-card.gold .stat-icon {
            background: var(--carnate-warning-soft);
            color: var(--carnate-warning);
        }

        .carnate-orders-report .table-wrap {
            border-top: 1px solid var(--carnate-border);
        }

        .carnate-orders-report .table-responsive {
            overflow-x: auto;
        }

        .carnate-orders-report .main-table {
            min-width: 1250px;
            margin-bottom: 0;
        }

        .carnate-orders-report .main-table thead th {
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

        .carnate-orders-report .main-table tbody td {
            padding: 14px 15px;
            border-bottom: 1px solid #edf1f5;
            color: #334155;
            font-size: 13px;
            vertical-align: middle;
            white-space: nowrap;
        }

        .carnate-orders-report .main-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .carnate-orders-report .main-table tbody tr {
            transition: background .15s ease;
        }

        .carnate-orders-report .main-table tbody tr:hover {
            background: #fafafa;
        }

        .carnate-orders-report .invoice-number {
            color: var(--carnate-text);
            font-weight: 700;
        }

        .carnate-orders-report .items-cell {
            max-width: 250px;
        }

        .carnate-orders-report .items-cell .items-text {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            color: #334155;
        }

        .carnate-orders-report .vendor-name {
            color: var(--carnate-text);
            font-weight: 600;
        }

        .carnate-orders-report .date-text {
            color: #64748b;
            font-size: 12px;
        }

        .carnate-orders-report .amount {
            color: var(--carnate-text);
            font-weight: 700;
        }

        .carnate-orders-report .quantity-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 58px;
            padding: 6px 9px;
            border-radius: 7px;
            background: #f1f5f9;
            color: #475569;
            font-size: 11px;
            font-weight: 700;
        }

        .carnate-orders-report .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 9px;
            border-radius: 7px;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        .carnate-orders-report .status-badge::before {
            content: "";
            width: 5px;
            height: 5px;
            flex: 0 0 5px;
            border-radius: 50%;
            background: currentColor;
        }

        .carnate-orders-report .status-pending {
            background: var(--carnate-red-soft);
            color: var(--carnate-red);
        }

        .carnate-orders-report .status-success {
            background: var(--carnate-success-soft);
            color: var(--carnate-success);
        }

        .carnate-orders-report .status-warning {
            background: var(--carnate-warning-soft);
            color: var(--carnate-warning);
        }

        .carnate-orders-report .status-blue {
            background: var(--carnate-blue-soft);
            color: var(--carnate-blue);
        }

        .carnate-orders-report .status-neutral {
            background: #f1f5f9;
            color: #475569;
        }

        .carnate-orders-report .view-btn {
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

        .carnate-orders-report .view-btn:hover {
            color: var(--carnate-red);
            background: var(--carnate-red-soft);
            border-color: rgba(229, 57, 53, .2);
        }

        .carnate-orders-report .pagination-area {
            padding: 15px 20px;
            border-top: 1px solid var(--carnate-border);
        }

        .carnate-orders-report .pagination-area small {
            color: var(--carnate-muted);
            font-size: 12px;
        }

        .carnate-orders-report .empty-state {
            padding: 60px 20px !important;
            text-align: center;
            color: var(--carnate-muted);
        }

        .carnate-orders-report .empty-icon {
            width: 52px;
            height: 52px;
            margin: 0 auto 12px;
            border-radius: 14px;
            background: #f1f5f9;
            color: #94a3b8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        /* Modal */
        .carnate-orders-report .order-modal-backdrop {
            position: fixed;
            inset: 0;
            z-index: 1050;
            background: rgba(15, 23, 42, .48);
            backdrop-filter: blur(3px);
            overflow-y: auto;
        }

        .carnate-orders-report .order-modal {
            width: calc(100% - 30px);
            max-width: 1180px;
            margin: 35px auto;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 25px 70px rgba(15, 23, 42, .20);
            overflow: hidden;
        }

        .carnate-orders-report .modal-header-modern {
            padding: 18px 22px;
            border-bottom: 1px solid var(--carnate-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .carnate-orders-report .modal-title-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .carnate-orders-report .modal-title-icon {
            width: 40px;
            height: 40px;
            border-radius: 11px;
            background: var(--carnate-red-soft);
            color: var(--carnate-red);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .carnate-orders-report .modal-title {
            margin: 0;
            color: var(--carnate-text);
            font-size: 17px;
            font-weight: 700;
        }

        .carnate-orders-report .modal-subtitle {
            margin-top: 3px;
            color: var(--carnate-muted);
            font-size: 12px;
        }

        .carnate-orders-report .modal-close {
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

        .carnate-orders-report .modal-close:hover {
            background: #f8fafc;
            color: var(--carnate-text);
        }

        .carnate-orders-report .modal-body-modern {
            padding: 22px;
            background: #f8fafc;
        }

        .carnate-orders-report .detail-card {
            height: 100%;
            background: #fff;
            border: 1px solid var(--carnate-border);
            border-radius: 13px;
            padding: 17px;
        }

        .carnate-orders-report .detail-heading {
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

        .carnate-orders-report .detail-heading i {
            color: var(--carnate-red);
        }

        .carnate-orders-report .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 15px;
            margin-bottom: 11px;
            font-size: 12px;
        }

        .carnate-orders-report .detail-row:last-child {
            margin-bottom: 0;
        }

        .carnate-orders-report .detail-label {
            color: var(--carnate-muted);
        }

        .carnate-orders-report .detail-value {
            color: var(--carnate-text);
            font-weight: 600;
            text-align: right;
        }

        .carnate-orders-report .detail-note {
            color: var(--carnate-red);
            font-size: 12px;
            line-height: 1.6;
        }

        .carnate-orders-report .detail-table {
            min-width: 900px;
        }

        .carnate-orders-report .detail-table th {
            padding: 10px;
            background: #f8fafc;
            border-bottom: 1px solid var(--carnate-border);
            color: #64748b;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
            white-space: nowrap;
        }

        .carnate-orders-report .detail-table td {
            padding: 11px 10px;
            color: #334155;
            font-size: 12px;
            border-bottom: 1px solid #edf1f5;
            vertical-align: middle;
        }

        .carnate-orders-report .detail-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .carnate-orders-report .item-name {
            color: var(--carnate-text);
            font-weight: 600;
        }

        .carnate-orders-report .sku {
            color: #94a3b8;
            font-size: 10px;
        }

        .carnate-orders-report .vendor-mobile {
            color: #94a3b8;
            font-size: 10px;
            margin-top: 2px;
        }

        .carnate-orders-report .modal-footer-modern {
            padding: 15px 22px;
            border-top: 1px solid var(--carnate-border);
            display: flex;
            justify-content: flex-end;
        }

        .carnate-orders-report .close-modern {
            min-height: 38px;
            padding: 0 17px;
            border: 1px solid var(--carnate-border);
            border-radius: 9px;
            background: #fff;
            color: #475569;
            font-size: 12px;
            font-weight: 600;
        }

        .carnate-orders-report .close-modern:hover {
            background: #f8fafc;
            color: var(--carnate-text);
        }

        @media (max-width: 991px) {
            .carnate-orders-report .filter-actions {
                width: 100%;
            }

            .carnate-orders-report .btn-export {
                flex: 1;
            }
        }

        @media (max-width: 767px) {
            .carnate-orders-report {
                margin-top: 10px !important;
            }

            .carnate-orders-report .report-header,
            .carnate-orders-report .filter-area,
            .carnate-orders-report .stats-area {
                padding: 15px;
            }

            .carnate-orders-report .report-title h5 {
                font-size: 17px;
            }

            .carnate-orders-report .pagination-area {
                flex-direction: column;
                align-items: flex-start !important;
            }

            .carnate-orders-report .order-modal {
                width: calc(100% - 16px);
                margin: 15px auto;
            }

            .carnate-orders-report .modal-header-modern {
                padding: 15px;
            }

            .carnate-orders-report .modal-body-modern {
                padding: 14px;
            }
        }
    </style>

    <div class="report-card">

        {{-- Header --}}
        <div class="report-header d-flex flex-wrap align-items-center justify-content-between gap-3">
            <div class="report-title">
                <div class="report-title-icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>

                <div>
                    <h5>Orders Report</h5>
                    <p>Monitor orders, payments, fulfilment and delivery status</p>
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
                            placeholder="Search ID, workshop, part..."
                            wire:model.live="search"
                        >
                    </div>
                </div>

                <div class="col-6 col-md-4 col-lg-2">
                    <label class="filter-label">Order Status</label>

                    <select
                        class="form-select"
                        wire:model.live="statusFilter"
                    >
                        <option value="">All Statuses</option>
                        <option value="0">Pending</option>
                        <option value="1">Accepted</option>
                        <option value="2">Declined</option>
                        <option value="3">Handover</option>
                        <option value="4">Received</option>
                    </select>
                </div>

                <div class="col-6 col-md-4 col-lg-2">
                    <label class="filter-label">Payment Status</label>

                    <select
                        class="form-select"
                        wire:model.live="paymentStatusFilter"
                    >
                        <option value="">All Payments</option>
                        <option value="0">Pending</option>
                        <option value="1">Success</option>
                        <option value="2">Partially Paid</option>
                    </select>
                </div>

                <div class="col-6 col-md-4 col-lg-2">
                    <label class="filter-label">Date Range</label>

                    <select
                        class="form-select"
                        wire:model.live="filterType"
                    >
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
                            Export PDF
                        </button>

                        <button
                            type="button"
                            class="btn-export excel"
                            wire:click="downloadExcel"
                        >
                            <i class="bx bxs-spreadsheet"></i>
                            Export Excel
                        </button>
                    </div>
                </div>

            </div>
        </div>

        {{-- Statistics --}}
        <div class="stats-area">
            <div class="row g-3">

                {{-- Total Orders --}}
                <div class="col-6 col-xl-3">
                    <div class="stat-card blue">
                        <div class="stat-top">
                            <div>
                                <p class="stat-label">Total Orders</p>

                                <div class="stat-value">
                                    {{ $totals['total'] ?? 0 }}
                                </div>

                                <div class="stat-meta">
                                    All matching orders
                                </div>
                            </div>

                            <div class="stat-icon">
                                <i class="fas fa-shopping-bag"></i>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Pending / Declined --}}
                <div class="col-6 col-xl-3">
                    <div class="stat-card red">
                        <div class="stat-top">
                            <div>
                                <p class="stat-label">Pending & Declined</p>

                                <div class="stat-value">
                                    {{ ($totals['pending'] ?? 0) + ($totals['declined'] ?? 0) }}
                                </div>

                                <div class="stat-meta">
                                    Pending:
                                    <strong>{{ $totals['pending'] ?? 0 }}</strong>
                                    &nbsp;·&nbsp;
                                    Declined:
                                    <strong>{{ $totals['declined'] ?? 0 }}</strong>
                                </div>
                            </div>

                            <div class="stat-icon">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Received / In Flight --}}
                <div class="col-6 col-xl-3">
                    <div class="stat-card green">
                        <div class="stat-top">
                            <div>
                                <p class="stat-label">Processing & Completed</p>

                                <div class="stat-value">
                                    {{ ($totals['received'] ?? 0) + ($totals['accepted'] ?? 0) + ($totals['handover'] ?? 0) }}
                                </div>

                                <div class="stat-meta">
                                    Received:
                                    <strong>{{ $totals['received'] ?? 0 }}</strong>
                                    &nbsp;·&nbsp;
                                    In-Flight:
                                    <strong>{{ ($totals['accepted'] ?? 0) + ($totals['handover'] ?? 0) }}</strong>
                                </div>
                            </div>

                            <div class="stat-icon">
                                <i class="fas fa-truck-loading"></i>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Value --}}
                <div class="col-6 col-xl-3">
                    <div class="stat-card gold">
                        <div class="stat-top">
                            <div>
                                <p class="stat-label">Order Value / Paid</p>

                                <div class="stat-value">
                                    ₹{{ number_format($totals['total_amount'] ?? 0, 2) }}
                                </div>

                                <div class="stat-meta">
                                    Paid:
                                    <strong>
                                        ₹{{ number_format($totals['paid_amount'] ?? 0, 2) }}
                                    </strong>
                                </div>
                            </div>

                            <div class="stat-icon">
                                <i class="fas fa-money-bill-wave"></i>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- Orders Table --}}
        <div class="table-wrap">
            <div class="table-responsive">
                <table class="table main-table align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Invoice Number</th>
                            <th>Items</th>
                            <th>Workshop</th>
                            <th>Order Date</th>
                            <th class="text-end">Amount</th>
                            <th class="text-center">Qty / Item</th>
                            <th>Payment Status</th>
                            <th>Order Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($orders as $o)
                            <tr>

                                <td class="text-muted">
                                    {{ $loop->iteration + ($orders->currentPage() - 1) * $orders->perPage() }}
                                </td>

                                <td>
                                    <span class="invoice-number">
                                        {{ getWorkshopInvoiceNumber($o) }}
                                    </span>
                                </td>

                                <td class="items-cell">
                                    @php
                                        $orderItemsString = implode(
                                            ', ',
                                            $o->orderItem->pluck('SpareParts.name')->filter()->toArray()
                                        );
                                    @endphp

                                    <div
                                        class="items-text"
                                        title="{{ $orderItemsString }}"
                                    >
                                        {{ $orderItemsString ?: 'N/A' }}
                                    </div>
                                </td>

                                <td>
                                    <span class="vendor-name">
                                        {{ $o->workShopVendor->company_name ??
                                            ($o->workShopVendor
                                                ? $o->workShopVendor->name . ' ' . $o->workShopVendor->lastname
                                                : 'N/A') }}
                                    </span>
                                </td>

                                <td>
                                    <span class="date-text">
                                        {{ $o->order_date
                                            ? \Carbon\Carbon::parse($o->order_date)->format('d M Y, h:i A')
                                            : 'N/A' }}
                                    </span>
                                </td>

                                <td class="text-end amount">
                                    ₹{{ number_format($o->total_amount, 2) }}
                                </td>

                                <td class="text-center">
                                    <span class="quantity-badge">
                                        {{ $o->total_quantity }} ({{ $o->total_item }})
                                    </span>
                                </td>

                                <td>
                                    @switch($o->payment_status)

                                        @case(0)
                                            <span class="status-badge status-pending">
                                                Pending
                                            </span>
                                            @break

                                        @case(1)
                                            <span class="status-badge status-success">
                                                Paid
                                            </span>
                                            @break

                                        @case(2)
                                            <span class="status-badge status-warning">
                                                Partially Paid
                                            </span>
                                            @break

                                        @default
                                            <span class="status-badge status-neutral">
                                                Unknown
                                            </span>

                                    @endswitch
                                </td>

                                <td>
                                    @switch($o->order_status)

                                        @case(0)
                                            <span class="status-badge status-pending">
                                                Pending
                                            </span>
                                            @break

                                        @case(1)
                                            @if ($o->payment_status == 0)
                                                <span class="status-badge status-warning">
                                                    Awaiting Payment
                                                </span>
                                            @else
                                                <span class="status-badge status-success">
                                                    Accepted
                                                </span>
                                            @endif
                                            @break

                                        @case(2)
                                            <span
                                                class="status-badge status-pending"
                                                title="Reason: {{ $o->decline_reason }}"
                                            >
                                                Declined
                                            </span>
                                            @break

                                        @case(3)
                                            <span class="status-badge status-blue">
                                                Handover
                                            </span>
                                            @break

                                        @case(4)
                                            <span class="status-badge status-success">
                                                Received
                                            </span>
                                            @break

                                        @default
                                            <span class="status-badge status-neutral">
                                                Pending
                                            </span>

                                    @endswitch
                                </td>

                                <td class="text-center">
                                    <button
                                        type="button"
                                        class="view-btn"
                                        wire:click="viewOrder({{ $o->id }})"
                                        title="View Details"
                                    >
                                        <i class="bx bx-show"></i>
                                    </button>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="empty-state">
                                    <div class="empty-icon">
                                        <i class="bx bx-shopping-bag"></i>
                                    </div>

                                    <div class="fw-semibold text-dark mb-1">
                                        No Orders Found
                                    </div>

                                    <div>
                                        No orders match the selected filters.
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
                    Showing {{ $orders->firstItem() ?? 0 }}–{{ $orders->lastItem() ?? 0 }}
                    of {{ $orders->total() }}
                </small>

                {!! $orders->links() !!}
            </div>
        </div>
    </div>

    {{-- Details Modal --}}
    @if($detail)
        <div class="order-modal-backdrop">
            <div class="order-modal">

                {{-- Modal Header --}}
                <div class="modal-header-modern">
                    <div class="modal-title-wrap">
                        <div class="modal-title-icon">
                            <i class="fas fa-shopping-bag"></i>
                        </div>

                        <div>
                            <h5 class="modal-title">
                                Order Details
                            </h5>

                            <div class="modal-subtitle">
                                Order #{{ $detail->id ?? '' }}
                            </div>
                        </div>
                    </div>

                    <button
                        type="button"
                        class="modal-close"
                        wire:click="$set('viewOrderId', null)"
                        aria-label="Close"
                    >
                        <i class="bx bx-x fs-5"></i>
                    </button>
                </div>

                {{-- Modal Body --}}
                <div class="modal-body-modern">

                    <div class="row g-3">

                        {{-- Order Summary --}}
                        <div class="col-12 col-md-6">
                            <div class="detail-card">

                                <div class="detail-heading">
                                    <i class="fas fa-info-circle"></i>
                                    Order Summary
                                </div>

                                <div class="detail-row">
                                    <span class="detail-label">Order No</span>
                                    <span class="detail-value">
                                        #{{ $detail->id }}
                                    </span>
                                </div>

                                <div class="detail-row">
                                    <span class="detail-label">Invoice Number</span>
                                    <span class="detail-value">
                                        {{ $detail->invoice_number ?? 'N/A' }}
                                    </span>
                                </div>

                                <div class="detail-row">
                                    <span class="detail-label">Order Date</span>
                                    <span class="detail-value">
                                        {{ $detail->order_date
                                            ? \Carbon\Carbon::parse($detail->order_date)->format('d M Y, h:i A')
                                            : 'N/A' }}
                                    </span>
                                </div>

                                <div class="detail-row">
                                    <span class="detail-label">Total Items</span>
                                    <span class="detail-value">
                                        {{ $detail->total_item }} items
                                        (Qty: {{ $detail->total_quantity }})
                                    </span>
                                </div>

                                <div class="detail-row">
                                    <span class="detail-label">Total Amount</span>
                                    <span class="detail-value" style="font-size:16px;">
                                        ₹{{ number_format($detail->total_amount, 2) }}
                                    </span>
                                </div>

                                <div class="detail-row">
                                    <span class="detail-label">Payment Status</span>
                                    <span class="detail-value">

                                        @switch($detail->payment_status)

                                            @case(0)
                                                <span class="status-badge status-pending">
                                                    Pending Payment
                                                </span>
                                                @break

                                            @case(1)
                                                <span class="status-badge status-success">
                                                    Success / Paid
                                                </span>
                                                @break

                                            @case(2)
                                                <span class="status-badge status-warning">
                                                    Partially Paid
                                                </span>
                                                @break

                                        @endswitch

                                    </span>
                                </div>

                                <div class="detail-row">
                                    <span class="detail-label">Order Status</span>
                                    <span class="detail-value">

                                        @switch($detail->order_status)

                                            @case(0)
                                                <span class="status-badge status-pending">
                                                    Pending Acceptance
                                                </span>
                                                @break

                                            @case(1)
                                                <span class="status-badge status-success">
                                                    Accepted / Confirmed
                                                </span>
                                                @break

                                            @case(2)
                                                <span class="status-badge status-pending">
                                                    Declined
                                                </span>
                                                @break

                                            @case(3)
                                                <span class="status-badge status-blue">
                                                    Handover
                                                </span>
                                                @break

                                            @case(4)
                                                <span class="status-badge status-success">
                                                    Received
                                                </span>
                                                @break

                                        @endswitch

                                    </span>
                                </div>

                                @if($detail->order_status == 2 && $detail->decline_reason)
                                    <div class="mt-3 pt-3 border-top">
                                        <div class="detail-label mb-1">
                                            Decline Reason
                                        </div>

                                        <div class="detail-note">
                                            {{ $detail->decline_reason }}
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </div>

                        {{-- Workshop Vendor --}}
                        <div class="col-12 col-md-6">
                            <div class="detail-card">

                                <div class="detail-heading">
                                    <i class="fas fa-warehouse"></i>
                                    Workshop Vendor Details
                                </div>

                                <div class="detail-row">
                                    <span class="detail-label">Vendor Name</span>
                                    <span class="detail-value">
                                        {{ $detail->workShopVendor->name ?? 'N/A' }}
                                        {{ $detail->workShopVendor->lastname ?? '' }}
                                    </span>
                                </div>

                                <div class="detail-row">
                                    <span class="detail-label">Company Name</span>
                                    <span class="detail-value">
                                        {{ $detail->workShopVendor->company_name ?? 'N/A' }}
                                    </span>
                                </div>

                                <div class="detail-row">
                                    <span class="detail-label">Email Address</span>
                                    <span class="detail-value">
                                        {{ $detail->workShopVendor->email ?? 'N/A' }}
                                    </span>
                                </div>

                                <div class="detail-row">
                                    <span class="detail-label">Mobile Number</span>
                                    <span class="detail-value">
                                        {{ $detail->workShopVendor->mobile_no ?? 'N/A' }}
                                    </span>
                                </div>

                                <div class="detail-row">
                                    <span class="detail-label">Address</span>
                                    <span class="detail-value">
                                        {{ $detail->workShopVendor->address ?? 'N/A' }},
                                        {{ $detail->workShopVendor->cityName
                                            ? $detail->workShopVendor->cityName->name
                                            : '' }}
                                    </span>
                                </div>

                            </div>
                        </div>

                        {{-- Order Items --}}
                        <div class="col-12">
                            <div class="detail-card">

                                <div class="detail-heading">
                                    <i class="fas fa-list"></i>
                                    Order Items & Spare Part Vendors
                                </div>

                                <div class="table-responsive">
                                    <table class="table detail-table align-middle mb-0">
                                        <thead>
                                            <tr>
                                                <th>Part / Item</th>
                                                <th>Category</th>
                                                <th>Vendor</th>
                                                <th class="text-center">Qty</th>
                                                <th class="text-end">Price</th>
                                                <th class="text-end">Tax %</th>
                                                <th class="text-end">Total</th>
                                                <th class="text-center">Item Status</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @forelse($detail->orderItem as $item)

                                                <tr>
                                                    <td>
                                                        <div class="item-name">
                                                            {{ $item->SpareParts->name ?? 'Spare Part Item' }}
                                                        </div>

                                                        <div class="sku">
                                                            SKU:
                                                            {{ $item->SpareParts->sku ?? 'N/A' }}
                                                        </div>
                                                    </td>

                                                    <td>
                                                        @switch($item->category)

                                                            @case(1)
                                                                <span class="status-badge status-neutral">
                                                                    Accessory
                                                                </span>
                                                                @break

                                                            @case(2)
                                                                <span class="status-badge status-blue">
                                                                    Parts
                                                                </span>
                                                                @break

                                                            @case(3)
                                                                <span class="status-badge status-neutral">
                                                                    Tools
                                                                </span>
                                                                @break

                                                            @case(4)
                                                                <span class="status-badge status-warning">
                                                                    Lubricants
                                                                </span>
                                                                @break

                                                            @default
                                                                <span class="status-badge status-neutral">
                                                                    N/A
                                                                </span>

                                                        @endswitch
                                                    </td>

                                                    <td>
                                                        <div class="item-name">
                                                            {{ $item->sparePartVendor->company_name ??
                                                                ($item->sparePartVendor
                                                                    ? $item->sparePartVendor->name . ' ' . $item->sparePartVendor->lastname
                                                                    : 'N/A') }}
                                                        </div>

                                                        <div class="vendor-mobile">
                                                            {{ $item->sparePartVendor->mobile_no ?? '' }}
                                                        </div>
                                                    </td>

                                                    <td class="text-center fw-semibold">
                                                        {{ $item->quantity }}
                                                    </td>

                                                    <td class="text-end">
                                                        ₹{{ number_format($item->price, 2) }}
                                                    </td>

                                                    <td class="text-end">
                                                        {{ $item->SpareParts->tax_percentage ?? 0 }}%
                                                    </td>

                                                    <td class="text-end fw-semibold">
                                                        ₹{{ number_format($item->total_amount, 2) }}
                                                    </td>

                                                    <td class="text-center">
                                                        @switch($item->status)

                                                            @case(0)
                                                                <span class="status-badge status-pending">
                                                                    Pending
                                                                </span>
                                                                @break

                                                            @case(1)
                                                                @if ($item->payment_status == 0)
                                                                    <span class="status-badge status-warning">
                                                                        Awaiting Payment
                                                                    </span>
                                                                @else
                                                                    <span class="status-badge status-success">
                                                                        Accepted
                                                                    </span>
                                                                @endif
                                                                @break

                                                            @case(2)
                                                                <span
                                                                    class="status-badge status-pending"
                                                                    title="Reason: {{ $item->reason }}"
                                                                >
                                                                    Declined
                                                                </span>
                                                                @break

                                                            @case(3)
                                                                <span class="status-badge status-blue">
                                                                    Handover
                                                                </span>
                                                                @break

                                                            @case(4)
                                                                <span class="status-badge status-success">
                                                                    Received
                                                                </span>
                                                                @break

                                                            @case(5)
                                                                <span
                                                                    class="status-badge status-warning"
                                                                    title="Reason: {{ $item->reason }}"
                                                                >
                                                                    Delayed
                                                                </span>
                                                                @break

                                                            @default
                                                                <span class="status-badge status-neutral">
                                                                    Pending
                                                                </span>

                                                        @endswitch
                                                    </td>
                                                </tr>

                                            @empty

                                                <tr>
                                                    <td
                                                        colspan="8"
                                                        class="text-center py-4 text-muted"
                                                    >
                                                        No items in this order.
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

                {{-- Footer --}}
                <div class="modal-footer-modern">
                    <button
                        type="button"
                        class="close-modern"
                        wire:click="$set('viewOrderId', null)"
                    >
                        Close
                    </button>
                </div>

            </div>
        </div>
    @endif
</div>