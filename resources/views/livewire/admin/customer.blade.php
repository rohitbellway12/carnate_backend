<div class="carnate-customer-page">

    <style>
        .carnate-customer-page {
            --c-red: #e53935;
            --c-red-dark: #d32f2f;
            --c-red-light: #fff5f5;
            --c-bg: #f7f8fa;
            --c-white: #ffffff;
            --c-text: #111827;
            --c-secondary: #64748b;
            --c-muted: #94a3b8;
            --c-border: #e2e8f0;
            --c-hover: #f8fafc;
            --c-green: #16a34a;
            --c-green-light: #f0fdf4;
            --c-danger: #dc2626;
            --c-danger-light: #fef2f2;
        }

        .carnate-customer-page {
            background: var(--c-bg);
            min-height: 100%;
            color: var(--c-text);
        }

        /* Success */
        .carnate-success-alert {
            border: 1px solid #bbf7d0;
            background: var(--c-green-light);
            color: #166534;
            border-radius: 10px;
            padding: 12px 16px;
            margin-bottom: 18px;
            font-size: 14px;
            font-weight: 500;
        }

        /* Header */
        .carnate-page-header {
            background: var(--c-white);
            border: 1px solid var(--c-border);
            border-radius: 14px;
            padding: 20px 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            box-shadow: 0 2px 8px rgba(15, 23, 42, .03);
        }

        .carnate-title-wrap {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .carnate-title-icon {
            width: 42px;
            height: 42px;
            border-radius: 11px;
            background: var(--c-red-light);
            color: var(--c-red);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 19px;
        }

        .carnate-page-title {
            margin: 0;
            color: var(--c-text);
            font-size: 19px;
            font-weight: 700;
            line-height: 1.2;
        }

        .carnate-page-subtitle {
            margin: 4px 0 0;
            color: var(--c-secondary);
            font-size: 13px;
        }

        /* Primary Button */
        .carnate-btn-primary {
            min-height: 42px;
            padding: 0 18px;
            border: 0;
            border-radius: 9px;
            background: var(--c-red);
            color: #fff !important;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none !important;
            box-shadow: 0 4px 10px rgba(229, 57, 53, .16);
            transition: all .2s ease;
            cursor: pointer;
        }

        .carnate-btn-primary:hover {
            background: var(--c-red-dark);
            color: #fff !important;
            transform: translateY(-1px);
        }

        /* Filter */
        .carnate-filter-card {
            margin-top: 18px;
            background: var(--c-white);
            border: 1px solid var(--c-border);
            border-radius: 14px;
            padding: 18px;
            box-shadow: 0 2px 8px rgba(15, 23, 42, .025);
        }

        .carnate-filter-grid {
            display: grid;
            grid-template-columns: minmax(250px, 1fr) auto;
            gap: 14px;
            align-items: end;
        }

        .carnate-field-label {
            display: block;
            margin-bottom: 7px;
            color: var(--c-text);
            font-size: 13px;
            font-weight: 600;
        }

        .carnate-form-control {
            width: 100%;
            min-height: 43px;
            padding: 9px 13px;
            border: 1px solid var(--c-border);
            border-radius: 9px;
            background: #fff;
            color: var(--c-text);
            font-size: 14px;
            outline: none;
            transition: all .2s ease;
        }

        .carnate-form-control::placeholder {
            color: var(--c-muted);
        }

        .carnate-form-control:focus {
            border-color: rgba(229, 57, 53, .55);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .08);
        }

        textarea.carnate-form-control {
            min-height: 95px;
            resize: vertical;
        }

        select.carnate-form-control {
            height: 43px;
            padding-top: 0;
            padding-bottom: 0;
        }

        .carnate-clear-btn {
            height: 43px;
            padding: 0 17px;
            border: 1px solid var(--c-border);
            border-radius: 9px;
            background: #fff;
            color: var(--c-secondary);
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all .2s ease;
        }

        .carnate-clear-btn:hover {
            background: var(--c-hover);
            color: var(--c-text);
            border-color: #cbd5e1;
        }

        /* Table */
        .carnate-table-card {
            margin-top: 18px;
            background: var(--c-white);
            border: 1px solid var(--c-border);
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(15, 23, 42, .025);
        }

        .carnate-table-header {
            padding: 17px 20px;
            border-bottom: 1px solid var(--c-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .carnate-table-heading {
            margin: 0;
            color: var(--c-text);
            font-size: 15px;
            font-weight: 700;
        }

        .carnate-table-count {
            padding: 5px 10px;
            border: 1px solid var(--c-border);
            border-radius: 20px;
            background: #f8fafc;
            color: var(--c-secondary);
            font-size: 12px;
            font-weight: 600;
        }

        .carnate-table-wrap {
            overflow-x: auto;
        }

        .carnate-table {
            width: 100%;
            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .carnate-table thead th {
            padding: 13px 16px;
            background: #f8fafc;
            border-bottom: 1px solid var(--c-border);
            color: var(--c-secondary);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .04em;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .carnate-table tbody td {
            padding: 14px 16px;
            border-bottom: 1px solid #eef2f6;
            color: var(--c-text);
            font-size: 13px;
            vertical-align: middle;
        }

        .carnate-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .carnate-table tbody tr {
            transition: background .15s ease;
        }

        .carnate-table tbody tr:hover {
            background: var(--c-hover);
        }

        .carnate-serial {
            color: var(--c-muted);
            font-weight: 600;
        }

        /* Customer */
        .carnate-customer-cell {
            display: flex;
            align-items: center;
            gap: 11px;
            min-width: 180px;
        }

        .carnate-avatar {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: var(--c-red-light);
            color: var(--c-red);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 700;
            flex-shrink: 0;
        }

        .carnate-customer-name {
            color: var(--c-text);
            font-weight: 600;
        }

        .carnate-email {
            color: var(--c-secondary);
        }

        .carnate-mobile {
            color: var(--c-text);
            font-weight: 500;
        }

        .carnate-address {
            max-width: 300px;
            color: var(--c-secondary);
            white-space: normal;
            line-height: 1.5;
        }

        /* Actions */
        .carnate-actions {
            display: flex;
            align-items: center;
            gap: 7px;
            white-space: nowrap;
        }

        .carnate-action-btn {
            width: 34px;
            height: 34px;
            border: 1px solid var(--c-border);
            border-radius: 8px;
            background: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            text-decoration: none !important;
            transition: all .2s ease;
        }

        .carnate-edit-btn {
            color: var(--c-secondary);
        }

        .carnate-edit-btn:hover {
            color: var(--c-red);
            border-color: rgba(229, 57, 53, .25);
            background: var(--c-red-light);
        }

        .carnate-delete-btn {
            color: var(--c-secondary);
        }

        .carnate-delete-btn:hover {
            color: var(--c-danger);
            border-color: #fecaca;
            background: var(--c-danger-light);
        }

        /* Pagination */
        .carnate-pagination {
            padding: 16px 20px;
            border-top: 1px solid var(--c-border);
        }

        /* Empty */
        .carnate-empty {
            padding: 55px 20px;
            text-align: center;
        }

        .carnate-empty-icon {
            width: 58px;
            height: 58px;
            margin: 0 auto 14px;
            border-radius: 15px;
            background: #f8fafc;
            color: var(--c-muted);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .carnate-empty-title {
            margin: 0 0 5px;
            color: var(--c-text);
            font-size: 15px;
            font-weight: 700;
        }

        .carnate-empty-text {
            margin: 0;
            color: var(--c-secondary);
            font-size: 13px;
        }

        /* Modal */
        .carnate-modal {
            position: fixed;
            inset: 0;
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: rgba(15, 23, 42, .48);
            backdrop-filter: blur(4px);
        }

        .carnate-modal-dialog {
            width: 100%;
            max-width: 850px;
            max-height: calc(100vh - 40px);
            overflow-y: auto;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 24px 70px rgba(15, 23, 42, .22);
            animation: carnateModalIn .2s ease-out;
        }

        @keyframes carnateModalIn {
            from {
                opacity: 0;
                transform: translateY(10px) scale(.985);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .carnate-modal-header {
            padding: 19px 22px;
            border-bottom: 1px solid var(--c-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            position: sticky;
            top: 0;
            background: #fff;
            z-index: 2;
        }

        .carnate-modal-title-wrap {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .carnate-modal-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: var(--c-red-light);
            color: var(--c-red);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .carnate-modal-title {
            margin: 0;
            color: var(--c-text);
            font-size: 17px;
            font-weight: 700;
        }

        .carnate-modal-close {
            width: 34px;
            height: 34px;
            border: 1px solid var(--c-border);
            border-radius: 8px;
            background: #fff;
            color: var(--c-secondary);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all .2s ease;
        }

        .carnate-modal-close:hover {
            color: var(--c-danger);
            background: var(--c-danger-light);
            border-color: #fecaca;
        }

        .carnate-modal-body {
            padding: 22px;
        }

        .carnate-modal-footer {
            padding: 16px 22px;
            border-top: 1px solid var(--c-border);
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            position: sticky;
            bottom: 0;
            background: #fff;
        }

        .carnate-submit-btn {
            min-width: 105px;
        }

        .carnate-required {
            color: var(--c-danger);
            margin-left: 2px;
        }

        .carnate-error {
            display: block;
            margin-top: 5px;
            color: var(--c-danger);
            font-size: 12px;
        }

        .carnate-spinner {
            width: 14px;
            height: 14px;
            border-width: 2px;
            margin-left: 5px;
        }

        .carnate-section-title {
            margin: 4px 0 16px;
            padding-bottom: 9px;
            border-bottom: 1px solid var(--c-border);
            color: var(--c-text);
            font-size: 13px;
            font-weight: 700;
        }

        .carnate-section-title i {
            color: var(--c-red);
            margin-right: 6px;
        }

        .carnate-input-group {
            display: flex;
            width: 100%;
        }

        .carnate-title-select {
            width: 82px !important;
            flex: 0 0 82px;
            border-radius: 9px 0 0 9px !important;
            border-right: 0 !important;
        }

        .carnate-name-input {
            border-radius: 0 9px 9px 0 !important;
        }

        /* Responsive */
        @media (max-width: 800px) {
            .carnate-page-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .carnate-btn-primary {
                width: 100%;
            }

            .carnate-filter-grid {
                grid-template-columns: 1fr;
            }

            .carnate-clear-btn {
                width: 100%;
            }
        }

        @media (max-width: 576px) {
            .carnate-page-header {
                padding: 16px;
            }

            .carnate-filter-card {
                padding: 14px;
            }

            .carnate-modal {
                padding: 8px;
            }

            .carnate-modal-header,
            .carnate-modal-body,
            .carnate-modal-footer {
                padding: 16px;
            }
        }
    </style>

    {{-- Success Message --}}
    @if (session()->has('message'))
        <div class="carnate-success-alert">
            <i class="bx bx-check-circle me-1"></i>
            {{ session('message') }}
        </div>
    @endif

    {{-- Page Header --}}
    <div class="carnate-page-header">

        <div class="carnate-title-wrap">

            <div class="carnate-title-icon">
                <i class="fas fa-handshake"></i>
            </div>

            <div>
                <h4 class="carnate-page-title">
                    Customer
                </h4>

                <p class="carnate-page-subtitle">
                    Manage your customer records and contact information
                </p>
            </div>

        </div>

        @if (@$admin->hasPermissionTo('customer-add'))

            <a
                href="javascript:;"
                wire:click="create"
                class="carnate-btn-primary"
            >
                <i class="bx bx-plus"></i>
                Add Customer
            </a>

        @endif

    </div>

    {{-- Search --}}
    <div class="carnate-filter-card">

        <div class="carnate-filter-grid">

            <div>

                <label class="carnate-field-label">
                    Search Customer
                </label>

                <input
                    type="text"
                    class="carnate-form-control"
                    placeholder="Search by customer name..."
                    wire:model.live="searchfilter"
                >

            </div>

            <div>

                <button
                    type="button"
                    class="carnate-clear-btn"
                    wire:click="resetFilter"
                >
                    <i class="bx bx-refresh me-1"></i>
                    Clear
                </button>

            </div>

        </div>

    </div>

    {{-- Customer Modal --}}
    @if ($showModal)

        <div class="carnate-modal">

            <div class="carnate-modal-dialog">

                <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">

                    @csrf

                    {{-- Modal Header --}}
                    <div class="carnate-modal-header">

                        <div class="carnate-modal-title-wrap">

                            <div class="carnate-modal-icon">
                                <i class="bx bx-user"></i>
                            </div>

                            <h4 class="carnate-modal-title">
                                {{ $isEdit ? 'Edit Customer' : 'Customer Details' }}
                            </h4>

                        </div>

                        <button
                            type="button"
                            class="carnate-modal-close"
                            wire:click="colseModel"
                            aria-label="Close"
                        >
                            <i class="bx bx-x fs-5"></i>
                        </button>

                    </div>

                    {{-- Modal Body --}}
                    <div class="carnate-modal-body">

                        <div class="carnate-section-title">
                            <i class="bx bx-user"></i>
                            Personal Information
                        </div>

                        <div class="row g-4">

                            {{-- First Name --}}
                            <div class="col-md-6">

                                <label class="carnate-field-label">
                                    First Name
                                    <span class="carnate-required">*</span>
                                </label>

                                <div class="carnate-input-group">

                                    <select
                                        name="user_title"
                                        id="user_title"
                                        wire:model="user_title"
                                        class="carnate-form-control carnate-title-select"
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
                                        class="carnate-form-control carnate-name-input"
                                        placeholder="Enter First Name"
                                    >

                                </div>

                                @if ($errors->has('name') || $errors->has('user_title'))
                                    <span class="carnate-error">
                                        {{ $errors->first('name') ?? $errors->first('user_title') }}
                                    </span>
                                @endif

                            </div>

                            {{-- Last Name --}}
                            <div class="col-md-6">

                                <label class="carnate-field-label">
                                    Last Name
                                </label>

                                <input
                                    type="text"
                                    wire:model="lastname"
                                    class="carnate-form-control"
                                    placeholder="Enter Last Name"
                                >

                                @error('lastname')
                                    <span class="carnate-error">{{ $message }}</span>
                                @enderror

                            </div>

                            {{-- GST --}}
                            <div class="col-md-6">

                                <label class="carnate-field-label">
                                    GST Number
                                </label>

                                <input
                                    type="text"
                                    wire:model="gst_no"
                                    class="carnate-form-control"
                                    placeholder="Enter GST Number"
                                >

                                @error('gst_no')
                                    <span class="carnate-error">{{ $message }}</span>
                                @enderror

                            </div>

                            {{-- Mobile --}}
                            <div class="col-md-6">

                                <label class="carnate-field-label">
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
                                    <span class="carnate-error">{{ $message }}</span>
                                @enderror

                            </div>

                            {{-- Email --}}
                            <div class="col-md-6">

                                <label class="carnate-field-label">
                                    Email
                                </label>

                                <input
                                    type="email"
                                    wire:model="email"
                                    class="carnate-form-control"
                                    placeholder="Enter Email"
                                >

                                @error('email')
                                    <span class="carnate-error">{{ $message }}</span>
                                @enderror

                            </div>

                            {{-- Birth Date --}}
                            <div class="col-md-6">

                                <label class="carnate-field-label">
                                    Birth Date
                                </label>

                                <input
                                    type="date"
                                    wire:model="birth_date"
                                    class="carnate-form-control"
                                >

                                @error('birth_date')
                                    <span class="carnate-error">{{ $message }}</span>
                                @enderror

                            </div>

                        </div>

                        <div class="carnate-section-title mt-4">
                            <i class="bx bx-map"></i>
                            Location Information
                        </div>

                        <div class="row g-4">

                            {{-- Country --}}
                            <div class="col-md-6">

                                <label class="carnate-field-label">
                                    Country
                                </label>

                                <select
                                    class="carnate-form-control searchable-select"
                                    data-placeholder="Select Country"
                                    wire:change="stateData($event.target.value)"
                                    wire:model="country_id"
                                >
                                    <option value="">Select Country</option>

                                    @foreach ($countries as $country)

                                        <option value="{{ $country->id }}">
                                            {{ $country->name }}
                                        </option>

                                    @endforeach

                                </select>

                                @error('country_id')
                                    <span class="carnate-error">{{ $message }}</span>
                                @enderror

                            </div>

                            {{-- State --}}
                            <div class="col-md-6">

                                <label class="carnate-field-label">
                                    State
                                </label>

                                <select
                                    class="carnate-form-control searchable-select"
                                    data-placeholder="Select State"
                                    wire:model="state_id"
                                    wire:change="cityData($event.target.value)"
                                >
                                    <option value="">Select State</option>

                                    @foreach ($states as $state)

                                        <option
                                            value="{{ $state->id }}"
                                            @selected($state_id == $state->id)
                                        >
                                            {{ $state->name }}
                                        </option>

                                    @endforeach

                                </select>

                                @error('state_id')
                                    <span class="carnate-error">{{ $message }}</span>
                                @enderror

                            </div>

                            {{-- City --}}
                            <div class="col-md-6">

                                <label class="carnate-field-label">
                                    City
                                </label>

                                <select
                                    class="carnate-form-control searchable-select"
                                    data-placeholder="Select City"
                                    wire:model="city_id"
                                >
                                    <option value="">Select City</option>

                                    @foreach ($cities as $city)

                                        <option
                                            value="{{ $city->id }}"
                                            @selected($city_id == $city->id)
                                        >
                                            {{ $city->name }}
                                        </option>

                                    @endforeach

                                </select>

                                @error('city_id')
                                    <span class="carnate-error">{{ $message }}</span>
                                @enderror

                            </div>

                            {{-- Pincode --}}
                            <div class="col-md-6">

                                <label class="carnate-field-label">
                                    Pincode
                                </label>

                                <input
                                    type="number"
                                    class="carnate-form-control"
                                    wire:model="pincode"
                                    placeholder="Enter Pincode"
                                >

                                @error('pincode')
                                    <span class="carnate-error">{{ $message }}</span>
                                @enderror

                            </div>

                            {{-- Address --}}
                            <div class="col-md-12">

                                <label class="carnate-field-label">
                                    Address
                                </label>

                                <textarea
                                    wire:model="address"
                                    class="carnate-form-control"
                                    placeholder="Enter Address"
                                ></textarea>

                                @error('address')
                                    <span class="carnate-error">{{ $message }}</span>
                                @enderror

                            </div>

                        </div>

                    </div>

                    {{-- Footer --}}
                    <div class="carnate-modal-footer">

                        <button
                            type="button"
                            class="carnate-btn-secondary"
                            wire:click="colseModel"
                        >
                            Cancel
                        </button>

                        <button
                            type="submit"
                            class="carnate-btn-primary carnate-submit-btn"
                        >
                            {{ $isEdit ? 'Update' : 'Create' }}

                            <span
                                wire:loading
                                class="spinner-border spinner-border-sm carnate-spinner"
                            ></span>
                        </button>

                    </div>

                </form>

            </div>

        </div>

    @endif

    {{-- Customer Table --}}
    <div class="carnate-table-card">

        @if (!empty($customers) && $customers->count())

            <div class="carnate-table-header">

                <h5 class="carnate-table-heading">
                    Customers
                </h5>

                <span class="carnate-table-count">
                    {{ $customers->total() }} Total
                </span>

            </div>

            <div class="carnate-table-wrap">

                <table class="carnate-table">

                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile No.</th>
                            <th>Address</th>

                            @if (
                                @$admin->hasPermissionTo('customer-edit') ||
                                @$admin->hasPermissionTo('customer-delete')
                            )
                                <th>Actions</th>
                            @endif

                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($customers as $index => $customer)

                            @php
                                $customerName = trim(($customer->name ?? '') . ' ' . ($customer->lastname ?? ''));
                                $initials = collect(explode(' ', $customerName))
                                    ->filter()
                                    ->map(fn($word) => strtoupper(substr($word, 0, 1)))
                                    ->take(2)
                                    ->implode('');
                            @endphp

                            <tr>

                                {{-- Serial --}}
                                <td>
                                    <span class="carnate-serial">
                                        {{ $customers->total() - ($customers->firstItem() + $index) + 1 }}
                                    </span>
                                </td>

                                {{-- Name --}}
                                <td>

                                    <div class="carnate-customer-cell">

                                        <span class="carnate-avatar">
                                            {{ $initials ?: 'C' }}
                                        </span>

                                        <span class="carnate-customer-name">
                                            {{ $customerName }}
                                        </span>

                                    </div>

                                </td>

                                {{-- Email --}}
                                <td>
                                    <span class="carnate-email">
                                        {{ $customer->email ?? '-' }}
                                    </span>
                                </td>

                                {{-- Mobile --}}
                                <td>
                                    <span class="carnate-mobile">
                                        {{ $customer->mobile_no ?? '-' }}
                                    </span>
                                </td>

                                {{-- Address --}}
                                <td>

                                    <div class="carnate-address">
                                        {{ $customer->address ?? '-' }}
                                    </div>

                                </td>

                                {{-- Actions --}}
                                @if (
                                    @$admin->hasPermissionTo('customer-edit') ||
                                    @$admin->hasPermissionTo('customer-delete')
                                )

                                    <td>

                                        <div class="carnate-actions">

                                            @if (@$admin->hasPermissionTo('customer-edit'))

                                                <a
                                                    href="javascript:;"
                                                    wire:click="edit({{ $customer->id }})"
                                                    class="carnate-action-btn carnate-edit-btn"
                                                    title="Edit Customer"
                                                >
                                                    <i class="bx bx-edit-alt"></i>
                                                </a>

                                            @endif

                                            @if (@$admin->hasPermissionTo('customer-delete'))

                                                <a
                                                    href="javascript:;"
                                                    wire:click="confirmDelete({{ $customer->id }})"
                                                    class="carnate-action-btn carnate-delete-btn"
                                                    title="Delete Customer"
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
            <div class="carnate-pagination">
                {{ $customers->links() }}
            </div>

        @else

            {{-- Empty State --}}
            <div class="carnate-empty">

                <div class="carnate-empty-icon">
                    <i class="bx bx-user"></i>
                </div>

                <h5 class="carnate-empty-title">
                    No Customers Found
                </h5>

                <p class="carnate-empty-text">
                    There are no customers matching your current search.
                </p>

            </div>

        @endif

    </div>

</div>

@section('footerscript')
@endsection