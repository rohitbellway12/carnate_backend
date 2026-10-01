<div class="carnate-expenses-report">

    <style>
        .carnate-expenses-report {
            background: #f7f8fa;
            color: #111827;
        }

        .carnate-expenses-report .report-card,
        .carnate-expenses-report .summary-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            box-shadow: 0 4px 18px rgba(15, 23, 42, .04);
        }

        /* Header */
        .carnate-expenses-report .report-header {
            padding: 22px 24px;
            border-bottom: 1px solid #e2e8f0;
        }

        .carnate-expenses-report .title-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .carnate-expenses-report .title-icon {
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: #fff5f5;
            color: #e53935;
            font-size: 21px;
        }

        .carnate-expenses-report .report-title {
            margin: 0;
            color: #111827;
            font-size: 20px;
            font-weight: 700;
        }

        .carnate-expenses-report .report-subtitle {
            margin: 3px 0 0;
            color: #64748b;
            font-size: 13px;
        }

        /* Filters */
        .carnate-expenses-report .filters {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-end;
            justify-content: flex-end;
            gap: 12px;
        }

        .carnate-expenses-report .filter-item {
            min-width: 145px;
        }

        .carnate-expenses-report .filter-item.search-item {
            min-width: 230px;
        }

        .carnate-expenses-report .filter-label {
            display: block;
            margin-bottom: 6px;
            color: #64748b;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
        }

        .carnate-expenses-report .filter-control {
            height: 42px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            background: #fff;
            color: #111827;
            font-size: 13px;
            box-shadow: none;
        }

        .carnate-expenses-report .filter-control:focus {
            border-color: #cbd5e1;
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .08);
        }

        .carnate-expenses-report .export-btn {
            height: 42px;
            padding: 0 15px;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            background: #fff;
            color: #475569;
            font-size: 13px;
            font-weight: 600;
            transition: all .2s ease;
        }

        .carnate-expenses-report .export-btn:hover {
            border-color: #fecaca;
            background: #fff5f5;
            color: #e53935;
        }

        .carnate-expenses-report .export-btn i {
            font-size: 17px;
        }

        /* Summary */
        .carnate-expenses-report .summary-section {
            padding: 20px 22px 4px;
        }

        .carnate-expenses-report .summary-card {
            min-height: 100px;
            height: 100%;
            padding: 18px;
            position: relative;
            overflow: hidden;
        }

        .carnate-expenses-report .summary-card::after {
            content: "";
            position: absolute;
            right: -25px;
            bottom: -30px;
            width: 90px;
            height: 90px;
            border-radius: 50%;
            background: rgba(229, 57, 53, .04);
        }

        .carnate-expenses-report .summary-content {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 100%;
        }

        .carnate-expenses-report .summary-label {
            margin: 0 0 6px;
            color: #64748b;
            font-size: 12px;
            font-weight: 600;
        }

        .carnate-expenses-report .summary-value {
            display: block;
            color: #111827;
            font-size: 20px;
            line-height: 1.2;
            font-weight: 700;
        }

        .carnate-expenses-report .summary-icon {
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: #f1f5f9;
            color: #475569;
            font-size: 20px;
        }

        .carnate-expenses-report .summary-icon.red {
            background: #fff5f5;
            color: #e53935;
        }

        .carnate-expenses-report .summary-icon.green {
            background: #f0fdf4;
            color: #16a34a;
        }

        .carnate-expenses-report .summary-icon.orange {
            background: #fff7ed;
            color: #ea580c;
        }

        /* Table */
        .carnate-expenses-report .table-section {
            margin-top: 18px;
        }

        .carnate-expenses-report .table-header {
            padding: 20px 22px;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .carnate-expenses-report .table-title {
            margin: 0;
            color: #111827;
            font-size: 16px;
            font-weight: 700;
        }

        .carnate-expenses-report .table-count {
            padding: 5px 10px;
            border-radius: 20px;
            background: #f1f5f9;
            color: #64748b;
            font-size: 12px;
            font-weight: 600;
        }

        .carnate-expenses-report .table-wrap {
            overflow-x: auto;
        }

        .carnate-expenses-report table {
            width: 100%;
            min-width: 1050px;
            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .carnate-expenses-report thead th {
            padding: 14px 18px;
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            color: #64748b;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
            white-space: nowrap;
        }

        .carnate-expenses-report tbody td {
            padding: 15px 18px;
            border-bottom: 1px solid #f1f5f9;
            color: #475569;
            font-size: 13px;
            vertical-align: middle;
        }

        .carnate-expenses-report tbody tr {
            transition: background .15s ease;
        }

        .carnate-expenses-report tbody tr:hover {
            background: #fafafa;
        }

        .carnate-expenses-report tbody tr:last-child td {
            border-bottom: 0;
        }

        .carnate-expenses-report .serial {
            color: #94a3b8;
            font-weight: 600;
        }

        .carnate-expenses-report .bill-number {
            color: #111827;
            font-weight: 700;
            white-space: nowrap;
        }

        .carnate-expenses-report .date-text {
            white-space: nowrap;
            color: #64748b;
        }

        .carnate-expenses-report .category-badge {
            display: inline-flex;
            align-items: center;
            padding: 5px 9px;
            border-radius: 7px;
            background: #f1f5f9;
            color: #475569;
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
        }

        .carnate-expenses-report .supplier-name {
            color: #334155;
            font-weight: 500;
            white-space: nowrap;
        }

        .carnate-expenses-report .amount {
            color: #334155;
            font-weight: 600;
            white-space: nowrap;
        }

        .carnate-expenses-report .balance {
            color: #c2410c;
            font-weight: 700;
            white-space: nowrap;
        }

        .carnate-expenses-report .view-btn {
            width: 34px;
            height: 34px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #e2e8f0;
            border-radius: 9px;
            background: #fff;
            color: #64748b;
            cursor: pointer;
            transition: all .2s ease;
        }

        .carnate-expenses-report .view-btn:hover {
            border-color: #fecaca;
            background: #fff5f5;
            color: #e53935;
        }

        .carnate-expenses-report .view-btn i {
            font-size: 17px;
        }

        .carnate-expenses-report .table-footer {
            padding: 16px 20px;
            border-top: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .carnate-expenses-report .showing-text {
            color: #64748b;
            font-size: 12px;
            white-space: nowrap;
        }

        .carnate-expenses-report .pagination-wrap {
            display: flex;
            justify-content: flex-end;
        }

        /* Detail modal */
        .carnate-expenses-report .detail-modal {
            position: fixed;
            inset: 0;
            z-index: 1055;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: rgba(15, 23, 42, .48);
            backdrop-filter: blur(3px);
        }

        .carnate-expenses-report .detail-dialog {
            width: 100%;
            max-width: 800px;
            max-height: calc(100vh - 40px);
        }

        .carnate-expenses-report .detail-content {
            max-height: calc(100vh - 40px);
            display: flex;
            flex-direction: column;
            overflow: hidden;
            border: 1px solid #e2e8f0;
            border-radius: 18px;
            background: #fff;
            box-shadow: 0 24px 60px rgba(15, 23, 42, .18);
        }

        .carnate-expenses-report .detail-header {
            flex: 0 0 auto;
            padding: 19px 22px;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .carnate-expenses-report .detail-title-wrap {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .carnate-expenses-report .detail-icon {
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: #fff5f5;
            color: #e53935;
            font-size: 19px;
        }

        .carnate-expenses-report .detail-title {
            margin: 0;
            color: #111827;
            font-size: 17px;
            font-weight: 700;
        }

        .carnate-expenses-report .modal-close {
            width: 34px;
            height: 34px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 0;
            border-radius: 9px;
            background: #f1f5f9;
            color: #64748b;
            cursor: pointer;
        }

        .carnate-expenses-report .modal-close:hover {
            background: #fef2f2;
            color: #dc2626;
        }

        .carnate-expenses-report .detail-body {
            flex: 1 1 auto;
            overflow-y: auto;
            padding: 22px;
        }

        .carnate-expenses-report .detail-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
        }

        .carnate-expenses-report .detail-item {
            padding: 14px;
            border: 1px solid #e2e8f0;
            border-radius: 11px;
            background: #fff;
        }

        .carnate-expenses-report .detail-label {
            margin-bottom: 5px;
            color: #94a3b8;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
        }

        .carnate-expenses-report .detail-value {
            color: #334155;
            font-size: 14px;
            font-weight: 600;
            word-break: break-word;
        }

        .carnate-expenses-report .detail-value.total {
            color: #111827;
        }

        .carnate-expenses-report .detail-value.paid {
            color: #16a34a;
        }

        .carnate-expenses-report .detail-value.balance {
            color: #ea580c;
        }

        .carnate-expenses-report .description-box {
            margin-top: 16px;
            padding: 16px;
            border: 1px solid #e2e8f0;
            border-radius: 11px;
            background: #f8fafc;
        }

        .carnate-expenses-report .description-label {
            margin-bottom: 7px;
            color: #64748b;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
        }

        .carnate-expenses-report .description-text {
            color: #334155;
            font-size: 14px;
            line-height: 1.6;
        }

        .carnate-expenses-report .detail-footer {
            flex: 0 0 auto;
            padding: 15px 22px;
            border-top: 1px solid #e2e8f0;
            display: flex;
            justify-content: flex-end;
        }

        .carnate-expenses-report .close-btn {
            min-height: 40px;
            padding: 0 17px;
            border: 1px solid #e2e8f0;
            border-radius: 9px;
            background: #fff;
            color: #475569;
            font-size: 13px;
            font-weight: 600;
        }

        .carnate-expenses-report .close-btn:hover {
            background: #f8fafc;
            color: #111827;
        }

        @media (max-width: 1199px) {
            .carnate-expenses-report .report-header {
                align-items: flex-start !important;
                flex-direction: column;
                gap: 18px;
            }

            .carnate-expenses-report .filters {
                width: 100%;
                justify-content: flex-start;
            }

            .carnate-expenses-report .detail-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 767px) {
            .carnate-expenses-report .report-header {
                padding: 18px;
            }

            .carnate-expenses-report .filters {
                display: grid;
                grid-template-columns: 1fr;
                width: 100%;
            }

            .carnate-expenses-report .filter-item,
            .carnate-expenses-report .filter-item.search-item {
                min-width: 100%;
            }

            .carnate-expenses-report .export-btn {
                width: 100%;
                justify-content: center;
            }

            .carnate-expenses-report .summary-section {
                padding: 16px 16px 2px;
            }

            .carnate-expenses-report .table-header {
                padding: 16px;
            }

            .carnate-expenses-report .table-footer {
                align-items: flex-start;
                flex-direction: column;
            }

            .carnate-expenses-report .pagination-wrap {
                width: 100%;
                justify-content: flex-start;
                overflow-x: auto;
            }

            .carnate-expenses-report .detail-modal {
                padding: 10px;
            }

            .carnate-expenses-report .detail-dialog,
            .carnate-expenses-report .detail-content {
                max-height: calc(100vh - 20px);
            }

            .carnate-expenses-report .detail-header,
            .carnate-expenses-report .detail-body,
            .carnate-expenses-report .detail-footer {
                padding-left: 18px;
                padding-right: 18px;
            }

            .carnate-expenses-report .detail-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="report-card">

        {{-- Header + Filters --}}
        <div class="report-header d-flex align-items-center justify-content-between">

            <div class="title-wrap">
                <div class="title-icon">
                    <i class="bx bx-receipt"></i>
                </div>

                <div>
                    <h5 class="report-title">Expenses Report</h5>
                    <p class="report-subtitle">
                        Review, filter and analyse expense records
                    </p>
                </div>
            </div>

            <div class="filters">

                {{-- Search --}}
                <div class="filter-item search-item">
                    <label class="filter-label">Search</label>
                    <input
                        type="text"
                        class="form-control filter-control"
                        placeholder="Search bill, supplier, category..."
                        wire:model.live="search"
                    >
                </div>

                {{-- Filter Type --}}
                <div class="filter-item">
                    <label class="filter-label">Filter Type</label>
                    <select class="form-select filter-control" wire:model.live="filterType">
                        <option value="">All</option>
                        <option value="daily">Today</option>
                        <option value="weekly">This Week</option>
                        <option value="monthly">This Month</option>
                    </select>
                </div>

                {{-- From --}}
                <div class="filter-item">
                    <label class="filter-label">From</label>
                    <input
                        type="date"
                        class="form-control filter-control"
                        wire:model.lazy="fromDate"
                    >
                </div>

                {{-- To --}}
                <div class="filter-item">
                    <label class="filter-label">To</label>
                    <input
                        type="date"
                        class="form-control filter-control"
                        wire:model.lazy="toDate"
                    >
                </div>

                {{-- Export --}}
                <div class="filter-item">
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

        {{-- Summary --}}
        <div class="summary-section">
            <div class="row g-3">

                <div class="col-6 col-md-3">
                    <div class="summary-card">
                        <div class="summary-content">
                            <div>
                                <p class="summary-label">Total Entries</p>
                                <span class="summary-value">
                                    {{ $totals['count'] ?? 0 }}
                                </span>
                            </div>

                            <div class="summary-icon">
                                <i class="bx bx-list-ul"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="summary-card">
                        <div class="summary-content">
                            <div>
                                <p class="summary-label">Total Amount</p>
                                <span class="summary-value">
                                    ₹{{ number_format((float)($totals['total'] ?? 0), 2) }}
                                </span>
                            </div>

                            <div class="summary-icon red">
                                <i class="bx bx-wallet"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="summary-card">
                        <div class="summary-content">
                            <div>
                                <p class="summary-label">Paid</p>
                                <span class="summary-value">
                                    ₹{{ number_format((float)($totals['paid'] ?? 0), 2) }}
                                </span>
                            </div>

                            <div class="summary-icon green">
                                <i class="bx bx-check-circle"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="summary-card">
                        <div class="summary-content">
                            <div>
                                <p class="summary-label">Balance</p>
                                <span class="summary-value">
                                    ₹{{ number_format((float)($totals['balance'] ?? 0), 2) }}
                                </span>
                            </div>

                            <div class="summary-icon orange">
                                <i class="bx bx-time-five"></i>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- Table --}}
        <div class="table-section">
            <div class="table-card">

                <div class="table-header">
                    <h5 class="table-title">Expense Entries</h5>

                    <span class="table-count">
                        {{ $items->total() }} Entries
                    </span>
                </div>

                <div class="table-wrap">
                    <table class="table">
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
                                        <span class="date-text">
                                            {{ $e->date }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="category-badge">
                                            {{ $e->sparePartCategory->title ?? '-' }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="supplier-name">
                                            {{ $e->sparePartSupplier->business_first_name ?? '-' }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="amount">
                                            ₹{{ number_format((float)($e->total_amount ?? 0), 2) }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="amount">
                                            ₹{{ number_format((float)($e->paid_amount ?? 0), 2) }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="balance">
                                            ₹{{ number_format((float)($e->balance_amount ?? 0), 2) }}
                                        </span>
                                    </td>

                                    <td class="text-center">
                                        <button
                                            type="button"
                                            class="view-btn"
                                            wire:click="viewExpense({{ $e->id }})"
                                            title="View"
                                        >
                                            <i class="bx bx-show"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9">
                                        <div class="text-center py-5">
                                            <div class="summary-icon mx-auto mb-3">
                                                <i class="bx bx-receipt"></i>
                                            </div>
                                            <div class="fw-semibold text-secondary">
                                                No expenses found.
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="table-footer">
                    <small class="showing-text">
                        Showing {{ $items->firstItem() }}–{{ $items->lastItem() }}
                        of {{ $items->total() }}
                    </small>

                    <div class="pagination-wrap">
                        {!! $items->links() !!}
                    </div>
                </div>

            </div>
        </div>

    </div>

    {{-- View Modal --}}
    <div
        class="detail-modal"
        style="@if(!$detail) display:none; @endif"
        @if(!$detail) aria-hidden="true" @endif
    >
        <div class="detail-dialog">

            <div class="detail-content">

                <div class="detail-header">
                    <div class="detail-title-wrap">
                        <div class="detail-icon">
                            <i class="bx bx-receipt"></i>
                        </div>

                        <h5 class="detail-title">Expense Details</h5>
                    </div>

                    <button
                        type="button"
                        class="modal-close"
                        wire:click="$set('viewExpenseId', null)"
                    >
                        <i class="bx bx-x"></i>
                    </button>
                </div>

                <div class="detail-body">

                    @if($detail)

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
                                    {{ $detail->sparePartCategory->title ?? '-' }}
                                </div>
                            </div>

                            <div class="detail-item">
                                <div class="detail-label">Supplier</div>
                                <div class="detail-value">
                                    {{ $detail->sparePartSupplier->business_first_name ?? '-' }}
                                </div>
                            </div>

                            <div class="detail-item">
                                <div class="detail-label">Total</div>
                                <div class="detail-value total">
                                    ₹{{ number_format((float)($detail->total_amount ?? 0), 2) }}
                                </div>
                            </div>

                            <div class="detail-item">
                                <div class="detail-label">Paid</div>
                                <div class="detail-value paid">
                                    ₹{{ number_format((float)($detail->paid_amount ?? 0), 2) }}
                                </div>
                            </div>

                            <div class="detail-item">
                                <div class="detail-label">Balance</div>
                                <div class="detail-value balance">
                                    ₹{{ number_format((float)($detail->balance_amount ?? 0), 2) }}
                                </div>
                            </div>

                        </div>

                        <div class="description-box">
                            <div class="description-label">Description</div>

                            <div class="description-text">
                                {{ $detail->description ?? '-' }}
                            </div>
                        </div>

                    @endif

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
    </div>

</div>