<div class="carnate-modification-page">

    <style>
        .carnate-modification-page {
            --cm-white: #ffffff;
            --cm-text: #111827;
            --cm-muted: #64748b;
            --cm-border: #e2e8f0;
            --cm-red: #e53935;
            --cm-red-soft: #fff5f5;
            --cm-icon: #f1f5f9;
            --cm-green: #16a34a;
            --cm-green-soft: #f0fdf4;
        }

        .carnate-modification-page .cm-card {
            background: var(--cm-white);
            border: 1px solid var(--cm-border);
            border-radius: 14px;
            box-shadow: 0 4px 18px rgba(15, 23, 42, .04);
            overflow: hidden;
        }

        .carnate-modification-page .cm-alert {
            margin-bottom: 18px;
            padding: 12px 15px;
            border: 1px solid #bbf7d0;
            border-radius: 10px;
            background: var(--cm-green-soft);
            color: #166534;
            font-size: 14px;
        }

        /* Page Header */
        .carnate-modification-page .cm-page-header {
            padding: 20px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .carnate-modification-page .cm-title-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .carnate-modification-page .cm-title-icon {
            width: 42px;
            height: 42px;
            border-radius: 11px;
            background: var(--cm-red-soft);
            color: var(--cm-red);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 21px;
        }

        .carnate-modification-page .cm-page-title {
            margin: 0;
            color: var(--cm-text);
            font-size: 20px;
            font-weight: 700;
            letter-spacing: -.2px;
        }

        .carnate-modification-page .cm-page-subtitle {
            margin: 3px 0 0;
            color: var(--cm-muted);
            font-size: 13px;
        }

        .carnate-modification-page .cm-add-btn {
            min-height: 42px;
            padding: 9px 16px;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            border: 0;
            border-radius: 9px;
            background: var(--cm-red);
            color: #fff;
            font-size: 13px;
            font-weight: 600;
            transition: all .2s ease;
        }

        .carnate-modification-page .cm-add-btn:hover {
            background: #cf2f2c;
            color: #fff;
            box-shadow: 0 5px 14px rgba(229, 57, 53, .18);
            transform: translateY(-1px);
        }

        /* Filters */
        .carnate-modification-page .cm-filter-card {
            margin-top: 20px;
            padding: 20px 22px;
        }

        .carnate-modification-page .cm-filter-heading {
            margin: 0;
            color: var(--cm-text);
            font-size: 16px;
            font-weight: 700;
        }

        .carnate-modification-page .cm-filter-subtitle {
            margin: 4px 0 18px;
            color: var(--cm-muted);
            font-size: 12px;
        }

        .carnate-modification-page .cm-label {
            display: block;
            margin-bottom: 7px;
            color: var(--cm-text);
            font-size: 12px;
            font-weight: 600;
        }

        .carnate-modification-page .cm-input,
        .carnate-modification-page .cm-select {
            width: 100%;
            min-height: 44px;
            padding: 9px 13px;
            border: 1px solid var(--cm-border);
            border-radius: 9px;
            background: #fff;
            color: var(--cm-text);
            font-size: 14px;
            outline: none;
            transition: all .2s ease;
        }

        .carnate-modification-page .cm-input::placeholder {
            color: #94a3b8;
        }

        .carnate-modification-page .cm-input:focus,
        .carnate-modification-page .cm-select:focus {
            border-color: rgba(229, 57, 53, .5);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .08);
        }

        .carnate-modification-page .cm-search-wrap {
            position: relative;
        }

        .carnate-modification-page .cm-search-wrap i {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 17px;
            z-index: 2;
        }

        .carnate-modification-page .cm-search-input {
            padding-left: 39px;
        }

        .carnate-modification-page .cm-reset-btn {
            width: 100%;
            min-height: 44px;
            padding: 9px 14px;
            border: 1px solid var(--cm-border);
            border-radius: 9px;
            background: #f8fafc;
            color: #475569;
            font-size: 13px;
            font-weight: 600;
            transition: all .2s ease;
        }

        .carnate-modification-page .cm-reset-btn:hover {
            background: #e2e8f0;
            color: var(--cm-text);
        }

        /* Table */
        .carnate-modification-page .cm-table-card {
            margin-top: 20px;
        }

        .carnate-modification-page .cm-table-wrap {
            overflow-x: auto;
        }

        .carnate-modification-page .cm-table {
            width: 100%;
            min-width: 950px;
            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .carnate-modification-page .cm-table thead th {
            padding: 14px 18px;
            background: #f8fafc;
            border-bottom: 1px solid var(--cm-border);
            color: #64748b;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .5px;
            white-space: nowrap;
        }

        .carnate-modification-page .cm-table tbody td {
            padding: 15px 18px;
            border-bottom: 1px solid #edf2f7;
            color: var(--cm-text);
            font-size: 14px;
            vertical-align: middle;
        }

        .carnate-modification-page .cm-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .carnate-modification-page .cm-table tbody tr {
            transition: background .15s ease;
        }

        .carnate-modification-page .cm-table tbody tr:hover {
            background: #fafafa;
        }

        .carnate-modification-page .cm-number {
            color: #94a3b8 !important;
            font-size: 13px !important;
            font-weight: 600;
        }

        .carnate-modification-page .cm-main-cell {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .carnate-modification-page .cm-cell-icon {
            width: 35px;
            height: 35px;
            flex: 0 0 35px;
            border-radius: 9px;
            background: var(--cm-icon);
            color: #475569;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
        }

        .carnate-modification-page .cm-main-title {
            color: var(--cm-text);
            font-weight: 600;
        }

        .carnate-modification-page .cm-secondary {
            color: #475569;
            font-size: 13px;
            font-weight: 500;
        }

        .carnate-modification-page .cm-year {
            display: inline-flex;
            align-items: center;
            padding: 5px 10px;
            border: 1px solid var(--cm-border);
            border-radius: 7px;
            background: #f8fafc;
            color: #475569;
            font-size: 12px;
            font-weight: 600;
        }

        /* Status */
        .carnate-modification-page .cm-status {
            display: flex;
            align-items: center;
            gap: 9px;
            white-space: nowrap;
        }

        .carnate-modification-page .cm-status .form-check {
            margin: 0;
            padding-left: 2.5em;
        }

        .carnate-modification-page .cm-status .form-check-input {
            width: 2.2em;
            height: 1.15em;
            margin-left: -2.5em;
            cursor: pointer;
            background-color: #cbd5e1;
            border-color: #cbd5e1;
            box-shadow: none;
        }

        .carnate-modification-page .cm-status .form-check-input:checked {
            background-color: var(--cm-green);
            border-color: var(--cm-green);
        }

        .carnate-modification-page .cm-status .form-check-input:focus {
            box-shadow: none;
        }

        .carnate-modification-page .cm-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }

        .carnate-modification-page .cm-badge-active {
            background: #ecfdf3;
            color: #15803d;
        }

        .carnate-modification-page .cm-badge-inactive {
            background: #fef2f2;
            color: #b91c1c;
        }

        /* Actions */
        .carnate-modification-page .cm-actions {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 7px;
        }

        .carnate-modification-page .cm-action {
            width: 34px;
            height: 34px;
            padding: 0;
            border: 1px solid var(--cm-border);
            border-radius: 8px;
            background: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all .2s ease;
        }

        .carnate-modification-page .cm-edit {
            color: #475569;
        }

        .carnate-modification-page .cm-edit:hover {
            color: var(--cm-red);
            border-color: rgba(229, 57, 53, .25);
            background: var(--cm-red-soft);
        }

        .carnate-modification-page .cm-delete {
            color: #64748b;
        }

        .carnate-modification-page .cm-delete:hover {
            color: #dc2626;
            border-color: #fecaca;
            background: #fef2f2;
        }

        .carnate-modification-page .cm-pagination {
            padding: 16px 20px;
            border-top: 1px solid var(--cm-border);
        }

        .carnate-modification-page .cm-result-info {
            color: var(--cm-muted);
            font-size: 12px;
        }

        /* Empty */
        .carnate-modification-page .cm-empty {
            padding: 55px 20px;
            text-align: center;
        }

        .carnate-modification-page .cm-empty-icon {
            width: 52px;
            height: 52px;
            margin: 0 auto 13px;
            border-radius: 13px;
            background: var(--cm-icon);
            color: #94a3b8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .carnate-modification-page .cm-empty-title {
            margin: 0;
            color: var(--cm-text);
            font-size: 15px;
            font-weight: 600;
        }

        .carnate-modification-page .cm-empty-text {
            margin: 5px 0 12px;
            color: var(--cm-muted);
            font-size: 13px;
        }

        .carnate-modification-page .cm-empty-link {
            border: 0;
            background: transparent;
            color: var(--cm-red);
            font-size: 13px;
            font-weight: 600;
        }

        /* Modal */
        .carnate-modification-page .cm-modal {
            position: fixed;
            inset: 0;
            z-index: 1055;
            overflow-x: hidden;
            overflow-y: auto;
            background: rgba(15, 23, 42, .55);
            backdrop-filter: blur(3px);
        }

        .carnate-modification-page .cm-modal-dialog {
            width: calc(100% - 30px);
            max-width: 760px;
            margin: 55px auto 30px;
        }

        .carnate-modification-page .cm-modal-content {
            background: #fff;
            border: 1px solid var(--cm-border);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(15, 23, 42, .18);
        }

        .carnate-modification-page .cm-modal-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--cm-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .carnate-modification-page .cm-modal-title-wrap {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .carnate-modification-page .cm-modal-icon {
            width: 36px;
            height: 36px;
            border-radius: 9px;
            background: var(--cm-red-soft);
            color: var(--cm-red);
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .carnate-modification-page .cm-modal-title {
            margin: 0;
            color: var(--cm-text);
            font-size: 18px;
            font-weight: 700;
        }

        .carnate-modification-page .cm-close {
            width: 34px;
            height: 34px;
            border: 0;
            border-radius: 8px;
            background: var(--cm-icon);
            color: var(--cm-muted);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .carnate-modification-page .cm-close:hover {
            background: #e2e8f0;
            color: var(--cm-text);
        }

        .carnate-modification-page .cm-modal-body {
            padding: 24px;
        }

        .carnate-modification-page .cm-field {
            margin-bottom: 2px;
        }

        .carnate-modification-page .cm-field-label {
            display: block;
            margin-bottom: 8px;
            color: var(--cm-text);
            font-size: 13px;
            font-weight: 600;
        }

        .carnate-modification-page .cm-field-label sup {
            color: var(--cm-red);
            font-size: 12px;
        }

        .carnate-modification-page .cm-field-help {
            display: block;
            margin-top: 6px;
            color: #94a3b8;
            font-size: 11px;
        }

        .carnate-modification-page .cm-error {
            display: block;
            margin-top: 6px;
            color: #dc2626;
            font-size: 12px;
        }

        .carnate-modification-page .cm-modal-footer {
            padding: 16px 24px;
            border-top: 1px solid var(--cm-border);
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .carnate-modification-page .cm-secondary-btn {
            min-height: 41px;
            padding: 9px 17px;
            border: 1px solid var(--cm-border);
            border-radius: 8px;
            background: #f1f5f9;
            color: #475569;
            font-size: 13px;
            font-weight: 600;
        }

        .carnate-modification-page .cm-secondary-btn:hover {
            background: #e2e8f0;
            color: var(--cm-text);
        }

        .carnate-modification-page .cm-primary-btn {
            min-height: 41px;
            padding: 9px 17px;
            border: 0;
            border-radius: 8px;
            background: var(--cm-red);
            color: #fff;
            font-size: 13px;
            font-weight: 600;
            transition: all .2s ease;
        }

        .carnate-modification-page .cm-primary-btn:hover {
            background: #cf2f2c;
            color: #fff;
        }

        @media (max-width: 767px) {
            .carnate-modification-page .cm-page-header {
                padding: 16px;
                align-items: flex-start;
            }

            .carnate-modification-page .cm-page-title {
                font-size: 17px;
            }

            .carnate-modification-page .cm-add-btn {
                padding: 9px 12px;
            }

            .carnate-modification-page .cm-filter-card {
                padding: 17px;
            }

            .carnate-modification-page .cm-modal-dialog {
                margin-top: 25px;
            }

            .carnate-modification-page .cm-modal-body {
                padding: 18px;
            }

            .carnate-modification-page .cm-modal-header,
            .carnate-modification-page .cm-modal-footer {
                padding: 16px 18px;
            }

            .carnate-modification-page .cm-pagination > .d-flex {
                display: block !important;
            }

            .carnate-modification-page .cm-result-info {
                margin-bottom: 12px;
            }
        }
    </style>

    @php
        $admin = App\Models\Admin::where('id', $adminId)->first();
    @endphp

    {{-- Success Message --}}
    @if (session()->has('message'))
        <div class="cm-alert">
            <i class="bx bx-check-circle me-1"></i>
            {{ session('message') }}
        </div>
    @endif

    {{-- Add / Edit Modal --}}
    <div class="cm-modal"
        tabindex="-1"
        style="display:@if ($showModal) block @else none @endif"
        aria-modal="true"
        role="dialog">

        <div class="cm-modal-dialog">
            <div class="cm-modal-content">

                <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">

                    <div class="cm-modal-header">

                        <div class="cm-modal-title-wrap">
                            <span class="cm-modal-icon">
                                <i class="bx {{ $isEdit ? 'bx-edit' : 'bx-plus' }}"></i>
                            </span>

                            <h5 class="cm-modal-title">
                                {{ $isEdit ? 'Update' : 'New' }} Modification
                            </h5>
                        </div>

                        <button type="button"
                            class="cm-close"
                            wire:click="$set('showModal', false)"
                            aria-label="Close">
                            <i class="bx bx-x"></i>
                        </button>

                    </div>

                    <div class="cm-modal-body">
                        @csrf

                        <div class="row g-4">

                            {{-- Title --}}
                            <div class="col-md-12">
                                <div class="cm-field">
                                    <label class="cm-field-label">
                                        Modification Title / Engine Name <sup>*</sup>
                                    </label>

                                    <input type="text"
                                        wire:model="title"
                                        class="cm-input"
                                        placeholder="e.g. 2.0 TDI or 320d">
                                </div>

                                @error('title')
                                    <small class="cm-error">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Brand --}}
                            <div class="col-md-6">
                                <div class="cm-field">
                                    <label class="cm-field-label">
                                        Brand <sup>*</sup>
                                    </label>

                                    <select class="cm-select"
                                        wire:model.live="brand">

                                        <option value="">Select Brand</option>

                                        @foreach ($brands as $id => $name)
                                            <option value="{{ $id }}">
                                                {{ $name }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>

                                @error('brand')
                                    <small class="cm-error">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Variant --}}
                            <div class="col-md-6">
                                <div class="cm-field">
                                    <label class="cm-field-label">
                                        Variant <sup>*</sup>
                                    </label>

                                    <select class="cm-select"
                                        wire:model="variant">

                                        <option value="">Select Variant</option>

                                        @foreach ($variants as $id => $name)
                                            <option value="{{ $id }}">
                                                {{ $name }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>

                                @error('variant')
                                    <small class="cm-error">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Manufacturing Year --}}
                            <div class="col-md-6">
                                <div class="cm-field">

                                    <label class="cm-field-label">
                                        Manufacturing Year <sup>*</sup>
                                    </label>

                                    <select class="cm-select"
                                        wire:model="year"
                                        @if (!$isEdit) multiple style="height:120px;" @endif>

                                        <option value="">Select Year</option>

                                        @foreach ($years as $y)
                                            <option value="{{ $y }}">
                                                {{ $y }}
                                            </option>
                                        @endforeach

                                    </select>

                                    <small class="cm-field-help">
                                        @if (!$isEdit)
                                            Hold Ctrl to select multiple years
                                        @endif
                                    </small>

                                </div>

                                @error('year')
                                    <br>
                                    <small class="cm-error">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Status --}}
                            <div class="col-md-6">
                                <div class="cm-field">

                                    <label class="cm-field-label">
                                        Status
                                    </label>

                                    <select class="cm-select"
                                        wire:model="status">

                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>

                                    </select>

                                </div>

                                @error('status')
                                    <small class="cm-error">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <div class="cm-modal-footer">

                        <button type="button"
                            class="cm-secondary-btn"
                            wire:click="$set('showModal', false)">
                            Cancel
                        </button>

                        <button type="submit"
                            class="cm-primary-btn">

                            <span wire:loading.remove
                                wire:target="{{ $isEdit ? 'update' : 'store' }}">
                                {{ $isEdit ? 'Save Changes' : 'Create Modification' }}
                            </span>

                            <span wire:loading
                                wire:target="{{ $isEdit ? 'update' : 'store' }}">
                                <i class="bx bx-loader-alt bx-spin me-1"></i>
                                Processing...
                            </span>

                        </button>

                    </div>

                </form>

            </div>
        </div>
    </div>

    {{-- Page Header --}}
    <div class="cm-card">

        <div class="cm-page-header">

            <div class="cm-title-wrap">

                <div class="cm-title-icon">
                    <i class="bx bx-cog"></i>
                </div>

                <div>
                    <h4 class="cm-page-title">
                        Vehicle Modifications
                    </h4>

                    <p class="cm-page-subtitle">
                        Manage engine types and model variants
                    </p>
                </div>

            </div>

            @if (@$admin->hasPermissionTo('modification-add'))
                <button wire:click="create"
                    class="cm-add-btn">
                    <i class="bx bx-plus"></i>
                    Add Modification
                </button>
            @endif

        </div>

    </div>

    {{-- Filters --}}
    <div class="cm-card cm-filter-card">

        <h5 class="cm-filter-heading">
            Search & Filters
        </h5>

        <p class="cm-filter-subtitle">
            Filter vehicle modifications by title, brand, variant, year or status
        </p>

        <div class="row g-3">

            {{-- Search --}}
            <div class="col-lg-3 col-md-6">

                <label class="cm-label">Search</label>

                <div class="cm-search-wrap">
                    <i class="bx bx-search"></i>

                    <input type="text"
                        class="cm-input cm-search-input"
                        placeholder="Search title, brand..."
                        wire:model.live.debounce.300ms="search">
                </div>

            </div>

            {{-- Brand --}}
            <div class="col-lg-2 col-md-6">

                <label class="cm-label">Brand</label>

                <select class="cm-select"
                    wire:model.live="filter_brand">

                    <option value="">All Brands</option>

                    @foreach ($filter_brands as $id => $name)
                        <option value="{{ $id }}">
                            {{ $name }}
                        </option>
                    @endforeach

                </select>

            </div>

            {{-- Variant --}}
            <div class="col-lg-2 col-md-6">

                <label class="cm-label">Variant</label>

                <select class="cm-select"
                    wire:model.live="filter_variant"
                    @disabled(!$filter_brand)>

                    <option value="">All Variants</option>

                    @foreach ($filter_variants as $id => $name)
                        <option value="{{ $id }}">
                            {{ $name }}
                        </option>
                    @endforeach

                </select>

            </div>

            {{-- Year --}}
            <div class="col-lg-2 col-md-6">

                <label class="cm-label">Year</label>

                <select class="cm-select"
                    wire:model.live="filter_year">

                    <option value="">All Years</option>

                    @foreach ($years as $y)
                        <option value="{{ $y }}">
                            {{ $y }}
                        </option>
                    @endforeach

                </select>

            </div>

            {{-- Status --}}
            <div class="col-lg-2 col-md-6">

                <label class="cm-label">Status</label>

                <select class="cm-select"
                    wire:model.live="filter_status">

                    <option value="">Any Status</option>
                    <option value="1">Active Only</option>
                    <option value="0">Inactive Only</option>

                </select>

            </div>

            {{-- Reset --}}
            <div class="col-lg-1 col-md-6 d-flex align-items-end">

                <button type="button"
                    class="cm-reset-btn"
                    wire:click="resetFilter"
                    title="Reset Filters">

                    <i class="bx bx-refresh"></i>
                    <span class="d-lg-none ms-1">Reset</span>

                </button>

            </div>

        </div>

    </div>

    {{-- Table --}}
    <div class="cm-card cm-table-card">

        <div class="cm-table-wrap">

            <table class="cm-table">

                <thead>
                    <tr>

                        <th style="width:80px;">S.No.</th>

                        <th>Title / Engine Name</th>

                        <th>Brand</th>

                        <th>Variant / Model</th>

                        <th>Year</th>

                        <th>Status</th>

                        @if (@$admin->hasPermissionTo('modification-edit') || @$admin->hasPermissionTo('modification-delete'))
                            <th class="text-end pe-4">
                                Actions
                            </th>
                        @endif

                    </tr>
                </thead>

                <tbody>

                    @forelse ($modifications as $index => $item)

                        <tr wire:key="mod-{{ $item->id }}">

                            <td class="cm-number">
                                {{ $modifications->firstItem() + $index }}
                            </td>

                            <td>

                                <div class="cm-main-cell">

                                    <span class="cm-cell-icon">
                                        <i class="bx bx-cog"></i>
                                    </span>

                                    <div>
                                        <div class="cm-main-title">
                                            {{ $item->title ?? 'N/A' }}
                                        </div>
                                    </div>

                                </div>

                            </td>

                            <td>
                                <span class="cm-secondary">
                                    {{ $item->brand_name }}
                                </span>
                            </td>

                            <td>
                                <span class="cm-secondary">
                                    {{ $item->variant_name }}
                                </span>
                            </td>

                            <td>

                                <span class="cm-year">
                                    {{ $item->year }}
                                </span>

                            </td>

                            <td>

                                <div class="cm-status">

                                    <div class="form-check form-switch">
                                        <input class="form-check-input"
                                            type="checkbox"
                                            role="switch"
                                            wire:change="toggleStatus({{ $item->id }}, {{ $item->status == 1 ? 0 : 1 }})"
                                            @checked($item->status == 1)>
                                    </div>

                                    <span class="cm-badge {{ $item->status == 1 ? 'cm-badge-active' : 'cm-badge-inactive' }}">
                                        {{ $item->status == 1 ? 'Active' : 'Inactive' }}
                                    </span>

                                </div>

                            </td>

                            @if (@$admin->hasPermissionTo('modification-edit') || @$admin->hasPermissionTo('modification-delete'))

                                <td class="text-end pe-4">

                                    <div class="cm-actions">

                                        @if (@$admin->hasPermissionTo('modification-edit'))
                                            <button type="button"
                                                wire:click="edit({{ $item->id }})"
                                                class="cm-action cm-edit"
                                                title="Edit">

                                                <i class="bx bx-edit-alt"></i>

                                            </button>
                                        @endif

                                        @if (@$admin->hasPermissionTo('modification-delete'))
                                            <button type="button"
                                                wire:click="confirmDelete({{ $item->id }})"
                                                class="cm-action cm-delete"
                                                title="Delete">

                                                <i class="bx bx-trash"></i>

                                            </button>
                                        @endif

                                    </div>

                                </td>

                            @endif

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7">

                                <div class="cm-empty">

                                    <div class="cm-empty-icon">
                                        <i class="bx bx-car"></i>
                                    </div>

                                    <h5 class="cm-empty-title">
                                        No vehicle modifications found
                                    </h5>

                                    <p class="cm-empty-text">
                                        No modifications match your current search or filter criteria.
                                    </p>

                                    <button type="button"
                                        class="cm-empty-link"
                                        wire:click="resetFilter">
                                        Clear all filters
                                    </button>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        @if ($modifications->hasPages())

            <div class="cm-pagination">

                <div class="d-flex justify-content-between align-items-center">

                    <div class="cm-result-info">
                        Showing {{ $modifications->firstItem() }}
                        to {{ $modifications->lastItem() }}
                        of {{ $modifications->total() }} results
                    </div>

                    <div>
                        {{ $modifications->links() }}
                    </div>

                </div>

            </div>

        @endif

    </div>

</div>