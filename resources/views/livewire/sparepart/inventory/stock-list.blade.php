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
            max-width: 850px;
            margin-top: 35px;
            margin-bottom: 35px;
        }

        .carnate-stock-page .modal-content {
            max-height: calc(100vh - 70px);

            display: flex;
            flex-direction: column;

            border: 0 !important;
            border-radius: 16px !important;

            box-shadow:
                0 22px 60px rgba(15, 23, 42, .24) !important;

            overflow: hidden;
        }

        .carnate-stock-page .modal-header {
            flex-shrink: 0;

            padding: 17px 22px !important;

            background: #fff;

            border-bottom: 1px solid var(--stock-border) !important;
        }

        .carnate-stock-page .modal-title {
            margin: 0;

            color: var(--stock-text);

            font-size: 18px;
            font-weight: 700;
        }

        .carnate-stock-page .modal-header .btn-close {
            opacity: .65;
        }

        .carnate-stock-page .modal-body {
            flex: 1 1 auto;

            max-height: calc(100vh - 190px);

            padding: 22px !important;

            overflow-y: auto;
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

            padding: 14px 22px !important;

            background: #fff;

            border-top: 1px solid var(--stock-border) !important;
        }

        /* =========================================================
           MODAL SECTIONS
        ========================================================= */

        .carnate-stock-page .modal-section {
            margin-bottom: 25px;
        }

        .carnate-stock-page .modal-section:last-child {
            margin-bottom: 0;
        }

        .carnate-stock-page .section-heading {
            display: flex;
            align-items: center;
            gap: 9px;

            margin-bottom: 15px;

            color: var(--stock-text);

            font-size: 14px;
            font-weight: 700;
        }

        .carnate-stock-page .section-heading-icon {
            width: 30px;
            height: 30px;

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

            margin: 24px 0;

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
           VEHICLE BOX
        ========================================================= */

        .carnate-stock-page .vehicle-box {
            padding: 14px;

            background: #f8fafc;

            border: 1px solid var(--stock-border);
            border-radius: 10px;
        }

        .carnate-stock-page .vehicle-list {
            max-height: 300px;

            padding: 4px;

            overflow-y: auto;

            background: #fff;

            border: 1px solid var(--stock-border);
            border-radius: 9px;
        }

        .carnate-stock-page .vehicle-list::-webkit-scrollbar {
            width: 5px;
        }

        .carnate-stock-page .vehicle-list::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        .carnate-stock-page .vehicle-item {
            min-height: 60px;

            margin: 0 !important;
            padding: 9px 10px !important;

            border-bottom: 1px solid var(--stock-border-light) !important;

            border-radius: 6px;

            transition: background .15s ease;
        }

        .carnate-stock-page .vehicle-item:hover {
            background: #fffafa;
        }

        .carnate-stock-page .vehicle-item:last-child {
            border-bottom: 0 !important;
        }

        .carnate-stock-page .vehicle-item .form-check-input {
            margin-top: 4px;
        }

        .carnate-stock-page .vehicle-item .form-check-label {
            padding-left: 4px;

            color: var(--stock-text-2);

            font-size: 12px;

            cursor: pointer;
        }

        .carnate-stock-page .vehicle-item strong {
            color: var(--stock-text);
            font-size: 12px;
        }

        .carnate-stock-page .vehicle-item small {
            color: var(--stock-muted) !important;
            font-size: 11px;
        }

        .carnate-stock-page .vehicle-help {
            display: block;

            margin-top: 7px;

            color: #64748b;

            font-size: 11px;
        }

        /* =========================================================
           TEXTAREA
        ========================================================= */

        .carnate-stock-page textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }

        /* =========================================================
           MODAL BUTTONS
        ========================================================= */

        .carnate-stock-page .btn-secondary {
            min-height: 40px;

            color: #475569 !important;

            background: #f1f5f9 !important;

            border: 1px solid #e2e8f0 !important;
            border-radius: 9px !important;

            font-size: 13px;
            font-weight: 600;

            box-shadow: none !important;
        }

        .carnate-stock-page .btn-secondary:hover {
            color: #334155 !important;
            background: #e2e8f0 !important;
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
            opacity:1;
            background-color:rgba(15,23,42,.55);
            display:@if ($showEditModal) block @else none @endif;
        "
    >

        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <form wire:submit.prevent="updateFullDetails">


                    {{-- MODAL HEADER --}}

                    <div class="modal-header">

                        <div>

                            <h4 class="modal-title">
                                Edit Parts & Stock
                            </h4>

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

                                <div class="col-md-12">

                                    <label class="form-label">
                                        Description
                                    </label>

                                    <textarea
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

                                <div class="mb-2">

                                    <label class="form-label mb-0">
                                        Compatible Vehicles List
                                        <span class="required">*</span>
                                    </label>

                                </div>


                                <div class="vehicle-list">

                                    @if (!empty($part_modifications))

                                        <div class="row g-0">

                                            @foreach ($part_modifications as $modification)

                                                <div class="col-md-6">

                                                    <div class="form-check vehicle-item">

                                                        <input
                                                            class="form-check-input"
                                                            type="checkbox"
                                                            value="{{ $modification->brand_name }} {{ $modification->variant_name }} {{ $modification->year }}"
                                                            wire:model.lazy="part_suitable_for"
                                                            id="modification_{{ $modification->id }}"
                                                        >

                                                        <label
                                                            class="form-check-label"
                                                            for="modification_{{ $modification->id }}"
                                                        >

                                                            <strong>
                                                                {{ $modification->brand_name }}
                                                                {{ $modification->variant_name }}
                                                            </strong>

                                                            <br>

                                                            <small>
                                                                {{ $modification->year }}
                                                                {{ $modification->title }}
                                                            </small>

                                                        </label>

                                                    </div>

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


                                <span class="vehicle-help">
                                    <i class="bx bx-info-circle me-1"></i>
                                    All selected vehicles will be saved as compatible.
                                </span>

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

                                    <input
                                        type="number"
                                        class="form-control"
                                        wire:model.defer="stock_selling_price"
                                        step="1"
                                        min="1"
                                    >

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- MODAL FOOTER --}}

                    <div class="modal-footer">

                        <button
                            type="button"
                            class="btn btn-secondary"
                            wire:click="$set('showEditModal', false)"
                        >
                            Cancel
                        </button>

                        <button
                            type="submit"
                            class="btn btn-primary"
                        >
                            <i class="bx bx-check me-1"></i>
                            Update Both
                        </button>

                    </div>


                </form>

            </div>

        </div>

    </div>

</div>