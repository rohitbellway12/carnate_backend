<div class="carnate-tools-page">

    <style>
        /* =========================================================
           CARNATE TOOLS PAGE
           UI REDESIGN ONLY
        ========================================================= */

        .carnate-tools-page {
            --ct-border: #e2e8f0;
            --ct-border-light: #eef2f7;
            --ct-text: #111827;
            --ct-text-soft: #475569;
            --ct-muted: #64748b;
            --ct-placeholder: #94a3b8;
            --ct-bg: #f7f8fa;
            --ct-card: #ffffff;
            --ct-red: #e53935;
            --ct-red-dark: #c62828;
            --ct-red-soft: #fff5f5;
            --ct-green: #16a34a;
            --ct-warning: #d97706;

            color: var(--ct-text);
        }

        /* =========================================================
           GLOBAL CARD
        ========================================================= */

        .carnate-tools-page .card {
            border: 1px solid var(--ct-border) !important;
            border-radius: 14px !important;
            background: #ffffff !important;
            box-shadow: 0 2px 12px rgba(15, 23, 42, .035) !important;
            overflow: hidden;
        }

        /* =========================================================
           PAGE HEADER
        ========================================================= */

        .carnate-tools-page .tools-header {
            margin-bottom: 18px;
        }

        .carnate-tools-page .tools-header .card-body {
            min-height: 76px;
            padding: 18px 22px;
        }

        .carnate-tools-page .tools-title-wrap {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .carnate-tools-page .tools-title-icon {
            width: 42px;
            height: 42px;
            min-width: 42px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 10px;

            color: var(--ct-red);
            background: var(--ct-red-soft);

            font-size: 18px;
        }

        .carnate-tools-page .breadcrumb-title {
            margin: 0 !important;
            padding: 0 !important;

            color: var(--ct-text) !important;

            font-size: 21px !important;
            font-weight: 700 !important;

            line-height: 1.2;
            letter-spacing: -.025em;
        }

        .carnate-tools-page .tools-subtitle {
            margin-top: 4px;
            color: var(--ct-muted);
            font-size: 12px;
        }

        /* =========================================================
           BUTTONS
        ========================================================= */

        .carnate-tools-page .btn-primary {
            min-height: 40px;

            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;

            padding: 0 15px !important;

            color: #ffffff !important;
            background: var(--ct-red) !important;

            border: 1px solid var(--ct-red) !important;
            border-radius: 9px !important;

            font-size: 13px;
            font-weight: 600;

            box-shadow: none !important;

            transition: all .18s ease;
        }

        .carnate-tools-page .btn-primary:hover,
        .carnate-tools-page .btn-primary:focus {
            color: #ffffff !important;
            background: var(--ct-red-dark) !important;
            border-color: var(--ct-red-dark) !important;
            transform: translateY(-1px);
        }

        .carnate-tools-page .btn-primary i {
            font-size: 17px;
        }

        /* =========================================================
           FILTER CARD
        ========================================================= */

        .carnate-tools-page .tools-filter-card {
            margin-bottom: 18px;
        }

        .carnate-tools-page .tools-filter-card .card-body {
            padding: 17px 22px;
        }

        .carnate-tools-page .filter-label {
            display: block;
            margin-bottom: 7px;

            color: var(--ct-text-soft);

            font-size: 12px;
            font-weight: 600;
        }

        /* =========================================================
           FORM CONTROLS
        ========================================================= */

        .carnate-tools-page .form-control,
        .carnate-tools-page .form-select {

            min-height: 42px;

            padding: 8px 12px;

            color: var(--ct-text) !important;

            background-color: #ffffff !important;

            border: 1px solid var(--ct-border) !important;

            border-radius: 9px !important;

            font-size: 13px;

            box-shadow: none !important;

            transition:
                border-color .18s ease,
                box-shadow .18s ease;
        }

        .carnate-tools-page .form-control::placeholder {
            color: var(--ct-placeholder);
        }

        .carnate-tools-page .form-control:focus,
        .carnate-tools-page .form-select:focus {

            border-color: rgba(229, 57, 53, .45) !important;

            box-shadow:
                0 0 0 .2rem rgba(229, 57, 53, .08) !important;

            outline: none !important;
        }

        .carnate-tools-page textarea.form-control {
            min-height: 105px;
            resize: vertical;
        }

        .carnate-tools-page .bg-light {
            background: #f8fafc !important;
        }

        /* =========================================================
           CLEAR BUTTON
        ========================================================= */

        .carnate-tools-page .clear-filter-btn {

            min-height: 42px;

            padding: 0 16px !important;

            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;

            color: var(--ct-muted) !important;

            background: #ffffff !important;

            border: 1px solid var(--ct-border) !important;

            border-radius: 9px !important;

            font-size: 13px;
            font-weight: 600;

            box-shadow: none !important;

            transition: all .18s ease;
        }

        .carnate-tools-page .clear-filter-btn:hover {
            color: var(--ct-red) !important;
            border-color: #fecaca !important;
            background: var(--ct-red-soft) !important;
        }

        /* =========================================================
           TABLE
        ========================================================= */

        .carnate-tools-page .tools-table-card .card-body {
            padding: 0 !important;
        }

        .carnate-tools-page .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        .carnate-tools-page .tools-data-table {

            width: 100%;

            margin: 0 !important;

            color: var(--ct-text-soft);

            font-size: 13px;

            border-collapse: separate;
            border-spacing: 0;
        }

        .carnate-tools-page .tools-data-table thead th {

            padding: 13px 15px !important;

            color: #475569 !important;

            background: #f8fafc !important;

            border-top: 0 !important;

            border-bottom: 1px solid var(--ct-border) !important;

            font-size: 10.5px !important;

            font-weight: 700 !important;

            letter-spacing: .055em !important;

            text-transform: uppercase !important;

            white-space: nowrap;

            vertical-align: middle;
        }

        .carnate-tools-page .tools-data-table tbody td {

            padding: 13px 15px !important;

            color: #475569;

            background: #ffffff;

            border-top: 0 !important;

            border-bottom: 1px solid var(--ct-border-light) !important;

            vertical-align: middle;

            white-space: nowrap;
        }

        .carnate-tools-page .tools-data-table tbody tr {

            transition: background .15s ease;
        }

        .carnate-tools-page .tools-data-table tbody tr:hover td {

            background: #fffafa !important;
        }

        .carnate-tools-page .tools-data-table tbody tr:last-child td {

            border-bottom: 0 !important;
        }

        /* =========================================================
           SERIAL NUMBER
        ========================================================= */

        .carnate-tools-page .serial-number {

            color: #94a3b8;

            font-size: 12px;

            font-weight: 600;
        }

        /* =========================================================
           IMAGE
        ========================================================= */

        .carnate-tools-page .tool-image {

            width: 46px !important;
            height: 46px !important;

            display: block;

            object-fit: cover;

            border: 1px solid var(--ct-border);

            border-radius: 9px;

            background: #f8fafc;
        }

        /* =========================================================
           TOOL NAME
        ========================================================= */

        .carnate-tools-page .tool-name {

            color: var(--ct-text);

            font-size: 13px;

            font-weight: 600;
        }

        .carnate-tools-page .tool-unit {

            color: var(--ct-muted);

            font-size: 12px;
        }

        /* =========================================================
           PRICE
        ========================================================= */

        .carnate-tools-page .price-value {

            color: #334155;

            font-weight: 600;
        }

        .carnate-tools-page .commission-value {

            color: var(--ct-warning);

            font-weight: 600;
        }

        /* =========================================================
           STOCK
        ========================================================= */

        .carnate-tools-page .stock-badge {

            display: inline-flex;

            align-items: center;
            justify-content: center;

            min-width: 42px;

            padding: 5px 8px;

            color: #166534;

            background: #f0fdf4;

            border: 1px solid #dcfce7;

            border-radius: 7px;

            font-size: 11px;

            font-weight: 700;
        }

        /* =========================================================
           TAX
        ========================================================= */

        .carnate-tools-page .tax-badge {

            display: inline-flex;

            align-items: center;

            padding: 5px 8px;

            color: #475569;

            background: #f8fafc;

            border: 1px solid var(--ct-border);

            border-radius: 7px;

            font-size: 11px;

            font-weight: 600;
        }

        .carnate-tools-page .tax-empty {

            color: #94a3b8;

            font-size: 13px;
        }

        /* =========================================================
           HSN / RACK
        ========================================================= */

        .carnate-tools-page .code-value {

            color: #64748b;

            font-family: ui-monospace,
                SFMono-Regular,
                Menlo,
                Monaco,
                Consolas,
                monospace;

            font-size: 12px;
        }

        /* =========================================================
           ACTIONS
        ========================================================= */

        .carnate-tools-page .tools-actions {

            display: flex;

            align-items: center;

            gap: 4px;
        }

        .carnate-tools-page .tools-action-btn {

            width: 32px !important;
            height: 32px !important;

            min-width: 32px !important;

            padding: 0 !important;

            display: inline-flex !important;

            align-items: center !important;
            justify-content: center !important;

            color: #64748b !important;

            background: transparent !important;

            border: 0 !important;

            border-radius: 8px !important;

            font-size: 16px !important;

            cursor: pointer;

            transition: all .18s ease;
        }

        .carnate-tools-page .tools-action-btn:hover {

            color: var(--ct-red) !important;

            background: var(--ct-red-soft) !important;
        }

        .carnate-tools-page .tools-action-delete:hover {

            color: #dc2626 !important;

            background: #fef2f2 !important;
        }

        /* =========================================================
           EMPTY STATE
        ========================================================= */

        .carnate-tools-page .tools-empty {

            padding: 55px 20px;

            text-align: center;
        }

        .carnate-tools-page .tools-empty-icon {

            width: 58px;
            height: 58px;

            margin: 0 auto 14px;

            display: flex;
            align-items: center;
            justify-content: center;

            color: var(--ct-red);

            background: var(--ct-red-soft);

            border-radius: 14px;

            font-size: 23px;
        }

        .carnate-tools-page .tools-empty-title {

            margin-bottom: 5px;

            color: var(--ct-text);

            font-size: 15px;

            font-weight: 700;
        }

        .carnate-tools-page .tools-empty-text {

            margin: 0;

            color: var(--ct-muted);

            font-size: 13px;
        }

        /* =========================================================
           PAGINATION
        ========================================================= */

        .carnate-tools-page .pagination-wrapper {

            padding: 15px 20px !important;

            border-top: 1px solid var(--ct-border-light);

            background: #ffffff;
        }

        /* =========================================================
           MODAL
        ========================================================= */

        .carnate-tools-page .modal {

            background: rgba(15, 23, 42, .52) !important;
        }

        .carnate-tools-page .modal-dialog {

            margin-top: 35px;

            margin-bottom: 35px;
        }

        .carnate-tools-page .modal-content {

            overflow: hidden;

            border: 0 !important;

            border-radius: 15px !important;

            background: #ffffff;

            box-shadow:
                0 24px 70px rgba(15, 23, 42, .24) !important;
        }

        .carnate-tools-page .modal-header {

            min-height: 64px;

            padding: 15px 20px !important;

            background: #ffffff;

            border-bottom: 1px solid var(--ct-border) !important;
        }

        .carnate-tools-page .modal-title {

            margin: 0;

            color: var(--ct-text) !important;

            font-size: 18px !important;

            font-weight: 700 !important;
        }

        .carnate-tools-page .modal-header .btn-close {

            width: 32px;
            height: 32px;

            padding: 0;

            border-radius: 8px;

            background-size: 10px;

            opacity: .65;

            transition: all .18s ease;
        }

        .carnate-tools-page .modal-header .btn-close:hover {

            opacity: 1;

            background-color: var(--ct-red-soft);
        }

        .carnate-tools-page .modal-body {

            padding: 20px !important;

            max-height: calc(100vh - 190px);

            overflow-y: auto;

            scrollbar-width: thin;

            scrollbar-color: #cbd5e1 transparent;
        }

        .carnate-tools-page .modal-body::-webkit-scrollbar {

            width: 6px;
        }

        .carnate-tools-page .modal-body::-webkit-scrollbar-track {

            background: transparent;
        }

        .carnate-tools-page .modal-body::-webkit-scrollbar-thumb {

            background: #cbd5e1;

            border-radius: 10px;
        }

        .carnate-tools-page .modal-footer {

            padding: 13px 20px !important;

            background: #ffffff;

            border-top: 1px solid var(--ct-border) !important;
        }

        /* =========================================================
           FORM LABELS
        ========================================================= */

        .carnate-tools-page .form-label {

            display: block;

            margin-bottom: 7px;

            color: var(--ct-text-soft) !important;

            font-size: 12.5px !important;

            font-weight: 600 !important;
        }

        .carnate-tools-page .form-label sup {

            margin-left: 2px;
        }

        .carnate-tools-page .error {

            display: block;

            margin-top: 5px;

            font-size: 11px;
        }

        /* =========================================================
           INPUT GROUP
        ========================================================= */

        .carnate-tools-page .input-group .form-control {

            border-radius: 9px 0 0 9px !important;
        }

        .carnate-tools-page .input-group-text {

            color: #64748b;

            background: #f8fafc;

            border-color: var(--ct-border);

            font-size: 12px;
        }

        /* =========================================================
           IMAGE FIELD
        ========================================================= */

        .carnate-tools-page .image-upload-preview {

            width: 62px;

            height: 62px;

            margin-top: 7px;

            padding: 3px;

            border: 1px solid var(--ct-border);

            border-radius: 10px;

            background: #f8fafc;

            object-fit: cover;
        }

        /* =========================================================
           VEHICLE SECTION
        ========================================================= */

        .carnate-tools-page .vehicle-section {

            padding: 14px;

            background: #f8fafc;

            border: 1px solid var(--ct-border);

            border-radius: 10px;
        }

        .carnate-tools-page .vehicle-check {

            display: flex;

            align-items: center;

            gap: 8px;

            margin-top: 3px;

            color: #475569;

            font-size: 13px;

            font-weight: 500;
        }

        .carnate-tools-page .vehicle-check input {

            width: 16px;
            height: 16px;

            accent-color: var(--ct-red);
        }

        .carnate-tools-page .all-vehicle-badge {

            display: inline-flex;

            align-items: center;

            padding: 6px 10px;

            color: var(--ct-red);

            background: var(--ct-red-soft);

            border: 1px solid #fecaca;

            border-radius: 7px;

            font-size: 11px;

            font-weight: 700;
        }

        /* =========================================================
           COMMISSION NOTICE
        ========================================================= */

        .carnate-tools-page .commission-notice {

            display: flex;

            align-items: flex-start;

            gap: 9px;

            margin-top: 5px;

            padding: 11px 13px;

            color: #991b1b;

            background: #fff5f5;

            border: 1px solid #fee2e2;

            border-radius: 9px;

            font-size: 12px;

            line-height: 1.5;
        }

        .carnate-tools-page .commission-notice i {

            margin-top: 2px;

            color: var(--ct-red);
        }

        /* =========================================================
           SELECT2
        ========================================================= */

        .carnate-tools-page .select2-container {

            width: 100% !important;
        }

        .carnate-tools-page .select2-container--default
        .select2-selection--single {

            min-height: 42px;

            display: flex;

            align-items: center;

            border: 1px solid var(--ct-border) !important;

            border-radius: 9px !important;
        }

        .carnate-tools-page .select2-container--default
        .select2-selection--single
        .select2-selection__rendered {

            color: var(--ct-text);

            font-size: 13px;

            line-height: 40px;
        }

        .carnate-tools-page .select2-container--default
        .select2-selection--single
        .select2-selection__arrow {

            height: 40px;
        }

        .carnate-tools-page .select2-container--default
        .select2-selection--multiple {

            min-height: 42px;

            border: 1px solid var(--ct-border) !important;

            border-radius: 9px !important;

            padding: 3px 6px;
        }

        .carnate-tools-page .select2-container--default.select2-container--focus
        .select2-selection--single,
        .carnate-tools-page .select2-container--default.select2-container--focus
        .select2-selection--multiple {

            border-color: rgba(229, 57, 53, .45) !important;

            box-shadow:
                0 0 0 .2rem rgba(229, 57, 53, .08) !important;
        }

        /* =========================================================
           MOBILE
        ========================================================= */

        @media (max-width: 767px) {

            .carnate-tools-page .tools-header .card-body,
            .carnate-tools-page .tools-filter-card .card-body {

                padding: 15px;
            }

            .carnate-tools-page .tools-title-wrap {

                gap: 10px;
            }

            .carnate-tools-page .tools-title-icon {

                width: 38px;
                height: 38px;
                min-width: 38px;
            }

            .carnate-tools-page .breadcrumb-title {

                font-size: 18px !important;
            }

            .carnate-tools-page .tools-subtitle {

                display: none;
            }

            .carnate-tools-page .tools-header .card-body {

                align-items: flex-start !important;
            }

            .carnate-tools-page .tools-header .btn-primary {

                padding: 0 11px !important;
            }

            .carnate-tools-page .tools-header .btn-primary span {

                display: none;
            }

            .carnate-tools-page .tools-filter-card .col-3,
            .carnate-tools-page .tools-filter-card .col-9 {

                width: 100%;
            }

            .carnate-tools-page .clear-filter-btn {

                margin-top: 10px;

                width: 100%;
            }

            .carnate-tools-page .modal-dialog {

                margin: 10px;
            }

            .carnate-tools-page .modal-body {

                max-height: calc(100vh - 145px);

                padding: 16px !important;
            }

            .carnate-tools-page .modal-footer {

                padding: 12px 16px !important;
            }

        }

    </style>


    {{-- =========================================================
         SUCCESS MESSAGE
    ========================================================== --}}

    @if (session()->has('message'))

        <div class="alert alert-success mb-3">
            {{ session('message') }}
        </div>

    @endif


    @php
        $sparePart = App\Models\SparePartVendor::where('id', $sparepartId)->first();
    @endphp


    {{-- =========================================================
         CREATE / EDIT TOOLS MODAL
    ========================================================== --}}

    <div
        class="modal @if ($showModal) show @endif"
        tabindex="-1"
        style="
            opacity:1;
            background-color:rgba(15,23,42,.52);
            display:@if ($showModal) block @else none @endif;
        "
    >

        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">

                    {{-- Modal Header --}}

                    <div class="modal-header">

                        <div>

                            <h4 class="modal-title">

                                {{ $isEdit ? 'Edit Tools' : 'Create Tools' }}

                            </h4>

                        </div>

                        <button
                            type="button"
                            class="btn-close"
                            wire:click="$set('showModal', false)"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        ></button>

                    </div>


                    {{-- Modal Body --}}

                    <div class="modal-body">

                        @csrf


                        <div class="row g-3">


                            {{-- =================================================
                                 NAME
                            ================================================== --}}

                            <div class="col-md-6">

                                <label class="form-label">
                                    Name<sup class="text-danger">*</sup>
                                </label>

                                <div class="row g-2">

                                    <div class="col-10">

                                        <select
                                            class="form-select"
                                            wire:model="name"
                                            id="name"
                                        >

                                            <option value="">
                                                Select a Name or Add New One
                                            </option>

                                            @foreach ($sparePartLabels as $sparePartLabel)

                                                <option value="{{ $sparePartLabel->title }}">

                                                    {{ $sparePartLabel->title }}

                                                </option>

                                            @endforeach

                                        </select>

                                    </div>


                                    <div class="col-2">

                                        <button
                                            type="button"
                                            class="btn btn-primary w-100 h-100"
                                            wire:click="addToolsLabel"
                                        >
                                            +
                                        </button>

                                    </div>

                                </div>

                                @error('name')

                                    <span class="text-danger error">
                                        {{ $message }}
                                    </span>

                                @enderror

                            </div>


                            {{-- =================================================
                                 UNIT
                            ================================================== --}}

                            <div class="col-md-6">

                                <label class="form-label">
                                    Unit<sup class="text-danger">*</sup>
                                </label>

                                <select
                                    class="form-select"
                                    wire:model="unit"
                                    id="unit"
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

                                @error('unit')

                                    <span class="text-danger error">
                                        {{ $message }}
                                    </span>

                                @enderror

                            </div>


                            {{-- =================================================
                                 PURCHASE PRICE
                            ================================================== --}}

                            <div class="col-md-6">

                                <label class="form-label">
                                    Purchase Price<sup class="text-danger">*</sup>
                                </label>

                                <input
                                    type="number"
                                    wire:model.live="purchase_amount"
                                    class="form-control"
                                    placeholder="Enter Purchase Price"
                                >

                                @error('purchase_amount')

                                    <span class="text-danger error">
                                        {{ $message }}
                                    </span>

                                @enderror

                            </div>


                            {{-- =================================================
                                 SELLING PRICE
                            ================================================== --}}

                            <div class="col-md-6">

                                <label class="form-label">
                                    Selling Price<sup class="text-danger">*</sup>
                                </label>

                                <input
                                    type="number"
                                    wire:model.live="selling_amount"
                                    class="form-control"
                                    placeholder="Enter Selling Price"
                                >

                                @error('selling_amount')

                                    <span class="text-danger error">
                                        {{ $message }}
                                    </span>

                                @enderror

                            </div>


                            {{-- =================================================
                                 ONLINE PRICE
                            ================================================== --}}

                            <div class="col-md-6">

                                <label class="form-label">
                                    Online Price (Auto)
                                </label>

                                <input
                                    type="text"
                                    wire:model="online_price"
                                    class="form-control bg-light"
                                    readonly
                                >

                            </div>


                            {{-- =================================================
                                 OFFLINE PRICE
                            ================================================== --}}

                            <div class="col-md-6">

                                <label class="form-label">
                                    Offline Price (Auto)
                                </label>

                                <input
                                    type="text"
                                    wire:model="offline_price"
                                    class="form-control bg-light"
                                    readonly
                                >

                            </div>


                            {{-- =================================================
                                 TAX TYPE
                            ================================================== --}}

                            <div class="col-md-6">

                                <label class="form-label">
                                    Tax Type
                                </label>

                                <select
                                    id="tax_type"
                                    class="form-select"
                                    wire:model.live="tax_type"
                                >

                                    <option value="">
                                        Select Tax Type
                                    </option>

                                    <option value="include">
                                        Include All Taxes
                                    </option>

                                    <option value="exclude">
                                        Exclude All Taxes
                                    </option>

                                </select>

                                @error('tax_type')

                                    <span class="text-danger error">
                                        {{ $message }}
                                    </span>

                                @enderror

                            </div>


                            {{-- =================================================
                                 TAX PERCENTAGE
                            ================================================== --}}

                            @if ($tax_type == 'include' || $tax_type == 'exclude')

                                <div class="col-md-6">

                                    <label class="form-label">

                                        {{
                                            $tax_type == 'include'
                                                ? 'Include Tax Percentage'
                                                : 'Exclude Tax Percentage'
                                        }}

                                    </label>

                                    <div class="input-group">

                                        <input
                                            type="number"
                                            wire:model.live="tax_percentage"
                                            class="form-control"
                                            placeholder="Enter Percentage"
                                        >

                                        <span class="input-group-text">
                                            %
                                        </span>

                                    </div>

                                    @error('tax_percentage')

                                        <span class="text-danger error">
                                            {{ $message }}
                                        </span>

                                    @enderror

                                </div>

                            @endif


                            {{-- =================================================
                                 ONLINE DISCOUNT
                            ================================================== --}}

                            <div class="col-md-6">

                                <label class="form-label">
                                    Online Discount
                                </label>

                                <div class="input-group">

                                    <input
                                        type="number"
                                        wire:model.live="discount"
                                        class="form-control"
                                        placeholder="Enter Discount"
                                    >

                                    <select
                                        id="discount_type"
                                        class="form-select"
                                        wire:model.live="discount_type"
                                        style="max-width:90px;"
                                    >

                                        <option value="1">
                                            ₹
                                        </option>

                                        <option value="2">
                                            %
                                        </option>

                                    </select>

                                </div>

                                @error('discount')

                                    <span class="text-danger error">
                                        {{ $message }}
                                    </span>

                                @enderror

                                @error('discount_type')

                                    <span class="text-danger error">
                                        {{ $message }}
                                    </span>

                                @enderror

                            </div>


                            {{-- =================================================
                                 STOCK
                            ================================================== --}}

                            <div class="col-md-6">

                                <label class="form-label">
                                    Stock<sup class="text-danger">*</sup>
                                </label>

                                <input
                                    type="number"
                                    wire:model="stock"
                                    class="form-control"
                                    placeholder="Enter Stock"
                                >

                                @error('stock')

                                    <span class="text-danger error">
                                        {{ $message }}
                                    </span>

                                @enderror

                            </div>


                            {{-- =================================================
                                 HSN
                            ================================================== --}}

                            <div class="col-md-6">

                                <label class="form-label">
                                    HSN Code
                                </label>

                                <input
                                    type="text"
                                    wire:model="hsn_code"
                                    class="form-control"
                                    placeholder="Enter HSN Code"
                                >

                                @error('hsn_code')

                                    <span class="text-danger error">
                                        {{ $message }}
                                    </span>

                                @enderror

                            </div>


                            {{-- =================================================
                                 RACK
                            ================================================== --}}

                            <div class="col-md-6">

                                <label class="form-label">
                                    Rack No.
                                </label>

                                <input
                                    type="text"
                                    wire:model="rack_no"
                                    class="form-control"
                                    placeholder="Enter Rack No."
                                >

                                @error('rack_no')

                                    <span class="text-danger error">
                                        {{ $message }}
                                    </span>

                                @enderror

                            </div>


                            {{-- =================================================
                                 CATEGORY
                            ================================================== --}}

                            <div class="col-md-6">

                                <label class="form-label">
                                    Category<sup class="text-danger">*</sup>
                                </label>

                                <select
                                    class="form-select searchable-select"
                                    data-placeholder="Select Category"
                                    wire:model="category"
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


                            {{-- =================================================
                                 IMAGE
                            ================================================== --}}

                            <div class="col-12">

                                <label class="form-label">
                                    Image
                                </label>

                                <div class="row g-3 align-items-center">

                                    <div class="col-md-9">

                                        <input
                                            type="file"
                                            class="form-control"
                                            wire:model="image"
                                        >

                                    </div>


                                    <div class="col-md-3">

                                        @if (!empty($imageName))

                                            <img
                                                class="image-upload-preview"
                                                src="{{ asset($imageName) }}"
                                                alt="Tool image"
                                            >

                                        @elseif ($isEdit)

                                            <img
                                                class="image-upload-preview"
                                                src="{{ asset($imageImage) }}"
                                                alt="Tool image"
                                            >

                                        @endif

                                    </div>

                                </div>

                                @error('image')

                                    <span class="text-danger error">
                                        {{ $message }}
                                    </span>

                                @enderror

                            </div>


                            {{-- =================================================
                                 COMPATIBLE VEHICLES
                            ================================================== --}}

                            <div class="col-12">

                                <div class="vehicle-section">

                                    <label class="form-label mb-2">

                                        Compatible Vehicles
                                        <span class="text-danger">*</span>

                                    </label>


                                    <label class="vehicle-check">

                                        <input
                                            type="checkbox"
                                            wire:model.live="forAllVehicles"
                                            id="all_vehicles"
                                        >

                                        <span>
                                            For All Vehicles
                                        </span>

                                    </label>


                                    @if (!$forAllVehicles)

                                        <div class="mt-3">

                                            <select
                                                id="suitable_for"
                                                class="form-select"
                                                multiple
                                                wire:model="suitable_for"
                                            >

                                                @foreach ($modifications as $modification)

                                                    <option value="{{ $modification->id }}">

                                                        {{
                                                            $modification->brand_name .
                                                            ' ' .
                                                            $modification->variant_name .
                                                            ' ' .
                                                            $modification->year .
                                                            ' ' .
                                                            $modification->title
                                                        }}

                                                    </option>

                                                @endforeach

                                            </select>

                                            @error('suitable_for')

                                                <span class="text-danger error">
                                                    {{ $message }}
                                                </span>

                                            @enderror

                                        </div>

                                    @else

                                        <div class="mt-3">

                                            <div class="form-label mb-2">
                                                Selected Vehicle
                                            </div>

                                            <span class="all-vehicle-badge">
                                                All Vehicles
                                            </span>

                                        </div>

                                    @endif

                                </div>

                            </div>


                            {{-- =================================================
                                 DESCRIPTION
                            ================================================== --}}

                            <div class="col-12">

                                <label class="form-label">
                                    Description
                                </label>

                                <textarea
                                    wire:model="description"
                                    class="form-control"
                                    placeholder="Enter Description"
                                ></textarea>

                                @error('description')

                                    <span class="text-danger error">
                                        {{ $message }}
                                    </span>

                                @enderror

                            </div>


                            {{-- =================================================
                                 COMMISSION
                            ================================================== --}}

                            <div class="col-12">

                                <div class="commission-notice">

                                    <i class="bx bx-info-circle"></i>

                                    <div>

                                        A
                                        <strong>{{ $commission }}%</strong>
                                        commission will be deducted from product
                                        price at withdrawal for platform services.

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- Modal Footer --}}

                    <div class="modal-footer">

                        <button
                            type="button"
                            class="btn btn-light border"
                            wire:click="$set('showModal', false)"
                            data-bs-dismiss="modal"
                        >
                            Cancel
                        </button>


                        <button
                            type="submit"
                            class="btn btn-primary"
                        >

                            {{ $isEdit ? 'Update' : 'Create' }}

                            <i
                                class="spinner-border spinner-border-sm ms-1"
                                wire:loading
                            ></i>

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>


    {{-- =========================================================
         CREATE TOOLS LABEL MODAL
    ========================================================== --}}

    <div
        class="modal @if ($showToolsModel) show @endif"
        tabindex="-1"
        style="
            opacity:1;
            background-color:rgba(15,23,42,.52);
            display:@if ($showToolsModel) block @else none @endif;
        "
    >

        <div class="modal-dialog modal-md">

            <div class="modal-content">

                <form wire:submit.prevent="toolsLabelStore">

                    <div class="modal-header">

                        <h4 class="modal-title">
                            Create Tools
                        </h4>

                        <button
                            type="button"
                            class="btn-close"
                            wire:click="$set('showToolsModel', false)"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        ></button>

                    </div>


                    <div class="modal-body">

                        @csrf

                        <div class="row g-3">

                            <div class="col-md-12">

                                <label class="form-label">
                                    Tools Label
                                </label>

                                <input
                                    type="text"
                                    wire:model="tools_label"
                                    class="form-control"
                                    placeholder="Enter Tools Label"
                                >

                                @error('tools_label')

                                    <span class="text-danger error">
                                        {{ $message }}
                                    </span>

                                @enderror

                            </div>

                        </div>

                    </div>


                    <div class="modal-footer">

                        <button
                            type="button"
                            class="btn btn-light border"
                            wire:click="$set('showToolsModel', false)"
                            data-bs-dismiss="modal"
                        >
                            Cancel
                        </button>


                        <button
                            type="submit"
                            class="btn btn-primary"
                        >

                            {{ $isEdit ? 'Update' : 'Create' }}

                            <i
                                class="spinner-border spinner-border-sm ms-1"
                                wire:loading
                            ></i>

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>


    {{-- =========================================================
         PAGE HEADER
    ========================================================== --}}

    <div class="card tools-header">

        <div class="card-body d-flex justify-content-between align-items-center">

            <div class="tools-title-wrap">

                <div class="tools-title-icon">

                    <i class="fa-solid fa-screwdriver-wrench"></i>

                </div>

                <div>

                    <div class="breadcrumb-title">
                        Tools
                    </div>

                    <div class="tools-subtitle">
                        Manage tools, pricing, stock and inventory details
                    </div>

                </div>

            </div>


            @if (@$sparePart->hasPermissionTo('tools-add'))

                <a
                    href="javascript:;"
                    wire:click="create"
                    class="btn btn-primary"
                >

                    <i class="bx bx-plus"></i>

                    <span>
                        Add Tool
                    </span>

                </a>

            @endif

        </div>

    </div>


    {{-- =========================================================
         FILTERS
    ========================================================== --}}

    <div class="card tools-filter-card">

        <div class="card-body">

            <div class="row g-3 align-items-end">

                <div class="col-md-5">

                    <label class="filter-label">
                        Search Tools
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        placeholder="Search by tool name..."
                        wire:model.live="searchfilter"
                    >

                </div>


                <div class="col-md-7 d-flex justify-content-md-end">

                    <button
                        type="button"
                        class="clear-filter-btn"
                        wire:click="resetFilter"
                    >

                        <i class="bx bx-refresh"></i>

                        Clear Filter

                    </button>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         TOOLS TABLE
    ========================================================== --}}

    <div class="card tools-table-card">

        @if (!empty($tools) && $tools->count())

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table tools-data-table">

                        <thead>

                            <tr>

                                <th>
                                    S.No.
                                </th>

                                <th>
                                    Image
                                </th>

                                <th>
                                    Name
                                </th>

                                <th>
                                    Unit
                                </th>

                                <th>
                                    Online Price
                                </th>

                                <th>
                                    Offline Price
                                </th>

                                <th>
                                    Commission
                                </th>

                                <th>
                                    Tax
                                </th>

                                <th>
                                    Stock
                                </th>

                                <th>
                                    HSN Code
                                </th>

                                <th>
                                    Rack No.
                                </th>


                                @if (
                                    @$sparePart->hasPermissionTo('tools-edit') ||
                                    @$sparePart->hasPermissionTo('tools-delete')
                                )

                                    <th>
                                        Actions
                                    </th>

                                @endif

                            </tr>

                        </thead>


                        <tbody>

                            @foreach ($tools as $index => $tool)

                                <tr>

                                    {{-- S.No. --}}

                                    <td>

                                        <span class="serial-number">

                                            {{ $tools->total() - ($tools->firstItem() + $index) + 1 }}

                                        </span>

                                    </td>


                                    {{-- Image --}}

                                    <td>

                                        @if (!empty($tool->Image->file))

                                            <img
                                                src="{{ asset($tool->Image->file) }}"
                                                alt="tools image"
                                                class="tool-image"
                                            >

                                        @else

                                            <img
                                                src="{{ asset('img/tools.jpg') }}"
                                                alt="tools image"
                                                class="tool-image"
                                            >

                                        @endif

                                    </td>


                                    {{-- Name --}}

                                    <td>

                                        <span class="tool-name">
                                            {{ $tool->name }}
                                        </span>

                                    </td>


                                    {{-- Unit --}}

                                    <td>

                                        <span class="tool-unit">
                                            {{ $tool->unit?->title ?? '' }}
                                        </span>

                                    </td>


                                    {{-- Online Price --}}

                                    <td>

                                        <span class="price-value">
                                            {{ $tool->price }}
                                        </span>

                                    </td>


                                    {{-- Offline Price --}}

                                    <td>

                                        @php

                                            $offlinePrice = $tool->selling_amount;

                                            if (
                                                $tool->tax_type == 'exclude' &&
                                                $tool->tax_percentage
                                            ) {

                                                $offlinePrice +=
                                                    ($offlinePrice *
                                                    $tool->tax_percentage) /
                                                    100;

                                            }

                                        @endphp

                                        <span class="price-value">

                                            {{ number_format($offlinePrice, 2) }}

                                        </span>

                                    </td>


                                    {{-- Commission --}}

                                    <td>

                                        <span class="commission-value">

                                            {{ $tool->platform_charge ?? 0 }}%

                                        </span>

                                    </td>


                                    {{-- Tax --}}

                                    <td>

                                        @if ($tool->tax_percentage)

                                            <span class="tax-badge">

                                                {{
                                                    $tool->tax_type == 'include'
                                                        ? 'Include'
                                                        : 'Exclude'
                                                }}

                                                {{ $tool->tax_percentage }}%

                                            </span>

                                        @else

                                            <span class="tax-empty">
                                                —
                                            </span>

                                        @endif

                                    </td>


                                    {{-- Stock --}}

                                    <td>

                                        <span class="stock-badge">

                                            {{ $tool->stock }}

                                        </span>

                                    </td>


                                    {{-- HSN --}}

                                    <td>

                                        <span class="code-value">

                                            {{ $tool->hsn_code ?: '—' }}

                                        </span>

                                    </td>


                                    {{-- Rack --}}

                                    <td>

                                        <span class="code-value">

                                            {{ $tool->rack_no ?: '—' }}

                                        </span>

                                    </td>


                                    {{-- Actions --}}

                                    @if (
                                        @$sparePart->hasPermissionTo('tools-edit') ||
                                        @$sparePart->hasPermissionTo('tools-delete')
                                    )

                                        <td>

                                            <div class="tools-actions">

                                                @if (@$sparePart->hasPermissionTo('tools-edit'))

                                                    <a
                                                        wire:click="edit({{ $tool->id }})"
                                                        class="tools-action-btn"
                                                        title="Edit"
                                                    >

                                                        <i class="bx bx-edit"></i>

                                                    </a>

                                                @endif


                                                @if (@$sparePart->hasPermissionTo('tools-delete'))

                                                    <a
                                                        wire:click="confirmDelete({{ $tool->id }})"
                                                        class="tools-action-btn tools-action-delete"
                                                        title="Delete"
                                                    >

                                                        <i class="bx bx-trash"></i>

                                                    </a>

                                                @endif

                                            </div>

                                        </td>

                                    @endif

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>


                {{-- Pagination --}}

                <div class="pagination-wrapper">

                    {{ $tools->links() }}

                </div>

            </div>

        @else

            <div class="tools-empty">

                <div class="tools-empty-icon">

                    <i class="fa-solid fa-screwdriver-wrench"></i>

                </div>

                <div class="tools-empty-title">
                    No Tools Found
                </div>

                <p class="tools-empty-text">
                    There are currently no tools matching your search.
                </p>

            </div>

        @endif

    </div>

