<div class="carnate-variant-page">

    <style>
        .carnate-variant-page {
            --variant-white: #ffffff;
            --variant-text: #111827;
            --variant-muted: #64748b;
            --variant-border: #e2e8f0;
            --variant-red: #e53935;
            --variant-red-soft: #fff5f5;
            --variant-icon: #f1f5f9;
        }

        .carnate-variant-page .variant-card {
            background: var(--variant-white);
            border: 1px solid var(--variant-border);
            border-radius: 14px;
            box-shadow: 0 4px 18px rgba(15, 23, 42, .04);
            overflow: hidden;
        }

        .carnate-variant-page .variant-page-header {
            padding: 20px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .carnate-variant-page .variant-title-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .carnate-variant-page .variant-title-icon {
            width: 42px;
            height: 42px;
            border-radius: 11px;
            background: var(--variant-red-soft);
            color: var(--variant-red);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 21px;
        }

        .carnate-variant-page .variant-page-title {
            margin: 0;
            color: var(--variant-text);
            font-size: 20px;
            font-weight: 700;
            letter-spacing: -.2px;
        }

        .carnate-variant-page .variant-page-subtitle {
            margin: 3px 0 0;
            color: var(--variant-muted);
            font-size: 13px;
        }

        .carnate-variant-page .variant-add-btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            min-height: 41px;
            padding: 9px 16px;
            border: 0;
            border-radius: 9px;
            background: var(--variant-red);
            color: #fff;
            font-size: 13px;
            font-weight: 600;
            transition: all .2s ease;
        }

        .carnate-variant-page .variant-add-btn:hover {
            background: #cf2f2c;
            color: #fff;
            box-shadow: 0 5px 14px rgba(229, 57, 53, .18);
            transform: translateY(-1px);
        }

        /* Filters */
        .carnate-variant-page .variant-filter-card {
            padding: 20px 22px;
        }

        .carnate-variant-page .variant-filter-title {
            margin: 0 0 16px;
            color: var(--variant-text);
            font-size: 16px;
            font-weight: 700;
        }

        .carnate-variant-page .variant-filter-subtitle {
            margin: -11px 0 17px;
            color: var(--variant-muted);
            font-size: 12px;
        }

        .carnate-variant-page .variant-input,
        .carnate-variant-page .variant-select {
            width: 100%;
            min-height: 44px;
            padding: 9px 13px;
            border: 1px solid var(--variant-border);
            border-radius: 9px;
            background: #fff;
            color: var(--variant-text);
            font-size: 14px;
            outline: none;
            transition: all .2s ease;
        }

        .carnate-variant-page .variant-input::placeholder {
            color: #94a3b8;
        }

        .carnate-variant-page .variant-input:focus,
        .carnate-variant-page .variant-select:focus {
            border-color: rgba(229, 57, 53, .5);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .08);
        }

        .carnate-variant-page .variant-clear-btn {
            min-height: 44px;
            padding: 9px 16px;
            border: 1px solid var(--variant-border);
            border-radius: 9px;
            background: #f8fafc;
            color: #475569;
            font-size: 13px;
            font-weight: 600;
            transition: all .2s ease;
        }

        .carnate-variant-page .variant-clear-btn:hover {
            background: #e2e8f0;
            color: var(--variant-text);
        }

        /* Table */
        .carnate-variant-page .variant-table-card {
            margin-top: 20px;
        }

        .carnate-variant-page .variant-table-wrap {
            overflow-x: auto;
        }

        .carnate-variant-page .variant-table {
            width: 100%;
            min-width: 800px;
            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .carnate-variant-page .variant-table thead th {
            padding: 13px 18px;
            background: #f8fafc;
            border-bottom: 1px solid var(--variant-border);
            color: #64748b;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .5px;
            white-space: nowrap;
        }

        .carnate-variant-page .variant-table tbody td {
            padding: 15px 18px;
            border-bottom: 1px solid #edf2f7;
            color: var(--variant-text);
            font-size: 14px;
            vertical-align: middle;
        }

        .carnate-variant-page .variant-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .carnate-variant-page .variant-table tbody tr {
            transition: background .15s ease;
        }

        .carnate-variant-page .variant-table tbody tr:hover {
            background: #fafafa;
        }

        .carnate-variant-page .variant-number {
            width: 65px;
            color: #94a3b8 !important;
            font-size: 13px !important;
            font-weight: 600;
        }

        .carnate-variant-page .variant-name-cell,
        .carnate-variant-page .variant-brand-cell {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .carnate-variant-page .variant-cell-icon {
            width: 34px;
            height: 34px;
            flex: 0 0 34px;
            border-radius: 9px;
            background: var(--variant-icon);
            color: #475569;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .carnate-variant-page .variant-name {
            color: var(--variant-text);
            font-weight: 600;
        }

        .carnate-variant-page .variant-brand {
            color: #475569;
            font-weight: 500;
        }

        /* Status */
        .carnate-variant-page .variant-status {
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .carnate-variant-page .variant-status .form-check {
            margin: 0;
            padding-left: 2.5em;
        }

        .carnate-variant-page .variant-status .form-check-input {
            width: 2.2em;
            height: 1.15em;
            margin-left: -2.5em;
            cursor: pointer;
            background-color: #cbd5e1;
            border-color: #cbd5e1;
            box-shadow: none;
        }

        .carnate-variant-page .variant-status .form-check-input:checked {
            background-color: #16a34a;
            border-color: #16a34a;
        }

        .carnate-variant-page .variant-status .form-check-input:focus {
            box-shadow: none;
        }

        .carnate-variant-page .variant-status-text {
            font-size: 12px;
            font-weight: 600;
            color: #64748b;
        }

        /* Actions */
        .carnate-variant-page .variant-actions {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .carnate-variant-page .variant-action {
            width: 34px;
            height: 34px;
            padding: 0;
            border: 1px solid var(--variant-border);
            border-radius: 8px;
            background: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all .2s ease;
        }

        .carnate-variant-page .variant-edit {
            color: #475569;
        }

        .carnate-variant-page .variant-edit:hover {
            color: var(--variant-red);
            border-color: rgba(229, 57, 53, .25);
            background: var(--variant-red-soft);
        }

        .carnate-variant-page .variant-delete {
            color: #64748b;
        }

        .carnate-variant-page .variant-delete:hover {
            color: #dc2626;
            border-color: #fecaca;
            background: #fef2f2;
        }

        .carnate-variant-page .variant-pagination {
            padding: 16px 20px;
            border-top: 1px solid var(--variant-border);
        }

        .carnate-variant-page .variant-empty {
            margin: 20px;
            padding: 45px 20px;
            text-align: center;
            border: 1px dashed var(--variant-border);
            border-radius: 12px;
            background: #fff;
        }

        .carnate-variant-page .variant-empty-icon {
            width: 48px;
            height: 48px;
            margin: 0 auto 12px;
            border-radius: 12px;
            background: var(--variant-icon);
            color: #94a3b8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .carnate-variant-page .variant-empty-title {
            margin: 0;
            color: var(--variant-text);
            font-size: 15px;
            font-weight: 600;
        }

        .carnate-variant-page .variant-empty-text {
            margin: 5px 0 0;
            color: var(--variant-muted);
            font-size: 13px;
        }

        /* Modal */
        .carnate-variant-page .variant-modal {
            position: fixed;
            inset: 0;
            z-index: 1055;
            overflow-x: hidden;
            overflow-y: auto;
            background: rgba(15, 23, 42, .55);
            backdrop-filter: blur(3px);
        }

        .carnate-variant-page .variant-modal-dialog {
            width: calc(100% - 30px);
            max-width: 720px;
            margin: 60px auto 30px;
        }

        .carnate-variant-page .variant-modal-content {
            background: #fff;
            border: 1px solid var(--variant-border);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(15, 23, 42, .18);
        }

        .carnate-variant-page .variant-modal-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--variant-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .carnate-variant-page .variant-modal-title {
            margin: 0;
            color: var(--variant-text);
            font-size: 18px;
            font-weight: 700;
        }

        .carnate-variant-page .variant-close {
            width: 34px;
            height: 34px;
            border: 0;
            border-radius: 8px;
            background: var(--variant-icon);
            color: var(--variant-muted);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
        }

        .carnate-variant-page .variant-close:hover {
            background: #e2e8f0;
            color: var(--variant-text);
        }

        .carnate-variant-page .variant-modal-body {
            padding: 24px;
        }

        .carnate-variant-page .variant-field {
            margin-bottom: 3px;
        }

        .carnate-variant-page .variant-label {
            display: block;
            margin-bottom: 8px;
            color: var(--variant-text);
            font-size: 13px;
            font-weight: 600;
        }

        .carnate-variant-page .variant-label sup {
            color: var(--variant-red);
            font-size: 12px;
        }

        .carnate-variant-page .variant-error {
            display: block;
            margin-top: 6px;
            color: #dc2626;
            font-size: 12px;
        }

        .carnate-variant-page .variant-modal-footer {
            padding: 16px 24px;
            border-top: 1px solid var(--variant-border);
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .carnate-variant-page .variant-secondary-btn {
            min-height: 40px;
            padding: 9px 16px;
            border: 1px solid var(--variant-border);
            border-radius: 8px;
            background: #f1f5f9;
            color: #475569;
            font-size: 13px;
            font-weight: 600;
        }

        .carnate-variant-page .variant-secondary-btn:hover {
            background: #e2e8f0;
            color: var(--variant-text);
        }

        .carnate-variant-page .variant-primary-btn {
            min-height: 40px;
            padding: 9px 16px;
            border: 0;
            border-radius: 8px;
            background: var(--variant-red);
            color: #fff;
            font-size: 13px;
            font-weight: 600;
        }

        .carnate-variant-page .variant-primary-btn:hover {
            background: #cf2f2c;
            color: #fff;
        }

        /* Select2 */
        .carnate-variant-page .select2-container {
            width: 100% !important;
        }

        .carnate-variant-page .select2-container .select2-selection--single {
            height: 44px;
            border: 1px solid var(--variant-border);
            border-radius: 9px;
            display: flex;
            align-items: center;
        }

        .carnate-variant-page .select2-container .select2-selection--single
        .select2-selection__rendered {
            padding-left: 13px;
            color: var(--variant-text);
            font-size: 14px;
            line-height: 42px;
        }

        .carnate-variant-page .select2-container .select2-selection--single
        .select2-selection__arrow {
            height: 42px;
            right: 7px;
        }

        @media (max-width: 767px) {
            .carnate-variant-page .variant-page-header {
                padding: 16px;
                align-items: flex-start;
            }

            .carnate-variant-page .variant-page-title {
                font-size: 17px;
            }

            .carnate-variant-page .variant-filter-card {
                padding: 17px;
            }

            .carnate-variant-page .variant-modal-dialog {
                margin-top: 25px;
            }

            .carnate-variant-page .variant-modal-body {
                padding: 18px;
            }

            .carnate-variant-page .variant-modal-header,
            .carnate-variant-page .variant-modal-footer {
                padding: 16px 18px;
            }
        }
    </style>

    {{-- Success Message --}}
    @if (session()->has('message'))
        <div style="
            margin-bottom:18px;
            padding:12px 15px;
            border:1px solid #bbf7d0;
            border-radius:10px;
            background:#f0fdf4;
            color:#166534;
            font-size:14px;
        ">
            <i class="bx bx-check-circle me-1"></i>
            {{ session('message') }}
        </div>
    @endif

    @php
        $admin = App\Models\Admin::where('id', $adminId)->first();
    @endphp

    {{-- Add / Edit Modal --}}
    <div class="variant-modal"
        tabindex="-1"
        style="display:@if ($showModal) block @else none @endif">

        <div class="variant-modal-dialog">
            <div class="variant-modal-content">

                <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">

                    <div class="variant-modal-header">
                        <h4 class="variant-modal-title">
                            {{ $isEdit ? 'Edit Variant' : 'Create Variant' }}
                        </h4>

                        <button type="button"
                            class="variant-close"
                            wire:click="closeModel"
                            data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="bx bx-x"></i>
                        </button>
                    </div>

                    <div class="variant-modal-body">
                        @csrf

                        <div class="row g-3">

                            {{-- Title --}}
                            <div class="col-md-6">
                                <div class="variant-field">
                                    <label class="variant-label">
                                        Title <sup>*</sup>
                                    </label>

                                    <input type="text"
                                        wire:model="title"
                                        class="variant-input"
                                        placeholder="Enter Title">
                                </div>

                                @error('title')
                                    <span class="variant-error">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Maker Type --}}
                            <div class="col-md-6">
                                <div class="variant-field">
                                    <label class="variant-label">
                                        Maker Type <sup>*</sup>
                                    </label>

                                    <select id="maker_type_id"
                                        class="variant-select select2"
                                        wire:model="maker_type_id"
                                        data-property="maker_type_id">

                                        <option value="">Select Maker Type</option>

                                        @foreach ($makertypes as $makertype)
                                            <option value="{{ $makertype->id }}">
                                                {{ $makertype->title }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>

                                @error('maker_type_id')
                                    <span class="variant-error">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Status --}}
                            <div class="col-md-6">
                                <div class="variant-field">
                                    <label class="variant-label">
                                        Status <sup>*</sup>
                                    </label>

                                    <select class="variant-select status"
                                        wire:model="status">

                                        <option value="">Select Status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>

                                    </select>
                                </div>

                                @error('status')
                                    <span class="variant-error">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <div class="variant-modal-footer">

                        <button type="button"
                            class="variant-secondary-btn"
                            wire:click="closeModel"
                            data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <button type="submit"
                            class="variant-primary-btn">

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
    <div class="variant-card">
        <div class="variant-page-header">

            <div class="variant-title-wrap">

                <div class="variant-title-icon">
                    <i class="bx bx-git-branch"></i>
                </div>

                <div>
                    <h4 class="variant-page-title">Variant</h4>
                    <p class="variant-page-subtitle">
                        Manage vehicle variants and their associated brands
                    </p>
                </div>

            </div>

            @if (@$admin->hasPermissionTo('maker-add'))
                <a href="javascript:;"
                    wire:click="create"
                    class="variant-add-btn">
                    <i class="bx bx-plus"></i>
                    Add
                </a>
            @endif

        </div>
    </div>

    {{-- Filters --}}
    <div class="variant-card variant-filter-card mt-4">

        <h5 class="variant-filter-title">Search & Filters</h5>

        <p class="variant-filter-subtitle">
            Search variants and filter them by brand or status
        </p>

        <div class="row g-3">

            <div class="col-lg-3 col-md-6">
                <input type="text"
                    class="variant-input"
                    placeholder="Search Title"
                    wire:model.live="search">
            </div>

            <div class="col-lg-3 col-md-6">

                <select id="filter_brand"
                    class="variant-select select2"
                    wire:model.live="filter_brand">

                    <option value="">Select Brand</option>

                    @foreach ($makertypes as $makertype)
                        <option value="{{ $makertype->id }}">
                            {{ $makertype->title }}
                        </option>
                    @endforeach

                </select>

            </div>

            <div class="col-lg-3 col-md-6">

                <select class="variant-select"
                    wire:model.live="status_filter">

                    <option value="">Select Status</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>

                </select>

            </div>

            <div class="col-lg-3 col-md-6 d-flex justify-content-end">

                <button type="button"
                    class="variant-clear-btn"
                    wire:click="resetFilter">
                    <i class="bx bx-reset me-1"></i>
                    Clear
                </button>

            </div>

        </div>
    </div>

    {{-- Variant List --}}
    <div class="variant-card variant-table-card">

        @if ($items->count())

            <div class="variant-table-wrap">

                <table class="variant-table">

                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Title</th>
                            <th>Brand</th>
                            <th>Status</th>

                            @if (@$admin->hasPermissionTo('maker-edit') || @$admin->hasPermissionTo('maker-delete'))
                                <th>Actions</th>
                            @endif
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($items as $index => $item)

                            <tr>

                                <td class="variant-number">
                                    {{ $items->total() - ($items->firstItem() + $index) + 1 }}
                                </td>

                                <td>
                                    <div class="variant-name-cell">

                                        <span class="variant-cell-icon">
                                            <i class="bx bx-git-branch"></i>
                                        </span>

                                        <span class="variant-name">
                                            {{ $item->title }}
                                        </span>

                                    </div>
                                </td>

                                <td>
                                    <div class="variant-brand-cell">

                                        <span class="variant-cell-icon">
                                            <i class="bx bx-car"></i>
                                        </span>

                                        <span class="variant-brand">
                                            {{ $item->makerType ? $item->makerType->title : 'NA' }}
                                        </span>

                                    </div>
                                </td>

                                <td>
                                    <div class="variant-status">

                                        <div class="form-check form-switch">
                                            <input class="form-check-input"
                                                type="checkbox"
                                                wire:change="toggleStatus({{ $item->id }}, {{ $item->status == 1 ? 0 : 1 }})"
                                                {{ $item->status == 1 ? 'checked' : '' }}
                                                id="toggleStatus({{ $item->id }}">
                                        </div>

                                        <span class="variant-status-text">
                                            {{ $item->status == 1 ? 'Active' : 'Inactive' }}
                                        </span>

                                    </div>
                                </td>

                                @if (@$admin->hasPermissionTo('maker-edit') || @$admin->hasPermissionTo('maker-delete'))

                                    <td>

                                        <div class="variant-actions">

                                            @if (@$admin->hasPermissionTo('maker-edit'))
                                                <a wire:click="edit({{ $item->id }})"
                                                    class="variant-action variant-edit"
                                                    title="Edit">
                                                    <i class="bx bxs-edit"></i>
                                                </a>
                                            @endif

                                            @if (@$admin->hasPermissionTo('maker-delete'))
                                                <a wire:click="confirmDelete({{ $item->id }})"
                                                    class="variant-action variant-delete"
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

            <div class="variant-pagination">
                {{ $items->links() }}
            </div>

        @else

            <div class="variant-empty">

                <div class="variant-empty-icon">
                    <i class="bx bx-git-branch"></i>
                </div>

                <h5 class="variant-empty-title">
                    No Maker found!
                </h5>

                <p class="variant-empty-text">
                    Vehicle variants will appear here once they are created.
                </p>

            </div>

        @endif

    </div>

</div>

@section('footerscript')
    <script>
        document.addEventListener('livewire:init', () => {
            initial2();

            Livewire.hook('morphed', (message, component) => {
                initial2();
            });

            function initial2() {
                $('#maker_type_id').select2({
                    placeholder: "Select Brand"
                }).on('change', function() {
                    @this.set('maker_type_id', $(this).val());
                });

                $('#filter_brand').select2({
                    placeholder: "Select Brand"
                }).on('change', function() {
                    @this.set('filter_brand', $(this).val());
                });
            }
        });
    </script>
@endsection