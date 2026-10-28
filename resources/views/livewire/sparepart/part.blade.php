<div class="carnate-parts-page">
    <style>
        /* ── Premium Parts Page Styles ── */
        :root {
            --brand: #e53935;
            --brand-light: #fff5f5;
            --brand-mid: #c62828;
            --accent: #e53935;
            --success: #16a34a;
            --warning: #d97706;
            --danger: #dc2626;
        }
        #suitable_for_select + .select2-container .select2-selection--multiple {
            max-height: 120px !important;
            overflow-y: auto !important;
        }
        /* ── Stat Cards ── */
        .sp-stat-card {
            border-radius: 16px;
            border: none;
            padding: 18px 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            transition: transform .2s, box-shadow .2s;
        }
        .sp-stat-card:hover { transform: translateY(-3px); box-shadow: 0 8px 24px rgba(0,0,0,.10) !important; }
        .sp-stat-icon {
            width: 52px; height: 52px;
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.6rem;
            flex-shrink: 0;
        }
        /* ── Table ── */
        .parts-table thead th { font-size: 11px; letter-spacing: .7px; padding: 14px 12px; white-space: nowrap; }
        .parts-table tbody td { padding: 12px 12px; vertical-align: middle; }
        .parts-table tbody tr { transition: background .15s; }
        .parts-table tbody tr:hover { background: #fff8f8; }
        .part-img { width:52px;height:52px;border-radius:10px;object-fit:cover;border:1px solid #e2e8f0; }
        /* ── Action Buttons ── */
        .action-btn {
            width: 34px; height: 34px;
            border-radius: 10px;
            display: inline-flex; align-items: center; justify-content: center;
            font-size: 1rem;
            border: 1px solid #e2e8f0;
            background: #fff;
            color: #64748b;
            transition: all .2s;
        }
        .action-btn:hover.view  { background: #fff5f5; color: #e53935; border-color: #fecaca; }
        .action-btn:hover.edit  { background: #fff5f5; color: #c62828; border-color: #fecaca; }
        .action-btn:hover.del   { background: #fef2f2; color: #ef4444; border-color: #fecaca; }
        /* ── Form Sections ── */
        .form-section {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            overflow: hidden;
            margin-bottom: 24px;
        }
        .form-section-header {
            background: linear-gradient(135deg, var(--brand-light) 0%, #f0f9ff 100%);
            padding: 14px 20px;
            border-bottom: 1px solid #e2e8f0;
            display: flex; align-items: center; gap: 10px;
        }
        .form-section-header .icon-wrap {
            width: 34px; height: 34px;
            border-radius: 10px;
            background: var(--brand);
            color: #fff;
            display: flex; align-items: center; justify-content: center;
            font-size: 1rem;
        }
        .form-section-body { padding: 20px; }
        /* ── Price Display Cards ── */
        .price-display {
            background: linear-gradient(135deg, #f0fdf4, #dcfce7);
            border: 1px solid #bbf7d0;
            border-radius: 12px;
            padding: 12px 16px;
            text-align: center;
        }
        .price-display.offline {
            background: linear-gradient(135deg, #eff6ff, #dbeafe);
            border-color: #bfdbfe;
        }
        /* ── Vehicle Badges ── */
        .vehicle-badge {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 5px 10px;
            border-radius: 8px;
            font-size: 12px; font-weight: 600;
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
            color: #475569;
            transition: all .2s;
        }
        .vehicle-badge .remove-btn {
            background: none; border: none;
            color: #94a3b8; font-size: 10px; cursor: pointer;
            padding: 0; margin-left: 2px;
            line-height: 1;
        }
        .vehicle-badge .remove-btn:hover { color: #ef4444; }
        /* ── Search Bar ── */
        .search-wrap { position: relative; }
        .search-wrap .search-icon {
            position: absolute; left: 14px; top: 50%;
            transform: translateY(-50%);
            color: #94a3b8; font-size: 1.1rem; pointer-events: none;
        }
        .search-wrap input { padding-left: 40px; border-radius: 10px; }
        /* ── Filter Chips ── */
        .filter-select {
            border-radius: 10px !important;
            border: 1.5px solid #e2e8f0 !important;
            font-size: 13px;
            padding: 8px 12px;
            background-color: #fff;
            transition: border-color .2s;
        }
        .filter-select:focus { border-color: var(--brand) !important; box-shadow: 0 0 0 3px rgba(229,57,53,.08) !important; }
        /* ── Header gradient ── */
        .page-header-gradient {
            background: #ffffff;
            border-radius: 18px;
            padding: 28px 30px;
            color: #111827;
            position: relative;
            overflow: hidden;
            margin-bottom: 28px;
        }
        .page-header-gradient::before {
            content: '';
            position: absolute;
            right: -40px; top: -40px;
            width: 200px; height: 200px;
            border-radius: 50%;
            background: rgba(229,57,53,.06);
        }
        .page-header-gradient::after {
            content: '';
            position: absolute;
            right: 60px; bottom: -60px;
            width: 150px; height: 150px;
            border-radius: 50%;
            background: rgba(229,57,53,.04);
        }
        /* ── Empty State ── */
        .empty-state { padding: 60px 20px; text-align: center; }
        .empty-state-icon { font-size: 5rem; color: #cbd5e1; margin-bottom: 16px; }
        /* ── Catalog vehicle checkbox cards ── */
        .vehicle-check-card {
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            padding: 10px 12px;
            cursor: pointer;
            transition: all .2s;
            background: #fff;
        }
        .vehicle-check-card:hover { border-color: var(--brand); background: var(--brand-light); }
        .vehicle-check-card input:checked + label .vehicle-check-card { border-color: var(--brand); background: var(--brand-light); }
        /* ── Form labels ── */
        .form-label { font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 6px; }
        .form-control, .form-select {
            border-radius: 10px !important;
            border: 1.5px solid #e2e8f0 !important;
            font-size: 14px;
            transition: border-color .2s, box-shadow .2s;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--brand) !important;
            box-shadow: 0 0 0 3px rgba(229,57,53,.08) !important;
        }
        .input-group-text {
            border-radius: 10px 0 0 10px !important;
            border: 1.5px solid #e2e8f0 !important;
            background: #f8fafc;
        }
        .input-group .form-control { border-radius: 0 10px 10px 0 !important; }
        .input-group .form-control:not(:last-child) { border-radius: 0 !important; }
        .input-group .btn { border-radius: 0 10px 10px 0 !important; }
        /* Animate flash */
        @keyframes slideDown { from { opacity:0; transform:translateY(-10px); } to { opacity:1; transform:translateY(0); } }
        .flash-msg { animation: slideDown .35s ease; }
    
        /* ── Carnate UI refresh ── */
        .carnate-parts-page {
            --cp-bg: #f7f8fa;
            --cp-card: #ffffff;
            --cp-text: #111827;
            --cp-muted: #64748b;
            --cp-border: #e2e8f0;
            --cp-red: #e53935;
            --cp-red-soft: #fff5f5;
            color: var(--cp-text);
        }
        .carnate-parts-page .page-header-gradient {
            border: 1px solid var(--cp-border);
            box-shadow: 0 6px 24px rgba(15,23,42,.05);
            padding: 22px 24px;
        }
        .carnate-parts-page .page-header-gradient h4 {
            color: var(--cp-text);
            font-size: 20px;
            letter-spacing: -.2px;
        }
        .carnate-parts-page .page-header-gradient p,
        .carnate-parts-page .page-header-gradient .breadcrumb {
            color: var(--cp-muted) !important;
        }
        .carnate-parts-page .card,
        .carnate-parts-page .form-section {
            box-shadow: 0 4px 18px rgba(15,23,42,.045) !important;
        }
        .carnate-parts-page .form-section-header {
            background: #fff;
            padding: 15px 18px;
        }
        .carnate-parts-page .form-section-header .icon-wrap {
            background: var(--cp-red-soft);
            color: var(--cp-red);
            border: 1px solid #fecaca;
        }
        .carnate-parts-page .form-section-body {
            padding: 22px;
        }
        .carnate-parts-page .parts-table thead th {
            background: #f8fafc !important;
            color: #64748b !important;
            font-weight: 700;
            text-transform: uppercase;
        }
        .carnate-parts-page .parts-table tbody tr:hover {
            background: #fffafa;
        }
        .carnate-parts-page .action-btn {
            box-shadow: 0 1px 2px rgba(15,23,42,.04);
        }
        .carnate-parts-page .btn-primary {
            background: var(--cp-red) !important;
            border-color: var(--cp-red) !important;
        }
        .carnate-parts-page .btn-primary:hover {
            background: #c62828 !important;
            border-color: #c62828 !important;
        }
        .carnate-parts-page .form-control:focus,
        .carnate-parts-page .form-select:focus {
            border-color: var(--cp-red) !important;
            box-shadow: 0 0 0 3px rgba(229,57,53,.08) !important;
        }
        .carnate-parts-page .filter-select:focus {
            border-color: var(--cp-red) !important;
        }
        .carnate-parts-page .vehicle-check-card:hover {
            border-color: #f3a3a0;
            background: #fffafa;
        }
        .carnate-parts-page .vehicle-badge {
            background: #f8fafc;
        }
        .carnate-parts-page .modal-content {
            border: 1px solid var(--cp-border) !important;
            box-shadow: 0 24px 70px rgba(15,23,42,.16) !important;
        }
        .carnate-parts-page .modal-header {
            background: #fff !important;
            color: var(--cp-text) !important;
            border-bottom: 1px solid var(--cp-border) !important;
        }
        .carnate-parts-page .modal-header .btn-close {
            filter: none !important;
        }
        .carnate-parts-page .price-display,
        .carnate-parts-page .price-display.offline {
            background: #f8fafc;
            border: 1px solid var(--cp-border);
        }
        .carnate-parts-page .price-display .fs-5 {
            color: var(--cp-red) !important;
        }
        .carnate-parts-page .empty-state {
            padding: 72px 20px;
        }
        .carnate-parts-page .empty-state-icon {
            color: #cbd5e1;
        }
        @media (max-width: 767.98px) {
            .carnate-parts-page .page-header-gradient {
                padding: 18px;
            }
            .carnate-parts-page .page-header-gradient > div {
                flex-direction: column;
                align-items: flex-start !important;
                gap: 16px;
            }
            .carnate-parts-page .page-header-gradient .btn {
                width: 100%;
                justify-content: center;
            }
            .carnate-parts-page .form-section-body {
                padding: 16px;
            }
            .carnate-parts-page .d-flex.gap-3.align-items-center {
                flex-wrap: wrap;
            }
            .carnate-parts-page .search-wrap {
                min-width: 100%;
            }
        }

    </style>

    {{-- Flash Message --}}
    @if (session()->has('message'))
        <div class="alert border-0 d-flex align-items-center gap-2 flash-msg"
             style="background:linear-gradient(90deg,#dcfce7,#f0fdf4);border-left:4px solid #22c55e !important;border-radius:12px;">
            <i class='bx bx-check-circle text-success fs-5'></i>
            <span class="fw-semibold text-success">{{ session('message') }}</span>
        </div>
    @endif

    @php $sparePart = App\Models\SparePartVendor::where('id', $sparepartId)->first(); @endphp

    {{-- ================================================================= --}}
    {{--  LIST VIEW                                                         --}}
    {{-- ================================================================= --}}
    @if ($step === 'list')

        {{-- ── Page Header ── --}}
        <div class="page-header-gradient shadow-sm mb-4">
            <div class="d-flex align-items-center justify-content-between position-relative" style="z-index:1;">
                <div>
                    <div class="d-flex align-items-center gap-3 mb-1">
                        <div style="width:46px;height:46px;background:#fff5f5;border:1px solid #fecaca;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;color:#e53935;">
                            <i class='bx bx-package'></i>
                        </div>
                        <div>
                            <h4 class="fw-bold mb-0">Spare Parts Inventory</h4>
                            <p class="mb-0 opacity-75 small">Manage your complete parts catalog</p>
                        </div>
                    </div>
                </div>
                @if (@$sparePart->hasPermissionTo('part-add'))
                    <a href="{{ route('sparepart.parts.create') }}"
                       class="btn fw-bold px-4 py-2 d-flex align-items-center gap-2"
                       style="background:var(--brand);color:#fff;border-radius:12px;white-space:nowrap;box-shadow:0 4px 14px rgba(0,0,0,.12);">
                        <i class="bx bx-plus-circle fs-5"></i> Add New Part
                    </a>
                @endif
            </div>
        </div>

        {{-- ── Filter Panel ── --}}
        <div class="card border-0 shadow-sm mb-4" style="border-radius:16px;">
            <div class="card-body p-4">
                {{-- Vehicle Filter Header --}}
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div style="width:32px;height:32px;background:var(--brand);border-radius:9px;display:flex;align-items:center;justify-content:center;color:#fff;">
                        <i class='bx bx-car fs-6'></i>
                    </div>
                    <span class="fw-bold" style="color:var(--brand);">Vehicle-Specific Filter</span>
                    <span class="text-muted small">— filter parts by chassis no (VIN) or vehicle details</span>
                </div>

                {{-- 🔹 Chassis No (VIN) Filter Section (Commented)
                <div class="row g-2 align-items-end mb-3 pb-3" style="border-bottom: 1px dashed #e2e8f0;">
                    <div class="col-md-6 col-lg-5">
                        <label class="form-label font-12 fw-bold text-muted mb-1">
                            <i class='bx bx-barcode-reader me-1'></i> Chassis No (VIN) Filter
                        </label>
                        <div class="input-group">
                            <input type="text" wire:model.live.debounce.500ms="chassisNo" class="form-control"
                                placeholder="Enter 17-digit Chassis No / VIN"
                                oninput="this.value = this.value.toUpperCase().replace(/[^A-Z0-9]/g, '')">
                            <button type="button" class="btn btn-primary px-3" wire:click="fetchVehicleByVin" wire:loading.attr="disabled">
                                <span wire:loading.remove wire:target="fetchVehicleByVin"><i class="bx bx-search"></i> Filter by VIN</span>
                                <span wire:loading wire:target="fetchVehicleByVin"><span class="spinner-border spinner-border-sm me-1"></span> Fetching...</span>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-7">
                        @if ($chassisNo && ($brand_name || $variant_name))
                            <div class="d-flex align-items-center gap-2 text-success small pt-2">
                                <i class='bx bx-check-circle fs-5'></i>
                                <span>Filtered by VIN: <strong>{{ $brand_name }} {{ $variant_name }} {{ $selected_year ? "($selected_year)" : '' }}</strong></span>
                            </div>
                        @else
                            <small class="text-muted d-block pt-2">Enter 17-digit VIN to automatically select Brand, Model, Year & Spec to filter suitable parts.</small>
                        @endif
                    </div>
                </div>
                --}}

                <div class="row g-3 mb-4">
                    <div class="col-md-3">
                        <label class="form-label">Vehicle Brand</label>
                        <select class="form-select filter-select" wire:model.live="brand_name" wire:key="brand-select-{{ $brand_name }}">
                            <option value="">All Brands</option>
                            @foreach ($brands as $brand)
                                @php
                                    $bVal = is_array($brand) ? ($brand['name'] ?? '') : $brand;
                                    $isBrandSel = !empty($brand_name) && (strcasecmp((string)$brand_name, (string)$bVal) === 0);
                                @endphp
                                <option value="{{ $bVal }}" {{ $isBrandSel ? 'selected' : '' }}>{{ $bVal }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Variant Name</label>
                        <select class="form-select filter-select" wire:model.live="variant_name" {{ empty($brand_name) ? 'disabled' : '' }} wire:key="variant-select-{{ $variant_name }}-{{ $brand_name }}">
                            <option value="">All Variants</option>
                            @foreach ($variants as $variant)
                                @php
                                    $vVal = is_array($variant) ? ($variant['name'] ?? '') : $variant;
                                    $isVarSel = !empty($variant_name) && (strcasecmp((string)$variant_name, (string)$vVal) === 0);
                                @endphp
                                <option value="{{ $vVal }}" {{ $isVarSel ? 'selected' : '' }}>{{ $vVal }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Model Year</label>
                        <select class="form-select filter-select" wire:model.live="selected_year" {{ empty($variant_name) ? 'disabled' : '' }} wire:key="year-select-{{ $selected_year }}">
                            <option value="">All Years</option>
                            @foreach ($years as $year)
                                @php
                                    $yVal = is_array($year) ? ($year['value'] ?? '') : $year;
                                    $yLbl = is_array($year) ? ($year['label'] ?? '') : $year;
                                    $isYrSel = !empty($selected_year) && ((string)$selected_year === (string)$yVal);
                                @endphp
                                <option value="{{ $yVal }}" {{ $isYrSel ? 'selected' : '' }}>{{ $yLbl }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Engine / Spec</label>
                        <select class="form-select filter-select" wire:model.live="modification_id" {{ empty($selected_year) ? 'disabled' : '' }} wire:key="mod-select-{{ $modification_id }}">
                            <option value="">All Modifications</option>
                            @foreach ($filter_modifications as $mod)
                                @php
                                    $mId = is_array($mod) ? ($mod['id'] ?? '') : $mod;
                                    $mName = is_array($mod) ? ($mod['name'] ?? '') : $mod;
                                    $isModSel = !empty($modification_id) && ((string)$modification_id === (string)$mId);
                                @endphp
                                <option value="{{ $mId }}" {{ $isModSel ? 'selected' : '' }}>{{ $mName }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Search + Reset --}}
                <div class="d-flex gap-3 align-items-center">
                    <div class="search-wrap flex-grow-1">
                        <i class='bx bx-search search-icon'></i>
                        <input type="text" class="form-control py-2"
                            placeholder="Search by name, part number, brand, HSN, rack…"
                            wire:model.live="searchfilter">
                    </div>
                    <button type="button" class="btn px-4 py-2 fw-semibold"
                        style="border:1.5px solid #e2e8f0;border-radius:10px;color:var(--brand);white-space:nowrap;"
                        wire:click="resetFilter">
                        <i class="bx bx-reset me-1"></i> Reset
                    </button>
                </div>
            </div>
        </div>

        {{-- ── Parts Table ── --}}
        <div class="card border-0 shadow-sm" style="border-radius:16px;overflow:hidden;">
            <div class="card-body p-0">
                @if (!empty($parts) && $parts->count())
                    <div class="table-responsive">
                        <table class="table parts-table mb-0">
                            <thead style="background:linear-gradient(90deg,#f8fafc,#f1f5f9);">
                                <tr style="color:#64748b;">
                                    <th class="ps-4">#</th>
                                    <th>Image</th>
                                    <th>Part Details</th>
                                     <th>Supplier</th>
                                    <th>Pricing</th>
                                    <th>Stock</th>
                                    <th>HSN / Rack</th>
                                    <th class="text-center pe-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($parts as $index => $part)
                                    <tr style="border-bottom:1px solid #f1f5f9;">
                                        <td class="ps-4 text-muted small fw-semibold">
                                            {{ $parts->total() - ($parts->firstItem() + $index) + 1 }}
                                        </td>
                                        <td>
                                            @if (!empty($part->Image->file))
                                                <img src="{{ asset($part->Image->file) }}" class="part-img">
                                            @else
                                                <div class="part-img d-flex align-items-center justify-content-center"
                                                     style="background:#f1f5f9;">
                                                    <i class='bx bx-image text-muted fs-4'></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="fw-bold text-dark" style="font-size:14px;">{{ $part->name }}</div>
                                            <div class="d-flex align-items-center gap-2 mt-1 flex-wrap">
                                                @if($part->part_number)
                                                    <span class="badge" style="background:#fff5f5;color:#c62828;border:1px solid #fecaca;border-radius:6px;font-size:11px;">
                                                         # {{ strtoupper($part->part_number) }}
                                                    </span>
                                                @endif
                                                @if($part->brand)
                                                    <span class="text-muted small">{{ strtoupper($part->brand) }}</span>
                                                @endif
                                                @if($part->sp_type == 0)
                                                    <span class="badge bg-success-subtle text-success" style="border-radius:6px;font-size:10px;">New</span>
                                                @elseif($part->sp_type == 1)
                                                    <span class="badge bg-warning-subtle text-warning" style="border-radius:6px;font-size:10px;">Used</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <span class="d-flex align-items-center gap-1 text-muted small">
                                                <span style="width:28px;height:28px;background:#f1f5f9;border-radius:8px;display:flex;align-items:center;justify-content:center;">
                                                    <i class='bx bx-user' style="font-size:.9rem;"></i>
                                                </span>
                                                 {{ $part->supplier?->business_first_name ?? '—' }}
                                            </span>
                                        </td>
                                        <td>
                                            @php
                                                $offlinePrice = $part->selling_amount;
                                                if ($part->tax_type == 'exclude' && $part->tax_percentage) {
                                                    $offlinePrice += ($offlinePrice * $part->tax_percentage) / 100;
                                                }
                                            @endphp
                                            <div class="small">
                                                <div class="fw-bold" style="color:#22c55e;">₹{{ number_format($part->price, 2) }}
                                                    <span class="fw-normal text-muted" style="font-size:10px;">online</span>
                                                </div>
                                                <div class="fw-bold" style="color:#c62828;">₹{{ number_format($offlinePrice, 2) }}
                                                    <span class="fw-normal text-muted" style="font-size:10px;">offline</span>
                                                </div>

                                            </div>
                                        </td>
                                        <td>
                                            @php $stockClass = $part->stock > 10 ? '#22c55e' : ($part->stock > 0 ? '#f59e0b' : '#ef4444'); @endphp
                                            <span class="fw-bold" style="color:{{ $stockClass }};font-size:15px;">{{ $part->stock }}</span>
                                            <span class="text-muted small d-block">{{ $part->unit?->title ?? 'Units' }}</span>
                                            @if ($part->stock <= 5)
                                                <span class="badge" style="background:#fef2f2;color:#ef4444;border-radius:6px;font-size:10px;">
                                                    <i class='bx bxs-error me-1'></i>Low
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-muted small">
                                            <div>HSN: <span class="fw-semibold text-dark">{{ $part->hsn_code ?? '—' }}</span></div>
                                            <div>Rack: <span class="fw-semibold text-dark">{{ $part->rack_no ?? '—' }}</span></div>
                                        </td>
                                        <td class="text-center pe-4">
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="{{ route('sparepart.parts.view', $part->id) }}" class="action-btn view" title="View">
                                                    <i class="bx bxs-show"></i>
                                                </a>
                                                @if (@$sparePart->hasPermissionTo('part-edit'))
                                                    <a href="{{ route('sparepart.parts.edit', $part->id) }}" class="action-btn edit" title="Edit">
                                                        <i class="bx bxs-edit"></i>
                                                    </a>
                                                @endif
                                                @if (@$sparePart->hasPermissionTo('part-delete'))
                                                    <button wire:click="confirmDelete({{ $part->id }})" class="action-btn del" title="Delete">
                                                        <i class="bx bxs-trash"></i>
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="px-4 py-3" style="background:#f8fafc;border-top:1px solid #f1f5f9;">
                        {{ $parts->links() }}
                    </div>
                @else
                    <div class="empty-state">
                        <div class="empty-state-icon"><i class='bx bx-package'></i></div>
                        <h5 class="fw-bold text-muted mb-2">No Spare Parts Found</h5>
                        <p class="text-muted small mb-4">Start adding parts to your inventory.</p>
                        @if (@$sparePart->hasPermissionTo('part-add'))
                            <a href="{{ route('sparepart.parts.create') }}" class="btn btn-primary rounded-pill px-5 fw-bold">
                                <i class="bx bx-plus-circle me-1"></i> Add New Part
                            </a>
                        @endif
                    </div>
                @endif
            </div>
        </div>

    @else
    {{-- ================================================================= --}}
    {{--  FORM VIEW (Create / Edit / View)                                 --}}
    {{-- ================================================================= --}}

        {{-- ── Form Page Header ── --}}
        <div class="page-header-gradient shadow-sm mb-4">
            <div class="d-flex align-items-center justify-content-between position-relative" style="z-index:1;">
                <div class="d-flex align-items-center gap-3">
                    <div style="width:46px;height:46px;background:#fff5f5;border:1px solid #fecaca;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;color:#e53935;">
                        <i class='bx {{ $isView ? "bx-show" : ($isEdit ? "bx-edit" : "bx-plus-circle") }}'></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-0">
                            {{ $isView ? 'View Part Details' : ($isEdit ? 'Update Part Details' : 'Register New Spare Part') }}
                        </h4>
                        <nav aria-label="breadcrumb" class="mb-0">
                            <ol class="breadcrumb mb-0" style="font-size:12px;opacity:.8;">
                                <li class="breadcrumb-item"><a href="{{ route('sparepart.parts') }}" style="color:#64748b;">Parts Inventory</a></li>
                                <li class="breadcrumb-item active" style="color:#64748b;">{{ $isView ? 'View' : ($isEdit ? 'Edit' : 'Add New') }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <a href="{{ route('sparepart.parts') }}"
                   class="btn d-flex align-items-center gap-2 fw-semibold"
                   style="background:#fff;color:#111827;border:1px solid #e2e8f0;border-radius:12px;">
                    <i class='bx bx-arrow-back'></i> Back to List
                </a>
            </div>
        </div>

        {{-- ── Main Form ── --}}
        <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">
            @csrf

            {{-- ── SECTION 1 : Part Identification ── --}}
            <div class="form-section">
                <div class="form-section-header">
                    <div class="icon-wrap"><i class='bx bx-barcode'></i></div>
                    <span class="fw-bold" style="color:var(--brand);">Part Identification</span>
                    <span class="text-muted small ms-1">— enter part number and click search to fetch details</span>
                </div>
                <div class="form-section-body">
                    <div class="row g-3 align-items-start">
                        <div class="col-md-4">
                            <label class="form-label">Part Number</label>
                            <div class="input-group">
                                <input type="text" wire:model="part_number"
                                    wire:keydown.enter.prevent="searchPartNumber"
                                    class="form-control fw-bold"
                                    {{ $isView ? 'disabled' : '' }}
                                    placeholder="e.g. 46029BW" maxlength="30">
                                <button type="button" class="btn btn-primary"
                                    wire:click="searchPartNumber"
                                    wire:loading.attr="disabled"
                                    wire:target="searchPartNumber"
                                    {{ $isView ? 'disabled' : '' }}
                                    title="Click to search"
                                    style="background:var(--brand);color:#fff;border-color:var(--brand);border-radius:0 10px 10px 0 !important;cursor:pointer;padding:0.375rem 0.85rem;">
                                    <span wire:loading wire:target="searchPartNumber"><i class='bx bx-loader-alt bx-spin'></i></span>
                                    <i class='bx bx-search' wire:loading.remove wire:target="searchPartNumber"></i>
                                </button>
                            </div>
                            @error('part_number') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Article ID <span class="text-muted fw-normal">(Auto-fetched)</span></label>
                            <input type="text" wire:model="articleId" class="form-control" readonly
                                placeholder="Auto-populated" {{ $isView ? 'disabled' : '' }}
                                style="background:#f8fafc;">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">OEM Cross-Reference Numbers</label>
                            <textarea wire:model="oem_list" class="form-control" rows="2"
                                placeholder="OEM numbers (auto-filled)…"
                                {{ $isView ? 'disabled' : '' }} style="resize:none;"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4 mb-0">

                {{-- ── SECTION 2 : Basic Info ── --}}
                <div class="col-lg-6">
                    <div class="form-section h-100">
                        <div class="form-section-header">
                            <div class="icon-wrap"><i class='bx bx-info-circle'></i></div>
                            <span class="fw-bold" style="color:var(--brand);">Basic Information</span>
                        </div>
                        <div class="form-section-body">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label">Full Descriptive Name <sup class="text-danger">*</sup></label>
                                    <div class="input-group">
                                        <input type="text" wire:model="name" class="form-control"
                                            placeholder="e.g. Premium Brake Pad" {{ $isView ? 'disabled' : '' }}>
                                        <button type="button" class="btn btn-outline-primary" style="border-radius:0 10px 10px 0 !important;"
                                            wire:click="addPartLabel" {{ $isView ? 'disabled' : '' }} title="Add custom label">
                                            <i class='bx bx-plus'></i>
                                        </button>
                                    </div>
                                    @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Brand / Manufacturer</label>
                                    <input type="text" wire:model="brand" class="form-control"
                                        placeholder="e.g. Bosch" {{ $isView ? 'disabled' : '' }}>
                                    @error('brand') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Category <small class="text-muted fw-normal">(auto-detected)</small></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class='bx bx-category'></i></span>
                                        @if ($isView)
                                            <input type="text" class="form-control" value="{{ $apiCategoryName ?: 'Not detected' }}" readonly disabled>
                                        @else
                                            <select class="form-select" wire:model="category" style="border-radius:0 10px 10px 0 !important;">
                                                <option value="">{{ $apiCategoryName ?: 'Select Category' }}</option>
                                                @foreach ($categories as $cat)
                                                    <option value="{{ $cat['categoryId'] }}" {{ $category == $cat['categoryId'] ? 'selected' : '' }}>
                                                        {{ $cat['categoryName'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                    @if ($apiCategoryName && !$isView)
                                        <small class="text-success fw-semibold"><i class='bx bx-check-circle me-1'></i>{{ $apiCategoryName }}</small>
                                    @endif
                                    @error('category') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Supplier <sup class="text-danger">*</sup></label>
                                     <select class="form-select" wire:model="supplier_id" {{ $isView ? 'disabled' : '' }}>
                                         <option value="">— Select Supplier —</option>
                                        @foreach ($suppliers as $supplier)
                                             <option value="{{ $supplier->id }}">{{ $supplier->business_first_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('supplier_id') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ── SECTION 3 : Pricing & Inventory ── --}}
                <div class="col-lg-6">
                    <div class="form-section h-100">
                        <div class="form-section-header">
                            <div class="icon-wrap"><i class='bx bx-rupee'></i></div>
                            <span class="fw-bold" style="color:var(--brand);">Pricing & Inventory</span>
                        </div>
                        <div class="form-section-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Purchase Price <sup class="text-danger">*</sup></label>
                                    <div class="input-group">
                                        <span class="input-group-text">₹</span>
                                        <input type="number" wire:model.live="purchase_amount" class="form-control" {{ $isView ? 'disabled' : '' }}>
                                    </div>
                                    @error('purchase_amount') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Selling Price <sup class="text-danger">*</sup></label>
                                    <div class="input-group">
                                        <span class="input-group-text">₹</span>
                                        <input type="number" wire:model.live="selling_amount" class="form-control" {{ $isView ? 'disabled' : '' }}>
                                    </div>
                                    @error('selling_amount') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                                {{-- Auto Prices --}}
                                <div class="col-md-6">
                                    <div class="price-display">
                                        <div class="text-muted small mb-1">Online Price (Auto)</div>
                                        <div class="fw-bold fs-5" style="color:#22c55e;">₹{{ number_format($online_price ?? 0, 2) }}</div>
                                        <input type="hidden" wire:model="online_price">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="price-display offline">
                                        <div class="text-muted small mb-1">Offline Price (Auto)</div>
                                        <div class="fw-bold fs-5" style="color:#c62828;">₹{{ number_format($offline_price ?? 0, 2) }}</div>
                                        <input type="hidden" wire:model="offline_price">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Tax Type</label>
                                    <select class="form-select" wire:model.live="tax_type" {{ $isView ? 'disabled' : '' }}>
                                        <option value="">None</option>
                                        <option value="include">Include Tax</option>
                                        <option value="exclude">Exclude Tax</option>
                                    </select>
                                    @error('tax_type') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                                @if ($tax_type)
                                    <div class="col-md-3">
                                        <label class="form-label">Tax %</label>
                                        <input type="number" wire:model.live="tax_percentage" class="form-control" placeholder="18" {{ $isView ? 'disabled' : '' }}>
                                        @error('tax_percentage') <span class="text-danger small">{{ $message }}</span> @enderror
                                    </div>
                                @endif
                                <div class="{{ $tax_type ? 'col-md-6' : 'col-md-9' }}">
                                    <label class="form-label">Online Discount</label>
                                    <div class="input-group">
                                        <input type="number" wire:model.live="discount" class="form-control" {{ $isView ? 'disabled' : '' }}>
                                        <select class="form-select" wire:model.live="discount_type" style="max-width:64px;border-radius:0 10px 10px 0 !important;" {{ $isView ? 'disabled' : '' }}>
                                            <option value="1">₹</option>
                                            <option value="2">%</option>
                                        </select>
                                    </div>
                                    @error('discount') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Unit <sup class="text-danger">*</sup></label>
                                    <select class="form-select" wire:model="unit" {{ $isView ? 'disabled' : '' }}>
                                        <option value="">Select</option>
                                        @foreach ($units as $u)
                                            <option value="{{ $u->id }}">{{ $u->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('unit') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Stock Qty <sup class="text-danger">*</sup></label>
                                    <input type="number" wire:model="stock" class="form-control" {{ $isView ? 'disabled' : '' }}>
                                    @error('stock') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">SP Type <sup class="text-danger">*</sup></label>
                                    <select class="form-select" wire:model="sp_type" {{ $isView ? 'disabled' : '' }}>
                                        <option value="">Select</option>
                                        <option value="0">New</option>
                                        <option value="1">Used</option>
                                    </select>
                                    @error('sp_type') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">HSN Code</label>
                                    <input type="text" wire:model="hsn_code" class="form-control" placeholder="e.g. 8708" {{ $isView ? 'disabled' : '' }}>
                                    @error('hsn_code') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Rack No.</label>
                                    <input type="text" wire:model="rack_no" class="form-control" placeholder="Shelf A-1" {{ $isView ? 'disabled' : '' }}>
                                    @error('rack_no') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── SECTION 4 : Compatibility + Image ── --}}
            <div class="form-section mt-4">
                <div class="form-section-header">
                    <div class="icon-wrap"><i class='bx bx-car'></i></div>
                    <span class="fw-bold" style="color:var(--brand);">Compatible Vehicles</span>
                    <sup class="text-danger ms-1">*</sup>
                </div>
                <div class="form-section-body">
                    <div class="row g-4">
                        <div class="col-md-8">
                            {{-- For All Vehicles toggle --}}
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <label class="d-flex align-items-center gap-2 mb-0 cursor-pointer" for="forAllVehicles">
                                    <div class="form-check form-switch mb-0">
                                        <input class="form-check-input" type="checkbox" wire:model.live="forAllVehicles"
                                            id="forAllVehicles" {{ $isView ? 'disabled' : '' }}
                                            style="width:2.5em;height:1.3em;">
                                    </div>
                                    <span class="fw-semibold {{ $forAllVehicles ? 'text-success' : 'text-muted' }}">
                                        <i class='bx bx-check-shield me-1'></i>
                                        {{ $forAllVehicles ? 'Compatible with All Vehicles' : 'Specific Vehicles Only' }}
                                    </span>
                                </label>

                                @if (!$forAllVehicles)
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="search-wrap" style="width:190px;">
                                            <i class='bx bx-filter-alt search-icon'></i>
                                            <input type="text" class="form-control" style="padding-left:36px;"
                                                placeholder="Filter vehicles…" wire:model.live="brandFilter">
                                        </div>
                                        @if (!empty($api_compatible_vehicles))
                                            <div class="form-check form-switch mb-0">
                                                <input class="form-check-input" type="checkbox" wire:model.live="selectAll"
                                                    id="selectAll" {{ $isView ? 'disabled' : '' }}>
                                                <label class="form-check-label small fw-semibold text-danger" for="selectAll">All</label>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            </div>

                            @error('suitable_for') <div class="alert alert-danger py-2 small mb-3">{{ $message }}</div> @enderror

                            @if ($forAllVehicles)
                                <div class="d-flex align-items-center gap-3 p-3 rounded-3"
                                     style="background:linear-gradient(90deg,#f0fdf4,#dcfce7);border:1px solid #bbf7d0;">
                                    <i class='bx bx-check-circle text-success fs-3'></i>
                                    <div>
                                        <div class="fw-bold text-success">Compatible with all vehicles</div>
                                        <div class="text-muted small">This part will be available for every vehicle in the catalog.</div>
                                    </div>
                                </div>
                            @else
                                {{-- Catalog API Vehicles --}}
                                @if (!empty($api_compatible_vehicles))
                                    <div class="mb-3">
                                        <div class="small fw-bold mb-2" style="color:var(--brand);">
                                            <i class='bx bx-globe me-1'></i>Catalog Matches ({{ count($api_compatible_vehicles) }})
                                        </div>
                                        <div style="max-height:200px;overflow-y:auto;padding-right:4px;">
                                            <div class="row g-2">
                                                @foreach ($api_compatible_vehicles as $vehicle)
                                                    @php
                                                        $searchText = strtolower($vehicle['manufacturerName'].' '.$vehicle['modelName'].' '.($vehicle['typeEngineName'] ?? ''));
                                                        $filter = strtolower($brandFilter);
                                                    @endphp
                                                    @if (empty($brandFilter) || str_contains($searchText, $filter))
                                                        <div class="col-md-6">
                                                            <label class="d-flex align-items-start gap-2 vehicle-check-card w-100 mb-0" for="vehicle_{{ $vehicle['id'] }}">
                                                                <input class="form-check-input mt-1 flex-shrink-0" type="checkbox"
                                                                    value="{{ $vehicle['id'] }}"
                                                                    wire:model.live="suitable_for"
                                                                    {{ $isView ? 'disabled' : '' }}
                                                                    id="vehicle_{{ $vehicle['id'] }}">
                                                                <div>
                                                                    <div class="fw-semibold small">{{ $vehicle['manufacturerName'] }} {{ $vehicle['modelName'] }}</div>
                                                                    <div class="text-muted" style="font-size:11px;">{{ $vehicle['typeEngineName'] ?? 'Standard' }} · {{ $vehicle['year'] }}</div>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                {{-- Manual Vehicle Selector --}}
                                @if (!$isView)
                                    <div class="mb-3 p-3 rounded-3" style="background:#fffbeb;border:1px dashed #fcd34d;">
                                        <div class="small fw-bold mb-2 text-warning-emphasis">
                                            <i class='bx bx-plus-circle me-1'></i>
                                            {{ empty($api_compatible_vehicles) ? 'Part not in catalog? Add manually:' : 'Add more vehicles manually:' }}
                                        </div>
                                        @livewire('workshop.vehicle-selector')
                                    </div>
                                @endif

                                {{-- Existing Saved Vehicles Select2 --}}
                                <div class="mb-3">
                                    <label class="form-label"><i class='bx bx-bookmark me-1'></i>Or Select from Saved Vehicles</label>
                                    <select id="suitable_for_select" class="form-select searchable-select" multiple
                                        data-placeholder="Search saved vehicles…"
                                        wire:model="suitable_for" {{ $isView ? 'disabled' : '' }}>
                                        @if (!empty($api_compatible_vehicles))
                                            <optgroup label="Catalog Vehicles">
                                                @foreach ($api_compatible_vehicles as $vehicle)
                                                    <option value="{{ $vehicle['id'] }}"
                                                        @if (is_array($suitable_for) && in_array($vehicle['id'], $suitable_for)) selected @endif>
                                                        {{ $vehicle['manufacturerName'] }} {{ $vehicle['modelName'] }} ({{ $vehicle['year'] }}) [Catalog]
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        @endif
                                        <optgroup label="Saved Vehicles">
                                            @foreach ($modifications as $modification)
                                                <option value="{{ $modification->id }}"
                                                    @if (is_array($suitable_for) && in_array($modification->id, $suitable_for)) selected @endif>
                                                    @php
                                                        $parts_data = array_filter([$modification->brand_name ?? '', $modification->variant_name ?? '', $modification->year ?? '', $modification->title ?? '']);
                                                    @endphp
                                                    {{ implode(' ', $parts_data) }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>

                                {{-- Selected Vehicles Badges --}}
                                <div>
                                    <label class="form-label">
                                        Selected Vehicles
                                        <span class="badge ms-1" style="background:var(--brand);border-radius:8px;">{{ is_array($suitable_for) ? count($suitable_for) : 0 }}</span>
                                    </label>
                                    <div class="d-flex flex-wrap gap-2 p-3 rounded-3"
                                         style="min-height:50px;max-height:150px;overflow-y:auto;background:#f8fafc;border:1.5px solid #e2e8f0;">
                                        @if (empty($suitable_for))
                                            <span class="text-muted small align-self-center">No vehicles selected yet.</span>
                                        @else
                                            @foreach ($suitable_for as $idx => $vehId)
                                                @php
                                                    $localMod = $modifications->firstWhere('id', $vehId);
                                                    $apiVeh = $localMod ? null : collect($api_compatible_vehicles)->firstWhere('id', $vehId);
                                                @endphp
                                                @if ($localMod)
                                                    <span class="vehicle-badge">
                                                        <i class='bx bx-car'></i>
                                                        {{ $localMod->brand_name }} {{ $localMod->variant_name }} ({{ $localMod->year }})
                                                        @if (!$isView)
                                                            <button type="button" class="remove-btn" wire:click="removeCompatibleVehicle({{ $idx }})">✕</button>
                                                        @endif
                                                    </span>
                                                @elseif($apiVeh)
                                                    <span class="vehicle-badge" style="background:#fff5f5;border-color:#fecaca;color:#c62828;">
                                                        <i class='bx bx-globe'></i>
                                                        {{ $apiVeh['manufacturerName'] }} {{ $apiVeh['modelName'] }} ({{ $apiVeh['year'] ?? '' }})
                                                        @if (!$isView)
                                                            <button type="button" class="remove-btn" wire:click="removeCompatibleVehicle({{ $idx }})">✕</button>
                                                        @endif
                                                    </span>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>

                        {{-- ── Part Image ── --}}
                        <div class="col-md-4">
                            <label class="form-label"><i class='bx bx-image me-1'></i>Part Image</label>
                            <div class="d-flex flex-column align-items-center justify-content-center text-center p-3 rounded-3"
                                 style="border:2px dashed #cbd5e1;min-height:200px;background:#f8fafc;transition:all .2s;">
                                @if ($part_image_url)
                                    <img src="{{ $part_image_url }}" class="img-fluid rounded-3 shadow-sm mb-3" style="max-height:160px;object-fit:contain;">
                                    <span class="badge" style="background:#dcfce7;color:#16a34a;border-radius:8px;"><i class='bx bx-check me-1'></i>Catalog Image</span>
                                @elseif ($image && method_exists($image, 'temporaryUrl'))
                                    <img src="{{ $image->temporaryUrl() }}" class="img-fluid rounded-3 shadow-sm mb-3" style="max-height:160px;object-fit:contain;">
                                @elseif ($imageImage)
                                    <img src="{{ asset($imageImage) }}" class="img-fluid rounded-3 shadow-sm mb-3" style="max-height:160px;object-fit:contain;">
                                @else
                                    <i class='bx bx-image-add text-muted mb-2' style="font-size:3rem;"></i>
                                    <span class="text-muted small">No image yet</span>
                                @endif
                                @if (!$isView)
                                    <input type="file" class="form-control form-control-sm mt-3" wire:model="image" />
                                @endif
                                @error('image') <span class="text-danger small mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── SECTION 5 : Description ── --}}
            <div class="form-section mt-4">
                <div class="form-section-header">
                    <div class="icon-wrap"><i class='bx bx-list-ul'></i></div>
                    <span class="fw-bold" style="color:var(--brand);">Technical Description & Specs</span>
                </div>
                <div class="form-section-body">
                    <textarea wire:model="description" class="form-control" rows="6"
                        {{ $isView ? 'disabled' : '' }}
                        placeholder="Technical specifications will be auto-populated when a part number is entered…"></textarea>
                    @error('description') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>
            </div>

            {{-- ── Commission Notice ── --}}
            <div class="d-flex align-items-center gap-3 p-3 rounded-3 mt-2 mb-4"
                 style="background:linear-gradient(90deg,#fffbeb,#fef3c7);border:1px solid #fde68a;">
                <i class='bx bx-info-circle text-warning fs-4'></i>
                <span class="small text-dark">
                    A <strong>{{ $commission }}%</strong> platform charge will be applied to the final settlement.
                </span>
            </div>

            {{-- ── Form Actions ── --}}
            <div class="d-flex justify-content-end align-items-center gap-3">
                <a href="{{ route('sparepart.parts') }}" class="btn btn-light px-5 fw-semibold" style="border-radius:12px;border:1.5px solid #e2e8f0;">
                    {{ $isView ? 'Close' : 'Discard' }}
                </a>
                @if (!$isView)
                    <button type="submit" class="btn btn-primary px-5 fw-bold d-flex align-items-center gap-2" style="border-radius:12px;min-width:160px;justify-content:center;">
                        <i class='bx bx-save' wire:loading.remove wire:target="{{ $isEdit ? 'update' : 'store' }}"></i>
                        <span wire:loading.remove wire:target="{{ $isEdit ? 'update' : 'store' }}">
                            {{ $isEdit ? 'Update Part' : 'Register Part' }}
                        </span>
                        <span wire:loading wire:target="{{ $isEdit ? 'update' : 'store' }}">
                            <i class='bx bx-loader-alt bx-spin me-1'></i> Saving…
                        </span>
                    </button>
                @endif
            </div>
        </form>
    @endif

    {{-- ── Part Label Mini-Modal ── --}}
    <div class="modal @if ($showPartModel) show @endif" tabindex="-1"
        style="opacity:1;background-color:rgba(6,6,6,.55);display:@if ($showPartModel) block @else none @endif;">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius:18px;overflow:hidden;">
                <form wire:submit.prevent="partLabelStore">
                    <div class="modal-header text-white border-0 p-4"
                         style="background:linear-gradient(135deg,var(--brand),var(--brand-mid));">
                        <h5 class="modal-title fw-bold"><i class='bx bx-tag me-2'></i>Add Custom Part Label</h5>
                        <button type="button" class="btn-close btn-close-white" wire:click="$set('showPartModel', false)"></button>
                    </div>
                    <div class="modal-body p-4">
                        <label class="form-label">Label / Part Name</label>
                        <input type="text" wire:model="part_label" class="form-control form-control-lg"
                            placeholder="e.g. Premium Brake Pad">
                        @error('part_label') <span class="text-danger small fw-bold">{{ $message }}</span> @enderror
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0">
                        <button type="button" class="btn btn-light px-4 fw-semibold" style="border-radius:10px;"
                            wire:click="$set('showPartModel', false)">Cancel</button>
                        <button type="submit" class="btn btn-primary px-5 fw-bold" style="border-radius:10px;">
                            <i class='bx bx-save me-1'></i>Save & Use
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<script>
        document.addEventListener('livewire:init', () => {
            initialize();
            Livewire.hook('morphed', () => {
                initialize();
                if (typeof window.initSearchableSelects === 'function') {
                    window.initSearchableSelects();
                }
            });
        });

        function initialize() {
            if (typeof window.initSearchableSelects === 'function') {
                window.initSearchableSelects();
            }
        }
    </script>
