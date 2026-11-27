<div class="carnate-stock-page">

    <style>
        /* =========================================================
           CARNATE STOCK LIST
        ========================================================= */

        .carnate-stock-page {
            --stock-red: #e53935;
            --stock-red-dark: #c62828;
            --stock-red-soft: #fff5f5;

            --stock-text: #111827;
            --stock-text-2: #334155;
            --stock-muted: #64748b;

            --stock-border: #e2e8f0;
            --stock-border-light: #eef2f7;

            --stock-bg: #f8fafc;
        }

        .carnate-stock-page *,
        .carnate-stock-page *::before,
        .carnate-stock-page *::after {
            box-sizing: border-box;
        }

        /* =========================================================
           COMMON CARD
        ========================================================= */

        .carnate-stock-page .card {
            border: 1px solid var(--stock-border) !important;
            border-radius: 14px !important;
            background: #fff !important;
            box-shadow: 0 2px 12px rgba(15, 23, 42, .035) !important;
            overflow: hidden;
        }

        /* =========================================================
           PAGE HEADER
        ========================================================= */

        .carnate-stock-page .stock-header {
            margin-top: 0 !important;
        }

        .carnate-stock-page .stock-header .card-body {
            min-height: 76px;
            padding: 17px 22px;
        }

        .carnate-stock-page .stock-heading {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .carnate-stock-page .stock-heading-icon {
            width: 42px;
            height: 42px;
            min-width: 42px;

            display: flex;
            align-items: center;
            justify-content: center;

            color: var(--stock-red);
            background: var(--stock-red-soft);

            border-radius: 10px;

            font-size: 21px;
        }

        .carnate-stock-page .stock-title {
            margin: 0;

            color: var(--stock-text);

            font-size: 20px;
            font-weight: 700;

            line-height: 1.2;
            letter-spacing: -.025em;
        }

        .carnate-stock-page .stock-subtitle {
            margin-top: 4px;

            color: var(--stock-muted);

            font-size: 12px;
        }

        /* =========================================================
           FILTER CARD
        ========================================================= */

        .carnate-stock-page .stock-filter-card {
            margin-top: 18px !important;
        }

        .carnate-stock-page .stock-filter-card .card-body {
            padding: 17px 20px;
        }

        .carnate-stock-page .search-wrapper {
            position: relative;
        }

        .carnate-stock-page .search-icon {
            position: absolute;

            top: 50%;
            left: 13px;

            color: #94a3b8;

            font-size: 17px;

            transform: translateY(-50%);

            pointer-events: none;

            z-index: 2;
        }

        .carnate-stock-page .form-control,
        .carnate-stock-page .form-select {
            min-height: 42px;

            color: var(--stock-text) !important;

            background: #fff !important;

            border: 1px solid var(--stock-border) !important;
            border-radius: 9px !important;

            font-size: 13px;

            box-shadow: none !important;

            transition: all .18s ease;
        }

        .carnate-stock-page .search-input {
            padding-left: 40px !important;
        }

        .carnate-stock-page .form-control::placeholder {
            color: #94a3b8;
        }

        .carnate-stock-page .form-control:focus,
        .carnate-stock-page .form-select:focus {
            border-color: rgba(229, 57, 53, .45) !important;

            box-shadow:
                0 0 0 .2rem rgba(229, 57, 53, .08) !important;

            outline: none !important;
        }

        .carnate-stock-page .reset-button {
            min-height: 42px;

            padding: 0 17px;

            color: var(--stock-muted) !important;

            background: #fff !important;

            border: 1px solid var(--stock-border) !important;
            border-radius: 9px !important;

            font-size: 13px;
            font-weight: 600;

            transition: all .18s ease;
        }

        .carnate-stock-page .reset-button:hover {
            color: var(--stock-red) !important;

            background: var(--stock-red-soft) !important;

            border-color: #fecaca !important;
        }

        /* =========================================================
           SUCCESS MESSAGE
        ========================================================= */

        .carnate-stock-page .alert-success {
            margin-top: 18px;
            margin-bottom: 0;

            color: #166534;

            background: #f0fdf4;

            border: 1px solid #bbf7d0;
            border-radius: 10px;

            font-size: 13px;
        }

        /* =========================================================
           TABLE CARD
        ========================================================= */

        .carnate-stock-page .stock-table-card {
            margin-top: 18px !important;
        }

        .carnate-stock-page .stock-table-card .card-body {
            padding: 0 !important;
        }

        .carnate-stock-page .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        .carnate-stock-page .stock-table {
            width: 100%;

            margin: 0 !important;

            color: var(--stock-text-2);

            font-size: 13px;

            border-collapse: separate;
            border-spacing: 0;
        }

        .carnate-stock-page .stock-table thead th {
            padding: 13px 16px !important;

            color: #475569 !important;

            background: #f8fafc !important;

            border-top: 0 !important;
            border-bottom: 1px solid var(--stock-border) !important;

            font-size: 10.5px !important;
            font-weight: 700 !important;

            letter-spacing: .055em !important;

            text-transform: uppercase !important;

            white-space: nowrap;

            vertical-align: middle;
        }

        .carnate-stock-page .stock-table tbody td {
            padding: 14px 16px !important;

            color: var(--stock-text-2);

            background: #fff;

            border-top: 0 !important;
            border-bottom: 1px solid var(--stock-border-light) !important;

            vertical-align: middle;
        }

        .carnate-stock-page .stock-table tbody tr {
            transition: background .15s ease;
        }

        .carnate-stock-page .stock-table tbody tr:hover td {
            background: #fffafa !important;
        }

        .carnate-stock-page .stock-table tbody tr:last-child td {
            border-bottom: 0 !important;
        }

        /* =========================================================
           STOCK DATA
        ========================================================= */

        .carnate-stock-page .stock-part-name {
            color: var(--stock-text);

            font-weight: 600;
        }

        .carnate-stock-page .stock-part-number {
            color: var(--stock-red);

            font-weight: 600;

            white-space: nowrap;
        }

        .carnate-stock-page .company-name {
            color: var(--stock-text-2);
            font-weight: 500;
        }

        .carnate-stock-page .quantity-value {
            color: var(--stock-text);
            font-weight: 700;
        }

        .carnate-stock-page .unit-value,
        .carnate-stock-page .rack-value {
            color: var(--stock-muted);
        }

        .carnate-stock-page .price-value {
            color: var(--stock-text);

            font-weight: 700;

            white-space: nowrap;
        }

        .carnate-stock-page .tax-badge {
            display: inline-flex;
            align-items: center;

            padding: 5px 8px;

            color: #475569;
            background: #f1f5f9;

            border-radius: 6px;

            font-size: 11px;
            font-weight: 600;

            white-space: nowrap;
        }

        /* =========================================================
           ACTIONS
        ========================================================= */

        .carnate-stock-page .stock-action {
            width: 32px;
            height: 32px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            margin-right: 4px;

            padding: 0;

            color: var(--stock-muted);

            background: transparent;

            border: 0;
            border-radius: 8px;

            font-size: 18px;

            cursor: pointer;

            transition: all .18s ease;
        }

        .carnate-stock-page .stock-action:hover {
            color: var(--stock-red);
            background: var(--stock-red-soft);
        }

        .carnate-stock-page .stock-action.delete:hover {
            color: #dc2626;
            background: #fef2f2;
        }

        /* =========================================================
           MODAL
        ========================================================= */

        .carnate-stock-page .modal {
            z-index: 99999 !important;
        }

        .carnate-stock-page .modal-backdrop {
            z-index: 99998;
        }

        .carnate-stock-page .modal-dialog {
            max-width: 900px;
            margin: 1.5rem auto;
        }

        .carnate-stock-page .modal-content {
            max-height: calc(100vh - 50px);
            display: flex;
            flex-direction: column;
            border: 0 !important;
            border-radius: 16px !important;
            box-shadow: 0 25px 60px rgba(15, 23, 42, .25) !important;
            overflow: hidden;
            background: #fff;
        }

        .carnate-stock-page .modal-content > form {
            display: flex;
            flex-direction: column;
            height: 100%;
            max-height: calc(100vh - 50px);
            min-height: 0;
            overflow: hidden;
            margin: 0;
        }

        .carnate-stock-page .modal-header {
            flex-shrink: 0;
            padding: 16px 24px !important;
            background: #fff;
            border-bottom: 1px solid var(--stock-border-light) !important;
        }

        .carnate-stock-page .modal-header-icon {
            width: 40px;
            height: 40px;
            min-width: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--stock-red);
            background: var(--stock-red-soft);
            border-radius: 10px;
            font-size: 20px;
        }

        .carnate-stock-page .modal-title {
            margin: 0;
            color: var(--stock-text);
            font-size: 18px;
            font-weight: 700;
        }

        .carnate-stock-page .modal-header .btn-close {
            opacity: .65;
            transition: opacity .15s ease;
        }

        .carnate-stock-page .modal-header .btn-close:hover {
            opacity: 1;
        }

        .carnate-stock-page .modal-body {
            flex: 1 1 auto;
            min-height: 0;
            max-height: none !important;
            padding: 20px 24px !important;
            overflow-y: auto !important;
            overflow-x: hidden;
        }

        .carnate-stock-page .modal-body::-webkit-scrollbar {
            width: 6px;
        }

        .carnate-stock-page .modal-body::-webkit-scrollbar-track {
            background: #f8fafc;
        }

        .carnate-stock-page .modal-body::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        .carnate-stock-page .modal-body::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        .carnate-stock-page .modal-footer {
            flex-shrink: 0;
            padding: 14px 24px !important;
            background: #f8fafc;
            border-top: 1px solid var(--stock-border-light) !important;
            z-index: 5;
        }

        /* =========================================================
           MODAL SECTIONS
        ========================================================= */

        .carnate-stock-page .modal-section {
            margin-bottom: 18px;
        }

        .carnate-stock-page .modal-section:last-child {
            margin-bottom: 0;
        }

        .carnate-stock-page .section-heading {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 12px;
            color: var(--stock-text);
            font-size: 14px;
            font-weight: 700;
        }

        .carnate-stock-page .section-heading-icon {
            width: 28px;
            height: 28px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--stock-red);
            background: var(--stock-red-soft);
            border-radius: 7px;
            font-size: 15px;
        }

        .carnate-stock-page .section-divider {
            height: 1px;
            margin: 18px 0;
            background: var(--stock-border-light);
            border: 0;
        }

        .carnate-stock-page .form-label {
            margin-bottom: 6px;

            color: #475569;

            font-size: 12px;
            font-weight: 600;
        }

        .carnate-stock-page .required {
            color: var(--stock-red);
        }

        .carnate-stock-page .readonly-field {
            color: #64748b !important;
            background: #f8fafc !important;
        }

        /* =========================================================
           VEHICLE BOX & CARDS
        ========================================================= */

        .carnate-stock-page .vehicle-box {
            padding: 14px;
            background: #f8fafc;
            border: 1px solid var(--stock-border);
            border-radius: 10px;
        }

        .carnate-stock-page .vehicle-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 10px;
            flex-wrap: wrap;
        }

        .carnate-stock-page .vehicle-actions {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .carnate-stock-page .vehicle-btn-action {
            font-size: 11px;
            padding: 3px 9px;
            border-radius: 6px;
            border: 1px solid #cbd5e1;
            background: #ffffff;
            color: #475569;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            transition: all .15s ease;
            cursor: pointer;
        }

        .carnate-stock-page .vehicle-btn-action:hover {
            background: #f1f5f9;
            color: #0f172a;
            border-color: #94a3b8;
        }

        .carnate-stock-page .vehicle-filter-input {
            width: 190px;
            font-size: 11px;
            padding: 4px 10px;
            border-radius: 6px;
            border: 1px solid #cbd5e1;
            background: #fff;
            color: #1e293b;
        }

        .carnate-stock-page .vehicle-filter-input:focus {
            outline: none;
            border-color: var(--stock-primary);
            box-shadow: 0 0 0 2px rgba(234, 84, 85, 0.15);
        }

        .carnate-stock-page .vehicle-list {
            max-height: 230px;
            padding: 8px;
            overflow-y: auto;
            background: #ffffff;
            border: 1px solid var(--stock-border);
            border-radius: 8px;
        }

        .carnate-stock-page .vehicle-list::-webkit-scrollbar {
            width: 6px;
        }

        .carnate-stock-page .vehicle-list::-webkit-scrollbar-track {
            background: #f8fafc;
            border-radius: 10px;
        }

        .carnate-stock-page .vehicle-list::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        .carnate-stock-page .vehicle-list::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        .carnate-stock-page .vehicle-card-tile {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 8px 12px;
            background: #ffffff;
            border: 1.5px solid #e2e8f0;
            border-radius: 8px;
            cursor: pointer;
            user-select: none;
            transition: all .15s ease;
            margin: 0;
            height: 100%;
            position: relative;
        }

        .carnate-stock-page .vehicle-card-tile:hover {
            border-color: #cbd5e1;
            background: #f8fafc;
            box-shadow: 0 2px 5px rgba(0,0,0,0.03);
        }

        .carnate-stock-page .vehicle-card-tile:has(input:checked),
        .carnate-stock-page .vehicle-card-tile.active {
            background: #fff8f8 !important;
            border-color: #ea5455 !important;
            box-shadow: 0 2px 6px rgba(234, 84, 85, 0.12) !important;
        }

        .carnate-stock-page .vehicle-card-tile .vehicle-custom-checkbox {
            width: 17px;
            height: 17px;
            min-width: 17px;
            margin-top: 2px;
            accent-color: #ea5455;
            cursor: pointer;
            border: 1.5px solid #cbd5e1;
            border-radius: 4px;
        }

        .carnate-stock-page .vehicle-card-tile .vehicle-custom-checkbox:checked {
            background-color: #ea5455;
            border-color: #ea5455;
        }

        .carnate-stock-page .vehicle-tile-content {
            flex: 1;
            min-width: 0;
        }

        .carnate-stock-page .vehicle-brand-title {
            color: #1e293b;
            font-size: 12px;
            font-weight: 600;
            line-height: 1.35;
            word-break: break-word;
        }

        .carnate-stock-page .vehicle-meta {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 6px;
            margin-top: 2px;
            color: #64748b;
            font-size: 11px;
        }

        .carnate-stock-page .vehicle-year-pill {
            background: #f1f5f9;
            color: #475569;
            padding: 1px 5px;
            border-radius: 4px;
            font-weight: 600;
            font-size: 10px;
        }

        .carnate-stock-page .vehicle-help {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 8px;
            color: #64748b;
            font-size: 11px;
        }

        /* =========================================================
           TEXTAREA
        ========================================================= */

        .carnate-stock-page textarea.form-control {
            min-height: 48px;
            resize: vertical;
        }

        /* =========================================================
           MODAL BUTTONS
        ========================================================= */

        .carnate-stock-page .btn-secondary {
            min-height: 40px;

            color: #475569 !important;

            background: #fff !important;

            border: 1px solid #cbd5e1 !important;
            border-radius: 9px !important;

            font-size: 13px;
            font-weight: 600;

            box-shadow: none !important;
            transition: all .18s ease;
        }

        .carnate-stock-page .btn-secondary:hover {
            color: #1e293b !important;
            background: #f1f5f9 !important;
            border-color: #94a3b8 !important;
        }

        .carnate-stock-page .btn-primary {
            min-height: 40px;

            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;

            padding: 0 22px !important;

            color: #fff !important;
            background: var(--stock-red) !important;

            border: 1px solid var(--stock-red) !important;
            border-radius: 9px !important;

            font-size: 13px;
            font-weight: 600;

            box-shadow: 0 3px 10px rgba(229, 57, 53, 0.25) !important;
            transition: all .18s ease;
        }

        .carnate-stock-page .btn-primary:hover {
            color: #fff !important;
            background: var(--stock-red-dark) !important;
            border-color: var(--stock-red-dark) !important;
            transform: translateY(-1px);
        }

        .carnate-stock-page .modal .form-control,
        .carnate-stock-page .modal .form-select {
            min-height: 42px;
            border-radius: 9px;
            border: 1px solid var(--stock-border);
            font-size: 13.5px;
            color: var(--stock-text-2);
            transition: border-color .15s ease, box-shadow .15s ease;
        }

        .carnate-stock-page .modal .form-control:focus,
        .carnate-stock-page .modal .form-select:focus {
            border-color: var(--stock-red);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, 0.12);
        }
        }

        /* =========================================================
           MOBILE
        ========================================================= */

        @media (max-width: 767px) {

            .carnate-stock-page .stock-header .card-body {
                padding: 15px;
            }

            .carnate-stock-page .stock-title {
                font-size: 18px;
            }

            .carnate-stock-page .stock-subtitle {
                display: none;
            }

            .carnate-stock-page .stock-filter-card .card-body {
                padding: 15px;
            }

            .carnate-stock-page .reset-button {
                width: 100%;
                margin-top: 10px;
            }

            .carnate-stock-page .modal-dialog {
                margin: 10px;
            }

            .carnate-stock-page .modal-content {
                max-height: calc(100vh - 20px);
            }

            .carnate-stock-page .modal-body {
                max-height: calc(100vh - 145px);
                padding: 17px !important;
            }

            .carnate-stock-page .modal-header,
            .carnate-stock-page .modal-footer {
                padding: 14px 17px !important;
            }

            .carnate-stock-page .vehicle-item {
                min-height: auto;
            }
        }
    </style>


    {{-- =========================================================
         PAGE HEADER
    ========================================================== --}}

    <div class="card stock-header">

        <div class="card-body">

            <div class="stock-heading">

                <div class="stock-heading-icon">
                    <i class="bx bx-package"></i>
                </div>

                <div>

                    <h4 class="stock-title">
                        Stock List
                    </h4>

                    <div class="stock-subtitle">
                        Manage spare parts inventory and stock details
                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         FILTERS
    ========================================================== --}}

    <div class="card stock-filter-card">

        <div class="card-body">

            <div class="row g-3 align-items-center">

                <div class="col-md-5">

                    <div class="search-wrapper">

                        <i class="bx bx-search search-icon"></i>

                        <input
                            type="text"
                            class="form-control search-input"
                            placeholder="Search by Part Name or Part No."
                            wire:model.live="searchTerm"
                        >

                    </div>

                </div>

                <div class="col-md-auto">

                    <button
                        type="button"
                        class="btn reset-button"
                        wire:click="resetFilters"
                    >
                        <i class="bx bx-reset me-1"></i>
                        Reset
                    </button>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         SUCCESS MESSAGE
    ========================================================== --}}

    @if (session()->has('success'))

        <div class="alert alert-success">

            <i class="bx bx-check-circle me-1"></i>

            {{ session('success') }}

        </div>

    @endif


    {{-- =========================================================
         STOCK TABLE
    ========================================================== --}}

    <div class="card stock-table-card">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table stock-table">

                    <thead>

                        <tr>

                            <th>#</th>
                            <th>Part Name</th>
                            <th>Part No.</th>
                            <th>Company Name</th>
                            {{-- <th>Category</th> --}}
                            <th>Quantity</th>
                            <th>Unit</th>
                            <th>Rack No.</th>
                            <th>Selling Price</th>
                            <th>Tax %</th>
                            <th>Action</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($stocks as $index => $stock)

                            <tr>

                                <td>
                                    {{ $index + 1 }}
                                </td>

                                <td>
                                    <span class="stock-part-name">
                                        {{ $stock->partname }}
                                    </span>
                                </td>

                                <td>
                                    <span class="stock-part-number">
                                        {{ $stock->part_no }}
                                    </span>
                                </td>

                                <td>
                                    <span class="company-name">
                                        {{ $stock->company_name }}
                                    </span>
                                </td>

                                {{-- <td>{{ $stock->category }}</td> --}}

                                <td>
                                    <span class="quantity-value">
                                        {{ $stock->quantity }}
                                    </span>
                                </td>

                                <td>
                                    <span class="unit-value">
                                        {{ $stock->unit->title ?? '' }}
                                    </span>
                                </td>

                                <td>
                                    <span class="rack-value">
                                        {{ $stock->rack_no }}
                                    </span>
                                </td>

                                <td>
                                    <span class="price-value">
                                        ₹{{ number_format($stock->total_payable, 2) }}
                                    </span>
                                </td>

                                <td>
                                    <span class="tax-badge">
                                        {{ $stock->tax_percentage ?? 0 }}%
                                    </span>
                                </td>

                                <td>

                                    <button
                                        type="button"
                                        class="stock-action"
                                        wire:click="editFullDetails({{ $stock->id }})"
                                        aria-label="Edit stock"
                                    >
                                        <i class="bx bxs-edit"></i>
                                    </button>

                                    <button
                                        type="button"
                                        class="stock-action delete"
                                        wire:click="confirmDelete({{ $stock->id }})"
                                        aria-label="Delete stock"
                                    >
                                        <i class="bx bxs-trash"></i>
                                    </button>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>


    {{-- =========================================================
         EDIT STOCK MODAL
    ========================================================== --}}

    <div
        class="modal @if ($showEditModal) show @endif"
        tabindex="-1"
        style="
            opacity: 1;
            background-color: rgba(15, 23, 42, .55);
            backdrop-filter: blur(4px);
            display: @if ($showEditModal) block @else none @endif;
        "
    >

        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">

            <div class="modal-content">

                <form wire:submit.prevent="updateFullDetails" style="display: flex; flex-direction: column; height: 100%; max-height: inherit; min-height: 0; overflow: hidden; margin: 0;">


                    {{-- MODAL HEADER --}}

                    <div class="modal-header d-flex align-items-center justify-content-between">

                        <div class="d-flex align-items-center gap-3">

                            <div class="modal-header-icon">
                                <i class="bx bx-edit-alt"></i>
                            </div>

                            <div>
                                <h5 class="modal-title mb-0">
                                    Edit Parts & Stock
                                </h5>
                                <small class="text-muted" style="font-size: 12px;">Update spare part specifications, compatibility and inventory stock</small>
                            </div>

                        </div>

                        <button
                            type="button"
                            class="btn-close"
                            wire:click="$set('showEditModal', false)"
                            aria-label="Close"
                        ></button>

                    </div>


                    {{-- MODAL BODY --}}

                    <div class="modal-body">


                        {{-- =================================================
                             PART DETAILS
                        ================================================== --}}

                        <div class="modal-section">

                            <div class="section-heading">

                                <span class="section-heading-icon">
                                    <i class="bx bx-package"></i>
                                </span>

                                Part Details

                            </div>


                            <div class="row g-3">


                                {{-- Part Name --}}

                                <div class="col-md-4">

                                    <label class="form-label">
                                        Part Name
                                    </label>

                                    <input
                                        type="text"
                                        class="form-control readonly-field"
                                        wire:model.defer="name"
                                        readonly
                                    >

                                </div>


                                {{-- Part Number --}}

                                <div class="col-md-4">

                                    <label class="form-label">
                                        Part Number
                                    </label>

                                    <input
                                        type="text"
                                        class="form-control readonly-field"
                                        wire:model.defer="part_number"
                                        readonly
                                    >

                                </div>


                                {{-- Brand --}}

                                <div class="col-md-4">

                                    <label class="form-label">
                                        Brand
                                    </label>

                                    <input
                                        type="text"
                                        class="form-control"
                                        wire:model.defer="brand"
                                    >

                                </div>


                                {{-- Unit --}}

                                <div class="col-md-4">

                                    <label class="form-label">
                                        Unit
                                        <span class="required">*</span>
                                    </label>

                                    <select
                                        class="form-select"
                                        wire:model="unit_id"
                                    >

                                        <option value="">
                                            Select Unit
                                        </option>

                                        @foreach ($units as $unit)

                                            <option value="{{ $unit->id }}">
                                                {{ $unit->title }}
                                            </option>

                                        @endforeach

                                    </select>

                                </div>


                                {{-- Category --}}

                                <div class="col-md-4">

                                    <label class="form-label">
                                        Category
                                        <span class="required">*</span>
                                    </label>

                                    <select
                                        class="form-select"
                                        wire:model="category"
                                        id="category"
                                    >

                                        <option value="">
                                            Select Category
                                        </option>

                                        @foreach ($categories as $category)

                                            <option value="{{ $category['categoryId'] }}">
                                                {{ $category['categoryName'] }}
                                            </option>

                                        @endforeach

                                    </select>


                                    @error('category')

                                        <span class="text-danger error">
                                            {{ $message }}
                                        </span>

                                    @enderror

                                </div>


                                {{-- Description --}}

                                <div class="col-md-4">

                                    <label class="form-label">
                                        Description
                                    </label>

                                    <textarea
                                        rows="1"
                                        class="form-control"
                                        wire:model.defer="description"
                                        placeholder="Enter description"
                                    ></textarea>

                                </div>

                            </div>

                        </div>


                        <hr class="section-divider">


                        {{-- =================================================
                             COMPATIBLE VEHICLES
                        ================================================== --}}

                        <div class="modal-section">

                            <div class="section-heading">

                                <span class="section-heading-icon">
                                    <i class="bx bx-car"></i>
                                </span>

                                Compatible Vehicles

                            </div>


                            <div class="vehicle-box">

                                <div class="vehicle-toolbar">

                                    <div class="d-flex align-items-center gap-2">
                                        <label class="form-label mb-0 fw-semibold text-dark" style="font-size: 12.5px;">
                                            Compatible Vehicles List
                                            <span class="required">*</span>
                                        </label>
                                        @if (!empty($part_suitable_for) && count($part_suitable_for) > 0)
                                            <span class="badge bg-danger-subtle text-danger" style="font-size: 11px; border-radius: 20px; padding: 2px 8px; font-weight: 600;">
                                                {{ count($part_suitable_for) }} Selected
                                            </span>
                                        @endif
                                    </div>

                                    <div class="vehicle-actions">
                                        <button 
                                            type="button" 
                                            class="vehicle-btn-action" 
                                            wire:click="selectAllVehicles"
                                            title="Select all vehicles"
                                        >
                                            <i class="bx bx-check-double text-danger"></i> Select All
                                        </button>

                                        <button 
                                            type="button" 
                                            class="vehicle-btn-action" 
                                            wire:click="clearAllVehicles"
                                            title="Clear selected vehicles"
                                        >
                                            <i class="bx bx-x text-muted"></i> Clear
                                        </button>

                                        <input 
                                            type="text" 
                                            class="vehicle-filter-input" 
                                            placeholder="🔍 Filter vehicles..." 
                                            oninput="let f=this.value.toLowerCase(); document.querySelectorAll('.carnate-stock-page .vehicle-card-wrapper').forEach(el=>{ el.style.display = el.innerText.toLowerCase().includes(f)?'':'none'; });"
                                        >
                                    </div>

                                </div>


                                <div class="vehicle-list">

                                    @if (!empty($part_modifications))

                                        <div class="row g-2">

                                            @foreach ($part_modifications as $modification)

                                                @php
                                                    $vehicleVal = trim($modification->brand_name . ' ' . $modification->variant_name . ' ' . $modification->year);
                                                    $isChecked = !empty($part_suitable_for) && in_array($vehicleVal, $part_suitable_for);
                                                @endphp

                                                <div class="col-md-6 vehicle-card-wrapper">

                                                    <label class="vehicle-card-tile {{ $isChecked ? 'active' : '' }}" for="modification_{{ $modification->id }}">

                                                        <input
                                                            class="form-check-input vehicle-custom-checkbox"
                                                            type="checkbox"
                                                            value="{{ $vehicleVal }}"
                                                            wire:model.lazy="part_suitable_for"
                                                            id="modification_{{ $modification->id }}"
                                                        >

                                                        <div class="vehicle-tile-content">

                                                            <div class="vehicle-brand-title">
                                                                {{ $modification->brand_name }} {{ $modification->variant_name }}
                                                            </div>

                                                            <div class="vehicle-meta">
                                                                <span class="vehicle-year-pill">{{ $modification->year }}</span>
                                                                @if (!empty($modification->title))
                                                                    <span>{{ $modification->title }}</span>
                                                                @endif
                                                            </div>

                                                        </div>

                                                    </label>

                                                </div>

                                            @endforeach

                                        </div>

                                    @else

                                        <div class="text-center text-muted py-4">

                                            <i class="bx bx-car fs-3 d-block mb-2"></i>

                                            <small>
                                                No compatible vehicles found
                                            </small>

                                        </div>

                                    @endif

                                </div>


                                <div class="vehicle-help">
                                    <span>
                                        <i class="bx bx-info-circle me-1"></i>
                                        Click any card to select or deselect compatible vehicles.
                                    </span>
                                    <span class="text-muted">
                                        Total: {{ !empty($part_modifications) ? count($part_modifications) : 0 }} models
                                    </span>
                                </div>

                            </div>

                        </div>


                        <hr class="section-divider">


                        {{-- =================================================
                             STOCK DETAILS
                        ================================================== --}}

                        <div class="modal-section">

                            <div class="section-heading">

                                <span class="section-heading-icon">
                                    <i class="bx bx-layer"></i>
                                </span>

                                Stock Details

                            </div>


                            <div class="row g-3">


                                {{-- Quantity --}}

                                <div class="col-md-4">

                                    <label class="form-label">
                                        Quantity
                                    </label>

                                    <input
                                        type="number"
                                        class="form-control"
                                        wire:model.live="stock_quantity"
                                    >

                                </div>


                                {{-- Rack --}}

                                <div class="col-md-4">

                                    <label class="form-label">
                                        Rack No.
                                    </label>

                                    <input
                                        type="text"
                                        class="form-control"
                                        wire:model.defer="stock_rack_no"
                                        placeholder="Enter rack number"
                                    >

                                </div>


                                {{-- Selling Price --}}

                                <div class="col-md-4">

                                    <label class="form-label">
                                        Selling Price
                                    </label>

                                    <div class="input-group">
                                        <span class="input-group-text" style="background: #f8fafc; border-color: var(--stock-border); color: #64748b;">₹</span>
                                        <input
                                            type="number"
                                            class="form-control"
                                            wire:model.defer="stock_selling_price"
                                            step="any"
                                            min="0"
                                            placeholder="0.00"
                                        >
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- MODAL FOOTER --}}

                    <div class="modal-footer d-flex align-items-center justify-content-end gap-2">

                        <button
                            type="button"
                            class="btn btn-secondary px-4"
                            wire:click="$set('showEditModal', false)"
                        >
                            Cancel
                        </button>

                        <button
                            type="submit"
                            class="btn btn-primary px-4"
                        >
                            <i class="bx bx-check me-1 fs-5"></i>
                            Update Both
                            <span class="spinner-border spinner-border-sm ms-2" wire:loading wire:target="updateFullDetails"></span>
                        </button>

                    </div>


                </form>

            </div>

        </div>

    </div>

</div>