<div class="container mt-4">
    <h2>Stock List</h2>
    <!-- Filter Section -->
    <div class="row mb-3">
        <div class="col-md-4">
            <input type="text" class="form-control" placeholder="Search by Part Name or Part No." wire:model.live="searchTerm">
        </div>
        <div class="col-md-2">
            <button class="btn btn-secondary" wire:click="resetFilters">Reset</button>
        </div>
    </div>
    @if (session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Part Name</th>
                    <th>Part No.</th>
                    <th>Company Name</th>
                   {{-- <th>Category</th>--}}
                    <th>Quantity</th>
                    <th>Unit</th>
                    <th>Rack No.</th>
                    <th>Selling Price</th>
                    <th>Tax %</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stocks as $index => $stock)
                    <tr>
                        <td>{{ $index + 1 }}</td>

                            <td>{{ $stock->partname }}</td>
                            <td>{{ $stock->part_no }}</td>
                            <td>{{ $stock->company_name }}</td>
                           {{-- <td>{{ $stock->category }}</td>--}}
                            <td>{{ $stock->quantity }}</td>
                            <td>{{ $stock->unit->title ?? '' }}</td>
                            <td>{{ $stock->rack_no }}</td>
                            <td>₹{{ number_format($stock->total_payable, 2) }}</td>
                            <td>{{ $stock->tax_percentage ?? 0 }}%</td>
                            <td>
                             <i class="bx bxs-edit me-2" wire:click="editFullDetails({{ $stock->id }})"style="cursor: pointer; font-size: 20px;" ></i>

                            <i class="bx bxs-trash me-2" wire:click="confirmDelete({{ $stock->id }})" style="cursor: pointer; font-size: 20px;"></i>
                          </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="modal @if ($showEditModal) show @endif" tabindex="-1"
     style="opacity:1; background-color:#0606068c; display:@if ($showEditModal) block @endif">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form wire:submit.prevent="updateFullDetails">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Parts & Stock</h4>
                    <button type="button" class="btn-close" wire:click="$set('showEditModal', false)"></button>
                </div>

                <div class="modal-body py-3">
                    <h5 class="mb-3">Part Details</h5>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Part Name</label>
                            <input type="text" class="form-control" wire:model.defer="name" readonly >
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Part Number</label>
                            <input type="text" class="form-control" wire:model.defer="part_number" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Brand</label>
                            <input type="text" class="form-control" wire:model.defer="brand">
                        </div>
                        <!-- <div class="col-md-6">
                            <label class="form-label">Unit</label>
                            <input type="text" class="form-control" wire:model.defer="unit">
                        </div> -->

                                 <div class="form-group col-md-4">
                                     <label class="form-label">Unit<sup class="text-danger">*</sup></label>
                                     <select class="form-select" wire:model="unit_id">
                                         <option value="">Select Unit</option>
                                         @foreach ($units as $unit)
                                             <option value="{{ $unit->id }}">{{ $unit->title }}</option>
                                         @endforeach
                                     </select>
                                 </div>


                                 <!-- Category -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Category<sup class="text-danger">*</sup></label>
                                    <select class="form-select" wire:model="category" id="category">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category['categoryId'] }}">
                                                {{ $category['categoryName'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('category')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>


{{--<p>Selected IDs: {{ implode(', ', $part_suitable_for) }}</p>--}}

                             <div class="col-md-12 mt-3">
                                    <div class="form-group">
                                        <label class="form-label">Compatible Vehicles List<span class="text-danger">*</span></label>
                                        {{-- Select All Option --}}

                                   {{-- <div class="form-check mb-2">
                                        <input type="checkbox"
                                            class="form-check-input"
                                            id="selectAllVehicles"
                                            wire:model="selectAll">
                                        <label class="form-check-label" for="selectAllVehicles">
                                            <strong>Select All Compatible Vehicles</strong>
                                        </label>
                                    </div>--}}

                                   {{-- V List --}}
                                        <div class="border rounded p-3" style="max-height: 300px; overflow-y: auto;">
                                            @if (!empty($part_modifications))
                                                <div class="row">
                                                    @foreach ($part_modifications as $modification)
                                                        <div class="col-md-6 mb-2">
                                                            <div class="form-check vehicle-item p-2 border-bottom">
                                                                <input class="form-check-input"
                                                                    type="checkbox"
                                                                   {{-- value="{{ $modification->id }}"--}}
                                                                    value="{{ $modification->brand_name }} {{ $modification->variant_name }} {{ $modification->year }}"
                                                                    wire:model.lazy="part_suitable_for"
                                                                    id="modification_{{ $modification->id }}">

                                                                <label class="form-check-label" for="modification_{{ $modification->id }}">
                                                                    <strong>{{ $modification->brand_name }} {{ $modification->variant_name }}</strong><br>
                                                                    <small class="text-muted">
                                                                        {{ $modification->year }} {{ $modification->title }}
                                                                    </small>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <div class="text-center text-muted">
                                                    <p>No compatible vehicles found</p>
                                                </div>
                                            @endif
                                        </div>
                                        <small class="text-info">All selected vehicles will be saved as compatible.</small>
                                    </div>
                                </div>

                        {{--<div class="col-md-6">
                            <label class="form-label">HSN Code</label>
                            <input type="text" class="form-control" wire:model.defer="hsn_code">
                        </div>
                         <div class="col-md-6">
                            <label class="form-label">Type</label>
                            <input type="text" class="form-control" wire:model.defer="sp_type">
                        </div>--}}
                        
                        <div class="col-md-12">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" wire:model.defer="description"></textarea>
                        </div>
                        {{-- <div class="col-md-6">
                            <label class="form-label">Image ID</label>
                            <input type="text" class="form-control" wire:model.defer="image_id">
                        </div>
                        @if ($imagePreview)
                        <div class="col-md-6">
                            <label class="form-label">Preview</label>
                            <img src="{{ asset('storage/images/' . $imagePreview) }}" width="80">
                        </div>
                        @endif --}}
                    </div>

                    <hr class="my-4">

                    <h5 class="mb-3"> Stock Details</h5>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Quantity</label>
                            <input type="number" class="form-control" wire:model.live="stock_quantity">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Rack No.</label>
                            <input type="text" class="form-control" wire:model.defer="stock_rack_no">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Selling Price</label>
                            <input type="number" class="form-control" wire:model.defer="stock_selling_price" step="1" min="1">
                        </div>
                    </div>
                </div>

                <div class="modal-footer mt-3">
                    <button type="button" class="btn btn-secondary" wire:click="$set('showEditModal', false)">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Both</button>
                </div>
            </form>
        </div>
    </div>
</div>


</div>
