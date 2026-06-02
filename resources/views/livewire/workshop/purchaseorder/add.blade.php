 <div> 
 
 <div class="modal-body py-3">
    <div class="card h-100">
        <div class="card-body">
  
     <div class="row">
            <div class="my-3 flex-end">
                <a href="{{route('workshop.purchaseorder')}}" class="btn btn-primary radius-5 mt-2 mt-lg-0"><i
                        class="bx bx-back"></i>Back</a>
            </div>
        <div>
            <table class="table border">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 150px;">Category</th>
                        <th class="text-center">Item</th>
                        <th class="text-center" style="width: 100px;">Quantity</th>
                        <th class="text-center" style="width: 100px;">Price</th>
                        <th class="text-center" style="width: 100px;">Amount</th>
                        <th class="text-center" style="width: 100px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rows as $index => $row)
                        <tr>
                            <td style="width: 150px;">
                                <select class="form-control" wire:model="rows.{{ $index }}.category"
                                wire:change="getItem({{ $index }})">
                                    <option value="" selected disabled>--Select Category--</option>
                                    <option value="1">Accessory</option>
                                    <option value="2">Parts</option>
                                    <option value="3">Tools</option>
                                    <option value="4">Lubes</option>
                                </select>
                                
                            </td>
                            <td>
                                <select class="form-control" wire:model="rows.{{ $index }}.item"
                                        wire:change="getAmount({{ $index }})">
                                    <option value="" selected disabled>-- Select Item --</option>
                                    @if (isset($items[$index]))
                                        @foreach ($items[$index] as $value)
                                            <option value="{{ $value->id }}">
                                                {{ $value->name . ', Stock=' . $value->stock . ', Price=' . $value->price }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </td>
                            <td>
                                <input type="number" class="form-control" 
                                    wire:model="rows.{{ $index }}.quantity" 
                                    wire:input="updateTotalPrice({{ $index }})" 
                                    min="1"
                                    max="{{ isset($rows[$index]['max_quantity']) ? $rows[$index]['max_quantity'] : 0 }}" 
                                    oninput="validateMaxQuantity(this)">
                            </td>
                            <td>
                                <input type="number" class="form-control bg-light" 
                                       wire:model="rows.{{ $index }}.price" 
                                       readonly>
                                       @error("rows.{$index}.price") 
                                       <div class="text-danger">{{ $message }}</div>
                                   @enderror
                            </td>
                            <td>
                                <input type="number" class="form-control bg-light" 
                                       wire:model="rows.{{ $index }}.total_price" 
                                       readonly>
                                       @error("rows.{$index}.total_price") 
                                       <div class="text-danger">{{ $message }}</div>
                                   @enderror
                            </td>
                            <td   style="text-align: -webkit-center;">
                                @if ($index > 0) 
                                <button type="button" class="btn btn-danger btn-xs p-1 remove-field rounded text-white border-white  " wire:click="removeRow({{ $index }})"  style="font-size: 12px; width: 26px; height: 31px; display: flex; align-items: center; ">
                                    <i class="fa fa-trash" aria-hidden="true" style="font-size: 17px;"></i>
                                </button>
                            @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td>
                            <button type="button" class="btn btn-primary rounded" wire:click="addRow" >Add Row</button>
                        </td>
                        <td colspan="3" class="text-end">Total</td>
                        <td>
                            <td>
                                <input type="text" class="form-control bg-light" 
                                       wire:model="totalPrice" 
                                       value="0" 
                                       readonly>
                            </td>
                        </td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
            <button type="button" class="btn btn-primary rounded" wire:click="store"@if(!$canAddRow) disabled @endif  @if(!$this->getCanSubmitProperty()) disabled @endif>             
                Pay And Submit   <i class="spinner-border spinner-border-sm" wire:loading></i>
            </button>
        </div>        
     </div>


 </div>
</div>
</div>



 </div>


 @section('footerscript')
     <script>
          function validateMaxQuantity(input) {
        // Get the max quantity value
        var maxQuantity = parseInt(input.getAttribute('max'));
        
        // If the current value exceeds max quantity, reset it to max
        if (parseInt(input.value) > maxQuantity) {
            input.value = maxQuantity;
        }
    }
     </script>
 @endsection
