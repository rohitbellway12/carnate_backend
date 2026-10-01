<div class="carnate-order-page">
    <style>
        /* =========================================================
           CARNATE - WORKSHOP ORDER PAGE
           UI REDESIGN ONLY
           Livewire methods / variables / routes preserved
        ========================================================= */

    .carnate-order-page {
        --carnate-bg: #f7f8fa;
        --carnate-card: #ffffff;
        --carnate-text: #111827;
        --carnate-muted: #64748b;
        --carnate-border: #e2e8f0;
        --carnate-red: #e53935;
        --carnate-red-dark: #d32f2f;
        --carnate-red-soft: #fff5f5;
        --carnate-green: #16a34a;
        --carnate-green-soft: #f0fdf4;
        --carnate-yellow: #d97706;
        --carnate-yellow-soft: #fffbeb;
        --carnate-blue: #2563eb;
        --carnate-blue-soft: #eff6ff;
        --carnate-info: #0891b2;
        --carnate-info-soft: #ecfeff;
    }

    .carnate-order-page {
        color: var(--carnate-text);
    }

    /* =========================================================
       COMMON CARDS
    ========================================================= */

    .carnate-order-page .card {
        border: 1px solid var(--carnate-border);
        border-radius: 16px;
        background: var(--carnate-card);
        box-shadow: 0 3px 14px rgba(15, 23, 42, 0.045);
        overflow: hidden;
    }

    .carnate-order-page .card.mt-4 {
        margin-top: 18px !important;
    }

    .carnate-order-page .card-body {
        padding: 20px;
    }

    .carnate-order-page .breadcrumb-title {
        border: 0 !important;
        color: var(--carnate-text);
        font-size: 18px;
        font-weight: 700;
        padding-left: 0 !important;
    }

    /* =========================================================
       TABLE
    ========================================================= */

    .carnate-order-page .data-table {
        width: 100%;
        margin: 0;
        border-collapse: separate;
        border-spacing: 0;
        min-width: 1050px;
    }

    .carnate-order-page .data-table thead th {
        padding: 13px 12px;
        background: #f8fafc;
        color: #475569;
        border: 0;
        border-bottom: 1px solid var(--carnate-border);
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .45px;
        text-transform: uppercase;
        white-space: nowrap;
        vertical-align: middle;
    }

    .carnate-order-page .data-table thead th:first-child {
        border-top-left-radius: 12px;
    }

    .carnate-order-page .data-table thead th:last-child {
        border-top-right-radius: 12px;
    }

    .carnate-order-page .data-table tbody td {
        padding: 13px 12px;
        color: #334155;
        border: 0;
        border-bottom: 1px solid #eef2f7;
        font-size: 13px;
        font-weight: 500;
        vertical-align: middle;
        background: #ffffff;
    }

    .carnate-order-page .data-table tbody tr {
        transition: background-color .18s ease;
    }

    .carnate-order-page .data-table tbody tr:hover td {
        background: #fafafa;
    }

    .carnate-order-page .data-table tbody tr:last-child td {
        border-bottom: 0;
    }

    /* =========================================================
       ORDER ITEM IMAGE
    ========================================================= */

    .carnate-order-page .order-item-image {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        border: 1px solid var(--carnate-border);
        background: #f8fafc;
        object-fit: contain;
        padding: 4px;
        vertical-align: middle;
        margin-right: 8px;
        transition: all .2s ease;
    }

    .carnate-order-page .order-item-image:hover {
        border-color: #cbd5e1;
        transform: scale(1.04);
    }

    .carnate-order-page .order-item-link {
        text-decoration: none;
        cursor: pointer;
    }

    .carnate-order-page .order-item-name {
        color: var(--carnate-text);
        font-weight: 600;
    }

    /* =========================================================
       BADGES
    ========================================================= */

    .carnate-order-page .badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 25px;
        padding: 5px 9px;
        border-radius: 7px;
        font-size: 10px;
        line-height: 1.2;
        font-weight: 700;
        white-space: normal;
        text-align: center;
    }

    .carnate-order-page .bg-warning {
        background: var(--carnate-yellow-soft) !important;
        color: var(--carnate-yellow) !important;
        border: 1px solid #fde68a;
    }

    .carnate-order-page .bg-success {
        background: var(--carnate-green-soft) !important;
        color: var(--carnate-green) !important;
        border: 1px solid #bbf7d0;
    }

    .carnate-order-page .bg-danger {
        background: var(--carnate-red-soft) !important;
        color: var(--carnate-red) !important;
        border: 1px solid #fecaca;
    }

    .carnate-order-page .bg-primary {
        background: var(--carnate-blue-soft) !important;
        color: var(--carnate-blue) !important;
        border: 1px solid #bfdbfe;
    }

    .carnate-order-page .bg-info {
        background: var(--carnate-info-soft) !important;
        color: var(--carnate-info) !important;
        border: 1px solid #a5f3fc;
    }

    /* =========================================================
       BUTTONS
    ========================================================= */

    .carnate-order-page .btn {
        min-height: 38px;
        padding: 8px 14px;
        border-radius: 9px;
        font-size: 12px;
        font-weight: 600;
        box-shadow: none;
        transition: all .2s ease;
    }

    .carnate-order-page .btn-primary {
        background: var(--carnate-red);
        border-color: var(--carnate-red);
        color: #ffffff;
    }

    .carnate-order-page .btn-primary:hover,
    .carnate-order-page .btn-primary:focus {
        background: var(--carnate-red-dark);
        border-color: var(--carnate-red-dark);
        color: #ffffff;
        transform: translateY(-1px);
        box-shadow: 0 5px 14px rgba(229, 57, 53, .16);
    }

    .carnate-order-page .btn-danger {
        background: var(--carnate-red);
        border-color: var(--carnate-red);
        color: #fff;
    }

    .carnate-order-page .btn-success {
        background: var(--carnate-green);
        border-color: var(--carnate-green);
        color: #fff;
    }

    .carnate-order-page .btn-secondary {
        background: #f1f5f9;
        border-color: #e2e8f0;
        color: #475569;
    }

    .carnate-order-page .btn-secondary:hover {
        background: #e2e8f0;
        color: #334155;
    }

    /* =========================================================
       FORMS / FILTERS
    ========================================================= */

    .carnate-order-page .form-control {
        min-height: 42px;
        border: 1px solid var(--carnate-border);
        border-radius: 9px;
        background: #ffffff;
        color: var(--carnate-text);
        font-size: 13px;
        font-weight: 500;
        box-shadow: none;
        transition: all .2s ease;
    }

    .carnate-order-page .form-control:focus {
        border-color: rgba(229, 57, 53, .55);
        box-shadow: 0 0 0 3px rgba(229, 57, 53, .08);
        outline: none;
    }

    .carnate-order-page textarea.form-control {
        min-height: 110px;
        resize: vertical;
    }

    .carnate-order-page .filter-card {
        background: #ffffff;
    }

    .carnate-order-page .filter-row {
        align-items: center;
    }

    .carnate-order-page .filter-clear {
        background: #f1f5f9 !important;
        border-color: #e2e8f0 !important;
        color: #475569 !important;
    }

    .carnate-order-page .filter-clear:hover {
        background: #e2e8f0 !important;
        color: #334155 !important;
    }

    /* =========================================================
       MODALS
    ========================================================= */

    .carnate-order-page .modal-content {
        border: 0;
        border-radius: 16px;
        background: #ffffff;
        box-shadow: 0 24px 70px rgba(15, 23, 42, .20);
        overflow: hidden;
    }

    .carnate-order-page .modal-header {
        padding: 18px 22px;
        border-bottom: 1px solid var(--carnate-border);
        background: #ffffff;
    }

    .carnate-order-page .modal-title {
        margin: 0;
        color: var(--carnate-text);
        font-size: 18px;
        font-weight: 700;
    }

    .carnate-order-page .modal-body {
        padding: 20px 22px !important;
    }

    .carnate-order-page .modal-footer {
        padding: 14px 22px;
        border-top: 1px solid var(--carnate-border);
        background: #fafafa;
    }

    .carnate-order-page .btn-close {
        width: 34px;
        height: 34px;
        margin: 0;
        padding: 0;
        border-radius: 9px;
        background-color: #f1f5f9;
        background-size: 11px;
        opacity: 1;
    }

    .carnate-order-page .btn-close:hover {
        background-color: var(--carnate-red-soft);
    }

    .carnate-order-page .form-label {
        color: #334155;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 7px;
    }

    /* =========================================================
       IMAGE MODAL
    ========================================================= */

    .carnate-order-page .image-modal .modal-dialog {
        max-width: 650px;
    }

    .carnate-order-page .order-preview-image {
        width: 100%;
        max-height: 70vh;
        object-fit: contain;
        border-radius: 12px;
        background: #f8fafc;
        padding: 12px;
    }

    /* =========================================================
       SEARCH / ORDER LIST
    ========================================================= */

    .carnate-order-page .order-list-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
    }

    .carnate-order-page .search-control {
        max-width: 330px;
    }

    .carnate-order-page .date-control {
        max-width: 260px;
    }

    .carnate-order-page .order-number {
        color: var(--carnate-text);
        font-weight: 700;
    }

    .carnate-order-page .amount-value {
        color: var(--carnate-text);
        font-weight: 700;
        white-space: nowrap;
    }

    /* =========================================================
       PAGINATION
    ========================================================= */

    .carnate-order-page .pagination-wrapper {
        margin-top: 18px;
    }

    .carnate-order-page .pagination {
        margin-bottom: 0;
        gap: 4px;
    }

    .carnate-order-page .page-link {
        border: 1px solid var(--carnate-border);
        border-radius: 7px !important;
        color: #475569;
        font-size: 12px;
    }

    .carnate-order-page .page-item.active .page-link {
        background: var(--carnate-red);
        border-color: var(--carnate-red);
        color: #ffffff;
    }

    /* =========================================================
       EMPTY STATE
    ========================================================= */

    .carnate-order-page .empty-state {
        margin: 0;
        padding: 24px;
        border: 1px solid var(--carnate-border);
        border-radius: 12px;
        background: #f8fafc;
        color: var(--carnate-muted);
        text-align: center;
        font-size: 13px;
        font-weight: 500;
    }

    /* =========================================================
       CHECKBOX
    ========================================================= */

    .carnate-order-page .form-check-input {
        width: 18px;
        height: 18px;
        border: 1px solid #cbd5e1;
        cursor: pointer;
    }

    .carnate-order-page .form-check-input:checked {
        background-color: var(--carnate-red);
        border-color: var(--carnate-red);
    }

    /* =========================================================
       SPINNER
    ========================================================= */

    .carnate-order-page .spinner-border {
        width: 14px;
        height: 14px;
        margin-left: 5px;
        border-width: 2px;
        vertical-align: -2px;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 991px) {
        .carnate-order-page .order-list-header {
            flex-direction: column;
            align-items: stretch;
        }

        .carnate-order-page .search-control,
        .carnate-order-page .date-control {
            max-width: none;
            width: 100%;
        }

        .carnate-order-page .data-table {
            min-width: 1000px;
        }
    }

    @media (max-width: 767px) {
        .carnate-order-page .card-body {
            padding: 15px;
        }

        .carnate-order-page .data-table {
            min-width: 950px;
        }

        .carnate-order-page .modal-dialog {
            margin: 10px;
        }

        .carnate-order-page .modal-header,
        .carnate-order-page .modal-body,
        .carnate-order-page .modal-footer {
            padding-left: 15px !important;
            padding-right: 15px !important;
        }
    }
