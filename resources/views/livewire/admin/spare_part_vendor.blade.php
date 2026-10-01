<div class="carnate-vendor-page">

    @php
        $admin = App\Models\Admin::where('id', $adminId)->first();
    @endphp

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

            --carnate-danger: #dc2626;
            --carnate-danger-light: #fef2f2;

            --carnate-orange: #f59e0b;
            --carnate-orange-light: #fffbeb;

            --carnate-radius: 14px;
        }

        /* =====================================================
           PAGE
        ====================================================== */

        .carnate-vendor-page {
            color: var(--carnate-text);
        }

        /* =====================================================
           SUCCESS
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
           PRIMARY BUTTON
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
           FILTER CARD
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

            gap: 12px;
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

            box-shadow:
                0 0 0 3px rgba(229, 57, 53, 0.07) !important;
        }

        .carnate-filter-actions {
            display: flex;
            align-items: center;

            gap: 8px;
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
           BULK ACTIONS
        ====================================================== */

        .carnate-bulk-wrapper {
            position: relative;
        }

        .carnate-bulk-btn {
            height: 42px;

            display: inline-flex;
            align-items: center;

            gap: 7px;

            padding: 8px 14px;

            border: 1px solid var(--carnate-border);
            border-radius: 9px;

            background: #ffffff;
            color: #475569;

            font-size: 13px;
            font-weight: 600;

            cursor: pointer;

            transition: all 0.18s ease;
        }

        .carnate-bulk-btn:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
            color: #111827;
        }

        .carnate-bulk-count {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            min-width: 20px;
            height: 20px;

            padding: 0 5px;

            border-radius: 6px;

            background: var(--carnate-red-light);
            color: var(--carnate-red);

            font-size: 10px;
            font-weight: 700;
        }

        .carnate-bulk-menu {
            min-width: 235px;

            padding: 7px;

            border: 1px solid var(--carnate-border);

            border-radius: 10px;

            box-shadow:
                0 12px 35px rgba(15, 23, 42, 0.10);

            background: #ffffff;
        }

        .carnate-bulk-menu .dropdown-item {
            padding: 9px 10px;

            border-radius: 7px;

            color: #475569;

            font-size: 12px;

            transition: all 0.15s ease;
        }

        .carnate-bulk-menu .dropdown-item:hover {
            background: #f8fafc;
            color: #111827;
        }

        .carnate-bulk-menu .dropdown-item.danger:hover {
            background: var(--carnate-danger-light);
            color: var(--carnate-danger);
        }

        .carnate-bulk-menu .dropdown-divider {
            border-color: var(--carnate-border);
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

            min-width: 1200px;

            margin: 0 !important;

            border-collapse: separate !important;
            border-spacing: 0 !important;
        }

        .carnate-table thead th {
            padding: 13px 16px !important;

            background: #f8fafc !important;

            border-top: none !important;
            border-bottom: 1px solid var(--carnate-border) !important;

            color: #94a3b8 !important;

            font-size: 10px !important;
            font-weight: 700 !important;

            letter-spacing: 0.07em !important;
            text-transform: uppercase !important;

            white-space: nowrap;
        }

        .carnate-table tbody td {
            padding: 13px 16px !important;

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
           CHECKBOX
        ====================================================== */

        .carnate-checkbox {
            width: 16px !important;
            height: 16px !important;

            border: 1px solid #cbd5e1 !important;

            border-radius: 4px !important;

            cursor: pointer;
        }

        .carnate-checkbox:checked {
            background-color: var(--carnate-red) !important;
            border-color: var(--carnate-red) !important;
        }

        .carnate-checkbox:focus {
            box-shadow: 0 0 0 3px rgba(229, 57, 53, 0.08) !important;
        }

        /* =====================================================
           SERIAL
        ====================================================== */

        .carnate-sno {
            color: #94a3b8 !important;

            font-size: 12px;

            font-weight: 600;
        }

        /* =====================================================
           VENDOR
        ====================================================== */

        .carnate-vendor-cell {
            display: flex;

            align-items: center;

            gap: 10px;
        }

        .carnate-vendor-avatar {
            width: 35px;
            height: 35px;

            min-width: 35px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 9px;

            background: var(--carnate-red-light);

            color: var(--carnate-red);

            font-size: 11px;

            font-weight: 700;

            text-transform: uppercase;
        }

        .carnate-vendor-name {
            color: var(--carnate-text) !important;

            font-weight: 600 !important;
        }

        /* =====================================================
           EMAIL
        ====================================================== */

        .carnate-email {
            color: #475569 !important;
        }

        /* =====================================================
           ROLE
        ====================================================== */

        .carnate-role {
            display: inline-flex;

            align-items: center;

            min-height: 26px;

            padding: 5px 9px;

            border-radius: 7px;

            background: #f1f5f9;

            color: #475569;

            font-size: 11px;

            font-weight: 600;
        }

        /* =====================================================
           MOBILE
        ====================================================== */

        .carnate-mobile {
            color: #475569;

            font-variant-numeric: tabular-nums;
        }

        /* =====================================================
           CITY
        ====================================================== */

        .carnate-city {
            color: #475569;
        }

        /* =====================================================
           STATUS SWITCH
        ====================================================== */

        .carnate-status-wrapper {
            display: flex;

            align-items: center;

            gap: 8px;
        }

        .carnate-switch {
            width: 38px !important;
            height: 21px !important;

            margin: 0 !important;

            border: 1px solid #cbd5e1 !important;

            background-color: #e2e8f0 !important;

            cursor: pointer;

            box-shadow: none !important;
        }

        .carnate-switch:checked {
            background-color: var(--carnate-red) !important;

            border-color: var(--carnate-red) !important;
        }

        .carnate-switch:focus {
            box-shadow: 0 0 0 3px rgba(229, 57, 53, 0.08) !important;
        }

        .carnate-switch:disabled {
            opacity: 0.55;

            cursor: not-allowed;
        }

        .carnate-status-label {
            font-size: 11px;

            font-weight: 600;

            color: var(--carnate-secondary);
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
           MODAL
        ====================================================== */

        .carnate-vendor-modal {
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

        .carnate-vendor-modal-dialog {
            width: 100%;

            max-width: 850px;

            max-height: calc(100vh - 40px);

            margin: 0 auto;
        }

        .carnate-vendor-modal-content {
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

            max-height: calc(100vh - 180px);
        }

        /* =====================================================
           FORM
        ====================================================== */

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

            box-shadow:
                0 0 0 3px rgba(229, 57, 53, 0.07) !important;
        }

        .carnate-form-textarea {
            min-height: 90px;

            resize: vertical;
        }

        /* =====================================================
           NAME GROUP
        ====================================================== */

        .carnate-name-group {
            display: flex;

            width: 100%;
        }

        .carnate-title-select {
            width: 82px;

            min-width: 82px;

            border-radius: 8px 0 0 8px !important;

            border-right: 0 !important;
        }

        .carnate-first-name {
            border-radius: 0 8px 8px 0 !important;
        }

        /* =====================================================
           PASSWORD
        ====================================================== */

        .carnate-password-wrapper {
            position: relative;
        }

        .carnate-password-wrapper .carnate-form-control {
            padding-right: 43px !important;
        }

        .carnate-password-toggle {
            position: absolute;

            right: 8px;
            top: 50%;

            transform: translateY(-50%);

            width: 32px;
            height: 32px;

            display: flex;

            align-items: center;
            justify-content: center;

            border: 0;

            border-radius: 7px;

            background: transparent;

            color: #94a3b8;

            cursor: pointer;
        }

        .carnate-password-toggle:hover {
            background: #f8fafc;

            color: #475569;
        }

        /* =====================================================
           GST
        ====================================================== */

        .carnate-gst-field {
            transition: all 0.2s ease;
        }

        /* =====================================================
           ERROR
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

        /* =====================================================
           RESPONSIVE
        ====================================================== */

        @media (max-width: 991px) {

            .carnate-table {
                min-width: 1100px;
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

            .carnate-filter-actions {
                width: 100%;
            }

            .carnate-filter-actions > * {
                flex: 1;
            }

            .carnate-vendor-modal {
                padding: 10px;
            }

            .carnate-vendor-modal-dialog {
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
         ADD / EDIT MODAL
    ========================================================== --}}

    @if ($showModal)

        <div class="carnate-vendor-modal">

            <div class="carnate-vendor-modal-dialog">

                <div class="carnate-vendor-modal-content">

                    <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">

                        @csrf


                        {{-- MODAL HEADER --}}

                        <div class="carnate-modal-header">

                            <div class="carnate-modal-title-wrapper">

                                <div class="carnate-modal-icon">

                                    <i class="bx {{ $isEdit ? 'bx-edit' : 'bx-store' }}"></i>

                                </div>

                                <div>

                                    <h4 class="carnate-modal-title">

                                        {{ $isEdit ? 'Edit Spare Part Vendor' : 'Create Spare Part Vendor' }}

                                    </h4>

                                    <div class="carnate-modal-subtitle">

                                        {{ $isEdit
                                            ? 'Update vendor account and business information.'
                                            : 'Add a new spare part vendor to the system.'
                                        }}

                                    </div>

                                </div>

                            </div>


                            <button
                                type="button"
                                class="carnate-modal-close"
                                wire:click="closeModel"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                            >

                                <i class="bx bx-x"></i>

                            </button>

                        </div>


                        {{-- MODAL BODY --}}

                        <div class="carnate-modal-body">

                            <div class="row g-3">


                                {{-- FIRST NAME --}}

                                <div class="col-md-6">

                                    <label
                                        for="first_name"
                                        class="carnate-form-label"
                                    >
                                        First Name
                                        <span class="carnate-required">*</span>
                                    </label>


                                    <div class="carnate-name-group">

                                        <select
                                            name="user_title"
                                            id="user_title"
                                            wire:model="user_title"
                                            class="carnate-form-select carnate-title-select"
                                        >

                                            <option value="mr">Mr.</option>
                                            <option value="mrs">Mrs.</option>
                                            <option value="miss">Miss</option>
                                            <option value="ms">M.S.</option>

                                        </select>


                                        <input
                                            type="text"
                                            wire:model="name"
                                            name="first_name"
                                            id="first_name"
                                            class="carnate-form-control carnate-first-name"
                                            placeholder="Enter First Name"
                                        >

                                    </div>


                                    @if ($errors->has('name') || $errors->has('user_title'))

                                        <span class="carnate-form-error">

                                            {{ $errors->first('name') ?? $errors->first('user_title') }}

                                        </span>

                                    @endif

                                </div>


                                {{-- COMPANY NAME --}}

                                <div class="col-md-6">

                                    <label class="carnate-form-label">

                                        Company Name

                                        <span class="carnate-required">*</span>

                                    </label>

                                    <input
                                        type="text"
                                        wire:model="company_name"
                                        class="carnate-form-control"
                                        placeholder="Enter Company Name"
                                    >

                                    @error('company_name')

                                        <span class="carnate-form-error">
                                            {{ $message }}
                                        </span>

                                    @enderror

                                </div>


                                {{-- LAST NAME --}}

                                <div class="col-md-6">

                                    <label class="carnate-form-label">

                                        Last Name

                                        <span class="carnate-required">*</span>

                                    </label>

                                    <input
                                        type="text"
                                        wire:model="lastname"
                                        class="carnate-form-control"
                                        placeholder="Enter Last Name"
                                    >

                                    @error('lastname')

                                        <span class="carnate-form-error">
                                            {{ $message }}
                                        </span>

                                    @enderror

                                </div>


                                {{-- EMAIL --}}

                                <div class="col-md-6">

                                    <label class="carnate-form-label">

                                        Email

                                        <span class="carnate-required">*</span>

                                    </label>

                                    <input
                                        type="email"
                                        wire:model="email"
                                        class="carnate-form-control"
                                        placeholder="Enter Email"
                                    >

                                    @error('email')

                                        <span class="carnate-form-error">
                                            {{ $message }}
                                        </span>

                                    @enderror

                                </div>


                                {{-- PASSWORD --}}

                                @if ($isEdit == false)

                                    <div class="col-md-6">

                                        <label
                                            for="inputChoosePassword"
                                            class="carnate-form-label"
                                        >

                                            Enter Password

                                            <span class="carnate-required">*</span>

                                        </label>


                                        <div class="carnate-password-wrapper">

                                            <input
                                                type="password"
                                                class="carnate-form-control"
                                                id="inputChoosePassword"
                                                wire:model="password"
                                                placeholder="Enter Password"
                                                autocomplete="new-password"
                                            >


                                            <button
                                                type="button"
                                                class="carnate-password-toggle"
                                                onclick="togglePassword()"
                                                aria-label="Show or hide password"
                                            >

                                                <i
                                                    class="bx bx-hide"
                                                    id="password-icon"
                                                ></i>

                                            </button>

                                        </div>


                                        @error('password')

                                            <span class="carnate-form-error">
                                                {{ $message }}
                                            </span>

                                        @enderror

                                    </div>

                                @endif


                                {{-- MOBILE --}}

                                <div class="col-md-6">

                                    <label class="carnate-form-label">

                                        Mobile Number

                                        <span class="carnate-required">*</span>

                                    </label>

                                    <input
                                        type="text"
                                        wire:model="mobile_no"
                                        class="carnate-form-control"
                                        placeholder="Enter Mobile Number"
                                    >

                                    @error('mobile_no')

                                        <span class="carnate-form-error">
                                            {{ $message }}
                                        </span>

                                    @enderror

                                </div>


                                {{-- GST BILLING --}}

                                <div class="col-md-6">

                                    <label class="carnate-form-label">
                                        GST Billing
                                    </label>

                                    <select
                                        id="is_gst"
                                        class="carnate-form-select"
                                        wire:model="is_gst"
                                    >

                                        <option value="0">
                                            No
                                        </option>

                                        <option value="1">
                                            Yes
                                        </option>

                                    </select>

                                    @error('is_gst')

                                        <span class="carnate-form-error">
                                            {{ $message }}
                                        </span>

                                    @enderror

                                </div>


                                {{-- GST NUMBER --}}

                                <div
                                    class="col-md-6 carnate-gst-field"
                                    id="gst_number_div"
                                    style="{{ $is_gst == 1 ? 'display:block;' : 'display:none;' }}"
                                >

                                    <label class="carnate-form-label">
                                        GST Number
                                    </label>

                                    <input
                                        type="text"
                                        id="gst_no"
                                        wire:model="gst_no"
                                        class="carnate-form-control"
                                        placeholder="Enter GST Number"
                                        {{ $is_gst == 1 ? '' : 'disabled' }}
                                    >

                                    @error('gst_no')

                                        <span class="carnate-form-error">
                                            {{ $message }}
                                        </span>

                                    @enderror

                                </div>


                                {{-- BIRTH DATE --}}

                                <div class="col-md-6">

                                    <label class="carnate-form-label">
                                        Birth Date
                                    </label>

                                    <input
                                        type="date"
                                        wire:model="birth_date"
                                        class="carnate-form-control"
                                    >

                                    @error('birth_date')

                                        <span class="carnate-form-error">
                                            {{ $message }}
                                        </span>

                                    @enderror

                                </div>


                                {{-- LANDLINE --}}

                                <div class="col-md-6">

                                    <label class="carnate-form-label">
                                        Landline Number
                                    </label>

                                    <input
                                        type="text"
                                        wire:model="landline_no"
                                        class="carnate-form-control"
                                        placeholder="Enter Landline Number"
                                    >

                                    @error('landline_no')

                                        <span class="carnate-form-error">
                                            {{ $message }}
                                        </span>

                                    @enderror

                                </div>


                                {{-- COUNTRY --}}

                                <div class="col-md-6">

                                    <label class="carnate-form-label">

                                        Country

                                        <span class="carnate-required">*</span>

                                    </label>

                                    <select
                                        class="carnate-form-select searchable-select"
                                        data-placeholder="Select Country"
                                        wire:change="stateData($event.target.value)"
                                        wire:model="country_id"
                                    >

                                        <option value="">
                                            Select Country
                                        </option>

                                        @foreach ($countries as $country)

                                            <option value="{{ $country->id }}">
                                                {{ $country->name }}
                                            </option>

                                        @endforeach

                                    </select>

                                    @error('country_id')

                                        <span class="carnate-form-error">
                                            {{ $message }}
                                        </span>

                                    @enderror

                                </div>


                                {{-- STATE --}}

                                <div class="col-md-6">

                                    <label class="carnate-form-label">

                                        State

                                        <span class="carnate-required">*</span>

                                    </label>

                                    <select
                                        class="carnate-form-select searchable-select"
                                        data-placeholder="Select State"
                                        wire:model="state_id"
                                        wire:change="cityData($event.target.value)"
                                    >

                                        <option value="">
                                            Select State
                                        </option>

                                        @foreach ($states as $state)

                                            <option
                                                value="{{ $state->id }}"
                                                @selected($state->id == $state_id)
                                            >
                                                {{ $state->name }}
                                            </option>

                                        @endforeach

                                    </select>

                                    @error('state_id')

                                        <span class="carnate-form-error">
                                            {{ $message }}
                                        </span>

                                    @enderror

                                </div>


                                {{-- CITY --}}

                                <div class="col-md-6">

                                    <label class="carnate-form-label">

                                        City

                                        <span class="carnate-required">*</span>

                                    </label>

                                    <select
                                        class="carnate-form-select searchable-select"
                                        data-placeholder="Select City"
                                        wire:model="city_id"
                                    >

                                        <option value="">
                                            Select City
                                        </option>

                                        @foreach ($cities as $city)

                                            <option
                                                value="{{ $city->id }}"
                                                @selected($city->id == $city_id)
                                            >
                                                {{ $city->name }}
                                            </option>

                                        @endforeach

                                    </select>

                                    @error('city_id')

                                        <span class="carnate-form-error">
                                            {{ $message }}
                                        </span>

                                    @enderror

                                </div>


                                {{-- PINCODE --}}

                                <div class="col-md-6">

                                    <label
                                        class="carnate-form-label"
                                        for="pincode"
                                    >

                                        Pincode

                                        <span class="carnate-required">*</span>

                                    </label>

                                    <input
                                        type="number"
                                        id="pincode"
                                        class="carnate-form-control"
                                        wire:model="pincode"
                                        placeholder="Enter Pincode"
                                    >

                                    @error('pincode')

                                        <span class="carnate-form-error">
                                            {{ $message }}
                                        </span>

                                    @enderror

                                </div>


                                {{-- ADDRESS --}}

                                <div class="col-md-12">

                                    <label class="carnate-form-label">

                                        Address

                                        <span class="carnate-required">*</span>

                                    </label>

                                    <textarea
                                        wire:model="address"
                                        class="carnate-form-textarea"
                                        placeholder="Enter Address"
                                    ></textarea>

                                    @error('address')

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
                                wire:click="closeModel"
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
         PAGE HEADER
    ========================================================== --}}

    <div class="carnate-page-header">

        <div class="carnate-page-header-content">

            <div class="carnate-page-title-wrapper">

                <div class="carnate-page-title-icon">
                    <i class="bx bx-wrench"></i>
                </div>

                <div>

                    <h1 class="carnate-page-title">
                        Spare Part Vendor
                    </h1>

                    <p class="carnate-page-subtitle">
                        Manage spare part vendors, login access and online stock availability.
                    </p>

                </div>

            </div>


            @if (@$admin->hasPermissionTo('spare-part-vendor-add'))

                <a
                    href="javascript:;"
                    wire:click="create"
                    class="carnate-btn-primary"
                >

                    <i class="bx bx-plus"></i>

                    Add Vendor

                </a>

            @endif

        </div>

    </div>


    {{-- =========================================================
         SEARCH + BULK ACTIONS
    ========================================================== --}}

    <div class="carnate-filter-card">

        <div class="carnate-filter-row">

            <div class="carnate-search-wrapper">

                <i class="bx bx-search carnate-search-icon"></i>

                <input
                    type="text"
                    class="carnate-search-input"
                    placeholder="Search vendors..."
                    wire:model.live="searchfilter"
                >

            </div>


            <div class="carnate-filter-actions">

                @if(count($selectedVendors) > 0)

                    <div class="dropdown carnate-bulk-wrapper">

                        <button
                            class="carnate-bulk-btn dropdown-toggle"
                            type="button"
                            id="bulkActionsDropdown"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                        >

                            <i class="bx bx-layer"></i>

                            Bulk Actions

                            <span class="carnate-bulk-count">
                                {{ count($selectedVendors) }}
                            </span>

                        </button>


                        <ul
                            class="dropdown-menu dropdown-menu-end carnate-bulk-menu"
                            aria-labelledby="bulkActionsDropdown"
                        >

                            <li>

                                <a
                                    class="dropdown-item"
                                    href="javascript:void(0);"
                                    wire:click="bulkActivate"
                                >
                                    <i class="bx bx-log-in-circle me-2"></i>
                                    Activate Selected Login
                                </a>

                            </li>


                            <li>

                                <a
                                    class="dropdown-item"
                                    href="javascript:void(0);"
                                    wire:click="bulkDeactivate"
                                >
                                    <i class="bx bx-log-out-circle me-2"></i>
                                    Deactivate Selected Login
                                </a>

                            </li>


                            <li>
                                <hr class="dropdown-divider">
                            </li>


                            <li>

                                <a
                                    class="dropdown-item"
                                    href="javascript:void(0);"
                                    wire:click="bulkActivateOnlineStock"
                                >
                                    <i class="bx bx-check-circle me-2"></i>
                                    Activate Online Stock
                                </a>

                            </li>


                            <li>

                                <a
                                    class="dropdown-item"
                                    href="javascript:void(0);"
                                    wire:click="bulkDeactivateOnlineStock"
                                >
                                    <i class="bx bx-x-circle me-2"></i>
                                    Deactivate Online Stock
                                </a>

                            </li>

                        </ul>

                    </div>

                @endif


                <button
                    type="button"
                    class="carnate-clear-btn"
                    wire:click="resetFilter"
                >

                    <i class="bx bx-reset me-1"></i>

                    Clear

                </button>

            </div>

        </div>

    </div>


    {{-- =========================================================
         VENDOR TABLE
    ========================================================== --}}

    <div class="carnate-table-card">

        @if (!empty($vendors) && $vendors->count())

            <div class="carnate-table-header">

                <h2 class="carnate-table-heading">
                    Vendor Accounts
                </h2>

                <span class="carnate-table-count">

                    {{ $vendors->total() }}

                    {{ $vendors->total() == 1 ? 'vendor' : 'vendors' }}

                </span>

            </div>


            <div class="carnate-table-wrapper">

                <table class="carnate-table">

                    <thead>

                        <tr>

                            <th>

                                <input
                                    type="checkbox"
                                    class="form-check-input carnate-checkbox"
                                    wire:model.live="selectAll"
                                >

                            </th>

                            <th>
                                S.No.
                            </th>

                            <th>
                                Vendor
                            </th>

                            <th>
                                Email
                            </th>

                            <th>
                                Mobile
                            </th>

                            <th>
                                Role
                            </th>

                            <th>
                                City
                            </th>

                            <th>
                                Login Status
                            </th>

                            <th>
                                Online Stock
                            </th>

                            @if (
                                @$admin->hasPermissionTo('spare-part-vendor-edit') ||
                                @$admin->hasPermissionTo('spare-part-vendor-delete')
                            )

                                <th>
                                    Actions
                                </th>

                            @endif

                        </tr>

                    </thead>


                    <tbody>

                        @foreach ($vendors as $index => $vendor)

                            @php
                                $fullName = trim($vendor->name . ' ' . $vendor->lastname);

                                $initials = collect(explode(' ', $fullName))
                                    ->filter()
                                    ->map(fn($word) => strtoupper(substr($word, 0, 1)))
                                    ->take(2)
                                    ->implode('');
                            @endphp


                            <tr>


                                {{-- CHECKBOX --}}

                                <td>

                                    <input
                                        type="checkbox"
                                        class="form-check-input carnate-checkbox"
                                        value="{{ $vendor->id }}"
                                        wire:model.live="selectedVendors"
                                    >

                                </td>


                                {{-- SERIAL --}}

                                <td>

                                    <span class="carnate-sno">

                                        {{ $vendors->total() - ($vendors->firstItem() + $index) + 1 }}

                                    </span>

                                </td>


                                {{-- VENDOR --}}

                                <td>

                                    <div class="carnate-vendor-cell">

                                        <div class="carnate-vendor-avatar">

                                            {{ $initials ?: 'V' }}

                                        </div>

                                        <span class="carnate-vendor-name">

                                            {{ $fullName }}

                                        </span>

                                    </div>

                                </td>


                                {{-- EMAIL --}}

                                <td>

                                    <span class="carnate-email">

                                        {{ $vendor->email }}

                                    </span>

                                </td>


                                {{-- MOBILE --}}

                                <td>

                                    <span class="carnate-mobile">

                                        {{ $vendor->mobile_no }}

                                    </span>

                                </td>


                                {{-- ROLE --}}

                                <td>

                                    <span class="carnate-role">

                                        <i class="bx bx-shield-quarter me-1"></i>

                                        {{ $vendor->getRoleNames()->implode(', ') }}

                                    </span>

                                </td>


                                {{-- CITY --}}

                                <td>

                                    <span class="carnate-city">

                                        {{ $vendor->cityName ? $vendor->cityName->name : 'NA' }}

                                    </span>

                                </td>


                                {{-- LOGIN STATUS --}}

                                <td>

                                    <div class="carnate-status-wrapper">

                                        <div class="form-check form-switch">

                                            <input
                                                class="form-check-input carnate-switch"
                                                type="checkbox"
                                                id="status_{{ $vendor->id }}"
                                                wire:change="changeStatus({{ $vendor->id }})"
                                                {{ $vendor->status ? 'checked' : '' }}
                                                @if (!@$admin->hasPermissionTo('spare-part-vendor-edit')) disabled @endif
                                            >

                                        </div>

                                        <span class="carnate-status-label">

                                            {{ $vendor->status ? 'Active' : 'Inactive' }}

                                        </span>

                                    </div>

                                </td>


                                {{-- ONLINE STOCK --}}

                                <td>

                                    <div class="carnate-status-wrapper">

                                        <div class="form-check form-switch">

                                            <input
                                                class="form-check-input carnate-switch"
                                                type="checkbox"
                                                id="online_status_{{ $vendor->id }}"
                                                wire:change="changeOnlineStockStatus({{ $vendor->id }})"
                                                {{ $vendor->online_stock_status ? 'checked' : '' }}
                                                @if (!@$admin->hasPermissionTo('spare-part-vendor-edit')) disabled @endif
                                            >

                                        </div>

                                        <span class="carnate-status-label">

                                            {{ $vendor->online_stock_status ? 'Enabled' : 'Disabled' }}

                                        </span>

                                    </div>

                                </td>


                                {{-- ACTIONS --}}

                                @if (
                                    @$admin->hasPermissionTo('spare-part-vendor-edit') ||
                                    @$admin->hasPermissionTo('spare-part-vendor-delete')
                                )

                                    <td>

                                        <div class="carnate-actions">


                                            @if (@$admin->hasPermissionTo('spare-part-vendor-edit'))

                                                <button
                                                    type="button"
                                                    class="carnate-action-btn"
                                                    wire:click="edit({{ $vendor->id }})"
                                                    title="Edit Vendor"
                                                >

                                                    <i class="bx bx-edit"></i>

                                                </button>

                                            @endif


                                            @if (@$admin->hasPermissionTo('spare-part-vendor-delete'))

                                                <button
                                                    type="button"
                                                    class="carnate-action-btn delete"
                                                    wire:click="confirmDelete({{ $vendor->id }})"
                                                    title="Delete Vendor"
                                                >

                                                    <i class="bx bx-trash"></i>

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


            {{-- PAGINATION --}}

            <div class="carnate-pagination">

                {{ $vendors->links() }}

            </div>

        @else

            {{-- EMPTY STATE --}}

            <div class="carnate-empty-state">

                <div class="carnate-empty-icon">

                    <i class="bx bx-store-alt"></i>

                </div>

                <h3 class="carnate-empty-title">

                    No Vendors Found

                </h3>

                <p class="carnate-empty-text">

                    No spare part vendors are available.

                </p>

            </div>

        @endif

    </div>

</div>


@section('footerscript')

    {{-- =========================================================
         GST TOGGLE
    ========================================================== --}}

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            function toggleGstField() {

                const isGstSelect = document.getElementById('is_gst');
                const gstDiv = document.getElementById('gst_number_div');
                const gstInput = document.getElementById('gst_no');

                if (!isGstSelect || !gstDiv || !gstInput) {
                    return;
                }

                const isGst = isGstSelect.value;

                if (isGst === '1') {

                    gstDiv.style.display = 'block';

                    gstInput.disabled = false;

                } else {

                    gstDiv.style.display = 'none';

                    gstInput.disabled = true;

                    gstInput.value = '';

                }

            }


            toggleGstField();


            const isGstSelect = document.getElementById('is_gst');

            if (isGstSelect) {

                isGstSelect.addEventListener('change', function () {

                    toggleGstField();

                });

            }

        });

    </script>


    {{-- =========================================================
         PASSWORD SHOW / HIDE
    ========================================================== --}}

    <script>

        function togglePassword() {

            const passwordInput =
                document.getElementById('inputChoosePassword');

            const passwordIcon =
                document.getElementById('password-icon');


            if (!passwordInput || !passwordIcon) {
                return;
            }


            if (passwordInput.type === 'password') {

                passwordInput.type = 'text';

                passwordIcon.classList.remove('bx-hide');

                passwordIcon.classList.add('bx-show');

            } else {

                passwordInput.type = 'password';

                passwordIcon.classList.remove('bx-show');

                passwordIcon.classList.add('bx-hide');

            }

        }

    </script>

@endsection