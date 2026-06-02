 
<div>
    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <!-- Add/Edit Modal -->
    @php
        $sparePart = App\Models\SparePartVendor::where('id', $adminId)->first();
    @endphp

    <div class="modal @if ($showModal) show @endif" tabindex="-1"
        style="opacity:1; background-color:#0606068c; display:@if ($showModal) block @endif">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ $isEdit ? 'Edit Role' : 'Create Role' }}</h4>
                        <button type="button" class="btn-close" wire:click="$set('showModal', false)"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body py-3">
                        @csrf 
                        <div class="row g-3">
                            <!-- Name -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Role Name<sup class="text-danger">*</sup></label>
                                    <input type="text" wire:model="roleName" class="form-control" placeholder="Enter Role Name">
                                </div>
                                @error('roleName') <span class="text-danger error">{{ $message }}</span> @enderror
                            </div> 
                            
                            <div class="col-md-12">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="frmInputGroup">
                                        <label class="form-label">Permission</label>
                                    </div>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Menu</th>
                                                <th scope="col">List</th>
                                                <th scope="col">Add</th>
                                                <th scope="col">Edit</th>
                                                <th scope="col">Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($menus as $mkey => $mvalue)
                                            <tr>
                                                <th scope="row">{{ ucfirst($mkey) }}</th>
                                                @foreach ($mvalue as $pkey => $pvalue)
                                                    <td>
                                                        <input
                                                            class="name{{ $mkey }}"
                                                            type="checkbox"
                                                            value="{{ $pvalue['name'] }}"
                                                            wire:model="permissions"
                                                            @if(in_array($pvalue['name'], $permissions)) checked @endif
                                                        >
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                        
                                        </tbody>
                                    </table>
                                </div>
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
            <div class="breadcrumb-title pe-2" style="border: none;">Role</div>
            <div class="pe-3">
                @if ($user->hasPermissionTo('roles-add'))
                <a href="javascript:;" wire:click="create" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i
                        class="bx bxs-plus-square"></i>Add</a>
                        @endif
            </div>
        </div>
    </div> 
    <div class="card mt-4">
        @if (!empty($roles) && $roles->count())
        <div class="card-body ">
            <div class="table-responsive">
                <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Name</th> 
                                <th>Action</th> 
                            </tr>
                        </thead>
                        <tbody>
                           
                            @foreach ($roles as $index => $role)
                                <tr>
                                    <td>{{ $roles->total() - ($roles->firstItem() + $index) + 1 }}</td>
                                    <td>{{ $role->name}}</td> 
                                    <td>
                                        @if ($user->hasPermissionTo('roles-edit'))
                                        <a wire:click="edit({{ $role->id }})" class="btn btn-sm p-0"><i
                                                class="bx bxs-edit"></i> <span class="small"></span></a>
                                                @endif
                                                @if ($user->hasPermissionTo('roles-delete'))
                                        <a wire:click="confirmDelete({{ $role->id }})"
                                            class="btn btn-sm p-0"><i class="fadeIn animated bx bx-trash"></i> <span
                                                class="small"></span></a>
                                                @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="pagination-wrapper">
                        {{ $roles->links() }} 
                    </div>
                </div>
            </div>
        @else
            <div class="my-2">
                <div class="alert alert-info">No Roles Found!</div>
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
