<div class="carnate-counter-sale-page">

    {{-- =========================================================
         CREATE CUSTOMER MODAL
    ========================================================== --}}
    <div class="modal @if ($showModal) show @endif"
        tabindex="-1"
        style="
            opacity:1;
            background-color:rgba(15,23,42,.55);
            display:@if ($showModal) block @endif;
            z-index:99999;
        ">

        <div class="modal-dialog modal-lg modal-fullscreen-sm-down">

            <div class="modal-content">

                <form wire:submit.prevent="{{ $add ? 'storeCustomer' : 'storeCustomer' }}">

                    <div class="modal-header cs-modal-header">

                        <div class="cs-modal-heading">

                            <div class="cs-modal-icon">
                                <i class="bx bx-user-plus"></i>
                            </div>

                            <div>
                                <h4 class="modal-title">
                                    Customer Details
                                </h4>

                                <p>
                                    Add customer information for this counter sale
                                </p>
                            </div>

                        </div>

                        <button
                            type="button"
                            class="cs-modal-close"
                            wire:click="$set('showModal', false)"
                            data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="bx bx-x"></i>
                        </button>

                    </div>


                    <div class="modal-body cs-modal-body">

                        @csrf

                        <div class="row g-3">

                            {{-- Name --}}
                            <div class="col-md-6">

                                <label class="form-label">
                                    Name <sup class="text-danger">*</sup>
                                </label>

                                <input
                                    type="text"
                                    wire:model="name"
                                    class="form-control"
                                    placeholder="Enter Name">

                                @error('name')
                                    <span class="text-danger error">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>


                            {{-- Email --}}
                            <div class="col-md-6">

                                <label class="form-label">
                                    Email <sup class="text-danger">*</sup>
                                </label>

                                <input
                                    type="email"
                                    wire:model="email"
                                    class="form-control"
                                    placeholder="Enter Email">

                                @error('email')
                                    <span class="text-danger error">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>


                            {{-- Mobile --}}
                            <div class="col-md-6">

                                <label class="form-label">
                                    Mobile Number <sup class="text-danger">*</sup>
                                </label>

                                <input
                                    type="text"
                                    wire:model="mobile_no"
                                    class="form-control"
                                    placeholder="Enter Mobile Number">

                                @error('mobile_no')
                                    <span class="text-danger error">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>


                            {{-- GST --}}
                            <div class="col-md-6">

                                <label class="form-label">
                                    GST Number
                                </label>

                                <input
                                    type="text"
                                    wire:model="gst_no"
                                    class="form-control"
                                    placeholder="Enter GST Number">

                            </div>


                            {{-- Address --}}
                            <div class="col-md-12">

                                <label class="form-label">
                                    Address <sup class="text-danger">*</sup>
                                </label>

                                <textarea
                                    wire:model="address"
                                    class="form-control"
                                    placeholder="Enter Address"></textarea>

                                @error('address')
                                    <span class="text-danger error">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>

                        </div>

                    </div>


                    <div class="modal-footer cs-modal-footer">

                        <button
                            type="button"
                            class="cs-btn cs-btn-light"
                            wire:click="$set('showModal', false)"
                            data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <button
                            type="submit"
                            class="cs-btn cs-btn-primary">

                            <i class="bx bx-check"></i>
                            Create

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


    {{-- =========================================================
         PAGE HEADER
    ========================================================== --}}
    <div class="cs-card cs-page-header">

        <div class="cs-page-header-body">

            <a
                href="{{ route('sparepart.countersale') }}"
                class="cs-back-link">

                <span class="cs-back-icon">
                    <i class="bx bx-arrow-back"></i>
                </span>

                <div>

                    <h1 class="cs-page-title">
                        Update Counter Sale
                    </h1>

                    <p class="cs-page-subtitle">
                        Review and update counter sale information
                    </p>

                </div>

            </a>

        </div>

    </div>


    @csrf


    {{-- =========================================================
         CUSTOMER + COUNTER SALE
    ========================================================== --}}
    <div class="row g-3">

        {{-- CUSTOMER --}}
        <div class="col-12 col-md-6">

            <div class="cs-card h-100">

                <div class="cs-card-body">

                    <div class="cs-section-title">

                        <span class="cs-section-icon">
                            <i class="bx bx-user"></i>
                        </span>

                        Customer

                    </div>

                    <p class="cs-section-description">
                        Search or select the customer for this sale
                    </p>

                    <hr class="cs-divider">


                    <label
                        for="customer_name"
                        class="form-label">
                        Customer Name
                    </label>


                    <div
                        class="cs-customer-select"
                        wire:ignore.self>

                        <select
                            id="customer_name"
                            wire:model="customer_name"
                            class="form-select select2"
                            data-property="customer_name"
                            @disabled($is_walkin_customer)>

                            <option value="">
                                -- Select Customer --
                            </option>

                            @foreach ($customers as $customer)

                                <option value="{{ $customer->id }}">
                                    {{ $customer->name . ' ' . $customer->lastname }}
                                </option>

                            @endforeach

                        </select>


                        <button
                            type="button"
                            class="cs-add-button"
                            wire:click="addCustomer"
                            @disabled($is_walkin_customer)
                            title="Add Customer">

                            <i class="bx bx-plus"></i>

                        </button>

                    </div>


                    {{-- WALK-IN --}}
                    <label class="cs-walkin">

                        <input
                            type="checkbox"
                            class="form-check-input"
                            id="is_walkin_customer"
                            wire:model.live="is_walkin_customer">

                        <span>
                            Walk-in Customer
                        </span>

                    </label>


                    @error('customer_name')

                        <div class="text-danger error mt-2">
                            {{ $message }}
                        </div>

                    @enderror


                    {{-- CUSTOMER INFORMATION --}}
                    @if (!empty($customer_data) && !$is_walkin_customer)

                        <div class="cs-customer-meta">

                            <div class="cs-customer-meta-row">

                                <span class="cs-meta-icon">
                                    <i class="bx bx-user"></i>
                                </span>

                                <span class="cs-meta-label">
                                    Customer
                                </span>

                                <strong>
                                    {{ @$customer_data->name }}
                                </strong>

                            </div>


                            <div class="cs-customer-meta-row">

                                <span class="cs-meta-icon">
                                    <i class="bx bx-phone"></i>
                                </span>

                                <span class="cs-meta-label">
                                    Mobile
                                </span>

                                <strong>
                                    {{ @$customer_data->mobile_no }}
                                </strong>

                            </div>


                            <div class="cs-customer-meta-row">

                                <span class="cs-meta-icon">
                                    <i class="bx bx-receipt"></i>
                                </span>

                                <span class="cs-meta-label">
                                    GST
                                </span>

                                <strong>
                                    {{ @$customer_data->gst_number }}
                                </strong>

                            </div>

                        </div>

                    @endif

                </div>

            </div>

        </div>


        {{-- COUNTER SALE DETAILS --}}
        <div class="col-12 col-md-6">

            <div class="cs-card h-100">

                <div class="cs-card-body">

                    <div class="cs-section-title">

                        <span class="cs-section-icon">
                            <i class="bx bx-receipt"></i>
                        </span>

                        Counter Sale Details

                    </div>

                    <p class="cs-section-description">
                        Sale number and transaction date
                    </p>

                    <hr class="cs-divider">


                    <div class="row g-3">

                        <div class="col-12 col-md-6">

                            <label class="form-label">
                                Counter Sale No.
                            </label>

                            <input
                                type="text"
                                id="countersale_number"
                                wire:model="countersale_number"
                                class="form-control"
                                readonly
                                placeholder="Job-Card Number"
                                aria-label="Job-Card Number">

                        </div>


                        <div class="col-12 col-md-6">

                            <label class="form-label">
                                Date
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                value="{{ now()->format('d-m-Y') }}"
                                readonly
                                placeholder="Date"
                                aria-label="Date">

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         SPARE & LUBE DETAILS
    ========================================================== --}}
    <div class="row g-3 mt-0">

        <div class="col-12 mt-3">

            <div class="cs-card">

                <div class="cs-card-body">

                    <div class="cs-section-title">

                        <span class="cs-section-icon">
                            <i class="bx bx-package"></i>
                        </span>

                        Spare & Lube Details

                    </div>

                    <p class="cs-section-description">
                        Review products, quantities, discounts and amounts
                    </p>

                    <hr class="cs-divider">


                    <div
                        class="table-view w-100"
                        id="spare-table"
                        style="display: {{ $showTable == 2 ? 'block' : 'none' }}">

                        <div class="cs-table-wrapper">

                            <table
                                class="cs-table"
                                id="spare-part-table">

                                <thead>

                                    <tr>
                                        <th class="col-particulars text-start">Particulars</th>
                                        <th class="col-qty text-center">Quantity</th>
                                        <th class="col-price text-end">Unit Price (Rs)</th>
                                        <th class="col-discount text-end">Discount</th>
                                        <th class="col-amount text-end">Amount</th>
                                        <th class="col-action text-center">Action</th>
                                    </tr>

                                </thead>


                                <tbody>

                                    @foreach ($spareParts as $index => $part)

                                        <tr>

                                            <td class="col-particulars">

                                                <input
                                                    type="text"
                                                    class="form-control text-start"
                                                    wire:model="spareParts.{{ $index }}.part_name"
                                                    placeholder="Part Name"
                                                    id="spareParts.{{ $index }}.part_name">

                                            </td>


                                            <td class="col-qty text-center">

                                                <input
                                                    type="number"
                                                    class="form-control text-center"
                                                    wire:model.lazy="spareParts.{{ $index }}.quantity"
                                                    id="spareParts.{{ $index }}.unit_price">

                                            </td>


                                            <td class="col-price text-end">

                                                <input
                                                    type="number"
                                                    class="form-control text-end"
                                                    wire:model.lazy="spareParts.{{ $index }}.unit_price">

                                            </td>


                                            <td class="col-discount text-end">

                                                <div class="cs-discount-group">

                                                    <input
                                                        type="number"
                                                        class="form-control text-end"
                                                        wire:model.lazy="spareParts.{{ $index }}.discount"
                                                        id="spareParts.{{ $index }}.discount"
                                                        step="1"
                                                        min="0"
                                                        placeholder="Discount">

                                                    <select
                                                        class="form-select text-center"
                                                        id="spareParts.{{ $index }}.discount_type"
                                                        wire:model.lazy="spareParts.{{ $index }}.discount_type">

                                                        <option value="1">₹</option>
                                                        <option value="2">%</option>

                                                    </select>

                                                </div>

                                            </td>


                                            <td class="col-amount text-end">

                                                <input
                                                    type="text"
                                                    class="form-control cs-final-input text-end"
                                                    wire:model="spareParts.{{ $index }}.final_amount"
                                                    id="spareParts.{{ $index }}.final_amount"
                                                    readonly>

                                            </td>


                                            <td class="col-action text-center">

                                                <button
                                                    type="button"
                                                    class="cs-remove-button"
                                                    wire:click="removeRow('spareParts', {{ $index }})"
                                                    id="{{ $index }}">

                                                    <i class="bx bx-trash me-1"></i>
                                                    Remove

                                                </button>

                                            </td>

                                        </tr>

                                    @endforeach

                                </tbody>


                                <tfoot>

                                    <tr>

                                        <td
                                            colspan="6"
                                            class="cs-select-row">

                                            <select
                                                id="spare_parts_data"
                                                wire:model.live="spare_parts_data"
                                                class="form-control select2"
                                                data-property="spare_parts_data">

                                                <option value="">
                                                    -- Select Spare Part --
                                                </option>

                                                @foreach ($spare as $item)

                                                    @php

                                                        $itemOfflinePrice = $item->selling_amount;

                                                        if (
                                                            $item->tax_type == 'exclude' &&
                                                            $item->tax_percentage
                                                        ) {
                                                            $itemOfflinePrice +=
                                                                ($itemOfflinePrice * $item->tax_percentage) / 100;
                                                        }

                                                    @endphp

                                                    <option value="{{ $item->id }}">

                                                        {{ $item->name ?? 'No Name' }}

                                                        <small>
                                                            (Current Qty:
                                                            {{ $item->stock ?? 0 }})
                                                        </small>,

                                                        <small class="text-danger">
                                                            (Price:
                                                            ₹{{ number_format($itemOfflinePrice, 2) }})
                                                        </small>

                                                    </option>

                                                @endforeach

                                            </select>

                                        </td>

                                    </tr>

                                </tfoot>

                            </table>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         NOTE + BILLING
    ========================================================== --}}
    <div class="row g-3 mt-0">

        {{-- NOTE + PRINT --}}
        <div class="col-12 col-md-6 mt-3">

            <div class="cs-card h-100">

                <div class="cs-card-body">

                    <div class="cs-section-title">

                        <span class="cs-section-icon">
                            <i class="bx bx-note"></i>
                        </span>

                        Note to Display on Invoice

                    </div>

                    <hr class="cs-divider">


                    <textarea
                        wire:model="note"
                        class="form-control"
                        placeholder=""></textarea>

                </div>


                <div class="cs-invoice-actions">

                    <a
                        href="{{ route('getCountersalesinvoPdf', [$counterSaleId, 1]) }}"
                        target="_blank"
                        class="cs-invoice-button"
                        title="Print Invoice">

                        <i class="bx bx-printer"></i>
                        Print

                    </a>


                    <a
                        href="{{ route('getCountersalesinvoPdf', [$counterSaleId, 0]) }}"
                        class="cs-invoice-button"
                        title="Open PDF">

                        <i class="bx bxs-file-pdf"></i>
                        PDF

                    </a>

                </div>

            </div>

        </div>


        {{-- BILLING --}}
        <div class="col-12 col-md-6 mt-3">

            <div class="cs-card h-100">

                <div class="cs-card-body">

                    <div class="cs-section-title">

                        <span class="cs-section-icon">
                            <i class="bx bx-wallet"></i>
                        </span>

                        Billing Details

                    </div>

                    <p class="cs-section-description">
                        Review payment and remaining balance
                    </p>

                    <hr class="cs-divider">


                    <div class="row g-3">

                        <div class="col-md-6">

                            <label
                                for="subtotal"
                                class="form-label">
                                Total Payable
                            </label>

                            <input
                                type="text"
                                id="subtotal"
                                wire:model="totalAmount"
                                class="form-control cs-total-input"
                                readonly>

                        </div>


                        <div class="col-md-6">

                            <label
                                for="final-amount"
                                class="form-label">
                                Subtotal
                            </label>

                            <input
                                type="text"
                                id="final-amount"
                                wire:model="final_amount"
                                class="form-control cs-final-input"
                                readonly>

                            @error('final_amount')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>

                    </div>


                    <div class="row g-3 mt-1">

                        <div class="col-md-6">

                            <label class="form-label">
                                Payment Type
                            </label>

                            <select
                                wire:model.live="payment_type"
                                class="form-select">

                                <option value="">
                                    -- Choose Payment Type --
                                </option>

                                <option value="total">
                                    Total
                                </option>

                                <option value="partial">
                                    Partial
                                </option>

                            </select>

                            @error('payment_type')
                                <span class="text-danger error">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>


                        @if ($payment_type === 'partial')

                            <div class="col-md-6">

                                <label class="form-label">
                                    Partial Amount
                                </label>

                                <input
                                    type="number"
                                    wire:model.live="partial_amount"
                                    class="form-control"
                                    min="0">

                            </div>

                        @elseif ($payment_type === 'total')

                            <div class="col-md-6">

                                <label class="form-label">
                                    Total Amount
                                </label>

                                <input
                                    type="number"
                                    wire:model.live="total_amount"
                                    readonly
                                    class="form-control"
                                    min="0">

                            </div>

                        @endif

                    </div>


                    <div class="row g-3 mt-1">

                        {{-- Original commented Paid field intentionally preserved --}}
                        {{-- <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Paid</label>
                                <input type="number"
                                    wire:model.live="total_paid_amount"
                                    class="form-control"
                                    readonly
                                    min="0"
                                    step="1">
                            </div>
                        </div> --}}

                        <div class="col-md-6">

                            <label class="form-label">
                                Remaining Balance
                            </label>

                            <input
                                type="text"
                                wire:model.live="balance_amount"
                                class="form-control cs-balance-input"
                                readonly>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         UPDATE ACTION
    ========================================================== --}}
    <div class="cs-create-footer">

        <button
            type="button"
            wire:click="updateCustomerCounter"
            class="cs-create-button">

            <i class="bx bx-save"></i>

            Update Counter Sale

        </button>

    </div>


    {{-- =========================================================
         STYLES
    ========================================================== --}}
    <style>

        .carnate-counter-sale-page {
            --cs-bg: #f7f8fa;
            --cs-white: #ffffff;
            --cs-text: #111827;
            --cs-muted: #64748b;
            --cs-border: #e2e8f0;
            --cs-border-light: #eef2f7;
            --cs-red: #e53935;
            --cs-red-dark: #c62828;
            --cs-red-soft: #fff5f5;
            --cs-icon-bg: #f1f5f9;
        }

        .carnate-counter-sale-page * {
            box-sizing: border-box;
        }

        /* =========================
           CARDS
        ========================== */

        .carnate-counter-sale-page .cs-card {
            background: var(--cs-white);
            border: 1px solid var(--cs-border);
            border-radius: 14px;
            box-shadow: 0 2px 10px rgba(15, 23, 42, .035);
            overflow: hidden;
        }

        .carnate-counter-sale-page .cs-card-body {
            padding: 20px;
        }

        /* =========================
           PAGE HEADER
        ========================== */

        .carnate-counter-sale-page .cs-page-header {
            margin-bottom: 18px;
        }

        .carnate-counter-sale-page .cs-page-header-body {
            min-height: 76px;
            padding: 15px 20px;
            display: flex;
            align-items: center;
        }

        .carnate-counter-sale-page .cs-back-link {
            display: inline-flex;
            align-items: center;
            gap: 11px;
            color: var(--cs-text);
            text-decoration: none;
        }

        .carnate-counter-sale-page .cs-back-icon {
            width: 40px;
            height: 40px;
            min-width: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #475569;
            background: #f8fafc;
            border: 1px solid var(--cs-border);
            border-radius: 9px;
            font-size: 18px;
            transition: .18s ease;
        }

        .carnate-counter-sale-page .cs-back-link:hover .cs-back-icon {
            color: var(--cs-red);
            background: var(--cs-red-soft);
            border-color: #fecaca;
        }

        .carnate-counter-sale-page .cs-page-title {
            margin: 0;
            color: var(--cs-text);
            font-size: 20px;
            font-weight: 750;
            letter-spacing: -.02em;
        }

        .carnate-counter-sale-page .cs-page-subtitle {
            margin: 4px 0 0;
            color: var(--cs-muted);
            font-size: 11px;
        }

        /* =========================
           SECTION
        ========================== */

        .carnate-counter-sale-page .cs-section-title {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 0;
            color: var(--cs-text);
            font-size: 14px;
            font-weight: 750;
        }

        .carnate-counter-sale-page .cs-section-icon {
            width: 34px;
            height: 34px;
            min-width: 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--cs-red);
            background: var(--cs-red-soft);
            border-radius: 9px;
            font-size: 18px;
        }

        .carnate-counter-sale-page .cs-section-description {
            margin: 4px 0 0 44px;
            color: var(--cs-muted);
            font-size: 11px;
        }

        .carnate-counter-sale-page .cs-divider {
            height: 1px;
            margin: 17px 0;
            background: var(--cs-border-light);
            border: 0;
        }

        /* =========================
           FORM
        ========================== */

        .carnate-counter-sale-page .form-label {
            margin-bottom: 6px;
            color: #475569;
            font-size: 12px;
            font-weight: 650;
        }

        .carnate-counter-sale-page .form-control,
        .carnate-counter-sale-page .form-select {
            min-height: 42px;
            color: var(--cs-text);
            background: #fff;
            border: 1px solid var(--cs-border);
            border-radius: 8px;
            font-size: 13px;
            box-shadow: none !important;
        }

        .carnate-counter-sale-page textarea.form-control {
            min-height: 105px;
            resize: vertical;
        }

        .carnate-counter-sale-page .form-control::placeholder {
            color: #94a3b8;
        }

        .carnate-counter-sale-page .form-control:focus,
        .carnate-counter-sale-page .form-select:focus {
            border-color: rgba(229, 57, 53, .45);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .07) !important;
        }

        .carnate-counter-sale-page .form-control.bg-light,
        .carnate-counter-sale-page input[readonly].form-control {
            background: #f8fafc !important;
            color: #475569 !important;
        }

        .carnate-counter-sale-page .text-danger.error,
        .carnate-counter-sale-page .text-danger {
            font-size: 11px;
            font-weight: 600;
        }

        /* =========================
           CUSTOMER
        ========================== */

        .carnate-counter-sale-page .cs-customer-select {
            display: flex;
            align-items: stretch;
            gap: 8px;
        }

        .carnate-counter-sale-page .cs-customer-select .select2-container {
            flex: 1;
            width: 100% !important;
        }

        .carnate-counter-sale-page .cs-add-button {
            width: 42px;
            min-width: 42px;
            height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--cs-red);
            background: var(--cs-red-soft);
            border: 1px solid #fecaca;
            border-radius: 8px;
            font-size: 19px;
            cursor: pointer;
            transition: .18s ease;
        }

        .carnate-counter-sale-page .cs-add-button:hover {
            color: #fff;
            background: var(--cs-red);
        }

        .carnate-counter-sale-page .cs-walkin {
            min-height: 40px;
            margin-top: 13px;
            padding: 9px 12px;
            display: flex;
            align-items: center;
            gap: 8px;
            background: #f8fafc;
            border: 1px solid var(--cs-border);
            border-radius: 8px;
            cursor: pointer;
        }

        .carnate-counter-sale-page .cs-walkin .form-check-input {
            width: 17px;
            height: 17px;
            margin: 0;
            cursor: pointer;
        }

        .carnate-counter-sale-page .cs-walkin span {
            color: #334155;
            font-size: 12px;
            font-weight: 650;
        }

        .carnate-counter-sale-page .cs-customer-meta {
            margin-top: 15px;
            padding: 12px 14px;
            background: #f8fafc;
            border: 1px solid var(--cs-border-light);
            border-radius: 9px;
        }

        .carnate-counter-sale-page .cs-customer-meta-row {
            min-height: 27px;
            display: flex;
            align-items: center;
            gap: 8px;
            color: #475569;
            font-size: 12px;
        }

        .carnate-counter-sale-page .cs-meta-icon {
            width: 22px;
            height: 22px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #94a3b8;
            background: #fff;
            border: 1px solid var(--cs-border-light);
            border-radius: 6px;
            font-size: 13px;
        }

        .carnate-counter-sale-page .cs-meta-label {
            min-width: 65px;
            color: #94a3b8;
        }

        .carnate-counter-sale-page .cs-customer-meta strong {
            color: #334155;
            font-weight: 650;
        }

        /* =========================
           TABLE
        ========================== */

        .carnate-counter-sale-page .cs-table-wrapper {
            width: 100%;
            margin-top: 17px;
            overflow-x: auto;
            border: 1px solid var(--cs-border);
            border-radius: 10px;
        }

        .carnate-counter-sale-page .cs-table {
            width: 100%;
            min-width: 850px;
            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
            table-layout: fixed;
        }

        .carnate-counter-sale-page .cs-table th.col-particulars { width: 38%; text-align: left !important; }
        .carnate-counter-sale-page .cs-table th.col-qty { width: 10%; text-align: center !important; }
        .carnate-counter-sale-page .cs-table th.col-price { width: 14%; text-align: right !important; }
        .carnate-counter-sale-page .cs-table th.col-discount { width: 16%; text-align: right !important; }
        .carnate-counter-sale-page .cs-table th.col-amount { width: 12%; text-align: right !important; }
        .carnate-counter-sale-page .cs-table th.col-action { width: 10%; text-align: center !important; }

        .carnate-counter-sale-page .cs-table td.col-particulars input { text-align: left !important; }
        .carnate-counter-sale-page .cs-table td.col-qty input { text-align: center !important; }
        .carnate-counter-sale-page .cs-table td.col-price input { text-align: right !important; }
        .carnate-counter-sale-page .cs-table td.col-discount input { text-align: right !important; }
        .carnate-counter-sale-page .cs-table td.col-amount input { text-align: right !important; }
        .carnate-counter-sale-page .cs-table td.col-action { text-align: center !important; }

        .carnate-counter-sale-page .cs-table thead th {
            padding: 12px;
            color: #64748b;
            background: #f8fafc;
            border-bottom: 1px solid var(--cs-border);
            font-size: 10px;
            font-weight: 750;
            letter-spacing: .04em;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .carnate-counter-sale-page .cs-table tbody td {
            padding: 10px;
            background: #fff;
            border-bottom: 1px solid var(--cs-border-light);
            vertical-align: middle;
        }

        .carnate-counter-sale-page .cs-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .carnate-counter-sale-page .cs-table tbody tr:hover td {
            background: #fffafa;
        }

        .carnate-counter-sale-page .cs-table .form-control,
        .carnate-counter-sale-page .cs-table .form-select {
            min-height: 38px;
            font-size: 12px;
        }

        .carnate-counter-sale-page .cs-discount-group {
            display: flex;
            min-width: 145px;
        }

        .carnate-counter-sale-page .cs-discount-group .form-control {
            border-radius: 8px 0 0 8px;
        }

        .carnate-counter-sale-page .cs-discount-group .form-select {
            width: 54px !important;
            min-width: 54px !important;
            padding: 0 7px;
            border-left: 0 !important;
            border-radius: 0 8px 8px 0;
        }

        .carnate-counter-sale-page .cs-select-row {
            padding: 12px !important;
            background: #fafbfc !important;
        }

        .carnate-counter-sale-page .cs-remove-button {
            min-height: 36px;
            padding: 7px 10px;
            color: #dc2626;
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 7px;
            font-size: 11px;
            font-weight: 650;
            white-space: nowrap;
            cursor: pointer;
        }

        .carnate-counter-sale-page .cs-remove-button:hover {
            background: #fee2e2;
        }

        .carnate-counter-sale-page .cs-final-input {
            color: var(--cs-red) !important;
            background: var(--cs-red-soft) !important;
            border-color: #fecaca !important;
            font-weight: 650;
        }

        /* =========================
           SELECT2
        ========================== */

        .carnate-counter-sale-page .select2-container--default {
            width: 100% !important;
        }

        .carnate-counter-sale-page .select2-container--default .select2-selection--single {
            height: 42px;
            display: flex;
            align-items: center;
            border: 1px solid var(--cs-border);
            border-radius: 8px;
        }

        .carnate-counter-sale-page .select2-container--default .select2-selection--single .select2-selection__rendered {
            padding-left: 12px;
            color: var(--cs-text);
            line-height: 40px;
            font-size: 13px;
        }

        .carnate-counter-sale-page .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 40px;
        }

        /* =========================
           INVOICE ACTIONS
        ========================== */

        .carnate-counter-sale-page .cs-invoice-actions {
            display: flex;
            gap: 8px;
            padding: 13px 20px;
            background: #fafbfc;
            border-top: 1px solid var(--cs-border);
        }

        .carnate-counter-sale-page .cs-invoice-button {
            min-height: 36px;
            padding: 7px 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            color: #475569;
            background: #fff;
            border: 1px solid var(--cs-border);
            border-radius: 8px;
            font-size: 11px;
            font-weight: 650;
            text-decoration: none;
            transition: .18s ease;
        }

        .carnate-counter-sale-page .cs-invoice-button:hover {
            color: var(--cs-red);
            background: var(--cs-red-soft);
            border-color: #fecaca;
        }

        /* =========================
           BILLING
        ========================== */

        .carnate-counter-sale-page .cs-total-input {
            color: #334155 !important;
            background: #f8fafc !important;
            font-weight: 650;
        }

        .carnate-counter-sale-page .cs-final-input {
            color: var(--cs-red) !important;
            background: var(--cs-red-soft) !important;
            font-weight: 700;
        }

        .carnate-counter-sale-page .cs-balance-input {
            color: #92400e !important;
            background: #fffbeb !important;
            border-color: #fde68a !important;
            font-weight: 700;
        }

        /* =========================
           UPDATE BUTTON
        ========================== */

        .carnate-counter-sale-page .cs-create-footer {
            margin-top: 20px;
            padding: 5px 0 15px;
            display: flex;
            justify-content: flex-end;
        }

        .carnate-counter-sale-page .cs-create-button {
            min-height: 45px;
            padding: 10px 19px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            color: #fff;
            background: var(--cs-red);
            border: 0;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 700;
            box-shadow: 0 5px 16px rgba(229, 57, 53, .15);
            cursor: pointer;
            transition: .18s ease;
        }

        .carnate-counter-sale-page .cs-create-button:hover {
            color: #fff;
            background: var(--cs-red-dark);
            transform: translateY(-1px);
        }

        /* =========================
           MODAL
        ========================== */

        .carnate-counter-sale-page .modal {
            z-index: 99999 !important;
        }

        .carnate-counter-sale-page .modal-dialog {
            margin-top: 30px;
            margin-bottom: 30px;
        }

        .carnate-counter-sale-page .modal-content {
            border: 0 !important;
            border-radius: 15px !important;
            overflow: hidden;
            box-shadow: 0 25px 70px rgba(15, 23, 42, .24);
        }

        .carnate-counter-sale-page .cs-modal-header {
            padding: 16px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #fff;
            border-bottom: 1px solid var(--cs-border);
        }

        .carnate-counter-sale-page .cs-modal-heading {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .carnate-counter-sale-page .cs-modal-icon {
            width: 38px;
            height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--cs-red);
            background: var(--cs-red-soft);
            border-radius: 9px;
            font-size: 18px;
        }

        .carnate-counter-sale-page .cs-modal-heading h4 {
            margin: 0 0 2px;
            color: var(--cs-text);
            font-size: 16px;
            font-weight: 750;
        }

        .carnate-counter-sale-page .cs-modal-heading p {
            margin: 0;
            color: var(--cs-muted);
            font-size: 10px;
        }

        .carnate-counter-sale-page .cs-modal-close {
            width: 34px;
            height: 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            background: #fff;
            border: 1px solid var(--cs-border);
            border-radius: 8px;
            font-size: 19px;
            cursor: pointer;
        }

        .carnate-counter-sale-page .cs-modal-close:hover {
            color: var(--cs-red);
            background: var(--cs-red-soft);
            border-color: #fecaca;
        }

        .carnate-counter-sale-page .cs-modal-body {
            padding: 20px;
        }

        .carnate-counter-sale-page .cs-modal-footer {
            padding: 13px 20px;
            background: #fafbfc;
            border-top: 1px solid var(--cs-border);
            display: flex;
            justify-content: flex-end;
            gap: 8px;
        }

        .carnate-counter-sale-page .cs-btn {
            min-height: 40px;
            padding: 8px 15px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 650;
            cursor: pointer;
        }

        .carnate-counter-sale-page .cs-btn-light {
            color: #475569;
            background: #f1f5f9;
            border: 1px solid var(--cs-border);
        }

        .carnate-counter-sale-page .cs-btn-light:hover {
            background: #e2e8f0;
        }

        .carnate-counter-sale-page .cs-btn-primary {
            color: #fff;
            background: var(--cs-red);
            border: 1px solid var(--cs-red);
        }

        .carnate-counter-sale-page .cs-btn-primary:hover {
            color: #fff;
            background: var(--cs-red-dark);
            border-color: var(--cs-red-dark);
        }

        /* =========================
           RESPONSIVE
        ========================== */

        @media (max-width: 767px) {

            .carnate-counter-sale-page .cs-page-header-body {
                padding: 14px;
            }

            .carnate-counter-sale-page .cs-page-title {
                font-size: 18px;
            }

            .carnate-counter-sale-page .cs-page-subtitle {
                display: none;
            }

            .carnate-counter-sale-page .cs-card-body {
                padding: 16px;
            }

            .carnate-counter-sale-page .cs-table {
                min-width: 850px;
            }

            .carnate-counter-sale-page .cs-create-footer {
                justify-content: stretch;
            }

            .carnate-counter-sale-page .cs-create-button {
                width: 100%;
            }

            .carnate-counter-sale-page .cs-modal-body {
                padding: 17px;
            }

            .carnate-counter-sale-page .cs-modal-header,
            .carnate-counter-sale-page .cs-modal-footer {
                padding: 14px 17px;
            }

            .carnate-counter-sale-page .modal-dialog {
                margin: 0;
            }

            .carnate-counter-sale-page .modal-content {
                border-radius: 0 !important;
            }

            .carnate-counter-sale-page .cs-invoice-actions {
                padding: 12px 16px;
            }

        }

    </style>

