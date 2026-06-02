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
                         <h4 class="modal-title">{{ $isEdit ? 'Edit Unit' : 'Create Unit' }}</h4>
                         <button type="button" class="btn-close" wire:click="closeModal"
                             data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body py-3">
                         @csrf

                         <div class="row g-3">
                             <!-- Title -->
                             <div class="col-md-12">
                                 <div class="form-group">
                                     <label class="form-label">Title</label>
                                     <input type="text" wire:model="title" class="form-control"
                                         placeholder="Enter Title">
                                 </div>
                                 @error('title')
                                     <span class="text-danger error">{{ $message }}</span>
                                 @enderror
                             </div>
                         </div>

                     </div>
                     <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" wire:click="closeModal"
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
             <div class="breadcrumb-title pe-2" style="border: none;">Unit</div>
             <div class="pe-3 d-md-none">
                 <a href="javascript:;" wire:click="create" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i
                         class="bx bxs-plus-square"></i>Add</a>
             </div>
         </div>
     </div>
     <div class="row">
         <div class="col-md-6">
             <div class="card">
                 <div class="card-header">
                    <h4>Unit List</h4>
                     <div class="row g-3">
                         <div class="col-6">
                             <input type="text" class="form-control" placeholder="Search "
                                 wire:model.live="searchfilter" fdprocessedid="blgf5">
                         </div>
                         <div class="col-6 text-right">
                             <button type="button" class="mr-2 btn btn-info text-white rounded-0  float-end"
                                 wire:click="resetFilter" fdprocessedid="orntg">Clear</button>
                         </div>
                     </div>
                 </div>
                 @if (!empty($units) && $units->count())
                     <div class="card-body ">
                         <div class="table-responsive">
                             <table class="table table-bordered data-table">
                                 <thead>
                                     <tr>
                                         <th>S.No.</th>
                                         <th>Title</th>
                                         <th>Actions</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     @foreach ($units as $index => $unit)
                                         <tr>
                                            <td>{{ $units->total() - ($units->firstItem() + $index) + 1 }}</td>
                                             <td>{{ $unit->title }}</td>
                                             <td>
                                                <a wire:click="edit({{ $unit->id }})" class="btn btn-sm p-0"><i
                                                        class="bx bxs-edit"></i> <span class="small"></span></a>
                                                <a wire:click="confirmDelete({{ $unit->id }})"
                                                    class="btn btn-sm p-0"><i class="fadeIn animated bx bx-trash"></i> <span
                                                        class="small"></span></a>
                                            </td>
                                         </tr>
                                     @endforeach
                                 </tbody>
                             </table>
                             <div class="pagination-wrapper">
                                 {{ $units->links() }}
                             </div>
                         </div>
                     </div>
                 @else
                     <div class="my-2">
                         <div class="alert alert-info">No Customer found!</div>
                     </div>
                 @endif
             </div>
         </div>
         <div class="col-md-6 d-none d-md-block">
             <div class="card">
                 <div class="card-body">
                     <form wire:submit.prevent="store">
                         <div class="">
                             <h4 class="">Create Unit</h4>
                         </div>
                         <div class="py-3">
                             @csrf

                             <div class="row g-3">
                                 <!-- Title -->
                                 <div class="col-md-12">
                                     <div class="form-group">
                                         <label class="form-label">Title</label>
                                         <input type="text" wire:model="title" class="form-control"
                                             placeholder="Enter Title">
                                     </div>
                                     @error('title')
                                         <span class="text-danger error">{{ $message }}</span>
                                     @enderror
                                 </div>
                             </div>

                         </div>
                         <div class="">
                             @if (@$sparePart->hasPermissionTo('unit-add'))
                                 <button type="submit" class="btn btn-primary">
                                     Create
                                     <i class="spinner-border spinner-border-sm" wire:loading></i>
                                 </button>
                             @endif
                         </div>
                     </form>
                 </div>
             </div>
         </div>
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
