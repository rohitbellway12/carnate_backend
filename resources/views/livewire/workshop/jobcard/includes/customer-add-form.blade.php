<div class="card">
    <div class="card-header">
        <h5>PERSONAL DETAILS</h5>
    </div>
    <div class="card-body">
        <div class="row g-3">

            @if ($show_company_name)
                <div class="col-md-6">
                    <label class="form-label" for="company_name">Company Name<span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text">M/S</span>
                        <input type="text" class="form-control" name="company_name" id="company_name"
                            wire:model="company_name" placeholder="Company Name">
                    </div>
                    @error('company_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            @else
                <!-- Name -->
                <div class="col-md-6">
                    <label for="first_name" class="form-label">
                        First Name <span class="text-danger">*</span>
                    </label>
                    <div class="input-group">
                        <select name="user_title" id="user_title" wire:model="user_title" class="form-select"
                            style="max-width: 80px;">
                            <option value="mr">Mr.</option>
                            <option value="mrs">Mrs.</option>
                            <option value="miss">Miss</option>
                            <option value="ms">M/S</option>
                        </select>
                        <input type="text" wire:model="name" name="first_name" id="first_name" class="form-control"
                            placeholder="Enter First Name">
                    </div>
                    @if ($errors->has('name') || $errors->has('user_title'))
                        <span class="text-danger error">
                            {{ $errors->first('name') ?? $errors->first('user_title') }}
                        </span>
                    @endif
                </div>

                <!-- Last Name -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Last Name<span class="text-danger"></span></label>
                        <input type="text" wire:model="lastname" class="form-control" placeholder="Enter Last Name">
                    </div>
                    @error('lastname')
                        <span class="text-danger error">{{ $message }}</span>
                    @enderror
                </div>
            @endif

            <!-- Mobile Number -->
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Mobile Number<span class="text-danger">*</span></label>
                    <input type="number" wire:model="mobile_no" class="form-control" placeholder="Enter Mobile Number">
                </div>
                @error('mobile_no')
                    <span class="text-danger error">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email -->
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" wire:model="email" class="form-control" placeholder="Enter Email">
                </div>
                @error('email')
                    <span class="text-danger error">{{ $message }}</span>
                @enderror
            </div>


            <!-- Birth Date -->
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Birth Date</label>
                    <input type="date" wire:model="birth_date" class="form-control"
                        max="{{ \Carbon\Carbon::today()->toDateString() }}" onclick="this.showPicker()">
                </div>
                @error('birth_date')
                    <span class="text-danger error">{{ $message }}</span>
                @enderror
            </div>
            <!-- GST Number -->
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">GST Number</label>
                    <input type="text" wire:model="gst_no" class="form-control" placeholder="Enter GSt Number">
                </div>
                @error('gst_no')
                    <span class="text-danger error">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label">Address</label>
                    <textarea wire:model="address" class="form-control" placeholder="Enter Address"></textarea>
                </div>
                @error('address')
                    <span class="text-danger error">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5>Vehicle Details</h5>
    </div>
    <div class="card-body">
        <div class="row g-3">
            
            <div class="col-md-5">
                <label class="form-label">Number Plate<span class="text-danger">*</span></label>
                <input type="text" wire:model="numberPlate" class="form-control" id="numberPlate"
                    placeholder="Enter Number Plate"
                    oninput="this.value = this.value.toUpperCase().replace(/[^A-Z0-9]/g, '')">
                @error('numberPlate')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
 
            <div class="col-md-7">
                <label class="form-label">Chassis No (VIN)<span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="text" wire:model.live.debounce.500ms="chassisNo" class="form-control" placeholder="Enter Chassis No / VIN"
                        oninput="this.value = this.value.toUpperCase().replace(/[^A-Z0-9]/g, '')">
                    <button type="button" class="btn btn-primary" wire:click="fetchVehicleByVin" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="fetchVehicleByVin"><i class="bx bx-search"></i> Fetch Details</span>
                        <span wire:loading wire:target="fetchVehicleByVin"><span class="spinner-border spinner-border-sm me-1"></span> Fetching...</span>
                    </button>
                </div>
                <small class="text-muted">Enter 17-digit Chassis No / VIN to autofill Brand, Model & Modification</small>
                @error('chassisNo')
                    <div><span class="text-danger">{{ $message }}</span></div>
                @enderror
            </div>
            

            <div class="col-12">
                <label class="form-label">Vehicle Details<span class="text-danger">*</span></label>
                <div class="row g-2">
                    {{-- 🔹 Brand Dropdown --}}
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

                    {{-- 🔹 Variant Dropdown --}}
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

                    {{-- 🔹 Year Dropdown --}}
                    <div class="col-md-3">
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

                    {{-- 🔹 Modification Dropdown --}}
                    <div class="col-md-3">
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
                    <p style="color: #0dcaf0;" class="mt-2 mb-0 fw-bold"><i class="bx bx-check-circle"></i> Selected Vehicle :- {{ @$selectedVehicleName }}

                    </p>
                @endif
                @error('search_vehicle')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Vehicle Color</label>
                <input type="text" wire:model="vehicle_color" class="form-control" placeholder="Enter Vehicle Color">
                @error('vehicle_color')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Engine No</label>
                <input type="text" wire:model="engineNo" class="form-control" placeholder="Enter Engine No">
                @error('engineNo')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!--Pick Address -->
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Pickup Address</label>
                    <textarea wire:model="pickup_address" class="form-control" placeholder="Enter Pickup Address"></textarea>
                </div>
                @error('pickup_address')
                    <span class="text-danger error">{{ $message }}</span>
                @enderror
            </div>

            <!-- Drof Address -->
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Drop Address</label>
                    <textarea wire:model="drop_address" class="form-control" placeholder="Enter Drop Address"></textarea>
                </div>
                @error('drop_address')
                    <span class="text-danger error">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
</div>
<button type="button" class="btn btn-primary mb-3" id="toggleDetailsBtn">
    Show Details
</button>

<div id="detailsSection" style="display: none;">
    <div class="card">
        <div class="card-header">
            <h5>DRIVER DETAILS</h5>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Driver Name</label>
                    <input type="text" wire:model="driver_name" class="form-control"
                        placeholder="Enter Driver Name">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Driver Number</label>
                    <input type="number" wire:model="driver_number" class="form-control"
                        placeholder="Enter Driver Number">
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header">
            <h5>INSURANCE DETAILS</h5>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Policy Number</label>
                    <input type="text" wire:model="policy_number" class="form-control"
                        placeholder="Enter Policy Number">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Insurance Name</label>
                    <input type="text" wire:model="insurance_name" class="form-control"
                        placeholder="Enter Insurance Name">
                </div>
                <div class="col-md-6 mt-2">
                    <label class="form-label">Policy Expiry Date</label>
                    <input type="date" wire:model="policy_expiry_date" class="form-control">
                </div>
            </div>
        </div>
    </div>
</div>
