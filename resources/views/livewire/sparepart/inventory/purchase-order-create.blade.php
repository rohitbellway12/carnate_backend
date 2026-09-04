<div class="container-fluid py-3">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Purchase Order</h2>
        <button type="button" class="btn btn-link text-danger fs-3 p-0 m-0 " wire:click="goToList" title="Back" style="text-decoration: none;">
            &times;
        </button>
    </div>
    <div class="row g-3">
        <!-- Left: Supplier -->
        <div class="col-md-5">
            <div class="card h-100">
                <div class="card-body">
                    <div class="mb-3" style="position: relative;">
                        <div class="d-flex align-items-center gap-2">
                            <input type="text" class="form-control" placeholder="Search Supplier By Firm Name and Number" wire:model="supplierSearch" wire:focus="focusSupplierSearch" autocomplete="off">
                            <button class="btn btn-primary btn-sm" type="button" wire:click="openSupplierModal">Add New</button>
                        </div>
                        @if(!empty($supplierResults))
                            <ul class="list-group position-absolute w-100 mt-1" style="z-index: 1050; left: 0; top: 100%;">
                                @foreach($supplierResults as $supplier)
                                    <li class="list-group-item list-group-item-action"
                                        wire:click="selectSupplier({{ $supplier['id'] }})"
                                        style="cursor:pointer;">
                                        {{ $supplier['business_first_name'] }} ({{ $supplier['mobile_no'] }})
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    <div class="row mb-2">
                        <div class="col-6">
                            <label>Supplier Name</label>
                            <input type="text" class="form-control" wire:model="supplier_name" readonly>
                        </div>
                        <div class="col-6">
                            <label>Supplier Phone</label>
                            <input type="text" class="form-control" wire:model="supplier_phone" readonly>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6">
                            <label>Balance</label>
                            <input type="text" class="form-control" wire:model="supplier_balance" readonly>
                        </div>
                        <div class="col-6 d-flex align-items-end">
                            <button class="btn btn-outline-secondary w-100" wire:click="editSupplier">Edit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


   <!-- Right: PO Details -->
   <div class="col-md-7">
            <div class="card h-100">
                <div class="card-body">
                    <!-- PO Status Steps (Stepper) -->
                    <div class="mb-3">
                        @if($po_status === 'Cancelled')
                            <div class="alert alert-danger text-center fw-bold fs-4">Order Cancelled</div>
                        @else
                            <div class="d-flex align-items-center justify-content-between stepper-wrapper" style="gap: 0;">
                                @php
                                    $steps = [
                                        ['label' => 'Open', 'color' => '#007bff'],
                                        ['label' => 'Placed', 'color' => '#28a745'],
                                        ['label' => 'Received', 'color' => '#007bff'],
                                        ['label' => 'Closed', 'color' => '#b3b300'],
                                    ];
                                @endphp
                                @foreach($steps as $i => $step)
                                    @php
                                        $activeIndex = collect($steps)->pluck('label')->search($po_status);
                                        $isCompletedOrActive = $i <= $activeIndex;
                                    @endphp
                                    <div class="stepper-step text-center flex-fill position-relative">
                                        <div class="stepper-circle {{ $isCompletedOrActive ? 'active-step-' . $i : '' }}">
                                            {{ $i }}
                                        </div>
                                        <div class="stepper-label {{ $isCompletedOrActive ? 'active-label-' . $i : '' }}">
                                            {{ $step['label'] }}
                                        </div>
                                        @if($i < count($steps) - 1)
                                            @php
                                                $lineClass = $i < $activeIndex ? 'stepper-line stepper-line-active-' . $i : 'stepper-line';
                                            @endphp
                                            <div class="{{ $lineClass }}"></div>
                                        @endif
                                    </div>
                                @endforeach
                                @if($isEdit && $editingId)
                                    <a href="{{ route('sparepart.purchase.order.show', $editingId) }}" class="btn btn-danger btn-sm ms-3" target="_blank">
                                        <i class="fas fa-paper-plane"></i> Share PO
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>
                    <div class="row g-2">
                        <div class="col-md-6">
                            <label>P.O. Number</label>
                            <input type="text" placeholder="PON" class="form-control" wire:model="po_no" readonly>
                        </div>
                        <div class="col-md-6">
                            <label>P.O. Date</label>
                            <input type="date" class="form-control" wire:model="po_date" readonly>
                        </div>
                        <div class="col-md-6">
                            <label>Bill Number</label>
                            <!-- <input type="text" class="form-control" wire:model.lazy="bill_no" @if($po_status === 'Open') value="0" readonly @else value="{{ $bill_no }}" @endif > -->
                            <input
                            type="text"
                            class="form-control"
                            wire:model.lazy="bill_no"
                            value="{{ in_array($po_status, ['Open', 'Placed']) ? '0' : $bill_no }}"
                            {{ in_array($po_status, ['Open', 'Placed']) ? 'readonly' : '' }}
