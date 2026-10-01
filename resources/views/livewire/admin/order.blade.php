<div class="carnate-order-page">

    <style>
        .carnate-order-page {
            --co-bg: #f7f8fa;
            --co-card: #ffffff;
            --co-text: #111827;
            --co-muted: #64748b;
            --co-border: #e2e8f0;
            --co-red: #e53935;
            --co-red-dark: #c92f2c;
            --co-red-soft: #fff5f5;
            --co-green: #16a34a;
            --co-green-soft: #f0fdf4;
            --co-yellow: #d97706;
            --co-yellow-soft: #fffbeb;
            --co-blue: #2563eb;
            --co-blue-soft: #eff6ff;
            --co-info: #0891b2;
            --co-info-soft: #ecfeff;
        }

        .carnate-order-page .co-card {
            background: var(--co-card);
            border: 1px solid var(--co-border);
            border-radius: 16px;
            box-shadow: 0 4px 18px rgba(15, 23, 42, .04);
        }

        /* Page Header */
        .carnate-order-page .co-header {
            padding: 20px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .carnate-order-page .co-title-wrap {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .carnate-order-page .co-title-icon {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            background: var(--co-red-soft);
            color: var(--co-red);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 21px;
        }

        .carnate-order-page .co-title {
            margin: 0;
            color: var(--co-text);
            font-size: 20px;
            line-height: 1.3;
            font-weight: 700;
        }

        .carnate-order-page .co-subtitle {
            margin: 4px 0 0;
            color: var(--co-muted);
            font-size: 13px;
        }

        /* Filter */
        .carnate-order-page .co-filter {
            margin-top: 16px;
            padding: 18px 20px;
        }

        .carnate-order-page .co-filter-row {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .carnate-order-page .co-search,
        .carnate-order-page .co-date {
            position: relative;
        }

        .carnate-order-page .co-search {
            width: 290px;
        }

        .carnate-order-page .co-date {
            width: 250px;
        }

        .carnate-order-page .co-search i,
        .carnate-order-page .co-date i {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 18px;
            z-index: 2;
        }

        .carnate-order-page .co-search input,
        .carnate-order-page .co-date input {
            height: 44px;
            padding-left: 40px;
            border: 1px solid var(--co-border);
            border-radius: 10px;
            color: var(--co-text);
            box-shadow: none;
            font-size: 14px;
            background: #fff;
        }

        .carnate-order-page .co-search input:focus,
        .carnate-order-page .co-date input:focus {
            border-color: rgba(229, 57, 53, .45);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .08);
        }

        .carnate-order-page .co-clear {
            height: 44px;
            padding: 0 17px;
            border: 1px solid var(--co-border);
            border-radius: 10px;
            background: #fff;
            color: var(--co-muted);
            font-size: 14px;
            font-weight: 600;
        }

        .carnate-order-page .co-clear:hover {
            background: #f8fafc;
            color: var(--co-text);
        }

        /* Table */
        .carnate-order-page .co-table-card {
            margin-top: 16px;
            overflow: hidden;
        }

        .carnate-order-page .co-table-wrap {
            overflow-x: auto;
        }

        .carnate-order-page .co-table {
            width: 100%;
            min-width: 1250px;
            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .carnate-order-page .co-table thead th {
            padding: 15px 14px;
            background: #f8fafc;
            color: #64748b;
            border-bottom: 1px solid var(--co-border);
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .035em;
            white-space: nowrap;
            vertical-align: middle;
        }

        .carnate-order-page .co-table tbody td {
            padding: 14px;
            border-bottom: 1px solid #edf1f5;
            color: #334155;
            font-size: 13px;
            vertical-align: middle;
            background: #fff;
        }

        .carnate-order-page .co-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .carnate-order-page .co-table tbody tr:hover td {
            background: #fafbfc;
        }

        .carnate-order-page .co-order-id {
            color: var(--co-text);
            font-weight: 700;
            white-space: nowrap;
        }

        .carnate-order-page .co-items {
            max-width: 190px;
            color: #475569;
            line-height: 1.45;
        }

        .carnate-order-page .co-date-value {
            white-space: nowrap;
            color: #475569;
        }

        .carnate-order-page .co-date-value strong {
            color: var(--co-text);
            font-weight: 600;
        }

        .carnate-order-page .co-amount {
            color: var(--co-text);
            font-weight: 700;
            white-space: nowrap;
        }

        .carnate-order-page .co-count {
            display: inline-flex;
            min-width: 30px;
            height: 28px;
            padding: 0 8px;
            border-radius: 7px;
            align-items: center;
            justify-content: center;
            background: #f1f5f9;
            color: #475569;
            font-size: 12px;
            font-weight: 700;
        }

        /* Status */
        .carnate-order-page .co-status {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            min-width: 78px;
            padding: 5px 9px;
            border-radius: 7px;
            font-size: 11px;
            line-height: 1.25;
            font-weight: 700;
            text-align: center;
        }

        .carnate-order-page .co-status-pending {
            background: var(--co-yellow-soft);
            color: #b45309;
        }

        .carnate-order-page .co-status-success {
            background: var(--co-green-soft);
            color: #15803d;
        }

        .carnate-order-page .co-status-danger {
            background: #fef2f2;
            color: #dc2626;
        }

        .carnate-order-page .co-status-blue {
            background: var(--co-blue-soft);
            color: #2563eb;
        }

        .carnate-order-page .co-status-info {
            background: var(--co-info-soft);
            color: #0e7490;
        }

        /* Actions */
        .carnate-order-page .co-actions {
            display: flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
        }

        .carnate-order-page .co-action {
            height: 32px;
            padding: 0 10px;
            border-radius: 8px;
            border: 1px solid var(--co-border);
            background: #fff;
            color: #475569;
            font-size: 12px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            cursor: pointer;
            transition: .2s ease;
        }

        .carnate-order-page .co-action:hover {
            background: var(--co-red-soft);
            border-color: rgba(229, 57, 53, .25);
            color: var(--co-red);
        }

        .carnate-order-page .co-action-invoice {
            background: #f8fafc;
        }

        .carnate-order-page .co-pagination {
            padding: 17px 20px;
            border-top: 1px solid var(--co-border);
        }

        /* Empty */
        .carnate-order-page .co-empty {
            padding: 55px 20px;
            text-align: center;
        }

        .carnate-order-page .co-empty-icon {
            width: 58px;
            height: 58px;
            margin: 0 auto 13px;
            border-radius: 15px;
            background: #f1f5f9;
            color: #94a3b8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 25px;
        }

        .carnate-order-page .co-empty-title {
            color: var(--co-text);
            font-size: 15px;
            font-weight: 700;
        }

        .carnate-order-page .co-empty-text {
            margin-top: 5px;
            color: var(--co-muted);
            font-size: 13px;
        }

        /* Detail Page */
        .carnate-order-page .co-detail-header {
            padding: 18px 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .carnate-order-page .co-detail-title {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--co-text);
            font-size: 18px;
            font-weight: 700;
        }

        .carnate-order-page .co-detail-title i {
            color: var(--co-red);
        }

        .carnate-order-page .co-back {
            min-height: 40px;
            padding: 0 15px;
            border-radius: 9px;
            background: #fff;
            border: 1px solid var(--co-border);
            color: #475569;
            font-size: 13px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 7px;
        }

        .carnate-order-page .co-back:hover {
            color: var(--co-red);
            background: var(--co-red-soft);
            border-color: rgba(229, 57, 53, .2);
        }

        .carnate-order-page .co-vendor-card {
            height: 100%;
            overflow: hidden;
        }

        .carnate-order-page .co-vendor-header {
            padding: 16px 20px;
            border-bottom: 1px solid var(--co-border);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .carnate-order-page .co-vendor-header-icon {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            background: var(--co-red-soft);
            color: var(--co-red);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .carnate-order-page .co-vendor-header h5 {
            margin: 0;
            color: var(--co-text);
            font-size: 15px;
            font-weight: 700;
        }

        .carnate-order-page .co-vendor-body {
            padding: 18px 20px;
        }

        .carnate-order-page .co-vendor-info {
            width: 100%;
            margin: 0;
        }

        .carnate-order-page .co-vendor-info tr {
            border-bottom: 1px solid #edf1f5;
        }

        .carnate-order-page .co-vendor-info tr:last-child {
            border-bottom: 0;
        }

        .carnate-order-page .co-vendor-info th {
            width: 150px;
            padding: 12px 0;
            color: var(--co-muted);
            font-size: 12px;
            font-weight: 600;
            vertical-align: top;
        }

        .carnate-order-page .co-vendor-info td {
            padding: 12px 0;
            color: var(--co-text);
            font-size: 13px;
            vertical-align: top;
        }

        .carnate-order-page .co-colon {
            width: 15px !important;
            color: #cbd5e1 !important;
        }

        /* Order Item Table */
        .carnate-order-page .co-item-image {
            width: 48px;
            height: 48px;
            border-radius: 9px;
            object-fit: cover;
            border: 1px solid var(--co-border);
            display: inline-block;
            vertical-align: middle;
            margin-right: 8px;
            cursor: pointer;
        }

        .carnate-order-page .co-item-name {
            color: var(--co-text);
            font-weight: 600;
        }

        .carnate-order-page .co-tax {
            color: #475569;
        }

        /* Modal */
        .carnate-order-page .co-modal-backdrop {
            position: fixed;
            inset: 0;
            z-index: 1055;
            padding: 20px;
            background: rgba(15, 23, 42, .55);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow-y: auto;
        }

        .carnate-order-page .co-modal {
            width: 100%;
            max-width: 520px;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 24px 70px rgba(15, 23, 42, .20);
            overflow: hidden;
        }

        .carnate-order-page .co-modal-xl {
            max-width: 720px;
        }

        .carnate-order-page .co-modal-header {
            padding: 18px 22px;
            border-bottom: 1px solid var(--co-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .carnate-order-page .co-modal-title {
            margin: 0;
            color: var(--co-text);
            font-size: 17px;
            font-weight: 700;
        }

        .carnate-order-page .co-modal-close {
            width: 35px;
            height: 35px;
            border: 0;
            border-radius: 9px;
            background: #f8fafc;
            color: #64748b;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 19px;
        }

        .carnate-order-page .co-modal-body {
            padding: 22px;
            max-height: calc(100vh - 180px);
            overflow-y: auto;
        }

        .carnate-order-page .co-modal-footer {
            padding: 15px 22px;
            border-top: 1px solid var(--co-border);
            display: flex;
            justify-content: flex-end;
            gap: 9px;
        }

        .carnate-order-page .co-modal-secondary {
            min-height: 40px;
            padding: 0 15px;
            border: 1px solid var(--co-border);
            border-radius: 9px;
            background: #fff;
            color: #475569;
            font-size: 13px;
            font-weight: 600;
        }

        .carnate-order-page .co-modal-primary {
            min-height: 40px;
            padding: 0 16px;
            border: 0;
            border-radius: 9px;
            background: var(--co-red);
            color: #fff;
            font-size: 13px;
            font-weight: 600;
        }

        .carnate-order-page .co-modal-primary:hover {
            background: var(--co-red-dark);
        }

        .carnate-order-page .co-image-preview {
            width: 100%;
            max-height: 520px;
            object-fit: contain;
            border-radius: 10px;
            background: #f8fafc;
            border: 1px solid var(--co-border);
        }

        .carnate-order-page .co-radio-group {
            display: flex;
            justify-content: center;
            gap: 25px;
            padding-bottom: 18px;
            border-bottom: 1px solid var(--co-border);
            margin-bottom: 18px;
        }

        .carnate-order-page .co-radio-group .form-check {
            margin: 0;
        }

        .carnate-order-page .co-radio-group .form-check-input:checked {
            background-color: var(--co-red);
            border-color: var(--co-red);
        }

        .carnate-order-page .co-invoice-table {
            width: 100%;
            margin: 0;
        }

        .carnate-order-page .co-invoice-table th,
        .carnate-order-page .co-invoice-table td {
            padding: 11px;
            border-bottom: 1px solid #edf1f5;
            font-size: 13px;
        }

        .carnate-order-page .co-invoice-table th {
            color: var(--co-muted);
            font-weight: 600;
        }

        .carnate-order-page .co-invoice-btn {
            width: 34px;
            height: 34px;
            border: 1px solid var(--co-border);
            border-radius: 8px;
            background: #fff;
            color: #475569;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .carnate-order-page .co-invoice-btn:hover {
            color: var(--co-red);
            background: var(--co-red-soft);
            border-color: rgba(229, 57, 53, .2);
        }

        .carnate-order-page .co-reason-label {
            color: #334155;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 7px;
        }

        .carnate-order-page .co-reason-input {
            min-height: 110px;
            resize: vertical;
            border: 1px solid var(--co-border);
            border-radius: 10px;
        }

        .carnate-order-page .co-reason-input:focus {
            border-color: rgba(229, 57, 53, .45);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .08);
        }

        @media (max-width: 767px) {
            .carnate-order-page .co-filter-row {
                flex-direction: column;
                align-items: stretch;
            }

            .carnate-order-page .co-search,
            .carnate-order-page .co-date {
                width: 100%;
            }

            .carnate-order-page .co-clear {
                width: 100%;
            }

            .carnate-order-page .co-header,
            .carnate-order-page .co-detail-header {
                align-items: flex-start;
                flex-direction: column;
                gap: 15px;
            }

            .carnate-order-page .co-back {
                width: 100%;
                justify-content: center;
            }

            .carnate-order-page .co-modal-backdrop {
                padding: 10px;
                align-items: flex-start;
            }

            .carnate-order-page .co-modal-body {
                padding: 16px;
            }

            .carnate-order-page .co-radio-group {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>


    {{-- =========================================================
        IMAGE MODAL
    ========================================================== --}}
    @if ($shoImageModel)
        <div class="co-modal-backdrop">

            <div class="co-modal">

                <div class="co-modal-header">
                    <h4 class="co-modal-title">
                        <i class="bx bx-image me-2" style="color:#e53935;"></i>
                        Spare Part Image
                    </h4>

                    <button type="button"
                        class="co-modal-close"
                        wire:click="clodeImageModel">
                        <i class="bx bx-x"></i>
                    </button>
                </div>

                <div class="co-modal-body">

                    @if (!empty($imageitem))

                        @if (!empty($imageitem->SpareParts->Image->file))

                            <img src="{{ asset($imageitem->SpareParts->Image->file) }}"
                                alt="Maintenance Service Parts"
                                class="co-image-preview">

                        @else

                            @if ($imageitem->SpareParts->spare_part_type == 1)

                                <img src="{{ asset('img/accessory.png') }}"
                                    alt="Maintenance Service Parts"
                                    class="co-image-preview">

                            @elseif($imageitem->SpareParts->spare_part_type == 2)

                                <img src="{{ asset('img/spareparts.jpg') }}"
                                    alt="Maintenance Service Parts"
                                    class="co-image-preview">

                            @elseif($imageitem->SpareParts->spare_part_type == 3)

                                <img src="{{ asset('img/tools.jpg') }}"
                                    alt="Maintenance Service Parts"
                                    class="co-image-preview">

                            @else

                                <img src="{{ asset('img/lubricant.jpg') }}"
                                    alt="Maintenance Service Parts"
                                    class="co-image-preview">

                            @endif

                        @endif

                    @endif

                </div>

            </div>

        </div>
    @endif


    {{-- =========================================================
        DECLINE REASON MODAL
    ========================================================== --}}
    @if ($showReasonModel)
        <div class="co-modal-backdrop">

            <div class="co-modal co-modal-xl">

                <form wire:submit.prevent="declinereasonStore">

                    <div class="co-modal-header">

                        <h4 class="co-modal-title">
                            <i class="bx bx-message-square-error me-2"
                                style="color:#e53935;"></i>
                            Decline Reason
                        </h4>

                        <button type="button"
                            class="co-modal-close"
                            wire:click="$set('showReasonModel', false)">
                            <i class="bx bx-x"></i>
                        </button>

                    </div>

                    <div class="co-modal-body">

                        @csrf

                        <label class="co-reason-label">
                            Decline Reason <span class="text-danger">*</span>
                        </label>

                        <textarea wire:model="decline_reason"
                            class="form-control co-reason-input"
                            rows="4"
                            placeholder="Enter reason"></textarea>

                        @error('decline_reason')
                            <span class="text-danger small d-block mt-1">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>

                    @if (empty($decline_reason))
                        <div class="co-modal-footer">

                            <button type="button"
                                class="co-modal-secondary"
                                wire:click="$set('showReasonModel', false)">
                                Cancel
                            </button>

                            <button type="submit"
                                class="co-modal-primary">

                                Create

                                <i class="spinner-border spinner-border-sm ms-1"
                                    wire:loading></i>

                            </button>

                        </div>
                    @endif

                </form>

            </div>

        </div>
    @endif


    {{-- =========================================================
        INVOICE MODAL
    ========================================================== --}}
    @if ($showInvoiceModal)
        <div class="co-modal-backdrop">

            <div class="co-modal">

                <div class="co-modal-header">

                    <h4 class="co-modal-title">
                        <i class="bx bx-receipt me-2"
                            style="color:#e53935;"></i>
                        Invoice
                    </h4>

                    <button type="button"
                        class="co-modal-close"
                        wire:click="closeInvoiceModal">
                        <i class="bx bx-x"></i>
                    </button>

                </div>

                <div class="co-modal-body">

                    <div class="co-radio-group">

                        <div class="form-check">
                            <input class="form-check-input"
                                type="radio"
                                wire:model.live="invoiceType"
                                id="workshop"
                                value="0">

                            <label class="form-check-label"
                                for="workshop">
                                Workshop Invoice
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input"
                                type="radio"
                                wire:model.live="invoiceType"
                                id="sparePart"
                                value="1">

                            <label class="form-check-label"
                                for="sparePart">
                                Spare Part Invoice
                            </label>
                        </div>

                    </div>


                    @if ($spareInvoice)

                        <table class="co-invoice-table">

                            <tbody>

                                @foreach ($sparePartVendor as $spId => $spName)

                                    <tr>

                                        <th style="width:45px;">
                                            {{ $loop->iteration }}
                                        </th>

                                        <td>
                                            {{ $spName }}
                                        </td>

                                        <td style="width:45px;">

                                            <a class="co-invoice-btn"
                                                wire:click="sparePartInvoice({{ $spId }},0)"
                                                href="javascript:void(0)"
                                                title="Download PDF">

                                                <i class="fa fa-file-pdf"></i>

                                            </a>

                                        </td>

                                        <td style="width:45px;">

                                            <a class="co-invoice-btn"
                                                wire:click="sparePartInvoice({{ $spId }},1)"
                                                href="javascript:void(0)"
                                                title="Print">

                                                <i class="fa fa-print"></i>

                                            </a>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    @else

                        <div class="d-flex justify-content-center gap-2">

                            <a class="co-invoice-btn"
                                href="{{ route('getWorkshopinvoPdf', [encrypt($invoiceId), encrypt(0)]) }}"
                                target="_blank"
                                title="Download PDF">

                                <i class="fa fa-file-pdf"></i>

                            </a>

                            <a class="co-invoice-btn"
                                href="{{ route('getWorkshopinvoPdf', [encrypt($invoiceId), encrypt(1)]) }}"
                                target="_blank"
                                title="Print">

                                <i class="fa fa-print"></i>

                            </a>

                        </div>

                    @endif

                </div>

                <div class="co-modal-footer">

                    <button type="button"
                        class="co-modal-secondary"
                        wire:click="closeInvoiceModal">

                        Cancel

                    </button>

                </div>

            </div>

        </div>
    @endif


    {{-- =========================================================
        ORDER DETAIL
    ========================================================== --}}
    @if ($showOrderItem)

        {{-- Detail Header --}}
        <div class="co-card co-detail-header">

            <div class="co-detail-title">
                <i class="bx bx-package"></i>
                Order Item #{{ $this->orderId }}
            </div>

            <a href="javascript:void(0);"
                wire:click="back"
                class="co-back">

                <i class="bx bx-arrow-back"></i>
                Back to Orders

            </a>

        </div>


        {{-- Vendor Details --}}
        <div class="row g-3 mt-1">

            {{-- Workshop Vendor --}}
            <div class="col-md-6">

                <div class="co-card co-vendor-card">

                    <div class="co-vendor-header">

                        <div class="co-vendor-header-icon">
                            <i class="bx bx-store"></i>
                        </div>

                        <h5>Workshop Vendor Detail</h5>

                    </div>

                    <div class="co-vendor-body">

                        <table class="co-vendor-info">

                            <tbody>

                                <tr>
                                    <th>Name</th>
                                    <td class="co-colon">:</td>
                                    <td>
                                        {{ ucfirst(($orders->workShopVendor->name ?? '') . ' ' . ($orders->workShopVendor->lastname ?? '')) }}
                                    </td>
                                </tr>

                                <tr>
                                    <th>Company Name</th>
                                    <td class="co-colon">:</td>
                                    <td>
                                        {{ $orders->workShopVendor->company_name ?? '-' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th>Mobile Number</th>
                                    <td class="co-colon">:</td>
                                    <td>
                                        {{ $orders->workShopVendor->mobile_no ?? '-' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th>GST Number</th>
                                    <td class="co-colon">:</td>
                                    <td>
                                        {{ $orders->workShopVendor->gst ?? '-' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th>Address</th>
                                    <td class="co-colon">:</td>
                                    <td>
                                        {{ $orders->workShopVendor->address ?? '-' }}
                                    </td>
                                </tr>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>


            {{-- Spare Part Vendor --}}
            <div class="col-md-6">

                @php
                    $spVendor = optional($orders->orderItem->first())->sparePartVendor;
                @endphp

                <div class="co-card co-vendor-card">

                    <div class="co-vendor-header">

                        <div class="co-vendor-header-icon">
                            <i class="bx bx-cog"></i>
                        </div>

                        <h5>Spare Part Vendor Detail</h5>

                    </div>

                    <div class="co-vendor-body">

                        <table class="co-vendor-info">

                            <tbody>

                                <tr>
                                    <th>Name</th>
                                    <td class="co-colon">:</td>
                                    <td>
                                        {{ ucfirst(($spVendor->name ?? '') . ' ' . ($spVendor->lastname ?? '')) }}
                                    </td>
                                </tr>

                                <tr>
                                    <th>Company Name</th>
                                    <td class="co-colon">:</td>
                                    <td>
                                        {{ $spVendor->company_name ?? '-' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th>Mobile Number</th>
                                    <td class="co-colon">:</td>
                                    <td>
                                        {{ $spVendor->mobile_no ?? '-' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th>GST Number</th>
                                    <td class="co-colon">:</td>
                                    <td>
                                        {{ $spVendor->gst_number ?? '-' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th>Address</th>
                                    <td class="co-colon">:</td>
                                    <td>
                                        {{ $spVendor->address ?? '-' }}
                                    </td>
                                </tr>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>


        {{-- Order Items --}}
        <div class="co-card co-table-card mt-3">

            @if (!empty($orders->orderItem) && count($orders->orderItem))

                <div class="co-table-wrap">

                    <table class="co-table" style="min-width:1250px;">

                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Spare Part</th>
                                <th>Category</th>
                                <th>Quantity</th>
                                <th>Tax</th>
                                <th>Tax Amount</th>
                                <th>Price</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($orders->orderItem as $index => $order_item)

                                <tr>

                                    <td class="co-order-id">
                                        {{ $loop->iteration }}
                                    </td>

                                    {{-- Spare Part --}}
                                    <td>

                                        <a href="javascript:void(0);"
                                            wire:click="shoImage({{ $order_item->id }})">

                                            @if (!empty($order_item->SpareParts->Image->file))

                                                <img src="{{ asset($order_item->SpareParts->Image->file) }}"
                                                    alt="Maintenance Service Parts"
                                                    class="co-item-image">

                                            @else

                                                @if ($order_item->SpareParts->spare_part_type == 1)

                                                    <img src="{{ asset('img/accessory.png') }}"
                                                        alt="Maintenance Service Parts"
                                                        class="co-item-image">

                                                @elseif($order_item->SpareParts->spare_part_type == 2)

                                                    <img src="{{ asset('img/spareparts.jpg') }}"
                                                        alt="Maintenance Service Parts"
                                                        class="co-item-image">

                                                @elseif($order_item->SpareParts->spare_part_type == 3)

                                                    <img src="{{ asset('img/tools.jpg') }}"
                                                        alt="Maintenance Service Parts"
                                                        class="co-item-image">

                                                @else

                                                    <img src="{{ asset('img/lubricant.jpg') }}"
                                                        alt="Maintenance Service Parts"
                                                        class="co-item-image">

                                                @endif

                                            @endif

                                        </a>

                                        <span class="co-item-name">
                                            {{ $order_item?->SpareParts?->name ?? '-' }}
                                        </span>

                                    </td>

                                    {{-- Category --}}
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
                                        <span class="co-count">
                                            {{ $order_item->quantity }}
                                        </span>
                                    </td>

                                    <td>
                                        {{ $order_item->SpareParts->tax_percentage ?? 0 }} %
                                    </td>

                                    <td class="co-tax">

                                        @php
                                            $totalTax =
                                                $order_item->price *
                                                ($order_item->SpareParts->tax_percentage / 100);

                                            $taxableAmount =
                                                $totalTax *
                                                $order_item->quantity;
                                        @endphp

                                        {{ $taxableAmount }}

                                    </td>

                                    <td class="co-amount">
                                        {{ $order_item->price }}
                                    </td>

                                    <td class="co-amount">
                                        {{ $order_item->total_amount }}
                                    </td>

                                    {{-- Item Status --}}
                                    <td>

                                        @if ($order_item->status == 0)

                                            <span class="co-status co-status-pending"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Awaiting acceptance/rejection from Spare Part Vendor">
                                                Pending
                                            </span>

                                        @elseif($order_item->status == 1)

                                            @if ($order_item->payment_status == 0)

                                                <span class="co-status co-status-pending"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    title="Item accepted by Spare Part Vendor; awaiting payment from Workshop">
                                                    Awaiting Payment
                                                </span>

                                            @else

                                                <span class="co-status co-status-success"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    title="Order accepted by Spare Part Vendor; awaiting Handover">
                                                    Accepted
                                                </span>

                                            @endif

                                        @elseif($order_item->status == 2)

                                            <span class="co-status co-status-danger"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Order declined by Spare Part Vendor. Reason: {{ $order_item->reason }}">
                                                Declined
                                            </span>

                                            <a class="co-status co-status-danger mt-1"
                                                href="javascript:void(0);"
                                                wire:click="showdeclineorder({{ $order_item->id }},2)"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Order declined by Spare Part Vendor. Reason: {{ $order_item->reason }}">
                                                Declined Reason
                                            </a>

                                        @elseif($order_item->status == 3)

                                            <span class="co-status co-status-success"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Items handed over by Spare Part Vendor; awaiting receipt by Workshop">
                                                Handover
                                            </span>

                                        @elseif($order_item->status == 4)

                                            <span class="co-status co-status-blue"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Items successfully received by Workshop">
                                                Received
                                            </span>

                                        @elseif($order_item->status == 5)

                                            <span class="co-status co-status-info"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Delivery delayed by Spare Part Vendor. Reason: {{ $order_item->reason }}">
                                                Delayed
                                            </span>

                                            <a class="co-status co-status-info mt-1"
                                                href="javascript:void(0);"
                                                wire:click="showdeclineorder({{ $order_item->id }},5)"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Delivery delayed by Spare Part Vendor. Reason: {{ $order_item->reason }}">
                                                Delayed Reason
                                            </a>

                                        @endif

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="co-empty">

                    <div class="co-empty-icon">
                        <i class="bx bx-package"></i>
                    </div>

                    <div class="co-empty-title">
                        No Order found!
                    </div>

                    <div class="co-empty-text">
                        There are no items available for this order.
                    </div>

                </div>

            @endif

        </div>


    @else

        {{-- =====================================================
            ORDER LIST
        ====================================================== --}}

        <div class="co-card co-header">

            <div class="co-title-wrap">

                <div class="co-title-icon">
                    <i class="bx bx-receipt"></i>
                </div>

                <div>
                    <h1 class="co-title">Orders</h1>

                    <p class="co-subtitle">
                        Manage workshop and spare part orders
                    </p>
                </div>

            </div>

        </div>


        {{-- Filters --}}
        <div class="co-card co-filter">

            <div class="co-filter-row">

                <div class="co-search">

                    <i class="bx bx-search"></i>

                    <input type="text"
                        class="form-control"
                        placeholder="Search Order No."
                        wire:model.live="searchfilter">

                </div>

                <div class="co-date">

                    <i class="bx bx-calendar"></i>

                    <input class="form-control"
                        placeholder="Pick Dates"
                        id="kt_daterangepicker_1">

                </div>

                <button type="button"
                    class="co-clear"
                    wire:click="resetFilter">

                    <i class="bx bx-reset me-1"></i>
                    Clear

                </button>

            </div>

        </div>


        {{-- Orders Table --}}
        <div class="co-card co-table-card">

            @if (!empty($orders) && $orders->count())

                <div class="co-table-wrap">

                    <table class="co-table">

                        <thead>

                            <tr>
                                <th>Order No.</th>
                                <th>Items</th>
                                <th>Order Date</th>
                                <th>Amount</th>
                                <th>Qty</th>
                                <th>Item</th>
                                <th>Handover</th>
                                <th>Received</th>
                                <th>
                                    <small>Pending for<br>Payment</small>
                                </th>
                                <th>
                                    <small>Payment<br>Status</small>
                                </th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($orders as $index => $order)

                                <tr>

                                    {{-- Order Number --}}
                                    <td>
                                        <span class="co-order-id">
                                            #{{ $order->id }}
                                        </span>
                                    </td>

                                    {{-- Items --}}
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

                                        <span class="co-items d-inline-block text-truncate"
                                            style="max-width:190px;"
                                            title="{{ $orderItem }}"
                                            data-bs-toggle="tooltip">

                                            {{ $orderItem }}

                                        </span>

                                    </td>

                                    {{-- Order Date --}}
                                    <td>

                                        @if ($order->order_date)

                                            <div class="co-date-value">
                                                <strong>
                                                    {{ carbon\carbon::parse($order->order_date)->format('d-M-Y') }}
                                                </strong>

                                                <br>

                                                {{ carbon\carbon::parse($order->order_date)->format('h:i A') }}
                                            </div>

                                        @else

                                            -

                                        @endif

                                    </td>

                                    {{-- Amount --}}
                                    <td>
                                        <span class="co-amount">
                                            {{ number_format($order->total_amount, 2) }}
                                        </span>
                                    </td>

                                    {{-- Quantity --}}
                                    <td>
                                        <span class="co-count">
                                            {{ $order->total_quantity }}
                                        </span>
                                    </td>

                                    {{-- Item --}}
                                    <td>
                                        <span class="co-count">
                                            {{ $order->total_item }}
                                        </span>
                                    </td>

                                    {{-- Handover --}}
                                    <td>
                                        <span class="co-count">
                                            {{ $order->orderItem->where('status', 3)->count() }}
                                        </span>
                                    </td>

                                    {{-- Received --}}
                                    <td>
                                        <span class="co-count">
                                            {{ $order->orderItem->where('status', 4)->count() }}
                                        </span>
                                    </td>

                                    {{-- Pending Payment --}}
                                    <td>

                                        <span class="co-count">
                                            {{ $order->orderItem->where('status', 1)->where('payment_status', 0)->count() }}
                                        </span>

                                    </td>

                                    {{-- Payment Status --}}
                                    <td>

                                        @switch($order->payment_status)

                                            @case(0)

                                                <span class="co-status co-status-danger"
                                                    data-bs-toggle="tooltip"
                                                    title="Awaiting payment from Workshop">
                                                    Pending
                                                </span>

                                                @break

                                            @case(1)

                                                <span class="co-status co-status-success"
                                                    data-bs-toggle="tooltip"
                                                    title="Payment received successfully from Workshop">
                                                    Success
                                                </span>

                                                @break

                                            @case(2)

                                                <span class="co-status co-status-success"
                                                    data-bs-toggle="tooltip"
                                                    title="Partially paid by Workshop">
                                                    Partially Paid
                                                </span>

                                                @break

                                        @endswitch

                                    </td>

                                    {{-- Order Status --}}
                                    <td>

                                        @switch($order->order_status)

                                            @case(1)

                                                @if ($order->payment_status == 0)

                                                    <span class="co-status co-status-pending"
                                                        data-bs-toggle="tooltip"
                                                        title="Order accepted by Spare Part Vendor; awaiting payment from Workshop">
                                                        Awaiting Payment
                                                    </span>

                                                @else

                                                    <span class="co-status co-status-success"
                                                        data-bs-toggle="tooltip"
                                                        title="Order accepted by Spare Part Vendor; awaiting Handover">
                                                        Accepted
                                                    </span>

                                                @endif

                                                @break

                                            @case(0)

                                                <span class="co-status co-status-danger"
                                                    data-bs-toggle="tooltip"
                                                    title="Awaiting acceptance/rejection from Spare Part Vendor">
                                                    Pending
                                                </span>

                                                @break

                                            @case(3)

                                                @if ($order->payment_status == 0)

                                                    <span class="co-status co-status-pending"
                                                        data-bs-toggle="tooltip"
                                                        title="Order partially accepted by Spare Part Vendor; awaiting payment from Workshop">
                                                        Awaiting Payment
                                                    </span>

                                                @elseif ($order->orderItem->contains('status', 3) || $order->orderItem->contains('status', 4))

                                                    <span class="co-status co-status-blue"
                                                        data-bs-toggle="tooltip"
                                                        title="Items handed over by Spare Part Vendor; awaiting receipt by Workshop">
                                                        Handover
                                                    </span>

                                                @else

                                                    <span class="co-status co-status-success"
                                                        data-bs-toggle="tooltip"
                                                        title="Some items accepted/rejected by Spare Part Vendor">
                                                        Partially Accepted
                                                    </span>

                                                @endif

                                                @break

                                            @case(4)

                                                <span class="co-status co-status-info"
                                                    data-bs-toggle="tooltip"
                                                    title="Items successfully received by Workshop">
                                                    Received
                                                </span>

                                                @break

                                            @case(2)

                                                <span class="co-status co-status-danger"
                                                    data-bs-toggle="tooltip"
                                                    title="Order declined by Spare Part Vendor. Reason: {{ $order->decline_reason }}">
                                                    Decline
                                                </span>

                                                @break

                                        @endswitch

                                    </td>

                                    {{-- Actions --}}
                                    <td>

                                        <div class="co-actions">

                                            <a class="co-action"
                                                href="javascript:void(0)"
                                                wire:click="view({{ $order->id }})">

                                                <i class="bx bx-show"></i>
                                                View

                                            </a>

                                            @if ($order->payment_status == 1)

                                                <a class="co-action co-action-invoice"
                                                    href="javascript:void(0)"
                                                    wire:click="invoice({{ $order->id }})">

                                                    <i class="bx bx-receipt"></i>
                                                    Invoice

                                                </a>

                                            @endif

                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

                <div class="co-pagination">
                    {{ $orders->links() }}
                </div>

            @else

                <div class="co-empty">

                    <div class="co-empty-icon">
                        <i class="bx bx-receipt"></i>
                    </div>

                    <div class="co-empty-title">
                        No Order found!
                    </div>

                    <div class="co-empty-text">
                        Orders will appear here once they are available.
                    </div>

                </div>

            @endif

        </div>

    @endif

</div>


@section('footerscript')

<script>
    document.addEventListener('livewire:init', function () {

        tooltipLivewire();
        daterangepicker();

        Livewire.on('downloadInvoice', (url) => {
            window.location.replace(url);
        });

        Livewire.hook('morphed', (message, component) => {
            tooltipLivewire();
            daterangepicker();
        });

    });


    document.addEventListener('livewire:navigated', function () {

        tooltipLivewire();
        daterangepicker();

    });


    function tooltipLivewire() {

        var tooltipTriggerList = [].slice.call(
            document.querySelectorAll('[data-bs-toggle="tooltip"]')
        );

        tooltipTriggerList.forEach(function (tooltipTriggerEl) {

            var tooltipInstance =
                bootstrap.Tooltip.getInstance(tooltipTriggerEl);

            if (tooltipInstance) {
                tooltipInstance.dispose();
            }

        });

        tooltipTriggerList.map(function (tooltipTriggerEl) {

            return new bootstrap.Tooltip(tooltipTriggerEl);

        });

    }


    function daterangepicker() {

        var datePicker = $("#kt_daterangepicker_1");

        if (!datePicker.length) {
            return;
        }

        if (datePicker.data('daterangepicker')) {
            datePicker.data('daterangepicker').remove();
        }

        datePicker.daterangepicker({

            locale: {
                cancelLabel: 'Clear',
            },

            ranges: {

                'Today': [
                    moment(),
                    moment()
                ],

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
                ]

            }

        });


        datePicker.off('apply.daterangepicker').on(
            'apply.daterangepicker',
            function (ev, picker) {

                let startDate =
                    picker.startDate.format('YYYY-MM-DD');

                let endDate =
                    picker.endDate.format('YYYY-MM-DD');

                @this.set('startDate', startDate);
                @this.set('endDate', endDate);

            }
        );


        datePicker.off('cancel.daterangepicker').on(
            'cancel.daterangepicker',
            function () {

                @this.set('startDate', null);
                @this.set('endDate', null);

            }
        );

    }
</script>

@endsection