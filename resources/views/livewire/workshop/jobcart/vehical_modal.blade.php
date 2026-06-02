<div>
<div class="modal @if ($vehicleDetails) show @endif" tabindex="-1"
style="opacity:1; background-col-md-6or:#0606068c; display:@if ($vehicleDetails) block @endif">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <form wire:submit.prevent="{{ $isEdits ? 'storeCustomer' : 'vehicleData' }}">
            <div class="modal-header">
                <h4 class="modal-title">{{ $isEdits ? 'Edit Staff' : 'Vehicle Details' }}</h4>
                <button type="button" class="btn-close" wire:click="$set('vehicleDetails', false)"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-3">
                @csrf
                <div class="row g-3">
                   
                   
                        <div class="col-md-6">
                             <label class="form-label">Vehicle Type<sup class="text-danger">*</sup></label>
                            <div class="input-group">
                                <select wire:model="vehicle_id" class="form-control" >
                                    <option value="">Select</option>
                                    <option value="PickUp">PickUp</option>
                                    <option value="SUV">SUV</option>
                                </select>
                                <button type="button" class="btn btn-primary" wire:click="addVehicalType">+</button>
                            </div>
                            @error('vehicle_id') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6">
                             <label class="form-label">Number Plate<sup class="text-danger">*</sup></label>
                            <input type="text" wire:model="numberPlate" class="form-control" placeholder="Enter Number Plate">
                            @error('numberPlate') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                  
                        <div class="col-md-6">
                             <label class="form-label">Vehicle Brand<sup class="text-danger">*</sup></label>
                            <div class="input-group">
                                <select wire:model="vehicleBrand" class="form-control">
                                    <option value="">Select</option>
                                    <option value="FORD">FORD</option>
                                </select>
                                <button type="button" class="btn btn-primary" wire:click="addBrandType">+</button>
                            </div>
                            @error('vehicleBrand') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6">
                             <label class="form-label">Chassis No</label>
                            <input type="text" wire:model="chassisNo" class="form-control" placeholder="Enter Chassis No">
                        </div>
                   
                        <div class="col-md-6">
                             <label class="form-label">Model Name<sup class="text-danger">*</sup></label>
                            <div class="input-group">
                                <select wire:model="modelName" class="form-control">
                                    <option value="">Select</option>
                                    <option value="F 150">F 150</option>
                                </select>
                                <button type="button" class="btn btn-primary" wire:click="addModelType">+</button>
                            </div>
                            @error('modelName') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6">
                             <label class="form-label">Model Year</label>
                            <input type="text" wire:model="modelYear" class="form-control" placeholder="Enter Model Year">
                        </div>
                   
                        <div class="col-md-6">
                             <label class="form-label">Fuel Type<sup class="text-danger">*</sup></label>
                            <div class="input-group">
                                <select wire:model="fuel_id" class="form-control">
                                    <option value="">Select</option>
                                    <option value="Diesel">Diesel</option>
                                    <option value="Petrol">Petrol</option>
                                </select>
                                <button type="button" class="btn btn-primary"  wire:click="addFuelType">+</button>
                            </div>
                            @error('fuel_id') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6">
                             <label class="form-label">No of Gear</label>
                            <input type="text" wire:model="noOfGear" class="form-control" placeholder="Enter No of Gear">
                        </div>
                    
                        <div class="col-md-6">
                             <label class="form-label">Odometer Reading</label>
                            <input type="text" wire:model="odometerReading" class="form-control" placeholder="Enter Odometer Reading">
                        </div>
                        <div class="col-md-6">
                             <label class="form-label">Date of Manufacturing</label>
                            <input type="date" wire:model="dateOfManufacturing" class="form-control">
                        </div>
                   
                        <div class="col-md-6">
                             <label class="form-label">Gearbox</label>
                            <input type="text" wire:model="gearbox" class="form-control" placeholder="Enter Gearbox">
                        </div>
                        <div class="col-md-6">
                             <label class="form-label">Gearbox No</label>
                            <input type="text" wire:model="gearboxNo" class="form-control" placeholder="Enter Gearbox No">
                        </div>
                   
                        <div class="col-md-6">
                             <label class="form-label">Engine No</label>
                            <input type="text" wire:model="engineNo" class="form-control" placeholder="Enter Engine No">
                        </div>
                        <div class="col-md-6">
                             <label class="form-label">Engine Size</label>
                            <input type="text" wire:model="engineSize" class="form-control" placeholder="Enter Engine Size">
                        </div>
                    
                        <div class="col-md-6">
                             <label class="form-label">Engine</label>
                            <input type="text" wire:model="engine" class="form-control" placeholder="Enter Engine">
                        </div>
                        <div class="col-md-6">
                             <label class="form-label">Key No</label>
                            <input type="text" wire:model="keyNo" class="form-control" placeholder="Enter Key No">
                        </div>
                    
            </div>
        </div>
 
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" wire:click="$set('vehicleDetails', false)"
            data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">
            {{ $isEdits ? 'Update' : 'Create' }}
            <i class="spinner-border spinner-border-sm" wire:loading></i>
        </button>
    </div>
    </form>
</div>
</div>
</div>

