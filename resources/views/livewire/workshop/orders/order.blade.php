<div class="carnate-order-page">
    <style>
        /* =========================================================
           CARNATE - WORKSHOP ORDERS PAGE (MODERN REDESIGN)
           Livewire methods, variables & scripts 100% preserved
        ========================================================= */
        .carnate-order-page {
            --sl-red: #e53935;
            --sl-red-dark: #c62828;
            --sl-red-soft: #fff5f5;
            --sl-red-border: #fecaca;
            --sl-text: #0f172a;
            --sl-body: #334155;
            --sl-muted: #64748b;
            --sl-border: #e2e8f0;
            --sl-card: #ffffff;
            --sl-bg: #f8fafc;
            --sl-green: #16a34a;
            --sl-green-soft: #f0fdf4;
            --sl-green-border: #bbf7d0;
            --sl-yellow: #d97706;
            --sl-yellow-soft: #fffbeb;
            --sl-yellow-border: #fde68a;
            --sl-blue: #2563eb;
            --sl-blue-soft: #eff6ff;
            --sl-blue-border: #bfdbfe;
            --sl-purple: #7c3aed;
            --sl-purple-soft: #f5f3ff;
            --sl-purple-border: #ddd6fe;
            --sl-shadow: 0 4px 18px rgba(15, 23, 42, .045);
            font-family: inherit;
            color: var(--sl-body);
        }

        /* Base Cards */
        .carnate-order-page .page-card,
        .carnate-order-page .filter-card,
        .carnate-order-page .table-card {
            background: var(--sl-card);
            border: 1px solid var(--sl-border);
            border-radius: 16px;
            box-shadow: var(--sl-shadow);
            overflow: hidden;
        }

        /* Page Header */
        .carnate-order-page .page-card {
            padding: 20px 24px;
            margin-bottom: 20px;
        }

        .carnate-order-page .page-header-wrap {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
        }

        .carnate-order-page .header-left {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .carnate-order-page .page-icon-box {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            background: var(--sl-red-soft);
            color: var(--sl-red);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            border: 1px solid var(--sl-red-border);
            flex-shrink: 0;
        }

        .carnate-order-page .page-title {
            margin: 0;
            color: var(--sl-text);
            font-size: 20px;
            font-weight: 700;
            line-height: 1.25;
        }

        .carnate-order-page .page-subtitle {
            margin: 3px 0 0;
            color: var(--sl-muted);
            font-size: 13px;
        }

        .carnate-order-page .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 18px;
            border-radius: 10px;
            background: #fff;
            color: #475569;
            border: 1px solid var(--sl-border);
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            transition: all .2s ease;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
        }

        .carnate-order-page .btn-back:hover {
            background: var(--sl-red-soft);
            color: var(--sl-red);
            border-color: var(--sl-red-border);
        }

        /* Filter Card */
        .carnate-order-page .filter-card {
            padding: 16px 20px;
            margin-bottom: 20px;
        }

        .carnate-order-page .filter-grid {
            display: flex;
            align-items: center;
            gap: 14px;
            flex-wrap: wrap;
        }

        .carnate-order-page .search-input-wrap,
        .carnate-order-page .date-input-wrap {
            position: relative;
            flex: 1 1 240px;
            max-width: 340px;
        }

        .carnate-order-page .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 18px;
            pointer-events: none;
        }

        .carnate-order-page .filter-control {
            height: 42px;
            padding-left: 42px;
            padding-right: 14px;
            border: 1px solid var(--sl-border);
            border-radius: 10px;
            background: #fff;
            color: var(--sl-text);
            font-size: 13px;
            font-weight: 500;
            width: 100%;
            transition: all .2s ease;
        }

        .carnate-order-page .filter-control:focus {
            border-color: var(--sl-red);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, 0.1);
            outline: none;
        }

        .carnate-order-page .btn-clear-filter {
            height: 42px;
            padding: 0 18px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border-radius: 10px;
            background: #f8fafc;
            color: #475569;
            border: 1px solid var(--sl-border);
            font-size: 13px;
            font-weight: 600;
            transition: all .2s ease;
            margin-left: auto;
        }

        .carnate-order-page .btn-clear-filter:hover {
            background: #f1f5f9;
            color: var(--sl-text);
            border-color: #cbd5e1;
        }

        /* Table Card & Header */
        .carnate-order-page .table-top-bar {
            padding: 16px 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid var(--sl-border);
            background: #ffffff;
        }

        .carnate-order-page .table-heading {
            font-size: 15px;
            font-weight: 700;
            color: var(--sl-text);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .carnate-order-page .count-pill {
            display: inline-flex;
            align-items: center;
            padding: 3px 10px;
            border-radius: 20px;
            background: #f1f5f9;
            color: #475569;
            font-size: 12px;
            font-weight: 600;
        }

        .carnate-order-page .table-responsive {
            overflow-x: auto;
            margin: 0;
        }

        /* Modern Table */
        .carnate-order-page .data-table {
            width: 100%;
            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
            min-width: 1100px;
        }

        .carnate-order-page .data-table thead th {
            padding: 13px 16px;
            background: #f8fafc;
            color: #475569;
            border-bottom: 1px solid var(--sl-border);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .45px;
            text-transform: uppercase;
            white-space: nowrap;
            vertical-align: middle;
            border-top: none;
        }

        .carnate-order-page .data-table tbody td {
            padding: 14px 16px;
            color: var(--sl-body);
            border-bottom: 1px solid #f1f5f9;
            font-size: 13px;
            font-weight: 500;
            vertical-align: middle;
            background: #ffffff;
        }

        .carnate-order-page .data-table tbody tr {
            transition: background-color .15s ease;
        }

        .carnate-order-page .data-table tbody tr:hover td {
            background-color: #fafbfc;
        }

        .carnate-order-page .data-table tbody tr:last-child td {
            border-bottom: none;
        }

        /* Cell Details */
        .carnate-order-page .order-id-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 9px;
            border-radius: 7px;
            background: #f1f5f9;
            color: var(--sl-text);
            font-weight: 700;
            font-size: 12px;
            border: 1px solid var(--sl-border);
        }

        .carnate-order-page .order-id-badge i {
            color: var(--sl-red);
            font-size: 14px;
        }

        .carnate-order-page .items-preview {
            max-width: 240px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            color: #334155;
            font-weight: 500;
            display: block;
        }

        .carnate-order-page .date-wrap {
            display: flex;
            flex-direction: column;
            gap: 2px;
            white-space: nowrap;
        }

        .carnate-order-page .date-text {
            color: var(--sl-text);
            font-weight: 600;
            font-size: 13px;
        }

        .carnate-order-page .time-text {
            color: var(--sl-muted);
            font-size: 11px;
        }

        .carnate-order-page .amount-text {
            font-size: 14px;
            font-weight: 700;
            color: var(--sl-text);
            white-space: nowrap;
        }

        .carnate-order-page .items-count-pill {
            display: inline-flex;
            align-items: center;
            padding: 3px 8px;
            border-radius: 6px;
            background: #f8fafc;
            border: 1px solid var(--sl-border);
            color: #475569;
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
        }

        /* Modern Status Pills */
        .carnate-order-page .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
            line-height: 1.2;
            border: 1px solid transparent;
        }

        .carnate-order-page .status-pill::before {
            content: "";
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
            display: inline-block;
        }

        .carnate-order-page .pill-success {
            background: var(--sl-green-soft);
            color: var(--sl-green);
            border-color: var(--sl-green-border);
        }

        .carnate-order-page .pill-warning {
            background: var(--sl-yellow-soft);
            color: var(--sl-yellow);
            border-color: var(--sl-yellow-border);
        }

        .carnate-order-page .pill-danger {
            background: var(--sl-red-soft);
            color: var(--sl-red);
            border-color: var(--sl-red-border);
        }

        .carnate-order-page .pill-info {
            background: var(--sl-blue-soft);
            color: var(--sl-blue);
            border-color: var(--sl-blue-border);
        }

        .carnate-order-page .pill-purple {
            background: var(--sl-purple-soft);
            color: var(--sl-purple);
            border-color: var(--sl-purple-border);
        }

        .carnate-order-page .view-reason-btn {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            margin-top: 5px;
            padding: 3px 8px;
            border-radius: 6px;
            background: var(--sl-red-soft);
            color: var(--sl-red);
            border: 1px solid var(--sl-red-border);
            font-size: 10px;
            font-weight: 700;
            text-decoration: none;
            transition: all .15s ease;
            cursor: pointer;
        }

        .carnate-order-page .view-reason-btn:hover {
            background: var(--sl-red);
            color: #fff;
        }

        /* Action Buttons */
        .carnate-order-page .actions-row {
            display: flex;
            align-items: center;
            gap: 6px;
            flex-wrap: nowrap;
        }

        .carnate-order-page .act-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            height: 32px;
            padding: 0 10px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 600;
            white-space: nowrap;
            transition: all .2s ease;
            border: 1px solid transparent;
            cursor: pointer;
        }

        .carnate-order-page .act-view {
            background: var(--sl-red-soft);
            color: var(--sl-red);
            border-color: var(--sl-red-border);
        }

        .carnate-order-page .act-view:hover {
            background: var(--sl-red);
            color: #ffffff;
            border-color: var(--sl-red);
        }

        .carnate-order-page .act-reorder {
            background: var(--sl-yellow-soft);
            color: var(--sl-yellow);
            border-color: var(--sl-yellow-border);
        }

        .carnate-order-page .act-reorder:hover {
            background: var(--sl-yellow);
            color: #ffffff;
            border-color: var(--sl-yellow);
        }

        .carnate-order-page .act-cancel {
            background: #fff;
            color: #64748b;
            border-color: var(--sl-border);
        }

        .carnate-order-page .act-cancel:hover {
            background: var(--sl-red-soft);
            color: var(--sl-red);
            border-color: var(--sl-red-border);
        }

        .carnate-order-page .act-success {
            background: var(--sl-green-soft);
            color: var(--sl-green);
            border-color: var(--sl-green-border);
        }

        .carnate-order-page .act-success:hover {
            background: var(--sl-green);
            color: #ffffff;
            border-color: var(--sl-green);
        }

        /* Detail Items View */
        .carnate-order-page .item-thumb {
            width: 44px;
            height: 44px;
            border-radius: 8px;
            background: #f8fafc;
            border: 1px solid var(--sl-border);
            object-fit: contain;
            padding: 3px;
            transition: transform .2s ease;
        }

        .carnate-order-page .item-thumb:hover {
            transform: scale(1.08);
            border-color: #cbd5e1;
        }

        .carnate-order-page .item-info-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .carnate-order-page .item-title {
            color: var(--sl-text);
            font-weight: 600;
            font-size: 13px;
        }

        .carnate-order-page .category-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 6px;
            background: #f1f5f9;
            color: #475569;
            font-size: 11px;
            font-weight: 600;
        }

        /* Payable Footer Bar */
        .carnate-order-page .table-footer-bar {
            background: #fafbfc;
            border-top: 1px solid var(--sl-border);
            padding: 14px 20px;
        }

        .carnate-order-page .btn-pay {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 22px;
            border-radius: 10px;
            background: var(--sl-red);
            color: #fff;
            border: none;
            font-size: 13px;
            font-weight: 700;
            transition: all .2s ease;
            box-shadow: 0 4px 12px rgba(229, 57, 53, 0.25);
        }

        .carnate-order-page .btn-pay:hover:not(:disabled) {
            background: var(--sl-red-dark);
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(229, 57, 53, 0.35);
        }

        .carnate-order-page .btn-pay:disabled {
            opacity: .6;
            cursor: not-allowed;
        }

        /* Pagination & Empty State */
        .carnate-order-page .pagination-bar {
            padding: 16px 22px;
            border-top: 1px solid #f1f5f9;
        }

        .carnate-order-page .empty-state-box {
            padding: 45px 20px;
            text-align: center;
        }

        .carnate-order-page .empty-icon {
            font-size: 42px;
            color: #cbd5e1;
            margin-bottom: 10px;
        }

        .carnate-order-page .empty-title {
            font-size: 15px;
            font-weight: 700;
            color: var(--sl-text);
            margin: 0 0 4px;
        }

        .carnate-order-page .empty-sub {
            font-size: 13px;
            color: var(--sl-muted);
            margin: 0;
        }

        /* Modern Modals */
        .carnate-order-page .modern-modal {
            position: fixed;
            inset: 0;
            z-index: 1055;
            background: rgba(15, 23, 42, 0.55);
            backdrop-filter: blur(2px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
        }

        .carnate-order-page .modern-modal-dialog {
            width: 100%;
            max-width: 540px;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.18);
            overflow: hidden;
            animation: modalFadeIn .2s ease-out;
        }

        @keyframes modalFadeIn {
            from { opacity: 0; transform: scale(0.96) translateY(8px); }
            to { opacity: 1; transform: scale(1) translateY(0); }
        }

        .carnate-order-page .modal-head {
            padding: 18px 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid var(--sl-border);
            background: #ffffff;
        }

        .carnate-order-page .modal-title-wrap {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .carnate-order-page .modal-icon-badge {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            background: var(--sl-red-soft);
            color: var(--sl-red);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .carnate-order-page .modal-title-text {
            font-size: 16px;
            font-weight: 700;
            color: var(--sl-text);
            margin: 0;
        }

        .carnate-order-page .modal-close-btn {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: #f1f5f9;
            border: none;
            color: #64748b;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            cursor: pointer;
            transition: all .2s ease;
        }

        .carnate-order-page .modal-close-btn:hover {
            background: var(--sl-red-soft);
            color: var(--sl-red);
        }

        .carnate-order-page .modal-inner-body {
            padding: 20px 22px;
        }

        .carnate-order-page .modal-foot {
            padding: 14px 22px;
            background: #fafbfc;
            border-top: 1px solid var(--sl-border);
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
        }

        .carnate-order-page .btn-modal-close {
            padding: 8px 18px;
            border-radius: 8px;
            background: #fff;
            color: #475569;
            border: 1px solid var(--sl-border);
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all .2s ease;
        }

        .carnate-order-page .btn-modal-close:hover {
            background: #f1f5f9;
            color: var(--sl-text);
        }

        .carnate-order-page .btn-modal-submit {
            padding: 8px 18px;
            border-radius: 8px;
            background: var(--sl-red);
            color: #fff;
            border: none;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all .2s ease;
        }

        .carnate-order-page .btn-modal-submit:hover {
            background: var(--sl-red-dark);
        }

        .carnate-order-page .reason-display-box {
            width: 100%;
            min-height: 100px;
            padding: 12px 14px;
            border-radius: 10px;
            background: #f8fafc;
            border: 1px solid var(--sl-border);
            color: var(--sl-text);
            font-size: 13px;
            line-height: 1.5;
            resize: vertical;
        }

        .carnate-order-page .reason-display-box[readonly] {
            background: #f8fafc;
            color: #334155;
            cursor: default;
        }
    </style>

    {{-- =========================================================
         IMAGE PREVIEW MODAL
    ========================================================== --}}
    @if ($shoImageModel)
        <div class="modern-modal">
            <div class="modern-modal-dialog" style="max-width: 580px;">
                <div class="modal-head">
                    <div class="modal-title-wrap">
                        <div class="modal-icon-badge">
                            <i class="bx bx-image"></i>
                        </div>
                        <h4 class="modal-title-text">Part Image Preview</h4>
                    </div>
                    <button type="button" class="modal-close-btn" wire:click="clodeImageModel">
                        <i class="bx bx-x"></i>
                    </button>
                </div>
                <div class="modal-inner-body text-center">
                    @if (!empty($imageitem))
                        @if (!empty($imageitem->SpareParts->Image->file))
                            <img src="{{ asset($imageitem->SpareParts->Image->file) }}" alt="Spare Part Image" style="max-width: 100%; max-height: 400px; object-fit: contain; border-radius: 10px;">
                        @else
                            @php $spareType = $imageitem->SpareParts?->spare_part_type ?? 0; @endphp
                            @if ($spareType == 1)
                                <img src="{{ asset('img/accessory.png') }}" alt="Accessory" style="max-width: 100%; max-height: 400px; object-fit: contain; border-radius: 10px;">
                            @elseif($spareType == 2)
                                <img src="{{ asset('img/spareparts.jpg') }}" alt="Spare Part" style="max-width: 100%; max-height: 400px; object-fit: contain; border-radius: 10px;">
                            @elseif($spareType == 3)
                                <img src="{{ asset('img/tools.jpg') }}" alt="Tools" style="max-width: 100%; max-height: 400px; object-fit: contain; border-radius: 10px;">
                            @else
                                <img src="{{ asset('img/lubricant.jpg') }}" alt="Lubricant" style="max-width: 100%; max-height: 400px; object-fit: contain; border-radius: 10px;">
                            @endif
                        @endif
                    @endif
                </div>
                <div class="modal-foot">
                    <button type="button" class="btn-modal-close" wire:click="clodeImageModel">Close</button>
                </div>
            </div>
        </div>
    @endif

    {{-- =========================================================
         REASON MODAL (View or Enter Decline/Delay Reason)
    ========================================================== --}}
    @if ($showReasonModel)
        <div class="modern-modal">
            <div class="modern-modal-dialog">
                <form wire:submit.prevent="declinereasonStore">
                    <div class="modal-head">
                        <div class="modal-title-wrap">
                            <div class="modal-icon-badge">
                                <i class="bx bx-error-circle"></i>
                            </div>
                            <h4 class="modal-title-text">{{ $statusReason ?: 'Decline' }} Reason</h4>
                        </div>
                        <button type="button" class="modal-close-btn" wire:click="clodeReasonModel">
                            <i class="bx bx-x"></i>
                        </button>
                    </div>

                    <div class="modal-inner-body">
                        @csrf
                        <label class="form-label mb-2 fw-semibold" style="font-size: 13px; color: var(--sl-text);">
                            {{ $statusReason ?: 'Decline' }} Reason @if (!$isViewReason)<sup class="text-danger">*</sup>@endif
                        </label>
                        <textarea wire:model="decline_reason" class="reason-display-box" rows="4" @if ($isViewReason) readonly @endif placeholder="Enter Reason..."></textarea>
                        @error('decline_reason')
                            <span class="text-danger error d-block mt-1" style="font-size: 12px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="modal-foot">
                        @if ($isViewReason)
                            <button type="button" class="btn-modal-close" wire:click="clodeReasonModel">Close</button>
                        @else
                            <button type="button" class="btn-modal-close" wire:click="clodeReasonModel">Cancel</button>
                            <button type="submit" class="btn-modal-submit">
                                Submit Reason
                                <i class="spinner-border spinner-border-sm" wire:loading></i>
                            </button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    @endif

    {{-- =========================================================
         DETAIL VIEW (Items for specific Order)
    ========================================================== --}}
    @if ($showOrderItem)

        {{-- Detail Header --}}
        <div class="page-card">
            <div class="page-header-wrap">
                <div class="header-left">
                    <div class="page-icon-box">
                        <i class="bx bx-package"></i>
                    </div>
                    <div>
                        <h4 class="page-title">Order #{{ $orderId }} Items</h4>
                        <p class="page-subtitle">View items, check status, verify delivery, or proceed to payment</p>
                    </div>
                </div>
                <div>
                    <button type="button" wire:click="back" class="btn-back">
                        <i class="bx bx-arrow-back"></i> Back to Orders
                    </button>
                </div>
            </div>
        </div>

        {{-- Detail Table --}}
        <div class="table-card">
            @if (!empty($orders) && !empty($orders->orderItem) && count($orders->orderItem))
                <div class="table-top-bar">
                    <h5 class="table-heading">
                        <i class="bx bx-list-check text-danger"></i> Ordered Items
                    </h5>
                    <span class="count-pill">{{ count($orders->orderItem) }} Items</span>
                </div>

                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th style="width: 50px;">S.No.</th>
                                <th>Part / Item Name</th>
                                <th>Category</th>
                                <th class="text-center">Qty</th>
                                <th>Taxable Price</th>
                                <th>GST Rate</th>
                                <th>GST Amount</th>
                                <th>Total Amount</th>
                                <th>Item Status</th>
                                <th style="min-width: 150px;">Actions</th>
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
                                    <td class="text-muted fw-semibold">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        <div class="item-info-cell">
                                            <a href="javascript:void(0);" wire:click="shoImage({{ $order_item->id }})" title="Click to view full image">
                                                @if (!empty($order_item->SpareParts->Image->file))
                                                    <img src="{{ asset($order_item->SpareParts->Image->file) }}" alt="Part" class="item-thumb">
                                                @else
                                                    @php $spareType = $order_item->SpareParts?->spare_part_type ?? 0; @endphp
                                                    @if ($spareType == 1)
                                                        <img src="{{ asset('img/accessory.png') }}" alt="Part" class="item-thumb">
                                                    @elseif($spareType == 2)
                                                        <img src="{{ asset('img/spareparts.jpg') }}" alt="Part" class="item-thumb">
                                                    @elseif($spareType == 3)
                                                        <img src="{{ asset('img/tools.jpg') }}" alt="Part" class="item-thumb">
                                                    @else
                                                        <img src="{{ asset('img/lubricant.jpg') }}" alt="Part" class="item-thumb">
                                                    @endif
                                                @endif
                                            </a>
                                            <div>
                                                <span class="item-title">{{ $order_item?->SpareParts?->name ?? '-' }}</span>
                                                @if (!empty($order_item->SpareParts?->part_number))
                                                    <div style="font-size: 11px; color: var(--sl-muted);">PN: {{ $order_item->SpareParts->part_number }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="category-badge">
                                            @switch($order_item->category)
                                                @case(1) Accessory @break
                                                @case(2) Parts @break
                                                @case(3) Tools @break
                                                @case(4) Lubricants @break
                                                @default Other
                                            @endswitch
                                        </span>
                                    </td>
                                    <td class="text-center fw-bold">
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

                                    <td class="fw-semibold">
                                        ₹ {{ number_format($taxableVal, 2) }}
                                    </td>
                                    <td>
                                        <span class="fw-semibold">{{ $order_item->SpareParts?->tax_percentage ?? 0 }}%</span>
                                        <small class="text-muted d-block" style="font-size: 10px;">({{ ucfirst($order_item->SpareParts?->tax_type ?? 'include') }})</small>
                                    </td>
                                    <td class="fw-semibold">
                                        ₹ {{ number_format($gstVal, 2) }}
                                    </td>
                                    <td>
                                        <span class="amount-text">₹ {{ number_format($payableVal, 2) }}</span>
                                    </td>
                                    <td>
                                        @if ($order_item->status == 0)
                                            <span class="status-pill pill-warning" data-bs-toggle="tooltip" title="Awaiting vendor acceptance">Pending</span>
                                        @elseif($order_item->status == 1)
                                            @if ($order_item->payment_status == 0)
                                                <span class="status-pill pill-warning" data-bs-toggle="tooltip" title="Accepted by vendor; payment required">Awaiting Payment</span>
                                            @else
                                                <span class="status-pill pill-success" data-bs-toggle="tooltip" title="Accepted & paid; awaiting handover">Accepted</span>
                                            @endif
                                        @elseif($order_item->status == 2)
                                            <div>
                                                <span class="status-pill pill-danger" data-bs-toggle="tooltip" title="Declined by vendor">Declined</span>
                                                <a href="javascript:void(0);" wire:click="showdeclineorder({{ $order_item->id }}, 2)" class="view-reason-btn">
                                                    <i class="bx bx-info-circle"></i> View Reason
                                                </a>
                                            </div>
                                        @elseif($order_item->status == 3)
                                            <span class="status-pill pill-purple" data-bs-toggle="tooltip" title="Handed over by vendor; ready to receive">Handover</span>
                                        @elseif($order_item->status == 4)
                                            <span class="status-pill pill-success" data-bs-toggle="tooltip" title="Received by workshop">Received</span>
                                        @elseif($order_item->status == 5)
                                            <div>
                                                <span class="status-pill pill-info" data-bs-toggle="tooltip" title="Delivery delayed">Delayed</span>
                                                <a href="javascript:void(0);" wire:click="showdeclineorder({{ $order_item->id }}, 5)" class="view-reason-btn">
                                                    <i class="bx bx-info-circle"></i> View Reason
                                                </a>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="actions-row">
                                            @if ($order_item->status == 5)
                                                <button type="button" wire:click="changeItemStatus({{ $order_item->id }}, 1)" class="act-btn act-success" title="Accept delayed delivery">
                                                    <i class="bx bx-check"></i> Accept
                                                </button>
                                                <button type="button" wire:click="showdeclineorder({{ $order_item->id }}, 2)" class="act-btn act-cancel" title="Decline item">
                                                    <i class="bx bx-x"></i> Decline
                                                </button>
                                            @endif

                                            @if ($order_item->status == 2)
                                                <button type="button" wire:click="reorderItem({{ $order_item->id }})" class="act-btn act-reorder" title="Reorder declined item">
                                                    <i class="bx bx-refresh"></i> Reorder
                                                </button>
                                                <button type="button" wire:click="cancelItem({{ $order_item->id }})" class="act-btn act-cancel" title="Cancel this item">
                                                    <i class="bx bx-trash"></i> Cancel
                                                </button>
                                            @endif

                                            @if ($order_item->status == 1 && $order_item->payment_status == 0)
                                                <input class="form-check-input" type="checkbox" @if ($checked) checked @endif wire:click="toggleCheckbox({{ $order_item->id }}, {{ $order_item->total_amount }}, $event.target.checked)" title="Select to pay">
                                                @php $visible = true; @endphp
                                            @endif

                                            @if (!empty($orders) && $orders->is_confim == 0)
                                                <button type="button" wire:click="confirmDelete({{ $order_item->id }})" class="act-btn act-cancel" title="Remove item">
                                                    <i class="bx bx-trash"></i>
                                                </button>
                                            @endif

                                            @if ($order_item->status == 3 && $order_item->payment_status == 1)
                                                <button type="button" wire:click="received({{ $order_item->id }}, 4)" class="act-btn act-success" title="Confirm item receipt">
                                                    <i class="bx bx-check-double"></i> Received
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                        @if ($totalPayabaleAmount > 0 || $visible)
                            <tfoot>
                                <tr>
                                    <td colspan="9" class="text-end py-3">
                                        @if ($totalPayabaleAmount > 0)
                                            <button class="btn-pay" @if (!$visible) disabled @endif wire:click="createOrder('{{ $orderId }}','{{ $totalPayabaleAmount }}')">
                                                <i class="bx bx-credit-card"></i> Pay Now (₹{{ number_format($totalPayabaleAmount, 2) }})
                                            </button>
                                        @endif
                                    </td>
                                    <td class="py-3">
                                        @if ($visible)
                                            <div class="d-flex align-items-center gap-2">
                                                <input class="form-check-input" type="checkbox" wire:click="toggleCheckboxAll($event.target.checked,'{{ $orderId }}')" id="checkAllItems">
                                                <label for="checkAllItems" class="m-0 fw-semibold" style="font-size: 11px; cursor: pointer;">Select All</label>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            </tfoot>
                        @endif
                    </table>
                </div>
            @else
                <div class="empty-state-box">
                    <i class="bx bx-box empty-icon"></i>
                    <h5 class="empty-title">No Order Items Found</h5>
                    <p class="empty-sub">This order does not contain any active items.</p>
                </div>
            @endif
        </div>

    {{-- =========================================================
         MAIN ORDERS LIST VIEW
    ========================================================== --}}
    @else

        {{-- Page Header --}}
        <div class="page-card">
            <div class="page-header-wrap">
                <div class="header-left">
                    <div class="page-icon-box">
                        <i class="bx bx-shopping-bag"></i>
                    </div>
                    <div>
                        <h4 class="page-title">Orders</h4>
                        <p class="page-subtitle">Track, manage and view status of spare part purchase orders</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Search & Filters --}}
        <div class="filter-card">
            <div class="filter-grid">
                <div class="search-input-wrap">
                    <i class="bx bx-search input-icon"></i>
                    <input type="text" class="filter-control" placeholder="Search by Order ID or items..." wire:model.live="searchfilter">
                </div>

                <div class="date-input-wrap">
                    <i class="bx bx-calendar input-icon"></i>
                    <input class="filter-control" placeholder="Select date range" id="kt_daterangepicker_1" readonly>
                </div>

                <button type="button" class="btn-clear-filter" wire:click="resetFilter" title="Reset all filters">
                    <i class="bx bx-refresh"></i> Clear Filters
                </button>
            </div>
        </div>

        {{-- Orders Table Card --}}
        <div class="table-card">
            @if (!empty($items) && $items->count())
                <div class="table-top-bar">
                    <h5 class="table-heading">
                        <i class="bx bx-list-ul text-danger"></i> All Purchase Orders
                    </h5>
                    <span class="count-pill">{{ $items->total() }} Orders</span>
                </div>

                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Ordered Parts</th>
                                <th>Order Date</th>
                                <th>Total Amount</th>
                                <th class="text-center">Items</th>
                                <th class="text-center">Dealer Accepted</th>
                                <th class="text-center">Ready to Receive</th>
                                <th>Payment</th>
                                <th>Order Status</th>
                                <th style="min-width: 140px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $index => $order)
                                <tr>
                                    <td>
                                        <span class="order-id-badge">
                                            <i class="bx bx-hash"></i>{{ $order->id }}
                                        </span>
                                    </td>

                                    <td>
                                        @php
                                            $orderItem = implode(
                                                ', ',
                                                $order->orderItem
                                                    ->pluck('SpareParts.name')
                                                    ->filter()
                                                    ->toArray(),
                                            );
                                        @endphp
                                        <span class="items-preview" title="{{ $orderItem }}" data-bs-toggle="tooltip">
                                            {{ !empty($orderItem) ? $orderItem : '-' }}
                                        </span>
                                    </td>

                                    <td>
                                        <div class="date-wrap">
                                            <span class="date-text">{{ \Carbon\Carbon::parse($order->order_date)->format('d M, Y') }}</span>
                                            <span class="time-text">{{ \Carbon\Carbon::parse($order->order_date)->format('h:i A') }}</span>
                                        </div>
                                    </td>

                                    <td>
                                        <span class="amount-text">₹ {{ number_format($order->total_amount, 2) }}</span>
                                    </td>

                                    <td class="text-center">
                                        <span class="items-count-pill">{{ $order->total_item }} Items</span>
                                    </td>

                                    <td class="text-center">
                                        @php $acceptedCount = $order->orderItem->where('status', 1)->count(); @endphp
                                        @if ($acceptedCount > 0)
                                            <span class="status-pill pill-warning" data-bs-toggle="tooltip" title="{{ $acceptedCount }} item(s) accepted by vendor">{{ $acceptedCount }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        @php $handoverCount = $order->orderItem->where('status', 3)->count(); @endphp
                                        @if ($handoverCount > 0)
                                            <span class="status-pill pill-purple" data-bs-toggle="tooltip" title="{{ $handoverCount }} item(s) handed over & ready to receive">{{ $handoverCount }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @switch($order->payment_status)
                                            @case(0)
                                                <span class="status-pill pill-danger" data-bs-toggle="tooltip" title="Payment pending from workshop">Pending</span>
                                                @break
                                            @case(1)
                                                <span class="status-pill pill-success" data-bs-toggle="tooltip" title="Payment fully confirmed">Paid</span>
                                                @break
                                            @case(2)
                                                <span class="status-pill pill-warning" data-bs-toggle="tooltip" title="Partially paid by workshop">Partially Paid</span>
                                                @break
                                        @endswitch
                                    </td>

                                    <td>
                                        @switch($order->order_status)
                                            @case(0)
                                                <span class="status-pill pill-warning" data-bs-toggle="tooltip" title="Awaiting vendor response">Pending</span>
                                                @break

                                            @case(1)
                                                @if ($order->payment_status == 0)
                                                    <span class="status-pill pill-warning" data-bs-toggle="tooltip" title="Accepted by vendor; awaiting your payment">Awaiting Payment</span>
                                                @else
                                                    <span class="status-pill pill-success" data-bs-toggle="tooltip" title="Accepted & processing">Accepted</span>
                                                @endif
                                                @break

                                            @case(2)
                                                <div>
                                                    <span class="status-pill pill-danger" data-bs-toggle="tooltip" title="Order declined by vendor">Declined</span>
                                                    <a href="javascript:void(0);" wire:click="declineorder({{ $order->id }}, 2)" class="view-reason-btn" title="View decline reason">
                                                        <i class="bx bx-info-circle"></i> View Reason
                                                    </a>
                                                </div>
                                                @break

                                            @case(3)
                                                @if ($order->payment_status == 0)
                                                    <span class="status-pill pill-warning" data-bs-toggle="tooltip" title="Partially accepted; payment required">Awaiting Payment</span>
                                                @else
                                                    <span class="status-pill pill-purple" data-bs-toggle="tooltip" title="Order partially processed">Partially Accepted</span>
                                                @endif
                                                @break

                                            @case(4)
                                                <span class="status-pill pill-success" data-bs-toggle="tooltip" title="Order successfully completed and received">Completed</span>
                                                @break

                                            @default
                                                <span class="status-pill pill-warning">{{ $order->order_status }}</span>
                                        @endswitch
                                    </td>

                                    <td>
                                        <div class="actions-row">
                                            <button type="button" class="act-btn act-view" wire:click="viewItem({{ $order->id }})" title="View order items">
                                                <i class="bx bx-show"></i> View Items
                                            </button>

                                            @if ($order->payment_status == 0 && $order->order_status == 0)
                                                <button type="button" class="act-btn act-cancel" wire:click="confirmDelete({{ $order->id }})" title="Cancel this order">
                                                    <i class="bx bx-trash"></i> Cancel
                                                </button>
                                            @endif

                                            @if ($order->order_status == 2)
                                                <button type="button" class="act-btn act-reorder" wire:click="reorder({{ $order->id }})" title="Reorder declined order">
                                                    <i class="bx bx-refresh"></i> Reorder
                                                </button>

                                                <button type="button" class="act-btn act-cancel" wire:click="confirmDelete({{ $order->id }})" title="Cancel declined order">
                                                    <i class="bx bx-trash"></i> Cancel
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="pagination-bar">
                    {{ $items->links() }}
                </div>
            @else
                <div class="empty-state-box">
                    <i class="bx bx-cart-alt empty-icon"></i>
                    <h5 class="empty-title">No Orders Found</h5>
                    <p class="empty-sub">There are no purchase orders matching your search or filters.</p>
                </div>
            @endif
        </div>

    @endif

</div>

@section('footerscript')
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <script>
        function validateMaxQuantity(input) {
            var maxQuantity = parseInt(input.getAttribute('max'));
            if (parseInt(input.value) > maxQuantity) {
                input.value = maxQuantity;
            }
        }

        document.addEventListener('razorpay-show', (event) => {
            amount = event.__livewire.params[0].amount;
            orderId = event.__livewire.params[0].orderId;
            order_id = event.__livewire.params[0].order_id;

            var options = {
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
                    "color": "#e53935"
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
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
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
