<div class="carnate-expenses-report-page">

    <style>
        .carnate-expenses-report-page {
            --er-red: #e53935;
            --er-red-dark: #c62828;
            --er-red-soft: #fff5f5;
            --er-text: #111827;
            --er-muted: #64748b;
            --er-border: #e2e8f0;
            --er-card: #ffffff;
            --er-green: #16a34a;
            --er-orange: #d97706;
            --er-blue: #2563eb;
            --er-shadow: 0 4px 20px rgba(15, 23, 42, .05);
        }

        .carnate-expenses-report-page {
            color: var(--er-text);
        }

        /* HEADER */
        .carnate-expenses-report-page .er-header {
            background: var(--er-card);
            border: 1px solid var(--er-border);
            border-radius: 14px;
            box-shadow: var(--er-shadow);
            margin-bottom: 18px;
        }

        .carnate-expenses-report-page .er-header-body {
            padding: 18px 20px;
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 20px;
        }

        .carnate-expenses-report-page .er-title {
            margin: 0;
            color: var(--er-text);
            font-size: 22px;
            font-weight: 700;
        }

        .carnate-expenses-report-page .er-subtitle {
            margin: 5px 0 0;
            color: var(--er-muted);
            font-size: 12px;
        }

        /* FILTERS */
        .carnate-expenses-report-page .er-filters {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-end;
            justify-content: flex-end;
            gap: 10px;
        }

        .carnate-expenses-report-page .er-filter {
            min-width: 145px;
        }

        .carnate-expenses-report-page .er-filter-search {
            min-width: 230px;
        }

        .carnate-expenses-report-page .er-label {
            display: block;
            margin-bottom: 5px;
            color: #475569;
            font-size: 11px;
            font-weight: 700;
        }

        .carnate-expenses-report-page .form-control,
        .carnate-expenses-report-page .form-select {
            min-height: 40px;
            border: 1px solid var(--er-border);
            border-radius: 8px;
            color: var(--er-text);
            background: #fff;
            box-shadow: none;
            font-size: 13px;
        }

        .carnate-expenses-report-page .form-control:focus,
        .carnate-expenses-report-page .form-select:focus {
            border-color: rgba(229, 57, 53, .55);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .08);
        }

        .carnate-expenses-report-page .er-export-btn {
            min-height: 40px;
            padding: 9px 14px;
            border: 1px solid var(--er-red);
            border-radius: 8px;
            background: var(--er-red);
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all .18s ease;
        }

        .carnate-expenses-report-page .er-export-btn:hover {
            background: var(--er-red-dark);
            border-color: var(--er-red-dark);
            color: #fff;
            transform: translateY(-1px);
        }

        /* SUMMARY CARDS */
        .carnate-expenses-report-page .er-summary {
            margin-bottom: 18px;
        }

        .carnate-expenses-report-page .er-summary-card {
            height: 100%;
            min-height: 88px;
            padding: 15px 16px;
            background: #fff;
            border: 1px solid var(--er-border);
            border-radius: 13px;
            box-shadow: var(--er-shadow);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .carnate-expenses-report-page .er-summary-label {
            margin: 0 0 5px;
            color: var(--er-muted);
            font-size: 11px;
            font-weight: 600;
        }

        .carnate-expenses-report-page .er-summary-value {
            margin: 0;
            color: var(--er-text);
            font-size: 18px;
            font-weight: 750;
            line-height: 1.2;
        }

        .carnate-expenses-report-page .er-summary-icon {
            width: 40px;
            height: 40px;
            flex: 0 0 40px;
            border-radius: 11px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 19px;
        }

        .carnate-expenses-report-page .er-icon-red {
            background: var(--er-red-soft);
            color: var(--er-red);
        }

        .carnate-expenses-report-page .er-icon-green {
            background: #f0fdf4;
            color: var(--er-green);
        }

        .carnate-expenses-report-page .er-icon-blue {
            background: #eff6ff;
            color: var(--er-blue);
        }

        .carnate-expenses-report-page .er-icon-orange {
            background: #fff7ed;
            color: var(--er-orange);
        }

        /* TABLE */
        .carnate-expenses-report-page .er-table-card {
            background: #fff;
            border: 1px solid var(--er-border);
            border-radius: 14px;
            box-shadow: var(--er-shadow);
            overflow: hidden;
        }

        .carnate-expenses-report-page .er-table-wrap {
            overflow-x: auto;
        }

        .carnate-expenses-report-page .er-table {
            width: 100%;
            min-width: 1050px;
            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .carnate-expenses-report-page .er-table thead th {
            padding: 13px 15px;
            background: #f8fafc;
            color: #475569;
            border-bottom: 1px solid var(--er-border);
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .4px;
            white-space: nowrap;
        }

        .carnate-expenses-report-page .er-table tbody td {
            padding: 14px 15px;
            border-bottom: 1px solid #eef2f7;
            color: #334155;
            font-size: 13px;
            vertical-align: middle;
        }

        .carnate-expenses-report-page .er-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .carnate-expenses-report-page .er-table tbody tr:hover {
            background: #fafbfc;
        }

        .carnate-expenses-report-page .er-index {
            width: 55px;
            color: #94a3b8 !important;
            font-weight: 600;
        }

        .carnate-expenses-report-page .er-bill {
            color: var(--er-text);
            font-weight: 700;
            white-space: nowrap;
        }

        .carnate-expenses-report-page .er-date {
            color: var(--er-muted);
            white-space: nowrap;
        }

        .carnate-expenses-report-page .er-category {
            display: inline-flex;
            padding: 5px 9px;
            border-radius: 7px;
            background: #f8fafc;
            border: 1px solid #e8edf3;
            color: #475569;
            font-size: 11px;
            font-weight: 600;
        }

        .carnate-expenses-report-page .er-supplier {
            color: #334155;
            font-weight: 600;
        }

        .carnate-expenses-report-page .er-money {
            font-weight: 700;
            white-space: nowrap;
        }

        .carnate-expenses-report-page .er-total {
            color: var(--er-text);
        }

        .carnate-expenses-report-page .er-paid {
            color: var(--er-green);
        }

        .carnate-expenses-report-page .er-balance {
            color: var(--er-orange);
        }

        /* VIEW BUTTON */
        .carnate-expenses-report-page .er-view-btn {
            width: 34px;
            height: 34px;
            padding: 0;
            border: 1px solid #dbeafe;
            border-radius: 8px;
            background: #eff6ff;
            color: var(--er-blue);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all .18s ease;
        }

        .carnate-expenses-report-page .er-view-btn:hover {
            background: #dbeafe;
            transform: translateY(-1px);
        }

        /* PAGINATION */
        .carnate-expenses-report-page .er-pagination {
            padding: 15px 18px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .carnate-expenses-report-page .er-pagination-info {
            color: var(--er-muted);
            font-size: 12px;
            white-space: nowrap;
        }

        /* EMPTY */
        .carnate-expenses-report-page .er-empty {
            padding: 55px 20px;
            text-align: center;
        }

        .carnate-expenses-report-page .er-empty-icon {
            width: 54px;
            height: 54px;
            margin: 0 auto 12px;
            border-radius: 14px;
            background: #f1f5f9;
            color: #64748b;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .carnate-expenses-report-page .er-empty-title {
            color: var(--er-text);
            font-size: 14px;
            font-weight: 700;
        }

        .carnate-expenses-report-page .er-empty-text {
            margin-top: 4px;
            color: var(--er-muted);
            font-size: 12px;
        }

        /* MODAL */
        .carnate-expenses-report-page .er-modal {
            position: fixed;
            inset: 0;
            z-index: 1055;
            background: rgba(6, 6, 6, .55);
            overflow-y: auto;
            padding: 30px 15px;
        }

        .carnate-expenses-report-page .er-modal-dialog {
            width: 100%;
            max-width: 850px;
            margin: 0 auto;
        }

        .carnate-expenses-report-page .er-modal-content {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 25px 70px rgba(15, 23, 42, .18);
        }

        .carnate-expenses-report-page .er-modal-header {
            padding: 18px 22px;
            border-bottom: 1px solid var(--er-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .carnate-expenses-report-page .er-modal-title {
            margin: 0;
            color: var(--er-text);
            font-size: 18px;
            font-weight: 700;
        }

        .carnate-expenses-report-page .er-modal-title i {
            color: var(--er-red);
            margin-right: 7px;
        }

        .carnate-expenses-report-page .er-close {
            width: 34px;
            height: 34px;
            padding: 0;
            border: 1px solid var(--er-border);
            border-radius: 8px;
            background: #fff;
            color: #64748b;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .carnate-expenses-report-page .er-close:hover {
            background: var(--er-red-soft);
            border-color: #fecaca;
            color: var(--er-red);
        }

        .carnate-expenses-report-page .er-modal-body {
            padding: 22px;
        }

        .carnate-expenses-report-page .er-detail-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 12px;
        }

        .carnate-expenses-report-page .er-detail-item {
            padding: 13px;
            border: 1px solid var(--er-border);
            border-radius: 10px;
            background: #fff;
        }

        .carnate-expenses-report-page .er-detail-label {
            margin-bottom: 5px;
            color: var(--er-muted);
            font-size: 11px;
        }

        .carnate-expenses-report-page .er-detail-value {
            color: var(--er-text);
            font-size: 13px;
            font-weight: 650;
            word-break: break-word;
        }

        .carnate-expenses-report-page .er-description {
            margin-top: 16px;
            padding: 15px;
            border: 1px solid var(--er-border);
            border-radius: 10px;
            background: #f8fafc;
        }

        .carnate-expenses-report-page .er-description-label {
            margin-bottom: 5px;
            color: var(--er-muted);
            font-size: 11px;
            font-weight: 600;
        }

        .carnate-expenses-report-page .er-description-text {
            color: #334155;
            font-size: 13px;
            line-height: 1.6;
        }

        .carnate-expenses-report-page .er-modal-footer {
            padding: 15px 22px;
            border-top: 1px solid var(--er-border);
            background: #f8fafc;
            display: flex;
            justify-content: flex-end;
        }

        .carnate-expenses-report-page .er-close-btn {
            min-height: 40px;
            padding: 9px 17px;
            border: 1px solid var(--er-border);
            border-radius: 9px;
            background: #fff;
            color: #475569;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
        }

        .carnate-expenses-report-page .er-close-btn:hover {
            background: #f1f5f9;
        }

        @media (max-width: 1100px) {
            .carnate-expenses-report-page .er-header-body {
                align-items: flex-start;
                flex-direction: column;
            }

            .carnate-expenses-report-page .er-filters {
                width: 100%;
                justify-content: flex-start;
            }

            .carnate-expenses-report-page .er-filter-search {
                flex: 1;
            }
        }

        @media (max-width: 767px) {
            .carnate-expenses-report-page .er-filters {
                display: grid;
                grid-template-columns: 1fr 1fr;
                width: 100%;
            }

            .carnate-expenses-report-page .er-filter,
            .carnate-expenses-report-page .er-filter-search {
                min-width: 0;
                width: 100%;
            }

            .carnate-expenses-report-page .er-export-wrapper {
                grid-column: 1 / -1;
            }

            .carnate-expenses-report-page .er-export-btn {
                width: 100%;
            }

            .carnate-expenses-report-page .er-pagination {
                align-items: flex-start;
                flex-direction: column;
            }

            .carnate-expenses-report-page .er-detail-grid {
                grid-template-columns: 1fr 1fr;
            }

            .carnate-expenses-report-page .er-modal {
                padding: 15px 10px;
            }
        }

        @media (max-width: 480px) {
            .carnate-expenses-report-page .er-filters {
                grid-template-columns: 1fr;
            }

            .carnate-expenses-report-page .er-export-wrapper {
                grid-column: auto;
            }

            .carnate-expenses-report-page .er-detail-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>


    {{-- ============================================================
        HEADER + FILTERS
    ============================================================= --}}

    <div class="er-header">

        <div class="er-header-body">

            <div>

                <h5 class="er-title">
                    Expenses Report
                </h5>

                <p class="er-subtitle">
                    Review, filter and export workshop expense records.
                </p>

            </div>


            <div class="er-filters">

                {{-- Search --}}

                <div class="er-filter-search">

                    <label class="er-label">
                        Search
                    </label>

                    <input
                        type="text"
                        class="form-control form-control-sm"
                        placeholder="Search bill, supplier, category..."
                        wire:model.live="search">

                </div>


                {{-- Filter Type --}}

                <div class="er-filter">

                    <label class="er-label">
                        Filter Type
                    </label>

                    <select
                        class="form-select form-select-sm"
                        wire:model.live="filterType">

                        <option value="">
                            All
                        </option>

                        <option value="daily">
                            Today
                        </option>

                        <option value="weekly">
                            This Week
                        </option>

                        <option value="monthly">
                            This Month
                        </option>

                    </select>

                </div>


                {{-- From Date --}}

                <div class="er-filter">

                    <label class="er-label">
                        From
                    </label>

                    <input
                        type="date"
                        class="form-control form-control-sm"
                        wire:model.lazy="fromDate">

                </div>


                {{-- To Date --}}

                <div class="er-filter">

                    <label class="er-label">
                        To
                    </label>

                    <input
                        type="date"
                        class="form-control form-control-sm"
                        wire:model.lazy="toDate">

                </div>


                {{-- Export PDF --}}

                <div class="er-export-wrapper">

                    <label class="er-label">
                        &nbsp;
                    </label>

                    <button
                        type="button"
                        class="er-export-btn"
                        wire:click="downloadPDF">

                        <i class="bx bxs-file-pdf"></i>

                        Export PDF

                    </button>

                </div>

            </div>

        </div>

    </div>


    {{-- ============================================================
        SUMMARY
    ============================================================= --}}

    <div class="er-summary">

        <div class="row g-3">

            {{-- Total Entries --}}

            <div class="col-6 col-md-3">

                <div class="er-summary-card">

                    <div>

                        <p class="er-summary-label">
                            Total Entries
                        </p>

                        <p class="er-summary-value">
                            {{ $totals['count'] ?? 0 }}
                        </p>

                    </div>

                    <span class="er-summary-icon er-icon-red">
                        <i class="bx bx-list-ul"></i>
                    </span>

                </div>

            </div>


            {{-- Total Amount --}}

            <div class="col-6 col-md-3">

                <div class="er-summary-card">

                    <div>

                        <p class="er-summary-label">
                            Total Amount
                        </p>

                        <p class="er-summary-value">

                            ₹{{ number_format((float)($totals['total'] ?? 0), 2) }}

                        </p>

                    </div>

                    <span class="er-summary-icon er-icon-green">
                        <i class="bx bx-rupee"></i>
                    </span>

                </div>

            </div>


            {{-- Paid --}}

            <div class="col-6 col-md-3">

                <div class="er-summary-card">

                    <div>

                        <p class="er-summary-label">
                            Paid
                        </p>

                        <p class="er-summary-value">

                            ₹{{ number_format((float)($totals['paid'] ?? 0), 2) }}

                        </p>

                    </div>

                    <span class="er-summary-icon er-icon-blue">
                        <i class="bx bx-check-circle"></i>
                    </span>

                </div>

            </div>


            {{-- Balance --}}

            <div class="col-6 col-md-3">

                <div class="er-summary-card">

                    <div>

                        <p class="er-summary-label">
                            Balance
                        </p>

                        <p class="er-summary-value">

                            ₹{{ number_format((float)($totals['balance'] ?? 0), 2) }}

                        </p>

                    </div>

                    <span class="er-summary-icon er-icon-orange">
                        <i class="bx bx-wallet"></i>
                    </span>

                </div>

            </div>

        </div>

    </div>


    {{-- ============================================================
        TABLE
    ============================================================= --}}

    <div class="er-table-card">

        <div class="er-table-wrap">

            <table class="er-table table-hover align-middle">

                <thead>

                    <tr>

                        <th>
                            #
                        </th>

                        <th>
                            Bill No
                        </th>

                        <th>
                            Date
                        </th>

                        <th>
                            Category
                        </th>

                        <th>
                            Supplier
                        </th>

                        <th>
                            Total
                        </th>

                        <th>
                            Paid
                        </th>

                        <th>
                            Balance
                        </th>

                        <th class="text-center">
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($items as $e)

                        <tr>

                            <td class="er-index">

                                {{ $loop->iteration + ($items->currentPage()-1) * $items->perPage() }}

                            </td>


                            <td class="er-bill">

                                {{ $e->bill_number }}

                            </td>


                            <td class="er-date">

                                {{ $e->date }}

                            </td>


                            <td>

                                <span class="er-category">

                                    {{ $e->workshopCategory->title ?? '-' }}

                                </span>

                            </td>


                            <td class="er-supplier">

                                {{ $e->workshopSupplier->business_first_name ?? '-' }}

                            </td>


                            <td class="er-money er-total">

                                ₹{{ number_format((float)($e->total_amount ?? 0), 2) }}

                            </td>


                            <td class="er-money er-paid">

                                ₹{{ number_format((float)($e->paid_amount ?? 0), 2) }}

                            </td>


                            <td class="er-money er-balance">

                                ₹{{ number_format((float)($e->balance_amount ?? 0), 2) }}

                            </td>


                            <td class="text-center">

                                <button
                                    type="button"
                                    wire:click="viewExpense({{ $e->id }})"
                                    title="View"
                                    class="er-view-btn">

                                    <i class="bx bx-show"></i>

                                </button>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="9">

                                <div class="er-empty">

                                    <div class="er-empty-icon">

                                        <i class="bx bx-receipt"></i>

                                    </div>

                                    <div class="er-empty-title">
                                        No expenses found.
                                    </div>

                                    <div class="er-empty-text">
                                        Expense records matching your filters will appear here.
                                    </div>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Pagination --}}

        <div class="er-pagination">

            <small class="er-pagination-info">

                Showing
                {{ $items->firstItem() }}
                –
                {{ $items->lastItem() }}
                of
                {{ $items->total() }}

            </small>

            <div>
                {!! $items->links() !!}
            </div>

        </div>

    </div>


    {{-- ============================================================
        VIEW EXPENSE MODAL
    ============================================================= --}}

    <div
        class="er-modal"
        tabindex="-1"
        style="
            @if($detail)
                display:block;
            @else
                display:none;
            @endif
        "
        @if(!$detail)
            aria-hidden="true"
        @endif>

        <div class="er-modal-dialog">

            <div class="er-modal-content">

                <div class="er-modal-header">

                    <h5 class="er-modal-title">

                        <i class="bx bx-receipt"></i>

                        Expense Details

                    </h5>

                    <button
                        type="button"
                        class="er-close"
                        wire:click="$set('viewExpenseId', null)">

                        <i class="bx bx-x"></i>

                    </button>

                </div>


                <div class="er-modal-body">

                    @if($detail)

                        <div class="er-detail-grid">

                            <div class="er-detail-item">

                                <div class="er-detail-label">
                                    Bill No
                                </div>

                                <div class="er-detail-value">
                                    {{ $detail->bill_number }}
                                </div>

                            </div>


                            <div class="er-detail-item">

                                <div class="er-detail-label">
                                    Date
                                </div>

                                <div class="er-detail-value">
                                    {{ $detail->date }}
                                </div>

                            </div>


                            <div class="er-detail-item">

                                <div class="er-detail-label">
                                    Category
                                </div>

                                <div class="er-detail-value">
                                    {{ $detail->workshopCategory->title ?? '-' }}
                                </div>

                            </div>


                            <div class="er-detail-item">

                                <div class="er-detail-label">
                                    Supplier
                                </div>

                                <div class="er-detail-value">
                                    {{ $detail->workshopSupplier->business_first_name ?? '-' }}
                                </div>

                            </div>


                            <div class="er-detail-item">

                                <div class="er-detail-label">
                                    Total
                                </div>

                                <div class="er-detail-value">
                                    ₹{{ number_format((float)($detail->total_amount ?? 0), 2) }}
                                </div>

                            </div>


                            <div class="er-detail-item">

                                <div class="er-detail-label">
                                    Paid
                                </div>

                                <div class="er-detail-value">
                                    ₹{{ number_format((float)($detail->paid_amount ?? 0), 2) }}
                                </div>

                            </div>


                            <div class="er-detail-item">

                                <div class="er-detail-label">
                                    Balance
                                </div>

                                <div
                                    class="er-detail-value"
                                    style="color:#d97706;">

                                    ₹{{ number_format((float)($detail->balance_amount ?? 0), 2) }}

                                </div>

                            </div>

                        </div>


                        <div class="er-description">

                            <div class="er-description-label">
                                Description
                            </div>

                            <div class="er-description-text">
                                {{ $detail->description ?? '-' }}
                            </div>

                        </div>

                    @endif

                </div>


                <div class="er-modal-footer">

                    <button
                        type="button"
                        class="er-close-btn"
                        wire:click="$set('viewExpenseId', null)">

                        Close

                    </button>

                </div>

            </div>

        </div>

    </div>

</div>