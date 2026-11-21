<div>
    <style>
        .carnate-purchase-modal {
            --c-red: #e53935;
            --c-red-dark: #d32f2f;
            --c-red-soft: #fff5f5;
            --c-border: #e2e8f0;
            --c-text: #111827;
            --c-muted: #64748b;
        }

        .carnate-purchase-modal.modal {
            position: fixed;
            inset: 0;
            z-index: 105000 !important;
            background: rgba(15, 23, 42, 0.6) !important;
            backdrop-filter: blur(3px);
            overflow-y: auto;
            padding: 20px 10px;
        }

        .carnate-purchase-modal .modal-dialog {
            max-width: 1050px;
            margin: 20px auto;
        }

        .carnate-purchase-modal .modal-content {
            border: 1px solid var(--c-border) !important;
            border-radius: 16px !important;
            box-shadow: 0 24px 70px rgba(15, 23, 42, 0.22) !important;
            overflow: hidden;
            background: #fff;
        }

        .carnate-purchase-modal .modal-header {
            padding: 16px 22px !important;
            border-bottom: 1px solid var(--c-border) !important;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .carnate-purchase-modal .modal-title-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .carnate-purchase-modal .modal-title-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: var(--c-red-soft);
            color: var(--c-red);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }

        .carnate-purchase-modal .modal-title {
            font-size: 17px !important;
            font-weight: 700 !important;
            color: var(--c-text) !important;
            margin: 0;
            line-height: 1.2;
        }

        .carnate-purchase-modal .modal-subtitle {
            font-size: 12px;
            color: var(--c-muted);
            margin: 2px 0 0;
        }

        .carnate-purchase-modal .btn-close {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            opacity: 0.7;
            transition: all .2s;
            border: 1px solid var(--c-border);
            background-size: 10px;
        }

        .carnate-purchase-modal .btn-close:hover {
            opacity: 1;
            background-color: #f1f5f9;
        }

        .carnate-purchase-modal .modal-body {
            padding: 20px 22px !important;
            max-height: calc(100vh - 170px);
            overflow-y: auto;
        }

        .carnate-purchase-table {
            width: 100%;
            margin-bottom: 0;
            border-collapse: separate;
            border-spacing: 0;
            border: 1px solid var(--c-border);
            border-radius: 12px;
            overflow: hidden;
        }

        .carnate-purchase-table thead th {
            background: #f8fafc;
            padding: 11px 12px;
            font-size: 11px;
            font-weight: 700;
            color: var(--c-muted);
            text-transform: uppercase;
            letter-spacing: .04em;
            border-bottom: 1px solid var(--c-border);
        }

        .carnate-purchase-table tbody td {
            padding: 8px 8px;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }

        .carnate-purchase-table tbody tr:last-child td {
            border-bottom: none;
        }

        .carnate-purchase-table tfoot td {
            padding: 12px 10px;
            background: #f8fafc;
            border-top: 1px solid var(--c-border);
        }

        .carnate-purchase-modal .form-control,
        .carnate-purchase-modal .form-select {
            height: 38px !important;
            min-height: 38px !important;
            border: 1px solid var(--c-border) !important;
            border-radius: 8px !important;
            font-size: 13px !important;
            font-weight: 500 !important;
            color: var(--c-text) !important;
            background-color: #fff;
            padding: 6px 10px !important;
            transition: all .2s ease;
        }

        .carnate-purchase-modal .form-control:focus,
        .carnate-purchase-modal .form-select:focus {
            border-color: rgba(229, 57, 53, .55) !important;
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .08) !important;
            outline: none !important;
        }

        .carnate-purchase-modal .form-control[readonly] {
            background-color: #f1f5f9 !important;
            color: #475569 !important;
            font-weight: 600 !important;
        }

        .carnate-purchase-modal .btn-remove-row {
            width: 32px;
            height: 32px;
            border: 1px solid #fecaca;
            background: #fef2f2;
            color: #dc2626;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all .2s;
        }

        .carnate-purchase-modal .btn-remove-row:hover {
            background: #dc2626;
            color: #fff;
        }

        .carnate-purchase-modal .btn-add-row {
            height: 36px;
            padding: 0 16px;
            border-radius: 8px;
            border: 1px solid #cbd5e1;
            background: #fff;
            color: #334155;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all .2s;
        }

        .carnate-purchase-modal .btn-add-row:hover {
            background: #f1f5f9;
            color: #0f172a;
        }

        .carnate-purchase-modal .modal-footer {
            padding: 14px 22px !important;
            border-top: 1px solid var(--c-border) !important;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
        }

        .carnate-purchase-modal .btn-cancel {
            height: 40px;
            padding: 0 18px;
            border-radius: 9px;
            border: 1px solid var(--c-border);
            background: #fff;
            color: var(--c-muted);
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all .2s;
        }

        .carnate-purchase-modal .btn-cancel:hover {
            background: #f1f5f9;
            color: var(--c-text);
        }

        .carnate-purchase-modal .btn-submit {
            height: 40px;
            padding: 0 24px;
            border-radius: 9px;
            border: none;
            background: var(--c-red);
            color: #fff !important;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(229, 57, 53, .22);
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all .2s;
        }

        .carnate-purchase-modal .btn-submit:hover:not(:disabled) {
            background: var(--c-red-dark);
            transform: translateY(-1px);
        }

        .carnate-purchase-modal .btn-submit:disabled {
            opacity: 0.55;
            cursor: not-allowed;
            box-shadow: none;
        }
    </style>

    <div class="modal carnate-purchase-modal @if ($showPurchase) show @endif" tabindex="-1"
        style="display: @if ($showPurchase) flex !important; align-items: center; justify-content: center; @else none !important; @endif">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                {{-- Header --}}
                <div class="modal-header">
                    <div class="modal-title-wrap">
                        <div class="modal-title-icon">
                            <i class="bx bx-cart"></i>
                        </div>
                        <div>
                            <h4 class="modal-title">Create Purchase Order</h4>
                            <p class="modal-subtitle">Order stock parts online from vendors</p>
                        </div>
                    </div>
                    <button type="button" class="btn-close" wire:click="$set('showPurchase', false)" aria-label="Close"></button>
                </div>

                {{-- Body --}}
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="carnate-purchase-table">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 160px;">Category</th>
                                    <th class="text-start">Item</th>
                                    <th class="text-center" style="width: 105px;">Quantity</th>
                                    <th class="text-end" style="width: 130px;">Purchase Price</th>
                                    <th class="text-end" style="width: 130px;">Selling Price</th>
                                    <th class="text-end" style="width: 130px;">Total</th>
                                    <th class="text-center" style="width: 70px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rows as $index => $row)
                                    <tr>
                                        <td style="width: 160px;">
                                            <select class="form-select" wire:model="rows.{{ $index }}.category"
                                                wire:change="getItemPurchase({{ $index }})">
                                                <option value="" selected disabled>--Select Category--</option>
                                                <option value="1" @selected($rows[$index]['category'] == 1)>Accessory</option>
                                                <option value="2" @selected($rows[$index]['category'] == 2)>Parts</option>
                                                <option value="3" @selected($rows[$index]['category'] == 3)>Tools</option>
                                                <option value="4" @selected($rows[$index]['category'] == 4)>Lubes</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-select searchable-select"
                                                wire:model.change="rows.{{ $index }}.item"
                                                id="rows.{{ $index }}.item">
                                                <option value="" selected disabled>-- Select Item --</option>
                                                @if (isset($items_purchase[$index]))
                                                    @foreach ($items_purchase[$index] as $value)
                                                        <option value="{{ $value->id }}">
                                                            {{ $value->label_title ?? 'Item #' . $value->label_id }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </td>
                                        <td style="width: 105px;">
                                            <input type="number" class="form-control text-center"
                                                wire:model="rows.{{ $index }}.quantity_purchase"
                                                wire:input="updateTotalPricePurchase({{ $index }})"
                                                min="1"
                                                max="{{ isset($rows[$index]['max_quantity']) ? $rows[$index]['max_quantity'] : 0 }}"
                                                oninput="validateMaxQuantity(this)">
                                        </td>
                                        <td style="width: 130px;">
                                            <input type="number" class="form-control text-end"
                                                wire:model="rows.{{ $index }}.price_purchase" readonly>
                                        </td>
                                        <td style="width: 130px;">
                                            <input type="number" class="form-control text-end"
                                                wire:model="rows.{{ $index }}.selling_price"
                                                wire:input="updateTotalPricePurchase({{ $index }})">
                                        </td>
                                        <td style="width: 130px;">
                                            <input type="text" class="form-control text-end fw-bold"
                                                wire:model="rows.{{ $index }}.total_price_purchase" readonly>
                                        </td>
                                        <td style="width: 70px; text-align: center;">
                                            @if ($index > 0)
                                                <button type="button"
                                                    class="btn-remove-row"
                                                    wire:click="removeRowPurchase({{ $index }})"
                                                    title="Remove Row">
                                                    <i class="fa fa-trash" aria-hidden="true" style="font-size: 13px;"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>
                                        <button type="button" class="btn-add-row" wire:click="addRow">
                                            <i class="bx bx-plus"></i> Add Row
                                        </button>
                                    </td>
                                    <td colspan="4" class="text-end fw-bold" style="color: var(--c-muted); font-size: 13px;">
                                        Total Amount:
                                    </td>
                                    <td style="width: 130px;">
                                        <input type="text" class="form-control text-end fw-bold"
                                            wire:model="totalPricePurchase" value="0" readonly style="color: var(--c-red); font-size: 14px;">
                                    </td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                {{-- Footer --}}
                <div class="modal-footer">
                    <button type="button" class="btn-cancel" wire:click="$set('showPurchase', false)">
                        Cancel
                    </button>
                    <button type="button" class="btn-submit"
                        wire:click="storePurchase()" @if (!$canAddRow) disabled @endif
                        @if (!$this->getCanSubmitPropertyPurchase()) disabled @endif>
                        <span>Submit Order</span>
                        <i class="spinner-border spinner-border-sm" wire:loading></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
