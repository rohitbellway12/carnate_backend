
<div>

    <div class="modal @if ($showSpariOartesModal) show @endif" tabindex="-1"
    style="opacity:1; background-color:#0606068c; display:@if ($showSpariOartesModal) block @endif">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form wire:submit.prevent="{{ $isEdit ? 'update' : 'storeSpareParts' }}">
                <div class="modal-header">
                    <h4 class="modal-title">{{ $isEdit ? 'Edit  Accessory' : 'Create SpareParts' }}</h4>
                    <button type="button" class="btn-close" wire:click="closeSpariOartesModal"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-3">
                    @csrf
                    <div class="row g-3">
                        <!-- Name -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Name<sup class="text-danger">*</sup></label>
                                <input type="text" wire:model="name" class="form-control" placeholder="Enter Name">
                            </div>
                            @error('name')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeSpariOartesModal"
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
         <form wire:submit.prevent="{{ $isAdd ? 'update' : 'store' }}">
            <div class="modal-header">
                <h4 class="modal-title">{{ $isAdd ? 'Update Stock' : 'Add Stock' }}</h4>
                <button type="button" class="btn-close" wire:click="modalClose"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
               <div class="modal-body py-3">
                <div class="row g-3">
                    @if(!$is_self_stock)
                        <!-- Online Product Summary (Read-only) -->
                        <div class="col-md-12">
                            <div class="card bg-light border-0 shadow-none mb-0">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-md-6 border-end">
                                            <small class="text-muted d-block mb-1">Product Name</small>
                                            <span class="fw-bold">{{ $sparePartLabels->find($name)->title ?? 'N/A' }}</span>
                                        </div>
                                        <div class="col-md-6 ps-md-4">
                                            <small class="text-muted d-block mb-1">Purchase Price</small>
                                            <span class="fw-bold text-success">Rs. {{ number_format($purchase_amount, 2) }}</span>
                                        </div>
                                    </div>
                                    <div class="row mt-3 border-top pt-2">
                                        <div class="col-md-3 border-end">
                                            <small class="text-muted d-block mb-1">HSN Code</small>
                                            <span class="fw-bold">{{ $hsn_code ?? '-' }}</span>
                                        </div>
                                        <div class="col-md-3 border-end ps-md-4">
                                            <small class="text-muted d-block mb-1">Unit</small>
                                            <span class="fw-bold">{{ $units->find($unit)->title ?? '-' }}</span>
                                        </div>
                                        <div class="col-md-3 border-end ps-md-4">
                                            <small class="text-muted d-block mb-1">Sub Category</small>
                                            <span class="fw-bold">{{ $categories->find($category)->title ?? '-' }}</span>
                                        </div>
                                        <div class="col-md-3 ps-md-4">
                                            <small class="text-muted d-block mb-1">Current Stock</small>
                                            <span class="fw-bold">{{ $stock ?? 0 }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($is_self_stock)
                        <div class="col-md-6 ">
                            <div class="form-group">
                                <label class="form-label">Category<sup class="text-danger">*</sup></label>
                                <select class="form-select"
                                    wire:model="category_id">
                                    <option value="" selected >-- Select Category --</option>
                                    <option value="1">Accessory</option>
                                    <option value="2">Part</option>
                                    <option value="3">Tool</option>
                                    <option value="4">Lubricant</option>
                                </select>
                            </div>
                            @error('category_id')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 ">
                            <div class="row align-items-end">
                                <div class="form-group col-10 pe-0">
                                    <label class="form-label">Name<sup class="text-danger">*</sup></label>
                                    <select class="form-select searchable-select"
                                        data-placeholder="Select Name"
                                        wire:model="name" wire:change="setdata">
                                        <option value="">Select Name</option>
                                        @foreach($sparePartLabels as $sparePartLabel)
                                            <option value="{{ $sparePartLabel->id }}">{{ $sparePartLabel->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-2 p-0">
                                    <button type="button" class="btn btn-outline-secondary text-light bg-primary fl margin-left-0" wire:click="addSparets" fdprocessedid="u8qc8n">
                                        +
                                    </button>
                                </div>
                            </div>
                            @error('name')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- suppolier -->
                        <div class="col-md-12">
                            <label class="form-label">Supplier</label>
                            <select class="form-select searchable-select " data-placeholder="Select Supplier" wire:model="supplier_id">
                                <option value="">Select Supplier</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->owner_first_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif


                    @if($is_self_stock)
                        <div class="row g-3">
                            <!-- Brand -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Brand<sup class="text-danger">*</sup></label>
                                    <input type="text" wire:model="brand" class="form-control" placeholder="Enter Brand">
                                </div>
                                @error('brand')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Part Number</label>
                                    <input type="text" min="1" wire:model="part_number" class="form-control"
                                        placeholder="Enter Part Number">
                                </div>
                                @error('part_number')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    @endif

                        <!-- Purchase Price -->
                        @if($is_self_stock)
                            <!-- Purchase Price -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Purchase Price<sup class="text-danger">*</sup></label>
                                    <input type="number" wire:model="purchase_amount" class="form-control"
                                        placeholder="Enter Purchase Price">
                                </div>
                                @error('purchase_amount')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif

                         <!-- Selling Price -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Selling Price<sup class="text-danger">*</sup></label>
                                <input type="number" wire:model.live="amount" class="form-control"
                                    placeholder="Enter Selling Price">
                            </div>
                            @error('amount')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Tax Type -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Tax Type<sup class="text-danger">*</sup></label>
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

                        <!-- Percentage Input Section -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">
                                    Tax Percentage (%)
                                </label>
                                <div class="input-group">
                                    <input type="number" wire:model.live="tax_percentage" class="form-control" placeholder="Enter Percentage">
                                    <span class="input-group-text">%</span>
                                </div>
                                @error('tax_percentage')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label fw-bold text-primary">Final Selling Price (Incl. Tax)</label>
                                <div class="form-control bg-light fw-bold border-primary text-primary">
                                    Rs. {{ number_format($this->finalPrice, 2) }}
                                </div>
                            </div>
                        </div>



                        @if($is_self_stock)
                        <!-- HSN Code -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">HSN Code</label>
                                <input type="text" wire:model="hsn_code" class="form-control"
                                    placeholder="Enter HSN Code">
                            </div>
                            @error('hsn_code')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                        @endif


                        @if($is_self_stock)
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
                        @endif

                        @if($is_self_stock)
                           <!-- Category -->
                           <div class="col-md-6">
                           <div class="form-group">
                               <label class="form-label">Sub Category<sup class="text-danger">*</sup></label>
                               <select class="form-select searchable-select" data-placeholder="Select Sub-Category" wire:model="category">
                                   <option value="">Select Category</option>
                                   @foreach ($categories as $category)
                                       <option value="{{ $category->id }}">{{ $category->title }}</option>
                                   @endforeach
                                </select>
                            </div>
                            @error('category')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                        @endif

                        @if($is_self_stock)
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sp_type" class="form-label"> SP Type </label>
                                    <select class="form-select" wire:model="sp_type">
                                        <option value="0">New</option>
                                        <option value="1">Used</option>
                                    </select>
                                    @error('stock_sp_type')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        @endif

                        @if($is_self_stock)
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Stock<sup class="text-danger">*</sup></label>
                                <input type="number" min="1" wire:model="stock" class="form-control"
                                    placeholder="Enter Stock">
                            </div>
                            @error('stock')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                        @endif


                    @if($is_self_stock)
                        <div>
                            <div class="col-md-12">
                                <label class="form-label">Compatible Vehicles<span
                                        class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="checkbox" wire:model.live="forAllVehicles" id="all_vehicles">
                                    <label for="all_vehicles">For All Vehicles</label>
                                </div>
                            </div>

                            @if (!$forAllVehicles)
                                <div class="col-md-12 mt-3">
                                    <div class="form-group">
                                        <select id="suitable_for" class="form-select searchable-select" multiple
                                            data-placeholder="Select vehicle"
                                            wire:model="suitable_for">

                                            @foreach ($modifications as $modification)
                                                <option value="{{ $modification->id }}"  @if (in_array($modification->id, $suitable_for)) selected @endif>
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
                            @else
                                <div class="col-md-12 mt-3">
                                    <div class="form-group">
                                        <label for="">Selected Vehicle</label> <br>
                                        <p class="badge bg-danger ">All</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
               </div>
            </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-secondary" wire:click="modalClose"
                       data-bs-dismiss="modal">Cancel</button>
                   <button type="submit" class="btn btn-primary">
                       {{ $isAdd ? 'Submit' : 'Submit' }}
                       <i class="spinner-border spinner-border-sm" wire:loading></i>
                   </button>
               </div>
           </form>
       </div>
    </div>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-0">
            <ul class="nav nav-tabs nav-primary border-bottom-0" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link @if($activeTab == 'manual') active bg-primary text-white @endif" wire:click="setTab('manual')" href="javascript:;" role="tab" style="cursor: pointer; border-radius: 8px 0 0 0;">
                        <div class="d-flex align-items-center px-3 py-2">
                            <div class="tab-icon"><i class='bx bx-plus-circle me-2 font-20'></i></div>
                            <div class="tab-title fw-bold">Manual Inventory</div>
                        </div>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link @if($activeTab == 'third_party') active bg-primary text-white @endif" wire:click="setTab('third_party')" href="javascript:;" role="tab" style="cursor: pointer; border-radius: 0 8px 0 0;">
                        <div class="d-flex align-items-center px-3 py-2">
                            <div class="tab-icon"><i class='bx bx-cloud-download me-2 font-20'></i></div>
                            <div class="tab-title fw-bold">Online Stock</div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="card shadow-sm border-0 mt-4">
        <div class="card-body d-flex justify-content-between align-items-center py-3">
            <div class="breadcrumb-title pe-2 border-0 mb-0 font-20 fw-bold text-dark">
                {{ $activeTab == 'manual' ? 'Manual Inventory Management' : 'Online Stock Management' }}
            </div>
            <div>
                @if ($activeTab == 'manual' && $user->hasPermissionTo('purchasestock-add'))
                <a href="javascript:;" wire:click="create(1)" class="btn btn-primary px-4 radius-30 d-flex align-items-center">
                    <i class="bx bxs-plus-square me-2"></i> Add New Stock
                </a>
                @endif
            </div>
        </div>
    </div>

<div class="card mt-4">
    <div class="card-body">
        <div class="row">
        <div class="col-3">
            <input type="text" class="form-control" placeholder="Search spare-part" wire:model.live="search" fdprocessedid="blgf5">
        </div>
        <div class="col-3">
                <select class="form-select"
                    wire:model.live="search_category">
                    <option value="" selected >Select Category</option>
                    <option value="1">Accessory</option>
                    <option value="2">Part</option>
                    <option value="3">Tool</option>
                    <option value="4">Lubricant</option>
                </select>
            </div>
        <div class="col-6 text-right">
            <button type="button" class="mr-2 btn btn-info text-white rounded-0  float-end" wire:click="resetFilter" fdprocessedid="orntg">Clear</button>
         </div>
        </div>

    </div>
</div>
    <div class="card mt-4">
        @if (!empty($items) && $items->count())
        <div class="card-body ">
            <div class="table-responsive">
                <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Spare Part</th>
                                <th>Category</th>
                                <th>Brand</th>
                                <th>HSN</th>
                                <th>Unit</th>
                                <th>Stock</th>
                                <th>Buy Price</th>
                                <th>Sell Price</th>
                                <th>Tax %</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $index => $product_stock)
                                <tr>
                                    <td>{{ $items->total() - ($items->firstItem() + $index) + 1 }}</td>
                                    <td>{{ $product_stock->label?->title }}</td>
                                    <td>
                                       @switch($product_stock->category_id)
                                            @case(1)
                                                Accessory
                                            @break

                                            @case(2)
                                                Parts
                                            @break

                                            @case(3)
                                                Tools
                                            @break

                                            @case(4)
                                                Lubricants
                                            @break

                                            @default
                                        @endswitch </td>
                                    <td>{{ $product_stock->brand }}</td>
                                    <td>{{ $product_stock->hsn_code ?? '-' }}</td>
                                    <td>{{ $product_stock->unit?->title ?? '-' }}</td>
                                    <td>{{ $product_stock->stock }}</td>
                                    <td>{{ number_format($product_stock->buy_price,2) ?? 0 }}</td>
                                    <td>
                                        {{ number_format($product_stock->price, 2) }}
                                    </td>
                                    <td>
                                        {{ $product_stock->tax_percentage ?? 0 }}%
                                        @if($product_stock->tax_type)
                                            <br><small class="text-muted text-capitalize">({{ $product_stock->tax_type }})</small>
                                        @endif
                                    </td>
                                     <td>
                                             <a wire:click="edit({{ $product_stock->id }})" class="btn btn-sm p-0 text-primary"><i class="bx bxs-edit"></i></a>

                                                  <a wire:click="confirmDeleteStock({{ $product_stock->id }})"
                                            class="btn btn-sm text-danger p-0 ms-2">
                                            <i class="bx bxs-trash"></i>
                                        </a>
                                     </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="pagination-wrapper">
                        {{ $items->links() }}
                    </div>
                </div>
            </div>
        @else
            <div class="my-2">
                <div class="alert alert-info">No Product Stock Found!</div>
            </div>
        @endif
    </div>

</div>
@section('footerscript')

    <script>
        function validateMaxQuantity(input) {
            var maxQuantity = parseInt(input.getAttribute('max'));

            if (parseInt(input.value) > maxQuantity) {
                input.value = maxQuantity;
            }
        }
    </script>
@endsection
