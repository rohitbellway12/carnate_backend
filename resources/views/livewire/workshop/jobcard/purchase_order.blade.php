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
        <div class="modal-dialog modal-xl">

            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ 'Create Purchase Order' }}</h4>
                    <button type="button" class="btn-close" wire:click="$set('showPurchase', false)"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="row">
                    <div>
                        <table class="table border purchaseordertable">
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
                                        <td style="width: 150px;">
                                            <select class="form-control" wire:model="rows.{{ $index }}.category"
                                                wire:change="getItemPurchase({{ $index }})">
                                                <option value="" selected disabled>--Select Category--</option>
                                                <option value="1" @selected($rows[$index]['category'] == 1)>Accessory</option>
                                                <option value="2" @selected($rows[$index]['category'] == 2)>Parts</option>
                                                <option value="3" @selected($rows[$index]['category'] == 3)>Tools</option>
                                                <option value="4" @selected($rows[$index]['category'] == 4)>Lubes</option>
                                            </select>

                                        </td>
                                        <td>
                                            <select class="form-control livewire-select2-dropdown"
                                                wire:model.change="rows.{{ $index }}.item"
                                                id="rows.{{ $index }}.item">
                                                <option value="" selected disabled>-- Select Item --</option>



                                                @if (isset($items_purchase[$index]))
                                                    @foreach ($items_purchase[$index] as $value)
                                                        <option value="{{ $value->id }}">
                                                            {{ ($value->label_title ?? 'Item #' . $value->label_id) . ', Stock=' . $value->stock . ', Price=' . $value->price }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control"
                                                wire:model="rows.{{ $index }}.quantity_purchase"
                                                wire:input="updateTotalPricePurchase({{ $index }})"
                                                min="1"
                                                max="{{ isset($rows[$index]['max_quantity']) ? $rows[$index]['max_quantity'] : 0 }}"
                                                oninput="validateMaxQuantity(this)">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control bg-light"
                                                wire:model="rows.{{ $index }}.price_purchase" readonly>
                                            @error("rows.{$index}.price_purchase")
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                        <td>
                                             <input type="number" class="form-control"
                                                 wire:model="rows.{{ $index }}.selling_price"
                                                 wire:input="updateTotalPricePurchase({{ $index }})">
                                         </td>
                                         <td>
                                             <input type="number" class="form-control bg-light text-end px-0"
                                                 wire:model="rows.{{ $index }}.total_price_purchase" readonly>
                                             @error("rows.{$index}.total_price_purchase")
                                                 <div class="text-danger">{{ $message }}</div>
                                             @enderror
                                         </td>
                                        <td style="text-align: -webkit-center;">
                                            @if ($index > 0)
                                                <button type="button"
                                                    class="btn btn-danger btn-xs p-1 remove-field rounded text-white border-white  "
                                                    wire:click="removeRowPurchase({{ $index }})"
                                                    style="font-size: 12px; width: 26px; height: 31px; display: flex; align-items: center; ">
                                                    <i class="fa fa-trash" aria-hidden="true"
                                                        style="font-size: 17px;"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>
                                        <button type="button" class="btn btn-primary rounded" wire:click="addRow">Add
                                            Row</button>
                                    </td>
                                    <td colspan="4" class="text-end">Total</td>
                                    <td style="width: 150px;">
                                        <input type="text" class="form-control bg-light text-end"
                                            wire:model="totalPricePurchase" value="0" readonly>
                                    </td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                        <button type="button" class="btn btn-secondary ms-2" wire:click="$set('showPurchase', false)"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary rounded m-2"
                            wire:click="storePurchase()"@if (!$canAddRow) disabled @endif
                            @if (!$this->getCanSubmitPropertyPurchase()) disabled @endif>
                            Submit <i class="spinner-border spinner-border-sm" wire:loading></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
