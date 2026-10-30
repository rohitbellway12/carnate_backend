{{-- Modern Carnate Customer Add Form Component --}}
<div class="ca-customer-form-wrapper">

    <style>
        .ca-customer-form-wrapper {
            --caf-primary: #e53935;
            --caf-primary-hover: #d32f2f;
            --caf-primary-soft: #fff5f5;
            --caf-primary-border: #fecdd3;
            --caf-border: #e2e8f0;
            --caf-text: #1e293b;
            --caf-muted: #64748b;
            --caf-bg-subtle: #f8fafc;
        }

        .ca-cust-type-card-group {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
            margin-bottom: 22px;
        }

        @media (max-width: 576px) {
            .ca-cust-type-card-group {
                grid-template-columns: 1fr;
            }
        }

        .ca-cust-type-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 13px 16px;
            border: 1.5px solid var(--caf-border);
            border-radius: 12px;
            background: #ffffff;
            cursor: pointer;
            transition: all 0.2s ease;
            user-select: none;
            margin: 0;
            position: relative;
        }

        .ca-cust-type-item:hover {
            border-color: #cbd5e1;
            background: #fafbfc;
        }

        .ca-cust-type-item.active {
            border-color: var(--caf-primary);
            background: var(--caf-primary-soft);
            box-shadow: 0 4px 14px rgba(229, 57, 53, 0.08);
        }

        .ca-cust-type-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: #f1f5f9;
            color: #475569;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
            transition: all 0.2s ease;
        }

        .ca-cust-type-item.active .ca-cust-type-icon {
            background: var(--caf-primary);
            color: #ffffff;
        }

        .ca-cust-type-text {
            flex: 1;
        }

        .ca-cust-type-name {
            display: block;
            font-size: 13.5px;
            font-weight: 700;
            color: var(--caf-text);
            line-height: 1.25;
        }

        .ca-cust-type-desc {
            display: block;
            font-size: 11px;
            color: var(--caf-muted);
            margin-top: 2px;
        }

        .ca-cust-type-check {
            font-size: 20px;
            color: #cbd5e1;
            transition: all 0.2s ease;
        }

        .ca-cust-type-item.active .ca-cust-type-check {
            color: var(--caf-primary);
        }

        .ca-form-card {
            background: #ffffff;
            border: 1px solid var(--caf-border);
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(15, 23, 42, 0.03);
            overflow: hidden;
            margin-bottom: 20px;
            transition: border-color 0.2s ease;
        }

        .ca-form-card:hover {
            border-color: #cbd5e1;
        }

        .ca-form-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 13px 18px;
            background: var(--caf-bg-subtle);
            border-bottom: 1px solid var(--caf-border);
        }

        .ca-form-card-header-left {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .ca-form-card-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: var(--caf-primary-soft);
            color: var(--caf-primary);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
            border: 1px solid var(--caf-primary-border);
        }

        .ca-form-card-title {
            margin: 0;
            font-size: 13.5px;
            font-weight: 700;
            color: var(--caf-text);
            line-height: 1.2;
        }

        .ca-form-card-sub {
            font-size: 11px;
            color: var(--caf-muted);
            display: block;
            margin-top: 2px;
        }

        .ca-badge-pill {
            font-size: 11px;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .ca-badge-pill.required {
            color: var(--caf-primary);
            background: var(--caf-primary-soft);
            border: 1px solid var(--caf-primary-border);
        }

        .ca-badge-pill.optional {
            color: var(--caf-muted);
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
        }

        .ca-form-card-body {
            padding: 18px 20px;
        }

        .ca-input-label {
            font-size: 12px;
            font-weight: 600;
            color: #334155;
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .ca-input-label .req {
            color: var(--caf-primary);
            font-weight: 700;
        }

        .ca-customer-form-wrapper .form-control,
        .ca-customer-form-wrapper .form-select {
            min-height: 40px;
            border-radius: 8px;
            border: 1px solid #cbd5e1;
            font-size: 13px;
            color: var(--caf-text);
            background-color: #ffffff;
            transition: all 0.15s ease;
            box-shadow: none !important;
        }

        .ca-customer-form-wrapper .form-control:focus,
        .ca-customer-form-wrapper .form-select:focus {
            border-color: var(--caf-primary) !important;
            box-shadow: 0 0 0 3px rgba(229, 57, 53, 0.12) !important;
        }

        .ca-customer-form-wrapper textarea.form-control {
            min-height: 68px;
        }

        .ca-customer-form-wrapper .input-group-text {
            background: #f8fafc;
            border: 1px solid #cbd5e1;
            color: #64748b;
            font-weight: 600;
            font-size: 12.5px;
            border-radius: 8px 0 0 8px;
        }

        .ca-vin-btn {
            background: linear-gradient(135deg, #e53935, #c62828);
            color: #ffffff !important;
            border: 1px solid #c62828;
            border-radius: 0 8px 8px 0;
            padding: 0 16px;
            font-size: 12.5px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            transition: all 0.2s ease;
            white-space: nowrap;
        }

        .ca-vin-btn:hover {
            background: linear-gradient(135deg, #d32f2f, #b71c1c);
            box-shadow: 0 3px 8px rgba(229, 57, 53, 0.25);
        }

        .ca-vin-hint {
            display: block;
            margin-top: 5px;
            font-size: 11px;
            color: var(--caf-muted);
        }

        .ca-selected-veh-banner {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #15803d;
            border-radius: 8px;
            padding: 9px 14px;
            font-size: 12.5px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 10px;
        }

        .ca-selected-veh-banner i {
            font-size: 17px;
            color: #16a34a;
        }

        .ca-toggle-opt-container {
            display: flex;
            justify-content: center;
            margin: 18px 0 20px;
        }

        .ca-toggle-opt-btn {
            background: #ffffff !important;
            border: 1.5px dashed #cbd5e1 !important;
            color: #334155 !important;
            font-size: 13px !important;
            font-weight: 600 !important;
            padding: 10px 24px !important;
            border-radius: 30px !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 8px !important;
            cursor: pointer !important;
            transition: all 0.22s ease !important;
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.05) !important;
            text-decoration: none !important;
        }

        .ca-toggle-opt-btn:hover,
        .ca-toggle-opt-btn:focus {
            border: 1.5px solid #e53935 !important;
            background: linear-gradient(135deg, #e53935, #c62828) !important;
            color: #ffffff !important;
            box-shadow: 0 4px 14px rgba(229, 57, 53, 0.28) !important;
            transform: translateY(-1px) !important;
        }

        .ca-toggle-opt-btn i {
            font-size: 18px !important;
            color: #e53935 !important;
            transition: all 0.2s ease !important;
        }

        .ca-toggle-opt-btn:hover i,
        .ca-toggle-opt-btn:focus i {
            color: #ffffff !important;
        }

        .ca-toggle-opt-btn span {
            color: inherit !important;
        }

        .ca-error-msg {
            color: #dc2626;
            font-size: 11px;
            margin-top: 4px;
            display: block;
            font-weight: 500;
        }
    </style>

    {{-- Customer Type Switcher --}}
    <div class="ca-cust-type-card-group">
        <label class="ca-cust-type-item {{ (string)$cust_type === '0' || $cust_type === 0 ? 'active' : '' }}" for="cust_type_indiv">
            <input type="radio" class="d-none" id="cust_type_indiv" wire:model.live="cust_type" value="0">
            <div class="ca-cust-type-icon">
                <i class="bx bx-user"></i>
            </div>
            <div class="ca-cust-type-text">
                <span class="ca-cust-type-name">Individual Customer</span>
                <span class="ca-cust-type-desc">Personal vehicle owner (No GST required)</span>
            </div>
            <div class="ca-cust-type-check">
                <i class="bx {{ (string)$cust_type === '0' || $cust_type === 0 ? 'bxs-check-circle' : 'bx-circle' }}"></i>
            </div>
        </label>

        <label class="ca-cust-type-item {{ (string)$cust_type === '1' || $cust_type === 1 ? 'active' : '' }}" for="cust_type_corp">
            <input type="radio" class="d-none" id="cust_type_corp" wire:model.live="cust_type" value="1">
            <div class="ca-cust-type-icon">
                <i class="bx bx-buildings"></i>
            </div>
            <div class="ca-cust-type-text">
                <span class="ca-cust-type-name">Company / Corporate</span>
                <span class="ca-cust-type-desc">Business, Fleet or Commercial client (GST available)</span>
            </div>
            <div class="ca-cust-type-check">
                <i class="bx {{ (string)$cust_type === '1' || $cust_type === 1 ? 'bxs-check-circle' : 'bx-circle' }}"></i>
            </div>
        </label>
    </div>

    {{-- SECTION 1: Personal or Company Details --}}
    <div class="ca-form-card">
        <div class="ca-form-card-header">
            <div class="ca-form-card-header-left">
                <div class="ca-form-card-icon">
                    <i class="bx {{ $show_company_name ? 'bx-buildings' : 'bx-user' }}"></i>
                </div>
                <div>
                    <h6 class="ca-form-card-title">{{ $show_company_name ? 'Company Details' : 'Personal Details' }}</h6>
                    <span class="ca-form-card-sub">Contact and customer identification information</span>
                </div>
            </div>
            <span class="ca-badge-pill required">
                <i class="bx bxs-circle" style="font-size: 6px;"></i> Required
            </span>
        </div>

        <div class="ca-form-card-body">
            <div class="row g-3">

                @if ($show_company_name)
                    {{-- Company Name --}}
                    <div class="col-md-6">
                        <label class="ca-input-label" for="company_name">
                            Company Name <span class="req">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">M/S</span>
                            <input type="text" class="form-control" name="company_name" id="company_name"
                                wire:model="company_name" placeholder="Enter Company Name">
                        </div>
                        @error('company_name')
                            <span class="ca-error-msg">{{ $message }}</span>
                        @enderror
                    </div>
                @else
                    {{-- First Name --}}
                    <div class="col-md-6">
                        <label class="ca-input-label" for="first_name">
                            First Name <span class="req">*</span>
                        </label>
                        <div class="input-group">
                            <select name="user_title" id="user_title" wire:model="user_title" class="form-select" style="max-width: 85px;">
                                <option value="mr">Mr.</option>
                                <option value="mrs">Mrs.</option>
                                <option value="miss">Miss</option>
                                <option value="ms">M/S</option>
                            </select>
                            <input type="text" wire:model="name" name="first_name" id="first_name" class="form-control" placeholder="Enter First Name">
                        </div>
                        @if ($errors->has('name') || $errors->has('user_title'))
                            <span class="ca-error-msg">
                                {{ $errors->first('name') ?? $errors->first('user_title') }}
                            </span>
                        @endif
                    </div>

                    {{-- Last Name --}}
                    <div class="col-md-6">
                        <label class="ca-input-label">
                            Last Name
                        </label>
                        <input type="text" wire:model="lastname" class="form-control" placeholder="Enter Last Name">
                        @error('lastname')
                            <span class="ca-error-msg">{{ $message }}</span>
                        @enderror
                    </div>
                @endif

                {{-- Mobile Number --}}
                <div class="col-md-6">
                    <label class="ca-input-label">
                        Mobile Number <span class="req">*</span>
                    </label>
                    <input type="number" wire:model="mobile_no" class="form-control" placeholder="Enter 10-digit Mobile Number">
                    @error('mobile_no')
                        <span class="ca-error-msg">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="col-md-6">
                    <label class="ca-input-label">
                        Email Address
                    </label>
                    <input type="email" wire:model="email" class="form-control" placeholder="Enter Email Address">
                    @error('email')
                        <span class="ca-error-msg">{{ $message }}</span>
                    @enderror
                </div>

                @if (!$show_company_name)
                    {{-- Birth Date (Individual only) --}}
                    <div class="col-md-6">
                        <label class="ca-input-label">
                            Birth Date
                        </label>
                        <input type="date" wire:model="birth_date" class="form-control"
                            max="{{ \Carbon\Carbon::today()->toDateString() }}" onclick="this.showPicker()">
                        @error('birth_date')
                            <span class="ca-error-msg">{{ $message }}</span>
                        @enderror
                    </div>
                @endif

                {{-- GST Number (HIDDEN for Individual, only shown for Company) --}}
                @if ($show_company_name)
                    <div class="col-md-6">
                        <label class="ca-input-label">
                            GST Number
                        </label>
                        <input type="text" wire:model="gst_no" class="form-control text-uppercase"
                            placeholder="e.g. 22AAAAA0000A1Z5"
                            oninput="this.value = this.value.toUpperCase()">
                        @error('gst_no')
                            <span class="ca-error-msg">{{ $message }}</span>
                        @enderror
                    </div>
                @endif

                {{-- Address --}}
                <div class="col-12">
                    <label class="ca-input-label">
                        Address
                    </label>
                    <textarea wire:model="address" class="form-control" placeholder="Enter full address..."></textarea>
                    @error('address')
                        <span class="ca-error-msg">{{ $message }}</span>
                    @enderror
                </div>

            </div>
        </div>
    </div>

    {{-- SECTION 2: Vehicle Details --}}
    <div class="ca-form-card">
        <div class="ca-form-card-header">
            <div class="ca-form-card-header-left">
                <div class="ca-form-card-icon">
                    <i class="bx bx-car"></i>
                </div>
                <div>
                    <h6 class="ca-form-card-title">Vehicle Details</h6>
                    <span class="ca-form-card-sub">Registration, VIN and vehicle specifications</span>
                </div>
            </div>
            <span class="ca-badge-pill required">
                <i class="bx bxs-circle" style="font-size: 6px;"></i> Required
            </span>
        </div>

        <div class="ca-form-card-body">
            <div class="row g-3">

                {{-- Number Plate --}}
                <div class="col-md-5">
                    <label class="ca-input-label">
                        Number Plate <span class="req">*</span>
                    </label>
                    <input type="text" wire:model="numberPlate" class="form-control text-uppercase" id="numberPlate"
                        placeholder="e.g. MH12AB1234"
                        oninput="this.value = this.value.toUpperCase().replace(/[^A-Z0-9]/g, '')">
                    @error('numberPlate')
                        <span class="ca-error-msg">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Chassis No / VIN --}}
                <div class="col-md-7">
                    <label class="ca-input-label">
                        Chassis No (VIN) <span class="req">*</span>
                    </label>
                    <div class="input-group">
                        <input type="text" wire:model="chassisNo" maxlength="17" class="form-control text-uppercase"
                            placeholder="Enter 17-digit Chassis No / VIN"
                            oninput="this.value = this.value.toUpperCase().replace(/[^A-Z0-9]/g, '').slice(0, 17)">
                        <button type="button" class="ca-vin-btn" wire:click="fetchVehicleByVin" wire:loading.attr="disabled">
                            <span wire:loading.remove wire:target="fetchVehicleByVin"><i class="bx bx-search"></i> Fetch Details</span>
                            <span wire:loading wire:target="fetchVehicleByVin"><span class="spinner-border spinner-border-sm me-1"></span> Fetching...</span>
                        </button>
                    </div>
                    <span class="ca-vin-hint">Enter exact 17-digit Chassis No / VIN and click 'Fetch Details' to auto-fill</span>
                    @error('chassisNo')
                        <span class="ca-error-msg">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Vehicle Model / Specification Selects --}}
                <div class="col-12">
                    <label class="ca-input-label">
                        Vehicle Specification <span class="req">*</span>
                    </label>
                    <div class="row g-2">
                        {{-- Brand --}}
                        <div class="col-md-3">
                            <select class="form-select searchable-select" data-placeholder="Select Brand" wire:model.live="brand_name">
                                <option value="">Select Brand</option>
                                @foreach ($brands as $brand)
                                    @php
                                        $brandJson = json_encode($brand);
                                        $bId = is_array($brand) ? ($brand['id'] ?? null) : ($brand->id ?? null);
                                        $isBrandSel = ((string)$brand_name === (string)$brandJson) || (isset($selectedBrandId) && $bId == $selectedBrandId);
                                    @endphp
                                    <option value="{{ $brandJson }}" {{ $isBrandSel ? 'selected' : '' }}>
                                        {{ is_array($brand) ? $brand['name'] : $brand->name ?? $brand }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Variant / Model --}}
                        <div class="col-md-3">
                            <select class="form-select searchable-select" data-placeholder="Select Model" wire:model.live="variant_name"
                                @if(empty($variants)) disabled @endif>
                                <option value="">Select Model</option>
                                @foreach ($variants as $index => $variant)
                                    @php
                                        $vId = is_array($variant) ? ($variant['id'] ?? null) : ($variant->id ?? null);
                                        $isVarSel = ((string)$variant_name === (string)$index) || (isset($selectedModelId) && $vId == $selectedModelId);
                                    @endphp
                                    <option value="{{ $index }}" {{ $isVarSel ? 'selected' : '' }}>
                                        {{ is_array($variant) ? $variant['name'] : $variant->name ?? $variant }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Year --}}
                        <div class="col-md-2">
                            <select class="form-select searchable-select" data-placeholder="Select Year" wire:model.live="selected_year"
                                @if(empty($years)) disabled @endif>
                                <option value="">Select Year</option>
                                @foreach ($years as $year)
                                    @php
                                        $yVal = is_array($year) ? ($year['value'] ?? '') : $year;
                                        $yLbl = is_array($year) ? ($year['label'] ?? '') : $year;
                                        $isYrSel = ((string)$selected_year === (string)$yVal);
                                    @endphp
                                    <option value="{{ $yVal }}" {{ $isYrSel ? 'selected' : '' }}>
                                        {{ $yLbl }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Modification --}}
                        <div class="col-md-4">
                            <select class="form-select searchable-select" data-placeholder="Select Modification" wire:model.live="search_vehicle"
                                @if(empty($modifications)) disabled @endif>
                                <option value="">Select Modification</option>
                                @foreach ($modifications as $index => $mod)
                                    @php
                                        $mId = is_array($mod) ? ($mod['id'] ?? null) : $index;
                                        $isModSel = ((string)$search_vehicle === (string)$mId);
                                    @endphp
                                    <option value="{{ $mId }}" {{ $isModSel ? 'selected' : '' }}>
                                        {{ is_array($mod) ? $mod['name'] . ' (' . ($mod['yearFrom'] ?? '') . '-' . ($mod['yearTo'] ?? '') . ')' . (!empty($mod['fuelType']) ? ' - ' . $mod['fuelType'] : '') : $mod }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    @if (isset($selectedVehicleName) && $selectedVehicleName != '')
                        <div class="ca-selected-veh-banner">
                            <i class="bx bx-check-circle"></i>
                            <span><strong>Selected Vehicle:</strong> {{ $selectedVehicleName }}</span>
                        </div>
                    @endif

                    @error('search_vehicle')
                        <span class="ca-error-msg">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Vehicle Color --}}
                <div class="col-md-6">
                    <label class="ca-input-label">
                        Vehicle Color
                    </label>
                    <input type="text" wire:model="vehicle_color" class="form-control" placeholder="e.g. Metallic Black, White">
                    @error('vehicle_color')
                        <span class="ca-error-msg">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Engine No --}}
                <div class="col-md-6">
                    <label class="ca-input-label">
                        Engine No
                    </label>
                    <input type="text" wire:model="engineNo" class="form-control" placeholder="Enter Engine Number">
                    @error('engineNo')
                        <span class="ca-error-msg">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Pickup Address --}}
                <div class="col-md-6">
                    <label class="ca-input-label">
                        Pickup Address
                    </label>
                    <textarea wire:model="pickup_address" class="form-control" placeholder="Enter Pickup Address (if applicable)"></textarea>
                    @error('pickup_address')
                        <span class="ca-error-msg">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Drop Address --}}
                <div class="col-md-6">
                    <label class="ca-input-label">
                        Drop Address
                    </label>
                    <textarea wire:model="drop_address" class="form-control" placeholder="Enter Drop Address (if applicable)"></textarea>
                    @error('drop_address')
                        <span class="ca-error-msg">{{ $message }}</span>
                    @enderror
                </div>

            </div>
        </div>
    </div>

    {{-- OPTIONAL SECTION TOGGLE: Driver & Insurance Details --}}
    <div class="ca-toggle-opt-container">
        <button
            type="button"
            class="ca-toggle-opt-btn"
            id="toggleDetailsBtn"
            wire:click.prevent="$toggle('show_more_details')">
            <i class="bx {{ !empty($show_more_details) ? 'bx-minus-circle' : 'bx-plus-circle' }}" id="toggleDetailsIcon"></i>
            <span id="toggleDetailsText">{{ !empty($show_more_details) ? 'Hide Driver & Insurance Details' : 'Show Driver & Insurance Details (Optional)' }}</span>
        </button>
    </div>

    @if (!empty($show_more_details))
    <div id="detailsSection">

        {{-- Driver Details Card --}}
        <div class="ca-form-card">
            <div class="ca-form-card-header">
                <div class="ca-form-card-header-left">
                    <div class="ca-form-card-icon" style="background: #eff6ff; color: #2563eb; border-color: #bfdbfe;">
                        <i class="bx bx-id-card"></i>
                    </div>
                    <div>
                        <h6 class="ca-form-card-title">Driver Details</h6>
                        <span class="ca-form-card-sub">Assigned driver contact information</span>
                    </div>
                </div>
                <span class="ca-badge-pill optional">Optional</span>
            </div>
            <div class="ca-form-card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="ca-input-label">Driver Name</label>
                        <input type="text" wire:model="driver_name" class="form-control" placeholder="Enter Driver Name">
                    </div>
                    <div class="col-md-6">
                        <label class="ca-input-label">Driver Mobile Number</label>
                        <input type="number" wire:model="driver_number" class="form-control" placeholder="Enter Driver Number">
                    </div>
                </div>
            </div>
        </div>

        {{-- Insurance Details Card --}}
        <div class="ca-form-card">
            <div class="ca-form-card-header">
                <div class="ca-form-card-header-left">
                    <div class="ca-form-card-icon" style="background: #f0fdf4; color: #16a34a; border-color: #bbf7d0;">
                        <i class="bx bx-shield-quarter"></i>
                    </div>
                    <div>
                        <h6 class="ca-form-card-title">Insurance Details</h6>
                        <span class="ca-form-card-sub">Policy coverage and expiry information</span>
                    </div>
                </div>
                <span class="ca-badge-pill optional">Optional</span>
            </div>
            <div class="ca-form-card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="ca-input-label">Policy Number</label>
                        <input type="text" wire:model="policy_number" class="form-control" placeholder="Enter Policy Number">
                    </div>
                    <div class="col-md-6">
                        <label class="ca-input-label">Insurance Company Name</label>
                        <input type="text" wire:model="insurance_name" class="form-control" placeholder="e.g. HDFC ERGO, ICICI Lombard">
                    </div>
                    <div class="col-md-6">
                        <label class="ca-input-label">Policy Expiry Date</label>
                        <input type="date" wire:model="policy_expiry_date" class="form-control" onclick="this.showPicker()">
                    </div>
                </div>
            </div>
        </div>

    </div>
    @endif

</div>