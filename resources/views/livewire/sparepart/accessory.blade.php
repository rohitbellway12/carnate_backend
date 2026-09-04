<div>
    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    @php
        $sparePart = App\Models\SparePartVendor::where('id', $sparepartId)->first();
    @endphp

    <!-- Add/Edit Modal -->

    <div class="modal @if ($showModal) show @endif" tabindex="-1"
        style="opacity:1; background-color:#0606068c; display:@if ($showModal) block @endif">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ $isEdit ? 'Edit  Accessory' : 'Create Accessory' }}</h4>
                        <button type="button" class="btn-close" wire:click="$set('showModal', false)"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body py-3">
                        @csrf

                        <div class="row g-3">




                            <!-- Name -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Name<sup class="text-danger">*</sup></label>
                                    <div class="row">
                                        <div class="col-10 pe-0">
                                            <select class="form-select" wire:model="name" id="name">
                                                <option value="">Select a Name or Add New One</option>
                                                @foreach ($sparePartLabels as $sparePartLabel)
                                                    <option value="{{ $sparePartLabel->title }}">
                                                        {{ $sparePartLabel->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-2 p-0">
                                            <button type="button"
                                                class="btn btn-outline-secondary text-light bg-primary fl margin-left-0"
                                                wire:click="addAccessoryLabel">
                                                {{ trans('+') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                @error('name')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- supplier -->
                            <div>
                                <label class="form-label">Supplier</label>
                                <select class="form-select searchable-select" data-placeholder="Select Supplier"
                                    wire:model="supplier_id">
                                    <option value="">Select Supplier</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->owner_first_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Brand -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Brand</label>
                                    <input type="text" wire:model="brand" class="form-control"
                                        placeholder="Enter Brand">
                                </div>
                                @error('brand')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Part Number -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Part Number</label>
                                    <input type="text" wire:model="part_number" class="form-control"
                                        placeholder="Enter Part Number">
                                    <div wire:loading wire:target="part_number">
                                        <span class="spinner-border spinner-border-sm" role="status"
                                            aria-hidden="true"></span>
                                        Fetching details...
                                    </div>
                                </div>

                                @error('part_number')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Purchase Price -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Purchase Price<sup class="text-danger">*</sup></label>
                                    <input type="number" wire:model.live="purchase_amount" id="purchase_amount"
                                        class="form-control" placeholder="Enter Purchase Price">
                                </div>
                                @error('purchase_amount')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Selling Price -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Selling Price<sup class="text-danger">*</sup></label>
                                    <input type="number" wire:model.live="selling_amount" id="selling_amount"
                                        class="form-control" placeholder="Enter Selling Price">
                                </div>
                                @error('selling_amount')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Tax Type</label>
                                    <select id="tax_type" class="form-select" wire:model.live="tax_type"
                                        id="tax_type">
                                        <option value="">Select Tax Type</option>
                                        <option value="include">Include All Taxes</option>
                                        <option value="exclude">Exclude All Taxes</option>
                                    </select>
                                    @error('tax_type')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Percentage Input Section (Shown based on selection) -->
                            @if ($tax_type == 'include' || $tax_type == 'exclude')
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">
                                            {{ $tax_type == 'include' ? 'Include Tax Percentage' : 'Exclude Tax Percentage' }}
                                        </label>
                                        <div class="input-group">
                                            <input type="number" wire:model.live="tax_percentage" class="form-control"
                                                placeholder="Enter Percentage" id="tax_percentage">
                                            <span class="input-group-text">%</span>
                                        </div>
                                        @error('tax_percentage')
                                            <span class="text-danger error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Online Discount</label>
                                    <div class="input-group">
                                        <input type="number" wire:model.live="discount" class="form-control"
                                            placeholder="Enter Discount">
                                        <select id="discount_type" class="form-select"
                                            wire:model.live="discount_type" style="max-width: 80px;">
                                            <option value="1">₹</option>
                                            <option value="2">%</option>
                                        </select>
                                    </div>
                                    @error('discount')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                    @error('discount_type')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Unit -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Unit<sup class="text-danger">*</sup></label>
                                    <select id="unit" class="form-select" wire:model="unit">
                                        <option value="">Select Unit</option>
                                        @foreach ($units as $unit)
                                            <option value="{{ $unit->id }}">{{ $unit->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('unit')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Stock -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Stock<sup class="text-danger">*</sup></label>
                                    <input type="number" wire:model="stock" class="form-control" id="stock"
                                        placeholder="Enter Stock">
                                </div>
                                @error('stock')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">HSN Code</label>
                                    <input type="text" wire:model="hsn_code" class="form-control" id="hsn_code"
                                        placeholder="Enter HSN Code">
                                </div>
                                @error('hsn_code')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Rack No.</label>
                                    <input type="text" wire:model="rack_no" class="form-control" id="rack_no"
                                        placeholder="Enter Rack No.">
                                </div>
                                @error('rack_no')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Category -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Category<sup class="text-danger">*</sup></label>
                                    <select class="form-select searchable-select" data-placeholder="Select Category"
                                        wire:model="category" id="category">
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



                            {{-- <div class="col-sm-12">
                                <div class="form-group mt-2 mb-0">
                                    <label class="form-label">Image</label>
                                    <div>
                                        <livewire:image-uploader :unique-id="'image_id'" :preview="$imageId ? asset($imageId) : null"
                                            wire:listen="imageUploaded" />

                                        @if ($imageId)
                                            <div class="image-preview mt-4">
                                                <img src="{{ asset($imageId) }}" alt="Image Preview" height="100px"
                                                    width="100px">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div> --}}

                            <div class="row align-items-center">
                                <div class="col-10 mt-3">
                                    <div class="form-group">
                                        <label class="form-label"> Image</label>
                                        <input type="file" class="form-control" wire:model="image" />
                                    </div>
                                </div>
                                <div class="col-2 mt-3">
                                    @if ($part_image_url)
                                        <img class="img-fluid mt-4 w-75" src="{{ $part_image_url }}">
                                    @elseif (!empty($imageName))
                                        <img class="img-fluid mt-4 w-75" src="{{ asset($imageName) }}">
                                    @else
                                        @if ($isEdit)
                                            <img class="img-fluid mt-4 w-75" src="{{ asset($imageImage) }}">
                                        @endif
                                    @endif
                                </div>
                                @error('image')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>



                            {{-- </div>
                                                @endforeach
                                            </div>
                                        @elseif (!empty($modifications))
                                            <div class="row">
                                                @foreach ($modifications as $modification)
                                                    @if (empty($brandFilter) || stripos($modification->brand_name, $brandFilter) !== false)
                                                        <div class="col-md-6 mb-2">
                                                            <div class="form-check vehicle-item p-2 border-bottom">
                                                                <input class="form-check-input"
                                                                    type="checkbox"
                                                                    value="{{ $modification->id }}"
                                                                    wire:model="suitable_for"
                                                                    id="modification_{{ $modification->id }}">
                                                                <label class="form-check-label" for="modification_{{ $modification->id }}">
                                                                    <strong>{{ $modification->brand_name }} {{ $modification->variant_name }}</strong><br>
                                                                    <small class="text-muted">
                                                                        {{ $modification->year }} {{ $modification->title }}
                                                                    </small>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="text-center text-muted">
                                                <p>No compatible vehicles found</p>
                                            </div>
                                        @endif
                                    </div>
                                    <small class="text-info">All vehicles in this list will be automatically saved as compatible vehicles.</small>
                                </div>
                            </div>  --}}



                            <!-- Description -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Description</label>
                                    <textarea wire:model="description" class="form-control" placeholder="Enter Description"></textarea>
                                </div>
                                @error('description')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Compatible Vehicles Section (placed after description) -->
                            <div class="col-md-12 mt-3">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" wire:model="forAllVehicles"
                                        id="forAllVehicles">
                                    <label class="form-check-label" for="forAllVehicles">
                                        For All Vehicles
                                    </label>
                                </div>
                            </div>

                            @if (!$forAllVehicles)
                                <!-- 1. Add Vehicle from Vehicle Selector -->
                                <div class="col-md-12 border-bottom pb-3 mb-3">
                                    @livewire('workshop.vehicle-selector')
                                </div>

                                <!-- 2. Or Select from Existing Saved Vehicles -->
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
                                        @if (empty($suitable_for))
                                            <span class="text-muted font-12">No vehicles selected yet.</span>
                                        @else
                                            @foreach ($suitable_for as $index => $modId)
                                                @php
                                                    $localMod = $modifications->firstWhere('id', $modId);
                                                @endphp
                                                @if ($localMod)
                                                    <span
                                                        class="badge bg-secondary p-2 d-inline-flex align-items-center gap-2"
                                                        style="font-size: 12px; border-radius: 4px;">
                                                        {{ $localMod->brand_name }} {{ $localMod->variant_name }}
                                                        ({{ $localMod->year }}) - {{ $localMod->title }}
                                                        <button type="button" class="btn-close btn-close-white ms-1"
                                                            style="font-size: 0.55rem; padding: 0; margin: 0; width: 0.55rem; height: 0.55rem;"
                                                            wire:click="removeCompatibleVehicle({{ $index }})"></button>
                                                    </span>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            @endif




                            <div class="col-12">
                                <span class="text-danger">A <strong>{{ $commission }}%</strong> commission will be
                                    deducted from product price at withdrawal for platform services.</span>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="$set('showModal', false)"
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



    <div class="modal @if ($showAccessoryModel) show @endif" tabindex="-1"
        style="opacity:1; background-color:#0606068c; display:@if ($showAccessoryModel) block @endif">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form wire:submit.prevent="accessoryLabelStore">
                    <div class="modal-header">
                        <h4 class="modal-title">Create Accessory</h4>
                        <button type="button" class="btn-close" wire:click="$set('showAccessoryModel', false)"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body py-3">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Accessory Label</label>
                                    <input type="text" wire:model="accessory_label" class="form-control"
                                        placeholder="Enter Accessory Label">
                                </div>
                                @error('accessory_label')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            wire:click="$set('showAccessoryModel', false)" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            {{ $isEdit ? 'Update' : 'Create' }}
                            <i class="spinner-border spinner-border-sm" wire:loading></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <div class="card">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div class="breadcrumb-title pe-2" style="border: none;">Accessory</div>
            @if (@$sparePart->hasPermissionTo('accessory-add'))
                <div class="pe-3">
                    <a href="javascript:;" wire:click="create" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i
                            class="bx bxs-plus-square"></i>Add</a>
                </div>
            @endif
        </div>
    </div>
    <div class="card mt-4">
        <div class="card-body">
            <div class="row">
                <div class="col-3">
                    <input type="text" class="form-control" placeholder="Search ..."
                        wire:model.live="searchfilter" fdprocessedid="blgf5">
                </div>
                <div class="col-9 text-right">
                    <button type="button" class="mr-2 btn btn-info text-white rounded-0  float-end"
                        wire:click="resetFilter" fdprocessedid="orntg">Clear</button>
                </div>
            </div>

        </div>
    </div>
    <div class="card mt-4">
        @if (!empty($accessories) && $accessories->count())
            <div class="card-body ">
                <div class="table-responsive">
                    <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Supplier</th>
                                <th>Part Number</th>
                                <th>Unit</th>
                                <th>Brand</th>
                                {{-- <th>Suitable For</th> --}}
                                <th>Online Price</th>
                                <th>Offline Price</th>
                                <th>Commission %</th>
                                <th>Tax</th>
                                <th>HSN Code</th>
                                <th>Rack No.</th>
                                @if (@$sparePart->hasPermissionTo('accessory-edit') || @$sparePart->hasPermissionTo('accessory-delete'))
                                    <th>Actions</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($accessories as $index => $accessory)
                                <tr>
                                    <td>{{ $accessories->total() - ($accessories->firstItem() + $index) + 1 }}</td>
                                    <td>
                                        @if (!empty($accessory->Image->file))
                                            <img src="{{ asset($accessory->Image->file) }}" alt="accessory image"
                                                height="50px" width="50px">
                                        @else
                                            <img src="{{ asset('img/accessory.png') }}" alt="accessory image"
                                                height="50px" width="50px">
                                        @endif
                                    </td>
                                    <td>{{ $accessory->name }}</td>
                                    <td>{{ $accessory->supplier?->owner_first_name ?? '-' }}</td>
                                    <td>{{ $accessory->part_number }}</td>
                                    <td>{{ $accessory->unit?->title ?? '' }}</td>
                                    <td> {{ $accessory->brand }} </td>
                                    {{-- <td> {{ $accessory->suitable_for }} </td> --}}
                                    <td>
                                        @php
                                            $onlinePrice = $accessory->selling_amount;
                                            if ($accessory->tax_type == 'exclude' && $accessory->tax_percentage) {
                                                $onlinePrice += ($onlinePrice * $accessory->tax_percentage) / 100;
                                            }
                                            if ($accessory->discount) {
                                                if ($accessory->discount_type == 1) {
                                                    $onlinePrice -= $accessory->discount;
                                                } elseif ($accessory->discount_type == 2) {
                                                    $onlinePrice -= ($onlinePrice * $accessory->discount) / 100;
                                                }
                                            }
                                            echo number_format($onlinePrice, 2);
                                        @endphp
                                    </td>
                                    <td>
                                        @php
                                            $offlinePrice = $accessory->selling_amount;
                                            if ($accessory->tax_type == 'exclude' && $accessory->tax_percentage) {
                                                $offlinePrice += ($offlinePrice * $accessory->tax_percentage) / 100;
                                            }
                                            echo number_format($offlinePrice, 2);
                                        @endphp
                                    </td>
                                    <td> {{ $accessory->platform_charge ?? 0 }}% </td>
                                    <td>
                                        @if ($accessory->tax_percentage)
                                            {{ $accessory->tax_type == 'include' ? 'Include' : 'Exclude' }} {{ $accessory->tax_percentage }}%
                                        @else
                                            —
                                        @endif
                                    </td>
                                    <td> {{ $accessory->stock }} </td>
                                    <td> {{ $accessory->hsn_code }} </td>
                                    <td> {{ $accessory->rack_no }} </td>
                                    @if (@$sparePart->hasPermissionTo('accessory-edit') || @$sparePart->hasPermissionTo('accessory-delete'))
                                        <td>
                                            @if (@$sparePart->hasPermissionTo('accessory-edit'))
                                                <a wire:click="edit({{ $accessory->id }})" class="btn btn-sm p-0"><i
                                                        class="bx bxs-edit"></i> <span class="small"></span></a>
                                            @endif
                                            @if (@$sparePart->hasPermissionTo('accessory-delete'))
                                                <a wire:click="confirmDelete({{ $accessory->id }})"
                                                    class="btn btn-sm p-0"><i class="fadeIn animated bx bx-trash"></i>
                                                    <span class="small"></span></a>
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="pagination-wrapper">
                        {{ $accessories->links() }}
                    </div>
                </div>
            </div>
        @else
            <div class="my-2">
                <div class="alert alert-info">No Accessory found!</div>
            </div>
        @endif
    </div>

</div>


@section('footerscript')
    <script>
        document.addEventListener('livewire:init', function() {
            // Re-initialize select2 when modal opens
            Livewire.hook('morphed', () => {
                window.initSearchableSelects();
            });
        });
    </script>
@endsection
