<div>
    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    @php
        $admin = App\Models\Admin::where('id', $adminId)->first();
    @endphp
    <!-- Add/Edit Modal -->
    <div class="modal @if ($showModal) show @endif" tabindex="-1"
        style="opacity:1; background-color:#0606068c; display:@if ($showModal) block @endif">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ $isEdit ? 'Edit Brand' : 'Create Brand' }}</h4>
                        <button type="button" class="btn-close" wire:click="colseModel" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body py-3">
                        @csrf
                        <div class="row g-3">
                            <!-- Name -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Title<sup class="text-danger">*</sup></label>
                                    <input type="text" wire:model="title" class="form-control"
                                        placeholder="Enter Title">
                                </div>
                                @error('title')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Status<sup class="text-danger">*</sup></label>
                                    <select class="form-select" wire:model="status">
                                        <option value="">Select Status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                                @error('status')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="colseModel"
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
            <div class="breadcrumb-title pe-2" style="border: none;"><i class="bx bx-user"></i> Brand</div>
        </div>
    </div>
    @if (@$admin->hasPermissionTo('makers-type-add'))
        <div class="card mt-4">
            <div class="card-header py-3">
                <h5>Create Brand</h5>
            </div>
            <div class="card-body">
                <form wire:submit="store">
                    <div class="row g-3">
                        <!-- Name -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Title<sup class="text-danger">*</sup></label>
                                <input type="text" wire:model="title"
                                    class="form-control @error('title') is-invalid @enderror" placeholder="Enter Title">
                            </div>
                            @error('title')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Status<sup class="text-danger">*</sup></label>
                                <select class="form-select" wire:model="status">
                                    <option value="">Select Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            @error('status')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                                Create
                                <i class="spinner-border spinner-border-sm" wire:loading wire:target="store"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <div class="card mt-4">
        <div class="card-header py-3">
            <h5>Brand List</h5>
            <div class="row g-3">
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Search Title" wire:model.live="search">
                </div>
                <div class="col-auto">
                    <div class="form-group">
                        <select class="form-select" wire:model.change="status_filter">
                            <option value="">Select Status</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="col-auto text-right">
                    <button type="button" class="mr-2 btn btn-info text-white rounded-0  float-end"
                        wire:click="resetFilter" fdprocessedid="orntg">Clear</button>
                </div>
            </div>
        </div>
        @if ($items->count())
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Title</th>
                                <th>Status</th>
                                @if (@$admin->hasPermissionTo('makers-type-edit') || @$admin->hasPermissionTo('makers-type-delete'))
                                    <th>Actions</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $index => $item)
                                <tr>
                                    <td>{{ $items->total() - ($items->firstItem() + $index) + 1 }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox"
                                                wire:change="toggleStatus({{ $item->id }}, {{ $item->status == 1 ? 0 : 1 }})"
                                                {{ $item->status == 1 ? 'checked' : '' }}
                                                id="toggleStatus{{ $item->id }}">
                                        </div>
                                    </td>
                                    @if (@$admin->hasPermissionTo('makers-type-edit') || @$admin->hasPermissionTo('makers-type-delete'))
                                        <td>
                                            @if (@$admin->hasPermissionTo('makers-type-edit'))
                                                <a wire:click="edit({{ $item->id }})" class="btn btn-sm p-0"><i
                                                        class="bx bxs-edit"></i></a>
                                            @endif
                                            @if (@$admin->hasPermissionTo('makers-type-delete'))
                                                <a wire:click="confirmDelete({{ $item->id }})"
                                                    class="btn btn-sm p-0"><i
                                                        class="fadeIn animated bx bx-trash"></i></a>
                                            @endif
                                        </td>
                                    @endif
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
                <div class="alert alert-info">No Brand found!</div>
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
