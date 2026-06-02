<div>
    <div class="modal @if ($showPurchase) show @endif" tabindex="-1"
        style="opacity: 1; background-color: #0606068c; display: @if ($showPurchase) block @else none @endif">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form wire:submit.prevent="storeOrder">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ $isPurchase ? 'Edit Vehicle' : 'Create Purchase Order' }}</h4>
                        <button type="button" class="btn-close" wire:click="$set('showPurchase', false)"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body py-3">
                        @csrf
                        <div>
                            <div class="mb-3 text-end pe-3 pt-3">
                                <button type="button" class="btn btn-success rounded" wire:click="addRow">Add Row</button>
                            </div>
                            <table class="table border">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 100px;">Category</th>
                                        <th class="text-center">Item</th>
                                        <th class="text-center" style="width: 150px;">Quantity</th>
                                        <th class="text-center" style="width: 100px;">Price</th>
                                        <th class="text-center" style="width: 100px;">Amount</th>
                                        <th class="text-center" style="width: 100px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rows as $index => $row)
                                        <tr>
                                            <td>
                                                <select class="form-control" wire:model="rows.{{ $index }}.category">
                                                    <option value="" selected disabled>--Select Category--</option>
                                                    <option value="1">Accessory</option>
                                                    <option value="2">Parts</option>
                                                    <option value="3">Tools</option>
                                                    <option value="4">Lubes</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control" wire:model="rows.{{ $index }}.item">
                                                    <option value="" selected disabled>--Select Item--</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control" wire:model="rows.{{ $index }}.quantity" min="1">
                                            </td>
                                            <td>
                                                <input type="number" class="form-control bg-light" wire:model="rows.{{ $index }}.price" readonly>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control bg-light" value="{{ $row['total_price'] }}" readonly>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger" wire:click="removepurchase({{ $index }})">Delete</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4" class="text-end">Total</td>
                                        <td>
                                            <input type="text" class="form-control bg-light" value="{{ array_sum(array_column($rows, 'total_price')) }}" readonly>
                                        </td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="$set('showPurchase', false)"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            {{ $isPurchase ? 'Update' : 'Submit' }}
                            <i class="spinner-border spinner-border-sm" wire:loading></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
