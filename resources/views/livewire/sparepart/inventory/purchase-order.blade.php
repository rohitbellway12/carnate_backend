<div class="carnate-purchase-orders-page">

    <style>
        /* =========================================================
           CARNATE PURCHASE ORDERS
        ========================================================= */

        .carnate-purchase-orders-page {
            --po-red: #e53935;
            --po-red-dark: #c62828;
            --po-red-soft: #fff5f5;

            --po-text: #111827;
            --po-text-2: #334155;
            --po-muted: #64748b;

            --po-border: #e2e8f0;
            --po-border-light: #eef2f7;

            --po-bg: #f8fafc;
        }

        .carnate-purchase-orders-page *,
        .carnate-purchase-orders-page *::before,
        .carnate-purchase-orders-page *::after {
            box-sizing: border-box;
        }

        /* =========================================================
           CARDS
        ========================================================= */

        .carnate-purchase-orders-page .card {
            border: 1px solid var(--po-border) !important;
            border-radius: 14px !important;
            background: #fff !important;
            box-shadow: 0 2px 12px rgba(15, 23, 42, .035) !important;
            overflow: hidden;
        }

        /* =========================================================
           PAGE HEADER
        ========================================================= */

        .carnate-purchase-orders-page .po-page-header {
            margin-top: 0 !important;
            margin-bottom: 18px;
        }

        .carnate-purchase-orders-page .po-page-header .card-body {
            min-height: 76px;
            padding: 17px 22px;
        }

        .carnate-purchase-orders-page .po-heading {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .carnate-purchase-orders-page .po-heading-icon {
            width: 42px;
            height: 42px;
            min-width: 42px;

            display: flex;
            align-items: center;
            justify-content: center;

            color: var(--po-red);
            background: var(--po-red-soft);

            border-radius: 10px;

            font-size: 20px;
        }

        .carnate-purchase-orders-page .po-title {
            margin: 0;

            color: var(--po-text);

            font-size: 20px;
            font-weight: 700;

            line-height: 1.2;
            letter-spacing: -.025em;
        }

        .carnate-purchase-orders-page .po-subtitle {
            margin-top: 4px;

            color: var(--po-muted);

            font-size: 12px;
        }

        /* =========================================================
           PRIMARY BUTTON
        ========================================================= */

        .carnate-purchase-orders-page .btn-primary {
            min-height: 40px;

            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;

            padding: 0 15px !important;

            color: #fff !important;
            background: var(--po-red) !important;

            border: 1px solid var(--po-red) !important;
            border-radius: 9px !important;

            font-size: 13px;
            font-weight: 600;

            box-shadow: none !important;

            transition: all .18s ease;
        }

        .carnate-purchase-orders-page .btn-primary:hover,
        .carnate-purchase-orders-page .btn-primary:focus {
            color: #fff !important;
            background: var(--po-red-dark) !important;
            border-color: var(--po-red-dark) !important;

            transform: translateY(-1px);
        }

        .carnate-purchase-orders-page .btn-primary i {
            font-size: 17px;
        }

        /* =========================================================
           SUMMARY CARDS
        ========================================================= */

        .carnate-purchase-orders-page .summary-row {
            margin-bottom: 18px;
        }

        .carnate-purchase-orders-page .summary-card {
            height: 100%;
        }

        .carnate-purchase-orders-page .summary-card .card-body {
            min-height: 112px;

            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 20px;
        }

        .carnate-purchase-orders-page .summary-label {
            margin: 0 0 7px;

            color: var(--po-muted);

            font-size: 12px;
            font-weight: 600;

            line-height: 1.3;
        }

        .carnate-purchase-orders-page .summary-value {
            margin: 0;

            color: var(--po-text);

            font-size: 24px;
            font-weight: 700;

            line-height: 1.1;
            letter-spacing: -.025em;
        }

        .carnate-purchase-orders-page .summary-icon {
            width: 46px;
            height: 46px;
            min-width: 46px;

            display: flex;
            align-items: center;
            justify-content: center;

            color: var(--po-red);
            background: var(--po-red-soft);

            border-radius: 11px;

            font-size: 21px;
        }

        .carnate-purchase-orders-page .summary-icon.neutral {
            color: #475569;
            background: #f1f5f9;
        }

        .carnate-purchase-orders-page .summary-icon.success {
            color: #16a34a;
            background: #f0fdf4;
        }

        .carnate-purchase-orders-page .summary-icon.warning {
            color: #d97706;
            background: #fffbeb;
        }

        /* =========================================================
           FILTER CARD
        ========================================================= */

        .carnate-purchase-orders-page .po-filter-card {
            margin-bottom: 18px;
        }

        .carnate-purchase-orders-page .po-filter-card .card-body {
            padding: 17px 20px;
        }

        .carnate-purchase-orders-page .filter-field {
            position: relative;
        }

        .carnate-purchase-orders-page .filter-icon {
            position: absolute;

            top: 50%;
            left: 13px;

            color: #94a3b8;

            font-size: 17px;

            transform: translateY(-50%);

            pointer-events: none;

            z-index: 2;
        }

        .carnate-purchase-orders-page .form-control {
            min-height: 42px;

            padding: 8px 12px;

            color: var(--po-text) !important;

            background: #fff !important;

            border: 1px solid var(--po-border) !important;
            border-radius: 9px !important;

            font-size: 13px;

            box-shadow: none !important;

            transition: all .18s ease;
        }

        .carnate-purchase-orders-page .search-input {
            padding-left: 40px !important;
        }

        .carnate-purchase-orders-page .form-control::placeholder {
            color: #94a3b8;
        }

        .carnate-purchase-orders-page .form-control:focus {
            border-color: rgba(229, 57, 53, .45) !important;

            box-shadow:
                0 0 0 .2rem rgba(229, 57, 53, .08) !important;

            outline: none !important;
        }

        .carnate-purchase-orders-page .filter-button {
            width: 100%;
            min-height: 42px;
        }

        /* =========================================================
           TABLE
        ========================================================= */

        .carnate-purchase-orders-page .po-table-card .card-body {
            padding: 0 !important;
        }

        .carnate-purchase-orders-page .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        .carnate-purchase-orders-page .po-table {
            width: 100%;

            margin: 0 !important;

            color: var(--po-text-2);

            font-size: 13px;

            border-collapse: separate;
            border-spacing: 0;
        }

        .carnate-purchase-orders-page .po-table thead th {
            padding: 13px 16px !important;

            color: #475569 !important;

            background: #f8fafc !important;

            border-top: 0 !important;
            border-bottom: 1px solid var(--po-border) !important;

            font-size: 10.5px !important;
            font-weight: 700 !important;

            letter-spacing: .055em !important;

            text-transform: uppercase !important;

            white-space: nowrap;

            vertical-align: middle;
        }

        .carnate-purchase-orders-page .po-table tbody td {
            padding: 14px 16px !important;

            color: var(--po-text-2);

            background: #fff;

            border-top: 0 !important;
            border-bottom: 1px solid var(--po-border-light) !important;

            vertical-align: middle;
        }

        .carnate-purchase-orders-page .po-table tbody tr {
            transition: background .15s ease;
        }

        .carnate-purchase-orders-page .po-table tbody tr:hover td {
            background: #fffafa !important;
        }

        .carnate-purchase-orders-page .po-table tbody tr:last-child td {
            border-bottom: 0 !important;
        }

        /* =========================================================
           PO NUMBER
        ========================================================= */

        .carnate-purchase-orders-page .po-number {
            color: var(--po-red) !important;

            font-weight: 700;
            text-decoration: none;
            white-space: nowrap;
        }

        .carnate-purchase-orders-page .po-number:hover {
            color: var(--po-red-dark) !important;
            text-decoration: underline;
        }

        /* =========================================================
           SUPPLIER
        ========================================================= */

        .carnate-purchase-orders-page .supplier-name {
            color: var(--po-text);

            font-weight: 600;
        }

        .carnate-purchase-orders-page .contact-value {
            color: #64748b;
            white-space: nowrap;
        }

        /* =========================================================
           AMOUNTS
        ========================================================= */

        .carnate-purchase-orders-page .amount-value {
            color: var(--po-text);

            font-weight: 600;

            white-space: nowrap;
        }

        .carnate-purchase-orders-page .paid-amount {
            color: #15803d;
        }

        .carnate-purchase-orders-page .pending-amount {
            color: #c2410c;
        }

        .carnate-purchase-orders-page .date-value {
            color: #64748b;
            white-space: nowrap;
        }

        /* =========================================================
           STATUS BADGES
        ========================================================= */

        .carnate-purchase-orders-page .po-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;

            min-width: 76px;

            padding: 5px 9px;

            border-radius: 7px;

            font-size: 11px;
            font-weight: 700;

            line-height: 1.2;

            white-space: nowrap;
        }

        .carnate-purchase-orders-page .po-status::before {
            content: "";

            width: 6px;
            height: 6px;

            border-radius: 50%;

            background: currentColor;
        }

        .carnate-purchase-orders-page .badge-status-open {
            color: #2563eb !important;
            background: #eff6ff !important;
        }

        .carnate-purchase-orders-page .badge-status-placed {
            color: #b45309 !important;
            background: #fffbeb !important;
        }

        .carnate-purchase-orders-page .badge-status-received {
            color: #15803d !important;
            background: #f0fdf4 !important;
        }

        .carnate-purchase-orders-page .badge-status-closed {
            color: #64748b !important;
            background: #f1f5f9 !important;
        }

        .carnate-purchase-orders-page .badge-status-cancelled {
            color: #dc2626 !important;
            background: #fef2f2 !important;
        }

        /* =========================================================
           EMPTY STATE
        ========================================================= */

        .carnate-purchase-orders-page .po-empty-state {
            padding: 52px 20px !important;
        }

        .carnate-purchase-orders-page .empty-icon {
            width: 54px;
            height: 54px;

            margin: 0 auto 13px;

            display: flex;
            align-items: center;
            justify-content: center;

            color: var(--po-red);
            background: var(--po-red-soft);

            border-radius: 12px;

            font-size: 24px;
        }

        .carnate-purchase-orders-page .empty-title {
            margin-bottom: 4px;

            color: var(--po-text);

            font-size: 14px;
            font-weight: 700;
        }

        .carnate-purchase-orders-page .empty-text {
            color: var(--po-muted);

            font-size: 12px;
        }

        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 991px) {

            .carnate-purchase-orders-page .summary-card .card-body {
                min-height: 100px;
            }

            .carnate-purchase-orders-page .summary-value {
                font-size: 21px;
            }

        }

        @media (max-width: 767px) {

            .carnate-purchase-orders-page .po-page-header .card-body {
                padding: 15px;
            }

            .carnate-purchase-orders-page .po-heading-icon {
                width: 38px;
                height: 38px;
                min-width: 38px;
            }

            .carnate-purchase-orders-page .po-title {
                font-size: 18px;
            }

            .carnate-purchase-orders-page .po-subtitle {
                display: none;
            }

            .carnate-purchase-orders-page .po-filter-card .card-body {
                padding: 15px;
            }

            .carnate-purchase-orders-page .filter-button {
                margin-top: 0;
            }

            .carnate-purchase-orders-page .summary-card .card-body {
                min-height: 94px;
                padding: 17px;
            }

            .carnate-purchase-orders-page .summary-value {
                font-size: 20px;
            }

            .carnate-purchase-orders-page .summary-icon {
                width: 40px;
                height: 40px;
                min-width: 40px;
            }

        }
    </style>


    {{-- =========================================================
         PAGE HEADER
    ========================================================== --}}

    <div class="card po-page-header">

        <div class="card-body d-flex justify-content-between align-items-center">

            <div class="po-heading">

                <div class="po-heading-icon">
                    <i class="bx bx-receipt"></i>
                </div>

                <div>

                    <h4 class="po-title">
                        Purchase Orders
                    </h4>

                    <div class="po-subtitle">
                        Manage purchase orders, payments and supplier balances
                    </div>

                </div>

            </div>


            <button
                wire:click="goToCreate"
                class="btn btn-primary"
            >
                <i class="bx bx-plus"></i>
                Create PO
            </button>

        </div>

    </div>


    {{-- =========================================================
         SUMMARY CARDS
    ========================================================== --}}

    <div class="row g-3 summary-row">

        {{-- Total Orders --}}

        <div class="col-md-4">

            <div class="card summary-card">

                <div class="card-body">

                    <div>

                        <p class="summary-label">
                            Total Purchase Orders
                        </p>

                        <h4 class="summary-value">
                            {{ $totalOrders }}
                        </h4>

                    </div>

                    <div class="summary-icon neutral">
                        <i class="bx bx-receipt"></i>
                    </div>

                </div>

            </div>

        </div>


        {{-- Total Paid --}}

        <div class="col-md-4">

            <div class="card summary-card">

                <div class="card-body">

                    <div>

                        <p class="summary-label">
                            Total Amount Paid
                        </p>

                        <h4 class="summary-value">
                            ₹ {{ number_format($totalPaid) }}
                        </h4>

                    </div>

                    <div class="summary-icon success">
                        <i class="bx bx-check-circle"></i>
                    </div>

                </div>

            </div>

        </div>


        {{-- Pending --}}

        <div class="col-md-4">

            <div class="card summary-card">

                <div class="card-body">

                    <div>

                        <p class="summary-label">
                            Pending Balance
                        </p>

                        <h4 class="summary-value">
                            ₹ {{ number_format($totalPending) }}
                        </h4>

                    </div>

                    <div class="summary-icon warning">
                        <i class="bx bx-time-five"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         FILTERS
    ========================================================== --}}

    <div class="card po-filter-card">

        <div class="card-body">

            <div class="row g-3 align-items-center">

                {{-- Search --}}

                <div class="col-md-5">

                    <div class="filter-field">

                        <i class="bx bx-search filter-icon"></i>

                        <input
                            type="text"
                            wire:model="search"
                            class="form-control search-input"
                            placeholder="Search by supplier or bill no."
                        >

                    </div>

                </div>


                {{-- Date Range --}}

                <div class="col-md-5">

                    <div class="filter-field">

                        <i class="bx bx-calendar filter-icon"></i>

                        <input
                            type="text"
                            wire:model="date_range"
                            id="dateRangePicker"
                            class="form-control search-input"
                            placeholder="Select date range"
                        >

                    </div>

                </div>


                {{-- Filter Button --}}

                <div class="col-md-2">

                    <button
                        wire:click="applyFilters"
                        class="btn btn-primary filter-button"
                    >
                        <i class="bx bx-filter-alt"></i>
                        Filter
                    </button>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         PURCHASE ORDER TABLE
    ========================================================== --}}

    <div class="card po-table-card">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table po-table">

                    <thead>

                        <tr>

                            <th>PO Date</th>
                            <th>PO No.</th>
                            <th>Supplier</th>
                            <th>Contact No.</th>
                            <th>Bill Date</th>
                            <th>Paid Amount</th>
                            <th>Pending Amount</th>
                            <th>Status</th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($po_list as $po)

                            @php
                                $statusClass = match($po->po_status) {
                                    'Open' => 'badge-status-open',
                                    'Placed' => 'badge-status-placed',
                                    'Received' => 'badge-status-received',
                                    'Closed' => 'badge-status-closed',
                                    'Cancelled' => 'badge-status-cancelled',
                                    default => 'badge-status-open'
                                };
                            @endphp


                            <tr>

                                {{-- PO Date --}}

                                <td>

                                    <span class="date-value">
                                        {{ $po->po_date }}
                                    </span>

                                </td>


                                {{-- PO Number --}}

                                <td>

                                    <a
                                        href="#"
                                        wire:click.prevent="editPO({{ $po->id }})"
                                        class="po-number"
                                    >
                                        {{ $po->po_no }}
                                    </a>

                                </td>


                                {{-- Supplier --}}

                                <td>

                                    <span class="supplier-name">
                                        {{ $po->supplier->business_first_name ?? '-' }}
                                    </span>

                                </td>


                                {{-- Contact --}}

                                <td>

                                    <span class="contact-value">
                                        {{ $po->supplier->mobile_no ?? '-' }}
                                    </span>

                                </td>


                                {{-- Bill Date --}}

                                <td>

                                    <span class="date-value">
                                        {{ $po->bill_date }}
                                    </span>

                                </td>


                                {{-- Paid --}}

                                <td>

                                    <span class="amount-value paid-amount">
                                        ₹ {{ $po->paid }}
                                    </span>

                                </td>


                                {{-- Pending --}}

                                <td>

                                    <span class="amount-value pending-amount">
                                        ₹ {{ $po->balance }}
                                    </span>

                                </td>


                                {{-- Status --}}

                                <td>

                                    <span class="po-status {{ $statusClass }}">
                                        {{ $po->po_status }}
                                    </span>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="8" class="text-center">

                                    <div class="po-empty-state">

                                        <div class="empty-icon">
                                            <i class="bx bx-receipt"></i>
                                        </div>

                                        <div class="empty-title">
                                            No Purchase Orders Found
                                        </div>

                                        <div class="empty-text">
                                            There are no purchase orders matching your current filters.
                                        </div>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>


    {{-- =========================================================
         DATE RANGE PICKER
    ========================================================== --}}

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"
    />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>


    <script>

        function attachDateRangePicker() {

            const dateInput = $('#dateRangePicker');

            if (!dateInput.length) {
                return;
            }

            /*
             * Prevent multiple daterangepicker instances
             * after Livewire DOM updates.
             */

            if (dateInput.data('daterangepicker')) {
                return;
            }


            dateInput.daterangepicker({

                autoUpdateInput: false,

                locale: {
                    cancelLabel: 'Clear',
                    format: 'DD-MM-YYYY'
                }

            });


            dateInput.on(
                'apply.daterangepicker',
                function (ev, picker) {

                    const value =
                        picker.startDate.format('DD-MM-YYYY')
                        + ' - ' +
                        picker.endDate.format('DD-MM-YYYY');


                    $(this).val(value);


                    if (
                        window.Livewire &&
                        window.Livewire.first
                    ) {

                        window.Livewire.first().set(
                            'date_range',
                            value
                        );

                    }

                }
            );


            dateInput.on(
                'cancel.daterangepicker',
                function () {

                    $(this).val('');


                    if (
                        window.Livewire &&
                        window.Livewire.first
                    ) {

                        window.Livewire.first().set(
                            'date_range',
                            ''
                        );

                    }

                }
            );

        }


        window.addEventListener(
            'DOMContentLoaded',
            function () {

                attachDateRangePicker();

            }
        );


        document.addEventListener(
            'livewire:load',
            function () {

                attachDateRangePicker();


                if (window.livewire) {

                    window.livewire.on(
                        'message.processed',
                        function () {

                            setTimeout(
                                attachDateRangePicker,
                                50
                            );

                        }
                    );

                }

            }
        );

    </script>

</div>