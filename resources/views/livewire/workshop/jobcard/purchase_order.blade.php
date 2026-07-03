<style>
    .purchaseordertable tbody,
    td,
    tfoot,
    th,
    thead,
    tr {
        border-color: inherit;
        border-style: none;
        border-width: 0;
    }
</style>
<div>
<div class="modal @if ($showPurchase) show @endif" tabindex="-1"
    style="opacity: 1; background-color: #0606068c; display: @if ($showPurchase) block @else none @endif">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ 'Create Purchase Order' }}</h4>
                <button type="button" class="btn-close" wire:click="$set('showPurchase', false)"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-0 pb-3">
                <div class="table-responsive">
                    <table class="table purchaseordertable">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 150px;">Category</th>
                                <th class="text-center">Item</th>
                                <th class="text-center" style="width: 100px;">Quantity</th>
                                <th class="text-center" style="width: 120px;">Purches Price</th>
                                <th class="text-center" style="width: 120px;">Selling Price</th>
                                <th class="text-center" style="width: 120px;">Total</th>
                                <th class="text-center" style="width: 100px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rows as $index => $row)
                                <tr>
                                    <td style="width: 150px; padding: 4px 2px;">
                                        <select class="form-control" wire:model="rows.{{ $index }}.category"
                                            wire:change="getItemPurchase({{ $index }})">
                                            <option value="" selected disabled>--Select Category--</option>
                                            <option value="1" @selected($rows[$index]['category'] == 1)>Accessory</option>
                                            <option value="2" @selected($rows[$index]['category'] == 2)>Parts</option>
                                            <option value="3" @selected($rows[$index]['category'] == 3)>Tools</option>
                                            <option value="4" @selected($rows[$index]['category'] == 4)>Lubes</option>
                                        </select>
                                    </td>
                                    <td style="padding: 4px 2px;">
                                        <select class="form-control searchable-select"
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
                                    <td style="width: 100px; padding: 4px 2px;">
                                        <input type="number" class="form-control"
                                            wire:model="rows.{{ $index }}.quantity_purchase"
                                            wire:input="updateTotalPricePurchase({{ $index }})"
                                            min="1"
                                            max="{{ isset($rows[$index]['max_quantity']) ? $rows[$index]['max_quantity'] : 0 }}"
                                            oninput="validateMaxQuantity(this)">
                                    </td>
                                    <td style="width: 120px; padding: 4px 2px;">
                                        <input type="number" class="form-control bg-light"
                                            wire:model="rows.{{ $index }}.price_purchase" readonly>
                                    </td>
                                    <td style="width: 120px; padding: 4px 2px;">
                                        <input type="number" class="form-control"
                                            wire:model="rows.{{ $index }}.selling_price"
                                            wire:input="updateTotalPricePurchase({{ $index }})">
                                    </td>
                                    <td style="width: 120px; padding: 4px 2px;">
                                        <input type="text" class="form-control bg-light text-end"
                                            wire:model="rows.{{ $index }}.total_price_purchase" readonly>
                                    </td>
                                    <td style="width: 100px; padding: 4px 2px; text-align: center;">
                                        @if ($index > 0)
                                            <button type="button"
                                                class="btn btn-danger btn-sm remove-field"
                                                wire:click="removeRowPurchase({{ $index }})"
                                                style="width: 32px; height: 32px; padding: 0; display: inline-flex; align-items: center; justify-content: center;">
                                                <i class="fa fa-trash" aria-hidden="true" style="font-size: 13px;"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="thead-light">
                                <td>
                                    <button type="button" class="btn btn-primary rounded" wire:click="addRow">Add
                                        Row</button>
                                </td>
                                <td colspan="4" class="text-end fw-semibold">Total</td>
                                <td style="width: 120px;">
                                    <input type="text" class="form-control bg-light text-end fw-semibold"
                                        wire:model="totalPricePurchase" value="0" readonly>
                                </td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="d-flex justify-content-end gap-2 mt-2">
                    <button type="button" class="btn btn-secondary" wire:click="$set('showPurchase', false)"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary rounded"
                        wire:click="storePurchase()" @if (!$canAddRow) disabled @endif
                        @if (!$this->getCanSubmitPropertyPurchase()) disabled @endif>
                        Submit <i class="spinner-border spinner-border-sm" wire:loading></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
