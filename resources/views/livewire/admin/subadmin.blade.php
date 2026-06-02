 
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
                        <h4 class="modal-title">{{ $isEdit ? 'Edit Sub Admin' : 'Create Sub Admin' }}</h4>
                        <button type="button" class="btn-close" wire:click="closeModel"
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
                                    <select name="user_title" id="user_title" wire:model.live="user_title" class="form-select"
                                        style="max-width: 80px;">
                                        <option value="">Select</option>
                                        <option value="mr">Mr.</option>
                                        <option value="mrs">Mrs.</option>
                                        <option value="miss">Miss</option>
                                        <option value="ms">M.S.</option>
                                    </select>
                                    <input type="text" wire:model.live.debounce.300ms="name" name="first_name" id="first_name"
                                        class="form-control" placeholder="Enter First Name">
                                </div>
                                @error('user_title') <span class="text-danger error d-block">{{ $message }}</span> @enderror
                                @error('name') <span class="text-danger error d-block">{{ $message }}</span> @enderror
                            </div>
                        
                            <!-- Last Name -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Last Name<sup class="text-danger">*</sup></label>
                                    <input type="text" wire:model.live.debounce.300ms="lastname" class="form-control" placeholder="Enter Last Name">
                                </div>
                                @error('lastname') <span class="text-danger error">{{ $message }}</span> @enderror
                            </div>

                            <!-- Role -->
                            <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Admin Type<sup class="text-danger">*</sup></label>
                                <select class="form-select" wire:model="role">
                                    <option value="">Select admin Type</option>
                                    @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>

                                @error('role') <span class="text-danger error">{{ $message }}</span> @enderror 
                            </div> 
                        </div>
                        
                            <!-- Email -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Email<sup class="text-danger">*</sup></label>
                                    <input type="email" wire:model.live.debounce.300ms="email" class="form-control" placeholder="Enter Email">
                                </div>
                                @error('email') <span class="text-danger error">{{ $message }}</span> @enderror
                            </div>
                        
                            <!-- Password -->
                            @if($isEdit == false)
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Password<sup class="text-danger">*</sup></label>
                                    <input type="password" wire:model.live.debounce.300ms="password" class="form-control" placeholder="Enter Password">
                                </div>
                                @error('password') <span class="text-danger error">{{ $message }}</span> @enderror
                            </div>
                            @endif
                        
                            <!-- Mobile Number -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Mobile Number<sup class="text-danger">*</sup></label>
                                    <input type="text" wire:model.live.debounce.300ms="mobile_no" class="form-control" placeholder="Enter Mobile Number">
                                </div>
                                @error('mobile_no') <span class="text-danger error">{{ $message }}</span> @enderror
                            </div>
                        
                        
                            <!-- Birth Date -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Birth Date</label>
                                    <input type="date" wire:model.live="birth_date" class="form-control">
                                </div>
                                @error('birth_date') <span class="text-danger error">{{ $message }}</span> @enderror
                            </div>
                        
                          
                            <!-- Country -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Country<sup class="text-danger">*</sup></label>
                                    <select class="form-select" wire:change="stateData($event.target.value)" wire:model="country_id">
                                        <option value="">Select Country</option>
                                        @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('country_id') <span class="text-danger error">{{ $message }}</span> @enderror
                            </div>
                        
                            <!-- State -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">State<sup class="text-danger">*</sup></label>
                                    <select class="form-select" wire:model="state_id" wire:change="cityData($event.target.value)">
                                        <option value="">Select State</option>
                                        @foreach ($states as $state)
                                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('state_id') <span class="text-danger error">{{ $message }}</span> @enderror
                            </div>
                        
                            <!-- City -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">City<sup class="text-danger">*</sup></label>
                                    <select class="form-select" wire:model="city_id">
                                        <option value="">Select City</option>
                                        @foreach ($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('city_id') <span class="text-danger error">{{ $message }}</span> @enderror
                            </div>

                            <div class=" col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="pincode">Pincode<span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" wire:model.live.debounce.300ms="pincode" placeholder="Pincode">
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
                                @error('address') <span class="text-danger error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        
                       
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModel"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                            {{ $isEdit ? 'Update' : 'Create' }}
                            <i class="spinner-border spinner-border-sm" wire:loading></i>
                        </button>
                        <div class="w-100 mt-2 text-center" wire:loading>Processing...</div>
                        @if ($errors->any())
                            <div class="alert alert-danger mt-2 w-100">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

    


    <div class="card">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div class="breadcrumb-title pe-2" style="border: none;"><i class="fas fa-user-shield  fs-5"></i> Sub Admin</div>
            @if (@$admin->hasPermissionTo('sub-admin-add'))
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
        {{--    <div class="col-3">
                <input type="text" class="form-control" placeholder="Search..." wire:model.live="searchfilter" fdprocessedid="blgf5">
            </div> --}}
            <div class="col-3">
                <input type="text" class="form-control" wire:model.live.debounce.300ms="searchfilter">
            </div>
            <div class="col-9 text-right">
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
                                <th>Name</th>
                                <th>Role</th>
                                <th>Email</th>
                                <th>Mobile Number</th>
                                <th>City</th> 
                                @if (@$admin->hasPermissionTo('sub-admin-edit') || @$admin->hasPermissionTo('sub-admin-delete'))
                                <th>Actions</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $index => $item)
                                <tr>
                                    <td>{{ $items->total() - ($items->firstItem() + $index) + 1 }}</td>
                                    <td>{{ $item->name .' '. $item->lastname }}</td>
                                    <td>{{ $item->getRoleNames()->implode(', ')  }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td> {{ $item->mobile_no }} </td>
                                    <td> {{ $item->cityName ? $item->cityName->name  : 'NA' }} </td> 
                                    @if (@$admin->hasPermissionTo('sub-admin-edit') || @$admin->hasPermissionTo('sub-admin-delete'))
                                        <td>
                                            @if (@$admin->hasPermissionTo('sub-admin-edit'))
                                                <a wire:click="edit({{ $item->id }})" class="btn btn-sm p-0"><i
                                                        class="bx bxs-edit"></i> <span class="small"></span></a>
                                            @endif
                                            @if (@$admin->hasPermissionTo('sub-admin-delete'))
                                                <a wire:click="confirmDelete({{ $item->id }})"
                                                    class="btn btn-sm p-0"><i class="fadeIn animated bx bx-trash"></i> <span
                                                        class="small"></span></a>
                                            @endif
                                        </td>
                                    @endif
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
                <div class="alert alert-info">No Sub Admin found!</div>
            </div>
        @endif
    </div>
    
</div>


@section('footerscript')
   
    <script> 
    
        document.addEventListener('livewire:init', function () { 
           
            Livewire.hook('morphed', (message, component) => { 
                $('.select2').select2().on('change', function(e){ 
                    const selectedValues = $(this).val();
                    @this.set(e.target.dataset.property,selectedValues);
              });
            });

            
        });
    </script>
@endsection
