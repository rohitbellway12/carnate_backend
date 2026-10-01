<div class="carnate-orders-report-page">

    {{-- =========================
        PAGE HEADER
    ========================== --}}
    <div class="carnate-page-header">

        <div>
            <span class="carnate-page-eyebrow">Reports</span>
            <h1>Orders Report</h1>
            <p>Track orders, supplied parts, payment status and order progress.</p>
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
                    placeholder="Search invoice no, order no..."
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


            {{-- Item Status --}}
            <div class="carnate-filter-control">

                <select class="carnate-select"
                    wire:model.live="statusFilter">

                    <option value="">All Item Statuses</option>
                    <option value="0">Pending</option>
                    <option value="1">Accepted</option>
                    <option value="2">Declined</option>
                    <option value="3">Handover</option>
                    <option value="4">Received</option>
                    <option value="5">Delayed</option>

                </select>

            </div>


            {{-- Payment Status --}}
            <div class="carnate-filter-control">

                <select class="carnate-select"
                    wire:model.live="paymentStatusFilter">

                    <option value="">All Payments</option>
                    <option value="0">Pending</option>
                    <option value="1">Paid</option>
                    <option value="2">Partially Paid</option>

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

        {{-- Total Orders --}}
        <div class="carnate-summary-card">

            <div class="carnate-summary-content">

                <span class="carnate-summary-label">
                    Total Orders
                </span>

                <strong class="carnate-summary-value">
                    {{ $totals['total'] }}
                </strong>

            </div>

            <div class="carnate-summary-icon neutral">
                <i class="bx bx-shopping-bag"></i>
            </div>

        </div>


        {{-- Pending --}}
        <div class="carnate-summary-card">

            <div class="carnate-summary-content">

                <span class="carnate-summary-label">
                    Pending Items
                </span>

                <strong class="carnate-summary-value">
                    {{ $totals['pending'] }}
                </strong>

            </div>

            <div class="carnate-summary-icon red">
                <i class="bx bx-time-five"></i>
            </div>

        </div>


        {{-- Handover / In Flight --}}
        <div class="carnate-summary-card">

            <div class="carnate-summary-content">

                <span class="carnate-summary-label">
                    Handover / In-Flight
                </span>

                <strong class="carnate-summary-value">
                    {{ $totals['handover'] + $totals['accepted'] }}
                </strong>

            </div>

            <div class="carnate-summary-icon purple">
                <i class="bx bx-sync"></i>
            </div>

        </div>


        {{-- Total Value --}}
        <div class="carnate-summary-card">

            <div class="carnate-summary-content">

                <span class="carnate-summary-label">
                    My Items Total Value
                </span>

                <strong class="carnate-summary-value">
                    ₹{{ number_format((float)$totals['total_amount'], 2) }}
                </strong>

            </div>

            <div class="carnate-summary-icon green">
                <i class="bx bx-wallet"></i>
            </div>

        </div>

    </div>


    {{-- =========================
        ORDERS TABLE
    ========================== --}}
    <div class="carnate-orders-card">

        <div class="carnate-orders-card-header">

            <div>
                <h3>Orders List</h3>
                <p>Orders containing parts supplied by your account.</p>
            </div>

            <span class="carnate-record-label">
                Orders
            </span>

        </div>


        <div class="carnate-table-wrapper">

            <table class="carnate-orders-table">

                <thead>
                    <tr>
                        <th>Order No.</th>
                        <th>Invoice No.</th>
                        <th>Order Date</th>
                        <th>Total Items</th>
                        <th class="text-end">My Items Value</th>
                        <th class="text-center">Payment</th>
                        <th class="text-center">Order Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($orders as $o)

                        @php
                            $myItems = $o->orderItem->where('user_id', $vendorId);
                        @endphp

                        <tr>

                            {{-- Order --}}
                            <td>

                                <span class="carnate-order-number">
                                    #{{ $o->id }}
                                </span>

                            </td>


                            {{-- Invoice --}}
                            <td>

                                <strong class="carnate-invoice-number">
                                    {{ sparepartOrderReference($o, $vendor) }}
                                </strong>

                            </td>


                            {{-- Date --}}
                            <td>

                                <span class="carnate-date">
                                    {{ $o->order_date ? \Carbon\Carbon::parse($o->order_date)->format('d M Y, h:i A') : 'N/A' }}
                                </span>

                            </td>


                            {{-- Items --}}
                            <td>

                                <span class="carnate-item-count">
                                    <i class="bx bx-package"></i>
                                    {{ $myItems->count() }}
                                    {{ $myItems->count() == 1 ? 'item' : 'items' }}
                                </span>

                            </td>


                            {{-- Value --}}
                            <td class="text-end">

                                <strong class="carnate-order-value">
                                    ₹{{ number_format((float)$myItems->sum('total_amount'), 2) }}
                                </strong>

                            </td>


                            {{-- Payment --}}
                            <td class="text-center">

                                @switch($o->payment_status)

                                    @case(0)
                                        <span class="carnate-status pending">
                                            <i class="bx bx-time-five"></i>
                                            Pending
                                        </span>
                                    @break

                                    @case(1)
                                        <span class="carnate-status success">
                                            <i class="bx bx-check-circle"></i>
                                            Paid
                                        </span>
                                    @break

                                    @case(2)
                                        <span class="carnate-status partial">
                                            <i class="bx bx-adjust"></i>
                                            Partial
                                        </span>
                                    @break

                                    @default
                                        <span class="carnate-status neutral">
                                            Unknown
                                        </span>

                                @endswitch

                            </td>


                            {{-- Order Status --}}
                            <td class="text-center">

                                @switch($o->order_status)

                                    @case(0)
                                        <span class="carnate-status pending">
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
                                            <i class="bx bx-x-circle"></i>
                                            Declined
                                        </span>
                                    @break

                                    @case(3)
                                        <span class="carnate-status handover">
                                            <i class="bx bx-transfer"></i>
                                            Handover
                                        </span>
                                    @break

                                    @case(4)
                                        <span class="carnate-status success">
                                            <i class="bx bx-check-circle"></i>
                                            Received
                                        </span>
                                    @break

                                    @default
                                        <span class="carnate-status neutral">
                                            Pending
                                        </span>

                                @endswitch

                            </td>


                            {{-- Action --}}
                            <td class="text-center">

                                <button type="button"
                                    class="carnate-view-btn"
                                    wire:click="viewOrder({{ $o->id }})"
                                    data-bs-toggle="modal"
                                    data-bs-target="#orderDetailsModal">

                                    <i class="bx bx-show"></i>
                                    View

                                </button>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="8">

                                <div class="carnate-empty-state">

                                    <div class="carnate-empty-icon">
                                        <i class="bx bx-shopping-bag"></i>
                                    </div>

                                    <h4>No Matching Orders</h4>

                                    <p>
                                        No orders were found for the selected filters.
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
            {{ $orders->links() }}
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

                {{-- Modal Header --}}
                <div class="carnate-modal-header">

                    <div>

                        <span class="carnate-modal-eyebrow">
                            Order Details
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
                        <div class="carnate-detail-section">

                            <div class="carnate-section-heading">

                                <div class="carnate-section-icon">
                                    <i class="bx bx-receipt"></i>
                                </div>

                                <div>
                                    <h5>Order Summary</h5>
                                    <span>Basic order and payment information</span>
                                </div>

                            </div>


                            <div class="carnate-detail-grid">

                                <div class="carnate-detail-item">
                                    <span>Order No.</span>
                                    <strong>#{{ $selectedOrder->id }}</strong>
                                </div>

                                <div class="carnate-detail-item">
                                    <span>Invoice No.</span>
                                    <strong>
                                        {{ sparepartOrderReference($selectedOrder, $vendor) }}
                                    </strong>
                                </div>

                                <div class="carnate-detail-item">
                                    <span>Order Date</span>
                                    <strong>
                                        {{ $selectedOrder->order_date ? \Carbon\Carbon::parse($selectedOrder->order_date)->format('d M Y, h:i A') : 'N/A' }}
                                    </strong>
                                </div>

                                <div class="carnate-detail-item">

                                    <span>Payment Status</span>

                                    <div>

                                        @switch($selectedOrder->payment_status)

                                            @case(0)
                                                <span class="carnate-status pending">
                                                    <i class="bx bx-time-five"></i>
                                                    Pending
                                                </span>
                                            @break

                                            @case(1)
                                                <span class="carnate-status success">
                                                    <i class="bx bx-check-circle"></i>
                                                    Paid
                                                </span>
                                            @break

                                            @case(2)
                                                <span class="carnate-status partial">
                                                    <i class="bx bx-adjust"></i>
                                                    Partial
                                                </span>
                                            @break

                                        @endswitch

                                    </div>

                                </div>

                                <div class="carnate-detail-item">

                                    <span>Order Status</span>

                                    <div>

                                        @switch($selectedOrder->order_status)

                                            @case(0)
                                                <span class="carnate-status pending">
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
                                                    <i class="bx bx-x-circle"></i>
                                                    Declined
                                                </span>
                                            @break

                                            @case(3)
                                                <span class="carnate-status handover">
                                                    <i class="bx bx-transfer"></i>
                                                    Handover
                                                </span>
                                            @break

                                            @case(4)
                                                <span class="carnate-status success">
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
                        <div class="carnate-detail-section">

                            <div class="carnate-section-heading">

                                <div class="carnate-section-icon">
                                    <i class="bx bx-package"></i>
                                </div>

                                <div>
                                    <h5>My Supplied Parts</h5>
                                    <span>Parts supplied for this order</span>
                                </div>

                            </div>


                            <div class="carnate-table-wrapper">

                                <table class="carnate-items-table">

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

                                                {{-- Product --}}
                                                <td>

                                                    <div class="carnate-product-cell">

                                                        @if($item->SpareParts && $item->SpareParts->Image)

                                                            <img src="{{ asset('storage/' . $item->SpareParts->Image->path) }}"
                                                                width="40"
                                                                height="40"
                                                                alt=""
                                                                class="carnate-product-image">

                                                        @else

                                                            <div class="carnate-product-placeholder">
                                                                <i class="bx bx-package"></i>
                                                            </div>

                                                        @endif

                                                        <strong>
                                                            {{ $item->SpareParts->name ?? 'N/A' }}
                                                        </strong>

                                                    </div>

                                                </td>


                                                {{-- Brand --}}
                                                <td>
                                                    <span class="carnate-brand">
                                                        {{ $item->SpareParts->brand ?? 'N/A' }}
                                                    </span>
                                                </td>


                                                {{-- Qty --}}
                                                <td class="text-center">

                                                    <span class="carnate-quantity">
                                                        {{ $item->quantity }}
                                                    </span>

                                                </td>


                                                {{-- Price --}}
                                                <td class="text-end">

                                                    <span class="carnate-price">
                                                        ₹{{ number_format((float)$item->price, 2) }}
                                                    </span>

                                                </td>


                                                {{-- Total --}}
                                                <td class="text-end">

                                                    <strong class="carnate-total">
                                                        ₹{{ number_format((float)$item->total_amount, 2) }}
                                                    </strong>

                                                </td>


                                                {{-- Item Status --}}
                                                <td class="text-center">

                                                    @switch($item->status)

                                                        @case(0)
                                                            <span class="carnate-status pending">
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
                                                                <i class="bx bx-x-circle"></i>
                                                                Declined
                                                            </span>
                                                        @break

                                                        @case(3)
                                                            <span class="carnate-status handover">
                                                                <i class="bx bx-transfer"></i>
                                                                Handover
                                                            </span>
                                                        @break

                                                        @case(4)
                                                            <span class="carnate-status success">
                                                                <i class="bx bx-check-circle"></i>
                                                                Received
                                                            </span>
                                                        @break

                                                        @case(5)
                                                            <span class="carnate-status delayed">
                                                                <i class="bx bx-error-circle"></i>
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
        .carnate-orders-report-page {
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

        .carnate-orders-report-page * {
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
            flex: 1 1 250px;
            max-width: 300px;
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
            min-height: 110px;
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

        .carnate-summary-icon.purple {
            background: #f5f3ff;
            color: #7c3aed;
        }

        .carnate-summary-icon.green {
            background: #f0fdf4;
            color: #16a34a;
        }

        /* Orders Card */

        .carnate-orders-card {
            overflow: hidden;
            border: 1px solid var(--carnate-border);
            border-radius: 16px;
            background: #fff;
            box-shadow: 0 4px 18px rgba(15, 23, 42, .035);
        }

        .carnate-orders-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 19px 20px;
            border-bottom: 1px solid var(--carnate-border);
        }

        .carnate-orders-card-header h3 {
            margin: 0;
            font-size: 16px;
            font-weight: 750;
        }

        .carnate-orders-card-header p {
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

        /* Tables */

        .carnate-table-wrapper {
            overflow-x: auto;
        }

        .carnate-orders-table {
            width: 100%;
            min-width: 1000px;
            border-collapse: collapse;
        }

        .carnate-orders-table thead th,
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

        .carnate-orders-table tbody td,
        .carnate-items-table tbody td {
            padding: 14px 15px;
            border-bottom: 1px solid #edf1f5;
            color: var(--carnate-text);
            font-size: 12px;
            vertical-align: middle;
        }

        .carnate-orders-table tbody tr:last-child td,
        .carnate-items-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .carnate-orders-table tbody tr:hover {
            background: #fafbfc;
        }

        .carnate-order-number {
            display: inline-flex;
            align-items: center;
            padding: 6px 8px;
            border-radius: 7px;
            background: #f1f5f9;
            color: #475569;
            font-size: 11px;
            font-weight: 750;
        }

        .carnate-invoice-number {
            color: #334155;
            font-size: 12px;
        }

        .carnate-date {
            color: #64748b;
            font-size: 11px;
            white-space: nowrap;
        }

        .carnate-item-count {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            color: #475569;
            font-size: 11px;
            font-weight: 650;
            white-space: nowrap;
        }

        .carnate-item-count i {
            color: #94a3b8;
            font-size: 15px;
        }

        .carnate-order-value {
            color: #334155;
            font-size: 12px;
            white-space: nowrap;
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

        .carnate-status.pending {
            background: #fffbeb;
            color: #b45309;
        }

        .carnate-status.success {
            background: #f0fdf4;
            color: #15803d;
        }

        .carnate-status.partial {
            background: #fff7ed;
            color: #c2410c;
        }

        .carnate-status.accepted {
            background: #f1f5f9;
            color: #475569;
        }

        .carnate-status.declined {
            background: #fef2f2;
            color: #dc2626;
        }

        .carnate-status.handover {
            background: #f5f3ff;
            color: #7c3aed;
        }

        .carnate-status.delayed {
            background: #fff7ed;
            color: #c2410c;
        }

        .carnate-status.neutral {
            background: #f1f5f9;
            color: #64748b;
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

        .carnate-detail-section {
            margin-bottom: 24px;
        }

        .carnate-detail-section:last-child {
            margin-bottom: 0;
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

        .carnate-detail-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 10px;
        }

        .carnate-detail-item {
            padding: 13px;
            border: 1px solid var(--carnate-border);
            border-radius: 10px;
            background: #f8fafc;
        }

        .carnate-detail-item > span {
            display: block;
            margin-bottom: 5px;
            color: #94a3b8;
            font-size: 9px;
            font-weight: 800;
            letter-spacing: .06em;
            text-transform: uppercase;
        }

        .carnate-detail-item strong {
            color: #334155;
            font-size: 12px;
            font-weight: 700;
        }

        .carnate-items-table {
            width: 100%;
            min-width: 850px;
            border-collapse: collapse;
        }

        .carnate-product-cell {
            display: flex;
            align-items: center;
            gap: 9px;
            min-width: 180px;
        }

        .carnate-product-cell strong {
            color: #334155;
            font-size: 12px;
        }

        .carnate-product-image,
        .carnate-product-placeholder {
            flex: 0 0 auto;
            width: 40px;
            height: 40px;
            border-radius: 8px;
        }

        .carnate-product-image {
            object-fit: cover;
            border: 1px solid var(--carnate-border);
        }

        .carnate-product-placeholder {
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f1f5f9;
            color: #94a3b8;
            font-size: 18px;
        }

        .carnate-brand {
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

        .carnate-price {
            color: #64748b;
            font-size: 11px;
            white-space: nowrap;
        }

        .carnate-total {
            color: #334155;
            font-size: 12px;
            white-space: nowrap;
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
            .carnate-orders-report-page {
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

            .carnate-orders-card-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .carnate-detail-grid {
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