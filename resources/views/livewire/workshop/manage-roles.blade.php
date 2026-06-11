 
<div>
    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <!-- Add/Edit Modal -->

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
                                    <div class="table-responsive" style="max-height: 400px; overflow-y: auto; border: 1px solid #dee2e6; border-radius: 4px; padding: 5px; background-color: #fff;">
                                        <table class="table table-striped table-hover align-middle mb-0">
                                            <thead>
                                                <tr style="position: sticky; top: 0; background-color: #f8f9fa; z-index: 10; box-shadow: inset 0 -2px 0 #dee2e6;">
                                                    <th scope="col" style="min-width: 150px;">Menu / Module</th>
                                                    <th scope="col" class="text-center" style="width: 10%;">List</th>
                                                    <th scope="col" class="text-center" style="width: 10%;">Add</th>
                                                    <th scope="col" class="text-center" style="width: 10%;">Edit</th>
                                                    <th scope="col" class="text-center" style="width: 10%;">Delete</th>
                                                    <th scope="col" style="min-width: 250px;">Additional Permissions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($menus as $mkey => $mvalue)
                                                    @php
                                                        $showPerm = null;
                                                        $addPerm = null;
                                                        $editPerm = null;
                                                        $deletePerm = null;
                                                        $customPerms = [];

                                                        foreach ($mvalue as $p) {
                                                            $name = $p['name'];
                                                            if (strcasecmp($name, $mkey . '-show') === 0) {
                                                                $showPerm = $p;
                                                            } elseif (strcasecmp($name, $mkey . '-add') === 0) {
                                                                $addPerm = $p;
                                                            } elseif (strcasecmp($name, $mkey . '-edit') === 0) {
                                                                $editPerm = $p;
                                                            } elseif (strcasecmp($name, $mkey . '-delete') === 0) {
                                                                $deletePerm = $p;
                                                            } else {
                                                                $customPerms[] = $p;
                                                            }
                                                        }
                                                    @endphp
                                                    <tr>
                                                        <th scope="row" class="text-dark" style="font-size: 13px;">
                                                            {{ ucwords(str_replace(['-', '_'], ' ', $mkey)) }}
                                                        </th>
                                                        
                                                        <!-- List -->
                                                        <td class="text-center">
                                                            @if ($showPerm)
                                                                <input
                                                                    type="checkbox"
                                                                    value="{{ $showPerm['name'] }}"
                                                                    wire:model="permissions"
                                                                    class="form-check-input"
                                                                    style="cursor: pointer; width: 1.25em; height: 1.25em;"
                                                                    @if(in_array($showPerm['name'], $permissions)) checked @endif
                                                                >
                                                            @else
                                                                <span class="text-muted small">-</span>
                                                            @endif
                                                        </td>

                                                        <!-- Add -->
                                                        <td class="text-center">
                                                            @if ($addPerm)
                                                                <input
                                                                    type="checkbox"
                                                                    value="{{ $addPerm['name'] }}"
                                                                    wire:model="permissions"
                                                                    class="form-check-input"
                                                                    style="cursor: pointer; width: 1.25em; height: 1.25em;"
                                                                    @if(in_array($addPerm['name'], $permissions)) checked @endif
                                                                >
                                                            @else
                                                                <span class="text-muted small">-</span>
                                                            @endif
                                                        </td>

                                                        <!-- Edit -->
                                                        <td class="text-center">
                                                            @if ($editPerm)
                                                                <input
                                                                    type="checkbox"
                                                                    value="{{ $editPerm['name'] }}"
                                                                    wire:model="permissions"
                                                                    class="form-check-input"
                                                                    style="cursor: pointer; width: 1.25em; height: 1.25em;"
                                                                    @if(in_array($editPerm['name'], $permissions)) checked @endif
                                                                >
                                                            @else
                                                                <span class="text-muted small">-</span>
                                                            @endif
                                                        </td>

                                                        <!-- Delete -->
                                                        <td class="text-center">
                                                            @if ($deletePerm)
                                                                <input
                                                                    type="checkbox"
                                                                    value="{{ $deletePerm['name'] }}"
                                                                    wire:model="permissions"
                                                                    class="form-check-input"
                                                                    style="cursor: pointer; width: 1.25em; height: 1.25em;"
                                                                    @if(in_array($deletePerm['name'], $permissions)) checked @endif
                                                                >
                                                            @else
                                                                <span class="text-muted small">-</span>
                                                            @endif
                                                        </td>

                                                        <!-- Additional Permissions -->
                                                        <td>
                                                            @if (count($customPerms) > 0)
                                                                <div class="d-flex flex-column gap-1">
                                                                    @foreach ($customPerms as $cp)
                                                                        <div class="form-check d-flex align-items-center gap-1 m-0">
                                                                            <input
                                                                                type="checkbox"
                                                                                value="{{ $cp['name'] }}"
                                                                                wire:model="permissions"
                                                                                class="form-check-input m-0"
                                                                                style="cursor: pointer; width: 1.15em; height: 1.15em;"
                                                                                id="perm_{{ $cp['id'] }}"
                                                                                @if(in_array($cp['name'], $permissions)) checked @endif
                                                                            >
                                                                            <label class="form-check-label text-wrap" for="perm_{{ $cp['id'] }}" style="cursor: pointer; font-size: 11px; font-weight: 500; line-height: 1.2;">
                                                                                {{ ucwords(str_replace(['-', '_'], ' ', $cp['name'])) }}
                                                                            </label>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            @else
                                                                <span class="text-muted small">-</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
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
            <div class="breadcrumb-title pe-2" style="border: none;">Roles</div>
            <div class="pe-3">
                @if ($user->hasPermissionTo('role-add'))
                <a href="javascript:;" wire:click="create" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i
                        class="bx bxs-plus-square"></i>Add</a>
                        @endif
            </div>
        </div>
    </div> 
        <div class="card mt-4">
        <div class="card-body">
            <div class="row">
            <div class="col-3">
                <input type="text" class="form-control" placeholder="Search Name" wire:model.live="searchfilter" fdprocessedid="blgf5">
            </div>
            <div class="col-9 text-right">
                <button type="button" class="mr-2 btn btn-info text-white rounded-0  float-end" wire:click="resetFilter" fdprocessedid="orntg">Clear</button>
             </div>
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
                                        {{-- @if ($user->hasPermissionTo('role-add')) --}}
                                        <a wire:click="edit({{ $role->id }})" class="btn btn-sm p-0"><i
                                                class="bx bxs-edit"></i> <span class="small"></span></a>
                                                {{-- @endif --}}
                                                {{-- @if ($user->hasPermissionTo('role-add')) --}}
                                        <a wire:click="confirmDelete({{ $role->id }})"
                                            class="btn btn-sm p-0"><i class="fadeIn animated bx bx-trash"></i> <span
                                                class="small"></span></a>
                                                {{-- @endif --}}
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
