<div class="carnate-expenses-page">

    <style>
        .carnate-expenses-page {
            --expense-red: #e53935;
            --expense-red-dark: #c62828;
            --expense-red-soft: #fff5f5;

            --expense-text: #111827;
            --expense-text-2: #334155;
            --expense-muted: #64748b;

            --expense-border: #e2e8f0;
            --expense-border-light: #eef2f7;
        }

        .carnate-expenses-page .card {
            border: 1px solid var(--expense-border) !important;
            border-radius: 14px !important;
            background: #fff !important;
            box-shadow: 0 2px 12px rgba(15, 23, 42, .035) !important;
            overflow: hidden;
        }

        /* ================= HEADER ================= */

        .carnate-expenses-page .expenses-header .card-body {
            min-height: 76px;
            padding: 17px 22px;
        }

        .carnate-expenses-page .expenses-heading {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .carnate-expenses-page .expenses-heading-icon {
            width: 42px;
            height: 42px;
            min-width: 42px;

            display: flex;
            align-items: center;
            justify-content: center;

            color: var(--expense-red);
            background: var(--expense-red-soft);

            border-radius: 10px;
            font-size: 20px;
        }

        .carnate-expenses-page .expenses-title {
            margin: 0;

            color: var(--expense-text);
            font-size: 20px;
            font-weight: 700;
            letter-spacing: -.025em;
        }

        .carnate-expenses-page .expenses-subtitle {
            margin-top: 4px;

            color: var(--expense-muted);
            font-size: 12px;
        }

        /* ================= BUTTONS ================= */

        .carnate-expenses-page .btn-primary {
            min-height: 40px;

            color: #fff !important;
            background: var(--expense-red) !important;

            border-color: var(--expense-red) !important;
            border-radius: 9px !important;

            font-size: 13px;
            font-weight: 600;

            box-shadow: none !important;
        }

        .carnate-expenses-page .btn-primary:hover,
        .carnate-expenses-page .btn-primary:focus {
            color: #fff !important;
            background: var(--expense-red-dark) !important;
            border-color: var(--expense-red-dark) !important;
        }

        .carnate-expenses-page .btn-secondary {
            min-height: 40px;

            color: #475569 !important;
            background: #f1f5f9 !important;

            border: 1px solid var(--expense-border) !important;
            border-radius: 9px !important;

            font-size: 13px;
            font-weight: 600;

            box-shadow: none !important;
        }

        .carnate-expenses-page .btn-secondary:hover {
            background: #e2e8f0 !important;
        }

        /* ================= FILTER ================= */

        .carnate-expenses-page .expenses-filter-card {
            margin-top: 18px !important;
        }

        .carnate-expenses-page .expenses-filter-card .card-body {
            padding: 17px 20px;
        }

        .carnate-expenses-page .search-wrapper {
            position: relative;
        }

        .carnate-expenses-page .search-icon {
            position: absolute;
            left: 13px;
            top: 50%;

            color: #94a3b8;
            font-size: 17px;

            transform: translateY(-50%);
            pointer-events: none;

            z-index: 2;
        }

        .carnate-expenses-page .form-control,
        .carnate-expenses-page .form-select {
            min-height: 42px;

            color: var(--expense-text) !important;
            background: #fff !important;

            border: 1px solid var(--expense-border) !important;
            border-radius: 9px !important;

            font-size: 13px;

            box-shadow: none !important;
        }

        .carnate-expenses-page .search-input {
            padding-left: 40px !important;
        }

        .carnate-expenses-page .form-control::placeholder {
            color: #94a3b8;
        }

        .carnate-expenses-page .form-control:focus,
        .carnate-expenses-page .form-select:focus {
            border-color: rgba(229, 57, 53, .45) !important;
            box-shadow: 0 0 0 .2rem rgba(229, 57, 53, .08) !important;
            outline: none !important;
        }

        .carnate-expenses-page .clear-button {
            min-height: 42px;
            padding: 0 17px;

            color: var(--expense-muted) !important;
            background: #fff !important;

            border: 1px solid var(--expense-border) !important;
            border-radius: 9px !important;

            font-size: 13px;
            font-weight: 600;
        }

        .carnate-expenses-page .clear-button:hover {
            color: var(--expense-red) !important;
            background: var(--expense-red-soft) !important;
            border-color: #fecaca !important;
        }

        /* ================= ALERT ================= */

        .carnate-expenses-page .alert-success {
            margin-top: 18px;
            margin-bottom: 0;

            color: #166534;
            background: #f0fdf4;

            border: 1px solid #bbf7d0;
            border-radius: 10px;

            font-size: 13px;
        }

        .carnate-expenses-page .alert-info {
            margin: 0;
            padding: 18px 20px;

            color: #475569;
            background: #f8fafc;

            border: 0;
            border-radius: 0;

            font-size: 13px;
        }

        /* ================= TABLE ================= */

        .carnate-expenses-page .expenses-table-card {
            margin-top: 18px !important;
        }

        .carnate-expenses-page .expenses-table-card .card-body {
            padding: 0 !important;
        }

        .carnate-expenses-page .expenses-table {
            width: 100%;
            margin: 0 !important;

            color: var(--expense-text-2);
            font-size: 13px;

            border-collapse: separate;
            border-spacing: 0;
        }

        .carnate-expenses-page .expenses-table thead th {
            padding: 13px 16px !important;

            color: #475569 !important;
            background: #f8fafc !important;

            border-top: 0 !important;
            border-bottom: 1px solid var(--expense-border) !important;

            font-size: 10.5px !important;
            font-weight: 700 !important;

            letter-spacing: .055em !important;
            text-transform: uppercase !important;

            white-space: nowrap;
            vertical-align: middle;
        }

        .carnate-expenses-page .expenses-table tbody td {
            padding: 14px 16px !important;

            color: var(--expense-text-2);

            background: #fff;

            border-top: 0 !important;
            border-bottom: 1px solid var(--expense-border-light) !important;

            vertical-align: middle;
        }

        .carnate-expenses-page .expenses-table tbody tr {
            transition: background .15s ease;
        }

        .carnate-expenses-page .expenses-table tbody tr:hover td {
            background: #fffafa !important;
        }

        .carnate-expenses-page .expenses-table tbody tr:last-child td {
            border-bottom: 0 !important;
        }

        .carnate-expenses-page .expense-clickable {
            cursor: pointer;
        }

        .carnate-expenses-page .expense-clickable:hover {
            color: var(--expense-red) !important;
        }

        .carnate-expenses-page .supplier-name {
            color: var(--expense-text);
            font-weight: 600;
        }

        .carnate-expenses-page .bill-number {
            color: var(--expense-red);
            font-weight: 600;
            white-space: nowrap;
        }

        .carnate-expenses-page .amount {
            color: var(--expense-text);
            font-weight: 600;
            white-space: nowrap;
        }

        .carnate-expenses-page .balance {
            color: #b45309;
            font-weight: 600;
            white-space: nowrap;
        }

        /* ================= STATUS ================= */

        .carnate-expenses-page .expense-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;

            padding: 5px 9px;

            border-radius: 7px;

            font-size: 11px;
            font-weight: 700;

            white-space: nowrap;
        }

        .carnate-expenses-page .expense-status::before {
            content: "";
            width: 6px;
            height: 6px;
            border-radius: 50%;
        }

        .carnate-expenses-page .status-paid {
            color: #166534;
            background: #f0fdf4;
        }

        .carnate-expenses-page .status-paid::before {
            background: #22c55e;
        }

        .carnate-expenses-page .status-unpaid {
            color: #b91c1c;
            background: #fef2f2;
        }

        .carnate-expenses-page .status-unpaid::before {
            background: #ef4444;
        }

        .carnate-expenses-page .status-partial {
            color: #a16207;
            background: #fefce8;
        }

        .carnate-expenses-page .status-partial::before {
            background: #eab308;
        }

        /* ================= ACTIONS ================= */

        .carnate-expenses-page .expense-action {
            width: 32px;
            height: 32px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            margin-right: 4px;
            padding: 0;

            color: var(--expense-muted);
            background: transparent;

            border: 0;
            border-radius: 8px;

            font-size: 18px;
            cursor: pointer;

            transition: all .18s ease;
        }

        .carnate-expenses-page .expense-action:hover {
            color: var(--expense-red);
            background: var(--expense-red-soft);
        }

        .carnate-expenses-page .expense-action.delete:hover {
            color: #dc2626;
            background: #fef2f2;
        }

        /* ================= PAGINATION ================= */

        .carnate-expenses-page .pagination-wrapper {
            padding: 15px 20px;
        }

        /* ================= MODAL ================= */

        .carnate-expenses-page .modal {
            z-index: 99999 !important;
        }

        .carnate-expenses-page .modal-dialog {
            max-width: 820px;
            margin-top: 35px;
            margin-bottom: 35px;
        }

        .carnate-expenses-page .modal-content {
            max-height: calc(100vh - 70px);

            display: flex;
            flex-direction: column;

            border: 0 !important;
            border-radius: 16px !important;

            box-shadow: 0 22px 60px rgba(15, 23, 42, .24) !important;

            overflow: hidden;
        }

        .carnate-expenses-page .modal-header {
            flex-shrink: 0;

            padding: 17px 22px !important;

            background: #fff;
            border-bottom: 1px solid var(--expense-border) !important;
        }

        .carnate-expenses-page .modal-title {
            margin: 0;

            color: var(--expense-text);

            font-size: 18px;
            font-weight: 700;
        }

        .carnate-expenses-page .modal-body {
            flex: 1 1 auto;

            max-height: calc(100vh - 185px);

            padding: 22px !important;

            overflow-y: auto;
            overflow-x: hidden;
        }

        .carnate-expenses-page .modal-body::-webkit-scrollbar {
            width: 6px;
        }

        .carnate-expenses-page .modal-body::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        .carnate-expenses-page .modal-footer {
            flex-shrink: 0;

            padding: 14px 22px !important;

            background: #fff;

            border-top: 1px solid var(--expense-border) !important;
        }

        .carnate-expenses-page .form-label {
            margin-bottom: 6px;

            color: #475569;

            font-size: 12px;
            font-weight: 600;
        }

        .carnate-expenses-page .required {
            color: var(--expense-red);
        }

        /* ================= MODAL SECTIONS ================= */

        .carnate-expenses-page .form-section {
            margin-bottom: 22px;
        }

        .carnate-expenses-page .form-section:last-child {
            margin-bottom: 0;
        }

        .carnate-expenses-page .section-heading {
            display: flex;
            align-items: center;
            gap: 9px;

            margin-bottom: 15px;

            color: var(--expense-text);

            font-size: 14px;
            font-weight: 700;
        }

        .carnate-expenses-page .section-icon {
            width: 30px;
            height: 30px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            color: var(--expense-red);
            background: var(--expense-red-soft);

            border-radius: 7px;

            font-size: 15px;
        }

        .carnate-expenses-page .section-divider {
            height: 1px;
            margin: 22px 0;

            background: var(--expense-border-light);

            border: 0;
        }

        /* ================= ADD BUTTON INSIDE SELECT ================= */

        .carnate-expenses-page .field-with-action {
            display: flex;
            align-items: flex-end;
            gap: 8px;
        }

        .carnate-expenses-page .field-with-action .field-main {
            flex: 1;
            min-width: 0;
        }

        .carnate-expenses-page .field-add-button {
            width: 42px;
            height: 42px;
            min-width: 42px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            color: var(--expense-red) !important;
            background: var(--expense-red-soft) !important;

            border: 1px solid #fecaca !important;
            border-radius: 9px !important;

            font-size: 18px;

            box-shadow: none !important;
        }

        .carnate-expenses-page .field-add-button:hover {
            color: #fff !important;
            background: var(--expense-red) !important;
        }

        /* ================= BALANCE ================= */

        .carnate-expenses-page .balance-field {
            color: #92400e !important;
            background: #fffbeb !important;
            border-color: #fde68a !important;
            font-weight: 600;
        }

        /* ================= SUPPLIER MODAL ================= */

        .carnate-expenses-page .small-modal-dialog {
            max-width: 480px;
        }

        .carnate-expenses-page .small-modal-body {
            padding: 20px 22px !important;
        }

        /* ================= RESPONSIVE ================= */

        @media (max-width: 767px) {

            .carnate-expenses-page .expenses-header .card-body {
                padding: 15px;
            }

            .carnate-expenses-page .expenses-title {
                font-size: 18px;
            }

            .carnate-expenses-page .expenses-subtitle {
                display: none;
            }

            .carnate-expenses-page .expenses-filter-card .card-body {
                padding: 15px;
            }

            .carnate-expenses-page .clear-button {
                width: 100%;
            }

            .carnate-expenses-page .modal-dialog {
                margin: 10px;
            }

            .carnate-expenses-page .modal-content {
                max-height: calc(100vh - 20px);
            }

            .carnate-expenses-page .modal-body {
                max-height: calc(100vh - 145px);
                padding: 17px !important;
            }

            .carnate-expenses-page .modal-header,
            .carnate-expenses-page .modal-footer {
                padding: 14px 17px !important;
            }

            .carnate-expenses-page .field-with-action {
                align-items: flex-end;
            }
        }
    </style>


    {{-- =========================================================
         SUCCESS MESSAGE
    ========================================================== --}}

    @if (session()->has('message'))

        <div class="alert alert-success">
            <i class="bx bx-check-circle me-1"></i>
            {{ session('message') }}
        </div>

    @endif


    


    {{-- =========================================================
         CREATE / EDIT EXPENSE MODAL
    ========================================================== --}}

    <div
        class="modal @if ($showModal) show @endif"
        tabindex="-1"
        style="
            opacity:1;
            background-color:rgba(15,23,42,.55);
            display:@if ($showModal) block @else none @endif;
        "
    >

        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">

                    {{-- HEADER --}}

                    <div class="modal-header">

                        <h4 class="modal-title">
                            {{ $isEdit ? 'Edit Expenses' : 'Create Expenses' }}
                        </h4>

                        <button
                            type="button"
                            class="btn-close"
                            wire:click="$set('showModal', false)"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        ></button>

                    </div>


                    {{-- BODY --}}

                    <div class="modal-body">

                        @csrf


                        {{-- EXPENSE INFORMATION --}}

                        <div class="form-section">

                            <div class="section-heading">

                                <span class="section-icon">
                                    <i class="bx bx-receipt"></i>
                                </span>

                                Expense Information

                            </div>


                            <div class="row g-3">


                                {{-- CATEGORY --}}

                                <div class="col-md-6">

                                    <div class="field-with-action">

                                        <div class="field-main">

                                            <label class="form-label">
                                                Category
                                                <span class="required">*</span>
                                            </label>

                                            <select
                                                class="form-select"
                                                wire:model="category_id"
                                                required
                                            >

                                                <option value="" selected disabled>
                                                    -- Select Category --
                                                </option>

                                                @foreach ($categories as $category)

                                                    <option value="{{ $category->id }}">
                                                        {{ @$category->title }}
                                                    </option>

                                                @endforeach

                                            </select>

                                        </div>

                                        <button
                                            type="button"
                                            class="field-add-button"
                                            wire:click="addCategory"
                                            title="Add category"
                                        >
                                            <i class="bx bx-plus"></i>
                                        </button>

                                    </div>

                                    @error('category_id')
                                        <span class="text-danger error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>


                                {{-- SUPPLIER --}}

                                <div class="col-md-6">

                                    <label class="form-label">
                                        Name
                                    </label>

                                    <div class="field-with-action">

                                        <div class="field-main">

                                            <select
                                                class="form-select searchable-select"
                                                id="sparepart_expense_supplier_id"
                                                wire:model="supplier_id"
                                            >

                                                <option value="" selected disabled>
                                                    -- Select Name --
                                                </option>

                                                @foreach ($suppliers as $supplier)

                                                    <option value="{{ $supplier->id }}" {{ (string)$supplier_id === (string)$supplier->id ? 'selected' : '' }}>
                                                        {{ $supplier->business_first_name }} {{ $supplier->owner_first_name ?? '' }}
                                                    </option>

                                                @endforeach

                                            </select>

                                        </div>

                                        <button
                                            type="button"
                                            class="field-add-button"
                                            wire:click="openSupplierModal"
                                            title="Add supplier"
                                        >
                                            <i class="bx bx-plus"></i>
                                        </button>

                                    </div>

                                    @error('supplier_id')
                                        <span class="text-danger error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>


                                {{-- BILL NUMBER --}}

                                <div class="col-md-6">

                                    <label class="form-label">
                                        Bill Number
                                        <span class="required">*</span>
                                    </label>

                                    <input
                                        type="text"
                                        wire:model="bill_number"
                                        class="form-control"
                                        placeholder="Enter bill number"
                                    >

                                    @error('bill_number')
                                        <span class="text-danger error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>


                                {{-- EXPENSE DATE --}}

                                <div class="col-md-6">

                                    <label class="form-label">
                                        Expense Date
                                        <span class="required">*</span>
                                    </label>

                                    <input
                                        type="date"
                                        wire:model="expense_date"
                                        class="form-control"
                                    >

                                    @error('expense_date')
                                        <span class="text-danger error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>


                                {{-- TOTAL AMOUNT --}}

                                <div class="col-md-6">

                                    <label class="form-label">
                                        Total Amount
                                        <span class="required">*</span>
                                    </label>

                                    <input
                                        type="text"
                                        wire:model.live="total_amount"
                                        class="form-control"
                                        placeholder="Enter total amount"
                                    >

                                    @error('total_amount')
                                        <span class="text-danger error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>


                                {{-- PAID AMOUNT --}}

                                <div class="col-md-6">

                                    <label class="form-label">
                                        Paid Amount
                                    </label>

                                    <input
                                        type="text"
                                        wire:model.live="paid_amount"
                                        class="form-control"
                                        placeholder="Enter paid amount"
                                    >

                                    @error('paid_amount')
                                        <span class="text-danger error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>


                                {{-- BALANCE AMOUNT --}}

                                <div class="col-md-6">

                                    <label class="form-label">
                                        Balance Amount
                                    </label>

                                    <input
                                        type="text"
                                        wire:model.live="balance_amount"
                                        class="form-control balance-field"
                                        placeholder="Enter balance amount"
                                        readonly
                                    >

                                    @error('balance_amount')
                                        <span class="text-danger error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>


                                {{-- DESCRIPTION --}}

                                <div class="col-md-12">

                                    <label class="form-label">
                                        Description
                                    </label>

                                    <textarea
                                        wire:model="description"
                                        class="form-control"
                                        placeholder="Enter description"
                                    ></textarea>

                                    @error('description')
                                        <span class="text-danger error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- FOOTER --}}

                    <div class="modal-footer">

                        <button
                            type="button"
                            class="btn btn-secondary"
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
                                class="spinner-border spinner-border-sm"
                                wire:loading
                            ></i>

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>


    {{-- =========================================================
         SUPPLIER MODAL
    ========================================================== --}}

    @if($showSupplierModal)

        <div
            class="modal fade show d-block supplier-modal"
            tabindex="-1"
            style="
                background: rgba(15,23,42,.55);
                z-index: 1070 !important;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
            "
        >

            <div class="modal-dialog small-modal-dialog">

                <div class="modal-content">

                    <div class="modal-header">

                        <div>
                            <h5 class="modal-title">
                                Add New Supplier
                            </h5>
                        </div>

                        <button
                            type="button"
                            class="btn-close"
                            wire:click="$set('showSupplierModal', false)"
                            aria-label="Close"
                        ></button>

                    </div>

                    <div class="modal-body small-modal-body">

                        <div class="form-section">

                            <div class="section-heading">

                                <span class="section-icon">
                                    <i class="bx bx-user-plus"></i>
                                </span>

                                Supplier Details

                            </div>

                            <div class="row g-3">

                                <div class="col-md-6">

                                    <label class="form-label">
                                        First Name
                                    </label>

                                    <input
                                        type="text"
                                        class="form-control"
                                        wire:model="newSupplier.name"
                                        placeholder="Enter first name"
                                    >

                                    @error('newSupplier.name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>

                                <div class="col-md-6">

                                    <label class="form-label">
                                        Last Name
                                    </label>

                                    <input
                                        type="text"
                                        class="form-control"
                                        wire:model="newSupplier.lastname"
                                        placeholder="Enter last name"
                                    >

                                    @error('newSupplier.lastname')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="modal-footer">

                        <button
                            type="button"
                            class="btn btn-secondary"
                            wire:click="$set('showSupplierModal', false)"
                        >
                            Cancel
                        </button>

                        <button
                            type="button"
                            class="btn btn-primary"
                            wire:click="saveSupplier"
                        >
                            <i class="bx bx-check me-1"></i>
                            Save
                        </button>

                    </div>

                </div>

            </div>

        </div>

    @endif


    {{-- =========================================================
         CATEGORY MODAL
    ========================================================== --}}

    <div
        class="modal @if ($showCategoryModel) show @endif"
        tabindex="-1"
        style="
            opacity:1;
            background-color:rgba(15,23,42,.55);
            display:@if ($showCategoryModel) block @else none @endif;
        "
    >

        <div class="modal-dialog modal-md">

            <div class="modal-content">

                <form wire:submit.prevent="categoryLabelStore">

                    <div class="modal-header">

                        <h4 class="modal-title">
                            Create Category
                        </h4>

                        <button
                            type="button"
                            class="btn-close"
                            wire:click="$set('showCategoryModel', false)"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        ></button>

                    </div>


                    <div class="modal-body">

                        @csrf

                        <div class="form-section">

                            <div class="section-heading">

                                <span class="section-icon">
                                    <i class="bx bx-category"></i>
                                </span>

                                Category Details

                            </div>

                            <div class="row g-3">

                                <div class="col-md-12">

                                    <label class="form-label">
                                        Category Label
                                    </label>

                                    <input
                                        type="text"
                                        wire:model="category_label"
                                        class="form-control"
                                        placeholder="Enter category label"
                                    >

                                    @error('category_label')
                                        <span class="text-danger error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>

                            </div>

                        </div>

                    </div>


                    <div class="modal-footer">

                        <button
                            type="button"
                            class="btn btn-secondary"
                            wire:click="$set('showCategoryModel', false)"
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
                                class="spinner-border spinner-border-sm"
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

    <div class="card expenses-header">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center">

                <div class="expenses-heading">

                    <div class="expenses-heading-icon">
                        <i class="bx bx-receipt"></i>
                    </div>

                    <div>

                        <h4 class="expenses-title">
                            Expenses
                        </h4>

                        <div class="expenses-subtitle">
                            Manage expense records, payments and balances
                        </div>

                    </div>

                </div>


                @if ($user->hasPermissionTo('expenses-add'))

                    <a
                        href="javascript:;"
                        wire:click="create"
                        class="btn btn-primary"
                    >
                        <i class="bx bx-plus me-1"></i>
                        Add Expense
                    </a>

                @endif

            </div>

        </div>

    </div>


    {{-- =========================================================
         FILTERS
    ========================================================== --}}

    <div class="card expenses-filter-card">

        <div class="card-body">

            <div class="row g-3 align-items-center">

                <div class="col-md-5">

                    <div class="search-wrapper">

                        <i class="bx bx-search search-icon"></i>

                        <input
                            type="text"
                            class="form-control search-input"
                            placeholder="Search Expenses"
                            wire:model.live="searchfilter"
                        >

                    </div>

                </div>

                <div class="col-md-auto ms-md-auto">

                    <button
                        type="button"
                        class="clear-button"
                        wire:click="resetFilter"
                    >
                        <i class="bx bx-reset me-1"></i>
                        Clear
                    </button>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         EXPENSE TABLE
    ========================================================== --}}

    <div class="card expenses-table-card">

        @if (!empty($items) && $items->count())

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table expenses-table">

                        <thead>

                            <tr>

                                <th>S.No.</th>
                                <th>Supplier Name</th>
                                <th>Bill Number</th>
                                <th>Category</th>
                                <th>Total Amount ({{ getCurrencySymbols() }})</th>
                                <th>Balance Amount ({{ getCurrencySymbols() }})</th>
                                <th>Status</th>
                                <th>Date</th>

                                @if ($user->hasPermissionTo('expenses-edit') || $user->hasPermissionTo('expenses-delete'))

                                    <th>Actions</th>

                                @endif

                            </tr>

                        </thead>


                        <tbody>

                            @foreach ($items as $index => $item)

                                <tr>

                                    <td>
                                        {{ $items->total() - ($items->firstItem() + $index) + 1 }}
                                    </td>


                                    <td
                                        class="expense-clickable supplier-name"
                                        wire:click="edit({{ $item->id }})"
                                    >
                                        {{ $item->sparePartSupplier?->business_first_name }}
                                    </td>


                                    <td
                                        class="expense-clickable bill-number"
                                        wire:click="edit({{ $item->id }})"
                                    >
                                        {{ $item->bill_number }}
                                    </td>


                                    <td
                                        class="expense-clickable"
                                        wire:click="edit({{ $item->id }})"
                                    >
                                        {{ $item->sparePartCategory?->title }}
                                    </td>


                                    <td
                                        class="expense-clickable amount"
                                        wire:click="edit({{ $item->id }})"
                                    >
                                        {{ $item->total_amount }}
                                    </td>


                                    <td
                                        class="expense-clickable balance"
                                        wire:click="edit({{ $item->id }})"
                                    >
                                        {{ $item->balance_amount }}
                                    </td>


                                    {{-- STATUS --}}

                                    @if ($item->total_amount == $item->paid_amount)

                                        <td
                                            class="expense-clickable"
                                            wire:click="edit({{ $item->id }})"
                                        >
                                            <span class="expense-status status-paid">
                                                Full Paid
                                            </span>
                                        </td>

                                    @elseif(empty($item->paid_amount))

                                        <td
                                            class="expense-clickable"
                                            wire:click="edit({{ $item->id }})"
                                        >
                                            <span class="expense-status status-unpaid">
                                                Unpaid
                                            </span>
                                        </td>

                                    @elseif($item->total_amount > $item->paid_amount)

                                        <td
                                            class="expense-clickable"
                                            wire:click="edit({{ $item->id }})"
                                        >
                                            <span class="expense-status status-partial">
                                                Partially Paid
                                            </span>
                                        </td>

                                    @else

                                        <td>-</td>

                                    @endif


                                    <td
                                        class="expense-clickable"
                                        wire:click="edit({{ $item->id }})"
                                    >
                                        {{ date(getDateFormat(), strtotime($item->date)) }}
                                    </td>


                                    {{-- ACTIONS --}}

                                    @if ($user->hasPermissionTo('expenses-edit') || $user->hasPermissionTo('expenses-delete'))

                                        <td>

                                            @if ($user->hasPermissionTo('expenses-edit'))

                                                <button
                                                    type="button"
                                                    class="expense-action"
                                                    wire:click="edit({{ $item->id }})"
                                                    aria-label="Edit expense"
                                                >
                                                    <i class="bx bxs-edit"></i>
                                                </button>

                                            @endif


                                            @if ($user->hasPermissionTo('expenses-delete'))

                                                <button
                                                    type="button"
                                                    class="expense-action delete"
                                                    wire:click="confirmDelete({{ $item->id }})"
                                                    aria-label="Delete expense"
                                                >
                                                    <i class="bx bxs-trash"></i>
                                                </button>

                                            @endif

                                        </td>

                                    @endif

                                </tr>

                            @endforeach

                        </tbody>

                    </table>


                    <div class="pagination-wrapper">
                        {{ $items->links() }}
                    </div>

                </div>

            </div>

        @else

            <div class="my-0">

                <div class="alert alert-info">

                    <i class="bx bx-info-circle me-1"></i>

                    No Expenses Found!

                </div>

            </div>

        @endif

    </div>

</div>


@section('footerscript')

    <script>
        window.addEventListener('set-supplier-select', function(event) {
            let detail = event.detail;
            let sId = (detail && typeof detail === 'object') ? (detail.id ?? (detail[0] ? detail[0].id : null)) : detail;
            if (sId) {
                setTimeout(function() {
                    let $s = $('#sparepart_expense_supplier_id');
                    if ($s.length) {
                        $s.val(sId).trigger('change');
                        if ($s.data('select2')) {
                            $s.trigger('change.select2');
                        }
                    }
                }, 80);
            }
        });

        document.addEventListener('livewire:init', function () {

            Livewire.hook('morphed', (message, component) => {

                $('.select2').select2().on('change', function (e) {

                    const selectedValues = $(this).val();

                    @this.set(
                        e.target.dataset.property,
                        selectedValues
                    );

                });

            });

        });
    </script>

@endsection