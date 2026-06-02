 <div>
     <!-- Success Message -->
     @if (session()->has('message'))
         <div class="alert alert-success">{{ session('message') }}</div>
     @endif
     @php
         $admin = App\Models\Admin::where('id', $adminId)->first();
     @endphp
     <!-- Add/Edit Modal -->

     <div class="modal @if ($showModal) show @endif" tabindex="-1"
         style="opacity:1; background-color:#0606068c; display:@if ($showModal) block @endif">
         <div class="modal-dialog modal-lg">
             <div class="modal-content">
                 <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">
                     <div class="modal-header">
                         <h4 class="modal-title">{{ $isEdit ? 'Edit Work Shop Vendor' : 'Create Work Shop Vendor' }}</h4>
                         <button type="button" class="btn-close" wire:click="closeModel" data-bs-dismiss="modal"
                             aria-label="Close"></button>
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
                                         <option value="mr">Mr.</option>
                                         <option value="mrs">Mrs.</option>
                                         <option value="miss">Miss</option>
                                         <option value="ms">M.S.</option>
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

                             <!-- Company Name -->
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label class="form-label">Company Name<sup class="text-danger">*</sup></label>
                                     <input type="text" wire:model="company_name" class="form-control"
                                         placeholder="Enter Company Name">
                                 </div>
                                 @error('company_name')
                                     <span class="text-danger error">{{ $message }}</span>
                                 @enderror
                             </div>

                             <!-- Last Name -->
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label class="form-label">Last Name<sup class="text-danger">*</sup></label>
                                     <input type="text" wire:model="lastname" class="form-control"
                                         placeholder="Enter Last Name">
                                 </div>
                                 @error('lastname')
                                     <span class="text-danger error">{{ $message }}</span>
                                 @enderror
                             </div>

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
                          {{--   @if ($isEdit == false)
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
                             @endif--}}
                             
                              <!-- Password -->
                             @if ($isEdit == false)
                             <div class="col-md-6">

                                 <label for="inputChoosePassword" class="form-label">Password<sup class="text-danger">*</sup></label>
                                 <div class="input-group" id="show_hide_password">
                                 <input type="password" wire:model="password" class="form-control border-end-0 new_input" id="inputChoosePassword"
                                     placeholder="Enter Password" autocomplete="password">
                                    <a href="javascript:void(0);" class="input-group-text bg-transparent"
                                    onclick="togglePassword()">
                                    <i class='bx bx-hide' id="password-icon"></i>
                                    </a> 
                                 </div>
                                 @error('password')
                                 <span class="text-danger error">{{ $message }}</span>
                                 @enderror
                             </div>
                             @endif

                             <!-- Mobile Number -->
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label class="form-label">Mobile Number<sup class="text-danger">*</sup></label>
                                     <input type="text" wire:model="mobile_no" class="form-control"
                                         placeholder="Enter Mobile Number">
                                 </div>
                                 @error('mobile_no')
                                     <span class="text-danger error">{{ $message }}</span>
                                 @enderror
                             </div>

                             <!-- Birth Date -->
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label class="form-label">Birth Date</label>
                                     <input type="date" wire:model="birth_date" class="form-control">
                                 </div>
                                 @error('birth_date')
                                     <span class="text-danger error">{{ $message }}</span>
                                 @enderror
                             </div>
                             
          <!-- Is GST -->
<div class="col-md-6">
    <div class="form-group">
        <label class="form-label">GST Billing</label>
        <select id="is_gst" class="form-select" wire:model="is_gst">
            <option value="0">No</option>
            <option value="1">Yes</option>
        </select>
    </div>
    @error('is_gst')
        <span class="text-danger error">{{ $message }}</span>
    @enderror
</div>

