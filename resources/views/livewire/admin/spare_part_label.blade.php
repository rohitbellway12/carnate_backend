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
            <div class="breadcrumb-title pe-2" style="border: none;"><i class="fas fa-tools fs-5"></i> Spare Part Label</div>
            @if (@$admin->hasPermissionTo('spare-part-label-add'))
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
                <input type="text" class="form-control" placeholder="Search Title" wire:model.live="searchfilter" fdprocessedid="blgf5">
            </div> 
            <div class="col-3">
                <div class="form-group">
                    <select class="form-control" wire:model.live="searchcategory" >
                        <option value="" selected="" >--Select Category--</option>
                        <option value="1">Accessory</option>
                        <option value="2">Parts</option>
                        <option value="3">Tools</option>
                        <option value="4">Lubes</option>
                    </select>
                  </div>
            </div>
            <div class="col-6 text-right">
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
                    <h4 class="modal-title">{{ $isEdit ? 'Edit Spare Part Label' : 'Add Spare Part Label' }}</h4>
                    <button type="button" class="btn-close" wire:click="closeModel"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-3">
                    @csrf

                    <div class="row g-3"> 
                        <!-- Country -->
                        <div class="@if ($isEdit == true) col-md-6 @else col-md-6 @endif">
                            <div class="form-group">
                                <label class="form-label">Category<sup class="text-danger">*</sup></label>
                                <select class="form-control" wire:model="sparepart_category"  >
                                    <option value="" selected="" disabled="">--Select Category--</option>
                                    <option value="1">Accessory</option>
                                    <option value="2">Parts</option>
                                    <option value="3">Tools</option>
                                    <option value="4">Lubes</option>
                                </select>
                            </div>
                            @error('sparepart_category')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
 

                            <!-- Spare Part Label -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Spare Part Label<sup class="text-danger">*</sup></label>
                                    <input type="text" wire:model="sparepart_label" class="form-control"
                                        placeholder="Enter Spare Part Label">
                                </div>
                                @error('sparepart_label')
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
        @if (!empty($spareparelabels) && $spareparelabels->count())
        <div class="card-body ">
            <div class="table-responsive">
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Date</th>
                            @if (@$admin->hasPermissionTo('spare-part-label-edit') || @$admin->hasPermissionTo('spare-part-label-delete'))
                            <th>Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($spareparelabels as $index => $spareparelabel)
                        <tr>
                            <td>{{ $spareparelabels->total() - ($spareparelabels->firstItem() + $index) + 1 }}</td>
                            <td>{{ $spareparelabel->title}}</td>
                            <td>
                                @switch( $spareparelabel->spare_part_type)
                                @case(1)
                                Accessory
                                @break
                                @case(2)
                                Parts
                                @break
                                @case(3)
                                Tools
                                @break
                                @case(4)
                                Lubricants
                                @endswitch
                            </td>
                            <td> {{ $spareparelabel->created_at->timezone('Asia/Kolkata')->format('d-m-Y h:i A') }}</td>
                            @if (@$admin->hasPermissionTo('spare-part-label-edit') || @$admin->hasPermissionTo('spare-part-label-delete'))
                            <td>
                                @if (@$admin->hasPermissionTo('spare-part-label-edit'))
                                    <a wire:click="edit({{ $spareparelabel->id }})" class="btn btn-sm p-0"><i
                                            class="bx bxs-edit"></i> <span class="small"></span></a>
                                    @endif
                                @if (@$admin->hasPermissionTo('spare-part-label-delete'))
                                    <a wire:click="confirmDelete({{ $spareparelabel->id }})"
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
                    {{ $spareparelabels->links() }}
                </div>
            </div>
        </div>
        @else
        <div class="my-2">
            <div class="alert alert-info">No Spare Part Label found!</div>
        </div>
        @endif
    </div>

</div>
@section('footerscript')
@endsection