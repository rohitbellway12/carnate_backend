<div class="carnate-brand-page">

    <style>
        .carnate-brand-page {
            --brand-bg: #f7f8fa;
            --brand-white: #ffffff;
            --brand-text: #111827;
            --brand-muted: #64748b;
            --brand-border: #e2e8f0;
            --brand-red: #e53935;
            --brand-red-soft: #fff5f5;
            --brand-icon: #f1f5f9;
        }

        .carnate-brand-page .brand-card {
            background: var(--brand-white);
            border: 1px solid var(--brand-border);
            border-radius: 14px;
            box-shadow: 0 4px 18px rgba(15, 23, 42, .04);
            overflow: hidden;
        }

        .carnate-brand-page .brand-page-header {
            padding: 20px 24px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .carnate-brand-page .brand-title-icon {
            width: 42px;
            height: 42px;
            border-radius: 11px;
            background: var(--brand-red-soft);
            color: var(--brand-red);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 21px;
        }

        .carnate-brand-page .brand-page-title {
            margin: 0;
            color: var(--brand-text);
            font-size: 20px;
            font-weight: 700;
            letter-spacing: -.2px;
        }

        .carnate-brand-page .brand-page-subtitle {
            margin: 3px 0 0;
            color: var(--brand-muted);
            font-size: 13px;
        }

        .carnate-brand-page .brand-alert {
            margin-bottom: 18px;
            padding: 12px 15px;
            border: 1px solid #bbf7d0;
            border-radius: 10px;
            background: #f0fdf4;
            color: #166534;
            font-size: 14px;
        }

        /* Create / Edit Form */
        .carnate-brand-page .brand-form-header {
            padding: 18px 22px;
            border-bottom: 1px solid var(--brand-border);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .carnate-brand-page .brand-form-icon {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            background: var(--brand-icon);
            color: #475569;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .carnate-brand-page .brand-form-heading {
            margin: 0;
            color: var(--brand-text);
            font-size: 16px;
            font-weight: 700;
        }

        .carnate-brand-page .brand-form-body {
            padding: 22px;
        }

        .carnate-brand-page .brand-field {
            margin-bottom: 4px;
        }

        .carnate-brand-page .brand-label {
            display: block;
            margin-bottom: 8px;
            color: var(--brand-text);
            font-size: 13px;
            font-weight: 600;
        }

        .carnate-brand-page .brand-label sup {
            color: var(--brand-red);
            font-size: 12px;
        }

        .carnate-brand-page .brand-input,
        .carnate-brand-page .brand-select {
            width: 100%;
            min-height: 44px;
            padding: 9px 13px;
            border: 1px solid var(--brand-border);
            border-radius: 9px;
            background: #fff;
            color: var(--brand-text);
            font-size: 14px;
            outline: none;
            transition: all .2s ease;
        }

        .carnate-brand-page .brand-input::placeholder {
            color: #94a3b8;
        }

        .carnate-brand-page .brand-input:focus,
        .carnate-brand-page .brand-select:focus {
            border-color: rgba(229, 57, 53, .5);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .08);
        }

        .carnate-brand-page .brand-error {
            display: block;
            margin-top: 6px;
            color: #dc2626;
            font-size: 12px;
        }

        .carnate-brand-page .brand-form-actions {
            margin-top: 22px;
            display: flex;
            justify-content: flex-end;
        }

        .carnate-brand-page .brand-primary-btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            min-height: 41px;
            padding: 9px 16px;
            border: 0;
            border-radius: 9px;
            background: var(--brand-red);
            color: #fff;
            font-size: 13px;
            font-weight: 600;
            transition: all .2s ease;
        }

        .carnate-brand-page .brand-primary-btn:hover {
            background: #cf2f2c;
            color: #fff;
            box-shadow: 0 5px 14px rgba(229, 57, 53, .18);
        }

        /* List Header */
        .carnate-brand-page .brand-list-header {
            padding: 20px 22px;
            border-bottom: 1px solid var(--brand-border);
        }

        .carnate-brand-page .brand-list-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 18px;
        }

        .carnate-brand-page .brand-list-title {
            margin: 0;
            color: var(--brand-text);
            font-size: 17px;
            font-weight: 700;
        }

        .carnate-brand-page .brand-list-subtitle {
            margin: 3px 0 0;
            color: var(--brand-muted);
            font-size: 12px;
        }

        .carnate-brand-page .brand-filters {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .carnate-brand-page .brand-search {
            min-width: 260px;
        }

        .carnate-brand-page .brand-filter-select {
            min-width: 150px;
        }

        .carnate-brand-page .brand-clear-btn {
            min-height: 42px;
            padding: 9px 15px;
            border: 1px solid var(--brand-border);
            border-radius: 8px;
            background: #f8fafc;
            color: #475569;
            font-size: 13px;
            font-weight: 600;
            transition: all .2s ease;
        }

        .carnate-brand-page .brand-clear-btn:hover {
            background: #e2e8f0;
            color: var(--brand-text);
        }

        /* Table */
        .carnate-brand-page .brand-table-wrap {
            overflow-x: auto;
        }

        .carnate-brand-page .brand-table {
            width: 100%;
            min-width: 700px;
            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .carnate-brand-page .brand-table thead th {
            padding: 13px 18px;
            background: #f8fafc;
            border-bottom: 1px solid var(--brand-border);
            color: #64748b;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .5px;
            white-space: nowrap;
        }

        .carnate-brand-page .brand-table tbody td {
            padding: 15px 18px;
            border-bottom: 1px solid #edf2f7;
            color: var(--brand-text);
            font-size: 14px;
            vertical-align: middle;
        }

        .carnate-brand-page .brand-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .carnate-brand-page .brand-table tbody tr {
            transition: background .15s ease;
        }

        .carnate-brand-page .brand-table tbody tr:hover {
            background: #fafafa;
        }

        .carnate-brand-page .brand-number {
            width: 65px;
            color: #94a3b8 !important;
            font-size: 13px !important;
            font-weight: 600;
        }

        .carnate-brand-page .brand-name-cell {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .carnate-brand-page .brand-name-icon {
            width: 34px;
            height: 34px;
            flex: 0 0 34px;
            border-radius: 9px;
            background: var(--brand-icon);
            color: #475569;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .carnate-brand-page .brand-name {
            color: var(--brand-text);
            font-weight: 600;
        }

        /* Status */
        .carnate-brand-page .brand-status {
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .carnate-brand-page .brand-status-label {
            font-size: 12px;
            font-weight: 600;
            color: #64748b;
        }

        .carnate-brand-page .brand-status .form-check {
            margin: 0;
            padding-left: 2.5em;
        }

        .carnate-brand-page .brand-status .form-check-input {
            width: 2.2em;
            height: 1.15em;
            margin-left: -2.5em;
            cursor: pointer;
            background-color: #cbd5e1;
            border-color: #cbd5e1;
            box-shadow: none;
        }

        .carnate-brand-page .brand-status .form-check-input:checked {
            background-color: #16a34a;
            border-color: #16a34a;
        }

        .carnate-brand-page .brand-status .form-check-input:focus {
            box-shadow: none;
        }

        /* Actions */
        .carnate-brand-page .brand-actions {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .carnate-brand-page .brand-action {
            width: 34px;
            height: 34px;
            padding: 0;
            border: 1px solid var(--brand-border);
            border-radius: 8px;
            background: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all .2s ease;
        }

        .carnate-brand-page .brand-action-edit {
            color: #475569;
        }

        .carnate-brand-page .brand-action-edit:hover {
            color: var(--brand-red);
            border-color: rgba(229, 57, 53, .25);
            background: var(--brand-red-soft);
        }

        .carnate-brand-page .brand-action-delete {
            color: #64748b;
        }

        .carnate-brand-page .brand-action-delete:hover {
            color: #dc2626;
            border-color: #fecaca;
            background: #fef2f2;
        }

        .carnate-brand-page .brand-pagination {
            padding: 16px 20px;
            border-top: 1px solid var(--brand-border);
        }

        /* Empty */
        .carnate-brand-page .brand-empty {
            margin: 20px;
            padding: 45px 20px;
            text-align: center;
            border: 1px dashed var(--brand-border);
            border-radius: 12px;
            background: #fff;
        }

        .carnate-brand-page .brand-empty-icon {
            width: 48px;
            height: 48px;
            margin: 0 auto 12px;
            border-radius: 12px;
            background: var(--brand-icon);
            color: #94a3b8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .carnate-brand-page .brand-empty-title {
            margin: 0;
            color: var(--brand-text);
            font-size: 15px;
            font-weight: 600;
        }

        .carnate-brand-page .brand-empty-text {
            margin: 5px 0 0;
            color: var(--brand-muted);
            font-size: 13px;
        }

        /* Modal */
        .carnate-brand-page .brand-modal {
            position: fixed;
            inset: 0;
            z-index: 1055;
            overflow-x: hidden;
            overflow-y: auto;
            background: rgba(15, 23, 42, .55);
            backdrop-filter: blur(3px);
        }

        .carnate-brand-page .brand-modal-dialog {
            width: calc(100% - 30px);
            max-width: 680px;
            margin: 65px auto 30px;
        }

        .carnate-brand-page .brand-modal-content {
            background: #fff;
            border: 1px solid var(--brand-border);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(15, 23, 42, .18);
        }

        .carnate-brand-page .brand-modal-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--brand-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .carnate-brand-page .brand-modal-title {
            margin: 0;
            color: var(--brand-text);
            font-size: 18px;
            font-weight: 700;
        }

        .carnate-brand-page .brand-close {
            width: 34px;
            height: 34px;
            border: 0;
            border-radius: 8px;
            background: var(--brand-icon);
            color: var(--brand-muted);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
        }

        .carnate-brand-page .brand-close:hover {
            background: #e2e8f0;
            color: var(--brand-text);
        }

        .carnate-brand-page .brand-modal-body {
            padding: 24px;
        }

        .carnate-brand-page .brand-modal-footer {
            padding: 16px 24px;
            border-top: 1px solid var(--brand-border);
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .carnate-brand-page .brand-secondary-btn {
            min-height: 40px;
            padding: 9px 16px;
            border: 1px solid var(--brand-border);
            border-radius: 8px;
            background: #f1f5f9;
            color: #475569;
            font-size: 13px;
            font-weight: 600;
        }

        .carnate-brand-page .brand-secondary-btn:hover {
            background: #e2e8f0;
            color: var(--brand-text);
        }

        @media (max-width: 767px) {
            .carnate-brand-page .brand-page-header {
                padding: 16px;
            }

            .carnate-brand-page .brand-page-title {
                font-size: 17px;
            }

            .carnate-brand-page .brand-list-header {
                padding: 17px;
            }

            .carnate-brand-page .brand-list-top {
                align-items: flex-start;
            }

            .carnate-brand-page .brand-filters {
                flex-direction: column;
                align-items: stretch;
            }

            .carnate-brand-page .brand-search,
            .carnate-brand-page .brand-filter-select {
                width: 100%;
                min-width: 0;
            }

            .carnate-brand-page .brand-clear-btn {
                width: 100%;
            }

            .carnate-brand-page .brand-modal-dialog {
                margin-top: 25px;
            }

            .carnate-brand-page .brand-modal-body {
                padding: 18px;
            }

            .carnate-brand-page .brand-modal-header,
            .carnate-brand-page .brand-modal-footer {
                padding: 16px 18px;
            }
        }
    </style>

    {{-- Success Message --}}
    @if (session()->has('message'))
        <div class="brand-alert">
            <i class="bx bx-check-circle me-1"></i>
            {{ session('message') }}
        </div>
    @endif

    @php
        $admin = App\Models\Admin::where('id', $adminId)->first();
    @endphp

    {{-- Add/Edit Modal --}}
    <div class="brand-modal"
        tabindex="-1"
        style="display:@if ($showModal) block @else none @endif">

        <div class="brand-modal-dialog">
            <div class="brand-modal-content">

                <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">

                    <div class="brand-modal-header">
                        <h4 class="brand-modal-title">
                            {{ $isEdit ? 'Edit Brand' : 'Create Brand' }}
                        </h4>

                        <button type="button"
                            class="brand-close"
                            wire:click="colseModel"
                            data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="bx bx-x"></i>
                        </button>
                    </div>

                    <div class="brand-modal-body">
                        @csrf

                        <div class="row g-3">

                            <div class="col-md-6">
                                <div class="brand-field">
                                    <label class="brand-label">
                                        Title <sup>*</sup>
                                    </label>

                                    <input type="text"
                                        wire:model="title"
                                        class="brand-input"
                                        placeholder="Enter Title">
                                </div>

                                @error('title')
                                    <span class="brand-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <div class="brand-field">
                                    <label class="brand-label">
                                        Status <sup>*</sup>
                                    </label>

                                    <select class="brand-select" wire:model="status">
                                        <option value="">Select Status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>

                                @error('status')
                                    <span class="brand-error">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <div class="brand-modal-footer">
                        <button type="button"
                            class="brand-secondary-btn"
                            wire:click="colseModel"
                            data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <button type="submit" class="brand-primary-btn">
                            {{ $isEdit ? 'Update' : 'Create' }}
                            <i class="spinner-border spinner-border-sm ms-1"
                                wire:loading></i>
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    {{-- Page Header --}}
    <div class="brand-card">
        <div class="brand-page-header">
            <div class="brand-title-icon">
                <i class="bx bx-car"></i>
            </div>

            <div>
                <h4 class="brand-page-title">Brand</h4>
                <p class="brand-page-subtitle">
                    Manage vehicle brands and their status
                </p>
            </div>
        </div>
    </div>

    {{-- Create Brand --}}
    @if (@$admin->hasPermissionTo('makers-type-add'))
        <div class="brand-card mt-4">

            <div class="brand-form-header">
                <span class="brand-form-icon">
                    <i class="bx bx-plus"></i>
                </span>

                <h5 class="brand-form-heading">Create Brand</h5>
            </div>

            <div class="brand-form-body">

                <form wire:submit="store">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <div class="brand-field">
                                <label class="brand-label">
                                    Title <sup>*</sup>
                                </label>

                                <input type="text"
                                    wire:model="title"
                                    class="brand-input"
                                    placeholder="Enter Title">
                            </div>

                            @error('title')
                                <span class="brand-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <div class="brand-field">
                                <label class="brand-label">
                                    Status <sup>*</sup>
                                </label>

                                <select class="brand-select" wire:model="status">
                                    <option value="">Select Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>

                            @error('status')
                                <span class="brand-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-12">
                            <div class="brand-form-actions">
                                <button type="submit"
                                    class="brand-primary-btn"
                                    wire:loading.attr="disabled">

                                    <i class="bx bx-plus"></i>
                                    Create

                                    <i class="spinner-border spinner-border-sm"
                                        wire:loading
                                        wire:target="store"></i>
                                </button>
                            </div>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    @endif

    {{-- Brand List --}}
    <div class="brand-card mt-4">

        <div class="brand-list-header">

            <div class="brand-list-top">
                <div>
                    <h5 class="brand-list-title">Brand List</h5>
                    <p class="brand-list-subtitle">
                        Search, filter and manage vehicle brands
                    </p>
                </div>
            </div>

            <div class="brand-filters">

                <input type="text"
                    class="brand-input brand-search"
                    placeholder="Search Title"
                    wire:model.live="search">

                <select class="brand-select brand-filter-select"
                    wire:model.change="status_filter">

                    <option value="">Select Status</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>

                </select>

                <button type="button"
                    class="brand-clear-btn"
                    wire:click="resetFilter"
                    fdprocessedid="orntg">
                    <i class="bx bx-reset me-1"></i>
                    Clear
                </button>

            </div>
        </div>

        @if ($items->count())

            <div class="brand-table-wrap">

                <table class="brand-table">

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

                                <td class="brand-number">
                                    {{ $items->total() - ($items->firstItem() + $index) + 1 }}
                                </td>

                                <td>
                                    <div class="brand-name-cell">
                                        <span class="brand-name-icon">
                                            <i class="bx bx-car"></i>
                                        </span>

                                        <span class="brand-name">
                                            {{ $item->title }}
                                        </span>
                                    </div>
                                </td>

                                <td>
                                    <div class="brand-status">

                                        <div class="form-check form-switch">
                                            <input class="form-check-input"
                                                type="checkbox"
                                                wire:change="toggleStatus({{ $item->id }}, {{ $item->status == 1 ? 0 : 1 }})"
                                                {{ $item->status == 1 ? 'checked' : '' }}
                                                id="toggleStatus{{ $item->id }}">
                                        </div>

                                        <span class="brand-status-label">
                                            {{ $item->status == 1 ? 'Active' : 'Inactive' }}
                                        </span>

                                    </div>
                                </td>

                                @if (@$admin->hasPermissionTo('makers-type-edit') || @$admin->hasPermissionTo('makers-type-delete'))
                                    <td>

                                        <div class="brand-actions">

                                            @if (@$admin->hasPermissionTo('makers-type-edit'))
                                                <a wire:click="edit({{ $item->id }})"
                                                    class="brand-action brand-action-edit"
                                                    title="Edit">
                                                    <i class="bx bxs-edit"></i>
                                                </a>
                                            @endif

                                            @if (@$admin->hasPermissionTo('makers-type-delete'))
                                                <a wire:click="confirmDelete({{ $item->id }})"
                                                    class="brand-action brand-action-delete"
                                                    title="Delete">
                                                    <i class="bx bx-trash"></i>
                                                </a>
                                            @endif

                                        </div>

                                    </td>
                                @endif

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

            <div class="brand-pagination">
                {{ $items->links() }}
            </div>

        @else

            <div class="brand-empty">

                <div class="brand-empty-icon">
                    <i class="bx bx-purchase-tag"></i>
                </div>

                <h5 class="brand-empty-title">
                    No Brand found!
                </h5>

                <p class="brand-empty-text">
                    Vehicle brands will appear here once they are created.
                </p>

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