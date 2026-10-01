<div class="carnate-workshop-vendor-page">

    @php
        $admin = App\Models\Admin::where('id', $adminId)->first();
    @endphp

    <style>
        .carnate-workshop-vendor-page {
            --cw-bg: #f7f8fa;
            --cw-card: #ffffff;
            --cw-text: #111827;
            --cw-muted: #64748b;
            --cw-border: #e2e8f0;
            --cw-red: #e53935;
            --cw-red-soft: #fff5f5;
            --cw-green: #16a34a;
            --cw-green-soft: #f0fdf4;
            --cw-amber: #d97706;
            --cw-amber-soft: #fffbeb;
            color: var(--cw-text);
        }

        .carnate-workshop-vendor-page .cw-card {
            background: var(--cw-card);
            border: 1px solid var(--cw-border);
            border-radius: 16px;
            box-shadow: 0 4px 18px rgba(15, 23, 42, 0.04);
        }

        .carnate-workshop-vendor-page .cw-header {
            padding: 20px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .carnate-workshop-vendor-page .cw-title-wrap {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .carnate-workshop-vendor-page .cw-title-icon {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--cw-red-soft);
            color: var(--cw-red);
            font-size: 22px;
        }

        .carnate-workshop-vendor-page .cw-title {
            margin: 0;
            font-size: 20px;
            line-height: 1.3;
            font-weight: 700;
            color: var(--cw-text);
        }

        .carnate-workshop-vendor-page .cw-subtitle {
            margin: 4px 0 0;
            color: var(--cw-muted);
            font-size: 13px;
        }

        .carnate-workshop-vendor-page .cw-btn-primary {
            border: 0;
            background: var(--cw-red);
            color: #fff !important;
            min-height: 42px;
            padding: 0 18px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all .2s ease;
        }

        .carnate-workshop-vendor-page .cw-btn-primary:hover {
            background: #c92f2c;
            transform: translateY(-1px);
            box-shadow: 0 7px 16px rgba(229, 57, 53, .18);
        }

        .carnate-workshop-vendor-page .cw-filter-card {
            margin-top: 16px;
            padding: 18px 20px;
        }

        .carnate-workshop-vendor-page .cw-filter-row {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .carnate-workshop-vendor-page .cw-search {
            max-width: 360px;
            position: relative;
            flex: 1;
        }

        .carnate-workshop-vendor-page .cw-search i {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 18px;
            z-index: 2;
        }

        .carnate-workshop-vendor-page .cw-search input {
            height: 44px;
            border: 1px solid var(--cw-border);
            border-radius: 10px;
            padding-left: 40px;
            color: var(--cw-text);
            box-shadow: none;
        }

        .carnate-workshop-vendor-page .cw-search input:focus {
            border-color: rgba(229, 57, 53, .45);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .08);
        }

        .carnate-workshop-vendor-page .cw-btn-clear {
            height: 44px;
            padding: 0 17px;
            border-radius: 10px;
            border: 1px solid var(--cw-border);
            background: #fff;
            color: var(--cw-muted);
            font-size: 14px;
            font-weight: 600;
        }

        .carnate-workshop-vendor-page .cw-btn-clear:hover {
            background: #f8fafc;
            color: var(--cw-text);
        }

        .carnate-workshop-vendor-page .cw-table-card {
            margin-top: 16px;
            overflow: hidden;
        }

        .carnate-workshop-vendor-page .cw-table-wrap {
            overflow-x: auto;
        }

        .carnate-workshop-vendor-page .cw-table {
            width: 100%;
            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
            min-width: 1050px;
        }

        .carnate-workshop-vendor-page .cw-table thead th {
            background: #f8fafc;
            color: #64748b;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
            padding: 15px 18px;
            border-bottom: 1px solid var(--cw-border);
            white-space: nowrap;
        }

        .carnate-workshop-vendor-page .cw-table tbody td {
            padding: 15px 18px;
            border-bottom: 1px solid #edf1f5;
            color: #334155;
            font-size: 14px;
            vertical-align: middle;
            background: #fff;
        }

        .carnate-workshop-vendor-page .cw-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .carnate-workshop-vendor-page .cw-table tbody tr:hover td {
            background: #fafbfc;
        }

        .carnate-workshop-vendor-page .cw-sno {
            color: #94a3b8 !important;
            font-weight: 600;
            width: 65px;
        }

        .carnate-workshop-vendor-page .cw-vendor {
            display: flex;
            align-items: center;
            gap: 11px;
            min-width: 170px;
        }

        .carnate-workshop-vendor-page .cw-avatar {
            width: 38px;
            height: 38px;
            min-width: 38px;
            border-radius: 11px;
            background: var(--cw-red-soft);
            color: var(--cw-red);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 700;
        }

        .carnate-workshop-vendor-page .cw-vendor-name {
            font-weight: 650;
            color: var(--cw-text);
            line-height: 1.3;
        }

        .carnate-workshop-vendor-page .cw-company {
            font-weight: 600;
            color: #334155;
        }

        .carnate-workshop-vendor-page .cw-muted {
            color: var(--cw-muted);
        }

        .carnate-workshop-vendor-page .cw-role {
            display: inline-flex;
            align-items: center;
            min-height: 28px;
            padding: 4px 10px;
            border-radius: 7px;
            background: #f1f5f9;
            color: #475569;
            font-size: 12px;
            font-weight: 600;
        }

        .carnate-workshop-vendor-page .cw-parent {
            color: #475569;
            font-size: 13px;
        }

        .carnate-workshop-vendor-page .cw-actions {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .carnate-workshop-vendor-page .cw-action {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            border: 1px solid var(--cw-border);
            background: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all .2s ease;
        }

        .carnate-workshop-vendor-page .cw-action-edit {
            color: #475569;
        }

        .carnate-workshop-vendor-page .cw-action-edit:hover {
            color: var(--cw-red);
            border-color: rgba(229, 57, 53, .25);
            background: var(--cw-red-soft);
        }

        .carnate-workshop-vendor-page .cw-action-delete {
            color: #64748b;
        }

        .carnate-workshop-vendor-page .cw-action-delete:hover {
            color: #dc2626;
            border-color: #fecaca;
            background: #fef2f2;
        }

        .carnate-workshop-vendor-page .cw-pagination {
            padding: 17px 20px;
            border-top: 1px solid var(--cw-border);
            background: #fff;
        }

        .carnate-workshop-vendor-page .cw-empty {
            padding: 55px 20px;
            text-align: center;
        }

        .carnate-workshop-vendor-page .cw-empty-icon {
            width: 58px;
            height: 58px;
            margin: 0 auto 13px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f1f5f9;
            color: #94a3b8;
            font-size: 25px;
        }

        .carnate-workshop-vendor-page .cw-empty-title {
            font-size: 15px;
            font-weight: 700;
            color: var(--cw-text);
        }

        .carnate-workshop-vendor-page .cw-empty-text {
            margin-top: 5px;
            color: var(--cw-muted);
            font-size: 13px;
        }

        /* Modal */
        .carnate-workshop-vendor-page .cw-modal-backdrop {
            position: fixed;
            inset: 0;
            z-index: 1055;
            background: rgba(15, 23, 42, .55);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            overflow-y: auto;
        }

        .carnate-workshop-vendor-page .cw-modal {
            width: 100%;
            max-width: 900px;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 24px 70px rgba(15, 23, 42, .20);
            overflow: hidden;
        }

        .carnate-workshop-vendor-page .cw-modal-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--cw-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .carnate-workshop-vendor-page .cw-modal-title-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .carnate-workshop-vendor-page .cw-modal-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: var(--cw-red-soft);
            color: var(--cw-red);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .carnate-workshop-vendor-page .cw-modal-title {
            margin: 0;
            font-size: 18px;
            font-weight: 700;
            color: var(--cw-text);
        }

        .carnate-workshop-vendor-page .cw-modal-close {
            width: 36px;
            height: 36px;
            border: 0;
            border-radius: 9px;
            background: #f8fafc;
            color: #64748b;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .carnate-workshop-vendor-page .cw-modal-close:hover {
            background: #f1f5f9;
            color: var(--cw-text);
        }

        .carnate-workshop-vendor-page .cw-modal-body {
            padding: 24px;
            max-height: calc(100vh - 190px);
            overflow-y: auto;
        }

        .carnate-workshop-vendor-page .cw-section {
            padding: 17px;
            border: 1px solid var(--cw-border);
            border-radius: 13px;
            margin-bottom: 18px;
        }

        .carnate-workshop-vendor-page .cw-section:last-child {
            margin-bottom: 0;
        }

        .carnate-workshop-vendor-page .cw-section-title {
            margin: 0 0 15px;
            font-size: 13px;
            font-weight: 700;
            color: var(--cw-text);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .carnate-workshop-vendor-page .cw-section-title i {
            color: var(--cw-red);
            font-size: 17px;
        }

        .carnate-workshop-vendor-page .form-label {
            color: #334155;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 7px;
        }

        .carnate-workshop-vendor-page .form-control,
        .carnate-workshop-vendor-page .form-select {
            min-height: 43px;
            border: 1px solid var(--cw-border);
            border-radius: 9px;
            color: var(--cw-text);
            box-shadow: none;
            font-size: 14px;
        }

        .carnate-workshop-vendor-page textarea.form-control {
            min-height: 90px;
            resize: vertical;
        }

        .carnate-workshop-vendor-page .form-control:focus,
        .carnate-workshop-vendor-page .form-select:focus {
            border-color: rgba(229, 57, 53, .45);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .08);
        }

        .carnate-workshop-vendor-page .cw-required {
            color: var(--cw-red);
        }

        .carnate-workshop-vendor-page .cw-error {
            display: block;
            margin-top: 5px;
            color: #dc2626;
            font-size: 12px;
        }

        .carnate-workshop-vendor-page .cw-modal-footer {
            padding: 17px 24px;
            border-top: 1px solid var(--cw-border);
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
        }

        .carnate-workshop-vendor-page .cw-btn-secondary {
            min-height: 42px;
            padding: 0 17px;
            border-radius: 9px;
            border: 1px solid var(--cw-border);
            background: #fff;
            color: #475569;
            font-size: 14px;
            font-weight: 600;
        }

        .carnate-workshop-vendor-page .cw-btn-secondary:hover {
            background: #f8fafc;
            color: var(--cw-text);
        }

        .carnate-workshop-vendor-page .cw-password {
            position: relative;
        }

        .carnate-workshop-vendor-page .cw-password .cw-password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            border: 0;
            background: transparent;
            color: #94a3b8;
            cursor: pointer;
            z-index: 2;
        }

        .carnate-workshop-vendor-page .cw-password input {
            padding-right: 42px;
        }

        .carnate-workshop-vendor-page .cw-gst-note {
            margin-top: 5px;
            font-size: 11px;
            color: var(--cw-muted);
        }

        @media (max-width: 767px) {
            .carnate-workshop-vendor-page .cw-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .carnate-workshop-vendor-page .cw-btn-primary {
                width: 100%;
                justify-content: center;
            }

            .carnate-workshop-vendor-page .cw-filter-row {
                flex-direction: column;
                align-items: stretch;
            }

            .carnate-workshop-vendor-page .cw-search {
                max-width: none;
            }

            .carnate-workshop-vendor-page .cw-btn-clear {
                width: 100%;
            }

            .carnate-workshop-vendor-page .cw-modal-backdrop {
                padding: 10px;
                align-items: flex-start;
            }

            .carnate-workshop-vendor-page .cw-modal-body {
                padding: 16px;
            }
        }
    </style>

    {{-- Success Message --}}
    @if (session()->has('message'))
        <div class="alert alert-success border-0 rounded-3 mb-3">
            <i class="bx bx-check-circle me-1"></i>
            {{ session('message') }}
        </div>
    @endif

    {{-- Add / Edit Modal --}}
    @if ($showModal)
        <div class="cw-modal-backdrop">
            <div class="cw-modal">

                <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">

                    <div class="cw-modal-header">
                        <div class="cw-modal-title-wrap">
                            <div class="cw-modal-icon">
                                <i class="bx bx-store"></i>
                            </div>

                            <div>
                                <h4 class="cw-modal-title">
                                    {{ $isEdit ? 'Edit Work Shop Vendor' : 'Create Work Shop Vendor' }}
                                </h4>
                            </div>
                        </div>

                        <button type="button"
                            class="cw-modal-close"
                            wire:click="closeModel"
                            aria-label="Close">
                            <i class="bx bx-x"></i>
                        </button>
                    </div>

                    <div class="cw-modal-body">
                        @csrf

                        {{-- Personal Information --}}
                        <div class="cw-section">
                            <div class="cw-section-title">
                                <i class="bx bx-user"></i>
                                Personal Information
                            </div>

                            <div class="row g-3">

                                {{-- First Name --}}
                                <div class="col-md-6">
                                    <label for="first_name" class="form-label">
                                        First Name <span class="cw-required">*</span>
                                    </label>

                                    <div class="input-group">
                                        <select name="user_title"
                                            id="user_title"
                                            wire:model="user_title"
                                            class="form-select"
                                            style="max-width:90px;">
                                            <option value="mr">Mr.</option>
                                            <option value="mrs">Mrs.</option>
                                            <option value="miss">Miss</option>
                                            <option value="ms">M.S.</option>
                                        </select>

                                        <input type="text"
                                            wire:model="name"
                                            name="first_name"
                                            id="first_name"
                                            class="form-control"
                                            placeholder="Enter First Name">
                                    </div>

                                    @if ($errors->has('name') || $errors->has('user_title'))
                                        <span class="cw-error">
                                            {{ $errors->first('name') ?? $errors->first('user_title') }}
                                        </span>
                                    @endif
                                </div>

                                {{-- Last Name --}}
                                <div class="col-md-6">
                                    <label class="form-label">
                                        Last Name <span class="cw-required">*</span>
                                    </label>

                                    <input type="text"
                                        wire:model="lastname"
                                        class="form-control"
                                        placeholder="Enter Last Name">

                                    @error('lastname')
                                        <span class="cw-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Email --}}
                                <div class="col-md-6">
                                    <label class="form-label">
                                        Email <span class="cw-required">*</span>
                                    </label>

                                    <input type="email"
                                        wire:model="email"
                                        class="form-control"
                                        placeholder="Enter Email">

                                    @error('email')
                                        <span class="cw-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Mobile --}}
                                <div class="col-md-6">
                                    <label class="form-label">
                                        Mobile Number <span class="cw-required">*</span>
                                    </label>

                                    <input type="text"
                                        wire:model="mobile_no"
                                        class="form-control"
                                        placeholder="Enter Mobile Number">

                                    @error('mobile_no')
                                        <span class="cw-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Birth Date --}}
                                <div class="col-md-6">
                                    <label class="form-label">Birth Date</label>

                                    <input type="date"
                                        wire:model="birth_date"
                                        class="form-control">

                                    @error('birth_date')
                                        <span class="cw-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Password --}}
                                @if ($isEdit == false)
                                    <div class="col-md-6">
                                        <label for="inputChoosePassword" class="form-label">
                                            Password <span class="cw-required">*</span>
                                        </label>

                                        <div class="cw-password">
                                            <input type="password"
                                                wire:model="password"
                                                class="form-control"
                                                id="inputChoosePassword"
                                                placeholder="Enter Password"
                                                autocomplete="password">

                                            <button type="button"
                                                class="cw-password-toggle"
                                                onclick="togglePassword()">
                                                <i class="bx bx-hide" id="password-icon"></i>
                                            </button>
                                        </div>

                                        @error('password')
                                            <span class="cw-error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endif

                            </div>
                        </div>

                        {{-- Business Information --}}
                        <div class="cw-section">
                            <div class="cw-section-title">
                                <i class="bx bx-buildings"></i>
                                Business Information
                            </div>

                            <div class="row g-3">

                                {{-- Company --}}
                                <div class="col-md-6">
                                    <label class="form-label">
                                        Company Name <span class="cw-required">*</span>
                                    </label>

                                    <input type="text"
                                        wire:model="company_name"
                                        class="form-control"
                                        placeholder="Enter Company Name">

                                    @error('company_name')
                                        <span class="cw-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- GST Billing --}}
                                <div class="col-md-6">
                                    <label class="form-label">GST Billing</label>

                                    <select id="is_gst"
                                        class="form-select"
                                        wire:model="is_gst">
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>

                                    @error('is_gst')
                                        <span class="cw-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- GST Number --}}
                                <div class="col-md-6"
                                    id="gst_number_div"
                                    style="{{ $is_gst == 1 ? 'display:block;' : 'display:none;' }}">

                                    <label class="form-label">GST Number</label>

                                    <input type="text"
                                        id="gst_no"
                                        wire:model="gst_no"
                                        class="form-control"
                                        placeholder="Enter GST Number"
                                        {{ $is_gst == 1 ? '' : 'disabled' }}>

                                    <div class="cw-gst-note">
                                        GST number is required only when GST Billing is enabled.
                                    </div>

                                    @error('gst_no')
                                        <span class="cw-error">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        {{-- Address --}}
                        <div class="cw-section">
                            <div class="cw-section-title">
                                <i class="bx bx-map"></i>
                                Location & Address
                            </div>

                            <div class="row g-3">

                                {{-- Country --}}
                                <div class="col-md-6">
                                    <label class="form-label">
                                        Country <span class="cw-required">*</span>
                                    </label>

                                    <select class="form-select searchable-select"
                                        data-placeholder="Select Country"
                                        wire:change="stateData($event.target.value)"
                                        wire:model="country_id">

                                        <option value="">Select Country</option>

                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}">
                                                {{ $country->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('country_id')
                                        <span class="cw-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- State --}}
                                <div class="col-md-6">
                                    <label class="form-label">
                                        State <span class="cw-required">*</span>
                                    </label>

                                    <select class="form-select searchable-select"
                                        data-placeholder="Select State"
                                        wire:model="state_id"
                                        wire:change="cityData($event.target.value)">

                                        <option value="">Select State</option>

                                        @foreach ($states as $state)
                                            <option value="{{ $state->id }}"
                                                @selected($state_id == $state->id)>
                                                {{ $state->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('state_id')
                                        <span class="cw-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- City --}}
                                <div class="col-md-6">
                                    <label class="form-label">
                                        City <span class="cw-required">*</span>
                                    </label>

                                    <select class="form-select searchable-select"
                                        data-placeholder="Select City"
                                        wire:model="city_id">

                                        <option value="">Select City</option>

                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}"
                                                @selected($city_id == $city->id)>
                                                {{ $city->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('city_id')
                                        <span class="cw-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Pincode --}}
                                <div class="col-md-6">
                                    <label class="form-label">
                                        Pincode <span class="cw-required">*</span>
                                    </label>

                                    <input type="number"
                                        class="form-control"
                                        wire:model="pincode"
                                        placeholder="Enter Pincode">

                                    @error('pincode')
                                        <span class="cw-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Address --}}
                                <div class="col-md-12">
                                    <label class="form-label">
                                        Address <span class="cw-required">*</span>
                                    </label>

                                    <textarea wire:model="address"
                                        class="form-control"
                                        placeholder="Enter Address"></textarea>

                                    @error('address')
                                        <span class="cw-error">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        {{-- Trial --}}
                        <div class="cw-section">
                            <div class="cw-section-title">
                                <i class="bx bx-time-five"></i>
                                Trial Settings
                            </div>

                            <div class="row g-3">

                                {{-- Trial --}}
                                <div class="col-md-6">
                                    <label class="form-label">Trial</label>

                                    <select class="form-select"
                                        wire:model="is_trial"
                                        wire:change="trialData($event.target.value)">

                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>

                                {{-- Trial Days --}}
                                <div class="col-md-6">
                                    <label class="form-label">Trial Days</label>

                                    <input type="text"
                                        wire:model="trial_days"
                                        class="form-control"
                                        placeholder="Enter Trial Days"
                                        @if (!$is_trial) disabled @endif>

                                    @error('trial_days')
                                        <span class="cw-error">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="cw-modal-footer">
                        <button type="button"
                            class="cw-btn-secondary"
                            wire:click="closeModel">
                            Cancel
                        </button>

                        <button type="submit" class="cw-btn-primary">
                            <span>{{ $isEdit ? 'Update' : 'Create' }}</span>
                            <i class="spinner-border spinner-border-sm"
                                wire:loading></i>
                        </button>
                    </div>

                </form>
            </div>
        </div>
    @endif

    {{-- Page Header --}}
    <div class="cw-card cw-header">

        <div class="cw-title-wrap">
            <div class="cw-title-icon">
                <i class="bx bx-store"></i>
            </div>

            <div>
                <h1 class="cw-title">Work Shop Vendor</h1>
                <p class="cw-subtitle">
                    Manage workshop vendors and their business information
                </p>
            </div>
        </div>

        @if (@$admin->hasPermissionTo('work-shop-vendor-add'))
            <button type="button"
                wire:click="create"
                class="cw-btn-primary">
                <i class="bx bx-plus"></i>
                Add Vendor
            </button>
        @endif

    </div>

    {{-- Search --}}
    <div class="cw-card cw-filter-card">

        <div class="cw-filter-row">

            <div class="cw-search">
                <i class="bx bx-search"></i>

                <input type="text"
                    class="form-control"
                    placeholder="Search vendor by name..."
                    wire:model.live="searchfilter">
            </div>

            <button type="button"
                class="cw-btn-clear"
                wire:click="resetFilter">
                <i class="bx bx-reset me-1"></i>
                Clear
            </button>

        </div>

    </div>

    {{-- Vendor Table --}}
    <div class="cw-card cw-table-card">

        @if (!empty($vendors) && $vendors->count())

            <div class="cw-table-wrap">

                <table class="cw-table">

                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Name</th>
                            <th>Company Name</th>
                            <th>Email</th>
                            <th>Mobile Number</th>
                            <th>City</th>
                            <th>Role</th>
                            <th>Parent Vendor</th>

                            @if (
                                @$admin->hasPermissionTo('work-shop-vendor-edit') ||
                                @$admin->hasPermissionTo('work-shop-vendor-delete')
                            )
                                <th>Actions</th>
                            @endif
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($vendors as $index => $vendor)

                            <tr>

                                <td class="cw-sno">
                                    {{ $vendors->total() - ($vendors->firstItem() + $index) + 1 }}
                                </td>

                                {{-- Name --}}
                                <td>
                                    <div class="cw-vendor">

                                        <div class="cw-avatar">
                                            {{ strtoupper(substr($vendor->name ?? 'V', 0, 1) . substr($vendor->lastname ?? '', 0, 1)) }}
                                        </div>

                                        <div>
                                            <div class="cw-vendor-name">
                                                {{ $vendor->name . ' ' . $vendor->lastname }}
                                            </div>
                                        </div>

                                    </div>
                                </td>

                                {{-- Company --}}
                                <td>
                                    <span class="cw-company">
                                        {{ $vendor->company_name ?? 'N/A' }}
                                    </span>
                                </td>

                                {{-- Email --}}
                                <td>
                                    <span class="cw-muted">
                                        {{ $vendor->email }}
                                    </span>
                                </td>

                                {{-- Mobile --}}
                                <td>
                                    {{ $vendor->mobile_no }}
                                </td>

                                {{-- City --}}
                                <td>
                                    {{ $vendor->cityName ? $vendor->cityName->name : 'NA' }}
                                </td>

                                {{-- Role --}}
                                <td>
                                    <span class="cw-role">
                                        {{ $vendor->getRoleNames()->implode(', ') }}
                                    </span>
                                </td>

                                {{-- Parent --}}
                                <td>
                                    <span class="cw-parent">
                                        {{ $vendor->parent?->name . ' ' . $vendor->parent?->lastname }}
                                    </span>
                                </td>

                                {{-- Actions --}}
                                @if (
                                    @$admin->hasPermissionTo('work-shop-vendor-edit') ||
                                    @$admin->hasPermissionTo('work-shop-vendor-delete')
                                )
                                    <td>

                                        <div class="cw-actions">

                                            @if (@$admin->hasPermissionTo('work-shop-vendor-edit'))
                                                <a wire:click="edit({{ $vendor->id }})"
                                                    class="cw-action cw-action-edit"
                                                    title="Edit">
                                                    <i class="bx bx-edit-alt"></i>
                                                </a>
                                            @endif

                                            @if (@$admin->hasPermissionTo('work-shop-vendor-delete'))
                                                <a wire:click="confirmDelete({{ $vendor->id }})"
                                                    class="cw-action cw-action-delete"
                                                    title="Delete">
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

            <div class="cw-pagination">
                {{ $vendors->links() }}
            </div>

        @else

            <div class="cw-empty">

                <div class="cw-empty-icon">
                    <i class="bx bx-store"></i>
                </div>

                <div class="cw-empty-title">
                    No Work Shop Vendor found!
                </div>

                <div class="cw-empty-text">
                    Workshop vendors will appear here once they are added.
                </div>

            </div>

        @endif

    </div>

</div>


@section('footerscript')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        initWorkshopVendorScripts();
    });

    document.addEventListener('livewire:navigated', function () {
        initWorkshopVendorScripts();
    });

    function initWorkshopVendorScripts() {
        toggleGstField();
    }

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

    function togglePassword() {
        const passwordInput = document.getElementById('inputChoosePassword');
        const passwordIcon = document.getElementById('password-icon');

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

    document.addEventListener('change', function (event) {
        if (event.target && event.target.id === 'is_gst') {
            toggleGstField();
        }
    });
</script>

@endsection