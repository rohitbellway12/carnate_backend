<div class="carnate-labour-page">

    <style>
        /* =========================================================
           CARNATE — LABOUR CHARGE
           UI ONLY — Livewire logic/bindings preserved
        ========================================================= */

        .carnate-labour-page {
            --cl-bg: #f7f8fa;
            --cl-card: #ffffff;
            --cl-text: #111827;
            --cl-muted: #64748b;
            --cl-border: #e2e8f0;
            --cl-red: #e53935;
            --cl-red-soft: #fff5f5;
            --cl-icon: #f1f5f9;
            --cl-success: #16a34a;
            --cl-shadow: 0 8px 28px rgba(15, 23, 42, 0.06);

            color: var(--cl-text);
        }

        .carnate-labour-page .cl-alert {
            border: 1px solid #bbf7d0;
            background: #f0fdf4;
            color: #166534;
            border-radius: 12px;
            padding: 13px 16px;
            margin-bottom: 18px;
            font-size: 14px;
            font-weight: 600;
        }

        /* Header */
        .carnate-labour-page .cl-page-header {
            background: var(--cl-card);
            border: 1px solid var(--cl-border);
            border-radius: 16px;
            box-shadow: var(--cl-shadow);
            padding: 20px 22px;
            margin-bottom: 18px;
        }

        .carnate-labour-page .cl-page-title-wrap {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .carnate-labour-page .cl-page-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: var(--cl-red-soft);
            color: var(--cl-red);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
        }

        .carnate-labour-page .cl-page-title {
            margin: 0;
            font-size: 20px;
            line-height: 1.25;
            font-weight: 700;
            color: var(--cl-text);
        }

        .carnate-labour-page .cl-page-subtitle {
            margin: 4px 0 0;
            color: var(--cl-muted);
            font-size: 13px;
        }

        /* Buttons */
        .carnate-labour-page .cl-btn-primary {
            border: 0 !important;
            background: var(--cl-red) !important;
            color: #fff !important;
            border-radius: 9px !important;
            padding: 10px 16px !important;
            font-size: 13px;
            font-weight: 600;
            box-shadow: none !important;
            transition: .2s ease;
        }

        .carnate-labour-page .cl-btn-primary:hover {
            background: #c92f2c !important;
            color: #fff !important;
            transform: translateY(-1px);
        }

        .carnate-labour-page .cl-btn-clear {
            border: 1px solid var(--cl-border) !important;
            background: #fff !important;
            color: var(--cl-muted) !important;
            border-radius: 9px !important;
            padding: 9px 16px !important;
            font-size: 13px;
            font-weight: 600;
            transition: .2s ease;
        }

        .carnate-labour-page .cl-btn-clear:hover {
            border-color: #cbd5e1 !important;
            background: #f8fafc !important;
            color: var(--cl-text) !important;
        }

        /* Labour Type Filter Tabs */
        .carnate-labour-page .cl-labour-tabs {
            display: inline-flex;
            align-items: center;
            background: #f1f5f9;
            padding: 4px;
            border-radius: 12px;
            gap: 4px;
            border: 1px solid var(--cl-border);
        }
        .carnate-labour-page .cl-tab-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: 0;
            background: transparent;
            color: var(--cl-muted);
            font-size: 13px;
            font-weight: 600;
            padding: 8px 16px;
            border-radius: 9px;
            cursor: pointer;
            transition: all .2s ease;
        }
        .carnate-labour-page .cl-tab-btn:hover {
            color: var(--cl-text);
            background: rgba(255, 255, 255, 0.6);
        }
        .carnate-labour-page .cl-tab-btn.active {
            background: #ffffff;
            color: var(--cl-red);
            box-shadow: 0 2px 8px rgba(15, 23, 42, 0.08);
            font-weight: 700;
        }
        .carnate-labour-page .cl-tab-count {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 20px;
            height: 20px;
            padding: 0 6px;
            border-radius: 10px;
            font-size: 11px;
            font-weight: 700;
            background: #e2e8f0;
            color: #475569;
        }
        .carnate-labour-page .cl-tab-btn.active .cl-tab-count {
            background: var(--cl-red-soft);
            color: var(--cl-red);
        }

        /* Cards */
        .carnate-labour-page .cl-card {
            background: var(--cl-card);
            border: 1px solid var(--cl-border);
            border-radius: 16px;
            box-shadow: var(--cl-shadow);
            overflow: hidden;
            margin-bottom: 18px;
        }

        .carnate-labour-page .cl-card-body {
            padding: 20px;
        }

        .carnate-labour-page .cl-filter-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
        }

        .carnate-labour-page .cl-search-wrap {
            position: relative;
            width: 100%;
            max-width: 360px;
        }

        .carnate-labour-page .cl-search-icon {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 17px;
            pointer-events: none;
            z-index: 2;
        }

        .carnate-labour-page .cl-search {
            height: 42px;
            width: 100%;
            border: 1px solid var(--cl-border);
            border-radius: 10px;
            padding: 0 14px 0 40px;
            color: var(--cl-text);
            background: #fff;
            font-size: 13px;
            outline: none;
            transition: .2s ease;
        }

        .carnate-labour-page .cl-search:focus {
            border-color: rgba(229, 57, 53, .45);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .08);
        }

        /* Table */
        .carnate-labour-page .cl-table-card {
            overflow: hidden;
        }

        .carnate-labour-page .cl-table-wrap {
            width: 100%;
            overflow-x: auto;
        }

        .carnate-labour-page .cl-table {
            width: 100%;
            min-width: 900px;
            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .carnate-labour-page .cl-table thead th {
            background: #f8fafc;
            color: #475569;
            border-bottom: 1px solid var(--cl-border);
            border-top: 0;
            padding: 13px 15px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .04em;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .carnate-labour-page .cl-table tbody td {
            border-bottom: 1px solid #eef2f7;
            padding: 14px 15px;
            color: var(--cl-text);
            font-size: 13px;
            vertical-align: middle;
            background: #fff;
        }

        .carnate-labour-page .cl-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .carnate-labour-page .cl-table tbody tr {
            transition: background .18s ease;
        }

        .carnate-labour-page .cl-table tbody tr:hover td {
            background: #fafafa;
        }

        .carnate-labour-page .cl-index {
            color: var(--cl-muted);
            font-weight: 600;
        }

        .carnate-labour-page .cl-title {
            font-weight: 700;
            color: var(--cl-text);
        }

        .carnate-labour-page .cl-type-badge,
        .carnate-labour-page .cl-tax-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 9px;
            border-radius: 7px;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        .carnate-labour-page .cl-type-badge {
            background: #f1f5f9;
            color: #475569;
        }

        .carnate-labour-page .cl-tax-badge {
            background: var(--cl-red-soft);
            color: var(--cl-red);
        }

        .carnate-labour-page .cl-price {
            font-weight: 600;
            color: #334155;
            white-space: nowrap;
        }

        .carnate-labour-page .cl-total {
            font-weight: 800;
            color: var(--cl-text);
            white-space: nowrap;
        }

        .carnate-labour-page .cl-actions {
            display: inline-flex;
            align-items: center;
            gap: 7px;
        }

        .carnate-labour-page .cl-action {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            border: 1px solid var(--cl-border);
            background: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            color: #64748b;
            transition: .2s ease;
            cursor: pointer;
        }

        .carnate-labour-page .cl-action.edit:hover {
            color: var(--cl-red);
            border-color: rgba(229, 57, 53, .3);
            background: var(--cl-red-soft);
        }

        .carnate-labour-page .cl-action.delete:hover {
            color: #dc2626;
            border-color: #fecaca;
            background: #fef2f2;
        }

        .carnate-labour-page .cl-action i {
            font-size: 17px;
        }

        /* Empty state */
        .carnate-labour-page .cl-empty {
            padding: 48px 20px;
            text-align: center;
            color: var(--cl-muted);
        }

        .carnate-labour-page .cl-empty-icon {
            width: 52px;
            height: 52px;
            margin: 0 auto 12px;
            border-radius: 14px;
            background: var(--cl-icon);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #94a3b8;
            font-size: 24px;
        }

        .carnate-labour-page .cl-empty-title {
            margin: 0;
            font-size: 14px;
            font-weight: 700;
            color: #475569;
        }

        /* Pagination */
        .carnate-labour-page .cl-pagination {
            padding: 16px 20px;
            border-top: 1px solid var(--cl-border);
        }

        /* Modal */
        .carnate-labour-page .modal {
            z-index: 1055;
        }

        .carnate-labour-page .modal[style*="display: block"] {
            overflow-y: auto;
        }

        .carnate-labour-page .modal-dialog {
            margin-top: 5vh;
        }

        .carnate-labour-page .modal-content {
            border: 0;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 24px 70px rgba(15, 23, 42, .20);
        }

        .carnate-labour-page .modal-header {
            padding: 18px 22px;
            border-bottom: 1px solid var(--cl-border);
            background: #fff;
        }

        .carnate-labour-page .modal-title {
            margin: 0;
            color: var(--cl-text);
            font-size: 18px;
            font-weight: 700;
        }

        .carnate-labour-page .modal-body {
            padding: 22px;
            background: #fff;
        }

        .carnate-labour-page .modal-footer {
            padding: 15px 22px;
            border-top: 1px solid var(--cl-border);
            background: #fafafa;
            gap: 8px;
        }

        .carnate-labour-page .form-label {
            margin-bottom: 7px;
            color: #334155;
            font-size: 13px;
            font-weight: 600;
        }

        .carnate-labour-page .form-control,
        .carnate-labour-page .form-select {
            min-height: 42px;
            border: 1px solid var(--cl-border);
            border-radius: 9px;
            color: var(--cl-text);
            background-color: #fff;
            font-size: 13px;
            box-shadow: none;
            transition: .2s ease;
        }

        .carnate-labour-page .form-control:focus,
        .carnate-labour-page .form-select:focus {
            border-color: rgba(229, 57, 53, .45);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .08);
        }

        .carnate-labour-page .input-group-text {
            min-width: 42px;
            justify-content: center;
            border-color: var(--cl-border);
            background: #f8fafc;
            color: #64748b;
            font-weight: 600;
        }

        .carnate-labour-page .text-danger {
            font-size: 11px;
        }

        .carnate-labour-page .cl-total-input {
            background: #f8fafc !important;
            font-weight: 700;
        }

        .carnate-labour-page .cl-modal-cancel {
            border: 1px solid var(--cl-border) !important;
            background: #fff !important;
            color: #475569 !important;
            border-radius: 9px !important;
            padding: 9px 16px !important;
            font-weight: 600;
        }

        .carnate-labour-page .cl-modal-cancel:hover {
            background: #f8fafc !important;
        }

        .carnate-labour-page .cl-modal-submit {
            border: 0 !important;
            background: var(--cl-red) !important;
            color: #fff !important;
            border-radius: 9px !important;
            padding: 9px 18px !important;
            font-weight: 600;
        }

        .carnate-labour-page .cl-modal-submit:hover {
            background: #c92f2c !important;
        }

        .carnate-labour-page .cl-modal-submit .spinner-border {
            margin-left: 5px;
            width: 13px;
            height: 13px;
            border-width: 2px;
        }

        /* Mobile */
        @media (max-width: 767.98px) {
            .carnate-labour-page .cl-page-header {
                padding: 16px;
            }

            .carnate-labour-page .cl-page-title {
                font-size: 18px;
            }

            .carnate-labour-page .cl-page-subtitle {
                display: none;
            }

            .carnate-labour-page .cl-filter-row {
                flex-direction: column;
                align-items: stretch;
            }

            .carnate-labour-page .cl-search-wrap {
                max-width: none;
            }

            .carnate-labour-page .cl-filter-actions {
                display: flex;
                justify-content: flex-end;
            }

            .carnate-labour-page .modal-dialog {
                margin: 12px;
            }

            .carnate-labour-page .modal-body,
            .carnate-labour-page .modal-header,
            .carnate-labour-page .modal-footer {
                padding: 16px;
            }
        }
    </style>

    {{-- Success Message --}}
    @if (session()->has('message'))
        <div class="cl-alert">
            <i class="bx bx-check-circle me-1"></i>
            {{ session('message') }}
        </div>
    @endif

    {{-- Create / Edit Labour Charge Modal --}}
    <div class="modal @if ($showModal) show @endif"
        tabindex="-1"
        style="opacity:1; background-color:#0606068c; display:@if ($showModal) block @endif">

        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">

                    <div class="modal-header">
                        <div>
                            <h4 class="modal-title">
                                {{ $isEdit ? 'Edit Labour Charge' : 'Create Labour Charge' }}
                            </h4>
                        </div>

                        <button type="button"
                            class="btn-close"
                            wire:click="$set('showModal', false)"
                            data-bs-dismiss="modal"
                            aria-label="Close">
                        </button>
                    </div>

                    <div class="modal-body py-3">
                        @csrf

                        <div class="row g-3">

                            {{-- Title --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">
                                        Title <sup class="text-danger">*</sup>
                                    </label>

                                    <input type="text"
                                        wire:model="title"
                                        class="form-control"
                                        placeholder="Enter Title">
                                </div>

                                @error('title')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Labour Type --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">
                                        Labour Type <sup class="text-danger">*</sup>
                                    </label>

                                    <select wire:model.live="labour_type" class="form-select">
                                        <option value="">Select Labour Type</option>
                                        <option value="inhouse">Inhouse</option>
                                        <option value="outsource">Outsource</option>
                                    </select>

                                    @error('labour_type')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Outsource Price --}}
                            @if ($labour_type === 'outsource')
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">
                                            Outsource Price <sup class="text-danger">*</sup>
                                        </label>

                                        <input type="number"
                                            wire:model.live="outsource_price"
                                            class="form-control"
                                            placeholder="Enter Outsource Price"
                                            min="1"
                                            step="1">
                                    </div>

                                    @error('outsource_price')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endif

                            {{-- Selling Price --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">
                                        Selling Price <sup class="text-danger">*</sup>
                                    </label>

                                    <input type="number"
                                        wire:model.live="price"
                                        class="form-control"
                                        placeholder="Enter Price"
                                        min="1"
                                        step="1">
                                </div>

                                @error('price')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Tax Type --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">
                                        Tax Type
                                    </label>

                                    <select id="tax_type"
                                        class="form-select"
                                        wire:model.live="tax_type">
                                        <option value="">Select Tax Type</option>
                                        <option value="include">Include All Taxes</option>
                                        <option value="exclude">Exclude All Taxes</option>
                                    </select>

                                    @error('tax_type')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Tax Percentage --}}
                            @if ($tax_type == 'include' || $tax_type == 'exclude')
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">
                                            {{ $tax_type == 'include'
                                                ? 'Include Tax Percentage'
                                                : 'Exclude Tax Percentage' }}
                                        </label>

                                        <div class="input-group">
                                            <input type="number"
                                                wire:model.live="tax_percentage"
                                                class="form-control"
                                                placeholder="Enter Percentage"
                                                id="tax_percentage">

                                            <span class="input-group-text">%</span>
                                        </div>

                                        @error('tax_percentage')
                                            <span class="text-danger error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endif

                            {{-- Total Price --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">
                                        Total Price <sup class="text-danger">*</sup>
                                    </label>

                                    <input type="text"
                                        wire:model="total_price"
                                        class="form-control cl-total-input"
                                        readonly>
                                </div>

                                @error('total_price')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button"
                            class="btn cl-modal-cancel"
                            wire:click="$set('showModal', false)"
                            data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <button type="submit" class="btn cl-modal-submit">
                            {{ $isEdit ? 'Update' : 'Create' }}

                            <i class="spinner-border spinner-border-sm"
                                wire:loading>
                            </i>
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    {{-- Page Header --}}
    <div class="cl-page-header">
        <div class="d-flex justify-content-between align-items-center gap-3">

            <div class="cl-page-title-wrap">
                <div class="cl-page-icon">
                    <i class="bx bx-wrench"></i>
                </div>

                <div>
                    <h1 class="cl-page-title">Labour Charge</h1>
                    <p class="cl-page-subtitle">
                        Manage labour charges, pricing and applicable taxes
                    </p>
                </div>
            </div>

            <div>
                <a href="javascript:;"
                    wire:click="create"
                    class="btn cl-btn-primary">
                    <i class="bx bx-plus me-1"></i>
                    Add
                </a>
            </div>

        </div>
    </div>

    {{-- Filters & Tabs --}}
    <div class="cl-card">
        <div class="cl-card-body">

            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-3">
                <div class="cl-labour-tabs">
                    <button type="button"
                        wire:click="setLabourType('')"
                        class="cl-tab-btn {{ $selectedLabourType === '' ? 'active' : '' }}">
                        <i class="bx bx-grid-alt"></i>
                        All
                        <span class="cl-tab-count">{{ $totalCount ?? 0 }}</span>
                    </button>

                    <button type="button"
                        wire:click="setLabourType('inhouse')"
                        class="cl-tab-btn {{ $selectedLabourType === 'inhouse' ? 'active' : '' }}">
                        <i class="bx bx-home-alt"></i>
                        In-house
                        <span class="cl-tab-count">{{ $inhouseCount ?? 0 }}</span>
                    </button>

                    <button type="button"
                        wire:click="setLabourType('outsource')"
                        class="cl-tab-btn {{ $selectedLabourType === 'outsource' ? 'active' : '' }}">
                        <i class="bx bx-share-alt"></i>
                        Outsource
                        <span class="cl-tab-count">{{ $outsourceCount ?? 0 }}</span>
                    </button>
                </div>
            </div>

            <div class="cl-filter-row">

                <div class="cl-search-wrap">
                    <i class="bx bx-search cl-search-icon"></i>

                    <input type="text"
                        class="cl-search"
                        placeholder="Search title"
                        wire:model.live="searchStaff"
                        fdprocessedid="blgf5">
                </div>

                <div class="cl-filter-actions">
                    <button type="button"
                        class="btn cl-btn-clear"
                        wire:click="resetFilter"
                        fdprocessedid="orntg">
                        <i class="bx bx-reset me-1"></i>
                        Clear
                    </button>
                </div>

            </div>

        </div>
    </div>

    {{-- Labour Charges Table --}}
    <div class="cl-card cl-table-card">

        @if (!empty($items) && $items->count())

            <div class="cl-table-wrap">
                <table class="table cl-table">

                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Title</th>
                            <th>Labour Type</th>
                            <th>Outsource Price</th>
                            <th>Selling Price</th>
                            <th>Tax</th>
                            <th>Tax Type</th>
                            <th>Total</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($items as $index => $item)

                            <tr>

                                <td>
                                    <span class="cl-index">
                                        {{ $items->total() - ($items->firstItem() + $index) + 1 }}
                                    </span>
                                </td>

                                <td>
                                    <span class="cl-title">
                                        {{ $item->title }}
                                    </span>
                                </td>

                                <td>
                                    <span class="cl-type-badge">
                                        <i class="bx bx-user-voice"></i>
                                        {{ ucfirst($item->labour_type) }}
                                    </span>
                                </td>

                                <td>
                                    <span class="cl-price">
                                        {{ $item->outsource_price ?? '-' }}
                                    </span>
                                </td>

                                <td>
                                    <span class="cl-price">
                                        {{ $item->price }}
                                    </span>
                                </td>

                                <td>
                                    <span class="cl-tax-badge">
                                        {{ $item->gst }}
                                    </span>
                                </td>

                                <td>
                                    <span class="cl-type-badge">
                                        {{ $item->gst_type }}
                                    </span>
                                </td>

                                <td>
                                    <span class="cl-total">
                                        {{ $item->total }}
                                    </span>
                                </td>

                                <td>
                                    <div class="cl-actions">

                                        <a wire:click="edit({{ $item->id }})"
                                            class="cl-action edit"
                                            title="Edit">
                                            <i class="bx bxs-edit"></i>
                                        </a>

                                        <a wire:click="confirmDelete({{ $item->id }})"
                                            class="cl-action delete"
                                            title="Delete">
                                            <i class="bx bx-trash"></i>
                                        </a>

                                    </div>
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>
            </div>

            <div class="cl-pagination">
                {{ $items->links() }}
            </div>

        @else

            <div class="cl-empty">
                <div class="cl-empty-icon">
                    <i class="bx bx-wrench"></i>
                </div>

                <p class="cl-empty-title">
                    No Labour Charge Found!
                </p>
            </div>

        @endif

    </div>

    {{-- Keep original footer JS --}}
    @section('footerscript')
        <script>
            document.addEventListener('livewire:init', function () {

                Livewire.hook('morphed', (message, component) => {
                    $('.select2').select2().on('change', function(e) {
                        const selectedValues = $(this).val();
                        @this.set(e.target.dataset.property, selectedValues);
                    });
                });

            });
        </script>
    @endsection

</div>