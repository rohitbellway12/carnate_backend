<div>
    @php
        $sparePart = \App\Models\SparePartVendor::where('id', \Illuminate\Support\Facades\Auth::guard('sparepart')->user()->id)->first();
    @endphp

    <div class="card">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div class="breadcrumb-title pe-2">Expense Category</div>
            <div>
                {{-- @if (@$sparePart->hasPermissionTo('expense-category-add')) --}}
                <a href="javascript:;" wire:click="create" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i class="bx bxs-plus-square"></i> Add</a>
                {{-- @endif --}}
            </div>
        </div>
    </div>
    <div class="card mt-4">
        <div class="card-body">
            <div class="row">
                <div class="col-3">
                    <input type="text" class="form-control" placeholder="Search Title" wire:model.live="searchfilter">
                </div>
                <div class="col-9 text-right">
                    <button type="button" class="btn btn-info text-white rounded-0 float-end" wire:click="resetFilter">Clear</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal @if ($showModal) show @endif" tabindex="-1" style="opacity:1; background-color:#0606068c; display:@if ($showModal) block @endif">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ $isEdit ? 'Edit Expense Category' : 'Add Expense Category' }}</h4>
                        <button type="button" class="btn-close" wire:click="closeModel"></button>
                    </div>
                    <div class="modal-body py-3">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Expense Category <sup class="text-danger">*</sup></label>
                                    <input type="text" wire:model="title" class="form-control" placeholder="Enter Expense Category">
                                </div>
                                @error('title') <span class="text-danger error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModel">Cancel</button>
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
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Title</th>
                            <th>Date</th>
                            {{-- @if (@$sparePart->hasPermissionTo('expense-category-edit') || @$sparePart->hasPermissionTo('expense-category-delete')) --}}
                            <th>Actions</th>
                            {{-- @endif --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $index => $category)
                            <tr>
                                <td>{{ $categories->firstItem() + $index }}</td>
                                <td>{{ $category->title }}</td>
                                <td>{{ \Carbon\Carbon::parse($category->created_at)->format('d-m-Y h:i A') }}</td>
                                {{-- @if (@$sparePart->hasPermissionTo('expense-category-edit') || @$sparePart->hasPermissionTo('expense-category-delete')) --}}        
                                <td>
                                    {{-- @if (@$sparePart->hasPermissionTo('expense-category-edit')) --}}
                                        <a wire:click="edit({{ $category->id }})" class="btn btn-sm p-0"><i class="bx bxs-edit"></i></a>
                                    {{-- @endif --}}
                                    {{-- @if (@$sparePart->hasPermissionTo('expense-category-delete')) --}}
                                        <a wire:click="confirmDelete({{ $category->id }})" class="btn btn-sm p-0"><i class="bx bx-trash"></i></a>
                                    {{-- @endif --}}
                                </td>
                                {{-- @endif --}}
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
            <div class="alert alert-info">No Expense Category found!</div>
        </div>
        @endif
    </div>
</div>
