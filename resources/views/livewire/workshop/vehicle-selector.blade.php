<div>
    <div class="row g-2 align-items-end">
        <div class="col-md-3">
            <label class="form-label font-12 text-muted">Brand</label>
            <select wire:model.live="brand_name" class="form-select searchable-select" data-placeholder="Select Brand">
                <option value="">Select Brand</option>
                @foreach ($brands as $brand)
                    <option value="{{ json_encode($brand) }}">
                        {{ is_array($brand) ? $brand['name'] : $brand->name }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div class="col-md-3">
            <label class="form-label font-12 text-muted">Model</label>
            <select wire:model.live="variant_name" class="form-select searchable-select" data-placeholder="Select Model" @if(empty($variants)) disabled @endif>
                <option value="">Select Model</option>
                @foreach ($variants as $index => $variant)
                    <option value="{{ $index }}">
                        {{ is_array($variant) ? $variant['name'] : $variant->name }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div class="col-md-3">
            <label class="form-label font-12 text-muted">Year</label>
            <select wire:model.live="selected_year" class="form-select searchable-select" data-placeholder="Select Year" @if(empty($years)) disabled @endif>
                <option value="">Select Year</option>
                @foreach ($years as $year)
                    <option value="{{ is_array($year) ? $year['value'] : $year }}">
                        {{ is_array($year) ? $year['label'] : $year }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div class="col-md-3">
            <label class="form-label font-12 text-muted">Modification</label>
            <select wire:model.live="search_vehicle" class="form-select searchable-select" data-placeholder="Select Modification" @if(empty($modifications)) disabled @endif>
                <option value="">Select Modification</option>
                @foreach ($modifications as $index => $mod)
                    <option value="{{ is_array($mod) ? $mod['id'] : $index }}">
                        {{ is_array($mod) ? $mod['name'] . ' (' . $mod['yearFrom'] . '-' . $mod['yearTo'] . ')' . ($mod['fuelType'] ? ' - ' . $mod['fuelType'] : '') : $mod }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    
    @if (isset($selectedVehicleName) && $selectedVehicleName != '')
        <div class="mt-2 d-flex align-items-center justify-content-between bg-light p-2 rounded border border-info">
            <span class="text-info fw-bold font-13">
                <i class="bx bx-check-circle me-1"></i> Selected: {{ $selectedVehicleName }}
            </span>
            <button type="button" class="btn btn-sm btn-primary px-3" wire:click="addVehicle" wire:loading.attr="disabled">
                Add Vehicle <i class="spinner-border spinner-border-sm ms-1" wire:loading wire:target="addVehicle"></i>
            </button>
        </div>
    @endif
</div>
