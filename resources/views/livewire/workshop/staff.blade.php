 <div>
    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <!-- Add/Edit Modal -->

    <div class="modal @if ($showUserModal) show @endif" tabindex="-1"
         style="opacity:1; background-color:#0606068c; display:@if ($showUserModal) block @endif">
         <div class="modal-dialog modal-lg">
             <div class="modal-content">
                 <form wire:submit.prevent="storeUser">
                     <div class="modal-header">
                         <h4 class="modal-title">Create User</h4>
                         <button type="button" class="btn-close" wire:click="$set('showUserModal', false)"
                             data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body py-3">
                         @csrf

                         <div class="row g-3">
                             <!-- Email -->
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label class="form-label">Email<sup class="text-danger">*</sup></label>
                                     <input type="email" wire:model="email" class="form-control"
                                         placeholder="Enter Email">
                                 </div>
                                 @error('email')
                                     <span class="text-danger error">{{ $message }}</span>
                                 @enderror
                             </div>

                             <!-- Password -->
                             @if ($isEdit == false)
                                 <div class="col-md-6">
                                     <div class="form-group">
                                         <label class="form-label">Password<sup class="text-danger">*</sup></label>
                                         <input type="password" wire:model="password" class="form-control"
                                             placeholder="Enter Password">
                                     </div>
                                     @error('password')
                                         <span class="text-danger error">{{ $message }}</span>
                                     @enderror
                                 </div>
                             @endif
                         </div>


                     </div>
                     <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" wire:click="$set('showUserModal', false)"
                             data-bs-dismiss="modal">Cancel</button>
                         <button type="submit" class="btn btn-primary">
                             Create
                             <i class="spinner-border spinner-border-sm" wire:loading></i>
                         </button>
                     </div>
                 </form>
             </div>
         </div>
     </div>


    <div class="modal @if ($showViewModal) show @endif" tabindex="-1"
         style="opacity:1; background-color:#0606068c; display:@if ($showViewModal) block @endif">
         <div class="modal-dialog modal-lg">
             <div class="modal-content">
                 <div class="modal-header">
                     <h4 class="modal-title">Staff Details</h4>
                     <button type="button" class="btn-close" wire:click="$set('showViewModal', false)"
                         data-bs-dismiss="modal" aria-label="Close"></button>
                 </div>
                 <div class="modal-body py-3">
                     @if ($selectedStaff)
                         <div class="row g-3">
                             <div class="col-md-6">
                                 <label class="fw-bold">Name:</label>
                                 <p>{{ $selectedStaff->user_title }} {{ $selectedStaff->name }} {{ $selectedStaff->lastname }}</p>
                             </div>
                             <div class="col-md-6">
                                 <label class="fw-bold">Email:</label>
                                 <p>{{ $selectedStaff->email ?: '-' }}</p>
                             </div>
                             <div class="col-md-6">
                                 <label class="fw-bold">Mobile Number:</label>
                                 <p>{{ $selectedStaff->mobile_no }}</p>
                             </div>
                             <div class="col-md-6">
                                 <label class="fw-bold">Role:</label>
                                 <p>{{ $selectedStaff->Role?->name ?: '-' }}</p>
                             </div>
                             <div class="col-md-6">
                                 <label class="fw-bold">Salary:</label>
                                 <p>₹{{ $selectedStaff->salary }}</p>
                             </div>
                             <div class="col-md-6">
                                 <label class="fw-bold">Joining Date:</label>
                                 <p>{{ $selectedStaff->joining_date }}</p>
                             </div>
                             <div class="col-md-6">
                                 <label class="fw-bold">Monthly Target:</label>
                                 <p>₹{{ $selectedStaff->monthly_target ?: 0 }}</p>
                             </div>
                             <div class="col-md-6">
                                 <label class="fw-bold">Incentives:</label>
                                 <p>{{ $selectedStaff->incentives }}%</p>
                             </div>
                             <div class="col-md-12">
                                 <label class="fw-bold">Address:</label>
                                 <p>{{ $selectedStaff->address }} {{ $selectedStaff->pincode ? '(Pincode: ' . $selectedStaff->pincode . ')' : '' }}</p>
                             </div>
                             <div class="col-md-6">
                                 <label class="fw-bold">User Account Created:</label>
                                 <p>{{ $selectedStaff->is_user == 1 ? 'Yes' : 'No' }}</p>
                             </div>
                             <div class="col-md-6">
                                 <label class="fw-bold">Login Access:</label>
                                 <p>{{ $selectedStaff->is_login ? 'Enabled' : 'Disabled' }}</p>
                             </div>
                             @if($selectedStaff->file)
                             <div class="col-md-12 text-center">
                                 <label class="fw-bold d-block">Staff Image:</label>
                                 <img src="{{ asset($selectedStaff->file) }}" class="img-thumbnail" style="max-width: 200px;">
                             </div>
                             @endif
                         </div>
                     @endif
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" wire:click="$set('showViewModal', false)"
                         data-bs-dismiss="modal">Close</button>
                 </div>
             </div>
         </div>
     </div>


     <div class="modal @if ($showModal) show @endif" tabindex="-1"
         style="opacity:1; background-color:#0606068c; display:@if ($showModal) block @endif">
         <div class="modal-dialog modal-lg">
             <div class="modal-content">
                 <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">
                     <div class="modal-header">
                         <h4 class="modal-title">{{ $isEdit ? 'Edit Staff' : 'Create Staff' }}</h4>
                         <button type="button" class="btn-close" wire:click="$set('showModal', false)"
                             data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body py-3">
                         @csrf

                         <div class="row g-3">
                             <!-- Name -->
                             <div class="col-md-6">
                                 <label for="first_name" class="form-label">
                                     First Name <sup class="text-danger">*</sup>
                                 </label>
                                 <div class="input-group">
                                     <select name="user_title" id="user_title" wire:model="user_title"
                                         class="form-select" style="max-width: 80px;">
                                         <option value="mr" selected>Mr.</option>
                                         <option value="mrs">Mrs.</option>
                                         <option value="miss">Miss</option>
                                         <!--<option value="ms">M.S.</option>-->
                                     </select>
                                     <input type="text" wire:model="name" name="first_name" id="first_name"
                                         class="form-control" placeholder="Enter First Name">
                                 </div>
                                 @if ($errors->has('name') || $errors->has('user_title'))
                                     <span class="text-danger error">
                                         {{ $errors->first('name') ?? $errors->first('user_title') }}
                                     </span>
                                 @endif
                             </div>

                             <!-- Last Name (Optional) -->
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label class="form-label">Last Name <span class="text-muted" style="font-size:12px;">(Optional)</span></label>
                                     <input type="text" wire:model="lastname" class="form-control"
                                         placeholder="Enter Last Name">
                                 </div>
                                 @error('lastname')
                                     <span class="text-danger error">{{ $message }}</span>
                                 @enderror
                             </div>

                             <!-- Role -->
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label class="form-label">Staff Type<sup class="text-danger">*</sup></label>
                                     <select class="form-select" wire:model="role">
                                         <option value="">Select Staff Type</option>
                                         @foreach ($roles as $role)
                                             <option value="{{ $role->id }}">{{ $role->name }}</option>
                                         @endforeach
                                     </select>

                                     @error('role')
                                         <span class="text-danger error">{{ $message }}</span>
                                     @enderror
                                 </div>
                             </div>

                             <!-- Joining Date -->
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label class="form-label">Joining Date<sup class="text-danger">*</sup></label>
                                     <input type="date" wire:model="joining_date" class="form-control">
                                 </div>
                                 @error('joining_date')
                                     <span class="text-danger error">{{ $message }}</span>
                                 @enderror
                             </div>

                             <!-- Mobile Number -->
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label class="form-label">Mobile Number<sup class="text-danger">*</sup></label>
                                     <input type="number" wire:model="mobile_no" class="form-control"
                                         placeholder="Enter Mobile Number">
                                 </div>
                                 @error('mobile_no')
                                     <span class="text-danger error">{{ $message }}</span>
                                 @enderror
                             </div>

                             <!-- Salary -->
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label class="form-label">Salary(₹)<sup class="text-danger">*</sup></label>
                                     <input type="number" wire:model="salary" class="form-control"
                                         placeholder="Enter Salary">
                                 </div>
                                 @error('salary')
                                     <span class="text-danger error">{{ $message }}</span>
                                 @enderror
                             </div>

                             <!-- Monthly Target -->
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label class="form-label">Monthly Target (₹)</label>
                                     <input type="number" wire:model="monthly_target" class="form-control"
                                         placeholder="Enter Monthly Target e.g. 100000">
                                 </div>
                                 @error('monthly_target')
                                     <span class="text-danger error">{{ $message }}</span>
                                 @enderror
                             </div>

                             <!-- Incentives -->
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label class="form-label">Incentives(%)<sup class="text-danger">*</sup></label>
                                     <input type="number" wire:model="incentives" class="form-control"
                                         placeholder="Enter Incentives">
                                 </div>
                                 @error('incentives')
                                     <span class="text-danger error">{{ $message }}</span>
                                 @enderror
                             </div>

                             <!-- Image Upload with Live Preview & Download -->
                             <div class="col-md-12">
                                 <label class="form-label">Image</label>
                                 <div class="d-flex align-items-start gap-3 flex-wrap">

                                     <!-- File Input Side -->
                                     <div class="flex-grow-1">
                                         <input type="file"
                                             class="form-control"
                                             id="staffImageInput"
                                             wire:model="image"
                                             accept="image/*"
                                             onchange="previewStaffImage(event)">
                                         <small class="text-muted">Maximum file size: 2 MB</small>

                                         <div wire:loading wire:target="image" class="text-info mt-1">
                                             <span class="spinner-border spinner-border-sm" role="status"></span>
                                             Uploading image...
                                         </div>
                                         @error('image')
                                             <span class="text-danger error d-block mt-1">{{ $message }}</span>
                                         @enderror
                                     </div>

                                     <!-- Preview + Download Side -->
                                     <div id="staffImagePreviewBox"
                                          style="min-width:120px; display:{{ !empty($imageName) ? 'block' : 'none' }};">
                                         <div class="border rounded p-1 text-center bg-light" style="width:120px;">
                                             <img
                                                 id="staffImagePreview"
                                                 src="{{ !empty($imageName) ? asset($imageName) : '' }}"
                                                 alt="Preview"
                                                 class="img-fluid rounded"
                                                 style="width:108px; height:100px; object-fit:cover;"
                                             >
                                             <a
                                                 id="staffImageDownloadBtn"
                                                 href="{{ !empty($imageName) ? asset($imageName) : '#' }}"
                                                 download
                                                 class="btn btn-sm btn-success w-100 mt-1 py-1"
                                                 style="font-size:11px; display:{{ !empty($imageName) ? 'block' : 'none' }};"
                                             >
                                                 <i class="bx bx-download"></i> Download
                                             </a>
                                         </div>
                                     </div>

                                 </div>
                             </div>

                             <!-- Address -->
                             <div class="col-md-12">
                                 <div class="form-group">
                                     <label class="form-label">Address <sup class="text-danger">*</sup> </label>
                                     <textarea wire:model="address" class="form-control" placeholder="Enter Address"></textarea>
                                 </div>
                                 @error('address')
                                     <span class="text-danger error">{{ $message }}</span>
                                 @enderror
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




     <div class="card">
         <div class="card-body d-flex justify-content-between align-items-center">
             <div class="breadcrumb-title pe-2" style="border: none;">Staff</div>
             {{-- @if ($user->hasPermissionTo('staff-add')) --}}
             <div class="pe-3">
                 <a href="javascript:;" wire:click="create" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i
                         class="bx bxs-plus-square"></i>Add</a>
             </div>
             {{-- @endif --}}
         </div>
     </div>
     <div class="card mt-4">
         <div class="card-body">
             <div class="row">
                 <div class="col-3">
                     <input type="text" class="form-control" placeholder="Search staff"
                         wire:model.live="searchStaff" fdprocessedid="blgf5">
                 </div>
                 <div class="col-3">
                     <div class="form-group">
                         <select class="form-select" wire:model.change="seachRole">
                             <option value="">All Role</option>
                             @foreach ($roles as $role)
                                 <option value="{{ $role->id }}">{{ $role->name }}</option>
                             @endforeach
                         </select>
                     </div>
                 </div>
                 <div class="col-6 text-right">
                     <button type="button" class="mr-2 btn btn-info text-white rounded-0  float-end"
                         wire:click="resetFilter" fdprocessedid="orntg">Clear</button>
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
                                 <th>Name</th>
                                 <th>Email</th>
                                 <th>Mobile Number</th>
                                 <th>Role</th>
                                 <th>User</th>
                                 <th>Login</th>
                                 <th>Actions</th>
                             </tr>
                         </thead>
                         <tbody>
                             @foreach ($items as $index => $item)
                                 <tr>
                                    <td>{{ $items->total() - ($items->firstItem() + $index) + 1 }}</td>
                                     <td>{{ $item->name . ' ' . $item->lastname }}</td>
                                     <td>
                                         @if ($item->email != '')
                                             {{ $item->email }}
                                         @else
                                             -
                                         @endif
                                     </td>
                                     <td> {{ $item->mobile_no }} </td>
                                     <td>{{ $item->Role?->name }}
                                     </td>
                                     <td>
                                         @if ($item->is_user == 1)
                                             Yes
                                         @else
                                             No
                                         @endif
                                     </td>
        <td>
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" role="switch"
               id="toggleSwitch{{ $item->id }}"
               wire:click="toggleLogin({{ $item->id }})"
               @if($item->is_login) checked @endif>
        <label class="form-check-label" for="toggleSwitch{{ $item->id }}">
            {{ $item->is_login ? 'On' : 'Off' }}
        </label>
    </div>
