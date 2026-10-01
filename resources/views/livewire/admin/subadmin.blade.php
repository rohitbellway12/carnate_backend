<div class="carnate-subadmin-page">

    @php
        $admin = App\Models\Admin::where('id', $adminId)->first();
    @endphp


    {{-- =========================================================
         CARNATE SUB ADMIN STYLES
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

            --carnate-success: #16a34a;
            --carnate-success-bg: #f0fdf4;

            --carnate-danger: #dc2626;
            --carnate-danger-bg: #fef2f2;

            --carnate-radius: 14px;
        }


        /* =====================================================
           PAGE
        ====================================================== */

        .carnate-subadmin-page {
            color: var(--carnate-text);
        }


        /* =====================================================
           ALERT
        ====================================================== */

        .carnate-subadmin-page .alert {
            border-radius: 10px !important;
            border: 1px solid transparent !important;
            font-size: 13px;
        }

        .carnate-success-alert {
            background: var(--carnate-success-bg) !important;
            border-color: #bbf7d0 !important;
            color: #166534 !important;
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

            font-size: 19px;
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
           BUTTONS
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

            gap: 12px;
        }

        .carnate-search-wrapper {
            position: relative;

            max-width: 360px;

            width: 100%;
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

            color: var(--carnate-text) !important;

            border-color: #cbd5e1 !important;
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
            padding: 18px 20px;

            border-bottom: 1px solid var(--carnate-border);

            display: flex;
            align-items: center;
            justify-content: space-between;
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

            margin: 0 !important;

            border-collapse: separate !important;

            border-spacing: 0 !important;

            min-width: 850px;
        }

        .carnate-table thead th {
            padding: 13px 18px !important;

            background: #f8fafc !important;

            border-bottom: 1px solid var(--carnate-border) !important;

            border-top: none !important;

            color: #94a3b8 !important;

            font-size: 10px !important;

            font-weight: 700 !important;

            letter-spacing: 0.08em !important;

            text-transform: uppercase !important;

            white-space: nowrap;
        }

        .carnate-table tbody td {
            padding: 14px 18px !important;

            border-bottom: 1px solid #edf1f5 !important;

            border-top: none !important;

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

            font-size: 12px !important;

            font-weight: 600 !important;
        }


        /* =====================================================
           USER CELL
        ====================================================== */

        .carnate-user-cell {
            display: flex;

            align-items: center;

            gap: 10px;
        }

        .carnate-user-avatar {
            width: 34px;
            height: 34px;

            min-width: 34px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 9px;

            background: var(--carnate-red-light);

            color: var(--carnate-red);

            font-size: 12px;

            font-weight: 700;

            text-transform: uppercase;
        }

        .carnate-user-name {
            color: var(--carnate-text) !important;

            font-weight: 600 !important;
        }


        /* =====================================================
           ROLE BADGE
        ====================================================== */

        .carnate-role-badge {
            display: inline-flex;

            align-items: center;

            min-height: 27px;

            padding: 5px 9px;

            border-radius: 7px;

            background: #f1f5f9;

            color: #475569;

            font-size: 11px;

            font-weight: 600;
        }


        /* =====================================================
           EMAIL
        ====================================================== */

        .carnate-email {
            color: #475569 !important;
        }


        /* =====================================================
           MOBILE / PHONE
        ====================================================== */

        .carnate-mobile {
            color: #475569 !important;

            font-variant-numeric: tabular-nums;
        }


        /* =====================================================
           CITY
        ====================================================== */

        .carnate-city {
            color: #475569 !important;
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

            border-radius: 8px;

            border: 1px solid var(--carnate-border) !important;

            background: #ffffff !important;

            color: #64748b !important;

            cursor: pointer;

            transition: all 0.18s ease;
        }

        .carnate-action-btn:hover {
            background: var(--carnate-red-light) !important;

            border-color: rgba(229, 57, 53, 0.2) !important;

            color: var(--carnate-red) !important;
        }

        .carnate-action-btn.delete:hover {
            background: var(--carnate-danger-bg) !important;

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
            padding: 55px 20px;

            text-align: center;
        }

        .carnate-empty-icon {
            width: 52px;
            height: 52px;

            display: flex;
            align-items: center;
            justify-content: center;

            margin: 0 auto 13px;

            border-radius: 13px;

            background: #f8fafc;

            color: #94a3b8;

            font-size: 23px;
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
           MODAL
        ====================================================== */

        .carnate-modal {
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

        .carnate-modal-dialog {
            width: 100%;

            max-width: 820px;

            max-height: calc(100vh - 40px);

            margin: 0 auto;

            display: flex;

            flex-direction: column;
        }

        .carnate-modal-content {
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

        .carnate-modal-heading-wrapper {
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
            margin: 2px 0 0;

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

            transition:
                border-color 0.18s ease,
                box-shadow 0.18s ease;
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
            min-height: 92px;

            resize: vertical;
        }


        /* =====================================================
           TITLE + FIRST NAME GROUP
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
           VALIDATION
        ====================================================== */

        .carnate-error {
            display: block;

            margin-top: 5px;

            color: var(--carnate-danger) !important;

            font-size: 11px !important;

            line-height: 1.4;
        }

        .carnate-error-summary {
            margin-top: 15px;

            padding: 12px 14px;

            border: 1px solid #fecaca;

            border-radius: 9px;

            background: #fef2f2;

            color: #991b1b;

            font-size: 12px;
        }

        .carnate-error-summary ul {
            margin: 0;

            padding-left: 18px;
        }


        /* =====================================================
           MODAL FOOTER
        ====================================================== */

        .carnate-modal-footer {
            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 12px;

            padding: 16px 22px;

            border-top: 1px solid var(--carnate-border);

            background: #ffffff;
        }

        .carnate-modal-footer-actions {
            display: flex;

            align-items: center;

            gap: 8px;

            margin-left: auto;
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

            color: #111827;

            border-color: #cbd5e1;
        }

        .carnate-processing {
            color: var(--carnate-secondary);

            font-size: 11px;
        }


        /* =====================================================
           RESPONSIVE
        ====================================================== */

        @media (max-width: 767px) {

            .carnate-page-header-content {
                align-items: flex-start;

                flex-direction: column;
            }

            .carnate-btn-primary {
                width: 100%;
            }

            .carnate-filter-row {
                flex-direction: column;

                align-items: stretch;
            }

            .carnate-search-wrapper {
                max-width: none;
            }

            .carnate-clear-btn {
                width: 100%;
            }

            .carnate-modal {
                padding: 10px;
            }

            .carnate-modal-dialog {
                max-height: calc(100vh - 20px);
            }

            .carnate-modal-header,
            .carnate-modal-body,
            .carnate-modal-footer {
                padding-left: 16px;
                padding-right: 16px;
            }

            .carnate-modal-footer {
                align-items: stretch;

                flex-direction: column;
            }

            .carnate-modal-footer-actions {
                width: 100%;

                margin-left: 0;
            }

            .carnate-modal-footer-actions button {
                flex: 1;
            }
        }


        @media (max-width: 575px) {

            .carnate-page-header {
                padding: 16px !important;
            }

            .carnate-page-title {
                font-size: 17px;
            }

            .carnate-filter-card {
                padding: 14px !important;
            }

            .carnate-modal-body {
                padding: 16px;
            }

            .carnate-title-select {
                width: 72px;

                min-width: 72px;
            }
        }
    </style>



    {{-- =========================================================
         SUCCESS MESSAGE
    ========================================================== --}}

    @if (session()->has('message'))

        <div class="alert carnate-success-alert mb-3">
            <i class="bx bx-check-circle me-1"></i>
            {{ session('message') }}
        </div>

    @endif



    {{-- =========================================================
         ADD / EDIT MODAL
    ========================================================== --}}

    @if ($showModal)

        <div
            class="carnate-modal"
            role="dialog"
            aria-modal="true"
            wire:key="sub-admin-modal"
        >

            <div class="carnate-modal-dialog">

                <div class="carnate-modal-content">

                    <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">

                        @csrf


                        {{-- MODAL HEADER --}}

                        <div class="carnate-modal-header">

                            <div class="carnate-modal-heading-wrapper">

                                <div class="carnate-modal-icon">
                                    <i class="bx {{ $isEdit ? 'bx-edit' : 'bx-user-plus' }}"></i>
                                </div>

                                <div>

                                    <h4 class="carnate-modal-title">
                                        {{ $isEdit ? 'Edit Sub Admin' : 'Create Sub Admin' }}
                                    </h4>

                                    <div class="carnate-modal-subtitle">
                                        {{ $isEdit ? 'Update sub admin account information.' : 'Add a new administrator account.' }}
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

                                    <div class="carnate-form-group">

                                        <label for="first_name" class="carnate-form-label">
                                            First Name
                                            <span class="carnate-required">*</span>
                                        </label>


                                        <div class="carnate-name-group">

                                            <select
                                                name="user_title"
                                                id="user_title"
                                                wire:model.live="user_title"
                                                class="carnate-form-select carnate-title-select"
                                            >
                                                <option value="">Select</option>
                                                <option value="mr">Mr.</option>
                                                <option value="mrs">Mrs.</option>
                                                <option value="miss">Miss</option>
                                                <option value="ms">M.S.</option>
                                            </select>


                                            <input
                                                type="text"
                                                wire:model.live.debounce.300ms="name"
                                                name="first_name"
                                                id="first_name"
                                                class="carnate-form-control carnate-first-name"
                                                placeholder="Enter First Name"
                                            >

                                        </div>


                                        @error('user_title')
                                            <span class="carnate-error">{{ $message }}</span>
                                        @enderror

                                        @error('name')
                                            <span class="carnate-error">{{ $message }}</span>
                                        @enderror

                                    </div>

                                </div>



                                {{-- LAST NAME --}}

                                <div class="col-md-6">

                                    <div class="carnate-form-group">

                                        <label class="carnate-form-label">
                                            Last Name
                                            <span class="carnate-required">*</span>
                                        </label>

                                        <input
                                            type="text"
                                            wire:model.live.debounce.300ms="lastname"
                                            class="carnate-form-control"
                                            placeholder="Enter Last Name"
                                        >

                                    </div>

                                    @error('lastname')
                                        <span class="carnate-error">{{ $message }}</span>
                                    @enderror

                                </div>



                                {{-- ADMIN TYPE --}}

                                <div class="col-md-6">

                                    <div class="carnate-form-group">

                                        <label class="carnate-form-label">
                                            Admin Type
                                            <span class="carnate-required">*</span>
                                        </label>

                                        <select
                                            class="carnate-form-select"
                                            wire:model="role"
                                        >

                                            <option value="">
                                                Select admin Type
                                            </option>

                                            @foreach($roles as $role)

                                                <option value="{{ $role->id }}">
                                                    {{ $role->name }}
                                                </option>

                                            @endforeach

                                        </select>

                                    </div>

                                    @error('role')
                                        <span class="carnate-error">{{ $message }}</span>
                                    @enderror

                                </div>



                                {{-- EMAIL --}}

                                <div class="col-md-6">

                                    <div class="carnate-form-group">

                                        <label class="carnate-form-label">
                                            Email
                                            <span class="carnate-required">*</span>
                                        </label>

                                        <input
                                            type="email"
                                            wire:model.live.debounce.300ms="email"
                                            class="carnate-form-control"
                                            placeholder="Enter Email"
                                        >

                                    </div>

                                    @error('email')
                                        <span class="carnate-error">{{ $message }}</span>
                                    @enderror

                                </div>



                                {{-- PASSWORD --}}

                                @if($isEdit == false)

                                    <div class="col-md-6">

                                        <div class="carnate-form-group">

                                            <label class="carnate-form-label">
                                                Password
                                                <span class="carnate-required">*</span>
                                            </label>

                                            <input
                                                type="password"
                                                wire:model.live.debounce.300ms="password"
                                                class="carnate-form-control"
                                                placeholder="Enter Password"
                                            >

                                        </div>

                                        @error('password')
                                            <span class="carnate-error">{{ $message }}</span>
                                        @enderror

                                    </div>

                                @endif



                                {{-- MOBILE --}}

                                <div class="col-md-6">

                                    <div class="carnate-form-group">

                                        <label class="carnate-form-label">
                                            Mobile Number
                                            <span class="carnate-required">*</span>
                                        </label>

                                        <input
                                            type="text"
                                            wire:model.live.debounce.300ms="mobile_no"
                                            class="carnate-form-control"
                                            placeholder="Enter Mobile Number"
                                        >

                                    </div>

                                    @error('mobile_no')
                                        <span class="carnate-error">{{ $message }}</span>
                                    @enderror

                                </div>



                                {{-- BIRTH DATE --}}

                                <div class="col-md-6">

                                    <div class="carnate-form-group">

                                        <label class="carnate-form-label">
                                            Birth Date
                                        </label>

                                        <input
                                            type="date"
                                            wire:model.live="birth_date"
                                            class="carnate-form-control"
                                        >

                                    </div>

                                    @error('birth_date')
                                        <span class="carnate-error">{{ $message }}</span>
                                    @enderror

                                </div>



                                {{-- COUNTRY --}}

                                <div class="col-md-6">

                                    <div class="carnate-form-group">

                                        <label class="carnate-form-label">
                                            Country
                                            <span class="carnate-required">*</span>
                                        </label>

                                        <select
                                            class="carnate-form-select"
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

                                    </div>

                                    @error('country_id')
                                        <span class="carnate-error">{{ $message }}</span>
                                    @enderror

                                </div>



                                {{-- STATE --}}

                                <div class="col-md-6">

                                    <div class="carnate-form-group">

                                        <label class="carnate-form-label">
                                            State
                                            <span class="carnate-required">*</span>
                                        </label>

                                        <select
                                            class="carnate-form-select"
                                            wire:model="state_id"
                                            wire:change="cityData($event.target.value)"
                                        >

                                            <option value="">
                                                Select State
                                            </option>

                                            @foreach ($states as $state)

                                                <option value="{{ $state->id }}">
                                                    {{ $state->name }}
                                                </option>

                                            @endforeach

                                        </select>

                                    </div>

                                    @error('state_id')
                                        <span class="carnate-error">{{ $message }}</span>
                                    @enderror

                                </div>



                                {{-- CITY --}}

                                <div class="col-md-6">

                                    <div class="carnate-form-group">

                                        <label class="carnate-form-label">
                                            City
                                            <span class="carnate-required">*</span>
                                        </label>

                                        <select
                                            class="carnate-form-select"
                                            wire:model="city_id"
                                        >

                                            <option value="">
                                                Select City
                                            </option>

                                            @foreach ($cities as $city)

                                                <option value="{{ $city->id }}">
                                                    {{ $city->name }}
                                                </option>

                                            @endforeach

                                        </select>

                                    </div>

                                    @error('city_id')
                                        <span class="carnate-error">{{ $message }}</span>
                                    @enderror

                                </div>



                                {{-- PINCODE --}}

                                <div class="col-md-6">

                                    <div class="carnate-form-group">

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
                                            wire:model.live.debounce.300ms="pincode"
                                            placeholder="Enter Pincode"
                                        >

                                    </div>

                                    @error('pincode')
                                        <span class="carnate-error">{{ $message }}</span>
                                    @enderror

                                </div>



                                {{-- ADDRESS --}}

                                <div class="col-md-12">

                                    <div class="carnate-form-group">

                                        <label class="carnate-form-label">
                                            Address
                                            <span class="carnate-required">*</span>
                                        </label>

                                        <textarea
                                            wire:model="address"
                                            class="carnate-form-textarea"
                                            placeholder="Enter Address"
                                        ></textarea>

                                    </div>

                                    @error('address')
                                        <span class="carnate-error">{{ $message }}</span>
                                    @enderror

                                </div>

                            </div>


                            {{-- ERROR SUMMARY --}}

                            @if ($errors->any())

                                <div class="carnate-error-summary">

                                    <strong>Please check the following:</strong>

                                    <ul>

                                        @foreach ($errors->all() as $error)

                                            <li>{{ $error }}</li>

                                        @endforeach

                                    </ul>

                                </div>

                            @endif

                        </div>



                        {{-- MODAL FOOTER --}}

                        <div class="carnate-modal-footer">

                            <div>

                                <span
                                    class="carnate-processing"
                                    wire:loading
                                >
                                    <i class="bx bx-loader-alt bx-spin me-1"></i>
                                    Processing...
                                </span>

                            </div>


                            <div class="carnate-modal-footer-actions">

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
                    <i class="fas fa-user-shield"></i>
                </div>

                <div>

                    <h1 class="carnate-page-title">
                        Sub Admin
                    </h1>

                    <p class="carnate-page-subtitle">
                        Manage administrator accounts and access.
                    </p>

                </div>

            </div>


            @if (@$admin->hasPermissionTo('sub-admin-add'))

                <a
                    href="javascript:;"
                    wire:click="create"
                    class="carnate-btn-primary"
                >
                    <i class="bx bx-plus"></i>
                    Add Sub Admin
                </a>

            @endif

        </div>

    </div>



    {{-- =========================================================
         SEARCH / FILTER
    ========================================================== --}}

    <div class="carnate-filter-card">

        <div class="carnate-filter-row">

            <div class="carnate-search-wrapper">

                <i class="bx bx-search carnate-search-icon"></i>

                <input
                    type="text"
                    class="carnate-search-input"
                    wire:model.live.debounce.300ms="searchfilter"
                    placeholder="Search sub admins..."
                >

            </div>


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



    {{-- =========================================================
         SUB ADMIN TABLE
    ========================================================== --}}

    <div class="carnate-table-card">

        @if (!empty($items) && $items->count())

            <div class="carnate-table-header">

                <h2 class="carnate-table-heading">
                    Sub Admin Accounts
                </h2>

                <span class="carnate-table-count">
                    {{ $items->total() }} {{ $items->total() == 1 ? 'account' : 'accounts' }}
                </span>

            </div>


            <div class="carnate-table-wrapper">

                <table class="carnate-table">

                    <thead>

                        <tr>

                            <th>
                                S.No.
                            </th>

                            <th>
                                Name
                            </th>

                            <th>
                                Role
                            </th>

                            <th>
                                Email
                            </th>

                            <th>
                                Mobile Number
                            </th>

                            <th>
                                City
                            </th>

                            @if (
                                @$admin->hasPermissionTo('sub-admin-edit') ||
                                @$admin->hasPermissionTo('sub-admin-delete')
                            )

                                <th>
                                    Actions
                                </th>

                            @endif

                        </tr>

                    </thead>


                    <tbody>

                        @foreach ($items as $index => $item)

                            @php
                                $fullName = trim($item->name . ' ' . $item->lastname);
                                $initials = collect(explode(' ', $fullName))
                                    ->filter()
                                    ->map(fn($word) => strtoupper(substr($word, 0, 1)))
                                    ->take(2)
                                    ->implode('');
                            @endphp

                            <tr>

                                {{-- S.NO. --}}

                                <td>

                                    <span class="carnate-sno">
                                        {{ $items->total() - ($items->firstItem() + $index) + 1 }}
                                    </span>

                                </td>


                                {{-- NAME --}}

                                <td>

                                    <div class="carnate-user-cell">

                                        <div class="carnate-user-avatar">
                                            {{ $initials ?: 'U' }}
                                        </div>

                                        <span class="carnate-user-name">
                                            {{ $fullName }}
                                        </span>

                                    </div>

                                </td>


                                {{-- ROLE --}}

                                <td>

                                    <span class="carnate-role-badge">

                                        <i class="bx bx-shield-quarter me-1"></i>

                                        {{ $item->getRoleNames()->implode(', ') }}

                                    </span>

                                </td>


                                {{-- EMAIL --}}

                                <td>

                                    <span class="carnate-email">
                                        {{ $item->email }}
                                    </span>

                                </td>


                                {{-- MOBILE --}}

                                <td>

                                    <span class="carnate-mobile">
                                        {{ $item->mobile_no }}
                                    </span>

                                </td>


                                {{-- CITY --}}

                                <td>

                                    <span class="carnate-city">

                                        {{ $item->cityName ? $item->cityName->name : 'NA' }}

                                    </span>

                                </td>


                                {{-- ACTIONS --}}

                                @if (
                                    @$admin->hasPermissionTo('sub-admin-edit') ||
                                    @$admin->hasPermissionTo('sub-admin-delete')
                                )

                                    <td>

                                        <div class="carnate-actions">


                                            @if (@$admin->hasPermissionTo('sub-admin-edit'))

                                                <button
                                                    type="button"
                                                    wire:click="edit({{ $item->id }})"
                                                    class="carnate-action-btn"
                                                    title="Edit"
                                                >

                                                    <i class="bx bx-edit"></i>

                                                </button>

                                            @endif


                                            @if (@$admin->hasPermissionTo('sub-admin-delete'))

                                                <button
                                                    type="button"
                                                    wire:click="confirmDelete({{ $item->id }})"
                                                    class="carnate-action-btn delete"
                                                    title="Delete"
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

                {{ $items->links() }}

            </div>

        @else

            {{-- EMPTY STATE --}}

            <div class="carnate-empty-state">

                <div class="carnate-empty-icon">
                    <i class="bx bx-user-x"></i>
                </div>

                <h3 class="carnate-empty-title">
                    No Sub Admin Found
                </h3>

                <p class="carnate-empty-text">
                    No administrator accounts match your current search.
                </p>

            </div>

        @endif

    </div>

</div>



@section('footerscript')

<script>

    document.addEventListener('livewire:init', function () {

        Livewire.hook('morphed', (message, component) => {

            $('.select2')
                .select2()
                .on('change', function(e) {

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