</div>


@section('footerscript')

<script>

document.addEventListener('livewire:init', () => {

    initializeToolsSelects();


    Livewire.hook('morphed', (message, component) => {

        setTimeout(function () {

            initializeToolsSelects();

        }, 50);

    });

});


function initializeToolsSelects() {

    /*
     * Name
     */

    const nameSelect = $('#name');

    if (nameSelect.length) {

        if (nameSelect.hasClass('select2-hidden-accessible')) {

            nameSelect.select2('destroy');

        }

        nameSelect.select2({

            placeholder: "Select Name",

            width: '100%'

        }).off('change.carnateTools')
          .on('change.carnateTools', function () {

              @this.set('name', $(this).val());

          });

    }


    /*
     * Unit
     */

    const unitSelect = $('#unit');

    if (unitSelect.length) {

        if (unitSelect.hasClass('select2-hidden-accessible')) {

            unitSelect.select2('destroy');

        }

        unitSelect.select2({

            placeholder: "Select Unit",

            width: '100%'

        }).off('change.carnateTools')
          .on('change.carnateTools', function () {

              @this.set('unit', $(this).val());

          });

    }


    /*
     * Compatible Vehicles
     */

    const vehicleSelect = $('#suitable_for');

    if (vehicleSelect.length) {

        if (vehicleSelect.hasClass('select2-hidden-accessible')) {

            vehicleSelect.select2('destroy');

        }

        vehicleSelect.select2({

            placeholder: "Select vehicle",

            width: '100%'

        }).off('change.carnateTools')
          .on('change.carnateTools', function () {

              @this.set(
                  'suitable_for',
                  $(this).val()
              );

          });

    }

}

</script>

@endsection