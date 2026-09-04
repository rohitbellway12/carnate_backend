<div>
    
    <div class="modal @if ($shoImageModel) show @endif" tabindex="-1" style="opacity:1; background-color:#0606068c; display:@if ($shoImageModel) block @endif">
        <div class="modal-dialog modal-s">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Image</h4>
                    <button type="button" class="btn-close" wire:click="clodeImageModel"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-3">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                @if(!empty($imageitem))
                                    @if (!empty($imageitem->SpareParts->Image->file))
                                        <img src="{{ asset($imageitem->SpareParts->Image->file) }}" alt="Maintenance Service Parts" style="width: 100%; height: auto;">
                                    @else
                                        @if($imageitem->SpareParts->spare_part_type ==1)
                                            <img src="{{ asset('img/accessory.png') }}" alt="Maintenance Service Parts" style="width: 100%; height: auto;">
                                        @elseif($imageitem->SpareParts->spare_part_type ==2)
                                            <img src="{{ asset('img/spareparts.jpg') }}" alt="Maintenance Service Parts" style="width: 100%; height: auto;">
                                        @elseif($imageitem->SpareParts->spare_part_type ==3)
                                            <img src="{{ asset('img/tools.jpg') }}" alt="Maintenance Service Parts" style="width: 100%; height: auto;">
                                        @else
                                            <img src="{{ asset('img/lubricant.jpg') }}" alt="Maintenance Service Parts" style="width: 100%; height: auto;">
                                        @endif
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<div>
    <div class="modal @if ($showReasonModel) show @endif" tabindex="-1"
        style="opacity:1; background-color:#0606068c; display:@if ($showReasonModel) block @endif">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form wire:submit.prevent="declinereasonStore">
                    <div class="modal-header">
                        <h4 class="modal-title">{{$statusReason}}  Reason</h4>
                        <button type="button" class="btn-close" wire:click="clodeReasonModel"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body py-3">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">{{$statusReason}} Reason <sup class="text-danger">*</sup> </label>
                                    <textarea wire:model="decline_reason" class="form-control" rows="4"
                                        placeholder="Enter Reason"></textarea>
                                </div>
                                @error('decline_reason')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    @if(empty($decline_reason))
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="clodeReasonModel"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            Create
                            <i class="spinner-border spinner-border-sm" wire:loading></i>
                        </button>
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>


    @if ($showOrderItem)

        <div class="card">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div class="breadcrumb-title pe-2" style="border: none;">Order Item</div>
                <div class="pe-3">
                    <a href="javascript:void(0);" wire:click="back" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i
                            class="bx bx-back"></i>Back</a>
                </div>
            </div>
        </div>
        <div class="card mt-4">
            @if (!empty($orders->orderItem) && count($orders->orderItem))
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Spare Part</th>
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
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <a href="javascript:void(0);" wire:click="shoImage({{$order_item->id}})">
                                                @if (!empty($order_item->SpareParts->Image->file))
                                                <img src="{{ asset($order_item->SpareParts->Image->file) }}" alt="Maintenance Service Parts" height="50" width="50px" >
                                                @else
                                                @if($order_item->SpareParts->spare_part_type ==1)
                                                <img src="{{ asset('img/accessory.png') }}" alt="Maintenance Service Parts" height="50" width="50px"  >
        
                                                @elseif($order_item->SpareParts->spare_part_type ==2)
                                                <img src="{{ asset('img/spareparts.jpg') }}" alt="Maintenance Service Parts"  height="50" width="50px"  >
        
                                                @elseif($order_item->SpareParts->spare_part_type ==3)
                                                <img src="{{ asset('img/tools.jpg') }}" alt="Maintenance Service Parts" height="50" width="50px"  >
        
                                                @else
                                                <img src="{{ asset('img/lubricant.jpg') }}" alt="Maintenance Service Parts"  height="50" width="50px"  >
        
                                                @endif
                                                @endif
                                                
                                            </a>
                                            {{ $order_item?->SpareParts?->name ?? '-' }}</td>
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
                                         <td>{{ $order_item->SpareParts->rack_no ?? 'Null'}}</td>
                                        <td>{{ $order_item->SpareParts->part_number ?? 'Null' }}</td>
                                        <td>{{ $order_item->quantity }}</td>
                                         @php
                                             $tax_type = $order_item->SpareParts?->tax_type ?? 'include';
                                             $tax_percentage = (float)($order_item->SpareParts?->tax_percentage ?? 0);
                                             $total_amount = (float)$order_item->total_amount;
                                             
                                             if ($tax_type === 'include') {
                                                 // Tax is included in the total amount
                                                 $taxableVal = $total_amount / (1 + ($tax_percentage / 100));
                                                 $gstVal = $total_amount - $taxableVal;
                                                 $payableVal = $total_amount;
                                             } else {
                                                 // Tax is excluded from the total amount
                                                 $taxableVal = $total_amount;
                                                 $gstVal = $total_amount * ($tax_percentage / 100);
                                                 $payableVal = $total_amount + $gstVal;
                                             }
                                         @endphp
                                         <td>₹ {{ number_format($taxableVal, 2) }}</td>
                                         <td>
                                             {{ $order_item->SpareParts?->tax_percentage ?? 0 }}%
                                             <br>
                                             <small class="text-muted">
                                                 ({{ ucfirst($order_item->SpareParts?->tax_type ?? 'include') }})
                                             </small>
                                         </td>
                                         <td>₹ {{ number_format($gstVal, 2) }}</td>
                                         <td>₹ {{ number_format($payableVal, 2) }}</td>
                                        <td>
                                           @if ($order_item->status == 0)
                                            <p class="badge bg-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Awaiting acceptance/rejection from Spare Part Vendor">Pending</p>
                                         @elseif($order_item->status == 1)
                                             <p class="badge bg-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Item accepted; awaiting Handover">Accepted</p>
                                         @elseif($order_item->status == 2)
                                             <p class="badge bg-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Item declined by Spare Part Vendor. Reason: {{ $order_item->reason }}">Declined</p>
                                         @elseif($order_item->status == 3)
                                         <p class="badge bg-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Item handed over; awaiting receipt by Workshop">Handover</p>
                                         @elseif($order_item->status == 4)
                                         <p class="badge bg-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Item successfully received by Workshop">Received-Handover</p>  
                                         @elseif($order_item->status == 5)
                                         <p class="badge bg-info text-dark" data-bs-toggle="tooltip" data-bs-placement="top" title="Delivery delayed by Spare Part Vendor. Reason: {{ $order_item->reason }}">Delayed</p>
                                         @endif
                                        </td>
                                        <td>
                                            @if ($order_item->status == 5)
                                            <button type="button" wire:click="declineorder({{ $order_item->id }},5)"
                                                class="btn btn-info btn-sm rounded mx-2" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $order_item->reason }}">Delayed Reason</button>
                                            @elseif($order_item->status == 2)
                                            <button type="button" wire:click="declineorder({{ $order_item->id }},2)"
                                                class="btn btn-danger btn-sm rounded mx-2" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $order_item->reason }}">Declined Reason</button>
                                            @endif

                                            @if (($order_item->payment_status == 1 || $order_item->payment_status == 2  ) && $order_item->status == 1)
                                            <button type="button" wire:click="handover({{ $order_item->id }},3)"
                                                class="btn btn-success btn-sm rounded mx-2">Handover</button>                                
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper">
                            {{-- {{ $orders->links() }} --}}
                        </div>
                    </div>
                </div>
            @else
                <div class="my-2">
                    <div class="alert alert-info">No Order found!</div>
                </div>
            @endif
        </div>
        
    @else
        <div class="card">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div class="breadcrumb-title pe-2" style="border: none;">Paid Order List</div>
                <div class="pe-3">
                    {{-- <a href="javascript:;" wire:click="create" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i
                        class="bx bxs-plus-square"></i>Add</a> --}}
                </div>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-body">
                <div class="row">
                <div class="col-3">
                    <input type="text" class="form-control" placeholder="Search Invoice No. " wire:model.live="searchfilter" fdprocessedid="blgf5">
                </div>
                <div class="col-3">
                    <input class="form-control form-control-solid" placeholder="Pick Dates" id="kt_daterangepicker_1"/>
                </div>
                <div class="col-6 text-right">
                    <button type="button" class="mr-2 btn btn-info text-white rounded-0  float-end" wire:click="resetFilter" fdprocessedid="orntg">Clear</button>
                 </div>
                </div>
                
            </div>
        </div>
        <div class="card mt-4">
            @if (!empty($orders) && $orders->count())
                <div class="card-body ">
                    <div class="table-responsive">
                        <table class="table table-bordered data-table">
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
                                    <td>{{ $orders->total() - ($orders->firstItem() + $index) + 1 }}</td>
                                    <td>{{ \sparepartOrderReference($order, $currentUser) }}</td>
                                    <td>
                                        {{ carbon\carbon::parse($order->order_date)->format('d-M-Y') }} <br>
                                        {{ carbon\carbon::parse($order->order_date)->format('h:i A') }}
                                    </td>
                                    <td class="text-end">{{ number_format($order->total_amount, 2) }}</td>
                                    <td>{{ $order->total_quantity }}</td>
                                    <td>{{ $order->total_item }}</td>
                                    <td>{{ $order->orderItem->where('status',1)->count() }}</td>
                                    <td>
                                        @switch($order->payment_status)
                                            @case(0)
                                                <p class="badge bg-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Awaiting payment from Workshop">Payment Pending</p>
                                            @break
                                            @case(1)
                                                <p class="badge bg-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Payment received successfully from Workshop">Payment Success</p>
                                            @break
                                        @endswitch
                                    </td>
                                    <td>
                                        @switch($order->order_status)
                                        @case(1)
                                            <p class="badge bg-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Order accepted by Spare Part Vendor; awaiting Handover">Accepted</p>
                                        @break

                                        @case(0)
                                            <p class="badge bg-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Awaiting acceptance/rejection from Spare Part Vendor">Pending</p>
                                        @break
                                        @case(3)
                                        <p class="badge bg-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Some items accepted/rejected by Spare Part Vendor; awaiting Handover">Partially Accepted</p>
                                          @break

                                        @case(2)
                                            <p class="badge bg-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Order declined by Spare Part Vendor. Reason: {{ $order->decline_reason }}">Decline</p>
                                        @break
                                        @endswitch
                                    </td>
                                    <td>
                                           <a class="btn btn-primary btn-sm " 
                                                wire:click="view({{ $order->id }})">
                                                View Item
                                            </a> 

                                            @php
                                                $sparepartId = $currentUser->id;
                                                $ordertId = $order->orderItem->pluck('order_id')->toArray();
                                                $ordertId = implode('-', array_unique($ordertId));
                                                $sparepartItemId = $order->orderItem->pluck('id')->toArray();
                                                $sparepartItemId = implode('-',$sparepartItemId);
                                            @endphp
                                            
                                              
                                                <a href="{{ route('getSparePartinvoPdf', [encrypt($sparepartId), encrypt($sparepartItemId), encrypt($ordertId),encrypt(0)]) }}" target="_blank" class="btn btn-outline-secondary mx-1">
                                                    <i class="fa fa-file-pdf"></i>
                                                </a>
                                                <a href="{{ route('getSparePartinvoPdf', [encrypt($sparepartId), encrypt($sparepartItemId), encrypt($ordertId),encrypt(1)]) }}" target="_blank" class="btn btn-outline-secondary mx-1">
                                                    <i class="fa fa-print" style="font-size: small;"></i>
                                                </a>
                                       
                                    </td>
                                </tr>
                            @endforeach
                            
                            </tbody>
                        </table>
                        <div class="pagination-wrapper">
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>
            @else
                <div class="my-2">
                    <div class="alert alert-info">No Order found!</div>
                </div>
            @endif
        </div>
    @endif
</div>
@section('footerscript')
<script>
        document.addEventListener('livewire:init', function () {
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

        tooltipLivewire();

        Livewire.hook('morphed', (message, component) => {
            tooltipLivewire();
        });
    });

    // Re-initialize tooltips after Livewire updates
    document.addEventListener('livewire:navigated', function () {
        tooltipLivewire();
    });

    function tooltipLivewire() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.forEach(function (tooltipTriggerEl) {
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
