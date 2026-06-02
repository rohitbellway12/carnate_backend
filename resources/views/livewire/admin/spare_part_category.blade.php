<div>
    <!-- Success Message -->
    @if (session()->has('message'))
    <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    @php
            $admin = App\Models\Admin::where('id', $adminId)->first();
    @endphp     

    <div class="card">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div class="breadcrumb-title pe-2" style="border: none;"><i class="fas fa-tools fs-5"></i> Spare Part Category</div>
            @if (@$admin->hasPermissionTo('spare-part-category-add'))
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
                <input type="text" class="form-control" placeholder="Search title" wire:model.live="searchfilter" fdprocessedid="blgf5">
            </div>
            <div class="col-9 text-right">
                <button type="button" class="mr-2 btn btn-info text-white rounded-0  float-end" wire:click="resetFilter" fdprocessedid="orntg">Clear</button>
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
                    <h4 class="modal-title">{{ $isEdit ? 'Edit Spare Part Category' : 'Add Spare Part Category' }}</h4>
                    <button type="button" class="btn-close" wire:click="closeModel"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-3">
                    @csrf

                    <div class="row g-3"> 
            

                            <!-- Spare Part Label -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Spare Part Category<sup class="text-danger">*</sup></label>
                                    <input type="text" wire:model="category_title" class="form-control"
                                        placeholder="Enter Spare Part Category">
                                </div>
                                @error('category_title')
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

    <div class="card mt-4">
        @if (!empty($categories) && $categories->count())
        <div class="card-body ">
            <div class="table-responsive">
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Title</th>
                            <th>Date</th>
                            @if (@$admin->hasPermissionTo('spare-part-category-edit') || @$admin->hasPermissionTo('spare-part-category-delete'))
                            <th>Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $index => $categorie)
                        <tr>
                            <td>{{ $categories->total() - ($categories->firstItem() + $index) + 1 }}</td>
                            <td>{{ $categorie->title}}</td>
                            <td> {{ $categorie->created_at->timezone('Asia/Kolkata')->format('d-m-Y h:i A') }}</td>
                            @if (@$admin->hasPermissionTo('spare-part-category-edit') || @$admin->hasPermissionTo('spare-part-category-delete'))
                                <td>
                                    @if (@$admin->hasPermissionTo('spare-part-category-edit'))
                                        <a wire:click="edit({{ $categorie->id }})" class="btn btn-sm p-0"><i
                                                class="bx bxs-edit"></i> <span class="small"></span></a>
                                    @endif
                                    @if (@$admin->hasPermissionTo('spare-part-category-delete'))
                                        <a wire:click="confirmDelete({{ $categorie->id }})"
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
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
        @else
        <div class="my-2">
            <div class="alert alert-info">No Spare Part Category found!</div>
        </div>
        @endif
    </div>

</div>
@section('footerscript')
@endsection