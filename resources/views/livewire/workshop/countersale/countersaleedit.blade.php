<div>
    <style>
        /* =========================================================
           CARNATE COUNTER SALE — UPDATE PAGE
           UI REDESIGN ONLY
           Livewire functionality / variables / routes preserved
        ========================================================= */

        .carnate-counter-update {
            --cu-bg: #f7f8fa;
            --cu-white: #ffffff;
            --cu-text: #111827;
            --cu-muted: #64748b;
            --cu-light: #94a3b8;
            --cu-border: #e2e8f0;

            --cu-red: #e53935;
            --cu-red-soft: #fff5f5;

            --cu-green: #16a34a;
            --cu-green-soft: #f0fdf4;

            --cu-blue: #2563eb;
            --cu-blue-soft: #eff6ff;

            --cu-gray: #f1f5f9;

            width: 100%;
            color: var(--cu-text);
        }

        .carnate-counter-update *,
        .carnate-counter-update *::before,
        .carnate-counter-update *::after {
            box-sizing: border-box;
        }

        /* =========================================================
           COMMON CARD
        ========================================================= */

        .carnate-counter-update .cu-card {
            height: 100%;
            background: var(--cu-white);
            border: 1px solid var(--cu-border);
            border-radius: 16px;
            box-shadow: 0 4px 16px rgba(15, 23, 42, .035);
            overflow: hidden;
        }

        .carnate-counter-update .cu-card-body {
            padding: 22px;
        }

        .carnate-counter-update .cu-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 18px 22px;
            border-bottom: 1px solid var(--cu-border);
        }

        .carnate-counter-update .cu-card-title {
            margin: 0;
            color: var(--cu-text);
            font-size: 16px;
            font-weight: 700;
        }

        .carnate-counter-update .cu-card-subtitle {
            margin: 5px 0 0;
            color: var(--cu-muted);
            font-size: 12px;
        }

        .carnate-counter-update .cu-divider {
            height: 1px;
            margin: 17px 0;
            background: var(--cu-border);
        }


        /* =========================================================
           PAGE HEADER
        ========================================================= */

        .carnate-counter-update .cu-page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;

            min-height: 76px;
            padding: 18px 22px;
            margin-bottom: 18px;

            background: var(--cu-white);
            border: 1px solid var(--cu-border);
            border-radius: 16px;

            box-shadow: 0 4px 16px rgba(15, 23, 42, .035);
        }

        .carnate-counter-update .cu-back-link {
            display: inline-flex;
            align-items: center;
            gap: 10px;

            color: var(--cu-text);
            text-decoration: none;

            font-size: 18px;
            font-weight: 700;

            transition: color .2s ease;
        }

        .carnate-counter-update .cu-back-link:hover {
            color: var(--cu-red);
        }

        .carnate-counter-update .cu-back-icon {
            width: 34px;
            height: 34px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            border-radius: 9px;
            background: var(--cu-gray);
        }

        .carnate-counter-update .cu-back-icon img {
            width: 18px;
            height: 18px;
            object-fit: contain;
        }

        .carnate-counter-update .cu-header-note {
            color: var(--cu-muted);
            font-size: 12px;
        }


        /* =========================================================
           FORM ELEMENTS
        ========================================================= */

        .carnate-counter-update .form-label {
            margin-bottom: 7px;
            color: #334155;
            font-size: 12px;
            font-weight: 650;
        }

        .carnate-counter-update .form-control,
        .carnate-counter-update .form-select {
            min-height: 42px;

            border: 1px solid var(--cu-border);
            border-radius: 9px;

            color: var(--cu-text);
            background: #fff;

            font-size: 13px;
            box-shadow: none;

            transition: border-color .2s ease, box-shadow .2s ease;
        }

        .carnate-counter-update textarea.form-control {
            min-height: 105px;
            resize: vertical;
        }

        .carnate-counter-update .form-control::placeholder {
            color: #94a3b8;
        }

        .carnate-counter-update .form-control:focus,
        .carnate-counter-update .form-select:focus {
            border-color: rgba(229, 57, 53, .5);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .08);
        }

        .carnate-counter-update .form-control.bg-light,
        .carnate-counter-update .form-control[readonly] {
            background: #f8fafc !important;
        }

        .carnate-counter-update .cc-readonly {
            color: #475569;
            font-weight: 600;
        }

        .carnate-counter-update .text-danger {
            color: var(--cu-red) !important;
        }

        .carnate-counter-update .error {
            display: block;
            margin-top: 5px;
            font-size: 11px;
        }


        /* =========================================================
           CUSTOMER
        ========================================================= */

        .carnate-counter-update .cu-customer-layout {
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .carnate-counter-update .cu-customer-select {
            flex: 1;
            min-width: 0;
        }

        .carnate-counter-update .cu-add-customer {
            width: 42px;
            height: 42px;
            min-width: 42px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            padding: 0;

            border: 1px solid var(--cu-red);
            border-radius: 9px;

            background: var(--cu-red);
            color: #fff;

            font-size: 20px;
            transition: all .2s ease;
        }

        .carnate-counter-update .cu-add-customer:hover {
            background: #d93431;
            border-color: #d93431;
        }

        .carnate-counter-update .cu-walkin {
            display: flex;
            align-items: center;
            gap: 9px;

            margin-top: 13px;
            margin-bottom: 0;
            padding: 10px 12px;

            border: 1px solid var(--cu-border);
            border-radius: 9px;

            background: #f8fafc;
        }

        .carnate-counter-update .cu-walkin .form-check-input {
            margin: 0;
        }

        .carnate-counter-update .cu-walkin .form-check-label {
            color: var(--cu-text);
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
        }

        .carnate-counter-update .cu-customer-info {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 10px;
            margin-top: 16px;
        }

        .carnate-counter-update .cu-customer-info-item {
            padding: 11px 12px;

            border: 1px solid var(--cu-border);
            border-radius: 9px;

            background: #fafbfc;
        }

        .carnate-counter-update .cu-info-label {
            display: block;
            margin-bottom: 4px;

            color: var(--cu-muted);
            font-size: 10px;
            font-weight: 700;

            text-transform: uppercase;
            letter-spacing: .3px;
        }

        .carnate-counter-update .cu-info-value {
            display: block;

            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;

            color: var(--cu-text);
            font-size: 12px;
            font-weight: 600;
        }


        /* =========================================================
           COUNTER SALE DETAILS
        ========================================================= */

        .carnate-counter-update .cu-meta-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
        }

        .carnate-counter-update .cu-meta-box {
            padding: 14px;

            border: 1px solid var(--cu-border);
            border-radius: 10px;

            background: #f8fafc;
        }

        .carnate-counter-update .cu-meta-label {
            display: block;
            margin-bottom: 7px;

            color: var(--cu-muted);
            font-size: 11px;
            font-weight: 650;
        }


        /* =========================================================
           SPARE PART TABLE
        ========================================================= */

        .carnate-counter-update .cu-parts-wrapper {
            width: 100%;
            overflow-x: auto;

            border: 1px solid var(--cu-border);
            border-radius: 12px;
        }

        .carnate-counter-update #spare-part-table {
            width: 100%;
            min-width: 950px;

            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
            table-layout: fixed;
        }

        .carnate-counter-update #spare-part-table th.col-particulars { width: 38%; text-align: left !important; }
        .carnate-counter-update #spare-part-table th.col-qty { width: 10%; text-align: center !important; }
        .carnate-counter-update #spare-part-table th.col-price { width: 13%; text-align: right !important; }
        .carnate-counter-update #spare-part-table th.col-tax { width: 10%; text-align: center !important; }
        .carnate-counter-update #spare-part-table th.col-discount { width: 15%; text-align: right !important; }
        .carnate-counter-update #spare-part-table th.col-amount { width: 14%; text-align: right !important; }
        .carnate-counter-update #spare-part-table th.col-action { width: 10%; text-align: center !important; }

        .carnate-counter-update #spare-part-table td.col-particulars input { text-align: left !important; }
        .carnate-counter-update #spare-part-table td.col-qty input { text-align: center !important; }
        .carnate-counter-update #spare-part-table td.col-price input { text-align: right !important; }
        .carnate-counter-update #spare-part-table td.col-discount input { text-align: right !important; }
        .carnate-counter-update #spare-part-table td.col-amount input { text-align: right !important; }
        .carnate-counter-update #spare-part-table td.col-action { text-align: center !important; }

        .carnate-counter-update #spare-part-table thead th {
            padding: 12px;

            border: 0;
            border-bottom: 1px solid var(--cu-border);

            background: #f8fafc;
            color: #64748b;

            font-size: 10px;
            font-weight: 700;

            text-transform: uppercase;
            letter-spacing: .3px;

            white-space: nowrap;
        }

        .carnate-counter-update #spare-part-table tbody td {
            padding: 10px;

            border: 0;
            border-bottom: 1px solid #f1f5f9;

            background: #fff;
            vertical-align: middle;
        }

        .carnate-counter-update #spare-part-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .carnate-counter-update #spare-part-table tbody tr:hover td {
            background: #fcfcfd;
        }

        .carnate-counter-update #spare-part-table .form-control,
        .carnate-counter-update #spare-part-table .form-select {
            min-height: 38px;
            font-size: 12px;
        }

        .carnate-counter-update .cu-remove-btn {
            min-height: 34px;
            padding: 0 10px;

            border: 1px solid rgba(229, 57, 53, .18);
            border-radius: 8px;

            background: var(--cu-red-soft);
            color: var(--cu-red);

            font-size: 11px;
            font-weight: 650;

            transition: all .2s ease;
        }

        .carnate-counter-update .cu-remove-btn:hover {
            background: var(--cu-red);
            color: #fff;
        }

        .carnate-counter-update .cu-part-select {
            min-width: 320px;
        }

        .carnate-counter-update .cu-part-tax {
            color: var(--cu-muted);
            font-size: 11px;
            line-height: 1.5;
        }

        .carnate-counter-update .cu-part-amount {
            font-weight: 700;
        }


        /* =========================================================
           SELECT2
        ========================================================= */

        .carnate-counter-update .select2-container {
            width: 100% !important;
        }

        .carnate-counter-update .select2-container .select2-selection--single {
            height: 42px !important;

            border: 1px solid var(--cu-border) !important;
            border-radius: 9px !important;

            background: #fff !important;
        }

        .carnate-counter-update .select2-container
        .select2-selection--single
        .select2-selection__rendered {
            line-height: 40px !important;
            padding-left: 13px !important;

            color: var(--cu-text) !important;
            font-size: 13px !important;
        }

        .carnate-counter-update .select2-container
        .select2-selection--single
        .select2-selection__arrow {
            height: 40px !important;
        }


        /* =========================================================
           NOTE / INVOICE ACTIONS
        ========================================================= */

        .carnate-counter-update .cu-note-area {
            min-height: 130px !important;
        }

        .carnate-counter-update .cu-card-footer {
            display: flex;
            align-items: center;
            gap: 8px;

            padding: 13px 22px;

            border-top: 1px solid var(--cu-border);
            background: #fafbfc;
        }

        .carnate-counter-update .cu-invoice-btn {
            width: 38px;
            height: 38px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            border: 1px solid var(--cu-border);
            border-radius: 9px;

            background: #fff;
            color: #64748b;

            text-decoration: none;

            transition: all .2s ease;
        }

        .carnate-counter-update .cu-invoice-btn:hover {
            border-color: rgba(229, 57, 53, .2);
            background: var(--cu-red-soft);
            color: var(--cu-red);
        }

        .carnate-counter-update .cu-invoice-btn i {
            font-size: 15px;
        }


        /* =========================================================
           BILLING
        ========================================================= */

        .carnate-counter-update .cu-billing-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
        }

        .carnate-counter-update .cu-billing-item {
            padding: 14px;

            border: 1px solid var(--cu-border);
            border-radius: 10px;

            background: #fff;
        }

        .carnate-counter-update .cu-billing-item.highlight {
            background: #fffafa;
            border-color: rgba(229, 57, 53, .16);
        }

        .carnate-counter-update .cu-billing-item.success {
            background: #f8fdf9;
            border-color: rgba(22, 163, 74, .15);
        }

        .carnate-counter-update .cu-billing-input {
            min-height: 42px;

            background: #f8fafc !important;
            color: var(--cu-text) !important;

            border: 1px solid var(--cu-border) !important;
            border-radius: 9px !important;

            font-weight: 700;
        }

        .carnate-counter-update .cu-billing-item.highlight .cu-billing-input {
            color: var(--cu-red) !important;
        }


        /* =========================================================
           FOOTER / UPDATE BUTTON
        ========================================================= */

        .carnate-counter-update .cu-footer {
            display: flex;
            justify-content: flex-end;

            margin-top: 20px;
            padding: 18px 0 25px;
        }

        .carnate-counter-update .cu-update-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;

            min-height: 44px;
            padding: 0 22px;

            border: 1px solid var(--cu-red);
            border-radius: 10px;

            background: var(--cu-red);
            color: #fff;

            font-size: 13px;
            font-weight: 700;

            box-shadow: 0 5px 14px rgba(229, 57, 53, .16);

            transition: all .2s ease;
        }

        .carnate-counter-update .cu-update-btn:hover {
            background: #d93431;
            border-color: #d93431;
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 8px 18px rgba(229, 57, 53, .22);
        }

        .carnate-counter-update .cu-update-btn i {
            font-size: 17px;
        }


        /* =========================================================
           CUSTOMER MODAL
        ========================================================= */

        .carnate-counter-update .modal-content {
            overflow: hidden;

            border: 0;
            border-radius: 16px;

            box-shadow: 0 20px 50px rgba(15, 23, 42, .18);
        }

        .carnate-counter-update .cu-modal-header {
            padding: 18px 22px;

            border-bottom: 1px solid var(--cu-border);
            background: #fff;
        }

        .carnate-counter-update .cu-modal-title {
            margin: 0;

            color: var(--cu-text);
            font-size: 18px;
            font-weight: 700;
        }

        .carnate-counter-update .cu-modal-body {
            padding: 22px;
        }

        .carnate-counter-update .cu-modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 9px;

            padding: 15px 22px;

            border-top: 1px solid var(--cu-border);
        }

        .carnate-counter-update .cu-cancel-btn {
            min-height: 40px;
            padding: 0 16px;

            border: 1px solid var(--cu-border);
            border-radius: 9px;

            background: #fff;
            color: #475569;

            font-size: 13px;
            font-weight: 600;
        }

        .carnate-counter-update .cu-modal-create-btn {
            min-height: 40px;
            padding: 0 17px;

            border: 1px solid var(--cu-red);
            border-radius: 9px;

            background: var(--cu-red);
            color: #fff;

            font-size: 13px;
            font-weight: 650;
        }


        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 991px) {

            .carnate-counter-update .cu-customer-info {
                grid-template-columns: 1fr;
            }

        }

        @media (max-width: 767px) {

            .carnate-counter-update .cu-page-header {
                align-items: flex-start;
            }

            .carnate-counter-update .cu-back-link {
                font-size: 16px;
            }

            .carnate-counter-update .cu-card-body {
                padding: 17px;
            }

            .carnate-counter-update .cu-meta-grid,
            .carnate-counter-update .cu-billing-grid {
                grid-template-columns: 1fr;
            }

            .carnate-counter-update .cu-customer-layout {
                align-items: stretch;
            }

            .carnate-counter-update .cu-add-customer {
                width: 42px;
            }

            .carnate-counter-update .cu-footer {
                padding-bottom: 25px;
            }

            .carnate-counter-update .cu-update-btn {
                width: 100%;
            }
        }
    </style>


    <div class="carnate-counter-update">

        {{-- =====================================================
             CUSTOMER MODAL
        ====================================================== --}}

        <div
            class="modal @if ($showModal) show @endif"
            tabindex="-1"
            style="opacity:1; background-color:#0606068c; display:@if ($showModal) block @endif"
        >

            <div class="modal-dialog modal-lg modal-fullscreen-sm-down modal-dialog-centered">

                <div class="modal-content">

                    <form wire:submit.prevent="{{ $add ? 'storeCustomer' : 'storeCustomer' }}">

                        <div class="cu-modal-header d-flex justify-content-between align-items-center">

                            <h4 class="cu-modal-title">
                                Customer Details
                            </h4>

                            <button
                                type="button"
                                class="btn-close"
                                wire:click="$set('showModal', false)"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                            ></button>

                        </div>


                        <div class="cu-modal-body">

                            @csrf

                            <div class="row g-3">

                                {{-- Name --}}

                                <div class="col-md-6">

                                    <label class="form-label">
                                        Name
                                        <sup class="text-danger">*</sup>
                                    </label>

                                    <input
                                        type="text"
                                        wire:model="name"
                                        class="form-control"
                                        placeholder="Enter Name"
                                    >

                                    @error('name')
                                        <span class="text-danger error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>


                                {{-- Email --}}

                                <div class="col-md-6">

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


                                {{-- Mobile --}}

                                <div class="col-md-6">

                                    <label class="form-label">
                                        Mobile Number
                                        <sup class="text-danger">*</sup>
                                    </label>

                                    <input
                                        type="text"
                                        wire:model="mobile_no"
                                        class="form-control"
                                        placeholder="Enter Mobile Number"
                                    >

                                    @error('mobile_no')
                                        <span class="text-danger error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>


                                {{-- GST --}}

                                <div class="col-md-6">

                                    <label class="form-label">
                                        GST Number
                                    </label>

                                    <input
                                        type="text"
                                        wire:model="gst_no"
                                        class="form-control"
                                        placeholder="Enter GST Number"
                                    >

                                </div>


                                {{-- Number Plate — preserved as commented functionality --}}

                                {{--
                                <div class="col-md-6">

                                    <label class="form-label">
                                        Number Plate
                                        <sup class="text-danger">*</sup>
                                    </label>

                                    <input
                                        type="text"
                                        wire:model="numberPlate"
                                        class="form-control"
                                        placeholder="Enter Number Plate"
                                    >

                                    @error('numberPlate')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>
                                --}}


                                {{-- Address --}}

                                <div class="col-12">

                                    <label class="form-label">
                                        Address
                                    </label>

                                    <textarea
                                        wire:model="address"
                                        class="form-control"
                                        placeholder="Enter Address"
                                    ></textarea>

                                    @error('address')
                                        <span class="text-danger error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>

                            </div>

                        </div>


                        <div class="cu-modal-footer">

                            <button
                                type="button"
                                class="cu-cancel-btn"
                                wire:click="$set('showModal', false)"
                                data-bs-dismiss="modal"
                            >
                                Cancel
                            </button>

                            <button
                                type="submit"
                                class="cu-modal-create-btn"
                            >
                                Create

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


        {{-- =====================================================
             PAGE HEADER
        ====================================================== --}}

        <div class="cu-page-header">

            <a
                href="{{ route('workshop.counter_sale') }}"
                class="cu-back-link"
            >

                <span class="cu-back-icon">

                    <img
                        src="{{ asset('supplier/Back Arrow.png') }}"
                        class="back-arrow"
                        alt="Back"
                    >

                </span>

                <span>
                    Update Counter Sale
                </span>

            </a>

            <span class="cu-header-note">
                Edit counter sale details
            </span>

        </div>


        @csrf


        <div class="row g-4">

            {{-- =================================================
                 CUSTOMER
            ================================================== --}}

            <div class="col-12 col-md-6">

                <div class="cu-card">

                    <div class="cu-card-body">

                        <h6 class="cu-card-title">
                            Search or Create New User
                        </h6>

                        <p class="cu-card-subtitle">
                            Select the customer associated with this sale.
                        </p>

                        <div class="cu-divider"></div>


                        <label
                            for="customer-dropdown"
                            class="form-label"
                        >
                            Customer Name Or Vehicle Number
                        </label>


                        <div
                            class="cu-customer-layout mb-3"
                            wire:ignore.self
                        >

                            <div class="cu-customer-select">

                                <select
                                    id="customer_name"
                                    wire:model="customer_name"
                                    class="form-select select2"
                                    data-property="customer_name"
                                    @disabled($is_walkin_customer)
                                >

                                    <option value="">
                                        --Select Customer--
                                    </option>

                                    @foreach ($customers as $customer)

                                        <option value="{{ $customer->id }}">
                                            {{ $customer->name . ' ' . $customer->lastname }}
                                        </option>

                                    @endforeach

                                </select>

                            </div>


                            <button
                                type="button"
                                class="cu-add-customer"
                                wire:click="addCustomer"
                                @disabled($is_walkin_customer)
                                title="Add Customer"
                            >
                                {{ trans('+') }}
                            </button>

                        </div>


                        <div class="cu-walkin">

                            <input
                                type="checkbox"
                                class="form-check-input"
                                id="is_walkin_customer"
                                wire:model.live="is_walkin_customer"
                            >

                            <label
                                class="form-check-label"
                                for="is_walkin_customer"
                            >
                                Walk-in Customer
                            </label>

                        </div>


                        @error('customer_name')

                            <span class="text-danger error">
                                {{ $message }}
                            </span>

                        @enderror


                        @if (!empty($customer_data) && !$is_walkin_customer)

                            <div class="cu-customer-info">

                                <div class="cu-customer-info-item">

                                    <span class="cu-info-label">
                                        Customer
                                    </span>

                                    <span class="cu-info-value">
                                        {{ @$customer_data->name }}
                                    </span>

                                </div>


                                <div class="cu-customer-info-item">

                                    <span class="cu-info-label">
                                        Mobile
                                    </span>

                                    <span class="cu-info-value">
                                        {{ @$customer_data->mobile_no }}
                                    </span>

                                </div>


                                <div class="cu-customer-info-item">

                                    <span class="cu-info-label">
                                        GST
                                    </span>

                                    <span class="cu-info-value">
                                        {{ @$customer_data->gst_number }}
                                    </span>

                                </div>

                            </div>

                        @endif

                    </div>

                </div>

            </div>


            {{-- =================================================
                 COUNTER SALE DETAILS
            ================================================== --}}

            <div class="col-12 col-md-6">

                <div class="cu-card">

                    <div class="cu-card-body">

                        <h6 class="cu-card-title">
                            Counter Sale Details
                        </h6>

                        <p class="cu-card-subtitle">
                            Sale reference and transaction date.
                        </p>

                        <div class="cu-divider"></div>


                        <div class="cu-meta-grid">

                            <div class="cu-meta-box">

                                <label class="cu-meta-label">
                                    Counter Sale No.
                                </label>

                                <input
                                    type="text"
                                    id="countersale_number"
                                    wire:model="countersale_number"
                                    class="form-control cu-readonly"
                                    readonly
                                    placeholder="Job-Card Number"
                                    aria-label="Job-Card Number"
                                >

                            </div>


                            <div class="cu-meta-box">

                                <label class="cu-meta-label">
                                    Date
                                </label>

                                <input
                                    type="date"
                                    class="form-control cu-readonly"
                                    wire:model="created_at"
                                    readonly
                                    placeholder="Date"
                                    aria-label="Date"
                                >

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =================================================
                 SPARE & LUBE DETAILS
            ================================================== --}}

            <div class="col-12">

                <div class="cu-card">

                    <div class="cu-card-header">

                        <div>

                            <h6 class="cu-card-title">
                                Spare & Lube Details
                            </h6>

                            <p class="cu-card-subtitle">
                                Review parts, quantities, pricing and discounts.
                            </p>

                        </div>

                    </div>


                    <div class="cu-card-body">

                        <div
                            class="cu-parts-wrapper"
                            id="spare-table"
                            style="display: {{ $showTable == 2 ? 'block' : 'none' }}"
                        >

                            <table
                                class="table"
                                id="spare-part-table"
                            >

                                <thead>

                                    <tr>

                                        <th class="col-particulars text-start">Particulars</th>

                                        <th class="col-qty text-center">Quantity</th>

                                        <th class="col-price text-end">Unit Price(Rs)</th>

                                        @if($isWorkshopGst)
                                            <th class="col-tax text-center">Tax</th>
                                        @endif

                                        <th class="col-discount text-end">Discount</th>

                                        <th class="col-amount text-end">Amount</th>

                                        <th class="col-action text-center">Action</th>

                                    </tr>

                                </thead>


                                <tbody>

                                    @foreach ($spareParts as $index => $part)

                                        <tr>

                                            {{-- PARTICULAR --}}

                                            <td class="col-particulars">

                                                <input
                                                    type="text"
                                                    class="form-control text-start"
                                                    wire:model="spareParts.{{ $index }}.part_name"
                                                    placeholder="Part Name"
                                                    id="spareParts.{{ $index }}.part_name"
                                                >

                                            </td>


                                            {{-- QUANTITY --}}

                                            <td class="col-qty text-center">

                                                <input
                                                    type="number"
                                                    class="form-control text-center"
                                                    wire:model.lazy="spareParts.{{ $index }}.quantity"
                                                    id="spareParts.{{ $index }}.unit_price"
                                                >

                                            </td>


                                            {{-- UNIT PRICE --}}

                                            <td class="col-price text-end">

                                                <input
                                                    type="number"
                                                    class="form-control text-end"
                                                    wire:model.lazy="spareParts.{{ $index }}.unit_price"
                                                >

                                            </td>


                                            {{-- TAX --}}

                                            @if($isWorkshopGst)

                                                <td class="col-tax text-center">

                                                    @if(isset($spareParts[$index]['tax_percentage']))

                                                        <div class="cu-part-tax text-center">

                                                            {{ $spareParts[$index]['tax_percentage'] }}%

                                                            <br>

                                                            ({{ ucfirst($spareParts[$index]['tax_type'] ?? 'include') }})

                                                        </div>

                                                    @else

                                                        -

                                                    @endif

                                                </td>

                                            @endif


                                            {{-- DISCOUNT --}}

                                            <td class="col-discount text-end">

                                                <div class="input-group flex-nowrap">

                                                    <input
                                                        type="number"
                                                        class="form-control text-end"
                                                        wire:model.lazy="spareParts.{{ $index }}.discount"
                                                        id="spareParts.{{ $index }}.discount"
                                                        step="1"
                                                        min="0"
                                                        placeholder="Discount"
                                                        style="min-width:65px;"
                                                    >

                                                    <select
                                                        class="form-select text-center"
                                                        id="spareParts.{{ $index }}.discount_type"
                                                        wire:model.lazy="spareParts.{{ $index }}.discount_type"
                                                        style="min-width:55px !important; max-width:55px !important; padding-left:4px; padding-right:4px;"
                                                    >

                                                        <option value="1">
                                                            ₹
                                                        </option>

                                                        <option value="2">
                                                            %
                                                        </option>

                                                    </select>

                                                </div>

                                            </td>


                                            {{-- FINAL AMOUNT --}}

                                            <td class="col-amount text-end">

                                                <input
                                                    type="text"
                                                    class="form-control bg-light cu-part-amount text-end"
                                                    wire:model="spareParts.{{ $index }}.final_amount"
                                                    id="spareParts.{{ $index }}.final_amount"
                                                    readonly
                                                >

                                            </td>


                                            {{-- REMOVE --}}

                                            <td class="col-action text-center">

                                                <button
                                                    class="cu-remove-btn"
                                                    wire:click="removeRow('spareParts', {{ $index }})"
                                                    id="{{ $index }}"
                                                >
                                                    Remove
                                                </button>

                                            </td>

                                        </tr>

                                    @endforeach

                                </tbody>


                                <tfoot>

                                    <tr>

                                        <td colspan="7">

                                            <div class="cu-part-select">

                                                <select
                                                    id="spare_parts_data"
                                                    wire:model.live="spare_parts_data"
                                                    class="form-control select2"
                                                    data-property="spare_parts_data"
                                                >

                                                    <option value="">
                                                        --Select Spare Part --
                                                    </option>

                                                    @foreach ($spare as $item)

                                                        <option value="{{ $item->id }}">

                                                            {{ $item->title ?? 'No Name' }}

                                                            <small>
                                                                (Stock: {{ $item->stock ?? 0 }})
                                                            </small>,

                                                            <small class="text-danger">
                                                                (₹{{ $item->price ?? 0 }})
                                                            </small>

                                                        </option>

                                                    @endforeach

                                                </select>

                                            </div>

                                        </td>

                                    </tr>

                                </tfoot>

                            </table>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =================================================
                 NOTE + INVOICE
            ================================================== --}}

            <div class="col-12 col-xl-6">

                <div class="cu-card">

                    <div class="cu-card-body">

                        <h6 class="cu-card-title">
                            Note to Display on Invoice
                        </h6>

                        <p class="cu-card-subtitle">
                            Invoice note and document options.
                        </p>

                        <div class="cu-divider"></div>

                        <textarea
                            wire:model="note"
                            class="form-control cu-note-area"
                            placeholder=""
                        ></textarea>

                    </div>


                    <div class="cu-card-footer">

                        <a
                            href="{{ route('getworkshopCountersalesinvoPdf', [$counterSaleId, 1]) }}"
                            target="_blank"
                            class="cu-invoice-btn"
                            title="Print Invoice"
                        >
                            <i class="fa fa-print"></i>
                        </a>


                        <a
                            href="{{ route('getworkshopCountersalesinvoPdf', [$counterSaleId, 0]) }}"
                            class="cu-invoice-btn"
                            title="PDF Invoice"
                        >
                            <i class="fa fa-file-pdf"></i>
                        </a>

                    </div>

                </div>

            </div>


            {{-- =================================================
                 BILLING DETAILS
            ================================================== --}}

            <div class="col-12 col-xl-6">

                <div class="cu-card">

                    <div class="cu-card-body">

                        <h6 class="cu-card-title">
                            Billing Details
                        </h6>

                        <p class="cu-card-subtitle">
                            Review payment and outstanding balance.
                        </p>

                        <div class="cu-divider"></div>


                        <div class="cu-billing-grid">

                            {{-- TOTAL PAYABLE --}}

                            <div class="cu-billing-item highlight">

                                <label
                                    for="subtotal"
                                    class="form-label"
                                >
                                    Total Payable
                                </label>

                                <input
                                    type="text"
                                    id="subtotal"
                                    wire:model="totalAmount"
                                    class="form-control cu-billing-input"
                                    readonly
                                >

                            </div>


                            {{-- SUBTOTAL --}}

                            <div class="cu-billing-item">

                                <label
                                    for="final-amount"
                                    class="form-label"
                                >
                                    Subtotal
                                </label>

                                <input
                                    type="text"
                                    id="final-amount"
                                    wire:model="final_amount"
                                    class="form-control cu-billing-input"
                                    readonly
                                >

                                @error('final_amount')

                                    <span class="text-danger error">
                                        {{ $message }}
                                    </span>

                                @enderror

                            </div>

                        </div>


                        <div class="cu-divider"></div>


                        {{-- PAYMENT TYPE --}}

                        <div class="row g-3">

                            <div class="col-md-6">

                                <label class="form-label">
                                    Payment Type
                                </label>

                                <select
                                    wire:model.live="payment_type"
                                    class="form-control form-select"
                                >

                                    <option value="">
                                        --Choose Payment Type--
                                    </option>

                                    <option value="total">
                                        Total
                                    </option>

                                    <option value="partial">
                                        Partial
                                    </option>

                                </select>

                                @error('payment_type')

                                    <span class="text-danger error">
                                        {{ $message }}
                                    </span>

                                @enderror

                            </div>


                            @if ($payment_type === 'partial')

                                <div class="col-md-6">

                                    <label class="form-label">
                                        Partial Amount
                                    </label>

                                    <input
                                        type="number"
                                        wire:model.live="partial_amount"
                                        class="form-control"
                                        min="0"
                                    >

                                </div>

                            @elseif ($payment_type === 'total')

                                <div class="col-md-6">

                                    <label class="form-label">
                                        Total Amount
                                    </label>

                                    <input
                                        type="number"
                                        wire:model.live="total_amount"
                                        readonly
                                        class="form-control"
                                        min="0"
                                    >

                                </div>

                            @endif

                        </div>


                        <div class="cu-divider"></div>


                        {{-- BALANCE --}}

                        <div class="cu-billing-item">

                            <label class="form-label">
                                Remaining Balance
                            </label>

                            <input
                                type="text"
                                wire:model.live="balance_amount"
                                class="form-control cu-billing-input"
                                readonly
                            >

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
             UPDATE BUTTON
        ====================================================== --}}

        <div class="cu-footer">

            <button
                wire:click="updateCustomerCounter"
                class="cu-update-btn"
            >
                <i class="bx bx-save"></i>
                Update Counter Sale
            </button>

        </div>

    </div>


    @section('footerscript')

        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

        <script>

            document.addEventListener('livewire:init', () => {

                $('#spare_parts_data').select2({
                    placeholder: "Select Spare Part"
                }).on('change', function() {

                    let selectedValue = $(this).val();

                    @this.set('spare_parts_data', selectedValue);

                });


                Livewire.hook('morphed', (message, component) => {

                    $('#spare_parts_data').select2({
                        placeholder: "Select Spare part"
                    });

                });

            });


            document.addEventListener('livewire:init', () => {

                $('#customer_name').select2({
                    placeholder: "Select Customer or Vehicle",
                    width: '100%'
                }).on('change', function() {

                    let selectedValue = $(this).val();

                    console.log('Selected Value:', selectedValue);

                    @this.set('customer_name', selectedValue);

                });


                Livewire.hook('morphed', (message, component) => {

                    $('#customer_name').select2({
                        placeholder: "Select Customer or Vehicle",

                        ajax: {

                            url: '/workshop/countercustomers',

                            dataType: 'json',

                            delay: 250,

                            data: function(params) {

                                return {
                                    search: params.term,
                                    page: params.page || 1,
                                };

                            },

                            processResults: function(data, params) {

                                console.log(data);

                                params.page = params.page || 1;


                                const results =
                                    Array.isArray(data.data)
                                        ? data.data.map(item => ({
                                            id: item.id,
                                            text: `${item.name || ''} ${item.lastname || ''}/${item.mobile_no || ''}/${item.number_plate || ''}`,
                                        }))
                                        : [];


                                return {

                                    results: results,

                                    pagination: {
                                        more: data.next_page_url != null
                                    }

                                };

                            },

                            cache: true,

                        }

                    });

                });


                window.addEventListener('set-customer-select2', event => {

                    let data =
                        event.detail[0] || event.detail;

                    let newOption =
                        new Option(
                            data.text,
                            data.id,
                            true,
                            true
                        );

                    $('#customer_name')
                        .append(newOption)
                        .trigger('change');

                });

            });

        </script>

    @endsection

</div>