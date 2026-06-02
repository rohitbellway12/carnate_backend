<div>
    <style>
        .filter-card { border-radius: 12px; border: none; box-shadow: 0 4px 15px rgba(0,0,0,0.05); transition: all 0.3s ease; }
        .table-card { border-radius: 12px; border: none; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .custom-badge { padding: 5px 12px; border-radius: 20px; font-weight: 500; font-size: 0.8rem; }
        .badge-active { background: #e3f9e5; color: #1f7a24; }
        .badge-inactive { background: #fee2e2; color: #b91c1c; }
        .search-input { border-radius: 8px; border: 1px solid #e2e8f0; padding: 10px 15px; }
        .search-input:focus { box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.2); border-color: #63b3ed; }
        .filter-label { font-size: 0.85rem; font-weight: 600; color: #4a5568; margin-bottom: 5px; }
        .action-btn { width: 32px; height: 32px; display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; transition: all 0.2s; margin: 0 2px; }
        .btn-edit { background: #f0f7ff; color: #007bff; }
        .btn-edit:hover { background: #007bff; color: white; }
        .btn-delete { background: #fff5f5; color: #dc3545; }
        .btn-delete:hover { background: #dc3545; color: white; }
        .table thead th { background: #f8fafc; border-bottom: 2px solid #e2e8f0; color: #475569; font-weight: 600; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.025em; }
        .modal-content { border-radius: 15px; border: none; }
        .modal-header { border-bottom: 1px solid #f1f5f9; padding: 1.5rem; }
        .modal-footer { border-top: 1px solid #f1f5f9; padding: 1.25rem; }
    </style>

    @php
        $admin = App\Models\Admin::where('id', $adminId)->first();
    @endphp

    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Add/Edit Modal -->
    <div class="modal fade @if ($showModal) show @endif" id="modModal" tabindex="-1"
        style="display:@if ($showModal) block @endif; background: rgba(0,0,0,0.5);" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content shadow-lg">
                <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">
                    <div class="modal-header bg-light">
                        <h5 class="modal-title fw-bold text-dark">
                            <i class="bx {{ $isEdit ? 'bx-edit' : 'bx-plus-circle' }} me-2"></i>
                            {{ $isEdit ? 'Update' : 'New' }} Modification
                        </h5>
                        <button type="button" class="btn-close" wire:click="$set('showModal', false)"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row g-4">
                            <div class="col-md-12">
                                <label class="filter-label">Modification Title / Engine Name <span class="text-danger">*</span></label>
                                <input type="text" wire:model="title" class="form-control" placeholder="e.g. 2.0 TDI or 320d">
                                @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="filter-label">Brand <span class="text-danger">*</span></label>
                                <select class="form-select" wire:model.live="brand">
                                    <option value="">Select Brand</option>
                                    @foreach ($brands as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                                @error('brand') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="filter-label">Variant <span class="text-danger">*</span></label>
                                <select class="form-select" wire:model="variant">
                                    <option value="">Select Variant</option>
                                    @foreach ($variants as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                                @error('variant') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="filter-label">Manufacturing Year <span class="text-danger">*</span></label>
                                <select class="form-select" wire:model="year" @if(!$isEdit) multiple style="height: 120px;" @endif>
                                    <option value="">Select Year</option>
                                    @foreach ($years as $y)
                                        <option value="{{ $y }}">{{ $y }}</option>
                                    @endforeach
                                </select>
                                <small class="text-muted">@if(!$isEdit) Hold Ctrl to select multiple years @endif</small>
                                @error('year') <br><small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="filter-label">Status</label>
                                <select class="form-select" wire:model="status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                @error('status') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-light px-4" wire:click="$set('showModal', false)">Cancel</button>
                        <button type="submit" class="btn btn-primary px-4 shadow-sm">
                            <span wire:loading.remove wire:target="{{ $isEdit ? 'update' : 'store' }}">
                                {{ $isEdit ? 'Save Changes' : 'Create Modification' }}
                            </span>
                            <span wire:loading wire:target="{{ $isEdit ? 'update' : 'store' }}">
                                <i class="bx bx-loader-alt bx-spin me-1"></i> Processing...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Page Header -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-bold mb-0">Vehicle Modifications</h4>
            <p class="text-muted small mb-0">Manage engine types and model variants</p>
        </div>
        @if (@$admin->hasPermissionTo('modification-add'))
            <button wire:click="create" class="btn btn-primary px-4 radius-30 shadow-sm">
                <i class="bx bx-plus-circle me-1"></i> Add Modification
            </button>
        @endif
    </div>

    <!-- Filters -->
    <div class="card filter-card mb-4">
        <div class="card-body p-4">
            <div class="row g-3">
                <div class="col-lg-3">
                    <label class="filter-label">Search</label>
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-end-0"><i class="bx bx-search text-muted"></i></span>
                        <input type="text" class="form-control border-start-0 ps-0" placeholder="Search title, brand..." wire:model.live.debounce.300ms="search">
                    </div>
                </div>

                <div class="col-lg-2">
                    <label class="filter-label">Brand</label>
                    <select class="form-select" wire:model.live="filter_brand">
                        <option value="">All Brands</option>
                        @foreach ($filter_brands as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-lg-2">
                    <label class="filter-label">Variant</label>
                    <select class="form-select" wire:model.live="filter_variant" @disabled(!$filter_brand)>
                        <option value="">All Variants</option>
                        @foreach ($filter_variants as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-lg-2">
                    <label class="filter-label">Year</label>
                    <select class="form-select" wire:model.live="filter_year">
                        <option value="">All Years</option>
                        @foreach ($years as $y)
                            <option value="{{ $y }}">{{ $y }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-lg-2">
                    <label class="filter-label">Status</label>
                    <select class="form-select" wire:model.live="filter_status">
                        <option value="">Any Status</option>
                        <option value="1">Active Only</option>
                        <option value="0">Inactive Only</option>
                    </select>
                </div>

                <div class="col-lg-1 d-flex align-items-end">
                    <button class="btn btn-outline-secondary w-100" wire:click="resetFilter" title="Reset Filters">
                        <i class="bx bx-refresh"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="card table-card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4" style="width: 80px;">S.No.</th>
                            <th>Title / Engine Name</th>
                            <th>Brand</th>
                            <th>Variant / Model</th>
                            <th>Year</th>
                            <th>Status</th>
                            @if (@$admin->hasPermissionTo('modification-edit') || @$admin->hasPermissionTo('modification-delete'))
                                <th class="text-end pe-4">Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($modifications as $index => $item)
                            <tr wire:key="mod-{{ $item->id }}">
                                <td class="ps-4 text-muted small">
                                    {{ $modifications->firstItem() + $index }}
                                </td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $item->title ?? 'N/A' }}</div>
                                </td>
                                <td>
                                    <span class="text-secondary small fw-medium">{{ $item->brand_name }}</span>
                                </td>
                                <td>
                                    <span class="text-secondary small">{{ $item->variant_name }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark fw-normal">{{ $item->year }}</span>
                                </td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            wire:change="toggleStatus({{ $item->id }}, {{ $item->status == 1 ? 0 : 1 }})" 
                                            @checked($item->status == 1)>
                                        <span class="ms-1 custom-badge {{ $item->status == 1 ? 'badge-active' : 'badge-inactive' }}">
                                            {{ $item->status == 1 ? 'Active' : 'Inactive' }}
                                        </span>
                                    </div>
                                </td>
                                @if (@$admin->hasPermissionTo('modification-edit') || @$admin->hasPermissionTo('modification-delete'))
                                    <td class="text-end pe-4">
                                        <div class="d-flex justify-content-end">
                                            @if (@$admin->hasPermissionTo('modification-edit'))
                                                <button wire:click="edit({{ $item->id }})" class="action-btn btn-edit border-0" title="Edit">
                                                    <i class="bx bx-edit-alt"></i>
                                                </button>
                                            @endif
                                            @if (@$admin->hasPermissionTo('modification-delete'))
                                                <button wire:click="confirmDelete({{ $item->id }})" class="action-btn btn-delete border-0" title="Delete">
                                                    <i class="bx bx-trash"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <img src="https://illustrations.popsy.co/gray/no-data.svg" alt="No data" style="width: 150px;" class="mb-3 opacity-50">
                                    <p class="text-muted">No vehicle modifications found matching your criteria.</p>
                                    <button class="btn btn-sm btn-link" wire:click="resetFilter">Clear all filters</button>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($modifications->hasPages())
            <div class="card-footer bg-white border-top-0 py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted small">
                        Showing {{ $modifications->firstItem() }} to {{ $modifications->lastItem() }} of {{ $modifications->total() }} results
                    </div>
                    <div>
                        {{ $modifications->links() }}
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
