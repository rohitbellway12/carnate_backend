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
                         <h4 class="modal-title">{{ $isEdit ? 'Edit Tools' : 'Create Tools' }}</h4>
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
                                                 wire:click="addToolsLabel">
                                                 {{ trans('+') }}
                                             </button>
                                         </div>
                                     </div>

                                 </div>
                                 @error('name')
                                     <span class="text-danger error">{{ $message }}</span>
                                 @enderror
                             </div>

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

                             <div class="col-md-6">
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
                             </div>

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
                                     <select class="form-select" wire:model="category">
                                         <option value="">Select Category</option>
                                         @foreach ($categories as $category)
                                             <option value="{{ $category['categoryId'] }}">{{ $category['categoryName'] }}</option>
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
                                             <img src="{{ asset($imagePreview) }}" alt="Image Preview" height="100px"
                                                 width="100px">
                                         </div>
                                     @endif
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
                                     @if (!empty($imageName))
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

                             <div>
                                <div class="col-md-12">
                                    <label class="form-label">Compatible Vehicles<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <input type="checkbox" wire:model.live="forAllVehicles" id="all_vehicles">
                                        <label for="all_vehicles">For All Vehicles</label>
                                    </div>
                                </div>

                                 @if (!$forAllVehicles)
                                     <div class="col-md-12 mt-3">
                                         <div class="form-group">
                                             <select id="suitable_for" class="form-select" multiple
                                                 wire:model="suitable_for">
                                                 @foreach ($modifications as $modification)
                                                     <option value="{{ $modification->id }}">
                                                        {{ $modification->brand_name . ' ' . $modification->variant_name . ' ' . $modification->year . ' ' . $modification->title }}
                                                     </option>
                                                 @endforeach
                                             </select>
                                         </div>
                                         @error('suitable_for')
                                             <span class="text-danger">{{ $message }}</span>
                                         @enderror
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




     <div class="modal @if ($showToolsModel) show @endif" tabindex="-1"
         style="opacity:1; background-color:#0606068c; display:@if ($showToolsModel) block @endif">
         <div class="modal-dialog modal-md">
             <div class="modal-content">
                 <form wire:submit.prevent="toolsLabelStore">
                     <div class="modal-header">
                         <h4 class="modal-title">Create Tools</h4>
                         <button type="button" class="btn-close" wire:click="$set('showToolsModel', false)"
                             data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body py-3">
                         @csrf
                         <div class="row g-3">
                             <div class="col-md-12">
                                 <div class="form-group">
                                     <label class="form-label">Tools Label</label>
                                     <input type="text" wire:model="tools_label" class="form-control"
                                         placeholder="Enter Tools Label">
                                 </div>
                                 @error('tools_label')
                                     <span class="text-danger error">{{ $message }}</span>
                                 @enderror
                             </div>
                         </div>

                     </div>
                     <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" wire:click="$set('showToolsModel', false)"
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


     <div class="card">
         <div class="card-body d-flex justify-content-between align-items-center">
             <div class="breadcrumb-title pe-2" style="border: none;">Tools</div>
             @if (@$sparePart->hasPermissionTo('tools-add'))
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
         @if (!empty($tools) && $tools->count())
             <div class="card-body ">
                 <div class="table-responsive">
                     <table class="table table-bordered data-table">
                         <thead>
                             <tr>
                                 <th>S.No.</th>
                                 <th>Image</th>
                                 <th>Name</th>
                                 <th>Unit</th>
                                 {{-- <th>Brand</th> --}}
                                 {{-- <th>Suitable For</th> --}}
                                 <th>Price</th>
                                 <th>Amount</th>
                                 <th>Discount</th>
                                 <th>Stock</th>
                                 <th>HSN Code</th>
                                 <th>Rack No.</th>
                                 @if (@$sparePart->hasPermissionTo('tools-edit') || @$sparePart->hasPermissionTo('tools-delete'))
                                     <th>Actions</th>
                                 @endif
                             </tr>
                         </thead>
                         <tbody>
                             @foreach ($tools as $index => $tool)
                                 <tr>
                                    <td>{{ $tools->total() - ($tools->firstItem() + $index) + 1 }}</td>
                                     <td>
                                         @if (!empty($tool->Image->file))
                                             <img src="{{ asset($tool->Image->file) }}" alt="tools image"
                                                 height="50px" width="50px">
                                         @else
                                             <img src="{{ asset('img/tools.jpg') }}" alt="tools image"
                                                 height="50px" width="50px">
                                         @endif
                                     </td>
                                     <td>{{ $tool->name }}</td>
                                     <td>{{ $tool->unit?->title ?? '' }}</td>
                                     {{-- <td> {{ $tool->brand }} </td> --}}
                                     {{-- <td> {{ $tool->suitable_for }} </td> --}}
                                     <td> {{ $tool->price }} </td>
                                     <td> {{ $tool->amount }} </td>
                                     <td> {{ $tool->discount }} </td>
                                     <td> {{ $tool->stock }} </td>
                                     <td> {{ $tool->hsn_code }} </td>
                                     <td> {{ $tool->rack_no }} </td>
                                     @if (@$sparePart->hasPermissionTo('tools-edit') || @$sparePart->hasPermissionTo('tools-delete'))
                                         <td>
                                             @if (@$sparePart->hasPermissionTo('tools-edit'))
                                                 <a wire:click="edit({{ $tool->id }})" class="btn btn-sm p-0"><i
                                                         class="bx bxs-edit"></i> <span class="small"></span></a>
                                             @endif
                                             @if (@$sparePart->hasPermissionTo('tools-delete'))
                                                 <a wire:click="confirmDelete({{ $tool->id }})"
                                                     class="btn btn-sm p-0"><i
                                                         class="fadeIn animated bx bx-trash"></i> <span
                                                         class="small"></span></a>
                                             @endif
                                         </td>
                                     @endif
                                 </tr>
                             @endforeach
                         </tbody>
                     </table>
                     <div class="pagination-wrapper">
                         {{ $tools->links() }}
                     </div>
                 </div>
             </div>
         @else
             <div class="my-2">
                 <div class="alert alert-info">No Tools found!</div>
             </div>
         @endif
     </div>

 </div>

 @section('footerscript')
     <script>
         document.addEventListener('livewire:init', () => {

             initialize();

             // Re-initialize on DOM updates
             Livewire.hook('morphed', (message, component) => {
                 initialize();
             });
         });

         function initialize() {
             $('#name').select2({
                 placeholder: "Select Name"
             }).on('change', function() {
                 @this.set('name', $(this).val());
             });

             $('#unit').select2({
                 placeholder: "Select Unit"
             }).on('change', function() {
                 @this.set('unit', $(this).val());
             });

             $('#suitable_for').select2({
                 placeholder: "Select vehicle"
             }).on('change', function() {
                 @this.set('suitable_for', $(this).val());
             });
         }
     </script>
 @endsection
