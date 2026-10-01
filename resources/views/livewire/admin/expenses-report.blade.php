<div class="carnate-expenses-report">

    <style>
        .carnate-expenses-report {
            --carnate-bg: #f7f8fa;
            --carnate-card: #ffffff;
            --carnate-text: #111827;
            --carnate-muted: #64748b;
            --carnate-border: #e2e8f0;
            --carnate-red: #e53935;
            --carnate-red-soft: #fff5f5;
            --carnate-green: #16a34a;
            --carnate-green-soft: #f0fdf4;
            --carnate-orange: #f59e0b;
            --carnate-orange-soft: #fffbeb;
            --carnate-blue: #2563eb;
            --carnate-blue-soft: #eff6ff;
            background: var(--carnate-bg);
            min-height: 100%;
            padding: 18px;
            color: var(--carnate-text);
        }

        .carnate-expenses-report .report-shell {
            max-width: 100%;
        }

        .carnate-expenses-report .report-header {
            background: var(--carnate-card);
            border: 1px solid var(--carnate-border);
            border-radius: 16px;
            padding: 20px 22px;
            margin-bottom: 18px;
            box-shadow: 0 4px 18px rgba(15, 23, 42, 0.04);
        }

        .carnate-expenses-report .title-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .carnate-expenses-report .title-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--carnate-red-soft);
            color: var(--carnate-red);
            font-size: 21px;
            flex-shrink: 0;
        }

        .carnate-expenses-report .page-title {
            margin: 0;
            font-size: 20px;
            line-height: 1.2;
            font-weight: 700;
            color: var(--carnate-text);
        }

        .carnate-expenses-report .page-subtitle {
            margin: 4px 0 0;
            color: var(--carnate-muted);
            font-size: 13px;
        }

        .carnate-expenses-report .filter-panel {
            margin-top: 20px;
            padding-top: 18px;
            border-top: 1px solid var(--carnate-border);
        }

        .carnate-expenses-report .filter-label {
            display: block;
            margin-bottom: 6px;
            color: #475569;
            font-size: 12px;
            font-weight: 600;
        }

        .carnate-expenses-report .form-control,
        .carnate-expenses-report .form-select {
            min-height: 40px;
            border: 1px solid var(--carnate-border);
            border-radius: 9px;
            color: var(--carnate-text);
            background: #fff;
            font-size: 13px;
            box-shadow: none;
        }

        .carnate-expenses-report .form-control:focus,
        .carnate-expenses-report .form-select:focus {
            border-color: rgba(229, 57, 53, .45);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .08);
        }

        .carnate-expenses-report .export-btn {
            min-height: 40px;
            border: 0;
            border-radius: 9px;
            padding: 0 15px;
            background: var(--carnate-red);
            color: #fff;
            font-size: 13px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            transition: .2s ease;
        }

        .carnate-expenses-report .export-btn:hover {
            background: #c92f2c;
            color: #fff;
            transform: translateY(-1px);
        }

        .carnate-expenses-report .stats-grid {
            margin-bottom: 18px;
        }

        .carnate-expenses-report .stat-card {
            height: 100%;
            background: var(--carnate-card);
            border: 1px solid var(--carnate-border);
            border-radius: 14px;
            padding: 17px;
            box-shadow: 0 4px 16px rgba(15, 23, 42, 0.035);
            position: relative;
            overflow: hidden;
        }

        .carnate-expenses-report .stat-card::after {
            content: "";
            position: absolute;
            right: -22px;
            bottom: -22px;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: rgba(15, 23, 42, .025);
        }

        .carnate-expenses-report .stat-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .carnate-expenses-report .stat-label {
            color: var(--carnate-muted);
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .carnate-expenses-report .stat-value {
            color: var(--carnate-text);
            font-size: 19px;
            font-weight: 700;
            line-height: 1.2;
        }

        .carnate-expenses-report .stat-icon {
            width: 42px;
            height: 42px;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }

        .carnate-expenses-report .stat-icon.red {
            color: var(--carnate-red);
            background: var(--carnate-red-soft);
        }

        .carnate-expenses-report .stat-icon.green {
            color: var(--carnate-green);
            background: var(--carnate-green-soft);
        }

        .carnate-expenses-report .stat-icon.blue {
            color: var(--carnate-blue);
            background: var(--carnate-blue-soft);
        }

        .carnate-expenses-report .stat-icon.orange {
            color: var(--carnate-orange);
            background: var(--carnate-orange-soft);
        }

        .carnate-expenses-report .table-card {
            background: var(--carnate-card);
            border: 1px solid var(--carnate-border);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 18px rgba(15, 23, 42, 0.04);
        }

        .carnate-expenses-report .table-topbar {
            padding: 17px 20px;
            border-bottom: 1px solid var(--carnate-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .carnate-expenses-report .table-title {
            margin: 0;
            font-size: 15px;
            font-weight: 700;
            color: var(--carnate-text);
        }

        .carnate-expenses-report .table-subtitle {
            margin: 3px 0 0;
            color: var(--carnate-muted);
            font-size: 12px;
        }

        .carnate-expenses-report .table-responsive {
            overflow-x: auto;
        }

        .carnate-expenses-report table {
            min-width: 980px;
        }

        .carnate-expenses-report .table thead th {
            background: #f8fafc;
            border-bottom: 1px solid var(--carnate-border);
            border-top: 0;
            color: #64748b;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .035em;
            padding: 13px 16px;
            white-space: nowrap;
        }

        .carnate-expenses-report .table tbody td {
            padding: 14px 16px;
            border-color: #eef2f7;
            color: var(--carnate-text);
            font-size: 13px;
            vertical-align: middle;
            white-space: nowrap;
        }

        .carnate-expenses-report .table tbody tr {
            transition: background .15s ease;
        }

        .carnate-expenses-report .table tbody tr:hover {
            background: #fafafa;
        }

        .carnate-expenses-report .serial {
            color: #94a3b8;
            font-weight: 600;
        }

        .carnate-expenses-report .bill-number {
            font-weight: 700;
            color: var(--carnate-text);
        }

        .carnate-expenses-report .supplier-name,
        .carnate-expenses-report .category-name {
            color: #334155;
            font-weight: 500;
        }

        .carnate-expenses-report .amount {
            font-weight: 650;
        }

        .carnate-expenses-report .amount-total {
            color: var(--carnate-text);
        }

        .carnate-expenses-report .amount-paid {
            color: var(--carnate-green);
        }

        .carnate-expenses-report .amount-balance {
            color: var(--carnate-orange);
        }

        .carnate-expenses-report .view-btn {
            width: 34px;
            height: 34px;
            border: 1px solid var(--carnate-border);
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            color: #475569;
            cursor: pointer;
            transition: .2s ease;
        }

        .carnate-expenses-report .view-btn:hover {
            color: var(--carnate-red);
            background: var(--carnate-red-soft);
            border-color: rgba(229, 57, 53, .18);
        }

        .carnate-expenses-report .empty-state {
            padding: 50px 20px !important;
            color: var(--carnate-muted) !important;
            text-align: center;
        }

        .carnate-expenses-report .empty-icon {
            width: 48px;
            height: 48px;
            margin: 0 auto 10px;
            border-radius: 12px;
            background: #f1f5f9;
            color: #94a3b8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 23px;
        }

        .carnate-expenses-report .pagination-bar {
            padding: 14px 18px;
            border-top: 1px solid var(--carnate-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            flex-wrap: wrap;
        }

        .carnate-expenses-report .pagination-info {
            color: var(--carnate-muted);
            font-size: 12px;
        }

        .carnate-expenses-report .pagination-wrapper nav {
            margin: 0;
        }

        .carnate-expenses-report .pagination-wrapper .pagination {
            margin: 0;
        }

        .carnate-expenses-report .modal-backdrop-custom {
            position: fixed;
            inset: 0;
            z-index: 1040;
            background: rgba(15, 23, 42, .42);
            backdrop-filter: blur(2px);
        }

        .carnate-expenses-report .detail-modal {
            position: fixed;
            inset: 0;
            z-index: 1050;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .carnate-expenses-report .detail-dialog {
            width: 100%;
            max-width: 820px;
            max-height: calc(100vh - 40px);
            overflow: hidden;
            background: #fff;
            border-radius: 17px;
            box-shadow: 0 20px 60px rgba(15, 23, 42, .20);
            display: flex;
            flex-direction: column;
        }

        .carnate-expenses-report .detail-header {
            padding: 18px 20px;
            border-bottom: 1px solid var(--carnate-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .carnate-expenses-report .detail-title-wrap {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .carnate-expenses-report .detail-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: var(--carnate-red-soft);
            color: var(--carnate-red);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .carnate-expenses-report .detail-title {
            margin: 0;
            font-size: 16px;
            font-weight: 700;
        }

        .carnate-expenses-report .detail-close {
            width: 34px;
            height: 34px;
            border: 0;
            border-radius: 8px;
            background: #f1f5f9;
            color: #64748b;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .carnate-expenses-report .detail-close:hover {
            background: var(--carnate-red-soft);
            color: var(--carnate-red);
        }

        .carnate-expenses-report .detail-body {
            padding: 20px;
            overflow-y: auto;
        }

        .carnate-expenses-report .detail-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            border: 1px solid var(--carnate-border);
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 18px;
        }

        .carnate-expenses-report .detail-item {
            padding: 14px;
            border-right: 1px solid var(--carnate-border);
            border-bottom: 1px solid var(--carnate-border);
        }

        .carnate-expenses-report .detail-item:nth-child(4n) {
            border-right: 0;
        }

        .carnate-expenses-report .detail-label {
            color: var(--carnate-muted);
            font-size: 11px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .carnate-expenses-report .detail-value {
            color: var(--carnate-text);
            font-size: 13px;
            font-weight: 650;
            word-break: break-word;
        }

        .carnate-expenses-report .description-card {
            border: 1px solid var(--carnate-border);
            border-radius: 12px;
            padding: 15px;
            background: #fafbfc;
        }

        .carnate-expenses-report .description-title {
            color: var(--carnate-muted);
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
            margin-bottom: 7px;
        }

        .carnate-expenses-report .description-text {
            color: #334155;
            font-size: 13px;
            line-height: 1.6;
        }

        .carnate-expenses-report .detail-footer {
            padding: 14px 20px;
            border-top: 1px solid var(--carnate-border);
            display: flex;
            justify-content: flex-end;
        }

        .carnate-expenses-report .close-btn {
            border: 1px solid var(--carnate-border);
            background: #fff;
            color: #475569;
            border-radius: 9px;
            padding: 9px 16px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
        }

        .carnate-expenses-report .close-btn:hover {
            background: #f8fafc;
            color: var(--carnate-text);
        }

        @media (max-width: 1199px) {
            .carnate-expenses-report .detail-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .carnate-expenses-report .detail-item:nth-child(4n) {
                border-right: 1px solid var(--carnate-border);
            }

            .carnate-expenses-report .detail-item:nth-child(2n) {
                border-right: 0;
            }
        }

        @media (max-width: 767px) {
            .carnate-expenses-report {
                padding: 12px;
            }

            .carnate-expenses-report .report-header {
                padding: 16px;
            }

            .carnate-expenses-report .filter-panel .row > div {
                margin-bottom: 10px;
            }

            .carnate-expenses-report .table-topbar {
                padding: 15px;
            }

            .carnate-expenses-report .pagination-bar {
                align-items: flex-start;
                flex-direction: column;
            }

            .carnate-expenses-report .detail-modal {
                padding: 10px;
            }

            .carnate-expenses-report .detail-dialog {
                max-height: calc(100vh - 20px);
            }

            .carnate-expenses-report .detail-grid {
                grid-template-columns: 1fr;
            }

            .carnate-expenses-report .detail-item,
            .carnate-expenses-report .detail-item:nth-child(2n),
            .carnate-expenses-report .detail-item:nth-child(4n) {
                border-right: 0;
            }
        }
    </style>

    <div class="report-shell">

        {{-- Header + Filters --}}
        <div class="report-header">
            <div class="d-flex align-items-center justify-content-between gap-3 flex-wrap">
                <div class="title-wrap">
                    <div class="title-icon">
                        <i class="bx bx-receipt"></i>
                    </div>

                    <div>
                        <h4 class="page-title">Expenses Report</h4>
                        <p class="page-subtitle">
                            Review expense entries, payments and outstanding balances.
                        </p>
                    </div>
                </div>
            </div>

            <div class="filter-panel">
                <div class="row g-3 align-items-end">

                    <div class="col-12 col-md-6 col-lg-3">
                        <label class="filter-label">Search</label>
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Search bill, supplier, category..."
                            wire:model.live="search"
                        >
                    </div>

                    <div class="col-12 col-md-6 col-lg-2">
                        <label class="filter-label">Filter Type</label>
                        <select class="form-select" wire:model.live="filterType">
                            <option value="">All</option>
                            <option value="daily">Today</option>
                            <option value="weekly">This Week</option>
                            <option value="monthly">This Month</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-6 col-lg-2">
                        <label class="filter-label">From</label>
                        <input
                            type="date"
                            class="form-control"
                            wire:model.lazy="fromDate"
                        >
                    </div>

                    <div class="col-12 col-md-6 col-lg-2">
                        <label class="filter-label">To</label>
                        <input
                            type="date"
                            class="form-control"
                            wire:model.lazy="toDate"
                        >
                    </div>

                    <div class="col-12 col-md-6 col-lg-3">
                        <label class="filter-label">&nbsp;</label>
                        <button
                            type="button"
                            class="export-btn"
                            wire:click="downloadPDF"
                        >
                            <i class="bx bxs-file-pdf"></i>
                            Export PDF
                        </button>
                    </div>

                </div>
            </div>
        </div>

        {{-- Summary --}}
        <div class="row g-3 stats-grid">

            <div class="col-6 col-xl-3">
                <div class="stat-card">
                    <div class="stat-content">
                        <div>
                            <div class="stat-label">Total Entries</div>
                            <div class="stat-value">
                                {{ $totals['count'] ?? 0 }}
                            </div>
                        </div>

                        <div class="stat-icon red">
                            <i class="bx bx-receipt"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-xl-3">
                <div class="stat-card">
                    <div class="stat-content">
                        <div>
                            <div class="stat-label">Total Amount</div>
                            <div class="stat-value">
                                ₹{{ number_format((float)($totals['total'] ?? 0), 2) }}
                            </div>
                        </div>

                        <div class="stat-icon green">
                            <i class="bx bx-wallet"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-xl-3">
                <div class="stat-card">
                    <div class="stat-content">
                        <div>
                            <div class="stat-label">Paid</div>
                            <div class="stat-value">
                                ₹{{ number_format((float)($totals['paid'] ?? 0), 2) }}
                            </div>
                        </div>

                        <div class="stat-icon blue">
                            <i class="bx bx-check-circle"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-xl-3">
                <div class="stat-card">
                    <div class="stat-content">
                        <div>
                            <div class="stat-label">Balance</div>
                            <div class="stat-value">
                                ₹{{ number_format((float)($totals['balance'] ?? 0), 2) }}
                            </div>
                        </div>

                        <div class="stat-icon orange">
                            <i class="bx bx-time-five"></i>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- Expense Table --}}
        <div class="table-card">

            <div class="table-topbar">
                <div>
                    <h5 class="table-title">Expense Entries</h5>
                    <p class="table-subtitle mb-0">
                        Detailed expense records and payment status.
                    </p>
                </div>

                <div class="text-muted small">
                    {{ $items->total() }} records
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Bill No</th>
                            <th>Date</th>
                            <th>Category</th>
                            <th>Supplier</th>
                            <th>Total</th>
                            <th>Paid</th>
                            <th>Balance</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($items as $e)
                            <tr>
                                <td class="serial">
                                    {{ $loop->iteration + ($items->currentPage() - 1) * $items->perPage() }}
                                </td>

                                <td>
                                    <span class="bill-number">
                                        {{ $e->bill_number }}
                                    </span>
                                </td>

                                <td>
                                    {{ $e->date }}
                                </td>

                                <td>
                                    <span class="category-name">
                                        {{ $e->category->title ?? '-' }}
                                    </span>
                                </td>

                                <td>
                                    <span class="supplier-name">
                                        {{ $e->supplier->business_first_name ?? '-' }}
                                    </span>
                                </td>

                                <td>
                                    <span class="amount amount-total">
                                        ₹{{ number_format((float)($e->total_amount ?? 0), 2) }}
                                    </span>
                                </td>

                                <td>
                                    <span class="amount amount-paid">
                                        ₹{{ number_format((float)($e->paid_amount ?? 0), 2) }}
                                    </span>
                                </td>

                                <td>
                                    <span class="amount amount-balance">
                                        ₹{{ number_format((float)($e->balance_amount ?? 0), 2) }}
                                    </span>
                                </td>

                                <td class="text-center">
                                    <button
                                        type="button"
                                        class="view-btn"
                                        wire:click="viewExpense({{ $e->id }})"
                                        title="View Expense"
                                    >
                                        <i class="bx bx-show"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="empty-state">
                                    <div class="empty-icon">
                                        <i class="bx bx-receipt"></i>
                                    </div>

                                    <div class="fw-semibold mb-1">
                                        No expenses found
                                    </div>

                                    <div class="small">
                                        There are no expense records matching the selected filters.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="pagination-bar">
                <div class="pagination-info">
                    Showing {{ $items->firstItem() }}–{{ $items->lastItem() }}
                    of {{ $items->total() }}
                </div>

                <div class="pagination-wrapper">
                    {!! $items->links() !!}
                </div>
            </div>

        </div>

    </div>

    {{-- View Expense Modal --}}
    @if($detail)

        <div class="modal-backdrop-custom"></div>

        <div class="detail-modal">
            <div class="detail-dialog">

                <div class="detail-header">
                    <div class="detail-title-wrap">
                        <div class="detail-icon">
                            <i class="bx bx-receipt"></i>
                        </div>

                        <div>
                            <h5 class="detail-title">Expense Details</h5>
                            <div class="text-muted small">
                                Bill #{{ $detail->bill_number }}
                            </div>
                        </div>
                    </div>

                    <button
                        type="button"
                        class="detail-close"
                        wire:click="$set('viewExpenseId', null)"
                        aria-label="Close"
                    >
                        <i class="bx bx-x"></i>
                    </button>
                </div>

                <div class="detail-body">

                    <div class="detail-grid">

                        <div class="detail-item">
                            <div class="detail-label">Bill No</div>
                            <div class="detail-value">
                                {{ $detail->bill_number }}
                            </div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">Date</div>
                            <div class="detail-value">
                                {{ $detail->date }}
                            </div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">Category</div>
                            <div class="detail-value">
                                {{ $detail->category->title ?? '-' }}
                            </div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">Supplier</div>
                            <div class="detail-value">
                                {{ $detail->supplier->business_first_name ?? '-' }}
                            </div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">Total</div>
                            <div class="detail-value">
                                ₹{{ number_format((float)($detail->total_amount ?? 0), 2) }}
                            </div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">Paid</div>
                            <div class="detail-value" style="color:#16a34a;">
                                ₹{{ number_format((float)($detail->paid_amount ?? 0), 2) }}
                            </div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">Balance</div>
                            <div class="detail-value" style="color:#f59e0b;">
                                ₹{{ number_format((float)($detail->balance_amount ?? 0), 2) }}
                            </div>
                        </div>

                    </div>

                    <div class="description-card">
                        <div class="description-title">
                            Description
                        </div>

                        <div class="description-text">
                            {{ $detail->description ?? '-' }}
                        </div>
                    </div>

                </div>

                <div class="detail-footer">
                    <button
                        type="button"
                        class="close-btn"
                        wire:click="$set('viewExpenseId', null)"
                    >
                        Close
                    </button>
                </div>

            </div>
        </div>

    @endif

</div>