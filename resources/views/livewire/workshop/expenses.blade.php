<div class="carnate-expenses-page">

    <style>
        .carnate-expenses-page {
            --ce-red: #e53935;
            --ce-red-dark: #c62828;
            --ce-red-soft: #fff5f5;
            --ce-text: #111827;
            --ce-muted: #64748b;
            --ce-border: #e2e8f0;
            --ce-card: #ffffff;
            --ce-green: #16a34a;
            --ce-orange: #d97706;
            --ce-blue: #2563eb;
            --ce-shadow: 0 4px 20px rgba(15, 23, 42, .05);
        }

        .carnate-expenses-page {
            color: var(--ce-text);
        }

        /* PAGE HEADER */
        .carnate-expenses-page .ce-page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 20px;
        }

        .carnate-expenses-page .ce-title {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
            color: var(--ce-text);
        }

        .carnate-expenses-page .ce-subtitle {
            margin: 5px 0 0;
            color: var(--ce-muted);
            font-size: 13px;
        }

        /* CARDS */
        .carnate-expenses-page .ce-card {
            background: var(--ce-card);
            border: 1px solid var(--ce-border);
            border-radius: 14px;
            box-shadow: var(--ce-shadow);
            overflow: hidden;
        }

        .carnate-expenses-page .ce-filter-card {
            margin-bottom: 18px;
        }

        .carnate-expenses-page .ce-filter-body {
            padding: 16px 18px;
        }

        .carnate-expenses-page .ce-filter-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .carnate-expenses-page .ce-search {
            width: 340px;
            max-width: 100%;
        }

        /* FORM */
        .carnate-expenses-page .form-control,
        .carnate-expenses-page .form-select {
            min-height: 42px;
            border: 1px solid var(--ce-border);
            border-radius: 9px;
            color: var(--ce-text);
            background: #fff;
            box-shadow: none;
        }

        .carnate-expenses-page .form-control:focus,
        .carnate-expenses-page .form-select:focus {
            border-color: rgba(229, 57, 53, .55);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .08);
        }

        .carnate-expenses-page textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }

        .carnate-expenses-page .ce-label {
            display: block;
            margin-bottom: 7px;
            color: #475569;
            font-size: 12px;
            font-weight: 700;
        }

        .carnate-expenses-page .ce-required {
            color: var(--ce-red);
        }

        .carnate-expenses-page .ce-error {
            display: block;
            margin-top: 5px;
            color: #dc2626;
            font-size: 11px;
        }

        /* BUTTONS */
        .carnate-expenses-page .ce-btn {
            min-height: 40px;
            padding: 9px 15px;
            border-radius: 9px;
            border: 1px solid transparent;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all .18s ease;
        }

        .carnate-expenses-page .ce-btn-primary {
            background: var(--ce-red);
            border-color: var(--ce-red);
            color: #fff;
        }

        .carnate-expenses-page .ce-btn-primary:hover {
            background: var(--ce-red-dark);
            border-color: var(--ce-red-dark);
            color: #fff;
            transform: translateY(-1px);
        }

        .carnate-expenses-page .ce-btn-secondary {
            background: #fff;
            border-color: var(--ce-border);
            color: #475569;
        }

        .carnate-expenses-page .ce-btn-secondary:hover {
            background: #f8fafc;
            color: var(--ce-text);
        }

        .carnate-expenses-page .ce-add-btn {
            padding: 10px 17px;
        }

        /* ORIGINAL LIVEWIRE + BUTTON COMPATIBLE */
        .carnate-expenses-page .ce-livewire-plus {
            width: 42px;
            height: 42px;
            padding: 0;
            flex: 0 0 42px;
            border-radius: 9px;
            border: 1px solid var(--ce-red);
            background: var(--ce-red);
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 18px;
            line-height: 1;
        }

        .carnate-expenses-page .ce-livewire-plus:hover {
            background: var(--ce-red-dark);
            border-color: var(--ce-red-dark);
            color: #fff;
        }

        .carnate-expenses-page .ce-category-control,
        .carnate-expenses-page .ce-supplier-control {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .carnate-expenses-page .ce-category-control .form-select,
        .carnate-expenses-page .ce-supplier-control .form-select {
            flex: 1;
        }

        /* TABLE */
        .carnate-expenses-page .ce-table-wrap {
            overflow-x: auto;
        }

        .carnate-expenses-page .ce-table {
            width: 100%;
            min-width: 950px;
            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .carnate-expenses-page .ce-table thead th {
            padding: 13px 15px;
            background: #f8fafc;
            color: #475569;
            border-bottom: 1px solid var(--ce-border);
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .45px;
            white-space: nowrap;
        }

        .carnate-expenses-page .ce-table tbody td {
            padding: 14px 15px;
            border-bottom: 1px solid #eef2f7;
            color: #334155;
            font-size: 13px;
            vertical-align: middle;
        }

        .carnate-expenses-page .ce-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .carnate-expenses-page .ce-table tbody tr:hover {
            background: #fafbfc;
        }

        /* PRESERVE ORIGINAL CLICKABLE TD */
        .carnate-expenses-page .expensestable td {
            cursor: pointer;
        }

        .carnate-expenses-page .expensestable td:hover {
            color: var(--ce-red);
        }

        .carnate-expenses-page .ce-index {
            width: 60px;
            color: #94a3b8 !important;
            font-weight: 600;
        }

        .carnate-expenses-page .ce-supplier {
            display: flex;
            align-items: center;
            gap: 9px;
            color: var(--ce-text);
            font-weight: 600;
        }

        .carnate-expenses-page .ce-avatar {
            width: 32px;
            height: 32px;
            flex: 0 0 32px;
            border-radius: 9px;
            background: var(--ce-red-soft);
            color: var(--ce-red);
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .carnate-expenses-page .ce-bill {
            font-weight: 600;
            white-space: nowrap;
        }

        .carnate-expenses-page .ce-category {
            display: inline-flex;
            padding: 5px 9px;
            background: #f8fafc;
            border: 1px solid #e8edf3;
            border-radius: 7px;
            color: #475569;
            font-size: 12px;
            font-weight: 600;
        }

        .carnate-expenses-page .ce-amount,
        .carnate-expenses-page .ce-balance {
            font-weight: 700;
            white-space: nowrap;
        }

        .carnate-expenses-page .ce-date {
            color: var(--ce-muted);
            white-space: nowrap;
        }

        /* STATUS */
        .carnate-expenses-page .ce-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        .carnate-expenses-page .ce-status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
        }

        .carnate-expenses-page .ce-status-paid {
            background: #f0fdf4;
            color: #15803d;
        }

        .carnate-expenses-page .ce-status-unpaid {
            background: var(--ce-red-soft);
            color: #dc2626;
        }

        .carnate-expenses-page .ce-status-partial {
            background: #fff7ed;
            color: #d97706;
        }

        /* ACTIONS */
        .carnate-expenses-page .ce-actions {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .carnate-expenses-page .ce-icon-btn {
            width: 34px;
            height: 34px;
            padding: 0;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all .18s ease;
        }

        .carnate-expenses-page .ce-edit-btn {
            color: var(--ce-blue);
            background: #eff6ff;
            border: 1px solid #dbeafe;
        }

        .carnate-expenses-page .ce-delete-btn {
            color: #dc2626;
            background: var(--ce-red-soft);
            border: 1px solid #fee2e2;
        }

        .carnate-expenses-page .ce-icon-btn:hover {
            transform: translateY(-1px);
        }

        /* EMPTY */
        .carnate-expenses-page .ce-empty {
            padding: 55px 20px;
            text-align: center;
            color: var(--ce-muted);
        }

        .carnate-expenses-page .ce-empty-icon {
            width: 52px;
            height: 52px;
            margin: 0 auto 12px;
            border-radius: 14px;
            background: #f1f5f9;
            color: #64748b;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        /* MODALS */
        .carnate-expenses-page .ce-modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(6, 6, 6, .55);
            z-index: 1055;
            overflow-y: auto;
            padding: 30px 15px;
        }

        .carnate-expenses-page .ce-modal-backdrop.category-modal {
            z-index: 1065;
        }

        .carnate-expenses-page .ce-modal-dialog {
            width: 100%;
            max-width: 850px;
            margin: 0 auto;
        }

        .carnate-expenses-page .ce-modal-dialog-sm {
            max-width: 520px;
        }

        .carnate-expenses-page .ce-modal-content {
            background: #fff;
            border: 0;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 25px 70px rgba(15, 23, 42, .18);
        }

        .carnate-expenses-page .ce-modal-header {
            padding: 18px 22px;
            border-bottom: 1px solid var(--ce-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .carnate-expenses-page .ce-modal-title {
            margin: 0;
            font-size: 18px;
            font-weight: 700;
            color: var(--ce-text);
        }

        .carnate-expenses-page .ce-modal-body {
            padding: 22px;
        }

        .carnate-expenses-page .ce-modal-footer {
            padding: 15px 22px;
            border-top: 1px solid var(--ce-border);
            background: #f8fafc;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 9px;
        }

        .carnate-expenses-page .ce-close {
            width: 34px;
            height: 34px;
            padding: 0;
            border: 1px solid var(--ce-border);
            border-radius: 8px;
            background: #fff;
            color: #64748b;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .carnate-expenses-page .ce-close:hover {
            background: var(--ce-red-soft);
            border-color: #fecaca;
            color: var(--ce-red);
        }

        .carnate-expenses-page .ce-balance-input {
            background: #f8fafc !important;
            color: #64748b;
            font-weight: 700;
        }

        .carnate-expenses-page .ce-spinner {
            width: 14px;
            height: 14px;
            border-width: 2px;
        }

        @media (max-width: 767px) {
            .carnate-expenses-page .ce-page-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .carnate-expenses-page .ce-filter-row {
                align-items: stretch;
                flex-direction: column;
            }

            .carnate-expenses-page .ce-search {
                width: 100%;
            }

            .carnate-expenses-page .ce-modal-backdrop {
                padding: 15px 10px;
            }

            .carnate-expenses-page .ce-modal-body {
                padding: 16px;
            }
        }
    </style>


    {{-- ============================================================
        SUCCESS MESSAGE
    ============================================================= --}}

    @if (session()->has('message'))
        <div class="alert alert-success border-0 shadow-sm rounded-3 mb-3">
            <i class="bx bx-check-circle me-1"></i>
            {{ session('message') }}
        </div>
    @endif


    {{-- ============================================================
        SUPPLIER MODAL
    ============================================================= --}}

    @if($showSupplierModal)

        <div
            class="ce-modal-backdrop"
            style="z-index: 1055;">

            <div class="ce-modal-dialog ce-modal-dialog-sm">

                <div class="ce-modal-content">

                    <div class="ce-modal-header">

                        <h5 class="ce-modal-title">
                            <i class="bx bx-user-plus me-2" style="color:#e53935;"></i>
                            Add New Supplier
                        </h5>

                        <button
                            type="button"
                            class="ce-close"
                            wire:click="$set('showSupplierModal', false)">
                            <i class="bx bx-x"></i>
                        </button>

                    </div>

                    <div class="ce-modal-body">

                        <div class="mb-3">

                            <label class="ce-label">
                                First Name
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                wire:model="newSupplier.name">

                            @error('newSupplier.name')
                                <span class="ce-error">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>

                        <div>

                            <label class="ce-label">
                                Last Name
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                wire:model="newSupplier.lastname">

                            @error('newSupplier.lastname')
                                <span class="ce-error">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>

                    </div>

                    <div class="ce-modal-footer">

                        <button
                            type="button"
                            class="ce-btn ce-btn-secondary"
                            wire:click="$set('showSupplierModal', false)">
                            Cancel
                        </button>

                        <button
                            type="button"
                            class="ce-btn ce-btn-primary"
                            wire:click="saveSupplier">
                            <i class="bx bx-check"></i>
                            Save
                        </button>

                    </div>

                </div>

            </div>

        </div>

    @endif


    {{-- ============================================================
        EXPENSE ADD / EDIT MODAL
    ============================================================= --}}

    @if($showModal)

        <div
            class="ce-modal-backdrop"
            style="z-index:1055;">

            <div class="ce-modal-dialog">

                <div class="ce-modal-content">

                    <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">

                        <div class="ce-modal-header">

                            <h4 class="ce-modal-title">

                                <i
                                    class="bx bx-receipt me-2"
                                    style="color:#e53935;">
                                </i>

                                {{ $isEdit ? 'Edit Expenses' : 'Create Expenses' }}

                            </h4>

                            <button
                                type="button"
                                class="ce-close"
                                wire:click="$set('showModal', false)"
                                data-bs-dismiss="modal"
                                aria-label="Close">

                                <i class="bx bx-x"></i>

                            </button>

                        </div>


                        <div class="ce-modal-body">

                            @csrf

                            <div class="row g-3">

                                {{-- CATEGORY --}}

                                <div class="col-md-6">

                                    <label class="ce-label">
                                        Category
                                        <sup class="ce-required">*</sup>
                                    </label>

                                    <div class="ce-category-control">

                                        <select
                                            class="form-select"
                                            wire:model="category_id"
                                            required>

                                            <option
                                                value=""
                                                selected
                                                disabled>
                                                --Select Category--
                                            </option>

                                            @foreach ($categories as $category)

                                                <option value="{{ $category->id }}">
                                                    {{ @$category->title }}
                                                </option>

                                            @endforeach

                                        </select>

                                        {{-- EXACT LIVEWIRE ACTION FROM ORIGINAL --}}
                                        <button
                                            type="button"
                                            class="ce-livewire-plus"
                                            wire:click="addCategory"
                                            title="Add Category">

                                            <i class="bx bx-plus"></i>

                                        </button>

                                    </div>

                                    @error('category_id')
                                        <span class="ce-error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>


                                {{-- SUPPLIER --}}

                                <div class="col-md-6">

                                    <label class="ce-label">
                                        Name
                                    </label>

                                    <div class="ce-supplier-control">

                                        <select
                                            class="form-select"
                                            wire:model="supplier_id">

                                            <option
                                                value=""
                                                selected
                                                disabled>
                                                -- select name --
                                            </option>

                                            @foreach ($suppliers as $supplier)

                                                <option value="{{ $supplier->id }}">
                                                    {{ $supplier->business_first_name }}
                                                </option>

                                            @endforeach

                                        </select>

                                        {{-- EXACT LIVEWIRE ACTION FROM ORIGINAL --}}
                                        <button
                                            type="button"
                                            class="btn btn-sm btn-primary"
                                            wire:click="openSupplierModal"
                                            style="
                                                width:42px;
                                                height:42px;
                                                flex:0 0 42px;
                                                padding:0;
                                                border-radius:9px;
                                                border:0;
                                                background:#e53935;
                                            "
                                            title="Add Supplier">

                                            <i class="bx bx-plus"></i>

                                        </button>

                                    </div>

                                    @error('supplier_id')
                                        <span class="ce-error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>


                                {{-- BILL NUMBER --}}

                                <div class="col-md-6">

                                    <label class="ce-label">
                                        Bill Number
                                        <sup class="ce-required">*</sup>
                                    </label>

                                    <input
                                        type="text"
                                        wire:model="bill_number"
                                        class="form-control"
                                        placeholder="Enter Bill Number">

                                    @error('bill_number')
                                        <span class="ce-error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>


                                {{-- EXPENSE DATE --}}

                                <div class="col-md-6">

                                    <label class="ce-label">
                                        Expense Date
                                        <sup class="ce-required">*</sup>
                                    </label>

                                    <input
                                        type="date"
                                        wire:model="expense_date"
                                        class="form-control">

                                    @error('expense_date')
                                        <span class="ce-error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>


                                {{-- TOTAL AMOUNT --}}

                                <div class="col-md-6">

                                    <label class="ce-label">
                                        Total Amount
                                        <sup class="ce-required">*</sup>
                                    </label>

                                    <input
                                        type="text"
                                        wire:model.live="total_amount"
                                        class="form-control"
                                        placeholder="Enter Total Amount">

                                    @error('total_amount')
                                        <span class="ce-error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>


                                {{-- PAID AMOUNT --}}

                                <div class="col-md-6">

                                    <label class="ce-label">
                                        Paid Amount
                                    </label>

                                    <input
                                        type="text"
                                        wire:model.live="paid_amount"
                                        class="form-control"
                                        placeholder="Enter Paid Amount">

                                    @error('paid_amount')
                                        <span class="ce-error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>


                                {{-- BALANCE AMOUNT --}}

                                <div class="col-md-6">

                                    <label class="ce-label">
                                        Balance Amount
                                    </label>

                                    <input
                                        type="text"
                                        wire:model.live="balance_amount"
                                        class="form-control ce-balance-input"
                                        placeholder="Enter Balance Amount"
                                        readonly>

                                    @error('balance_amount')
                                        <span class="ce-error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>


                                {{-- DESCRIPTION --}}

                                <div class="col-md-12">

                                    <label class="ce-label">
                                        Description
                                    </label>

                                    <textarea
                                        wire:model="description"
                                        class="form-control"
                                        placeholder="Enter Description"></textarea>

                                    @error('description')
                                        <span class="ce-error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>

                            </div>

                        </div>


                        <div class="ce-modal-footer">

                            <button
                                type="button"
                                class="ce-btn ce-btn-secondary"
                                wire:click="$set('showModal', false)"
                                data-bs-dismiss="modal">

                                Cancel

                            </button>

                            <button
                                type="submit"
                                class="ce-btn ce-btn-primary">

                                {{ $isEdit ? 'Update' : 'Create' }}

                                <i
                                    class="spinner-border spinner-border-sm ce-spinner"
                                    wire:loading>
                                </i>

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    @endif


    {{-- ============================================================
        CATEGORY MODAL
    ============================================================= --}}

    @if($showCategoryModel)

        <div
            class="ce-modal-backdrop category-modal">

            <div class="ce-modal-dialog ce-modal-dialog-sm">

                <div class="ce-modal-content">

                    <form wire:submit.prevent="categoryLabelStore">

                        <div class="ce-modal-header">

                            <h4 class="ce-modal-title">

                                <i
                                    class="bx bx-category me-2"
                                    style="color:#e53935;">
                                </i>

                                Create Category

                            </h4>

                            <button
                                type="button"
                                class="ce-close"
                                wire:click="$set('showCategoryModel', false)"
                                data-bs-dismiss="modal"
                                aria-label="Close">

                                <i class="bx bx-x"></i>

                            </button>

                        </div>


                        <div class="ce-modal-body">

                            @csrf

                            <div>

                                <label class="ce-label">
                                    Category Label
                                </label>

                                <input
                                    type="text"
                                    wire:model="category_label"
                                    class="form-control"
                                    placeholder="Enter Category Label">

                                @error('category_label')
                                    <span class="ce-error">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>

                        </div>


                        <div class="ce-modal-footer">

                            <button
                                type="button"
                                class="ce-btn ce-btn-secondary"
                                wire:click="$set('showCategoryModel', false)"
                                data-bs-dismiss="modal">

                                Cancel

                            </button>

                            <button
                                type="submit"
                                class="ce-btn ce-btn-primary">

                                {{ $isEdit ? 'Update' : 'Create' }}

                                <i
                                    class="spinner-border spinner-border-sm ce-spinner"
                                    wire:loading>
                                </i>

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    @endif


    {{-- ============================================================
        PAGE HEADER
    ============================================================= --}}

    <div class="ce-page-header">

        <div>

            <h4 class="ce-title">
                Expenses
            </h4>

            <p class="ce-subtitle">
                Manage workshop expenses, suppliers and payment status.
            </p>

        </div>

        <div>

            @if ($user->hasPermissionTo('expenses-add'))

                <button
                    type="button"
                    wire:click="create"
                    class="ce-btn ce-btn-primary ce-add-btn">

                    <i class="bx bxs-plus-square"></i>

                    Add

                </button>

            @endif

        </div>

    </div>


    {{-- ============================================================
        SEARCH
    ============================================================= --}}

    <div class="ce-card ce-filter-card">

        <div class="ce-filter-body">

            <div class="ce-filter-row">

                <div class="ce-search">

                    <div style="position:relative;">

                        <i
                            class="bx bx-search"
                            style="
                                position:absolute;
                                left:13px;
                                top:13px;
                                color:#94a3b8;
                                z-index:2;
                            ">
                        </i>

                        <input
                            type="text"
                            class="form-control"
                            style="padding-left:38px;"
                            placeholder="Search Expenses"
                            wire:model.live="searchfilter">

                    </div>

                </div>

                <button
                    type="button"
                    class="ce-btn ce-btn-secondary"
                    wire:click="resetFilter">

                    <i class="bx bx-reset"></i>

                    Clear

                </button>

            </div>

        </div>

    </div>


    {{-- ============================================================
        EXPENSE TABLE
    ============================================================= --}}

    <div class="ce-card">

        @if (!empty($items) && $items->count())

            <div class="ce-table-wrap">

                <table class="ce-table data-table expensestable">

                    <thead>

                        <tr>

                            <th>S.No.</th>

                            <th>Supplier Name</th>

                            <th>Bill Number</th>

                            <th>Category</th>

                            <th>
                                Total Amount ({{ getCurrencySymbols() }})
                            </th>

                            <th>
                                Balance Amount ({{ getCurrencySymbols() }})
                            </th>

                            <th>Status</th>

                            <th>Date</th>

                            @if (
                                $user->hasPermissionTo('expenses-edit') ||
                                $user->hasPermissionTo('expenses-delete')
                            )

                                <th>Actions</th>

                            @endif

                        </tr>

                    </thead>


                    <tbody>

                        @foreach ($items as $index => $item)

                            <tr>

                                <td class="ce-index">

                                    {{ $items->total() - ($items->firstItem() + $index) + 1 }}

                                </td>


                                <td
                                    wire:click="edit({{ $item->id }})">

                                    <div class="ce-supplier">

                                        <span class="ce-avatar">
                                            <i class="bx bx-user"></i>
                                        </span>

                                        <span>
                                            {{ $item->workshopSupplier?->business_first_name }}
                                        </span>

                                    </div>

                                </td>


                                <td
                                    class="ce-bill"
                                    wire:click="edit({{ $item->id }})">

                                    {{ $item->bill_number }}

                                </td>


                                <td
                                    wire:click="edit({{ $item->id }})">

                                    <span class="ce-category">
                                        {{ @$item->workshopCategory?->title }}
                                    </span>

                                </td>


                                <td
                                    class="ce-amount"
                                    wire:click="edit({{ $item->id }})">

                                    {{ $item->total_amount }}

                                </td>


                                <td
                                    class="ce-balance"
                                    wire:click="edit({{ $item->id }})"
                                    style="
                                        color:
                                        {{ $item->balance_amount > 0
                                            ? '#d97706'
                                            : '#15803d' }};
                                    ">

                                    {{ $item->balance_amount }}

                                </td>


                                @if ($item->total_amount == $item->paid_amount)

                                    <td
                                        wire:click="edit({{ $item->id }})">

                                        <span class="ce-status ce-status-paid">
                                            <span class="ce-status-dot"></span>
                                            Full Paid
                                        </span>

                                    </td>

                                @elseif(empty($item->paid_amount))

                                    <td
                                        wire:click="edit({{ $item->id }})">

                                        <span class="ce-status ce-status-unpaid">
                                            <span class="ce-status-dot"></span>
                                            Unpaid
                                        </span>

                                    </td>

                                @elseif($item->total_amount > $item->paid_amount)

                                    <td
                                        wire:click="edit({{ $item->id }})">

                                        <span class="ce-status ce-status-partial">
                                            <span class="ce-status-dot"></span>
                                            Partially Paid
                                        </span>

                                    </td>

                                @else

                                    <td>
                                        -
                                    </td>

                                @endif


                                <td
                                    class="ce-date"
                                    wire:click="edit({{ $item->id }})">

                                    {{ date(getDateFormat(), strtotime($item->date)) }}

                                </td>


                                @if (
                                    $user->hasPermissionTo('expenses-edit') ||
                                    $user->hasPermissionTo('expenses-delete')
                                )

                                    <td>

                                        <div class="ce-actions">

                                            @if ($user->hasPermissionTo('expenses-edit'))

                                                <button
                                                    type="button"
                                                    wire:click="edit({{ $item->id }})"
                                                    class="ce-icon-btn ce-edit-btn"
                                                    title="Edit">

                                                    <i class="bx bxs-edit"></i>

                                                </button>

                                            @endif


                                            @if ($user->hasPermissionTo('expenses-delete'))

                                                <button
                                                    type="button"
                                                    wire:click="confirmDelete({{ $item->id }})"
                                                    class="ce-icon-btn ce-delete-btn"
                                                    title="Delete">

                                                    <i class="fadeIn animated bx bx-trash"></i>

                                                </button>

                                            @endif

                                        </div>

                                    </td>

                                @endif

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>


            <div class="px-3 py-3">

                {{ $items->links() }}

            </div>

        @else

            <div class="ce-empty">

                <div class="ce-empty-icon">
                    <i class="bx bx-receipt"></i>
                </div>

                <div class="fw-semibold">
                    No Expenses Found!
                </div>

                <div class="small mt-1">
                    Expenses matching your search will appear here.
                </div>

            </div>

        @endif

    </div>


    {{-- ============================================================
        ORIGINAL SELECT2 JAVASCRIPT
    ============================================================= --}}

    @section('footerscript')

        <script>

            document.addEventListener('livewire:init', function () {

                Livewire.hook('morphed', (message, component) => {

                    $('.select2').select2().on('change', function(e) {

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

</div>