</style>

    {{-- =========================================================
         IMAGE MODAL
    ========================================================== --}}

    <div class="modal image-modal @if ($shoImageModel) show @endif"
        tabindex="-1"
        style="opacity:1; background-color:#0606068c; display:@if ($shoImageModel) block @endif">

        <div class="modal-dialog modal-s modal-dialog-centered">

            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Image</h4>

                    <button type="button"
                        class="btn-close"
                        wire:click="clodeImageModel"
                        data-bs-dismiss="modal"
                        aria-label="Close">
                    </button>
                </div>

                <div class="modal-body">

                    <div class="row g-3">

                        <div class="col-md-12">

                            @if (!empty($imageitem))

                                @if (!empty($imageitem->SpareParts->Image->file))

                                    <img src="{{ asset($imageitem->SpareParts->Image->file) }}"
                                        alt="Maintenance Service Parts"
                                        class="order-preview-image">

                                @else

                                    @php
                                        $spareType = $imageitem->SpareParts?->spare_part_type ?? 0;
                                    @endphp

                                    @if ($spareType == 1)

                                        <img src="{{ asset('img/accessory.png') }}"
                                            alt="Maintenance Service Parts"
                                            class="order-preview-image">

                                    @elseif($spareType == 2)

                                        <img src="{{ asset('img/spareparts.jpg') }}"
                                            alt="Maintenance Service Parts"
                                            class="order-preview-image">

                                    @elseif($spareType == 3)

                                        <img src="{{ asset('img/tools.jpg') }}"
                                            alt="Maintenance Service Parts"
                                            class="order-preview-image">

                                    @else

                                        <img src="{{ asset('img/lubricant.jpg') }}"
                                            alt="Maintenance Service Parts"
                                            class="order-preview-image">

                                    @endif

                                @endif

                            @endif

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         REASON MODAL
    ========================================================== --}}

    <div class="modal @if ($showReasonModel) show @endif"
        tabindex="-1"
        style="opacity:1; background-color:#0606068c; display:@if ($showReasonModel) block @endif">

        <div class="modal-dialog modal-xl modal-dialog-centered">

            <div class="modal-content">

                <form wire:submit.prevent="declinereasonStore">

                    <div class="modal-header">

                        <h4 class="modal-title">
                            {{ $statusReason }} Reason
                        </h4>

                        <button type="button"
                            class="btn-close"
                            wire:click="clodeReasonModel"
                            data-bs-dismiss="modal"
                            aria-label="Close">
                        </button>

                    </div>

                    <div class="modal-body">

                        @csrf

                        <div class="row g-3">

                            <div class="col-md-12">

                                <label class="form-label">
                                    {{ $statusReason }} Reason
                                    <sup class="text-danger">*</sup>
                                </label>

                                <textarea wire:model="decline_reason"
                                    class="form-control"
                                    rows="4"
                                    placeholder="Enter Reason"></textarea>

                                @error('decline_reason')
                                    <span class="text-danger error">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>

                        </div>

                    </div>

                    @if (empty($decline_reason))

                        <div class="modal-footer">

                            <button type="button"
                                class="btn btn-secondary"
                                wire:click="clodeReasonModel"
                                data-bs-dismiss="modal">
                                Cancel
                            </button>

                            <button type="submit"
                                class="btn btn-primary">

                                Create

                                <i class="spinner-border spinner-border-sm"
                                    wire:loading>
                                </i>

                            </button>

                        </div>

                    @endif

                </form>

            </div>

        </div>

    </div>


    @if ($showOrderItem)

        {{-- =====================================================
             ORDER ITEM HEADER
        ====================================================== --}}

        <div class="card">

            <div class="card-body d-flex justify-content-between align-items-center">

                <div class="breadcrumb-title">
                    Order Item
                </div>

                <div>
                    <button type="button"
                        wire:click="back"
                        class="btn btn-primary">

                        <i class="bx bx-back"></i>
                        Back

                    </button>
                </div>

            </div>

        </div>


        {{-- =====================================================
             ORDER ITEMS
        ====================================================== --}}

        <div class="card mt-4">

            @if (!empty($orders) && !empty($orders->orderItem) && count($orders->orderItem))

                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table data-table">

                            <thead>

                                <tr>
                                    <th>S.No.</th>
                                    <th>Spare Part</th>
                                    <th>Category</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>GST Rate</th>
                                    <th>GST Amount</th>
                                    <th>Total Amount</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>

                            </thead>

                            <tbody>

                                @php
                                    $visible = false;
                                    $totalTax = 0;
                                    $taxableAmount = 0;
                                @endphp

                                @foreach ($orders->orderItem as $index => $order_item)

                                    <tr>

                                        <td>
                                            {{ $loop->iteration }}
                                        </td>

                                        <td>

                                            <a href="javascript:void(0);"
                                                wire:click="shoImage({{ $order_item->id }})"
                                                class="order-item-link">

                                                @if (!empty($order_item->SpareParts->Image->file))

                                                    <img src="{{ asset($order_item->SpareParts->Image->file) }}"
                                                        alt="Maintenance Service Parts"
                                                        class="order-item-image">

                                                @else

                                                    @php
                                                        $spareType = $order_item->SpareParts?->spare_part_type ?? 0;
                                                    @endphp

                                                    @if ($spareType == 1)

                                                        <img src="{{ asset('img/accessory.png') }}"
                                                            alt="Maintenance Service Parts"
                                                            class="order-item-image">

                                                    @elseif($spareType == 2)

                                                        <img src="{{ asset('img/spareparts.jpg') }}"
                                                            alt="Maintenance Service Parts"
                                                            class="order-item-image">

                                                    @elseif($spareType == 3)

                                                        <img src="{{ asset('img/tools.jpg') }}"
                                                            alt="Maintenance Service Parts"
                                                            class="order-item-image">

                                                    @else

                                                        <img src="{{ asset('img/lubricant.jpg') }}"
                                                            alt="Maintenance Service Parts"
                                                            class="order-item-image">

                                                    @endif

                                                @endif

                                            </a>

                                            <span class="order-item-name">
                                                {{ $order_item?->SpareParts?->name ?? '-' }}
                                            </span>

                                        </td>

                                        <td>

                                            @switch($order_item->category)

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
                                            @endswitch

                                        </td>

                                        <td>
                                            {{ $order_item->quantity }}
                                        </td>

                                        @php

                                            $tax_type = $order_item->SpareParts?->tax_type ?? 'include';

                                            $tax_percentage = (float)($order_item->SpareParts?->tax_percentage ?? 0);

                                            $total_amount = (float)$order_item->total_amount;

                                            if ($tax_type === 'include') {

                                                $taxableVal = $total_amount / (1 + ($tax_percentage / 100));

                                                $gstVal = $total_amount - $taxableVal;

                                                $payableVal = $total_amount;

                                            } else {

                                                $taxableVal = $total_amount;

                                                $gstVal = $total_amount * ($tax_percentage / 100);

                                                $payableVal = $total_amount + $gstVal;

                                            }

                                        @endphp

                                        <td>
                                            ₹ {{ number_format($taxableVal, 2) }}
                                        </td>

                                        <td>

                                            {{ $order_item->SpareParts?->tax_percentage ?? 0 }}%

                                            <br>

                                            <small class="text-muted">
                                                ({{ ucfirst($order_item->SpareParts?->tax_type ?? 'include') }})
                                            </small>

                                        </td>

                                        <td>
                                            ₹ {{ number_format($gstVal, 2) }}
                                        </td>

                                        <td>

                                            <span class="amount-value">
                                                ₹ {{ number_format($payableVal, 2) }}
                                            </span>

                                        </td>

                                        <td>

                                            @if ($order_item->status == 0)

                                                <p class="badge bg-warning"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    title="Awaiting acceptance/rejection from Spare Part Vendor">
                                                    Pending
                                                </p>

                                            @elseif($order_item->status == 1)

                                                @if ($order_item->payment_status == 0)

                                                    <p class="badge bg-warning"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="Item accepted by Spare Part Vendor; awaiting your payment">
                                                        Awaiting Payment
                                                    </p>

                                                @else

                                                    <p class="badge bg-success"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="Item accepted by Spare Part Vendor; awaiting Handover">
                                                        Accepted
                                                    </p>

                                                @endif

                                            @elseif($order_item->status == 2)

                                                <p class="badge bg-danger"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    title="Order declined by Spare Part Vendor. Reason: {{ $order_item->reason }}">
                                                    Declined
                                                </p>

                                                <a class="badge bg-danger badge-sm text-white"
                                                    href="javascript:void(0);"
                                                    wire:click="showdeclineorder({{ $order_item->id }},2)"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    title="Order declined by Spare Part Vendor. Reason: {{ $order_item->reason }}">
                                                    Delayed Reason
                                                </a>

                                            @elseif($order_item->status == 3)

                                                <p class="badge bg-success"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    title="Items handed over by Spare Part Vendor; awaiting receipt by Workshop">
                                                    Handover
                                                </p>

                                            @elseif($order_item->status == 4)

                                                <p class="badge bg-primary"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    title="Items successfully received by Workshop">
                                                    Received
                                                </p>

                                            @elseif($order_item->status == 5)

                                                <p class="badge bg-info"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    title="Delivery delayed by Spare Part Vendor. Reason: {{ $order_item->reason }}">
                                                    Delayed
                                                </p>

                                                <a class="badge bg-info badge-sm text-white"
                                                    href="javascript:void(0);"
                                                    wire:click="showdeclineorder({{ $order_item->id }},5)"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    title="Delivery delayed by Spare Part Vendor. Reason: {{ $order_item->reason }}">
                                                    Delayed Reason
                                                </a>

                                            @endif

                                        </td>

                                        <td>

                                            @if ($order_item->status == 5)

                                                <button type="button"
                                                    wire:click="changeItemStatus({{ $order_item->id }},1)"
                                                    class="btn btn-success btn-sm rounded mx-2">
                                                    Accept
                                                </button>

                                                <button type="button"
                                                    wire:click="showdeclineorder({{ $order_item->id }},2)"
                                                    class="btn btn-danger btn-sm rounded mx-2">
                                                    Decline
                                                </button>

                                            @endif

                                            @if ($order_item->status == 1 && $order_item->payment_status == 0)

                                                <input class="form-check-input"
                                                    type="checkbox"
                                                    @if ($checked) checked @endif
                                                    wire:click="toggleCheckbox({{ $order_item->id }}, {{ $order_item->total_amount }}, $event.target.checked)">

                                                @php
                                                    $visible = true;
                                                @endphp

                                            @endif

                                            @if (!empty($orders) && $orders->is_confim == 0)

                                                <a wire:click="confirmDelete({{ $order_item->id }})"
                                                    class="btn btn-sm p-0">

                                                    <i class="fadeIn animated bx bx-trash"></i>

                                                    <span class="small"></span>

                                                </a>

                                            @endif

                                            @if ($order_item->status == 3 && $order_item->payment_status == 1)

                                                <button type="button"
                                                    wire:click="received({{ $order_item->id }},4)"
                                                    class="btn btn-success btn-sm rounded mx-2">
                                                    Received
                                                </button>

                                            @endif

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                            @if ($totalPayabaleAmount > 0 || $visible)

                                <tfoot>

                                    <tr>

                                        <th colspan="9" class="text-end">

                                            @if ($totalPayabaleAmount > 0)

                                                <button
                                                    class="btn btn-primary"
                                                    @if (!$visible) disabled @endif
                                                    wire:click="createOrder('{{ $orderId }}','{{ $totalPayabaleAmount }}')">

                                                    Pay Now
                                                    (₹{{ $totalPayabaleAmount }})

                                                </button>

                                            @endif

                                        </th>

                                        <th>

                                            @if ($visible)

                                                Checked All
                                                <br>

                                                <input class="form-check-input"
                                                    type="checkbox"
                                                    wire:click="toggleCheckboxAll($event.target.checked,'{{ $orderId }}')">

                                            @endif

                                        </th>

                                    </tr>

                                </tfoot>

                            @endif

                        </table>

                        <div class="pagination-wrapper">
                            {{-- {{ $orders->links() }} --}}
                        </div>

                    </div>

                </div>

            @else

                <div class="my-2">
                    <div class="empty-state">
                        No Order found!
                    </div>
                </div>

            @endif

        </div>


    @else

        {{-- =====================================================
             ORDER LIST HEADER
        ====================================================== --}}

        <div class="card">

            <div class="card-body order-list-header">

                <div class="breadcrumb-title">
                    Order List
                </div>

            </div>

        </div>


        {{-- =====================================================
             FILTERS
        ====================================================== --}}

        <div class="card mt-4 filter-card">

            <div class="card-body">

                <div class="row g-3 filter-row">

                    <div class="col-12 col-md-3">

                        <input type="text"
                            class="form-control"
                            placeholder="Search Order..."
                            wire:model.live="searchfilter">

                    </div>

                    <div class="col-12 col-md-3">

                        <input class="form-control"
                            placeholder="Pick Dates"
                            id="kt_daterangepicker_1">

                    </div>

                    <div class="col-12 col-md-6 text-end">

                        <button type="button"
                            class="btn filter-clear"
                            wire:click="resetFilter">
                            Clear
                        </button>

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
             ORDER LIST
        ====================================================== --}}

        <div class="card mt-4">

            @if (!empty($items) && $items->count())

                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table data-table">

                            <thead>

                                <tr>
                                    <th>Order No.</th>
                                    <th>Item Name</th>
                                    <th>Order Date</th>
                                    <th>Amount</th>
                                    <th>Total Items</th>
                                    <th>Dealer Pending</th>
                                    <th>Ready to Receive</th>
                                    <th>Payment Status</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>

                            </thead>

                            <tbody>

                                @foreach ($items as $index => $order)

                                    <tr>

                                        <td>
                                            <span class="order-number">
                                                {{ $order->id }}
                                            </span>
                                        </td>

                                        <td style="max-width: 200px;">

                                            @php

                                                $orderItem = implode(
                                                    ', ',
                                                    $order->orderItem
                                                        ->pluck('SpareParts.name')
                                                        ->filter()
                                                        ->toArray(),
                                                );

                                            @endphp

                                            <span class="d-inline-block text-truncate"
                                                style="max-width: 100%;"
                                                title="{{ $orderItem }}"
                                                data-bs-toggle="tooltip">

                                                {{ !empty($orderItem) ? $orderItem : '-' }}

                                            </span>

                                        </td>

                                        <td>

                                            {{ \Carbon\Carbon::parse($order->order_date)->format('d-m-Y h:i A') ?? '-' }}

                                        </td>

                                        <td>

                                            <span class="amount-value">
                                                ₹ {{ number_format($order->total_amount, 2) }}
                                            </span>

                                        </td>

                                        <td>
                                            {{ $order->total_item }} Items
                                        </td>

                                        <td>

                                            <span class="badge bg-warning">
                                                {{ $order->orderItem->where('status',1)->count() }}
                                            </span>

                                        </td>

                                        <td>

                                            <span class="badge bg-primary">
                                                {{ $order->orderItem->where('status',3)->count() }}
                                            </span>

                                        </td>

                                        <td>

                                            @switch($order->payment_status)

                                                @case(0)

                                                    <span class="badge bg-danger"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="Awaiting payment from Workshop">
                                                        Pending
                                                    </span>

                                                @break

                                                @case(1)

                                                    <span class="badge bg-success"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="Payment received successfully from Workshop">
                                                        Success
                                                    </span>

                                                @break

                                                @case(2)

                                                    <span class="badge bg-success"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="Partially paid by Workshop">
                                                        Partially<br>Paid
                                                    </span>

                                                @break

                                            @endswitch

                                        </td>

                                        <td>

                                            @switch($order->order_status)

                                                @case(1)

                                                    @if ($order->payment_status == 0)

                                                        <span class="badge bg-warning"
                                                            data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            title="Order accepted by Spare Part Vendor; awaiting your payment">
                                                            Awaiting Payment
                                                        </span>

                                                    @else

                                                        <span class="badge bg-success"
                                                            data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            title="Order accepted by Spare Part Vendor; awaiting Handover">
                                                            Accepted
                                                        </span>

                                                    @endif

                                                @break

                                                @case(0)

                                                    <span class="badge bg-danger"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="Awaiting acceptance/rejection from Spare Part Vendor">
                                                        Pending
                                                    </span>

                                                @break

                                                @case(3)

                                                    @if ($order->payment_status == 0)

                                                        <span class="badge bg-warning"
                                                            data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            title="Order partially accepted by Spare Part Vendor; awaiting your payment">
                                                            Awaiting Payment
                                                        </span>

                                                    @else

                                                        <span class="badge bg-primary"
                                                            data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            title="Some items accepted/rejected by Spare Part Vendor">
                                                            Partially<br>Accepted
                                                        </span>

                                                    @endif

                                                @break

                                                @case(2)

                                                    <span class="badge bg-danger"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="Order declined by Spare Part Vendor. Reason: {{ $order->decline_reason }}">
                                                        Decline
                                                    </span>

                                                    <a class="badge bg-info badge-sm text-white"
                                                        href="javascript:void(0);"
                                                        wire:click="declineorder({{ $order->id }},2)"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="Order declined by Spare Part Vendor. Reason: {{ $order->decline_reason }}">
                                                        Declined Reason
                                                    </a>

                                                @break

                                            @endswitch

                                        </td>

                                        <td>

                                            <button type="button"
                                                class="btn btn-primary btn-sm mb-1"
                                                wire:click="viewItem({{ $order->id }})">
                                                View Item
                                            </button>

                                            @if ($order->payment_status == 0 && $order->order_status == 0)

                                                <button type="button"
                                                    class="btn btn-danger btn-sm mb-1"
                                                    wire:click="confirmDelete({{ $order->id }})">
                                                    Cancel
                                                </button>

                                            @endif

                                            {{-- Existing invoice links intentionally preserved as comments --}}
                                            {{--
                                                <a href="{{ route('getWorkshopinvoPdf', [encrypt($order->id), encrypt(0)]) }}"
                                                    class="btn btn-outline-secondary mx-1">
                                                    <i class="fa fa-file-pdf"></i>
                                                </a>

                                                <a href="{{ route('getWorkshopinvoPdf', [encrypt($order->id), encrypt(1)]) }}"
                                                    class="btn btn-outline-secondary mx-1">
                                                    <i class="fa fa-print" style="font-size: small;"></i>
                                                </a>
                                            --}}

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                        <div class="pagination-wrapper">
                            {{ $items->links() }}
                        </div>

                    </div>

                </div>

            @else

                <div class="my-2">
                    <div class="empty-state">
                        No Order Cart Found!
                    </div>
                </div>

            @endif

        </div>

    @endif

