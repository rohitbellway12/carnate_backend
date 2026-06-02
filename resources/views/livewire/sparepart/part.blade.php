<div>
    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="alert alert-success shadow-sm border-0">{{ session('message') }}</div>
    @endif
    @php
        $sparePart = App\Models\SparePartVendor::where('id', $sparepartId)->first();
    @endphp

    <!-- Add/Edit Modal (Premium Re-structured) -->
    <div class="modal @if ($showModal) show @endif" tabindex="-1"
        style="opacity:1; background-color:#0606068c; display:@if ($showModal) block @endif">
        <div class="modal-dialog modal-xl">
            <div class="modal-content border-0 shadow-lg">
                <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">
                    <div class="modal-header bg-dark text-white p-3">
                        <h4 class="modal-title fw-bold">
                            <i
                                class='bx bx-plus-circle me-2'></i>{{ $isView ? 'View Part Details' : ($isEdit ? 'Update Part Details' : 'Register New Spare Part') }}
                        </h4>
                        <button type="button" class="btn-close btn-close-white" wire:click="$set('showModal', false)"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        @csrf

                        {{-- 🔹 STEP 1: TRIGGER SECTION --}}
                        <div class="card bg-light border-0 mb-4 shadow-sm">
                            <div class="card-body p-3">
                                <div class="row g-3 align-items-center">
                                    {{-- Part Number --}}
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold clr12477a mb-1">
                                            <i class='bx bx-barcode me-1'></i>1. Part Number (Trigger)
                                        </label>
                                        <div class="input-group">
                                            <input type="text" wire:model.live.debounce.500ms="part_number"
                                                class="form-control border-primary fw-bold"
                                                {{ $isView ? 'disabled' : '' }}
                                                placeholder="Enter Number (e.g., 46029BW)">
                                            <span class="input-group-text bg-primary text-white border-primary">
                                                <div wire:loading wire:target="part_number">
                                                    <span class="spinner-border spinner-border-sm"></span>
                                                </div>
                                                <i class='bx bx-search' wire:loading.remove
                                                    wire:target="part_number"></i>
                                            </span>
                                        </div>
                                        @error('part_number')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    {{-- Article ID --}}
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold mb-1 text-muted">Article ID</label>
                                        <input type="text" wire:model="articleId" class="form-control bg-white"
                                            readonly placeholder="Auto-fetched ID" {{ $isView ? 'disabled' : '' }}>
                                    </div>

                                    {{-- OEM Numbers --}}
                                    <div class="col-12 mt-2">
                                        <label class="form-label fw-bold mb-1 text-muted small">
                                            <i class='bx bx-list-check me-1'></i>Detected OEM Numbers (Cross-Reference)
                                        </label>
                                        <textarea wire:model="oem_list" class="form-control bg-white" rows="2"
                                            placeholder="OEM numbers will be listed here..." {{ $isView ? 'disabled' : '' }}></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row g-4">
                            {{-- 🔹 STEP 2: BASIC INFO --}}
                            <div class="col-lg-6">
                                <h6 class="fw-bold border-bottom pb-2 mb-3"><i class='bx bx-info-circle me-1'></i>Basic
                                    Information</h6>
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label">Full Descriptive Name<sup
                                                class="text-danger">*</sup></label>
                                        <div class="input-group">
                                            <input type="text" wire:model="name" class="form-control bg-white"
                                                placeholder="Product Full Name" {{ $isView ? 'disabled' : '' }}>
                                            <button type="button" class="btn btn-outline-primary"
                                                wire:click="addPartLabel" {{ $isView ? 'disabled' : '' }}>+</button>
                                        </div>
                                        @error('name')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Brand</label>
                                        <input type="text" wire:model="brand" class="form-control"
                                            placeholder="Manufacturer" {{ $isView ? 'disabled' : '' }}>
                                        @error('brand')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Category <small
                                                class="text-muted">(Auto-detected)</small></label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light"><i
                                                    class='bx bx-category'></i></span>
                                            @if ($isView)
                                                <input type="text" class="form-control bg-light"
                                                    value="{{ $apiCategoryName ?: 'Not detected' }}" readonly disabled>
                                            @else
                                                <select class="form-select" wire:model="category">
                                                    <option value="">
                                                        {{ $apiCategoryName ?: 'Select / Auto-detected' }} --</option>
                                                    @foreach ($categories as $cat)
                                                        <option value="{{ $cat['categoryId'] }}"
                                                            {{ $category == $cat['categoryId'] ? 'selected' : '' }}>
                                                            {{ $cat['categoryName'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            @endif
                                        </div>
                                        @if ($apiCategoryName && !$isView)
                                            <small class="text-success fw-bold"><i
                                                    class='bx bx-check-circle me-1'></i>Auto-detected:
                                                {{ $apiCategoryName }}</small>
                                        @endif
                                        @error('category')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Supplier<sup class="text-danger">*</sup></label>
                                        <select class="form-select" wire:model="supplier_id"
                                            {{ $isView ? 'disabled' : '' }}>
                                            <option value="">Select Supplier</option>
                                            @foreach ($suppliers as $supplier)
                                                <option value="{{ $supplier->id }}">{{ $supplier->owner_first_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('supplier_id')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- 🔹 STEP 3: PRICING & INVENTORY --}}
                            <div class="col-lg-6">
                                <h6 class="fw-bold border-bottom pb-2 mb-3"><i class='bx bx-rupee me-1'></i>Pricing &
                                    Inventory</h6>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Purchase Price<sup
                                                class="text-danger">*</sup></label>
                                        <div class="input-group">
                                            <span class="input-group-text">₹</span>
                                            <input type="number" wire:model.live="purchase_amount"
                                                class="form-control" {{ $isView ? 'disabled' : '' }}>
                                        </div>
                                        @error('purchase_amount')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Selling Price<sup
                                                class="text-danger">*</sup></label>
                                        <div class="input-group">
                                            <span class="input-group-text">₹</span>
                                            <input type="number" wire:model.live="selling_amount"
                                                class="form-control" {{ $isView ? 'disabled' : '' }}>
                                        </div>
                                        @error('selling_amount')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Tax Type</label>
                                        <select class="form-select" wire:model.live="tax_type"
                                            {{ $isView ? 'disabled' : '' }}>
                                            <option value="">Select</option>
                                            <option value="include">Include Tax</option>
                                            <option value="exclude">Exclude Tax</option>
                                        </select>
                                        @error('tax_type')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    @if ($tax_type)
                                        <div class="col-md-3">
                                            <label class="form-label">Tax (%)</label>
                                            <input type="number" wire:model.live="tax_percentage"
                                                class="form-control" placeholder="e.g. 18"
                                                {{ $isView ? 'disabled' : '' }}>
                                            @error('tax_percentage')
                                                <span class="text-danger small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    @endif
                                    <div class="{{ $tax_type ? 'col-md-6' : 'col-md-6' }}">
                                        <label class="form-label">Online Discount</label>
                                        <div class="input-group">
                                            <input type="number" wire:model.live="discount" class="form-control"
                                                {{ $isView ? 'disabled' : '' }}>
                                            <select class="form-select p-1" wire:model.live="discount_type"
                                                style="max-width: 60px;" {{ $isView ? 'disabled' : '' }}>
                                                <option value="1">₹</option>
                                                <option value="2">%</option>
                                            </select>
                                        </div>
                                        @error('discount')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">HSN Code</label>
                                        <input type="text" wire:model="hsn_code" class="form-control"
                                            placeholder="e.g. 8708" {{ $isView ? 'disabled' : '' }}>
                                        @error('hsn_code')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Online Price (Auto)</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light">₹</span>
                                            <input type="number" wire:model="online_price"
                                                class="form-control bg-light fw-bold text-success" readonly disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Offline Price (Auto)</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light">₹</span>
                                            <input type="number" wire:model="offline_price"
                                                class="form-control bg-light fw-bold text-primary" readonly disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Unit<sup class="text-danger">*</sup></label>
                                        <select class="form-select" wire:model="unit"
                                            {{ $isView ? 'disabled' : '' }}>
                                            <option value="">Select</option>
                                            @foreach ($units as $u)
                                                <option value="{{ $u->id }}">{{ $u->title }}</option>
                                            @endforeach
                                        </select>
                                        @error('unit')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Stock<sup class="text-danger">*</sup></label>
                                        <input type="number" wire:model="stock" class="form-control"
                                            {{ $isView ? 'disabled' : '' }}>
                                        @error('stock')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">SP Type<sup class="text-danger">*</sup></label>
                                        <select class="form-select" wire:model="sp_type"
                                            {{ $isView ? 'disabled' : '' }}>
                                            <option value="">Select</option>
                                            <option value="0">New</option>
                                            <option value="1">Used</option>
                                        </select>
                                        @error('sp_type')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Rack No.</label>
                                        <input type="text" wire:model="rack_no" class="form-control"
                                            placeholder="Shelf A-1" {{ $isView ? 'disabled' : '' }}>
                                        @error('rack_no')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- 🔹 STEP 4: COMPATIBILITY & IMAGE --}}
                            <div class="col-12 mt-4">
                                <div class="row g-4">
                                    <div class="col-md-8">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <label class="form-label fw-bold mb-0">
                                                <i class='bx bx-car me-1'></i>Compatible Vehicles List<sup
                                                    class="text-danger">*</sup>
                                            </label>
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="input-group input-group-sm" style="width: 200px;">
                                                    <span class="input-group-text bg-light border-end-0"><i
                                                            class='bx bx-filter-alt'></i></span>
                                                    <input type="text"
                                                        class="form-control border-start-0 ps-0 shadow-none"
                                                        placeholder="Filter list..." wire:model.live="brandFilter">
                                                </div>
                                                <div class="form-check form-switch ms-2">
                                                    <input class="form-check-input" type="checkbox"
                                                        wire:model.live="selectAll" id="selectAll"
                                                        {{ $isView ? 'disabled' : '' }}>
                                                    <label class="form-check-label fw-bold text-primary mb-0"
                                                        for="selectAll" style="white-space: nowrap;">Select
                                                        All</label>
                                                </div>
                                            </div>
                                        </div>
                                        @error('suitable_for')
                                            <div class="text-danger small mb-2 fw-bold">{{ $message }}</div>
                                        @enderror
                                        <div class="border rounded p-3 bg-white"
                                            style="max-height: 250px; overflow-y: auto;">
                                            @if (!empty($api_compatible_vehicles))
                                                <div class="row row-cols-1 row-cols-md-2 g-2">
                                                    @foreach ($api_compatible_vehicles as $vehicle)
                                                        @php
                                                            $searchText = strtolower(
                                                                $vehicle['manufacturerName'] .
                                                                    ' ' .
                                                                    $vehicle['modelName'] .
                                                                    ' ' .
                                                                    ($vehicle['typeEngineName'] ?? ''),
                                                            );
                                                            $filter = strtolower($brandFilter);
                                                        @endphp

                                                        @if (empty($brandFilter) || str_contains($searchText, $filter))
                                                            <div class="col">
                                                                <div
                                                                    class="form-check p-2 border rounded hover-bg-light shadow-xs">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        value="{{ $vehicle['id'] }}"
                                                                        wire:model="suitable_for"
                                                                        {{ $isView ? 'disabled' : '' }}
                                                                        id="vehicle_{{ $vehicle['id'] }}">
                                                                    <label class="form-check-label small w-100"
                                                                        for="vehicle_{{ $vehicle['id'] }}">
                                                                        <div class="fw-bold">
                                                                            {{ $vehicle['manufacturerName'] }}
                                                                            {{ $vehicle['modelName'] }}</div>
                                                                        <div class="text-muted smaller">
                                                                            {{ $vehicle['typeEngineName'] ?? 'Standard' }}
                                                                            | {{ $vehicle['year'] }}</div>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @elseif (count($modifications) > 0 && ($isEdit || $isView || empty($api_compatible_vehicles)))
                                                <div class="row row-cols-1 row-cols-md-2 g-2">
                                                    @foreach ($modifications as $modification)
                                                        @if (empty($brandFilter) || stripos($modification->brand_name, $brandFilter) !== false)
                                                            <div class="col">
                                                                <div class="form-check p-2 border rounded">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        value="{{ $modification->id }}"
                                                                        wire:model="suitable_for"
                                                                        id="mod_{{ $modification->id }}"
                                                                        {{ $isView ? 'disabled' : '' }}>
                                                                    <label class="form-check-label small"
                                                                        for="mod_{{ $modification->id }}">
                                                                        <strong>{{ $modification->brand_name }}
                                                                            {{ $modification->variant_name }}</strong><br>
                                                                        <span
                                                                            class="text-muted">{{ $modification->year }}</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @else
                                                <div class="text-center py-4 text-muted">
                                                    <i class='bx bx-info-circle me-1'></i>Please enter a part number to
                                                    find compatible vehicles.
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-bold mb-2"><i class='bx bx-image me-1'></i>Part
                                            Image</label>
                                        <div
                                            class="border rounded p-3 text-center bg-white h-100 d-flex flex-column align-items-center justify-content-center shadow-xs">
                                            @if ($part_image_url)
                                                <img class="img-fluid rounded shadow-sm mb-2"
                                                    src="{{ $part_image_url }}" style="max-height: 150px;">
                                                <span class="badge bg-success small">Catalog Image Linked</span>
                                            @elseif ($image && method_exists($image, 'temporaryUrl'))
                                                <img class="img-fluid rounded shadow-sm mb-2"
                                                    src="{{ $image->temporaryUrl() }}" style="max-height: 150px;">
                                            @elseif ($imageImage)
                                                <img class="img-fluid rounded shadow-sm mb-2"
                                                    src="{{ asset($imageImage) }}" style="max-height: 150px;">
                                            @else
                                                <div class="py-4 text-muted text-center">
                                                    <i class='bx bx-image-add' style="font-size: 3rem;"></i><br>
                                                    <span class="small">No Image Uploaded</span>
                                                </div>
                                            @endif
                                            <input type="file" class="form-control form-control-sm mt-3"
                                                wire:model="image" {{ $isView ? 'disabled' : '' }} />
                                            @error('image')
                                                <span class="text-danger small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- 🔹 STEP 5: DESCRIPTION --}}
                            <div class="col-12 mt-4">
                                <label class="form-label fw-bold"><i class='bx bx-list-ul me-1'></i>Technical
                                    Description & Specs</label>
                                <textarea wire:model="description" class="form-control shadow-inner bg-light-subtle" rows="6"
                                    {{ $isView ? 'disabled' : '' }} placeholder="Technical specifications will be populated here automatically..."></textarea>
                                @error('description')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-4 p-3 bg-warning-subtle border-start border-warning border-4 rounded">
                            <span class="text-dark small">
                                <i class='bx bx-info-circle me-1 fw-bold'></i>Important: A
                                <strong>{{ $commission }}%</strong> platform charge will be applied to the final
                                settlement.
                            </span>
                        </div>
                    </div>
                    <div class="modal-footer bg-white border-top p-3 shadow-sm">
                        <button type="button" class="btn btn-outline-secondary px-4 fw-bold"
                            wire:click="$set('showModal', false)">{{ $isView ? 'Close' : 'Discard' }}</button>
                        @if (!$isView)
                            <button type="submit" class="btn btn-primary px-5 fw-bold shadow-sm">
                                <i class='bx bx-save me-1' wire:loading.remove
                                    wire:target="{{ $isEdit ? 'update' : 'store' }}"></i>
                                {{ $isEdit ? 'Update Details' : 'Register Part' }}
                                <i class="spinner-border spinner-border-sm ms-1" wire:loading
                                    wire:target="{{ $isEdit ? 'update' : 'store' }}"></i>
                            </button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- 🔹 PART LABEL MODAL --}}
    <div class="modal @if ($showPartModel) show @endif" tabindex="-1"
        style="opacity:1; background-color:#0606068c; display:@if ($showPartModel) block @endif">
        <div class="modal-dialog modal-md">
            <div class="modal-content border-0 shadow-lg">
                <form wire:submit.prevent="partLabelStore">
                    <div class="modal-header bg-primary text-white">
                        <h4 class="modal-title fw-bold">Add Custom Part Name</h4>
                        <button type="button" class="btn-close btn-close-white"
                            wire:click="$set('showPartModel', false)"></button>
                    </div>
                    <div class="modal-body py-4">
                        <div class="form-group">
                            <label class="form-label fw-bold text-muted">Label / Part Name</label>
                            <input type="text" wire:model="part_label"
                                class="form-control form-control-lg border-primary"
                                placeholder="e.g. Premium Brake Pad">
                            @error('part_label')
                                <span class="text-danger small fw-bold">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary px-4"
                            wire:click="$set('showPartModel', false)">Cancel</button>
                        <button type="submit" class="btn btn-primary px-4 fw-bold shadow-sm">Save & Use</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- 🔹 INVENTORY LISTING & FILTERS PANEL --}}
    <div class="card shadow-sm border-0 mb-4 bg-white rounded-3">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom border-light-subtle">
                <h4 class="fw-bold mb-0 clr12477a"><i class='bx bx-package me-2 text-primary align-middle fs-3'></i>Spare Parts Inventory</h4>
                @if (@$sparePart->hasPermissionTo('part-add'))
                    <button wire:click="create" class="btn btn-primary px-4 shadow-sm fw-bold rounded-pill">
                        <i class="bx bx-plus-circle me-1"></i>Add New Part
                    </button>
                @endif
            </div>

            <!-- Modern Vehicle Filter Subsection with Premium Brand Colors & Gradients -->
            <div class="p-3 mb-4 rounded-3" style="background: linear-gradient(135deg, rgba(18, 71, 122, 0.04) 0%, rgba(89, 216, 253, 0.06) 100%); border: 1px solid rgba(18, 71, 122, 0.12) !important;">
                <div class="row align-items-center mb-3">
                    <div class="col-auto">
                        <span class="badge px-3 py-2 rounded-pill shadow-xs" style="background: linear-gradient(135deg, #12477a 0%, #1d5f9c 100%) !important; color: #fff; font-weight: 600;"><i class="bx bx-car me-1"></i> Vehicle-Specific Filter</span>
                    </div>
                    <div class="col text-muted small">
                        Select vehicle details below to narrow down your parts search dynamically.
                    </div>
                </div>

                <div class="row g-3">
                    {{-- Brand Dropdown --}}
                    <div class="col-md-3">
                        <label class="form-label small fw-bold mb-1" style="color: #12477a !important;">Vehicle Brand</label>
                        <select class="form-select py-2 rounded-3 bg-white" style="border: 1px solid rgba(18, 71, 122, 0.2) !important;" wire:model.live="brand_name">
                            <option value="">All Brands</option>
                            @foreach ($brands as $brand)
                                <option value="{{ is_array($brand) ? $brand['name'] : $brand }}">
                                    {{ is_array($brand) ? $brand['name'] : $brand }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Variant Dropdown --}}
                    <div class="col-md-3">
                        <label class="form-label small fw-bold mb-1" style="color: #12477a !important;">Variant Name</label>
                        <select class="form-select py-2 rounded-3 bg-white" style="border: 1px solid rgba(18, 71, 122, 0.2) !important;" wire:model.live="variant_name" {{ empty($brand_name) ? 'disabled' : '' }}>
                            <option value="">All Variants</option>
                            @foreach ($variants as $variant)
                                <option value="{{ is_array($variant) ? $variant['name'] : $variant }}">
                                    {{ is_array($variant) ? $variant['name'] : $variant }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Year Dropdown --}}
                    <div class="col-md-3">
                        <label class="form-label small fw-bold mb-1" style="color: #12477a !important;">Model Year</label>
                        <select class="form-select py-2 rounded-3 bg-white" style="border: 1px solid rgba(18, 71, 122, 0.2) !important;" wire:model.live="selected_year" {{ empty($variant_name) ? 'disabled' : '' }}>
                            <option value="">All Years</option>
                            @foreach ($years as $year)
                                <option value="{{ is_array($year) ? $year['value'] : $year }}">
                                    {{ is_array($year) ? $year['label'] : $year }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Modification Dropdown --}}
                    <div class="col-md-3">
                        <label class="form-label small fw-bold mb-1" style="color: #12477a !important;">Engine / Specification</label>
                        <select class="form-select py-2 rounded-3 bg-white" style="border: 1px solid rgba(18, 71, 122, 0.2) !important;" wire:model.live="modification_id" {{ empty($selected_year) ? 'disabled' : '' }}>
                            <option value="">All Modifications</option>
                            @foreach ($filter_modifications as $mod)
                                <option value="{{ is_array($mod) ? $mod['id'] : $mod }}">
                                    {{ is_array($mod) ? $mod['name'] : $mod }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- General Search Filter & Reset Row -->
            <div class="row g-3 align-items-center">
                <div class="col-md-8">
                    <div class="input-group rounded-pill overflow-hidden bg-white shadow-xs" style="border: 1px solid rgba(18, 71, 122, 0.25) !important;">
                        <span class="input-group-text bg-white border-0 ps-3"><i class='bx bx-search text-muted'></i></span>
                        <input type="text" class="form-control border-0 py-2"
                            placeholder="Type part name, HSN, brand or category to search..." wire:model.live="searchfilter">
                    </div>
                    <div class="ps-3 mt-1 text-muted" style="font-size: 11px;">
                        <span class="fw-bold"><i class="bx bx-info-circle align-middle"></i> Searchable by:</span> Category, Name, Brand, Part No., HSN, Rack No., Unit
                    </div>
                </div>
                <div class="col-md-4 text-end">
                    <button type="button" class="btn btn-light px-4 rounded-pill fw-bold" style="border: 1px solid rgba(18, 71, 122, 0.3) !important; color: #12477a !important; background-color: #f8fafc;"
                        wire:click="resetFilter"><i class="bx bx-reset me-1"></i>Reset All Filters</button>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0 rounded-3 overflow-hidden">
        <div class="card-body p-0 bg-white">
            @if (!empty($parts) && $parts->count())
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 table-borderless border-top">
                        <thead class="bg-light-subtle text-muted small text-uppercase fw-bold border-bottom">
                            <tr>
                                <th class="ps-4 py-3">S.No.</th>
                                <th>Image</th>
                                <th>Part Identification</th>
                                <th>Supplier</th>
                                <th>Commercials</th>
                                <th>Stock Status</th>
                                <th>HSN / Location</th>
                                <th class="text-center pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($parts as $index => $part)
                                <tr class="border-bottom-xs">
                                    <td class="ps-4">{{ $parts->total() - ($parts->firstItem() + $index) + 1 }}</td>
                                    <td>
                                        <div class="rounded-3 border p-1 bg-white shadow-xs d-flex align-items-center justify-content-center overflow-hidden"
                                            style="width: 54px; height: 54px;">
                                            @if (!empty($part->Image->file))
                                                <img src="{{ asset($part->Image->file) }}" class="img-fluid rounded"
                                                    style="object-fit: contain; max-height: 100%;">
                                            @else
                                                <img src="{{ asset('img/spareparts.jpg') }}"
                                                    class="img-fluid rounded">
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="fw-bold text-dark mb-0">{{ $part->name }}</div>
                                        <div class="small text-muted mt-1">
                                            <span
                                                class="badge bg-primary-subtle text-primary border border-primary-subtle">PN:
                                                {{ $part->part_number }}</span>
                                            <span class="ms-1 px-2 border-start">Brand: <span
                                                    class="fw-bold">{{ $part->brand }}</span></span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="small fw-medium text-secondary"><i
                                                class='bx bx-user me-1'></i>{{ $part->supplier?->owner_first_name ?? '-' }}</span>
                                    </td>
                                    <td>
                                        <div class="small">
                                            @php
                                                $offlinePrice = $part->selling_amount;
                                                if ($part->tax_type == 'exclude' && $part->tax_percentage) {
                                                    $offlinePrice += ($offlinePrice * $part->tax_percentage) / 100;
                                                }
                                            @endphp
                                            <div class="fw-bold text-success">Online:
                                                ₹{{ number_format($part->price, 2) }}</div>
                                            <div class="fw-bold text-primary">Offline:
                                                ₹{{ number_format($offlinePrice, 2) }}</div>
                                            <div class="text-muted smaller">Buy:
                                                ₹{{ number_format($part->purchase_price, 2) }}</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-inline-flex flex-column">
                                            <span
                                                class="badge {{ $part->stock > 10 ? 'bg-success text-white' : ($part->stock > 0 ? 'bg-warning text-dark' : 'bg-danger text-white') }} px-2 py-1 mb-1">
                                                {{ $part->stock }} {{ $part->unit?->title ?? 'Units' }}
                                            </span>
                                            @if ($part->stock <= 5)
                                                <span class="smaller text-danger fw-bold"><i
                                                        class='bx bxs-error me-1'></i>Low Stock</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="small text-muted">
                                            <div class="mb-1"><i class='bx bx-tag-alt me-1'></i>HSN:
                                                {{ $part->hsn_code ?? 'N/A' }}</div>
                                            <div><i class='bx bx-map-pin me-1'></i>Rack: {{ $part->rack_no ?? 'N/A' }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center pe-4">
                                        <div class="d-flex justify-content-center gap-1">
                                            <button wire:click="view({{ $part->id }})"
                                                class="btn btn-icon btn-sm btn-light hover-info rounded-circle shadow-xs">
                                                <i class="bx bxs-show fs-5"></i>
                                            </button>
                                            @if (@$sparePart->hasPermissionTo('part-edit'))
                                                <button wire:click="edit({{ $part->id }})"
                                                    class="btn btn-icon btn-sm btn-light hover-primary rounded-circle shadow-xs">
                                                    <i class="bx bxs-edit fs-5"></i>
                                                </button>
                                            @endif
                                            @if (@$sparePart->hasPermissionTo('part-delete'))
                                                <button wire:click="confirmDelete({{ $part->id }})"
                                                    class="btn btn-icon btn-sm btn-light hover-danger rounded-circle shadow-xs">
                                                    <i class="bx bxs-trash fs-5"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-4 border-top bg-light-subtle">
                    {{ $parts->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <div class="mb-3">
                        <i class='bx bx-package text-muted' style="font-size: 5rem; opacity: 0.3;"></i>
                    </div>
                    <h5 class="text-muted fw-bold">No Spare Parts Found</h5>
                    <p class="text-muted small">Start adding parts to your inventory using the "Add New Part" button.
                    </p>
                </div>
            @endif
        </div>
    </div>
</div>

@section('footerscript')
    <script>
        document.addEventListener('livewire:init', () => {
            initialize();
            Livewire.hook('morphed', () => {
                initialize();
            });
        });

        function initialize() {
            // Re-bind scripts if needed
        }
    </script>
@endsection
