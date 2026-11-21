<div class="carnate-po-create-page container-fluid py-3">

    <style>
        /* =========================================================
           CARNATE PURCHASE ORDER CREATE / EDIT THEME
        ========================================================= */
        .carnate-po-create-page {
            --po-red: #e53935;
            --po-red-dark: #c62828;
            --po-red-soft: #fff5f5;
            --po-text: #111827;
            --po-text-2: #334155;
            --po-muted: #64748b;
            --po-border: #e2e8f0;
            --po-border-light: #f1f5f9;
            --po-bg: #f8fafc;
        }

        .carnate-po-create-page *,
        .carnate-po-create-page *::before,
        .carnate-po-create-page *::after {
            box-sizing: border-box;
        }

        /* CARDS */
        .carnate-po-create-page .card {
            border: 1px solid var(--po-border) !important;
            border-radius: 14px !important;
            background: #fff !important;
            box-shadow: 0 2px 12px rgba(15, 23, 42, .035) !important;
        }

        .carnate-po-create-page .card-header-title {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 1px solid var(--po-border-light);
        }

        .carnate-po-create-page .card-header-icon {
            width: 36px;
            height: 36px;
            min-width: 36px;
            border-radius: 9px;
            background: var(--po-red-soft);
            color: var(--po-red);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        /* LABELS & CONTROLS */
        .carnate-po-create-page label,
        .carnate-po-create-page .form-label {
            font-size: 11.5px;
            font-weight: 600;
            color: var(--po-muted);
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }

        .carnate-po-create-page .form-control,
        .carnate-po-create-page .form-select {
            min-height: 42px;
            border: 1px solid var(--po-border);
            border-radius: 9px;
            font-size: 13.5px;
            color: var(--po-text-2);
            padding: 8px 14px;
            transition: border-color .15s ease, box-shadow .15s ease;
        }

        .carnate-po-create-page .form-control:focus,
        .carnate-po-create-page .form-select:focus {
            border-color: var(--po-red);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, 0.12);
        }

        .carnate-po-create-page .form-control[readonly] {
            background-color: var(--po-bg);
            color: var(--po-text-2);
            cursor: default;
        }

        /* STEPPER */
        .carnate-po-create-page .stepper-wrapper {
            position: relative;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .carnate-po-create-page .stepper-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            flex: 1;
            min-width: 60px;
        }
        .carnate-po-create-page .stepper-circle {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 14px;
            margin-bottom: 5px;
            z-index: 2;
            background: #fff;
            border: 2px solid #cbd5e1;
            color: #64748b;
            transition: all 0.25s ease;
        }
        .carnate-po-create-page .stepper-label {
            font-size: 12px;
            color: #64748b;
            font-weight: 500;
            transition: all 0.25s ease;
        }
        .carnate-po-create-page .stepper-line {
            position: absolute;
            top: 17px;
            left: 50%;
            width: 100%;
            height: 3px;
            background: #e2e8f0;
            z-index: 1;
            transition: background 0.3s;
        }

        .stepper-circle.active-step-0 {
            background: #2563eb !important;
            border-color: #2563eb !important;
            color: #fff !important;
            box-shadow: 0 2px 8px rgba(37, 99, 235, 0.35);
        }
        .stepper-circle.active-step-1 {
            background: #d97706 !important;
            border-color: #d97706 !important;
            color: #fff !important;
            box-shadow: 0 2px 8px rgba(217, 119, 6, 0.35);
        }
        .stepper-circle.active-step-2 {
            background: #16a34a !important;
            border-color: #16a34a !important;
            color: #fff !important;
            box-shadow: 0 2px 8px rgba(22, 163, 74, 0.35);
        }
        .stepper-circle.active-step-3 {
            background: #475569 !important;
            border-color: #475569 !important;
            color: #fff !important;
            box-shadow: 0 2px 8px rgba(71, 85, 105, 0.35);
        }

        .active-label-0 { color: #2563eb !important; font-weight: 700 !important; }
        .active-label-1 { color: #d97706 !important; font-weight: 700 !important; }
        .active-label-2 { color: #16a34a !important; font-weight: 700 !important; }
        .active-label-3 { color: #475569 !important; font-weight: 700 !important; }

        .stepper-line-active-0 { background: #2563eb !important; }
        .stepper-line-active-1 { background: #d97706 !important; }
        .stepper-line-active-2 { background: #16a34a !important; }
        .stepper-line-active-3 { background: #475569 !important; }

        /* MODAL STYLES */
        .carnate-modal-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(4px);
            z-index: 1060;
            overflow-y: auto;
            padding: 20px 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .carnate-modal-content {
            background: #fff;
            border-radius: 16px;
            border: 1px solid var(--po-border);
            box-shadow: 0 25px 60px rgba(15, 23, 42, 0.25);
            width: 100%;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            max-height: calc(100vh - 40px);
            margin: auto;
        }

        .carnate-modal-content form,
        .carnate-modal-form {
            display: flex;
            flex-direction: column;
            max-height: calc(100vh - 40px);
            height: 100%;
            min-height: 0;
            overflow: hidden;
        }

        .carnate-modal-header {
            flex: 0 0 auto;
            padding: 16px 22px;
            border-bottom: 1px solid var(--po-border-light);
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .carnate-modal-body {
            padding: 22px;
            overflow-y: auto;
            overflow-x: hidden;
            flex: 1 1 auto;
            min-height: 0;
        }

        .carnate-modal-body::-webkit-scrollbar {
            width: 6px;
        }

        .carnate-modal-body::-webkit-scrollbar-track {
            background: #f8fafc;
        }

        .carnate-modal-body::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        .carnate-modal-body::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        .carnate-modal-footer {
            flex: 0 0 auto;
            padding: 14px 22px;
            border-top: 1px solid var(--po-border-light);
            background: var(--po-bg);
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
        }
    </style>

    {{-- PAGE HEADER BANNER --}}
    <div class="card mb-4 border-0 shadow-sm" style="border-radius: 14px;">
        <div class="card-body p-3 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-3">
                <div style="width: 44px; height: 44px; border-radius: 11px; background: #fff5f5; color: #e53935; display: flex; align-items: center; justify-content: center; font-size: 22px;">
                    <i class="bx bx-receipt"></i>
                </div>
                <div>
                    <h4 class="mb-0 fw-bold text-dark" style="font-size: 20px; letter-spacing: -0.02em;">
                        {{ $isEdit ? 'Edit Purchase Order' : 'Purchase Order' }}
                    </h4>
                    <small class="text-muted" style="font-size: 13px;">Manage purchase order records, stock items and supplier details</small>
                </div>
            </div>
            <button type="button" class="btn btn-light rounded-circle text-danger d-flex align-items-center justify-content-center" wire:click="goToList" title="Close" style="width: 40px; height: 40px; border: 1px solid #fee2e2; background: #fff5f5; text-decoration: none; transition: all 0.2s;">
                <i class="bx bx-x fs-4"></i>
            </button>
        </div>
    </div>

    <div class="row g-3">
        <!-- Left Card: Supplier Details -->
        <div class="col-md-5">
            <div class="card h-100">
                <div class="card-body p-3 p-md-4">
                    <div class="card-header-title">
                        <div class="card-header-icon">
                            <i class="bx bx-store"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold text-dark" style="font-size: 15px;">Supplier Details</h6>
                            <small class="text-muted" style="font-size: 12px;">Select or create supplier for this order</small>
                        </div>
                    </div>

                    <div class="mb-3 position-relative" wire:click.away="$set('supplierResults', [])">
                        <label class="form-label">Search Supplier</label>
                        <div class="d-flex align-items-center gap-2">
                            <div class="position-relative flex-grow-1" style="min-width: 0;">
                                <i class="bx bx-search position-absolute text-muted" style="left: 14px; top: 50%; transform: translateY(-50%); font-size: 18px;"></i>
                                <input type="text"
                                       class="form-control"
                                       style="padding-left: 40px; padding-right: 36px;"
                                       placeholder="Search Supplier By Firm Name and Number"
                                       wire:model.live.debounce.250ms="supplierSearch"
                                       wire:focus="focusSupplierSearch"
                                       wire:click="focusSupplierSearch"
                                       wire:keydown.escape="$set('supplierResults', [])"
                                       autocomplete="off">
                                @if(!empty($supplierSearch) || !empty($supplierResults))
                                    <button type="button"
                                            wire:click="clearSupplierSearch"
                                            class="btn p-0 position-absolute text-muted d-inline-flex align-items-center justify-content-center"
                                            style="right: 12px; top: 50%; transform: translateY(-50%); border: none; background: transparent; font-size: 18px; line-height: 1; z-index: 5;"
                                            title="Clear">
                                        <i class="bx bx-x-circle"></i>
                                    </button>
                                @endif
                            </div>
                            <button class="btn btn-danger d-inline-flex align-items-center justify-content-center flex-shrink-0"
                                    type="button"
                                    wire:click="openSupplierModal"
                                    title="Add New Supplier"
                                    style="min-height: 42px; border-radius: 9px; padding: 0 16px; background: #e53935; border: 1px solid #e53935; font-weight: 600; font-size: 13px; box-shadow: 0 3px 8px rgba(229, 57, 53, 0.22);">
                                <i class="bx bx-plus me-1 fs-5"></i> Add New
                            </button>
                        </div>
                        @if(!empty($supplierResults))
                            <ul class="list-group position-absolute w-100 mt-1 shadow-lg" style="z-index: 1050; left: 0; top: 100%; border-radius: 10px; border: 1px solid #e2e8f0; overflow: hidden; max-height: 280px; overflow-y: auto;">
                                @foreach($supplierResults as $supplier)
                                    <li class="list-group-item list-group-item-action py-2 px-3 d-flex align-items-center justify-content-between"
                                        wire:click="selectSupplier({{ $supplier['id'] }})"
                                        style="cursor:pointer; font-size: 13px;">
                                        <span class="fw-semibold text-dark">{{ $supplier['business_first_name'] }}</span>
                                        <span class="text-muted"><i class="bx bx-phone me-1"></i>{{ $supplier['mobile_no'] }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                    <div class="row g-2 mb-2">
                        <div class="col-6">
                            <label class="form-label">Company Name</label>
                            <input type="text" class="form-control" wire:model="supplier_name" readonly placeholder="Supplier Name">
                        </div>
                        <div class="col-6">
                            <label class="form-label">Supplier Phone</label>
                            <input type="text" class="form-control" wire:model="supplier_phone" readonly placeholder="Phone Number">
                        </div>
                    </div>

                    <div class="row g-2 mb-2 align-items-end">
                        <div class="col-6">
                            <label class="form-label">Balance</label>
                            <input type="text" class="form-control" wire:model="supplier_balance" readonly placeholder="₹0.00">
                        </div>
                        <div class="col-6">
                            <button class="btn btn-outline-secondary w-100 d-inline-flex align-items-center justify-content-center"
                                    wire:click="editSupplier"
                                    style="min-height: 42px; border-radius: 9px; font-weight: 600; font-size: 13px; border: 1px solid #cbd5e1; background: #fff;">
                                <i class="bx bx-edit me-1 fs-5"></i> Edit
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Card: PO Details & Stepper -->
        <div class="col-md-7">
            <div class="card h-100">
                <div class="card-body p-3 p-md-4">
                    <!-- PO Status Steps (Stepper) -->
                    <div class="mb-3">
                        @if($po_status === 'Cancelled')
                            <div class="alert alert-danger text-center fw-bold fs-5 py-2 mb-0" style="border-radius: 10px;">
                                <i class="bx bx-x-circle me-1"></i> Order Cancelled
                            </div>
                        @else
                            <div class="stepper-wrapper mb-3 py-1">
                                @php
                                    $steps = [
                                        ['label' => 'Open', 'color' => '#2563eb'],
                                        ['label' => 'Placed', 'color' => '#d97706'],
                                        ['label' => 'Received', 'color' => '#16a34a'],
                                        ['label' => 'Closed', 'color' => '#475569'],
                                    ];
                                    $activeIndex = collect($steps)->pluck('label')->search($po_status);
                                    if ($activeIndex === false) {
                                        $activeIndex = 0;
                                    }
                                @endphp
                                @foreach($steps as $i => $step)
                                    @php
                                        $isCompletedOrActive = $i <= $activeIndex;
                                    @endphp
                                    <div class="stepper-step">
                                        @if($i < count($steps) - 1)
                                            @php
                                                $lineClass = $i < $activeIndex ? 'stepper-line stepper-line-active-' . $i : 'stepper-line';
                                            @endphp
                                            <div class="{{ $lineClass }}"></div>
                                        @endif
                                        <div class="stepper-circle {{ $isCompletedOrActive ? 'active-step-' . $i : '' }}">
                                            @if($i < $activeIndex)
                                                <i class="bx bx-check"></i>
                                            @else
                                                {{ $i }}
                                            @endif
                                        </div>
                                        <div class="stepper-label {{ $isCompletedOrActive ? 'active-label-' . $i : '' }}">
                                            {{ $step['label'] }}
                                        </div>
                                    </div>
                                @endforeach
                                @if($isEdit && $editingId)
                                    <div class="ms-2">
                                        <a href="{{ route('sparepart.purchase.order.show', $editingId) }}" class="btn btn-danger btn-sm d-inline-flex align-items-center" target="_blank" style="border-radius: 8px; font-weight: 600; padding: 6px 12px; background: #e53935; border-color: #e53935;">
                                            <i class="bx bx-share-alt me-1"></i> Share PO
                                        </a>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>

                    <div class="row g-2">
                        <div class="col-md-6">
                            <label class="form-label">P.O. Number</label>
                            <input type="text" placeholder="PON" class="form-control" wire:model="po_no" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">P.O. Date</label>
                            <input type="date" class="form-control" wire:model="po_date" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Bill Number</label>
                            <input type="text"
                                   class="form-control"
                                   wire:model.lazy="bill_no"
                                   placeholder="Bill Number"
                                   value="{{ in_array($po_status, ['Open', 'Placed']) ? '0' : $bill_no }}"
                                   {{ in_array($po_status, ['Open', 'Placed']) ? 'readonly' : '' }}>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Bill Date</label>
                            <input type="date" class="form-control" wire:model="bill_date">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stock Details Table -->
    <div class="card mt-4">
        <div class="card-body p-3 p-md-4">
            <div class="card-header-title mb-3">
                <div class="card-header-icon">
                    <i class="bx bx-package"></i>
                </div>
                <div>
                    <h6 class="mb-0 fw-bold text-dark" style="font-size: 16px;">Stock Details</h6>
                    <small class="text-muted" style="font-size: 12px;">Search and add spare parts, adjust quantities and unit prices</small>
                </div>
            </div>

            <div class="row align-items-center mb-3">
                <div class="col-md-6 mb-2 mb-md-0">
                    <div class="position-relative" wire:click.away="$set('partResults', [])">
                        <i class="bx bx-search position-absolute text-muted" style="left: 14px; top: 50%; transform: translateY(-50%); font-size: 18px;"></i>
                        <input type="text"
                               class="form-control"
                               style="padding-left: 40px; padding-right: 36px;"
                               placeholder="Search Part By Part Number"
                               wire:model.live.debounce.250ms="part_search"
                               wire:focus="focusPartSearch"
                               wire:click="focusPartSearch"
                               wire:keydown.escape="$set('partResults', [])"
                               autocomplete="off">
                        @if(!empty($part_search) || !empty($partResults))
                            <button type="button"
                                    wire:click="clearPartSearch"
                                    class="btn p-0 position-absolute text-muted d-inline-flex align-items-center justify-content-center"
                                    style="right: 12px; top: 50%; transform: translateY(-50%); border: none; background: transparent; font-size: 18px; line-height: 1; z-index: 5;"
                                    title="Clear">
                                <i class="bx bx-x-circle"></i>
                            </button>
                        @endif
                        @if(!empty($partResults))
                            <ul class="list-group position-absolute w-100 mt-1 shadow-lg" style="z-index: 1050; left: 0; top: 100%; border-radius: 10px; border: 1px solid #e2e8f0; overflow: hidden; max-height: 280px; overflow-y: auto;">
                                @foreach($partResults as $part)
                                    <li class="list-group-item list-group-item-action py-2 px-3 d-flex align-items-center justify-content-between"
                                        wire:click="selectPart({{ $part->id }})"
                                        style="cursor:pointer; font-size: 13px;">
                                        <div>
                                            <span class="fw-semibold text-dark">{{ $part->name }}</span>
                                            <span class="text-muted ms-1">({{ $part->part_number }})</span>
                                        </div>
                                        <span class="fw-bold text-success">₹{{ $part->purchase_price ?? $part->price }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
                <div class="col-md-3">
                    <button type="button"
                            class="btn btn-danger d-inline-flex align-items-center justify-content-center"
                            wire:click="openPartModal"
                            style="min-height: 42px; border-radius: 9px; padding: 0 18px; background: #e53935; border: 1px solid #e53935; font-weight: 600; font-size: 13px; box-shadow: 0 3px 8px rgba(229, 57, 53, 0.22);">
                        <i class="bx bx-plus me-1 fs-5"></i> Add New Part
                    </button>
                </div>
            </div>

            <div class="table-responsive border rounded-3 overflow-hidden">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background: #f8fafc; font-size: 12px; font-weight: 600; color: #475569; text-transform: uppercase; letter-spacing: 0.5px;">
                        <tr>
                            <th class="py-3 px-3" style="width: 50px;">#</th>
                            <th class="py-3 px-3">
                                <div>Particulars</div>
                                <label class="d-inline-flex align-items-center gap-1 mt-1 text-muted" style="font-size: 11px; text-transform: none; cursor: pointer;">
                                    <input type="checkbox" class="form-check-input mt-0" wire:click="toggleShowPartNumber" @if($showPartNumber) checked @endif> Show Part Number
                                </label>
                            </th>
                            @if($po_status === 'Placed' || $po_status === 'Received'|| $po_status === 'Closed')
                                <th class="py-3 px-3">HSN</th>
                            @endif
                            <th class="py-3 px-3" style="width: 100px;">Qty</th>
                            <th class="py-3 px-3" style="width: 130px;">Unit Price (₹)</th>
                            @if($po_status === 'Placed' || $po_status === 'Received'|| $po_status === 'Closed')
                                <th class="py-3 px-3">Selling Price (₹)</th>
                                <th class="py-3 px-3">GST (%)</th>
                                <th>GST Type</th>
                                <th>Online Discount</th>
                            @endif
                            <th class="py-3 px-3 text-end" style="width: 120px;">Total</th>
                            <th class="py-3 px-3 text-center" style="width: 70px;">Action</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 13px;">
                        @forelse($items as $index => $item)
                            <tr>
                                <td class="px-3 fw-semibold text-muted">{{ $index + 1 }}</td>
                                <td class="px-3">
                                    <div class="fw-bold text-dark">{{ $item['name'] }}</div>
                                    @if($showPartNumber && $item['part_number'])
                                        <small class="text-muted"><i class="bx bx-barcode me-1"></i>{{ $item['part_number'] }}</small>
                                    @endif
                                </td>
                                @if($po_status === 'Placed' || $po_status === 'Received'|| $po_status === 'Closed')
                                    <td class="px-3">
                                        <input type="text" class="form-control form-control-sm" wire:model.lazy="items.{{ $index }}.hsn_code" style="width: 85px;">
                                    </td>
                                @endif
                                <td class="px-3">
                                    <input type="number" class="form-control form-control-sm"
                                           value="{{ $item['qty'] }}"
                                           wire:change="updateItemQty({{ $index }}, $event.target.value)"
                                           min="1" style="width: 80px;">
                                </td>
                                <td class="px-3">
                                    <input type="number" class="form-control form-control-sm"
                                           value="{{ $item['unit_price'] }}"
                                           wire:change="updateItemPrice({{ $index }}, $event.target.value)"
                                           min="0" step="0.01" style="width: 110px;">
                                </td>
                                @if($po_status === 'Placed' || $po_status === 'Received'|| $po_status === 'Closed')
                                    <td class="px-3">
                                        <input type="number" class="form-control form-control-sm" wire:model.lazy="items.{{ $index }}.selling_price">
                                    </td>
                                    <td class="px-3">
                                        <select class="form-select form-select-sm"
                                            wire:model="items.{{ $index }}.gst_percent"
                                            wire:change="updateItemGST({{ $index }}, $event.target.value)">
                                            <option value="{{ (int) $item['gst_percent'] }}">
                                                {{ (int) $item['gst_percent'] }}%
                                            </option>
                                            <option value="0">0%</option>
                                            <option value="5">5%</option>
                                            <option value="12">12%</option>
                                            <option value="18">18%</option>
                                            <option value="28">28%</option>
                                        </select>
                                    </td>
                                    <td class="px-3">
                                        <select class="form-select form-select-sm"
                                            wire:model="items.{{ $index }}.gst_type"
                                            wire:change="updateItemGstType({{ $index }}, $event.target.value)">
                                            <option value="exclude">Exclude</option>
                                            <option value="include">Include</option>
                                        </select>
                                    </td>
                                    <td class="px-3">
                                        <div class="input-group input-group-sm">
                                            <input type="number" class="form-control"
                                                value="{{ $item['discount'] ?? 0 }}"
                                                wire:change="updateItemDiscount({{ $index }}, $event.target.value)">
                                            <select class="form-select"
                                                wire:model="items.{{ $index }}.discount_type"
                                                wire:change="updateItemDiscountType({{ $index }}, $event.target.value)"
                                                style="max-width: 60px;">
                                                <option value="1">₹</option>
                                                <option value="2">%</option>
                                            </select>
                                        </div>
                                    </td>
                                @endif
                                <td class="px-3 text-end fw-bold text-dark">₹{{ number_format($item['total'], 2) }}</td>
                                <td class="px-3 text-center">
                                    <button type="button"
                                            class="btn btn-sm btn-light text-danger rounded-circle p-0 d-inline-flex align-items-center justify-content-center"
                                            wire:click="removeItem({{ $index }})"
                                            title="Remove Item"
                                            style="width: 32px; height: 32px; border: 1px solid #fee2e2; background: #fff5f5;">
                                        <i class="bx bx-trash fs-6"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ ($po_status === 'Placed' || $po_status === 'Received'|| $po_status === 'Closed') ? 10 : 6 }}" class="text-center py-4 text-muted">
                                    <i class="bx bx-package fs-2 d-block mb-1 text-secondary"></i>
                                    No stock items added yet. Search above to add items.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot style="background: #f8fafc; border-top: 2px solid #e2e8f0;">
                        <tr>
                            <td colspan="{{ ($po_status === 'Placed' || $po_status === 'Received'|| $po_status === 'Closed') ? 8 : 4 }}" class="text-end fw-bold py-3 px-3 text-dark">
                                Grand Total:
                            </td>
                            <td class="fw-bold text-end py-3 px-3 text-success fs-6">
                                ₹{{ number_format($this->grandTotal, 2) }}
                            </td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <!-- Transport & Bill Details Section -->
    <div class="row g-3 mt-1">
        <!-- Transport Details -->
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body p-3 p-md-4">
                    <div class="card-header-title">
                        <div class="card-header-icon">
                            <i class="bx bx-truck"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold text-dark" style="font-size: 15px;">Transport Details</h6>
                            <small class="text-muted" style="font-size: 12px;">Delivery and vehicle transport information</small>
                        </div>
                    </div>

                    @if($po_status === 'Placed' || $po_status === 'Received'|| $po_status === 'Closed')
                        <div class="row g-2 mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Transporter Name</label>
                                <input type="text" class="form-control" wire:model.lazy="transporter_name" placeholder="Transporter Name" required>
                                @error('transporter_name') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Received Date</label>
                                <input type="date" class="form-control" wire:model.lazy="received_date" required>
                                @error('received_date') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Vehicle Number</label>
                                <input type="text" class="form-control" wire:model.lazy="vehicle_number" placeholder="Vehicle Number" required>
                                @error('vehicle_number') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Delivery Person</label>
                                <input type="text" class="form-control" wire:model.lazy="delivery_person" placeholder="Delivery Person" required>
                                @error('delivery_person') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">LT. Number</label>
                                <input type="text" class="form-control" wire:model.lazy="lt_number" placeholder="LT. Number" required>
                                @error('lt_number') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    @endif

                    <div class="mb-0">
                        <label class="form-label">Order Note</label>
                        <textarea class="form-control" wire:model.lazy="note" rows="3" placeholder="Add any special instructions or remarks..."></textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bill Details -->
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body p-3 p-md-4">
                    <div class="card-header-title">
                        <div class="card-header-icon">
                            <i class="bx bx-calculator"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold text-dark" style="font-size: 15px;">Bill Details</h6>
                            <small class="text-muted" style="font-size: 12px;">Calculation summary and payments</small>
                        </div>
                    </div>

                    @if($po_status !== 'Placed' && $po_status !== 'Received'&& $po_status !== 'Closed')
                        <div class="d-flex justify-content-between py-2 border-bottom">
                            <span class="text-muted">Subtotal</span>
                            <span class="fw-semibold text-dark">₹{{ number_format($subtotal ?? 0, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between py-2 border-bottom">
                            <span class="text-muted">Taxable Subtotal</span>
                            <span class="fw-semibold text-dark">₹{{ number_format($taxable_subtotal ?? 0, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between py-2 border-bottom">
                            <span class="text-muted">GST</span>
                            <span class="fw-semibold text-dark">₹{{ number_format($gst ?? 0, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center p-3 mt-3 rounded-3" style="background: #f0fdf4; border: 1px solid #bbf7d0;">
                            <span class="fw-bold text-success fs-6">Total Payable</span>
                            <span class="fw-bold text-success fs-5">₹{{ number_format($total_payable ?? 0, 2) }}</span>
                        </div>
                    @endif

                    @if($po_status === 'Placed' || $po_status === 'Received'|| $po_status === 'Closed')
                        <div class="d-flex justify-content-between py-2 border-bottom">
                            <span class="text-muted">Total (Incl. GST)</span>
                            <span class="fw-bold text-dark">₹{{ number_format($total_payable ?? 0, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between py-2 border-bottom">
                            <span class="text-muted">GST</span>
                            <span class="fw-semibold text-dark">₹{{ number_format($gst ?? 0, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between py-2 border-bottom">
                            <span class="text-danger fw-semibold">Remaining Balance</span>
                            <span class="text-danger fw-bold">₹{{ number_format($balance ?? 0, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between py-2 border-bottom">
                            <span class="text-success fw-semibold">Total Paid</span>
                            <span class="text-success fw-bold">₹{{ number_format($paid ?? 0, 2) }}</span>
                        </div>

                        @if(!$isEdit)
                            {{-- New PO Initial Payment Form --}}
                            <div class="p-3 bg-light rounded-3 mt-3 border">
                                <label class="form-label fw-bold mb-2">Initial Payment (Optional)</label>
                                <input type="number" step="any" min="0" class="form-control mb-2" wire:model.live="po_payment" placeholder="e.g. 5000">
                                <div class="row g-2">
                                    <div class="col-md-4">
                                        <label class="form-label">Payment Method</label>
                                        <select class="form-select form-select-sm" wire:model.lazy="transaction_type">
                                            <option value="cash">Cash</option>
                                            <option value="upi">UPI</option>
                                            <option value="bank">Bank</option>
                                            <option value="cheque">Cheque</option>
                                            <option value="card">Card</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Payment Date</label>
                                        <input type="date" class="form-control form-control-sm" wire:model.lazy="transaction_date" value="{{ $transaction_date ?? date('Y-m-d') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Ref / Trx No.</label>
                                        <input type="text" class="form-control form-control-sm" wire:model.lazy="transaction_no" placeholder="Trx / Ref No.">
                                    </div>
                                </div>
                            </div>
                        @else
                            {{-- Edit Mode: Dedicated Payment History Ledger --}}
                            <div class="mt-3 pt-3 border-top">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h6 class="mb-0 fw-bold text-dark" style="font-size: 0.95rem;">
                                        <i class="bx bx-receipt text-danger me-1"></i> Payment History Ledger
                                    </h6>
                                    <span class="badge bg-success" style="font-size: 0.8rem;">
                                        Total Paid: ₹{{ number_format($paid ?? 0, 2) }}
                                    </span>
                                </div>

                                @if(!empty($payments_list))
                                    <div class="table-responsive mb-3 border rounded-3 overflow-hidden">
                                        <table class="table table-sm table-striped table-hover align-middle mb-0" style="font-size: 0.82rem;">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th class="py-2 px-2">Date</th>
                                                    <th class="py-2 px-2">Amount</th>
                                                    <th class="py-2 px-2">Method</th>
                                                    <th class="py-2 px-2">Ref / Trx No.</th>
                                                    <th class="py-2 px-2 text-center" style="width: 50px;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($payments_list as $pay)
                                                    <tr>
                                                        <td class="px-2">{{ \Carbon\Carbon::parse($pay['payment_date'] ?? $pay['created_at'])->format('d-M-Y H:i') }}</td>
                                                        <td class="px-2 fw-bold text-success">₹{{ number_format($pay['amount'], 2) }}</td>
                                                        <td class="px-2">
                                                            <span class="badge bg-light text-dark border text-capitalize">{{ ucwords(str_replace('_', ' ', $pay['payment_type'])) }}</span>
                                                        </td>
                                                        <td class="px-2">{{ $pay['transaction_number'] ?: 'N/A' }}</td>
                                                        <td class="px-2 text-center">
                                                            <button type="button" class="btn btn-sm btn-light text-danger rounded-circle p-0"
                                                                style="width: 26px; height: 26px;"
                                                                wire:click="deletePayment({{ $pay['id'] }})"
                                                                wire:confirm="Are you sure you want to delete this payment record?">
                                                                <i class="bx bx-trash" style="font-size: 14px;"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="alert alert-light border py-2 text-center text-muted" style="font-size: 0.85rem; border-radius: 8px;">
                                        No payments recorded in ledger yet.
                                    </div>
                                @endif

                                {{-- Add New Payment Card --}}
                                <div class="card bg-light border p-3 mt-2" style="border-radius: 10px;">
                                    <h6 class="mb-2" style="font-size: 0.88rem; font-weight: 600; color: #1e293b;">
                                        <i class="bx bx-plus-circle text-danger me-1"></i> Add Payment Entry
                                    </h6>
                                    <div class="row g-2 align-items-end">
                                        <div class="col-md-4">
                                            <label class="form-label mb-1" style="font-size: 0.78rem;">Amount (₹) <span class="text-danger">*</span></label>
                                            <input type="number" step="0.01" min="0.01" class="form-control form-control-sm @error('new_payment_amount') is-invalid @enderror" 
                                                wire:model.live="new_payment_amount" placeholder="e.g. 10000">
                                            @error('new_payment_amount')
                                                <span class="invalid-feedback d-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label mb-1" style="font-size: 0.78rem;">Method <span class="text-danger">*</span></label>
                                            <select class="form-select form-select-sm @error('new_payment_type') is-invalid @enderror" wire:model.live="new_payment_type">
                                                <option value="cash">Cash</option>
                                                <option value="upi">UPI</option>
                                                <option value="bank">Bank</option>
                                                <option value="cheque">Cheque</option>
                                                <option value="card">Card</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label mb-1" style="font-size: 0.78rem;">Ref / Trx No.</label>
                                            <input type="text" class="form-control form-control-sm" wire:model.live="new_payment_transaction_number" placeholder="Ref No.">
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-sm btn-danger w-100" wire:click="addPayment" style="background: #e53935; border-color: #e53935;">
                                                <i class="bx bx-plus"></i> Add
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="d-flex justify-content-between py-2 border-bottom mt-2">
                            <span class="text-muted">Return</span>
                            <span class="fw-semibold text-dark">₹{{ number_format($return_amount ?? 0, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between py-2 border-bottom">
                            <span class="text-muted">Previous Balance</span>
                            <span class="fw-semibold text-dark">₹{{ number_format($previous_balance ?? 0, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center p-3 mt-3 rounded-3" style="background: #eff6ff; border: 1px solid #bfdbfe;">
                            <span class="fw-bold text-primary fs-6">Total Balance</span>
                            <span class="fw-bold text-primary fs-5">₹{{ number_format($total_balance ?? 0, 2) }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="d-flex justify-content-between align-items-center mt-4 pt-2">
        <!-- Left: Cancel Button -->
        <div>
            <button type="button" class="btn btn-light text-danger border d-inline-flex align-items-center" wire:click="cancelOrder" style="min-height: 42px; border-radius: 9px; font-weight: 600; padding: 0 20px; border-color: #fecaca !important; background: #fff5f5 !important;">
                <i class="bx bx-x me-1 fs-5"></i> Cancel Order
            </button>
        </div>

        <!-- Right: Action buttons -->
        <div class="d-flex gap-2">
            @if($isEdit)
                <button type="button" class="btn btn-primary d-inline-flex align-items-center" wire:click="updatePO" style="min-height: 42px; border-radius: 9px; font-weight: 600; padding: 0 24px; background: #e53935 !important; border-color: #e53935 !important; box-shadow: 0 3px 10px rgba(229, 57, 53, 0.22);">
                    <i class="bx bx-check-circle me-1 fs-5"></i> Update
                </button>
                @if($po_status === 'Open')
                    <button type="button" class="btn btn-success d-inline-flex align-items-center" wire:click="placeOrder" style="min-height: 42px; border-radius: 9px; font-weight: 600; padding: 0 20px;">
                        <i class="bx bx-send me-1 fs-5"></i> Place Order
                    </button>
                @elseif($po_status === 'Placed')
                    <button type="button" class="btn btn-info text-white d-inline-flex align-items-center" wire:click="markReceived" style="min-height: 42px; border-radius: 9px; font-weight: 600; padding: 0 20px;">
                        <i class="bx bx-package me-1 fs-5"></i> Received
                    </button>
                @elseif($po_status === 'Received')
                    <button type="button" class="btn btn-warning text-dark d-inline-flex align-items-center" wire:click="addToStock" style="min-height: 42px; border-radius: 9px; font-weight: 600; padding: 0 20px;">
                        <i class="bx bx-archive-in me-1 fs-5"></i> Add to Stock
                    </button>
                @endif
            @else
                <button type="button" class="btn btn-danger d-inline-flex align-items-center" wire:click="savePO" style="min-height: 42px; border-radius: 9px; font-weight: 600; padding: 0 26px; background: #e53935 !important; border-color: #e53935 !important; box-shadow: 0 3px 10px rgba(229, 57, 53, 0.22);">
                    <i class="bx bx-check-circle me-1 fs-5"></i> Create PO
                </button>
            @endif
        </div>
    </div>


    <!-- Supplier Add/Edit Modal -->
    @if ($showSupplierModal)
    <div class="carnate-modal-backdrop">
        <div class="carnate-modal-content" style="max-width: 780px;">
            <form wire:submit.prevent="{{ $isSupplierEdit ? 'updateSupplier' : 'storeSupplier' }}" class="carnate-modal-form">
                <div class="carnate-modal-header">
                    <div class="d-flex align-items-center gap-3">
                        <div class="card-header-icon" style="width: 40px; height: 40px; font-size: 20px;">
                            <i class="bx bx-store"></i>
                        </div>
                        <div>
                            <h5 class="mb-0 fw-bold text-dark">{{ $isSupplierEdit ? 'Edit Supplier' : 'Add New Supplier' }}</h5>
                            <small class="text-muted">Enter contact and business details</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close" wire:click="closeSupplierModal" aria-label="Close"></button>
                </div>

                <div class="carnate-modal-body">
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Mobile No. <sup class="text-danger">*</sup></label>
                            <input type="text" wire:model.lazy="mobile_no" class="form-control" placeholder="Enter Mobile No.">
                            @error('mobile_no') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <h6 class="fw-bold text-dark border-bottom pb-2 mb-3" style="font-size: 14px;">
                        <i class="bx bx-briefcase text-danger me-1"></i> Business Info
                    </h6>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Firm / First Name <sup class="text-danger">*</sup></label>
                            <input type="text" wire:model.lazy="business_first_name" class="form-control" placeholder="Enter Firm Name">
                            @error('business_first_name') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">GSTIN</label>
                            <input type="text" wire:model.lazy="gstin" class="form-control" placeholder="Enter GSTIN">
                            @error('gstin') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Business Address</label>
                            <input type="text" wire:model.lazy="business_address" class="form-control" placeholder="Enter Address">
                            @error('business_address') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <h6 class="fw-bold text-dark border-bottom pb-2 mb-3" style="font-size: 14px;">
                        <i class="bx bx-user text-danger me-1"></i> Owner Info
                    </h6>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Owner Name <sup class="text-danger">*</sup></label>
                            <input type="text" wire:model.lazy="owner_first_name" class="form-control" placeholder="Enter Owner Name">
                            @error('owner_first_name') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Contact 1 <sup class="text-danger">*</sup></label>
                            <input type="text" wire:model.lazy="contact_1" class="form-control" placeholder="Enter Contact 1">
                            @error('contact_1') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Contact 2</label>
                            <input type="text" wire:model.lazy="contact_2" class="form-control" placeholder="Enter Contact 2">
                            @error('contact_2') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" wire:model.lazy="email" class="form-control" placeholder="Enter Email">
                            @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="carnate-modal-footer">
                    <button type="button" class="btn btn-light border px-4" wire:click="closeSupplierModal" style="border-radius: 9px; font-weight: 600;">Cancel</button>
                    <button type="submit" class="btn btn-danger px-4" style="border-radius: 9px; font-weight: 600; background: #e53935; border-color: #e53935;">
                        {{ $isSupplierEdit ? 'Update Supplier' : 'Save Supplier' }}
                        <span class="spinner-border spinner-border-sm ms-1" wire:loading wire:target="{{ $isSupplierEdit ? 'updateSupplier' : 'storeSupplier' }}"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif

    <!-- Add Part Modal -->
    @if ($showPartModal)
    <div class="carnate-modal-backdrop">
        <div class="carnate-modal-content" style="max-width: 900px;">
            <form wire:submit.prevent="storePart">
                <div class="carnate-modal-header">
                    <div class="d-flex align-items-center gap-3">
                        <div class="card-header-icon" style="width: 40px; height: 40px; font-size: 20px;">
                            <i class="bx bx-package"></i>
                        </div>
                        <div>
                            <h5 class="mb-0 fw-bold text-dark">Add New Part</h5>
                            <small class="text-muted">Enter part details, compatibility, and pricing</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close" wire:click="closePartModal" aria-label="Close"></button>
                </div>

                <div class="carnate-modal-body">
                    <div class="row g-3">
                        <!-- Part Number -->
                        <div class="col-md-6">
                            <label class="form-label">Part Number</label>
                            <input type="text" wire:model="part_part_number" class="form-control" placeholder="Enter Part Number">
                            <div wire:loading wire:target="part_part_number" class="mt-1 small text-muted">
                                <span class="spinner-border spinner-border-sm text-danger me-1" role="status" aria-hidden="true"></span>
                                Fetching details...
                            </div>
                            @error('part_part_number') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <!-- Name -->
                        <div class="col-md-6">
                            <label class="form-label">Name <sup class="text-danger">*</sup></label>
                            <input type="text" wire:model.lazy="part_name" class="form-control" placeholder="Enter Name">
                            @error('part_name') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <!-- Brand -->
                        <div class="col-md-6">
                            <label class="form-label">Brand</label>
                            <input type="text" wire:model="part_brand" class="form-control" placeholder="Enter Brand">
                            @error('part_brand') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <!-- Category -->
                        <div class="col-md-6">
                            <label class="form-label">Category</label>
                            <select class="form-select" wire:model.lazy="part_category">
                                <option value="">Select Category</option>
                                @foreach ($part_categories as $category)
                                    <option value="{{ $category['categoryId'] * 1 }}">{{ $category['categoryName'] }}</option>
                                @endforeach
                            </select>
                            @error('part_category') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <!-- Purchase Price -->
                        <div class="col-md-6">
                            <label class="form-label">Purchase Price <sup class="text-danger">*</sup></label>
                            <input type="number" wire:model.lazy="part_purchase_amount" class="form-control" placeholder="Enter Purchase Price">
                            @error('part_purchase_amount') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <!-- Selling Price -->
                        <div class="col-md-6">
                            <label class="form-label">Selling Price <sup class="text-danger">*</sup></label>
                            <input type="number" wire:model.lazy="part_selling_amount" class="form-control" placeholder="Enter Selling Price">
                            @error('part_selling_amount') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <!-- Tax Type -->
                        <div class="col-md-6">
                            <label class="form-label">Tax Type</label>
                            <select class="form-select" wire:model="part_tax_type">
                                <option value="">Select Tax Type</option>
                                <option value="include">Include All Taxes</option>
                                <option value="exclude">Exclude All Taxes</option>
                            </select>
                            @error('part_tax_type') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <!-- Tax Percentage -->
                        @if ($part_tax_type == 'include' || $part_tax_type == 'exclude')
                        <div class="col-md-6">
                            <label class="form-label">
                                {{ $part_tax_type == 'include' ? 'Include Tax Percentage' : 'Exclude Tax Percentage' }}
                            </label>
                            <div class="input-group">
                                <input type="number" wire:model.lazy="part_tax_percentage" class="form-control" placeholder="Enter Percentage">
                                <span class="input-group-text">%</span>
                            </div>
                            @error('part_tax_percentage') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        @endif

                        <!-- Discount -->
                        <div class="col-md-6">
                            <label class="form-label">Online Discount</label>
                            <div class="input-group">
                                <input type="number" wire:model="part_discount" class="form-control" placeholder="Enter Discount">
                                <select class="form-select" wire:model="part_discount_type" style="max-width: 80px;">
                                    <option value="1">₹</option>
                                    <option value="2">%</option>
                                </select>
                            </div>
                            @error('part_discount') <span class="text-danger small">{{ $message }}</span> @enderror
                            @error('part_discount_type') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <!-- Type Dropdown -->
                        <div class="col-md-6">
                            <label class="form-label">Type <sup class="text-danger">*</sup></label>
                            <select class="form-select" wire:model="part_type">
                                <option value="part">Part</option>
                                <option value="lubricant">Lubricant</option>
                                <option value="accessory">Accessory</option>
                            </select>
                            @error('part_type') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <!-- Unit -->
                        <div class="col-md-6">
                            <label class="form-label">Unit <sup class="text-danger">*</sup></label>
                            <select class="form-select" wire:model.lazy="part_unit">
                                <option value="">Select Unit</option>
                                @foreach ($part_units as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->title }}</option>
                                @endforeach
                            </select>
                            @error('part_unit') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <!-- SP Type -->
                        <div class="col-md-6">
                            <label class="form-label">SP Type <sup class="text-danger">*</sup></label>
                            <select class="form-select" wire:model.lazy="part_sp_type">
                                <option value="">Select SP Type</option>
                                <option value="0">New</option>
                                <option value="1">Used</option>
                            </select>
                            @error('part_sp_type') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <!-- Stock -->
                        <div class="col-md-6">
                            <label class="form-label">Stock <sup class="text-danger">*</sup></label>
                            <input type="number" wire:model.lazy="part_stock" class="form-control" placeholder="Enter Stock">
                            @error('part_stock') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <!-- HSN Code -->
                        <div class="col-md-6">
                            <label class="form-label">HSN Code</label>
                            <input type="text" wire:model.lazy="part_hsn_code" class="form-control" placeholder="Enter HSN Code">
                            @error('part_hsn_code') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <!-- Rack No. -->
                        <div class="col-md-6">
                            <label class="form-label">Rack No.</label>
                            <input type="text" wire:model.lazy="part_rack_no" class="form-control" placeholder="Enter Rack No.">
                            @error('part_rack_no') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <!-- Image -->
                        <div class="col-md-12">
                            <label class="form-label">Image</label>
                            <div class="row align-items-center">
                                <div class="col-md-10">
                                    <input type="file" class="form-control" wire:model="image" />
                                </div>
                                <div class="col-md-2 text-center">
                                    @if ($part_part_image_url)
                                        <img class="img-fluid rounded border" style="max-height: 48px;" src="{{ $part_part_image_url }}">
                                    @elseif (!empty($imageName))
                                        <img class="img-fluid rounded border" style="max-height: 48px;" src="{{ asset($imageName) }}">
                                    @endif
                                </div>
                            </div>
                            @error('image')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Compatible Vehicles -->
                        <div class="col-md-12">
                            <label class="form-label">Compatible Vehicles List <sup class="text-danger">*</sup></label>
                            <input type="text"
                                wire:model="brandFilter"
                                class="form-control mb-2"
                                placeholder="Type to filter brand name...">
                                
                            <div class="border rounded p-3" style="max-height: 250px; overflow-y: auto; background: #f8fafc;">
                                @if (!empty($part_api_compatible_vehicles))
                                    <div class="row g-2">
                                        @foreach ($part_api_compatible_vehicles as $vehicle)
                                            <div class="col-md-6">
                                                <div class="vehicle-item p-2 bg-white rounded border">
                                                    <strong class="text-dark">{{ $vehicle['manufacturerName'] }} {{ $vehicle['modelName'] }}</strong><br>
                                                    <small class="text-muted">
                                                        {{ $vehicle['typeEngineName'] ? $vehicle['typeEngineName'] . ' | ' : '' }}
                                                        {{ $vehicle['fuelType'] ? $vehicle['fuelType'] . ' | ' : '' }}
                                                        {{ $vehicle['year'] ? $vehicle['year'] : '' }}
                                                    </small>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @elseif (!empty($part_modifications))
                                    <div class="row g-2">
                                        @foreach ($part_modifications as $modification)
                                            @if(empty($brandFilter) || stripos($modification->brand_name, $brandFilter) !== false)
                                                <div class="col-md-6">
                                                    <div class="form-check vehicle-item p-2 bg-white rounded border">
                                                        <input class="form-check-input ms-1"
                                                            type="checkbox"
                                                            value="{{ $modification->id }}"
                                                            wire:model.lazy="part_suitable_for"
                                                            id="modification_{{ $modification->id }}">
                                                        <label class="form-check-label ps-2" for="modification_{{ $modification->id }}">
                                                            <strong class="text-dark">{{ $modification->brand_name }} {{ $modification->variant_name }}</strong><br>
                                                            <small class="text-muted">
                                                                {{ $modification->year }} {{ $modification->title }}
                                                            </small>
                                                        </label>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center text-muted py-3">
                                        <p class="mb-0">No compatible vehicles found</p>
                                    </div>
                                @endif
                            </div>
                            <small class="text-muted">All selected vehicles in this list will be saved as compatible vehicles.</small>
                        </div>

                        <!-- Description -->
                        <div class="col-md-12">
                            <label class="form-label">Description</label>
                            <textarea wire:model="part_description" rows="3" class="form-control" placeholder="Enter Description"></textarea>
                            @error('part_description') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="carnate-modal-footer">
                    <button type="button" class="btn btn-light border px-4" wire:click="closePartModal" style="border-radius: 9px; font-weight: 600;">Cancel</button>
                    <button type="submit" class="btn btn-danger px-4" style="border-radius: 9px; font-weight: 600; background: #e53935; border-color: #e53935;">
                        Save Part
                        <span class="spinner-border spinner-border-sm ms-1" wire:loading wire:target="storePart"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif

</div>
