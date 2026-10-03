<div class="carnate-paid-orders-page">

    <style>
        .carnate-paid-orders-page {
            background: #f7f8fa;
            color: #111827;
        }

        .carnate-paid-orders-page .page-card,
        .carnate-paid-orders-page .filter-card,
        .carnate-paid-orders-page .table-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            box-shadow: 0 4px 18px rgba(15, 23, 42, .04);
        }

        .carnate-paid-orders-page .page-card {
            padding: 21px 24px;
        }

        .carnate-paid-orders-page .page-heading {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .carnate-paid-orders-page .page-icon {
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: #fff5f5;
            color: #e53935;
            font-size: 21px;
        }

        .carnate-paid-orders-page .page-title {
            margin: 0;
            color: #111827;
            font-size: 20px;
            font-weight: 700;
        }

        .carnate-paid-orders-page .page-subtitle {
            margin: 3px 0 0;
            color: #64748b;
            font-size: 13px;
        }

        .carnate-paid-orders-page .back-btn {
            min-height: 42px;
            padding: 0 17px;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            background: #fff;
            color: #475569;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            transition: all .2s ease;
        }

        .carnate-paid-orders-page .back-btn:hover {
            background: #fff5f5;
            border-color: #fecaca;
            color: #e53935;
        }

        /* Filters */
        .carnate-paid-orders-page .filter-card {
            margin-top: 18px;
            padding: 18px 20px;
        }

        .carnate-paid-orders-page .filter-row {
            display: flex;
            align-items: flex-end;
            gap: 12px;
        }

        .carnate-paid-orders-page .filter-item {
            width: 300px;
            max-width: 100%;
        }

        .carnate-paid-orders-page .date-filter {
            width: 260px;
        }

        .carnate-paid-orders-page .filter-label {
            display: block;
            margin-bottom: 6px;
            color: #64748b;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
        }

        .carnate-paid-orders-page .filter-control {
            height: 44px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            background: #fff;
            color: #111827;
            box-shadow: none;
        }

        .carnate-paid-orders-page .filter-control:focus {
            border-color: #cbd5e1;
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .08);
        }

        .carnate-paid-orders-page .search-wrapper {
            position: relative;
        }

        .carnate-paid-orders-page .search-wrapper i {
            position: absolute;
            z-index: 2;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 18px;
            pointer-events: none;
        }

        .carnate-paid-orders-page .search-control {
            padding-left: 42px;
        }

        .carnate-paid-orders-page .clear-btn {
            height: 44px;
            padding: 0 17px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            background: #fff;
            color: #475569;
            font-size: 13px;
            font-weight: 600;
            transition: all .2s ease;
        }

        .carnate-paid-orders-page .clear-btn:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
            color: #111827;
        }

        /* Table */
        .carnate-paid-orders-page .table-card {
            margin-top: 18px;
            overflow: hidden;
        }

        .carnate-paid-orders-page .table-header {
            padding: 20px 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #e2e8f0;
        }

        .carnate-paid-orders-page .table-title {
            margin: 0;
            color: #111827;
            font-size: 16px;
            font-weight: 700;
        }

        .carnate-paid-orders-page .table-count {
            padding: 5px 10px;
            border-radius: 20px;
            background: #f1f5f9;
            color: #64748b;
            font-size: 12px;
            font-weight: 600;
        }

        .carnate-paid-orders-page .table-wrap {
            overflow-x: auto;
        }

        .carnate-paid-orders-page table {
            width: 100%;
            min-width: 1050px;
            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .carnate-paid-orders-page thead th {
            padding: 14px 16px;
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            color: #64748b;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
            white-space: nowrap;
        }

        .carnate-paid-orders-page tbody td {
            padding: 15px 16px;
            border-bottom: 1px solid #f1f5f9;
            color: #475569;
            font-size: 13px;
            vertical-align: middle;
        }

        .carnate-paid-orders-page tbody tr {
            transition: background .15s ease;
        }

        .carnate-paid-orders-page tbody tr:hover {
            background: #fafafa;
        }

        .carnate-paid-orders-page tbody tr:last-child td {
            border-bottom: 0;
        }

        .carnate-paid-orders-page .serial {
            color: #94a3b8;
            font-weight: 600;
        }

        .carnate-paid-orders-page .invoice-number {
            color: #111827;
            font-weight: 700;
            white-space: nowrap;
        }

        .carnate-paid-orders-page .invoice-icon {
            color: #e53935;
            margin-right: 6px;
        }

        .carnate-paid-orders-page .date-block {
            white-space: nowrap;
        }

        .carnate-paid-orders-page .date-main {
            color: #334155;
            font-weight: 600;
        }

        .carnate-paid-orders-page .date-time {
            margin-top: 2px;
            color: #94a3b8;
            font-size: 11px;
        }

        .carnate-paid-orders-page .amount {
            color: #111827;
            font-weight: 700;
            white-space: nowrap;
        }

        .carnate-paid-orders-page .quantity {
            color: #334155;
            font-weight: 600;
            text-align: center;
        }

        .carnate-paid-orders-page .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 9px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        .carnate-paid-orders-page .status-badge::before {
            content: "";
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
        }

        .carnate-paid-orders-page .status-success {
            background: #f0fdf4;
            color: #15803d;
        }

        .carnate-paid-orders-page .status-warning {
            background: #fff7ed;
            color: #c2410c;
        }

        .carnate-paid-orders-page .status-danger {
            background: #fef2f2;
            color: #dc2626;
        }

        .carnate-paid-orders-page .status-info {
            background: #eff6ff;
            color: #2563eb;
        }

        .carnate-paid-orders-page .actions {
            display: flex;
            align-items: center;
            gap: 6px;
            flex-wrap: nowrap;
        }

        .carnate-paid-orders-page .action-btn {
            min-height: 34px;
            padding: 0 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 600;
            white-space: nowrap;
            cursor: pointer;
            text-decoration: none;
            transition: all .2s ease;
        }

        .carnate-paid-orders-page .action-view {
            border: 1px solid #fecaca;
            background: #fff5f5;
            color: #e53935;
        }

        .carnate-paid-orders-page .action-view:hover {
            background: #e53935;
            color: #fff;
        }

        .carnate-paid-orders-page .action-icon {
            width: 34px;
            padding: 0;
            border: 1px solid #e2e8f0;
            background: #fff;
            color: #64748b;
        }

        .carnate-paid-orders-page .action-icon:hover {
            border-color: #fecaca;
            background: #fff5f5;
            color: #e53935;
        }

        .carnate-paid-orders-page .pagination-wrapper {
            padding: 18px 20px;
            border-top: 1px solid #f1f5f9;
        }

        /* Detail */
        .carnate-paid-orders-page .detail-card {
            margin-top: 18px;
        }

        .carnate-paid-orders-page .detail-table {
            min-width: 1350px;
        }

        .carnate-paid-orders-page .part-cell {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 220px;
        }

        .carnate-paid-orders-page .part-image {
            width: 48px;
            height: 48px;
            flex: 0 0 48px;
            object-fit: cover;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            background: #f8fafc;
            cursor: pointer;
            transition: transform .2s ease;
        }

        .carnate-paid-orders-page .part-image:hover {
            transform: scale(1.04);
        }

        .carnate-paid-orders-page .part-name {
            color: #111827;
            font-weight: 600;
        }

        .carnate-paid-orders-page .category-badge {
            display: inline-flex;
            padding: 5px 8px;
            border-radius: 7px;
            background: #f1f5f9;
            color: #475569;
            font-size: 11px;
            font-weight: 600;
        }

        .carnate-paid-orders-page .tax-type {
            display: block;
            margin-top: 2px;
            color: #94a3b8;
            font-size: 10px;
        }

        .carnate-paid-orders-page .money {
            color: #334155;
            font-weight: 600;
            white-space: nowrap;
        }

        .carnate-paid-orders-page .detail-actions {
            display: flex;
            align-items: center;
            gap: 6px;
            flex-wrap: wrap;
            min-width: 160px;
        }

        .carnate-paid-orders-page .detail-action {
            min-height: 32px;
            padding: 0 9px;
            border: 1px solid transparent;
            border-radius: 7px;
            font-size: 10px;
            font-weight: 700;
            cursor: pointer;
            transition: all .2s ease;
        }

        .carnate-paid-orders-page .btn-reason {
            background: #eff6ff;
            border-color: #bfdbfe;
            color: #2563eb;
        }

        .carnate-paid-orders-page .btn-reason:hover {
            background: #2563eb;
            color: #fff;
        }

        .carnate-paid-orders-page .btn-handover {
            background: #f0fdf4;
            border-color: #bbf7d0;
            color: #15803d;
        }

        .carnate-paid-orders-page .btn-handover:hover {
            background: #15803d;
            color: #fff;
        }

        /* Modals */
        .carnate-paid-orders-page .carnate-modal {
            position: fixed;
            inset: 0;
            z-index: 1055;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: rgba(15, 23, 42, .48);
            backdrop-filter: blur(3px);
        }

        .carnate-paid-orders-page .image-dialog {
            width: 100%;
            max-width: 620px;
        }

        .carnate-paid-orders-page .reason-dialog {
            width: 100%;
            max-width: 760px;
        }

        .carnate-paid-orders-page .modal-content-modern {
            overflow: hidden;
            border: 1px solid #e2e8f0;
            border-radius: 18px;
            background: #fff;
            box-shadow: 0 24px 60px rgba(15, 23, 42, .18);
        }

        .carnate-paid-orders-page .modal-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 19px 22px;
            border-bottom: 1px solid #e2e8f0;
        }

        .carnate-paid-orders-page .modal-title-wrap {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .carnate-paid-orders-page .modal-icon {
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: #fff5f5;
            color: #e53935;
            font-size: 19px;
        }

        .carnate-paid-orders-page .modal-title {
            margin: 0;
            color: #111827;
            font-size: 17px;
            font-weight: 700;
        }

        .carnate-paid-orders-page .modal-close {
            width: 34px;
            height: 34px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 0;
            border-radius: 9px;
            background: #f1f5f9;
            color: #64748b;
            cursor: pointer;
        }

        .carnate-paid-orders-page .modal-close:hover {
            background: #fef2f2;
            color: #dc2626;
        }

        .carnate-paid-orders-page .image-body {
            padding: 22px;
            text-align: center;
        }

        .carnate-paid-orders-page .preview-image {
            display: block;
            width: 100%;
            max-height: 65vh;
            object-fit: contain;
            border-radius: 12px;
            background: #f8fafc;
        }

        .carnate-paid-orders-page .reason-body {
            padding: 22px;
        }

        .carnate-paid-orders-page .reason-label {
            display: block;
            margin-bottom: 8px;
            color: #334155;
            font-size: 13px;
            font-weight: 600;
        }

        .carnate-paid-orders-page .reason-required {
            color: #e53935;
        }

        .carnate-paid-orders-page .reason-textarea {
            min-height: 125px;
            resize: vertical;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            box-shadow: none;
        }

        .carnate-paid-orders-page .reason-textarea:focus {
            border-color: #cbd5e1;
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .08);
        }

        .carnate-paid-orders-page .modal-footer-modern {
            display: flex;
            justify-content: flex-end;
            gap: 9px;
            padding: 15px 22px;
            border-top: 1px solid #e2e8f0;
        }

        .carnate-paid-orders-page .cancel-btn {
            min-height: 40px;
            padding: 0 16px;
            border: 1px solid #e2e8f0;
            border-radius: 9px;
            background: #fff;
            color: #475569;
            font-size: 13px;
            font-weight: 600;
        }

        .carnate-paid-orders-page .primary-btn {
            min-height: 40px;
            padding: 0 17px;
            border: 0;
            border-radius: 9px;
            background: #e53935;
            color: #fff;
            font-size: 13px;
            font-weight: 600;
        }

        .carnate-paid-orders-page .primary-btn:hover {
            background: #c62828;
        }

        .carnate-paid-orders-page .primary-btn .spinner-border {
            width: 13px;
            height: 13px;
            margin-left: 7px;
            border-width: 2px;
        }

        /* Empty state */
        .carnate-paid-orders-page .empty-state {
            padding: 55px 20px;
            text-align: center;
        }

        .carnate-paid-orders-page .empty-icon {
            width: 58px;
            height: 58px;
            margin: 0 auto 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 15px;
            background: #f1f5f9;
            color: #94a3b8;
            font-size: 27px;
        }

        .carnate-paid-orders-page .empty-title {
            margin: 0;
            color: #334155;
            font-size: 15px;
            font-weight: 600;
        }

        @media (max-width: 900px) {
            .carnate-paid-orders-page .page-card {
                align-items: flex-start !important;
                gap: 15px;
            }

            .carnate-paid-orders-page .filter-row {
                flex-wrap: wrap;
            }

            .carnate-paid-orders-page .filter-item,
            .carnate-paid-orders-page .date-filter {
                width: calc(50% - 6px);
            }
        }

        @media (max-width: 600px) {
            .carnate-paid-orders-page .page-card {
                padding: 18px;
            }

            .carnate-paid-orders-page .back-btn {
                width: 100%;
                justify-content: center;
            }

            .carnate-paid-orders-page .filter-row {
                display: block;
            }

            .carnate-paid-orders-page .filter-item,
            .carnate-paid-orders-page .date-filter {
                width: 100%;
                margin-bottom: 10px;
            }

            .carnate-paid-orders-page .carnate-modal {
                padding: 10px;
            }

            .carnate-paid-orders-page .modal-head,
            .carnate-paid-orders-page .image-body,
            .carnate-paid-orders-page .reason-body,
            .carnate-paid-orders-page .modal-footer-modern {
                padding-left: 18px;
                padding-right: 18px;
            }
        }
    </style>

    {{-- Image Modal --}}
    @if ($shoImageModel)
        <div class="carnate-modal">
            <div class="image-dialog">
                <div class="modal-content-modern">

                    <div class="modal-head">
                        <div class="modal-title-wrap">
                            <div class="modal-icon">
                                <i class="bx bx-image"></i>
                            </div>
                            <h4 class="modal-title">Image</h4>
                        </div>

                        <button
                            type="button"
                            class="modal-close"
                            wire:click="clodeImageModel"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        >
                            <i class="bx bx-x"></i>
                        </button>
                    </div>

                    <div class="image-body">
                        @if (!empty($imageitem))
                            @if (!empty($imageitem->SpareParts->Image->file))
                                <img
                                    src="{{ asset($imageitem->SpareParts->Image->file) }}"
                                    alt="Maintenance Service Parts"
                                    class="preview-image"
                                >
                            @else
                                @if ($imageitem->SpareParts->spare_part_type == 1)
                                    <img src="{{ asset('img/accessory.png') }}" alt="Maintenance Service Parts" class="preview-image">
                                @elseif($imageitem->SpareParts->spare_part_type == 2)
                                    <img src="{{ asset('img/spareparts.jpg') }}" alt="Maintenance Service Parts" class="preview-image">
                                @elseif($imageitem->SpareParts->spare_part_type == 3)
                                    <img src="{{ asset('img/tools.jpg') }}" alt="Maintenance Service Parts" class="preview-image">
                                @else
                                    <img src="{{ asset('img/lubricant.jpg') }}" alt="Maintenance Service Parts" class="preview-image">
                                @endif
                            @endif
                        @endif
                    </div>

                </div>
            </div>
        </div>
    @endif

    {{-- Reason Modal --}}
    @if ($showReasonModel)
        <div class="carnate-modal">
            <div class="reason-dialog">
                <div class="modal-content-modern">

                    <form wire:submit.prevent="declinereasonStore">

                        <div class="modal-head">
                            <div class="modal-title-wrap">
                                <div class="modal-icon">
                                    <i class="bx bx-message-square-error"></i>
                                </div>

                                <h4 class="modal-title">
                                    {{ $statusReason }} Reason
                                </h4>
                            </div>

                            <button
                                type="button"
                                class="modal-close"
                                wire:click="clodeReasonModel"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                            >
                                <i class="bx bx-x"></i>
                            </button>
                        </div>

                        <div class="reason-body">
                            @csrf

                            <label class="reason-label">
                                {{ $statusReason }} Reason
                                <sup class="reason-required">*</sup>
                            </label>

                            <textarea
                                wire:model="decline_reason"
                                class="form-control reason-textarea"
                                rows="4"
                                placeholder="Enter Reason"
                            ></textarea>

                            @error('decline_reason')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>

                        @if(empty($decline_reason))
                            <div class="modal-footer-modern">
                                <button
                                    type="button"
                                    class="cancel-btn"
                                    wire:click="clodeReasonModel"
                                    data-bs-dismiss="modal"
                                >
                                    Cancel
                                </button>

                                <button type="submit" class="primary-btn">
                                    Create
                                    <i class="spinner-border spinner-border-sm" wire:loading></i>
                                </button>
                            </div>
                        @endif

                    </form>

                </div>
            </div>
        </div>
    @endif

    {{-- Order Item Detail --}}
    @if ($showOrderItem)

        <div class="page-card d-flex justify-content-between align-items-center">
            <div class="page-heading">
                <div class="page-icon">
                    <i class="bx bx-package"></i>
                </div>

                <div>
                    <h1 class="page-title">Order Item</h1>
                    <p class="page-subtitle">Review paid order items and manage handover</p>
                </div>
            </div>

            <a
                href="javascript:void(0);"
                wire:click="back"
                class="back-btn"
            >
                <i class="bx bx-arrow-back"></i>
                Back
            </a>
        </div>

        <div class="table-card detail-card">

            @if (!empty($orders->orderItem) && count($orders->orderItem))

                <div class="table-header">
                    <h5 class="table-title">Order Items</h5>

                    <span class="table-count">
                        {{ count($orders->orderItem) }} Items
                    </span>
                </div>

                <div class="table-wrap">
                    <table class="table detail-table">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Item Name</th>
                                <th>Category</th>
                                <th>Rack No.</th>
                                <th>Part Number</th>
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
                                $totalTaxableAmount = [];
                            @endphp

                            @foreach ($orders->orderItem as $index => $order_item)

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

                                <tr>
                                    <td class="serial">{{ $loop->iteration }}</td>

                                    <td>
                                        <div class="part-cell">
                                            <a
                                                href="javascript:void(0);"
                                                wire:click="shoImage({{ $order_item->id }})"
                                            >
                                                @if (!empty($order_item->SpareParts->Image->file))
                                                    <img
                                                        src="{{ asset($order_item->SpareParts->Image->file) }}"
                                                        alt="Maintenance Service Parts"
                                                        class="part-image"
                                                    >
                                                @else
                                                    @if($order_item->SpareParts->spare_part_type == 1)
                                                        <img src="{{ asset('img/accessory.png') }}" alt="Maintenance Service Parts" class="part-image">
                                                    @elseif($order_item->SpareParts->spare_part_type == 2)
                                                        <img src="{{ asset('img/spareparts.jpg') }}" alt="Maintenance Service Parts" class="part-image">
                                                    @elseif($order_item->SpareParts->spare_part_type == 3)
                                                        <img src="{{ asset('img/tools.jpg') }}" alt="Maintenance Service Parts" class="part-image">
                                                    @else
                                                        <img src="{{ asset('img/lubricant.jpg') }}" alt="Maintenance Service Parts" class="part-image">
                                                    @endif
                                                @endif
                                            </a>

                                            <span class="part-name">
                                                {{ $order_item?->SpareParts?->name ?? '-' }}
                                            </span>
                                        </div>
                                    </td>

                                    <td>
                                        <span class="category-badge">
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
                                        </span>
                                    </td>

                                    <td>{{ $order_item->SpareParts->rack_no ?? 'Null' }}</td>

                                    <td>{{ $order_item->SpareParts->part_number ?? 'Null' }}</td>

                                    <td class="quantity">{{ $order_item->quantity }}</td>

                                    <td>
                                        <span class="money">
                                            ₹ {{ number_format($taxableVal, 2) }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="money">
                                            {{ $order_item->SpareParts?->tax_percentage ?? 0 }}%
                                        </span>

                                        <small class="tax-type">
                                            ({{ ucfirst($order_item->SpareParts?->tax_type ?? 'include') }})
                                        </small>
                                    </td>

                                    <td>
                                        <span class="money">
                                            ₹ {{ number_format($gstVal, 2) }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="money">
                                            ₹ {{ number_format($payableVal, 2) }}
                                        </span>
                                    </td>

                                    <td>
                                        @if ($order_item->status == 0)

                                            <span
                                                class="status-badge status-warning"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Awaiting acceptance/rejection from Spare Part Vendor"
                                            >
                                                Pending
                                            </span>

                                        @elseif($order_item->status == 1)

                                            <span
                                                class="status-badge status-success"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Item accepted; awaiting Handover"
                                            >
                                                Accepted
                                            </span>

                                        @elseif($order_item->status == 2)

                                            <span
                                                class="status-badge status-danger"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Item declined by Spare Part Vendor. Reason: {{ $order_item->reason }}"
                                            >
                                                Declined
                                            </span>

                                        @elseif($order_item->status == 3)

                                            <span
                                                class="status-badge status-success"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Item handed over; awaiting receipt by Workshop"
                                            >
                                                Handover
                                            </span>

                                        @elseif($order_item->status == 4)

                                            <span
                                                class="status-badge status-info"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Item successfully received by Workshop"
                                            >
                                                Received-Handover
                                            </span>

                                        @elseif($order_item->status == 5)

                                            <span
                                                class="status-badge status-info"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Delivery delayed by Spare Part Vendor. Reason: {{ $order_item->reason }}"
                                            >
                                                Delayed
                                            </span>

                                        @endif
                                    </td>

                                    <td>
                                        <div class="detail-actions">

                                            @if ($order_item->status == 5)

                                                <button
                                                    type="button"
                                                    wire:click="declineorder({{ $order_item->id }},5)"
                                                    class="detail-action btn-reason"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    title="{{ $order_item->reason }}"
                                                >
                                                    Delayed Reason
                                                </button>

                                            @elseif($order_item->status == 2)

                                                <button
                                                    type="button"
                                                    wire:click="declineorder({{ $order_item->id }},2)"
                                                    class="detail-action btn-reason"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    title="{{ $order_item->reason }}"
                                                >
                                                    Declined Reason
                                                </button>

                                            @endif

                                            @if (($order_item->payment_status == 1 || $order_item->payment_status == 2) && $order_item->status == 1)

                                                <button
                                                    type="button"
                                                    wire:click="handover({{ $order_item->id }},3)"
                                                    class="detail-action btn-handover"
                                                >
                                                    Handover
                                                </button>

                                            @endif

                                        </div>
                                    </td>
                                </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="pagination-wrapper">
                    {{-- {{ $orders->links() }} --}}
                </div>

            @else

                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="bx bx-package"></i>
                    </div>

                    <p class="empty-title">No Order found!</p>
                </div>

            @endif

        </div>

    @else

        {{-- Paid Order Header --}}
        <div class="page-card d-flex justify-content-between align-items-center">

            <div class="page-heading">
                <div class="page-icon">
                    <i class="bx bx-check-double"></i>
                </div>

                <div>
                    <h1 class="page-title">Paid Order List</h1>
                    <p class="page-subtitle">
                        View paid orders, invoices and handover status
                    </p>
                </div>
            </div>

            <div></div>
        </div>

        {{-- Filters --}}
        <div class="filter-card">
            <div class="filter-row">

                <div class="filter-item">
                    <label class="filter-label">Search Invoice</label>

                    <div class="search-wrapper">
                        <i class="bx bx-search"></i>

                        <input
                            type="text"
                            class="form-control filter-control search-control"
                            placeholder="Search Invoice No."
                            wire:model.live="searchfilter"
                        >
                    </div>
                </div>

                <div class="filter-item date-filter">
                    <label class="filter-label">Order Date</label>

                    <input
                        class="form-control filter-control"
                        placeholder="Pick Dates"
                        id="kt_daterangepicker_1"
                    >
                </div>

                <div>
                    <label class="filter-label">&nbsp;</label>

                    <button
                        type="button"
                        class="clear-btn"
                        wire:click="resetFilter"
                    >
                        <i class="bx bx-reset me-1"></i>
                        Clear
                    </button>
                </div>

            </div>
        </div>

        {{-- Paid Orders Table --}}
        <div class="table-card">

            @if (!empty($orders) && $orders->count())

                <div class="table-header">
                    <h5 class="table-title">Paid Orders</h5>

                    <span class="table-count">
                        {{ $orders->total() }} Orders
                    </span>
                </div>

                <div class="table-wrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Invoice No.</th>
                                <th>Order Date</th>
                                <th>Total Amount</th>
                                <th>Total Quantity</th>
                                <th>Total Item</th>
                                <th>Handover Pending</th>
                                <th>Payment Status</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($orders as $index => $order)

                                <tr>
                                    <td class="serial">
                                        {{ $orders->total() - ($orders->firstItem() + $index) + 1 }}
                                    </td>

                                    <td>
                                        <span class="invoice-number">
                                            <i class="bx bx-receipt invoice-icon"></i>
                                            {{ \sparepartOrderReference($order, $currentUser) }}
                                        </span>
                                    </td>

                                    <td>
                                        <div class="date-block">
                                            <div class="date-main">
                                                {{ carbon\carbon::parse($order->order_date)->format('d-M-Y') }}
                                            </div>

                                            <div class="date-time">
                                                {{ carbon\carbon::parse($order->order_date)->format('h:i A') }}
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <span class="amount">
                                            {{ number_format($order->total_amount, 2) }}
                                        </span>
                                    </td>

                                    <td class="quantity">
                                        {{ $order->total_quantity }}
                                    </td>

                                    <td class="quantity">
                                        {{ $order->total_item }}
                                    </td>

                                    <td class="quantity">
                                        {{ $order->orderItem->where('status', 1)->count() }}
                                    </td>

                                    <td>
                                        @switch($order->payment_status)

                                            @case(0)
                                                <span
                                                    class="status-badge status-danger"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    title="Awaiting payment from Workshop"
                                                >
                                                    Payment Pending
                                                </span>
                                            @break

                                            @case(1)
                                                <span
                                                    class="status-badge status-success"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    title="Payment received successfully from Workshop"
                                                >
                                                    Payment Success
                                                </span>
                                            @break

                                        @endswitch
                                    </td>

                                    <td>
                                        @switch($order->order_status)

                                            @case(1)
                                                <span
                                                    class="status-badge status-success"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    title="Order accepted by Spare Part Vendor; awaiting Handover"
                                                >
                                                    Accepted
                                                </span>
                                            @break

                                            @case(0)
                                                <span
                                                    class="status-badge status-danger"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    title="Awaiting acceptance/rejection from Spare Part Vendor"
                                                >
                                                    Pending
                                                </span>
                                            @break

                                            @case(3)
                                                <span
                                                    class="status-badge status-info"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    title="Some items accepted/rejected by Spare Part Vendor; awaiting Handover"
                                                >
                                                    Partially Accepted
                                                </span>
                                            @break

                                            @case(2)
                                                <span
                                                    class="status-badge status-danger"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    title="Order declined by Spare Part Vendor. Reason: {{ $order->decline_reason }}"
                                                >
                                                    Decline
                                                </span>
                                            @break

                                        @endswitch
                                    </td>

                                    <td>
                                        <div class="actions">

                                            <a
                                                class="action-btn action-view"
                                                wire:click="view({{ $order->id }})"
                                            >
                                                <i class="bx bx-show"></i>
                                                View Item
                                            </a>

                                            @php
                                                $sparepartId = $currentUser->id;
                                                $ordertId = $order->orderItem->pluck('order_id')->toArray();
                                                $ordertId = implode('-', array_unique($ordertId));
                                                $sparepartItemId = $order->orderItem->pluck('id')->toArray();
                                                $sparepartItemId = implode('-', $sparepartItemId);
                                            @endphp

                                            <a
                                                href="{{ route('getSparePartinvoPdf', [encrypt($sparepartId), encrypt($sparepartItemId), encrypt($ordertId), encrypt(0)]) }}"
                                                target="_blank"
                                                class="action-btn action-icon"
                                                title="View PDF"
                                            >
                                                <i class="bx bxs-file-pdf"></i>
                                            </a>

                                            <a
                                                href="{{ route('getSparePartinvoPdf', [encrypt($sparepartId), encrypt($sparepartItemId), encrypt($ordertId), encrypt(1)]) }}"
                                                target="_blank"
                                                class="action-btn action-icon"
                                                title="Print Invoice"
                                            >
                                                <i class="bx bx-printer"></i>
                                            </a>

                                        </div>
                                    </td>

                                </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="pagination-wrapper">
                    {{ $orders->links() }}
                </div>

            @else

                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="bx bx-check-double"></i>
                    </div>

                    <p class="empty-title">No Order found!</p>
                </div>

            @endif

        </div>

    @endif

    @section('footerscript')
        <script>
            document.addEventListener('livewire:init', function() {

                function initializePaidOrderDatePicker() {
                    const picker = $("#kt_daterangepicker_1");

                    if (!picker.length) {
                        return;
                    }

                    if (picker.data('daterangepicker')) {
                        picker.data('daterangepicker').remove();
                    }

                    picker.daterangepicker({
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

                    picker.off('apply.daterangepicker').on('apply.daterangepicker', function(ev, picker) {
                        let startDate = picker.startDate.format('YYYY-MM-DD');
                        let endDate = picker.endDate.format('YYYY-MM-DD');

                        @this.set('startDate', startDate);
                        @this.set('endDate', endDate);
                    });

                    picker.off('cancel.daterangepicker').on('cancel.daterangepicker', function(ev, picker) {
                        @this.set('startDate', null);
                        @this.set('endDate', null);
                    });
                }

                initializePaidOrderDatePicker();

                tooltipLivewire();

                Livewire.hook('morphed', (message, component) => {
                    initializePaidOrderDatePicker();
                    tooltipLivewire();
                });
            });

            document.addEventListener('livewire:navigated', function() {
                tooltipLivewire();
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
        </script>
    @endsection

</div>