<!-- GST Number -->
<div class="col-md-6" id="gst_number_div" style="{{ $is_gst == 1 ? 'display:block;' : 'display:none;' }}">
    <div class="form-group">
        <label class="form-label">GST Number</label>
        <input type="text" id="gst_no" wire:model="gst_no" class="form-control" placeholder="Enter GST Number" {{ $is_gst == 1 ? '' : 'disabled' }}>
    </div>
    @error('gst_no')
        <span class="text-danger error">{{ $message }}</span>
    @enderror
</div>





                             <!-- Country -->
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label class="form-label">Country<sup class="text-danger">*</sup></label>
                                     <select class="form-select" wire:change="stateData($event.target.value)"
                                         wire:model="country_id">
                                         <option value="">Select Country</option>
                                         @foreach ($countries as $country)
                                             <option value="{{ $country->id }}">{{ $country->name }}</option>
                                         @endforeach
                                     </select>
                                 </div>
                                 @error('country_id')
                                     <span class="text-danger error">{{ $message }}</span>
                                 @enderror
                             </div>

                             <!-- State -->
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label class="form-label">State<sup class="text-danger">*</sup></label>
                                     <select class="form-select" wire:model="state_id"
                                         wire:change="cityData($event.target.value)">
                                         <option value="">Select State</option>
                                         @foreach ($states as $state)
                                             <option value="{{ $state->id }}" @selected($state_id == $state->id)>
                                                 {{ $state->name }}</option>
                                         @endforeach
                                     </select>
                                 </div>
                                 @error('state_id')
                                     <span class="text-danger error">{{ $message }}</span>
                                 @enderror
                             </div>

                             <!-- City -->
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label class="form-label">City<sup class="text-danger">*</sup></label>
                                     <select class="form-select" wire:model="city_id">
                                         <option value="">Select City</option>
                                         @foreach ($cities as $city)
                                             <option value="{{ $city->id }}" @selected($city_id == $city->id)>
                                                 {{ $city->name }}</option>
                                         @endforeach
                                     </select>
                                 </div>
                                 @error('city_id')
                                     <span class="text-danger error">{{ $message }}</span>
                                 @enderror
                             </div>
                             <div class=" col-md-6">
                                 <div class="form-group">
                                     <label class="form-label" for="pincode">Pincode<span
                                             class="text-danger">*</span></label>
                                     <input type="number" class="form-control" wire:model="pincode"
                                         placeholder="Pincode">
                                 </div>
                                 @error('pincode')
                                     <span class="text-danger">{{ $message }}</span>
                                 @enderror
                             </div>

                             <!-- Address -->
                             <div class="col-md-12">
                                 <div class="form-group">
                                     <label class="form-label">Address<sup class="text-danger">*</sup></label>
                                     <textarea wire:model="address" class="form-control" placeholder="Enter Address"></textarea>
                                 </div>
                                 @error('address')
                                     <span class="text-danger error">{{ $message }}</span>
                                 @enderror
                             </div>

                             <!-- Trial -->
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label class="form-label">Trial</label>
                                     <select class="form-select" wire:model="is_trial"
                                         wire:change="trialData($event.target.value)">
                                         <option value="1">Yes</option>
                                         <option value="0">No</option>
                                     </select>
                                 </div>
                             </div>

                             <!-- Trial Days -->
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label class="form-label">Trial Days</label>
                                     <input type="text" wire:model="trial_days" class="form-control"
                                         placeholder="Enter Trial Days"
                                         @if (!$is_trial) disabled @endif>
                                 </div>
                                 @error('trial_days')
                                     <span class="text-danger error">{{ $message }}</span>
                                 @enderror
                             </div>

                         </div>
                     </div>
                     <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" wire:click="closeModel"
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
             <div class="breadcrumb-title pe-2" style="border: none;"><i class="bx bx-user fs-5"></i> Work Shop
                 Vendor</div>
             @if (@$admin->hasPermissionTo('work-shop-vendor-add'))
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
                     <input type="text" class="form-control" placeholder="Search Name... "
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
         @if (!empty($vendors) && $vendors->count())
             <div class="card-body ">
                 <div class="table-responsive">
                     <table class="table table-bordered data-table">
                         <thead>
                             <tr>
                                 <th>S.No.</th>
                                 <th>Name</th>
                                 <th>Company Name</th>
                                 <th>Email</th>
                                 <th>Mobile Number</th>
                                 <th>City</th>
                                 <th>Role</th>
                                 <th>Parent Vendor</th>
                                 @if (@$admin->hasPermissionTo('work-shop-vendor-edit') || @$admin->hasPermissionTo('work-shop-vendor-delete'))
                                     <th>Actions</th>
                                 @endif
                             </tr>
                         </thead>
                         <tbody>
                             @foreach ($vendors as $index => $vendor)
                                 <tr>
                                     <td>{{ $vendors->total() - ($vendors->firstItem() + $index) + 1 }}</td>
                                     <td>{{ $vendor->name . ' ' . $vendor->lastname }}</td>
                                     <td>{{ $vendor->company_name ?? 'N/A' }}</td>
                                     <td>{{ $vendor->email }}</td>
                                     <td> {{ $vendor->mobile_no }} </td>
                                     <td> {{ $vendor->cityName ? $vendor->cityName->name : 'NA' }} </td>
                                     <td>{{ $vendor->getRoleNames()->implode(', ') }}</td>
                                     <td>{{ $vendor->parent?->name . ' ' . $vendor->parent?->lastname }}</td>
                                     @if (@$admin->hasPermissionTo('work-shop-vendor-edit') || @$admin->hasPermissionTo('work-shop-vendor-delete'))
                                         <td>
                                             @if (@$admin->hasPermissionTo('work-shop-vendor-edit'))
                                                 <a wire:click="edit({{ $vendor->id }})" class="btn btn-sm p-0"><i
                                                         class="bx bxs-edit"></i> <span class="small"></span></a>
                                             @endif
                                             @if (@$admin->hasPermissionTo('work-shop-vendor-delete'))
                                                 <a wire:click="confirmDelete({{ $vendor->id }})"
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
                         {{ $vendors->links() }}
                     </div>
                 </div>
             </div>
         @else
             <div class="my-2">
                 <div class="alert alert-info">No Work Shop Vendor found!</div>
             </div>
         @endif
     </div>

 </div>


 @section('footerscript')
     <script>
         document.addEventListener('livewire:init', function() {

             Livewire.hook('morphed', (message, component) => {
                 $('.select2').select2().on('change', function(e) {
                     const selectedValues = $(this).val();
                     @this.set(e.target.dataset.property, selectedValues);
                 });
             });


         });
         
         
     </script>
 <script>
    document.addEventListener('DOMContentLoaded', function() {
        toggleGstField(); 

        var isGstSelect = document.getElementById('is_gst');
        if (isGstSelect) {
            isGstSelect.addEventListener('change', function() {
                toggleGstField();
            });
        }

        function toggleGstField() {
            var isGst = document.getElementById('is_gst').value;
            var gstDiv = document.getElementById('gst_number_div');
            var gstInput = document.getElementById('gst_no');

            if (isGst === '1') {
                gstDiv.style.display = 'block';
                gstInput.disabled = false;
            } else {
                gstDiv.style.display = 'none';
                gstInput.disabled = true;
                gstInput.value = '';
            }
        }
    });
</script>

<!-- psw show hide  -->
<script>
     function togglePassword() {
         const passwordInput = document.getElementById("inputChoosePassword");
         const passwordIcon = document.getElementById("password-icon");

         if (passwordInput.type === "password") {
             passwordInput.type = "text";
             passwordIcon.classList.remove("bx-hide");
             passwordIcon.classList.add("bx-show");
         } else {
             passwordInput.type = "password";
             passwordIcon.classList.remove("bx-show");
             passwordIcon.classList.add("bx-hide");
         }
     }
 </script>


 @endsection
