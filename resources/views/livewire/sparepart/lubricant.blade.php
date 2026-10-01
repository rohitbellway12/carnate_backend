<div class="carnate-lubricant-page">

    {{-- =========================================================
        SUCCESS MESSAGE
    ========================================================== --}}
    @if (session()->has('message'))
        <div class="carnate-alert carnate-alert-success">
            <i class="bx bx-check-circle"></i>
            <span>{{ session('message') }}</span>
        </div>
    @endif


    @php
        $sparePart = App\Models\SparePartVendor::where('id', $sparepartId)->first();
    @endphp


    {{-- =========================================================
        CREATE / EDIT LUBRICANT MODAL
    ========================================================== --}}
    <div class="modal @if ($showModal) show @endif"
        tabindex="-1"
        style="opacity:1; background-color:#0606068c; display:@if ($showModal) block @endif">

        <div class="modal-dialog modal-lg modal-dialog-centered">

            <div class="modal-content carnate-modal">

                <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">

                    {{-- Modal Header --}}
                    <div class="carnate-modal-header">

                        <div class="carnate-modal-title">

                            <div class="carnate-modal-icon">
                                <i class="bx {{ $isEdit ? 'bx-edit' : 'bx-plus' }}"></i>
                            </div>

                            <div>
                                <h4>
                                    {{ $isEdit ? 'Edit Lubricant' : 'Create Lubricant' }}
                                </h4>

                                <p>
                                    {{ $isEdit ? 'Update lubricant information' : 'Add a new lubricant to inventory' }}
                                </p>
                            </div>

                        </div>

                        <button type="button"
                            class="carnate-close"
                            wire:click="$set('showModal', false)"
                            data-bs-dismiss="modal"
                            aria-label="Close">

                            <i class="bx bx-x"></i>

                        </button>

                    </div>


                    {{-- Modal Body --}}
                    <div class="carnate-modal-body">

                        @csrf

                        <div class="row g-3">


                            {{-- =================================================
                                NAME
                            ================================================== --}}
                            <div class="col-md-6">

                                <div class="carnate-field">

                                    <label>
                                        Name
                                        <span>*</span>
                                    </label>

                                    <div class="carnate-name-row">

                                        <div class="carnate-select-wrap">

                                            <i class="bx bx-purchase-tag"></i>

                                            <select class="form-select"
                                                wire:model="name"
                                                id="name">

                                                <option value="">
                                                    Select a Name or Add New One
                                                </option>

                                                @foreach ($sparePartLabels as $sparePartLabel)

                                                    <option value="{{ $sparePartLabel->title }}">
                                                        {{ $sparePartLabel->title }}
                                                    </option>

                                                @endforeach

                                            </select>

                                        </div>

                                        <button type="button"
                                            class="carnate-add-small"
                                            wire:click="addLubricantLabel"
                                            title="Add Lubricant Label">

                                            <i class="bx bx-plus"></i>

                                        </button>

                                    </div>

                                    @error('name')
                                        <span class="carnate-error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>

                            </div>


                            {{-- =================================================
                                SUPPLIER
                            ================================================== --}}
                            <div class="col-md-6">

                                <div class="carnate-field">

                                    <label>
                                        Supplier
                                    </label>

                                    <div class="carnate-input-wrap">

                                        <i class="bx bx-user"></i>

                                        <select class="form-select searchable-select"
                                            data-placeholder="Select Supplier"
                                            wire:model="supplier_id">

                                            <option value="">
                                                Select Supplier
                                            </option>

                                            @foreach ($suppliers as $supplier)

                                                <option value="{{ $supplier->id }}">
                                                    {{ $supplier->owner_first_name }}
                                                </option>

                                            @endforeach

                                        </select>

                                    </div>

                                </div>

                            </div>


                            {{-- =================================================
                                BRAND
                            ================================================== --}}
                            <div class="col-md-6">

                                <div class="carnate-field">

                                    <label>
                                        Brand
                                    </label>

                                    <div class="carnate-input-wrap">

                                        <i class="bx bx-purchase-tag-alt"></i>

                                        <input type="text"
                                            wire:model="brand"
                                            placeholder="Enter Brand">

                                    </div>

                                    @error('brand')
                                        <span class="carnate-error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>

                            </div>


                            {{-- =================================================
                                PART NUMBER
                            ================================================== --}}
                            <div class="col-md-6">

                                <div class="carnate-field">

                                    <label>
                                        Part Number
                                    </label>

                                    <div class="carnate-input-wrap">

                                        <i class="bx bx-barcode"></i>

                                        <input type="text"
                                            wire:model="part_number"
                                            placeholder="Enter Part Number">

                                    </div>

                                    <div wire:loading wire:target="part_number"
                                        class="carnate-loading-text">

                                        <span class="spinner-border spinner-border-sm"></span>
                                        Fetching details...

                                    </div>

                                    @error('part_number')
                                        <span class="carnate-error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>

                            </div>


                            {{-- =================================================
                                PURCHASE PRICE
                            ================================================== --}}
                            <div class="col-md-6">

                                <div class="carnate-field">

                                    <label>
                                        Purchase Price
                                        <span>*</span>
                                    </label>

                                    <div class="carnate-input-wrap">

                                        <span class="carnate-currency">
                                            ₹
                                        </span>

                                        <input type="number"
                                            wire:model.live="purchase_amount"
                                            placeholder="Enter Purchase Price">

                                    </div>

                                    @error('purchase_amount')
                                        <span class="carnate-error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>

                            </div>


                            {{-- =================================================
                                SELLING PRICE
                            ================================================== --}}
                            <div class="col-md-6">

                                <div class="carnate-field">

                                    <label>
                                        Selling Price
                                        <span>*</span>
                                    </label>

                                    <div class="carnate-input-wrap">

                                        <span class="carnate-currency">
                                            ₹
                                        </span>

                                        <input type="number"
                                            wire:model.live="selling_amount"
                                            placeholder="Enter Selling Price">

                                    </div>

                                    @error('selling_amount')
                                        <span class="carnate-error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>

                            </div>


                            {{-- =================================================
                                ONLINE PRICE
                            ================================================== --}}
                            <div class="col-md-6">

                                <div class="carnate-field">

                                    <label>
                                        Online Price
                                        <span class="carnate-auto-label">AUTO</span>
                                    </label>

                                    <div class="carnate-input-wrap carnate-readonly">

                                        <span class="carnate-currency">
                                            ₹
                                        </span>

                                        <input type="text"
                                            wire:model="online_price"
                                            readonly>

                                    </div>

                                </div>

                            </div>


                            {{-- =================================================
                                OFFLINE PRICE
                            ================================================== --}}
                            <div class="col-md-6">

                                <div class="carnate-field">

                                    <label>
                                        Offline Price
                                        <span class="carnate-auto-label">AUTO</span>
                                    </label>

                                    <div class="carnate-input-wrap carnate-readonly">

                                        <span class="carnate-currency">
                                            ₹
                                        </span>

                                        <input type="text"
                                            wire:model="offline_price"
                                            readonly>

                                    </div>

                                </div>

                            </div>


                            {{-- =================================================
                                TAX TYPE
                            ================================================== --}}
                            <div class="col-md-6">

                                <div class="carnate-field">

                                    <label>
                                        Tax Type
                                    </label>

                                    <div class="carnate-input-wrap">

                                        <i class="bx bx-receipt"></i>

                                        <select id="tax_type"
                                            class="form-select"
                                            wire:model.live="tax_type">

                                            <option value="">
                                                Select Tax Type
                                            </option>

                                            <option value="include">
                                                Include All Taxes
                                            </option>

                                            <option value="exclude">
                                                Exclude All Taxes
                                            </option>

                                        </select>

                                    </div>

                                    @error('tax_type')
                                        <span class="carnate-error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>

                            </div>


                            {{-- =================================================
                                TAX PERCENTAGE
                            ================================================== --}}
                            @if ($tax_type == 'include' || $tax_type == 'exclude')

                                <div class="col-md-6">

                                    <div class="carnate-field">

                                        <label>
                                            {{ $tax_type == 'include' ? 'Include Tax Percentage' : 'Exclude Tax Percentage' }}
                                        </label>

                                        <div class="carnate-input-wrap">

                                            <input type="number"
                                                wire:model.live="tax_percentage"
                                                placeholder="Enter Percentage">

                                            <span class="carnate-input-suffix">
                                                %
                                            </span>

                                        </div>

                                        @error('tax_percentage')
                                            <span class="carnate-error">
                                                {{ $message }}
                                            </span>
                                        @enderror

                                    </div>

                                </div>

                            @endif


                            {{-- =================================================
                                DISCOUNT
                            ================================================== --}}
                            <div class="col-md-6">

                                <div class="carnate-field">

                                    <label>
                                        Online Discount
                                    </label>

                                    <div class="carnate-discount-wrap">

                                        <input type="number"
                                            wire:model.live="discount"
                                            placeholder="Enter Discount">

                                        <select id="discount_type"
                                            wire:model.live="discount_type">

                                            <option value="1">
                                                ₹
                                            </option>

                                            <option value="2">
                                                %
                                            </option>

                                        </select>

                                    </div>

                                    @error('discount')
                                        <span class="carnate-error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                    @error('discount_type')
                                        <span class="carnate-error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>

                            </div>


                            {{-- =================================================
                                UNIT
                            ================================================== --}}
                            <div class="col-md-6">

                                <div class="carnate-field">

                                    <label>
                                        Unit
                                        <span>*</span>
                                    </label>

                                    <div class="carnate-input-wrap">

                                        <i class="bx bx-ruler"></i>

                                        <select class="form-select"
                                            wire:model="unit">

                                            <option value="">
                                                Select Unit
                                            </option>

                                            @foreach ($units as $unit)

                                                <option value="{{ $unit->id }}">
                                                    {{ $unit->title }}
                                                </option>

                                            @endforeach

                                        </select>

                                    </div>

                                    @error('unit')
                                        <span class="carnate-error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>

                            </div>


                            {{-- =================================================
                                STOCK
                            ================================================== --}}
                            <div class="col-md-6">

                                <div class="carnate-field">

                                    <label>
                                        Stock
                                        <span>*</span>
                                    </label>

                                    <div class="carnate-input-wrap">

                                        <i class="bx bx-package"></i>

                                        <input type="number"
                                            wire:model="stock"
                                            placeholder="Enter Stock">

                                    </div>

                                    @error('stock')
                                        <span class="carnate-error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>

                            </div>


                            {{-- =================================================
                                RACK NUMBER
                            ================================================== --}}
                            <div class="col-md-6">

                                <div class="carnate-field">

                                    <label>
                                        Rack No.
                                    </label>

                                    <div class="carnate-input-wrap">

                                        <i class="bx bx-grid-alt"></i>

                                        <input type="text"
                                            wire:model="rack_no"
                                            placeholder="Enter Rack Number">

                                    </div>

                                    @error('rack_no')
                                        <span class="carnate-error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>

                            </div>


                            {{-- =================================================
                                CATEGORY
                            ================================================== --}}
                            <div class="col-md-6">

                                <div class="carnate-field">

                                    <label>
                                        Category
                                        <span>*</span>
                                    </label>

                                    <div class="carnate-input-wrap">

                                        <i class="bx bx-category"></i>

                                        <select class="form-select searchable-select"
                                            data-placeholder="Select Category"
                                            wire:model="category"
                                            id="category">

                                            <option value="">
                                                Select Category
                                            </option>

                                            @foreach ($categories as $category)

                                                <option value="{{ $category['categoryId'] }}">
                                                    {{ $category['categoryName'] }}
                                                </option>

                                            @endforeach

                                        </select>

                                    </div>

                                    @error('category')
                                        <span class="carnate-error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>

                            </div>


                            {{-- =================================================
                                IMAGE
                            ================================================== --}}
                            <div class="col-md-12">

                                <div class="carnate-image-section">

                                    <div class="carnate-image-upload">

                                        <label>
                                            Product Image
                                        </label>

                                        <input type="file"
                                            class="form-control"
                                            wire:model="license_image">

                                        @error('license_image')
                                            <span class="carnate-error">
                                                {{ $message }}
                                            </span>
                                        @enderror

                                    </div>


                                    <div class="carnate-image-preview">

                                        @if ($part_image_url)

                                            <img src="{{ $part_image_url }}"
                                                alt="lubricant image">

                                        @elseif (!empty($licenseName))

                                            <img src="{{ asset($licenseName) }}"
                                                alt="lubricant image">

                                        @else

                                            @if ($isEdit)

                                                <img src="{{ asset($licenseImage) }}"
                                                    alt="lubricant image">

                                            @else

                                                <div class="carnate-no-image">
                                                    <i class="bx bx-image"></i>
                                                </div>

                                            @endif

                                        @endif

                                    </div>

                                </div>

                            </div>


                            {{-- =================================================
                                FOR ALL VEHICLES
                            ================================================== --}}
                            <div class="col-md-12">

                                <div class="carnate-all-vehicles">

                                    <input class="form-check-input"
                                        type="checkbox"
                                        wire:model="forAllVehicles"
                                        id="forAllVehicles">

                                    <div>

                                        <label for="forAllVehicles">
                                            For All Vehicles
                                        </label>

                                        <p>
                                            Make this lubricant compatible with every vehicle.
                                        </p>

                                    </div>

                                </div>

                            </div>


                            @if (!$forAllVehicles)

                                {{-- =================================================
                                    VEHICLE SELECTOR
                                ================================================== --}}
                                <div class="col-md-12">

                                    <div class="carnate-vehicle-section">

                                        <div class="carnate-section-title">

                                            <div class="carnate-section-icon">
                                                <i class="bx bx-car"></i>
                                            </div>

                                            <div>

                                                <h6>
                                                    Compatible Vehicles
                                                </h6>

                                                <p>
                                                    Select vehicles compatible with this lubricant
                                                </p>

                                            </div>

                                        </div>


                                        <div class="carnate-vehicle-selector">

                                            @livewire('workshop.vehicle-selector')

                                        </div>

                                    </div>

                                </div>


                                {{-- =================================================
                                    EXISTING VEHICLES
                                ================================================== --}}
                                <div class="col-md-12">

                                    <div class="carnate-field">

                                        <label>
                                            Or Select from Existing Saved Vehicles
                                        </label>

                                        <div class="carnate-input-wrap carnate-multi-select">

                                            <select id="suitable_for"
                                                class="form-select searchable-select"
                                                multiple
                                                data-placeholder="Select vehicle"
                                                wire:model="suitable_for">

                                                @foreach ($modifications as $modification)

                                                    <option value="{{ $modification->id }}"
                                                        @if (is_array($suitable_for) && in_array($modification->id, $suitable_for)) selected @endif>

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

                                        </div>

                                        @error('suitable_for')
                                            <span class="carnate-error">
                                                {{ $message }}
                                            </span>
                                        @enderror

                                    </div>

                                </div>


                                {{-- =================================================
                                    SELECTED VEHICLES
                                ================================================== --}}
                                <div class="col-md-12">

                                    <div class="carnate-selected-section">

                                        <div class="carnate-selected-title">

                                            Selected Compatible Vehicles

                                            <span>
                                                {{ is_array($suitable_for) ? count($suitable_for) : 0 }}
                                            </span>

                                        </div>


                                        <div class="carnate-selected-list">

                                            @if (empty($suitable_for))

                                                <span class="carnate-no-selection">
                                                    No vehicles selected yet.
                                                </span>

                                            @else

                                                @foreach ($suitable_for as $index => $modId)

                                                    @php
                                                        $localMod = $modifications->firstWhere('id', $modId);
                                                    @endphp

                                                    @if ($localMod)

                                                        <span class="carnate-vehicle-badge">

                                                            <span>
                                                                {{ $localMod->brand_name }}
                                                                {{ $localMod->variant_name }}
                                                                ({{ $localMod->year }})
                                                                -
                                                                {{ $localMod->title }}
                                                            </span>

                                                            <button type="button"
                                                                wire:click="removeCompatibleVehicle({{ $index }})">

                                                                <i class="bx bx-x"></i>

                                                            </button>

                                                        </span>

                                                    @endif

                                                @endforeach

                                            @endif

                                        </div>

                                    </div>

                                </div>

                            @endif


                            {{-- =================================================
                                DESCRIPTION
                            ================================================== --}}
                            <div class="col-md-12">

                                <div class="carnate-field">

                                    <label>
                                        Description
                                    </label>

                                    <textarea wire:model="description"
                                        class="carnate-textarea"
                                        placeholder="Enter Description"></textarea>

                                    @error('description')
                                        <span class="carnate-error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- Modal Footer --}}
                    <div class="carnate-modal-footer">

                        <button type="button"
                            class="carnate-btn carnate-btn-light"
                            wire:click="$set('showModal', false)"
                            data-bs-dismiss="modal">

                            Cancel

                        </button>

                        <button type="submit"
                            class="carnate-btn carnate-btn-primary">

                            <i class="bx {{ $isEdit ? 'bx-save' : 'bx-plus' }}"></i>

                            {{ $isEdit ? 'Update' : 'Create' }}

                            <span class="spinner-border spinner-border-sm"
                                wire:loading>
                            </span>

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>


    {{-- =========================================================
        CREATE LUBRICANT LABEL MODAL
    ========================================================== --}}
    <div class="modal @if ($showLubricantModel) show @endif"
        tabindex="-1"
        style="opacity:1; background-color:#0606068c; display:@if ($showLubricantModel) block @endif">

        <div class="modal-dialog modal-md modal-dialog-centered">

            <div class="modal-content carnate-modal">

                <form wire:submit.prevent="lubricantLabelStore">

                    <div class="carnate-modal-header">

                        <div class="carnate-modal-title">

                            <div class="carnate-modal-icon">
                                <i class="bx bx-purchase-tag"></i>
                            </div>

                            <div>
                                <h4>Create Lubricant</h4>
                                <p>Add a new lubricant label</p>
                            </div>

                        </div>

                        <button type="button"
                            class="carnate-close"
                            wire:click="$set('showLubricantModel', false)"
                            data-bs-dismiss="modal"
                            aria-label="Close">

                            <i class="bx bx-x"></i>

                        </button>

                    </div>


                    <div class="carnate-modal-body">

                        @csrf

                        <div class="carnate-field">

                            <label>
                                Lubricant Label
                            </label>

                            <div class="carnate-input-wrap">

                                <i class="bx bx-label"></i>

                                <input type="text"
                                    wire:model="lubricant_label"
                                    class="form-control"
                                    placeholder="Enter Lubricant Label">

                            </div>

                            @error('lubricant_label')
                                <span class="carnate-error">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>

                    </div>


                    <div class="carnate-modal-footer">

                        <button type="button"
                            class="carnate-btn carnate-btn-light"
                            wire:click="$set('showLubricantModel', false)"
                            data-bs-dismiss="modal">

                            Cancel

                        </button>

                        <button type="submit"
                            class="carnate-btn carnate-btn-primary">

                            <i class="bx bx-plus"></i>

                            {{ $isEdit ? 'Update' : 'Create' }}

                            <span class="spinner-border spinner-border-sm"
                                wire:loading>
                            </span>

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>


    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}
    <div class="carnate-page-header">

        <div class="carnate-page-header-left">

            <div class="carnate-page-icon">
                <i class="bx bx-droplet"></i>
            </div>

            <div>

                <h2>Lubricants</h2>

                <p>
                    Manage lubricant products, pricing, stock and compatibility
                </p>

            </div>

        </div>


        @if (@$sparePart->hasPermissionTo('lubricant-add'))

            <button type="button"
                wire:click="create"
                class="carnate-btn carnate-btn-primary">

                <i class="bx bx-plus"></i>
                Add Lubricant

            </button>

        @endif

    </div>


    {{-- =========================================================
        SEARCH
    ========================================================== --}}
    <div class="carnate-search-card">

        <div class="carnate-search">

            <i class="bx bx-search"></i>

            <input type="text"
                placeholder="Search lubricant..."
                wire:model.live="searchfilter">

        </div>

        <button type="button"
            class="carnate-btn carnate-btn-outline"
            wire:click="resetFilter">

            <i class="bx bx-refresh"></i>
            Clear

        </button>

    </div>


    {{-- =========================================================
        TABLE
    ========================================================== --}}
    <div class="carnate-table-card">

        @if (!empty($lubricants) && $lubricants->count())

            <div class="carnate-table-header">

                <div>

                    <h5>
                        <i class="bx bx-list-ul"></i>
                        Lubricant Inventory
                    </h5>

                    <p>
                        Manage your lubricant products
                    </p>

                </div>

                <div class="carnate-total-badge">

                    {{ $lubricants->total() }} Products

                </div>

            </div>


            <div class="table-responsive">

                <table class="carnate-table">

                    <thead>

                        <tr>

                            <th>
                                #
                            </th>

                            <th>
                                Image
                            </th>

                            <th>
                                Name
                            </th>

                            <th>
                                Brand
                            </th>

                            <th>
                                Part Number
                            </th>

                            <th>
                                Unit
                            </th>

                            <th>
                                Online Price
                            </th>

                            <th>
                                Offline Price
                            </th>

                            <th>
                                Tax
                            </th>

                            <th>
                                Stock
                            </th>

                            <th>
                                Rack No.
                            </th>

                            @if (@$sparePart->hasPermissionTo('lubricant-edit') || @$sparePart->hasPermissionTo('lubricant-delete'))

                                <th class="action-column">
                                    Actions
                                </th>

                            @endif

                        </tr>

                    </thead>


                    <tbody>

                        @foreach ($lubricants as $index => $lubricant)

                            <tr>

                                {{-- Serial --}}
                                <td class="serial-number">

                                    {{ $lubricants->total() - ($lubricants->firstItem() + $index) + 1 }}

                                </td>


                                {{-- Image --}}
                                <td>

                                    <div class="product-image">

                                        @if (!empty($lubricant->Image->file))

                                            <img src="{{ asset($lubricant->Image->file) }}"
                                                alt="lubricant image">

                                        @else

                                            <img src="{{ asset('img/lubricant.jpg') }}"
                                                alt="lubricant image">

                                        @endif

                                    </div>

                                </td>


                                {{-- Name --}}
                                <td>

                                    <div class="product-name">
                                        {{ $lubricant->name }}
                                    </div>

                                </td>


                                {{-- Brand --}}
                                <td>

                                    <span class="table-muted">
                                        {{ $lubricant->brand ?: '—' }}
                                    </span>

                                </td>


                                {{-- Part Number --}}
                                <td>

                                    <span class="part-number">
                                        {{ $lubricant->part_number ?: '—' }}
                                    </span>

                                </td>


                                {{-- Unit --}}
                                <td>

                                    <span class="unit-badge">
                                        {{ $lubricant->unit?->title ?? '' }}
                                    </span>

                                </td>


                                {{-- Online Price --}}
                                <td>

                                    @php

                                        $onlinePrice = $lubricant->selling_amount;

                                        if ($lubricant->tax_type == 'exclude' && $lubricant->tax_percentage) {
                                            $onlinePrice += ($onlinePrice * $lubricant->tax_percentage) / 100;
                                        }

                                        if ($lubricant->discount) {

                                            if ($lubricant->discount_type == 1) {

                                                $onlinePrice -= $lubricant->discount;

                                            } elseif ($lubricant->discount_type == 2) {

                                                $onlinePrice -= ($onlinePrice * $lubricant->discount) / 100;

                                            }

                                        }

                                    @endphp

                                    <span class="price">
                                        ₹{{ number_format($onlinePrice, 2) }}
                                    </span>

                                </td>


                                {{-- Offline Price --}}
                                <td>

                                    @php

                                        $offlinePrice = $lubricant->selling_amount;

                                        if ($lubricant->tax_type == 'exclude' && $lubricant->tax_percentage) {

                                            $offlinePrice +=
                                                ($offlinePrice * $lubricant->tax_percentage) / 100;

                                        }

                                    @endphp

                                    <span class="price">
                                        ₹{{ number_format($offlinePrice, 2) }}
                                    </span>

                                </td>


                                {{-- Tax --}}
                                <td>

                                    @if ($lubricant->tax_percentage)

                                        <span class="tax-badge">

                                            {{ $lubricant->tax_type == 'include' ? 'Include' : 'Exclude' }}

                                            {{ $lubricant->tax_percentage }}%

                                        </span>

                                    @else

                                        <span class="table-muted">
                                            —
                                        </span>

                                    @endif

                                </td>


                                {{-- Stock --}}
                                <td>

                                    <span class="stock-badge">
                                        {{ $lubricant->stock }}
                                    </span>

                                </td>


                                {{-- Rack --}}
                                <td>

                                    <span class="table-muted">
                                        {{ $lubricant->rack_no ?: '—' }}
                                    </span>

                                </td>


                                {{-- Actions --}}
                                @if (@$sparePart->hasPermissionTo('lubricant-edit') || @$sparePart->hasPermissionTo('lubricant-delete'))

                                    <td>

                                        <div class="table-actions">

                                            @if (@$sparePart->hasPermissionTo('lubricant-edit'))

                                                <button type="button"
                                                    wire:click="edit({{ $lubricant->id }})"
                                                    class="table-action edit"
                                                    title="Edit">

                                                    <i class="bx bx-edit"></i>

                                                </button>

                                            @endif


                                            @if (@$sparePart->hasPermissionTo('lubricant-delete'))

                                                <button type="button"
                                                    wire:click="confirmDelete({{ $lubricant->id }})"
                                                    class="table-action delete"
                                                    title="Delete">

                                                    <i class="bx bx-trash"></i>

                                                </button>

                                            @endif

                                        </div>

                                    </td>

                                @endif

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>


            {{-- Pagination --}}
            <div class="carnate-pagination">

                {{ $lubricants->links() }}

            </div>

        @else

            <div class="carnate-empty">

                <div class="carnate-empty-icon">
                    <i class="bx bx-droplet"></i>
                </div>

                <h5>
                    No Lubricant found!
                </h5>

                <p>
                    There are no lubricant products matching your current search.
                </p>

                @if ($searchfilter)

                    <button type="button"
                        class="carnate-btn carnate-btn-outline"
                        wire:click="resetFilter">

                        <i class="bx bx-refresh"></i>
                        Clear Search

                    </button>

                @endif

            </div>

        @endif

    </div>


    {{-- =========================================================
        STYLES
    ========================================================== --}}
    <style>

        .carnate-lubricant-page {
            --c-bg: #f7f8fa;
            --c-white: #ffffff;
            --c-text: #111827;
            --c-muted: #64748b;
            --c-border: #e2e8f0;
            --c-red: #e53935;
            --c-red-dark: #cf302d;
            --c-red-soft: #fff5f5;
            --c-icon: #f1f5f9;
        }

        .carnate-lubricant-page * {
            box-sizing: border-box;
        }


        /* =====================================================
           ALERT
        ====================================================== */

        .carnate-alert {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 12px 15px;
            margin-bottom: 18px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
        }

        .carnate-alert-success {
            color: #166534;
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
        }

        .carnate-alert i {
            font-size: 19px;
        }


        /* =====================================================
           PAGE HEADER
        ====================================================== */

        .carnate-page-header {
            background: #fff;
            border: 1px solid var(--c-border);
            border-radius: 14px;
            padding: 18px 20px;
            min-height: 82px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 18px;
            box-shadow: 0 2px 8px rgba(15, 23, 42, .03);
        }

        .carnate-page-header-left {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .carnate-page-icon {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            background: var(--c-red-soft);
            color: var(--c-red);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            flex-shrink: 0;
        }

        .carnate-page-header h2 {
            margin: 0 0 3px;
            font-size: 21px;
            line-height: 1.2;
            font-weight: 750;
            color: var(--c-text);
        }

        .carnate-page-header p {
            margin: 0;
            color: var(--c-muted);
            font-size: 12px;
        }


        /* =====================================================
           BUTTONS
        ====================================================== */

        .carnate-btn {
            min-height: 40px;
            padding: 9px 15px;
            border-radius: 8px;
            border: 1px solid transparent;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            font-size: 13px;
            font-weight: 650;
            transition: .18s ease;
            cursor: pointer;
        }

        .carnate-btn-primary {
            background: var(--c-red);
            border-color: var(--c-red);
            color: #fff;
            box-shadow: 0 4px 12px rgba(229, 57, 53, .15);
        }

        .carnate-btn-primary:hover {
            background: var(--c-red-dark);
            border-color: var(--c-red-dark);
            color: #fff;
            transform: translateY(-1px);
        }

        .carnate-btn-outline {
            background: #fff;
            border-color: var(--c-border);
            color: #475569;
        }

        .carnate-btn-outline:hover {
            background: #f8fafc;
            color: var(--c-text);
            border-color: #cbd5e1;
        }

        .carnate-btn-light {
            background: #f1f5f9;
            border-color: #f1f5f9;
            color: #475569;
        }

        .carnate-btn-light:hover {
            background: #e2e8f0;
        }


        /* =====================================================
           SEARCH
        ====================================================== */

        .carnate-search-card {
            background: #fff;
            border: 1px solid var(--c-border);
            border-radius: 12px;
            padding: 12px;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 2px 8px rgba(15, 23, 42, .025);
        }

        .carnate-search {
            flex: 1;
            height: 42px;
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 0 13px;
            background: #f8fafc;
            border: 1px solid var(--c-border);
            border-radius: 9px;
            transition: .18s ease;
        }

        .carnate-search:focus-within {
            background: #fff;
            border-color: rgba(229, 57, 53, .4);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .06);
        }

        .carnate-search i {
            color: #94a3b8;
            font-size: 19px;
        }

        .carnate-search input {
            width: 100%;
            height: 100%;
            border: 0;
            outline: 0;
            background: transparent;
            color: var(--c-text);
            font-size: 13px;
            box-shadow: none;
        }

        .carnate-search input::placeholder {
            color: #94a3b8;
        }


        /* =====================================================
           TABLE CARD
        ====================================================== */

        .carnate-table-card {
            background: #fff;
            border: 1px solid var(--c-border);
            border-radius: 13px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(15, 23, 42, .025);
        }

        .carnate-table-header {
            min-height: 68px;
            padding: 14px 18px;
            border-bottom: 1px solid var(--c-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .carnate-table-header h5 {
            margin: 0 0 3px;
            font-size: 15px;
            font-weight: 750;
            color: var(--c-text);
        }

        .carnate-table-header h5 i {
            color: var(--c-red);
            margin-right: 5px;
        }

        .carnate-table-header p {
            margin: 0;
            color: var(--c-muted);
            font-size: 11px;
        }

        .carnate-total-badge {
            padding: 7px 10px;
            border-radius: 8px;
            background: #f8fafc;
            border: 1px solid var(--c-border);
            color: #64748b;
            font-size: 11px;
            font-weight: 650;
            white-space: nowrap;
        }


        /* =====================================================
           TABLE
        ====================================================== */

        .carnate-table {
            width: 100%;
            min-width: 1250px;
            border-collapse: separate;
            border-spacing: 0;
        }

        .carnate-table thead th {
            background: #f8fafc;
            color: #64748b;
            border-bottom: 1px solid var(--c-border);
            padding: 11px 13px;
            font-size: 10px;
            font-weight: 750;
            letter-spacing: .45px;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .carnate-table tbody td {
            padding: 12px 13px;
            border-bottom: 1px solid #edf1f5;
            color: var(--c-text);
            font-size: 12px;
            vertical-align: middle;
        }

        .carnate-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .carnate-table tbody tr:hover {
            background: #fafafa;
        }

        .serial-number {
            color: #94a3b8 !important;
            font-weight: 650;
            width: 55px;
        }

        .action-column {
            width: 90px;
        }


        /* =====================================================
           PRODUCT IMAGE
        ====================================================== */

        .product-image {
            width: 46px;
            height: 46px;
            border-radius: 9px;
            overflow: hidden;
            background: #f8fafc;
            border: 1px solid var(--c-border);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }


        /* =====================================================
           PRODUCT INFO
        ====================================================== */

        .product-name {
            font-weight: 700;
            color: #1e293b;
            white-space: nowrap;
        }

        .table-muted {
            color: #64748b;
        }

        .part-number {
            color: #475569;
            font-family: monospace;
            font-size: 11px;
        }


        /* =====================================================
           BADGES
        ====================================================== */

        .unit-badge {
            display: inline-flex;
            padding: 4px 8px;
            border-radius: 6px;
            background: #f1f5f9;
            color: #475569;
            font-size: 10px;
            font-weight: 650;
        }

        .tax-badge {
            display: inline-flex;
            padding: 4px 7px;
            border-radius: 6px;
            background: #f8fafc;
            border: 1px solid var(--c-border);
            color: #64748b;
            font-size: 10px;
            font-weight: 650;
            white-space: nowrap;
        }

        .stock-badge {
            display: inline-flex;
            min-width: 28px;
            justify-content: center;
            padding: 4px 7px;
            border-radius: 6px;
            background: #f1f5f9;
            color: #334155;
            font-weight: 700;
            font-size: 11px;
        }

        .price {
            color: #1e293b;
            font-weight: 700;
            white-space: nowrap;
        }


        /* =====================================================
           TABLE ACTIONS
        ====================================================== */

        .table-actions {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .table-action {
            width: 32px;
            height: 32px;
            padding: 0;
            border: 1px solid var(--c-border);
            border-radius: 7px;
            background: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            cursor: pointer;
            transition: .16s ease;
        }

        .table-action.edit {
            color: #64748b;
        }

        .table-action.edit:hover {
            color: var(--c-red);
            background: var(--c-red-soft);
            border-color: rgba(229, 57, 53, .25);
        }

        .table-action.delete {
            color: #94a3b8;
        }

        .table-action.delete:hover {
            color: #dc2626;
            background: #fef2f2;
            border-color: #fecaca;
        }


        /* =====================================================
           PAGINATION
        ====================================================== */

        .carnate-pagination {
            padding: 13px 17px;
            background: #fafbfc;
            border-top: 1px solid var(--c-border);
            overflow-x: auto;
        }


        /* =====================================================
           EMPTY
        ====================================================== */

        .carnate-empty {
            padding: 65px 20px;
            text-align: center;
        }

        .carnate-empty-icon {
            width: 70px;
            height: 70px;
            margin: 0 auto 16px;
            border-radius: 17px;
            background: #f8fafc;
            border: 1px solid var(--c-border);
            color: #94a3b8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 34px;
        }

        .carnate-empty h5 {
            margin: 0 0 6px;
            color: #334155;
            font-size: 16px;
            font-weight: 750;
        }

        .carnate-empty p {
            max-width: 420px;
            margin: 0 auto 16px;
            color: var(--c-muted);
            font-size: 12px;
            line-height: 1.6;
        }


        /* =====================================================
           MODAL
        ====================================================== */

        .carnate-modal {
            border: 0 !important;
            border-radius: 14px !important;
            overflow: hidden;
            box-shadow: 0 25px 70px rgba(15, 23, 42, .22);
        }

        .carnate-modal-header {
            padding: 17px 20px;
            background: #fff;
            border-bottom: 1px solid var(--c-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .carnate-modal-title {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .carnate-modal-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: var(--c-red-soft);
            color: var(--c-red);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }

        .carnate-modal-title h4 {
            margin: 0 0 2px;
            color: var(--c-text);
            font-size: 16px;
            font-weight: 750;
        }

        .carnate-modal-title p {
            margin: 0;
            color: var(--c-muted);
            font-size: 11px;
        }

        .carnate-close {
            width: 34px;
            height: 34px;
            border: 1px solid var(--c-border);
            border-radius: 8px;
            background: #fff;
            color: #64748b;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            cursor: pointer;
        }

        .carnate-close:hover {
            background: var(--c-red-soft);
            color: var(--c-red);
            border-color: rgba(229, 57, 53, .2);
        }

        .carnate-modal-body {
            padding: 21px 20px;
            background: #fff;
            max-height: calc(100vh - 190px);
            overflow-y: auto;
        }

        .carnate-modal-footer {
            padding: 13px 20px;
            background: #fafbfc;
            border-top: 1px solid var(--c-border);
            display: flex;
            justify-content: flex-end;
            gap: 8px;
        }


        /* =====================================================
           FORM FIELDS
        ====================================================== */

        .carnate-field {
            margin-bottom: 2px;
        }

        .carnate-field > label {
            display: block;
            margin-bottom: 7px;
            color: #334155;
            font-size: 12px;
            font-weight: 700;
        }

        .carnate-field > label span:not(.carnate-auto-label) {
            color: var(--c-red);
        }

        .carnate-input-wrap {
            min-height: 43px;
            width: 100%;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 0 11px;
            background: #fff;
            border: 1px solid var(--c-border);
            border-radius: 8px;
            transition: .18s ease;
        }

        .carnate-input-wrap:focus-within {
            border-color: rgba(229, 57, 53, .4);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .06);
        }

        .carnate-input-wrap > i {
            color: #94a3b8;
            font-size: 17px;
            flex-shrink: 0;
        }

        .carnate-input-wrap input,
        .carnate-input-wrap select {
            width: 100%;
            min-width: 0;
            border: 0 !important;
            outline: 0 !important;
            box-shadow: none !important;
            background: transparent;
            color: var(--c-text);
            font-size: 13px;
        }

        .carnate-input-wrap select {
            padding-left: 0;
        }

        .carnate-input-wrap input::placeholder {
            color: #94a3b8;
        }

        .carnate-readonly {
            background: #f8fafc;
        }

        .carnate-currency {
            color: #64748b;
            font-size: 13px;
            font-weight: 700;
        }

        .carnate-input-suffix {
            color: #64748b;
            font-size: 12px;
            font-weight: 700;
        }

        .carnate-auto-label {
            display: inline-block;
            margin-left: 5px;
            padding: 2px 5px;
            border-radius: 4px;
            background: #f1f5f9;
            color: #64748b !important;
            font-size: 8px;
            font-weight: 750;
            vertical-align: middle;
        }

        .carnate-error {
            display: block;
            margin-top: 5px;
            color: #dc2626;
            font-size: 11px;
            font-weight: 600;
        }

        .carnate-loading-text {
            margin-top: 5px;
            color: #64748b;
            font-size: 10px;
        }


        /* =====================================================
           NAME FIELD
        ====================================================== */

        .carnate-name-row {
            display: flex;
            gap: 7px;
        }

        .carnate-select-wrap {
            flex: 1;
            min-width: 0;
            height: 43px;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 0 11px;
            border: 1px solid var(--c-border);
            border-radius: 8px;
            background: #fff;
        }

        .carnate-select-wrap > i {
            color: #94a3b8;
            font-size: 17px;
        }

        .carnate-select-wrap select {
            width: 100%;
            border: 0 !important;
            outline: 0 !important;
            box-shadow: none !important;
            font-size: 13px;
            background: transparent;
        }

        .carnate-add-small {
            width: 43px;
            height: 43px;
            border: 1px solid var(--c-border);
            border-radius: 8px;
            background: #fff;
            color: var(--c-red);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            cursor: pointer;
            transition: .16s ease;
            flex-shrink: 0;
        }

        .carnate-add-small:hover {
            background: var(--c-red-soft);
            border-color: rgba(229, 57, 53, .25);
        }


        /* =====================================================
           DISCOUNT
        ====================================================== */

        .carnate-discount-wrap {
            height: 43px;
            display: flex;
            border: 1px solid var(--c-border);
            border-radius: 8px;
            overflow: hidden;
            background: #fff;
        }

        .carnate-discount-wrap:focus-within {
            border-color: rgba(229, 57, 53, .4);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .06);
        }

        .carnate-discount-wrap input {
            flex: 1;
            min-width: 0;
            border: 0 !important;
            outline: 0 !important;
            box-shadow: none !important;
            padding: 0 11px;
            font-size: 13px;
        }

        .carnate-discount-wrap select {
            width: 65px;
            border: 0;
            border-left: 1px solid var(--c-border);
            outline: 0;
            background: #f8fafc;
            color: #475569;
            font-size: 12px;
            font-weight: 700;
        }


        /* =====================================================
           IMAGE
        ====================================================== */

        .carnate-image-section {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 100px;
            gap: 15px;
            align-items: end;
            padding: 14px;
            background: #f8fafc;
            border: 1px solid #edf1f5;
            border-radius: 10px;
        }

        .carnate-image-upload label {
            display: block;
            margin-bottom: 7px;
            color: #334155;
            font-size: 12px;
            font-weight: 700;
        }

        .carnate-image-upload .form-control {
            border: 1px solid var(--c-border);
            border-radius: 8px;
            font-size: 12px;
            background: #fff;
        }

        .carnate-image-preview {
            width: 90px;
            height: 90px;
            border: 1px solid var(--c-border);
            border-radius: 10px;
            background: #fff;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .carnate-image-preview img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .carnate-no-image {
            color: #cbd5e1;
            font-size: 30px;
        }


        /* =====================================================
           ALL VEHICLES
        ====================================================== */

        .carnate-all-vehicles {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 13px;
            background: #f8fafc;
            border: 1px solid var(--c-border);
            border-radius: 9px;
        }

        .carnate-all-vehicles .form-check-input {
            margin: 0;
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: var(--c-red);
        }

        .carnate-all-vehicles label {
            display: block;
            margin: 0 0 2px;
            color: #334155;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
        }

        .carnate-all-vehicles p {
            margin: 0;
            color: var(--c-muted);
            font-size: 10px;
        }


        /* =====================================================
           VEHICLE SECTION
        ====================================================== */

        .carnate-vehicle-section {
            padding: 15px;
            background: #fafbfc;
            border: 1px solid var(--c-border);
            border-radius: 10px;
        }

        .carnate-section-title {
            display: flex;
            align-items: center;
            gap: 9px;
            margin-bottom: 13px;
        }

        .carnate-section-icon {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            background: var(--c-icon);
            color: #64748b;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
        }

        .carnate-section-title h6 {
            margin: 0 0 2px;
            color: #334155;
            font-size: 12px;
            font-weight: 750;
        }

        .carnate-section-title p {
            margin: 0;
            color: var(--c-muted);
            font-size: 10px;
        }

        .carnate-vehicle-selector {
            background: #fff;
            border-radius: 8px;
        }


        /* =====================================================
           MULTI SELECT
        ====================================================== */

        .carnate-multi-select {
            min-height: 43px;
        }


        /* =====================================================
           SELECTED VEHICLES
        ====================================================== */

        .carnate-selected-section {
            padding: 14px;
            background: #f8fafc;
            border: 1px solid #edf1f5;
            border-radius: 9px;
        }

        .carnate-selected-title {
            margin-bottom: 10px;
            color: #334155;
            font-size: 12px;
            font-weight: 750;
        }

        .carnate-selected-title span {
            display: inline-flex;
            min-width: 20px;
            height: 20px;
            align-items: center;
            justify-content: center;
            margin-left: 4px;
            padding: 0 5px;
            border-radius: 10px;
            background: #e2e8f0;
            color: #475569;
            font-size: 10px;
        }

        .carnate-selected-list {
            display: flex;
            flex-wrap: wrap;
            gap: 7px;
        }

        .carnate-no-selection {
            color: #94a3b8;
            font-size: 11px;
        }

        .carnate-vehicle-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            max-width: 100%;
            padding: 7px 9px;
            border: 1px solid var(--c-border);
            border-radius: 7px;
            background: #fff;
            color: #475569;
            font-size: 10px;
        }

        .carnate-vehicle-badge > span {
            word-break: break-word;
        }

        .carnate-vehicle-badge button {
            width: 20px;
            height: 20px;
            padding: 0;
            border: 0;
            border-radius: 5px;
            background: #f1f5f9;
            color: #64748b;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .carnate-vehicle-badge button:hover {
            background: #fef2f2;
            color: #dc2626;
        }


        /* =====================================================
           TEXTAREA
        ====================================================== */

        .carnate-textarea {
            width: 100%;
            min-height: 90px;
            padding: 11px 12px;
            border: 1px solid var(--c-border);
            border-radius: 8px;
            resize: vertical;
            outline: 0;
            color: var(--c-text);
            font-size: 13px;
            transition: .18s ease;
        }

        .carnate-textarea:focus {
            border-color: rgba(229, 57, 53, .4);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .06);
        }

        .carnate-textarea::placeholder {
            color: #94a3b8;
        }


        /* =====================================================
           RESPONSIVE
        ====================================================== */

        @media (max-width: 767px) {

            .carnate-page-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .carnate-page-header .carnate-btn {
                width: 100%;
            }

            .carnate-search-card {
                flex-direction: column;
                align-items: stretch;
            }

            .carnate-search-card .carnate-btn {
                width: 100%;
            }

            .carnate-modal {
                margin: 10px;
            }

            .carnate-modal-body {
                max-height: calc(100vh - 170px);
            }

            .carnate-image-section {
                grid-template-columns: 1fr;
            }

            .carnate-image-preview {
                margin: 0 auto;
            }

        }


        @media (max-width: 480px) {

            .carnate-page-header h2 {
                font-size: 19px;
            }

            .carnate-page-icon {
                width: 42px;
                height: 42px;
                font-size: 22px;
            }

        }

    </style>


    {{-- =========================================================
        EXISTING SELECT2 / LIVEWIRE SCRIPT
        Kept INSIDE the single root element
    ========================================================== --}}
    @section('footerscript')

        <script>

            document.addEventListener('livewire:init', () => {

                initialize();

                Livewire.hook('morphed', (message, component) => {
                    initialize();
                });

            });


            function initialize() {

                $('#unit').select2({
                    placeholder: "Select Unit"
                }).on('change', function() {

                    @this.set('unit', $(this).val());

                });

            }

        </script>

    @endsection

</div>