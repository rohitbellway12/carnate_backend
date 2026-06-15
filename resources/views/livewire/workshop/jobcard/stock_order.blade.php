<div>
    <div class="modal @if ($showstock) show @endif" tabindex="-1"
        style="opacity: 1; background-color: #0606068c; display: @if ($showstock) block @else none @endif">
        <div class="modal-dialog modal-lg">

            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ 'Create' }} @if ($showTable == 2)
                            Spare Parts
                        @elseif ($showTable == 3)
                            Lubricant
                        @elseif ($showTable == 5)
                            Accessory
                        @endif
                        stock Order
                    </h4>
                    <button type="button" class="btn-close" wire:click="$set('showstock', false)" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Stock Items Row -->
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="stock_itemName" class="form-label">Item Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" wire:model="stock_itemName"
                                placeholder="Enter Item Name Here...">
                            @error('stock_itemName')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="stock_brand_name" class="form-label">Brand Name</label>
                            <input type="text" class="form-control" wire:model="stock_brand_name"
                                placeholder="Enter Brand Name Here...">
                            @error('stock_brand_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                           <div class="col-md-6">
                            <label for="stock_hsn_code" class="form-label"> HSN Code </label>
                            <input type="text" class="form-control" wire:model="stock_hsn_code"
                                placeholder="Enter HSN Code Here...">
                            @error('stock_hsn_code')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                         <div class="col-md-6">
                            <label for="stock_part_number" class="form-label"> Part Number </label>
                            <input type="text" class="form-control" wire:model="stock_part_number"
                                placeholder="Enter Part Number Here...">
                            @error('stock_part_number')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="stock_buy_price" class="form-label">Buy Price<span class="text-danger">*</span></label>
                            <input type="number" class="form-control" wire:model="stock_buy_price"
                                placeholder="Enter Buy Price Here...">
                            @error('stock_buy_price')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="stock_sellPrice" class="form-label"> Sell Price <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" wire:model="stock_sellPrice"
                                placeholder="Enter Sell Price Here...">
                            @error('stock_sellPrice')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="stock_tax_type" class="form-label"> Tax Type <span class="text-danger">*</span></label>
                            <select id="tax_type" class="form-select" wire:model="stock_tax_type">
                                <option value="">Select Tax Type</option>
                                <option value="include">Include All Taxes</option>
                                <option value="exclude">Exclude All Taxes</option>
                            </select>
                            @error('stock_tax_type')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="stock_tax_percentage" class="form-label">Tax Percentage <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" wire:model.live="stock_tax_percentage" class="form-control"
                                    placeholder="Enter Percentage" id="tax_percentage">
                                <span class="input-group-text">%</span>
                            </div>
                            @error('stock_tax_percentage')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="stock_quantity" class="form-label"> Stock </label>
                            <input type="number" class="form-control" wire:model="stock_quantity"
                                placeholder="Enter Quantity Here...">
                            @error('stock_quantity')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                     
                        <div class="col-md-6">
                            <label for="stock_rack_no" class="form-label"> Rack No. </label>
                            <input type="text" class="form-control" wire:model="stock_rack_no"
                                placeholder="Enter  Rack No. Here...">
                            @error('stock_rack_no')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                     
                        @if ($showTable == 2)
                            <div class="col-md-6">
                                <label for="stock_part_number" class="form-label"> SP Type </label>
                                <select class="form-select" wire:model="stock_sp_type">
                                    <option value="0">New</option>
                                    <option value="1">Used</option>
                                </select>
                                @error('stock_sp_type')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        @endif
                        <div class="col-md-6">
                            <label for="stock_unit" class="form-label"> Unit </label>
                            <select id="stock_unit" class="form-select " wire:model="stock_unit">
                                <option value="">Select Unit</option>
                                @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->title }}</option>
                                @endforeach
                            </select>
                            @error('stock_unit')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="stock_category" class="form-label">Sub Category </label>
                            <select class="form-select " wire:model="stock_category" id="stock_category">
                                <option value="">Select Sub Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                            @error('stock_category')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                          
                        <div class="card border border-light-2 mt-3 p-3 bg-light-3">
                            <div class="col-md-12">
                                <label class="form-label fw-bold text-secondary">Compatible Vehicles<span class="text-danger">*</span></label>
                                <div class="form-group mb-2">
                                    <input type="checkbox" wire:model.live="forAllVehicles" id="all_vehicles" class="form-check-input">
                                    <label for="all_vehicles" class="form-check-label fw-bold ms-1">For All Vehicles</label>
                                </div>
                            </div>

                            @if (!$forAllVehicles)
                                <!-- 1. Add Vehicle from 3rd Party Catalog -->
                                <div class="col-md-12 border-bottom pb-3 mb-3">
                                    @livewire('workshop.vehicle-selector')
                                </div>

                                <!-- 2. Select from Existing Local Vehicles -->
                                <div class="col-md-12 mb-3">
                                    <label class="form-label font-12 text-muted fw-bold">Or Select from Existing Saved Vehicles</label>
                                    <div class="form-group">
                                        <select id="suitable_for" class="form-select searchable-select" multiple
                                            data-placeholder="Select vehicle"
                                            wire:model="suitable_for">

                                            @foreach ($modifications as $modification)
                                                <option value="{{ $modification->id }}" @if (is_array($suitable_for) && in_array($modification->id, $suitable_for)) selected @endif>
                                                    @php
                                                        $data = array_filter([
                                                            $modification->brand_name ?? '',
                                                            $modification->variant_name ?? '',
                                                            $modification->year ?? '',
                                                            $modification->title ?? '',
                                                        ]);
                                                    @endphp

                                                    {{ implode(' ', $data) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('suitable_for')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- 3. Selected Compatible Vehicles List -->
                                <div class="col-md-12">
                                    <label class="form-label fw-bold text-dark font-13 mb-2">Selected Compatible Vehicles ({{ is_array($suitable_for) ? count($suitable_for) : 0 }})</label>
                                    <div class="d-flex flex-wrap gap-2">
                                        @if(empty($suitable_for))
                                            <span class="text-muted font-12">No vehicles selected yet.</span>
                                        @else
                                            @foreach ($suitable_for as $index => $modId)
                                                @php
                                                    $localMod = $modifications->firstWhere('id', $modId);
                                                @endphp
                                                @if ($localMod)
                                                    <span class="badge bg-secondary p-2 d-inline-flex align-items-center gap-2" style="font-size: 12px; border-radius: 4px;">
                                                        {{ $localMod->brand_name }} {{ $localMod->variant_name }} ({{ $localMod->year }}) - {{ $localMod->title }}
                                                        <button type="button" class="btn-close btn-close-white ms-1" style="font-size: 0.55rem; padding: 0; margin: 0; width: 0.55rem; height: 0.55rem;" wire:click="removeCompatibleVehicle({{ $index }})"></button>
                                                    </span>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            @else
                                <div class="col-md-12 mt-2">
                                    <div class="form-group">
                                        <label for="">Selected Vehicle</label> <br>
                                        <p class="badge bg-danger ">All</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    {{-- @endif --}}
                        </div>
                    </div>
                </div>
                <div>
                    <button type="button" class="btn btn-secondary ms-2" wire:click="$set('showstock', false)"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary rounded m-2" wire:click="storestock">
                        Submit <i class="spinner-border spinner-border-sm" wire:loading></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
