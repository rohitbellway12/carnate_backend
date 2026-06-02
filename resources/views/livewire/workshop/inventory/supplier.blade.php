<div>
    <!-- Top Bar with Add Button -->
    <!-- <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Suppliers</h4>
        <button class="btn btn-primary radius-30 mt-2 mt-lg-0"  wire:click="openModal">
<i class="bx bxs-plus-square"></i>Add</button>
    </div> -->


    <div class="card">
    <div class="card-body d-flex justify-content-between align-items-center">
        <div class="breadcrumb-title pe-2 mb-0" style="border: none;">Suppliers</div>
        <div class="row">
            <div class="pe-3">
                <a href="javascript:;" wire:click="openModal" class="btn btn-primary radius-30 mt-2 mt-lg-0">
                    <i class="bx bxs-plus-square"></i> Add
                </a>
            </div>
        </div>
    </div>
</div>






    
    <!-- <div class="mb-3 d-flex align-items-center">
        <input type="text" wire:model.live="search" class="form-control w-25 me-2" placeholder="Search by First Name or Mobile No.">
        <button type="button" class="btn btn-info text-white" wire:click="clearSearch">Clear</button>
    </div> -->
    <div class="card mt-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                <input type="text" wire:model.live="search" class="form-control w-auto" style="min-width: 300px;" placeholder="Search by First Name or Mobile No.">
                <button type="button" class="btn btn-info text-white rounded-0" wire:click="clearSearch">
                    Clear
                </button>
            </div>
        </div>
   </div>



    <!-- Add/Edit Modal -->
    <div class="modal @if ($showModal) show @endif" tabindex="-1" style="opacity:1; background-color:#0606068c; @if ($showModal) display:block; @else display:none; @endif">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ $isEdit ? 'Edit Supplier' : 'Add Supplier' }}</h4>
                        <button type="button" class="btn-close" wire:click="closeModal" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body py-3">
                        <div class="row g-3">
                            <!-- Mobile No -->
                            <div class="col-md-6">
                                <label class="form-label">Mobile No.<span class="text-danger">*</span></label>
                                <input type="text" wire:model.lazy="mobile_no" class="form-control" placeholder="Enter Mobile No.">
                                @error('mobile_no') <span class="text-danger error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <hr>
                        <h5>Business Info</h5>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">First Name <sup class="text-danger">*</sup></label>
                                <input type="text" wire:model="business_first_name" class="form-control" placeholder="Enter First Name">
                                @error('business_first_name') <span class="text-danger error">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Address</label>
                                <input type="text" wire:model="business_address" class="form-control" placeholder="Enter Address">
                                @error('business_address') <span class="text-danger error">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">GSTIN</label>
                                <input type="text" wire:model="gstin" class="form-control" placeholder="Enter GSTIN">
                                @error('gstin') <span class="text-danger error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <hr>
                        <h5>Owner Info</h5>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">First Name <sup class="text-danger">*</sup></label>
                                <input type="text" wire:model="owner_first_name" class="form-control" placeholder="Enter First Name">
                                @error('owner_first_name') <span class="text-danger error">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Contact 1 <sup class="text-danger">*</sup></label>
                                <input type="text" wire:model="contact_1" class="form-control" placeholder="Enter Contact 1">
                                @error('contact_1') <span class="text-danger error">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Contact 2</label>
                                <input type="text" wire:model="contact_2" class="form-control" placeholder="Enter Contact 2">
                                @error('contact_2') <span class="text-danger error">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Email</label>
                                <input type="email" wire:model="email" class="form-control" placeholder="Enter Email">
                                @error('email') <span class="text-danger error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-secondary" wire:click="closeModal" data-bs-dismiss="modal">Cancel</button> -->
                        <button type="submit" class="btn btn-primary">
                            {{ $isEdit ? 'Update' : 'Save' }}
                            <i class="spinner-border spinner-border-sm" wire:loading></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- SupplierTable -->
<div class="card mt-4">
    <div class="card-body">

    <div class="table-responsive">
        <!-- <table class="table table-bordered table-striped align-middle"> -->
        <table class="table table-bordered data-table">
            <thead class="table-light">
                <tr>
                    <th>Sr No.</th>
                    <th>First Name</th>
                    <th>Supplier Name</th>
                    <th>Contact No.</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>GSTIN</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($suppliers as $supplier)
                    <tr>
                        <td>{{ $loop->iteration + ($suppliers->firstItem() - 1) }}</td>
                        <td>{{ $supplier->business_first_name }}</td>
                        <td>{{ $supplier->owner_first_name }}</td>
                        <td>{{ $supplier->mobile_no }}</td>
                        <td>{{ $supplier->email }}</td>
                        <td>{{ $supplier->business_address }}</td>
                        <td>{{ $supplier->gstin }}</td>
                        <td>
                            <i class="bx bxs-edit me-2 " wire:click="edit({{ $supplier->id }})" style="cursor: pointer; font-size: 20px;"></i>
                            <i class="bx bxs-trash me-2" wire:click="confirmDelete({{ $supplier->id }})" style="cursor: pointer; font-size: 20px;"></i>
                        </td>
                    </tr>
                @endforeach
                @if ($suppliers->isEmpty())
                    <tr>
                        <td colspan="8" class="text-center">No suppliers found.</td>
                    </tr>
                @endif
            </tbody>
        </table>
        
    </div>
</div>

</div>
    <div class="mt-3">
        {{ $suppliers->links() }}
    </div>
</div>