</td>
                                     <td>
                                         {{-- @if ($user->hasPermissionTo('staff-edit')) --}}
                                         <a wire:click="viewStaff({{ $item->id }})" class="btn btn-sm p-0 text-primary" title="View Details">
                                             <i class="bx bx-show"></i>
                                         </a>

                                         <a wire:click="edit({{ $item->id }})" class="btn btn-sm p-0"><i
                                                 class="bx bxs-edit"></i> <span class="small"></span></a>
                                         {{-- @endif  @if ($user->hasPermissionTo('staff-delete')) --}}
                                         <a wire:click="confirmDelete({{ $item->id }})" class="btn btn-sm p-0"><i
                                                 class="fadeIn animated bx bx-trash"></i> <span
                                                 class="small"></span></a>
                                         {{-- @endif --}}
                                         @if ($item->is_user == 0)
                                             <a wire:click="addUser({{ $item->id }})"
                                                 class="btn btn-sm btn-success"> Add User </a>
                                         @endif
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
                 <div class="alert alert-info">No Staff Found!</div>
             </div>
         @endif
     </div>

 </div>


 @section('footerscript')
     <script>
         /**
          * Show a live preview when the user picks an image file.
          * Also updates the Download button href so it points to the blob URL.
          */
         function previewStaffImage(event) {
             const file = event.target.files[0];
             if (!file) return;

             const reader = new FileReader();
             reader.onload = function(e) {
                 const previewBox   = document.getElementById('staffImagePreviewBox');
                 const previewImg   = document.getElementById('staffImagePreview');
                 const downloadBtn  = document.getElementById('staffImageDownloadBtn');

                 previewImg.src         = e.target.result;
                 previewBox.style.display = 'block';

                 // For a freshly selected file, create a temporary object URL for download
                 const blobUrl = URL.createObjectURL(file);
                 downloadBtn.href         = blobUrl;
                 downloadBtn.download     = file.name;
                 downloadBtn.style.display = 'block';
             };
             reader.readAsDataURL(file);
         }

         document.addEventListener('livewire:init', function() {

             Livewire.hook('morphed', (message, component) => {
                 $('.select2').select2().on('change', function(e) {
                     const selectedValues = $(this).val();
                     @this.set(e.target.dataset.property, selectedValues);
                 });
             });


         });
     </script>
 @endsection
