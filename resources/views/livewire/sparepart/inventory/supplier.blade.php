<div class="supplier-page">

    <style>
        /* =========================================================
           CARNATE SUPPLIER PAGE
        ========================================================= */

        .supplier-page {
            --supplier-red: #e53935;
            --supplier-red-dark: #c62828;
            --supplier-red-soft: #fff5f5;

            --supplier-text: #111827;
            --supplier-text-2: #334155;
            --supplier-muted: #64748b;

            --supplier-border: #e2e8f0;
            --supplier-border-light: #eef2f7;

            --supplier-bg: #f8fafc;
        }

        .supplier-page *,
        .supplier-page *::before,
        .supplier-page *::after {
            box-sizing: border-box;
        }

        /* =========================================================
           CARDS
        ========================================================= */

        .supplier-page .card {
            border: 1px solid var(--supplier-border) !important;
            border-radius: 14px !important;
            background: #fff !important;
            box-shadow: 0 2px 10px rgba(15, 23, 42, .035) !important;
            overflow: hidden;
        }

        /* =========================================================
           PAGE HEADER
        ========================================================= */

        .supplier-page .supplier-page-header {
            margin-bottom: 18px;
        }

        .supplier-page .supplier-page-header .card-body {
            min-height: 76px;
            padding: 17px 22px;
        }

        .supplier-page .supplier-heading {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .supplier-page .supplier-heading-icon {
            width: 42px;
            height: 42px;
            min-width: 42px;

            display: flex;
            align-items: center;
            justify-content: center;

            color: var(--supplier-red);
            background: var(--supplier-red-soft);

            border-radius: 10px;

            font-size: 20px;
        }

        .supplier-page .breadcrumb-title {
            margin: 0 !important;
            padding: 0 !important;

            color: var(--supplier-text) !important;

            font-size: 20px !important;
            font-weight: 700 !important;

            line-height: 1.2;
            letter-spacing: -.025em;
        }

        .supplier-page .supplier-heading-subtitle {
            margin-top: 4px;

            color: var(--supplier-muted);

            font-size: 12px;
            line-height: 1.3;
        }

        /* =========================================================
           PRIMARY BUTTON
        ========================================================= */

        .supplier-page .btn-primary {
            min-height: 40px;

            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;

            padding: 0 15px !important;

            color: #fff !important;
            background: var(--supplier-red) !important;

            border: 1px solid var(--supplier-red) !important;
            border-radius: 9px !important;

            font-size: 13px;
            font-weight: 600;

            box-shadow: none !important;

            transition: all .18s ease;
        }

        .supplier-page .btn-primary:hover,
        .supplier-page .btn-primary:focus {
            color: #fff !important;
            background: var(--supplier-red-dark) !important;
            border-color: var(--supplier-red-dark) !important;

            transform: translateY(-1px);
        }

        .supplier-page .btn-primary i {
            font-size: 17px;
        }

        /* =========================================================
           FILTER CARD
        ========================================================= */

        .supplier-page .supplier-filter-card {
            margin-bottom: 18px;
        }

        .supplier-page .supplier-filter-card .card-body {
            padding: 16px 20px;
        }

        .supplier-page .supplier-search {
            position: relative;

            width: 100%;
            max-width: 560px;
        }

        .supplier-page .supplier-search-icon {
            position: absolute;

            top: 50%;
            left: 13px;

            color: #94a3b8;

            font-size: 17px;

            transform: translateY(-50%);

            pointer-events: none;

            z-index: 2;
        }

        .supplier-page .supplier-search .form-control {
            padding-left: 40px !important;
        }

        .supplier-page .form-control {
            min-height: 42px;

            padding: 8px 12px;

            color: var(--supplier-text) !important;

            background: #fff !important;

            border: 1px solid var(--supplier-border) !important;
            border-radius: 9px !important;

            font-size: 13px;

            box-shadow: none !important;

            transition: border-color .18s ease, box-shadow .18s ease;
        }

        .supplier-page .form-control::placeholder {
            color: #94a3b8;
        }

        .supplier-page .form-control:focus {
            border-color: rgba(229, 57, 53, .45) !important;

            box-shadow:
                0 0 0 .2rem rgba(229, 57, 53, .08) !important;

            outline: none !important;
        }

        /* =========================================================
           CLEAR BUTTON
        ========================================================= */

        .supplier-page .supplier-clear-btn {
            min-height: 42px;

            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;

            padding: 0 15px !important;

            color: var(--supplier-muted) !important;

            background: #fff !important;

            border: 1px solid var(--supplier-border) !important;
            border-radius: 9px !important;

            font-size: 13px;
            font-weight: 600;

            box-shadow: none !important;

            transition: all .18s ease;
        }

        .supplier-page .supplier-clear-btn:hover {
            color: var(--supplier-red) !important;

            border-color: #fecaca !important;

            background: var(--supplier-red-soft) !important;
        }

        /* =========================================================
           TABLE CARD
        ========================================================= */

        .supplier-page .supplier-table-card {
            margin-bottom: 0;
        }

        .supplier-page .supplier-table-card .card-body {
            padding: 0 !important;
        }

        .supplier-page .supplier-table {
            width: 100%;

            margin: 0 !important;

            color: var(--supplier-text-2);

            font-size: 13px;

            border-collapse: separate;
            border-spacing: 0;
        }

        /* =========================================================
           TABLE HEADER
        ========================================================= */

        .supplier-page .supplier-data-table thead th {
            padding: 13px 16px !important;

            color: #475569 !important;

            background: #f8fafc !important;

            border-top: 0 !important;
            border-bottom: 1px solid var(--supplier-border) !important;

            font-size: 10.5px !important;
            font-weight: 700 !important;

            letter-spacing: .055em !important;

            text-transform: uppercase !important;

            white-space: nowrap;

            vertical-align: middle;
        }

        /* =========================================================
           TABLE BODY
        ========================================================= */

        .supplier-page .supplier-data-table tbody td {
            padding: 14px 16px !important;

            color: var(--supplier-text-2);

            background: #fff;

            border-top: 0 !important;
            border-bottom: 1px solid var(--supplier-border-light) !important;

            vertical-align: middle;
        }

        .supplier-page .supplier-data-table tbody tr {
            transition: background .15s ease;
        }

        .supplier-page .supplier-data-table tbody tr:hover td {
            background: #fffafa !important;
        }

        .supplier-page .supplier-data-table tbody tr:last-child td {
            border-bottom: 0 !important;
        }

        /* =========================================================
           SERIAL
        ========================================================= */

        .supplier-page .serial-number {
            color: #94a3b8;

            font-size: 12px;
            font-weight: 600;
        }

        /* =========================================================
           COMPANY / SUPPLIER
        ========================================================= */

        .supplier-page .company-name {
            color: var(--supplier-text);

            font-size: 13px;
            font-weight: 650;
        }

        .supplier-page .supplier-name {
            color: #475569;

            font-size: 13px;
            font-weight: 500;
        }

        /* =========================================================
           CONTACT / EMAIL
        ========================================================= */

        .supplier-page .contact-value {
            color: #475569;

            white-space: nowrap;
        }

        .supplier-page .email-value {
            color: #64748b;
        }

        /* =========================================================
           ADDRESS
        ========================================================= */

        .supplier-page .address-value {
            display: block;

            max-width: 250px;

            color: #64748b;

            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* =========================================================
           GST
        ========================================================= */

        .supplier-page .gst-value {
            display: inline-flex;
            align-items: center;

            padding: 5px 8px;

            color: #475569;

            background: #f8fafc;

            border: 1px solid var(--supplier-border);

            border-radius: 7px;

            font-size: 11px;
            font-weight: 600;
        }

        .supplier-page .empty-value {
            color: #94a3b8;
        }

        /* =========================================================
           ACTIONS
        ========================================================= */

        .supplier-page .supplier-actions {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .supplier-page .supplier-action-button {
            width: 33px;
            height: 33px;
            min-width: 33px;

            padding: 0 !important;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            color: #64748b !important;

            background: transparent !important;

            border: 0 !important;
            border-radius: 8px !important;

            font-size: 17px;

            cursor: pointer;

            transition: all .18s ease;
        }

        .supplier-page .supplier-action-button.edit:hover {
            color: var(--supplier-red) !important;
            background: var(--supplier-red-soft) !important;
        }

        .supplier-page .supplier-action-button.delete:hover {
            color: #dc2626 !important;
            background: #fef2f2 !important;
        }

        /* =========================================================
           PAGINATION
        ========================================================= */

        .supplier-page .supplier-pagination {
            padding: 15px 20px;
        }

        /* =========================================================
           MODAL
        ========================================================= */

        .supplier-page .modal {
            background: rgba(15, 23, 42, .52) !important;
        }

        .supplier-page .modal-dialog {
            margin-top: 28px;
            margin-bottom: 28px;
        }

        .supplier-page .modal-content {
            overflow: hidden;

            border: 0 !important;
            border-radius: 15px !important;

            background: #fff !important;

            box-shadow:
                0 24px 70px rgba(15, 23, 42, .24) !important;
        }

        .supplier-page .modal-header {
            min-height: 64px;

            padding: 15px 20px !important;

            border-bottom: 1px solid var(--supplier-border) !important;

            background: #fff !important;
        }

        .supplier-page .modal-title {
            margin: 0;

            color: var(--supplier-text) !important;

            font-size: 18px !important;
            font-weight: 700 !important;
        }

        .supplier-page .modal-description {
            margin-top: 3px;

            color: var(--supplier-muted);

            font-size: 11px;
        }

        .supplier-page .modal-header .btn-close {
            width: 32px;
            height: 32px;

            padding: 0;

            border-radius: 8px;

            background-size: 10px;

            opacity: .65;

            transition: all .18s ease;
        }

        .supplier-page .modal-header .btn-close:hover {
            opacity: 1;
            background-color: var(--supplier-red-soft);
        }

        .supplier-page .modal-body {
            padding: 20px !important;

            max-height: calc(100vh - 180px);

            overflow-y: auto;

            scrollbar-width: thin;
            scrollbar-color: #cbd5e1 transparent;
        }

        .supplier-page .modal-body::-webkit-scrollbar {
            width: 6px;
        }

        .supplier-page .modal-body::-webkit-scrollbar-track {
            background: transparent;
        }

        .supplier-page .modal-body::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        .supplier-page .modal-footer {
            padding: 13px 20px !important;

            border-top: 1px solid var(--supplier-border) !important;

            background: #fff !important;
        }

        /* =========================================================
           FORM
        ========================================================= */

        .supplier-page .form-label {
            display: block;

            margin-bottom: 7px;

            color: #475569 !important;

            font-size: 12.5px !important;
            font-weight: 600 !important;
        }

        .supplier-page .required {
            margin-left: 2px;
            color: var(--supplier-red);
        }

        .supplier-page .error {
            display: block;

            margin-top: 5px;

            font-size: 11px;
        }

        /* =========================================================
           FORM SECTIONS
        ========================================================= */

        .supplier-page .form-section {
            margin-top: 5px;
        }

        .supplier-page .form-section + .form-section {
            margin-top: 22px;
        }

        .supplier-page .section-title {
            display: flex;
            align-items: center;
            gap: 9px;

            margin-bottom: 13px;
        }

        .supplier-page .section-icon {
            width: 30px;
            height: 30px;
            min-width: 30px;

            display: flex;
            align-items: center;
            justify-content: center;

            color: var(--supplier-red);

            background: var(--supplier-red-soft);

            border-radius: 8px;

            font-size: 14px;
        }

        .supplier-page .section-label {
            color: var(--supplier-text);

            font-size: 14px;
            font-weight: 700;
        }

        .supplier-page .section-line {
            flex: 1;

            height: 1px;

            background: var(--supplier-border-light);
        }

        /* =========================================================
           MODAL BUTTONS
        ========================================================= */

        .supplier-page .btn-light {
            min-height: 40px;

            padding: 0 15px !important;

            color: #475569 !important;

            background: #fff !important;

            border: 1px solid var(--supplier-border) !important;

            border-radius: 9px !important;

            font-size: 13px;
            font-weight: 600;

            box-shadow: none !important;
        }

        .supplier-page .btn-light:hover {
            color: var(--supplier-text) !important;
            background: #f8fafc !important;
        }

        /* =========================================================
           EMPTY STATE
        ========================================================= */

        .supplier-page .supplier-empty-state {
            padding: 48px 20px !important;
        }

        .supplier-page .empty-icon {
            width: 52px;
            height: 52px;

            margin: 0 auto 13px;

            display: flex;
            align-items: center;
            justify-content: center;

            color: var(--supplier-red);

            background: var(--supplier-red-soft);

            border-radius: 12px;

            font-size: 23px;
        }

        .supplier-page .empty-title {
            margin-bottom: 4px;

            color: var(--supplier-text);

            font-size: 14px;
            font-weight: 700;
        }

        .supplier-page .empty-description {
            color: var(--supplier-muted);

            font-size: 12px;
        }

        /* =========================================================
           MOBILE
        ========================================================= */

        @media (max-width: 767px) {

            .supplier-page .supplier-page-header .card-body {
                padding: 15px;
            }

            .supplier-page .supplier-filter-card .card-body {
                padding: 15px;
            }

            .supplier-page .supplier-heading-icon {
                width: 38px;
                height: 38px;
                min-width: 38px;

                font-size: 18px;
            }

            .supplier-page .breadcrumb-title {
                font-size: 18px !important;
            }

            .supplier-page .supplier-heading-subtitle {
                display: none;
            }

            .supplier-page .supplier-search {
                max-width: 100%;
            }

            .supplier-page .supplier-clear-btn {
                width: 100%;
            }

            .supplier-page .modal-dialog {
                margin: 10px;
            }

            .supplier-page .modal-body {
                max-height: calc(100vh - 145px);
                padding: 16px !important;
            }

            .supplier-page .modal-footer {
                padding: 12px 16px !important;
            }

            .supplier-page .address-value {
                max-width: 180px;
            }
        }
    </style>


    {{-- =========================================================
         PAGE HEADER
    ========================================================== --}}

    <div class="card supplier-page-header">

        <div class="card-body d-flex justify-content-between align-items-center">

            <div class="supplier-heading">

                <div class="supplier-heading-icon">
                    <i class="bx bx-buildings"></i>
                </div>

                <div>

                    <div class="breadcrumb-title">
                    Suppliers
                    </div>

                    <div class="supplier-heading-subtitle">
                   Manage supplier information
                    </div>

                </div>

            </div>


            <a
                href="javascript:;"
                wire:click="openModal"
                class="btn btn-primary"
            >
                <i class="bx bx-plus"></i>
                Add Supplier
            </a>

        </div>

    </div>


    {{-- =========================================================
         SEARCH / FILTER
    ========================================================== --}}

    <div class="card supplier-filter-card">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                <div class="supplier-search">

                    <i class="bx bx-search supplier-search-icon"></i>

                    <input
                        type="text"
                        wire:model.live="search"
                        class="form-control"
                        placeholder="Search by first name or mobile no."
                    >

                </div>


                <button
                    type="button"
                    class="supplier-clear-btn"
                    wire:click="clearSearch"
                >
                    <i class="bx bx-refresh"></i>
                    Clear
                </button>

            </div>

        </div>

    </div>


    {{-- =========================================================
         ADD / EDIT MODAL
    ========================================================== --}}

    <div
        class="modal @if ($showModal) show @endif"
        tabindex="-1"
        style="
            opacity:1;
            background-color:rgba(15,23,42,.52);
            @if ($showModal) display:block; @else display:none; @endif
        "
    >

        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">

                    {{-- Modal Header --}}

                    <div class="modal-header">

                        <div>

                            <h4 class="modal-title">
                                {{ $isEdit ? 'Edit Supplier' : 'Add Supplier' }}
                            </h4>

                            <div class="modal-description">
                                {{ $isEdit
                                    ? 'Update supplier details below'
                                    : 'Enter the supplier information below'
                                }}
                            </div>

                        </div>


                        <button
                            type="button"
                            class="btn-close"
                            wire:click="closeModal"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        ></button>

                    </div>


                    {{-- Modal Body --}}

                    <div class="modal-body">

                        <div class="row g-3">

                            {{-- =================================================
                                 CONTACT INFORMATION
                            ================================================== --}}

                            <div class="col-12 form-section">

                                <div class="section-title">

                                    <div class="section-icon">
                                        <i class="bx bx-phone"></i>
                                    </div>

                                    <div class="section-label">
                                        Contact Information
                                    </div>

                                    <div class="section-line"></div>

                                </div>

                            </div>


                            <div class="col-md-6">

                                <label class="form-label">
                                    Mobile No.
                                    <span class="required">*</span>
                                </label>

                                <input
                                    type="text"
                                    wire:model.lazy="mobile_no"
                                    class="form-control"
                                    placeholder="Enter Mobile No."
                                >

                                @error('mobile_no')
                                    <span class="text-danger error">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>


                            {{-- =================================================
                                 BUSINESS INFORMATION
                            ================================================== --}}

                            <div class="col-12 form-section">

                                <div class="section-title">

                                    <div class="section-icon">
                                        <i class="bx bx-buildings"></i>
                                    </div>

                                    <div class="section-label">
                                        Business Information
                                    </div>

                                    <div class="section-line"></div>

                                </div>

                            </div>


                            <div class="col-md-6">

                                <label class="form-label">
                                    Company Name
                                    <span class="required">*</span>
                                </label>

                                <input
                                    type="text"
                                    wire:model="business_first_name"
                                    class="form-control"
                                    placeholder="Enter First Name"
                                >

                                @error('business_first_name')
                                    <span class="text-danger error">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>


                            <div class="col-md-6">

                                <label class="form-label">
                                    GSTIN
                                </label>

                                <input
                                    type="text"
                                    wire:model="gstin"
                                    class="form-control"
                                    placeholder="Enter GSTIN"
                                >

                                @error('gstin')
                                    <span class="text-danger error">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>


                            <div class="col-md-12">

                                <label class="form-label">
                                    Address
                                </label>

                                <input
                                    type="text"
                                    wire:model="business_address"
                                    class="form-control"
                                    placeholder="Enter Address"
                                >

                                @error('business_address')
                                    <span class="text-danger error">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>


                            {{-- =================================================
                                 OWNER INFORMATION
                            ================================================== --}}

                            <div class="col-12 form-section">

                                <div class="section-title">

                                    <div class="section-icon">
                                        <i class="bx bx-user"></i>
                                    </div>

                                    <div class="section-label">
                                        Owner Information
                                    </div>

                                    <div class="section-line"></div>

                                </div>

                            </div>


                            <div class="col-md-4">

                                <label class="form-label">
                                    First Name
                                    <span class="required">*</span>
                                </label>

                                <input
                                    type="text"
                                    wire:model="owner_first_name"
                                    class="form-control"
                                    placeholder="Enter First Name"
                                >

                                @error('owner_first_name')
                                    <span class="text-danger error">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>


                            <div class="col-md-4">

                                <label class="form-label">
                                    Contact 1
                                    <span class="required">*</span>
                                </label>

                                <input
                                    type="text"
                                    wire:model="contact_1"
                                    class="form-control"
                                    placeholder="Enter Contact 1"
                                >

                                @error('contact_1')
                                    <span class="text-danger error">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>


                            <div class="col-md-4">

                                <label class="form-label">
                                    Contact 2
                                </label>

                                <input
                                    type="text"
                                    wire:model="contact_2"
                                    class="form-control"
                                    placeholder="Enter Contact 2"
                                >

                                @error('contact_2')
                                    <span class="text-danger error">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>


                            <div class="col-md-4">

                                <label class="form-label">
                                    Email
                                </label>

                                <input
                                    type="email"
                                    wire:model="email"
                                    class="form-control"
                                    placeholder="Enter Email"
                                >

                                @error('email')
                                    <span class="text-danger error">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>

                        </div>

                    </div>


                    {{-- Modal Footer --}}

                    <div class="modal-footer">

                        <button
                            type="button"
                            class="btn btn-light"
                            wire:click="closeModal"
                        >
                            Cancel
                        </button>

                        <button
                            type="submit"
                            class="btn btn-primary"
                        >

                            {{ $isEdit ? 'Update' : 'Save' }}

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
         SUPPLIER TABLE
    ========================================================== --}}

    <div class="card supplier-table-card">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table supplier-data-table">

                    <thead>

                        <tr>
                            <th>Sr No.</th>
                            <th>Company Name</th>
                            <th>Supplier Name</th>
                            <th>Contact No.</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>GSTIN</th>
                            <th>Action</th>
                        </tr>

                    </thead>


                    <tbody>

                        @foreach ($suppliers as $supplier)

                            <tr>

                                <td>
                                    <span class="serial-number">
                                        {{ $loop->iteration + ($suppliers->firstItem() - 1) }}
                                    </span>
                                </td>


                                <td>
                                    <span class="company-name">
                                        {{ $supplier->business_first_name }}
                                    </span>
                                </td>


                                <td>
                                    <span class="supplier-name">
                                        {{ $supplier->owner_first_name }}
                                    </span>
                                </td>


                                <td>
                                    <span class="contact-value">
                                        {{ $supplier->mobile_no }}
                                    </span>
                                </td>


                                <td>

                                    @if ($supplier->email)
                                        <span class="email-value">
                                            {{ $supplier->email }}
                                        </span>
                                    @else
                                        <span class="empty-value">—</span>
                                    @endif

                                </td>


                                <td>

                                    @if ($supplier->business_address)

                                        <span
                                            class="address-value"
                                            title="{{ $supplier->business_address }}"
                                        >
                                            {{ $supplier->business_address }}
                                        </span>

                                    @else

                                        <span class="empty-value">—</span>

                                    @endif

                                </td>


                                <td>

                                    @if ($supplier->gstin)

                                        <span class="gst-value">
                                            {{ $supplier->gstin }}
                                        </span>

                                    @else

                                        <span class="empty-value">—</span>

                                    @endif

                                </td>


                                <td>

                                    <div class="supplier-actions">

                                        <button
                                            type="button"
                                            class="supplier-action-button edit"
                                            wire:click="edit({{ $supplier->id }})"
                                            aria-label="Edit supplier"
                                            title="Edit"
                                        >
                                            <i class="bx bx-edit"></i>
                                        </button>


                                        <button
                                            type="button"
                                            class="supplier-action-button delete"
                                            wire:click="confirmDelete({{ $supplier->id }})"
                                            aria-label="Delete supplier"
                                            title="Delete"
                                        >
                                            <i class="bx bx-trash"></i>
                                        </button>

                                    </div>

                                </td>

                            </tr>

                        @endforeach


                        @if ($suppliers->isEmpty())

                            <tr>

                                <td
                                    colspan="8"
                                    class="text-center"
                                >

                                    <div class="supplier-empty-state">

                                        <div class="empty-icon">
                                            <i class="bx bx-buildings"></i>
                                        </div>

                                        <div class="empty-title">
                                            No Suppliers Found
                                        </div>

                                        <div class="empty-description">
                                            There are no suppliers matching your current search.
                                        </div>

                                    </div>

                                </td>

                            </tr>

                        @endif

                    </tbody>

                </table>

            </div>

        </div>

    </div>


    {{-- =========================================================
         PAGINATION
    ========================================================== --}}

    <div class="supplier-pagination">

        {{ $suppliers->links() }}

    </div>

</div>