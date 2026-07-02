<div>
    <style>
        #spare-table th,
        #spare-table .add-spare-btn,
        .green-variant {
            background-color: #2E7D32 !important;
            color: white !important;
        }

        #lubes-table th,
        #lubes-table .add-spare-btn,
        .blue-variant,
        .blue-variant i.fa {
            background-color: #1976D2 !important;
            color: white !important;
        }

        #tools-table th,
        #tools-table .add-spare-btn,
        .orange-variant,
        .orange-variant i.fa {
            background-color: #D84315 !important;
            color: white !important;
        }

        .btn-outline-secondary {
            color: #333333;
        }

        .grey-variant,
        .grey-variant i.fa {
            background-color: #424242 !important;
            color: white !important;
        }

        #accessory-table th,
        #accessory-table .add-spare-btn,
        .purple-variant,
        .purple-variant i.fa {
            background-color: #D84315 !important;
            color: white !important;
        }

        .green-text {
            color: #2E7D32 !important;
        }

        .blue-text {
            color: #1976D2 !important;
        }

        .orange-text {
            color: #D84315 !important;
        }

        .grey-text {
            color: #424242 !important;
        }

        .purple-text {
            color: #D84315 !important;
        }

        #labour-table th,
        #labour-table .add-spare-btn,
        .bg-yellow-orange {
            background: #A52A2A !important;
            color: #fff !important;
        }

        .table-view table th {
            text-wrap: nowrap !important;
        }

        th {
            font-weight: 300;
        }

        .m-0 {
            font-weight: 500;
        }
    </style>



    <div class="modal @if ($showLabourCharge) show @endif" tabindex="-1"
        style="opacity:1; background-color:#0606068c; display:@if ($showLabourCharge) block @endif">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form wire:submit.prevent="storelabourcharge">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ $isEdit ? 'Edit' : 'Create' }} Labour Charge</h4>
                        <button type="button" class="btn-close" wire:click="$set('showLabourCharge', false)"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body py-3">
                        @csrf

                        <div class="row g-3">
                            {{-- Title --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Title<sup class="text-danger">*</sup></label>
                                    <input type="text" wire:model="title" class="form-control"
                                        placeholder="Enter Title">
                                </div>
                                @error('title')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Labour Type --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Labour Type<sup class="text-danger">*</sup></label>
                                    <select wire:model.live="labour_type" class="form-select">
                                        <option value="">Select Labour Type</option>
                                        <option value="inhouse">Inhouse</option>
                                        <option value="outsource">Outsource</option>
                                    </select>
                                    @error('labour_type')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            {{-- Outsource Price (conditionally shown) --}}
                            @if ($labour_type === 'outsource')
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Outsource Price<sup
                                                class="text-danger">*</sup></label>
                                        <input type="number" wire:model.live="outsource_price" class="form-control"
                                            placeholder="Enter Outsource Price" min="1" step="1">
                                    </div>
                                    @error('outsource_price')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endif

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Selling Price<sup class="text-danger">*</sup></label>
                                    <input type="number" wire:model.live="price" class="form-control"
                                        placeholder="Enter Price" min="1" step="1">
                                </div>
                                @error('price')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>



                            {{-- Tax Type --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Tax Type</label>
                                    <select wire:model.live="tax_type" class="form-select">
                                        <option value="">Select Tax Type</option>
                                        <option value="include">Include All Taxes</option>
                                        <option value="exclude">Exclude All Taxes</option>
                                    </select>
                                    @error('tax_type')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Tax Percentage (conditionally shown) --}}
                            @if ($tax_type === 'include' || $tax_type === 'exclude')
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">
                                            {{ $tax_type === 'include' ? 'Include Tax Percentage' : 'Exclude Tax Percentage' }}
                                        </label>
                                        <div class="input-group">
                                            <input type="number" wire:model.live="tax_percentage" class="form-control"
                                                placeholder="Enter Percentage">
                                            <span class="input-group-text">%</span>
                                        </div>
                                        @error('tax_percentage')
                                            <span class="text-danger error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endif

                            {{-- Total Price --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Total Price<sup class="text-danger">*</sup></label>
                                    <input type="text" wire:model="total_price" class="form-control" readonly>
                                </div>
                                @error('total_price')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="$set('showLabourCharge', false)"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            {{ $isEdit ? 'Update' : 'Create' }}
                            <i class="spinner-border spinner-border-sm" wire:loading></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal @if ($showModal) show @endif" tabindex="-1"
        style="opacity:1; background-color:#0606068c; display:@if ($showModal) block @endif">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form wire:submit.prevent="{{ $add ? 'storeCustomer' : 'storeCustomer' }}">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ $add ? 'Edit Staff' : 'Customer Details' }}</h4>
                        <button type="button" class="btn-close" wire:click="$set('showModal', false)"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body py-3">
                        @csrf

                        <div class="row g-3">
                            <!-- Name -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">First Name<sup class="text-danger">*</sup></label>
                                    <input type="text" wire:model="name" class="form-control"
                                        placeholder="Enter First Name">
                                </div>
                                @error('name')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Last Name -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Last Name<sup class="text-danger">*</sup></label>
                                    <input type="text" wire:model="lastname" class="form-control"
                                        placeholder="Enter Last Name">
                                </div>
                                @error('lastname')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- GST Number -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">GST Number</label>
                                    <input type="text" wire:model="gst_no" class="form-control"
                                        placeholder="Enter GSt Number">
                                </div>
                                @error('gst_no')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Mobile Number -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Mobile Number<sup class="text-danger">*</sup></label>
                                    <input type="text" wire:model="mobile_no" class="form-control"
                                        placeholder="Enter Mobile Number">
                                </div>
                                @error('mobile_no')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Email<sup class="text-danger">*</sup></label>
                                    <input type="email" wire:model="email" class="form-control"
                                        placeholder="Enter Email">
                                </div>
                                @error('email')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>


                            <!-- Birth Date -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Birth Date<sup class="text-danger">*</sup></label>
                                    <input type="date" wire:model="birth_date" class="form-control"
                                        max="{{ \Carbon\Carbon::today()->toDateString() }}">
                                </div>
                                @error('birth_date')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Gender -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Gender<sup class="text-danger">*</sup></label>
                                    <div class="d-flex">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="gender-male"
                                                value="1" wire:model="gender">
                                            <label class="form-check-label" for="gender-male">Male</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="gender-female"
                                                value="2" wire:model="gender">
                                            <label class="form-check-label" for="gender-female">Female</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h4 class="modal-title">ADDRESS</h4>
                            <hr>
                            <!-- Country -->
                            <div class="@if ($add == true) col-md-6 @else col-md-6 @endif">
                                <div class="form-group">
                                    <label class="form-label">Country<sup class="text-danger">*</sup></label>
                                    <select class="form-select" wire:change="stateData($event.target.value)"
                                        wire:model="country_id">
                                        <option value="">Select Country</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('country_id')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- State -->
                            <div class="@if ($add == true) col-md-6 @else col-md-6 @endif">
                                <div class="form-group">
                                    <label class="form-label">State<sup class="text-danger">*</sup></label>
                                    <select class="form-select" wire:model="state_id"
                                        wire:change="cityData($event.target.value)">
                                        <option value="">Select State</option>
                                        @foreach ($states as $state)
                                            <option value="{{ $state->id }}" @selected($state_id == $state->id)>
                                                {{ $state->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('state_id')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- City -->
                            <div class="@if ($add == true) col-md-6 @else col-md-6 @endif">
                                <div class="form-group">
                                    <label class="form-label">City<sup class="text-danger">*</sup></label>
                                    <select class="form-select" wire:model="city_id">
                                        <option value="">Select City</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}" @selected($city_id == $city->id)>
                                                {{ $city->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('city_id')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Address -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Address<sup class="text-danger">*</sup></label>
                                    <textarea wire:model="address" class="form-control" placeholder="Enter Address"></textarea>
                                </div>
                                @error('address')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="modal-body py-3">
                            <h4 class="modal-title">Vehicle Details</h4>
                            <div class="row g-3 mt-4">


                                <div class="col-md-12">
                                    <select id="search_vehicle" wire:model="search_vehicle"
                                        class="form-select select2" data-property="search_vehicle"></select>

                                    @if (isset($selectedVehicleName))
                                        <p style="color: #0dcaf0;" class="mt-4">Vehicle :-
                                            {{ @$selectedVehicleName }}
                                        </p>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Fuel Type<sup class="text-danger">*</sup></label>
                                    <div class="input-group">
                                        <select wire:model="fuel_id" class="form-control">
                                            <option value="">Select</option>
                                            @foreach ($fuel_types as $fuel_type)
                                                <option value="{{ $fuel_type['id'] }}">{{ $fuel_type['fuel_type'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('fuel_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Number Plate<sup class="text-danger">*</sup></label>
                                    <input type="text" wire:model="numberPlate" class="form-control"
                                        placeholder="Enter Number Plate">
                                    @error('numberPlate')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Chassis No<sup class="text-danger">*</sup></label>
                                    <input type="text" wire:model="chassisNo" class="form-control"
                                        placeholder="Enter Chassis No">

                                    @error('chassisNo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Model Year<sup class="text-danger">*</sup></label>
                                    <input type="text" wire:model="modelYear" class="form-control"
                                        placeholder="Enter Model Year">

                                    @error('modelYear')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">No of Gear<sup class="text-danger">*</sup></label>
                                    <input type="text" wire:model="noOfGear" class="form-control"
                                        placeholder="Enter No of Gear">
                                    @error('noOfGear')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Odometer Reading<sup class="text-danger">*</sup></label>
                                    <input type="text" wire:model="odometerReading" class="form-control"
                                        placeholder="Enter Odometer Reading">
                                    @error('odometerReading')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Date of Manufacturing<sup
                                            class="text-danger">*</sup></label>
                                    <input type="date" wire:model="dateOfManufacturing" class="form-control"
                                        max="{{ \Carbon\Carbon::today()->toDateString() }}">
                                    @error('dateOfManufacturing')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Gearbox<sup class="text-danger">*</sup></label>
                                    <input type="text" wire:model="gearbox" class="form-control"
                                        placeholder="Enter Gearbox">
                                    @error('gearbox')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Gearbox No<sup class="text-danger">*</sup></label>
                                    <input type="text" wire:model="gearboxNo" class="form-control"
                                        placeholder="Enter Gearbox No">
                                    @error('gearboxNo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Engine No<sup class="text-danger">*</sup></label>
                                    <input type="text" wire:model="engineNo" class="form-control"
                                        placeholder="Enter Engine No">
                                    @error('engineNo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Engine Size<sup class="text-danger">*</sup></label>
                                    <input type="text" wire:model="engineSize" class="form-control"
                                        placeholder="Enter Engine Size">
                                    @error('engineSize')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Engine<sup class="text-danger">*</sup></label>
                                    <input type="text" wire:model="engine" class="form-control"
                                        placeholder="Enter Engine">
                                    @error('engine')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Key No<sup class="text-danger">*</sup></label>
                                    <input type="text" wire:model="keyNo" class="form-control"
                                        placeholder="Enter Key No">
                                    @error('keyNo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!--Pick Address -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Pickup Address <sup
                                                class="text-danger">*</sup></label>
                                        <textarea wire:model="pickup_address" class="form-control" placeholder="Enter Pickup Address"></textarea>
                                    </div>
                                    @error('pickup_address')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Drof Address -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Drop Address<sup class="text-danger">*</sup></label>
                                        <textarea wire:model="drop_address" class="form-control" placeholder="Enter Drop Address"></textarea>
                                    </div>
                                    @error('drop_address')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>


                            <h4 class="modal-title mt-4">Driver Details</h4>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="form-label">Driver Name<sup class="text-danger">*</sup></label>
                                    <input type="text" wire:model="driver_name" class="form-control"
                                        placeholder="Enter Driver Name">
                                    @error('driver_name')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Driver Number<sup class="text-danger">*</sup></label>
                                    <input type="number" wire:model="driver_number" class="form-control"
                                        placeholder="Enter Driver Number">
                                    @error('driver_number')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>


                            <h4 class="modal-title mt-4">Insurance Details</h4>
                            <div class="row mt-2">
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
                                {{-- <div class="col-md-6 mt-2">
                                    <label class="form-label">GSTIN</label>
                                    <input type="text" wire:model="gstin_number" class="form-control"
                                        placeholder="Enter GSTIN">
                                </div> --}}
                                <div class="col-md-6  mt-2">
                                    <label class="form-label">Policy Expiry Date</label>
                                    <input type="date" wire:model="policy_expiry_date" class="form-control">
                                </div>



                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="$set('showModal', false)"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            {{ $add ? 'Update' : 'Create' }}
                            <i class="spinner-border spinner-border-sm" wire:loading></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal @if ($showCustomerVoice) show @endif" tabindex="-1"
        style="opacity:1; background-color:#0606068c; display:@if ($showCustomerVoice) block @endif">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form wire:submit.prevent="{{ $add ? 'customerVoice' : 'customerVoice' }}  ">
                    <div class="modal-header">
                        <div class="d-flex justify-content-between w-100 align-items-center">
                            <h4 class="modal-title" style="font-size:18px;">Customer Voice {{ $customerVoiceCount }}
                            </h4>
                            @if ($showCustomerVoiceInput)
                                <p class="btn btn-danger rounded me-4 mb-0 mt-2" wire:click="cancelVoiceField"> Cancel
                                    Voice</p>
                            @else
                                <p class="btn btn-success rounded me-4 mb-0 mt-2"
                                    @if ($jobcardData->status != 3) @if ($user->hasPermissionTo('Jobcard-edit')) wire:click="addField" @endif
                                    @endif> Add More</p>
                            @endif
                        </div>
                        <button type="button" class="btn-close" wire:click="$set('showCustomerVoice', false)"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body py-3">
                        <div class="row">

                            @if ($showCustomerVoiceInput)
                                <div class="mb-3 col-lg-12 dynamic-field  text-center">
                                    <div class="row align-items-center">
                                        <div class="col-11">
                                            <label for="validationCustom01" class="form-label">Customer
                                                Voice</label><br>
                                            <input type="text"
                                                class="form-control  @error('customerVoices') is-invalid @enderror"
                                                placeholder="Customer Voice" wire:model="customerVoiceInpt">

                                        </div>
                                        <div class="col-1 mt-2">
                                            <button type="button"
                                                class="btn btn-info btn-xs p-1 remove-field rounded text-white border-white  mt-3"
                                                wire:click="addCustomerInptVoice"
                                                style="font-size: 12px; width: 27px; height: 30px; display: flex; align-items: center; ">
                                                <i class="fa-solid fa-check"></i>
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            @endif

                            <div class="d-flex flex-wrap gap-1">
                                @foreach ($customerVoices as $index => $voice)
                                    @if (!empty($voice))
                                        <div class="">
                                            <span class="badge bg-primary position-relative mb-2 py-1"
                                                style="padding-right: 1.8rem; font-size:15px;">
                                                {{ $voice }}
                                                <a class="btn-close btn-close-white position-absolute"
                                                    style="top: 1px; right: 5px; width: 0.8rem; height: 0.8rem; background: unset; opacity: 1; cursor: pointer;"
                                                    aria-label="Close"
                                                    wire:click="removeCustomerVoice({{ $index }})">
                                                    <i class="fa-solid fa-xmark text-dark"></i>
                                                </a>

                                            </span>
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                            <!-- <div class="col-6">
                            <select id="search_customer_voice" wire:model="search_customer_voice"
                                class="form-select select2" data-property="search_customer_voice"></select>
                        </div> -->
                            <!--<div class="col-12">-->
                            <!--    <div class="my-3 w-100 m-auto">-->
                            <!--        <div class="card bg-light">-->
                            <!--            <div class="card-body pb-2">-->
                            <!--                <p class="text-center"><b>Search Customer Voice</b></p>-->
                            <!--                <input type="text" class="form-control"-->
                            <!--                    wire:model.live="search_customer_voice" placeholder="Search Voice...">-->
                            <!--            </div>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--</div>-->
                        </div>
                        {{--
<div class="col-12">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="width:5%;"></th>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
            @php
                $customersVoiceData = $customerVoicesData->where('is_customer_voice', 1);
                if (count($customerVoices) > 1 && !empty($customerVoices[0])) {
                    $customersVoiceData = $customerVoicesData->whereNotIn(
                        'customer_voice',
                        $customerVoices,
                    );
                }
            @endphp
            @foreach ($customersVoiceData as $customerVoicesDatas)
                <tr>
                    <td>
                        <!-- <input type="checkbox" wire:model="selectedItemsCustomerVoice"
                            wire:change="updateSelectedItemsCustomerVoice" id="{{ $customerVoicesDatas->customer_voice }}"
                    value="{{ $customerVoicesDatas->customer_voice }}"> -->

                    <a href="javascript:void(0);"
                        wire:click="updateSelectedItemsCustomerVoice('{{ $customerVoicesDatas->customer_voice }}')"
                        id="{{ $customerVoicesDatas->customer_voice }}">
                        <i class="fa-solid fa-plus"></i>
                    </a>
                    </td>
                    <td>{{ $customerVoicesDatas->customer_voice }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                    </table>
                </div>
                --}}

                        <div class="col-12">
                            <!-- Search Input -->
                            <input type="text" class="form-control mb-2" wire:model.live="search_customer_voice"
                                placeholder="Search Customer Voice...">

                            @php
                                $customersVoiceData = $customerVoicesData->where('is_customer_voice', 1);

                                // Filter if search input is present
                                if (!empty($search_customer_voice)) {
                                    $customersVoiceData = $customersVoiceData->filter(function ($item) use (
                                        $search_customer_voice,
                                    ) {
                                        return stripos($item->customer_voice, $search_customer_voice) !== false;
                                    });
                                }

                                // Exclude already selected voices
                                if (count($customerVoices) > 1 && !empty($customerVoices[0])) {
                                    $customersVoiceData = $customersVoiceData->whereNotIn(
                                        'customer_voice',
                                        $customerVoices,
                                    );
                                }
                            @endphp

                            @if ($customersVoiceData->isNotEmpty())
                                <ul class="list-group list-group-flush" style="max-height: 350px; overflow-y: auto;">
                                    @foreach ($customersVoiceData as $voice)
                                        <li class="list-group-item d-flex justify-content-between align-items-center"
                                            style="cursor: pointer;"
                                            wire:click="updateSelectedItemsCustomerVoice('{{ $voice->customer_voice }}')">
                                            {{ $voice->customer_voice }}
                                            <!--<i class="fa-solid fa-plus text-primary"></i>-->
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <div class="text-center text-muted">No results found</div>
                            @endif
                        </div>


                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal @if ($showPhoto) show @endif" tabindex="-1"
        style="opacity:1; background-color:#0606068c; display:@if ($showPhoto) block @endif">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form wire:submit.prevent="{{ $add ? 'upload_property' : 'upload_property' }}"
                    enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ $addphoto ? 'Add Photo' : 'Add Photo' }}</h4>
                        <button type="button" class="btn-close" wire:click="$set('showPhoto', false)"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body py-3">
                        <div class="mb-3">
                            <label for="image" class="form-label">Car Images</label> <br>


                            <input type="file" class="form-control file-field shadow-sm" id="property_photos"
                                wire:model="property_photos" name="property_photos[]" multiple accept="image/*" />
                            @foreach ($carImages as $carImage)
                                <img src="{{ asset('storage/' . $carImage->file) }}" alt="" height="100px"
                                    width="150px" style="border-radius: 5px; margin: 0px 10px 0px 4px;"
                                    class="mt-4">
                            @endforeach

                            @error('property_photos')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary" wire:click="$set('showPhoto', false)"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            {{ $addphoto ? 'Save' : 'Save' }}
                            <i class="spinner-border spinner-border-sm" wire:loading></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--{{-- <div class="modal @if ($showAccessoriesVoice) show @endif" tabindex="-1"-->
<!--     style="opacity:1; background-color:#0606068c; display:@if ($showAccessoriesVoice) block @endif">-->
<!--     <div class="modal-dialog modal-lg">-->
<!--         <div class="modal-content">-->
<!--             <form wire:submit.prevent="{{ $addAccessoriesVoice ? 'accessoriesVoice' : 'accessoriesVoice' }}">-->
<!--                 <div class="modal-header">-->
<!--                     <div class="d-flex justify-content-between w-100 align-items-center">-->
<!--                         <h4 class="modal-title">Accessories {{ $accessariesCount }} </h4>-->

<!--                         @if ($showAccessoriesInput)-->
<!--                             <p class="btn btn-danger rounded me-4 mb-0 mt-2" wire:click="cancelAccessoriesField">-->
<!--                                 Cancel Voice</p>-->
<!--                         @else-->
<!--                             <p class="btn btn-success rounded me-4 mb-0 mt-2"-->
<!--                                 @if ($jobcardData->status != 3) @if ($user->hasPermissionTo('Jobcard-edit')) wire:click="addAccessorieField" @endif-->
<!--                                 @endif> Add More</p>-->
<!--                         @endif-->
<!--                     </div>-->
<!--                     <button type="button" class="btn-close" wire:click="$set('showAccessoriesVoice', false)"-->
<!--                         data-bs-dismiss="modal" aria-label="Close"></button>-->
<!--                 </div>-->
<!--                 <div class="modal-body py-3">-->
<!--                     <div class="row">-->

<!--                         @if ($showAccessoriesInput)-->
<!--                             <div class="mb-3 col-lg-12 dynamic-field  text-center">-->
<!--                                 <div class="row align-items-center">-->
<!--                                     <div class="col-11">-->
<!--                                         <label for="validationCustom01" class="form-label">Accessories</label><br>-->
<!--                                         <input type="text" class="form-control" placeholder="Accessories"-->
<!--                                             wire:model="accessoriesVoicesInput">-->

<!--                                     </div>-->
<!--                                     <div class="col-1 mt-2">-->
<!--                                         <button type="button"-->
<!--                                             class="btn btn-info btn-xs p-1 remove-field rounded text-white border-white  mt-3"-->
<!--                                             wire:click="addAccessoriesInptVoice"-->
<!--                                             style="font-size: 12px; width: 27px; height: 30px; display: flex; align-items: center; ">-->
<!--                                             <i class="fa-solid fa-check"></i>-->
<!--                                         </button>-->
<!--                                     </div>-->

<!--                                 </div>-->
<!--                             </div>-->
<!--                         @endif-->

<!--                         <div class="d-flex flex-wrap gap-1">-->
<!--                             @foreach ($accessoriesVoices as $index => $voice)-->
<!--                                 @if (!empty($voice))-->
<!--                                     <div class="">-->
<!--                                         <span class="badge bg-primary position-relative mb-2 py-1"-->
<!--                                             style="padding-right: 1.8rem;">-->
<!--                                             {{ $voice }}-->
<!--                                             <a class="btn-close btn-close-white position-absolute"-->
<!--                                                 style="top: 1px; right: 5px; width: 0.8rem; height: 0.8rem; background: unset; opacity: 1; cursor: pointer;"-->
<!--                                                 aria-label="Close"-->
<!--                                                 wire:click="removeAccessoriesVoice({{ $index }})">-->
<!--                                                 <i class="fa-solid fa-xmark text-dark"></i>-->
<!--                                             </a>-->

<!--                                         </span>-->
<!--                                     </div>-->
<!--                                 @endif-->
<!--                             @endforeach-->
<!--                         </div>-->

<!-- <div class="col-6">
   <!--                         <select id="search_accessory" wire:model="search_accessory"-->
<!--                             class="form-select select2" data-property="search_accessory"></select>-->
<!--                     </div> -->-->
<!--                         <div class="col-12">-->
<!--                             <div class="my-3 w-100 m-auto">-->
<!--                                 <div class="card bg-light">-->
<!--                                     <div class="card-body pb-2">-->
<!--                                         <p class="text-center"><b>Search Accessories</b></p>-->
<!--                                         <input type="text" class="form-control"-->
<!--                                             wire:model.live="search_accessory" placeholder="Search Voice...">-->
<!--                                     </div>-->
<!--                                 </div>-->
<!--                             </div>-->
<!--                         </div>-->
<!--                     </div>-->
<!--                     <div class="col-12">-->
<!--                         <table class="table table-bordered">-->
<!--                             <thead>-->
<!--                                 <tr>-->
<!--                                     <th style="width:5%;"></th>-->
<!--                                     <th>Name</th>-->
<!--                                 </tr>-->
<!--                             </thead>-->
<!--                             <tbody>-->
<!--                                 @php-->
<!--                                     $AccessoryVoiceData = $accessoryData->where('is_customer_voice', 2);-->
<!--                                     if (count($customerVoices) > 1 && !empty($customerVoices[0])) {-->
<!--                                         $AccessoryVoiceData = $AccessoryVoiceData->whereNotIn(-->
<!--                                             'customer_voice',-->
<!--                                             $customerVoices,-->
<!--                                         );-->
<!--                                     }-->
<!--                                 @endphp-->
<!--
@foreach ($AccessoryVoiceData as $accessorysDatas)
    <tr>
        <td>
            <!-- <input type="checkbox" wire:model="selectedItemsAccessoryVoice"
                value="{{ $accessorysDatas->customer_voice }}"> -->
<a href="javascript:void(0);"
    wire:click="updateSelectedItemsAccessoryVoice('{{ $accessorysDatas->customer_voice }}')"
    id="{{ $accessorysDatas->customer_voice }}">
    <i class="fa-solid fa-plus"></i>
</a>
</td>
<td>{{ $accessorysDatas->customer_voice }}</td>
</tr>
@endforeach
-->

<!--                             </tbody>-->
<!--                         </table>-->
<!--                     </div>-->
<!--                 </div>-->
<!--             </form>-->
<!--         </div>-->
<!--     </div>-->
<!-- </div> --}}-->


    <div class="modal @if ($showAccessoriesVoice) show @endif" tabindex="-1"
        style="opacity:1; background-color:#0606068c; display:@if ($showAccessoriesVoice) block @endif">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form wire:submit.prevent="{{ $addAccessoriesVoice ? 'accessoriesVoice' : 'accessoriesVoice' }}">
                    <div class="modal-header">
                        <div class="d-flex justify-content-between w-100 align-items-center">
                            <h4 class="modal-title">Accessories {{ $accessariesCount }}</h4>

                            @if ($showAccessoriesInput)
                                <p class="btn btn-danger rounded me-4 mb-0 mt-2" wire:click="cancelAccessoriesField">
                                    Cancel Voice</p>
                            @else
                                <p class="btn btn-success rounded me-4 mb-0 mt-2"
                                    @if ($jobcardData->status != 3) @if ($user->hasPermissionTo('Jobcard-edit')) wire:click="addAccessorieField" @endif
                                    @endif> Add More</p>
                            @endif
                        </div>
                        <button type="button" class="btn-close" wire:click="$set('showAccessoriesVoice', false)"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body py-3">
                        <div class="row">
                            @if ($showAccessoriesInput)
                                <div class="mb-3 col-lg-12 dynamic-field text-center">
                                    <div class="row align-items-center">
                                        <div class="col-11">
                                            <label class="form-label">Accessories</label>
                                            <input type="text" class="form-control" placeholder="Accessories"
                                                wire:model="accessoriesVoicesInput">
                                        </div>
                                        <div class="col-1 mt-2">
                                            <button type="button"
                                                class="btn btn-info btn-xs p-1 remove-field rounded text-white border-white mt-3"
                                                wire:click="addAccessoriesInptVoice"
                                                style="font-size: 12px; width: 27px; height: 30px; display: flex; align-items: center;">
                                                <i class="fa-solid fa-check"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="d-flex flex-wrap gap-1">
                                @foreach ($accessoriesVoices as $index => $voice)
                                    @if (!empty($voice))
                                        <div>
                                            <span class="badge bg-primary position-relative mb-2 py-1"
                                                style="padding-right: 1.8rem; font-size:15px;">
                                                {{ $voice }}
                                                <a class="btn-close btn-close-white position-absolute"
                                                    style="top: 1px; right: 5px; width: 0.8rem; height: 0.8rem; background: unset; opacity: 1; cursor: pointer;"
                                                    aria-label="Close"
                                                    wire:click="removeAccessoriesVoice({{ $index }})">
                                                    <i class="fa-solid fa-xmark text-dark"></i>
                                                </a>
                                            </span>
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                            <!-- Search + Filtered List -->
                            <div class="col-12 mt-4">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <p class="text-center"><b>Search Accessories</b></p>
                                        <input type="text" class="form-control mb-3"
                                            wire:model.live="search_accessory" placeholder="Search Voice...">

                                        @php
                                            $AccessoryVoiceData = $accessoryData->where('is_customer_voice', 2);

                                            if (count($customerVoices) > 1 && !empty($customerVoices[0])) {
                                                $AccessoryVoiceData = $AccessoryVoiceData->whereNotIn(
                                                    'customer_voice',
                                                    $customerVoices,
                                                );
                                            }

                                            if (trim($search_accessory) !== '') {
                                                $AccessoryVoiceData = $AccessoryVoiceData->filter(function ($item) use (
                                                    $search_accessory,
                                                ) {
                                                    return stripos($item->customer_voice, $search_accessory) !== false;
                                                });
                                            }
                                        @endphp

                                        @if ($AccessoryVoiceData->isNotEmpty())
                                            <ul class="list-group list-group-flush"
                                                style="max-height: 300px; overflow-y: auto;">
                                                @foreach ($AccessoryVoiceData as $item)
                                                    <li class="list-group-item d-flex justify-content-between align-items-center"
                                                        style="cursor: pointer;"
                                                        wire:click="updateSelectedItemsAccessoryVoice('{{ $item->customer_voice }}')">
                                                        {{ $item->customer_voice }}
                                                        <!--<i class="fa-solid fa-plus text-primary"></i>-->
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <div class="text-center text-muted">No results found</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>





    <div class="modal @if ($showWorkNote) show @endif" tabindex="-1"
        style="opacity:1; background-color:#0606068c; display:@if ($showWorkNote) block @endif">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form wire:submit.prevent="{{ $add ? 'workVoice' : 'workVoice' }}">
                    <div class="modal-header">
                        <div class="d-flex justify-content-between w-100 align-items-center">
                            <h4 class="modal-title">Work Note {{ $workNoteCount }}</h4>
                            @if ($showWorkNoteInput)
                                <p class="btn btn-danger rounded me-4 mb-0 mt-2" wire:click="cancelworknewvoice">
                                    Cancel Voice</p>
                            @else
                                <p class="btn btn-success rounded me-4 mb-0 mt-2" wire:click="addWorkField">Add More
                                </p>
                            @endif
                        </div>
                        <button type="button" class="btn-close" wire:click="$set('showWorkNote', false)"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body py-3">
                        <div class="row">
                            @if ($showWorkNoteInput)
                                <div class="mb-3 col-lg-12 dynamic-field">
                                    <div class="row">
                                        <div class="col-11">
                                            <label for="validationCustom01" class="form-label">Work Note</label>
                                            <input type="text" class="form-control" placeholder="Work Note"
                                                wire:model="workNotInpt">
                                        </div>
                                        <div class="col-1 mt-3">
                                            <button type="button"
                                                class="btn btn-info btn-xs p-1 remove-field rounded text-white border-white mt-3"
                                                wire:click="addWorkNotInptVoice"
                                                style="font-size: 12px; width: 27px; height: 30px; display: flex; align-items: center;">
                                                <i class="fa-solid fa-check"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Selected Voices -->
                            <div class="d-flex flex-wrap gap-1">
                                @foreach ($workVoices as $index => $voice)
                                    @if (!empty($voice))
                                        <div>
                                            <span class="badge bg-primary position-relative mb-2 py-1"
                                                style="padding-right: 1.8rem; font-size:15px;">
                                                {{ $voice }}
                                                <a class="btn-close btn-close-white position-absolute"
                                                    style="top: 1px; right: 5px; width: 0.8rem; height: 0.8rem; background: unset; opacity: 1; cursor: pointer;"
                                                    aria-label="Close"
                                                    wire:click="removeWorkNotVoice({{ $index }})">
                                                    <i class="fa-solid fa-xmark text-dark"></i>
                                                </a>
                                            </span>
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                            <!-- Search Box -->
                            <div class="col-12 mt-4">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <p class="text-center"><b>Search Work Note</b></p>
                                        <input type="text" class="form-control mb-3"
                                            wire:model.live="search_work_notes" placeholder="Search Work Note...">

                                        @php
                                            $WorkNotVoiceData = $worknotVoicesData->where('is_customer_voice', 0);

                                            if (count($workVoices) > 0 && !empty($workVoices[0])) {
                                                $WorkNotVoiceData = $WorkNotVoiceData->whereNotIn(
                                                    'customer_voice',
                                                    $workVoices,
                                                );
                                            }

                                            if (trim($search_work_notes) !== '') {
                                                $WorkNotVoiceData = $WorkNotVoiceData->filter(function ($item) use (
                                                    $search_work_notes,
                                                ) {
                                                    return stripos($item->customer_voice, $search_work_notes) !== false;
                                                });
                                            }
                                        @endphp

                                        @if ($WorkNotVoiceData->isNotEmpty())
                                            <ul class="list-group list-group-flush"
                                                style="max-height: 300px; overflow-y: auto;">
                                                @foreach ($WorkNotVoiceData as $item)
                                                    <li class="list-group-item d-flex justify-content-between align-items-center"
                                                        style="cursor: pointer;"
                                                        wire:click="updateSelectedItemsWorkNotesVoice('{{ $item->customer_voice }}')">
                                                        {{ $item->customer_voice }}
                                                        <!--<i class="fa-solid fa-plus text-primary"></i>-->
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <div class="text-center text-muted">No results found</div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Validation Errors -->
                            @foreach ($workVoices as $index => $voice)
                                <div class="mb-3 col-lg-12 dynamic-field">
                                    <div class="row">
                                        @error("workVoices.$index")
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- manku --}}
    <div class="modal @if ($showPrint) show @endif" tabindex="-1"
        style="opacity:1; background-color:#0606068c; display:@if ($showPrint) block @endif">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form wire:submit.prevent="{{ $isPrint ? 'workVoice' : 'workVoice' }}" target="_blank">
                    <div class="modal-header">
                        <button type="button" class="btn-close" wire:click="$set('showPrint', false)"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body py-3">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <h5 class="mb-4" style="font-weight: 300;">Please select type
                                        <sup class="text-danger">*</sup>
                                    </h5>
                                    <div>
                                        <!-- Radio Buttons -->
                                        @if (in_array($jobcardData->status, [0, 1, 4]))
                                            <label class="form-check-label">
                                                <input type="radio" wire:model="viewtype" value="mechanic"
                                                    class="form-check-input">
                                                Mechanic Copy
                                            </label>
                                        @endif

                                        @if (in_array($jobcardData->status, [1, 2, 4]) || ($jobcardData->status == 0 && $jobcardData->step != 0))
                                            <label class="form-check-label ml-3">
                                                <input type="radio" wire:model="viewtype"
                                                    value="worksheet_estimate" class="form-check-input">
                                                Estimate Worksheet
                                            </label>
                                        @endif

                                        @if ($jobcardData->status == 2 || $jobcardData->status == 3)
                                            <label class="form-check-label ml-3">
                                                <input type="radio" wire:model="viewtype" value="invoice"
                                                    class="form-check-input">
                                                {{ isset($user) && $user->is_gst == 1 ? 'TAX Invoice' : 'Cash Invoice' }}
                                            </label>
                                        @endif

                                        {{-- <a href="{{ route('download.invoice', ['id' => $jobcardData->id, 'type' => 0]) }}"
                                            class="btn btn-outline-secondary mx-1">
                                            <i class="fa fa-file-pdf"></i></a> --}}

                                        {{-- <label class="form-check-label ml-3">
                                                <input type="radio" wire:model="viewtype" value="invoice_download"
                                                    class="form-check-input"
                                                    @disabled($jobcardData->status == 0 && $jobcardData->step == 0)>
                                                <a href="{{ route('download.invoice', ['id' => $jobcardData->id, 'type' => 0]) }}"
                                                   class="text-decoration-none text-dark">
                                                    <i class="fa fa-file-pdf"></i> Estimate
                                                </a>
                                            </label> --}}

                                        {{-- Estimate link removed to use radio buttons consistently --}}
                                    </div>
                                </div>
                                @error('type')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="$set('showPrint', false)"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" wire:click="viewPdfdata">
                            {{ $isPrint ? 'Print' : 'Print' }}
                            <i class="spinner-border spinner-border-sm" wire:loading></i>
                        </button>

                    </div>
                </form>
            </div>
        </div>
    </div>



    <div class="modal @if ($showDownload) show @endif" tabindex="-1"
        style="opacity:1; background-color:#0606068c; display:@if ($showDownload) block @endif;">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Download PDF</h4>
                    <button type="button" class="btn-close" wire:click="$set('showDownload', false)"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-3">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                <h5 class="mb-4" style="font-weight: 300;">Please select type
                                    <sup class="text-danger">*</sup>
                                </h5>
                                <div>
                                    <!-- Radio Buttons -->
                                    @if (in_array($jobcardData->status, [0, 1, 4]))
                                        <label class="form-check-label">
                                            <input type="radio" wire:model="pdftype" value="mechanic"
                                                class="form-check-input">
                                            Mechanic Copy
                                        </label>
                                    @endif
                                    @if (in_array($jobcardData->status, [1, 2, 4]) || ($jobcardData->status == 0 && $jobcardData->step != 0))
                                        <label class="form-check-label ml-3">
                                            <input type="radio" wire:model="pdftype" value="worksheet_estimate"
                                                class="form-check-input">
                                            Estimate Worksheet
                                        </label>
                                    @endif

                                    @if ($jobcardData->status == 2 || $jobcardData->status == 3)
                                        <label class="form-check-label ml-3">
                                            <input type="radio" wire:model="pdftype" value="invoice"
                                                class="form-check-input">
                                            {{ isset($user) && $user->is_gst == 1 ? 'Tax Invoice' : 'Cash Invoice' }}
                                        </label>
                                    @endif
                                </div>
                            </div>
                            @error('pdftype')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn btn-secondary rounded border-0 text-white"
                        wire:click="$set('showDownload', false)">Close</button>
                    <button type="button" class="btn btn-primary rounded border-0 text-white"
                        wire:click="downloadPdfdata">Download</button>
                </div>
            </div>
        </div>
    </div>

    {{-- @include('livewire.workshop.jobcard.dent_car_modal') --}}
    @include('livewire.workshop.jobcard.vehical_modal')
    @include('livewire.workshop.jobcard.purchase_order')
    @include('livewire.workshop.jobcard.stock_order')


    <div class="modal-body py-3">
        <div class="card h-100">
            <div class="card-body">
                <div class="page-title ">
                    <div class="nav_menu">
                        <nav class="d-flex align-items-center justify-content-between flex-wrap">
                            <!-- Navigation Toggle and Back Link -->
                            <div class="nav toggle">
                                <a href="{{ route('workshop.jobcard') }}" class="d-flex align-items-center">
                                    <img src="{{ asset('supplier/Back Arrow.png') }}" class="back-arrow me-2">
                                    <div class="breadcrumb-title pe-2 text-dark d-flex align-items-center"
                                        style="border: none;">
                                        Edit Job-Card
                                        @switch($jobcardData->status)
                                            @case(0)
                                                <span class="badge bg-danger ms-3" style="font-size: 14px;"><i
                                                        class="fa-solid fa-unlock me-1"></i> Open</span>
                                            @break

                                            @case(1)
                                                <span class="badge bg-primary ms-3" style="font-size: 14px;"><i
                                                        class="fa-solid fa-circle-check me-1"></i> Confirmed</span>
                                            @break

                                            @case(2)
                                                <span class="badge bg-success ms-3" style="font-size: 14px;"><i
                                                        class="fa-solid fa-flag-checkered me-1"></i> Completed</span>
                                            @break

                                            @case(3)
                                                <span class="badge bg-info ms-3" style="font-size: 14px;"><i
                                                        class="fa-solid fa-close me-1"></i> Closed</span>
                                            @break

                                            @case(4)
                                                <span class="badge bg-warning ms-3" style="font-size: 14px;"><i
                                                        class="fa-solid fa-cogs me-1"></i> Process</span>
                                            @break
                                        @endswitch
                                    </div>
                                </a>
                            </div>

                            <!-- Job-Card Details -->
                            <div class="ulprofile d-flex flex-wrap">
                                <div class="input-group" style="width: fit-content">
                                    <span class="input-group-text">Job-Card No.</span>
                                    <input type="text" form="jobcard-form" id="jobcard_number"
                                        name="jobcard_number" class="form-control bg-light"
                                        value="{{ $jobcardData->jobcard_number }}" readonly
                                        placeholder="Job-Card Number" aria-label="Job-Card Number">
                                </div>
                                <div class="input-group ms-2" style="width: fit-content">
                                    <span class="input-group-text">Shared Serial</span>
                                    {{-- <input type="text" class="form-control bg-light"
                                        value="{{ $jobcardData->shared_serial ?? ($shared_serial_preview ?? '') }}" readonly
                                placeholder="YAS-2526-0001" aria-label="Shared Serial"> --}}
                                    <input type="text" class="form-control bg-light"
                                        value="{{ $jobcardData->shared_serial ?? ($shared_serial_preview ?? '') }}"
                                        readonly placeholder="YAS-2627-0001" aria-label="Shared Serial">
                                </div>
                                <div class="input-group" style="width: fit-content">
                                    <span class="input-group-text">Date</span>
                                    <input type="text" class="form-control bg-light"
                                        value="{{ \Carbon\Carbon::parse($jobcardData->entry_date)->format('d-m-Y') }}"
                                        readonly placeholder="Date" aria-label="Date">
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        @csrf
        <div class="row">
            @if ($user->hasPermissionTo('customer-detail-Jobcard'))
                <div class="col-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="text-center m-2">
                                <h6>
                                    <b>Customer Detail</b>
                                </h6>
                            </div>
                            <hr>
                            <label for="customer-dropdown" class="form-label d-none">Customer Name</label>
                            <div class="input-group mb-3 d-none">
                                <select id="customer_name" wire:model="customer_name" class="form-select select2"
                                    data-property="customer_name">
                                    <option value="">--Select Customer--</option>

                                </select>

                                <button type="button"
                                    class="btn btn-outline-secondary text-light bg-primary fl margin-left-0"
                                    wire:click="addCustomer">
                                    {{ trans('+') }}
                                </button>
                            </div>
                            @if (!empty($customer_data))
                                <style>
                                    .info-table td {
                                        border-bottom: 1px solid #e0e0e0;
                                        /* Light grey line */
                                        padding: 6px 8px;
                                        vertical-align: top;
                                    }
                                </style>

                                <table class="table table-sm info-table" style="width: 100%;">
                                    <tbody>
                                        <tr>
                                            <td style="white-space: nowrap;"><b>Customer</b></td>
                                            <td style="width: 25%;">
                                                {{ $customer_data->cust_type == 1 ? 'M/S ' . ($customer_data->company_name ?? $fullName) : trim(($customer_data->name ?? '') . ' ' . ($customer_data->lastname ?? '')) }}
                                            </td>

                                            <td style="white-space: normal; word-break: break-word;"><b>Vehicle Name &
                                                    Color</b></td>
                                            <td style="width: 25%;">
                                                @if (!empty($vehicle_data) && !empty($vehicle_data->brand))
                                                    {{ $vehicle_data->brand . '/' . $vehicle_data->variant . '/' . $vehicle_data->modification }}
                                                    @if (!empty($vehicle_data->vehicle_color))
                                                        ({{ $vehicle_data->vehicle_color }})
                                                    @endif
                                                @else
                                                    <span class="text-muted">—</span>
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <td><b>Mobile No.</b></td>
                                            <td>{{ $customer_data->mobile_no ?? '' }}</td>

                                            <td><b>Vehicle No.</b></td>
                                            <td>{{ $vehicle_data->number_plate ?? '' }}</td>
                                        </tr>

                                        <tr>
                                            <td><b>Address</b></td>
                                            <td>{{ $customer_data->address ?? '' }}</td>

                                            <td><b>Chassis No.</b></td>
                                            <td>{{ $vehicle_data->chassis_no ?? '' }}</td>
                                        </tr>

                                        <tr>
                                            <td><b>GST</b></td>
                                            <td>{{ $customer_data->gst_number ?? '' }}</td>

                                            <td><b>Engine No</b></td>
                                            <td>{{ $vehicle_data->engineno ?? '' }}</td>
                                        </tr>

                                        <tr>
                                            <td><b>Pickup Address</b></td>
                                            <td>{{ $vehicle_data->pickup_address ?? '' }}</td>

                                            <td><b>Drop Address</b></td>
                                            <td>{{ $vehicle_data->drop_address ?? '' }}</td>


                                        </tr>

                                        <tr>
                                            <td><b>Driver Name</b></td>
                                            <td>{{ $vehicle_data->driver_name ?? '' }}</td>

                                            <td><b>Driver Number</b></td>
                                            <td>{{ $vehicle_data->driver_number ?? '' }}</td>
                                        </tr>


                                    </tbody>
                                </table>
                            @endif

                            @if ($jobcardData->status != 0)
                                {{-- <div class="mb-3">
                                    <label for="note" class="form-label">Note</label>
                                    <textarea class="form-control" wire:model="notes" rows="3"></textarea>
                                    <div class="text-end m-2">
                                        <button type="button" style="width:180px"
                                            class="btn btn-outline-secondary bg-primary add-spare-btn ms-2"
                                            wire:click="updateNote">Update Note</button>
                                    </div>
                                </div> --}}
                            @endif
                        </div>
                    </div>
                </div>
            @endif
            <div class="@if ($user->hasPermissionTo('customer-detail-Jobcard')) col-6 @else col-12 @endif">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h6 class="m-0"><b>Job-Card Details</b></h6>
                            <button type="button" class="btn btn-sm btn-info">Last History</button>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-floating mb-3">
                                    <input type="number" wire:model="km_reading" class="form-control"
                                        id="km_reading" @disabled($jobcardData->status == 3 || !$user->hasPermissionTo('Jobcard-edit')) min="0">
                                    <label for="km_reading">KM Reading</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <label for="fual_level" class="form-label">Fuel Level</label>
                                <input type="range" class="form-range" id="fual_level" wire:model="fual_level"
                                    min="0" max="100" @disabled($jobcardData->status == 3 || !$user->hasPermissionTo('Jobcard-edit'))>
                            </div>
                            <div class="col-4">
                                <div class="form-floating">
                                    <select class="form-select" id="supervisor" wire:model="supervisor"
                                        aria-label="Floating label select example" @disabled($jobcardData->status == 3 || !$user->hasPermissionTo('Jobcard-edit'))>
                                        <option value="">--Attended By--</option>
                                        @foreach ($supervisors as $supervisor)
                                            <option value="{{ $supervisor->id }}">
                                                {{ $supervisor->name . ' ' . $supervisor->lastname }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="supervisor">Attended By</label>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center @if (!$user->hasPermissionTo('customer-detail-Jobcard')) gap-4 @endif">
                            <a href="javascript:void(0)" wire:click="addVoice"
                                class="text-center p-2 position-relative d-flex flex-column justify-content-between">
                                <img src="{{ asset('assets/jobcard_img/customer_voice2.jpg') }}" alt="image"
                                    width="80">
                                <p class="my-2" style="font-size:18px;">Customer voice</p>
                                <p class="position-absolute list-count rounded-circle bg-primary text-white customerVoiceCount"
                                    style="width: 18px; height: 18px;">
                                    {{ $customerVoiceCount }}
                                </p>
                            </a>

                            <a href="javascript:void(0)"
                                @if ($jobcardData->status != 3 || $jobcarddentCount != 0) wire:click="showDent" @endif
                                class="text-center p-2 position-relative d-flex flex-column justify-content-between">
                                <img src="{{ asset('assets/jobcard_img/dent.jpg') }}" alt="image"
                                    width="80">
                                <p class="my-2" style="font-size:18px;">Dent Marks</p>
                                <p class="position-absolute list-count rounded-circle bg-primary text-white"
                                    style="width: 18px; height: 18px;">
                                    {{ $jobcarddentCount }}
                                </p>
                            </a>

                            <a href="javascript:void(0)" wire:click="addImage"
                                class="text-center p-2 position-relative d-flex flex-column justify-content-between">
                                <img src="{{ asset('assets/jobcard_img/photo.jpg') }}" alt="image"
                                    width="80">
                                <p class="my-2" style="font-size:18px;">Photos</p>
                                <p class="position-absolute list-count rounded-circle bg-primary text-white jobcardImage"
                                    style="width: 18px; height: 18px;">
                                    {{ $photosCount }}
                                </p>
                            </a>

                            <a href="javascript:void(0)" wire:click="addAccessorie"
                                class="text-center p-2 position-relative d-flex flex-column justify-content-between">
                                <img src="{{ asset('assets/jobcard_img/accessory.jpg') }}" alt="image"
                                    width="80">
                                <p class="my-2" style="font-size:18px;">Accessories</p>
                                <p class="accessaryCount position-absolute list-count rounded-circle bg-primary text-white"
                                    style="width: 18px; height: 18px;">
                                    {{ $accessariesCount }}
                                </p>
                            </a>

                            <a href="javascript:void(0)" wire:click="addWork"
                                class="text-center p-2 position-relative d-flex flex-column justify-content-between">
                                <img src="{{ asset('assets/jobcard_img/work_note.jpg') }}" alt="image"
                                    width="80">
                                <p class="my-2" style="font-size:18px;">Work Note</p>
                                <p class="workNoteCount position-absolute list-count rounded-circle bg-primary text-white"
                                    style="width: 18px; height: 18px;">
                                    {{ $workNoteCount }}
                                </p>
                            </a>
                        </div>


                    </div>
                </div>
            </div>

            <div class=" mt-4">
                <div class="card h-100">
                    <div class="card-body ">
                        <!-- Top Cards -->
                        <div class="row mt-4" id="counters">
                            <div class="col-2">
                                <div class="card">
                                    <div class="card-body p-0" id="labour-table-counter">
                                        <a href="javascript:void(0)"
                                            class="d-flex justify-content-between bg-yellow-orange px-1 py-2 rounded-top text-white"
                                            wire:click="toggleTable(1)">
                                            <p class="m-0"><b>Labour(<span
                                                        class="tr-count">{{ count($extraCharges) }}</span>)</b></p>
                                            <p class="text-end m-0">
                                                <b class="">₹<span
                                                        class="total-count">{{ array_sum(array_column($extraCharges, 'charge')) }}</span>
                                                </b>
                                                <small class="d-block ">₹<span
                                                        class="discount-count">{{ array_sum(array_column($extraCharges, 'discount')) }}</span></small>
                                            </p>
                                        </a>

                                        <div class="d-flex justify-content-between align-items-center p-1 ps-0 ">
                                            <div class="fs-5 bg-yellow-orange rounded mx-1 px-2"><i
                                                    class="fa-solid fa-user text-white"></i></div>
                                            <div class="text-end">
                                                <p class="m-0 ">Total: ₹<span
                                                        class="final-total-count">{{ array_sum(array_column($extraCharges, 'charge')) }}</span>
                                                </p>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="card">
                                    <div class="card-body p-0" id="spare-part-table-counter">
                                        <a href="javascript:void(0)"
                                            class="d-flex justify-content-between green-variant px-1 py-2 rounded-top text-white"
                                            wire:click="toggleTable(2)">
                                            <p class="m-0"><b>Spare(<span
                                                        class="tr-count">{{ count($spareParts) }}</span>)</b></p>
                                            <p class="text-end m-0">
                                                <b class="">₹<span
                                                        class="total-count">{{ array_sum(array_column($spareParts, 'total_amount')) }}</span></b>
                                                <small class="d-block ">₹<span
                                                        class="discount-count">{{ array_sum(array_column($spareParts, 'discount')) }}</span></small>
                                            </p>
                                        </a>
                                        <div class="d-flex justify-content-between align-items-center p-1 ps-0 ">
                                            <div class="fs-5 green-variant rounded mx-1 px-2"><i
                                                    class="fa-solid fa-cogs text-white"></i></div>
                                            <div class="text-end">
                                                <p class="m-0 ">Total: ₹<span
                                                        class="final-total-count">{{ array_sum(array_column($spareParts, 'final_amount')) }}</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="card">
                                    <div class="card-body p-0" id="lubes-table-counter">
                                        <a href="javascript:void(0)"
                                            class="d-flex justify-content-between blue-variant px-1 py-2 rounded-top text-white"
                                            wire:click="toggleTable(3)">
                                            <p class="m-0"><b>Lubes(<span
                                                        class="tr-count">{{ count($lubes) }}</span>)</b></p>
                                            <p class="text-end m-0">
                                                <b class="">₹<span
                                                        class="total-count">{{ array_sum(array_column($lubes, 'total_amount')) }}</span></b>
                                                <small class="d-block ">₹<span
                                                        class="discount-count">{{ array_sum(array_column($lubes, 'discount')) }}</span></small>
                                            </p>
                                        </a>
                                        <div class="d-flex justify-content-between align-items-center p-1 ps-0 ">
                                            <div class="fs-5 blue-variant rounded mx-1 px-2"><i
                                                    class="fa-solid fa-oil-can text-white"></i></div>
                                            <div class="text-end">
                                                <p class="m-0 ">Total: ₹<span
                                                        class="final-total-count">{{ array_sum(array_column($lubes, 'final_amount')) }}</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="card">
                                    <div class="card-body p-0" id="accessory-table-counter">
                                        <a href="javascript:void(0)"
                                            class="d-flex justify-content-between orange-variant px-1 py-2 rounded-top text-white"
                                            wire:click="toggleTable(5)">
                                            <p class="m-0"><b>Accessory(<span
                                                        class="tr-count">{{ count($accessoriess) }}</span>)</b>
                                            </p>
                                            <p class="text-end m-0">
                                                <b class="">₹<span
                                                        class="total-count">{{ array_sum(array_column($accessoriess, 'total_amount')) }}</span></b>
                                                <small class="d-block ">₹<span
                                                        class="discount-count">{{ array_sum(array_column($accessoriess, 'discount')) }}</span></small>
                                            </p>
                                        </a>
                                        <div class="d-flex justify-content-between align-items-center p-1 ps-0 ">
                                            <div class="fs-5 orange-variant rounded mx-1 px-2"><i
                                                    class="fa-solid fa-toolbox text-white"></i></div>
                                            <div class="text-end">
                                                <p class="m-0 ">Total: ₹<span
                                                        class="final-total-count">{{ array_sum(array_column($accessoriess, 'final_amount')) }}</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="card">
                                    <div class="card-body p-0" id="total-counter">
                                        <a href="javascript:void(0)"
                                            class="d-flex justify-content-between grey-variant px-1 py-2 rounded-top text-white">
                                            <p class="m-0"><b>Total(<span
                                                        class="tr-count">{{ count($spareParts) + count($lubes) + count($accessoriess) + count($extraCharges) }}</span>)</b>
                                            </p>
                                            <p class="text-end m-0">
                                                <b class="">₹<span
                                                        class="total-count">{{ $totalAmount }}</span></b>
                                                <small class="d-block ">₹<span class="discount-count">
                                                        {{ array_sum(array_column($spareParts, 'discount')) + array_sum(array_column($lubes, 'discount')) + array_sum(array_column($accessoriess, 'discount')) + array_sum(array_column($extraCharges, 'discount')) }}
                                                    </span></small>
                                            </p>
                                        </a>
                                        <div class="d-flex justify-content-between align-items-center p-1 ps-0 ">
                                            <div class="fs-5 grey-variant rounded mx-1 px-2"><i
                                                    class="fa-solid fa-calculator text-white"></i></div>
                                            <div class="text-end">
                                                <p class="m-0 ">Total: ₹<span
                                                        class="final-total-count">{{ $final_amount }}</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 table-view" id="tools-div"
                            style="display: {{ $showTable == 1 ? 'block' : 'none' }}">
                            <table class="table table-bordered" id="labour-table">
                                <thead>
                                    <th style="width: 380px">Title</th>
                                    <th style="width: 150px">Selling Price</th>
                                    <th style="width: 150px">Type</th>
                                    <th style="width: 280px">Mechanic</th>
                                    <th style="width: 150px">GST Type</th>
                                    <th style="width: 110px">GST</th>
                                    <th style="width: 160px">Total Amount</th>
                                    <th style="width: 110px">Action</th>
                                </thead>
                                <tbody>
                                    @foreach ($extraCharges as $index => $charge)
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control"
                                                    wire:model="extraCharges.{{ $index }}.label"
                                                    placeholder="Enter Label Here" readonly>
                                            </td>
                                            {{-- <td>
                                                    <input type="number" min="1" class="form-control"
                                                        wire:model.live="extraCharges.{{ $index }}.qty"
                                                        wire:change="calculateTotals" placeholder="Qty" />
                                                </td> --}}

                                            <td>
                                                <input type="number" class="form-control"
                                                    wire:model.lazy="extraCharges.{{ $index }}.amount"
                                                    wire:change="calculateTotals" placeholder="Enter Charge Here"
                                                    readonly>
                                            </td>


                                            <td>
                                                <input type="text" class="form-control"
                                                    value="{{ isset($charge['labour_type']) && $charge['labour_type'] !== ''
                                                        ? ucfirst($charge['labour_type'])
                                                        : (($charge['charge_type'] ?? 1) == 2
                                                            ? 'Outsource'
                                                            : 'Inhouse') }}"
                                                    readonly>

                                                {{-- Hidden fields for Livewire syncing --}}
                                                <input type="hidden"
                                                    wire:model="extraCharges.{{ $index }}.charge_type">
                                                <input type="hidden"
                                                    wire:model="extraCharges.{{ $index }}.labour_type">
                                            </td>



                                            {{-- <td>
                                                   @if (($charge['charge_type'] ?? 1) == 2)
                                                       ₹{{ number_format($charge['outsource_price'] ?? 0, 2) }}
                                                        @else
                                                        N/A
                                                        @endif
                                                        <input type="hidden" wire:model="extraCharges.{{ $index }}.outsource_price">
                                                 </td> --}}


                                            <td>
                                                <select wire:model="extraCharges.{{ $index }}.mechanic_id"
                                                    class="form-select mechanic-id"
                                                    data-index="{{ $index }}"
                                                    @if ($extraCharges[$index]['charge_type'] == 2 || $mechanic->isEmpty()) disabled @endif>
                                                    <option value="">--Choose Mechanic--</option>
                                                    @foreach ($mechanic as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->name }} {{ $item->lastname }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>


                                            <td>
                                                <input type="text" class="form-control"
                                                    wire:model="extraCharges.{{ $index }}.gst_type"
                                                    @readonly(true)>
                                            </td>

                                            <td>
                                                <input type="number" class="form-control"
                                                    wire:model.lazy="extraCharges.{{ $index }}.gst_percentage"
                                                    placeholder="Enter GST Here" @readonly(true)>
                                            </td>


                                            {{-- <td style="width: 60px">
                                                <input type="number" class="form-control"
                                                    value="{{ number_format($charge['product_cost'] ?? 0, 2, '.', '') }}"
                                                    @readonly(true)>
                                            </td> --}}

                                            {{-- <td style="width: 60px">
                                                <input type="number" class="form-control"
                                                    value="{{ number_format($charge['cost_amount'] ?? 0, 2, '.', '') }}"
                                                    @readonly(true)>
                                            </td> --}}

                                            <td style="width: 30px">
                                                <input type="number" class="form-control"
                                                    wire:model.live="extraCharges.{{ $index }}.charge"
                                                    placeholder="Enter Charge Here" @readonly(true)>
                                            </td>

                                            <td>
                                                <button class="btn btn-sm btn-danger rounded border-0 text-white"
                                                    wire:click="removeRow('extraCharges', {{ $index }})">Remove</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <td colspan="8">
                                            @if ($user->hasPermissionTo('Jobcard-edit'))
                                                <div class="d-flex">
                                                    <select id="extra_charges_dropdown"
                                                        wire:model="extra_charges_dropdown"
                                                        class="form-control select2"
                                                        data-property="extra_charges_dropdown"
                                                        style="width: 425px;">
                                                        <option value="">-- Select Labour Charges-- </option>
                                                        @foreach ($labourCharges as $item)
                                                            <option value="{{ $item['id'] }}"
                                                                data-label-name="{{ trim($item['title']) }}"
                                                                data-stock="{{ trim($item['stock']) }}"
                                                                data-price="{{ trim($item['price']) }}">
                                                                {{ $item['title'] }}
                                                                <small class="text-danger">(Price -
                                                                    {{ $item['total'] }})</small>

                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <button type="button"
                                                        class="btn btn-outline-secondary add-spare-btn ms-4"
                                                        wire:click="addExtraChargeRowEmpty">+</button>

                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="mt-4 table-view" id="spare-table"
                            style="display: {{ $showTable == 2 ? 'block' : 'none' }}">

                            <table class="table table-bordered" id="spare-part-table">
                                <thead>
                                    <tr>
                                        <th style="width: 380px">Part Name</th>
                                        <th style="width: 110px">Quantity</th>
                                        <th style="width: 150px">selling price</th>
                                        <th style="width: 280px">Discount</th>
                                        <th style="width: 150px">Tax type</th>
                                        <th style="width: 110px">Tax</th>
                                        <th style="width: 160px">Final Amount</th>
                                        <th style="width: 110px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($spareParts as $index => $part)
                                        <tr>
                                            <td><input type="text" class="form-control"
                                                    wire:model="spareParts.{{ $index }}.part_name"
                                                    placeholder="Part Name"></td>
                                            <td><input type="number" class="form-control"
                                                    wire:model.lazy="spareParts.{{ $index }}.quantity"></td>
                                            {{-- <td><input type="number" class="form-control"
                                            wire:model.lazy="spareParts.{{ $index }}.unit_price">
                                    </td> --}}

                                            {{-- <td >
                                                <input type="text" class="form-control bg-light"
                                                    wire:model="spareParts.{{ $index }}.purchase_price"
                                                    readonly>
                                            </td> --}}
                                            <td><input type="number" class="form-control"
                                                    wire:model.lazy="spareParts.{{ $index }}.unit_price">
                                            </td>
                                            {{-- <td><input type="number" class="form-control"
                                                    wire:model.lazy="spareParts.{{ $index }}.discount"></td> --}}
                                            <td>
                                                <div class="input-group">
                                                    <input type="number" class="form-control"
                                                        wire:model.lazy="spareParts.{{ $index }}.discount"
                                                        placeholder="Discount">

                                                    {{-- <span class="input-group-text">
            @if (isset($part['discount_type']) && $part['discount_type'] === 'percent')
                %
            @else
                ₹
            @endif
        </span> --}}

                                                    <select class="form-select"
                                                        wire:model.lazy="spareParts.{{ $index }}.discount_type">
                                                        <option value="fixed">₹</option>
                                                        <option value="percent">%</option>
                                                    </select>
                                                </div>
                                                {{-- <div class="d-flex gap-2 mt-1">
                                                    <input type="text" class="form-control bg-light"
                                                        placeholder="Tax Type"
                                                        wire:model="spareParts.{{ $index }}.tax_type"
                                                        readonly>
                                                    <input type="number" class="form-control bg-light"
                                                        placeholder="Tax %"
                                                        wire:model="spareParts.{{ $index }}.tax_percentage"
                                                        readonly>
                                                </div> --}}
                                            </td>

                                            <td>
                                                <input type="text" class="form-control bg-light"
                                                    placeholder="Tax Type"
                                                    wire:model="spareParts.{{ $index }}.tax_type" readonly>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control bg-light"
                                                    placeholder="Tax %"
                                                    wire:model="spareParts.{{ $index }}.tax_percentage"
                                                    readonly>
                                            </td>



                                            <td><input type="text" class="form-control bg-light"
                                                    wire:model="spareParts.{{ $index }}.final_amount"
                                                    readonly></td>
                                            <td>
                                                <button class="btn btn-sm btn-danger rounded border-0 text-white"
                                                    wire:click="removeRow('spareParts', {{ $index }})">
                                                    Remove
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <td colspan="8">
                                            <div class="d-flex">
                                                @if ($jobcardData->status != 3)
                                                    @if ($user->hasPermissionTo('Jobcard-edit'))
                                                        <select id="spare_parts_data" wire:model="spare_parts_data"
                                                            style="width: 425px;" class="form-control select2"
                                                            data-property="spare_parts_data">
                                                            <option value="">--Select Spare Part--</option>

                                                            @foreach ($spare as $item)
                                                                <option value="{{ $item['label_id'] }}"
                                                                    @disabled($item['stock'] <= 0)
                                                                    data-label-name="{{ $item['label_name'] }}"
                                                                    data-stock="{{ $item['stock'] }}"
                                                                    data-price="{{ $item['price'] }}">
                                                                    {{ $item['label_name'] }}
                                                                    {{ $item['stock'] <= 0 ? ' (Out of Stock) ' : '' }}
                                                                    <small>(Current Qty.
                                                                        {{ $item['stock'] }})</small>,
                                                                    <small class="text-danger">(Price -
                                                                        {{ $item['price'] }})</small>
                                                                </option>
                                                            @endforeach
                                                        </select>


                                                        <button type="button"
                                                            class="btn btn-outline-secondary add-spare-btn ms-4"
                                                            wire:click="addStockRows(2)">+</button>

                                                        <button type="button" style="width:180px"
                                                            class="btn btn-outline-secondary add-spare-btn ms-2"
                                                            wire:click="addSparePartRows">Online Stock</button>
                                                    @endif
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>


                        <div class="mt-4 table-view" id="lubes-table"
                            style="display: {{ $showTable == 3 ? 'block' : 'none' }}">
                            <table class="table table-bordered" id="lubes-table">
                                <thead>
                                    <tr>
                                        <th style="width: 380px">Part Name</th>
                                        <th style="width: 110px">Quantity</th>
                                        <th style="width: 150px">Seling Price</th>
                                        <th style="width: 280px">Discount</th>
                                        <th style="width: 150px">Tax Type</th>
                                        <th style="width: 110px">Tax</th>
                                        <th style="width: 160px">Final Amount</th>
                                        <th style="width: 110px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lubes as $index => $part)
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control"
                                                    wire:model="lubes.{{ $index }}.part_name"
                                                    placeholder="Part Name">
                                            </td>
                                            <td>
                                                <input type="number" class="form-control"
                                                    wire:model.lazy="lubes.{{ $index }}.quantity">
                                            </td>
                                            {{-- <td>
                                        <input type="number" class="form-control"
                                            wire:model.lazy="lubes.{{ $index }}.unit_price">
                                    </td> --}}

                                            {{-- <td>
                                                <input type="text" class="form-control bg-light"
                                                    wire:model="lubes.{{ $index }}.purchase_price" readonly>
                                            </td> --}}
                                            <td>
                                                <input type="number" class="form-control"
                                                    wire:model.lazy="lubes.{{ $index }}.unit_price">
                                            </td>
                                            {{-- <td>
                                                <input type="number" class="form-control"
                                                    wire:model.lazy="lubes.{{ $index }}.discount">
                                    </td> --}}

                                            <td>
                                                <div class="input-group">
                                                    <input type="number" class="form-control"
                                                        wire:model.lazy="lubes.{{ $index }}.discount"
                                                        placeholder="Discount">

                                                    {{-- <span class="input-group-text">
            @if (isset($lube['discount_type']) && $lube['discount_type'] === 'percent')
                %
            @else
                ₹
            @endif
        </span> --}}

                                                    <select class="form-select"
                                                        wire:model.lazy="lubes.{{ $index }}.discount_type"
                                                        style="max-width: 120px;">
                                                        <option value="fixed">₹</option>
                                                        <option value="percent">%</option>
                                                    </select>
                                                </div>
                                                {{-- <div class="d-flex gap-2 mt-1">
                                                    <input type="text" class="form-control bg-light"
                                                        placeholder="Tax Type"
                                                        wire:model="lubes.{{ $index }}.tax_type" readonly>
                                                    <input type="number" class="form-control bg-light"
                                                        placeholder="Tax %"
                                                        wire:model="lubes.{{ $index }}.tax_percentage"
                                                        readonly>
                                                </div> --}}
                                            </td>
                                            <td>
                                                <input type="text" class="form-control bg-light"
                                                    placeholder="Tax Type"
                                                    wire:model="lubes.{{ $index }}.tax_type" readonly>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control bg-light"
                                                    placeholder="Tax %"
                                                    wire:model="lubes.{{ $index }}.tax_percentage" readonly>
                                            </td>



                                            <td>
                                                <input type="text" class="form-control bg-light"
                                                    wire:model="lubes.{{ $index }}.final_amount" readonly>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-danger"
                                                    wire:click="removeRow('lubes', {{ $index }})">Remove</button>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="8">
                                            <div class="d-flex">
                                                @if ($jobcardData->status != 3)
                                                    @if ($user->hasPermissionTo('Jobcard-edit'))
                                                        <select id="lubes_data" wire:model="lubes_data"
                                                            style="width: 425px;" class="form-control select2"
                                                            data-property="lubes_data">

                                                            <option value="">--Select Lubes--</option>
                                                            @foreach ($lube as $item)
                                                                <option value="{{ $item['label_id'] }}"
                                                                    data-label-name="{{ $item['label_name'] }}"
                                                                    data-stock="{{ $item['stock'] }}"
                                                                    data-price="{{ $item['price'] }}"
                                                                    @disabled($item['stock'] <= 0)>
                                                                    {{ $item['label_name'] }}
                                                                    {{ $item['stock'] <= 0 ? ' (Out of Stock) ' : '' }}
                                                                    <small>(Current Qty.
                                                                        {{ $item['stock'] }})</small>,
                                                                    <small class="text-danger">(Price -
                                                                        {{ $item['price'] }})</small>
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                        <button type="button"
                                                            class="btn btn-outline-secondary add-spare-btn ms-4"
                                                            wire:click="addStockRows(3)">+</button>

                                                        <button type="button" style="width:180px"
                                                            class="btn btn-outline-secondary add-spare-btn ms-2"
                                                            wire:click="addSparePartRows">Online Stock</button>
                                                    @endif
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="mt-4  table-view" id="accessory-table"
                            style="display: {{ $showTable == 5 ? 'block' : 'none' }}">
                            <table class="table table-bordered" id="accessory-table">
                                <thead>
                                    <tr>
                                        <th style="width: 380px">Part Name</th>
                                        <th style="width: 110px">Quantity</th>
                                        <th style="width: 150px">Selling Price</th>
                                        <th style="width: 280px">Discount</th>
                                        <th style="width: 150px">Tax type</th>
                                        <th style="width: 110px">Tax</th>
                                        <th style="width: 160px">Final Amount</th>
                                        <th style="width: 110px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($accessoriess as $index => $part)
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control"
                                                    wire:model="accessoriess.{{ $index }}.part_name"
                                                    placeholder="Part Name">
                                            </td>
                                            <td>
                                                <input type="number" class="form-control"
                                                    wire:model.lazy="accessoriess.{{ $index }}.quantity">
                                            </td>
                                            {{-- <td>
                                        <input type="number" class="form-control"
                                            wire:model.lazy="accessoriess.{{ $index }}.unit_price">
                                    </td> --}}

                                            {{-- <td>
                                                <input type="text" class="form-control bg-light"
                                                    wire:model="accessoriess.{{ $index }}.purchase_price"
                                                    readonly>
                                            </td> --}}
                                            <td>
                                                <input type="number" class="form-control"
                                                    wire:model.lazy="accessoriess.{{ $index }}.unit_price">
                                            </td>
                                            {{-- <td>
                                                <input type="number" class="form-control"
                                                    wire:model.lazy="accessoriess.{{ $index }}.discount">
                                    </td> --}}


                                            <td>
                                                <div class="input-group">
                                                    <input type="number" class="form-control"
                                                        placeholder="Discount"
                                                        wire:model.lazy="accessoriess.{{ $index }}.discount" />

                                                    {{-- <span class="input-group-text">
            {{ isset($accessory['discount_type']) && $accessory['discount_type'] === 'percent' ? '%' : '₹' }}
                                            </span> --}}

                                                    <select class="form-select"
                                                        wire:model.lazy="accessoriess.{{ $index }}.discount_type"
                                                        style="max-width: 80px;">
                                                        <option value="fixed">₹</option>
                                                        <option value="percent">%</option>
                                                    </select>
                                                </div>
                                                {{-- <div class="d-flex gap-2 mt-1">
                                                    <input type="text" class="form-control bg-light"
                                                        placeholder="Tax Type"
                                                        wire:model="accessoriess.{{ $index }}.tax_type"
                                                        readonly>
                                                    <input type="number" class="form-control bg-light"
                                                        placeholder="Tax %"
                                                        wire:model="accessoriess.{{ $index }}.tax_percentage"
                                                        readonly>
                                                </div> --}}
                                            </td>
                                            <td>
                                                <input type="text" class="form-control bg-light"
                                                    placeholder="Tax Type"
                                                    wire:model="accessoriess.{{ $index }}.tax_type" readonly>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control bg-light"
                                                    placeholder="Tax %"
                                                    wire:model="accessoriess.{{ $index }}.tax_percentage"
                                                    readonly>
                                            </td>


                                            <td>
                                                <input type="text" class="form-control bg-light"
                                                    wire:model="accessoriess.{{ $index }}.final_amount"
                                                    readonly>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-danger"
                                                    wire:click="removeRow('accessoriess', {{ $index }})">Remove</button>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="8">
                                            <div class="d-flex">
                                                @if ($jobcardData->status != 3)
                                                    @if ($user->hasPermissionTo('Jobcard-edit'))
                                                        <select id="accessory_data" wire:model="accessory_data"
                                                            style="width: 425px;" class="form-control select2"
                                                            data-property="accessory_data">


                                                            <option value="">--Select Accessory--
                                                            </option>
                                                            @foreach ($accessory as $item)
                                                                <option value="{{ $item['label_id'] }}"
                                                                    @disabled($item['stock'] <= 0)
                                                                    data-label-name="{{ $item['label_name'] }}"
                                                                    data-stock="{{ $item['stock'] }}"
                                                                    data-price="{{ $item['price'] }}">
                                                                    {{ $item['label_name'] }}
                                                                    {{ $item['stock'] <= 0 ? ' (Out of Stock) ' : '' }}
                                                                    <small>(Current Qty.
                                                                        {{ $item['stock'] }})</small>,
                                                                    <small class="text-danger">(Price -
                                                                        {{ $item['price'] }})</small>
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                        <button type="button"
                                                            class="btn btn-outline-secondary add-spare-btn ms-4"
                                                            wire:click="addStockRows(5)">+</button>

                                                        <button type="button" style="width:180px"
                                                            class="btn btn-outline-secondary add-spare-btn ms-2"
                                                            wire:click="addSparePartRows">Online Stock</button>
                                                    @endif
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="row ">
                            <div class="col-md-6">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5>Job-Card Details</h5>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="cost-estimate" class="form-label">Cost
                                                        Estimate</label>
                                                    <input type="text" id="cost-estimate"
                                                        @disabled($jobcardData->status == 3 || !$user->hasPermissionTo('Jobcard-edit')) wire:model="totalAmount"
                                                        placeholder="Cost Estimate" class="form-control rounded">

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="delivery_date" class="form-label">Delivery
                                                        Date</label>
                                                    <input type="date" id="delivery_date"
                                                        @disabled($jobcardData->status == 3 || !$user->hasPermissionTo('Jobcard-edit')) wire:model="deliveryDate"
                                                        placeholder="Delivery Date" class="form-control rounded">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="delivery_time" class="form-label">Delivery
                                                        Time</label>
                                                    <input type="time" id="delivery_time"
                                                        @disabled($jobcardData->status == 3 || !$user->hasPermissionTo('Jobcard-edit')) wire:model="deliveryTime"
                                                        placeholder="Delivery Time" class="form-control rounded">
                                                </div>
                                            </div>
                                        </div>

                                        @if ($jobcardData->status != 0)
                                            <hr>
                                            <div class="mb-3">
                                                <label for="note" class="form-label">Note</label>
                                                <textarea class="form-control" wire:model="notes" rows="2" id="note"></textarea>
                                                <div class="text-end mt-2">
                                                    <button type="button" style="width: 180px;"
                                                        class="btn btn-outline-secondary bg-primary add-spare-btn"
                                                        wire:click="updateNote">Update Note</button>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card  h-100">
                                    <div class="card-body ">
                                        <h5>Billing Details</h5>

                                        @if ($jobcardData->status == 2 || $jobcardData->status == 3)
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="total-amount" class="form-label">Total
                                                            Amount</label>
                                                        <input type="text" id="total-amount"
                                                            wire:model="totalAmount" wire:model="totalAmount"
                                                            placeholder="Total Amount"
                                                            class="form-control bg-secondary text-white rounded"
                                                            readonly>
                                                        <input type="hidden" wire:model="total_amount"
                                                            id="total-amount" value="0">
                                                        @error('totalAmount')
                                                            <span class="text-danger error">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="final_discount"
                                                            class="form-label">Discount</label>
                                                        <input type="number" id="final_discount"
                                                            @disabled($jobcardData->status == 3 || !$user->hasPermissionTo('Jobcard-edit'))
                                                            wire:model.live="final_discount" min="0"
                                                            step="1" placeholder="Discount"
                                                            class="form-control rounded"
                                                            max="{{ $hidden_balance_amount }}"
                                                            oninput="if (parseFloat(this.value) > parseFloat({{ $hidden_balance_amount }})) this.value = {{ $hidden_balance_amount }};">
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="final-amount" class="form-label">Payable
                                                            Amount</label>
                                                        <input type="text" id="final-amount"
                                                            wire:model="final_amount" placeholder="Payble Amount"
                                                            class="form-control bg-secondary text-white rounded"
                                                            readonly>
                                                        @error('final_amont')
                                                            <span class="text-danger error">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="advance" class="form-label">Advance</label>
                                                        <input type="text" id="advance"
                                                            wire:model="advance" placeholder="Advance"
                                                            class="form-control rounded bg-secondary text-white"
                                                            readonly min="0" step="1">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="final_paid" class="form-label">Total Paid</label>
                                                        <input type="text" id="final_paid"
                                                            wire:model="final_paid"
                                                            placeholder="Total Paid" class="form-control bg-secondary text-white rounded"
                                                            readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="pending-amount" class="form-label">Pending
                                                            Amount</label>
                                                        <input type="text" id="pending-amount"
                                                            wire:model="balance_amount" value="0"
                                                            placeholder="Pending Amount"
                                                            class="form-control bg-secondary text-white rounded"
                                                            readonly>
                                                        <input type="hidden" id="pending-amount"
                                                            wire:model="hidden_balance_amount">
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="mb-3">
                                                <label for="total-amount" class="form-label">Total Amount</label>
                                                <input type="text" id="total-amount" wire:model="totalAmount"
                                                    wire:model="totalAmount" placeholder="Total Amount"
                                                    class="form-control bg-secondary text-white rounded" readonly>
                                                <input type="hidden" wire:model="total_amount" id="total-amount"
                                                    value="0">
                                                @error('totalAmount')
                                                    <span class="text-danger error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="final-amount" class="form-label">Payable
                                                            Amount</label>
                                                        <input type="text" id="pending-amount"
                                                            wire:model="final_amount"
                                                            class="form-control bg-secondary text-white rounded"
                                                            readonly>
                                                        @error('final_amount')
                                                            <span class="text-danger error">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="advance" class="form-label">Advance Paid</label>
                                                        <input type="text" id="advance" wire:model="advance"
                                                            placeholder="Advance Paid" class="form-control bg-secondary text-white rounded"
                                                            readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="pending-amount" class="form-label">Pending
                                                            Amount</label>
                                                        <input type="text" id="pending-amount"
                                                            wire:model="balance_amount"
                                                            value="0"
                                                            class="form-control bg-secondary text-white rounded"
                                                            readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @if($jobcardData->status != 0)
                                        <!-- Payment History Ledger -->
                                        <div class="mt-4 pt-3 border-top">
                                            <h6 class="mb-3 text-primary font-weight-bold" style="font-size: 1rem; border-bottom: 2px solid #007bff; display: inline-block; padding-bottom: 3px;">Payment History Ledger</h6>
                                            @if(!empty($payments_list))
                                                <div class="table-responsive mb-3">
                                                    <table class="table table-sm table-striped table-hover align-middle">
                                                        <thead class="bg-light">
                                                            <tr>
                                                                <th>Date</th>
                                                                <th>Amount</th>
                                                                <th>Payment Method</th>
                                                                <th>Transaction Number</th>
                                                                @if($jobcardData->status != 3)
                                                                    <th class="text-center">Action</th>
                                                                @endif
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($payments_list as $pay)
                                                                <tr>
                                                                    <td>{{ \Carbon\Carbon::parse($pay['created_at'])->format('d-M-Y H:i') }}</td>
                                                                    <td class="font-weight-bold">₹{{ number_format($pay['amount'], 2) }}</td>
                                                                    <td>
                                                                        <span class="badge bg-info text-capitalize">{{ str_replace('_', ' ', $pay['payment_type']) }}</span>
                                                                    </td>
                                                                    <td>{{ $pay['transaction_number'] ?? 'N/A' }}</td>
                                                                    @if($jobcardData->status != 3)
                                                                        <td class="text-center">
                                                                            <button type="button" class="btn btn-sm btn-outline-danger" 
                                                                                wire:click="deletePayment({{ $pay['id'] }})"
                                                                                wire:confirm="Are you sure you want to delete this payment?">
                                                                                <i class="fa fa-trash"></i>
                                                                            </button>
                                                                        </td>
                                                                    @endif
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @else
                                                <div class="alert alert-info py-2 text-center" style="font-size: 0.9rem;">
                                                    No payments recorded yet.
                                                </div>
                                            @endif

                                            <!-- Add New Payment Form (Only if Job Card is not closed) -->
                                            @if($jobcardData->status != 3)
                                                <div class="card bg-light border-0 shadow-sm p-3 mt-3">
                                                    <div class="row g-3 align-items-end">
                                                        <div class="col-md-3">
                                                            <label class="form-label" style="font-size: 0.85rem; font-weight: 500;">Payment Amount <span class="text-danger">*</span></label>
                                                            <input type="number" step="0.01" class="form-control @error('new_payment_amount') is-invalid @enderror" 
                                                                wire:model="new_payment_amount" placeholder="e.g. 500">
                                                            @error('new_payment_amount')
                                                                <span class="invalid-feedback d-block">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label" style="font-size: 0.85rem; font-weight: 500;">Payment Method <span class="text-danger">*</span></label>
                                                            <select class="form-select @error('new_payment_type') is-invalid @enderror" wire:model="new_payment_type">
                                                                <option value="">Select Method</option>
                                                                <option value="cash">Cash</option>
                                                                <option value="upi">UPI</option>
                                                                <option value="card">Card</option>
                                                                <option value="cheque">Cheque</option>
                                                                <option value="wallet">Wallet</option>
                                                                <option value="net_banking">Net Banking</option>
                                                            </select>
                                                            @error('new_payment_type')
                                                                <span class="invalid-feedback d-block">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label" style="font-size: 0.85rem; font-weight: 500;">
                                                                {{ $new_payment_type === 'cheque' ? 'Cheque Number' : 'Transaction ID' }}
                                                            </label>
                                                            <input type="text" class="form-control @error('new_payment_transaction_number') is-invalid @enderror" 
                                                                wire:model="new_payment_transaction_number" placeholder="Ref/Chq No.">
                                                            @error('new_payment_transaction_number')
                                                                <span class="invalid-feedback d-block">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-3 text-end text-md-start">
                                                            <button type="button" class="btn btn-success w-100" wire:click="addPayment">
                                                                <i class="fa fa-plus-circle me-1"></i> Add Payment
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
@endif

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- manku --}}
    <div class="footer d-flex align-items-center p-3">

        <a href="javascript:void(0);" class="btn btn-outline-secondary mx-1" wire:click="printPdf"
            style="font-weight: 300 !important; background-color:#ADB4BF ">
            <i class="fa fa-print" style="font-size: small;"></i>
        </a>
        <a href="javascript:void(0);" class="btn btn-outline-secondary mx-1" wire:click="downloadPdf"
            style="font-weight: 300 !important; background-color:#ADB4BF">
            <i class="fas fa-file-pdf" aria-hidden="true"></i>
        </a>

        @if (isset($customer_data->email) && !empty($customer_data->email))
            @if ($jobcardData->step != 0)
                <a href="javascript:void(0);" class="btn btn-outline-secondary mx-1"
                    wire:click="sendInvoiceMail({{ $jobcardData->id }})"
                    style="font-weight: 300 !important; background-color:#ADB4BF">
                    <i class="fa fa-envelope " wire:loading.remove=""
                        wire:target="sendInvoiceMail({{ $jobcardData->id }})" style="font-size: small;"></i>
                    <span wire:loading="" wire:target="sendInvoiceMail({{ $jobcardData->id }})">
                        <i class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></i>
                    </span>
                </a>
            @endif
        @endif
        @if ($jobcardData->step != 0)
            @php

                $customerName =
                    optional($jobcardData->Customer)->name . ' ' . optional($jobcardData->Customer)->lastname;
                $vehiclePlate = optional($jobcardData->Vehicle)->number_plate;
                $phone = optional($jobcardData->Customer)->mobile_no ?? '0000000000'; // Fallback number if phone is null

                if ($jobcardData->status == 2 || $jobcardData->status == 3) {
                    $message = 'Hello, *' . trim($customerName) . "*\n\n";
                    $message .= "Thank you for choosing our service centre for your vehicle maintenance.\n\n";
                    $message .=
                        'We have completed the service for your vehicle *' .
                        $vehiclePlate .
                        "* and generated the invoice.\n\n";
                    $message .= "Please find the invoice attached for your reference.\n\n";
                    // $message .= "Regards,\nCarnet\n\n";
                    $message .= "Click the link below to download your invoice:\n";
                    $invoiceDownloadLink = route('customer.estimate.download', [
                        base64_encode($jobcardData->id),
                        base64_encode(1),
                    ]);
                    $message .= $invoiceDownloadLink;
                } else {
                    $message = 'Hello, *' . trim($customerName) . "*\n\n";
                    $message .= "Thank you for choosing our service centre for your vehicle maintenance.\n\n";
                    $message .=
                        'We have thoroughly inspected your vehicle and prepared a service quotation for your *' .
                        $vehiclePlate .
                        "*.\n\n";
                    $message .= "Please find the attached estimate for your request.\n\n";
                    // $message .= "Regards,\nCarnet\n\n";

                    $url = route('estimate.accept', [
                        'status' => 1,
                        'id' => base64_encode($jobcardData->id),
                        'userId' => base64_encode(base64_encode($jobcardData->customer?->id ?? 0)), // Removed extra base64_encode()
                    ]);

                    $estimateUrl = route('customer.estimate.download', [
                        base64_encode($jobcardData->id),
                        base64_encode(0),
                    ]);

                    $message .= "👉 *Click here to download estimate pdf:* $estimateUrl\n\n";
                    $message .= "👉 *Click here to respond:* $url\n\n";
                }

                $whatsappLink = "https://web.whatsapp.com/send?phone=$phone&text=" . rawurlencode($message);
            @endphp

            <a href="{{ $whatsappLink }}" class="btn btn-outline-secondary mx-1"
                style="font-weight: 300 !important; background-color:#fff" target="_blank">
                <img src="{{ asset('img/whatsapp.png') }}" alt="WhatsApp" height="20px" width="20px">
            </a>
        @endif








        <!-- SMS Alert Toggle -->
        <div class="col-auto">
            <div class="form-check form-switch ms-4">
                <input wire:model="smsAlert" class="form-check-input fs-6" type="checkbox" role="switch"
                    id="sms-alert">
                <label class="form-check-label fs-5" for="sms-alert">SMS Alert</label>
            </div>
        </div>


        <!-- Create Job-Card Button Section -->
        <div class="col-auto ms-auto">
            <div>
                @if ($jobcardData->status == 0 || $jobcardData->status == 1 || $jobcardData->status == 4)
                    @if ($user->hasPermissionTo('Jobcard-edit'))
                        <button type="button" class="btn btn-primary rounded border-0 text-white"
                            wire:click="updateJobCard({{ $jobcardData->status }})">
                            <small>Update Job-Card</small>
                        </button>
                    @endif
                @elseif ($jobcardData->status == 2)
                    @if ($user->hasPermissionTo('completed-jobcard-update'))
                        <button type="button" class="btn btn-primary rounded border-0 text-white"
                            wire:click="updateJobCard({{ $jobcardData->status }})">
                            <small>Update Job-Card</small>
                        </button>
                    @endif
                @endif

                @if ($jobcardData->status == 0 && $jobcardData->step == 1)
                    @if ($user->hasPermissionTo('Jobcard-edit'))
                        <button type="button" class="btn btn-primary rounded border-0 text-white"
                            wire:click="updateJobCard(1)">
                            <small>Confirm Job-Card</small>
                        </button>
                    @endif
                @endif

                @if ($jobcardData->status == 0)
                    @if ($jobcardData->step == 0)
                        @if ($user->hasPermissionTo('Jobcard-edit'))
                            <button type="button" class="btn btn-primary rounded border-0 text-white"
                                wire:click="updateJobCard(4,1);">
                                <small>Process Job-Card</small>
                            </button>
                        @endif
                    @endif
                @elseif ($jobcardData->status == 4)
                    @if ($user->hasPermissionTo('Jobcard-edit'))
                        <button type="button" class="btn btn-primary rounded border-0 text-white"
                            wire:click="updateJobCard(1)">
                            <small>Confirm Job-Card</small>
                        </button>
                    @endif
                @elseif ($jobcardData->status == 1)
                    @if ($user->hasPermissionTo('completed-jobcard-update'))
                        <button type="button" class="btn btn-primary rounded border-0 text-white"
                            wire:click="updateJobCard(2)">
                            <small>Complete Job-Card</small>
                        </button>
                    @endif
                @elseif ($jobcardData->status == 2)
                    @if ($user->hasPermissionTo('completed-jobcard-update'))
                        <button type="button" class="btn btn-primary rounded border-0 text-white"
                            wire:click="confirmClosed(3)">
                            <small>Close Job-Card</small>
                        </button>
                    @endif
                @else
                    <span class="btn btn-warning border-0">Job-Card Closed</span>
                @endif

                <input type="hidden" name="step" id="step" />
                <input type="hidden" name="status" id="status" />
            </div>
        </div>
    </div>


    <div class="modal @if ($showDentCar) show @endif" tabindex="-1"
        style="opacity: 1; background-color: #0606068c; display: @if ($showDentCar) block @else none @endif;">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                {{-- <form wire:submit.prevent="{{ $showDentCar ? 'saveImage' : 'saveImage' }}"> --}}
                <div class="modal-header">
                    <button type="button" class="btn-close" wire:click="closeModal"
                        aria-label="Close"></button>
                </div>

                @if (!empty($jobCardsDentImage))
                    <img id="carImageTag" src="{{ asset($imagePath) }}" alt="Car Image" class="w-75" />
                    <div class="row">
                        <div class="col-6 mx-2">
                            <button id="deleteBtn" wire:click="confirmDelete({{ $jobCardsDentImage->id }})"
                                class="btn btn-danger mt-3 rounded text-white border-white" fdprocessedid="3j5af">
                                Delete Image
                            </button>
                        </div>
                    </div>
                @else
                    <div class="modal-body py-3">
                        <!-- Control Buttons -->
                        <div class="controls">
                            <button id="dentBtn" class="btn btn-warning active">Dent</button>
                            <button id="scratchBtn" class="btn btn-success">Scratch</button>
                            <button id="breakBtn" class="btn btn-danger">Break</button>
                            <button id="eraseBtn" class="btn btn-secondary">Erase</button>
                            <button id="clearBtn" class="btn btn-light">Clear All</button>
                            <button id="saveBtn" class="btn btn-primary mt-2"> <small> Save Image </small></button>
                        </div>

                        <!-- Car Image -->
                        <img id="carImageTag" src="{{ asset('assets/dentcar/car.jpg') }}" style="display:none;"
                            alt="Car Image">

                        <!-- Canvas Container -->
                        <div class="canvas-container" style="position: relative;">
                            <!-- Background Canvas -->
                            <canvas id="backgroundCanvas"></canvas>
                            <!-- Overlay Canvas (For Drawing) -->
                            <canvas id="overlayCanvas" style="position: absolute; top: 0; left: 0;"></canvas>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@section('footerscript')
    <script>
        document.addEventListener('toastr-error', event => {
            toastr.error(event.__livewire.params[0].message);
        });


        document.addEventListener('livewire:init', () => {
            const initializeSelect2 = () => {
                $('#customer_name').select2({
                    placeholder: "Select Customer or Vehicle",
                    ajax: {
                        url: '/workshop/customers',
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            return {
                                search: params.term,
                                page: params.page || 1,
                            };
                        },
                        processResults: function(data, params) {

                            params.page = params.page || 1;

                            // Ensure data.data is an array before calling map()
                            const results = Array.isArray(data.data) ? data.data.map(item => ({
                                id: item.id,
                                text: `${item.name || ''} ${item.lastname || ''}/${item.mobile_no || ''}/${item.number_plate || ''}`,
                            })) : [];

                            return {
                                results: results,
                                pagination: {
                                    more: data.next_page_url != null
                                }
                            };
                        },
                        cache: true,
                    }
                }).on('select2:select', function(e) {
                    const selected = e.params.data;
                    // Emit the selected ID to Livewire
                    @this.set('vehicle_id', selected.id);

                });
            };

            initializeSelect2();

            Livewire.hook('morphed', (message, component) => {
                initializeSelect2();
            });

            Livewire.on('pdfPreiview', (event) => {
                window.open(event, '_blank');
            });
        });

        document.addEventListener('livewire:init', function() {


            Livewire.hook('morphed', (message, component) => {
                $('.select2').select2().on('change', function(e) {
                    const selectedValues = $(this).val();
                    @this.set(e.target.dataset.property, selectedValues);
                });
            });


        });

        document.addEventListener('livewire:init', () => {


            $('#extra_charges_dropdown').select2({
                placeholder: "Select labour charges"
            }).on('change', function() {
                @this.set('extra_charges_dropdown', $(this).val());
            });

            $('#spare_parts_data').select2({
                placeholder: "Select Spare Part"
            }).on('change', function() {
                let selectedValue = $(this).val();
                let selectedOption = $(this).find('option:selected');
                let price = selectedOption.data('price');
                @this.set('spare_parts_data', selectedValue);
                @this.set('spare_parts_price', price);
            });


            $('#lubes_data').select2({
                placeholder: "Select Lubes"
            }).on('change', function() {
                let selectedValue = $(this).val();
                let selectedOption = $(this).find('option:selected');
                let price = selectedOption.data('price');
                @this.set('lubes_data', selectedValue);
                @this.set('lubes_data_price', price);
            });

            $('#accessory_data').select2({
                placeholder: "Select Accessory"
            }).on('change', function() {
                let selectedValue = $(this).val();
                let selectedOption = $(this).find('option:selected');
                let price = selectedOption.data('price');
                @this.set('accessory_data', selectedValue);
                @this.set('accessory_data_price', price);
            });

            //    const fields = ['#extra_charges', '#spare_parts_data', '#lubes_data', '#accessory_data'];


            //    fields.forEach(field => {
            //        const firstOption = $(`${field} option:first`);
            //        $(field).val(firstOption.val()).trigger('change');
            //    });

            Livewire.hook('morphed', (message, component) => {
                // $('#customer_name').select2({ placeholder: "Select customer" });
                // $('#vehicle_id').select2({ placeholder: "Select vehicle" });
                $('#extra_charges_dropdown').select2({
                    placeholder: "Select labour charges"
                });
                $('#spare_parts_data').select2({
                    placeholder: "Select Spare part"
                });
                $('#lubes_data').select2({
                    placeholder: "Select Lubes"
                });
                $('#accessory_data').select2({
                    placeholder: "Select Accessory"
                });
            });

        });



        document.addEventListener('livewire:init', () => {

            $('#search_customer_voice').select2({
                placeholder: "Search Customer Voices",
                ajax: {
                    url: '/workshop/customers-voice',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            search: params.term,
                            page: params.page || 1,
                        };
                    },
                    processResults: function(data, params) {

                        params.page = params.page || 1;


                        const results = Array.isArray(data.data) ? data.data.map(item => ({
                            id: item.id,
                            text: `${item.customer_voice || ''}`,
                        })) : [];

                        return {
                            results: results,
                            pagination: {
                                more: data.next_page_url != null
                            }
                        };
                    },
                    cache: true,
                }
            }).on('change', function() {
                let selectedValue = $(this).val(); // Get the selected value

                @this.set('search_customer_voice', selectedValue);
            });


            $('#search_accessory').select2({
                placeholder: "Search Accessory",
                ajax: {
                    url: '/workshop/accessory',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            search: params.term,
                            page: params.page || 1,
                        };
                    },
                    processResults: function(data, params) {

                        params.page = params.page || 1;


                        const results = Array.isArray(data.data) ? data.data.map(item => ({
                            id: item.id,
                            text: `${item.customer_voice || ''}`,
                        })) : [];

                        return {
                            results: results,
                            pagination: {
                                more: data.next_page_url != null
                            }
                        };
                    },
                    cache: true,
                }
            }).on('change', function() {
                let selectedValue = $(this).val(); // Get the selected value

                @this.set('search_accessory', selectedValue);
            });



            $('#search_work_notes').select2({
                placeholder: "Search Work Notes",
                ajax: {
                    url: '/workshop/worknotes',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            search: params.term,
                            page: params.page || 1,
                        };
                    },
                    processResults: function(data, params) {

                        params.page = params.page || 1;


                        const results = Array.isArray(data.data) ? data.data.map(item => ({
                            id: item.id,
                            text: `${item.customer_voice || ''}`,
                        })) : [];

                        return {
                            results: results,
                            pagination: {
                                more: data.next_page_url != null
                            }
                        };
                    },
                    cache: true,
                }
            }).on('change', function() {
                let selectedValue = $(this).val(); // Get the selected value

                @this.set('search_work_notes', selectedValue);
            });

            $('#search_vehicle').select2({
                placeholder: "Search Vehicle",
                ajax: {
                    url: '/workshop/vehicle',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            search: params.term,
                            page: params.page || 1,
                        };
                    },
                    processResults: function(data, params) {

                        params.page = params.page || 1;


                        const results = Array.isArray(data.data) ? data.data.map(item => ({
                            id: item.id,
                            text: `${item.vehicle_details || ''}`,
                        })) : [];

                        return {
                            results: results,
                            pagination: {
                                more: data.next_page_url != null
                            }
                        };
                    },
                    cache: true,
                }
            }).on('change', function() {
                let selectedValue = $(this).val(); // Get the selected value

                @this.set('search_vehicle', selectedValue);
            });



            initSelect2();

            Livewire.hook('morphed', (message, component) => {

                initSelect2();

                $('#search_customer_voice').select2({
                    placeholder: "Search Customer Voices",
                    ajax: {
                        url: '/workshop/customers-voice',
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            return {
                                search: params.term,
                                page: params.page || 1,
                            };
                        },
                        processResults: function(data, params) {

                            params.page = params.page || 1;

                            // Ensure data.data is an array before calling map()
                            const results = Array.isArray(data.data) ? data.data.map(item => ({
                                id: item.id,
                                text: `${item.customer_voice || ''}`,
                            })) : [];

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


                $('#search_accessory').select2({
                    placeholder: "Search Accessory",
                    ajax: {
                        url: '/workshop/accessory',
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            return {
                                search: params.term,
                                page: params.page || 1,
                            };
                        },
                        processResults: function(data, params) {

                            params.page = params.page || 1;

                            // Ensure data.data is an array before calling map()
                            const results = Array.isArray(data.data) ? data.data.map(item => ({
                                id: item.id,
                                text: `${item.customer_voice || ''}`,
                            })) : [];

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


                $('#search_work_notes').select2({
                    placeholder: "Search Work Notes",
                    ajax: {
                        url: '/workshop/worknotes',
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            return {
                                search: params.term,
                                page: params.page || 1,
                            };
                        },
                        processResults: function(data, params) {

                            params.page = params.page || 1;

                            // Ensure data.data is an array before calling map()
                            const results = Array.isArray(data.data) ? data.data.map(item => ({
                                id: item.id,
                                text: `${item.customer_voice || ''}`,
                            })) : [];

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

                $('#search_vehicle').select2({
                    placeholder: "Search Vehicle",
                    ajax: {
                        url: '/workshop/vehicle',
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            return {
                                search: params.term,
                                page: params.page || 1,
                            };
                        },
                        processResults: function(data, params) {

                            params.page = params.page || 1;

                            // Ensure data.data is an array before calling map()
                            const results = Array.isArray(data.data) ? data.data.map(item => ({
                                id: item.id,
                                text: `${item.vehicle_details || ''}`,
                            })) : [];

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
        });





        document.addEventListener('show-dent-modal', () => {

            const modal = document.querySelector('.modal');
            const backgroundCanvas = document.getElementById('backgroundCanvas');
            const overlayCanvas = document.getElementById('overlayCanvas');
            const bgCtx = backgroundCanvas.getContext('2d');
            const overlayCtx = overlayCanvas.getContext('2d');
            const carImageTag = document.getElementById('carImageTag');
            const carImage = new Image();


            // Set the source dynamically using Laravel's `asset()` helper function
            carImage.src = "{{ asset('assets/dentcar/car.jpg') }}"; // This will insert the correct URL

            // When modal is triggered
            const showModalButton = document.getElementById(
                'showModalButton'); // Assuming you have a button to show the modal
            if (showModalButton) {
                showModalButton.addEventListener('click', () => {
                    modal.classList.add('show');
                    modal.style.display = 'block'; // Make sure modal is visible
                    carImageTag.style.display = 'block'; // Ensure the image is also visible
                });
            }

            // Image load event to ensure image is drawn when fully loaded
            carImage.onload = () => {
                const scaleFactor = 0.7; // Resize image to 70%
                const newWidth = carImage.width * scaleFactor;
                const newHeight = carImage.height * scaleFactor;

                // Set canvas dimensions
                backgroundCanvas.width = newWidth;
                backgroundCanvas.height = newHeight;
                overlayCanvas.width = newWidth;
                overlayCanvas.height = newHeight;

                // Draw the image on the background canvas
                bgCtx.drawImage(carImage, 0, 0, newWidth, newHeight);
            };

            // Drawing Logic
            let drawing = false;
            let mode = 'dent'; // Default mode

            const penSettings = {
                dent: {
                    color: 'yellow',
                    size: 5
                },
                scratch: {
                    color: 'green',
                    size: 5
                },
                break: {
                    color: 'red',
                    size: 5
                },
                erase: {
                    size: 15
                } // Eraser size
            };

            // Mode Switching
            const buttons = document.querySelectorAll('.controls button');
            buttons.forEach(button => {
                button.addEventListener('click', () => {
                    buttons.forEach(btn => btn.classList.remove('active'));
                    button.classList.add('active');
                    mode = button.id.replace('Btn', '');
                });
            });

            // Overlay Canvas Event Listeners
            overlayCanvas.addEventListener('mousedown', () => {
                drawing = true;
                overlayCtx.beginPath();
            });
            overlayCanvas.addEventListener('mouseup', () => {
                drawing = false;
                overlayCtx.beginPath();
            });
            overlayCanvas.addEventListener('mousemove', draw);

            function draw(event) {
                if (!drawing) return;

                const rect = overlayCanvas.getBoundingClientRect();
                const x = event.clientX - rect.left;
                const y = event.clientY - rect.top;

                overlayCtx.lineCap = 'round';

                if (mode === 'erase') {
                    overlayCtx.globalCompositeOperation = 'destination-out';
                    overlayCtx.lineWidth = penSettings.erase.size;
                } else {
                    overlayCtx.globalCompositeOperation = 'source-over';
                    overlayCtx.strokeStyle = penSettings[mode].color;
                    overlayCtx.lineWidth = penSettings[mode].size;
                }

                overlayCtx.lineTo(x, y);
                overlayCtx.stroke();
                overlayCtx.beginPath();
                overlayCtx.moveTo(x, y);
            }

            // Clear Overlay Canvas
            document.getElementById('clearBtn').addEventListener('click', () => {
                overlayCtx.clearRect(0, 0, overlayCanvas.width, overlayCanvas.height);
            });
            let beta = 0;

            // Save Merged Image and Send to Laravel
            document.getElementById('saveBtn').addEventListener('click', () => {
                if (beta = 0) {
                    beta = 1;
                    if (!confirm("Are you sure you want to save the changes?")) return;
                }
                //    ekk variable banano bata name rahe 1 ho jaye agar


                const mergedCanvas = document.createElement('canvas');
                const mergedCtx = mergedCanvas.getContext('2d');

                mergedCanvas.width = backgroundCanvas.width;
                mergedCanvas.height = backgroundCanvas.height;

                mergedCtx.drawImage(backgroundCanvas, 0, 0);
                mergedCtx.drawImage(overlayCanvas, 0, 0);

                const mergedImageData = mergedCanvas.toDataURL('image/png');

                // Send the image data to Livewire
                Livewire.dispatch('saveImage', {
                    mergedImageData: mergedImageData
                });

            });
        });

        function validateMaxQuantity(input) {
            // Get the max quantity value
            var maxQuantity = parseInt(input.getAttribute('max'));

            // If the current value exceeds max quantity, reset it to max
            if (parseInt(input.value) > maxQuantity) {
                input.value = maxQuantity;
            }
        }

        document.addEventListener('livewire:initialized', () => {
            $(".wrapper").hasClass("toggled") ?
                ($(".wrapper").removeClass("toggled"), $(".sidebar-wrapper").unbind("hover")) :
                ($(".wrapper").addClass("toggled"), $(".sidebar-wrapper").hover(function() {
                    $(".wrapper").addClass("sidebar-hovered")
                }, function() {
                    $(".wrapper").removeClass("sidebar-hovered")
                }));
        })

        function initSelect2() {
            // Select2 elements are handled by searchable-select-script
        }
    </script>
    <script>
        function toggleMechanicDropdowns() {
            console.log('Running toggleMechanicDropdowns...');
            document.querySelectorAll('.labour-type-hidden').forEach(function(hiddenInput) {
                const index = hiddenInput.dataset.index;
                const labourType = hiddenInput.value.trim().toLowerCase();
                const mechanicSelect = document.querySelector(`.mechanic-id[data-index="${index}"]`);

                console.log(`Index: ${index}, Type: ${labourType}`);

                if (mechanicSelect) {
                    if (labourType === 'outsource') {
                        mechanicSelect.disabled = true;
                        mechanicSelect.classList.add('bg-light');
                    } else {
                        mechanicSelect.disabled = false;
                        mechanicSelect.classList.remove('bg-light');
                    }
                }
            });
        }

        document.addEventListener("DOMContentLoaded", function() {
            toggleMechanicDropdowns();

            Livewire.hook('message.processed', () => {
                toggleMechanicDropdowns();
            });
        });
    </script>
@endsection
