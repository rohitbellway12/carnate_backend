<div>
    @if (session()->has('message'))
        <div class="alert alert-success shadow-sm border-0 mb-3">{{ session('message') }}</div>
    @endif

    @php
        $sparePart = App\Models\SparePartVendor::where('id', Auth::guard('sparepart')->user()->id)->first();
        $totalCategories = $categories->total() ?? 0;
    @endphp

    {{-- Mobile edit/create modal --}}
    <div class="modal @if ($showModal) show @endif" tabindex="-1"
        style="opacity:1; background-color:#0606068c; display:@if ($showModal) block @endif">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-3 overflow-hidden">
                <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">
                    <div class="modal-header bg-dark text-white py-3">
                        <h5 class="modal-title fw-bold mb-0">
                            <i class='bx {{ $isEdit ? 'bx-edit' : 'bx-plus-circle' }} me-2'></i>
                            {{ $isEdit ? 'Edit Category' : 'Create Category' }}
                        </h5>
                        <button type="button" class="btn-close btn-close-white" wire:click="closeMdodel"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <label class="form-label fw-semibold">Category Name <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class='bx bx-category'></i></span>
                            <input type="text" wire:model="title"
                                class="form-control border-start-0 @error('title') is-invalid @enderror"
                                placeholder="e.g. Body, Electrics, Filters">
                        </div>
                        @error('title')
                            <span class="text-danger small d-block mt-1">{{ $message }}</span>
                        @enderror
                        <p class="text-muted small mt-3 mb-0">
                            <i class='bx bx-info-circle me-1'></i>
                            Parent categories appear in Parts, Accessory, Tools & Lubricant dropdowns.
                        </p>
                    </div>
                    <div class="modal-footer bg-light border-0 px-4 py-3">
                        <button type="button" class="btn btn-outline-secondary px-4" wire:click="closeMdodel">Cancel</button>
                        <button type="submit" class="btn btn-primary px-4 fw-bold shadow-sm">
                            {{ $isEdit ? 'Update' : 'Create' }}
                            <span class="spinner-border spinner-border-sm ms-1" wire:loading wire:target="{{ $isEdit ? 'update' : 'store' }}"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Page header --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body d-flex flex-wrap justify-content-between align-items-center gap-2 py-3">
            <div>
                <h4 class="fw-bold mb-1 clr12477a">
                    <i class='bx bx-category-alt me-2'></i>Product Categories
                </h4>
                <p class="text-muted small mb-0">Manage parent categories for inventory items</p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-2">
                    {{ $totalCategories }} {{ Str::plural('category', $totalCategories) }}
                </span>
                @if (@$sparePart->hasPermissionTo('category-add'))
                    <button type="button" wire:click="create" class="btn btn-primary px-4 shadow-sm fw-bold d-md-none">
                        <i class="bx bx-plus-circle me-1"></i>Add
                    </button>
                @endif
            </div>
        </div>
    </div>

    <div class="row g-4">
        {{-- Category list --}}
        <div class="col-lg-8">
            {{-- Search --}}
            <div class="card shadow-sm border-0 mb-3 rounded-3 overflow-hidden">
                <div class="card-body bg-light-subtle py-3">
                    <div class="row g-2 align-items-center">
                        <div class="col-md-8">
                            <div class="input-group shadow-xs rounded-pill overflow-hidden bg-white">
                                <span class="input-group-text bg-white border-0 ps-3">
                                    <i class='bx bx-search text-muted'></i>
                                </span>
                                <input type="text" class="form-control border-0 py-2"
                                    placeholder="Search category by name..." wire:model.live="searchfilter">
                            </div>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <button type="button" class="btn btn-outline-secondary px-4 rounded-pill fw-semibold w-100 w-md-auto"
                                wire:click="resetFilter">
                                <i class='bx bx-revision me-1'></i>Reset
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Table --}}
            <div class="card shadow-sm border-0 rounded-3 overflow-hidden">
                <div class="card-header bg-white border-bottom py-3">
                    <h6 class="fw-bold mb-0 text-dark"><i class='bx bx-list-ul me-2 text-primary'></i>Category List</h6>
                </div>
                @if (!empty($categories) && $categories->count())
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light-subtle text-muted small text-uppercase fw-bold">
                                    <tr>
                                        <th class="ps-4 py-3" style="width: 70px;">#</th>
                                        <th>Category Name</th>
                                        <th class="text-center pe-4" style="width: 120px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $index => $category)
                                        <tr>
                                            <td class="ps-4 text-muted fw-medium">
                                                {{ $categories->total() - ($categories->firstItem() + $index) + 1 }}
                                            </td>
                                            <td>
                                                <span class="d-inline-flex align-items-center gap-2">
                                                    <span class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center"
                                                        style="width: 36px; height: 36px;">
                                                        <i class='bx bx-folder fs-5'></i>
                                                    </span>
                                                    <span class="fw-semibold text-dark">{{ $category->title }}</span>
                                                </span>
                                            </td>
                                            <td class="text-center pe-4">
                                                <div class="d-flex justify-content-center gap-1">
                                                    <button type="button" wire:click="edit({{ $category->id }})"
                                                        class="btn btn-sm btn-light rounded-circle shadow-xs"
                                                        title="Edit">
                                                        <i class="bx bxs-edit text-primary"></i>
                                                    </button>
                                                    <button type="button" wire:click="confirmDelete({{ $category->id }})"
                                                        class="btn btn-sm btn-light rounded-circle shadow-xs"
                                                        title="Delete">
                                                        <i class="bx bxs-trash text-danger"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="p-3 border-top bg-light-subtle">
                            {{ $categories->links() }}
                        </div>
                    </div>
                @else
                    <div class="card-body text-center py-5">
                        <i class='bx bx-category text-muted mb-3' style="font-size: 4rem; opacity: 0.35;"></i>
                        <h5 class="text-muted fw-bold">No categories found</h5>
                        <p class="text-muted small mb-0">
                            @if ($searchfilter)
                                Try a different search term or reset filters.
                            @else
                                Create a category using the form on the right.
                            @endif
                        </p>
                    </div>
                @endif
            </div>
        </div>

        {{-- Create form (desktop) --}}
        <div class="col-lg-4 d-none d-lg-block">
            <div class="card shadow-sm border-0 rounded-3 overflow-hidden sticky-top" style="top: 1rem;">
                <div class="card-header bg-white text-dark py-3">
                    <h6 class="fw-bold mb-0">
                        <i class='bx bx-plus-circle me-2'></i>Quick Add Category
                    </h6>
                </div>
                <div class="card-body p-4">
                    <form wire:submit.prevent="store">
                        <label class="form-label fw-semibold">Category Name <span class="text-danger">*</span></label>
                        <div class="input-group mb-2">
                            <span class="input-group-text bg-light"><i class='bx bx-category'></i></span>
                            <input type="text" wire:model="title"
                                class="form-control @error('title') is-invalid @enderror"
                                placeholder="e.g. Body, Electrics">
                        </div>
                        @error('title')
                            <span class="text-danger small d-block mb-3">{{ $message }}</span>
                        @enderror

                        <div class="rounded-3 bg-light p-3 mb-4">
                            <p class="small text-muted mb-2 fw-semibold"><i class='bx bx-bulb me-1'></i>Tips</p>
                            <ul class="small text-muted mb-0 ps-3">
                                <li class="mb-1">Use top-level names like <strong>Body</strong>, <strong>Engine</strong></li>
                                <li class="mb-1">API-synced categories load automatically</li>
                                <li>Add custom ones if not found in catalog</li>
                            </ul>
                        </div>

                        @if (@$sparePart->hasPermissionTo('category-add'))
                            <button type="submit" class="btn btn-primary w-100 fw-bold shadow-sm py-2">
                                <i class="bx bx-plus-circle me-1"></i>Create Category
                                <span class="spinner-border spinner-border-sm ms-1" wire:loading wire:target="store"></span>
                            </button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@section('footerscript')
    <script>
        document.addEventListener('livewire:init', function() {
            Livewire.hook('morphed', () => {});
        });
    </script>
@endsection
