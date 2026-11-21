<div>
    <style>
        .carnate-stock-modal {
            --c-red: #e53935;
            --c-red-dark: #d32f2f;
            --c-red-soft: #fff5f5;
            --c-border: #e2e8f0;
            --c-text: #111827;
            --c-muted: #64748b;
            --c-bg-subtle: #f8fafc;
        }

        .carnate-stock-modal.modal {
            position: fixed;
            inset: 0;
            z-index: 105000 !important;
            background: rgba(15, 23, 42, 0.6) !important;
            backdrop-filter: blur(3px);
            overflow-y: auto;
            padding: 20px 10px;
        }

        .carnate-stock-modal .modal-dialog {
            max-width: 860px;
            margin: 20px auto;
        }

        .carnate-stock-modal .modal-content {
            border: 1px solid var(--c-border) !important;
            border-radius: 16px !important;
            box-shadow: 0 24px 70px rgba(15, 23, 42, 0.22) !important;
            overflow: hidden;
            background: #fff;
        }

        .carnate-stock-modal .modal-header {
            padding: 16px 22px !important;
            border-bottom: 1px solid var(--c-border) !important;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .carnate-stock-modal .modal-title-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .carnate-stock-modal .modal-title-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: var(--c-red-soft);
            color: var(--c-red);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }

        .carnate-stock-modal .modal-title {
            font-size: 17px !important;
            font-weight: 700 !important;
            color: var(--c-text) !important;
            margin: 0;
            line-height: 1.2;
        }

        .carnate-stock-modal .modal-subtitle {
            font-size: 12px;
            color: var(--c-muted);
            margin: 2px 0 0;
        }

        .carnate-stock-modal .btn-close {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            opacity: 0.7;
            transition: all .2s;
            border: 1px solid var(--c-border);
            background-size: 10px;
        }

        .carnate-stock-modal .btn-close:hover {
            opacity: 1;
            background-color: #f1f5f9;
        }

        .carnate-stock-modal .modal-body {
            padding: 22px !important;
            max-height: calc(100vh - 170px);
            overflow-y: auto;
        }

        .carnate-stock-modal .form-section-title {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
            color: var(--c-muted);
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 6px;
            border-bottom: 1px solid #f1f5f9;
            padding-bottom: 6px;
        }

        .carnate-stock-modal .form-section-title i {
            color: var(--c-red);
            font-size: 14px;
        }

        .carnate-stock-modal .form-label {
            font-size: 12px !important;
            font-weight: 600 !important;
            color: #334155 !important;
            margin-bottom: 5px !important;
            display: block;
        }

        .carnate-stock-modal .form-control,
        .carnate-stock-modal .form-select {
            height: 42px !important;
            min-height: 42px !important;
            border: 1px solid var(--c-border) !important;
            border-radius: 9px !important;
            font-size: 13px !important;
            font-weight: 500 !important;
            color: var(--c-text) !important;
            background-color: #fff !important;
            padding: 8px 13px !important;
            transition: all .2s ease;
        }

        .carnate-stock-modal .form-control::placeholder {
            color: #94a3b8 !important;
            font-size: 12.5px;
        }

        .carnate-stock-modal .form-control:focus,
        .carnate-stock-modal .form-select:focus {
            border-color: rgba(229, 57, 53, .55) !important;
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .08) !important;
            outline: none !important;
        }

        .carnate-stock-modal .input-group-text {
            background: #f8fafc !important;
            border: 1px solid var(--c-border) !important;
            border-left: 0 !important;
            border-radius: 0 9px 9px 0 !important;
            color: var(--c-muted) !important;
            font-weight: 600 !important;
            font-size: 13px !important;
            padding: 0 14px !important;
        }

        .carnate-stock-modal .input-group .form-control {
            border-radius: 9px 0 0 9px !important;
        }

        .carnate-stock-modal .vehicles-card {
            background: #f8fafc;
            border: 1px solid var(--c-border);
            border-radius: 12px;
            padding: 18px;
            margin-top: 14px;
        }

        .carnate-stock-modal .modal-footer {
            padding: 14px 22px !important;
            border-top: 1px solid var(--c-border) !important;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
        }

        .carnate-stock-modal .btn-cancel {
            height: 40px;
            padding: 0 18px;
            border-radius: 9px;
            border: 1px solid var(--c-border);
            background: #fff;
            color: var(--c-muted);
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all .2s;
        }

        .carnate-stock-modal .btn-cancel:hover {
            background: #f1f5f9;
            color: var(--c-text);
        }

        .carnate-stock-modal .btn-submit {
            height: 40px;
            padding: 0 24px;
            border-radius: 9px;
            border: none;
            background: var(--c-red);
            color: #fff !important;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(229, 57, 53, .22);
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all .2s;
        }

        .carnate-stock-modal .btn-submit:hover {
            background: var(--c-red-dark);
            transform: translateY(-1px);
        }
    </style>

    <div class="modal carnate-stock-modal @if ($showstock) show @endif" tabindex="-1"
        style="display: @if ($showstock) flex !important; align-items: center; justify-content: center; @else none !important; @endif">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                {{-- Header --}}
                <div class="modal-header">
                    <div class="modal-title-wrap">
                        <div class="modal-title-icon">
                            <i class="bx bx-package"></i>
                        </div>
                        <div>
                            <h4 class="modal-title">
                                Create
                                @if ($showTable == 2)
                                    Spare Parts
                                @elseif ($showTable == 3)
                                    Lubricant
                                @elseif ($showTable == 5)
                                    Accessory
                                @endif
                                Stock Order
                            </h4>
                            <p class="modal-subtitle">Add new inventory item and set pricing & compatibility</p>
                        </div>
                    </div>
                    <button type="button" class="btn-close" wire:click="$set('showstock', false)" aria-label="Close"></button>
                </div>

                {{-- Body --}}
                <div class="modal-body">
                    {{-- Section 1: Item Details --}}
                    <div class="form-section-title">
                        <i class="bx bx-info-circle"></i> Item Information
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="stock_itemName" class="form-label">Item Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" wire:model="stock_itemName" id="stock_itemName"
                                placeholder="Enter item name...">
                            @error('stock_itemName')
                                <div class="text-danger mt-1 small">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="stock_brand_name" class="form-label">Brand Name</label>
                            <input type="text" class="form-control" wire:model="stock_brand_name" id="stock_brand_name"
                                placeholder="Enter brand name...">
                            @error('stock_brand_name')
                                <div class="text-danger mt-1 small">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="stock_hsn_code" class="form-label">HSN Code</label>
                            <input type="text" class="form-control" wire:model="stock_hsn_code" id="stock_hsn_code"
                                placeholder="Enter HSN code...">
                            @error('stock_hsn_code')
                                <div class="text-danger mt-1 small">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="stock_part_number" class="form-label">Part Number</label>
                            <input type="text" class="form-control" wire:model="stock_part_number" id="stock_part_number"
                                placeholder="Enter part number...">
                            @error('stock_part_number')
                                <div class="text-danger mt-1 small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Section 2: Pricing & Tax --}}
                    <div class="form-section-title">
                        <i class="bx bx-dollar-circle"></i> Pricing & Tax Details
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="stock_buy_price" class="form-label">Buy Price <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" wire:model="stock_buy_price" id="stock_buy_price"
                                placeholder="0.00">
                            @error('stock_buy_price')
                                <div class="text-danger mt-1 small">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="stock_sellPrice" class="form-label">Sell Price <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" wire:model="stock_sellPrice" id="stock_sellPrice"
                                placeholder="0.00">
                            @error('stock_sellPrice')
                                <div class="text-danger mt-1 small">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="stock_tax_type" class="form-label">Tax Type <span class="text-danger">*</span></label>
                            <select id="tax_type" class="form-select" wire:model="stock_tax_type">
                                <option value="">Select Tax Type</option>
                                <option value="include">Include All Taxes</option>
                                <option value="exclude">Exclude All Taxes</option>
                            </select>
                            @error('stock_tax_type')
                                <div class="text-danger mt-1 small">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="stock_tax_percentage" class="form-label">Tax Percentage <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" wire:model.live="stock_tax_percentage" class="form-control"
                                    placeholder="Enter percentage" id="tax_percentage">
                                <span class="input-group-text">%</span>
                            </div>
                            @error('stock_tax_percentage')
                                <div class="text-danger mt-1 small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Section 3: Inventory & Category --}}
                    <div class="form-section-title">
                        <i class="bx bx-archive"></i> Stock & Storage
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="stock_quantity" class="form-label">Stock Quantity</label>
                            <input type="number" class="form-control" wire:model="stock_quantity" id="stock_quantity"
                                placeholder="Enter quantity...">
                            @error('stock_quantity')
                                <div class="text-danger mt-1 small">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="stock_rack_no" class="form-label">Rack No.</label>
                            <input type="text" class="form-control" wire:model="stock_rack_no" id="stock_rack_no"
                                placeholder="Enter rack no...">
                            @error('stock_rack_no')
                                <div class="text-danger mt-1 small">{{ $message }}</div>
                            @enderror
                        </div>
                        @if ($showTable == 2)
                            <div class="col-md-6">
                                <label for="stock_sp_type" class="form-label">SP Type</label>
                                <select class="form-select" wire:model="stock_sp_type" id="stock_sp_type">
                                    <option value="0">New</option>
                                    <option value="1">Used</option>
                                </select>
                                @error('stock_sp_type')
                                    <div class="text-danger mt-1 small">{{ $message }}</div>
                                @enderror
                            </div>
                        @endif
                        <div class="col-md-6">
                            <label for="stock_unit" class="form-label">Unit</label>
                            <select id="stock_unit" class="form-select" wire:model="stock_unit">
                                <option value="">Select Unit</option>
                                @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->title }}</option>
                                @endforeach
                            </select>
                            @error('stock_unit')
                                <div class="text-danger mt-1 small">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="stock_category" class="form-label">Sub Category</label>
                            <select class="form-select" wire:model="stock_category" id="stock_category">
                                <option value="">Select Sub Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                            @error('stock_category')
                                <div class="text-danger mt-1 small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Section 4: Vehicle Compatibility --}}
                    <div class="vehicles-card">
                        <div class="form-section-title" style="border: none; padding-bottom: 0;">
                            <i class="bx bx-car"></i> Compatible Vehicles <span class="text-danger">*</span>
                        </div>
                        <div class="form-check my-2">
                            <input type="checkbox" wire:model.live="forAllVehicles" id="all_vehicles" class="form-check-input" style="cursor: pointer;">
                            <label for="all_vehicles" class="form-check-label fw-bold text-dark" style="cursor: pointer; font-size: 13px;">For All Vehicles</label>
                        </div>

                        @if (!$forAllVehicles)
                            <div class="border-top pt-3 mt-2">
                                <label class="form-label text-muted" style="font-size: 11px; text-transform: uppercase;">1. Select From 3rd Party Catalog</label>
                                @livewire('workshop.vehicle-selector')
                            </div>

                            <div class="border-top pt-3 mt-3">
                                <label class="form-label text-muted" style="font-size: 11px; text-transform: uppercase;">2. Or Select From Saved Vehicles</label>
                                <select id="suitable_for" class="form-select searchable-select" multiple
                                    data-placeholder="Search and select vehicle..."
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
                                    <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="border-top pt-3 mt-3">
                                <label class="form-label" style="font-size: 12px; font-weight: 700; color: #1e293b;">
                                    Selected Compatible Vehicles ({{ is_array($suitable_for) ? count($suitable_for) : 0 }})
                                </label>
                                <div class="d-flex flex-wrap gap-2 mt-1">
                                    @if(empty($suitable_for))
                                        <span class="text-muted" style="font-size: 12px;">No vehicles selected yet.</span>
                                    @else
                                        @foreach ($suitable_for as $index => $modId)
                                            @php
                                                $localMod = $modifications->firstWhere('id', $modId);
                                            @endphp
                                            @if ($localMod)
                                                <span class="badge bg-secondary p-2 d-inline-flex align-items-center gap-2" style="font-size: 12px; border-radius: 6px; font-weight: 500;">
                                                    {{ $localMod->brand_name }} {{ $localMod->variant_name }} ({{ $localMod->year }}) - {{ $localMod->title }}
                                                    <button type="button" class="btn-close btn-close-white ms-1" style="font-size: 0.55rem; padding: 0; margin: 0; width: 0.55rem; height: 0.55rem;" wire:click="removeCompatibleVehicle({{ $index }})"></button>
                                                </span>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="mt-2">
                                <span class="badge bg-danger px-3 py-2" style="font-size: 12px; border-radius: 6px;">Applicable to All Vehicles</span>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Footer --}}
                <div class="modal-footer">
                    <button type="button" class="btn-cancel" wire:click="$set('showstock', false)">
                        Cancel
                    </button>
                    <button type="button" class="btn-submit" wire:click="storestock">
                        <span>Save Stock</span>
                        <i class="spinner-border spinner-border-sm" wire:loading></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