</div>


@section('footerscript')

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <script>

        document.addEventListener('livewire:init', () => {

            /* =====================================================
               SPARE PART SELECT2
            ====================================================== */

            function initSparePartsSelect() {

                const $select = $('#spare_parts_data');

                if (!$select.length) {
                    return;
                }

                if ($select.hasClass('select2-hidden-accessible')) {
                    $select.select2('destroy');
                }

                $select.select2({
                    placeholder: "Select Spare Part"
                }).off('change.carnate').on('change.carnate', function() {

                    let selectedValue = $(this).val();

                    @this.set('spare_parts_data', selectedValue);

                });

            }


            /* =====================================================
               CUSTOMER SELECT2
            ====================================================== */

            function initCustomerSelect() {

                const $select = $('#customer_name');

                if (!$select.length) {
                    return;
                }

                if ($select.hasClass('select2-hidden-accessible')) {
                    $select.select2('destroy');
                }

                $select.select2({
                    placeholder: "Select Customer or Vehicle",
                    width: '100%',

                    ajax: {

                        url: '/workshop/countercustomers',

                        dataType: 'json',

                        delay: 250,

                        data: function(params) {

                            return {
                                search: params.term,
                                page: params.page || 1,
                            };

                        },

                        processResults: function(data, params) {

                            console.log(data);

                            params.page = params.page || 1;

                            const results = Array.isArray(data.data)
                                ? data.data.map(item => ({
                                    id: item.id,
                                    text: `${item.name || ''} ${item.lastname || ''}/${item.mobile_no || ''}/${item.number_plate || ''}`,
                                }))
                                : [];

                            return {

                                results: results,

                                pagination: {
                                    more: data.next_page_url != null
                                }

                            };

                        },

                        cache: true,

                    }

                }).off('change.carnate').on('change.carnate', function() {

                    let selectedValue = $(this).val();

                    console.log('Selected Value:', selectedValue);

                    @this.set('customer_name', selectedValue);

                });

            }


            /* =====================================================
               INITIALIZE
            ====================================================== */

            initSparePartsSelect();
            initCustomerSelect();


            /* =====================================================
               LIVEWIRE MORPH
            ====================================================== */

            Livewire.hook('morphed', () => {

                initSparePartsSelect();
                initCustomerSelect();

            });


            /* =====================================================
               SET CUSTOMER SELECT2 FROM LIVEWIRE
            ====================================================== */

            window.addEventListener('set-customer-select2', event => {

                let data = event.detail[0] || event.detail;

                let newOption = new Option(
                    data.text,
                    data.id,
                    true,
                    true
                );

                $('#customer_name')
                    .append(newOption)
                    .trigger('change');

            });

        });

    </script>

@endsection