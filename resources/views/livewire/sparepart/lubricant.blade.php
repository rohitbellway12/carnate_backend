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
                        <h4 class="modal-title">{{ $isEdit ? 'Edit Lubricant' : 'Create Lubricant' }}</h4>
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
                                            <input type="text" wire:model="name" class="form-control"
                                                placeholder="Enter Name or use Part No. to fetch">
                                        </div>
                                        <div class="col-2 p-0">
                                            <button type="button"
                                                class="btn btn-outline-secondary text-light bg-primary fl margin-left-0"
                                                wire:click="addLubricantLabel">
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
                                <select class="form-select searchable-select" data-placeholder="Select Supplier" wire:model="supplier_id">
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
                                    <input type="text" wire:model="part_number"
                                        class="form-control" placeholder="Enter Part Number">
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
                                    <input type="number" wire:model.live="purchase_amount" class="form-control"
                                        placeholder="Enter Purchase Price">
                                </div>
                                @error('purchase_amount')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Selling Price -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Selling Price<sup class="text-danger">*</sup></label>
                                    <input type="number" wire:model.live="selling_amount" class="form-control"
                                        placeholder="Enter Selling Price">
                                </div>
                                @error('selling_amount')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Tax Type</label>
                                    <select id="tax_type" class="form-select" wire:model.live="tax_type">
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
                                                placeholder="Enter Percentage">
                                            <span class="input-group-text">%</span>
                                        </div>
                                        @error('tax_percentage')
                                            <span class="text-danger error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endif

                            <!-- Discount -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Online Discount</label>
                                    <div class="input-group">
                                        <input type="number" wire:model.live="discount" class="form-control"
                                            placeholder="Enter Discount">
                                        <select id="discount_type" class="form-select" wire:model.live="discount_type"
                                            style="max-width: 80px;">
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

                           {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">You Will Receive (after {{ $commission }}%
                                        deduction)</label>
                                    <input type="text" wire:model="reflectedPrice" class="form-control bg-light"
                                        readonly>
                                </div>
                                @error('reflectedPrice')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Customer Price (after {{ $commission }}%
                                        added)</label>
                                    <input type="text" wire:model="customerPrice" class="form-control bg-light"
                                        readonly>
                                </div>
                                @error('customerPrice')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div> --}}

                            <!-- Unit -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Unit<sup class="text-danger">*</sup></label>
                                    <select class="form-select" wire:model="unit">
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

                            <!-- Category -->

                           {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Category<sup class="text-danger">*</sup></label>
                                    <select class="form-select" wire:model="category">
                                        <option value="">Select Unit</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('category')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>--}}



                            <!-- Suitable For -->
                            {{-- <div class="col-md-6">
                                 <div class="form-group">
                                     <label class="form-label">Suitable For</label>
                                     <input type="text" wire:model="suitable_for" class="form-control"
                                         placeholder="Enter Suitable For">
                                 </div>
                                 @error('suitable_for')
                                     <span class="text-danger error">{{ $message }}</span>
                                 @enderror
                             </div> --}}

                            <!-- Discount -->
                            {{-- <div class="col-md-6">
                                 <div class="form-group">
                                     <label class="form-label">Discount</label>
                                     <input type="number" wire:model.live="discount" class="form-control"
                                         placeholder="Enter Discount">
                                 </div>
                                 @error('discount')
                                     <span class="text-danger error">{{ $message }}</span>
                                 @enderror
                             </div> --}}

                            <!-- Stock -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Stock<sup class="text-danger">*</sup></label>
                                    <input type="number" wire:model="stock" class="form-control"
                                        placeholder="Enter Stock">
                                </div>
                                @error('stock')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">HSN Code</label>
                                    <input type="text" wire:model="hsn_code" class="form-control">
                                </div>
                                @error('hsn_code')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Rack No.</label>
                                    <input type="text" wire:model="rack_no" class="form-control">
                                </div>
                                @error('rack_no')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                             <!-- Category -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Category<sup class="text-danger">*</sup></label>
                                    <select class="form-select searchable-select" data-placeholder="Select Category" wire:model="category" id="category">
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
                                     <livewire:image-uploader :unique-id="'image_id'" :preview="$imageId ? asset($imageId) : null"
                                         wire:listen="imageUploaded" />
                                         @if ($imagePreview)
                                         <div class="image-preview mt-4">
                                             <img src="{{ asset($imagePreview) }}" alt="Image Preview" height="100px" width="100px">
                                         </div>
                                     @endif
                                 </div>
                             </div> --}}

                            <div class="row align-items-center">
                                <div class="col-10 mt-3">
                                    <div class="form-group">
                                        <label class="form-label"> Image</label>
                                        <input type="file" class="form-control" wire:model="license_image" />
                                    </div>
                                </div>
                                <div class="col-2 mt-3">
                                    @if ($part_image_url)
                                        <img class="img-fluid mt-4 w-75" src="{{ $part_image_url }}">
                                    @elseif (!empty($licenseName))
                                        <img class="img-fluid mt-4 w-75" src="{{ asset($licenseName) }}">
                                    @else
                                        @if ($isEdit)
                                            <img class="img-fluid mt-4 w-75" src="{{ asset($licenseImage) }}">
                                        @endif
                                    @endif
                                </div>
                                @error('license_image')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                           {{--
                            <div>
                                @if (!empty($api_compatible_vehicles))
                                    <div class="col-md-12 mt-3">
                                        <label class="form-label">Compatible Vehicles<span class="text-danger">*</span></label>
                                        <select id="suitable_for" class="form-select" multiple wire:model="suitable_for">
                                            @foreach ($api_compatible_vehicles as $vehicle)
                                                <option value="{{ $vehicle['vehicleId'] }}">
                                                    {{ $vehicle['manufacturerName'] }} {{ $vehicle['modelName'] }}
                                                    {{ $vehicle['typeEngineName'] ? ' | ' . $vehicle['typeEngineName'] : '' }}
                                                    {{ $vehicle['fuelType'] ? ' | ' . $vehicle['fuelType'] : '' }}
                                                    {{ $vehicle['year'] ? ' | ' . $vehicle['year'] : '' }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('suitable_for')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endif

                                <div class="col-md-12 mt-3">
                                    <label class="form-label">Select Compatible Vehicles<span
                                            class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <input type="checkbox" wire:model.live="forAllVehicles" id="all_vehicles">
                                        <label for="all_vehicles">For All Vehicles</label>
                                    </div>
                                </div>

                                @if ($forAllVehicles)
                                    <div class="col-md-12 mt-3">
                                        <div class="form-group">
                                            <label for="">Selected Vehicle</label> <br>
                                            <p class="badge bg-danger ">All</p>
                                        </div>
                                    </div>
                                @else
                                    @if (empty($api_compatible_vehicles))
                                        <div class="col-md-12 mt-3">
                                            <div class="form-group">
                                                <select id="suitable_for" class="form-select" multiple wire:model="suitable_for">
                                                    @foreach ($modifications as $modification)
                                                        <option value="{{ $modification->id }}">
                                                            {{ $modification->brand_name }} {{ $modification->variant_name }} {{ $modification->year }} {{ $modification->title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('suitable_for')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif
                                @endif

                            </div>
                            --}}

                            <div class="col-md-12 mt-3">
                                <div class="form-group">
                                    <input type="text"
                                       {{-- wire:model.debounce.300ms="brandFilter"--}}
                                       wire:model.live="brandFilter"
                                        class="form-control mb-3"
                                        placeholder="Type brand name">

                                    <label class="form-label">Compatible Vehicles List<span class="text-danger">*</span></label>
                                    <div class="border rounded p-3" style="max-height: 300px; overflow-y: auto;">
                                        @if (!empty($api_compatible_vehicles))
                                            <div class="row">
                                                @foreach ($api_compatible_vehicles as $vehicle)
                                                    <div class="col-md-6 mb-2">
                                                        <div class="vehicle-item p-2 border-bottom">
                                                            <strong>{{ $vehicle['manufacturerName'] }} {{ $vehicle['modelName'] }}</strong><br>
                                                            <small class="text-muted">
                                                                {{ $vehicle['typeEngineName'] ? $vehicle['typeEngineName'] . ' | ' : '' }}
                                                                {{ $vehicle['fuelType'] ? $vehicle['fuelType'] . ' | ' : '' }}
                                                                {{ $vehicle['year'] ? $vehicle['year'] : '' }}
                                                            </small>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @elseif (!empty($modifications))
                                            <div class="row">
                                                @foreach ($modifications as $modification)
                                                 @if(empty($brandFilter) || stripos($modification->brand_name, $brandFilter) !== false)
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
                            </div>
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

                        </div>
                        <div class="col-12">
                            <span class="text-danger">A <strong>{{ $commission }}%</strong> commission will be
                                deducted from product price at withdrawal for platform services.</span>
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



    <div class="modal @if ($showLubricantModel) show @endif" tabindex="-1"
        style="opacity:1; background-color:#0606068c; display:@if ($showLubricantModel) block @endif">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form wire:submit.prevent="lubricantLabelStore">
                    <div class="modal-header">
                        <h4 class="modal-title">Create Lubricant</h4>
                        <button type="button" class="btn-close" wire:click="$set('showLubricantModel', false)"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body py-3">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Lubricant Label</label>
                                    <input type="text" wire:model="lubricant_label" class="form-control"
                                        placeholder="Enter Lunricant Label">
                                </div>
                                @error('lubricant_label')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            wire:click="$set('showLubricantModel', false)" data-bs-dismiss="modal">Cancel</button>
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
            <div class="breadcrumb-title pe-2" style="border: none;">Lubricants</div>
            @if (@$sparePart->hasPermissionTo('lubricant-add'))
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
                    <input type="text" class="form-control" placeholder="Search " wire:model.live="searchfilter"
                        fdprocessedid="blgf5">
                </div>
                <div class="col-9 text-right">
                    <button type="button" class="mr-2 btn btn-info text-white rounded-0  float-end"
                        wire:click="resetFilter" fdprocessedid="orntg">Clear</button>
                </div>
            </div>

        </div>
    </div>
    <div class="card mt-4">
        @if (!empty($lubricants) && $lubricants->count())
            <div class="card-body ">
                <div class="table-responsive">
                    <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Supplier</th>
                                <th>part Number</th>
                                <th>Unit</th>
                                <th>Brand</th>
                              {{--<th>Suitable For</th>--}}
                                <th>Price</th>
                                <th>Amount</th>
                                <th>Discount</th>
                                <th>Stock</th>
                                <th>HSN Code</th>
                                <th>Rack No.</th>
                                @if (@$sparePart->hasPermissionTo('lubricant-edit') || @$sparePart->hasPermissionTo('lubricant-delete'))
                                    <th>Actions</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lubricants as $index => $lubricant)
                                <tr>
                                    <td>{{ $lubricants->total() - ($lubricants->firstItem() + $index) + 1 }}</td>
                                    <td>
                                        @if (!empty($lubricant->Image->file))
                                            <img src="{{ asset($lubricant->Image->file) }}" alt="lubricant image"
                                                height="50px" width="50px">
                                        @else
                                            <img src="{{ asset('img/lubricant.jpg') }}" alt="lubricant image"
                                                height="50px" width="50px">
                                        @endif
                                    </td>
                                    <td>{{ $lubricant->name }}</td>
                                    <td>{{$lubricant->supplier?->owner_first_name ?? '-' }}</td>
                                    <td>{{ $lubricant->part_number }}</td>
                                    <td>{{ $lubricant->unit?->title ?? '' }}</td>
                                    <td> {{ $lubricant->brand }} </td>
                                   {{-- <td> {{ $lubricant->suitable_for }} </td>--}}
                                    <td> {{ $lubricant->price }} </td>
                                    <td> {{ $lubricant->amount }} </td>
                                    <td> {{ $lubricant->discount }} </td>
                                    <td> {{ $lubricant->stock }} </td>
                                    <td> {{ $lubricant->hsn_code }} </td>
                                    <td> {{ $lubricant->rack_no }} </td>
                                    @if (@$sparePart->hasPermissionTo('lubricant-edit') || @$sparePart->hasPermissionTo('lubricant-delete'))
                                        <td>
                                            @if (@$sparePart->hasPermissionTo('lubricant-edit'))
                                                <a wire:click="edit({{ $lubricant->id }})" class="btn btn-sm p-0"><i
                                                        class="bx bxs-edit"></i> <span class="small"></span></a>
                                            @endif
                                            @if (@$sparePart->hasPermissionTo('lubricant-delete'))
                                                <a wire:click="confirmDelete({{ $lubricant->id }})"
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
                        {{ $lubricants->links() }}
                    </div>
                </div>
            </div>
        @else
            <div class="my-2">
                <div class="alert alert-info">No Lubricant found!</div>
            </div>
        @endif
    </div>

</div>


@section('footerscript')
   <script>
        document.addEventListener('livewire:init', () => {
            // Initialize Select2
            initialize();

            // Re-initialize on DOM updates
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
