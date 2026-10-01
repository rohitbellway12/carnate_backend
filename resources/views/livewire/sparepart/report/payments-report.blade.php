<div class="carnate-payments-report-page">

    {{-- =========================
        PAGE HEADER
    ========================== --}}
    <div class="carnate-page-header">
        <div>
            <span class="carnate-page-eyebrow">Reports</span>
            <h1>Payments Report</h1>
            <p>Track wallet activity, earnings, withdrawals and linked order transactions.</p>
        </div>
    </div>


    {{-- =========================
        FILTERS
    ========================== --}}
    <div class="carnate-filter-card">

        <div class="carnate-filter-row">

            <div class="carnate-search-box">
                <i class="bx bx-search"></i>

                <input type="text"
                    class="carnate-search-input"
                    placeholder="Search invoice no, order no..."
                    wire:model.live.debounce.300ms="search">
            </div>

            <div class="carnate-filter-control">
                <select class="carnate-select" wire:model.live="filterType">
                    <option value="">All Time</option>
                    <option value="daily">Today</option>
                    <option value="weekly">This Week</option>
                    <option value="monthly">This Month</option>
                </select>
            </div>

            <div class="carnate-filter-control">
                <input type="date"
                    class="carnate-date-input"
                    wire:model.live="fromDate">
            </div>

            <div class="carnate-filter-control">
                <input type="date"
                    class="carnate-date-input"
                    wire:model.live="toDate">
            </div>

            <div class="carnate-filter-control">
                <select class="carnate-select" wire:model.live="typeFilter">
                    <option value="">All Types</option>
                    <option value="0">Earnings / Deposits</option>
                    <option value="1">Withdrawals</option>
                </select>
            </div>

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

        <div class="carnate-summary-card">

            <div class="carnate-summary-content">

                <span class="carnate-summary-label">
                    Current Wallet Balance
                </span>

                <strong class="carnate-summary-value">
                    ₹{{ number_format((float)$totals['balance'], 2) }}
                </strong>

                <span class="carnate-summary-subtext">
                    Available wallet balance
                </span>

            </div>

            <div class="carnate-summary-icon neutral">
                <i class="bx bx-wallet"></i>
            </div>

        </div>


        <div class="carnate-summary-card">

            <div class="carnate-summary-content">

                <span class="carnate-summary-label">
                    Total Earnings
                </span>

                <strong class="carnate-summary-value">
                    ₹{{ number_format((float)$totals['earnings'], 2) }}
                </strong>

                <span class="carnate-summary-subtext success">
                    Earnings / deposits
                </span>

            </div>

            <div class="carnate-summary-icon green">
                <i class="bx bx-trending-up"></i>
            </div>

        </div>


        <div class="carnate-summary-card">

            <div class="carnate-summary-content">

                <span class="carnate-summary-label">
                    Total Withdrawals
                </span>

                <strong class="carnate-summary-value">
                    ₹{{ number_format((float)$totals['withdrawals'], 2) }}
                </strong>

                <span class="carnate-summary-subtext danger">
                    Withdrawn amount
                </span>

            </div>

            <div class="carnate-summary-icon red">
                <i class="bx bx-trending-down"></i>
            </div>

        </div>

    </div>


    {{-- =========================
        WALLET HISTORY
    ========================== --}}
    <div class="carnate-history-card">

        <div class="carnate-history-header">

            <div>
                <h3>Wallet History</h3>
                <p>Detailed record of wallet deposits, earnings and withdrawals.</p>
            </div>

            <span class="carnate-record-label">
                Transactions
            </span>

        </div>


        <div class="carnate-table-wrapper">

            <table class="carnate-payment-table">

                <thead>
                    <tr>
                        <th>Date / Time</th>
                        <th>Description</th>
                        <th class="text-center">Transaction Type</th>
                        <th class="text-end">Amount</th>
                        <th class="text-end">Wallet Balance</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($transactions as $t)

                        <tr>

                            <td>
                                <div class="carnate-date-cell">

                                    <span class="carnate-date-main">
                                        {{ $t->created_at ? \Carbon\Carbon::parse($t->created_at)->format('d M Y') : 'N/A' }}
                                    </span>

                                    @if($t->created_at)
                                        <span class="carnate-time">
                                            {{ \Carbon\Carbon::parse($t->created_at)->format('h:i A') }}
                                        </span>
                                    @endif

                                </div>
                            </td>


                            <td>

                                <div class="carnate-description-cell">

                                    <div class="carnate-description-icon {{ $t->type == 0 ? 'deposit' : 'withdrawal' }}">
                                        <i class="bx {{ $t->type == 0 ? 'bx-arrow-down-left' : 'bx-arrow-up-right' }}"></i>
                                    </div>

                                    <div>

                                        @if($t->order_id > 0)

                                            <strong>Earning from order</strong>

                                            <span>
                                                Order #{{ $t->order_id }}
                                            </span>

                                        @else

                                            @if($t->type == 1)

                                                <strong>Withdrawal payout request</strong>

                                            @else

                                                <strong>Wallet adjustment / manual deposit</strong>

                                            @endif

                                        @endif

                                    </div>

                                </div>

                            </td>


                            <td class="text-center">

                                @if($t->type == 0)

                                    <span class="carnate-transaction-status deposit">
                                        <i class="bx bx-down-arrow-alt"></i>
                                        Deposit
                                    </span>

                                @else

                                    <span class="carnate-transaction-status withdrawal">
                                        <i class="bx bx-up-arrow-alt"></i>
                                        Withdrawal
                                    </span>

                                @endif

                            </td>


                            <td class="text-end">

                                <strong class="carnate-amount {{ $t->type == 0 ? 'positive' : 'negative' }}">
                                    {{ $t->type == 0 ? '+' : '-' }}
                                    ₹{{ number_format((float)$t->amount, 2) }}
                                </strong>

                            </td>


                            <td class="text-end">

                                <strong class="carnate-wallet-balance">
                                    ₹{{ number_format((float)$t->total, 2) }}
                                </strong>

                            </td>


                            <td class="text-center">

                                @if($t->order_id > 0)

                                    <button type="button"
                                        class="carnate-view-btn"
                                        wire:click="viewOrder({{ $t->order_id }})"
                                        data-bs-toggle="modal"
                                        data-bs-target="#orderDetailsModal">

                                        <i class="bx bx-show"></i>
                                        View Order

                                    </button>

                                @else

                                    <span class="carnate-no-link">
                                        <i class="bx bx-minus"></i>
                                        No links
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6">

                                <div class="carnate-empty-state">

                                    <div class="carnate-empty-icon">
                                        <i class="bx bx-wallet"></i>
                                    </div>

                                    <h4>No Transactions Found</h4>

                                    <p>
                                        No wallet transactions were found for the selected period.
                                    </p>

                                </div>

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        <div class="carnate-pagination">
            {{ $transactions->links() }}
        </div>

    </div>


    {{-- =========================
        ORDER DETAILS MODAL
    ========================== --}}
    <div wire:ignore.self
        class="modal fade"
        id="orderDetailsModal"
        tabindex="-1"
        aria-hidden="true">

        <div class="modal-dialog modal-xl modal-dialog-centered">

            <div class="modal-content carnate-order-modal">

                <div class="carnate-modal-header">

                    <div>
                        <span class="carnate-modal-eyebrow">
                            Linked Order
                        </span>

                        <h4>
                            Order #{{ $viewOrderId }}
                        </h4>
                    </div>

                    <button type="button"
                        class="carnate-modal-close"
                        data-bs-dismiss="modal"
                        aria-label="Close">

                        <i class="bx bx-x"></i>

                    </button>

                </div>


                <div class="carnate-order-modal-body">

                    @if($selectedOrder)

                        @php
                            $myItems = $selectedOrder->orderItem->where('user_id', $vendorId);
                        @endphp


                        {{-- Order Summary --}}
                        <div class="carnate-order-summary-card">

                            <div class="carnate-section-heading">

                                <div class="carnate-section-icon">
                                    <i class="bx bx-receipt"></i>
                                </div>

                                <div>
                                    <h5>Order Summary</h5>
                                    <span>Order and payment information</span>
                                </div>

                            </div>


                            <div class="carnate-order-info-grid">

                                <div class="carnate-order-info-item">

                                    <span>Order No.</span>

                                    <strong>
                                        #{{ $selectedOrder->id }}
                                    </strong>

                                </div>


                                <div class="carnate-order-info-item">

                                    <span>Invoice No.</span>

                                    <strong>
                                        {{ sparepartOrderReference($selectedOrder, $vendor ?? null) }}
                                    </strong>

                                </div>


                                <div class="carnate-order-info-item">

                                    <span>Order Date</span>

                                    <strong>
                                        {{ $selectedOrder->order_date ? \Carbon\Carbon::parse($selectedOrder->order_date)->format('d M Y, h:i A') : 'N/A' }}
                                    </strong>

                                </div>


                                <div class="carnate-order-info-item">

                                    <span>Payment Status</span>

                                    <div>

                                        @switch($selectedOrder->payment_status)

                                            @case(0)
                                                <span class="carnate-status unpaid">
                                                    <i class="bx bx-time-five"></i>
                                                    Pending
                                                </span>
                                            @break

                                            @case(1)
                                                <span class="carnate-status paid">
                                                    <i class="bx bx-check-circle"></i>
                                                    Paid
                                                </span>
                                            @break

                                            @case(2)
                                                <span class="carnate-status partial">
                                                    <i class="bx bx-loader-circle"></i>
                                                    Partial
                                                </span>
                                            @break

                                        @endswitch

                                    </div>

                                </div>


                                <div class="carnate-order-info-item">

                                    <span>Order Status</span>

                                    <div>

                                        @switch($selectedOrder->order_status)

                                            @case(0)
                                                <span class="carnate-status unpaid">
                                                    <i class="bx bx-time-five"></i>
                                                    Pending
                                                </span>
                                            @break

                                            @case(1)
                                                <span class="carnate-status accepted">
                                                    <i class="bx bx-check"></i>
                                                    Accepted
                                                </span>
                                            @break

                                            @case(2)
                                                <span class="carnate-status declined">
                                                    <i class="bx bx-x"></i>
                                                    Declined
                                                </span>
                                            @break

                                            @case(3)
                                                <span class="carnate-status handover">
                                                    <i class="bx bx-package"></i>
                                                    Handover
                                                </span>
                                            @break

                                            @case(4)
                                                <span class="carnate-status paid">
                                                    <i class="bx bx-check-circle"></i>
                                                    Received
                                                </span>
                                            @break

                                        @endswitch

                                    </div>

                                </div>

                            </div>

                        </div>


                        {{-- Supplied Parts --}}
                        <div class="carnate-parts-section">

                            <div class="carnate-section-heading">

                                <div class="carnate-section-icon">
                                    <i class="bx bx-package"></i>
                                </div>

                                <div>
                                    <h5>Supplied Parts</h5>
                                    <span>Parts supplied against this order</span>
                                </div>

                            </div>


                            <div class="carnate-table-wrapper">

                                <table class="carnate-parts-table">

                                    <thead>
                                        <tr>
                                            <th>Part Name</th>
                                            <th>Brand</th>
                                            <th class="text-center">Qty</th>
                                            <th class="text-end">Unit Price</th>
                                            <th class="text-end">Total</th>
                                            <th class="text-center">Status</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @foreach($myItems as $item)

                                            <tr>

                                                <td>

                                                    <div class="carnate-part-cell">

                                                        <div class="carnate-part-icon">
                                                            <i class="bx bx-cube"></i>
                                                        </div>

                                                        <strong>
                                                            {{ $item->SpareParts->name ?? 'N/A' }}
                                                        </strong>

                                                    </div>

                                                </td>

                                                <td>
                                                    <span class="carnate-muted-value">
                                                        {{ $item->SpareParts->brand ?? 'N/A' }}
                                                    </span>
                                                </td>

                                                <td class="text-center">

                                                    <span class="carnate-quantity">
                                                        {{ $item->quantity }}
                                                    </span>

                                                </td>

                                                <td class="text-end">

                                                    <span class="carnate-money">
                                                        ₹{{ number_format((float)$item->price, 2) }}
                                                    </span>

                                                </td>

                                                <td class="text-end">

                                                    <strong class="carnate-money strong">
                                                        ₹{{ number_format((float)$item->total_amount, 2) }}
                                                    </strong>

                                                </td>

                                                <td class="text-center">

                                                    @switch($item->status)

                                                        @case(0)
                                                            <span class="carnate-status unpaid">
                                                                <i class="bx bx-time-five"></i>
                                                                Pending
                                                            </span>
                                                        @break

                                                        @case(1)
                                                            <span class="carnate-status accepted">
                                                                <i class="bx bx-check"></i>
                                                                Accepted
                                                            </span>
                                                        @break

                                                        @case(2)
                                                            <span class="carnate-status declined">
                                                                <i class="bx bx-x"></i>
                                                                Declined
                                                            </span>
                                                        @break

                                                        @case(3)
                                                            <span class="carnate-status handover">
                                                                <i class="bx bx-package"></i>
                                                                Handover
                                                            </span>
                                                        @break

                                                        @case(4)
                                                            <span class="carnate-status paid">
                                                                <i class="bx bx-check-circle"></i>
                                                                Received
                                                            </span>
                                                        @break

                                                        @case(5)
                                                            <span class="carnate-status partial">
                                                                <i class="bx bx-time"></i>
                                                                Delayed
                                                            </span>
                                                        @break

                                                    @endswitch

                                                </td>

                                            </tr>

                                        @endforeach

                                    </tbody>

                                </table>

                            </div>

                        </div>

                    @endif

                </div>


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

        .carnate-payments-report-page {
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

        .carnate-payments-report-page * {
            box-sizing: border-box;
        }

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
            color: var(--carnate-text);
            font-size: 28px;
            font-weight: 750;
            letter-spacing: -.03em;
        }

        .carnate-page-header p {
            margin: 7px 0 0;
            color: var(--carnate-muted);
            font-size: 14px;
        }

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
            flex: 1 1 280px;
            max-width: 310px;
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

        .carnate-summary-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
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

        .carnate-summary-icon.red {
            background: var(--carnate-red-soft);
            color: var(--carnate-red);
        }

        .carnate-history-card {
            overflow: hidden;
            border: 1px solid var(--carnate-border);
            border-radius: 16px;
            background: #fff;
            box-shadow: 0 4px 18px rgba(15, 23, 42, .035);
        }

        .carnate-history-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 19px 20px;
            border-bottom: 1px solid var(--carnate-border);
        }

        .carnate-history-header h3 {
            margin: 0;
            color: var(--carnate-text);
            font-size: 16px;
            font-weight: 750;
        }

        .carnate-history-header p {
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

        .carnate-table-wrapper {
            overflow-x: auto;
        }

        .carnate-payment-table {
            width: 100%;
            min-width: 1000px;
            border-collapse: collapse;
        }

        .carnate-payment-table thead th,
        .carnate-parts-table thead th {
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

        .carnate-payment-table tbody td,
        .carnate-parts-table tbody td {
            padding: 14px 15px;
            border-bottom: 1px solid #edf1f5;
            color: var(--carnate-text);
            font-size: 12px;
            vertical-align: middle;
        }

        .carnate-payment-table tbody tr:last-child td,
        .carnate-parts-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .carnate-payment-table tbody tr:hover {
            background: #fafbfc;
        }

        .carnate-date-cell {
            display: flex;
            flex-direction: column;
            gap: 2px;
            white-space: nowrap;
        }

        .carnate-date-main {
            color: #334155;
            font-size: 11px;
            font-weight: 650;
        }

        .carnate-time {
            color: #94a3b8;
            font-size: 10px;
        }

        .carnate-description-cell {
            display: flex;
            align-items: center;
            gap: 9px;
            min-width: 220px;
        }

        .carnate-description-icon {
            display: flex;
            flex: 0 0 auto;
            align-items: center;
            justify-content: center;
            width: 34px;
            height: 34px;
            border-radius: 9px;
            font-size: 17px;
        }

        .carnate-description-icon.deposit {
            background: #f0fdf4;
            color: #16a34a;
        }

        .carnate-description-icon.withdrawal {
            background: var(--carnate-red-soft);
            color: var(--carnate-red);
        }

        .carnate-description-cell strong {
            display: block;
            color: #334155;
            font-size: 11px;
            font-weight: 700;
        }

        .carnate-description-cell span {
            display: block;
            margin-top: 3px;
            color: #94a3b8;
            font-size: 10px;
        }

        .carnate-transaction-status,
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

        .carnate-transaction-status.deposit,
        .carnate-status.paid {
            background: #f0fdf4;
            color: #15803d;
        }

        .carnate-transaction-status.withdrawal,
        .carnate-status.unpaid,
        .carnate-status.declined {
            background: #fef2f2;
            color: #dc2626;
        }

        .carnate-status.partial {
            background: #fffbeb;
            color: #b45309;
        }

        .carnate-status.accepted,
        .carnate-status.handover {
            background: #f1f5f9;
            color: #475569;
        }

        .carnate-transaction-status i,
        .carnate-status i {
            font-size: 13px;
        }

        .carnate-amount {
            font-size: 12px;
            white-space: nowrap;
        }

        .carnate-amount.positive {
            color: #15803d;
        }

        .carnate-amount.negative {
            color: #dc2626;
        }

        .carnate-wallet-balance {
            color: #334155;
            font-size: 12px;
            white-space: nowrap;
        }

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

        .carnate-no-link {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            color: #94a3b8;
            font-size: 10px;
            font-weight: 600;
        }

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

        .carnate-pagination {
            padding: 15px 18px;
            border-top: 1px solid var(--carnate-border);
        }

        .carnate-order-modal {
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

        .carnate-order-modal-body {
            max-height: 72vh;
            overflow-y: auto;
            padding: 22px;
        }

        .carnate-order-summary-card {
            margin-bottom: 22px;
            padding: 17px;
            border: 1px solid var(--carnate-border);
            border-radius: 13px;
            background: #f8fafc;
        }

        .carnate-section-heading {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 17px;
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

        .carnate-order-info-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 13px;
        }

        .carnate-order-info-item {
            min-width: 0;
            padding: 12px;
            border: 1px solid #e8edf3;
            border-radius: 9px;
            background: #fff;
        }

        .carnate-order-info-item > span {
            display: block;
            margin-bottom: 5px;
            color: #94a3b8;
            font-size: 9px;
            font-weight: 800;
            letter-spacing: .05em;
            text-transform: uppercase;
        }

        .carnate-order-info-item > strong {
            display: block;
            overflow-wrap: anywhere;
            color: #334155;
            font-size: 11px;
            font-weight: 700;
        }

        .carnate-parts-section {
            margin-top: 5px;
        }

        .carnate-parts-table {
            width: 100%;
            min-width: 800px;
            border-collapse: collapse;
        }

        .carnate-part-cell {
            display: flex;
            align-items: center;
            gap: 9px;
            min-width: 180px;
        }

        .carnate-part-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 auto;
            width: 36px;
            height: 36px;
            border-radius: 8px;
            background: #f1f5f9;
            color: #64748b;
            font-size: 17px;
        }

        .carnate-part-cell strong {
            color: #334155;
            font-size: 11px;
        }

        .carnate-muted-value {
            color: #64748b;
            font-size: 11px;
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

        .carnate-money {
            color: #64748b;
            font-size: 11px;
            white-space: nowrap;
        }

        .carnate-money.strong {
            color: #334155;
            font-size: 12px;
        }

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

        @media (max-width: 1100px) {

            .carnate-summary-grid {
                grid-template-columns: 1fr;
            }

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

            .carnate-export-actions {
                margin-left: 0;
            }

            .carnate-order-info-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

        }

        @media (max-width: 767px) {

            .carnate-payments-report-page {
                padding: 18px 14px;
            }

            .carnate-page-header h1 {
                font-size: 23px;
            }

            .carnate-page-header p {
                font-size: 12px;
            }

            .carnate-filter-control {
                flex-basis: 100%;
            }

            .carnate-select,
            .carnate-date-input {
                width: 100%;
            }

            .carnate-export-actions {
                width: 100%;
            }

            .carnate-export-btn {
                flex: 1;
            }

            .carnate-history-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .carnate-order-info-grid {
                grid-template-columns: 1fr;
            }

            .carnate-order-modal-body {
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