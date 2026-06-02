<div>
    <!-- Success Message -->
    @if (session()->has('message'))
    <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <div class="card">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div class="breadcrumb-title pe-2" style="border: none;">Vehicle Brand</div>
            <div class="pe-3">
                <a href="javascript:;" wire:click="create" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i
                        class="bx bxs-plus-square"></i>Add</a>
            </div>
        </div>
    </div>

    <div class="modal @if ($showModal) show @endif" tabindex="-1"
    style="opacity:1; background-color:#0606068c; display:@if ($showModal) block @endif">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">
                <div class="modal-header">
                    <h4 class="modal-title">{{ $isEdit ? 'Edit Vehicle Brand' : 'Add Vehicle Brand' }}</h4>
                    <button type="button" class="btn-close" wire:click="$set('showModal', false)"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-3">
                    @csrf

                    <div class="row g-3"> 
            
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Vehicle Type<sup class="text-danger">*</sup></label> 
                                    <select  class="form-control" wire:model="vehicle_type" id="vehicle_type">
                                        <option value="">--Select Vehicle Type--</option>
                                        @foreach ($vehicleTypes as $vehicleType)
                                        <option value="{{ $vehicleType->id }}">{{ $vehicleType->vehicle_type }}</option>
                                        @endforeach
                                    </select>
                            </div>
                            @error('vehicle_type')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>  
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Vehicle Brand<sup class="text-danger">*</sup></label>
                                    <input type="text" wire:model="vehicle_brand" class="form-control"
                                        placeholder="Enter Vehicle Brand">
                                </div>
                                @error('vehicle_brand')
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


    <div class="card mt-4">
        @if (!empty($vehiclebrands) && $vehiclebrands->count())
        <div class="card-body ">
            <div class="table-responsive">
                <table class="table table--bordered data-table">
                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Vehicle Type</th>
                            <th>Vehicle Brand</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vehiclebrands as $index => $vehiclebrand)
                        <tr>
                            <td>{{ $vehiclebrands->total() - ($vehiclebrands->firstItem() + $index) + 1 }}</td>
                            <td>{{ $vehiclebrand->vehiclebrandtype->vehicle_type }}</td>
                            <td>{{ $vehiclebrand->vehicle_brand }}</td>
                            <td>
                                <a wire:click="edit({{ $vehiclebrand->id }})" class="btn btn-sm p-0"><i
                                        class="bx bxs-edit"></i> <span class="small"></span></a>
                                <a wire:click="confirmDelete({{ $vehiclebrand->id }})"
                                    class="btn btn-sm p-0"><i class="fadeIn animated bx bx-trash"></i> <span
                                        class="small"></span></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination-wrapper">
                    {{ $vehiclebrands->links() }}
                </div>
            </div>
        </div>
        @else
        <div class="my-2">
            <div class="alert alert-info">No Vehicle Brand found!</div>
        </div>
        @endif
    </div>

</div>
@section('footerscript')
@endsection