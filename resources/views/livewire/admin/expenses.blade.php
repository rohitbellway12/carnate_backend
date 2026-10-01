<div class="carnate-expenses-page">

    {{-- =========================================================
         CARNATE EXPENSES STYLES
    ========================================================== --}}

    <style>
        :root {
            --carnate-red: #e53935;
            --carnate-red-dark: #d32f2f;
            --carnate-red-light: #fff5f5;

            --carnate-bg: #f7f8fa;
            --carnate-white: #ffffff;

            --carnate-text: #111827;
            --carnate-secondary: #64748b;
            --carnate-muted: #94a3b8;

            --carnate-border: #e2e8f0;
            --carnate-hover: #f8fafc;

            --carnate-green: #16a34a;
            --carnate-green-light: #f0fdf4;

            --carnate-orange: #f59e0b;
            --carnate-orange-light: #fffbeb;

            --carnate-danger: #dc2626;
            --carnate-danger-light: #fef2f2;

            --carnate-radius: 14px;
        }


        /* =====================================================
           PAGE
        ====================================================== */

        .carnate-expenses-page {
            color: var(--carnate-text);
        }


        /* =====================================================
           SUCCESS ALERT
        ====================================================== */

        .carnate-success-alert {
            display: flex;
            align-items: center;

            gap: 7px;

            padding: 11px 14px;

            margin-bottom: 18px;

            border: 1px solid #bbf7d0 !important;

            border-radius: 10px !important;

            background: var(--carnate-green-light) !important;

            color: #166534 !important;

            font-size: 13px;
        }


        /* =====================================================
           PAGE HEADER
        ====================================================== */

        .carnate-page-header {
            background: #ffffff !important;

            border: 1px solid var(--carnate-border) !important;

            border-radius: var(--carnate-radius) !important;

            padding: 20px 22px !important;

            margin-bottom: 18px;

            box-shadow: 0 2px 8px rgba(15, 23, 42, 0.025);
        }

        .carnate-page-header-content {
            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 20px;
        }

        .carnate-page-title-wrapper {
            display: flex;

            align-items: center;

            gap: 13px;
        }

        .carnate-page-title-icon {
            width: 42px;
            height: 42px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 11px;

            background: var(--carnate-red-light);

            color: var(--carnate-red);

            font-size: 18px;
        }

        .carnate-page-title {
            margin: 0;

            color: var(--carnate-text);

            font-size: 19px;

            line-height: 1.25;

            font-weight: 650;

            letter-spacing: -0.02em;
        }

        .carnate-page-subtitle {
            margin: 4px 0 0;

            color: var(--carnate-secondary);

            font-size: 13px;
        }


        /* =====================================================
           ADD BUTTON
        ====================================================== */

        .carnate-btn-primary {
            display: inline-flex !important;

            align-items: center;
            justify-content: center;

            gap: 7px;

            min-height: 40px;

            padding: 9px 16px !important;

            border: 1px solid var(--carnate-red) !important;

            border-radius: 9px !important;

            background: var(--carnate-red) !important;

            color: #ffffff !important;

            font-size: 13px !important;

            font-weight: 600 !important;

            text-decoration: none !important;

            box-shadow: 0 4px 10px rgba(229, 57, 53, 0.14);

            transition: all 0.18s ease;
        }

        .carnate-btn-primary:hover {
            background: var(--carnate-red-dark) !important;

            border-color: var(--carnate-red-dark) !important;

            color: #ffffff !important;

            transform: translateY(-1px);

            box-shadow: 0 6px 14px rgba(229, 57, 53, 0.18);
        }

        .carnate-btn-primary i {
            font-size: 17px;
        }


        /* =====================================================
           SEARCH CARD
        ====================================================== */

        .carnate-filter-card {
            background: #ffffff !important;

            border: 1px solid var(--carnate-border) !important;

            border-radius: var(--carnate-radius) !important;

            padding: 18px 20px !important;

            margin-bottom: 18px;

            box-shadow: 0 2px 8px rgba(15, 23, 42, 0.025);
        }

        .carnate-filter-row {
            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 15px;
        }

        .carnate-search-wrapper {
            position: relative;

            width: 100%;

            max-width: 400px;
        }

        .carnate-search-icon {
            position: absolute;

            left: 13px;

            top: 50%;

            transform: translateY(-50%);

            color: var(--carnate-muted);

            font-size: 18px;

            pointer-events: none;
        }

        .carnate-search-input {
            width: 100%;

            height: 42px;

            padding: 9px 13px 9px 40px !important;

            border: 1px solid var(--carnate-border) !important;

            border-radius: 9px !important;

            background: #ffffff !important;

            color: var(--carnate-text) !important;

            font-size: 13px !important;

            outline: none !important;

            box-shadow: none !important;

            transition: all 0.18s ease;
        }

        .carnate-search-input::placeholder {
            color: #94a3b8 !important;
        }

        .carnate-search-input:focus {
            border-color: rgba(229, 57, 53, 0.45) !important;

            box-shadow: 0 0 0 3px rgba(229, 57, 53, 0.07) !important;
        }

        .carnate-clear-btn {
            height: 42px;

            padding: 8px 15px !important;

            border: 1px solid var(--carnate-border) !important;

            border-radius: 9px !important;

            background: #ffffff !important;

            color: var(--carnate-secondary) !important;

            font-size: 13px !important;

            font-weight: 600 !important;

            transition: all 0.18s ease;
        }

        .carnate-clear-btn:hover {
            background: var(--carnate-hover) !important;

            border-color: #cbd5e1 !important;

            color: var(--carnate-text) !important;
        }


        /* =====================================================
           TABLE CARD
        ====================================================== */

        .carnate-table-card {
            background: #ffffff !important;

            border: 1px solid var(--carnate-border) !important;

            border-radius: var(--carnate-radius) !important;

            overflow: hidden;

            box-shadow: 0 2px 8px rgba(15, 23, 42, 0.025);
        }

        .carnate-table-header {
            display: flex;

            align-items: center;

            justify-content: space-between;

            padding: 18px 20px;

            border-bottom: 1px solid var(--carnate-border);
        }

        .carnate-table-heading {
            margin: 0;

            color: var(--carnate-text);

            font-size: 15px;

            font-weight: 650;
        }

        .carnate-table-count {
            color: var(--carnate-secondary);

            font-size: 12px;
        }


        /* =====================================================
           TABLE
        ====================================================== */

        .carnate-table-wrapper {
            overflow-x: auto;
        }

        .carnate-table {
            width: 100%;

            min-width: 1050px;

            margin: 0 !important;

            border-collapse: separate !important;

            border-spacing: 0 !important;
        }

        .carnate-table thead th {
            padding: 13px 18px !important;

            background: #f8fafc !important;

            border-top: none !important;

            border-bottom: 1px solid var(--carnate-border) !important;

            color: #94a3b8 !important;

            font-size: 10px !important;

            font-weight: 700 !important;

            letter-spacing: 0.08em !important;

            text-transform: uppercase !important;

            white-space: nowrap;
        }

        .carnate-table tbody td {
            padding: 14px 18px !important;

            border-top: none !important;

            border-bottom: 1px solid #edf1f5 !important;

            color: #475569 !important;

            font-size: 13px !important;

            vertical-align: middle !important;

            white-space: nowrap;
        }

        .carnate-table tbody tr {
            transition: background-color 0.15s ease;
        }

        .carnate-table tbody tr:hover {
            background: #fafbfc !important;
        }

        .carnate-table tbody tr:last-child td {
            border-bottom: none !important;
        }


        /* =====================================================
           SERIAL NUMBER
        ====================================================== */

        .carnate-sno {
            color: #94a3b8 !important;

            font-size: 12px;

            font-weight: 600;
        }


        /* =====================================================
           CATEGORY
        ====================================================== */

        .carnate-category-cell {
            display: flex;

            align-items: center;

            gap: 9px;
        }

        .carnate-category-icon {
            width: 34px;
            height: 34px;

            min-width: 34px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 9px;

            background: var(--carnate-red-light);

            color: var(--carnate-red);

            font-size: 15px;
        }

        .carnate-category-name {
            color: var(--carnate-text) !important;

            font-weight: 600 !important;
        }


        /* =====================================================
           BILL NUMBER
        ====================================================== */

        .carnate-bill-number {
            display: inline-flex;

            align-items: center;

            padding: 5px 8px;

            border-radius: 6px;

            background: #f1f5f9;

            color: #475569;

            font-size: 11px;

            font-weight: 600;

            font-family: monospace;
        }


        /* =====================================================
           DATE
        ====================================================== */

        .carnate-date {
            display: inline-flex;

            align-items: center;

            gap: 6px;

            color: var(--carnate-secondary);

            font-size: 12px;
        }

        .carnate-date i {
            color: var(--carnate-muted);

            font-size: 15px;
        }


        /* =====================================================
           MONEY VALUES
        ====================================================== */

        .carnate-amount {
            color: var(--carnate-text) !important;

            font-weight: 600 !important;

            font-variant-numeric: tabular-nums;
        }

        .carnate-paid {
            color: var(--carnate-green) !important;

            font-weight: 600 !important;

            font-variant-numeric: tabular-nums;
        }

        .carnate-balance {
            display: inline-flex;

            align-items: center;

            padding: 5px 9px;

            border-radius: 7px;

            background: var(--carnate-orange-light);

            color: #b45309;

            font-size: 11px;

            font-weight: 700;

            font-variant-numeric: tabular-nums;
        }

        .carnate-balance.paid {
            background: var(--carnate-green-light);

            color: #15803d;
        }


        /* =====================================================
           DESCRIPTION
        ====================================================== */

        .carnate-description {
            display: block;

            max-width: 230px;

            overflow: hidden;

            text-overflow: ellipsis;

            white-space: nowrap;

            color: var(--carnate-secondary) !important;

            cursor: default !important;
        }


        /* =====================================================
           ACTIONS
        ====================================================== */

        .carnate-actions {
            display: flex;

            align-items: center;

            gap: 6px;
        }

        .carnate-action-btn {
            width: 34px;
            height: 34px;

            display: inline-flex;

            align-items: center;
            justify-content: center;

            padding: 0 !important;

            border: 1px solid var(--carnate-border) !important;

            border-radius: 8px !important;

            background: #ffffff !important;

            color: #64748b !important;

            cursor: pointer;

            transition: all 0.18s ease;
        }

        .carnate-action-btn:hover {
            background: var(--carnate-red-light) !important;

            border-color: rgba(229, 57, 53, 0.20) !important;

            color: var(--carnate-red) !important;
        }

        .carnate-action-btn.delete:hover {
            background: var(--carnate-danger-light) !important;

            border-color: #fecaca !important;

            color: var(--carnate-danger) !important;
        }

        .carnate-action-btn i {
            font-size: 16px;
        }


        /* =====================================================
           EMPTY STATE
        ====================================================== */

        .carnate-empty-state {
            padding: 60px 20px;

            text-align: center;
        }

        .carnate-empty-icon {
            width: 54px;
            height: 54px;

            display: flex;

            align-items: center;
            justify-content: center;

            margin: 0 auto 14px;

            border-radius: 14px;

            background: #f8fafc;

            color: #94a3b8;

            font-size: 24px;
        }

        .carnate-empty-title {
            margin: 0 0 5px;

            color: var(--carnate-text);

            font-size: 14px;

            font-weight: 650;
        }

        .carnate-empty-text {
            margin: 0;

            color: var(--carnate-secondary);

            font-size: 12px;
        }


        /* =====================================================
           PAGINATION
        ====================================================== */

        .carnate-pagination {
            padding: 15px 20px;

            border-top: 1px solid var(--carnate-border);
        }

        .carnate-pagination .pagination {
            margin: 0 !important;
        }

        .carnate-pagination .page-link {
            min-width: 34px;

            height: 34px;

            display: inline-flex;

            align-items: center;
            justify-content: center;

            margin: 0 2px;

            border: 1px solid var(--carnate-border) !important;

            border-radius: 7px !important;

            background: #ffffff !important;

            color: #64748b !important;

            font-size: 12px;

            box-shadow: none !important;
        }

        .carnate-pagination .page-link:hover {
            background: var(--carnate-hover) !important;

            color: var(--carnate-text) !important;
        }

        .carnate-pagination .page-item.active .page-link {
            background: var(--carnate-red) !important;

            border-color: var(--carnate-red) !important;

            color: #ffffff !important;
        }


        /* =====================================================
           MODAL OVERLAY
        ====================================================== */

        .carnate-expense-modal {
            position: fixed;

            inset: 0;

            z-index: 9999;

            display: flex;

            align-items: center;

            justify-content: center;

            padding: 20px;

            background: rgba(15, 23, 42, 0.52) !important;

            backdrop-filter: blur(4px);
        }


        /* =====================================================
           MODAL
        ====================================================== */

        .carnate-expense-modal-dialog {
            width: 100%;

            max-width: 820px;

            max-height: calc(100vh - 40px);

            margin: 0 auto;
        }

        .carnate-expense-modal-content {
            background: #ffffff !important;

            border: 1px solid var(--carnate-border) !important;

            border-radius: 16px !important;

            overflow: hidden;

            box-shadow:
                0 24px 70px rgba(15, 23, 42, 0.18),
                0 8px 24px rgba(15, 23, 42, 0.08);
        }

        .carnate-modal-header {
            display: flex;

            align-items: center;

            justify-content: space-between;

            padding: 19px 22px;

            border-bottom: 1px solid var(--carnate-border);
        }

        .carnate-modal-title-wrapper {
            display: flex;

            align-items: center;

            gap: 12px;
        }

        .carnate-modal-icon {
            width: 38px;
            height: 38px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 10px;

            background: var(--carnate-red-light);

            color: var(--carnate-red);

            font-size: 17px;
        }

        .carnate-modal-title {
            margin: 0;

            color: var(--carnate-text);

            font-size: 17px;

            font-weight: 650;
        }

        .carnate-modal-subtitle {
            margin: 3px 0 0;

            color: var(--carnate-secondary);

            font-size: 11px;
        }

        .carnate-modal-close {
            width: 34px;
            height: 34px;

            display: flex;

            align-items: center;
            justify-content: center;

            border: 1px solid transparent;

            border-radius: 8px;

            background: transparent;

            color: #94a3b8;

            cursor: pointer;

            font-size: 19px;

            transition: all 0.18s ease;
        }

        .carnate-modal-close:hover {
            background: #f8fafc;

            color: #111827;
        }

        .carnate-modal-body {
            padding: 22px;

            overflow-y: auto;

            max-height: calc(100vh - 185px);
        }


        /* =====================================================
           FORM
        ====================================================== */

        .carnate-form-group {
            margin-bottom: 0;
        }

        .carnate-form-label {
            display: block;

            margin-bottom: 7px;

            color: #334155;

            font-size: 12px;

            font-weight: 600;
        }

        .carnate-required {
            color: var(--carnate-red);

            margin-left: 2px;
        }

        .carnate-form-control,
        .carnate-form-select,
        .carnate-form-textarea {
            width: 100%;

            min-height: 42px;

            padding: 9px 12px !important;

            border: 1px solid var(--carnate-border) !important;

            border-radius: 8px !important;

            background: #ffffff !important;

            color: var(--carnate-text) !important;

            font-size: 13px !important;

            outline: none !important;

            box-shadow: none !important;

            transition: all 0.18s ease;
        }

        .carnate-form-control::placeholder,
        .carnate-form-textarea::placeholder {
            color: #a1aabd !important;
        }

        .carnate-form-control:focus,
        .carnate-form-select:focus,
        .carnate-form-textarea:focus {
            border-color: rgba(229, 57, 53, 0.45) !important;

            box-shadow: 0 0 0 3px rgba(229, 57, 53, 0.07) !important;
        }

        .carnate-form-textarea {
            min-height: 95px;

            resize: vertical;
        }


        /* =====================================================
           BALANCE FIELD
        ====================================================== */

        .carnate-balance-input {
            background: #f8fafc !important;

            color: #475569 !important;

            font-weight: 650 !important;

            cursor: not-allowed;
        }


        /* =====================================================
           VALIDATION
        ====================================================== */

        .carnate-form-error {
            display: block;

            margin-top: 5px;

            color: var(--carnate-danger) !important;

            font-size: 11px !important;

            line-height: 1.4;
        }


        /* =====================================================
           MODAL FOOTER
        ====================================================== */

        .carnate-modal-footer {
            display: flex;

            align-items: center;

            justify-content: flex-end;

            gap: 8px;

            padding: 16px 22px;

            border-top: 1px solid var(--carnate-border);

            background: #ffffff;
        }

        .carnate-btn-secondary {
            min-height: 40px;

            padding: 9px 16px;

            border: 1px solid var(--carnate-border);

            border-radius: 9px;

            background: #ffffff;

            color: #64748b;

            font-size: 13px;

            font-weight: 600;

            cursor: pointer;

            transition: all 0.18s ease;
        }

        .carnate-btn-secondary:hover {
            background: #f8fafc;

            border-color: #cbd5e1;

            color: #111827;
        }

        .carnate-btn-primary:disabled {
            opacity: 0.7;

            cursor: not-allowed;

            transform: none;
        }


        /* =====================================================
           RESPONSIVE
        ====================================================== */

        @media (max-width: 991px) {

            .carnate-table {
                min-width: 950px;
            }
        }

        @media (max-width: 767px) {

            .carnate-page-header-content {
                align-items: flex-start;

                flex-direction: column;
            }

            .carnate-btn-primary {
                width: 100%;
            }

            .carnate-filter-row {
                align-items: stretch;

                flex-direction: column;
            }

            .carnate-search-wrapper {
                max-width: none;
            }

            .carnate-clear-btn {
                width: 100%;
            }

            .carnate-expense-modal {
                padding: 10px;
            }

            .carnate-expense-modal-dialog {
                max-height: calc(100vh - 20px);
            }

            .carnate-modal-header,
            .carnate-modal-body,
            .carnate-modal-footer {
                padding-left: 16px;

                padding-right: 16px;
            }

            .carnate-modal-footer {
                flex-direction: column;
            }

            .carnate-modal-footer button {
                width: 100%;
            }
        }
    </style>



    {{-- =========================================================
         SUCCESS MESSAGE
    ========================================================== --}}

    @if (session()->has('message'))

        <div class="carnate-success-alert">

            <i class="bx bx-check-circle"></i>

            {{ session('message') }}

        </div>

    @endif



    {{-- =========================================================
         PAGE HEADER
    ========================================================== --}}

    <div class="carnate-page-header">

        <div class="carnate-page-header-content">

            <div class="carnate-page-title-wrapper">

                <div class="carnate-page-title-icon">

                    <i class="bx bx-receipt"></i>

                </div>

                <div>

                    <h1 class="carnate-page-title">
                        Expenses
                    </h1>

                    <p class="carnate-page-subtitle">
                        Track, manage and monitor your workshop expenses.
                    </p>

                </div>

            </div>


            <button
                type="button"
                class="carnate-btn-primary"
                wire:click="create"
            >

                <i class="bx bx-plus"></i>

                Add Expense

            </button>

        </div>

    </div>



    {{-- =========================================================
         SEARCH
    ========================================================== --}}

    <div class="carnate-filter-card">

        <div class="carnate-filter-row">

            <div class="carnate-search-wrapper">

                <i class="bx bx-search carnate-search-icon"></i>

                <input
                    type="text"
                    class="carnate-search-input"
                    placeholder="Search expenses..."
                    wire:model.debounce.500ms="searchfilter"
                >

            </div>


            <button
                type="button"
                class="carnate-clear-btn"
                wire:click="$set('searchfilter', '')"
            >

                <i class="bx bx-reset me-1"></i>

                Clear

            </button>

        </div>

    </div>



    {{-- =========================================================
         ADD / EDIT EXPENSE MODAL
    ========================================================== --}}

    @if ($showModal)

        <div class="carnate-expense-modal">

            <div class="carnate-expense-modal-dialog">

                <div class="carnate-expense-modal-content">

                    <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">

                        @csrf


                        {{-- MODAL HEADER --}}

                        <div class="carnate-modal-header">

                            <div class="carnate-modal-title-wrapper">

                                <div class="carnate-modal-icon">

                                    <i class="bx {{ $isEdit ? 'bx-edit' : 'bx-receipt' }}"></i>

                                </div>

                                <div>

                                    <h4 class="carnate-modal-title">

                                        {{ $isEdit ? 'Edit Expense' : 'Create Expense' }}

                                    </h4>

                                    <div class="carnate-modal-subtitle">

                                        {{ $isEdit
                                            ? 'Update the expense information below.'
                                            : 'Enter the details for the new expense.'
                                        }}

                                    </div>

                                </div>

                            </div>


                            <button
                                type="button"
                                class="carnate-modal-close"
                                wire:click="$set('showModal', false)"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                            >

                                <i class="bx bx-x"></i>

                            </button>

                        </div>



                        {{-- MODAL BODY --}}

                        <div class="carnate-modal-body">

                            <div class="row g-3">


                                {{-- CATEGORY --}}

                                <div class="col-md-6">

                                    <div class="carnate-form-group">

                                        <label class="carnate-form-label">

                                            Category

                                            <span class="carnate-required">*</span>

                                        </label>

                                        <select
                                            class="carnate-form-select"
                                            wire:model="category_id"
                                            required
                                        >

                                            <option value="" selected disabled>
                                                Select Category
                                            </option>

                                            @foreach ($categories as $category)

                                                <option value="{{ $category->id }}">
                                                    {{ $category->title }}
                                                </option>

                                            @endforeach

                                        </select>

                                    </div>

                                    @error('category_id')

                                        <span class="carnate-form-error">
                                            {{ $message }}
                                        </span>

                                    @enderror

                                </div>



                                {{-- BILL NUMBER --}}

                                <div class="col-md-6">

                                    <div class="carnate-form-group">

                                        <label class="carnate-form-label">

                                            Bill Number

                                            <span class="carnate-required">*</span>

                                        </label>

                                        <input
                                            type="text"
                                            wire:model="bill_number"
                                            class="carnate-form-control"
                                            placeholder="Enter Bill Number"
                                        >

                                    </div>

                                    @error('bill_number')

                                        <span class="carnate-form-error">
                                            {{ $message }}
                                        </span>

                                    @enderror

                                </div>



                                {{-- EXPENSE DATE --}}

                                <div class="col-md-6">

                                    <div class="carnate-form-group">

                                        <label class="carnate-form-label">

                                            Expense Date

                                            <span class="carnate-required">*</span>

                                        </label>

                                        <input
                                            type="date"
                                            wire:model="expense_date"
                                            class="carnate-form-control"
                                        >

                                    </div>

                                    @error('expense_date')

                                        <span class="carnate-form-error">
                                            {{ $message }}
                                        </span>

                                    @enderror

                                </div>



                                {{-- TOTAL AMOUNT --}}

                                <div class="col-md-6">

                                    <div class="carnate-form-group">

                                        <label class="carnate-form-label">

                                            Total Amount

                                            <span class="carnate-required">*</span>

                                        </label>

                                        <input
                                            type="text"
                                            wire:model.live="total_amount"
                                            class="carnate-form-control"
                                            placeholder="Enter Total Amount"
                                        >

                                    </div>

                                    @error('total_amount')

                                        <span class="carnate-form-error">
                                            {{ $message }}
                                        </span>

                                    @enderror

                                </div>



                                {{-- PAID AMOUNT --}}

                                <div class="col-md-6">

                                    <div class="carnate-form-group">

                                        <label class="carnate-form-label">
                                            Paid Amount
                                        </label>

                                        <input
                                            type="text"
                                            wire:model.live="paid_amount"
                                            class="carnate-form-control"
                                            placeholder="Enter Paid Amount"
                                        >

                                    </div>

                                    @error('paid_amount')

                                        <span class="carnate-form-error">
                                            {{ $message }}
                                        </span>

                                    @enderror

                                </div>



                                {{-- BALANCE AMOUNT --}}

                                <div class="col-md-6">

                                    <div class="carnate-form-group">

                                        <label class="carnate-form-label">
                                            Balance Amount
                                        </label>

                                        <input
                                            type="text"
                                            wire:model.live="balance_amount"
                                            class="carnate-form-control carnate-balance-input"
                                            readonly
                                        >

                                    </div>

                                    @error('balance_amount')

                                        <span class="carnate-form-error">
                                            {{ $message }}
                                        </span>

                                    @enderror

                                </div>



                                {{-- DESCRIPTION --}}

                                <div class="col-md-12">

                                    <div class="carnate-form-group">

                                        <label class="carnate-form-label">
                                            Description
                                        </label>

                                        <textarea
                                            wire:model="description"
                                            class="carnate-form-textarea"
                                            placeholder="Enter expense description"
                                        ></textarea>

                                    </div>

                                    @error('description')

                                        <span class="carnate-form-error">
                                            {{ $message }}
                                        </span>

                                    @enderror

                                </div>

                            </div>

                        </div>



                        {{-- MODAL FOOTER --}}

                        <div class="carnate-modal-footer">

                            <button
                                type="button"
                                class="carnate-btn-secondary"
                                wire:click="$set('showModal', false)"
                                data-bs-dismiss="modal"
                            >
                                Cancel
                            </button>


                            <button
                                type="submit"
                                class="carnate-btn-primary"
                                wire:loading.attr="disabled"
                            >

                                <i class="bx {{ $isEdit ? 'bx-check' : 'bx-plus' }}"></i>

                                {{ $isEdit ? 'Update' : 'Create' }}

                                <span
                                    wire:loading
                                    class="spinner-border spinner-border-sm"
                                    style="width:14px;height:14px;"
                                ></span>

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    @endif



    {{-- =========================================================
         EXPENSE TABLE
    ========================================================== --}}

    <div class="carnate-table-card">

        @if($expenses && $expenses->count())

            <div class="carnate-table-header">

                <h2 class="carnate-table-heading">
                    Expense Records
                </h2>

                <span class="carnate-table-count">

                    {{ $expenses->total() }}

                    {{ $expenses->total() == 1 ? 'expense' : 'expenses' }}

                </span>

            </div>


            <div class="carnate-table-wrapper">

                <table class="carnate-table">

                    <thead>

                        <tr>

                            <th>
                                #
                            </th>

                            <th>
                                Category
                            </th>

                            <th>
                                Bill Number
                            </th>

                            <th>
                                Date
                            </th>

                            <th>
                                Total
                            </th>

                            <th>
                                Paid
                            </th>

                            <th>
                                Balance
                            </th>

                            <th>
                                Description
                            </th>

                            <th>
                                Actions
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($expenses as $index => $expense)

                            <tr>

                                {{-- NUMBER --}}

                                <td>

                                    <span class="carnate-sno">
                                        {{ $expenses->firstItem() + $index }}
                                    </span>

                                </td>


                                {{-- CATEGORY --}}

                                <td>

                                    <div class="carnate-category-cell">

                                        <div class="carnate-category-icon">

                                            <i class="bx bx-pie-chart-alt-2"></i>

                                        </div>

                                        <span class="carnate-category-name">

                                            {{ optional($expense->category)->title }}

                                        </span>

                                    </div>

                                </td>


                                {{-- BILL NUMBER --}}

                                <td>

                                    <span class="carnate-bill-number">

                                        {{ $expense->bill_number }}

                                    </span>

                                </td>


                                {{-- DATE --}}

                                <td>

                                    <span class="carnate-date">

                                        <i class="bx bx-calendar"></i>

                                        {{ $expense->date }}

                                    </span>

                                </td>


                                {{-- TOTAL --}}

                                <td>

                                    <span class="carnate-amount">

                                        ₹{{ number_format((float) $expense->total_amount, 2) }}

                                    </span>

                                </td>


                                {{-- PAID --}}

                                <td>

                                    <span class="carnate-paid">

                                        ₹{{ number_format((float) $expense->paid_amount, 2) }}

                                    </span>

                                </td>


                                {{-- BALANCE --}}

                                <td>

                                    @if((float) $expense->balance_amount > 0)

                                        <span class="carnate-balance">

                                            ₹{{ number_format((float) $expense->balance_amount, 2) }}

                                        </span>

                                    @else

                                        <span class="carnate-balance paid">

                                            Paid

                                        </span>

                                    @endif

                                </td>


                                {{-- DESCRIPTION --}}

                                <td>

                                    <span
                                        class="carnate-description"
                                        title="{{ $expense->description }}"
                                    >

                                        {{ $expense->description ?: '—' }}

                                    </span>

                                </td>


                                {{-- ACTIONS --}}

                                <td>

                                    <div class="carnate-actions">

                                        <button
                                            type="button"
                                            class="carnate-action-btn"
                                            wire:click="edit({{ $expense->id }})"
                                            title="Edit Expense"
                                        >

                                            <i class="bx bx-edit"></i>

                                        </button>


                                        <button
                                            type="button"
                                            class="carnate-action-btn delete"
                                            wire:click="confirmDelete({{ $expense->id }})"
                                            title="Delete Expense"
                                        >

                                            <i class="bx bx-trash"></i>

                                        </button>

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>


            {{-- PAGINATION --}}

            <div class="carnate-pagination">

                {{ $expenses->links() }}

            </div>

        @else

            {{-- EMPTY STATE --}}

            <div class="carnate-empty-state">

                <div class="carnate-empty-icon">

                    <i class="bx bx-receipt"></i>

                </div>

                <h3 class="carnate-empty-title">

                    No Expenses Found

                </h3>

                <p class="carnate-empty-text">

                    No expense records are available.

                </p>

            </div>

        @endif

    </div>

</div>