>

                        </div>
                        <div class="col-md-6">
                            <label>Bill Date</label>
                            <input type="date" class="form-control" wire:model="bill_date">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Stock Details Table -->
<div class="card mt-4">
        <div class="card-body">
            <h5>Stock Details</h5>
            <div class="mb-2 row align-items-end position-relative">
    <div class="col-md-6">
            <div style="position: relative;">
                <input type="text"
                       class="form-control"
                       placeholder="Search Part By Part Number"
                       wire:model="part_search"
                       wire:focus="focusPartSearch"
                       autocomplete="off"
                       wire:click.away="$set('partResults', [])">
                @if(!empty($partResults))
                    <ul class="list-group position-absolute w-100 mt-1" style="z-index: 1050; left: 0; top: 100%;">
                        @foreach($partResults as $part)
                            <li class="list-group-item list-group-item-action"
                                wire:click="selectPart({{ $part->id }})"
                                style="cursor:pointer;">
                                {{ $part->name }} ({{ $part->part_number }}) - ₹{{ $part->purchase_price ?? $part->price }}
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
    </div>
    <div class="col-md-2">
        <button type="button" class="btn btn-success" wire:click="openPartModal">Add</button>
    </div>
</div>
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Particulars <br><input type="checkbox" wire:click="toggleShowPartNumber" @if($showPartNumber) checked @endif> Show Part Number</th>
                            @if($po_status === 'Placed' || $po_status === 'Received'|| $po_status === 'Closed')
                                <th>HSN</th>
                            @endif
                            <th>Qty</th>
                            <th>Unit Price(RS.)</th>
                            @if($po_status === 'Placed' || $po_status === 'Received'|| $po_status === 'Closed')
                                <th>Selling price(RS.)</th>
                                <th>GST(%)</th>
                                {{--gst calulation--}}
                                <th>GST Type</th>
                                <th>Online Discount</th>

                            @endif
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach($items as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    {{ $item['name'] }}

                                     @if($showPartNumber && $item['part_number'])
                                        <br><small class="text-muted">{{ $item['part_number'] }}</small>
                                    @endif
                                </td>
                                @if($po_status === 'Placed' || $po_status === 'Received'|| $po_status === 'Closed')
                                    <td>
                                        <input type="text" class="form-control form-control-sm" wire:model.lazy="items.{{ $index }}.hsn_code" style="width: 70px;">
                                    </td>
                                @endif
                                <td>
                                    <input type="number" class="form-control form-control-sm"
                                           value="{{ $item['qty'] }}"
                                           wire:change="updateItemQty({{ $index }}, $event.target.value)"
                                           min="1" style="width: 70px;">
                                </td>
                                <td>
                                    <input type="number" class="form-control form-control-sm"
                                           value="{{ $item['unit_price'] }}"
                                           wire:change="updateItemPrice({{ $index }}, $event.target.value)"
                                           min="0" step="0.01" style="width: 100px;">
                                </td>
                                @if($po_status === 'Placed' || $po_status === 'Received'|| $po_status === 'Closed')
                                    <td>
                                        <input type="number" class="form-control form-control-sm" wire:model.lazy="items.{{ $index }}.selling_price">
                                    </td>
                                    <td>
                                        <select class="form-select form-select-sm"
                                            wire:model="items.{{ $index }}.gst_percent"
                                            wire:change="updateItemGST({{ $index }}, $event.target.value)">
                                            <option value="{{ (int) $item['gst_percent'] }}">
                                                {{ (int) $item['gst_percent'] }}%
                                            </option>
                                            <option value="0">0%</option>
                                            <option value="5">5%</option>
                                            <option value="12">12%</option>
                                            <option value="18">18%</option>
                                            <option value="28">28%</option>
                                        </select>
                                    </td>
                                    <td>
                                    {{--gst calulation--}}
                                        <select class="form-select form-select-sm"
                                            wire:model="items.{{ $index }}.gst_type"
                                            wire:change="updateItemGstType({{ $index }}, $event.target.value)">
                                            <option value="exclude">Exclude</option>
                                            <option value="include">Include</option>
                                        </select>
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <input type="number" class="form-control form-control-sm"
                                                value="{{ $item['discount'] ?? 0 }}"
                                                wire:change="updateItemDiscount({{ $index }}, $event.target.value)">
                                            <select class="form-select form-select-sm"
                                                wire:model="items.{{ $index }}.discount_type"
                                                wire:change="updateItemDiscountType({{ $index }}, $event.target.value)"
                                                style="max-width: 80px;">
                                                <option value="1">₹</option>
                                                <option value="2">%</option>
                                            </select>
                                        </div>
                                    </td>
                                @endif
                                <td>₹{{ number_format($item['total'], 2) }}</td>
                                <td>
                                    <!-- <button type="button" class="btn btn-sm btn-danger" wire:click="removeItem({{ $index }})">
                                        <i class="fas fa-times"></i>
                                    </button> -->

                                    <i class="fas fa-times me-2" wire:click="removeItem({{ $index }})" style="cursor: pointer; font-size: 20px;"></i>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="table-light">
                        <tr>
                            <td colspan="4" class="text-end fw-bold">Grand Total:</td>
                            <td class="fw-bold">₹{{ number_format($this->grandTotal, 2) }}</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

<!-- Transport & Bill Details Section (always show Note and Bill calculation) -->
<div class="row mt-4">
    <!-- Transport Details -->
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="mb-3">Transport Details</h5>
                @if($po_status === 'Placed' || $po_status === 'Received'|| $po_status === 'Closed')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Transporter Name</label>
                            <input type="text" class="form-control" wire:model.lazy="transporter_name" placeholder="Transporter" required>
                            @error('transporter_name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Received Date</label>
                            <input type="date" class="form-control" wire:model.lazy="received_date" required>
                            @error('received_date') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Vehicle Number</label>
                            <input type="text" class="form-control" wire:model.lazy="vehicle_number" placeholder="Vehicle Number" required>
                            @error('vehicle_number') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Delivery Person</label>
                            <input type="text" class="form-control" wire:model.lazy="delivery_person" placeholder="Delivery Person" required>
                            @error('delivery_person') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">LT. Number</label>
                            <input type="text" class="form-control" wire:model.lazy="lt_number" placeholder="LT. Number" required>
                            @error('lt_number') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                @endif
                <div class="mb-3 mt-3">
                    <label class="form-label">Note</label>
                    <textarea class="form-control" wire:model.lazy="note" placeholder="Note"></textarea>
                </div>
            </div>
        </div>
    </div>
    <!-- Bill Details -->
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="mb-3">Bill Details</h5>
                <!-- Always show calculation summary -->
                @if($po_status !== 'Placed' && $po_status !== 'Received'&& $po_status !== 'Closed')
                    <div class="d-flex justify-content-between">
                        <span>Subtotal</span>
                        <span>₹{{ number_format($subtotal ?? 0, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Taxable Subtotal</span>
                        <span>₹{{ number_format($taxable_subtotal ?? 0, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>GST</span>
                        <span>₹{{ number_format($gst ?? 0, 2) }}</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between fw-bold">
                        <span class="text-success">Total Payable</span>
                        <span class="text-success">₹{{ number_format($total_payable ?? 0, 2) }}</span>
                    </div>
                @endif
                @if($po_status === 'Placed' || $po_status === 'Received'|| $po_status === 'Closed')
                    <!-- Extra Bill Details fields for Placed/Received -->
                    <div class="d-flex justify-content-between align-items-center mb-2 mt-3">
                        <span>Total (Incl. GST)</span>
                        <span class="fw-bold">₹{{ number_format($total_payable ?? 0, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        {{--gst calulation--}}
                        <span>GST</span>
                        <span>₹{{ number_format($gst ?? 0, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-danger">Balance</span>
                        <span class="text-danger">₹{{ number_format($balance ?? 0, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-success">Paid</span>
                        <span class="text-success">₹{{ number_format($paid ?? 0, 2) }}</span>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">PO Payment</label>
                        <input type="number" class="form-control" wire:model.lazy="po_payment" placeholder="PO Payment" required>
                    </div>
                    <div class="row g-2 mb-2">
                        <div class="col-md-4">
                            <label class="form-label">Transaction Type</label>
                            <select class="form-select" wire:model.lazy="transaction_type" required>
                                <option value="">Select Type</option>
                                <option value="cash">Cash</option>
                                <option value="bank">Bank</option>
                                <option value="cheque">Cheque</option>
                                <option value="upi">UPI</option>
                            </select>
                            @error('transaction_type') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Transaction Date</label>
                            <input type="date" class="form-control" wire:model.lazy="transaction_date" value="{{ $transaction_date ?? date('Y-m-d') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Transaction Number</label>
                            <input type="text" class="form-control" wire:model.lazy="transaction_no" placeholder="Enter the transaction Num">
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span>Return</span>
                        <span>₹{{ number_format($return_amount ?? 0, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span>Previous Balance</span>
                        <span>₹{{ number_format($previous_balance ?? 0, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="fw-bold text-primary">Total Balance <i class="fas fa-info-circle" title="Total Balance"></i></span>
                        <span class="fw-bold text-primary">₹{{ number_format($total_balance ?? 0, 2) }}</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>




    <!-- Action Buttons -->
<div class="d-flex justify-content-between mt-3">
    <!-- Left: Cancel Button -->
    <div>
        <button class="btn btn-danger" wire:click="cancelOrder">Cancel Order</button>
    </div>

    <!-- Right: All other buttons -->
    <div class="d-flex gap-2">
        @if($isEdit)
            <button class="btn btn-primary" wire:click="updatePO">Update</button>
            @if($po_status === 'Open')
                <button class="btn btn-success" wire:click="placeOrder">Place Order</button>
            @elseif($po_status === 'Placed')
                <button class="btn btn-info" wire:click="markReceived" >Received</button>
            @elseif($po_status === 'Received')
                <button class="btn btn-warning" wire:click="addToStock">Add to Stock</button>
            @endif
        @else
            <button class="btn btn-primary" wire:click="savePO">Create PO</button>
            {{--<button class="btn btn-success" wire:click="placeOrder">Place Order</button>--}}
        @endif
    </div>
</div>


<!-- Supplier Add/Edit -->
<div class="modal @if ($showSupplierModal) show @endif" tabindex="-1" style="opacity:1; background-color:#0606068c; @if ($showSupplierModal) display:block; @else display:none; @endif">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form wire:submit.prevent="{{ $isSupplierEdit ? 'updateSupplier' : 'storeSupplier' }}">
                <div class="modal-header">
                    <h4 class="modal-title">{{ $isSupplierEdit ? 'Edit Supplier' : 'Add Supplier' }}</h4>
                    <button type="button" class="btn-close" wire:click="closeSupplierModal" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-3">
                    <div class="row g-3">
                        <!-- Mobile No -->
                        <div class="col-md-6">
                            <label class="form-label">Mobile No.<span class="text-danger">*</span></label>
                            <input type="text" wire:model.lazy="mobile_no" class="form-control" placeholder="Enter Mobile No.">
                            @error('mobile_no') <span class="text-danger error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <hr>
                    <h5>Business Info</h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">First Name <sup class="text-danger">*</sup></label>
                            <input type="text" wire:model.lazy="business_first_name" class="form-control" placeholder="Enter First Name">
                            @error('business_first_name') <span class="text-danger error">{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label">GSTIN</label>
                            <input type="text" wire:model.lazy="gstin" class="form-control" placeholder="Enter GSTIN">
                            @error('gstin') <span class="text-danger error">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Address</label>
                            <input type="text" wire:model.lazy="business_address" class="form-control" placeholder="Enter Address">
                            @error('business_address') <span class="text-danger error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <hr>
                    <h5>Owner Info</h5>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">First Name <sup class="text-danger">*</sup></label>
                            <input type="text" wire:model.lazy="owner_first_name" class="form-control" placeholder="Enter First Name">
                            @error('owner_first_name') <span class="text-danger error">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Contact 1 <sup class="text-danger">*</sup></label>
                            <input type="text" wire:model.lazy="contact_1" class="form-control" placeholder="Enter Contact 1">
                            @error('contact_1') <span class="text-danger error">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Contact 2</label>
                            <input type="text" wire:model.lazy="contact_2" class="form-control" placeholder="Enter Contact 2">
                            @error('contact_2') <span class="text-danger error">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Email</label>
                            <input type="email" wire:model.lazy="email" class="form-control" placeholder="Enter Email">
                            @error('email') <span class="text-danger error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        {{ $isSupplierEdit ? 'Update' : 'Save' }}
                        <i class="spinner-border spinner-border-sm" wire:loading></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@if ($showPartModal)
<div class="modal show" tabindex="-1" style="opacity:1; background-color:#0606068c; display:block;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form wire:submit.prevent="storePart">
                <div class="modal-header">
                    <h4 class="modal-title">Add Part</h4>
                    <button type="button" class="btn-close" wire:click="closePartModal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-3">
                    <div class="row g-3">
                        <!-- Part Number -->
                        <div class="col-md-6">
                            <label class="form-label">Part Number</label>
                             <input type="text" wire:model="part_part_number" class="form-control" placeholder="Enter Part Number">
                            <div wire:loading wire:target="part_part_number">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                Fetching details...
                            </div>
                            @error('part_part_number') <span class="text-danger error">{{ $message }}</span> @enderror
                        </div>
                        <!-- Name -->
                        <div class="col-md-6">
                            <label class="form-label">Name<sup class="text-danger">*</sup></label>
                            <input type="text" wire:model.lazy="part_name" class="form-control" placeholder="Enter Name">
                            @error('part_name') <span class="text-danger error">{{ $message }}</span> @enderror
                        </div>
                        <!-- Brand -->
                        <div class="col-md-6">
                            <label class="form-label">Brand</label>
                            <input type="text" wire:model="part_brand" class="form-control" placeholder="Enter Brand">
                            @error('part_brand') <span class="text-danger error">{{ $message }}</span> @enderror
                        </div>
                        <!-- Purchase Price -->
                        <div class="col-md-6">
                            <label class="form-label">Purchase Price<sup class="text-danger">*</sup></label>
                            <input type="number" wire:model.lazy="part_purchase_amount" class="form-control" placeholder="Enter Purchase Price">
                            @error('part_purchase_amount') <span class="text-danger error">{{ $message }}</span> @enderror
                        </div>
                        <!-- Selling Price -->
                        <div class="col-md-6">
                            <label class="form-label">Selling Price<sup class="text-danger">*</sup></label>
                            <input type="number" wire:model.lazy="part_selling_amount" class="form-control" placeholder="Enter Selling Price">
                            @error('part_selling_amount') <span class="text-danger error">{{ $message }}</span> @enderror
                        </div>
                        <!-- Tax Type -->
                        <div class="col-md-6">
                            <label class="form-label">Tax Type</label>
                            <select class="form-select" wire:model="part_tax_type">
                                <option value="">Select Tax Type</option>
                                <option value="include">Include All Taxes</option>
                                <option value="exclude">Exclude All Taxes</option>
                            </select>
                            @error('part_tax_type') <span class="text-danger error">{{ $message }}</span> @enderror
                        </div>
                        <!-- Tax Percentage -->
                        @if ($part_tax_type == 'include' || $part_tax_type == 'exclude')
                        <div class="col-md-6">
                            <label class="form-label">
                                {{ $part_tax_type == 'include' ? 'Include Tax Percentage' : 'Exclude Tax Percentage' }}
                            </label>
                            <div class="input-group">
                                <input type="number" wire:model.lazy="part_tax_percentage" class="form-control" placeholder="Enter Percentage">
                                <span class="input-group-text">%</span>
                            </div>
                            @error('part_tax_percentage') <span class="text-danger error">{{ $message }}</span> @enderror
                        </div>
                        @endif
                        <!-- Discount -->
                        <div class="col-md-6">
                            <label class="form-label">Online Discount</label>
                            <div class="input-group">
                                <input type="number" wire:model="part_discount" class="form-control" placeholder="Enter Discount">
                                <select class="form-select" wire:model="part_discount_type" style="max-width: 80px;">
                                    <option value="1">₹</option>
                                    <option value="2">%</option>
                                </select>
                            </div>
                            @error('part_discount') <span class="text-danger error">{{ $message }}</span> @enderror
                            @error('part_discount_type') <span class="text-danger error">{{ $message }}</span> @enderror
                        </div>
                        <!-- Type Dropdown -->
                        <div class="col-md-6">
                            <label class="form-label">Type <span class="text-danger">*</span></label>
                            <select class="form-select" wire:model="part_type">
                                <option value="part">Part</option>
                                <option value="lubricant">Lubricant</option>
                                <option value="accessory">Accessory</option>
                            </select>
                            @error('part_type') <span class="text-danger error">{{ $message }}</span> @enderror
                        </div>
                        <!-- Unit -->
                        <div class="col-md-6">
                            <label class="form-label">Unit<sup class="text-danger">*</sup></label>
                            <select class="form-select" wire:model.lazy="part_unit">
                                <option value="">Select Unit</option>
                                @foreach ($part_units as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->title }}</option>
                                @endforeach
                            </select>
                            @error('part_unit') <span class="text-danger error">{{ $message }}</span> @enderror
                        </div>
                        <!-- SP Type -->
                        <div class="col-md-6">
                            <label class="form-label">SP Type<sup class="text-danger">*</sup></label>
                            <select class="form-select" wire:model.lazy="part_sp_type">
                                <option value="">Select SP Type</option>
                                <option value="0">New</option>
                                <option value="1">Used</option>
                            </select>
                            @error('part_sp_type') <span class="text-danger error">{{ $message }}</span> @enderror
                        </div>
                        <!-- Stock -->
                        <div class="col-md-6">
                            <label class="form-label">Stock<sup class="text-danger">*</sup></label>
                            <input type="number" wire:model.lazy="part_stock" class="form-control" placeholder="Enter Stock">
                            @error('part_stock') <span class="text-danger error">{{ $message }}</span> @enderror
                        </div>
                        <!-- HSN Code -->
                        <div class="col-md-6">
                            <label class="form-label">HSN Code</label>
                            <input type="text" wire:model.lazy="part_hsn_code" class="form-control" placeholder="Enter HSN Code">
                            @error('part_hsn_code') <span class="text-danger error">{{ $message }}</span> @enderror
                        </div>
                        <!-- Rack No. -->
                        <div class="col-md-6">
                            <label class="form-label">Rack No.</label>
                            <input type="text" wire:model.lazy="part_rack_no" class="form-control" placeholder="Enter Rack No.">
                            @error('part_rack_no') <span class="text-danger error">{{ $message }}</span> @enderror
                        </div>
                        <!-- Category -->
                        <select class="form-select" wire:model.lazy="part_category">
    <option value="">Select Category</option>
    @foreach ($part_categories as $category)
        <option value="{{ $category['categoryId'] * 1 }}">{{ $category['categoryName'] }}</option>
    @endforeach
</select>

                         <div class="row align-items-center">
                                <div class="col-10 mt-3">
                                    <div class="form-group">
                                        <label class="form-label"> Image</label>
                                        <input type="file" class="form-control" wire:model="image" />
                                    </div>
                                </div>
                                <div class="col-2 mt-3">
                                    @if ($part_part_image_url)
                                        <img class="img-fluid mt-4 w-75" src="{{ $part_part_image_url }}">
                                    @elseif (!empty($imageName))
                                        <img class="img-fluid mt-4 w-75" src="{{ asset($imageName) }}">

                                    @endif
                                </div>
                                @error('image')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>



                            <div class="col-md-12 mt-3">
                                <div class="form-group">
                                     <input type="text"
                                       {{-- wire:model.debounce.300ms="brandFilter"--}}
                                        wire:model="brandFilter"
                                        class="form-control mb-3"
                                        placeholder="Type brand name">
                                        
                                    <label class="form-label">Compatible Vehicles List<span class="text-danger">*</span></label>
                                    <div class="border rounded p-3" style="max-height: 300px; overflow-y: auto;">
                                        @if (!empty($part_api_compatible_vehicles))
                                            <div class="row">
                                                @foreach ($part_api_compatible_vehicles as $vehicle)
                                                    <div class="col-md-6 mb-2">
                                                        <div class="vehicle-item p-2 border-bottom">
                                                            <strong>{{ $vehicle['manufacturerName'] }} {{ $vehicle['modelName'] }}</strong><br>
                                                            <small class="text-muted">
                                                                {{ $vehicle['typeEngineName'] ? $vehicle['typeEngineName'] . ' | ' : '' }}
                                                                {{ $vehicle['fuelType'] ? $vehicle['fuelType'] . ' | ' : '' }}
                                                                {{ $vehicle['year'] ? $vehicle['year'] : '' }}
                                                            </small>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @elseif (!empty($part_modifications))
                                            <div class="row">
                                                @foreach ($part_modifications as $modification)
                                                  @if(empty($brandFilter) || stripos($modification->brand_name, $brandFilter) !== false)
                                                            <div class="col-md-6 mb-2">
                                                                <div class="form-check vehicle-item p-2 border-bottom">
                                                                    <input class="form-check-input"
                                                                        type="checkbox"
                                                                        value="{{ $modification->id }}"
                                                                        wire:model.lazy="part_suitable_for"
                                                                        id="modification_{{ $modification->id }}">


                                                                    <label class="form-check-label" for="modification_{{ $modification->id }}">
                                                                        <strong>{{ $modification->brand_name }} {{ $modification->variant_name }}</strong><br>
                                                                        <small class="text-muted">
                                                                            {{ $modification->year }} {{ $modification->title }}
                                                                        </small>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            @endif
                                                @endforeach

                                            </div>
                                        @else
                                            <div class="text-center text-muted">
                                                <p>No compatible vehicles found</p>
                                            </div>
                                        @endif
                                    </div>
                                    <small class="text-info">All vehicles in this list will be automatically saved as compatible vehicles.</small>
                                </div>
                            </div>

                        <!-- Description -->
                        <div class="col-md-12">
                            <label class="form-label">Description</label>
                            <textarea wire:model="part_description" class="form-control" placeholder="Enter Description"></textarea>
                            @error('part_description') <span class="text-danger error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closePartModal" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        Save
                        <i class="spinner-border spinner-border-sm" wire:loading></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

<!-- DEBUG: Direct input for part_purchase_amount
<div class="mb-3">
    <label>Debug Purchase Amount (outside modal):</label>
    <input type="text" wire:model="part_purchase_amount" class="form-control" placeholder="Debug Purchase Amount">
    <span class="text-muted">Value: {{ $part_purchase_amount }}</span>
</div>  -->

<style>
.stepper-wrapper {
    position: relative;
    width: 100%;
}
.stepper-step {
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;
    flex: 1;
    min-width: 70px;
}
.stepper-circle {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 18px;
    margin-bottom: 4px;
    z-index: 2;
    border: 2px solid #fff;
    box-shadow: 0 0 0 2px #e0e0e0;
    background: #e0e0e0;
    color: #333;
}
.stepper-label {
    font-size: 14px;
    margin-top: 2px;
    color: #333;
    font-weight: normal;
}
.stepper-line {
    position: absolute;
    top: 16px;
    left: 100%;
    width: calc(100% - 32px);
    height: 4px;
    background: #e0e0e0;
    z-index: 1;
    transition: background 0.3s;
}
.stepper-line-active-0 { background: #007bff !important; }
.stepper-line-active-1 { background: rgb(226, 149, 41) !important; }
.stepper-line-active-2 { background: rgb(32, 184, 45) !important; }
.stepper-line-active-3 { background: #b3b300 !important; }
.active-step-0 { background: #007bff !important; color: #fff !important; }
.active-step-1 { background:rgb(226, 149, 41) !important; color: #fff !important; }
.active-step-2 { background:rgb(32, 184, 45) !important; color: #fff !important; }
.active-step-3 { background: #b3b300 !important; color: #fff !important; }
.active-label-0 { color: #007bff !important; font-weight: bold; }
.active-label-1 { color:rgb(226, 149, 41) !important; font-weight: bold; }
.active-label-2 { color:rgb(32, 184, 45) !important; font-weight: bold; }
.active-label-3 { color: #b3b300 !important; font-weight: bold; }
</style>