</div>

@section('footerscript')

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <script>
        function validateMaxQuantity(input) {

            // Get the max quantity value
            var maxQuantity = parseInt(input.getAttribute('max'));

            // If the current value exceeds max quantity, reset it to max
            if (parseInt(input.value) > maxQuantity) {
                input.value = maxQuantity;
            }
        }


        document.addEventListener('razorpay-show', (event) => {

            amount = event.__livewire.params[0].amount;
            orderId = event.__livewire.params[0].orderId;
            order_id = event.__livewire.params[0].order_id;

            var options = {

                // "key": "{{ env('RAZORPAY_KEY') }}",
                "key": "{{ config('services.razorpay.key') }}",
                "amount": amount * 100,
                "currency": "INR",
                "order_id": orderId,
                "name": "Test Payment",
                "description": "Payment for product/service",
                "image": "https://example.com/your-logo.png",

                "handler": function(response) {

                    console.log(response);

                    const paymentResponse = {
                        razorpay_payment_id: response.razorpay_payment_id,
                        razorpay_order_id: response.razorpay_order_id,
                        amount: amount,
                        order_id: order_id,
                    };

                    Livewire.dispatch('storePayment', {
                        paymentResponse: paymentResponse
                    });

                },

                "prefill": {
                    "name": @json(Auth::guard('workshop')->user()->name),
                    "email": @json(Auth::guard('workshop')->user()->email),
                    "contact": @json(Auth::guard('workshop')->user()->mobile_no)
                },

                "theme": {
                    "color": "#009dec"
                }

            };

            var rzp1 = new Razorpay(options);

            rzp1.open();

            event.preventDefault();

        });


        document.addEventListener('livewire:init', function() {

            tooltipLivewire();
            daterangepicker();

            Livewire.hook('morphed', (message, component) => {

                tooltipLivewire();
                daterangepicker();

            });

        });


        document.addEventListener('livewire:navigated', function() {

            tooltipLivewire();
            daterangepicker();

        });


        function tooltipLivewire() {

            var tooltipTriggerList = [].slice.call(
                document.querySelectorAll('[data-bs-toggle="tooltip"]')
            );

            tooltipTriggerList.forEach(function(tooltipTriggerEl) {

                var tooltipInstance = bootstrap.Tooltip.getInstance(tooltipTriggerEl);

                if (tooltipInstance) {
                    tooltipInstance.dispose();
                }

            });

            tooltipTriggerList.map(function(tooltipTriggerEl) {

                return new bootstrap.Tooltip(tooltipTriggerEl);

            });

        }


        function daterangepicker() {

            if ($("#kt_daterangepicker_1").length === 0) return;

            $("#kt_daterangepicker_1").daterangepicker({

                locale: {
                    cancelLabel: 'Clear',
                },

                ranges: {

                    'Today': [moment(), moment()],

                    'Yesterday': [
                        moment().subtract(1, 'days'),
                        moment().subtract(1, 'days')
                    ],

                    'Last 7 Days': [
                        moment().subtract(6, 'days'),
                        moment()
                    ],

                    'Last 30 Days': [
                        moment().subtract(29, 'days'),
                        moment()
                    ],

                    'This Month': [
                        moment().startOf('month'),
                        moment().endOf('month')
                    ],

                    'Last Month': [
                        moment().subtract(1, 'month').startOf('month'),
                        moment().subtract(1, 'month').endOf('month')
                    ],

                },

            });


            $('#kt_daterangepicker_1').on('apply.daterangepicker', function(ev, picker) {

                let startDate = picker.startDate.format('YYYY-MM-DD');
                let endDate = picker.endDate.format('YYYY-MM-DD');

                @this.set('startDate', startDate);
                @this.set('endDate', endDate);

            });


            $('#kt_daterangepicker_1').on('cancel.daterangepicker', function(ev, picker) {

                @this.set('startDate', null);
                @this.set('endDate', null);

            });

        }
    </script>

@endsection