<div class="carnate-commission-report-page">

    {{-- =========================
        PAGE HEADER
    ========================== --}}
    <div class="carnate-page-header">

        <div>
            <span class="carnate-page-eyebrow">Reports</span>

            <h1>Commission Report</h1>

            <p>
                Track gross sales, platform commission and net settlement across orders.
            </p>
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
                    placeholder="Search invoice no, order no, part..."
                    wire:model.live.debounce.300ms="search">

            </div>


            {{-- Quick Date Filter --}}
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


            {{-- Exports --}}
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
        SUMMARY CARDS
    ========================== --}}
    <div class="carnate-summary-grid">

        {{-- Gross Sales --}}
        <div class="carnate-summary-card">

            <div class="carnate-summary-content">

                <span class="carnate-summary-label">
                    Total Gross Sales
                </span>

                <strong class="carnate-summary-value">
                    ₹{{ number_format((float)$totals['total_gross'], 2) }}
                </strong>

                <span class="carnate-summary-subtext">
                    Total processed sales
                </span>

            </div>

            <div class="carnate-summary-icon neutral">
                <i class="bx bx-receipt"></i>
            </div>

        </div>


        {{-- Commission --}}
        <div class="carnate-summary-card">

            <div class="carnate-summary-content">

                <span class="carnate-summary-label">
                    Platform Charge / Commission (10%)
                </span>

                <strong class="carnate-summary-value danger">
                    ₹{{ number_format((float)$totals['total_commission'], 2) }}
                </strong>

                <span class="carnate-summary-subtext danger">
                    Commission deducted
                </span>

            </div>

            <div class="carnate-summary-icon red">
                <i class="bx bx-percentage"></i>
            </div>

        </div>


        {{-- Net Settlement --}}
        <div class="carnate-summary-card">

            <div class="carnate-summary-content">

                <span class="carnate-summary-label">
                    Net Settled Payout
                </span>

                <strong class="carnate-summary-value success">
                    ₹{{ number_format((float)$totals['total_net'], 2) }}
                </strong>

                <span class="carnate-summary-subtext success">
                    Amount after commission
                </span>

            </div>

            <div class="carnate-summary-icon green">
                <i class="bx bx-wallet"></i>
            </div>

        </div>

    </div>


    {{-- =========================
        COMMISSION LEDGER
    ========================== --}}
    <div class="carnate-ledger-card">

        <div class="carnate-ledger-header">

            <div>

                <h3>Platform Commission Ledger</h3>

                <p>
                    Detailed breakdown of order amounts, commission and net settlement.
                </p>

            </div>

            <span class="carnate-record-label">
                Commission
            </span>

        </div>


        <div class="carnate-table-wrapper">

            <table class="carnate-commission-table">

                <thead>

                    <tr>
                        <th>Order No.</th>
                        {{-- <th>Invoice No.</th> --}}
                        <th>Order Date</th>
                        <th>Part Details</th>
                        <th class="text-end">Gross Amount</th>
                        <th class="text-center">Commission Rate</th>
                        <th class="text-end">Commission</th>
                        <th class="text-end">Net Settled</th>
                        <th class="text-center">Status</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($items as $item)

                        @php
                            $commissionPercent = (float) getCommission($item->category);
                            $grossAmount = (float) $item->total_amount;
                            $commissionAmount = ($grossAmount * $commissionPercent) / 100;
                            $netAmount = $grossAmount - $commissionAmount;
                        @endphp

                        <tr>

                            {{-- Order --}}
                            <td>

                                <span class="carnate-order-number">
                                    #{{ $item->order_id }}
                                </span>

                            </td>


                            {{-- Order Date --}}
                            <td>

                                <div class="carnate-date-cell">

                                    <span class="carnate-date-main">
                                        {{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->format('d M Y') : 'N/A' }}
                                    </span>

                                    @if($item->created_at)
                                        <span class="carnate-time">
                                            {{ \Carbon\Carbon::parse($item->created_at)->format('h:i A') }}
                                        </span>
                                    @endif

                                </div>

                            </td>


                            {{-- Part Details --}}
                            <td>

                                <div class="carnate-part-cell">

                                    <div class="carnate-part-icon">
                                        <i class="bx bx-package"></i>
                                    </div>

                                    <div>

                                        <strong>
                                            {{ $item->SpareParts->name ?? 'N/A' }}
                                        </strong>

                                        <span>
                                            Qty: {{ $item->quantity }}
                                            <span class="carnate-dot">•</span>
                                            ₹{{ number_format((float)$item->price, 2) }} / unit
                                        </span>

                                    </div>

                                </div>

                            </td>


                            {{-- Gross --}}
                            <td class="text-end">

                                <strong class="carnate-money">
                                    ₹{{ number_format($grossAmount, 2) }}
                                </strong>

                            </td>


                            {{-- Commission Rate --}}
                            <td class="text-center">

                                <span class="carnate-commission-rate">
                                    {{ $commissionPercent }}%
                                </span>

                            </td>


                            {{-- Commission --}}
                            <td class="text-end">

                                <strong class="carnate-money commission">
                                    - ₹{{ number_format($commissionAmount, 2) }}
                                </strong>

                            </td>


                            {{-- Net --}}
                            <td class="text-end">

                                <strong class="carnate-money net">
                                    ₹{{ number_format($netAmount, 2) }}
                                </strong>

                            </td>


                            {{-- Status --}}
                            <td class="text-center">

                                @switch($item->status)

                                    @case(1)

                                        <span class="carnate-status accepted">
                                            <i class="bx bx-check"></i>
                                            Accepted
                                        </span>

                                    @break

                                    @case(3)

                                        <span class="carnate-status handover">
                                            <i class="bx bx-package"></i>
                                            Handover
                                        </span>

                                    @break

                                    @case(4)

                                        <span class="carnate-status received">
                                            <i class="bx bx-check-circle"></i>
                                            Received
                                        </span>

                                    @break

                                    @default

                                        <span class="carnate-status processed">
                                            <i class="bx bx-check"></i>
                                            Processed
                                        </span>

                                @endswitch

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="10">

                                <div class="carnate-empty-state">

                                    <div class="carnate-empty-icon">
                                        <i class="bx bx-bar-chart-alt-2"></i>
                                    </div>

                                    <h4>No Commission Logs Found</h4>

                                    <p>
                                        No commission records were found for the selected filters.
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
            {{ $items->links() }}
        </div>

    </div>


    {{-- =========================
        STYLES
    ========================== --}}
    <style>

        .carnate-commission-report-page {
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

        .carnate-commission-report-page * {
            box-sizing: border-box;
        }


        /* =========================
           PAGE HEADER
        ========================== */

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


        /* =========================
           FILTERS
        ========================== */

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


        /* =========================
           SUMMARY
        ========================== */

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

        .carnate-summary-value.danger {
            color: #dc2626;
        }

        .carnate-summary-value.success {
            color: #15803d;
        }

        .carnate-summary-subtext {
            display: block;
            margin-top: 5px;
            color: #94a3b8;
            font-size: 10px;
            font-weight: 600;
        }

        .carnate-summary-subtext.danger {
            color: #dc2626;
        }

        .carnate-summary-subtext.success {
            color: #15803d;
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

        .carnate-summary-icon.red {
            background: var(--carnate-red-soft);
            color: var(--carnate-red);
        }

        .carnate-summary-icon.green {
            background: #f0fdf4;
            color: #16a34a;
        }


        /* =========================
           LEDGER CARD
        ========================== */

        .carnate-ledger-card {
            overflow: hidden;
            border: 1px solid var(--carnate-border);
            border-radius: 16px;
            background: #fff;
            box-shadow: 0 4px 18px rgba(15, 23, 42, .035);
        }

        .carnate-ledger-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 19px 20px;
            border-bottom: 1px solid var(--carnate-border);
        }

        .carnate-ledger-header h3 {
            margin: 0;
            color: var(--carnate-text);
            font-size: 16px;
            font-weight: 750;
        }

        .carnate-ledger-header p {
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


        /* =========================
           TABLE
        ========================== */

        .carnate-table-wrapper {
            overflow-x: auto;
        }

        .carnate-commission-table {
            width: 100%;
            min-width: 1050px;
            border-collapse: collapse;
        }

        .carnate-commission-table thead th {
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

        .carnate-commission-table tbody td {
            padding: 14px 15px;
            border-bottom: 1px solid #edf1f5;
            color: var(--carnate-text);
            font-size: 12px;
            vertical-align: middle;
        }

        .carnate-commission-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .carnate-commission-table tbody tr:hover {
            background: #fafbfc;
        }


        /* Order Number */

        .carnate-order-number {
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


        /* Date */

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


        /* Part */

        .carnate-part-cell {
            display: flex;
            align-items: center;
            gap: 9px;
            min-width: 220px;
        }

        .carnate-part-icon {
            display: flex;
            flex: 0 0 auto;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 9px;
            background: #f1f5f9;
            color: #64748b;
            font-size: 17px;
        }

        .carnate-part-cell strong {
            display: block;
            color: #334155;
            font-size: 11px;
            font-weight: 700;
        }

        .carnate-part-cell span {
            display: block;
            margin-top: 3px;
            color: #94a3b8;
            font-size: 10px;
        }

        .carnate-dot {
            display: inline !important;
            margin: 0 3px;
            color: #cbd5e1 !important;
        }


        /* Amounts */

        .carnate-money {
            color: #334155;
            font-size: 12px;
            white-space: nowrap;
        }

        .carnate-money.commission {
            color: #dc2626;
        }

        .carnate-money.net {
            color: #15803d;
        }


        /* Commission Rate */

        .carnate-commission-rate {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 46px;
            padding: 6px 8px;
            border-radius: 7px;
            background: var(--carnate-red-soft);
            color: var(--carnate-red);
            font-size: 10px;
            font-weight: 750;
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

        .carnate-status.accepted {
            background: #f1f5f9;
            color: #475569;
        }

        .carnate-status.handover {
            background: #f1f5f9;
            color: #475569;
        }

        .carnate-status.received {
            background: #f0fdf4;
            color: #15803d;
        }

        .carnate-status.processed {
            background: #f1f5f9;
            color: #64748b;
        }

        .carnate-status i {
            font-size: 13px;
        }


        /* =========================
           EMPTY
        ========================== */

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


        /* =========================
           PAGINATION
        ========================== */

        .carnate-pagination {
            padding: 15px 18px;
            border-top: 1px solid var(--carnate-border);
        }


        /* =========================
           RESPONSIVE
        ========================== */

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

        }


        @media (max-width: 767px) {

            .carnate-commission-report-page {
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

            .carnate-ledger-header {
                align-items: flex-start;
                flex-direction: column;
            }

        }

    </style>

</div>