<div class="modal @if ($showVehical) show @endif" tabindex="-1"
    style="opacity: 1; background-col-md-6or: #0606068c; display: @if ($showVehical) block @endif">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form wire:submit.prevent="storeCustomer">
                <div class="modal-header">
                    <h4 class="modal-title">{{ $isVehical ? 'Edit Vehicle' : 'Add Vehicle Type' }}</h4>
                    <button type="button" class="btn-close" wire:click="$set('showVehical', false)"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body py-3">
                    @csrf
                    <div class="modal-body">
                        <input type="text" class="form-control" placeholder="Enter Vehicle Type" wire:model="vehicleType">
                        @error('vehicleType') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" wire:click="addVehicleType">Submit</button>
                    </div>
                    <ul class="list-group">
                        @foreach ($vehicleTypes as $index => $type)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $type }}
                                <button type="button" 
                                class="btn btn-danger btn-xs p-1 remove-field rounded text-white border-white  mt-3" 
                                wire:click="removeVehicleType({{ $index }})" 
                                style="font-size: 12px; width: 19px; height: 24px; display: flex; align-items: center; ">
                            <i class="fa fa-trash" aria-hidden="true" style="font-size: 10px;"></i>
                        </button>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="$set('showVehical', false)"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        {{ $isVehical ? 'Update' : 'Create' }}
                        <i class="spinner-border spinner-border-sm" wire:loading></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>



<div class="modal @if ($showBrand) show @endif" tabindex="-1"
    style="opacity: 1; background-col-md-6or: #0606068c; display: @if ($showBrand) block @endif">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form wire:submit.prevent="storeCustomer">
                <div class="modal-header">
                    <h4 class="modal-title">{{ $isBrand ? 'Edit Brand' : 'Add Brand Type' }}</h4>
                    <button type="button" class="btn-close" wire:click="$set('showBrand', false)"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body py-3">
                    @csrf
                    <div class="modal-body py-3">
                        <input type="text" class="form-control" placeholder="Enter Brand Type" wire:model="brandType">
                        @error('brandType') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" wire:click="addBrandsType">Submit</button>
                    </div>
                    <ul class="list-group">
                        @foreach ($brandTypes as $index => $type)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $type }}
                            <button type="button" 
                            class="btn btn-danger btn-xs p-1 remove-field rounded text-white border-white  mt-3" 
                            wire:click="removeBrandsType({{ $index }})" 
                            style="font-size: 12px; width: 19px; height: 24px; display: flex; align-items: center; ">
                        <i class="fa fa-trash" aria-hidden="true" style="font-size: 10px;"></i>
                            </button>
                        </li>
                    @endforeach
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="$set('showBrand', false)"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        {{ $isBrand ? 'Update' : 'Create' }}
                        <i class="spinner-border spinner-border-sm" wire:loading></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal @if ($showModel) show @endif" tabindex="-1"
    style="opacity: 1; background-col-md-6or: #0606068c; display: @if ($showModel) block @endif">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form wire:submit.prevent="storeCustomer">
                <div class="modal-header">
                    <h4 class="modal-title">{{ $isModel ? '' : 'Add Model Name' }}</h4>
                    <button type="button" class="btn-close" wire:click="$set('showModel', false)"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body py-3">
                    @csrf
                    <div class="modal-body py-3">
                        <input type="text" class="form-control" placeholder="Enter Model Type" wire:model="modelType">
                        @error('modelType') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" wire:click="addModelsType">Submit</button>
                    </div>
                    <ul class="list-group">
                        @foreach ($modelTypes as $index => $type)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $type }}
                            <button type="button" 
                            class="btn btn-danger btn-xs p-1 remove-field rounded text-white border-white  mt-3" 
                            wire:click="removeBrandsType({{ $index }})" 
                            style="font-size: 12px; width: 19px; height: 24px; display: flex; align-items: center; ">
                        <i class="fa fa-trash" aria-hidden="true" style="font-size: 10px;"></i>
                            </button>
                        </li>
                    @endforeach
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="$set('showModel', false)"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        {{ $isModel ? 'Update' : 'Create' }}
                        <i class="spinner-border spinner-border-sm" wire:loading></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal @if ($showFuel) show @endif" tabindex="-1"
    style="opacity: 1; background-col-md-6or: #0606068c; display: @if ($showFuel) block @endif">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form wire:submit.prevent="storeCustomer">
                <div class="modal-header">
                    <h4 class="modal-title">{{ $isFuel ? '' : 'Add Fuel Type' }}</h4>
                    <button type="button" class="btn-close" wire:click="$set('showFuel', false)"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body py-3">
                    @csrf
                    <div class="modal-body py-3">
                        <input type="text" class="form-control" placeholder="Enter Fuel Type" wire:model="fuelType">
                        @error('fuelType') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" wire:click="addFuelsType">Submit</button>
                    </div>
                    <ul class="list-group">
                        @foreach ($fuelTypes as $index => $type)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $type }}
                            <button type="button" 
                            class="btn btn-danger btn-xs p-1 remove-field rounded text-white border-white  mt-3" 
                            wire:click="removeFuelsType({{ $index }})" 
                            style="font-size: 12px; width: 19px; height: 24px; display: flex; align-items: center; ">
                            <i class="fa fa-trash" aria-hidden="true" style="font-size: 10px;"></i>
                            </button>
                        </li>
                    @endforeach
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="$set('showFuel', false)"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        {{ $isFuel ? 'Update' : 'Create' }}
                        <i class="spinner-border spinner-border-sm" wire:loading></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


</div>
