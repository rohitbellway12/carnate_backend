<div class="container-fluid mt-3 carnate-payments-report">
    <style>
        .carnate-payments-report {
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

        .carnate-payments-report .report-card {
            background: #fff;
            border: 1px solid var(--carnate-border);
            border-radius: 16px;
            box-shadow: 0 4px 18px rgba(15, 23, 42, .04);
            overflow: hidden;
        }

        .carnate-payments-report .report-header {
            padding: 20px 22px;
            border-bottom: 1px solid var(--carnate-border);
        }

        .carnate-payments-report .report-title {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .carnate-payments-report .report-title-icon {
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

        .carnate-payments-report .report-title h5 {
            margin: 0;
            color: var(--carnate-text);
            font-size: 20px;
            font-weight: 700;
            letter-spacing: -.25px;
        }

        .carnate-payments-report .report-title p {
            margin: 3px 0 0;
            color: var(--carnate-muted);
            font-size: 13px;
        }

        .carnate-payments-report .filter-area {
            padding: 18px 22px;
            background: #fbfcfd;
            border-bottom: 1px solid var(--carnate-border);
        }

        .carnate-payments-report .filter-label {
            display: block;
            margin-bottom: 6px;
            color: #475569;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
        }

        .carnate-payments-report .form-control,
        .carnate-payments-report .form-select {
            min-height: 40px;
            border: 1px solid var(--carnate-border);
            border-radius: 9px;
            color: var(--carnate-text);
            background: #fff;
            font-size: 13px;
            box-shadow: none;
        }

        .carnate-payments-report .form-control:focus,
        .carnate-payments-report .form-select:focus {
            border-color: rgba(229, 57, 53, .45);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .08);
        }

        .carnate-payments-report .search-box {
            position: relative;
        }

        .carnate-payments-report .search-box i {
            position: absolute;
            left: 13px;
            top: 13px;
            z-index: 2;
            color: #94a3b8;
            font-size: 14px;
        }

        .carnate-payments-report .search-box input {
            padding-left: 36px;
        }

        .carnate-payments-report .filter-actions {
            display: flex;
            gap: 8px;
        }

        .carnate-payments-report .btn-export {
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

        .carnate-payments-report .btn-export:hover {
            background: #f8fafc;
            color: var(--carnate-text);
        }

        .carnate-payments-report .btn-export.pdf:hover {
            background: var(--carnate-red-soft);
            border-color: rgba(229, 57, 53, .22);
            color: var(--carnate-red);
        }

        .carnate-payments-report .btn-export.excel:hover {
            background: var(--carnate-success-soft);
            border-color: rgba(22, 163, 74, .22);
            color: var(--carnate-success);
        }

        .carnate-payments-report .stats-area {
            padding: 20px 22px;
        }

        .carnate-payments-report .stat-card {
            height: 100%;
            background: #fff;
            border: 1px solid var(--carnate-border);
            border-radius: 14px;
            padding: 17px;
            position: relative;
            overflow: hidden;
        }

        .carnate-payments-report .stat-card::after {
            content: "";
            position: absolute;
            width: 70px;
            height: 70px;
            right: -28px;
            bottom: -32px;
            border-radius: 50%;
            background: rgba(148, 163, 184, .06);
        }

        .carnate-payments-report .stat-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 12px;
        }

        .carnate-payments-report .stat-label {
            margin: 0 0 7px;
            color: var(--carnate-muted);
            font-size: 12px;
            font-weight: 600;
        }

        .carnate-payments-report .stat-value {
            color: var(--carnate-text);
            font-size: 24px;
            font-weight: 750;
            line-height: 1.1;
        }

        .carnate-payments-report .stat-icon {
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

        .carnate-payments-report .stat-meta {
            margin-top: 9px;
            color: var(--carnate-muted);
            font-size: 11px;
        }

        .carnate-payments-report .stat-card.blue .stat-icon {
            background: var(--carnate-blue-soft);
            color: var(--carnate-blue);
        }

        .carnate-payments-report .stat-card.green .stat-icon {
            background: var(--carnate-success-soft);
            color: var(--carnate-success);
        }

        .carnate-payments-report .stat-card.red .stat-icon {
            background: var(--carnate-red-soft);
            color: var(--carnate-red);
        }

        .carnate-payments-report .stat-card.gold .stat-icon {
            background: var(--carnate-warning-soft);
            color: var(--carnate-warning);
        }

        .carnate-payments-report .table-wrap {
            border-top: 1px solid var(--carnate-border);
        }

        .carnate-payments-report .main-table {
            min-width: 950px;
            margin-bottom: 0;
        }

        .carnate-payments-report .main-table thead th {
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

        .carnate-payments-report .main-table tbody td {
            padding: 14px 15px;
            border-bottom: 1px solid #edf1f5;
            color: #334155;
            font-size: 13px;
            vertical-align: middle;
            white-space: nowrap;
        }

        .carnate-payments-report .main-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .carnate-payments-report .main-table tbody tr {
            transition: background .15s ease;
        }

        .carnate-payments-report .main-table tbody tr:hover {
            background: #fafafa;
        }

        .carnate-payments-report .transaction-id {
            color: var(--carnate-text);
            font-weight: 700;
        }

        .carnate-payments-report .order-id {
            display: inline-flex;
            align-items: center;
            padding: 5px 8px;
            border-radius: 7px;
            background: #f1f5f9;
            color: #475569;
            font-size: 11px;
            font-weight: 700;
        }

        .carnate-payments-report .vendor-name {
            color: var(--carnate-text);
            font-weight: 600;
        }

        .carnate-payments-report .vendor-company {
            display: block;
            margin-top: 2px;
            color: #94a3b8;
            font-size: 10px;
        }

        .carnate-payments-report .date-text {
            color: #64748b;
            font-size: 12px;
        }

        .carnate-payments-report .amount {
            color: var(--carnate-text);
            font-weight: 700;
        }

        .carnate-payments-report .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 9px;
            border-radius: 7px;
            font-size: 11px;
            font-weight: 700;
        }

        .carnate-payments-report .status-badge::before {
            content: "";
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: currentColor;
        }

        .carnate-payments-report .status-success {
            background: var(--carnate-success-soft);
            color: var(--carnate-success);
        }

        .carnate-payments-report .status-failed {
            background: var(--carnate-red-soft);
            color: var(--carnate-red);
        }

        .carnate-payments-report .view-btn {
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

        .carnate-payments-report .view-btn:hover {
            color: var(--carnate-red);
            background: var(--carnate-red-soft);
            border-color: rgba(229, 57, 53, .2);
        }

        .carnate-payments-report .pagination-area {
            padding: 15px 20px;
            border-top: 1px solid var(--carnate-border);
        }

        .carnate-payments-report .pagination-area small {
            color: var(--carnate-muted);
            font-size: 12px;
        }

        .carnate-payments-report .empty-state {
            padding: 60px 20px !important;
            text-align: center;
            color: var(--carnate-muted);
        }

        .carnate-payments-report .empty-icon {
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
        .carnate-payments-report .payment-modal-backdrop {
            position: fixed;
            inset: 0;
            z-index: 1050;
            background: rgba(15, 23, 42, .48);
            backdrop-filter: blur(3px);
            overflow-y: auto;
        }

        .carnate-payments-report .payment-modal {
            width: calc(100% - 30px);
            max-width: 1050px;
            margin: 35px auto;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 25px 70px rgba(15, 23, 42, .20);
            overflow: hidden;
        }

        .carnate-payments-report .modal-header-modern {
            padding: 18px 22px;
            border-bottom: 1px solid var(--carnate-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .carnate-payments-report .modal-title-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .carnate-payments-report .modal-title-icon {
            width: 40px;
            height: 40px;
            border-radius: 11px;
            background: var(--carnate-red-soft);
            color: var(--carnate-red);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .carnate-payments-report .modal-title {
            margin: 0;
            color: var(--carnate-text);
            font-size: 17px;
            font-weight: 700;
        }

        .carnate-payments-report .modal-subtitle {
            margin-top: 3px;
            color: var(--carnate-muted);
            font-size: 12px;
        }

        .carnate-payments-report .modal-close {
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

        .carnate-payments-report .modal-close:hover {
            background: #f8fafc;
            color: var(--carnate-text);
        }

        .carnate-payments-report .modal-body-modern {
            padding: 22px;
            background: #f8fafc;
        }

        .carnate-payments-report .detail-card {
            height: 100%;
            background: #fff;
            border: 1px solid var(--carnate-border);
            border-radius: 13px;
            padding: 17px;
        }

        .carnate-payments-report .detail-heading {
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

        .carnate-payments-report .detail-heading i {
            color: var(--carnate-red);
        }

        .carnate-payments-report .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 15px;
            margin-bottom: 11px;
            font-size: 12px;
        }

        .carnate-payments-report .detail-row:last-child {
            margin-bottom: 0;
        }

        .carnate-payments-report .detail-label {
            color: var(--carnate-muted);
        }

        .carnate-payments-report .detail-value {
            color: var(--carnate-text);
            font-weight: 600;
            text-align: right;
        }

        .carnate-payments-report .payment-amount {
            color: var(--carnate-success);
            font-size: 18px;
            font-weight: 750;
        }

        .carnate-payments-report .order-summary {
            padding: 13px;
            margin-bottom: 15px;
            border: 1px solid var(--carnate-border);
            border-radius: 10px;
            background: #fbfcfd;
        }

        .carnate-payments-report .order-summary-item {
            color: #334155;
            font-size: 12px;
        }

        .carnate-payments-report .detail-table {
            min-width: 650px;
        }

        .carnate-payments-report .detail-table th {
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

        .carnate-payments-report .detail-table td {
            padding: 11px 10px;
            color: #334155;
            font-size: 12px;
            border-bottom: 1px solid #edf1f5;
            vertical-align: middle;
        }

        .carnate-payments-report .detail-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .carnate-payments-report .item-name {
            color: var(--carnate-text);
            font-weight: 600;
        }

        .carnate-payments-report .sku {
            color: #94a3b8;
            font-size: 10px;
        }

        .carnate-payments-report .modal-footer-modern {
            padding: 15px 22px;
            border-top: 1px solid var(--carnate-border);
            display: flex;
            justify-content: flex-end;
        }

        .carnate-payments-report .close-modern {
            min-height: 38px;
            padding: 0 17px;
            border: 1px solid var(--carnate-border);
            border-radius: 9px;
            background: #fff;
            color: #475569;
            font-size: 12px;
            font-weight: 600;
        }

        .carnate-payments-report .close-modern:hover {
            background: #f8fafc;
            color: var(--carnate-text);
        }

        @media (max-width: 991px) {
            .carnate-payments-report .filter-actions {
                width: 100%;
            }

            .carnate-payments-report .btn-export {
                flex: 1;
            }
        }

        @media (max-width: 767px) {
            .carnate-payments-report {
                margin-top: 10px !important;
            }

            .carnate-payments-report .report-header,
            .carnate-payments-report .filter-area,
            .carnate-payments-report .stats-area {
                padding: 15px;
            }

            .carnate-payments-report .report-title h5 {
                font-size: 17px;
            }

            .carnate-payments-report .pagination-area {
                flex-direction: column;
                align-items: flex-start !important;
            }

            .carnate-payments-report .payment-modal {
                width: calc(100% - 16px);
                margin: 15px auto;
            }

            .carnate-payments-report .modal-header-modern {
                padding: 15px;
            }

            .carnate-payments-report .modal-body-modern {
                padding: 14px;
            }
        }
    </style>

    <div class="report-card">

        {{-- Header --}}
        <div class="report-header">
            <div class="report-title">
                <div class="report-title-icon">
                    <i class="fas fa-coins"></i>
                </div>

                <div>
                    <h5>Payments Report</h5>
                    <p>Monitor transactions, payment status and settled revenue</p>
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
                            placeholder="Search payment, order, vendor..."
                            wire:model.live="search"
                        >
                    </div>
                </div>

                <div class="col-6 col-md-4 col-lg-2">
                    <label class="filter-label">Status</label>

                    <select
                        class="form-select"
                        wire:model.live="statusFilter"
                    >
                        <option value="">All Statuses</option>
                        <option value="success">Success</option>
                        <option value="failed">Failed</option>
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

                {{-- Total Transactions --}}
                <div class="col-6 col-xl-3">
                    <div class="stat-card blue">
                        <div class="stat-top">
                            <div>
                                <p class="stat-label">Total Transactions</p>

                                <div class="stat-value">
                                    {{ $totals['total'] ?? 0 }}
                                </div>

                                <div class="stat-meta">
                                    All matching transactions
                                </div>
                            </div>

                            <div class="stat-icon">
                                <i class="fas fa-history"></i>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Successful --}}
                <div class="col-6 col-xl-3">
                    <div class="stat-card green">
                        <div class="stat-top">
                            <div>
                                <p class="stat-label">Successful Payments</p>

                                <div class="stat-value">
                                    {{ $totals['success'] ?? 0 }}
                                </div>

                                <div class="stat-meta">
                                    Completed transactions
                                </div>
                            </div>

                            <div class="stat-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Failed --}}
                <div class="col-6 col-xl-3">
                    <div class="stat-card red">
                        <div class="stat-top">
                            <div>
                                <p class="stat-label">Failed Payments</p>

                                <div class="stat-value">
                                    {{ $totals['failed'] ?? 0 }}
                                </div>

                                <div class="stat-meta">
                                    Unsuccessful transactions
                                </div>
                            </div>

                            <div class="stat-icon">
                                <i class="fas fa-times-circle"></i>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Revenue --}}
                <div class="col-6 col-xl-3">
                    <div class="stat-card gold">
                        <div class="stat-top">
                            <div>
                                <p class="stat-label">Total Revenue</p>

                                <div class="stat-value">
                                    ₹{{ number_format($totals['total_amount'] ?? 0, 2) }}
                                </div>

                                <div class="stat-meta">
                                    Settled payment amount
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

        {{-- Payments Table --}}
        <div class="table-wrap">
            <div class="table-responsive">
                <table class="table main-table align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Payment ID</th>
                            <th>Order ID</th>
                            <th>Workshop Vendor</th>
                            <th>Payment Date</th>
                            <th class="text-end">Amount</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($payments as $p)
                            <tr>

                                <td class="text-muted">
                                    {{ $loop->iteration + ($payments->currentPage() - 1) * $payments->perPage() }}
                                </td>

                                <td>
                                    <span class="transaction-id">
                                        {{ $p->payment_id }}
                                    </span>
                                </td>

                                <td>
                                    <span class="order-id">
                                        {{ getPaymentInvoiceNumbers($p) }}
                                    </span>
                                </td>

                                <td>
                                    <span class="vendor-name">
                                        {{ $p->user
                                            ? $p->user->name . ' ' . $p->user->lastname
                                            : 'N/A' }}
                                    </span>

                                    <span class="vendor-company">
                                        {{ $p->user->company_name ?? '' }}
                                    </span>
                                </td>

                                <td>
                                    <span class="date-text">
                                        {{ $p->created_at
                                            ? \Carbon\Carbon::parse($p->created_at)->format('d M Y, h:i A')
                                            : 'N/A' }}
                                    </span>
                                </td>

                                <td class="text-end amount">
                                    ₹{{ number_format($p->amount, 2) }}
                                </td>

                                <td>
                                    @if(strtolower($p->status) === 'success')
                                        <span class="status-badge status-success">
                                            Success
                                        </span>
                                    @else
                                        <span class="status-badge status-failed">
                                            Failed
                                        </span>
                                    @endif
                                </td>

                                <td class="text-center">
                                    <button
                                        type="button"
                                        class="view-btn"
                                        wire:click="viewPayment({{ $p->id }})"
                                        title="View Details"
                                    >
                                        <i class="bx bx-show"></i>
                                    </button>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="empty-state">
                                    <div class="empty-icon">
                                        <i class="bx bx-credit-card"></i>
                                    </div>

                                    <div class="fw-semibold text-dark mb-1">
                                        No Payments Found
                                    </div>

                                    <div>
                                        No payments match the selected filters.
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
                    Showing {{ $payments->firstItem() ?? 0 }}–{{ $payments->lastItem() ?? 0 }}
                    of {{ $payments->total() }}
                </small>

                {!! $payments->links() !!}
            </div>
        </div>
    </div>

    {{-- Details Modal --}}
    @if($detail)
        <div class="payment-modal-backdrop">
            <div class="payment-modal">

                {{-- Modal Header --}}
                <div class="modal-header-modern">
                    <div class="modal-title-wrap">
                        <div class="modal-title-icon">
                            <i class="fas fa-coins"></i>
                        </div>

                        <div>
                            <h5 class="modal-title">
                                Payment Details
                            </h5>

                            <div class="modal-subtitle">
                                Transaction #{{ $detail->payment_id ?? 'N/A' }}
                            </div>
                        </div>
                    </div>

                    <button
                        type="button"
                        class="modal-close"
                        wire:click="$set('viewPaymentId', null)"
                        aria-label="Close"
                    >
                        <i class="bx bx-x fs-5"></i>
                    </button>
                </div>

                {{-- Modal Body --}}
                <div class="modal-body-modern">
                    <div class="row g-3">

                        {{-- Payment Receipt --}}
                        <div class="col-12 col-md-6">
                            <div class="detail-card">

                                <div class="detail-heading">
                                    <i class="fas fa-receipt"></i>
                                    Payment Receipt
                                </div>

                                <div class="detail-row">
                                    <span class="detail-label">
                                        Transaction ID
                                    </span>

                                    <span class="detail-value">
                                        {{ $detail->payment_id }}
                                    </span>
                                </div>

                                <div class="detail-row">
                                    <span class="detail-label">
                                        Order ID
                                    </span>

                                    <span class="detail-value">
                                        <span class="order-id">
                                            #{{ $detail->order_id }}
                                        </span>
                                    </span>
                                </div>

                                <div class="detail-row">
                                    <span class="detail-label">
                                        Date / Time
                                    </span>

                                    <span class="detail-value">
                                        {{ \Carbon\Carbon::parse($detail->created_at)->format('d M Y, h:i A') }}
                                    </span>
                                </div>

                                <div class="detail-row">
                                    <span class="detail-label">
                                        Payment Amount
                                    </span>

                                    <span class="payment-amount">
                                        ₹{{ number_format($detail->amount, 2) }}
                                    </span>
                                </div>

                                <div class="detail-row">
                                    <span class="detail-label">
                                        Status
                                    </span>

                                    <span class="detail-value">
                                        @if(strtolower($detail->status) === 'success')
                                            <span class="status-badge status-success">
                                                Success
                                            </span>
                                        @else
                                            <span class="status-badge status-failed">
                                                Failed
                                            </span>
                                        @endif
                                    </span>
                                </div>

                            </div>
                        </div>

                        {{-- Vendor --}}
                        <div class="col-12 col-md-6">
                            <div class="detail-card">

                                <div class="detail-heading">
                                    <i class="fas fa-warehouse"></i>
                                    Workshop Vendor Info
                                </div>

                                <div class="detail-row">
                                    <span class="detail-label">
                                        Vendor Name
                                    </span>

                                    <span class="detail-value">
                                        {{ $detail->user->name ?? 'N/A' }}
                                        {{ $detail->user->lastname ?? '' }}
                                    </span>
                                </div>

                                <div class="detail-row">
                                    <span class="detail-label">
                                        Company Name
                                    </span>

                                    <span class="detail-value">
                                        {{ $detail->user->company_name ?? 'N/A' }}
                                    </span>
                                </div>

                                <div class="detail-row">
                                    <span class="detail-label">
                                        Email Address
                                    </span>

                                    <span class="detail-value">
                                        {{ $detail->user->email ?? 'N/A' }}
                                    </span>
                                </div>

                                <div class="detail-row">
                                    <span class="detail-label">
                                        Mobile Number
                                    </span>

                                    <span class="detail-value">
                                        {{ $detail->user->mobile_no ?? 'N/A' }}
                                    </span>
                                </div>

                                <div class="detail-row">
                                    <span class="detail-label">
                                        Address
                                    </span>

                                    <span class="detail-value">
                                        {{ $detail->user->address ?? 'N/A' }}
                                    </span>
                                </div>

                            </div>
                        </div>

                        {{-- Associated Order --}}
                        @if($detail->order)
                            <div class="col-12">
                                <div class="detail-card">

                                    <div class="detail-heading">
                                        <i class="fas fa-shopping-bag"></i>
                                        Associated Order Summary
                                    </div>

                                    <div class="order-summary">
                                        <div class="row g-3">

                                            <div class="col-12 col-md-4">
                                                <div class="order-summary-item">
                                                    <span class="detail-label d-block mb-1">
                                                        Order
                                                    </span>

                                                    <strong>
                                                        #{{ $detail->order->id }}
                                                    </strong>
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-4">
                                                <div class="order-summary-item">
                                                    <span class="detail-label d-block mb-1">
                                                        Order Date
                                                    </span>

                                                    <strong>
                                                        {{ \Carbon\Carbon::parse($detail->order->order_date)->format('d M Y, h:i A') }}
                                                    </strong>
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-4">
                                                <div class="order-summary-item">
                                                    <span class="detail-label d-block mb-1">
                                                        Total Order Amount
                                                    </span>

                                                    <strong>
                                                        ₹{{ number_format($detail->order->total_amount, 2) }}
                                                    </strong>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="order-summary-item">
                                                    <span class="detail-label">
                                                        Items / Quantity:
                                                    </span>

                                                    <strong>
                                                        {{ $detail->order->total_item }}
                                                        items
                                                        (Qty: {{ $detail->order->total_quantity }})
                                                    </strong>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table detail-table align-middle mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Spare Part Name</th>
                                                    <th>Category</th>
                                                    <th class="text-center">Quantity</th>
                                                    <th class="text-end">Price</th>
                                                    <th class="text-end">Total Amount</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @forelse($detail->order->orderItem as $item)

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

                                                        <td class="text-center">
                                                            {{ $item->quantity }}
                                                        </td>

                                                        <td class="text-end">
                                                            ₹{{ number_format($item->price, 2) }}
                                                        </td>

                                                        <td class="text-end fw-semibold">
                                                            ₹{{ number_format($item->total_amount, 2) }}
                                                        </td>
                                                    </tr>

                                                @empty
                                                    <tr>
                                                        <td
                                                            colspan="5"
                                                            class="text-center py-4 text-muted"
                                                        >
                                                            No items found.
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        @endif

                    </div>
                </div>

                {{-- Footer --}}
                <div class="modal-footer-modern">
                    <button
                        type="button"
                        class="close-modern"
                        wire:click="$set('viewPaymentId', null)"
                    >
                        Close
                    </button>
                </div>

            </div>
        </div>
    @endif
</div>