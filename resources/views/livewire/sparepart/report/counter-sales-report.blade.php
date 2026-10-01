<div class="carnate-counter-sales-report-page">

    {{-- =========================
        PAGE HEADER
    ========================== --}}
    <div class="carnate-page-header">

        <div>
            <span class="carnate-page-eyebrow">Reports</span>
            <h1>Counter Sales Report</h1>
            <p>Track counter sales, payments, outstanding balances and customer transactions.</p>
        </div>

    </div>


    {{-- =========================
        FILTERS
    ========================== --}}
    <div class="carnate-filter-card">

        <div class="carnate-filter-row">

            {{-- Search --}}
            <div class="carnate-search-box">

                <i class="bx bx-search"></i>

                <input type="text"
                    class="carnate-search-input"
                    placeholder="Search invoice no or customer name..."
                    wire:model.live.debounce.300ms="search">

            </div>


            {{-- Date Quick Filter --}}
            <div class="carnate-filter-control">

                <select class="carnate-select"
                    wire:model.live="filterType">

                    <option value="">All Time</option>
                    <option value="daily">Today</option>
                    <option value="weekly">This Week</option>
                    <option value="monthly">This Month</option>

                </select>

            </div>


            {{-- From Date --}}
            <div class="carnate-filter-control">

                <input type="date"
                    class="carnate-date-input"
                    wire:model.live="fromDate">

            </div>


            {{-- To Date --}}
            <div class="carnate-filter-control">

                <input type="date"
                    class="carnate-date-input"
                    wire:model.live="toDate">

            </div>


            {{-- Payment Status --}}
            <div class="carnate-filter-control">

                <select class="carnate-select"
                    wire:model.live="statusFilter">

                    <option value="">All Payment Statuses</option>
                    <option value="0">Un-paid</option>
                    <option value="1">Partial Payment</option>
                    <option value="2">Full Paid</option>

                </select>

            </div>


            {{-- Export --}}
            <div class="carnate-export-actions">

                <button type="button"
                    class="carnate-export-btn pdf"
                    wire:click="downloadPDF">

                    <i class="bx bxs-file-pdf"></i>
                    PDF

                </button>

                <button type="button"
                    class="carnate-export-btn excel"
                    wire:click="downloadExcel">

                    <i class="bx bxs-spreadsheet"></i>
                    Excel

                </button>

            </div>

        </div>

    </div>


    {{-- =========================
        SUMMARY
    ========================== --}}
    <div class="carnate-summary-grid">

        {{-- Total Bills --}}
        <div class="carnate-summary-card">

            <div class="carnate-summary-content">

                <span class="carnate-summary-label">
                    Total Bills
                </span>

                <strong class="carnate-summary-value">
                    {{ $totals['total'] }}
                </strong>

                <span class="carnate-summary-subtext">
                    Value: ₹{{ number_format((float)$totals['total_amount'], 2) }}
                </span>

            </div>

            <div class="carnate-summary-icon neutral">
                <i class="bx bx-receipt"></i>
            </div>

        </div>


        {{-- Fully Paid --}}
        <div class="carnate-summary-card">

            <div class="carnate-summary-content">

                <span class="carnate-summary-label">
                    Fully Paid
                </span>

                <strong class="carnate-summary-value">
                    {{ $totals['paid'] }}
                </strong>

                <span class="carnate-summary-subtext success">
                    Collected: ₹{{ number_format((float)$totals['paid_amount'], 2) }}
                </span>

            </div>

            <div class="carnate-summary-icon green">
                <i class="bx bx-check-circle"></i>
            </div>

        </div>


        {{-- Partially Paid --}}
        <div class="carnate-summary-card">

            <div class="carnate-summary-content">

                <span class="carnate-summary-label">
                    Partially Paid
                </span>

                <strong class="carnate-summary-value">
                    {{ $totals['partial'] }}
                </strong>

                <span class="carnate-summary-subtext warning">
                    Pending: ₹{{ number_format((float)$totals['balance_amount'], 2) }}
                </span>

            </div>

            <div class="carnate-summary-icon amber">
                <i class="bx bx-loader-circle"></i>
            </div>

        </div>


        {{-- Unpaid --}}
        <div class="carnate-summary-card">

            <div class="carnate-summary-content">

                <span class="carnate-summary-label">
                    Unpaid Bills
                </span>

                <strong class="carnate-summary-value">
                    {{ $totals['unpaid'] }}
                </strong>

                <span class="carnate-summary-subtext danger">
                    Uncollected: ₹{{ number_format((float)($totals['total_amount'] - $totals['paid_amount']), 2) }}
                </span>

            </div>

            <div class="carnate-summary-icon red">
                <i class="bx bx-x-circle"></i>
            </div>

        </div>

    </div>


    {{-- =========================
        SALES TABLE
    ========================== --}}
    <div class="carnate-sales-card">

        <div class="carnate-sales-card-header">

            <div>
                <h3>Counter Sales List</h3>
                <p>Overview of counter sale invoices and payment collection.</p>
            </div>

            <span class="carnate-record-label">
                Sales
            </span>

        </div>


        <div class="carnate-table-wrapper">

            <table class="carnate-sales-table">

                <thead>
                    <tr>
                        <th>Invoice No.</th>
                        <th>Customer</th>
                        <th>Mobile</th>
                        <th>Date</th>
                        <th class="text-end">Subtotal</th>
                        <th class="text-end">Net Total</th>
                        <th class="text-end">Paid</th>
                        <th class="text-end">Balance</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($sales as $s)

                        @php
                            $discount = (float)$s->total - (float)$s->subtotal;
                        @endphp

                        <tr>

                            {{-- Invoice --}}
                            <td>

                                <span class="carnate-invoice-number">
                                    #{{ $s->countersale_number }}
                                </span>

                            </td>


                            {{-- Customer --}}
                            <td>

                                <div class="carnate-customer-cell">

                                    <div class="carnate-customer-avatar">
                                        <i class="bx bx-user"></i>
                                    </div>

                                    <strong>
                                        {{ $s->Customer->name ?? 'N/A' }}
                                    </strong>

                                </div>

                            </td>


                            {{-- Mobile --}}
                            <td>

                                <span class="carnate-mobile">
                                    {{ $s->Customer->mobile_no ?? 'N/A' }}
                                </span>

                            </td>


                            {{-- Date --}}
                            <td>

                                <span class="carnate-date">
                                    {{ $s->date ? \Carbon\Carbon::parse($s->date)->format('d M Y') : 'N/A' }}
                                </span>

                            </td>


                            {{-- Subtotal --}}
                            <td class="text-end">

                                <span class="carnate-money">
                                    ₹{{ number_format((float)$s->total, 2) }}
                                </span>

                            </td>


                            {{-- Net Total --}}
                            <td class="text-end">

                                <strong class="carnate-money strong">
                                    ₹{{ number_format((float)$s->subtotal, 2) }}
                                </strong>

                            </td>


                            {{-- Paid --}}
                            <td class="text-end">

                                <span class="carnate-money paid">
                                    ₹{{ number_format((float)$s->partial_amount, 2) }}
                                </span>

                            </td>


                            {{-- Balance --}}
                            <td class="text-end">

                                <strong class="carnate-money balance">
                                    ₹{{ number_format((float)$s->balance_amount, 2) }}
                                </strong>

                            </td>


                            {{-- Status --}}
                            <td class="text-center">

                                @switch((int)$s->status)

                                    @case(0)
                                        <span class="carnate-status unpaid">
                                            <i class="bx bx-time-five"></i>
                                            Un-paid
                                        </span>
                                    @break

                                    @case(1)
                                        <span class="carnate-status partial">
                                            <i class="bx bx-loader-circle"></i>
                                            Partial
                                        </span>
                                    @break

                                    @case(2)
                                        <span class="carnate-status paid">
                                            <i class="bx bx-check-circle"></i>
                                            Full Paid
                                        </span>
                                    @break

                                @endswitch

                            </td>


                            {{-- Action --}}
                            <td class="text-center">

                                <button type="button"
                                    class="carnate-view-btn"
                                    wire:click="viewSale({{ $s->id }})"
                                    data-bs-toggle="modal"
                                    data-bs-target="#saleDetailsModal">

                                    <i class="bx bx-show"></i>
                                    View

                                </button>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="10">

                                <div class="carnate-empty-state">

                                    <div class="carnate-empty-icon">
                                        <i class="bx bx-receipt"></i>
                                    </div>

                                    <h4>No Matching Counter Sales</h4>

                                    <p>
                                        No counter sales were found for the selected filters.
                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Pagination --}}
        <div class="carnate-pagination">
            {{ $sales->links() }}
        </div>

    </div>


    {{-- =========================
        SALE DETAILS MODAL
    ========================== --}}
    <div wire:ignore.self
        class="modal fade"
        id="saleDetailsModal"
        tabindex="-1"
        aria-hidden="true">

        <div class="modal-dialog modal-xl modal-dialog-centered">

            <div class="modal-content carnate-sale-modal">

                {{-- Modal Header --}}
                <div class="carnate-modal-header">

                    <div>

                        <span class="carnate-modal-eyebrow">
                            Counter Sale
                        </span>

                        <h4>
                            Sale #{{ $selectedSale->countersale_number ?? '' }}
                        </h4>

                    </div>

                    <button type="button"
                        class="carnate-modal-close"
                        data-bs-dismiss="modal"
                        aria-label="Close">

                        <i class="bx bx-x"></i>

                    </button>

                </div>


                <div class="carnate-sale-modal-body">

                    @if($selectedSale)

                        {{-- =========================
                            CUSTOMER + INVOICE
                        ========================== --}}
                        <div class="carnate-info-grid">

                            {{-- Customer --}}
                            <div class="carnate-info-card">

                                <div class="carnate-info-heading">

                                    <div class="carnate-info-icon">
                                        <i class="bx bx-user"></i>
                                    </div>

                                    <div>
                                        <h5>Customer Details</h5>
                                        <span>Customer information</span>
                                    </div>

                                </div>

                                <div class="carnate-info-list">

                                    <div>
                                        <span>Name</span>
                                        <strong>
                                            {{ $selectedSale->Customer->name ?? 'N/A' }}
                                        </strong>
                                    </div>

                                    <div>
                                        <span>Mobile</span>
                                        <strong>
                                            {{ $selectedSale->Customer->mobile_no ?? 'N/A' }}
                                        </strong>
                                    </div>

                                    <div>
                                        <span>Email</span>
                                        <strong>
                                            {{ $selectedSale->Customer->email ?? '-' }}
                                        </strong>
                                    </div>

                                    <div>
                                        <span>Address</span>
                                        <strong>
                                            {{ $selectedSale->Customer->address ?? '-' }}
                                        </strong>
                                    </div>

                                </div>

                            </div>


                            {{-- Invoice --}}
                            <div class="carnate-info-card">

                                <div class="carnate-info-heading">

                                    <div class="carnate-info-icon">
                                        <i class="bx bx-receipt"></i>
                                    </div>

                                    <div>
                                        <h5>Invoice Details</h5>
                                        <span>Transaction information</span>
                                    </div>

                                </div>

                                <div class="carnate-info-list">

                                    <div>
                                        <span>Date</span>
                                        <strong>
                                            {{ $selectedSale->date ? \Carbon\Carbon::parse($selectedSale->date)->format('d M Y') : 'N/A' }}
                                        </strong>
                                    </div>

                                    <div>
                                        <span>Payment Mode</span>
                                        <strong>
                                            {{ ucfirst($selectedSale->payment_type ?? 'N/A') }}
                                        </strong>
                                    </div>

                                    <div>
                                        <span>GST Applied</span>
                                        <strong>
                                            {{ $selectedSale->is_gst ? 'Yes' : 'No' }}
                                        </strong>
                                    </div>

                                    <div>
                                        <span>Status</span>

                                        <div>

                                            @switch((int)$selectedSale->status)

                                                @case(0)
                                                    <span class="carnate-status unpaid">
                                                        <i class="bx bx-time-five"></i>
                                                        Un-paid
                                                    </span>
                                                @break

                                                @case(1)
                                                    <span class="carnate-status partial">
                                                        <i class="bx bx-loader-circle"></i>
                                                        Partial
                                                    </span>
                                                @break

                                                @case(2)
                                                    <span class="carnate-status paid">
                                                        <i class="bx bx-check-circle"></i>
                                                        Full Paid
                                                    </span>
                                                @break

                                            @endswitch

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>


                        {{-- =========================
                            SALE ITEMS
                        ========================== --}}
                        <div class="carnate-sale-section">

                            <div class="carnate-section-heading">

                                <div class="carnate-section-icon">
                                    <i class="bx bx-package"></i>
                                </div>

                                <div>
                                    <h5>Sold Parts / Items</h5>
                                    <span>Items included in this counter sale</span>
                                </div>

                            </div>


                            <div class="carnate-table-wrapper">

                                <table class="carnate-items-table">

                                    <thead>

                                        <tr>
                                            <th>Part Name</th>
                                            <th class="text-center">Qty</th>
                                            <th class="text-end">Price</th>
                                            <th class="text-end">Total</th>
                                            <th class="text-end">Discount</th>
                                            <th class="text-end">Final Amount</th>
                                        </tr>

                                    </thead>

                                    <tbody>

                                        @foreach($selectedSale->counterSalesSpareParts as $part)

                                            <tr>

                                                <td>

                                                    <div class="carnate-product-cell">

                                                        <div class="carnate-product-placeholder">
                                                            <i class="bx bx-package"></i>
                                                        </div>

                                                        <strong>
                                                            {{ $part->stock_label_name }}
                                                        </strong>

                                                    </div>

                                                </td>

                                                <td class="text-center">

                                                    <span class="carnate-quantity">
                                                        {{ $part->quantity }}
                                                    </span>

                                                </td>

                                                <td class="text-end">

                                                    <span class="carnate-price">
                                                        ₹{{ number_format((float)$part->price, 2) }}
                                                    </span>

                                                </td>

                                                <td class="text-end">

                                                    <span class="carnate-price">
                                                        ₹{{ number_format((float)$part->total_amount, 2) }}
                                                    </span>

                                                </td>

                                                <td class="text-end">

                                                    <span class="carnate-discount">
                                                        ₹{{ number_format((float)$part->discount, 2) }}
                                                    </span>

                                                </td>

                                                <td class="text-end">

                                                    <strong class="carnate-total">
                                                        ₹{{ number_format((float)$part->final_amount, 2) }}
                                                    </strong>

                                                </td>

                                            </tr>

                                        @endforeach

                                    </tbody>

                                </table>

                            </div>

                        </div>


                        {{-- =========================
                            INVOICE SUMMARY
                        ========================== --}}
                        <div class="carnate-summary-wrapper">

                            <div class="carnate-invoice-summary">

                                <div class="carnate-summary-row">

                                    <span>Subtotal Gross</span>

                                    <strong>
                                        ₹{{ number_format((float)$selectedSale->total, 2) }}
                                    </strong>

                                </div>

                                <div class="carnate-summary-row">

                                    <span>Discount Deductions</span>

                                    <strong class="discount">
                                        - ₹{{ number_format((float)($selectedSale->total - $selectedSale->subtotal), 2) }}
                                    </strong>

                                </div>

                                <div class="carnate-summary-row total">

                                    <span>Net Payable</span>

                                    <strong>
                                        ₹{{ number_format((float)$selectedSale->subtotal, 2) }}
                                    </strong>

                                </div>

                                <div class="carnate-summary-row paid">

                                    <span>Total Paid</span>

                                    <strong>
                                        ₹{{ number_format((float)$selectedSale->partial_amount, 2) }}
                                    </strong>

                                </div>

                                <div class="carnate-summary-row balance">

                                    <span>Outstanding Balance</span>

                                    <strong>
                                        ₹{{ number_format((float)$selectedSale->balance_amount, 2) }}
                                    </strong>

                                </div>

                            </div>

                        </div>

                    @endif

                </div>


                {{-- Modal Footer --}}
                <div class="carnate-modal-footer">

                    <button type="button"
                        class="carnate-btn carnate-btn-secondary"
                        data-bs-dismiss="modal">

                        Close

                    </button>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================
        STYLES
    ========================== --}}
    <style>
        .carnate-counter-sales-report-page {
            --carnate-red: #e53935;
            --carnate-red-soft: #fff5f5;
            --carnate-text: #111827;
            --carnate-muted: #64748b;
            --carnate-border: #e2e8f0;

            min-height: calc(100vh - 70px);
            padding: 24px;
            background: #f7f8fa;
            color: var(--carnate-text);
        }

        .carnate-counter-sales-report-page * {
            box-sizing: border-box;
        }

        /* Header */

        .carnate-page-header {
            margin-bottom: 22px;
        }

        .carnate-page-eyebrow {
            display: block;
            margin-bottom: 5px;
            color: var(--carnate-red);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: .12em;
            text-transform: uppercase;
        }

        .carnate-page-header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 750;
            letter-spacing: -.03em;
        }

        .carnate-page-header p {
            margin: 7px 0 0;
            color: var(--carnate-muted);
            font-size: 14px;
        }

        /* Filters */

        .carnate-filter-card {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid var(--carnate-border);
            border-radius: 15px;
            background: #fff;
            box-shadow: 0 4px 18px rgba(15, 23, 42, .035);
        }

        .carnate-filter-row {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 9px;
        }

        .carnate-search-box {
            position: relative;
            flex: 1 1 300px;
            max-width: 330px;
        }

        .carnate-search-box > i {
            position: absolute;
            top: 50%;
            left: 12px;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 17px;
            pointer-events: none;
        }

        .carnate-search-input,
        .carnate-select,
        .carnate-date-input {
            width: 100%;
            height: 40px;
            border: 1px solid var(--carnate-border);
            border-radius: 9px;
            outline: none;
            background: #fff;
            color: var(--carnate-text);
            font-size: 12px;
            transition: .2s ease;
        }

        .carnate-search-input {
            padding: 8px 12px 8px 37px;
        }

        .carnate-select,
        .carnate-date-input {
            min-width: 135px;
            padding: 8px 11px;
        }

        .carnate-filter-control {
            flex: 0 0 auto;
        }

        .carnate-search-input:focus,
        .carnate-select:focus,
        .carnate-date-input:focus {
            border-color: rgba(229, 57, 53, .45);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .07);
        }

        .carnate-export-actions {
            display: flex;
            gap: 7px;
            margin-left: auto;
        }

        .carnate-export-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            height: 40px;
            padding: 0 12px;
            border: 1px solid;
            border-radius: 9px;
            background: #fff;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: .2s ease;
        }

        .carnate-export-btn.pdf {
            border-color: #fecaca;
            color: #dc2626;
        }

        .carnate-export-btn.pdf:hover {
            background: #fef2f2;
        }

        .carnate-export-btn.excel {
            border-color: #bbf7d0;
            color: #15803d;
        }

        .carnate-export-btn.excel:hover {
            background: #f0fdf4;
        }

        .carnate-export-btn i {
            font-size: 17px;
        }

        /* Summary */

        .carnate-summary-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 14px;
            margin-bottom: 20px;
        }

        .carnate-summary-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            min-height: 115px;
            padding: 18px;
            border: 1px solid var(--carnate-border);
            border-radius: 14px;
            background: #fff;
            box-shadow: 0 4px 16px rgba(15, 23, 42, .03);
        }

        .carnate-summary-content {
            min-width: 0;
        }

        .carnate-summary-label {
            display: block;
            margin-bottom: 7px;
            color: var(--carnate-muted);
            font-size: 11px;
            font-weight: 700;
        }

        .carnate-summary-value {
            display: block;
            color: var(--carnate-text);
            font-size: 23px;
            font-weight: 750;
            letter-spacing: -.025em;
            line-height: 1.1;
        }

        .carnate-summary-subtext {
            display: block;
            margin-top: 5px;
            color: #94a3b8;
            font-size: 10px;
            font-weight: 600;
        }

        .carnate-summary-subtext.success {
            color: #15803d;
        }

        .carnate-summary-subtext.warning {
            color: #b45309;
        }

        .carnate-summary-subtext.danger {
            color: #dc2626;
        }

        .carnate-summary-icon {
            display: flex;
            flex: 0 0 auto;
            align-items: center;
            justify-content: center;
            width: 43px;
            height: 43px;
            border-radius: 11px;
            font-size: 21px;
        }

        .carnate-summary-icon.neutral {
            background: #f1f5f9;
            color: #475569;
        }

        .carnate-summary-icon.green {
            background: #f0fdf4;
            color: #16a34a;
        }

        .carnate-summary-icon.amber {
            background: #fffbeb;
            color: #b45309;
        }

        .carnate-summary-icon.red {
            background: var(--carnate-red-soft);
            color: var(--carnate-red);
        }

        /* Main Card */

        .carnate-sales-card {
            overflow: hidden;
            border: 1px solid var(--carnate-border);
            border-radius: 16px;
            background: #fff;
            box-shadow: 0 4px 18px rgba(15, 23, 42, .035);
        }

        .carnate-sales-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 19px 20px;
            border-bottom: 1px solid var(--carnate-border);
        }

        .carnate-sales-card-header h3 {
            margin: 0;
            font-size: 16px;
            font-weight: 750;
        }

        .carnate-sales-card-header p {
            margin: 4px 0 0;
            color: var(--carnate-muted);
            font-size: 11px;
        }

        .carnate-record-label {
            padding: 6px 10px;
            border-radius: 7px;
            background: #f1f5f9;
            color: #64748b;
            font-size: 10px;
            font-weight: 750;
            letter-spacing: .05em;
            text-transform: uppercase;
        }

        /* Table */

        .carnate-table-wrapper {
            overflow-x: auto;
        }

        .carnate-sales-table {
            width: 100%;
            min-width: 1120px;
            border-collapse: collapse;
        }

        .carnate-sales-table thead th,
        .carnate-items-table thead th {
            padding: 13px 15px;
            border-bottom: 1px solid var(--carnate-border);
            background: #f8fafc;
            color: #64748b;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .06em;
            text-align: left;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .carnate-sales-table tbody td,
        .carnate-items-table tbody td {
            padding: 14px 15px;
            border-bottom: 1px solid #edf1f5;
            color: var(--carnate-text);
            font-size: 12px;
            vertical-align: middle;
        }

        .carnate-sales-table tbody tr:last-child td,
        .carnate-items-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .carnate-sales-table tbody tr:hover {
            background: #fafbfc;
        }

        .carnate-invoice-number {
            display: inline-flex;
            align-items: center;
            padding: 6px 8px;
            border-radius: 7px;
            background: #f1f5f9;
            color: #475569;
            font-size: 11px;
            font-weight: 750;
            white-space: nowrap;
        }

        .carnate-customer-cell {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .carnate-customer-avatar {
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 auto;
            width: 31px;
            height: 31px;
            border-radius: 8px;
            background: #f1f5f9;
            color: #64748b;
            font-size: 15px;
        }

        .carnate-customer-cell strong {
            color: #334155;
            font-size: 12px;
        }

        .carnate-mobile,
        .carnate-date {
            color: #64748b;
            font-size: 11px;
            white-space: nowrap;
        }

        .carnate-money {
            color: #64748b;
            font-size: 11px;
            white-space: nowrap;
        }

        .carnate-money.strong {
            color: #334155;
            font-size: 12px;
        }

        .carnate-money.paid {
            color: #15803d;
            font-weight: 650;
        }

        .carnate-money.balance {
            color: #dc2626;
            font-size: 12px;
        }

        /* Status */

        .carnate-status {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            padding: 6px 9px;
            border-radius: 8px;
            font-size: 10px;
            font-weight: 750;
            white-space: nowrap;
        }

        .carnate-status.unpaid {
            background: #fef2f2;
            color: #dc2626;
        }

        .carnate-status.partial {
            background: #fffbeb;
            color: #b45309;
        }

        .carnate-status.paid {
            background: #f0fdf4;
            color: #15803d;
        }

        .carnate-status i {
            font-size: 13px;
        }

        /* View Button */

        .carnate-view-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            min-height: 32px;
            padding: 0 10px;
            border: 1px solid var(--carnate-border);
            border-radius: 8px;
            background: #fff;
            color: #475569;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
            transition: .2s ease;
        }

        .carnate-view-btn:hover {
            border-color: rgba(229, 57, 53, .25);
            background: var(--carnate-red-soft);
            color: var(--carnate-red);
        }

        .carnate-view-btn i {
            font-size: 15px;
        }

        /* Empty */

        .carnate-empty-state {
            display: flex;
            align-items: center;
            flex-direction: column;
            padding: 60px 20px;
            text-align: center;
        }

        .carnate-empty-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 56px;
            height: 56px;
            margin-bottom: 12px;
            border-radius: 14px;
            background: #f1f5f9;
            color: #94a3b8;
            font-size: 26px;
        }

        .carnate-empty-state h4 {
            margin: 0;
            color: var(--carnate-text);
            font-size: 15px;
            font-weight: 700;
        }

        .carnate-empty-state p {
            margin: 6px 0 0;
            color: var(--carnate-muted);
            font-size: 12px;
        }

        /* Pagination */

        .carnate-pagination {
            padding: 15px 18px;
            border-top: 1px solid var(--carnate-border);
        }

        /* Modal */

        .carnate-sale-modal {
            overflow: hidden;
            border: 1px solid var(--carnate-border);
            border-radius: 18px;
            background: #fff;
            box-shadow: 0 24px 70px rgba(15, 23, 42, .18);
        }

        .carnate-modal-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 15px;
            padding: 20px 22px;
            border-bottom: 1px solid var(--carnate-border);
        }

        .carnate-modal-eyebrow {
            display: block;
            margin-bottom: 4px;
            color: var(--carnate-red);
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .1em;
            text-transform: uppercase;
        }

        .carnate-modal-header h4 {
            margin: 0;
            color: var(--carnate-text);
            font-size: 19px;
            font-weight: 750;
        }

        .carnate-modal-close {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 34px;
            height: 34px;
            padding: 0;
            border: 0;
            border-radius: 9px;
            background: #f1f5f9;
            color: #64748b;
            cursor: pointer;
        }

        .carnate-modal-close:hover {
            background: #fee2e2;
            color: var(--carnate-red);
        }

        .carnate-modal-close i {
            font-size: 20px;
        }

        .carnate-sale-modal-body {
            max-height: 72vh;
            overflow-y: auto;
            padding: 22px;
        }

        /* Info Cards */

        .carnate-info-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
            margin-bottom: 24px;
        }

        .carnate-info-card {
            padding: 16px;
            border: 1px solid var(--carnate-border);
            border-radius: 12px;
            background: #f8fafc;
        }

        .carnate-info-heading {
            display: flex;
            align-items: center;
            gap: 9px;
            margin-bottom: 15px;
        }

        .carnate-info-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 35px;
            height: 35px;
            border-radius: 9px;
            background: var(--carnate-red-soft);
            color: var(--carnate-red);
            font-size: 17px;
        }

        .carnate-info-heading h5 {
            margin: 0;
            color: var(--carnate-text);
            font-size: 13px;
            font-weight: 750;
        }

        .carnate-info-heading span {
            display: block;
            margin-top: 2px;
            color: var(--carnate-muted);
            font-size: 10px;
        }

        .carnate-info-list {
            display: grid;
            gap: 10px;
        }

        .carnate-info-list > div {
            display: grid;
            grid-template-columns: 95px 1fr;
            gap: 10px;
        }

        .carnate-info-list > div > span {
            color: #94a3b8;
            font-size: 10px;
            font-weight: 700;
        }

        .carnate-info-list > div > strong {
            overflow-wrap: anywhere;
            color: #334155;
            font-size: 11px;
            font-weight: 650;
        }

        /* Sale Items */

        .carnate-sale-section {
            margin-bottom: 20px;
        }

        .carnate-section-heading {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 14px;
        }

        .carnate-section-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 9px;
            background: var(--carnate-red-soft);
            color: var(--carnate-red);
            font-size: 18px;
        }

        .carnate-section-heading h5 {
            margin: 0;
            color: var(--carnate-text);
            font-size: 14px;
            font-weight: 750;
        }

        .carnate-section-heading span {
            display: block;
            margin-top: 2px;
            color: var(--carnate-muted);
            font-size: 10px;
        }

        .carnate-items-table {
            width: 100%;
            min-width: 700px;
            border-collapse: collapse;
        }

        .carnate-product-cell {
            display: flex;
            align-items: center;
            gap: 9px;
            min-width: 170px;
        }

        .carnate-product-placeholder {
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 auto;
            width: 38px;
            height: 38px;
            border-radius: 8px;
            background: #f1f5f9;
            color: #94a3b8;
            font-size: 17px;
        }

        .carnate-product-cell strong {
            color: #334155;
            font-size: 12px;
        }

        .carnate-quantity {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 32px;
            padding: 5px 8px;
            border-radius: 7px;
            background: #f1f5f9;
            color: #475569;
            font-size: 11px;
            font-weight: 700;
        }

        .carnate-price {
            color: #64748b;
            font-size: 11px;
            white-space: nowrap;
        }

        .carnate-discount {
            color: #b45309;
            font-size: 11px;
            white-space: nowrap;
        }

        .carnate-total {
            color: #334155;
            font-size: 12px;
            white-space: nowrap;
        }

        /* Invoice Summary */

        .carnate-summary-wrapper {
            display: flex;
            justify-content: flex-end;
            margin-top: 15px;
        }

        .carnate-invoice-summary {
            width: min(100%, 390px);
            padding: 15px;
            border: 1px solid var(--carnate-border);
            border-radius: 12px;
            background: #f8fafc;
        }

        .carnate-summary-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 8px 0;
            color: #64748b;
            font-size: 11px;
        }

        .carnate-summary-row strong {
            color: #334155;
            font-weight: 700;
            white-space: nowrap;
        }

        .carnate-summary-row .discount {
            color: #b45309;
        }

        .carnate-summary-row.total {
            margin-top: 4px;
            padding-top: 11px;
            border-top: 1px solid var(--carnate-border);
            color: #334155;
            font-weight: 750;
        }

        .carnate-summary-row.total strong {
            color: var(--carnate-red);
            font-size: 13px;
        }

        .carnate-summary-row.paid strong {
            color: #15803d;
        }

        .carnate-summary-row.balance {
            margin-top: 4px;
            padding-top: 11px;
            border-top: 1px solid var(--carnate-border);
            color: #dc2626;
            font-weight: 750;
        }

        .carnate-summary-row.balance strong {
            color: #dc2626;
            font-size: 13px;
        }

        /* Modal Footer */

        .carnate-modal-footer {
            display: flex;
            justify-content: flex-end;
            padding: 15px 22px;
            border-top: 1px solid var(--carnate-border);
            background: #fafbfc;
        }

        .carnate-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 40px;
            padding: 0 16px;
            border: 0;
            border-radius: 9px;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
        }

        .carnate-btn-secondary {
            background: #f1f5f9;
            color: #475569;
        }

        .carnate-btn-secondary:hover {
            background: #e2e8f0;
        }

        /* Responsive */

        @media (max-width: 1250px) {
            .carnate-summary-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .carnate-export-actions {
                margin-left: 0;
            }
        }

        @media (max-width: 1050px) {

            .carnate-filter-row {
                align-items: stretch;
            }

            .carnate-search-box {
                flex-basis: 100%;
                max-width: none;
            }

            .carnate-filter-control {
                flex: 1 1 180px;
            }

            .carnate-select,
            .carnate-date-input {
                width: 100%;
            }

        }

        @media (max-width: 767px) {

            .carnate-counter-sales-report-page {
                padding: 18px 14px;
            }

            .carnate-page-header h1 {
                font-size: 23px;
            }

            .carnate-page-header p {
                font-size: 12px;
            }

            .carnate-summary-grid {
                grid-template-columns: 1fr;
            }

            .carnate-filter-control {
                flex-basis: 100%;
            }

            .carnate-export-actions {
                width: 100%;
            }

            .carnate-export-btn {
                flex: 1;
            }

            .carnate-sales-card-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .carnate-info-grid {
                grid-template-columns: 1fr;
            }

            .carnate-sale-modal-body {
                padding: 17px;
            }

            .carnate-modal-header {
                padding: 17px;
            }

            .carnate-modal-footer {
                padding: 13px 17px;
            }

        }
    </style>

</div>