<div class="carnate-cart-page">
    <style>
        .carnate-cart-page {
            --sl-primary: #ef4444;
            --sl-primary-hover: #dc2626;
            --sl-bg: #f4f6f9;
            --sl-card: #ffffff;
            --sl-border: #edf0f4;
            --sl-text: #1e293b;
            --sl-body: #475569;
            --sl-muted: #94a3b8;
            --sl-red: #ef4444;
            --sl-red-soft: #fef2f2;
            --sl-red-border: #fecaca;
            --sl-red-dark: #dc2626;
            --sl-green: #10b981;
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
        .carnate-cart-page .page-card,
        .carnate-cart-page .table-card {
            background: var(--sl-card);
            border: 1px solid var(--sl-border);
            border-radius: 16px;
            box-shadow: var(--sl-shadow);
            overflow: hidden;
        }

        /* Page Header */
        .carnate-cart-page .page-card {
            padding: 20px 24px;
            margin-bottom: 20px;
        }

        .carnate-cart-page .page-header-wrap {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
        }

        .carnate-cart-page .header-left {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .carnate-cart-page .page-icon-box {
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

        .carnate-cart-page .page-title {
            margin: 0;
            color: var(--sl-text);
            font-size: 20px;
            font-weight: 700;
            line-height: 1.25;
        }

        .carnate-cart-page .page-subtitle {
            margin: 3px 0 0;
            color: var(--sl-muted);
            font-size: 13px;
        }

        .carnate-cart-page .btn-back {
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

        .carnate-cart-page .btn-back:hover {
            background: var(--sl-red-soft);
            color: var(--sl-red);
            border-color: var(--sl-red-border);
        }

        /* Table Card */
        .carnate-cart-page .table-card-header {
            padding: 16px 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid var(--sl-border);
            background: #fafbfc;
        }

        .carnate-cart-page .table-title {
            font-size: 14px;
            font-weight: 700;
            color: var(--sl-text);
        }

        .carnate-cart-page .count-pill {
            display: inline-flex;
            align-items: center;
            padding: 4px 12px;
            border-radius: 20px;
            background: #f1f5f9;
            color: #475569;
            font-size: 12px;
            font-weight: 600;
        }

        /* Modern Table */
        .carnate-cart-page .table-responsive {
            overflow-x: auto;
            margin: 0;
        }

        .carnate-cart-page .carnate-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-bottom: 0;
        }

        .carnate-cart-page .carnate-table thead th {
            background: #fafbfc;
            color: #64748b;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .5px;
            padding: 13px 16px;
            border-bottom: 1px solid var(--sl-border);
            border-top: none;
            white-space: nowrap;
        }

        .carnate-cart-page .carnate-table tbody td {
            padding: 14px 16px;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
            color: var(--sl-body);
            font-size: 13px;
        }

        .carnate-cart-page .carnate-table tbody tr:last-child td {
            border-bottom: none;
        }

        .carnate-cart-page .carnate-table tbody tr:hover td {
            background: #f8fafc;
        }

        /* Item Cell */
        .carnate-cart-page .item-cell {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 200px;
        }

        .carnate-cart-page .item-thumb-box {
            width: 44px;
            height: 44px;
            border-radius: 8px;
            border: 1px solid var(--sl-border);
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8fafc;
            flex-shrink: 0;
            cursor: pointer;
            transition: transform .15s ease;
        }

        .carnate-cart-page .item-thumb-box:hover {
            transform: scale(1.05);
            border-color: var(--sl-red-border);
        }

        .carnate-cart-page .item-thumb-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .carnate-cart-page .item-thumb-placeholder {
            font-size: 20px;
            color: #94a3b8;
        }

        .carnate-cart-page .item-name-text {
            font-weight: 600;
            color: var(--sl-text);
            font-size: 13px;
            line-height: 1.3;
        }

        .carnate-cart-page .item-brand-text {
            font-size: 11px;
            color: var(--sl-muted);
            margin-top: 2px;
        }

        /* Badges */
        .carnate-cart-page .category-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 6px;
            background: #f1f5f9;
            color: #475569;
            font-size: 11px;
            font-weight: 600;
            white-space: nowrap;
        }

        .carnate-cart-page .part-number-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 6px;
            background: var(--sl-blue-soft);
            color: var(--sl-blue);
            border: 1px solid var(--sl-blue-border);
            font-size: 11px;
            font-weight: 600;
            font-family: monospace;
            white-space: nowrap;
        }

        .carnate-cart-page .qty-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 32px;
            height: 28px;
            padding: 0 8px;
            border-radius: 6px;
            background: #f8fafc;
            border: 1px solid var(--sl-border);
            font-size: 12px;
            font-weight: 700;
            color: var(--sl-text);
        }

        .carnate-cart-page .price-num {
            font-size: 13px;
            color: #475569;
            white-space: nowrap;
        }

        .carnate-cart-page .total-num {
            font-size: 13px;
            font-weight: 700;
            color: var(--sl-text);
            white-space: nowrap;
        }

        /* Status Pills */
        .carnate-cart-page .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 11px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
            line-height: 1.2;
            border: 1px solid transparent;
        }

        .carnate-cart-page .status-pill::before {
            content: "";
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
            display: inline-block;
        }

        .carnate-cart-page .pill-success {
            background: var(--sl-green-soft);
            color: var(--sl-green);
            border-color: var(--sl-green-border);
        }

        .carnate-cart-page .pill-warning {
            background: var(--sl-yellow-soft);
            color: var(--sl-yellow);
            border-color: var(--sl-yellow-border);
        }

        .carnate-cart-page .pill-danger {
            background: var(--sl-red-soft);
            color: var(--sl-red);
            border-color: var(--sl-red-border);
        }

        .carnate-cart-page .pill-info {
            background: var(--sl-blue-soft);
            color: var(--sl-blue);
            border-color: var(--sl-blue-border);
        }

        .carnate-cart-page .pill-purple {
            background: var(--sl-purple-soft);
            color: var(--sl-purple);
            border-color: var(--sl-purple-border);
        }

        .carnate-cart-page .view-reason-btn {
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

        .carnate-cart-page .view-reason-btn:hover {
            background: var(--sl-red);
            color: #fff;
        }

        /* Action Buttons */
        .carnate-cart-page .actions-row {
            display: flex;
            align-items: center;
            gap: 6px;
            flex-wrap: nowrap;
        }

        .carnate-cart-page .act-btn {
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
            text-decoration: none;
        }

        .carnate-cart-page .act-success {
            background: var(--sl-green-soft);
            color: var(--sl-green);
            border-color: var(--sl-green-border);
        }

        .carnate-cart-page .act-success:hover {
            background: var(--sl-green);
            color: #fff;
        }

        .carnate-cart-page .act-cancel {
            background: var(--sl-red-soft);
            color: var(--sl-red);
            border-color: var(--sl-red-border);
        }

        .carnate-cart-page .act-cancel:hover {
            background: var(--sl-red);
            color: #fff;
        }

        .carnate-cart-page .act-delete {
            width: 32px;
            height: 32px;
            padding: 0;
            background: #fff;
            color: #94a3b8;
            border: 1px solid var(--sl-border);
        }

        .carnate-cart-page .act-delete:hover {
            background: var(--sl-red-soft);
            color: var(--sl-red);
            border-color: var(--sl-red-border);
        }

        .carnate-cart-page .select-pay-checkbox {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: var(--sl-red);
        }

        /* Bottom Footer Bars */
        .carnate-cart-page .cart-bottom-bar {
            padding: 16px 24px;
            background: #fafbfc;
            border-top: 1px solid var(--sl-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
        }

        .carnate-cart-page .bottom-bar-info {
            display: flex;
            align-items: baseline;
            gap: 8px;
        }

        .carnate-cart-page .info-label {
            font-size: 13px;
            font-weight: 600;
            color: var(--sl-muted);
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        .carnate-cart-page .info-val {
            font-size: 20px;
            font-weight: 800;
            color: var(--sl-text);
        }

        .carnate-cart-page .btn-confirm-action {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 11px 26px;
            border-radius: 10px;
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: #fff;
            border: none;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            box-shadow: 0 4px 14px rgba(239, 68, 68, 0.28);
            transition: all .2s ease;
        }

        .carnate-cart-page .btn-confirm-action:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(239, 68, 68, 0.38);
            color: #fff;
        }

        /* Pay Now Bar */
        .carnate-cart-page .pay-footer-bar {
            padding: 14px 22px;
            background: #f8fafc;
            border-top: 1px solid var(--sl-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
        }

        .carnate-cart-page .check-all-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            font-weight: 600;
            color: var(--sl-text);
            cursor: pointer;
            user-select: none;
        }

        .carnate-cart-page .btn-pay-now {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 20px;
            border-radius: 10px;
            background: var(--sl-blue);
            color: #fff;
            border: none;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: all .2s ease;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.22);
        }

        .carnate-cart-page .btn-pay-now:hover:not(:disabled) {
            background: #1d4ed8;
            transform: translateY(-1px);
        }

        .carnate-cart-page .btn-pay-now:disabled {
            opacity: .6;
            cursor: not-allowed;
        }

        /* Modern Modals */
        .carnate-cart-page .modern-modal {
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

        .carnate-cart-page .modern-modal-dialog {
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

        .carnate-cart-page .modal-head {
            padding: 18px 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid var(--sl-border);
            background: #ffffff;
        }

        .carnate-cart-page .modal-title-wrap {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .carnate-cart-page .modal-icon-badge {
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

        .carnate-cart-page .modal-title-text {
            font-size: 16px;
            font-weight: 700;
            color: var(--sl-text);
            margin: 0;
        }

        .carnate-cart-page .modal-close-btn {
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

        .carnate-cart-page .modal-close-btn:hover {
            background: var(--sl-red-soft);
            color: var(--sl-red);
        }

        .carnate-cart-page .modal-inner-body {
            padding: 20px 22px;
        }

        .carnate-cart-page .modal-foot {
            padding: 14px 22px;
            background: #fafbfc;
            border-top: 1px solid var(--sl-border);
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
        }

        .carnate-cart-page .btn-modal-close {
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

        .carnate-cart-page .btn-modal-close:hover {
            background: #f1f5f9;
            color: var(--sl-text);
        }

        .carnate-cart-page .btn-modal-submit {
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

        .carnate-cart-page .btn-modal-submit:hover {
            background: var(--sl-red-dark);
        }

        .carnate-cart-page .reason-display-box {
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

        .carnate-cart-page .reason-display-box:focus {
            outline: none;
            border-color: var(--sl-red);
            background: #fff;
        }

        /* Empty State */
        .carnate-cart-page .empty-state-card {
            padding: 60px 20px;
            text-align: center;
            background: #fff;
            border-radius: 16px;
            border: 1px solid var(--sl-border);
        }

        .carnate-cart-page .empty-icon {
            font-size: 48px;
            color: #cbd5e1;
            margin-bottom: 12px;
        }

        .carnate-cart-page .empty-title {
            font-size: 17px;
            font-weight: 700;
            color: var(--sl-text);
            margin: 0 0 6px;
        }

        .carnate-cart-page .empty-sub {
            font-size: 13px;
            color: var(--sl-muted);
            margin-bottom: 20px;
        }
    </style>

    {{-- =========================================================
         IMAGE MODAL
    ========================================================== --}}
    @if ($shoImageModel)
        <div class="modern-modal">
            <div class="modern-modal-dialog" style="max-width: 480px;">
                <div class="modal-head">
                    <div class="modal-title-wrap">
                        <div class="modal-icon-badge">
                            <i class="bx bx-image"></i>
                        </div>
                        <h4 class="modal-title-text">{{ $imageitem?->SpareParts?->name ?? 'Part Image' }}</h4>
                    </div>
                    <button type="button" class="modal-close-btn" wire:click="clodeImageModel">
                        <i class="bx bx-x"></i>
                    </button>
                </div>
                <div class="modal-inner-body text-center p-4">
                    @if (!empty($imageitem?->SpareParts?->Image?->file) && file_exists(public_path($imageitem->SpareParts->Image->file)))
                        <img src="{{ asset($imageitem->SpareParts->Image->file) }}"
                            alt="{{ $imageitem->SpareParts->name ?? 'Part Image' }}"
                            style="max-width: 100%; max-height: 360px; object-fit: contain; border-radius: 12px; box-shadow: 0 4px 16px rgba(0,0,0,0.08);">
                    @else
                        <div class="p-5 text-center text-muted" style="background: #f8fafc; border-radius: 12px; border: 1px dashed var(--sl-border);">
                            <i class="bx bx-image-alt" style="font-size: 48px; color: #cbd5e1;"></i>
                            <p class="mt-2 mb-0" style="font-size: 13px;">No image available for this product</p>
                        </div>
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
                            <h4 class="modal-title-text">{{ $statusReason ?: 'Reason' }}</h4>
                        </div>
                        <button type="button" class="modal-close-btn" wire:click="clodeReasonModel">
                            <i class="bx bx-x"></i>
                        </button>
                    </div>

                    <div class="modal-inner-body">
                        @csrf
                        <label class="form-label mb-2 fw-semibold" style="font-size: 13px; color: var(--sl-text);">
                            {{ $statusReason ?: 'Reason' }} @if (empty($decline_reason))<sup class="text-danger">*</sup>@endif
                        </label>
                        <textarea wire:model="decline_reason" class="reason-display-box" rows="4"
                            @if (!empty($decline_reason) && in_array($statusReason, ['Delayed', 'Decline'])) readonly @endif
                            placeholder="Enter Reason..."></textarea>
                        @error('decline_reason')
                            <span class="text-danger error d-block mt-1" style="font-size: 12px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="modal-foot">
                        @if (!empty($decline_reason) && in_array($statusReason, ['Delayed', 'Decline']))
                            <button type="button" class="btn-modal-close" wire:click="clodeReasonModel">Close</button>
                        @else
                            <button type="button" class="btn-modal-close" wire:click="clodeReasonModel">Cancel</button>
                            <button type="submit" class="btn-modal-submit">
                                Submit
                                <i class="spinner-border spinner-border-sm" wire:loading></i>
                            </button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    @endif

    {{-- =========================================================
         PAGE HEADER
    ========================================================== --}}
    <div class="page-card">
        <div class="page-header-wrap">
            <div class="header-left">
                <div class="page-icon-box">
                    <i class="bx bx-cart-alt"></i>
                </div>
                <div>
                    <h2 class="page-title">Cart Items</h2>
                    <p class="page-subtitle">Review items, verify pricing and confirm your purchase order</p>
                </div>
            </div>
            <div class="header-right">
                <a href="{{ route('workshop.vehicle_search') }}" class="btn-back">
                    <i class="bx bx-arrow-back"></i> Back
                </a>
            </div>
        </div>
    </div>

    {{-- =========================================================
         CART ITEMS TABLE CARD
    ========================================================== --}}
    @if (!empty($order_items) && count($order_items))
        <div class="table-card">
            <div class="table-card-header">
                <div class="d-flex align-items-center gap-2">
                    <i class="bx bx-list-check" style="color: var(--sl-red); font-size: 20px;"></i>
                    <span class="table-title">Ordered Items</span>
                </div>
                <span class="count-pill">{{ count($order_items) }} {{ count($order_items) == 1 ? 'Item' : 'Items' }}</span>
            </div>

            <div class="table-responsive">
                <table class="carnate-table">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 50px;">#</th>
                            <th>Item Details</th>
                            <th>Category</th>
                            <th>Rack No.</th>
                            <th>Part Number</th>
                            <th class="text-center">Qty</th>
                            <th>Price</th>
                            <th>GST Rate</th>
                            <th>GST Amount</th>
                            <th>Total Amount</th>
                            <th>Payment Status</th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $visible = false;
                        @endphp
                        @foreach ($order_items as $index => $order_item)
                            @php
                                $orderId = $order_item->order_id;
                                $is_confim = $order_item->order?->is_confim ?? ($order->is_confim ?? 0);

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
                                <td class="text-center text-muted fw-semibold">{{ $loop->iteration }}</td>

                                <td>
                                    <div class="item-cell">
                                        <div class="item-thumb-box" wire:click="shoImage({{ $order_item->id }})" title="View image">
                                            @if (!empty($order_item->SpareParts?->Image?->file) && file_exists(public_path($order_item->SpareParts->Image->file)))
                                                <img src="{{ asset($order_item->SpareParts->Image->file) }}" alt="{{ $order_item->SpareParts->name ?? 'Part' }}">
                                            @else
                                                <div class="item-thumb-placeholder">
                                                    <i class="bx bx-cog"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="item-name-text">{{ $order_item?->SpareParts?->name ?? 'Spare Part #' . $order_item->id }}</div>
                                            @if (!empty($order_item?->SpareParts?->brand))
                                                <div class="item-brand-text">{{ $order_item->SpareParts->brand }}</div>
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
                                            @default -
                                        @endswitch
                                    </span>
                                </td>

                                <td>
                                    <span class="text-muted fw-medium">{{ $order_item->SpareParts?->rack_no ?: '-' }}</span>
                                </td>

                                <td>
                                    @if (!empty($order_item->SpareParts?->part_number))
                                        <span class="part-number-badge">{{ $order_item->SpareParts->part_number }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>

                                <td class="text-center">
                                    <span class="qty-pill">{{ $order_item->quantity }}</span>
                                </td>

                                <td>
                                    <span class="price-num">₹ {{ number_format($taxableVal, 2) }}</span>
                                </td>

                                <td>
                                    <span class="fw-semibold">{{ $order_item->SpareParts?->tax_percentage ?? 0 }}%</span>
                                    <br>
                                    <small class="text-muted" style="font-size: 11px;">
                                        ({{ ucfirst($order_item->SpareParts?->tax_type ?? 'include') }})
                                    </small>
                                </td>

                                <td>
                                    <span class="price-num">₹ {{ number_format($gstVal, 2) }}</span>
                                </td>

                                <td>
                                    <span class="total-num">₹ {{ number_format($payableVal, 2) }}</span>
                                </td>

                                <td>
                                    @if ($order_item->payment_status == 0)
                                        <span class="status-pill pill-warning" data-bs-toggle="tooltip" title="Payment pending">Pending</span>
                                    @elseif($order_item->payment_status == 1)
                                        <span class="status-pill pill-success" data-bs-toggle="tooltip" title="Payment completed">Paid</span>
                                    @endif
                                </td>

                                <td>
                                    @if ($order_item->status == 0)
                                        <span class="status-pill pill-warning" data-bs-toggle="tooltip" title="Awaiting vendor response">Pending</span>
                                    @elseif($order_item->status == 1)
                                        <span class="status-pill pill-success" data-bs-toggle="tooltip" title="Accepted by vendor">Accepted</span>
                                    @elseif($order_item->status == 2)
                                        <div>
                                            <span class="status-pill pill-danger" data-bs-toggle="tooltip" title="Declined by vendor">Declined</span>
                                            <a class="view-reason-btn" href="javascript:void(0);" wire:click="showdeclineorder({{ $order_item->id }}, 2)">
                                                <i class="bx bx-info-circle"></i> View Reason
                                            </a>
                                        </div>
                                    @elseif($order_item->status == 3)
                                        <span class="status-pill pill-purple" data-bs-toggle="tooltip" title="Items handed over">Handover</span>
                                    @elseif($order_item->status == 4)
                                        <span class="status-pill pill-success" data-bs-toggle="tooltip" title="Received by workshop">Received</span>
                                    @elseif($order_item->status == 5)
                                        <div>
                                            <span class="status-pill pill-info" data-bs-toggle="tooltip" title="Delivery delayed">Delayed</span>
                                            <a class="view-reason-btn" href="javascript:void(0);" wire:click="showdeclineorder({{ $order_item->id }}, 5)">
                                                <i class="bx bx-info-circle"></i> View Reason
                                            </a>
                                        </div>
                                    @endif
                                </td>

                                <td>
                                    <div class="actions-row justify-content-center">
                                        @if ($order_item->status == 5)
                                            <button type="button" wire:click="changeItemStatus({{ $order_item->id }}, 1)" class="act-btn act-success" title="Accept delayed delivery">
                                                <i class="bx bx-check"></i> Accept
                                            </button>
                                            <button type="button" wire:click="showdeclineorder({{ $order_item->id }}, 2)" class="act-btn act-cancel" title="Cancel item">
                                                <i class="bx bx-x"></i> Cancel
                                            </button>
                                        @endif

                                        @if ($order_item->status == 3 && $order_item->payment_status == 1)
                                            <button type="button" wire:click="received({{ $order_item->id }}, 4)" class="act-btn act-success" title="Mark as received">
                                                <i class="bx bx-check-circle"></i> Received
                                            </button>
                                        @endif

                                        @if ($order_item->status == 1 && $order_item->payment_status == 0)
                                            <input class="form-check-input select-pay-checkbox" type="checkbox"
                                                @if ($checked) checked @endif
                                                wire:click="toggleCheckbox({{ $order_item->id }}, {{ $order_item->total_amount }}, $event.target.checked)"
                                                title="Select to pay">
                                            @php $visible = true; @endphp
                                        @endif

                                        @if (($is_confim ?? 0) == 0)
                                            <button type="button" wire:click="confirmDelete({{ $order_item->id }})" class="act-btn act-delete" title="Remove item">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pay Now Bar --}}
            @if ($totalPayabaleAmount > 0 || $visible)
                <div class="pay-footer-bar">
                    <div>
                        @if ($visible)
                            <label class="check-all-label">
                                <input class="form-check-input select-pay-checkbox" type="checkbox"
                                    wire:click="toggleCheckboxAll($event.target.checked, '{{ $order->id ?? $orderItemId }}')">
                                <span>Select All to Pay</span>
                            </label>
                        @endif
                    </div>
                    <div>
                        @if ($totalPayabaleAmount > 0)
                            <button type="button" class="btn-pay-now"
                                @if (!$visible) disabled @endif
                                wire:click="createOrder('{{ $order->id ?? $orderItemId }}', '{{ $totalPayabaleAmount }}')">
                                <i class="bx bx-credit-card"></i> Pay Now (₹{{ number_format($totalPayabaleAmount, 2) }})
                            </button>
                        @endif
                    </div>
                </div>
            @endif

            {{-- Cart Bottom Bar (Confirm Order) --}}
            @if (($order->is_confim ?? $is_confim ?? 0) == 0)
                <div class="cart-bottom-bar">
                    <div class="bottom-bar-info">
                        <span class="info-label">Total Amount:</span>
                        <span class="info-val">₹ {{ number_format($order_items->sum(function($item) {
                            $tax_type = $item->SpareParts?->tax_type ?? 'include';
                            $tax_percentage = (float)($item->SpareParts?->tax_percentage ?? 0);
                            $total_amount = (float)$item->total_amount;
                            if ($tax_type === 'include') {
                                return $total_amount;
                            } else {
                                return $total_amount + ($total_amount * ($tax_percentage / 100));
                            }
                        }), 2) }}</span>
                    </div>
                    <button type="button" wire:click="confirmOrder({{ $order->id ?? $orderItemId }})" class="btn-confirm-action">
                        <i class="bx bx-check-double"></i> Confirm Order
                    </button>
                </div>
            @endif
        </div>
    @else
        <div class="empty-state-card">
            <i class="bx bx-cart empty-icon"></i>
            <h4 class="empty-title">Your Cart is Empty</h4>
            <p class="empty-sub">There are no items currently in this cart order.</p>
            <a href="{{ route('workshop.vehicle_search') }}" class="btn-back">
                <i class="bx bx-arrow-back"></i> Browse Spare Parts
            </a>
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
                    "color": "#ef4444"
                }
            };

            var rzp1 = new Razorpay(options);
            rzp1.open();
            event.preventDefault();
        });
    </script>
@endsection
