 <div>
     <!-- Success Message -->
     @if (session()->has('message'))
         <div class="alert alert-success">{{ session('message') }}</div>
     @endif

     <!-- Add/Edit Modal -->

     <div class="modal @if ($showModal) show @endif" tabindex="-1"
         style="opacity:1; background-color:#0606068c; display:@if ($showModal) block @endif">
         <div class="modal-dialog modal-md">
             <div class="modal-content">
                 <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">
                     <div class="modal-header">
                         <h4 class="modal-title">{{ $isEdit ? 'Edit permission' : 'Create permission' }}</h4>
                         <button type="button" class="btn-close" wire:click="$set('showModal', false)"
                             data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body py-3">
                         @csrf
                         <div class="row g-3">
                             <!-- Name -->
                             <div class="col-md-12">
                                 <div class="form-group">
                                     <label class="form-label">permission Name<sup class="text-danger">*</sup></label>
                                     <input type="text" wire:model="permissionName" class="form-control"
                                         placeholder="Enter permission Name">
                                 </div>
                                 @error('permissionName')
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
             <div class="breadcrumb-title pe-2" style="border: none;">permissions</div>
             <div class="pe-3">
                 <a href="javascript:;" wire:click="create" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i
                         class="bx bxs-plus-square"></i>Add</a>
             </div>
         </div>
     </div>
     <div class="card mt-4">
         <div class="card-header">
             <div class="row g-3 align-items-center">
                 <div class="col-3">
                     <input type="text" wire:model.live.debounce:30s="search" class="form-control"
                         placeholder="Search Here...">
                 </div>
                 <div class="col-1">
                     <button class="btn btn-primary btn-sm" type="button" wire:click="clearFilter">clear</button>
                 </div>
             </div>
         </div>
         @if (!empty($permissions) && $permissions->count())
             <div class="card-body ">
                 <div class="table-responsive">
                     <table class="table table-bordered data-table">
                         <thead>
                             <tr>
                                 <th>S.No.</th>
                                 <th>Name</th>
                             </tr>
                         </thead>
                         <tbody>

                             @foreach ($permissions as $index => $permission)
                                 <tr>
                                     <td>{{ $permissions->total() - ($permissions->firstItem() + $index) + 1 }}</td>
                                     <td>{{ $permission->name }}</td>
                                     <td>
                                         {{-- <a wire:click="edit({{ $permission->id }})" class="btn btn-sm p-0"><i
                                                class="bx bxs-edit"></i> <span class="small"></span></a> --}}
                                         <a wire:click="confirmDelete({{ $permission->id }})" class="btn btn-sm p-0"><i
                                                 class="fadeIn animated bx bx-trash"></i> <span
                                                 class="small"></span></a>
                                     </td>
                                 </tr>
                             @endforeach
                         </tbody>
                     </table>
                     <div class="pagination-wrapper">
                         {{ $permissions->links() }}
                     </div>
                 </div>
             </div>
         @else
             <div class="my-2">
                 <div class="alert alert-info">No Permission Found!</div>
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
 @endsection
