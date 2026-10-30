<div class="carnate-stock-list-page">

    @php
        $user = Auth::guard('workshop')->user();
    @endphp

    <style>
        .carnate-stock-list-page {
            --sl-red: #e53935;
            --sl-red-dark: #c62828;
            --sl-red-soft: #fff5f5;
            --sl-text: #111827;
            --sl-muted: #64748b;
            --sl-border: #e2e8f0;
            --sl-card: #ffffff;
            --sl-bg: #f7f8fa;
            --sl-green: #16a34a;
            --sl-blue: #2563eb;
            --sl-orange: #d97706;
            --sl-shadow: 0 4px 20px rgba(15, 23, 42, .05);
        }

        .carnate-stock-list-page {
            color: var(--sl-text);
        }

        /* =========================
           MODALS
        ========================== */

        .carnate-stock-list-page .sl-modal {
            position: fixed;
            inset: 0;
            z-index: 1055;
            background: rgba(6, 6, 6, .55);
            overflow-y: auto;
            padding: 25px 15px;
        }

        .carnate-stock-list-page .sl-modal-dialog {
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
        }

        .carnate-stock-list-page .sl-modal-content {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 25px 70px rgba(15, 23, 42, .2);
        }

        .carnate-stock-list-page .sl-modal-header {
            padding: 18px 22px;
            border-bottom: 1px solid var(--sl-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .carnate-stock-list-page .sl-modal-title {
            margin: 0;
            color: var(--sl-text);
            font-size: 18px;
            font-weight: 700;
        }

        .carnate-stock-list-page .sl-modal-title i {
            color: var(--sl-red);
            margin-right: 7px;
        }

        .carnate-stock-list-page .sl-close {
            width: 34px;
            height: 34px;
            padding: 0;
            border: 1px solid var(--sl-border);
            border-radius: 8px;
            background: #fff;
            color: #64748b;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .carnate-stock-list-page .sl-close:hover {
            background: var(--sl-red-soft);
            border-color: #fecaca;
            color: var(--sl-red);
        }

        .carnate-stock-list-page .sl-modal-body {
            padding: 22px;
        }

        .carnate-stock-list-page .sl-modal-footer {
            padding: 15px 22px;
            border-top: 1px solid var(--sl-border);
            background: #f8fafc;
            display: flex;
            justify-content: flex-end;
            gap: 9px;
        }

        /* =========================
           FORM
        ========================== */

        .carnate-stock-list-page .form-control,
        .carnate-stock-list-page .form-select {
            min-height: 42px;
            border: 1px solid var(--sl-border);
            border-radius: 9px;
            color: var(--sl-text);
            background: #fff;
            box-shadow: none;
            font-size: 13px;
        }

        .carnate-stock-list-page .form-control:focus,
        .carnate-stock-list-page .form-select:focus {
            border-color: rgba(229, 57, 53, .55);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .08);
        }

        .carnate-stock-list-page .form-label {
            margin-bottom: 7px;
            color: #475569;
            font-size: 12px;
            font-weight: 700;
        }

        .carnate-stock-list-page .text-danger.error {
            display: block;
            margin-top: 5px;
            font-size: 11px;
        }

        .carnate-stock-list-page .sl-section {
            margin-top: 20px;
            padding-top: 18px;
            border-top: 1px solid var(--sl-border);
        }

        .carnate-stock-list-page .sl-section:first-child {
            margin-top: 0;
            padding-top: 0;
            border-top: 0;
        }

        .carnate-stock-list-page .sl-section-title {
            margin: 0 0 15px;
            color: var(--sl-text);
            font-size: 14px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .carnate-stock-list-page .sl-section-title i {
            color: var(--sl-red);
            font-size: 18px;
        }

        /* =========================
           PRODUCT SUMMARY
        ========================== */

        .carnate-stock-list-page .sl-product-summary {
            padding: 16px;
            border: 1px solid var(--sl-border);
            border-radius: 12px;
            background: #f8fafc;
        }

        .carnate-stock-list-page .sl-summary-item {
            min-height: 55px;
        }

        .carnate-stock-list-page .sl-summary-item.border-end {
            border-color: var(--sl-border) !important;
        }

        .carnate-stock-list-page .sl-summary-label {
            display: block;
            margin-bottom: 4px;
            color: var(--sl-muted);
            font-size: 11px;
        }

        .carnate-stock-list-page .sl-summary-value {
            color: var(--sl-text);
            font-size: 13px;
            font-weight: 700;
        }

        .carnate-stock-list-page .sl-price {
            color: var(--sl-green);
        }

        /* =========================
           FINAL PRICE
        ========================== */

        .carnate-stock-list-page .sl-final-price {
            min-height: 42px;
            padding: 10px 13px;
            border: 1px solid #fecaca;
            border-radius: 9px;
            background: var(--sl-red-soft);
            color: var(--sl-red);
            font-weight: 700;
            display: flex;
            align-items: center;
        }

        /* =========================
           COMPATIBLE VEHICLES
        ========================== */

        .carnate-stock-list-page .sl-vehicle-card {
            padding: 17px;
            border: 1px solid var(--sl-border);
            border-radius: 12px;
            background: #f8fafc;
        }

        .carnate-stock-list-page .sl-vehicle-title {
            margin-bottom: 12px;
            color: var(--sl-text);
            font-size: 13px;
            font-weight: 700;
        }

        .carnate-stock-list-page .sl-selected-list {
            display: flex;
            flex-wrap: wrap;
            gap: 7px;
        }

        .carnate-stock-list-page .sl-vehicle-badge {
            padding: 7px 10px;
            border-radius: 7px;
            background: #334155;
            color: #fff;
            font-size: 11px;
            display: inline-flex;
            align-items: center;
            gap: 7px;
        }

        .carnate-stock-list-page .sl-all-badge {
            display: inline-flex;
            padding: 6px 10px;
            border-radius: 7px;
            background: var(--sl-red);
            color: #fff;
            font-size: 11px;
            font-weight: 700;
        }

        /* =========================
           TABS
        ========================== */

        .carnate-stock-list-page .sl-tabs {
            background: #fff;
            border: 1px solid var(--sl-border);
            border-radius: 14px;
            box-shadow: var(--sl-shadow);
            overflow: hidden;
            margin-bottom: 18px;
        }

        .carnate-stock-list-page .sl-tabs-nav {
            display: flex;
            border-bottom: 1px solid var(--sl-border);
        }

        .carnate-stock-list-page .sl-tab {
            flex: 1;
            padding: 14px 20px;
            border: 0;
            background: #fff;
            color: var(--sl-muted);
            text-decoration: none;
            cursor: pointer;
            transition: all .18s ease;
        }

        .carnate-stock-list-page .sl-tab + .sl-tab {
            border-left: 1px solid var(--sl-border);
        }

        .carnate-stock-list-page .sl-tab-inner {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 13px;
            font-weight: 700;
        }

        .carnate-stock-list-page .sl-tab i {
            font-size: 19px;
        }

        .carnate-stock-list-page .sl-tab.active {
            background: var(--sl-red);
            color: #fff;
        }

        .carnate-stock-list-page .sl-tab:hover:not(.active) {
            background: #fafbfc;
            color: var(--sl-text);
        }

        /* =========================
           PAGE HEADER
        ========================== */

        .carnate-stock-list-page .sl-header {
            background: #fff;
            border: 1px solid var(--sl-border);
            border-radius: 14px;
            box-shadow: var(--sl-shadow);
            margin-bottom: 18px;
        }

        .carnate-stock-list-page .sl-header-body {
            min-height: 78px;
            padding: 16px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .carnate-stock-list-page .sl-title {
            margin: 0;
            color: var(--sl-text);
            font-size: 21px;
            font-weight: 700;
        }

        .carnate-stock-list-page .sl-subtitle {
            margin: 5px 0 0;
            color: var(--sl-muted);
            font-size: 12px;
        }

        /* =========================
           BUTTONS
        ========================== */

        .carnate-stock-list-page .sl-primary-btn {
            min-height: 40px;
            padding: 9px 16px;
            border: 1px solid var(--sl-red);
            border-radius: 9px;
            background: var(--sl-red);
            color: #fff;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: all .18s ease;
        }

        .carnate-stock-list-page .sl-primary-btn:hover {
            background: var(--sl-red-dark);
            border-color: var(--sl-red-dark);
            color: #fff;
            transform: translateY(-1px);
        }

        .carnate-stock-list-page .sl-secondary-btn {
            min-height: 40px;
            padding: 9px 16px;
            border: 1px solid var(--sl-border);
            border-radius: 9px;
            background: #fff;
            color: #475569;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
        }

        .carnate-stock-list-page .sl-secondary-btn:hover {
            background: #f8fafc;
        }

        /* =========================
           SEARCH / FILTER
        ========================== */

        .carnate-stock-list-page .sl-filter-card {
            background: #fff;
            border: 1px solid var(--sl-border);
            border-radius: 14px;
            box-shadow: var(--sl-shadow);
            margin-bottom: 18px;
        }

        .carnate-stock-list-page .sl-filter-body {
            padding: 16px 18px;
        }

        .carnate-stock-list-page .sl-filter-row {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .carnate-stock-list-page .sl-search {
            flex: 1;
            position: relative;
        }

        .carnate-stock-list-page .sl-search-icon {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            z-index: 2;
        }

        .carnate-stock-list-page .sl-category-filter {
            width: 240px;
        }

        .carnate-stock-list-page .sl-clear {
            white-space: nowrap;
        }

        /* =========================
           TABLE
        ========================== */

        .carnate-stock-list-page .sl-table-card {
            background: #fff;
            border: 1px solid var(--sl-border);
            border-radius: 14px;
            box-shadow: var(--sl-shadow);
            overflow: hidden;
        }

        .carnate-stock-list-page .sl-table-wrap {
            overflow-x: auto;
        }

        .carnate-stock-list-page .sl-table {
            width: 100%;
            min-width: 1100px;
            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .carnate-stock-list-page .sl-table thead th {
            padding: 13px 14px;
            background: #f8fafc;
            color: #475569;
            border-bottom: 1px solid var(--sl-border);
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .4px;
            white-space: nowrap;
        }

        .carnate-stock-list-page .sl-table tbody td {
            padding: 13px 14px;
            border-bottom: 1px solid #eef2f7;
            color: #334155;
            font-size: 13px;
            vertical-align: middle;
        }

        .carnate-stock-list-page .sl-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .carnate-stock-list-page .sl-table tbody tr:hover {
            background: #fafbfc;
        }

        .carnate-stock-list-page .sl-index {
            width: 65px;
            color: #94a3b8 !important;
            font-weight: 600;
        }

        .carnate-stock-list-page .sl-product {
            color: var(--sl-text);
            font-weight: 700;
        }

        .carnate-stock-list-page .sl-category-badge {
            display: inline-flex;
            padding: 5px 9px;
            border-radius: 7px;
            background: var(--sl-red-soft);
            border: 1px solid #fee2e2;
            color: var(--sl-red);
            font-size: 11px;
            font-weight: 700;
        }

        .carnate-stock-list-page .sl-brand {
            font-weight: 600;
            color: #334155;
        }

        .carnate-stock-list-page .sl-muted {
            color: var(--sl-muted);
        }

        .carnate-stock-list-page .sl-stock {
            font-weight: 700;
            color: var(--sl-text);
        }

        .carnate-stock-list-page .sl-price {
            white-space: nowrap;
            font-weight: 700;
        }

        .carnate-stock-list-page .sl-tax {
            color: #475569;
            font-weight: 600;
        }

        .carnate-stock-list-page .sl-tax-type {
            color: #94a3b8;
            font-size: 10px;
            text-transform: capitalize;
        }

        .carnate-stock-list-page .sl-actions {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .carnate-stock-list-page .sl-action-btn {
            width: 34px;
            height: 34px;
            padding: 0;
            border-radius: 8px;
            border: 1px solid transparent;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all .18s ease;
        }

        .carnate-stock-list-page .sl-edit {
            background: #eff6ff;
            border-color: #dbeafe;
            color: var(--sl-blue);
        }

        .carnate-stock-list-page .sl-edit:hover {
            background: #dbeafe;
            transform: translateY(-1px);
        }

        .carnate-stock-list-page .sl-delete {
            background: var(--sl-red-soft);
            border-color: #fee2e2;
            color: #dc2626;
        }

        .carnate-stock-list-page .sl-delete:hover {
            background: #fee2e2;
            transform: translateY(-1px);
        }

        /* =========================
           EMPTY
        ========================== */

        .carnate-stock-list-page .sl-empty {
            padding: 55px 20px;
            text-align: center;
        }

        .carnate-stock-list-page .sl-empty-icon {
            width: 54px;
            height: 54px;
            margin: 0 auto 12px;
            border-radius: 14px;
            background: #f1f5f9;
            color: #64748b;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .carnate-stock-list-page .sl-empty-title {
            color: var(--sl-text);
            font-size: 14px;
            font-weight: 700;
        }

        .carnate-stock-list-page .sl-empty-text {
            margin-top: 4px;
            color: var(--sl-muted);
            font-size: 12px;
        }

        /* =========================
           RESPONSIVE
        ========================== */

        @media (max-width: 900px) {
            .carnate-stock-list-page .sl-filter-row {
                flex-wrap: wrap;
            }

            .carnate-stock-list-page .sl-search {
                min-width: 250px;
            }

            .carnate-stock-list-page .sl-category-filter {
                width: 220px;
            }
        }

        @media (max-width: 1024px) {
            .carnate-stock-list-page .sl-modal {
                padding: 12px 8px;
                overflow-x: hidden;
            }

            .carnate-stock-list-page .sl-modal-dialog {
                width: 100% !important;
                max-width: 100% !important;
                margin: 0 auto !important;
            }

            .carnate-stock-list-page .sl-modal-content {
                border-radius: 12px;
            }
        }

        @media (max-width: 767px) {
            .carnate-stock-list-page .sl-header-body {
                align-items: flex-start;
                flex-direction: column;
            }

            .carnate-stock-list-page .sl-primary-btn {
                width: 100%;
                justify-content: center;
            }

            .carnate-stock-list-page .sl-tabs-nav {
                flex-direction: column;
            }

            .carnate-stock-list-page .sl-tab + .sl-tab {
                border-left: 0;
                border-top: 1px solid var(--sl-border);
            }

            .carnate-stock-list-page .sl-filter-row {
                align-items: stretch;
                flex-direction: column;
            }

            .carnate-stock-list-page .sl-search,
            .carnate-stock-list-page .sl-category-filter,
            .carnate-stock-list-page .sl-clear {
                width: 100%;
            }

            .carnate-stock-list-page .sl-modal {
                padding: 12px 8px;
            }

            .carnate-stock-list-page .sl-modal-body {
                padding: 16px;
            }

            .carnate-stock-list-page .sl-summary-item.border-end {
                border-right: 0 !important;
                border-bottom: 1px solid var(--sl-border);
                padding-bottom: 10px;
                margin-bottom: 10px;
            }
        }
    </style>


    {{-- ============================================================
        SPARE PART LABEL MODAL
    ============================================================= --}}

    <div
        class="sl-modal"
        tabindex="-1"
        style="
            opacity:1;
            display:@if ($showSpariOartesModal) block @else none @endif;
        ">

        <div class="sl-modal-dialog">

            <div class="sl-modal-content">

                <form wire:submit.prevent="storeSpareParts">

                    <div class="sl-modal-header">

                        <h4 class="sl-modal-title">

                            <i class="bx bx-package"></i>

                            {{ $isEdit ? 'Edit Accessory' : 'Create SpareParts' }}

                        </h4>

                        <button
                            type="button"
                            class="sl-close"
                            wire:click="closeSpariOartesModal"
                            data-bs-dismiss="modal"
                            aria-label="Close">

                            <i class="bx bx-x"></i>

                        </button>

                    </div>


                    <div class="sl-modal-body">

                        @csrf

                        <div class="row g-3">

                            <div class="col-md-12">

                                <label class="form-label">
                                    Name
                                    <sup class="text-danger">*</sup>
                                </label>

                                <input
                                    type="text"
                                    wire:model="new_spare_part_name"
                                    class="form-control"
                                    placeholder="Enter Name">

                                @error('new_spare_part_name')
                                    <span class="text-danger error">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>

                        </div>

                    </div>


                    <div class="sl-modal-footer">

                        <button
                            type="button"
                            class="sl-secondary-btn"
                            wire:click="closeSpariOartesModal"
                            data-bs-dismiss="modal">

                            Cancel

                        </button>

                        <button
                            type="submit"
                            class="sl-primary-btn">

                            {{ $isEdit ? 'Update' : 'Create' }}

                            <i
                                class="spinner-border spinner-border-sm"
                                wire:loading>
                            </i>

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>


    {{-- ============================================================
        ADD / UPDATE STOCK MODAL
    ============================================================= --}}

    <div
        class="sl-modal"
        tabindex="-1"
        style="
            opacity:1;
            display:@if ($showModal) block @else none @endif;
        ">

        <div class="sl-modal-dialog" style="max-width:1000px;">

            <div class="sl-modal-content">

                <form wire:submit.prevent="{{ $isAdd ? 'update' : 'store' }}">

                    <div class="sl-modal-header">

                        <h4 class="sl-modal-title">

                            <i class="bx bx-package"></i>

                            {{ $isAdd ? 'Update Stock' : 'Add Stock' }}

                        </h4>

                        <button
                            type="button"
                            class="sl-close"
                            wire:click="modalClose"
                            data-bs-dismiss="modal"
                            aria-label="Close">

                            <i class="bx bx-x"></i>

                        </button>

                    </div>


                    <div class="sl-modal-body">

                        <div class="row g-3">

                            {{-- =================================================
                                 ONLINE PRODUCT SUMMARY
                            ================================================== --}}

                            @if(!$is_self_stock)

                                <div class="col-md-12">

                                    <div class="sl-product-summary">

                                        <div class="row">

                                            <div class="col-md-6 sl-summary-item border-end">

                                                <span class="sl-summary-label">
                                                    Product Name
                                                </span>

                                                <span class="sl-summary-value">

                                                    {{ $sparePartLabels->find($name)->title ?? 'N/A' }}

                                                </span>

                                            </div>

                                            <div class="col-md-6 sl-summary-item ps-md-4">

                                                <span class="sl-summary-label">
                                                    Purchase Price
                                                </span>

                                                <span class="sl-summary-value sl-price">

                                                    Rs. {{ number_format($purchase_amount, 2) }}

                                                </span>

                                            </div>

                                        </div>


                                        <div class="row mt-3 pt-3 border-top">

                                            <div class="col-md-3 sl-summary-item border-end">

                                                <span class="sl-summary-label">
                                                    HSN Code
                                                </span>

                                                <span class="sl-summary-value">
                                                    {{ $hsn_code ?? '-' }}
                                                </span>

                                            </div>

                                            <div class="col-md-3 sl-summary-item border-end ps-md-4">

                                                <span class="sl-summary-label">
                                                    Unit
                                                </span>

                                                <span class="sl-summary-value">
                                                    {{ $units->find($unit)->title ?? '-' }}
                                                </span>

                                            </div>

                                            <div class="col-md-3 sl-summary-item border-end ps-md-4">

                                                <span class="sl-summary-label">
                                                    Sub Category
                                                </span>

                                                <span class="sl-summary-value">
                                                    {{ $categories->find($category)->title ?? '-' }}
                                                </span>

                                            </div>

                                            <div class="col-md-3 sl-summary-item ps-md-4">

                                                <span class="sl-summary-label">
                                                    Current Stock
                                                </span>

                                                <span class="sl-summary-value">
                                                    {{ $stock ?? 0 }}
                                                </span>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            @endif


                            {{-- =================================================
                                 SELF STOCK BASIC INFO
                            ================================================== --}}

                            @if($is_self_stock)

                                <div class="col-md-6">

                                    <label class="form-label">
                                        Category
                                        <sup class="text-danger">*</sup>
                                    </label>

                                    <select
                                        class="form-select"
                                        wire:model="category_id">

                                        <option value="" selected>
                                            -- Select Category --
                                        </option>

                                        <option value="1">
                                            Accessory
                                        </option>

                                        <option value="2">
                                            Part
                                        </option>

                                        <option value="3">
                                            Tool
                                        </option>

                                        <option value="4">
                                            Lubricant
                                        </option>

                                    </select>

                                    @error('category_id')
                                        <span class="text-danger error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>


                                <div class="col-md-6">

                                    <div class="row align-items-end">

                                        <div class="form-group col-10 pe-0">

                                            <label class="form-label">
                                                Name
                                                <sup class="text-danger">*</sup>
                                            </label>

                                            <select
                                                id="stock_product_name_select"
                                                class="form-select searchable-select"
                                                data-placeholder="Select Name"
                                                wire:model="name"
                                                wire:change="setdata">

                                                <option value="">
                                                    Select Name
                                                </option>

                                                @foreach($sparePartLabels as $sparePartLabel)

                                                    <option value="{{ $sparePartLabel->id }}" {{ (string)$name === (string)$sparePartLabel->id ? 'selected' : '' }}>
                                                        {{ $sparePartLabel->title }}
                                                    </option>

                                                @endforeach

                                            </select>

                                        </div>


                                        <div class="col-2 p-0">

                                            {{-- ORIGINAL ACTION PRESERVED --}}

                                            <button
                                                type="button"
                                                class="btn btn-outline-secondary text-light bg-primary fl margin-left-0"
                                                wire:click="addSparets"
                                                fdprocessedid="u8qc8n"
                                                style="
                                                    width:42px;
                                                    height:42px;
                                                    padding:0;
                                                    border-radius:9px;
                                                    border:0;
                                                    background:#e53935 !important;
                                                    display:flex;
                                                    align-items:center;
                                                    justify-content:center;
                                                    color:#fff !important;
                                                    font-size:18px;
                                                ">

                                                +

                                            </button>

                                        </div>

                                    </div>

                                    @error('name')
                                        <span class="text-danger error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>


                                {{-- Supplier --}}

                                <div class="col-md-12">

                                    <label class="form-label">
                                        Company Name
                                    </label>

                                    <select
                                        class="form-select searchable-select"
                                        data-placeholder="Select Company Name"
                                        wire:model="supplier_id">

                                        <option value="">
                                            Select Company Name
                                        </option>

                                        @foreach ($suppliers as $supplier)

                                            <option value="{{ $supplier->id }}">
                                                {{ $supplier->business_first_name }}
                                            </option>

                                        @endforeach

                                    </select>

                                </div>

                            @endif


                            {{-- =================================================
                                 BRAND / PART NUMBER
                            ================================================== --}}

                            @if($is_self_stock)

                                <div class="col-md-12">

                                    <div class="sl-section">

                                        <h5 class="sl-section-title">

                                            <i class="bx bx-purchase-tag"></i>

                                            Product Information

                                        </h5>

                                        <div class="row g-3">

                                            <div class="col-md-6">

                                                <label class="form-label">
                                                    Brand
                                                    <sup class="text-danger">*</sup>
                                                </label>

                                                <input
                                                    type="text"
                                                    wire:model="brand"
                                                    class="form-control"
                                                    placeholder="Enter Brand">

                                                @error('brand')
                                                    <span class="text-danger error">
                                                        {{ $message }}
                                                    </span>
                                                @enderror

                                            </div>


                                            <div class="col-md-6">

                                                <label class="form-label">
                                                    Part Number
                                                </label>

                                                <input
                                                    type="text"
                                                    min="1"
                                                    wire:model="part_number"
                                                    class="form-control"
                                                    placeholder="Enter Part Number">

                                                @error('part_number')
                                                    <span class="text-danger error">
                                                        {{ $message }}
                                                    </span>
                                                @enderror

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            @endif


                            {{-- =================================================
                                 PRICING
                            ================================================== --}}

                            @if($is_self_stock)

                                <div class="col-md-6">

                                    <label class="form-label">
                                        Purchase Price
                                        <sup class="text-danger">*</sup>
                                    </label>

                                    <input
                                        type="number"
                                        wire:model="purchase_amount"
                                        class="form-control"
                                        placeholder="Enter Purchase Price">

                                    @error('purchase_amount')
                                        <span class="text-danger error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>

                            @endif


                            <div class="col-md-6">

                                <label class="form-label">
                                    Selling Price
                                    <sup class="text-danger">*</sup>
                                </label>

                                <input
                                    type="number"
                                    wire:model.live="amount"
                                    class="form-control"
                                    placeholder="Enter Selling Price">

                                @error('amount')
                                    <span class="text-danger error">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>


                            <div class="col-md-6">

                                <label class="form-label">
                                    Tax Type
                                    <sup class="text-danger">*</sup>
                                </label>

                                <select
                                    id="tax_type"
                                    class="form-select"
                                    wire:model.live="tax_type">

                                    <option value="">
                                        Select Tax Type
                                    </option>

                                    <option value="include">
                                        Include All Taxes
                                    </option>

                                    <option value="exclude">
                                        Exclude All Taxes
                                    </option>

                                </select>

                                @error('tax_type')
                                    <span class="text-danger error">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>


                            <div class="col-md-6">

                                <label class="form-label">
                                    Tax Percentage (%)
                                </label>

                                <div class="input-group">

                                    <input
                                        type="number"
                                        wire:model.live="tax_percentage"
                                        class="form-control"
                                        placeholder="Enter Percentage">

                                    <span class="input-group-text">
                                        %
                                    </span>

                                </div>

                                @error('tax_percentage')
                                    <span class="text-danger error">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>


                            <div class="col-md-6">

                                <label class="form-label">
                                    Final Selling Price (Incl. Tax)
                                </label>

                                <div class="sl-final-price">

                                    Rs. {{ number_format($this->finalPrice, 2) }}

                                </div>

                            </div>


                            {{-- =================================================
                                 HSN / UNIT / CATEGORY / TYPE / STOCK
                            ================================================== --}}

                            @if($is_self_stock)

                                <div class="col-md-6">

                                    <label class="form-label">
                                        HSN Code
                                    </label>

                                    <input
                                        type="text"
                                        wire:model="hsn_code"
                                        class="form-control"
                                        placeholder="Enter HSN Code">

                                    @error('hsn_code')
                                        <span class="text-danger error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>


                                <div class="col-md-6">

                                    <label class="form-label">
                                        Unit
                                        <sup class="text-danger">*</sup>
                                    </label>

                                    <select
                                        id="unit"
                                        class="form-select"
                                        wire:model="unit">

                                        <option value="">
                                            Select Unit
                                        </option>

                                        @foreach ($units as $unit)

                                            <option value="{{ $unit->id }}">
                                                {{ $unit->title }}
                                            </option>

                                        @endforeach

                                    </select>

                                    @error('unit')
                                        <span class="text-danger error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>


                                <div class="col-md-6">

                                    <label class="form-label">
                                        Sub Category
                                        <sup class="text-danger">*</sup>
                                    </label>

                                    <select
                                        class="form-select searchable-select"
                                        data-placeholder="Select Sub-Category"
                                        wire:model="category">

                                        <option value="">
                                            Select Category
                                        </option>

                                        @foreach ($categories as $category)

                                            <option value="{{ $category->id }}">
                                                {{ $category->title }}
                                            </option>

                                        @endforeach

                                    </select>

                                    @error('category')
                                        <span class="text-danger error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>


                                <div class="col-md-6">

                                    <label
                                        for="sp_type"
                                        class="form-label">

                                        SP Type

                                    </label>

                                    <select
                                        id="sp_type"
                                        class="form-select"
                                        wire:model="sp_type">

                                        <option value="0">
                                            New
                                        </option>

                                        <option value="1">
                                            Used
                                        </option>

                                    </select>

                                    @error('stock_sp_type')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>


                                <div class="col-md-6">

                                    <label class="form-label">
                                        Stock
                                        <sup class="text-danger">*</sup>
                                    </label>

                                    <input
                                        type="number"
                                        min="1"
                                        wire:model="stock"
                                        class="form-control"
                                        placeholder="Enter Stock">

                                    @error('stock')
                                        <span class="text-danger error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>

                            @endif


                            {{-- =================================================
                                 COMPATIBLE VEHICLES
                            ================================================== --}}

                            @if($is_self_stock)

                                <div class="col-md-12">

                                    <div class="sl-vehicle-card">

                                        <div class="sl-vehicle-title">

                                            Compatible Vehicles
                                            <span class="text-danger">*</span>

                                        </div>


                                        <div class="form-group mb-3">

                                            <input
                                                type="checkbox"
                                                wire:model.live="forAllVehicles"
                                                id="all_vehicles"
                                                class="form-check-input">

                                            <label
                                                for="all_vehicles"
                                                class="form-check-label fw-bold ms-1">

                                                For All Vehicles

                                            </label>

                                        </div>


                                        @if (!$forAllVehicles)

                                            {{-- Third Party Catalog --}}

                                            <div class="border-bottom pb-3 mb-3">

                                                @livewire('workshop.vehicle-selector')

                                            </div>


                                            {{-- Existing Vehicles --}}

                                            <div class="mb-3">

                                                <label class="form-label">

                                                    Or Select from Existing Saved Vehicles

                                                </label>

                                                <select
                                                    id="suitable_for"
                                                    class="form-select searchable-select"
                                                    multiple
                                                    data-placeholder="Select vehicle"
                                                    wire:model="suitable_for">

                                                    @foreach ($modifications as $modification)

                                                        <option
                                                            value="{{ $modification->id }}"
                                                            @if (
                                                                is_array($suitable_for) &&
                                                                in_array($modification->id, $suitable_for)
                                                            )
                                                                selected
                                                            @endif>

                                                            @php
                                                                $data = array_filter([
                                                                    $modification->brand_name ?? '',
                                                                    $modification->variant_name ?? '',
                                                                    $modification->year ?? '',
                                                                    $modification->title ?? '',
                                                                ]);
                                                            @endphp

                                                            {{ implode(' ', $data) }}

                                                        </option>

                                                    @endforeach

                                                </select>

                                                @error('suitable_for')
                                                    <span class="text-danger">
                                                        {{ $message }}
                                                    </span>
                                                @enderror

                                            </div>


                                            {{-- Selected Vehicles --}}

                                            <div>

                                                <label class="form-label">

                                                    Selected Compatible Vehicles
                                                    ({{ is_array($suitable_for) ? count($suitable_for) : 0 }})

                                                </label>

                                                <div class="sl-selected-list">

                                                    @if(empty($suitable_for))

                                                        <span class="text-muted small">
                                                            No vehicles selected yet.
                                                        </span>

                                                    @else

                                                        @foreach ($suitable_for as $index => $modId)

                                                            @php
                                                                $localMod = $modifications->firstWhere('id', $modId);
                                                            @endphp

                                                            @if ($localMod)

                                                                <span class="sl-vehicle-badge">

                                                                    {{ $localMod->brand_name }}
                                                                    {{ $localMod->variant_name }}
                                                                    ({{ $localMod->year }})
                                                                    -
                                                                    {{ $localMod->title }}

                                                                    <button
                                                                        type="button"
                                                                        class="btn-close btn-close-white"
                                                                        style="
                                                                            font-size:.55rem;
                                                                            padding:0;
                                                                            margin:0;
                                                                            width:.55rem;
                                                                            height:.55rem;
                                                                        "
                                                                        wire:click="removeCompatibleVehicle({{ $index }})">
                                                                    </button>

                                                                </span>

                                                            @endif

                                                        @endforeach

                                                    @endif

                                                </div>

                                            </div>

                                        @else

                                            <div class="mt-2">

                                                <label class="form-label">
                                                    Selected Vehicle
                                                </label>

                                                <br>

                                                <span class="sl-all-badge">
                                                    All
                                                </span>

                                            </div>

                                        @endif

                                    </div>

                                </div>

                            @endif

                        </div>

                    </div>


                    <div class="sl-modal-footer">

                        <button
                            type="button"
                            class="sl-secondary-btn"
                            wire:click="modalClose"
                            data-bs-dismiss="modal">

                            Cancel

                        </button>

                        <button
                            type="submit"
                            class="sl-primary-btn">

                            {{ $isAdd ? 'Submit' : 'Submit' }}

                            <i
                                class="spinner-border spinner-border-sm"
                                wire:loading>
                            </i>

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>


    {{-- ============================================================
        TABS
    ============================================================= --}}

    <div class="sl-tabs">

        <div class="sl-tabs-nav">

            <a
                class="sl-tab @if($activeTab == 'manual') active @endif"
                wire:click="setTab('manual')"
                href="javascript:;"
                role="tab">

                <div class="sl-tab-inner">

                    <i class="bx bx-plus-circle"></i>

                    <span>
                        Manual Inventory
                    </span>

                </div>

            </a>


            <a
                class="sl-tab @if($activeTab == 'third_party') active @endif"
                wire:click="setTab('third_party')"
                href="javascript:;"
                role="tab">

                <div class="sl-tab-inner">

                    <i class="bx bx-cloud-download"></i>

                    <span>
                        Online Stock
                    </span>

                </div>

            </a>

        </div>

    </div>


    {{-- ============================================================
        PAGE TITLE
    ============================================================= --}}

    <div class="sl-header">

        <div class="sl-header-body">

            <div>

                <h4 class="sl-title">

                    {{ $activeTab == 'manual'
                        ? 'Manual Inventory Management'
                        : 'Online Stock Management'
                    }}

                </h4>

                <p class="sl-subtitle">

                    {{ $activeTab == 'manual'
                        ? 'Manage your manually added workshop inventory.'
                        : 'Manage stock synchronized from online sources.'
                    }}

                </p>

            </div>


            <div>

                @if ($activeTab == 'manual' && $user->hasPermissionTo('purchasestock-add'))

                    <a
                        href="javascript:;"
                        wire:click="create(1)"
                        class="sl-primary-btn">

                        <i class="bx bxs-plus-square"></i>

                        Add New Stock

                    </a>

                @endif

            </div>

        </div>

    </div>


    {{-- ============================================================
        FILTERS
    ============================================================= --}}

    <div class="sl-filter-card">

        <div class="sl-filter-body">

            <div class="sl-filter-row">

                <div class="sl-search">

                    <i class="bx bx-search sl-search-icon"></i>

                    <input
                        type="text"
                        class="form-control"
                        style="padding-left:38px;"
                        placeholder="Search spare-part"
                        wire:model.live="search"
                        fdprocessedid="blgf5">

                </div>


                <div class="sl-category-filter">

                    <select
                        class="form-select"
                        wire:model.live="search_category">

                        <option value="" selected>
                            Select Category
                        </option>

                        <option value="1">
                            Accessory
                        </option>

                        <option value="2">
                            Part
                        </option>

                        <option value="3">
                            Tool
                        </option>

                        <option value="4">
                            Lubricant
                        </option>

                    </select>

                </div>


                <button
                    type="button"
                    class="sl-secondary-btn sl-clear"
                    wire:click="resetFilter"
                    fdprocessedid="orntg">

                    <i class="bx bx-reset"></i>

                    Clear

                </button>

            </div>

        </div>

    </div>


    {{-- ============================================================
        STOCK TABLE
    ============================================================= --}}

    <div class="sl-table-card">

        @if (!empty($items) && $items->count())

            <div class="sl-table-wrap">

                <table class="sl-table data-table">

                    <thead>

                        <tr>

                            <th>
                                S.No.
                            </th>

                            <th>
                                Spare Part
                            </th>

                            <th>
                                Category
                            </th>

                            <th>
                                Brand
                            </th>

                            <th>
                                HSN
                            </th>

                            <th>
                                Unit
                            </th>

                            <th>
                                Stock
                            </th>

                            <th>
                                Buy Price
                            </th>

                            <th>
                                Sell Price
                            </th>

                            <th>
                                Tax %
                            </th>

                            <th>
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach ($items as $index => $product_stock)

                            <tr>

                                <td class="sl-index">

                                    {{ $items->total() - ($items->firstItem() + $index) + 1 }}

                                </td>


                                <td class="sl-product">

                                    {{ $product_stock->label?->title }}

                                </td>


                                <td>

                                    <span class="sl-category-badge">

                                        @switch($product_stock->category_id)

                                            @case(1)
                                                Accessory
                                            @break

                                            @case(2)
                                                Parts
                                            @break

                                            @case(3)
                                                Tools
                                            @break

                                            @case(4)
                                                Lubricants
                                            @break

                                            @default
                                                -
                                        @endswitch

                                    </span>

                                </td>


                                <td class="sl-brand">

                                    {{ $product_stock->brand }}

                                </td>


                                <td class="sl-muted">

                                    {{ $product_stock->hsn_code ?? '-' }}

                                </td>


                                <td class="sl-muted">

                                    {{ $product_stock->unit?->title ?? '-' }}

                                </td>


                                <td class="sl-stock">

                                    {{ $product_stock->stock }}

                                </td>


                                <td class="sl-price">

                                    {{ number_format($product_stock->buy_price, 2) ?? 0 }}

                                </td>


                                <td class="sl-price">

                                    {{ number_format($product_stock->price, 2) }}

                                </td>


                                <td>

                                    <span class="sl-tax">

                                        {{ $product_stock->tax_percentage ?? 0 }}%

                                    </span>

                                    @if($product_stock->tax_type)

                                        <br>

                                        <small class="sl-tax-type">

                                            ({{ $product_stock->tax_type }})

                                        </small>

                                    @endif

                                </td>


                                <td>

                                    <div class="sl-actions">

                                        <button
                                            type="button"
                                            wire:click="edit({{ $product_stock->id }})"
                                            class="sl-action-btn sl-edit"
                                            title="Edit">

                                            <i class="bx bxs-edit"></i>

                                        </button>


                                        <button
                                            type="button"
                                            wire:click="confirmDeleteStock({{ $product_stock->id }})"
                                            class="sl-action-btn sl-delete"
                                            title="Delete">

                                            <i class="bx bxs-trash"></i>

                                        </button>

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>


            <div class="px-3 pb-3 pt-2">

                <div class="pagination-wrapper">

                    {{ $items->links() }}

                </div>

            </div>

        @else

            <div class="sl-empty">

                <div class="sl-empty-icon">

                    <i class="bx bx-package"></i>

                </div>

                <div class="sl-empty-title">

                    No Product Stock Found!

                </div>

                <div class="sl-empty-text">

                    Stock items matching your current filters will appear here.

                </div>

            </div>

        @endif

    </div>


    {{-- ============================================================
        EXISTING SCRIPT
    ============================================================= --}}

    @section('footerscript')

        <script>

            function validateMaxQuantity(input) {

                var maxQuantity = parseInt(
                    input.getAttribute('max')
                );

                if (parseInt(input.value) > maxQuantity) {

                    input.value = maxQuantity;

                }

            }

            window.addEventListener('set-stock-product-name', function(event) {
                let detail = event.detail;
                let labelId = (detail && typeof detail === 'object') ? (detail.id ?? (detail[0] ? detail[0].id : null)) : detail;
                if (labelId) {
                    setTimeout(function() {
                        let $select = $('#stock_product_name_select');
                        if ($select.length) {
                            $select.val(labelId).trigger('change');
                            if ($select.data('select2')) {
                                $select.trigger('change.select2');
                            }
                        }
                    }, 80);
                }
            });
        </script>

    @endsection

</div>