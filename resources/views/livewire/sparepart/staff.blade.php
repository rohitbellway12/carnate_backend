 
<div>
    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    @php
        $sparePart = App\Models\SparePartVendor::where('id', $sparepartId)->first();
    @endphp
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
                                <input type="email" wire:model="email" class="form-control" placeholder="Enter Email">
                            </div>
                            @error('email') <span class="text-danger error">{{ $message }}</span> @enderror
                        </div>
                    
                        <!-- Password -->
                        @if($isEdit == false)
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Password<sup class="text-danger">*</sup></label>
                                <input type="password" wire:model="password" class="form-control" placeholder="Enter Password">
                            </div>
                            @error('password') <span class="text-danger error">{{ $message }}</span> @enderror
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

    
    <div class="modal @if ($showModal) show @endif" tabindex="-1"
        style="opacity:1; background-color:#0606068c; display:@if ($showModal) block @endif">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form wire:submit.prevent="save">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ $isEdit ? 'Edit Staff' : 'Create Staff' }}</h4>
                        <button type="button" class="btn-close" wire:click="$set('showModal', false)"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body py-3">
                        @if ($errors->any())
                            <div class="alert alert-danger pb-0">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @csrf
                     
                        <div class="row g-3">
                            <!-- Name -->
                            <div class="col-md-6">
                                <label for="first_name" class="form-label">
                                    First Name <sup class="text-danger">*</sup>
                                </label>
                                <div class="input-group">
                                    <select name="user_title" id="user_title" wire:model="user_title" class="form-select"
                                        style="max-width: 80px;">
                                        <option value="">Select</option>
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
                        
                            <!-- Last Name -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Last Name<sup class="text-danger">*</sup></label>
                                    <input type="text" wire:model="lastname" class="form-control" placeholder="Enter Last Name">
                                </div>
                                @error('lastname') <span class="text-danger error">{{ $message }}</span> @enderror
                            </div>
                             <!-- Role -->
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Staff Type<sup class="text-danger">*</sup></label>
                                    <select class="form-select" wire:model="role">
                                        <option value="">Select Staff Type</option>
                                      @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                      @endforeach
                                    </select>

                                   @error('role') <span class="text-danger error">{{ $message }}</span> @enderror 
                                </div> 
                            </div>
                             <!-- Joining Date -->
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Joining Date</label>
                                    <input type="date" wire:model="joining_date" class="form-control">
                                </div> 
                            </div>
                         
                            <!-- Mobile Number -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Mobile Number<sup class="text-danger">*</sup></label>
                                    <input type="number" wire:model="mobile_no" class="form-control" placeholder="Enter Mobile Number">
                                </div>
                                @error('mobile_no') <span class="text-danger error">{{ $message }}</span> @enderror
                            </div>

                                
                            <!-- Salary -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Salary(₹)</label>
                                    <input type="number" wire:model="salary" class="form-control" placeholder="Enter Salary">
                                </div> 
                            </div>

                            <!-- Monthly Target -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Monthly Target(₹)</label>
                                    <input type="number" wire:model="monthly_target" class="form-control" placeholder="Enter Monthly Target">
                                </div>
                            </div>
                                
                            <!-- Incentives -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Incentives(%)</label>
                                    <input type="number" wire:model="incentives" class="form-control" placeholder="Enter Incentives">
                                </div> 
                            </div>
                        
                        
                            <div class="col-md-12">
                                <label class="form-label">Image</label>
                                <div class="form-group mt-2 d-flex justify-content-between">
                                    <div class="w-75">
                                        <input type="file" wire:model="document" class="form-control">
                                    </div>
                                
                                    @if ($document)
                                        <div>
                                            <a href="{{ $document->temporaryUrl() }}" download>
                                                <img src="{{ $document->temporaryUrl() }}" alt="Document Preview" class="img-thumbnail" style="max-width: 100px;">
                                            </a>
                                        </div>
                                    @else
                                        <div>
                                            <a href="{{ asset($oldDocument) }}" download>
                                                <img src="{{ asset($oldDocument) }}" alt="Document Preview" class="img-thumbnail" style="max-width: 100px;">
                                            </a>
                                        </div>
                                    @endif
                                
                                    @error('document')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
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
                        <button type="button" class="btn btn-secondary" wire:click="$set('showModal', false)"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                            {{ $isEdit ? 'Update' : 'Create' }}
                            <i class="spinner-border spinner-border-sm" wire:loading wire:target="save"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>






    <div class="card">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div class="breadcrumb-title pe-2" style="border: none;">Staff</div>
            @if ($user->hasPermissionTo('staff-add'))
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
                <input type="text" class="form-control" placeholder="Search " wire:model.live="searchfilter" fdprocessedid="blgf5">
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
                                <th>Profile</th> 
                                <th>Name</th> 
                                <th>Email</th> 
                                <th>Mobile Number</th> 
                                <th>Role</th> 
                                <th>User</th> 
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $index => $item)
                                <tr>
                                    <td>{{ $items->total() - ($items->firstItem() + $index) + 1 }}</td>
                                    <td>
                                        <img src="{{ asset($item->profileImage?->file) }}" alt="" width="70" height="70" class="img-thumbnail">
                                        </td>
                                    <td>{{ $item->name .' '. $item->lastname }}</td> 
                                    <td> @if($item->email != '') {{$item->email}} @else - @endif </td> 
                                    <td> {{ $item->mobile_no }} </td> 
                                    <td>{{ @$item->Role?->name}}
                                    </td>   
                                      <td>@if($item->is_user == 1) Yes @else No @endif
                                    </td> 
                                    <td>
                                        @if ($user->hasPermissionTo('staff-edit'))
                                        <a wire:click="edit({{ $item->id }})" class="btn btn-sm p-0"><i
                                                class="bx bxs-edit"></i> <span class="small"></span></a>
                                                @endif  @if ($user->hasPermissionTo('staff-delete'))
                                        <a wire:click="confirmDelete({{ $item->id }})"
                                            class="btn btn-sm p-0"><i class="fadeIn animated bx bx-trash"></i> <span
                                                class="small"></span></a>
                                                @endif
                                                @if($item->is_user == 0)
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
